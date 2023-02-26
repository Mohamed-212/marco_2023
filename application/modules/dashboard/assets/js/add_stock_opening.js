'use strict';
var csrf_test_name = $('#CSRF_TOKEN').val();
$('#store_hide').css('display', 'none');
function bank_info_show(payment_type) {
    if (payment_type.value == '1') {
        document.getElementById('store_hide').style.display = 'none';
        document.getElementById('wearhouse_hide').style.display = 'block';
    } else {
        document.getElementById('wearhouse_hide').style.display = 'none';
        document.getElementById('store_hide').style.display = 'block';
    }
}

//Product purchase or list
function product_pur_or_list(sl) {
    var product_name = $('#product_name_' + sl).val();

    // Auto complete ajax
    var options = {
        minLength: 0,
        source: function (request, response) {
            $.ajax({
                url: base_url + 'dashboard/Cstock_opening/product_search',
                method: 'post',
                dataType: 'json',
                data: {
                    csrf_test_name: csrf_test_name,
                    term: request.term,
                    product_name: product_name,
                },
                success: function (data) {
                    response(data);
                },
            });
        },
        focus: function (event, ui) {
            $(this).val(ui.item.label);
            return false;
        },
        select: function (event, ui) {
            $(this)
                .parent()
                .parent()
                .find('.autocomplete_hidden_value')
                .val(ui.item.value);
            var sl = $(this).parent().parent().find('.sl').val();
            var id = ui.item.value;
            var variant = ui.item.varient_id;
            var store_id = $('#store_id').val();
            var dataString =
                'csrf_test_name=' +
                csrf_test_name +
                '&product_id=' +
                id +
                '&store_id=' +
                store_id +
                (variant ? '&variant_id=' + variant : '');
            var avl_qntt = 'avl_qntt_' + sl;
            var variant_id = 'variant_id_' + sl;
            var price_item = 'price_item_' + sl;

            var color_variant = 'color_variant_' + sl;
            $.ajax({
                type: 'POST',
                url: base_url + 'dashboard/Cstore/retrieve_product_data',
                data: dataString,
                cache: false,
                success: function (data) {
                    var obj = JSON.parse(data);
                    $('#' + price_item).val(obj.supplier_price);
                    $('#' + avl_qntt).val(obj.total_product);
                    $('#' + variant_id).html(obj.variant);
                    $('#' + color_variant)
                        .empty()
                        .append(obj.variant_color);
                },
            });

            $(this).unbind('change');
            return false;
        },
    };
    $('body').on('keydown.autocomplete', '.product_name', function () {
        $(this).autocomplete(options);
    });
}

// Counts and limit for purchase order
var count = 2;
var limits = 500;
//Add Purchase Order Field
function addPurchaseOrderField(divName) {
    if (count == limits) {
        alert('You have reached the limit of adding ' + count + ' inputs');
    } else {
        var newdiv = document.createElement('tr');
        var tabin = 'product_name_' + count;
        $('select.form-control:not(.dont-select-me)').select2({
            placeholder: 'Select option',
            allowClear: true,
        });
        newdiv.innerHTML =
            '<td><input type="text" name="product_name" required class="form-control product_name productSelection" onkeyup="product_pur_or_list(' +
            count +
            ');" placeholder="' +
            display('product_name_or_item_code') +
            '" id="product_name_' +
            count +
            '" tabindex="5" ><input type="hidden" class="autocomplete_hidden_value product_id_' +
            count +
            '" name="product_id[]" id="SchoolHiddenId"/><input type="hidden" class="sl" value="' +
            count +
            '"></td><td class="text-center"><div class="variant_id_div"><select name="variant_id[]" id="variant_id_' +
            count +
            '" class="form-control variant_id width_100p" required=""><option value=""></option></select></div><div style="display: none;"><select name="color_variant[]" id="color_variant_' +
            count +
            '" class="form-control color_variant width_100p" ><option value=""></option></select></div></td><td style="display: none;" class="text-right"><input type="text" id="batch_no_' +
            count +
            '" name="batch_no[]" required class="form-control text-right" placeholder="0" readonly /></td><td style="display: none;" class="text-right"><input type="text" id="expiry_date_' +
            count +
            '" name="expiry_date[]" class="form-control datepicker2" placeholder="' +
            display('enter_expire_date') +
            '"/></td><td class="text-right"><input type="number" id="avl_qntt_' +
            count +
            '" class="form-control text-right" placeholder="0" readonly /></td><td class="text-right"><input type="number" name="product_quantity[]" id="total_qntt_' +
            count +
            '" onkeyup="calculate_add_purchase(' +
            count +
            ')" onchange="calculate_add_purchase(' +
            count +
            ')"  class="form-control text-right p_quantity" placeholder="0" min="0" required/></td><td><input type="number" name="product_rate[]" id="price_item_' +
            count +
            '" class="price_item1 text-right form-control" placeholder="0.00" min="0" onkeyup="calculate_add_purchase(' +
            count +
            ')" onchange="calculate_add_purchase(' +
            count +
            ')"/></td><td class="text-right"><input class="total_price text-right form-control" type="text" name="total_price[]" id="total_price_' +
            count +
            '" placeholder="0.00" readonly="readonly" /> </td><td><button  class="btn btn-danger text-right" type="button" value="' +
            display('delete') +
            '" onclick="deleteRow(this)">' +
            display('delete') +
            '</button></td>';
        document.getElementById(divName).appendChild(newdiv);
        document.getElementById(tabin).focus();
        count++;
        $('select.form-control:not(.dont-select-me)').select2({
            placeholder: 'Select option',
            allowClear: true,
        });
        $('.datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
        });
    }
}

//Calculate store product
function calculate_add_purchase(sl) {
    var e = 0;
    var gr_tot = 0;
    var total_qntt = $('#total_qntt_' + sl).val();
    var price_item = $('#price_item_' + sl).val();
    var item_discount = $('#discount_' + sl).val();
    var total_price = total_qntt * price_item;
    var Total_Quantity = 0;
    $('.p_quantity').each(function () {
        isNaN(this.value) ||
            0 == this.value.length ||
            (Total_Quantity += parseFloat(this.value));
    });
    $('#total_items').val(Total_Quantity);
    $('#total_items').trigger('change');
    $('#total_price_' + sl).val(total_price.toFixed(2));
    //Total Price
    $('.total_price').each(function () {
        isNaN(this.value) ||
            0 == this.value.length ||
            (gr_tot += parseFloat(this.value));
    });
    $('#subTotal').val(gr_tot.toFixed(2, 2));
    $('#grandTotal').val(gr_tot.toFixed(2, 2));
}

//Select stock by product and variant id
$('body').on('change', '.variant_id, .color_variant', function () {
    var sl = $(this).parent().parent().parent().find('.sl').val();
    var product_id = $('.product_id_' + sl).val();
    var avl_qntt = $('#avl_qntt_' + sl).val();
    var purchase_to = $('#purchase_to').val();
    var wearhouse_id = $('#wearhouse_id').val();
    var store_id = $('#store_id').val();
    var variant_id = $('#variant_id_' + sl).val();
    var variant_color = $('#color_variant_' + sl).val();

    if (purchase_to == 1) {
        if (wearhouse_id == 0) {
            alert(display('please_select_wearhouse'));
            return false;
        }
    }

    if (purchase_to == 2) {
        if (store_id == 0) {
            alert(display('please_select_store'));
            return false;
        }
    }

    $.ajax({
        type: 'post',
        async: false,
        url: base_url + 'dashboard/Cpurchase/wearhouse_available_stock',
        data: {
            csrf_test_name: csrf_test_name,
            product_id: product_id,
            variant_id: variant_id,
            variant_color: variant_color,
            purchase_to: purchase_to,
            wearhouse_id: wearhouse_id,
            store_id: store_id,
        },
        success: function (data) {
            if (data) {
                $('#avl_qntt_' + sl).val(data);
            }
        },
        error: function () {
            alert('Request Failed, Please try again!');
        },
    });
});

//Delete a row from purchase table
function deleteRow(t) {
    var a = $('#purchaseTable > tbody > tr').length;
    if (1 == a) {
        alert("There only one row you can't delete.");
        return false;
    } else {
        var e = t.parentNode.parentNode;
        e.parentNode.removeChild(e);
        calculate_add_purchase();
    }
    calculate_add_purchase();
    $('#item-number').html('0');
    $('.itemNumber>tr').each(function (i) {
        $('#item-number').html(i + 1);
        $('.item_bill').html(i + 1);
    });
}

function calculate_purchase_vat() {
    var subTotal = $('#subTotal').val();
    var vat = $('#purchase_vat').val();
    var total_purchase_vat = (subTotal * vat) / 100;
    var grandTotal = +total_purchase_vat + +subTotal;
    $('#total_vat').val(total_purchase_vat);
    $('#grandTotal').val(grandTotal);
}

var p_cost_count = 2;
function add_new_p_cost_row(divName) {
    $.ajax({
        url:
            base_url + 'dashboard/Cpurchase/add_new_p_cost_row/' + p_cost_count,
        data: { csrf_test_name: csrf_test_name },
        type: 'post',
        success: function (data) {
            $('#addPurchaseCost').append(data);
            $('.del_more_btn').on('click', function () {
                var row_id = $(this).attr('data-row_id');
                $('#row_' + row_id).remove();
                calculate_add_purchase_cost(1);
            });
        },
    });
    p_cost_count++;
}

function calculate_add_purchase_cost(c) {
    var total_cost = 0;
    $('.purchase_expences').each(function () {
        isNaN(this.value) ||
            0 == this.value.length ||
            (total_cost += parseFloat(this.value));
    });
    $('#purchase_expences').val(total_cost);
}

// search product by model
function product_per_model() {
    var supplier_id = $('#supplier_id').val();
    var currency_id = $('#currency_id').val();
    var model_no = $('#model_no').val();
    var base_url = $('.baseUrl').val();

    //Supplier id existing check
    if (supplier_id == 0) {
        alert(display('please_select_supplier'));
        return false;
    }

    if (currency_id == 0) {
        alert('Please Select Currency');
        return false;
    }
    $('#model_no_text').html('');
    $.ajax({
        url: base_url + 'dashboard/Cinvoice/product_search_by_model',
        method: 'post',
        dataType: 'json',
        data: {
            csrf_test_name: csrf_test_name,
            term: model_no,
        },
        success: function (data) {
            $.each(data, function (k, v) {
                $("#model_no_text").append('<tr>' +
                    '<td class="text-center">' +
                    '<input type="checkbox" class="check_pro_id" id="prod'+v.value+'" value="'+v.value+'">' +
                    '<input type="hidden" class="check_pro_id" value="'+v.label+'">' +
                    '</td>' +
                    '<td class="text-center"><label class="pointer" for="prod'+v.value+'">'+v.label+'</lable></td>' +
                    '</tr>');
            });
            if (data.length > 0) {
                $('#modelModal').modal('show');
            } else {
                alert('No Item Found');
            }
        },
    });
}

// add selected product to table
function add_products_model() {
    var ids = [];
    var names = [];
    $('.check_pro_id:checkbox:checked').each(function (index, value) {
        ids.push(value.value);
        names.push($(this).next().val());
    });
    $.each(ids, function (k, v) {
        var base_url = $('.baseUrl').val();
        var current_count = count - 1;
        if (
            $('#product_name_' + (count - 1))
                .next()
                .val()
        ) {
            current_count = count;
            // addInputField('addinvoiceItem');
            addPurchaseOrderField('addPurchaseItem');
        }
        $('#product_name_' + current_count)
            .next()
            .val(v);
        $('#product_name_' + current_count).val(names[k]);
        var sl = current_count;
        var id = v;
        var dataString =
            'csrf_test_name=' + csrf_test_name + '&product_id=' + id;
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
        var viewassembly = 'viewassembly' + current_count;
        var discount = 'discount_' + current_count;
        var category_id = 'category_id_' + current_count;
        var product_model = 'product_model_' + current_count;
        $.ajax({
            type: 'POST',
            url: base_url + 'dashboard/Cinvoice/retrieve_product_data',
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
                $('#' + category_id).val(obj.category_id);
                $('#' + product_model).val(obj.product_model);
                $('#' + size).val(obj.size);
                $('#' + color).val(obj.color);
                $('#' + assembly).val(obj.assembly);
                var assemplyvalue = obj.assembly;
                //This Function Stay on others.js page
                stock_by_product_variant_id(current_count);

                $('#price_item_' + current_count).val(obj.supplier_price);
                // stock_by_product_variant_color(current_count);
                //quantity_calculate(current_count);
                if (assemplyvalue == 1) {
                    $('#' + viewassembly).removeClass('hidden');
                } else {
                    $('#' + viewassembly).addClass('hidden');
                }
                // get_pri_type_rate1(current_count);

                // if (obj.category_id == accessories_category_id) {
                //     // this item is accessories
                //     // set price to zero if type is assemply
                //
                //     // get all items with same name sum quantity
                //     var totalQuantity = 0;
                //     // $('[name="product_name"]').each(function() {
                //     //     var itemName = $(this).val();
                //     //     var counter = $(this).attr('id').replace('product_name_', '');
                //     //     var itemCategoryId = $('#category_id_' + counter).val();
                //     //     var itemProductModel = $('#product_model_' + counter).val();
                //     //     var itemQuantity = $('#total_qntt_' + counter).val();
                //     //     itemName = itemName.replace(itemProductModel, '');
                //     //     if (itemCategoryId != accessories_category_id) {
                //     //         if (itemName.indexOf(obj.product_name.replace(obj.product_model, '')) > -1) {
                //     //             totalQuantity += parseInt(itemQuantity);
                //     //         }
                //     //         // console.log(current_count, itemName.indexOf(obj.product_name.replace(obj.product_model, '')), itemName, counter, itemCategoryId);
                //     //     }
                //     // }).promise().then(function() {
                //     //     $('#total_qntt_' + current_count).val(totalQuantity).trigger('keyup');
                //     //     console.log(totalQuantity);
                //     // });
                // }
            },
        });
    });

    $('#model_no').val('');
    $('#model_no_text').html('');
    $('#modelModal').modal('hide');
    $('#all_pro').prop('checked', false);

    $('#addPurchaseItem').scrollTop($('#addPurchaseItem').height());
}

//Select stock by product and variant id
function stock_by_product_variant_id(sl) {
    //  var sl = $(this).parent().parent().parent().find(".sl").val();
    var product_id = $('.product_id_' + sl).val();
    var avl_qntt = $('#avl_qntt_' + sl).val();
    var store_id = $('#store_id').val();
    var variant_id = $('#variant_id_' + sl).val();
    var variant_color = $('#variant_color_id_' + sl).val();
    var assembly = $('#assembly' + sl).val();

    if (store_id == 0) {
        alert(display('please_select_store'));
        return false;
    }
    $.ajax({
        type: 'post',
        async: false,
        url: base_url + 'dashboard/Cpurchase/check_admin_2d_variant_info',
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
            if (res[0] == 'yes') {
                $('#avl_qntt_' + sl).val(res[1]);
                $('#discount_' + sl).val(res[3]);
                $('#price_item_' + sl)
                    .val(res[2])
                    .change();
                $('#batch_no_' + sl).html(res[4]);
                $('#batch_no_' + sl).on('change', function () {
                    var batch_no = $(this).val();
                    $.ajax({
                        type: 'post',
                        async: false,
                        url:
                            base_url +
                            'dashboard/Cpurchase/check_admin_batch_wise_stock_info',
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
                            if (res[0] == 'yes') {
                                $('#avl_qntt_' + sl).val(res[1]);
                            } else {
                                $('#avl_qntt_' + sl).val('0');
                                $('#total_qntt_' + sl).val('0');

                                // alert(display("product_is_not_available_in_this_store"));
                                return false;
                            }
                        },
                    });
                });
            } else {
                $('#avl_qntt_' + sl).val('0');
                $('#total_qntt_' + sl).val('0');
                // alert(display("product_is_not_available_in_this_store"));
                return false;
            }
        },
        error: function () {
            alert('Request Failed, Please try again!');
        },
    });
}

function select_all(){
    if($('#all_pro').prop('checked') == true){
        $('.check_pro_id').prop('checked', true);
    }else{
        $('.check_pro_id').prop('checked', false);
    }
}