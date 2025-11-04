<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<link href="<?php echo base_url();?>assets/admin/css/crm-responsive.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/classic.min.css" rel="stylesheet" /> <!-- 'classic' theme -->
<link href="<?php echo base_url();?>assets/admin/fonts/css/all.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
    type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/icon.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/styles.css" rel="stylesheet" type="text/css" />

<script src="<?php echo base_url();?>assets/admin/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/bootstrap.bundle.min.js"></script>
<style>
.gallery {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    /* Two columns per row */
    gap: 20px;
    max-width: 100%;
    padding: 20px;
}

@media only screen and (min-width:768px) {
    .gallery {
        grid-template-columns: repeat(3, 1fr);
    }
}

.gallery-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    border: 1px solid #ddd;
    padding: 15px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 100%;
}

.gallery-item img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
}

.gallery-item button {
    margin-top: 10px;
    padding: 8px 12px;
    background-color: #6d6f70;
    color: #fff;
    font-size: 14px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    border-radius: 5px !important;
}

.gallery-item button:hover {
    background-color: #0056b3;
}
</style>











<div class="row">





    <input type="hidden" id="store_product_id" name="store_product_id" value="<?php echo $store_product_id; ?>">

    <div class="container">

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


        <div class="row">
            <div class="upload-section">
                <form action="<?php echo base_url('upload/image'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="imageUpload">Upload New Image:</label>
                        <input type="file" name="image" id="imageUpload" class="form-control" accept="image/*" required>
                    </div>
                </form>
            </div>
        </div>
        <div class="row align-items-center">
            <!-- Dropdown column -->

            <div class="gallery">
                <?php foreach ($images as $image) { ?>
                <div class="gallery-item">
                    <img src="<?php echo base_url(); ?>uploads/product/<?php echo $image['default_image']; ?>"
                        style="border: 4px solid #05ab12;">
                    <button class="btn set_default" data-image="<?php echo $image['image1']; ?>"
                        data-id="<?php echo $store_product_id; ?>">Default</button>
                </div>
                <div class="gallery-item">
                    <img src="<?php echo base_url(); ?>uploads/product/<?php echo $image['image1']; ?>">
                    <button class="btn6-small set_default" data-image="<?php echo $image['image1']; ?>"
                        data-id="<?php echo $store_product_id; ?>">Set Default</button>
                </div>
                <div class="gallery-item">
                    <img src="<?php echo base_url(); ?>uploads/product/<?php echo $image['image2']; ?>">
                    <button class="btn6-small set_default" data-image="<?php echo $image['image2']; ?>"
                        data-id="<?php echo $store_product_id; ?>">Set Default</button>
                </div>
                <div class="gallery-item">
                    <img src="<?php echo base_url(); ?>uploads/product/<?php echo $image['image3']; ?>">
                    <button class="btn6-small set_default" data-image="<?php echo $image['image3']; ?>"
                        data-id="<?php echo $store_product_id; ?>">Set Default</button>
                </div>
                <div class="gallery-item">
                    <img src="<?php echo base_url(); ?>uploads/product/<?php echo $image['image4']; ?>">
                    <button class="btn6-small set_default" data-image="<?php echo $image['image4']; ?>"
                        data-id="<?php echo $store_product_id; ?>">Set Default</button>
                </div>
                <?php } ?>
            </div>

        </div>

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
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js">
    </script>

    <script>
    $(document).ready(function() {
        $('.set_default').click(function() {
            var image = $(this).data('image');
            var store_product_id = $(this).data('id'); //alert(image);alert(id);
            $.ajax({
                url: '<?= base_url("owner/product/set_default_image") ?>',
                method: 'POST',
                data: {
                    image: image,
                    store_product_id: store_product_id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        var modalWindow = window.top.document.querySelector(".emigo-modal");
                        if (modalWindow) {
                            modalWindow.style.display = "none";
                            if (window.top !== window.self) {
                                window.top.location.reload();
                            } else {
                                location.reload();
                            }
                        }
                        // $('.message').removeClass('d-none');
                        // $('.message').removeClass('alert alert-danger');
                        // $('.message').addClass('alert alert-success');
                        // $('.message').text('Default product image updated successfully.');
                    }
                }
            });
        });

        // image upload function
        $('#imageUpload').on('change', function() {
            const formData = new FormData();
            const store_product_id = $('#store_product_id').val();
            formData.append('image', this.files[0]); // Appending the image file
            formData.append('id', store_product_id);
            $.ajax({
                url: '<?php echo base_url("owner/product/upload_new_image"); ?>', // Adjust the URL to your route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    //alert(response);
                    if (response.status === 'success') {
                        var modalWindow = window.top.document.querySelector(".emigo-modal");
                        if (modalWindow) {
                            modalWindow.style.display = "none";
                            if (window.top !== window.self) {
                                window.top.location.reload();
                            } else {
                                location.reload();
                            }
                        }
                        // $('.message').removeClass('d-none');
                        // $('.message').removeClass('alert alert-danger');
                        // $('.message').addClass('alert alert-success');
                        // $('.message').text('Default product image updated successfully.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        });

    });
    </script>