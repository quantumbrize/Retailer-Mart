<script>

    $('#res_btn').on('click', function () {

        $.ajax({
            url: '<?= base_url('/api/order/cancel') ?>',
            data: {
                o_id: "<?= $_GET['o_id'] ?>",
                reason: $('#res_inp').val()
            },
            beforeSend: function () { },
            success: function (resp) {
                if (resp.status) {
                    Toastify({
                        text: resp.message.toUpperCase(),
                        duration: 2000,
                        position: "right",
                        stopOnFocus: true,
                        style: {
                            background: 'green',
                        },
                    }).showToast();
                    // window.location.href = "<?=base_url('/order/history')?>";
                }


            },
            error: function (err) {
                console.error(err)
            }
        })

    })


</script>