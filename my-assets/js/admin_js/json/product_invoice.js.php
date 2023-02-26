"use strict";
<?php
$cache_file = "product.json";
header('Content-Type: text/javascript; charset=utf8');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
   header("Cache-Control: post-check=0, pre-check=0", false);
   header("Pragma: no-cache");
?>
//var productList = <?php //echo file_get_contents($cache_file); ?>// ;
var csrf_test_name = $("#CSRF_TOKEN").val();

var APchange = function (event, ui) {
    $(this).data("autocomplete").menu.activeMenu.children(":first-child").trigger("click");
}
function invoice_productList(cName) {
    var qnttClass = 'ctnqntt' + cName;
    var priceClass = 'price_item' + cName;
    var priceSavedClass = 'price_item_saved_' + cName;
    var total_tax_price = 'total_tax_' + cName;
    var available_quantity = 'available_quantity_' + cName;
    var unit = 'unit_' + cName;
    var cgst = 'cgst_' + cName;
    var sgst = 'sgst_' + cName;
    var igst = 'igst_' + cName;
    var variant = 'variant_' + cName;
    var cgst_id = 'cgst_id_' + cName;
    var sgst_id = 'sgst_id_' + cName;
    var igst_id = 'igst_id_' + cName;
    var variant_id = 'variant_id_' + cName;
    var variant_color = 'variant_color_id_' + cName;
//var pricing   ='pricing_'+cName;
    var color = 'color' + cName;
    var size = 'size' + cName;
    var assembly = 'assembly' + cName;
    var viewassembly = "viewassembly" + cName;
    var discount = 'discount_' + cName;
    var category_id = 'category_id_' + cName;
    var product_model = 'product_model_' + cName;
    var product_name = $("#product_name_" + cName).val();

    $(".productSelection").autocomplete(
        {
            //source: productList,
            source: function (request, response) {
                $.ajax({
                    url: base_url + "dashboard/Cinvoice/product_search_all_products",
                    method: "post",
                    dataType: "json",
                    data: {
                        csrf_test_name: csrf_test_name,
                        product_name: product_name,
                    },
                    success: function (data) {
                        if (product_name.length > 6 && product_name.match(/^[0-9]+$/i) > 0) {
                            console.log(product_name);
                            if (!data || !data[0]) {
                                response(data);
                            } else {
                                var val = data[0].value;
                                var label = data[0].label;

                                var th = $('input#product_name_' + cName);

                                // console.log(th);

                                th.parent().find(".autocomplete_hidden_value").val(val);
                                th.val(label);

                                var id = val;
                                var dataString = 'csrf_test_name=' + csrf_test_name + '&product_id=' + id;
                                var base_url = $('.baseUrl').val();
                                $.ajax
                                ({
                                    type: "POST",
                                    url: base_url + "dashboard/Cinvoice/retrieve_product_data",
                                    data: dataString,
                                    cache: false,
                                    success: function (data) {

                                        var obj = jQuery.parseJSON(data);
                                        // console.log(obj);
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
                                        $("#" + size).val(obj.size);
                                        $("#" + color).val(obj.color);
                                        $("#" + assembly).val(obj.assembly);
                                        var assemplyvalue = obj.assembly;

                //This Function Stay on others.js page

                                        // stock_by_product_variant_id(cName);
                                        stock_by_product_variant_color(cName);
                //quantity_calculate(cName);
                                        if (assemplyvalue == 1) {
                                            $("#" + viewassembly).removeClass("hidden");
                                        } else {
                                            $("#" + viewassembly).addClass("hidden");
                                        }
                                        get_pri_type_rate1(cName);
                                    }
                                });

                                th.unbind("change");
                                return false;
                            }
                        } else {
                            response(data);
                        }
                    },
                });
            },
            delay: 300,
            focus: function (event, ui) {
                $(this).parent().find(".autocomplete_hidden_value").val(ui.item.value);
                $(this).val(ui.item.label);
                return false;
            },
            select: function (event, ui) {
                console.log($(this));

                $(this).parent().find(".autocomplete_hidden_value").val(ui.item.value);
                $(this).val(ui.item.label);

                var id = ui.item.value;
                var dataString = 'csrf_test_name=' + csrf_test_name + '&product_id=' + id;
                var base_url = $('.baseUrl').val();
                $.ajax
                ({
                    type: "POST",
                    url: base_url + "dashboard/Cinvoice/retrieve_product_data",
                    data: dataString,
                    cache: false,
                    success: function (data) {

                        var obj = jQuery.parseJSON(data);
                        //console.log(obj);
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
                        $("#" + size).val(obj.size);
                        $("#" + color).val(obj.color);
                        $("#" + assembly).val(obj.assembly);
                        var assemplyvalue = obj.assembly;

//This Function Stay on others.js page

                        // stock_by_product_variant_id(cName);
                        stock_by_product_variant_color(cName);
//quantity_calculate(cName);
                        if (assemplyvalue == 1) {
                            $("#" + viewassembly).removeClass("hidden");
                        } else {
                            $("#" + viewassembly).addClass("hidden");
                        }
                        get_pri_type_rate1(cName);
                    }
                });

                $(this).unbind("change");
                return false;
            }
        });
    $(".productSelection").focus(function () {
        $(this).change(APchange);
    });
}