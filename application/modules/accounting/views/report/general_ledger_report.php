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
    .table.inside > tbody > tr > td {
        word-break: break-word;
        max-width: 200px;
    }
    .table>thead>tr.borderd>th {
        color: orange !important;
    }
</style>
<script src="<?php

                use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Offset;

                echo MOD_URL . 'dashboard/assets/js/print.js'; ?>"></script>
<!-- Sales Report Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon"><i class="pe-7s-note2"></i></div>
        <div class="header-title">
            <h1><?php echo display('general_ledger') ?></h1>
            <small><?php echo display('general_ledger_form') ?></small>
            <ol class="breadcrumb">
                <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('accounts') ?></a></li>
                <li><a href="#"><?php echo display('account_reports') ?></a></li>
                <li class="active"><?php echo display('general_ledger') ?></li>
            </ol>
        </div>
    </section>
    <section class="content">
        <!-- General Ledger report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('general_ledger_report') ?> </h4>
                        </div>
                    </div>
                    <div class="panel-body" id="printableArea">
                        <div class="row">
                            <div class="col-sm-12">

                            </div>
                            <div class="col-sm-12">
                                <div id="purchase_div">
                                    <div class="table-responsive">
                                        <table class="table " style="border: 0;" border="0">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="padding: 0;border: 0;">
                                                        <div class="" style="width: 100%">
                                                            <img class="show" src="<?= base_url() ?>/assets/img/header.png" style="width: 100%;height: auto;" />
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table class="table table-bordered table-striped table-hover inside" style="page-break-inside: auto;break-inside: auto;">
                                                            <?php
                                                            $TotalCredit = 0;
                                                            $TotalDebit = 0;
                                                            $CurBalance = $prebalance;
                                                            foreach ($HeadName2 as $key => $data) {
                                                                // var_dump($data);
                                                            ?>
                                                                <tr>
                                                                    <td height="25" align="center"><?php echo ++$key; ?></td>
                                                                    <td align="center"><?php echo html_escape(date('d-m-Y', strtotime($data['VDate']))); ?></td>
                                                                    <td align="center"><?php echo html_escape($data['COAID']); ?></td>
                                                                    <?php if ($chkIsTransction) { ?>
                                                                        <td align="center"><?php echo html_escape($data['Narration']); ?>
                                                                        </td>
                                                                    <?php } ?>
                                                                    <td align="right">
                                                                        <?php echo number_format($data['Debit'], 2, '.', ','); ?></td>
                                                                    <td align="right">
                                                                        <?php echo number_format($data['Credit'], 2, '.', ','); ?></td>
                                                                    <?php
                                                                    $TotalDebit += $data['Debit'];
                                                                    $CurBalance += $data['Debit'];
                                                                    $TotalCredit += $data['Credit'];
                                                                    $CurBalance -= $data['Credit'];
                                                                    ?>
                                                                    <td align="right">
                                                                        <?php echo number_format($CurBalance, 2, '.', ','); ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                            <thead>
                                                                <tr>
                                                                    <div class="g_l_date_range" style="margin: 15px 0;">
                                                                        <div class="col-md-12 text-right">
                                                                            <p>
                                                                                <strong><?php echo html_escape($company_info[0]['company_name']); ?></strong><br>
                                                                                <span><?php echo html_escape($company_info[0]['email']); ?></span>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="" style="margin: 15px 0">
                                                                        <div class="g_l_balance">
                                                                            <div class="col-sm-12">
                                                                                <h3 class="g_v_h_balance"><?= display('pre_balance') ?>:
                                                                                    <?php echo number_format($prebalance, 2, '.', ','); ?></h3>
                                                                            </div>
                                                                            <div class="col-sm-12">
                                                                                <h3 class="g_v_h_balance"><?= display('current_balance') ?>:
                                                                                    <?php echo number_format($CurBalance, 2, '.', ','); ?></h3>
                                                                            </div>
                                                                        </div>
                                                                        <div class="g_l_date_range">
                                                                            <div class="col-sm-12">
                                                                                <h3 class="g_v_h_date_range text-center"><?= display('general_ledger_of') ?>-<?php echo html_escape($ledger[0]['HeadName']) ?>
                                                                                    <br> (<?= display('at') ?>
                                                                                    <?php echo html_escape($dateRange) ?>)
                                                                                </h3>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </tr>
                                                                <tr class="borderd">
                                                                    <th><?php echo display('sl') ?></th>
                                                                    <th><?php echo display('transection_date') ?></th>
                                                                    <th><?php echo display('head_code') ?></th>
                                                                    <?php if ($chkIsTransction) { ?>
                                                                        <th><?php echo display('particulars') ?></th>
                                                                    <?php } ?>
                                                                    <th><?php echo display('debit') ?></th>
                                                                    <th><?php echo display('credit') ?></th>
                                                                    <th><?php echo display('balance') ?></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <tr class="table_data">
                                                                    <?php
                                                                    if ($chkIsTransction)
                                                                        $colspan = 4;
                                                                    else
                                                                        $colspan = 3;
                                                                    ?>
                                                                    <td colspan="<?php echo $colspan; ?>" align="right">
                                                                        <strong><?php echo display('total') ?></strong>
                                                                    </td>
                                                                    <td align="right">
                                                                        <strong><?php echo number_format($TotalDebit, 2, '.', ','); ?></strong>
                                                                    </td>
                                                                    <td align="right">
                                                                        <strong><?php echo number_format($TotalCredit, 2, '.', ','); ?></strong>
                                                                    </td>
                                                                    <td align="right">
                                                                        <strong><?php echo number_format($CurBalance, 2, '.', ','); ?></strong>
                                                                    </td>
                                                                </tr>
                                                            </tbody>


                                                        </table>
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
                                        <div class="footerr row position-relative" style="margin: 0;">
                                            <div class="col-xs-12 divFoote" style="background-image: url();">
                                                <img class="show" src="<?= base_url() ?>/assets/img/footer.png" style="width: 100%;height: auto;" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row g_l_date_range">
                        <div class="col-sm-12">
                            <div class="text-center" id="print">
                                <input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print" onclick="printPageDiv('printableArea')">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- General Ledger Report End -->