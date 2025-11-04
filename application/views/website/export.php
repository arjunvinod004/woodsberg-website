<!DOCTYPE html>
<html lang="en">

<head>
    <!-- metas -->
    <meta charset="utf-8" />
    <meta name="author" content="Chitrakoot Web" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="keywords" content="Woodsberg - lorem ipsum" />
    <meta name="description" content="Woodsberg - lorem ipsum" />

    <!-- title  -->
    <title>Woodsberg</title>

</head>

<body>
    <!-- PAGE LOADING
    ================================================== -->
    <div id="preloader"></div>
    <!-- MAIN WRAPPER
    ================================================== -->
    <div class="main-wrapper">
        <div class="alert alert-success alert-dismissible fade show custom-alert d-none" role="alert">
            <!-- <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> -->
        </div>





        <!-- Categories -->
        <section class="md section-border">
            <div class="container">
                <div class="section-heading">
                    <!-- <h2>Categories</h2> -->
                </div>

                <!-- <?php foreach ($category_ids_with_export as $item) {
    echo $item['id'] . ' - ' . $item['name'] . '<br>';
};?> -->

                <div class="owl-carousel owl-theme" id="services-carousel2">
                    <?php foreach ($category_ids_with_export as $cat): ?>
                    <div class="service-box">
                        <div class="project-grid-style2 text-center">
                            <div class="project-details card-img">
                                <img src="<?php echo base_url(); ?>uploads/categories/<?php echo $cat['image']; ?>"
                                    width="200px" height="200px" alt="..." />
                                <div class="portfolio-icon">
                                    <form method="post" action="<?php echo base_url('home/exportcategory'); ?>">
                                        <input type="hidden" name="category_id" value="<?php echo $cat['id']; ?>" />
                                        <a href="#" class="position-absolute start-50 top-50 translate-middle">
                                            <button type="submit"
                                                class="butn small position-absolute start-50 top-50 translate-middle">
                                                <?php echo $cat['name']; ?>
                                            </button>
                                        </a>
                                    </form>
                                </div>
                                <div class="portfolio-post-border"></div>
                            </div>
                            <h6 class="mt-3">
                                <?php echo $cat['name']; ?>
                            </h6>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </section>



        <!-- Categories -->
        <section class="md section-border d-none">
            <div class="container">
                <div class="section-heading">
                    <!-- <h2>Categories</h2> -->
                </div>

                <!-- <?php foreach ($category_ids_with_export as $item) {
    echo $item['id'] . ' - ' . $item['name'] . '<br>';
};?> -->

                <div class="owl-carousel owl-theme" id="services-carousel2">
                    <?php  for ($i = 0; $i < count($categories); $i += 2) 
{
echo '<div class="service-box">'; for ($j = $i; $j < $i + 2 && $j <
 count($categories); $j++) { ?>
                    <div class="project-grid-style2 text-center">
                        <div class="project-details card-img">
                            <img src="<?php echo base_url();?>uploads/categories/<?php echo $categories[$j]['category_img']; ?>"
                                width="200px" height="200px" alt="..." />
                            <div class="portfolio-icon">
                                <?php foreach ($category_ids_with_export as $cat): ?>
                                <form method="post" action="<?php echo base_url('home/exportcategory'); ?>">
                                    <input type="hidden" name="category_id" value="<?php echo $cat['id']; ?>" />
                                    <a href="#" class="position-absolute start-50 top-50 translate-middle">
                                        <button type="submit"
                                            class="butn small position-absolute start-50 top-50 translate-middle">
                                            <?php echo $cat['name']; ?>
                                        </button>
                                    </a>
                                </form>
                                <?php endforeach; ?>
                            </div>
                            <div class="portfolio-post-border"></div>
                        </div>
                        <h6 class="mt-3">
                            <?php echo $categories[$j]['category_name']; ?>
                        </h6>
                    </div>
                    <?php
    }

    echo '</div>'; } ?>
                </div>
            </div>
        </section>

        <!--Categories-->


        <!-- About us -->

        <section class="md">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-1-9 mb-lg-0">
                        <div>
                            <div class="section-heading left half">
                                <h2 class="title-style2">About Us</h2>
                            </div>
                            <p>We believe each home, each family’s story, has never been easier to tell. From the
                                perfect sofa for family movie nights or a new accent chair to freshen up a new reading
                                space. Or maybe it’s a new mattress and bedroom set to get the good night of sleep you
                                deserve.</p>
                            <a href="#!" class="butn medium"><span>About Company</span></a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-9 offset-lg-1 text-center">
                        <div>
                            <img src="https://lh3.googleusercontent.com/gps-cs-s/AC9h4nrS0mIEGA7KiurT1w42BsbXhdJJ414LU6FSql2r3Dzh14WDCkveQqfVk1i1yeRfOjuxqExHH4Njry3r6XzfdszD4FAV8QMR6IWAxv8joQm-HSn1aqhL_0SOhfUsIFJM1FfZsAZj=s680-w680-h510-rw"
                                alt="..." class="w-50 float-start pe-1 border-radius-5">
                            <img src="https://lh3.googleusercontent.com/gps-cs-s/AC9h4no-QtM6fBeBRn0GtHxLuJpqBRXT7fkiUbxakE77FhandKemwrK_z7hPAY2NJ_CI4ILXzU9irOQV1FPcwgOWWB51ABc_MROBZpcJZRKUnnbroLpAEgFf_O13YsmGz_NjeSJfLPTn=s680-w680-h510-rw"
                                alt="" class="w-50 float-start pe-1 border-radius-5">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About us end -->



        <!-- products -->
        <section class="md section-border">
            <div class="container">
                <div class="section-heading">
                    <h2>Products</h2>
                </div>
                <div class="owl-carousel owl-theme" id="featured-product-carousel">
                    <?php
for ($i = 0; $i < count($home); $i += 2) {
    echo '<div class="service-box product-item ">';
    
    for ($j = $i; $j < $i + 2 && $j < count($home); $j++) {
        $product = $home[$j];

        // Set dynamic price
        if ($ordertype == 'ws') {
            $price = $product['wholesale_price'];
        } elseif ($ordertype == 'rt') {
            $price = $product['retail_price'];
        } elseif ($ordertype == 'bb') {
            $price = $product['franchise_price'];
        } elseif ($ordertype == 'exp') {
            $price = $product['export_price'];
        }

        $stock= $this->Homemodel->getCurrentStock($product['product_id']);
        $class = ($stock > 0) ? 'in-stock' : 'out-of-stock';
        $disabled = ($stock <= 0) ? 'disabled' : '';


        // Get quantity from cart
        $quantity = 1;
        foreach ($cart as $item) {
            if ($item['product_id'] == $product['product_id']) {
                $quantity = $item['quantity'];
                break;
            }
        }
        ?>


                    <div class="project-grid-style2">
                        <div class="project-details card-img">
                            <?php
  $isBestseller = false;
  foreach ($bestseller as $bs) {
    if ($bs['product_id'] == $product['product_id']) {
      $isBestseller = true;
      break;
    }
  }
?>
                            <a href="<?php echo base_url('details/' . $product['product_id']); ?>">
                                <?php if ($isBestseller): ?>
                                <div class="label-offer bg-primary">Best Seller</div>
                                <?php endif; ?>

                                <img src="<?php echo base_url(); ?>uploads/product/<?php echo $product['image']; ?>"
                                    alt="..." width="300px" height="300px" />
                            </a>
                            <a href="<?php echo base_url('details/' . $product['product_id']); ?>">
                                <div class="portfolio-post-border"></div>
                            </a>
                        </div>
                        <div class="portfolio-title text-center">
                            <h4 class="portfolio-link"><a data-id="<?= $product['product_id']; ?>"
                                    href="<?php echo base_url('details/' . $product['product_id']); ?>"
                                    data-id="<?= $product['product_id']; ?>"><?php echo $product['product_name']; ?></a>
                            </h4>


                            <p class="price-cart" data-price="<?= $price; ?>">
                                $
                                <?= $price; ?>
                            </p>

                            <div class="d-flex align-items-center  px-2 qty-area justify-content-center">
                                <button class="btn btn-sm p-1 decrement-btn <?php echo $disabled; ?>"
                                    data-product-id="<?= $product['product_id']; ?>">
                                    −
                                </button>
                                <span data-qty><?= $quantity ?></span>
                                <button class="btn btn-sm p-1 increment-btn <?php echo $disabled; ?>"
                                    data-product-id="<?= $product['product_id']; ?>">
                                    +
                                </button>
                            </div>

                            <form method="post" class="mt-2" id="add_cart_form" enctype="multipart/form-data">
                                <input type="hidden" id="cart_product_id" value="<?= $product['product_id']; ?>">
                                <input type="hidden" id="quantity" value="1" class="qty-input">
                                <input type="hidden" id="price" value="<?= $price; ?>" class="qty-price" />
                                <input type="hidden" id="product_price" value="<?=$price; ?>" />
                                <input type="hidden" id="product_weight" value="<?= $product['weight']; ?>">
                                <input type="hidden" id="product_kg_g" value="<?= $product['kg_g']; ?>">
                                <div class="d-flex justify-content-center gap-2 mt-2 product">
                                    <?php if ($product['out_of_stock'] == 1): ?>
                                    <button type="button"
                                        class="btn btn-sm out-of-stock d-flex align-items-center gap-1" disabled>
                                        <i class="fas fa-times-circle"></i> Out of Stock
                                    </button>
                                    <?php else: ?>
                                    <button type="submit"
                                        class="btn btn-sm d-flex align-items-center gap-1 <?php echo $class; ?>">
                                        <i class="fas fa-shopping-cart"></i> Add to Cart
                                    </button>
                                    <?php endif; ?>

                                    <button type="button"
                                        class="btn btn-sm d-flex align-items-center gap-1 <?php echo $class; ?> "
                                        id="wishlist_button">
                                        <i class="fas fa-heart"></i> Wishlist
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php
    }

    echo '</div>';
}
?>

                </div>
            </div>
        </section>

        <!--products-->


        <!-- contact banner -->
        <section class="parallax md" data-overlay-dark="8"
            data-background="https://media.istockphoto.com/id/1416335096/photo/businessman-hand-holding-smart-phone-with-icon-mobile-phone-mail-telephone-and-address.jpg?s=612x612&w=0&k=20&c=ajOYHJPqlaKZ04BeSf5m3MsuZ_YGyxrUqEGMaS1hGGk=">
            <div class="container text-center">
                <div class="section-heading half white">
                    <h2>Are you looking for professional advice?</h2>
                    <!-- <p>We always try to provide you our best business consulting service.</p> -->
                </div>
                <a href="<?php echo base_url();?>home/contact" class="butn primary white-hover"><span>Contact
                        Us</span></a>
            </div>
        </section>

        <!-- contact banner end -->



        <!-- TESTIMONIAL
        ================================================== -->
        <section class="parallax md" data-overlay-dark="8" data-background="">
            <div class="container">
                <div class="section-heading title-style5">
                    <h3>Happy Customers</h3>
                    <div class="square">
                        <span class="separator-left bg-primary"></span>
                        <span class="separator-right bg-primary"></span>
                    </div>
                </div>

                <div class="owl-carousel owl-theme testimonial-style3">
                    <?php foreach ($testimonial as $product) { ?>
                    <div class="mx-auto">
                        <div class="testimonial-item">
                            <div class="testimonial-review">
                                <p class="font-weight-500">
                                    <?php echo $product['description']; ?>
                                </p>
                            </div>
                            <div class="testimonial-left-col">
                                <div class="testimonial-pic">
                                    <div class="testimonial-separator"></div>
                                    <img src="<?php echo base_url();?>uploads/testimonial/<?php echo $product['image']; ?>"
                                        alt="..." />
                                </div>

                                <div class="client-info">
                                    <h6><?php echo $product['name']; ?></h6>
                                    <span><?php echo $product['position']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>




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

            <div class="modal-footer">



            </div>



            </form>

        </div>

    </div>

</div>

<!-- modal for out of stock -->

</html>