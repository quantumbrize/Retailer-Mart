<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Products</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-xl-12 col-lg-12">
                <div>
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="row g-4">
                                <!-- <div class="col-sm-auto">
                                    <div>
                                        <a href="<?= base_url('/admin/product/add') ?>" class="btn btn-success"
                                            id="addproduct-btn">
                                            <i class="ri-add-line align-bottom me-1"></i>
                                            AddProduct
                                        </a>
                                    </div>
                                </div> -->
                                <div class="col-sm-auto">
                                    <div>
                                        <a href="<?= base_url('/admin/product/bulk/add') ?>" class="btn btn-success"
                                            id="addproduct-btn">
                                            <i class="ri-add-line align-bottom me-1"></i>
                                            Add Product
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div>
                                        <a href="<?= base_url('/admin/product/bulk/edit') ?>" class="btn btn-success"
                                            id="addproduct-btn">
                                            <i class="ri ri-edit-line"></i>
                                            Edit Product
                                        </a>
                                    </div>
                                </div><div class="col-sm-auto">
                                    <div>
                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            id="addproduct-btn">
                                            <i class="ri-add-line align-bottom me-1"></i>
                                            Upload Excel
                                        </button>
                                    </div>
                                </div>
                                <div class="col-sm" style="display: none;">
                                    <div class="d-flex justify-content-sm-end">
                                        <div class="search-box ms-2">
                                            <input type="text" class="form-control" id="searchProductList"
                                                placeholder="Search Products...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active fw-semibold" data-bs-toggle="tab"
                                                href="#productnav-all" role="tab">
                                                All <span id="all_product_count"
                                                    class="badge bg-danger-subtle text-danger align-middle rounded-pill ms-1"></span>
                                            </a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link fw-semibold" data-bs-toggle="tab"
                                                href="#productnav-published" role="tab">
                                                Published <span 
                                                    class="badge bg-danger-subtle text-danger align-middle rounded-pill ms-1">0</span>
                                            </a>
                                        </li> -->
                                        <!-- <li class="nav-item">
                                            <a class="nav-link fw-semibold" data-bs-toggle="tab"
                                                href="#productnav-draft" role="tab">
                                                Draft<span 
                                                    class="badge bg-danger-subtle text-danger align-middle rounded-pill ms-1">0</span>
                                            </a>
                                        </li> -->
                                    </ul>
                                </div>
                                <div class="col-auto">
                                    <div id="selection-element">
                                        <div class="my-n1 d-flex align-items-center text-muted">
                                            Select <div id="select-content" class="text-body fw-semibold px-1"></div>
                                            Result <button type="button"
                                                class="btn btn-link link-danger p-0 ms-3 material-shadow-none"
                                                data-bs-toggle="modal" data-bs-target="#removeItemModal">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card header -->
                        <div class="card-body">

                            <div class="tab-content text-muted">
                                <div class="row">
                                    <div class="col-md-4 d-flex align-items-start gap-2">
                                        <div class="d-flex flex-column">
                                            <select class="form-control product-category-list" onChange="get_sub_category()" name="product-category" id="product-category"></select>
                                            <input type="hidden" id="selected-cat-name">
                                            <p class="mb-0">
                                                Selected Category:- <b id="selected-category"></b>
                                                <!-- <i class="fas fa-redo" style="color: red" onclick="reset_category()"></i> -->
                                            </p>
                                        </div>
                                        
                                        <button class="btn btn-primary" onclick="reset_category()"><i class="fas fa-redo"  ></i></button>
                                        <!-- <button class="btn btn-primary" onclick="update_category()" id="update_product_category">+Add</button> -->
                                        <button class="btn btn-primary" id="update_product_category">+Add</button>
                                    </div>

                                    <!-- <div class="col-md-3 d-flex align-items-center gap-2">
                                        <select class="form-control" name="" id=""></select>
                                        <button class="btn btn-primary">+Add</button>
                                    </div> -->
                                </div>
                                <div class="tab-pane active" id="productnav-all" role="tabpanel">

                                    <table id="table-product-list-all" class="table nowrap align-middle table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Product</th>
                                                <th>Category</th>
                                                <th>Publish date</th>
                                                <th>Price</th>
                                                <th>Visibility</th>
                                                <!-- <th>Stock</th> -->
                                                <th>Created by</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-product-list-all-body">
                                            
                                        </tbody>
                                    </table>

                                </div>
                                <!-- end tab pane -->

                                <!-- <div class="tab-pane" id="productnav-published" role="tabpanel">
                                    <div id="table-product-list-published" class="table-card gridjs-border-none"></div>
                                </div> -->
                                <!-- end tab pane -->

                                <!-- <div class="tab-pane" id="productnav-draft" role="tabpanel">
                                    <div class="py-4 text-center">
                                        <h5 class="mt-4">Sorry! No Result Found</h5>
                                    </div>
                                </div> -->
                                <!-- end tab pane -->
                            </div>
                            <!-- end tab content -->

                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
    <!-- container-fluid -->
</div>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Excel / CSV File *</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="file" name="excel_file" id="excel_file" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" id="excel_upload_btn" onclick="upload_excel_file()" class="btn btn-primary">Upload</button>
      </div>
    </div>
  </div>
</div>