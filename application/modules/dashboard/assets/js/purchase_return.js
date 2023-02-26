"use strict";
$(".variant_id").prop("readonly", true);
$(".product_quantity").on("keyup", function () {
  var qualtity = $(this).val();
  var row = $(this).attr("data-row");
  var rate = $(this)
    .parent()
    .parent()
    .find("#rate_" + row)
    .find("input")
    .val();
  var totalprice = qualtity * rate;
  $(this)
    .parent()
    .parent()
    .find("#total_" + row)
    .find("input")
    .val(totalprice);
});
$("#select_all").on("change", function () {
  var select_all_status = $("#select_all").prop("checked");
  if (select_all_status == true) {
    $(".checkboxx").prop("checked", true);
  } else {
    $(".checkboxx").prop("checked", false);
  }
});
