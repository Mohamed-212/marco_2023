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
            <div class="col-sm-12 col-md-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>
                                <?php echo display('journal_voucher') ?>
                            </h4>
                        </div>
                    </div>

                    <div class="panel-body hideme">
                        <?php echo $print_only ? '<form>' : form_open_multipart('accounting/accounting/bdtask_create_journal_voucher', 'id="validate"') ?>
                        <table>
                            <?php if ($print_only) : ?>
                                <table class="table " style="border: 0;" border="0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="2" style="padding: 0;">
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
                                                        <?=display('daily_record')?>
                                                    </h3>
                                                </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding-left: 30px;padding-top: 15px;border: 0;">
                                                <div class="">
                                                    <?php
                                                        $cl = $this->db->select('voucher, c_id')->from('customer_ledger')->where('Vno', $voucher_no)->get()->row();
                                                    ?>
                                                    <?php echo display('voucher_no') ?>:&nbsp;&nbsp; <?php echo $cl->voucher . ' / ' . $cl->c_id; ?>
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
                            <?php else : ?>
                                <div class="form-group row">
                                    <label for="vo_no" class="col-sm-2 col-form-label"><?php echo display('voucher_no') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-4">
                                        <?php if ($print_only) : ?>
                                            <input type="text" name="txtVNo" id="txtVNo" value="<?= $voucher_no ?>" class="form-control" readonly>
                                        <?php else : ?>
                                            <input type="text" name="txtVNo" id="txtVNo" value="<?php if (!empty($voucher_no[0]['voucher'])) {
                                                                                                    $vn = substr($voucher_no[0]['voucher'], 8) + 1;
                                                                                                    echo $voucher_n = 'Journal-' . $vn;
                                                                                                } else {
                                                                                                    echo $voucher_n = 'Journal-1';
                                                                                                } ?>" class="form-control" readonly required>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="date" class="col-sm-2 col-form-label"><?php echo display('date') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" name="dtpDate" id="dtpDate" class="form-control" value="<?php echo $print_only ? $data['VDate'] : date('Y-m-d') ?>" <?= $print_only ? 'readonly' : '' ?> required />
                                        <input type="hidden" name="limitDate" id="limitDate" class="form-control" value="<?php echo $print_only ? $data['VDate'] : date('Y-m-d') ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtRemarks" class="col-sm-2 col-form-label"><?php echo display('remark') ?></label>
                                    <div class="col-sm-4">
                                        <textarea name="txtRemarks" id="txtRemarks" class="form-control" <?= $print_only ? 'readonly' : '' ?>><?php if ($print_only) {
                                                                                                                                                    echo $data['Narration'];
                                                                                                                                                } ?></textarea>
                                    </div>
                                </div>
                            <?php endif ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="debtAccVoucher">
                                    <thead>
                                        <tr class="has-bg">
                                            <th class="text-center"> <?php echo display('account_name') ?><i class="text-danger hide-me">*</i></th>
                                            <th class="text-center"> <?php echo display('code') ?></th>
                                            <th class="text-center"> <?php echo display('debit') ?></th>
                                            <th class="text-center"> <?php echo display('credit') ?></th>
                                            <th class="text-center print-hide"> <?php echo display('action') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="debitvoucher">
                                        <tr>
                                            <td class="text-center" width="300px">
                                                <?php if ($print_only) : ?>
                                                    <?php foreach ($data['accounts'] as $acc) : ?>
                                                        <input class="form-control" value="<?= $acc ?>" style="text-align: center;" readonly />
                                                    <?php endforeach ?>
                                                <?php else : ?>
                                                    <select name="cmbCode[]" id="cmbCode_1" class="form-control" onchange="load_dbtvouchercode(this.value,1)" required="">
                                                        <option value="">Select One</option>
                                                        <?php foreach ($acc as $acc1) { ?>
                                                            <option value="<?php echo $acc1->HeadCode; ?>">
                                                                <?php echo $acc1->HeadName; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($print_only) : ?>
                                                    <?php foreach ($data['cAID'] as $cId) : ?>
                                                        <input type="text" name="txtCode[]" class="form-control " id="txtCode_1" value="<?= $cId ?>" readonly>
                                                    <?php endforeach ?>
                                                <?php else : ?>
                                                    <input type="text" name="txtCode[]" class="form-control " id="txtCode_1">
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($print_only) : ?>
                                                    <?php foreach ($data['debit'] as $debit) : ?>
                                                        <input type="number" name="txtAmount[]" value="<?= $debit ?>" class="form-control total_price text-right" id="txtAmount_1" readonly>
                                                    <?php endforeach ?>
                                                <?php else : ?>
                                                    <input type="number" name="txtAmount[]" value="0" class="form-control total_price text-right" id="txtAmount_1" onkeyup="calculationContravoucher(1)">
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($print_only) : ?>
                                                    <?php foreach ($data['credit'] as $credit) : ?>
                                                        <input type="number" name="txtAmountcr[]" value="<?= $credit ?>" class="form-control total_price1 text-right" id="txtAmount1_1" readonly>
                                                    <?php endforeach ?>
                                                <?php else : ?>
                                                    <input type="number" name="txtAmountcr[]" value="0" class="form-control total_price1 text-right" id="txtAmount1_1" onkeyup="calculationContravoucher(1)">
                                                <?php endif; ?>
                                            </td>
                                            <td class="print-hide">
                                                <?php if (!$print_only) : ?>
                                                    <button class="btn btn-danger red" type="button" value="<?php echo display('delete') ?>" onclick="deleteRowContravoucher(this)"><i class="fa fa-trash-o"></i></button>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td colspan="1" class="text-right"><label for="reason" class="  col-form-label"><?php echo display('total') ?></label>
                                            </td>
                                            <td class="text-right">
                                                <?php if ($print_only) :
                                                    $totalDebit = 0;
                                                    foreach ($data['debit'] as $debit) {
                                                        $totalDebit += (float)$debit;
                                                    }
                                                ?>
                                                    <input type="text" id="grandTotal" class="form-control text-right " name="grand_total" readonly="readonly" value="<?= $totalDebit ?>" />
                                                <?php else : ?>
                                                    <input type="text" id="grandTotal" class="form-control text-right " name="grand_total" value="" readonly="readonly" value="0" />
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-right">
                                                <?php if ($print_only) :
                                                    $totalCredit = 0;
                                                    foreach ($data['credit'] as $credit) {
                                                        $totalCredit += (float)$credit;
                                                    }
                                                ?>
                                                    <input type="text" id="grandTotal1" class="form-control text-right " name="grand_total1" readonly="readonly" value="<?= $totalCredit ?>" />
                                                <?php else : ?>
                                                    <input type="text" id="grandTotal1" class="form-control text-right " name="grand_total1" value="" readonly="readonly" value="0" />

                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if (!$print_only) : ?>
                                                    <a id="add_more" class="btn btn-info" name="add_more" onClick="addaccountContravoucher('debitvoucher')"><i class="fa fa-plus"></i></a>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>


                            <tfoot>
                                <tr>
                                    <th>
                                        <div class="empty-footer"></div>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                        <?php if ($print_only) : ?>
                        <table style="width: 100%;margin-top: 70px;margin-bottom: 50px;table-layout: fixed;">
                            <thead>
                                <th></th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody>
                                <tr class="text-center" style="margin-bottom: 50px;">
                                    <td>
                                        <div class=""><?php echo display('recipient') ?></div>
                                        <hr style="width: 80%;margin: 85px 0;margin-bottom: 0;" />
                                    </td>
                                    <td>
                                        <div class=""><?php echo display('cashier') ?></div>
                                        <hr style="width: 80%;margin: 85px 0;margin-bottom: 0;" />
                                    </td>
                                    <td>
                                        <div class=""><?php echo display('depends') ?></div>
                                        <hr style="width: 80%;margin: 85px 0;margin-bottom: 0;" />
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
                        <?php endif ?>
                        <div class="form-group row" style="margin-top: 150px;">
                            <div class="col-sm-12 text-right footer-btns">
                                <?php if ($print_only) : ?>
                                    <button id="print_all" class="btn btn-info btn-large" type="button" onclick="window.print();">
                                        <?php echo display('print') ?>
                                    </button>
                                    <a href="<?= base_url() . '/accounting/accounting/journal_voucher' ?>" class="btn btn-success">
                                        <?= display('add_another') ?>
                                    </a>
                                <?php else : ?>
                                    <input type="submit" id="add_receive" class="btn btn-success btn-large" name="save" value="<?php echo display('save') ?>" tabindex="9" />
                                    <button id="save_print" class="btn btn-info btn-large" type="button">
                                        <?php echo display('save_print') ?>
                                    </button>
                            </div>
                        <?php endif ?>
                        </div>
                        <?php echo form_close() ?>
                    </div>


                </div>
                <input type="hidden" id="headoption" value="<option value=''>Select One</option><?php foreach ($acc as $acc2) { ?><option value='<?php echo html_escape($acc2->HeadCode); ?>'><?php echo html_escape($acc2->HeadName); ?></option><?php } ?>" name="">
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('accounting/components/journal_voucher_js') ?>
<script>
    $(document).ready(function() {
        $(document).on('click', '#save_print', function() {
            $('form').append("<input hidden type='hidden' name='print_me' value='1' />").submit();
        });
    });
</script>