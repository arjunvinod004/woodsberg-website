 <link rel="stylesheet" href="<?php echo base_url();?>assets/website/css/productfound.css">
 <section class="page-title-section bg-img cover-background">

     <div class="container">



         <div class="row">

             <div class="col-md-7">

                 <h3>Search Details</h3>

             </div>

             <div class="col-md-5">

                 <ul class="text-md-end text-start mt-2 mt-lg-0 ps-0">

                     <li><a href="<?php echo base_url(); ?>">Home</a></li>

                     <li><a href="#!">Search Details</a></li>

                 </ul>

             </div>

         </div>



     </div>

 </section>







 <section class="bg-light-gray-new md section-border">

     <div class="container">

         <div class="row">
             <div class="owl-item active d-flex">
                 <?php foreach ($searchcategories as $category): ?>
                 <div class="service-box">
                     <div class="project-grid-style2 text-center">
                         <div class="project-details card-img">
                             <img height="200px" width="200px" src="<?php echo base_url();?>uploads/categories/<?php echo $category['category_img']; ?>"
                                 alt="...">
                             <div class="portfolio-icon">
                                <input type="hidden" name="category_id" value="<?php echo $category['id']; ?>" />
                                <a href="<?php echo base_url('home/category/'.$category['id']); ?>"
                                    class="butn small position-absolute start-50 top-50 translate-middle">
                                    <?php echo $category['category_name']; ?>
                                </a>
                               
                            </div>
                             <div class="portfolio-post-border"></div>
                         </div>
                         <h6 class="mt-3">
                             <?php echo $category['category_name']; ?> </h6>
                     </div>

                 </div>
                 <?php endforeach; ?>


             </div>

         </div>



         <div class="section-heading title-style5">

             <h3 id="categoryTitle">products</h3>



             <!-- <h3 class="d-none" id="subcategoryTitle"><?php echo isset($selected_subcategory_name) ? $selected_subcategory_name : 'Products'; ?></h3> -->






             <div class="square">

                 <span class="separator-left bg-primary"></span>

                 <span class="separator-right bg-primary"></span>

             </div>

         </div>



         <div class="row mt-n4">



             <?php if (!empty($searchproduct)): ?>

             <?php foreach ($searchproduct as $product): ?>

             <?php

        // Set price based on order type

        $price = $product->retail_price;

        // print_r($price);

        if ($ordertype == 'ws') {

            $price = $product->wholesale_price;

        } elseif ($ordertype == 'rt') {

            $price = $product->retail_price;
            // print_r($price);

        } elseif ($ordertype == 'bb') {

            $price = $product->franchise_price;

        } elseif ($ordertype == 'exp') {

            $price = $product->export_price;

        }

        $seasonal_percentage = ''; // Default value
if ($ordertype == 'rt' && !empty($product -> seasonal_percentage)) {
    $seasonal_percentage = $product->seasonal_percentage;
    $discount = ($price * $seasonal_percentage) / 100;
    $final_price = $price - $discount;
} else {
    $final_price = $price;
}
if($ordertype == 'exp')
{
  $symbol = '$'; // Assuming export prices are in dollars
}
else{
  $symbol = 'RS'; // Default symbol for other order types
}

 $stock= $this->Homemodel->getCurrentStock($product->product_id);
                        $class = ($stock > 0) ? 'in-stock' : 'out-of-stock' ;
                        $disable = ($stock <= 0) ? 'disabled' : '' ;
        

    ?>



             <div class="col-6 col-sm-6 col-md-6 col-lg-3 mt-4 product-item">
                 <div class="service-box" data-src="img/7.jpg">
                     <div class="project-grid-style2">

                         <div class="project-details">

                             <img src="<?php echo base_url();?>uploads/product/<?php echo $product->image; ?>"
                                 alt="<?php echo $product->product_name; ?>">

                             <a href="<?php echo base_url('details/' . $product->product_id); ?>">
                                 <div class="portfolio-post-border"></div>
                             </a>

                         </div>

                         <div class="portfolio-title text-center">

                             <h4 class="portfolio-link"><a data-id="<?php echo $product->product_id; ?>"
                                     href="<?php echo base_url('details/' . $product->product_id); ?>"><?php echo $product->product_name;; ?></a>
                             </h4>

                             <p class="price-cart" data-price="<?= $final_price; ?>">
                                 <?php echo $symbol; ?> <?= $final_price ?>
                                 <?php if ($ordertype == 'rt' && $seasonal_percentage): ?> <span
                                     class="text-decoration-line-through ms-2" style="font-size: 14px;">
                                     RS <?= $price; ?>
                                 </span>
                                 <?php endif; ?>
                             </p>


                             <!-- <p class="price-cart" data-price="<?=  $price; ?>">RS <?php echo $price; ?></p> -->

                             <div class="d-flex align-items-center px-2 qty-area justify-content-center">

                                 <button class="btn btn-sm p-1 decrement-btn <?php echo $disable; ?>"
                                     data-product-id="<?= $product->product_id; ?>">−</button>

                                 <?php

              $quantity = 1;

            foreach ($cart as $item) {

            if ($item['product_id'] == $product->product_id) 

            {

               $quantity = $item['quantity'];

               break;

            }

            }

            ?>

                                 <span data-qty><?php echo $quantity ?: 1; ?></span>

                                 <button class="btn btn-sm p-1 increment-btn <?php echo $disable; ?>"
                                     data-product-id="<?= $product->product_id; ?>">+</button>

                             </div>

                             <form method="post" id="add_cart_form" enctype="multipart/form-data">

                                 <input type="hidden" id="cart_product_id" value="<?= $product->product_id; ?>">

                                 <input type="hidden" id="quantity" value="1" class="qty-input">

                                 <input type="hidden" id="price"
                                     value="<?= isset($final_price) ? $final_price : $price; ?>" class="qty-price" />
                                 <input type="hidden" id="product_price"
                                     value="<?= isset($final_price) ? $final_price : $price; ?>" />

                                 <!-- <input type="hidden" id="price" value="<?=  $price; ?>" class="qty-price">

                                 <input type="hidden" id="product_price" value="<?=  $price; ?>"> -->

                                 <input type="hidden" id="product_weight" value="<?=$product->weight; ?>">

                                 <input type="hidden" id="product_kg_g" value="<?= $product->kg_g; ?>">

                                 <div class="d-flex justify-content-center gap-2 mt-2 product">

                                     <?php if ($product->out_of_stock == 1): ?>

                                     <button type="button"
                                         class="btn btn-sm out-of-stock  d-flex align-items-center gap-1" disabled>

                                         Out of Stock

                                     </button>

                                     <?php else: ?>

                                     <button type="submit"
                                         class="btn btn-sm d-flex align-items-center gap-1 <?php echo $class; ?>"
                                         title="Add to Cart">

                                         <i class="fas fa-shopping-cart"></i> Add to Cart

                                     </button>

                                     <?php endif; ?>

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

             <?php else: ?>

             <div class="icon-container">
                 <div class="paint-icon mt-5">
                     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                         <circle cx="11" cy="11" r="8"></circle>
                         <path d="m21 21-4.35-4.35"></path>
                     </svg>
                 </div>
             </div>

             <h2 class="title text-center">No Products Found</h2>

             <?php endif; ?>
         </div>
     </div>

 </section>