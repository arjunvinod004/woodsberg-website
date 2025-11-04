<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="">
    <div class="page-content p-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="add-new-dish-list-combo mb-3">
                    <a   data-bs-toggle="modal" data-bs-original-title="Add Country" data-bs-target="#add-user" class="add-new-dish-btn btn1">
                        <img src="<?php echo base_url('assets/admin/images/add-new-dish-icon.svg'); ?>
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                        Add User
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
                                    <th>Email</th>
                                    <th>Phone No</th>
                                    <!-- <th>Image</th> -->
                                    
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                       if(!empty($users)){
                       $count = 1;
                       foreach($users as $val){ ?>
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $val['Name'];?></td>
                                    <td><?php echo $val['userEmail'];?></td>
                                    <td><?php echo $val['UserPhoneNumber'];?></td>
                                  

                                    <td class="pb-0 pt-0 d-flex">
                                            <input type="hidden" name="id" value="<?php echo $val['userid']; ?>">
                                            <button class="btn tblEditBtn edit_user pl-0 pr-0" type="submit"
                                                data-bs-toggle="modal" data-id="<?php echo $val['userid']; ?>"
                                                data-bs-target="#edit-user"><i
                                                    class="fa fa-edit"></i></button>

                                        <a class="btn tblDelBtn pl-0 pr-0 del_user" type="button"
                                            data-bs-toggle="modal" data-id="<?php echo $val['userid']; ?>"
                                         data-bs-target="#delete-user"><i
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

        <!-- add user -->

        <div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Add User</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row bg-soft-light mb-3 border1 pt-2">
                    <form class="row mt-0 mb-0" id="add-new-user"
                    enctype="multipart/form-data" method="post" >

                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Name</label>
                                <input type="text"  class="form-control" name="user_name" 
                                value="" placeholder="Name"> 
                                <span class="error errormsg mt-2" id="user_name_error"></span>
                                <div id="general_error" class="error errormsg"></div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Email</label>
                                <input class="form-control"
                                value="" type="text"
                                placeholder="Email" name="user_email" >
                                <span class="error errormsg mt-2" id="user_email_error"></span>
                            </div>
                        </div>

                      
                      

                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Phone No</label>
                                <input name="user_phoneno"   class="form-control"
                                       placeholder="Phone No"
                                            ></input>
                             <span class="error errormsg mt-2" id="user_phoneno_error"></span>
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Username</label>
                                <input name="user_username"  class="form-control"
                                       placeholder="Username"
                                            ></input>
                             <span class="error errormsg mt-2" id="user_username_error"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Password</label>
                                <input  type="password" class="form-control" name="user_password" placeholder="Password">
                                <span class="error errormsg mt-2" id="user_password_error"></span>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Role</label>
                                <select class="form-control" name="user_role" >
                            <option value="">Select role</option>
                            <option value="1" <?= set_select('role', '1') ?>>Admin</option>
                            <option value="2" <?= set_select('role', '2') ?>>User</option>
                            </select>
                                <span class="error errormsg mt-2" id="user_role_error"></span>
                            </div>
                        </div>
                      




                        

                        <div class="col-md-12">
                            <div class="justify-content-center" style="float: right;">
                                <button class="btn btn-primary w-md"  type="button" id="add_user" >Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                    </div>
                   
                </div>
            </div>
        </div>



    </div>

    <!-- add user -->
    <!-- <input type="text" id="hidden_category_id" > -->

    <!-- edit user -->
    <div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Edit User</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row bg-soft-light mb-3 border1 pt-2">
                        <form class="row mt-0 mb-0" id="edit_new_user"
                        enctype="multipart/form-data" method="post" >

                        <input type="hidden" id="hidden_user_id" >
                           
    
                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Name</label>
                                <input type="text"  class="form-control" name="user_name" id="user_name"
                                value="" placeholder="Name"> 
                                <span class="error errormsg mt-2" id="user_edit_name_error"></span>
                                <div id="general_error" class="error errormsg"></div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Email</label>
                                <input class="form-control"
                                value="" type="text"
                                placeholder="Email" name="user_email" id="user_email" >
                                <span class="error errormsg mt-2" id="user_edit_email_error"></span>
                            </div>
                        </div>

                      
                      

                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Phone No</label>
                                <input name="user_phoneno"   class="form-control"
                                       placeholder="Phone No" id="user_phoneno"
                                            ></input>
                             <span class="error errormsg mt-2" id="user_edit_phoneno_error"></span>
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Username</label>
                                <input name="user_username"  class="form-control"
                                       placeholder="Username" id="user_username"
                                            ></input>
                             <span class="error errormsg mt-2" id="user_edit_username_error"></span>
                            </div>
                        </div>

                        <!-- <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Password</label>
                                <input  type="text" class="form-control" name="user_password" id="user_password" placeholder="Password">
                                <span class="error errormsg mt-2" id="user_edit_password_error"></span>
                            </div>
                        </div> -->


                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Role</label>
                                <select class="form-control" name="user_role" id="user_role" >
                            <option value="">Select role</option>
                            <option value="1" <?= set_select('role', '1') ?>>Admin</option>
                            <option value="2" <?= set_select('role', '2') ?>>User</option>
                            </select>
                                <span class="error errormsg mt-2" id="user_edit_role_error"></span>
                            </div>
                        </div>
                      
                            <div class="col-md-12">
                                <div class="justify-content-center" style="float: right;">
                                    <button class="btn btn-primary w-md"  type="button" id="update_user" >Update</button>
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
    <div class="modal fade " id="delete-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                    <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- if response within jquery -->
                    <div class="message d-none" role="alert"></div>
                    <input type="hidden" name="id" id="delete_user_id" value="" />
                    <?php echo are_you_sure; ?>
                </div>
                <div class="modal-footer"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                    <button class="btn btn-secondary" id="yes_delete_user" type="button" data-bs-dismiss="modal">Yes</button>
                </div>
    
                </form>
            </div>
        </div>
    </div>
    <!-- delete user -->










        </div>