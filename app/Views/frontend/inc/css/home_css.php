<style>
    .gallery-product img {
        height: 215px;
    }

    .gallery-product {
        overflow: hidden;
    }

    #all_products {
        height: fit-content !important;
    }

    @media only screen and (max-width: 767px) {

        /* .view-all-products{
            margin-top: 800px !important;
        } */
        .ecommerce-home {
            min-height: 100px;
        }
    }

    @media only screen and (max-width: 767px) {

        /* .view-all-products{
            margin-top: 800px !important;
        } */
        .img-fluid {
            height: 40vh;
            object-fit: cover;
        }

        #promotion_card .col-md-6 {
            flex-basis: 50%;
            max-width: 50%;
        }
    }

    .img-fluid {
        width: 100%;
        height: 50%;
        object-fit: cover;
    }

    #banner_img .nav-item {
        display: none;
    }


    /* CSS for side-by-side cards on large screens */
    /* @media (min-width: 992px) {
    .promotion_card .col-md-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
} */

    /* CSS for stacked cards on smaller screens */
    /* @media (max-width: 991px) {
    .promotion_card .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }
} */






    .image-container {
        width: 100%;
        /* or any specific width you want */
        position: relative;
    }

    .image-container:before {
        content: "";
        display: block;
        padding-top: 45.25%;
        /* 9/16 = 0.5625; 16:9 aspect ratio */
    }

    .carousel_img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Ensure the image covers the container */
    }




    .timer {
        display: flex;
        gap: 10px;
        font-size: .9em;
        font-weight: bold;
        color: #333;
    }

    .time-section {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .hours {
        color: #0733ab;
        /* Blue */
    }

    .minutes {
        color: #ff7300;
        /* Orange */
    }

    .seconds {
        color: #0733ab;
        /* Blue */
    }

    .label {
        font-size: 0.5em;
        color: #555;
    }

    .w-icon-heart-full {
        color: #336699;

    }

    .product-wrap {
        padding: 10px !important;
        /* box-shadow: rgba(0, 0, 0, 0.2) 0px 7px 29px 0px; */
        transition: 100ms;
        /* border-radius: 5px; */
    }

    .product-wrap:hover {
        scale: 1.05;
        /* outline: 1px solid #336699; */
        padding: 0px !important;
    }

    

    #latest_arriva,
    #best_selling_products,
    #most-popular-product {
        padding: 20px;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    #fashion_category, #accessories_category, #home_garden_category, #smart_phones_category{
        padding: 20px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .product-name {
        font-size: 20px;
        color: #336699;
    }

    .product-name a {
        text-decoration: none;

    }

   
    .product-action-vertical a {
        text-decoration: none;
    }

    .product-wrap .product-media a{
        display: flex;
        height: 150px;
        width: 100%;
        justify-content: center;
        align-items: center;
    }
    /* .product-media img{
        height: 100px;
        width: 150px;
        object-fit: contain !important; 
    } */
    .btn-product-icon{
        height: 35px !important;
        width: 35px !important;
    }

    @media (min-width: 1024px) {
        .product-action-popular{
            margin-right: 38px;
            margin-top: -13px;
        }
        .product-action-fashon{
            margin-top: -13px;
            margin-right: 60px;
        }

        .product-action-vertical-accessories{
            margin-top: -9px !important;
            margin-right: 6px !important;
        }
    }

    @media (max-width: 768px) {
        .product-action-popular{
            margin-right: 24px;
            margin-top: -8px;
        }
        .product-action-fashon{
            margin-top: -8px;
            /* margin-right: 20px; */
        }

        .product-action-vertical-accessories{
            /* margin-top: -9px !important; */
            margin-right: 6px !important;
        }

        
    }

    @media (max-width: 480px) {
        .truncated-text{
            font-size: 14px !important;
        }
    }

@media (min-width: 1024px) {
  .product-media img:first-child {
    /* margin-left: 18% !important; */
  }

    .product-label-popular{
        margin-left: 28px !important;
        margin-top: -14px !important;
    }

    .product-label-categories{
        margin-left: 40px !important;
        margin-top: -18px !important;
    }

    .product-label-categories2{
        margin-left: 10px !important;
        margin-top: -12px !important;
    }
}   

.product-media-img-bx{
    width: 150px;
    display: block;
}

.product-media-img-bx img{

    height: 120px;
    width: 120px;
    object-fit: contain !important;
    background-color: #000 !important;

}


.product-details{
    display: flex;
    align-items: center;
    flex-direction: column;
    background-color: transparent;
}

/* *********************************************************************************** */
/* .full-text{
    display: none;
}

a:hover .full-text {
    display: inline-block;
} */

 /* Scoped styles for the custom carousel */
.custom-carousel {
  position: relative;
  overflow: hidden;
  width: 100%;
  height: 600px; /* Adjust the height to your preference */
  margin: auto;
}

.custom-carousel-wrapper {
  display: flex;
  transition: transform 0.5s ease-in-out;
}

.custom-carousel-item {
  flex: 0 0 100%;
  width: 100%;
}

.custom-carousel-item img {
  width: 100%;
  /* height: 100%;  */
  object-fit: contain; /* Ensures the image scales to fit within the container without cropping */
  display: block;
}

.custom-carousel-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background-color: rgba(0, 0, 0, 0.5);
  color: white;
  border: none;
  padding: 10px;
  cursor: pointer;
  z-index: 10;
}

    @media (max-width: 480px) {
        .custom-carousel-btn {
            top: 50% !important;
        }
        .custom-carousel {
            height: 232px !important;
        }
    }

.custom-carousel-btn.prev {
  left: 10px;
}

.custom-carousel-btn.next {
  right: 10px;
}

/* Scoped reset for swiper-carousel interference */
.custom-carousel2 .swiper, .custom-carousel2 .swiper-container {
  all: unset !important;
}
</style>