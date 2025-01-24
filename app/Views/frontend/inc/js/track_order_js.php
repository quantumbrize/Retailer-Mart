<script>
    lode_order();



    function lode_order() {
        $.ajax({
            url: '<?= base_url('/api/order') ?>',
            type: 'GET',
            data: {
                o_id: '<?= $_GET['o_id'] ?>'
            },
            beforeSend: function () { },
            success: function (resp) {
                console.log('order',resp)
                if (resp.status) {
                    let order = resp.data
                    var dateString = order.created_at;
                    // Parse the date string into a Date object
                    var date = new Date(dateString);
                    // Options for formatting the date
                    var options = {
                        year: 'numeric',
                        month: 'long',
                        day: '2-digit',
                        hour12: false, // Display hours in 24-hour format
                        timeZone: 'Asia/Kolkata' // Set time zone to Indian Standard Time (IST)
                    };
                    // Format the date in IST as "01 Jan, 2023"
                    var formattedDate = date.toLocaleString('en-IN', options);
                    var formattedDateTimestamp = date.getTime();
                    // Get current timestamp
                    var currentTimestamp = new Date().getTime();
                    // Calculate the difference in milliseconds
                    var timeDifference = currentTimestamp - formattedDateTimestamp;
                    // Convert milliseconds to seconds
                    var secondsDifference = Math.floor(timeDifference / 1000);
                    // Convert seconds to minutes
                    var minutesDifference = Math.floor(secondsDifference / 60);
                    // Convert minutes to hours
                    var hoursDifference = Math.floor(minutesDifference / 60);
                    // Convert hours to days
                    var daysDifference = Math.floor(hoursDifference / 24);


                    if (order.order_status == 'delivered') {
                        if (daysDifference <= 10) {
                            $('#return_cancel_bx').html(`<a href="<?= base_url('/order/return?o_id=' . $_GET['o_id']) ?>" class="btn btn-warning">Return Order</a>`)
                        }
                    } else {
                        if (hoursDifference <= 24) {
                            $('#return_cancel_bx').html(`<a href="<?= base_url('/order/cancel?o_id=' . $_GET['o_id']) ?>" class="btn btn-danger">Cancel Order</a>`)
                        }
                    }

                    $('#order_details_bx').html(`<div class="col-lg-3 col-6">
                            <p class="text-muted mb-2 text-uppercase fw-medium fs-12">Order ID</p>
                            <h5 class="fs-14 mb-0"><span id="invoice-no">${order.order_id}</span></h5>
                        </div>
                        <div class="col-lg-3 col-6">
                            <p class="text-muted mb-2 text-uppercase fw-medium fs-12">Date</p>
                            <h5 class="fs-14 mb-0"><span id="invoice-date">${formattedDate}</sapn></h5>
                        </div>
                        <div class="col-lg-3 col-6">
                            <p class="text-muted mb-2 text-uppercase fw-medium fs-12">Payment Status</p>
                            <span class="bg-warning-subtle fw-100 text-success">PAID</span>
                        </div>
                        <div class="col-lg-3 col-6">
                            <p class="text-muted mb-2 text-uppercase fw-medium fs-12">Total Amount</p>
                            <h5 class="fs-14 mb-0">₹<span id="total-amount">${order.total}</span></h5>
                        </div>`)

                    let product_html = ``
                    let total_discount = 0
                    let delivery_charge = 0
                    $.each(order.products, function (index, item) {
                        let actual_price = ''
                        $.each(item.product_details.product_prices, function (index, prices) {
                            // console.log(prices)
                            if (parseInt(item.qty) >= parseInt(prices.min_qty) && parseInt(item.qty) <= parseInt(prices.max_qty)) {
                                actual_price = prices.price
                                // subTotal += parseInt(actual_price) * parseInt(item.qty)
                            }

                        })
                        // let actual_price = item.product_details.base_price; // Base price of the product
                        let qty = item.qty; // Quantity of the product
                        let base_discount = parseInt(item.product_details.base_discount); // Discount percentage
                        let tax = parseInt(item.product_details.tax); // Tax percentage
                        let discounted_price = actual_price * qty - ((actual_price * qty) * base_discount / 100);
                        console.log(actual_price)
                        let tax_amount = discounted_price * tax / 100;
                        let final_price = discounted_price + tax_amount;
                        delivery_charge += parseInt(item.product_details.delivery_charge)

                        
                        // console.log(item)
                         let img_link = item.product_config_id ? '/public/uploads/variant_images/' : '/public/uploads/product_images/'
                         let product_img = item.product_details.product_img.length > 0 ? '<?= base_url() ?>'+img_link+item.product_details.product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                        let returnBtn = ``
                        if (order.order_status == 'delivered') {
                            if (daysDifference <= 10) {
                                returnBtn = `<a 
                                                href="<?= base_url('/order/item/return?o_id=' . $_GET['o_id']) . '&p_id=' ?>${item.product_id}"
                                                class="btn btn-warning">
                                                Return Product
                                            </a>`
                            }
                        }
                        product_html += `<tr>
                                    <th scope="row">${index + 1}</th>
                                    <td class="text-start">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar-sm flex-shrink-0">
                                                <div class="avatar-title bg-secondary-subtle rounded-3">
                                                    <img 
                                                        src="${product_img}" 
                                                        alt="" 
                                                        class="avatar-xs">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6>${item.product_details.name.length > 45 ? item.product_details.name.substring(0, 45) + "..." : item.product_details.name}</h6>
                                                <p class="text-muted mb-0">${item.product_details.category}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">${returnBtn}</td>
                                    <td>₹ ${actual_price}</td>
                                    <td>${item.size}</td>
                                    <td>${item.qty}</td>
                                    <td>${item.product_details.base_discount}%</td>
                                    <td>${item.product_details.tax}%</td>
                                    <td class="text-end">₹${final_price.toFixed(2)}</td>
                                </tr>`
                                total_discount += parseInt(item.product_details.base_discount, 10);
                    })
                    $('#products-list').html(product_html)
                    $('#order_amount_dtls_bx').html(`<tr>
                                                        <td>Sub Total</td>
                                                        <td class="text-end"> ₹ ${parseFloat(order.sub_total).toFixed(2)}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping Charge</td>
                                                        <td class="text-end">₹ ${delivery_charge}</td>
                                                    </tr>
                                                    <tr class="border-top border-top-dashed fs-15">
                                                        <th scope="row">Total Amount</th>
                                                        <th class="text-end">₹ ${parseFloat(order.total).toFixed(2)}</th>
                                                    </tr>`)
                    $('#address_bx').html(` <h6 class="text-muted text-uppercase fs-12 mb-3">Billing Address</h6>
                                            <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                                                <li class="fw-medium fs-14"><b>Name : </b>${order.user_name}</li>
                                                <li><b>Phone : </b>${order.phone_number}</li>
                                                <li><b>Address : </b>${order.address.locality},  ${order.address.city}, ${order.address.district}, ${order.address.state} , ${order.address.country}</li>
                                                <li><b>PIN : </b>${order.address.zipcode}</li>
                                            </ul>`)
                    $('#order_track').html(`<div class="col-md-2 order-tracking text-start text-md-center ps-4 ps-md-0 ${
                                                order.order_status == 'placed' || 
                                                order.order_status == 'confirmed' ||
                                                order.order_status == 'shipped' ||
                                                order.order_status == 'delivered' 
                                                ? 'completed' : ''} ">
                                                <span class="is-complete"></span>
                                                <h6 class="fs-15 mt-3 mt-md-4">Order Process</h6>
                                            </div>
                                            <div class="col-md-2 order-tracking text-start text-md-center ps-4 ps-md-0 ${
                                                order.order_status == 'confirmed' ||
                                                order.order_status == 'shipped' ||
                                                order.order_status == 'delivered' 
                                                ? 'completed' : ''}">
                                                <span class="is-complete"></span>
                                                <h6 class="fs-15 mt-3 mt-md-4">Order Shipped</h6>
                                            </div>
                                            <div class="col-md-2 order-tracking text-start text-md-center ps-4 ps-md-0 ${
                                                order.order_status == 'shipped' ||
                                                order.order_status == 'delivered' 
                                                ? 'completed' : ''}"> 
                                                <span class="is-complete"></span>
                                                <h6 class="fs-15 mt-3 mt-md-4">Out Of Delivery</h6>
                                            </div>
                                            <div class="col-md-2 order-tracking text-start text-md-center ps-4 ps-md-0 ${
                                                order.order_status == 'delivered' 
                                                ? 'completed' : ''}">
                                                <span class="is-complete"></span>
                                                <h6 class="fs-15 mt-3 mt-md-4">Delivered</h6>
                                            </div>`)

                }

            },
            error: function (err) {
                console.error(err)
            }

        })

    }



</script>