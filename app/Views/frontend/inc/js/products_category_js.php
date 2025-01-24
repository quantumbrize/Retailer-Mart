<script>
    window.onscroll = function () {
        applyHeaderSearchClass();
    };
    // Parse query string from the URL
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    // Get category and sub-category IDs
    const c_id = urlParams.get('c_id'); // Main category ID
    const sc_id = urlParams.get('sc_id') || c_id; // Sub-category or fallback to category

    function applyHeaderSearchClass() {
        if (window.scrollY > 110) { // Change threshold to 10px
            document.querySelector('.search-container.header-search-mobile').classList.add('header-search-position');
        } else {
            document.querySelector('.search-container.header-search-mobile').classList.remove('header-search-position');
        }
    }

    function mobileShowSuggestions() {
        const input = document.getElementById("mobileSearchInput").value.toLowerCase();
        const suggestionBox = document.getElementById("mobileSuggestionBox");
        suggestionBox.innerHTML = ""; // Clear previous suggestions

        if (input) {
            const filteredSuggestions = suggestions.filter((item) =>
                item.name.toLowerCase().includes(input)
            );

            filteredSuggestions.forEach((item) => {
                const li = document.createElement("li");
                li.innerHTML = `
                    <i class="fas fa-search"></i>
                    ${item.name}
                    ${item.category ? `<span class="suggestion-category">${item.category}</span>` : ""}
                `;
                li.addEventListener("click", () => {
                    if (item.product_id) {
                        // Redirect to the page using product_id
                        window.location.href = `<?= base_url('product/details?id=') ?>${item.product_id}`;
                    } else {
                        document.getElementById("mobileSearchInput").value = item.name;
                        suggestionBox.innerHTML = ""; // Hide suggestions
                    }
                });
                suggestionBox.appendChild(li);
            });
        }
    }

    function mobileProductSearch() {
        const alphabet = $('#mobileSearchInput').val();
        $.ajax({
            url: "<?= base_url('/api/search/product') ?>",
            type: "GET",
            data: {
                alph: alphabet
            },
            beforeSend: function () {
            },
            success: function (resp) {
                // console.log(resp);
                if (resp.status == true) {
                    suggestions = [];
                    if (resp.data.length > 0) {
                        $.each(resp.data, function (index, product) {
                            suggestions.push({
                                name: product.name,
                                category: product.category,
                                product_id: product.product_id // Add product_id to suggestions
                            });
                        });
                    } else {
                        suggestions.push({
                            name: 'No Product Found',
                            category: 'N/A',
                            product_id: null // No redirection for this case
                        });
                    }
                } else {
                    suggestions.push({
                        name: 'No Product Found',
                        category: 'N/A',
                        product_id: null // No redirection for this case
                    });
                }
                mobileShowSuggestions();
            },
            error: function (err) {
                console.error(err);
            },
            complete: function () { }
        });
    }
    $(document).ready(function () {


        // Ensure a valid ID is provided
        if (!sc_id) {
            console.error("No category or sub-category ID provided");
            return;
        }
        // Load products, sub-categories, and main categories
        get_sub_categories(c_id);
        get_main_categories(c_id);
        get_category(sc_id)
        load_product(sc_id);

    });


    function get_category(c_id) {

        $.ajax({
            url: '<?= base_url('/api/category/by/id') ?>',
            data: "GET",
            data: { c_id: c_id },
            success: function (resp) {

                console.log(resp);
                if (resp.status) {
                    let cat = resp.data
                    $('#cat_name').html(cat.name)

                    const bannerImgPath = cat.banner_img_path
                        ? `<?= base_url('/public/uploads/category_banner_images/') ?>${cat.banner_img_path}`
                        : 'https://www.t-mobile.com/news/_admin/uploads/2020/04/placeholder.jpeg';

                    $('#cat_banner')
                        .css('background', `url(${bannerImgPath})`)
                        .slideDown(100);

                }
            }
        })


    }



    function load_product(c_id) {
        if (c_id != null) {
            $.ajax({
                url: "<?= base_url('/api/category/product/list') ?>",
                type: "GET",
                data: {
                    c_id: c_id
                },
                success: function (resp) {
                    console.log('datam=>>', resp)
                    if (resp.status) {

                        var html = ``
                        $.each(resp.data, function (index, product) {
                            // if(index <= 8){
                            var original_price = product.base_discount ? (product.base_price - (product.base_price * product.base_discount / 100)) : product.base_price;
                            var base_price = product.base_discount ? product.base_discount : "";
                            let product_img = product.product_img.length > 0 ? '<?= base_url('public/uploads/product_images/') ?>' + product.product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                            html += `<div class="product-wrap">
                                                        <div class="product text-center">
                                                            <figure class="product-media">
                                                                <a href="<?= base_url('product/details?id=') ?>${product.product_id}" onclick="increase_click_count('${product.product_id}')">
                                                                    <img src="${product_img}" alt="Product" width="300" height="338">
                                                                </a>
                                                                <div class="product-action-horizontal">
                                                                    <!-- <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a> -->
                                                                    <a href="javascript:void(0)" class="btn-product-icon btn-wishlist w-icon-heart${product.is_wishlisted ? '-full' : ''}" data-product-id="${product.product_id}" title="Wishlist" onclick="wishlist('${product.product_id}')"></a>
                                                                    <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Compare"></a>
                                                                    <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quick View"></a> -->
                                                                </div>
                                                                <div class="product-label-group product-label-categories2">
                                                                    <label class="product-label label-discount">${product.base_discount}% Off</label>
                                                                </div>
                                                            </figure>
                                                            <div class="product-details">
                                                                <div class="product-cat">
                                                                    <a href="shop-banner-sidebar.html">${product.category}</a>
                                                                </div>
                                                                <h3 class="product-name">
                                                                    <a href="<?= base_url('product/details?id=') ?>${product.product_id}" onclick="increase_click_count('${product.product_id}')">${product.name}</a>
                                                                </h3>
                                                                <!-- <div class="ratings-container">
                                                                    <div class="ratings-full">
                                                                        <span class="ratings" style="width: 100%;"></span>
                                                                        <span class="tooltiptext tooltip-top"></span>
                                                                    </div> 
                                                                    <a href="<?= base_url('product/details?id=') ?>${product.product_id}" class="rating-reviews">(3 reviews)</a>
                                                                </div> -->
                                                                <div class="product-pa-wrapper">
                                                                    <div class="product-price">
                                                                        ₹${product.product_prices != "" ? product.product_prices[0].price : ''} - ₹${product.product_prices != "" ? product.product_prices[product.product_prices.length - 1].price : ''}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>`
                            $('#total_products').html(`<p class="text-muted flex-grow-1 mb-0">Showing ${index + 1} results</p>`);
                            // }
                        })
                        $('#product-grid').html(html);
                    } else {
                        $('#product-grid').html(`<h3 class="text-danger">No Products Found</h3>`);
                        // console.log("error")
                    }

                },
                error: function (err) {
                    // console.log(err)
                },
            })
        } else {
            $.ajax({
                url: "<?= base_url('/api/product') ?>",
                type: "GET",
                success: function (resp) {

                    if (resp.status) {
                        // console.log(resp)
                        // $('#user_address').empty();
                        var html = ``
                        $.each(resp.data, function (index, product) {
                            // console.log(product)
                            // if(index <= 8){
                            var add_to_cart_button = `<div class="tn mt-3"> <a href="javascript:void(0)" onclick="add_to_cart('${product.product_id}')"
                                                                    class="btn btn-primary btn-hover w-100 add-btn"><i
                                                                        class="mdi mdi-cart me-1"></i> Add To Cart</a> 
                                                            </div>`
                            if (product.product_stock < 1) {
                                add_to_cart_button = `<span style="color:red;">Currently unavailable</span>`
                            }
                            var original_price = product.base_discount ? (product.base_price - (product.base_price * product.base_discount / 100)) : product.base_price;
                            var base_price = product.base_discount ? product.base_discount : "";
                            let product_img = product.product_img.length > 0 ? '<?= base_url('public/uploads/product_images/') ?>' + product.product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                            html += `<div class="product-wrap">
                                                        <div class="product text-center">
                                                            <figure class="product-media">
                                                                <a href="<?= base_url('product/details?id=') ?>${product.product_id}" onclick="increase_click_count('${product.product_id}')">
                                                                    <img src="${product_img}" alt="Product" width="300" height="338">
                                                                </a>
                                                                <div class="product-action-horizontal">
                                                                    <!-- <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a> -->
                                                                    <a href="javascript:void(0)" class="btn-product-icon btn-wishlist w-icon-heart${product.is_wishlisted ? '-full' : ''}" data-product-id="${product.product_id}" title="Wishlist" onclick="wishlist('${product.product_id}')"></a>
                                                                    <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Compare"></a>
                                                                    <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quick View"></a> -->
                                                                </div>
                                                                <div class="product-label-group product-label-categories2">
                                                                    <label class="product-label label-discount">${product.base_discount}% Off</label>
                                                                </div>
                                                            </figure>
                                                            <div class="product-details">
                                                                <div class="product-cat">
                                                                    <a href="shop-banner-sidebar.html">${product.category}</a>
                                                                </div>
                                                                <h3 class="product-name">
                                                                    <a href="<?= base_url('product/details?id=') ?>${product.product_id}" onclick="increase_click_count('${product.product_id}')">${product.name}</a>
                                                                </h3>
                                                                <!-- <div class="ratings-container">
                                                                    <div class="ratings-full">
                                                                        <span class="ratings" style="width: 100%;"></span>
                                                                        <span class="tooltiptext tooltip-top"></span>
                                                                    </div>
                                                                    <a href="<?= base_url('product/details?id=') ?>${product.product_id}" class="rating-reviews">(3 reviews)</a>
                                                                </div> -->
                                                                <div class="product-pa-wrapper">
                                                                    <div class="product-price">
                                                                        ₹${product.product_prices != "" ? product.product_prices[product.product_prices.length - 1].price : ''} - ₹${product.product_prices != "" ? product.product_prices[0].price : ''}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>`
                            $('#total_products').html(`<p class="text-muted flex-grow-1 mb-0">Showing ${index + 1} results</p>`);
                            // }
                        })
                        $('#product-grid').html(html);
                    } else {
                        // console.log("error")
                    }

                },
                error: function (err) {
                    // console.log(err)
                },
            })
        }
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
                        data: {
                            product_id: p_id,
                            user_id: resp.data,
                            variation_id: 'VAR00001',
                            qty: '1',
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
                                // console.log(resp)
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
                            // console.log(err)
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
                    // console.log(retrievedData); 
                    // This will log 'value1'

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
                // console.log(err)
            },
        })

    }

    function out_of_stock() {
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

    let swiperCat
    function load_categories() {

        $.ajax({
            url: "<?= base_url('/api/categories') ?>",
            type: "GET",
            data: { c_id: c_id },
            beforeSend: function () { },
            success: function (resp) {
                if (resp.status) {
                    // console.log(resp)
                    html = ``
                    html2 = `<li><a  href="<?= base_url() ?>product/category?c_id=${c_id}">All</a></li>`
                    $.each(resp.data, function (index, item) {
                        html2 += `<li><a href="javascript:void(0)" onClick="load_products('${item.uid}')">${item.name}</a></li>`
                        html += `<div class="swiper-slide category-wrap">
                                    <div class="category category-ellipse">
                                        <figure class="category-media">
                                            <a href="javascript:void(0)" onclick="call_category_functions('${item.uid}')">
                                                <img src="<?= base_url('public/uploads/category_images/') ?>${item.img_path}" alt="Categroy" width="190" height="190" style="background-color: #5C92C0;">
                                            </a>
                                        </figure>
                                        <div class="category-content">
                                            <h4 class="category-name">
                                                <a href="shop-banner-sidebar.html">${item.name}</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>`

                    })
                    $('#main-category-tab').html(html)
                    // $('#category-tab').html(html2)
                    if (swiperCat) {
                        swiperCat.update();
                    } else {
                        var swiperOptions = {
                            spaceBetween: 20,
                            slidesPerView: 2,
                            breakpoints: {
                                480: {
                                    slidesPerView: 3
                                },
                                576: {
                                    slidesPerView: 4
                                },
                                768: {
                                    slidesPerView: 6
                                },
                                992: {
                                    slidesPerView: 7
                                },
                                1200: {
                                    slidesPerView: 8,
                                    spaceBetween: 30
                                }
                            }
                        };

                        swiperCat = new Swiper('.swiper-container.swiper-theme.shadow-swiper', swiperOptions);
                    }

                }
            },
            error: function (err) {
                console.error(err)
            }
        })
    }

    function call_category_functions(cc_id) {
        // get_sub_categories(c_id)
        // get_main_categories(c_id)
        window.location.href = `<?= base_url() ?>product/category?c_id=${c_id}&sc_id=${cc_id}`; // Redirects to a new page
    }




    function call_All_category_product() {
        load_categories()
        load_product(c_id = null)
    }

    function get_main_categories(parent_id) {
        $.ajax({
            url: "<?= base_url('/api/categories') ?>",
            type: "GET",
            data: { parent_id: parent_id },
            beforeSend: function () { },
            success: function (resp) {
                if (resp.status) {
                    // console.log(resp)
                    html1 = `<div class="swiper-slide category-wrap">
                                        <div class="category category-ellipse">
                                            <figure class="category-media">
                                               <!-- <a href="<?= base_url() ?>product/category?c_id=${c_id}"> -->
                                                <a href="<?= base_url() ?>product/list">
                                                    <img src="<?= base_url('public/uploads/category_images/') ?>" alt="Categroy" width="190" height="190" style="background-color: #5C92C0;">
                                                </a>
                                            </figure>
                                            <div class="category-content">
                                                <h4 class="category-name">
                                                    <!-- <a href="<?= base_url() ?>product/category?c_id=${c_id}">All</a> -->
                                                    <a href="<?= base_url() ?>product/list">All</a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>`
                    $.each(resp.data, function (index, item) {
                        // html1 += `<li><a href="javascript:void(0)" onClick="load_products('${item.uid}')">${item.name}</a></li>`
                        html1 += `<div class="swiper-slide category-wrap">
                                        <div class="category category-ellipse">
                                            <figure class="category-media">
                                                <a href="javascript:void(0)" onclick="call_category_functions('${item.uid}')">
                                                    <img src="<?= base_url('public/uploads/category_images/') ?>${item.img_path}" alt="Categroy" width="190" height="190" style="background-color: #5C92C0;">
                                                </a>
                                            </figure>
                                            <div class="category-content">
                                                <h4 class="category-name">
                                                    <a href="shop-banner-sidebar.html">${item.name}</a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>`

                    })
                    // $.ajax({
                    //     url: "<?= base_url('/api/category/product/list') ?>",
                    //     type: "GET",
                    //     data: {
                    //         c_id: parent_id
                    //     },
                    //     beforeSend: function () {
                    //         $('#product-grid').html(`<div style="width: 100%;
                    //                                                 display: flex;
                    //                                                 align-items: center;
                    //                                                 justify-content: center;
                    //                                                 height: 200px;">
                    //                                         <div style="height: 50px;
                    //                                                     width: 50px;
                    //                                                     font-size: 20px;
                    //                                                     color: #004aad;" class="spinner-border" 
                    //                                             role="status">
                    //                                         </div>
                    //                                     </div>`)
                    //     },
                    //     success: function (resp1) {

                    //         // console.log(resp1)
                    //         if (resp1.status == true) {
                    //             html = ''
                    //             if (resp1.data.length > 0) {
                    //                 $.each(resp1.data, function (index, product) {
                    //                     // console.log(product)
                    //                     // if(index <= 8){
                    //                     var original_price = product.base_discount ? (product.base_price - (product.base_price * product.base_discount / 100)) : product.base_price;
                    //                     var base_price = product.base_discount ? product.base_discount : "";
                    //                     let product_img = product.product_img.length > 0 ? '<?= base_url('public/uploads/product_images/') ?>' + product.product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                    //                     // console.log(product_img)
                    //                     html += `<div class="product-wrap">
                    //                                                     <div class="product text-center">
                    //                                                         <figure class="product-media">
                    //                                                             <a href="<?= base_url('product/details?id=') ?>${product.product_id}" onclick="increase_click_count('${product.product_id}')">
                    //                                                                 <img src="${product_img}" alt="Product" width="300" height="338">
                    //                                                             </a>
                    //                                                             <div class="product-action-horizontal">
                    //                                                                 <a href="javascript:void(0)" class="btn-product-icon btn-wishlist w-icon-heart${product.is_wishlisted ? '-full' : ''}" data-product-id="${product.product_id}" title="Wishlist" onclick="wishlist('${product.product_id}')"></a>
                    //                                                             </div>
                    //                                                         </figure>
                    //                                                         <div class="product-details">
                    //                                                             <div class="product-cat">
                    //                                                                 <a href="shop-banner-sidebar.html" onclick="increase_click_count('${product.product_id}')">${product.category}</a>
                    //                                                             </div>
                    //                                                             <h3 class="product-name">
                    //                                                                 <a href="<?= base_url('product/details?id=') ?>${product.product_id}">${product.name}</a>
                    //                                                             </h3>
                    //                                                             <!-- <div class="ratings-container">
                    //                                                                 <div class="ratings-full">
                    //                                                                     <span class="ratings" style="width: 100%;"></span>
                    //                                                                     <span class="tooltiptext tooltip-top"></span>
                    //                                                                 </div>
                    //                                                                 <a href="<?= base_url('product/details?id=') ?>${product.product_id}" class="rating-reviews">(3 reviews)</a>
                    //                                                             </div> -->
                    //                                                             <div class="product-pa-wrapper">
                    //                                                                 <div class="product-price">
                    //                                                                     ₹${product.product_prices != "" ? product.product_prices[0].price : ''} - ₹${product.product_prices != "" ? product.product_prices[product.product_prices.length - 1].price : ''}
                    //                                                                 </div>
                    //                                                             </div>
                    //                                                         </div>
                    //                                                     </div>
                    //                                                 </div>`
                    //                     // $('#product-grid').append(html);
                    //                     $('#total_products').html(`<p class="text-muted flex-grow-1 mb-0">Showing ${index + 1} results</p>`);
                    //                     // }
                    //                 })
                    //                 $('#product-grid').html(html);
                    //             } else {
                    //                 $('#product-grid').html(`<h3 class="text-danger">No Products Found</h3>`);
                    //             }
                    //         } else {
                    //             $('#product-grid').html(`<h3 class="text-danger">No Products Found</h3>`);
                    //         }
                    //     },
                    //     error: function (err) {
                    //         console.error(err)
                    //     },
                    //     complete: function () { }
                    // })
                    $('#main-category-tab').html(html1)
                    if (swiperCat) {
                        swiperCat.update();
                    } else {
                        var swiperOptions = {
                            spaceBetween: 20,
                            slidesPerView: 2,
                            breakpoints: {
                                480: {
                                    slidesPerView: 3
                                },
                                576: {
                                    slidesPerView: 4
                                },
                                768: {
                                    slidesPerView: 6
                                },
                                992: {
                                    slidesPerView: 7
                                },
                                1200: {
                                    slidesPerView: 8,
                                    spaceBetween: 30
                                }
                            }
                        };

                        swiperCat = new Swiper('.swiper-container.swiper-theme.shadow-swiper', swiperOptions);
                    }

                } else {
                    $('#main-category-tab').html(`<div class="swiper-slide category-wrap">
                                        <div class="category category-ellipse">
                                            <figure class="category-media">
                                               <!-- <a href="<?= base_url() ?>product/category?c_id=${c_id}"> -->
                                                <a href="<?= base_url() ?>product/list">
                                                    <img src="<?= base_url('public/uploads/category_images/') ?>" alt="Categroy" width="190" height="190" style="background-color: #5C92C0;">
                                                </a>
                                            </figure>
                                            <div class="category-content">
                                                <h4 class="category-name">
                                                    <!-- <a href="<?= base_url() ?>product/category?c_id=${c_id}">All</a> -->
                                                    <a href="<?= base_url() ?>product/list">All</a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>`)
                    if (swiperCat) {
                        swiperCat.update();
                    } else {
                        var swiperOptions = {
                            spaceBetween: 20,
                            slidesPerView: 2,
                            breakpoints: {
                                480: {
                                    slidesPerView: 3
                                },
                                576: {
                                    slidesPerView: 4
                                },
                                768: {
                                    slidesPerView: 6
                                },
                                992: {
                                    slidesPerView: 7
                                },
                                1200: {
                                    slidesPerView: 8,
                                    spaceBetween: 30
                                }
                            }
                        };

                        swiperCat = new Swiper('.swiper-container.swiper-theme.shadow-swiper', swiperOptions);
                    }
                    // $('#category-tab').html(`<li><a href="javascript:void(0)"style="color:red;">Sub-Category Not Found!</a></li>`)
                    // $.ajax({
                    //     url: "<?= base_url('/api/category/product/list') ?>",
                    //     type: "GET",
                    //     data: {
                    //         c_id: parent_id
                    //     },
                    //     beforeSend: function () {
                    //         $('#product-grid').html(`<div style="width: 100%;
                    //                                                 display: flex;
                    //                                                 align-items: center;
                    //                                                 justify-content: center;
                    //                                                 height: 200px;">
                    //                                         <div style="height: 50px;
                    //                                                     width: 50px;
                    //                                                     font-size: 20px;
                    //                                                     color: #004aad;" class="spinner-border" 
                    //                                             role="status">
                    //                                         </div>
                    //                                     </div>`)
                    //     },
                    //     success: function (resp) {

                    //         // console.log(resp)
                    //         if (resp.status == true) {
                    //             html = ''
                    //             if (resp.data.length > 0) {
                    //                 $.each(resp.data, function (index, product) {
                    //                     // console.log(product)
                    //                     // if(index <= 8){
                    //                     var original_price = product.base_discount ? (product.base_price - (product.base_price * product.base_discount / 100)) : product.base_price;
                    //                     var base_price = product.base_discount ? product.base_discount : "";
                    //                     let product_img = product.product_img.length > 0 ? '<?= base_url('public/uploads/product_images/') ?>' + product.product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                    //                     html += `<div class="product-wrap">
                    //                                                     <div class="product text-center">
                    //                                                         <figure class="product-media">
                    //                                                             <a href="<?= base_url('product/details?id=') ?>${product.product_id}">
                    //                                                                 <img src="${product_img}" alt="Product" width="300" height="338">
                    //                                                             </a>
                    //                                                             <div class="product-action-horizontal">
                    //                                                                 <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                    //                                                                 <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Wishlist"></a>
                    //                                                                 <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Compare"></a>
                    //                                                                 <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quick View"></a>
                    //                                                             </div>
                    //                                                         </figure>
                    //                                                         <div class="product-details">
                    //                                                             <div class="product-cat">
                    //                                                                 <a href="shop-banner-sidebar.html">${product.category}</a>
                    //                                                             </div>
                    //                                                             <h3 class="product-name">
                    //                                                                 <a href="<?= base_url('product/details?id=') ?>${product.product_id}">${product.name}</a>
                    //                                                             </h3>
                    //                                                             <!-- <div class="ratings-container">
                    //                                                                 <div class="ratings-full">
                    //                                                                     <span class="ratings" style="width: 100%;"></span>
                    //                                                                     <span class="tooltiptext tooltip-top"></span>
                    //                                                                 </div>
                    //                                                                 <a href="<?= base_url('product/details?id=') ?>${product.product_id}" class="rating-reviews">(3 reviews)</a>
                    //                                                             </div> -->
                    //                                                             <div class="product-pa-wrapper">
                    //                                                                 <div class="product-price">
                    //                                                                      ₹${product.product_prices != "" ? product.product_prices[0].price : ''} - ₹${product.product_prices != "" ? product.product_prices[product.product_prices.length - 1].price : ''}
                    //                                                                 </div>
                    //                                                             </div>
                    //                                                         </div>
                    //                                                     </div>
                    //                                                 </div>`
                    //                     // $('#product-grid').append(html);
                    //                     $('#total_products').html(`<p class="text-muted flex-grow-1 mb-0">Showing ${index + 1} results</p>`);
                    //                     // }
                    //                 })
                    //                 $('#product-grid').html(html);
                    //             } else {
                    //                 $('#product-grid').html(`<h3 class="text-danger">No Products Found</h3>`);
                    //             }
                    //         } else {
                    //             $('#product-grid').html(`<h3 class="text-danger">No Products Found</h3>`);
                    //         }
                    //     },
                    //     error: function (err) {
                    //         console.error(err)
                    //     },
                    //     complete: function () { }
                    // })
                }
            },
            error: function (err) {
                console.error(err)
            }
        })
    }

    function get_sub_categories(parent_id) {
        if (parent_id != null) {
            $.ajax({
                url: "<?= base_url('/api/categories') ?>",
                type: "GET",
                data: { parent_id: parent_id },
                beforeSend: function () { },
                success: function (resp) {
                    if (resp.status) {
                        // console.log(resp)
                        // html1 = `<li><a href="<?= base_url('product/list') ?>">All Category</a></li>`
                        // html1 = ``
                        // $.each(resp.data, function (index, item) {
                        //     html1 += `<li><a href="<?= base_url('product/category?c_id=') ?>${item.uid}">${item.name}</a></li>`

                        // })
                        // $('#category-tab').html(html1)

                    } else {
                        // $('#category-tab').html(`
                        // <li><a href="<?= base_url('product/list') ?>">All Category</a></li>
                        // <li><a href="javascript:void(0)"style="color:red;">Sub-Category Not Found!</a></li>`)
                    }
                },
                error: function (err) {
                    console.error(err)
                }
            })
        } else {
            $.ajax({
                url: "<?= base_url('/api/categories') ?>",
                type: "GET",
                beforeSend: function () { },
                success: function (resp) {
                    if (resp.status) {
                        // console.log(resp)
                        html = `<li><a href="<?= base_url() ?>product/list" >All</a></li>`
                        $.each(resp.data, function (index, item) {
                            html += `<li><a href="<?= base_url('product/category?c_id=') ?>${item.uid}">${item.name}</a></li>`

                        })
                        // $('#category-tab').html(html)

                    }
                },
                error: function (err) {
                    console.error(err)
                }
            })
        }

    }

    function load_products(c_id) {

        call_category_functions(c_id)

        // $.ajax({
        //     url: "<?= base_url('/api/category/product/list') ?>",
        //     type: "GET",
        //     data: {
        //         c_id: c_id
        //     },
        //     beforeSend: function () {
        //         $('#product-grid').html(`<div style="width: 100%;
        //                                             display: flex;
        //                                             align-items: center;
        //                                             justify-content: center;
        //                                             height: 200px;">
        //                                     <div style="height: 50px;
        //                                                 width: 50px;
        //                                                 font-size: 20px;
        //                                                 color: #004aad;" class="spinner-border" 
        //                                         role="status">
        //                                     </div>
        //                                 </div>`)
        //     },
        //     success: function (resp) {

        //         // console.log(resp)
        //         if (resp.status == true) {
        //             html = ''
        //             if (resp.data.length > 0) {
        //                 $.each(resp.data, function (index, product) {
        //                     // console.log(product)
        //                     // if(index <= 8){
        //                     var original_price = product.base_discount ? (product.base_price - (product.base_price * product.base_discount / 100)) : product.base_price;
        //                     var base_price = product.base_discount ? product.base_discount : "";
        //                     let product_img = product.product_img.length > 0 ? '<?= base_url('public/uploads/product_images/') ?>' + product.product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
        //                     html += `<div class="product-wrap">
        //                                                 <div class="product text-center">
        //                                                     <figure class="product-media">
        //                                                         <a href="<?= base_url('product/details?id=') ?>${product.product_id}" onclick="increase_click_count('${product.product_id}')">
        //                                                             <img src="${product_img}" alt="Product" width="300" height="338">
        //                                                         </a>
        //                                                         <div class="product-action-horizontal">
        //                                                             <!-- <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a> -->
        //                                                             <a href="javascript:void(0)" class="btn-product-icon btn-wishlist w-icon-heart${product.is_wishlisted ? '-full' : ''}" data-product-id="${product.product_id}" title="Wishlist" onclick="wishlist('${product.product_id}')"></a>
        //                                                             <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Compare"></a>
        //                                                             <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quick View"></a> -->
        //                                                         </div>
        //                                                     </figure>
        //                                                     <div class="product-details">
        //                                                         <div class="product-cat">
        //                                                             <a href="shop-banner-sidebar.html" onclick="increase_click_count('${product.product_id}')">${product.category}</a>
        //                                                         </div>
        //                                                         <h3 class="product-name">
        //                                                             <a href="<?= base_url('product/details?id=') ?>${product.product_id}">${product.name}</a>
        //                                                         </h3>
        //                                                         <!-- <div class="ratings-container">
        //                                                             <div class="ratings-full">
        //                                                                 <span class="ratings" style="width: 100%;"></span>
        //                                                                 <span class="tooltiptext tooltip-top"></span>
        //                                                             </div>
        //                                                             <a href="<?= base_url('product/details?id=') ?>${product.product_id}" class="rating-reviews">(3 reviews)</a>
        //                                                         </div> -->
        //                                                         <div class="product-pa-wrapper">
        //                                                             <div class="product-price">
        //                                                                ₹${product.product_prices != "" ? product.product_prices[0].price : ''} - ₹${product.product_prices != "" ? product.product_prices[product.product_prices.length - 1].price : ''}
        //                                                             </div>
        //                                                         </div>
        //                                                     </div>
        //                                                 </div>
        //                                             </div>`
        //                     // $('#product-grid').append(html);
        //                     $('#total_products').html(`<p class="text-muted flex-grow-1 mb-0">Showing ${index + 1} results</p>`);
        //                     // }
        //                 })
        //                 $('#product-grid').html(html);
        //             } else {
        //                 $('#product-grid').html(`<h3 class="text-danger">No Products Found</h3>`);
        //             }
        //         } else {
        //             $('#product-grid').html(`<h3 class="text-danger">No Products Found</h3>`);
        //         }
        //     },
        //     error: function (err) {
        //         console.error(err)
        //     },
        //     complete: function () { }
        // })

    }


    function clear_all() {
        load_product(c_id = null)
        $('#searchProductList').val("")
    }

    function wishlist(product_id) {

        $.ajax({
            url: "<?= base_url('/api/user/id') ?>",
            type: "GET",
            success: function (resp) {
                if (resp.status) {
                    $.ajax({
                        url: "<?= base_url('/api/add/wish-list') ?>",
                        type: "POST",
                        data: {
                            product_id: product_id,
                            user_id: resp.data,
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
                                get_user();

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
                            // console.log(err)
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
                // console.log(err)
            },
        })


    }
</script>