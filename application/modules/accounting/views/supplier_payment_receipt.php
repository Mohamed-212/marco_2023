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
            height: 120px
        }

        .footerr {
            position: fixed;
            height: 120px;
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
        .print-hide {
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
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('accounts') ?></h1>
            <small><?php echo display('chart_of_account') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('accounts') ?></a></li>
                <li class="active"><?php echo display('chart_of_account') ?></li>
            </ol>
        </div>
    </section>
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
        $validatio_error = validation_errors();
        if (($error_message || $validatio_error)) {
        ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error_message ?>
                <?php echo $validatio_error ?>
            </div>
        <?php
            $this->session->unset_userdata('error_message');
        }
        ?>

        <div class="row">
            <div class="col-sm-12">
                <table id="printableArea">
                    <tbody>
                        <table class="table " style="border: 0;" border="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2" style="padding: 0;border: 0;">
                                        <div class="" style="width: 100%">
                                            <img class="show" src="<?= base_url() ?>/assets/img/header.png" style="width: 100%;height: auto;" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center" style="text-align: center;border: 0;">
                                        <div class="" style="display: flex;align-items: center;justify-content: center;justify-items: center;">
                                            <div class="line-height col-sm-3" style="">
                                                <h3 class="text-center borderd">
                                                    <?= display('receipt_voucher') ?>
                                                </h3>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div style="text-align: center;display: flex;justify-content: end;">
                                            <div>
                                                <span class="company-txt">
                                                    <?php echo html_escape($company_info[0]['company_name']) ?>
                                                </span><br>
                                                <?php echo html_escape($company_info[0]['address']) ?><br>
                                                <?php echo html_escape($company_info[0]['mobile']) ?><br>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding-left: 30px;border: 0;padding-top: 0;padding-bottom: 2px;">
                                        <div class="">
                                            <b style="font-size: 125%;padding-bottom: 20px;"> <?php echo display('supplier_name') ?>:&nbsp;&nbsp; <?php echo  html_escape($supplier_info[0]['supplier_name']); ?></b>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding-left: 30px;border: 0;padding-top: 0;padding-bottom: 2px;">
                                        <div class="">
                                            <?php echo display('supplier_id') ?>:&nbsp;&nbsp; <?php echo  html_escape($supplier_info[0]['supplier_no']); ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php if ($supplier_info[0]['address']) { ?>
                                    <tr>
                                        <td colspan="2" style="padding-left: 30px;border: 0;padding-top: 0;padding-bottom: 2px;">
                                            <div class="">
                                                <?php echo display('supplier_address') ?>:&nbsp;&nbsp; <?php echo  html_escape($supplier_info[0]['address']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <?php if ($supplier_info[0]['mobile']) { ?>
                                    <tr>
                                        <td colspan="2" style="padding-left: 30px;border: 0;padding-top: 0;padding-bottom: 20px;">
                                            <div class="">
                                                <?php echo display('supplier_mobile') ?>:&nbsp;&nbsp; <?php echo  html_escape($supplier_info[0]['mobile']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>

                                <tr>
                                    <td colspan="2" style="padding-left: 30px;padding-top: 20px;">
                                        <div class="">
                                            <?php echo display('voucher_no') ?>:&nbsp;&nbsp; <?php echo html_escape($payment_info[0]['VNo']); ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding-left: 30px;">
                                        <div class="">
                                            <?php echo display('payment_type') ?>:&nbsp;&nbsp; <?= $payment['type'] == 1 ? display('cash_control_account') : display('bank_payment') ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding-left: 30px;">
                                        <div class="">
                                            <?php echo display('accounts_name') ?>:&nbsp;&nbsp; <?php echo html_escape($payment['account']); ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding-left: 30px;">
                                        <div class="">
                                            <?php echo display('amount') ?>:&nbsp;&nbsp; <span style=""><?php echo html_escape($payment_info[0]['Debit']); ?></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding-left: 30px;">
                                        <div class="">
                                            <?php echo display('date') ?>:&nbsp;&nbsp; <?php echo html_escape($print_only ? $data['VDate'] : date('Y-m-d')); ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding-left: 30px;">
                                        <div class="">
                                            <?php echo display('remark') ?>:&nbsp;&nbsp; <?php echo html_escape($data['Narration']); ?>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
            </div>
            <!-- <div class="col-sm-4">
                <div class="panel panel-bd">
                    <div id="printableArea">
                        <div class="panel-body">
                            <div bgcolor='#e4e4e4' text='#ff6633' link='#666666' vlink='#666666' alink='#ff6633' class="phdiv">
                                <table border="0" width="100%">
                                    <tr>
                                        <td>
                                            <table border="0" width="100%">
                                                <tr>
                                                    <td align="center">
                                                        <span class="company-txt">
                                                            <?php echo html_escape($company_info[0]['company_name']) ?>
                                                        </span><br>
                                                        <?php echo html_escape($company_info[0]['address']) ?><br>
                                                        <?php echo html_escape($company_info[0]['mobile']) ?><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <b><?php echo  html_escape($supplier_info[0]['supplier_name']); ?></b><br>
                                                        <?php if ($supplier_info[0]['address']) { ?>
                                                            <?php echo  html_escape($supplier_info[0]['address']); ?><br>
                                                        <?php } ?>
                                                        <?php if ($supplier_info[0]['mobile']) { ?>
                                                            <?php echo  html_escape($supplier_info[0]['mobile']); ?>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <nobr>
                                                            <date>
                                                                <?php echo  display('date') ?>:
                                                                <?php echo  html_escape($payment_info[0]['VDate']) ?>
                                                            </date>
                                                        </nobr>
                                                    </td>
                                                </tr>
                                                
                                            </table>
                                        </td>
                                    <tr>
                                        <td> <?php echo display('paid_by') ?>:
                                            <?php echo  $this->session->userdata('user_name'); ?>
                                            <div class="psigpart">
                                                <?php echo display('signature') ?>
                                            </div>
                                        </td>
                                    </tr>
                                    </tr>
                                    <tr>
                                        <td>Powered By:
                                            <a href="javascript:void(0)">
                                                <?php echo html_escape($company_info[0]['company_name']) ?>
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div> -->
        </div>
        <div class="panel-footer text-left">
            <a class="btn btn-danger" href="<?php echo base_url('accounting/supplier_payment'); ?>"><?php echo display('cancel') ?></a>
            <a class="btn btn-info" href="#" onclick="window.print()"><span class="fa fa-print"></span> <?php echo display('print') ?></a>
        </div>
    </section>
</div>