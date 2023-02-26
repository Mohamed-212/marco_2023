"use strict";

var i = 2;
$('#add_more').on('click',function(){
    var filter_box = '<div id="filter_box_'+i+'"><br><div class="filter_name_input"><div class="input-group"><input class="form-control" name ="filter_names[]" type="text" placeholder="'+display('filter_name')+'"  required=""><div class="input-group-addon btn btn-danger delete_it" data_id="'+i+'"><i class="ti-minus"></i></div></div></div></div>';
    $('#filter_name_area').append(filter_box);
    i++;
    $('.delete_it').on('click',function(){
        $(this).parent().parent().parent().remove();
    });
}); 
$('.delete_previous').on('click',function(){
    $(this).parent().parent().remove();
});