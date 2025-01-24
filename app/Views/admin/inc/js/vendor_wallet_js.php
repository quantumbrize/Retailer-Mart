<script>
    load_vendors()
    load_wallet_history()

    function load_vendors() {

        $.ajax({
            url: "<?= base_url('/api/sellers') ?>",
            type: "GET",
            beforeSend: function () { },
            success: function (resp) {
                console.log(resp)
                if (resp) {
                    let html = ''
                    $.each(resp.data, function (index, item) {
                        html += `<tr class="vendor_tr">
                                    <td>${index+1}</td>
                                    <td>${item.user_name}</td>
                                    <td>${item.email}</td>
                                    <td>${item.number}</td>
                                    <td>${item.balance} ₹</td>
                                    <td>
                                        <a 
                                            class="btn btn-sm btn-success" 
                                            href="<?= base_url('/admin/vendor/wallet/history')?>?u=${item.user_id}"> 
                                           <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a 
                                            class="btn btn-sm btn-success" 
                                            href="<?= base_url('/admin/vendor/withdrawal/history')?>?u=${item.user_id}"> 
                                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>`

                    })
                    $('#wallet_table_body').html(html)
                    $('#wallet_table').DataTable();

                }
            },
            error: function (err) { console.error(err) }
        })


    }


    load_wallet_history()
    function load_wallet_history() {

        $.ajax({
            url: `<?= base_url('/api/seller/withdrawal/history') ?>?s=pending`,
            type: "GET",
            beforeSend: function () { },
            success: function (resp) {
                console.log(resp)
                if (resp.status) {
                    $('#reqCount').html(resp.data ? resp.data.length : '')
                }
            },
            error: function (err) { console.error(err) }
        })


    }

</script>