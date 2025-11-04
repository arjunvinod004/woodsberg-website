<div class="application-content dashboard-content">
    <div class="application-content__container container">
        <h1 class="application-content__page-heading">Combo Products</h1>

        <div class="add-new-combo-only">
            <a href="<?php echo base_url('owner/product/add_combo'); ?>" class="add-new-dish-btn btn1">
                <img src="<?php echo base_url(); ?>assets/admin/images/add-new-dish-icon.svg" alt="add new dish"
                    class="add-new-dish__icon" width="23" height="23">
                Add New Combo
            </a>
        </div>
        <div class="product-list" id="search_result_container">

            <?php
               if(!empty($products)){
               $count = 1;
               foreach($products as $val){ 
                        $stock = $this->Ordermodel->getCurrentStock($val['store_product_id'], $date, $this->session->userdata('logged_in_store_id'));
 ?>
            <div class="product-list__item">
                <div class="product-list__item-image-and-details">
                    <?php
                        $path = ($val['image'] != '') ? site_url() . "uploads/product/" . $val['image'] : site_url() . "uploads/product/" . $val['product_image'];
                    ?>
                    <img src="<?php echo $path; ?>" alt="chapathi" class="product-list__item-img" width="190"
                        height="150">
                    <div class="product-list__item-details">
                        <h3 class="product-list__item-name">
                            <?php echo ($val['store_product_name_en'] != '') ? $val['store_product_name_en'] : $val['product_name_en']; ?>
                        </h3>
                        <p class="product-list__item-price">
                            ₹<?php echo $val['rate'];?></p>



                        <?php 
                        $status = ($val['is_active'] == 0 && $val['availability'] == 0) ? 'available' : 'unavailable';
                        ?>
                        <p class="product-list__item-status-<?php echo $status; ?> text-capitalize">
                            <?php echo $status; ?>
                        </p>

                        <div class="product-list__item-details-availability-stock">
                            <select width="50%" class="change_availability"
                                data-id="<?php echo $val['store_product_id']; ?>" class="form-select mb-2">

                                <option value="0" <?php echo ($val['availability'] == 0) ? 'selected' : ''; ?>>Active
                                </option>
                                <option value="1" <?php echo ($val['availability'] == 1) ? 'selected' : ''; ?>>
                                    Inactive
                                </option>
                            </select>

                        </div>

                    </div>
                </div>
                <div class="product-list__item-buttons-block">
                    <?php if ($this->session->userdata('roleid') == 2){ ?>
                    <a data-bs-toggle="modal" data-bs-target="#Edit-dish"
                        data-id="<?php echo $val['store_product_id']; ?>"
                        data-isCustomizable="<?php echo $val['is_customizable']; ?>" href=""
                        class="product-list__item-buttons-block-btn btn6 edit-btn"><img
                            class="product-list__item-button-img"
                            src="<?php echo base_url(); ?>assets/admin/images/edit-dish-icon.svg" alt="add stock"
                            width="23" height="22">Edit Combo</a>
                    <?php } ?>
                </div>
            </div>
            <?php $count++; }}  ?>



        </div>
    </div>

</div>








<!-- Change Dish Informations -->

<!-- Change Description -->
<div class="emigo-modal modal fade" id="Edit-dish" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="emigo-modal__heading" id="exampleModalLabel">Product Details</h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- if response within jquery -->
                <div class="message d-none" role="alert"></div>
                <!-- if response within jquery -->

                <input type="hidden" id="hiddenField" name="product_id" value="">
                <input type="hidden" id="isCustomizable" value="">
                <div class="container">
                    <div class="row mb-5 justify-content-center emigo-modal__header-button-group">
                        <a class="productDetails btn1">Product</a>
                        <a class="listCombo btn2">Combo Items</a>
                        <a class="addPhotos btn3">Photos</a>
                    </div>
                </div>
                <div class="row">
                    <iframe id="iframe_body" height="700px" width="100%">rwerwerwer</iframe>
                    <form class="product-details-form" id="productForm" method="post" enctype="multipart/form-data">
                        <div class="product-details-form__section">
                            <div class="product-details-form__item">
                                <input type="hidden" id="product_id_new" name="product_id">
                                <label class="col-form-label">Rate</label>
                                <input type="text" class="form-control" id="store_product_rate"
                                    name="store_product_rate" value="">
                            </div>
                            <div class="product-details-form__item">
                                <label class="col-form-label">Name (Malayalam)</label>
                                <input type="text" class="form-control" id="store_product_name_ma"
                                    name="store_product_name_ma" value="">
                            </div>
                            <div class="product-details-form__item">
                                <label class="col-form-label">Name (English)</label>
                                <input type="text" class="form-control" id="store_product_name_en"
                                    name="store_product_name_en" value="">
                            </div>
                            <div class="product-details-form__item">
                                <label class="col-form-label">Name (Hindi)</label>
                                <input type="text" class="form-control" id="store_product_name_hi"
                                    name="store_product_name_hi" value="">
                            </div>
                            <div class="product-details-form__item">
                                <label class="col-form-label">Name (Arabic)</label>
                                <input type="text" class="form-control" id="store_product_name_ar"
                                    name="store_product_name_ar" value="">
                            </div>
                        </div>

                        <div class="product-details-form__section">
                            <div class="product-details-form__item">
                                <label class="col-form-label">Description (Malayalam)</label>
                                <textarea class="form-control" name="description_malayalam" id="description_malayalam"
                                    placeholder="Malayalam"></textarea>
                                <span class="error errormsg mt-2" id="description_malayalam_error"></span>
                            </div>
                            <div class="product-details-form__item">
                                <label class="col-form-label">Description (English)</label>
                                <textarea class="form-control" name="description_english" id="description_english"
                                    placeholder="English"></textarea>
                                <span class="error errormsg mt-2" id="description_english_error"></span>
                            </div>
                            <div class="product-details-form__item">
                                <label class="col-form-label">Description (Hindi)</label>
                                <textarea class="form-control" name="description_hindi" placeholder="hindi"
                                    id="description_hindi"></textarea>
                                <span class="error errormsg mt-2" id="description_hindi_error"></span>
                            </div>
                            <div class="product-details-form__item">
                                <label class="col-form-label">Description (Arabic)</label>
                                <textarea class="form-control" name="description_arabic" id="description_arabic"
                                    placeholder="arabic"></textarea>
                                <span class="error errormsg mt-2" id="description_arabic_error"></span>
                            </div>
                        </div>



                        <div class="mt-2 text-center m-auto">
                            <button class="btn btn-primary " type="button" id="saveProduct">UPDATE PRODUCT</button>
                        </div>
                </div>




                </form>

            </div>
        </div>
    </div>
</div>
<!-- end -->






<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <!-- Success message placeholder -->
                <div id="successMessage" class="alert alert-success" style="display: none;">

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="emigo-modal__heading" id="exampleModalLabel">Change Status</h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to change the status of this product?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancelStatusChange"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmStatusChange">Confirm</button>
            </div>
        </div>
    </div>
</div>
<!-- Confirmation Modal -->