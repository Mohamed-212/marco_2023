"use strict";
var base_url = $("#base_url").val();
var csrf_test_name = $("#CSRF_TOKEN").val();

function loadCoaData(id) {
    var base_url = $("#base_url").val();
    $.ajax({
        url: base_url + "accounting/accounting/selectedform/" + id,
        type: "GET",
        dataType: "json",
        success: function(data) {


            $('#newform').html(data);
            $('#treeviewmodal').modal('show');
            $('#btnSave').hide();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}


"use strict";

function newHeaddata(id) {
    var base_url = $("#base_url").val();
    $.ajax({
        url: base_url + "accounting/accounting/newform/" + id,
        type: "GET",
        dataType: "json",
        success: function(data) {
            console.log(data.rowdata);
            var headlabel = data.headlabel;
            $('#txtHeadCode').val(data.headcode);
            document.getElementById("txtHeadName").value = '';
            $('#txtPHead').val(data.rowdata.HeadName);
            $('#PHeadCode').val(data.pheadcode);
            $('#txtHeadLevel').val(headlabel);
            $('#btnSave').prop("disabled", false);
            $('#btnSave').show();
            $('#btnUpdate').hide();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}
"use strict";
function IsGL_change(){
    if($("#IsGL").prop('checked') == true){
        $("#IsGL").val(1);
    }else{
        $("#IsGL").val(0);
    }
}
"use strict";
function IsTransaction_change(){
    if($("#IsTransaction").prop('checked') == true){
        $("#IsTransaction").val(1);
    }else{
        $("#IsTransaction").val(0);
    }
}

function treeSubmit() {
    var frm = $("#treeview_form");
    var fdata = frm.serialize();
    var base_url = $("#base_url").val();
    var headcode = $('input[name=txtHeadCode]').val();
    var headname = $('input[name=txtHeadName]').val();
    var pheadname = $('input[name=txtPHead]').val();
    var PHeadCode = $('input[name=PHeadCode]').val();
    var level = $('input[name=txtHeadLevel]').val();
    var type = $('input[name=txtHeadType]').val();
    var is_active = $('input[name=IsActive]').val();
    var is_trans = $('input[name=IsTransaction]').val();
    var is_gl = $('input[name=IsGL]').val();
    var csrf_test_name = $("#CSRF_TOKEN").val();
    $.ajax({
        url: base_url + "accounting/accounting/insert_coa",
        method: 'POST',
        dataType: 'json',
        data: {
            txtHeadCode: headcode,
            txtHeadName: headname,
            txtPHead: pheadname,
            PHeadCode: PHeadCode,
            txtHeadLevel: level,
            txtHeadType: type,
            IsActive: is_active,
            IsTransaction: is_trans,
            IsGL: is_gl,
            csrf_test_name: csrf_test_name

        },
        success: function(data) {
            if (data.status == true) {
                toastr["success"](data.message);
            } else {
                toastr["error"](data.exception);
            }
            $("#treeviewmodal").modal('hide');
        },
        error: function(xhr) {
            alert('failed!');
        }
    });
}

function load_dbtvouchercode(id, sl) {
    var base_url = $("#base_url").val();
    $.ajax({
        url: base_url + "accounting/accounting/debtvouchercode/" + id,
        type: "GET",
        dataType: "json",
        success: function(data) {
            $('#txtCode_' + sl).val(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

"use strict";

function addaccountdbt(divName) {
    var optionval = $("#headoption").val();
    var row = $("#debtAccVoucher tbody tr").length;
    var count = row + 1;
    var limits = 500;
    var tabin = 0;
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
        var newdiv = document.createElement('tr');
        var tabin = "cmbCode_" + count;
        var tabindex = count * 2;
        newdiv = document.createElement("tr");

        newdiv.innerHTML = "<td> <select name='cmbCode[]' id='cmbCode_" + count + "' class='form-control' onchange='load_dbtvouchercode(this.value," + count + ")' required></select></td><td><input type='text' name='txtCode[]' class='form-control'  id='txtCode_" + count + "' ></td><td><input type='number' name='txtAmount[]' class='form-control total_price text-right' id='txtAmount_" + count + "' onkeyup='dbtvouchercalculation(" + count + ")' required></td><td><button class='btn btn-danger red' type='button'  onclick='deleteRowdbtvoucher(this)'><i class='fa fa-trash-o'></i></button></td>";
        document.getElementById(divName).appendChild(newdiv);
        document.getElementById(tabin).focus();
        $("#cmbCode_" + count).html(optionval);
        count++;

        $("select.form-control:not(.dont-select-me)").select2({
            placeholder: "Select option",
            allowClear: true
        });
    }
}


"use strict";

function dbtvouchercalculation(sl) {

    var gr_tot = 0;
    $(".total_price").each(function() {
        isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
    });

    $("#grandTotal").val(gr_tot.toFixed(2, 2));
}

"use strict";

function deleteRowdbtvoucher(e) {
    var t = $("#debtAccVoucher > tbody > tr").length;
    if (1 == t) alert("There only one row you can't delete.");
    else {
        var a = e.parentNode.parentNode;
        a.parentNode.removeChild(a)
    }
    dbtvouchercalculation()
}




"use strict";

function addaccountContravoucher(divName) {
    var optionval = $("#headoption").val();
    var row = $("#debtAccVoucher tbody tr").length;
    var count = row + 1;
    var limits = 500;
    var tabin = 0;
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
        var newdiv = document.createElement('tr');
        var tabin = "cmbCode_" + count;
        var tabindex = count * 2;
        newdiv = document.createElement("tr");

        newdiv.innerHTML = "<td> <select name='cmbCode[]' id='cmbCode_" + count + "' class='form-control' onchange='load_dbtvouchercode(this.value," + count + ")' required></select></td><td><input type='text' name='txtCode[]' class='form-control'  id='txtCode_" + count + "' ></td><td><input type='number' name='txtAmount[]' class='form-control total_price text-right' value='0' id='txtAmount_" + count + "' onkeyup='calculationContravoucher(" + count + ")'></td><td><input type='number' name='txtAmountcr[]' class='form-control total_price1 text-right' id='txtAmount1_" + count + "' value='0' onkeyup='calculationContravoucher(" + count + ")'></td><td><button  class='btn btn-danger red' type='button'  onclick='deleteRowContravoucher(this)'><i class='fa fa-trash-o'></i></button></td>";
        document.getElementById(divName).appendChild(newdiv);
        document.getElementById(tabin).focus();
        $("#cmbCode_" + count).html(optionval);
        count++;

        $("select.form-control:not(.dont-select-me)").select2({
            placeholder: "Select option",
            allowClear: true
        });
    }
}


"use strict";

function calculationContravoucher(sl) {
    var gr_tot1 = 0;
    var gr_tot = 0;
    $(".total_price").each(function() {
        isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
    });

    $(".total_price1").each(function() {
        isNaN(this.value) || 0 == this.value.length || (gr_tot1 += parseFloat(this.value))
    });
    $("#grandTotal").val(gr_tot.toFixed(2, 2));
    $("#grandTotal1").val(gr_tot1.toFixed(2, 2));
}


"use strict";

function deleteRowContravoucher(e) {
    var t = $("#debtAccVoucher > tbody > tr").length;
    if (1 == t) alert("There only one row you can't delete.");
    else {
        var a = e.parentNode.parentNode;
        a.parentNode.removeChild(a)
    }
    calculationContravoucher()
}

"use strict";

function bank_paymet(val) {
    if (val == 2) {
        var style = 'block';
        document.getElementById('bank_id').setAttribute("required", true);
        document.getElementById('cmbDebit').removeAttribute("required");
        $(".bankpayment").addClass("form-control");
        document.getElementById('box_div').style.display = 'none';
    } else {
        var style = 'none';
        document.getElementById('bank_id').removeAttribute("required");
        document.getElementById('cmbDebit').setAttribute("required", true);
        document.getElementById('box_div').style.display = 'block';
    }

    document.getElementById('bank_div').style.display = style;
}

$(document).ready(function() {
    $(".bankpayment").css("width", "100%");
});


/*supplier receive part*/
"use strict";

function load_supplier_code(id, sl) {
    var base_url = $("#base_url").val();
    $.ajax({
        url: base_url + "accounting/accounting/supplier_headcode/" + id,
        type: "GET",
        dataType: "json",
        success: function(data) {

            $('#txtCode_' + sl).val(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}


"use strict";

function supplierRcvcalculation(sl) {

    var gr_tot = 0;
    $(".total_price").each(function() {
        isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
    });

    $("#grandTotal").val(gr_tot.toFixed(2, 2));
}

/*customer receive part*/
"use strict";

function load_customer_code(id, sl) {
    var base_url = $("#base_url").val();
    $.ajax({
        url: base_url + "accounting/accounting/customer_headcode/" + id,
        type: "GET",
        dataType: "json",
        success: function(data) {

            $('#txtCode_' + sl).val(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

"use strict";

function CustomerRcvcalculation(sl) {

    var gr_tot = 0;
    $(".total_price").each(function() {
        isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
    });

    $("#grandTotal").val(gr_tot.toFixed(2, 2));
}

/*report part start */
"use strict";

function cmbCode_bankbookonchange() {
    var Sel = $('#cmbCode').val();
    var Text = $('#cmbCode').text();
    var select = $("option:selected", $("#cmbCode")).text()
    $("#txtName").val(select);
    $("#txtCode").val(Sel);
}


$(document).ready(function() {
    "use strict";
    var csrf_test_name = $("#CSRF_TOKEN").val();
    var base_url = $("#base_url").val();
    $('#cmbGLCode').on('change', function() {
        var Headid = $(this).val();
        $.ajax({
            url: base_url + 'accounting/accounting/general_led',
            type: 'POST',
            data: {
                Headid: Headid,
                csrf_test_name: csrf_test_name,
            },
            success: function(data) {
                $("#ShowmbGLCode").html(data);
            }
        });

    });
});
// Print html element
function printDiv(divName) {
    "use strict";
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    document.body.style.marginTop = "0px";
    window.print();
    document.body.innerHTML = originalContents;
}

$('.get-voucher-info-ajax').select2({
    minimumInputLength: 1,
    ajax: {
        type: "GET",
        url: base_url + 'accounting/accounting/search_rv',
        dataType: 'json',
        data: function(params) {
            var query = {
                    search: params.term,
                    csrf_test_name: csrf_test_name
                }
                // Query parame_ters will be ?search=[term]&type=public
            return query;
        },
        processResults: function(data) {
            return {
                results: $.map(data.items, function(item) {
                    return {
                        text: item.text,
                        id: item.id
                    }
                })
            };
        }
    }
});
// get service list by appointment Id
$('#voucher_id').on('change', function(e) {
    e.preventDefault();
    var id = $(this).val();
    var submit_url = base_url + "accounting/accounting/get_rv_info/" + id;
    $.ajax({
        type: 'POST',
        url: submit_url,
        data: {
            csrf_test_name: csrf_test_name
        },
        dataType: 'JSON',
        success: function(res) {
            console.log(res);
            $('#customer_id').val(res[0].customer_id);
            $('#customer_name').val(res[0].customer_name);
            $('#code').val(res[0].COAID);
            $('#headCode').val(res[1].COAID);
            $('#date').val(res[0].VDate);
            $('#current_balance').val(res[0].Debit);
            $('#pv_balance').val(res[0].Debit);
            $('#total_vat').val(res[0].total_vat);
            $('#total_balance').val(res[0].total_balance);
        }
    });
});
$('#pay_amount').on('keyup', function() {
    var total_balance = $('#total_balance').val();
    var pay_amount = $(this).val();
    var pay_vat = (pay_amount * 15) / 100;
    var remaining_balance = total_balance - pay_amount - pay_vat;
    $('#pay_vat').val(pay_vat);
    $('#remaining_balance').val(remaining_balance);
    var amount = +pay_amount + +pay_vat;
    $('#amount').val(amount);
    $('#grandtotal').val(amount);
});
//Payment method toggle
$(document).ready(function() {
    "use strict";
    $('#add_more_btn').on('click', function(e) {
        e.preventDefault();
        var grandtotal = $('#grandtotal').val();
        var totalpaid = 0;
        $("input[name^='payment_amount']").each(function() {
            totalpaid += +$(this).val();
        });
        $.ajax({
            type: "post",
            url: base_url + 'accounting/accounting/get_pos_payment_form',
            data: {
                csrf_test_name: csrf_test_name,
                grandtotal: grandtotal,
                totalpaid: totalpaid,
                more: 'more'
            },
            success: function(data) {
                $('#payment_area_table').append(data);
            }
        }).done(function() {
            $('.del_more_btn').on('click', function(e) {
                e.preventDefault();
                var row_id = $(this).attr('data-row_id');
                $('#row_' + row_id).remove();
            });
        });
    });


    $('.get-all-voucher-info-ajax').select2({
        placeholder: "Select Voucher No",
        minimumInputLength: 1,
        ajax: {
            type: "GET",
            url: base_url + 'accounting/areports/search_all_rv',
            dataType: 'json',
            data: function(params) {
                var query = {
                    search: params.term,
                    csrf_test_name: csrf_test_name
                }

                return query;
            },
            processResults: function(data) {
                return {
                    results: $.map(data.items, function(item) {
                        return {
                            text: item.text,
                            id: item.id
                        }
                    })
                };
            }
        }
    });
    $('#voucher_no').on('change', function(e) {
        e.preventDefault();
        var id = $(this).val();
        var submit_url = base_url + "accounting/areports/get_v_info/" + id;
        $.ajax({
            type: 'POST',
            url: submit_url,
            data: {
                csrf_test_name: csrf_test_name
            },
            dataType: 'JSON',
            success: function(res) {
                console.log(res);
                $('#voucher_row').html(res['list']);
                $('#total_debit').html('<b>' + res['total_debit'] + '</b>');
                $('#total_credit').html('<b>' + res['total_credit'] + '</b>');
            }
        });
    });

    // get profit loss
    $('#profit_loss_daterange').on('click', function(e) {
        e.preventDefault();
        var date = $('.reportrange1').val();
        var submit_url = base_url + "accounting/areports/profitLossReoprt";
        if (date) {
            $.ajax({
                type: 'POST',
                url: submit_url,
                data: {
                    'csrf_stream_name': csrf_val,
                    date_range: date
                },
                dataType: 'JSON',
                success: function(res) {
                    $('#allResult').html('');
                    $('#allResult').html(res.data);
                }
            });
        }
    });

    $('#cmbGLCode').on('change', function(e) {
        e.preventDefault();
        var id = $(this).val();
        console.log(id);
        $.ajax({
            type: 'GET',
            url: base_url + 'accounting/areports/getGLTransList/' + id,
            dataType: 'json',
            data: {
                csrf_test_name: csrf_test_name
            },
        }).done(function(data1) {
            $("#cmbCode").empty();
            var option = new Option('', '', true, true);
            $("#cmbCode").append(option).trigger('change');
            $("#cmbCode").select2({
                placeholder: "Select Voucher No",
                data: data1
            });
        });
    });
});