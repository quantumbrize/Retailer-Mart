<style>
    .product-img{
        height: 60px;
        width: 60px;
        object-fit: contain;
        background: white;
    }
    tbody tr{
        transition: 50ms;
    }
    #table-product-variant tbody tr:hover{
        cursor: pointer;
       
    }
    .sorting_1{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    #table-product-variant-body td{
       text-align:  center !important;
    }
    #table-product-variant_wrapper{
        overflow-x:scroll ;
    }

    .stock_number{
        padding: 0px 10px 0px 10px;
        width: 20px;
        box-sizing: content-box;
        border: none;
        outline: none;
        text-align: center;
    }

    .carousel-containner {
        border-top-left-radius: 25px;
        border-top-right-radius: 25px;
        overflow: hidden; 

        max-height: 50%; 
        max-width: 100%;
    }

    .carousel-image{
        max-height: 50%; 
        max-width: 100%; 
        object-fit: cover;
    }

    .custom-carousel-button {
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
        border: none;
        width: 50px;
        height: 50px;
        /* display: flex; */
        justify-content: center;
        align-items: center;
        border-radius: 50%; /* Makes the button circular */
        transition: background-color 0.3s ease;
}

    .custom-carousel-button:hover {
        background-color: rgba(28, 87, 181, 0.8); /* Darker on hover */
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        filter: invert(1); /* Makes the default arrow icon white */
    }

    .download-container {
    text-align: center;
    margin: 20px;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
    }

    .download-btn {
    margin-top: 10px;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    }

    .download-btn:hover {
    background-color: #0056b3;
    }

    .description {
    margin-top: 10px;
    font-size: 14px;
    color: #555;
    }

    .arrow-left {
    font-size: 24px; /* Adjust size */
    color:rgb(255, 255, 255); /* Adjust color */
    cursor: pointer; /* Makes it look clickable */
}

/* .arrow-left:hover {
    color: #0056b3; /* Change color on hover */
} */

</style>