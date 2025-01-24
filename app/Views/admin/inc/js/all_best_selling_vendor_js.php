<script>
    load_vendors()


    function load_vendors() {

        $.ajax({
            url: "<?= base_url('/api/all/best-sellers') ?>",
            type: "GET",
            beforeSend: function () { },
            success: function (resp) {
                console.log(resp)
                if (resp) {
                    let html = ''
                    $.each(resp.data, function (index, item) {
                        html += `<tr class="vendor_tr">
                                    <td>${item.vendor_details.user_name}</td>
                                    <td>${item.vendor_details.email}</td>
                                    <td>${item.vendor_details.number}</td>
                                    <td>
                                        <i 
                                            style="margin-right: 20px; cursor: pointer;"
                                            class="ri-delete-bin-line text-danger d-inline-block remove-item-btn fs-16" 
                                            onclick="delete_best_seller('${item.vendor_id}')">
                                        </i>
                                    </td>
                                </tr>`

                    })
                    $('#vendor_table_data').html(html)
                    $('#vendor_table').DataTable();

                }
            },
            error: function (err) { console.error(err) }
        })


    }

    $('#submit_best_seller').on('click', function () {

        const selectedVendors = $('input[name="best_selling_vendor"]:checked').map(function() {
            return this.value;
        }).get();
        console.log(selectedVendors)
        if(selectedVendors != ""){
            var formData = new FormData();

            formData.append('vendors_id', selectedVendors);


            $.ajax({
                url: "<?= base_url('/api/add/best-seller') ?>",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () { },
                success: function (resp) {
                    let html = ''
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
                    load_vendors()
                },
                error: function (err) {
                    console.error(err)
                }

            })
        } else {
            html = `<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                    <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Please Select Vendor!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>`
            $('#alert').html(html)
        }
       

    })


    function delete_best_seller(vendor_id) {
        $.ajax({
            url: "<?= base_url('/api/delete/best-sellers') ?>",
            type: "GET",
            data:{vendor_id:vendor_id},
            beforeSend: function () { },
            success: function (resp) {
                let html = ''
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
                load_vendors()
            },
            error: function (err) {
                console.error(err)
            }

        })

    }



</script>