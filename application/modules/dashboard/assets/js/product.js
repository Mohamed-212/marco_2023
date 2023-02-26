"use strict";
var csrf_test_name = $("#CSRF_TOKEN").val();
//Delete product_review 
function viewpro(proid) {
    $('#viewpros').html('');
    var dataString = 'csrf_test_name=' + csrf_test_name + '&proid=' + proid;
    $.ajax({
        url: base_url + 'dashboard/Cproduct/viewpro',
        type: "POST",
        data: dataString,
        cache: false,
        success: function (data) {
            var obj = JSON.parse(data);
            $('#viewpros').html(obj);
        }
    });

}