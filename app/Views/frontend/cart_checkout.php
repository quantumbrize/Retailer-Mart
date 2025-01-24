<main class="main checkout">
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb shop-breadcrumb bb-no">
                <li class="passed"><a>Shopping Cart</a></li>
                <li class="active"><a>Checkout</a></li>
                <li><a>Order Complete</a></li>
            </ul>
        </div>
    </nav>
    <div class="page-content">
        <div class="container">
            <div class="coupon-content mb-4">
                <p>If you have a coupon code, please apply it below.</p>
                <div class="input-wrapper-inline">
                    <input type="text" name="coupon_code" class="form-control form-control-md mr-1 mb-2"
                        placeholder="Coupon code" id="coupon_code">
                    <button type="submit" class="btn button btn-rounded btn-coupon mb-2" name="apply_coupon"
                        value="Apply coupon">Apply Coupon</button>
                </div>
            </div>
            <div class="form checkout-form">
                <div class="row mb-9">
                    <div class="col-lg-7 pr-lg-4 mb-4">
                        <ul class="nav nav-tabs" id="addressTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="billing-tab" data-value="personal" data-toggle="tab" href="#billing" role="tab" aria-controls="billing" aria-selected="true">Personal Address</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="business-tab" data-value="business" data-toggle="tab" href="#business" role="tab" aria-controls="business" aria-selected="false">Want To Get Gst Claim</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="addressTabsContent">
                            <div class="tab-pane fade show active" id="billing" role="tabpanel" aria-labelledby="billing-tab">
                                <h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
                                    Billing Details
                                </h3>
                                <div class="row gutter-sm">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Name *</label>
                                            <input type="text" class="form-control form-control-md" name="billinginfo-name"
                                                id="billinginfo-name" placeholder="Enter your full name" required="">
                                            <span style="color:red" id="name_val"></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Phone *</label>
                                            <input type="text" class="form-control form-control-md" name="billinginfo-phone"
                                                id="billinginfo-phone" maxlength="10" placeholder="Enter your 10 digit number" required="">
                                            <span style="color:red" id="number_val"></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="form-group mb-7">
                                            <label>Email address *</label>
                                            <input type="email" class="form-control form-control-md" name="billinginfo-email"
                                                id="billinginfo-email" placeholder="Enter your email" required="">
                                            <span style="color:red" id="email_val"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gutter-sm">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>House / Flat No .</label>
                                            <input type="text" class="form-control form-control-md" name="billinginfo-city"
                                                id="billinginfo-hsNo" placeholder="Enter your house / flat No." required="">
                                            <span style="color:red" id="city_val"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City / Village </label>
                                            <input type="text" class="form-control form-control-md" name="billinginfo-city"
                                                id="billinginfo-city" placeholder="Enter your city / village" required="">
                                            <span style="color:red" id="city_val"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>District *</label>
                                            <input type="text" class="form-control form-control-md" name="billinginfo-district"
                                                id="billinginfo-district" placeholder="Enter your district" required="">
                                            <span style="color:red" id="district_val"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ZIP *</label>
                                            <input type="text" class="form-control form-control-md" name="billinginfo-zip" maxlength="6"
                                                id="billinginfo-zip" placeholder="Enter your zip code" required="">
                                            <span style="color:red" id="zip_val"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Land mark / Street Address *</label>
                                        <input type="text" class="form-control form-control-md" name="billinginfo-locality"
                                            id="billinginfo-locality" placeholder="Enter your land mark / street address" required="">
                                        <span style="color:red" id="locality_val"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>State *</label>
                                            <input type="text" class="form-control form-control-md" name="billinginfo-state"
                                                id="billinginfo-state" placeholder="Enter your state" required="">
                                            <span style="color:red" id="state_val"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country *</label>
                                            <input type="text" class="form-control form-control-md" name="billinginfo-country"
                                                id="billinginfo-country" placeholder="Enter your country" required="">
                                            <span style="color:red" id="country_val"></span>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success" id="update_profile">Update</button>
                            </div>
                            <div class="tab-pane fade" id="business" role="tabpanel" aria-labelledby="business-tab">
                                <h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
                                    Business Address
                                </h3>
                                <div class="row gutter-sm">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Business Name *</label>
                                            <input type="text" class="form-control form-control-md" name="businessinfo-name"
                                                id="businessinfo-name" placeholder="Enter your business name" required="">
                                            <span style="color:red" id="business_name_val"></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Business Phone *</label>
                                            <input type="text" class="form-control form-control-md" name="businessinfo-phone"
                                                id="businessinfo-phone" placeholder="Enter your business phone" required="">
                                            <span style="color:red" id="business_phone_val"></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="form-group mb-7">
                                            <label>Business Email *</label>
                                            <input type="email" class="form-control form-control-md" name="businessinfo-email"
                                                id="businessinfo-email" placeholder="Enter your business email" required="">
                                            <span style="color:red" id="business_email_val"></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="form-group mb-7">
                                            <label>GST Number *</label>
                                            <input type="text" class="form-control form-control-md" name="businessinfo-gst"
                                                id="businessinfo-gst" placeholder="Enter your business gst" required="">
                                            <span style="color:red" id="business_gst_val"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gutter-sm">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Business Address *</label>
                                            <input type="text" class="form-control form-control-md" name="businessinfo-address"
                                                id="businessinfo-address" placeholder="Enter your business address" required="">
                                            <span style="color:red" id="business_address_val"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ZIP *</label>
                                            <input type="text" class="form-control form-control-md" name="businessinfo-zip"
                                                id="businessinfo-zip" placeholder="Enter your business zip code" required="">
                                            <span style="color:red" id="business_zip_val"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Landmark / Street Address *</label>
                                        <input type="text" class="form-control form-control-md" name="businessinfo-landmark"
                                            id="businessinfo-landmark" placeholder="Enter your business landmark / street address" required="">
                                        <span style="color:red" id="business_landmark_val"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Goods Name *</label>
                                            <input type="text" class="form-control form-control-md" name="businessinfo-goodsname"
                                                id="businessinfo-goodsname" placeholder="Enter your goods name" required="">
                                            <span style="color:red" id="business_goodsname_val"></span>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success" id="update_bussness_address">Update</button>
                            </div>
                        </div>
                        <!-- <button class="btn btn-success" id="update_bussness_address">Update</button> -->
                    </div>
                    <div class="col-lg-5 mb-4 sticky-sidebar-wrapper">
                        <div class="order-summary-wrapper sticky-sidebar">
                            <h3 class="title text-uppercase ls-10">Your Order</h3>
                            <div class="order-summary">
                                <table class="order-table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <b>Product</b>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="cart_item">
                                        <tr class="cart-subtotal bb-no">
                                            <td>
                                                <b>Subtotal</b>
                                            </td>
                                            <td>
                                                <b>₹0.00</b>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr class="shipping-methods">
                                            <td colspan="2" class="text-left">
                                                <ul id="shipping-method" class="mb-4">
                                                    <table class="order-table">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="2">
                                                                    <b>Shipping</b>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="bb-no">
                                                                <td class="product-name">Shipping</td>
                                                                <td class="product-total" id="delivary_charge">₹0.00
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>
                                                <b>Total</b>
                                            </th>
                                            <td>
                                                <b id="grand_total">₹0.00</b>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                </table>



                                <div class="form-group place-order pt-6">
                                    <button type="button" id="place_order_btn"
                                        class="btn btn-dark btn-block btn-rounded">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of PageContent -->
</main>
<!-- End of Main -->



<style>
    .checkout .form-control  {
        border-color: black;
    }
</style>

<script>
    $(document).ready(function() {
        $('#addressTabs a').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>