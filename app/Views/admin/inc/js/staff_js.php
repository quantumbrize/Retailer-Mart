<script>

    load_staff_table()

    function load_staff_table() {

        $.ajax({
            url: '<?= base_url('/api/user/staff/') ?>',
            type: "GET",
            beforeSend: function () {
                $('#staff_table_data').html(`<tr>
                                            <td colspan="5">
                                                <center>
                                                    <div class="spinner-border text-success" role="status"></div>
                                                </center>
                                            </td>
                                        </tr>`)
            },
            success: function (resp) {
                console.log(resp)
                if (resp) {
                    let html = ''
                    $.each(resp.data, function (index, item) {
                        html += `<tr>
                                <td>${item.staff_name}</td>
                                <td>${item.staff_role}</td>
                                <td>${item.staff_number}</td>
                                <td>${item.staff_email}</td>
                                <td>
                                    <i 
                                        style="margin-right: 20px; cursor: pointer;"
                                        class="ri-edit-2-line text-primary d-inline-block edit-item-btn fs-16" 
                                        onclick="open_staff('${item.staff_id}')">
                                    </i>
                                    <i 
                                        style="margin-right: 20px; cursor: pointer;"
                                        class="ri-delete-bin-line text-danger d-inline-block remove-item-btn fs-16" 
                                        id="staff_delete_${item.staff_id}" onclick="delete_staff('${item.staff_id}')">
                                    </i>
                                </td>
                            </tr>`

                    })
                    $('#staff_table_data').html(html)
                    $('#staff_table').DataTable();

                }
            },
            error: function (err) {
                console.err(err)
            }
        })
    }


    function open_staff(staff_id) {
        window.location.href = `<?= base_url('/admin/users/staff/update?s_id=') ?>${staff_id}`;
    }

    function delete_staff(staff_id){
        $.ajax({
            url: '<?= base_url('/api/delete/staff') ?>',
            type: "GET",
            data:{staff_id:staff_id},
            beforeSend: function () {
                // $('#staff_delete_'+staff_id).html(`<tr>
                //                             <td colspan="5">
                //                                 <center>
                //                                     <div class="spinner-border text-success" role="status"></div>
                //                                 </center>
                //                             </td>
                //                         </tr>`)
            },
            success: function (resp) {
                console.log(resp)
                let html = ''
                if (resp.status) {
                    html = `<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                <i class="ri-checkbox-circle-fill label-icon"></i>${resp.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`
                    $('#alert').html(html)
                    load_staff_table()
                } else {
                    html = `<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                            <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - ${resp.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`
                    $('#alert').html(html)
                }
            },
            error: function (err) {
                console.error(err)
            }
        })
    }


</script>