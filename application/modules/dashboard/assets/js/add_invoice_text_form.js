"use strict";

function addInputField(divName){
    var newdiv = document.createElement('tr');
    newdiv.classList.add("tr");
    newdiv.innerHTML='<td><textarea class="form-control" name="invoice_text[]" rows="1"></textarea></td>'+
    				 '<td class="text-center"><button type="button" class="btn btn-danger removeInputField"><i class="fa fa-minus"></i></button></td>';
    document.getElementById(divName).appendChild(newdiv);

    $('.removeInputField').click(function(e) {
		e.preventDefault();
		console.log('got the track');
		$(this).closest('.tr').remove();
	});
}

$('.removeInputField').click(function(e) {
	e.preventDefault();
	console.log('got the track');
	$(this).closest('.tr').remove();
});