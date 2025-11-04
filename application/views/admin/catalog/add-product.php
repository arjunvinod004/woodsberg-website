<style>

</style>
<div class="application-content add-new-dish">
    <div class="application-content__container container add-new-dish__container">
        <a href="<?php echo base_url('admin/product'); ?>" class="add-new-dish-btn btn1 mb-3">
            <img src="https://img.icons8.com/ios-filled/30/FFFFFF/circled-left-2.png
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
            Back
        </a>
        <h1 class="application-content__page-heading">Add New Product</h1>
        <div class="add-new-dish-form">



            <form id="add-new-product" method="post" enctype="multipart/form-data" class="add-new-dish-form__body">

                <div class="add-new-dish-form__section-container">
                    <div class="add-new-dish-form__section ">
                        <h2 class="add-new-dish-form__section-heading">Product Details </h2>
                        <div class="form__field-container-group gc">

                            <div class="form__field-container xs12 lg4 d-none ">
                                <label class="form__label">Select Product</label>
                                <select class="form__input-select select_product " name="select_product">
                                    <option value="0">Default Product</option>
                                    <option value="1">Export Product</option>
                                </select>
                                <div class="form__validation">
                                    <span id="select_product_error" class="error errormsg mt-2"></span>
                                </div>
                            </div>

                            <div class="form__field-container xs12 lg4">
                                <label class="form__label">Category</label>
                                <select class="form__input-select" name="category_id" id="category">
                                    <option value="">Select Category</option>
                                    <?php
                          foreach($categories as $category)
                          {
                          ?>
                                    <option value="<?=$category['id'];?>"
                                        <?php echo set_select('id', $category['id'])?>>
                                        <?=$category['category_name'];?></option>
                                    <?php
                          }
                          ?>
                                </select>
                                <div class="form__validation">
                                    <span id="category_id_error" class="error errormsg mt-2"></span>
                                </div>
                            </div>


                            <div class="form__field-container xs12 lg4 textbox d-none">
                                <label class="form__label">SubCategory</label>
                                <select class="form__input-select subcategory_id " name="subcategory_id">
                                    <!-- <option value="0">Select Subcategory</option> -->
                                </select>
                                <div class="form__validation">
                                    <span id="subcategory_id_error" class="error errormsg mt-2"></span>
                                </div>
                            </div>


                            <div class="form__field-container xs12 lg4">
                                <label class="form__label">Item Code</label>
                                <input type="text" class="form__input-text" value="" name="product_code"
                                    style="width:100%;">
                                <span id="product_code_error" class="error errormsg mt-2"></span>
                            </div>

                            <div class="form__field-container xs12 lg4">
                                <label class="form__label">Product Name</label>
                                <input type="text" class="form__input-text" value="" name="product_name"
                                    style="width:100%;">
                                <span id="product_name_error" class="error errormsg mt-2"></span>
                            </div>


                            <div class="form__field-container xs12 lg4">
                                <label class="form__label">Height</label>
                                <input type="text" class="form__input-text" value="" name="product_height"
                                    placeholder="8cm" style="width:100%;">
                                <span id="product_height_error" class="error errormsg mt-2"></span>
                            </div>



                            <div class="form__field-container xs12 lg4">
                                <label class="form__label">Width</label>
                                <input type="text" class="form__input-text" value="" name="product_width"
                                    placeholder="8cm" style="width:100%;">
                                <span id="product_width_error" class="error errormsg mt-2"></span>
                            </div>




                            <div class="form__field-container xs12 lg4">
                                <label class="form__label"> Erp Product Name</label>
                                <input type="text" class="form__input-text " value="" name="erp_product_name"
                                    placeholder="Search for a product" id="myInput" style="width:100%;">
                                <input type="hidden" id="staffId" name="staffId">

                                <div id="staff-list" class="dropdown-contents"></div>

                                <span id="erp_product_name_error" class="error errormsg mt-2"></span>
                            </div>




                            <div class="form__field-container xs12 lg4">
                                <label class="form__label">Price (L.C)</label>
                                <input type="text" class="form__input-text" value="" name="product_price"
                                    style="width:100%;">


                                <span id="product_price_error" class="error errormsg mt-2"></span>
                            </div>






                            <div class="form__field-container xs12 lg4">
                                <label class="form__label">Retail Price (Website) (INR)</label>
                                <input type="text" class="form__input-text" value="" name="product_retail_price"
                                    id="product_retail_price" style="width:100%;">

                                <span id="product_retail_price_error" class="error errormsg mt-2"></span>
                            </div>



                            <div class="form__field-container xs12 lg4">
                                <label class="form__label">Wholesale Price (INR)</label>
                                <input type="text" class="form__input-text" value="" name="product_wholesale_price"
                                    id="product_wholesale_price" style=" width:100%;">


                                <span id="product_wholesale_price_error" class="error errormsg mt-2"></span>
                            </div>





                            <div class="form__field-container xs12 lg4">
                                <label class="form__label">Franchise Price (INR)</label>
                                <input type="text" class="form__input-text" value="" name="product_franchise_price"
                                    style="width:100%;">


                                <span id="product_franchise_price_error" class="error errormsg mt-2"></span>
                            </div>


                            <div class="form__field-container xs12 lg4 ">
                                <label class="form__label">Export Price ($) </label>
                                <input type="text" class="form__input-text" value="" name="product_export_price"
                                    style="width:100%;">


                                <span id="product_export_price_error" class="error errormsg mt-2"></span>
                            </div>


                            <div class="form__field-container xs12 lg5">
                                <label class="form__label">Weight</label>
                                <input type="text" class="form__input-text" readonly value="1" name="product_weight"
                                    style="width:100%;">
                                <span id="product_weight_error" class="error errormsg mt-2"></span>
                            </div>

                            <div class="form__field-container xs12 lg4">
                                <div class="mb-2">
                                    <label class="form__label" for="default-input">Units</label>
                                    <select name="product_weight_type" class="form__input-select">
                                        <option value="">select</option>
                                        <option selected value="Kg" <?= set_select('units', 'kg') ?>>kg</option>
                                        <!-- <option value="g" <?= set_select('units', 'g') ?>>g</option> -->
                                    </select>
                                    <span class="error errormsg mt-2" id="product_weight_type_error"></span>
                                </div>
                            </div>


                            <div class="form__field-container xs12 lg3">
                                <label class="form__label">Stock Quantity</label>
                                <input type="text" class="form__input-text" value="" name="product_stock"
                                    style="width:100%;">
                                <span id="product_stock_error" class="error errormsg mt-2"></span>
                            </div>




                            <div class="form__field-container xs12 lg4">
                                <label class="form__label">Is Home</label>
                                <input type="checkbox" class="form-check-input mt-3" id="is_home_add" value="">
                                <input type="hidden" class="form-check-input" name="is_home_add_hidden"
                                    id="is_home_add_hidden" value="0">

                            </div>

                            <div class="form__field-container xs12 lg3">
                                <label class="form__label"> Is Best Seller</label>
                                <input type="checkbox" class="form-check-input mt-3" id="is_bestseller_add" value="">
                                <input type="hidden" class="form-check-input" name="is_bestseller_add_hidden"
                                    id="is_bestseller_add_hidden" value="0">

                            </div>

                            <div class="form__field-container xs12 lg3">
                                <label class="form__label"> Is Seasonal Offer</label>
                                <input type="checkbox" class="form-check-input mt-3" id="is_seasonaloffer_add" value="">
                                <input type="hidden" class="form-check-input" name="is_seasonaloffer_add_hidden"
                                    id="is_seasonaloffer_add_hidden" value="0">

                            </div>

                            <div class="form__field-container xs12 lg2">
                                <label class="form__label">Out of Stock</label>
                                <input type="checkbox" class="form-check-input mt-3" id="out_of_stock" value="">
                                <input type="hidden" class="form-check-input" name="out_of_stock_hidden"
                                    id="out_of_stock_hidden" value="0">

                            </div>

                            <div class="form__field-container xs12 lg3 seasonal-percent d-none">
                                <label class="form__label">Discount (%)</label>
                                <input type="text" class="form-control" name="seasonal_percentage" value=""
                                    placeholder="Seasonal Percentage">
                                <span id="seasonal_percentage_error" class="error errormsg mt-2"></span>
                            </div>


                            <div class="form__field-container xs12 lg12">
                                <label class="form__label fw-bold">Description</label>
                                <textarea type="text" class="form__input-text summernote" value=""
                                    name="product_description" style="width:100%;"></textarea>
                                <span id="product_description_error" class="error errormsg mt-2"></span>
                            </div>






                        </div>




                    </div>


                    <div class="add-new-dish-form__section">
                        <h2 class="add-new-dish-form__section-heading">Product Images</h2>

                        <div id="image-container" class="product-images">


                            <div class="image-item">
                                <p class="product-list__item-name fw-bold">Thumbnail Image</p>
                                <img id="previewImage1" src="" width="100" class=" d-none" />
                                <input type="file" name="image1" class="form-control" />
                                <span id="product_image_error" class="error errormsg mt-2"></span>

                            </div>
                            <div class="image-item">
                                <p class="product-list__item-name fw-bold">Product Image 1</p>
                                <img id="previewImage2" src="" width="100" class=" d-none" />
                                <input type="file" name="image2" class="form-control" />
                                <span id="product_image1_error" class="error errormsg mt-2"></span>
                            </div>
                            <div class="image-item">
                                <p class="product-list__item-name fw-bold">Product Image 2</p>
                                <img id="previewImage3" src="" width="100" class=" d-none" />
                                <input type="file" name="image3" class="form-control" />
                                <span id="product_image2_error" class="error errormsg mt-2"></span>
                            </div>
                            <div class="image-item">
                                <p class="product-list__item-name fw-bold">Product Image 3</p>
                                <img id="previewImage4" src="" width="100" class=" d-none" />
                                <input type="file" name="image4" class="form-control" />
                                <span id="product_image3_error" class="error errormsg mt-2"></span>
                            </div>

                        </div>
                    </div>
                </div>



                <button class="btn btn1 mt-2" type="button" id="add_product">SAVE PRODUCT</button>


        </div>



        </form>
    </div>

</div>
</div>


</div>










</div>
</div>

<!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
fffffffffff
  </div> -->
</div>
</form>



</div>


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

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>
<script>
$(document).on("keyup", "#myInput", function() {
    let brid = $(this).val().trim();
    if (brid === "") {
        $("#staff-list").html(""); // clear list if empty
        return;
    }

    $.ajax({
        url: "<?php echo base_url('admin/api'); ?>",
        type: "POST",
        data: {
            CmpId: 1, // fixed company ID
            Brid: brid // from textbox
        },
        dataType: "json",
        success: function(response) {
            let html = "<ul class='staff-dropdown'>";
            if (response.length > 0) {
                $.each(response, function(i, staff) {
                    html += `<li class="staff-item" data-id="${staff.ID}" data-name="${staff.NAME}">
                                ${staff.NAME} 
                             </li>`;
                });
            } else {
                html += "<li>No staff found</li>";
            }
            html += "</ul>";

            $("#staff-list").html(html);
        },
        error: function(xhr, status, error) {
            console.log("AJAX Error:", error);
        }
    });
});

// ✅ When user clicks staff item
$(document).on("click", ".staff-item", function() {
    let staffId = $(this).data("id");
    let staffName = $(this).data("name");
    $("#myInput").val(staffName);
    $("#staffId").val(staffId);
    $("#staff-list").html("");
});


$(document).on("keyup", "#product_retail_price", function() {
    let price = parseFloat($(this).val()) || 0;
    let wholesale_price = (price + (price * -0.40)).toFixed(2);
    $("#product_wholesale_price").val(wholesale_price);
});
</script>



</html>