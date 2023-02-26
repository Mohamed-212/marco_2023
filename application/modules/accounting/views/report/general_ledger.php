<script src="<?php echo MOD_URL . 'dashboard/assets/js/print.js'; ?>"></script>
<!-- Daterange picker -->
<link href="<?php echo MOD_URL . 'accounting/assets/css/daterangepicker.css'; ?> ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo MOD_URL . 'accounting/assets/css/general_ledger.css'; ?> ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo MOD_URL . 'accounting/assets/js/moment.min.js'; ?>" type="text/javascript"></script>
<script src="<?php echo MOD_URL . 'accounting/assets/js/daterangepicker.js' ?>" type="text/javascript"></script>
<script src="<?php echo MOD_URL . 'accounting/assets/js/daterangepicker.active.js'; ?>" type="text/javascript"></script>

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
        <!-- General Ledger report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-body">
                        <?php echo form_open('accounting/areports/general_ledger_report') ?>
                        <div class="form-group row mb-0">
                            <div class="col-sm-3">
                                <select id="cmbGLCode" name="cmbGLCode" class="form-control">
                                    <option><?php echo display('select_voucher_no'); ?></option>
                                    <?php
                                    foreach ($GLHeadList as $GLHead) { ?>
                                    <option value="<?php echo $GLHead['id'] ?>">
                                        <?php echo html_escape($GLHead['text']); ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-3 custom_select">
                                <select class="get-all-voucher-info-ajax" name="cmbCode" id="cmbCode">
                                    <option><?php echo display('select_voucher_no'); ?></option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="date_range" class="form-control reportrange1"
                                    autocomplete="off" placeholder="Select Date">
                            </div>
                            <div class="col-sm-1">
                                <!-- <div class="form-group deaail-mt">
                                    <input type="checkbox" id="chkIsTransction" name="chkIsTransction" size="40">
                                    <label for="chkIsTransction">With Details</label>
                                </div> -->
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-success">Filter</button>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- General Ledger Report End -->