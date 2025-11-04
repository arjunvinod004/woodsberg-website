<div class="application-content reports-content">
    <div class="application-content__container reports-content__container container-fluid">
        <h1 class="application-content__page-heading mt-3 text-center">Reports</h1>
        <div class="reports-content__data">

            <!-- retail start -->

            <div class="modal-container">

                <a class="modal-trigger reports-content__item sales" data-store-id="<?php echo $store_id; ?>"
                    data-name="SALES">
                    <img src="<?php echo base_url();?>assets/admin/images/dollar-icon.svg" alt="dollar icon"
                        class="reports-content__item-icon">
                    <h2 class="reports-content__item-text">Reports</h2>
                </a>



                <div class="modal-window ">
                    <div class="modal-wrapper modal-xl">
                        <div class="modal-data">
                            <div class="row">
                                <div class="" style="height: 500px; overflow-y: scroll">
                                    <div class="table-responsive-sm">
                                        <form class="row g-3 mt-4">
                                            <!-- Product ID Field -->


                                            <!-- Date Field -->
                                            <div class="col-md-3 mb-3">
                                                <label for="date" class="form-label">Date</label>
                                                <input type="date" class="form-control" id="retail-date"
                                                    name="retail-date" value="<?php echo date('Y-m-d'); ?>">

                                            </div>



                                            <div class="col-md-3 mb-3">
                                                <label for="date" class="form-label">Order Type</label>
                                                <select name="order-type" id="order-type" class="form-select">
                                                    <option value="all" selected>All</option>
                                                    <option value="rt">Retail</option>
                                                    <option value="ws">Wholesale</option>
                                                    <option value="bb">Franchise</option>
                                                    <option value="exp">Export</option>
                                                </select>
                                            </div>


                                            <div class="col-md-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text " class="form-control" id="retail-name"
                                                    name="retail-name" value="">
                                            </div>

                                            <div class="col-md-3">
                                                <label for="name" class="form-label">Phone No</label>
                                                <input type="text " class="form-control" id="retail-phone"
                                                    name="retail-phone" value="">
                                            </div>


                                        </form>

                                        <div>
                                            <table class="table table-striped table-bordered table-hover"
                                                id="dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Order No</th>
                                                        <th>Name</th>
                                                        <th>Phone</th>
                                                        <th>Order Type</th>
                                                        <th>Total Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="retail-report">
                                                    <tr>
                                                        <td colspan="4" class="text-center">No sales data available.
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="close-icon"></div>
                    </div>
                </div>
            </div>
            <!-- retail end -->

            
            <div class="modal-container">

                <a class="modal-trigger reports-content__item sales" data-store-id="<?php echo $store_id; ?>"
                    data-name="SALES">
                    <img src="<?php echo base_url();?>assets/admin/images/dollar-icon.svg" alt="dollar icon"
                        class="reports-content__item-icon">
                    <h2 class="reports-content__item-text">Summary</h2>
                </a>



                <div class="modal-window ">
                    <div class="modal-wrapper modal-xl">
                        <div class="modal-data">
                            <div class="row">
                                <div class="" style="height: 500px; overflow-y: scroll">
                                    <div class="table-responsive-sm">
                                        <form class="row g-3 mt-4">
                                            <!-- Product ID Field -->


                                            <!-- Date Field -->
                                            <div class="col-md-3 mb-3">
                                                <label for="date" class="form-label"> From Date</label>
                                                <input type="date" class="form-control" id="summary-from-date"
                                               value="<?php echo date('Y-m-d'); ?>">
                                            </div>

                                             <div class="col-md-3 mb-3">
                                                <label for="date" class="form-label"> To Date</label>
                                                <input type="date" class="form-control" id="summary-to-date"
                                                 value="<?php echo date('Y-m-d'); ?>">
                                            </div>



                                            
                                        </form>

                                        <div>
                                            <table class="table table-striped table-bordered table-hover"
                                                id="dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Total Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="summary-report">
                                                    <tr>
                                                        <td colspan="4" class="text-center">No sales data available.
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                       <div class="summary_total_container">
    <p class="summary_total_amount"></p>
</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="close-icon"></div>
                    </div>
                </div>
            </div>



        </div>

    </div>
</div>