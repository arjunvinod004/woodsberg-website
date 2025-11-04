<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<link href="<?php echo base_url();?>assets/admin/css/crm-responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/css/classic.min.css" rel="stylesheet"  /> <!-- 'classic' theme -->
    <link href="<?php echo base_url();?>assets/admin/fonts/css/all.min.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/css/icon.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url();?>assets/admin/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/bootstrap.bundle.min.js"></script>

       
       
       

                    
               

                



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


                    <input type="hidden" id="order_type" value="<?php echo $type;?>" >
                        
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
    const order_type = $('#order_type').val();
    const currentDate = new Date().toISOString().split('T')[0]; 
    $('#order-date').val(currentDate);

    // Function to fetch orders based on date
    function fetchOrders(date) {
        $.ajax({
            url: '<?= base_url("owner/order/getCompletedOrdersByType"); ?>',
            method: 'POST',
            data: { date: date , order_type : order_type },
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
    fetchOrders(currentDate);

    // Fetch orders when date is changed
    $('#order-date').on('change', function () {
        const selectedDate = $(this).val();
        fetchOrders(selectedDate);
    });
});

</script>

<script>
    $(document).ready(function () {
    // Bind keyup event to quantity input fields
    $(".quantity").on("keyup", function () {
        alert('here');
        const $row = $(this).closest("tr"); // Current table row
        const price = parseFloat($row.find(".price").text()); // Price in the row
        const quantity = parseInt($(this).val()) || 0; // Get quantity or fallback to 0
        const $rowTotal = $row.find(".row-total"); // Row total cell

        // Update row total
        const rowTotal = price * quantity;
        $rowTotal.text(rowTotal.toFixed(2));

        // Update grand total
        updateGrandTotal();
    });

    function updateGrandTotal() {
        let grandTotal = 0;

        // Sum up all row totals
        $(".row-total").each(function () {
            grandTotal += parseFloat($(this).text()) || 0;
        });

        // Update grand total
        $("#grandTotal").text(grandTotal.toFixed(2));
    }
});

</script>