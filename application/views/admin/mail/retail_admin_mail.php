<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin mail</title>
    <link href="<?php echo base_url();?>assets/admin/css/email_retail.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="customer-section">
        <div class="customer-details">
            <h4>Customer Details</h4>
            <p><strong> Name:'. $customer_name.'</strong></p>
            <p>Email: '.$customer_email.'</p>
            <p>Phone: '.$customer_phone.'</p>
            <p>Address: '.$customer_address.'</p>
            <p>Pincode: '.$customer_pincode.'</p>
            <p>: '.$customer_state.'</p>

        </div>
    </div>



    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            '.$rows.'
        </tbody>
    </table>
</body>
<div class="grand-total">
    Shipping Charge : <span style="color: #e74c3c;">₹'.number_format($shipping_charge, 2).'</span>
</div>

<div class="grand-total">
    Coupon Code : <span style="color: #e74c3c;">₹'.number_format($coupon_code, 2).'</span>
</div>

<div class="grand-total">
    Grand Total: <span style="color: #e74c3c;">₹'.number_format($total_amount, 2).'</span>
</div>

</body>

</html>