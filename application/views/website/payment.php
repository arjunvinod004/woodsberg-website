<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Checkout</h4>
                    </div>
                    <div class="card-body">
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?php echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?php echo base_url('payment/process'); ?>" method="post">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount (₹)</label>
                                <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="customer_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="customer_email" name="customer_email" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="customer_phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="customer_phone" name="customer_phone">
                            </div>
                            
                            <div class="mb-3">
                                <label for="billing_address" class="form-label">Billing Address</label>
                                <textarea class="form-control" id="billing_address" name="billing_address" rows="3"></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100">Proceed to Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>