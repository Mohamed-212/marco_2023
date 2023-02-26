<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Receipt voucher form start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('payment_voucher') ?></h1>
            <small><?php echo display('payment_voucher_form') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('web_settings') ?></a></li>
                <li class="active"><?php echo display('add_coupon') ?></li>
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
                <div class="column">
                    <a href="<?php echo base_url('dashboard/cpayment_voucher/manage_payment_voucher')?>"
                        class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"></i>
                        <?php echo display('manage_payment_voucher')?></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('payment_voucher_form') ?></h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('accounting/accounting/insert_payment_voucher',array('class'=>'form-vertical','id'=>'validate'))?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="voucher_no"
                                        class="col-sm-4 col-form-label"><?php echo display('voucher_no') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <select class="get-voucher-info-ajax" name="txtVNo" id="voucher_id"
                                            style="width: 100%"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="customer_name"
                                        class="col-sm-4 col-form-label"><?php echo display('customer_name') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" size="100" value="" name="customer_name"
                                            class="customerSelection form-control"
                                            placeholder='<?php echo display('customer_name') ?>' id="customer_name"
                                            readonly />
                                        <input id="customer_id" value="" class="customer_hidden_value" type="hidden"
                                            name="customer_id">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('date') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">

                                        <input class="form-control datepicker" type="text" size="50" name="dtpDate"
                                            id="date" required value="" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('code') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" name="cmbDebit" id="code" required
                                            placeholder="<?php echo display('customer_head_code') ?>" value=""
                                            readonly />
                                        <input type="hidden" id="headCode" name="txtCode" id="code" required value="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="customer_balance" class="col-sm-4 col-form-label">
                                        <?php echo display('current_balance') ?>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" size="100" name="customer_balance" class=" form-control"
                                            placeholder='<?php echo display('current_balance') ?>' id="current_balance"
                                            readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive mt_10">
                            <table class="table table-bordered table-hover" id="normalinvoice">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('balance') ?></th>
                                        <th class="text-center"><?php echo display('total_vat') ?></th>
                                        <th class="text-center"><?php echo display('total_balance') ?><i
                                                class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('remaining_balance') ?> <i
                                                class="text-danger">*</i>
                                        </th>
                                        <th class="text-center"><?php echo display('pay_vat') ?> </th>
                                        <th class="text-center"><?php echo display('pay_amount') ?> <i
                                                class="text-danger">*</i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="addinvoiceItem">
                                    <tr>
                                        <td>
                                            <input type="text" name="pv_balance[]"
                                                class="form-control text-right pv_balance" id="pv_balance"
                                                placeholder="0" readonly="" />
                                        </td>
                                        <td>
                                            <input type="text" id="total_vat" class="form-control text-right unit_1"
                                                placeholder="0" readonly="" />
                                        </td>
                                        <td>
                                            <input type="number" name="product_balance[]" id="total_balance"
                                                class="form-control text-right" value="0.00" required="" readonly />
                                        </td>
                                        <td>
                                            <input type="number" name="remaining_balance[]" placeholder="0.00"
                                                id="remaining_balance" class="price_item1 form-control text-right"
                                                required readonly />
                                        </td>
                                        <td>
                                            <input type="number" name="pay_vat" id="pay_vat"
                                                class="form-control text-right" placeholder="0.00" readonly />
                                        </td>
                                        <td>
                                            <input class="total_price form-control text-right" type="text"
                                                name="txtAmount" id="pay_amount" placeholder="0.00" />
                                            <input type="hidden" name="grand_total" id="grandtotal" />
                                        </td>
                                        <div>
                                            <!-- Tax calculate end -->
                                        </div>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" rowspan="4">
                                            <div class="payment_method">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="payment_area_table">
                                                        <tr class="info">
                                                            <th><?php echo display('card_type');?></th>
                                                            <th><?php echo display('card_no');?></th>
                                                            <th><?php echo display('pay_amount');?></th>
                                                            <th><?php echo display('action');?></th>
                                                        </tr>
                                                        <tr id="">
                                                            <td>
                                                                <div class="form-group payment-row row guifooterpanel">
                                                                    <div class="col-sm-12">
                                                                        <select class="form-control dont-select-me"
                                                                            name="card_type[]">
                                                                            <option value="Credit Card">
                                                                                <?php echo display('credit_card');?>
                                                                            </option>
                                                                            <option value="Debit Card">
                                                                                <?php echo display('debit_card');?>
                                                                            </option>
                                                                            <option value="Master Card">
                                                                                <?php echo display('master_card');?>
                                                                            </option>
                                                                            <option value="Amex">
                                                                                <?php echo display('amex');?></option
                                                                                value="Credit Cart">
                                                                            <option value="Visa">
                                                                                <?php echo display('visa');?></option
                                                                                value="Credit Cart">
                                                                            <option value="Paypal">
                                                                                <?php echo display('paypal');?></option>
                                                                            <option value="Others">
                                                                                <?php echo display('others');?></option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group payment-row row guifooterpanel">
                                                                    <div class="col-sm-12">
                                                                        <input class="form-control" type="text"
                                                                            name="card_no[]"
                                                                            placeholder="<?php echo display('card_no');?>">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group payment-row row guifooterpanel">
                                                                    <div class="col-sm-12">
                                                                        <input class="form-control" id="amount"
                                                                            type="text" name="payment_amount[]"
                                                                            value="<?php $grandtotal ?>"
                                                                            placeholder="<?php echo display('pay_amount'); ?>">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-success"
                                                                    id="add_more_btn"><i class="ti-plus"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </td>
                                        <td colspan="2"></td>
                                        <td align="center" rowspan="4" class="width_220">

                                            <input type="submit" id="add-invoice_btn" class="btn btn-success pv-submit"
                                                name="add-invoice" value="<?php echo display('submit') ?>" />
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Receipt voucher form end -->
<script src="<?php echo MOD_URL.'accounting/assets/js/receipt_voucher_form.js'; ?>"></script>