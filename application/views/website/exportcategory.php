<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>product page</title>
</head>

<body>
    <div class="main-wrapper">
        <div class="alert alert-success alert-dismissible fade show custom-alert d-none" role="alert"></div>

        <section class="page-title-section bg-img cover-background">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h3><?php echo $selected_category_name; ?></h3>
                    </div>
                    <div class="col-md-5">
                        <ul class="text-md-end text-start mt-2 mt-lg-0 ps-0">
                            <li><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li><a href="#!"><?php echo $selected_category_name; ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <div class="container mt-4">
            <div class="row">
                <?php
  // Filter subcategories for the selected category
  $filteredSubcategories = array_filter($subcategories, function($subcat) use ($selected_category_id) {
    return $subcat['category_id'] == $selected_category_id;
  });
?>

                <?php if (!empty($filteredSubcategories)): ?>
                <section class="md section-border-none p-0">
                    <div class="container">
                        <h5 class="text-center mt-3"> Subcategory</h5>
                        <div class="owl-carousel owl-theme product-item" id="product-category-carousel">
                            <?php foreach ($filteredSubcategories as $subcat): ?>
                            <div class="service-box" data-src="">
                                <div class="project-grid-style2">
                                    <div class="project-detailss card-img">
                                        <img style="height: 105px;"
                                            src="<?php echo base_url();?>uploads/subcategories/<?php echo $subcat['image']; ?>"
                                            alt="<?php echo $subcat['name']; ?>" />
                                        <div class="portfolio-post-border"></div>
                                    </div>
                                    <div class="portfolio-title text-center">
                                        <a type="button" id="subcategoryid"
                                            data-cat-id="<?php echo $selected_category_id; ?>"
                                            data-subcat-id="<?php echo $subcat['id']; ?>"
                                            href="<?php echo base_url('product/' . $selected_category_id . '/' . $subcat['id']); ?>"
                                            class="btn btn-sm d-flex gap-1 category-btn fw-bold">
                                            <?php echo $subcat['name']; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
                <?php endif; ?>

                <div class="col-md-12">
                    <section class="bg-light-gray-new md section-border">
                        <div class="container">
                            <div class="section-heading title-style5">
                                <h3 id="categoryTitle">
                                    <?php echo isset($selected_category_name) ? $selected_category_name : 'Products'; ?>
                                </h3>
                                <div class="square">
                                    <span class="separator-left bg-primary"></span>
                                    <span class="separator-right bg-primary"></span>
                                </div>
                            </div>

                            <div class="row mt-n4">
                                <?php foreach ($products as $product): ?>
                                <?php
                    // Set price based on order type
                    if ($ordertype == 'ws') {
                        $price = $product['wholesale_price'];
                    } elseif ($ordertype == 'rt') {
                        $price = $product['retail_price'];
                    } elseif ($ordertype == 'bb') {
                        $price = $product['franchise_price'];
                    } 
                    elseif($ordertype == 'exp'){
                        $price = $product['export_price'];
                    } 
                     $seasonal_percentage = $product['seasonal_percentage'];
                     $final_price = $price;

                    if ($seasonal_percentage) {
                        $discount = ($price * $seasonal_percentage) / 100;
                        $final_price = $price - $discount;
                    }
                    
                    $stock= $this->Homemodel->getCurrentStock($product['product_id']);
                    $class = ($stock > 0) ? 'in-stock' : 'out-of-stock' ;
                    $disable = ($stock <= 0) ? 'disabled' : '' ;

                    

                    // Set symbol based on order type
                   
                ?>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-3 mt-4 product-item"
                                    data-subcat-id="<?php echo $product['subcategory_id']; ?>">
                                    <div class="service-box" data-src="img/7.jpg">
                                        <div class="project-grid-style2 card-img">
                                            <div class="project-details">
                                                <a href="<?php echo base_url('details/' . $product['product_id']); ?>">

                                                    <img src="<?php echo base_url(); ?>uploads/product/<?php echo $product['image']; ?>"
                                                        alt="..." />
                                                    <div class="portfolio-post-border"></div>
                                                </a>
                                                <!--<img-->
                                                <!--  src="<?php echo base_url();?>uploads/product/<?php echo $product['image']; ?>"-->
                                                <!--  alt="<?php echo $product['product_name']; ?>"-->
                                                <!--/>-->
                                                <!--<div class="portfolio-post-border"></div>-->
                                            </div>
                                            <div class="portfolio-title text-center">
                                                <h4 class="portfolio-link">
                                                    <a
                                                        href="<?php echo base_url('details/' . $product['product_id']); ?>"><?php echo $product['product_name']; ?></a>
                                                </h4>
                                                <p class="price-cart" data-price="<?= $final_price; ?>">
                                                    $ <?= $final_price ?>
                                                    <!-- <?php if ($seasonal_percentage) : ?>
                                                    <span class=" text-decoration-line-through ms-2"
                                                        style="font-size: 14px;">
                                                        $<?=$price; ?>
                                                    </span> -->
                                                    <!-- <span class="badge bg-success ms-2"><?= $seasonal_percentage; ?>%</span> -->
                                                    <?php endif; ?>
                                                </p>
                                                <!-- <p class="price-cart" data-price="<?= $price; ?>">
                            RS
                            <?php echo $price; ?>
                          </p> -->
                                                <div
                                                    class="d-flex align-items-center  px-2 qty-area justify-content-center">
                                                    <button class="btn btn-sm p-1 decrement-btn <?php echo $disable; ?>"
                                                        data-product-id="<?= $product['product_id']; ?>">
                                                        −
                                                    </button>
                                                    <?php
              $quantity = 1;
            foreach ($cart as $item) 
            {
            if ($item['product_id'] == $product['product_id']) 
            {
               $quantity = $item['quantity'];
               break;
            }
            }
        ?>
                                                    <span data-qty><?php echo $quantity ?: 1; ?></span>
                                                    <button class="btn btn-sm p-1 increment-btn <?php echo $disable; ?>"
                                                        data-product-id="<?= $product['product_id']; ?>">
                                                        +
                                                    </button>
                                                </div>
                                                <form method="post" id="add_cart_form" enctype="multipart/form-data">
                                                    <input type="hidden" id="cart_product_id"
                                                        value="<?= $product['product_id']; ?>" />
                                                    <input type="hidden" id="quantity" value="1" class="qty-input" />

                                                    <input type="hidden" id="price"
                                                        value="<?= isset($final_price) ? $final_price : $price; ?>"
                                                        class="qty-price" />
                                                    <input type="hidden" id="product_price"
                                                        value="<?= isset($final_price) ? $final_price : $price; ?>" />
                                                    <!-- <input
                              type="hidden"
                              id="price"
                              value="<?= $price; ?>"
                              class="qty-price"
                            />
                            <input
                              type="hidden"
                              id="product_price"
                              value="<?= $price; ?>"
                            /> -->
                                                    <input type="hidden" id="product_weight"
                                                        value="<?= $product['weight']; ?>" />
                                                    <input type="hidden" id="product_kg_g"
                                                        value="<?= $product['kg_g']; ?>" />
                                                    <div class="d-flex justify-content-center gap-2 mt-2 product">
                                                        <?php if ($product['out_of_stock'] == 1): ?>
                                                        <button type="button"
                                                            class="btn btn-sm out-of-stock d-flex align-items-center gap-1"
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
                                                        <button type="button"
                                                            class="btn btn-sm d-flex align-items-center gap-1 <?php echo $class; ?>"
                                                            id="wishlist_button">
                                                            <i class="fas fa-heart"></i> Wishlist
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>


    </div>


    <script>
    $(document).ready(function() {
        // When a category button is clicked
        $(" .category-btn").click(function(
            e) { // alert('clicked'); e.preventDefault(); // prevent default action //
            Get category name from the button text
            var
                categoryName = $(this).text().trim(); // alert(categoryName);
            // Set the h3 title $("#categoryTitle").text(categoryName);
        });
    });
    </script>
</body>

</html>