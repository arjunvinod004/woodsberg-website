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


            
                        
                    <div class="">
                            <div class="table-responsive-sm">


                            
                               <table class="table">
  <thead>
    <tr>
      <th>Sl</th>
      <th>Product</th>
      <th>Stock Quantity</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach ($products as $key => $product){ ?> 
    <tr>
      <td><?php echo $key+1; ?></td>
      <td><?php echo $this->Ordermodel->getProductName($product['product_id']) ?></td>
      <td><?php echo $product['current_stock']; ?></td>
    </tr>
    <?php } ?>
 
  </tbody>
</table>


                            





                               
                               
                                
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

