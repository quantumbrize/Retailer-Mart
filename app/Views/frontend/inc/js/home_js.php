<script>
    

    // // Select all nav links and tab content
    const navLinks = document.querySelectorAll('.nav-link');
    const tabContents = document.querySelectorAll('.tab-pane');
    navLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            navLinks.forEach(link => link.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            this.classList.add('active');
            const targetTab = document.querySelector(this.getAttribute('href'));
            targetTab.classList.add('active');
        });
    });


    // Set countdown time to 24 hours (in seconds)
    let countdownTime = 24 * 60 * 60;

    function updateCountdown() {
        // Calculate hours, minutes, and seconds
        const hours = Math.floor(countdownTime / 3600);
        const minutes = Math.floor((countdownTime % 3600) / 60);
        const seconds = countdownTime % 60;

        // Display the time
        document.getElementById('hours').textContent = String(hours).padStart(2, '0');
        document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
        document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');

        // Decrement countdown time
        countdownTime--;

        // Stop countdown at zero
        if (countdownTime < 0) {
            clearInterval(timerInterval);
            document.getElementById('hours').textContent = '00';
            document.getElementById('minutes').textContent = '00';
            document.getElementById('seconds').textContent = '00';
        }
    }

    // Start the countdown timer
    const timerInterval = setInterval(updateCountdown, 1000);
    //End Timer


    window.onscroll = function () {
        applyHeaderSearchClass();
    };

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
                mobileShowSuggestions();
            },
            error: function (err) {
                console.error(err);
            },
            complete: function () { }
        });
    }

    $(document).ready(function () {
    //     const element = document.querySelector('.swiper-container swiper-theme nav-top swiper-nav-lg'); // Replace with your element's selector
    // if (element) {
    // element.style.border = '2px solid red'; // Add a visual indicator
    // setTimeout(() => {
    //     element.style.border = ''; // Remove the highlight after a brief moment
    // }, 500); // Duration: 500 milliseconds
    // }

    // window.location.href = window.location.href + '<?= base_url()?>?cache_bust=' + new Date().getTime();
    

        // Initialize the carousel with options
        // $('#myCarousel').carousel({
        //     interval: 500,
        //     touch: true
        // });
        load_banners()
        products('all')
        get_promotion_card()
        latest_arival()
        load_most_popular_product()
        best_selling_products()
        load_category_fashion()
        load_category_home_garden()
        load_category_smart_phones()
        load_category_accessories()
        categories_of_the_month()
        hot_deals()
        best_selling()
    })

    function products(product_type) {
        $.ajax({
            url: "<?= base_url('/api/product') ?>",
            type: "GET",
            success: function (resp) {

                if (resp.status) {
                    $('#all_products').empty();
                    var margin_top_mobile = 0
                    var margin_top_tab = 0
                    $.each(resp.data, function (index, product) {


                        var view_more = `<a href="<?= base_url('product/list') ?>" class="btn btn-soft-primary btn-hover">View All Products<i class="mdi mdi-arrow-right align-middle ms-1"></i></a>`
                        if (index <= 8) {
                            var original_price = product.base_discount ? (product.base_price - (product.base_price * product.base_discount / 100)) : product.base_price;
                            var base_price = product.base_discount ? product.base_discount : "";
                            if (product_type == 'all') {
                                var element = document.getElementById("deal-banner");
                                // if (window.innerWidth > 1024) {
                                //     if (index <= 2) {
                                //         element.style.marginTop = "400px";
                                //     } else if (index <= 5) {
                                //         element.style.marginTop = "700px";
                                //     } else if (index <= 8) {
                                //         element.style.marginTop = "1100px";
                                //     }
                                // } else if (window.innerWidth <= 768) {
                                //     margin_top_mobile = margin_top_mobile + 350
                                //     element.style.marginTop = margin_top_mobile + "px";
                                // }else if(window.innerWidth <= 991.98){
                                //     margin_top_tab = margin_top_tab + 200
                                //     element.style.marginTop = margin_top_tab + "px";
                                // }
                                var add_to_cart_button = `<div class="product-btn px-3">
                                                            <a href="javascript:void(0);" onclick="add_to_cart('${product.product_id}')" class="btn btn-primary btn-sm w-75 add-btn"><i class="mdi mdi-cart me-1"></i> Add to cart</a>
                                                        </div>`
                                var message = ``
                                if (product.product_stock < 1) {
                                    add_to_cart_button = ``
                                    // message = `<span style="color:red;">Currently unavailable</span>`

                                }
                                let product_img = product.product_img.length > 0 ? '<?= base_url('public/uploads/product_images/') ?>' + product.product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                                html = `<div class="element-item col-xxl-3 col-xl-4 col-sm-6 seller hot arrival" data-category="hot arrival">
                                            <div class="card overflow-hidden">
                                                <a href="<?= base_url('product/details?id=') ?>${product.product_id}">
                                                    <div class="bg-warning-subtle rounded-top">
                                                        <div class="gallery-product">
                                                            <img src="${product_img}" alt="" style="max-height: 215px; max-width: 100%" class="mx-auto d-block" />
                                                        </div>
                                                        <p class="fs-11 fw-medium badge bg-primary py-2 px-3 product-lable mb-0"> Best Arrival </p>
                                                        <div class="gallery-product-actions">
                                                            
                                                        </div>
                                                        <div class="product-btn px-3">
                                                            <a href="<?= base_url('product/details?id=') ?>${product.product_id}" class="btn btn-primary btn-sm w-75 add-btn"><i class="mdi mdi-cart me-1"></i> View</a>
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="card-body">
                                                    <div>
                                                        <a href="<?= base_url('product/details?id=') ?>${product.product_id}">
                                                            <h6 class="fs-15 lh-base text-truncate mb-0">
                                                               ${product.name}
                                                            </h6>
                                                        </a>
                                                        <div class="mt-3">
                                                            <h5 class="mb-0">
                                                            ₹${original_price}
                                                                <span class="text-muted fs-12"><del>₹${product.base_price}</del></span>
                                                            </h5>
                                                        </div>
                                                        ${message}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`
                                $('#all_products').append(html);
                            } else if (product_type == 'new_arrival') {
                                var currentDate = new Date(); // Current date
                                var oneWeekAgo = new Date();
                                oneWeekAgo.setDate(oneWeekAgo.getDate() - 2);
                                if (new Date(product.created_at) > oneWeekAgo && new Date(product.created_at) <= currentDate) {
                                    var element = document.getElementById("deal-banner");
                                    if (window.innerWidth > 1024) {
                                        if (index <= 2) {
                                            element.style.marginTop = "400px";
                                        } else if (index <= 5) {
                                            element.style.marginTop = "700px";
                                        } else if (index <= 8) {
                                            element.style.marginTop = "1100px";
                                        }
                                    } else if (window.innerWidth <= 768) {
                                        margin_top_mobile = margin_top_mobile + 350
                                        element.style.marginTop = margin_top_mobile + "px";
                                    } else if (window.innerWidth <= 991.98) {
                                        margin_top_tab = margin_top_tab + 200
                                        element.style.marginTop = margin_top_tab + "px";
                                    }
                                    var add_to_cart_button = `<div class="product-btn px-3">
                                                                <a href="javascript:void(0);" onclick="add_to_cart('${product.product_id}')" class="btn btn-primary btn-sm w-75 add-btn"><i class="mdi mdi-cart me-1"></i> Add to cart</a>
                                                            </div>`
                                    var message = ``
                                    if (product.product_stock < 1) {
                                        add_to_cart_button = ``
                                        // message = `<span style="color:red;">Currently unavailable</span>`

                                    }
                                    html = `<div class="element-item col-xxl-3 col-xl-4 col-sm-6 seller hot arrival" data-category="hot arrival">
                                                <div class="card overflow-hidden">
                                                    <a href="<?= base_url('product/details?id=') ?>${product.product_id}">
                                                        <div class="bg-warning-subtle rounded-top">
                                                            <div class="gallery-product">
                                                                <img src="<?= base_url() ?>public/uploads/product_images/${product.product_img.length > 0 ? product.product_img[0].src : ''}" alt="" style="max-height: 215px; max-width: 100%" class="mx-auto d-block" />
                                                            </div>
                                                            <p class="fs-11 fw-medium badge bg-primary py-2 px-3 product-lable mb-0"> Best Arrival </p>
                                                            <div class="gallery-product-actions">
                                                                
                                                            </div>
                                                            <div class="product-btn px-3">
                                                            <a href="<?= base_url('product/details?id=') ?>${product.product_id}" class="btn btn-primary btn-sm w-75 add-btn"><i class="mdi mdi-cart me-1"></i> View</a>
                                                        </div>
                                                        </div>
                                                    </a>
                                                    <div class="card-body">
                                                        <div>
                                                            <a href="<?= base_url('product/details?id=') ?>${product.product_id}">
                                                                <h6 class="fs-15 lh-base text-truncate mb-0">
                                                                ${product.name}
                                                                </h6>
                                                            </a>
                                                            <div class="mt-3">
                                                                <h5 class="mb-0">
                                                                ₹${original_price}
                                                                    <span class="text-muted fs-12"><del>₹${product.base_price}</del></span>
                                                                </h5>
                                                            </div>
                                                            ${message}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>`
                                    $('#all_products').append(html);
                                }
                            }


                        }
                        if (index > 8) {
                            $('#view_more_product').html(view_more);
                        }
                    })
                } else {
                    console.log(resp)
                }

            },
            error: function (err) {
                console.log(err)
            },
        })
    }


    // Function to determine if the image is light or dark
    function isImageLight(imageUrl, threshold = 128) {
        return new Promise((resolve, reject) => {
            let img = new Image();
            img.crossOrigin = 'Anonymous';
            img.src = imageUrl;
            img.onload = function () {
                let canvas = document.createElement('canvas');
                let ctx = canvas.getContext('2d');
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);
                let imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                let brightnessSum = 0;
                for (let i = 0; i < imageData.data.length; i += 4) {
                    let r = imageData.data[i];
                    let g = imageData.data[i + 1];
                    let b = imageData.data[i + 2];
                    let brightness = (r + g + b) / 3;
                    brightnessSum += brightness;
                }
                let averageBrightness = brightnessSum / (imageData.data.length / 4);
                resolve(averageBrightness >= threshold);
            };
            img.onerror = function () {
                reject('Error loading image');
            };
        });
    }

    // let swiperBanner
    // function load_banners() {
    //     $.ajax({
    //         url: "<?= base_url('/api/banners') ?>",
    //         type: "GET",
    //         beforeSend: function () {
    //         },
    //         success: function (resp) {
    //             if (resp.status) {
    //                 $.each(resp.data, function (index, banner) {
    //                     let fontColor = '';
    //                     isImageLight(`<?= base_url('public/uploads/banner_images/') ?>${banner.img}`)
    //                         .then(isLight => {
    //                             if (isLight) {
    //                                 // console.log('Image is light');
    //                                 fontColor = 'black';
    //                             } else {
    //                                 // console.log('Image is dark');
    //                                 fontColor = 'light';
    //                             }
    //                             // console.log(fontColor);

    //                             isActive = index === 0 ? 'active' : ''
    //                             // console.log(isActive);
    //                             var shop_now = ``
    //                             if (banner.title != "") {
    //                                 shop_now = banner.link
    //                             }
    //                             // html = ` <div class="carousel-item ${isActive}">
    //                             //             <a href="${banner.link}" >
    //                             //                 <div class="image-container">
    //                             //                     <img src="<?= base_url('public/uploads/banner_images/') ?>${banner.img}" class="d-block w-100 carousel_img">
    //                             //                 </div>
    //                             //                 <div class="carousel-caption">
    //                             //                     <div class="row justify-content-end">
    //                             //                         <div class="col-lg-12">
    //                             //                             <div class="text-sm-end">
    //                             //                                 <h6 class="fs-24 display-4 fw-bold lh-base text-capitalize mb-3 text-${fontColor}">
    //                             //                                     ${banner.title}
    //                             //                                 </h6>
    //                             //                                 <div class="fs-20 mb-4 text-${fontColor}">
    //                             //                                     ${banner.description}
    //                             //                                 </div>
    //                             //                                 ${shop_now}
    //                             //                             </div>
    //                             //                         </div>
    //                             //                     </div>
    //                             //                 </div>
    //                             //             </a>
    //                             //         </div>`
    //                             html = `<a  href="${shop_now}" class="hero-ban swiper-slide banner banner-fixed intro-slide intro-slide1" style="background-image: url(<?= base_url('public/uploads/banner_images/') ?>${banner.img}); background-color: #ebeef2; background-size: cover; background-position: center;"></a>`


    //                             $('#banner_img').append(html);
    //                         })

    //                         .catch(error => {
    //                             console.error(error);
    //                         });
    //                 })
    //                 if (swiperBanner) {
    //                     swiperBanner.update();
    //                 } else {
    //                     var swiperOptions = {
    //                         slidesPerView: 1,
    //                         autoplay: {
    //                             delay: 3000,
    //                             disableOnInteraction: true
    //                         }
    //                     };

    //                     swiperBanner = new Swiper('.swiper-container.swiper-theme.nav-inner.pg-inner.swiper-nav-lg.animation-slider.pg-xxl-hide.nav-xxl-show.nav-hide', swiperOptions);
    //                 }

    //             } else {
    //             }

    //         },
    //         error: function (err) {
    //             console.log(err)
    //         },
    //         complete: function () {

    //         }
    //     })
    // }

    function load_banners() {
        $.ajax({
        url: "<?= base_url('/api/banners') ?>",
        type: "GET",
        beforeSend: function () {
            // Optional: Add a loading spinner if needed
        },
        success: function (resp) {
            if (resp.status) {
            const wrapper = $('.custom-carousel-wrapper');
            wrapper.empty(); // Clear any existing items
            
            // Append each banner dynamically
            $.each(resp.data, function (index, banner) {
                const slide = `
                <div class="custom-carousel-item">
                    <img src="<?= base_url('public/uploads/banner_images/') ?>${banner.img}" alt="Slide ${index + 1}">
                </div>`;
                wrapper.append(slide);
            });

            // Reinitialize the carousel after loading
            initializeCarousel();
            } else {
            console.log("No banners found.");
            }
        },
        error: function (err) {
            console.error(err);
        },
        complete: function () {
            // Optional: Hide loading spinner if added
        }
        });
    }

    function initializeCarousel() {
    const carousel = document.querySelector('.custom-carousel');
    const wrapper = carousel.querySelector('.custom-carousel-wrapper');
    const items = carousel.querySelectorAll('.custom-carousel-item');
    const prevBtn = carousel.querySelector('.custom-carousel-btn.prev');
    const nextBtn = carousel.querySelector('.custom-carousel-btn.next');

    let currentIndex = 0;
    let autoScrollInterval;

    function updateCarousel() {
      const offset = -currentIndex * 100;
      wrapper.style.transition = 'transform 0.5s ease-in-out';
      wrapper.style.transform = `translateX(${offset}%)`;
    }

    function jumpToStart() {
      wrapper.style.transition = 'none';
      wrapper.style.transform = 'translateX(0)';
      currentIndex = 0;
    }

    function jumpToEnd() {
      wrapper.style.transition = 'none';
      wrapper.style.transform = `translateX(${-100 * (items.length - 1)}%)`;
      currentIndex = items.length - 1;
    }

    function startAutoScroll() {
      stopAutoScroll(); // Clear any existing intervals
      autoScrollInterval = setInterval(() => {
        if (currentIndex < items.length - 1) {
          currentIndex += 1;
          updateCarousel();
        } else {
          jumpToStart();
        }
      }, 3000); // Auto-scroll every 3 seconds
    }

    function stopAutoScroll() {
      clearInterval(autoScrollInterval);
    }

    prevBtn.addEventListener('click', () => {
      stopAutoScroll();
      if (currentIndex > 0) {
        currentIndex -= 1;
      } else {
        jumpToEnd();
      }
      updateCarousel();
      startAutoScroll();
    });

    nextBtn.addEventListener('click', () => {
      stopAutoScroll();
      if (currentIndex < items.length - 1) {
        currentIndex += 1;
        updateCarousel();
      } else {
        jumpToStart();
        updateCarousel();
      }
      startAutoScroll();
    });

    // Start auto-scroll on load
    startAutoScroll();

    // Pause auto-scroll on hover
    carousel.addEventListener('mouseenter', stopAutoScroll);
    carousel.addEventListener('mouseleave', startAutoScroll);
  }

    function latest_arival() {
        $.ajax({
            url: "<?= base_url('/api/letest-arrival/product') ?>",
            type: "GET",
            beforeSend: function () {
            },
            success: function (resp) {
                if (resp.status) {
                    console.log('letest', resp)
                    $.each(resp.data, function (index, product) {
                        console.log('price', product.product_prices)
                        var add_to_cart_button = ` <div class="mt-3">
                                                        <a  onclick="add_to_cart('${product.product_id}')" class="btn btn-primary btn-sm"><i
                                                                class="mdi mdi-cart me-1"></i> Add to cart</a>
                                                    </div>`
                        if (product.product_stock < 1) {
                            add_to_cart_button = `<span style="color:red;">Currently unavailable</span>`

                        }

                        // if (new Date(product.created_at) > oneWeekAgo && new Date(product.created_at) <= currentDate) {
                        var original_price = product.base_discount ? (product.base_price - (product.base_price * product.base_discount / 100)) : product.base_price;
                        var base_price = product.base_discount ? product.base_discount : "";
                        var truncatedDescription = truncateText(product.description, 100);
                        let product_img = product.product_img.length > 0 ? '<?= base_url('public/uploads/product_images/') ?>' + product.product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                        html = `<div class="product-wrap">
                                    <div class="product text-center">
                                        <figure class="product-media">
                                            <a href="<?= base_url('product/details?id=') ?>${product.product_id}" onclick="increase_click_count('${product.product_id}')" class="img-con">
                                                <img src="${product_img}" alt="Product" width="300" height="338">
                                            </a>
                                            <div class="product-action-vertical product-action-popular">
                                                <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                                <a href="javascript:void(0)" class="btn-product-icon btn-wishlist w-icon-heart${product.is_wishlisted ? '-full' : ''}" data-product-id="${product.product_id}" title="Add to wishlist" onclick="wishlist('${product.product_id}')"></a>
                                            </div>
                                            <div class="product-label-group product-label-popular">
                                                <label class="product-label label-discount">${product.base_discount}% Off</label>
                                            </div>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name"><a href="<?= base_url('product/details?id=') ?>${product.product_id}" class="truncated-text" style="font-weight: bold;" onclick="increase_click_count('${product.product_id}')">${truncateText(product.name, 20)}</a></h4>
                                            <div class="product-price">
                                                <ins class="new-price">₹${product.product_prices != "" ? product.product_prices[product.product_prices.length - 1].price : ''} - ₹${product.product_prices != "" ? product.product_prices[0].price : ''}</ins>
                                            </div>
                                        </div>
                                    </div>
                                </div>`
                        $('#latest_arriva').append(html);
                        // }
                    })
                } else {
                }

            },
            error: function (err) {
                console.log(err)
            },
            complete: function () {

            }
        })
    }

    

    function truncateText(text, maxLength) {
        if (text.length > maxLength) {
            return text.substring(0, maxLength) + '...';
        } else {
            return text;
        }
    }
    function get_promotion_card() {
        $.ajax({
            url: "<?= base_url('/api/promotion-card/update') ?>",
            type: "GET",
            success: function (resp) {
                if (resp.status) {
                    console.log(resp.data);

                    // $('#images1').html(`<img src="<?= base_url('public/uploads/promotion_card_images/') ?>${resp.data.img1}" alt="">`)
                    // $('#imgLink1').val(resp.data.link1)
                    // $('#images2').html(`<img src="<?= base_url('public/uploads/promotion_card_images/') ?>${resp.data.img2}" alt="">`)
                    // $('#imgLink2').val(resp.data.link2)
                    // $('#card_id').val(resp.data.uid)

                    // html = `<div class="col-12 col-md-6">
                    //         <a href="${resp.data.link1}" class="product-banner-1 mt-4 mt-lg-0 rounded overflow-hidden position-relative d-block">
                    //             <img src="<?= base_url('public/uploads/promotion_card_images/') ?>${resp.data.img1}" class="img-fluid rounded" style="width: 100%; height: 50%; object-fit: cover;  object-position: center;" alt="" />
                    //             <div class="bg-overlay blue"></div>
                    //             <div class="product-content p-4">
                    //             </div>
                    //         </a>
                    //     </div>
                    //     <div class="col-12 col-md-6">
                    //         <a href="${resp.data.link2}" class="product-banner-1 mt-4 mt-lg-0 rounded overflow-hidden position-relative d-block">
                    //             <img src="<?= base_url('public/uploads/promotion_card_images/') ?>${resp.data.img2}" class="img-fluid rounded" style="width: 100%; height: 50%; object-fit: cover;  object-position: center;" alt="" />
                    //             <div class="product-content p-4">
                    //             </div>
                    //         </a>
                    //     </div>`
                    let colSize = 3
                    let screenWidth = window.innerWidth;
                    if (screenWidth < 768) {
                        colSize = 6
                    }
                    html = `<div class="col-md-${colSize} mb-4">
                                <div class="banner banner-fixed category-banner-1 br-xs">
                                        
                                    <figure>
                                        <a href="${resp.data.link1}" target="_blank"> 
                                            <img src="<?= base_url('public/uploads/promotion_card_images/') ?>${resp.data.img1}" alt="Category Banner" width="610" height="200" style="background-color: #3B4B48;">
                                        </a>
                                    </figure>
                                    
                                </div>
                            </div>
                            <div class="col-md-${colSize} mb-4">
                                <div class="banner banner-fixed category-banner-2 br-xs">
                                    <figure>
                                        <a href="${resp.data.link2}" target="_blank">
                                            <img src="<?= base_url('public/uploads/promotion_card_images/') ?>${resp.data.img2}" alt="Category Banner" width="610" height="200" style="background-color: #E5E5E5;">
                                        </a>
                                    </figure>
                                </div>
                            </div>
                            <div class="col-md-${colSize} mb-4">
                                <div class="banner banner-fixed category-banner-2 br-xs">
                                    <figure>
                                        <a href="${resp.data.link3}" target="_blank">
                                            <img src="<?= base_url('public/uploads/promotion_card_images/') ?>${resp.data.img3}" alt="Category Banner" width="610" height="200" style="background-color: #E5E5E5;">
                                        </a>
                                    </figure>
                                </div>
                            </div>
                            <div class="col-md-${colSize} mb-4">
                                <div class="banner banner-fixed category-banner-2 br-xs">
                                    <figure>
                                        <a href="${resp.data.link4}" target="_blank">
                                            <img src="<?= base_url('public/uploads/promotion_card_images/') ?>${resp.data.img4}" alt="Category Banner" width="610" height="200" style="background-color: #E5E5E5;">
                                        </a>
                                    </figure>
                                </div>
                            </div>`
                    // html2 = `<div class="col-md-6 mb-4">
                    //                 <div class="banner banner-fixed category-banner-1 br-xs">
                    //                     <figure>
                    //                         <a href="${resp.data.link3}" target="_blank">
                    //                             <img src="<?= base_url('public/uploads/promotion_card_images/') ?>${resp.data.img3}" alt="Category Banner" width="610" height="200" style="background-color: #3B4B48;">
                    //                         </a>
                    //                     </figure>
                    //                 </div>
                    //             </div>
                    //             <div class="col-md-6 mb-4">
                    //                 <div class="banner banner-fixed category-banner-2 br-xs">
                    //                     <figure>
                    //                         <a href="${resp.data.link4}" target="_blank">
                    //                             <img src="<?= base_url('public/uploads/promotion_card_images/') ?>${resp.data.img4}" alt="Category Banner" width="610" height="200" style="background-color: #E5E5E5;">
                    //                         </a>
                    //                     </figure>
                    //                 </div>
                    //             </div>`
                    $('#promotion_card').append(html);
                    // $('#promotion_card2').append(html2);

                } else {
                    console.log(resp)
                }
            },
            error: function (err) {
                console.log(err)
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

    function load_category_fashion() {
        var c_id = 'CATEAD0BFF320241112'
        $.ajax({
            url: "<?= base_url('/api/category/product/list') ?>",
            type: "GET",
            data: {
                c_id: c_id
            },
            beforeSend: function () {
            },
            success: function (resp) {

                // console.log(resp)
                if (resp.status == true) {
                    html = ''
                    if (resp.data.length > 0) {
                        console.log('phone', resp)
                        let html = ''
                        let str = ` <div class="swiper-wrapper row cols-xl-3 cols-lg-3 cols-2">`
                        // console.log(resp.data.length)
                        for (let i = 0; i < resp.data.length; i += 2) {
                            // console.log(i)
                            str += `<div class="swiper-slide product-col">`
                            let row = "";
                            for (let j = i; j < i + 2; j++) {
                                if (resp.data[j] == null || resp.data[j] == "") {
                                    str += ''
                                } else {
                                    let product_img = resp.data[j].product_img.length > 0 ? '<?= base_url('public/uploads/product_images/') ?>' + resp.data[j].product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                                    str += `<div class="product-wrap product text-center">
                                                <figure class="product-media">
                                                    <a href="<?= base_url('product/details?id=') ?>${resp.data[j].product_id}" onclick="increase_click_count('${resp.data[j].product_id}')">
                                                        <img src="${product_img}" alt="Product" width="216" height="243">
                                                    </a>
                                                    <div class="product-action-vertical product-action-fashon">
                                                        <!-- <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a> -->
                                                        <a href="javascript:void(0)" class="btn-product-icon btn-wishlist w-icon-heart${resp.data[j].is_wishlisted ? '-full' : ''}" data-product-id="${resp.data[j].product_id}" title="Add to wishlist" onclick="wishlist('${resp.data[j].product_id}')"></a>
                                                        <!-- <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a> -->
                                                        <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Add to Compare"></a> -->
                                                    </div>
                                                    <div class="product-label-group product-label-categories">
                                                        <label class="product-label label-discount">${resp.data[j].base_discount}% Off</label>
                                                    </div>
                                                </figure>
                                                <div class="product-details">
                                                    <h4 class="product-name"><a href="<?= base_url('product/details?id=') ?>${resp.data[j].product_id}" class="truncated-text" onclick="increase_click_count('${resp.data[j].product_id}')">${truncateText(resp.data[j].name, 20)}</a>
                                                    </h4>
                                                    <!-- <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 60%;"></span>
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                        <a href="<?= base_url('product/details?id=') ?>${resp.data[j].product_id}" class="rating-reviews">(3
                                                            reviews)</a>
                                                    </div> -->
                                                    <div class="product-price">
                                                        <ins class="new-price">₹${resp.data[j].product_prices != "" ? resp.data[j].product_prices[resp.data[j].product_prices.length - 1].price : ''} - ₹${resp.data[j].product_prices != "" ? resp.data[j].product_prices[0].price : ''}</ins>
                                                    </div>
                                                </div>
                                            </div>`
                                }

                            }
                            str += `</div>`
                        }
                        // str += `<div class="swiper-pagination"></div>`
                        $('#fashion_category').html(str)
                        // new Swiper('#fashion_category', {
                        //     spaceBetween: 20,
                        //     slidesPerView: 2,
                        //     pagination: {
                        //         el: '.swiper-pagination',
                        //         clickable: true
                        //     },
                        //     breakpoints: {
                        //         992: {
                        //             slidesPerView: 3
                        //         },
                        //         1200: {
                        //             slidesPerView: 4
                        //         }
                        //     }
                        // });

                        // $('#table-best-selling-list-all-body').html(html)

                    } else {
                        $('#fashion_category').html(`<h3 class="text-danger">No Products Found</h3>`);
                    }
                } else {
                    $('#fashion_category').html(`<h3 class="text-danger">No Products Found</h3>`);
                }
            },
            error: function (err) {
                console.error(err)
            },
            complete: function () { }
        })

    }

    function load_category_home_garden() {
        var c_id = 'CAT5862435920241112'
        $.ajax({
            url: "<?= base_url('/api/category/product/list') ?>",
            type: "GET",
            data: {
                c_id: c_id
            },
            beforeSend: function () {
            },
            success: function (resp) {

                // console.log(resp)
                if (resp.status == true) {
                    html = ''
                    if (resp.data.length > 0) {
                        console.log('mens', resp)
                        let html = ''
                        let str = ` <div class="swiper-wrapper row cols-xl-4 cols-lg-3 cols-2">`
                        // console.log(resp.data.length)
                        for (let i = 0; i < resp.data.length; i += 2) {
                            // console.log(i)
                            str += `<div class="swiper-slide product-col">`
                            let row = "";
                            for (let j = i; j < i + 2; j++) {
                                if (resp.data[j] == null || resp.data[j] == "") {
                                    str += ''
                                } else {
                                    let product_img = resp.data[j].product_img.length > 0 ? '<?= base_url('public/uploads/product_images/') ?>' + resp.data[j].product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                                    str += `<div class="product-wrap product text-center">
                                                <figure class="product-media">
                                                    <a href="<?= base_url('product/details?id=') ?>${resp.data[j].product_id}" onclick="increase_click_count('${resp.data[j].product_id}')">
                                                        <img src="${product_img}" alt="Product" width="216" height="243">
                                                    </a>
                                                    <div class="product-action-vertical">
                                                        <!-- <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a> -->
                                                        <a href="javascript:void(0)" class="btn-product-icon btn-wishlist w-icon-heart${resp.data[j].is_wishlisted ? '-full' : ''}" data-product-id="${resp.data[j].product_id}" title="Add to wishlist" onclick="wishlist('${resp.data[j].product_id}')"></a>
                                                        <!-- <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a> -->
                                                        <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Add to Compare"></a> -->
                                                    </div>
                                                    <div class="product-label-group product-label-categories2">
                                                        <label class="product-label label-discount">${resp.data[j].base_discount}% Off</label>
                                                    </div>
                                                </figure>
                                                <div class="product-details">
                                                    <h4 class="product-name"><a href="<?= base_url('product/details?id=') ?>${resp.data[j].product_id}" class="truncated-text" onclick="increase_click_count('${resp.data[j].product_id}')">${truncateText(resp.data[j].name, 20)}</a>
                                                    </h4>
                                                    <!-- <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 60%;"></span>
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                        <a href="<?= base_url('product/details?id=') ?>${resp.data[j].product_id}" class="rating-reviews">(3
                                                            reviews)</a>
                                                    </div> -->
                                                    <div class="product-price">
                                                        <ins class="new-price">₹${resp.data[j].product_prices != "" ? resp.data[j].product_prices[resp.data[j].product_prices.length - 1].price : ''} - ₹${resp.data[j].product_prices != "" ? resp.data[j].product_prices[0].price : ''}</ins>
                                                    </div>
                                                </div>
                                            </div>`
                                }

                            }
                            str += `</div>`
                        }
                        str += `<div class="swiper-pagination"></div>`
                        $('#home_garden_category').html(str)
                        // new Swiper('#home_garden_category', {
                        //     spaceBetween: 20,
                        //     slidesPerView: 2,
                        //     pagination: {
                        //         el: '.swiper-pagination',
                        //         clickable: true
                        //     },
                        //     breakpoints: {
                        //         992: {
                        //             slidesPerView: 3
                        //         },
                        //         1200: {
                        //             slidesPerView: 4
                        //         }
                        //     }
                        // });

                        // $('#table-best-selling-list-all-body').html(html)

                    } else {
                        $('#home_garden_category').html(`<h3 class="text-danger">No Products Found</h3>`);
                    }
                } else {
                    $('#home_garden_category').html(`<h3 class="text-danger">No Products Found</h3>`);
                }
            },
            error: function (err) {
                console.error(err)
            },
            complete: function () { }
        })

    }

    function load_category_smart_phones() {
        var c_id = 'CAT5548EEE620241112'
        $.ajax({
            url: "<?= base_url('/api/category/product/list') ?>",
            type: "GET",
            data: {
                c_id: c_id
            },
            beforeSend: function () {
            },
            success: function (resp) {

                // console.log(resp)
                if (resp.status == true) {
                    html = ''
                    if (resp.data.length > 0) {
                        console.log('mens', resp)
                        let html = ''
                        let str = ` <div class="swiper-wrapper row cols-xl-4 cols-lg-3 cols-2">`
                        // console.log(resp.data.length)
                        for (let i = 0; i < resp.data.length; i += 2) {
                            // console.log(i)
                            str += `<div class="swiper-slide product-col">`
                            let row = "";
                            for (let j = i; j < i + 2; j++) {
                                if (resp.data[j] == null || resp.data[j] == "") {
                                    str += ''
                                } else {
                                    let product_img = resp.data[j].product_img.length > 0 ? '<?= base_url('public/uploads/product_images/') ?>' + resp.data[j].product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                                    str += `<div class="product-wrap product text-center">
                                                <figure class="product-media">
                                                    <a href="<?= base_url('product/details?id=') ?>${resp.data[j].product_id}" onclick="increase_click_count('${resp.data[j].product_id}')">
                                                        <img src="${product_img}" alt="Product" width="216" height="243">
                                                    </a>
                                                    <div class="product-action-vertical">
                                                        <!-- <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a> -->
                                                        <a href="javascript:void(0)" class="btn-product-icon btn-wishlist w-icon-heart${resp.data[j].is_wishlisted ? '-full' : ''}" data-product-id="${resp.data[j].product_id}" title="Add to wishlist" onclick="wishlist('${resp.data[j].product_id}')"></a>
                                                        <!-- <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a> -->
                                                        <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Add to Compare"></a> -->
                                                    </div>
                                                    <div class="product-label-group product-label-categories">
                                                        <label class="product-label label-discount">${resp.data[j].base_discount}% Off</label>
                                                    </div>
                                                </figure>
                                                <div class="product-details">
                                                    <h4 class="product-name"><a href="<?= base_url('product/details?id=') ?>${resp.data[j].product_id}" class="truncated-text" onclick="increase_click_count('${resp.data[j].product_id}')">${truncateText(resp.data[j].name, 20)}</a>
                                                    </h4>
                                                    <!-- <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 60%;"></span>
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                        <a href="<?= base_url('product/details?id=') ?>${resp.data[j].product_id}" class="rating-reviews">(3
                                                            reviews)</a>
                                                    </div> -->
                                                    <div class="product-price">
                                                        <ins class="new-price">₹${resp.data[j].product_prices != "" ? resp.data[j].product_prices[resp.data[j].product_prices.length - 1].price : ''} - ₹${resp.data[j].product_prices != "" ? resp.data[j].product_prices[0].price : ''}</ins>
                                                    </div>
                                                </div>
                                            </div>`
                                }

                            }
                            str += `</div>`
                        }
                        str += `<div class="swiper-pagination"></div>`
                        $('#smart_phones_category').html(str)
                        // new Swiper('#smart_phones_category', {
                        //     spaceBetween: 20,
                        //     slidesPerView: 2,
                        //     pagination: {
                        //         el: '.swiper-pagination',
                        //         clickable: true
                        //     },
                        //     breakpoints: {
                        //         992: {
                        //             slidesPerView: 3
                        //         },
                        //         1200: {
                        //             slidesPerView: 4
                        //         }
                        //     }
                        // });

                        // $('#table-best-selling-list-all-body').html(html)

                    } else {
                        $('#smart_phones_category').html(`<h3 class="text-danger">No Products Found</h3>`);
                    }
                } else {
                    $('#smart_phones_category').html(`<h3 class="text-danger">No Products Found</h3>`);
                }
            },
            error: function (err) {
                console.error(err)
            },
            complete: function () { }
        })

    }

    function load_category_accessories() {
        var c_id = 'CAT1572090220241112'
        $.ajax({
            url: "<?= base_url('/api/category/product/list') ?>",
            type: "GET",
            data: {
                c_id: c_id
            },
            beforeSend: function () {
            },
            success: function (resp) {

                // console.log(resp)
                if (resp.status == true) {
                    html = ''
                    if (resp.data.length > 0) {
                        console.log('mens', resp)
                        let html = ''
                        let str = ` <div class="swiper-wrapper row cols-xl-4 cols-lg-3 cols-2">`
                        // console.log(resp.data.length)
                        for (let i = 0; i < resp.data.length; i += 2) {
                            // console.log(i)
                            str += `<div class="swiper-slide product-col">`
                            let row = "";
                            for (let j = i; j < i + 2; j++) {
                                if (resp.data[j] == null || resp.data[j] == "") {
                                    str += ''
                                } else {
                                    let product_img = resp.data[j].product_img.length > 0 ? '<?= base_url('public/uploads/product_images/') ?>' + resp.data[j].product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                                    str += `<div class="product-wrap product text-center">
                                                <figure class="product-media">
                                                    <a href="<?= base_url('product/details?id=') ?>${resp.data[j].product_id}" onclick="increase_click_count('${resp.data[j].product_id}')">
                                                        <img src="${product_img}" alt="Product" width="216" height="243">
                                                    </a>
                                                    <div class="product-action-vertical product-action-vertical-accessories">
                                                        <!-- <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a> -->
                                                        <a href="javascript:void(0)" class="btn-product-icon btn-wishlist w-icon-heart${resp.data[j].is_wishlisted ? '-full' : ''}" data-product-id="${resp.data[j].product_id}" title="Add to wishlist" onclick="wishlist('${resp.data[j].product_id}')"></a>
                                                        <!-- <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a> -->
                                                        <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Add to Compare"></a> -->
                                                    </div>
                                                    <div class="product-label-group product-label-categories2">
                                                        <label class="product-label label-discount">${resp.data[j].base_discount}% Off</label>
                                                    </div>
                                                </figure>
                                                <div class="product-details">
                                                    <h4 class="product-name"><a href="<?= base_url('product/details?id=') ?>${resp.data[j].product_id}" class="truncated-text" onclick="increase_click_count('${resp.data[j].product_id}')">${truncateText(resp.data[j].name, 20)}</a>
                                                    </h4>
                                                    <!-- <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 60%;"></span>
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                        <a href="<?= base_url('product/details?id=') ?>${resp.data[j].product_id}" class="rating-reviews">(3
                                                            reviews)</a>
                                                    </div> -->
                                                    <div class="product-price">
                                                        <ins class="new-price">₹${resp.data[j].product_prices != "" ? resp.data[j].product_prices[resp.data[j].product_prices.length - 1].price : ''} - ₹${resp.data[j].product_prices != "" ? resp.data[j].product_prices[0].price : ''}</ins>
                                                    </div>
                                                </div>
                                            </div>`
                                }

                            }
                            str += `</div>`
                        }
                        str += `<div class="swiper-pagination"></div>`
                        $('#accessories_category').html(str)
                        // new Swiper('#accessories_category', {
                        //     spaceBetween: 20,
                        //     slidesPerView: 2,
                        //     pagination: {
                        //         el: '.swiper-pagination',
                        //         clickable: true
                        //     },
                        //     breakpoints: {
                        //         992: {
                        //             slidesPerView: 3
                        //         },
                        //         1200: {
                        //             slidesPerView: 4
                        //         }
                        //     }
                        // });

                        // $('#table-best-selling-list-all-body').html(html)

                    } else {
                        $('#accessories_category').html(`<h3 class="text-danger">No Products Found</h3>`);
                    }
                } else {
                    $('#accessories_category').html(`<h3 class="text-danger">No Products Found</h3>`);
                }
            },
            error: function (err) {
                console.error(err)
            },
            complete: function () { }
        })

    }

    var swiper;
    function categories_of_the_month() {
        $.ajax({
            url: "<?= base_url('/api/categories') ?>",
            type: "GET",
            beforeSend: function () { },
            success: function (resp) {
                if (resp.status) {
                    // console.log(resp)
                    html = ``
                    $.each(resp.data, function (index, item) {
                        // html_desktop += `<div class="category-card large" onclick="window.location.href = '<?= base_url() ?>product/list?c_id=${item.uid}'">
                        //                     <img
                        //                     class="large-category-img"
                        //                     src="<?= base_url('public/uploads/category_images/') ?>${item.img_path}"
                        //                     alt=""
                        //                     />
                        //                     <div class="overlay">${item.name}</div>
                        //                 </div>
                        html += `<div class="swiper-slide category category-classic category-absolute overlay-zoom br-xs">
                                    <a href="<?= base_url('product/category?c_id=') ?>${item.uid}" class="category-media">
                                        <img src="<?= base_url('public/uploads/category_images/') ?>${item.img_path}" alt="Category" width="130" height="130">
                                    </a> <br>
                                    <div class="category-content">
                                        
                                        <a href="<?= base_url('product/category?c_id=') ?>${item.uid}" class="btn btn-primary btn-link btn-underline">Shop
                                            Now</a>
                                    </div>
                                    <h4 class="category-name" style="color:#000;">${item.name}</h4>
                                </div>`
                    })
                    $('#all_categoris_desktop').html(html)
                    if (swiper) {
                        swiper.update();  // Update swiper to recognize new slides
                    } else {
                        swiper = new Swiper('.swiper-container-top-cat', {
                            spaceBetween: 20,
                            slidesPerView: 4,
                            breakpoints: {
                                576: {
                                    slidesPerView: 3
                                },
                                768: {
                                    slidesPerView: 5
                                },
                                992: {
                                    slidesPerView: 6
                                }
                            },
                            autoplay: {
                                delay: 3000, // Delay in milliseconds (e.g., 3000ms = 3 seconds)
                                disableOnInteraction: false // Keeps autoplay running even after user interaction
                            },
                            loop: true // Loops back to the first slide after the last slide
                        });
                    }

                }
            },
            error: function (err) {
                console.error(err)
            }
        })


    }

    let swiperHotDeal
    function hot_deals() {
        $.ajax({
            url: "<?= base_url('/api/last-product') ?>",
            type: "GET",
            beforeSend: function () {
            },
            success: function (resp) {
                console.log('hot', resp)
                if (resp.status) {
                    var add_to_cart_button = ` <div class="mt-3">
                                                        <a  onclick="add_to_cart('${resp.data[0].product_id}')" class="btn btn-primary btn-sm"><i
                                                                class="mdi mdi-cart me-1"></i> Add to cart</a>
                                                    </div>`
                    if (resp.data[0].product_stock < 1) {
                        add_to_cart_button = `<span style="color:red;">Currently unavailable</span>`

                    }

                    // if (new Date(product.created_at) > oneWeekAgo && new Date(product.created_at) <= currentDate) {
                    var original_price = resp.data[0].base_discount ? (resp.data[0].base_price - (resp.data[0].base_price * resp.data[0].base_discount / 100)).toFixed(2) : resp.data[0].base_price.toFixed(2);
                    var base_price = resp.data[0].base_discount ? resp.data[0].base_discount : "";
                    let html_main_imgs = ''
                    let html_imgs = ''
                    let sizes = ''
                    if (resp.data[0].product_img.length > 0) {
                        $.each(resp.data[0].product_img, function (index, imgs) {
                            html_main_imgs += `<div class="swiper-slide">
                                                <figure class="product-image">
                                                    <img src="<?= base_url() ?>public/uploads/product_images/${imgs.src}" alt="Product Image" width="800" height="900">
                                                </figure>
                                                </div>`
                            html_imgs += `<div class="product-thumb swiper-slide">
                                                        <img src="<?= base_url() ?>public/uploads/product_images/${imgs.src}"alt="Product thumb" width="60" height="68">
                                                    </div>`
                        })
                    } else {
                        html_main_imgs += `<div class="swiper-slide">
                                                <figure class="product-image">
                                                    <img src="<?= base_url('public/assets/images/product_demo.png') ?>" alt="Product Image" width="800" height="900">
                                                </figure>
                                                </div>`
                        html_imgs += `<div class="product-thumb swiper-slide">
                                                    <img src="<?= base_url('public/assets/images/product_demo.png') ?>"alt="Product thumb" width="60" height="68">
                                                </div>`
                    }

                    $('#img_list').html(html_main_imgs);
                    $('#all_img_list').html(html_imgs);
                    $('#hot_deals_product_name').html(`<a href="<?= base_url('product/details?id=') ?>${resp.data[0].product_id}">${resp.data[0].name}</a>`);
                    $('#hot_deal_price').html(`₹${resp.data[0].product_prices != "" ? resp.data[0].product_prices[resp.data[0].product_prices.length - 1].price : ''} - ₹${resp.data[0].product_prices != "" ? resp.data[0].product_prices[0].price : ''}`);

                    $('#wishlist-icon').html(`<a href="javascript:void(0)" class="btn-product-icon btn-wishlist ml-2 w-icon-heart${resp.data[0].is_wishlisted ? '-full' : ''}" data-product-id="${resp.data[0].product_id}" onclick="wishlist('${resp.data[0].product_id}')"></a>`);
                    let html_size = '';
                    let isavailable = false
                    // console.log(resp[0].data.product_sizes);

                    $.each(resp.data[0].product_sizes, function (index, size) {
                        if (parseInt(size.stocks, 10) > 0) {
                            html_size += `<a href="javascript:void(0)" class="size active-size" data-size="${size.uid}" style="font-weight:bold;" onclick="setActive(this, '${size.stocks}')">${size.sizes}</a>`;
                            isavailable = true
                        } else {
                            html_size += `<a href="javascript:void(0)" class="size" data-size="${size.uid}" onclick="setActive(this, '${size.stocks}')">${size.sizes}</a>`;
                        }

                    });
                    $('#hot_deal_product_sizes').html(html_size);
                    $('#view_btn_hot_deal').html(`<button class="btn btn-primary" onclick="window.location.href='<?= base_url('product/details?id=') ?>${resp.data[0].product_id}'">
                                                                <span>View</span>
                                                            </button>
                                                            <button class="btn btn-primary ml-2" onclick="add_to_cart('${resp.data[0].product_id}', '${resp.data[0].product_prices[resp.data[0].product_prices.length - 1].min_qty}')">
                                                                <i class="w-icon-cart"></i>
                                                                <span>Add to cart</span>
                                                            </button>`);
                    if (swiperHotDeal) {
                        swiperHotDeal.update();
                    } else {
                        swiperHotDeal = new Swiper('.swiper-container-hot-deals', {
    breakpoints: {
        0: {
            direction: 'horizontal',
            slidesPerView: resp.data[0].product_img.length
        },
        992: {
            direction: 'vertical',
            slidesPerView: 'auto'
        }
    },
    autoplay: {
        delay: 3000,  // Adjust the delay (in milliseconds) between slides
        disableOnInteraction: false,  // Ensures autoplay continues even after user interaction
    }
});

                    }

                    // }
                } else {
                }

            },
            error: function (err) {
                console.log(err)
            },
            complete: function () {

            }
        })
    }

    function setActive(element, stock) {
        if (parseInt(stock, 10) > 0) {
            // Remove the 'active' class from all size elements
            document.querySelectorAll('#hot_deal_product_sizes .size').forEach(function (size) {
                size.classList.remove('active');
            });

            // Add the 'active' class to the clicked element
            element.classList.add('active');
        }
    }

    function add_to_cart(product_id, quty) {
        const activeSize = document.querySelector('.size.active');
        if (activeSize) {
            var product_quantity = quty
            const sizeValue = activeSize.getAttribute('data-size');
            console.log(product_quantity)
            console.log(sizeValue)
            $.ajax({
                url: "<?= base_url('/api/user/id') ?>",
                type: "GET",
                success: function (resp) {
                    if (resp.status) {
                        console.log(resp.data)
                        if (sizeValue == "") {
                            Toastify({
                                text: 'Size Not Found'.toUpperCase(),
                                duration: 3000,
                                position: "center",
                                stopOnFocus: true,
                                style: {
                                    background: 'darkred',
                                },
                            }).showToast();
                        } else {
                            $.ajax({
                                url: "<?= base_url('/api/user/cart/add') ?>",
                                type: "POST",
                                data: {
                                    product_id: product_id,
                                    user_id: resp.data,
                                    variation_id: "",
                                    qty: product_quantity,
                                    size: sizeValue,
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
                                        show_cart_length()
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
                        }
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
                        window.location.href = `<?= base_url() ?>sign-up`;
                    }
                },
                error: function (err) {
                    console.log(err)
                },
            })

        } else {
            Toastify({
                text: 'Please select a size'.toUpperCase(),
                duration: 3000,
                position: "center",
                stopOnFocus: true,
                style: {
                    background: 'darkred',
                },
            }).showToast();
        }

    }

    function best_selling() {
        $.ajax({
            url: '<?= base_url('/api/best-selling/product') ?>',
            type: "GET",
            beforeSend: function () {
                // $('#table-best-selling-list-all-body').html(`<tr >
                //         <td colspan="7"  style="text-align:center;">
                //             <div class="spinner-border" role="status"></div>
                //         </td>
                //     </tr>`)
            },
            success: function (resp) {
                if (resp.status) {
                    let html = ''
                    console.log('best selling', resp)
                    $.each(resp.data, function (index, item) {
                        if (item.products != null && item.products != "") {
                            html += `<div class="swiper-slide product-widget-wrap">`
                            $.each(item.products, function (index, product) {
                                if(index < 3){
                                    let product_img = product.product_img.length > 0 ? '<?= base_url('public/uploads/product_images/') ?>' + product.product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                                    html += `<div class="product product-widget bb-no">
                                                        <figure class="product-media">
                                                            <a href="<?= base_url('product/details?id=') ?>${product.product_id}" class="product-media-img-bx" onclick="increase_click_count('${product.product_id}')">
                                                                <img src="${product_img}" alt="Product" width="105" height="118">
                                                            </a>
                                                        </figure>
                                                        <div class="product-details">
                                                            <h4 class="product-name">
                                                                <a href="<?= base_url('product/details?id=') ?>${product.product_id}" onclick="increase_click_count('${product.product_id}')">${product.name}</a>
                                                            </h4>
                                                            <div class="product-price">
                                                                <ins class="new-price">₹${product.product_prices != "" ? product.product_prices[product.product_prices.length - 1].price : ''} - ₹${product.product_prices != "" ? product.product_prices[0].price : ''}</ins>
                                                            </div>
                                                        </div>
                                                    </div>`
                                }
                                
                            })
                            html += `</div>`
                        }


                    })
                    $('#best_selling').html(html)
                    var swiperBestSelling = {
                        slidesPerView: 1,
                        spaceBetween: 20,
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true,
                        },
                        breakpoints: {
                            576: {
                                slidesPerView: 2
                            },
                            768: {
                                slidesPerView: 3
                            },
                            992: {
                                slidesPerView: 1
                            }
                        }
                    };

                    var swiper = new Swiper('.swiper-container-best-selling', swiperBestSelling);

                } else {
                    $('#table-best-selling-list-all-body').html(`<tr >
                        <td>
                            DATA NOT FOUND!
                        </td>
                    </tr>`)
                }
            },
            error: function (err) {
                console.log(err)
            }

        })

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

    function load_most_popular_product() {
        $.ajax({
            url: "<?= base_url('/api//most-clicked/product') ?>",
            type: "GET",
            success: function (resp) {

                if (resp.status) {
                    console.log(resp)
                    // $('#user_address').empty();
                    var html = ``
                    $.each(resp.data, function (index, product) {
                        if (index < 10) {
                            var truncatedDescription = truncateText(product.description, 100);
                            let product_img = product.product_img.length > 0 ? '<?= base_url('public/uploads/product_images/') ?>' + product.product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                            html += `<div class="product-wrap">
                                            <div class="product text-center">
                                                <figure class="product-media">
                                                    <a href="<?= base_url('product/details?id=') ?>${product.product_id}" onclick="increase_click_count('${product.product_id}')">
                                                        <img src="${product_img}"
                                                            alt="Product" width="300" height="338">
                                                    </a>
                                                    <div class="product-action-vertical product-action-popular">
                                                        <!-- <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a> -->
                                                        <a href="javascript:void(0)" class="btn-product-icon btn-wishlist w-icon-heart${product.is_wishlisted ? '-full' : ''}" data-product-id="${product.product_id}" onclick="wishlist('${product.product_id}')"
                                                            title="Add to wishlist"></a>
                                                        
                                                    </div>
                                                    <div class="product-label-group product-label-popular">
                                                <label class="product-label label-discount">${product.base_discount}% Off</label>
                                            </div>
                                                </figure>
                                                <div class="product-details">
                                                    <h4 class="product-name">
                                                        <a href="<?= base_url('product/details?id=') ?>${product.product_id}" class="truncated-text" style="font-weight: bold;" onclick="increase_click_count('${product.product_id}')">
                                                            ${truncateText(product.name, 20)}
                                                        </a>
                                                    </h4>
                                                    <div class="product-price">
                                                        <span class="price">
                                                            ₹${product.product_prices != "" ? product.product_prices[product.product_prices.length - 1].price : ''} - ₹${product.product_prices != "" ? product.product_prices[0].price : ''}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`
                        }
                    })
                    $('#most-popular-product').html(html);
                } else {
                    console.log("error")
                }

            },
            error: function (err) {
                console.log(err)
            },
        })
    }

    function best_selling_products() {
        $.ajax({
            url: '<?= base_url('/api/best-selling/product') ?>',
            type: "GET",
            beforeSend: function () {
            },
            success: function (resp) {
                if (resp.status) {
                    let html = ''
                    console.log('best selling', resp)
                    $.each(resp.data, function (index, item) {
                        if (item.products != null && item.products != "") {
                            $.each(item.products, function (index, product) {
                                if(index < 3){
                                    var truncatedDescription = truncateText(product.description, 100);
                                    let product_img = product.product_img.length > 0 ? '<?= base_url('public/uploads/product_images/') ?>' + product.product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                                    html += `<div class="product-wrap">
                                                    <div class="product text-center">
                                                        <figure class="product-media">
                                                            <a href="<?= base_url('product/details?id=') ?>${product.product_id}" onclick="increase_click_count('${product.product_id}')">
                                                                <img src="${product_img}"
                                                                    alt="Product" width="300" height="338">
                                                            </a>
                                                            <div class="product-action-vertical product-action-popular">
                                                                <a href="javascript:void(0)" class="btn-product-icon btn-wishlist w-icon-heart${product.is_wishlisted ? '-full' : ''}" data-product-id="${product.product_id}" onclick="wishlist('${product.product_id}')"
                                                                    title="Add to wishlist"></a>
                                                                
                                                            </div>
                                                            <div class="product-label-group product-label-popular">
                                                                <label class="product-label label-discount">${product.base_discount}% Off</label>
                                                            </div>
                                                        </figure>
                                                        <div class="product-details">
                                                            <h4 class="product-name">
                                                                <a href="<?= base_url('product/details?id=') ?>${product.product_id}" class="truncated-text" style="font-weight: bold;" onclick="increase_click_count('${product.product_id}')">
                                                                    ${truncateText(product.name, 20)}
                                                                </a>
                                                            </h4>                                                      
                                                            <div class="product-price">
                                                                <ins class="new-price">₹${product.product_prices != "" ? product.product_prices[product.product_prices.length - 1].price : ''} - ₹${product.product_prices != "" ? product.product_prices[0].price : ''}</ins>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>`
                                }
                                
                            })
                        }
                    })
                    $('#best_selling_products').html(html)

                } else {

                    $('#best_selling_products').html(`<span>Data Not Found!</span>`)
                }
            },
            error: function (err) {
                console.log(err)
            }

        })

    }




</script>