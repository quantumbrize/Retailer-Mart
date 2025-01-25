<!-- Start of Main-->
<style>
    /* Apply border and box-shadow only around the text content */
    #font {
        display: inline-block;
        /* Ensures the border wraps only around the text */
        /* padding: 5px 10px;       
        border: 2px solid black;  */
        color: #fff;
        /* Text color */
        text-align: center;
        /* Optional: center the text inside the border */
        margin-bottom: 10px;
        /* Space between elements */
        text-shadow: 10px 10px 6px black;
        /* Adding box shadow */
    }


    /* Optional: Styling adjustments for title and description */
    #but {
        border: 1px solid #fff !important;
        color: #fff !important;
        /* box-shadow: 0 4px 8px black; */
        text-shadow: 10px 10px 6px black;
    }

    .hero-ban {
        background-image: url(<?= base_url('public/uploads/banner_images/') ?>${banner.img});
        background-color: #ebeef2;
        background-size: cover;
        background-position: center;
    }

    /* Adjust the background size for smaller screens */
    @media (max-width: 768px) {
        .hero-ban {
            background-size: contain;
            /* Ensures the image fits entirely within the container */
        }
    }

    /* Adjust the background size for very small screens */
    @media (max-width: 480px) {
        .hero-ban {
            background-size: cover;
            background-position: top center;
            /* Adjust the positioning if necessary */
        }
    }

    @media (max-width: 600px) {
        .category-name {
            font-size: 18px;
        }
    }

    /* Mobile Search */
    .suggestion-box-mob {
        list-style: none;
        margin: 0;
        padding: 0;
        background: #fff;
        border: 1px solid #ccc;
        position: absolute;
        /* width: 100%; */
        width: 90% !important;
        margin-left: 15px !important;
        top: 117%;
        z-index: 1000;
        max-height: 200px;
        overflow-y: auto;
    }

    .suggestion-box-mob li {
        padding: 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .suggestion-box-mob li:hover {
        background-color: #f0f0f0;
    }

    .suggestion-category {
        font-size: 0.9em;
        color: #888;
        margin-left: auto;
    }

</style>
<main class="main">

    <!-- <div class="search-container header-search-mobile">
        <div class="search-wraper">
            <input type="text" placeholder="search your items" class="mobile-transparent-bg">

            <button type="submit" class="mobile-search-btn">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div> -->
    <div class="search-container header-search-mobile">
        <div class="search-wraper">
            <input type="text" placeholder="search your items" class="mobile-transparent-bg" id="mobileSearchInput"
                oninput="mobileProductSearch()">
            <button type="submit" class="mobile-search-btn">
                <i class="fas fa-search"></i>
            </button>
        </div>
        <!-- <ul id="mobileSuggestionBox"></ul> -->
        <ul id="mobileSuggestionBox" class="suggestion-box-mob"></ul>
    </div>


    <section class="intro-section">
        <div class="custom-carousel">
            <div class="custom-carousel-wrapper">
                <!-- <div class="custom-carousel-item">
                    <img src="https://www.axisbank.com/images/default-source/progress-with-us_new/what-is-the-best-time-to-buy-a-used-car.jpg?sfvrsn=66aa0156_2" alt="Slide 1">
                </div>
                <div class="custom-carousel-item">
                    <img src="https://www.axisbank.com/images/default-source/progress-with-us_new/what-is-the-best-time-to-buy-a-used-car.jpg?sfvrsn=66aa0156_2" alt="Slide 2">
                </div>
                <div class="custom-carousel-item">
                    <img src="https://www.axisbank.com/images/default-source/progress-with-us_new/what-is-the-best-time-to-buy-a-used-car.jpg?sfvrsn=66aa0156_2" alt="Slide 3">
                </div> -->
            </div>
            <button class="custom-carousel-btn prev">&#8249;</button>
            <button class="custom-carousel-btn next">&#8250;</button>
        </div>

        <!-- <div class="swiper-container swiper-theme nav-inner pg-inner swiper-nav-lg animation-slider pg-xxl-hide nav-xxl-show nav-hide"
            data-swiper-options="{
                    'slidesPerView': 1,
                    'autoplay': {
                        'delay': 3000,
                        'disableOnInteraction': false
                    }
                }">
            <div class="swiper-wrapper" id="banner_img"> -->
                <!-- <div class="swiper-slide banner banner-fixed intro-slide intro-slide1" style="background-image: url(<?= base_url() ?>public/assets/images/demos/demo1/sliders/slide-1.jpg); background-color: #ebeef2;">
                        <div class="container">
                            <figure class="slide-image skrollable slide-animate">
                                <img src="<?= base_url() ?>public/assets/images/demos/demo1/sliders/shoes.png" alt="Banner" data-bottom-top="transform: translateY(10vh);" data-top-bottom="transform: translateY(-10vh);" width="474" height="397">
                            </figure>
                            <div class="banner-content y-50 text-right">
                                <h5 class="banner-subtitle font-weight-normal text-default ls-50 lh-1 mb-2 slide-animate" data-animation-options="{
                                'name': 'fadeInRightShorter',
                                'duration': '1s',
                                'delay': '.2s'
                            }">
                                    Custom <span class="p-relative d-inline-block">Men’s</span>
                                </h5>
                                <h3 class="banner-title font-weight-bolder ls-25 lh-1 slide-animate" data-animation-options="{
                                'name': 'fadeInRightShorter',
                                'duration': '1s',
                                'delay': '.4s'
                            }">
                                    RUNNING SHOES
                                </h3>
                                <p class="font-weight-normal text-default slide-animate" data-animation-options="{
                                'name': 'fadeInRightShorter',
                                'duration': '1s',
                                'delay': '.6s'
                            }">
                                    Sale up to <span class="font-weight-bolder text-secondary">30% OFF</span>
                                </p>

                                <a href="shop-list.html" class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate" data-animation-options="{
                                'name': 'fadeInRightShorter',
                                'duration': '1s',
                                'delay': '.8s'
                            }">SHOP NOW<i class="w-icon-long-arrow-right"></i></a>

                            </div>
                        </div>
                    </div> -->
                <!-- End of .intro-slide1 -->

                <!-- <div class="swiper-slide banner banner-fixed intro-slide intro-slide2" style="background-image: url(<?= base_url() ?>public/assets/images/demos/demo1/sliders/slide-2.jpg); background-color: #ebeef2;">
                        <div class="container">
                            <figure class="slide-image skrollable slide-animate" data-animation-options="{
                                'name': 'fadeInUpShorter',
                                'duration': '1s'
                            }">
                                <img src="<?= base_url() ?>public/assets/images/demos/demo1/sliders/men.png" alt="Banner" data-bottom-top="transform: translateX(10vh);" data-top-bottom="transform: translateX(-10vh);" width="480" height="633">
                            </figure>
                            <div class="banner-content d-inline-block y-50">
                                <h5 class="banner-subtitle font-weight-normal text-default ls-50 slide-animate" data-animation-options="{
                                    'name': 'fadeInUpShorter',
                                    'duration': '1s',
                                    'delay': '.2s'
                                }">
                                    Mountain-<span class="text-secondary">Climbing</span>
                                </h5>
                                <h3 class="banner-title font-weight-bolder text-dark mb-0 ls-25 slide-animate" data-animation-options="{
                                    'name': 'fadeInUpShorter',
                                    'duration': '1s',
                                    'delay': '.4s'
                                }">
                                    Hot & Packback
                                </h3>
                                <p class="font-weight-normal text-default slide-animate" data-animation-options="{
                                    'name': 'fadeInUpShorter',
                                    'duration': '1s',
                                    'delay': '.8s'
                                }">
                                    Only until the end of this week.
                                </p>
                                <a href="shop-banner-sidebar.html" class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate" data-animation-options="{
                                    'name': 'fadeInUpShorter',
                                    'duration': '1s',
                                    'delay': '1s'
                                }">
                                    SHOP NOW<i class="w-icon-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div> -->
                <!-- End of .intro-slide2 -->

                <!-- <div class="swiper-slide banner banner-fixed intro-slide intro-slide3" style="background-image: url(<?= base_url() ?>public/assets/images/demos/demo1/sliders/slide-3.jpg); background-color: #f0f1f2;">
                        <div class="container">
                            <figure class="slide-image skrollable slide-animate" data-animation-options="{
                                'name': 'fadeInDownShorter',
                                'duration': '1s'
                            }">
                                <img src="<?= base_url() ?>public/assets/images/demos/demo1/sliders/skate.png" alt="Banner" data-bottom-top="transform: translateY(10vh);" data-top-bottom="transform: translateY(-10vh);" width="310" height="444">
                            </figure>
                            <div class="banner-content text-right y-50">
                                <p class="font-weight-normal text-default text-uppercase mb-0 slide-animate" data-animation-options="{
                                    'name': 'fadeInLeftShorter',
                                    'duration': '1s',
                                    'delay': '.6s'
                                }">
                                    Top weekly Seller
                                </p>
                                <h5 class="banner-subtitle font-weight-normal text-default ls-25 slide-animate" data-animation-options="{
                                    'name': 'fadeInLeftShorter',
                                    'duration': '1s',
                                    'delay': '.4s'
                                }">
                                    Trending Collection
                                </h5>
                                <h3 class="banner-title p-relative font-weight-bolder ls-50 slide-animate" data-animation-options="{
                                    'name': 'fadeInLeftShorter',
                                    'duration': '1s',
                                    'delay': '.2s'
                                }"><span class="text-white mr-4">Roller</span>-skate
                                </h3>
                                <div class="btn-group slide-animate" data-animation-options="{
                                    'name': 'fadeInLeftShorter',
                                    'duration': '1s',
                                    'delay': '.8s'
                                }">
                                    <a href="shop-list.html" class="btn btn-dark btn-outline btn-rounded btn-icon-right">SHOP
                                        NOW<i class="w-icon-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                <!-- End of .intro-slide3 -->
            <!-- </div>
            <div class="swiper-pagination"></div>
            <button class="swiper-button-next"></button>
            <button class="swiper-button-prev"></button>
        </div> -->
        <!-- End of .swiper-container -->
    </section>
    <!-- End of .intro-section -->

    <div class="container">
        <div class="swiper-container appear-animate icon-box-wrapper br-sm mt-6 mb-6 customer-support-style"
            data-swiper-options="{
                'slidesPerView': 1,
                'loop': false,
                'breakpoints': {
                    '576': {
                        'slidesPerView': 2
                    },
                    '768': {
                        'slidesPerView': 3
                    },
                    '1200': {
                        'slidesPerView': 4
                    }
                }
            }">
            <div class="swiper-wrapper row cols-md-4 cols-sm-3 cols-1">
                <div class="swiper-slide icon-box icon-box-side icon-box-primary">
                    <span class="icon-box-icon icon-shipping">
                        <i class="w-icon-truck"></i>
                    </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title font-weight-bold mb-1">Free Shipping & Returns</h4>
                        <p class="text-default">For all orders over Rs. 1000</p>
                    </div>
                </div>
                <div class="swiper-slide icon-box icon-box-side icon-box-primary">
                    <span class="icon-box-icon icon-payment">
                        <i class="w-icon-bag"></i>
                    </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title font-weight-bold mb-1">Secure Payment</h4>
                        <p class="text-default">We ensure secure payment</p>
                    </div>
                </div>
                <div class="swiper-slide icon-box icon-box-side icon-box-primary icon-box-money">
                    <span class="icon-box-icon icon-money">
                        <i class="w-icon-money"></i>
                    </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title font-weight-bold mb-1">Money Back Guarantee</h4>
                        <p class="text-default">Any back within 30 days</p>
                    </div>
                </div>
                <div class="swiper-slide icon-box icon-box-side icon-box-primary icon-box-chat">
                    <span class="icon-box-icon icon-chat">
                        <i class="w-icon-chat"></i>
                    </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title font-weight-bold mb-1">Customer Support</h4>
                        <p class="text-default">Call or email us 24/7</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Iocn Box Wrapper -->

        <!-- <div class="row category-banner-wrapper appear-animate pt-6 pb-8" id="promotion_card"> -->
        <!-- <div class="col-md-6 mb-4">
                    <div class="banner banner-fixed br-xs">
                        <figure>
                            <img src="<?= base_url() ?>public/assets/images/demos/demo1/categories/1-1.jpg" alt="Category Banner" width="610" height="160" style="background-color: #ecedec;">
                        </figure>
                        <div class="banner-content y-50 mt-0">
                            <h5 class="banner-subtitle font-weight-normal text-dark">Get up to <span class="text-secondary font-weight-bolder text-uppercase ls-25">20% Off</span>
                            </h5>
                            <h3 class="banner-title text-uppercase">Sports Outfits<br><span class="font-weight-normal                       text-capitalize">Collection</span>
                            </h3>
                            <div class="banner-price-info font-weight-normal">Starting at <span class="text-secondary                       font-weight-bolder">$170.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="banner banner-fixed br-xs">
                        <figure>
                            <img src="<?= base_url() ?>public/assets/images/demos/demo1/categories/1-2.jpg" alt="Category Banner" width="610" height="160" style="background-color: #636363;">
                        </figure>
                        <div class="banner-content y-50 mt-0">
                            <h5 class="banner-subtitle font-weight-normal text-capitalize">New Arrivals</h5>
                            <h3 class="banner-title text-white text-uppercase">Accessories<br><span class="font-weight-normal text-capitalize">Collection</span></h3>
                            <div class="banner-price-info text-white font-weight-normal text-capitalize">Only From
                                <span class="text-secondary font-weight-bolder">$90.00</span></div>
                        </div>
                    </div>
                </div> -->
        <!-- </div> -->
        <div class="row category-cosmetic-lifestyle appear-animate mb-5 promotion-card-style" id="promotion_card">
            
        </div>

        <!-- <div class="row deals-wrapper appear-animate mb-8">
            <div class="col-lg-9 mb-4">
                <div class="single-product h-100 br-sm">
                    <h4 class="title-sm title-underline font-weight-bolder ls-normal">
                        Deals Hot of The Day
                    </h4>
                    <div class="">
                        <div class="swiper-container swiper-theme nav-top swiper-nav-lg">
                            <div class="swiper-wrapper row cols-1 gutter-no">
                                <div class="swiper-slide">
                                    <div class="product product-single row">
                                        <div class="col-md-6">
                                            <div class="product-gallery product-gallery-sticky product-gallery-vertical">
                                            <div class="custom-carousel2">
                                                <div class="custom-carousel-wrapper2">
                                                    
                                                </div>
                                                <button class="custom-carousel-btn2 prev">&#8249;</button>
                                                <button class="custom-carousel-btn2 next">&#8250;</button>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="product-details scrollable">
                                                <div style="display: flex;align-items: center; justify-content: space-between;">
                                                    <h2 class="product-title mb-1" id="hot_deals_product_name"></h2>
                                                    <div class="product-link-wrapper d-flex" id="wishlist-icon">
                                                        </div>
                                                </div>

                                                <hr class="product-divider">

                                                <div class="product-price"><ins class="new-price ls-50"
                                                        id="hot_deal_price">₹00.00</ins></div>

                                                <div class="product-countdown-container flex-wrap">
                                                    <label class="mr-2 text-default">Offer Ends In:</label>
                                                    <div class="timer">
                                                        <div class="time-section hours">
                                                            <span id="hours">24</span>
                                                            <span class="label">Hours</span>
                                                        </div>
                                                        <div class="time-section minutes">
                                                            <span id="minutes">00</span>
                                                            <span class="label">Minutes</span>
                                                        </div>
                                                        <div class="time-section seconds">
                                                            <span id="seconds">00</span>
                                                            <span class="label">Seconds</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 80%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <a href="#" class="rating-reviews">(3 Reviews)</a>
                                                </div>

                                                <div
                                                    class="product-form product-variation-form product-size-swatch mb-3">
                                                    <label class="mb-1">Size:</label>
                                                    <div class="flex-wrap d-flex align-items-center product-variations"
                                                        id="hot_deal_product_sizes">
                                                        
                                                    </div>
                                                </div>
                                                <div class="product-form pt-4" id="view_btn_hot_deal">
                                                </div>
                                                <div class="social-links-wrapper mt-1">
                                                    <div class="social-links">
                                                    </div>

                                                    <div class="social-links-wrapper mt-1">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="widget widget-products widget-products-bordered h-100">
                    <div class="widget-body br-sm h-100">
                        <h4 class="title-sm title-underline font-weight-bolder ls-normal mb-2">Top 20 Best
                            Seller</h4>
                        <div class="swiper">
                            <div class="swiper-container swiper-theme nav-top swiper-container-best-selling"
                                data-swiper-options="{
                                    'slidesPerView': 1,
                                    'spaceBetween': 20,
                                    'breakpoints': {
                                        '576': {
                                            'slidesPerView': 2
                                        },
                                        '768': {
                                            'slidesPerView': 3
                                        },
                                        '992': {
                                            'slidesPerView': 1
                                        }
                                    }
                                }">
                                <div class="swiper-wrapper row cols-lg-1 cols-md-3" id="best_selling">
                                    
                                </div>
                                <button class="swiper-button-next"></button>
                                <button class="swiper-button-prev"></button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div> -->
    </div>

    <section class="category-section top-category bg-grey pt-10 pb-10 appear-animate">
        <div class="container pb-2">
            <h2 class="title justify-content-center pt-1 ls-normal mb-5">Top Categories Of The Month</h2>
            <div class="swiper">
                <div class="swiper-container swiper-theme pg-show swiper-container-top-cat" data-swiper-options="{
                        'spaceBetween': 20,
                        'slidesPerView': 2,
                        'breakpoints': {
                            '576': {
                                'slidesPerView': 3
                            },
                            '768': {
                                'slidesPerView': 5
                            },
                            '992': {
                                'slidesPerView': 6
                            }
                        }
                    }">

                    <div class="swiper-wrapper row cols-lg-6 cols-md-5 cols-sm-3 cols-2" id="all_categoris_desktop">
                        <!-- <div class="swiper-slide category category-classic category-absolute overlay-zoom br-xs">
                                <a href="shop-banner-sidebar.html" class="category-media">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/categories/2-1.jpg" alt="Category" width="130" height="130">
                                </a>
                                <div class="category-content">
                                    <h4 class="category-name">Fashion</h4>
                                    <a href="shop-banner-sidebar.html" class="btn btn-primary btn-link btn-underline">Shop
                                        Now</a>
                                </div>
                            </div>
                            <div class="swiper-slide category category-classic category-absolute overlay-zoom br-xs">
                                <a href="shop-banner-sidebar.html" class="category-media">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/categories/2-2.jpg" alt="Category" width="130" height="130">
                                </a>
                                <div class="category-content">
                                    <h4 class="category-name">Furniture</h4>
                                    <a href="shop-banner-sidebar.html" class="btn btn-primary btn-link btn-underline">Shop
                                        Now</a>
                                </div>
                            </div>
                            <div class="swiper-slide category category-classic category-absolute overlay-zoom br-xs">
                                <a href="shop-banner-sidebar.html" class="category-media">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/categories/2-3.jpg" alt="Category" width="130" height="130">
                                </a>
                                <div class="category-content">
                                    <h4 class="category-name">Shoes</h4>
                                    <a href="shop-banner-sidebar.html" class="btn btn-primary btn-link btn-underline">Shop
                                        Now</a>
                                </div>
                            </div>
                            <div class="swiper-slide category category-classic category-absolute overlay-zoom br-xs">
                                <a href="shop-banner-sidebar.html" class="category-media">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/categories/2-4.jpg" alt="Category" width="130" height="130">
                                </a>
                                <div class="category-content">
                                    <h4 class="category-name">Sports</h4>
                                    <a href="shop-banner-sidebar.html" class="btn btn-primary btn-link btn-underline">Shop
                                        Now</a>
                                </div>
                            </div>
                            <div class="swiper-slide category category-classic category-absolute overlay-zoom br-xs">
                                <a href="shop-banner-sidebar.html" class="category-media">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/categories/2-5.jpg" alt="Category" width="130" height="130">
                                </a>
                                <div class="category-content">
                                    <h4 class="category-name">Games</h4>
                                    <a href="shop-banner-sidebar.html" class="btn btn-primary btn-link btn-underline">Shop
                                        Now</a>
                                </div>
                            </div>
                            <div class="swiper-slide category category-classic category-absolute overlay-zoom br-xs">
                                <a href="shop-banner-sidebar.html" class="category-media">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/categories/2-6.jpg" alt="Category" width="130" height="130">
                                </a>
                                <div class="category-content">
                                    <h4 class="category-name">Computers</h4>
                                    <a href="shop-banner-sidebar.html" class="btn btn-primary btn-link btn-underline">Shop
                                        Now</a>
                                </div>
                            </div> -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of .category-section top-category -->

    <div class="container">
        <h2 class="title justify-content-center ls-normal mb-4 mt-10 pt-1 appear-animate">Popular Departments
        </h2>
        <div class="tab tab-nav-boxed tab-nav-outline appear-animate">
            <ul class="nav nav-tabs justify-content-center" role="tablist">
                <div class="row">
                    <!-- <div class="col-4">
                        <li class="nav-item mr-2 mb-2">
                            <a class="nav-link active br-sm font-size-md ls-normal" href="#tab1-1">New arrivals</a>
                        </li>
                    </div> -->
                    <!-- <div class="col-4">
                        <li class="nav-item mr-2 mb-2">
                            <a class="nav-link br-sm font-size-md ls-normal" href="#tab1-2">Best seller</a>
                        </li>
                    </div>
                    <div class="col-4">
                        <li class="nav-item mr-2 mb-2">
                            <a class="nav-link br-sm font-size-md ls-normal" href="#tab1-3">Most popular</a>
                        </li>
                    </div> -->
                </div>
            </ul>

        </div>
        <!-- End of Tab -->
        <div class="tab-content product-wrapper appear-animate">
            <div class="tab-pane active pt-4" id="tab1-1">
                <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2" id="latest_arriva">
                    <!-- <div class="product-wrap">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="product-details.html">
                                        <img src="<?= base_url() ?>public/assets/images/products/Extra-Products/watch1.jpg" alt="Product" width="300" height="338">
                                        <img src="<?= base_url() ?>public/assets/images/products/Extra-Products/watch1.jpg" alt="Product" width="300" height="338">
                                    </a>
                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                                        </div>
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a href="product-details.html">Classic Hat</a></h4>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: 60%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="product-details.html" class="rating-reviews">(1 Reviews)</a>
                                    </div>
                                    <div class="product-price">
                                        <ins class="new-price">$53.00</ins>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="product-details.html">
                                        <img src="<?= base_url() ?>public/assets/images/products/Extra-Products/watch2.jpg"alt="Product" width="300" height="338">
                                    </a>
                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                                        </div>
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a href="product-details.html">Watch</a></h4>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: 80%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="product-details.html" class="rating-reviews">(3 reviews)</a>
                                    </div>
                                    <div class="product-price">
                                        <ins class="new-price">$26.62</ins>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="product-details.html">
                                        <img src="<?= base_url() ?>public/assets/images/products/Extra-Products/watch1.jpg" alt="Product" width="300" height="338">
                                    </a>
                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                                    </div>
                                    <div class="product-label-group">
                                        <label class="product-label label-discount">7% Off</label>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a href="product-details.html">Multi Funtional Apple
                                            watch</a></h4>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: 100%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="product-details.html" class="rating-reviews">(5 reviews)</a>
                                    </div>
                                    <div class="product-price">
                                        <ins class="new-price">136.26</ins>
                                        <del class="old-price">$145.90</del>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="product-details.html">
                                        <img src="<?= base_url() ?>public/assets/images/products/Extra-Products/watch2.jpg" alt="Product" width="300" height="338">
                                        <img src="<?= base_url() ?>public/assets/images/products/Extra-Products/watch2.jpg" alt="Product" width="300" height="338">
                                    </a>
                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a href="product-details.html">Watch</a>
                                    </h4>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: 100%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="product-details.html" class="rating-reviews">(8 reviews)</a>
                                    </div>
                                    <div class="product-price">
                                        <ins class="new-price">$26.55 - $29.99</ins>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="product-details.html">
                                        <img src="<?= base_url() ?>public/assets/images/products/Extra-Products/watch1.jpg" alt="Product" width="300" height="338">
                                    </a>
                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                                    </div>
                                    <div class="product-label-group">
                                        <label class="product-label label-discount">4% Off</label>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a href="product-details.html">Apple Watch</a>
                                    </h4>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: 100%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="product-details.html" class="rating-reviews">(4 reviews)</a>
                                    </div>
                                    <div class="product-price">
                                        <ins class="new-price">$243.30</ins>
                                        <del class="old-price">$253.50</del>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="product-details.html">
                                        <img src="<?= base_url() ?>public/assets/images/products/Extra-Products/watch2.jpg" alt="Product" width="300" height="338">
                                        <img src="<?= base_url() ?>public/assets/images/products/Extra-Products/watch1.jpg" alt="Product" width="300" height="338">
                                    </a>
                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a href="product-details.html">Watch</a>
                                    </h4>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: 100%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="product-details.html" class="rating-reviews">(10 reviews)</a>
                                    </div>
                                    <div class="product-price">
                                        <ins class="new-price">$32.00 - $33.26</ins>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="product-details.html">
                                        <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-7.jpg" alt="Product" width="300" height="338">
                                    </a>
                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a href="product-details.html">Multi-colorful Music</a>
                                    </h4>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: 60%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="product-details.html" class="rating-reviews">(3 reviews)</a>
                                    </div>
                                    <div class="product-price">
                                        <ins class="new-price">$260.59 - $297.83</ins>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="product-details.html">
                                        <img src="<?= base_url() ?>public/assets/images/products/Extra-Products/watch1.jpg" alt="Product" width="300" height="338">
                                        <img src="<?= base_url() ?>public/assets/images/products/Extra-Products/watch2.jpg" alt="Product" width="300" height="338">
                                    </a>
                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a href="product-details.html">Comfortable Backpack</a>
                                    </h4>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: 100%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="product-details.html" class="rating-reviews">(6 reviews)</a>
                                    </div>
                                    <div class="product-price">
                                        <ins class="new-price">$45.90</ins>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="product-details.html">
                                        <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-9.jpg" alt="Product" width="300" height="338">
                                    </a>
                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a href="product-details.html">Data Transformer Tool
                                        </a></h4>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: 60%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="product-details.html" class="rating-reviews">(3 reviews)</a>
                                    </div>
                                    <div class="product-price">
                                        <span class="price">$64.47</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="product-details.html">
                                        <img src="<?= base_url() ?>public/assets/images/products/Extra-Products/watch1.jpg" alt="Product" width="300" height="338">
                                    </a>
                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a href="product-details.html">Watch</a></h4>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: 60%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="product-details.html" class="rating-reviews">(3 reviews)</a>
                                    </div>
                                    <div class="product-price">
                                        <span class="price">$173.84</span>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                </div>
            </div>
            <!-- End of Tab Pane -->
            <div class="tab-pane pt-4" id="tab1-2">
                <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2" id="best_selling_products">
                    <!-- <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/products/Extra-Products/watch1.jpg"
                                        alt="Product" width="300" height="338">
                                    <img src="<?= base_url() ?>public/assets/images/products/Extra-Products/watch1.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Watch</a>
                                </h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 100%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(8 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">$26.55 - $29.99</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-3.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    
                                </div>
                                <div class="product-label-group">
                                    <label class="product-label label-discount">7% Off</label>
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Multi Funtional Apple
                                        iPhone</a></h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 100%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(5 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">136.26</ins>
                                    <del class="old-price">$145.90</del>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-8-1.jpg"
                                        alt="Product" width="300" height="338">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-8-2.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Comfortable Backpack</a>
                                </h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 100%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(6 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">$45.90</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-9.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Data Transformer Tool
                                    </a></h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 60%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(3 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <span class="price">$64.47</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-5.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    
                                </div>
                                <div class="product-label-group">
                                    <label class="product-label label-discount">4% Off</label>
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Apple Super Notecom</a>
                                </h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 100%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(4 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">$243.30</ins>
                                    <del class="old-price">$253.50</del>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-6-1.jpg"
                                        alt="Product" width="300" height="338">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-6-2.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Women’s Comforter</a>
                                </h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 100%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(10 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">$32.00 - $33.26</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-7.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Multi-colorful Music</a>
                                </h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 60%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(3 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">$260.59 - $297.83</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-1-1.jpg"
                                        alt="Product" width="300" height="338">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-1-2.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Classic Hat</a></h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 60%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(1 Reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">$53.00</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-2.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Women’s White
                                        Handbag</a></h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 80%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(3 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">$26.62</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-10.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Women’s hairdye</a></h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 60%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(3 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <span class="price">$173.84</span>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <!-- End of Tab Pane -->
            <div class="tab-pane pt-4" id="tab1-3">
                <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2" id="most-popular-product">
                    <!-- <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-9.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Data Transformer Tool
                                    </a></h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 60%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(3 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <span class="price">$64.47</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-1-1.jpg"
                                        alt="Product" width="300" height="338">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-1-2.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Classic Hat</a></h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 60%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(1 Reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">$53.00</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-3.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    
                                </div>
                                <div class="product-label-group">
                                    <label class="product-label label-discount">7% Off</label>
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Multi Funtional Apple
                                        iPhone</a></h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 100%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(5 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">136.26</ins>
                                    <del class="old-price">$145.90</del>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-2.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Women’s White
                                        Handbag</a></h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 80%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(3 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">$26.62</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-10.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Women’s hairdye</a></h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 60%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(3 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <span class="price">$173.84</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-8-1.jpg"
                                        alt="Product" width="300" height="338">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-8-2.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Comfortable Backpack</a>
                                </h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 100%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(6 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">$45.90</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-5.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                   
                                </div>
                                <div class="product-label-group">
                                    <label class="product-label label-discount">4% Off</label>
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Apple Super Notecom</a>
                                </h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 100%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(4 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">$243.30</ins>
                                    <del class="old-price">$253.50</del>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-7.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Multi-colorful Music</a>
                                </h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 60%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(3 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">$260.59 - $297.83</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-6-1.jpg"
                                        alt="Product" width="300" height="338">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-6-2.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                   
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Women’s Comforter</a>
                                </h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 100%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(10 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">$32.00 - $33.26</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-4-1.jpg"
                                        alt="Product" width="300" height="338">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-4-2.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                   
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Fashion Blue Towel</a>
                                </h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 100%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(8 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">$26.55 - $29.99</ins>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <!-- End of Tab Pane -->
            <div class="tab-pane pt-4" id="tab1-4">
                <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-4-1.jpg"
                                        alt="Product" width="300" height="338">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-4-2.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    <!-- <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a> -->
                                    <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Add to Compare"></a> -->
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Fashion Blue Towel</a>
                                </h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 100%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(8 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">$26.55 - $29.99</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-10.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    <!-- <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a> -->
                                    <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Add to Compare"></a> -->
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Women’s hairdye</a></h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 60%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(3 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <span class="price">$173.84</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-9.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    <!-- <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a> -->
                                    <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Add to Compare"></a> -->
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Data Transformer Tool
                                    </a></h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 60%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(3 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <span class="price">$64.47</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-8-1.jpg"
                                        alt="Product" width="300" height="338">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-8-2.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    <!-- <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a> -->
                                    <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Add to Compare"></a> -->
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Comfortable Backpack</a>
                                </h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 100%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(6 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">$45.90</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-2.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    <!-- <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a> -->
                                    <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Add to Compare"></a> -->
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Women’s White
                                        Handbag</a></h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 80%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(3 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">$26.62</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-5.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    <!-- <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a> -->
                                    <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Add to Compare"></a> -->
                                </div>
                                <div class="product-label-group">
                                    <label class="product-label label-discount">4% Off</label>
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Apple Super Notecom</a>
                                </h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 100%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(4 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">$243.30</ins>
                                    <del class="old-price">$253.50</del>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-3.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    <!-- <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a> -->
                                    <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Add to Compare"></a> -->
                                </div>
                                <div class="product-label-group">
                                    <label class="product-label label-discount">7% Off</label>
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Multi Funtional Apple
                                        iPhone</a></h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 100%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(5 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">136.26</ins>
                                    <del class="old-price">$145.90</del>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-7.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    <!-- <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a> -->
                                    <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Add to Compare"></a> -->
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Multi-colorful Music</a>
                                </h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 60%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(3 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">$260.59 - $297.83</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-6-1.jpg"
                                        alt="Product" width="300" height="338">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-6-2.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    <!-- <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a> -->
                                    <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Add to Compare"></a> -->
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Women’s Comforter</a>
                                </h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 100%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(10 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">$32.00 - $33.26</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-details.html">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-1-1.jpg"
                                        alt="Product" width="300" height="338">
                                    <img src="<?= base_url() ?>public/assets/images/demos/demo1/products/3-1-2.jpg"
                                        alt="Product" width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    <!-- <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a> -->
                                    <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Add to Compare"></a> -->
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-details.html">Classic Hat</a></h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 60%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-details.html" class="rating-reviews">(1 Reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">$53.00</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Tab Pane -->
        </div>


        <!-- <div class="product-wrapper-1 appear-animate mb-5">
            <div class="title-link-wrapper pb-1 mb-4">
                <h2 class="title ls-normal mb-0">Fashion</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-4 mb-4">
                    <div class="banner h-100 br-sm" style="background-image: url(<?= base_url() ?>public/assets/images/demos/demo1/banners/2.jpg); 
                            background-color: #ebeced;">
                        <div class="banner-content content-top">
                            <h5 class="banner-subtitle text-black font-bold mb-2">New Collection</h5>
                            <hr class="banner-divider bg-dark mb-2">
                            <a href="<?= base_url('product/category?c_id=CATEAD0BFF320241112') ?>"
                                class="btn btn-dark btn-outline btn-rounded btn-sm">shop
                                Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-8">
                    <div class=""  id="fashion_category">
                    </div>
                </div>
            </div>
        </div>

        <div class="product-wrapper-1 appear-animate mb-8">
            <div class="title-link-wrapper pb-1 mb-4">
                <h2 class="title ls-normal mb-0">Accessories</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-4 mb-4">
                    <div class="banner h-100 br-sm" style="background-image: url(<?= base_url() ?>public/assets/images/demos/demo1/banners/3.jpg); 
                        background-color: #252525;">
                        <div class="banner-content content-top">
                            <h5 class="banner-subtitle text-white font-bold mb-2">All Types Of Accessories</h5>
                            <hr class="banner-divider bg-white mb-2">
                            <a href="<?= base_url('product/category?c_id=CAT1572090220241112') ?>"
                                class="btn btn-white btn-outline btn-rounded btn-sm">shop
                                now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-8">
                    <div class="swiper-container swiper-theme" id="accessories_category">
                    </div>
                </div>
            </div>
        </div> -->

        

        <!-- <div class="product-wrapper-1 appear-animate mb-8">
            <div class="title-link-wrapper pb-1 mb-4">
                <h2 class="title ls-normal mb-0">Disposable Item</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-4 mb-4">
                    <div class="banner h-100 br-sm" style="background-image: url(<?= base_url() ?>public/assets/images/demos/demo1/banners/3.jpg); 
                        background-color: #252525;">
                        <div class="banner-content content-top">
                            <h5 class="banner-subtitle text-white font-weight-normal mb-2">New Collection</h5>
                            <hr class="banner-divider bg-white mb-2">
                            <h3 class="banner-title text-white font-weight-bolder text-uppercase ls-25">
                                Top Camera <br> <span class="font-weight-normal text-capitalize">Mirrorless</span>
                            </h3>
                            <a href="<?= base_url('product/list') ?>"
                                class="btn btn-white btn-outline btn-rounded btn-sm">shop
                                now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-8">
                    <div class="swiper-container swiper-theme" id="home_garden_category">
                    </div>
                </div>
            </div>
        </div> -->
        <!-- End of Product Wrapper 1 -->

        

        <div class="banner banner-fashion appear-animate br-sm mb-9" style="background-image: url(<?= base_url() ?>public/assets/images/demos/demo1/banners/4.jpg);
                background-color: #383839;">
            <div class="banner-content align-items-center">
                <div class="content-left d-flex align-items-center mb-3">
                    <div class="banner-price-info font-weight-bolder text-secondary text-uppercase lh-1 ls-25">
                        25
                        <sup class="font-weight-bold">%</sup><sub class="font-weight-bold ls-25">Off</sub>
                    </div>
                    <hr class="banner-divider bg-white mt-0 mb-0 mr-8">
                </div>
                <div class="content-right d-flex align-items-center flex-1 flex-wrap">
                    <div class="banner-info mb-0 mr-auto pr-4 mb-3">
                        <h3 class="banner-title text-white font-weight-bolder text-uppercase ls-25">For Today's
                            Fashion</h3>
                        <p class="text-white mb-0">Use code
                            <span class="text-dark bg-white font-weight-bold ls-50 pl-1 pr-1 d-inline-block">Black
                                <strong>12345</strong></span> to get best offer.
                        </p>
                    </div>
                    <a href="shop-banner-sidebar.html"
                        class="btn btn-white btn-outline btn-rounded btn-icon-right mb-3">Shop Now<i
                            class="w-icon-long-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <!-- End of Banner Fashion -->

        
        <!-- <div class="product-wrapper-1 appear-animate mb-5">
            <div class="title-link-wrapper pb-1 mb-4">
                <h2 class="title ls-normal mb-0">Disposable Item</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-4 mb-4">
                <div class="banner h-100 br-sm" style="background-image: url(<?= base_url() ?>public/assets/images/img_disposable.png); 
                        background-color: #252525;">
                        <div class="banner-content content-top">
                            <h5 class="banner-subtitle text-black font-bold mb-2">Buy any kind of disposable items</h5>
                            <a href="<?= base_url('product/category?c_id=CATE110C36B20250113') ?>"
                                class="btn btn-black btn-outline btn-rounded btn-sm">shop
                                now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-8">
                    <div class=""  id="home_garden_category">
                    </div>
                </div>
            </div>
        </div> -->
        <!-- End of Product Wrapper 1 -->

        <!-- <div class="product-wrapper-1 appear-animate mb-5">
            <div class="title-link-wrapper pb-1 mb-4">
                <h2 class="title ls-normal mb-0">Chemical</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-4 mb-4">
                    <div class="banner h-100 br-sm" style="background-image: url(<?= base_url() ?>public/assets/images/img_chemical.png); 
                            background-color: #ebeced;">
                        <div class="banner-content content-top">
                            <h5 class="banner-subtitle text-black font-bold mb-2">All type home chemical products</h5>
                            <hr class="banner-divider bg-dark mb-2">
                            <a href="<?= base_url('product/category?c_id=CATEA43B66E20250116') ?>"
                                class="btn btn-dark btn-outline btn-rounded btn-sm">shop
                                Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-8">
                    <div class="swiper-container swiper-theme" data-swiper-options="{
                            'spaceBetween': 20,
                            'slidesPerView': 2,
                            'breakpoints': {
                                '992': {
                                    'slidesPerView': 3
                                },
                                '1200': {
                                    'slidesPerView': 4
                                }
                            }
                        }" id="smart_phones_category">

                    </div>
                </div>
            </div>
        </div> -->
        <!-- End of Product Wrapper 1 -->

        
    </div>
    <!--End of Catainer -->
</main>
<!-- End of Main -->
