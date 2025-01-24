<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script>
    load_wallet_history()
    function load_wallet_history() {
        $.ajax({
            url: `<?= base_url('/api/seller/withdrawal/history') ?>?s=pending`,
            type: "GET",
            beforeSend: function () { },
            success: function (resp) {
                console.log(resp);
                if (resp) {
                    let html = '';
                    $.each(resp.data, function (index, item) {
                        html += `<tr class="vendor_tr">
                                <td>${index + 1}</td>
                                <td>${item.user_details.bank.account_number}</td>
                                <td class="inpBx">
                                    <div class="btn-con" >
                                        <input type="number" class="form-control update-amount" 
                                            value="${item.amount}" min="1" style="width: 100px;" 
                                            data-request-id="${item.uid}" /> 
                                        ₹
                                    </div>
                                    <button class="btn btn-primary btn-sm send-btn" 
                                        data-request-id="${item.uid}">
                                        Send
                                    </button>
                                </td>
                                <td>Indian Rupee (₹)</td>
                                <td>-</td>
                                <td>${formatTimestamp(item.created_at)}</td>
                                <td>${item.uid}</td>
                                <td>-</td>
                                <td>${item.user_details.bank.user_name}</td>
                                <td style="text-transform: uppercase;">
                                    <button class="btn btn-danger btn-sm" onClick="delete_req('${item.uid}')">
                                        DELETE
                                    </button>
                                </td>
                            </tr>`;
                    });
                    $('#wallet_history_table_body').html(html);
                    $('#wallet_history_table').DataTable();

                    // Attach event listeners for "Send" buttons
                    $('.send-btn').on('click', function () {
                        const requestId = $(this).data('request-id');
                        const amountInput = $(`.update-amount[data-request-id="${requestId}"]`);
                        const updatedAmount = amountInput.val();
                        handleSendToVendor(requestId, updatedAmount);
                    });
                }
            },
            error: function (err) {
                console.error(err);
            }
        });
    }

    function delete_req(requestId) {
        // Show a confirmation dialog
        if (confirm("Are you sure you want to delete this withdrawal request?")) {
            // Proceed with the delete if confirmed
            $.ajax({
                url: `<?= base_url('/api/seller/withdrawal/history/delete') ?>?r=${requestId}`,
                type: "GET",
                success: function (resp) {
                    if (resp.status) {
                        load_wallet_history();
                    } else {
                        alert("Failed to delete the request. Please try again.");
                    }
                },
                error: function (err) {
                    console.error(err);
                    alert("An error occurred while deleting the request.");
                }
            });
        } else {
            // If the user cancels the action, simply log a message or do nothing
            console.log("Deletion cancelled by the user.");
        }
    }

    function handleSendToVendor(requestId, amount) {
        if (!amount || amount <= 0) {
            alert("Please enter a valid amount.");
            return;
        }

        $.ajax({
            url: `<?= base_url('/api/seller/withdrawal/send') ?>`,
            type: "POST",
            data: {
                request_id: requestId,
                amount: amount
            },
            success: function (resp) {
                if (resp.status) {
                    // alert("Amount successfully sent to the vendor.");
                    // Optionally reload the wallet history table
                    load_wallet_history();
                } else {
                    // alert(resp.message || "Failed to send amount.");
                }
            },
            error: function (err) {
                console.error(err);
                alert("An error occurred while sending the amount.");
            }
        });
    }

    function formatTimestamp(timestamp) {
        const date = new Date(timestamp);

        // Extract date components
        const day = date.getDate(); // Day of the month
        const month = date.toLocaleString("default", { month: "long" }); // Full month name
        const year = date.getFullYear(); // Full year

        // Extract time components
        let hours = date.getHours(); // 24-hour format
        const minutes = date.getMinutes().toString().padStart(2, "0"); // Ensure two digits
        const seconds = date.getSeconds().toString().padStart(2, "0"); // Ensure two digits

        // Convert to 12-hour format
        const period = hours >= 12 ? "PM" : "AM";
        hours = hours % 12 || 12; // Convert 0 hours to 12 in 12-hour format

        // Combine into the desired format
        return `${day} ${month} ${year} (${hours}:${minutes}:${seconds} ${period})`;
    }

    $('#xcl_btn').on('click', function () {
        var tableData = [];
        var headers = ["Debit Account No.", "Transaction Amount", "Transaction Currency", "Beneficiary Account Number", "Transaction Date", "Customer Reference Number", "Beneficiary Code", "Beneficiary Name"];
        tableData.push(headers);

        $('#wallet_history_table tbody tr').each(function () {
            var rowData = [];
            $(this).find('td').each(function (index) {
                if (index !== 0 && index !== 9) { // Skip ID and Delete columns
                    if (index === 2) {
                        rowData.push($(this).find('input').val()); // Get the value of the input field for Transaction Amount
                    } else {
                        rowData.push($(this).text().trim());
                    }
                }
            });
            tableData.push(rowData);
        });

        var ws = XLSX.utils.aoa_to_sheet(tableData);
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Withdrawal Requests");

        // Generate unique file name with current date and time
        var currentDate = new Date();
        var formattedDate = currentDate.getFullYear() + "-" +
            ("0" + (currentDate.getMonth() + 1)).slice(-2) + "-" +
            ("0" + currentDate.getDate()).slice(-2) + "_" +
            ("0" + currentDate.getHours()).slice(-2) + "-" +
            ("0" + currentDate.getMinutes()).slice(-2) + "-" +
            ("0" + currentDate.getSeconds()).slice(-2);

        var fileName = "Withdrawal_Requests_" + formattedDate + ".xlsx";

        XLSX.writeFile(wb, fileName);
    });

</script>