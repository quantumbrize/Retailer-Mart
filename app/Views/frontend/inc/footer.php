<style>
    .logo-footer {
        height: 127px !important;
        margin-top: -62px !important;
    }

    /* Sticky Icons Container */
    #sticky-icons {
        position: fixed;
        bottom: 90px;
        right: 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        z-index: 9999;
    }

    @media (max-width: 770px) {
        #sticky-icons {
            display: none;
        }
    }

    /* Common Style for Icons */
    .sticky-icon {
        border-radius: 100%;
        position: relative;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #000;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        text-decoration: none;
        font-size: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s;
        cursor: pointer;
    }

    .sticky-icon:hover {
        color: #ca6d00;
        text-decoration: none;
    }

    .badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: rgba(200, 10, 10, 1);
        color: #fff;
        font-size: 12px;
        font-weight: bold;
        border-radius: 50%;
        padding: 2px 6px;
        min-width: 18px;
        text-align: center;
        display: inline-block;
        height: 20px;
        width: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #cart-icon-f{
        background-color: #ff4502 ;
    }
    #wishlist-icon-f{
        background-color: #223bae;
    }
    #whatsapp-icon-f{
        background-color: #25D366;

    }
</style>
<!-- Start of Footer -->
<footer class="footer appear-animate" data-animation-options="{
            'name': 'fadeIn'
        }">
    <div class="footer-newsletter bg-primary">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-5 col-lg-6">
                    <div class="icon-box icon-box-side text-white">
                        <div class="icon-box-icon d-inline-flex">
                            <i class="w-icon-envelop3"></i>
                        </div>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title text-white text-uppercase font-weight-bold">Subscribe To
                                Our Newsletter</h4>
                            <p class="text-white">Get all the latest information on Events, Sales and Offers.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6 col-md-9 mt-4 mt-lg-0 ">
                    <div class="input-wrapper input-wrapper-inline input-wrapper-rounded">
                        <input type="email" class="form-control mr-2 bg-white" name="email" id="email"
                            placeholder="Your E-mail Address">
                        <button class="btn btn-dark btn-rounded" id="submit_email" type="submit">Subscribe<i
                                class="w-icon-long-arrow-right"></i></button>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="widget widget-about">
                        <a href="<?= base_url() ?>" class="logo-footer">
                            <img class="company_logo" src="" alt="logo-footer" width="144" height="45">
                        </a>
                        <div class="widget-body">
                            <p class="widget-about-title">Got Question? Email us 24/7</p>
                            <a href="javascript:void(0)" class="widget-about-call" id="company_email"></a>
                            <!-- <p class="widget-about-desc">Register now to get updates on pronot get up icons
                                        & coupons ster now toon.
                                    </p> -->

                            <!-- <div class="social-icons social-icons-colored">
                                        <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                        <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                        <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                                        <a href="#" class="social-icon social-youtube w-icon-youtube"></a>
                                    </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h3 class="widget-title">Company</h3>
                        <ul class="widget-body">
                            <li><a href="<?= base_url() ?>">Home</a></li>
                            <li><a href="<?= base_url('about-us') ?>">About Us</a></li>
                            <li><a href="<?= base_url('contact-us') ?>">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">My Account</h4>
                        <ul class="widget-body">
                            <!-- <li><a href="#">Track My Order</a></li> -->
                            <li><a href="javascript:void(0)" onclick="redirect_cart_page()">View Cart</a></li>
                            <li><a href="<?= base_url('order/history') ?>" class="d-xl-show">My Order</a></li>
                            <!-- <li><a href="<?= base_url('signup') ?>">Sign In</a></li> -->
                            <li>
                                <?php if (isset($_SESSION['USER_user_id'])): ?>
                                    <a href="<?= base_url('user/account') ?>">Account</a>
                                <?php else: ?>
                                    <a href="<?= base_url('login') ?>">Sign in</a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">Customer Service</h4>
                        <ul class="widget-body">
                            <!-- <li><a href="<?= base_url('faq') ?>">F.A.Q</a></li> -->
                            <li><a href="<?= base_url('privacy-policy') ?>">Privacy Policy</a></li>
                            <li><a href="<?= base_url('return-refund-policy') ?>">Return & Refund Policy</a></li>
                            <li><a href="<?= base_url('terms-conditions') ?>">Term and Conditions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-left">
                <p class="copyright">Copyright © 2024 Candyflow. All Rights Reserved.</p>
            </div>
            <div class="footer-right">
                <span class="payment-label mr-lg-8">Our Social Media Channels</span>
                <div id="social_link" class="social-icons social-icons-colored">
                    <!-- <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                        <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                        <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                                        <a href="#" class="social-icon social-youtube w-icon-youtube"></a> -->
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Page-wrapper-->

<!-- Start of Sticky Footer -->
<div class="sticky-footer sticky-content fix-bottom">
    <a href="<?= base_url() ?>" class="sticky-link active">
        <i class="w-icon-home"></i>
        <p>Home</p>
    </a>
    <a href="<?= base_url('product/list') ?>" class="sticky-link">
        <i class="w-icon-category"></i>
        <p>Shop</p>
    </a>
    <a href="<?= base_url('user/account') ?>" class="sticky-link">
        <i class="w-icon-account"></i>
        <p>Account</p>
    </a>
    <div class="cart-dropdown dir-up">
        <a href="<?= base_url('wishlist') ?>" class="sticky-link">
            <i class="w-icon-heart"></i>
            <p>Wishlist</p>
        </a>
        <!-- <div class="dropdown-box">
                <div class="products">
                    <div class="product product-cart">
                        <div class="product-detail">
                            <h3 class="product-name">
                                <a href="product-details.html">Beige knitted elas<br>tic
                                    runner shoes</a>
                            </h3>
                            <div class="price-box">
                                <span class="product-quantity">1</span>
                                <span class="product-price">$25.68</span>
                            </div>
                        </div>
                        <figure class="product-media">
                            <a href="product-details.html">
                                <img src="<?= base_url() ?>public/assets/images/cart/product-1.jpg" alt="product" height="84" width="94">
                            </a>
                        </figure>
                        <button class="btn btn-link btn-close" aria-label="button">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="product product-cart">
                        <div class="product-detail">
                            <h3 class="product-name">
                                <a href="product-details.html">Blue utility pina<br>fore
                                    denim dress</a>
                            </h3>
                            <div class="price-box">
                                <span class="product-quantity">1</span>
                                <span class="product-price">$32.99</span>
                            </div>
                        </div>
                        <figure class="product-media">
                            <a href="product-details.html">
                                <img src="<?= base_url() ?>public/assets/images/cart/product-2.jpg" alt="product" width="84" height="94">
                            </a>
                        </figure>
                        <button class="btn btn-link btn-close" aria-label="button">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="cart-total">
                    <label>Subtotal:</label>
                    <span class="price">$58.67</span>
                </div>

                <div class="cart-action">
                    <a href="cart.html" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                    <a href="checkout.html" class="btn btn-primary  btn-rounded">Checkout</a>
                </div>
            </div> -->
        <!-- End of Dropdown Box -->
    </div>

    <!-- <div class="header-search hs-toggle dir-up">
            <a href="#" class="search-toggle sticky-link">
                <i class="w-icon-search"></i>
                <p>Search</p>
            </a>
            <form action="#" class="input-wrapper">
                <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search" required="">
                <button class="btn btn-search" type="submit">
                    <i class="w-icon-search"></i>
                </button>
            </form>
        </div> -->
</div>
<!-- End of Sticky Footer -->

<!-- Start of Scroll Top and Sticky Icons -->

<!-- Scroll Top -->
<div id="sticky-icons">


</div>
<a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button">
    <i class="w-icon-angle-up"></i>
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
        <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35"
            r="34" style="stroke-dasharray: 16.4198, 400;"></circle>
    </svg>
</a>
<!-- End of Scroll Top and Sticky Icons -->

<!-- Start of Mobile Menu -->
<div class="mobile-menu-wrapper">
    <div class="mobile-menu-overlay"></div>
    <!-- End of .mobile-menu-overlay -->

    <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
    <!-- End of .mobile-menu-close -->

    <div class="mobile-menu-container scrollable">
        <!-- <form action="#" method="get" class="input-wrapper">
                <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search" required="">
                <button class="btn btn-search" type="submit">
                    <i class="w-icon-search"></i>
                </button>
            </form> -->
        <!-- End of Search Form -->
        <div class="tab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a href="#main-menu" class="nav-link active">Main Menu</a>
                </li>
                <li class="nav-item">
                    <a href="#categories" class="nav-link">Categories</a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="main-menu">
                <ul class="mobile-menu">
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li>
                        <a href="<?= base_url('product/list') ?>">Shop</a>
                    </li>
                    <li>
                        <a href="<?= base_url('about-us') ?>">About Us</a>
                        <!-- <ul>
                                <li>
                                    <a href="#">Store Listing</a>
                                    <ul>
                                        <li><a href="vendor-dokan-store-list.html">Store listing 1</a></li>
                                        <li><a href="vendor-wcfm-store-list.html">Store listing 2</a></li>
                                        <li><a href="vendor-wcmp-store-list.html">Store listing 3</a></li>
                                        <li><a href="vendor-wc-store-list.html">Store listing 4</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Vendor Store</a>
                                    <ul>
                                        <li><a href="vendor-dokan-store.html">Vendor Store 1</a></li>
                                        <li><a href="vendor-wcfm-store-product-grid.html">Vendor Store 2</a></li>
                                        <li><a href="vendor-wcmp-store-product-grid.html">Vendor Store 3</a></li>
                                        <li><a href="vendor-wc-store-product-grid.html">Vendor Store 4</a></li>
                                    </ul>
                                </li>
                            </ul> -->
                    </li>
                    <!-- <li>
                            <a href="blog.html">Blog</a>
                            <ul>
                                <li><a href="blog.html">Classic</a></li>
                                <li><a href="blog-listing.html">Listing</a></li>
                                <li>
                                    <a href="blog-grid.html">Grid</a>
                                    <ul>
                                        <li><a href="blog-grid-2cols.html">Grid 2 columns</a></li>
                                        <li><a href="blog-grid-3cols.html">Grid 3 columns</a></li>
                                        <li><a href="blog-grid-4cols.html">Grid 4 columns</a></li>
                                        <li><a href="blog-grid-sidebar.html">Grid sidebar</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Masonry</a>
                                    <ul>
                                        <li><a href="blog-masonry-2cols.html">Masonry 2 columns</a></li>
                                        <li><a href="blog-masonry-3cols.html">Masonry 3 columns</a></li>
                                        <li><a href="blog-masonry-4cols.html">Masonry 4 columns</a></li>
                                        <li><a href="blog-masonry-sidebar.html">Masonry sidebar</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Mask</a>
                                    <ul>
                                        <li><a href="blog-mask-grid.html">Blog mask grid</a></li>
                                        <li><a href="blog-mask-masonry.html">Blog mask masonry</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="post-single.html">Single Post</a>
                                </li>
                            </ul>
                        </li> -->
                    <li>
                        <a href="<?= base_url('contact-us') ?>">Contact-us</a>
                        <!-- <ul>

                                <li><a href="about-us.html">About Us</a></li>
                                <li><a href="become-a-vendor.html">Become A Vendor</a></li>
                                <li><a href="contact-us.html">Contact Us</a></li>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="faq.html">FAQs</a></li>
                                <li><a href="error-404.html">Error 404</a></li>
                                <li><a href="coming-soon.html">Coming Soon</a></li>
                                <li><a href="wishlist.html">Wishlist</a></li>
                                <li><a href="cart.html">Cart</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="my-account.html">My Account</a></li>
                            </ul> -->
                    </li>
                    <!-- <li>
                            <a href="elements.html">Elements</a>
                            <ul>
                                <li><a href="element-products.html">Products</a></li>
                                <li><a href="element-titles.html">Titles</a></li>
                                <li><a href="element-typography.html">Typography</a></li>
                                <li><a href="element-categories.html">Product Category</a></li>
                                <li><a href="element-buttons.html">Buttons</a></li>
                                <li><a href="element-accordions.html">Accordions</a></li>
                                <li><a href="element-alerts.html">Alert &amp; Notification</a></li>
                                <li><a href="element-tabs.html">Tabs</a></li>
                                <li><a href="element-testimonials.html">Testimonials</a></li>
                                <li><a href="element-blog-posts.html">Blog Posts</a></li>
                                <li><a href="element-instagrams.html">Instagrams</a></li>
                                <li><a href="element-cta.html">Call to Action</a></li>
                                <li><a href="element-vendors.html">Vendors</a></li>
                                <li><a href="element-icon-boxes.html">Icon Boxes</a></li>
                                <li><a href="element-icons.html">Icons</a></li>
                            </ul>
                        </li> -->
                </ul>
            </div>
            <div class="tab-pane" id="categories">
                <ul class="mobile-menu" id="catalog_category_mob">

                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End of Mobile Menu -->

<!-- Start of Newsletter popup -->
<!-- <div class="newsletter-popup mfp-hide">
        <div class="newsletter-content">
            <h4 class="text-uppercase font-weight-normal ls-25">Get Up to<span class="text-primary">25% Off</span></h4>
            <h2 class="ls-25">Sign up to Wolmart</h2>
            <p class="text-light ls-10">Subscribe to the Wolmart market newsletter to
                receive updates on special offers.</p>
            <form action="#" method="get" class="input-wrapper input-wrapper-inline input-wrapper-round">
                <input type="email" class="form-control email font-size-md" name="email" id="email2" placeholder="Your email address" required="">
                <button class="btn btn-dark" type="submit">SUBMIT</button>
            </form>
            <div class="form-checkbox d-flex align-items-center">
                <input type="checkbox" class="custom-checkbox" id="hide-newsletter-popup" name="hide-newsletter-popup" required="">
                <label for="hide-newsletter-popup" class="font-size-sm text-light">Don't show this popup again.</label>
            </div>
        </div>
    </div> -->
<!-- End of Newsletter popup -->

<!-- Start of Quick View -->
<div class="product product-single product-popup">
    <div class="row gutter-lg">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="product-gallery product-gallery-sticky">
                <div class="swiper-container product-single-swiper swiper-theme nav-inner">
                    <div class="swiper-wrapper row cols-1 gutter-no">
                        <div class="swiper-slide">
                            <figure class="product-image">
                                <img src="<?= base_url() ?>public/assets/images/products/popup/1-440x494.jpg"
                                    data-zoom-image="<?= base_url() ?>public/assets/images/products/popup/1-800x900.jpg"
                                    alt="Water Boil Black Utensil" width="800" height="900">
                            </figure>
                        </div>
                        <div class="swiper-slide">
                            <figure class="product-image">
                                <img src="<?= base_url() ?>public/assets/images/products/popup/2-440x494.jpg"
                                    data-zoom-image="<?= base_url() ?>public/assets/images/products/popup/2-800x900.jpg"
                                    alt="Water Boil Black Utensil" width="800" height="900">
                            </figure>
                        </div>
                        <div class="swiper-slide">
                            <figure class="product-image">
                                <img src="<?= base_url() ?>public/assets/images/products/popup/3-440x494.jpg"
                                    data-zoom-image="<?= base_url() ?>public/assets/images/products/popup/3-800x900.jpg"
                                    alt="Water Boil Black Utensil" width="800" height="900">
                            </figure>
                        </div>
                        <div class="swiper-slide">
                            <figure class="product-image">
                                <img src="<?= base_url() ?>public/assets/images/products/popup/4-440x494.jpg"
                                    data-zoom-image="<?= base_url() ?>public/assets/images/products/popup/4-800x900.jpg"
                                    alt="Water Boil Black Utensil" width="800" height="900">
                            </figure>
                        </div>
                    </div>
                    <button class="swiper-button-next"></button>
                    <button class="swiper-button-prev"></button>
                </div>
                <div class="product-thumbs-wrap swiper-container" data-swiper-options="{
                        'navigation': {
                            'nextEl': '.swiper-button-next',
                            'prevEl': '.swiper-button-prev'
                        }
                    }">
                    <div class="product-thumbs swiper-wrapper row cols-4 gutter-sm">
                        <div class="product-thumb swiper-slide">
                            <img src="<?= base_url() ?>public/assets/images/products/popup/1-103x116.jpg"
                                alt="Product Thumb" width="103" height="116">
                        </div>
                        <div class="product-thumb swiper-slide">
                            <img src="<?= base_url() ?>public/assets/images/products/popup/2-103x116.jpg"
                                alt="Product Thumb" width="103" height="116">
                        </div>
                        <div class="product-thumb swiper-slide">
                            <img src="<?= base_url() ?>public/assets/images/products/popup/3-103x116.jpg"
                                alt="Product Thumb" width="103" height="116">
                        </div>
                        <div class="product-thumb swiper-slide">
                            <img src="<?= base_url() ?>public/assets/images/products/popup/4-103x116.jpg"
                                alt="Product Thumb" width="103" height="116">
                        </div>
                    </div>
                    <button class="swiper-button-next"></button>
                    <button class="swiper-button-prev"></button>
                </div>
            </div>
        </div>
        <div class="col-md-6 overflow-hidden p-relative">
            <div class="product-details scrollable pl-0">
                <h2 class="product-title">Electronics Black Wrist Watch</h2>
                <div class="product-bm-wrapper">
                    <figure class="brand">
                        <img src="<?= base_url() ?>public/assets/images/products/brand/brand-1.jpg" alt="Brand"
                            width="102" height="48">
                    </figure>
                    <div class="product-meta">
                        <div class="product-categories">
                            Category:
                            <span class="product-category"><a href="#">Electronics</a></span>
                        </div>
                        <div class="product-sku">
                            SKU: <span>MS46891340</span>
                        </div>
                    </div>
                </div>

                <hr class="product-divider">

                <div class="product-price">$40.00</div>

                <div class="ratings-container">
                    <div class="ratings-full">
                        <span class="ratings" style="width: 80%;"></span>
                        <span class="tooltiptext tooltip-top"></span>
                    </div>
                    <a href="#" class="rating-reviews">(3 Reviews)</a>
                </div>

                <div class="product-short-desc">
                    <ul class="list-type-check list-style-none">
                        <li>Ultrices eros in cursus turpis massa cursus mattis.</li>
                        <li>Volutpat ac tincidunt vitae semper quis lectus.</li>
                        <li>Aliquam id diam maecenas ultricies mi eget mauris.</li>
                    </ul>
                </div>

                <hr class="product-divider">

                <div class="product-form product-variation-form product-color-swatch">
                    <label>Color:</label>
                    <div class="d-flex align-items-center product-variations">
                        <a href="#" class="color" style="background-color: #ffcc01"></a>
                        <a href="#" class="color" style="background-color: #ca6d00;"></a>
                        <a href="#" class="color" style="background-color: #1c93cb;"></a>
                        <a href="#" class="color" style="background-color: #ccc;"></a>
                        <a href="#" class="color" style="background-color: #333;"></a>
                    </div>
                </div>
                <div class="product-form product-variation-form product-size-swatch">
                    <label class="mb-1">Size:</label>
                    <div class="flex-wrap d-flex align-items-center product-variations">
                        <a href="#" class="size">Small</a>
                        <a href="#" class="size">Medium</a>
                        <a href="#" class="size">Large</a>
                        <a href="#" class="size">Extra Large</a>
                    </div>
                    <a href="#" class="product-variation-clean">Clean All</a>
                </div>

                <div class="product-variation-price">
                    <span></span>
                </div>

                <div class="product-form">
                    <div class="product-qty-form">
                        <div class="input-group">
                            <input class="quantity form-control" type="number" min="1" max="10000000">
                            <button class="quantity-plus w-icon-plus"></button>
                            <button class="quantity-minus w-icon-minus"></button>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-cart">
                        <i class="w-icon-cart"></i>
                        <span>Add to Cart</span>
                    </button>
                </div>

                <div class="social-links-wrapper">
                    <div class="social-links">
                        <div class="social-icons social-no-color border-thin">
                            <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                            <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                            <a href="#" class="social-icon social-pinterest fab fa-pinterest-p"></a>
                            <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                            <a href="#" class="social-icon social-youtube fab fa-linkedin-in"></a>
                        </div>
                    </div>
                    <span class="divider d-xs-show"></span>
                    <div class="product-link-wrapper d-flex">
                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"><span></span></a>
                        <a href="#" class="btn-product-icon btn-compare btn-icon-left w-icon-compare"><span></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Quick view -->
<script>
    $(document).ready(function () {
        function get_social_link() {
            $.ajax({
                url: "<?= base_url('api/get/social') ?>",
                type: "GET",
                data: {},
                success: function (resp) {
                    // resp = JSON.parse(resp)
                    // console.log(resp.user_data.number)
                    if (resp.status) {
                        console.log('pro', resp);

                        html = `<a href="${resp.user_data.facebook}" class="social-icon social-facebook w-icon-facebook"></a>
                                        <a href="${resp.user_data.twitter}" class="social-icon social-twitter w-icon-twitter"></a>
                                        <a href="${resp.user_data.instagram}" class="social-icon social-instagram w-icon-instagram"></a>
                                        <a href="${resp.user_data.youtube}" class="social-icon social-youtube w-icon-youtube"></a>`

                        // $('#profile_image').html(`<img src="${user_img}" class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow" alt="user-profile-image">`)
                        // $('#facebooklink').val(resp.user_data.facebook)
                        // $('#twitterlink').val(resp.user_data.twitter)
                        // $('#instagramlink').val(resp.user_data.instagram)
                        // $('#youtubelink').val(resp.user_data.youtube)
                        // $('#uid').val(resp.user_data.uid)
                        // $('#user_name').text(resp.user_data.user_name)
                        // $('#user_role').text(resp.user_data.type)
                        // var image_url = `https://usercontent.one/wp/www.vocaleurope.eu/wp-content/uploads/no-image.jpg?media=1642546813`
                        $('#social_link').html(html);
                    } else {
                        console.log(resp)
                    }
                },
                error: function (err) {
                    console.log(err)
                }
            })
        }
        $("#submit_email").click(function () {
            // var uid = $("#nuid").val()
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var email = $("#email").val()


            if (email == "") {
                // $("#email").text("Please enter email!")
                Toastify({
                    text: 'Please enter email!'.toUpperCase(),
                    duration: 3000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'darkred',
                    },
                }).showToast();
                return false
            } else if (!email.match(emailRegex)) {
                Toastify({
                    text: 'Please enter valid email!'.toUpperCase(),
                    duration: 3000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'darkred',
                    },
                }).showToast();
                return false
            }




            if (email != "") {
                // alert("hello")
                var formData = new FormData();

                formData.append('email', email);
                // formData.append('uid', uid);
                // formData.append('twitter', twitter);
                // formData.append('instagram', instagram);
                // formData.append('youtube', youtube);
                // formData.append('uid', uid);
                $.ajax({
                    url: "<?= base_url('/api/email/admin') ?>",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#submit_email').html(`<div class="spinner-border" role="status"></div>`)
                        $('#submit_email').attr('disabled', true)

                    },
                    success: function (resp) {
                        console.log('pro2', resp)
                        var html = ``;
                        if (resp.status) {
                            // window.location.href = "<?= base_url('/user/account') ?>";
                            html += `<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                <i class="ri-checkbox-circle-fill label-icon"></i>${resp.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`
                            $('#alert').html(html)
                            location.reload();
                        } else {
                            console.log(resp.status)
                            html += `<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                <i class="ri-checkbox-circle-fill label-icon"></i>${resp.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`
                            $('#alert').html(html)
                        }


                        
                        console.log('proe', resp)
                    },
                    error: function (err) {
                        console.log(err)
                    },
                    complete: function () {
                        $('#submit_email').html(`<i class="ri-edit-box-line align-middle me-2"></i> Update Profile`)
                        $('#submit_email').attr('disabled', false)
                    }
                })
            }
        });
        get_social_link();
    })

    document.addEventListener("DOMContentLoaded", function () {

        // Optional: Add scroll event for visibility
        window.addEventListener("scroll", function () {
            const cartIcon = document.getElementById("cart-icon-f");
            const wishlistIcon = document.getElementById("wishlist-icon-f");
            const whatsappIcon = document.getElementById("whatsapp-icon-f");

            // Show icons only when scrolling
            if (window.scrollY > 200) {
                if(wishlistIcon){
                    wishlistIcon.style.display = "flex";
                }
                if(cartIcon){
                    cartIcon.style.display = "flex";
                }
                if(whatsappIcon){
                    whatsappIcon.style.display = "flex";
                }
            } else {
                if(wishlistIcon){
                    wishlistIcon.style.display = "none";
                }
                if(cartIcon){
                    cartIcon.style.display = "none";
                }
                if(whatsappIcon){
                    whatsappIcon.style.display = "none";
                }
            }
        });
    });

</script>