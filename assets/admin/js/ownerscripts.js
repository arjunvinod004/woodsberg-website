//1. Get current date and time in owner dashboard
//2. Change time from settings
//3. Add holiday from owner dashboard
//4. Fetch holidays and delete a holiday
//5. Add user from owner dashboard
//6.Form submission add user from owner dashboard
//7. Password change from owner dashboard
//8. Edit user from owner dashboard
//9. Delete user from owner dashboard
//10. Report from owner dashboard
//11. Add stock from owner dashboard
//12. Remove stock from owner dashboard
//13. Product details tab click functions
//14. Edit dish popup tab.Get default product tab details 
//15.Edit dish popup tab.Get default product tab details
//16. Save product tab form data
//17.Prevent modal close outside click
//18. Search product on keyup frm owner dashboard
//19. Next available time updation
//20. Scroll top jquery
//21. Change Quck availability from order dashboard
//22. Change table secret code and list tables from settings
//23. Clear stock from settings page.
//24. Close order from settings page
//25. Enable or Disable KOT print from settings page
//26. Asigining table to users from settings page
//27. Report from supplier dashboard
//28. Delete product from admin dashboard

$(document).ready(function () {

    var base_url = 'http://localhost/emigo-restaurant-application/';
    // var base_url = 'https://qr-experts.com/emigo-restaurant-application/';

    //new DataTable('#example');
    $(document).on('click', '.emigo-close-btn', function () {
        location.reload();
    });

    //20. Scroll top jquery
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#goToTop').fadeIn();
        } else {
            $('#goToTop').fadeOut();
        }
    });


    $('#goToTop').click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    //21. Change Quck availability from order dashboard
    $(document).on('change', '.change_availability', function () {
        isAvailable = $(this).val();
        productID = $(this).data('id');
        $('#confirmModal').modal('show');
    });

    $('#confirmStatusChange').click(function () {
        // alert(isAvailable);
        // alert(productID);
        $.ajax({
            url: base_url + "owner/Product/changeProductAvailability", // Correct endpoint
            type: 'POST',
            data: {
                is_active: isAvailable,
                store_product_id: productID
            },
            success: function (response) {
                location.reload();
            }
        });
    });

    $('#cancelStatusChange').click(function () {
        location.reload();
    });



    //1. Get current date and time in owner dashboard
    fetchHolidays();
    updateDateTime();
    setInterval(updateDateTime, 1000);
    function getCurrentDateTime() {
        const now = new Date();
        const date = now.toLocaleDateString(); // Format: MM/DD/YYYY
        const time = now.toLocaleTimeString(); // Format: HH:MM:SS AM/PM
        return `${date}, ${time}`;
    }

    function updateDateTime() {
        $('#dateTimeButton').text(getCurrentDateTime());
    }

    //2. Change time from settings
    $('#edit_time').click(function (e) {
        let formData = new FormData($('#edittimes')[0]);
        $.ajax({
            url: base_url + "owner/Settings/editstoreTime",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    $('#editopeningandclosing').modal('hide');
                    location.reload();
                }
            },
        });
    });

    //3. Add holiday from owner dashboard
    $('#add_holiday').click(function (e) {
        let formData = new FormData($('#addholidays')[0]);
        $.ajax({
            url: base_url + "owner/settings/addHoliday",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    console.log(response); // Log response for debugging
                    $('#holidaydate_error').html('');
                    $('#holidayname_error').html('');
                    $('#holidays_date').val('');
                    $('#holidays_name').val('');
                    $('#holidays_description').val('');
                    fetchHolidays();
                } else if (response.errors.holiday_date) {
                    $('#holidaydate_error').html(response.errors
                        .holiday_date);
                }
                if (response.errors.holiday_name) {
                    $('#holidayname_error').html(response.errors
                        .holiday_name);
                }
            },
        });
    });

    //4. Fetch holidays and delete a holiday
    function fetchHolidays() {
        $.ajax({
            url: base_url + "owner/settings/getHolidaysByStoreId",
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                renderTable(data);
            },
            error: function (error) {
                console.error('Error fetching holidays:', error);
            }
        });
    }

    // Render holidays in the table
    function renderTable(data) {
        const tableBody = $('#holidayTable tbody');
        tableBody.empty(); // Clear existing rows
        data.forEach(function (holiday, index) {
            const row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${holiday.holiday_name}</td>
                            <td>${holiday.holiday_date}</td>
                            <td><button class="btn btn-danger delete-btn" data-id="${holiday.id}">Delete</button></td>
                        </tr>
                    `;
            tableBody.append(row);
        });

        // Attach delete event to buttons
        $('.delete-btn').click(function () {
            const id = $(this).data('id');
            deleteHoliday(id);
        });
    }

    // Delete a holiday
    function deleteHoliday(id) {
        if (!confirm('Are you sure you want to delete this holiday?')) return;

        $.ajax({
            url: base_url + "owner/Settings/DeleteHoliday",
            type: "POST",
            data: {
                id: id
            },
            success: function (response) {
                const result = JSON.parse(response);
                if (result.success) {
                    // alert('Holiday deleted successfully.');
                    fetchHolidays(); // Refresh the table
                } else {
                    alert(result.message || 'Failed to delete the holiday.');
                }
            },
            error: function (error) {
                console.error('Error deleting holiday:', error);
            }
        });
    }



    //5. Add user from owner dashboard
    $('.adduser').click(function () {
        $("#iframe_body").show();
        $("#productForm").hide();
        document.getElementById('iframe_body').src = base_url + "owner/settings/listStoreUsers/";
    });


    //6.Form submission add user from owner dashboard
    $('#add_user').click(function (e) {
        let formData = new FormData($('#addusers')[0]);
        $.ajax({
            url: base_url + "owner/Settings/addUserValidation",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            /*************  ✨ Codeium Command ⭐  *************/
            /******  0b7c96ce-e4e5-430e-bba5-068a0e2f0f27  *******/
            success: function (response) {
                console.log(response);
                if (response.success) {
                    console.log(response);
                    $('#user_name_error').html('');
                    $('#user_email_error').html('');
                    $('#user_phoneno_error').html('');
                    $('#user_address_error').html('');
                    $('#user_username_error').html('');
                    $('#user_password_error').html('');
                    $('#user_role_error').html('');
                    $('#adduser').modal('hide');
                    location.reload();
                } else {
                    if (response.errors.user_name) {
                        $('#user_name_error').html(response.errors.user_name);
                    } else {
                        $('#user_name_error').html('');
                    }

                    if (response.errors.user_email) {
                        $('#user_email_error').html(response.errors.user_email);
                    } else {
                        $('#user_email_error').html('');
                    }

                    if (response.errors.user_phoneno) {
                        $('#user_phoneno_error').html(response.errors.user_phoneno);

                    } else {
                        $('#user_phoneno_error').html('');
                    }

                    if (response.errors.user_address) {
                        $('#user_address_error').html(response.errors.user_address);
                    } else {
                        $('#user_address_error').html('');
                    }
                    if (response.errors.user_username) {
                        $('#user_username_error').html(response.errors.user_username);
                    } else {
                        $('#user_username_error').html('');
                    }
                    if (response.errors.user_password) {
                        $('#user_password_error').html(response.errors.user_password);

                    } else {
                        $('#user_password_error').html('');
                    }

                    if (response.errors.role) {
                        $('#user_role_error').html(response.errors.role);
                    } else {
                        $('#user_role_error').html('');
                    }
                }
            },
        });
    })


    //7. Password change from owner dashboard
    $(document).on('click', '.password-change', function () {
        var id = $(this).data('id');
        $('#user_id_change').val(id);
    });

    $('#change_password').click(function () {
        let formData = new FormData($('#passwordchange')[0]);
        $.ajax({
            url: base_url + "owner/Settings/ChangePassword",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    console.log(response);
                    location.reload();
                } else {
                    if (response.errors && response.errors.password_changes) {
                        $('#password_change_error').html(response.errors.password_changes);
                    }
                }
            },
        })
    })

    //8. Edit user from owner dashboard
    $(document).on('click', '.edit-user', function () {
        var id = $(this).data('id');
        $('#user_id').val(id);
        $('#user_name').val($(this).data('name'));
        $('#user_email').val($(this).data('email'));
        $('#user_phoneno').val($(this).data('phone'));
        $('#edit_user_role').val($(this).data('role'));
    });
    $(document).on('click', '.delete-user', function () {
        var id = $(this).data('id');
        $('#delete_id').val(id);
    });
    $('#edit_user').click(function () {
        let formData = new FormData($('#editusers')[0]);
        formData.append('user_id', $('#user_id').val());
        $.ajax({
            url: base_url + "owner/Settings/UpdateEditUser",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                if (response.success) {
                    $('#edituser').modal('hide');
                    location.reload();
                } else {
                    if (response.errors.edit_user_email) {
                        $('#edit_user_email_error').html(response.errors.edit_user_email);
                    }

                    if (response.errors.edit_user_phoneno) {
                        $('#edit_user_phoneno_error').html(response.errors
                            .edit_user_phoneno);
                    }
                }

            }
        })

    });

    //9. Delete user from owner dashboard
    $('#yes_del_user').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + "owner/Settings/DeleteUser",
            data: {
                'id': $('#delete_id').val()
            },
            success: function (data) {
                window.location.href = '';
            }
        });
    });


    //10. Report from owner dashboard
    $('.sales').click(function () {
        $('#table_name').html('REPORT -' + $(this).attr('data-name'));
        document.getElementById('table_iframe_sales').src = base_url + 'owner/order/salesReport/' + $(this).attr('data-store-id');
    });

    $('.user').click(function () {
        $('#table_name').html('REPORT -' + $(this).attr('data-name'));
        document.getElementById('table_iframe_user').src = base_url + 'owner/order/userReport/' + $(this).attr('data-store-id');
    });

    $('.delivery').click(function () {
        $('#table_name').html('REPORT -' + $(this).attr('data-name'));
        document.getElementById('table_iframe_delivery').src = base_url + 'owner/order/deliveryReport/' + $(this).attr('data-store-id');
    });

    //27. Report from supplier dashboard
    $('.supplier_sales').click(function () {
        $('#table_name').html('REPORT -' + $(this).attr('data-name'));
        document.getElementById('table_iframe_sales').src = base_url + 'owner/order/supplierSalesReport/' + $(this).attr('data-store-id');
    });

    $('.supplier_user').click(function () {
        $('#table_name').html('REPORT -' + $(this).attr('data-name'));
        document.getElementById('table_iframe_user').src = base_url + 'owner/order/SupplierUserReport/' + $(this).attr('data-store-id');
    });

    // $('.supplier_delivery').click(function () {
    //     $('#table_name').html('REPORT -' + $(this).attr('data-name'));
    //     document.getElementById('table_iframe_delivery').src = base_url + 'owner/order/deliveryReport/' + $(this).attr('data-store-id');
    // });

    //11. Add stock from owner dashboard
    $(document).on('click', '.open-modal', function () {

        $('#addstock').on('shown.bs.modal', function () {
            $('#stocks').val('');
            $('#stocks').focus();
        });

        var id = $(this).attr('data-id');
        $('#product_id').val(id);
        $('#addStockBtn').click(function () {
            var id = $(this).attr('data-id');
            $('#addstocks').val(id);
            let formData = new FormData($('#productstock')[
                0]);
            $.ajax({
                url: base_url + "owner/Product/addstocks",
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    if (response.success) {
                        $('#stocks').val('');
                        $('#addstock').modal('hide');
                        $('#addstocks_error').html('');
                        // location.reload();
                    } else if (response.errors.pu_qty) {
                        $('#addstocks_error').html(response.errors.pu_qty);
                    }
                },

            });
        })
    })

    //12. Remove stock from order dashboard
    $(document).on('click', '.remove-modal', function () {

        $('#removestock').on('shown.bs.modal', function () {
            $('#remove_stocks').val('');
            $('#removestocks_error').html('');
            $('#remove_stocks').focus();
        });

        var id = $(this).attr('data-id');
        $('#product_id_remove').val(id);
        $('#removeStockBtn').click(function () {
            let formData = new FormData($('#removesstock')[
                0]);
            $.ajax({
                url: base_url + "owner/Product/removestocks",
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        $('#remove_stocks').val('');
                        $('#removestock').modal('hide');
                        $('#removestocks_error').html('');
                        location.reload();
                    } else if (response.errors.sl_qty) {
                        $('#removestocks_error').html(response.errors.sl_qty).show();
                    }
                    else if (response.errors.message) {
                        $('#removestocks_error').html(response.errors.message).show();
                    } else {
                        $('#remove_stocks').val('');
                        $('#removestock').modal('hide');
                        $('#removestocks_error').html('');
                    }
                },
            })
        })
    })

    //13. Product details tab click functions
    $('.editProduct').click(function () {
        var product_id = $('#hiddenField').val();
        document.getElementById('iframe_body').src = base_url + 'owner/product/load_variants/' + product_id;
    });

    $('.addVariant').click(function () {
        $("#iframe_body").show();
        $("#productForm").hide();
        var product_id = $('#hiddenField').val();
        document.getElementById('iframe_body').src = base_url + 'owner/product/load_variants/' + product_id;
    });

    $('.addAddons').click(function () {
        $("#iframe_body").show();
        $("#productForm").hide();
        var product_id = $('#hiddenField').val();
        document.getElementById('iframe_body').src = base_url + 'owner/product/load_addons/' + product_id;
    });

    $('.addRecipe').click(function () {
        $("#iframe_body").show();
        $("#productForm").hide();
        var product_id = $('#hiddenField').val();
        document.getElementById('iframe_body').src = base_url + 'owner/product/load_recipes/' + product_id;
    });

    $('.addPhotos').click(function () {
        $("#iframe_body").show();
        $("#productForm").hide();
        var product_id = $('#hiddenField').val();
        document.getElementById('iframe_body').src = base_url + 'owner/product/load_images/' + product_id;
    });

    $('.listCombo').click(function () {
        $("#iframe_body").show();
        $("#productForm").hide();
        var product_id = $('#hiddenField').val();
        document.getElementById('iframe_body').src = base_url + 'owner/combo/load_combo/' + product_id;
    });


    //14.Edit dish popup tab.Get default product tab details 
    $(document).on('click', '.edit-btn', function () {
        $("#productForm").show();
        $("#iframe_body").hide();
        var id = $(this).attr('data-id');
        var isCustomizable = $(this).attr('data-isCustomizable'); //alert(isCustomizable);
        if (isCustomizable == 1) {
            $(".product_rate").addClass("d-none");
            $(".product_rate_label").addClass("d-none");
            $(".isCustomize").removeClass("d-none");
        } else {
            $(".product_rate").removeClass("d-none");
            $(".product_rate_label").removeClass("d-none");
            $(".isCustomize").addClass("d-none");

        }
        $('#hiddenField').val(id);
        $('#isCustomizable').val(isCustomizable);
        $('#product_id_new').val(id);
        $.ajax({
            url: base_url + "owner/Product/getDescriptions",
            type: 'POST',
            data: {
                id: id
            },
            dataType: 'json',
            success: function (response) {
                $('#store_is_customisable').val(response.data
                    .customisable);
                $('#store_product_rate').val(response.data
                    .rate);
                $('#store_product_name_ma').val(response.data
                    .malayalam_name);
                $('#store_product_name_en').val(response.data
                    .english_name);
                $('#store_product_name_hi').val(response.data
                    .hindi_name);
                $('#store_product_name_ar').val(response.data
                    .arabic_name);
                $('#description_malayalam').val(response.data
                    .malayalam_desc);
                $('#description_english').val(response.data
                    .english_desc);
                $('#description_hindi').val(response.data.hindi_desc);
                $('#description_arabic').val(response.data.arabic_desc);

            },
            error: function () {
                alert('An error occurred while fetching data.');
            }
        });
    });

    //15.Edit dish popup tab.Get default product tab details 
    $(document).on('click', '.productDetails', function () {
        $("#productForm").show();
        $("#iframe_body").hide();
        var id = $('#hiddenField').val();
        var isCustomizable = $('#isCustomizable').val();
        if (isCustomizable == 0) {
            $(".isCustomize").addClass("d-none");
        } else {
            $(".isCustomize").removeClass("d-none");
        }
        $('#hiddenField').val(id);
        $('#product_id_new').val(id);
        $.ajax({
            url: base_url + "owner/Product/getDescriptions",
            type: 'POST',
            data: {
                id: id
            },
            dataType: 'json',
            success: function (response) {
                $('#store_product_rate').val(response.data
                    .rate);
                $('#store_product_name_ma').val(response.data
                    .malayalam_name);
                $('#store_product_name_en').val(response.data
                    .english_name);
                $('#store_product_name_hi').val(response.data
                    .hindi_name);
                $('#store_product_name_ar').val(response.data
                    .arabic_name);
                $('#description_malayalam').val(response.data
                    .malayalam_desc);
                $('#description_english').val(response.data
                    .english_desc);
                $('#description_hindi').val(response.data.hindi_desc);
                $('#description_arabic').val(response.data.arabic_desc);

            },
            error: function () {
                alert('An error occurred while fetching data.');
            }
        });
    });


    //16. Save product tab form data
    $('#saveProduct').click(function () {
        let formData = new FormData($('#productForm')[
            0]); // Capture the form data, including files
        //alert(formData);
        $.ajax({
            url: base_url + "owner/Product/changeDescriptions", // URL to the controller method
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the Content-Type header
            success: function (response) {
                console.log(response);

                if (response.errors) {
                    if (response.errors.description_malayalam) {
                        $('#description_malayalam_error').html(response.errors
                            .description_malayalam);
                    } else if (response.errors.description_english) {
                        $('#description_english_error').html(response.errors
                            .description_english);
                    } else if (response.errors.description_hindi) {
                        $('#description_hindi_error').html(response.errors
                            .description_hindi);
                    } else if (response.errors.description_arabic) {
                        $('#description_arabic_error').html(response.errors
                            .description_arabic);
                    }
                } else {
                    const customMessage =
                        "Your product has been Updated successfully!";
                    $("#successMessage").text(customMessage).show();
                    $("#successModal").modal("show");
                    setTimeout(function () {
                        $("#successModal").modal("hide");
                        $("#Edit-dish").modal("hide");
                        location.reload();
                    }, 3000);

                }
            },
            error: function (xhr) {
                $('#response').html('<p>An error occurred: ' + xhr
                    .responseText +
                    '</p>');
            }
        });
    });

    //17.Prevent modal close outside click
    // var myModal = new bootstrap.Modal(document.getElementById('Edit-dish'), {
    //     backdrop: 'static',
    //     keyboard: false
    // });


    //18. Search product on keyup frm owner dashboard
    $('#search_product').on('keyup', function () {
        var search = $(this).val(); //alert(search);
        $.ajax({
            url: base_url + "owner/Product/searchProductOnKeyUp",
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
    })

    // $('#product-search__button').on('keyup', function () {
    //     var search = $(this).val(); //alert(search);
    //     $.ajax({
    //         url: base_url + "owner/Product/searchProductOnKeyUp",
    //         type: 'GET', // HTTP method (can be POST if needed)
    //         data: {
    //             search: search
    //         }, // Data sent to the controller
    //         success: function (response) {
    //             console.log(response); // Log the response for debugging
    //             $('#search_result_container').html(response); // Update the HTML content of a container
    //         },
    //         error: function (xhr, status, error) {
    //             console.error('Error: ' + error);
    //         }
    //     })
    // })

    //19. Next available time updation
    $(document).on('click', '.nextavialable-modal', function () {
        var id = $(this).attr('data-id');
        $('#product_id_time').val(id)
    })
    $('#nextavaialabletimes').click(function () {
        var hours = $('#hours').val();
        var minutes = $('#minutes').val();
        var ampm = $('#ampm').val();
        var time = $('#available_select').val() + hours + ":" + minutes + " " + ampm;
        let formData = new FormData($('#avialablestimes')[
            0]);
        formData.append('product_id', $('#product_id_time').val());
        formData.append('time', time);
        $.ajax({
            url: base_url + "owner/Product/avialabletime",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response); // Log response for debugging
                if (response.success) {
                    location.reload();
                }
            },
        })
    });


    //22. Change table secret code and list tables from settings

    $('#list-table').click(function () {
        fetchTableRecords();
        $('#list-tables').modal('show');
    });

    function fetchTableRecords() {
        $.ajax({
            url: base_url + "owner/settings/load_store_tables",
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                let tbody = $('#Table-list tbody');
                tbody.empty(); // Clear existing rows
                $.each(data, function (index, table) {
                    let row = $('<tr></tr>');
                    let tableName = table.table_name ? table.table_name : "";
                    let store_table_name = table.store_table_name ? table.store_table_name : "";
                    let secret_code = table.secret_code ? table.secret_code : "";
                    row.append(`<td>${index + 1}</td>`);
                    row.append(`<td><input type="text" value="${tableName}" class="form-control editable" data-id="${table.table_id}" data-field="table_name"></td>`);
                    row.append(`<td><input type="text" value="${store_table_name}" class="form-control  editable" data-id="${table.table_id}" data-field="store_table_name"></td>`);
                    row.append(`<td><input type="text" value="${secret_code}" class="form-control  editable" data-id="${table.table_id}" data-field="secret_code"></td>`);
                    tbody.append(row);
                });
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }

    $(document).on('blur', '.editable', function () {
        let row = $(this).closest('tr');
        let tableId = row.find('.editable').data('id'); // Get table ID from any input
        let tableName = row.find('[data-field="table_name"]').val(); // Get table_name
        let storeTableName = row.find('[data-field="store_table_name"]').val(); // Get store_table_name
        let secretCode = row.find('[data-field="secret_code"]').val(); // Get secret_code
        $.ajax({
            url: base_url + "owner/settings/update_table",
            method: 'POST',
            data: { tableid: tableId, table_name: tableName, store_table_name: storeTableName, secret_code: secretCode },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    //alert('Record updated successfully');
                } else {
                    console.error('Error updating record');
                }
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });

    });
    
    
     //28. Delete product.
    $('.delete_product').click(function () {
        $('#Edit-dish').modal('hide');
        productID = $('#hiddenField').val();
        $('#confirmDeleteProduct').modal('show');
    });

    $('#confirmDeleteProduct').click(function () {
        $.ajax({
            url: base_url + "owner/stock/delete_product", // Correct endpoint
            data: { product_id: productID },
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                $('#confirmDeleteProduct').modal('hide');
                location.reload();
            }
        });
    });


    //23. Clear stock from settings page.
    $('.clearstock').click(function () {
        $('#confirmModalStock').modal('show');
    });

    $('#confirmClearStock').click(function () {
        //alert(isAvailable); alert(productID);
        $.ajax({
            url: base_url + "owner/settings/clearStoreStock", // Correct endpoint
            type: 'POST',
            success: function (response) {
                $('#confirmModalStock').modal('hide');
                location.reload();
            }
        });
    });

    //24. Close order from settings page
    $('.close-order').click(function () {
        $('#confirmCloseOrder').modal('show');
    });

    $('.isOnlineOrderEnable').click(function () {
        $.ajax({
            url: base_url + "owner/settings/ChangeOnlineOrderStatus", // Correct endpoint
            type: 'POST',
            data: { 'status': '1' },
            success: function (response) {
                $('#confirmModalStock').modal('hide');
                location.reload();
            }
        });
    });
    $('.isOnlineOrderDisable').click(function () {
        $.ajax({
            url: base_url + "owner/settings/ChangeOnlineOrderStatus", // Correct endpoint
            type: 'POST',
            data: { 'status': '0' },
            success: function (response) {
                $('#confirmModalStock').modal('hide');
                location.reload();
            }
        });
    });
    //25. Enable or Disable KOT print from settings page
    $(document).on('click', '#is_kot_print', function () {
        var isChecked = $(this).is(':checked') ? 1 : 0;
        $.ajax({
            url: base_url + "owner/Settings/kotPrintEnable",
            method: 'POST',
            data: { is_kot_print_enable: isChecked },
            dataType: 'json',
            success: function (response) {
                $('#kotPrintMessage').text(response.message);
                $('#confirmModalKot').modal('show');

            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });

    //26. Asigining table to users from settings page
    $(document).on('click', '.assign-table', function () {
        $('#user_id_for_assigning').val($(this).data('id')); // User id from data attribute
        var user_id = $(this).data('id');
        $.ajax({
            url: base_url + "owner/Settings/GetAlreadyAssignedTables", //Return already assigned tables and checcked tables assigned when modal display
            type: "POST",
            data: { user_id: user_id }, // Send only user_id to fetch assigned tables
            dataType: "json",
            success: function (response) {
                console.log(response);
                //Uncheck all checkboxes first
                $('.table-checkbox').prop('checked', false);
                $('#tableTakeaway').prop('checked', false); // Pickup
                $('#tableDelivery').prop('checked', false); // Delivery

                // Loop through the response and check the assigned tables
                if (response.assignedTables) {
                    response.assignedTables.forEach(function (table_id) {
                        $('.table-checkbox[value="' + table_id + '"]').prop('checked', true);
                    });
                }

                // Check Is Delivery & Is Pickup based on response
                if (response.enable_delivery == 1) {
                    $('#tableDelivery').prop('checked', true);
                }
                if (response.enable_pickup == 1) {
                    $('#tableTakeaway').prop('checked', true);
                }

                // Show the modal after updating checkboxes
                $('#tableassign').modal('show');
            }
        });
    });

    function toggleTableAssignButton() {
        if ($("input[name='options[]']:checked").length > 0) {
            $("#assign_table_btn").prop("disabled", false);
        } else {
            $("#assign_table_btn").prop("disabled", false);
        }
    }

    toggleTableAssignButton();// Check initially on page load


    $("input[name='options[]']").on("change", function () {  // Listen for changes in checkbox selection
        toggleTableAssignButton();
    });

    $("#table_assign_form").on("submit", function (e) {
        e.preventDefault(); // Prevent form submission

        let selectedTables = [];
        let isPickup = false;
        let isDelivery = false;

        // Loop through all checked checkboxes
        $("input[name='options[]']:checked").each(function () {
            let value = $(this).val();
            if (value === "PK") {
                isPickup = true;  // Takeaway selected
            } else if (value === "DL") {
                isDelivery = true; // Delivery selected
            } else {
                selectedTables.push(value); // Store selected tables
            }
        });

        let formData = {
            user_id: $("#user_id_for_assigning").val(),
            selectedTables: selectedTables,
            isPickup: isPickup,
            isDelivery: isDelivery
        };

        $.ajax({
            url: base_url + "owner/Settings/TableAssign",
            type: "POST",
            data: JSON.stringify(formData),
            contentType: "application/json",
            success: function (response) {
                $('#tableassign').modal('hide');
            }
        });
    });



});