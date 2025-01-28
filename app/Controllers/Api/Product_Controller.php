<?php

namespace App\Controllers\Api;

use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Models\ProductModel;
use App\Models\ProductItemModel;
use App\Models\ProductConfigModel;
use App\Models\ProductMetaDetalisModel;
use App\Models\CommonModel;
use App\Models\VendorModel;
use App\Models\ProductImagesModel;
use App\Models\VariationModel;
use App\Models\VariationOptionModel;
use App\Models\VariantImagesModel;
use App\Models\DiscountsModel;
use App\Models\OrdersModel;
use App\Models\OrderItemsModel;
use App\Models\ProductSizeListModel;
use App\Models\ItemStocksModel;
use App\Models\ProductPricesModel;
use App\Models\ExpartReviewModel;
use App\Models\ReviewModel;
use App\Models\WishlistsModel;
use App\Models\BestSellingVendorModel;
use App\Models\VendorAuthorizationModel;
use App\Models\UserCartModel;



class Product_Controller extends Api_Controller
{

    public function index(): void
    {
        echo 'PRODUCT';
    }

    private function add_product($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product not added',
            'data' => null
        ];
        $VendorModel = new VendorModel();
        $vendorRow = $VendorModel->where('user_id', $data['user_id'])->first();
        $vendor_id = !empty($vendorRow['uid']) ? $vendorRow['uid'] : '';
        $uploadedFiles = $this->request->getFiles();



        if (empty($data['title'])) {
            $resp['message'] = 'Your Product Has No Name';
        } else if (empty($data['details'])) {
            $resp['message'] = 'Please add Some Details About Your Product';
        } else if (empty($data['price'])) {
            $resp['message'] = 'Set The Price Of Your Product';
        } else if (empty($data['categoryId'])) {
            $resp['message'] = 'Set The Category Of Your Product';
        } else if (empty($vendor_id)) {
            $resp['message'] = 'Vendor Not Found';
        } else if (empty($uploadedFiles['images'])) {
            $resp['message'] = 'Please Add One Product Image';
        } else if (empty($uploadedFiles['images2'])) {
            $resp['message'] = 'Please Add Product Size Chart';
        } else if (empty($data['productSizeId'])) {
            $resp['message'] = 'Please Add Size';
        } else {

            $ProductSizeListModel = new ProductSizeListModel();
            $stocks_list = $ProductSizeListModel->where('uid', $data['productSizeId'])->first();
            $listOfSizes = json_decode($stocks_list['size_list'], true);
            $item_stock_data = [];

            $product_data = [
                'uid' => $this->generate_uid(UID_PRODUCT),
                'vendor_id' => $vendor_id,
                'category_id' => $data['categoryId'],
                'name' => $data['title'],
                'description' => $data['details'],
                'size_id' => $data['productSizeId'],
            ];
            foreach($listOfSizes as $index => $size_list_data){
                $item_stock_data[] = [
                    'uid' => $this->generate_uid('ITSKU'),
                    'product_id' => $product_data['uid'],
                    'varient_id' =>'',
                    'size_id' => $data['productSizeId'],
                    'sizes' => $size_list_data,
                    'stocks' => 0,
                ];
            }
            $product_item_data = [
                'uid' => $this->generate_uid(UID_PRODUCT_ITEM),
                'product_id' => $product_data['uid'],
                'price' => $data['price'],
                'discount' => $data['discount'],
                'product_tags' => $data['productTags'],
                'publish_date' => $data['publishDate'],
                'status' => $data['status'],
                'visibility' => $data['visibility'],
                'manufacturer_brand' => $data['manufacturerBrand'],
                'manufacturer_name' => $data['manufacturerName']
            ];
            $product_meta_data = [
                'uid' => $this->generate_uid(UID_PRODUCT_META),
                'product_id' => $product_data['uid'],
                'meta_title' => $data['metaTitle'],
                'meta_description' => $data['metaDescription'],
                'meta_keywords' => $data['metaKeywords'],
            ];

            $ProductImagesModel = new ProductImagesModel();
            foreach ($uploadedFiles['images'] as $file) {
                $file_src = $this->single_upload($file, PATH_PRODUCT_IMG);
                $product_image_data = [
                    'uid' => $this->generate_uid(UID_PRODUCT_IMG),
                    'product_id' => $product_data['uid'],
                    'type' => 'path',
                    'src' => $file_src
                ];
                $ProductImagesModel->insert($product_image_data);
            }

            foreach ($uploadedFiles['images2'] as $file) {
                $file_src = $this->single_upload($file, 'public/uploads/product_size_chart');
                $product_item_data['size_chart'] = $file_src;
            }

            $ProductModel = new ProductModel();
            $ProductItemModel = new ProductItemModel();
            $ProductMetaDetalisModel = new ProductMetaDetalisModel();
            $ItemStocksModel = new ItemStocksModel();


            // Transaction Start
            $ProductModel->transStart();
            try {
                $ProductModel->insert($product_data);
                $ItemStocksModel->insertBatch($item_stock_data);
                $ProductItemModel->insert($product_item_data);
                $ProductMetaDetalisModel->insert($product_meta_data);
                // Commit the transaction if all queries are successful
                $ProductModel->transCommit();
            } catch (\Exception $e) {
                // Rollback the transaction if an error occurs
                $ProductModel->transRollback();
                $resp['message'] = $e->getMessage();
            }

            $resp['status'] = true;
            $resp['message'] = 'Product added';
            $resp['data'] = ['product_id' => $product_data['uid']];
        }
        return $resp;
    }

    private function add_bulk_product($data)
    {   
        // $this->prd($data);

        $resp = [
            'status' => false,
            'message' => 'Product not added',
            'data' => null
        ];
        // $price_range_json = $data['products'][0]['price_range'];
        // $price_range = json_decode($price_range_json, true);
       
        // $this->prd($data);
        $uploadedFiles = $this->request->getFiles();
        

        if (empty($data['products'])) {
            $resp['message'] = 'Your Product Is Empty';
        } else if (empty($data['vendorId'])) {
            $resp['message'] = 'Please add Vendor';
        } else {


            $product_data = [];
            $product_item_data = [];
            $item_stock_data = [];
            $item_prices = [];
            $ProductSizeListModel = new ProductSizeListModel();
            foreach($data['products'] as $index => $product){
                $stocks_list = $ProductSizeListModel->where('uid', $product['size'])->first();
                $listOfSizes = json_decode($stocks_list['size_list'], true);
                
                $product_data[] = array(
                    'uid' => $this->generate_uid(UID_PRODUCT),
                    'vendor_id' => $data['vendorId'],
                    'category_id' => $product['category'],
                    'name' => $product['productName'],
                    'description' => $product['description'],
                    'size_id' => $product['size'],
                    'status' => $data['status'],
                );

                foreach($listOfSizes as $i => $size_list_data){
                    $item_stock_data[] = [
                        'uid' => $this->generate_uid('ITSKU'),
                        'product_id' => $product_data[$index]['uid'],
                        'varient_id' =>'',
                        'size_id' => $product['size'],
                        'sizes' => $size_list_data,
                        'stocks' => 0,
                    ];
                }

                $price_range = json_decode($product['price_range'], true);
                foreach($price_range as $i => $p_range){
                    $item_prices[] = [
                        'uid' => $this->generate_uid('PROPRIC'),
                        'product_id' => $product_data[$index]['uid'],
                        'min_qty' => $p_range['min'],
                        'max_qty' => $p_range['max'],
                        'price' => $p_range['price'],
                    ];
                }

                

                $product_item_data[] = array(
                    'uid' => $this->generate_uid(UID_PRODUCT_ITEM),
                    'product_id' => $product_data[$index]['uid'],
                    'price' => '0',
                    'discount' => !empty($product['discount']) ? $product['discount'] : 0,
                    'tax' => $product['tax'],
                    'delivery_charge' => !empty($product['del_charge']) ? $product['del_charge'] : 0,
                    'product_tags' => $product['tags'],
                    'publish_date' => "",
                    'status' => "",
                    'visibility' => "visible",
                    'quantity' => '0',
                    'manufacturer_brand' => $product['barCode'],
                    'manufacturer_name' =>  $product['storeName']
                );
                $ProductImagesModel = new ProductImagesModel();
                // $this->prd($uploadedFiles['products']);
                if(!empty($uploadedFiles['products'][$index]['image'])){

                    foreach ($uploadedFiles['products'][$index]['image'] as $file) {
                        $file_src = $this->single_upload($file, PATH_PRODUCT_IMG);
                        $product_image_data = [
                            'uid' => $this->generate_uid(UID_PRODUCT_IMG),
                            'product_id' => $product_data[$index]['uid'],
                            'type' => 'path',
                            'src' => $file_src
                        ];
                        $ProductImagesModel->insert($product_image_data);
                    }
                }

                $VendorAuthorizationModel = new VendorAuthorizationModel();
                if (!empty($uploadedFiles['products'][$index]['authFiles'])) {
                    foreach ($uploadedFiles['products'][$index]['authFiles'] as $file) {
                        $file_src = $this->single_upload($file, PATH_PRODUCT_IMG);
                        $product_auth_data = [
                            'uid' => $this->generate_uid('VENAUTH'),
                            'product_id' => $product_data[$index]['uid'],
                            'authorization_img' => $file_src,
                            'authorization_letter' => $product['authDescription']
                        ];
                        $VendorAuthorizationModel->insert($product_auth_data);
                    }
                }
            }
            // $this->prd($product_data);
            $ProductModel = new ProductModel();
            $ProductItemModel = new ProductItemModel();
            $ItemStocksModel = new ItemStocksModel();
            $ProductPricesModel = new ProductPricesModel();


            // Transaction Start
            $ProductModel->transStart();
            try {
                $ProductModel->insertBatch($product_data);
                $ItemStocksModel->insertBatch($item_stock_data);
                $ProductPricesModel->insertBatch($item_prices);
                $ProductItemModel->insertBatch($product_item_data);
                $ProductModel->transCommit();
            } catch (\Exception $e) {
                // Rollback the transaction if an error occurs
                $ProductModel->transRollback();
                $resp['message'] = $e->getMessage();
            }

            $resp['status'] = true;
            $resp['message'] = 'Product added';
            $resp['data'] = [];
        }
        return $resp;
    }

    public function add_product_excel($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product not added',
            'data' => null
        ];

        $VendorModel = new VendorModel();
        $vendorRow = $VendorModel->where('user_id', $data['user_id'])->first();
        $vendor_id = !empty($vendorRow['uid']) ? $vendorRow['uid'] : '';
        $uploadedFile = $this->request->getFiles();

        if (!$uploadedFile['excel_file']->isValid()) {
            return $this->response->setStatusCode(400)->setJSON(['error' => $uploadedFile['excel_file']->getErrorString()]);
        }

        $filePath = 'public/uploads/product_excel/';
        $fileName = $uploadedFile['excel_file']->getRandomName();
        // $this->pr($filePath);
        // $this->prd($fileName);
        if (!$uploadedFile['excel_file']->move($filePath, $fileName)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Failed to move the uploaded file.']);
        }

        // Load the spreadsheet
        $spreadsheet = IOFactory::load($filePath.$fileName);
        // $this->prd($rows);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();
        // $this->prd($rows[4][10]);
        $ProductModel = new ProductModel();
        $ProductItemModel = new ProductItemModel();
        $ProductMetaDetalisModel = new ProductMetaDetalisModel();

        foreach ($rows as $index => $row) {
            if ($index === 0) {
                // Skip the header row
                continue;
            }

            // Customize columns based on your table structure
            $product_data = [
                'uid' => $this->generate_uid(UID_PRODUCT),
                'vendor_id' => $vendor_id,
                'category_id' => "",
                'name' => $row[1],
                'description' => $row[7],
                'size_id' => "",
                'status' => "active",
            ];

            $product_item_data = [
                'uid' => $this->generate_uid(UID_PRODUCT_ITEM),
                'product_id' => $product_data['uid'],
                'price' => $row[5],
                'mrp' => $row[4],
                'discount' => 0,
                // 'product_tags' => "",
                'publish_date' => date('Y-m-d H:i:s'),
                'generic_name' => $row[2],
                'company_name' => $row[3],
                'exp_date' => $row[6],
                'container_type' => $row[9],
                'flavour' => $row[10] ? $row[10] : "",
                'purchase_quantity' => $row[11] ? $row[11] : 0,
                'free_quantity' => $row[12] ? $row[12] : 0,
                'quantity' => $row[8],
                'status' => 'active',
                'visibility' => 'visible',
                'manufacturer_brand' => "",
                'manufacturer_name' => ""
            ];

            $product_meta_data = [
                'uid' => $this->generate_uid(UID_PRODUCT_META),
                'product_id' => $product_data['uid'],
                'meta_title' => "",
                'meta_description' => "",
                'meta_keywords' => "",
            ];
            // $insertData = $ProductItemModel->insert($product_item_data);
            // $this->pr($product_item_data);
            // $this->prd($insertData);
            // Transaction Start
            $ProductModel->transStart();
            try {
                $ProductModel->insert($product_data);
                $insertData = $ProductItemModel->insert($product_item_data);
                // $this->prd($insertData);
                $ProductMetaDetalisModel->insert($product_meta_data);
                // Commit the transaction if all queries are successful
                $ProductModel->transCommit();
            } catch (\Exception $e) {
                // Rollback the transaction if an error occurs
                $ProductModel->transRollback();
                $resp['message'] = $e->getMessage();
                return $resp;
            }
        }

        $resp['status'] = true;
        $resp['message'] = 'Products added successfully';
        return $resp;
    }

    private function product_bulk_update($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product not added',
            'data' => null
        ];

        // $this->prd($data);
        if (empty($data['products'])) {
            $resp['message'] = 'No products to update';
        } else {
            $ProductModel = new ProductModel();
            $ProductItemModel = new ProductItemModel();
            foreach($data['products'] as $index => $product){
                $ptoduct_update_data = [
                    'name' => $product['productName'],
                    'category_id' => $product['category'],
                    'size_id' => $product['size']
                ];

                $ptoduct_item_update_data = [
                    // 'price' => $product['price'],
                    // 'discount' => $product['discount'],
                    // 'quantity' => $product['qty'],
                    'product_tags' => $product['tags'],
                    'manufacturer_name' => $product['storeName'],
                    'manufacturer_brand' => $product['barCode'],
                    'tax'=>$product['tax'],
                    'discount'=>!empty($product['discount']) ? $product['discount'] : 0,
                    'delivery_charge'=> !empty($product['delivery_charge']) ? $product['delivery_charge'] : 0
                ];

                $ProductModel->set($ptoduct_update_data)
                    ->where('uid', $product['productId'])
                    ->update();
                $ProductItemModel->set($ptoduct_item_update_data)
                    ->where('product_id', $product['productId'])
                    ->update();
            }
            $resp['status'] = true;
            $resp['message'] = 'Product Updated';
            $resp['data'] = [];
        }
        return $resp;



    }

    private function update_product($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product not Updated',
        ];
        if (empty($data['title'])) {
            $resp['message'] = 'Your Product Has No Name';
        } else if (empty($data['details'])) {
            $resp['message'] = 'Please add Some Details About Your Product';
        } else if (empty($data['price'])) {
            $resp['message'] = 'Set The Price Of Your Product';
        } else if (empty($data['categoryId'])) {
            $resp['message'] = 'Set The Category Of Your Product';
        } else {
            $product_data = [
                'category_id' => $data['categoryId'],
                'name' => $data['title'],
                'description' => $data['details'],
                // 'size_id' => $data['productSizeId'],
            ];
            $product_item_data = [
                'price' => $data['price'],
                'discount' => $data['discount'],
                'product_tags' => $data['productTags'],
                'publish_date' => $data['publishDate'],
                'status' => $data['status'],
                'visibility' => $data['visibility'],
                'manufacturer_brand' => $data['manufacturerBrand'],
                'manufacturer_name' => $data['manufacturerName']
            ];

            $product_meta_data = [
                'meta_title' => $data['metaTitle'],
                'meta_description' => $data['metaDescription'],
                'meta_keywords' => $data['metaKeywords'],
            ];

            $ProductModel = new ProductModel();
            $ProductItemModel = new ProductItemModel();
            $ProductMetaDetalisModel = new ProductMetaDetalisModel();
            $ProductImagesModel = new ProductImagesModel();

            $uploadedFiles = $this->request->getFiles();
            if (isset($uploadedFiles['images'])) {
                foreach ($uploadedFiles['images'] as $file) {
                    $file_src = $this->single_upload($file, PATH_PRODUCT_IMG);
                    $product_image_data = [
                        'uid' => $this->generate_uid(UID_PRODUCT_IMG),
                        'product_id' => $data['product_id'],
                        'type' => 'path',
                        'src' => $file_src
                    ];
                    $ProductImagesModel->insert($product_image_data);
                }
            }

            if (isset($uploadedFiles['images2'])) {
                foreach ($uploadedFiles['images2'] as $file) {
                    $file_src = $this->single_upload($file, 'public/uploads/product_size_chart');
                    $product_item_data['size_chart'] = $file_src;
                }
            }


            // Transaction Start
            $ProductModel->transStart();
            //$this->pr($product_data);
            //$this->pr($product_item_data);
            //$this->prd($product_meta_data);

            try {
                $ProductModel->set($product_data)
                    ->where('uid', $data['product_id'])
                    ->update();
                $ProductItemModel->set($product_item_data)
                    ->where('product_id', $data['product_id'])
                    ->update();
                $ProductMetaDetalisModel->set($product_meta_data)
                    ->where('product_id', $data['product_id'])
                    ->update();

                // Commit the transaction if all queries are successful
                $ProductModel->transCommit();
                $resp = [
                    'status' => true,
                    'message' => 'Product Updated',
                ];

            } catch (\Exception $e) {
                // Rollback the transaction if an error occurs
                $ProductModel->transRollback();
                $resp['message'] = $e->getMessage();
            }

        }

        return $resp;

    }


    private function add_new_variant($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product not added',
            'data' => null
        ];

        $CommonModel = new CommonModel();

        $sql = "SELECT
            product_size_list.*
        FROM
            product_size_list
        JOIN
            product ON product.size_id = product_size_list.uid";

        if (!empty($data['productId'])) {
            $p_id = $data['productId'];
            $sql .= " WHERE
                product.uid = '{$p_id}';";
        }else {
            $sql .= ";";
        }
        $sizeLists = $CommonModel->customQuery($sql);
        $sizeLists = json_decode(json_encode($sizeLists), true);
        $listOfSizes = json_decode($sizeLists[0]['size_list'], true);
        $item_stock_data = [];
        // $this->prd($sizeLists);


        $colorVarOptData = [
            'uid' => $this->generate_uid(UID_VAR_OPT),
            'variation_id' => $data['colorId'],
            'value' => $data['colorVal']
        ];
        $sizeVarOptData = [
            'uid' => $this->generate_uid(UID_VAR_OPT),
            'variation_id' => $data['sizeId'],
            'value' => $data['sizeVal']
        ];
        $var1 = [
            'uid' => $this->generate_uid(UID_PRO_CONFIG),
            'product_id' => $data['productId'],
            'variation_option_id' => $colorVarOptData['uid'],
            'price' => $data['price'],
            'discount' => $data['discount'],
            'sku' => $data['stock'],
        ];
        $var2 = [
            'uid' => $var1['uid'],
            'product_id' => $data['productId'],
            'variation_option_id' => $sizeVarOptData['uid'],
            'price' => $data['price'],
            'discount' => $data['discount'],
            'sku' => $data['stock'],
        ];

        foreach($listOfSizes as $index => $size_list_data){
            $item_stock_data[] = [
                'uid' => $this->generate_uid('ITSKU'),
                'product_id' => $data['productId'],
                'varient_id' =>$var1['uid'],
                'size_id' => $sizeLists[0]['uid'],
                'sizes' => $size_list_data,
                'stocks' => 0,
            ];
        }

        $uploadedFiles = $this->request->getFiles();
        $VariantImagesModel = new VariantImagesModel();
        foreach ($uploadedFiles['images'] as $file) {
            $file_src = $this->single_upload($file, PATH_VARIANT_IMG);
            $product_image_data = [
                'uid' => $this->generate_uid(UID_VAR_IMG),
                'config_id' => $var1['uid'],
                'type' => 'path',
                'src' => $file_src
            ];
            $VariantImagesModel->insert($product_image_data);
        }

        $VariationOptionModel = new VariationOptionModel();
        $ProductConfigModel = new ProductConfigModel();
        $ItemStocksModel = new ItemStocksModel();
        try {
            $VariationOptionModel->insert($colorVarOptData);
            $VariationOptionModel->insert($sizeVarOptData);
            $ProductConfigModel->insert($var1);
            $ProductConfigModel->insert($var2);
            $ItemStocksModel->insertBatch($item_stock_data);
            $resp = [
                'status' => true,
                'message' => 'Product added',
                'data' => ['variant_id' => $var1['uid']]
            ];

        } catch (\Exception $e) {
            $resp['message'] = $e;
        }

        return $resp;
    }

    public function products($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product not Found',
            'data' => null
        ];
        // $data['c_id'] = 'CATD515A6A020240323';
        // $this->prd($data);
        $CommonModel = new CommonModel();

        // $sql = "SELECT
        //     product.uid AS product_id,
        //     product.name AS name,
        //     product.description AS description,
        //     product.created_at AS created_at,
        //     categories.name AS category,
        //     categories.uid AS category_id,
        //     product_item.uid AS product_item_id,
        //     product_item.price AS base_price,
        //     product_item.sku AS product_stock,
        //     product_item.discount AS base_discount,
        //     product_item.product_tags AS tags,
        //     product_item.publish_date AS publish_date,
        //     product_item.status AS status,
        //     product_item.visibility AS visibility,
        //     product_item.quantity,
        //     product_item.size_chart,
        //     product_item.manufacturer_brand AS manufacturer_brand,
        //     product_item.manufacturer_name AS manufacturer_name,
        //     product_meta_detalis.uid AS meta_id,
        //     product_meta_detalis.meta_title,
        //     product_meta_detalis.meta_description,
        //     product_meta_detalis.meta_keywords,
        //     users.user_name AS vendor,
        //     vendor.uid AS vendor_id,
        //     GROUP_CONCAT(product_size_list.uid) AS size_list_id,
        //     GROUP_CONCAT(product_size_list.name) AS size_list_name,
        //     GROUP_CONCAT(product_size_list.size_list) AS size_list
        // FROM
        //     product
        // LEFT JOIN
        //     product_item ON product.uid = product_item.product_id
        // LEFT JOIN
        //     product_meta_detalis ON product.uid = product_meta_detalis.product_id
        // LEFT JOIN 
        //     categories ON product.category_id = categories.uid
        // LEFT JOIN
        //     vendor ON product.vendor_id = vendor.uid
        // LEFT JOIN
        //     users ON vendor.user_id = users.uid
        // LEFT JOIN
        //     product_size_list ON product.size_id = product_size_list.uid";

        // if (!empty($data['p_id'])) {
        //     $p_id = $data['p_id'];
        //     $sql .= " WHERE product.uid = '{$p_id}'";

        // } else if (!empty($data['c_id']) && empty($data['vendor_id'])) {
            
        //     $c_id = $data['c_id'];
        //     $sql .= " WHERE product.category_id = '{$c_id}'";

        // } else if (!empty($data['c_id']) && !empty($data['vendor_id'])) {
        //     $c_id = $data['c_id'];
        //     $vendor_id = $data['vendor_id'];
        //     $sql .= " WHERE product.category_id = '{$c_id}' AND product.vendor_id = '{$vendor_id}'";

        // } else if (!empty($data['v_id'])) {
        //     $v_id = $data['v_id'];
        //     $sql .= " WHERE product.vendor_id = '{$v_id}';";
        // }

        // $sql .= " GROUP BY product.uid;";
        // $this->prd($data['user_type']);
        if((isset($data['user_type']) && ($data['user_type'] == 'admin' || $data['user_type'] == 'seller')) || !empty($data['p_id'])){
            // $this->prd($data['v_id']);
            $sql = "SELECT
                product.uid AS product_id,
                product.name AS name,
                product.description AS description,
                product.status AS product_status,
                product.created_at AS created_at,
                categories.name AS category,
                categories.uid AS category_id,
                product_item.uid AS product_item_id,
                product_item.price AS base_price,
                product_item.mrp,
                product_item.sku AS product_stock,
                product_item.discount AS base_discount,
                -- product_item.product_tags AS tags,
                product_item.publish_date AS publish_date,
                product_item.status AS status,
                product_item.visibility AS visibility,
                product_item.quantity,
                -- product_item.size_chart,
                product_item.tax,
                product_item.delivery_charge,
                product_item.manufacturer_brand AS manufacturer_brand,
                product_item.manufacturer_name AS manufacturer_name,
                product_meta_detalis.uid AS meta_id,
                product_meta_detalis.meta_title,
                product_meta_detalis.meta_description,
                product_meta_detalis.meta_keywords,
                users.user_name AS vendor,
                vendor.uid AS vendor_id,
                GROUP_CONCAT(product_size_list.uid) AS size_list_id,
                GROUP_CONCAT(product_size_list.name) AS size_list_name,
                GROUP_CONCAT(product_size_list.size_list) AS size_list
            FROM
                product
            LEFT JOIN
                product_item ON product.uid = product_item.product_id
            LEFT JOIN
                product_meta_detalis ON product.uid = product_meta_detalis.product_id
            LEFT JOIN 
                categories ON product.category_id = categories.uid
            LEFT JOIN
                vendor ON product.vendor_id = vendor.uid
            LEFT JOIN
                users ON vendor.user_id = users.uid
            LEFT JOIN
                product_size_list ON product.size_id = product_size_list.uid";

            $whereConditions = [];

            if (!empty($data['p_id'])) {
                $whereConditions[] = "product.uid = '{$data['p_id']}'";
            }

            if (!empty($data['c_id'])) {
                $whereConditions[] = "product.category_id = '{$data['c_id']}'";
            }

            if (!empty($data['vendor_id'])) {
                $whereConditions[] = "product.vendor_id = '{$data['vendor_id']}'";
            }

            // if (!empty($data['v_id'])) {
            //     $this->prd($data['v_id']);
            //     $whereConditions[] = "vendor.uid = '{$data['v_id']}'";
            // }

            if (!empty($data['v_id'])) {
                $whereConditions[] = "vendor.user_id = '{$data['v_id']}'";
            }

            if (!empty($whereConditions)) {
                $sql .= " WHERE " . implode(" AND ", $whereConditions);
            }

            $sql .= " GROUP BY product.uid";
            $sql .= " ORDER BY MAX(product.created_at) DESC";
            // $sql .= " ORDER BY product.id DESC";

            $products = $CommonModel->customQuery($sql);
        } else {
            // $this->prd($data['v_id']);
            $sql = "SELECT
                product.uid AS product_id,
                product.name AS name,
                product.description AS description,
                product.status AS product_status,
                product.created_at AS created_at,
                categories.name AS category,
                categories.uid AS category_id,
                product_item.uid AS product_item_id,
                product_item.price AS base_price,
                product_item.sku AS product_stock,
                product_item.discount AS base_discount,
                product_item.product_tags AS tags,
                product_item.publish_date AS publish_date,
                product_item.status AS status,
                product_item.visibility AS visibility,
                product_item.quantity,
                product_item.size_chart,
                product_item.tax,
                product_item.delivery_charge,
                product_item.manufacturer_brand AS manufacturer_brand,
                product_item.manufacturer_name AS manufacturer_name,
                product_meta_detalis.uid AS meta_id,
                product_meta_detalis.meta_title,
                product_meta_detalis.meta_description,
                product_meta_detalis.meta_keywords,
                users.user_name AS vendor,
                vendor.uid AS vendor_id,
                GROUP_CONCAT(product_size_list.uid) AS size_list_id,
                GROUP_CONCAT(product_size_list.name) AS size_list_name,
                GROUP_CONCAT(product_size_list.size_list) AS size_list
            FROM
                product
            LEFT JOIN
                product_item ON product.uid = product_item.product_id
            LEFT JOIN
                product_meta_detalis ON product.uid = product_meta_detalis.product_id
            LEFT JOIN 
                categories ON product.category_id = categories.uid
            LEFT JOIN
                vendor ON product.vendor_id = vendor.uid
            LEFT JOIN
                users ON vendor.user_id = users.uid
            LEFT JOIN
                product_size_list ON product.size_id = product_size_list.uid";
            
            $whereConditions = [];

            $whereConditions[] = "product.status = 'active'";

            if (!empty($data['p_id'])) {
                $whereConditions[] = "product.uid = '{$data['p_id']}'";
            }

            if (!empty($data['c_id'])) {
                $whereConditions[] = "product.category_id = '{$data['c_id']}'";
            }

            if (!empty($data['vendor_id'])) {
                $whereConditions[] = "product.vendor_id = '{$data['vendor_id']}'";
            }

            // if (!empty($data['v_id'])) {
            //     $this->prd($data['v_id']);
            //     $whereConditions[] = "vendor.uid = '{$data['v_id']}'";
            // }

            if (!empty($data['v_id'])) {
                $whereConditions[] = "vendor.user_id = '{$data['v_id']}'";
            }

            if (!empty($whereConditions)) {
                $sql .= " WHERE " . implode(" AND ", $whereConditions);
            }

            $sql .= " GROUP BY product.uid";
            $sql .= " ORDER BY MAX(product.created_at) DESC";

            $products = $CommonModel->customQuery($sql);
           
        }
        
        // usort($products, function ($a, $b) {
        //     return strtotime($b->created_at) - strtotime($a->created_at);
        // });


        

        if (count($products) > 0) {
            $ProductImagesModel = new ProductImagesModel();
            foreach ($products as $key => $product) {
                $products[$key]->product_img = $ProductImagesModel->where('product_id', $product->product_id)->findAll();
            }
            $ItemStocksModel = new ItemStocksModel();
            foreach ($products as $key => $product) {
                $products[$key]->product_sizes = $ItemStocksModel->where('product_id', $product->product_id)->where('varient_id', '')->findAll();
            }

            $ProductPricesModel = new ProductPricesModel();
            foreach ($products as $key => $product) {
                $products[$key]->product_prices = $ProductPricesModel->where('product_id', $product->product_id)->orderBy('CAST(min_qty AS UNSIGNED)', 'ASC')->findAll();
            }

            $VendorAuthorizationModel = new VendorAuthorizationModel();
            foreach ($products as $key => $product) {
                $products[$key]->authorization_letter  = $VendorAuthorizationModel->where('product_id', $product->product_id)->first();
            }

            $user_id = $this->is_logedin();
            $wish_listed_products = [];
            
            if (!empty($user_id)) {
                $WishlistsModel = new WishlistsModel();
                $wish_listed = $WishlistsModel->where('user_id', $user_id)->findAll();
                foreach ($wish_listed as $item) {
                    $wish_listed_products[] = $item['product_id'];
                }
            }
            
            foreach ($products as $key => $product) {
                $products[$key]->is_wishlisted = in_array($product->product_id, $wish_listed_products) ? true : false;
            }

            $resp["status"] = true;
            $resp["data"] = !empty($data['p_id']) ? $products[0] : $products;
            $resp["message"] = 'Products Found';
        }
        // $this->prd($resp);
        return $resp;
    }

    public function letest_arrival_products($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product not Found',
            'data' => null
        ];

        $CommonModel = new CommonModel();

        $sql = "SELECT
            product.uid AS product_id,
            product.name AS name,
            product.description AS description,
            product.created_at AS created_at,
            categories.name AS category,
            categories.uid AS category_id,
            product_item.uid AS product_item_id,
            product_item.price AS base_price,
            product_item.sku AS product_stock,
            product_item.discount AS base_discount,
            product_item.product_tags AS tags,
            product_item.publish_date AS publish_date,
            product_item.status AS status,
            product_item.visibility AS visibility,
            product_item.quantity,
            product_item.size_chart,
            product_item.manufacturer_brand AS manufacturer_brand,
            product_item.manufacturer_name AS manufacturer_name,
            product_meta_detalis.uid AS meta_id,
            product_meta_detalis.meta_title,
            product_meta_detalis.meta_description,
            product_meta_detalis.meta_keywords,
            users.user_name AS vendor,
            vendor.uid AS vendor_id,
            GROUP_CONCAT(product_size_list.uid) AS size_list_id,
            GROUP_CONCAT(product_size_list.name) AS size_list_name,
            GROUP_CONCAT(product_size_list.size_list) AS size_list
        FROM
            product
        LEFT JOIN
            product_item ON product.uid = product_item.product_id
        LEFT JOIN
            product_meta_detalis ON product.uid = product_meta_detalis.product_id
        LEFT JOIN 
            categories ON product.category_id = categories.uid
        LEFT JOIN
            vendor ON product.vendor_id = vendor.uid
        LEFT JOIN
            users ON vendor.user_id = users.uid
        LEFT JOIN
            product_size_list ON product.size_id = product_size_list.uid
        WHERE
            product.status = 'active'";

        if (!empty($data['p_id'])) {
            $p_id = $data['p_id'];
            $sql .= " AND product.uid = '{$p_id}'";
        } elseif (!empty($data['c_id']) && empty($data['vendor_id'])) {
            $c_id = $data['c_id'];
            $sql .= " WHERE product.category_id = '{$c_id}'";
        } elseif (!empty($data['c_id']) && !empty($data['vendor_id'])) {
            $c_id = $data['c_id'];
            $vendor_id = $data['vendor_id'];
            $sql .= " WHERE product.category_id = '{$c_id}' AND product.vendor_id = '{$vendor_id}'";
        } elseif (!empty($data['v_id'])) {
            $v_id = $data['v_id'];
            $sql .= " WHERE vendor.user_id = '{$v_id}'";
        }

        $sql .= " GROUP BY product.uid";
        $sql .= " ORDER BY product.created_at DESC";
        $sql .= " LIMIT 4";

        // Execute the query
        $products = $CommonModel->customQuery($sql);


        if (count($products) > 0) {
            $ProductImagesModel = new ProductImagesModel();
            foreach ($products as $key => $product) {
                $products[$key]->product_img = $ProductImagesModel->where('product_id', $product->product_id)->findAll();
            }

            $ProductPricesModel = new ProductPricesModel();
            foreach ($products as $key => $product) {
                $products[$key]->product_prices = $ProductPricesModel->where('product_id', $product->product_id)->orderBy('CAST(min_qty AS UNSIGNED)', 'ASC')->findAll();
            }


            $user_id = $this->is_logedin();
            $wish_listed_products = [];
            
            if (!empty($user_id)) {
                $WishlistsModel = new WishlistsModel();
                $wish_listed = $WishlistsModel->where('user_id', $user_id)->findAll();
                foreach ($wish_listed as $item) {
                    $wish_listed_products[] = $item['product_id'];
                }
            }
            
            foreach ($products as $key => $product) {
                $products[$key]->is_wishlisted = in_array($product->product_id, $wish_listed_products) ? true : false;
            }
            
            $resp["status"] = true;
            $resp["data"] = !empty($data['p_id']) ? $products[0] : $products;
            $resp["message"] = 'Products Found';


            // $user_id = $this->is_logedin();
            // if(!empty($user_id)){
            //     $WishlistsModel = new WishlistsModel();
            //     $wish_listed = $WishlistsModel->where('user_id', $user_id)->findAll();
            // }
            
            // $resp["status"] = true;
            // $resp["data"] = !empty($data['p_id']) ? $products[0] : $products;
            // $resp["message"] = 'Products Found';
        }
        // $this->prd($resp);
        return $resp;
    }

    private function variation($p_id)
    {
        $resp = [
            'status' => false,
            'message' => 'Product not Found',
            'data' => null
        ];

        $CommonModel = new CommonModel();
        $sql = "SELECT
                    product_config.uid,
                    product_config.sku AS stock,
                    product_config.price,
                    product_config.discount,
                    variation.name,
                    variation_option.value
                FROM
                    product_config
                JOIN
                    variation_option ON product_config.variation_option_id = variation_option.uid
                JOIN
                    variation ON variation_option.variation_id = variation.uid
                WHERE 
                    product_config.product_id = '{$p_id}'";

        $variants = $CommonModel->customQuery($sql);
        if (count($variants) > 0) {
            $VariantImagesModel = new VariantImagesModel();
            foreach ($variants as $key => $variant) {
                $variants[$key]->product_img = $VariantImagesModel->where('config_id', $variant->uid)->findAll();
            }
            $ItemStocksModel = new ItemStocksModel();
            foreach ($variants as $key => $variant) {
                $variants[$key]->product_sizes = $ItemStocksModel->where('product_id', $p_id)->where('varient_id', $variant->uid)->findAll();
            }

            $mergedArray = [];

            foreach ($variants as $key => $variant) {
                $uid = $variant->uid;
                $color = $variant->name === 'color' ? $variant->value : null;
                $size = $variant->name === 'size' ? $variant->value : null;

                if (!isset($mergedArray[$uid])) {
                    // If the UID doesn't exist in mergedArray, initialize it
                    $mergedArray[$uid] = $variant;
                    // Initialize empty arrays for product_img
                    $mergedArray[$uid]->product_img = [];
                } else {
                    // If UID exists, merge the product_img array
                    $mergedArray[$uid]->product_img = array_merge($mergedArray[$uid]->product_img, $variant->product_img);
                }

                // Set color and size directly in the object
                if ($color !== null) {
                    $mergedArray[$uid]->color = $color;
                    unset($mergedArray[$uid]->name);
                    unset($mergedArray[$uid]->value);
                }

                if ($size !== null) {
                    $mergedArray[$uid]->size = $size;
                    unset($mergedArray[$uid]->name);
                    unset($mergedArray[$uid]->value);
                }
            }
            $mergedArray = array_values($mergedArray);
            //$this->prd($mergedArray);


            $resp["status"] = true;
            $resp["data"] = $mergedArray;
            $resp["message"] = 'Products Found';
        }
        return $resp;
    }

    private function variation_options()
    {
        $resp = [
            'status' => false,
            'message' => 'varaints not found',
            'data' => null
        ];
        $VariationModel = new VariationModel();
        $VariationOptionModel = new VariationOptionModel();

        try {
            $variations = $VariationModel->findAll();

            foreach ($variations as $key => $val) {
                $variations[$key]['options'] = $VariationOptionModel->where('variation_id', $val['uid'])->findAll();
            }

            $resp = [
                'status' => true,
                'message' => 'varaints found',
                'data' => $variations
            ];

        } catch (\Exception $e) {
            // Rollback the transaction if an error occurs
            $VariationModel->transRollback();
            throw $e;
        }


        return $resp;
    }

    private function user_id()
    {
        $resp = [
            'status' => false,
            'message' => 'User id not found',
            'data' => null
        ];
        $user_id = $this->is_logedin();
        // $this->prd($user_id);
        if (!empty($user_id)) {
            $resp['status'] = true;
            $resp['message'] = 'User id found';
            $resp['data'] = $user_id;
        }

        // $this->prd($resp);

        return $resp;
    }

    private function product_stock_update($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Stock Not Updated',
            'data' => null
        ];


        try {
            $ProductItemModel = new ProductItemModel();

            $isUpdated = $ProductItemModel->set(['sku' => $data['stock']])
                ->where('product_id', $data['p_id'])
                ->update();
            if ($isUpdated == '1') {
                $resp = [
                    'status' => true,
                    'message' => 'Stock Updated',
                    'data' => ['updatedStock' => $data['stock']]
                ];
            }
        } catch (\Exception $e) {
            $resp['message'] = $e;
        }
        return $resp;

    }

    // private function product_config_stock_update($data)
    // {

    //     $resp = [
    //         'status' => false,
    //         'message' => 'Stock Not Updated',
    //         'data' => null
    //     ];


    //     try {
    //         $ProductConfigModel = new ProductConfigModel();

    //         $isUpdated = $ProductConfigModel->set(['sku' => $data['stock']])
    //             ->where('uid', $data['p_id'])
    //             ->update();
    //         if ($isUpdated == '1') {
    //             $resp = [
    //                 'status' => true,
    //                 'message' => 'Stock Updated',
    //                 'data' => ['updatedStock' => $data['stock']]
    //             ];
    //         }
    //     } catch (\Exception $e) {
    //         $resp['message'] = $e;
    //     }
    //     return $resp;

    // }

    private function product_config_stock_update($data)
    {

        $resp = [
            'status' => false,
            'message' => 'Stock Not Updated',
            'data' => null
        ];


        try {
            $ItemStocksModel = new ItemStocksModel();

            $isUpdated = $ItemStocksModel->set(['stocks' => $data['stock']])
                ->where('uid', $data['item_stock_id'])
                ->update();
            if ($isUpdated == '1') {
                $resp = [
                    'status' => true,
                    'message' => 'Stock Updated',
                    'data' => ['updatedStock' => $data['stock']]
                ];
            }
        } catch (\Exception $e) {
            $resp['message'] = $e;
        }
        return $resp;

    }


    private function discounts_all()
    {
        $resp = [
            'status' => false,
            'message' => 'no discounts found',
            'data' => []
        ];
        try {
            $DiscountsModel = new DiscountsModel();
            $discounts = $DiscountsModel->findAll();
            if (count($discounts) > 0) {
                $resp = [
                    'status' => true,
                    'message' => 'discounts found',
                    'data' => $discounts
                ];
            }
        } catch (\Exception $e) {
            $resp['message'] = $e;
        }
        return $resp;
    }

    private function discounts_add($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Discount Dot Added',
            'data' => []
        ];

        try {
            $DiscountsModel = new DiscountsModel();
            $insert_data = [
                'uid' => $this->generate_uid(UID_DISCOUNTS),
                'name' => $data['title'],
                'minimum_purchase' => $data['minPurchase'],
                'discount_percentage' => $data['discount'],
                'status' => 'active'
            ];
            $isAdded = $DiscountsModel->insert($insert_data);
            if (!empty($isAdded)) {
                $resp = [
                    'status' => true,
                    'message' => 'Discounts Added',
                    'data' => ['discount_id' => $insert_data['uid']]
                ];
            }

        } catch (\Exception $e) {
            $resp['message'] = $e;
        }


        return $resp;
    }

    private function discounts_delete($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Discount Not deleted',
            'data' => []
        ];

        try {
            $DiscountsModel = new DiscountsModel();
            $uid = $data['d_id'];

            $deleted = $DiscountsModel->where('uid', $uid)->delete();
            if ($deleted) {
                $resp['status'] = true;
                $resp['message'] = 'Discount deleted successfully';
            } else {
                $resp['message'] = 'No record found with the given UID';
            }

        } catch (\Exception $e) {
            $resp['message'] = $e->getMessage();
        }


        return $resp;
    }

    private function total_product()
    {
        $resp = [
            'status' => false,
            'message' => 'no product found',
            'data' => 0
        ];
        try {
            $ProductModel = new ProductModel();
            $totalProduct = $ProductModel->countAll();
            if (!empty($totalProduct)) {
                $resp = [
                    'status' => true,
                    'message' => 'Total product found',
                    'data' => $totalProduct
                ];
            }
        } catch (\Exception $e) {
            $resp['message'] = $e;
        }
        return $resp;
    }

    private function best_selling()
    {
        $resp = [
            'status' => false,
            'message' => 'Orders not found',
            'data' => []
        ];

        try {

            $OrderItemsModel = new OrderItemsModel();
            $product = $OrderItemsModel
                ->distinct()
                ->select('product_id')
                ->findAll();
            $all_product_qty = array();
            if (count($product) > 0) {
                $i = 0;
                foreach ($product as $index => $item) {
                    $i++;
                    $quantity = $OrderItemsModel
                    ->select('product_id, qty, order_id, uid')
                    ->where('product_id', $item)
                    ->findAll();
                    $total_qty = 0;
                    foreach ($quantity as $index => $qty) {
                        $total_qty = $total_qty + $qty['qty'];
                    }
                    $all_product_qty[$i]['total_qty'] = $total_qty;
                    $all_product_qty[$i]['product_id'] = $item['product_id'];
                    
                }
                $totalQty = array();
                foreach ($all_product_qty as $key => $row) {
                    $totalQty[$key] = $row['total_qty'];
                }
                array_multisort($totalQty, SORT_DESC, $all_product_qty);
                
                
                foreach ($all_product_qty as $index => $product_qty) {
                    $product_data = $this->products(['p_id' => $product_qty['product_id']]);
                    $all_product_qty[$index]['product_data'] = $product_data['status'] == true ? $product_data['data'] : null;
                }
                // $this->prd($all_product_qty);

                $all_product_qty = json_decode(json_encode($all_product_qty), true);
                // $this->prd($all_product_qty);
            }


            if (count($all_product_qty) > 0) {
                $resp = [
                    'status' => true,
                    'message' => 'Orders found',
                    'data' => $all_product_qty
                ];
            }

        } catch (\Exception $e) {
            // Handle Any Error
            $resp['message'] = $e->getMessage();
        }



        return $resp;
    }

    private function product_img_delete($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Discount Not deleted',
            'data' => []
        ];

        try {
            $ProductImagesModel = new ProductImagesModel();
            $img_id = $data['img_id'];

            $deleted = $ProductImagesModel->where('uid', $img_id)->delete();
            if ($deleted) {
                $resp['status'] = true;
                $resp['message'] = 'Product Image deleted successfully';
            } else {
                $resp['message'] = 'No record found with the given UID';
            }

        } catch (\Exception $e) {
            $resp['message'] = $e->getMessage();
        }


        return $resp;
    }

    private function delete_product($data)
    {
        $response = [
            'status' => false,
            'message' => 'Product deletion failed'
        ];

        try {
            // Extract product ID from data
            $product_id = $data['p_id'];

            // Instantiate ProductModel
            $ProductModel = new ProductModel();
            $ProductItemModel = new ProductItemModel();
            // Delete product using the product ID
            $deleted = $ProductModel->where('uid', $product_id)->delete();
            $deleted = $ProductItemModel->where('product_id', $product_id)->delete();
            // Check if deletion was successful
            if ($deleted) {
                $response['status'] = true;
                $response['message'] = 'Product successfully deleted';
            }
        } catch (\Exception $e) {
            // Handle any errors
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    private function best_selling_item()
    {
        $resp = [
            'status' => false,
            'message' => 'Orders not found',
            'data' => []
        ];

        $seller_id = $this->is_seller_logedin();

        try {

            $OrderItemsModel = new OrderItemsModel();
            $CommonModel = new CommonModel();
            $sql = "SELECT DISTINCT
                order_items.product_id
            FROM
                order_items
            JOIN
                product ON product.uid = order_items.product_id";

            if (!empty($seller_id)) {
                $sql .= " WHERE 
                            product.vendor_id = '{$seller_id}'";
            }

            $product = json_decode(json_encode($CommonModel->customQuery($sql)), true);
            // $this->prd($product);
            $all_product_qty = array();
            if (count($product) > 0) {
                $i = 0;
                foreach ($product as $index => $item) {
                    $i++;
                    $quantity = $OrderItemsModel
                        ->select('product_id, qty, order_id, uid')
                        ->where('product_id', $item)
                        ->findAll();
                    $total_qty = 0;
                    foreach ($quantity as $index => $qty) {
                        $total_qty = $total_qty + $qty['qty'];
                    }
                    $all_product_qty[$i]['total_qty'] = $total_qty;
                    $all_product_qty[$i]['product_id'] = $item['product_id'];

                }
                $totalQty = array();
                foreach ($all_product_qty as $key => $row) {
                    $totalQty[$key] = $row['total_qty'];
                }
                array_multisort($totalQty, SORT_DESC, $all_product_qty);


                foreach ($all_product_qty as $index => $product_qty) {
                    $product_data = $this->products(['p_id' => $product_qty['product_id']]);
                    $all_product_qty[$index]['product_data'] = $product_data['status'] == true ? $product_data['data'] : null;
                }

                $all_product_qty = json_decode(json_encode($all_product_qty), true);
                // $this->prd($all_product_qty);
            }


            if (count($all_product_qty) > 0) {
                $resp = [
                    'status' => true,
                    'message' => 'Orders found',
                    'data' => $all_product_qty
                ];
            }

        } catch (\Exception $e) {
            // Handle Any Error
            $resp['message'] = $e->getMessage();
        }



        return $resp;
    }

    public function search_products($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product not Found',
            'data' => null
        ];

        $CommonModel = new CommonModel();

        // $sql = "SELECT
        //     product.uid AS product_id,
        //     product.name AS name,
        //     product.description AS description,
        //     product.created_at AS created_at,
        //     categories.name AS category,
        //     categories.uid AS category_id,
        //     product_item.uid AS product_item_id,
        //     product_item.price AS base_price,
        //     product_item.sku AS product_stock,
        //     product_item.discount AS base_discount,
        //     product_item.product_tags AS tags,
        //     product_item.publish_date AS publish_date,
        //     product_item.status AS status,
        //     product_item.visibility AS visibility,
        //     product_item.manufacturer_brand AS manufacturer_brand,
        //     product_item.manufacturer_name AS manufacturer_name,
        //     product_meta_detalis.uid AS meta_id,
        //     product_meta_detalis.meta_title,
        //     product_meta_detalis.meta_description,
        //     product_meta_detalis.meta_keywords,
        //     users.user_name AS vendor,
        //     vendor.uid AS vendor_id
        // FROM
        //     product
        // JOIN
        //     product_item ON product.uid = product_item.product_id
        // JOIN
        //     product_meta_detalis ON product.uid = product_meta_detalis.product_id
        // JOIN 
        //     categories ON product.category_id = categories.uid
        // JOIN
        //     vendor ON product.vendor_id = vendor.uid
        // JOIN
        //     users ON vendor.user_id = users.uid";
        // // WHERE
        // //     product.status = 'active'

        // if (!empty($data['alph'])) {
        //     $alph = $data['alph'];
        //     $sql .= " AND
        //         product.name LIKE '%{$alph}%';";

        // } else {
        //     $sql .= ";";
        // }

        $sql = "SELECT
            product.uid AS product_id,
            product.name AS name,
            product.description AS description,
            product.created_at AS created_at,
            categories.name AS category,
            categories.uid AS category_id,
            product_item.uid AS product_item_id,
            product_item.price AS base_price,
            product_item.sku AS product_stock,
            product_item.discount AS base_discount,
            product_item.product_tags AS tags,
            product_item.publish_date AS publish_date,
            product_item.status AS status,
            product_item.visibility AS visibility,
            product_item.quantity,
            product_item.size_chart,
            product_item.manufacturer_brand AS manufacturer_brand,
            product_item.manufacturer_name AS manufacturer_name,
            product_meta_detalis.uid AS meta_id,
            product_meta_detalis.meta_title,
            product_meta_detalis.meta_description,
            product_meta_detalis.meta_keywords,
            users.user_name AS vendor,
            vendor.uid AS vendor_id,
            GROUP_CONCAT(product_size_list.uid) AS size_list_id,
            GROUP_CONCAT(product_size_list.name) AS size_list_name,
            GROUP_CONCAT(product_size_list.size_list) AS size_list
        FROM
            product
        LEFT JOIN
            product_item ON product.uid = product_item.product_id
        LEFT JOIN
            product_meta_detalis ON product.uid = product_meta_detalis.product_id
        LEFT JOIN
            categories ON product.category_id = categories.uid
        LEFT JOIN
            vendor ON product.vendor_id = vendor.uid
        LEFT JOIN
            users ON vendor.user_id = users.uid
        LEFT JOIN
            product_size_list ON product.size_id = product_size_list.uid
        WHERE
            product.status = 'active'";

        if (!empty($data['alph'])) {
            $alph = $data['alph'];
            $sql .= " AND product.name LIKE '%{$alph}%'";
        }

        $sql .= " GROUP BY product.uid;";


        //$this->prd()

        $products = $CommonModel->customQuery($sql);
        // $this->prd($products);
        if (count($products) > 0) {
            $ProductImagesModel = new ProductImagesModel();
            foreach ($products as $key => $product) {
                $products[$key]->product_img = $ProductImagesModel->where('product_id', $product->product_id)->findAll();
            }

            $resp["status"] = true;
            $resp["data"] = !empty($data['p_id']) ? $products[0] : $products;
            $resp["message"] = 'Products Found';
        }
        // $this->prd($resp);
        return $resp;
    }


    private function delete_variant($v_id){
        $response = [
            'status' => false,
            'message' => 'Variation deletion failed'
        ];

        try {
           
            // Instantiate ProductConfigModel
            $ProductConfigModel = new ProductConfigModel();
            // Delete product Config using the Config ID
            $deleted = $ProductConfigModel->where('uid', $v_id)->delete();
            // Check if deletion was successful
            if ($deleted) {
                $response['status'] = true;
                $response['message'] = 'Variation successfully deleted';
            }
        } catch (\Exception $e) {
            // Handle any errors
            $response['message'] = $e->getMessage();
        }
        return $response;


    }

    public function product_config_iamges($config_id){
        $resp = [
            'status' => false,
            'message' => 'config iamges not found',
            'data' => null
        ];

        try{
            $VariantImagesModel = new VariantImagesModel();
        
            $config_iamges =  $VariantImagesModel->where('config_id', $config_id)->findAll();

            $resp = [
                'status' => !empty($config_iamges),
                'message' => !empty($config_iamges) ? 'config iamges found' :'config iamges not found',
                'data' => $config_iamges
            ];

        }catch(\Exception $e) {
            // Handle Any Error
            $resp['message'] = $e->getMessage();
        }

        return $resp;


    }

    private function product_size_lists()
    {

        $resp = [
            "status" => false,
            "message" => "Data Not Found",
            "data" => ""
        ];
        
        $ProductSizeListModel = new ProductSizeListModel();
        $ProductSizeData = $ProductSizeListModel
        ->get()
        ->getResultArray();
        $ProductSizeData = !empty($ProductSizeData) ? $ProductSizeData : '';

        $resp = [
            "status" => true,
            "message" => "Data fetched",
            "data" => $ProductSizeData,
        ];
        return $resp; 
    }

    // For Hot Deals
    public function last_products($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product not Found',
            'data' => null
        ];

        $CommonModel = new CommonModel();

        $sql = "SELECT
            product.uid AS product_id,
            product.name AS name,
            product.description AS description,
            product.created_at AS created_at,
            categories.name AS category,
            categories.uid AS category_id,
            product_item.uid AS product_item_id,
            product_item.price AS base_price,
            product_item.sku AS product_stock,
            product_item.discount AS base_discount,
            product_item.product_tags AS tags,
            product_item.publish_date AS publish_date,
            product_item.status AS status,
            product_item.visibility AS visibility,
            product_item.quantity,
            product_item.size_chart,
            product_item.manufacturer_brand AS manufacturer_brand,
            product_item.manufacturer_name AS manufacturer_name,
            product_meta_detalis.uid AS meta_id,
            product_meta_detalis.meta_title,
            product_meta_detalis.meta_description,
            product_meta_detalis.meta_keywords,
            users.user_name AS vendor,
            vendor.uid AS vendor_id,
            GROUP_CONCAT(product_size_list.uid) AS size_list_id,
            GROUP_CONCAT(product_size_list.name) AS size_list_name,
            GROUP_CONCAT(product_size_list.size_list) AS size_list
        FROM
            product
        LEFT JOIN
            product_item ON product.uid = product_item.product_id
        LEFT JOIN
            product_meta_detalis ON product.uid = product_meta_detalis.product_id
        LEFT JOIN 
            categories ON product.category_id = categories.uid
        LEFT JOIN
            vendor ON product.vendor_id = vendor.uid
        LEFT JOIN
            users ON vendor.user_id = users.uid
        LEFT JOIN
            product_size_list ON product.size_id = product_size_list.uid
        WHERE
            product.status = 'active'
        ORDER BY
            product.created_at DESC
        LIMIT 1";

        if (!empty($data['p_id'])) {
            $p_id = $data['p_id'];
            $sql .= " AND
                product.uid = '{$p_id}';";

        } else if (!empty($data['c_id'])) {
            $c_id = $data['c_id'];
            $sql .= " AND
                product.category_id = '{$c_id}';";

        } else if (!empty($data['v_id'])) {
            $v_id = $data['v_id'];
            $sql .= " AND
                vendor.user_id = '{$v_id}';";
        } else {
            $sql .= ";";
        }


        

        $products = $CommonModel->customQuery($sql);
        // $this->prd($products);
        if (count($products) > 0) {
            $ProductImagesModel = new ProductImagesModel();
            foreach ($products as $key => $product) {
                $products[$key]->product_img = $ProductImagesModel->where('product_id', $product->product_id)->findAll();
            }
            $ItemStocksModel = new ItemStocksModel();
            foreach ($products as $key => $product) {
                $products[$key]->product_sizes = $ItemStocksModel->where('product_id', $product->product_id)->where('varient_id', '')->findAll();
            }

            $ProductPricesModel = new ProductPricesModel();
            foreach ($products as $key => $product) {
                $products[$key]->product_prices = $ProductPricesModel->where('product_id', $product->product_id)->orderBy('CAST(min_qty AS UNSIGNED)', 'ASC')->findAll();
            }

            $user_id = $this->is_logedin();
            $wish_listed_products = [];
            
            if (!empty($user_id)) {
                $WishlistsModel = new WishlistsModel();
                $wish_listed = $WishlistsModel->where('user_id', $user_id)->findAll();
                foreach ($wish_listed as $item) {
                    $wish_listed_products[] = $item['product_id'];
                }
            }
            
            foreach ($products as $key => $product) {
                $products[$key]->is_wishlisted = in_array($product->product_id, $wish_listed_products) ? true : false;
            }

            $resp["status"] = true;
            $resp["data"] = !empty($data['p_id']) ? $products[0] : $products;
            $resp["message"] = 'Hot Deals Found';
        }
        // $this->prd($resp);
        return $resp;
    }

    public function produt_images($data)
    {
        // $this->prd($data);
        $resp = [
            'status' => false,
            'message' => 'Product images not Found',
            'data' => null
        ];
        $ProductImagesModel = new ProductImagesModel();

        $p_images = $ProductImagesModel->where('product_id', $data)->findAll();
        // $this->prd($p_images);
        if (count($p_images) > 0) {

            $resp["status"] = true;
            $resp["data"] = $p_images;
            $resp["message"] = 'Product images Found';
        }
        // $this->prd($resp);
        return $resp;
    }

    private function update_product_images($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product Images not updated',
            'data' => null
        ];
        $uploadedFiles = $this->request->getFiles();
        if (empty($uploadedFiles['imageInput'])) {
            $resp['message'] = 'Please Add Product Images';
        } else if (empty($data['p_id'])) {
            $resp['message'] = 'Product not found';
        } else {

            $ProductImagesModel = new ProductImagesModel();
            foreach ($uploadedFiles['imageInput'] as $file) {
                $file_src = $this->single_upload($file, PATH_PRODUCT_IMG);
                $product_image_data = [
                    'uid' => $this->generate_uid(UID_PRODUCT_IMG),
                    'product_id' => $data['p_id'],
                    'type' => 'path',
                    'src' => $file_src
                ];
                $ProductImagesModel->insert($product_image_data);
            }

            $resp['status'] = true;
            $resp['message'] = 'Product Images updated';
            $resp['data'] = [];
        }
        return $resp;
    }

    private function update_product_description($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product Description not updated',
            'data' => null
        ];
        $uploadedFiles = $this->request->getFiles();
        if (empty($data['description'])) {
            $resp['message'] = 'Please Add Description';
        } else if (empty($data['p_id'])) {
            $resp['message'] = 'Product not found';
        } else {

            $ProductModel = new ProductModel();
           
            $ProductModel->set(['description' => $data['description']])
                ->where('uid', $data['p_id'])
                ->update();

            $resp['status'] = true;
            $resp['message'] = 'Product Description updated';
            $resp['data'] = [];
        }
        return $resp;
    }

    private function update_product_prices($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product Prices not updated',
            'data' => null
        ];

        // $this->prd($data['p_id']);
        if (empty($data['prices'])) {
            $resp['message'] = 'Please Add Prices';
        } else if (empty($data['p_id'])) {
            $resp['message'] = 'Product not found';
        } else {

            $price_range = json_decode($data['prices'], true);
            $ProductPricesModel = new ProductPricesModel();
            $deleted = $ProductPricesModel->where('product_id', $data['p_id'])->delete();
            $item_prices = [];
            foreach($price_range as $i => $p_range){
                $item_prices[] = [
                    'uid' => $this->generate_uid('PROPRIC'),
                    'product_id' => $data['p_id'],
                    'min_qty' => $p_range['min'],
                    'max_qty' => $p_range['max'],
                    'price' => $p_range['price'],
                ];
            }

            $ProductPricesModel->transStart();
            try {
                $ProductPricesModel->insertBatch($item_prices);
                $ProductPricesModel->transCommit();
            } catch (\Exception $e) {
                // Rollback the transaction if an error occurs
                $ProductPricesModel->transRollback();
                $resp['message'] = $e->getMessage();
            }


            $resp['status'] = true;
            $resp['message'] = 'Product Prices updated';
            $resp['data'] = [];
        }
        return $resp;
    }


    private function expart_review_add($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Review Not Added',
            'data' => []
        ];


        $uploadedFiles = $this->request->getFiles();

        if (empty($data['productId'])) {
            $resp['message'] = 'Please Select A Product';
        } else if (empty($data['userName'])) {
            $resp['message'] = 'Please Add User Name';
        } else if (empty($data['rateing'])) {
            $resp['message'] = 'Please Add Product Rateing';
        } else if (empty($data['review'])) {
            $resp['message'] = 'Please Add Product Review';
        } else if (empty($uploadedFiles['images'])) {
            $resp['message'] = 'Please Add User Image';
        } else {

            try {
                $ExpartReviewModel = new ExpartReviewModel();
                $insert_data = [
                    'uid' => $this->generate_uid('EXRIV'),
                    'product_id' => $data['productId'],
                    'varient_id' => '',
                    'name' => $data['userName'],
                    'rateing' => $data['rateing'],
                    'review' => $data['review'],
                ];

                foreach ($uploadedFiles['images'] as $file) {
                    $file_src = $this->single_upload($file, PATH_USER_IMG);
                    $insert_data['img'] = $file_src;
                }

                $isAdded = $ExpartReviewModel->insert($insert_data);

                if (!empty($isAdded)) {
                    $resp = [
                        'status' => true,
                        'message' => 'Review Added',
                        'data' => []
                    ];
                }

            } catch (\Exception $e) {
                $resp['message'] = $e;
            }
        }

        return $resp;
    }

    public function expart_reviews($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Reviews not Found',
            'data' => null
        ];

        $CommonModel = new CommonModel();

        $sql = "SELECT
            expart_review.uid AS expart_review_id,
            expart_review.name AS user_name,
            expart_review.img AS user_img,
            expart_review.rateing,
            expart_review.review,
            expart_review.created_at,
            product.uid AS product_id,
            product.name AS product_name
        FROM
            expart_review
        JOIN
            product ON product.uid = expart_review.product_id";

        if (!empty($data['p_id'])) {
            $p_id = $data['p_id'];
            $sql .= " WHERE
                expart_review.product_id = '{$p_id}';";
        } else if (!empty($data['er_id'])) {
            $er_id = $data['er_id'];
            $sql .= " WHERE
                expart_review.uid = '{$er_id}';";
        } else {
            $sql .= ";";
        }


        //$this->prd()

        $reviews = $CommonModel->customQuery($sql);

        if (count($reviews) > 0) {

            $resp["status"] = true;
            $resp["data"] = !empty($data['p_id']) || !empty($data['er_id']) ? $reviews[0] : $reviews;
            $resp["message"] = 'Review Found';
        }
        // $this->prd($resp);
        return $resp;
    }

    private function review_add($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Review Not Added',
            'data' => []
        ];


        $uploadedFiles = $this->request->getFiles();

        if (empty($data['rateing'])) {
            $resp['message'] = 'Please Add Product Rateing';
        } else if (empty($data['review'])) {
            $resp['message'] = 'Please Add A Note';
        } else if (empty($data['productId'])) {
            $resp['message'] = 'Product Not Found';
        } else if (empty($data['userId'])) {
            $resp['message'] = 'User Not Found. Please Login.';
        } else {

            try {
                $ReviewModel = new ReviewModel();
                $insert_data = [
                    'uid' => $this->generate_uid('RIV'),
                    'product_id' => $data['productId'],
                    'user_id' => $data['userId'],
                    'rateing' => $data['rateing'],
                    'review' => $data['review'],
                    'status' => 'approved',
                ];

                $isAdded = $ReviewModel->insert($insert_data);

                if (!empty($isAdded)) {
                    $resp = [
                        'status' => true,
                        'message' => 'Review Added',
                        'data' => []
                    ];
                }

            } catch (\Exception $e) {
                $resp['message'] = $e;
            }
        }

        return $resp;
    }

    public function reviews($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Reviews not Found',
            'data' => null
        ];

        $CommonModel = new CommonModel();

        $sql = "SELECT
            review.uid AS review_id,
            review.rateing,
            review.review,
            review.status,
            review.created_at,
            product.uid AS product_id,
            product.name AS product_name,
            users.uid AS user_id,
            users.user_name,
            user_img.img
        FROM
            review
        JOIN
            product ON product.uid = review.product_id
        JOIN
            users ON users.uid = review.user_id
        JOIN
            user_img ON user_img.user_id = review.user_id";

        if (!empty($data['p_id'])) {
            $p_id = $data['p_id'];
            $sql .= " WHERE
                expart_review.product_id = '{$p_id}';";
        } else if (!empty($data['user_id'])) {
            $user_id = $data['user_id'];
            $sql .= " WHERE
                users.uid = '{$user_id}';";
        } else if (!empty($data['review_id'])) {
            $review_id = $data['review_id'];
            $sql .= " WHERE
                review.uid = '{$review_id}';";
        } else {
            $sql .= ";";
        }


        //$this->prd()

        $reviews = $CommonModel->customQuery($sql);

        if (count($reviews) > 0) {

            $resp["status"] = true;
            $resp["data"] = !empty($data['p_id']) || !empty($data['user_id']) || !empty($data['review_id']) ? $reviews[0] : $reviews;
            $resp["message"] = 'Review Found';
        }
        // $this->prd($resp);
        return $resp;
    }

    private function preview_status_update($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Status Not Updated',
            'data' => null
        ];


        try {
            $ReviewModel = new ReviewModel();

            $isUpdated = $ReviewModel->set(['status' => $data['status']])
                ->where('uid', $data['review_id'])
                ->update();
            if ($isUpdated == '1') {
                $resp = [
                    'status' => true,
                    'message' => 'Status Updated',
                    'data' => []
                ];
            }
        } catch (\Exception $e) {
            $resp['message'] = $e;
        }
        return $resp;

    }

    private function expart_review_delete($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Discount Not deleted',
            'data' => []
        ];

        try {
            $ExpartReviewModel = new ExpartReviewModel();

            $deleted = $ExpartReviewModel->where('uid', $data['er_id'])->delete();
            if ($deleted) {
                $resp['status'] = true;
                $resp['message'] = 'Expart Review deleted successfully';
            } else {
                $resp['message'] = 'No record found with the given UID';
            }

        } catch (\Exception $e) {
            $resp['message'] = $e->getMessage();
        }


        return $resp;
    }

    public function reviews_users($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Reviews not Found',
            'data' => null
        ];

        $CommonModel = new CommonModel();

        $sql = "SELECT
            review.uid AS review_id,
            review.rateing,
            review.review,
            review.status,
            review.created_at,
            product.uid AS product_id,
            product.name AS product_name,
            users.uid AS user_id,
            users.user_name,
            user_img.img
        FROM
            review
        JOIN
            product ON product.uid = review.product_id
        JOIN
            users ON users.uid = review.user_id
        JOIN
            user_img ON user_img.user_id = review.user_id
        WHERE
            review.status = 'approved'";

        if (!empty($data['p_id'])) {
            $p_id = $data['p_id'];
            $sql .= " AND
                review.product_id = '{$p_id}';";
        } else if (!empty($data['user_id'])) {
            $user_id = $data['user_id'];
            $sql .= " AND
                users.uid = '{$user_id}';";
        } else if (!empty($data['review_id'])) {
            $review_id = $data['review_id'];
            $sql .= " AND
                review.uid = '{$review_id}';";
        } else {
            $sql .= ";";
        }


        //$this->prd()

        $reviews = $CommonModel->customQuery($sql);

        if (count($reviews) > 0) {

            $resp["status"] = true;
            $resp["data"] = $reviews;
            $resp["message"] = 'Review Found';
        }
        // $this->prd($resp);
        return $resp;
    }

    private function add_wishlist($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Review Not Added',
            'data' => []
        ];


        $uploadedFiles = $this->request->getFiles();

        if (empty($data['user_id'])) {
            $resp['message'] = 'User Not Found!';
        } else if (empty($data['product_id'])) {
            $resp['message'] = 'Product not found!';
        } else {

            $WishlistsModel = new WishlistsModel();
            $is_exist = $WishlistsModel->where('user_id', $data['user_id'])->where('product_id', $data['product_id'])->first();
            if(!empty($is_exist)){
                $removeProduct = $WishlistsModel->where('user_id', $data['user_id'])->where('product_id', $data['product_id'])->delete();
                if (!empty($removeProduct)) {
                    $resp = [
                        'status' => true,
                        'message' => 'Product Removed From WishList',
                        'data' => 'removed'
                    ];
                }
            } else{
                try {
                
                    $insert_data = [
                        'uid' => $this->generate_uid('WISLST'),
                        'user_id' => $data['user_id'],
                        'product_id' => $data['product_id']
                    ];
    
                    $isAdded = $WishlistsModel->insert($insert_data);
    
                    if (!empty($isAdded)) {
                        $resp = [
                            'status' => true,
                            'message' => 'Product Added To WishList',
                            'data' => 'added'
                        ];
                    }
    
                } catch (\Exception $e) {
                    $resp['message'] = $e;
                }
            }
            
        }

        return $resp;
    }

    public function wishlists($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product not Found',
            'data' => null
        ];
        // $product_id = $data['product_id'];
        $user_id = $data['user_id'];

        $CommonModel = new CommonModel();

        $sql = "SELECT
            wishlists.uid,
            product.uid AS product_id,
            product.name AS name,
            product.description AS description,
            product.created_at AS created_at,
            categories.name AS category,
            categories.uid AS category_id,
            product_item.uid AS product_item_id,
            product_item.price AS base_price,
            product_item.sku AS product_stock,
            product_item.discount AS base_discount,
            product_item.product_tags AS tags,
            product_item.publish_date AS publish_date,
            product_item.status AS status,
            product_item.visibility AS visibility,
            product_item.quantity,
            product_item.size_chart,
            product_item.manufacturer_brand AS manufacturer_brand,
            product_item.manufacturer_name AS manufacturer_name,
            product_meta_detalis.uid AS meta_id,
            product_meta_detalis.meta_title,
            product_meta_detalis.meta_description,
            product_meta_detalis.meta_keywords,
            users.user_name AS vendor,
            vendor.uid AS vendor_id,
            GROUP_CONCAT(product_size_list.uid) AS size_list_id,
            GROUP_CONCAT(product_size_list.name) AS size_list_name,
            GROUP_CONCAT(product_size_list.size_list) AS size_list
        FROM
            wishlists
        LEFT JOIN
            product ON wishlists.product_id = product.uid
        LEFT JOIN
            product_item ON product.uid = product_item.product_id
        LEFT JOIN
            product_meta_detalis ON product.uid = product_meta_detalis.product_id
        LEFT JOIN 
            categories ON product.category_id = categories.uid
        LEFT JOIN
            vendor ON product.vendor_id = vendor.uid
        LEFT JOIN
            users ON vendor.user_id = users.uid
        LEFT JOIN
            product_size_list ON product.size_id = product_size_list.uid
        WHERE
            wishlists.user_id = '{$user_id}'
        AND
            product.status = 'active'";

        // Applying conditions based on provided data
       

        $sql .= " GROUP BY product.uid;";


        
        //$this->prd()

        $products = $CommonModel->customQuery($sql);
        // $this->prd($products);
        if (count($products) > 0) {
            $ProductImagesModel = new ProductImagesModel();
            foreach ($products as $key => $product) {
                $products[$key]->product_img = $ProductImagesModel->where('product_id', $product->product_id)->findAll();
            }
            $ItemStocksModel = new ItemStocksModel();
            foreach ($products as $key => $product) {
                $products[$key]->product_sizes = $ItemStocksModel->where('product_id', $product->product_id)->where('varient_id', '')->findAll();
            }

            $ProductPricesModel = new ProductPricesModel();
            foreach ($products as $key => $product) {
                $products[$key]->product_prices = $ProductPricesModel->where('product_id', $product->product_id)->orderBy('CAST(min_qty AS UNSIGNED)', 'ASC')->findAll();
            }

            $resp["status"] = true;
            $resp["data"] = !empty($data['p_id']) ? $products[0] : $products;
            $resp["message"] = 'Products Found';
        }
        // $this->prd($resp);
        return $resp;
    }
    
    private function increase_product_click_count($data)
    {
        $resp = [
            "status" => false,
            "message" => "Failed to increase click.",
            "data" => []
        ];

        try {
            if (empty($data['product_id'])) {
                $resp['message'] = 'Product not found!';
            } else {

                // $updateClickCount = [
                //     "click_count" => +1,
                // ];
                $ProductModel = new ProductModel();
                $isUserUpdated = $ProductModel->where(['uid' => $data['product_id']])->increment('click_count', 1);
                if($isUserUpdated){
                        $resp['status'] = true;
                        $resp['message'] = 'Click Increase successfully';
                        $resp['data'] = "";
                    
                }
                
            }

        } catch (\Exception $e) {
            // Catch any exceptions and set error message
            $resp['message'] = $e->getMessage();
        }

        return $resp;
    }


    public function most_click_product($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product not Found',
            'data' => null
        ];
        $CommonModel = new CommonModel();
        $sql = "SELECT
            product.uid AS product_id,
            product.name AS name,
            product.description AS description,
            product.created_at AS created_at,
            categories.name AS category,
            categories.uid AS category_id,
            product_item.uid AS product_item_id,
            product_item.price AS base_price,
            product_item.sku AS product_stock,
            product_item.discount AS base_discount,
            product_item.product_tags AS tags,
            product_item.publish_date AS publish_date,
            product_item.status AS status,
            product_item.visibility AS visibility,
            product_item.quantity,
            product_item.size_chart,
            product_item.manufacturer_brand AS manufacturer_brand,
            product_item.manufacturer_name AS manufacturer_name,
            product_meta_detalis.uid AS meta_id,
            product_meta_detalis.meta_title,
            product_meta_detalis.meta_description,
            product_meta_detalis.meta_keywords,
            users.user_name AS vendor,
            vendor.uid AS vendor_id,
            GROUP_CONCAT(product_size_list.uid) AS size_list_id,
            GROUP_CONCAT(product_size_list.name) AS size_list_name,
            GROUP_CONCAT(product_size_list.size_list) AS size_list
        FROM
            product
        LEFT JOIN
            product_item ON product.uid = product_item.product_id
        LEFT JOIN
            product_meta_detalis ON product.uid = product_meta_detalis.product_id
        LEFT JOIN 
            categories ON product.category_id = categories.uid
        LEFT JOIN
            vendor ON product.vendor_id = vendor.uid
        LEFT JOIN
            users ON vendor.user_id = users.uid
        LEFT JOIN
            product_size_list ON product.size_id = product_size_list.uid";

        // Applying conditions based on provided data
        $whereConditions = [];

        $whereConditions[] = "product.status = 'active'";

        if (!empty($data['p_id'])) {
            $whereConditions[] = "product.uid = '{$data['p_id']}'";
        }

        if (!empty($data['c_id'])) {
            $whereConditions[] = "product.category_id = '{$data['c_id']}'";
        }

        if (!empty($data['vendor_id'])) {
            $whereConditions[] = "product.vendor_id = '{$data['vendor_id']}'";
        }

        if (!empty($data['v_id'])) {
            $whereConditions[] = "vendor.uid = '{$data['v_id']}'";
        }

        // Add conditions to the SQL query if any exist
        if (!empty($whereConditions)) {
            $sql .= " WHERE " . implode(" AND ", $whereConditions);
        }

        $sql .= " GROUP BY product.uid";
        $sql .= " ORDER BY product.click_count DESC";



        
        //$this->prd()

        $products = $CommonModel->customQuery($sql);
        // $this->prd($products);
        if (count($products) > 0) {
            $ProductImagesModel = new ProductImagesModel();
            foreach ($products as $key => $product) {
                $products[$key]->product_img = $ProductImagesModel->where('product_id', $product->product_id)->findAll();
            }
            $ItemStocksModel = new ItemStocksModel();
            foreach ($products as $key => $product) {
                $products[$key]->product_sizes = $ItemStocksModel->where('product_id', $product->product_id)->where('varient_id', '')->findAll();
            }

            $ProductPricesModel = new ProductPricesModel();
            foreach ($products as $key => $product) {
                $products[$key]->product_prices = $ProductPricesModel->where('product_id', $product->product_id)->orderBy('CAST(min_qty AS UNSIGNED)', 'ASC')->findAll();
            }

            $user_id = $this->is_logedin();
            $wish_listed_products = [];
            
            if (!empty($user_id)) {
                $WishlistsModel = new WishlistsModel();
                $wish_listed = $WishlistsModel->where('user_id', $user_id)->findAll();
                foreach ($wish_listed as $item) {
                    $wish_listed_products[] = $item['product_id'];
                }
            }
            
            foreach ($products as $key => $product) {
                $products[$key]->is_wishlisted = in_array($product->product_id, $wish_listed_products) ? true : false;
            }

            $resp["status"] = true;
            $resp["data"] = !empty($data['p_id']) ? $products[0] : $products;
            $resp["message"] = 'Products Found';
        }
        // $this->prd($resp);
        return $resp;
    }

    public function best_selling_products($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product not Found',
            'data' => null
        ];

        $BestSellingVendorModel = new BestSellingVendorModel();
        $CommonModel = new CommonModel();
        $vendors = $BestSellingVendorModel->findAll();
        foreach($vendors as $index => $vendor){
            $vendor_id = $vendor['vendor_id'];
            $sql = "SELECT
                product.uid AS product_id,
                product.name AS name,
                product.description AS description,
                product.created_at AS created_at,
                categories.name AS category,
                categories.uid AS category_id,
                product_item.uid AS product_item_id,
                product_item.price AS base_price,
                product_item.sku AS product_stock,
                product_item.discount AS base_discount,
                product_item.product_tags AS tags,
                product_item.publish_date AS publish_date,
                product_item.status AS status,
                product_item.visibility AS visibility,
                product_item.quantity,
                product_item.size_chart,
                product_item.manufacturer_brand AS manufacturer_brand,
                product_item.manufacturer_name AS manufacturer_name,
                product_meta_detalis.uid AS meta_id,
                product_meta_detalis.meta_title,
                product_meta_detalis.meta_description,
                product_meta_detalis.meta_keywords,
                users.user_name AS vendor,
                vendor.uid AS vendor_id,
                GROUP_CONCAT(product_size_list.uid) AS size_list_id,
                GROUP_CONCAT(product_size_list.name) AS size_list_name,
                GROUP_CONCAT(product_size_list.size_list) AS size_list
            FROM
                product
            LEFT JOIN
                product_item ON product.uid = product_item.product_id
            LEFT JOIN
                product_meta_detalis ON product.uid = product_meta_detalis.product_id
            LEFT JOIN 
                categories ON product.category_id = categories.uid
            LEFT JOIN
                vendor ON product.vendor_id = vendor.uid
            LEFT JOIN
                users ON vendor.user_id = users.uid
            LEFT JOIN
                product_size_list ON product.size_id = product_size_list.uid
            WHERE
                product.vendor_id = '{$vendor_id}'
            AND
                product.status = 'active'
            GROUP BY
                product.uid
            LIMIT 5;";

            // Applying conditions based on provided data
            // $sql .= " GROUP BY product.uid;";

            //$this->prd()

            $vendors[$index]['products'] = $CommonModel->customQuery($sql);
            // $this->prd($products);
            if (count($vendors[$index]['products']) > 0) {
                $ProductImagesModel = new ProductImagesModel();
                foreach ($vendors[$index]['products'] as $key => $product) {
                    $vendors[$index]['products'][$key]->product_img = $ProductImagesModel->where('product_id', $product->product_id)->findAll();
                }
                $ItemStocksModel = new ItemStocksModel();
                foreach ($vendors[$index]['products'] as $key => $product) {
                    $vendors[$index]['products'][$key]->product_sizes = $ItemStocksModel->where('product_id', $product->product_id)->where('varient_id', '')->findAll();
                }

                $ProductPricesModel = new ProductPricesModel();
                foreach ($vendors[$index]['products'] as $key => $product) {
                    $vendors[$index]['products'][$key]->product_prices = $ProductPricesModel->where('product_id', $product->product_id)->orderBy('CAST(min_qty AS UNSIGNED)', 'ASC')->findAll();
                }

                $user_id = $this->is_logedin();
                $wish_listed_products = [];
                
                if (!empty($user_id)) {
                    $WishlistsModel = new WishlistsModel();
                    $wish_listed = $WishlistsModel->where('user_id', $user_id)->findAll();
                    foreach ($wish_listed as $item) {
                        $wish_listed_products[] = $item['product_id'];
                    }
                }
                
                foreach ($vendors[$index]['products'] as $key => $product) {
                    $vendors[$index]['products'][$key]->is_wishlisted = in_array($product->product_id, $wish_listed_products) ? true : false;
                }
                $resp["status"] = true;
                $resp["data"] = $vendors;
                $resp["message"] = 'Products Found';
            }
        }
        
        // $this->prd($resp);
        return $resp;
    }

    private function remove_wishlist($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Review Not Added',
            'data' => []
        ];
        
        if (empty($data['wishlist_id'])) {
            $resp['message'] = 'Product Not Found!';
        } else {
            
            $WishlistsModel = new WishlistsModel();
            $removeProduct = $WishlistsModel->where('uid', $data['wishlist_id'])->delete();
            // $this->prd($removeProduct);
            if (!empty($removeProduct)) {
                $resp = [
                    'status' => true,
                    'message' => 'Product Removed From WishList',
                    'data' => 'removed'
                ];
            }
        }

        return $resp;
    }

    private function product_status_update($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Status Not Updated',
            'data' => null
        ];

        if(empty($data['product_id'])){
            $resp['message'] = 'Product Not Found.';
        } else if(empty($data['status'])){
            $resp['message'] = 'Please Select A Status.';
        } else {
            try {
                $ProductModel = new ProductModel();
                $isUpdated = $ProductModel->set(['status' => $data['status']])
                    ->where('uid', $data['product_id'])
                    ->update();
                if ($isUpdated) {
                    if($data['status'] == 'deactive'){
                        $UserCartModel = new UserCartModel();
                        $WishlistsModel = new WishlistsModel();
                        $UserCartModel->where('product_id', $data['product_id'])->delete();
                        $WishlistsModel->where('product_id', $data['product_id'])->delete();
                    }
                    $resp = [
                        'status' => true,
                        'message' => 'Status Updated',
                        'data' => []
                    ];
                }
            } catch (\Exception $e) {
                $resp['message'] = $e;
            }
        }
        
        return $resp;

    }



















    public function POST_product_bulk_update()
    {
        $data = $this->request->getPost();
        $resp = $this->product_bulk_update($data);
        return $this->response->setJSON($resp);
    }

    public function POST_add_product_excel()
    {
        $data = $this->request->getPost();
        $resp = $this->add_product_excel($data);
        return $this->response->setJSON($resp);
    }

    public function POST_product_status_update()
    {
        $data = $this->request->getPost();
        $resp = $this->product_status_update($data);
        return $this->response->setJSON($resp);
    }

    public function POST_increase_product_click_count()
    {
        $data = $this->request->getPost();
        $resp = $this->increase_product_click_count($data);
        return $this->response->setJSON($resp);
    }

    public function GET_remove_wishlist()
    {
        $data = $this->request->getGet();
        $resp = $this->remove_wishlist($data);
        return $this->response->setJSON($resp);
    }

    public function GET_wishlists()
    {
        $data = $this->request->getGet();
        $resp = $this->wishlists($data);
        return $this->response->setJSON($resp);
    }

    public function GET_best_selling_products()
    {
        $data = $this->request->getGet();
        $resp = $this->best_selling_products($data);
        return $this->response->setJSON($resp);
    }

    public function GET_most_click_product()
    {
        $data = $this->request->getGet();
        $resp = $this->most_click_product($data);
        return $this->response->setJSON($resp);
    }

    public function POST_add_wishlist()
    {
        $data = $this->request->getPost();
        $resp = $this->add_wishlist($data);
        return $this->response->setJSON($resp);
    }

    public function POST_update_product_prices()
    {
        $data = $this->request->getPost();
        $resp = $this->update_product_prices($data);
        return $this->response->setJSON($resp);
    }

    public function GET_produt_images()
    {
        $data = $this->request->getGet('p_id');
        $resp = $this->produt_images($data);
        return $this->response->setJSON($resp);
    }

    public function POST_update_product_images()
    {
        $data = $this->request->getPost();
        $resp = $this->update_product_images($data);
        return $this->response->setJSON($resp);

    }

    public function POST_update_product_description()
    {
        $data = $this->request->getPost();
        $resp = $this->update_product_description($data);
        return $this->response->setJSON($resp);

    }

    public function POST_add_product_bulk()
    {
        $data = $this->request->getPost();
        // $this->prd($data);
        // $data = $this->request->getJSON();
        $resp = $this->add_bulk_product($data);
        return $this->response->setJSON($resp);
    }

    public function GET_delete_variant()
    {
        $v_id = $this->request->getGet('v_id');

        $resp = $this->delete_variant($v_id);
        return $this->response->setJSON($resp);
    }

    public function GET_product_size_lists()
    {
        $resp = $this->product_size_lists();
        return $this->response->setJSON($resp);
    }


    public function GET_delete_product()
    {
        $data = $this->request->getGet();

        $resp = $this->delete_product($data);
        return $this->response->setJSON($resp);
    }



    public function GET_discounts_delete()
    {
        $data = $this->request->getGet();

        $resp = $this->discounts_delete($data);
        return $this->response->setJSON($resp);
    }

    public function GET_product_img_delete()
    {
        $data = $this->request->getGet();

        $resp = $this->product_img_delete($data);
        return $this->response->setJSON($resp);
    }

    public function GET_product_config_stock_update()
    {
        $data = $this->request->getGet();

        $resp = $this->product_config_stock_update($data);
        return $this->response->setJSON($resp);
    }

    public function GET_product_stock_update()
    {
        $data = $this->request->getGet();

        $resp = $this->product_stock_update($data);
        return $this->response->setJSON($resp);
    }


    public function GET_user_id()
    {
        $resp = $this->user_id();
        return $this->response->setJSON($resp);
    }

    public function GET_product()
    {
        $data = $this->request->getGet();

        $resp = $this->products($data);
        return $this->response->setJSON($resp);
    }

    public function GET_letest_arrival_products()
    {
        $data = $this->request->getGet();

        $resp = $this->letest_arrival_products($data);
        return $this->response->setJSON($resp);
    }

    public function GET_search_products()
    {
        $data = $this->request->getGet();

        $resp = $this->search_products($data);
        return $this->response->setJSON($resp);
    }

    public function POST_add_product()
    {
        $data = $this->request->getPost();
        $resp = $this->add_product($data);
        return $this->response->setJSON($resp);

    }
    public function GET_variation_options()
    {
        $resp = $this->variation_options();
        return $this->response->setJSON($resp);

    }

    public function POST_update_product()
    {
        $data = $this->request->getPost();
        $resp = $this->update_product($data);
        return $this->response->setJSON($resp);
    }


    public function POST_add_new_variant()
    {
        $data = $this->request->getPost();
        $resp = $this->add_new_variant($data);
        return $this->response->setJSON($resp);
    }

    public function GET_variation()
    {
        $p_id = $this->request->getGet('p_id');
        $resp = $this->variation($p_id);
        return $this->response->setJSON($resp);
    }


    public function GET_discounts_all()
    {
        $resp = $this->discounts_all();
        return $this->response->setJSON($resp);
    }

    public function POST_discounts_add()
    {

        $data = $this->request->getPost();
        $resp = $this->discounts_add($data);
        return $this->response->setJSON($resp);

    }

    public function GET_total_product()
    {
        $resp = $this->total_product();
        return $this->response->setJSON($resp);
    }

    public function GET_best_selling()
    {
        $resp = $this->best_selling();
        return $this->response->setJSON($resp);
    }

    public function GET_best_selling_item()
    {
        $resp = $this->best_selling_item();
        return $this->response->setJSON($resp);
    }

    public function GET_last_products()
    {
        $data = $this->request->getGet();

        $resp = $this->last_products($data);
        return $this->response->setJSON($resp);
    }

    public function POST_expart_review_add()
    {
        $data = $this->request->getPost();
        $resp = $this->expart_review_add($data);
        return $this->response->setJSON($resp);

    }

    public function POST_review_add()
    {
        $data = $this->request->getPost();
        $resp = $this->review_add($data);
        return $this->response->setJSON($resp);

    }

    public function GET_expart_review_delete()
    {

        $data = $this->request->getGet();

        $resp = $this->expart_review_delete($data);
        return $this->response->setJSON($resp);

    }

    public function GET_reviews_users()
    {

        $data = $this->request->getGet();

        $resp = $this->reviews_users($data);
        return $this->response->setJSON($resp);

    }

    public function GET_expart_reviews()
    {
        $data = $this->request->getGet();
        $resp = $this->expart_reviews($data);
        return $this->response->setJSON($resp);
    }

    public function GET_reviews()
    {
        $data = $this->request->getGet();
        $resp = $this->reviews($data);
        return $this->response->setJSON($resp);
    }

    public function GET_preview_status_update()
    {

        $data = $this->request->getGet();

        $resp = $this->preview_status_update($data);
        return $this->response->setJSON($resp);

    }

}