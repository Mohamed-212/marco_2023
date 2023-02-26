<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Customer js php -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/customer.js.php"></script>
<style type="text/css">
    * {
        font-family: 'Roboto', sans-serif;
    }

    @media print {
        table tbody tr:nth-child(even) td {
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
        .panel-heading.ui-sortable-handle,
        .footer-btns,
        footer,
        .footer,
        #toTop,
        footer,
        .btn.back-top,
        .hide-me,
        .pace,
        .pace-activity,
        form {
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
    }


    @media screen {
        .hideme {
            display: none;
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

<!-- Edit Invoice Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('edit_installment') ?></h1>
            <small><?php echo display('edit_installment') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('installment') ?></a></li>
                <li class="active"><?php echo display('edit_installment') ?></li>
            </ol>
        </div>
    </section>

    <section class="content" style="border: none">
        <!-- Invoice report -->
        <div class="row hideme">
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
                            <td colspan="2" style="padding: 0;">
                                <div class="" style="width: 100%">
                                    <img class="show" src="<?= base_url() ?>/assets/img/header.png" style="width: 100%;height: auto;" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-left: 30px;padding-top: 100px;">
                                <div class="">
                                    <?php echo display('customer_name') ?>:&nbsp;&nbsp; <?php echo html_escape($invoice['customer_name']); ?>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td colspan="2" style="padding-left: 30px;">
                                <div class="">
                                    <?php echo display('voucher_no') ?>:&nbsp;&nbsp; Rcv / <span id="c_id55">1</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-left: 30px;">
                                <div class="">
                                    <?php echo display('invoice_no') ?>:&nbsp;&nbsp; <?php echo html_escape($invoice['invoice']); ?>&nbsp;(<?php
                                        $cl = $this->db->select('voucher, c_id')->from('customer_ledger')->where('Vno', $invoice_no)->where('voucher', 'Sall')->get()->row(); 
                                    ?>
                                    <?php echo html_escape(isset($is_order) ? $order_no : 'Sall / '. $cl->c_id); ?> )
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="" style="padding-left: 30px;">
                                <div class="">
                                    <?php echo display('due_amount') ?>:&nbsp;&nbsp; <span id="due_amount"></span>
                                </div>
                            </td>
                            <td class="" style="padding-left: 30px;">
                                <div class="">
                                    <?php echo display('paid_amountt') ?>:&nbsp;&nbsp; <span id="paid_amountt"></span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="" style="padding-left: 30px;">
                                <div class="">
                                    <?php echo display('due_date') ?>:&nbsp;&nbsp; <span id="due_date"></span>
                                </div>
                            </td>
                            <td class="" style="padding-left: 30px;">
                                <div class="">
                                    <?php echo display('payment_date') ?>:&nbsp;&nbsp; <span id="payment_date"></span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-left: 30px;">
                                <?php echo display('payment_type') ?>:&nbsp;&nbsp; <span id="payment-type"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-left: 30px;display:none;" id="check-no-td">
                                <?= display('check_no') ?>:&nbsp;&nbsp; <span id="check-no"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-left: 30px;display:none;" id="expiry-date-td">
                                <?= display('expiry_date') ?>:&nbsp;&nbsp; <span id="expiry-date"></span>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" style="padding-left: 30px;padding-top: 50px;" id="total-still-td">
                                <?= display('balance_ammount') ?>:&nbsp;&nbsp; <?= round((float)$customer_ledger[1][0]['total_debit'] - (float)$customer_ledger[0][0]['total_credit'], 2) ?><span id="total-still" style="display: none;"></span>
                            </td>
                        </tr>
                    </tbody>

                </table>
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
                                <hr style="width: 80%;margin: 60px 0;margin-bottom: 0;border-color: transparent;background: transparent;" />
                                <span style="" id="employee-name">...
                                </span>
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
            </div>
        </div>
        <div class="row">
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


            <?php if (!empty(validation_errors())) : ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo validation_errors(); ?>
                </div>
            <?php endif; ?>
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('edit_installment') ?></h4>
                        </div>
                    </div>
                    <?php echo form_open('dashboard/Cinstallment/installment_update', array('class' => 'form-vertical', 'id' => 'validate')) ?>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-6" id="">
                                <div class="form-group row">
                                    <label for="customer_name" class="col-sm-4 col-form-label"><?php echo display('customer_name') ?> </label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo html_escape($invoice['customer_name']); ?>" class="form-control customerSelection" disabled>
                                        <input type="hidden" value="<?php echo html_escape($invoice['customer_id']); ?>" name="customer_id">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" id="">
                                <div class="form-group row">
                                    <label for="customer_name" class="col-sm-4 col-form-label"><?php echo display('invoice_no') ?> </label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo html_escape($invoice['invoice']); ?>" class="form-control customerSelection" disabled>
                                        <input type="hidden" value="<?php echo html_escape($invoice['invoice_id']); ?>" name="invoice_id">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive mt_10">
                            <table class="table table-bordered table-hover data">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('due_amount') ?></th>
                                        <th class="text-center"><?php echo display('due_date') ?></th>
                                        <th class="text-center"><?php echo display('paid_amountt') ?></th>
                                        <th class="text-center"><?php echo display('payment_date') ?></th>
                                        <th class="text-center"><?php echo display('payment_type') ?></th>
                                        <th class="text-center"><?php echo display('employee_name') ?></th>
                                        <th class="text-center"><?php echo display('status') ?></th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $status = array(
                                        '1' => display('pending'),
                                        '2' => display('collected'),
                                    );
                                    $payment_type = array(
                                        '1' => display('cash'),
                                        // '2' => display('pos'),
                                        '3' => display('wire transfer'),
                                        '4' => display('check'),
                                        // '5' => display('customer_balance'),
                                    );


                                    if ($installment_details) {
                                        $inx = 0;
                                        $clAll = $this->db->select('*')->from('customer_ledger')->where([
                                            'customer_id' => $invoice['customer_id'],
                                            'invoice_no' => $invoice['invoice_id'],
                                            'voucher' => 'Rcv'
                                        ])->order_by('c_id', 'asc')->get()->result_array();
                                        // echo '<pre>';var_dump($clAll, $installment_details);echo '</pre>';

                                        foreach ($installment_details as $value) {
                                            $readonly = '';
                                            if ($value['status']) {
                                                $readonly = 'readonly';
                                            }
                                    ?>
                                            <tr>
                                                <td class="text-center">
                                                    <input type="text" name="amount[]" class="form-control" value="<?php echo html_escape($value['amount']) ?>">
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control datepicker2" name="due_date[]" value="<?php echo html_escape($value['due_date']) ?>" readonly>
                                                </td>
                                                <td class="text-center">
                                                    <input type="number" name="payment_amount[]" class="form-control" value="<?php echo html_escape($value['payment_amount']) ?>" placeholder="0.00" <?php echo html_escape($readonly) ?>>
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control datepicker2" name="payment_date[]" readonly value="<?php if ($value['status']) {
                                                                                                                                                    echo html_escape(date('d-m-Y', strtotime($value['payment_date'])));
                                                                                                                                                } else {
                                                                                                                                                    echo set_value('date', date("d-m-Y"));
                                                                                                                                                } ?>">
                                                </td>
                                                <td class="text-center">
                                                    <div style="display: flex;flex-direction: column">
                                                        <?php echo form_dropdown('payment_type[]', $payment_type, $value['payment_type'], "onchange='changPaymentType(this);' class='form-control payment_type' $readonly ") ?>
                                                        <select class="form-control account" style="margin-top: 10px;" name="account[]" <?php echo html_escape($readonly) ?>>
                                                            <option value=""></option>
                                                            <?php
                                                            if ($payment_info) {
                                                                foreach ($payment_info as $payment_method) {
                                                            ?>
                                                                    <option value="<?php echo html_escape($payment_method->HeadCode); ?>" <?php echo html_escape($readonly) ?> <?php
                                                                                                                                                                                if ($payment_method->HeadCode == $value['account']) {
                                                                                                                                                                                    echo 'selected';
                                                                                                                                                                                }
                                                                                                                                                                                ?>>
                                                                        <?php echo html_escape($payment_method->HeadName); ?>
                                                                    </option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <input class="form-control text-center" style="margin-top: 10px; <?php if (!$value['check_no']) { ?> display: none; <?php } ?> " type="text" name="check_no[]" placeholder="<?php echo display('check_no') ?>" value="<?php echo html_escape($value['check_no']) ?>">
                                                        <input type="text" style="margin-top: 10px; <?php if (!$value['expiry_date']) { ?> display: none; <?php } ?> " class="form-control datepicker expiry_date text-center" name="expiry_date[]" value="<?php echo html_escape($value['expiry_date']) ?>" placeholder="<?php echo display('expiry_date') ?>">
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo form_dropdown('employee_id[]', $employee, $value['employee_id'], "class='form-control employee_id' $readonly ") ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo form_dropdown('status[]', $status, $value['status'], "class='form-control status' $readonly ") ?>
                                                </td>
                                                <td class="text-center">

                                                    <?php if ($value['status'] == 2) : 
                                                        
                                                        $cl = $clAll[0];
                                                        foreach ($clAll as $finx => $c) {
                                                            if ($finx == $inx) {
                                                                $cl = $c;
                                                                break;
                                                            }
                                                        }
                                                    ?>
                                                        <button type="button" class="btn btn-info prin-row" data-cid55="<?=$cl['c_id']?>" data-due-amount="<?= $value['amount'] ?>" data-due-date="<?= $value['due_date'] ?>" data-paid-amount="<?= $value['payment_amount'] ?>" data-payment-date="<?= $value['payment_date'] ?>" data-payment-type="<?= $payment_type[$value['payment_type']] ?>" data-payment-method="<?php
                                                                                                                                                                                                                                                                                                                                                                                            if ($payment_info) {
                                                                                                                                                                                                                                                                                                                                                                                                foreach ($payment_info as $payment_method) {
                                                                                                                                                                                                                                                                                                                                                                                                    if ($payment_method->HeadCode == $value['account']) {
                                                                                                                                                                                                                                                                                                                                                                                                        echo html_escape($payment_method->HeadName);
                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                            } ?>" data-employee="<?= $value['employee_id'] ?>" data-check-no="<?php echo html_escape($value['check_no']) ?>" data-expiry-date="<?php echo html_escape($value['expiry_date']) ?>">
                                                            <i class="fa fas fa-print"></i>
                                                        </button>
                                                    <?php endif ?>
                                                </td>
                                            </tr>
                                    <?php
                                    $inx++;
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <input type="submit" value="<?php echo display('save') ?>" class="btn btn-large btn-success">
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="<?php echo MOD_URL . 'dashboard/assets/js/installment.js'; ?>"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.prin-row', function() {
            $('#due_amount').text($(this).attr('data-due-amount'));
            $('#paid_amountt').text($(this).attr('data-paid-amount'));
            $('#due_date').text($(this).attr('data-due-date'));
            $('#payment_date').text($(this).attr('data-payment-date'));
            $('#payment-type').text($(this).attr('data-payment-type'));
            $('#payment-method').text($(this).attr('data-payment-method'));
            $('#employee-name').text($(this).parent().parent().find('.form-control.employee_id.select2-hidden-accessible').find("option[selected]").text());

            var checkNo = $(this).attr('data-check-no');
            if (!checkNo || !checkNo.length || checkNo.length < 1) {
                $('#check-no-td,#expiry-date-td').css({
                    display: 'none'
                });
            } else {
                $('#check-no-td,#expiry-date-td').css({
                    display: 'block'
                });
            }
            $('#check-no').text($(this).attr('data-check-no'));
            $('#expiry-date').text($(this).attr('data-expiry-date'));

            $('#c_id55').text($(this).attr('data-cid55'));

            // calculate still pirce
            var allPrice = 0;
            var paidPrice = 0;
            $('[name="amount[]"]').each(function(inx, el) {
                var val = $(el).val();
                allPrice += parseFloat(val.length ? val : '0.0');
            });
            $('[name="payment_amount[]"]').each(function(inx, el) {
                var val = $(el).val();
                paidPrice += parseFloat(val.length ? val : '0.0');
            });
            $('#total-still').text((allPrice - paidPrice).toFixed(2));

            window.print();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".datepicker2").datepicker({
            dateFormat: "dd-mm-yy"
        });
    });
</script>