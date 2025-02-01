<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Create Product</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                            <li class="breadcrumb-item active">Create Product</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div id="createproduct-form">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Product Title</label>
                                <input type="hidden" class="form-control" id="formAction" name="formAction" value="add">
                                <input type="text" class="form-control d-none" id="product-id-input">
                                <input type="text" class="form-control" id="product-title-input" value=""
                                    placeholder="Enter product title" required="">
                                <div class="invalid-feedback">Please Enter a product title.</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Batch Id</label>
                                <input type="text" class="form-control" id="product-batch-id" value=""
                                    placeholder="Enter batch id" required="">
                                <div class="invalid-feedback">Please Enter a batch id.</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Generic Name</label>
                                <input type="text" class="form-control" id="product-generic-name" value=""
                                    placeholder="Enter generic name" required="">
                                <div class="invalid-feedback">Please Enter a generic name.</div>
                            </div>
                            <div>
                                <label>Product Description</label>

                                <div id="ckeditor-classic">

                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <label class="form-label" for="product-image-input">Product Image</label>
                            <input type="file" id="file-input"  multiple>
                            <label for="file-input" id="btn_upload" class="btn btn-success">
                                <i class="fas fa-upload"></i> &nbsp; Select Product Image
                            </label>
                            <p id="num-of-files"></p>
                            <div id="images"></div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Company Name</label>
                                <input type="text" class="form-control" id="product-company-name" value=""
                                    placeholder="Enter company name" required="">
                                <div class="invalid-feedback">Please Enter company name.</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="product-expire-date-input">Expire Date</label>
                                <input type="date" class="form-control" id="product-expire-date" value=""
                                    placeholder="Enter expire date" required="">
                                <div class="invalid-feedback">Please Enter expire date.</div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-mb-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="product-title-input">Container Type (Optional)</label>
                                        <input type="text" class="form-control" id="product-container_type-name" value=""
                                            placeholder="Enter pcontainer type" required="">
                                        <div class="invalid-feedback">Please Enter container type.</div>
                                    </div>
                                </div>
                                <div class="col-mb-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="product-title-input">Flavour (Optional)</label>
                                        <input type="text" class="form-control" id="product-flavour-name" value=""
                                            placeholder="Enter flavour" required="">
                                        <div class="invalid-feedback">Please Enter flavour.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="card">
                        <div class="card-body">
                            <label class="form-label" for="product-image-input">Size Chart</label>
                            <input type="file" id="file-input2"  multiple>
                            <label for="file-input2" id="btn_upload" class="btn btn-success">
                                <i class="fas fa-upload"></i> &nbsp; Select Size Chart Image
                            </label>
                            <p id="num-of-files2"></p>
                            <div id="images2"></div>
                        </div>
                    </div> -->

                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-general-info"
                                        role="tab">
                                        General Info
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#addproduct-metadata" role="tab">
                                        Meta Data
                                    </a>
                                </li> -->
                            </ul>
                        </div>
                        <!-- end card header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-6 ">
                                        <div class="mb-3">
                                            <label class="form-label" for="product-price-input">MRP</label>
                                            <div class="input-group has-validation mb-3">
                                                <span class="input-group-text" id="product-mrp-addon">₹</span>
                                                <input type="number" class="form-control" id="product-mrp-input"
                                                    placeholder="Enter MRP" aria-label="Price"
                                                    aria-describedby="product-price-addon" required="">
                                                <div class="invalid-feedback">Please Enter a MRP.</div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="product-discount-input">Rate</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="product-rate-addon">₹</span>
                                                <input type="number" class="form-control" id="product-rate-input"
                                                    placeholder="Enter discount" aria-label="rate"
                                                    aria-describedby="product-rate-addon">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="manufacturer-name-input">Purchase Quantity</label>
                                                <input type="number" class="form-control" id="purchase-quantity-input"
                                                    placeholder="Enter purchase quantity">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="manufacturer-brand-input">Free Quantity</label>
                                                <input type="number" class="form-control" id="free-quantity-input"
                                                    placeholder="Enter free quantity">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    
                                    <!-- end row -->
                                </div>
                                <!-- end tab-pane -->

                                <div class="tab-pane" id="addproduct-metadata" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="meta-title-input">Meta title</label>
                                                <input type="text" class="form-control" placeholder="Enter meta title"
                                                    id="meta-title-input">
                                            </div>
                                        </div>
                                        <!-- end col -->

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="meta-keywords-input">Meta
                                                    Keywords</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter meta keywords" id="meta-keywords-input">
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->

                                    <div>
                                        <label class="form-label" for="meta-description-input">Meta Description</label>
                                        <textarea class="form-control" id="meta-description-input"
                                            placeholder="Enter meta description" rows="3"></textarea>
                                    </div>
                                </div>
                                <!-- end tab pane -->
                            </div>
                            <!-- end tab content -->
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                </div>
                <!-- end col -->

                <div class="col-lg-4">
                    <!-- <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Publish</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="choices-publish-status-input" class="form-label">Status</label>

                                <select class="form-select" id="choices-publish-status-input" data-choices=""
                                    data-choices-search-false="">
                                    <option value="published" selected="">Published</option>
                                    <option value="scheduled">Scheduled</option>
                                    <option value="draft">Draft</option>
                                </select>
                            </div>

                            <div>
                                <label for="choices-publish-visibility-input" class="form-label">Visibility</label>
                                <select class="form-select" id="choices-publish-visibility-input" data-choices=""
                                    data-choices-search-false="">
                                    <option value="public" selected="">Public</option>
                                    <option value="hidden">Hidden</option>
                                </select>
                            </div>
                        </div>
                    </div> -->
                    <!-- end card -->

                    <!-- <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Publish Schedule</h5>
                        </div>
                        <div class="card-body">
                            <div>
                                <label for="datepicker-publish-input" class="form-label">Publish Date & Time</label>
                                <input type="text" id="datepicker-publish-input" class="form-control"
                                    placeholder="Enter publish date" data-provider="flatpickr" data-date-format="d.m.y"
                                    data-enable-time="">
                            </div>
                        </div>
                    </div> -->

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Product Size</h5>
                        </div>
                        <!-- end card body -->
                        <div class="card-body">
                            <div>
                                <label for="datepicker-publish-input" class="form-label">Product Size</label>
                                <select class="form-select" id="product-size-list-input" name="product-size-list-input">

                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->

                    <!-- <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Product Categories</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-2"> <a href="#" class="float-end text-decoration-underline">Add
                                    New</a>Select product category</p>
                            <select class="form-select" id="choices-category-input" name="choices-category-input" onchange="get_sub_category()"
                                data-choices="" data-choices-search-false="">

                            </select>
                        </div>
                    </div> -->
                    <!-- end card -->

                    <div class="card" id="mainCategories">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Product Categories</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-2"> <a href="#" class="float-end text-decoration-underline"></a>Select product category</p>
                            <select class="form-select product-category-list" onchange="get_sub_category()" id="choices-category-input" name="choices-category-input"
                                data-choices="" data-choices-search-false="">

                            </select>
                            <input type="hidden" id="selected-cat-name">
                            <p class="mb-0">
                                Selected Category:- <b id="selected-category"></b>
                                <!-- <i class="fas fa-redo" style="color: red" onclick="reset_category()"></i> -->
                            </p>
                           <i class="fas fa-redo" onclick="reset_category()" ></i>
                        </div>
                        <!-- end card body -->
                    </div>

                    <!-- <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Keywords</h5>
                        </div>
                        <div class="card-body">
                            <div class="hstack gap-3 align-items-start">
                                <div class="flex-grow-1">
                                    <input class="form-control" data-choices="" data-choices-multiple-remove="true"
                                        placeholder="Enter keywords" type="text" value="" id="product-tags-input">
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- end card -->


                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div>
        <div class="text-start mb-3">
            <button class="btn btn-success w-sm" id="product_add_btn">Submit</button>
        </div>
    </div>
    <!-- container-fluid -->
</div>