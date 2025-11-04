<div class="row">
    <input type="text" name="search" class="form-control mb-3" id="inputtext" placeholder="Enter Your Search Name">
    <div id="resultContainer"></div>


<?php   foreach($products as $val){ ?>
<div class="col-3 
">
<h4 class="text-uppercase responsive-h4"><?php echo $val['product_name_en'];?></h4>
<h5><?php echo $val['rate'];?></h5>
</div>
<?php }?>
</div>

<script>
    $(document).ready(function () {
        // alert("hiii");
        $('#inputtext').on('keyup', function () {
            var inputValue = $(this).val();
            $.ajax({
                url:'<?= base_url("owner/Test/getlikes") ?>',
                type: 'GET', // HTTP method (can be POST if needed)
                data: { search: inputValue }, // Data sent to the controller
                success: function (response) {
                    // Handle successful response
                    console.log(response); // Log the response for debugging
                    $('#resultContainer').html(response); // Update the HTML content of a container
                },
                error: function (xhr, status, error) {
                // Log errors for debugging
                console.error('Error: ' + error);
            }

            })

            //  alert(inputValue);

        })
    })
</script>