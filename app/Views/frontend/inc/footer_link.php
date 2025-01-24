<!-- Plugin JS File -->
<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="<?= base_url()?>public/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url()?>public/assets/vendor/jquery.plugin/jquery.plugin.min.js"></script>
    <script src="<?= base_url()?>public/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="<?= base_url()?>public/assets/vendor/zoom/jquery.zoom.js"></script>
    <script src="<?= base_url()?>public/assets/vendor/jquery.countdown/jquery.countdown.min.js"></script>
    <script src="<?= base_url()?>public/assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url()?>public/assets/vendor/skrollr/skrollr.min.js"></script>

    <!-- Swiper JS -->
    <script src="<?= base_url()?>public/assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS -->
    <script src="<?= base_url()?>public/assets/js/main.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>


	<?php
        if (!empty ($footer_asset_link)) {
            foreach ($footer_asset_link as $link) {
                echo "<script src='" . base_url() . 'public/' . $link . "'></script>";
            }
        }
        if (!empty ($footer_link)) {
            foreach ($footer_link as $link) {
                require_once ('js/' . $link);
            }
        }
    ?>

</body>

</html>