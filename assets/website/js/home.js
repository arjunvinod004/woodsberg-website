$(document).ready(function () {
    let base_url = $("#base_url").val();
    
 //MARK: Add to cart   

    $(document).on('submit', '#add_cart_form', function (e) 
    {
        e.preventDefault();
        var form = $(this);
        var $portfolio = form.closest('.portfolio-title');
        var quantity = $portfolio.find('[data-qty]').text();
        var product_id = form.find('#cart_product_id').val();
        var price = form.find('#price').val();
        var product_price = form.find('#product_price').val();
        var product_weight = form.find('#product_weight').val();
        var product_kg_g = form.find('#product_kg_g').val();
        $.ajax({
            url: base_url + 'cart/cart',
            type: 'POST',
            dataType: 'json',
            data: {
                cart_product_id: product_id,
                quantity: quantity,
                price: price,
                product_price: product_price,
                product_weight: product_weight,
                product_kg_g: product_kg_g

            },
            success: function (response) {
                if(response.error) {
               alert(response.message);
                }
                else{
                 loadcart();
                }
               
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: " + status + ": " + error);
            }
        });
    });


        function loadcart() {
        //  alert('load');
        $.ajax({
            url: base_url + 'cart/loadcart',
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                console.log(response);
                setTimeout(function () {
                    $('.alert-success').removeClass('d-none');
                    $('.alert-success').html(response.message + ' <a href="' + base_url + 'cart" class="btn btn-link btn-view-cart ">View Cart</a>');

                    if(response.ordertype == 'exp'){
                    $symbol = '$';
                    }
                    else{
                    $symbol = '₹';
                    }
                    $('.sumofprice').text( $symbol + response.totalprice);
                    $('.total-discount').text(response.total_amount);
                    $('#total_price').val(response.totalprice);
                    $('.delivery-charge').text('Delivery charge (total weight: ' + response.weightcalculation + ')');
                    $('#weight').val(response.weightcalculation);
                    setTimeout(function () {
                        $('.alert-success').addClass('d-none');
                    }, 8000);

                }, 1000);
                loadcartitems(); // 🔁 Load cart count on page refresh


            }
        })
    }

    $(document).ready(function () {
        loadcartitems(); // 🔁 Load cart count on page refresh
    });


    function loadcartitems() 
    {
        $.ajax({
            url: base_url + 'cart/loadcartitems',
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                if (response.cartcount > 0) {
                    $('.badge-count').text(response.cartcount);
                }
                $('#cart_item').html(response.html);
            }
        })
    }

    //MARK:  Cart Increment quantity

        $(document).on('click', '.cart-increment-btn', function () {
        var $btn = $(this); // FIXED
        var $portfolio = $btn.closest('.qty-area');
        var product_id = $portfolio.find('#cart_product_id').val();
        var product_price = $portfolio.find('#product_price').val();
        var $qtySpan = $portfolio.find('[data-qty]');
        var token = $portfolio.find('#token').val();
        var currentQty = parseInt($qtySpan.text());
        var newQty = currentQty + 1; // increment by 1
        var row = $btn.closest('tr'); // FIXED: was using 'btn' instead of '$btn'
        var unitPrice = parseFloat(row.find('.price-carts').data('price')) || 0;
        var totalPrice = newQty * unitPrice;
        var quantity = newQty;
        var weight = $portfolio.find('#weight-calculation').val();
        var match = weight.match(/^([\d.]+)\s*(kg|g)$/i);

        if (match) {
            var weightValue = parseFloat(match[1]);
            var unit = match[2].toLowerCase(); // "g" or "kg"
            if (unit === "kg") {
                weightValue = weightValue * 1000;
            }

            var totalWeight = weightValue * quantity; // now in grams

            var calculateweight;
            if (totalWeight >= 1000) {
                calculateweight = (totalWeight / 1000) + "kg";
            } else {
                calculateweight = totalWeight + "g";
            }
        }

        var price = totalPrice.toFixed(2);
        $.ajax({
            url: base_url + 'website/Stockcheck/index',
            type: 'POST',
            data: {
                'product_id': product_id
            },
            dataType: 'json',
            success: function (response) {
                if (response.success === 'success') {
                    var current_available_stock = parseInt(response.stock);

                    if (newQty <= current_available_stock) {

                        // ✅ Update DOM
                        $qtySpan.text(newQty);
                        var ordertype = $portfolio.find('.ordertype').val();
                        // alert(ordertype);
                         if(ordertype=='exp'){
                            $symbol = '$'; 
                         }
                         else{
                            $symbol = '₹';
                         }
                         row.find('.price-cart').text( $symbol + totalPrice.toFixed(2)).attr('data-price', totalPrice);
                        // ✅ Now send the update to the database
                        $.ajax({
                            url: base_url + 'cart/cart',
                            type: 'POST',
                            data: {
                                cart_product_id: product_id,
                                quantity: newQty,
                                price: price,
                                calculateweight: calculateweight,
                                product_price: product_price
                            },
                            success: function (response) {
                                loadcart(); 
                            },
                            error: function (xhr, status, error) {
                                console.error("AJAX Error: " + status + ": " + error);
                            }
                        });

                    } else {
                         $('.cart-increment-btn[data-product-id="' + product_id + '"]').prop('disabled', true);
                    }

                } else {
                    alert('Something went wrong while checking stock.');
                }
            }
        });

    });


//MARK:  Cart Decrement quantity

        $(document).on('click', '.cart-decrement-btn', function (e) {
        var $btn = $(this); // FIXED
        var row = $btn.closest('tr');
        var $portfolio = $btn.closest('.qty-area');
        var product_id = $portfolio.find('#cart_product_id').val();
        var product_price = $portfolio.find('#product_price').val();
        var $qtySpan = $portfolio.find('[data-qty]');
        var currentQty = parseInt($qtySpan.text());
        var newQty = currentQty > 1 ? currentQty - 1 : 1;
        var unitPrice = parseFloat(row.find('.price-carts').data('price')) || 0;
        var totalPrice = newQty * unitPrice;
         var ordertype = $portfolio.find('.ordertype').val();
                         if(ordertype=='exp'){
                            $symbol = '$'; 
                         }
                         else{
                            $symbol = '₹';
                         }
        row.find('.price-cart').text( $symbol + totalPrice.toFixed(2)).attr('data-price', totalPrice); // keep unit price in attr
        $qtySpan.text(newQty);
        $('.cart-increment-btn[data-product-id="' + product_id + '"]').prop('disabled', false);
        if (currentQty <= 1) {
            // Call delete API
            $.ajax({
                url: base_url + 'cart/deletecart',
                type: 'POST',
                data: {
                    deletecart: product_id
                },
                success: function (response) {
                    location.reload(); 
                },
                error: function (xhr, status, error) {
                    console.error("Delete AJAX Error: " + status + ": " + error);
                }
            });
            return;
        }

        // Calculate and update total price
        var totalPrice = newQty * unitPrice;
        var quantity = newQty;
        var price = totalPrice.toFixed(2);
        var weight = $portfolio.find('#weight-calculation').val();
        var match = weight.match(/^([\d.]+)\s*(kg|g)$/i);

        if (match) {
            var weightValue = parseFloat(match[1]);
            var unit = match[2].toLowerCase(); // "g" or "kg"
            if (unit === "kg") {
                weightValue = weightValue * 1000;
            }

            var totalWeight = weightValue * quantity; // now in grams

            var calculateweight;
            if (totalWeight >= 1000) {
                calculateweight = (totalWeight / 1000) + "kg";
            } else {
                calculateweight = totalWeight + "g";
            }
        }

        $.ajax({
            url: base_url + 'cart/cart',
            type: 'POST',
            data: {
                cart_product_id: product_id,
                quantity: quantity,
                price: price,
                calculateweight: calculateweight,
                product_price: product_price
            },
            // dataType: 'json',
            success: function (response) {
                loadcart();
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: " + status + ": " + error);
            }
        });
    });

       //41. cart quantity increment 
    $(document).off('click', '.increment-btn').on('click', '.increment-btn', function (e) {
        stockcheck(this);
    });


//MARK: increment
        $(document).off('click', '.increment-btn').on('click', '.increment-btn', function (e) {
        stockcheck(this);
    });




    //MARK: decrement
    $(document).off('click', '.decrement-btn').on('click', '.decrement-btn', function (e) {
        var $btn = $(this);
        var product = $btn.closest('.product-item');
        var qtyArea = $btn.closest('.qty-area');
        var portfolio = $btn.closest('.portfolio-title');
        var qty = parseInt(qtyArea.find('span[data-qty]').text()) || 1; // default to 1 if not a number
        var newQty = qty > 1 ? qty - 1 : 1; // prevent going below 1
        qtyArea.find('span[data-qty]').text(newQty);
        qtyArea.find('span[data-qty]').text(newQty);
        // Get unit price
        var unitPrice = parseFloat(portfolio.find('.price-cart').data('price')) || 0;
        $('.increment-btn').prop('disabled', false);
        var totalPrice = newQty * unitPrice;
        // Update form inputs
        var form = product.find('form');
        form.find('.qty-input').val(newQty);
        form.find('.qty-price').val(totalPrice);
    });


//MARK: stockcheck function

function stockcheck(button) 
{
    var $btn = $(button);
    var $portfolio = $btn.closest('.portfolio-title');
    var product_id = $portfolio.find('a[data-id]').data('id');
    var $qtySpan = $portfolio.find('[data-qty]');
    var $product = $btn.closest('.product-item');
    var currentQty = parseInt($qtySpan.text());
    var newQty = currentQty + 1;
    $.ajax({
        url: base_url + 'website/stockcheck/index',
        type: 'POST',
        data: { 'product_id': product_id },
        dataType: 'json',
        success: function (response) {
            if (response.success === 'success') {
                var stock = parseInt(response.stock);

                if (newQty <= stock) {
                    $qtySpan.text(newQty);
                    // Update the related input fields and total price
                 
                    var $form = $product.find('form');
                    var unitPrice = parseFloat($portfolio.find('.price-cart').data('price')) || 0;
                    var totalPrice = newQty * unitPrice;
                    $form.find('#quantity').val(newQty);
                    $form.find('.qty-price').val(totalPrice);
                    // $portfolio.find('.price-cart').text("₹" + totalPrice.toFixed(2));

                } else {
                    $btn.prop('disabled', true);
                }
            } else {
                alert('Something went wrong.');
            }
        }
    });
}

//MARK: get_total_shipping_charge
    function get_total_shipping_charge() {
    let token = $('#token').val();
    // ✅ Declare variables outside AJAX so they exist for return
    let shipping_charge = 0;
    let total_qty = 0;
    let charge = 0;
    $.ajax({
        url: base_url + 'home/getshippingvalue',
        type: 'POST',
        data: { token: token },
        dataType: 'json',
        async: false, // synchronous call
        success: function(response) {
            if (response.success === 'success') {
                shipping_charge = response.shipping_charge;
                total_qty = response.total_qty;
                charge = response.charge ?? 0;
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
        }
    });

    // ✅ Return all values as an object
    return {
        shipping_charge: shipping_charge,
        total_qty: total_qty,
        charge: charge
    };
}

//MARK: saveuserorder in retail
    $('#saveuserorder').click(function (e) 
    {
        let total_amount = $('.totalamount').text().trim().replace(/(₹|Rs\.?|Rupees)\s*/i,'');
        let result = get_total_shipping_charge();
        let shipping_charge = result.charge;
        let state = $('.state').val();
        let formData = new FormData($('#usercheckout')[0]);
        formData.append('total_amount', total_amount);
        formData.append('shipping_charge', shipping_charge);
        formData.append('state', state);
        console.log(formData);
        $.ajax({
            url: base_url + 'home/addusercheckout',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                if (response.success === 'success') 
                {
                    $('.alert-success').removeClass('d-none');
                    $('.alert-success').removeClass('d-none').text(response.outofstock);
                    $('.alert-danger').addClass('d-none');
                    if (response.redirect_url) 
                    {
                        const form = $('<form>', 
                        {
                        action: response.redirect_url,
                        method: 'POST'
                        });

                        form.append($('<input>', {
                            type: 'hidden',
                            name: 'query',
                            value: JSON.stringify(response.query)
                        }));
                        console.log(response.query);
                        

                        form.append($('<input>', {
                            type: 'hidden',
                            name: 'cartitems',
                            value: JSON.stringify(response.cartitems)
                        }));

                        $('body').append(form);
                        form[0].submit();
                    } 

                    $('#usercheckout')[0].reset();
                    $('#checkout_username_error').html('');
                    $('#checkout_useremail_error').html('');
                    $('#checkout_userphone_error').html('');
                    $('#checkout_usercountry_error').html('');
                    $('#checkout_usercity_error').html('');
                    $('#checkout_userpostcode_error').html('');
                    $('#checkout_useraddress_error').html('');
                    $('#checkout_company_name_error').html('');
                     $('#checkout_userstate_error').html('');
                }

                else {
                    $('#checkout_username_error').html('');
                    $('#checkout_useremail_error').html('');
                    $('#checkout_userphone_error').html('');
                    $('#checkout_usercountry_error').html('');
                    $('#checkout_usercity_error').html('');
                    $('#checkout_userpostcode_error').html('');
                    $('#checkout_company_name_error').html('')
                     $('#checkout_userstate_error').html('');

                    if (response.errors.checkout_company_name) {
                    $('#checkout_company_name_error').html(response.errors.checkout_company_name);
                    }
                    else {
                        $('#checkout_company_name_error').html('');
                    }

                    if (response.errors.checkout_username) {
                        $('#checkout_username_error').html(response.errors.checkout_username);
                    }
                    else {
                        $('#checkout_username_error').html('');
                    }
                    if (response.errors.checkout_useremail) {
                        $('#checkout_useremail_error').html(response.errors.checkout_useremail);
                    }
                    else {
                        $('#checkout_useremail_error').html('');
                    }
                    if (response.errors.checkout_userphone) {
                        $('#checkout_userphone_error').html(response.errors.checkout_userphone);
                    }
                    else {
                        $('#checkout_userphone_error').html('');
                    }
                    if (response.errors.checkout_usercountry) {
                        $('#checkout_usercountry_error').html(response.errors.checkout_usercountry);
                    }
                    else {
                        $('#checkout_usercountry_error').html('');
                    }

                    if (response.errors.checkout_usercity) {
                        $('#checkout_usercity_error').html(response.errors.checkout_usercity);
                    }
                    else {
                        $('#checkout_usercity_error').html('');
                    }
                    if (response.errors.checkout_userpostcode) {
                        $('#checkout_userpostcode_error').html(response.errors.checkout_userpostcode);
                    }
                    else {
                        $('#checkout_userpostcode_error').html('');
                    }

                    if (response.errors.checkout_useraddress) {
                        $('#checkout_useraddress_error').html(response.errors.checkout_useraddress);
                    }
                    else {
                        $('#checkout_useraddress_error').html('');
                    }

                    if(response.errors.state){
                        $('#checkout_userstate_error').html(response.errors.state);
                    }
                    else{
                        $('#checkout_userstate_error').html('');
                    }

                }

            },
            error: function (xhr, status, error) {
                   alert('Server issue, please try again later.');
            }
        });
    });


    //MARK: savewholesaleorder


    $('#savewholesaleorder').click(function (e) 
    {
        let total_amount = $('.totalamount').text().trim().replace(/(₹|Rs\.?|Rupees)\s*/i,'');
        let formData = new FormData($('#usercheckout')[0]);
        formData.append('total_amount', total_amount);
        console.log(formData);
        $.ajax({
            url: base_url + 'home/addwholesalecheckout',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                $('#savewholesaleorder').prop('disabled', false).text('Place Order');
                if (response.success === 'success') 
                {
                    
                    $('.alert-success').removeClass('d-none');
                    $('.alert-success').removeClass('d-none').text(response.outofstock);
                    $('.alert-danger').addClass('d-none');
                    $('#usercheckout')[0].reset();
                     if(response.ordertype == 'ws'){
                    window.location.href = base_url + 'wholesale';    
                    }
                    $('#checkout_username_error').html('');
                    $('#checkout_useremail_error').html('');
                    $('#checkout_userphone_error').html('');
                }

                else {
                   
                    $('#checkout_username_error').html('');
                    $('#checkout_useremail_error').html('');
                    $('#checkout_userphone_error').html('');
                   

                    if (response.errors.checkout_username) {
                        $('#checkout_username_error').html(response.errors.checkout_username);
                    }
                    else {
                        $('#checkout_username_error').html('');
                    }
                    if (response.errors.checkout_useremail) {
                        $('#checkout_useremail_error').html(response.errors.checkout_useremail);
                    }
                    else {
                        $('#checkout_useremail_error').html('');
                    }
                    if (response.errors.checkout_userphone) {
                        $('#checkout_userphone_error').html(response.errors.checkout_userphone);
                    }
                    else {
                        $('#checkout_userphone_error').html('');
                    }
                   
                    if (response.errors.checkout_useraddress) {
                        $('#checkout_useraddress_error').html(response.errors.checkout_useraddress);
                    }
                    else {
                        $('#checkout_useraddress_error').html('');
                    }
                }

            },
            error: function (xhr, status, error) {
                   alert('Server issue, please try again later.');
            },
             complete: function (xhr) {
            console.log('Raw Response:', xhr.responseText);
            console.log('HTTP Status:', xhr.status);
        }
        });
    })


//MARK: saveb2border

$('#saveb2border').click(function (e) 
{
        let total_amount = $('.totalamount').text().trim().replace(/(₹|Rs\.?|Rupees)\s*/i,'');
        let formData = new FormData($('#usercheckout')[0]);
        formData.append('total_amount', total_amount);
        console.log(formData);
        $.ajax({
            url: base_url + 'home/addb2bcheckout',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                  $(this).prop('disabled', true).text('Placing Order...');
                if (response.success === 'success') 
                {
                    
                    $('.alert-success').removeClass('d-none');
                    $('.alert-success').removeClass('d-none').text(response.outofstock);
                    $('.alert-danger').addClass('d-none');
                    $('#usercheckout')[0].reset();
                     if(response.ordertype == 'bb'){
                    window.location.href = base_url + 'b2b';    
                    }      
                    $('#checkout_username_error').html('');
                    $('#checkout_useremail_error').html('');
                    $('#checkout_userphone_error').html('');
                }

                else {
                   
                    $('#checkout_username_error').html('');
                    $('#checkout_useremail_error').html('');
                    $('#checkout_userphone_error').html('');
                   

                    if (response.errors.checkout_username) {
                        $('#checkout_username_error').html(response.errors.checkout_username);
                    }
                    else {
                        $('#checkout_username_error').html('');
                    }
                    if (response.errors.checkout_useremail) {
                        $('#checkout_useremail_error').html(response.errors.checkout_useremail);
                    }
                    else {
                        $('#checkout_useremail_error').html('');
                    }
                    if (response.errors.checkout_userphone) {
                        $('#checkout_userphone_error').html(response.errors.checkout_userphone);
                    }
                    else {
                        $('#checkout_userphone_error').html('');
                    }
                   
                    if (response.errors.checkout_useraddress) {
                        $('#checkout_useraddress_error').html(response.errors.checkout_useraddress);
                    }
                    else {
                        $('#checkout_useraddress_error').html('');
                    }
                }

            },
            error: function (xhr, status, error) {
                   alert('Server issue, please try again later.');
            },
             complete: function (xhr) {
            console.log('Raw Response:', xhr.responseText);
            console.log('HTTP Status:', xhr.status);
        }
        });
    })


    //MARK: contact us form submission
        $('#contact').click(function (e) {
        let formData = new FormData($('#addcontact')[0]); // Capture form data
        $.ajax({
            url: base_url + 'home/addcontact',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                // console.log(response);
                if (response.success === 'success') {
                    setTimeout(function () {
                        // window.location.href = base_url + 'admin/Enquiry/success';
                        $('#addcontact')[0].reset();
                        $('#other_textbox').hide();
                        $('#contact_name_error').html('')
                        $('#contact_email_error').html('')
                        $('#contact_desc_error').html('')
                        $('#contact_phone_error').html('')
                        $('#general_error').html('')
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    }, 1000);
                } else {

                    $('#contact_name_error').html('')
                    $('#contact_email_error').html('')
                    $('#contact_desc_error').html('')
                    $('#contact_phone_error').html('')
                    $('#general_error').html('')
                    // Check if this is a duplicate entry error
                    if (typeof response.errors === 'string') {
                        // Display the general error message somewhere
                        $('#general_error').html(response.errors);
                    } else if (response.errors.duplicate) {
                        // Display the duplicate entry error
                        $('#general_error').html(response.errors.duplicate);
                    }
                    else {
                        // Handle field-specific validation errors

                        if (response.errors.contact_name) {
                            $('#contact_name_error').html(response.errors.contact_name);
                        }
                        else {
                            $('#contact_name_error').html('');
                        }

                        if (response.errors.contact_email) {
                            $('#contact_email_error').html(response.errors.contact_email);
                        }
                        else {
                            $('#contact_email_error').html('');
                        }

                        if (response.errors.contact_desc) {
                            $('#contact_desc_error').html(response.errors.contact_desc);
                        }
                        else {
                            $('#contact_desc_error').html('');
                        }

                        if (response.errors.contact_phone) {
                            $('#contact_phone_error').html(response.errors.contact_phone);
                        }
                        else {
                            $('#contact_phone_error').html('');
                        }


                    }
                }
            },
            error: function (xhr, status, error) {
                // Handle error
                  alert('Server issue, please try again later.');

            }
        });
    })







});