"use strict";
var csrf_test_name=  $("#CSRF_TOKEN").val();
	// Counts and limit for purchase order
    var count = 2;
    var limits = 500;
    //Add Purchase Order Field
    function addStockAdjustmentField(divName){
        if (count == limits)  {
            alert("You have reached the limit of adding " + count + " inputs");
        }else{
            var newdiv  =document.createElement('tr');
            var tabin   ="product_name_"+count;
            var batch_no=$('#generated_batch').val();
            $("select.form-control:not(.dont-select-me)").select2({
                placeholder:"Select option",
                allowClear :true
            });
            newdiv.innerHTML='<td><input type="text" name="product_name" required class="form-control product_name productSelection" onkeyup="product_pur_or_list('+count+');" placeholder="'+display('product_name')+'" id="product_name_'+count+'" tabindex="5" ><input type="hidden" class="autocomplete_hidden_value product_id_'+count+'" name="product_id['+count+']" id="SchoolHiddenId"/><input type="hidden" class="sl" value="'+count+'"></td><td class="text-center"><div class="variant_id_div"><select name="variant_id['+count+']" id="variant_id_'+count+'" class="form-control variant_id width_100p" required=""><option value=""></option></select></div><div style="display: none;"><select name="color_variant['+count+']" id="color_variant_'+count+'" class="form-control color_variant width_100p"><option value=""></option></select></div></td><td class="text-right"><input type="number" name="previous_quantity['+count+']" id="avl_qntt_'+count+'" class="form-control text-right" placeholder="0" readonly /></td><td class=""><select name="adjustment_type['+count+']" style="width: 100%" id="adjustment_type_'+count+'" class="form-control adjustment_type" required=""><option value=""></option><option value="increase"> Increase </option><option value="decrease">Decrease</option></select></td><td class="text-right"><input type="number" name="adjusted_quantity['+count+']" id="adjusted_quantity_'+count+'" class="form-control text-right" placeholder="0" min="0" required="" /></td><td><button  class="btn btn-danger text-right" type="button" value="'+display('delete')+'" onclick="deleteRow(this)">'+display('delete')+'</button></td>';
            document.getElementById(divName).appendChild(newdiv);
            document.getElementById(tabin).focus();
            count++;
            $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Select option",
                allowClear: true
            });
            $(".datepicker").datepicker({
                dateFormat:'yy-mm-dd'
            });
        }
    }

    function product_pur_or_list(sl) {
	    var store_id     = $('#store_id').val();
	    var product_name = $('#product_name_'+sl).val();
	    //Supplier id existing check
	    if ( store_id == 0) {
	        alert(display('please_select_ftore_first'));
	        $('#product_name_'+sl).val('');
	        return false;
	    }
	    // Auto complete ajax
	    var options = {
	            minLength: 0,
	            source: function( request, response ) {
	            $.ajax( {
	                url: base_url+'dashboard/Cinvoice/product_search_all_products',
	                method: 'post',
	                dataType: "json",
	                data: {
	                    csrf_test_name:csrf_test_name,
	                    term: request.term,
	                    store_id:$('#store_id').val(),
	                    product_name:request.term,
	                },
	                success: function( data ) {
	                    response( data );
	                }
	            });
	        },
	        focus: function( event, ui ) {
	            $(this).val(ui.item.label);
	            return false;
	        },
	        select: function( event, ui ) {
	            $(this).parent().parent().find(".autocomplete_hidden_value").val(ui.item.value); 
	            var sl           =$(this).parent().parent().find(".sl").val(); 
	            var id           =ui.item.value;
                // var store_id = $('#store_id').val();
                // var variant_idd = 
	            var dataString   ='csrf_test_name='+csrf_test_name+'&product_id='+ id;
	            var avl_qntt     ='avl_qntt_'+sl;
	            var price_item   ='price_item_'+sl;
	            var variant_id   ='variant_id_'+sl;
	            var color_variant='color_variant_'+sl;
	            $.ajax({
	                type: "POST",
	                url: base_url+'dashboard/Cstore/retrieve_product_data',
	                data: dataString,
	                cache: false,
	                success: function(data)
	                {
	                    var obj = JSON.parse(data);
                        // console.log(obj);
	                    $('#'+price_item).val(obj.supplier_price);
	                    $('#'+avl_qntt).val(obj.total_product);
	                    $('#'+variant_id).html(obj.variant);
	                    $('#'+color_variant).empty().append(obj.variant_color);
                        // alert('asdash jkdashd');

                        $.ajax({
                            type: "post",
                            async: false,
                            url: base_url+'dashboard/Cpurchase/check_admin_2d_variant_info',
                            data: {csrf_test_name:csrf_test_name, product_id: id, variant_id: obj.size, store_id: $('#store_id').val(), variant_color:null},
                            success: function (result) {
                
                                var res = JSON.parse(result);
                                if(res[0]=='yes'){
                                    $('#'+avl_qntt).val(res[1]);
                                    // $('#discount_'+sl).val(res[3]);
                                    // $('#price_item_'+sl).val(res[2]).change();
                                }else{
                                    $('#'+avl_qntt).val(res[1]);
                                    alert(display('product_is_not_available_in_this_store'));
                                    return false; 
                                }
                
                            },
                            error: function () {
                                alert('Request Failed, Please check and try again!');
                            }
                        });
	                } 
	            });

	            $(this).unbind("change");
	            return false;
	       }
	    }
	    $('body').on('keydown.autocomplete', '.product_name', function() {
	       $(this).autocomplete(options);
	    });
	}

	//Select stock by product and variant id
    $('body').on('change', '.variant_id, .color_variant', function() {

        var sl            = $(this).parent().parent().parent().find(".sl").val();
        var product_id    = $('.product_id_'+sl).val();
        var avl_qntt      = $('#avl_qntt_'+sl).val();
        var purchase_to   = $('#purchase_to').val();
        var wearhouse_id  = $('#wearhouse_id').val();
        var store_id      = $('#store_id').val();
        var variant_id = $('#variant_id_'+sl).val();
        var variant_color = $('#color_variant_'+sl).val();

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
            type: "post",
            async: false,
            url: base_url+'dashboard/Cpurchase/wearhouse_available_stock',
            data: {csrf_test_name:csrf_test_name,product_id: product_id,variant_id:variant_id, variant_color:variant_color,purchase_to:purchase_to,wearhouse_id:wearhouse_id,store_id:store_id},
            success: function(data) {
                if (data) {
                    $('#avl_qntt_'+sl).val(data);
                }
            },
            error: function() {
                alert('Request Failed, Please try again!');
            }
        });
    });

    function deleteRow(t) {
        var a = $("#purchaseTable > tbody > tr").length;
        if (1 == a) {
            alert("There only one row you can't delete."); 
            return false;
        }else {
            var e = t.parentNode.parentNode;
            e.parentNode.removeChild(e);
        }
        $('#item-number').html('0');
        $(".itemNumber>tr").each(function(i){
            $('#item-number').html(i+1);
            $('.item_bill').html(i+1);
        });
    } 