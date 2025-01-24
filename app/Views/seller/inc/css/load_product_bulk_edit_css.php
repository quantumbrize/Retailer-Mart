<style>
    input{
        border: none !important;
        outline: none !important;
    }
    select{
        border: none !important;
        outline: none !important;
    }

    input,select:focus{
        border: 1px solid rgba(0, 0, 0, 1);
        /* outline: 1px solid rgba(0, 0, 0, 0.4); */
    }
    /* Modal styles */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 10000;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }


    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        /* Could be more or less, depending on screen size */
    }

    .modal button{
        /* width: -webkit-fill-available; */
    }

    .close-button {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close-button:hover,
    .close-button:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    body {
        font-family: Arial, sans-serif;
    }

    .container-fluid {
        padding: 20px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;

    }

    .table th,
    .table td {
        border: 1px solid #ddd;
        padding: 8px;
        background-color: #fff;
        border: 2px solid #dddddd;
        margin: 10px;

    }

    .table th {
        background-color: #f2f2f2;
    }

    input[type='text'],
    input[type='number'],
    select,
    textarea {
        width: 100%;
        padding: 8px;
    }

    button {
        padding: 10px 15px;
    }

    .description-editor {
        height: 100px;
        /* Set a fixed height for CKEditor */
    }

    .modal-content {
        padding: 20px;
        border: 1px solid #ccc;
        background-color: #fff;
        position: relative;
        display: flex;
        /* align-items: center; */
        justify-content: flex-start;
        /* flex-direction: column; */
        flex-wrap: wrap;
        /* width: 300px; */
        /* Adjust width as needed */
    }

    #imagePreviewContainer img {
        width: 200px;
        height: auto;
        margin: 5px;
    }

    #imageInput {
        margin: 20px 0px 20px 0px;
    }

    #imagePreviewContainer {
        margin-bottom: 20px;
    }

    /* CSS Subhankar */

    .image-container {
        position: relative;
        display: inline-block;
        margin: 10px;
    }

    .delete-button {
        position: absolute;
        top: 0px; 
        right: 0px;
        background-color: red;
        color: white;
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        font-size: 14px;
    }

    .product-image {
        max-height: 200px;
        max-width: 200px;
        display: block;
    }

    #imagePreviewContainer {
        width: 90%;
        position: relative;
        margin: auto;
        display: flex;
        justify-content: space-evenly;
        gap: 20px;
        flex-wrap: wrap;
    }

    .stock_number{
        padding: 0px 10px 0px 10px;
        width: 20px;
        box-sizing: content-box;
        border: none;
        outline: none;
        text-align: center;
    }
    tbody tr{
        transition: 50ms;
    }

    @media (min-width: 1024px) {
        .modal-content-stock{
            width: 29% !important;
            margin: 5% auto !important;
        }
    }

</style>