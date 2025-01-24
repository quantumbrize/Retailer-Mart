<script>
    user_id = '<?= isset($_SESSION['USER_user_id']) ? $_SESSION['USER_user_id'] : '' ?>'



    load_orders()




    function load_orders() {
        $.ajax({
            url: '<?= base_url('/api/user/orders') ?>',
            type: 'GET',
            data: {
                user_id: user_id
            },
            beforeSend: function () {

            },
            success: function (resp) {
                console.log(resp)
                if (resp.status) {
                    resp.data.reverse()


                    html = ``
                    $.each(resp.data, function (index, item) {
                        var dateString = item.created_at;
                        var date = new Date(dateString);
                        var options = {
                            year: 'numeric',
                            month: 'short',
                            day: '2-digit',
                            hour12: false,
                            timeZone: 'Asia/Kolkata'
                        };
                        var formattedDate = date.toLocaleString('en-IN', options);
                        html += ` <tr onClick="open_order('${item.order_id}')" class="tr_order">
                                    <td>
                                        <span class="text-body">${item.order_id}</span>
                                    </td>
                                    <td><span class="text-muted">${formattedDate}</span></td>
                                    <td class="fw-medium">₹ ${item.total}</td>
                                    <td>
                                        <span class="bg-info-subtle text-info ">${item.order_status.toUpperCase()}</span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" id="invoice_${item.order_id}" onclick="get_invoice('${item.invoice.hash_id}', '${item.order_id}'), event.stopPropagation()" class="btn btn-secondary btn-sm">Invoice</a>
                                    </td>
                                </tr>`
                    })
                    $('#orders_tb_body').html(html);
                }

            },
            error: function (err) {
                console.log(err)
            }
        })
    }


    function open_order(uid) {

        window.location.href = `<?= base_url('/order/track?o_id=') ?>${uid}`

    }

    function get_invoice(hash_id, order_id) {
        $.ajax({
            url: '<?= base_url('/api/order/invoice') ?>',
            type: 'GET',
            data: {
                hash_id: hash_id
            },
            beforeSend: function () {
                $('#invoice_'+order_id).html(`<div class="spinner-border" role="status"></div>`)
                $('#invoice_'+order_id).attr('disabled', true)
            },
            success: function (resp) {
                console.log(resp)
                if (resp.status) {
                   $('#exampleModalInvoice').modal('show');

                    const byteCharacters = atob(resp.data); // Decode the base64 string into a byte array
                    const byteArrays = new Uint8Array(byteCharacters.length);
                    for (let i = 0; i < byteCharacters.length; i++) {
                        byteArrays[i] = byteCharacters.charCodeAt(i);
                    }
                    const blob = new Blob([byteArrays], { type: 'application/pdf' });
                    const pdfUrl = URL.createObjectURL(blob);
                    const iframe = document.getElementById('invoice_pdf');
                    if (iframe) {
                        iframe.src = pdfUrl;
                    } else {
                        console.error('Iframe element with id "invoice_pdf" not found.');
                    }
                }

            },
            error: function (err) {
                console.log(err)
            },
            complete: function () {
                $('#invoice_'+order_id).html(`INVOICE`)
                $('#invoice_'+order_id).attr('disabled', false)
            }
        })
    }


</script>