<script>
    let user_id = "<?= $_GET['u'] ?>"
    load_wallet_history()
    function load_wallet_history() {

        $.ajax({
            url: `<?= base_url('/api/seller/withdrawal/history') ?>?u=${user_id}`,
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
                                    <td>${item.amount}</td>
                                    <td>${item.status != 'pending' ? item.closing_balance + '₹': ''} </td>
                                    <td style="text-transform: uppercase;"> ${item.status}</td>
                                </tr>`

                    })
                    $('#wallet_history_table_body').html(html)
                    $('#wallet_history_table').DataTable();
                }
            },
            error: function (err) { console.error(err) }
        })


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



</script>