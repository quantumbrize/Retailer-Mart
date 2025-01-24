<style>
    .out_of_stock {
        background-color: #f8f9fa;
        color: #fff;
        background-color: #f8f9fa;
        color: #adb5bd;
        border: none;
        outline: none;
        cursor: not-allowed;
    }

    .cart-icon-container {
        position: relative;
        /* Make this container the reference for positioning */
        display: inline-block;
        /* Ensure it behaves like a block-level element but doesn't take up the full width */
    }

    #cart_count_mobile {
        position: absolute;
        /* Absolute positioning relative to the parent (cart-icon-container) */
        top: -10px;
        /* Align it to the top */
        right: 0;
        /* Align it to the right */
        background-color: #ff4100;
        /* Red background */
        color: black;
        /* Text color */
        padding: 0;
        /* No padding, as we're setting width and height */
        border-radius: 50%;
        /* Make it circular */
        font-size: 8px;
        /* Adjust text size */
        font-weight: bold;
        /* Make it stand out */
        height: 18px;
        /* Set the height */
        width: 18px;
        /* Set the width */
        display: flex;
        /* Use flexbox to center the text */
        justify-content: center;
        /* Center horizontally */
        align-items: center;
        /* Center vertically */
        text-align: center;
        /* Ensures text alignment is centered */
    }

    .cart-style {
        font-size: 24px;
        /* Adjust the size of the cart icon */
    }


    #cart_count {
        margin-bottom: 20px;
        margin-right: -25px;
        border: 1px solid #ff4100;
        background-color: #ff4100;
        border-radius: 100%;
        height: 18px;
        width: 18px;
        text-align: center;
        z-index: 99;
        color: black;
    }

    #wishlist_count {
        margin-bottom: 20px;
        margin-right: -25px;
        border: 1px solid #ff4100;
        background-color: #ff4100;
        border-radius: 100%;
        height: 18px;
        width: 18px;
        text-align: center;
        z-index: 99;
        color: black;
    }

    ul.megamenu {
        display: none;
    }

    .right-angle-icon.rotated {
        transform: rotate(90deg);
    }
</style>



</head>

<body class="home">
    <div class="page-wrapper">
        <h1 class="d-none">Candyflow</h1>
        <!-- Start of Header -->
        <header class="header">
            <div class="header-top">
                <div class="container">
                    <div class="header-left">
                        <p id="notice" class="welcome-msg"></p>
                    </div>

                </div>
            </div>
            <!-- End of Header Top -->
            <style>
                /* Search Box */
                /* Container styling */
                .search-container {
                    position: relative;
                    /* width: 61rem; */
                }

                /* Suggestion box styles */
                .suggestion-box {
                    position: absolute;
                    top: 108%;
                    /* left: 0; */
                    width: 95% !important;
                    max-height: 200px;
                    overflow-y: auto;
                    background: #fff;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    list-style: none;
                    margin: 0;
                    /* margin-top: 3px; */
                    margin-left: 10px !important;
                    padding: 0;
                    z-index: 1000;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                }

                /* Suggestion items */
                .suggestion-box li {
                    padding: 8px 12px;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    font-size: 14px;
                    color: #333;
                }

                .suggestion-box li:hover {
                    background-color: #f0f0f0;
                }

                /* Icons and category label */
                .suggestion-box li i {
                    margin-right: 10px;
                    color: #888;
                }

                .suggestion-category {
                    color: #666;
                    font-size: 12px;
                    margin-left: 10px;
                }

                /* Search End */
            </style>
            <div class="header-middle">
                <div class="container">
                    <div class="header-left mr-md-4">
                        <a href="#" class="mobile-menu-toggle  w-icon-hamburger" aria-label="menu-toggle">
                        </a>
                        <a href="<?= base_url() ?>" class="logo ml-lg-0">
                            <img class="company_logo" src="" alt="logo" width="180" height="45">
                        </a>
                        <div class="search-container">
                            <input type="text" id="searchInput" placeholder="Search your items" class="transparent-bg"
                                oninput="product_search()">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <!-- <ul id="suggestionBox"></ul> -->
                            <ul id="suggestionBox" class="suggestion-box"></ul>
                        </div>



                        <a href="javascript:void(0)" class="icon-link  wishlist-mobile" onclick="redirect_cart_page()"
                            style="display: none;">
                            <div class="cart-icon-container">
                                <span id="cart_count_mobile" class="cart-count-badge"></span>
                                <i class="fas fa-shopping-cart cart-style"></i>
                            </div>

                        </a>

                        <div class="icons" id="authorised_account">
                        </div>
                    </div>


                </div>
            </div>
            <!-- End of Header Middle -->

            <div class="header-bottom sticky-content fix-top sticky-header has-dropdown">
                <div class="container">
                    <div class="inner-wrap">
                        <div class="header-left">
                            <div class="dropdown category-dropdown has-border" data-visible="true">
                                <a href="#" class="category-toggle text-dark" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="true" data-display="static"
                                    title="Browse Categories">
                                    <i class="w-icon-category"></i>
                                    <span>Browse Categories</span>
                                </a>

                                <div class="dropdown-box">
                                    <ul class="menu vertical-menu category-menu" id="catalog_category">
                                    </ul>
                                </div>
                            </div>
                            <nav class="main-nav">
                                <ul class="menu active-underline">
                                    <li class="<?= isset($header['home']) ? 'active' : '' ?>">
                                        <a href="<?= base_url() ?>">Home</a>
                                    </li>
                                    <li class="<?= isset($header['product_list']) ? 'active' : '' ?>">
                                        <a href="<?= base_url('product/list') ?>">Shop</a>
                                    </li>

                                    <li class="<?= isset($header['about']) ? 'active' : '' ?>">
                                        <a href="<?= base_url('about-us') ?>">About Us</a>
                                    </li>
                                    <li class="<?= isset($header['become_a_vendor']) ? 'active' : '' ?>">
                                        <a href="<?= base_url('become-a-vendor') ?>">Become a Vendor</a>
                                    </li>
                                    <li class="<?= isset($header['contact']) ? 'active' : '' ?>">
                                        <a href="<?= base_url('contact-us') ?>">Contact Us</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="header-right">
                            <a href="<?= base_url('order/history') ?>" class="d-xl-show"><i
                                    class="w-icon-map-marker mr-1"></i>My Order</a>
                            <a href="<?= base_url('daily-deals') ?>" style="margin-right: -18px;"><i
                                    class="w-icon-sale"></i>Daily Deals</a>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .right-angle-parent {
                    position: relative;
                }

                .right-angle-icon {
                    position: absolute;
                    top: 50%;
                    right: 10px;
                    font-size: 8px !important;
                    font-weight: 900 !important;
                }

                .cat-img-size {
                    height: 30px;
                    width: 30px;
                }
            </style>
        </header>
        <!-- End of Header -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            let user_id = '<?= isset($_SESSION['USER_user_id']) ? $_SESSION['USER_user_id'] : '' ?>'
            get_user();
            function get_user() {
                $.ajax({
                    url: "<?= base_url('api/user') ?>",
                    type: "GET",
                    data: {
                        user_id: user_id
                    },
                    success: function (resp) {
                        let html = '';
                        let htmllF = '';

                        if (resp.status) {
                            var image_url = `https://cdn-icons-png.flaticon.com/512/8847/8847419.png`;
                            if (resp.user_img != null) {
                                image_url = `<?= base_url('public/uploads/user_images/') ?>${resp.user_img.img}`;
                            }

                            // Logged in state
                            html = `<a href="<?= base_url('wishlist') ?>" class="icon-link" id="wishlist-link">
                                        ${resp.wishlists ? `<span id="wishlist_count">${resp.wishlists.length > 0 ? resp.wishlists.length : ''}</span>` : ''}
                                        <i class="fas fa-heart"></i> Wishlist
                                    </a>
                                    <a href="javascript:void(0)" class="icon-link" onclick="redirect_cart_page()" id="cart-link">
                                        <span id="cart_count" class="cart-count-badge">${resp.cart.length > 0 ? resp.cart.length : ''}</span>    
                                        <i class="fas fa-shopping-cart cart-icon"></i> 
                                        Cart
                                    </a>
                                    <a href="<?= base_url('user/account') ?>" class="icon-link">
                                        <i class="fas fa-user"></i> Account
                                    </a>
                                    <a href="javascript:void(0)" class="signup-btn" onclick="logout()" style="text-decoration: none;">Logout</a>`;

                            // Sticky icons for logged-in user
                            htmllF = `
                                    <a id="cart-icon-f" class="sticky-icon cart-icon" onclick="redirect_cart_page()">
                                        <i class="fas fa-shopping-cart"></i>
                                        <div id="cartCountBx">
                                        <span class="badge" id="cart-count">${resp.cart.length > 0 ? resp.cart.length : ''}</span>
                                        </div>
                                    </a>
                                    <a id="wishlist-icon-f" class="sticky-icon wishlist-icon" href="<?= base_url('wishlist') ?>">
                                        <i class="fas fa-heart"></i>
                                        ${resp.wishlists ? `<span class="badge" id="wishlist-count">${resp.wishlists.length > 0 ? resp.wishlists.length : ''}</span>` : ''}
                                    </a>
                                    <a id="whatsapp-icon-f" class="sticky-icon whatsapp-icon" href="https://wa.me/9667938288" target="_blank">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </a>`;

                            // Enable links
                            $('#wishlist-link').removeClass('disabled').css('pointer-events', 'auto');
                            $('#cart-link').removeClass('disabled').css('pointer-events', 'auto');
                            $('#wishlist-icon-f').removeClass('disabled').css('pointer-events', 'auto');
                        } else {
                            // Not logged in state
                            html = `<a href="<?= base_url('login') ?>" class="icon-link" id="wishlist-link">
                                        <i class="fas fa-heart"></i> Wishlist
                                    </a>
                                    <a href="<?= base_url('login') ?>" class="icon-link"  id="cart-link">
                                        <span id="cart_count" class="cart-count-badge"></span>    
                                        <i class="fas fa-shopping-cart cart-icon"></i> 
                                        Cart
                                    </a><a href="<?= base_url('login') ?>" class="icon-link">
                                    <i class="fas fa-user"></i> SignIn
                                </a>
                                <a href="<?= base_url('sign-up') ?>" class="signup-btn" style="text-decoration: none;">SignUp</a>`;

                            // Sticky icons for not logged-in user
                            htmllF = `
                            <a id="cart-icon-f" class="sticky-icon cart-icon" style="pointer-events: none;">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                            <a id="wishlist-icon-f" class="sticky-icon wishlist-icon" href="<?= base_url('wishlist') ?>" style="pointer-events: none;">
                                <i class="fas fa-heart"></i>
                            </a>
                            <a id="whatsapp-icon-f" class="sticky-icon whatsapp-icon" href="https://wa.me/9667938288" target="_blank">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>`;
                        }

                        // Update HTML
                        $('#authorised_account').html(html);
                        $('#sticky-icons').html(htmllF);
                    },
                    error: function (err) {
                        console.log(err);
                    },
                });
            }


            $(document).ready(function () {
                catalog()
            })

            let suggestions = [
                // { name: "phone", category: "in Mobiles" },
                // { name: "photo frames", category: "in Photo Frames" },
            ];



            function showSuggestions() {
                const input = document.getElementById("searchInput").value.toLowerCase();
                const suggestionBox = document.getElementById("suggestionBox");
                suggestionBox.innerHTML = ""; // Clear previous suggestions

                if (input) {
                    const filteredSuggestions = suggestions.filter((item) =>
                        item.name.toLowerCase().includes(input)
                    );

                    filteredSuggestions.forEach((item) => {
                        const li = document.createElement("li");

                        // If the item has a product ID, add a click handler for redirection
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
                                document.getElementById("searchInput").value = item.name;
                                suggestionBox.innerHTML = ""; // Hide suggestions
                            }
                        });

                        suggestionBox.appendChild(li);
                    });
                }
            }

            function product_search() {
                var alphabet = $('#searchInput').val();
                $.ajax({
                    url: "<?= base_url('/api/search/product') ?>",
                    type: "GET",
                    data: {
                        alph: alphabet
                    },
                    beforeSend: function () {
                    },
                    success: function (resp) {
                        console.log(resp);
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
                        }
                        showSuggestions();
                    },
                    error: function (err) {
                        console.error(err);
                    },
                    complete: function () { }
                });
            }


            

            function catalog() {
                $.ajax({
                    url: "<?= base_url('api/categories/all') ?>",
                    type: "GET",
                    success: function (resp) {
                        if (resp.status) {
                            console.log('catalog', resp.data);

                            $.each(resp.data, function (index1, parent) {
                                var main_html = `<li id="catalog_subCategory${index1}" class="right-angle-parent">
                                                <a href="<?= base_url('product/category?c_id=') ?>${parent.uid}">
                                                    <img class="cat-img-size" src="<?= base_url('public/uploads/category_images/') ?>${parent.img_path}" alt="">
                                                    <b>${parent.name}</b>
                                                </a>
                                            </li>`;

                                var main_html_mob = `<li id="catalog_subCategory_mob${index1}" class="right-angle-parent">
                                                    <a href="<?= base_url('product/category?c_id=') ?>${parent.uid}">
                                                        <img class="cat-img-size" src="<?= base_url('public/uploads/category_images/') ?>${parent.img_path}" alt=""> 
                                                        ${parent.name}
                                                    </a>
                                                </li>`;

                                $('#catalog_category').append(main_html);
                                $('#catalog_category_mob').append(main_html_mob);

                                // Subcategories
                                if (Array.isArray(parent.subCategories) && parent.subCategories.length > 0) {
                                    let subcat_html = `<i class="fas fa-chevron-right right-angle-icon"></i>
                                                    <ul class="megamenu" id="html_sub_cat_${index1}" style="display: none;">
                                                    </ul>`;

                                    let subcat_html_mob = `<i class="fas fa-chevron-right right-angle-icon"></i>
                                                    <ul id="html_sub_cat_mob_${index1}" style="display: none;">
                                                    </ul>`;

                                    $('#catalog_subCategory' + index1).append(subcat_html);
                                    $('#catalog_subCategory_mob' + index1).append(subcat_html_mob);

                                    $.each(parent.subCategories, function (index2, subCat) {
                                        var html_sub = `
                                            <li>
                                                <a href="<?= base_url('product/category?c_id=') ?>${subCat.uid}">
                                                    <h4 class="menu-title">${subCat.name}</h4>
                                                </a>
                                            </li>`;

                                                        var html_sub_mob = `
                                            <li>
                                                <a href="<?= base_url('product/category?c_id=') ?>${subCat.uid}">${subCat.name}</a>
                                            </li>`;

                                        $('#html_sub_cat_' + index1).append(html_sub);
                                        $('#html_sub_cat_mob_' + index1).append(html_sub_mob);
                                    });
                                }
                            });

                            // Event delegation for showing/hiding subcategories
                            $(document).on('click', '.right-angle-parent > a', function (e) {
                                e.preventDefault();
                                const subMenu = $(this).siblings('ul');
                                if (subMenu.length) {
                                    subMenu.slideToggle(); // Toggle visibility
                                    $(this).find('.right-angle-icon').toggleClass('rotated'); // Add rotation for icon if needed
                                }
                            });
                        } else {
                            console.log("No categories found");
                        }
                    },
                    error: function (err) {
                        console.error("Error fetching categories:", err);
                    }
                });
            }


            function redirect_cart_page() {
                // alert(user_id)
                $.ajax({
                    url: '<?= base_url('/api/user/cart') ?>',
                    type: "GET",
                    data: {
                        user_id: user_id
                    },
                    beforeSend: function () { },
                    success: function (resp) {

                        console.log(resp)

                        if (resp.status) {
                            // console.log(resp)

                            window.location.href = '<?= base_url('user/cart') ?>';
                        } else {
                            Toastify({
                                text: 'cart is empty'.toUpperCase(),
                                duration: 2000,
                                position: "center",
                                stopOnFocus: true,
                                style: {
                                    background: 'green',
                                },
                            }).showToast();
                        }

                    },
                    error: function (err) {
                        console.error(err)
                    }
                })
            }

            function increase_click_count(product_id) {
                $.ajax({
                    url: "<?= base_url('/api/user/id') ?>",
                    type: "GET",
                    success: function (resp) {
                        if (resp.status) {
                            $.ajax({
                                url: "<?= base_url('/api/increase/product/click-count') ?>",
                                type: "POST",
                                data: {
                                    product_id: product_id
                                },
                                success: function (resp) {
                                    if (resp.status) {
                                        // Toastify({
                                        //     text: resp.message.toUpperCase(),
                                        //     duration: 3000,
                                        //     position: "center",
                                        //     stopOnFocus: true,
                                        //     style: {
                                        //         background: resp.status ? 'darkgreen' : 'darkred',
                                        //     },
                                        // }).showToast();

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

            function logout() {
                ;
                $.ajax({
                    url: "<?= base_url('logout') ?>",
                    type: "GET",
                    success: function (resp) {
                        window.location.href = '<?= base_url('login') ?>';
                    },
                    error: function () {
                    }
                })
            }
            function show_cart_length() {
                $.ajax({
                    url: '<?= base_url('/api/user/cart') ?>',
                    type: "GET",
                    data: {
                        user_id: user_id  // Use this dynamically based on the logged-in user
                    },
                    success: function (resp) {
                        if (resp.status) {
                            var totalItems = resp.data.length;  // Initialize total item count
                            console.log('itm', totalItems);

                            $('.cart-count-badge').text(totalItems);
                            $('#cartCountBx').html(`<span class="badge" id="cart-count">${totalItems}</span>`)
                            // Assuming resp.data contains an array of cart items with a quantity field

                        } else {
                            $('.cart-count-badge').hide();  // Hide the badge if there's an error or empty cart
                        }
                    },
                    error: function (err) {
                        console.error("Error fetching cart data:", err);
                        $('.cart-count-badge').hide();  // Hide the badge in case of error
                    }
                });
            }

            function get_notice_text() {
                $.ajax({
                    url: "<?= base_url('api/get/notice') ?>",
                    type: "GET",
                    data: {},
                    success: function (resp) {
                        // resp = JSON.parse(resp)
                        // console.log(resp.user_data.number)
                        if (resp.status) {
                            console.log('not', resp);

                            // html=`<a href="${resp.user_data.facebook}" class="social-icon social-facebook w-icon-facebook"></a>
                            //                     <a href="${resp.user_data.twitter}" class="social-icon social-twitter w-icon-twitter"></a>
                            //                     <a href="${resp.user_data.instagram}" class="social-icon social-instagram w-icon-instagram"></a>
                            //                     <a href="${resp.user_data.youtube}" class="social-icon social-youtube w-icon-youtube"></a>`


                            html = `${resp.user_data.notice}`


                            // $('#profile_image').html(`<img src="${user_img}" class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow" alt="user-profile-image">`)
                            // $('#facebooklink').val(resp.user_data.facebook)
                            // $('#twitterlink').val(resp.user_data.twitter)
                            // $('#instagramlink').val(resp.user_data.instagram)
                            // $('#youtubelink').val(resp.user_data.youtube)
                            // $('#uid').val(resp.user_data.uid)
                            // $('#user_name').text(resp.user_data.user_name)
                            // $('#user_role').text(resp.user_data.type)
                            // var image_url = `https://usercontent.one/wp/www.vocaleurope.eu/wp-content/uploads/no-image.jpg?media=1642546813`
                            $('#notice').html(html);
                        } else {
                            console.log(resp)
                        }
                    },
                    error: function (err) {
                        console.log(err)
                    }
                })
            }


            // Call this function on page load to initialize the cart count
            $(document).ready(function () {
                show_cart_length();  // Get the initial cart count
                get_notice_text();
            });
        </script>