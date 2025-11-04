<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>

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
                    <form id="loginForm" action="#" method="post">

                        <!-- Email -->
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control rounded-3" id="loginusername" name="email"
                                placeholder="name@example.com" required>
                            <span id="login_username_error" class="error errormsg mt-2"></span>
                            <label for="loginEmail">Mail</label>
                        </div>


                        <!-- Login Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-login btn-lg rounded-3 forgotpassword"
                                style="background-color: #407866; color:#fff;">
                                <i class="fa-solid fa-right-to-bracket me-2"></i> submit
                            </button>
                        </div>


                    </form>

                </div>


            </div>

            <div class="checkout">
                <div class="alert alert-danger mt-3 d-none" role="alert">

                </div>

                <div class="alert alert-success  mt-3 d-none" role="alert">

                </div>
            </div>




        </div>

</body>

</html>