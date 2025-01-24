<script>
    $.ajax({
        url: "<?= base_url('/api/about') ?>",
        type: "GET",
        success: function (resp) {
            console.log(resp)
            if (resp.status) {
            $('#about_description').html(resp.data.about_description.replace(/<\/?[^>]+(>|$)/g, ""))
            $('#about_mission').html(resp.data.mission)
            $('#about_vision').html(resp.data.vision)
            
            
            }else{
                console.log(resp)
            }
        },
        error: function (err) {
            console.log(err)
        },
    })
    
</script>