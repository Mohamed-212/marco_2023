"use strict";
<?php
$cache_file = "supplier.json";
    header('Content-Type: text/javascript; charset=utf8');
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
   header("Cache-Control: post-check=0, pre-check=0", false);
   header("Pragma: no-cache");
?>
//var supplierList = <?php //echo file_get_contents($cache_file); ?>// ;
var csrf_test_name=  $("#CSRF_TOKEN").val();

var APchange = function(event, ui){
	$(this).data("autocomplete").menu.activeMenu.children(":first-child").trigger("click");
}
    $(function() {
      
        $( ".supplierSelection" ).autocomplete(
		{
            //source:supplierList,
            source:function (request, response) {
                var supplier_name = $("#supplier_name").val();
                $.ajax({
                    url: base_url + "dashboard/Cinvoice/supplier_search_all_suppliers",
                    method: "post",
                    dataType: "json",
                    data: {
                        csrf_test_name: csrf_test_name,
                        customer_name: supplier_name,
                    },
                    success: function (data) {
                        response(jQuery.parseJSON(data));
                    },
                });
            },
			delay:300,
			focus: function(event, ui) {
				$(this).parent().find(".supplier_hidden_value").val(ui.item.value);
				$(this).val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$(this).parent().find(".supplier_hidden_value").val(ui.item.value);
				$(this).val(ui.item.label);
				$(this).unbind("change");
				return false;
			}
		});
			$( ".supplierSelection" ).focus(function(){
				$(this).change(APchange);
			});
    });
