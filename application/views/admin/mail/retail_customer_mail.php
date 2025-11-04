<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Email</title>
    <link href="<?php echo base_url();?>assets/admin/css/email_retail.css" rel="stylesheet" type="text/css" />
</head>


<body>

    <table width="100%" style="border-bottom:2px solid #333; margin-bottom:30px; padding-bottom:20px;">
        <tr>
            <!-- Left: Company Info -->
            <td style="text-align:left; vertical-align:top;">
                <h2 style="margin:0; font-size:24px; color:#333;">Woodsberg Furnitures</h2>
                <p style="margin:5px 0; font-size:12px; color:#666;">
                    Near Cherussericalam tower, Pallom mc road,<br>
                    Opposite Karimpiti taste land, Kottayam, Kerala - 686012
                </p>
                <p style="margin:5px 0; font-size:12px; color:#666;">Phone: +91 95449 42242</p>
            </td>

            <!-- Right: Invoice Info -->
            <td style="text-align:right; vertical-align:top;">
                <h3 style="margin:0; font-size:28px; color:#333;">Estimate</h3>
                <p style="margin:5px 0; font-size:13px;"><strong>Order ID:</strong><?php echo $order_id;?></p>
                <p style="margin:5px 0; font-size:13px;"><strong>Date:</strong> '.date("d-m-Y").'</p>
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Image</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>

        </thead>
        <tbody>
            <?php foreach ($cartitems as $item): ?>
            <tr>
                <td><img src='<?php echo base_url('uploads/product/'.$item['image']); ?>'
                        alt='<?php echo $item['name'];?>' width='80' height='80'
                        style='object-fit:cover;border-radius:8px;'></td>
                <td>
                    <?php echo $item['quantity']; ?>
                </td>
                <td>₹<?php echo $item['product_price']; ?></td>
                <td>₹<?php echo $item['price']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <div class="grand-total">
        Shipping Charge : <span style="color: #e74c3c;">₹<?php echo number_format($shipping_charge, 2);?></span>
    </div>

    <div class="grand-total">
        Coupon Code : <span style="color: #e74c3c;">₹<?php echo number_format($coupon_code, 2);?></span>
    </div>

    <div class="grand-total">
        Grand Total: <span style="color: #e74c3c;">₹<?php echo number_format($total_amount, 2);?></span>
    </div>
</body>

</html>