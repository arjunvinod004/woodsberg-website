<div class="application-footer">
    <div class="application-footer__container container">

        <div class="application-footer__copyright">

            <h1 class="application-content__page-heading_datetime text-center">
                <!--<i class="fas fa-clock"></i>  -->
                <?php
        $date = new DateTime();
        echo $date->format("h:i A");
        ?>
            </h1>
            <a target="_blank" href="https://coinoneglobal.com/">@ All rights reserved. CoinoneGlobalSolutions 2025</a>
        </div>
        <div class="application-footer__help-desk">
            <div class="application-footer__help-desk-label">
                <img src="<?php echo base_url();?>assets/admin/images/help-desk-icon.svg" alt="help desk icon"
                    class="application-footer__help-desk-label-icon" width="67" height="47">
                <div class="application-footer__help-desk-label-text">Help Desk</div>
            </div>
            <div class="application-footer__help-desk-number-and-email">
                <div class="application-footer__help-desk-number">
                    <img src="<?php echo base_url();?>assets/admin/images/help-desk-phone-icon.svg" alt=""
                        class="application-footer__help-desk-number-icon" width="16" height="17">
                    <a href="tel:+971-7112713311"
                        class="application-footer__help-desk-number-link"><?php echo $support_no; ?></a>
                </div>
                <div class="application-footer__help-desk-email">
                    <img src="<?php echo base_url();?>assets/admin/images/help-desk-email-icon.svg" alt=""
                        class="application-footer__help-desk-email-icon" width="16" height="17">
                    <a class="application-footer__help-desk-email-link"><?php echo $support_email; ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<button id="goToTop" style="display: none; position: fixed; bottom: 20px; right: 20px;">Top</button>

<!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/admin/js/jquery-3.7.1.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/adminscript.js?v=<?php echo time(); ?>"></script>
<script src="<?php echo base_url();?>assets/admin/js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-lite.min.js"></script>
<script>
$(".summernote").summernote({
    height: 150,
    codeviewFilter: false,
    codeviewIframeFilter: true,

    toolbar: [
        ["style", ["style"]],
        ["font", ["bold", "underline", "clear"]],
        ["color", ["color"]],
        ["para", ["ul", "ol", "paragraph"]],
        ["table", ["table"]],
        ["insert", ["link", "picture", "video"]],
        ["view", ["fullscreen", "codeview", "help"]],
    ],
});
</script>
<!-- DataTables CSS -->
</body>

</html>