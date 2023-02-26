<?php
include('Class/CConManager.php');
include('Class/Ccommon.php');
include('Class/CResult.php');
include('Class/CAccount.php');
?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-body" id="printArea">
                    <table class="print-table" width="100%">

                        <tr>
                            <td align="left" class="print-table-tr">
                                <img src="<?php echo base_url() . (!empty($setting->logo) ? $setting->logo : 'assets/img/icons/default.jpg'); ?>"
                                    alt="logo">
                            </td>
                            <td align="center" class="print-cominfo">
                                <span class="company-txt">
                                    <?php echo html_escape($company_info[0]['company_name']); ?>
                                </span>
                                <br>
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
                    <table class="table text-left" cellpadding="0" cellspacing="0" border="1px solid #000" width="100%">
                        <?php
                        $oResult = new CResult();
                        $oAccount = new CAccount();

                        $sql = "SELECT * FROM acc_coa WHERE IsActive=1 ORDER BY HeadCode";
                        $oResult = $oAccount->SqlQuery($sql);
                        for ($i = 0; $i < $oResult->num_rows; $i++) {
                            $sql = "SELECT MAX(HeadLevel) as MHL FROM acc_coa WHERE IsActive=1";
                            $oResultLevel = $oAccount->SqlQuery($sql);
                            $maxLevel = $oResultLevel->row['MHL'];

                            $HL = $oResult->rows[$i]['HeadLevel'];
                            $Level = $maxLevel + 1;
                            $HL1 = $Level - $HL;

                            echo '<tr>';
                            for ($j = 0; $j < $HL; $j++) {
                                echo '<td>&nbsp;</td>';
                            }
                            echo '<td>' . $oResult->rows[$i]['HeadCode'] . '</td>';
                            echo '<td colspan=' . $HL1 . '>' . $oResult->rows[$i]['HeadName'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                </div>
                <div class="text-center" id="print">
                    <input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print"
                        onclick="printDiv('printArea');" />
                </div>
            </div>
        </div>
    </div>
</div>