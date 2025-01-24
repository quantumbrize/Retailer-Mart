<style>
    .varient_img {
        height: 60px !important;
        width: 60px !important;
        object-fit: contain;
    }

    #price_lists {
        display: flex;
        /* Use flexbox for side-by-side layout */
        gap: 10px;
        /* Add some space between items */
        flex-wrap: wrap;
        /* Allow wrapping if needed */
    }

    .cart-price-item {
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        flex: 0 1 auto;
        /* Prevent stretching */
    }

    #sticky-product-img {
        object-fit: contain;
    }
     .quantity {
        background-color: transparent !important;
     }
</style>
<!-- Start of Main -->
<main class="main mb-10 pb-1">
    <!-- End of Breadcrumb -->

    <!-- Start of Page Content -->
    <div class="page-content">
        <div class="container">
            <div class="row gutter-lg">
                <div class="main-content">
                    <div class="product product-single row">
                        <div class="col-md-6 mb-6">
                            <div class="product-gallery product-gallery-sticky">
                            
                                <div class="swiper-container product-single-swiper swiper-theme nav-inner product-single-swiper-javascript"
                                    data-swiper-options="{
                                            'navigation': {
                                                'nextEl': '.button-next-main',
                                                'prevEl': '.button-prev-main'
                                            }
                                        }" >
                                    <div class="swiper-wrapper row cols-1 gutter-no" id="main_image"></div>
                                    <button class="swiper-button-next button-next-main"></button>
                                    <button class="swiper-button-prev button-prev-main"></button>
                                </div>
                                <div class="product-thumbs-wrap swiper-container product-thumbs-javascript" data-swiper-options="{
                                            'navigation': {
                                                'nextEl': '.swiper-button-next button-next-sub',
                                                'prevEl': '.swiper-button-prev button-next-sub'
                                            }
                                        }">
                                    <div class="product-thumbs swiper-wrapper row cols-4 gutter-sm"  id="all_slider_image"></div>
                                    <button class="swiper-button-next button-next-sub"></button>
                                    <button class="swiper-button-prev button-next-sub"></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 mb-md-6">
                            <div class="product-details" data-sticky-options="{'minWidth': 767}">
                                <h1 class="product-title" id="product_name"></h1>
                                <div class="product-bm-wrapper"
                                    style="display: flex;align-items: center;justify-content: space-between;">
                                    <div class="product-meta">
                                        <div class="product-categories">
                                            Category:
                                            <span class="product-category"><a href="#" id="product_category"></a></span>
                                        </div>
                                        <div class="product-sku">
                                            <span style="color: red;" id="stock_msg"></span>
                                        </div>
                                    </div>
                                    <div id="saveBx">
                                        <a href="javascript:void(0)"
                                            class="btn-product-icon btn-wishlist w-icon-heart ${resp.data[0].is_wishlisted ? '-full' : ''}"
                                            data-product-id="<?= $_GET['id'] ?>"
                                            onclick="wishlist('<?= $_GET['id'] ?>')">
                                        </a>
                                    </div>
                                </div>

                                <hr class="product-divider">
                                <style>
                                    .cart-product-price {
                                        border-bottom: 1px solid #e6e7eb;
                                        padding-bottom: 20px;
                                        margin-top: 20px;
                                    }

                                    .cart-product-price .cart-price-list .cart-price span {
                                        font-size: 18px;
                                        color: #000;
                                        font-weight: 600;
                                    }

                                    @media screen and (max-width: 1480px) {
                                        .cart-product-price .cart-price-list .cart-price-item .cart-quantity {
                                            font-size: 15px;
                                            line-height: 20px;
                                        }
                                    }
                                </style>
                                <div class="cart-product-price">
                                    <div class="cart-price-list" id="price_lists"></div>
                                </div>

                                <div class="ratings-container">
                                    <div class="ratings-full" id="product_rating">
                                        
                                    </div>
                                    <a href="javascript:void(0)" class="rating-reviews scroll-to" id="no_of_review">(0
                                        Reviews)</a>
                                </div>

                                <div class="product-short-desc">
                                   
                                </div>

                                <hr class="product-divider">

                                <div class="product-form product-variation-form product-color-swatch">
                                    <label>Varient:</label>
                                    <div class="d-flex align-items-center product-variations" id="all_varient_img">
                                    </div>
                                </div>
                                <div class="product-form product-variation-form product-size-swatch">
                                    <label class="mb-1">Size:</label>
                                    <div class="flex-wrap d-flex align-items-center product-variations"
                                        id="product_size">

                                    </div>
                                </div>
                                <div class="product-variation-price">
                                    <label>Discount:</label>
                                    <span id="product_discount">
                                    </span>
                                </div>

                                <div class="product-variation-price">
                                    <span id="product_price"></span>
                                </div>

                                <div class="fix-bottom product-sticky-content sticky-content">
                                    <div class="product-form container" id="product_add_to_cart_button">
                                        <div class="product-qty-form">
                                            <div class="input-group" id="quantity-section">
                                                <input class="quantity form-control" type="number" min="1"
                                                    max="10000000" onkeyup="check_input_field()">
                                                <!-- <button class="quantity-plus w-icon-plus"
                                                    onclick="quantity_increase()"></button>
                                                <button class="quantity-minus w-icon-minus"
                                                    onclick="quantity_decrease()"></button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab tab-nav-boxed tab-nav-underline product-tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a href="#product-tab-description" class="nav-link active">Description</a>
                            </li>
                            <li class="nav-item">
                                <a href="#product-tab-reviews" class="nav-link">Customer Reviews</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="product-tab-description">
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-5">
                                        <h4 class="title tab-pane-title font-weight-bold mb-2">Detail</h4>
                                        <p class="mb-4" id="product_description"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="product-tab-specification">
                                <ul class="list-none">
                                    <li>
                                        <label>Model</label>
                                        <p>Skysuite 320</p>
                                    </li>
                                    <li>
                                        <label>Color</label>
                                        <p>Black</p>
                                    </li>
                                    <li>
                                        <label>Size</label>
                                        <p>Large, Small</p>
                                    </li>
                                    <li>
                                        <label>Guarantee Time</label>
                                        <p>3 Months</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-pane" id="product-tab-vendor">
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-4">
                                        <figure class="vendor-banner br-sm">
                                            <img src="<?= base_url() ?>public/assets/images/products/vendor-banner.jpg"
                                                alt="Vendor Banner" width="610" height="295"
                                                style="background-color: #353B55;">
                                        </figure>
                                    </div>
                                    <div class="col-md-6 pl-2 pl-md-6 mb-4">
                                        <div class="vendor-user">
                                            <figure class="vendor-logo mr-4">
                                                <a href="#">
                                                    <img src="<?= base_url() ?>public/assets/images/products/vendor-logo.jpg"
                                                        alt="Vendor Logo" width="80" height="80">
                                                </a>
                                            </figure>
                                            <div>
                                                <div class="vendor-name"><a href="#">Jone Doe</a></div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 90%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <a href="#" class="rating-reviews">(32 Reviews)</a>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="vendor-info list-style-none">
                                            <li class="store-name">
                                                <label>Store Name:</label>
                                                <span class="detail">OAIO Store</span>
                                            </li>
                                            <li class="store-address">
                                                <label>Address:</label>
                                                <span class="detail">Steven Street, El Carjon, CA 92020, United
                                                    States (US)</span>
                                            </li>
                                            <li class="store-phone">
                                                <label>Phone:</label>
                                                <a href="#tel:">1234567890</a>
                                            </li>
                                        </ul>
                                        <a href="vendor-dokan-store.html"
                                            class="btn btn-dark btn-link btn-underline btn-icon-right">Visit
                                            Store<i class="w-icon-long-arrow-right"></i></a>
                                    </div>
                                </div>
                                <p class="mb-5"><strong class="text-dark">L</strong>orem ipsum dolor sit amet,
                                    consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                                    dolore magna aliqua.
                                    Venenatis tellus in metus vulputate eu scelerisque felis. Vel pretium
                                    lectus quam id leo in vitae turpis massa. Nunc id cursus metus aliquam.
                                    Libero id faucibus nisl tincidunt eget. Aliquam id diam maecenas ultricies
                                    mi eget mauris. Volutpat ac tincidunt vitae semper quis lectus. Vestibulum
                                    mattis ullamcorper velit sed. A arcu cursus vitae congue mauris.
                                </p>
                                <p class="mb-2"><strong class="text-dark">A</strong> arcu cursus vitae congue
                                    mauris. Sagittis id consectetur purus
                                    ut. Tellus rutrum tellus pellentesque eu tincidunt tortor aliquam nulla.
                                    Diam in
                                    arcu cursus euismod quis. Eget sit amet tellus cras adipiscing enim eu. In
                                    fermentum et sollicitudin ac orci phasellus. A condimentum vitae sapien
                                    pellentesque
                                    habitant morbi tristique senectus et. In dictum non consectetur a erat. Nunc
                                    scelerisque viverra mauris in aliquam sem fringilla.</p>
                            </div>
                            <div class="tab-pane" id="product-tab-reviews">
                                <div class="row mb-4">
                                    <div class="col-xl-4 col-lg-5 mb-4">
                                        <div class="ratings-wrapper">
                                            <div class="avg-rating-container">
                                                <h4 class="avg-mark font-weight-bolder ls-50" id="overall_rateing"></h4>
                                                <div class="avg-rating">
                                                    <p class="text-dark mb-1">Average Rating</p>
                                                    <div class="ratings-container">
                                                        <!-- <div class="ratings-full">
                                                                    <span class="ratings" style="width: 60%;"></span>
                                                                    <span class="tooltiptext tooltip-top"></span>
                                                                </div> -->
                                                        <a href="#" class="rating-reviews" id="total_rateing"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ratings-value d-flex align-items-center text-dark ls-25">
                                                <!-- <span class="text-dark font-weight-bold">66.7%</span>Recommended<span class="count">(2 of 3)</span> -->
                                            </div>
                                            <div class="ratings-list">
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 100%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <div class="progress-bar progress-bar-sm " id="overall_5star">
                                                        <!-- <span style="width: 10% !important;"></span> -->
                                                    </div>
                                                    <div class="progress-value">
                                                        <mark id="5star_parcent">0%</mark>
                                                    </div>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 80%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <div class="progress-bar progress-bar-sm " id="overall_4star">
                                                        <!-- <span></span> -->
                                                    </div>
                                                    <div class="progress-value">
                                                        <mark id="4star_parcent">0%</mark>
                                                    </div>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 60%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <div class="progress-bar progress-bar-sm " id="overall_3star">
                                                        <!-- <span></span> -->
                                                    </div>
                                                    <div class="progress-value">
                                                        <mark id="3star_parcent">0%</mark>
                                                    </div>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 40%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <div class="progress-bar progress-bar-sm " id="overall_2star">
                                                        <!-- <span></span> -->
                                                    </div>
                                                    <div class="progress-value">
                                                        <mark id="2star_parcent">0%</mark>
                                                    </div>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 20%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <div class="progress-bar progress-bar-sm " id="overall_1star">
                                                        <!-- <span></span> -->
                                                    </div>
                                                    <div class="progress-value">
                                                        <mark id="1star_parcent">0%</mark>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-8 col-lg-7 mb-4">
                                        <div class="review-form-wrapper">
                                            <h3 class="title tab-pane-title font-weight-bold mb-1">Submit Your
                                                Review</h3>
                                            <p class="mb-3">Your email address will not be published. Required
                                                fields are marked *</p>
                                            <form action="#" method="POST" class="review-form">
                                                <div class="rating-form">
                                                    <label for="rating">Your Rating Of This Product :</label>
                                                    <div class="star-rating">
                                                        <input type="radio" id="star5" name="rating" value="5" /><label
                                                            for="star5" title="5 stars">★</label>
                                                        <input type="radio" id="star4" name="rating" value="4" /><label
                                                            for="star4" title="4 stars">★</label>
                                                        <input type="radio" id="star3" name="rating" value="3" /><label
                                                            for="star3" title="3 stars">★</label>
                                                        <input type="radio" id="star2" name="rating" value="2" /><label
                                                            for="star2" title="2 stars">★</label>
                                                        <input type="radio" id="star1" name="rating" value="1" /><label
                                                            for="star1" title="1 star">★</label>
                                                    </div>
                                                    
                                                </div>
                                                <textarea cols="30" rows="6" placeholder="Write Your Review Here..."
                                                    class="form-control" id="reviewContent"></textarea>
                                                <div class="row gutter-md">
                                                   
                                                </div>
                                                
                                                <button type="submit" class="btn btn-dark" id="review_add_btn"
                                                    onclick="submit_review()">Submit
                                                    Review</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a href="#show-all" class="nav-link active">All Reviews</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="show-all">
                                            <ul class="comments list-style-none" id="list_of_reviews"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="vendor-product-section">
                        <div class="title-link-wrapper mb-4">
                            <h4 class="title text-left">More Products From This Vendor</h4>
                            <!-- <a href="#" class="btn btn-dark btn-link btn-slide-right btn-icon-right">More
                                        Products<i class="w-icon-long-arrow-right"></i></a> -->
                        </div>
                        <div class="swiper-container swiper-container-vendor swiper-theme" data-swiper-options="{
                                    'spaceBetween': 20,
                                    'slidesPerView': 2,
                                    'breakpoints': {
                                        '576': {
                                            'slidesPerView': 3
                                        },
                                        '768': {
                                            'slidesPerView': 4
                                        },
                                        '992': {
                                            'slidesPerView': 3
                                        }
                                    }
                                }">
                            <div class="swiper-wrapper row cols-lg-3 cols-md-4 cols-sm-3 cols-2"
                                id="same_vendor_product">
                            </div>
                        </div>
                    </section>
                </div>
                <!-- End of Main Content -->
                <aside class="sidebar product-sidebar sidebar-fixed right-sidebar sticky-sidebar-wrapper">
                    <div class="sidebar-overlay"></div>
                    <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                    <a href="#" class="sidebar-toggle d-flex d-lg-none"><i class="fas fa-chevron-left"></i></a>
                    <div class="sidebar-content scrollable">
                        <div class="sticky-sidebar">
                            <div class="widget widget-icon-box mb-6">
                            </div>
                            <!-- End of Widget Icon Box -->

                            <div class="widget widget-banner mb-9">
                                <div class="banner banner-fixed br-sm">
                                    <figure>
                                        <img src="<?= base_url() ?>public/assets/images/shop/banner3.jpg" alt="Banner"
                                            width="266" height="220" style="background-color: #1D2D44;">
                                    </figure>
                                    <div class="banner-content">
                                        <div class="banner-price-info font-weight-bolder text-white lh-1 ls-25">
                                            40<sup class="font-weight-bold">%</sup><sub
                                                class="font-weight-bold text-uppercase ls-25">Off</sub>
                                        </div>
                                        <h4 class="banner-subtitle text-white font-weight-bolder text-uppercase mb-0">
                                            Ultimate Sale</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Widget Banner -->

                            <div class="widget widget-products">
                                <div class="title-link-wrapper mb-2">
                                    <h4 class="title title-link font-weight-bold">Similar Products</h4>
                                </div>

                                <div class="nav-top">
                                    <div class="swiper-container swiper-theme nav-top">
                                        <div class="swiper-wrapper">
                                            <div class="widget-col swiper-slide" id="similar_product">
                                            </div>
                                        </div>
                                        <button class="swiper-button-next"></button>
                                        <button class="swiper-button-prev"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <!-- End of Sidebar -->
            </div>
        </div>
    </div>
    <!-- End of Page Content -->
</main>
<!-- End of Main -->