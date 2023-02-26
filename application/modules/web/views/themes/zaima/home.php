<?php include_once(dirname(__FILE__) . '/functions/functions.php'); ?>
<?php
$message = $this->session->userdata('message');
if (!empty($message)) {
?>
<link href="<?php echo MOD_URL . 'web/views/themes/zaima/assets/css/custome.css'; ?>" rel="stylesheet">
<div class="container py-2">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissable  mb-0">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $message ?>
            </div>
        </div>
    </div>
</div>
<?php
    $this->session->unset_userdata('message');
}
$error_message = $this->session->userdata('error_message');
$validation_errors = validation_errors();
if (!empty($error_message) || !empty($validation_errors)) {
?>
<div class="container py-2">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissable  mb-0">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error_message ?>
                <?php echo $validation_errors ?>
            </div>
        </div>
    </div>
</div>
<?php
    $this->session->unset_userdata('error_message');
}
?>

<?php $this->load->view('include/slider'); ?>

<?php
$total_block = 0;
if (!empty($block_list)) {
    foreach ($block_list as $block) {
        $this->load->view('adv/home_adv1', array('block' => $block));
        // translation part start
        $language = $Soft_settings[0]['language'];
        if ($_SESSION["language"] != $language) {
            $cat_pro = $this->db->select('a.*,b.category_id,IF(c.trans_name IS NULL OR c.trans_name = "",a.product_name,c.trans_name) as product_name,IF(d.trans_name IS NULL OR d.trans_name = "",b.category_name,d.trans_name) as category_name, pr.product_price as whole_price')
                ->from('product_information a')
                ->join('product_category b', 'a.category_id = b.category_id', 'left')
                ->where('a.category_id', $block['block_cat_id'])
                ->join('product_translation c', 'a.product_id = c.product_id', 'left')
                ->join('category_translation d', 'd.category_id = a.category_id', 'left')
                ->join('pricing_types_product pr', 'pr.product_id = a.product_id AND pr.pri_type_id = 1', 'left')
                ->where('a.category_id !=', 'DPCIHH462YEXA24')->where('a.category_id !=', '7OYMIICEX171GYC')
                ->order_by('a.product_id', 'random')
                ->limit(12)
                ->get()
                ->result();
        } else {
            $cat_pro = $this->db->select('a.*,b.category_name,b.category_id, pr.product_price as whole_price')
                ->from('product_information a')
                ->join('product_category b', 'a.category_id = b.category_id', 'left')
                ->join('pricing_types_product pr', 'pr.product_id = a.product_id AND pr.pri_type_id = 1', 'left')
                ->where('a.category_id', $block['block_cat_id'])
                ->where('a.category_id !=', 'DPCIHH462YEXA24')->where('a.category_id !=', '7OYMIICEX171GYC')
                ->order_by('a.product_id', 'random')
                ->limit(12)
                ->get()
                ->result();
        }
        // translation part end
        if ($cat_pro) {

            if ($block['block_style'] == '1') {
                include(dirname(__FILE__) . '/blocks/block_1.php');
            } else {
                include(dirname(__FILE__) . '/blocks/block_2.php');
            }
?>
<?php
        }
    }
    $total_block = count($block_list);
} ?>

<!-- Best Sale Products -->
<?php $this->load->view('adv/home_adv_last', array('blpos' => $total_block + 1)); ?>
<?php include_once(dirname(__FILE__) . '/blocks/block_best_seller.php'); ?>
<?php $this->load->view('adv/home_adv_last', array('blpos' => $total_block + 2)); ?>

<!--Brand logo content-->
<?php if ($brands) { ?>
<div class="container mt-1 mb-5">
    <div class="brand-logo owl-carousel owl-theme border-top border-bottom py-4 px-4">
        <?php foreach ($brands as $brand) { ?>
        <a style="min-height: 70px;" href="<?php echo base_url() . "brand_product/list/" . $brand['brand_id']; ?>"
            class="brand-logo_item d-block">
            <img style="min-height: 70px;" class="brand-logo_img"
                data-src="<?php echo  base_url() . (!empty($brand['brand_image']) ? $brand['brand_image'] : 'assets/img/icons/default.jpg') ?>"
                alt="<?php echo html_escape($brand['brand_name']) ?>">
        </a>
        <?php } ?>
    </div>
</div>
<?php } ?>