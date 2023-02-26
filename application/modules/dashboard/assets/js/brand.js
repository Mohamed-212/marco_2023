"use strict";
//Delete Brand 
$(document).ready(function(){
	$(".delete_brand").on('click', function()
	{	
		var brand_id=$(this).attr('name');
		var csrf_test_name=  $("#CSRF_TOKEN").val();
		var x = confirm(display('are_you_sure_want_to_delete'));
		if (x==true){
		$.ajax({
				type: "POST",
				url: base_url+'dashboard/Cbrand/brand_delete',
				data: {brand_id:brand_id,csrf_test_name:csrf_test_name},
				cache: false,
				success: function(datas)
				{
					setTimeout("location.reload(true);",300);

				} 
			});
		}
	});
	var count = 1;
	$('#add_row').on('click',function(){
		var csrf_test_name=  $("#CSRF_TOKEN").val();
		$.ajax({
				type: "POST",
				url: base_url+'dashboard/Cbrand/add_translation',
				data: {csrf_test_name:csrf_test_name,count:count},
				cache: false,
				success: function(datas)
				{
					$('.new_row').append(datas);
					// select 2 dropdown 
	                $("select.brand-control").select2({
	                    placeholder: "Select option",
	                    allowClear: true
	                });
	                count++;
	                $('.remove_row').on('click',function(){
	                	$(this).parent().parent().parent().parent().remove();
	                });
				} 
			});
	});
	$('.remove_data_row').on('click',function(){
    	$(this).parent().parent().parent().parent().remove();
    });
});