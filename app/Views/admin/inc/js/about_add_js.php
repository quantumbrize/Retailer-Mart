<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<script>
    var editor;
    var editor1;
    var editor2;
    var about_id = ''
    $(document).ready(function () {
        

        let $fileInput = $("#file-input");
        let $imageContainer = $("#images");
        let $numOfFiles = $("#num-of-files");

        function preview() {
            $imageContainer.html("");
            $numOfFiles.text(`${$fileInput[0].files.length} Files Selected`);

            $.each($fileInput[0].files, function (index, file) {
                let reader = new FileReader();
                let $figure = $("<figure>");
                let $figCap = $("<figcaption>").text(file.name);
                $figure.append($figCap);
                reader.onload = function () {
                    let $img = $("<img>").attr("src", reader.result);
                    $figure.prepend($img);
                }
                $imageContainer.append($figure);
                reader.readAsDataURL(file);
            });
        }
        $fileInput.change(preview);

        ClassicEditor.create(document.querySelector("#ckeditor-classic")).then(function (createdEditor) {
            editor = createdEditor;
            editor.ui.view.editable.element.style.height = "200px";
        }).catch(function (error) {
            console.error(error);
        }); 

        ClassicEditor.create(document.querySelector("#ckeditor-classic1")).then(function (createdEditor) {
            editor1 = createdEditor;
            editor1.ui.view.editable.element.style.height = "200px";
        }).catch(function (error) {
            console.error(error);
        });

        ClassicEditor.create(document.querySelector("#ckeditor-classic2")).then(function (createdEditor) {
            editor2 = createdEditor;
            editor2.ui.view.editable.element.style.height = "200px";
        }).catch(function (error) {
            console.error(error);
        });

        $('#about_update_btn').on('click', function () {
            var formData = new FormData();

            formData.append('companyName', $('#companyName').val());
            formData.append('address', $('#address').val());
            formData.append('bannerDescription', editor.getData());
            formData.append('phoneNo1', $('#phoneNo1').val());
            formData.append('phoneNo2', $('#phoneNo2').val());
            formData.append('map', $('#map').val());
            formData.append('email', $('#email').val());
            formData.append('mission', editor1.getData());
            formData.append('vision', editor2.getData());
            formData.append('about_id', about_id);
            

            $.each($('#file-input')[0].files, function (index, file) {
                formData.append('images[]', file);
            })
            // formData.forEach(function(value, key){
            //     console.log(key + ": " + value);
            // });
            $.ajax({
                url: "<?= base_url('/api/update/about') ?>",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#about_update_btn').html(`<div class="spinner-border" role="status"></div>`)
                    $('#about_update_btn').attr('disabled', true)

                },
                success: function (resp) {
                    let html = ''

                    if (resp.status) {
                        html += `<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                <i class="ri-checkbox-circle-fill label-icon"></i>${resp.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`
                            // get_banner()
                    } else {
                        html += `<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - ${resp.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`
                    }


                    $('#alert').html(html)
                    console.log(resp)
                },
                error: function (err) {
                    console.log(err)
                },
                complete: function () {
                    $('#about_update_btn').html(`submit`)
                    $('#about_update_btn').attr('disabled', false)
                }
            })
        })

    });

    $.ajax({
        url: "<?= base_url('/api/about') ?>",
        type: "GET",
        success: function (resp) {
            if (resp.status) {
            console.log(resp)
            about_id = resp.data.uid
            $('#companyName').val(resp.data.company_name)
            $('#address').val(resp.data.address)
            $('#phoneNo1').val(resp.data.phone1)
            $('#phoneNo2').val(resp.data.phone2)
            $('#map').val(resp.data.map)
            $('#email').val(resp.data.email)
            editor.setData(resp.data.about_description);
            editor1.setData(resp.data.mission);
            editor2.setData(resp.data.vision);
            $('#images').html(`<img src="<?= base_url('public/uploads/logo/') ?>${resp.data.logo}" alt="" class="img_logo">`)
            
            }else{
                console.log(resp)
            }
        },
        error: function (err) {
            console.log(err)
        },
    })
        
</script>