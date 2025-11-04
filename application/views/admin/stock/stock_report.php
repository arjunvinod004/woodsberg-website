
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">

                


                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Stock Report</h4>
                
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                                        <i class="fa-solid fa-chevron-right " style="font-size: 9px;margin: 6px 5px 0px 5px;"></i>
                                        <li class="breadcrumb-item active">Stock Report</li>
                                    </ol>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                   
                    <div class="row">


                    <!-- if response within jquery -->
                    <div class="message d-none" role="alert"></div>
                    <!-- if response within jquery -->


                    <?php if($this->session->flashdata('success')){ ?>
                    <div class="alert alert-success dark" role="alert">
                        <?php echo $this->session->flashdata('success');$this->session->unset_userdata('success'); ?>
                    </div><?php } ?>
                    
                    <?php if($this->session->flashdata('error')){ ?>
                    <div class="alert alert-danger dark" role="alert">
                        <?php echo $this->session->flashdata('error');$this->session->unset_userdata('error'); ?>
                    </div><?php } ?>


                    <input type="hidden" id="tableId" value="1" >
                        
                    <div class="">
                            <div class="table-responsive-sm">


                            
                                
                                <form class="row g-3">
                                <!-- Product ID Field -->
                                <div class="col-md-3 d-none">
                                    <label for="productId" class="form-label">Product ID</label>
                                    <input type="text" class="form-control" id="productId" name="productId" placeholder="Enter Product ID">
                                </div>

                                <!-- Date Field -->
                                <div class="col-md-3">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="order-date" name="date">
                                </div>

                                <!-- Customer Name Field -->
                                <div class="col-md-3">
                                    <label for="customerName" class="form-label">Category</label>
                                    <select class="form-select" name="category_id" id="category_id">
                                <option value="">Select Category</option>
    <?php
                                foreach($categories as $category)
                                {
                                ?>
                              <option value="<?=$category['category_id'];?>" <?php echo set_select('category_id', $category['category_id'])?>><?=$category['category_name_en'];?></option>
                              <?php
                                }
                                ?>
    </select>
                                </div>

                                
                                </form>

                                <div id="orders-container">
                                                        <!-- Orders will be displayed here -->
                                </div>


                            





                               
                               
                                
                            </div>
                        </div>
                    </div>





                           <!--modal for delete confirmation-->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><?php echo confirm; ?></h5>
                              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="table_id" value=""/>
                                <input type="hidden" name="id" id="store_id_hidden_popup" value=""/>
                                <?php echo are_you_sure; ?></div>
                            <div class="modal-footer">
                              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                              <button class="btn btn-secondary" id="yes_del_table" type="button" data-bs-dismiss="modal">Yes</button>
                            </div>
                          </div>
                        </div>
                      </div>
        <!--modal for delete confirmation-->





            </div>

            <script src="<?php echo base_url();?>assets/admin/js/modules/store.js"></script>

             <!-- JAVASCRIPT -->
    <script src="<?php echo base_url();?>assets/admin/js/metismenu.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/simplebar.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/waves.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/feather.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/app.js"></script>
    <!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
    // Get current date in YYYY-MM-DD format
    const tableId = $('#tableId').val();
    const currentDate = new Date().toISOString().split('T')[0]; 
    const category = $('#category_id').val(); 
    $('#order-date').val(currentDate);

    // Function to fetch orders based on date
    function fetchOrders(date, category) {
        $.ajax({
            url: '<?= base_url("owner/stock/getStockReport"); ?>',
            method: 'POST',
            data: { date: date , category : category },
            success: function (response) {
                // Update the orders container with fetched data
                $('#orders-container').html(response);
            },
            error: function (xhr, status, error) {
                $('#orders-container').html('<p>Error fetching orders.</p>');
                console.error(error);
            }
        });
    }

    // Fetch orders for the current date on page load
    fetchOrders(currentDate , category);

    // Fetch orders when date is changed
    $('#order-date').on('change', function () {
        const selectedDate = $(this).val();
        const category = $('#category_id').val(); 
        // alert(category);alert(selectedDate);
        fetchOrders(selectedDate , category);
    });

    $('#category_id').on('change', function () {
        const category = $('#category_id').val(); 
        const selectedDate = $('#order-date').val();
        // alert(category);alert(selectedDate);
        fetchOrders(selectedDate , category);
    });
});

</script>