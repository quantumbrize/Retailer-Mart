<script>
    const urlParams = new URLSearchParams(window.location.search);
    const editParam = urlParams.get('edit');
    if (editParam === '1') {
        // console.log("Edit parameter exists and is set to 1");
        $('#back_to_edit').html(`<a href="<?= base_url('/admin/product/bulk/edit') ?>"
                                class="btn btn-warning"><i class="arrow-left">&#8592;</i>Back to edit</a>`)
    }
    function calculateFinalPrice(originalPrice, discountPercentage) {
        // Calculate the discount amount
        var discountAmount = (originalPrice * discountPercentage) / 100;

        // Calculate the final price after applying the discount
        var finalPrice = originalPrice - discountAmount;

        // Return the final price
        return finalPrice;
    }
    function updateStock(product_id, type) {
        let stock = parseInt($(`#input-stock-${product_id}`).val())
        stock = type == 'add' ? stock + 1 : stock - 1;
        if(stock >= 0){
            $.ajax({
                url: "<?= base_url('/api/product/variant/stock/update') ?>",
                type: "GET",
                data: {
                    item_stock_id: product_id,
                    stock: stock
                },
                beforeSend: function () {
                    $(`#btn-stock-add-${product_id}`).attr('disabled', true)
                    $(`#btn-stock-sub-${product_id}`).attr('disabled', true)
                },
                success: function (resp) {
                    $(`#btn-stock-add-${product_id}`).attr('disabled', false)
                    $(`#btn-stock-sub-${product_id}`).attr('disabled', false)
                    if (resp.status) {
                        $(`#input-stock-${product_id}`).val(stock)
                        $('#alert').html(`<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                                            <i class="ri-checkbox-circle-fill label-icon"></i><strong>${resp.message}</strong>
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>`)
                    }
                },
                error: function (err) {
                    console.log(err)
                    $(`#btn-stock-add-${product_id}`).attr('disabled', false)
                    $(`#btn-stock-sub-${product_id}`).attr('disabled', false)
                    $('#alert').html(`<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                                        <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Internal Server Error
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>`)
                }
            })
        }
            

    }
   

        get_product_data('<?= $_GET['p_id'] ?>');

        var product;

        function get_product_data(p_id) {
            $.ajax({
                url: "<?= base_url('/api/product') ?>",
                type: 'GET',
                data: {
                    p_id: p_id
                },
                beforeSend: function () { },
                success: function (resp) {
                    console.log(resp);
                    if (resp.status) {
                        product = resp.data;
                        let load_sizes = ``
                        let all_price_list = ``
                        $.each(product.product_sizes, function (Index, p_size) {
                            load_sizes += `<tr>
                                            <td>${p_size.sizes}</td>
                                            <td style="text-align: right">
                                            <div class="input-group stock_number_bx" style="flex-flow: row">
                                            <span class="input-group-btn btn-number">
                                                <button 
                                                    type="button" 
                                                    class="quantity-left-minus btn btn-danger btn-number"
                                                    data-type="minus" 
                                                    data-field=""
                                                    id="btn-stock-sub-${p_size.uid}"
                                                    onClick="updateStock('${p_size.uid}','sub')">
                                                    <span>-</span>
                                                </button>
                                            </span>
                                            <input 
                                                type="text" 
                                                name="quantity" 
                                                class="stock_number btn-number" 
                                                value="${p_size.stocks}" 
                                                id="input-stock-${p_size.uid}"
                                                readonly>
                                            <span class="input-group-btn btn-number">
                                                <button 
                                                    type="button" 
                                                    class="quantity-right-plus btn btn-success btn-number"
                                                    data-type="plus" 
                                                    data-field=""
                                                    id="btn-stock-add-${p_size.uid}"
                                                    onClick="updateStock('${p_size.uid}','add')">
                                                    <span>+</span>
                                                </button>
                                            </span>
                                        </div>
                                            </td>
                                        </tr>`
                        })
                        $.each(product.product_prices, function (Index, prices) {
                            all_price_list += `<tr>
                                                <td>${prices.min_qty}</td>
                                                <td>${prices.max_qty}</td>
                                                <td>${prices.price}</td>
                                            </tr>`
                        })
                        let html = `<tr>
                                        <td>id</td>
                                        <td style="text-align: right" class="text-secondary">${product.product_id}</td>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td style="text-align: right" class="text-secondary">${product.name}</td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td style="text-align: right" class="text-secondary">${product.category}</td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td style="text-align: right" class="text-secondary">${product.base_discount} %</td>
                                    </tr>
                                     <tr>
                                        <td>TAX</td>
                                        <td style="text-align: right" class="text-secondary">${product.tax} %</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping Charge</td>
                                        <td style="text-align: right" class="text-secondary">${product.delivery_charge} ₹</td>
                                    </tr>
                                    <!-- <tr>
                                        <td>Final Price</td>
                                        <td style="text-align: right" class="text-success fs-16 ">${calculateFinalPrice(product.base_price, product.base_discount)} ₹</td>
                                    </tr> -->
                                    <tr>
                                        <td>Barcode</td>
                                        <td style="text-align: right" class="text-secondary">${product.manufacturer_name}</td>
                                    </tr>
                                    <tr>
                                        <td>Store Name</td>
                                        <td style="text-align: right" class="text-secondary">${product.manufacturer_brand}</td>
                                    </tr>
                                    <tr>
                                        <td>Sold</td>
                                        <td style="text-align: right" class="text-secondary">${product.category}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Min Quantity</td>
                                        <td style="font-weight:bold;">Max Quantity</td>
                                        <td style="font-weight:bold;">Price</td>
                                    </tr>
                                    ${all_price_list} 
                                    <tr>
                                        <td style="font-weight:bold;">Size</td>
                                        <td style="text-align: right; font-weight:bold;">Stock</td>
                                    </tr>
                                    ${load_sizes}`
                        $('#product_details').html(html);
                        load_variants();
                    }
                },
                error: function (err) {
                    console.log(err)
                }

            })
        }


        function load_variants() {
            $.ajax({
                url: "<?= base_url('/api/product/variant') ?>",
                type: 'GET',
                data: {
                    p_id: '<?= $_GET['p_id'] ?>'
                },
                beforeSend: function () {
                    $('#table-product-variant-body').html(`<tr >
                        <td colspan="7"  style="text-align:center">
                            <div class="spinner-border" role="status"></div>
                        </td>
                    </tr>`);

                },
                success: function (resp) {
                    if (resp.status) {
                        let html = '';
                        $.each(resp.data, function (vIndex, vItem) {
                            console.log(vItem);
                            let load_stocks = ``
                            let load_sizes = ``
                        $.each(vItem.product_sizes, function (Index, p_size) {
                            load_sizes += `<div class="input-group stock_number_bx" style="min-width: 110px; flex-flow: row; margin-top: 1px;">
                                                ${ p_size.sizes}    
                                            </div>`
                           
                            load_stocks += `<div class="input-group stock_number_bx" style="min-width: 110px; flex-flow: row; margin-top: 1px;">
                                                <span style="padding-right: 10px; font-weight:bold; margin-top: 4px">${ p_size.sizes} => </span>
                                                
                                            <span class="input-group-btn btn-number">
                                                <button 
                                                    type="button" 
                                                    class="quantity-left-minus btn btn-danger btn-number"
                                                    data-type="minus" 
                                                    data-field=""
                                                    id="btn-stock-sub-${p_size.uid}"
                                                    onClick="updateStock('${p_size.uid}','sub')">
                                                    <span>-</span>
                                                </button>
                                            </span>
                                            <input 
                                                type="text" 
                                                name="quantity" 
                                                class="stock_number btn-number" 
                                                value="${p_size.stocks}" 
                                                id="input-stock-${p_size.uid}"
                                                readonly>
                                            <span class="input-group-btn btn-number">
                                                <button 
                                                    type="button" 
                                                    class="quantity-right-plus btn btn-success btn-number"
                                                    data-type="plus" 
                                                    data-field=""
                                                    id="btn-stock-add-${p_size.uid}"
                                                    onClick="updateStock('${p_size.uid}','add')">
                                                    <span>+</span>
                                                </button>
                                            </span>
                                        </div>`
                        })
                            html += `<tr>
                                    <td >
                                    ${
                                        vItem.product_img.length > 0
                                        ?
                                        `<img src="<?= base_url('public/uploads/variant_images/') ?>${vItem.product_img[0].src}" alt="" class="product-img">`
                                        :
                                        `<img src="<?= base_url('public/uploads/product_images/') ?>${product.product_img[0].src}" alt="" class="product-img">`
                                    }
                                    </td>
                                    <td >${vItem.price} ₹</td>
                                    <td >${vItem.discount} %</td>
                                    <td class="text-success fs-16">${calculateFinalPrice(vItem.price, vItem.discount).toFixed(2)} ₹</td>
                                    <td  style="min-width: 110px">
                                        ${load_stocks}
                                    </td>
                                    <td>
                                        <button class="btn btn-danger"  onClick="delete_variant('${vItem.uid}')">
                                            <i class="ri ri-delete-bin-line"></i>
                                        </button>
                                    </td>
                                </tr>`;
                        });
                        $('#table-product-variant-body').html(html);
                    }else{
                        $('#table-product-variant-body').html(`<tr>
                                                                <td colspan="7" style="text-lignt:center;">Nothing Found</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>`);
                    }
                    // $('#table-product-variant').DataTable();
                },
                error: function (err) {
                    console.log(err)
                }

            });
        }

        $('#add_stock_btn').on('click', function () {

            qty = $('#stock_qty').val()

            if (qty.length == 0) {
                $('#alert').html(`<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                                        <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Add Stock Amount
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>`)
            } else {

                let stock = parseInt($('#stock_qty').val())
                $.ajax({
                    url: "<?= base_url('/api/product/stock/update') ?>",
                    type: "GET",
                    data: {
                        p_id: '<?= $_GET['p_id'] ?>',
                        stock: stock
                    },
                    beforeSend: function () {
                        $(`#add_stock_btn`).attr('disabled', true)
                    },
                    success: function (resp) {
                        $(`#add_stock_btn`).attr('disabled', false)
                        if (resp.status) {
                            $('#alert').html(`<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                                            <i class="ri-checkbox-circle-fill label-icon"></i><strong>${resp.message}</strong>
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>`)
                            $('#product_stock').html(stock)
                            $('#stock_qty').val(``)
                            get_product_data('<?= $_GET['p_id'] ?>');
                        }
                    },
                    error: function (err) {
                        console.log(err)
                        $(`#add_stock_btn`).attr('disabled', false)
                        $('#alert').html(`<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                                        <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Internal Server Error
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>`)
                    }
                })
            }

        })
    

    function delete_variant(v_id) {
        if (confirm('do you really want to delete this variant')) {
            $.ajax({
                url: "<?= base_url('/api/product/variant/delete') ?>",
                type: 'GET',
                data: {
                    v_id: v_id
                },
                beforeSend: function () { },
                success: function (resp) {
                    if (resp.status) {
                        load_variants()
                    }
                },
                error: function (err) {
                    console.log(err)
                }

            })
        }
    }


    function delete_product(p_id) {
        if (confirm('do you really want to delete this product')) {
            $.ajax({
                url: "<?= base_url('/api/product/delete') ?>",
                type: 'GET',
                data: {
                    p_id: p_id
                },
                beforeSend: function () { },
                success: function (resp) {
                    console.log(resp);
                    if (resp.status) {
                        window.location.href = '<?= base_url('admin/product/list') ?>';

                    }
                },
                error: function (err) {
                    console.log(err)
                }

            })
        }

    }

</script>