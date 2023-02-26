<?php
$currency_new_id = $this->session->userdata('currency_new_id');
$target_con_rate = $position1 = $currency1 = 0;

if (empty($currency_new_id)) {
    $result = $cur_info = $this->db->select('*')
        ->from('currency_info')
        ->where('default_status', '1')
        ->get()
        ->row();
    $currency_new_id = $result->currency_id;
}


if (!empty($currency_new_id)) {
    $cur_info = $this->db->select('*')
        ->from('currency_info')
        ->where('currency_id', $currency_new_id)
        ->get()
        ->row();

    $target_con_rate = $cur_info->convertion_rate;
    $position1 = $cur_info->currency_position;
    $currency1 = $cur_info->currency_icon;
}

?>
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>/my-assets/zeynep.min.css" />
<!-- <link type="text/css" rel="stylesheet" href="https://raw.githack.com/hsynlms/zeynepjs/master/examples/css/base.css" /> -->
<style>
/* zeynepjs menu styles */
.zeynep {
  background-color: #ffffff;
  color: #404143;
  width: 295px;
}

.zeynep ul {
  list-style-type: none;
  padding: 0;
  padding-left: 20px;
  -webkit-overflow-scrolling: touch;
}
.zeynep ul > li {
  display: block;
}

.zeynep ul > li > a {
  color: inherit;
  display: block;
  font-size: 14px;
  font-weight: bold;
  padding: 18px 20px;
  text-decoration: none;
  transition: all 150ms;
}
.zeynep ul > li > a:hover {
  background-color: #efefef;
  border-radius: 3px;
}

.zeynep ul > li:not(:last-child) > a {
  border-bottom: 1px solid #efefef;
}

.zeynep ul > li.has-submenu > a {
  background-image: url("../my-assets/image/submenu-arrow.svg");
  background-position: right 20px center;
  background-repeat: no-repeat;
  background-size: 8px 14px;
}

.zeynep ul > li.has-submenu > a:hover {
  background-image: url("../my-assets/image/submenu-arrow-active.svg");
}

/* zeynepjs submenu styles */
.zeynep .submenu {
  background-color: #ffffff;
  left: 295px;
}

.zeynep .submenu-header {
  background-image: url("../my-assets/image/menu-back.svg");
  background-position: left 20px center;
  background-repeat: no-repeat;
  background-size: 8px 14px;
  border-bottom: solid 1px #efefef;
  cursor: pointer;
  position: relative;
}

.zeynep .submenu-header > a {
  color: inherit;
  display: block;
  font-size: 14px;
  font-weight: bold;
  padding: 18px 20px;
  padding-left: 40px;
  text-decoration: none;
}

.zeynep .submenu-header > a:before {
  background-image: url("../my-assets/image/submenu-arrow.svg");
  background-position: right 20px center;
  background-repeat: no-repeat;
  background-size: 8px 14px;
  content: "";
  height: 100%;
  left: 26px;
  position: absolute;
  top: 0;
  transform: rotate(-180deg);
  width: 20px;
}

.zeynep .submenu > label {
  color: #e77691;
  display: block;
  font-size: 13px;
  font-weight: bold;
  margin-bottom: 8px;
  margin-top: 19px;
  opacity: .5;
  padding-left: 40px;
  width: 100%;
}

</style>

<link type="text/css" rel="stylesheet" href="https://raw.githack.com/hsynlms/zeynepjs/master/examples/css/left.css" />
<script src="<?php echo base_url();?>/my-assets/zeynep.min.js"></script>
<!--Topbar-->
<div class="topbar topbar-bg color5">
    <div class="container">
        <div class="topbar-text text-nowrap d-none d-md-flex align-items-center">
            <i data-feather="headphones" class="mr-2"></i>
            <span class="mr-1"><?php echo display('have_a_question') ?> <?php echo display('call_us') ?></span>
            <a class="topbar-link"
                href="tel:<?php echo html_escape($company_info[0]['mob2']) ?>"><?php echo html_escape($company_info[0]['mob2']) ?></a>
        </div>
        <div class="d-flex justify-content-between justify-content-md-end w-100">
            <a class="topbar-link d-flex align-items-center" style="display: none !important;" href="#" data-toggle="modal" data-target="#trackingModal">
                <i data-feather="user" class="mr-2"></i><?php echo display('track_my_order') ?></a> &nbsp;
            <?php
            if ($this->session->userdata('customer_name')) { ?>
            <div class="topbar-text dropdown disable-autohide ml-3">
                <a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                    <i data-feather="user" class="mr-2"></i>
                    <?php echo ucwords($this->session->userdata('customer_name')) ?> </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-item">
                        <a
                            href="<?php echo base_url('customer/customer_dashboard') ?>"><?php echo display('dashboard') ?></a>
                    </li>
                    <li class="dropdown-item">
                        <a href="<?php echo base_url('logout') ?>"><?php echo display('logout') ?></a>
                    </li>
                </ul>
            </div>
            <?php } else { ?>
            <a class="topbar-link d-flex align-items-center" href="#" data-toggle="modal" data-target="#loginModal">
                <i data-feather="user" class="mr-2"></i><?php echo display('signin') ?></a>
            <?php } ?>
            <div class="topbar-text dropdown disable-autohide ml-3">
                <a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                    <?php
                    if (!empty($this->session->userdata('language'))) {
                        $language_id = $this->session->userdata('language');
                    } else {
                        $language_id = 'english';
                    }
                    // var_dump($language_id);
                    ?>

                    <?php echo display($language_id.'22'); ?> / <?php

                                                            $currency_new_id = $this->session->userdata('currency_new_id');
                                                            if ($currency_info) {
                                                                foreach ($currency_info as $currency) {
                                                                    if (!empty($currency_new_id)) {
                                                                        if ($currency->currency_id == $currency_new_id) {
                                                                            echo display($currency->currency_name);
                                                                        }
                                                                    } else {
                                                                        if ($currency->currency_id == $selected_cur_id) {
                                                                            echo display($currency->currency_name);
                                                                        }
                                                                    }
                                                                }
                                                            }

                                                            ?></a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-item">
                        <select id="change_currency" name="change_currency" class="custom-select custom-select-sm">

                            <?php

                            if ($currency_info) {
                                foreach ($currency_info as $currency) {
                            ?>
                            <option value="<?php echo $currency->currency_id ?>" <?php
                                                                                            if (!empty($currency_new_id)) {
                                                                                                if ($currency->currency_id == $currency_new_id) {
                                                                                                    echo "selected";
                                                                                                }
                                                                                            } else {
                                                                                                if ($currency->currency_id == $selected_cur_id) {
                                                                                                    echo "selected";
                                                                                                }
                                                                                            }
                                                                                            ?>>
                                <?php echo display($currency->currency_name) ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </li>
                    <?php
                    if (!empty($languages)) {
                        foreach ($languages as $lkey => $lvalue) {
                    ?>
                    <li><a class="dropdown-item pb-1" id="change_language" href="#"
                            data-lang="<?php echo $lkey; ?>"><?php echo display($lkey.'22'); ?></a></li>
                    <?php
                        }
                    }
                    ?>
                </ul>

                <a class="topbar-link dropdown-toggle" href="javascript:void(0)" id="" data-toggle="dropdown2" aria-expanded="false">
                    <?php
                    if (strpos(base_url(), 'Morocco') > -1) {
                        $language_id2 = 'Morocco';
                    } else {
                        $language_id2 = 'Egypt';
                    }
                    ?>

                    <?php echo display($language_id2); ?> </a>
                <ul id="dropdown2" class="dropdown-menu dropdown-menu-right">
                <li><a class="dropdown-item pb-1" href="https://itrplanet.com/Marco/"><?php echo display('Egypt');?></a></li>
                <li><a class="dropdown-item pb-1" href="https://itrplanet.com/Morocco/Marco"><?php echo display('Morocco');?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--Navbar-->
<div class="navbar-sticky border-bottom">
    <div class="navbar navbar-expand-lg navbar-light color1">
        <div class="container">
            <a class="navbar-brand d-none d-sm-block mr-3 flex-shrink-0" href="<?php echo base_url() ?>">
                <img width="220" src="<?php if (isset($Web_settings[0]['logo'])) {
                                            echo base_url() . $Web_settings[0]['logo'];
                                        } ?>" alt="Cartzilla" />
            </a>
            <a class="navbar-brand d-sm-none mr-2" href="<?php echo base_url() ?>">
                <img width="100" src="<?php if (isset($Web_settings[0]['logo'])) {
                                            echo base_url() . $Web_settings[0]['logo'];
                                        } ?>" alt="" />
            </a>
            <!-- Search-->
            <div class="main-search input-group-overlay d-none d-lg-block mx-4 ui-widget">
                <?php echo form_open('category_product_search', array('method' => 'GET')) ?>
                <div>
                    <div class="input-group-prepend-overlay">
                        <span class="input-group-text"><i data-feather="search"></i></span>
                    </div>
                    <input class="form-control search-input prepended-form-control appended-form-control"
                        name="product_name" id="search_product_item" type="text" placeholder="Search for products" style="padding-right: 40px;" />
                    <div class="input-group-append-overlay">
                        <button type="submit" class="btn btn-warning search_btn color4 color46 text-white" style="border-radius: 6px;"><span class="lnr
                        lnr-magnifier" ></span><?php echo display('search'); ?>
                        </button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>


            <!-- Toolbar-->
            <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center">
                <script>
                    $(document).ready(function() {
                        var zeynep = $('.zeynep').zeynep({
        opened: function () {
        console.log('the side menu is opened')
        }
    })

    // dynamically bind 'closing' event
    zeynep.on('closing', function () {
        console.log('this event is dynamically binded')
    })

    // handle zeynepjs overlay click
    $('.zeynep-overlay').on('click', function () {
        zeynep.close()
    })

    // open zeynepjs side menu
    $('.btn-open').on('click', function () {
        zeynep.open()
    })

                    });
                </script>
                <button class="navbar-toggler btn-open" type="button">
                    <i data-feather="menu"></i>
                </button>
                <a class="navbar-tool navbar-stuck-toggler" href="#">
                    <span class="navbar-tool-tooltip">Expand menu</span>
                    <div class="navbar-tool-icon-box"><i data-feather="grid" class="navbar-tool-icon"></i></div>
                </a>

                <div class="dropdown ml-3" id="tab_up_comparison">
                    <div class="navbar-tool dropdown-toggle" data-toggle="dropdown">
                        <a class="navbar-tool-icon-box bg-secondary" href="javascript:void(0)">
                            <span class="navbar-tool-label"><?php if ($this->session->userdata('comparison_ids')) {
                                                                echo count($this->session->userdata('comparison_ids'));
                                                            } else {
                                                                echo 0;
                                                            } ?>
                            </span>
                            <i class="fas fa-retweet navbar-tool-icon"></i>
                        </a>
                        <a class="navbar-tool-text" href="javascript:void(0)">
                            <small><?php echo display('product') ?></small>
                            <?php echo display('compare'); ?>
                        </a>
                    </div>
                    <?php
                    $total_comparison_ids = 0;
                    if ($this->session->userdata('comparison_ids')) {
                        $comparisons = $this->session->userdata('comparison_ids');
                        $total_comparison_ids = count($this->session->userdata('comparison_ids'));

                        $this->db->select('a.*, pr.product_price as whole_price');
                        $this->db->from('product_information a');
                        $this->db->join('pricing_types_product pr', 'pr.product_id = a.product_id AND pr.pri_type_id = 1', 'left');
                        $this->db->where_in('a.product_id', $comparisons);
                        $query = $this->db->get();
                        $comparison_products = $query->result();
                    ?>
                    <!-- Comparison dropdown-->
                    <div
                        class="comparison-dropdown dropdown-menu dropdown-menu-right shadow border-0 rounded px-3 pt-2 pb-3">
                        <?php foreach ($comparison_products as $comparison) :  ?>
                        <div class="dropdown-product-item media py-2">
                            <a class="dropdown-product-thumb overflow-hidden bg-gray d-block"
                                href="<?php echo base_url('product/' . remove_space($comparison->product_name) . '/' . $comparison->product_id) ?>">
                                <img src="<?php echo base_url() . $comparison->image_thumb ?>" alt="Product" />
                            </a>
                            <div class="dropdown-product-info media-body pl-3 pr-2">
                                <a class="dropdown-product-title cart-product-item fs-15"
                                    href="<?php echo base_url('product/' . remove_space($comparison->product_name) . '/' . $comparison->product_id) ?>">
                                    <?php echo html_escape($comparison->product_name); ?>
                                </a>
                                <span class="dropdown-product-details fs-14 text-muted" <?=empty($this->session->userdata('customer_id')) ? 'style="display: none;"' : '' ?>>
                                    <?php
                                            // $comparison_price = (($position == 0) ? $currency1 . ' ' . number_format($comparison->price, 2, '.', ',') : number_format($comparison->price, 2, '.', ',') . ' ' . $currency1);

                                            if (!empty($target_con_rate) && $target_con_rate > 1) {
                                                $pr = $comparison->whole_price * $target_con_rate;
                                            } else {
                                                $pr = $comparison->whole_price;
                                            }


                                            $comparison_price = (($position == 0) ? $currency1 . ' ' . number_format($pr, 2, '.', ',') : number_format($pr, 2, '.', ',') . ' ' . $currency1);
                                            echo $comparison_price;
                                            ?>

                                </span>
                            </div>
                            <span class="dropdown-product-remove align-self-center text-primary remove_cart_product"> <a
                                    href="#" class="delete_comparison_item"
                                    name="<?php echo $comparison->product_id ?>"><i class="ti-close"></i></a></span>
                        </div>
                        <?php endforeach; ?>

                        <div class="row no-gutters toolbar-dropdown-group">
                            <div class="col pl-2"><a class="btn btn-block btn-success color4 color46"
                                    href="<?php echo base_url('comparison') ?>"><?php echo display('compare') ?></a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>

                <div class="dropdown ml-3" id="wishlist_area">
                    <?php
                    $total_wishlist = 0;
                    if ($this->session->userdata('customer_name')) {
                        $customer_id = $this->session->userdata('customer_id');
                        $this->db->select('a.*,b.*, pr.product_price as whole_price');
                        $this->db->from('wishlist a');
                        $this->db->join('product_information b', 'a.product_id=b.product_id');
                        $this->db->join('pricing_types_product pr', 'pr.product_id = a.product_id AND pr.pri_type_id = 1', 'left');
                        $this->db->where('a.user_id', $customer_id);
                        $this->db->where('a.status', 1);
                        $query = $this->db->get();
                        $wishlists = $query->result();
                        $total_wishlist = count($wishlists);
                    }

                    ?>
                    <div class="navbar-tool dropdown-toggle" data-toggle="dropdown">
                        <a class="navbar-tool-icon-box bg-secondary" href="javascript:void(0)">
                            <span class="navbar-tool-label " id="wishlist_counter"><?php echo $total_wishlist; ?></span>
                            <i class="far fa-heart navbar-tool-icon"></i>
                        </a>
                        <a href="javascript:void(0)"
                            class="navbar-tool-text"><small><?php echo display('favorites') ?></small><?php echo display('wishlist') ?></a>
                    </div>

                    <?php if ($total_wishlist > 0) { ?>
                    <div class="cart-dropdown dropdown-menu dropdown-menu-right shadow border-0 rounded px-3 pt-2 pb-3">

                        <?php foreach ($wishlists as $wishlist) : ?>
                        <div class="dropdown-product-item media py-2"
                            id="wishlist_item_<?php echo $wishlist->product_id; ?>">
                            <a class="dropdown-product-thumb overflow-hidden bg-gray d-block"
                                href="<?php echo base_url() . 'product_details/' . remove_space($wishlist->product_name) . '/' . $wishlist->product_id ?>"><img
                                    src="<?php echo base_url() . $wishlist->image_thumb; ?>" alt="Product" /></a>
                            <div class="dropdown-product-info media-body pl-3 pr-2">
                                <a class="dropdown-product-title  cart-product-item fs-15"
                                    href="<?php echo base_url() . 'product_details/' . remove_space($wishlist->product_name) . '/' . $wishlist->product_id ?>"><?php echo html_escape($wishlist->product_name); ?></a>
                                <span
                                    class="dropdown-product-details fs-14 text-muted"><?php 
                                    if (!empty($target_con_rate) && $target_con_rate > 1) {
                                        $pr = $comparison->whole_price * $target_con_rate;
                                    } else {
                                        $pr = $comparison->whole_price;
                                    }
                                    
                                    echo html_escape($pr); 
                                    ?></span>
                            </div>
                            <span class="dropdown-product-remove align-self-center text-primary"> <a href="#"
                                    class="remove_wishlist" name="<?php echo  html_escape($wishlist->product_id); ?>"><i
                                        class="ti-close"></i></a></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php } ?>
                </div>
                <div class="dropdown ml-3" id="tab_up_cart">
                    <div class="navbar-tool dropdown-toggle" data-toggle="dropdown">
                        <a class="navbar-tool-icon-box bg-secondary" href="javascript:void(0)"><span
                                class="navbar-tool-label"><?php echo $this->cart->total_items() ?></span>
                            <i class="fas fa-cart-plus navbar-tool-icon"></i>
                        </a>
                        <a class="navbar-tool-text"
                            href="javascript:void(0)"><small><?php echo display('my_cart') ?></small>
                            <?php

                            $cart_total = $this->cart->total() * $target_con_rate;
                            $cart_total_amt = (($position == 0) ? $currency1 . ' ' . number_format($cart_total, 2, '.', ',') : number_format($cart_total, 2, '.', ',') . ' ' . $currency1);
                            echo $cart_total_amt;
                            ?></a>
                    </div>
                    <?php if ($this->cart->contents()) {
                    ?>
                    <!-- Cart dropdown-->
                    <div class="cart-dropdown dropdown-menu dropdown-menu-right shadow border-0 rounded px-3 pt-2 pb-3">
                        <?php foreach ($this->cart->contents() as $items) : ?>
                        <div class="dropdown-product-item media py-2">
                            <a class="dropdown-product-thumb overflow-hidden bg-gray d-block"
                                href="<?php echo base_url('product/' . remove_space($items['name']) . '/' . $items['product_id']) ?>"><img
                                    src="<?php echo base_url() . $items['options']['image'] ?>" alt="Product" /></a>
                            <div class="dropdown-product-info media-body pl-3 pr-2">
                                <a class="dropdown-product-title cart-product-item fs-15"
                                    href="<?php echo base_url('product/' . remove_space($items['name']) . '/' . $items['product_id']) ?>"><?php echo html_escape($items['name']); ?></a>
                                <span class="dropdown-product-details fs-14 text-muted"><?php echo $items['qty'] ?> x
                                    <?php echo (($position == 0) ? $currency1 . ' ' . $this->cart->format_number($items['price'] * $target_con_rate) : $this->cart->format_number($items['price'] * $target_con_rate) . ' ' . $currency1) ?></span>
                            </div>
                            <span class="dropdown-product-remove align-self-center text-primary remove_cart_product"> <a
                                    href="#" class="delete_cart_item" name="<?php echo $items['rowid'] ?>"><i
                                        class="ti-close"></i></a></span>
                        </div>
                        <?php endforeach; ?>


                        <div class="toolbar-dropdown-group d-flex justify-content-between font-weight-500 mb-2">
                            <div class="column"><span><?php echo display('total'); ?>:</span></div>
                            <div class="column"><span><?php echo $cart_total_amt; ?> &nbsp;</span></div>
                        </div>
                        <div class="row no-gutters toolbar-dropdown-group">
                            <div class="col pr-2"><a class="btn btn-block btn-primary color4 color46"
                                    href="<?php echo base_url('view_cart') ?>"><?php echo display('view_cart') ?></a>
                            </div>
                            <div class="col pl-2"><a class="btn btn-block btn-success color4 color46"
                                    href="<?php echo base_url('checkout') ?>"><?php echo display('checkout') ?></a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-expand-lg navbar-light navbar-stuck-menu py-0 color3">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <!--Navbar collapse header-->
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-8 collapse-brand">
                            <a href="<?php echo base_url(); ?>">
                                <?php if (isset($Web_settings[0]['logo'])) { ?>
                                <img src="<?php echo base_url() . $Web_settings[0]['logo']; ?>" alt="Logo"><?php } ?>
                            </a>
                        </div>
                        <div class="col-4 text-right">
                            <button type="button" class="collapse-close"><span></span><span></span></button>
                        </div>
                    </div>
                </div>
                <!-- Search-->
                <div class="input-group-overlay d-lg-none my-3">
                    <?php echo form_open('category_product_search', array('method' => 'GET')) ?>
                    <div class="input-group-prepend-overlay">
                        <span class="input-group-text"><i data-feather="search"></i></span>
                    </div>
                    <input class="form-control prepended-form-control" name="product_name" id="mobile_product_name"
                        type="text" placeholder="Search for products" />
                        <div class="input-group-append-overlay">
                        <button type="submit" class="btn btn-warning search_btn color4 color46 text-white" style="border-radius: 6px;"><span class="lnr
                        lnr-magnifier"></span><?php echo display('search');?>
                        </button>
                    </div>
                    <?php echo form_close() ?>
                </div>
                <!-- Departments menu-->
                <ul class="navbar-nav mega-nav departments-nav pr-lg-2 mr-lg-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle pl-0" href="#" data-toggle="dropdown"> <i data-feather="grid"
                                class="mr-2"></i><?php echo display('all_categories'); ?> </a>
                        <ul class="dropdown-menu">
                            <?php
                            if ($category_list) {
                                $i = 1;
                                $language = $Soft_settings[0]['language'];
                                foreach ($category_list as $parent_category) {
                                    if ($parent_category->category_id == 'DPCIHH462YEXA24' || $parent_category->category_id == '7OYMIICEX171GYC') continue;
                                    if ($_SESSION["language"] != $language) {
                                        $sub_parent_cat = $this->db->select('*,IF(c.trans_name IS NULL OR c.trans_name = "",a.category_name,c.trans_name) as category_name')
                                            ->from('product_category a')
                                            ->where('a.parent_category_id', $parent_category->category_id)
                                            ->where('status', '1')
                                            ->join('category_translation c', 'a.category_id = c.category_id', 'left')
                                            ->order_by('menu_pos')
                                            ->get()
                                            ->result();
                                    } else {
                                        $sub_parent_cat = $this->db->select('*')
                                            ->from('product_category')
                                            ->where('parent_category_id', $parent_category->category_id)
                                            ->where('status', '1')
                                            ->order_by('menu_pos')
                                            ->get()
                                            ->result();
                                    }
                                    if (10 == $i) {
                                        break;
                                    }
                            ?>
                            <li class="dropdown mega-dropdown">
                                <a class="dropdown-item  d-flex align-items-center"
                                    href="<?php echo base_url('category/p/' . remove_space($parent_category->category_name) . '/' . $parent_category->category_id) ?>">
                                    <span class=""><img src="<?php echo base_url() . $parent_category->cat_favicon ?>"
                                            height="15" width="16">&nbsp; </span>
                                    <div> <?php echo html_escape($parent_category->category_name) ?></div>
                                </a>
                                <?php if ($sub_parent_cat) { ?>
                                <div class="dropdown-menu p-0">

                                    <div class="d-flex flex-wrap flex-md-nowrap position-relative px-lg-2">
                                        <?php
                                                    $ci = 0;
                                                    foreach ($sub_parent_cat as $parent_cat) { 
                                                        
                                                        if ($parent_category->category_id == 'DPCIHH462YEXA24' || $parent_category->category_id == '7OYMIICEX171GYC') continue;
                                                        ?>
                                        <?php if ($ci % 2 == 0) { ?>
                                        <div class="mega-dropdown-column py-4 px-lg-3">
                                            <?php } ?>
                                            <div class="widget widget-links">
                                                <h6 class="mb-3"><a
                                                        href="<?php echo base_url('category/p/' . remove_space($parent_cat->category_name) . '/' . $parent_cat->category_id) ?>"><?php echo html_escape($parent_cat->category_name) ?></a>
                                                </h6>
                                                <ul class="widget-list">
                                                    <?php
                                                                    if ($_SESSION["language"] != $language) {
                                                                        $sub_cat = $this->db->select('a.*,IF(c.trans_name IS NULL OR c.trans_name = "",a.category_name,c.trans_name) as category_name')
                                                                            ->from('product_category a')
                                                                            ->where('a.parent_category_id', $parent_cat->category_id)
                                                                            ->where('a.status', '1')
                                                                            ->join('category_translation c', 'a.category_id = c.category_id', 'left')
                                                                            ->order_by('a.menu_pos')
                                                                            ->get()
                                                                            ->result();
                                                                    } else {
                                                                        $sub_cat = $this->db->select('*')
                                                                            ->from('product_category')
                                                                            ->where('parent_category_id', $parent_cat->category_id)
                                                                            ->where('status', '1')
                                                                            ->order_by('menu_pos')
                                                                            ->get()
                                                                            ->result();
                                                                    }
                                                                    if ($sub_cat) {
                                                                        foreach ($sub_cat as $s_p_cat) {
                                                                    ?>

                                                    <li class="widget-list-item pb-1"><a class="widget-list-link"
                                                            href="<?php echo base_url('category/p/' . remove_space($s_p_cat->category_name) . '/' . $s_p_cat->category_id) ?>"><?php echo html_escape($s_p_cat->category_name) ?></a>
                                                    </li>
                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                </ul>
                                            </div>
                                            <?php if ($ci % 2 == 1) { ?>
                                        </div>
                                        <?php } ?>
                                        <?php $ci++;
                                                    } ?>
                                    </div>
                                </div>
                                <?php } ?>
                            </li>
                            <?php
                                    $i++;
                                }
                            }
                            ?>

                        </ul>
                    </li>
                </ul>
                <!-- Primary menu-->
                <script>
                    $(document).ready(function() {
                        let dropdowns = document.querySelectorAll('.dropdown-toggle')
                        dropdowns.forEach((dd)=>{
                            dd.addEventListener('click', function (e) {
                                var el = this.nextElementSibling
                                el.style.display = el.style.display==='block'?'none':'block'
                            });
                        });
                    });
                </script>
                
                <ul class="navbar-nav">
                    <li class="nav-item <?php echo (($this->uri->segment(1) == '') ? 'active' : '') ?>">
                        <a class="nav-link" href="<?php echo base_url(); ?>"><?php echo display('home') ?> <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <?php
                    if (!empty($category_list)) {
                        foreach ($category_list as $v_category_list) {
                            if ($v_category_list->category_id == 'DPCIHH462YEXA24' || $v_category_list->category_id == '7OYMIICEX171GYC') continue;
                            if ($v_category_list->top_menu == 1) { ?>
                    <li
                        class="nav-item <?php echo (($this->uri->segment(4) == $v_category_list->category_id) ? 'active' : '') ?>" style="display: none;" >
                        <a class="nav-link"
                            href="<?php echo base_url('/category/p/' . remove_space($v_category_list->category_name) . '/' . $v_category_list->category_id) ?>"><?php echo
                                                                                                                                                                                        html_escape($v_category_list->category_name);
                                                                                                                                                                                        ?></a>
                    </li>
                    <?php }
                        }
                    } ?>
                    <li class="nav-item">
                    <div class="nav-link">
    <!-- <h1 class="mb-4">Multilevel Dropdown</h1> -->
    <div class="dropdown">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color: #000;"> <?=display('prods')?> </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <!-- <li><a class="dropdown-item" href="#"></a></li> -->
            <?php
                $fis = $this->db->query('select * from filter_items')->result();
                foreach ($fis as $fi) {
                    if ($fi->type_id != 1 || $fi->item_id == 1 || $fi->item_id == 35) continue;

                    ?>
<li class="dropdown dropend">
                <a class="dropdown-item dropdown-toggle" href="#" id="multilevelDropdownMenu1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $fi->item_name; ?></a>
                <ul class="dropdown-menu" aria-labelledby="multilevelDropdownMenu1">
                    <?php
                        $all_cats = $this->db->select('category_id')->from('filter_product')->where('filter_type_id', 1)->where('filter_item_id', $fi->item_id)->get()->result();
                        $cats = [];
                        foreach ($all_cats as $cc) {
                            // TODO fix
                            if (!isset($cats[$cc->category_id])) {
                                $cats[$cc->category_id] = $cc->category_id;
                            }
                        }

                        // var_dump($cats);

                        foreach ($cats as $k => $v) {
                            $c = $this->db->select('*')->from('product_category')->where('category_id', $k)->get()->row();
                            if ($c->category_name == 'ACCESSORIES' || $c->category_name == 'CLIP ON - BOX') continue;
                        ?>
                                    <li><a class="dropdown-item" href="<?php echo base_url() ?>/category/p/<?php echo $c->category_name; ?>/<?php echo $c->category_id; ?>?filter_item=<?php echo $fi->item_id ?>"><?php echo $c->category_name; ?></a></li>
                        <?php
                        }
                    ?>
                </ul>
            </li>
                    <?php
                }

?>
            
            <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
        </ul>
    </div>
</div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="<?php echo base_url(); ?>/contact_us"><?php echo display('cont') ?> <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="<?php echo base_url(); ?>/about_us"><?php echo display('abus') ?> <span
                                class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

                <div class="main-search2 input-group-overlay d-lg-none my-3">
                    <?php echo form_open('category_product_search', array('method' => 'GET')) ?>
                    <div class="input-group-prepend-overlay">
                        <span class="input-group-text"><i data-feather="search"></i></span>
                    </div>
                    <input class="form-control prepended-form-control" name="product_name" id="search_product_item2"
                        type="text" placeholder="Search for products" />
                        <div class="input-group-append-overlay">
                        <button type="submit" class="btn btn-warning search_btn color4 color46 text-white" style="border-radius: 6px;"><span class="lnr
                        lnr-magnifier"></span><?php echo display('search');?>
                        </button>
                    </div>
                    <?php echo form_close() ?>
                   
                </div>

<div class="modal register-modal" id="trackingModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="modal-body">
                <button type="button" class="close position-absolute" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="form-title_wrap mb-3" >
                    <h4 class="form-title mb-0"><?php echo display('track_my_order') ?></h4>
                </div>
                <!--Login Form-->
                <?php echo form_open('track_my_order'); ?>
                <div class="form-group">
                    <input type="email" class="form-control" name="order_email"
                        placeholder="<?php echo display('email') ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="order_number"
                        placeholder="<?php echo display('order_no') ?>" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block"><?php echo display('track_my_order') ?></button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>