<!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="page-content">
                <div class="container-fluid">

                    <div class="position-relative mx-n4 mt-n4">
                        <div class="profile-wid-bg profile-setting-img">
                            <img src="assets/images/profile-bg.jpg" class="profile-wid-img" alt="">
                            <div class="overlay-content">
                                <div class="text-end p-3">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xxl-3">
                            <div class="card mt-n5">
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4" id="profile_image">
                                            <!-- <img src="assets/images/users/avatar-1.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow" alt="user-profile-image"> -->
                                            <!-- <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body material-shadow">
                                                        <i class="ri-camera-fill"></i>
                                                    </span>
                                                </label>
                                            </div> -->
                                        </div>
                                        <h5 class="fs-16 mb-1" id="user_name"></h5>
                                        <p class="text-muted mb-0" id="user_role"></p>
                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                            
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="flex-grow-1">
                                            <h5 class="card-title mb-0">Hi Admin</h5>
                                        </div>
                                    </div>
                                    <!-- <div class="mb-3 d-flex">
                                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-body text-body material-shadow">
                                                <i class="ri-github-fill"></i>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control" id="gitUsername" placeholder="Username" value="@daveadame">
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-primary material-shadow">
                                                <i class="ri-global-fill"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="websiteInput" placeholder="www.example.com" value="www.velzon.com">
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-success material-shadow">
                                                <i class="ri-dribbble-fill"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="dribbleName" placeholder="Username" value="@dave_adame">
                                    </div>
                                    <div class="d-flex">
                                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-danger material-shadow">
                                                <i class="ri-pinterest-fill"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="pinterestName" placeholder="Username" value="Advance Dave">
                                    </div> -->
                                </div>
                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->
                        <div class="col-xxl-9">
                            <div class="card mt-xxl-n5">
                                <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                                <i class="fas fa-home"></i> Bank Details
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body p-4">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                            <form action="javascript:void(0);">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Registered User Name</label>
                                                            <input type="text" class="form-control" id="name_val">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">IFSC Code</label>
                                                            <input type="text" class="form-control" id="ifsc_val">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="phonenumberInput" class="form-label">Account Number</label>
                                                            <input type="text" class="form-control" id="acc_val">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <input type="hidden" class="form-control" id="userId">
                                                </div>
                                                <!--end row-->
                                                <div class="col-lg-12">
                                                    <div class="text-end">
                                                        <button type="submit" id="update_profile" class="btn btn-success"><i class="ri-edit-box-line align-middle me-2"></i> Update Profile</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div>
                <!-- container-fluid -->
            </div><!-- End Page-content -->
        <!-- end main content-->