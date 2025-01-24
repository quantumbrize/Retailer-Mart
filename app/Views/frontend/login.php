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
        ( function ( d ) {
            var wf = d.createElement( 'script' ), s = d.scripts[0];
            wf.src = '<?= base_url()?>public/assets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore( wf, s );
        } )( document );
    </script>

    <link rel="preload" href="<?= base_url()?>public/assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= base_url()?>public/assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= base_url()?>public/assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= base_url()?>public/assets/fonts/wolmart.woff?png09e" as="font" type="font/woff" crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>public/assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url()?>public/assets/vendor/swiper/swiper-bundle.min.css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>public/assets/vendor/magnific-popup/magnific-popup.min.css">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>public/assets/css/style.min.css">

    <!-- Toastify CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
	<!-- Toastify JS -->
	<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
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
</style>
<body>
    <div class="page-wrapper">

        <!-- Start of Main -->
        <main class="main login-page">
            <div class="page-content">
            <div id="alert"></div>
                <div class="container">
                    <div class="login-popup">
                        <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                            <ul class="nav nav-tabs text-uppercase" role="tablist">
                                <li class="nav-item">
                                    <a href="<?= base_url('login')?>" class="nav-link active">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" onclick="window.location.href='<?= base_url('sign-up') ?>'" class="nav-link">Sign Up</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="sign-in">
                                    <div class="form-group">
                                        <label>Email address or phone *</label>
                                        <input type="text" class="form-control" name="username" id="email_number">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label>Password *</label>
                                        <input type="text" class="form-control" name="password" id="password-input">
                                    </div>
                                    <div class="form-checkbox d-flex align-items-center justify-content-between">
                                        <input type="checkbox" class="custom-checkbox" id="remember1" name="remember1">
                                        <label for="remember1">Remember me</label>
                                        <a href="#">Last your password?</a>
                                    </div>
                                    <a href="javascript:void(0)" class="btn btn-primary" id="sign-in-btn">Sign In</a>
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
    <a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button"> <i class="w-icon-angle-up"></i> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 70 70"> <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35" r="34" style="stroke-dasharray: 16.4198, 400;"></circle> </svg> </a>
    <!-- End of Scroll Top -->

    <!-- Start of Mobile Menu -->
    <div class="mobile-menu-wrapper">
        <div class="mobile-menu-overlay"></div>
        <!-- End of .mobile-menu-overlay -->

        <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
        <!-- End of .mobile-menu-close -->
    </div>
    <!-- End of Mobile Menu -->

    <!-- Plugin JS File -->
    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="<?= base_url()?>public/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url()?>public/assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url()?>public/assets/js/main.min.js"></script>

    <script>
        $(document).ready(function () {
            // $('#password-addon').on('click', function () {
            //     if ($('#password-input').attr('type') == 'password') {
            //         $('#password-input').attr('type', 'text')
            //     } else {
            //         $('#password-input').attr('type', 'password')

            //     }
            // })


            $('#sign-in-btn').on('click', function () {

                let email_number = $('#email_number').val();
                let password = $('#password-input').val();

                $.ajax({
                    url: "<?= base_url('login-action') ?>",
                    type: 'POST',
                    data: {
                        email_number: email_number,
                        password: password,
                    },
                    beforeSend: function () {
                        $('#sign-in-btn').html(`<div class="spinner-border text-light" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>`)
                        $('#sign-in-btn').attr('disabled', true);
                    },
                    success: function (resp) {
                        resp = JSON.parse(resp)
                        if (resp.status == true) {
                            $('#alert').html(`<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                                        <i class="ri-checkbox-circle-fill label-icon"></i><strong>${resp.message}</strong>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>`) 

                            var storedData = localStorage.getItem('cartData');
                            var retrievedData = JSON.parse(storedData);
                            if(retrievedData != ""){
                                $.ajax({
                                    url: "<?= base_url('/api/user/id') ?>",
                                    type: "GET",
                                    success: function (resp) {
                                        
                                        if (resp.status) {
                                            $.each(retrievedData, function(index, cart) {
                                                $.ajax({
                                                    url: "<?= base_url('/api/user/cart/add') ?>",
                                                    type: "POST",
                                                    data:{product_id:cart.product_id, 
                                                        user_id:resp.data,
                                                        variation_id:cart.variation_id,
                                                        qty:cart.qty,
                                                        },
                                                    success: function (resp) {
                                                        
                                                        if (resp.status) {
                                                            var updatedData = retrievedData.filter(function(item) {
                                                                item.product_id !== cart.product_id;
                                                            });
                                                            var updatedDataJSON = JSON.stringify(updatedData);
                                                            localStorage.setItem('cartData', updatedDataJSON);
                                                        } else {
                                                            console.log(resp)
                                                           
                                                        }
                                                        
                                                    },
                                                    error: function (err) {
                                                        console.log(err)
                                                    },
                                                })
                                            })
                                                
                                            
                                        } else {
                                            
                                        }
                                    },
                                    error: function (err) {
                                        console.log(err)
                                    },
                                })
                                
                            }

                            window.location.href = `<?= base_url()?>`;
                        } else {
                            $('#alert').html(`<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                                    <i class="ri-alert-line label-icon"></i><strong> ${resp.message}</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>`)
                        }
                        $('#sign-in-btn').html(`Sign In`)
                        $('#sign-in-btn').attr('disabled', false);
                    },
                    complete: function () {
                        $('#sign-in-btn').html(`Sign In`)
                        $('#sign-in-btn').attr('disabled', false);
                    },
                    error: function () {
                        $('#sign-in-btn').html(`Sign In`)
                        $('#sign-in-btn').attr('disabled', false);
                        $('#alert').html(`<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                                    <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Internal Server Error
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>`)
                    }
                })

            })

            $.ajax({
                url: "<?= base_url('/api/about') ?>",
                type: "GET",
                success: function (resp) {
                    // console.log(resp)
                    if (resp.status) {
                    let newLogoSrc = `<?=base_url()?>public/uploads/logo/${resp.data.logo}`;
                    $('#daltonus_logo_meta').attr('href', newLogoSrc);


                    }else{
                        console.log(resp)
                    }
                },
                error: function (err) {
                    console.log(err)
                },
            })
        })


    </script>
</body>
</html>