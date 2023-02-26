<?php
$this->load->model('accounting/reports_model');
?>
<script src="<?php echo MOD_URL . 'dashboard/assets/js/print.js'; ?>"></script>
<!-- Daterange picker -->
<link href="<?php echo MOD_URL . 'accounting/assets/css/balance_sheet.css'; ?> ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo MOD_URL . 'accounting/assets/css/daterangepicker.css'; ?> ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo MOD_URL . 'accounting/assets/js/moment.min.js'; ?>" type="text/javascript"></script>
<script src="<?php echo MOD_URL . 'accounting/assets/js/daterangepicker.js' ?>" type="text/javascript"></script>
<script src="<?php echo MOD_URL . 'accounting/assets/js/daterangepicker.active.js'; ?>" type="text/javascript"></script>


<!-- Balance Sheet Report Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon"><i class="pe-7s-note2"></i></div>
        <div class="header-title">
            <h1><?php echo display('balance_sheet') ?></h1>
            <small><?php echo display('balance_sheet') ?></small>
            <ol class="breadcrumb">
                <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('accounts') ?></a></li>
                <li><a href="#"><?php echo display('account_reports') ?></a></li>
                <li class="active"><?php echo display('sales_report') ?></li>
            </ol>
        </div>
    </section>
    <section class="content">
        <!-- Balance Sheet Report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-body">
                        <?php echo form_open('accounting/areports/balance_sheet') ?>
                        <div class="form-group row fy_id_mb">
                            <div class=" col-sm-3">
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
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('balance_sheet') ?> </h4>
                        </div>
                    </div>
                    <div class="panel-body" id="printableArea">
                        <div class="form-group row g_l_date_range">
                            <div class="col-sm-12">
                                <h3 class="g_v_h_date_range text-center"><?php echo $dateRange; ?></h3>
                            </div>
                        </div>
                        <div id="purchase_div">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th><?php echo display('Particulars') ?></th>
                                            <th><?php echo display('amount') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <!-- start asset -->
                                        <tr>
                                            <td align="left" class="paddingleft10px"> <strong>Assets</strong></td>
                                            <td align="center" class="cashflowamnt"></td>
                                        </tr>
                                        <?php
                                        $total_a_bal = 0;
                                        foreach ($fixed_assets as $assets) {
                                        ?>
                                        <tr>
                                            <td align="left" class=" paddingleft10px tdpl">
                                                <?php echo html_escape($assets['HeadName']); ?></td>
                                            <td align="center" class="cashflowamnt">
                                                <?php $total_a_bal += $assets['balance'];
                                                    echo floatval($assets['balance']); ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td align="right" class="paddingleft10px"><strong>Total Assets:</strong>
                                            </td>
                                            <td align="center" class="cashflowamnt"><strong>
                                                    <?php echo html_escape($total_a_bal) ?>
                                                </strong></td>
                                        </tr>
                                        <!-- end asset -->

                                        <!-- start liabilities -->
                                        <tr>
                                            <td align="left" class="paddingleft10px"> <strong>Liabilities</strong></td>
                                            <td align="center" class="cashflowamnt"></td>
                                        </tr>
                                        <?php
                                        $total_l_bal = 0;
                                        foreach ($liabilities as $liability) {
                                        ?>
                                        <tr>
                                            <td align="left" class="paddingleft10px tdpl">
                                                <?php echo html_escape($liability['HeadName']); ?></td>
                                            <td align="center" class="cashflowamnt">
                                                <?php $total_l_bal += (@$liability['balance'] ? @$liability['balance'] : 0);
                                                    echo floatval(@$liability['balance']); ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td align="left" class="paddingleft10px tdpl">
                                                <strong>Owners Equity</strong>
                                            </td>
                                            <td align="center" class="cashflowamnt">
                                                <?php echo html_escape($owners_equity) ?></td>
                                        </tr>
                                        <tr>
                                            <td align="left" class="paddingleft10px tdpl2">
                                                Incomes
                                            </td>
                                            <td align="center" class="cashflowamnt"><?php echo html_escape($incomes); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" class="paddingleft10px tdpl2">
                                                Expenses
                                            </td>
                                            <td align="center" class="cashflowamnt">
                                                <?php echo html_escape($expenses); ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right" class="paddingleft10px"><strong>Total
                                                    Liabilities:</strong></td>
                                            <td align="center" class="cashflowamnt">
                                                <strong><?php echo ($total_l_bal + ($incomes + $expenses) + $owners_equity) ?></strong>
                                            </td>
                                        </tr>
                                        <!-- end liabilities -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row g_l_date_range">
                        <div class="col-sm-12">
                            <div class="text-center" id="print">
                                <input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print"
                                    onclick="printPageDiv('printableArea')">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Balance Sheet Report -->
<?php $this->load->view('accounting/components/profit_loss_js') ?>