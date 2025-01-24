<style>
    @media screen and (max-width: 425px) {
        .order-tracking{
            display: flex !important;
            flex-direction: column !important;
            width: 51% !important; 
            
        }

        .is-complete{
            margin-left:0px !important;
            margin-right:0px !important;
        }

        .order-tracking::before{
           /* background-color: red !important; */
           right: -80% !important;
        }

        /* .order-tracking .is-complete {
            margin: 0 auto !important;
        } */
    }

    .status{
        border-radius: 5px !important; 
        height: fit-content !important;
        width: fit-content !important;
        color: #fff !important;
    }
    .avatar-title img{
        height: 100px;
        width: 100px;
        object-fit: contain;
        margin-right: 10px;
    }
    #con_btn{
        display: flex;
        align-items: center;
        justify-content: center;
        width: fit-content;
    }
</style>