<script src="<?php echo MOD_URL . 'dashboard/assets/js/print.js'; ?>"></script>
<!-- Daterange picker -->
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
                        <div class="form-group row" style="margin-bottom: 0px;">
                            <div class="col-sm-3">
                                <input type="text" name="date_range" class="form-control reportrange1"
                                    autocomplete="off" placeholder="Select Date">
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group" style="margin-top: 5px;">
                                    <input type="checkbox" id="chkIsTransction" name="chkIsTransction" size="40">
                                    <label for="chkIsTransction">With Details</label>
                                </div>
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
                                            <th><?php echo display('account_code') ?></th>
                                            <th><?php echo display('account_name') ?></th>
                                            <th><?php echo display('opening_balance') ?></th>
                                            <th><?php echo display('debit') ?></th>
                                            <th><?php echo display('credit') ?></th>
                                            <th><?php echo display('closing') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $TotalOpening = 0;
                                        $TotalCredit = 0;
                                        $TotalDebit = 0;
                                        $TotalClosing = 0;
                                        $k = 0;
                                        for ($i = 0; $i < count($oResultTr); $i++) {
                                            $COAID = $oResultTr[$i]['HeadCode'];
                                            $oResultTrial = $this->db->select('SUM(Debit) as Debit, SUM(Credit) as Credit')
                                                ->from('acc_transaction')
                                                ->where('IsAppove', 1)
                                                ->where("VDate >=", $dtpFromDate)
                                                ->where("VDate <=", $dtpToDate)
                                                ->like('COAID', $COAID)
                                                ->get()->row();
                                            $query = $this->db->select('sum(Debit) as predebit, sum(Credit) as precredit')
                                                ->from('acc_transaction')
                                                ->where('IsAppove', 1)
                                                ->where('VDate < ', $dtpFromDate)
                                                ->where('COAID', $COAID)
                                                ->get()
                                                ->row();
                                            $balance = $query->predebit - $query->precredit;
                                            $bg = $k & 1 ? "#FFFFFF" : "#E7E0EE";
                                            if ($oResultTrial->Credit != $oResultTrial->Debit) {
                                                $k++;
                                        ?>
                                        <tr class="table_data">
                                            <td align="left" bgcolor="<?php echo $bg; ?>">
                                                <a
                                                    href="javascript:"><?php echo html_escape($oResultTr[$i]['HeadCode']); ?></a>
                                            </td>
                                            <td align="left" bgcolor="<?php echo $bg; ?>">
                                                <?php echo html_escape($oResultTr[$i]['HeadName']); ?></td>
                                            <td align="right" bgcolor="<?php echo $bg; ?>">
                                                <?php
                                                        echo number_format($balance, 2);
                                                        $TotalOpening += $balance;
                                                        ?>
                                            </td>

                                            <?php
                                                    if ($oResultTrial->Debit > $oResultTrial->Credit) {
                                                    ?>
                                            <td align="right" bgcolor="<?php echo $bg; ?>">
                                                <?php
                                                            $TotalDebit += $oResultTrial->Debit - $oResultTrial->Credit;
                                                            echo number_format($oResultTrial->Debit - $oResultTrial->Credit, 2);
                                                            ?>
                                            </td>
                                            <td align="right" bgcolor="<?php echo $bg; ?>">
                                                <?php echo number_format('0.00', 2); ?>
                                            </td>
                                            <?php
                                                    } else {
                                                    ?>
                                            <td align="right" bgcolor="<?php echo $bg; ?>">
                                                <?php echo number_format('0.00', 2); ?></td>
                                            <td align="right" bgcolor="<?php echo $bg; ?>">
                                                <?php
                                                            $TotalCredit += $oResultTrial->Credit - $oResultTrial->Debit;
                                                            echo number_format($oResultTrial->Credit - $oResultTrial->Debit, 2);
                                                            ?>
                                            </td>
                                            <?php
                                                    }
                                                    ?>
                                            <td align="right" bgcolor="<?php echo $bg; ?>">
                                                <?php
                                                        $closing = ($balance + $oResultTrial->Debit) - $oResultTrial->Credit;
                                                        $TotalClosing += $closing;
                                                        echo number_format($closing, 2);
                                                        ?>
                                            </td>
                                        </tr>
                                        <?php   }
                                        } ?>

                                        <?php
                                        for ($i = 0; $i < count($oResultInEx); $i++) {
                                            $COAID = $oResultInEx[$i]['HeadCode'];
                                            $oResultTrial = $this->db->select('SUM(Debit) as Debit, SUM(Credit) as Credit')
                                                ->from('acc_transaction')
                                                ->where('IsAppove', 1)
                                                ->where("VDate >=", $dtpFromDate)
                                                ->where("VDate <=", $dtpToDate)
                                                ->like('COAID', $COAID)
                                                ->get()->row();
                                            $query1 = $this->db->select('sum(Debit) as predebit, sum(Credit) as precredit')
                                                ->from('acc_transaction')
                                                ->where('IsAppove', 1)
                                                ->where('VDate < ', $dtpFromDate)
                                                ->where('COAID', $COAID)
                                                ->get()
                                                ->row();
                                            $balance1 = $query1->predebit - $query1->precredit;
                                            $bg = $k & 1 ? "#FFFFFF" : "#E7E0EE";
                                            if ($oResultTrial->Credit != $oResultTrial->Debit) {
                                                $k++;
                                        ?>
                                        <tr class="table_data">
                                            <td align="center" bgcolor="<?php echo $bg; ?>">
                                                <a href="javascript:"><?php echo $oResultInEx[$i]['HeadCode']; ?></a>
                                            </td>
                                            <td align="center" bgcolor="<?php echo $bg; ?>">
                                                <?php echo html_escape($oResultInEx[$i]['HeadName']); ?>
                                            </td>
                                            <td align="right" bgcolor="<?php echo $bg; ?>">
                                                <?php echo number_format($balance1, 2);
                                                        $TotalOpening += $balance1; ?>
                                            </td>
                                            <?php
                                                    if ($oResultTrial->Debit > $oResultTrial->Credit) {
                                                    ?>
                                            <td align="right" bgcolor="<?php echo $bg; ?>">
                                                <?php
                                                            $TotalDebit += $oResultTrial->Debit - $oResultTrial->Credit;
                                                            echo number_format($oResultTrial->Debit - $oResultTrial->Credit, 2);
                                                            ?>
                                            </td>
                                            <td align="right" bgcolor="<?php echo $bg; ?>">
                                                <?php echo number_format('0.00', 2); ?>
                                            </td>
                                            <?php
                                                    } else {
                                                    ?>
                                            <td align="right" bgcolor="<?php echo $bg; ?>">
                                                <?php echo number_format('0.00', 2); ?></td>
                                            <td align="right" bgcolor="<?php echo $bg; ?>">
                                                <?php
                                                            $TotalCredit += $oResultTrial->Credit - $oResultTrial->Debit;
                                                            echo number_format($oResultTrial->Credit - $oResultTrial->Debit, 2);
                                                            ?>
                                            </td>
                                            <?php
                                                    }
                                                    ?>
                                            <td align="right" bgcolor="<?php echo $bg; ?>">
                                                <?php
                                                        $closingEx = ($balance1 + $oResultTrial->Debit) - $oResultTrial->Credit;
                                                        $TotalClosing += $closingEx;
                                                        echo number_format($closingEx, 2);
                                                        ?>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        } ?>

                                        <?php
                                        $ProfitLoss = $TotalDebit - $TotalCredit;
                                        if ($ProfitLoss != 0) { ?>
                                        <tr class="table_data">
                                            <td colspan="2" align="left" bgcolor="<?php echo $bg; ?>">&nbsp;</td>
                                            <td align="left" bgcolor="<?php echo $bg; ?>">Profit-Loss</td>
                                            <?php
                                        }
                                        if ($ProfitLoss < 0) { ?>
                                            <td align="right" bgcolor="<?php echo $bg; ?>">
                                                <?php
                                                    $TotalDebit += abs($ProfitLoss);
                                                    echo number_format(abs($ProfitLoss), 2);
                                                    ?>
                                            </td>
                                            <td align="right" bgcolor="<?php echo $bg; ?>">
                                                <?php echo number_format('0.00', 2); ?>
                                            </td>
                                            <?php
                                            echo "</tr>";
                                        } else if ($ProfitLoss > 0) { ?>
                                            <td align="right" bgcolor="<?php echo $bg; ?>">
                                                <?php echo number_format('0.00', 2); ?>
                                            </td>
                                            <td align="right" bgcolor="<?php echo $bg; ?>">
                                                <?php
                                                    $TotalCredit += abs($ProfitLoss);
                                                    echo number_format(abs($ProfitLoss), 2);
                                                    ?>
                                            </td>
                                            <?php
                                            echo "</tr>";
                                        }
                                            ?>
                                        <tr class="table_head">
                                            <td colspan="2" align="right">
                                                <strong><?php echo display('total') ?></strong>
                                            </td>
                                            <td align="right">
                                                <strong><?php echo number_format($TotalOpening, 2); ?></strong>
                                            </td>
                                            <td align="right">
                                                <strong><?php echo number_format($TotalDebit, 2); ?></strong>
                                            </td>
                                            <td align="right">
                                                <strong><?php echo number_format($TotalCredit, 2); ?></strong>
                                            </td>
                                            <td align="right">
                                                <strong><?php echo number_format($TotalClosing, 2); ?></strong>
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