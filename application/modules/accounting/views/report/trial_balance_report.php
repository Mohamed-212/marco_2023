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
            <small><?php echo display('trial_balance_with_opening'); ?></small>
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
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('trial_balance') ?> </h4>
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
                                            <th class="text-center">Debit</th>
                                            <th class="text-center">Credit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="td1">
                                                <table class="table table-bordered table-striped table-hover">
                                                    <?php
                                                    if (!empty($a_e_closing)) {
                                                        $k = 0;
                                                        $total_a_e_closing = 0;
                                                        foreach ($a_e_closing as $key => $a_e_data) {
                                                            $bg = $k & 1 ? "#FFFFFF" : "#E7E0EE";
                                                            $k++;
                                                    ?>
                                                    <tr class="table_data">
                                                        <td align="left" bgcolor="<?php echo $bg; ?>">
                                                            <?php echo $a_e_data['HeadName'] ?></td>
                                                        <td align="right" bgcolor="<?php echo $bg; ?>">
                                                            <?php
                                                                    $op_credit = $this->db->Select('sum(Credit) as op_credit')->from('acc_transaction')->where('fy_id', $fy_id)->where('VNo', 'OP-' . $a_e_data['COAID'])->get()->row();
                                                                    $op_data = $this->db->Select('sum(amount)as amount')->from('acc_opening_balances')->where('fy_id', $fy_id)->where('headcode', $a_e_data['COAID'])->get()->row();
                                                                    if (!empty($op_data->amount)) {
                                                                        $op_bal = $op_data->amount;
                                                                    } else {
                                                                        $op_bal = 0;
                                                                    }
                                                                    $total_a_e_closing += $a_e_data['preclosing'] + $op_bal - ($op_credit->op_credit ? $op_credit->op_credit : 0);
                                                                    echo $a_e_data['preclosing'] + $op_bal - ($op_credit->op_credit ? $op_credit->op_credit : 0);
                                                                    ?>
                                                        </td>
                                                    </tr>
                                                    <?php   }
                                                    }
                                                    ?>
                                                </table>
                                            </td>
                                            <td class="td2">
                                                <table class="table table-bordered table-striped table-hover">

                                                    <?php if (!empty($l_i_closing)) {
                                                        $total_l_i_closing = 0;
                                                        $k = 0;
                                                        foreach ($l_i_closing as $key => $l_i_data) {
                                                            $bg = $k & 1 ? "#FFFFFF" : "#E7E0EE";
                                                            $k++;
                                                    ?>
                                                    <tr class="table_data">
                                                        <td align="left" bgcolor="<?php echo $bg; ?>">
                                                            <?php echo html_escape($l_i_data['HeadName']) ?></td>
                                                        <td align="right" bgcolor="<?php echo $bg; ?>">
                                                            <?php
                                                                    $op_credit = $this->db->Select('sum(Credit) as op_credit')->from('acc_transaction')->where('fy_id', $fy_id)->where('VNo', 'OP-' . $l_i_data['COAID'])->get()->row();
                                                                    $op_data = $this->db->Select('sum(amount)as amount')->from('acc_opening_balances')->where('fy_id', $fy_id)->where('headcode', $l_i_data['COAID'])->get()->row();
                                                                    if (!empty($op_data->amount)) {
                                                                        $op_bal = $op_data->amount;
                                                                    } else {
                                                                        $op_bal = 0;
                                                                    }
                                                                    $total_l_i_closing += $l_i_data['preclosing'] + $op_bal - ($op_credit->op_credit ? $op_credit->op_credit : 0);
                                                                    echo $l_i_data['preclosing'] + $op_bal - ($op_credit->op_credit ? $op_credit->op_credit : 0);
                                                                    ?>
                                                        </td>
                                                    </tr>
                                                    <?php }
                                                    } ?>

                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table class="table table-bordered table-striped table-hover">
                                                    <tr>
                                                        <td align="right" bgcolor="#E7E0EE"><strong>Total: </strong>
                                                        </td>
                                                        <td align="right" bgcolor="#E7E0EE">
                                                            <?php echo !empty($a_e_closing) ? $total_a_e_closing : 0; ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table class="table table-bordered table-striped table-hover">
                                                    <tr>
                                                        <td align="right" bgcolor="#E7E0EE">
                                                            <strong>Total: </strong>
                                                        </td>
                                                        <td align="right" bgcolor="#E7E0EE">
                                                            <?php echo !empty($l_i_closing) ? $total_l_i_closing : 0; ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group row signature_row">
                            <div class="col-sm-4">
                                <p class="g_v_h_date_range text-center"><?php echo display('prepared_by') ?></p>
                            </div>
                            <div class="col-sm-4">
                                <p class="g_v_h_date_range text-center"><?php echo display('accounts') ?></p>
                            </div>
                            <div class="col-sm-4">
                                <p class="g_v_h_date_range text-center"><?php echo display('chairman') ?></p>
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
<!-- General Ledger Report End -->
<?php $this->load->view('accounting/components/profit_loss_js') ?>