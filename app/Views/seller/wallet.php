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
                        <div class="card card-animate">
                            <div class="card-body card-shadow">
                                <div class="d-flex align-items-end justify-content-between">
                                    <!-- <h4>Balance</h4> -->
                                    <h4 class="fs-22 fw-semibold ff-secondary text-center text-primary">
                                        <i class="fa-solid fa-wallet"></i>
                                        <span id="wallet_balance">00.00</span>
                                    </h4>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div>
                    <div class="col-lg-auto">
                        <!--here -->
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#withdrawalModal">
                            Request New Withdrawal
                        </button>
                        <a href="<?= base_url('/seller/withdrawl/history') ?>" class="btn btn-primary" >
                            Withdrawal History
                        </a>
                    </div>
                </div>
                <!--end row-->
            </div>
            <div class="card-body">
                <div class="table-responsive table-card mb-1 p-4">
                    <table class="table align-middle" id="wallet_history_table">
                        <thead class="table-light text-muted">
                            <tr>
                                <th>Id</th>
                                <th>Date</th>
                                <th>Credited</th>
                                <th>Debited</th>
                                <th>Closing Balance</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all" id="wallet_history_table_body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Withdrawal Modal -->
    <div class="modal fade" id="withdrawalModal" tabindex="-1" aria-labelledby="withdrawalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="withdrawalModalLabel">Request Withdrawal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="withdrawalForm">
                        <div class="mb-3">
                            <label for="withdrawalAmount" class="form-label">Enter Amount</label>
                            <input type="number" class="form-control" id="withdrawalAmount" name="amount"
                                placeholder="Enter amount to withdraw" required>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>