<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        
        .a4-container {
            width: 210mm;
            height:180mm;
            background-color: white;
            margin: 0 auto 20px;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            page-break-after: always;
        }

           .a4-container1 {
            width: 210mm;
            height:340mm;
            background-color: white;
            margin: 0 auto 20px;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            page-break-after: always;
        }
        
        .header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 3px solid #2c3e50;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #2c3e50;
            font-size: 32px;
            margin-bottom: 5px;
        }
        
        .header p {
            color: #7f8c8d;
            font-size: 16px;
        }
        
        .address-section {
            margin-bottom: 40px;
        }
        
        .address-box {
            padding: 30px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #3498db;
            margin-bottom: 25px;
        }
        
        .address-box h3 {
            color: #2c3e50;
            font-size: 20px;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .address-box p {
            color: #555;
            line-height: 1.8;
            font-size: 18px;
        }
        
        .order-info {
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 40px;
        }
        
        .order-info h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 22px;
        }
        
        .order-info p {
            font-size: 16px;
            margin-bottom: 8px;
        }
        
        .order-id {
            color: #3498db;
            font-size: 24px;
            font-weight: bold;
        }
        
        .products-section {
            margin-bottom: 30px;
        }
        
        .products-section h3 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 22px;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 10px;
        }
        
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .product-table th {
            background-color: #2c3e50;
            color: white;
            padding: 14px;
            text-align: left;
            font-weight: 600;
            font-size: 15px;
        }
        
        .product-table td {
            padding: 14px;
            border-bottom: 1px solid #ecf0f1;
            color: #555;
            font-size: 15px;
        }
        
        .product-table tr:hover {
            background-color: #f8f9fa;
        }
        
        .total-section {
            text-align: right;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        
        .total-row {
            display: flex;
            justify-content: flex-end;
            margin: 10px 0;
            font-size: 16px;
        }
        
        .total-row span:first-child {
            margin-right: 30px;
            color: #555;
        }
        
        .total-row.grand-total {
            font-size: 20px;
            font-weight: bold;
            color: #2c3e50;
            border-top: 2px solid #2c3e50;
            padding-top: 15px;
            margin-top: 15px;
        }
        
        .footer {
            text-align: center;
            color: #7f8c8d;
            font-size: 14px;
            border-top: 2px solid #ecf0f1;
            padding-top: 20px;
            margin-top: auto;
        }
        
        .address-box-small {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #3498db;
            margin-bottom: 15px;
        }
        
        .address-box-small h3 {
            color: #2c3e50;
            font-size: 16px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .address-box-small p {
            color: #555;
            line-height: 1.6;
            font-size: 13px;
        }
        
        @media print {
            body {
                background-color: white;
                padding: 0;
            }
            
            .a4-container {
                box-shadow: none;
                margin: 0;
                page-break-after: always;
            }
        }

.address-with-logo {
    display: flex;
    align-items: center;
    gap: 20px;
}
.company-logo {
    flex-shrink: 0;
    width: 200px;
    height: 80px;
    background-color: #407866;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    color: white;
    font-weight: bold;
}
.address-content {
    flex: 1;
}

    </style>
</head>
<body>
<div class="a4-container">
    <div class="header">
        <h1>ORDER CONFIRMATION</h1>
        <p>Thank you for your purchase</p>
    </div>

    <div class="address-section">
        <div class="address-box">
            <h3>From</h3>
           <p>
                    <strong>Woodsberg Furnitures</strong><br>
                   Near Cherussericalam tower, Pallom mc road,<br>
                   Opposite Karimpiti taste land, Kottayam, Kerala - 686012<br>
                    Phone: +91 95449 42242<br>
                </p>
        </div>

        <div class="address-box">
            <h3>To</h3>
            <p>
                <strong><?= $customer_name ?></strong><br>
                <?= $customer_address ?><br>
                Phone: <?= $customer_phone ?><br>
                Email: <?= $customer_email ?>
            </p>
        </div>
    </div>
</div>


    <div class="a4-container1">
            <div class="header">
            <h1>ORDER CONFIRMATION</h1>
            <p>Thank you for your purchase</p>
        </div>
        <div class="address-section">
            <div class="address-box-small">
                <div class="address-with-logo">
                    <div class="company-logo"><img width="200px" src="https://woodsberg.com/uploads/store/woodsberg_logo.png" alt=""></div>
                    <div class="address-content">
                                 <p>
                    <strong>Woodsberg Furnitures</strong><br>
                   Near Cherussericalam tower, Pallom mc road,<br>
                   Opposite Karimpiti taste land, Kottayam, Kerala - 686012<br>
                    Phone: +91 95449 42242<br>
                </p>
                    </div>
                </div>
            </div>
            
            <div class="address-box-small">
                <h3>To</h3>
                <p>
                <strong><?= $customer_name ?></strong><br>
                <?= $customer_address ?><br>
                Phone: <?= $customer_phone ?><br>
                Email: <?= $customer_email ?>
            </p>
            </div>
        </div>


        <div class="order-info">
            <h3>Order Details</h3>
                  <p><strong>Order ID:</strong> <span class="order-id"><?= $orderno ?></span></p>
        <p><strong>Order Date:</strong> <?= date('F d, Y') ?></p>
        </div>
        
        <div class="products-section">
         
            <!-- <h3>Order No - ORD2025678</h3> -->
<table class="product-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th> 
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $subtotal = 0;
                foreach ($cartitems as $item): 
                    $lineTotal = $item['quantity'] * $item['product_price'];
                    $subtotal += $lineTotal;
                ?>
                <tr>
                    <td><img src="<?= $item['image_url'] ?>" alt="<?= $item['name'] ?>" width="80" height="80" style="object-fit:cover;"></td>
                    <!-- <td><img src="<?php echo base_url('uploads/product/' . $item['image']); ?>" /></td> -->
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>₹<?= number_format($item['product_price'], 2) ?></td>
                    <td>₹<?= number_format($item['price'], 2) ?></td>
                   
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
        
            <?php 
    $shipping = $customer_shipping ?? 0;
    $grandTotal = $subtotal + $shipping;
    ?>
        <div class="total-section">
            <div class="total-row">
               <span>Subtotal:</span> ₹<?= number_format($subtotal, 2) ?>
            </div>
            <div class="total-row">
              <span>Shipping:</span> ₹<?= number_format($shipping, 2) ?>
            </div>
            <div class="total-row grand-total">
                <span>Grand Total:</span> ₹<?= number_format($grandTotal, 2) ?>
            </div>
        </div>
        
        <div class="footer">
            <p>&copy; 2025 Woodsberg. All rights reserved.</p>
        </div>
    </div>




    <!-- <div class="order-info">
        <h3>Order Details</h3>
        <p><strong>Order ID:</strong> <span class="order-id"><?= $orderno ?></span></p>
        <p><strong>Order Date:</strong> <?= date('F d, Y') ?></p>
    </div>

    <div class="products-section">
        <h3>Products Ordered</h3>
        <table class="product-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th> 
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $subtotal = 0;
                foreach ($cartitems as $item): 
                    $lineTotal = $item['quantity'] * $item['product_price'];
                    $subtotal += $lineTotal;
                ?>
                <tr>
                    <td><img src="<?= $item['image_url'] ?>" alt="<?= $item['name'] ?>" width="80" height="80" style="object-fit:cover;"></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>₹<?= number_format($item['product_price'], 2) ?></td>
                    <td>₹<?= number_format($item['price'], 2) ?></td>
                   
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php 
    $shipping = $customer_shipping ?? 0;
    $grandTotal = $subtotal + $shipping;
    ?>

    <div class="total-section">
        <div class="total-row"><span>Subtotal:</span> ₹<?= number_format($subtotal, 2) ?></div>
        <div class="total-row"><span>Shipping:</span> ₹<?= number_format($shipping, 2) ?></div>
        <div class="total-row grand-total"><span>Grand Total:</span> ₹<?= number_format($grandTotal, 2) ?></div>
    </div> -->
</body>
</html>