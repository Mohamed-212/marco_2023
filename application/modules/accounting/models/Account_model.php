<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account_model extends CI_Model
{
  public function check_fiscal_year($start_date, $end_date, $item_id = false)
  {
    $this->db->select('id');
    $this->db->from('acc_fiscal_year');
    if (!empty($item_id)) {
      $this->db->where('id !=', $item_id);
    }
    $this->db->where('(DATE("' . $start_date . ')" BETWEEN `start_date` AND `end_date`) OR DATE("' . $end_date . '") BETWEEN `start_date` AND `end_date`)');

    $result = $this->db->get();
    return $result->num_rows();
  }

  function get_userlist()
  {
    $this->db->select('*');
    $this->db->from('acc_coa');
    $this->db->where('IsActive', 1);
    $this->db->order_by('HeadCode');
    $query = $this->db->get();
    if ($query->num_rows() >= 1) {
      return $query->result();
    } else {
      return false;
    }
  }

  function opening_balance_userlist()
  {
    $this->db->select('*');
    $this->db->from('acc_coa');
    $this->db->where('IsActive', 1);
    $this->db->where('IsTransaction', 1);
    $this->db->order_by('HeadCode');
    $query = $this->db->get();
    if ($query->num_rows() >= 1) {
      return $query->result();
    } else {
      return false;
    }
  }

  function opening_balance_userlist_without_customers_or_suppliers()
  {
    $this->db->select('*');
    $this->db->from('acc_coa');
    $this->db->where('IsActive', 1);
    $this->db->where('IsTransaction', 1);
    // remove customers
    $this->db->where('PHeadCode !=', 113);
    $this->db->where('PHeadCode !=', 1131);
    // remove suppliers
    $this->db->where('PHeadCode !=', 211);
    $this->db->where('PHeadCode !=', 2111);
    $this->db->order_by('HeadCode');
    $query = $this->db->get();
    if ($query->num_rows() >= 1) {
      return $query->result();
    } else {
      return false;
    }
  }

  function opening_balance_customers_only()
  {
    $this->db->select('a.*, b.customer_no');
    $this->db->from('acc_coa a');
    $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
    $this->db->where('IsActive', 1);
    $this->db->where('IsTransaction', 1);
    $this->db->where('PHeadCode', 1131);
    $this->db->order_by('HeadCode');
    $query = $this->db->get();
    if ($query->num_rows() >= 1) {
      return $query->result();
    } else {
      return false;
    }
  }

  function opening_balance_suppliers_only()
  {
    $this->db->select('a.*, b.supplier_no');
    $this->db->from('acc_coa a');
    $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
    $this->db->where('IsActive', 1);
    $this->db->where('IsTransaction', 1);
    $this->db->where('PHeadCode', 2111);
    $this->db->order_by('HeadCode');
    $query = $this->db->get();
    if ($query->num_rows() >= 1) {
      return $query->result();
    } else {
      return false;
    }
  }


  function get_bank_list()
  {
    $this->db->select('*');
    $this->db->from('bank_list');
    $this->db->order_by('default_status', 'desc');
    $result = $this->db->get()->result_array();
    return $result;
  }

  public function payment_info()
  {
    $bank_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where_in('PHeadCode', array('112'))->get()->result();
    return $bank_head;
  }

  function get_parenthead()
  {
    $this->db->select('*');
    $this->db->from('acc_coa');
    $this->db->where('PHeadCode', 0);
    $this->db->order_by('HeadCode');
    $query = $this->db->get();
    if ($query->num_rows() >= 1) {
      return $query->result();
    } else {
      return false;
    }
  }

  function first_child($phead)
  {
    $this->db->select('*');
    $this->db->from('acc_coa');
    $this->db->where('PHeadName', $phead);
    $this->db->order_by('HeadCode');
    $query = $this->db->get();
    if ($query->num_rows() >= 1) {
      return $query->result();
    } else {
      return false;
    }
  }

  public function create_opening($data = [])
  {
    $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    if (!empty($find_active_fiscal_year)) {
      return $this->db->insert('acc_opening_balances', $data);
    } else {
      $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
      redirect('dashboard/Cpurchase');
    }
  }

  public function dfs($HeadName, $HeadCode, $oResult, $visit, $d)
  {
    $sbalance = $this->coa_balance($HeadCode);
    $sopening = $this->opening_coa_balance($HeadCode);
    $balance = ($sbalance ? number_format($sbalance, 2) : number_format(0, 2));
    $opening = ($sopening ? number_format($sopening, 2) : number_format(0, 2));

    if ($d == 0) echo "<li class=\"jstree-open \">$HeadName <a href=/'javascript:void(0)/' class=\"form-control headanchor\"><span class=\"coa_hd\"><b>" . display('chart_of_account') . "</b></span><span class=\"bal_span\"><b>balance</b></span><span class=\"bal_span\"><b>Opening-balance</b></span></a>";
    else if ($d == 1) echo "<li class=\"jstree-open\"><a href='javascript:' onclick=\"loadCoaData('" . $HeadCode . "')\" class=\"form-control jstreelip\">$HeadName <span class=\"bal_span\"> $balance</span><span class=\"bal_span_pre\">$opening</span></a>";
    else echo "<li class=\"jstreeli\"><a href='javascript:' class=\"form-control\" onclick=\"loadCoaData('" . $HeadCode . "')\">$HeadName <span class=\"bal_span\"> $balance</span> <span class=\"bal_span_pre\">$opening</span></a>";
    $p = 0;
    for ($i = 0; $i < count($oResult); $i++) {
      if (!$visit[$i]) {
        if ($HeadCode == $oResult[$i]->PHeadCode) {
          $visit[$i] = true;
          if ($p == 0) echo "<ul>";
          $p++;
          $this->dfs($oResult[$i]->HeadName, $oResult[$i]->HeadCode, $oResult, $visit, $d + 1);
        }
      }
    }
    if ($p == 0) echo "</li>";
    else echo "</ul>";
  }

  public function opening_coa_balance($head)
  {
    $childs = $this->non_transaction_childs($head);
    $fiscal_year = $this->check_fiscal_yearwithcurrentyear();
    $results = $this
      ->db
      ->from('acc_coa')
      ->select('*')
      ->where_in('HeadCode', $childs)->get()
      ->result();
    $total_pre = 0;
    foreach ($results as $rdata) {
      $opening_value = $this->openig_value($rdata->HeadCode, $fiscal_year->id);
      $total_pre += ($opening_value ? $opening_value->amount : 0);
    }
    return $total_pre;
  }

  public function openig_value($headcodes, $fy_id)
  {
    return $obinfo = $this
      ->db
      ->select('sum(amount) as amount')
      ->from('acc_opening_balances')
      ->where('headcode', $headcodes)->where('fy_id', $fy_id)->get()
      ->row();
  }

  public function check_fiscal_yearwithcurrentyear()
  {
    $curdate = date('Y-m-d');
    return $fsyear = $this
      ->db
      ->from('acc_fiscal_year')
      ->where('start_date <=', $curdate)->where('end_date >=', $curdate)->get()
      ->row();
  }

  public function non_transaction_childs($code)
  {
    $mainhead = $this
      ->db
      ->select('*')
      ->from('acc_coa')
      ->where('HeadCode', $code)
      ->get()->row();
    $headcodes = array(
      "$code"
    );

    $child_head = $this
      ->db
      ->select('*')
      ->from('acc_coa')
      ->where('PHeadName', ($mainhead ? $mainhead->HeadName : ''))
      ->get()
      ->result();
    if ($child_head) {
      foreach ($child_head as $schild) {
        $nchild = $this->nchild($schild->HeadName);
        $child = $schild->HeadCode;
        array_push($headcodes, $child);
        if ($nchild) {
          foreach ($nchild as $newchild) {
            $newchild = $schild->HeadCode;
            array_push($headcodes, $newchild);
            $nstchild2 = $this->nchild($schild->HeadName);
            if ($nstchild2) {
              foreach ($nstchild2 as $child2) {
                $newchild2 = $child2->HeadCode;
                array_push($headcodes, $newchild2);
                $nstchild3 = $this->nchild($child2->HeadName);
                if ($nstchild3) {
                  foreach ($nstchild3 as $child3) {
                    $newchild3 = $child3->HeadCode;
                    array_push($headcodes, $newchild3);
                    $nstchild4 = $this->nchild($child3->HeadName);
                    if ($nstchild4) {
                      foreach ($nstchild4 as $child4) {
                        $newchild4 = $child4->HeadCode;
                        array_push($headcodes, $newchild4);
                        $nstchild5 = $this->nchild($child4->HeadName);

                        if ($nstchild5) {
                          foreach ($nstchild5 as $child5) {
                            $newchild5 = $child5->HeadCode;
                            array_push($headcodes, $newchild5);
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }

    return $headcodes;
  }

  public function nchild($name)
  {
    return $child_head = $this
      ->db
      ->from('acc_coa')
      ->select('*')
      ->where('PHeadName', $name)->get()
      ->result();
  }

  public function coa_balance($cmbGLCode)
  {
    $childs = $this->non_transaction_childs($cmbGLCode);
    $fiscal_year = $this->check_fiscal_yearwithcurrentyear();
    $dtpFromDate = date('Y-m-d');
    $results = $this
      ->db
      ->from('acc_coa')
      ->select('*')
      ->where_in('HeadCode', $childs)->get()
      ->result();

    $total_closing = 0;
    $balance = 0;
    foreach ($results as $rdata) {
      $transdata = $this
        ->db
        ->from('acc_transaction')
        ->select('COAID as COAID,sum(Debit) as predebit, sum(Credit) as precredit,VDate')
        ->where('IsAppove', 1)
        ->where('VDate >= ', $fiscal_year->start_date)
        ->where('VDate <= ', $dtpFromDate)
        ->where('VNo != ', 'OP-' . $rdata->HeadCode)
        ->where('COAID', $rdata->HeadCode)
        ->group_by('acc_transaction.COAID')
        ->get()
        ->row();

      if ($transdata) {
        $balance = ($transdata ? $transdata->predebit : 0) - ($transdata ? $transdata->precredit : 0);
        $opening_value = $this->openig_value($rdata->HeadCode, $fiscal_year->start_date, $fiscal_year->end_date);
        $total_val = ($balance ? $balance : 0) + ($opening_value ? $opening_value->amount : 0);
        $total_closing += ($total_val ? $total_val : 0);
      }
    }

    return $total_closing;
  }


  public function total_current_asset_balance()
  {
    $asset_balance = $loan_balance = $single_balance = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Customer Receivable')->get()->result_array();
    $asset_balance = 0;
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $ass_bal = $query->predebit - $query->precredit;
      $asset_balance += (!empty($ass_bal) ? $ass_bal : 0);
    }
    $lncoa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Loan Receivable')->get()->result_array();
    foreach ($lncoa as $lnassetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.COAID', $lnassetcoa['HeadCode']);
      $lnquery = $this->db->get()->row();
      $ln_bal = $lnquery->predebit - $lnquery->precredit;
      $loan_balance += (!empty($ln_bal) ? $ln_bal : 0);
    }
    $single_acc_rcv = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Account Receivable')->get()->result_array();
    foreach ($single_acc_rcv as $singl_rcv) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.COAID', $singl_rcv['HeadCode']);
      $rcvquery = $this->db->get()->row();
      $sreceive_bal = $rcvquery->predebit - $rcvquery->precredit;
      $single_balance += (!empty($sreceive_bal) ? $sreceive_bal : 0);
    }
    $bank_balance = 0;
    $cash_balance = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Cash At Bank')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $bank_bal = $query->predebit - $query->precredit;
      $bank_balance += (!empty($bank_bal) ? $bank_bal : 0);
    }
    $cash_other = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Cash & Cash Equivalent')->get()->result_array();
    foreach ($cash_other as $cashother) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.COAID', $cashother['HeadCode']);
      $query = $this->db->get()->row();
      $cash_bal = $query->predebit - $query->precredit;
      $cash_balance += (!empty($cash_bal) ? $cash_bal : 0);
    }
    $balance = $bank_balance + $cash_balance;
    return $balance = $asset_balance + $loan_balance + $single_balance + $bank_balance + $cash_balance;
  }

  public function total_non_current_asset_balance()
  {
    $total = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Non Current Assets')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $balance = $query->predebit - $query->precredit;
      $total += (!empty($balance) ? $balance : 0);
    }
    return $total;
  }

  public function total_equity_balance()
  {
    $total = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Equity')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $balance = $query->predebit - $query->precredit;
      $total += (!empty($balance) ? $balance : 0);
    }
    return $total;
  }

  public function total_expense_balance()
  {
    $total = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Expence')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $balance = $query->predebit - $query->precredit;
      $total += (!empty($balance) ? $balance : 0);
    }
    return $total;
  }

  public function total_income_balance()
  {
    $total = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Income')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $balance = $query->predebit - $query->precredit;
      $total += (!empty($balance) ? $balance : 0);
    }
    return $total;
  }

  public function total_acc_payable_balance()
  {
    $total = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Account Payable')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $balance = $query->predebit - $query->precredit;
      $total += (!empty($balance) ? $balance : 0);
    }
    return $total;
  }

  public function total_acc_employee_balance()
  {
    $total = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Employee Ledger')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $balance = $query->predebit - $query->precredit;
      $total += (!empty($balance) ? $balance : 0);
    }
    return $total;
  }

  public function total_acc_cruliabilities_balance()
  {
    $total = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Current Liabilities')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $balance = $query->predebit - $query->precredit;
      $total += (!empty($balance) ? $balance : 0);
    }
    return $total;
  }

  public function total_acc_no_curliability_balance()
  {
    $total = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Non Current Liabilities')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $balance = $query->predebit - $query->precredit;
      $total += (!empty($balance) ? $balance : 0);
    }
    return $total;
  }

  public function customer_rec_opening()
  {
    $total = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Loan Receivable')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.is_opening', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $cust_bal = $query->predebit - $query->precredit;
      $total += $cust_bal;
    }
    return $total;
  }

  public function loan_rec_opening()
  {
    $total = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Customer Receivable')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.is_opening', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $cust_bal = $query->predebit - $query->precredit;
      $total += $cust_bal;
    }
    return $total;
  }

  public function account_rec_opening()
  {
    $total = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Account Receivable')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.is_opening', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $cust_bal = $query->predebit - $query->precredit;
      $total += $cust_bal;
    }
    return $total;
  }

  public function bank_opening()
  {
    $total = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Cash At Bank')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.is_opening', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $cust_bal = $query->predebit - $query->precredit;
      $total += $cust_bal;
    }
    return $total;
  }

  public function cash_equivalent_opening()
  {
    $total = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Cash & Cash Equivalent')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.is_opening', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $cust_bal = $query->predebit - $query->precredit;
      $total += $cust_bal;
    }
    return $total;
  }

  public function non_current_ass_opening()
  {
    $total = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Non Current Assets')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.is_opening', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $cust_bal = $query->predebit - $query->precredit;
      $total += $cust_bal;
    }
    return $total;
  }

  public function equity_opening()
  {
    $total = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Equity')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.is_opening', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $cust_bal = $query->predebit - $query->precredit;
      $total += $cust_bal;
    }
    return $total;
  }

  public function expense_opening()
  {
    $total = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Expence')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.is_opening', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $cust_bal = $query->predebit - $query->precredit;
      $total += $cust_bal;
    }
    return $total;
  }

  public function income_opening()
  {
    $total = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Income')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.is_opening', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $cust_bal = $query->predebit - $query->precredit;
      $total += $cust_bal;
    }
    return $total;
  }

  public function acc_payable_opening()
  {
    $total = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Account Payable')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.is_opening', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $cust_bal = $query->predebit - $query->precredit;
      $total += $cust_bal;
    }
    return $total;
  }

  public function acc_employeeledger_opening()
  {
    $total = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Employee Ledger')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.is_opening', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $cust_bal = $query->predebit - $query->precredit;
      $total += $cust_bal;
    }
    return $total;
  }

  public function acc_curliabilities_opening()
  {
    $total = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Current Liabilities')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.is_opening', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $cust_bal = $query->predebit - $query->precredit;
      $total += $cust_bal;
    }
    return $total;
  }

  public function acc_non_curliabilities_opening()
  {
    $total = 0;
    $coa = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName', 'Non Current Liabilities')->get()->result_array();
    foreach ($coa as $assetcoa) {
      $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
      $this->db->from('acc_transaction');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('acc_transaction.is_opening', 1);
      $this->db->where('acc_transaction.COAID', $assetcoa['HeadCode']);
      $query = $this->db->get()->row();
      $cust_bal = $query->predebit - $query->precredit;
      $total += $cust_bal;
    }
    return $total;
  }

  public function treeview_selectform($id)
  {
    $data = $this->db->select('*')
      ->from('acc_coa')
      ->where('HeadCode', $id)
      ->get()
      ->row();
    return $data;
  }

  public function get_supplier()
  {
    $this->db->select('*');
    $this->db->from('supplier_information');
    $this->db->where('status', 1);
    $this->db->order_by('supplier_id', 'desc');
    $query = $this->db->get();
    return $query->result();
  }

  // Customer list
  public function get_customer()
  {
    $this->db->select('*');
    $this->db->from('customer_information');
    $query = $this->db->get();
    return $query->result();
  }

  public function Spayment()
  {
    return $data = $this->db->select("VNo as voucher")
      ->from('acc_transaction')
      ->like('VNo', 'PM-', 'after')
      ->order_by('ID', 'desc')
      ->get()
      ->result_array();
  }

  public function supplier_payment_insert()
  {
    $bank_id = $this->input->post('bank_id', TRUE);
    // var_dump($bank_id);exit;
    // if (!empty($bank_id)) {
    //   $bankcoaid = $this->db->select('HeadCode')->from('acc_coa')->where('service_id', $bank_id)->get()->row()->HeadCode;
    // } else {
    //   $bankcoaid = '';
    // }

    $voucher_no = addslashes(trim($this->input->post('txtVNo', TRUE)));
    $Vtype = "PM";
    $cAID = $this->input->post('cmbDebit', TRUE);
    $dAID = $this->input->post('txtCode', TRUE);
    $Debit = $this->input->post('txtAmount', TRUE);
    $Credit = 0;
    $VDate = $this->input->post('dtpDate', TRUE);
    $Narration = addslashes(trim($this->input->post('txtRemarks', TRUE)));
    $IsPosted = 1;
    $IsAppove = 1;
    $sup_id = $this->input->post('supplier_id', TRUE);

    $CreateBy = $this->session->userdata('user_id');;
    $createdate = date('Y-m-d H:i:s');
    $dbtid = $dAID;
    $Damnt = $Debit;
    $supplier_id = $sup_id;
    $supinfo = $this->db->select('*')->from('supplier_information')->where('supplier_id', $supplier_id)->get()->row();
    $find_active_fiscal_year = $this->db->select('id')->from('acc_fiscal_year')->where('status', 1)->get()->row();

    $data2 = array(
      'invoice_no'    =>  null,
      'deposit_no'    =>  null,
      'transaction_id' => generator(15),
      'supplier_id' => $supplier_id,
      'date' => date('Y-m-d', $createdate),
      'amount' => $Debit,
      'status' => 1,
      'voucher' => 'CV',
      'payment_type'  =>  1,
      'sl_created_at' => $createdate,
      'description' => 'ITP'
    );
    $this->db->insert('supplier_ledger', $data2);

    $supplierdebit = array(
      'fy_id' => $find_active_fiscal_year->id,
      'VNo' => $voucher_no,
      'Vtype' => $Vtype,
      'VDate' => $VDate,
      'COAID' => $dbtid,
      'Narration' => $Narration,
      'Debit' => $Damnt,
      'Credit' => 0,
      'IsPosted' => $IsPosted,
      'CreateBy' => $CreateBy,
      'CreateDate' => $createdate,
      'IsAppove' => 1
    );
    $cc = array(
      'fy_id' => $find_active_fiscal_year->id,
      'VNo' => $voucher_no,
      'Vtype' => $Vtype,
      'VDate' => $VDate,
      'COAID' => $cAID,
      'Narration' => 'Paid to ' . $supinfo->supplier_name,
      'Debit' => 0,
      'Credit' => $Damnt,
      'IsPosted' => 1,
      'CreateBy' => $CreateBy,
      'CreateDate' => $createdate,
      'IsAppove' => 1
    );
    $bankc = array(
      'fy_id' => $find_active_fiscal_year->id,
      'VNo' => $voucher_no,
      'Vtype' => $Vtype,
      'VDate' => $VDate,
      'COAID' => $bank_id,
      'Narration' => 'Supplier Payment To ' . $supinfo->supplier_name,
      'Debit' => 0,
      'Credit' => $Damnt,
      'IsPosted' => 1,
      'CreateBy' => $CreateBy,
      'CreateDate' => $createdate,
      'IsAppove' => 1
    );
    $this->db->insert('acc_transaction', $supplierdebit);
    if ($this->input->post('paytype', TRUE) == 2) {
      $this->db->insert('acc_transaction', $bankc);
    }
    if ($this->input->post('paytype', TRUE) == 1) {
      $this->db->insert('acc_transaction', $cc);
    }
    $this->session->set_flashdata('message', display('save_successfully'));
    redirect('accounting/supplier_paymentreceipt/' . $supplier_id . '/' . $voucher_no . '/' . $dbtid);
  }

  public function supplierinfo($supplier_id)
  {
    return $this->db->select('*')
      ->from('supplier_information')
      ->where('supplier_id', $supplier_id)
      ->get()
      ->result_array();
  }

  public function supplierpaymentinfo($voucher_no, $coaid)
  {
    return $result = $this->db->select('*')
      ->from('acc_transaction')
      ->where('VNo', $voucher_no)
      ->where('COAID', $coaid)
      ->get()
      ->result_array();
  }

  // customer code
  public function Creceive()
  {
    return $data = $this->db->select("VNo as voucher")
      ->from('acc_transaction')
      ->like('VNo', 'RV-', 'after')
      ->order_by('ID', 'desc')
      ->get()
      ->result_array();
  }

  public function bankbook_firstqury($FromDate, $HeadCode)
  {
    $sql = "SELECT SUM(Debit) Debit, SUM(Credit) Credit, IsAppove, COAID FROM acc_transaction
      WHERE VDate < '$FromDate 00:00:00' AND COAID = '$HeadCode' AND IsAppove =1 GROUP BY IsAppove, COAID";
    return $sql;
  }

  public function bankbook_secondqury($FromDate, $HeadCode, $ToDate)
  {
    $sql = "SELECT acc_transaction.VNo, acc_transaction.Vtype, acc_transaction.VDate, acc_transaction.Debit, acc_transaction.Credit, acc_transaction.IsAppove, acc_transaction.COAID, acc_coa.HeadName, acc_coa.PHeadName, acc_coa.HeadType, acc_transaction.Narration 
       FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode
           WHERE acc_transaction.IsAppove =1 AND VDate BETWEEN '$FromDate 00:00:00' AND '$ToDate 00:00:00' AND acc_transaction.COAID='$HeadCode' ORDER BY  acc_transaction.VDate, acc_transaction.VNo";
    return $sql;
  }

  public function customer_receive_insert()
  {
    $voucher_no = addslashes(trim($this->input->post('txtVNo', TRUE)));
    $Vtype = "RV";
    $cAID = $this->input->post('cmbDebit', TRUE);
    $dAID = $this->input->post('txtCode', TRUE);
    $Debit = 0;
    $Credit = $this->input->post('txtAmount', TRUE);
    $VDate = $this->input->post('dtpDate', TRUE);
    $customer_id = $this->input->post('customer_id', TRUE);
    $Narration = addslashes(trim($this->input->post('txtRemarks', TRUE)));
    $IsPosted = 1;
    $IsAppove = 1;
    $CreateBy = $this->session->userdata('user_id');
    $createdate = date('Y-m-d H:i:s');
    $dbtid = $dAID;
    $Credit = $Credit;
    $customerid = $customer_id;
    $customerinfo = $this->db->select('*')->from('customer_information')->where('customer_id', $customerid)->get()->row();
    $find_active_fiscal_year = $this->db->select('id')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    $customercredit = array(
      'fy_id' => $find_active_fiscal_year->id,
      'VNo' => $voucher_no,
      'Vtype' => $Vtype,
      'VDate' => $VDate,
      'COAID' => $dbtid,
      'Narration' => $Narration,
      'Debit' => 0,
      'Credit' => $Credit,
      'IsPosted' => $IsPosted,
      'CreateBy' => $CreateBy,
      'CreateDate' => $createdate,
      'IsAppove' => 1
    );
    $cc = array(
      'fy_id' => $find_active_fiscal_year->id,
      'VNo' => $voucher_no,
      'Vtype' => $Vtype,
      'VDate' => $createdate,
      'COAID' => 1111,
      'Narration' => 'Cash in box general administration(ندوق الإدارة العامة  )  For  ' . $customerinfo->customer_name,
      'Debit' => $Credit,
      'Credit' => 0,
      'IsPosted' => 1,
      'CreateBy' => $CreateBy,
      'CreateDate' => $createdate,
      'IsAppove' => 1
    );
    $this->db->insert('acc_transaction', $cc);
    $this->db->insert('acc_transaction', $customercredit);
    //receipt voucher details info
    $rate = $this->input->post('product_rate', TRUE);
    $p_id = $this->input->post('product_id', TRUE);
    $total_amount = $this->input->post('total_price', TRUE);
    $discount = $this->input->post('discount', TRUE);
    $variants = $this->input->post('variant_id', TRUE);
    $col_variants = $this->input->post('color_variant', TRUE);
    $quantity = $this->input->post('product_quantity', TRUE);
    //receipt voucher details entry
    for ($i = 0, $n = count($p_id); $i < $n; $i++) {
      $product_quantity = $quantity[$i];
      $product_rate = $rate[$i];
      $product_id = $p_id[$i];
      $discount_rate = $discount[$i];
      $total_price = $total_amount[$i];
      $variant_id = $variants[$i];
      $color_variant = $col_variants[$i];
      $receipt_voucher_details = array(
        'VNo' => $voucher_no,
        'product_id' => $product_id,
        'variant_id' => $variant_id,
        'color_variant' => $color_variant,
        'product_quantity' => $product_quantity,
        'product_rate' => $product_rate,
        'total_price' => $total_price,
        'discount' => $discount_rate,
      );
      $this->db->insert('acc_rv_details', $receipt_voucher_details);
    }
    //Insert payment method
    $card_type = $this->input->post('card_type', TRUE);
    $card_no = $this->input->post('card_no', TRUE);
    $payment_amount = $this->input->post('payment_amount', TRUE);
    if (!empty($card_type) && !empty($card_no)) {
      $acc_card_payments = [];
      for ($c = 0; $c < count($card_type); $c++) {
        $acc_card_payments[] = array(
          'cardpayment_id' => generator(15),
          'card_type' => $card_type[$c],
          'card_no' => $card_no[$c],
          'amount' => $payment_amount[$c],
          'VNo' => $voucher_no,
          'Vtype' => $Vtype,
          'date' => $VDate
        );
      }
      if (!empty($acc_card_payments)) {
        $this->db->insert_batch('acc_card_payments', $acc_card_payments);
      }
    }
    $this->session->set_flashdata('message', display('save_successfully'));
    redirect('accounting/receipt_voucher/' . $customerid . '/' . $voucher_no . '/' . $dbtid);
  }

  //This function is used to Generate Key
  public function generator($lenth)
  {
    $number = array("1", "2", "3", "4", "5", "6", "7", "8", "9");
    for ($i = 0; $i < $lenth; $i++) {
      $rand_value = rand(0, 8);
      $rand_number = $number["$rand_value"];
      if (empty($con)) {
        $con = $rand_number;
      } else {
        $con = "$con" . "$rand_number";
      }
    }
    return $con;
  }

  public function custoinfo($customer_id)
  {
    return $this->db->select('*')
      ->from('customer_information')
      ->where('customer_id', $customer_id)
      ->get()
      ->result_array();
  }

  public function customerreceiptinfo($voucher_no, $coaid)
  {
    return $this->db->select('*')
      ->from('acc_transaction')
      ->where('VNo', $voucher_no)
      ->where('COAID', $coaid)
      ->get()
      ->result_array();
  }

  public function Cashvoucher()
  {
    return $data = $this->db->select("VNo as voucher")
      ->from('acc_transaction')
      ->like('VNo', 'CHV-', 'after')
      ->order_by('ID', 'desc')
      ->get()
      ->result_array();
  }

  public function insert_cashadjustment()
  {
    $voucher_no = $this->input->post('txtVNo', TRUE);
    $Vtype = "AD";
    $amount = $this->input->post('txtAmount', TRUE);
    $type = $this->input->post('type', TRUE);
    if ($type == 1) {
      $debit = $amount;
      $credit = 0;
    }
    if ($type == 2) {
      $debit = 0;
      $credit = $amount;
    }
    $VDate = $this->input->post('dtpDate', TRUE);
    $Narration = $this->input->post('txtRemarks', TRUE);
    $IsPosted = 1;
    $IsAppove = 1;
    $createdby = $this->session->userdata('user_id');
    $createdate = date('Y-m-d H:i:s');
    $find_active_fiscal_year = $this->db->select('id')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    $cc = array(
      'fy_id' => $find_active_fiscal_year->id,
      'VNo' => $voucher_no,
      'Vtype' => $Vtype,
      'VDate' => $VDate,
      'COAID' => 1111,
      'Narration' => $Narration,
      'Debit' => $debit,
      'Credit' => $credit,
      'IsPosted' => 1,
      'CreateBy' => $createdby,
      'CreateDate' => $createdate,
      'IsAppove' => 1
    );
    $result = $this->db->insert('acc_transaction', $cc);
    return $result;
  }

  public function Transacc()
  {
    return $data = $this->db->select("HeadCode,HeadName")
      ->from('acc_coa')
      ->where('IsTransaction', 1)
      ->where_in('HeadType', ['E', 'A'])
      ->where('IsActive', 1)
      ->order_by('HeadName')
      ->get()
      ->result();
  }

  public function TransaccJ()
  {
    return $data = $this->db->select("HeadCode,HeadName")
      ->from('acc_coa')
      ->where('IsTransaction', 1)
      ->where('IsActive', 1)
      ->order_by('HeadName')
      ->get()
      ->result();
  }

  public function TransaccI()
  {
    return $data = $this->db->select("HeadCode,HeadName")
      ->from('acc_coa')
      ->where('IsTransaction', 1)
      ->where_in('HeadType', ['I', 'A'])
      ->where('IsActive', 1)
      ->order_by('HeadName')
      ->get()
      ->result();
  }

  public function voNO()
  {
    return $data = $this->db->select("VNo as voucher")
      ->from('acc_transaction')
      ->like('VNo', 'DV-', 'after')
      ->order_by('ID', 'desc')
      ->limit(1)
      ->get()
      ->result_array();
  }

  public function Cracc()
  {
    return $data = $this->db->select("HeadCode,HeadName")
      ->from('acc_coa')
      ->where_in('PHeadCode', array('111', '112'))
      ->where('IsTransaction', 1)
      ->order_by('HeadCode')
      ->get()
      ->result();
  }

  // Insert Debit voucher 
  public function insert_debitvoucher($returnData = false)
  {
    $voucher_no = addslashes(trim($this->input->post('txtVNo', TRUE)));
    $Vtype     = "DV";
    $cAID      = $this->input->post('cmbDebit', TRUE);
    $accID     = $this->input->post('cmbCode', true);
    $dAID      = $this->input->post('txtCode', TRUE);
    $Debit     = $this->input->post('txtAmount', TRUE);
    $Credit    = $this->input->post('grand_total', TRUE);
    $VDate     = $this->input->post('dtpDate', TRUE);
    $Narration = addslashes(trim($this->input->post('txtRemarks', TRUE)));
    $IsPosted  = 1;
    $IsAppove  = 0;
    $createdby  = $this->session->userdata('user_id');
    $createdate = date('Y-m-d H:i:s');
    $find_active_fiscal_year = $this->db->select('id')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    for ($i = 0; $i < count($dAID); $i++) {
      $dbtid = $dAID[$i];
      $Damnt = $Debit[$i];
      $debitheadinfo = $this->db->select('*')->from('acc_coa')->where('HeadCode', $dbtid)->get()->row();
      $debitinsert = array(
        'fy_id'     => $find_active_fiscal_year->id,
        'VNo'       => $voucher_no,
        'Vtype'     => $Vtype,
        'VDate'     => $VDate,
        'COAID'     => $dbtid,
        'Narration' => $Narration,
        'Debit'     => $Damnt,
        'Credit'    => 0,
        'IsPosted'  => $IsPosted,
        'CreateBy'  => $createdby,
        'CreateDate' => $createdate,
        'IsAppove'  => 1
      );
      $this->db->insert('acc_transaction', $debitinsert);
      $headinfo = $this->db->select('*')->from('acc_coa')->where('HeadCode', $cAID)->get()->row();
      $cinsert = array(
        'fy_id'     => $find_active_fiscal_year->id,
        'VNo'       => $voucher_no,
        'Vtype'     => $Vtype,
        'VDate'     => $VDate,
        'COAID'     => $cAID,
        'Narration' => 'Debit voucher from ' . $headinfo->HeadName,
        'Debit'     => 0,
        'Credit'    => $Damnt,
        'IsPosted'  => $IsPosted,
        'CreateBy'  => $createdby,
        'CreateDate' => $createdate,
        'IsAppove'  => 1
      );
      $this->db->insert('acc_transaction', $cinsert);

      if (substr($dbtid, 0, 3) === '113') {
        $customer = $this->db->select('*')->from('acc_coa')->where('HeadCode', $dbtid)->get()->row();
        $customerName = $this->db->select('customer_name')->from('customer_information')->where('customer_id', $customer->customer_id)->limit(1)->get()->row();
        $data2 = array(
          'transaction_id' => generator(15),
          'receipt_no' => $this->auth->generator(15),
          'customer_id' => $customer->customer_id,
          'date' => date('Y-m-d', strtotime($createdate)),
          'amount' => $Damnt,
          'status' => 1,
          'voucher' => 'Rdv',
          'details' => "سند صرف رقم PLHH - عميل $customerName->customer_name - حواله من $headinfo->HeadName الشركة",
          'Vno' => $voucher_no,
          'acc' => $voucher_no
        );
        $this->db->insert('customer_ledger', $data2);
      }
    }
    if ($returnData) {
      $debit = $Debit;
      $cmbDebit = $headinfo->HeadName;
      return compact('voucher_no', 'cmbDebit', 'dAID', 'cAID', 'debit', 'credit', 'VDate', 'Narration');
    }
  }

  // Credit voucher no
  public function crVno()
  {
    return $data = $this->db->select("VNo as voucher")
      ->from('acc_transaction')
      ->like('VNo', 'CV-', 'after')
      ->order_by('ID', 'desc')
      ->limit(1)
      ->get()
      ->result_array();
  }

  // Insert Credit voucher
  public function insert_creditvoucher($returnData = false)
  {
    $voucher_no = addslashes(trim($this->input->post('txtVNo', TRUE)));
    $Vtype     = "CV";
    $dAID      = $this->input->post('cmbDebit', TRUE);
    $cAID      = $this->input->post('txtCode', TRUE);
    $Credit    = $this->input->post('txtAmount', TRUE);
    $debit     = $this->input->post('grand_total', TRUE);
    $VDate     = $this->input->post('dtpDate', TRUE);
    $Narration = addslashes(trim($this->input->post('txtRemarks', TRUE)));
    $IsPosted  = 1;
    $IsAppove  = 0;
    $createdby = $this->session->userdata('user_id');
    $createdate = date('Y-m-d H:i:s');
    $find_active_fiscal_year = $this->db->select('id')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    for ($i = 0; $i < count($cAID); $i++) {
      $crtid = $cAID[$i];
      $Cramnt = $Credit[$i];
      $debitheadinfo = $this->db->select('*')->from('acc_coa')->where('HeadCode', $crtid)->get()->row();
      $debitinsert  = array(
        'fy_id'     => $find_active_fiscal_year->id,
        'VNo'       => $voucher_no,
        'Vtype'     => $Vtype,
        'VDate'     => $VDate,
        'COAID'     => $crtid,
        'Narration' => $Narration,
        'Debit'     => 0,
        'Credit'    => $Cramnt,
        'IsPosted'  => $IsPosted,
        'CreateBy'  => $createdby,
        'CreateDate' => $createdate,
        'IsAppove'  => 1
      );
      $this->db->insert('acc_transaction', $debitinsert);
      $headinfo = $this->db->select('*')->from('acc_coa')->where('HeadCode', $dAID)->get()->row();
      $cinsert = array(
        'fy_id'     => $find_active_fiscal_year->id,
        'VNo'       => $voucher_no,
        'Vtype'     => $Vtype,
        'VDate'     => $VDate,
        'COAID'     => $dAID,
        'Narration' => 'Credit Vourcher from ' . $headinfo->HeadName,
        'Debit'     => $Cramnt,
        'Credit'    => 0,
        'IsPosted'  => $IsPosted,
        'CreateBy'  => $createdby,
        'CreateDate' => $createdate,
        'IsAppove'  => 1
      );
      $this->db->insert('acc_transaction', $cinsert);

      if (substr($crtid, 0, 3) === '113') {
        $customer = $this->db->select('*')->from('acc_coa')->where('HeadCode', $crtid)->get()->row();
        $customerName = $this->db->select('customer_name')->from('customer_information')->where('customer_id', $customer->customer_id)->limit(1)->get()->row();
        $data2 = array(
          'transaction_id' => generator(15),
          'customer_id' => $customer->customer_id,
          'date' => date('Y-m-d', $createdate),
          'amount' => $Cramnt,
          'payment_type' => 1,
          'description' => 'ITP',
          'status' => 1,
          'voucher' => 'Rcv',
          'details' => "سند قبض رقم PLHH - عميل $customerName->customer_name - حواله على $headinfo->HeadName الشركة",
          'Vno' => $voucher_no,
          'acc' => $voucher_no
        );
        $this->db->insert('customer_ledger', $data2);
      }


      $headinfo = $this->db->select('*')->from('acc_coa')->where('HeadCode', $dAID)->get()->row();
    }
    if ($returnData) {
      $debit = $Credit;
      $cmbDebit = $headinfo->HeadName;
      return compact('voucher_no', 'cmbDebit', 'dAID', 'cAID', 'debit', 'credit', 'VDate', 'Narration');
    }
    return true;
  }

  // Insert Credit voucher
  public function insert_payment_voucher()
  {
    $voucher_no = addslashes(trim($this->input->post('txtVNo', TRUE)));
    $Vtype = "PV";
    $dAID = $this->input->post('cmbDebit', TRUE);
    $cAID = $this->input->post('txtCode', TRUE);
    $Credit = $this->input->post('txtAmount', TRUE);
    $debit = $this->input->post('grand_total', TRUE);
    $VDate = $this->input->post('dtpDate', TRUE);
    $Narration = addslashes(trim($this->input->post('txtRemarks', TRUE)));
    $IsPosted = 1;
    $IsAppove = 0;
    $createdby = $this->session->userdata('user_id');
    $createdate = date('Y-m-d H:i:s');

    $crtid = $cAID;
    $Cramnt = $Credit;
    $debitheadinfo = $this->db->select('*')->from('acc_coa')->where('HeadCode', $crtid)->get()->row();
    $debitinsert = array(
      'VNo' => $voucher_no,
      'Vtype' => $Vtype,
      'VDate' => $VDate,
      'COAID' => $crtid,
      'Narration' => $Narration,
      'Debit' => 0,
      'Credit' => $Cramnt,
      'IsPosted' => $IsPosted,
      'CreateBy' => $createdby,
      'CreateDate' => $createdate,
      'IsAppove' => 0
    );
    $this->db->insert('acc_transaction', $debitinsert);
    $headinfo = $this->db->select('*')->from('acc_coa')->where('HeadCode', $dAID)->get()->row();
    $cinsert = array(
      'VNo' => $voucher_no,
      'Vtype' => $Vtype,
      'VDate' => $VDate,
      'COAID' => $dAID,
      'Narration' => 'Credit Vourcher from ' . $headinfo->HeadName,
      'Debit' => $Cramnt,
      'Credit' => 0,
      'IsPosted' => $IsPosted,
      'CreateBy' => $createdby,
      'CreateDate' => $createdate,
      'IsAppove' => 0
    );
    $this->db->insert('acc_transaction', $cinsert);
    $headinfo = $this->db->select('*')->from('acc_coa')->where('HeadCode', $dAID)->get()->row();

    //Insert payment method
    $card_type = $this->input->post('card_type', TRUE);
    $card_no = $this->input->post('card_no', TRUE);
    $payment_amount = $this->input->post('payment_amount', TRUE);
    if (!empty($card_type) && !empty($card_no)) {
      $acc_card_payments = [];
      for ($c = 0; $c < count($card_type); $c++) {

        $acc_card_payments[] = array(
          'cardpayment_id' => generator(15),
          'card_type' => $card_type[$c],
          'card_no' => $card_no[$c],
          'amount' => $payment_amount[$c],
          'VNo' => $voucher_no,
          'Vtype' => $Vtype,
          'date' => $VDate
        );
      }
      if (!empty($acc_card_payments)) {
        $this->db->insert_batch('acc_card_payments', $acc_card_payments);
      }
    }

    return true;
  }

  // Contra voucher
  public function contra()
  {
    return $data = $this->db->select("Max(VNo) as voucher")
      ->from('acc_transaction')
      ->like('VNo', 'Contra-', 'after')
      ->order_by('ID', 'desc')
      ->get()
      ->result_array();
  }

  // Insert Countra voucher
  public function insert_contravoucher($returnData = false)
  {
    $voucher_no = addslashes(trim($this->input->post('txtVNo', TRUE)));
    $Vtype     = "Contra";
    $dAID      = $this->input->post('cmbDebit', TRUE);
    $cAID      = $this->input->post('txtCode', TRUE);
    $debit     = $this->input->post('txtAmount', TRUE);
    $credit    = $this->input->post('txtAmountcr', TRUE);
    $VDate     = $this->input->post('dtpDate', TRUE);
    $Narration = addslashes(trim($this->input->post('txtRemarks', TRUE)));
    $IsPosted  = 1;
    $IsAppove  = 0;
    $CreateBy  = $this->session->userdata('user_id');
    $createdate = date('Y-m-d H:i:s');
    $find_active_fiscal_year = $this->db->select('id')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    for ($i = 0; $i < count($cAID); $i++) {
      $crtid = $cAID[$i];
      $Cramnt = $credit[$i];
      $debits = $debit[$i];
      $contrainsert = array(
        'fy_id'     => $find_active_fiscal_year->id,
        'VNo'       => $voucher_no,
        'Vtype'     => $Vtype,
        'VDate'     => $VDate,
        'COAID'     => $crtid,
        'Narration' => $Narration,
        'Debit'     => $debits,
        'Credit'    => $Cramnt,
        'IsPosted'  => $IsPosted,
        'CreateBy'  => $CreateBy,
        'CreateDate' => $createdate,
        'IsAppove'  => 1,
      );
      $this->db->insert('acc_transaction', $contrainsert);
    }
    if ($returnData) {
      return compact('voucher_no', 'dAID', 'cAID', 'debit', 'credit', 'VDate', 'Narration');
    }
    return true;
  }

  // journal voucher no
  public function journal()
  {
    return $data = $this->db->select("VNo as voucher")
      ->from('acc_transaction')
      ->like('VNo', 'Journal-', 'after')
      ->order_by('ID', 'desc')
      ->get()
      ->row();
  }

  // Insert journal voucher
  public function insert_journalvoucher($returnData = false)
  {
    $voucher_no = addslashes(trim($this->input->post('txtVNo', TRUE)));
    $Vtype     = "JV";
    $dAID      = $this->input->post('cmbDebit', TRUE);
    $cAID      = $this->input->post('txtCode', TRUE);
    $debit     = $this->input->post('txtAmount', TRUE);
    $credit    = $this->input->post('txtAmountcr', TRUE);
    $VDate     = $this->input->post('dtpDate', TRUE);
    $Narration = addslashes(trim($this->input->post('txtRemarks', TRUE)));
    $IsPosted  = 1;
    $IsAppove  = 0;
    $CreateBy  = $this->session->userdata('user_id');
    $createdate = date('Y-m-d H:i:s');
    $find_active_fiscal_year = $this->db->select('id')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    for ($i = 0; $i < count($cAID); $i++) {
      $crtid = $cAID[$i];
      $Cramnt = $credit[$i];
      $debits = $debit[$i];
      $contrainsert = array(
        'fy_id'     => $find_active_fiscal_year->id,
        'VNo'       => $voucher_no,
        'Vtype'     => $Vtype,
        'VDate'     => $VDate,
        'COAID'     => $crtid,
        'Narration' => $Narration,
        'Debit'     => $debits,
        'Credit'    => $Cramnt,
        'IsPosted'  => $IsPosted,
        'CreateBy'  => $CreateBy,
        'CreateDate' => $createdate,
        'IsAppove'  => 1
      );
      $this->db->insert('acc_transaction', $contrainsert);

      // $headinfo = $this->db->select('*')->from('acc_coa')->where('HeadCode', $crtid)->get()->row();

      if (substr($crtid, 0, 3) === '113') {
        $customer = $this->db->select('*')->from('acc_coa')->where('HeadCode', $crtid)->get()->row();
        $customerName = $this->db->select('customer_name')->from('customer_information')->where('customer_id', $customer->customer_id)->limit(1)->get()->row();
        if ((float)$Cramnt > 0) {
          $data2 = array(
            'transaction_id' => generator(15),
            'customer_id' => $customer->customer_id,
            'date' => date('Y-m-d', $createdate),
            'amount' => $Cramnt,
            'payment_type' => 1,
            'description' => 'ITP',
            'status' => 1,
            'voucher' => 'Rcv',
            'details' => "سند قبض رقم PLHH - عميل $customerName->customer_name ",
            'Vno' => $voucher_no,
            'acc' => $voucher_no
          );
          $this->db->insert('customer_ledger', $data2);
        }

        if ((float)$debits > 0) {
          $data2 = array(
            'transaction_id' => generator(15),
            'receipt_no' => $this->auth->generator(15),
            'customer_id' => $customer->customer_id,
            'date' => date('Y-m-d', $createdate),
            'amount' => $debits,
            'status' => 1,
            'voucher' => 'Rdv',
            'details' => "سند صرف رقم PLHH - عميل $customerName->customer_name ",
            'Vno' => $voucher_no,
            'acc' => $voucher_no
          );
          $this->db->insert('customer_ledger', $data2);
        }
      }

      if (substr($crtid, 0, 4) === '2111') {
        $supplier = $this->db->select('*')->from('acc_coa')->where('HeadCode', $crtid)->get()->row();
        if ((float)$Cramnt > 0) {
          $data2 = array(
            'invoice_no'    =>  null,
            'deposit_no'    =>  $this->auth->generator(10),
            'transaction_id' => generator(15),
            'supplier_id' => $supplier->supplier_id,
            'date' => date('Y-m-d', $createdate),
            'amount' => $Cramnt,
            'description' => 'ITP',
            'status' => 1,
            'voucher' => 'JV',
            'payment_type'  =>  1,
            'sl_created_at' => $createdate
          );
          $this->db->insert('supplier_ledger', $data2);
        }

        if ((float)$debits > 0) {
          $data2 = array(
            'invoice_no'    =>  null,
            'deposit_no'    =>  null,
            'transaction_id' => generator(15),
            'supplier_id' => $supplier->supplier_id,
            'date' => date('Y-m-d', $createdate),
            'amount' => $debits,
            'status' => 1,
            'voucher' => 'JV',
            'payment_type'  =>  1,
            'sl_created_at' => $createdate,
            'description' => 'ITP'
          );
          $this->db->insert('supplier_ledger', $data2);
        }
      }
    }
    if ($returnData) {
      return compact('voucher_no', 'dAID', 'cAID', 'debit', 'credit', 'VDate', 'Narration');
    }
    return true;
  }

  // voucher Aprove
  public function approve_voucher()
  {
    $values = array("DV", "CV", "JV", "Contra");
    return $approveinfo = $this->db->select('*,sum(Credit) as Credit,sum(Debit) as Debit')
      ->from('acc_transaction')
      ->where_in('Vtype', $values)
      ->where('IsAppove', 0)
      ->group_by('VNo')
      ->get()
      ->result();
  }

  //approved
  public function approved($data = [])
  {
    $trans_data = $this->db->select('*')->from('acc_transaction')->where('VNo', $data['VNo'])->get();

    if (!empty($trans_data)) {
      $trans_data = $trans_data->result();
      // echo "<pre>";var_dump($trans_data);exit;
      foreach ($trans_data as $trans) {
        $customer = $this->db->select('*')->from('acc_coa')->where('HeadCode', $trans->COAID)->get()->row();

        if (in_array($trans->Vtype, ['CV', 'DV', 'JV']) && substr($trans->COAID, 0, 3) === '113') {
          // echo "<pre>";var_dump($trans);exit;

          // insert into customer ledger
          if ($trans->Vtype == 'CV' || ($trans->Vtype == 'JV' && (float)$trans->Credit > 0)) {
            $data2 = array(
              'transaction_id' => generator(15),
              'customer_id' => $customer->customer_id,
              'date' => date('Y-m-d', strtotime($trans->CreateDate)),
              'amount' => $trans->Credit,
              'payment_type' => 1,
              'description' => 'ITP',
              'status' => 1
            );
            $this->db->insert('customer_ledger', $data2);
          }

          if ($trans->Vtype == 'DV' || ($trans->Vtype == 'JV' && (float)$trans->Debit > 0)) {
            //Insert to customer ledger Table 
            $data2 = array(
              'transaction_id' => generator(15),
              'receipt_no' => $this->auth->generator(15),
              'customer_id' => $customer->customer_id,
              'date' => date('Y-m-d', strtotime($trans->CreateDate)),
              'amount' => $trans->Debit,
              'status' => 1
            );
            $this->db->insert('customer_ledger', $data2);
          }
        }
      }
    }

    return $this->db->where('VNo', $data['VNo'])
      ->update('acc_transaction', $data);
  }

  //debit update voucher
  public function dbvoucher_updata($id)
  {
    return $vou_info = $this->db->select('*')
      ->from('acc_transaction')
      ->where('VNo', $id)
      ->where('Credit <', 1)
      ->get()
      ->result();
  }

  public function journal_updata($id)
  {
    return $vou_info = $this->db->select('*')
      ->from('acc_transaction')
      ->where('VNo', $id)
      ->get()
      ->result_array();
  }

  //credit voucher update
  public function crdtvoucher_updata($id)
  {
    return $vou_info = $this->db->select('*')
      ->from('acc_transaction')
      ->where('VNo', $id)
      ->where('Debit <', 1)
      ->get()
      ->result();
  }

  //Debit voucher inof
  public function debitvoucher_updata($id)
  {
    return $cr_info = $this->db->select('*')
      ->from('acc_transaction')
      ->where('VNo', $id)
      ->where('Credit<', 1)
      ->get()
      ->result_array();
  }

  // debit update voucher credit info
  public function crvoucher_updata($id)
  {
    return $v_info = $this->db->select('*')
      ->from('acc_transaction')
      ->where('VNo', $id)
      ->where('Debit<', 1)
      ->get()
      ->result_array();
  }

  public function update_contravoucher()
  {
    $voucher_no = addslashes(trim($this->input->post('txtVNo', TRUE)));
    $Vtype = "Contra";
    $dAID = $this->input->post('cmbDebit', TRUE);
    $cAID = $this->input->post('txtCode', TRUE);
    $debit = $this->input->post('txtAmount', TRUE);
    $credit = $this->input->post('txtAmountcr', TRUE);
    $VDate = $this->input->post('dtpDate', TRUE);
    $Narration = addslashes(trim($this->input->post('txtRemarks', TRUE)));
    $IsPosted = 1;
    $IsAppove = 0;
    $CreateBy = $this->session->userdata('user_id');
    $createdate = date('Y-m-d H:i:s');
    $this->db->where(' VNo', $voucher_no);
    $this->db->delete('acc_transaction');

    for ($i = 0; $i < count($cAID); $i++) {
      $crtid = $cAID[$i];
      $Cramnt = $credit[$i];
      $debits = $debit[$i];
      $contrainsert = array(
        'VNo' => $voucher_no,
        'Vtype' => $Vtype,
        'VDate' => $VDate,
        'COAID' => $crtid,
        'Narration' => $Narration,
        'Debit' => $debits,
        'Credit' => $Cramnt,
        'IsPosted' => $IsPosted,
        'CreateBy' => $CreateBy,
        'CreateDate' => $createdate,
        'IsAppove' => 0
      );
      $this->db->insert('acc_transaction', $contrainsert);
    }
    return true;
  }

  // update Credit voucher
  public function update_creditvoucher()
  {
    $voucher_no = addslashes(trim($this->input->post('txtVNo', TRUE)));
    $Vtype = "CV";
    $dAID = $this->input->post('cmbDebit', TRUE);
    $cAID = $this->input->post('txtCode', TRUE);
    $Credit = $this->input->post('txtAmount', TRUE);
    $debit = $this->input->post('grand_total', TRUE);
    $VDate = $this->input->post('dtpDate', TRUE);
    $Narration = addslashes(trim($this->input->post('txtRemarks', TRUE)));
    $IsPosted = 1;
    $IsAppove = 0;
    $CreateBy = $this->session->userdata('id');
    $createdate = date('Y-m-d H:i:s');
    $this->db->where('VNo', $voucher_no)
      ->delete('acc_transaction');
    for ($i = 0; $i < count($cAID); $i++) {
      $crtid = $cAID[$i];
      $Cramnt = $Credit[$i];
      $debitheadinfo = $this->db->select('*')->from('acc_coa')->where('HeadCode', $crtid)->get()->row();
      $debitinsert = array(
        'VNo' => $voucher_no,
        'Vtype' => $Vtype,
        'VDate' => $VDate,
        'COAID' => $crtid,
        'Narration' => $Narration,
        'Debit' => 0,
        'Credit' => $Cramnt,
        'IsPosted' => $IsPosted,
        'CreateBy' => $CreateBy,
        'CreateDate' => $createdate,
        'IsAppove' => 0
      );
      $this->db->insert('acc_transaction', $debitinsert);
      $headinfo = $this->db->select('*')->from('acc_coa')->where('HeadCode', $dAID)->get()->row();
      $cinsert = array(
        'VNo' => $voucher_no,
        'Vtype' => $Vtype,
        'VDate' => $VDate,
        'COAID' => $dAID,
        'Narration' => 'Credit Vourcher from ' . $headinfo->HeadName,
        'Debit' => $Cramnt,
        'Credit' => 0,
        'IsPosted' => $IsPosted,
        'CreateBy' => $CreateBy,
        'CreateDate' => $createdate,
        'IsAppove' => 0
      );
      $this->db->insert('acc_transaction', $cinsert);
      $headinfo = $this->db->select('*')->from('acc_coa')->where('HeadCode', $dAID)->get()->row();
    }
    return true;
  }

  // Update debit voucher
  public function update_debitvoucher()
  {
    $voucher_no = $this->input->post('txtVNo', TRUE);
    $Vtype = "DV";
    $cAID = $this->input->post('cmbDebit', TRUE);
    $dAID = $this->input->post('txtCode', TRUE);
    $Debit = $this->input->post('txtAmount', TRUE);
    $Credit = $this->input->post('grand_total', TRUE);
    $VDate = $this->input->post('dtpDate', TRUE);
    $Narration = addslashes(trim($this->input->post('txtRemarks', TRUE)));
    $IsPosted = 1;
    $IsAppove = 0;
    $CreateBy = $this->session->userdata('user_id');
    $createdate = date('Y-m-d H:i:s');
    $this->db->where('VNo', $voucher_no)
      ->delete('acc_transaction');
    for ($i = 0; $i < count($dAID); $i++) {
      $dbtid = $dAID[$i];
      $Damnt = $Debit[$i];
      $debitheadinfo = $this->db->select('*')->from('acc_coa')->where('HeadCode', $dbtid)->get()->row();
      $debitinsert = array(
        'VNo' => $voucher_no,
        'Vtype' => $Vtype,
        'VDate' => $VDate,
        'COAID' => $dbtid,
        'Narration' => $Narration,
        'Debit' => $Damnt,
        'Credit' => 0,
        'IsPosted' => $IsPosted,
        'CreateBy' => $CreateBy,
        'CreateDate' => $createdate,
        'IsAppove' => 0
      );
      $this->db->insert('acc_transaction', $debitinsert);
      $headinfo = $this->db->select('*')->from('acc_coa')->where('HeadCode', $cAID)->get()->row();
      $cinsert = array(
        'VNo' => $voucher_no,
        'Vtype' => $Vtype,
        'VDate' => $VDate,
        'COAID' => $cAID,
        'Narration' => 'Debit voucher from ' . $headinfo->HeadName,
        'Debit' => 0,
        'Credit' => $Damnt,
        'IsPosted' => $IsPosted,
        'CreateBy' => $CreateBy,
        'CreateDate' => $createdate,
        'IsAppove' => 0
      );
      $this->db->insert('acc_transaction', $cinsert);
    }
    return true;
  }

  public function update_journalvoucher()
  {
    $voucher_no = addslashes(trim($this->input->post('txtVNo', TRUE)));
    $Vtype = "JV";
    $dAID = $this->input->post('cmbDebit', TRUE);
    $cAID = $this->input->post('txtCode', TRUE);
    $debit = $this->input->post('txtAmount', TRUE);
    $credit = $this->input->post('txtAmountcr', TRUE);
    $VDate = $this->input->post('dtpDate', TRUE);
    $Narration = addslashes(trim($this->input->post('txtRemarks', TRUE)));
    $IsPosted = 1;
    $IsAppove = 0;
    $CreateBy = $this->session->userdata('user_id');
    $createdate = date('Y-m-d H:i:s');
    $this->db->where(' VNo', $voucher_no);
    $this->db->delete('acc_transaction');

    for ($i = 0; $i < count($cAID); $i++) {
      $crtid = $cAID[$i];
      $Cramnt = $credit[$i];
      $debits = $debit[$i];
      $contrainsert = array(
        'VNo' => $voucher_no,
        'Vtype' => $Vtype,
        'VDate' => $VDate,
        'COAID' => $crtid,
        'Narration' => $Narration,
        'Debit' => $debits,
        'Credit' => $Cramnt,
        'IsPosted' => $IsPosted,
        'CreateBy' => $CreateBy,
        'CreateDate' => $createdate,
        'IsAppove' => 0
      );
      $this->db->insert('acc_transaction', $contrainsert);
    }
    return true;
  }

  public function delete_voucher($voucher)
  {
    $this->db->where('VNo', $voucher)
      ->delete('acc_transaction');
    if ($this->db->affected_rows()) {
      return true;
    } else {
      return false;
    }
  }

  public function cashbook_firstqury($FromDate, $HeadCode)
  {
    $sql = "SELECT SUM(Debit) Debit, SUM(Credit) Credit, IsAppove, COAID FROM acc_transaction
                WHERE VDate < '$FromDate' AND COAID LIKE '$HeadCode%' AND IsAppove =1 GROUP BY IsAppove, COAID";
    return $sql;
  }

  public function cashbook_secondqury($FromDate, $HeadCode, $ToDate)
  {
    $sql = "SELECT acc_transaction.ID,acc_transaction.VNo, acc_transaction.Vtype, acc_transaction.VDate, acc_transaction.Debit, acc_transaction.Credit, acc_transaction.IsAppove, acc_transaction.COAID, acc_coa.HeadName, acc_coa.PHeadName, acc_coa.HeadType, acc_transaction.Narration 
          FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode
          WHERE acc_transaction.IsAppove =1 AND acc_transaction.VDate BETWEEN '$FromDate' AND '$ToDate' AND acc_transaction.COAID LIKE '$HeadCode%' GROUP BY acc_transaction.VNo, acc_transaction.Vtype, acc_transaction.VDate, acc_transaction.IsAppove, acc_transaction.COAID, acc_coa.HeadName, acc_coa.PHeadName, acc_coa.HeadType, acc_transaction.Narration
                 HAVING SUM(acc_transaction.Debit)-SUM(acc_transaction.Credit)<>0
                 ORDER BY  acc_transaction.VDate, acc_transaction.VNo";

    return $sql;
  }

  public function inventoryledger_firstqury($FromDate, $HeadCode)
  {
    $sql = "SELECT SUM(Debit) Debit, SUM(Credit) Credit, IsAppove, COAID FROM acc_transaction
                WHERE VDate < '$FromDate 00:00:00' AND COAID = '$HeadCode' AND IsAppove =1 GROUP BY IsAppove, COAID";
    return $sql;
  }

  public function inventoryledger_secondqury($FromDate, $HeadCode, $ToDate)
  {
    $sql = "SELECT acc_transaction.VNo, acc_transaction.Vtype, acc_transaction.VDate, acc_transaction.Debit, acc_transaction.Credit, acc_transaction.IsAppove, acc_transaction.COAID, acc_coa.HeadName, acc_coa.PHeadName, acc_coa.HeadType, acc_transaction.Narration 
       FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode
           WHERE acc_transaction.IsAppove =1 AND VDate BETWEEN '$FromDate 00:00:00' AND '$ToDate 00:00:00' AND acc_transaction.COAID='$HeadCode' ORDER BY  acc_transaction.VDate, acc_transaction.VNo";
    return $sql;
  }

  public function trial_balance_firstquery($dtpFromDate, $dtpToDate, $COAID)
  {
    $sql = "SELECT SUM(acc_transaction.Debit) AS Debit, SUM(acc_transaction.Credit) AS Credit FROM acc_transaction WHERE acc_transaction.IsAppove =1 AND VDate BETWEEN '" . $dtpFromDate . "' AND '" . $dtpToDate . "' AND COAID LIKE '$COAID%' ";
    return $sql;
  }

  public function trial_balance_secondquery($dtpFromDate, $dtpToDate, $COAID)
  {
    $sql = "SELECT SUM(acc_transaction.Debit) AS Debit, SUM(acc_transaction.Credit) AS Credit FROM acc_transaction WHERE acc_transaction.IsAppove =1 AND VDate BETWEEN '" . $dtpFromDate . "' AND '" . $dtpToDate . "' AND COAID LIKE '$COAID%' ";

    return $sql;
  }

  public function profitloss_firstquery($dtpFromDate, $dtpToDate, $COAID)
  {
    $sql = "SELECT SUM(acc_transaction.Debit)-SUM(acc_transaction.Credit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE VDate BETWEEN '$dtpFromDate' AND '$dtpToDate' AND COAID LIKE '$COAID%'";
    return $sql;
  }

  public function profitloss_secondquery($dtpFromDate, $dtpToDate, $COAID)
  {
    $sql = "SELECT SUM(acc_transaction.Credit)-SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '$dtpFromDate' AND '$dtpToDate' AND COAID LIKE '$COAID%'";
    return $sql;
  }

  public function cashflow_firstquery()
  {
    $sql = "SELECT * FROM acc_coa WHERE acc_coa.IsTransaction=1 AND acc_coa.HeadType='A' AND acc_coa.IsActive=1 AND acc_coa.HeadCode LIKE '1020101%'";
    return $sql;
  }

  public function cashflow_secondquery($dtpFromDate, $dtpToDate, $COAID)
  {
    $sql = "SELECT SUM(acc_transaction.Debit)- SUM(acc_transaction.Credit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove =1 AND VDate BETWEEN '" . $dtpFromDate . "' AND '" . $dtpToDate . "' AND COAID LIKE '$COAID%'";
    return $sql;
  }

  public function cashflow_thirdquery()
  {
    $sql = "SELECT * FROM acc_coa WHERE IsGL=1 AND HeadCode LIKE '102%' AND IsActive=1 AND HeadCode NOT LIKE '1020101%' AND HeadCode!='102' ";
    return $sql;
  }

  public function cashflow_forthquery($dtpFromDate, $dtpToDate, $COAID)
  {
    $sql = "SELECT  SUM(acc_transaction.Credit) - SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '" . $dtpFromDate . "' AND '" . $dtpToDate . "' AND COAID LIKE '$COAID%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '1020101%') ";
    return $sql;
  }

  public function cashflow_fifthquery($dtpFromDate, $dtpToDate, $COAID)
  {
    $sql = "SELECT  SUM(acc_transaction.Credit) - SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '" . $dtpFromDate . "' AND '" . $dtpToDate . "' AND COAID LIKE '4%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '1020101%') ";
    return $sql;
  }

  public function cashflow_sixthquery()
  {
    $sql = "SELECT * FROM acc_coa WHERE IsGL=1 AND HeadCode LIKE '3%' AND IsActive=1 ";
    return $sql;
  }

  public function cashflow_seventhquery($dtpFromDate, $dtpToDate, $COAID)
  {
    $sql = "SELECT  SUM(acc_transaction.Credit) - SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '" . $dtpFromDate . "' AND '" . $dtpToDate . "' AND COAID LIKE '$COAID%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '1020101%') ";
    return $sql;
  }

  public function get_general_ledger()
  {
    $this->db->select('*');
    $this->db->from('acc_coa');
    $this->db->where('IsGL', 1);
    $this->db->order_by('HeadName', 'asc');
    $query = $this->db->get();
    return $query->result();
  }

  public function general_led_get($Headid)
  {
    $sql = "SELECT * FROM acc_coa WHERE HeadCode='$Headid' ";
    $query = $this->db->query($sql);
    $rs = $query->row();

    $sql = "SELECT * FROM acc_coa WHERE IsTransaction=1 AND PHeadName='" . $rs->HeadName . "' ORDER BY HeadName";
    $query = $this->db->query($sql);
    return $query->result();
  }

  public function general_led_report_headname($cmbGLCode)
  {
    $this->db->select('*');
    $this->db->from('acc_coa');
    $this->db->where('HeadCode', $cmbGLCode);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function general_led_report_headname2($cmbGLCode, $cmbCode, $dtpFromDate, $dtpToDate, $chkIsTransction)
  {
    if ($chkIsTransction) {
      $this->db->select('acc_transaction.VNo,acc_transaction.VDate, acc_transaction.Vtype, acc_transaction.VDate, acc_transaction.Narration, acc_transaction.Debit, acc_transaction.Credit, acc_transaction.IsAppove, acc_transaction.COAID,acc_coa.HeadName, acc_coa.PHeadName, acc_coa.HeadType');
      $this->db->from('acc_transaction');
      $this->db->join('acc_coa', 'acc_transaction.COAID = acc_coa.HeadCode', 'left');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('VDate BETWEEN "' . $dtpFromDate . '" and "' . $dtpToDate . '"');
      $this->db->where('acc_transaction.COAID', $cmbCode);

      $query = $this->db->get();
      return $query->result();
    } else {
      $this->db->select('acc_transaction.COAID,acc_transaction.VDate,acc_transaction.Debit, acc_transaction.Credit,acc_coa.HeadName,acc_transaction.IsAppove, acc_coa.PHeadName, acc_coa.HeadType');
      $this->db->from('acc_transaction');
      $this->db->join('acc_coa', 'acc_transaction.COAID = acc_coa.HeadCode', 'left');
      $this->db->where('acc_transaction.IsAppove', 1);
      $this->db->where('VDate BETWEEN "' . $dtpFromDate . '" and "' . $dtpToDate . '"');
      $this->db->where('acc_transaction.COAID', $cmbCode);
      $query = $this->db->get();
      return $query->result();
    }
  }

  // prebalance calculation
  public function general_led_report_prebalance($cmbCode, $dtpFromDate)
  {
    $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
    $this->db->from('acc_transaction');
    $this->db->where('acc_transaction.IsAppove', 1);
    $this->db->where('VDate < ', $dtpFromDate);
    $this->db->where('acc_transaction.COAID', $cmbCode);
    $query = $this->db->get()->row();

    return $balance = $query->predebit - $query->precredit;
  }

  //Trial Balance Report
  public function trial_balance_report($FromDate, $ToDate, $WithOpening)
  {
    if ($WithOpening)
      $WithOpening = true;
    else
      $WithOpening = false;
    $sql = "SELECT * FROM acc_coa WHERE IsGL=1 AND IsActive=1 AND HeadType IN ('A','L') ORDER BY HeadCode";
    $oResultTr = $this->db->query($sql);
    $sql = "SELECT * FROM acc_coa WHERE IsGL=1 AND IsActive=1 AND HeadType IN ('I','E') ORDER BY HeadCode";
    $oResultInEx = $this->db->query($sql);
    $data = array(
      'oResultTr' => $oResultTr->result_array(),
      'oResultInEx' => $oResultInEx->result_array(),
      'WithOpening' => $WithOpening
    );
    return $data;
  }

  //Profict loss report search
  public function profit_loss_serach()
  {
    $sql = "SELECT * FROM acc_coa WHERE acc_coa.HeadType='I'";
    $sql1 = $this->db->query($sql);
    $sql = "SELECT * FROM acc_coa WHERE acc_coa.HeadType='E'";
    $sql2 = $this->db->query($sql);
    $data = array(
      'oResultAsset' => $sql1->result(),
      'oResultLiability' => $sql2->result(),
    );
    return $data;
  }

  public function profit_loss_serach_date($dtpFromDate, $dtpToDate)
  {
    $sqlF = "SELECT  acc_transaction.VDate, acc_transaction.COAID, acc_coa.HeadName FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.VDate BETWEEN '$dtpFromDate' AND '$dtpToDate' AND acc_transaction.IsAppove = 1 AND  acc_transaction.COAID LIKE '301%'";
    $query = $this->db->query($sqlF);
    return $query->result();
  }

  public function fixed_assets()
  {
    return $this->db->select('*')
      ->from('acc_coa')
      ->where('PHeadName', 'Assets')
      ->get()
      ->result_array();
  }

  public function assets_info($head_name)
  {
    $this->db->select("*");
    $this->db->from('acc_coa');
    $this->db->where('PHeadName', $head_name);
    $this->db->group_by('HeadCode');
    return $records = $this->db->get()->result_array();
  }

  public function asset_childs($head_name, $from_date, $to_date)
  {
    $this->db->select("*");
    $this->db->from('acc_coa');
    $this->db->where('PHeadName', $head_name);
    $this->db->group_by('HeadCode');
    return $records = $this->db->get()->result_array();
  }

  public function assets_balance($head_code, $from_date, $to_date)
  {
    $this->db->select("(sum(Debit)-sum(Credit)) as balance");
    $this->db->from('acc_transaction');
    $this->db->where('COAID', $head_code);
    $this->db->where('VDate >=', $from_date);
    $this->db->where('VDate <=', $to_date);
    $this->db->where('IsAppove', 1);
    return $records = $this->db->get()->result_array();
  }

  public function asset_child_byheadname($head_name, $from_date, $to_date)
  {
    $this->db->select("b.*,b.HeadCode,(sum(a.Debit)-sum(a.Credit)) as balance");
    $this->db->from('acc_coa b');
    $this->db->join('acc_transaction a', 'b.HeadCode = a.COAID');
    $this->db->where('b.HeadName', $head_name);
    $this->db->where('a.VDate >=', $from_date);
    $this->db->where('a.VDate <=', $to_date);
    $this->db->where('a.IsAppove', 1);
    $this->db->group_by('b.HeadCode');
    return $records = $this->db->get()->result_array();
  }

  public function liabilities_data()
  {
    return $this->db->select('*')
      ->from('acc_coa')
      ->where('PHeadName', 'Liabilities')
      ->get()
      ->result_array();
  }

  public function liabilities_info($head_name)
  {
    $this->db->select("*");
    $this->db->from('acc_coa');
    $this->db->where('PHeadName', $head_name);
    return $records = $this->db->get()->result_array();
  }

  public function liabilities_info_tax($head_name)
  {
    $this->db->select("*");
    $this->db->from('acc_coa');
    $this->db->where('HeadName', $head_name);
    return $records = $this->db->get()->result_array();
  }

  public function liabilities_balance($head_code, $from_date, $to_date)
  {
    $this->db->select("(sum(Credit)-sum(Debit)) as balance,COAID");
    $this->db->from('acc_transaction');
    $this->db->where('COAID', $head_code);
    $this->db->where('VDate >=', $from_date);
    $this->db->where('VDate <=', $to_date);
    $this->db->where('IsAppove', 1);
    return $records = $this->db->get()->result_array();
  }

  public function income_fields()
  {
    return $this->db->select('*')
      ->from('acc_coa')
      ->where('PHeadName', 'Income')
      ->get()
      ->result_array();
  }

  public function income_balance($head_code, $from_date, $to_date)
  {
    $this->db->select("(sum(Debit)-sum(Credit)) as balance,COAID");
    $this->db->from('acc_transaction');
    $this->db->where('COAID', $head_code);
    $this->db->where('VDate >=', $from_date);
    $this->db->where('VDate <=', $to_date);
    $this->db->where('IsAppove', 1);
    return $records = $this->db->get()->result_array();
  }

  public function expense_fields()
  {
    return $this->db->select('*')
      ->from('acc_coa')
      ->where('PHeadName', 'Expence')
      ->get()
      ->result_array();
  }

  // Insert supplier Head
  public function insert_supplier_head($data = [], $supplier_id = null)
  {

    $check_if_exists = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('supplier_id', $supplier_id)->get()->row();
    if (empty($check_if_exists)) {
      $PHead = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('HeadCode', '2111')->get()->row();
      if (!empty($PHead)) {
        $childCount = $this->db->select('MAX(HeadCode) as HeadCode')->from('acc_coa')->where('PHeadCode', '2111')->like('HeadCode', '21110', 'after')->get()->row();
        if ($childCount->HeadCode) {
          $HeadCode = $childCount->HeadCode + 1;
        } else {
          $HeadCode = '21110001';
        }
        $acc_coa = array(
          'HeadCode' => $HeadCode,
          'HeadName' => $this->input->post('supplier_name', TRUE),
          'PHeadName' => $PHead->HeadName,
          'PHeadCode' => $PHead->HeadCode,
          'HeadLevel' => 4,
          'IsActive' => 1,
          'IsTransaction' => 1,
          'IsGL' => 0,
          'HeadType' => 'L',
          'supplier_id' => $supplier_id,
          'CreateBy' => $this->session->userdata('user_name'),
          'CreateDate' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('acc_coa', $acc_coa);
      }
      return TRUE;
    }
  }

  // Insert Store Head
  public function insert_store_head($data = [], $store_id = null)
  {
    $check_if_exists = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('PHeadCode', '111')->where('store_id', $store_id)->get()->row();
    if (empty($check_if_exists)) {
      $PHead = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('HeadCode', '111')->get()->row();
      if (!empty($PHead)) {
        $childCount = $this->db->select('MAX(HeadCode) as HeadCode')->from('acc_coa')->where('PHeadCode', '111')->like('HeadCode', '1110', 'after')->get()->row();
        if ($childCount->HeadCode) {
          $HeadCode = $childCount->HeadCode + 1;
        } else {
          $HeadCode = '1110001';
        }
        $acc_coa = array(
          'HeadCode' => $HeadCode,
          'HeadName' => 'Cash in box ' . $data['store_name'],
          'PHeadName' => $PHead->HeadName,
          'PHeadCode' => $PHead->HeadCode,
          'HeadLevel' => 3,
          'IsActive' => 1,
          'IsTransaction' => 1,
          'IsGL' => 0,
          'HeadType' => 'A',
          'store_id' => $store_id,
          'CreateBy' => $this->session->userdata('user_name'),
          'CreateDate' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('acc_coa', $acc_coa);
      }
      return TRUE;
    }
  }


  public function update_store_head($data = [], $store_id)
  {

    $data['store_id'] = $store_id;
    $res = $this->db->where('store_id', $data['store_id'])->where('PHeadCode', '111')->get('acc_coa');
    if ($res->num_rows() > 0) {
      return TRUE;
    } else {
      $this->insert_store_head($data, $store_id);
    }
  }

  public function update_supplier_head($data = [], $supplier_id)
  {
    $data['supplier_id'] = $supplier_id;
    $res = $this->db->where('supplier_id', $data['supplier_id'])->get('acc_coa');
    if ($res->num_rows() > 0) {
      return TRUE;
    } else {
      $this->insert_supplier_head($data, $supplier_id);
    }
  }

  public function delete_supplier_head($supplier_id)
  {
    $check_if_exists = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('supplier_id', $supplier_id)->get()->row();
    if (!empty($check_if_exists)) {
      // Check account transaction
      $res = $this->db->select('a.ID')
        ->from('acc_transaction a')
        ->join('acc_coa b', 'b.HeadCode=a.COAID', 'left')
        ->where('b.supplier_id', $supplier_id)
        ->get();
      $hasTrans = $res->num_rows();

      if ($hasTrans > 0) {
        return false;
      } else {
        $result = $this->db->delete('acc_coa', array('supplier_id' => $supplier_id));
        return $result;
      }
    } else {
      return false;
    }
  }

  public function delete_store_head($store_id)
  {
    $check_if_exists = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('store_id', $store_id)->get()->row();
    if (!empty($check_if_exists)) {
      // Check account transaction
      $res = $this->db->select('a.ID')
        ->from('acc_transaction a')
        ->join('acc_coa b', 'b.HeadCode=a.COAID', 'left')
        ->where('b.store_id', $store_id)
        ->get();
      $hasTrans = $res->num_rows();

      if ($hasTrans > 0) {
        return false;
      } else {
        $result = $this->db->delete('acc_coa', array('store_id' => $store_id));
        return $result;
      }
    } else {
      return false;
    }
  }

  public function customer_headcode()
  {
    $query = $this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='4' And HeadCode LIKE '10203%'");
    return $query->row();
  }

  public function insert_customer_head($data = [])
  {
    $check_customer_head = $this->db->select('*')->from('acc_coa')->where('customer_id', $data['customer_id'])->get()->row();
    if (empty($check_customer_head)) {
      $PHead = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('HeadCode', '1131')->get()->row();
      if (!empty($PHead)) {
        $childCount = $this->db->select('MAX(HeadCode) as HeadCode')->from('acc_coa')->where('PHeadCode', '1131')->like('HeadCode', '11310', 'after')->get()->row();
        if ($childCount->HeadCode) {
          $HeadCode = $childCount->HeadCode + 1;
        } else {
          $HeadCode = '11310001';
        }
        $c_acc = $data['customer_name'] . ' - ' . $data['customer_id'];
        $createby = $this->session->userdata('user_name');
        $createdate = date('Y-m-d H:i:s');

        $customer_coa = [
          'HeadCode' => $HeadCode,
          'HeadName' => $c_acc,
          'PHeadName' => $PHead->HeadName,
          'PHeadCode' => $PHead->HeadCode,
          'HeadLevel' => '4',
          'IsActive' => '1',
          'IsTransaction' => '1',
          'IsGL' => '0',
          'HeadType' => 'A',
          'customer_id' => $data['customer_id'],
          'CreateBy' => $createby,
          'CreateDate' => $createdate,
        ];
        $this->db->insert('acc_coa', $customer_coa);
      }
      return TRUE;
    }
    return false;
  }

  public function update_customer_head($data = [], $customer_id)
  {
    $data['customer_id'] = $customer_id;
    $res = $this->db->where('customer_id', $data['customer_id'])->get('acc_coa');

    if ($res->num_rows() > 0) {
      return TRUE;
    } else {
      $this->insert_customer_head($data);
    }
  }

  //Retrieve company Edit Data
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

  public function get_customer_headcode($customer_id)
  {
    return $this->db->select('HeadCode')
      ->from('acc_coa')
      ->where('customer_id', $customer_id)
      ->get()
      ->row();
  }

  public function r_voucher_list()
  {
    return $this->db->select('*')
      ->from('acc_transaction')
      ->where('Vtype', 'RV')
      ->get()
      ->result_array();
  }

  public function searchRV($text)
  {
    if (!empty($text)) {
      return $this->db->select("VNo as id, VNo as text")
        ->from('acc_transaction')
        ->like('VNo', $text)
        ->get()->result();
    } else {
      return false;
    }
  }

  public function get_fiscal_year()
  {
    $this->db->select('*');
    $this->db->from('acc_fiscal_year');
    $this->db->order_by('id', 'desc');
    $result = $this->db->get()->result_array();
    return $result;
  }

  public function get_fiscaldata_by_id($item_id)
  {
    $result = $this->db->select('*')
      ->from('acc_fiscal_year')
      ->where('id', $item_id)
      ->get()->row_array();
    return $result;
  }

  public function insert_bank_head($bank_data)
  {
    $PHead = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('HeadCode', '112')->get()->row();
    if (!empty($PHead)) {
      $childCount = $this->db->select('MAX(HeadCode) as HeadCode')->from('acc_coa')->where('PHeadCode', '112')->like('HeadCode', '1120', 'after')->get()->row();
      if ($childCount->HeadCode) {
        $HeadCode = $childCount->HeadCode + 1;
      } else {
        $HeadCode = '1120001';
      }
      $c_acc = $bank_data['bank_id'] . ' - ' . $bank_data['bank_name'];
      $createby = $this->session->userdata('user_name');
      $createdate = date('Y-m-d H:i:s');
      $bank_coa = [
        'HeadCode' => $HeadCode,
        'HeadName' => $c_acc,
        'PHeadName' => $PHead->HeadName,
        'PHeadCode' => $PHead->HeadCode,
        'HeadLevel' => '3',
        'IsActive' => '1',
        'IsTransaction' => '1',
        'IsGL' => '0',
        'HeadType' => 'A',
        'bank_id' => $bank_data['bank_id'],
        'CreateBy' => $createby,
        'CreateDate' => $createdate,
      ];
      $this->db->insert('acc_coa', $bank_coa);
    }
  }
}
