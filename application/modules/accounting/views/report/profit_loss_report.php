<script src="<?php echo MOD_URL . 'dashboard/assets/js/print.js'; ?>"></script>
<!-- Daterange picker -->
<link href="<?php echo MOD_URL . 'accounting/assets/css/daterangepicker.css'; ?> ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo MOD_URL . 'accounting/assets/css/profit_loss.css'; ?> ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo MOD_URL . 'accounting/assets/js/moment.min.js'; ?>" type="text/javascript"></script>
<script src="<?php echo MOD_URL . 'accounting/assets/js/daterangepicker.js' ?>" type="text/javascript"></script>
<script src="<?php echo MOD_URL . 'accounting/assets/js/daterangepicker.active.js'; ?>" type="text/javascript"></script>


<!-- Sales Report Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon"><i class="pe-7s-note2"></i></div>
        <div class="header-title">
            <h1><?php echo display('profit_loss') ?></h1>
            <small><?php echo display('profit_loss_report') ?></small>
            <ol class="breadcrumb">
                <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('report') ?></a></li>
                <li class="active"><?php echo display('profit_loss_report') ?></li>
            </ol>
        </div>
    </section>
    <section class="content">
        <!-- profit Loss Report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-body">
                        <?php echo form_open('accounting/areports/profitLossReoprt') ?>
                        <div class="form-group row fy_id_mb">
                            <div class="col-sm-3">
                                <select name="fy_id" id="fy_id" class="form-control">
                                    <option value=""></option>
                                    <?php foreach ($fiscal_year_list as $fiscal_year) { ?>
                                    <option value="<?php echo html_escape($fiscal_year->id); ?>"
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
                            <h4><?php echo display('profit_loss_report') ?> </h4>
                        </div>
                    </div>
                    <div class="panel-body" id="printableArea">
                        <div class="form-group row g_l_date_range">
                            <div class="col-sm-12">
                                <h3 class="g_v_h_date_range text-center"><?php echo html_escape($dateRange); ?></h3>
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
                                        <?php
                                        $total_expense = 0;
                                        $total_income = 0;
                                        foreach ($incomes as $incomelable) {
                                            $income_balance = $this->reports_model->income_balance($incomelable['HeadCode'], $from_date, $to_date, $fy_id);


                                        ?>

                                        <tr>
                                            <td align="left" class="paddingleft10px">
                                                <?php echo html_escape($incomelable['HeadName']); ?></td>

                                            <td align="right" class="cashflowamnt">
                                                <?php
                                                    if ($income_balance[0]['balance'] != 0) {
                                                        echo html_escape(abs($income_balance[0]['balance']));
                                                        $total_income += $income_balance[0]['balance'];
                                                    }
                                                    ?>
                                            </td>
                                        </tr>

                                        <?php

                                            $inc_head_current = $this->reports_model->get_all_child($incomelable['HeadCode']);
                                            foreach ($inc_head_current as $incChHead) {
                                                $second_balance = $this->reports_model->income_balance($incChHead['HeadCode'], $from_date, $to_date, $fy_id);
                                                if ($second_balance[0]['balance'] != 0) {
                                            ?>
                                        <tr>
                                            <td class="tdml" align="left"
                                                class="paddingleft10px balancesheet_head pl-2">&nbsp;&nbsp;&nbsp;&nbsp;
                                                <?php echo html_escape($incChHead['HeadName']); ?></td>
                                            <td align="right" class="cashflowamnt">
                                                <?php echo html_escape(abs($second_balance[0]['balance']));
                                                            $total_income += $second_balance[0]['balance'];
                                                            ?>
                                            </td>
                                        </tr>
                                        <?php }
                                            }
                                        } ?>
                                        <tr>
                                            <td class="paddingleft10px text-right paddingright10px">
                                                <b><?php echo display('total') ?> <?php echo display('income'); ?></b>
                                            </td>
                                            <td align="right" class="cashflowamnt cashflowamnt_border">
                                                <b><?php $incm = abs($total_income);
                                                    echo number_format($incm, 2); ?></b>
                                            </td>
                                        </tr>
                                        <?php
                                        foreach ($expenses as $expense) {
                                            $expense_balance = $this->reports_model->income_balance($expense['HeadCode'], $from_date, $to_date, $fy_id);

                                        ?>
                                        <tr>
                                            <td align="left" class="paddingleft10px balancesheet_head">
                                                <?php echo html_escape($expense['HeadName']); ?></td>
                                            <td align="right" class="cashflowamnt">
                                                <?php
                                                    if ($expense_balance[0]['balance'] != 0) {
                                                        echo abs($expense_balance[0]['balance']);
                                                        $total_expense += $expense_balance[0]['balance'];
                                                    }

                                                    ?>
                                            </td>
                                        </tr>
                                        <?php

                                            $ex_child_head = $this->reports_model->get_all_child($expense['HeadCode']);
                                            if (!empty($ex_child_head)) {
                                                foreach ($ex_child_head as $value) {
                                                    $second_balance = $this->reports_model->income_balance($value['HeadCode'], $from_date, $to_date, $fy_id);
                                                    if ($second_balance[0]['balance'] != 0) {
                                            ?>
                                        <tr>
                                            <td align="left"
                                                class="paddingleft10px balancesheet_head balancesheet_style">
                                                &nbsp;&nbsp;&nbsp;&nbsp;<?php echo html_escape($value['HeadName']); ?>
                                            </td>
                                            <td align="right" class="cashflowamnt">
                                                <?php
                                                                echo abs($second_balance[0]['balance']);
                                                                $total_expense += $second_balance[0]['balance'];
                                                                ?>
                                            </td>
                                        </tr>
                                        <?php }
                                                }
                                            }
                                        } ?>
                                        <tr>
                                            <td class="paddingleft10px text-right paddingright10px">
                                                <b><?php echo display('total') ?></b>
                                            </td>
                                            <td align="right" class="cashflowamnt cashflowamnt_border">
                                                <b><?php $exp = abs($total_expense);
                                                    echo number_format($exp, 2); ?></b>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <?php
                                            $profit = ($incm - $exp);
                                            if ($profit > 0) {
                                            ?>
                                            <td class="paddingleft10px text-right paddingright10px">
                                                <b><?php echo display('profit'); ?></b>
                                            </td>
                                            <td align="right" class="cashflowamnt cashflowamnt_border">
                                                <b><?php echo abs($profit); ?></b>
                                            </td>
                                            <?php } else { ?>
                                            <td><?php echo display('loss'); ?></td>
                                            <td align="right" class="cashflowamnt cashflowamnt_border">
                                                <b><?php echo abs($profit); ?></b>
                                            </td>
                                            <?php } ?>
                                        </tr>

                                    </tfoot>
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
<!-- profit Loss Report End -->
<?php $this->load->view('accounting/components/profit_loss_js') ?>