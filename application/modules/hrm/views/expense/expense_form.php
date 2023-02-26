<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Manage Customer Start -->
<script>
    $(document).ready(function() {
        $('body').on('change', '#paytype', function() {
            const val = $(this).val();
            const bankDiv = $('#bank_div');
            const bankSelect = $('#bank_id');
            if (val == 2) {
                bankDiv.css('display', 'block');
                bankSelect.attr('required', true);
                $('span.select2').css('width', '100%');
            } else {
                bankDiv.css('display', 'none');
                bankSelect.attr('required', false);
            }
        });
    });
</script>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('expense') ?></h1>
            <small><?php echo $title ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('expense') ?></a></li>
                <li class="active"><?php echo $title ?></li>
            </ol>
        </div>
    </section>

    <section class="content">

        <?php if (!empty($this->session->flashdata('message'))) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $this->session->flashdata('message') ?>
            </div>
        <?php } ?>
        <?php if (!empty($this->session->flashdata('exception'))) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $this->session->flashdata('exception') ?>
            </div>
        <?php } ?>
        <?php if (!empty(validation_errors())) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo validation_errors() ?>
            </div>
        <?php } ?>

        <!-- Manage Customer -->
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>
                                <?php echo display('add_expense') ?>
                            </h4>
                        </div>
                    </div>
                    <div class="panel-body">

                        <?php echo form_open_multipart('hrm/expense/bdtask_create_expense') ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('date') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="dtpDate" id="dtpDate" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>">

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="expense_type" class="col-sm-4 col-form-label"><?php
                                                                                                echo display('expense_type');
                                                                                                ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <select name="expense_type" class="form-control" required="">
                                            <option value="">Select Expense Type</option>
                                            <?php foreach ($expense_item as $item) { ?>
                                                <option value="<?php echo html_escape($item['expense_item_name']) ?>"><?php echo html_escape($item['expense_item_name']) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="payment_type" class="col-sm-4 col-form-label"><?php
                                                                                                echo display('payment_type');
                                                                                                ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <select name="paytype" class="form-control" required="" id="paytype" required="">
                                            <option value="">Select Payment Option</option>
                                            <option value="1">Cash Payment</option>
                                            <option value="2">Bank Payment</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12" id="bank_div" style="display: none;">
                                <div class="form-group row">
                                    <label for="payment_type" class="col-sm-4 col-form-label"><?php
                                                                                                echo display('bank_name');
                                                                                                ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <select name="bank_id" class="form-control bankpayment" id="bank_id">
                                            <option value="">Select Payment Option</option>
                                            <?php foreach ($bank_list as $banks) { ?>
                                                <option value="<?php echo html_escape($banks['bank_id']) ?>"><?php echo html_escape($banks['bank_name']) ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('amount') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="amount" id="amount" class="form-control" required="">

                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-sm-12 text-center">

                                    <input type="submit" id="add_receive" class="btn btn-success btn-large" name="save" value="<?php echo display('save') ?>" tabindex="9" />

                                </div>
                            </div>
                            <?php echo form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>