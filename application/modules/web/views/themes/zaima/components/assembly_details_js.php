<script type="text/javascript">
$('#assembly_dropdown_<?php echo $assembled_product_id; ?>').ddslick({
    width: '100%',
    imagePosition: "<?php echo ((!empty($lang_config) && ($lang_config['direction'] == 'rtl'))?'right':'left') ?>",
    background: "FFFFFF",
    onSelected: function(response) {
        $('#a_item_id_<?php echo $assembled_product_id; ?>').val(response
            .selectedData.value);
        $('#a_item_price_<?php echo $assembled_product_id; ?>').val(response
            .selectedData.description);
    }
});
</script>