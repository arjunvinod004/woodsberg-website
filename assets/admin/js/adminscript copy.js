// ADMIN SCRIPTS

//1. add category
// 2. edit category
// 3. update categories
// 4. delete category
// 5. add product
//6. edit product
//7. update product
//8. delete product
//9. add user
//10. edit user
//11. update user
//12. delete user
//13. edit store 
//14. update store
//15. search product
//16. add subcategory
//17. edit subcategory
//18. update subcategory
//19. Update category order index
//20. Update subcategory order index
//21. add subcategory when the category dropdown is changed
//22. edit subcategory when the category dropdown is changed
//23. is home checkbox
//24. bestseller checkbox
//25. seasonal checkbox
//26. is home add checkbox
//27. bestseller add checkbox
//28. seasonal add checkbox
//30. add testimonial
//31. edit testimonial
//32.update testimonial
//33. add brand
//34. edit brand
//35. update brand
//36. delete brand
//37. delete testimonial
//38. delete subcategory
//39. filter data for products against category and subcategory
//40. filter data for products against subcategory
//41. cart quantity increment 
//42. cart quanity decrement
//43. add to cart
//44. add to cart and load cart page
//45. delete items in cart
//46. add coupon
//47. delete coupon
//48. check the coupon code in website
//49. add wishlist
//50.  load dynamic html for wishlist after count
//51. add category when is home checkbox is clicked
//52. edit category when is home checkbox is clicked
//53. add category when is footer checkbox is clicked
//54. edit category when is footer checkbox is clicked
//55. cart page quanity increment
//56. cart page quanity decrement
//57. delete items in wishlist
//58. count in wishlist
//59. current row identify remove readonly attr in shipping admin side
//60. shipping  rate update in onblur admin side
//61. update shipping rate in website when the state dropdown selected
//62. checkout add user details
//63. view order  details in admin side popup
//64. add slider
//65. edit slider
//66. update slider
//67. delete slider
//73. stock checking in home page
//74.stock checking in cart page







$(document).ready(function () {
    //alert(1);
    var base_url = 'http://localhost/codeigniter/woodsberg-application/';
    //    var base_url = 'https://woodsberg.com/woodsberg/';


    $(document).on('click', '.emigo-close-btn , .reload-close-btn, .emigo-btn', function () {
        location.reload();
    });

    //1. add category
    $('#add_category').click(function (e) {
        // Prevent the default action
        e.preventDefault();

        // For iOS compatibility, explicitly create FormData with each field
        let formData = new FormData();

        // Manually add each form field to FormData
        $('#addCategories').find('input, select, textarea').each(function () {
            let input = $(this);
            let name = input.attr('name');

            // Handle file inputs separately
            if (input.attr('type') === 'file') {
                if (input[0].files.length > 0) {
                    formData.append(name, input[0].files[0]);
                }
            } else {
                formData.append(name, input.val());
            }
        });

        // Ensure the request is sent with cache prevention
        $.ajax({
            url: base_url + 'admin/Categories/add',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false, // Prevent caching
            success: function (response) {
                // The rest of your success handler remains the same
                if (response.success === 'success') {
                    setTimeout(function () {
                        $('#add-category').modal('hide');
                        $('#successModal .modal-body').text('Category saved successfully');
                        $('#successModal').modal('show');
                        $('#addCategories')[0].reset();
                        $('#other_textbox').hide();
                        $('#category_order_error').html('');
                        $('#category_name_error').html('');
                        $('#category_userfile_error').html('');
                        $('#category_desc_error').html('');
                        $('#general_error').html('');
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            location.reload();
                        }, 1000);
                    }, 1000);
                } else {
                    // Error handling code remains the same
                    $('#category_order_error').html('');
                    $('#category_name_error').html('');
                    $('#category_userfile_error').html('');
                    $('#category_desc_error').html('');

                    if (typeof response.errors === 'string') {
                        $('#general_error').html(response.errors);
                    } else if (response.errors.duplicate) {
                        $('#general_error').html(response.errors.duplicate);
                    } else {
                        if (response.errors.category_order) {
                            $('#category_order_error').html(response.errors.category_order);
                        }

                        if (response.errors.userfile) {
                            $('#category_userfile_error').html(response.errors.userfile);
                        }

                        if (response.errors.category_name) {
                            $('#category_name_error').html(response.errors.category_name);
                        }

                        if (response.errors.category_desc) {
                            $('#category_desc_error').html(response.errors.category_desc);
                        }
                    }
                }
            },
            error: function (xhr, status, error) {
                console.log('AJAX Error:', xhr.responseText);
                alert('An error occurred while submitting the form.');
            }
        });
    });
    // $('#add_category').click(function (e) {
    //     let formData = new FormData($('#addCategories')[0]); // Capture form data
    //     console.log(formData);
    //     $.ajax({
    //         url: base_url + 'admin/Categories/add',
    //         type: 'POST',
    //         data: formData,
    //         dataType: 'json',
    //         processData: false,
    //         contentType: false,
    //         success: function (response) {
    //             // console.log(response);

    //             if (response.success === 'success') {

    //                 setTimeout(function () {
    //                     // window.location.href = base_url + 'admin/Enquiry/success';
    //                     $('#add-category').modal('hide');
    //                     $('#successModal .modal-body').text('Category saved successfully');
    //                     $('#successModal').modal('show');
    //                     $('#addCategories')[0].reset();
    //                     $('#other_textbox').hide();
    //                     $('#category_order_error').html('')
    //                     $('#category_name_error').html('')
    //                     $('#category_userfile_error').html('')
    //                     $('#category_desc_error').html('')
    //                     // category_name_desc_ma_error
    //                     $('#general_error').html('')
    //                     setTimeout(function () {
    //                         $('#successModal').modal('hide');
    //                         // window.location.href = base_url + 'admin/categories';
    //                         location.reload(); 
    //                     }, 1000);
    //                 }, 1000);
    //             } else {

    //                 $('#category_order_error').html('')
    //                 $('#category_name_error').html('')
    //                 $('#category_userfile_error').html('')
    //                 $('#category_desc_error').html('')
    //                 // Check if this is a duplicate entry error
    //                 if (typeof response.errors === 'string') {
    //                     // Display the general error message somewhere
    //                     $('#general_error').html(response.errors);
    //                 } else if (response.errors.duplicate) {
    //                     // Display the duplicate entry error
    //                     $('#general_error').html(response.errors.duplicate);
    //                 }
    //                 else {
    //                     // Handle field-specific validation errors


    //                     if (response.errors.category_order) {
    //                         $('#category_order_error').html(response.errors.category_order);
    //                     } else {
    //                         $('#category_order_error').html('');
    //                     }

    //                     if (response.errors.userfile) {
    //                         $('#category_userfile_error').html(response.errors.userfile);
    //                     }
    //                     else {
    //                         $('#category_userfile_error').html('');
    //                     }


    //                     if (response.errors.category_name) {
    //                         $('#category_name_error').html(response.errors.category_name);
    //                     }
    //                     else {
    //                         $('#category_name_error').html('');
    //                     }


    //                     if (response.errors.category_desc) {
    //                         $('#category_desc_error').html(response.errors.category_desc);
    //                     }
    //                     else {
    //                         $('#category_desc_error').html('');
    //                     }

    //                 }
    //             }
    //         },
    //         error: function (xhr, status, error) {
    //             // Handle error
    //             alert('An error occurred while submitting the form.');
    //         }
    //     });
    // })


    // 2. edit category

    $(".edit_category").click(function (e) {
        var id = $(this).attr('data-id');
        // alert(id);
        $('#hidden_category_id').val(id);
        $.ajax({
            url: base_url + 'admin/Categories/edit',
            type: 'POST',
            data: { 'id': id },
            dataType: 'json',
            success: function (response) {
                console.log(response.data);
                if (response.success === 'success') {
                    $('#category_order').val(response.data.order_index);
                    $('#existing_userfile').val(response.data.category_img);
                    $('#category_name').val(response.data.category_name);
                    $('#category_desc').val(response.data.category_desc);
                    $('#is_edit_header_category_hidden').val(response.data.is_header);
                    $('#is_edit_footer_category_hidden').val(response.data.is_footer);

                    if (response.data.is_header == 1) {
                        $('#is_edit_header_category').prop('checked', true);
                    }
                    else {
                        $('#is_edit_header_category').prop('checked', false);
                    }

                    if (response.data.is_footer == 1) {
                        $('#is_edit_footer_category').prop('checked', true);
                    }
                    else {
                        $('#is_edit_footer_category').prop('checked', false);
                    }


                    let imagePath = base_url + 'uploads/categories/' + response.data.category_img;
                    $('#preview_img').attr('src', imagePath);
                }
                else {
                    // alert('tax data not found!');
                }
            }
        })

    });


    // 3. update categories

    $('#save_category').click(function (e) {
        var save_tax = $('#hidden_category_id').val();
        let formData = new FormData($('#edit_categories')[0]);
        formData.append('hidden_category_id', save_tax);


        $.ajax({
            url: base_url + "admin/categories/updatecategorydetails",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the Content-Type header
            success: function (response) {
                console.log(response);
                if (response.success === 'success') {
                    setTimeout(function () {
                        $('#successModal .modal-body').text('category Updated successfully');
                        $('#successModal').modal('show');
                        $('#edit-category').modal('hide');
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            location.reload(); // This reloads the whole page
                        }, 1000)
                    }, 1000)

                }
                else {


                    if (response.errors.category_order) {
                        $('#category_edit_order_error').html(response.errors.category_order);
                    } else {
                        $('#category_edit_order_error').html('');
                    }

                    if (response.errors.userfile) {
                        $('#category_edit_userfile_error').html(response.errors.userfile);
                    }
                    else {
                        $('#category_edit_userfile_error').html('');
                    }


                    if (response.errors.category_name) {
                        $('#category_edit_name_error').html(response.errors.category_name);
                    }
                    else {
                        $('#category_edit_name_error').html('');
                    }



                    if (response.errors.category_desc) {
                        $('#category_edit_desc_error').html(response.errors.category_desc);
                    }
                    else {
                        $('#category_edit_desc_error').html('');
                    }


                    if (response.errors) {
                        // alert(response.errors);
                    }
                }
            },
            error: function (xhr) {
                $('#response').html('<p>An error occurred: ' + xhr
                    .responseText +
                    '</p>');
            }
        });
    });


    // 4. delete category

    $(".del_category").click(function (e) {
        var id = $(this).attr('data-id');
        $('#delete_cat_id').val(id);
    });

    $('#yes_cat_user').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + "admin/Categories/DeleteCategory",
            data: {
                'id': $('#delete_cat_id').val()
            },
            success: function (data) {
                console.log(data);
                window.location.href = '';
            }
        });
    });


    // 5. add product

    $(document).ready(function () {
        $('#add_product').click(function (e) {
            e.preventDefault(); // Prevent default form submission - crucial for iOS

            // Check if FormData is supported
            if (window.FormData === undefined) {
                alert('Your browser does not support FormData. Please upgrade to a newer browser.');
                return;
            }

            try {
                var form = $('#add-new-product')[0];
                var formData = new FormData(form);

                // Log form data for debugging
                console.log('Form data created:', formData);

                // Disable the submit button to prevent multiple submissions
                $('#add_product').prop('disabled', true);

                $.ajax({
                    url: base_url + 'admin/Product/add',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    cache: false, // Important for iOS
                    timeout: 60000, // Add timeout to handle slow connections
                    beforeSend: function () {
                        // Show loading indicator if needed
                        // $('#loading').show();
                    },
                    success: function (response) {
                        if (response.success === 'success') {
                            // Clear all error messages
                            clearAllErrorMessages();

                            setTimeout(function () {
                                $('#add-new-product')[0].reset();
                                // location.reload();
                                window.location.href = base_url + 'admin/product/';
                            }, 1000);
                        } else {
                            // Re-enable the submit button
                            $('#add_product').prop('disabled', false);

                            // Clear all error messages first
                            clearAllErrorMessages();

                            // Check if this is a duplicate entry error
                            if (typeof response.errors === 'string') {
                                $('#general_error').html(response.errors);
                            } else if (response.errors && response.errors.duplicate) {
                                $('#general_error').html(response.errors.duplicate);
                            } else if (response.errors) {
                                // Handle field-specific validation errors
                                displayValidationErrors(response.errors);
                            }
                        }
                    },
                    error: function (xhr, status, error) {
                        // Re-enable the submit button
                        $('#add_product').prop('disabled', false);

                        console.log('Ajax error:', xhr, status, error);
                        alert('An error occurred while submitting the form. Please try again.');

                        // Optional: Display more detailed error info for debugging
                        if (xhr.responseText) {
                            try {
                                var jsonResponse = JSON.parse(xhr.responseText);
                                console.log('Error details:', jsonResponse);
                            } catch (e) {
                                console.log('Error parsing response:', e);
                            }
                        }
                    },
                    complete: function () {
                        // Hide loading indicator if you showed one
                        // $('#loading').hide();
                    }
                });
            } catch (e) {
                console.error('Error creating FormData:', e);
                alert('An error occurred while preparing the form data. Please try again.');
                $('#add_product').prop('disabled', false);
            }
        });

        // Helper function to clear all error messages
        function clearAllErrorMessages() {
            $('#category_id_error').html('');
            $('#product_name_error').html('');
            $('#product_wholesale_price_error').html('');
            $('#product_retail_price_error').html('');
            $('#product_franchise_price_error').html('');
            $('#product_description_error').html('');
            $('#product_weight_error').html('');
            $('#product_image_error').html('');
            $('#product_image1_error').html('');
            $('#product_image2_error').html('');
            $('#product_image3_error').html('');
            $('#general_error').html('');
            $('#subcategory_id_error').html('');
            $('#product_weight_type_error').html('');
        }

        // Helper function to display validation errors
        function displayValidationErrors(errors) {
            // Map of error fields to their corresponding HTML elements
            var errorFields = {
                'category_id': '#category_id_error',
                'subcategory_id': '#subcategory_id_error',
                'product_name': '#product_name_error',
                'product_wholesale_price': '#product_wholesale_price_error',
                'product_retail_price': '#product_retail_price_error',
                'product_franchise_price': '#product_franchise_price_error',
                'product_description': '#product_description_error',
                'product_weight': '#product_weight_error',
                'product_weight_type': '#product_weight_type_error',
                'image1': '#product_image_error',
                'image2': '#product_image1_error',
                'image3': '#product_image2_error',
                'image4': '#product_image3_error'
            };

            // Display each error in its corresponding element
            for (var field in errors) {
                if (errorFields[field]) {
                    $(errorFields[field]).html(errors[field]);
                }
            }
        }
    });

    //6. edit product

    $(document).on('click', '.edit_product', function () {
        var id = $(this).attr('data-id');
        // alert(id);
        $('#hidden_product_id').val(id);
        $.ajax({
            url: base_url + 'admin/Product/edit',
            type: 'POST',
            data: { 'id': id },
            dataType: 'json',
            success: function (response) {
                console.log(response.data);
                if (response.success === 'success') {
                    $('#category_id').val(response.data.category_id);
                    $('#subcategory_id').val(response.data.subcategory_id);
                    $('#product_name').val(response.data.product_name);
                    // $('#price').val(response.data.price);
                    $('#product_wholesale_price').val(response.data.wholesale_price);
                    $('#product_retail_price').val(response.data.retail_price);
                    $('#product_franchise_price').val(response.data.franchise_price);
                    // $('#product_description').val(response.data.description);
                    $('#product_description').summernote('code', response.data.description);

                    $('#product_weight').val(response.data.weight);
                    $('#product_weight_type').val(response.data.kg_g);
                    $('#image_id').val(response.data.image);
                    $('#image_id1').val(response.data.image1);
                    $('#image_id2').val(response.data.image2);
                    $('#image_id3').val(response.data.image3);
                    $('#is_home_edit_hidden').val(response.data.is_home);
                    $('#is_bestseller_edit_hidden').val(response.data.is_bestseller);
                    $('#is_seasonaloffer_edit_hidden').val(response.data.is_seasonaloffer);
                    $('#out_of_stock_edit_hidden').val(response.data.out_of_stock);
                    if (response.data.is_home == 1) {
                        $('#is_home_edit').prop('checked', true);
                    }
                    else {
                        $('#is_home_edit').prop('checked', false);
                    }

                    if (response.data.is_bestseller == 1) {
                        $('#is_bestseller_edit').prop('checked', true);
                    } else {
                        $('#is_bestseller_edit').prop('checked', false);
                    }

                    if (response.data.is_seasonaloffer == 1) {
                        $('#is_seasonaloffer_edit').prop('checked', true);
                    }
                    else {
                        $('#is_seasonaloffer_edit').prop('checked', false);
                    }

                    if (response.data.out_of_stock == 1) {
                        $('#out_of_stock_edit').prop('checked', true);
                    }
                    else {
                        $('#out_of_stock_edit').prop('checked', false);
                    }

                    // if(response.data.out_of_stock == 1){
                    //     $('#out_of_stock_edit').prop('checked', true);
                    // }
                    // else{
                    //     $('#out_of_stock_edit').prop('checked', false);
                    // }
                    // $('#is_home_edit_hidden').val(response.data.is_home);
                    // $('#is_bestseller_edit_hidden').val(response.data.is_bestseller);
                    // $('#is_seasonaloffer_edit_hidden').val(response.data.is_seasonaloffer);


                    let imagePath = base_url + 'uploads/product/' + response.data.image;
                    $('#previewImage').attr('src', imagePath);
                    let imagePath1 = base_url + 'uploads/product/' + response.data.image1;
                    $('#previewImage1').attr('src', imagePath1);
                    let imagePath2 = base_url + 'uploads/product/' + response.data.image2;
                    $('#previewImage2').attr('src', imagePath2);
                    let imagePath3 = base_url + 'uploads/product/' + response.data.image3;
                    $('#previewImage3').attr('src', imagePath3);
                }
                else {
                    // alert('tax data not found!');
                }
            }
        })
    })




    //7. update product

    $('#save_product').click(function (e) {
        var saveproduct = $('#hidden_product_id').val();
        let formData = new FormData($('#edit_products')[0]);
        formData.append('hidden_product_id', saveproduct);
        $.ajax({
            url: base_url + "admin/Product/updateproductdetails",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the Content-Type header
            success: function (response) {
                console.log(response);
                if (response.success === 'success') {
                    setTimeout(function () {
                        $('#successModal .modal-body').text('Product Updated successfully');
                        $('#successModal').modal('show');
                        $('#Edit-Product').modal('hide');
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            location.reload(); // This reloads the whole page
                        }, 1000)
                    }, 1000)

                }
                else {


                    if (response.errors.category_id) {
                        $('#category_edit_error').html(response.errors.category_id);
                    } else {
                        $('#category_edit_error').html('');
                    }


                    if (response.errors.subcategory_id) {
                        $('#subcategory_id_edit_error').html(response.errors.subcategory_id);
                    } else {
                        $('#subcategory_id_edit_error').html('');
                    }

                    if (response.errors.product_name) {
                        $('#product_edit_name_error').html(response.errors.product_name);
                    }
                    else {
                        $('#product_edit_name_error').html('');
                    }


                    if (response.errors.price) {
                        $('#price_edit_error').html(response.errors.price);
                    }
                    else {
                        $('#price_edit_error').html('');
                    }

                    if (response.errors.product_wholesale_price) {
                        $('#product_wholesale_price_edit_error').html(response.errors.product_wholesale_price);
                    }
                    else {
                        $('#product_wholesale_price_edit_error').html('');
                    }

                    if (response.errors.product_retail_price) {
                        $('#product_retail_price_edit_error').html(response.errors.product_retail_price);
                    }
                    else {
                        $('#product_retail_price_edit_error').html('');
                    }

                    if (response.errors.product_franchise_price) {
                        $('#product_franchise_price_edit_error').html(response.errors.product_franchise_price);
                    }
                    else {
                        $('#product_franchise_price_edit_error').html('');
                    }

                    if (response.errors.product_description) {
                        $('#product_description_edit_error').html(response.errors.product_description);
                    }
                    else {
                        $('#product_description_edit_error').html('');
                    }


                    if (response.errors.product_weight) {
                        $('#product_weight_edit_error').html(response.errors.product_weight);
                    }
                    else {
                        $('#product_weight_edit_error').html('');
                    }





                    if (response.errors.image) {
                        $('#product_image_error').html(response.errors.image);
                    }
                    else {
                        $('#product_image_error').html('');
                    }

                    if (response.errors.image1) {
                        $('#product_image1_error').html(response.errors.image1);
                    }
                    else {
                        $('#product_image1_error').html('');
                    }

                    if (response.errors.image2) {
                        $('#product_image2_error').html(response.errors.image2);
                    }
                    else {
                        $('#product_image2_error').html('');
                    }

                    if (response.errors.image3) {
                        $('#product_image3_error').html(response.errors.image3);
                    }
                    else {
                        $('#product_image3_error').html('');
                    }



                    if (response.errors) {
                        // alert(response.errors);
                    }
                }
            },
            error: function (xhr) {
                $('#response').html('<p>An error occurred: ' + xhr
                    .responseText +
                    '</p>');
            }
        });


    });


    //8. delete product

    $(document).on('click', '.remove_product', function () {
        var id = $(this).attr('data-id');
        // alert(id);
        $('#delete_product_id').val(id);
    })

    $('#yes_product_user').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + "admin/Product/DeleteProduct",
            data: {
                'id': $('#delete_product_id').val()
            },
            success: function (data) {
                console.log(data);
                window.location.href = '';
            }
        });
    });


    //9. add user

    $('#add_user').click(function (e) {
        // alert(1);
        let formData = new FormData($('#add-new-user')[0]); // Capture form data
        //  console.log(formData);
        $.ajax({
            url: base_url + 'admin/User/add',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                if (response.success === 'success') {
                    setTimeout(function () {
                        $('#successModal .modal-body').text('User added successfully');
                        $('#successModal').modal('show');
                        $('#add-user').modal('hide');
                        $('#add-new-user')[0].reset();
                        $('#user_name_error').html('')
                        $('#user_email_error').html('')
                        $('#user_phoneno_error').html('')
                        $('#user_password_error').html('')
                        $('#user_role_error').html('')
                        $('#general_error').html('')
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            location.reload();
                        }, 1000)
                    }, 1000);
                }

                else {
                    $('#user_name_error').html('');
                    $('#user_email_error').html('');
                    $('#user_phoneno_error').html('');
                    $('#user_password_error').html('');
                    $('#user_role_error').html('');
                    $('#user_username_error').html('');
                    $('#general_error').html('');
                    if (response.errors) {
                        $('#general_error').html(response.errors);
                    }
                    else {
                        $('#general_error').html('');
                    }
                    if (response.errors.user_name) {
                        $('#user_name_error').html(response.errors.user_name);
                    }
                    else {
                        $('#user_name_error').html('');
                    }
                    if (response.errors.user_email) {
                        $('#user_email_error').html(response.errors.user_email);
                    }
                    else {
                        $('#user_email_error').html('');
                    }
                    if (response.errors.user_phoneno) {
                        $('#user_phoneno_error').html(response.errors.user_phoneno);
                    }
                    else {
                        $('#user_phoneno_error').html('');
                    }
                    if (response.errors.user_password) {
                        $('#user_password_error').html(response.errors.user_password);
                    }
                    else {
                        $('#user_password_error').html('');
                    }

                    if (response.errors.user_username) {
                        $('#user_username_error').html(response.errors.user_username);
                    }
                    else {
                        $('#user_username_error').html('');
                    }
                    if (response.errors.user_role) {
                        $('#user_role_error').html(response.errors.user_role);
                    }
                    else {
                        $('#user_role_error').html('');
                    }

                }
            },
            error: function (xhr, status, error) {
                // Handle error
                alert('An error occurred while submitting the form.');
            }
        });
    })


    //10. edit user

    $(".edit_user").click(function (e) {
        var id = $(this).attr('data-id');
        // alert(id);
        $('#hidden_user_id').val(id);
        $.ajax({
            url: base_url + 'admin/User/edit',
            type: 'POST',
            data: { 'id': id },
            dataType: 'json',
            success: function (response) {
                console.log(response.data);
                if (response.success === 'success') {
                    $('#user_name').val(response.data.Name);
                    // $('#user_password').val(response.data.userPassword);
                    $('#user_email').val(response.data.userEmail);
                    $('#user_phoneno').val(response.data.UserPhoneNumber);
                    $('#user_username').val(response.data.userName);
                    $('#user_role').val(response.data.userroleid);
                    let imagePath = base_url + 'uploads/categories/' + response.data.category_img;
                    $('#preview_img').attr('src', imagePath);
                }
                else {
                    // alert('tax data not found!');
                }
            }
        })

    });


    //11. update user

    $('#update_user').click(function (e) {
        var saveuser = $('#hidden_user_id').val();
        let formData = new FormData($('#edit_new_user')[0]); // Capture form data
        formData.append('hidden_user_id', saveuser);
        // alert(1);

        //  console.log(formData);
        $.ajax({
            url: base_url + 'admin/User/update',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                if (response.success === 'success') {
                    setTimeout(function () {
                        $('#successModal .modal-body').text('User Updated successfully');
                        $('#successModal').modal('show');
                        $('#edit-user').modal('hide');
                        $('#edit_new_user')[0].reset();
                        $('#user_edit_name_error').html('')
                        $('#user_edit_email_error').html('')
                        $('#user_edit_phoneno_error').html('')
                        $('#user_edit_password_error').html('')
                        $('#user_edit_role_error').html('')
                        $('#user_edit_username_error').html('');
                        $('#general_error').html('')
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            location.reload();
                        }, 1000)
                    }, 1000);
                }

                else {
                    $('#user_edit_name_error').html('')
                    $('#user_edit_email_error').html('')
                    $('#user_edit_phoneno_error').html('')
                    $('#user_edit_password_error').html('')
                    $('#user_edit_role_error').html('')
                    $('#user_edit_username_error').html('');
                    $('#general_error').html('');
                    if (response.errors) {
                        $('#general_error').html(response.errors);
                    }
                    else {
                        $('#general_error').html('');
                    }
                    if (response.errors.user_name) {
                        $('#user_edit_name_error').html(response.errors.user_name);
                    }
                    else {
                        $('#user_edit_name_error').html('');
                    }
                    if (response.errors.user_email) {
                        $('#user_edit_email_error').html(response.errors.user_email);
                    }
                    else {
                        $('#user_edit_email_error').html('');
                    }
                    if (response.errors.user_phoneno) {
                        $('#user_edit_phoneno_error').html(response.errors.user_phoneno);
                    }
                    else {
                        $('#user_edit_phoneno_error').html('');
                    }
                    if (response.errors.user_password) {
                        $('#user_edit_password_error').html(response.errors.user_password);
                    }
                    else {
                        $('#user_edit_password_error').html('');
                    }

                    if (response.errors.user_username) {
                        $('#user_edit_username_error').html(response.errors.user_username);
                    }
                    else {
                        $('#user_edit_username_error').html('');
                    }
                    if (response.errors.user_role) {
                        $('#user_edit_role_error').html(response.errors.user_role);
                    }
                    else {
                        $('#user_edit_role_error').html('');
                    }

                }
            },
            error: function (xhr, status, error) {
                // Handle error
                alert('An error occurred while submitting the form.');
            }
        });
    })

    //12. delete user
    $(".del_user").click(function (e) {
        var id = $(this).attr('data-id');
        // alert(id);
        $('#delete_user_id').val(id);
    });

    $('#yes_delete_user').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + "admin/User/Delete",
            data: {
                'id': $('#delete_user_id').val()
            },
            success: function (data) {
                console.log(data);
                window.location.href = '';
            }
        });
    });

    //13. edit store   

    $(".edit_store").click(function (e) {
        var id = $(this).attr('data-id');
        // alert(id);
        $('#hidden_store_id').val(id);
        $.ajax({
            url: base_url + 'admin/Store/edit',
            type: 'POST',
            data: { 'id': id },
            dataType: 'json',
            success: function (response) {
                console.log(response.data);
                if (response.success === 'success') {
                    $('#store_disp_name').val(response.data.store_disp_name);
                    $('#store_name').val(response.data.store_name);
                    $('#store_desc').val(response.data.store_desc);
                    $('#store_address').val(response.data.store_address);
                    $('#store_email').val(response.data.store_email);
                    $('#store_phoneno').val(response.data.store_phone);
                    $('#store_opening_time').val(response.data.store_opening_time);
                    $('#store_closing_time').val(response.data.store_closing_time);
                    $('#store_country').val(response.data.store_country);
                    $('#store_gst_tax').val(response.data.gst_or_tax);
                    $('#store_logo_image').val(response.data.store_logo_image);
                    let imagePath = base_url + 'uploads/store/' + response.data.store_logo_image;
                    $('#storeimage').attr('src', imagePath);
                }
                else {
                    // alert('tax data not found!');
                }
            }
        })

    });


    //14. update store

    $('#update_store').click(function (e) {
        var saveproduct = $('#hidden_store_id').val();
        let formData = new FormData($('#edit_new_store')[0]);
        formData.append('hidden_store_id', saveproduct);
        $.ajax({
            url: base_url + "admin/Store/update",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the Content-Type header
            success: function (response) {
                console.log(response);
                if (response.success === 'success') {
                    setTimeout(function () {
                        $('#successModal .modal-body').text('Store Updated successfully');
                        $('#successModal').modal('show');
                        $('#edit-store').modal('hide');
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            location.reload(); // This reloads the whole page
                        }, 1000)
                    }, 1000)

                }
                else {


                    if (response.errors.store_name) {
                        $('#store_edit_name_error').html(response.errors.store_name);
                    } else {
                        $('#store_edit_name_error').html('');
                    }

                    if (response.errors.store_disp_name) {
                        $('#store_edit_disp_name_error').html(response.errors.store_disp_name);
                    }
                    else {
                        $('#store_edit_disp_name_error').html('');
                    }


                    if (response.errors.store_desc) {
                        $('#store_edit_desc_error').html(response.errors.store_desc);
                    }
                    else {
                        $('#store_edit_desc_error').html('');
                    }

                    if (response.errors.store_address) {
                        $('#store_edit_address_error').html(response.errors.store_address);
                    }
                    else {
                        $('#store_edit_address_error').html('');
                    }

                    if (response.errors.store_email) {
                        $('#store_edit_email_error').html(response.errors.store_email);
                    }
                    else {
                        $('#store_edit_email_error').html('');
                    }




                    if (response.errors.store_phoneno) {
                        $('#store_edit_phoneno_error').html(response.errors.store_phoneno);
                    }
                    else {
                        $('#store_edit_phoneno_error').html('');
                    }

                    if (response.errors.store_opening_time) {
                        $('#store_edit_opening_time_error').html(response.errors.store_opening_time);
                    }
                    else {
                        $('#store_edit_opening_time_error').html('');
                    }

                    if (response.errors.store_closing_time) {
                        $('#store_edit_closing_time_error').html(response.errors.store_closing_time);
                    }
                    else {
                        $('#store_edit_closing_time_error').html('');
                    }

                    if (response.errors.store_country) {
                        $('#store_edit_country_error').html(response.errors.store_country);
                    }
                    else {
                        $('#store_edit_country_error').html('');
                    }

                    if (response.errors.store_gst_tax) {
                        $('#store_edit_gst_tax_error').html(response.errors.store_gst_tax);
                    }
                    else {
                        $('#store_edit_gst_tax_error').html('');
                    }


                    if (response.errors.store_gst_tax) {
                        $('#store_edit_gst_tax_error').html(response.errors.store_gst_tax);
                    }
                    else {
                        $('#store_edit_gst_tax_error').html('');
                    }

                    if (response.errors.store_logo) {
                        $('#store_logo_error').html(response.errors.store_logo);
                    }
                    else {
                        $('#store_logo_error').html('');
                    }



                    if (response.errors) {
                        // alert(response.errors);
                    }
                }
            },
            error: function (xhr) {
                $('#response').html('<p>An error occurred: ' + xhr
                    .responseText +
                    '</p>');
            }
        });


    });


    //15. search product in admin side

    $('#search_product').on('keyup', function () {
        var search = $(this).val();   //alert(search);
        $.ajax({
            url: base_url + "admin/Product/searchProductOnKeyUp",
            type: 'GET', // HTTP method (can be POST if needed)
            data: {
                search: search
            }, // Data sent to the controller
            success: function (response) {
                console.log(response); // Log the response for debugging
                $('#search_result_container').html(response); // Update the HTML content of a container
            },
            error: function (xhr, status, error) {
                console.error('Error: ' + error);
            }
        })
    });


    //16. add subcategory

    $('#add_subcategory').click(function (e) {
        let formData = new FormData($('#addsubcategories')[0]); // Capture form data
        // console.log(formData);
        $.ajax({
            url: base_url + 'admin/Categories/addsubcategories',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                //  console.log(response);

                if (response.success === 'success') {

                    setTimeout(function () {
                        // window.location.href = base_url + 'admin/Enquiry/success';
                        $('#add-subcategory').modal('hide');
                        $('#successModal .modal-body').text('subcategory saved successfully');
                        $('#successModal').modal('show');
                        $('#addsubcategories')[0].reset();
                        $('#other_textbox').hide();
                        $('#subcategory_id_error').html('')
                        $('#subcategory_name_error').html('')
                        $('#subcategory_userfile_error').html('');
                        $('#general_error').html('')
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            // window.location.href = base_url + 'admin/categories';
                            location.reload();
                        }, 1000);
                    }, 1000);
                } else {

                    $('#subcategory_id_error').html('')
                    $('#subcategory_name_error').html('')
                    $('#subcategory_userfile_error').html('');
                    $('#general_error').html('')
                    // Check if this is a duplicate entry error
                    if (typeof response.errors === 'string') {
                        // Display the general error message somewhere
                        $('#general_error').html(response.errors);
                    } else if (response.errors.duplicate) {
                        // Display the duplicate entry error
                        $('#general_error').html(response.errors.duplicate);
                    }
                    else {
                        // Handle field-specific validation errors

                        if (response.errors.subcategory_id) {
                            $('#subcategory_id_error').html(response.errors.subcategory_id);
                        }
                        else {
                            $('#subcategory_id_error').html('');
                        }

                        if (response.errors.subcategory_name) {
                            $('#subcategory_name_error').html(response.errors.subcategory_name);
                        }
                        else {
                            $('#subcategory_name_error').html('');
                        }

                        if (response.errors.subcategory_userfile) {
                            $('#subcategory_userfile_error').html(response.errors.subcategory_userfile);
                        }
                        else {
                            $('#subcategory_userfile_error').html('');
                        }

                    }
                }
            },
            error: function (xhr, status, error) {
                // Handle error
                alert('An error occurred while submitting the form.');
            }
        });
    })





    //17. edit subcategory

    $(".edit_subcategory").click(function (e) {
        var id = $(this).attr('data-id');
        // alert(id);
        $('#hidden_subcategory_id').val(id);
        $.ajax({
            url: base_url + 'admin/Categories/editsubcategories',
            type: 'POST',
            data: { 'id': id },
            dataType: 'json',
            success: function (response) {
                console.log(response.data);
                if (response.success === 'success') {
                    $('#subcategory_order').val(response.data.order_index);
                    $('#subcategory_id').val(response.data.category_id);
                    $('#subcategory_name').val(response.data.name);
                    $('#existing_subcategory_userfile').val(response.data.image);
                    let imagesubPath = base_url + 'uploads/subcategories/' + response.data.image;
                    $('#preview_subcategory_img').attr('src', imagesubPath);
                }
                else {
                    // alert('tax data not found!');
                }
            }
        })

    });

    //18. update subcategory

    $('#save_subcategory').click(function (e) {
        var save_subcategory = $('#hidden_subcategory_id').val();
        let formData = new FormData($('#edit_subcategories')[0]);
        formData.append('hidden_subcategory_id', save_subcategory);

        $.ajax({
            url: base_url + "admin/categories/updatesubcategories",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the Content-Type header
            success: function (response) {
                console.log(response);
                if (response.success === 'success') {
                    setTimeout(function () {
                        $('#successModal .modal-body').text('Subcategory Updated successfully');
                        $('#successModal').modal('show');
                        $('#edit-subcategory').modal('hide');
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            location.reload(); // This reloads the whole page
                        }, 1000)
                    }, 1000)

                }
                else {




                    if (response.errors.subcategory_id) {
                        $('#subcategory_id_edit_error').html(response.errors.subcategory_id);
                    }
                    else {
                        $('#subcategory_edit_id_error').html('');
                    }



                    if (response.errors.subcategory_name) {
                        $('#subcategory_name_edit_error').html(response.errors.subcategory_name);
                    }
                    else {
                        $('#subcategory_name_edit_error').html('');
                    }

                    if (response.errors.subcategory_userfile) {
                        $('#subcategory_userfile_edit_error').html(response.errors.subcategory_userfile);
                    }
                    else {
                        $('#subcategory_userfile_edit_error').html('');
                    }




                    if (response.errors) {
                        // alert(response.errors);
                    }
                }
            },
            error: function (xhr) {
                $('#response').html('<p>An error occurred: ' + xhr
                    .responseText +
                    '</p>');
            }
        });
    });

    //19. Update category order index
    $('.update_category_order').on('blur', function () {
        const categoryId = this.getAttribute('data-category-id');
        const orderIndex = this.value;
        updateOrderIndex(categoryId, orderIndex);
    });

    function updateOrderIndex(id, order_index) {
        $.ajax({
            url: base_url + 'admin/categories/update_category_order_index',
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

    //20. update subcategory order index
    $('.update_subcategory_order').on('blur', function () {
        const subcategoryId = this.getAttribute('data-subcategory-id');
        const orderIndex = this.value;
        updateSubcategoryOrderIndex(subcategoryId, orderIndex);
    });


    function updateSubcategoryOrderIndex(id, order_index) {
        $.ajax({
            url: base_url + 'admin/categories/update_subcategory_order_index',
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

    //21. add subcategory when the category dropdown is changed
    $('#category').change(function () {
        var category_id = $(this).val();
        // alert(category_id);
        if (category_id) {
            $.ajax({
                url: base_url + 'admin/Product/get_subcategories',
                type: 'POST',
                data: { 'id': category_id },
                dataType: 'json',
                success: function (response) {
                    console.log(response.data);
                    $('.subcategory_id').empty();
                    $('.subcategory_id').append('<option value="0">Select Subcategory</option>');
                    // Loop through the data and append options
                    response.data.forEach(function (item) {
                        $('.subcategory_id').append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                },
                error: function () {
                    alert('Error fetching subcategories.');
                }
            });

            $('.textbox').removeClass('d-none'); // Show textbox
        } else {
            $('.textbox').addClass('d-none'); // Hide textbox
            $('#subcategory_id').html('<option value="">Select Subcategory</option>'); // Reset dropdown
        }
    });

    //22. edit subcategory when the category dropdown is changed
    $('#category_id').change(function () {
        var category_id = $(this).val();
        // alert(category_id);
        if (category_id) {
            $.ajax({
                url: base_url + 'admin/Product/get_subcategories',
                type: 'POST',
                data: { 'id': category_id },
                dataType: 'json',
                success: function (response) {
                    console.log(response.data);
                    $('.subcategoryy_id').empty();
                    $('.subcategoryy_id').append('<option value="0">Select Subcategory</option>');
                    // Loop through the data and append options
                    response.data.forEach(function (item) {
                        $('.subcategoryy_id').append('<option value="' + item.id + '">' + item.name + '</option>');
                    });


                },
                error: function () {
                    alert('Error fetching subcategories.');
                }
            });

            $('.textbox').removeClass('d-none'); // Show textbox
        } else {
            $('.textbox').addClass('d-none'); // Hide textbox
            $('#subcategory_id').html('<option value="">Select Subcategory</option>'); // Reset dropdown
        }
    });

    //23. is home checkbox in edit product

    $(document).on('click', '#is_home_edit', function () {
        if ($(this).is(':checked')) {
            $('#is_home_edit_hidden').val(1);
        } else {
            $('#is_home_edit_hidden').val(0);
        }
    });

    //24. bestseller checkbox in product edit

    $(document).on('click', '#is_bestseller_edit', function () {
        if ($(this).is(':checked')) {
            $('#is_bestseller_edit_hidden').val(1);
        } else {
            $('#is_bestseller_edit_hidden').val(0);
        }
    });




    //25. seasonal checkbox in product edit

    $(document).on('click', '#is_seasonaloffer_edit', function () {
        if ($(this).is(':checked')) {
            $('#is_seasonaloffer_edit_hidden').val(1);
        } else {
            $('#is_seasonaloffer_edit_hidden').val(0);
        }
    });






    //26. is home add checkbox in product add

    $(document).on('click', '#is_home_add', function () {
        if ($(this).is(':checked')) {
            $('#is_home_add_hidden').val(1);
        } else {
            $('#is_home_add_hidden').val(0);
        }
    });


    //27. bestseller add checkbox add
    $(document).on('click', '#is_bestseller_add', function () {
        if ($(this).is(':checked')) {
            $('#is_bestseller_add_hidden').val(1);
        } else {
            $('#is_bestseller_add_hidden').val(0);
        }
    });

    //28. seasonal add checkbox add
    $(document).on('click', '#is_seasonaloffer_add', function () {
        if ($(this).is(':checked')) {
            $('#is_seasonaloffer_add_hidden').val(1);
        } else {
            $('#is_seasonaloffer_add_hidden').val(0);
        }
    });

    $(document).on('click', '#out_of_stock', function () {
        // alert('out of stock');
        if ($(this).is(':checked')) {
            $('#out_of_stock_hidden').val(1);
        } else {
            $('#out_of_stock_hidden').val(0);
        }
    });


    //30. add testimonial
    $('#add_testimonial').click(function (e) {
        let formData = new FormData($('#addTestimonial')[0]); // Capture form data
        console.log(formData);
        $.ajax({
            url: base_url + 'admin/Testimonial/add',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                // console.log(response);

                if (response.success === 'success') {

                    setTimeout(function () {
                        // window.location.href = base_url + 'admin/Enquiry/success';
                        $('#add-testimonial').modal('hide');
                        $('#successModal .modal-body').text('Testimonials saved successfully');
                        $('#successModal').modal('show');
                        $('#addTestimonial')[0].reset();
                        $('#other_textbox').hide();
                        $('#testimonial_name_error').html('')
                        $('#testimonial_position_error').html('')
                        $('#testimonial_image_error').html('')
                        $('#testimonial_desc_error').html('')
                        // category_name_desc_ma_error
                        $('#general_error').html('')
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            // window.location.href = base_url + 'admin/categories';
                            location.reload();
                        }, 1000);
                    }, 1000);
                } else {
                    $('#testimonial_name_error').html('')
                    $('#testimonial_position_error').html('')
                    $('#testimonial_image_error').html('')
                    $('#testimonial_desc_error').html('')
                    // Check if this is a duplicate entry error
                    if (typeof response.errors === 'string') {
                        // Display the general error message somewhere
                        $('#general_error').html(response.errors);
                    } else if (response.errors.duplicate) {
                        // Display the duplicate entry error
                        $('#general_error').html(response.errors.duplicate);
                    }
                    else {
                        // Handle field-specific validation errors


                        if (response.errors.testimonial_name) {
                            $('#testimonial_name_error').html(response.errors.testimonial_name);
                        } else {
                            $('#testimonial_name_error').html('');
                        }

                        if (response.errors.testimonial_position) {
                            $('#testimonial_position_error').html(response.errors.testimonial_position);
                        }
                        else {
                            $('#testimonial_position_error').html('');
                        }


                        if (response.errors.testimonial_image) {
                            $('#testimonial_image_error').html(response.errors.testimonial_image);
                        }
                        else {
                            $('#testimonial_image_error').html('');
                        }


                        if (response.errors.testimonial_desc) {
                            $('#testimonial_desc_error').html(response.errors.testimonial_desc);
                        }
                        else {
                            $('#testimonial_desc_error').html('');
                        }

                    }
                }
            },
            error: function (xhr, status, error) {
                // Handle error
                alert('An error occurred while submitting the form.');
            }
        });
    })

    //31. edit testimonial

    $(".edit_testimonial").click(function (e) {
        var id = $(this).attr('data-id');
        // alert(id);
        $('#hidden_testimonial_id').val(id);
        $.ajax({
            url: base_url + 'admin/Testimonial/edit',
            type: 'POST',
            data: { 'id': id },
            dataType: 'json',
            success: function (response) {
                console.log(response.data);
                if (response.success === 'success') {
                    $('#testimonial_name').val(response.data.name);
                    $('#testimonial_image_existing').val(response.data.image);
                    $('#testimonial_desc').val(response.data.description);
                    $('#testimonial_position').val(response.data.position);
                    let imagePath = base_url + 'uploads/testimonial/' + response.data.image;
                    $('#preview_imgg').attr('src', imagePath);
                }
                else {
                    // alert('tax data not found!');
                }
            }
        })

    });

    //32.update testimonial



    $('#save_testimonial').click(function (e) {
        var save_tax = $('#hidden_testimonial_id').val();
        let formData = new FormData($('#edit_testimonial')[0]);
        formData.append('hidden_testimonial_id', save_tax);
        $.ajax({
            url: base_url + "admin/testimonial/updatetestimonial",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the Content-Type header
            success: function (response) {
                console.log(response);
                if (response.success === 'success') {
                    setTimeout(function () {
                        $('#successModal .modal-body').text('testimonial Updated successfully');
                        $('#successModal').modal('show');
                        $('#edit-testimonial').modal('hide');
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            location.reload(); // This reloads the whole page
                        }, 1000)
                    }, 1000)

                }
                else {


                    if (response.errors.testimonial_name) {
                        $('#testimonial_name_edit_error').html(response.errors.testimonial_name);
                    } else {
                        $('#testimonial_name_edit_error').html('');
                    }

                    if (response.errors.testimonial_position) {
                        $('#testimonial_position_edit_error').html(response.errors.testimonial_position);
                    }
                    else {
                        $('#testimonial_position_edit_error').html('');
                    }


                    if (response.errors.testimonial_desc) {
                        $('#testimonial_desc_edit_error').html(response.errors.testimonial_desc);
                    }
                    else {
                        $('#testimonial_desc_edit_error').html('');
                    }

                    if (response.errors.testimonial_image) {
                        $('#testimonial_image_edit_error').html(response.errors.testimonial_image);
                    }
                    else {
                        $('#testimonial_image_edit_error').html('');
                    }


                    if (response.errors) {
                        // alert(response.errors);
                    }
                }
            },
            error: function (xhr) {
                $('#response').html('<p>An error occurred: ' + xhr
                    .responseText +
                    '</p>');
            }
        });
    });

    //33. add brand   
    $('#add_brand').click(function (e) {
        let formData = new FormData($('#addBrand')[0]); // Capture form data
        console.log(formData);
        $.ajax({
            url: base_url + 'admin/Brands/add',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                // console.log(response);

                if (response.success === 'success') {

                    setTimeout(function () {
                        // window.location.href = base_url + 'admin/Enquiry/success';
                        $('#add-brand').modal('hide');
                        $('#successModal .modal-body').text('Brand saved successfully');
                        $('#successModal').modal('show');
                        $('#addBrand')[0].reset();
                        $('#other_textbox').hide();
                        $('#brand_name_error').html('')
                        $('#brand_image_error').html('')
                        // category_name_desc_ma_error
                        $('#general_error').html('')
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            // window.location.href = base_url + 'admin/categories';
                            location.reload();
                        }, 1000);
                    }, 1000);
                } else {
                    $('#other_textbox').hide();
                    $('#brand_name_error').html('')
                    $('#brand_image_error').html('')
                    // Check if this is a duplicate entry error
                    if (typeof response.errors === 'string') {
                        // Display the general error message somewhere
                        $('#general_error').html(response.errors);
                    } else if (response.errors.duplicate) {
                        // Display the duplicate entry error
                        $('#general_error').html(response.errors.duplicate);
                    }
                    else {
                        // Handle field-specific validation errors

                        if (response.errors.brand_name) {
                            $('#brand_name_error').html(response.errors.brand_name);
                        } else {
                            $('#brand_name_error').html('');
                        }

                        if (response.errors.brand_image) {
                            $('#brand_image_error').html(response.errors.brand_image);
                        }
                        else {
                            $('#brand_image_error').html('');
                        }

                    }
                }
            },
            error: function (xhr, status, error) {
                // Handle error
                alert('An error occurred while submitting the form.');
            }
        });
    })

    //34. edit brand

    $(".edit_brand").click(function (e) {
        var id = $(this).attr('data-id');
        // alert(id);
        $('#hidden_brand_id').val(id);
        $.ajax({
            url: base_url + 'admin/Brands/edit',
            type: 'POST',
            data: { 'id': id },
            dataType: 'json',
            success: function (response) {
                console.log(response.data);
                if (response.success === 'success') {
                    $('#brand_name').val(response.data.name);
                    $('#brand_image_existing').val(response.data.image);
                    let imagePath = base_url + 'uploads/brand/' + response.data.image;
                    $('#preview_brand').attr('src', imagePath);
                }
                else {
                    // alert('tax data not found!');
                }
            }
        })

    });


    //35. update brand

    $('#save_brand').click(function (e) {
        var save_brand = $('#hidden_brand_id').val();
        let formData = new FormData($('#edit_brand')[0]);
        formData.append('hidden_brand_id', save_brand);
        $.ajax({
            url: base_url + "admin/Brands/updatebrand",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the Content-Type header
            success: function (response) {
                console.log(response);
                if (response.success === 'success') {
                    setTimeout(function () {
                        $('#successModal .modal-body').text('brand Updated successfully');
                        $('#successModal').modal('show');
                        $('#edit-brand').modal('hide');
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            location.reload(); // This reloads the whole page
                        }, 1000)
                    }, 1000)

                }
                else {
                    if (response.errors.brand_name) {
                        $('#brand_name_edit_error').html(response.errors.brand_name);
                    } else {
                        $('#brand_name_edit_error').html('');
                    }

                    if (response.errors.brand_image) {
                        $('#brand_image_edit_error').html(response.errors.brand_image);
                    }
                    else {
                        $('#brand_image_edit_error').html('');
                    }


                    if (response.errors) {
                        // alert(response.errors);
                    }
                }
            },
            error: function (xhr) {
                $('#response').html('<p>An error occurred: ' + xhr
                    .responseText +
                    '</p>');
            }
        });
    });

    // 36. delete brand
    $(".del_brand").click(function (e) {
        var id = $(this).attr('data-id');
        // alert(id);
        $('#delete_brand_id').val(id);
    });

    $('#yes_delete_brand').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + "admin/Brands/Delete",
            data: {
                'id': $('#delete_brand_id').val()
            },
            success: function (data) {
                console.log(data);
                window.location.href = '';
            }
        });
    });


    // 37. delete testimonial

    $(".del_testimonial").click(function (e) {
        var id = $(this).attr('data-id');
        // alert(id);
        $('#delete_testimonial_id').val(id);
    });

    $('#yes_delete_testimonial').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + "admin/Testimonial/Delete",
            data: {
                'id': $('#delete_testimonial_id').val()
            },
            success: function (data) {
                console.log(data);
                window.location.href = '';
            }
        });
    });

    //38. delete subcategory

    $(".del_subcategory").click(function (e) {
        var id = $(this).attr('data-id');
        $('#delete_subcat_id').val(id);
    });
    $('#yes_subcat_user').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + "admin/Categories/DeleteSubCategory",
            data: {
                'id': $('#delete_subcat_id').val()
            },
            success: function (data) {
                console.log(data);
                window.location.href = '';
            }
        });
    });


    // 39. filter data for products against category and subcategory
    $(document).ready(function () {
        $(document).on('click', '#categoryid', function () {
            var category_id = $(this).data('cat-id');
            //  alert(category_id);
            $.ajax({
                url: base_url + 'home/getCategoriesproducts',
                type: 'POST',
                data: { 'category_id': category_id },
                dataType: 'json',
                success: function (response) {
                    console.log(response.html);
                    if (response.success) {
                        $('#productContainer').html(response.html);
                    }
                    else {
                        $('#productContainer').html('<p>No products found.</p>');
                        // alert('tax data not found!');
                    }
                }
            });

        });

        //40. filter data for products against subcategory

        $(document).on('click', '#subcategoryid', function () {
            // var category_id = $(this).data('cat-id');
            var subcategory_id = $(this).data('subcat-id');
            var category_id = $(this).closest('[data-cat-id]').data('cat-id');
            // 'category_id': $('#categoryid').data('cat-id')
            // alert(subcategory_id);
            // alert(category_id);
            $.ajax({
                url: base_url + 'home/getCategoriesproducts',
                type: 'POST',
                data: {
                    'subcategory_id': subcategory_id,
                    'category_id': category_id
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response.html);
                    if (response.success) {
                        $('#productContainer').html(response.html);
                    }
                    else {
                        $('#productContainer').html('<p>No products found.</p>');
                        // alert('tax data not found!');
                    }
                }
            });
        });


    });


    //41. cart quantity increment 
    $(document).off('click', '.increment-btn').on('click', '.increment-btn', function (e) {

        stockcheck(this);
        // alert('increment');
        // Get button and relevant containers
        var btn = $(this);
        var product = btn.closest('.product-item');
        var qtyArea = btn.closest('.qty-area');
        var portfolio = btn.closest('.portfolio-title');
        // btn.prop('disabled', true);

        // Get current quantity and increment it
        var qty = parseInt(qtyArea.find('span[data-qty]').text()) || 0;
        var newQty = qty + 1;

        // Update quantity display
        qtyArea.find('span[data-qty]').text(newQty);

        // Get unit price
        var unitPrice = parseFloat(portfolio.find('.price-cart').data('price')) || 0;
        // alert(unitPrice);

        // Calculate and update total price
        var totalPrice = newQty * unitPrice;
        // portfolio.find('.price-cart').text("₹" + totalPrice.toFixed(2));

        // Update form inputs
        var form = product.find('form');
        form.find('.qty-input').val(newQty);
        form.find('.qty-price').val(totalPrice);

    });



    //42. cart quanity decrement

    $(document).off('click', '.decrement-btn').on('click', '.decrement-btn', function (e) {
        var $btn = $(this);
        var product = $btn.closest('.product-item');
        var qtyArea = $btn.closest('.qty-area');
        var portfolio = $btn.closest('.portfolio-title');
        var qty = parseInt(qtyArea.find('span[data-qty]').text()) || 1; // default to 1 if not a number
        var newQty = qty > 1 ? qty - 1 : 1; // prevent going below 1
        qtyArea.find('span[data-qty]').text(newQty);

        //  var qty = parseInt(qtyArea.find('span[data-qty]').text()) || 0;
        // var newQty = qty - 1;

        // Update quantity display
        qtyArea.find('span[data-qty]').text(newQty);

        // Get unit price
        var unitPrice = parseFloat(portfolio.find('.price-cart').data('price')) || 0;
        $('.increment-btn').prop('disabled', false);
        // alert(unitPrice);

        // Calculate and update total price
        var totalPrice = newQty * unitPrice;
        // portfolio.find('.price-cart').text("₹" + totalPrice.toFixed(2));

        // Update form inputs
        var form = product.find('form');
        form.find('.qty-input').val(newQty);
        form.find('.qty-price').val(totalPrice);

        // Optional: Debug alerts
        // alert('Product ID: ' + $btn.data('product-id'));
        //  alert('New Qty: ' + newQty);
        //  alert('New Price: ₹' + totalPrice.toFixed(2));
    });



    //43. add to cart
    $(document).on('submit', '#add_cart_form', function (e) {
        e.preventDefault();
        var form = $(this);
        var product_id = form.find('#cart_product_id').val();
        var quantity = form.find('#quantity').val();
        var price = form.find('#price').val();
        var product_price = form.find('#product_price').val();
        var product_weight = form.find('#product_weight').val();
        var product_kg_g = form.find('#product_kg_g').val();
        // alert(product_id);

        $.ajax({
            url: base_url + 'cart/cart',
            type: 'POST',
            data: {
                cart_product_id: product_id,
                quantity: quantity,
                price: price,
                product_price: product_price,
                product_weight: product_weight,
                product_kg_g: product_kg_g

            },
            // dataType: 'json',
            success: function (response) {
                //    alert(response.success);
                loadcart();
                //alert('Product added to cart!');
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: " + status + ": " + error);
            }
        });
    });





    //44. add to cart and load cart page
    function loadcart() {
        //  alert('load');
        $.ajax({
            url: base_url + 'cart/loadcart',
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                console.log(response.data);
                setTimeout(function () {
                    $('.alert-success').removeClass('d-none');
                    $('.alert-success').text(response.message);
                   
                    setTimeout(function () {
                        $('.alert-success').addClass('d-none');
                    }, 3000);
                }, 1000);
                loadcartitems(); // 🔁 Load cart count on page refresh


            }
        })
    }

    $(document).ready(function () {
        loadcartitems(); // 🔁 Load cart count on page refresh
    });


    function loadcartitems() {
        $.ajax({
            url: base_url + 'cart/loadcartitems',
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.cartcount > 0) {
                    $('.badge').text(response.cartcount);
                }
                $('#cart_item').html(response.html);



            }
        })
    }

    //45. delete items in cart

    // $(document).on('click', '.delete-cart', function (e){
    //     var deletecart= $(this).attr('data-id');
    //     $('#delete_cart_id').val(deletecart);
    //     // alert(deletecart);
    // });

    // $('#yes_delete_cart').click(function () {
    // $.ajax({
    //     url: base_url + 'cart/deletecart',
    //     type: 'POST',
    //      data: {
    //                 'deletecart': $('#delete_cart_id').val()
    //             },
    //     dataType: 'json',
    //     success: function (response) {
    //         location.reload();
    //     //   loadcartitems();
    //         //alert('Product added to cart!');
    //     },
    // })
    // });




    //46. add coupon


    $('#add_coupon').click(function (e) {
        let formData = new FormData($('#addCoupon')[0]); // Capture form data
        console.log(formData);
        $.ajax({
            url: base_url + 'admin/settings/addcoupon',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                // console.log(response);

                if (response.success === 'success') {

                    setTimeout(function () {
                        // window.location.href = base_url + 'admin/Enquiry/success';
                        $('#add-coupon').modal('hide');
                        $('#successModal .modal-body').text('coupon saved successfully');
                        $('#successModal').modal('show');
                        $('#addCoupon')[0].reset();
                        $('#other_textbox').hide();
                        $('#coupon_code_error').html('')
                        $('#coupon_type_error').html('')
                        $('#coupon_value_error').html('')
                        $('#general_error').html('')
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            // window.location.href = base_url + 'admin/categories';
                            location.reload();
                        }, 1000);
                    }, 1000);
                }
                else {
                    $('#coupon_code_error').html('')
                    $('#coupon_type_error').html('')
                    $('#coupon_value_error').html('')
                    $('#general_error').html('')
                    // Check if this is a duplicate entry error
                    if (typeof response.errors === 'string') {
                        // Display the general error message somewhere
                        $('#general_error').html(response.errors);
                    }
                    else if (response.errors.duplicate) {
                        // Display the duplicate entry error
                        $('#general_error').html(response.errors.duplicate);
                    }
                    else {
                        // Handle field-specific validation errors

                        if (response.errors.coupon_code) {
                            $('#coupon_code_error').html(response.errors.coupon_code);
                        }
                        else {
                            $('#coupon_code_error').html('');
                        }

                        if (response.errors.coupon_type) {
                            $('#coupon_type_error').html(response.errors.coupon_type);
                        }
                        else {
                            $('#coupon_type_error').html('');
                        }

                        if (response.errors.coupon_value) {
                            $('#coupon_value_error').html(response.errors.coupon_value);
                        }
                        else {
                            $('#coupon_value_error').html('');
                        }

                    }
                }
            },
            error: function (xhr, status, error) {
                // Handle error
                alert('An error occurred while submitting the form.');
            }
        });
    })


    // 47. delete coupon

    $(".del_coupon").click(function (e) {
        var id = $(this).attr('data-id');
        $('#delete_coupon_id').val(id);
    });

    $('#yes_coupon_user').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + "admin/Settings/DeleteCoupon",
            data: {
                'id': $('#delete_coupon_id').val()
            },
            success: function (data) {
                console.log(data);
                window.location.href = '';
            }
        });
    });

    //48. check the coupon code in website

    $('#apply_coupon').click(function (e) {
        e.preventDefault(); // prevent form default action
        let formData = new FormData($('#apply_coupon_form')[0]);

        $.ajax({
            url: base_url + 'admin/settings/applycoupon',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                console.log(response);

                if (response.success) {
                    $('#coupons_code_error').html('');
                    $('#coupons_code_error').html(response.message).css('color', 'green');
                    $('.success-msg').removeClass('d-none');
                    $('.discount-amount').html(response.discount);
                    $('.total-discount').html(response.final_amount);
                    setTimeout(function () {
                        location.reload();
                    }, 2000)
                    //    $('#coupons_code_error').html(response.message).css('color', 'green');
                    //   $('#calculate-total_amount').val(response.final_amount);

                    //   $('.total-amount').removeClass('d-none');   
                }
                else {
                    if (response.errors && response.errors.coupons_code) {
                        $('#coupons_code_error').html(response.errors.coupons_code);
                    }
                    else if (response.message) {
                        $('#coupons_code_error').html(response.message);
                    }
                    else {
                        $('#coupons_code_error').html('');
                    }
                }
            }
        });
    });

    //49. add wishlist

    $(document).off('click', '#wishlist_button').on('click', '#wishlist_button', function (e) {
        //    e.preventDefault();
        var form = $(this).closest('form');
        var product_id = form.find('#cart_product_id').val();
        var product_weight = form.find('#product_weight').val();
        var product_kg = form.find('#product_kg_g').val();
        var quantity = form.find('#quantity').val();
        var price = form.find('#price').val();
        var product_price = form.find('#product_price').val();

        //  alert(product_id);
        //    alert(product_weight);
        //    alert(product_kg);
        //   alert(price);
        $.ajax({
            url: base_url + 'cart/addwishlist',
            type: 'POST',
            data:
            {
                'product_id': product_id,
                'price': price,
                'product_weight': product_weight,
                'product_kg': product_kg,
                'quantity': quantity,
                'product_price': product_price
            },
            success: function (response) {
                console.log("Success:", response); // See the full response in console
                if (response.message) {
                    setTimeout(function () {
                        $('.alert-success').removeClass('d-none').text(response.message);
                        setTimeout(function () {
                            $('.alert-success').addClass('d-none');
                            location.reload();
                        }, 3000);
                    }, 1000);
                } else {
                    console.warn("No message in response:", response);
                }
            }
        })
    });

    //50.  load dynamic html for wishlist after count

    $(document).on('click', '.wishlist_button', function (e) {
        e.preventDefault();
        var form = $(this).closest('form');
        var product_id = form.find('input[name="cart_product_id"]').val();
        var price = form.find('input[name="price"]').val();

        //  alert(product_id);
        // alert(price);
        $.ajax({
            url: base_url + 'cart/addwishlist',
            type: 'POST',
            data: {
                product_id: product_id,
                price: price
            },
            success: function (data) {
                console.log(data);
                loadwishlistitem();
            }
        });
    });



    //51. add category when is home checkbox is clicked

    $(document).on('click', '#is_header_category', function () {
        if ($(this).is(':checked')) {
            $('#is_header_category_hidden').val(1);
        } else {
            $('#is_header_category_hidden').val(0);
        }
    });

    //52. edit category when is home checkbox is clicked
    $(document).on('click', '#is_edit_header_category', function () {
        if ($(this).is(':checked')) {
            $('#is_edit_header_category_hidden').val(1);
        } else {
            $('#is_edit_header_category_hidden').val(0);
        }
    });

    //53. add category when is footer checkbox is clicked

    $(document).on('click', '#is_footer_category', function () {
        if ($(this).is(':checked')) {
            $('#is_footer_category_hidden').val(1);
        } else {
            $('#is_footer_category_hidden').val(0);
        }
    });

    //54. edit category when is footer checkbox is clicked
    $(document).on('click', '#is_edit_footer_category', function () {
        if ($(this).is(':checked')) {
            $('#is_edit_footer_category_hidden').val(1);
        } else {
            $('#is_edit_footer_category_hidden').val(0);
        }
    });


    //55. cart page quanity increment
    $(document).on('click', '.cart-increment-btn', function (e) {
        var stock = stockcheckcart(this);
        alert(stock);
        var btn = $(this);
        var row = btn.closest('tr'); // each product row
        var qtyArea = btn.closest('.qty-area');

        var qty = parseInt(qtyArea.find('span[data-qty]').text()) || 0;
        var newQty = qty + 1;

        qtyArea.find('span[data-qty]').text(newQty);

        var unitPrice = parseFloat(row.find('.price-carts').data('price')) || 0;
        var totalPrice = newQty * unitPrice;

        row.find('.price-cart').text("₹" + totalPrice.toFixed(2)).attr('data-price', totalPrice); // ✅ only update this row
       
        var weight= $('#coupon').val();
        var product_id = btn.data('product-id');
        var quantity = newQty;
        var calculateweight= parseFloat(weight) * quantity;
        var price = totalPrice.toFixed(2);

      


        
        qtyArea.find('.qty-price').val(totalPrice);

        //    alert('Product ID: ' + btn.data('product-id'));
        //  alert('New Qty: ' + newQty);
        //  alert('New Price: ₹' + totalPrice.toFixed(2));
        // alert(totalPrice);
        // alert(weight);
        // alert(calculateweight);

      

        $.ajax({
            url: base_url + 'cart/cart',
            type: 'POST',
            data: {
                cart_product_id: product_id,
                quantity: quantity,
                price: price,
                calculateweight: calculateweight
            },
            success: function (response) {
                loadcart();
                qtyArea.find('.qty-input').val(newQty);
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: " + status + ": " + error);
            }
        });
    });



    //56. cart page quantity decrement

    $(document).on('click', '.cart-decrement-btn', function (e) {
        var $btn = $(this);
        var product = $btn.closest('.product-item');
        var qtyArea = $btn.closest('.qty-area');
        var portfolio = $btn.closest('.portfolio-title');
        var row = $btn.closest('tr'); // each product row
        var qty = parseInt(qtyArea.find('span[data-qty]').text()) || 1; // default to 1 if not a number
        var newQty = qty > 1 ? qty - 1 : 1; // prevent going below 1
        var product_id = $btn.data('product-id');

        if (qty <= 1) {
            // Call delete API
            $.ajax({
                url: base_url + 'cart/deletecart',
                type: 'POST',
                data: {
                    deletecart: product_id
                },
                success: function (response) {
                    row.remove();
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error("Delete AJAX Error: " + status + ": " + error);
                }
            });

            return; // Stop further execution
        }

        // Update quantity display
        qtyArea.find('span[data-qty]').text(newQty);

        // Get unit price
        var unitPrice = parseFloat(row.find('.price-carts').data('price')) || 0;

        // Calculate and update total price
        var totalPrice = newQty * unitPrice;
        // Update form inputs
        var form = product.find('form');
        form.find('.qty-input').val(newQty);
        form.find('.qty-price').val(totalPrice);
         row.find('.price-cart').text("₹" + totalPrice.toFixed(2)).attr('data-price', totalPrice);
       $('.sumofprice').text("₹" + totalPrice.toFixed(2));
        var quantity = newQty;
        var price = totalPrice.toFixed(2);

        $.ajax({
            url: base_url + 'cart/cart',
            type: 'POST',
            data: {
                cart_product_id: product_id,
                quantity: quantity,
                price: price
            },
            // dataType: 'json',
            success: function (response) {
                loadcart();
                //    alert(response.success);
              
                //alert('Product added to cart!');
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: " + status + ": " + error);
            }
        });
    });


    //57. delete items in wishlist

    $(document).on('click', '.delete-wishlist', function (e) {
        var deletecart = $(this).attr('data-id');
        $('#delete_wishlist_id').val(deletecart);
        // alert(deletecart);
    });

    $('#yes_delete_wishlist').click(function () {
        $.ajax({
            url: base_url + 'cart/deletewishlist',
            type: 'POST',
            data: {
                'deletewish': $('#delete_wishlist_id').val()
            },
            dataType: 'json',
            success: function (response) {
                location.reload();
                //   loadcartitems();
                //alert('Product added to cart!');
            },
        })
    });

    //58. count in wishlist
    $(document).ready(function () {
        $.ajax({
            url: base_url + "cart/wishlistcount",
            type: "GET",
            dataType: "json",
            success: function (response) {
                // console.log(response);

                if (response.wishlistcount > 0) {
                    $('.badges').removeClass('d-none').text(response.wishlistcount);
                }
                else {
                    $('.badges').addClass('d-none').text('');
                }

            },
            error: function (xhr, status, error) {
                console.error("Error loading wishlist count:", error);
            }
        });
    });



    //59. current row identify remove readonly attr in shipping admin side
    $(document).on('click', '.edit_shipping', function () {
        var row = $(this).closest('tr'); // Find the parent row
        row.find('.update_shipping').removeAttr('readonly').focus(); // Enable input in this row
    });

    //60. shipping  rate update in onblur admin side
    $('.update_shipping').on('blur', function () {
        const categoryId = this.getAttribute('data-id');
        const orderIndex = this.value;
        // alert(orderIndex);
        // alert(categoryId);
        updateshippingrate(categoryId, orderIndex);
    });

    //61. update shipping rate in website when the state dropdown selected
    function updateshippingrate(id, rating) {
        $.ajax({
            url: base_url + 'admin/settings/update_shipping_rate',
            method: 'POST',
            data: {
                id: id,
                rate: rating
            },
            success: function (response) { },
            error: function (xhr, status, error) {
                console.error('Error updating order index');
            }
        });
    }

    //62. checkout add user details

    $('#saveuserorder').click(function (e) {
        // alert(1);
        let total_amount = $('#total_amount').val();
        // alert(total_amount);
        let formData = new FormData($('#usercheckout')[0]); // Capture form data
        formData.append('total_amount', total_amount);
        //  console.log(formData);
        $.ajax({
            url: base_url + 'home/addusercheckout',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);

                if (response.success === 'success') {
                    $('.alert-success').removeClass('d-none');
                    $('.alert-success').text(response.message);
                    $('.alert-danger').addClass('d-none');
                    if (response.ordertype == 'rt') {
                        window.location.href = base_url;
                    } else if (response.ordertype == 'ws') {
                        window.location.href = base_url + 'wholesale';
                    } else if (response.ordertype == 'bb') {
                        window.location.href = base_url + 'b2b';
                    }
                    // window.location.href = base_url  ;
                    $('#usercheckout')[0].reset();
                    $('#checkout_username_error').html('');
                    $('#checkout_useremail_error').html('');
                    $('#checkout_userphone_error').html('');
                    $('#checkout_usercountry_error').html('');
                    $('#checkout_usercity_error').html('');
                    $('#checkout_userpostcode_error').html('');
                    $('#checkout_useraddress_error').html('');
                    $('#checkout_company_name_error').html('');

                    // setTimeout(function () {
                    // location.reload();
                    // },1000)
                }

                else {
                    // setTimeout(function () {
                    $('#checkout_username_error').html('');
                    $('#checkout_useremail_error').html('');
                    $('#checkout_userphone_error').html('');
                    $('#checkout_usercountry_error').html('');
                    $('#checkout_usercity_error').html('');
                    $('#checkout_userpostcode_error').html('');
                    $('#general_error').html('');
                    $('#checkout_company_name_error').html('')
                    // },1000)
                    // $('#checkout_username_error').html('');
                    // $('#checkout_useremail_error').html('');
                    // $('#checkout_userphone_error').html('');
                    // $('#checkout_usercountry_error').html('');
                    // $('#checkout_usercity_error').html('');
                    // $('#checkout_userpostcode_error').html('');

                    $('#general_error').html('');

                    if (response.email === false) {
                        $('.alert-danger').removeClass('d-none').text(response.message);
                    }
                    else {
                        $('.alert-danger').addClass('d-none').text('');
                    }
                    if (response.errors) {
                        $('#general_error').html(response.errors);
                    }
                    else {
                        $('#general_error').html('');
                    }

                    if (response.errors.checkout_company_name) {
                        $('#checkout_company_name_error').html(response.errors.checkout_company_name);
                    }
                    else {
                        $('#checkout_company_name_error').html('');
                    }

                    if (response.errors.checkout_username) {
                        $('#checkout_username_error').html(response.errors.checkout_username);
                    }
                    else {
                        $('#checkout_username_error').html('');
                    }
                    if (response.errors.checkout_useremail) {
                        $('#checkout_useremail_error').html(response.errors.checkout_useremail);
                    }
                    else {
                        $('#checkout_useremail_error').html('');
                    }
                    if (response.errors.checkout_userphone) {
                        $('#checkout_userphone_error').html(response.errors.checkout_userphone);
                    }
                    else {
                        $('#checkout_userphone_error').html('');
                    }
                    if (response.errors.checkout_usercountry) {
                        $('#checkout_usercountry_error').html(response.errors.checkout_usercountry);
                    }
                    else {
                        $('#checkout_usercountry_error').html('');
                    }

                    if (response.errors.checkout_usercity) {
                        $('#checkout_usercity_error').html(response.errors.checkout_usercity);
                    }
                    else {
                        $('#checkout_usercity_error').html('');
                    }
                    if (response.errors.checkout_userpostcode) {
                        $('#checkout_userpostcode_error').html(response.errors.checkout_userpostcode);
                    }
                    else {
                        $('#checkout_userpostcode_error').html('');
                    }

                    if (response.errors.checkout_useraddress) {
                        $('#checkout_useraddress_error').html(response.errors.checkout_useraddress);
                    }
                    else {
                        $('#checkout_useraddress_error').html('');
                    }



                }

            },
            error: function (xhr, status, error) {
                // Handle error
                alert('An error occurred while submitting the form.');
            }
        });
    })

    //63. view order  details in admin side popup

    $('.edit_order').click(function (e) {
        var id = $(this).attr('data-id');
        $('#hidden_order_id').val(id); // Set hidden input value
        let formData = new FormData($('#edit_order')[0]);
        formData.append('hidden_order_id', id);
        $.ajax({
            url: base_url + 'admin/settings/vieworders',
            type: 'POST',
            data: formData,
            processData: false, // Required for FormData
            contentType: false, // Required for FormData
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.success === 'success') {
                    $('#orders tbody').html(response.html);
                    $('#total_price').html(response.total_price);
                }
            }
        });

    });

    //64. add slider

    $('#add_slider').click(function (e) {
        // Prevent the default action
        e.preventDefault();

        // For iOS compatibility, explicitly create FormData with each field;
        let formData = new FormData($('#addslider')[0]);
        // Manually add each form field to FormData
        $('#addCategories').find('input').each(function () {
            let input = $(this);
            let name = input.attr('name');

            // Handle file inputs separately
            if (input.attr('type') === 'file') {
                if (input[0].files.length > 0) {
                    formData.append(name, input[0].files[0]);
                }
            } else {
                formData.append(name, input.val());
            }
        });

        // Ensure the request is sent with cache prevention
        $.ajax({
            url: base_url + 'admin/Settings/addslider',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false, // Prevent caching
            success: function (response) {
                // The rest of your success handler remains the same
                if (response.success === 'success') {
                    setTimeout(function () {
                        $('#add-slider').modal('hide');
                        $('#successModal .modal-body').text('Slider saved successfully');
                        $('#successModal').modal('show');
                        $('#addslider')[0].reset();
                        $('#other_textbox').hide();
                        $('#slider_title_error').html('');
                        $('#slider_subtitle_error').html('');
                        $('#slider_photo_error').html('');
                        $('#general_error').html('');
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            location.reload();
                        }, 1000);
                    }, 1000);
                } else {
                    // Error handling code remains the same
                    $('#other_textbox').hide();
                    $('#slider_title_error').html('');
                    $('#slider_subtitle_error').html('');
                    $('#slider_photo_error').html('');
                    $('#general_error').html('');

                    if (typeof response.errors === 'string') {
                        $('#general_error').html(response.errors);
                    } else if (response.errors.duplicate) {
                        $('#general_error').html(response.errors.duplicate);
                    } else {
                        if (response.errors.slider_title) {
                            $('#slider_title_error').html(response.errors.slider_title);
                        }

                        if (response.errors.slider_subtitle) {
                            $('#slider_subtitle_error').html(response.errors.slider_subtitle);
                        }

                        if (response.errors.slider_photo) {
                            $('#slider_photo_error').html(response.errors.slider_photo);
                        }

                    }
                }
            },
            error: function (xhr, status, error) {
                console.log('AJAX Error:', xhr.responseText);
                alert('An error occurred while submitting the form.');
            }
        });
    });

    //65. edit slider

    $(".edit_slider").click(function (e) {
        var id = $(this).attr('data-id');
        // alert(id);
        $('#hidden_slider_id').val(id);
        $.ajax({
            url: base_url + 'admin/Settings/editslider',
            type: 'POST',
            data: { 'id': id },
            dataType: 'json',
            success: function (response) {
                console.log(response.data);
                if (response.success === 'success') {
                    $('#slider_title').val(response.data.title);
                    $('#slider_subtitle').val(response.data.description);
                    $('#slider_image').val(response.data.image);
                    $('#existing_slider_photo').val(response.data.image);
                    let imagePath = base_url + 'uploads/slider/' + response.data.image;
                    $('#preview_slider').attr('src', imagePath);

                }
                else {
                    // alert('tax data not found!');
                }
            }
        })

    });

    //66. update slider

    $('#save_slider').click(function (e) {
        var save_slider = $('#hidden_slider_id').val();
        let formData = new FormData($('#edit_slider')[0]);
        formData.append('hidden_slider_id', save_slider);
        $.ajax({
            url: base_url + "admin/Settings/updateslider",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the Content-Type header
            success: function (response) {
                console.log(response);
                if (response.success === 'success') {
                    setTimeout(function () {
                        $('#successModal .modal-body').text('Slider Updated successfully');
                        $('#successModal').modal('show');
                        $('#edit-slider').modal('hide');
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            location.reload(); // This reloads the whole page
                        }, 1000)
                    }, 1000)
                }
                else {


                    if (response.errors.slider_title) {
                        $('#slider_title_edit_error').html(response.errors.slider_title);
                    } else {
                        $('#slider_title_edit_error').html('');
                    }

                    if (response.errors.slider_subtitle) {
                        $('#slider_subtitle_edit_error').html(response.errors.slider_subtitle);
                    }
                    else {
                        $('#slider_subtitle_edit_error').html('');
                    }


                    if (response.errors.slider_photo) {
                        $('#slider_photo_edit_error').html(response.errors.slider_photo);
                    }
                    else {
                        $('#slider_photo_edit_error').html('');
                    }
                    if (response.errors) {
                        // alert(response.errors);
                    }
                }
            },
            error: function (xhr) {
                $('#response').html('<p>An error occurred: ' + xhr
                    .responseText +
                    '</p>');
            }
        });
    })

    //67. delete slider
    $(".del_slider").click(function () {
        //alert('click');
        $('#delete_slider_id').val($(this).data('id'));

    });

    $('#yes_slider_user').click(function () {
        $.ajax({
            url: base_url + 'admin/Settings/deleteslider',
            type: 'POST',
            data: {
                'deleteslider': $('#delete_slider_id').val()
            },
            dataType: 'json',
            success: function (response) {
                location.reload();
            },
        })
    });

    //68. report date change 

    $(document).ready(function () {
        var date = $('#retail-date').val(); // get today's date
        loadRetailReport(date);             // fetch the report

        $('#retail-date').on('change', function () {
            var newDate = $(this).val();
            loadRetailReport(newDate);      // fetch report for selected date
        });
    });

    function loadRetailReport(date) {
        console.log("Fetching report for:", date);

        $.ajax({
            url: base_url + 'admin/Reports/getRetailReport',
            type: 'POST',
            data: { date: date },
            dataType: 'json',
            success: function (response) {
                console.log("AJAX response:", response);
                if (response.success) {
                    $('#retail-report').html(response.html);
                } else {
                    $('#retail-report').html('<tr><td colspan="4">No data</td></tr>');
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX error:", error);
                $('#retail-report').html('<tr><td colspan="4" class="text-danger">Error loading data.</td></tr>');
            }
        });
    }

    //69 . out of stock check in admin add product 
    $(document).on('click', '#out_of_stock', function () {
        // alert('out of stock');
        if ($(this).is(':checked')) {
            $('#out_of_stock_hidden').val(1);
        } else {
            $('#out_of_stock_hidden').val(0);
        }
    });

    //70. out of stock product edit in product admin


    $(document).on('click', '#out_of_stock_edit', function () {
        if ($(this).is(':checked')) {
            $('#out_of_stock_edit_hidden').val(1);
        } else {
            $('#_hidden').val(0);
        }
    });

    //71. get product details in website  with product id

    // $(document).on('click', '.product-name', function () {
    //     var productid = $(this).data('id');
    //     // alert(productid);
    // });

    //71. contact form

    $('#contact').click(function (e) {
        let formData = new FormData($('#addcontact')[0]); // Capture form data
        console.log(formData);
        $.ajax({
            url: base_url + 'home/addcontact',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                // console.log(response);

                if (response.success === 'success') {

                    setTimeout(function () {
                        // window.location.href = base_url + 'admin/Enquiry/success';
                        $('#addcontact')[0].reset();
                        $('#other_textbox').hide();
                        $('#contact_name_error').html('')
                        $('#contact_email_error').html('')
                        $('#contact_desc_error').html('')
                        $('#contact_phone_error').html('')
                        $('#general_error').html('')
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    }, 1000);
                } else {

                    $('#contact_name_error').html('')
                    $('#contact_email_error').html('')
                    $('#contact_desc_error').html('')
                    $('#contact_phone_error').html('')
                    $('#general_error').html('')
                    // Check if this is a duplicate entry error
                    if (typeof response.errors === 'string') {
                        // Display the general error message somewhere
                        $('#general_error').html(response.errors);
                    } else if (response.errors.duplicate) {
                        // Display the duplicate entry error
                        $('#general_error').html(response.errors.duplicate);
                    }
                    else {
                        // Handle field-specific validation errors

                        if (response.errors.contact_name) {
                            $('#contact_name_error').html(response.errors.contact_name);
                        }
                        else {
                            $('#contact_name_error').html('');
                        }

                        if (response.errors.contact_email) {
                            $('#contact_email_error').html(response.errors.contact_email);
                        }
                        else {
                            $('#contact_email_error').html('');
                        }

                        if (response.errors.contact_desc) {
                            $('#contact_desc_error').html(response.errors.contact_desc);
                        }
                        else {
                            $('#contact_desc_error').html('');
                        }

                        if (response.errors.contact_phone) {
                            $('#contact_phone_error').html(response.errors.contact_phone);
                        }
                        else {
                            $('#contact_phone_error').html('');
                        }


                    }
                }
            },
            error: function (xhr, status, error) {
                // Handle error
                alert('An error occurred while submitting the form.');
            }
        });
    })

    //72. delete contact
    $(".del_contactus").click(function () {
        $('#delete_contactus_id').val($(this).data('id'));
    });

    $('#yes_contactus_user').click(function () {
        $.ajax({
            url: base_url + 'admin/Settings/deletecontact',
            type: 'POST',
            data: {
                'deletecontact': $('#delete_contactus_id').val()
            },
            dataType: 'json',
            success: function (success) {
                location.reload();
            },
        })
    });


    //73. stock checking in home page

    function stockcheck(button) {
        var $btn = $(button);
        var $portfolio = $btn.closest('.portfolio-title');
        var product_id = $portfolio.find('a[data-id]').data('id');
        var $qtySpan = $portfolio.find('[data-qty]');
        var currentQty = parseInt($qtySpan.text());
        var newQty = currentQty + 1; // increment it by 1                              // confirm
        // alert(product_id);
        // alert(currentQty);

        $.ajax({
            url: base_url + 'website/stockcheck/index',
            type: 'POST',
            data: {
                'product_id': product_id
            },
            dataType: 'json',
            success: function (response) {
                if (response.success === 'success') {
                    var stock = parseInt(response.stock);

                    if (newQty < stock) {
                        $qtySpan.text(newQty); // increment the visible quantity
                    }
                    else {
                        $('#stockModal').modal('show');
                        $('.increment-btn[data-product-id="' + product_id + '"]').prop('disabled', true);
                        $('#stockModal .modal-body').text('Product out of stock');
                        setTimeout(function () {
                            $('#stockModal').modal('hide');
                        }, 2000)
                        // $('.increment-btn').prop('disabled', true);

                    }
                }
                else {
                    alert('Something went wrong.');
                }
                //    location.reload();
            }
        })

        // alert(product_id);
    }

    //74.stock checking in cart page

    function stockcheckcart(button) {
        var $btn = $(button);
        var $portfolio = $btn.closest('.qty-area');
        var product_id = $portfolio.find('#cart_product_id').val();
        var $qtySpan = $portfolio.find('[data-qty]');
        var currentQty = parseInt($qtySpan.text());
        var newQty = currentQty + 1; // increment it by 1

        $.ajax({
            url: base_url + 'website/Stockcheck/index',
            type: 'POST',
            data: {
                'product_id': product_id
            },
            dataType: 'json',
            success: function (response) {
                if (response.success === 'success') {
                    var current_available_stock = parseInt(response.stock);
                    if (newQty < current_available_stock) 
                    {
                        return current_available_stock;
                    }
                    else 
                    {
                        $('#stockModal').modal('show');
                        $('.cart-increment-btn[data-product-id="' + product_id + '"]').prop('disabled', true);
                        $('#stockModal .modal-body').text('Product out of stock');
                        setTimeout(function () {
                            $('#stockModal').modal('hide');
                        }, 2000)
                        // $('.increment-btn').prop('disabled', true);

                    }
                }
                else {
                    alert('Something went wrong.');
                }
                //    location.reload();
            }
        })
    }

    //75. product add to cart from wishlist

    $('.wish-cart').click(function () {

        var $row = $(this).closest('tr'); // get current row

        // Get data from row
        var product_id = $row.find('#wishlist_product_id').val();
        // var quantity = $row.find('#wishlist_quantity').val();

        // var product_name = $row.find('.product-name').data('name');
        // var product_price = $row.find('.price-cart').data('price');
        // var product_image = $row.find('td[data-image]').data('image');
        // var weight = $row.find('#weight').val();

        alert(product_id);
        // alert(product_name);
        // alert(product_price);
        // alert(product_image);
        // alert(quantity);
        // alert(weight);


        $.ajax({
            url: base_url + 'cart/wishtocart',
            type: 'POST',
            data: {
                'product_id': product_id,
                // 'product_name': product_name,
                // 'product_price': product_price,
                // 'product_image': product_image,
                // 'quantity': quantity,
                // 'weight': weight
            },
            dataType: 'json',
            success: function (response) {
                if(response.success === 'success'){
                 loadcart();
                loadcartitems();   
                }
                else{
                    alert('Something went wrong.');
                }
            },
        })
    })


});