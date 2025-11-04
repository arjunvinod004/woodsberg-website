<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="">
    <div class="page-content p-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="add-new-dish-list-combo mb-3">
                        <a data-bs-toggle="modal" data-bs-original-title="Add Country" data-bs-target="#add-testimonial"
                            class="add-new-dish-btn btn1">
                            <img src="<?php echo base_url('assets/admin/images/add-new-dish-icon.svg'); ?>
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                            Add Testimonial
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
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead style="background: #e5e5e5;">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <!-- <th>Image</th> -->
                                    <th>Position</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                       if(!empty($testimonial)){
                       $count = 1;
                       foreach($testimonial as $val){ ?>
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $val['name'];?></td>
                                    <td>
                                        <?php echo $val['position'];?>
                                    </td>

                                    <td class="pb-0 pt-0 d-flex">
                                        <input type="hidden" name="id" value="<?php echo $val['id']; ?>">
                                        <button class="btn tblEditBtn edit_testimonial pl-0 pr-0" type="submit"
                                            data-bs-toggle="modal" data-id="<?php echo $val['id']; ?>"
                                            data-bs-original-title="Edit Category" data-bs-target="#edit-testimonial"><i
                                                class="fa fa-edit"></i></button>
                                        <a class="btn tblDelBtn pl-0 pr-0 del_testimonial" type="button"
                                            data-bs-toggle="modal" data-id="<?php echo $val['id']; ?>"
                                            data-bs-original-title="Delete Category"
                                            data-bs-target="#delete-testimonial"><i class="fa fa-trash"></i></a>

                                    </td>
                                </tr>
                                <?php $count++; }} ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal for detailed view -->
            <div class="modal fade" id="emp_informations" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Employee Details</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <iframe src="emp-informations.html" style="width: 100%; height: 500px;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end -->

            <!-- add category -->

            <div class="modal fade" id="add-testimonial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="exampleModalLabel">Add Testimonial</h2>
                            <button class="emigo-close-btn" type="button" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row bg-soft-light mb-3 border1 pt-2">
                                <form class="row mt-0 mb-0" id="addTestimonial" enctype="multipart/form-data"
                                    method="post">

                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">name</label>
                                            <input type="text" class="form-control" name="testimonial_name" value=""
                                                placeholder="name">
                                            <span class="error errormsg mt-2" id="testimonial_name_error"></span>
                                            <div id="general_error" class="error errormsg"></div>
                                        </div>
                                    </div>







                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">Position </label>
                                            <input class="form-control" value="" type="text" placeholder="Position"
                                                name="testimonial_position">
                                            <span class="error errormsg mt-2" id="testimonial_position_error"></span>
                                        </div>
                                    </div>




                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">Description</label>
                                            <textarea name="testimonial_desc" style="height: 15px;" class="form-control"
                                                placeholder="Description" rows=""></textarea>
                                            <span class="error errormsg mt-2" id="testimonial_desc_error"></span>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">photo</label>
                                            <input type="file" class="form-control" name="testimonial_image">
                                            <span class="error errormsg mt-2" id="testimonial_image_error"></span>
                                        </div>
                                    </div>



                                    <div class="col-md-12">
                                        <div class="justify-content-center" style="float: right;">
                                            <button class="btn btn-primary w-md" type="button"
                                                id="add_testimonial">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>



        </div>

        <!-- add category -->
        <!-- <input type="text" id="hidden_category_id" > -->

        <!-- edit category -->
        <div class="modal fade" id="edit-testimonial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">edit testimonial</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row bg-soft-light mb-3 border1 pt-2">
                            <form class="row mt-0 mb-0" id="edit_testimonial" enctype="multipart/form-data"
                                method="post">

                                <input type="hidden" id="hidden_testimonial_id">


                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input">name</label>
                                        <input type="text" class="form-control" name="testimonial_name"
                                            id="testimonial_name" value="" placeholder="Order">
                                        <span class="error errormsg mt-2" id="testimonial_name_edit_error"></span>
                                        <div id="general_error" class="error errormsg"></div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input">Position</label>
                                        <input class="form-control" value="" type="text" placeholder="English"
                                            name="testimonial_position" id="testimonial_position">
                                        <span class="error errormsg mt-2" id="testimonial_position_edit_error"></span>
                                    </div>
                                </div>




                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input"> Description </label>
                                        <textarea style="height: 15px;" name="testimonial_desc" class="form-control"
                                            id="testimonial_desc" placeholder="English" rows=""></textarea>
                                        <span class="error errormsg mt-2" id="testimonial_desc_edit_error"></span>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input">photo</label>
                                        <input type="hidden" value="" class="form-control"
                                            name="testimonial_image_existing" id="testimonial_image_existing">
                                        <input type="file" value="" class="form-control" name="testimonial_image"
                                            id="testimonial_image">
                                        <img id="preview_imgg" src="" alt="Preview" style="max-width: 150px;">

                                        <span class="error errormsg mt-2" id="testimonial_image_edit_error"></span>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="justify-content-center" style="float: right;">
                                        <button class="btn btn-primary w-md" type="button"
                                            id="save_testimonial">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>



    </div>

    <!-- edit country -->



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
                    <button type="button" class="btn btn-secondary reload-close-btn"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- success modal -->


    <!-- delete testimonials -->
    <div class="modal fade " id="delete-testimonial" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                    <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- if response within jquery -->
                    <div class="message d-none" role="alert"></div>
                    <input type="hidden" name="id" id="delete_testimonial_id" value="" />
                    <?php echo are_you_sure; ?>
                </div>
                <div class="modal-footer"><button class="btn btn-primary" type="button"
                        data-bs-dismiss="modal">No</button>
                    <button class="btn btn-secondary" id="yes_delete_testimonial" type="button"
                        data-bs-dismiss="modal">Yes</button>
                </div>

                </form>
            </div>
        </div>
    </div>
    <!-- delete user -->










</div>