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

var APchange = function(event, ui){
	$(this).data("autocomplete").menu.activeMenu.children(":first-child").trigger("click");
}
    function producstList() {
        var byCategory = $('#by_category_name').val();
        $( ".productSelection" ).autocomplete(
		{
            //source: productList,
            source: function (request, response) {
                $.ajax({
                    url: base_url + "dashboard/Cinvoice/product_search_all_products",
                    method: "post",
                    dataType: "json",
                    data: {
                        csrf_test_name: csrf_test_name,
                        product_name: request.term,
                        by_category: byCategory,
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
				$(this).unbind("change");
				return false;
			}
		});
			$( ".productSelection" ).focus(function(){
				$(this).change(APchange);
			
			});
    }


