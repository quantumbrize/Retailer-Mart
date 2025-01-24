<script>

    let user_id = "<?= $_SESSION['SELLER_user_id'] ?>"
    load_wallet_history()
    load_wallet()

    let wallet_bal = 0

    function load_wallet_history() {

        $.ajax({
            url: `<?= base_url('/api/seller/wallet/history') ?>?u=${user_id}`,
            type: "GET",
            beforeSend: function () { },
            success: function (resp) {
                console.log(resp)
                if (resp) {
                    let html = ''
                    $.each(resp.data, function (index, item) {
                        html += `<tr class="vendor_tr">
                                    <td>${index + 1}</td>
                                    <td>${formatTimestamp(item.created_at)}</td>
                                    <td style="color: green;">${item.credited}</td>
                                    <td style="color: red;">${item.debited}</td>
                                    <td>${item.closing_balance} ₹</td>
                                </tr>`

                    })
                    $('#wallet_history_table_body').html(html)
                    $('#wallet_history_table').DataTable();

                }
            },
            error: function (err) { console.error(err) }
        })
    }


    function load_wallet() {

        $.ajax({
            url: `<?= base_url('/api/seller/wallet') ?>?u=${user_id}`,
            type: "GET",
            beforeSend: function () { },
            success: function (resp) {
                console.log(resp)
                if (resp) {
                    $('#wallet_balance').html(resp.data ? resp.data.balance + ' ₹' : '')
                    wallet_bal = resp.data ? resp.data.balance : 0;
                }
            },
            error: function (err) { console.error(err) }
        })


    }


    document.getElementById('withdrawalForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const amount = parseFloat(document.getElementById('withdrawalAmount').value);

        // Check if amount is a valid number, greater than 0, and less than or equal to wallet balance
        if (isNaN(parseFloat(amount)) || parseFloat(amount) <= 0) {
            html = `<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                    <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - "Amount should be greater than 0."
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;
            $('#alert').html(html);
            return;
        }

        if (parseFloat(amount) > parseFloat(wallet_bal)) {
            html = `<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                    <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - "You Do Not Have Sufficient Balance."
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;
            $('#alert').html(html);
            return;
        }

        $.ajax({
            url: `<?= base_url('/api/seller/withdrawal/request') ?>`,
            type: "POST",
            data: {
                user_id: user_id,
                amount: amount
            },
            beforeSend: function () { },
            success: function (resp) {
                console.log(resp);
                if (resp.status) {
                    html = `<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                            <i class="ri-checkbox-circle-fill label-icon"></i>${resp.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                    $('#alert').html(html);
                    // Close the modal (if needed)
                    const modalElement = document.getElementById('withdrawalModal');
                    const modal = bootstrap.Modal.getInstance(modalElement);
                    modal.hide();

                    // Reset the form
                    $('#withdrawalAmount').val('')
                    // this.reset();
                }
            },
            error: function (err) { console.error(err); }
        });
    });



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



</script>