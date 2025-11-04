<!DOCTYPE html>
<html lang="en">

<head>
       <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/website/css/plugins/bootstrap.min.css">
</head><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">

<body>
    <div class="row">
        <!-- Left: Customer Details -->
        <div class="col-md-4 mx-auto mt-5 mb-5">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header text-white text-center rounded-top-3" style="background-color: #407866;">
                    <h5 class="mb-0" style="color:#fff;">Welcome Back</h5>
                    <small>Please login to continue</small>
                </div>
                <div class="card-body p-4">
                    <form id="loginForm" action="<?php echo base_url('website/login'); ?>" method="post">

                        <!-- Email -->
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control rounded-3" id="loginusername" name="email"
                                placeholder="name@example.com" required>
                            <span id="login_username_error" class="error errormsg mt-2"></span>
                            <label for="loginEmail">Username</label>
                        </div>

                        <!-- Password -->
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" id="loginpassword" name="password"
                                placeholder="Enter password" required>
                            <span id="login_password_error" class="error errormsg mt-2"></span>
                            <label for="loginPassword">Password</label>
                        </div>

                        <!-- Login Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-login btn-lg rounded-3 login-btn"
                                style="background-color: #407866; color:#fff;">
                                <i class="fa-solid fa-right-to-bracket me-2"></i> Login
                            </button>
                        </div>

                        <div class=" text-end text-sm-end">
                            <a style="text-decoration: none; color: #000;" href="<?php echo base_url('home/forgotpassword');?>" class="m-link-muted">Forgot
                                password?</a>
                        </div>
                    </form>

                </div>


            </div>

            <div class="checkout">
                <div class="alert alert-danger mt-3 d-none" role="alert">

                </div>

                <div class="alert alert-success  mt-3 d-none" role="alert">
                    go to <a style="text-decoration: none;"
                        href="<?php echo base_url('website/checkout');?>">checkout</a>
                </div>
            </div>




        </div>

</body>
<script src="<?php echo base_url();?>assets/website/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/adminscript.js?v=<?php echo time(); ?>"></script>

</html>