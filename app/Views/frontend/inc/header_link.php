<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Candyflow I B2B E-commerce Marketplace I Wholesale Rates</title>

    <meta name="keywords" content="">
    <meta name="description" content="Our vision is to empower businesses in the confectionery industry by creating a seamless, innovative, and trusted B2B platform that connects suppliers and buyers nationally. We aim to simplify sourcing, scaling, and growing businesses, helping our partners reach new heights through reliable partnerships, quality products, and exceptional service.">
    <meta name="author" content="">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> -->


    <!-- Favicon -->
    <!-- <link rel="icon" type="image/png" href="<?= base_url()?>public/assets/images/icons/favicon.png"> -->
    <link rel="icon" type="image/png" id="daltonus_logo_meta" href="">

    <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: { families: ['Poppins:400,500,600,700,800'] }
        };
        (function (d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = '<?= base_url()?>public/assets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <link rel="preload" href="<?= base_url()?>public/assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= base_url()?>public/assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= base_url()?>public/assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= base_url()?>public/assets/fonts/wolmart.woff?png09e" as="font" type="font/woff" crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>public/assets/vendor/fontawesome-free/css/all.min.css">

    <!-- Plugins CSS -->
    <!-- <link rel="stylesheet" href="<?= base_url()?>public/assets/vendor/swiper/swiper-bundle.min.css"> -->
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>public/assets/vendor/animate/animate.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>public/assets/vendor/magnific-popup/magnific-popup.min.css">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="<?= base_url()?>public/assets/vendor/swiper/swiper-bundle.min.css">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>public/assets/css/demo1.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>public/assets/css/demo2.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>public/assets/css/search&DropdownUi.css">
     <!-- Default CSS -->
     <link rel="stylesheet" type="text/css" href="<?= base_url()?>public/assets/css/style.min.css">
	<!-- Toastify CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
	<!-- Toastify JS -->
	<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Bootstrap CSS -->
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"> -->
<!-- Bootstrap JS Bundle (includes Popper) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script> -->







    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
		 $.ajax({
			url: "<?= base_url('/api/about') ?>",
			type: "GET",
			success: function (resp) {
				console.log(resp)
				if (resp.status) {
				let newLogoSrc = `<?=base_url()?>public/uploads/logo/${resp.data.logo}`;
				$('#daltonus_logo_meta').attr('href', newLogoSrc);
				$('.company_logo').attr('src', newLogoSrc);
				$('.company_name').text(resp.data.company_name)
				$('.company_address').text(resp.data.address)
				$('.about_description').html(resp.data.about_description)
				$('#mission').html(resp.data.mission)
				$('#vision').html(resp.data.vision)
				$('#company_email').html(resp.data.email)


				}else{
					console.log(resp)
				}
			},
			error: function (err) {
				console.log(err)
			},
		})

	</script>

    <style>
        .transparent-bg {
            background-color: transparent; /* Makes the background transparent */
            border: 1px solid #0733ab; /* Optional: Add a border to match your primary color */
            border-radius: 8px; /* Optional: Rounded edges */
            padding: 8px; /* Adjust padding as needed */
            color: #333; /* Adjust text color if needed */
        }
        
        .transparent-bg::placeholder {
            color: #999; /* Adjust placeholder text color if needed */
        }
    </style>
    <style>
        /* Hide Cart, SignIn, and SignUp on mobile devices */
        @media (max-width: 768px) {
            .icon-link, .signup-btn {
                display: none;
            }
        }
    </style>
      <style>
        .sticky-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #fff;
            /* Set background color for visibility */
            z-index: 1000;
            /* Ensure it stays on top */
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            /* Optional: Adds a subtle shadow effect */
        }
    </style>

	<?php
	if (!empty($header_asset_link)) {
		foreach ($header_asset_link as $link) {
			echo "<link href='" . base_url() . 'public/' . $link . "' rel='stylesheet' type='text/css'>";
		}
	}

	if (!empty($header_link)) {
		foreach ($header_link as $link) {
			require_once ('css/' . $link);
		}
	}
	?>
	<style>
		body {
			overflow-x: hidden;
		}
	</style>
