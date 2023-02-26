<?php include_once(dirname(__FILE__).'/functions/functions.php'); ?>
<?php
$CI =& get_instance();
$CI->load->model('dashboard/Themes');
$theme = $CI->Themes->get_theme();
?>
<link href="<?php echo MOD_URL.'web/views/themes/zaima/assets/css/custome.css'; ?>" rel="stylesheet">
<script src="<?php echo MOD_URL.'assembly_products/assets/js/jquery.ddslick.min.js'; ?>"></script>


<div class="container">
    <!--Breadcrumb-->
    <nav aria-label="breadcrumb" class="my-2">
        <ol class="breadcrumb d-inline-flex mb-0">
            <li class="breadcrumb-item align-items-center"><a href="<?php echo base_url() ?>"
                    class="d-flex align-items-center"><i data-feather="home"
                        class="mr-2"></i><?php echo display('home') ?></a></li>
            <li class="breadcrumb-item align-items-center"><a
                    href="<?php echo base_url('category/p/' . remove_space($category_name) . '/' . $category_id) ?>"
                    class="d-flex align-items-center"><?php echo html_escape($category_name); ?></a></li>
            <li class="breadcrumb-item align-items-center active" aria-current="page">
                <?php echo html_escape($product_name); ?></li>
        </ol>
    </nav>
</div>
<?php $this->load->view('adv/details_adv1', array('adv_position' => 1)); ?>

<div class="product-details-inner mb-5">
    <div class="container">
        <div class="product-header row no-gutters align-items-center border-bottom pb-2 mb-5">
            <div class="col-md-8">
                <h1 class="product-title fs-23 font-weight-400 mb-3"><?php echo html_escape($product_name) ?></h1>
                <ul class="entry-meta d-flex flex-wrap align-items-center font-weight-500 list-unstyled m-0">
                    <li class="meta-brand position-relative px-2 px-md-3"> <?php echo display('brand') ?>: <a
                            href="<?php echo base_url('brand_product/list/' . $brand_id) ?>"
                            class="meta-value"><?php echo html_escape($brand_name) ?></a></li>
                    <li class="position-relative px-2 px-md-3">
                        <div class="product-rating d-flex align-items-center">

                            <div class="star-rating mb-0 mr-1">
                                <?php
                                 $result = $this->db->select('IFNULL(SUM(rate),0) as t_rates, count(rate) as t_reviewer')
                                     ->from('product_review')
                                    ->where('product_id', $product_id)
                                    ->where('status', 1)
                                    ->get()
                                    ->row();
                                    $p_review = (!empty($result->t_reviewer)?$result->t_rates / $result->t_reviewer:0);
                                    for($s=1; $s<=5; $s++){
                                        if($s <= floor($p_review)) {
                                            echo '<i class="fas fa-star"></i>';
                                        } else if($s == ceil($p_review)) {
                                            echo '<i class="fas fa-star-half-alt"></i>';
                                        }else{
                                            echo '<i class="far fa-star"></i>';
                                        }
                                    }
                                ?>
                            </div>
                            <a href="#" class="review-link text-muted font-weight-400 fs-14">
                                (<span
                                    class="count"><?php echo (!empty($result->t_reviewer)?$result->t_reviewer:0); ?></span>
                                <?php echo display('rev22'); ?>)
                            </a>
                        </div>
                    </li>
                    <li class="meta-sku position-relative px-2 px-md-3"> <?php echo display('item_code') ?>: <span
                            class="meta-value"><?php echo html_escape($product_model); ?></span></li>
                </ul>
            </div>
            <div class="col-md-4 mt-4 mt-md-0">
                <div class="text-md-right d-flex justify-content-md-end">
                    <?php if(isset($web_settings[0]['social_share']) && !empty($web_settings[0]['social_share'])){ ?>
                    <!-- AddToAny BEGIN -->
                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                        <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                        <a class="a2a_button_facebook"></a>
                        <a class="a2a_button_whatsapp"></a>
                        <a class="a2a_button_twitter"></a>
                        <a class="a2a_button_linkedin"></a>
                        <a class="a2a_button_telegram"></a>
                        <a class="a2a_button_pinterest"></a>
                        <a class="a2a_button_skype"></a>
                        <a class="a2a_button_copy_link"></a>
                    </div>
                    <script async src="https://static.addtoany.com/menu/page.js"></script>
                    <?php } ?>
                </div>
                <!-- /.End of social link -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="wrapper">
                    <!-- Product Images & Alternates -->
                    <div class="product-images">
                        <div class="row">
                            <div class="col-md-2 d-none d-md-block d-lg-block">
                                <!-- Begin product thumb nav -->
                                <ul class="thumb-nav">
                                    <li><img src="<?php echo  base_url().(!empty($image_thumb)?$image_thumb:'assets/img/icons/default.jpg')?>"
                                            alt="<?php echo display('image') ?>"></li>
                                    <?php
                                        if (!empty($product_gallery_img)) {
                                            foreach ($product_gallery_img as $gallery) {
                                                ?>
                                    <li><img src="<?php echo  base_url().(!empty($gallery->image_url)?$gallery->image_url:'assets/img/icons/default.jpg')?>"
                                            alt="<?php echo display('image') ?>"></li>
                                    <?php
                                            }
                                        }
                                        ?>
                                </ul>
                                <!-- End product thumb nav -->
                            </div>
                            <div class="col-md-10">
                                <!-- Begin Product Images Slider -->
                                <div class="main-img-slider">
                                    <figure>
                                        <a href="<?php echo base_url() . $image_large_details; ?>"
                                            data-size="1400x1400">
                                            <img class="" src="<?php echo  base_url().(!empty($image_large_details)?$image_large_details:'assets/img/icons/default.jpg')?>"
                                                data-lazy="<?php echo base_url() . $image_large_details; ?>"
                                                data-zoom-image="<?php echo base_url() . $image_large_details; ?>"
                                                alt="<?php echo display('image') ?>" />
                                        </a>
                                    </figure>
                                    <?php
                                    if ($product_gallery_img) { foreach ($product_gallery_img as $gallery_tab_img) { ?>
                                    <figure>
                                        <a href="<?php echo base_url() . $gallery_tab_img->image_url ?>"
                                            data-size="1400x1400">
                                            <img class="" src="<?php echo base_url() . $gallery_tab_img->image_url ?>"
                                                data-lazy="<?php echo base_url() . $gallery_tab_img->image_url ?>"
                                                data-zoom-image="<?php echo base_url() . $gallery_tab_img->image_url ?>"
                                                alt="<?php echo display('image') ?>" />
                                        </a>
                                    </figure>
                                    <?php } } ?>
                                </div>
                                <!-- End Product Images Slider -->
                                <?php if ($video) { ?>
                                <div class="product-video-btn mx-3 my-3">
                                    <a class="popup-youtube d-flex align-items-center justify-content-center"
                                        href="<?php echo html_escape($video); ?>">
                                        <div
                                            class="product-video-icon bg-primary text-white d-flex align-items-center justify-content-center rounded-pill mr-2">
                                            <i data-feather="video"></i>
                                        </div>
                                        <span
                                            class="text-dark font-weight-500"><?php echo display('watch_video'); ?></span>
                                    </a>
                                </div>
                                <!-- /.End of product video button -->
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- End Product Images & Alternates -->
                    <!-- Begin Product Image Zoom -->
                    <!-- This should live at bottom of page before closing body tag So that it renders on top of all page elements. -->
                    <!-- Root element of PhotoSwipe. Must have class pswp. -->
                    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                        <!-- Background of PhotoSwipe. It's a separate element, as animating opacity is faster than rgba(). -->
                        <div class="pswp__bg"></div>
                        <!-- Slides wrapper with overflow:hidden. -->
                        <div class="pswp__scroll-wrap">
                            <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
                            <div class="pswp__container">
                                <!-- don't modify these 3 pswp__item elements, data is added later on -->
                                <div class="pswp__item"></div>
                                <div class="pswp__item"></div>
                                <div class="pswp__item"></div>
                            </div>
                            <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                            <div class="pswp__ui pswp__ui--hidden">
                                <div class="pswp__top-bar">
                                    <!--  Controls are self-explanatory. Order can be changed. -->
                                    <div class="pswp__counter"></div>
                                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                                    <button class="pswp__button pswp__button--share" title="Share"></button>
                                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                                    <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                                    <!-- element will get class pswp__preloader-active when preloader is running -->
                                    <div class="pswp__preloader">
                                        <div class="pswp__preloader__icn">
                                            <div class="pswp__preloader__cut">
                                                <div class="pswp__preloader__donut"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--  /.pswp__top-bar -->
                                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                    <div class="pswp__share-tooltip"></div>
                                </div>
                                <button class="pswp__button pswp__button--arrow--left"
                                    title="Previous (arrow left)"></button>
                                <button class="pswp__button pswp__button--arrow--right"
                                    title="Next (arrow right)"></button>

                                <div class="pswp__caption">
                                    <div class="pswp__caption__center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  End product zoom  -->
                </div>
                <!-- wrapper -->
            </div>
            <div class="col-md-6">
                <div class="product-summary-content pl-md-4">
                    <div class="product-price-summary">
                        <?php if ($onsale) { ?>

                        <ins class="fs-29 d-inline-block">
                            <span class="amount var_amount">
                                <?php

                            if ($target_con_rate > 1) {
                                $onsale_price = $onsale_price * $target_con_rate;
                                echo(($position1 == 0) ? $currency1 . " " . number_format($onsale_price, 2, '.', ',') : number_format($onsale_price, 2, '.', ',') . " " . $currency1);
                            }

                            if ($target_con_rate <= 1) {
                                $onsale_price = $onsale_price * $target_con_rate;
                                echo(($position1 == 0) ? $currency1 . " " . number_format($onsale_price, 2, '.', ',') : number_format($onsale_price, 2, '.', ',') . " " . $currency1);
                            }
                            ?>
                            </span>
                            <input type="hidden" id="price" name="price"
                                value="<?php echo html_escape($onsale_price) ?>">
                        </ins>
                        <del class="Price-discount fs-14 text-black-50 font-weight-600 pl-1 price_discount">
                            <span class="amount regular_price">
                                <?php echo(($position1 == 0) ? $currency1 . " " . number_format($price, 2, '.', ',') : number_format($price, 2, '.', ',') . " " . $currency1); ?>
                            </span>
                        </del>
                        <?php $save_amount =  ($price - $onsale_price);
                        if($save_amount > 0){
                         ?>
                        <span class="sale fs-14 font-weight-500 ml-1 price_discount">(-<span
                                class="save_perct"><?php echo ceil((($save_amount/$price)*100)) ?></span>%)</span>
                        <?php } ?>

                        <?php } else { ?>
                        <ins class="fs-29 d-inline-block">
                            <span class="amount var_amount">

                                <?php
                    if ($target_con_rate > 1) {
                        $price = $price * $target_con_rate;
                        echo(($position1 == 0) ? $currency1 . " " . number_format($price, 2, '.', ',') : number_format($price, 2, '.', ',') . " " . $currency1);
                    }

                    if ($target_con_rate <= 1) {
                        $price = $price * $target_con_rate;
                        echo(($position1 == 0) ? $currency1 . " " . number_format($price, 2, '.', ',') : number_format($price, 2, '.', ',') . " " . $currency1);
                    }
                    ?>
                            </span>
                            <input type="hidden" id="price" name="price" value="<?php echo html_escape($price) ?>">
                        </ins>
                        <?php }  ?>
                    </div>

                    <div class="product-meta pt-2 mt-2 mb-4">
                        <div class="posted-in mb-1">
                            <strong class="font-weight-500 mr-1"><?php echo display('category') ?>: </strong>
                            <a href=""><?php echo html_escape($category_name); ?></a>
                        </div>

                        <?php if (!empty($tag)) { ?>
                        <div class="tag-as">
                            <strong class="font-weight-500 mr-1"><?php echo display('tag') ?>: </strong>
                            <?php 
                            rtrim($tag, ',');
                            $tags = explode(',', $tag);
                            $i=1;
                            foreach ($tags as $tagval) {
                                echo (($i > 1)?',':''); $i++ ?>
                            <a href="javascript:void(0)" class="text-black-50"><?php echo html_escape($tagval); ?></a>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                    <?php echo form_open('assembly_products/front_assembly_products/add_to_cart', array('id' => 'assembly_cart_form')); ?>
                    <div class="assembly_product_area">
                        <?php $index = 0; 
                        if(!empty($assembled_products)){
                         $language = $Soft_settings[0]['language'];
                         foreach ($assembled_products as $assembled_product){
                            if($_SESSION["language"] != $language){
                                $this->db->select('a.*,IF(c.trans_name IS NULL OR c.trans_name = "",b.product_name,c.trans_name) as product_name,b.image_thumb,b.default_variant,b.price,b.onsale,b.onsale_price');
                                $this->db->from('assembly_products_details a');
                                $this->db->where('a.assembly_product_id', $assembled_product['id']);
                                $this->db->join('product_information b', 'b.product_id=a.product_id','left');
                                $this->db->join('product_translation c', 'b.product_id = c.product_id', 'left');
                                $results = $this->db->get()->result_array();
                            }else{
                                $this->db->select('a.*,b.product_name,b.image_thumb,b.default_variant,b.price,b.onsale,b.onsale_price');
                                $this->db->from('assembly_products_details a');
                                $this->db->where('a.assembly_product_id', $assembled_product['id']);
                                $this->db->join('product_information b', 'b.product_id=a.product_id','left');
                                $results = $this->db->get()->result_array();
                            }
                            $a_def_item_id = '';
                        ?>
                        <div class="row assembly-block mb-4">
                            <div class="col-md-12">
                                <strong><?php echo html_escape($assembled_product['assembly_title']); ?>
                                    <?php if($assembled_product['required'] == 1 ){ ?> <span
                                        class="text-danger">*</span><?php } ?></strong>
                                <p><?php echo html_escape($assembled_product['assembly_sub_title']); ?></p>
                            </div>
                            <div class="col-md-12">
                                <div class="assembly_item d-md-flex">
                                    <select name="assembled_item[<?php echo $index; ?>]" class="assembly_dropdown"
                                        id="assembly_dropdown_<?php echo $assembled_product['id']; ?>">

                                        <option value="0"
                                            data-imagesrc="<?php echo base_url('my-assets/image/product/default.jpg'); ?>"
                                            data-description="<?php echo (($position1 == 0) ? $currency1.'0,00' : '0.00'. $currency1); ?>">
                                            <strong><?php echo 'No, thanks. I don\'t need this' ?></strong>
                                        </option>
                                        <?php foreach($results as $result){
                                            $assem_price = (($position1 == 0) ? $currency1 . number_format($result['price'], 2, '.', ',') : number_format($result['price'], 2, '.', ',') . $currency1);
                                        ?>
                                        <option value="<?php echo $result['product_id']; ?>"
                                            <?php if($result['is_default'] == '1'){echo 'selected'; $a_def_item_id = $result['product_id'];} ?>
                                            data-imagesrc="<?php echo base_url().$result['image_thumb']; ?>"
                                            data-description="<?php echo $assem_price; ?>">
                                            <?php echo html_escape($result['product_name']); ?></option>

                                        <?php } ?>
                                    </select>
                                    <?php if($assembled_product['change_quantity'] == 1 ){ ?>
                                    <div class="num-block skin-2 ml-md-2 align-self-center">
                                        <div class="num-in d-flex bg-white border mr-2 my-1">
                                            <span class="minus position-relative dis areduced"
                                                data-aid="<?php echo $assembled_product['id']; ?>"></span>
                                            <input type="text" name="assm_qty[<?php echo $index; ?>]"
                                                id="assm_qty_<?php echo $assembled_product['id']; ?>"
                                                class="in-num text-center border-0 assemble_quantity"
                                                data-aid="<?php echo $assembled_product['id']; ?>" value="1"
                                                readonly="">
                                            <span class="plus position-relative aincrease"
                                                data-aid="<?php echo $assembled_product['id']; ?>"></span>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <input type="hidden" name="a_item_id[<?php echo $index; ?>]"
                                        id="a_item_id_<?php echo $assembled_product['id']; ?>" class="a_item_id"
                                        value="<?php echo $a_def_item_id; ?>">
                                    <input type="hidden" name="a_item_qty[<?php echo $index; ?>]"
                                        id="a_item_qty_<?php echo $assembled_product['id']; ?>" class="a_item_qty"
                                        value="1">
                                    <input type="hidden" name="a_item_price[<?php echo $index; ?>]"
                                        id="a_item_price_<?php echo $assembled_product['id']; ?>" class="a_item_price"
                                        value="0">
                                </div>
                            </div>
                        </div>


                        <?php 
                            $asmpdata = array(
                                    "assembled_product_id" => $assembled_product['id'],
                            );
                            $this->load->view('web/themes/zaima/components/assembly_details_js',$asmpdata); 
                        ?>
                        <?php $index++; } } ?>
                    </div>
                    <div class="cart-row d-flex align-items-center my-2">
                        <div class="num-block skin-2">
                            <div class="num-in d-flex bg-white border mr-2">
                                <span class="minus position-relative dis total_reduced"></span>
                                <input type="text" name="qty" id="assembly_total_qty"
                                    class="in-num text-center border-0 qty" value="1" readonly="">
                                <span class="plus position-relative total_increase"></span>
                            </div>
                        </div>
                        <button
                            class="btn btn-primary text-uppercase fs-12 font-weight-500 mr-2 acart-btn color4 color46"
                            type="submit"><?php echo display('add_to_cart') ?></button>
                        <input type="hidden" name="main_product_id" id="main_product_id"
                            value="<?php echo $product_id ?>">
                    </div>

                    <?php echo form_close(); ?>


                </div>
            </div>
        </div>
    </div>
</div>
<!-- Advertisement 2 -->
<?php $this->load->view('adv/details_adv1', array('adv_position' => 2)); ?>


<!-- Advertisement 3 -->
<?php $this->load->view('adv/details_adv1', array('adv_position' => 3)); ?>


<!--Related product-->
<?php if (!empty($best_sales_category)) { ?>
<div class="container py-5">
    <h3 class="mb-4 fs-21"><?php echo display('you_may_alo_be_interested_in')
    ?></h3>
    <div class="row">
        <?php 
        $bpro=1;
        foreach ($best_sales_category as $product) {
        if($bpro <= 12){
         ?>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
            <div class="deals-item-inner bg-white overflow-hidden border mb-3">
                <a
                    href="<?php echo base_url('product/' . remove_space($product->product_name) . '/' . $product->product_id) ?>">
                    <div class="item-image">
                        <img src="<?php echo  base_url().(!empty($product->image_thumb)?$product->image_thumb:'assets/img/icons/default.jpg')?>" class="img-fluid" alt="">
                    </div>
                    <div class="item-details position-relative">
                        <h3 class="item-details-title overflow-hidden font-weight-400 mt-2 mb-0 fs-13">
                            <?php echo html_escape($product->product_name) ?></h3>
                        <div class="star-rating">
                            <?php
                            $result = $this->db->select('IFNULL(SUM(rate),0) as t_rates, count(rate) as t_reviewer')
                            ->from('product_review')
                            ->where('product_id', $product->product_id)
                            ->where('status', 1)
                            ->get()
                            ->row();
                            $p_review = (!empty($result->t_reviewer)?$result->t_rates / $result->t_reviewer:0);
                            for($s=1; $s<=5; $s++){
                                if($s <= floor($p_review)) {
                                    echo '<i class="fas fa-star"></i>';
                                } else if($s == ceil($p_review)) {
                                    echo '<i class="fas fa-star-half-alt"></i>';
                                }else{
                                    echo '<i class="far fa-star"></i>';
                                }
                            }
                        ?>
                        </div>
                        <div class="product-price font-weight-bolder font-italic" <?=empty($this->session->userdata('customer_id')) ? 'style="display: none;"' : '' ?>>
                            <?php
                            if ($product->onsale == 1 && !empty($product->onsale_price)) {
                                $price_val = $product->onsale_price * $target_con_rate;
                            }else{
                                $price_val = $product->price * $target_con_rate;
                            }
                            echo  (($position1 == 0) ? $currency1 . number_format($price_val, 2, '.', ',') : number_format($price_val, 2, '.', ',') . $currency1); ?>
                            / <?php echo display('unit') ?>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <?php } else { break; }  ?>
        <?php $bpro++; } ?>
    </div>
</div>
<?php } ?>

<!-- Advertisement 4 -->
<?php $this->load->view('adv/details_adv1', array('adv_position' => 4)); ?>
<input type="hidden" id="assembly_product_<?php echo $product_id ?>" value="<?php echo $product_id ?>">
<input type="hidden" id="discount_<?php echo $product_id ?>" value="<?php echo $product_id ?>">
<input type="hidden" id="theme_url" value="<?php echo THEME_URL.$theme; ?>">
<input type="hidden" id="target_con_rate" value="<?php echo $target_con_rate; ?>">
<input type="hidden" id="position1" value="<?php echo $position1; ?>">
<input type="hidden" id="currency1" value="<?php echo $currency1; ?>">
<script src="<?php echo MOD_URL.'assembly_products/assets/js/front_assembly_products.js'; ?>"></script>