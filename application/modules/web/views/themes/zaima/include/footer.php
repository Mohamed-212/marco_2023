<link rel="stylesheet" type="text/css" href="<?php echo THEME_URL . $theme . '/assets/css/footer.css' ?>">
<!--Newsletter-->
<div class="newsletter border-top py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="row align-items-center">
                    <div class="col-12 col-sm-auto mb-4 mb-lg-0">
                        <h5 class="newsletter-title fs-21 mb-0"><i data-feather="send" class="mr-2"></i><?php echo display('subscribe_for_news_and') . " " . display('offers') ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <?php echo form_open('#', array('class' => 'row m0 newsletter_form')); ?>
                <div class="input-group">
                    <input type="email" class="form-control" placeholder="<?php echo display('enter_your_email') ?>" required="" id="sub_email">
                    <div class="input-group-append ml-2">
                        <button class="btn btn-secondary fs-14 text-capitalize color4 color46" id="smt_btn" type="button"><?php echo display('subscribe') ?></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!--Footer-->
<?php
$blockitems = [1, 0, 0, 1];
$mob_footer_block = $Web_settings[0]['mob_footer_block'];
if (!empty($mob_footer_block)) {
    $blockitems = json_decode($mob_footer_block);
}
?>
<footer class="main-footer border-top color2">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4 col-xl-4 py-3 py-md-5 text-center text-md-left <?php echo ($blockitems[0] == '1' ? 'd-md-block' : 'd-none d-md-block') ?>">
                <div class="footer-about">
                    <div class="footer-logo mb-3">
                        <a href="<?php echo base_url() ?>"><img src="<?php echo base_url() . $Web_settings[0]['footer_logo'] ?>" class="img-fluid" alt="logo"></a>
                    </div>
                    <p><?php echo htmlspecialchars_decode($Web_settings[0]['footer_details']); ?></p>
                    <address>
                        <p><?php echo display('add22') ?>: <?php echo html_escape($company_info[0]['address']); ?></p>
                    </address>

                    <div class="contact_info">
                        <ul class="list-unstyled text-sm">
                            <li><?php echo display('mob2') ?>: <a href="tel:<?php echo html_escape($company_info[0]['mob2']); ?>"><?php echo html_escape($company_info[0]['mob2']); ?></a></li>
                            <li><?php echo display('mob3') ?>: <a href="https://wa.me/00201121119475"><?php echo html_escape($company_info[0]['mob3']); ?></a></li>
                            <li><?php echo display('email') ?>: <a href="mailto:<?php echo html_escape($company_info[0]['email']); ?>"><?php echo html_escape($company_info[0]['email']); ?></a></li>
                            <li><?php echo display('website') ?>: <a href="#"><?php echo html_escape($company_info[0]['website']); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>


            <?php
            /*$q = 1;
            if ($footer_block) {
                foreach ($footer_block as $footer) { ?>

                    <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 py-3 py-md-5 <?php echo ($blockitems[$q] == '1' ? 'd-md-block' : 'd-none d-md-block') ?>">
                        <div class="footer-box">
                            <?php echo htmlspecialchars_decode($footer->details); ?>
                        </div>
                    </div>
            <?php
                    $q++;
                }
            }*/
            ?>

            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 py-3 py-md-5 d-none d-md-block">
                <div class="footer-box">
                    <h4 class="link-title fs-16 mb-3 font-weight-600 position-relative footer-app-link"><?php echo display('Our Communities')?></h4>
                    <ul class="list-unstyled social-icon">

                        <li><a href="https://www.facebook.com/MarcoMaldiniEW">
                                <div class="icon-wrap fs-19 d-inline-block bg-primary text-white text-center inst"><i class="fab fa-facebook"></i></div>
                            </a><a href="https://www.facebook.com/MarcoMaldiniEW"><?php echo display('Facebook')?></a></li>

                        <li><a href="https://instagram.com/marcomaldiniew">
                                <div class="icon-wrap fs-19 d-inline-block bg-primary text-white text-center inst"><i class="fab fa-instagram"></i></div>
                            </a><a href="https://instagram.com/marcomaldiniew"><?php echo display('Instagram')?></a></li>

                        <li><a href="https://twitter.com/MarcoMaldiniEW">
                                <div class="icon-wrap fs-19 d-inline-block bg-primary text-white text-center inst"><i class="fab fa-twitter"></i></div>
                            </a><a href="https://twitter.com/MarcoMaldiniEW"><?php echo display('Twitter')?></a></li>

                        <!--<li xss=removed><a href=""></a></li>-->

                        <li><a href="https://youtube.com/@marcomaldini7455">
                                <div class="icon-wrap fs-19 d-inline-block bg-primary text-white text-center yt"><i class="fab fa-youtube-square"></i></div>
                            </a><a href="https://youtube.com/@marcomaldini7455"><?php echo display('Youtube')?></a></li>

                    </ul>
                </div>
            </div>

            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 py-3 py-md-5 d-none d-md-block">
                        <div class="footer-box">
                            <h4 class="link-title fs-16 mb-3 font-weight-600 position-relative footer-app-link"><?php echo display('Information')?></h4>
                        <ul class="footer-link list-unstyled menu mb-0">
                            <li class="mb-2"><a href="about_us" class="link d-block"><?php echo display('About Us')?></a></li>
                            <li class="mb-2"><a href="contact_us" class="link d-block"><?php echo display('Contact us')?></a></li>
                            <li class="mb-2"><a href="privacy_policy" class="link d-block"><?php echo display('Privacy Policy')?></a></li>
                            <li class="mb-2"><a href="terms_condition" class="link d-block"><?php echo display('Terms &amp; Conditions')?></a></li>
                            <li class="mb-2"><a href="#" class="link d-block" style="display: none;"><?php echo display('Track My Order')?></a></li>
                        </ul>                        </div>
                    </div>

        </div>
    </div>
</footer>
<!--Sub footer-->
<div class="sub-footer bg-white py-3 border-top color2">
    <div class="container">
        <div class="row justify-content-end align-items-center">
            <div class="col-md-12 text-center ">
                <div class="copy"><?php if ($Web_settings[0]['footer_text']) {
                                        echo 'developed by ';
                                    } ?><a href="http://212solutions.net/"> 212 Solutions</a></div>
            </div>
            <div class="col-md-6">
                <!-- <?php if (1 == $Web_settings[0]['pay_with_status']) {
                            if ($pay_withs) {
                        ?>
                        <ul class="list-unstyled text-center text-md-right mb-0">
                            <li class="list-inline-item">
                                <h6><?php echo display('pay_with') ?> :</h6>
                            </li>
                            <?php
                                foreach ($pay_withs as $pay_with) : ?>
                                <li class="list-inline-item">
                                    <a href="<?php echo html_escape($pay_with['link']); ?>" target="_blank">
                                        <img width="30" height="30" src="<?php echo base_url() ?>my-assets/image/pay_with/<?php echo html_escape($pay_with['image']); ?>" alt="#">
                                    </a>
                                </li>
                            <?php
                                endforeach;
                            ?>
                        </ul>
                <?php }
                        } ?> -->
            </div>
        </div>
    </div>
</div>

<div class="zeynep">
    <ul>
        <li>
            <a href="<?php echo base_url(); ?>"><?php echo display('home') ?></a>
        </li>

        <li class="has-submenu">
            <a href="#" data-submenu="stores"><?= display('prods') ?></a>

            <div id="stores" class="submenu">
                <div class="submenu-header">
                    <a href="#" data-submenu-close="stores"><?php echo display('back'); ?></a>
                </div>

                <label><?= display('prods') ?></label>

                <ul>
                    <?php
                    $fis = $this->db->query('select * from filter_items')->result();
                    foreach ($fis as $fi) {
                        if ($fi->type_id != 1 || $fi->item_id == 1 || $fi->item_id == 35) continue;

                    ?>
                        <li class="has-submenu">
                            <a href="#" data-submenu="storess<?php echo $fi->item_id; ?>"><?php echo $fi->item_name; ?></a>

                            <div id="storess<?php echo $fi->item_id; ?>" class="submenu">
                                <div class="submenu-header">
                                    <a href="#" data-submenu-close="storess<?php echo $fi->item_id; ?>"><?php echo display('back'); ?></a>
                                </div>

                                <label><?php echo $fi->item_name; ?></label>

                                <ul>
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
                                        <li>
                                            <a href="<?php echo base_url() ?>/category/p/<?php echo $c->category_name; ?>/<?php echo $c->category_id; ?>?filter_item=<?php echo $fi->item_id ?>"><?php echo $c->category_name; ?></a>
                                        </li>
                                    <?php
                                    }
                                    ?>

                                </ul>
                            </div>
                        </li>

                    <?php }
                    ?>

                    <!-- <li>
                        <a href="#">Mardin</a>
                    </li>

                    <li>
                        <a href="#">Amed</a>
                    </li> -->
                </ul>
            </div>
        </li>

        <li>
            <a href="<?php echo base_url(); ?>/contact_us"><?php echo display('cont') ?></a>
        </li>

        <li>
            <a href="<?php echo base_url(); ?>/about_us"><?php echo display('abus') ?></a>
        </li>
    </ul>
</div>

<div class="zeynep-overlay"></div>