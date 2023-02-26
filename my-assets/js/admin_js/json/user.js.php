"use strict";
<?php

$cache_file = "user.json";
    header('Content-Type: text/javascript; charset=utf8');
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
   header("Cache-Control: post-check=0, pre-check=0", false);
   header("Pragma: no-cache");
?>
var userList = <?php echo file_get_contents($cache_file);?>
var csrf_test_name=  $("#CSRF_TOKEN").val();

var APchange = function(event, ui){
	$(this).data("autocomplete").menu.activeMenu.children(":first-child").trigger("click");
}
    $(function() {
      
        $( ".userSelection" ).autocomplete(
		{
            source:userList,
			delay:300,
			focus: function(event, ui) {
				$(this).parent().find(".user_hidden_value").val(ui.item.value);
				$(this).val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$(this).parent().find(".user_hidden_value").val(ui.item.value);
				$(this).val(ui.item.label);
				$(this).unbind("change");
				return false;
			}
		});
			$( ".userSelection" ).focus(function(){
				$(this).change(APchange);
			
			});
    });
