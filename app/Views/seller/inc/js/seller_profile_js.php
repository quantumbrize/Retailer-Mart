<script>
    let user_id = '<?= isset($_SESSION['ADMIN_user_id']) ? $_SESSION['ADMIN_user_id'] : $_SESSION['STAFF_user_id'] ?>';
    get_seller_bank();

    // Fetch the seller's bank details
    function get_seller_bank() {
        $.ajax({
            url: "<?= base_url('api/seller/bank') ?>",
            type: "GET",
            data: { u: user_id },
            success: function (resp) {
                if (resp.status) {
                    $('#name_val').val(resp.data.user_name);
                    $('#ifsc_val').val(resp.data.ifsc);
                    $('#acc_val').val(resp.data.account_number);
                } else {
                    console.log('err', resp);
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    }

    // Update profile on button click
    $('#update_profile').on('click', function () {
        const name = $('#name_val').val()
        const ifsc = $('#ifsc_val').val()
        const account_number = $('#acc_val').val()

       

        $.ajax({
            url: "<?= base_url('api/seller/bank/update') ?>", // API endpoint to update bank details
            type: "POST",
            data: {
                user_id: user_id,
                user_name: name,
                ifsc: ifsc,
                account_number: account_number
            },
            beforeSend: function () {
                $('#update_profile').text('Updating...').attr('disabled', true); // Optional: Show loading state
            },
            success: function (resp) {
                $('#update_profile').text('Update Profile').attr('disabled', false); // Reset button state
                if (resp.status) {
                    alert("Bank details updated successfully!");
                    get_seller_bank(); // Optionally refresh data
                }
            },
            error: function (err) {
                $('#update_profile').text('Update Profile').attr('disabled', false); // Reset button state
                console.error(err);
                alert("An error occurred while updating bank details.");
            }
        });
    });
</script>
