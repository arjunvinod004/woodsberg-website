<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/website/css/plugins1.css">
</head>
<body>
<?php 
$total_amout = $sumofprice;
if($customerdetails['coupon_code'] != 0)
{
    $total_amout = $total_amout - $customerdetails['coupon_code'];
}

if($customerdetails['shipping_charge'] != 0)
{
$total_product_weight = floatval(str_ireplace('kg', '', $weightcalculation));
    if($total_product_weight <= 3) {
        $shipping_charge = 150;
    } else {
        $shipping_charge = $total_product_weight * $shipping_charge;
    }
    $total_amout = $total_amout + $shipping_charge;
}

else
{
    $total_product_weight = floatval(str_ireplace('kg', '', $weightcalculation));
    if($total_product_weight <= 3) {
        $shipping_charge = 0;
    } else {
        $shipping_charge = $total_product_weight * 0;
    }
    $total_amout = $total_amout + $shipping_charge;
}
?>

<?php 
$selected_state = ''; 
$token = $this->session->userdata('guest_token'); 
if ($token) {
    $customer = $this->db->where('user_token', $token)->get('customers')->row_array();
    if ($customer) {
        $selected_state = $customer['state'];
    }
}

if($ordertype == 'exp'){
  $symbol = '$'; // Assuming export prices are in dollars
}
else{
  $symbol = '₹'; // Default symbol for other order types
}
?>
    <div class="main-wrapper">

<input type="hidden" id="token" value="<?php echo $token?>">
        <section class="page-title-section bg-img cover-background">
            <div class="container">

                <div class="row">
                    <div class="col-md-7">
                        <h3>Checkout</h3>
                    </div>
                    <div class="col-md-5">
                        <ul class="text-md-end text-start mt-2 mt-lg-0 ps-0">
                            <li><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li><a href="#!">Checkout</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </section>

        <section>
            <div class="container">

                <!-- form design block set -->
                <div class="row">

                    <!-- billing address -->
                    <div class="col-lg-5 col-md-6 mb-1-9 mb-md-0">



                        <h4 class="mb-4">Billing Address</h4>
                        <form id="usercheckout" method="post" enctype="multipart/form-data">



                            <div class="quform-elements">
                                <div class="row">

                                    <?php if ($ordertype == 'ws'): ?>

                                    <?php foreach ($checkoutdetails as $val) { ?>
                                    <!-- Name -->
                                    <div class="col-md-12">
                                        <div class="quform-element form-group">
                                            <label for="name">Name <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_username"
                                                    value="<?php echo $val['name']; ?>" readonly>
                                                <span class="error errormsg mt-2" id="checkout_username_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-md-6">
                                        <div class="quform-element form-group">
                                            <label for="phone">Phone <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_userphone"
                                                    value="<?php echo $val['phone']; ?>" readonly>
                                                <span class="error errormsg mt-2" id="checkout_userphone_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <div class="quform-element form-group">
                                            <label for="email">Email <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_useremail"
                                                    value="<?php echo $val['email']; ?>" readonly>
                                                <span class="error errormsg mt-2" id="checkout_useremail_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-md-12">
                                        <div class="quform-element form-group">
                                            <label for="address">Address <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_useraddress"
                                                    value="<?php echo $val['address']; ?>" readonly>
                                                <span class="error errormsg mt-2"
                                                    id="checkout_useraddress_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <?php elseif ($ordertype == 'bb' || $ordertype == 'exp'): ?>

                                    <!-- Same fields as WS but editable (no checkoutdetails) -->

                                    <div class="col-md-12">
                                        <div class="quform-element form-group">
                                            <label for="name">Name <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_username">
                                                <span class="error errormsg mt-2" id="checkout_username_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="quform-element form-group">
                                            <label for="phone">Phone <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_userphone">
                                                <span class="error errormsg mt-2" id="checkout_userphone_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="quform-element form-group">
                                            <label for="email">Email <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_useremail">
                                                <span class="error errormsg mt-2" id="checkout_useremail_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="quform-element form-group">
                                            <label for="address">Address <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_useraddress">
                                                <span class="error errormsg mt-2"
                                                    id="checkout_useraddress_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <?php else: ?>

                                    <!-- Regular fields for RT and other order types -->

                                    <div class="col-md-12">
                                        <div class="quform-element form-group">
                                            <label for="name">First Name <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_username" value="<?php echo isset($retailcheckoutdetails[0]['name']) ? $retailcheckoutdetails[0]['name'] : ''; ?>">
                                                <span class="error errormsg mt-2" id="checkout_username_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="quform-element form-group">
                                            <label for="email">Email Address <span
                                                    class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_useremail" value="<?php echo isset($retailcheckoutdetails[0]['email']) ? $retailcheckoutdetails[0]['email'] : ''; ?>">
                                                <span class="error errormsg mt-2" id="checkout_useremail_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="quform-element form-group">
                                            <label for="phone">Phone <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_userphone" value="<?php echo isset($retailcheckoutdetails[0]['phone']) ? $retailcheckoutdetails[0]['phone'] : ''; ?>">
                                                <span class="error errormsg mt-2" id="checkout_userphone_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="quform-element form-group">
                                            <label for="city">City / Town <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_usercity" value="<?php echo isset($retailcheckoutdetails[0]['city']) ? $retailcheckoutdetails[0]['city'] : ''; ?>">
                                                <span class="error errormsg mt-2" id="checkout_usercity_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="quform-element form-group">
                                            <label for="postcode">Postcode <span
                                                    class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_userpostcode" value="<?php echo isset($retailcheckoutdetails[0]['postal_code']) ? $retailcheckoutdetails[0]['postal_code'] : ''; ?>">
                                                <span class="error errormsg mt-2"
                                                    id="checkout_userpostcode_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="quform-element form-group">
                                            <label for="country1">Country <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <select class="form-control form-select" id="country1"
                                                    name="checkout_usercountry">
                                                    <option selected value="india">India</option>
                                                    <input type="hidden" id="weight" class="form-control mb-2"
                                                        value="<?php echo $weightcalculation; ?>">
                                                </select>
                                                <span class="error errormsg mt-2"
                                                    id="checkout_usercountry_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="quform-element form-group">
                                            <label for="state">State<span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <select name="state" class="form-select mt-2" id="state">
                                                    <option value="">Select state</option>
                                                    <?php foreach ($shipping as $ships): ?>
                                                        <?php 
                                                            $selected_state = isset($retailcheckoutdetails[0]['state']) ? $retailcheckoutdetails[0]['state'] : ''; 
                                                            echo $selected_state;
                                                            $is_selected = ($selected_state == $ships['state']) ? 'selected' : ''; 
                                                            echo $is_selected;
                                                            ?> 
                                                        
                                                        <option value="<?php echo $ships['state']; ?>"
                                                            data-shipping-charge="<?php echo $ships['shipping_charge']; ?>"
                                                            <?php echo $is_selected;  ?>
                                                        >
                                                            <?php echo $ships['state']; ?>
                                                        </option>
                                                        
                                                    <?php endforeach; ?>  
                                                  <input type="hidden" class="state" value="<?php echo $selected_state; ?>">
                                                </select>

                                                <p id="shipping_charge"></p>
                                                <span class="error errormsg mt-2" id="shipping_code_error"></span>
                                                <span class="error errormsg mt-2" id="checkout_userstate_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="quform-element form-group">
                                            <label for="address">Address <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_useraddress" value="<?php echo isset($retailcheckoutdetails[0]['address']) ? $retailcheckoutdetails[0]['address'] : ''; ?>">
                                                <span class="error errormsg mt-2"
                                                    id="checkout_useraddress_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <?php endif; ?>


                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="col-lg-5 offset-lg-2 col-md-6">
                        <div class="col-12 cart-total pt-3 pt-md-5">
                            <div class="row">
                                <!-- text input element -->
                                <div class="col-lg-12  col-md-6">
                                    <!-- Coupon code -->
                                    <form action="#" id="apply_coupon_form" method="post">
                                        <?php if ($ordertype == 'ws' || $ordertype == 'bb' || $ordertype == 'exp') {
                                            $dnone= 'd-none';
                                        } else {
                                            $dnone = '';
                                        } ?>
                                        <div class="col-md-12 d-none <?php echo $dnone; ?>">
                                            <div class="quform-element form-group">
                                                <label for="country1">Coupon Code<span
                                                        class="quform-required">*</span></label>
                                                <div class="quform-input">
                                                    <input type="text" class="form-control mb-2" id="coupons_code"
                                                        name="coupons_code" placeholder="Enter Your Coupon code">
                                                    <input type="hidden" class="form-control mb-2" name="total_price"
                                                        id="total_price" value="<?php echo $total_amout ?>" />

                                                          <input type="hidden" class="form-control mb-2" name="product_total"
                                                        id="product_total" value="<?php echo $total_amout ?>" />

                                                    <button type="button" class="butn small float-end"
                                                        id="apply_coupon">
                                                        <span>Apply Code</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div>
                                                <span class="error errormsg mt-2" id="coupons_code_error"></span>
                                            </div>
                                        </div>
                                    </form>
                                    <table class="table cart-sub-total">
                                        <?php if ($ordertype == 'ws' || $ordertype == 'bb' || $ordertype == 'exp') {
                                            $dnone= 'd-none';
                                        } else {
                                            $dnone = '';
                                        } ?>
                                        <tbody>
                                            <tr class="total <?php echo $dnone; ?>">
                                                <th class="text-end pe-0">Item Total(MRP)</th>
                                                <td class="text-end pe-0" style="font-weight: bold;">
                                                    <?php echo $symbol; ?><?php echo $sumofprice; ?>
                                                </td>
                                            </tr>

                                            <input type="hidden" name="" id="total_price_purchase" value="<?php echo $sumofprice; ?>">

                                            <tr
                                                class="total <?php echo empty($customerdetails['coupon_code']) ? 'd-none' : ''; ?>">
                                                <th class="text-end pe-0">Discount From MRP</th>
                                                <td class="text-end pe-0 couponcode">
                                                    <?php echo $symbol . ' ' . $couponcode; ?>
                                                </td>
                                            </tr>



                                            <?php if ($ordertype == 'ws' || $ordertype == 'bb' || $ordertype == 'exp') {
                                                    $dnone= 'd-none';
                                                } else {
                                                    $dnone = '';
                                                } ?>
                                            <tr class="delivery <?php echo $dnone; ?>">
                                                <th class="text-end pe-0 delivery-charge ">Delivery charge (total weight
                                                    : <?php echo $weightcalculation; ?>)</th>
                                                <td class="text-end pe-0 shipping">
                                                    <?php echo $shipping_charge;  ?>
                                                </td>
                                            </tr>



                                            <input type="hidden" id="total_amount" value="<?= $total_amout; ?>">
                                            <tr class="total">
                                                <th class="text-end pe-0">Total Amount</th>
                                                <td class="text-end pe-0 totalamount" style="font-weight: bold;">

                                                    <?php echo $symbol?><?php echo $total_amout; ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="pe-0" colspan="2">
                                                    <hr>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                              

                                    <a class="butn primary float-end " id="saveuserorder" ><span>Place
                                            Order</span></a>

                                      <a class="butn primary float-end mx-2" href="<?php echo base_url('cart');?>"><span>Cart</span></a>
                                     

 <?php if($ordertype == 'ws' || $ordertype == 'bb' || $ordertype == 'exp')
                                             {
                                               echo '<a class="butn primary float-end" id="savewholesaleorder"><span>place order</span></a>';
                                               echo '<a class="butn primary float-end mx-2" href="'.base_url('cart').'"><span>Cart</span></a>';
                                             } 
                                                
                                             ?>


                                </div>

 <label class="mt-2" style="text-align:right;" class="label">Order No : <?php echo $orderno;?> </label>
 <label style="font-weight: bold; padding: 5px 10px; border-radius: 5px; text-align:right;">
    Cash on Delivery Not Available
</label>


                                <div class="alert alert-success mt-4 d-none" role="alert">

                                </div>

                                <div class="alert alert-danger mt-4 d-none" role="alert">

                                </div>




                            </div>

                        </div>


                    </div>
                    <!-- end ship diffrent address -->

                    <!-- total block set -->
                    <div class="col-12 cart-total pt-3 pt-md-5">
                        <div class="row">

                            <div class="col-lg-5 col-md-6 mb-1-9 mb-md-0">



                            </div>


                        </div>
                    </div>
                    <!-- end total block set -->

                </div>
                <!-- end form design block set -->

            </div>
        </section>




    </div>

</body>

<script src="<?php echo base_url();?>assets/website/js/jquery.js"></script>
<script>
$(document).ready(function() {
    var $token = $('#product_token').val();
    //  alert($token);   
});


$('#state').off('change').on('change', function() {
    var stateId = $(this).val();

    if (stateId) {
        
        var charge = $(this).find('option:selected').data('shipping-charge');
        // Parse weight
        var rawWeight = $('#weight').val().trim(); // e.g., "250g" or "1.5kg"
        var match = rawWeight.match(/^([\d.]+)\s*(kg|g)$/i);
        if (!match) return; // invalid weight input
        var weightValue = parseFloat(match[1]);
        var unit = match[2].toLowerCase();
        var weightInKg = unit === 'g' ? weightValue / 1000 : weightValue;
        // Calculate shipping
        var calculateweight = weightInKg <= 3 ? 150 : weightInKg * charge;
        
        // Get original product total (without shipping)
        var product_total = parseFloat($('#total_price_purchase').val()) || 0; // <-- separate field
        var total_amounts = product_total + calculateweight;
        // Update DOM
        $('.shipping').text('Rs. ' + calculateweight.toFixed(2));
        $('.totalamount').text('Rs. ' + total_amounts.toFixed(2));
        $('#product_total').val(total_amounts)
        $('.state').val(stateId);

    } else {
        $('#collapseTwo').collapse('show');
    }
});






// function loadshippingchargedatabase(shipping_charge) {
//     var selectedState = $('#state').val(); // get the selected state ID
//     //  alert(selectedState);
//     // alert(shipping_charge);
//     $.ajax({
//         url: '<?php echo base_url(); ?>' + 'cart/update_shipping_charge',
//         type: 'POST',
//         data: {
//             'shipping_charge': shipping_charge,
//             'selected_state': selectedState
//         },
//         dataType: 'json',
//         success: function(response) {
//             if (response.success == 'success') {
//                 console.log(response);
//                 $('.shipping').text('₹' + response.message);
//                 $('.totalamount').text(response.total_amout);
//                 // $('.total').removeClass('d-none');
//                 // $('.couponcode').text('₹' + response.coupon_code);
//                 $('#total_amount').val(response.total_amout);
//                 //  $('#shipping_calculation').addClass('d-none');  // ✅ Hide dropdown
//                 // $('#shipping_code_error').html(response.message);
//             } else {}
//         }
//     })
// }
</script>

</html>