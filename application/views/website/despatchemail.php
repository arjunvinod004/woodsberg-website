<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Dispatched</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 25px 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 0.5px;
        }

        .content {
            padding: 30px 25px;
            text-align: left;
        }

        .content h2 {
            color: #222;
            font-size: 20px;
        }

        .order-details {
            margin: 20px 0;
            padding: 15px;
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }

        .order-details p {
            margin: 6px 0;
            font-size: 15px;
        }

        .tracking-btn {
            display: inline-block;
            background-color: #4CAF50;
            color: #ffffff !important;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 5px;
            margin-top: 15px;
            font-weight: 500;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background: #f4f4f4;
            font-size: 13px;
            color: #888;
        }

        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="email-container">
    <div class="header">
        <h1>Your Order Has Been Despatched!</h1>
    </div>

    <div class="content">
        <h2>Dear Customer,</h2>
        <p>We’re excited to let you know that your order has been despatched and is on its way to you!</p>

        <div class="order-details">
            <p><strong>Order No:</strong> <?= htmlspecialchars($orderno) ?></p>
            <p><strong>Tracking ID:</strong> <?= htmlspecialchars($trackingId) ?></p>
        </div>

    
        <p style="margin-top: 20px;">Thank you for shopping with us. We hope you enjoy your purchase!</p>
    </div>

    <div class="footer">
        <p>Need help? <a href="mailto:support@woodsberg.com">Contact our support team</a>.</p>
        <p>&copy; <?= date('Y') ?> YourCompany. All rights reserved.</p>
    </div>
</div>

</body>
</html>
