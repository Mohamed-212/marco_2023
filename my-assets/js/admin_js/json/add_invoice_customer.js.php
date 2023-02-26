"use strict";
<?php
$cache_file = "customer.json";
   header('Content-Type: text/javascript; charset=utf8');
   header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
   header("Cache-Control: post-check=0, pre-check=0", false);
   header("Pragma: no-cache");
?>
//var customerList = <?php //echo file_get_contents($cache_file); ?>// ;
var csrf_test_name=  $("#CSRF_TOKEN").val();

var APchange = function(event, ui){
	$(this).data("autocomplete").menu.activeMenu.children(":first-child").trigger("click");
}
$(function() {
  
    $( ".customerSelection" ).autocomplete(
	{
        //source:customerList,
        source:function (request, response) {
            var customer_name = $("#customer_name").val();
            $.ajax({
                url: base_url + "dashboard/Cinvoice/customer_search_all_customers",
                method: "post",
                data: {
                    csrf_test_name: csrf_test_name,
                    customer_name: customer_name,
                },
                success: function (data) {
                    response(jQuery.parseJSON(data));
                },
            });
        },
        delay:300,
		focus: function(event, ui) {
			$(this).parent().find(".customer_hidden_value").val(ui.item.value);
			$(this).val(ui.item.label);
			return false;
		},
		select: function(event, ui) {
			$(this).parent().find(".customer_hidden_value").val(ui.item.value);
			$(this).val(ui.item.label);

			$.ajax({
                type: "post",
                async: false,
                url: base_url +
                    "dashboard/Ccustomer/get_customer_balance",
                data: {
                    csrf_test_name: csrf_test_name,
                    customer_id: ui.item.value,
                },
                success: function(result) {
                    $('#customer_balance').val(result);
                    $('[name="product_quantity[]"]').last().trigger('keyup');
                },
            });

			$(this).unbind("change");
			return false;
		}
	});

	$( ".customerSelection" ).focus(function(){
		$(this).change(APchange);
	});
	
});