<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Areports extends MX_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->auth->check_user_auth();
    $this->load->model('dashboard/Soft_settings');
    $this->load->model('dashboard/Customers');
    $this->load->model('dashboard/Products');
    $this->load->model('dashboard/Product_reviews');
    $this->load->model('dashboard/Categories');
    $this->load->model('dashboard/Suppliers');
    $this->load->model('dashboard/Invoices');
    $this->load->model('dashboard/Purchases');
    $this->load->model('accounting/reports_model');
    $this->load->model('dashboard/Accounts');
    $this->load->model('dashboard/Users');
    $this->load->model('dashboard/Stores');
    $this->load->model('dashboard/Search_history');
    $this->load->model('dashboard/Customer_activities');
    $this->load->model('dashboard/Orders');
    $this->load->model('dashboard/Web_settings');
    $this->load->model('template/Template_model');
    $this->load->library('dashboard/lreport');
    $this->load->library('dashboard/occational');
    $this->load->library('dashboard/luser');
  }
  public function reports_by_voucher()
  {
    $data = array(
      'title' => display('reports_by_voucher'),
    );
    $reportList = $this->parser->parse('accounting/report/reports_by_voucher', $data, true);
    $this->template_lib->full_admin_html_view($reportList);
  }
  public function get_v_info($id)
  {
    $data = $this->reports_model->getVoucherInfoByVId($id);
    $voucher_info = $this->reports_model->voucher_info_by_id($data['VNo'], $data['Vtype']);
    $currency_details = $this->Soft_settings->retrieve_currency_info();
    $currency_info = array(
      'currency' => $currency_details[0]['currency_icon'],
      'position' => $currency_details[0]['currency_position'],
    );
    $debit_array = array_column($voucher_info, 'Debit');

    $total_debit = (($currency_info['position'] == 0) ? $currency_info['currency'] . ' ' . array_sum($debit_array) : array_sum($debit_array) . ' ' . $currency_info['currency']);
    $credit_array = array_column($voucher_info, 'Credit');
    $total_credit = (($currency_info['position'] == 0) ? $currency_info['currency'] . ' ' . array_sum($credit_array) : array_sum($credit_array) . ' ' . $currency_info['currency']);
    if (!empty($voucher_info)) {
      $list = '';
      foreach ($voucher_info as  $voucher) {
        $list .= '<tr>
                      <td>' . $voucher['COAID'] . '</td>
                      <td>' . $voucher['HeadName'] . '</td>
                      <td>' . $voucher['Narration'] . '</td>
                      <td class="text-right">' . $voucher['Debit'] . '</td>
                      <td class="text-right">' . $voucher['Credit'] . '</td>
                      <td>' . date('d/m/Y H:i A', strtotime($voucher['CreateDate'])) . '</td>
                      <td>' . $voucher['first_name'] . ' ' . $voucher['last_name'] . '</td>
                  </tr>';
      }
    }
    echo json_encode(array('list' => $list, 'total_debit' => $total_debit, 'total_credit' => $total_credit));
  }
  public function search_all_rv()
  {
    $term = $this->input->get('search', true);
    if (!empty($term)) {
      $this->db->select("ID as id, CONCAT(VNo,' (',Vtype,')') as text,Vtype ")
        ->from('acc_transaction')
        ->group_by('Vtype')
        ->like('VNo', $term);
      $result = $this->db->get()->result();
      echo json_encode(['items' => $result]);
    } else {
      echo false;
    }
  }
  public function general_ledger()
  {
    $data = array(
      'title' => display('general_ledger'),
      'GLHeadList' => $this->reports_model->get_general_ledger_head(),
    );
    $reportList = $this->parser->parse('accounting/report/general_ledger', $data, true);
    $this->template_lib->full_admin_html_view($reportList);
  }
  /*--------------------------
  | Get Geanral ledger Trans head
  *--------------------------*/
  public function getGLTransList($head)
  {
    $data = $this->reports_model->get_gl_trans_head($head);
    echo json_encode($data);
  }
  public function general_ledger_report()
  {

    $range          = $this->input->post('date_range', true);
    $cmbGLCode      = $this->input->post('cmbGLCode', true);
    $cmbCode        = $this->input->post('cmbCode', true);
    // $chkIsTransction = $this->input->post('chkIsTransction', true);
    $chkIsTransction = true;


    $this->form_validation->set_rules('date_range', display('date_range'), 'required');
    $this->form_validation->set_rules('cmbGLCode', display('cmbGLCode'), 'trim|required');
    $this->form_validation->set_rules('cmbCode', display('cmbCode'), 'trim|required');

    if (false) {
      $this->session->set_userdata(array('error_message' => display('fields_must_not_be_empty')));
      redirect('accounting/areports/general_ledger');
    } else {
      $date = explode('-', $range);
      $from = date('Y-m-d', strtotime(trim(!empty($date[0]) ? $date[0] : '2020-10-05')));
      $to   = date('Y-m-d', strtotime(trim(!empty($date[1]) ? $date[1] : '2024-02-25')));
      $dtpFromDate = $from;
      $dtpToDate   = $to;
      $HeadName    = $this->reports_model->general_led_report_headname($cmbGLCode);
      $HeadName2   = $this->reports_model->general_led_report_headname2($cmbGLCode, $cmbCode, $dtpFromDate, $dtpToDate, $chkIsTransction);
      $pre_balance = $this->reports_model->general_led_report_prebalance($cmbCode, $dtpFromDate);
      $company_info = $this->reports_model->retrieve_company();
      $data = array(
        'title'          => display('general_ledger_reports'),
        'dtpFromDate'    => $dtpFromDate,
        'dtpToDate'      => $dtpToDate,
        'HeadName'       => $HeadName,
        'HeadName2'      => $HeadName2,
        'prebalance'     => $pre_balance,
        'chkIsTransction' => $chkIsTransction,
        'dateRange'      => $range,
        'company_info'   => $company_info,
        // 'chkIsTransction' => true,
      );
      $data['ledger']  = $this->reports_model->general_led_report_headname($cmbCode);
      // echo "<pre>";print_r($data);exit;
      $reportList = $this->parser->parse('accounting/report/general_ledger_report', $data, true);
      $this->template_lib->full_admin_html_view($reportList);
    }
  }
  public function profit_loss()
  {
    $fy_id = $this->input->post('fy_id', true);
    $this->db->select('*');
    $this->db->from('acc_fiscal_year');
    if (!empty($fy_id)) {
      $this->db->where('id', $fy_id);
    } else {
      $this->db->where('status', 1);
    }
    $fiscal_year = $this->db->get()->row();
    $date[0] = $this->input->post('from', true);
    $date[1] = $this->input->post('to', true);
    $from = date('Y-m-d', strtotime(trim(!empty($date[0]) ? $date[0] : $fiscal_year->start_date)));
    $to   = date('Y-m-d', strtotime(trim(!empty($date[1]) ? $date[1] : date('Y-m-d'))));

    $data = array(
      'title' => display('profit_loss'),
      'fiscal_year_list' => $this->reports_model->fiscal_year_list(),
      'from_date' => $from,
      'to_date'   => $to,
    );
    $content = $this->parser->parse('accounting/report/profit_loss', $data, true);
    $this->template_lib->full_admin_html_view($content);
  }
  public function profitLossReoprt()
  {
    $fy_id = $this->input->post('fy_id', true);
    $this->db->select('*');
    $this->db->from('acc_fiscal_year');
    if (!empty($fy_id)) {
      $this->db->where('id', $fy_id);
    } else {
      $this->db->where('status', 1);
    }
    $fiscal_year = $this->db->get()->row();
    $data['moduleTitle'] = display('accounts');
    $data['title']      = display('balance_sheet');
    $date[0] = $this->input->post('from', true);
    $date[1] = $this->input->post('to', true);
    $from = date('Y-m-d', strtotime(trim(!empty($date[0]) ? $date[0] : $fiscal_year->start_date)));
    $to   = date('Y-m-d', strtotime(trim(!empty($date[1]) ? $date[1] : date('Y-m-d'))));
    $data['title']    = display('profit_loss');
    $data['from_date'] = $from;
    $data['to_date']  = $to;
    $data['fy_id']    = $fy_id;
    $data['dateRange'] = date('Y M d', strtotime($from)) . ' -To- ' . date('Y M d', strtotime($to));
    $data['fiscal_year_list'] = $this->reports_model->fiscal_year_list();
    $data['incomes']  = $this->reports_model->income_fields();
    $data['expenses'] = $this->reports_model->expense_fields();
    $content = $this->parser->parse('accounting/report/profit_loss_report', $data, true);
    $this->template_lib->full_admin_html_view($content);
  }

  public function balance_sheet()
  {
    $fy_id = $this->input->post('fy_id', true);
    $this->db->select('*');
    $this->db->from('acc_fiscal_year');
    if (!empty($fy_id)) {
      $this->db->where('id', $fy_id);
    } else {
      $this->db->where('status', 1);
    }
    $fiscal_year = $this->db->get()->row();
    $date[0] = $this->input->post('from', true);
    $date[1] = $this->input->post('to', true);
    $from = date('Y-m-d', strtotime(trim(!empty($date[0]) ? $date[0] : $fiscal_year->start_date)));
    $to   = date('Y-m-d', strtotime(trim(!empty($date[1]) ? $date[1] : date('Y-m-d'))));

    $data['moduleTitle'] = display('accounts');
    $data['title']      = display('balance_sheet');
    $data['isDateTimes']      = true;
    $data['from_date']        = $from;
    $data['to_date']          = $to;
    $data['dateRange']        = date('Y M d', strtotime($from)) . ' -To- ' . date('Y M d', strtotime($to));
    $data['fiscal_year_list'] = $this->reports_model->fiscal_year_list();
    $data['fixed_assets']     = $this->reports_model->assets($from, $to, $fy_id);
    $all_liability_head = $this->reports_model->all_liabilities();


    foreach ($all_liability_head as $key => $newhear) {
      $newhear['tt' . $key] = '';
      $newhear['ss' . $key] = '';
      $newhear['ff' . $key] = '';
      if (!empty($newhear['sub'])) {
        foreach ($newhear['sub'] as $key1 => $second) {
          $newhear['ss' . $key] .= $second['HeadCode'] . ',';
          if (!empty($second['sub'])) {
            foreach ($second['sub'] as $key2 => $third) {
              $newhear['ff' . $key] .= $third['HeadCode'] . ',';
            }
          }
        }
      }
      $newhear['tt' . $key] .= $newhear['HeadCode'] . ',' . $newhear['ss' . $key] . $newhear['ff' . $key];
      $all_liability_head[$key]['all_key_' . $key] = explode(',', rtrim($newhear['tt' . $key], ','));

      if (!empty($all_liability_head[$key]['all_key_' . $key])) {
        $this->db->select('(sum(Debit)-sum(Credit)) as balance');
        $this->db->from('acc_transaction');
        $this->db->where('IsAppove', 1);
        if (!empty($from)) {
          $this->db->where('VDate >=', $from);
        }
        if (!empty($to)) {
          $this->db->where('VDate <=', $to);
        }
        $balance = $this->db->where_in('COAID', $all_liability_head[$key]['all_key_' . $key])->get()->row();
        $this->db->select('sum(amount) as opening_balance');
        $this->db->from('acc_opening_balances');
        if (!empty($from)) {
          $this->db->where('adjustment_date >=', $from);
        }
        if (!empty($to)) {
          $this->db->where('adjustment_date <=', $to);
        }
        $this->db->where_in('headcode', $all_liability_head[$key]['all_key_' . $key]);
        $opening_balance = $this->db->get()->row();
        if (!empty($opening_balance->opening_balance)) {
          $op_balance = $opening_balance->opening_balance;
        } else {
          $op_balance = 0;
        }
        if (!empty($balance->balance)) {
          $all_liability_head[$key]['balance'] = $balance->balance + $op_balance;
        } else {
          $all_liability_head[$key]['balance'] = 0 + $op_balance;
        }
      }
    }
    $data['liabilities'] = $all_liability_head;

    $data['owners_equity']    = $this->reports_model->owners_equity($from, $to);
    $data['incomes']          = $this->reports_model->income($from, $to, $fy_id);
    $data['expenses']         = $this->reports_model->expense($from, $to, $fy_id);
    $reportList = $this->parser->parse('accounting/report/balance_sheet', $data, true);
    $this->template_lib->full_admin_html_view($reportList);
  }

  public function cash_flow_statement()
  {
    $data = array(
      'title' => display('cash_flow_statement'),
    );
    $reportList = $this->parser->parse('accounting/report/cash_flow_statement', $data, true);
    $this->template_lib->full_admin_html_view($reportList);
  }
  /*--------------------------
  | Cash Flow Reports
  *--------------------------*/
  public function cashFlowResports()
  {
    $data['moduleTitle'] = display('accounts');
    $data['title']      = display('cash_flow_statement');
    $range = $this->input->post('date_range', true);
    $date  = explode('-', $range);
    $from  = date('Y-m-d', strtotime(trim(!empty($date[0]) ? $date[0] : date('Y-m-d'))));
    $to    = date('Y-m-d', strtotime(trim(!empty($date[1]) ? $date[1] : date('Y-m-d'))));
    $company_info = $this->reports_model->retrieve_company();
    $data['company_info'] = $company_info;
    $data['dtpFromDate'] = $from;
    $data['dtpToDate']   = $to;
    $data['dateRange']   = $range;
    $reportList = $this->parser->parse('accounting/report/cash_flow_resports', $data, true);
    $this->template_lib->full_admin_html_view($reportList);
  }

  public function trial_balance()
  {
    $fy_id = $this->input->post('fy_id', true);
    $this->db->select('*');
    $this->db->from('acc_fiscal_year');
    if (!empty($fy_id)) {
      $this->db->where('id', $fy_id);
    } else {
      $this->db->where('status', 1);
    }
    $fiscal_year = $this->db->get()->row();
    $date[0] = $this->input->post('from', true);
    $date[1] = $this->input->post('to', true);
    $from = date('Y-m-d', strtotime(trim(!empty($date[0]) ? $date[0] : $fiscal_year->start_date)));
    $to   = date('Y-m-d', strtotime(trim(!empty($date[1]) ? $date[1] : date('Y-m-d'))));
    $data = array(
      'title'     => display('trial_balance'),
      'fiscal_year_list' => $this->reports_model->fiscal_year_list(),
      'from_date' => $from,
      'to_date'   => $to,
    );
    $reportList = $this->parser->parse('accounting/report/trial_balance', $data, true);
    $this->template_lib->full_admin_html_view($reportList);
  }
  public function trial_balance_report()
  {

    $fy_id = $this->input->get('fy_id', true);
    $this->db->select('*');
    $this->db->from('acc_fiscal_year');
    if (!empty($fy_id)) {
      $this->db->where('id', $fy_id);
    } else {
      $this->db->where('status', 1);
    }
    $fiscal_year = $this->db->get()->row();
    $date[0] = $this->input->get('from', true);
    $date[1] = $this->input->get('to', true);
    $from = date('Y-m-d', strtotime(trim(!empty($date[0]) ? $date[0] : $fiscal_year->start_date)));
    $to   = date('Y-m-d', strtotime(trim(!empty($date[1]) ? $date[1] : date('Y-m-d'))));

    $results  = $this->reports_model->trial_balance_detail($from, $to, $fy_id);

    $data['a_e_closing'] = $results['a_e_closing'];
    $data['l_i_closing'] = $results['l_i_closing'];
    $data['from_date'] = $from;
    $data['to_date']  = $to;
    $data['fy_id']    = $fy_id;
    $data['fiscal_year_list'] = $this->reports_model->fiscal_year_list();
    $data['dateRange']  = date('Y M d', strtotime($from)) . ' -To- ' . date('Y M d', strtotime($to));
    $data['title']      = display('trial_balance');

    $reportList = $this->parser->parse('accounting/report/trial_balance_report', $data, true);
    $this->template_lib->full_admin_html_view($reportList);
  }
  public function get_fy_info()
  {
    $fy_id = $this->input->post('fy_id', true);
    $fy   = $this->db->select('*')->from('acc_fiscal_year')->where('id', $fy_id)->get()->row();

    $start = explode('-', $fy->start_date);
    $result['s_y'] = $start[0];
    $result['s_m'] = $start[1];
    $result['s_d'] = $start[2];

    $end = explode('-', $fy->end_date);
    $result['e_y'] = $end[0];
    $result['e_m'] = $end[1];
    $result['e_d'] = $end[2];
    echo json_encode($result);
  }
  public function coa_print()
  {
    $data['company_info'] = $this->reports_model->retrieve_company();
    $data['Soft_settings'] = $this->Soft_settings->retrieve_setting_editdata();
    $data['title']        = display('coa_print');
    $data['module']       = "accounting";
    $data['page']         = "report/coa_print";
    echo modules::run('template/layout', $data);
  }
}