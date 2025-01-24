<!-- for product details carpousal -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> -->
<!-- <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" /> -->


<script>
    
    

    user_id = '<?= isset($_SESSION['USER_user_id']) ? $_SESSION['USER_user_id'] : '' ?>'
    let product_id = "";
    let variation_id = "";
    let c_id = "";
    let price_list = "";
    let firstMinValue = 0
    let lastMaxValue = 0
    function setActive(element, stock, tax, price) {
        // console.log(this)
        $('#product_price').html(`₹ ${price}<span id="gst">+Gst</span>`)
        if (parseInt(stock, 10) > 0) {
            document.querySelectorAll('#product_size .size').forEach(function (size) {
                size.classList.remove('active');
            });

            element.classList.add('active');
        }

    }
    function formatDate(dateString) {
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const date = new Date(dateString);
        const day = date.getDate();
        const month = months[date.getMonth()];
        const year = date.getFullYear();
        return `${day} ${month} ${year}`;
    }
    $(document).ready(function () {
        // Get the URL parameters
        const id = "<?= $_GET['id'] ?>"
        // $(".owl-carousel").owlCarousel({
        //     items: 1,
        //     loop: true,
        //     margin: 10,
        //     nav: false,
        //     dots: false,
        //     autoplay: true,
        //     autoplayTimeout: 3000
        // });


        $.ajax({
            url: "<?= base_url('/api/product') ?>",
            type: "GET",
            data: { p_id: id },
            success: function (resp) {

                if (resp.status) {
                    // console.log(resp)
                    product_id = resp.data.product_id;
                    get_all_reviews(resp.data.product_id)
                    var var_id = ""
                    c_id = resp.data.category_id;
                    get_similar_product(resp.data.category_id, product_id)
                    same_vendor_product(resp.data.vendor_id)
                    $('#product_name').text(resp.data.name)
                    $('#product_category').text(resp.data.category)
                    $('#product_tag').text(resp.data.tags)
                    var truncatedDescription = truncateText(resp.data.description, 150);
                    $('#product_description').html(truncatedDescription)
                    // Store the full description in a data attribute for later use
                    $('#product_description').data('full-description', resp.data.description);
                    $('#see_size_chart').html(`<li><span class="see_size_chart" onclick="openModal('<?= base_url() ?>public/uploads/product_size_chart/${resp.data.size_chart}')" >See size chart</span></li>`);
                    $('#saveBx').html(`<a  href="javascript:void(0)" 
                                            class="btn-product-icon btn-wishlist w-icon-heart${resp.data.is_wishlisted ? '-full' : ''}" 
                                            data-product-id="<?= $_GET['id'] ?>" 
                                            onclick="wishlist('<?= $_GET['id'] ?>')">
                                        </a>`)

                    // if (resp.data.product_stock >= 1) {
                    //     $('#product_stock').append(`<li class=""><i class="bi bi-check2-circle me-2 align-middle text-success"></i>In stock</li>`);
                    //     $('#product_add_to_cart_button').append(`<button type="button" onclick="add_to_cart()" class="btn btn-success btn-hover w-100"><i class="bi bi-basket2 me-2"></i> Add To Cart</button>`);

                    // } else {
                    //     $('#product_stock').append(`<li class="out-of-stock"><i class="bi bi-x-circle me-2 align-middle text-danger"></i>Out of stock</li>`);
                    //     $('#product_add_to_cart_button').append(`<button type="button" class="btn w-100 out_of_stock"><i class="bi bi-basket2 me-2"></i> Add To Cart</button>`);

                    // }

                    $('#quantity-section').append(`
                                                <button class="quantity-plus w-icon-plus"
                                                    onclick="quantity_increase('${resp.data.tax}')"></button>
                                                <button class="quantity-minus w-icon-minus"
                                                    onclick="quantity_decrease('${resp.data.tax}')"></button>`)

                    let html_price = ``;

                    resp.data.product_prices.sort((a, b) => parseInt(a.min_qty) - parseInt(b.min_qty));

                    if (resp.data.product_prices && resp.data.product_prices.length > 0) {
                        $('.quantity').val(resp.data.product_prices[0].min_qty)
                        firstMinValue = resp.data.product_prices[0].min_qty;
                        lastMaxValue = resp.data.product_prices[resp.data.product_prices.length - 1].max_qty;
                    }

                    // Loop through the sorted array to generate HTML

                    $.each(resp.data.product_prices, function (index, p_prices) {
                        html_price += `<div class="cart-price-item">
                        <div class="cart-quantity">
                            ${p_prices.min_qty} - ${p_prices.max_qty} Pieces
                        </div>
                        <div class="cart-price">
                            <span>₹${p_prices.price}</span>
                        </div>
                    </div>`;
                    });
                    $('#price_lists').html(html_price);


                    // var original_price = resp.data.base_discount ? (resp.data.base_price - (resp.data.base_price * (resp.data.base_discount / 100))) : resp.data.base_price;
                    var base_price = resp.data.base_discount ? resp.data.base_price : "";
                    var base_discount = resp.data.base_discount ? resp.data.base_discount : "";
                    price_list = resp.data.product_prices
                    $('#product_discount').html(resp.data.base_discount + '%')
                    $('#product_price').html('₹ ' + parseFloat(resp.data.product_prices[0].price).toFixed(2) + '<span id="gst">+Gst</span>')
                    let product_img = resp.data.product_img.length > 0 ? '<?= base_url('public/uploads/product_images/') ?>' + resp.data.product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                    $('#all_varient_img').append(`<img class="varient_img" src="${product_img}" onclick="view_image('${encodeURIComponent(JSON.stringify(resp.data.product_img))}', '${var_id = ""}', '${resp.data.product_stock}', '${encodeURIComponent(JSON.stringify(resp.data.product_sizes))}', 'main')" alt="Image 1">`);
                    
                    let html1 = ``;
                    let html2 = ``;
                    show_product_images(encodeURIComponent(JSON.stringify(resp.data.product_img)), type='public/uploads/product_images/')
                    // if (resp.data.product_img.length > 0) {
                    //     $.each(resp.data.product_img, function (index, p_img) {
                    //         html1 += `<div class="swiper-slide">
                    //                     <figure class="product-image">
                    //                         <img src="<?= base_url() ?>public/uploads/product_images/${p_img.src}" data-zoom-image="<?= base_url() ?>public/uploads/product_images/${p_img.src}" alt="Electronics Black Wrist Watch" width="800" height="900">
                    //                     </figure>
                    //                 </div>`;

                    //         html2 += `
                    //             <div class="product-thumb swiper-slide">
                    //                 <img src="<?= base_url() ?>public/uploads/product_images/${p_img.src}" alt="Product Thumb" width="800" height="900">
                    //             </div>`;
                    //     });
                    // } else {
                    //     html1 += `<div class="swiper-slide">
                    //                     <figure class="product-image">
                    //                         <img src="<?= base_url('public/assets/images/product_demo.png') ?>" data-zoom-image="<?= base_url('public/assets/images/product_demo.png') ?>" alt="Electronics Black Wrist Watch" width="800" height="900">
                    //                     </figure>
                    //                 </div>`;

                    //     html2 += `
                    //         <div class="product-thumb swiper-slide">
                    //             <img src="<?= base_url('public/assets/images/product_demo.png') ?>" alt="Product Thumb" width="800" height="900">
                    //         </div>`;
                    // }
                    // $('#main_image').html(html1);
                    // // $('#all_slider_image').html(html2);
                    // $('#sticky-product-img').attr('src', product_img);
                    // const productSingleSwiper = new Swiper('.product-single-swiper-javascript', {
                    //     navigation: {
                    //         nextEl: '.swiper-button-next',
                    //         prevEl: '.swiper-button-prev'
                    //     },
                    //     slidesPerView: 1,
                    //     spaceBetween: 10,
                    //     autoplay: {
                    //         delay: 2000, // Time in milliseconds between slides (3 seconds in this case)
                    //         disableOnInteraction: false // Slider will continue autoplay after user interaction
                    //     },
                    //     loop: true // Enables continuous looping of slides
                    // });
                    

                    // const productThumbsSwiper = new Swiper('.product-thumbs-wrap.swiper-container', {
                    //     slidesPerView: 4,
                    //     spaceBetween: 10,
                    //     navigation: {
                    //         nextEl: '.swiper-button-next',
                    //         prevEl: '.swiper-button-prev'
                    //     },
                    //     watchSlidesVisibility: true,
                    //     watchSlidesProgress: true,
                    // });
                    // let allSizes = JSON.parse(resp.data.size_list);
                    let html_size = '';
                    let isavailable = false
                    // console.log(resp.data.product_sizes);
                    $.each(resp.data.product_sizes, function (index, size) {
                        if (parseInt(size.stocks, 10) > 0) {
                            html_size += `<a href="javascript:void(0)" 
                                    class="size active-size" 
                                    data-size="${size.uid}" 
                                    style="font-weight:bold;" 
                                    onclick="setActive(this, '${size.stocks}', '${resp.data.tax}','${resp.data.product_prices ? resp.data.product_prices[0].price : 0}')">
                                        ${size.sizes}
                                    </a>`;
                            isavailable = true
                        } else {
                            html_size += `<a href="javascript:void(0)" 
                                            class="size" data-size="${size.uid}" 
                                            onclick="setActive(this, '${size.stocks}','${resp.data.tax}','${resp.data.product_prices ? resp.data.product_prices[0].price : 0}')">
                                                ${size.sizes}
                                            </a>`;
                        }
                    });
                    $('#product_size').html(html_size);
                    let qty_add_to_cart_btn = ``
                    if (isavailable) {
                        qty_add_to_cart_btn += ` <button class="btn btn-primary btn-cart" onclick="add_to_cart()">
                                                    <i class="w-icon-cart"></i>
                                                    <span>Add to Cart</span>
                                                </button>`
                    } else {
                        qty_add_to_cart_btn += ` <button class="btn btn-primary btn-cart disabled">
                                                    <i class="w-icon-cart"></i>
                                                    <span>Add to Cart</span>
                                                </button>`
                        $('#stock_msg').text('Currently out of stock.')
                    }
                    $('#product_add_to_cart_button').append(qty_add_to_cart_btn);
                } else {
                    // console.log(resp)

                }
                // console.log(resp)
            },
            error: function (err) {
                console.log(err)
            },
        })

        get_varient(id)


        // Price calculation function
        function getPriceForQuantity(quantity) {
            let price = 0;

            // Ensure the quantity is within the valid range
            if (quantity < firstMinValue || quantity > lastMaxValue) {
                return price;  // Return 0 or some other indicator that the quantity is out of bounds
            }

            // Iterate over the price list to find the applicable price for the given quantity
            for (let i = 0; i < price_list.length; i++) {
                const item = price_list[i];
                const minQty = parseInt(item.min_qty);
                const maxQty = parseInt(item.max_qty);

                // Check if the quantity falls within the current item's range
                if (quantity >= minQty && quantity <= maxQty) {
                    price = parseFloat(item.price);
                    break; // Stop checking once we've found the applicable price
                }
            }

            return price;
        }




        function truncateText(text, maxLength) {
            if (text.length > maxLength) {
                return text.substring(0, maxLength) + '... <a href="javascript:void(0);" class="link-info" id="read_more_link">Read More</a>';
            } else {
                return text;
            }
        }
        $('#product_description').on('click', '#read_more_link', function (e) {
            e.preventDefault();
            var $description = $('#product_description');
            var fullDescription = $description.data('full-description');
            if ($(this).text() === 'Read More') {
                $description.html(fullDescription + ' <a href="javascript:void(0);" id="show_less_link">Show Less</a>');
            } else {
                $description.html(truncatedDescription + ' <a href="javascript:void(0);" id="read_more_link">Read More</a>');
            }
        });
        $('#product_description').on('click', '#show_less_link', function (e) {
            e.preventDefault();
            var $description = $('#product_description');
            var truncatedDescription = truncateText($description.data('full-description'), 150); // Adjust the character count as needed

            $description.html(truncatedDescription);
        });


    })

    function check_input_field() {
        // let product_quantity = $('.quantity').val();
        // // alert(product_quantity)
        // if (product_quantity < firstMinValue) {
        //     // $('.quantity').val(firstMinValue)
        //     $('.btn-cart').addClass('disabled');
        // } else {
        //     $('.btn-cart').removeClass('disabled');
        // }
    }

    function openModal(path) {
        $('#exampleModalLong').modal('show');
        var img = document.getElementById('size_chart_img');
        img.src = path;
    }
    function closeModal() {
        $('#exampleModalLong').modal('hide');
    }
    function add_to_cart() {

        const activeSize = document.querySelector('.size.active');
        if (activeSize) {
            var product_quantity = $('.quantity').val()
            const sizeValue = activeSize.getAttribute('data-size');
            // console.log(product_quantity)
            // console.log(sizeValue)
            if (product_quantity >= firstMinValue) {
                $.ajax({
                    url: "<?= base_url('/api/user/id') ?>",
                    type: "GET",
                    success: function (resp) {
                        if (resp.status) {
                            // console.log(resp.data)
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
                                        variation_id: variation_id,
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
                    text: 'Please Enter a Valid Quantity'.toUpperCase(),
                    duration: 3000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'darkred',
                    },
                }).showToast();
            }


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

    // function quantity_increase() {
    //     console.log(price_list)
    //     let product_quantity = parseInt($('.quantity').val())

    //     console.log(typeof(product_quantity))
    //     if (product_quantity < 100) {

    //         $('.quantity').val( product_quantity + 1)
    //     }
    // }

    function getPriceForQuantity(quantity) {
        // Iterate over price_list to find the matching range for the quantity
        for (let i = 0; i < price_list.length; i++) {
            const minQty = parseInt(price_list[i].min_qty, 10);
            const maxQty = parseInt(price_list[i].max_qty, 10);

            if (quantity >= minQty && quantity <= maxQty) {
                return parseFloat(price_list[i].price);
            }
        }
        return null; // Return null if no matching range is found
    }

    function quantity_increase(tax) {
        let product_quantity = parseInt($('.quantity').val(), 10); 
        product_quantity += 1;
        const lastMaxQty = parseInt(price_list[price_list.length - 1].max_qty, 10); 

        const isInRange = price_list.some(product => {
            const min = parseInt(product.min_qty, 10);
            const max = parseInt(product.max_qty, 10);
            return product_quantity >= min && product_quantity <= max;
        });
        if (product_quantity < lastMaxQty) {
            // product_quantity += 1;
            $('.quantity').val(product_quantity);

            let currentPrice = getPriceForQuantity(product_quantity);

            if (currentPrice !== 0 && isInRange) {
                $('#product_price').html('₹ ' + currentPrice.toFixed(2) + '<span id="gst">+Gst</span>');
                $('.btn-cart').removeClass('disabled').prop('disabled', false);

            } else {
                $('#product_price').html('<span id="qwarn">Selected quantity not available</span>');
                $('.btn-cart').addClass('disabled').prop('disabled', true);

            }
        } else {
            console.log("Product quantity cannot exceed max quantity.");
        }
    }

    function quantity_decrease(tax) {
        let product_quantity = parseInt($('.quantity').val(), 10); 
        product_quantity -= 1;
        const firstMinQty = parseInt(price_list[0].min_qty, 10); 
        // console.log("First Min Quantity:", firstMinQty);
            const isInRange = price_list.some(product => {
                const min = parseInt(product.min_qty, 10);
                const max = parseInt(product.max_qty, 10);
                return product_quantity >= min && product_quantity <= max;
            });
        if (product_quantity > firstMinQty) {
            $('.quantity').val(product_quantity);

            let currentPrice = getPriceForQuantity(product_quantity);

            if (currentPrice !== null  && isInRange) {
                $('#product_price').html('₹ ' + currentPrice.toFixed(2) + '<span id="gst">+Gst</span>');
                $('.btn-cart').removeClass('disabled').prop('disabled', false);
            } else {
                $('#product_price').html('<span id="qwarn">Selected quantity not available</span>'); 
                $('.btn-cart').addClass('disabled').prop('disabled', true);
            }
        } else {
            console.log("Product quantity cannot go below min quantity.");
        }
    }

    $('.quantity').on('input', function () {
        let product_quantity = parseInt($(this).val(), 10);
            const isInRange = price_list.some(product => {
            const min = parseInt(product.min_qty, 10);
            const max = parseInt(product.max_qty, 10);
            return product_quantity >= min && product_quantity <= max;
        });
        // console.log("Is Quantity in Range:", isInRange);
        // Check if the quantity is within the valid range (min-max bounds)
        if (product_quantity < firstMinValue) {
            // product_quantity = firstMinValue;
            // $(this).val(product_quantity);
        } else if (product_quantity > lastMaxValue) {
            product_quantity = lastMaxValue; // Set to maximum allowed value
            $(this).val(product_quantity); // Update the input value
        }

        // Find the corresponding price based on the updated quantity
        let currentPrice = getPriceForQuantity(product_quantity);

        // Check if the quantity is valid (greater than 0 and exists in the price list)
        // alert(product_quantity)
        // alert(firstMinValue)
        if (currentPrice !== 0 && product_quantity >= firstMinValue && isInRange) {
            $('#product_price').html('₹ ' + currentPrice.toFixed(2) + '<span id="gst">+Gst</span>'); // Update the displayed price
            $('.btn-cart').removeClass('disabled');
            $('.btn-cart').removeClass('valid_quantity');
            const $button = $('.btn-cart');

            // Check if 'onclick' contains 'add_to_cart()'
            if (!$button.attr('onclick') || !$button.attr('onclick').includes('add_to_cart()')) {
                // Append the 'onclick' attribute if it doesn't exist
                $button.attr('onclick', 'add_to_cart()');
                console.log('onclick attribute added');
            }
        } else {
            $('#product_price').html('<span id="qwarn">Selected quantity not available</span>'); // Display message when quantity is not available
            $('.btn-cart').addClass('disabled');
            $('.btn-cart').addClass('valid_quantity');
            const $button = $('.btn-cart');
            if ($button.attr('onclick') && $button.attr('onclick').includes('add_to_cart()')) {
                // Remove the 'onclick' attribute
                $button.removeAttr('onclick');
            } 
        }
    });



    function getPriceForQuantity(quantity) {
        let price = 0;

        // Ensure the quantity is within the valid range
        if (quantity < firstMinValue || quantity > lastMaxValue) {
            return price;  // Return 0 or some other indicator that the quantity is out of bounds
        }

        // Iterate over the price list to find the applicable price for the given quantity
        for (let i = 0; i < price_list.length; i++) {
            const item = price_list[i];
            const minQty = parseInt(item.min_qty);
            const maxQty = parseInt(item.max_qty);

            // Check if the quantity falls within the current item's range
            if (quantity >= minQty && quantity <= maxQty) {
                price = parseFloat(item.price);
                break; // Stop checking once we've found the applicable price
            }
        }

        return price;
    }

    // function quantity_decrease() {
    //     console.log(price_list)
    //     let product_quantity = parseInt($('.quantity').val())
    //     if (product_quantity > 1) {
    //         $('.quantity').val(product_quantity -1)
    //     }
    // }

    function get_similar_product(c_id, product_id) {
        // alert(product_id)
        $.ajax({
            url: "<?= base_url('/api/product?c_id=') ?>" + c_id,
            type: "GET",
            success: function (resp) {
                // console.log('sim', resp)
                if (resp.status) {

                    $.each(resp.data, function (index, products) {
                        if (products.product_id != product_id) {
                            // var original_price = products.base_discount ? (products.base_price - (products.base_price * (products.base_discount / 100))).toFixed(2) : products.base_price.toFixed(2);
                            // var base_price = products.base_discount ? products.base_price : "";
                            // var base_discount = products.base_discount ? products.base_discount : "";
                            // var add_to_cart_button = ` <div class="mt-3">
                            //                                 <a href="shop-cart.html" class="btn btn-primary w-100 add-btn"><i class="mdi mdi-cart me-1"></i> Add To Cart</a>
                            //                             </div>`
                            // if (products.product_stock < 1) {
                            //     add_to_cart_button = `<span style="color:red;">Currently unavailable</span>`

                            // }
                            // var html = `<div class="col-xxl-3 col-lg-4 col-sm-6">
                            //                 <div class="card ecommerce-product-widgets border-0 rounded-0 shadow-none overflow-hidden card-animate">
                            //                     <a href="<?= base_url('product/details?id=') ?>${products.product_id}">
                            //                         <div class="bg-light bg-opacity-50 rounded py-4 position-relative">
                            //                             <img src="<?= base_url() ?>public/uploads/product_images/${products.product_img[0].src}" alt="" style="max-height: 200px;max-width: 100%;" class="mx-auto d-block rounded-2">
                            //                         </div>
                            //                     </a>
                            //                     <div class="pt-4">
                            //                         <a href="<?= base_url('product/details?id=') ?>${products.product_id}">
                            //                             <h6 class="text-capitalize fs-15 lh-base text-truncate mb-0">${products.name}</h6>
                            //                         </a>
                            //                         <div class="mt-2">
                            //                             <h5 class="mb-0">₹${original_price}</h5>
                            //                         </div>
                            //                         <div class="mt-3">
                            //                             <a href="<?= base_url('product/details?id=') ?>${products.product_id}" class="btn btn-primary w-100 add-btn"><i class="mdi mdi-cart me-1"></i> View</a>
                            //                         </div>
                            //                     </div>
                            //                 </div>
                            //             </div>`
                            let product_img = products.product_img.length > 0 ? '<?= base_url('public/uploads/product_images/') ?>' + products.product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                            var html = `<div class="product product-widget">
                                                            <figure class="product-media">
                                                                <a href="<?= base_url('product/details?id=') ?>${products.product_id}" onclick="increase_click_count('${products.product_id}')">
                                                                    <img src="${product_img}" alt="Product">
                                                                </a>
                                                            </figure>
                                                            <div class="product-details">
                                                                <h4 class="product-name">
                                                                    <a href="<?= base_url('product/details?id=') ?>${products.product_id}" onclick="increase_click_count('${products.product_id}')">${products.name}</a>
                                                                </h4>
                                                                <div class="ratings-container">
                                                                    <!-- <div class="ratings-full">
                                                                        <span class="ratings" style="width: 100%;"></span>
                                                                        <span class="tooltiptext tooltip-top"></span>
                                                                    </div> -->
                                                                </div>
                                                                <div class="product-price">₹${products.product_prices != "" ? products.product_prices[products.product_prices.length - 1].price : ''} - ₹${products.product_prices != "" ? products.product_prices[0].price : ''}</div>
                                                            </div>
                                                        </div>`
                            $('#similar_product').append(html)
                        }

                    })

                } else {
                    // console.log(resp)

                }
                // console.log(resp)
            },
            error: function (err) {
                console.log(err)
            },
        })
    }

    function get_varient(id) {
        $.ajax({
            url: "<?= base_url('/api/product/variant?p_id=') ?>" + id,
            type: "GET",
            success: function (resp) {
                // console.log('var', resp)
                if (resp.status) {

                    // var html_size = ``
                    var html_color = ``
                    var html_img = ``
                    $.each(resp.data, function (index, variation) {
                        var checked_item = ''
                        if (index == 0) {
                            checked_item = 'checked=""'
                        }
                        // console.log(variation)
                        // html_size += `<li> 
                        //                     <input type="radio" ${checked_item} name="sizes7" id="product-color-${72 + index}" value=" ${variation.size}"> 
                        //                     <label 
                        //                         class="avatar-xs btn btn-soft-primary text-uppercase p-0 fs-12 d-flex align-items-center justify-content-center rounded-circle" 
                        //                         for="product-color-${72 + index}">
                        //                         ${variation.size}
                        //                     </label> 
                        //                 </li>`
                        // html_color += `<li>
                        //                 <input type="radio" ${checked_item} name="sizes" id="product-color-2" value="${variation.color}">
                        //                 <label class="avatar-xs btn p-0 d-flex align-items-center justify-content-center rounded-circle" style="background-color:${variation.color}" for="product-color-2"></label>
                        //             </li>`
                        html_img += `<img class="varient_img ml-2"
                                        src="<?= base_url() ?>/public/uploads/variant_images/${variation.product_img[0].src}"
                                        onclick="view_image('${encodeURIComponent(JSON.stringify(variation.product_img))}', '${variation.uid}', '${variation.stock}','${encodeURIComponent(JSON.stringify(variation.product_sizes))}', 'varient')" alt="Image 1"> 
                                        `
                    })
                    // onclick="view_image('/public/uploads/variant_images/${variation.product_img[0].src}', '${variation.uid}', '${variation.stock}','${encodeURIComponent(JSON.stringify(variation.product_sizes))}', 'varient')" alt="Image 1">
                    // $('#product_size').html(html_size)
                    // $('#product_color').html(html_color)
                    $('#all_varient_img').append(html_img)

                } else {
                    console.log(resp)

                }

            },
            error: function (err) {
                console.log(err)
            },
        })
    }

    function view_image(product_img, var_id, stock, sizes, type) {
        var html = ``;
        variation_id = var_id;

        sizes = JSON.parse(decodeURIComponent(sizes));
        let html_size = '';
        let isavailable = false
        $.each(sizes, function (index, size) {
            if (parseInt(size.stocks, 10) > 0) {
                html_size += `<a href="javascript:void(0)" class="size active-size" data-size="${size.uid}" style="font-weight:bold;" onclick="setActive(this, '${size.stocks}')">${size.sizes}</a>`;
                isavailable = true
            } else {
                html_size += `<a href="javascript:void(0)" class="size" data-size="${size.uid}" onclick="setActive(this, '${size.stocks}')">${size.sizes}</a>`;
            }

        });
        $('#product_size').html(html_size);
        let qty_add_to_cart_btn = ``

        let html1 = ``;
        let html2 = ``;
        let sticky_product_img = '<?= base_url('public/assets/images/product_demo.png') ?>'
        if (type === 'varient') {
            show_product_images(product_img, type='/public/uploads/variant_images/')
            // html = `<div class="carousel-item active">
            //             <img class="d-block w-100 fixed-size-image" src="<?= base_url() ?>${product_img}" alt="" style="width: 300px;">
            //         </div>`;
            // html1 += `<div class="swiper-slide">
            //                 <figure class="product-image">
            //                     <img src="<?= base_url() ?>${product_img}" data-zoom-image="<?= base_url() ?>${product_img}" alt="Electronics Black Wrist Watch" width="800" height="900">
            //                 </figure>
            //             </div>`
            // html2 += `<div class="product-thumb swiper-slide">
            //             <img src="<?= base_url() ?>${product_img}" alt="Product Thumb" width="800" height="900">
            //         </div>`
            // sticky_product_img = '<?= base_url() ?>' + product_img

        } else if (type === 'main') {
            show_product_images(product_img, type='public/uploads/product_images/')
        //     product_img = JSON.parse(decodeURIComponent(product_img));
        //     // console.log('img', product_img)
        //     if (product_img.length > 0) {
        //         $.each(product_img, function (index, p_img) {
        //             html1 += `<div class="swiper-slide">
        //                         <figure class="product-image">
        //                             <img src="<?= base_url() ?>public/uploads/product_images/${p_img.src}" data-zoom-image="<?= base_url() ?>public/uploads/product_images/${p_img.src}" alt="Electronics Black Wrist Watch" width="800" height="900">
        //                         </figure>
        //                     </div>`;

        //             html2 += `
        //                 <div class="product-thumb swiper-slide">
        //                     <img src="<?= base_url() ?>public/uploads/product_images/${p_img.src}" alt="Product Thumb" width="800" height="900">
        //                 </div>`;
        //         });
        //         sticky_product_img = '<?= base_url() ?>public/uploads/product_images/' + product_img[0].src
        //     } else {
        //         html1 += `<div class="swiper-slide">
        //                                 <figure class="product-image">
        //                                     <img src="<?= base_url('public/assets/images/product_demo.png') ?>" data-zoom-image="<?= base_url('public/assets/images/product_demo.png') ?>" alt="Electronics Black Wrist Watch" width="800" height="900">
        //                                 </figure>
        //                             </div>`;

        //         html2 += `
        //             <div class="product-thumb swiper-slide">
        //                 <img src="<?= base_url('public/assets/images/product_demo.png') ?>" alt="Product Thumb" width="800" height="900">
        //             </div>`;
        //     }


        }
        // $('#main_image').html(html1);
        // // $('#all_slider_image').html(html2);
        // $('#sticky-product-img').attr('src', sticky_product_img);
        // const productSingleSwiper = new Swiper('.product-single-swiper-javascript', {
        //                 navigation: {
        //                     nextEl: '.swiper-button-next',
        //                     prevEl: '.swiper-button-prev'
        //                 },
        //                 slidesPerView: 1,
        //                 spaceBetween: 10,
        //                 autoplay: {
        //                     delay: 2000, // Time in milliseconds between slides (3 seconds in this case)
        //                     disableOnInteraction: false // Slider will continue autoplay after user interaction
        //                 },
        //                 loop: true // Enables continuous looping of slides
        //             });
                    
        // const productSingleSwiper = new Swiper('.product-single-swiper', {
        //     navigation: {
        //         nextEl: '.swiper-button-next',
        //         prevEl: '.swiper-button-prev'
        //     },
        //     slidesPerView: 1,
        //     spaceBetween: 10,
        // });

        // const productThumbsSwiper = new Swiper('.product-thumbs-wrap.swiper-container', {
        //     slidesPerView: 4,
        //     spaceBetween: 10,
        //     navigation: {
        //         nextEl: '.swiper-button-next',
        //         prevEl: '.swiper-button-prev'
        //     },
        //     watchSlidesVisibility: true,
        //     watchSlidesProgress: true,
        // });
    }

    function show_product_images(product_img, type){

        product_img = JSON.parse(decodeURIComponent(product_img));
            // console.log('img', product_img)
            let html1 = ``;
            let html2 = ``;
            if (product_img.length > 0) {
                $.each(product_img, function (index, p_img) {
                    html1 += `<div class="swiper-slide">
                                <figure class="product-image">
                                    <img src="<?= base_url() ?>${type}${p_img.src}" data-zoom-image="<?= base_url() ?>public/uploads/product_images/${p_img.src}" alt="Electronics Black Wrist Watch" width="800" height="900">
                                </figure>
                            </div>`;

                    html2 += `
                        <div class="product-thumb swiper-slide">
                            <img src="<?= base_url() ?>${type}${p_img.src}" alt="Product Thumb" width="800" height="900">
                        </div>`;
                });
                sticky_product_img = '<?= base_url() ?>'+type+ product_img[0].src
            } else {
                html1 += `<div class="swiper-slide">
                                        <figure class="product-image">
                                            <img src="<?= base_url('public/assets/images/product_demo.png') ?>" data-zoom-image="<?= base_url('public/assets/images/product_demo.png') ?>" alt="Electronics Black Wrist Watch" width="800" height="900">
                                        </figure>
                                    </div>`;

                html2 += `
                    <div class="product-thumb swiper-slide">
                        <img src="<?= base_url('public/assets/images/product_demo.png') ?>" alt="Product Thumb" width="800" height="900">
                    </div>`;
                    sticky_product_img = "<?= base_url('public/assets/images/product_demo.png') ?>"
            }
            $('#main_image').empty();
        $('#main_image').html(html1);
        // $('#all_slider_image').html(html2);
        $('#sticky-product-img').attr('src', sticky_product_img);
        // productSingleSwiper.destroy(true, true);
        const productSingleSwiper = new Swiper('.product-single-swiper-javascript', {
            navigation: {
                nextEl: '.button-next-main',
                prevEl: '.button-prev-main'
            },
            slidesPerView: 1,
            spaceBetween: 10,
            autoplay: {
                delay: 2000, // Time in milliseconds between slides (3 seconds in this case)
                disableOnInteraction: false // Slider will continue autoplay after user interaction
            },
            loop: true // Enables continuous looping of slides
        });
                    
        // const productSingleSwiper = new Swiper('.product-single-swiper', {
        //     navigation: {
        //         nextEl: '.swiper-button-next',
        //         prevEl: '.swiper-button-prev'
        //     },
        //     slidesPerView: 1,
        //     spaceBetween: 10,
        // });

        // const productThumbsSwiper = new Swiper('.product-thumbs-wrap.swiper-container', {
        //     slidesPerView: 4,
        //     spaceBetween: 10,
        //     navigation: {
        //         nextEl: '.button-next-sub',
        //         prevEl: '.button-prev-sub'
        //     },
        //     watchSlidesVisibility: true,
        //     watchSlidesProgress: true,
        // });
    }

    function same_vendor_product(v_id) {
        // alert(product_id)
        $.ajax({
            // url: "<?= base_url('/api/product?v_id=') ?>" + v_id,
            url: "<?= base_url('/api/product') ?>",
            type: "GET",
            data: { vendor_id: v_id },
            success: function (resp) {

                // console.log('vendor', resp)
                if (resp.status) {
                    $.each(resp.data, function (index, products) {
                        // console.log('vendor', products)
                        if (products.product_id != product_id) {
                            let product_img = products.product_img.length > 0 ? '<?= base_url('public/uploads/product_images/') ?>' + products.product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                            var html = `<div class="swiper-slide product">
                                            <figure class="product-media">
                                                <a href="<?= base_url('product/details?id=') ?>${products.product_id}" class="product-media-img-bx">
                                                    <img src="${product_img}" alt="Product" width="300" height="338">
                                                </a>
                                                <div class="product-action-vertical product-action-similar-vendor">
                                                    <!-- <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a> -->
                                                    <a href="javascript:void(0)" class="btn-product-icon btn-wishlist w-icon-heart${products.is_wishlisted ? '-full' : ''}" data-product-id="${products.product_id}" title="Add to wishlist" onclick="wishlist('${products.product_id}')"></a>
                                                   
                                                </div>
                                                <!-- <div class="product-action-x">
                                                    <a href="<?= base_url('product/details?id=') ?>${products.product_id}" onclick="increase_click_count('${products.product_id}')" class="btn-product" title="Quick View">
                                                        View More</a> 
                                                </div> -->
                                            </figure>
                                            <div class="product-details">
                                                <div class="product-cat"><a href="shop-banner-sidebar.html">${products.category}</a>
                                                </div>
                                                <h4 class="product-name"><a href="<?= base_url('product/details?id=') ?>${products.product_id}" onclick="increase_click_count('${products.product_id}')">${products.name}</a>
                                                </h4>
                                                <!-- <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 100%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <a href="product-details.html" class="rating-reviews">(3 reviews)</a>
                                                </div> -->
                                                <div class="product-pa-wrapper">
                                                    <div class="product-price">₹${products.product_prices != "" ? products.product_prices[products.product_prices.length - 1].price : ''} - ₹${products.product_prices != "" ? products.product_prices[0].price : ''}</div>
                                                </div>
                                            </div>
                                        </div>`
                            // var html = `<div class="swiper-slide product">
                            //                 <figure class="product-media">
                            //                     <a href="product-details.html">
                            //                         <img src="${product_img}" alt="Product" width="300" height="338">
                            //                         <img src="${product_img}" alt="Product" width="300" height="338">
                            //                     </a>
                            //                     <div class="product-action-vertical">
                            //                         <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                            //                         <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                            //                         <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Add to Compare"></a> -->
                            //                     </div>
                            //                     <div class="product-action">
                            //                         <a href="#" class="btn-product btn-quickview" title="Quick View">Quick
                            //                             View</a>
                            //                     </div>
                            //                 </figure>
                            //                 <div class="product-details">
                            //                     <div class="product-cat"><a href="shop-banner-sidebar.html">Accessories</a>
                            //                     </div>
                            //                     <h4 class="product-name"><a href="product-details.html">Sticky Pencil</a>
                            //                     </h4>
                            //                     <div class="ratings-container">
                            //                         <div class="ratings-full">
                            //                             <span class="ratings" style="width: 100%;"></span>
                            //                             <span class="tooltiptext tooltip-top"></span>
                            //                         </div>
                            //                         <a href="product-details.html" class="rating-reviews">(3 reviews)</a>
                            //                     </div>
                            //                     <div class="product-pa-wrapper">
                            //                         <div class="product-price">$20.00</div>
                            //                     </div>
                            //                 </div>
                            //             </div>`
                            $('#same_vendor_product').append(html)
                            const swiperContainer = document.querySelector('.swiper-container-vendor');

                            const swiperOptions = {
                                navigation: {
                                    nextEl: '.swiper-button-next',
                                    prevEl: '.swiper-button-prev'
                                },
                                spaceBetween: 20,
                                slidesPerView: 4,
                                breakpoints: {
                                    576: {
                                        slidesPerView: 3.3
                                    },
                                    768: {
                                        slidesPerView: 4
                                    },
                                    992: {
                                        slidesPerView: 3.3
                                    }
                                }
                            };

                            // // Initialize Swiper with the options
                            const mySwiper = new Swiper(swiperContainer, swiperOptions);
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

    function clearReviewForm() {
        const ratingInputs = document.querySelectorAll('input[name="rating"]');
        ratingInputs.forEach(input => input.checked = false);

        // Clear the review content
        document.getElementById('reviewContent').value = '';
    }

    function submit_review() {
        var formData = new FormData();

        const radios = document.getElementsByName('rating');
        let checkedValue = '';
        for (const radio of radios) {
            if (radio.checked) {
                checkedValue = radio.value;
                break;
            }
        }

        formData.append('rateing', checkedValue);
        formData.append('review', $('#reviewContent').val());
        formData.append('productId', product_id);
        formData.append('userId', user_id);

        $.ajax({
            url: "<?= base_url('/api/add/review') ?>",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#review_add_btn').html(`<div class="spinner-border" role="status"></div>`)
                $('#review_add_btn').attr('disabled', true)

            },
            success: function (resp) {
                let html = ''

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
                    clearReviewForm()
                    get_all_reviews(product_id)
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
                console.log(resp)
            },
            error: function (err) {
                console.log(err)
            },
            complete: function () {
                $('#review_add_btn').html(`Submit Review`)
                $('#review_add_btn').attr('disabled', false)
            }
        })
    }

    function get_all_reviews(p_id) {
        $.ajax({
            url: "<?= base_url('/api/users/review') ?>",
            type: "GET",
            data: { p_id: p_id },
            success: function (resp) {
                console.log('review', resp)
                if (resp.status) {

                    let html1 = `<h2>Customer Reviews</h2>`
                    let total_review = resp.data.length
                    let total_rateing = 0
                    let total_1star = 0
                    let total_2star = 0
                    let total_3star = 0
                    let total_4star = 0
                    let total_5star = 0
                    $.each(resp.data, function (index, review) {
                        total_rateing += parseInt(review.rateing, 10)
                        var html = ``
                        if (review.rateing == '1') {
                            total_1star += 1
                            html += `<div class="rating">⭐</div>`
                        } else if (review.rateing == '2') {
                            total_2star += 1
                            html += `<div class="rating">⭐⭐</div>`
                        } else if (review.rateing == '3') {
                            total_3star += 1
                            html += `<div class="rating">⭐⭐⭐</div>`
                        } else if (review.rateing == '4') {
                            total_4star += 1
                            html += `<div class="rating">⭐⭐⭐⭐</div>`
                        } else if (review.rateing == '5') {
                            total_5star += 1
                            html += `<div class="rating">⭐⭐⭐⭐⭐</div>`
                        }
                        // html1 += `<div class="review">
                        //                 ${html}
                        //             <div class="user">${review.user_name}</div>
                        //             <div class="comment">${review.review}</div>
                        //         </div>`
                        html1 += `<li class="comment">
                                    <div class="comment-body">
                                        <figure class="comment-avatar">
                                            <img src="<?= base_url() ?>public/assets/images/demo_profile_img.png" alt="Commenter Avatar" width="90" height="90">
                                        </figure>
                                        <div class="comment-content">
                                            <h4 class="comment-author">
                                                <a href="#">${review.user_name}</a>
                                                <span class="comment-date">${formatDate(review.created_at)}</span>
                                            </h4>
                                            <div class="ratings-container comment-rating">
                                                
                                                ${html}
                                            </div>
                                            <p>${review.review}</p>
                                        </div>
                                    </div>
                                </li>`

                    })
                    $('#list_of_reviews').html(html1)
                    console.log('5star', total_5star)
                    console.log(total_rateing)
                    $('#overall_5star').html(`<span style="width: ${(total_5star / total_review) * 100}% !important;"></span>`)
                    $('#5star_parcent').html(`${(total_5star / total_review * 100).toFixed(1)}%`)
                    $('#overall_4star').html(`<span style="width: ${(total_4star / total_review) * 100}% !important;"></span>`)
                    $('#4star_parcent').html(`${(total_4star / total_review * 100).toFixed(1)}%`)
                    $('#overall_3star').html(`<span style="width: ${(total_3star / total_review) * 100}% !important;"></span>`)
                    $('#3star_parcent').html(`${(total_3star / total_review * 100).toFixed(1)}%`)
                    $('#overall_2star').html(`<span style="width: ${(total_2star / total_review) * 100}% !important;"></span>`)
                    $('#2star_parcent').html(`${(total_2star / total_review * 100).toFixed(1)}%`)
                    $('#overall_1star').html(`<span style="width: ${(total_1star / total_review) * 100}% !important;"></span>`)
                    $('#1star_parcent').html(`${(total_1star / total_review * 100).toFixed(1)}%`)

                    $('#overall_rateing').text((total_rateing / total_review).toFixed(1))
                    $('#total_rateing').html(`(${total_review} Reviews)`)
                    $('#no_of_review').html(`(${total_review} Reviews)`)
                    $('#product_rating').html(`<span class="ratings" style="width: ${(total_rateing / total_review) / 5 * 100}%;"></span><span class="tooltiptext tooltip-top"></span>`)

                } else {
                    console.log(resp)

                }
                // console.log(resp)
            },
            error: function (err) {
                console.log(err)
            },
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

                    // setTimeout(function(){
                    //     get_user();
                    // },100)

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