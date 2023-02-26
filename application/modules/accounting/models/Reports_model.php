<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Reports_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }
  public function todays_sales_report_count()
  {
    $today = date('m-d-Y');
    $this->db->select("a.*,b.customer_id,b.customer_name");
    $this->db->from('invoice a');
    $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
    $this->db->where('a.date', $today);
    $this->db->order_by('a.invoice_id', 'desc');
    $query = $this->db->get();
    return $query->num_rows();
  }
  public function todays_sales_report()
  {
    $today = date('m-d-Y');
    $this->db->select("a.*,b.customer_id,b.customer_name");
    $this->db->from('invoice a');
    $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
    $this->db->order_by('a.invoice_id', 'desc');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function retrieve_company()
  {
    $this->db->select('*');
    $this->db->from('company_information');
    $this->db->limit('1');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
    return false;
  }

  public function getVoucherInfoByVId($id)
  {
    $result = $this->db->select("a.VNo,a.Vtype")
      ->from('acc_transaction a')
      ->where('a.ID', $id)
      ->get()
      ->row_array();
    return $result;
  }

  public function voucher_info_by_id($VNo, $Vtype)
  {
    $result = $this->db->select("a.*, b.HeadName,c.first_name,c.last_name")
      ->from('acc_transaction a')
      ->join('acc_coa b', 'b.HeadCode = a.COAID', 'left')
      ->join('users c', 'c.user_id = a.CreateBy', 'left')
      ->where('a.VNo', $VNo)
      ->where('a.Vtype', $Vtype)
      ->get()
      ->result_array();
    return $result;
  }
  public function income_fields()
  {
    return $result = $this->db->select('*')
      ->from('acc_coa')
      ->where('HeadType', 'I')
      ->where('HeadLevel', 0)
      ->get()
      ->result_array();
  }
  public function expense_fields()
  {
    return $result = $this->db->select('*')
      ->from('acc_coa')
      ->where('HeadType', 'E')
      ->where('HeadLevel', 0)
      ->get()
      ->result_array();
  }
  public function income($from = null, $to = null, $fy_id)
  {
    $find_active_fiscal_year = $this->db->select('id')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    $income_head_codes = $this->db->select('HeadCode')
      ->from('acc_coa')
      ->where('HeadType', 'I')
      ->get()
      ->result_array();
    $income_heads = array_column($income_head_codes, 'HeadCode');
    $this->db->select('(sum(Debit)-sum(Credit)) as balance');
    $this->db->from('acc_transaction');
    $this->db->where('IsAppove', 1);
    if (!empty($from)) {
      $this->db->where('CAST(CreateDate AS DATE) >=', $from);
    }
    if (!empty($to)) {
      $this->db->where('CAST(CreateDate AS DATE) <=', $to);
    }
    $sum = $this->db->where_in('COAID', $income_heads)->get()->row();
    $closing_balance = $this->db->select('sum(amount) as InClosing')->from('acc_opening_balances')->where_in('headcode', $income_heads)->where('fy_id', $fy_id)->get()->row();
    if (!empty($sum->balance)) {
      $balance = $sum->balance + ((!empty($closing_balance->InClosing)) ? $closing_balance->InClosing : 0);
    } else {
      $balance = 0 + ((!empty($closing_balance->InClosing)) ? $closing_balance->InClosing : 0);
    }
    return $balance;
  }
  public function expense($from = null, $to = null, $fy_id)
  {
    $find_active_fiscal_year = $this->db->select('id')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    $expense_head_codes = $this->db->select('HeadCode')
      ->from('acc_coa')
      ->where('HeadType', 'E')
      ->get()
      ->result_array();
    $expense_heads = array_column($expense_head_codes, 'HeadCode');
    $this->db->select('(sum(Debit)-sum(Credit)) as balance');
    $this->db->from('acc_transaction');
    $this->db->where('IsAppove', 1);
    if (!empty($from)) {
      $this->db->where('CAST(CreateDate AS DATE) >=', $from);
    }
    if (!empty($to)) {
      $this->db->where('CAST(CreateDate AS DATE) <=', $to);
    }
    $sum = $this->db->where_in('COAID', $expense_heads)->get()->row();
    $closing_balance = $this->db->select('sum(amount) as ExClosing')->from('acc_opening_balances')->where_in('headcode', $expense_heads)->where('fy_id', $fy_id)->get()->row();
    if (!empty($sum->balance)) {
      $balance = $sum->balance + ((!empty($closing_balance->ExClosing)) ? $closing_balance->ExClosing : 0);
    } else {
      $balance = 0 + ((!empty($closing_balance->ExClosing)) ? $closing_balance->ExClosing : 0);
    }
    return $balance;
  }

  /*--------------------------
    | Get income balance
    *--------------------------*/
  public function income_balance($head_code, $from_date, $to_date, $fy_id)
  {
    return $result = $this->db->select("(sum(Debit)-sum(Credit)) as balance,COAID")
      ->from('acc_transaction')
      ->where('COAID', $head_code)
      ->where('VDate >=', $from_date)
      ->where('VDate <=', $to_date)
      ->where('fy_id', $fy_id)
      ->where('IsAppove', 1)
      ->get()
      ->result_array();
  }
  /*--------------------------
  | Get child accounts
  *--------------------------*/
  public function getChilds($head_code, $headname)
  {
    return $this->db->select("*")
      ->from('acc_coa')
      ->where('IsActive', 1)
      ->where('PHeadName', $headname)
      ->where_not_in('HeadCode', [$head_code])
      ->get()->result_array();
  }
  /*--------------------------
  | Get Fixed assets
  *--------------------------*/
  public function fixed_assets()
  {
    return $result = $this->db->select('*')
      ->from('acc_coa')
      ->where('PHeadName', 'Assets')
      ->get()
      ->result_array();
  }
  public function fiscal_year_list()
  {
    $years = $this->db->select('id,title,status')->from('acc_fiscal_year')->get()->result();
    return $years;
  }
  public function assets($from = null, $to = null)
  {
    $find_active_fiscal_year = $this->db->select('id')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    $assets = $this->db->select('*')
      ->from('acc_coa')
      ->where('HeadType', 'A')
      ->where('HeadLevel', 2)
      ->get()
      ->result_array();
    foreach ($assets as $key => $asset) {
      $parent = array($asset['HeadCode']);
      $first_childs = $this->db->select('a.HeadCode')
        ->from('acc_coa a')
        ->where('a.HeadType', 'A')
        ->where('HeadLevel', 3)
        ->where('a.PHeadCode', $asset['HeadCode'])
        ->where('a.IsTransaction', 1)
        ->get()
        ->result_array();
      if (!empty($first_childs)) {
        $assets[$key]['first_childs_HeadCode_' . $key] = array_column($first_childs, 'HeadCode');
        foreach ($first_childs as $key2 => $first_child) {
          $second_childs = $this->db->select('a.HeadCode')
            ->from('acc_coa a')
            ->where('a.HeadType', 'A')
            ->where('HeadLevel', 4)
            ->where_in('a.PHeadCode', $assets[$key]['first_childs_HeadCode_' . $key])
            ->where('a.IsTransaction', 1)
            ->get()
            ->result_array();
          if (!empty($second_childs)) {
            $assets[$key]['second_childs_HeadCode_' . $key . '_' . $key2] = array_column($second_childs, 'HeadCode');
          }
          if (!empty($assets[$key]['second_childs_HeadCode_' . $key . '_' . $key2])) {
            foreach ($assets[$key]['second_childs_HeadCode_' . $key . '_' . $key2] as $second_childs_HeadCode) {
              $assets[$key]['second_childs'][] = array($second_childs_HeadCode);
            }
            $assets[$key]['all_second_childs_' . $key] = array_column($assets[$key]['second_childs'], [0][0]);
          } else {
            $assets[$key]['all_second_childs_' . $key] = [];
          }
          $assets[$key]['all_child_headcodes' . $key2] = array_merge($assets[$key]['first_childs_HeadCode_' . $key], $assets[$key]['all_second_childs_' . $key], $parent);

          if (!empty($assets[$key]['all_child_headcodes' . $key2])) {
            $this->db->select('(sum(Debit)-sum(Credit)) as balance');
            $this->db->from('acc_transaction');
            $this->db->where('IsAppove', 1);
            if (!empty($from)) {
              $this->db->where('VDate >=', $from);
            }
            if (!empty($to)) {
              $this->db->where('VDate <=', $to);
            }
            $balance = $this->db->where_in('COAID', $assets[$key]['all_child_headcodes' . $key2])->get()->row();

            $opening_balance = $this->db->select('sum(amount) as opening_balance')->from('acc_opening_balances')->where_in('headcode', $assets[$key]['all_child_headcodes' . $key2])->get()->row();
            if (!empty($opening_balance->opening_balance)) {
              $op_balance = $opening_balance->opening_balance;
            } else {
              $op_balance = 0;
            }
            if (!empty($balance->balance)) {
              $assets[$key]['balance'] = $balance->balance + $op_balance;
            } else {
              $assets[$key]['balance'] = 0 + $op_balance;
            }
          }
        }
      } else {
        $this->db->select('(sum(Debit)-sum(Credit)) as balance');
        $this->db->from('acc_transaction');
        $this->db->where('IsAppove', 1);
        if (!empty($from)) {
          $this->db->where('VDate >=', $from);
        }
        if (!empty($to)) {
          $this->db->where('VDate <=', $to);
        }
        $balance = $this->db->where_in('COAID', $asset['HeadCode'])->get()->row();
        $opening_balance = $this->db->select('sum(amount) as opening_balance')->from('acc_opening_balances')->where_in('headcode', $assets[$key]['HeadCode'])->get()->row();
        if (!empty($opening_balance->opening_balance)) {
          $op_balance = $opening_balance->opening_balance;
        } else {
          $op_balance = 0;
        }
        $assets[$key]['balance'] = (!empty($balance->balance) ? $balance->balance : 0) + $op_balance;
      }
    }
    return $assets;
  }
  /*--------------------------
  | Get liabilities
  *--------------------------*/
  public function liabilities_data()
  {
    return  $result = $this->db->select('*')
      ->from('acc_coa')
      ->where('PHeadName', 'Liabilities')
      ->get()
      ->result_array();
  }

  public function all_liabilities()
  {
    $third_lebel = array();
    $menulist = $this->db->select('HeadCode,HeadName')
      ->from('acc_coa')
      ->where('HeadType', 'L')
      ->where('HeadLevel', 2)->get()->result_array();
    $i = 0;
    foreach ($menulist as $sub_menu) {
      $menulist[$i]['sub'] = $this->sub_menu($sub_menu['HeadCode']);
      $i++;
    }
    return $menulist;
  }

  public function sub_menu($id)
  {

    $this->db->select('HeadCode');
    $this->db->from('acc_coa');
    $this->db->where('PHeadCode', $id);
    $child = $this->db->get();
    $menulist = $child->result_array();
    $i = 0;
    foreach ($menulist as $sub_menu) {
      $menulist[$i]['sub'] = $this->sub_menu($sub_menu['HeadCode']);
      $i++;
    }
    return $menulist;
  }

  public function liabilities($from = null, $to = null)
  {

    $find_active_fiscal_year = $this->db->select('id')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    $liabilities = $this->db->select('*')
      ->from('acc_coa')
      ->where('HeadType', 'L')
      ->where('HeadLevel', 2)
      ->get()
      ->result_array();
    $parents = array_column($liabilities, 'HeadCode');
    foreach ($liabilities as $key => $liability) {
      $first_childs = $this->db->select('a.HeadCode')
        ->from('acc_coa a')
        ->where('a.HeadType', 'L')
        ->where('HeadLevel', 3)
        ->where('a.PHeadCode', $liability['HeadCode'])
        ->where('a.IsTransaction', 1)
        ->get()
        ->result_array();
      if (!empty($first_childs)) {
        $liabilities[$key]['first_childs_HeadCode_' . $key] = array_column($first_childs, 'HeadCode');
        foreach ($first_childs as $key2 => $first_child) {
          $second_childs = $this->db->select('a.HeadCode')
            ->from('acc_coa a')
            ->where('a.HeadType', 'L')
            ->where('HeadLevel', 4)
            ->where('a.PHeadCode', $first_child['HeadCode'])
            ->where('a.IsTransaction', 1)
            ->get()
            ->result_array();
          if (!empty($second_childs)) {
            $liabilities[$key]['second_childs_HeadCode_' . $key . '_' . $key2] = array_column($second_childs, 'HeadCode');
          } else {
            $liabilities[$key]['second_childs_HeadCode_' . $key . '_' . $key2] = [];
          }
          if ($liabilities[$key]['second_childs_HeadCode_' . $key . '_' . $key2]) {
            foreach ($liabilities[$key]['second_childs_HeadCode_' . $key . '_' . $key2] as $second_childs_HeadCode) {
              $liabilities[$key]['second_childs'][] = array($second_childs_HeadCode);
              $liabilities[$key]['all_second_childs_' . $key] = array_column($liabilities[$key]['second_childs'], [0][0]);
            }
            if (empty($liabilities[$key]['all_second_childs_' . $key])) {
              $liabilities[$key]['all_second_childs_' . $key] = [];
            };
          }
          $liabilities[$key]['all_child_headcodes' . $key] = array_merge($liabilities[$key]['first_childs_HeadCode_' . $key], $liabilities[$key]['all_second_childs_' . $key], $parents);
        }
        if (!empty($liabilities[$key]['all_child_headcodes' . $key])) {
          $this->db->select('(sum(Debit)-sum(Credit)) as balance');
          $this->db->from('acc_transaction');
          $this->db->where('IsAppove', 1);
          if (!empty($from)) {
            $this->db->where('VDate >=', $from);
          }
          if (!empty($to)) {
            $this->db->where('VDate <=', $to);
          }
          $balance = $this->db->where_in('COAID', $liabilities[$key]['all_child_headcodes' . $key])->get()->row();
          $opening_balance = $this->db->select('sum(amount) as opening_balance')->from('acc_opening_balances')->where_in('headcode', $liabilities[$key]['all_child_headcodes' . $key])->get()->row();
          if (!empty($opening_balance->opening_balance)) {
            $op_balance = $opening_balance->opening_balance;
          } else {
            $op_balance = 0;
          }
          if (!empty($balance->balance)) {
            $liabilities[$key]['balance'] = $balance->balance + $op_balance;
          } else {
            $liabilities[$key]['balance'] = 0 + $op_balance;
          }
        }
      } else {
        $this->db->select('(sum(Debit)-sum(Credit)) as balance');
        $this->db->from('acc_transaction');
        $this->db->where('IsAppove', 1);
        if (!empty($from)) {
          $this->db->where('VDate >=', $from);
        }
        if (!empty($to)) {
          $this->db->where('VDate <=', $to);
        }
        $balance = $this->db->where('COAID', $liability['HeadCode'])->get()->row();
        $opening_balance = $this->db->select('sum(amount) as opening_balance')->from('acc_opening_balances')->where('headcode', $liabilities[$key]['HeadCode'])->get()->row();
        if (!empty($opening_balance->opening_balance)) {
          $op_balance = $opening_balance->opening_balance;
        } else {
          $op_balance = 0;
        }
        $liabilities[$key]['balance'] = (!empty($balance->balance) ? $balance->balance : 0) + $op_balance;
      }
    }
    return $liabilities;
  }
  public function owners_equity($from = null, $to = null)
  {
    $find_active_fiscal_year = $this->db->select('id')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    $owners_equity_head_codes = $this->db->select('HeadCode')
      ->from('acc_coa')
      ->where('HeadType', 'O')
      ->get()
      ->result_array();
    $owners_equity_heads = array_column($owners_equity_head_codes, 'HeadCode');

    $this->db->select('(sum(Debit)-sum(Credit)) as balance');
    $this->db->from('acc_transaction');
    $this->db->where('IsAppove', 1);
    if (!empty($from)) {
      $this->db->where('CAST(CreateDate AS DATE) >=', $from);
    }
    if (!empty($to)) {
      $this->db->where('CAST(CreateDate AS DATE) <=', $to);
    }
    $sum = $this->db->where_in('COAID', $owners_equity_heads)->get()->row();
    $closing_balance = $this->db->select('sum(amount) as OeClosing')->from('acc_opening_balances')->where_in('headcode', $owners_equity_heads)->where('fy_id', $find_active_fiscal_year->id)->get()->row();
    if (!empty($sum->balance)) {
      $balance = $sum->balance + ((!empty($closing_balance->OeClosing)) ? $closing_balance->OeClosing : 0);
    } else {
      $balance = 0 + ((!empty($closing_balance->OeClosing)) ? $closing_balance->OeClosing : 0);
    }
    return $balance;
  }
  /*--------------------------
  | Get assets info
  *--------------------------*/
  public function assets_info($head_name)
  {
    return $this->db->select("*")
      ->from('acc_coa')
      ->where('PHeadName', $head_name)
      ->group_by('HeadCode')
      ->get()->result_array();
  }

  public function assets_info_by_code($head_code)
  {
    return $this->db->select("*")
      ->from('acc_coa')
      ->where('PHeadCode', $head_code)
      ->group_by('HeadCode')
      ->get()->result_array();
  }

  /*--------------------------
  | Get liabilities info
  *--------------------------*/
  public function liabilities_info($head_name)
  {
    return $result = $this->db->select('*')
      ->from('acc_coa')
      ->where('PHeadName', $head_name)
      ->get()
      ->result_array();
  }
  /*--------------------------
  | Get liabilities balance
  *--------------------------*/
  public function liabilities_balance($head_code, $from_date, $to_date)
  {
    return  $result = $this->db->select('(sum(Credit)-sum(Debit)) as balance,COAID')
      ->from('acc_transaction')
      ->where('COAID', $head_code)
      ->where('VDate >=', $from_date)
      ->where('VDate <=', $to_date)
      ->where('IsAppove', 1)
      ->get()
      ->result_array();
  }
  /*--------------------------
  | Get liabilities 
  *--------------------------*/
  public function liabilities_info_tax($head_name)
  {
    $records = $this->db->select("*")
      ->from('acc_coa')
      ->where('HeadName', $head_name)
      ->get()
      ->result_array();
    return  $records;
  }

  /*--------------------------
  | Get assets balance
  *--------------------------*/
  public function assets_balance($head_code, $from_date, $to_date)
  {
    return $this->db->select("(sum(Debit)-sum(Credit)) as balance")
      ->from('acc_transaction')
      ->where('COAID', $head_code)
      ->where('VDate >=', $from_date)
      ->where('VDate <=', $to_date)
      ->where('IsAppove', 1)
      ->get()->result_array();
  }
  /*--------------------------
  | Get account childs by head name
  *--------------------------*/
  public function asset_childs($head_name)
  {
    return $this->db->select("*")
      ->from('acc_coa')
      ->where('PHeadName', $head_name)
      ->group_by('HeadCode')
      ->get()->result_array();
  }
  public function cashflow_firstquery()
  {
    $sql = "SELECT * FROM acc_coa WHERE acc_coa.IsTransaction=1 AND acc_coa.HeadType='A' AND acc_coa.IsActive=1 AND acc_coa.HeadCode LIKE '12%'";
    return $sql;
  }

  public function cashflow_secondquery($dtpFromDate, $dtpToDate, $COAID)
  {
    $sql = "SELECT SUM(acc_transaction.Debit)- SUM(acc_transaction.Credit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove =1 AND VDate BETWEEN '" . $dtpFromDate . "' AND '" . $dtpToDate . "' AND COAID LIKE '$COAID%'";
    return $sql;
  }

  public function cashflow_thirdquery()
  {
    $sql = "SELECT * FROM acc_coa WHERE IsGL=1 AND HeadCode LIKE '125%' AND IsActive=1 AND HeadCode NOT LIKE '12103001%' AND HeadCode!='125' ";
    return $sql;
  }

  public function cashflow_forthquery($dtpFromDate, $dtpToDate, $COAID)
  {
    $sql = "SELECT  SUM(acc_transaction.Credit) - SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '" . $dtpFromDate . "' AND '" . $dtpToDate . "' AND COAID LIKE '$COAID%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '12103001%') ";

    return $sql;
  }


  public function cashflow_fifthquery($dtpFromDate, $dtpToDate, $COAID)
  {
    $sql = "SELECT  SUM(acc_transaction.Credit) - SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '" . $dtpFromDate . "' AND '" . $dtpToDate . "' AND COAID LIKE '5%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '12103001%') ";

    return $sql;
  }

  public function cashflow_sixthquery()
  {
    $sql = "SELECT * FROM acc_coa WHERE IsGL=1 AND HeadCode LIKE '4%' AND IsActive=1 ";
    return $sql;
  }

  public function cashflow_seventhquery($dtpFromDate, $dtpToDate, $COAID)
  {
    $sql = "SELECT  SUM(acc_transaction.Credit) - SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '" . $dtpFromDate . "' AND '" . $dtpToDate . "' AND COAID LIKE '$COAID%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '12103001%') ";
    return $sql;
  }
  /*--------------------------
  | Get all account with active
  *--------------------------*/
  public function trial_balance_report($FromDate, $ToDate, $WithOpening)
  {
    $values1 = array("A", "L");
    $values2 = array("I", "E");
    if ($WithOpening)
      $WithOpening = true;
    else
      $WithOpening = false;

    $oResultTr = $this->db->select('*')
      ->from('acc_coa')
      ->where('IsGL', 1)
      ->where_in('HeadType', $values1)
      ->where('IsActive', 1)
      ->order_by('HeadCode')
      ->get()
      ->result_array();

    $oResultInEx =  $this->db->select('*')
      ->from('acc_coa')
      ->where('IsGL', 1)
      ->where_in('HeadType', $values2)
      ->where('IsActive', 1)
      ->order_by('HeadCode')
      ->get()
      ->result_array();
    $data = array(
      'oResultTr'   => $oResultTr,
      'oResultInEx' => $oResultInEx,
      'WithOpening' => $WithOpening
    );
    return $data;
  }

  public function trial_balance_detail($FromDate, $ToDate, $fy_id)
  {

    $assets_expense_data = $this->db->select('HeadCode')->from('acc_coa')->where_in('HeadType', ['A', 'E'])->get()->result_array();
    $a_e_headCodes = array_column($assets_expense_data, 'HeadCode');
    $this->db->select('b.HeadName,a.COAID,sum(a.Debit) as predebit,sum(a.Credit) as precredit,sum(a.Debit)-sum(a.Credit) as preclosing');
    $this->db->from('acc_transaction a');
    $this->db->join('acc_coa b', 'a.COAID = b.HeadCode', 'left');
    $this->db->where("a.VDate >=", $FromDate);
    $this->db->where("a.VDate <=", $ToDate);
    $this->db->where('a.fy_id', $fy_id);
    $this->db->where_in('a.COAID', $a_e_headCodes);
    $this->db->group_by('a.COAID');
    $a_e_closing = $this->db->get()->result_array();

    $liability_income_data = $this->db->select('HeadCode')->from('acc_coa')->where_in('HeadType', ['L', 'I'])->get()->result_array();
    $l_i_headCodes = array_column($liability_income_data, 'HeadCode');
    $this->db->select('b.HeadName,a.COAID,sum(a.Debit) as predebit,sum(a.Credit) as precredit,sum(a.Credit)-sum(a.Debit) as preclosing');
    $this->db->from('acc_transaction a');
    $this->db->join('acc_coa b', 'a.COAID = b.HeadCode', 'left');
    $this->db->where("a.VDate >=", $FromDate);
    $this->db->where("a.VDate <=", $ToDate);
    $this->db->where('a.fy_id', $fy_id);
    $this->db->where_in('a.COAID', $l_i_headCodes);
    $this->db->group_by('a.COAID');
    $l_i_closing = $this->db->get()->result_array();

    $data = array(
      'a_e_closing' => $a_e_closing,
      'l_i_closing' => $l_i_closing,
    );
    return $data;
  }

  public  function get_general_ledger_head()
  {
    return  $result =   $this->db->select("HeadCode as id, CONCAT(HeadCode, '-', HeadName) as text")
      ->from('acc_coa')
      ->where('IsGL', 1)
      ->order_by('HeadCode', 'asc')
      ->get()
      ->result_array();
  }
  public function get_gl_trans_head($Headid)
  {
    $rs = $this->db->select('*')
      ->from('acc_coa')
      ->where('HeadCode', $Headid)
      ->get()
      ->row();
    $result = $this->db->select("HeadCode as id, CONCAT_WS(' ', HeadCode, '-', HeadName) as text")
      ->from('acc_coa')
      ->where('IsTransaction', 1)
      ->where('PHeadCode', $rs->HeadCode)
      ->order_by('HeadCode', 'asc')
      ->get()
      ->result_array();
    return $result;
  }
  public function general_led_report_headname($cmbGLCode)
  {
    return $result = $this->db->select('*')
      ->from('acc_coa')
      ->where('HeadCode', $cmbGLCode)
      ->get()
      ->result_array();
  }
  public function general_led_report_headname2($cmbGLCode, $cmbCode, $dtpFromDate, $dtpToDate, $chkIsTransction)
  {
    if ($chkIsTransction) {
      $result = $this->db->select('a.VNo,a.VDate, a.Vtype, a.VDate, a.Narration, a.Debit, a.Credit, a.IsAppove, a.COAID,b.HeadName, b.PHeadName, b.HeadType')
        ->from('acc_transaction a')
        ->join('acc_coa b', 'a.COAID = b.HeadCode', 'left')
        ->where('a.IsAppove', 1)
        // ->where('VDate BETWEEN "' . $dtpFromDate . '" and "' . $dtpToDate . '"')
        ->where('a.COAID', $cmbCode)
        ->get()
        ->result_array();
      return $result;
    } else {
      $result = $this->db->select('a.COAID,a.VDate,a.Debit, a.Credit,b.HeadName,a.IsAppove, b.PHeadName, b.HeadType')
        ->from('acc_transaction a')
        ->join('acc_coa b', 'a.COAID = b.HeadCode', 'left')
        ->where('a.IsAppove', 1)
        ->where('VDate BETWEEN "' . $dtpFromDate . '" and "' . $dtpToDate . '"')
        ->where('a.COAID', $cmbCode)
        ->get()
        ->result_array();
      return $result;
    }
  }
  // prebalance calculation
  public function general_led_report_prebalance($cmbCode, $dtpFromDate, $branchId = null)
  {
    $query = $this->db->select('sum(Debit) as predebit, sum(Credit) as precredit');
    $query->from('acc_transaction');
    if (!empty($branchId)) {
      $query->where('BranchID', $branchId);
    }
    $query->where('IsAppove', 1);
    $query->where('VDate < ', $dtpFromDate);
    $query->where('COAID', $cmbCode);
    $query1 = $query->get();
    $result = $query1->row();
    return $balance = $result->predebit - $result->precredit;
  }

  // Get all childs for coa
  public function get_all_child($headcode)
  {
    $query = $this->db->query("select  HeadCode,HeadName,PHeadName,PHeadCode from (select * from acc_coa order by PHeadCode) products_sorted, (select @pv := '" . $headcode . "') initialisation where find_in_set(PHeadCode, @pv) > 0  and @pv := concat(@pv, ',', HeadCode)");
    $result = $query->result_array();
    return $result;
  }
}