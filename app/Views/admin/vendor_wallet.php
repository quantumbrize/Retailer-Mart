<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Sellers</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                            <li class="breadcrumb-item active">Sellers</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="card">
            <div class="card-header border-0 rounded">
                <div class="row g-2" style="align-items: center;display: flex; justify-content: space-between;">
                    <div class="col-lg-auto">
                        <div class="hstack gap-2">
                            <a class="btn btn-success" href="<?= base_url('/admin/users/vendors') ?>">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-auto">
                        <div class="hstack gap-2">
                            <a class="btn btn-success position-relative"
                                href="<?= base_url('/admin/vendor/withdrawal/requests') ?>">
                                Withdrawals Requests
                                <span id="reqCount" class="badge badge-counter"></span>
                            </a>

                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
            <div class="card-body">
                <div class="table-responsive table-card mb-1 p-4">
                    <table class="table align-middle" id="wallet_table">
                        <thead class="table-light text-muted">
                            <tr>
                                <th>Id</th>
                                <th>Seller</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Balance</th>
                                <th>Wallet History</th>
                                <th>Withdrawal History</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all" id="wallet_table_body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>