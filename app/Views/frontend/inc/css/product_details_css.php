<style>
    .w-icon-heart-full {
        color: #336699;

    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: gray;
        /* Change arrow color to gray */
    }

    .fixed-size-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
        /* Maintain aspect ratio and crop image if needed */
    }

    #gst {
        font-size: 15px;
        font-weight: 500;
    }

    .image-row {
        display: flex;
        justify-content: center;
        /* Center the images horizontally */
        align-items: center;
        /* Center the images vertically */
        flex-wrap: wrap;
        /* Wrap the images to the next line if they don't fit */
    }

    .product-variation-price {
        font-size: 20px;
        padding: 0px 0px 10px 0px;
        font-weight: 700;
    }

    .image-row img {
        width: 80px;
        /* Set the width of each image */
        height: 80px;
        /* Set the height of each image */
        object-fit: cover;
        /* Ensure images cover the area without distortion */
        margin: 2px;
        /* Add some space between images */
        cursor: pointer;
    }

    .modal-dialog {
        max-width: 80%;
        margin: 1.75rem auto;
    }

    .size-chart-img {
        width: 100%;
        height: auto;
    }

    .see_size_chart {
        cursor: pointer;
    }
</style>

<style>
    .star-rating {
        direction: rtl;
        display: inline-block;
        font-size: 0;
    }

    .star-rating input {
        display: none;
    }

    .star-rating label {
        color: #ccc;
        font-size: 2rem;
        padding: 0;
        cursor: pointer;
        display: inline-block;
    }

    .star-rating input:checked~label {
        color: #f5b301;
    }

    .star-rating label:hover,
    .star-rating label:hover~label {
        color: #f5b301;
    }


    .product-media img {
        margin: 0 auto;
        margin-bottom: -66px;
        object-fit: contain !important;

    }

    #qwarn {
        font-size: 18px;
        color: rgba(200, 0, 0, 1);
        font-weight: 500;

    }

    @media (min-width: 1024px) {
        /* .product-action-similar-vendor{
            margin-right: 24px;
            margin-top: -8px;
            
        } */
        .product-media img {
            height: 84px !important;
        }
        .product-media-img-bx img{
            height: 268px !important;
        }
    }

    /* .product-action-similar-vendor{
        margin-right: 24px;
        margin-top: -8px;
    } */

    .product-media-img-bx {
        display: block;
        /* height: 297px; */
        width: 100%;
    }
    .product-media-img-bx img{
        /* height: 297px; */
        width: 100%;
        object-fit: contain !important;
        background-color: #000 !important;
    }

    /* @media (min-width: 768px) {
        .product-media-img-bx {
                height: 297px;
            
        }
    } */

    @media (max-width: 480px) {
        .product-media img {
            height: 74px !important;
        }
        /* .product-action-similar-vendor{
            margin-right: 24px;
            margin-top: -8px;
        } */
        .product-media-img-bx img{
            /* height: 516px; */
            /* margin-bottom: -100px !important; */
            /* object-fit: contain !important; */
            /* background-color: #fff !important; */
        }
    }
</style>