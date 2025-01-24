<script>
    $(document).ready(function () {
        load_product()
    })

    function load_product(){
        $.ajax({
            url: "<?= base_url('/api//most-clicked/product') ?>",
            type: "GET",
            success: function (resp) {
                
                if (resp.status) {
                    console.log(resp)
                    // $('#user_address').empty();
                        var html =``  
                        $.each(resp.data, function(index, product) {
                            // console.log(product)
                            // if(index <= 8){
                                var add_to_cart_button = `<div class="tn mt-3"> <a href="javascript:void(0)" onclick="add_to_cart('${product.product_id}')"
                                                                class="btn btn-primary btn-hover w-100 add-btn"><i
                                                                    class="mdi mdi-cart me-1"></i> Add To Cart</a> 
                                                        </div>`
                                if(product.product_stock < 1){
                                    add_to_cart_button = `<span style="color:red;">Currently unavailable</span>`
                                }
                                var original_price = product.base_discount ? (product.base_price - (product.base_price * product.base_discount / 100)) : product.base_price;
                                var base_price = product.base_discount ? product.base_discount : "";
                                let product_img = product.product_img.length > 0 ? '<?= base_url('public/uploads/product_images/') ?>'+product.product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                                html += `<div class="product-wrap">
                                                    <div class="product text-center">
                                                        <figure class="product-media">
                                                            <a href="<?= base_url('product/details?id=')?>${product.product_id}" onclick="increase_click_count('${product.product_id}')">
                                                                <img src="${product_img}" alt="Product" width="300" height="338">
                                                            </a>
                                                            <div class="product-action-horizontal">
                                                                <!-- <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a> -->
                                                                <a href="javascript:void(0)" class="btn-product-icon btn-wishlist w-icon-heart${product.is_wishlisted ? '-full' : ''}" data-product-id="${product.product_id}" title="Wishlist" onclick="wishlist('${product.product_id}')"></a>
                                                                <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Compare"></a>
                                                                <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quick View"></a> -->
                                                            </div>
                                                        </figure>
                                                        <div class="product-details">
                                                            <div class="product-cat">
                                                                <a href="shop-banner-sidebar.html">${product.category}</a>
                                                            </div>
                                                            <h3 class="product-name">
                                                                <a href="<?= base_url('product/details?id=')?>${product.product_id}" onclick="increase_click_count('${product.product_id}')">${product.name}</a>
                                                            </h3>
                                                            <!-- <div class="ratings-container">
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 100%;"></span>
                                                                    <span class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                                <a href="<?= base_url('product/details?id=')?>${product.product_id}" class="rating-reviews">(3 reviews)</a>
                                                            </div> -->
                                                            <div class="product-pa-wrapper">
                                                                <div class="product-price">
                                                                    ₹${product.product_prices != "" ? product.product_prices[product.product_prices.length-1].price : ''} - ₹${product.product_prices != "" ? product.product_prices[0].price : ''}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>`
                                        $('#total_products').html(`<p class="text-muted flex-grow-1 mb-0">Showing ${index+1} results</p>`);
                            // }
                        })
                        $('#product-grid').html(html);
                } else {
                    console.log("error")
                }
                
            },
            error: function (err) {
                console.log(err)
            },
        })
    }
    function add_to_cart(p_id) {
        
        $.ajax({
            url: "<?= base_url('/api/user/id') ?>",
            type: "GET",
            success: function (resp) {
                
                if (resp.status) {
                    // console.log(resp.data) 
                    $.ajax({
                        url: "<?= base_url('/api/user/cart/add') ?>",
                        type: "POST",
                        data:{product_id:p_id, 
                            user_id:resp.data,
                            variation_id:'VAR00001',
                            qty:'1',
                            },
                        success: function (resp) {
                            
                            if (resp.status) {
                                Toastify({
                                text: resp.message.toUpperCase(),
                                duration: 3000,
                                position: "center",
                                stopOnFocus: true,
                                style: {
                                    background: resp.status ? 'darkgreen' : 'darkred',
                                },

                            }).showToast();
                            } else {
                                console.log(resp)
                                Toastify({
                                text: resp.message.toUpperCase(),
                                duration: 3000,
                                position: "center",
                                stopOnFocus: true,
                                style: {
                                    background: resp.status ? 'darkgreen' : 'darkred',
                                },

                            }).showToast();
                            }
                            
                        },
                        error: function (err) {
                            console.log(err)
                        },
                    })
                       
                } else {
                    Toastify({
                            text: 'Please login'.toUpperCase(),
                            duration: 3000,
                            position: "center",
                            stopOnFocus: true,
                            style: {
                                background: 'darkred',
                            },

                        }).showToast();
                    // console.log(resp)
                    // var existingData = localStorage.getItem('cartData');
                    // var dataArray = existingData ? JSON.parse(existingData) : [];
                    // if (!Array.isArray(dataArray)) {
                    // }
                    // var data = {
                    //     product_id: p_id,
                    //     variation_id: 'VAR00001',
                    //     qty: '1'
                    // };
                    // dataArray.push(data);
                    
                    // var jsonData = JSON.stringify(dataArray);
                    // localStorage.setItem('cartData', jsonData);
                    

                    // // Retrieve data from local storage
                    // var storedData = localStorage.getItem('cartData');
                    // var retrievedData = JSON.parse(storedData);
                    // console.log(retrievedData); // This will log 'value1'

                    // if(retrievedData != ""){
                    //     var message = 'Item added to cart'
                    //     Toastify({
                    //         text: message.toUpperCase(),
                    //         duration: 3000,
                    //         position: "center",
                    //         stopOnFocus: true,
                    //         style: {
                    //             background: 'darkgreen',
                    //         },

                    //     }).showToast();
                    // }else{
                    //     var message = 'Item added Faild!'
                    //     Toastify({
                    //         text: message.toUpperCase(),
                    //         duration: 3000,
                    //         position: "center",
                    //         stopOnFocus: true,
                    //         style: {
                    //             background: 'darkred',
                    //         },

                    //     }).showToast(); 
                    // }
                    
                }

                
            },
            error: function (err) {
                console.log(err)
            },
        })

    }

    function out_of_stock(){
        Toastify({
            text: 'Currently this product is out of stock'.toUpperCase(),
            duration: 3000,
            position: "center",
            stopOnFocus: true,
            style: {
                background: 'gray',
            },

        }).showToast();
    }

    function search_product() {
        var alphabet = $('#searchProductList').val()
        // alert(alphabet)
        $.ajax({
            url: "<?= base_url('/api/search/product') ?>",
            type: "GET",
            data: {
                alph: alphabet
            },
            beforeSend: function () {
                $('#product-grid').html(`<div style="width: 100%;
                                                    display: flex;
                                                    align-items: center;
                                                    justify-content: center;
                                                    height: 200px;">
                                            <div style="height: 50px;
                                                        width: 50px;
                                                        font-size: 20px;
                                                        color: #004aad;" class="spinner-border" 
                                                role="status">
                                            </div>
                                        </div>`)
            },
            success: function (resp) {

                console.log(resp)
                if (resp.status == true) {
                    html = ''
                    if (resp.data.length > 0) {
                        $.each(resp.data, function (index, product) {
                            // console.log(product)
                                // if(index <= 8){
                                    var original_price = product.base_discount ? (product.base_price - (product.base_price * product.base_discount / 100)): product.base_price;
                                    var base_price = product.base_discount ? product.base_discount : "";
                                    html += `<div class="product-wrap">
                                                        <div class="product text-center">
                                                            <figure class="product-media">
                                                                <a href="<?= base_url('product/details?id=')?>${product.product_id}">
                                                                    <img src="<?=base_url()?>public/uploads/product_images/${product.product_img[0].src}" alt="Product" width="300" height="338">
                                                                </a>
                                                                <div class="product-action-horizontal">
                                                                    <!-- <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a> -->
                                                                    <a href="javascript:void(0)" class="btn-product-icon btn-wishlist w-icon-heart${product.is_wishlisted ? '-full' : ''}" data-product-id="${product.product_id}" title="Wishlist" onclick="wishlist('${product.product_id}')"></a>
                                                                    <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Compare"></a>
                                                                    <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quick View"></a> -->
                                                                </div>
                                                            </figure>
                                                            <div class="product-details">
                                                                <div class="product-cat">
                                                                    <a href="shop-banner-sidebar.html">${product.category}</a>
                                                                </div>
                                                                <h3 class="product-name">
                                                                    <a href="<?= base_url('product/details?id=')?>${product.product_id}">${product.name}</a>
                                                                </h3>
                                                                <!-- <div class="ratings-container">
                                                                    <div class="ratings-full">
                                                                        <span class="ratings" style="width: 100%;"></span>
                                                                        <span class="tooltiptext tooltip-top"></span>
                                                                    </div> -->
                                                                    <a href="<?= base_url('product/details?id=')?>${product.product_id}" class="rating-reviews">(3 reviews)</a>
                                                                </div>
                                                                <div class="product-pa-wrapper">
                                                                    <div class="product-price">
                                                                        ₹${original_price}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>`
                                    // $('#product-grid').append(html);
                                    $('#total_products').html(`<p class="text-muted flex-grow-1 mb-0">Showing ${index+1} results</p>`);
                                // }
                        })
                        $('#product-grid').html(html);
                    } else {
                        $('#product-grid').html(`<h3 class="text-danger">No Products Found</h3>`);
                    }
                } else {
                    $('#product-grid').html(`<h3 class="text-danger">No Products Found</h3>`);
                }
            },
            error: function (err) {
                console.error(err)
            },
            complete: function () { }
        })

    }

    function clear_all(){
        load_product(c_id=null)
        $('#searchProductList').val("")
    }

    function wishlist(product_id) {

        $.ajax({
            url: "<?= base_url('/api/user/id') ?>",
            type: "GET",
            success: function (resp) {
                if (resp.status){
                    $.ajax({
                        url: "<?= base_url('/api/add/wish-list') ?>",
                        type: "POST",
                        data: {
                            product_id: product_id,
                            user_id: resp.data,
                        },
                        success: function (resp) {
                            if (resp.status){
                                Toastify({
                                    text: resp.message.toUpperCase(),
                                    duration: 3000,
                                    position: "center",
                                    stopOnFocus: true,
                                    style: {
                                        background: resp.status ? 'darkgreen' : 'darkred',
                                    },
                                }).showToast();
                                var button = Wolmart.$body.find(`.btn-wishlist[data-product-id="${product_id}"]`);
                                if (button.length > 0) {
                                    event.preventDefault();
                                    button.toggleClass("added").addClass("load-more-overlay loading");
                                    setTimeout(function () {
                                    button.removeClass("load-more-overlay loading")
                                            .toggleClass("w-icon-heart")
                                            .toggleClass("w-icon-heart-full");
                                    }, 500);
                                }
                            } else {
                                Toastify({
                                    text: resp.message.toUpperCase(),
                                    duration: 3000,
                                    position: "center",
                                    stopOnFocus: true,
                                    style: {
                                        background: resp.status ? 'darkgreen' : 'darkred',
                                    },
                                }).showToast();
                            }
                        },
                        error: function (err) {
                            console.log(err)
                        },
                    })
                } else {
                    Toastify({
                        text: 'Please login'.toUpperCase(),
                        duration: 3000,
                        position: "center",
                        stopOnFocus: true,
                        style: {
                            background: 'darkred',
                        },
                    }).showToast();
                }
            },
            error: function (err) {
                console.log(err)
            },
        })


    }
</script>