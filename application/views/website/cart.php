<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
</head>

<body>
    <div class="main-wrapper">

        <section class="page-title-section bg-img cover-background">

            <div class="container">



                <div class="row">

                    <div class="col-md-7">

                        <h3>Cart</h3>

                    </div>

                    <div class="col-md-5">

                        <ul class="text-md-end text-start mt-2 mt-lg-0 ps-0">

                            <li><a href="<?php echo base_url(); ?>">Home</a></li>

                            <li><a href="#!">Cart</a></li>

                        </ul>

                    </div>

                </div>



            </div>

        </section>

        <?php 
$total_amout = $sumofprice;
if($customerdetails['coupon_code'] != 0)
{
    $total_amout = $total_amout - $customerdetails['coupon_code'];
}
if($customerdetails['shipping_charge'] != 0)
{
    $total_amout = $total_amout + $customerdetails['shipping_charge'];
}
?>


        <?php 
$selected_state = ''; 
$token = $this->input->cookie('guest_token'); 
if ($token) {
    $customer = $this->db->where('user_token', $token)->get('customers')->row_array();
    if ($customer) {
        $selected_state = $customer['state'];
    }
}
?>



        <?php
// 1. Determine price based on order type
if ($ordertype == 'ws') {
    // $price = $product['wholesale_price'];
    $redirect_url = base_url('wholesale');
} elseif ($ordertype == 'rt') {
    // $price = $product['retail_price'];
    $redirect_url = base_url(); // Homepage or retail landing
} elseif ($ordertype == 'bb') {
    // $price = $product['franchise_price'];
    $redirect_url = base_url('b2b');
} elseif ($ordertype == 'exp') {
    // $price = $product['export_price'];
    $redirect_url = base_url('export');
}

else {
    // $price = $product['retail_price']; // default fallback
    $redirect_url = base_url();
}

if($ordertype == 'exp'){
  $symbol = '$'; // Assuming export prices are in dollars
}
else{
  $symbol = '₹'; // Default symbol for other order types
}
?>
        <section class="ptb-60">
            <div class="container">

                <div class="row">

                    <!-- product table -->
                    <div class="col-lg-12 col-md-12">
                        <div class="table-responsive">
                            <?php if (!empty($cartitems)): ?>
                            <table class="table table-bordered align-middle text-center">
                                <thead>
                                    <tr>
                                        <th scope="col" class="d-block d-md-none">Image</th>
                                        <th scope="col" class="d-none d-md-table-cell">Product</th>
                                        <th scope="col" class="d-none d-md-table-cell">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="border-top-0">

                                    <?php foreach ($cartitems as $product): ?>
                                    <tr>
                                        <!-- Product Image -->
                                        <td class="d-table-cell align-middle">
                                            <a href="<?php echo base_url(); ?>details/<?= $product['product_id']; ?>">
                                                <img src="<?= base_url(); ?>uploads/product/<?= $product['image']; ?>"
                                                    alt="Product" class="img-fluid w-100px d-block">
                                            </a>

                                            <!-- Product Name: visible below image only on mobile (<= md) -->
                                            <div class="d-block d-md-none mt-2 text-center" style="font-size: 10px;">
                                                <?= $product['name']; ?>
                                            </div>
                                        </td>

                                        <!-- Product Name: shown separately only on desktop (md and up) -->
                                        <td class="d-none d-md-table-cell align-middle">
                                            <?= $product['name']; ?>
                                        </td>
                                        <!-- Product Price -->
                                        <td class="price-carts " data-price="<?= $product['product_price']; ?>">
                                            <?php echo $symbol; ?><?= $product['product_price']; ?> </td>

                                        <!-- Quantity Controls -->
                                        <td class="qty-area">
                                            <?php
                                $quantity = 1;
                                foreach ($cart as $item) {
                                    if ($item['product_id'] == $product['product_id']) {
                                        $quantity = $item['quantity'];
                                        break;
                                    }
                                }
                            ?>
                                            <div class="d-flex align-items-center justify-content-center gap-2">
                                                <button class="btn btn-sm btn-secondary cart cart-decrement-btn"
                                                    data-product-id="<?= $product['product_id']; ?>">−</button>
                                                <span data-qty><?= $quantity ?: 1; ?></span>

                                                <button class="btn btn-sm btn-secondary cart-increment-btn"
                                                    data-product-id="<?= $product['product_id']; ?>">+</button>
                                            </div>



                                            <!-- Hidden Inputs -->
                                            <input type="hidden" id="cart_product_id"
                                                value="<?= $product['product_id']; ?>">
                                            <input type="hidden" id="quantity" value="1" class="qty-input">
                                            <input type="hidden" class="qty-price" value="<?= $product['price']; ?>">
                                            <input type="hidden" id="product_price"
                                                value="<?= $product['product_price']; ?>">
                                            <input type="hidden" id="product_token"
                                                value="<?= $product['guest_token']; ?>">
                                            <input type="hidden" id="weight-calculation"
                                                value="<?= $product['default_weight']; ?>">
                                            <input type="hidden" value="<?= $product['full_weight']; ?>">
                                            <input type="hidden" value="<?= $ordertype; ?>" class="ordertype">
                                          
                                        </td>
                                        <!-- <td> <p><?= $product['full_weight']; ?></p></td> -->
                                        <!-- Subtotal -->
                                        <td class=" d-md-table-cell price-cart" data-price="<?= $product['price']; ?>">
                                            <?php echo $symbol; ?><?= $product['price']; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                    </div>

                   

                    <!-- total block set -->
                    <div class="col-12 cart-total py-1-9 pt-lg-2-3 pb-lg-0">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 mb-1-9 mb-md-0 d-none">
                                <div id="accordion" class="accordion-style2">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    Coupon Code
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                            data-bs-parent="#accordion">
                                            <div class="card-body">
                                                <form action="#" id="apply_coupon_form" method="post">
                                                    <input type="text" class="form-control mb-2" name="coupons_code"
                                                        placeholder="Enter Your Coupon code">
                                                    <input type="hidden" class="form-control mb-2" name="total_price"
                                                        id="total_price" value="<?php echo $sumofprice?>" />
                                                    <span class="error errormsg mt-2" id="coupons_code_error"></span>
                                                    <button class="butn small" id="apply_coupon"><span>Apply
                                                            Code</span></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <?php if($customerdetails['shipping_charge'] !== 0)
                                    { ?> -->
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseTwo" aria-expanded="false"
                                                    aria-controls="collapseTwo" onclick="event.stopPropagation();">
                                                    Calculate Shipping
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse " aria-labelledby="headingTwo"
                                            data-bs-parent="#accordion">
                                            <div class="card-body">
                                                <form action="#">
                                                    <input type="hidden" id="weight" class="form-control mb-2"
                                                        value="<?php echo $weightcalculation;?>">
                                                    <select name="country" id="country" class="form-select">
                                                        <option value="1">India</option>
                                                    </select>


                                                    <!-- State Dropdown -->
                                                    <select name="state" class="form-select mt-2" id="state">
                                                        <option value="">Select state</option>
                                                        <?php foreach ($shipping as $ships) : ?>
                                                        <option value="<?php echo $ships['id']; ?>"
                                                            data-shipping-charge="<?php echo $ships['shipping_charge']; ?>">
                                                            <?php echo $ships['state']; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <p id="shipping_charge" class=""></p>
                                                    <span class="error errormsg mt-2" id="shipping_code_error"></span>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <?php } ?> -->
                                </div>
                            </div>

                            <div class="col-lg-12  col-md-7 ">
                                <table class="table cart-sub-total" id="summary">
                                    <tbody>
                                        <?php if(!empty($cartitems)):?>
                                        <tr>
                                            <th class="text-end pe-0">Item Total(MRP)</th>
                                            <!-- <input type="hidden" id="total_price" value="<?php echo $sumofprice; ?>"> -->
                                            <td class="text-end pe-0 sumofprice" style="font-weight: bold;">
                                                <?php echo $symbol; ?><?php echo $sumofprice; ?></td>
                                        </tr>
                                        <?php endif; ?>



                                        <tr class="total total-amount d-none">
                                            <th class="text-end pe-0">Total Amount</th>
                                            <input type="hidden" id="calculate-total_amount" value="">
                                            <td class="text-end pe-0 total-discount">
                                                ₹<?php if($total_amout){
                                                    echo $total_amout;
                                                } ?>
                                            </td>
                                        </tr>

                                        <!-- <tr class="total success-msg d-none">
                                            <th class="text-end pe-0">Discount</th>
                                            <td class="text-end pe-0 total-discount">₹<?php echo $sumofprice; ?></td>
                                        </tr> -->

                                    </tbody>
                                </table>

                                <?php if(!empty($cartitems)):?>
                                <a class="butn primary medium float-end"
                                    href="<?php echo base_url(); ?>home/checkout"><span>Proceed to
                                        Checkout</span></a>
                                <?php endif; ?>
                            </div>
                              
                        </div>
                    </div>
                    <!-- end total block set -->

                </div>

            </div>
        </section>




    </div>


    <!-- delete testimonials -->
    <div class="modal fade " id="delete-cart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" style="margin-top: 88px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title font-size-class" id="exampleModalLabel">Delete</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- if response within jquery -->
                    <div class="message d-none" role="alert"></div>
                    <input type="hidden" name="id" id="delete_cart_id" value="" />
                    <?php echo are_you_sure; ?>
                </div>
                <div class="modal-footer"><button class="btn btn-primary button-close-background-color" type="button"
                        data-bs-dismiss="modal">No</button>
                    <button class="btn btn-secondary button-background-color" id="yes_delete_cart" type="button"
                        data-bs-dismiss="modal">Yes</button>
                </div>

                </form>
            </div>
        </div>
    </div>
    <!-- delete user -->



</body>

<!-- modal for out of stock -->

<div class="modal fade" id="stockModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-md" style="margin-top:88px">

        <div class="modal-content">

            <div class="modal-header">

                <h1 class="modal-title fs-5" id="exampleModalLabel">Out of Stock</h1>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">

                <!-- if response within jquery -->



            </div>

            <div class="modal-footer"><button class="btn btn-primary button-close-background-color" type="button"
                    data-bs-dismiss="modal">No</button>



            </div>



            </form>

        </div>

    </div>

</div>

<!-- modal for out of stock -->

</html>