<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script src="<?php echo MOD_URL . 'dashboard/assets/js/print.js'; ?>"></script>
<link href="<?php echo MOD_URL . 'dashboard/assets/css/print.css'; ?>" rel="stylesheet" type="text/css" />
<style>
    @media print {

        img,
        .content-header,
        .alert,
        .main-header,
        .panel-heading.ui-sortable-handle,
        .footer-btns,
        footer,
        .footer,
        #toTop,
        footer,
        .btn.back-top,
        .hide-me,
        .pace,
        .pace-activity {
            display: none !important;
        }

        .panel {
            border: none !important;
        }

        table tr:nth-child(even) td {
            /* background-color: #f9f9f9 !important;
            -webkit-print-color-adjust: exact; */
        }

        .print-only {
            display: block !important;
        }
    }

    .print-only {
        display: none;
    }
</style>
<style type="text/css">
    * {
        font-family: 'Roboto', sans-serif;
    }

    @media print {
        table tr.has-bg {
            /* background-color: #f9f9f9 !important;
            -webkit-print-color-adjust: exact; */
        }

        .panel-body {
            /* font-size: 10px; */
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
        .borderd,
        .borderd td {
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
        .hide-me,
        .pace,
        .pace-activity {
            display: none;
        }

        div.divFooter {
            position: fixed;
            bottom: 0;
        }

        .empty-footer {
            height: 130px;
        }

        .footerr {
            position: fixed;
            height: 130px;
        }

        .footerr {
            bottom: 35px;
        }
    }

    .thead tr,
    .borderd,
    .borderd td,
    .borderd td {
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
<style>
    .payment_type+.select2,
    .account+.select2 {
        margin-top: 10px;
        width: 180px !important;
    }

    .account_no {
        width: 180px;
    }

    @media print {

        img,
        .content-header,
        .alert,
        .main-header,
        .panel-heading,
        .footer-btns,
        footer,
        .footer,
        #toTop,
        footer,
        .btn.back-top,
        .hide-me,
        .pace,
        .pace-activity,
        .print-hide,
        #btnPrint {
            display: none;
        }

        .hideme table,
        .hideme tr,
        .hideme td,
        .hideme th {
            border: none !important;
        }

        .hideme .table>tbody>tr>td,
        .hideme .table>tbody>tr>th,
        .hideme .table>tfoot>tr>td,
        .hideme .table>tfoot>tr>th,
        .hideme .table>thead>tr>td,
        .hideme .table>thead>tr>th {
            padding: 4px;
        }

        .hideme .form-group {
            margin-bottom: 5px;
        }

        #paid_amountt,
        #total-still {
            background-color: #811fdb47;
            background-color: #811fdb47 !important;
            -webkit-print-color-adjust: exact;
            /* font-weight: bold; */
            padding: 3px 5px;
            border-radius: 6px;
        }

        .panel-body.hideme {
            display: block !important;
        }
    }


    @media screen {
        .hideme {
            /* display: none; */
        }

        #paid_amountt,
        #total-still {
            background-color: #811fdb47;
            /* font-weight: bold; */
            padding: 3px 5px;
            border-radius: 6px;
        }
    }

    .table.inside>tbody>tr>td {
        word-break: break-word;
        max-width: 200px;
    }

    .table>thead>tr.borderd>th {
        color: orange !important;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('invoice_details') ?></h1>
            <small><?php echo display('invoice_details') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('invoice') ?></a></li>
                <li class="active"><?php echo display('invoice_details') ?></li>
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
                        <style type="text/css">
                            @media print {
                                .cominfo_div {
                                    display: inline-block;
                                    width: 66%;
                                }

                                .cus_div {
                                    display: inline-block;
                                    margin-left: 5px;
                                }

                                .width_30p {
                                    width: 30%;
                                }

                                .width_70p {
                                    width: 70%;
                                }
                            }
                        </style>
                        <div class="panel-body">
                            <div class="col-sm-12">
                                <table class="table " style="border: 0;" border="0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="padding: 0;border: 0;" colspan="2">
                                                <div class="" style="width: 100%">
                                                    <img class="show" src="<?= base_url() ?>/assets/img/header.png" style="width: 100%;height: auto;" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr style="border: none !important;">
                                            <td>
                                                <table class="table table-bordered table-striped table-hover inside" style="page-break-inside: auto;break-inside: auto;border: none !important;" >
                                                    <tbody>
                                                        <tr style="border: none !important;">
                                                            <td style="border: none !important;">
                                                                <span class="label label-success-outline m-r-15 p-10"><?php echo display('billing_from') ?></span>
                                                                <address class="mt_10">
                                                                    <strong>
                                                                        <?php echo html_escape($company_info[0]['company_name']); ?></strong><br>
                                                                    <?php echo html_escape($company_info[0]['address']); ?><br>
                                                                    <abbr><?php echo display('mobile') ?>:</abbr>
                                                                    <?php echo html_escape($company_info[0]['mobile']); ?><br>
                                                                    <abbr><?php echo display('email') ?>:</abbr>
                                                                    <?php echo html_escape($company_info[0]['email']); ?><br>
                                                                    <abbr><?php echo display('website') ?>:</abbr>
                                                                    <?php echo html_escape($company_info[0]['website']); ?>
                                                                </address>
                                                            </td>
                                                            <td style="border: none !important;">
                                                                <div style="text-align: end;">
                                                                    <h2 class="m-t-0"><?php echo display('purchase_order') ?></h2>
                                                                    <div><?php echo display('purchase_order') ?>:
                                                                        <strong><?php echo html_escape($pur_order_no); ?></strong>
                                                                    </div>
                                                                    <div class="m-b-15"><?php echo display('billing_date') ?>:
                                                                        <?php echo date('d-m-Y', strtotime($purchase_date)) ?></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr class="borderd">
                                                        <th><?php echo display('sl') ?></th>
                                                        <th><?php echo display('product_name') ?></th>
                                                        <th><?php echo display('size') ?></th>
                                                        <th><?php echo display('quantity') ?></th>
                                                        <th><?php echo display('rate') ?></th>
                                                        <th><?php echo display('ammount') ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $grand_total = 0;
                                                    if (!empty($po_details)) {
                                                        $i = 1;
                                                        foreach ($po_details as $invoice) {
                                                    ?>

                                                            <tr>
                                                                <td><?php echo $i++; ?></td>
                                                                <td><strong><?php echo html_escape($invoice['product_name']); ?> -
                                                                        (<?php echo html_escape($invoice['product_model']); ?>)</strong>
                                                                </td>
                                                                <td><?php
                                                                    echo html_escape($invoice['variant_name']);
                                                                    if (!empty($invoice['variant_color'])) {
                                                                        $cvarinfo = $this->db->select('variant_name')->from('variant')->where('variant_id', $invoice['variant_color'])->get()->row();
                                                                        if (!empty($cvarinfo)) {
                                                                            echo ', ' . $cvarinfo->variant_name;
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><?php
                                                                    if ($receive_status == '1') {
                                                                        $rc_quantity = $invoice['rc_quantity'] - $invoice['rt_quantity'];
                                                                    } else {
                                                                        $rc_quantity = $invoice['quantity'];
                                                                    }
                                                                    echo html_escape($rc_quantity);
                                                                    ?></td>
                                                                <td><?php
                                                                    if ($receive_status == '1') {
                                                                        echo (($position == 0) ? $currency . " " . $invoice['rc_rate'] : $invoice['rc_rate'] . " " . $currency);
                                                                    } else {
                                                                        echo (($position == 0) ? $currency . " " . $invoice['rate'] : $invoice['rate'] . " " . $currency);
                                                                    }
                                                                    ?></td>
                                                                <td><?php
                                                                    if ($receive_status == '1') {
                                                                        $pur_total_amount = $invoice['rc_total_amount'] - $invoice['rt_total_amount'];
                                                                    } else {
                                                                        $pur_total_amount = $invoice['total_amount'];
                                                                    }
                                                                    echo html_escape($pur_total_amount);
                                                                    $grand_total += $pur_total_amount;
                                                                    $total_discount = $total_purchase_dis;
                                                                    $total_vat = $total_purchase_vat;
                                                                    $grand_total2 = $grand_total - $total_discount + $total_vat;
                                                                    ?></td>
                                                            </tr>
                                                    <?php }
                                                    }
                                                    ?>
                                                    <tr class="borderd">
                                                        <!-- <td colspan="3">
                                                            <strong><?php echo htmlspecialchars_decode($purchase_details) ?></strong>
                                                        </td> -->
                                                        <!-- <td colspan="3" class="grand_total"><strong><?php echo display('total_dis') ?> -->
                                                
                                                        <td colspan="6" class="grand_total" style="text-align: end;">
                                                            <?php echo display('total_dis') ?>
                                                            :&nbsp;&nbsp;
                                                            <?php echo (($position == 0) ? $currency . " " . $total_discount : $total_discount . " " . $currency) ?>
                                                        </td>
                                                    </tr>

                                                    <tr class="borderd">
                                                        <!-- <td colspan="3">
                                                            <strong><?php echo htmlspecialchars_decode($purchase_details) ?></strong>
                                                        </td> -->
                                                        <!-- <td colspan="3" class="grand_total"></td> -->
                                                        <td colspan="6" class="grand_total" style="text-align: end;">
                                                            <strong style="color: orange !important;"><?php echo display('grand_total') ?>
                                                                :</strong>&nbsp;&nbsp;
                                                            <?php echo (($position == 0) ? $currency . " " . $grand_total2 : $grand_total2 . " " . $currency) ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6">
                                                            <strong><?php echo htmlspecialchars_decode($purchase_details) ?></strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
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
                                <div class="footerr row position-relative" style="margin: 0;">
                                    <div class="col-xs-12 divFoote" style="background-image: url();">
                                        <img class="show" src="<?= base_url() ?>/assets/img/footer.png" style="width: 100%;height: auto;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer text-left">
                        <?php if ($this->permission->check_label('manage_sale')->read()->access()) { ?>
                            <a class="btn btn-danger" href="<?php echo base_url('dashboard/Cpurchase/purchase_order'); ?>"><?php echo display('cancel') ?></a>
                        <?php } ?>
                        <a class="btn btn-info" href="#" onclick="printPageDiv('printableArea')"><span class="fa fa-print"></span>
                            <?php echo display('print') ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->