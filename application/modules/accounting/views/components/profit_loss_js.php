<?php
    $active_fy=$this->db->select('*')->from('acc_fiscal_year')->where('status',1)->get()->row();
    $start=explode('-', $active_fy->start_date);
    $s_y=$start[0];
    $s_m=$start[1];
    $s_d=$start[2];
    $end=explode('-', date('Y-m-d'));
    $e_y=$end[0];
    $e_m=$end[1];
    $e_d=$end[2];
?>
<script>
$(document).ready(function() {
    var csrf_test_name = $("#CSRF_TOKEN").val();
    var date = new Date(),
        y = date.getFullYear(),
        m = date.getMonth();
    var fSDate = new Date(<?php echo $s_y; ?>, <?php echo $s_m-1; ?>, <?php echo $s_d; ?>);
    var fEDate = new Date(<?php echo $e_y; ?>, <?php echo $e_m-1; ?>, <?php echo $e_d; ?>);
    $.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd',
        minDate: fSDate,
        maxDate: fEDate,
        showAnim: 'fadeIn',
    });
    $('#dtpDate1').datepicker();
    $('#dtpDate1').on('change', function() {
        var date = $('#dtpDate1').val();
        var end_date = $('#limitDate1').val();
        if (date > end_date) {
            alert('You exceeded the date range');
            $('#dtpDate1').val(end_date);
        }
    });
    $('#dtpDate2').datepicker();
    $('#dtpDate2').on('change', function() {
        var date = $('#dtpDate2').val();
        var end_date = $('#limitDate2').val();
        if (date > end_date) {
            alert('You exceeded the date range');
            $('#dtpDate2').val(end_date);
        }
    });
    $('#fy_id').on('change', function() {
        var fy_id = $('#fy_id').val();
        $.ajax({
            type: "post",
            url: base_url + 'accounting/Areports/get_fy_info',
            data: {
                csrf_test_name: csrf_test_name,
                fy_id: fy_id,
            },
            success: function(data) {
                var obj = jQuery.parseJSON(data);
                var date = new Date(),
                    y = date.getFullYear(),
                    m = date.getMonth();
                var fSDate = new Date(obj['s_y'], obj['s_m'] - 1, obj['s_d']);
                var fEDate = new Date(obj['e_y'], obj['e_m'] - 1, obj['e_d']);
                $.datepicker.setDefaults({
                    dateFormat: 'yy-mm-dd',
                    minDate: fSDate,
                    maxDate: fEDate,
                    showAnim: 'fadeIn',
                });
                $('#dtpDate1').datepicker();
                $('#dtpDate1').on('change', function() {
                    var date = $('#dtpDate1').val();
                    var end_date = $('#limitDate1').val();
                    if (date > end_date) {
                        alert('You exceeded the date range');
                        $('#dtpDate1').val(end_date);
                    }
                });
                $('#dtpDate2').datepicker();
                $('#dtpDate2').on('change', function() {
                    var date = $('#dtpDate2').val();
                    var end_date = $('#limitDate2').val();
                    if (date > end_date) {
                        alert('You exceeded the date range');
                        $('#dtpDate2').val(end_date);
                    }
                });
            }
        });
    });
});
</script>