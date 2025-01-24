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
                                    <td>${item.user_name}</td>
                                    <td>${item.email}</td>
                                    <td>${item.number}</td>
                                    <td>
                                        <a href="<?= base_url('public/uploads/user_images/') ?>${item.user_img}" download>
                                            <i style="cursor: pointer;" class="ri-download-line text-primary d-inline-block download-item-btn fs-16"></i>
                                        </a>
                                        <img src="<?= base_url('public/uploads/user_images/') ?>${item.user_img}" class="user_documents" alt="Image not found">
                                    </td>

                                    <td>
                                        <a href="<?= base_url('public/uploads/user_documents/') ?>${item.signature_img}" download>
                                            <i style="cursor: pointer;" class="ri-download-line text-primary d-inline-block download-item-btn fs-16"></i>
                                        </a>
                                        <img src="<?= base_url('public/uploads/user_documents/') ?>${item.signature_img}" class="user_documents" alt="Signature not found">
                                    </td>
                                    <td>
                                        <a href="<?= base_url('public/uploads/user_documents/') ?>${item.pan_img}" download>
                                            <i style="cursor: pointer;" class="ri-download-line text-primary d-inline-block download-item-btn fs-16"></i>
                                        </a>
                                        <img src="<?= base_url('public/uploads/user_documents/') ?>${item.pan_img}" class="user_documents" alt="Pan card not found">
                                    </td>
                                    <td>
                                        <a href="<?= base_url('public/uploads/user_documents/') ?>${item.aadhar_img}" download>
                                            <i style="margin-left: 10px;cursor: pointer;" class="ri-download-line text-primary d-inline-block download-item-btn fs-16"></i>
                                        </a>
                                        <img src="<?= base_url('public/uploads/user_documents/') ?>${item.aadhar_img}" class="user_documents" alt="Aadhar card not found">
                                    </td>
                                    <td>
                                        <a href="<?= base_url('public/uploads/user_documents/') ?>${item.gst}" download>
                                            <i style="margin-left: 10px;cursor: pointer;" class="ri-download-line text-primary d-inline-block download-item-btn fs-16"></i>
                                        </a>
                                        <img src="<?= base_url('public/uploads/user_documents/') ?>${item.gst}" class="user_documents" alt="Aadhar card not found">
                                    </td>
                                    <td>
                                        <a href="<?= base_url('public/uploads/user_documents/') ?>${item.tread_licence}" download>
                                            <i style="margin-left: 10px;cursor: pointer;" class="ri-download-line text-primary d-inline-block download-item-btn fs-16"></i>
                                        </a>
                                        <img src="<?= base_url('public/uploads/user_documents/') ?>${item.tread_licence}" class="user_documents" alt="Aadhar card not found">
                                    </td>
                                    

                                    <td>
                                       ${item.gst_no}
                                    </td>
                                    <td>
                                       ${item.trade_no}
                                    </td>
                                    <td>
                                       ${item.aadhar_no}
                                    </td>
                                    <td>
                                       ${item.pan_no}   
                                    </td>
                                     <td>
                                       ${item.bank ? item.bank.user_name : ''}   
                                    </td>
                                     <td>
                                       ${item.bank ? item.bank.account_number : ''}   
                                    </td>
                                     <td>
                                       ${item.bank ? item.bank.ifsc : ''}   
                                    </td>
                                     <td>
                                        ${item.bank ? `<a href="<?= base_url('public/uploads/user_documents/') ?>${item.bank ? item.bank.bank_img : ''}" download>
                                            <i style="margin-left: 10px;cursor: pointer;" class="ri-download-line text-primary d-inline-block download-item-btn fs-16"></i>
                                        </a>
                                        <img src="<?= base_url('public/uploads/user_documents/') ?>${item.bank ? item.bank.bank_img : ''}" class="user_documents" alt="Aadhar card not found">` : ''}
                                    </td>
                                    <td>
                                       <select class="form-control" id="user_status_${item.user_id}" onchange="update_status('${item.user_id}')">
                                            <option value="${item.status}">${item.status}</option>
                                            <option value="active">active</option>
                                            <option value="inactive">inactive</option>
                                       </select>
                                    </td>
                                    <td>
                                        <i 
                                            style="margin-right: 20px; cursor: pointer;"
                                            class="ri-edit-2-line text-primary d-inline-block edit-item-btn fs-16" 
                                            onclick="open_staff('${item.user_id}')">
                                        </i>
                                        <i 
                                            style="margin-right: 20px; cursor: pointer;"
                                            class="ri-delete-bin-line text-danger d-inline-block remove-item-btn fs-16" 
                                            onclick="delete_staff('${item.user_id}')">
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

    function update_status(user_id) {
        let user_status = $('#user_status_' + user_id).val()
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


    $('#add_vendor_btn').on('click', function () {

        // let user_name = $('#user_name').val()
        let number = $('#number').val()
        let email = $('#email').val()
        // let password = $('#password').val()
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(number.length != 10){
            html = `<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                            <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Enter a valid phone number
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`
                    $('#alert').html(html)
            return false

        }
        if(email == '' || !emailRegex.test(email)){
            html = `<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                            <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Enter a valid email
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`
                    $('#alert').html(html)
            return false
        }

        var formData = new FormData();

        formData.append('user_name', $('#user_name').val());
        formData.append('number', $('#number').val());
        formData.append('email', $('#email').val());
        formData.append('password', $('#password').val());
        

        $.each($('#file-input1')[0].files, function (index, file) {
            formData.append('user_img[]', file);
        })
        $.each($('#file-input2')[0].files, function (index, file) {
            formData.append('signature[]', file);
        })
        $.each($('#file-input3')[0].files, function (index, file) {
            formData.append('pan_img[]', file);
        })
        $.each($('#file-input4')[0].files, function (index, file) {
            formData.append('aadhar_img[]', file);
        })
        $.each($('#file-input5')[0].files, function (index, file) {
            formData.append('gst[]', file);
        })
        $.each($('#file-input6')[0].files, function (index, file) {
            formData.append('tread_licence[]', file);
        })

        $.ajax({
            url: "<?= base_url('/api/seller/add') ?>",
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
                    $('#user_name').val("")
                    $('#number').val("")
                    $('#email').val("")
                    $('#password').val("")
                } else {
                    html += `<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - ${resp.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`
                }
                $('#alert').html(html)
                $('#model_vendor_add').modal('hide');
                load_vendors()
            },
            error: function (err) {
                console.error(err)
            }

        })

    })

    function open_staff(staff_id) {
        // alert(staff_id)
        $.ajax({
            url: "<?= base_url('/api/seller') ?>",
            type: "GET",
            data: { user_id: staff_id },
            beforeSend: function () { },
            success: function (resp) {

                if (resp) {
                    console.log(resp)
                    $('#modal_vendor_update').modal('show')
                    $('#user_name_update').val(resp.data.user_name)
                    $('#number_update').val(resp.data.number)
                    $('#email_update').val(resp.data.email)
                    $('#update_images1').html(`<img src="<?= base_url('public/uploads/user_images/') ?>${resp.data.user_img}" alt="Image not found">`)
                    $('#update_images2').html(`<img src="<?= base_url('public/uploads/user_documents/') ?>${resp.data.signature_img}" alt="Image not found">`)
                    $('#update_images3').html(`<img src="<?= base_url('public/uploads/user_documents/') ?>${resp.data.pan_img}" alt="Image not found">`)
                    $('#update_images4').html(`<img src="<?= base_url('public/uploads/user_documents/') ?>${resp.data.aadhar_img}" alt="Image not found">`)
                    $('#update_images5').html(`<img src="<?= base_url('public/uploads/user_documents/') ?>${resp.data.gst}" alt="Image not found">`)
                    $('#update_images6').html(`<img src="<?= base_url('public/uploads/user_documents/') ?>${resp.data.tread_licence}" alt="Image not found">`)
                    $('#user_id').val(resp.data.user_id)


                }
            },
            error: function (err) { console.error(err) }
        })
    }

    $('#update_vendor_btn').on('click', function () {

        // let user_name = $('#user_name_update').val()
        let number = $('#number_update').val()
        let email = $('#email_update').val()
        // let user_id = $('#user_id').val()

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(number.length != 10){
            html = `<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                            <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Enter a valid phone number
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`
                    $('#alert').html(html)
            return false

        }
        if(email == '' || !emailRegex.test(email)){
            html = `<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                            <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Enter a valid email
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`
                    $('#alert').html(html)
            return false
        }

        var formData = new FormData();

        formData.append('user_name', $('#user_name_update').val());
        formData.append('number', $('#number_update').val());
        formData.append('email', $('#email_update').val());
        formData.append('user_id', $('#user_id').val());


        $.each($('#update_file-input1')[0].files, function (index, file) {
            formData.append('user_img[]', file);
        })
        $.each($('#update_file-input2')[0].files, function (index, file) {
            formData.append('signature[]', file);
        })
        $.each($('#update_file-input3')[0].files, function (index, file) {
            formData.append('pan_img[]', file);
        })
        $.each($('#update_file-input4')[0].files, function (index, file) {
            formData.append('aadhar_img[]', file);
        })
        $.each($('#update_file-input5')[0].files, function (index, file) {
            formData.append('gst[]', file);
        })
        $.each($('#update_file-input6')[0].files, function (index, file) {
            formData.append('tread_licence[]', file);
        })

        $.ajax({
            url: "<?= base_url('/api/update/seller') ?>",
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
                $('#modal_vendor_update').modal('hide')
                load_vendors()
            },
            error: function (err) {
                console.error(err)
            }

        })

    })

    var seller_id = ""
    function delete_staff(user_id) {
        seller_id = user_id
        $('#modal_vendor_delete').modal('show')
    }

    $('#delete_vendor_btn').on('click', function () {

        let user_name = $('#user_name').val()
        let number = $('#number').val()
        let email = $('#email').val()
        let password = $('#password').val()

        $.ajax({
            url: "<?= base_url('/api/delete/seller') ?>",
            type: "GET",
            data: { user_id: seller_id },
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

    function preview(fileInput, imageContainer, numOfFiles) {
        return function () {
            imageContainer.html("");
            numOfFiles.text(`${fileInput[0].files.length} Files Selected`);

            $.each(fileInput[0].files, function (index, file) {
                let reader = new FileReader();
                let $figure = $("<figure>");
                let $figCap = $("<figcaption>").text(file.name);
                $figure.append($figCap);
                reader.onload = function () {
                    let $img = $("<img>").attr("src", reader.result);
                    $figure.prepend($img);
                }
                imageContainer.append($figure);
                reader.readAsDataURL(file);
            });
        }
    }
    $("#file-input1").change(preview($("#file-input1"), $("#images1"), $("#num-of-files1")));
    $("#file-input2").change(preview($("#file-input2"), $("#images2"), $("#num-of-files2")));
    $("#file-input3").change(preview($("#file-input3"), $("#images3"), $("#num-of-files3")));
    $("#file-input4").change(preview($("#file-input4"), $("#images4"), $("#num-of-files4")));
    $("#file-input5").change(preview($("#file-input5"), $("#images5"), $("#num-of-files5")));
    $("#file-input6").change(preview($("#file-input6"), $("#images6"), $("#num-of-files6")));

    $("#update_file-input1").change(preview($("#update_file-input1"), $("#update_images1"), $("#update_num-of-files1")));
    $("#update_file-input2").change(preview($("#update_file-input2"), $("#update_images2"), $("#update_num-of-files2")));
    $("#update_file-input3").change(preview($("#update_file-input3"), $("#update_images3"), $("#update_num-of-files3")));
    $("#update_file-input4").change(preview($("#update_file-input4"), $("#update_images4"), $("#update_num-of-files4")));
    $("#update_file-input5").change(preview($("#update_file-input5"), $("#update_images5"), $("#update_num-of-files5")));
    $("#update_file-input6").change(preview($("#update_file-input6"), $("#update_images6"), $("#update_num-of-files6")));



</script>