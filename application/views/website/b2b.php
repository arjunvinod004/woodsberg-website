<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B2B</title>
</head>

<body>

    <div class="container mt-4">
        <div class="row">

            
            <!-- Categories -->
            <section class="md section-border">
                <div class="container">
                    <div class="section-heading">
                        <!-- <h2>Categories</h2> -->
                    </div>
                    <div class="owl-carousel owl-theme" id="services-carousel2">
                        <?php  for ($i = 0; $i < count($categories); $i += 2) 
{
echo '<div class="service-box">'; for ($j = $i; $j < $i + 2 && $j <
 count($categories); $j++) { ?>
                        <div class="project-grid-style2 text-center">
                            <div class="project-details card-img">
                                <img src="<?php echo base_url();?>uploads/categories/<?php echo $categories[$j]['category_img']; ?> "
                                    width="200px" height="200px" alt=" ..." />
                                <div class="portfolio-icon">

                                    <input type="hidden" name="category_id"
                                        value="<?php echo $categories[$j]['id']; ?>" />

                                    <a href="<?php echo base_url('home/b2bcategory/'.$categories[$j]['id']); ?>"
                                        class="butn small position-absolute start-50 top-50 translate-middle">
                                        <?php echo $categories[$j]['category_name']; ?>
                                    </a>
                                </div>
                                <div class="portfolio-post-border"></div>
                            </div>
                            <h6 class="mt-3 categoryname">
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






            <div class="col-md-12">
                <!-- products -->
                <section class="bg-light-gray-new md section-border">
                    <div class="container">

                        <div class="section-heading title-style5">
                            <h3>Products</h3>
                            <div class="square">
                                <span class="separator-left bg-primary"></span>
                                <span class="separator-right bg-primary"></span>
                            </div>
                        </div>

                        <div class="row mt-n4" id="productContainer">
                            <?php foreach ($home as $product): ?>
                            <?php
                    // Set price based on order type
                    if ($ordertype == 'ws') {
                        $price = $product['wholesale_price'];
                    } elseif ($ordertype == 'rt') {
                        $price = $product['retail_price'];
                    } elseif ($ordertype == 'bb') {
                        $price = $product['franchise_price'];
                    }

            $stock= $this->Homemodel->getCurrentStock($product['product_id']);
            $class = ($stock > 0) ? 'in-stock' : 'out-of-stock';
            $disabled = ($stock <= 0) ? 'disabled' : '';
                ?>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mt-4 product-item"
                                data-subcat-id="<?php echo $product['subcategory_id']; ?>">
                                <div class="service-box" data-src="img/7.jpg">
                                    <div class="project-grid-style2">
                                        <div class="project-details">
                                            <a href="<?php echo base_url('details/' . $product['product_id']); ?>">

                                                <img width="300px" height="300px" src="<?php echo base_url(); ?>uploads/product/<?php echo $product['image']; ?>"
                                                    alt="..." />
                                                <div class="portfolio-post-border"></div>
                                            </a>
                                            <!--<img src="<?php echo base_url();?>uploads/product/<?php echo $product['image']; ?>" alt="<?php echo $product['product_name']; ?>">-->
                                            <!--<div class="portfolio-post-border"></div>-->
                                        </div>
                                        <div class="portfolio-title text-center">
                                            <h4 class="portfolio-link">
                                                <a data-id="<?php echo $product['product_id']; ?>"
                                                    href="<?php echo base_url('details/' . $product['product_id']); ?>">
                                                    <?php echo $product['product_name']; ?></a>
                                            </h4>
                                            <p class="price-cart" data-price="<?=  $price; ?>">₹<?php echo  $price; ?>
                                            </p>

                                            <div class="d-flex align-items-center px-2 qty-area justify-content-center">
                                                <button class="btn btn-sm p-1 decrement-btn <?php echo $disabled; ?>"
                                                    data-product-id="<?= $product['product_id']; ?>">−</button>
                                                <?php
                  $quantity = 1;
                  foreach ($cart as $item) {
                    if ($item['product_id'] == $product['product_id']) {
                      $quantity = $item['quantity'];
                      break;
                    }
                  }
              ?>
                                                <span data-qty><?= $quantity ?: 1; ?></span>
                                                <button class="btn btn-sm p-1 increment-btn <?php echo $disabled; ?>"
                                                    data-product-id="<?= $product['product_id']; ?>">+</button>
                                            </div>

                                            <form method="post" id="add_cart_form" enctype="multipart/form-data">
                                                <input type="hidden" id="cart_product_id"
                                                    value="<?= $product['product_id']; ?>">
                                                <input type="hidden" id="quantity" value="1" class="qty-input">
                                                <input type="hidden" id="price" value="<?=  $price; ?>"
                                                    class="qty-price">
                                                <input type="hidden" id="product_price" value="<?=  $price; ?>">
                                                <input type="hidden" id="product_weight"
                                                    value="<?= $product['weight']; ?>">
                                                <input type="hidden" id="product_kg_g" value="<?= $product['kg_g']; ?>">
                                                <div class="d-flex justify-content-center gap-2 mt-2 product">
                                                    <?php if ($product['out_of_stock'] == 1): ?>
                                                    <button type="button"
                                                        class="btn btn-sm out-of-stock  d-flex align-items-center gap-1"
                                                        disabled>
                                                        Out of Stock
                                                    </button>
                                                    <?php else: ?>
                                                    <button type="submit"
                                                        class="btn btn-sm d-flex align-items-center gap-1 <?php echo $class; ?>"
                                                        title="Add to Cart">
                                                        <i class="fas fa-shopping-cart"></i> Add to Cart
                                                    </button>
                                                    <?php endif; ?>
                                                    <!-- <button type="submit" class="btn btn-sm d-flex align-items-center gap-1">
              <i class="fas fa-shopping-cart"></i> Add to Cart
            </button> -->
                                                    <button type="button" id="wishlist_button"
                                                        class="btn btn-sm d-flex align-items-center gap-1 <?php echo $class; ?>">
                                                        <i class="fas fa-heart"></i> Wishlist
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>

                            <!-- <div class="col-6 col-sm-6 col-md-6 col-lg-3 mt-4">
                        <div class="service-box" data-src="img/7.jpg">
                            <div class="project-grid-style2">
                                <div class="project-details">
                                    <img src="<?php echo base_url();?>assets/website/images/7.jpg" alt="...">
                                    <div class="portfolio-post-border"></div>
                                </div>
                                <div class="portfolio-title text-center">
                                    <h4 class="portfolio-link"><a href="#">Mirror</a></h4>
                                    <p>RS 2999</p>

                                     
    <div class="d-flex align-items-center border rounded px-2 qty-area">
        <button class="btn btn-sm p-1" onclick="decrementQuantity(this)">−</button>
        <span data-qty>1</span>
        <button class="btn btn-sm p-1" onclick="incrementQuantity(this)">+</button>
    </div>

                                    <div class="d-flex justify-content-center gap-2 mt-2 product">
                                        <button class="btn btn-sm   d-flex align-items-center gap-1" title="Add to Cart">
                                            <i class="fas fa-shopping-cart"></i> Add to Cart
                                        </button>
                                        <button class="btn btn-sm d-flex align-items-center gap-1" title="Add to Wishlist">
                                            <i class="fas fa-heart"></i> Wishlist
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->


                        </div>
                    </div>
                    <div class="container d-none">
                        <div class="row justify-content-center mt-4">
                            <div class="col-auto">
                                <a href="<?php echo base_url(isset($product_id) ? 'product/' . $product_id : 'product'); ?>"
                                    class="butn"><span>More products</span></a>
                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>
</body>




</html>