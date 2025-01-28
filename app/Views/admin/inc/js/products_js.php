
<script>
    load_products();
    function calculateFinalPrice(originalPrice, discountPercentage) {
        // Calculate the discount amount
        var discountAmount = (originalPrice * discountPercentage) / 100;
        
        // Calculate the final price after applying the discount
        var finalPrice = originalPrice - discountAmount;
        
        // Return the final price
        return finalPrice;
    }

    // function formatDate(dateString) {
    //     const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    //     const date = new Date(dateString);
    //     const day = date.getDate();
    //     const month = months[date.getMonth()];
    //     const year = date.getFullYear();
    //     return `${day} ${month} ${year}`;
    // }

    function formatDate(dateString) {
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const date = new Date(dateString);
        
        const day = date.getDate();
        const month = months[date.getMonth()];
        const year = date.getFullYear();
        
        const hours = String(date.getHours()).padStart(2, '0');  // Adds leading zero if necessary
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');
        
        return `${day} ${month} ${year} ${hours}:${minutes}:${seconds}`;
    }


    function redirect_single_product(product_id) {
        if ($(event.target).hasClass('stock_number_bx') || $(event.target).hasClass('btn-number')) {
            return false
        }else{
            window.location.href = "<?= base_url('/admin/product?p_id=') ?>" + product_id;
        }
    }

    function updateStock(product_id,type){
        let stock = parseInt($(`#input-stock-${product_id}`).val())
        stock = type == 'add' ? stock + 1 : stock  - 1;

        $.ajax({
            url: "<?= base_url('/api/product/stock/update') ?>",
            type: "GET",
            data: {
                p_id : product_id,
                stock: stock
            },
            beforeSend: function(){
                $(`#btn-stock-add-${product_id}`).attr('disabled', true)
                $(`#btn-stock-sub-${product_id}`).attr('disabled', true)
            },
            success: function(resp){
                $(`#btn-stock-add-${product_id}`).attr('disabled', false)
                $(`#btn-stock-sub-${product_id}`).attr('disabled', false)
                if(resp.status){
                    $(`#input-stock-${product_id}`).val(stock)
                    $('#alert').html(`<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                                        <i class="ri-checkbox-circle-fill label-icon"></i><strong>${resp.message}</strong>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>`) 
                }
            },
            error: function(err){
                console.log(err)
                $(`#btn-stock-add-${product_id}`).attr('disabled', false)
                $(`#btn-stock-sub-${product_id}`).attr('disabled', false)
                $('#alert').html(`<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                                    <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Internal Server Error
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>`)
            }
        })

    }


    function load_products() {
        let user_type = '<?= !empty($_SESSION[SES_ADMIN_TYPE]) ? $_SESSION[SES_ADMIN_TYPE] : $_SESSION[SES_STAFF_TYPE] ?>'
        $.ajax({
            url: "<?= base_url('/api/product') ?>",
            type: "GET",
            data:{user_type:user_type},
            beforeSend: function () {
                $('#table-product-list-all-body').html(`<tr >
                        <td colspan="7"  style="text-align:center;">
                            <div class="spinner-border" role="status"></div>
                        </td>
                    </tr>`)
            },
            success: function (resp) {
                if (resp.status) {
                    if (resp.data.length > 0) {
                        $('#all_product_count').html(resp.data.length)
                        let html = ``
                        console.log(resp)
                        // $.each(resp.data, function (index, product) {
                        //     let product_img = product.product_img.length > 0 ? '<?= base_url('public/uploads/product_images/') ?>'+product.product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                        //     html += `<tr onclick="redirect_single_product('${product.product_id}')">
                        //                     <td >
                        //                         <p>${product.name.slice(0, 15) + (product.name.length > 15 ? '...' : '')}</p>
                        //                         <img src="${product_img}" alt="" class="product-img">
                        //                     </td>
                        //                     <td >
                        //                         ${product.category}
                        //                     </td>
                        //                     <td >
                        //                        <!-- ${product.publish_date == '' ? formatDate(product.created_at) : formatDate(product.publish_date)} -->
                        //                        ${formatDate(product.created_at)}
                        //                     </td>
                        //                     <td >
                        //                         Base Price : ₹${product.product_prices != "" ? product.product_prices[0].price : ''} - ₹${product.product_prices != "" ? product.product_prices[product.product_prices.length-1].price : ''} <br>
                        //                         Discount : ${product.base_discount} %<br>
                        //                         Tax : <b class="fs-16 text-success">${product.tax}%</b>
                        //                     </td>
                        //                     <td >
                        //                         <sapn class="badge bg-success-subtle text-success text-uppercase">${product.visibility}</sapn>
                        //                     </td>
                        //                     <td >
                        //                         ${product.vendor}
                        //                     </td>
                        //                     <td >
                        //                         <select class="form-control" id="product_status"  onclick="event.stopPropagation()" onchange="update_product_status('${product.product_id}', this)">
                        //                             <option value="${product.product_status}" selected>${product.product_status}</option>
                        //                             <option value="active">active</option>
                        //                             <option value="deactive">deactive</option>
                        //                         </select>
                        //                     </td>
                        //                 </tr>`
                        // })

                        $.each(resp.data.sort(function(a, b) {
                            // Convert the 'created_at' to date format and compare
                            let dateA = new Date(a.created_at);
                            let dateB = new Date(b.created_at);
                            
                            // Sort in ascending order. Change to dateB - dateA for descending order.
                            return dateB - dateA; 
                        }), function(index, product) {
                            let product_img = product.product_img.length > 0 ? '<?= base_url('public/uploads/product_images/') ?>'+product.product_img[0]['src'] : '<?= base_url('public/assets/images/product_demo.png') ?>'
                            html += `<tr onclick="redirect_single_product('${product.product_id}')">
                                            <td>
                                                <p>${product.name.slice(0, 15) + (product.name.length > 15 ? '...' : '')}</p>
                                                <img src="${product_img}" alt="" class="product-img">
                                            </td>
                                            <td>
                                                ${product.category}
                                            </td>
                                            <td>
                                                ${formatDate(product.created_at)}
                                            </td>
                                            <td>
                                                MRP : ₹${product.mrp != "" ? product.mrp : ''} <br>
                                                Rate : ₹${product.base_price}<br>
                                            </td>
                                            <td>
                                                <sapn class="badge bg-success-subtle text-success text-uppercase">${product.visibility}</sapn>
                                            </td>
                                            <td>
                                                ${product.vendor}
                                            </td>
                                            <td>
                                                <select class="form-control" id="product_status" onclick="event.stopPropagation()" onchange="update_product_status('${product.product_id}', this)">
                                                    <option value="${product.product_status}" selected>${product.product_status}</option>
                                                    <option value="active">active</option>
                                                    <option value="deactive">deactive</option>
                                                </select>
                                            </td>
                                        </tr>`;
                        });

                        $('#table-product-list-all-body').html(html)
                        // $('#table-product-list-all').DataTable();
                        // $('#table-product-list-all').DataTable({
                        //     order: [[2, 'asc']] 
                        // });

                        $('#table-product-list-all').DataTable({
                        order: [[2, 'desc']], // Sort the third column by default in ascending order
                        columnDefs: [
                            {
                                targets: 2, // Column index (0-based, so 2 is the third column)
                                type: 'date', // Define the column as containing dates
                                render: function(data, type, row) {
                                    // Ensure the date format is JavaScript friendly (e.g., convert '13 January 2025' to '2025-01-13')
                                    if (type === 'sort') {
                                        // Return a date format that can be sorted
                                        return new Date(data).toISOString();
                                    }
                                    // Return the original date format for display
                                    return data;
                                }
                            }
                        ]
                    });

                    }
                }

            },
            error: function (err) {
                console.log(err)
            },
            complete: function () {

            }
        })
    }

    function update_product_status(product_id, selectElement){
        let status = $(selectElement).val()
        // alert(status)
        $.ajax({
                url: "<?= base_url('/api/update/product-status') ?>",
                type: "POST",
                data: {product_id:product_id,
                    status:status
                },
                beforeSend: function () {
                },
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
                    console.log(resp)
                },
                error: function (err) {
                    console.log(err)
                },
                complete: function () {
                }
            })
    }


    function upload_excel_file(){
        let user_id = '<?= !empty($_SESSION[SES_ADMIN_USER_ID]) ? $_SESSION[SES_ADMIN_USER_ID] : '' ?>'
        var formData = new FormData();

            const fileInput = $('#excel_file')[0].files[0];

            formData.append('excel_file',fileInput);
            formData.append('user_id',user_id);
            
            $.ajax({
                url: "<?= base_url('/api/upload/product/excel') ?>",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    // $('#product_add_btn').html(`<div class="spinner-border" role="status"></div>`)
                    // $('#product_add_btn').attr('disabled', true)

                },
                success: function (resp) {
                    let html = ''

                    if (resp.status) {
                        html += `<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                <i class="ri-checkbox-circle-fill label-icon"></i>${resp.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`
                            load_products()
                        // $('#product-discount-input').val(``)
                        // $imageContainer.html(``);
                        // $numOfFiles.html(``);
                        // clearImages($("#images"), $("#num-of-files"));
                        // clearImages($("#images2"), $("#num-of-files2"));
                        // get_size_list()
                        
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
                    // $('#product_add_btn').html(`submit`)
                    // $('#product_add_btn').attr('disabled', false)
                }
            })
    }



</script>













<!-- <td >
                                                <div class="input-group stock_number_bx">
                                                    <span class="input-group-btn btn-number">
                                                        <button 
                                                            type="button" 
                                                            class="quantity-left-minus btn btn-danger btn-number"
                                                            data-type="minus" 
                                                            data-field=""
                                                            id="btn-stock-sub-${product.product_id}"
                                                            onClick="updateStock('${product.product_id}','sub')">
                                                            <span>-</span>
                                                        </button>
                                                    </span>
                                                    <input 
                                                        type="text" 
                                                        name="quantity" 
                                                        class="stock_number btn-number" 
                                                        value="${product.product_stock}" 
                                                        id="input-stock-${product.product_id}"
                                                        readonly>
                                                    <span class="input-group-btn btn-number">
                                                        <button 
                                                            type="button" 
                                                            class="quantity-right-plus btn btn-success btn-number"
                                                            data-type="plus" 
                                                            data-field=""
                                                            id="btn-stock-add-${product.product_id}"
                                                            onClick="updateStock('${product.product_id}','add')">
                                                            <span>+</span>
                                                        </button>
                                                    </span>
                                                </div>
                                            </td> -->