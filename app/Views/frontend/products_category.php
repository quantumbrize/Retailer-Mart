<style>
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
<!-- Start of Main -->
<main class="main">
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
    <br>

    <!-- Start of Page Content -->
    <div class="page-content">
        <div class="container">
            <!-- Start of Shop Banner -->
            <div class="shop-default-banner banner d-flex align-items-center justify-content-center mb-5 br-xs" id="cat_banner">
                <div class="banner-content">
                    <!-- <h4 class="banner-subtitle font-weight-bold">Accessories Collection</h4> -->
                    <h3 class="banner-title text-white text-uppercase font-weight-bolder ls-normal" id="cat_name"></h3>
                    <!-- <a href="shop-banner-sidebar.html" class="btn btn-dark btn-rounded btn-icon-right">Discover
                                Now<i class="w-icon-long-arrow-right"></i></a> -->
                </div>
            </div>
            <!-- End of Shop Banner -->


            <!-- Start of Shop Category -->
            <div class="shop-default-category category-ellipse-section mb-6">
                <div class="swiper-container swiper-theme shadow-swiper" data-swiper-options="{
                            'spaceBetween': 20,
                            'slidesPerView': 2,
                            'breakpoints': {
                                '480': {
                                    'slidesPerView': 3
                                },
                                '576': {
                                    'slidesPerView': 4
                                },
                                '768': {
                                    'slidesPerView': 6
                                },
                                '992': {
                                    'slidesPerView': 7
                                },
                                '1200': {
                                    'slidesPerView': 8,
                                    'spaceBetween': 30
                                }
                            }
                        }">
                    <div class="swiper-wrapper row gutter-lg cols-xl-8 cols-lg-7 cols-md-6 cols-sm-4 cols-xs-3 cols-2"
                        id="main-category-tab">

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <!-- End of Shop Category -->

            <!-- Start of Shop Content -->
            <!-- <div class="shop-content row gutter-lg mb-10"> -->
            <div class="shop-content">
                <!-- <aside class="sidebar shop-sidebar sticky-sidebar-wrapper sidebar-fixed">
                    <div class="sidebar-overlay"></div>
                    <a class="sidebar-close" href="#"><i class="close-icon"></i></a>

                    <div class="sidebar-content scrollable">
                        <div class="sticky-sidebar">
                            <div class="filter-actions">
                                <label>Filter :</label>
                                        <a href="#" class="btn btn-dark btn-link filter-clean">Clean All</a>
                            </div>
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title"><span>All Categories</span></h3>
                                <ul class="widget-body filter-items search-ul" id="category-tab">
                                </ul>
                            </div>
                        </div>
                    </div>
                </aside> -->
                <!-- End of Shop Sidebar -->

                <!-- Start of Shop Main Content -->
                <div class="main-content">
                    <!-- <nav class="toolbox sticky-toolbox sticky-content fix-top">
                        <div class="toolbox-left">
                            <a href="#" class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle 
                                        btn-icon-left d-block d-lg-none"><i
                                    class="w-icon-category"></i><span>Filters</span></a>
                        </div>
                        <div class="toolbox-right">
                            <div class="toolbox-item toolbox-layout">
                            </div>
                        </div>
                    </nav> -->
                    <div class="product-wrapper row cols-lg-6 cols-md-3 cols-sm-2 cols-2" id="product-grid">

                    </div>
                </div>
                <!-- End of Shop Main Content -->
            </div>
            <!-- End of Shop Content -->
        </div>
    </div>
    <!-- End of Page Content -->
</main>
<!-- End of Main -->