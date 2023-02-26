$(document).ready(function(){
var productArr={};
	$("#invoice_no").on('change', function(){
		var invoice_no = $(this).val();
		var csrf_test_name = $("#CSRF_TOKEN").val();
    var messages = {
      fit: $('#trans').attr('data-fit'),
      warranty: $('#trans').attr('data-warranty'),
      damaged: $('#trans').attr('data-damaged'),
    };
	    $.ajax({
        url: base_url + "dashboard/Crefund/get_invoice_products",
        method: "post",
        dataType: "json",
        data: {
            invoice_no: invoice_no,
            // invoice_id: invoice_no,
            csrf_test_name: csrf_test_name
        },
        success: function (data) {
          $('#normalinvoice').find('tbody').empty()
          // $("#invoice_id").val(data[0]['invoice_id']);
          for (i = 0; i < data.length; i++) {
            $('#normalinvoice').find('tbody').append("<tr>")
            $('#normalinvoice').find('tbody').append("<td><input class='form-control' id='product_name_"+i+"' value='"+data[i]['product_name']+"' name='product_name[]' readonly=''></td>");
            $('#normalinvoice').find('tbody').append("<td hidden><input class='form-control' id='product_id_"+i+"' value='"+data[i]['product_id']+"' name='product_id[]' readonly='' ></td>");
            $('#normalinvoice').find('tbody').append("<td class='text-center'><input class='form-control' id='variant_name_"+i+"' required='required' name='variant_name[]' value='"+data[i]['variant_name']+"' readonly='' ></td>");
            $('#normalinvoice').find('tbody').append("<td class='text-center' hidden><input class='form-control' id='variant_id_"+i+"' required='required' name='variant_id[]' value='"+data[i]['variant_id']+"' readonly='' ></td>");
            $('#normalinvoice').find('tbody').append("<td><select class='form-control' id='status_"+i+"' required='required' name='status[]'><option value='0'>"+messages.fit+"</option><option value='1'>"+messages.damaged+"</option><option value='2'>"+messages.warranty+"</option></select></td>");
            $('#normalinvoice').find('tbody').append("<td><input type='text' id='available_quantity_"+i+"' name='available_quantity[]' class='form-control text-right available_quantity_"+i+"' id='avl_qntt_"+i+"' value='"+data[i]['quantity']+"' readonly='' /></td>");
            $('#normalinvoice').find('tbody').append("<td><input type='number' class='form-control' id='quantity_"+i+" required='required' min='0' value='0' max='"+data[i]['quantity']+"' name='quantity[]'></td></tr>");

        } 
        },
      });
	});

  
  
});

  function get_variant(row){
    var id = $("#product_id_"+row).val();
    var invoice_no = $("#invoice_no").val();
    var csrf_test_name = $("#CSRF_TOKEN").val();
      $.ajax({
        url: base_url + "dashboard/Crefund/get_product_variants",
        method: "post",
        dataType: "json",
        data: {
            invoice_no: invoice_no,
            product_id:id,
            csrf_test_name: csrf_test_name
        },
        success: function (data) {
          $('#variant_id_'+row).empty()
          productArr={};
          select = document.getElementById('variant_id_'+row);
          var opt =  document.createElement('option');
          opt.innerHTML = '';
          opt.value ='';
          select.appendChild(opt);

          for (i = 0; i < data.length; i++) {
            productArr[id+data[i]['variant_id']]=data[i]['quantity'];
            var opt = document.createElement('option');
            opt.innerHTML = data[i]['variant_name'];
            opt.value = data[i]['variant_id'];
            select.appendChild(opt);
        } 
          
        },
      });
  }

  function get_qnty(row){
    var id = $("#variant_id_"+row).val();
    var product_id = $("#product_id_"+row).val();
    console.log(productArr[product_id+id]);
    document.getElementById("quantity_"+row).max = productArr[product_id+id];
    $("#available_quantity_"+row).val(productArr[product_id+id]);
}
function addInputField2(t) {
  //Variable declaratipn
  var count = 2,
          limits = 500;

  if (count == limits)
      alert("You have reached the limit of adding " + count + " inputs");
  else {
      var a = "product_name" + count,
      e = document.createElement("tr");
     
      var messages = {
        fit: $('#trans').attr('data-fit'),
        warranty: $('#trans').attr('data-warranty'),
        damaged: $('#trans').attr('data-damaged'),
      };
      
      var invoice_no = $("#invoice_no").val();
      var csrf_test_name = $("#CSRF_TOKEN").val();
      var opts="";
        $.ajax({
          url: base_url + "dashboard/Crefund/get_invoice_products",
          method: "post",
          dataType: "json",
          data: {
              invoice_no: invoice_no,
              csrf_test_name: csrf_test_name
          },
          success: function (data) {
         
            for (i = 0; i < data.length; i++) {
              console.log(data[i]['product_name'])
              opts+="<option value='"+data[i]['product_id']+"'>"+data[i]['product_name']+"</option>"
          } 
          },
        });
        var html = "<td><select class='form-control' id='product_id_"+count+"' onchange='get_variant("+count+")' required='required' name='product_id[]'>"+opts+"</select></td>"
        html+="<td class='text-center'><select class='form-control' id='variant_id_"+count+"' onchange='get_qnty("+count+")' required='required' name='variant_id[]''></select></td>"
        html+="<td><select class='form-control' id='status_"+count+"' required='required' name='status[]'><option value='0'>"+messages.fit+"</option><option value='1'>"+messages.damaged+"</option><option value='2'>"+messages.warranty+"</option></select></td>"
        html+="<td><input type='text' id='available_quantity_"+count+"' name='available_quantity[]' class='form-control text-right available_quantity_"+count+"' id='avl_qntt_1' placeholder='0' readonly='' /></td>"
        html+="<td><input type='number' class='form-control' id='quantity_'+count+'' required='required' min='0' value='0' max='0' name='quantity[]'></td>"
        html+="<td><button style='text-align: right;' class='btn btn-danger' type='button' value='Delete' onclick='deleteRow(this)'>Delete</button></td>";
        e.innerHTML=html;
        document.getElementById(t).appendChild(e);
      count++;
  }
}

function deleteRow(t) {
  var a = $("#normalinvoice > tbody > tr").length;
  if (1 == a) {
      alert("There only one row you can't delete.");
      return false;
  } else {
      var e = t.parentNode.parentNode;
      e.parentNode.removeChild(e);
    
  }

  $('#item-number').html('0');
  $(".itemNumber>tr").each(function (i) {
      $('#item-number').html(i + 1);
      $('.item_bill').html(i + 1);
  });
}
