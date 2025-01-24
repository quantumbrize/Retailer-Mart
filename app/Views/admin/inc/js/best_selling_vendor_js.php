<script>
    load_vendors()


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
                                    <td><input type="checkbox" name="best_selling_vendor" value="${item.vendor_id}"></td>
                                    <td>${item.user_name}</td>
                                    <td>${item.email}</td>
                                    <td>${item.number}</td>
                                    <td>
                                        <img src="<?= base_url('public/uploads/user_images/')?>${item.user_img}" class="user_documents" alt="Image not found">
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

    function update_status(user_id){
        let user_status = $('#user_status_'+user_id).val()
        $.ajax({
                url: "<?= base_url('/api/update/user/status') ?>",
                type: 'POST',
                data: {
                    user_id: user_id,
                    user_status: user_status,
                },
                beforeSend: function () { },
                success: function (resp) {
                    console.log(resp);
                        let html = ''
                    if (resp.status) {
                        html = `<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                    <i class="ri-checkbox-circle-fill label-icon"></i>${resp.message}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>`
                        $('#alert').html(html)
                        load_vendors();
                    } else {
                        html = `<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - ${resp.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`
                        $('#alert').html(html)
                    }
                    
                },
                error: function (err) {
                    console.log(err)
                }

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

    function open_staff(staff_id){
        // alert(staff_id)
        $.ajax({
            url: "<?= base_url('/api/seller') ?>",
            type: "GET",
            data:{user_id:staff_id},
            beforeSend: function () { },
            success: function (resp) {
                
                if (resp) {
                    console.log(resp)
                    $('#modal_vendor_update').modal('show')
                    $('#user_name_update').val(resp.data.user_name)
                    $('#number_update').val(resp.data.number)
                    $('#email_update').val(resp.data.email)
                    $('#update_images1').html(`<img src="<?= base_url('public/uploads/user_images/')?>${resp.data.user_img}" alt="Image not found">`)
                    $('#update_images2').html(`<img src="<?= base_url('public/uploads/user_documents/')?>${resp.data.signature_img}" alt="Image not found">`)
                    $('#update_images3').html(`<img src="<?= base_url('public/uploads/user_documents/')?>${resp.data.pan_img}" alt="Image not found">`)
                    $('#update_images4').html(`<img src="<?= base_url('public/uploads/user_documents/')?>${resp.data.aadhar_img}" alt="Image not found">`)
                    $('#update_images5').html(`<img src="<?= base_url('public/uploads/user_documents/')?>${resp.data.gst}" alt="Image not found">`)
                    $('#update_images6').html(`<img src="<?= base_url('public/uploads/user_documents/')?>${resp.data.tread_licence}" alt="Image not found">`)
                    $('#user_id').val(resp.data.user_id)


                }
            },
            error: function (err) { console.error(err) }
        })
    }


    $('#delete_vendor_btn').on('click', function () {

        let user_name = $('#user_name').val()
        let number = $('#number').val()
        let email = $('#email').val()
        let password = $('#password').val()

        $.ajax({
            url: "<?= base_url('/api/delete/seller') ?>",
            type: "GET",
            data:{user_id:seller_id},
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
                seller_id = ""
                $('#modal_vendor_delete').modal('hide');
                load_vendors()
            },
            error: function (err) {
                console.error(err)
            }

        })

    })



</script>