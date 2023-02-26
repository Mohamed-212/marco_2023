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
                        response(data);
                        if (product_name.length > 6 && product_name.match(/^[0-9]+$/i) > 0 && data[0]) {
                            $('.ui-autocomplete .ui-menu-item:eq(0)').trigger('click');
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
                $(this).parent().find(".autocomplete_hidden_value").val(ui.item.value);
                $(this).val(ui.item.label);

                var id = ui.item.value;
                var dataString = 'csrf_test_name=' + csrf_test_name + '&product_id=' + id;
                var base_url = $('.baseUrl').val();

                $(this).unbind("change");
                return false;
            }
        });
    $(".productSelection").focus(function () {
        $(this).change(APchange);
    });
}