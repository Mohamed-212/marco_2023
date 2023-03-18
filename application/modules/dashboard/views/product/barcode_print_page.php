<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!----==================================
    Printable Page
    Inline/internal css/js required here
=====================================-->
<script src="<?php echo MOD_URL . 'dashboard/assets/js/print.js'; ?>"></script>

<!-- Barcode list start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php if (empty($qr_image)) {
                    echo display('barcode');
                } else {
                    echo display('qr_code');
                } ?></h1>
            <small><?php if (empty($qr_image)) {
                    echo display('barcode');
                } else {
                    echo display('qr_code');
                } ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('product') ?></a></li>
                <li class="active"><?php if (empty($qr_image)) {
                        echo display('barcode');
                    } else {
                        echo display('qr_code');
                    } ?></li>
            </ol>
        </div>
    </section>

    <section class="content">
        <!-- Product Barcode and QR code -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php if (empty($qr_image)) {
                                    echo display('barcode');
                                } else {
                                    echo display('qr_code');
                                } ?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('dashboard/Cproduct/insert_product') ?>
                    <div class="panel-body">

                        <?php
                        if (!empty($product_id) || !empty($qr_image)) {
                            ?>
                            <div class="ft_center">
                                <a class="btn btn-info" href="#"
                                   onclick="barcodePrintDiv('printableArea')"><?php echo display('print') ?></a>
                                <a class="btn btn-danger"
                                   href="<?php echo base_url('dashboard/cproduct/manage_product'); ?>"><?php echo display('cancel') ?></a>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="table-responsive mt_10">
                            <?php
                            if (isset($product_id)) {
                                ?>
                                <div id="printableArea">
                                    <link href="<?php echo MOD_URL . 'dashboard/assets/css/print.css'; ?>"
                                          rel="stylesheet" type="text/css"/>
                                    <style>
                                        @media print {

                                            tr,
                                            td {
                                                border: none !important;
                                            }

                                            #table {
                                                margin: auto;
                                                width: 90%;
                                            }

                                            body {
                                                display: flex;
                                                align-items: center;
                                                margin: 0;
                                                justify-content: center;
                                                justify-items: center;
                                            }
                                        }
                                    </style>
                                    <table id="table" class="table table-bordered bcollapse">
                                        <?php
                                        $counter = 0;
                                        // for ($i=0; $i < 60 ; $i++) {
                                        // for ($i=0; $i < $open_quantity ; $i++) {
                                        for ($i = 0; $i < $stock; $i++) {?>
                                            <tr>
                                            <td valign="middle" class="td_text" style="display: block;border:0;height: 90px;padding: 0px">
                                                <div class="barcode-inner barcode_div"
                                                     style="width: 150px; text-align: center;margin:auto;">
                                                    <div class="product-name barcode_cominfo" style="margin: 0px;">
                                                        <table style="width: 100%;text-align: center;">
                                                            <tbody>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <p style="font-size: 10px;font-weight: 600;margin: 0px">
                                                                        {product_name_only}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr>

                                                                <td colspan="2">
                                                                    <p style="font-size: 8px;font-weight: 600;margin: 0px">
                                                                        {model_only}
                                                                    </p>

                                                                </td>
                                                            </tr>
                                                            <tr>

                                                                <td style="font-size: 8px;font-weight: 500;"><?= $size ?></td>
<!--                                                                --><?php //if ($is_sunglasses_category) : ?>
<!--                                                                    <td style="text-align: end;">Polarized</td>-->
<!--                                                                --><?php //endif ?>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- <span class="model-name pmodelname">{product_model}</span> -->
                                                    <?php
                                                    $year = date('Y');

                                                    ?>
                                                    <img src="<?php echo base_url('dashboard/cbarcode/barcode_generator/' . $product_id . '/' . $year) ?>"
                                                         class="img-responsive center-block pbarimag"
                                                         style="margin-left: 0; height:35;margin-right: 0;width: 100%" alt="">
                                                    <!-- <div class="product-name-details pname_details">{product_name}</div> -->
                                                    <!-- <div class="price price_text"><?php echo(($position == 0) ? "$currency {price}" : "{price} $currency") ?>
														<small class="excl_vat"><?php echo display('size') ?>: <?= $size ?></small>
													</div> -->
                                                </div>
                                            </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div id="printableArea">
                                    <link href="<?php echo MOD_URL . 'dashboard/assets/css/print.css'; ?>"
                                          rel="stylesheet" type="text/css"/>
                                    <table class="table table-bordered bcollapse">
                                        <?php
                                        $counter = 0;
                                        for ($i = 0; $i < 30; $i++) {
                                            ?>
                                            <?php if ($counter == 5) { ?>
                                                <tr>
                                                <?php $counter = 0; ?>
                                            <?php } ?>
                                            <td class="td_text">
                                                <div class="barcode-inner barcode_div">
                                                    <div class="product-name barcode_cominfo">
                                                        {company_name}
                                                    </div>
                                                    <span class="model-name pmodelname">{product_model}</span>
                                                    <img src="<?php echo base_url('my-assets/image/qr/{qr_image}') ?>"
                                                         class="img-responsive center-block pbarimag2" alt="">
                                                    <div class="product-name-details pname_details">{product_name}</div>
                                                    <div class="price price_text"><?php echo(($position == 0) ? "$currency {price}" : "{price} $currency") ?>
                                                        <small class="excl_vat"><?php echo display('excl_vat') ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <?php if ($counter == 5) { ?>
                                                </tr>
                                                <?php $counter = 0; ?>
                                            <?php } ?>
                                            <?php $counter++; ?>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Barcode list End -->