<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Wishlist</title>

</head>

<body>


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
?>

    <div class="main-wrapper">







        <section class="page-title-section bg-img cover-background">

            <div class="container">



                <div class="row">

                    <div class="col-md-7">

                        <h3>Wishlist</h3>

                    </div>

                    <div class="col-md-5">

                        <ul class="text-md-end text-start mt-2 mt-lg-0 ps-0">

                            <li><a href="<?php echo base_url(); ?>">Home</a></li>

                            <li><a href="#!">Wishlist</a></li>

                        </ul>

                    </div>

                </div>



            </div>

        </section>



        <section class="ptb-60">

            <div class="container">



                <div class="row">



                    <!-- product table -->

                    <div class="col-lg-12 col-md-12">

                        <div class="table-responsive">

                            <table class="table table-bordered align-middle text-center">
                                <?php if (!empty($wishlist)): ?>

                                <thead class="table-light">

                                    <tr>

                                        <th scope="col" class="d-md-table-cell">Image</th>

                                        <th scope="col">Product</th>

                                        <th scope="col">Price</th>

                                        <th scope="col">Actions</th>

                                    </tr>

                                </thead>

                                <?php endif; ?>;



                                <tbody class=" portfolio-title">

                                    <?php if (!empty($wishlist)): ?>

                                    <?php foreach ($wishlist as $product): ?>

                                    <tr>

                                        <!-- Image (hidden on small devices) -->

                                        <td class=" d-md-table-cell" data-image="<?= $product['image']; ?>">

                                            <a href="#!">

                                                <img src="<?= base_url(); ?>uploads/product/<?= $product['image']; ?>"
                                                    alt="..." class="img-fluid w-100px">

                                            </a>

                                        </td>



                                        <!-- Product Name -->

                                        <td class="product-name" data-name="<?= $product['name']; ?>">

                                            <a href="#!"><?= $product['name']; ?></a>

                                        </td>

                                        <input type="hidden" id="wishlist_quantity"
                                            value="<?= $product['quantity']; ?>">
                                        <input type="hidden" id="wishlist_product_id"
                                            value="<?= $product['product_id']; ?>">



                                        <!-- Price -->

                                        <td class="price-cart" data-price="<?= $product_price ?? $product['price']; ?>">

                                            ₹<?= $product['price']; ?>

                                        </td>



                                        <!-- Delete Button -->

                                        <td class="remove">

                                            <a class="delete-wishlist" data-bs-toggle="modal"
                                                data-id="<?= $product['product_id']; ?>"
                                                data-bs-target="#delete-wishlist">

                                                <i class="far fa-trash-alt text-danger"></i>

                                            </a>

                                            <a href="#" class="butn small mx-2 wish-cart"
                                                data-id="<?= $product['product_id']; ?>"><span>Add to Cart</span></a>

                                        </td>



                                    </tr>

                                    <?php endforeach; ?>

                                    <?php else: ?>

                                    <tr class="d-none">

                                        <td colspan="4" class="text-center">No product found</td>

                                    </tr>

                                    <?php endif; ?>

                                </tbody>

                            </table>

                        </div>

                    </div>



                    <!-- end product table -->



                    <!-- button set -->

                    <div class="col-12 border-bottom border-top py-1-9 py-lg-2-3 mb-3 mb-lg-0">

                        <!-- <button class="butn small mb-2 mb-sm-0"><span>Empty Cart</span></button> -->

                        <button class="butn medium float-end ms-2 mb-2 mb-sm-0"> <a style="color: white;"
                                href="<?php echo $redirect_url; ?>"><span>Continue
                                    Shopping</span></a></button>

                        <button class="butn small float-end ms-2 mb-2 mb-sm-0 d-none"> <a style="color: white;"
                                href="<?php echo base_url(); ?>"><span>total price :
                                    <?php echo $sumofprice; ?></span></a></button>

                        <!-- <button class="butn small float-end ms-2"><span>Update Shopping Cart</span></button> -->

                    </div>

                    <!-- end button set -->



                    <!-- total block set -->

                </div>







            </div>



        </section>









    </div>





    <!-- delete testimonials -->

    <div class="modal fade " id="delete-wishlist" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-md" style="margin-top:88px">

            <div class="modal-content">

                <div class="modal-header">

                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <!-- if response within jquery -->

                    <div class="message d-none" role="alert"></div>

                    <input type="hidden" name="id" id="delete_wishlist_id" value="" />

                    <?php echo are_you_sure; ?>

                </div>

                <div class="modal-footer"><button class="btn btn-primary button-close-background-color" type="button"
                        data-bs-dismiss="modal">No</button>

                    <button class="btn btn-secondary button-background-color" id="yes_delete_wishlist" type="button"
                        data-bs-dismiss="modal">Yes</button>

                </div>



                </form>

            </div>

        </div>

    </div>

    <!-- delete user -->



</body>

</html>