<?php
class CResult
{
    public $row;
    public $rows;
    public $num_rows;
    public $effected_row;
    public $message;
    public $error;
    public $IsSucess;
    public function __construct()
    {
        $this->IsSucess = FALSE;
        $this->effected_row = 0;
        $this->rows = array();
    }
};
?>
<?php
class CConManager
{
    private $conn;
    public function __construct()
    {
        $CI = &get_instance();
        $this->conn = mysqli_connect($CI->db->hostname, $CI->db->username, $CI->db->password, $CI->db->database) or die("Unable to Connect: " . mysqli_connect_error());
    }
    public function Open()
    {
        mysqli_query($this->conn, "SET NAMES 'utf8'");
        mysqli_query($this->conn, "SET CHARACTER SET utf8");
        mysqli_query($this->conn, "SET CHARACTER_SET_CONNECTION=utf8");
        mysqli_query($this->conn, "SET SQL_MODE = ''");
        return TRUE;
    }

    public function getLastId()
    {
        return mysqli_insert_id($this->conn);
    }

    public function query($sql)
    {
        try {
            $resource = mysqli_query($this->conn, $sql);
            if ($resource) {
                if ($resource instanceof mysqli_result) {
                    $i = 0;
                    $data = array();
                    while ($result = mysqli_fetch_assoc($resource)) {
                        $data[$i] = $result;
                        $i++;
                    }
                    mysqli_free_result($resource);
                    $oResult = new CResult();
                    $oResult->row = isset($data[0]) ? $data[0] : array();
                    $oResult->rows = $data;
                    $oResult->num_rows = $i;
                    $oResult->IsSucess = TRUE;
                    unset($data);
                    return $oResult;
                } else {
                    $oResult = new CResult();

                    $oResult->effected_row = mysqli_affected_rows($this->conn);

                    $oResult->IsSucess = TRUE;
                    return $oResult;
                }
            } else {
                $oResult = new CResult();
                $oResult->message = mysqli_error($this->conn);
                $oResult->error = mysqli_errno($this->conn);
                $oResult->IsSucess = FALSE;
                return $oResult;
            }
        } catch (Exception $e) {
            $oResult = new CResult();
            $oResult->message = $e->getMessage();
            $oResult->error = $e->getCode();
            $oResult->IsSucess = FALSE;
            return $oResult;
        }
    }
    public function Close()
    {
        mysqli_close($this->conn);
    }
}
?>


<?php
class CAccount
{
    private $oConnManager;
    public function __construct()
    {
        $this->oConnManager = new CConManager();
    }


    public function SqlQuery($sql)  //Read all Catagory For Drowdownlist
    {
        $oResult = new CResult();
        if ($this->oConnManager->Open()) {
            $oResult = $this->oConnManager->query($sql);
        }
        return $oResult;
    }
};
?>

<?php
if (isset($_POST['btnSave'])) {

    $oAccount = new CAccount();
    $oResult = new CResult();



    $HeadCode = $_POST['txtCode'];
    $HeadName = $_POST['txtName'];
    $FromDate = $_POST['dtpFromDate'];
    $ToDate = $_POST['dtpToDate'];


    $sql = "SELECT SUM(Debit) Debit, SUM(Credit) Credit, IsAppove, COAID FROM acc_transaction
              WHERE VDate < '$FromDate' AND COAID LIKE '$HeadCode%' AND IsAppove =1 ";
    $sql .= "GROUP BY IsAppove, COAID";
    $oResult = $oAccount->SqlQuery($sql);
    $PreBalance = 0;

    if ($oResult->num_rows > 0) {
        $PreBalance = $oResult->row['Debit'];
        $PreBalance = $PreBalance - $oResult->row['Credit'];
    }



    $sql = "SELECT acc_transaction.VNo, acc_transaction.Vtype, acc_transaction.VDate, SUM(acc_transaction.Debit) AS Debit, SUM(acc_transaction.Credit) AS Credit, acc_transaction.IsAppove, acc_transaction.COAID, acc_coa.HeadName, acc_coa.PHeadName, acc_coa.HeadType, acc_transaction.Narration
              FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode
			  WHERE acc_transaction.IsAppove =1 AND VDate BETWEEN '$FromDate 00:00:00' AND '$ToDate 00:00:00' AND VNo IN (SELECT VNo FROM acc_transaction acc WHERE acc.COAID LIKE '$HeadCode%' AND acc.IsAppove =1 AND acc.VDate BETWEEN '$FromDate' AND '$ToDate')  ";


    $oResult = $oAccount->SqlQuery($sql);
}
?>

<script src="<?php echo MOD_URL . 'dashboard/assets/js/print.js'; ?>"></script>

<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon"><i class="pe-7s-note2"></i></div>
        <div class="header-title">
            <h1><?php echo display('coa_print') ?></h1>
            <small><?php echo display('coa_print') ?></small>
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
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('coa_print') ?> </h4>
                        </div>
                    </div>
                    <div class="panel-body" id="printableArea">

                        <div id="purchase_div">
                            <div class="table-responsive">
                                <table class="print-table" width="100%">
                                    <tr>
                                        <td align="left" class="print-table-tr">
                                            <img src="<?php if (isset($Soft_settings[0]['invoice_logo'])) {
                                                            echo base_url() . $Soft_settings[0]['invoice_logo'];
                                                        } ?>" alt="logo">
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
                                                <?php echo display('date') ?>: <?php
                                                                                echo date('d-M-Y');
                                                                                ?>
                                            </date>
                                        </td>
                                    </tr>
                                </table>
                                <table class="table text-left" cellpadding="0" cellspacing="0" border="1px solid #000"
                                    width="100%">
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