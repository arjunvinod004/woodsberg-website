<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<link href="<?php echo base_url();?>assets/admin/css/crm-responsive.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
    type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/overiding-style.css" id="app-style" rel="stylesheet"
    type="text/css" />
<link href="<?php echo base_url();?>assets/admin/sass/overiding-style.css" id="app-style" rel="stylesheet"
    type="text/css" />





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


    <input type="hidden" id="order_type" value="<?php echo $type;?>">

    <div class="">
        <div class="table-responsive-sm">


            <form class="row g-3">
                <!-- Product ID Field -->
                <div class="col-md-3 d-none">
                    <label for="productId" class="form-label">Product ID</label>
                    <input type="text" class="form-control" id="productId" name="productId"
                        placeholder="Enter Product ID">
                </div>

                <!-- Date Field -->
                <div class="col-md-3 d-none">
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo confirm; ?></h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="table_id" value="" />
                <input type="hidden" name="id" id="store_id_hidden_popup" value="" />
                <?php echo are_you_sure; ?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                <button class="btn btn-secondary" id="yes_del_table" type="button" data-bs-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>
<!--modal for delete confirmation-->

<!-- KOT Modal -->
<div class="modal fade" id="kotModal" tabindex="-1" aria-labelledby="kotModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kotModalLabel">Kitchen Order Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="kotContent">
                <!-- KOT details will be loaded here -->
                <p>Print contents here</p>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-secondary close_window_print"
                    data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" onclick="printKOT()">Print</button>
            </div>
        </div>
    </div>
</div>



<!-- Confirmation Delete order  -->
<div class="modal fade" id="deleteOrderModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="emigo-modal__heading" id="exampleModalLabel">delete</h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Do you want to delete order?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteOrder">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- Confirmation Delete order  -->

<!-- Confirmation Delete full order  -->
<div class="modal fade" id="deleteFullOrderModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="emigo-modal__heading" id="exampleModalLabel">delete</h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Do you want to delete order?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteFullOrder">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- Confirmation Delete full order  -->


<!-- Modal for printing -->
<div class="modal fade" id="printModal" tabindex="-1" aria-labelledby="printModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="printModalLabel">Print Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- Content will be loaded here dynamically -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_window_print"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="printPage()">Print</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal for printing -->

<!-- Return order  -->
<div class="modal fade" id="returnOrderModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Return order</h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="return-order-form">
                <!-- Order items table primary key id -->
                <input type="hidden" id="return_order_item_id" name="return_order_item_id">
                <!-- Order items table primary key id -->
                <input type="hidden" id="return_order_item_qty">
                <!-- return order item product id -->
                <input type="hidden" id="return_order_item_product_id" name="return_order_item_product_id">
                <!-- return order item product id -->
                <!-- order id -->
                <input type="hidden" id="return_order_id" name="return_order_id">
                <!-- Return item id -->
                <!-- Return item variant id -->
                <input type="hidden" id="return_item_variant_id" name="return_item_variant_id">
                <!-- Return item variant id -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 d-flex owner_model_heading">
                            <p class="owner_model_heading_name mb-0"></p>
                            <span class="owner_model_heading_qty"></span>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Return Quantity</label>
                            <input type="text" value="" class="form-control" id="return_quantity" name="return_quantity"
                                autofocus>
                            <div class="errormsg mt-2" id="quantity_error"></div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Replace Quantity</label>
                            <input type="text" value="" class="form-control" id="replace_quantity"
                                name="replace_quantity">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Reason</label>
                            <select class="form-select" id="return_reason" name="return_reason">
                                <option value="">Select any reason</option>
                                <option value="Quality not as expected">Quality not as expected</option>
                                <option value="Ordered by mistake">Ordered by mistake</option>
                                <option value="other">Others</option>
                            </select>
                            <div class="errormsg mt-2" id="reason_error"></div>
                        </div>
                        <div id="reason_container" class="col-12 d-none">
                            <label class="form-label">Enter your reason</label>
                            <textarea class="form-control" id="return_order_custom_reason"
                                name="return_order_custom_reason"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Return / Replace Order</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Return order  -->

<!-- Confirmation Delete order  -->
<div class="modal fade" id="deleteOrderModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">delete</h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body content_with_remarks d-none">
                <label for="">Remarks</label>
                <textarea name="order_delete_reason" class="form-control" id="order_delete_reason"></textarea>
                <div class="errormsg mt-2" id="order_delete_reason_error"></div>
            </div>
            <div class="modal-body content_with_confirmation d-none">
                <p>Are you sure you want to delete this order item!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteOrder">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- Confirmation Delete order  -->

<!-- message modal  -->
<div class="modal fade" id="message_modal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-end">
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body message_modal_description"></div>
        </div>
    </div>
</div>
<!-- Confirmation Delete order  -->




</div>

<!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/admin/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {

    $(document).on("click", ".kot_table_order", function() {
        var orderId = $(this).data("order-id");
        var is_kot_enable = $(this).data("kot-enable");
        if (is_kot_enable == 1) {
            $('#kotModal').modal('show');
            $.ajax({
                url: '<?= base_url("owner/order/getKotPrintOrderItems"); ?>',
                method: 'POST',
                data: {
                    order_no: orderId,
                },
                success: function(response) {
                    $('#kotContent').html(response);
                }
            });
        }
    });

    $(document).on("click", ".accept_table_order", function() {
        var orderId = $(this).data("order-id");
        $.ajax({
            url: '<?= base_url("owner/order_kitchen/accept_order"); ?>',
            type: "POST",
            data: {
                orderId: orderId
            },
            dataType: "json",
            success: function(response) {
                if (response.status === "success") {
                    $(".msgContainer" + orderId).removeClass("d-none");
                    $("#ordermsg" + orderId).removeClass("d-none");
                    $("#ordermsg" + orderId).text("Order accepted.");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            },
        });
    });

    $(document).on("click", ".ready_table_order", function() {
        var orderId = $(this).data("order-id");
        $.ajax({
            url: '<?= base_url("owner/order_kitchen/ready_order"); ?>',
            type: "POST",
            data: {
                orderId: orderId
            },
            dataType: "json",
            success: function(response) {
                if (response.status === "success") {
                    $(".msgContainer" + orderId).removeClass("d-none");
                    $("#ordermsg" + orderId).removeClass("d-none");
                    $("#ordermsg" + orderId).text("Order Ready.");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            },
        });
    });

    function show_message_modal(message) {
        $("#message_modal").modal("show");
        $(".message_modal_description").text(message);
        //location.reload();
    }












    $(document).on("click", ".close_window_print", function() {
        location.reload();
    });












    // Get current date in YYYY-MM-DD format
    const order_type = $('#order_type').val();

    // Function to fetch orders based on date
    function fetchOrders() {
        $.ajax({
            url: '<?= base_url("owner/order_kitchen/getPendingOrdersByType"); ?>',
            method: 'POST',
            data: {
                order_type: order_type
            },
            success: function(response) {
                // Update the orders container with fetched data
                $('#orders-container').html(response);
            },
            error: function(xhr, status, error) {
                $('#orders-container').html('<p>Error fetching orders.</p>');
                console.error(error);
            }
        });
    }

    fetchOrders();
    // fetchOrders(currentDate);
});
</script>

<script>
$(document).ready(function() {
    // Bind keyup event to quantity input fields
    $(".quantity").on("keyup", function() {
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
        $(".row-total").each(function() {
            grandTotal += parseFloat($(this).text()) || 0;
        });

        // Update grand total
        $("#grandTotal").text(grandTotal.toFixed(2));
    }
});

function printKOT() {
    $('#kotModal').modal('hide');
    $('#recipe').modal('hide');
    var printContents = document.getElementById("kotContent").innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload();

    printWindow.onload = function() {
        printWindow.document.getElementById("cancelBtn").onclick = function() {
            window.opener.location.reload(); // Reload parent page
            printWindow.close(); // Close the print window
        };
    };
}

function printPage() {
    $('#printModal').modal('hide');
    var printContents = document.getElementById("modalContent").innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload();

    printWindow.onload = function() {
        printWindow.document.getElementById("cancelBtn").onclick = function() {
            window.opener.location.reload(); // Reload parent page
            printWindow.close(); // Close the print window
        };
    };
}
</script>