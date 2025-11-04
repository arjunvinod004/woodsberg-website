<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="">
    <div class="page-content p-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="add-new-dish-list-combo mb-3" style="display: flex; align-items: center; gap: 10px;">
                        <a data-bs-toggle="modal" data-bs-original-title="Add Country" data-bs-target="#add-category"
                            class="add-new-dish-btn btn1">
                            <img src="<?php echo base_url('assets/admin/images/add-new-dish-icon.svg'); ?>
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                            Add Categories
                        </a>
                        <a href="<?php echo base_url('admin/settings'); ?>" class="add-new-dish-btn btn1">
                            <img src="https://img.icons8.com/ios-filled/30/FFFFFF/circled-left-2.png
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                            Back
                        </a>

                        <!-- <form method="post" action="<?php echo base_url('admin/Excel/importcategory'); ?>"
                            enctype="multipart/form-data" id="categoryexcelForm">
                            <div>

                               
                                <label for="category_excel_file" class="add-new-dish-btn btn1 m-0" style="cursor: pointer;
    display: flex;
    align-items: center;
    gap: 5px;">
                                    <img src="https://img.icons8.com/color/48/microsoft-excel-2019--v1.png"
                                        alt="Excel icon" width="33" height="23">
                                    Upload
                                </label>

                                
                                <input type="file" id="category_excel_file" name="category_excel_file"
                                    accept=".xls,.xlsx,.csv" style="display: none;" required="">
                            </div>
                        </form> -->

                    </div>
                </div>
            </div>
            <div class="row">

                <?php if($this->session->flashdata('success')){ ?>
                <div class="alert alert-success dark" role="alert">
                    <?php echo $this->session->flashdata('success');$this->session->unset_userdata('success'); ?>
                </div><?php } ?>

                <?php if($this->session->flashdata('error')){ ?>
                <div class="alert alert-danger dark" role="alert">
                    <?php echo $this->session->flashdata('error');$this->session->unset_userdata('error'); ?>
                </div><?php } ?>

                <div class="">
                    <div class="table-responsive-sm">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead style="background: #e5e5e5;">
                                <tr>
                                    <th>No</th>
                                    <th>Category Name</th>
                                    <!-- <th>Image</th> -->
                                    <th>Order</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                       if(!empty($categories)){
                       $count = 1;
                       foreach($categories as $val){ ?>
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $val['category_name'];?></td>
                                    <td>
                                        <input type="text" class="form-control update_category_order" style="width:30%;"
                                            value="<?php echo $val['order_index']; ?>"
                                            data-category-id="<?php echo $val['id']; ?>" />
                                    </td>

                                    <td class="pb-0 pt-0 d-flex">
                                        <input type="hidden" name="id" value="<?php echo $val['id']; ?>">
                                        <button class="btn tblEditBtn edit_category pl-0 pr-0" type="submit"
                                            data-bs-toggle="modal" data-id="<?php echo $val['id']; ?>"
                                            data-bs-original-title="Edit Category" data-bs-target="#edit-category"><i
                                                class="fa fa-edit"></i></button>
                                        <a class="btn tblDelBtn pl-0 pr-0 del_category" type="button"
                                            data-bs-toggle="modal" data-id="<?php echo $val['id']; ?>"
                                            data-bs-original-title="Delete Category"
                                            data-bs-target="#delete-category"><i class="fa fa-trash"></i></a>

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

            <div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="exampleModalLabel">Add Category</h2>
                            <button class="emigo-close-btn" type="button" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row bg-soft-light mb-3 border1 pt-2">
                                <form class="row mt-0 mb-0" id="addCategories" enctype="multipart/form-data"
                                    method="post">

                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">Order</label>
                                            <input type="text" readonly class="form-control" name="category_order"
                                                value="<?php echo $order_index; ?>" placeholder="Order">
                                            <span class="error errormsg mt-2" id="category_order_error"></span>
                                            <div id="general_error" class="error errormsg"></div>
                                        </div>
                                    </div>







                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">Category </label>
                                            <input class="form-control" value="" type="text" placeholder="Category"
                                                name="category_name">
                                            <span class="error errormsg mt-2" id="category_name_error"></span>
                                        </div>
                                    </div>




                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">Description</label>
                                            <textarea name="category_desc" style="height: 15px;" class="form-control"
                                                placeholder="Description" rows=""></textarea>
                                            <span class="error errormsg mt-2" id="category_desc_error"></span>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">photo</label>
                                            <input type="file" class="form-control" name="userfile">
                                            <span class="error errormsg mt-2" id="category_userfile_error"></span>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="mb-2 mt-1">
                                            <label class="form-label" for="default-input">Is Header</label>
                                            <input type="checkbox" class="form-check-input d-block mt-2"
                                                id="is_header_category">
                                            <input type="hidden" name="is_header_category_hidden"
                                                id="is_header_category_hidden" value="0">
                                        </div>

                                    </div>


                                    <div class="col-md-4">
                                        <div class="mb-2 mt-1">
                                            <label class="form-label" for="default-input">Is Footer</label>
                                            <input type="checkbox" class="form-check-input d-block mt-2"
                                                id="is_footer_category">
                                            <input type="hidden" name="is_footer_category_hidden"
                                                id="is_footer_category_hidden" value="0">
                                        </div>

                                    </div>











                                    <div class="col-md-12">
                                        <div class="justify-content-center" style="float: right;">
                                            <button class="btn btn-primary w-md" type="button"
                                                id="add_category">Save</button>
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

                                <div class="col-md-4">
                                    <div class="mb-2 mt-1">
                                        <label class="form-label" for="default-input">Is Header</label>
                                        <input type="checkbox" class="form-check-input d-block mt-2"
                                            id="is_edit_header_category">
                                        <input type="hidden" name="is_edit_header_category_hidden"
                                            id="is_edit_header_category_hidden" value="0">
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="mb-2 mt-1">
                                        <label class="form-label" for="default-input">Is Footer</label>
                                        <input type="checkbox" class="form-check-input d-block mt-2"
                                            id="is_edit_footer_category">
                                        <input type="hidden" name="is_edit_footer_category_hidden"
                                            id="is_edit_footer_category_hidden" value="0">
                                    </div>

                                </div>


                                <div class="col-md-12">
                                    <div class="justify-content-center" style="float: right;">
                                        <button class="btn btn-primary w-md" type="button"
                                            id="save_category">Update</button>
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


    <!-- delete user -->
    <div class="modal fade " id="delete-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                    <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- if response within jquery -->
                    <div class="message d-none" role="alert"></div>
                    <input type="hidden" name="id" id="delete_cat_id" value="" />
                    <?php echo are_you_sure; ?>
                </div>
                <div class="modal-footer"><button class="btn btn-primary" type="button"
                        data-bs-dismiss="modal">No</button>
                    <button class="btn btn-secondary" id="yes_cat_user" type="button"
                        data-bs-dismiss="modal">Yes</button>
                </div>

                </form>
            </div>
        </div>
    </div>
    <!-- delete user -->


</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.getElementById('category_excel_file').addEventListener('change', function() {
    if (this.files.length > 0) {
        let form = document.getElementById('categoryexcelForm');
        let formData = new FormData(form);
        fetch("<?= base_url('admin/Excel/importcategory') ?>", {
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