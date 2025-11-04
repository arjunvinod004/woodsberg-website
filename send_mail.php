<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

$mail = new PHPMailer(true);

try {
    // $mail->SMTPDebug = 2; // enable only for testing
    $mail->isSMTP();
    $mail->Host       = 'sg2plzcpnl505572.prod.sin2.secureserver.net';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'info@woodsberg.com';
    $mail->Password   = 'opX3(57,a0Mm';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    $mail->setFrom('info@woodsberg.com', 'Woodsberg');
    $mail->addAddress('arjunvt004@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Invoice / Estimate - Woodsberg';

    $mail->Body = '
    <!DOCTYPE html>
    <html>
    <head>
      <meta charset="UTF-8">
      <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f9f9f9; }
        .container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 800px; margin: 0 auto; }
        .header { display: flex; justify-content:space-between; align-items: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 20px; }
        .company-info h2 { margin: 0; color: #333; font-size: 24px; }
        .company-info p { margin: 5px 0; color: #666; font-size: 12px; }
        .invoice-info { text-align: right; }
        .invoice-info h3 { margin: 0; font-size: 28px; color: #333; }
        .invoice-info p { margin: 5px 0; color: #666; }
        .customer-section { display: flex; justify-content: space-between; margin-bottom: 30px; }
        .customer-details h4 { margin-top: 0; color: #333; text-transform: uppercase; font-size: 14px; }
        .customer-details p { margin: 3px 0; font-size: 13px; color: #555; }
        .order-info p { margin: 3px 0; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 13px; }
        th, td { border: 1px solid #ddd; padding: 12px 8px; text-align: center; }
        th { background: #f8f9fa; font-weight: bold; color: #333; text-transform: uppercase; font-size: 11px; }
        .item-desc { text-align: left; font-weight: 500; }
        .price-col, .total-col { font-weight: 500; }
        .grand-total { text-align: right; font-weight: bold; margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 5px; font-size: 18px; }
        .gst-info { margin: 20px 0; font-size: 12px; color: #666; }
      </style>
    </head>
    <body>
      <div class="container">
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
      <p style="margin:5px 0; font-size:13px;"><strong>Order ID:</strong> 12222</p>
      <p style="margin:5px 0; font-size:13px;"><strong>Date:</strong> '.date("d-m-Y").'</p>
    </td>
  </tr>
</table>

 <div class="customer-section">
          <div class="customer-details">
            <h4>Customer Details</h4>
            <p><strong>Woodsberg Furnitures</strong></p>
            <p>Cherussericalam Tower</p>
            <p>Pallom MC Road</p>
            <p>Opposite Karimpiti Taste Land</p>
            <p>Kottayam, Kerala - 686012</p>
            <p>India</p>
            <p>Phone: +91 95449 42242</p>
          </div>
          </div>


 
        

        <!-- Products Table -->
        <table>
          <thead>
            <tr>
              <th>No.</th>
              <th>Product</th>
              <th>Item</th>
              <th>Qty</th>
              <th>Price (₹)</th>
              <th>Total (₹)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>🏺</td>
              <td class="item-desc">H13&quot; D8&quot;</td>
              <td>6</td>
              <td class="price-col">599</td>
              <td class="total-col">3,594</td>
            </tr>
            <tr>
              <td>2</td>
              <td>🏺</td>
              <td class="item-desc">H10&quot; D9&quot;</td>
              <td>4</td>
              <td class="price-col">325</td>
              <td class="total-col">1,300</td>
            </tr>
            <!-- ... add remaining rows ... -->
          </tbody>
        </table>

        <!-- GST Info -->
        <div class="gst-info">
          <p><strong>Additional Information:</strong></p>
          <p>GST No (If you don\'t have leave blank): 32AIRPB9248A2ZG</p>
        </div>

        <!-- Grand Total -->
         <div class="grand-total">
          coupon code: <span style="color: #e74c3c;">₹100</span>
        </div>
        
         <div class="grand-total">
         shipping: <span style="color: #e74c3c;">₹200</span>
        </div>
        <div class="grand-total">
          Grand Total: <span style="color: #e74c3c;">₹59,846.50</span>
        </div>
      </div>
    </body>
    </html>';

    $mail->send();
    echo '✅ Email sent successfully';
} catch (Exception $e) {
    echo '❌ Email could not be sent. Error: ', $mail->ErrorInfo;
}
?>
