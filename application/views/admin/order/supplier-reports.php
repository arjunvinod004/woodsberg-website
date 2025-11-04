<div class="application-content reports-content">
    <div class="application-content__container reports-content__container container">
        <h1 class="application-content__page-heading">Reports - Supplier</h1>
        <div class="reports-content__data">


            <div class="modal-container">
                <a class="modal-trigger reports-content__item supplier_sales" data-store-id="<?php echo $store_id; ?>"
                    data-name="SALES">
                    <img src="<?php echo base_url();?>assets/admin/images/dollar-icon.svg" alt="dollar icon"
                        class="reports-content__item-icon">
                    <h2 class="reports-content__item-text">Sales</h2>
                </a>
                <div class="modal-window">
                    <div class="modal-wrapper">
                        <div class="modal-data">
                            <iframe id="table_iframe_sales" height="750px" width="100%"></iframe>
                        </div>
                        <div class="close-icon"></div>
                    </div>
                </div>
            </div>

            <div class="modal-container">
                <a class="modal-trigger reports-content__item supplier_user" data-store-id="<?php echo $store_id; ?>"
                    data-name="SALES">
                    <img src="<?php echo base_url();?>assets/admin/images/user-icon.svg" alt="dollar icon"
                        class="reports-content__item-icon">
                    <h2 class="reports-content__item-text">User</h2>
                </a>
                <div class="modal-window">
                    <div class="modal-wrapper">
                        <div class="modal-data">
                            <iframe id="table_iframe_user" height="750px" width="100%"></iframe>
                        </div>
                        <div class="close-icon"></div>
                    </div>
                </div>
            </div>

            <!-- <div class="modal-container">
                <a class="modal-trigger reports-content__item supplier_delivery"
                    data-store-id="<?php echo $store_id; ?>" data-name="SALES">
                    <img src="<?php echo base_url();?>assets/admin/images/delivery-icon.svg" alt="dollar icon"
                        class="reports-content__item-icon">
                    <h2 class="reports-content__item-text">Delivery</h2>
                </a>
                <div class="modal-window">
                    <div class="modal-wrapper">
                        <div class="modal-data">
                            <iframe id="table_iframe_delivery" height="750px" width="100%"></iframe>
                        </div>
                        <div class="close-icon"></div>
                    </div>
                </div>
            </div> -->

        </div>

    </div>
</div>