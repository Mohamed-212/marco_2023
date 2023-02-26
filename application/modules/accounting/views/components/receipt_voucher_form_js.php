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
    $('#date').datepicker();
    $('#date').on('change', function() {
        var date = $('#date').val();
        var end_date = $('#limitDate').val();
        if (date > end_date) {
            alert('You exceeded the date range');
            $('#date').val(end_date);
        }
    });
});
</script>