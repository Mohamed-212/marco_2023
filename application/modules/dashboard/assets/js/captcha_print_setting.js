"use strict";
$("input[type='checkbox']").on("click", function(){
  if(this.checked){
      $("input[type='checkbox']").val(1);
  }else{
      $("input[type='checkbox']").val(0);

  }
})