<?php include_once(dirname(__FILE__) . '/functions/functions.php'); ?>

<?php $this->load->view('adv/category_adv1', array('adv_position' => 1)); ?>

<div class="container py-4">
    <div class="row">
        <div id="ls55" class="<?php echo (!empty($after_search) ? 'col-md-3' : 'col-md-3') ?> d-none d-lg-block leftSidebar mb-3 pr-xl-4 col-lg-3">

            <div class="card d-lg-none">
                <div class="card-header row">
                    <h5 class="card-title col-sm-6" style="width: 50%;">
                        <i class="fas fa-filter"></i>
                        <?php echo display('filter');?>
                    </h5>
                    <div class="col-sm-6 text-right" style="width: 50%;">
                        <a class="btn btn-warning color4 color46 text-white cl44" href="#"><i class="fas fa-times"></i> <?php echo display('close') ?></a>
                    </div>
                </div>
            </div>

            <?php
            $sub_category = $this->Homes->get_sub_category($category_id);
            if (!empty($sub_category)) { ?>
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h2 class="mb-0 fs-17"><?php echo html_escape($category_name) ?></h2>
                        <i data-feather="sliders" class="card-header_icon"></i>
                    </div>

                    <div class="card-body">
                        <ul class="subcategories list-unstyled">
                            <?php
                            if ($sub_category) {
                                $i = 1;
                                foreach ($sub_category as $cat) {
                                    if ($i == 11) break;
                                    if ($cat->category_id == 'DPCIHH462YEXA24' || $cat->category_id == '7OYMIICEX171GYC') continue;
                                    // $no_of_pro = $this->Categories->select_total_sub_cat_no_of_pro($cat['category_id']);
                                    $no_of_pro = count($category_product);
                            ?>

                                    <li>
                                        <a href="<?php echo base_url('category/p/' . remove_space($cat['category_name']) . '/' . $cat['category_id']) ?>" class="d-flex align-items-center mb-2 text-black">
                                            <i data-feather="chevron-right" class="mr-1"></i>
                                            <span class="name"><?php echo html_escape($cat['category_name']) ?></span>
                                            <span class="total fs-12 text-black-50 ml-2">(<?php echo html_escape($no_of_pro); ?>)</span>
                                        </a>
                                    </li>
                            <?php
                                    $i++;
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>
            <div class="card mb-4" <?php echo empty($this->session->userdata('customer_id')) ? 'style="display: none;"' : '' ?>>
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h2 class="mb-0 fs-17"><?php echo display('price') ?></h2>
                    <i data-feather="sliders" class="card-header_icon"></i>
                </div>
                <div class="card-body">
                    <?php if ($isLogIn) : ?>
                        <?php echo form_open('', array('id' => 'priceForm')); ?>

                        <input type="text" class="price-range" value="price-range" name="price-range" />
                        <?php echo form_close(); ?>
                    <?php endif ?>
                </div>
            </div>
            <?php
            $brand_info = $this->Categories->select_sub_cat_brand_info($category_id);
            if ($brand_info) { ?>

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h2 class="mb-0 fs-17"><?php echo display('brand') ?></h2>
                        <i data-feather="sliders" class="card-header_icon"></i>
                    </div>
                    <div class="card-body">
                        <?php
                        $i = 1;
                        $query_string = '';
                        $query_string = $this->input->server('QUERY_STRING');
                        if ($query_string) {
                            $query_string = '?' . $this->input->server('QUERY_STRING');
                        } else {
                            $query_string = '';
                        }
                        $brand_url_ids = $this->uri->segment('3');
                        if ($brand_url_ids) {
                            $all_brand = (explode("--", $brand_url_ids));
                            $lastElementKey = count($all_brand);
                        } else {
                            $lastElementKey = 0;
                        }
                        $url = str_replace($_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
                        $qs = !empty($_SERVER['QUERY_STRING']) ? explode('&', $_SERVER['QUERY_STRING']) : [];
                        

                        // echo "<pre>";var_dump($qstr, $hasBrands);echo "</pre>";
                        
                        foreach ($brand_info as $brand_in) {
                            if ($brand_in['brand_id']) {
                                $q = [];
                        $qstr = '';
                        $hasBrands = false;
                        $allbrands = [];
                        foreach ($qs as $k){
                            $k = explode('=', $k);
                            if ($k[0] == 'per_page') continue;
                            if ($k[0] == 'br') {
                                $hasBrands = true;
                                $allbrands = explode(',', $k[1]);
                                continue;
                            }
                            $q[$k[0]] = $k[1];
                        }

                        foreach ($q as $key => $val) {
                            $qstr .= "$key=$val&";
                        }
                        $qstr = substr($qstr, 0, -1);
                                $br = '';
                                if ($hasBrands) {
                                    
                                    foreach ($qs as $kk){
                                        [$ky, $v] = explode('=', $kk);
                                        // var_dump($ky, $v);
                                        if ($ky == 'br') {
                                            $brq = explode(',', $v);
                                            
                                            $br .= $v;
                                            
                                            // echo "<pre>";var_dump($v);echo "</pre>";
                                                                                        // echo "<pre>";var_dump($brand_in['brand_id']);echo "</pre>";

                                            if (!in_array($brand_in['brand_id'], $brq)) {
                                                if (substr($br, strlen($br)-1) == ',') {
                                                    $br = substr($br, 0, -1);
                                                }
                                                $br .= ',' . $brand_in['brand_id'];
                                            } else {
                                                $br = str_replace(',' . $brand_in['brand_id'], '', $br);
                                                $br = str_replace($brand_in['brand_id'] . ',', '', $br);
                                                $br = str_replace($brand_in['brand_id'], '', $br);
                                                if (substr($br, strlen($br)-1) == ',') {
                                                    $br = substr($br, 0, -1);
                                                }
                                            }
                                        }
                                    }

                                    
                                } else {
                                    $br .= $brand_in['brand_id'];
                                }
                                $qstr .= !empty($br) && strlen($br) > 1 ?  '&br=' . $br : '';
                                // echo "<pre>";var_dump($url . $qstr , $br);echo "</pre>";

                        ?>
                                <div class="custom-control custom-checkbox mb-2">

                                <input id="brand<?php echo $i ?>" type="checkbox" class="brand_class custom-control-input" name="brand" value="<?=base_url($url . $qstr)?>" <?php if (in_array($brand_in['brand_id'], $allbrands)) {echo 'checked';}?> />
                                    <label class="custom-control-label" for="brand<?php echo $i ?>">
                                        <?php echo html_escape($brand_in['brand_name']) ?><span class="count text-muted fs-12 ml-1"></span>
                                    </label>
                            </div>
                                
                        <?php
                                $i++;
                            }
                        }
                        ?>
                    </div>
                </div>
            <?php } ?>





            <?php if (!empty($filter_types)) {
                $k = 1;
                $prev_filter_item = $this->input->get('filter_item', TRUE);
                $filter_price = $this->input->get('price', TRUE);
                foreach ($filter_types as  $filter_type) { 
                        // if ($filter_type)
                    ?>
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h2 class="mb-0 fs-17"><?php echo html_escape($filter_type['fil_type_name']) ?></h2>
                            <i data-feather="sliders" class="card-header_icon"></i>
                        </div>
                        <div class="card-body">

                            <?php
                            $filter_items = $this->db->select('*')->from('filter_items')->where('type_id', $filter_type['fil_type_id'])->get()->result();

                            $j = 1;
                            foreach ($filter_items as  $filter_item) {

                                if ($filter_item->item_name == 'Default') {
                                    continue;
                                }

                                $checked = '';
                                $st_ar = explode('--', $prev_filter_item);
                                if (in_array($filter_item->item_id, $st_ar)) {
                                    $checked = 'checked';
                                }

                                if (!empty($prev_filter_item)) {

                                    $prev_arr = explode('--', $prev_filter_item);
                                    $prev_arr[] = $filter_item->item_id;

                                    if ($checked == 'checked') {
                                        $prev_arr = array_diff($prev_arr, array($filter_item->item_id));
                                    }
                                    $filter_string = implode('--', array_unique($prev_arr));
                                } else {
                                    $filter_string = $filter_item->item_id;
                                }
                                $qsting_arr = http_build_query(array(
                                    'price' => $filter_price,
                                    'filter_item' => $filter_string
                                ));

                                $full_url = current_url() . '?' . $qsting_arr;

                            ?>
                                <div class="custom-control custom-checkbox mb-2">
                                    <input id="filter_item_<?php echo $k . $j; ?>" type="checkbox" class="filter_item_class custom-control-input" name="filter_item" value="<?php echo $full_url; ?>" data_id="<?php echo $filter_item->item_id; ?>" <?php echo $checked; ?>>
                                    <label class="custom-control-label" for="filter_item_<?php echo $k . $j; ?>">
                                        <?php echo html_escape($filter_item->item_name) ?> <span class="count text-muted fs-12 ml-1"></span>
                                    </label>
                                </div>
                            <?php $j++;
                            } ?>
                        </div>
                    </div>
            <?php $k++;
                }
            } ?>




            <?php $this->load->view('adv/category_adv2', array('adv_position' => 3)); ?>
        </div>
        <div class="<?php echo (!empty($after_search) ? 'col-md-9' : 'col-md-9') ?> mainContent category-content">

            <div class="filter-row d-flex align-items-center justify-content-between mb-2">
                <div class="filter-title">
                    <?php if (!empty($after_search)) { ?>
                        <h1 class="fs-21 mb-0 d-inline-block">
                            <?php echo html_escape($total) . " " . display('search_items') . '"' . $keyword . '"';
                            ?>
                        </h1>
                    <?php } else { ?>
                        <h1 class="fs-21 mb-0 d-inline-block"><?php echo html_escape($category_name); ?></h1>
                        <span class="text-black-50">- <?php echo html_escape($total); ?>
                            <?php echo display('items') ?></span>
                    <?php } ?>
                </div>

                <a class="btn btn-warning color4 color46 text-white fil44 d-lg-none" href="#"><i class="fas fa-filter"></i> <?php echo display('filter') ?></a>

                <a class="btn btn-warning color4 color46 text-white" style="display: none;" href="<?php echo base_url() ?>"><i class="far fa-hand-point-left"></i> <?php echo display('back_to_home') ?></a>
            </div>
            <div class="row">
                <?php
                if (!empty($category_product)) {
                    foreach ($category_product as $product) {
                ?>

                        <div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
                            <div class="feature-card card mb-3">
                                <div class="card-body">
                                    <a href="<?php echo base_url('product/' . remove_space($product->product_name) . '/' . $product->product_id) ?>" class="product-img d-block">
                                        <?php if (@getimagesize($product->image_thumb) === false) { ?>
                                            <img data-src="<?php echo base_url() . '/my-assets/image/no-image.jpg' ?>" class="media-object img-fluid" alt="<?php echo html_escape($product->product_name) ?>">
                                        <?php } else { ?>
                                            <img class="img-fluid" data-src="<?php echo  base_url() . (!empty($product->image_thumb) ? $product->image_thumb : 'assets/img/icons/default.jpg') ?>" alt="<?php echo html_escape($product->product_name) ?>">
                                        <?php } ?>
                                    </a>
                                    <h3 class="product-name fs-15 font-weight-600 overflow-hidden mt-2">
                                        <a href="<?php echo base_url('product/' . remove_space($product->product_name) . '/' . $product->product_id) ?>" class="text-black"><?php
                                                                                                                                                                            $color_pos = strpos($product->product_name, $product->product_color);
                                                                                                                                                                            // var_dump($color_pos);

                                                                                                                                                                            echo html_escape($color_pos ? substr($product->product_name, 0, $color_pos-2) : $product->product_name);
                                                                                                                                                                            ?></a>
                                    </h3>
                                    <div class="star-rating">
                                        <?php
                                        $result = $this->db->select('IFNULL(SUM(rate),0) as t_rates, count(rate) as t_reviewer')
                                            ->from('product_review')
                                            ->where('product_id', $product->product_id)
                                            ->where('status', 1)
                                            ->get()
                                            ->row();
                                        $p_review = (!empty($result->t_reviewer) ? $result->t_rates / $result->t_reviewer : 0);
                                        for ($s = 1; $s <= 5; $s++) {

                                            if ($s <= floor($p_review)) {
                                                echo '<i class="fas fa-star"></i>';
                                            } else if ($s == ceil($p_review)) {
                                                echo '<i class="fas fa-star-half-alt"></i>';
                                            } else {
                                                echo '<i class="far fa-star"></i>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="product-price font-weight-bolder font-italic" <?=empty($this->session->userdata('customer_id')) ? 'style="display: none;"' : '' ?>>
                                        <?php
                                        if ($isLogIn) {
                                            if ($product->onsale == 1 && !empty($product->onsale_price)) {
                                                $price_val = $product->onsale_price * $target_con_rate;
                                            } else {
                                                // $price_val = $product->price * $target_con_rate;
                                                $price_val = $product->whole_price * $target_con_rate;
                                            }

                                            echo (($position1 == 0) ? $currency1 . number_format($price_val, 2, '.', ',') : number_format($price_val, 2, '.', ',') . $currency1) . ' / ' . display('unit');
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else {  ?>
                    <div class="col-md-12 text-center">
                        <h3 class='text-muted mt-3'><?php echo display('category_product_not_found'); ?></h3>
                    <?php } ?>
                    </div>
                    <div class="pt-2">
                        <!-- Pagination-->
                        <div class="pagination d-flex align-items-center">
                            <div class="column">

                                <?php echo htmlspecialchars_decode($links); ?>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('adv/category_adv1', array('adv_position' => 2)); ?>

<!-- End OF category Mobile -->
<input type="hidden" name="category_id" id="category_id" value="<?php echo html_escape($category_id) ?>">
<input type="hidden" name="query_string" id="query_string" value="<?php echo $this->input->server('QUERY_STRING'); ?>">
<input type="hidden" name="brand_url_ids" id="brand_url_ids" value="<?php echo $this->uri->segment('3') ?>">
</div>
<input type="hidden" name="price_min_value" id="price_min_value" value="<?php echo html_escape($min_value) ?>">
<input type="hidden" name="price_max_value" id="price_max_value" value="<?php echo (!empty($max_value) ? html_escape($max_value) : 10000) ?>">
<input type="hidden" name="from_price" id="from_price" value="<?php echo html_escape($from_price) ?>">
<input type="hidden" name="to_price" id="to_price" value="<?php echo html_escape($to_price) ?>">
<input type="hidden" name="default_currency_icon" id="default_currency_icon" value="<?php echo (!empty($default_currency_icon) ? html_escape($default_currency_icon) : $currency1) ?>">

<style>
    .full55 {
        width: 100%;
        height: 100%;
    }
</style>

<script>
    $(document).ready(function () {
        $('.fil44').click(function (e) {
            e.preventDefault();
            $('#ls55').removeClass('d-none').addClass('full55').addClass('col-sm-12').addClass('col-md-12');
        });

        $('.cl44').click(function (e) {
            e.preventDefault();
            $('#ls55').addClass('d-none');
        });
    });
</script>