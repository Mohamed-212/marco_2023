$(document).ready(function () {
    "use strict";
    var csrf_test_name = $("#CSRF_TOKEN").val();


    $("#add_supplier").on('submit', function (event) {
        event.preventDefault();
        var formdata = new FormData($(this)[0]);
        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: formdata,
            processData: false,
            contentType: false,
            success: function (data, status) {
                if (data == '1') {
                    $('#message').css('display', 'block');
                    $('#message').html('Supplier added successfully');
                    setTimeout(function () {
                        window.location.href = window.location.href;
                    }, 2000);
                } else if (data == '2') {
                    $('#error_message').css('display', 'block');
                    $('#error_message').html('Supplier already exist !');
                } else if (data == '3') {
                    $('#error_message').css('display', 'block');
                    $('#error_message').html('Supplier name and mobile is required!');
                }
            },
            error: function (xhr, desc, err) {
            }
        });
    });

    $('#variant_prices').on('click', function () {
        if ($(this).prop('checked') == true) {
            $('#set_variant_price').show('slow');
        } else {
            $('#set_variant_price').hide('slow');
        }
    });

    $("#add_category").on('submit', function (event) {
        event.preventDefault();
        var formdata = new FormData($(this)[0]);
        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: formdata,
            processData: false,
            contentType: false,
            success: function (data, status) {
                if (data == '1') {
                    $('#message1').css('display', 'block');
                    $('#message1').html('Category added successfully');
                    setTimeout(function () {
                        window.location.href = window.location.href;
                    }, 1000);
                } else if (data == '2') {
                    $('#error_message1').css('display', 'block');
                    $('#error_message1').html('Category already exist !');
                } else if (data == '3') {
                    $('#error_message1').css('display', 'block');
                    $('#error_message1').html('Category name required!');
                }
            },
            error: function (xhr, desc, err) {
            }
        });
    });


    $('.onsale_price').css({'display': 'none'});
    $('#onsale').on('change', function () {
        var onsale = $('#onsale option:selected').val();
        if (onsale == 1) {
            $('.onsale_price').css({'display': 'block'});
            $("#variant_prices").prop('checked', false);
            $('#set_variant_price').css({
                'display': 'none'
            });
            $('#variant_price_area').css({'display': 'none'});
        } else {
            $('.onsale_price').css({'display': 'none'});
            $('#variant_price_area').css({'display': 'block'});
        }
    });

    //Form wizard
    var $validator = $("#commentForm").validate();
    //Root wizard progress bar
    $('#rootwizard').bootstrapWizard({
        'tabClass': 'nav nav-pills',
        'onNext': validateTab,
        'onTabClick': validateTab
    });
    //Validate filed
    function validateTab(tab, navigation, index, nextIndex) {
        if (nextIndex <= index) {
            return;
        }
        var commentForm = $("#commentForm")
        var $valid = commentForm.valid();
        if ($valid) {
            var $total = navigation.find('li').length;
            var $current = index + 1;
            var $percent = ($current / $total) * 100;
            $('#rootwizard .progress-bar').css({width: $percent + '%'});
        } else {
            $validator.focusInvalid();
            return false;
        }
        if (nextIndex > index + 1) {
            for (var i = index + 1; i < nextIndex - index + 1; i++) {
                $('#rootwizard').bootstrapWizard('show', i);
                $valid = commentForm.valid();
                if (!$valid) {
                    $validator.focusInvalid();
                    return false;
                }
            }
            return false;
        }
    }
    $('#variant').on('change', function () {
        var variants = $(this).val();
        $.ajax({
            url: base_url + 'dashboard/Cproduct/get_default_variant',
            type: "post",
            data: {csrf_test_name: csrf_test_name, variants: variants},
            success: function (data) {
                $('#default_variant').html(data);
                var fulldata = '<option value=""></option>' + data;
                $('#size_var').html(fulldata);
            }
        })
    });
    // Variant Color
    $('#variant_colors').on('change', function () {
        var variants = $(this).val();
        $.ajax({
            url: base_url + 'dashboard/Cproduct/get_default_variant',
            type: "post",
            data: {
                csrf_test_name: csrf_test_name,
                variants: variants
            },
            success: function (data) {
                var fulldata = '<option value=""></option>' + data;
                $('#color_var').html(fulldata);
            }
        })
    });

    // --- product pricing starts --- //

    $.ajax({
        url: base_url + 'dashboard/Cproduct/find_pricing_types1',
        type: "POST",
        data: {csrf_test_name: csrf_test_name},
        dataType: 'json',
        success: function (data) {
            $('#pricetype1').html(data);
        },
        error: function () {
            $("#add-message").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                    '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong> Error </div>');
        }
    });

    $('#addpricerow').on('click', function (e) {
        e.preventDefault();
        var tableLength = $("#addprice tbody tr").length;
        var tableRow;
        var count;
        var nooftypes = 0;
        var idno;
        var idarray = [];

        if (tableLength > 0) {
            tableRow = $("#addprice tbody tr:last").attr('id');
            count = tableRow.substring(3);
            count = Number(count) + 1;
        } else {
            // no table row
            count = 1;
        }

        $.ajax({
            url: base_url + "dashboard/Cproduct/get_no_types",
            type: 'post',
            data: {
                csrf_test_name: csrf_test_name
            },
            dataType: 'json',
            success: function (response) {
                nooftypes = Number(response.nooftypes);
                //   alert(nooftypes);
                // alert(noofrows);

                var noofrows = 0;
                $("#addprice tbody tr").each(function (index, tr) {
                    idno = Number($(this).attr('id').substring(3));
                    var typevalue = Number($("#pricetype" + idno).val());
                    if (typevalue != 0) {
                        idarray.push(typevalue);
                        noofrows++;
                        // alert(idarray);                   
                    } else {
                        noofrows = nooftypes + 1;
                        Swal({
                            type: 'warning',
                            title: 'Please select pricing type!'
                        });
                    }
                });

                // alert(nooftypes);
                // alert(noofrows);
                if (noofrows > 0 && noofrows < nooftypes) {
                    $.ajax({
                        type: 'post',
                        url: base_url + 'dashboard/Cproduct/find_pricing_types2',
                        dataType: 'json',
                        data: {
                            csrf_test_name: csrf_test_name,
                            idarray: idarray
                        },
                        success: function (response) {
                            $("#addpricerow").button("reset");

                            var tr = '<tr id="row' + count + '" class="' + count + ' appended-new-row">' +
                                    ' <td class="col-sm-6">' +
                                    '<div class="col-sm-12 custom_select">' +
                                    '<div class="form-group row">' +
                                    '<select class="form-control pricing-control width_100p pricing_type" name="pricetype[' + count + ']" id="pricetype' + count + '"  onchange="">' +
                                    '<option value="">' + display('select_one') + ' </option>';
                            // console.log(response);
                            response.forEach(function (element) {
                                tr += '<option value="' + element.pri_type_id + '">' + element.pri_type_name + '</option>';
                            });

                            tr += '</select>' +
                                    '</div>' +
                                    '</div>' +
                                    '</td>' +
                                    ' <td class="col-sm-6">' +
                                    '  <div class="col-sm-12">' +
                                    '  <div class="form-group row">' +
                                    ' <div class="input-group">' +
                                    ' <input type="number" class="form-control text-left " onchange="check_price2(' + count + ')"  id="pricepri' + count + '" name="pricepri[' + count + ']" placeholder="0.00" />' +
                                    ' <div class="input-group-addon btn btn-danger remove_filter_row" onclick="removepricerow(' + count + ')"><i class="ti-minus"></i></div></div></div>' +
                                    '</td>' +
                                    '</tr>';
                            if (tableLength > 0) {
                                $("#addprice tbody tr:last").after(tr);
                            } else {
                                $("#addprice tbody").append(tr);
                            }
                            $("select.pricing-control").select2({
                                placeholder: "Select option",
                                allowClear: true
                            });
                        }
                    });
                } else if (noofrows == nooftypes) {
                    Swal({
                        type: 'warning',
                        title: 'No more pricing type!'
                    });
                }
            }
        });
    });

    // --- End product pricing --- //
//////////////// assembly_product/////////////////////// 

    $('#addassemblyprorow').on('click', function (e) {
        e.preventDefault();
        var tableLength = $("#addassemblypro tbody tr").length;
        var tableRow;
        var count;
        var idno;
        var noofrows = 0;

        if (tableLength > 0) {
            tableRow = $("#addassemblypro tbody tr:last").attr('id');
            count = tableRow.substring(3);
            count = Number(count) + 1;

        } else {
            // no table row
            count = 1;
            noofrows++;
        }


        $("#addassemblypro tbody tr").each(function (index, tr) {
            idno = Number($(this).attr('id').substring(3));
            // console.log(idno);
            var rowvalue = Number($(".assembly_product_id_" + idno).val());
            // console.log(rowvalue);
            if (rowvalue > 0) {

                noofrows++;

            } else {
                noofrows = 0;
                Swal({
                    type: 'warning',
                    title: 'Please select product name!'
                });
            }
        });
        if (count < 500 && noofrows > 0) {
            // var lastcount = count-1;
            //   document.getElementById('assemblypro'+lastcount).readOnly = true;
            $("#addassemblyprorow").button("reset");

            var tr = '<tr id="pro' + count + '" class="' + count + ' appended-new-row">' +
                    '<td class="col-sm-6">' +
                    '<div class="col-sm-12">' +
                    '<div class="form-group row">' +
                    '<div class="input-group">' +
                    '<input type="text" class="form-control assemblyproductSelection" onkeyup="assembly_productList(' + count + ')"  id="assemblypro' + count + '" name="assemblypro[' + count + ']" placeholder="' + display('product_name') + '"  />' +
                    '<input type="hidden" class="autocomplete_hidden_value assembly_product_id_' + count + '" value=""  name="assembly_product_id[' + count + ']"  />' +
                    '<div class="input-group-addon btn btn-danger remove_assembly_row" onclick="removeassemblyrow(' + count + ')"><i class="ti-minus"></i></div></div></div>' +
                    '</td>' +
                    '<td class="col-sm-3">' +
                    '<div class="col-sm-12">' +
                    '<div class="form-group row">' +
                    '<input type="text" name="product_whole[' + count + ']" id="price_whole_item_' + count + '" class="price_whole_item_' + count + ' form-control" min="0" readonly="" />' +
                    '<input type="hidden" class="price_item' + count + ' form-control" id="price_item_' + count + '" value=""  name="product_rate[' + count + ']" min="0" readonly=""  />' +
                    '</div></div></td>' +
                    '<td class="col-sm-3">' +
                    '<div class="col-sm-12">' +
                    '<div class="form-group row">' +
                    '<input type="hidden" class="product_price' + count + ' form-control" id="product_price_' + count + '" value=""  name="product_price[' + count + ']" min="0" readonly=""  />' +
                    '</div></div></td>' +
                    '</tr>';
            if (tableLength > 0) {
                $("#addassemblypro tbody tr:last").after(tr);
            } else {
                $("#addassemblypro tbody").append(tr);
            }

        } else if (count >= 500) {
            Swal({
                type: 'warning',
                title: 'No more Rows!'
            });
        }

    });

// --- End assembly_product --- //

    //--- product filter starts
    var f_count = 2;
    $('#add_filter_row').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: base_url + 'dashboard/Cproduct/find_filter_types',
            dataType: 'json',
            data: {
                csrf_test_name: csrf_test_name,
                f_count: f_count,
            },
            success: function (resu) {
                var row_html = '<div class="add_filter_row_' + f_count + '">' + resu + '</div>'
                $('.filter_type_row').append(row_html);
                // select 2 dropdown 
                $("select.filter-control").select2({
                    placeholder: "Select option",
                    allowClear: true
                });
                $('.filter_type').on('change', function () {
                    e.preventDefault();
                    var type_id = $(this).val();
                    var f_attr = $(this).attr('data-sl');
                    $.ajax({
                        type: 'post',
                        url: base_url + 'dashboard/Cproduct/find_filter_items',
                        dataType: 'json',
                        data: {
                            csrf_test_name: csrf_test_name,
                            type_id: type_id
                        },
                        success: function (resul) {
                            $('#filter_name_' + f_attr).html(resul);
                        }
                    });
                });
                $('.remove_filter_row').on('click', function () {
                    $(this).parent().parent().parent().parent().parent().remove();
                });
                f_count++;
            }
        });
    });
    $('.filter_type').on('change', function (e) {
        e.preventDefault();
        var type_id = $(this).val();
        $.ajax({
            type: 'post',
            url: base_url + 'dashboard/Cproduct/find_filter_items',
            dataType: 'json',
            data: {
                csrf_test_name: csrf_test_name,
                type_id: type_id
            },
            success: function (resul) {
                $('.filter_name').html(resul);
            }
        });
    });

    var row_count = 1;
    $('#add_row').on('click', function () {
        var csrf_test_name = $("#CSRF_TOKEN").val();
        $.ajax({
            type: "POST",
            url: base_url + 'dashboard/Cproduct/add_translation',
            data: {csrf_test_name: csrf_test_name, row_count: row_count},
            cache: false,
            success: function (datas)
            {
                $('.new_row').append(datas);
                // select 2 dropdown 
                $("select.product-control").select2({
                    placeholder: "Select option",
                    allowClear: true
                });
                $('.summernote').summernote();
                row_count++;
                $('.remove_row').on('click', function () {
                    $(this).parent().parent().parent().parent().parent().parent().remove();
                });
            }
        });
    });
    $('.remove_data_row').on('click', function () {
        $(this).parent().parent().parent().parent().remove();
    });

});
//insert multiple image row
var imageRowCounter = 1;
function addImageRow(air) {
    "use strict";
    var imageRow = '';
    imageRow = '<div id="image_row_' + imageRowCounter + '"><div class="row"><div class="col-md-6"> <div class="form-group row"><label for="imageUpload" class="col-sm-4 col-form-label">' + display("image") + '<i class="text-danger">*</i></label><div class="col-sm-8"><input required class="form-control" name="imageUpload[]" type="file" id="imageUpload" data-toggle="tooltip" data-placement="top" title="" aria-required="true"> </div></div></div> <input type="button" value="+" onClick="addImageRow(1);" class="btn btn-info" id="image-add"> <input type="button" value="-" onclick="deleteImageRow(this);"  class="btn btn-danger"  id="image-remove"></div></div>';
    $('#image_row').append(imageRow);
    imageRowCounter++;
}
function deleteImageRow(dir) {
    "use strict";
    var imageRowDiv = $(dir).prev().closest('div').parent().attr('id');
    if (imageRowDiv != 'image_row_0') {
        $('#' + imageRowDiv).remove();
    }
}



// Variant wise price set
$('#variant-row-add').on('click', function (e) {
    e.preventDefault();
    var key_val = $(this).attr('data-key');
    var size_variant_id = $('#size_var').val();
    var size_variant_txt = $('#size_var option:selected').text();
    var color_variant_id = $('#color_var').val();
    var color_variant_txt = $('#color_var option:selected').text();
    var var_price = $('#var_price').val();
    if ((size_variant_id != '') && (var_price != '')) {
        var variant_row = '<tr id="row_' + key_val + '"><td>' + size_variant_txt + ' <input type="hidden" name="size_variant[' + key_val + ']" value="' + size_variant_id + '"></td><td>' + color_variant_txt + ' <input type="hidden" name="color_variant[' + key_val + ']" value="' + color_variant_id + '"></td><td>' + var_price + ' <input type="hidden" name="variant_price_amt[' + key_val + ']" value="' + var_price + '"></td><td><input type="button" value="-" onclick="deleteVariantRow(' + key_val + ');" class="btn btn-danger" id="variant-row-remove"></td></tr>';
        $('#variant_area').append(variant_row);
        $('#variant-row-add').attr('data-key', parseInt(key_val) + 1);
        $('#size_var').val('').trigger('change');
        $('#color_var').val('').trigger('change');
        $('#var_price').val('');
    } else {
        Swal({
            type: 'warning',
            title: 'Please select size and price!'
        });
    }
});

function deleteVariantRow(key_val) {
    "use strict";
    $('#row_' + key_val).remove();
}



function removepricerow(row = null) {
    if (row) {
        $("#row" + row).remove();
    } else {
        alert('error! Refresh the page again');
}
}
function removeassemblyrow(row = null) {
    if (row) {
        var price = Number($('#price_item_' + row).val());
        var price2 = Number($('#product_price_' + row).val());
        // var wholePrice = Number($('#price_whole_item_' + row).val());
        // var customerPrice = Number($('#product_customer_price_' + row).val());
        // console.log(price, price2);
        var supplier_price = Number($('#supplier_price').val());
        $('#supplier_price').val(supplier_price - price);

        
        var sell_price = Number($('#sell_price').val());
        $('#sell_price').val(sell_price - price2);

        // var wholePrice = Number()
        
        $("#pro" + row).remove();
    } else {
        alert('error! Refresh the page again');
}
}
function  check_price() {

    let sell_price = Number($("#sell_price").val());
    let supplier_price = Number($("#supplier_price").val());
    if (supplier_price > 0) {
        if (sell_price < supplier_price) {
            alert('Without Cases Priceis lower than supplier price');
            $("#sell_price").val(supplier_price);

        }
    }

}
function  check_price2(row = null) {

    let sell_price = Number($('#pricepri' + row).val());
    let supplier_price = Number($("#supplier_price").val());
    if (supplier_price > 0) {
        if (sell_price < supplier_price) {
            alert('Without Cases Priceis lower than supplier price');
            $('#pricepri' + row).val(supplier_price);

        }
}

}

