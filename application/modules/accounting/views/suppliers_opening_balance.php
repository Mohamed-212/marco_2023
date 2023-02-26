<link rel="stylesheet" href="<?php echo MOD_URL . 'accounting/assets/js/jstree/themes/default/style.min.css'; ?>" />
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Add new block start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('accounts') ?></h1>
            <small><?php echo display('suppliers_opening_balance') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('accounts') ?></a></li>
                <li class="active"><?php echo display('suppliers_opening_balance') ?></li>
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
                                <?php echo display('suppliers_opening_balance') ?>
                            </h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php echo  form_open_multipart('accounting/suppliers_opening_balance', 'id="validate"') ?>
                        <!-- <div class="form-group row">
                            <label for="date" class="col-sm-2 col-form-label"><?php echo display('date') ?><i
                                    class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input type="text" name="dtpDate" id="dtpDate" class="form-control datepicker2"
                                    value="<?php echo date('d-m-Y'); ?>" required>
                                <input type="hidden" name="limitDate" id="limitDate" class="form-control"
                                    value="<?php echo  date('d-m-Y') ?>" required>
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <label for="account_head" class="col-sm-2 col-form-label"><?php
                                                                                        echo display('account_head');
                                                                                        ?> <i
                                    class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <select name="headcode" class="form-control" required="" tabindex="3">
                                    <option value="">Select One</option>
                                    <?php foreach ($headss as $acc_head) { ?>
                                    <option value="<?php echo $acc_head->HeadCode; ?>">
                                        <?php echo $acc_head->supplier_no . ' - ' . $acc_head->HeadName; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="amount" class="col-sm-2 col-form-label"><?php echo display('amount') ?><i
                                    class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input type="text" name="amount" id="amount" class="form-control" value="" required
                                    placeholder="0.00">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="balance_type" class="col-sm-2 col-form-label"><?php echo display('balance_type') ?>
                            <!-- <i class="text-danger">*</i> -->
                        </label>
                            <div class="col-sm-4">
                                <select class="form-control select2 width_100p" id="balance_type" name="balance_type">
                                    <option value="1"><?php echo display('credit') ?></option>
                                    <option value="2"><?php echo display('debit') ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtRemarks" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-4">
                                <input type="submit" id="add_receive" class="btn btn-success btn-large form-control"
                                    name="save" value="<?php echo display('save') ?>" tabindex="9" />
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('accounting/components/opening_balance_js') ?>
<script>
    $(document).ready(function() {
        $(".datepicker2").datepicker({
            dateFormat: "dd-mm-yy"
        });
    });
</script>