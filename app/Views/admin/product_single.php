<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Products</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                            <li class="breadcrumb-item">Products</li>
                            <li class="breadcrumb-item active">Variants</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="fs-16">Product</h5>
                            </div>
                            <div class="flex">
                                <!-- <a href="<?= base_url('/admin/product/view?p_id='.$_GET['p_id'])?>" class="btn btn-success ">
                                    <i class="ri ri-eye-line"></i>
                                </a> -->
                                <!-- <a href="<?= base_url('/admin/product/update?p_id='.$_GET['p_id'])?>" class="btn btn-secondary">
                                    <i class="ri ri-edit-line"></i>
                                </a> -->
                                <a href="javascript:void(0)" onclick="delete_product('<?= $_GET['p_id']?>')" class="btn btn-danger ">
                                    <i class="ri ri-delete-bin-line"></i>
                                </a>
                            </div>
                        </div>


                    </div>

                    <div class="card-body">
                    <!-- <table class="table">
                            <thead>
                                <th>Add Stock</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="number" placeholder="stock amount" id="stock_qty" class="form-control">
                                    </td>
                                    <td>
                                        <button class="btn btn-success" id="add_stock_btn">Add</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table> -->
                        <div id="carouselExampleControls" class="carousel slide carousel-containner" data-bs-ride="carousel">
                            <div class="carousel-inner" id="product_images">
                                <!-- <div class="carousel-item active">
                                    <img src="https://via.placeholder.com/800x400?text=First+Slide" class="d-block w-100" alt="First Slide">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://via.placeholder.com/800x400?text=Second+Slide" class="d-block w-100" alt="Second Slide">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://via.placeholder.com/800x400?text=Third+Slide" class="d-block w-100" alt="Third Slide">
                                </div> -->
                            </div>
                            <button class="carousel-control-prev custom-carousel-button" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev" style="color: blue;">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next custom-carousel-button" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="download-container" id="vendor_authorization_letter">
                            <!-- <div class="content-box">
                                <p>Vendor Authorization Letter.</p>
                            </div>
                            <a href="path/to/your/file.pdf" class="download-btn" download="filename.pdf">Download</a>
                            <p class="description">This is a description about the content above. Click the download button to get the file.</p> -->
                        </div>

                        <table class="table">
                            <tbody id="product_details">
                                <tr>
                                    <td>id</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Category</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Discount</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Final Price</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Total Stock</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Sold</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

            <div class="col-xl-6 col-lg-6">
                <div>
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex  align-items-center">
                                <div class="flex-grow-1">
                                    <h5 class="fs-16">All Product Variants</h5>
                                </div>
                                <div class="flex-shrink-0 p-2" id="back_to_edit">
                                    <!-- <a href="<?= base_url('/admin/product/bulk/edit') ?>"
                                        class="btn btn-warning"><i class="arrow-left">&#8592;</i>Back to edit</a> -->
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="<?= base_url('/admin/product/variant/add?p_id=' . $_GET['p_id']) ?>"
                                        class="btn btn-success">Add Variant</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="table-product-variant" class="table nowrap align-middle table-hover"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <!-- <th>Price</th>
                                        <th>discount</th>
                                        <th>Final Price</th> -->
                                        <!-- <th>Sizes</th> -->
                                        <th>Sizes & Stock</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="table-product-variant-body">

                                </tbody>
                            </table>



                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
    <!-- container-fluid -->
</div>