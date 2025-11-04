<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="">
    <div class="page-content p-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="add-new-dish-list-combo mb-3">
                        <a data-bs-toggle="modal" data-bs-original-title="Add Country" data-bs-target="#add-retailer"
                            class="add-new-dish-btn btn1">
                            <img src="<?php echo base_url('assets/admin/images/add-new-dish-icon.svg'); ?>
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                            Add Dealer
                        </a>
                        <a href="<?php echo base_url('admin/settings'); ?>" class="add-new-dish-btn btn1">
                            <img src="https://img.icons8.com/ios-filled/30/FFFFFF/circled-left-2.png
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                            Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">


                <div class="">
                    <div class="table-responsive-sm">
                        <table id="example" class="table table-striped " style="width:100%">
                            <thead style="background: #e5e5e5;">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Date</th>
                                    <th>Phone Number</th>
                                    <th>Username</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                       if(!empty($dealer)){
                       $count = 1;
                       foreach($dealer as $val)
                    { ?>
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $val['name'];?></td>
                                    <td><?php echo $val['address'];?></td>
                                    <td><?php echo $val['created_date'];?></td>
                                    <td><?php echo $val['phone_number'];?></td>
                                    <td><?php echo $val['username'];?></td>

                                    <td class="pb-0 pt-0 d-flex">
                                        <input type="hidden" name="id" value="<?php echo $val['id']; ?>">
                                        <!-- <button class="btn tblEditBtn edit_category pl-0 pr-0" type="submit"
                                            data-bs-toggle="modal" data-id="<?php echo $val['id']; ?>"
                                            data-bs-original-title="Edit Category" data-bs-target="#edit-category"><i
                                                class="fa fa-edit"></i></button> -->
                                        <a class="btn tblDelBtn pl-0 pr-0 del_dealer" type="button"
                                            data-bs-toggle="modal" data-id="<?php echo $val['id']; ?>"
                                            data-bs-original-title="Delete Category" data-bs-target="#delete-dealer"><i
                                                class="fa fa-trash"></i></a>

                                    </td>
                                </tr>
                                <?php $count++;
                     }} ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- add dealer -->

            <div class="modal fade" id="add-retailer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="exampleModalLabel">Add Dealer</h2>
                            <button class="emigo-close-btn" type="button" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row bg-soft-light mb-3 border1 pt-2">
                                <form class="row mt-0 mb-0" id="adddealer" enctype="multipart/form-data" method="post">



                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input"> Company Name</label>
                                            <input class="form-control" value="" type="text" placeholder="Name"
                                                name="dealer_name">
                                            <span class="error errormsg mt-2" id="dealer_name_error"></span>
                                        </div>
                                    </div>




                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">Address</label>
                                            <textarea name="dealer_address" style="height: 15px;" class="form-control"
                                                placeholder="Address" rows=""></textarea>
                                            <span class="error errormsg mt-2" id="dealer_address_error"></span>
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">Email</label>
                                            <input class="form-control" value="" type="text" placeholder="Email"
                                                name="dealer_email">
                                            <span class="error errormsg mt-2" id="dealer_email_error"></span>
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">Phone Number</label>
                                            <input class="form-control" value="" type="text" placeholder="Phone Number"
                                                name="dealer_phone">
                                            <span class="error errormsg mt-2" id="dealer_phone_error"></span>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">Username</label>
                                            <input class="form-control" value="" type="text" placeholder="Username"
                                                name="dealer_username">
                                            <span class="error errormsg mt-2" id="dealer_username_error"></span>
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">Password</label>
                                            <input class="form-control" value="" type="password" placeholder="Password"
                                                name="dealer_password">
                                            <span class="error errormsg mt-2" id="dealer_password_error"></span>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="justify-content-center" style="float: right;">
                                            <button class="btn btn-primary w-md" type="button"
                                                id="add_dealer">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>



        </div>


        <!-- edit category -->
        <div class="modal fade" id="edit-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">edit category</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row bg-soft-light mb-3 border1 pt-2">
                            <form class="row mt-0 mb-0" id="edit_categories" enctype="multipart/form-data"
                                method="post">

                                <input type="hidden" id="hidden_category_id">

                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input">Order</label>
                                        <input type="text" class="form-control" readonly name="category_order"
                                            id="category_order" value="" placeholder="Order">
                                        <span class="error errormsg mt-2" id="category_edit_order_error"></span>
                                        <div id="general_error" class="error errormsg"></div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input">Category Name</label>
                                        <input class="form-control" value="" type="text" placeholder="English"
                                            name="category_name" id="category_name">
                                        <span class="error errormsg mt-2" id="category_edit_name_error"></span>
                                    </div>
                                </div>




                                <div class="col-md-3">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input"> Category Desc </label>
                                        <textarea style="height: 15px;" name="category_desc" class="form-control"
                                            id="category_desc" placeholder="English" rows=""></textarea>
                                        <span class="error errormsg mt-2" id="category_edit_desc_error"></span>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input">photo</label>
                                        <input type="hidden" value="" class="form-control" name="existing_userfile"
                                            id="existing_userfile">
                                        <input type="file" value="" class="form-control" name="userfile" id="userfile">
                                        <img id="preview_img" src="" alt="Preview" style="max-width: 150px;">

                                        <span class="error errormsg mt-2" id="category_edit_userfile_error"></span>
                                    </div>
                                </div>

                        </div>

                        <div class="col-md-12">
                            <div class="justify-content-center" style="float: right;">
                                <button class="btn btn-primary w-md" type="button" id="save_category">Update</button>
                            </div>
                        </div>

                        </form>
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


<!-- delete user -->
<div class="modal fade " id="delete-dealer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- if response within jquery -->
                <div class="message d-none" role="alert"></div>
                <input type="hidden" name="id" id="delete_dealer_id" value="" />
                <?php echo are_you_sure; ?>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                <button class="btn btn-secondary" id="yes_dealer_user" type="button"
                    data-bs-dismiss="modal">Yes</button>
            </div>

            </form>
        </div>
    </div>
</div>
<!-- delete user -->