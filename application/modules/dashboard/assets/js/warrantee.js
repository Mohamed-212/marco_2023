"use strict";

var csrf_test_name = $("#CSRF_TOKEN").val();
$(document).ready(function() {
    $('#search_invoice_details').on('click',function(){
        var invoice_no = $('#invoice_no').val();
        $.ajax({
            type: "post",
            async: false,
            url: base_url + 'dashboard/cwarrantee/get_invoice_warrantee_detail',
            data: {
                csrf_test_name: csrf_test_name,
                invoice_no    : invoice_no
            },
            success: function(data) {
                if (data) {
                    $('#warrantee_products').html(data);
                }else{
                    alert('Oops... No data available for this invoice!');
                }
            }
        });
    });
});