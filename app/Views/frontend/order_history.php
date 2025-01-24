

    <!-- <a href="../backend/index.html" class="btn btn-warning position-fixed bottom-0 start-0 m-5 z-3 btn-hover d-none d-lg-block"><i class="bi bi-database align-middle me-1"></i> Backend</a> -->

    <!--start back-to-top-->
    <!-- <button onclick="topFunction()" class="btn btn-info btn-icon" style="bottom: 50px;" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button> -->
    <!--end back-to-top-->


    <section class="section">
        <div class="container">
            <a class="btn btn-danger mb-5 mt-2" href="<?=base_url('/order/returns')?>">My Returns <i class="ri-arrow-right-line align-middle ms-1"></i></a>
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <div class="table-responsive">
                            <table class="table fs-15 align-middle table-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="orders_tb_body">
                                   
                                </tbody>
                            </table>
                        </div>
                        <div class="text-end">
                            <a href="<?= base_url()?>" class="btn btn-hover btn-primary mb-2">Continue Shopping <i class="ri-arrow-right-line align-middle ms-1"></i></a>
                        </div>
                    </div>
                </div><!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end conatiner-->
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalInvoice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Invoice</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
            <iframe src="" frameborder="0" id="invoice_pdf" width="100%" height="800px" style="border: 1px solid #ccc;"></iframe>
        </div>
        <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div> -->
        </div>
    </div>
    </div>


   