<script>
     $('#is_auth').hide()
     $('#banks').hide()
    function isAuthSeller() {
        $.ajax({
            url: "<?= base_url('/api/user') ?>",
            type: "GET",
            data: {
                user_id: '<?= !empty($_SESSION['SELLER_user_id']) ? $_SESSION['SELLER_user_id'] : '' ?>'
            },
            success: function (resp) {
                // console.log(resp)
                if (resp.status) {
                    console.log(resp)
                    if (resp.user_data.is_auth == 'true') {
                        $('#is_auth').show()
                        $('#banks').hide()
                        // is_auth = true
                    } else {
                        $('#is_auth').hide()
                        $('#banks').show()

                        // is_auth = false

                    }

                } else {
                    console.log(resp)
                }
            },
            error: function (err) {
                console.log(err)
            },
        })
    }
    $(document).ready(function () {
        total_product()
        total_order()
        total_erning()
        // total_customer()
        best_selling()
        revenue()
        total_cancled()
        isAuthSeller();

    });

    function total_product() {
        $.ajax({
            url: "<?= base_url('/api/seller/products') ?>",
            type: "GET",
            beforeSend: function () {
                // $('#table-banner-list-all-body').html(`<tr >
                //         <td colspan="7"  style="text-align:center;">
                //             <div class="spinner-border" role="status"></div>
                //         </td>
                //     </tr>`)
            },
            success: function (resp) {
                // console.log(resp)
                if (resp.status) {
                    document.getElementById('product_counter').setAttribute('data-target', resp.data);
                } else {
                    document.getElementById('product_counter').setAttribute('data-target', resp.data);
                }

            },
            error: function (err) {
                console.log(err)
            },
            complete: function () {

            }
        })
    }

    function total_order() {
        $.ajax({
            url: "<?= base_url('/api/total/selling/item') ?>",
            type: "GET",
            beforeSend: function () {
                // $('#table-banner-list-all-body').html(`<tr >
                //         <td colspan="7"  style="text-align:center;">
                //             <div class="spinner-border" role="status"></div>
                //         </td>
                //     </tr>`)
            },
            success: function (resp) {
                console.log(resp.data['COUNT(*)'])
                if (resp.status) {
                    document.getElementById('order_counter').setAttribute('data-target', resp.data['COUNT(*)']);
                } else {
                    document.getElementById('order_counter').setAttribute('data-target', resp.data['COUNT(*)']);
                }

            },
            error: function (err) {
                console.log(err)
            },
            complete: function () {

            }
        })
    }

    function total_customer() {
        $.ajax({
            url: "<?= base_url('/api/total/customer') ?>",
            type: "GET",
            beforeSend: function () {
                // $('#table-banner-list-all-body').html(`<tr >
                //         <td colspan="7"  style="text-align:center;">
                //             <div class="spinner-border" role="status"></div>
                //         </td>
                //     </tr>`)
            },
            success: function (resp) {
                // console.log(resp)
                if (resp.status) {
                    document.getElementById('customer_counter').setAttribute('data-target', "");
                    document.getElementById('customer_counter').setAttribute('data-target', resp.data);
                } else {
                    document.getElementById('customer_counter').setAttribute('data-target', resp.data);
                }

            },
            error: function (err) {
                console.log(err)
            },
            complete: function () {

            }
        })
    }

    function total_erning() {
        $.ajax({
            url: "<?= base_url('/api/seller/earning') ?>",
            type: "GET",
            beforeSend: function () {
                // $('#table-banner-list-all-body').html(`<tr >
                //         <td colspan="7"  style="text-align:center;">
                //             <div class="spinner-border" role="status"></div>
                //         </td>
                //     </tr>`)
            },
            success: function (resp) {
                console.log(resp)
                if (resp.status) {
                    document.getElementById('erning_counter').setAttribute('data-target', "");
                    document.getElementById('erning_counter').setAttribute('data-target', resp.data);
                } else {
                    document.getElementById('erning_counter').setAttribute('data-target', resp.data);
                }

            },
            error: function (err) {
                console.log(err)
            },
            complete: function () {

            }
        })
    }

    function total_cancled() {
        $.ajax({
            url: "<?= base_url('/api/total/canclled/seller') ?>",
            type: "GET",
            beforeSend: function () {
                // $('#table-banner-list-all-body').html(`<tr >
                //         <td colspan="7"  style="text-align:center;">
                //             <div class="spinner-border" role="status"></div>
                //         </td>
                //     </tr>`)
            },
            success: function (resp) {
                console.log('cancle',resp)
                if (resp.status) {
                    document.getElementById('total_cancled').setAttribute('data-target', "");
                    document.getElementById('total_cancled').setAttribute('data-target', resp.data);
                } else {
                    document.getElementById('total_cancled').setAttribute('data-target', resp.data);
                }

            },
            error: function (err) {
                console.log(err)
            },
            complete: function () {

            }
        })
    }

    function best_selling() {
        $.ajax({
            url: '<?= base_url('/api/best-selling/item') ?>',
            type: "GET",
            beforeSend: function () {
                $('#table-best-selling-list-all-body').html(`<tr >
                        <td colspan="7"  style="text-align:center;">
                            <div class="spinner-border" role="status"></div>
                        </td>
                    </tr>`)
            },
            success: function (resp) {
                if (resp.status) {
                    let html = ''
                    console.log(resp)
                    $.each(resp.data, function (index, item) {

                        if (item.product_data != null) {
                            var original_price = item.product_data.base_discount ? (item.product_data.base_price - (item.product_data.base_price * item.product_data.base_discount / 100)).toFixed(2) : item.product_data.base_price.toFixed(2);
                            var base_price = item.product_data.base_discount ? item.product_data.base_discount : "";
                            var image = `https://usercontent.one/wp/www.vocaleurope.eu/wp-content/uploads/no-image.jpg?media=1642546813`
                            if (item.product_data.product_img != null) {
                                image = `<?= base_url('public/uploads/product_images/') ?>${item.product_data.product_img[0].src}`
                            }
                            html += `<tr>
                                            <td style="text-align: center;">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-light rounded p-1 me-2">
                                                        <img src="${image}" alt=""
                                                            class="img-fluid d-block" />
                                                    </div>
                                                    
                                                </div> 
                                                
                                            </td>
                                            <td style="text-align: center;">
                                                <p>${item.product_data.name.slice(0, 15) + (item.product_data.name.length > 15 ? '...' : '')}</p>
                                            </td>
                                            <td style="text-align: center;">
                                                ₹${original_price}
                                            </td>
                                            <td style="text-align: center;">
                                                ${item.total_qty}
                                            </td>
                                            <td style="text-align: center;">
                                                ${item.product_data.product_stock}
                                            </td>
                                            <td style="text-align: center;">
                                                ${(original_price * item.total_qty).toFixed(2)}
                                            </td>
                                            
                                        </tr>`
                        }

                    })

                    $('#table-best-selling-list-all-body').html(html)
                    $('#table-best-selling-list-all').DataTable();
                } else {
                    $('#table-best-selling-list-all-body').html(`<tr >
                        <td>
                            DATA NOT FOUND!
                        </td>
                    </tr>`)
                }
            },
            error: function (err) {
                console.log(err)
            }

        })

    }

    function revenue() {
        $.ajax({
            url: '<?= base_url('/api/seller/revenue') ?>',
            type: "GET",
            beforeSend: function () {
                $('#table-best-selling-list-all-body').html(`
                <tr>
                    <td colspan="7" style="text-align:center;">
                        <div class="spinner-border" role="status"></div>
                    </td>
                </tr>
            `);
            },
            success: function (resp) {
                console.log(resp);
                if (resp.status) {
                    const deliveredOrders = resp.data.delivered_orders;
                    const cancelledOrders = resp.data.cancelled_orders;

                    let earning = 0;
                    const monthlyOrder = Array(12).fill(0);
                    const monthlyEarning = Array(12).fill(0);
                    const monthlyRefunds = Array(12).fill(0);

                    // Process delivered orders
                    deliveredOrders.forEach(item => {
                        earning += parseFloat(item.total);
                        const month = new Date(item.created_at).getMonth(); // 0-11
                        monthlyOrder[month] += 1;
                        monthlyEarning[month] += parseFloat(item.total);
                    });

                    // Process cancelled orders
                    cancelledOrders.forEach(item => {
                        const month = new Date(item.created_at).getMonth(); // 0-11
                        monthlyRefunds[month] += 1; // Count refunds per month
                    });

                    // Chart data setup
                    const xValues = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
                    new Chart("myChart", {
                        type: "line",
                        data: {
                            labels: xValues,
                            datasets: [
                                {
                                    label: "Delivered Orders",
                                    data: monthlyOrder,
                                    borderColor: "red",
                                    fill: false
                                },
                                {
                                    label: "Refunds",
                                    data: monthlyRefunds,
                                    borderColor: "blue",
                                    fill: false
                                }
                            ]
                        },
                        options: {
                            legend: { display: true }
                        }
                    });

                    // Update DOM elements
                    document.getElementById('delivered_orders').textContent = deliveredOrders.length;
                    document.getElementById('cancelled_orders').textContent = cancelledOrders.length;
                    document.getElementById('total_earning').textContent = earning.toFixed(2);
                    document.getElementById('earning_counter').setAttribute('data-target', earning.toFixed(2));
                } else {
                    console.error("Response status is false:", resp);
                }
            },
            error: function (err) {
                console.error("Error fetching revenue data:", err);
            }
        });
    }

    $(document).ready(function () {
        // Initially show only Step 1
        $('#step1').show();
        $('#step2, #step3').hide();

        // Navigate to Step 2
        $('#goToStep2').on('click', function () {
            const name = $('#name_val').val().trim();
            const ifsc = $('#ifsc_val').val().trim();
            const account_number = $('#acc_val').val().trim();

            if (!name || !ifsc || !account_number) {
                Toastify({
                    text: 'Please fill all details.'.toUpperCase(),
                    duration: 2000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'red',
                    },
                }).showToast();
                return;
            }

            $('#step1').hide();
            $('#step2').show();
        });

        // Navigate to Step 3
        $('#goToStep3').on('click', function () {
            if (!$('#authImage').val()) {
                Toastify({
                    text: 'Please upload an image.'.toUpperCase(),
                    duration: 2000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'red',
                    },
                }).showToast();
                return;
            }

            $('#step2').hide();
            $('#step3').show();
        });

        // Enable Finish Button on Terms Acceptance
        $('#termsCheck').on('change', function () {
            $('#finishProcess').prop('disabled', !$(this).is(':checked'));
        });

        // Reset the entire form and steps
        function resetForm() {
            $('#step1').show();
            $('#step2, #step3').hide();
            $('#name_val, #ifsc_val, #acc_val, #authDescription').val('');
            $('#authImage').val('');
            $('#termsCheck').prop('checked', false);
            $('#finishProcess').prop('disabled', true).text('Finish');
        }

        // Final Submission After Terms and Conditions
        $('#finishProcess').on('click', function () {
            let user_id = '<?= !empty($_SESSION[SES_SELLER_USER_ID]) ? $_SESSION[SES_SELLER_USER_ID] : '' ?>';
            const name = $('#name_val').val();
            const ifsc = $('#ifsc_val').val();
            const account_number = $('#acc_val').val();
            const fileInput = $('#acc_check')[0].files[0]; // Get the uploaded file
            const formData = new FormData();

            // Append form fields to FormData
            formData.append('user_id', user_id);
            formData.append('user_name', name);
            formData.append('ifsc', ifsc);
            formData.append('account_number', account_number);

            // Append the file if uploaded
            if (fileInput) {
                formData.append('acc_check', fileInput);
            } else {
                Toastify({
                    text: 'Please upload the required blank check/passbook page.'.toUpperCase(),
                    duration: 2000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'red',
                    },
                }).showToast();
                return;
            }

            // Validate inputs for bank details
            if (!name || !ifsc || !account_number) {
                Toastify({
                    text: 'Please fill in all bank details.'.toUpperCase(),
                    duration: 2000,
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: 'red',
                    },
                }).showToast();
                return;
            }

            // Send the AJAX request with FormData
            $.ajax({
                url: "<?= base_url('api/seller/bank/update') ?>",
                type: "POST",
                data: formData,
                contentType: false, // Important for FormData
                processData: false, // Prevent automatic processing of FormData
                beforeSend: function () {
                    $('#finishProcess').text('Updating Bank Details...').attr('disabled', true);
                },
                success: function (resp) {
                    if (resp.status) {
                        console.log("Bank details updated successfully!");
                        Toastify({
                            text: 'Process completed successfully!'.toUpperCase(),
                            duration: 2000,
                            position: "center",
                            stopOnFocus: true,
                            style: {
                                background: 'green',
                            },
                        }).showToast();
                        resetForm();
                        $('#authorizationLetterModal').modal('hide');
                        isAuthSeller();
                    } else {
                        alert(`Failed to update bank details: ${resp.message}`);
                    }
                },
                error: function (err) {
                    console.error("Error updating bank details:", err);
                    alert("An error occurred while updating bank details.");
                },
                complete: function () {
                    $('#finishProcess').text('Finish').attr('disabled', false);
                }
            });
        });

    });


</script>