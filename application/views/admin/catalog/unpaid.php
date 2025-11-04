<!-- Start right Content here -->
<!-- ============================================================== -->

<script src="<?php echo base_url();?>assets/admin/js/adminscript.js?"></script>

<div class="">
    <h1 class="application-content__page-heading mt-3 text-center">Unpaid Orders</h1>
    <div class="page-content p-2">
        <div class="container-fluid">


            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-retail-tab" data-bs-toggle="pill"
                        data-bs-target="#unpaid-orders" type="button" role="tab" aria-controls="pills-home"
                        aria-selected="true">Retail</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-wholesale-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-wholesale" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false">Wholesale</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-b2b-tab" data-bs-toggle="pill" data-bs-target="#pills-b2b"
                        type="button" role="tab" aria-controls="pills-contact" aria-selected="false">B2B</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-exp-tab" data-bs-toggle="pill" data-bs-target="#pills-exp"
                        type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Export</button>
                </li>


            </ul>
            <!-- Tab -->
            <div class="tab-content" id="pills-tabContent">
                <!-- Retail -->
                <div class="tab-pane fade show active order-tab" id="unpaid-orders" role="tabpanel"
                    aria-labelledby="pills-retail-tab">

                    <!-- search start -->
                    <div class="row ">

                    <div class="col-md-2">
                    <label for="name" class="form-label">Name</label>
                     <input type="text " class="form-control" id="unpaid-name"  value="" placeholder="Customer Name">
                    </div>

                
                    <div class="col-md-2">
                    <label for="name" class="form-label">Order No</label>
                     <input type="text " class="form-control" id="unpaid-orderno"  value="" placeholder="Order No">
                    </div>

                    <div class="col-md-2">
                    <label for="name" class="form-label">Email</label>
                     <input type="text " class="form-control" id="unpaid-email"  value="" placeholder="Email">
                    </div>

                    <div class="col-md-2">
                    <label for="name" class="form-label">Phone No</label>
                     <input type="text " class="form-control" id="unpaid-phone"  value="" placeholder="Phone No">
                    </div>

                     <div class="col-md-2 mt-4">
                     <button type="button" class="btn btn-primary" id="unpaid-search" data-type="rt">Search</button>
                    </div>

                    </div>
                    <!-- search end -->






                    <div class="row mt-3">
                        <div class="">
                            <div class="table-responsive-sm" >
                                <table id=" example" class="table table-striped" style="width:100%">
                                    <thead style="background: #e5e5e5;">
                                        <tr>
                                            <th>No</th>
                                            <th>Order No</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th style="white-space: nowrap;">Customer Name</th>
                                            <th style="white-space: nowrap;">Transaction Id</th>
                                            <th>Email</th>
                                            <th>Phone No</th>
                                            <th>State</th>
                                            <th>Pincode</th>
                                            <th>Status</th>
                                            <th style="white-space: nowrap;">Total Amount</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                       if(!empty($orders)){
                       $count = 1;
                       foreach($orders as $val){ ?>
                                        <!-- <?php echo $orders;?> -->
                                        <?php if($val['order_type'] == 'rt'){ ?>
                                        <tr>
                                            <!-- <td><input type="text" value="<?php echo $val['order_type'];?>"></td> -->
                                            <td><?php echo $count;?></td>
                                            <td><?php echo $val['order_no'];?></td>
                                            <td>
                                                <?php echo date("d/M/Y", strtotime($val['order_date']));?></td>
                                            <td style="white-space:nowrap"><?php echo trim(date("h:i A", strtotime($val['time']))); ?>
                                            </td>
                                            <td>
                                            <?php echo $val['name'];?>
                                            </td>

                                             <td>
                                            <?php echo $val['transaction_id'];?>
                                            </td>

                                            <td>
                                                <?php echo $val['email'];?>
                                            </td>
                                            <td><?php echo $val['phone'];?></td>
                                            <td>
                                                <?php echo $val['state'];?>
                                            </td>

                                            <td>
                                                <?php echo $val['postal_code'];?>
                                            </td>

                                          <td>
<?php 
    if ($val['is_paid'] == '1') {
        echo '<span class="badge bg-success">Success</span>';
    } elseif ($val['payment_status'] == 'processing') {
        echo '<span class="badge bg-secondary">Processing</span>';
    }

    elseif ($val['payment_status'] == 'pending') {
        echo '<span class="badge bg-primary">Pending</span>';
    }
    
    elseif ($val['payment_status'] == 'user aborted' ) {
        echo '<span class="badge bg-danger">Failed</span>';
    } 
?>
</td>


                                            <td style="text-align: right"><?php echo $val['total_amount'];?></td>

                                            <td class="pb-0 pt-0 d-flex">

                                                <button  
                                                    class="btn btn-success btn-sm  p-1 m-2  btn-sm tblEditBtn edit_order "
                                                    type="submit" data-bs-toggle="modal"
                                                    data-id="<?php echo $val['order_no']; ?>"
                                                    data-bs-target="#edit-order">View</button>
                                              
                                            </td>
                                        </tr>
                                        <?php $count++; }} ?>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  
                </div>
                <!-- Retail End -->
                <div class="tab-pane fade order-tab" id="pills-wholesale" role="tabpanel"
                    aria-labelledby="pills-wholesale-tab">

                    <div class="row">

                    <div class="col-md-2">
                    <label for="name" class="form-label">Name</label>
                     <input type="text " class="form-control" id="retail-name"  value="" placeholder="Customer Name">
                    </div>

                
                    <div class="col-md-2">
                    <label for="name" class="form-label">Order No</label>
                     <input type="text " class="form-control" id="retail-orderno"  value="" placeholder="Order No">
                    </div>

                    <div class="col-md-2">
                    <label for="name" class="form-label">Email</label>
                     <input type="text " class="form-control" id="retail-email"  value="" placeholder="Email">
                    </div>

                    <div class="col-md-2">
                    <label for="name" class="form-label">Phone No</label>
                     <input type="text " class="form-control" id="retail-phone"  value="" placeholder="Phone No">
                    </div>

                     <div class="col-md-2 mt-4">
                     <button type="button" class="btn btn-primary" id="retail-search" data-type="rt">Search</button>
                    </div>

                    </div>
                    <!-- Wholesale -->
                    <div class="row mt-3">
                        <div class="">
                            <div class="table-responsive-sm">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead style="background: #e5e5e5;">
                                        <tr>
                                            <th>No</th>
                                            <th>Order No</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Customer Name</th>
                                            <th>Email</th>
                                            <th>Phone No</th>
                                            <th>Total Amount</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                            if(!empty($orders)){
                            $count = 1;
                            foreach($orderswholesale as $val){ ?>
                                        <?php if($val['order_type'] == 'ws'){ ?>
                                        <tr>
                                            <td><?php echo $count;?></td>
                                            <td><?php echo $val['order_no'];?></td>
                                            <td>
                                                <?php echo date("d/m/Y", strtotime($val['order_date'])) ;?></td>

                                            <td><?php echo $val['time'];?></td>
                                            <td>
                                                <?php echo $val['name'];?>
                                            </td>
                                            <td>
                                                <?php echo $val['email'];?>
                                            </td>
                                            <td><?php echo $val['phone'];?></td>
                                            <td style="text-align: right;"><?php echo $val['total_amount'];?></td>

                                            <td class="pb-0 pt-0 d-flex">

                                                <button
                                                    class="btn btn-success btn-sm  p-1 m-2  btn-sm tblEditBtn edit_order "
                                                    type="submit" data-bs-toggle="modal"
                                                    data-id="<?php echo $val['order_no']; ?>"
                                                    data-bs-target="#edit-order">View Details</button>

                                                <button
                                                    class="btn btn-success btn-sm  p-1 m-2  btn-sm tblEditBtn edit_order "
                                                    type="submit"
                                                    data-id="<?php echo $val['order_no']; ?>">Dispatch</button>
                                                <!-- <a class="btn tblDelBtn pl-0 pr-0 del_category" type="button"
                                            data-bs-toggle="modal" data-id="<?php echo $val['id']; ?>"
                                            data-bs-original-title="Delete Category" data-bs-target="#delete-category"><i
                                                class="fa fa-trash"></i></a> -->

                                            </td>
                                        </tr>
                                        <?php $count++; }} ?>
                                        <?php } ?>


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Wholesale End -->

                <!-- b2b -->
                <div class="tab-pane fade order-tab" id="pills-b2b" role="tabpanel" aria-labelledby="pills-b2b-tab">
                    <div class="row">

                    <div class="col-md-2">
                    <label for="name" class="form-label">Name</label>
                     <input type="text " class="form-control" id="retail-name"  value="" placeholder="Customer Name">
                    </div>

                
                    <div class="col-md-2">
                    <label for="name" class="form-label">Order No</label>
                     <input type="text " class="form-control" id="retail-orderno"  value="" placeholder="Order No">
                    </div>

                    <div class="col-md-2">
                    <label for="name" class="form-label">Email</label>
                     <input type="text " class="form-control" id="retail-email"  value="" placeholder="Email">
                    </div>

                    <div class="col-md-2">
                    <label for="name" class="form-label">Phone No</label>
                     <input type="text " class="form-control" id="retail-phone"  value="" placeholder="Phone No">
                    </div>

                     <div class="col-md-2 mt-4">
                     <button type="button" class="btn btn-primary" id="retail-search" data-type="rt">Search</button>
                    </div>

                    </div>
                    <!-- b2b -->
                    <div class="row mt-3">
                        <div class="">
                            <div class="table-responsive-sm">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead style="background: #e5e5e5;">
                                        <tr>
                                            <th>No</th>
                                            <th>Order No</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Customer Name</th>
                                            <th>Email</th>
                                            <th>Phone No</th>
                                            <th>Total Amount</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                            if(!empty($orders)){
                            $count = 1;
                            foreach($orderswholesale as $val){ ?>
                                        <?php if($val['order_type'] == 'bb'){ ?>
                                        <tr>
                                            <td><?php echo $count;?></td>
                                            <td><?php echo $val['order_no'];?></td>
                                            <td><?php echo $val['order_date'];?></td>
                                            <td><?php echo $val['time'];?></td>
                                            <td>
                                                <?php echo $val['name'];?>
                                            </td>
                                            <td>
                                                <?php echo $val['email'];?>
                                            </td>
                                            <td><?php echo $val['phone'];?></td>
                                            <td style="text-align: right;"><?php echo $val['total_amount'];?></td>

                                            <td class="pb-0 pt-0 d-flex">

                                                <button
                                                    class="btn btn-success btn-sm  p-1 m-2  btn-sm tblEditBtn edit_order "
                                                    type="submit" data-bs-toggle="modal"
                                                    data-id="<?php echo $val['order_no']; ?>"
                                                    data-bs-target="#edit-order">View Details</button>
                                                <!-- <a class="btn tblDelBtn pl-0 pr-0 del_category" type="button"
                                            data-bs-toggle="modal" data-id="<?php echo $val['id']; ?>"
                                            data-bs-original-title="Delete Category" data-bs-target="#delete-category"><i
                                                class="fa fa-trash"></i></a> -->

                                            </td>
                                        </tr>
                                        <?php $count++; }} ?>
                                        <?php } ?>


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- b2b end -->
                </div>
                <!-- b2b end -->


                <!-- export -->
                <div class="tab-pane fade order-tab" id="pills-exp" role="tabpanel" aria-labelledby="pills-exp-tab">
                    <div class="row">

                    <div class="col-md-2">
                    <label for="name" class="form-label">Name</label>
                     <input type="text " class="form-control" id="retail-name"  value="" placeholder="Customer Name">
                    </div>

                
                    <div class="col-md-2">
                    <label for="name" class="form-label">Order No</label>
                     <input type="text " class="form-control" id="retail-orderno"  value="" placeholder="Order No">
                    </div>

                    <div class="col-md-2">
                    <label for="name" class="form-label">Email</label>
                     <input type="text " class="form-control" id="retail-email"  value="" placeholder="Email">
                    </div>

                    <div class="col-md-2">
                    <label for="name" class="form-label">Phone No</label>
                     <input type="text " class="form-control" id="retail-phone"  value="" placeholder="Phone No">
                    </div>

                     <div class="col-md-2 mt-4">
                     <button type="button" class="btn btn-primary" id="retail-search" data-type="rt">Search</button>
                    </div>

                    </div>
                    <div class="row mt-3">
                        <div class="">
                            <div class="table-responsive-sm">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead style="background: #e5e5e5;">
                                        <tr>
                                            <th>No</th>
                                            <th>Order No</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Customer Name</th>
                                            <th>Email</th>
                                            <th>Phone No</th>
                                            <th>Total Amount</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                            if(!empty($orders)){
                            $count = 1;
                            foreach($orderswholesale as $val){ ?>
                                        <?php if($val['order_type'] == 'exp'){ ?>
                                        <tr>
                                            <td><?php echo $count;?></td>
                                            <td><?php echo $val['order_no'];?></td>
                                            <td><?php echo $val['order_date'];?></td>
                                            <td><?php echo $val['time'];?></td>
                                            <td>
                                                <?php echo $val['name'];?>
                                            </td>
                                            <td>
                                                <?php echo $val['email'];?>
                                            </td>
                                            <td><?php echo $val['phone'];?></td>
                                            <td style="text-align: right;"><?php echo $val['total_amount'];?></td>

                                            <td class="pb-0 pt-0 d-flex">

                                                <button
                                                    class="btn btn-success btn-sm  p-1 m-2  btn-sm tblEditBtn edit_order "
                                                    type="submit" data-bs-toggle="modal"
                                                    data-id="<?php echo $val['order_no']; ?>"
                                                    data-bs-target="#edit-order">View Details</button>
                                                <!-- <a class="btn tblDelBtn pl-0 pr-0 del_category" type="button"
                                            data-bs-toggle="modal" data-id="<?php echo $val['id']; ?>"
                                            data-bs-original-title="Delete Category" data-bs-target="#delete-category"><i
                                                class="fa fa-trash"></i></a> -->

                                            </td>
                                        </tr>
                                        <?php $count++; }} ?>
                                        <?php } ?>


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <!-- export end -->
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

        <!-- edit order -->
        <div class="modal fade" id="edit-order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-title modal-header">




                        <h2 class="modal-title vieworder" id="exampleModalLabel">view Order </h2>
                        <!-- <span class="vieworder"></span> -->
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row mt-0 mb-0" id="edit_order" enctype="multipart/form-data" method="post">
                            <input type="hidden" id="hidden_order_id" value="">
                            <div class="row">
                                <div class="table-responsive-sm">
                                    <table id="orders" class="table table-striped product-table" style="width:100%">
                                        <thead style="background: #e5e5e5;">
                                            <tr>

                                                <!-- <th>Order No</th> -->
                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td id="order_no"></td>
                                                <td id="product_name"></td>
                                                <td id="quantity"></td>
                                                <td id="Total_Amount"></td>
                                            </tr>

                                        </tbody>
                                    </table>


                                    <div class="summary-section">
                                        <h5 class="mb-2">
                                            <strong style="font-size:16px !important;">Order Summary</strong>
                                        </h5>


                                          <div class="summary-row ">
                                            <span class="summary-label">
                                                 <i class="fas fa-file-invoice-dollar me-2"></i>
                                                Sub Total
                                            </span>
                                            <span class="summary-value" id="order-subtotal"></span>
                                        </div>


                                        <div class="summary-row shippingcharges">
                                            <span class="summary-label">
                                                <i class="fas fa-shipping-fast"></i>
                                                Shipping Charges
                                            </span>
                                            <span class="summary-value" id="shipping_charges"></span>
                                        </div>

                                        <!-- <div class="summary-row couponcode ">
                                            <span class="summary-label">
                                                <i class="fas fa-percent"></i>
                                                Coupon Discount
                                            </span>
                                            <span class="summary-value text-success " id="coupon_code">-</span>
                                        </div> -->

                                        <div class="summary-row">
                                            <span class="summary-label">
                                                <i class="fas fa-receipt"></i>
                                                <strong>Total Amount</strong>
                                            </span>
                                            <span class="summary-value" id="total_price"></span>
                                        </div>
                                    </div>




<div class="d-flex justify-content-between align-items-center">
    <!-- Left side: Tracking ID -->
    
    <div class="col-md-4">
        <label for="label"> Remark</label>
        <input type="text" class="form-control" id="remarks" value="" placeholder="Enter your remark">
        <span id="order_remark_error"></span>
    </div>

    <!-- Right side: Buttons -->
    <div>
        <button class="btn btn-primary btn-lg mx-2 convertorder" type="button" style="font-size:16px !important;">
          Convert Order
        </button>

        <button class="btn btn-primary btn-lg mx-2" type="button" style="font-size:16px !important;">
            Export Data
        </button>
    </div>
</div>


                                </div>

                            </div>
                        </form>
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