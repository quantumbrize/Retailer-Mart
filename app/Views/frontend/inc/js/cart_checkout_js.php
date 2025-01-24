<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    user_id = '<?= isset($_SESSION['USER_user_id']) ? $_SESSION['USER_user_id'] : '' ?>'


    if (user_id != '') {
        get_user();
        get_cart();
    }



    $("#update_profile").click(function () {
        // alert("billing")
        var name = $("#billinginfo-name").val()
        var number = $("#billinginfo-phone").val()
        var email = $("#billinginfo-email").val()

        var city = $("#billinginfo-city").val()
        var country = $("#billinginfo-country").val()
        var zip = $("#billinginfo-zip").val()
        var district = $("#billinginfo-district").val()
        var state = $("#billinginfo-state").val()
        var locality = $("#billinginfo-locality").val()
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (name == "") {
            $("#name_val").text("Please enter name!")
        } else {
            $("#name_val").text("")
        }
        if (email == "") {
            $("#email_val").text("Please enter email!")
        } else if(!emailRegex.test(email)){
            $("#email_val").text("Please enter valid email!")
        } else {
            $("#email_val").text("")
        }
        if (number == "") {
            $("#number_val").text("Please enter number!")
        } else if(number.length < 10){
            $("#number_val").text("Please enter valid number!")
        } else {
            $("#number_val").text("")
        }
        if (city == "") {
            $("#city_val").text("Please enter city!")
        } else {
            $("#city_val").text("")
        }
        if (country == "") {
            $("#country_val").text("Please enter country!")
        } else {
            $("#country_val").text("")
        }
        if (zip == "") {
            $("#zip_val").text("Please enter postal code!")
        } else if (zip.length < 6) {
            $("#zip_val").text("Please enter valid postal code!")
        } else {
            $("#zip_val").text("")
        }
        if (district == "") {
            $("#district_val").text("Please enter street address!")
        } else {
            $("#district_val").text("")
        }
        if (state == "") {
            $("#state_val").text("Please enter state!")
        } else {
            $("#state_val").text("")
        }
        if (locality == "") {
            $("#locality_val").text("Please enter landmark!")
        } else {
            $("#locality_val").text("")
        }

        if (name != "" && number != "" && email != "" && city != "" && country != "" && zip != "" && district != "" && state != "" && locality != "" && emailRegex.test(email) && number.length == 10 && zip.length == 6) {
            // alert("hello")
            var formData = new FormData();

            formData.append('name', name);
            formData.append('number', number);
            formData.append('email', email);
            formData.append('city', city);
            formData.append('country', country);
            formData.append('zip', zip);
            formData.append('district', district);
            formData.append('state', state);
            formData.append('locality', locality);
            formData.append('user_id', user_id);
            $.ajax({
                url: "<?= base_url('/api/user/update') ?>",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#update_profile').html(`<div class="spinner-border" role="status"></div>`)
                    $('#update_profile').attr('disabled', true)

                },
                success: function (resp) {
                    console.log(resp)

                    if (resp.status) {
                        // window.location.href = "<?= base_url('/user/account') ?>";
                        Toastify({
                            text: resp.message.toUpperCase(),
                            duration: 3000,
                            position: "center",
                            stopOnFocus: true,
                            style: {
                                background: resp.status ? 'darkgreen' : 'darkred',
                            },

                        }).showToast();
                        get_user();
                    } else {
                        console.log(resp.status)
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


                    $('#alert').html(html)
                    console.log(resp)
                },
                error: function (err) {
                    console.log(err)
                },
                complete: function () {
                    $('#update_profile').html(`Update`)
                    $('#update_profile').attr('disabled', false)
                }
            })
        }
    });

    $("#update_bussness_address").click(function () {
        // alert("bussiness")
        var name = $("#businessinfo-name").val()
        var number = $("#businessinfo-phone").val()
        var email = $("#businessinfo-email").val()
        var gst = $("#businessinfo-gst").val()
        var address = $("#businessinfo-address").val()
        var zip = $("#businessinfo-zip").val()
        var landmark = $("#businessinfo-landmark").val()
        var goodsname = $("#businessinfo-goodsname").val()
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const gstRegex = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[A-Z0-9]{1}Z[A-Z0-9]{1}$/;

        if (name == "") {
            $("#business_name_val").text("Please enter business name!")
        } else {
            $("#business_name_val").text("")
        }
        if (email == "") {
            $("#business_email_val").text("Please enter business email!")
        } else if(!emailRegex.test(email)){
            $("#business_email_val").text("Please enter valid email!")
        } else {
            $("#business_email_val").text("")
        }
        if (number == "") {
            $("#business_phone_val").text("Please enter business phone!")
        } else if(number.length < 10){
            $("#business_phone_val").text("Please enter valid number!")
        } else {
            $("#business_phone_val").text("")
        }
        if (gst == "") {
            $("#business_gst_val").text("Please enter GST number!")
        } else if (!gstRegex.test(gst)) {
            $("#business_gst_val").text("Please enter valid GST number!")
        } else {
            $("#business_gst_val").text("")
        }
        if (address == "") {
            $("#business_address_val").text("Please enter business address!")
        } else {
            $("#business_address_val").text("")
        }
        if (zip == "") {
            $("#business_zip_val").text("Please enter postal code!")
        } else if (zip.length < 6) {
            $("#business_zip_val").text("Please enter valid zip code!")
        } else {
            $("#business_zip_val").text("")
        }
        if (landmark == "") {
            $("#business_landmark_val").text("Please enter landmark!")
        } else {
            $("#business_landmark_val").text("")
        }
        if (goodsname == "") {
            $("#business_goodsname_val").text("Please enter goods name!")
        } else {
            $("#business_goodsname_val").text("")
        }

        if (name != "" && number != "" && email != "" && address != "" && zip != "" && landmark != "" && goodsname != "" && emailRegex.test(email) && number.length == 10 && zip.length == 6 && gstRegex.test(gst)) {
            var formData = new FormData();

            formData.append('name', name);
            formData.append('number', number);
            formData.append('email', email);
            formData.append('gst', gst);
            formData.append('address', address);
            formData.append('zip', zip);
            formData.append('landmark', landmark);
            formData.append('goodsname', goodsname);
            formData.append('user_id', user_id);

            $.ajax({
                url: "<?= base_url('/api/business/update') ?>",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#update_bussness_address').html(`<div class="spinner-border" role="status"></div>`)
                    $('#update_bussness_address').attr('disabled', true)
                },
                success: function (resp) {
                    console.log(resp)

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
                complete: function () {
                    $('#update_bussness_address').html(`Update`)
                    $('#update_bussness_address').attr('disabled', false)
                }
            })
        }
    });

    let user_data = {};
    let user_cart = {};
    let payment_data = { method: 'cod' }

    // $('#place_order_btn').on('click', function () {

    //     user_data.name = $('#billinginfo-name').val()
    //     user_data.email = $('#billinginfo-email').val()
    //     user_data.number = $('#billinginfo-phone').val()
    //     $.ajax({
    //         url: '<?= base_url('/api/order/confirm') ?>',
    //         type: "POST",
    //         contentType: 'application/json',
    //         data: JSON.stringify({
    //             user_data: user_data,
    //             user_cart: user_cart,
    //             payment_data: payment_data
    //         }),
    //         beforeSend: function () {
    //             $('#place_order_btn').prop('disabled', true);
    //         },
    //         success: function (resp) {
    //             console.log(resp)
    //             if (resp.status) {
    //                 let order_id = resp.data.order_id
    //                 Toastify({
    //                     text: resp.message.toUpperCase(),
    //                     duration: 3000,
    //                     position: "center",
    //                     stopOnFocus: true,
    //                     style: {
    //                         background: resp.status ? 'darkgreen' : 'darkred',
    //                     },
    //                 }).showToast();
    //                 // Redirect after 2 seconds
    //                 setTimeout(function () {
    //                     window.location.href = `<?= base_url('/order/success?o_id=') ?>${order_id}`;
    //                 }, 2000);
    //                 $('#place_order_btn').prop('disabled', true);

    //             } else {
    //                 Toastify({
    //                     text: resp.message.toUpperCase(),
    //                     duration: 3000,
    //                     position: "center",
    //                     stopOnFocus: true,
    //                     style: {
    //                         background: resp.status ? 'darkgreen' : 'darkred',
    //                     },
    //                 }).showToast();
    //                 $('#place_order_btn').prop('disabled', false);
    //             }
    //         },
    //         error: function (err) {
    //             console.error(err)
    //         }
    //     })
    // })




    $('#pills-bill-info-tab').on('click', function () {
        $('#pills-bill-address-tab').removeClass('done')
    })
    $('#pills-bill-address-tab').on('click', function () {
        $('#pills-bill-info-tab').addClass('done')
        $('#pills-bill-address-tab').addClass('active')
    })

    $('#pills-payment-tab').on('click', function () {
        $('#pills-bill-info-tab').addClass('done')
        $('#pills-bill-address-tab').addClass('done')
        $('#pills-payment-tab').addClass('active')
    })



    $('#personal_info_btn').on('click', function () {
        $('#pills-bill-info-tab').addClass('done')
        $('#pills-bill-info-tab').removeClass('active')
        $('#pills-bill-info').removeClass('active')
        $('#pills-bill-info').removeClass('show')

        $('#pills-bill-address').addClass('active')
        $('#pills-bill-address').addClass('show')
        $('#pills-bill-address-tab').addClass('active')
    })

    $('#payment_info_btn').on('click', function () {
        $('#pills-bill-address-tab').addClass('done')
        $('#pills-bill-address-tab').removeClass('active')
        $('#pills-bill-address').removeClass('active')
        $('#pills-bill-address').removeClass('show')

        $('#pills-payment').addClass('active')
        $('#pills-payment').addClass('show')
        $('#pills-payment-tab').addClass('active')
    })


    // function get_cart() {


    //     $.ajax({
    //         url: '<?= base_url('/api/user/cart') ?>',
    //         type: "GET",
    //         data: {
    //             'user_id': user_id
    //         },
    //         beforeSend: function () { },
    //         success: function (resp) {
    //             let subTotal = 0
    //             let discountPercentage = 0
    //             let total = 0
    //             let discount_amount = 0
    //             console.log(resp)
    //             if (resp.status) {
    //                 let html = ``
    //                 user_cart.cart = resp.data
    //                 let total_discount = 0
    //                 $.each(resp.data, function (index, item) {
    //                     subTotal += calculateFinalPrice(item.product.base_price, item.product.base_discount) * item.qty
    //                     html += ` <tr>
    //                                     <td>
    //                                         <div class="avatar-md bg-light rounded p-1">
    //                                             <img 
    //                                                 src="<?= base_url() ?>${item.img_url}${item.product.product_img[0].src}" 
    //                                                 alt=""
    //                                                 class="img-fluid d-block">
    //                                         </div>
    //                                     </td>
    //                                     <td>
    //                                         <h5 class="fs-14"><a href="<?= base_url('/product/details?id=') ?>${item.product.product_id}"
    //                                                 class="text-body">${item.product.name}</a></h5>
    //                                         <p class="text-muted mb-0">₹${calculateFinalPrice(item.product.base_price, item.product.base_discount).toFixed(2)} x ${item.qty}</p>
    //                                     </td>
    //                                     <td>

    //                                         <p class="text-muted mb-0">${item.size}</p>
    //                                     </td>
    //                                     <td class="text-end">₹${(calculateFinalPrice(item.product.base_price, item.product.base_discount) * item.qty).toFixed(2)}</td>
    //                                 </tr>`

    //                                 total_discount += parseInt(item.product.base_discount, 10);
    //                 })

    //                 $.ajax({
    //                     url: '<?= base_url('/api/discounts') ?>',
    //                     type: 'GET',
    //                     beforeSend: function () { },
    //                     success: function (resp) {
    //                         let discount = [];
    //                         if (resp.status) {
    //                             discounts = resp.data
    //                             let disc = []
    //                             if (discounts.length > 0) {
    //                                 $.each(discounts, function (index, item) {
    //                                     if (item.minimum_purchase <= subTotal) {
    //                                         disc[index] = item
    //                                     }
    //                                 })
    //                             }
    //                             discount = disc[disc.length - 1]
    //                         } else {
    //                             discount = null
    //                         }
    //                         discount = discount != null ? discount : { "discount_percentage": 0, "minimum_purchase": 0 }
    //                         discountPercentage = discount.discount_percentage
    //                         discount_amount = get_discounts_amount(subTotal, discount.discount_percentage).toFixed(2)
    //                         total = (subTotal - discount_amount).toFixed(2);

    //                         user_cart.total = total
    //                         user_cart.discountPercentage = discountPercentage
    //                         user_cart.discountAmount = discount_amount
    //                         user_cart.subTotal = subTotal
    //                         html += ` <tr>
    //                                 <td class="fw-semibold" colspan="3">Sub Total :</td>
    //                                 <td class="fw-semibold fs-14 text-end">₹${subTotal.toFixed(2)}</td>
    //                             </tr>
    //                             <tr>
    //                                 <td colspan="3">Discount : </td>
    //                                 <td class="text-end fs-14">${total_discount}%</td>
    //                             </tr>
    //                             <tr>
    //                                 <td colspan="3">Shipping Charge :</td>
    //                                 <td class="text-end fs-14">free</td>
    //                             </tr>
    //                             <tr class="table-active">
    //                                 <th colspan="3">Total (INR) :</th>
    //                                 <td class="text-end">
    //                                     <span class="fw-semibold fs-14">
    //                                         ₹${total}
    //                                     </span>
    //                                 </td>
    //                             </tr>`
    //                         $('#product_con').html(html)
    //                     },
    //                     error: function (err) {
    //                         console.log(err)
    //                     }
    //                 })
    //             }

    //         },
    //         error: function (err) {
    //             console.error(err)
    //         }
    //     })
    // }

    function get_cart() {
        $.ajax({
            url: '<?= base_url('/api/user/cart') ?>',
            type: "GET",
            data: {
                user_id: user_id
            },
            beforeSend: function () {


            },
            success: function (resp) {
                // alert('hello')
                console.log('cart', resp)
                if (resp.status) {
                    let html = ``
                    let subTotal = 0
                    let delivery_charge = 0
                    user_cart.cart = resp.data
                    $.each(resp.data, function (index, item) {
                        let actual_price = ''
                        subTotal += item.product.base_price * item.qty
                        $.each(item.product.product_prices, function (index, prices) {
                            if (parseInt(item.qty) >= parseInt(prices.min_qty) && parseInt(item.qty) <= parseInt(prices.max_qty)) {
                                actual_price = prices.price
                                // subTotal += parseInt(actual_price) * parseInt(item.qty)
                            }

                        })
                        let qty = item.qty; // Quantity of the product
                        let base_discount = parseInt(item.product.base_discount); // Discount percentage
                        let tax = parseInt(item.product.tax); // Tax percentage
                        let discounted_price = actual_price * qty - ((actual_price * qty) * base_discount / 100);
                        let tax_amount = discounted_price * tax / 100;
                        let final_price = discounted_price + tax_amount;
                        subTotal += final_price
                        delivery_charge += parseInt(item.product.delivery_charge)
                        console.log(actual_price)
                        html += `<tr class="bb-no">
                                    <td class="product-name">${item.product.name} <i class="fas fa-times"></i> <span class="product-quantity" readonly>${item.qty}</span></td>
                                    <td class="product-total">₹${final_price.toFixed(2)}</td>
                                </tr>`
                    })
                    html += `<tr class="cart-subtotal bb-no">
                                <td>
                                    <b>Subtotal</b>
                                </td>
                                <td>
                                    <b>₹${subTotal.toFixed(2)}</b>
                                </td>
                            </tr>`
                    $('#cart_item').html(html)
                    $('.subtotal_amount').html(`₹` + subTotal.toFixed(2))
                    $('#delivary_charge').html(`₹` + delivery_charge);
                    let grand_total = subTotal + delivery_charge
                    user_cart.total = grand_total
                    user_cart.subTotal = subTotal
                    $('#grand_total').html(`₹` + grand_total.toFixed(2))
                    // $.ajax({
                    //     url: "<?= base_url('/api/taxes') ?>",
                    //     type: "GET",
                    //     success: function (response) {
                    //         if (response.status) {
                    //             console.log(response);
                    //             if (response.data.gst != '0' && response.data.gst != null && response.data.gst != "") {
                    //                 $('#gst_fee').html(`₹` + response.data.gst);
                    //                 grand_total += parseInt(response.data.gst, 10);
                    //             } else {
                    //                 $('#gst_fee').html(`<p style="color: green;">Free</p>`);
                    //             }
                    //             if (response.data.tax != '0' && response.data.tax != null && response.data.tax != "") {
                    //                 $('#tax_fee').html(`₹` + response.data.tax);
                    //                 grand_total += parseInt(response.data.tax, 10);
                    //             } else {
                    //                 $('#tax_fee').html(`<p style="color: green;">Free</p>`);
                    //             }

                    //             if (response.data.delivary_charge != '0' && response.data.delivary_charge != null && response.data.delivary_charge != "") {
                    //                 $('#delivary_charge').html(`₹` + response.data.delivary_charge);
                    //                 grand_total += parseInt(response.data.delivary_charge, 10);
                    //             } else {
                    //                 $('#delivary_charge').html(`<p style="color: green;">Free</p>`);
                    //             }
                    //             $('#grand_total').html(`₹` + grand_total)
                    //         } else {
                    //             console.log(response);
                    //         }
                    //     },
                    //     error: function (err) {
                    //         console.log(err);
                    //     },
                    // });
                } else {
                    $('#cart_item').html("")
                    $('.subtotal_amount').html(`₹` + 0)
                    $('.checkout_button').html(`<p class="total-price">₹0 </p>
                                                <a href="javascript:void(0)" onclick="billing_icomplete()">
                                                <button class="checkout btn_disabled">Checkout</button>
                                                </a>`)
                }

            },
            error: function (err) {
                console.error(err)
            }
        })
    }

    let p_address_id = ''
    let b_address_id = ''

    function get_user() {
        $.ajax({
            url: '<?= base_url('/api/user') ?>',
            type: "GET",
            data: {
                user_id: user_id
            },
            beforeSend: function () {

            },
            success: function (resp) {
                console.log('USER', resp)
                if (resp.status == true) {
                    user_data.address = resp.address
                    user_data.allAddress = resp.all_address
                    user_data.user = resp.user_data
                    user_data.user_img = resp.user_img
                    let baddress = user_data.allAddress.find(
                        (item) => item.type === 'business'
                    );
                    // user
                    $('#billinginfo-name').val(resp.user_data.user_name)
                    $('#billinginfo-email').val(resp.user_data.email)
                    $('#billinginfo-phone').val(resp.user_data.number)
                    // address
                    $('#billinginfo-country').val(resp.address.country)
                    $('#billinginfo-state').val(resp.address.state)
                    $('#billinginfo-district').val(resp.address.district)
                    $('#billinginfo-city').val(resp.address.city)
                    $('#billinginfo-locality').val(resp.address.locality)
                    $('#billinginfo-zip').val(resp.address.zipcode)
                    p_address_id = resp.address.uid
                    if (baddress) {
                        $('#businessinfo-name').val(baddress.business_name)
                        $('#businessinfo-email').val(baddress.business_email)
                        $('#businessinfo-gst').val(baddress.gst)
                        $('#businessinfo-phone').val(baddress.business_phone)
                        $('#businessinfo-address').val(baddress.business_address)
                        $('#businessinfo-zip').val(baddress.zipcode)
                        $('#businessinfo-landmark').val(baddress.locality)
                        $('#businessinfo-goodsname').val(baddress.business_good_name)
                        b_address_id = baddress.uid


                    }

                }
            },
            error: function (err) {
                console.error(err)
            }
        })
    }

    $("#place_order_btn").click(function () {
        const activeLink = document.querySelector('.nav-tabs .nav-link.active');
        const activeValue = activeLink ? activeLink.getAttribute('data-value') : null;
        // alert(activeValue);
        
        var user_name = $("#billinginfo-name").val()
        var user_number = $("#billinginfo-phone").val()
        var user_email = $("#billinginfo-email").val()
        var user_city = $("#billinginfo-city").val()
        var user_country = $("#billinginfo-country").val()
        var user_zip = $("#billinginfo-zip").val()
        var user_district = $("#billinginfo-district").val()
        var user_state = $("#billinginfo-state").val()
        var user_locality = $("#billinginfo-locality").val()

        var business_name = $("#businessinfo-name").val()
        var business_number = $("#businessinfo-phone").val()
        var business_email = $("#businessinfo-email").val()
        var business_gst = $("#businessinfo-gst").val()
        var business_address = $("#businessinfo-address").val()
        var business_zip = $("#businessinfo-zip").val()
        var business_landmark = $("#businessinfo-landmark").val()
        var business_goodsname = $("#businessinfo-goodsname").val()

        if(activeValue == 'personal'){
            if(user_name == ""){
                Toastify({
                    text: 'User name is required'.toUpperCase(),
                    duration: 3000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'darkred',
                    },
                }).showToast();
                return false
            }
            if(user_number == ""){
                Toastify({
                    text: 'User name number required'.toUpperCase(),
                    duration: 3000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'darkred',
                    },
                }).showToast();
                return false
            }
            if(user_email == ""){
                Toastify({
                    text: 'User email is required'.toUpperCase(),
                    duration: 3000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'darkred',
                    },
                }).showToast();
                return false
            }
            if(user_city == ""){
                Toastify({
                    text: 'User city is required'.toUpperCase(),
                    duration: 3000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'darkred',
                    },
                }).showToast();
                return false
            }
            if(user_country == ""){
                Toastify({
                    text: 'User country is required'.toUpperCase(),
                    duration: 3000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'darkred',
                    },
                }).showToast();
                return false
            }
            if(user_zip == ""){
                Toastify({
                    text: 'User zip code is required'.toUpperCase(),
                    duration: 3000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'darkred',
                    },
                }).showToast();
                return false
            }
            if(user_district == ""){
                Toastify({
                    text: 'User district is required'.toUpperCase(),
                    duration: 3000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'darkred',
                    },
                }).showToast();
                return false
            }
            if(user_state == ""){
                Toastify({
                    text: 'User state is required'.toUpperCase(),
                    duration: 3000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'darkred',
                    },
                }).showToast();
                return false
            }
            if(user_locality == ""){
                Toastify({
                    text: 'User locality is required'.toUpperCase(),
                    duration: 3000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'darkred',
                    },
                }).showToast();
                return false
            }
        } else if(activeValue == 'business'){
            if(business_name == ""){
                Toastify({
                    text: 'Business name is required'.toUpperCase(),
                    duration: 3000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'darkred',
                    },
                }).showToast();
                return false
            }
            if(business_number == ""){
                Toastify({
                    text: 'Business number is required'.toUpperCase(),
                    duration: 3000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'darkred',
                    },
                }).showToast();
                return false
            }
            if(business_email == ""){
                Toastify({
                    text: 'Business email is required'.toUpperCase(),
                    duration: 3000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'darkred',
                    },
                }).showToast();
                return false
            }
            if(business_gst == ""){
                Toastify({
                    text: 'GST number is required'.toUpperCase(),
                    duration: 3000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'darkred',
                    },
                }).showToast();
                return false
            }
            if(business_address == ""){
                Toastify({
                    text: 'Business address is required'.toUpperCase(),
                    duration: 3000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'darkred',
                    },
                }).showToast();
                return false
            }
            if(business_zip == ""){
                Toastify({
                    text: 'Business zip code is required'.toUpperCase(),
                    duration: 3000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'darkred',
                    },
                }).showToast();
                return false
            }
            if(business_landmark == ""){
                Toastify({
                    text: 'Business landmark is required'.toUpperCase(),
                    duration: 3000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'darkred',
                    },
                }).showToast();
                return false
            }
            if(business_goodsname == ""){
                Toastify({
                    text: 'Goods name is required'.toUpperCase(),
                    duration: 3000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'darkred',
                    },
                }).showToast();
                return false
            }
        } else {
            Toastify({
                text: 'Personar or Business Details Not Found!'.toUpperCase(),
                duration: 3000,
                position: "center",
                stopOnFocus: true,
                style: {
                    background: 'darkred',
                },
            }).showToast();
            return false
        }
        
        
        console.log(1)
        var amount = user_cart.total;
        var selectedAddressId = $('#addressTabs .nav-link.active').attr('id') === 'billing-tab' ? p_address_id : b_address_id;

        var options = {
            "key": "<?= RAZORPAY_KEY_LIVE_ID ?>", // Enter the Key ID generated from the Dashboard
            "amount": parseInt(amount * 100), // Amount is in currency subunits. Default currency is INR. Hence, 10 refers to 1000 paise
            "name": "Candyflow Pvt. Ltd.",
            "description": 'Candy flow payment',
            "image": "<?= base_url('public/assets/images/candyflow_logo.png') ?>",
            "handler": function (response) {
                var paymentid = response.razorpay_payment_id;

                user_data.name = $('#billinginfo-name').val()
                user_data.email = $('#billinginfo-email').val()
                user_data.number = $('#billinginfo-phone').val()
                $.ajax({
                    url: '<?= base_url('/api/order/confirm') ?>',
                    type: "POST",
                    contentType: 'application/json',
                    data: JSON.stringify({
                        user_data: user_data,
                        user_cart: user_cart,
                        payment_data: payment_data,
                        address_id: selectedAddressId
                    }),
                    beforeSend: function () {
                        $('#place_order_btn').prop('disabled', true);
                    },
                    success: function (resp) {
                        console.log(resp)
                        if (resp.status) {
                            let order_id = resp.data.order_id
                            Toastify({
                                text: resp.message.toUpperCase(),
                                duration: 3000,
                                position: "center",
                                stopOnFocus: true,
                                style: {
                                    background: resp.status ? 'darkgreen' : 'darkred',
                                },
                            }).showToast();
                            // Redirect after 2 seconds
                            setTimeout(function () {
                                window.location.href = `<?= base_url('/order/success?o_id=') ?>${order_id}`;
                            }, 2000);
                            $('#place_order_btn').prop('disabled', true);

                            // $('#exampleModalInvoice').modal('show');

                            // const byteCharacters = atob(resp.invoice); // Decode the base64 string into a byte array
                            // const byteArrays = new Uint8Array(byteCharacters.length);
                            // for (let i = 0; i < byteCharacters.length; i++) {
                            //     byteArrays[i] = byteCharacters.charCodeAt(i);
                            // }
                            // const blob = new Blob([byteArrays], { type: 'application/pdf' });
                            // const pdfUrl = URL.createObjectURL(blob);
                            // const iframe = document.getElementById('invoice_pdf');
                            // if (iframe) {
                            //     iframe.src = pdfUrl;
                            // } else {
                            //     console.error('Iframe element with id "invoice_pdf" not found.');
                            // }


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
                            $('#place_order_btn').prop('disabled', false);
                        }
                    },
                    error: function (err) {
                        console.error(err)
                    }
                })

            },
            "theme": {
                "color": "#3399cc"
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
    });

</script>