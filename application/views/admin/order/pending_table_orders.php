<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<link href="<?php echo base_url();?>assets/admin/css/crm-responsive.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/classic.min.css" rel="stylesheet" /> <!-- 'classic' theme -->
<link href="<?php echo base_url();?>assets/admin/fonts/css/all.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
    type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/icon.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/admin/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/bootstrap.bundle.min.js"></script>
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


    <input type="hidden" id="table_id" value="<?php echo $table_id;?>">

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


            <div id="orders-containersss">
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
</div>



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

<!-- Quantity increment and decrement validation -->
<div class="modal fade" id="validationModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
<!-- Quantity increment and decrement validation -->






</div>

<!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/admin/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {

    var base_url = $('#base_url').val();

    $(document).on("click", ".add_order_item", function() {
        var orderId = $(this).data("order-id");
        var url = base_url + "owner/order/AddOrderItems/" + orderId;
        $("#table_iframe_recipe2").attr("src", url);
        return false;
    });

    $(document).on("click", ".approve_table_order", function() {
        var orderId = $(this).data("order-id");
        var is_kot_enable = $(this).data("kot-enable");
        var orderItems = [];

        $("#collapse" + orderId + " .product-item table tbody tr").each(function() {
            var id = $(this).find(".id").val();
            var store_product_id = $(this).find(".store_product_id").val();
            var quantity = $(this).find(".quantity").val();
            var rate = $(this).find(".rate").val();
            var tax = $(this).find(".tax").val();
            var variant_value = $(this).find(".variant_value").val();

            orderItems.push({
                id: id,
                store_product_id: store_product_id,
                quantity: quantity,
                rate: rate,
                variant_value: variant_value,
                tax: tax
            });

        });

        $.ajax({
            url: '<?= base_url("owner/order/update_order"); ?>',
            type: "POST",
            data: {
                orderId: orderId,
                items: orderItems
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                if (response.status === "success") {

                    //If KOT enabled show KOT Print popup
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
                    } else {
                        $(".msgContainer" + orderId).removeClass("d-none");
                        $("#ordermsg" + orderId).removeClass("d-none");
                        $("#ordermsg" + orderId).text("Order updated successfully.");
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                    //If KOT enabled show KOT Print popup

                } else {
                    // Avoid repeating product names
                    let uniqueProducts = new Map();
                    response.outOfStockProducts.forEach(p => {
                        if (!uniqueProducts.has(p.product_name)) {
                            uniqueProducts.set(p.product_name, ` ${p.product_name} (Order Quantity: ${p.requested_quantity}, Available: ${p.available_stock})`);
                        }
                    });
            
                    let outOfStockList = [...uniqueProducts.values()].join('<br>');
                    show_message_modal_with_html(`Out of Stock products:<br>${outOfStockList}`);
                }
            },
        });
    });


    // Open the return modal
    $(document).off("click", ".return-order").on("click", ".return-order", function() {

        $('#returnOrderModal').on('shown.bs.modal', function() {
            $('#return_quantity').val('');
            $('#return_quantity').focus();
        });

        $("#returnOrderModal").modal("show");
        $(".owner_model_heading_name").text($(this).data("item"));
        $(".owner_model_heading_qty").text($(this).data("qty"));
        $("#return_order_item_id").val($(this).data("order-item-id"));
        $("#return_order_item_qty").val($(this).data("qty"));
        $("#return_order_item_product_id").val($(this).data("item-id"));
        $("#return_order_id").val($(this).data("order-id"));
        $("#return_item_variant_id").val($(this).data("variant-id"));
    });

    //. Return order form click function
    $('#return-order-form').on('submit', function(e) {
        e.preventDefault();
        $('.errormsg').text('');
        var order_quantity = $('#return_order_item_qty').val(); //alert(order_quantity);
        var total_quantity = (parseInt($('#return_quantity').val()) || 0) + (parseInt($(
            '#replace_quantity').val()) || 0); //alert(total_quantity);
        let isValid = true;
        if ($('#return_reason').val() === '') {
            $('#reason_error').text('Please select any reason.');
            isValid = false;
        }
        if ($('#return_quantity').val() === '' && $('#replace_quantity').val() === '') {
            $('#quantity_error').text('Please select return or replace quantity.');
            isValid = false;
        }
        if (total_quantity > order_quantity) {
            $('#quantity_error').text('Please select valid quantity.');
            isValid = false;
        }
        if (isValid) {
            $.ajax({
                url: base_url + 'owner/order/returnOrderItem',
                type: 'POST',
                data: $('#return-order-form').serialize(),
                success: function(response) {
                    $("#returnOrderModal").modal("hide");
                    show_message_modal(response);
                },
                error: function(xhr, status, error) {
                    // Handle error
                    alert('An error occurred while submitting the form.');
                }
            });
        }
    });

    function show_message_modal(message) {
        $("#message_modal").modal("show");
        $(".message_modal_description").text(message);
        //location.reload();
    }
    
    function show_message_modal_with_html(message) {
        $("#message_modal").modal("show");
        $(".message_modal_description").html(message);
        //location.reload();
    }

    $(document).on("change", "#return_reason", function() {
        if ($(this).val() == 'other') {
            $("#reason_container").removeClass("d-none");
        } else {
            $("#reason_container").addClass("d-none");
        }
    });

    // Open the modal and store the order ID
    $(document).off("click", ".delete-order").on("click", ".delete-order", function() {
        $('#deleteOrderModal').on('shown.bs.modal', function() {
            $('#order_delete_reason').val('');
            $('#order_delete_reason').focus();
        });
        orderId = $(this).data("id"); // order items primary key for deleting
        order_status = $(this).data(
            "status"
        ); //Order status for delete purpose if delete an approved order should popup remark else not remark
        rowId = "#order-row-" + orderId;
        $("#deleteOrderModal").modal("show");
        if (order_status == 1) {
            $('.content_with_remarks').removeClass('d-none');
            $('.content_with_confirmation').addClass('d-none');
        } else {
            $('.content_with_confirmation').removeClass('d-none');
            $('.content_with_remarks').addClass('d-none');
        }
    });

    // Confirm Deletion
    $("#confirmDeleteOrder").on("click", function() {
        let delete_reason = $('#order_delete_reason').val();
        let isValid = true;
        let delete_url = '';
        //alert(order_status);

        if (order_status == 0) { // Pending order
            delete_url = '<?= base_url("owner/order/deleteOrderItem") ?>'; //Delete order item
        } else if (order_status == 1) { // Approved order
            delete_url =
                '<?= base_url("owner/order/deleteOrderItemWithUpdateRemark") ?>'; //Delete order item and update remark
            if (delete_reason === '') {
                $('#order_delete_reason_error').text('Please enter your reason.');
                isValid = false;
            }
        }

        if (isValid) {
            $.ajax({
                url: delete_url,
                type: "POST",
                data: {
                    orderId: orderId,
                    delete_reason: delete_reason
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        // $(rowId).remove();
                        $("#deleteOrderModal").modal("hide");
                        location.reload();
                    }
                }
            });
        }
    });

    //Delete entire orders(order and order items)
    $(document).on("click", ".delete-full-order", function() {
        orderId = $(this).data("order-id");
        $("#deleteFullOrderModal").modal("show");
    });

    $("#confirmDeleteFullOrder").on("click", function() {
        $.ajax({
            url: '<?= base_url("owner/order/deleteOrder"); ?>',
            type: "POST",
            data: {
                orderId: orderId
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $("#deleteFullOrderModal").modal("hide");
                    location.reload();
                }
            }
        });
    });
    //Delete entire orders(order and order items)



    $(document).on("click", ".pay_table_order", function() {
        var orderId = $(this).data("order-id");
        $.ajax({
            url: '<?= base_url("owner/order/pay_order"); ?>',
            type: "POST",
            data: {
                orderId: orderId
            },
            dataType: "json",
            success: function(response) {
                if (response.status === "success") {
                    $(".msgContainer" + orderId).removeClass("d-none");
                    $("#ordermsg" + orderId).removeClass("d-none");
                    $("#ordermsg" + orderId).text("Order Paid successfully.");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            },
        });
    });

    $(document).on("click", ".dining_order", function() {
        var orderId = $(this).data("order-id");
        $.ajax({
            url: '<?= base_url("owner/order/dining_order"); ?>',
            type: "POST",
            data: {
                orderId: orderId
            },
            dataType: "json",
            success: function(response) {
                if (response.status === "success") {
                    $(".msgContainer" + orderId).removeClass("d-none");
                    $("#ordermsg" + orderId).removeClass("d-none");
                    $("#ordermsg" + orderId).text("Order delivered successfully.");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            },
        });
    });

    $(document).on("click", ".pay_order_print", function() {
        var orderId = $(this).data("order-id");
        $.ajax({
            url: '<?= base_url("owner/order/PrintOrderItems"); ?>',
            method: 'POST',
            data: {
                order_no: orderId
            },
            success: function(response) {
                $("#modalContent").html(response);
                $("#printModal").modal('show');
            }
        });
    });


    $(document).on("click", ".close_window_print", function() {
        location.reload();
    });


    // increment and decrement order item
    $(document).on("click", ".increment", function() {
        let input = $(this).siblings(".quantity");
        const product_id = $(this).data('product-id');
        const quantity = parseInt($(this).siblings('input').val());
        let $row = $(this).closest("tr");
        var quantityField = $row.find(".quantity");
        let newQuantity = quantity + 1;
        const item_id = $(this).data('id'); //order item id
        const orderno = $(this).data('orderno'); //order number
        const orderstatus = $(this).data('orderstatus'); //order status
        const rate = $(this).data('rate'); //product rate
        const taxRate = $(this).data('tax'); //product rate
        const newTotal = newQuantity * rate; // Calculate subtotal
        const totalIncludeTax = newTotal + (newTotal * taxRate).toFixed(2) / 100;
        var variantValue = $(this).data("variant_value");
        //alert(variantValue);
        var totalStockField = $row.find("." + product_id + "total_stock");

        let sum_variant_total = 0;
        let sum_variant_total_new = 0;
        $(`.${product_id}total_stock`).each(function() {
            let variant_total = parseFloat($(this).val()) ||
                1; // Convert to float, default to 0 if NaN
            sum_variant_total += variant_total;
        });
        
        //alert(sum_variant_total);
        
        let total_new = 1 * parseInt(variantValue) || 1;
        
        
        

        


        $.ajax({
            url: '<?= base_url("owner/order/current_stock") ?>',
            method: 'POST',
            data: {
                product_id: product_id
            },
            success: function(total_stock) {
                let available_stock = 0;
                //alert(variantValue);
                if(variantValue == 0)
                {
                    available_stock = total_stock;
                }
                else
                {
                    available_stock = total_stock - sum_variant_total;
                }
                
                //alert(available_stock);alert(total_new);
                if (available_stock < total_new) {
                    $('#validationModal').appendTo('body').modal('show');
                    $('#validationModal .modal-body').html('Out of Stock');
                    return false;
                } else {
                    quantityField.val(newQuantity);
                    totalStockField.val(newQuantity * variantValue);

                    $.ajax({
                        url: '<?= base_url("owner/order/update_order_item") ?>',
                        method: 'POST',
                        data: {
                            item_id: item_id, //edit item id primary key
                            product_id: product_id, //Product id
                            quantity: newQuantity,
                            rate: rate,
                            orderno: orderno,
                            orderstatus: orderstatus,
                            type: 'decrement'
                        },
                        success: function(data) {
                            $row.find(".amount").text(newTotal);
                            $row.find(".total-amount").text(
                                totalIncludeTax);
                            const SubtotalAmount = parseFloat($(
                                    "#order-amount-" + orderno).text()) +
                                parseFloat(rate)
                            $("#order-amount-" + orderno).text(
                                SubtotalAmount);
                            $("#order-amount-include-tax-" + orderno).text(
                                SubtotalAmount + (SubtotalAmount *
                                    taxRate)
                                .toFixed(2) / 100
                            ); // accordion header amount including tax
                            $("#order-amount-include-tax-footer-" + orderno)
                                .text(
                                    SubtotalAmount + (SubtotalAmount *
                                        taxRate)
                                    .toFixed(2) / 100
                                ); // Accordion footer amount including tax
                        }
                    });
                }
            }
        });


    });

    $(document).on("click", ".decrement", function() {
        let input = $(this).siblings(".quantity");
        const product_id = $(this).data('product-id');
        const quantity = parseInt($(this).siblings('input').val());
        let $row = $(this).closest("tr");
        var quantityField = $row.find(".quantity");
        let newQuantity = quantity - 1;
        const item_id = $(this).data('id'); //order item id
        const orderno = $(this).data('orderno'); //order number
        const orderstatus = $(this).data('orderstatus'); //order status
        const rate = $(this).data('rate'); //product rate
        const taxRate = $(this).data('tax'); //product rate
        const newTotal = newQuantity * rate; // Calculate subtotal
        const totalIncludeTax = newTotal + (newTotal * taxRate).toFixed(2) / 100;
        var variantValue = $(this).data("variant_value");
        var totalStockField = $row.find("." + product_id + "total_stock");
        //alert(variantValue);

        let sum_variant_total = 0;
        $(`.${product_id}total_stock`).each(function() {
            let variant_total = parseFloat($(this).val()) ||
                0; // Convert to float, default to 0 if NaN
            sum_variant_total -= variant_total;
        });


        let total_new = 1 * parseInt(variantValue) || 0;



        $.ajax({
            url: '<?= base_url("owner/order/current_stock") ?>',
            method: 'POST',
            data: {
                product_id: product_id
            },
            success: function(total_stock) {
                let available_stock = 0;
                //alert(variantValue);
                if(variantValue == 0)
                {
                    available_stock = total_stock;
                }
                else
                {
                    available_stock = total_stock - sum_variant_total;
                }
                
                //alert(available_stock);
                if (available_stock < total_new) {
                    $('#validationModal').appendTo('body').modal('show');
                    $('#validationModal .modal-body').html('Out of Stock');
                    return false;
                }else {
                    if (newQuantity > 0) {
                        quantityField.val(newQuantity);
                        totalStockField.val(newQuantity * variantValue);

                        $.ajax({
                            url: '<?= base_url("owner/order/update_order_item") ?>',
                            method: 'POST',
                            data: {
                                item_id: item_id, //edit item id primary key
                                product_id: product_id, //Product id
                                quantity: newQuantity,
                                rate: rate,
                                orderno: orderno,
                                orderstatus: orderstatus,
                                type: 'decrement'
                            },
                            success: function(data) {
                                $row.find(".amount").text(newTotal);
                                $row.find(".total-amount").text(
                                    totalIncludeTax);
                                const SubtotalAmount = parseFloat($(
                                        "#order-amount-" + orderno).text()) -
                                    parseFloat(rate)
                                $("#order-amount-" + orderno).text(
                                    SubtotalAmount);
                                $("#order-amount-include-tax-" + orderno).text(
                                    SubtotalAmount + (SubtotalAmount *
                                        taxRate)
                                    .toFixed(2) / 100
                                ); // accordion header amount including tax
                                $("#order-amount-include-tax-footer-" + orderno)
                                    .text(
                                        SubtotalAmount + (SubtotalAmount *
                                            taxRate)
                                        .toFixed(2) / 100
                                    ); // Accordion footer amount including tax
                            }
                        });
                    } else {
                        $.ajax({
                            url: '<?= base_url("owner/order/deleteOrderItemStockRemove") ?>',
                            method: 'POST',
                            data: {
                                item_id: item_id, //delete item id primary key
                                orderstatus: orderstatus,
                                product_id: product_id,
                            },
                            success: function(data) {
                                location.reload();
                            }
                        });
                    }
                }
            }
        });


    });



    //
    const table_id = $('#table_id').val();

    function fetchOrders() {
        $.ajax({
            url: '<?= base_url("owner/order/getPendingOrdersByTableID"); ?>',
            method: 'POST',
            data: {
                table_id: table_id
            },
            success: function(response) {
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
    $(".quantity").on("keyup", function() {
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