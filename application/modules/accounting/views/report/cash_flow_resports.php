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
            <h1><?php echo display('cash_flow_statement') ?></h1>
            <small><?php echo display('cash_flow_statement') ?></small>
            <ol class="breadcrumb">
                <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('accounts') ?></a></li>
                <li><a href="#"><?php echo display('account_reports') ?></a></li>
                <li class="active"><?php echo display('cash_flow_statement') ?></li>
            </ol>
        </div>
    </section>
    <section class="content">
        <!-- General Ledger report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-body">
                        <?php echo form_open('accounting/areports/cashFlowResports') ?>
                        <div class="form-group row" style="margin-bottom: 0px;">
                            <div class="col-sm-3">
                                <input type="text" name="date_range" class="form-control reportrange1"
                                    autocomplete="off" placeholder="Select Date">
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
                            <h4><?php echo display('cash_flow_statement') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body" id="printableArea">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="g_l_date_range">
                                    <div class="col-md-12 text-right">
                                        <address>
                                            <strong><?php echo html_escape($company_info[0]['company_name']); ?></strong><br>
                                            <?php echo html_escape($company_info[0]['email']); ?>
                                        </address>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="g_l_date_range">
                                    <div class="col-sm-12">
                                        <h3 class="g_v_h_date_range text-center">
                                            <?php echo date('F d, Y', strtotime($dtpFromDate)); ?> -
                                            <?php echo date('F d, Y', strtotime($dtpToDate)); ?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
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
                                                <tr class="table_head">
                                                    <td colspan="3" class="paddingleft10px">
                                                        <strong><?php echo display('opening_cash_and_equivalent'); ?>:</strong>
                                                    </td>
                                                </tr>

                                                <?php
												$this->load->model('accounting/reports_model');
												$sql = $this->reports_model->cashflow_firstquery();
												$sql = $this->db->query($sql);
												$oResultAsset = $sql->result_array();
												$TotalOpening = 0;
												$transIdss = '';
												for ($i = 0; $i < count($oResultAsset); $i++) {
													$COAID = $oResultAsset[$i]['HeadCode'];
													$sql = $this->reports_model->cashflow_secondquery($dtpFromDate, $dtpToDate, $COAID);
													$sql1 = $this->db->query($sql);
													$oResultAmountPre = $sql1->row();

													if ($oResultAmountPre->Amount != 0) {


												?>
                                                <tr class="clickable-row viewTrans" data-ids="">
                                                    <td align="left" class="paddingleft10px">
                                                        <?php echo html_escape($oResultAsset[$i]['HeadName']); ?></td>
                                                    <td>&nbsp;</td>
                                                    <td align="right"
                                                        class="cashflowamnt <?php if ($TotalOpening == 0) echo 'footersignature' ?>">
                                                        <?php
																$Total = $oResultAmountPre->Amount;
																echo number_format($Total, 2);
																$TotalOpening += $Total;
																?>
                                                    </td>
                                                </tr>
                                                <?php
													}
												}   ?>

                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td class="footersignature">&nbsp;</td>
                                                </tr>

                                                <tr>
                                                    <td align="left" class="paddingleftright10">
                                                        <strong><?php echo display('Total_Opening_Cash_&_Cash Equivalent'); ?></strong>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td align="right" class="totalopeninig">
                                                        <strong><?php echo number_format($TotalOpening); ?></strong>
                                                    </td>
                                                </tr>
                                                <tr class="table_head">
                                                    <td colspan="3" class="padddingwithunderline"><b>Cashflow from
                                                            Operating Activities</b></td>
                                                </tr>

                                                <?php
												$TotalCurrAsset = 0;
												$sql = $this->reports_model->cashflow_thirdquery();

												$sql2 = $this->db->query($sql);
												$oResultCurrAsset = $sql2->result();

												for ($s = 0; $s < count($oResultCurrAsset); $s++) {
													$COAID = $oResultCurrAsset[$s]->HeadCode;
													$sql = $this->reports_model->cashflow_forthquery($dtpFromDate, $dtpToDate, $COAID);

													$sql3 = $this->db->query($sql);
													$oResultAmount = $sql3->row();

													if ($oResultAmount->Amount != 0) {
												?>
                                                <tr>
                                                    <td align="left" class="paddingleft10px">
                                                        <?php echo html_escape($oResultCurrAsset[$s]->HeadName); ?></td>
                                                    <td>&nbsp;</td>
                                                    <td align="right"
                                                        class="cashflowamnt <?php if ($TotalCurrAsset == 0) echo 'footersignature' ?>">
                                                        <?php
																$Total = $oResultAmount->Amount;
																echo number_format($Total);
																$TotalCurrAsset += $Total;
																?>
                                                    </td>
                                                </tr>

                                                <?php
													}
												}
												$sql = $this->reports_model->cashflow_fifthquery($dtpFromDate, $dtpToDate, $COAID);

												$sql4 = $this->db->query($sql);
												$oResultAmount = $sql4->row();

												if ($oResultAmount->Amount != 0) {
													?>
                                                <tr>
                                                    <td align="left" class="paddingleft10px">Payment for Other Operating
                                                        Activities</td>
                                                    <td>&nbsp;</td>
                                                    <td align="right" class="cashflowamnt">
                                                        <?php
															$Total = $oResultAmount->Amount;
															echo number_format($Total, 2);
															$TotalCurrAsset += $Total;
															?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td class="footersignature">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" class="paddingleftright10">
                                                        <strong>Cash generated from Operating Activites before Changing
                                                            in Opereating Activities</strong>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td align="right" class="totalopeninig">
                                                        <strong><?php echo number_format($TotalCurrAsset); ?></strong>
                                                    </td>
                                                </tr>
                                                <tr class="table_head">
                                                    <td colspan="3" class="padddingwithunderline">
                                                        <b>Cashflow from Non Operating Activities</b>
                                                    </td>
                                                </tr>
                                                <?php
												$TotalCurrAssetNon = 0;
												$sql = $this->reports_model->cashflow_sixthquery();

												$sql5 = $this->db->query($sql);
												$oResultCurrAsset = $sql5->result();

												for ($s = 0; $s < count($oResultCurrAsset); $s++) {
													$COAID = $oResultCurrAsset[$s]->HeadCode;
													$sql = $this->reports_model->cashflow_seventhquery($dtpFromDate, $dtpToDate, $COAID);

													$sql6 = $this->db->query($sql);
													$oResultAmount = $sql6->row();

													if ($oResultAmount->Amount != 0) {
												?>
                                                <tr>
                                                    <td align="left" class="paddingleft10px">
                                                        <?php echo html_escape($oResultCurrAsset[$s]->HeadName); ?></td>
                                                    <td>&nbsp;</td>
                                                    <td align="right"
                                                        class="cashflowamnt <?php if ($TotalCurrAssetNon == 0) echo 'footersignature' ?>">
                                                        <?php
																$Total = $oResultAmount->Amount;
																echo number_format($Total);
																$TotalCurrAssetNon += $Total;
																?>
                                                    </td>
                                                </tr>
                                                <?php
													}
												}
												?>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td class="footersignature">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" class="paddingleftright10"><strong>Cash generated
                                                            from Non Operating Activites before Changing in Opereating
                                                            Assets &amp; Liabilities</strong></td>
                                                    <td>&nbsp;</td>
                                                    <td align="right" class="totalopeninig">
                                                        <strong><?php echo number_format($TotalCurrAssetNon); ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr class="table_head">
                                                    <td align="left" class="paddingleftright10">
                                                        <strong>Increase/Decrease in Operating Assets &amp;
                                                            Liabilites</strong>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td align="right" class="pddingright10">&nbsp;</td>
                                                </tr>
                                                <?php
												$TotalCurrLiab = 0;
												$sql = "SELECT * FROM acc_coa WHERE IsGL=1 AND HeadCode LIKE '20101%' AND HeadCode!=20101 AND IsActive=1";

												$sql6 = $this->db->query($sql);
												$oResultLiab = $sql6->result();

												for ($t = 0; $t < count($oResultLiab); $t++) {
													$COAID = $oResultLiab[$t]->HeadCode;
													$sql = "SELECT SUM(acc_transaction.Credit)-SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '" . $dtpFromDate . "' AND '" . $dtpToDate . "' AND COAID LIKE '$COAID%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '1020101%')";
													$oResultAmount = $oAccount->SqlQuery($sql);
													$sql7 = $this->Db->query($sql);
													$oResultAmount = $sql7->row();
													if ($oResultAmount->Amount != 0) {
												?>
                                                <tr>
                                                    <td align="left" class="paddingleft10px">
                                                        <?php echo html_escape($oResultLiab[$t]->HeadName); ?></td>
                                                    <td>&nbsp;</td>
                                                    <td align="right"
                                                        class="cashflowamnt <?php if ($TotalCurrLiab == 0) echo 'footersignature' ?>">
                                                        <?php
																$Total = $oResultAmount->Amount;
																echo number_format($Total);
																$TotalCurrLiab += $Total;
																?>
                                                    </td>
                                                </tr>
                                                <?php
													}
												}
												?>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td class="footersignature">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" class="paddingleftright10"><strong>Total
                                                            Increase/Decrease</strong></td>
                                                    <td>&nbsp;</td>
                                                    <td align="right" class="totalopeninig">
                                                        <strong><?php echo number_format($TotalCurrLiab); ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" class="paddingleftright10"><strong>Net Cash From
                                                            Operating/Non Operating Activities</strong></td>
                                                    <td>&nbsp;</td>
                                                    <td align="right" class="totalopeninig">
                                                        <strong><?php echo number_format($TotalCurrAsset + $TotalCurrAssetNon + $TotalCurrLiab); ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr class="table_head">
                                                    <td colspan="3" class="padddingwithunderline"><b>Cash Flow from
                                                            Investing Activities</b></td>
                                                </tr>
                                                <?php
												$TotalNonCurrAsset = 0;
												$sql = "SELECT * FROM acc_coa WHERE IsGL=1 AND HeadCode LIKE '101%' AND HeadCode!=101 AND IsActive=1";

												$sql9 = $this->db->query($sql);
												$oResultNonCurrAsset = $sql9->result();

												for ($t = 0; $t < count($oResultNonCurrAsset); $t++) {
													$COAID = $oResultNonCurrAsset[$t]->HeadCode;
													$sql = "SELECT SUM(acc_transaction.Debit)-SUM(acc_transaction.Credit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '" . $dtpFromDate . "' AND '" . $dtpToDate . "' AND COAID LIKE '$COAID%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '1020101%')";
													$sql8 = $this->db->query($sql);
													$oResultAmount = $sql8->row();
													if ($oResultAmount->Amount != 0) {
												?>
                                                <tr>
                                                    <td align="left" class="paddingleft10px">
                                                        <?php echo html_escape($oResultNonCurrAsset[$t]->HeadName); ?>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td align="right"
                                                        class="cashflowamnt <?php if ($TotalNonCurrAsset == 0) echo 'footersignature' ?>">
                                                        <?php
																$Total = $oResultAmount->Amount;
																echo number_format($Total, 2);
																$TotalNonCurrAsset += $Total;
																?>
                                                    </td>
                                                </tr>
                                                <?php
													}
												}
												?>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td class="footersignature">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" class="paddingleftright10"><strong>Net Cash Used
                                                            Investing Activities</strong></td>
                                                    <td>&nbsp;</td>
                                                    <td align="right" class="noncurcss">
                                                        <strong><?php echo number_format($TotalNonCurrAsset); ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr class="table_head">
                                                    <td colspan="3" class="padddingwithunderline"><b>Cash Flow from
                                                            Financing Activities</b></td>
                                                </tr>
                                                <?php
												$TotalNonCurrLiab = 0;
												$sql = "SELECT * FROM acc_coa WHERE IsGL=1 AND HeadCode LIKE '20102%' AND IsActive=1";

												$sql10 = $this->db->query($sql);
												$oResultNonCurrLiab = $sql10->result();

												for ($t = 0; $t < count($oResultNonCurrLiab); $t++) {
													$COAID = $oResultNonCurrLiab[$t]->HeadCode;

													$sql = "SELECT SUM(acc_transaction.Credit)-SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '" . $dtpFromDate . "' AND '" . $dtpToDate . "' AND COAID LIKE '$COAID%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '1020101%')";

													$sql11 = $this->db->query($sql);
													$oResultAmount = $sql11->row();

													if ($oResultAmount->Amount != 0) {
												?>
                                                <tr>
                                                    <td align="left" class="paddingleft10px">
                                                        <?php echo html_escape($oResultNonCurrLiab[$t]->HeadName); ?>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td align="right"
                                                        class="cashflowamnt <?php if ($TotalNonCurrLiab == 0) echo 'footersignature' ?>">
                                                        <?php
																$Total = $oResultAmount->Amount;
																echo number_format($Total);
																$TotalNonCurrLiab += $Total;
																?>
                                                    </td>
                                                </tr>
                                                <?php
													}
												}
												?>
                                                <?php
												$TotalFund = 0;
												$sql = "SELECT * FROM acc_coa WHERE IsGL=1 AND HeadCode LIKE '202%' AND IsActive=1";

												$sql12 = $this->db->query($sql);
												$oResultFund = $sql12->result();
												for ($t = 0; $t < count($oResultFund); $t++) {
													$COAID = $oResultFund[$t]->HeadCode;

													$sql = "SELECT SUM(acc_transaction.Credit)-SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '" . $dtpFromDate . "' AND '" . $dtpToDate . "' AND COAID LIKE '$COAID%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '1020101%')";

													$sql13 = $this->db->query($sql);
													$oResultAmount = $sql13->row();

													if ($oResultAmount->Amount != 0) {
												?>
                                                <tr>
                                                    <td align="left" class="paddingleft10px">
                                                        <?php echo html_escape($oResultFund[$t]->HeadName); ?></td>
                                                    <td>&nbsp;</td>
                                                    <td align="right" class="cashflowamnt">
                                                        <?php
																$Total = $oResultAmount->Amount;
																echo number_format($Total, 2);
																$TotalFund += $Total;
																?>
                                                    </td>
                                                </tr>
                                                <?php
													}
												}
												?>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td class="footersignature">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" class="paddingleftright10"><strong>Net Cash Used
                                                            Financing Activities</strong></td>
                                                    <td>&nbsp;</td>
                                                    <td align="right" class="cashflowamnt">
                                                        <strong><?php echo number_format($TotalFund + $TotalNonCurrLiab); ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" class="paddingleft10px"><strong>Net Cash
                                                            Inflow/Outflow (Profit Loss
                                                            <?php echo number_format($TotalCurrAsset + $TotalCurrAssetNon + $TotalCurrLiab + $TotalNonCurrAsset + $TotalFund + $TotalNonCurrLiab); ?>)</strong>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td align="right" class="totalopeninig">
                                                        <strong><?php echo number_format($TotalCurrAsset + $TotalCurrAssetNon + $TotalCurrLiab + $TotalNonCurrAsset + $TotalFund + $TotalNonCurrLiab + $TotalOpening); ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr class="table_head">
                                                    <td colspan="3" class="paddingleft10px"><strong>Closing Cash & Cash
                                                            Equivalent:</strong></td>
                                                </tr>
                                                <?php
												$sql = "SELECT * FROM acc_coa WHERE acc_coa.IsTransaction=1 AND acc_coa.HeadType='A' AND acc_coa.IsActive=1 AND acc_coa.HeadCode LIKE '1020101%' ";

												$sql14 = $this->db->query($sql);
												$oResultAsset = $sql14->result();

												$TotalAsset = 0;
												for ($i = 0; $i < count($oResultAsset); $i++) {
													$COAID = $oResultAsset[$i]->HeadCode;
													$sql = "SELECT SUM(acc_transaction.Debit)- SUM(acc_transaction.Credit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove =1 AND VDate BETWEEN  '" . $dtpFromDate . "' AND '" . $dtpToDate . "' AND COAID LIKE '$COAID%'";

													$sql15 = $this->db->query($sql);
													$oResultAmount = $sql15->row();

													if ($oResultAmount->Amount != 0) {
												?>
                                                <tr>
                                                    <td align="left" class="paddingleft10px">
                                                        <?php echo html_escape($oResultAsset[$i]->HeadName); ?></td>
                                                    <td>&nbsp;</td>
                                                    <td align="right"
                                                        class="cashflowamnt <?php if ($TotalAsset == 0) echo 'footersignature' ?>">
                                                        <?php
																$Total = $oResultAmount->Amount;
																echo number_format($Total);
																$TotalAsset += $Total;
																?>
                                                    </td>
                                                </tr>
                                                <?php
													}
												}
												?>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td class="footersignature">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" class="paddingleftright10"><strong>Total Closing
                                                            Cash & Cash Equivalent</strong></td>
                                                    <td>&nbsp;</td>
                                                    <td align="right" class="totalopeninig">
                                                        <strong><?php echo number_format($TotalAsset); ?></strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="signature_row">
                                    <div class="col-sm-3">
                                        <p class="g_v_h_date_range text-center"><?php echo display('prepared_by') ?></p>
                                    </div>
                                    <div class="col-sm-3">
                                        <p class="g_v_h_date_range text-center"><?php echo display('accounts') ?></p>
                                    </div>
                                    <div class="col-sm-3">
                                        <p class="g_v_h_date_range text-center">
                                            <?php echo display('authorized_signature') ?></p>
                                    </div>
                                    <div class="col-sm-3">
                                        <p class="g_v_h_date_range text-center"><?php echo display('chairman') ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="g_l_date_range">
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