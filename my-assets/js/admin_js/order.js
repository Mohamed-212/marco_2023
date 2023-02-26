"use strict";
var csrf_test_name = $("#CSRF_TOKEN").val();
//Add invocie row field
function addInputField(t) {
    //Variable declaratipn
    var count = 2,
            limits = 500;

    if (count == limits)
        alert("You have reached the limit of adding " + count + " inputs");
    else {
        var a = "product_name" + count,
                e = document.createElement("tr");
        //e.innerHTML = "<td><input type='text' name='product_name' placeholder='Product Name' onkeypress='invoice_productList(" + count + ");' class='form-control productSelection' required='' id='product_name" + count + "' ><input type='hidden' class='autocomplete_hidden_value product_id_" + count + "' name='product_id[]' id='SchoolHiddenId'/></td><td><input type='text' name='available_quantity[]' id='' class='form-control text-right available_quantity_" + count + "' placeholder='0' readonly='' /></td><td><input type='text' class='form-control text-right unit_" + count + "' placeholder='None' readonly='' /></td><td><input type='number' name='product_quantity[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' id='total_qntt_" + count + "' class='form-control text-right' value='1' min='1' /></td><td><input type='number' name='product_rate[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' placeholder='0.00' min='0' id='price_item_" + count + "' class='price_item" + count + " form-control text-right' required='' /></td><td><input type='number' name='discount[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' id='discount_" + count + "' class='form-control text-right' placeholder='0.00' min='0' /></td><td><input class='total_price form-control text-right' type='text' name='total_price[]' id='total_price_" + count + "' placeholder='0.00' tabindex='' readonly='readonly' /></td><td><input type='hidden' id='cgst_" + count + "' class='cgst'/> <input type='hidden' id='sgst_" + count + "' class='sgst'/><input type='hidden' id='igst_" + count + "' class='igst'/><input type='hidden' id='total_cgst_" + count + "' class='total_cgst' name='cgst[]' /><input type='hidden' id='total_sgst_" + count + "' class='total_sgst' name='sgst[]'/><input type='hidden' id='total_igst_" + count + "' class='total_igst' name='igst[]'/><input type='hidden' name='cgst_id[]' id='cgst_id_" + count + "'><input type='hidden' name='sgst_id[]' id='sgst_id_" + count + "'><input type='hidden' name='igst_id[]' id='igst_id_" + count + "'><input type='hidden' name='variant_id[]' id='variant_" + count + "'><input type='hidden' id='total_discount_" + count + "' /><input type='hidden' id='all_discount_" + count + "' class='total_discount'/><button style='text-align: right;' class='btn btn-danger' type='button' value='Delete' onclick='deleteRow(this)'>Delete</button></td>", document.getElementById(t).appendChild(e), document.getElementById(a).focus(), count++
        e.innerHTML = "<td><input type='text' name='product_name' placeholder='Product Name' onkeypress='invoice_productList(" + count + ");' class='form-control productSelection' required='' id='product_name" + count + "' ><input type='hidden' class='autocomplete_hidden_value product_id_" + count + "' name='product_id[]' id='SchoolHiddenId'/></td><td><input type='text' name='available_quantity[]' id='' class='form-control text-right available_quantity_" + count + "' placeholder='0' readonly='' /></td><td><input type='number' name='product_quantity[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' id='total_qntt_" + count + "' class='form-control text-right' value='1' min='1' /></td><td><input type='number' name='product_rate[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' placeholder='0.00' min='0' id='price_item_" + count + "' class='price_item" + count + " form-control text-right' required='' /></td><td><input type='number' name='discount[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' id='discount_" + count + "' class='form-control text-right' placeholder='0.00' min='0' /></td><td><input class='total_price form-control text-right' type='text' name='total_price[]' id='total_price_" + count + "' placeholder='0.00' tabindex='' readonly='readonly' /></td><td><input type='hidden' id='cgst_" + count + "' class='cgst'/> <input type='hidden' id='sgst_" + count + "' class='sgst'/><input type='hidden' id='igst_" + count + "' class='igst'/><input type='hidden' id='total_cgst_" + count + "' class='total_cgst' name='cgst[]' /><input type='hidden' id='total_sgst_" + count + "' class='total_sgst' name='sgst[]'/><input type='hidden' id='total_igst_" + count + "' class='total_igst' name='igst[]'/><input type='hidden' name='cgst_id[]' id='cgst_id_" + count + "'><input type='hidden' name='sgst_id[]' id='sgst_id_" + count + "'><input type='hidden' name='igst_id[]' id='igst_id_" + count + "'><input type='hidden' name='variant_id[]' id='variant_" + count + "'><input type='hidden' id='total_discount_" + count + "' /><input type='hidden' id='all_discount_" + count + "' class='total_discount'/><button style='text-align: right;' class='btn btn-danger' type='button' value='Delete' onclick='deleteRow(this)'>Delete</button></td>", document.getElementById(t).appendChild(e), document.getElementById(a).focus(), count++
    }
}
//Add edit invocie row field
function addEditInvoiceItem(t) {
    //Variable declaratipn
    var rows = $('#edit_invoice tbody tr').length;
    var count = rows + 1,
            limits = 500;

    if (count == limits)
        alert("You have reached the limit of adding " + count + " inputs");
    else {
        var a = "product_name" + count,
                e = document.createElement("tr");
        e.innerHTML = "<td><input type='text' name='product_name' placeholder='Product Name' onkeypress='invoice_productList(" + count + ");' class='form-control productSelection' required='' id='product_name" + count + "' ><input type='hidden' class='autocomplete_hidden_value product_id_" + count + "' name='product_id[]' id='SchoolHiddenId'/></td><td><input type='text' name='available_quantity[]' id='' class='form-control text-right available_quantity_" + count + "' placeholder='0' readonly='' /></td><td><input type='text' class='form-control text-right unit_" + count + "' placeholder='None' readonly='' /></td><td><input type='number' name='product_quantity[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' id='total_qntt_" + count + "' class='form-control text-right' value='1' min='1' /></td><td><input type='number' name='product_rate[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' placeholder='0.00' min='0' id='price_item_" + count + "' class='price_item" + count + " form-control text-right' required='' /></td><td><input type='number' name='discount[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' id='discount_" + count + "' class='form-control text-right' placeholder='0.00' min='0' /></td><td><input class='total_price form-control text-right' type='text' name='total_price[]' id='total_price_" + count + "' placeholder='0.00' tabindex='' readonly='readonly' /></td><td><input type='hidden' id='cgst_" + count + "' class='cgst'/> <input type='hidden' id='sgst_" + count + "' class='sgst'/><input type='hidden' id='igst_" + count + "' class='igst'/><input type='hidden' id='total_cgst_" + count + "' class='total_cgst' name='cgst[]' /><input type='hidden' id='total_sgst_" + count + "' class='total_sgst' name='sgst[]'/><input type='hidden' id='total_igst_" + count + "' class='total_igst' name='igst[]'/><input type='hidden' name='cgst_id[]' id='cgst_id_" + count + "'><input type='hidden' name='sgst_id[]' id='sgst_id_" + count + "'><input type='hidden' name='igst_id[]' id='igst_id_" + count + "'><input type='hidden' name='variant_id[]' id='variant_" + count + "'><input type='hidden' id='total_discount_" + count + "' /><input type='hidden' id='all_discount_" + count + "' class='total_discount'/><button style='text-align: right;' class='btn btn-danger' type='button' value='Delete' onclick='deleteRow(this)'>Delete</button></td>", document.getElementById(t).appendChild(e), document.getElementById(a).focus(), count++
    }
}

//after select variant check  limit to order limit
function  quantity_limit(item) {
    let batch_no = $("#batch_no_" + item).find(":selected").val();
    if (typeof batch_no === "undefined")
    {
        batch_no = $("#batch_no" + item).find(":selected").val();
    }
    var html = $("select option[value='" + batch_no + "']").parent().get();
    var total_qnt = 0;
    var quantity = 0;
    let current_quantity = $("#total_qntt_" + item).val();
    let available_quantity = $("#avl_qntt_" + item).val();
    if (parseInt(available_quantity) < parseInt(current_quantity)) {
        alert('stock not available');
        $("#total_qntt_" + item).val(0);
        quantity_calculate(item);
        return false;
    }
    for (var i = 0; i < html.length; i++) {
        var batch_no_attr = html[i].id;
        var sl = batch_no_attr.split("batch_no_");
        if (sl[0] != "")
        {
            sl = batch_no_attr.split("batch_no");
        }
        quantity = parseInt($("#total_qntt_" + sl[1]).val());
        total_qnt += quantity;
    }
    if (parseInt(available_quantity) < total_qnt) {
        alert('stock not available');
        $("#total_qntt_" + item).val(0);
        quantity_calculate(item);
        return false;
    }
    quantity_calculate(item);
}
//Quantity calculate
function quantity_calculate(item) {
    var quantity = parseInt($("#total_qntt_" + item).val(), 10);  
    var price_item = parseFloat($("#price_item_" + item).val());
    if (parseFloat($("#discount_" + item).attr('data-value')) > 0) {
        $("#discount_" + item).val($("#discount_" + item).attr('data-value'));
        setTimeout(() => {$("#discount_" + item).attr('data-value', -1);}, 1200);
    }
    var discount = parseFloat($("#discount_" + item).val());
    // console.log(discount);
    var total_discount = parseFloat($("#total_discount_" + item).val());
    var cgst = parseFloat($("#cgst_" + item).val() || 0);
    // console.log(cgst);
    var sgst = $("#sgst_" + item).val();
    var igst = $("#igst_" + item).val();

    var all_discount = discount * quantity;
    
    // console.log(all_discount, quantity , price_item, cgst);
    $("#all_discount_" + item).val(all_discount);

    //Tax calculation
    var net_price = (quantity * price_item);
    // console.log('-- ' + net_price + ' ' + quantity , price_item, all_discount);
    var cgst_tax = (net_price * cgst);
    var sgst_tax = (net_price * sgst);
    var igst_tax = (net_price * igst);

    //Tax calculation set
    $("#total_cgst_" + item).val(cgst_tax);
    $("#total_sgst_" + item).val(sgst_tax);
    $("#total_igst_" + item).val(igst_tax);

    if (quantity > 0) {
        var n = quantity * price_item;
        $("#total_price_" + item).val(n);
        $("#quantity_" + item).text('[ ' + quantity + ' ]');
        $(".qnt_price_" + item).text('(' + quantity + ' x ' + price_item + ')');
        $(".total_price_bill_" + item).text(n);
    } else {
        var n = quantity * price_item;
        $("#total_price_" + item).val(n);
    }
    calculateSum();
    invoice_paidamount();
}

function check_quotation() {
    var elem = $('#is_quotation');
    if (elem.prop('checked') == true) {
        // calculateSumQuotation();
        elem.val('1');
        // $('#paidAmount').val('0');
        // $('#dueAmmount').val('0');
    } else {
        // calculateSum();
        elem.val('0');
    }
    calculateSum();
}

// function submit_form(e) {
//     //here I want to prevent default
//     e = e || window.event;
//     e.preventDefault();
//     var valid = false;

//     var elem = $("#is_quotation");
//     if (elem.prop('checked') == true) {
//         $(".total_cgst").each(function () {
//             this.value = 0;
//         })
//         var cgst = $("#total_cgst").val();
//         if (cgst > 0) {
//             $("#grandTotal").val($("#grandTotal").val() - cgst);
//             $("#dueAmmount").val($("#dueAmmount").val() - cgst);
//         }
//         $("#total_cgst").val('0');
//     }

//     // validate product quantity
//     $('[name="available_quantity[]"]').each(function () {
//         if (!this.value || this.value < 1) {
//             alert(products_with_no_quantity);
//             valid = false;
//             return;
//         }
//         valid = true;
//     }).promise().done(function() {
//         if (!valid) return;
//         $('[name="product_quantity[]"]').each(function () {
//             if (!this.value || this.value < 1) {
//                 alert(products_with_no_quantity);
//                 valid = false;
//                 return;
//             }
//             valid = true;
//         }).promise().done(function() {
//             if (!valid) return;

//             $("form#validate, form#normalinvoice").submit();
//         });
//     });
// }

function submit_form(e) {
    //here I want to prevent default
    e = e || window.event;
    e.preventDefault();
    var valid = false;

    if (typeof noinstallErr == 'undefined') {
        if (parseFloat($('#dueAmmount').val()) > 0 && $('#is_installment').val() == '0') {
        alert(installErr);
        return;
    }

    if (parseFloat($('#paidAmount').val()) > 0 && !($('#payment_id').val())) {
        alert(payment_bank_not_selected);
        return;
    }

    }

    if (parseFloat($('#dueAmmount').val()) < 0) {
        alert(paidErr);
        return;
    }

    // var elem = $("#is_quotation");
    // if (elem.prop('checked') == true) {
    //     $(".total_cgst").each(function () {
    //         this.value = 0;
    //     })
    //     var cgst = $("#total_cgst").val();
    //     if (cgst > 0) {
    //         $("#grandTotal").val($("#grandTotal").val() - cgst);
    //         $("#dueAmmount").val($("#dueAmmount").val() - cgst);
    //     }
    //     $("#total_cgst").val('0');
    // }

    // validate product quantity
    $('[name="available_quantity[]"]').each(function () {
        if (!this.value || this.value < 1) {
            alert(products_with_no_quantity);
            valid = false;
            return;
        }
        valid = true;
    }).promise().done(function() {
        if (!valid) return;
        $('[name="product_quantity[]"]').each(function () {
            if (!this.value || this.value < 1) {
                alert(products_with_no_quantity);
                valid = false;
                return;
            }
            valid = true;
        }).promise().done(function() {
            if (!valid) return;

            // validate installment amount
            if ($('#is_installment').val() == '1') {
                var dueAmount = parseFloat($('#dueAmmount').val());
                // sum installment amount
                var installmentAmount = 0;
                $('#installment_details input[name="amount[]"]').each(function () {
                    installmentAmount += parseFloat(this.value);
                    // console.log(installmentAmount, parseFloat(this.value));
                }).promise().done(function () {
                    if (!valid) return;
                    if (parseFloat(dueAmount) == parseFloat(installmentAmount)) {
                        $("form#validate, form#normalinvoice").submit();
                    } else {
                        alert(installment_amount_is_not_valid);
                        valid = false;
                        return;
                    }
                });
                return;
            }

            if (parseFloat($('#paidAmount').val()) > 0) {
                if ($('#payment_id').val() != '') {
                    $("form#validate, form#normalinvoice").submit();
                } else {
                    alert(payment_bank_not_selected);
                }
            } else {
                $("form#validate, form#normalinvoice").submit();
            }
        });
    });
}

function calculateSumQuotation() {
    var cgst = 0;
    var sgst = 0;
    var igst = 0;
    var e = 0;
    var f = 0;
    var total_discount = 0;
    var total_price = 0;
    var inv_dis = 0;
    var ser_chg = 0;
    var shipping_charge = 0;
    var sum = 0;
    var percentage_dis = 0;

    //Total CGST
    $(".total_cgst").each(function () {
        var dataVal = parseFloat($(this).attr('data-value'));
        if (dataVal > 0) {
            $(this).val(dataVal);
            setTimeout(() => {$(this).attr('data-value', -1);}, 1000);
        }

        isNaN(this.value) || 0 == this.value.length || (cgst += parseFloat(this.value));
    }),
            // cgst = 0;
    $("#total_cgst").val(cgst.toFixed(2)),
            $(".total_cgst_bill").text(cgst.toFixed(2)),
            //Total SGST
            $(".total_sgst").each(function () {
        isNaN(this.value) || 0 == this.value.length || (sgst += parseFloat(this.value))
    }),
            $("#total_sgst").val(sgst.toFixed(2)),
            $(".total_sgst_bill").text(sgst.toFixed(2)),
            //Total IGST
            $(".total_igst").each(function () {
        isNaN(this.value) || 0 == this.value.length || (igst += parseFloat(this.value))
    }),
            $("#total_igst").val(igst.toFixed(2)),
            $(".total_igst_bill").text(igst.toFixed(2)),
            //Total Discount
            $(".total_discount").each(function () {
        isNaN(this.value) || 0 == this.value.length || (total_discount += parseFloat(this.value))
    }),
            $("#total_discount_ammount").val(total_discount.toFixed(2)),
            $(".total_discount_bill").text(total_discount.toFixed(2)),
            //Total Price
            $(".total_price").each(function () {
        isNaN(this.value) || 0 == this.value.length || (total_price += parseFloat(this.value))
    }),
            cgst = cgst.toFixed(2),
            sgst = sgst.toFixed(2),
            igst = igst.toFixed(2),
            e = total_price.toFixed(2),
            f = total_discount.toFixed(2),
            inv_dis = $("#invoice_discount").val(),
            ser_chg = $("#service_charge").val();
    shipping_charge = (($("#shipping_charge").val()) ? $("#shipping_charge").val() : 0);

    if ($('#is_quotation').prop('checked')) {
        cgst = 0;
    }

    sum =
        +cgst +
        +sgst +
        +igst +
        +e +
        -f +
        //-inv_dis +
        +ser_chg +
        +shipping_charge;
    percentage_dis = (parseFloat($('#percentage_discount').val() || 0) / 100) * sum;

    sum = sum + -percentage_dis;

    sum -= inv_dis;

    $("#grandTotal").val(sum.toFixed(2));
    $(".total_bill").text(sum.toFixed(2));

    invoice_paidamount();
}

//Calculate all summation
function calculateSum() {
    var cgst = 0;
    var sgst = 0;
    var igst = 0;
    var e = 0;
    var f = 0;
    var total_discount = 0;
    var percentage_dis = 0;
    var total_price = 0;
    var inv_dis = 0;
    var ser_chg = 0;
    var shipping_charge = 0;
    var sum = 0;

    //Total CGST
    $(".total_cgst").each(function () {
        var dataVal = parseFloat($(this).attr('data-value'));
        if (dataVal > 0) {
            // console.log(dataVal);
            $(this).val(dataVal);
            setTimeout(() => {$(this).attr('data-value', -1);}, 100);
        }
        
        // isNaN($(this).val()) || 0 == $(this).val().length || (cgst += parseFloat($(this).val()))
        isNaN(this.value) || 0 == this.value.length || (cgst += parseFloat(this.value))
        // console.log(this.value);
    }),
           
            $("#total_cgst").val(cgst.toFixed(2)),
            $(".total_cgst_bill").text(cgst.toFixed(2)),
            //Total SGST
            $(".total_sgst").each(function () {
        isNaN(this.value) || 0 == this.value.length || (sgst += parseFloat(this.value))
    }),
            $("#total_sgst").val(sgst.toFixed(2)),
            $(".total_sgst_bill").text(sgst.toFixed(2)),
            //Total IGST
            $(".total_igst").each(function () {
        isNaN(this.value) || 0 == this.value.length || (igst += parseFloat(this.value))
    }),
            $("#total_igst").val(igst.toFixed(2)),
            $(".total_igst_bill").text(igst.toFixed(2)),
            //Total Discount
            $(".total_discount").each(function () {
        isNaN(this.value) || 0 == this.value.length || (total_discount += parseFloat(this.value))
    }),
            $("#total_discount_ammount").val(total_discount.toFixed(2)),
            $(".total_discount_bill").text(total_discount.toFixed(2)),
            //Total Price
            $(".total_price").each(function () {
        isNaN(this.value) || 0 == this.value.length || (total_price += parseFloat(this.value))
    }),
            cgst = cgst.toFixed(2),
            sgst = sgst.toFixed(2),
            igst = igst.toFixed(2),
            e = total_price.toFixed(2),
            f = total_discount.toFixed(2),
            inv_dis = $("#invoice_discount").val(),
            ser_chg = $("#service_charge").val();
    shipping_charge = (($("#shipping_charge").val()) ? $("#shipping_charge").val() : 0);

    var dataVal = parseFloat($("#percentage_discount").attr('data-value') || 0);
        if (dataVal > 0) {
            $("#percentage_discount").val(dataVal);
            $("#percentage_discount").attr('data-value', -1);
        }

        if ($('#is_quotation').prop('checked')) {
            cgst = 0;
        }

    sum =
        // +cgst +
        // +sgst +
        // +igst +
        +e +
        -f +
        //-inv_dis +
        +ser_chg +
        +shipping_charge;
    percentage_dis = (parseFloat($('#percentage_discount').val() || 0) / 100) * sum;

    sum = sum + -percentage_dis;

    sum -= inv_dis;

    sum += parseFloat(cgst || 0);

    $("#grandTotal").val(sum.toFixed(2));
    $(".total_bill").text(sum.toFixed(2));

    invoice_paidamount();

    var tqty = 0;
    $('input[name="product_quantity[]"]').each(function () {
        var c = $(this).attr('id').replace('total_qntt_', '');
        var cID = $('#category_id_' + c).val();
        var pt = $('#product_type').val();
        // console.log(pt);
        

        if (pt == '2') {
            if (cID != accessories_category_id) {
                tqty += parseInt($(this).val());
                // console.log(cID);
            }
        } else {
            // if (cID != accessories_category_id) {
                tqty += parseInt($(this).val());
            // }
        }
        // console.log(c);

        
    }).promise().done(function () {
        $('#total_quantity').val(tqty);
    });
}

//Inovice paid amount
function invoice_paidamount() {
    var customer_balance = parseFloat(
        $('#customer_balance').val().replace(/\,/gi, '')
    );
    // customer_balance = 500;
    customer_balance = customer_balance < 0 ? Math.abs(customer_balance) : 0;
    var t = parseFloat($('#grandTotal').val() || '0.00'),
        a = parseFloat($('#paidAmount').val() || '0.00'),
        e = t - customer_balance - a;
    var test = e.toFixed(2);

    // console.log(t, customer_balance, a);

    if (customer_balance >= t) {
        test = 0;
    }

    $('#dueAmmount').val(test);
    $('.installment_setup').hide();
    $('#is_installment').val(0);
}

//Stock limit check
function stockLimit(t) {
    var a = $("#total_qntt_" + t).val(),
            e = $(".product_id_" + t).val(),
            o = $(".baseUrl").val();
    $.ajax({
        type: "POST",
        url: o + "Cinvoice/product_stock_check",
        data: {
            product_id: e
        },
        cache: !1,
        success: function (e) {
            if (a > Number(e)) {
                var o = "You can purchase maximum " + e + " Items";
                alert(o), $("#qty_item_" + t).val("0"), $("#total_qntt_" + t).val("0"), $("#total_price_" + t).val("0")
            }
        }
    })
}

//Stock limit check by ajax
function stockLimitAjax(t) {
    var a = $("#total_qntt_" + t).val(),
            e = $(".product_id_" + t).val(),
            o = $(".baseUrl").val();
    $.ajax({
        type: "POST",
        url: o + "Cinvoice/product_stock_check",
        data: {
            product_id: e
        },
        cache: !1,
        success: function (e) {
            if (a > Number(e)) {
                var o = "You can purchase maximum " + e + " Items";
                alert(o), $("#qty_item_" + t).val("0"), $("#total_qntt_" + t).val("0"), $("#total_price_" + t).val("0.00"), calculateSum()
            }
        }
    })
}

//Invoice installment
function installment() {
    var paidAmount = $('#paidAmount').val();
    var dueAmount = $('#dueAmmount').val();
    $('#installment_details').html('');
    $('#installment_header').html('');
    $('#pay_day').val('');
    $('#month_no').val('');
    if ($(".installment_setup").css('display') != 'none') {
        $("#is_installment").val(0);
        $('#pay_day').prop('required', false);
        $('#pay_day').attr('aria-required', false);
        $('#month_no').prop('required', false);
        $('#month_no').attr('aria-required', false);
    } else {
        $("#is_installment").val(1);
        $('#pay_day').prop('required', true);
        $('#pay_day').attr('aria-required', true);
        $('#month_no').prop('required', true);
        $('#month_no').attr('aria-required', true);
    }
    // if due is zero then add all fullpaid to it
    if (parseInt(dueAmount) == 0) {
        $('#dueAmmount').val(paidAmount);
        setTimeout(() => $('#paidAmount').val('0.00'), 20);
    }

    $('.installment_setup').toggle();
    $('#installment_id, #full').removeClass('btn-success').addClass('btn-warning');

    $('#installment_id').addClass('btn-success').removeClass('btn-warning');
}

function add_month() {

    $('#installment_details').html('');
    var month_no = Math.ceil($('#month_no').val());
    var due_amount = $('#dueAmmount').val();
    var amount_per_month = (due_amount / month_no).toFixed(2);
    var current_date = new Date();
    var year = current_date.getFullYear();
    var month = current_date.getMonth();
    var day = Math.ceil($('#pay_day').val());
    if (month_no > 0 && day > 0 && due_amount > 0) {
        var content = '';
        $('#installment_header').show();
        for (let i = 1; i <= month_no; i++) {
            var d = new Date(year, month + i, day);
            var m = d.getMonth() + 1;
            if (m < 10) {
                m = '0' + m;
            }
            var da = d.getDate();
            if (da < 10) {
                da = '0' + da;
            }
            var y = d.getFullYear();
            // var date = y + '-' + m + '-' + da;
            var date = da + '-' + m + '-' + y;
            content += '<div class="row" style="display: flex;justify-content: space-around;">' +
                    '<div class="col-sm-4" style="float: none">' +
                    '<div class="form-group">' +
                    '<input class="form-control" style="text-align: center;" type="number" name="amount[]" value="' + amount_per_month + '" >' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-sm-4" style="float: none">' +
                    '<div class="form-group">' +
                    '<input class="form-control" style="text-align: center;" type="text" value="' + date + '" name="due_date[]" readonly>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
        }
        $('#installment_details').html(content);
    }
}

//Invoice full paid
function full_paid() {
    var customer_balance = parseFloat(
        $('#customer_balance').val().replace(/\,/gi, '')
    );
    // customer_balance = 500;
    var elem = $('#is_quotation');
    // if (elem.prop('checked') == true) {
    //     calculateSumQuotation();
    // } else {
    //     calculateSum();
    // }
    calculateSum();
    var grandTotal = parseFloat($('#grandTotal').val() || '0');
    // if (customer_balance > grandTotal) {
    //     $('#paidAmount').val(0);
    // } else {
    //     $('#paidAmount').val(grandTotal - Math.abs(customer_balance));
    // }

    // $('#paidAmount').val(parseFloat($('#dueAmmount').val() || '0') + parseFloat($('#paidAmount').val() || '0'));
    setTimeout(() => {
        var grandTotal = parseFloat($('#grandTotal').val() || '0');
        $('#paidAmount').val((parseFloat($('#dueAmmount').val() || '0') + parseFloat($('#paidAmount').val() || '0')).toFixed(2));
    $('#dueAmmount').val('0');
    }, 200);

    invoice_paidamount();
    $('.installment_setup').hide();
    $('#installment_id, #full')
        .removeClass('btn-success')
        .addClass('btn-warning');
    $('#is_installment').val(0);
    $('#full').removeClass('btn-warning').addClass('btn-success');
}

//Delete a row from invoice table
function deleteRow(t) {
    var a = $("#normalinvoice > tbody > tr").length;
    if (1 == a) {
        alert("There only one row you can't delete.");
        return false;
    } else {
        var e = t.parentNode.parentNode;
        e.parentNode.removeChild(e);
        calculateSum();
        invoice_paidamount();
    }

    calculateSum();
    invoice_paidamount();

    $('#item-number').html('0');
    $(".itemNumber>tr").each(function (i) {
        $('#item-number').html(i + 1);
        $('.item_bill').html(i + 1);
    });
}

//Delete a pos row from POS table
function deletePosRow(t) {

    $("#" + t).remove();
    $("." + t).remove();

    calculateSum();
    invoice_paidamount();

    $('#item-number').html('0');
    $(".itemNumber>tr").each(function (i) {
        $('#item-number').html(i + 1);
        $('.item_bill').html(i + 1);
    });
}

function get_pri_type_rate() {
    $("#addinvoiceItem tr").each(function (index, tr) {
        var sl = index + 1;
        var pri_type_id = $("#pri_type").val();
        var product_id = $(".product_id_" + sl).val();
        var product_type = $("#product_type").val();
        // alert(product_type);

        $.ajax({
            type: "post",
            async: false,
            url: base_url + "dashboard/Cinvoice/get_pri_type_rate",
            data: {
                csrf_test_name: csrf_test_name,
                product_id: product_id,
                pri_type_id: pri_type_id,
                product_type: product_type,
            },
            success: function (result) {
                var res = JSON.parse(result);

                if ($('#product_type').val() == 2 && $('#category_id_' + sl).val() == accessories_category_id) {
                    $('#price_item_' + sl).val(0);
                } else {
                    $('#price_item_' + sl).val(res[1]);
                }

                

                $("#price_item_saved_" + sl).val(res[1]);
                quantity_calculate(sl);

            },
            error: function () {
                alert("Request Failed, Please try again!");
            },
        });
    });
}

function get_pri_type_rate1(sl) {

    var pri_type_id = $("#pri_type").val();
    var product_id = $(".product_id_" + sl).val();
    var product_type = $("#product_type").val();
    // alert(product_type + 'wewewe');

    $.ajax({
        type: "post",
        async: false,
        url: base_url + "dashboard/Cinvoice/get_pri_type_rate",
        data: {
            csrf_test_name: csrf_test_name,
            product_id: product_id,
            pri_type_id: pri_type_id,
            product_type: product_type,
        },
        success: function (result) {
            var res = JSON.parse(result);
            
            if ($('#product_type').val() == 2 && $('#category_id_' + sl).val() == accessories_category_id) {
                $('#price_item_' + sl).val(0);
            } else {
                $('#price_item_' + sl).val(res[1]);
            }

            console.clear();
                console.log(res);
            
            $("#price_item_saved_" + sl).val(res[1]);
            
            quantity_calculate(sl);

        },
        error: function () {
            alert("Request Failed, Please try again!");
        },
    });
    quantity_calculate(sl);
}

function viewpro(row) {
    var proid = $('.product_id_' + row).val();
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