
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">

                


                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Categories</h4>
                
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                                        <i class="fa-solid fa-chevron-right " style="font-size: 9px;margin: 6px 5px 0px 5px;"></i>
                                        <li class="breadcrumb-item active">Categories</li>
                                    </ol>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    
                   

                
                
                  <div class="row">
                        
                    
                  <form method="post" action="<?php echo base_url(); ?>owner/categories/edit" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?php  if(isset($categoryDet[0]['category_id'])){echo $categoryDet[0]['category_id'];}?>">
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <!-- <li class="nav-item" role="presentation">
      <button class="nav-link active" id="store-tab" data-bs-toggle="tab" data-bs-target="#store" type="button" role="tab" aria-controls="store" aria-selected="true">Store</button>
    </li> -->
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="store" role="tabpanel" aria-labelledby="store-tab">
      <div class="row">
        






     
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">






     
  <div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label">Code</label>
    <div class="col-sm-3">
    <input class="form-control" readonly value="<?php if(set_value('code')){echo set_value('code');}else if(isset($categoryDet[0]['category_code'])){echo $categoryDet[0]['category_code'];}?>" type="text" name="code">
    <?php if(form_error('code')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('code'); ?></div>
      <?php } ?>
    </div>

    <label class="col-sm-1 col-form-label">Photo</label>
    <div class="col-sm-2">
    <input type="hidden" name="old_image" value="<?php if(isset($categoryDet[0]['category_img'])) echo $categoryDet[0]['category_img'];?>">
    <img width="100" height="100" src="<?php echo base_url(); ?>uploads/categories/<?php if(isset($categoryDet[0]['category_img'])) echo $categoryDet[0]['category_img']; ?>" class="img-thumbnail">
    <input type="file" class="form-control-file" name="userfile">
    <?php if(form_error('userfile')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('userfile'); ?></div>
      <?php } ?>
      <?php if (isset($error)): ?>
        <div class="errormsg mt-2" role="alert"><?php echo $error; ?></div>
    <?php endif; ?>
    </div>

    <label class="col-sm-2 col-form-label">Order Index</label>
    <div class="col-sm-2">
    <input type="text" class="form-control" name="order" value="<?php if(set_value('order')){echo set_value('order');}else if(isset($categoryDet[0]['order_index'])){echo $categoryDet[0]['order_index'];}?>" placeholder="Order">
    <?php if(form_error('order')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('order'); ?></div>
      <?php } ?>
    </div>
    
  </div>




  <div class="form-group row mb-2">

    <label class="col-sm-2 col-form-label"></label>
    <div class="col-sm-2">
    <label class="col-sm-12 col-form-label">Malayalam</label>
    </div>
    <div class="col-sm-2">
    <label class="col-sm-12 col-form-label">English</label>
    </div>
    <div class="col-sm-3">
    <label class="col-sm-12 col-form-label">Hindi</label>
    </div>
    <div class="col-sm-3">
    <label class="col-sm-12 col-form-label">Arabic</label>
    </div>


  </div>



  <div class="form-group row mb-2">

    <label class="col-sm-2 col-form-label">Category Name</label>
    <div class="col-sm-2">
    <input class="form-control" value="<?php if(set_value('category_name_ma')){echo set_value('category_name_ma');}else if(isset($categoryDet[0]['category_name_ma'])){echo $categoryDet[0]['category_name_ma'];}?>" type="text" placeholder="Malayalam" name="category_name_ma">
    <?php if(form_error('category_name_ma')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('category_name_ma'); ?></div>
      <?php } ?>
    </div>
    <div class="col-sm-2">
    <input class="form-control" value="<?php if(set_value('category_name_en')){echo set_value('category_name_en');}else if(isset($categoryDet[0]['category_name_en'])){echo $categoryDet[0]['category_name_en'];}?>" type="text" placeholder="English" name="category_name_en">
    <?php if(form_error('category_name_en')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('category_name_en'); ?></div>
      <?php } ?>
    </div>
    <div class="col-sm-3">
    <input class="form-control" value="<?php if(set_value('category_name_hi')){echo set_value('category_name_hi');}else if(isset($categoryDet[0]['category_name_hi'])){echo $categoryDet[0]['category_name_hi'];}?>" type="text" placeholder="Hindi" name="category_name_hi">
    <?php if(form_error('category_name_hi')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('category_name_hi'); ?></div>
      <?php } ?>
    </div>
    <div class="col-sm-3">
    <input class="form-control" value="<?php if(set_value('category_name_ar')){echo set_value('category_name_ar');}else if(isset($categoryDet[0]['category_name_ar'])){echo $categoryDet[0]['category_name_ar'];}?>" type="text" placeholder="Arabic" name="category_name_ar">
    <?php if(form_error('category_name_ar')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('category_name_ar'); ?></div>
      <?php } ?>
    </div>

  </div>



  <div class="form-group row mb-2">

<label class="col-sm-2 col-form-label">Description</label>
<div class="col-sm-2">
<textarea name="category_desc_ma" class="form-control" id="exampleFormControlTextarea4" placeholder="Malayalam" rows=""><?php if(set_value('category_desc_ma')){echo set_value('category_desc_ma');}else if(isset($categoryDet[0]['category_desc_ma'])){echo $categoryDet[0]['category_desc_ma'];}?></textarea>
<?php if(form_error('category_desc_ma')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('category_desc_ma'); ?></div>
  <?php } ?>
</div>
<div class="col-sm-2">
<textarea name="category_desc_en" class="form-control" id="exampleFormControlTextarea4" placeholder="English" rows=""><?php if(set_value('category_desc_en')){echo set_value('category_desc_en');}else if(isset($categoryDet[0]['category_desc_en'])){echo $categoryDet[0]['category_desc_en'];}?></textarea>
<?php if(form_error('category_desc_en')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('category_desc_en'); ?></div>
  <?php } ?>
</div>
<div class="col-sm-3">
<textarea name="category_desc_hi" class="form-control" id="exampleFormControlTextarea4" placeholder="Hindi" rows=""><?php if(set_value('category_desc_hi')){echo set_value('category_desc_hi');}else if(isset($categoryDet[0]['category_desc_hi'])){echo $categoryDet[0]['category_desc_hi'];}?></textarea>
<?php if(form_error('category_desc_hi')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('category_desc_hi'); ?></div>
  <?php } ?>
</div>
<div class="col-sm-3">
<textarea name="category_desc_ar" class="form-control" id="exampleFormControlTextarea4" placeholder="Arabic" rows=""><?php if(set_value('category_desc_ar')){echo set_value('category_desc_ar');}else if(isset($categoryDet[0]['category_desc_ar'])){echo $categoryDet[0]['category_desc_ar'];}?></textarea>
<?php if(form_error('category_desc_ar')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('category_desc_ar'); ?></div>
  <?php } ?>
</div>

</div>
  
  








 

  




 


        
        <div class="form theme-form">
        
          
          

          <!-- row start -->
          <div class="row">
            
            
            
            
              
            
          </div>
          <!-- row end -->
            
            
          </div>
          
      
        
    
          </div>
                </div>
        </div>
        
        

            







      </div>
  </div>

  <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
fffffffffff
  </div> -->
</div>
<button class="btn btn-primary pull-right mb-4" type="submit" name="edit">Save</button>
</form>
                    


                  </div>

        




