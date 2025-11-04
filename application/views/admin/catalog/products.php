<div class="application-content dashboard-content">
    <div class="application-content__container container-fluid">


        <h1 class="application-content__page-heading mt-3 text-center">Products</h1>

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
                <!-- <form method="post" action="<?= base_url('admin/Excel/import') ?>" enctype="multipart/form-data"
                    id="excelForm">
                    <div style="display: flex; align-items: center; gap: 10px;">

                       
                        <label for="excel_file" class="add-new-dish-btn btn1"
                            style="cursor: pointer; display: flex; align-items: center; gap: 5px;">
                            <img src="https://img.icons8.com/color/48/microsoft-excel-2019--v1.png" alt="Excel icon"
                                width="33" height="23">
                            Upload
                        </label>

                      
                        <input type="file" id="excel_file" name="excel_file" accept=".xls,.xlsx,.csv"
                            style="display: none;" required>
                    </div>
                </form> -->


            </div>
        </div>
        <div class="product-list" id="search_result_container">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
if (!empty($products)) 
    {
    $count = 1;
    foreach ($products as $val) 
    { ?>
                    <tr>
                        <th scope="row"><?= $count++; ?></th>
                        <td> <?php
                        $path = ($val['image'] != '') ? site_url() . "uploads/product/" . $val['image'] : site_url() . "uploads/product/" . $val['image'];
                    ?>
                            <img src="<?php echo $path; ?>" alt="<?php echo $val['product_name']; ?>"
                                class="product-list__item-img" width="190" height="150">
                        </td>
                        <td> <?php echo ($val['product_name'] != '') ? $val['product_name'] : $val['product_name']; ?>
                        </td>
                        <td> ₹<?php echo $val['retail_price']; ?></td>
                        <td> <?php echo $this->Homemodel->getCurrentStock($val['product_id']); ?>
                        </td>
                        <td><a class="edit_product tblEditBtn" href="" data-bs-toggle="modal"
                                data-bs-target="#Edit-Product" data-id="<?php echo $val['product_id']; ?>">
                                <i class="fa fa-edit"></i></a>

                            <a data-bs-toggle="modal" data-id="<?php echo $val['product_id']; ?>"
                                data-bs-target="#delete-product" class="remove_product tblDelBtn" href="">
                                <i class="fa-solid fa-trash"></i>
                            </a>

                        </td>
                    </tr>
                    <?php
    }
}
?>
                </tbody>
            </table>


            
            <?php
            if(!empty($products)){
                // print_r($products);
                $count = 1;
                foreach($products as $val){

                    if($val['category_id'] != 23 ){
                     
 ?> <div class="product-list__item d-none">
                <div class="product-list__item-image-and-details">
                    <?php
                        $path = ($val['image'] != '') ? site_url() . "uploads/product/" . $val['image'] : site_url() . "uploads/product/" . $val['image'];
                    ?>
                    <img src="<?php echo $path; ?>" alt="<?php echo $val['product_name']; ?>"
                        class="product-list__item-img" width="190" height="150">
                    <div class="product-list__item-details">
                        <h3 class="product-list__item-name">
                            <?php echo ($val['product_name'] != '') ? $val['product_name'] : $val['product_name']; ?>
                        </h3>
                        <p class="product-list__item-price">
                            ₹<?php echo $val['retail_price']; ?></p>
                        <!-- <p class="product-list__item-price">
                            <?php echo $val['description']; ?></p> -->




                        <div class="product-list__item-details-availability-stock">
                            <!-- <select width="50%" class="change_availability"
                                data-id="<?php echo $val['store_product_id']; ?>" class="form-select mb-2">

                                <option value="0" <?php echo ($val['availability'] == 0) ? 'selected' : ''; ?>>Active
                                </option>
                                <option value="1" <?php echo ($val['availability'] == 1) ? 'selected' : ''; ?>>
                                    Inactive
                                </option>
                            </select> -->

                            <div class="product-list__item-stock ">
                                <div class="product-list__item-stock-label p-2">Stock</div>
                                <div class="product-list__item-stock-count ">
                                    <?php 
                                     echo $this->Homemodel->getCurrentStock($val['product_id']);
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
                            data-id="<?php echo $val['product_id']; ?>" href=""
                            class="product-list__item-buttons-block-btn btn6 edit-btn product-list__item-buttons-block-edit-btn edit_product"><img
                                class="product-list__item-button-img"
                                src="<?php echo base_url(); ?>assets/admin/images/edit-dish-icon.svg" alt="add stock"
                                width="23" height="22">Edit Product</a>

                        <!-- <a data-bs-toggle="modal" data-id="<?php echo $val['product_id']; ?>"
                            data-bs-target="#delete-product" href=""
                            class="product-list__item-buttons-block-btn btn6 product-list__item-buttons-block-remove-stock-btn remove_product"><img
                                class="product-list__item-button-img"
                                src="<?php echo base_url(); ?>assets/admin/images/remove-stock-icon.svg"
                                alt="remove stock" width="23" height="22">Remove
                            Product</a> -->

                        <?php if ($this->Homemodel->getCurrentStock($val['product_id']) == 0): ?>
                        <a data-bs-toggle="modal" data-id="<?php echo $val['product_id']; ?>" href=""
                            class="product-list__item-buttons-block-btn btn6 product-list__item-buttons-block-remove-stock-btn ">
                            <img class="product-list__item-button-img"
                                src="https://img.icons8.com/external-kmg-design-flat-kmg-design/30/external-Out-of-Stock-supply-chain-kmg-design-flat-kmg-design.png"
                                alt="out-of-stock" alt="remove stock" width="30" height="30">
                            Out of Stock
                        </a>
                        <?php endif; ?>

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
                    <form class="row mt-0 mb-0" id="edit_products" enctype="multipart/form-data" method="post">

                        <input type="hidden" id="hidden_product_id">




                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">category</label>
                                <select class="form-select" name="category_id" id="category_id">
                                    <option value="">Select Category</option>
                                    <?php
                                foreach($categories as $category)
                                {     
                                ?>
                                    <option value="<?=$category['id'];?>"
                                        <?php if(isset($productDet[0]['id']) && ($productDet[0]['id']==$category['id'])) echo 'selected';else echo set_select('id', $category['id'])?>>
                                        <?=$category['category_name'];?>
                                    </option>
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
                                <input class="form-control" value="" type="text" placeholder="Product Name"
                                    name="product_name" id="product_name">
                                <span class="error errormsg mt-2" id="product_edit_name_error"></span>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Height</label>
                                <input class="form-control" value="" type="text" placeholder="8cm" name="product_height"
                                    id="product_height">
                                <span class="error errormsg mt-2" id="product_edit_height_error"></span>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Width</label>
                                <input class="form-control" value="" type="text" placeholder="8cm" name="product_width"
                                    id="product_width">
                                <span class="error errormsg mt-2" id="product_edit_width_error"></span>
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Item Code</label>
                                <input class="form-control" value="" type="text" placeholder="Product Code"
                                    name="product_codee" id="product_codee">
                                <span class="error errormsg mt-2" id="product_edit_code_error"></span>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Shipping </label>
                                <input class="form-control" value="" type="text" placeholder="Product Shipping"
                                    name="product_shippingg" id="product_shippingg">
                                <span class="error errormsg mt-2" id="product_edit_shipping_error"></span>
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input"> Erp Product Name</label>
                                <input class="form-control" value="" type="text" placeholder="Erp Product Name"
                                    name="erp_product_name" id="erp_product_name">
                                <span class="error errormsg mt-2" id="erp_product_name_error"></span>
                            </div>
                        </div>







                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input"> Price (L.C) (INR) </label>
                                <input class="form-control" value="" type="text" placeholder="Price" name="price"
                                    id="price">
                                <span class="error errormsg mt-2" id="price_edit_error"></span>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input"> Wholesale price (INR)</label>
                                <input class="form-control" value="" type="text" placeholder="Wholesale price"
                                    name="product_wholesale_price" id="product_wholesale_price">
                                <span class="error errormsg mt-2" id="product_wholesale_price_edit_error"></span>
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input"> Retail price (INR) </label>
                                <input class="form-control" value="" type="text" placeholder="Retail price"
                                    name="product_retail_price" id="product_retail_price">
                                <span class="error errormsg mt-2" id="product_retail_price_edit_error"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input"> Franchise price (INR) </label>
                                <input class="form-control" value="" type="text" placeholder="Franchise Price"
                                    name="product_franchise_price" id="product_franchise_price">
                                <span class="error errormsg mt-2" id="product_franchise_price_edit_error"></span>
                            </div>
                        </div>


                        <div class="col-md-4 ">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Export Price ($)</label>
                                <input class="form-control" value="" type="text" placeholder="Export Price"
                                    name="product_export_price" id="product_export_price">
                                <span class="error errormsg mt-2" id="product_export_price_edit_error"></span>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input"> weight </label>
                                <input class="form-control" value="" type="text" placeholder="Weight"
                                    name="product_weight" id="product_weight">
                                <span class="error errormsg mt-2" id="product_weight_edit_error"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input"> Units </label>
                                <select name="product_weight_type" id="product_weight_type" class="form-select">
                                    <option value="kg" <?= set_select('units', 'kg') ?>>kg</option>
                                    <!-- <option value="g" <?= set_select('units', 'g') ?>>g</option> -->
                                </select>
                                <span class="error errormsg mt-2" id="product_weight_type_edit_error"></span>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input"> Current Stock Quantity</label>
                                <input class="form-control" value="" type="text" readonly placeholder=""
                                    name="product_stock" id="product_stock">
                                <span class="error errormsg mt-2" id="product_stock_error"></span>
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Enter Stock Quanity</label>
                                <input class="form-control" value="" type="text" placeholder="Enter Stock Quanity"
                                    name="update_product_stock" id="update_product_stock">
                                <span class="error errormsg mt-2" id="update_product_stock_edit_error"></span>
                            </div>
                        </div>



                        <div class="col-md-3">
                            <div class="mt-3">
                                <label class="form-label" for="default-input">Home</label>
                                <input value="" type="checkbox" id="is_home_edit">
                                <input value="" type="hidden" name="is_home_edit_hidden" id="is_home_edit_hidden"
                                    value="0">

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mt-3">
                                <label class="form-label" for="default-input">Bestseller</label>
                                <input value="" type="checkbox" id="is_bestseller_edit">
                                <input value="" type="hidden" name="is_bestseller_edit_hidden"
                                    id="is_bestseller_edit_hidden" value="0">

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mt-3">
                                <label class="form-label" for="default-input">Seasonal offer</label>
                                <input value="" type="checkbox" id="is_seasonaloffer_edit">
                                <input value="" type="hidden" name="is_seasonaloffer_edit_hidden"
                                    id="is_seasonaloffer_edit_hidden" value="0">

                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="mt-3">
                                <label class="form-label" for="default-input">Out of Stock</label>
                                <input value="" type="checkbox" id="out_of_stock_edit">
                                <input value="" type="hidden" name="out_of_stock_edit_hidden"
                                    id="out_of_stock_edit_hidden" value="0">

                            </div>
                        </div>


                        <div class="col-md-3 seasonal-percent d-none">
                            <label class="form-label">Discount (%)</label>
                            <input type="text" class="form-control" name="seasonal_percentage" id="seasonal_percentage"
                                value="" placeholder="Seasonal Percentage">
                            <span id="seasonal_percentage_error" class="error errormsg mt-2"></span>
                        </div>




                        <div class="col-md-12">
                            <div class="mb-2">
                                <label class="form-label" for="default-input"> Description </label>
                                <textarea style="height: 15px;" class="form-control summernote" value="" type="text"
                                    placeholder="English" name="product_description"
                                    id="product_description"></textarea>
                                <span class="error errormsg mt-2" id="product_description_edit_error"></span>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="image-item">
                                <p class="product-list__item-name fw-bold">Thumbnail Image</p>
                                <img id="previewImage" src="" width="100" class="" />
                                <input type="hidden" name="image_id" id="image_id" value="">
                                <input type="file" name="image" class="form-control" />
                                <span id="product_image_error" class="error errormsg mt-2"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="image-item">
                                <p class="product-list__item-name fw-bold">Product Image 1</p>
                                <img id="previewImage1" src="" width="100" class="" />
                                <input type="hidden" name="image_id1" id="image_id1" value="">
                                <input type="file" name="image1" class="form-control" />
                                <span id="product_image1_error" class="error errormsg mt-2"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="image-item">
                                <p class="product-list__item-name fw-bold">Product Image 2</p>
                                <img id="previewImage2" src="" width="100" class="" />
                                <input type="hidden" name="image_id2" id="image_id2" value="">
                                <input type="file" name="image2" class="form-control" />
                                <span id="product_image2_error" class="error errormsg mt-2"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="image-item">
                                <p class="product-list__item-name fw-bold">Product Image 3</p>
                                <img id="previewImage3" src="" width="100" class="" />
                                <input type="hidden" name="image_id3" id="image_id3" value="">
                                <input type="file" name="image3" class="form-control" />
                                <span id="product_image3_error" class="error errormsg mt-2"></span>
                            </div>
                        </div>



                        <div class="col-md-12 mt-2">
                            <div class="justify-content-center" style="float: right;">
                                <button class="btn btn-primary w-md" type="button" id="save_product">Update</button>
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
                <button class="btn btn-secondary" id="yes_product_user" type="button"
                    data-bs-dismiss="modal">Yes</button>
            </div>

            </form>
        </div>
    </div>
</div>
<!-- delete user -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.getElementById('excel_file').addEventListener('change', function() {
    if (this.files.length > 0) {
        let form = document.getElementById('excelForm');
        let formData = new FormData(form);
        fetch("<?= base_url('admin/Excel/import') ?>", {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                $('.modal-body').text(data.message);
                // Bootstrap 5 way to show modal
                let myModal = new bootstrap.Modal(document.getElementById('successModal'));
                myModal.show();
            })
            .catch(err => {
                alert('error')
            });
    }
});
</script>