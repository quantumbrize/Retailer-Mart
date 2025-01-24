<script>
    
    user_id = '<?= isset($_SESSION['USER_user_id']) ? $_SESSION['USER_user_id'] : '' ?>'
    // console.log(user_id)
    let user_cart = 0;
    get_cart()
    function get_cart() {
        $.ajax({
            url: '<?= base_url('/api/user/cart') ?>',
            type: "GET",
            data: {
                user_id: user_id
            },
            beforeSend: function () { },
            success: function (resp) {
                // alert('hello')
                console.log('cart', resp)
                user_cart = resp.data.length
                if (resp.status) {
                    let html = ``
                    let subTotal = 0
                    let delivery_charge = 0
                    $.each(resp.data, function(index, item) {
                        let product_image = ''
                            if(item.product.product_img != ""){
                                product_image = `<?= base_url()?>${item.img_url}${item.product.product_img[0].src}`
                            } else {
                                product_image = '<?= base_url('public/assets/images/product_demo.png') ?>'
                            }
                        // let truncatedDescription = ''
                        var original_price = item.product.base_discount ? (item.product.base_price - (item.product.base_price * (item.product.base_discount / 100))).toFixed(2) : item.product.base_price;
                        var base_price = item.product.base_discount ? item.product.base_discount : "";
                        // subTotal += parseInt(original_price, 10) * parseInt(item.qty, 10)
                        // console.log('hello', item.product.product_prices)
                        let truncatedDescription = truncateText(item.product.description, 150);
                        let actual_price = ''
                        $.each(item.product.product_prices, function(index, prices) {
                            // console.log(prices)
                            if(parseInt(item.qty)>= parseInt(prices.min_qty) && parseInt(item.qty) <= parseInt(prices.max_qty)){
                                actual_price = prices.price
                                // subTotal += parseInt(actual_price) * parseInt(item.qty)
                            }
                            
                        })

                        let qty = item.qty; // Quantity of the product
                        let base_discount = parseInt(item.product.base_discount); // Discount percentage
                        let tax = parseInt(item.product.tax); // Tax percentage
                        let discounted_price = actual_price * qty - ((actual_price * qty) * base_discount / 100);
                        let tax_amount = discounted_price * tax / 100;
                        let final_price = discounted_price + tax_amount;
                        subTotal += final_price
                        delivery_charge += parseInt(item.product.delivery_charge)
                        // console.log(actual_price)
                        html += `<tr>
                                        <td class="product-thumbnail">
                                            <div class="p-relative">
                                                <a href="<?= base_url('product/details?id=')?>${item.product.product_id}" onclick="increase_click_count('${item.product.product_id}')">
                                                    <figure>
                                                        <img src="${product_image}" alt="product" width="300" height="338">
                                                    </figure>
                                                </a>
                                                <button type="submit" class="btn btn-close" onclick="remove_cart_item('${item.cart_id}')"><i class="fas fa-times"></i></button>
                                            </div>
                                        </td>
                                        <td class="product-name">
                                            <a href="<?= base_url('product/details?id=')?>${item.product.product_id}" onclick="increase_click_count('${item.product.product_id}')" >
                                                ${item.product.name}
                                            </a>
                                        </td>
                                        <td class="product-price"><span class="amount">₹${actual_price}</span></td>
                                        <td class="product-quantity">
                                            <div class="input-group">
                                                <input class="quantity form-control" type="number" value="${item.qty}" min="1" max="100000" readonly>
                                                <button class="quantity-plus w-icon-plus" onClick="updateCartItem('${item.cart_id}', '${parseInt(item.qty) + 1}', ${item.product.product_prices[item.product.product_prices.length - 1].max_qty}, '${JSON.stringify(item.product.product_prices).replace(/'/g, "\\'").replace(/"/g, '&quot;')}')"></button>
                                                <button class="quantity-minus w-icon-minus" onClick="updateCartItem('${item.cart_id}', '${item.qty == 1 ? 1 : parseInt(item.qty) - 1}', ${item.product.product_prices[item.product.product_prices.length - 1].max_qty}, '${JSON.stringify(item.product.product_prices).replace(/'/g, "\\'").replace(/"/g, '&quot;')}')"></button>
                                            </div>
                                        </td>
                                        <td class="product-price"><span class="amount">${base_discount}%</span></td>
                                        <td class="product-price"><span class="amount">${tax}%</span></td>
                                        <td class="product-subtotal">
                                            <span class="amount">₹${final_price.toFixed(2)}</span>
                                        </td>
                                    </tr>`
                    })
                    $('#cart_item').html(html)
                    $('.subtotal_amount').html(`₹`+subTotal.toFixed(2))
                    $('.shipping_charge').html(`₹`+delivery_charge)
                    let grand_total = subTotal+delivery_charge
                    $('.total_amount').html(`₹` + grand_total.toFixed(2));
                    // $.ajax({
                    //     url: "<?= base_url('/api/taxes') ?>",
                    //     type: "GET",
                    //     success: function (response) {
                    //         if (response.status) {
                    //             console.log(response);
                    //             if (response.data.tax != '0' && response.data.tax != null && response.data.tax != "") {
                    //                 $('#tax_fee').html(`₹` + response.data.tax);
                    //                 grand_total +=  parseInt(response.data.tax, 10);
                    //             } else {
                    //                 $('#tax_fee').html(`<p style="color: green;">Free</p>`);
                    //             }

                    //             if (response.data.delivary_charge != '0' && response.data.delivary_charge != null && response.data.delivary_charge != "") {
                    //                 $('#delivary_charge').html(`₹` + response.data.delivary_charge);
                    //                 grand_total +=  parseInt(response.data.delivary_charge, 10);
                    //             } else {
                    //                 $('#delivary_charge').html(`<p style="color: green;">Free</p>`);
                    //             }
                    //             $('.checkout_button').html(`<p class="total-price">₹${grand_total} </p>
                    //                             <a href="<?= base_url('billing')?>">
                    //                             <button class="checkout">Checkout</button>
                    //                             </a>`)
                    //         } else {
                    //             console.log(response);
                    //         }
                    //     },
                    //     error: function (err) {
                    //         console.log(err);
                    //     },
                    // });

                    

                    // total_cart_item = resp.data.length
                    
                    // $('#total_cart_items').html(total_cart_item)
                    // console.log(total_cart_item)
                }else{
                    $('#cart_item').html("")
                    $('.subtotal_amount').html(`₹`+ 0)
                    $('.checkout_button').html(`<p class="total-price">₹0 </p>
                                                <a href="javascript:void(0)" onclick="billing_icomplete()">
                                                <button class="checkout btn_disabled">Checkout</button>
                                                </a>`)
                }

            },
            error: function (err) {
                console.error(err)
            }
        })
    }

    function truncateText(text, maxLength) {
        if (text.length > maxLength) {
            return text.substring(0, maxLength) + '...';
        } else {
            return text;
        }
    }

    function redirect_to_billing() {
        // alert(user_cart.length)
        if(user_cart < 1){
            Toastify({
                text: 'Your Cart is empty!'.toUpperCase(),
                duration: 3000,
                position: "center",
                stopOnFocus: true,
                style: {
                    background: 'darkred',
                },

            }).showToast();
        } else {
            window.location.href = "<?= base_url('user/cart/checkout') ?>"
        }
        
    }

    // function updateCartItem(cartId, qty, product_quantity, price_list) {
    //     // console.log(cartId , qty, product_quantity)
    //     let prices = JSON.parse(price_list);
    //     console.log(prices)
    //     if(qty <= product_quantity){
    //         $.ajax({
    //             url: '<?= base_url('/api/user/cart/item/update') ?>',
    //             data: {
    //                 cart_id: cartId,
    //                 qty: qty
    //             },
    //             beforeSend: function () { },
    //             success: function (resp) { get_cart(); },
    //             error: function (err) { console.error(err) }
    //         })
    //     } else {
    //         Toastify({
    //             text: 'Stock Does not exist!'.toUpperCase(),
    //             duration: 3000,
    //             position: "center",
    //             stopOnFocus: true,
    //             style: {
    //                 background:'darkred',
    //             },
    //         }).showToast();
    //     }
        

    // }

    // function updateCartItem(cartId, qty, product_quantity, price_list) {
    //     // Parse the price list
    //     let prices = JSON.parse(price_list);

    //     // Sort prices by min_qty in ascending order to ensure correct logic
    //     prices.sort((a, b) => parseInt(a.min_qty) - parseInt(b.min_qty));

    //     // Find the current range based on the quantity
    //     let currentIndex = prices.findIndex(price => qty >= parseInt(price.min_qty) && qty <= parseInt(price.max_qty));

    //     if (currentIndex === -1) {
    //         // If the quantity doesn't match any range, default to the first range
    //         currentIndex = 0;
    //     }

    //     let currentRange = prices[currentIndex];
    //     let min_qty = parseInt(currentRange.min_qty);
    //     let max_qty = parseInt(currentRange.max_qty);

    //     // Adjust the quantity
    //     if (qty > max_qty && currentIndex < prices.length - 1) {
    //         // Move to the next range
    //         currentIndex++;
    //         qty = parseInt(prices[currentIndex].min_qty);
    //     } else if (qty < min_qty && currentIndex > 0) {
    //         // Move to the previous range
    //         currentIndex--;
    //         qty = parseInt(prices[currentIndex].max_qty);
    //     }

    //     // Log the adjusted quantity for debugging
    //     console.log('Adjusted Quantity:', qty, 'Current Range:', prices[currentIndex]);

    //     // Proceed with the AJAX request if quantity is valid
    //     if (qty >= parseInt(prices[0].min_qty) && qty <= parseInt(prices[prices.length - 1].max_qty)) {
    //         $.ajax({
    //             url: '<?= base_url("/api/user/cart/item/update") ?>',
    //             data: {
    //                 cart_id: cartId,
    //                 qty: qty
    //             },
    //             beforeSend: function () { },
    //             success: function (resp) { get_cart(); },
    //             error: function (err) { console.error(err); }
    //         });
    //     } else {
    //         // Show an error toast if qty is out of range
    //         Toastify({
    //             text: 'Quantity is out of range!'.toUpperCase(),
    //             duration: 3000,
    //             position: "center",
    //             stopOnFocus: true,
    //             style: {
    //                 background: 'darkred',
    //             },
    //         }).showToast();
    //     }
    // }


    function updateCartItem(cartId, qty, product_quantity, price_list) {
    // Parse the price list and ensure it's sorted by min_qty
    let prices = JSON.parse(price_list);
    prices.sort((a, b) => parseInt(a.min_qty) - parseInt(b.min_qty));

    // Find the current range index based on the quantity
    let currentIndex = prices.findIndex(price => qty >= parseInt(price.min_qty) && qty <= parseInt(price.max_qty));

    if (currentIndex === -1) {
        // If qty doesn't match any range, find closest range
        if (qty < parseInt(prices[0].min_qty)) {
            currentIndex = 0;
        } else if (qty > parseInt(prices[prices.length - 1].max_qty)) {
            currentIndex = prices.length - 1;
        }
    }

    let currentRange = prices[currentIndex];
    let min_qty = parseInt(currentRange.min_qty);
    let max_qty = parseInt(currentRange.max_qty);

    // Adjust the quantity based on the range
    if (qty < min_qty && currentIndex > 0) {
        // Move to the previous range
        currentIndex--;
        qty = parseInt(prices[currentIndex].max_qty);
    } else if (qty > max_qty && currentIndex < prices.length - 1) {
        // Move to the next range
        currentIndex++;
        qty = parseInt(prices[currentIndex].min_qty);
    }

    console.log('Adjusted Quantity:', qty, 'Current Range:', prices[currentIndex]);

    // Check if quantity is valid within the overall price range
    let overallMinQty = parseInt(prices[0].min_qty);
    let overallMaxQty = parseInt(prices[prices.length - 1].max_qty);

    if (qty >= overallMinQty && qty <= overallMaxQty) {
        // Make the AJAX call to update the cart item
        $.ajax({
            url: '<?= base_url("/api/user/cart/item/update") ?>',
            data: { cart_id: cartId, qty: qty },
            beforeSend: function () { },
            success: function (resp) { get_cart(); },
            error: function (err) { console.error(err); }
        });
    } else {
        // Show an error if the quantity is out of range
        Toastify({
            text: 'Quantity is out of range!'.toUpperCase(),
            duration: 3000,
            position: "center",
            stopOnFocus: true,
            style: {
                background: 'darkred',
            },
        }).showToast();
    }
}







    let cart_item_id = ""
    function remove_cart_item(cart_id) {
        $('#removeItemModal').modal('show')
        cart_item_id = cart_id;
        // console.log(cart_item_id)
    }

    function delete_the_cart_item() {
        $.ajax({
            url: "<?= base_url('/api/user/cart/remove') ?>",
            type: "GET",
            data: { cart_id: cart_item_id },
            success: function (resp) {

                if (resp.status) {
                    // console.log(resp)
                    Toastify({
                        text: resp.message.toUpperCase(),
                        duration: 2000,
                        position: "center",
                        stopOnFocus: true,
                        style: {
                            background: resp.status ? 'gray' : 'darkred',
                        },

                    }).showToast();

                    cart_item_id = "";
                    $('#removeItemModal').modal('hide')
                } else {
                    Toastify({
                        text: resp.message.toUpperCase(),
                        duration: 2000,
                        position: "center",
                        stopOnFocus: true,
                        style: {
                            background: resp.status ? 'gray' : 'darkred',
                        },

                    }).showToast();
                    // console.log(resp)
                }
                // get_cart_header()
                get_cart()
                get_user()
                show_cart_length()

            },
            error: function (err) {
                console.log(err)
            },
        })


    }

    function billing_icomplete(){
        Toastify({
            text: 'Your Cart is empty!'.toUpperCase(),
            duration: 3000,
            position: "center",
            stopOnFocus: true,
            style: {
                background: 'darkred',
            },

        }).showToast();
    }
</script>