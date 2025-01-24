<script>
    function loadwishlist() {
        window.location.href = '<?= base_url(' / wishlist') ?>';

    }

</script>
<!-- Start of Main -->
<main class="main">
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">My Account</h1>
        </div>
    </div>
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <!-- <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="home.html">Home</a></li>
                        <li>My account</li>
                    </ul>
                </div> -->
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of PageContent -->
    <div class="page-content pt-2">
        <div class="container">
            <div class="tab tab-vertical row gutter-lg">
                <ul class="nav nav-tabs mb-6" role="tablist">
                    <!-- <li class="nav-item">
                        <a href="#account-dashboard" class="nav-link">Dashboard</a>
                    </li> -->
                    <li class="nav-item">
                        <a href="#account-details" class="nav-link account-details-bar active">Account details</a>
                    </li>
                    <li class="nav-item">
                        <a href="#account-addresses" class="nav-link account-address-bar">Addresses</a>
                    </li>
                    <li onclick="loadwishlist()" class="link-item">
                        <a class="nav-link">Wishlist</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" onclick="window.location.href='<?= base_url('order/history') ?>'"
                            class="nav-link">Orders</a>
                    </li>
                    <!-- <li class="nav-item">
                                <a href="#account-downloads" class="nav-link">Downloads</a>
                            </li> -->
                    <li class="link-item">
                        <a href="javascript:void(0)" onclick="logout()" class="nav-link">Logout</a>
                    </li>
                </ul>

                <div class="tab-content mb-6">
                    <div class="tab-pane in" id="account-dashboard">
                        <p class="greeting">
                            Hello
                            <span id="logggedin_name" class="text-dark font-weight-bold"></span>
                            <!-- (not
                            <span class="text-dark font-weight-bold">John Doe</span>?
                            <a href="#" class="text-primary">Log out</a>) -->
                        </p>

                        <!-- <p class="mb-4">
                            From your account dashboard you can view your <a href="#account-orders"
                                class="text-primary link-to-tab">recent orders</a>,
                            manage your <a href="#account-addresses" class="text-primary link-to-tab">shipping
                                and billing
                                addresses</a>, and
                            <a href="#account-details" class="text-primary link-to-tab">edit your password and
                                account details.</a>
                        </p> -->

                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                <a href="#account-orders" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-orders">
                                            <i class="w-icon-orders"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">Orders</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                <a href="#account-downloads" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-download">
                                            <i class="w-icon-download"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">Downloads</p>
                                        </div>
                                    </div>
                                </a>
                            </div> -->
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                <a href="#account-addresses" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-address">
                                            <i class="w-icon-map-marker"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">Addresses</p>
                                        </div>

                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                <a href="#account-details" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-account">
                                            <i class="w-icon-user"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">Account Details</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                <a href="wishlist.html" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-wishlist">
                                            <i class="w-icon-heart"></i>
                                        </span>
                                        <a class="icon-box-content" href="<?= base_url('/wishlist') ?>">

                                            <p class="text-uppercase mb-0">Wishlist</p>


                                        </a>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                <a href="javascript:void(0)" onclick="logout()">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-logout">
                                            <i class="w-icon-logout"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">Logout</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane mb-4" id="account-orders">
                        <div class="icon-box icon-box-side icon-box-light">
                            <span class="icon-box-icon icon-orders">
                                <i class="w-icon-orders"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title text-capitalize ls-normal mb-0">Orders</h4>
                            </div>
                        </div>

                        <table class="shop-table account-orders-table mb-6">
                            <thead>
                                <tr>
                                    <th class="order-id">Order</th>
                                    <th class="order-date">Date</th>
                                    <th class="order-status">Status</th>
                                    <th class="order-total">Total</th>
                                    <th class="order-actions">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="order-id">#2321</td>
                                    <td class="order-date">August 20, 2021</td>
                                    <td class="order-status">Processing</td>
                                    <td class="order-total">
                                        <span class="order-price">$121.00</span> for
                                        <span class="order-quantity"> 1</span> item
                                    </td>
                                    <td class="order-action">
                                        <a href="#"
                                            class="btn btn-outline btn-default btn-block btn-sm btn-rounded">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="order-id">#2321</td>
                                    <td class="order-date">August 20, 2021</td>
                                    <td class="order-status">Processing</td>
                                    <td class="order-total">
                                        <span class="order-price">$150.00</span> for
                                        <span class="order-quantity"> 1</span> item
                                    </td>
                                    <td class="order-action">
                                        <a href="#"
                                            class="btn btn-outline btn-default btn-block btn-sm btn-rounded">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="order-id">#2319</td>
                                    <td class="order-date">August 20, 2021</td>
                                    <td class="order-status">Processing</td>
                                    <td class="order-total">
                                        <span class="order-price">$201.00</span> for
                                        <span class="order-quantity"> 1</span> item
                                    </td>
                                    <td class="order-action">
                                        <a href="#"
                                            class="btn btn-outline btn-default btn-block btn-sm btn-rounded">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="order-id">#2318</td>
                                    <td class="order-date">August 20, 2021</td>
                                    <td class="order-status">Processing</td>
                                    <td class="order-total">
                                        <span class="order-price">$321.00</span> for
                                        <span class="order-quantity"> 1</span> item
                                    </td>
                                    <td class="order-action">
                                        <a href="#"
                                            class="btn btn-outline btn-default btn-block btn-sm btn-rounded">View</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <a href="shop-banner-sidebar.html" class="btn btn-dark btn-rounded btn-icon-right">Go
                            Shop<i class="w-icon-long-arrow-right"></i></a>
                    </div>

                    <div class="tab-pane" id="account-downloads">
                        <div class="icon-box icon-box-side icon-box-light">
                            <span class="icon-box-icon icon-downloads mr-2">
                                <i class="w-icon-download"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title ls-normal">Downloads</h4>
                            </div>
                        </div>
                        <p class="mb-4">No downloads available yet.</p>
                        <a href="shop-banner-sidebar.html" class="btn btn-dark btn-rounded btn-icon-right">Go
                            Shop<i class="w-icon-long-arrow-right"></i></a>
                    </div>

                    <div class="tab-pane" id="account-addresses">
                        <div class="icon-box icon-box-side icon-box-light">
                            <span class="icon-box-icon icon-map-marker">
                                <i class="w-icon-map-marker"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title mb-0 ls-normal">Addresses</h4>
                            </div>
                        </div>
                        <p>The following addresses will be used on the checkout page
                            by default.</p>
                        <div class="row">
                            <div class="col-sm-6 mb-6">
                                <div class="ecommerce-address billing-address pr-lg-8">
                                    <h4 class="title title-underline ls-25 font-weight-bold">Billing Address</h4>
                                    <address class="mb-4">
                                        <table class="address-table">
                                            <tbody class="billing_and_shipping_address">
                                                <!-- <tr>
                                                            <th>Name:</th>
                                                            <td>John Doe</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Company:</th>
                                                            <td>Conia</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Address:</th>
                                                            <td>Wall Street</td>
                                                        </tr>
                                                        <tr>
                                                            <th>City:</th>
                                                            <td>California</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Country:</th>
                                                            <td>United States (US)</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Postcode:</th>
                                                            <td>92020</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Phone:</th>
                                                            <td>1112223334</td>
                                                        </tr> -->
                                            </tbody>
                                        </table>
                                    </address>
                                    <a href="javascript:void(0)"
                                        class="btn btn-link btn-underline btn-icon-right text-primary edit-address">Edit
                                        your billing address<i class="w-icon-long-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-6">
                                <div class="ecommerce-address shipping-address pr-lg-8">
                                    <h4 class="title title-underline ls-25 font-weight-bold">Shipping Address</h4>
                                    <address class="mb-4">
                                        <table class="address-table">
                                            <tbody class="billing_and_shipping_address">
                                                <!-- <tr>
                                                            <th>Name:</th>
                                                            <td>John Doe</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Company:</th>
                                                            <td>Conia</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Address:</th>
                                                            <td>Wall Street</td>
                                                        </tr>
                                                        <tr>
                                                            <th>City:</th>
                                                            <td>California</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Country:</th>
                                                            <td>United States (US)</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Postcode:</th>
                                                            <td>92020</td>
                                                        </tr> -->
                                            </tbody>
                                        </table>
                                    </address>
                                    <a href="javascript:void(0)"
                                        class="btn btn-link btn-underline btn-icon-right text-primary edit-address">Edit
                                        your
                                        shipping address<i class="w-icon-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <style>
                        #user_img {
                            max-width: 20%;
                            height: auto;
                        }
                    </style>
                    <div class="tab-pane active" id="account-details">
                        <div class="icon-box icon-box-side icon-box-light">
                            <span class="icon-box-icon icon-account mr-2">
                                <i class="w-icon-user"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title mb-0 ls-normal">Account Details</h4>
                            </div>
                        </div>
                        <div class="form account-details-form" action="#" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class='form-group' id="userImage">
                                        <div>
                                            <label for="formGroupExampleInput2">Image</label>
                                        </div>
                                        <img src="https://usercontent.one/wp/www.vocaleurope.eu/wp-content/uploads/no-image.jpg?media=1642546813"
                                            height="1" id="user_img" />
                                    </div>
                                    <div class="form-group">
                                        <input type="file" class="form-control-file" placeholder="User Image"
                                            id="user_img_input" name="user_img[]" multiple />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstname">Full Name *</label>
                                        <input type="text" id="firstname" name="firstname" placeholder="Name"
                                            class="form-control form-control-md">
                                        <span style="color:red" id="name_val"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phonenumberInput">Phone No. *</label>
                                        <input type="text" id="phonenumberInput" name="phonenumberInput"
                                            placeholder="Phone" class="form-control form-control-md">
                                        <span style="color:red" id="number_val"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-6">
                                <label for="email_1">Email address *</label>
                                <input type="email" id="email_1" name="email_1" class="form-control form-control-md">
                                <span style="color:red" id="email_val"></span>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="firstname">City *</label>
                                        <input type="text" id="cityInput" name="cityInput" placeholder="City"
                                            class="form-control form-control-md">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phonenumberInput">Country *</label>
                                        <input type="text" id="countryInput" name="countryInput" placeholder="Country"
                                            class="form-control form-control-md">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phonenumberInput">Postal Code *</label>
                                        <input type="text" id="zipcodeInput" name="zipcodeInput" minlength="5"
                                            maxlength="6" placeholder="Doe" class="form-control form-control-md">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="firstname">District *</label>
                                        <input type="text" id="districtInput" name="districtInput"
                                            placeholder="District" class="form-control form-control-md">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phonenumberInput">State *</label>
                                        <input type="text" id="stateInput" name="stateInput" placeholder="State"
                                            class="form-control form-control-md">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phonenumberInput">Area & Landmark *</label>
                                        <input type="text" id="localityInput" name="localityInput"
                                            placeholder="Enter Area & Landmark" class="form-control form-control-md">
                                    </div>
                                </div>
                                <input type="hidden" id="user_id">
                            </div>

                            <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4" id="update_profile">Save
                                Changes</button>

                            <h4 class="title title-password ls-25 font-weight-bold">Password change</h4>
                            <div class="form-group">
                                <label class="text-dark" for="cur-password">Current Password leave blank to leave
                                    unchanged</label>
                                <input type="password" class="form-control form-control-md" id="oldpasswordInput"
                                    name="cur_password">
                                <span style="color:red" id="changeOldPass"></span>
                            </div>
                            <div class="form-group">
                                <label class="text-dark" for="new-password">New Password leave blank to leave
                                    unchanged</label>
                                <input type="password" class="form-control form-control-md" id="newpasswordInput"
                                    name="new_password">
                                <span style="color:red" id="changeNewPass"></span>
                            </div>
                            <div class="form-group mb-10">
                                <label class="text-dark" for="conf-password">Confirm Password</label>
                                <input type="password" class="form-control form-control-md" id="confirmpasswordInput"
                                    name="conf_password">
                                <span style="color:red" id="changeConfirmPass"></span>
                            </div>
                            <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4" id="change_password">Save
                                Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of PageContent -->
</main>
<!-- End of Main -->