<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
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


    <input type="hidden" id="order_id" value="<?php echo $order_no;?>">




    <div class="container">
        <div class="row">


            <style>
            .invoice-container {
                max-width: 99%;
                background: #fff;
                border-radius: 8px;
            }

            .header {
                text-align: center;
                border-bottom: 2px solid #eee;
                padding-bottom: 10px;
            }

            .header h1 {
                margin: 0;
                color: #333;
            }

            .header p {
                margin: 5px 0;
                color: #666;
                font-size: 14px;
            }

            .items {
                width: 100%;
                margin: 20px 0;
                border-collapse: collapse;
            }

            .items th,
            .items td {
                padding: 10px;
                text-align: left;
                border: 1px solid #ddd;
            }

            .items th {
                background: #f4f4f4;
                font-weight: bold;
            }

            .totals {
                margin-top: 20px;
            }

            .totals div {
                display: flex;
                justify-content: space-between;
                padding: 5px 0;
            }

            .totals div span {
                font-weight: bold;
            }

            @media print {
                button {
                    display: none;
                }

                body {
                    margin: 0;
                    padding: 0;
                }

                table {
                    page-break-inside: auto;
                }
            }
            </style>
            </head>

            <body>
                <div class="invoice-container" id="printableArea">
                    <div class="header">
                        <img width="150px"
                            src="<?php echo base_url(); ?>/uploads/store/<?php echo $storeDet[0]['store_logo_image']; ?>"
                            alt="Restaurant Logo" class="logo">
                        <h5 class=mt-2><?php echo $storeDet[0]['store_name'] ?></h5>
                        <p><?php echo $storeDet[0]['store_address'] ?></p>
                        <p>Phone: <?php echo $storeDet[0]['store_phone'] ?></p>
                        <p> Email:<?php echo $storeDet[0]['store_email'] ?></p>
                        <!--<p>Order No: <?php echo $order_no;?></p>-->
                        <?php
switch ($order_type) {
    case 'D':
        $order_text = 'Dine In - ' . $table_name;
        break;
    case 'PK':
        $order_text = 'Pickup';
        break;
    case 'DL':
        $order_text = 'Delivery';
        break;
    default:
        $order_text = 'Unknown';
}
?>

                        <p><?php echo  $order_text;?></p>
                    </div>
                    <table class="items">
                        <thead>
                            <tr>
                                <th width="5%">Sl</th>
                                <th width="25%">Item</th>
                                <th width="5%">Qty</th>
                                <th width="10%">Price</th>
                                <th width="10%">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $grand_total = 0; ?>
                            <?php foreach($order_items as $index => $orders){
                                $tax_amount='';
                                $total_amount = '';
                                if($orders['is_return'] != 0)
                                {
                                    $quantity = $orders['quantity'] - $orders['return_qty'];
                                }
                                else
                                {
                                    $quantity = $orders['quantity'];
                                }

                                if($quantity > 0){ 
                                $total = $orders['rate'] * $quantity; // Calculate row total
                                $grand_total += $total;

                                $discount = ($order->tax / 100) * $grand_total;
                                $tax_amount = number_format($discount, 2);
                                $total_amount = $tax_amount + $grand_total;
                            ?>
                            <tr>
                                <td><?php echo $index + 1 ?></td>
                                <td><?php echo $this->Ordermodel->getProductName($orders['product_id']); ?></td>
                                <td>
                                    <?php echo $quantity; ?>
                                </td>
                                <td><?php echo $orders['rate']; ?></td>
                                <td><?php echo $orders['rate'] * $quantity; ?></td>
                            </tr>
                            <?php }} ?>
                            <tr>
                                <td colspan="12" class="text-end">
                                    Subtotal : <b><?php echo $grand_total; ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="12" class="text-end">
                                    VAT (<?php echo $order->tax; ?>%) :
                                    <b><?php echo $tax_amount; ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="12" class="text-end">
                                    Total : <b><?php echo $total_amount; ?></b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <p>Thank you visit again</p>
                    <p>Consume packed food within 2 hours.</p>
                    <!--<button type="button" id="close_print_area" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>-->
                    <!--<button class="btn btn-primary" onclick="printAndClose()">Print</button>-->
                </div>
            </body>

            </html>


        </div>
    </div>
</div>
</div>
<script src="<?php echo base_url();?>assets/admin/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/bootstrap.bundle.min.js"></script>