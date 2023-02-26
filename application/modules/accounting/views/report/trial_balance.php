<script src="<?php echo MOD_URL . 'dashboard/assets/js/print.js'; ?>"></script>
<!-- Daterange picker -->
<link href="<?php echo MOD_URL . 'accounting/assets/css/trial_balance.css'; ?> ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo MOD_URL . 'accounting/assets/css/daterangepicker.css'; ?> ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo MOD_URL . 'accounting/assets/js/moment.min.js'; ?>" type="text/javascript"></script>
<script src="<?php echo MOD_URL . 'accounting/assets/js/daterangepicker.js' ?>" type="text/javascript"></script>
<script src="<?php echo MOD_URL . 'accounting/assets/js/daterangepicker.active.js'; ?>" type="text/javascript"></script>

<!-- Sales Report Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon"><i class="pe-7s-note2"></i></div>
        <div class="header-title">
            <h1><?php echo display('trial_balance') ?></h1>
            <small><?php echo display('trial_balance') ?></small>
            <ol class="breadcrumb">
                <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('accounts') ?></a></li>
                <li><a href="#"><?php echo display('account_reports') ?></a></li>
                <li class="active"><?php echo display('trial_balance') ?></li>
            </ol>
        </div>
    </section>
    <section class="content">
        <!-- General Ledger report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-body">
                        <?php echo form_open('accounting/areports/trial_balance_report', array('method' => 'GET')) ?>
                        <div class="form-group row fy_id_mb">
                            <div class="col-sm-3">
                                <select name="fy_id" id="fy_id" class="form-control">
                                    <option value=""></option>
                                    <?php foreach ($fiscal_year_list as $fiscal_year) { ?>
                                    <option value="<?php echo $fiscal_year->id; ?>"
                                        <?php echo ($fiscal_year->status == 1) ? 'selected' : ''; ?>>
                                        <?php echo html_escape($fiscal_year->title); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="from" id="dtpDate1" class="form-control"
                                    placeholder="From Date" value="" required>
                                <input type="hidden" name="limitDate1" id="limitDate1" class="form-control"
                                    value="<?php echo  date('Y-m-d') ?>" required>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="to" id="dtpDate2" class="form-control" placeholder="To Date"
                                    value="" required>
                                <input type="hidden" name="limitDate2" id="limitDate2" class="form-control"
                                    value="<?php echo  date('Y-m-d') ?>" required>
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
<?php $this->load->view('accounting/components/profit_loss_js') ?>