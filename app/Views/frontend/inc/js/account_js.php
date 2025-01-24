<script>
    $(document).ready(function () {
        // alert("hello")
        get_user_data();

        $('.edit-address').click(function (e) {
            e.preventDefault();
            $('.account-address-bar').removeClass('active');
            $('#account-addresses').removeClass('active');
            $('.account-details-bar').addClass('active');
            $('#account-details').addClass('active');
        });

        $("#update_profile").click(function () {
            var user_id = $("#user_id").val()
            var name = $("#firstname").val()
            var number = $("#phonenumberInput").val()
            var email = $("#email_1").val()

            var city = $("#cityInput").val()
            var country = $("#countryInput").val()
            var zip = $("#zipcodeInput").val()
            var district = $("#districtInput").val()
            var state = $("#stateInput").val()
            var locality = $("#localityInput").val()

            if (name == "") {
                $("#name_val").text("Please enter name!")
            } else {
                $("#name_val").text("")
            }
            if (number == "") {
                $("#number_val").text("Please enter number!")
            } else {
                $("#number_val").text("")
            }
            if (email == "") {
                $("#email_val").text("Please enter email!")
            } else {
                $("#email_val").text("")
            }

            if (name != "" && number != "" && email != "") {
                // alert("hello")
                var formData = new FormData();

                formData.append('name', name);
                formData.append('number', number);
                formData.append('email', email);
                formData.append('city', city);
                formData.append('country', country);
                formData.append('zip', zip);
                formData.append('district', district);
                formData.append('state', state);
                formData.append('locality', locality);
                formData.append('user_id', user_id);
                console.log(formData.get('name'));

                $.each($('#user_img_input')[0].files, function (index, file) {
                    formData.append('images[]', file);
                });
                $.ajax({
                    url: "<?= base_url('/api/user/update') ?>",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#update_profile').html(`<div class="spinner-border" role="status"></div>`)
                        $('#update_profile').attr('disabled', true)

                    },
                    success: function (resp) {
                        console.log(resp)

                        if (resp.status) {
                            // window.location.href = "<?= base_url('/user/account') ?>";
                            Toastify({
                                text: resp.message.toUpperCase(),
                                duration: 3000,
                                position: "center",
                                stopOnFocus: true,
                                style: {
                                    background: resp.status ? 'darkgreen' : 'darkred',
                                },

                            }).showToast();
                            get_user_data();
                        } else {
                            console.log(resp.status)
                            Toastify({
                                text: resp.message.toUpperCase(),
                                duration: 3000,
                                position: "center",
                                stopOnFocus: true,
                                style: {
                                    background: resp.status ? 'darkgreen' : 'darkred',
                                },

                            }).showToast();
                        }


                        $('#alert').html(html)
                        console.log(resp)
                    },
                    error: function (err) {
                        console.log(err)
                    },
                    complete: function () {
                        $('#update_profile').html(`<i class="ri-edit-box-line align-middle me-2"></i> Update Profile`)
                        $('#update_profile').attr('disabled', false)
                    }
                })
            }
        });

        $("#change_password").click(function () {
            var user_id = $("#user_id").val()
            var old_password = $("#oldpasswordInput").val()
            var new_password = $("#newpasswordInput").val()
            var confirm_password = $("#confirmpasswordInput").val()
            flag1 = true
            flag2 = true

            if (old_password == "") {
                $('#changeOldPass').text('Please enter old password.')
            } else {
                $('#changeOldPass').text('')
            }

            if (new_password == "") {
                $('#changeNewPass').text('Please enter new password.')
            } else if (new_password.length < 6) {
                $('#changeNewPass').text('New password must be 6 digits.')
                flag1 = false
            } else {
                $('#changeNewPass').text('')
            }

            if (confirm_password == "") {
                $('#changeConfirmPass').text('Please enter confirm password.')
            } else if (confirm_password != new_password) {
                $('#changeConfirmPass').text('Does not match with new password!')
                flag2 = false
            } else {
                $('#changeConfirmPass').text('')
            }



            if (old_password != "" && new_password != "" && confirm_password != "" && flag1 && flag2) {
                var formData = new FormData();

                formData.append('user_id', user_id);
                formData.append('old_password', old_password);
                formData.append('new_password', new_password);
                formData.append('confirm_password', confirm_password);

                $.ajax({
                    url: "<?= base_url('/api/change/password') ?>",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#change_password').html(`<div class="spinner-border" role="status"></div>`)
                        $('#change_password').attr('disabled', true)

                    },
                    success: function (resp) {
                        console.log(resp)

                        if (resp.status) {
                            Toastify({
                                text: resp.message.toUpperCase(),
                                duration: 3000,
                                position: "center",
                                stopOnFocus: true,
                                style: {
                                    background: resp.status ? 'darkgreen' : 'darkred',
                                },

                            }).showToast();
                            $("#oldpasswordInput").val("")
                            $("#newpasswordInput").val("")
                            $("#confirmpasswordInput").val("")
                        } else {
                            Toastify({
                                text: resp.message.toUpperCase(),
                                duration: 3000,
                                position: "center",
                                stopOnFocus: true,
                                style: {
                                    background: resp.status ? 'darkgreen' : 'darkred',
                                },

                            }).showToast();

                        }


                        console.log(resp)
                    },
                    error: function (err) {
                        console.log(err)
                    },
                    complete: function () {
                        $('#change_password').html(`<i class="ri-edit-box-line align-middle me-2"></i> Change Password`)
                        $('#change_password').attr('disabled', false)
                    }
                })
            }

        })
    })
    user_id = '<?= isset($_SESSION['USER_user_id']) ? $_SESSION['USER_user_id'] : '' ?>'

    function get_user_data() {
        $.ajax({
            url: "<?= base_url('api/user') ?>",
            type: "GET",
            data: {
                user_id: user_id
            },
            success: function (resp) {
                // resp = JSON.parse(resp)
                console.log(resp.user_data)
                if (resp.status == true) {
                    console.log('usr', resp)



                    $("#user_full_name").text(resp.user_data.user_name);
                    $("#user_id").val(resp.user_id)
                    $("#firstname").val(resp.user_data.user_name)
                    $("#phonenumberInput").val(resp.user_data.number)
                    $("#email_1").val(resp.user_data.email)

                    if (resp.address != null) {
                        $("#cityInput").val(resp.address.city)
                        $("#countryInput").val(resp.address.country)
                        $("#zipcodeInput").val(resp.address.zipcode)
                        $("#districtInput").val(resp.address.district)
                        $("#stateInput").val(resp.address.state)
                        $("#localityInput").val(resp.address.locality)
                        $("#logggedin_name").text(resp.user_data.user_name)
                        $(".billing_and_shipping_address").html(`<tr>
                                                            <th>Name:</th>
                                                            <td>${resp.user_data.user_name}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Address:</th>
                                                            <td>Wall Street</td>
                                                        </tr>
                                                        <tr>
                                                            <th>City:</th>
                                                            <td>${resp.address.city}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Country:</th>
                                                            <td>${resp.address.country}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>District:</th>
                                                            <td>${resp.address.district}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Postcode:</th>
                                                            <td>${resp.address.zipcode}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Locality:</th>
                                                            <td>${resp.address.locality}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>State:</th>
                                                            <td>${resp.address.state}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Phone:</th>
                                                            <td>${resp.user_data.number}</td>
                                                        </tr>` )
                        // $("#customer_location").text(resp.address.city)

                        // $("#user_location").empty();
                        // $("#user_location").append(`<i class="bi bi-geo-alt"></i>${resp.address.city}`);
                    }

                    if (resp.user_img != null) {
                        $("#user_avtar_img").attr("src", "<?= base_url('public/uploads/user_images/') ?>" + resp.user_img.img);
                        $("#user_img").attr("src", "<?= base_url('public/uploads/user_images/') ?>" + resp.user_img.img);
                    }

                    // if (resp.all_address != null) {
                    //     $('#user_address').empty();
                    //     $.each(resp.all_address, function (index, add_data) {
                    //         html = `<div class="col-md-6">
                    //                                         <div class="card mb-md-0">
                    //                                             <div class="card-body"> 
                    //                                                 <div class="float-end clearfix"> <a href="address.html" class="badge bg-primary-subtle text-primary ">${add_data.is_primary}</a> </div>
                    //                                                 <div> 
                    //                                                     <p class="mb-3 fw-semibold fs-12 d-block text-muted text-uppercase">Home Address</p> 
                    //                                                     <h6 class="fs-14 mb-2 d-block">${resp.user_data.user_name}</h6> 
                    //                                                     <span class="text-muted fw-normal text-wrap mb-1 d-block">${add_data.locality}, ${add_data.city}, ${add_data.zipcode}</span> 
                    //                                                     <span class="text-muted fw-normal d-block">${add_data.district}, ${add_data.state}</span> 
                    //                                                 </div> 
                    //                                             </div>
                    //                                         </div>
                    //                                     </div>`
                    //         $('#user_address').append(html);
                    //     });
                    // }






                    // $("#customer_name").text(resp.user_data.user_name)
                    // $("#customer_number").text(resp.user_data.number)
                    // $("#customer_email").text(resp.user_data.email)

                    var dateParts = resp.user_data.created_at.split(" ")[0].split("-");
                    var year = dateParts[0];
                    var month = dateParts[1];
                    var day = dateParts[2];
                    var formattedDate = day + "/" + month + "/" + year;
                    $("#customer_since_member").text(formattedDate)



                } else {
                    console.log(resp.message)
                }
            },
            error: function () {
            }
        })
    }

    $(document).on('change', 'input[name="user_img[]"]', function (e) {
        console.log(1)
        var files = e.target.files;
        $('#userImage').html(''); // Clear existing previews

        for (var i = 0; i < files.length; i++) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#userImage').append(`<img src="${e.target.result}" height="100" id="user_img"/>`);
            };

            reader.readAsDataURL(files[i]);
        }
    });



</script>