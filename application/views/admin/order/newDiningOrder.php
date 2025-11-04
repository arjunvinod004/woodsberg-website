<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<link href="<?php echo base_url();?>assets/admin/css/crm-responsive.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
    type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/owner-custom-styles.css" id="app-style" rel="stylesheet"
    type="text/css" />
<link href="<?php echo base_url();?>assets/admin/sass/owner-custom-style.css" id="app-style" rel="stylesheet"
    type="text/css" />

<div class="">
    <div class="row">
        <input type="hidden" id="order_number" value="<?php echo $order_number;?>">
        <input type="hidden" id="orderType" value="<?php echo $orderType;?>">
        <div class="col-12 text-center">
            <h2 class="popup-container__heading">Dining Order</h2>
        </div>
        <div class="col-6">
            <label class="form-label" for="default-input">Select Table</label>
            <select class="form-select" name="table_id" id="table_id">
                <option value="">Select Table</option>
                <?php
                                foreach($activeTables as $table)
                                {
                                    $table_name = $table['store_table_name'] ? $table['store_table_name'] : $table['table_name'];
                                ?>
                <option value="<?=$table['table_id'];?>" <?php echo set_select('table_id', $table['table_id'])?>>
                    <?=$table_name;?></option>
                <?php
                                }
                                ?>
            </select>
        </div>

        <div class="col-6">
            <label class="form-label" for="default-input">Select Product</label>
            <div class="custom-select-container">
                <div class="custom-dropdown" id="dropdown">Select product</div>
                <div class="dropdown-content" id="dropdownContent">
                    <input type="text" class="search-box" id="searchBox" placeholder="Search...">
                    <?php if(!empty($products)){ foreach($products as $product){ ?>
                    <div data-value="<?=$product['store_product_id'];?>"><?=$product['product_name_en'];?></div>
                    <?php }} ?>
                </div>
                <select class="custom-select form-select d-none" id="originalSelect">
                    <?php if(!empty($products)){ foreach($products as $product){ ?>
                    <option value="<?=$product['store_product_id'];?>"><?=$product['product_name_en'];?></option>
                    <?php }} ?>
                </select>
            </div>
        </div>
    </div>
</div>



<div class="popup-container pb-0 pt-0 pl-0 pr-0" id="orders-container"></div>
<div class="out_of_stock_warning user-cart-page__out-of-stock alert-danger" id="out-of-stock-products"
    style="display: none;">
    <p id="error-message">Some products are out of stock</p>
</div>
<div id="order_display" class="row popup-container pb-0 pt-0 pl-0 pr-0"></div>
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

<!-- The Modal -->
            <div class="modal fade" id="validationModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            This is a simple Bootstrap modal popup.
                        </div>
                    </div>
                </div>
            </div>
            <!-- validation -->

<!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/admin/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
   $(document).on("keyup", "#productQuantityNotCustomize", function() {
        $.ajax({
            url: '<?= base_url("owner/order/getProductRatesNotCustomize"); ?>',
            type: "POST",
            data: {
                store_id: $("#store_id").val(),
                product_id: $("#product_id").val(),
                qty: $("#productQuantityNotCustomize").val()
            },
            dataType: "json",
            success: function(response) {
                $("#rate1").val(response.rate);
                $("#qty").val($("#productQuantityNotCustomize").val());
                $("#tax_amount1").val(response.tax_amount);
                $("#total_amount1").val(response.total_amount);
                $("#ratenew").val(response.rate);
                $("#taxnew").val(response.tax);
                $("#taxamtnew").val(response.tax_amount);
                $("#totalnew").val(response.total_amount);
            },
        });
    });

    $(document).on("keyup", "#productQuantity", function() {
        $.ajax({
            url: '<?= base_url("owner/order/getProductRates"); ?>',
            type: "POST",
            data: {
                store_id: $("#store_id").val(),
                product_id: $("#product_id").val(),
                variant_id: $("#variant_id").val(),
                qty: $("#productQuantity").val()
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                $("#rate").val(response.rate);
                $("#qty").val($("#productQuantity").val());
                $("#tax_amount").val(response.tax_amount);
                $("#total_amount").val(response.total_amount);
                $("#ratenew").val(response.rate);
                $("#taxnew").val(response.tax);
                $("#taxamtnew").val(response.tax_amount);
                $("#totalnew").val(response.total_amount);
                $("#variantnew_id").val(response.variant_id);
            },
        });
    });

    $(document).off("click", "#saveOrder").on("click", "#saveOrder", function() {
        var SelectedVariantValue = $("#variant_id option:selected");
        var variantValue = SelectedVariantValue.data("variant_value") || 0; // Default to 0 if undefined
        var variant_id = $("#variant_id").val() || 0; // Default to 0 if undefined
        // alert(variant_id);
        // alert(variantValue);
        $.ajax({
            url: '<?= base_url("owner/order/SaveNewDiningOrder"); ?>',
            type: "POST",
            data: {
                order_id: window.parent.$("#order_number").val(),
                tableID: $("#tableId").val(),
                orderType: $("#orderType").val(),
                store_id: $("#store_id").val(),
                product_id: $("#product_id").val(),
                qty: $("#qty").val(),
                rate: $("#ratenew").val(),
                tax: $("#taxnew").val(),
                tax_amount: $("#taxamtnew").val(),
                total_amount: $("#totalnew").val(),
                variant_id: variant_id,
                variant_value: variantValue
            },
            dataType: "text",
            success: function(response) {
                console.log(response);
                $("#order_display").html(response);
                $("#productQuantityNotCustomize").val('');
                $("#dropdown").val('');
                $("#rate1").val('');
                $("#tax_amount1").val('');
                $("#total_amount1").val('');
                if (variantValue == 0) {
                    $("#dropdown").text("Select product");
                }
                $("#searchBox").val('');
            },
        });
    });

    // Open the modal and store the order ID
    $(document).off("click", ".delete-order").on("click", ".delete-order", function() {
        orderId = $(this).data("id");
        rowId = "#order-row-" + orderId;
        $("#deleteOrderModal").modal("show");
    });

    // Confirm Deletion
    $("#confirmDeleteOrder").on("click", function() {
        $.ajax({
            url: '<?= base_url("owner/order/deleteOrderItem"); ?>',
            type: "POST",
            data: {
                orderId: orderId
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $(rowId).remove();
                    $("#deleteOrderModal").modal("hide");
                }
            }
        });
    });

    $(document).on("click", "#saveConfirmOrder", function(event) {
        event.preventDefault(); // Prevent form submission if inside a form

        $.ajax({
            url: '<?= base_url("owner/order/SaveConfirmOrder"); ?>',
            type: "POST",
            data: {
                order_id: $("#order_number").val()
            },
            dataType: "json",
            success: function(response) {
                if (response.status === 'error') {
                    let outOfStockContainer = $('#out-of-stock-products');
                    outOfStockContainer.empty().hide(); // Clear previous list

                    if (Array.isArray(response.out_of_stock) && response.out_of_stock.length > 0) {
                    let outOfStockList = $('<div>');
                    let productList = $('<ul class="mb-0">');
        
                    let addedProducts = new Set(); // Track unique product names
        
                    response.out_of_stock.forEach(function(product) {
                        if (!addedProducts.has(product.product_name)) {
                            addedProducts.add(product.product_name);
                            productList.append(`
                                <li class="p-3">${product.product_name} - Quantity: ${product.requested_quantity} - Available Stock: ${product.available_stock}</li>
                            `);
                        }
                    });
        
                    outOfStockList.append(productList);
                    outOfStockContainer.html(outOfStockList).show();
        }
                } else {
                    $('#out-of-stock-products').hide();
                    window.top.location.href = '<?= base_url("owner/order"); ?>';
                }
            }
        });
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
        const totalIncludeTax = newTotal + ((newTotal * taxRate) / 100);
        var variantValue = $(this).data("variant_value");
        var totalStockField = $row.find("." + product_id + "total_stock");

        let sum_variant_total = quantity;
        // print_r($sum_variant_total)
        
        let sum_variant_total_new = 0;
        $(`.${product_id}total_stock`).each(function() {
            let variant_total = parseFloat($(this).val()) ||
                1; // Convert to float, default to 0 if NaN
            sum_variant_total += variant_total;
        });
        
        //alert(sum_variant_total);
        
        let total_new = 1 * parseInt(variantValue) || 1;
        // alert(total_new);
        
        
        

        


        $.ajax({
            url: '<?= base_url("owner/order/current_stock") ?>',
            method: 'POST',
            data: {
                product_id: product_id
            },
            success: function(total_stock) {
                // alert(total_stock);
                
                let available_stock = 0;
                //alert(variantValue);
                if(variantValue == 0)
                {
                    available_stock = total_stock;
                }
                else
                {
                    available_stock = total_stock - quantity;
                   
                }
                

                
                //alert(available_stock);alert(total_new);
                if (available_stock < total_new) {
                    // alert('hlooo')

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
        // alert(orderno);
        const orderstatus = $(this).data('orderstatus'); //order status
        const rate = $(this).data('rate'); //product rate
        const taxRate = $(this).data('tax'); //product rate
        const newTotal = newQuantity * rate; // Calculate subtotal
        const totalIncludeTax = newTotal + (newTotal * taxRate).toFixed(2) / 100;
        var variantValue = $(this).data("variant_value");
        var totalStockField = $row.find("." + product_id + "total_stock");
        // alert(variantValue);

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
                    $('.modal-backdrop fade show').appendTo('body').modal('hide');
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
                        // $.ajax({
                        //     url: '<?= base_url("owner/order/deleteOrderItemStockRemove") ?>',
                        //     method: 'POST',
                        //     data: {
                        //         item_id: item_id, //delete item id primary key
                        //         orderstatus: orderstatus,
                        //         product_id: product_id,
                        //     },
                        //     success: function(data) {
                        //         location.reload();
                        //     }
                        // });
                    }
                }
            }
        });


    });


})
</script>



<script>
const dropdown = document.getElementById('dropdown');
const dropdownContent = document.getElementById('dropdownContent');
const searchBox = document.getElementById('searchBox');
const items = Array.from(dropdownContent.querySelectorAll('div[data-value]'));
let highlightedIndex = -1;

// Show dropdown on focus
dropdown.addEventListener('click', () => {
    toggleDropdown();
});

searchBox.addEventListener('focus', () => {
    dropdownContent.style.display = 'block';
});

// Filter items based on search
searchBox.addEventListener('input', () => {
    const filter = searchBox.value.toLowerCase();
    highlightedIndex = -1; // Reset highlight
    items.forEach((item) => {
        item.style.display = item.textContent.toLowerCase().includes(filter) ? '' : 'none';
    });
});

// Keyboard navigation
searchBox.addEventListener('keydown', (e) => {
    const visibleItems = items.filter(item => item.style.display !== 'none');
    if (e.key === 'ArrowDown') {
        e.preventDefault();
        highlightedIndex = (highlightedIndex + 1) % visibleItems.length;
        updateHighlight(visibleItems);
    } else if (e.key === 'ArrowUp') {
        e.preventDefault();
        highlightedIndex = (highlightedIndex - 1 + visibleItems.length) % visibleItems.length;
        updateHighlight(visibleItems);
    } else if (e.key === 'Enter') {
        e.preventDefault();
        if (highlightedIndex > -1) {
            selectItem(visibleItems[highlightedIndex]);
        }
    }
});

// Highlight item
function updateHighlight(visibleItems) {
    visibleItems.forEach((item, index) => {
        item.classList.toggle('highlighted', index === highlightedIndex);
    });
}

// Select item
function selectItem(item) {
    const value = item.dataset.value;
    const text = item.textContent;
    dropdown.textContent = text;
    searchBox.value = text;
    dropdownContent.style.display = 'none';
    searchBox.blur();
    $.ajax({
        url: '<?= base_url("owner/order/getProductRatesWithIsCustomizeNewDiningOrder"); ?>',
        method: 'POST',
        data: {
            order_number: $('#order_number').val(),
            table_id: $('#table_id').val(),
            orderType: $('#orderType').val(),
            product_id: value
        },
        success: function(response) {
            $('#orders-container').html(response);
            setTimeout(function() {
                let firstInput = document.getElementById("productQuantityNotCustomize");
                let secondInput = document.getElementById("productQuantity");

                if (firstInput) {
                    firstInput.focus();
                    $('#searchBox').val('')
                }

                if (secondInput) {
                    secondInput.focus();
                    $('#searchBox').val('')
                }
            }, 100);
        }
    });
}

// Toggle dropdown visibility
function toggleDropdown() {
    const isOpen = dropdownContent.style.display === 'block';
    dropdownContent.style.display = isOpen ? 'none' : 'block';
    if (!isOpen) searchBox.focus();
}

// Close dropdown if clicked outside
document.addEventListener('click', (e) => {
    if (!e.target.closest('.custom-select-container')) {
        dropdownContent.style.display = 'none';
    }
});

// Handle click on dropdown items
items.forEach(item => {
    item.addEventListener('click', () => {
        selectItem(item);
    });
});
</script>