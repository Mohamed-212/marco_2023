"use strict";

var count = 2;
var limits = 500;
var csrf_test_name = $("#CSRF_TOKEN").val();

// Counts and limit for invoice
$(document).ready(function () {
    var rowCount = $('table #addinvoiceItem tr').length;
    if(rowCount > 0){
        count = rowCount + 1;
    }
});

// select all
function select_all(){
    if($('#all_pro').prop('checked') == true){
        $('.check_pro_id').prop('checked', true);
    }else{
        $('.check_pro_id').prop('checked', false);
    }
}

// search product by model
function product_per_model(){
    var supplier_id = $("#supplier_id").val();
    var currency_id = $("#currency_id").val();
    var model_no = $("#model_no").val();
    var base_url = $('.baseUrl').val();

    //Supplier id existing check
    if (supplier_id == 0) {
        alert(display("please_select_supplier"));
        return false;
    }

    if (currency_id == 0) {
        alert("Please Select Currency");
        return false;
    }
    $("#model_no_text").html('');
    $.ajax({
        url: base_url + "dashboard/Cinvoice/product_search_by_model",
        method: "post",
        dataType: "json",
        data: {
            csrf_test_name: csrf_test_name,
            term: model_no,
        },
        success: function (data) {
            $.each(data, function(k, v) {
                $("#model_no_text").append('<tr>' +
                    '<td class="text-center">' +
                    '<input type="checkbox" class="check_pro_id" id="prod'+v.value+'" value="'+v.value+'">' +
                    '<input type="hidden" class="check_pro_id" value="'+v.label+'">' +
                    '</td>' +
                    '<td class="text-center"><label class="pointer" for="prod'+v.value+'">'+v.label+'</lable></td>' +
                    '</tr>');
            });
            if(data.length > 0){
                $("#modelModal").modal('show');
            }else{
                alert("No Item Found");
            }
        },
    });
}

// add selected product to table
function add_products_model(){
    var ids = [];
    var names = [];
    $('.check_pro_id:checkbox:checked').each(function(index, value) {
        ids.push(value.value);
        names.push($(this).next().val());
    });
    $.each(ids, function(k, v) {
        var base_url = $('.baseUrl').val();
        var current_count = count-1;
        if($("#product_name_"+(count-1)).next().val()){
            current_count = count;
            addInputField('addinvoiceItem');
        }
        $("#product_name_"+current_count).next().val(v);
        $("#product_name_"+current_count).val(names[k]);
        var sl = current_count;
        var id = v;
        var dataString = "csrf_test_name=" + csrf_test_name + "&product_id=" + id;
        var qnttClass = 'ctnqntt' + current_count;
        var priceClass = 'price_item' + current_count;
        var total_tax_price = 'total_tax_' + current_count;
        var available_quantity = 'available_quantity_' + current_count;
        var unit = 'unit_' + current_count;
        var cgst = 'cgst_' + current_count;
        var sgst = 'sgst_' + current_count;
        var igst = 'igst_' + current_count;
        var variant = 'variant_' + current_count;
        var cgst_id = 'cgst_id_' + current_count;
        var sgst_id = 'sgst_id_' + current_count;
        var igst_id = 'igst_id_' + current_count;
        var variant_id = 'variant_id_' + current_count;
        var variant_color = 'variant_color_id_' + current_count;
//var pricing   ='pricing_'+current_count;
        var color = 'color' + current_count;
        var size = 'size' + current_count;
        var assembly = 'assembly' + current_count;
        var viewassembly = "viewassembly" + current_count;
        var discount = 'discount_' + current_count;
        var category_id = 'category_id_' + current_count;
        var product_model = 'product_model_' + current_count;
        $.ajax({
            type: "POST",
            url: base_url + "dashboard/Cinvoice/retrieve_product_data",
            data: dataString,
            cache: false,
            success: function (data) {
                var obj = jQuery.parseJSON(data);
                $('.' + qnttClass).val(obj.cartoon_quantity);
                $('.' + priceClass).val(obj.price);
                $('.' + total_tax_price).val(obj.tax);
                $('.' + unit).val(obj.unit);
                $('#' + cgst).val(obj.cgst_tax);
                $('#' + sgst).val(obj.sgst_tax);
                $('#' + igst).val(obj.igst_tax);
                $('#' + variant).val(obj.variant_id);
                $('#' + cgst_id).val(obj.cgst_id);
                $('#' + sgst_id).val(obj.sgst_id);
                $('#' + igst_id).val(obj.igst_id);
                $('#' + variant_id).html(obj.variant);
                $('#' + variant_color).html(obj.colorhtml);
//$('#'+pricing).html(obj.pricinghtml);
                $('#' + discount).val(obj.discount);
                $("#" + category_id).val(obj.category_id);
                $('#' + product_model).val(obj.product_model);
                $("#" + size).val(obj.size);
                $("#" + color).val(obj.color);
                $("#" + assembly).val(obj.assembly);
                var assemplyvalue = obj.assembly;
//This Function Stay on others.js page
                stock_by_product_variant_id(current_count);
                stock_by_product_variant_color(current_count);
//quantity_calculate(current_count);
                if (assemplyvalue == 1) {
                    $("#" + viewassembly).removeClass("hidden");
                } else {
                    $("#" + viewassembly).addClass("hidden");
                }
                get_pri_type_rate1(current_count);

                if (obj.category_id == accessories_category_id) {
                    // this item is accessories
                    // set price to zero if type is assemply
                    if ($('#product_type').val() == '2') {
                        $('#price_item_' + current_count).val(0);
                    }
                    // get all items with same name sum quantity
                    var totalQuantity = 0;
                    $('[name="product_name"]').each(function() {
                        var itemName = $(this).val();
                        var counter = $(this).attr('id').replace('product_name_', '');
                        var itemCategoryId = $('#category_id_' + counter).val();
                        var itemProductModel = $('#product_model_' + counter).val();
                        var itemQuantity = $('#total_qntt_' + counter).val();
                        itemName = itemName.replace(itemProductModel, '');
                        if (itemCategoryId != accessories_category_id) {
                            if (itemName.indexOf(obj.product_name.replace(obj.product_model, '')) > -1) {
                                totalQuantity += parseInt(itemQuantity);
                            }
                            // console.log(current_count, itemName.indexOf(obj.product_name.replace(obj.product_model, '')), itemName, counter, itemCategoryId);
                        }
                    }).promise().then(function() {
                        $('#total_qntt_' + current_count).val(totalQuantity).trigger('keyup');
                        // console.log(totalQuantity);
                    });
                }
            },
        });
    });

    $("#model_no").val('');
    $("#model_no_text").html('');
    $("#modelModal").modal('hide');
    $('#all_pro').prop('checked', false)

    $("#addPurchaseItem").scrollTop( $('#addPurchaseItem').height() );
}

//Add Invoice Field
function addInputField(divName) {
    if (count == limits) {
        alert("You have reached the limit of adding " + count + " inputs");
    } else {
        var newdiv = document.createElement("tr");
        var tabin = "product_name_" + count;

        $("select.form-control:not(.dont-select-me)").select2({
            placeholder: "Select option",
            allowClear: true,
        });

        var elem = $("#is_quotation");
        if (elem.prop('checked') == true) {
            elem.trigger('click');
        }

        var cgst_status = $("#cgst_status").val();
        var sgst_status = $("#sgst_status").val();
        var igst_status = $("#igst_status").val();
        var taxhtmlval = "";

        if (cgst_status == 1) {
            taxhtmlval =
                    '<input type="hidden" id="cgst_' +
                    count +
                    '" class="cgst"/> <input type="hidden" id="total_cgst_' +
                    count +
                    '" class="total_cgst" name="cgst[]" /> <input type="hidden" name="cgst_id[]" id="cgst_id_' +
                    count +
                    '">';
        }
        if (sgst_status == 1) {
            taxhtmlval +=
                    '<input type="hidden" id="sgst_' +
                    count +
                    '" class="sgst"/> <input type="hidden" id="total_sgst_' +
                    count +
                    '" class="total_sgst" name="sgst[]"/><input type="hidden" name="sgst_id[]" id="sgst_id_' +
                    count +
                    '">';
        }
        if (igst_status == 1) {
            taxhtmlval +=
                    '<input type="hidden" id="igst_' +
                    count +
                    '" class="igst"/><input type="hidden" id="total_igst_' +
                    count +
                    '" class="total_igst" name="igst[]"/><input type="hidden" name="igst_id[]" id="igst_id_' +
                    count +
                    '">';
        }

        newdiv.innerHTML =
                '<tr><td><input type="text" name="product_name" autocomplete="off" onkeyup="invoice_productList(' +
                count +
                ');" class="form-control productSelection" placeholder="' +
                display("product_name") +
                '" required="" id="product_name_' +
                count +
                '" ><input type="hidden" class="autocomplete_hidden_value product_id_' +
                count +
                '" name="product_id[]"/><input type="hidden" class="sl" value="' +
                count +
                '"><input type="hidden" name="assembly[]" id="assembly' +
                count +
                '" value=""><input type="hidden" name="colorv[]" id="color' +
                count +
                '" value=""><input type="hidden" name="sizev[]" id="size' +
                count +
                '" value=""><input type="hidden" class="baseUrl" value="' +
                base_url +
                '" /> <input type="hidden" hidden name="category_id[]" id="category_id_' + count + '" /> <input type="hidden" hidden name="product_model[]" id="product_model_' + count + '" /> <div id="viewassembly' +
                count +
                '" class="text-center hidden"><a  style="color: blue" href="" data-toggle="modal" data-target="#viewprom" onclick="viewpro(' +
                count +
                ')">view products</a></div></td>' +
                '<td class="text-center"><div class="variant_id_div"> <select name="variant_id[]" id="variant_id_' +
                count +
                '" class="form-control variant_id width_100p"disabled="" ><option value=""></option></select></div><div hidden="" ><select name="color_variant[]" id="variant_color_id_' +
                count +
                '" class="form-control color_variant width_100p"  ><option value=""></option></select></div></td>' +
                '<td hidden="" class="text-center"><div><select name="batch_no[]" id="batch_no_' +
                count +
                '" class="form-control batch_no width_100p"><option value=""></option></select></div></td>' +
                '<td><input type="text" name="available_quantity[]"  class="form-control text-right available_quantity_' +
                count +
                '" id="avl_qntt_' +
                count +
                '" placeholder="0" readonly="1" /></td>' +
                // '<td><input type="text" id="" class="form-control text-right unit_' +
                // count +
                // '" placeholder="None" readonly="" /></td>' +
                '<td><input type="number" onchange="quantity_limit(' +
                count +
                ')" name="product_quantity[]" ' +
                'onkeyup="quantity_calculate(' +
                count +
                ');" onchange="quantity_calculate(' +
                count +
                ');" id="total_qntt_' +
                count +
                '" class="form-control text-right" value="0" min="0" required="" /></td>' +
                '<td><input type="number" name="product_rate[]" onkeyup="quantity_calculate(' +
                count +
                ');" onchange="quantity_calculate(' +
                count +
                ');" placeholder="0.00" id="price_item_' +
                count +
                '" class="price_item' +
                count +
                ' form-control text-right" required="" min="0" readonly="readonly" /> <input type="hidden" hidden id="price_item_saved_' +
                count +
                '" value="" /></td>' +
                '<td><input type="number" name="discount[]" onkeyup="quantity_calculate(' +
                count +
                ');" onchange="quantity_calculate(' +
                count +
                ');" id="discount_' +
                count +
                '" class="form-control text-right" placeholder="0.00" min="0" /></td>' +
                '<td><input class="total_price form-control text-right" type="text" name="total_price[]" id="total_price_' +
                count +
                '" placeholder="0.00" readonly="readonly" /></td>' +
                "<td>" +
                taxhtmlval +
                '<input type="hidden" id="total_discount_' +
                count +
                '" class="" />' +
                '<input type="hidden" id="all_discount_' +
                count +
                '" class="total_discount"/><button  class="btn btn-danger text-right" type="button" value="' +
                display("delete") +
                '" onclick="deleteRow(this)">' +
                display("delete") +
                "</button></td></tr>";
        document.getElementById(divName).appendChild(newdiv);
        document.getElementById(tabin).focus();
        count++;

        $("select.form-control:not(.dont-select-me)").select2({
            placeholder: "Select option",
            allowClear: true,
        });
    }
}

//Select stock by product and variant id
function stock_by_product_variant_id(sl) {
    //  var sl = $(this).parent().parent().parent().find(".sl").val();
    var product_id = $(".product_id_" + sl).val();
    var avl_qntt = $("#avl_qntt_" + sl).val();
    var store_id = $("#store_id").val();
    var variant_id = $("#variant_id_" + sl).val();
    var variant_color = $("#variant_color_id_" + sl).val();
    var assembly = $("#assembly" + sl).val();

    if (store_id == 0) {
        alert(display("please_select_store"));
        return false;
    }
    $.ajax({
        type: "post",
        async: false,
        url: base_url + "dashboard/Cpurchase/check_admin_2d_variant_info",
        data: {
            csrf_test_name: csrf_test_name,
            product_id: product_id,
            variant_id: variant_id,
            store_id: store_id,
            variant_color: variant_color,
            assembly:assembly,
        },
        success: function (result) {
            var res = JSON.parse(result);
            if (res[0] == "yes") {
                $("#avl_qntt_" + sl).val(res[1]);
                $("#discount_" + sl).val(res[3]);
                $("#price_item_" + sl)
                        .val(res[2])
                        .change();
                $("#batch_no_" + sl).html(res[4]);
                $("#batch_no_" + sl).on("change", function () {
                    var batch_no = $(this).val();
                    $.ajax({
                        type: "post",
                        async: false,
                        url:
                                base_url +
                                "dashboard/Cpurchase/check_admin_batch_wise_stock_info",
                        data: {
                            csrf_test_name: csrf_test_name,
                            product_id: product_id,
                            variant_id: variant_id,
                            store_id: store_id,
                            variant_color: variant_color,
                            batch_no: batch_no,
                        },
                        success: function (result) {
                            var res = JSON.parse(result);
                            if (res[0] == "yes") {
                                $("#avl_qntt_" + sl).val(res[1]);
                            } else {
                                $("#avl_qntt_" + sl).val("0");
                                $("#total_qntt_" + sl).val("0");

                                alert(display("product_is_not_available_in_this_store"));
                                return false;
                            }
                        },
                    });
                });
            } else {
                $("#avl_qntt_" + sl).val("0");
                $("#total_qntt_" + sl).val("0");
                alert(display("product_is_not_available_in_this_store"));
                return false;
            }
        },
        error: function () {
            alert("Request Failed, Please try again!");
        },
    });
}

////Select Sell Price by pricing type Change 
//$("body").on("change", ".pricing", function () {
//    var sl = $(this).parent().parent().parent().find(".sl").val();
//    var product_id = $(".product_id_" + sl).val();
//    var pricing_id = $(this).val();
//
//    $.ajax({
//        type: "post",
//        async: false,
//        url: base_url + "dashboard/Cpurchase/check_product_price",
//        data: {
//            csrf_test_name: csrf_test_name,
//            product_id: product_id,
//            pricing_id: pricing_id,
//
//        },
//        success: function (result) {
//            var res = JSON.parse(result);
//
//            $("#price_item_" + sl).val(res[1]).change();
//
//        },
//        error: function () {
//            alert("Request Failed, Please try again!");
//        },
//    });
//
//});



//Select stock by product and color variant id
function stock_by_product_variant_color(sl) {
    // var sl = $(this).parent().parent().parent().find(".sl").val();
    var product_id = $(".product_id_" + sl).val();
    var avl_qntt = $("#avl_qntt_" + sl).val();
    var store_id = $("#store_id").val();
    var variant_id = $("#variant_id_" + sl).val();
    var variant_color = $("#variant_color_id_" + sl).val();
    var assembly = $("#assembly" + sl).val();
    var currentItemCatId = $('#category_id_' + sl).val();
    var currentItemName = $('#product_name_' + sl).val();
    var currentItemModel = $('#product_model_' + sl).val();
    var curr_qntt = parseInt($('#total_qntt_' + sl).val() || '0');

    if (store_id == 0) {
        alert(display("please_select_store"));
        return false;
    }

    $.ajax({
        type: "post",
        async: false,
        url: base_url + "dashboard/Cpurchase/check_admin_2d_variant_info",
        data: {
            csrf_test_name: csrf_test_name,
            product_id: product_id,
            variant_id: variant_id,
            store_id: store_id,
            variant_color: variant_color,
            assembly: assembly,
        },
        success: function (result) {
            var res = JSON.parse(result);
            if (res[0] == "yes") {
                var ava = res[1];
                $("#avl_qntt_" + sl).val(res[1]);
                $("#discount_" + sl).val(res[3]);
                $("#price_item_" + sl)
                        .val(res[2])
                        .change();
                $("#batch_no_" + sl).html(res[4]);

                if (currentItemCatId == accessories_category_id) {
                    // this item is accessories
                    // set price to zero if type is assemply
                    if ($('#product_type').val() == '2') {
                        $('#price_item_' + sl).val(0);
                    }
                    // get all items with same name sum quantity
                    var totalQuantity = 0;
                    $('[name="product_name"]').each(function() {
                        var itemName = $(this).val();
                        var counter = $(this).attr('id').replace('product_name_', '');
                        var itemCategoryId = $('#category_id_' + counter).val();
                        var itemProductModel = $('#product_model_' + counter).val();
                        var itemQuantity = $('#total_qntt_' + counter).val();

                        itemName = itemName.replace(itemProductModel, '');
                        if (itemCategoryId != accessories_category_id) {
                            // console.log($(this), itemQuantity, itemName, itemProductModel);

                            if (itemName.indexOf(currentItemName.replace(currentItemModel, '')) > -1) {
                                totalQuantity += parseInt(itemQuantity);
                            }
                            // console.log(sl, itemName.indexOf(obj.product_name.replace(obj.product_model, '')), itemName, counter, itemCategoryId);
                        }
                    }).promise().then(function() {
                        $('#total_qntt_' + sl).val(totalQuantity).trigger('keyup');
                        // console.log('total' + totalQuantity);
                    });
                } else {
                    if (curr_qntt > 1 && ava >= curr_qntt) {
                        $("#total_qntt_" + sl).val(curr_qntt).trigger('keyup');
                    } else if (ava > 1) {
                        $("#total_qntt_" + sl).val(1).trigger('keyup');
                    }  else {
                        $("#total_qntt_" + sl).val(0).trigger('keyup');
                    }
                    // $('#total_qntt_' + sl).val(1).trigger('keyup');
                }

            } else {
                $("#avl_qntt_" + sl).val("0");
                $("#total_qntt_" + sl).val("0");
                alert(display("product_is_not_available_in_this_store"));
                return false;
            }
        },
        error: function () {
            alert("Request Failed, Please try again!");
        },
    });
}
//========================================================================================
//after select variant check  limit to order limit
$("#total_qntt_1").on("change", function () {
    let batch_no = $("#batch_no_" + 1).find(":selected").val();
    var html = $("select option[value='" + batch_no + "']").parent().get();
    var total_qnt = 0;
    var quantity = 0;
    var current_quantity = $("#total_qntt_1").val();
    var available_quantity = $("#avl_qntt_1").val();
    if (parseInt(available_quantity) < parseInt(current_quantity)) {
        alert("stock not available");
        $("#total_qntt_1").val(1);
        return false;
    }
    for (var i = 0; i < html.length; i++) {
        var batch_no_attr = html[i].id;
        var sl = batch_no_attr.split("batch_no_");
        quantity = parseInt($("#total_qntt_" + sl[1]).val());
        total_qnt += quantity;
    }
    if (parseInt(available_quantity) < total_qnt) {
        alert('stock not available');
        $("#total_qntt_" + 1).val(1);
        return false;
    }
});

//select shipping method and amount
$("#shipping_method").on("change", function () {
    var shipping_charge = $("#shipping_method option:selected").attr(
            "data-amount"
            );
    $("#shipping_charge").val(shipping_charge);
    calculateSum();
});
