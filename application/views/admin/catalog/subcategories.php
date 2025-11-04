<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="">
    <div class="page-content p-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="add-new-dish-list-combo mb-3" style="display: flex; align-items: center; gap: 10px;">
                        <a data-bs-toggle="modal" data-bs-original-title="Add Country" data-bs-target="#add-subcategory"
                            class="add-new-dish-btn btn1">
                            <img src="<?php echo base_url('assets/admin/images/add-new-dish-icon.svg'); ?>
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                            Add Sub Categories
                        </a>
                        <a href="<?php echo base_url('admin/settings'); ?>" class="add-new-dish-btn btn1">
                            <img src="https://img.icons8.com/ios-filled/30/FFFFFF/circled-left-2.png
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                            Back

                        </a>

                        <!-- <form method="post" action="<?php echo base_url('admin/Excel/importsubcategory'); ?>"
                            enctype="multipart/form-data" id="subcategoryexcelForm">
                            <div>

                              
                                <label for="subcategory_excel_file" class="add-new-dish-btn btn1 m-0"
                                    style="cursor: pointer; display: flex; align-items: center; gap: 5px;">
                                    <img src="https://img.icons8.com/color/48/microsoft-excel-2019--v1.png"
                                        alt="Excel icon" width="33" height="23">
                                    Upload
                                </label>

                                
                                <input type="file" id="subcategory_excel_file" name="subcategory_excel_file"
                                    accept=".xls,.xlsx,.csv" style="display: none;" required="">
                            </div>
                        </form> -->

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
                                    <th>Category Name</th>
                                    <!-- <th>Image</th> -->
                                    <th>Order</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                       if(!empty($subcategories)){
                       $count = 1;
                       foreach($subcategories as $val){ ?>
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $val->name;?></td>
                                    <td>
                                        <input type="text" class="form-control update_subcategory_order"
                                            style="width:30%;" value="<?php echo $val->order_index; ?>"
                                            data-subcategory-id="<?php echo $val->id; ?>" />
                                    </td>

                                    <td class="pb-0 pt-0 d-flex">
                                        <input type="hidden" name="id" value="<?php echo $val->id; ?>">
                                        <button class="btn tblEditBtn edit_subcategory pl-0 pr-0" type="submit"
                                            data-bs-toggle="modal" data-id="<?php echo $val->id; ?>"
                                            data-bs-original-title="Edit Category" data-bs-target="#edit-subcategory"><i
                                                class="fa fa-edit"></i></button>
                                        <a class="btn tblDelBtn pl-0 pr-0 del_subcategory" type="button"
                                            data-bs-toggle="modal" data-id="<?php echo $val->id; ?>"
                                            data-bs-original-title="Delete Category"
                                            data-bs-target="#delete-subcategory"><i class="fa fa-trash"></i></a>

                                    </td>
                                </tr>
                                <?php $count++; }} ?>

                            </tbody>
                        </table>
                    </div>

                    <div class="pagination-wrapper">
                        <?= $pagination; ?>
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

            <!-- add subcategory -->

            <div class="modal fade" id="add-subcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="exampleModalLabel">Add Subcategory</h2>
                            <button class="emigo-close-btn" type="button" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row bg-soft-light mb-3 border1 pt-2">
                                <form class="row mt-0 mb-0" id="addsubcategories" enctype="multipart/form-data"
                                    method="post">

                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">Order</label>
                                            <input type="text" readonly class="form-control" name="subcategory_order"
                                                value="<?php echo $order_indexsubcategories; ?>" placeholder="Order">
                                            <span class="error errormsg mt-2" id="category_order_error"></span>
                                            <div id="general_error" class="error errormsg"></div>
                                        </div>
                                    </div>







                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">Category</label>
                                            <select name="subcategory_id" class="form-select">
                                                <option value="">Select Category</option>
                                                <?php foreach($categories as $val){ ?>
                                                <option value="<?php echo $val['id']; ?>">
                                                    <?php echo $val['category_name']; ?></option>
                                                <?php } ?>
                                            </select>

                                            <span class="error errormsg mt-2" id="subcategory_id_error"></span>
                                        </div>
                                    </div>




                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">name</label>
                                            <input type="text" class="form-control" name="subcategory_name">
                                            <span class="error errormsg mt-2" id="subcategory_name_error"></span>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">Image</label>
                                            <input type="file" class="form-control" name="subcategory_userfile">
                                            <span class="error errormsg mt-2" id="subcategory_userfile_error"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="justify-content-center" style="float: right;">
                                            <button class="btn btn-primary w-md" type="button"
                                                id="add_subcategory">Save</button>
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

        <!-- edit subcategory -->
        <div class="modal fade" id="edit-subcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Edit Subcategory</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row bg-soft-light mb-3 border1 pt-2">
                            <form class="row mt-0 mb-0" id="edit_subcategories" enctype="multipart/form-data"
                                method="post">

                                <input type="hidden" id="hidden_subcategory_id">


                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input">Order</label>
                                        <input type="text" class="form-control" readonly name="subcategory_order"
                                            id="subcategory_order" value="" placeholder="Order">
                                        <span class="error errormsg mt-2" id="category_edit_order_error"></span>
                                        <div id="general_error" class="error errormsg"></div>
                                    </div>
                                </div>






                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input">Category</label>
                                        <select name="subcategory_id" class="form-select" id="subcategory_id">
                                            <option value="">Select Category</option>
                                            <?php foreach($categories as $val){ ?>
                                            <option value="<?php echo $val['id']; ?>">
                                                <?php echo $val['category_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="error errormsg mt-2" id="subcategory_id_edit_error"></span>
                                    </div>
                                </div>




                                <div class="col-md-3">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input"> Name </label>
                                        <textarea style="height: 15px;" name="subcategory_name" class="form-control"
                                            id="subcategory_name" placeholder="English" rows=""></textarea>
                                        <span class="error errormsg mt-2" id="subcategory_name_edit_error"></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input">Image</label>
                                        <input type="hidden" value="" class="form-control"
                                            name="existing_subcategory_userfile" id="existing_subcategory_userfile">
                                        <input type="file" class="form-control" name="subcategory_userfile"
                                            id="subcategory_userfile">

                                        <img id="preview_subcategory_img" src="" alt="Preview"
                                            style="max-width: 150px;">

                                        <span class="error errormsg mt-2" id="subcategory_userfile_edit_error"></span>
                                    </div>
                                </div>




                                <div class="col-md-12">
                                    <div class="justify-content-center" style="float: right;">
                                        <button class="btn btn-primary w-md" type="button"
                                            id="save_subcategory">Update</button>
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
    <div class="modal fade " id="delete-subcategory" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                    <input type="hidden" name="id" id="delete_subcat_id" value="" />
                    <?php echo are_you_sure; ?>
                </div>
                <div class="modal-footer"><button class="btn btn-primary" type="button"
                        data-bs-dismiss="modal">No</button>
                    <button class="btn btn-secondary" id="yes_subcat_user" type="button"
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
document.getElementById('subcategory_excel_file').addEventListener('change', function() {
    if (this.files.length > 0) {
        let form = document.getElementById('subcategoryexcelForm');
        let formData = new FormData(form);
        fetch("<?= base_url('admin/Excel/importsubcategory') ?>", {
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