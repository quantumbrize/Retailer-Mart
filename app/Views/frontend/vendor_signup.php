<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Candy Flow</title>

    <meta name="keywords" content="Marketplace ecommerce responsive HTML5 Template">
    <meta name="description" content="Wolmart is powerful marketplace &amp; ecommerce responsive Html5 Template.">
    <meta name="author" content="D-THEMES">

    <!-- Favicon -->
    <link rel="icon" type="image/png" id="daltonus_logo_meta" href="">


    <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: { families: ['Poppins:400,500,600,700'] }
        };
        (function (d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = '<?= base_url() ?>public/assets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <link rel="preload" href="<?= base_url() ?>public/assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= base_url() ?>public/assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= base_url() ?>public/assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= base_url() ?>public/assets/fonts/wolmart.woff?png09e" as="font" type="font/woff"
        crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css"
        href="<?= base_url() ?>public/assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/swiper/swiper-bundle.min.css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" type="text/css"
        href="<?= base_url() ?>public/assets/vendor/magnific-popup/magnific-popup.min.css">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/assets/css/style.min.css">
</head>
<style>
    #alert {

        position: fixed;
        top: 10px;
        z-index: 1000;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        left: 0px;
    }

    #alert.alert {
        background: aliceblue !important;
    }

    input[type="file"] {
        display: none;
    }

    #btn_upload1 {
        display: block;
        position: relative;
        color: #ffffff;
        font-size: 18px;
        text-align: center;
        margin: auto;
        border-radius: 5px;
        cursor: pointer;
    }

    .container p {
        text-align: center;
        margin: 20px 0 30px 0;
    }

    #images {
        width: 90%;
        position: relative;
        margin: auto;
        display: flex;
        justify-content: space-evenly;
        gap: 20px;
        flex-wrap: wrap;
    }

    figure {
        width: 45%;
    }

    img {
        width: 100%;
    }

    figcaption {
        text-align: center;
        font-size: 2.4vmin;
        margin-top: 0.5vmin;
    }

    .user_documents {
        max-width: 100px;
        max-height: 200px;
        object-fit: cover;
    }
</style>

<body>
    <div id="alert">

    </div>
    <div class="page-wrapper">

        <!-- Start of Main -->
        <main class="main login-page">
            <div class="page-content">
                <!-- <div id="alert"></div> -->
                <div class="container">
                    <div class="login-popup vendor-sign">
                        <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                            <ul class="nav nav-tabs text-uppercase" role="tablist">
                                <!-- <li class="nav-item">
                                    <a href="javascript:void(0)" onclick="window.location.href='<?= base_url('login') ?>'" class="nav-link">Sign In</a>
                                </li> -->
                                <li class="nav-item">
                                    <a href="<?= base_url('sign-up') ?>" class="nav-link active">Vendor Sign Up</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="sign-up">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-5">
                                                <label>Vendor Name *</label>
                                                <!-- <input type="text" class="form-control" name="first-name" id="full-name"> -->
                                                <input type="text" class="form-control" id="user_name"
                                                    placeholder="Enter your firstname">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-5">
                                                <label>Phone Number * (Whatsapp number)</label>
                                                <input type="number" class="form-control" oninput="limitInputLength(this, 10)" id="number"
                                                    placeholder="Enter your 10 digit number" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-5">
                                                <label>Email *</label>
                                                <input type="email" class="form-control" id="email"
                                                    placeholder="Enter your email">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-5">
                                                <label>Password *</label>
                                                <input type="text" class="form-control" id="password"
                                                    placeholder="Enter your password">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <label class="form-label" for="product-image-input">GST *</label>
                                                        <input type="text" class="form-control  mb-1" id="gst"
                                                            placeholder="Enter your gst number">
                                                        <input type="file" id="file-input5" multiple>
                                                        <label for="file-input5" id="btn_upload1"
                                                            class="btn btn-success">
                                                            <i class="fas fa-upload"></i> &nbsp;
                                                        </label>
                                                        <p id="num-of-files5"></p>
                                                        <div id="images5"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <label class="form-label" for="product-image-input">Tread Licence *</label>
                                                        <input type="text" class="form-control  mb-1" id="trade"
                                                            placeholder="Enter your trade Licence number">
                                                        <input type="file" id="file-input6" multiple>
                                                        <label for="file-input6" id="btn_upload1"
                                                            class="btn btn-success">
                                                            <i class="fas fa-upload"></i> &nbsp;
                                                        </label>
                                                        <p id="num-of-files6"></p>
                                                        <div id="images6"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <label class="form-label" for="product-image-input">User Image *</label>
                                                        <input type="file" id="file-input1" multiple>
                                                        <label for="file-input1" id="btn_upload1"
                                                            class="btn btn-success">
                                                            <i class="fas fa-upload"></i> &nbsp;
                                                        </label>
                                                        <p id="num-of-files1"></p>
                                                        <div id="images1"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <label class="form-label"
                                                            for="product-image-input">Signature *</label>
                                                        <input type="file" id="file-input2" multiple>
                                                        <label for="file-input2" id="btn_upload1"
                                                            class="btn btn-success">
                                                            <i class="fas fa-upload"></i> &nbsp;
                                                        </label>
                                                        <p id="num-of-files2"></p>
                                                        <div id="images2"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <label class="form-label" for="product-image-input">Business Pan Card Image *</label>
                                                        <input type="text" class="form-control  mb-1" id="pan"
                                                            placeholder="Enter your Pan number" >

                                                        <input type="file" id="file-input3" multiple>
                                                        <label for="file-input3" id="btn_upload1"
                                                            class="btn btn-success">
                                                            <i class="fas fa-upload"></i> &nbsp;
                                                        </label>
                                                        <p id="num-of-files3"></p>
                                                        <div id="images3"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <label class="form-label"
                                                            for="product-image-input">Personal Aadhar *</label>
                                                        <input type="text" class="form-control  mb-1" id="aadhar"
                                                            placeholder="Enter your Aadhar number" >

                                                        <input type="file" id="file-input4" multiple>
                                                        <label for="file-input4" id="btn_upload1"
                                                            class="btn btn-success">
                                                            <i class="fas fa-upload"></i> &nbsp;
                                                        </label>
                                                        <p id="num-of-files4"></p>
                                                        <div id="images4"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- <div class="form-group mb-5">
                                            <label>Phone Number *</label>
                                            <input type="text" class="form-control" name="phone-number" id="phone-number" >
                                        </div>
                                        <div class="form-group mb-5">
                                            <label>Password *</label>
                                            <input type="text" class="form-control" name="password_1" id="password_1">
                                        </div>
                                        <div class="checkbox-content login-vendor"> -->

                                        <!-- <div class="form-group mb-5">
                                                <label>Last Name *</label>
                                                <input type="text" class="form-control" name="last-name" id="last-name">
                                            </div> -->
                                        <!-- <div class="form-group mb-5">
                                                <label>Shop Name *</label>
                                                <input type="text" class="form-control" name="shop-name" id="shop-name">
                                            </div> -->

                                        <!-- <div class="form-group mb-5">
                                            <label>Shop URL *</label>
                                            <input type="text" class="form-control" name="shop-url" id="shop-url">
                                            <small>https://d-themes.com/wordpress/wolmart/demo-1/store/</small>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- <div class="form-checkbox user-checkbox mt-0">
                                        <input type="checkbox" class="custom-checkbox checkbox-round active" id="check-customer" name="check-value" value="customer">
                                        <label for="check-customer" class="check-customer mb-1">I am a customer</label>
                                        <br>
                                        <input type="checkbox" class="custom-checkbox checkbox-round" id="check-seller" name="check-value" value="vendor" >
                                        <label for="check-seller" class="check-seller">I am a vendor</label>
                                    </div> -->
                                <p>Your personal data will be used to support your experience
                                    throughout this website, to manage access to your account,
                                    and for other purposes described in our <a href="<?= base_url('privacy-policy') ?>"
                                        class="text-primary">privacy policy</a>.</p>
                                <a href="<?= base_url('seller') ?>" class="d-block mb-5 text-primary">Sign In as a
                                    vendor?</a>
                                <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                                    <input type="checkbox" checked class="custom-checkbox" id="remember"
                                        name="remember">
                                    <label for="remember" class="font-size-md">I agree to the <a
                                            href="<?= base_url('privacy-policy') ?>"
                                            class="text-primary font-size-md">privacy policy</a></label>
                                </div>
                                <a href="javascript:void(0)" class="btn btn-primary" id="sign-up-btn">Sign Up</a>
                            </div>
                        </div>
                        <!-- <p class="text-center">Sign in with social account</p>
                            <div class="social-icons social-icon-border-color d-flex justify-content-center">
                                <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                <a href="#" class="social-icon social-google fab fa-google"></a>
                            </div> -->
                    </div>
                </div>
            </div>
    </div>
    </main>
    <!-- End of Main -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Start of Scroll Top -->
    <a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button"> <i class="w-icon-angle-up"></i> <svg
            version="1.1" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 70 70">
            <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35"
                r="34" style="stroke-dasharray: 16.4198, 400;"></circle>
        </svg> </a>
    <!-- End of Scroll Top -->

    <!-- Start of Mobile Menu -->
    <div class="mobile-menu-wrapper">
        <div class="mobile-menu-overlay"></div>
        <!-- End of .mobile-menu-overlay -->

        <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
        <!-- End of .mobile-menu-close -->

        <div class="mobile-menu-container scrollable">
            <form action="#" method="get" class="input-wrapper">
                <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search"
                    required="">
                <button class="btn btn-search" type="submit">
                    <i class="w-icon-search"></i>
                </button>
            </form>
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
        </div>
    </div>
    <!-- End of Mobile Menu -->

    <!-- Plugin JS File -->
    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="<?= base_url() ?>public/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>public/assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url() ?>public/assets/js/main.min.js"></script>

    <script>

        function limitInputLength(input, maxLength) {
            if (input.value.length > maxLength) {
                input.value = input.value.slice(0, maxLength); // Truncate to maxLength
            }
        }

        $(document).ready(function () {

            // $('#sign-up-btn').on('click', function () {

            //     const activeValue = $('.form-checkbox input.active').val();
            //     if(activeValue == 'customer'){
            //         let userEmail = $('#email_1').val();
            //         let userName = $('#full-name').val();
            //         let phone = $('#phone-number').val();
            //         let password = $('#password_1').val();
            //         // let confirmPassword = $('#confirm-password-input').val();

            //         console.log(userEmail);
            //         console.log(userName);
            //         console.log(password);
            //         // console.log(confirmPassword);

            //         if (userName.length < 1) {
            //             $('#alert').html(`<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
            //                                 <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Please Enter User Name
            //                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            //                             </div>`)
            //         } else if (phone < 10) {
            //             $('#alert').html(`<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
            //                                 <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Please Enter a valid Number
            //                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            //                             </div>`)
            //         } else if (userEmail.length < 1) {
            //             $('#alert').html(`<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
            //                                 <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Please Enter Your Email
            //                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            //                             </div>`)
            //         } else if (password.length < 6) {
            //             $('#alert').html(`<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
            //                                 <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Password Must Be Six Characters Long
            //                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            //                             </div>`)
            //         } 
            //         // else if (password != confirmPassword) {
            //         //     $('#alert').html(`<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
            //         //                         <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Passwords Dont Match
            //         //                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            //         //                     </div>`)
            //         // } 
            //         else {

            //             $.ajax({
            //                 url: '<?= base_url('sign-up-action') ?>',
            //                 method: 'POST',
            //                 data: {
            //                     user_name: userName,
            //                     email: userEmail,
            //                     password: password,
            //                     number: phone
            //                 },
            //                 beforeSend: function () {
            //                     $('#sign-up-btn').html(`<div class="spinner-border text-light" role="status">
            //                                             <span class="sr-only">Loading...</span>
            //                                         </div>`)
            //                     $('#sign-up-btn').attr('disabled', true);

            //                 },
            //                 success: function (resp) {
            //                     resp = JSON.parse(resp)
            //                     console.log(resp)
            //                     if (resp.status == true) {
            //                         $('#alert').html(`<div class="alert alert-secondary alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
            //                                                 <i class="ri-mail-send-fill label-icon"></i><strong>Mail Send</strong> - OTP sent To Your Email
            //                                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            //                                             </div>`)
            //                         window.location.href = `<?= base_url('login') ?>`;
            //                     } else {
            //                         $('#alert').html(`<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
            //                                             <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - ${resp.message}
            //                                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            //                                         </div>`)
            //                     }
            //                     $('#sign-up-btn').attr('disabled', false);

            //                 },
            //                 complete :function(){
            //                     $('#sign-up-btn').html(`Sign Up`)
            //                     $('#sign-up-btn').attr('disabled', false);
            //                 },
            //                 error: function(){
            //                     $('#sign-up-btn').html(`Sign Up`)
            //                     $('#sign-up-btn').attr('disabled', false);
            //                     $('#alert').html(`<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
            //                                             <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Internal Srver Error
            //                                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            //                                         </div>`)
            //                 }
            //             })

            //         }
            //     } else {
            //         alert('only user signup has done')
            //     }


            // })

            function validateDocuments(gst, trade, pan, aadhar, email, number) {
                const errors = {};

                // Helper function to check if a field is empty
                function isEmpty(field) {
                    return !field || field.trim() === '';
                }

                // GST Validation
                if (isEmpty(gst) || !gst.match(/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/)) {
                    errors.gst = "Invalid GST Number. ";
                }

                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (isEmpty(email) || !email.match(emailRegex)) {
                    errors.gst = "Invalid Email. ";
                }

                if (isEmpty(number) || number.length !== 10) {
                    errors.gst = "Invalid Number. ";
                }
                // Trade License Validation
                // if (isEmpty(trade)) {
                //     errors.trade = "Trade License Number is required.";
                // }

                // PAN Validation
                if (isEmpty(pan) || !pan.match(/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/)) {
                    errors.pan = "Invalid PAN Number.";
                }

                // Aadhaar Validation
                if (isEmpty(aadhar) || !/^\d{12}$/.test(aadhar)) {
                    errors.aadhar = "Invalid Aadhaar Number. It must be a 12-digit number.";
                }


                return errors;
            }


            $('#sign-up-btn').on('click', function () {
                const checkbox = document.getElementById("remember");

                if (checkbox.checked) {
                    // Collect form inputs
                    let gst = $('#gst').val()
                    let trade = $('#trade').val()
                    let pan = $('#pan').val()
                    let aadhar = $('#aadhar').val()
                    let email = $('#email').val()
                    let number = $('#number').val()

                    // Validate the inputs
                    let errors = validateDocuments(gst, trade, pan, aadhar, email, number);

                    if (Object.keys(errors).length === 0) {
                        var formData = new FormData();

                        formData.append('user_name', $('#user_name').val().trim());
                        formData.append('number', $('#number').val().trim());
                        formData.append('email', $('#email').val().trim());
                        formData.append('password', $('#password').val().trim());
                        formData.append('gst', $('#gst').val().trim());
                        formData.append('trade', $('#trade').val().trim());
                        formData.append('pan', $('#pan').val().trim());
                        formData.append('aadhar', $('#aadhar').val().trim());

                        // Append files
                        $.each($('#file-input1')[0].files, function (index, file) {
                            formData.append('user_img[]', file);
                        });
                        $.each($('#file-input2')[0].files, function (index, file) {
                            formData.append('signature[]', file);
                        });
                        $.each($('#file-input3')[0].files, function (index, file) {
                            formData.append('pan_img[]', file);
                        });
                        $.each($('#file-input4')[0].files, function (index, file) {
                            formData.append('aadhar_img[]', file);
                        });
                        $.each($('#file-input5')[0].files, function (index, file) {
                            formData.append('gst[]', file);
                        });
                        $.each($('#file-input6')[0].files, function (index, file) {
                            formData.append('tread_licence[]', file);
                        });

                        // Submit form via AJAX
                        $.ajax({
                            url: "<?= base_url('/api/seller/add') ?>",
                            type: "POST",
                            data: formData,
                            contentType: false,
                            processData: false,
                            beforeSend: function () { },
                            success: function (resp) {
                                let html = '';
                                if (resp.status) {
                                    html += `<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                    <i class="ri-checkbox-circle-fill label-icon"></i>${resp.message}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
                                </div>`;
                                    $('#user_name, #number, #email, #password').val("");
                                    $('#file-input1, #file-input2, #file-input3, #file-input4, #file-input5, #file-input6').val("");
                                    $('#num-of-files1, #images1, #num-of-files2, #images2, #num-of-files3, #images3').html("");
                                    $('#num-of-files4, #images4, #num-of-files5, #images5, #num-of-files6, #images6').html("");
                                } else {
                                    html += `<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                    <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - ${resp.message}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
                                </div>`;
                                }
                                $('#alert').html(html);
                                $('#model_vendor_add').modal('hide');
                                load_vendors();
                            },
                            error: function (err) {
                                console.error(err);
                            }
                        });
                    } else {
                        // // Display the first validation error
                        // let errorHtml = `<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                        //                 <i class="ri-alert-line label-icon"></i><strong>Validation Error:</strong><ul>`;

                        //                                 const firstErrorMessage = Object.values(errors)[0]; // Get the first error message
                        //                                 errorHtml += `<li>${firstErrorMessage}</li>`;

                        //                                 errorHtml += `</ul>
                        //         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        //         </div>`;
                        let errorHtml = `<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                            <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - ${Object.values(errors)[0]}.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">Close</button>
                        </div>`
                        $('#alert').html(errorHtml);

                    }
                } else {
                    // Checkbox not checked
                    const html = `<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                        <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Please agree to the privacy policy.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>`;
                    $('#alert').html(html);
                }
            });

            $.ajax({
                url: "<?= base_url('/api/about') ?>",
                type: "GET",
                success: function (resp) {
                    // console.log(resp)
                    if (resp.status) {
                        let newLogoSrc = `<?= base_url() ?>public/uploads/logo/${resp.data.logo}`;
                        $('#daltonus_logo_meta').attr('href', newLogoSrc);


                    } else {
                        console.log(resp)
                    }
                },
                error: function (err) {
                    console.log(err)
                },
            })

        })

        function preview(fileInput, imageContainer, numOfFiles) {
            return function () {
                imageContainer.html("");
                numOfFiles.text(`${fileInput[0].files.length} Files Selected`);

                $.each(fileInput[0].files, function (index, file) {
                    let reader = new FileReader();
                    let $figure = $("<figure>");
                    let $figCap = $("<figcaption>").text("");
                    $figure.append($figCap);
                    reader.onload = function () {
                        let $img = $("<img>").attr("src", reader.result);
                        $figure.prepend($img);
                    }
                    imageContainer.append($figure);
                    reader.readAsDataURL(file);
                });
            }
        }
        $("#file-input1").change(preview($("#file-input1"), $("#images1"), $("#num-of-files1")));
        $("#file-input2").change(preview($("#file-input2"), $("#images2"), $("#num-of-files2")));
        $("#file-input3").change(preview($("#file-input3"), $("#images3"), $("#num-of-files3")));
        $("#file-input4").change(preview($("#file-input4"), $("#images4"), $("#num-of-files4")));
        $("#file-input5").change(preview($("#file-input5"), $("#images5"), $("#num-of-files5")));
        $("#file-input6").change(preview($("#file-input6"), $("#images6"), $("#num-of-files6")));

    </script>
</body>

</html>