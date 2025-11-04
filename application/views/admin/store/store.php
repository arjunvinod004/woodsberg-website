<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="container-fluid">
<h1 class="application-content__page-heading mt-3 text-center">Store</h1>
    <div class="page-content p-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="add-new-dish-list-combo">
                        <!-- <a  href="<?php echo base_url('owner/store/addstore'); ?>" class="add-new-dish-btn btn1">
                    <img src="<?php echo base_url('assets/admin/images/add-new-dish-icon.svg'); ?>
" alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                    Add Store
                </a> -->

                        <a href="<?php echo base_url('admin/settings'); ?>" class="add-new-dish-btn btn1">
                            <img src="https://img.icons8.com/ios-filled/30/FFFFFF/circled-left-2.png
" alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                            Back
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="product-list" id="search_result_container">

            <?php
            if(!empty($stores)){
                $count = 1;
                foreach($stores as $val){

                  
 ?>
            <div class="product-list__item">
                <div class="product-list__item-image-and-details">
                    <img style="width:200px; background-color:#407866;" src="<?php echo base_url('uploads/store/woodsberg_logo.png'); ?>" alt="chapathi"
                        class="product-list__item-img" width="400" height="100">

                    <div class="product-list__item-details">
                        <h3 class="product-list__item-name">
                            <?php echo ($val['store_disp_name'] != '') ? $val['store_disp_name'] : $val['store_disp_name']; ?>
                        </h3>
                        <p class="product-list__item-price">
                            <?php 
                                echo $val['store_address']            
                            ?></p>




                        <p class="product-list__item-status text-capitalize">
                            <?php echo $val['store_phone']; ?>
                        </p>
                        <div class="product-list__item-details-availability-stock">

                            <div class="product-list__item-stock d-none">
                                <!-- <div class="product-list__item-stock-label">active</div> -->
                                <div class="product-list__item-stock-count d-none">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="product-list__item-buttons-block">
                    <div class="product-list__item-buttons-block-one">

                        <input type="hidden" name="id" value="<?php echo $val['store_id']; ?>">
                        <a class="product-list__item-buttons-block-btn product-list__item-buttons-block-add-new-stock-btn btn6 edit_store"
                            data-id="<?php echo $val['store_id']; ?>" data-bs-toggle="modal"
                            data-bs-target="#edit-store">
                            <img class="product-list__item-button-img"
                                src="<?php echo base_url(); ?>assets/admin/images/edit-dish-icon.svg" alt="add stock"
                                width="23" height="24"> Edit Store
                        </a>




                        <!-- <a href=""
                            class="product-list__item-buttons-block-btn btn6 product-list__item-buttons-block-remove-stock-btn remove-modal"
                            data-bs-toggle="modal" data-id="<?php echo $val['store_id']; ?>"
                            data-bs-target="#removestock"><img class="product-list__item-button-img"
                                src="<?php echo base_url(); ?>assets/admin/images/remove-stock-icon.svg"
                                alt="remove stock" width="23" height="22">Remove Store</a> -->
                    </div>
                    <div class="product-list__item-buttons-block-two">

                        <!-- <a href=""
                            class="product-list__item-buttons-block-btn btn6 product-list__item-buttons-block-next-available-btn qrcode-modal"
                            data-bs-toggle="modal" data-id="<?php echo $val['store_id']; ?>"
                            data-bs-target="#qr-code"><img class="product-list__item-button-img"
                                src="<?php echo base_url(); ?>assets/admin/images/next-available-time-icon.svg"
                                alt="next available button stock" width="23" height="24">Qr Codes</a> -->

                        <!-- <a href=""
                            class="product-list__item-buttons-block-btn btn6 product-list__item-buttons-block-next-available-btn product_assign"
                            data-bs-toggle="modal" data-id="<?php echo $val['store_id']; ?>" data-name="<?php echo $val['store_disp_name']; ?>"
                            data-bs-target="#emp_informations"><img class="product-list__item-button-img"
                                src="<?php echo base_url(); ?>assets/admin/images/next-available-time-icon.svg"
                                alt="next available button stock" width="23" height="24">Product Assign</a> -->





                    </div>



                </div>
            </div>
            <?php $count++; } } ?>



        </div>

        <!-- <div class="row">
                <div class="">
                    <div class="table-responsive-sm">

                        <table id="example" class="table table-striped" style="width:100%">
                            <thead style="background: #e5e5e5;">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                       if(!empty($stores)){
                       $count = 1;
                       foreach($stores as $val){ ?>
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $val['store_name'];?></td>
                                    <td><?php echo $val['store_email'];?></td>
                                    <td><?php echo $val['store_phone'];?></td>
                                    <td><?php if($val['is_active'] == 1){ ?> <span class="badge-success">Active</span>
                                        <?php } else { ?> <span class="badge-danger">Inactive</span> <?php }?></td>
                                    <td class="pb-0 pt-0 d-flex">
                                      
                                            <input type="hidden" name="id" value="<?php echo $val['store_id']; ?>">
                                            <button class="btn tblEditBtn edit_store pl-0 pr-0" 
                                                data-bs-toggle="tooltip" data-id="<?php echo $val['store_id']; ?>"
                                                data-bs-original-title="Edit Store" data-bs-target="#edit-store"><i class="fa fa-edit"></i></button>
                                       

                                        <a class="btn tblDelBtn pl-0 pr-0 del_store" type="button"
                                            data-bs-toggle="modal" data-id="<?php echo $val['store_id']; ?>"
                                            data-bs-original-title="Delete Store" data-bs-target="#exampleModal"><i
                                                class="fa fa-trash"></i></a>


                                        <a class="product_assign btn btn-primary"
                                            data-id="<?php echo $val['store_id']; ?>"
                                            data-name="<?php echo $val['store_name']; ?>" data-bs-toggle="modal"
                                            data-bs-target="#emp_informations" class="btn tblLogBtn pl-0 pr-0"
                                            type="button" class="btn btn-secondary" data-toggle="tooltip"
                                            data-placement="top" title="Storewise Product Assign">
                                            Product Assign
                                        </a>
                                    </td>
                                </tr>
                                <?php $count++; }} ?>
                            </tbody>  
                        </table>
                    </div>
                </div>
            </div> -->



        <!-- Modal for detailed product assign -->
        <div class="modal fade" id="emp_informations" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modal_title_table"></h1>
                        <button type="button" class="emigo-close-btn" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <iframe id="table_iframe_product_assign" height="750px" width="100%"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <!-- end -->





        <!-- edit store -->
        <div class="modal fade" id="edit-store" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Edit Store</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row bg-soft-light mb-3 border1 pt-2">
                            <form class="row mt-0 mb-0" id="edit_new_store" enctype="multipart/form-data" method="post">

                                <input type="hidden" id="hidden_store_id">


                                <div class="col-md-4">

                                    <div class="mb-2">
                                        <label class="form-label" for="default-input"> Display Name</label>
                                        <input class="form-control" value="" type="text" placeholder="English"
                                            name="store_disp_name" id="store_disp_name">
                                        <span class="error errormsg mt-2" id="store_edit_disp_name_error"></span>
                                    </div>
                                </div>






                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input"> Store Name</label>
                                        <input class="form-control" value="" type="text" placeholder="English"
                                            name="store_name" id="store_name">
                                        <span class="error errormsg mt-2" id="store_edit_name_error"></span>
                                    </div>
                                </div>




                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input"> Description </label>
                                        <input class="form-control" value="" type="text" placeholder="English"
                                            name="store_desc" id="store_desc">
                                        <span class="error errormsg mt-2" id="store_edit_desc_error"></span>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input"> Address </label>
                                        <input class="form-control" value="" type="text" placeholder="English"
                                            name="store_address" id="store_address">
                                        <span class="error errormsg mt-2" id="store_edit_address_error"></span>
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input"> Email </label>
                                        <input class="form-control" value="" type="text" placeholder="English"
                                            name="store_email" id="store_email">
                                        <span class="error errormsg mt-2" id="store_edit_email_error"></span>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input"> Phoneno </label>
                                        <input class="form-control" value="" type="text" placeholder="English"
                                            name="store_phoneno" id="store_phoneno">
                                        <span class="error errormsg mt-2" id="store_edit_phoneno_error"></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input"> Opening Time </label>
                                        <input class="form-control" value="" type="time" placeholder="English"
                                            name="store_opening_time" id="store_opening_time">
                                        <span class="error errormsg mt-2" id="store_edit_opening_time_error"></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input"> Closing Time </label>
                                        <input class="form-control" value="" type="time" placeholder="English"
                                            name="store_closing_time" id="store_closing_time">
                                        <span class="error errormsg mt-2" id="store_edit_closing_time_error"></span>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input"> Country </label>
                                        <select name="store_country" id="store_country" class="form-control">
                                            <option value="">Select Country</option>
                                            <option value="27" <?= set_select('role', '27') ?>>India</option>
                                            <option value="28" <?= set_select('role', '28') ?>>Usa</option>
                                            <option value="29" <?= set_select('role', '29') ?>>Uk</option>
                                            <option value="30" <?= set_select('role', '30') ?>>Canada</option>

                                        </select>
                                        <span class="error errormsg mt-2" id="store_edit_country_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-5 ">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input"> Gst or Tax </label>
                                        <input class="form-control" value="" type="text" placeholder="English"
                                            name="store_gst_tax" id="store_gst_tax">

                                        <span class="error errormsg mt-2" id="store_edit_gst_tax_error"></span>
                                    </div>
                                </div>


                                <div class="col-md-5 d-none">
                                    <div class="image-item">
                                        <img id="storeimage" src="" width="100" class="" />
                                        <input type="hidden" name="store_logo_image" id="store_logo_image" value="">
                                        <input type="file" name="store_logo" class="form-control" />
                                        <span id="store_logo_error" class="error errormsg mt-2"></span>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-2">
                                    <div class="justify-content-center" style="float: right;">
                                        <button class="btn btn-primary w-md" type="button"
                                            id="update_store">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>



    </div>

    <!-- edit store -->








    <!--modal for delete confirmation-->
    <div class="modal fade" id="removestock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel"><?php echo confirm; ?></h1>
                    <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="store_id" value="" />
                    <?php echo are_you_sure; ?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                    <button class="btn btn-secondary" id="yes_del_store" type="button"
                        data-bs-dismiss="modal">Yes</button>
                </div>
            </div>
        </div>
    </div>



    <!--modal for delete confirmation-->



    <!-- qr code -->
    <div class="modal fade" id="qr-code" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">qr codes</h2>
                    <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row  pt-2">
                        <!-- <form class="row mt-0 mb-0" id="edit_save_country" method="post" enctype="multipart/form-data"> -->
                        <input type="hidden" id="qr_code_id">
                        <iframe id="table_iframe" height="600px" width="100%">



                        </iframe>




                        <!-- </form> -->
                    </div>
                </div>

            </div>
        </div>
    </div>



</div>
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