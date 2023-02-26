<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$CI = &get_instance();
$CI->load->model('Soft_settings');
$Soft_settings = $CI->Soft_settings->retrieve_setting_editdata();
?>
<script src="<?php echo MOD_URL . 'dashboard/assets/js/print.js'; ?>"></script>
<link href="<?php echo MOD_URL . 'dashboard/assets/css/print.css'; ?>" rel="stylesheet" type="text/css" />
<style type="text/css">
    * {
        font-family: 'Roboto', sans-serif;
    }

    table {
        width: 100%
    }

    @media print {
        table tbody tr:nth-child(even) td {
            background-color: #f9f9f9 !important;
            -webkit-print-color-adjust: exact;
        }

        .print-none {
            display: none;
        }

        .panel-body {
            font-size: 10px;
        }

        img:not(.show) {
            display: none;
        }

        .content-header,
        .logo,
        .panel-footer,
        .main-header,
        .main-sidebar {
            display: none;
        }

        .cominfo_div {
            display: inline-block;
            width: 30%;
        }

        .cus_div {
            display: inline-block;
            margin-left: 4%;
            width: 25%;
            margin-top: 6%
        }

        .qr_div {
            display: width: 10%;
        }

        .width_30p {
            width: 30%;
        }

        .width_70p {
            width: 70%;
        }

        .thead tr,
        .borderd {
            border: 2px solid orange !important;
            color: orange !important;
        }

        .colored>tbody>tr>th,
        .colored>tbody>tr>td {
            border-top: 1px solid orange;
            border-color: orange !important;
            color: orange !important;
        }

        .line-height {
            line-height: .5rem !important;
        }

        #toTop,
        footer,
        .btn.back-top,
        /* .hide-me, */
        .pace,
        .pace-activity,
        .alert {
            display: none !important;
        }

        div.divFooter {
            position: fixed;
            bottom: 0;
        }

        .empty-footer {
            height: 100px
        }

        .footerr {
            position: fixed;
            height: 100px;
        }

        .footerr {
            bottom: 35px;
        }
    }

    .thead tr,
    .borderd {
        border: 2px solid orange !important;
        color: orange !important;
    }

    .thead tr th {
        color: orange !important;
    }

    .colored>tbody>tr>th,
    .colored>tbody>tr>td {
        border-top: 1px solid orange;
        border-color: orange !important;
        color: orange !important;
    }

    .thead tr th {
        text-transform: uppercase;
    }

    .line-height {
        line-height: 1rem;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('stock_adjustment_details') ?></h1>
            <small><?php echo display('stock_adjustment') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('stock') ?></a></li>
                <li class="active"><?php echo display('manage_stock_adjustment') ?></li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Alert Message -->
        <?php
        $message = $this->session->userdata('message');
        if (isset($message)) {
        ?>
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $message ?>
            </div>
        <?php
            $this->session->unset_userdata('message');
        }
        $error_message = $this->session->userdata('error_message');
        if (isset($error_message)) {
        ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error_message ?>
            </div>
        <?php
            $this->session->unset_userdata('error_message');
        }
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                    <div id="printableArea">
                        <link href="<?php echo MOD_URL . 'dashboard/assets/css/print.css'; ?>" rel="stylesheet" type="text/css" />
                        <div class="panel-body">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="content" style="padding: 0 15px 10px;">
                                                <div class="row">
                                                    <div class="col-xs-12 p-0" style="background-image: url();">
                                                        <img class="show" src="<?= base_url() ?>/assets/img/header.png" style="width: 100%;height: auto;" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h2 class="text-center borderd">
                                                            <?= display('Inventory Voucher Adjustment') ?>
                                                        </h2>
                                                    </div>
                                                </div>
                                                <div style="padding: 0;">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <h3><?php echo display('inventory_voucher_no'); ?> : <?php echo html_escape($adj[0]->adjustment_id); ?></h3>
                                                            <div class="line-height" style=" margin-top: 15px;">
                                                                <p>
                                                                    <?php echo display('store_name'); ?> : <?php echo html_escape($adj[0]->store_name); ?>
                                                                </p>
                                                                <p>
                                                                    <?php echo display('inventory_voucher_date'); ?> : <?php echo date('d-m-Y', strtotime($adj[0]->created_at)) ?>
                                                                </p>
                                                                <p>
                                                                    <?php echo display('remark'); ?> : <?php echo html_escape($adj[0]->details) ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <div class="table-responsive m-b-20">
                                            <table class="table table-striped">
                                                <thead>

                                                    <tr class="borderd">
                                                        <th><?php echo display('sl') ?></th>
                                                        <th><?php echo display('item_code') ?></th>
                                                        <!-- <th><?php echo display('item_picture') ?></th> -->
                                                        <th><?php echo display('product_name') ?></th>
                                                        <th><?php echo display('variant') ?></th>
                                                        <th><?php echo display('unit') ?></th>
                                                        <th><?php echo display('available_quantity') ?></th>
                                                        <th><?php echo display('quantity') ?></th>
                                                        <th><?php echo display('inventory_difference') ?></th>
                                                        <th><?php echo display('unit_cost_price') ?></th>
                                                        <th><?php echo display('unit_sale_price') ?></th>
                                                        <th><?php echo display('total_unit_cost_price') ?></th>
                                                        <th><?php echo display('total_unit_selling_price') ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (!empty($adjustment_details)) {
                                                        $total_cost_price = $total_selling_price = 0;
                                                        foreach ($adjustment_details as $key => $details) {
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $key + 1 ?></td>
                                                                <td><?php echo html_escape($details['product_id']); ?></td>
                                                                <!-- <td><img src="<?php echo  base_url() . (!empty(html_escape($details['image_thumb'])) ? $details['image_thumb'] : 'assets/img/icons/default.jpg') ?>" width="50" height="50"></td> -->
                                                                <td><strong><?php echo html_escape($details['product_name']); ?> -
                                                                        (<?php echo html_escape($details['product_model']); ?>)</strong>
                                                                </td>
                                                                <td>
                                                                    <?php echo html_escape($details['variant_name']);
                                                                    if (!empty($details['variant_color'])) {
                                                                        echo ', ' . $details['variant_color'];
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><?php echo html_escape($details['unit_short_name']); ?></td>
                                                                <td><?php echo html_escape($details['previous_quantity']); ?></td>
                                                                <td>
                                                                    <?php
                                                                    if ($details['adjustment_type'] == 'increase') {
                                                                        echo ($details['previous_quantity'] + ($details['adjustment_quantity']));
                                                                    } else {
                                                                        echo ($details['previous_quantity'] - ($details['adjustment_quantity']));
                                                                    }
                                                                    ?>

                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    if ($details['adjustment_type'] == 'increase') {
                                                                        echo "<span class='text-success'>+" . ($details['adjustment_quantity']) . "</span>";
                                                                    } else {
                                                                        echo "<span class='text-danger'>-" . ($details['adjustment_quantity']) . "</span>";
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><?php echo html_escape($details['supplier_price']); ?></td>
                                                                <td><?php echo html_escape($details['price']); ?></td>
                                                                <td><?php $total_cost_price += ($details['supplier_price'] * $details['adjustment_quantity']);
                                                                    echo $details['supplier_price'] * $details['adjustment_quantity']; ?>
                                                                </td>
                                                                <td><?php $total_selling_price += ($details['price'] * $details['adjustment_quantity']);
                                                                    echo $details['price'] * $details['adjustment_quantity']; ?>
                                                                </td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="10"></td>
                                                        <td><?php echo html_escape($total_cost_price); ?></td>
                                                        <td><?php echo html_escape($total_selling_price); ?></td>
                                                    </tr>
                                                </tfoot>

                                            </table>
                                        </div>
                                    </tr>
                                    <tr>
                                        <td colspan="12">
                                            <div class="row" style="margin-top: 50px;">
                                                <div class="col-sm-6 text-center"><strong style="border-top:1px solid #000"><?= display('Inventory Voucher Adjustment') ?>:</strong></div>

                                            </div>
                                            <div class="row" style="margin-top: 50px;">
                                                <div class="col-sm-6 text-center"><strong style="border-top:1px solid #000"><?= display('warehouse manager signature') ?> :</strong></div>
                                            </div>
                                            <div class="row" style="margin-top: 50px;">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-6 text-center"><strong style="border-top:1px solid #000"><?= display('Signature of the Chief Financial Officer') ?> :</strong></div>
                                            </div>
                                            <div class="row" style="margin-top: 50px;">
                                                <div class="col-sm-6 text-center"><strong style="border-top:1px solid #000"><?= display('Signature of the accountant') ?> :</strong></div>
                                                <div class="col-sm-6 text-center"><strong style="border-top:1px solid #000"><?= display('Signature of the Director General') ?> :</strong></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <div class="empty-footer"></div>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="footerr row position-relative">
                                <div class="col-xs-12 divFoote" style="background-image: url();">
                                    <img class="show" src="<?= base_url() ?>/assets/img/footer.png" style="width: 100%;height: auto;" />
                                </div>
                            </div>

                            <div class="row">

                            </div>
                            <hr>


                        </div>


                    </div>

                    <div class="panel-footer text-left">
                        <a class="btn btn-danger" href="<?php echo base_url('Cstock_adjustment/manage_stock_adjustment'); ?>"><?php echo display('cancel') ?></a>
                        <a class="btn btn-info" href="#" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->