<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Supplier Ledger Start -->
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
            height: 150px
        }

        .footerr {
            position: fixed;
            height: 150px;
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
        form,
        .print-none {
            display: none !important;
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

        .print-btn {
            display: none !important;
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
        .print-btn:not(.stay) {
            display: none !important;
        }
    }
</style>
<div class="content-wrapper">
    <section class="content-header print-none">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('supplier_ledger') ?></h1>
            <small><?php echo display('manage_supplier_ledger') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('supplier') ?></a></li>
                <li class="active"><?php echo display('supplier_ledger') ?></li>
            </ol>
        </div>
    </section>

    <!-- Supplier information -->
    <section class="content">
        <!-- Alert Message -->
        <?php
        $message = $this->session->userdata('message');
        if (isset($message)) {
        ?>
            <div class="alert alert-info alert-dismissable print-none">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $message ?>
            </div>
        <?php
            $this->session->unset_userdata('message');
        }
        $error_message = $this->session->userdata('error_message');
        if (isset($error_message)) {
        ?>
            <div class="alert alert-danger alert-dismissable print-none">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error_message ?>
            </div>
        <?php
            $this->session->unset_userdata('error_message');
        }
        ?>

        <div class="row print-none">
            <div class="col-sm-12">
                <div class="column">
                    <?php if ($this->permission->check_label('add_supplier')->create()->access()) { ?>
                        <a href="<?php echo base_url('dashboard/Csupplier') ?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-plus"> </i> <?php echo display('add_supplier') ?></a>
                    <?php }
                    if ($this->permission->check_label('manage_supplier')->read()->access()) {
                    ?>
                        <a href="<?php echo base_url('dashboard/Csupplier/manage_supplier') ?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i>
                            <?php echo display('manage_supplier') ?></a>
                    <?php } ?>

                </div>
            </div>
        </div>

        <!-- Supplier select -->
        <div class="row print-none">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo form_open('dashboard/Csupplier/supplier_ledger_report', array('class' => 'form-inline')); ?>
                        <div class="form-group">
                            <label for="supplier_name"><?php echo display('select_supplier') ?><span class="text-danger">*</span>:</label>
                            <select class="form-control" name="supplier_id" id="supplier_id">
                                <?php foreach ($suppliers_list as $sub) : ?>
                                    <option value=""></option>
                                    <option value="<?= $sub['supplier_id'] ?>" <?= $supplier_id == $sub['supplier_id'] ? 'selected' : '' ?>><?= $sub['supplier_name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="from_date"><?php echo display('from_date') ?><span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control datepicker2" autocomplete="off" placeholder="<?php echo display('from_date'); ?>" name="from_date" value="<?= $from_date ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="to_date"><?php echo display('to_date') ?><span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control datepicker2" autocomplete="off" placeholder="<?php echo display('to_date'); ?>" name="to_date" value="<?= $to_date ?>" required>
                        </div>
                        <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
                        <button type="submit" formaction="<?= base_url('dashboard/Csupplier/supplier_ledger_report_print') ?>" class="btn btn-primary"><?php echo display('print') ?></button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if ($supplier_name) {
        ?>

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4><?php echo display('supplier_information') ?></h4>
                            </div>
                        </div>
                        <div class="panel-body">
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
                                        <td colspan="2" style="padding-left: 30px;padding-top: 50px;">
                                            <div class="">
                                                <?php echo display('supplier_name') ?>:&nbsp;&nbsp; <h4 style="display: inline;"><?php echo html_escape($supplier_name); ?></h4>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="padding-left: 30px;">
                                            <div class="">
                                                <?php echo display('from_date') ?>:&nbsp;&nbsp; <?= $this->input->post('from_date', TRUE); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="padding-left: 30px;">
                                            <div class="">
                                                <?php echo display('to_date') ?>:&nbsp;&nbsp; <?= $this->input->post('to_date', TRUE); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <div class="table-responsive">
                                            <table id="" class="table table-bordered table-striped table-hover">
                                                <thead>


                                                    <tr>
                                                        <th><?php echo display('date') ?></th>
                                                        <th><?php echo display('transaction_type') ?></th>
                                                        <th class="text-right mr_20"><?php echo display('debit') ?></th>
                                                        <th class="text-right mr_20"><?php echo display('credit') ?></th>
                                                        <th class="text-right mr_20"><?php echo display('balance') ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($ledger) {
                                                        $total_sup_debit = $total_sup_credit = $total_sup_balance = 0;
                                                        foreach ($ledger as $key => $ledger) {
                                                            $invoice = $this->db->select('invoice')->from('product_purchase')->where('purchase_id', $ledger['purchase_id'])->get()->row();
                                                    ?>
                                                            <tr>
                                                                <td class="text-center">
                                                                    <?= date('d-m-Y', strtotime($ledger['sl_created_at'])) ?>
                                                                </td>
                                                                <!-- <td>
                                                        <?php
                                                            $transaction_info = $this->db->select('Vtype,Narration')->from('acc_transaction')->where('VNo', $ledger['invoice'])->get()->row();
                                                            if (!empty($transaction_info)) {
                                                                echo $transaction_info->Vtype;
                                                            }
                                                        ?>
                                                    </td> -->
                                                                <td>
                                                                    <?php if (empty($invoice)) : ?>
                                                                        <?php
                                                                        if (empty($ledger['voucher'])) {
                                                                            echo display('previous_balance');
                                                                        } else {
                                                                            if ($ledger['voucher'] == 'JV') {
                                                                                echo display('journal_voucher');
                                                                            }
                                                                            if ($ledger['voucher'] == 'CV') {
                                                                                echo display('credit_voucher');
                                                                            }
                                                                            if ($ledger['voucher'] == 'return') {
                                                                                echo display('purchase_return');
                                                                            }
                                                                        }
                                                                        ?>
                                                                    <?php else : ?>
                                                                        <a href="<?php echo base_url() . 'dashboard/Cpurchase/purchase_details_data/' . $ledger['purchase_id']; ?>"><?php echo $invoice->invoice; ?>
                                                                            <i class="fa fa-tasks pull-right" aria-hidden="true"></i></a>
                                                                    <?php endif ?>
                                                                </td>
                                                                <td class="text-right">
                                                                    <?php $total_sup_debit += ((empty($ledger['debit'])) ? 0 : $ledger['debit']);
                                                                    echo (($position == 0) ? $currency . " " . ((empty($ledger['debit'])) ? 0 : $ledger['debit']) : ((empty($ledger['debit'])) ? 0 : $ledger['debit']) . " " . $currency)
                                                                    ?>
                                                                </td>
                                                                <td class="text-right">
                                                                    <?php $total_sup_credit += ((empty($ledger['credit'])) ? 0 : $ledger['credit']);
                                                                    echo (($position == 0) ? $currency . " " . $ledger['credit'] : $ledger['credit'] . " " . $currency)
                                                                    ?>
                                                                </td>
                                                                <td class="text-right">
                                                                    <?php $total_sup_balance += ((empty($ledger['balance'])) ? 0 : $ledger['balance']);
                                                                    echo (($position == 0) ? $currency . " " . $ledger['balance'] : $ledger['balance'] . " " . $currency)
                                                                    ?>
                                                                </td>
                                                                <!-- <td><?php
                                                                            if (!empty($transaction_info)) {
                                                                                echo html_escape($transaction_info->Narration);
                                                                            }
                                                                            ?>
                                                    </td> -->
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td>--</td>
                                                        <th class="text-center"><?= display('grand_total') ?></th>
                                                        <th class="text-center"><?php echo html_escape($total_sup_debit); ?></th>
                                                        <th class="text-center"><?php echo html_escape($total_sup_credit); ?></th>
                                                        <th class="text-center"><?php echo html_escape($total_sup_debit - $total_sup_credit); ?></th>
                                                    </tr>
                                                </tfoot>
                                            <?php } ?>
                                            </table>
                                        </div>
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
                </div>
                <a class="btn btn-info print-btn stay" href="javascript:void(0)" onclick="window.print()"><span class="fa fa-print"></span>
            </div>

            <!-- Manage Supplier -->
            <div class="row" style="display: none">
                <div class="col-sm-12" style="visibility: hidden">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4><?php echo display('supplier_ledger') ?></h4>
                            </div>
                        </div>
                        <div class="panel-body">

                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </section>
</div>
<!-- Supplier Ledger End -->
<script>
    $(document).ready(function() {
        $(".datepicker2").datepicker({
            dateFormat: "dd-mm-yy"
        });
    });
</script>