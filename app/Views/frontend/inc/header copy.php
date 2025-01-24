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
                   
                    <!--<div class="header-right">
                        <span class="divider d-lg-show"></span>
                        <a href="contact-us.html" class="d-lg-show">Contact Us</a>
                        <a href="my-account.html" class="d-lg-show">My Account</a>
                        <a href="<?= base_url()?>public/assets/ajax/user-login.html" class="d-lg-show login sign-in"><i class="w-icon-account"></i>User</a>
                        <span class="delimiter d-lg-show">/</span>
                        <a href="<?= base_url()?>public/assets/ajax/vendor-login.html" class="ml-0 d-lg-show login sign-in">Vendor</a>
                    </div>-->
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

/* Input styling */
/* #searchInput {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
} */
 /* Suggestion box styles */
.suggestion-box {
  position: absolute;
  top: 100%;
  left: 0;
  width: 100%;
  max-height: 200px;
  overflow-y: auto;
  background: #fff;
  border: 1px solid #ccc;
  border-radius: 5px;
  list-style: none;
  margin: 0;
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
                        <a href="<?= base_url()?>" class="logo ml-lg-0">
                            <img class="company_logo" src="" alt="logo" width="180" height="45">
                        </a>
                        <!-- <div class="search-container"> -->
                             <!-- <select>
                                <option value="products">Products</option>
                                <option value="products">Category 1</option>
                                <option value="products">Category 2</option>
                            </select> -->
                    
                            <!-- <input type="text" placeholder="search your items" class="transparent-bg">
                    
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button> -->
                            
                        <!-- </div> -->
                        <div class="search-container">
                            <input type="text" id="searchInput" placeholder="Search your items" class="transparent-bg" oninput="product_search()">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <ul id="suggestionBox"></ul>
                            <!-- <ul id="suggestionBox" class="suggestion-box"></ul> -->
                        </div>

                        <!-- <a href="javascript:void(0)" class="sticky-link wishlist-mobile" onclick="redirect_cart_page()" style="display: none;">
                            <i class="w-icon-cart"></i>
                            <p>Cart</p>
                        </a> -->

                        <a href="javascript:void(0)" class="icon-link  wishlist-mobile" onclick="redirect_cart_page()" style="display: none;">
                            <span id="cart-count" class="cart-count-badge"></span>
                            <i class="fas fa-shopping-cart cart-style"></i>
                            
                        </a>

                        <div class="icons" id="authorised_account">
                            <!-- <a href="#" class="icon-link">
                                <i class="fas fa-heart"></i> Wishlist
                            </a>
                            <a href="#" class="icon-link">
                                <i class="fas fa-shopping-cart"></i> Cart
                            </a>
                            <a href="<?= base_url('login')?>" class="icon-link">
                                <i class="fas fa-user"></i> SignIn
                            </a>
                            <a href="<?= base_url('sign-up')?>" class="signup-btn" style="text-decoration: none;">SignUp</a> -->
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
                                <a href="#" class="category-toggle text-dark" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-display="static" title="Browse Categories">
                                    <i class="w-icon-category"></i>
                                    <span>Browse Categories</span>
                                </a>

                                <div class="dropdown-box">
                                    <ul class="menu vertical-menu category-menu" id="catalog_category">
                                        <!-- <li>
                                            <a href="shop-fullwidth-banner.html">
                                                <i class="w-icon-tshirt2"></i>Fashion
                                            </a>
                                            <ul class="megamenu">
                                                <li>
                                                    <h4 class="menu-title">Women</h4>
                                                    <hr class="divider">
                                                    <ul>
                                                        <li><a href="shop-fullwidth-banner.html">New Arrivals</a>
                                                        </li>
                                                        <li><a href="shop-fullwidth-banner.html">Best Sellers</a>
                                                        </li>
                                                        <li><a href="shop-fullwidth-banner.html">Trending</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Clothing</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Shoes</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Bags</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Accessories</a>
                                                        </li>
                                                        <li><a href="shop-fullwidth-banner.html">Jewlery &
                                                                Watches</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <h4 class="menu-title">Men</h4>
                                                    <hr class="divider">
                                                    <ul>
                                                        <li><a href="shop-fullwidth-banner.html">New Arrivals</a>
                                                        </li>
                                                        <li><a href="shop-fullwidth-banner.html">Best Sellers</a>
                                                        </li>
                                                        <li><a href="shop-fullwidth-banner.html">Trending</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Clothing</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Shoes</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Bags</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Accessories</a>
                                                        </li>
                                                        <li><a href="shop-fullwidth-banner.html">Jewlery &
                                                                Watches</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <div class="banner-fixed menu-banner menu-banner2">
                                                        <figure>
                                                            <img src="<?= base_url()?>public/assets/images/menu/banner-2.jpg" alt="Menu Banner" width="235" height="347">
                                                        </figure>
                                                        <div class="banner-content">
                                                            <div class="banner-price-info mb-1 ls-normal">Get up to
                                                                <strong class="text-primary text-uppercase">20%Off</strong>
                                                            </div>
                                                            <h3 class="banner-title ls-normal">Hot Sales</h3>
                                                            <a href="shop-banner-sidebar.html" class="btn btn-dark btn-sm btn-link btn-slide-right btn-icon-right">
                                                                Shop Now<i class="w-icon-long-arrow-right"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="shop-fullwidth-banner.html">
                                                <i class="w-icon-home"></i>Home & Garden
                                            </a>
                                            <ul class="megamenu">
                                                <li>
                                                    <h4 class="menu-title">Bedroom</h4>
                                                    <hr class="divider">
                                                    <ul>
                                                        <li><a href="shop-fullwidth-banner.html">Beds, Frames &
                                                                Bases</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Dressers</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Nightstands</a>
                                                        </li>
                                                        <li><a href="shop-fullwidth-banner.html">Kid's Beds &
                                                                Headboards</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Armoires</a></li>
                                                    </ul>

                                                    <h4 class="menu-title mt-1">Living Room</h4>
                                                    <hr class="divider">
                                                    <ul>
                                                        <li><a href="shop-fullwidth-banner.html">Coffee Tables</a>
                                                        </li>
                                                        <li><a href="shop-fullwidth-banner.html">Chairs</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Tables</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Futons & Sofa
                                                                Beds</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Cabinets &
                                                                Chests</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <h4 class="menu-title">Office</h4>
                                                    <hr class="divider">
                                                    <ul>
                                                        <li><a href="shop-fullwidth-banner.html">Office Chairs</a>
                                                        </li>
                                                        <li><a href="shop-fullwidth-banner.html">Desks</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Bookcases</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">File Cabinets</a>
                                                        </li>
                                                        <li><a href="shop-fullwidth-banner.html">Breakroom
                                                                Tables</a></li>
                                                    </ul>

                                                    <h4 class="menu-title mt-1">Kitchen & Dining</h4>
                                                    <hr class="divider">
                                                    <ul>
                                                        <li><a href="shop-fullwidth-banner.html">Dining Sets</a>
                                                        </li>
                                                        <li><a href="shop-fullwidth-banner.html">Kitchen Storage
                                                                Cabinets</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Bashers Racks</a>
                                                        </li>
                                                        <li><a href="shop-fullwidth-banner.html">Dining Chairs</a>
                                                        </li>
                                                        <li><a href="shop-fullwidth-banner.html">Dining Room
                                                                Tables</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Bar Stools</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <div class="menu-banner banner-fixed menu-banner3">
                                                        <figure>
                                                            <img src="<?= base_url()?>public/assets/images/menu/banner-3.jpg" alt="Menu Banner" width="235" height="461">
                                                        </figure>
                                                        <div class="banner-content">
                                                            <h4 class="banner-subtitle font-weight-normal text-white mb-1">
                                                                Restroom</h4>
                                                            <h3 class="banner-title font-weight-bolder text-white ls-normal">
                                                                Furniture Sale</h3>
                                                            <div class="banner-price-info text-white font-weight-normal ls-25">
                                                                Up to <span class="text-secondary text-uppercase font-weight-bold">25%
                                                                    Off</span></div>
                                                            <a href="shop-banner-sidebar.html" class="btn btn-white btn-link btn-sm btn-slide-right btn-icon-right">
                                                                Shop Now<i class="w-icon-long-arrow-right"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="shop-fullwidth-banner.html">
                                                <i class="w-icon-electronics"></i>Electronics
                                            </a>
                                            <ul class="megamenu">
                                                <li>
                                                    <h4 class="menu-title">Laptops &amp; Computers</h4>
                                                    <hr class="divider">
                                                    <ul>
                                                        <li><a href="shop-fullwidth-banner.html">Desktop
                                                                Computers</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Monitors</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Laptops</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Hard Drives &amp;
                                                                Storage</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Computer
                                                                Accessories</a></li>
                                                    </ul>

                                                    <h4 class="menu-title mt-1">TV &amp; Video</h4>
                                                    <hr class="divider">
                                                    <ul>
                                                        <li><a href="shop-fullwidth-banner.html">TVs</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Home Audio
                                                                Speakers</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Projectors</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Media Streaming
                                                                Devices</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <h4 class="menu-title">Digital Cameras</h4>
                                                    <hr class="divider">
                                                    <ul>
                                                        <li><a href="shop-fullwidth-banner.html">Digital SLR
                                                                Cameras</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Sports & Action
                                                                Cameras</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Camera Lenses</a>
                                                        </li>
                                                        <li><a href="shop-fullwidth-banner.html">Photo Printer</a>
                                                        </li>
                                                        <li><a href="shop-fullwidth-banner.html">Digital Memory
                                                                Cards</a></li>
                                                    </ul>

                                                    <h4 class="menu-title mt-1">Cell Phones</h4>
                                                    <hr class="divider">
                                                    <ul>
                                                        <li><a href="shop-fullwidth-banner.html">Carrier Phones</a>
                                                        </li>
                                                        <li><a href="shop-fullwidth-banner.html">Unlocked Phones</a>
                                                        </li>
                                                        <li><a href="shop-fullwidth-banner.html">Phone & Cellphone
                                                                Cases</a></li>
                                                        <li><a href="shop-fullwidth-banner.html">Cellphone
                                                                Chargers</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <div class="menu-banner banner-fixed menu-banner4">
                                                        <figure>
                                                            <img src="<?= base_url()?>public/assets/images/menu/banner-4.jpg" alt="Menu Banner" width="235" height="433">
                                                        </figure>
                                                        <div class="banner-content">
                                                            <h4 class="banner-subtitle font-weight-normal">Deals Of The
                                                                Week</h4>
                                                            <h3 class="banner-title text-white">Save On Smart EarPhone
                                                            </h3>
                                                            <div class="banner-price-info text-secondary font-weight-bolder text-uppercase text-secondary">
                                                                20% Off</div>
                                                            <a href="shop-banner-sidebar.html" class="btn btn-white btn-outline btn-sm btn-rounded">Shop
                                                                Now</a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="shop-fullwidth-banner.html">
                                                <i class="w-icon-furniture"></i>Furniture
                                            </a>
                                            <ul class="megamenu type2">
                                                <li class="row">
                                                    <div class="col-md-3 col-lg-3 col-6">
                                                        <h4 class="menu-title">Furniture</h4>
                                                        <hr class="divider">
                                                        <ul>
                                                            <li><a href="shop-fullwidth-banner.html">Sofas & Couches</a>
                                                            </li>
                                                            <li><a href="shop-fullwidth-banner.html">Armchairs</a></li>
                                                            <li><a href="shop-fullwidth-banner.html">Bed Frames</a></li>
                                                            <li><a href="shop-fullwidth-banner.html">Beside Tables</a>
                                                            </li>
                                                            <li><a href="shop-fullwidth-banner.html">Dressing Tables</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-6">
                                                        <h4 class="menu-title">Lighting</h4>
                                                        <hr class="divider">
                                                        <ul>
                                                            <li><a href="shop-fullwidth-banner.html">Light Bulbs</a>
                                                            </li>
                                                            <li><a href="shop-fullwidth-banner.html">Lamps</a></li>
                                                            <li><a href="shop-fullwidth-banner.html">Celling Lights</a>
                                                            </li>
                                                            <li><a href="shop-fullwidth-banner.html">Wall Lights</a>
                                                            </li>
                                                            <li><a href="shop-fullwidth-banner.html">Bathroom
                                                                    Lighting</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-6">
                                                        <h4 class="menu-title">Home Accessories</h4>
                                                        <hr class="divider">
                                                        <ul>
                                                            <li><a href="shop-fullwidth-banner.html">Decorative
                                                                    Accessories</a></li>
                                                            <li><a href="shop-fullwidth-banner.html">Candals &
                                                                    Holders</a></li>
                                                            <li><a href="shop-fullwidth-banner.html">Home Fragrance</a>
                                                            </li>
                                                            <li><a href="shop-fullwidth-banner.html">Mirrors</a></li>
                                                            <li><a href="shop-fullwidth-banner.html">Clocks</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-6">
                                                        <h4 class="menu-title">Garden & Outdoors</h4>
                                                        <hr class="divider">
                                                        <ul>
                                                            <li><a href="shop-fullwidth-banner.html">Garden
                                                                    Furniture</a></li>
                                                            <li><a href="shop-fullwidth-banner.html">Lawn Mowers</a>
                                                            </li>
                                                            <li><a href="shop-fullwidth-banner.html">Pressure
                                                                    Washers</a></li>
                                                            <li><a href="shop-fullwidth-banner.html">All Garden
                                                                    Tools</a></li>
                                                            <li><a href="shop-fullwidth-banner.html">Outdoor Dining</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <li class="row">
                                                    <div class="col-6">
                                                        <div class="banner banner-fixed menu-banner5 br-xs">
                                                            <figure>
                                                                <img src="<?= base_url()?>public/assets/images/menu/banner-5.jpg" alt="Banner" width="410" height="123" style="background-color: #D2D2D2;">
                                                            </figure>
                                                            <div class="banner-content text-right y-50">
                                                                <h4 class="banner-subtitle font-weight-normal text-default text-capitalize">
                                                                    New Arrivals</h4>
                                                                <h3 class="banner-title font-weight-bolder text-capitalize ls-normal">
                                                                    Amazing Sofa</h3>
                                                                <div class="banner-price-info font-weight-normal ls-normal">
                                                                    Starting at <strong>$125.00</strong></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="banner banner-fixed menu-banner5 br-xs">
                                                            <figure>
                                                                <img src="<?= base_url()?>public/assets/images/menu/banner-6.jpg" alt="Banner" width="410" height="123" style="background-color: #9F9888;">
                                                            </figure>
                                                            <div class="banner-content y-50">
                                                                <h4 class="banner-subtitle font-weight-normal text-white text-capitalize">
                                                                    Best Seller</h4>
                                                                <h3 class="banner-title font-weight-bolder text-capitalize text-white ls-normal">
                                                                    Chair &amp; Lamp</h3>
                                                                <div class="banner-price-info font-weight-normal ls-normal text-white">
                                                                    From <strong>$165.00</strong></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="shop-fullwidth-banner.html">
                                                <i class="w-icon-heartbeat"></i>Healthy & Beauty
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-fullwidth-banner.html">
                                                <i class="w-icon-gift"></i>Gift Ideas
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-fullwidth-banner.html">
                                                <i class="w-icon-gamepad"></i>Toy & Games
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-fullwidth-banner.html">
                                                <i class="w-icon-ice-cream"></i>Cooking
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-fullwidth-banner.html">
                                                <i class="w-icon-ios"></i>Smart Phones
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-fullwidth-banner.html">
                                                <i class="w-icon-camera"></i>Cameras & Photo
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-fullwidth-banner.html">
                                                <i class="w-icon-ruby"></i>Accessories
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-banner-sidebar.html" class="font-weight-bold text-primary text-uppercase ls-25">
                                                View All Categories<i class="w-icon-angle-right"></i>
                                            </a>
                                        </li> -->
                                    </ul>
                                </div>
                            </div>
                            <nav class="main-nav">
                                <ul class="menu active-underline">
                                    <li class="<?= isset($header['home']) ? 'active' : '' ?>">
                                        <a href="<?= base_url()?>">Home</a>
                                    </li>
                                    <li class="<?= isset($header['product_list']) ? 'active' : '' ?>">
                                        <a href="<?= base_url('product/list')?>">Shop</a>

                                        <!-- Start of Megamenu -->
                                        <!-- <ul class="megamenu">
                                            <li>
                                                <h4 class="menu-title">Shop Pages</h4>
                                                <ul>
                                                    <li><a href="shop-banner-sidebar.html">Banner With Sidebar</a></li>
                                                    <li><a href="shop-boxed-banner.html">Boxed Banner</a></li>
                                                    <li><a href="shop-fullwidth-banner.html">Full Width Banner</a></li>
                                                    <li><a href="shop-horizontal-filter.html">Horizontal Filter<span class="tip tip-hot">Hot</span></a></li>
                                                    <li><a href="shop-off-canvas.html">Off Canvas Sidebar<span class="tip tip-new">New</span></a></li>
                                                    <li><a href="shop-infinite-scroll.html">Infinite Ajax Scroll</a>
                                                    </li>
                                                    <li><a href="shop-right-sidebar.html">Right Sidebar</a></li>
                                                    <li><a href="shop-both-sidebar.html">Both Sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <h4 class="menu-title">Shop Layouts</h4>
                                                <ul>
                                                    <li><a href="shop-grid-3cols.html">3 Columns Mode</a></li>
                                                    <li><a href="shop-grid-4cols.html">4 Columns Mode</a></li>
                                                    <li><a href="shop-grid-5cols.html">5 Columns Mode</a></li>
                                                    <li><a href="shop-grid-6cols.html">6 Columns Mode</a></li>
                                                    <li><a href="shop-grid-7cols.html">7 Columns Mode</a></li>
                                                    <li><a href="shop-grid-8cols.html">8 Columns Mode</a></li>
                                                    <li><a href="shop-list.html">List Mode</a></li>
                                                    <li><a href="shop-list-sidebar.html">List Mode With Sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <h4 class="menu-title">Product Pages</h4>
                                                <ul>
                                                    <li><a href="product-variable.html">Variable Product</a></li>
                                                    <li><a href="product-featured.html">Featured &amp; Sale</a></li>
                                                    <li><a href="product-accordion.html">Data In Accordion</a></li>
                                                    <li><a href="product-section.html">Data In Sections</a></li>
                                                    <li><a href="product-swatch.html">Image Swatch</a></li>
                                                    <li><a href="product-extended.html">Extended Info</a>
                                                    </li>
                                                    <li><a href="product-without-sidebar.html">Without Sidebar</a></li>
                                                    <li><a href="product-video.html">360<sup>o</sup> &amp; Video<span class="tip tip-new">New</span></a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <h4 class="menu-title">Product Layouts</h4>
                                                <ul>
                                                    <li><a href="product-details.html">Default<span class="tip tip-hot">Hot</span></a></li>
                                                    <li><a href="product-vertical.html">Vertical Thumbs</a></li>
                                                    <li><a href="product-grid.html">Grid Images</a></li>
                                                    <li><a href="product-masonry.html">Masonry</a></li>
                                                    <li><a href="product-gallery.html">Gallery</a></li>
                                                    <li><a href="product-sticky-info.html">Sticky Info</a></li>
                                                    <li><a href="product-sticky-thumb.html">Sticky Thumbs</a></li>
                                                    <li><a href="product-sticky-both.html">Sticky Both</a></li>
                                                </ul>
                                            </li>
                                        </ul> -->
                                        <!-- End of Megamenu -->
                                    </li>
                                    
                                     <li class="<?= isset($header['about']) ? 'active' : '' ?>">
                                        <a href="<?= base_url('about-us')?>">About Us</a>
                                    </li>
                                    <li class="<?= isset($header['become_a_vendor']) ? 'active' : '' ?>">
                                        <a href="<?= base_url('become-a-vendor')?>">Become a Vendor</a>
                                        <!-- <ul>
                                            <li>
                                                <a href="vendor-dokan-store-list.html">Store Listing</a>
                                                <ul>
                                                    <li><a href="vendor-dokan-store-list.html">Store listing 1</a></li>
                                                    <li><a href="vendor-wcfm-store-list.html">Store listing 2</a></li>
                                                    <li><a href="vendor-wcmp-store-list.html">Store listing 3</a></li>
                                                    <li><a href="vendor-wc-store-list.html">Store listing 4</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="vendor-dokan-store.html">Vendor Store</a>
                                                <ul>
                                                    <li><a href="vendor-dokan-store.html">Vendor Store 1</a></li>
                                                    <li><a href="vendor-wcfm-store-product-grid.html">Vendor Store 2</a>
                                                    </li>
                                                    <li><a href="vendor-wcmp-store-product-grid.html">Vendor Store 3</a>
                                                    </li>
                                                    <li><a href="vendor-wc-store-product-grid.html">Vendor Store 4</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul> -->
                                    </li>
                                    <li class="<?= isset($header['contact']) ? 'active' : '' ?>">
                                        <a href="<?= base_url('contact-us')?>">Contact Us</a>
                                    </li>
                                    <!-- <li>
                                        <a href="blog.html">Blog</a>
                                        <ul>
                                            <li><a href="blog.html">Classic</a></li>
                                            <li><a href="blog-listing.html">Listing</a></li>
                                            <li>
                                                <a href="blog-grid-3cols.html">Grid</a>
                                                <ul>
                                                    <li><a href="blog-grid-2cols.html">Grid 2 columns</a></li>
                                                    <li><a href="blog-grid-3cols.html">Grid 3 columns</a></li>
                                                    <li><a href="blog-grid-4cols.html">Grid 4 columns</a></li>
                                                    <li><a href="blog-grid-sidebar.html">Grid sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="blog-masonry-3cols.html">Masonry</a>
                                                <ul>
                                                    <li><a href="blog-masonry-2cols.html">Masonry 2 columns</a></li>
                                                    <li><a href="blog-masonry-3cols.html">Masonry 3 columns</a></li>
                                                    <li><a href="blog-masonry-4cols.html">Masonry 4 columns</a></li>
                                                    <li><a href="blog-masonry-sidebar.html">Masonry sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="blog-mask-grid.html">Mask</a>
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
                                    
                                    <!-- <li>
                                        <a href="elements.html">Elements</a>
                                        <ul>
                                            <li><a href="element-accordions.html">Accordions</a></li>
                                            <li><a href="element-alerts.html">Alert &amp; Notification</a></li>
                                            <li><a href="element-blog-posts.html">Blog Posts</a></li>
                                            <li><a href="element-buttons.html">Buttons</a></li>
                                            <li><a href="element-cta.html">Call to Action</a></li>
                                            <li><a href="element-icons.html">Icons</a></li>
                                            <li><a href="element-icon-boxes.html">Icon Boxes</a></li>
                                            <li><a href="element-instagrams.html">Instagrams</a></li>
                                            <li><a href="element-categories.html">Product Category</a></li>
                                            <li><a href="element-products.html">Products</a></li>
                                            <li><a href="element-tabs.html">Tabs</a></li>
                                            <li><a href="element-testimonials.html">Testimonials</a></li>
                                            <li><a href="element-titles.html">Titles</a></li>
                                            <li><a href="element-typography.html">Typography</a></li>

                                            <li><a href="element-vendors.html">Vendors</a></li>
                                        </ul>
                                    </li> -->

                                </ul>
                            </nav>
                        </div>
                        <div class="header-right">
                            <a href="<?= base_url('order/history')?>" class="d-xl-show"><i class="w-icon-map-marker mr-1"></i>Track Order</a>
                            <a href="<?= base_url('daily-deals')?>" style="margin-right: -18px;"><i class="w-icon-sale"></i>Daily Deals</a>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .right-angle-parent{
                    position: relative;
                }
                .right-angle-icon{
                    position: absolute;
                    top: 50%;
                    right: 10px;
                    font-size: 8px !important;
                    font-weight: 900 !important;
                }
                .cat-img-size{
                    height: 30px;
                    width: 30px;
                }
            </style>
        </header>
        <!-- End of Header -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let user_id = '<?= isset($_SESSION['USER_user_id']) ? $_SESSION['USER_user_id'] : '' ?>'
    $.ajax({
        url: "<?= base_url('api/user') ?>",
        type: "GET",
        success: function (resp) {
            // resp = JSON.parse(resp)
            // console.log(resp.user_data.number)
            if (resp.status) {
                //    console.log(resp.number)
                var image_url = `https://cdn-icons-png.flaticon.com/512/8847/8847419.png`
                if (resp.user_img != null) {
                    image_url = `<?= base_url('public/uploads/user_images/') ?>${resp.user_img.img}`
                }
                html = `<a href="<?= base_url('wishlist')?>" class="icon-link">
                                <i class="fas fa-heart"></i> Wishlist
                            </a>
                            <a href="javascript:void(0)" class="icon-link" onclick="redirect_cart_page()">
                            <span id="cart-count" class="cart-count-badge"></span>    
                            <i class="fas fa-shopping-cart cart-icon">
                                    
                                </i> 
                                Cart
                                
                                
                            </a>
                            <a href="<?= base_url('user/account')?>" class="icon-link">
                                <i class="fas fa-user"></i> Account
                            </a>
                            <a href="javascript:void(0)" class="signup-btn" onclick="logout()" style="text-decoration: none;">Logout</a>`
                $('#authorised_account').html(html)
            } else {
                html = `<a href="<?= base_url('wishlist')?>" class="icon-link">
                                <i class="fas fa-heart"></i> Wishlist
                            </a>
                            <a href="javascript:void(0)" class="icon-link" onclick="redirect_cart_page()">
                             <span id="cart-count" class="cart-count-badge"></span>    
                            <i class="fas fa-shopping-cart cart-icon">
                                    
                                </i> 
                                Cart
                               
                            </a>
                            <a href="<?= base_url('login')?>" class="icon-link">
                                <i class="fas fa-user"></i> SignIn
                            </a>
                            <a href="<?= base_url('sign-up')?>" class="signup-btn" style="text-decoration: none;">SignUp</a>`

                // html = `<div class="ms-md-auto mt-5" style="height:80px; margin-left: -40px;">
                //                 <a href="<?= base_url('login') ?>" class="btn btn-primary btn-hover ml-5"><i class="bi bi-person-circle align-middle me-1"></i>Login</a>
                //             </div>`
                $('#authorised_account').html(html)

            }
        },
        error: function (err) {
            console.log(err)
        }
    })

    $(document).ready(function () {
        catalog()
    })
    
let suggestions = [
        // { name: "phone", category: "in Mobiles" },
        // { name: "photo frames", category: "in Photo Frames" },
];

// Function to show suggestions
// function showSuggestions() {
//     const input = document.getElementById("searchInput").value.toLowerCase();
//     const suggestionBox = document.getElementById("suggestionBox");
//     suggestionBox.innerHTML = ""; // Clear previous suggestions

//     if (input) {
//         const filteredSuggestions = suggestions.filter((item) =>
//             item.name.toLowerCase().includes(input)
//         );

//         filteredSuggestions.forEach((item) => {
//             const li = document.createElement("li");
//             li.innerHTML = `
//                 <i class="fas fa-search"></i>
//                 ${item.name}
//                 ${item.category ? `<span class="suggestion-category">${item.category}</span>` : ""}
//             `;
//             li.addEventListener("click", () => {
//                 document.getElementById("searchInput").value = item.name;
//                 suggestionBox.innerHTML = ""; // Hide suggestions
//             });
//             suggestionBox.appendChild(li);
//         });
//     }
// }

// function product_search(){
//     var alphabet = $('#searchInput').val()
//         $.ajax({
//             url: "<?= base_url('/api/search/product') ?>",
//             type: "GET",
//             data: {
//                 alph: alphabet
//             },
//             beforeSend: function () {
//             },
//             success: function (resp) {

//                 console.log(resp)
//                 if (resp.status == true) {
//                     html = ''
//                     if (resp.data.length > 0) {
//                         suggestions = []
//                         $.each(resp.data, function (index, product) {
//                             suggestions.push({
//                                 name: product.name,
//                                 category: product.category
//                             });
//                         })
//                     } else {
//                         suggestions.push({
//                                 name: 'No Product Found',
//                                 category: 'N/A'
//                         });
//                     }
//                 } else {
//                     // $('#product-grid').html(`<h3 class="text-danger">No Products Found</h3>`);
//                 }
//                 showSuggestions()
//             },
//             error: function (err) {
//                 console.error(err)
//             },
//             complete: function () { }
//         })
// }

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
                    window.location.href = `<?= base_url('product/details?id=')?>${item.product_id}`;
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
                    console.log('catalog',resp.data);
                    let subCatIndex = 0;

                    $.each(resp.data, function (index1, parent) {
                        // Construct main category HTML for both desktop and mobile
                        var main_html = `
                            <li id="catalog_subCategory${index1}" class="right-angle-parent">
                                <a href="<?= base_url('product/list?c_id=') ?>${parent.uid}">
                                    <img class="cat-img-size" src="<?= base_url('public/uploads/category_images/') ?>${parent.img_path}" alt=""><b> ${parent.name}</b>
                                </a>
                            </li>`;
                        
                        var main_html_mob = `
                            <li id="catalog_subCategory_mob${index1}" class="right-angle-parent">
                                <a href="<?= base_url('product/list?c_id=') ?>${parent.uid}">
                                    <img class="cat-img-size" src="<?= base_url('public/uploads/category_images/') ?>${parent.img_path}" alt=""> ${parent.name}
                                </a>
                            </li>`;
                        
                        $('#catalog_category').append(main_html);
                        $('#catalog_category_mob').append(main_html_mob);

                        // Check for subcategories
                        if (Array.isArray(parent.subCategories) && parent.subCategories.length > 0) {
                            let html = `<i class="fas fa-chevron-right right-angle-icon"></i>
                                        <ul class="megamenu" id="html_sub_cat_${index1}">
                                        </ul>`;
                            
                            let html_mob = `<i class="fas fa-chevron-right right-angle-icon"></i>
                                            <ul id="html_sub_cat_mob_${index1}">
                                            </ul>`;
                            
                            $('#catalog_subCategory' + index1).append(html);
                            $('#catalog_subCategory_mob' + index1).append(html_mob);

                            $.each(parent.subCategories, function (index2, subCat) {
                                // Subcategory structure for desktop
                                var html_sub = `
                                    <li>
                                        <h4 class="menu-title">${subCat.name}</h4>
                                        <hr class="divider">
                                        <ul id="child_sub_cat_${index1}_${index2}"></ul>
                                    </li>`;
                                
                                // Subcategory structure for mobile
                                var html_sub_mob = `
                                    <li>
                                        <a href="#">${subCat.name}</a>
                                        <ul id="child_sub_cat_mob_${index1}_${index2}"></ul>
                                    </li>`;
                                
                                $('#html_sub_cat_' + index1).append(html_sub);
                                $('#html_sub_cat_mob_' + index1).append(html_sub_mob);

                                // Check for child subcategories
                                if (Array.isArray(subCat.subCategories) && subCat.subCategories.length > 0) {
                                    let html2 = '';
                                    let html2_mob = '';

                                    $.each(subCat.subCategories, function (index3, childSubCat) {
                                        html2 += `<li><a href="<?= base_url('product/list?c_id=') ?>${childSubCat.uid}">${childSubCat.name}</a></li>`;
                                        html2_mob += `<li><a href="<?= base_url('product/list?c_id=') ?>${childSubCat.uid}">${childSubCat.name}</a></li>`;
                                    });

                                    $('#child_sub_cat_' + index1 + '_' + index2).html(html2);
                                    $('#child_sub_cat_mob_' + index1 + '_' + index2).html(html2_mob);
                                }
                            });
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

    function redirect_cart_page(){
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
            
            window.location.href = '<?= base_url('user/cart')?>';
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

    function increase_click_count(product_id){
        $.ajax({
            url: "<?= base_url('/api/user/id') ?>",
            type: "GET",
            success: function (resp) {
                if (resp.status){
                    $.ajax({
                        url: "<?= base_url('/api/increase/product/click-count') ?>",
                        type: "POST",
                        data: {
                            product_id: product_id
                        },
                        success: function (resp) {
                            if (resp.status){
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

    function logout() {;
        $.ajax({
            url: "<?= base_url('logout') ?>",
            type: "GET",
            success: function (resp) {
                window.location.href = '<?= base_url('login')?>';
            },
            error: function () {
            }
        })
    }
    function show_cart_length() 
    {
        $.ajax({
            url: '<?= base_url('/api/user/cart') ?>',
            type: "GET",
            data: {
                user_id: user_id  // Use this dynamically based on the logged-in user
            },
            success: function (resp) {
                if (resp.status) {
                    var totalItems = resp.data.length;  // Initialize total item count
                    console.log('itm',totalItems);

                    $('.cart-count-badge').text(totalItems);

                    // Assuming resp.data contains an array of cart items with a quantity field
                    
                } else {
                    $('#cart-count').hide();  // Hide the badge if there's an error or empty cart
                }
            },
            error: function (err) {
                console.error("Error fetching cart data:", err);
                $('#cart-count').hide();  // Hide the badge in case of error
            }
        });
    }

    function get_notice_text(){
        $.ajax({
            url: "<?= base_url('api/get/notice') ?>",
            type: "GET",
            data: {},
            success: function (resp) {
                // resp = JSON.parse(resp)
                // console.log(resp.user_data.number)
                if (resp.status) {
                    console.log('not',resp);
                    
                    // html=`<a href="${resp.user_data.facebook}" class="social-icon social-facebook w-icon-facebook"></a>
                    //                     <a href="${resp.user_data.twitter}" class="social-icon social-twitter w-icon-twitter"></a>
                    //                     <a href="${resp.user_data.instagram}" class="social-icon social-instagram w-icon-instagram"></a>
                    //                     <a href="${resp.user_data.youtube}" class="social-icon social-youtube w-icon-youtube"></a>`


                    html=`${resp.user_data.notice}`


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
