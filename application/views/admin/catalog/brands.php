<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="">
    <div class="page-content p-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="add-new-dish-list-combo mb-3">
                    <a   data-bs-toggle="modal" data-bs-original-title="Add Country" data-bs-target="#add-brand" class="add-new-dish-btn btn1">
                        <img src="<?php echo base_url('assets/admin/images/add-new-dish-icon.svg'); ?>
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                        Add Brands
                    </a>
                    <a href="<?php echo base_url('admin/settings'); ?>"   class="add-new-dish-btn btn1">
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
                                    <th>image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                       if(!empty($brand)){
                       $count = 1;
                       foreach($brand as $val){ ?>
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $val['name'];?></td>
                                    <td>
                                    <img src="<?php echo base_url('uploads/brand/'.$val['image']); ?>" alt="" width="100px" height="100px">  
                                    </td>

                                    <td class="pb-0 pt-0 d-flex">
                                            <input type="hidden" name="id" value="<?php echo $val['id']; ?>">
                                            <button class="btn tblEditBtn edit_brand pl-0 pr-0" type="submit"
                                                data-bs-toggle="modal" data-id="<?php echo $val['id']; ?>"
                                                data-bs-original-title="Edit Category" data-bs-target="#edit-brand"><i
                                                    class="fa fa-edit"></i></button>
                                        <a class="btn tblDelBtn pl-0 pr-0 del_brand" type="button"
                                            data-bs-toggle="modal" data-id="<?php echo $val['id']; ?>"
                                            data-bs-original-title="Delete Category" data-bs-target="#delete-brand"><i
                                                class="fa fa-trash"></i></a>

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

        <div class="modal fade" id="add-brand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Add Brand</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row bg-soft-light mb-3 border1 pt-2">
                    <form class="row mt-0 mb-0" id="addBrand"
                    enctype="multipart/form-data" method="post" >

                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">name</label>
                                <input type="text"  class="form-control" name="brand_name"
                                value="" placeholder="name"> 
                                <span class="error errormsg mt-2" id="brand_name_error"></span>
                                <div id="general_error" class="error errormsg"></div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">photo</label>
                                <input  type="file" class="form-control" name="brand_image">
                                <span class="error errormsg mt-2" id="brand_image_error"></span>
                            </div>
                        </div>
                      




                        

                        <div class="col-md-12">
                            <div class="justify-content-center" style="float: right;">
                                <button class="btn btn-primary w-md"  type="button" id="add_brand" >Save</button>
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
    <div class="modal fade" id="edit-brand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Edit Brands</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row bg-soft-light mb-3 border1 pt-2">
                        <form class="row mt-0 mb-0" id="edit_brand"
                        enctype="multipart/form-data" method="post" >

                        <input type="hidden" id="hidden_brand_id" >
                           
    
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input">name</label>
                                    <input type="text" class="form-control"  name="brand_name" id="brand_name"
                                    value="" placeholder="Order"> 
                                    <span class="error errormsg mt-2" id="brand_name_edit_error"></span>
                                    <div id="general_error" class="error errormsg"></div>
                                </div>
                            </div>
    


                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input">Image</label>
                                    <input  type="hidden" value="" class="form-control"  name="brand_image_existing" id="brand_image_existing">
                                    <input  type="file" value="" class="form-control" name="brand_image" id="brand_image">
                                    <img id="preview_brand" src="" alt="Preview" style="max-width: 150px;">
                                  
                                    <span class="error errormsg mt-2" id="brand_image_edit_error"></span>
                                </div>
                            </div>

    
                            <div class="col-md-12">
                                <div class="justify-content-center" style="float: right;">
                                    <button class="btn btn-primary w-md"  type="button" id="save_brand" >Update</button>
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
                <button type="button" class="btn btn-secondary reload-close-btn" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- success modal -->


    <!-- delete user -->
    <div class="modal fade " id="delete-brand" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                    <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- if response within jquery -->
                    <div class="message d-none" role="alert"></div>
                    <input type="hidden" name="id" id="delete_brand_id" value="" />
                    <?php echo are_you_sure; ?>
                </div>
                <div class="modal-footer"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                    <button class="btn btn-secondary" id="yes_delete_brand" type="button" data-bs-dismiss="modal">Yes</button>
                </div>
    
                </form>
            </div>
        </div>
    </div>
    <!-- delete user -->










        </div>