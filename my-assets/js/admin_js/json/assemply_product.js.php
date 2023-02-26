"use strict";
<?php
$cache_file = "product.json";
header('Content-Type: text/javascript; charset=utf8');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
//var productList = <?php //echo file_get_contents($cache_file); ?>// ;
var csrf_test_name=  $("#CSRF_TOKEN").val();


function assembly_productList(cName) {
    var product_name = $("#assemblypro" + cName).val();
    var wholePriceId = '';
    var customerPriceId = '';
    $('select.pricing_type').each(function() {
        if (this.value == 1) {
            wholePriceId = this.id;
        } else {
            customerPriceId = this.id;
        }
    });
$( ".assemblyproductSelection" ).autocomplete(
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
                },
            });
        },
delay:300,
focus: function(event, ui) {
$(this).parent().find(".autocomplete_hidden_value").val(ui.item.value);
$(this).val(ui.item.label);
return false;
},
select: function(event, ui) {
$(this).parent().find(".autocomplete_hidden_value").val(ui.item.value);
$(this).val(ui.item.label);

var id=ui.item.value;
var dataString = 'csrf_test_name='+csrf_test_name+'&product_id='+ id;
var base_url = $('.baseUrl').val();
var priceClass = 'price_item'+cName;
var priceClass2 = 'product_price'+cName;
var priceClass3 = 'price_whole_item_' + cName;
var supplier_price = Number( $('#supplier_price').val());
var sell_price = Number( $('#sell_price').val());
var wholePrice = Number($('#pricepri' + wholePriceId.replace('pricetype', '')).val());
var customerPrice = Number($('#pricepri' + customerPriceId.replace('pricetype', '')).val());
$.ajax
({
type: "POST",
url: base_url+"dashboard/Cinvoice/retrieve_product_data",
data: dataString,
cache: false,
success: function(data)
{

var obj = jQuery.parseJSON(data);
$('.'+priceClass).val(obj.supplier_price);
supplier_price+=Number(obj.supplier_price);
$('#supplier_price').val(supplier_price);

$('.'+priceClass2).val(obj.price);
sell_price+=Number(obj.price);
$('#sell_price').val(sell_price);

var wholePriceItem = obj.pricing_types.find(x => x.pri_type_id == '1');
$('.' + priceClass3).val(wholePriceItem.product_price);
wholePrice += Number(wholePriceItem.product_price);
<!-- $('#pricepri' + wholePriceId.replace('pricetype', '')).val(wholePrice); -->

var customerPriceItem = obj.pricing_types.find(x => x.pri_type_id == '2');
customerPrice += Number(customerPriceItem.product_price);
<!-- $('#pricepri' + customerPriceId.replace('pricetype', '')).val(customerPrice); -->

}
});

$(this).unbind("change");
return false;
}
});

}