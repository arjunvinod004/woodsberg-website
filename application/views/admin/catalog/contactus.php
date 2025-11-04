<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="">
    <div class="page-content p-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="add-new-dish-list-combo mb-3">
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
                                    <th> Name</th>
                                    <th>Email</th>
                                    <th>Description</th>
                                    <th>Phone No</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                       if(!empty($contactus)){
                       $count = 1;
                       foreach($contactus as $val){ ?>
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $val['name'];?></td>
                                    <td>
                                        <?php echo $val['email'];?>
                                    </td>
                                    <td>
                                        <?php echo $val['description'];?>
                                    </td>
                                    <td><?php echo $val['phone_no'];?></td>

                                    <td class="pb-0 pt-0 d-flex">

                                        <a class="btn tblDelBtn pl-0 pr-0 del_contactus" type="button"
                                            data-bs-toggle="modal" data-id="<?php echo $val['id']; ?>"
                                            data-bs-original-title="Delete Category"
                                            data-bs-target="#delete-contactus"><i class="fa fa-trash"></i></a>

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




        </div>

        <!-- add category -->
        <!-- <input type="text" id="hidden_category_id" > -->




        <!-- success modal -->
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="emigo-modal__heading" id="exampleModalLabel"></h1>
                        <button type="button" class="emigo-close-btn" data-bs-dismiss="modal"
                            aria-label="Close"></button>
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


        <!-- delete slider -->
        <div class="modal fade " id="delete-contactus" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                        <button type="button" class="emigo-close-btn" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- if response within jquery -->
                        <div class="message d-none" role="alert"></div>
                        <input type="hidden" name="id" id="delete_contactus_id" value="" />
                        <?php echo are_you_sure; ?>
                    </div>
                    <div class="modal-footer"><button class="btn btn-primary" type="button"
                            data-bs-dismiss="modal">No</button>
                        <button class="btn btn-secondary" id="yes_contactus_user" type="button"
                            data-bs-dismiss="modal">Yes</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- delete user -->










    </div>