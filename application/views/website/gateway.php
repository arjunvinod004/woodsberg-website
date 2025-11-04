<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
</head>
<body>
    <div style="text-align: center; margin-top: 50px;">
        <h3>Redirecting to Federal Bank Payment Gateway...</h3>
        <p>Please wait while we redirect you to the secure payment page.</p>
        
        <form id="payment_form" action="<?php echo $gateway_url; ?>" method="post">
            <?php foreach($form_data as $key => $value): ?>
                <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
            <?php endforeach; ?>
        </form>
    </div>
    
    <script>
        // Auto-submit the form
        document.getElementById('payment_form').submit();
    </script>
</body>
</html>