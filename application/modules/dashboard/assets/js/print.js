// Print html element
function printDiv(divName) {
    'use strict';
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    document.body.style.marginTop = '0px';
    var css = document.createElement('style');
    css.type = 'text/css';
    
    var styles = '.dt-buttons.btn-group,#DataTables_Table_0_filter,.pagination {display: none !important;}';
    if (css.styleSheet) css.styleSheet.cssText = styles;
    else css.appendChild(document.createTextNode(styles));
    document.body.appendChild(css);
    // document.querySelector('.dt-buttons').css('display', 'none');

    window.print();
    document.body.innerHTML = originalContents;
}
// Print html div Page
function printPageDiv(divName) {
    'use strict';
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
//Barcode Print
function barcodePrintDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    w = window.open();

    w.document.write(printContents);
    w.document.write(
        '<script type="text/javascript">' +
            'window.onload = function() { window.print(); window.close(); };' +
            '</script>'
    );

    w.document.close(); // necessary for IE >= 10
    w.focus(); // necessary for IE >= 10

    return true;
}
