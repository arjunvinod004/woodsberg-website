// ADMIN SCRIPTS
//1. Delete country from admin dashboard
//2. Delete store
//3. Change tax value depends on country
//4. Checkbox for store serving modes dining delivery and takeaway
//5. Datepicker contract start end followup dates
//6. Load tables within iframe from add store
//7. Send Pickup,Delivery,Dining test message
//8. Assigning Products from view stores page
//9. Update category order index from list categories
//10. Delete category
//11.Image Cropping from Add Product page
//12. Save product from Add Product page
//13. Delete cookings from admin dashboard
//..   Crop image when edit product from admin dashboard
//14. Delete variants from admin dashboard
//16. Is whatsapp enable in add store 

//OWNER SCRIPTS
//15. Get current date and time in owner dashboard

$(document).ready(function () {
    //alert(1);

    var base_url = 'http://localhost/emigo-restaurant-application/';
    //var base_url = 'https://qr-experts.com/emigo-restaurant-application/';

    //alert(base_url);

  

    //1.Delete country
    $(".del_country").click(function () {
        $('#country_id1').val($(this).data('id'));
    });

    $('#yes_del_country').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + 'admin/country/delete',
            data: { 'id': $('#country_id1').val() },
            success: function (data) {
                window.location.href = base_url + 'admin/country';
            }
        });
    });


    //16. Is whatsapp enable in add store
    $(document).on('click', '#is_whatsapp', function () {
        var isChecked = $(this).is(':checked') ? 1 : 0;
        $('#is_whatsapp_check').val(isChecked);
    })

    //2. Delete store
    $(".del_store").click(function () {
        $('#store_id').val($(this).data('id'));
    });

    $('#yes_del_store').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + 'admin/store/delete',
            data: { 'id': $('#store_id').val() },
            success: function (data) {
                window.location.href = base_url + 'admin/store';
            }
        });
    });

    //alert(111);


    //3. Change tax value depends on country
    $('#country_id').change(function () {
        var country_id = $(this).val();//alert(base_url);
        $.ajax({
            method: "POST",
            url: base_url + 'admin/store/getTaxRates',
            data: { 'country_id': country_id },
            success: function (data) {
                $('#sel_gst_or_tax').html(data);
            }
        });

        $('#sel_gst_or_tax').change(function () {
            var taxRate = $(this).val();

            // alert(taxRate);
            if (taxRate !== '1') {
                $('.textbox').removeClass('d-none'); // Show the textbox group
            } else {
                $('.textbox').addClass('d-none'); // Hide the textbox group
            }
        });
    });


    //4. Checkbox for store serving modes dining delivery and takeaway
    $('#checkbox_pickup_or_take_away').on('click', function () {
        if ($(this).is(':checked')) {
            $('#pickup_hidden').val(1);
        } else {
            $('#pickup_hidden').val(0);
        }
    });

    $('#checkbox_dining').on('click', function () {
        if ($(this).is(':checked')) {
            $('#dining_hidden').val(1);
        } else {
            $('#dining_hidden').val(0);
        }
    });

    $('#checkbox_delivery').on('click', function () {
        if ($(this).is(':checked')) {
            $('#delivery_hidden').val(1);
        } else {
            $('#delivery_hidden').val(0);
        }
    });

    //5. Datepicker contract start end followup dates
    $('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: new Date(), // Set minimum date if needed
        endDate: '+364d' // Set maximum date to 365 days in the future
    }).on('changeDate', function (e) {
        // Get the selected date as a JavaScript Date object
        var selectedDate = e.date;

        // Calculate the date 365 days after the selected date
        var dateAfter365Days = new Date(selectedDate);
        dateAfter365Days.setDate(dateAfter365Days.getDate() + 364);

        // Format the new date as 'yyyy-mm-dd'
        var formattedDateAfter365 =
            dateAfter365Days.getFullYear() + '-' +
            (dateAfter365Days.getMonth() + 1).toString().padStart(2, '0') + '-' +
            dateAfter365Days.getDate().toString().padStart(2, '0');

        // Update another input field with the date 365 days after the selected date in yyyy-mm-dd format
        $('#datepicker1').val(formattedDateAfter365);

        // Calculate the date 365 days after the selected date
        var dateAfter335Days = new Date(selectedDate);
        dateAfter335Days.setDate(dateAfter335Days.getDate() + 335);

        // Format the new date as 'yyyy-mm-dd'
        var formattedDateAfter335 =
            dateAfter335Days.getFullYear() + '-' +
            (dateAfter335Days.getMonth() + 1).toString().padStart(2, '0') + '-' +
            dateAfter335Days.getDate().toString().padStart(2, '0');

        // Update another input field with the date 365 days after the selected date in yyyy-mm-dd format
        $('#datepicker2').val(formattedDateAfter335);
    });


    //6. Load tables within iframe from add store
    $('.store_table').click(function () {
        var storeId = $(this).attr('data-id');
        var storeName = $(this).attr('data-name');
        document.getElementById('modal_title_table').innerHTML = storeName + ' - Tables';
        document.getElementById('table_iframe').src = base_url + 'admin/table/load_store_tables_iframe/' + storeId;
    });




    //7. Send test message dining,pickup,delivery
    $('#send_pickup_test_message').click(function () {
        const phoneNumber = $('#pickup_country_code').val() + $('#txt_pickup_or_take_away')
            .val(); // Replace with the recipient's phone number
        const message = 'Hello, this is a test message!'; // The message to send
        const url = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
        window.open(url, '_blank');
        return false;
    })

    $('#send_dining_test_message').click(function () {
        const phoneNumber = $('#dining_country_code').val() + $('#txt_dining')
            .val(); // Replace with the recipient's phone number
        const message = 'Hello, this is a test message!'; // The message to send
        const url = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
        window.open(url, '_blank');
    })

    $('#send_delivery_test_message').click(function () {
        const phoneNumber = $('#delivery_country_code').val() + $('#txt_delivery')
            .val(); // Replace with the recipient's phone number
        const message = 'Hello, this is a test message!'; // The message to send
        const url = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
        window.open(url, '_blank');
    })


    //8. Assigning Products from view stores page
    $('.product_assign').click(function () {
        var storeId = $(this).attr('data-id'); //alert(storeId);
        var storeName = $(this).attr('data-name');
        document.getElementById('modal_title_table').innerHTML = storeName + ' - Product Assign';
        document.getElementById('table_iframe_product_assign').src = base_url + 'admin/Product_assign/load_products_for_assign/' + storeId;
    });

    //9. Update category order index from list categories
    $('.update_category_order').on('blur', function () {
        const categoryId = this.getAttribute('data-category-id');
        const orderIndex = this.value;
        updateOrderIndex(categoryId, orderIndex);
    });

    function updateOrderIndex(id, order_index) {
        $.ajax({
            url: base_url + 'admin/categories/update_order_index',
            method: 'POST',
            data: {
                id: id,
                order_index: order_index
            },
            success: function (response) { },
            error: function (xhr, status, error) {
                console.error('Error updating order index');
            }
        });
    }

    //10. delete category
    $(".del_category").click(function () {
        $('#category_id').val($(this).data('id'));
    });

    $('#yes_del_category').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + 'admin/categories/delete',
            data: { 'id': $('#category_id').val() },
            success: function (data) {
                window.location.href = base_url + 'admin/categories';
            }
        });
    });


    //13. Delete cookings from admin dashboard
    $(".del_cooking").click(function () {
        alert('click');
        $('#cooking_id').val($(this).data('id'));
    });

    $('#yes_del_cooking').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + 'admin/cooking/delete',
            data: { 'id': $('#cooking_id').val() },
            success: function (data) {
                window.location.href = base_url + 'admin/cooking';
            }
        });
    });

    //14.delete variants from admin dashboard
    $(".del_variant").click(function () {
        //alert('click');
        $('#variant_id').val($(this).data('id'));
    });

    $('#yes_del_variant').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + 'admin/variants/delete',
            data: { 'id': $('#variant_id').val() },
            success: function (data) {
                window.location.href = base_url + 'admin/variants';
            }
        });
    });



    //15. Get current date and time in owner dashboard









    //11.Image Cropping from Add Product page
    const imageInput = document.getElementById("imageInput");
    const imagePreview = document.getElementById("imagePreview");
    const imageEditor = document.getElementById("imageEditor");
    const editorCanvas = document.getElementById("editorCanvas");
    const saveEdit = document.getElementById("saveEdit");
    const closeEditor = document.getElementById("closeEditor");
    let cropper = null;
    let currentImage = null;

    // Handle image input
    imageInput.addEventListener("change", (e) => {
        const files = e.target.files;

        const currentImages = imagePreview.querySelectorAll(".image-container").length;

        // If the total exceeds 5, prevent further action
        if (currentImages + files.length > 5) {
            alert("You can only upload a maximum of 5 images.");
            return;
        }

        Array.from(files).forEach((file) => {
            const reader = new FileReader();
            reader.onload = (event) => {
                const container = document.createElement("div");
                container.classList.add("image-container");

                const img = document.createElement("img");
                img.src = event.target.result;

                const editBtn = document.createElement("button");
                editBtn.textContent = "Edit";
                editBtn.classList.add("edit-btn");
                editBtn.addEventListener("click", () => openEditor(img));

                container.appendChild(img);
                container.appendChild(editBtn);
                imagePreview.appendChild(container);
            };
            reader.readAsDataURL(file);
        });
    });

    // Open image editor
    function openEditor(img) {
        currentImage = img;
        const ctx = editorCanvas.getContext("2d");
        const image = new Image();
        image.src = img.src;
        image.onload = () => {
            editorCanvas.width = image.width / 2;
            editorCanvas.height = image.height / 2;
            ctx.drawImage(image, 0, 0, editorCanvas.width, editorCanvas.height);

            // Initialize Cropper.js
            cropper = new Cropper(editorCanvas, {
                aspectRatio: 1,
                viewMode: 1,
            });
        };

        imageEditor.style.display = "block";
        overlay.style.display = "block";
    }

    // Save edited image
    saveEdit.addEventListener("click", () => {
        if (cropper) {
            const canvas = cropper.getCroppedCanvas();
            currentImage.src = canvas.toDataURL();
            cropper.destroy();
            cropper = null;
            imageEditor.style.display = "none";
        }
    });

    // Close editor
    closeEditor.addEventListener("click", () => {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        imageEditor.style.display = "none";
    });


    //12. Save product from Add Product page
    $('#checkbox_is_customizable').on('click', function () {
        if ($(this).is(':checked')) {
            $('#iscustomizable_hidden').val(1);
        } else {
            $('#iscustomizable_hidden').val(0);
        }
    });

    $('#checkbox_is_addon').on('click', function () {
        if ($(this).is(':checked')) {
            $('#isaddon_hidden').val(1);
        } else {
            $('#isaddon_hidden').val(0);
        }
    });

    $('#saveProduct').click(function () {

        let formData = new FormData($('#productForm')[0]); // Capture the form data, including files

        $.ajax({
            url: base_url + 'admin/Product/save',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the Content-Type header
            success: function (response) {
                console.log(response.success);

                if (response.errors) {
                    if (response.errors.category_id) {
                        $('#category_id_error').html(response.errors.category_id);
                    } else if (response.errors.subcategory_id) {
                        $('#subcategory_id_error').html(response.errors.subcategory_id);
                    } else if (response.errors.product_veg_nonveg) {
                        $('#product_veg_nonveg_error').html(response.errors
                            .product_veg_nonveg);
                    } else if (response.errors.product_name_ma) {
                        $('#product_name_ma_error').html(response.errors.product_name_ma);
                    } else if (response.errors.product_name_en) {
                        $('#product_name_en_error').html(response.errors.product_name_en);
                    } else if (response.errors.product_name_hi) {
                        $('#product_name_hi_error').html(response.errors.product_name_hi);
                    } else if (response.errors.product_name_ar) {
                        $('#product_name_ar_error').html(response.errors.product_name_ar);
                    }
                } else {
                    // alert('success');
                    window.location.href = base_url + 'admin/Product';
                }

            },
            error: function (xhr) {
                $('#response').html('<p>An error occurred: ' + xhr
                    .responseText +
                    '</p>');
            }
        });
    });

    //..   Crop image when edit product
    var cropper1;

    // Trigger cropper modal when image is clicked
    $('.image-to-crop').click(function () {
        var imageSrc = $(this).attr('src');
        var dataId = $(this).attr('id');
        $('#image-to-crop-modal').attr('src', imageSrc);

        // Destroy existing cropper if any
        if (cropper1) {
            cropper1.destroy();
        }

        // Initialize the cropper on the modal image
        $('#cropper-modal').modal('show');
        $('#hiddenImgId').val(dataId);
        var image = document.getElementById('image-to-crop-modal');
        cropper1 = new Cropper(image, {
            aspectRatio: 1, // Optional: change aspect ratio if needed
            viewMode: 1,
            scalable: true,
            zoomable: true,
            movable: true
        });
    });

    // Crop the image and upload
    $('#crop-button').click(function () {
        var croppedCanvas = cropper1.getCroppedCanvas();
        var croppedImage = croppedCanvas.toDataURL('image/jpeg'); // Get cropped image data
        var fileName = 'cropped-image-' + new Date().getTime() + '.jpg';
        $.ajax({
            url: '<?= base_url("admin/Product/update_image") ?>',
            method: 'POST',
            dataType: 'json',
            data: {
                image: croppedImage,
                imageId: $('#hiddenImgId').val(),
                file_name: fileName // Send file name for saving
            },
            success: function (response) {
                console.log(response);

                $('.image-to-crop[src="' + $('#image-to-crop-modal').attr(
                    'src') + '"]')
                    .attr('src', croppedImage);

                // Hide the modal after updating
                $('#cropper-modal').modal('hide');
                if (response.imageId == 'previewImage1') {
                    $('#imghidden1').val(response.filename);
                }
                if (response.imageId == 'previewImage2') {
                    $('#imghidden2').val(response.filename);
                }
                if (response.imageId == 'previewImage3') {
                    $('#imghidden3').val(response.filename);
                }
                if (response.imageId == 'previewImage4') {
                    $('#imghidden4').val(response.filename);
                }
                if (response.imageId == 'previewImage5') {
                    $('#imghidden5').val(response.filename);
                }
            },
            error: function () {
                alert('Failed to update the image.');
            }
        });
    });

    // Handle real-time image preview when files are selected
    function previewImage(inputId, previewImageId, imgHidden) {
        $(inputId).on('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const filename = file.name;
                $(imgHidden).val(filename);
                const reader = new FileReader();
                reader.onload = function (e) {
                    $(previewImageId).attr('src', e.target
                        .result); // Update the preview image
                };
                reader.readAsDataURL(file); // Read the file as a data URL
                var formData = new FormData();
                formData.append("file", file);
                $.ajax({
                    url: '<?= base_url("admin/Product/update_image1") ?>',
                    method: 'POST',
                    data: formData,
                    contentType: false, // Don't set contentType
                    processData: false,
                    success: function (response) { }
                });
            }
        });
    }

    // Bind preview image functionality to file inputs
    previewImage('#preview1', '#previewImage1', '#imghidden1');
    previewImage('#preview2', '#previewImage2', '#imghidden2');
    previewImage('#preview3', '#previewImage3', '#imghidden3');
    previewImage('#preview4', '#previewImage4', '#imghidden4');
    previewImage('#preview5', '#previewImage5', '#imghidden5');















});