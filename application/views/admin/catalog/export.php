<div class="application-content dashboard-content">
    <div class="application-content__container container">

    
        <!--<h1 class="application-content__page-heading">Dishes Catalog</h1>-->

        <div class="search-add-new-dish-list-combo">
            <form class="product-search__form search">
                <input type="text" id="search_product" placeholder="Search for a product" name="search"
                    class="product-search__field search-input1">
                <button type="submit" class="product-search__button"><img
                        src="<?php echo base_url(); ?>assets/admin/images/product-search-icon.svg" width="22"
                        height="23" alt="SearchIcon" class="product-search__icon"></button>
                <ul id="autocomplete-results1" class="autocomplete-results">
                </ul>
            </form>
            <div class="add-new-dish-list-combo">
                <a href="<?php echo base_url('admin/product/addproduct'); ?>" class="add-new-dish-btn btn1">
                    <img src="<?php echo base_url(); ?>assets/admin/images/add-new-dish-icon.svg" alt="add new dish"
                        class="add-new-dish__icon" width="23" height="23">
                    Add New Product
                </a>

                <!-- <a href="<?php echo base_url('owner/combo'); ?>" class="list-combo-btn btn2">
                    <img src="<?php echo base_url(); ?>assets/admin/images/list-combo-icon.svg" alt="list combo icon"
                        class="list-combo__icon" width="23" height="23">
                    Combos
                </a> -->
            </div>
        </div>
        <div class="product-list" id="search_result_container">

            <?php
            if(!empty($products)){
                // print_r($products);
                $count = 1;
                foreach($products as $val){

                    if($val['category_id'] != 23 ){
                     
 ?>
            <div class="product-list__item">
                <div class="product-list__item-image-and-details">
                    <?php
                        $path = ($val['image'] != '') ? site_url() . "uploads/product/" . $val['image'] : site_url() . "uploads/product/" . $val['image'];
                    ?>
                    <img src="<?php echo $path; ?>" alt="<?php echo $val['product_name']; ?>" class="product-list__item-img" width="190"
                        height="150">
                    <div class="product-list__item-details">
                        <h3 class="product-list__item-name">
                            <?php echo ($val['product_name'] != '') ? $val['product_name'] : $val['product_name']; ?>
                        </h3>
                        <p class="product-list__item-price">
                            ₹<?php echo $val['retail_price']; ?></p>
                        <p class="product-list__item-price">
                            <?php echo $val['description']; ?></p>



                        <!-- <?php 
                        $status = ($stock > 0) && ($val['availability'] == 0) ? 'available' : 'unavailable';
                        ?> -->
                        <!-- <p class="product-list__item-status-<?php echo $status; ?> text-capitalize">
                            <?php echo $status; ?>
                        </p> -->
                        <div class="product-list__item-details-availability-stock">
                            <!-- <select width="50%" class="change_availability"
                                data-id="<?php echo $val['store_product_id']; ?>" class="form-select mb-2">

                                <option value="0" <?php echo ($val['availability'] == 0) ? 'selected' : ''; ?>>Active
                                </option>
                                <option value="1" <?php echo ($val['availability'] == 1) ? 'selected' : ''; ?>>
                                    Inactive
                                </option>
                            </select> -->

                            <div class="product-list__item-stock d-none">
                                <div class="product-list__item-stock-label">Stock</div>
                                <div class="product-list__item-stock-count ">
                                    <?php 
                                     echo ($stock !== null && $stock !== false) ? $stock : 0;
                                ?>
                                </div>
                            </div>
                          
                        </div>

                    </div>
                </div>
                <div class="product-list__item-buttons-block">
                    <div class="product-list__item-buttons-block-one">
                        <!-- <a href=""
                            class="product-list__item-buttons-block-btn product-list__item-buttons-block-add-new-stock-btn btn6 open-modal"
                            data-bs-toggle="modal" data-id="<?php echo $val['product_id']; ?>"
                            data-bs-target="#addstock"><img class="product-list__item-button-img"
                                src="<?php echo base_url(); ?>assets/admin/images/add-stock-icon.svg" alt="add stock"
                                width="23" height="24"> Add
                            Stock</a> -->


                          
                        <a data-bs-toggle="modal" data-bs-target="#Edit-Product"
                            data-id="<?php echo $val['product_id']; ?>"
                          href=""
                            class="product-list__item-buttons-block-btn btn6 edit-btn product-list__item-buttons-block-edit-btn edit_product"><img
                                class="product-list__item-button-img"
                                src="<?php echo base_url(); ?>assets/admin/images/edit-dish-icon.svg" alt="add stock"
                                width="23" height="22">Edit Product</a>
                       
                        <a  data-bs-toggle="modal" data-id="<?php echo $val['product_id']; ?>"
                        data-bs-target="#delete-product" href=""
                            class="product-list__item-buttons-block-btn btn6 product-list__item-buttons-block-remove-stock-btn remove_product"
                           ><img class="product-list__item-button-img"
                                src="<?php echo base_url(); ?>assets/admin/images/remove-stock-icon.svg"
                                alt="remove stock" width="23" height="22">Remove
                            Product</a>
                    </div>
                    <div class="product-list__item-buttons-block-two">
                        <!-- <?php if($stock == 0){ ?>
                        <a href=""
                            class="product-list__item-buttons-block-btn btn6 product-list__item-buttons-block-next-available-btn nextavialable-modal"
                            data-bs-toggle="modal" data-id="<?php echo $val['product_id']; ?>"
                            data-bs-target="#nextavailabletime"><img class="product-list__item-button-img"
                                src="<?php echo base_url(); ?>assets/admin/images/next-available-time-icon.svg"
                                alt="next available button stock" width="23" height="24">Next
                            Available Time</a>
                        <?php } ?> -->
                        
                        
                        
                       
                    </div>



                </div>
            </div>
            <?php $count++; }} } ?>



        </div>
        <div class="pagination-wrapper">
            <?= $pagination; ?>
        </div>

    </div>



</div>




   <!-- edit product -->
   <div class="modal fade" id="Edit-Product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Edit Product</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row bg-soft-light mb-3 border1 pt-2">
                        <form class="row mt-0 mb-0" id="edit_products"
                        enctype="multipart/form-data" method="post" >

                        <input type="hidden" id="hidden_product_id" >
                           
    
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input">category</label>
                                    <select class="form-select" name="category_id" id="category_id">
                                    
                                                        <option value="">Select Category</option>
                                                        <?php
                                foreach($categories as $category)
                                {
                                    
                                ?>
                                                        <option value="<?=$category['category_id'];?>"
                                                            <?php if(isset($productDet[0]['category_id']) && ($productDet[0]['category_id']==$category['category_id'])) echo 'selected';else echo set_select('category_id', $category['category_id'])?>>
                                                            <?=$category['category_name'];?></option>
                                                        <?php
                                }
                                ?>
                                                    </select>
                                    
                                    <span class="error errormsg mt-2" id="category_edit_error"></span>
                                    <div id="general_error" class="error errormsg"></div>
                                </div>
                            </div>


                        
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input">subcategory</label>
                                    <select class="form-select subcategoryy_id" name="subcategory_id" id="subcategory_id"> 
                                    <option value="">select Subcategories</option>
                                     <?php
                                foreach($subcategories as $category)
                                {
                                    
                                ?>
                                                        <option value="<?=$category['id'];?>"
                                                            <?php if(isset($productDet[0]['id']) && ($productDet[0]['id']==$category['id'])) echo 'selected';else echo set_select('id', $category['id'])?>>
                                                            <?=$category['name'];?></option>
                                                        <?php
                                }
                                ?>
                                                    </select>
                                    
                                    <span class="error errormsg mt-2" id="subcategory_id_edit_error"></span>
                                    <div id="general_error" class="error errormsg"></div>
                                </div>
                            </div>
    
    
                            
    
                          
    
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input">Product Name</label>
                                    <input class="form-control"
                                    value="" type="text"
                                    placeholder="English" name="product_name" id="product_name">
                                    <span class="error errormsg mt-2" id="product_edit_name_error" ></span>
                                </div>
                            </div>
    
                           
    
    
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input"> Price (L.C) </label>
                                    <input class="form-control"
                                    value="" type="text"
                                    placeholder="English" name="price" id="price">
                                 <span class="error errormsg mt-2" id="price_edit_error"></span>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input"> Wholesale price </label>
                                    <input class="form-control"
                                    value="" type="text"
                                    placeholder="English" name="product_wholesale_price" id="product_wholesale_price">
                                 <span class="error errormsg mt-2" id="product_wholesale_price_edit_error"></span>
                                </div>
                            </div>



                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input"> Retail price  </label>
                                    <input class="form-control"
                                    value="" type="text"
                                    placeholder="English" name="product_retail_price" id="product_retail_price">
                                 <span class="error errormsg mt-2" id="product_retail_price_edit_error"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input"> franchise price (B2B) </label>
                                    <input class="form-control"
                                    value="" type="text"
                                    placeholder="English" name="product_franchise_price" id="product_franchise_price">
                                 <span class="error errormsg mt-2" id="product_franchise_price_edit_error"></span>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input">Export Price</label>
                                    <input class="form-control"
                                    value="" type="text"
                                    placeholder="English" name="product_export_price" id="product_export_price">
                                 <span class="error errormsg mt-2" id="product_export_price_edit_error"></span>
                                </div>
                            </div>
                         
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input"> description </label>
                                    <textarea style="height: 15px;" class="form-control summernote"
                                    value="" type="text"
                                    placeholder="English" name="product_description" id="product_description"></textarea>
                                 <span class="error errormsg mt-2" id="product_description_edit_error"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input"> weight </label>
                                    <input class="form-control"
                                    value="" type="text"
                                    placeholder="English" name="product_weight" id="product_weight">
                                 <span class="error errormsg mt-2" id="product_weight_edit_error"></span>
                                </div>
                            </div>

                             <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input"> Kg/g </label>
                                  <select name="product_weight_type" id="product_weight_type" class="form-select" >
                                      <option value="Kg" <?= set_select('units', 'Kg') ?>>Kg</option>
                                      <option value="g" <?= set_select('units', 'g') ?>>g</option>
                                  </select>
                                 <span class="error errormsg mt-2" id="product_weight_type_edit_error"></span>
                                </div>
                            </div>


                          



                            


                            <div class="col-md-4">
                            <div class="image-item">
                                <img id="previewImage"
                                    src=""
                                    width="100" class="" />
                                    <input type="hidden" name="image_id" id="image_id" value="">
                                <input type="file" name="image" class="form-control"  />
                                <span id="product_image_error"
                                class="error errormsg mt-2"></span>
                            </div>
                            </div>

                            <div class="col-md-4">
                            <div class="image-item">
                                <img id="previewImage1"
                                    src=""
                                    width="100" class="" />
                                    <input type="hidden" name="image_id1" id="image_id1" value="">
                                <input type="file" name="image1" class="form-control"  />
                                <span id="product_image1_error"
                                class="error errormsg mt-2"></span>
                            </div>
                            </div>

                            <div class="col-md-4">
                            <div class="image-item">
                                <img id="previewImage2"
                                    src=""
                                    width="100" class="" />
                                    <input type="hidden" name="image_id2" id="image_id2" value="">
                                <input type="file" name="image2" class="form-control"  />
                                <span id="product_image2_error"
                                class="error errormsg mt-2"></span>
                            </div>
                            </div>

                            <div class="col-md-4">
                            <div class="image-item">
                                <img id="previewImage3"
                                    src=""
                                    width="100" class="" />
                                    <input type="hidden" name="image_id3" id="image_id3" value="">
                                <input type="file" name="image3" class="form-control"  />
                                <span id="product_image3_error"
                                class="error errormsg mt-2"></span>
                            </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mt-3">
                                <label class="form-label" for="default-input">Home</label>
                                    <input 
                                    value="" type="checkbox"
                                    id="is_home_edit">
                                    <input 
                                    value="" type="hidden" name="is_home_edit_hidden"
                                  id="is_home_edit_hidden" value="0">
                              
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mt-3">
                                <label class="form-label" for="default-input">Bestseller</label>
                                    <input 
                                    value="" type="checkbox"
                                 id="is_bestseller_edit">
                                    <input 
                                    value="" type="hidden" name="is_bestseller_edit_hidden"
                                  id="is_bestseller_edit_hidden" value="0">
                              
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mt-3">
                                <label class="form-label" for="default-input">Seasonal offer</label>
                                    <input 
                                    value="" type="checkbox"
                                  id="is_seasonaloffer_edit">
                                    <input 
                                    value="" type="hidden"
                                    name="is_seasonaloffer_edit_hidden"  id="is_seasonaloffer_edit_hidden" value="0">
                              
                                </div>
                            </div>


                             <div class="col-md-3">
                                <div class="mt-3">
                                <label class="form-label" for="default-input">Out of Stock</label>
                                    <input 
                                    value="" type="checkbox"
                                  id="out_of_stock_edit">
                                    <input 
                                    value="" type="hidden"
                                    name="out_of_stock_edit_hidden"  id="out_of_stock_edit_hidden" value="0">
                              
                                </div>
                            </div>


                            <div class="col-md-3 seasonal-percent d-none">
                               <label class="form-label">Discount (%)</label>
                                <input type="text" class="form-control" name="seasonal_percentage" id="seasonal_percentage"  value="" placeholder="Seasonal Percentage" >
                                <span id="seasonal_percentage_error"
                                    class="error errormsg mt-2"></span>
                            </div>

    
                            <div class="col-md-12 mt-2">
                                <div class="justify-content-center" style="float: right;">
                                    <button class="btn btn-primary w-md"  type="button" id="save_product" >Update</button>
                                </div>
                            </div>
                        </form>
                </div>
                    </div>
                   
                </div>
            </div>
        </div>



    </div>

    <!-- edit product -->


     <!-- success modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="emigo-modal__heading" id="exampleModalLabel"></h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary reload-close-btn" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- success modal -->

        <!-- delete user -->
        <div class="modal fade " id="delete-product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                    <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- if response within jquery -->
                    <div class="message d-none" role="alert"></div>
                    <input type="hidden" name="id" id="delete_product_id" value="" />
                    <?php echo are_you_sure; ?>
                </div>
                <div class="modal-footer"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                    <button class="btn btn-secondary" id="yes_product_user" type="button" data-bs-dismiss="modal">Yes</button>
                </div>
    
                </form>
            </div>
        </div>
    </div>
    <!-- delete user -->




