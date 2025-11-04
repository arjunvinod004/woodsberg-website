<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
   
</head>
<body>
<div class="main-wrapper">
 

        <section class="page-title-section bg-img cover-background" >
            <div class="container">

                <div class="row">
                    <div class="col-md-7">
                        <h3>Contact</h3>
                    </div>
                    <div class="col-md-5">
                        <ul class="text-md-end text-start mt-2 mt-lg-0 ps-0">
                            <li><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li><a href="#!">Contact </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        
      <section class="md">
            <div class="container">
                <div class="row">
                    <!-- contact form -->
                    <div class="col-lg-6 mb-1-9 mb-lg-0">
                        <div class="section-heading left">
                            <h3>Let's talk about your business</h3>
                        </div>
                        <div class="contact-form-box">
                            <form class="contact quform" id="addcontact"  method="post" enctype="multipart/form-data" >
                                <div class="">
                                    <div class="row">

                                        <!-- Begin Text input element -->
                                        <div class="col-md-6">
                                            <div class="quform-element form-group">
                                                <div class="quform-input">
                                                    <input class="form-control"  type="text" name="contact_name" placeholder="Your name here">
                                                    <span id="contact_name_error" class="error errormsg mt-2"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Text input element -->

                                        <!-- Begin Text input element -->
                                        <div class="col-md-6">
                                            <div class="quform-element form-group">
                                                <div class="quform-input">
                                                    <input class="form-control"  type="text" name="contact_email" placeholder="Your email here">
                                                    <span id="contact_email_error" class="error errormsg mt-2"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Text input element -->

                                        <!-- Begin Text input element -->
                                        <div class="col-md-6">
                                            <div class="quform-element form-group quform-select-replaced">
                                                <div class="quform-input">
                                                    <input class="form-control"  type="text" name="contact_desc" placeholder="Your subject here">
                                                    <span id="contact_desc_error" class="error errormsg mt-2"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Text input element -->

                                        <!-- Begin Text input element -->
                                        <div class="col-md-6">
                                            <div class="quform-element form-group">
                                                <div class="quform-input">
                                                    <input class="form-control"  type="text" name="contact_phone" placeholder="Your phone here">
                                                    <span id="contact_phone_error" class="error errormsg mt-2"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Text input element -->

                                       

                                      

                                        <!-- Begin Submit button -->
                                        <div class="col-md-12">
                                            <div class="quform-submit-inner">
                                                <button class="butn" id="contact" type="button">submit</button>
                                            </div>
                                            <div class="quform-loading-wrap text-start"><span class="quform-loading"></span></div>
                                        </div>
                                        <!-- End Submit button -->

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end contact form  -->

                    <!-- contact detail -->
                    <div class="col-lg-6">
                        <div class="contact-info-box ps-lg-1-9">
                            <div class="row">
                                <div class="col-12">
                                    <div class="contact-info-section mt-0 pt-0">

                                        <h4>Get in Touch</h4>
                                        <p>Tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse consequat.</p>

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="contact-info-section">

                                        <h4>The Office</h4>

                                        <ul class="mb-0 ps-0 list-unstyled">
                                              <?php foreach ($store as $product) { ?>
                                            <li class="mb-2">
                                                <p><i class="fas fa-map-marker-alt text-center"></i> <strong>Address:</strong> <?php echo $product['store_address']; ?></p>
                                            </li>
                                            <li class="mb-2">
                                                <p><i class="fas fa-phone text-center"></i> <strong>Phone:</strong> <?php echo $product['store_phone']; ?></p>
                                            </li>
                                            <li>
                                                <p><i class="far fa-envelope text-center"></i> <strong>Email:</strong> <a href="#!"><?php echo $product['store_email']; ?></a></p>
                                            </li>
                                            <?php } ?>
                                        </ul>

                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <!-- end contact detail -->
                </div>
            </div>
        </section>  






</body>
</html>