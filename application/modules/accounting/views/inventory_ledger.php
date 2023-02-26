<?php
include('Class/CConManager.php');
include('Class/CResult.php');
include('Class/CAccount.php');
include('Class/Ccommon.php');
?>

<?php
if (isset($_POST['btnSave'])) {

    $oAccount = new CAccount();
    $oResult = new CResult();
    $HeadCode = 10107;
    $HeadName = $_POST['txtName'];
    $FromDate = $_POST['dtpFromDate'];
    $ToDate = $_POST['dtpToDate'];


    $sql = $this->account_model->inventoryledger_firstqury($FromDate, $HeadCode);

    $oResult = $oAccount->SqlQuery($sql);
    $PreBalance = 0;

    if ($oResult->num_rows > 0) {
        $PreBalance = $oResult->row['Debit'];
        $PreBalance = $PreBalance - $oResult->row['Credit'];
    }

    $sql = $this->account_model->inventoryledger_secondqury($FromDate, $HeadCode, $ToDate);
    $oResult = $oAccount->SqlQuery($sql);
}
?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">

            <div class="panel-body">

                <?php echo form_open('', 'name="form1" id="form1" class="form-inline"') ?>

                <input type="hidden" id="txtName" name="txtName" />
                <label class="select"><?php echo display('from_date') ?><span class="text-danger">*</span></label>
                <input type="text" name="dtpFromDate"
                    value="<?php echo (!empty($FromDate) ? $FromDate : date('Y-m-d')) ?>"
                    placeholder="<?php echo display('from_date') ?>" class="datepicker form-control" required="">
                <label class="select"><?php echo display('to_date') ?><span class="text-danger">*</span></label>
                <input type="text" name="dtpToDate" value="<?php echo (!empty($ToDate) ? $ToDate : date('Y-m-d')) ?>"
                    placeholder="<?php echo display('to_date') ?>" class="datepicker form-control" required="">
                <button type="submit" name="btnSave" class="btn btn-success"><?php echo display('find') ?></button>
                <input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print"
                    onclick="printDiv('printArea');" />

                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-body" id="printArea">
                    <tr align="center">
                        <td id="ReportName"><b><?php echo display('bank_book_voucher') ?></b></td>
                    </tr>
                    <div class="">
                        <table class="print-table" width="100%">

                            <tr>
                                <td align="left" class="print-table-tr">
                                    <img src="<?php echo base_url() . (!empty($setting->logo) ? $setting->logo : 'assets/img/icons/default.jpg'); ?>"
                                        alt="logo">
                                </td>
                                <td align="center" class="print-cominfo">
                                    <span class="company-txt">
                                        <?php echo html_escape($company_info[0]['company_name']); ?>

                                    </span><br>
                                    <?php echo html_escape($company_info[0]['address']); ?>
                                    <br>
                                    <?php echo html_escape($company_info[0]['email']); ?>
                                    <br>
                                    <?php echo html_escape($company_info[0]['mobile']); ?>

                                </td>

                                <td align="right" class="print-table-tr">
                                    <date>
                                        <?php echo display('date') ?>: <?php echo date('d-M-Y'); ?>
                                    </date>
                                </td>
                            </tr>

                        </table>
                        <table width="100%" class="table table-stripped" cellpadding="6" cellspacing="1">
                            <caption class="text-center">
                                <font size="+1">
                                    <strong>
                                        <?php echo display('inventory_ledger_report') ?>(<?php echo display('from') ?>
                                        <?php echo (!empty($HeadName) ? html_escape($HeadName) : '') ?>
                                        <?php echo display('on') ?>
                                        <?php echo (!empty($FromDate) ? html_escape($FromDate) : ''); ?>
                                        <?php echo display('to') ?>
                                        <?php echo (!empty($ToDate) ? html_escape($ToDate) : ''); ?>)</strong>
                                </font>
                            </caption>
                            <tr class="table_data">
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td colspan="2" align="right"><strong><?php echo display('opening_balance') ?></strong>
                                </td>
                                <td align="right">
                                    <?php echo number_format((!empty($PreBalance) ? $PreBalance : 0), 2, '.', ','); ?>
                                </td>
                            </tr>
                            <tr class="table_head">
                                <td height="25" align="center"><strong><?php echo display('sl') ?></strong></td>
                                <td align="center"><strong><?php echo display('date') ?></strong></td>
                                <td align="center"><strong><?php echo display('voucher_no') ?></strong></td>
                                <td align="center"><strong><?php echo display('type') ?></strong></td>
                                <td align="center"><strong><?php echo display('remark') ?></strong></td>
                                <td align="right"><strong><?php echo display('debit') ?></strong></td>
                                <td align="right"><strong><?php echo display('credit') ?></strong></td>
                                <td align="right"><strong><?php echo display('balance') ?></strong></td>
                            </tr>
                            <?php
                            $TotalCredit = 0;
                            $TotalDebit = 0;
                            $VNo = "";
                            $CountingNo = 1;
                            for ($i = 0; $i < (!empty($oResult->num_rows) ? $oResult->num_rows : 0); $i++) {
                                if ($i & 1)
                                    $bg = "#E7E0EE";
                                else
                                    $bg = "#FFFFFF";
                            ?>
                            <tr class="table_data">
                                <?php
                                    if ($VNo != $oResult->rows[$i]['VNo']) {
                                    ?>
                                <td height="25"><?php echo $CountingNo++; ?></td>
                                <td><?php echo substr($oResult->rows[$i]['VDate'], 0, 10); ?></td>
                                <td align="left">
                                    <?php
                                            echo $oResult->rows[$i]['VNo'];
                                            ?>
                                </td>
                                <td align="center">
                                    <?php
                                            echo trim($oResult->rows[$i]['Vtype']);
                                            ?>
                                </td>
                                <?php
                                        $VNo = $oResult->rows[$i]['VNo'];
                                    } else {
                                    ?>
                                <td colspan="4">&nbsp;</td>
                                <?php
                                    }
                                    ?>
                                <td align="center"><?php echo html_escape($oResult->rows[$i]['Narration']); ?></td>
                                <td align="right">
                                    <?php
                                        $TotalDebit += $oResult->rows[$i]['Debit'];
                                        $PreBalance += $oResult->rows[$i]['Debit'];
                                        echo number_format($oResult->rows[$i]['Debit'], 2, '.', ',');
                                        ?>
                                </td>
                                <td align="right">
                                    <?php
                                        $TotalCredit += $oResult->rows[$i]['Credit'];
                                        $PreBalance -= $oResult->rows[$i]['Credit'];
                                        echo number_format($oResult->rows[$i]['Credit'], 2, '.', ',');
                                        ?>
                                </td>
                                <td align="right"><?php printf("%.2f", $PreBalance); ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                            <tr class="table_data print-footercolor">
                                <td align="center" bgcolor="green">&nbsp;</td>
                                <td align="center" bgcolor="green">&nbsp;</td>
                                <td align="center" bgcolor="green">&nbsp;</td>
                                <td align="center" bgcolor="green">&nbsp;</td>
                                <td align="right" bgcolor="green">
                                    <strong>Total</strong>
                                </td>
                                <td align="right" bgcolor="green">
                                    <?php echo number_format($TotalDebit, 2, '.', ','); ?>
                                </td>
                                <td align="right" bgcolor="green">
                                    <?php echo number_format($TotalCredit, 2, '.', ','); ?>
                                </td>
                                <td align="right" bgcolor="green">
                                    <?php echo number_format((!empty($PreBalance) ? $PreBalance : 0), 2, '.', ','); ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>