<script>
    lode_order();

    $('#order_status_select_bx').on('change', function () {

        // Get the selected value of the select box
        var order_status = $(this).val();
        $.ajax({
            url: "<?= base_url('/api/order/status/update') ?>",
            data: {
                order_status: order_status,
                o_id: "<?= $_GET['o_id'] ?>"
            },
            beforeSend: function () {

            },
            success: function (resp) {
                lode_order()
            },
            error: function (err) {
                console.error(err)
            }
        })


    })


    function lode_order() {
        $.ajax({
            url: '<?= base_url('/api/order') ?>',
            type: 'GET',
            data: {
                o_id: '<?= $_GET['o_id'] ?>'
            },
            beforeSend: function () { },
            success: function (resp) {
                console.log(resp)
                if (resp.status) {
                    let order = resp.data
                    $('#order_status_select_bx').val(order.order_status)
                    $('#user_bx').html(
                        `<li>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img 
                                                style="height: 50px; width: 50px; object-fit: contain; background: white;"  
                                                src="https://www.kindpng.com/picc/m/24-248253_user-profile-default-image-png-clipart-png-download.png" 
                                                alt="" 
                                                class="avatar-sm rounded material-shadow">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fs-14 mb-1">${order.user.user_name}</h6>
                                            <p class="text-muted mb-0">Customer</p>
                                        </div>
                                    </div>
                                </li>`)

                    if (order.address.type == 'primary') {
                        $('#user_addr_bx').html(`<ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                            <li class="fw-medium fs-14">${order.user_name}</li>
                            <li>Phone - ${order.phone_number}</li>
                            <li>Landmark - ${order.address.locality}</li>
                            <li>City - ${order.address.city}, Street Address - ${order.address.district}</li>
                            <li>State - ${order.address.state} , Country - ${order.address.country}</li>
                            <li>Postal Code - ${order.address.zipcode}</li>
                        </ul>`)
                    } else {
                        $('#user_addr_bx').html(`<ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                            <li class="fw-medium fs-14">User Name  - ${order.address.business_good_name}</li>
                            <li class="fw-medium fs-14">Business Name - ${order.address.business_name}</li>
                            <li>Phone - ${order.phone_number}</li>
                            <li>email - ${order.address.business_email}</li>
                            <li>address - ${order.address.business_address}</li>
                            <li>Postal Code - ${order.address.zipcode}</li>
                        </ul>`)
                    }


                    $('#order_id').html(order.order_id)
                    let html = ``
                    let delivery_charge = 0
                    let vendor_id = '<?= $_SESSION[SES_SELLER_ID] ?>'
                    $.each(order.products, function (index, item) {
                        console.log(item.status)

                        if (vendor_id == item.product_details.vendor_id) {
                            let actual_price = ''
                            $.each(item.product_details.product_prices, function (index, prices) {
                                // console.log(prices)
                                if (parseInt(item.qty) >= parseInt(prices.min_qty) && parseInt(item.qty) <= parseInt(prices.max_qty)) {
                                    actual_price = prices.price
                                }

                            })
                            let qty = item.qty; // Quantity of the product
                            let base_discount = parseInt(item.product_details.base_discount); // Discount percentage
                            let tax = parseInt(item.product_details.tax); // Tax percentage
                            let discounted_price = actual_price * qty - ((actual_price * qty) * base_discount / 100);
                            let tax_amount = discounted_price * tax / 100;
                            let final_price = discounted_price + tax_amount;
                            delivery_charge += parseInt(item.product_details.delivery_charge)

                             let img_link = item.product_config_id ? '/public/uploads/variant_images/' : '/public/uploads/product_images/'
                            let product_img = item.product_details.product_img.length > 0 ? '<?= base_url() ?>'+img_link+item.product_details.product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                            html += `    <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                        <img
                                                            style="height: 100%; width: 100%; object-fit: contain; background: white;"
                                                            src="${product_img}" 
                                                            alt="" 
                                                            class="img-fluid d-block">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h5 class="fs-15">
                                                            <a href="" class="link-primary">${item.product_details.name.substring(0, 25) + "..."}</a>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>₹ ${actual_price}</td>
                                            <td>${item.qty}</td>
                                            <td>${item.product_details.base_discount}%</td>
                                            <td>${item.product_details.tax}%</td>
                                            <td>
                                                <select class="form-select form-select-sm" onChange="change_order_item_status('${item.uid}')" id="status_slc_${item.uid}">
                                                    <option value="placed" ${item.status == 'placed' ? 'selected' : ''}>Placed</option>
                                                    <option value="confirmed" ${item.status == 'confirmed' ? 'selected' : ''}>Confirmed</option>
                                                    <option value="shipped" ${item.status == 'shipped' ? 'selected' : ''}>Shipped</option>
                                                    <option value="cancelled" ${item.status == 'cancelled' ? 'selected' : ''}>Cancelled</option>
                                                    <option value="delivered" ${item.status == 'delivered' ? 'selected' : ''}>Delivered</option>
                                                    <option value="returned" ${item.status == 'returned' ? 'selected' : ''}>Returned</option>
                                                </select>
                                            </td>
                                            <td class="fw-medium text-end">
                                                ₹ ${final_price.toFixed(2)}
                                            </td>
                                        </tr>`
                        }

                    })
                    // html += `<tr class="border-top border-top-dashed">
                    //             <td colspan="3"></td>
                    //             <td colspan="2" class="fw-medium p-0">
                    //                 <table class="table table-borderless mb-0">
                    //                     <tbody>
                    //                         <tr>
                    //                             <td>Sub Total :</td>
                    //                             <td class="text-end"> ₹ ${order.sub_total}</td>
                    //                         </tr>
                    //                       <tr>
                    //                           <td>Shipping Charge :</td>
                    //                           <td class="text-end">₹ ${delivery_charge}</td>
                    //                       </tr>
                    //                         <tr class="border-top border-top-dashed">
                    //                             <th scope="row">Total (INR) :</th>
                    //                             <th class="text-end">₹ ${parseInt(order.total)+parseInt(delivery_charge)}</th>
                    //                         </tr>
                    //                     </tbody>
                    //                 </table>
                    //             </td>
                    //         </tr>`
                    $('#product_table_body').html(html)

                }

            },
            error: function (err) {
                console.error(err)
            }

        })

    }

    function change_order_item_status(order_item_id) {


        $.ajax({
            url: "<?= base_url('/api/order/item/status/update') ?>",
            type: "GET",
            data: {
                order_item_id: order_item_id,
                status: $(`#status_slc_${order_item_id}`).val()
            },
            beforeSend: function () { },
            success: function (resp) {
                html = ''
                if (resp.status) {
                    html += `<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                <i class="ri-checkbox-circle-fill label-icon"></i>${resp.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`
                } else {
                    html += `<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - ${resp.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`
                }
                $('#alert').html(html)
            },
            error: function (err) {
                console.error(err)
            }
        })

    }












</script>