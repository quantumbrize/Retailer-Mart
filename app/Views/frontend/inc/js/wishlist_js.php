<script>
    load_wishlists()
    function load_wishlists() {
        $.ajax({
            url: "<?= base_url('/api/user/id') ?>",
            type: "GET",
            success: function (resp) {
                if (resp.status){
                    $.ajax({
                        url: "<?= base_url('/api/wishlists') ?>",
                        type: "GET",
                        data: {
                            user_id: resp.data
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
                                                var original_price = product.base_discount ? (product.base_price - (product.base_price * product.base_discount / 100)): product.base_price;
                                                var base_price = product.base_discount ? product.base_discount : "";
                                                let product_img = product.product_img.length > 0 ? '<?= base_url('public/uploads/product_images/') ?>'+product.product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                                                html += `<tr>
                                                            <td class="product-thumbnail">
                                                                <div class="p-relative">
                                                                    <a href="<?= base_url('product/details?id=')?>${product.product_id}">
                                                                        <figure>
                                                                            <img src="${product_img}" alt="product" width="300" height="338">
                                                                        </figure>
                                                                    </a>
                                                                    <button type="submit" class="btn btn-close" onclick="wishlist('${product.uid}')"><i class="fas fa-times"></i></button>
                                                                </div>
                                                            </td>
                                                            <td class="product-name">
                                                                <a href="<?= base_url('product/details?id=')?>${product.product_id}">
                                                                    ${product.name}
                                                                </a>
                                                            </td>
                                                            <td class="product-price">
                                                                <ins class="new-price">₹${product.product_prices != "" ? product.product_prices[product.product_prices.length-1].price : ''} - ₹${product.product_prices != "" ? product.product_prices[0].price : ''}</ins>
                                                            </td>
                                                            <td class="product-stock-status">
                                                                <span class="wishlist-in-stock">In Stock</span>
                                                            </td>
                                                            <td class="wishlist-action">
                                                                <div class="d-lg-flex">
                                                                    <a href="javascript:void(0)" onclick="window.location.href='<?= base_url('product/details?id=')?>${product.product_id}'" class="btn btn-quickview btn-outline btn-default btn-rounded btn-sm mb-2 mb-lg-0">Quick
                                                                        View</a>
                                                                    <!-- <a href="#" class="btn btn-dark btn-rounded btn-sm ml-lg-2 btn-cart">Add to
                                                                        cart</a> -->
                                                                </div>
                                                            </td>
                                                        </tr>`
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

    function wishlist(wishlist_id) {

        $.ajax({
            url: "<?= base_url('/api/user/id') ?>",
            type: "GET",
            success: function (resp) {
                if (resp.status){
                    $.ajax({
                        url: "<?= base_url('/api/remove/wishlist') ?>",
                        type: "GET",
                        data: {
                            wishlist_id: wishlist_id
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
                            load_wishlists()
                            get_user()
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