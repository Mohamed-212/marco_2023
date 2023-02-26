<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Accounting extends MX_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->auth->check_user_auth();
    $this->load->model(array('account_model'));
  }
  //tree view show
  public function chart_of_account()
  {
    ini_set('pcre.backtrack_limit', 50000000);
    ini_set('pcre.recursion_limit', 50000000);
    $find_active_fiscal_year = $this->db->select('id')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    if (!empty($find_active_fiscal_year)) {
      $data['title']   = display('chart_of_account');
      $data['itemList'] = $this->account_model->get_userlist();
      $data['parent']  = $this->account_model->get_parenthead();

      $content = $this->parser->parse('accounting/treeview', $data, true);
      $this->template_lib->full_admin_html_view($content);
    } else {
      $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
      redirect('Admin_dashboard');
    }
  }
  public function fiscal_date_check($date)
  {
    $fiscaldate = date('Y-m-d', strtotime($date));
    $this->db->select('id');
    $this->db->from('acc_fiscal_year');
    $this->db->where("DATE('" . $fiscaldate . "') BETWEEN DATE(start_date) AND DATE(end_date)");
    $this->db->where('status', '1');
    $result = $this->db->get();

    if ($result->num_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  public function opening_balance()
  {
    $find_active_fiscal_year = $this->db->select('id')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    if (!empty($find_active_fiscal_year)) {
      $this->form_validation->set_rules('headcode', display('account_head'), 'max_length[100]');
      // $this->form_validation->set_rules('dtpDate', display('date'), 'required|max_length[30]');
      $this->form_validation->set_rules('amount', display('amount'), 'required|max_length[30]');

      if ($this->form_validation->run() == TRUE) {
        $dtpDate = date('Y-m-d H:i:s');
        // $datecheck = $this->fiscal_date_check($dtpDate);
        // if (!$datecheck) {
        //   $this->session->set_userdata('error_message', 'Invalid date selection! Please select a date from active fiscal year.');
        //   redirect('accounting/opening_balance');
        // }
        $createby   = $this->session->userdata('user_id');
        $balance_type = $this->input->post('balance_type', TRUE);
        $postData = array(
          'fy_id'          => $find_active_fiscal_year->id,
          'headcode'       => $this->input->post('headcode', true),
          'amount'         => ($balance_type == 2) ? -1 * $this->input->post('amount', true) : $this->input->post('amount', true),
          'adjustment_date' => $dtpDate,
          'created_by'     => $createby,
        );
        $receive_by = $this->session->userdata('user_id');
        if ($this->account_model->create_opening($postData)) {

          $headcode  = $this->input->post('headcode', true);
          $headname  = $this->db->select('HeadName, customer_id')->from('acc_coa')->where('HeadCode', $headcode)->get()->row();
          $createdate = date('Y-m-d H:i:s');
          $date      = $createdate;

          // add to customer ledger
          // $cl_data = array(
          //     'transaction_id' => generator(15),
          //     'customer_id' => $headname->customer_id,
          //     'date' => $date,
          //     'amount' => $this->input->post('amount', true),
          //     'payment_type' => 1,
          //     'description' => 'ITP',
          //     'status' => 1
          // );
          // $this->db->insert('customer_ledger', $cl_data);
          
          if ($balance_type == 1) {
            // add acc trans
            $customer_credit = array(
              'fy_id' => $find_active_fiscal_year->id,
              'VNo'   => 'OP-' . $headcode,
              'Vtype' => 'Sales',
              'VDate' => $date,
              'COAID' => $headcode, // account payable game 11
              'Narration' => 'Opening balance credired by customer id: ' . $headname->HeadName . '(' . $headname->customer_id . ')',
              'Debit' => 0,
              'Credit' => $this->input->post('amount', true),
              'IsPosted' => 1,
              'CreateBy' => $createby,
              'CreateDate' => $createdate,
              'IsAppove' => 1
            );
            $this->db->insert('acc_transaction', $customer_credit);

            $opening_balance_debit = array(
              'fy_id'     => $find_active_fiscal_year->id,
              'VNo'       => 'OP-' . $headcode,
              'Vtype'     => 'Sales',
              'VDate'     => $date,
              'COAID'     => 3,
              'Narration' => 'Opening balance dibited from "Owners Equity And Capital" from: ' . $headname->HeadName,
              'Debit'     => $this->input->post('amount', true),
              'Credit'    => 0,
              'is_opening' => 1,
              'IsPosted'  => 1,
              'CreateBy'  => $createby,
              'CreateDate' => $createdate,
              'IsAppove'  => 1
            );
            $this->db->insert('acc_transaction', $opening_balance_debit);
          } elseif ($balance_type == 2) {
            // add acc trans
            $customer_debit = array(
              'fy_id' => $find_active_fiscal_year->id,
              'VNo'   => 'OP-' . $headcode,
              'Vtype' => 'Sales',
              'VDate' => $date,
              'COAID' => $headcode, // account payable game 11
              'Narration' => 'Opening balance debited by customer id: ' . $headname->HeadName . '(' . $headname->customer_id . ')',
              'Debit' => $this->input->post('amount', true),
              'Credit' => 0,
              'IsPosted' => 1,
              'CreateBy' => $createby,
              'CreateDate' => $createdate,
              'IsAppove' => 1
            );
            $this->db->insert('acc_transaction', $customer_debit);

            $opening_balance_credit = array(
              'fy_id'     => $find_active_fiscal_year->id,
              'VNo'       => 'OP-' . $headcode,
              'Vtype'     => 'Sales',
              'VDate'     => $date,
              'COAID'     => 3,
              'Narration' => 'Opening balance credited from "Owners Equity And Capital" from: ' . $headname->HeadName,
              'Debit'     => 0,
              'Credit'    => $this->input->post('amount', true),
              'is_opening' => 1,
              'IsPosted'  => 1,
              'CreateBy'  => $receive_by,
              'CreateDate' => $createdate,
              'IsAppove'  => 1
            );
            $this->db->insert('acc_transaction', $opening_balance_credit);
          }

          $this->session->set_flashdata('message', display('save_successfully'));
          redirect('accounting/opening_balance');
        } else {
          $this->session->set_flashdata('exception', display('please_try_again'));
          redirect('accounting/opening_balance');
        }
      }
      $data['title']      = display('opening_balance');
      $data['headss']     = $this->account_model->opening_balance_userlist_without_customers_or_suppliers();
      $content = $this->parser->parse('accounting/opening_balance', $data, true);
      $this->template_lib->full_admin_html_view($content);
    } else {
      $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
      redirect('Admin_dashboard');
    }
  }

  public function customers_opening_balance()
  {
    $find_active_fiscal_year = $this->db->select('id')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    if (!empty($find_active_fiscal_year)) {
      $this->form_validation->set_rules('headcode', display('account_head'), 'max_length[100]');
      // $this->form_validation->set_rules('dtpDate', display('date'), 'required|max_length[30]');
      $this->form_validation->set_rules('amount', display('amount'), 'required|max_length[30]');

      if ($this->form_validation->run() == TRUE) {
        // $dtpDate = $this->input->post('dtpDate', TRUE);
        $dtpDate = date('Y-m-d H:i:s');
        // $datecheck = $this->fiscal_date_check($dtpDate);
        // if (!$datecheck) {
        //   $this->session->set_userdata('error_message', 'Invalid date selection! Please select a date from active fiscal year.');
        //   redirect('accounting/customers_opening_balance');
        // }
        $createby   = $this->session->userdata('user_id');
        $balance_type = $this->input->post('balance_type', TRUE);
        $postData = array(
          'fy_id'          => $find_active_fiscal_year->id,
          'headcode'       => $this->input->post('headcode', true),
          'amount'         => ($balance_type == 2) ? -1 * $this->input->post('amount', true) : $this->input->post('amount', true),
          'adjustment_date' => $dtpDate,
          'created_by'     => $createby,
        );
        $receive_by = $this->session->userdata('user_id');
        if ($this->account_model->create_opening($postData)) {

          $headcode  = $this->input->post('headcode', true);
          $headname  = $this->db->select('HeadName, customer_id')->from('acc_coa')->where('HeadCode', $headcode)->get()->row();
          $createdate = date('Y-m-d H:i:s');
          $date      = $createdate;

          
          if ($balance_type == 1) {
            // credit
            // add to customer ledger
            $cl_data = array(
              'transaction_id' => generator(15),
              'customer_id' => $headname->customer_id,
              'date' => $date,
              'amount' => $this->input->post('amount', true),
              'payment_type' => 1,
              'description' => 'ITP',
              'status' => 1,
              'details' => 'رصيد إبتدائى ماقبل',
              'voucher' => 'Pb',
              'acc' => 'OP-' . $headcode
            );
            $this->db->insert('customer_ledger', $cl_data);
            // add acc trans
            $customer_credit = array(
              'fy_id' => $find_active_fiscal_year->id,
              'VNo'   => 'OP-' . $headcode,
              'Vtype' => 'Sales',
              'VDate' => $date,
              'COAID' => $headcode, // account payable game 11
              'Narration' => 'Opening balance credired by customer id: ' . $headname->HeadName . '(' . $headname->customer_id . ')',
              'Debit' => 0,
              'Credit' => $this->input->post('amount', true),
              'IsPosted' => 1,
              'CreateBy' => $createby,
              'CreateDate' => $createdate,
              'IsAppove' => 1
            );
            $this->db->insert('acc_transaction', $customer_credit);

            $customers_opening_balance_debit = array(
              'fy_id'     => $find_active_fiscal_year->id,
              'VNo'       => 'OP-' . $headcode,
              'Vtype'     => 'Sales',
              'VDate'     => $date,
              'COAID'     => 3,
              'Narration' => 'Opening balance dibited from "Owners Equity And Capital" from: ' . $headname->HeadName,
              'Debit'     => $this->input->post('amount', true),
              'Credit'    => 0,
              'is_opening' => 1,
              'IsPosted'  => 1,
              'CreateBy'  => $createby,
              'CreateDate' => $createdate,
              'IsAppove'  => 1
            );
            $this->db->insert('acc_transaction', $customers_opening_balance_debit);
          } elseif ($balance_type == 2) {
            // debit
            // add to customer ledger
            $cl_data = array(
              'transaction_id' => generator(15),
              'receipt_no' => $this->auth->generator(15),
              'customer_id' => $headname->customer_id,
              'date' => $date,
              'amount' => $this->input->post('amount', true),
              'status' => 1,
              'details' => 'رصيد إبتدائى ماقبل',
              'voucher' => 'Pb',
              'acc' => 'OP-'. $headcode
            );
            $this->db->insert('customer_ledger', $cl_data);
            // add acc trans
            $customer_debit = array(
              'fy_id' => $find_active_fiscal_year->id,
              'VNo'   => 'OP-' . $headcode,
              'Vtype' => 'Sales',
              'VDate' => $date,
              'COAID' => $headcode, // account payable game 11
              'Narration' => 'Opening balance debited by customer id: ' . $headname->HeadName . '(' . $headname->customer_id . ')',
              'Debit' => $this->input->post('amount', true),
              'Credit' => 0,
              'IsPosted' => 1,
              'CreateBy' => $createby,
              'CreateDate' => $createdate,
              'IsAppove' => 1
            );
            $this->db->insert('acc_transaction', $customer_debit);

            $customers_opening_balance_credit = array(
              'fy_id'     => $find_active_fiscal_year->id,
              'VNo'       => 'OP-' . $headcode,
              'Vtype'     => 'Sales',
              'VDate'     => $date,
              'COAID'     => 3,
              'Narration' => 'Opening balance credited from "Owners Equity And Capital" from: ' . $headname->HeadName,
              'Debit'     => 0,
              'Credit'    => $this->input->post('amount', true),
              'is_opening' => 1,
              'IsPosted'  => 1,
              'CreateBy'  => $receive_by,
              'CreateDate' => $createdate,
              'IsAppove'  => 1
            );
            $this->db->insert('acc_transaction', $customers_opening_balance_credit);
          }

          $this->session->set_flashdata('message', display('save_successfully'));
          redirect('accounting/customers_opening_balance');
        } else {
          $this->session->set_flashdata('exception', display('please_try_again'));
          redirect('accounting/customers_opening_balance');
        }
      }
      $data['title']      = display('customers_opening_balance');
      $data['headss']     = $this->account_model->opening_balance_customers_only();
      $content = $this->parser->parse('accounting/customers_opening_balance', $data, true);
      $this->template_lib->full_admin_html_view($content);
    } else {
      $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
      redirect('Admin_dashboard');
    }
  }

  public function suppliers_opening_balance()
  {
    $find_active_fiscal_year = $this->db->select('id')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    if (!empty($find_active_fiscal_year)) {
      $this->form_validation->set_rules('headcode', display('account_head'), 'max_length[100]');
      // $this->form_validation->set_rules('dtpDate', display('date'), 'required|max_length[30]');
      $this->form_validation->set_rules('amount', display('amount'), 'required|max_length[30]');

      if ($this->form_validation->run() == TRUE) {
        // $dtpDate = $this->input->post('dtpDate', TRUE);
        $dtpDate = date('Y-m-d H:i:s');
        // $datecheck = $this->fiscal_date_check($dtpDate);
        // if (!$datecheck) {
        //   $this->session->set_userdata('error_message', 'Invalid date selection! Please select a date from active fiscal year.');
        //   redirect('accounting/suppliers_opening_balance');
        // }
        $createby   = $this->session->userdata('user_id');
        $balance_type = $this->input->post('balance_type', TRUE);
        $postData = array(
          'fy_id'          => $find_active_fiscal_year->id,
          'headcode'       => $this->input->post('headcode', true),
          'amount'         => ($balance_type == 2) ? -1 * $this->input->post('amount', true) : $this->input->post('amount', true),
          'adjustment_date' => $dtpDate,
          'created_by'     => $createby,
        );
        $receive_by = $this->session->userdata('user_id');
        if ($this->account_model->create_opening($postData)) {

          $headcode  = $this->input->post('headcode', true);
          $headname  = $this->db->select('HeadName, supplier_id')->from('acc_coa')->where('HeadCode', $headcode)->get()->row();
          $createdate = date('Y-m-d H:i:s');
          $date      = $createdate;

          
          if ($balance_type == 1) {
            // credit
            // add to customer ledger
            $sup_data = array(
              'transaction_id' =>  $this->auth->generator(15),
              'supplier_id'   =>  $headname->supplier_id,
              'invoice_no'    =>  NULL,
              'deposit_no'    =>  $this->auth->generator(10),
              'amount'        =>  $this->input->post('amount', true),
              'description'   =>  '',
              'payment_type'  =>  1,
              'date'          =>  date('Y-m-d'),
              'status'        =>  1,
              'sl_created_at' => date('Y-m-d H:i:s')
          );
          $this->db->insert('supplier_ledger', $sup_data);
            // add acc trans
            $customer_credit = array(
              'fy_id' => $find_active_fiscal_year->id,
              'VNo'   => 'OP-' . $headcode,
              'Vtype' => 'Sales',
              'VDate' => $date,
              'COAID' => $headcode, // account payable game 11
              'Narration' => 'Opening balance credired by supplier id: ' . $headname->HeadName . '(' . $headname->supplier_id . ')',
              'Debit' => 0,
              'Credit' => $this->input->post('amount', true),
              'IsPosted' => 1,
              'CreateBy' => $createby,
              'CreateDate' => $createdate,
              'IsAppove' => 1
            );
            $this->db->insert('acc_transaction', $customer_credit);

            $custsuppliersning_balance_debit = array(
              'fy_id'     => $find_active_fiscal_year->id,
              'VNo'       => 'OP-' . $headcode,
              'Vtype'     => 'Sales',
              'VDate'     => $date,
              'COAID'     => 3,
              'Narration' => 'Opening balance dibited from "Owners Equity And Capital" from: ' . $headname->HeadName,
              'Debit'     => $this->input->post('amount', true),
              'Credit'    => 0,
              'is_opening' => 1,
              'IsPosted'  => 1,
              'CreateBy'  => $createby,
              'CreateDate' => $createdate,
              'IsAppove'  => 1
            );
            $this->db->insert('acc_transaction', $custsuppliersning_balance_debit);
          } elseif ($balance_type == 2) {
            // debit
            // add to customer ledger
            $sup_data = array(
              'transaction_id' =>   $this->auth->generator(15),
              'supplier_id'   =>  $headname->supplier_id,
              'invoice_no'    =>  NULL,
              'deposit_no'    =>  null,
              'amount'        =>  $this->input->post('amount', true),
              'description'   =>  '',
              'payment_type'  =>  1,
              'date'          =>  date('Y-m-d'),
              'status'        =>  1,
              'sl_created_at' => date('Y-m-d H:i:s')

          );
          $this->db->insert('supplier_ledger', $sup_data);
            // add acc trans
            $customer_debit = array(
              'fy_id' => $find_active_fiscal_year->id,
              'VNo'   => 'OP-' . $headcode,
              'Vtype' => 'Sales',
              'VDate' => $date,
              'COAID' => $headcode, // account payable game 11
              'Narration' => 'Opening balance debited by supplier id: ' . $headname->HeadName . '(' . $headname->supplier_id . ')',
              'Debit' => $this->input->post('amount', true),
              'Credit' => 0,
              'IsPosted' => 1,
              'CreateBy' => $createby,
              'CreateDate' => $createdate,
              'IsAppove' => 1
            );
            $this->db->insert('acc_transaction', $customer_debit);

            $custosuppliersing_balance_credit = array(
              'fy_id'     => $find_active_fiscal_year->id,
              'VNo'       => 'OP-' . $headcode,
              'Vtype'     => 'Sales',
              'VDate'     => $date,
              'COAID'     => 3,
              'Narration' => 'Opening balance credited from "Owners Equity And Capital" from: ' . $headname->HeadName,
              'Debit'     => 0,
              'Credit'    => $this->input->post('amount', true),
              'is_opening' => 1,
              'IsPosted'  => 1,
              'CreateBy'  => $receive_by,
              'CreateDate' => $createdate,
              'IsAppove'  => 1
            );
            $this->db->insert('acc_transaction', $custosuppliersing_balance_credit);
          }

          $this->session->set_flashdata('message', display('save_successfully'));
          redirect('accounting/suppliers_opening_balance');
        } else {
          $this->session->set_flashdata('exception', display('please_try_again'));
          redirect('accounting/suppliers_opening_balance');
        }
      }
      $data['title']      = display('suppliers_opening_balance');
      $data['headss']     = $this->account_model->opening_balance_suppliers_only();
      $content = $this->parser->parse('accounting/suppliers_opening_balance', $data, true);
      $this->template_lib->full_admin_html_view($content);
    } else {
      $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
      redirect('Admin_dashboard');
    }
  }

  public function selectedform($id)
  {
    $role_reult = $this->account_model->treeview_selectform($id);
    if ($role_reult) {
      $html = "";
      $html .= form_open('', 'id="treeview_form" class="form-vertical"');
      $html .= "<div id=\"newData\" class=\"row\">
      <div class=\"col-sm-12\">
      <div class=\"row form-custom\">
        <label class=\"col-sm-3\"><b>Head Code</b></label>
        <div class=\"col-sm-9\"><input type=\"text\" name=\"txtHeadCode\" id=\"txtHeadCode\" class=\"form_input form-control\"  value=\"" . $role_reult->HeadCode . "\" readonly=\"readonly\"/></div>
      </div>
      </div>
      <div class=\"col-sm-12\">
      <div class=\"row form-custom\">
        <label class=\"col-sm-3\"><b>Head Name</b></label>
        <div class=\"col-sm-9\"><input type=\"text\" name=\"txtHeadName\" id=\"txtHeadName\" class=\"form_input form-control\" value=\"" . $role_reult->HeadName . "\"/>
        <input type=\"hidden\" name=\"HeadName\" id=\"HeadName\" class=\"form_input\" value=\"" . $role_reult->HeadName . "\"/>
        </div>
      </div>
      </div>
      <div class=\"col-sm-12\">
      <div class=\"row form-custom\">
        <label class=\"col-sm-3\"><b>Parent Head</b></label>
        <div class=\"col-sm-9\"><input type=\"text\" name=\"txtPHead\" id=\"txtPHead\" class=\"form_input form-control\" readonly=\"readonly\" value=\"" . $role_reult->PHeadName . "\"/>
        <input type=\"hidden\" name=\"PHeadCode\" id=\"PHeadCode\" class=\"form_input\" value=\"" . $role_reult->PHeadCode . "\"/>
        </div>
      </div>
      </div>
      <div class=\"col-sm-12\">
      <div class=\"row form-custom\">

        <label class=\"col-sm-3\"><b>Head Level</b></label>
        <div class=\"col-sm-9\"><input type=\"text\" name=\"txtHeadLevel\" id=\"txtHeadLevel\" class=\"form_input form-control\" readonly=\"readonly\" value=\"" . $role_reult->HeadLevel . "\"/></div>
      </div>
      </div>
      <div class=\"col-sm-12\">
      <div class=\"row form-custom\">
        <label class=\"col-sm-3\"><b>Head Type</b></label>
        <div class=\"col-sm-9\"><input type=\"text\" name=\"txtHeadType\" id=\"txtHeadType\" class=\"form_input form-control\" readonly=\"readonly\" value=\"" . $role_reult->HeadType . "\"/></div>
      </div>
      </div>

      <div class=\"col-sm-12\">
      <div class=\"row form-custom\">
        <div class=\"col-sm-9 col-sm-offset-3\">
        <div class=\"align-center\">
          <div class=\"mr-15\">
          <input type=\"checkbox\" name=\"IsTransaction\" value=\"1\" class=\"mr-5\" id=\"IsTransaction\" size=\"28\"  onchange=\"IsTransaction_change()\"";
      if ($role_reult->IsTransaction == 1) {
        $html .= "checked";
      }
      $html .= "/><label for=\"IsTransaction\"> IsTransaction</label>
            </div>

          <div class=\"mr-15\">
          <input type=\"checkbox\" value=\"1\" name=\"IsActive\" class=\"mr-5\" id=\"IsActive\" size=\"28\"";
      if ($role_reult->IsActive == 1) {
        $html .= "checked";
      }
      $html .= "/><label for=\"IsActive\"> IsActive</label>
          </div>

          <div class=\"mr-15\">
          <input type=\"checkbox\" value=\"1\" name=\"IsGL\" class=\"mr-5\" id=\"IsGL\" size=\"28\" onchange=\"IsGL_change();\"";
      if ($role_reult->IsGL == 1) {
        $html .= "checked";
      }
      $html .= "/><label for=\"IsGL\"> IsGL</label>
          </div>
          </div>
        </div>";
      $html .= "</div>
      </div>
      <div class=\"col-sm-12\">
      <div class=\"row mx-0\">
          <div class=\"col-sm-9 col-sm-offset-3\">";
      $html .= "<input type=\"button\" name=\"btnNew\" id=\"btnNew\" value=\"New\" onClick=\"newHeaddata(" . $role_reult->HeadCode . ")\" class=\"btn btn-sub btn-info\"/>
              <input type=\"btn\" name=\"btnSave\" id=\"btnSave\" value=\"Save\" disabled=\"disabled\" class=\"btn btn-sub btn-success\" onclick=\"treeSubmit()\"/>";

      $html .= " <input type=\"button\" name=\"btnUpdate\" id=\"btnUpdate\" value=\"Update\" onclick=\"treeSubmit()\" class=\"btn btn-sub btn-primary\"/>  <button type=\"button\" class=\"btn btn-sub btn-danger\" data-dismiss=\"modal\">Close</button></div>";
      $html .= "</div></div>
    </form>
            ";
    }

    echo json_encode($html);
  }

  public function insert_coa()
  {

    $headcode    = $this->input->post('txtHeadCode', TRUE);
    $HeadName    = $this->input->post('txtHeadName', TRUE);
    $PHeadName   = $this->input->post('txtPHead', TRUE);
    $PHeadCode   = $this->input->post('PHeadCode', TRUE);
    $HeadLevel   = $this->input->post('txtHeadLevel', TRUE);
    $txtHeadType = $this->input->post('txtHeadType', TRUE);
    $isact       = $this->input->post('IsActive', TRUE);
    $IsActive    = (!empty($isact) ? $isact : 0);
    $trns        = $this->input->post('IsTransaction', TRUE);
    $IsTransaction = (!empty($trns) ? $trns : 0);
    $isgl        = $this->input->post('IsGL', TRUE);
    $IsGL        = (!empty($isgl) ? $isgl : 0);
    $createby    = $this->session->userdata('user_id');
    $createdate  = date('Y-m-d H:i:s');
    $postData = array(
      'HeadCode'     => $headcode,
      'HeadName'     => $HeadName,
      'PHeadName'    => $PHeadName,
      'PHeadCode'    => $PHeadCode,
      'HeadLevel'    => $HeadLevel,
      'IsActive'     => $IsActive,
      'IsTransaction' => $IsTransaction,
      'IsGL'         => $IsGL,
      'HeadType'     => $txtHeadType,
      'IsBudget'     => 0,
      'CreateBy'     => $createby,
      'CreateDate'   => $createdate,
    );
    $upinfo = $this->db->select('*')
      ->from('acc_coa')
      ->where('HeadCode', $headcode)
      ->get()
      ->row();
    if (empty($upinfo)) {
      $res = $this->db->insert('acc_coa', $postData);
      if ($res) {
        $data['status'] = true;
        $data['message'] = 'Successfully Saved';
      } else {
        $data['status'] = false;
        $data['exception'] = 'Failed! Please try again';
      }
    } else {
      $hname = $this->input->post('HeadName', TRUE);
      $updata = array(
        'PHeadName'     =>  $HeadName,
      );
      $res = $this->db->where('HeadCode', $headcode)
        ->update('acc_coa', $postData);
      $this->db->where('PHeadName', $hname)
        ->update('acc_coa', $updata);
      if ($res) {
        $data['status'] = true;
        $data['message'] = 'Successfully Updated';
      } else {
        $data['status'] = false;
        $data['exception'] = 'Failed! Please try again';
      }
    }
    echo json_encode($data);
  }

  public function newform($id)
  {
    $newdata = $this->db->select('*')
      ->from('acc_coa')
      ->where('HeadCode', $id)
      ->get()
      ->row();
    $newidsinfo = $this->db->select('*,max(HeadCode) as hc')
      ->from('acc_coa')
      ->where('PHeadName', $newdata->HeadName)
      ->get()
      ->row();
    $nid  = $newidsinfo->hc;
    if ($nid) {
      $n = $nid + 1;
      $HeadCode = $n;
    } else {
      $HeadCode = $id . '00' . 1;
    }
    $info['headcode'] =  $HeadCode;
    $info['rowdata']  =  $newdata;
    $info['pheadcode']  =  $id;
    $info['headlabel'] =  $newdata->HeadLevel + 1;
    echo json_encode($info);
  }
  public function supplier_payment()
  {
    $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    if (!empty($find_active_fiscal_year)) {
      $this->form_validation->set_rules('txtCode', display('txtCode'), 'max_length[100]');
      $this->form_validation->set_rules('paytype', display('paytype'), 'required|max_length[2]');
      $this->form_validation->set_rules('txtCode', display('code'), 'required|max_length[30]');
      $this->form_validation->set_rules('txtAmount', display('amount'), 'required|max_length[30]');
      if ($this->form_validation->run() == TRUE) {

        $dtpDate = $this->input->post('dtpDate', TRUE);
        $datecheck = $this->fiscal_date_check($dtpDate);
        if (!$datecheck) {
          $this->session->set_userdata('error_message', 'Invalid date selection! Please select a date from active fiscal year.');
          redirect('accounting/accounting/supplier_payment');
        }


        if ($this->account_model->supplier_payment_insert()) {
          $this->session->set_flashdata('message', display('save_successfully'));
        } else {
          $this->session->set_flashdata('exception',  display('please_try_again'));
        }
      }

      $data['title']        = display('supplier_payment');
      $data['supplier_list'] =  $this->account_model->get_supplier();
      $data['voucher_no']   = $this->account_model->Spayment();
      $data['bank_list']    = $this->account_model->payment_info();
      $data['crcc']      = $this->account_model->Cracc();

      $content = $this->parser->parse('accounting/supplier_payment_form', $data, true);
      $this->template_lib->full_admin_html_view($content);
    } else {
      $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
      redirect(base_url('Admin_dashboard'));
    }
  }
  public function supplier_paymentreceipt($supplier_id, $voucher_no, $coaid)
  {
    $supplier_id           = $this->uri->segment(3);
    $voucher_no            = $this->uri->segment(4);
    $coaid                 = $this->uri->segment(5);

    $data['company_info']  = $this->account_model->retrieve_company();
    $data['supplier_info'] = $this->account_model->supplierinfo($supplier_id);
    $data['payment_info']  = $this->account_model->supplierpaymentinfo($voucher_no, $coaid);

    $data['title']         = display('supplier_payment_receipt');

    $data['data'] = $data['payment_info'][0];

    $data['payment'] = [
      'type' => 0,
      'coid' => 0,
    ];

    $supplier_name = $data['supplier_info'][0]['supplier_name'];
    // if payment type => 1 && ==> box payment type -> مثل الصندوق الرئيسى
    $trans_type_1 = $this->db->select('*')->from('acc_transaction')->where('Narration', 'Paid to ' . $supplier_name)->get()->row();
    // if payment type => 2 && ==> bank payment type -> مثل بنك CIB
    $trans_type_2 = $this->db->select('*')->from('acc_transaction')->where('Narration', 'Supplier Payment To ' . $supplier_name)->get()->row();

    if ($trans_type_1) {
      // cash payment --> from box
      $data['payment'] = [
        'type' => 1,
        'coid' => $trans_type_1->COAID,
      ];
    }

    if ($trans_type_2) {
      // bank payment
      $data['payment'] = [
        'type' => 2,
        'coid' => $trans_type_2->COAID,
      ];
    }

    $account = $this->db->select('*')->from('acc_coa')->where('HeadCode', $data['payment']['coid'])->get()->row();

    $data['payment']['account'] = $account->HeadName;

    // echo "<pre>";var_dump($trans_type_1, $trans_type_2);exit;

    // echo "<pre>";var_dump($data);exit;

    $content = $this->parser->parse('accounting/supplier_payment_receipt', $data, true);
    $this->template_lib->full_admin_html_view($content);
  }
  public function supplier_headcode($id)
  {
    $supplierhcode = $this->db->select('HeadCode')
      ->from('acc_coa')
      ->where('supplier_id', $id)
      ->get()
      ->row();
    $code = @$supplierhcode->HeadCode;
    echo json_encode($code);
  }
  //Customer Receive
  public function customer_receive()
  {
    $this->form_validation->set_rules('paytype', display('paytype'), 'required|max_length[100]');
    $this->form_validation->set_rules('txtCode', display('txtCode'), 'required|max_length[100]');
    $this->form_validation->set_rules('txtAmount', display('amount'), 'max_length[100]');
    if ($this->form_validation->run() == TRUE) {
      if ($this->account_model->customer_receive_insert()) {
        $this->session->set_flashdata('message', display('save_successfully'));
      } else {
        $this->session->set_flashdata('exception',  display('please_try_again'));
      }
    }
    $data['customer_list'] = $this->account_model->get_customer();
    $data['voucher_no']    = $this->account_model->Creceive();
    $data['bank_list']    = $this->account_model->get_bank_list();
    $data['title']         = display('customer_receive');
    $content = $this->parser->parse('accounting/customer_receive_form', $data, true);
    $this->template_lib->full_admin_html_view($content);
  }
  public function customer_headcode($id)
  {
    $customerhcode = $this->db->select('HeadCode')
      ->from('acc_coa')
      ->where('customer_id', $id)
      ->get()
      ->row();
    $code = @$customerhcode->HeadCode;
    echo json_encode($code);
  }
  public function customer_receipt($customer_id, $voucher_no, $coaid)
  {
    $customer_id           = $this->uri->segment(2);
    $voucher_no            = $this->uri->segment(3);
    $coaid                 = $this->uri->segment(4);
    $data['customer_info'] = $this->account_model->custoinfo($customer_id);
    $data['payment_info']  = $this->account_model->customerreceiptinfo($voucher_no, $coaid);
    $data['title']         = display('customer_receive');
    $data['module']        = "account";
    $data['page']          = "customer_payment_receipt";
    echo modules::run('template/layout', $data);
  }
  public function cash_adjustment()
  {

    $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    if (!empty($find_active_fiscal_year)) {
      $this->form_validation->set_rules('txtAmount', display('amount'), 'required|max_length[100]');
      $this->form_validation->set_rules('type', display('adjustment_type'), 'required|max_length[10]');
      if ($this->form_validation->run() == TRUE) {
        $dtpDate = $this->input->post('dtpDate', TRUE);
        $datecheck = $this->fiscal_date_check($dtpDate);
        if (!$datecheck) {
          $this->session->set_userdata('error_message', 'Invalid date selection! Please select a date from active fiscal year.');
          redirect('accounting/accounting/cash_adjustment');
        }
        if ($this->account_model->insert_cashadjustment()) {
          $this->session->set_flashdata('message', display('save_successfully'));
        } else {
          $this->session->set_flashdata('exception', display('please_try_again'));
        }
      }
      $data['title']     = display('cash_adjustment');
      $data['voucher_no'] = $this->account_model->Cashvoucher();
      $content = $this->parser->parse('accounting/cash_adjustment', $data, true);
      $this->template_lib->full_admin_html_view($content);
    } else {
      $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
      redirect(base_url('Admin_dashboard'));
    }
  }

  // Sabit
  public function debit_voucher()
  {
    $print_after_save = $this->input->post('print_me', true);

    $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    if (!empty($find_active_fiscal_year)) {
      $this->form_validation->set_rules('cmbDebit', display('credit_account_head'), 'required|max_length[100]');
      $this->form_validation->set_rules('dtpDate', display('date'), 'required|max_length[100]');
      $this->form_validation->set_rules('cmbCode[]', display('account_name'), 'required|max_length[100]');
      $this->form_validation->set_rules('txtAmount[]', display('amount'), 'required|max_length[100]');
      $this->form_validation->set_rules('cmbDebit', display('cmbDebit'), 'max_length[100]');
      if ($this->form_validation->run()) {
        $dtpDate = $this->input->post('dtpDate', TRUE);
        $datecheck = $this->fiscal_date_check($dtpDate);
        if (!$datecheck) {
          $this->session->set_userdata('error_message', display('invalid_date_selection'));
          redirect('accounting/accounting/debit_voucher');
        }
        if ($inserted = $this->account_model->insert_debitvoucher(true)) {
          $this->session->set_flashdata('message', display('save_successfully'));
          if ($print_after_save) {
            // echo "<pre>";print_r($inserted);exit;

            $accounts = [];
            foreach ($inserted['dAID'] as $acId) {
              $debitvcode = $this->db->select('*')
                ->from('acc_coa')
                ->where('HeadCode', $acId)
                ->get()
                ->row();
              $accounts[] = $debitvcode->HeadName;
            }
            $inserted['accounts'] = $accounts;
            // echo "<pre>";print_r($inserted);exit;
            $data['title']      = display('debit_voucher');
            $data['acc']        = $this->account_model->TransaccJ();
            $data['voucher_no'] = $inserted['voucher_no'];
            $data['page']       = "debit_voucher";
            $data['print_only'] = true;
            $data['data'] = $inserted;
            $content = $this->parser->parse('accounting/debit_voucher', $data, true);
            return $this->template_lib->full_admin_html_view($content);
          }
          redirect('accounting/accounting/debit_voucher');
        } else {
          $this->session->set_flashdata('exception',  display('please_try_again'));
        }
        redirect('accounting/accounting/debit_voucher');
      }
      $data['title']     = display('debit_voucher');
      $data['acc']       = $this->account_model->Transacc();
      $data['voucher_no'] = $this->account_model->voNO();
      $data['crcc']      = $this->account_model->Cracc();

      $content = $this->parser->parse('accounting/debit_voucher', $data, true);
      $this->template_lib->full_admin_html_view($content);
    } else {
      $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
      redirect(base_url('Admin_dashboard'));
    }
  }

  public function debtvouchercode($id)
  {
    $debitvcode = $this->db->select('*')
      ->from('acc_coa')
      ->where('HeadCode', $id)
      ->get()
      ->row();
    $code = $debitvcode->HeadCode;
    echo json_encode($code);
  }
  //Credit voucher
  public function credit_voucher()
  {
    $print_after_save = $this->input->post('print_me', true);

    $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    if (!empty($find_active_fiscal_year)) {
      $this->form_validation->set_rules('cmbDebit', display('credit_account_head'), 'required|max_length[100]');
      $this->form_validation->set_rules('dtpDate', display('date'), 'required|max_length[100]');
      $this->form_validation->set_rules('cmbCode[]', display('account_name'), 'required|max_length[100]');
      $this->form_validation->set_rules('txtAmount[]', display('amount'), 'required|max_length[100]');
      $this->form_validation->set_rules('cmbDebit', display('cmbDebit'), 'max_length[100]');
      if ($this->form_validation->run()) {

        $dtpDate = $this->input->post('dtpDate', TRUE);
        $datecheck = $this->fiscal_date_check($dtpDate);
        if (!$datecheck) {
          $this->session->set_userdata('error_message', display('invalid_date_selection'));
          redirect('accounting/accounting/credit_voucher');
        }

        if ($inserted = $this->account_model->insert_creditvoucher(true)) {
          if ($print_after_save) {
            // echo "<pre>";

            $accounts = [];
            foreach ($inserted['cAID'] as $acId) {
              $debitvcode = $this->db->select('*')
                ->from('acc_coa')
                ->where('HeadCode', $acId)
                ->get()
                ->row();
              $accounts[] = $debitvcode->HeadName;
            }
            $inserted['accounts'] = $accounts;
            // print_r($inserted);
            $data['title']      = display('credit_voucher');
            $data['acc']        = $this->account_model->TransaccJ();
            $data['voucher_no'] = $inserted['voucher_no'];
            $data['page']       = "credit_voucher";
            $data['print_only'] = true;
            $data['data'] = $inserted;
            $content = $this->parser->parse('accounting/credit_voucher', $data, true);
            return $this->template_lib->full_admin_html_view($content);
          }
          $this->session->set_flashdata('message', display('save_successfully'));
        } else {
          $this->session->set_flashdata('exception',  display('please_try_again'));
        }
      }
      $data['title']      = display('credit_voucher');
      $data['acc']        = $this->account_model->TransaccI();
      $data['voucher_no'] = $this->account_model->crVno();
      $data['crcc']       = $this->account_model->Cracc();
      $content = $this->parser->parse('accounting/credit_voucher', $data, true);
      $this->template_lib->full_admin_html_view($content);
    } else {
      $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
      redirect(base_url('Admin_dashboard'));
    }
  }

  // Contra Voucher form
  public function contra_voucher()
  {
    $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    if (!empty($find_active_fiscal_year)) {
      $data['title']      = display('contra_voucher');
      $data['acc']        = $this->account_model->Cracc();
      $data['voucher_no'] = $this->account_model->contra();
      $content = $this->parser->parse('accounting/contra_voucher', $data, true);
      $this->template_lib->full_admin_html_view($content);
    } else {
      $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
      redirect(base_url('Admin_dashboard'));
    }
  }

  public function bdtask_create_contra_voucher()
  {
    $print_after_save = $this->input->post('print_me', true);

    $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    if (!empty($find_active_fiscal_year)) {
      $this->form_validation->set_rules('cmbDebit', display('cmbDebit'), 'max_length[100]');
      if ($this->form_validation->run()) {
        $dtpDate = $this->input->post('dtpDate', TRUE);
        $datecheck = $this->fiscal_date_check($dtpDate);
        if (!$datecheck) {
          $this->session->set_userdata('error_message', display('invalid_date_selection'));
          redirect('accounting/accounting/contra_voucher');
        }
        if ($inserted = $this->account_model->insert_contravoucher(true)) {
          $this->session->set_flashdata('message', display('save_successfully'));
          if ($print_after_save) {
            // echo "<pre>";print_r($inserted);exit;

            $accounts = [];
            foreach ($inserted['cAID'] as $acId) {
              $debitvcode = $this->db->select('*')
                ->from('acc_coa')
                ->where('HeadCode', $acId)
                ->get()
                ->row();
              $accounts[] = $debitvcode->HeadName;
            }
            $inserted['accounts'] = $accounts;
            // print_r($inserted);
            $data['title']      = display('contra_voucher');
            $data['acc']        = $this->account_model->TransaccJ();
            $data['voucher_no'] = $inserted['voucher_no'];
            $data['page']       = "contra_voucher";
            $data['print_only'] = true;
            $data['data'] = $inserted;
            $content = $this->parser->parse('accounting/contra_voucher', $data, true);
            return $this->template_lib->full_admin_html_view($content);
          }
          redirect('accounting/contra_voucher');
        } else {
          $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect("accounting/contra_voucher");
      } else {
        $this->session->set_flashdata('exception', validation_errors());
        redirect("accounting/contra_voucher");
      }
    } else {
      $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
      redirect(base_url('Admin_dashboard'));
    }
  }

  // Journal voucher
  public function journal_voucher()
  {
    $data['title']      = display('journal_voucher');
    $data['acc']        = $this->account_model->TransaccJ();
    $data['voucher_no'] = [(array)$this->account_model->journal()];
    $data['print_only'] = false;
    $data['page']       = "journal_voucher";
    $content = $this->parser->parse('accounting/journal_voucher', $data, true);
    $this->template_lib->full_admin_html_view($content);
  }
  //Create Journal Voucher
  public function bdtask_create_journal_voucher()
  {
    $print_after_save = $this->input->post('print_me', true);

    $this->form_validation->set_rules('cmbDebit', display('cmbDebit'), 'max_length[100]');

    if ($this->form_validation->run()) {

      $dtpDate = $this->input->post('dtpDate', TRUE);
      $datecheck = $this->fiscal_date_check($dtpDate);
      if (!$datecheck) {
        $this->session->set_userdata('error_message', display('invalid_date_selection'));
        redirect('accounting/accounting/journal_voucher');
      }

      $inserted = $this->account_model->insert_journalvoucher(true);
      if ($inserted) {
        $this->session->set_flashdata('message', display('save_successfully'));
        if ($print_after_save) {
          // echo "<pre>";

          $accounts = [];
          foreach ($inserted['cAID'] as $acId) {
            $debitvcode = $this->db->select('*')
              ->from('acc_coa')
              ->where('HeadCode', $acId)
              ->get()
              ->row();
            $accounts[] = $debitvcode->HeadName;
          }
          $inserted['accounts'] = $accounts;
          // print_r($inserted);
          $data['title']      = display('journal_voucher');
          $data['acc']        = $this->account_model->TransaccJ();
          $data['voucher_no'] = $inserted['voucher_no'];
          $data['page']       = "journal_voucher";
          $data['print_only'] = true;
          $data['data'] = $inserted;
          $content = $this->parser->parse('accounting/journal_voucher', $data, true);
          return $this->template_lib->full_admin_html_view($content);
        }
        redirect('accounting/accounting/journal_voucher');
      } else {
        $this->session->set_flashdata('exception',  display('please_try_again'));
      }

      redirect("accounting/accounting/journal_voucher");
    } else {
      $this->session->set_flashdata('exception',  validation_errors());
      redirect("accounting/accounting/journal_voucher");
    }
  }

  //Aprove voucher
  public function voucher_approval()
  {
    $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    if (!empty($find_active_fiscal_year)) {
      $data['title']   = display('voucher_approval');
      $data['aprrove'] = $this->account_model->approve_voucher();
      $content = $this->parser->parse('accounting/voucher_approve', $data, true);
      $this->template_lib->full_admin_html_view($content);
    } else {
      $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
      redirect(base_url('Admin_dashboard'));
    }
  }

  // isApprove
  public function isactive($id = null, $action = null)
  {
    $action   = ($action == 'active' ? 1 : 0);
    $postData = array(
      'VNo'      => $id,
      'IsAppove' => $action
    );

    if ($this->account_model->approved($postData)) {
      $this->session->set_flashdata('message', display('successfully_approved'));
    } else {
      $this->session->set_flashdata('exception', display('please_try_again'));
    }

    redirect($_SERVER['HTTP_REFERER']);
  }

  //Update voucher 
  public function voucher_update($id = null)
  {
    $vtype = $this->db->select('*')
      ->from('acc_transaction')
      ->where('VNo', $id)
      ->get()
      ->result_array();
    if ($vtype[0]['Vtype'] == "DV") {
      $data['title']          = display('update_debit_voucher');
      $data['dbvoucher_info'] = $this->account_model->dbvoucher_updata($id);
      $data['credit_info']    = $this->account_model->crvoucher_updata($id);
      $data['page']           = "update_dbt_crtvoucher";
    }

    if ($vtype[0]['Vtype'] == "JV") {
      $data['title']        = display('update_journal_voucher');
      $data['acc']          = $this->account_model->Transacc();
      $data['voucher_info'] = $this->account_model->journal_updata($id);
      $data['page']         = "update_journal_voucher";
    }

    if ($vtype[0]['Vtype'] == "Contra") {
      $data['title']         = display('update_contra_voucher');
      $data['acc']           = $this->account_model->Transacc();
      $data['voucher_info']  = $this->account_model->journal_updata($id);
      $data['page']         = "update_contra_voucher";
    }

    if ($vtype[0]['Vtype'] == "CV") {
      $data['title']          = display('update_credit_voucher');
      $data['crvoucher_info'] = $this->account_model->crdtvoucher_updata($id);
      $data['debit_info']     = $this->account_model->debitvoucher_updata($id);
      $data['page']           = "update_credit_bdtvoucher";
    }

    $data['crcc']           = $this->account_model->Cracc();
    $data['acc']            = $this->account_model->Transacc();
    $data['module']         = "accounting";
    echo modules::run('template/layout', $data);
  }

  /*updates part*/
  public function update_contra_voucher()
  {
    $this->form_validation->set_rules('cmbDebit', display('cmbDebit'), 'max_length[100]');
    if ($this->form_validation->run()) {

      $dtpDate = $this->input->post('dtpDate', TRUE);
      $datecheck = $this->fiscal_date_check($dtpDate);
      if (!$datecheck) {
        $this->session->set_userdata('error_message', display('invalid_date_selection'));
        redirect('accounting/accounting/voucher_approval');
      }


      if ($this->account_model->update_contravoucher()) {
        $this->session->set_flashdata('message', display('successfully_updated'));
        redirect('accounting/accounting/voucher_approval');
      } else {
        $this->session->set_flashdata('exception',  display('please_try_again'));
      }
      redirect("accounting/accounting/voucher_approval");
    } else {
      $this->session->set_flashdata('exception',  validation_errors());
      redirect("accounting/accounting/voucher_approval");
    }
  }

  public function update_credit_voucher()
  {
    $this->form_validation->set_rules('cmbDebit', display('cmbDebit'), 'max_length[100]');
    if ($this->form_validation->run()) {

      $dtpDate = $this->input->post('dtpDate', TRUE);
      $datecheck = $this->fiscal_date_check($dtpDate);
      if (!$datecheck) {
        $this->session->set_userdata('error_message', display('invalid_date_selection'));
        redirect('accounting/accounting/voucher_approval');
      }

      if ($this->account_model->update_creditvoucher()) {
        $this->session->set_flashdata('message', display('save_successfully'));
        redirect('accounting/accounting/voucher_approval');
      } else {
        $this->session->set_flashdata('exception',  display('please_try_again'));
      }
      redirect("accounting/accounting/voucher_approval");
    } else {
      $this->session->set_flashdata('exception',  validation_errors());
      redirect("accounting/accounting/voucher_approval");
    }
  }

  // Update Debit voucher 
  public function update_debit_voucher()
  {
    $this->form_validation->set_rules('cmbDebit', display('cmbDebit'), 'max_length[100]');
    if ($this->form_validation->run()) {

      $dtpDate = $this->input->post('dtpDate', TRUE);
      $datecheck = $this->fiscal_date_check($dtpDate);
      if (!$datecheck) {
        $this->session->set_userdata('error_message', display('invalid_date_selection'));
        redirect('accounting/accounting/voucher_approval');
      }

      if ($this->account_model->update_debitvoucher()) {
        $this->session->set_flashdata('message', display('update_successfully'));
        redirect('accounting/accounting/voucher_approval');
      } else {
        $this->session->set_flashdata('exception',  display('please_try_again'));
      }
      redirect("accounting/accounting/voucher_approval");
    } else {
      $this->session->set_flashdata('exception',  validation_errors());
      redirect("accounting/accounting/voucher_approval");
    }
  }

  public function update_journal_voucher()
  {
    $this->form_validation->set_rules('cmbDebit', display('cmbDebit'), 'max_length[100]');
    if ($this->form_validation->run()) {

      $dtpDate = $this->input->post('dtpDate', TRUE);
      $datecheck = $this->fiscal_date_check($dtpDate);
      if (!$datecheck) {
        $this->session->set_userdata('error_message', display('invalid_date_selection'));
        redirect('accounting/accounting/voucher_approval');
      }

      if ($this->account_model->update_journalvoucher()) {
        $this->session->set_flashdata('message', display('successfully_updated'));
        redirect('accounting/accounting/voucher_approval');
      } else {
        $this->session->set_flashdata('exception',  display('please_try_again'));
      }
      redirect("accounting/accounting/voucher_approval");
    } else {
      $this->session->set_flashdata('exception',  validation_errors());
      redirect("accounting/accounting/voucher_approval");
    }
  }

  public function voucher_delete($voucher)
  {
    if ($this->account_model->delete_voucher($voucher)) {
      $this->session->set_flashdata('message', display('successfully_delete'));
    } else {
      $this->session->set_flashdata('exception', display('please_try_again'));
    }
    redirect($_SERVER['HTTP_REFERER']);
  }
  public function bdtask_cash_book()
  {
    $data['title']   = display('cash_book');
    $data['module']  = "account";
    $data['page']    = "cash_book";
    echo modules::run('template/layout', $data);
  }
  // Inventory Report
  public function bdtask_inventory_ledger()
  {
    $data['title']   = display('Inventory_ledger');
    $data['module']  = "account";
    $data['page']    = "inventory_ledger";
    echo modules::run('template/layout', $data);
  }
  public function bdtask_bank_book()
  {
    $data['title']   = display('bank_book');
    $data['module']  = "account";
    $data['page']    = "bank_book";
    echo modules::run('template/layout', $data);
  }
  public function bdtask_general_ledger()
  {
    $data['title']          = display('general_ledger');
    $data['general_ledger'] = $this->account_model->get_general_ledger();
    $data['module']         = "account";
    $data['page']           = "general_ledger";
    echo modules::run('template/layout', $data);
  }
  public function general_led($Headid = NULL)
  {
    $Headid   = $this->input->post('Headid', TRUE);
    $HeadName = $this->account_model->general_led_get($Headid);
    echo  "<option>Transaction Head</option>";
    $html = "";
    foreach ($HeadName as $data) {
      $html .= "<option value='$data->HeadCode'>$data->HeadName</option>";
    }
    echo $html;
  }

  //general ledger working
  public function accounts_report_search()
  {
    $cmbGLCode      = $this->input->post('cmbGLCode', TRUE);
    $cmbCode        = $this->input->post('cmbCode', TRUE);
    $dtpFromDate    = $this->input->post('dtpFromDate', TRUE);
    $dtpToDate      = $this->input->post('dtpToDate', TRUE);
    $chkIsTransction = $this->input->post('chkIsTransction', TRUE);
    $HeadName       = $this->account_model->general_led_report_headname($cmbGLCode);
    $HeadName2      = $this->account_model->general_led_report_headname2($cmbGLCode, $cmbCode, $dtpFromDate, $dtpToDate, $chkIsTransction);
    $pre_balance     = $this->account_model->general_led_report_prebalance($cmbCode, $dtpFromDate);
    $data = array(
      'title'          => display('general_ledger_report'),
      'dtpFromDate'    => $dtpFromDate,
      'dtpToDate'      => $dtpToDate,
      'HeadName'       => $HeadName,
      'HeadName2'      => $HeadName2,
      'prebalance'     =>  $pre_balance,
      'chkIsTransction' => $chkIsTransction,
    );
    $data['ledger']  = $this->db->select('*')->from('acc_coa')->where('HeadCode', $cmbCode)->get()->result_array();
    $data['module']  = "account";
    $data['page']    = "general_ledger_report";
    echo modules::run('template/layout', $data);
  }
  //Trial Balannce
  public function bdtask_trial_balance_form()
  {
    $data['title']   = display('trial_balance');
    $data['module']  = "account";
    $data['page']    = "trial_balance";
    echo modules::run('template/layout', $data);
  }
  //Trial Balance Report
  public function bdtask_trial_balance_report()
  {
    $dtpFromDate     = $this->input->post('dtpFromDate', TRUE);
    $dtpToDate       = $this->input->post('dtpToDate', TRUE);
    $chkWithOpening  = $this->input->post('chkWithOpening', TRUE);
    $results         = $this->account_model->trial_balance_report($dtpFromDate, $dtpToDate, $chkWithOpening);
    if ($results['WithOpening'] == 1) {
      $data['oResultTr']    = $results['oResultTr'];
      $data['oResultInEx']  = $results['oResultInEx'];
      $data['dtpFromDate']  = $dtpFromDate;
      $data['dtpToDate']    = $dtpToDate;
      $data['title']        = display('trial_balance');
      $data['module']       = "account";
      $data['page']         = "trial_balance_with_opening";
      echo modules::run('template/layout', $data);
    } else {
      $data['oResultTr']    = $results['oResultTr'];
      $data['oResultInEx']  = $results['oResultInEx'];
      $data['dtpFromDate']  = $dtpFromDate;
      $data['dtpToDate']    = $dtpToDate;
      $data['title']        = display('trial_balance');
      $data['module']       = "account";
      $data['page']         = "trial_balance_without_opening";
      echo modules::run('template/layout', $data);
    }
  }
  //Profit loss report page
  public function bdtask_profit_loss_report_form()
  {
    $data['title']   = display('profit_loss');
    $data['module']  = "account";
    $data['page']    = "profit_loss_report";
    echo modules::run('template/layout', $data);
  }
  //Profit loss serch result
  public function bdtask_profit_loss_report_search()
  {
    $dtpFromDate             = $this->input->post('dtpFromDate', TRUE);
    $dtpToDate               = $this->input->post('dtpToDate', TRUE);
    $get_profit              = $this->account_model->profit_loss_serach();
    $data['oResultAsset']    = $get_profit['oResultAsset'];
    $data['oResultLiability'] = $get_profit['oResultLiability'];
    $data['dtpFromDate']     = $dtpFromDate;
    $data['dtpToDate']       = $dtpToDate;
    $data['pdf']             = 'assets/data/pdf/Statement of Comprehensive Income From ' . $dtpFromDate . ' To ' . $dtpToDate . '.pdf';
    $data['title']           = display('profit_loss');
    $data['module']          = "account";
    $data['page']            = "profit_loss_report_search";
    echo modules::run('template/layout', $data);
  }
  //Cash flow page
  public function bdtask_cash_flow_form()
  {
    $data['title']  = display('cash_flow_report');
    $data['module'] = "account";
    $data['page']   = "cash_flow_report";
    echo modules::run('template/layout', $data);
  }

  //Cash flow report search
  public function cash_flow_report_search()
  {
    $dtpFromDate          = $this->input->post('dtpFromDate', TRUE);
    $dtpToDate            = $this->input->post('dtpToDate', TRUE);
    $data['dtpFromDate']  = $dtpFromDate;
    $data['dtpToDate']    = $dtpToDate;
    $data['title']        = display('cash_flow_report');
    $data['module']       = "account";
    $data['page']         = "cash_flow_report_search";
    echo modules::run('template/layout', $data);
  }
  public function bdtask_coa_print()
  {
    $data['title']        = display('coa_print');
    $data['module']       = "account";
    $data['page']         = "coa_print";
    echo modules::run('template/layout', $data);
  }
  public function bdtask_balance_sheet()
  {
    $data['title']       = display('balance_sheet');
    $from_date           = (!empty($this->input->post('dtpFromDate', true)) ? $this->input->post('dtpFromDate', true) : date('Y-m-d'));
    $to_date             = (!empty($this->input->post('dtpToDate', true)) ? $this->input->post('dtpToDate', true) : date('Y-m-d'));
    $data['from_date']   = $from_date;
    $data['to_date']     = $to_date;
    $data['fixed_assets'] = $this->account_model->fixed_assets();
    $data['liabilities'] = $this->account_model->liabilities_data();
    $data['incomes']     = $this->account_model->income_fields();
    $data['expenses']    = $this->account_model->expense_fields();
    $data['module']      = "account";
    $data['page']        = "balance_sheet";
    echo modules::run('template/layout', $data);
  }

  //Default loading for receipt voucher system.
  public function receipt_voucher()
  {
    $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    if (!empty($find_active_fiscal_year)) {
      $this->load->model(array(
        'dashboard/Stores',
        'dashboard/Variants',
        'dashboard/Customers',
        'dashboard/Shipping_methods'
      ));
      $store_list   = $this->Stores->store_list();
      $variant_list = $this->Variants->variant_list();
      $shipping_methods = $this->Shipping_methods->shipping_method_list();
      $customer = $this->Customers->customer_list();
      $data = array(
        'title'           => display('receipt_voucher'),
        'store_list'      => $store_list,
        'variant_list'    => $variant_list,
        'customer'        => $customer[0],
        'shipping_methods' => $shipping_methods,
        'voucher_no'      => $this->account_model->Creceive()
      );
      $receipt_voucher_form = $this->parser->parse('accounting/receipt_voucher_form', $data, true);
      $this->template_lib->full_admin_html_view($receipt_voucher_form);
    } else {
      $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
      redirect(base_url('Admin_dashboard'));
    }
  }

  public function insert_receipt_voucher()
  {
    $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    if (!empty($find_active_fiscal_year)) {
      $this->form_validation->set_rules('txtCode', display('Code'), 'required|max_length[100]');
      $this->form_validation->set_rules('txtAmount', display('amount'), 'max_length[100]');
      $this->form_validation->set_rules('product_id[]', display('item_information'), 'max_length[100]');
      $this->form_validation->set_rules('variant_id[]', display('variant'), 'max_length[100]');
      $this->form_validation->set_rules('product_quantity[]', display('quantity'), 'max_length[100]');
      $this->form_validation->set_rules('product_rate[]', display('rate'), 'max_length[100]');
      if ($this->form_validation->run() == TRUE) {
        $dtpDate = $this->input->post('dtpDate', TRUE);
        $datecheck = $this->fiscal_date_check($dtpDate);
        if (!$datecheck) {
          $this->session->set_userdata('error_message', display('invalid_date_selection'));
          redirect('accounting/accounting/receipt_voucher');
        }
        if ($this->account_model->customer_receive_insert()) {
          $this->session->set_flashdata('message', display('save_successfully'));
        } else {
          $this->session->set_flashdata('exception',  display('please_try_again'));
        }
      }
      $this->receipt_voucher();
    } else {
      $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
      redirect(base_url('Admin_dashboard'));
    }
  }
  public function payment_voucher()
  {
    $this->load->model(array(
      'dashboard/Variants',
      'dashboard/Customers',
      'dashboard/Shipping_methods'
    ));
    $r_voucher_list  = $this->account_model->r_voucher_list();
    $variant_list    = $this->Variants->variant_list();
    $shipping_methods = $this->Shipping_methods->shipping_method_list();
    $customer        = $this->Customers->customer_list();
    $data = array(
      'title'           => display('payment_voucher'),
      'r_voucher_list'  => $r_voucher_list,
      'variant_list'    => $variant_list,
      'customer'        => $customer[0],
      'shipping_methods' => $shipping_methods
    );
    $payment_voucher_form = $this->parser->parse('accounting/payment_voucher_form', $data, true);
    $this->template_lib->full_admin_html_view($payment_voucher_form);
  }
  public function get_customer_headCode()
  {
    $customer_id = $this->input->post('customer_id', TRUE);
    $customer_headcode = $this->account_model->get_customer_headcode($customer_id);
    if ($customer_headcode) {
      echo $customer_headcode->HeadCode;
    } else {
      return false;
    }
  }
  public function search_rv()
  {
    $term = $this->input->get('search', true);
    if (!empty($term)) {
      $this->db->select("VNo as id, VNo as text")
        ->from('acc_transaction')
        ->where('Vtype', 'RV')
        ->group_by('VNo')
        ->like('VNo', $term);
      $result = $this->db->get()->result();
      echo json_encode(['items' => $result]);
    } else {
      echo false;
    }
  }
  public function get_rv_info($id)
  {
    $this->db->select("*");
    $this->db->from('acc_transaction a');
    $this->db->where('a.VNo', $id);
    $this->db->join('acc_coa b', 'a.COAID=b.HeadCode', 'left');
    $this->db->join('customer_information c', 'b.customer_id=c.customer_id', 'left');
    $result = $this->db->get()->result_array();
    $result[0]['total_vat'] = 0;
    $result[0]['total_balance'] = $result[0]['Debit'] + $result[0]['total_vat'];
    echo json_encode($result);
  }
  public function insert_payment_voucher()
  {
    $this->form_validation->set_rules('cmbDebit', display('credit_account_head'), 'required|max_length[100]');
    $this->form_validation->set_rules('dtpDate', display('date'), 'required|max_length[100]');
    $this->form_validation->set_rules('txtAmount[]', display('amount'), 'required|max_length[100]');
    $this->form_validation->set_rules('cmbDebit', display('cmbDebit'), 'max_length[100]');
    if ($this->form_validation->run()) {
      if ($this->account_model->insert_payment_voucher()) {
        $this->session->set_flashdata('message', display('save_successfully'));
        redirect('accounting/accounting/payment_voucher');
      } else {
        $this->session->set_flashdata('exception',  display('please_try_again'));
        redirect('accounting/accounting/payment_voucher');
      }
    }
  }
  // Pos Payment form
  public function get_pos_payment_form()
  {
    $grandtotal = $this->input->post('grandtotal', TRUE);
    $totalpaid = $this->input->post('totalpaid', TRUE);
    $more = $this->input->post('more', TRUE);
    if (!empty($more) && $more == 'more') {
      $grandtotal = floatval($grandtotal) - floatval($totalpaid);
    }
    $html = '';
    $row_id = mt_rand();

    if (empty($more)) {
      $html .= '
          <div class="table-responsive">
            <table class="table table-bordered" id="payment_area_table">
              <tr class="info">
                <th>' . display('card_type') . '</th>
                <th>' . display('card_no') . '</th>
                <th>' . display('pay_amount') . '</th>
                <th>' . display('action') . '</th>
              </tr>';
    }
    $html .= '<tr id="row_' . $row_id . '">
                  <td>
                      <div class="form-group payment-row row guifooterpanel">
                          <div class="col-sm-12">
                                  <select class="form-control dont-select-me" name="card_type[]">
                                      <option value="Credit Card">' . display('credit_card') . '</option>
                                      <option value="Debit Card">' . display('debit_card') . '</option>
                                      <option value="Master Card">' . display('master_card') . '</option>
                                      <option value="Amex">' . display('amex') . '</option value="Credit Cart">
                                      <option value="Visa">' . display('visa') . '</option value="Credit Cart">
                                      <option value="Paypal">' . display('paypal') . '</option>
                                      <option value="Others">' . display('others') . '</option>
                                  </select>
                          </div>
                      </div>
                  </td>
                  <td>
                      <div class="form-group payment-row row guifooterpanel">
                          <div class="col-sm-12">
                              <input class="form-control" type="text" name="card_no[]"  placeholder="' . display('card_no') . '">
                          </div>
                      </div>
                  </td>
                  <td>
                      <div class="form-group payment-row row guifooterpanel">
                          <div class="col-sm-12">
                              <input class="form-control" type="text" name="payment_amount[]" value="' . $grandtotal . '" placeholder="' . display('pay_amount') . '">
                          </div>
                      </div>
                  </td>
                  <td>';
    if (empty($more)) {
      $html .= '<button class="btn btn-success" id="add_more_btn" ><i class="ti-plus"></i></button>';
    } else {
      $html .= '<button class="btn btn-danger del_more_btn" data-row_id="' . $row_id . '" ><i class="ti-minus"></i></button>';
    }
    $html .= '
                  </td>
                </tr>';
    if (empty($more)) {
      $html .= '
          </table>
      </div>';
    }
    echo $html;
  }

  public function get_customer()
  {
    $term = $this->input->get('search', true);

    if (!empty($term)) {
      $this->db->select('customer_id as id,customer_name as text');
      $this->db->from('customer_information');
      $this->db->like('customer_name', $term, 'both');
      $result = $this->db->get()->result();

      echo json_encode(['items' => $result]);
    } else {
      echo false;
    }
  }
  // Fiscal Year
  public function fiscal_year($param = 'list', $item_id = false)
  {
    if ($param == 'add') {

      $this->form_validation->set_rules('title', display('title'), 'trim|required');
      $this->form_validation->set_rules('start_date', display('start_date'), 'trim|required');
      $this->form_validation->set_rules('end_date', display('end_date'), 'trim|required');

      if ($this->form_validation->run() == TRUE) {
        $start_date = date('Y-m-d', strtotime($this->input->post('start_date', TRUE)));
        $end_date  = date('Y-m-d', strtotime($this->input->post('end_date', TRUE)));

        $check_year = $this->account_model->check_fiscal_year($start_date, $end_date);

        if ($check_year >  0) {
          $this->session->set_flashdata('message', display('another_fiscal_year_exist_in_given_range'));
          redirect('accounting/fiscal_year/add');
        }
        $fdata = array(
          'title'     => $this->input->post('title', TRUE),
          'start_date' => $start_date,
          'end_date'  => $end_date,
          'status'    => 0
        );
        $this->db->trans_start();
        $this->db->insert('acc_fiscal_year', $fdata);
        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) {
          $this->session->set_flashdata('message', display('successfully_added'));
        } else {
          $this->session->set_flashdata('exception', display('failed_try_again'));
        }
      }

      $data = array(
        'title' => display('fiscal_year')
      );
      $content = $this->parser->parse('accounting/fiscal_year/add', $data, true);
      $this->template_lib->full_admin_html_view($content);
    } else if (($param == 'edit') && !empty($item_id)) {

      $iteminfo = $this->account_model->get_fiscaldata_by_id($item_id);

      $this->form_validation->set_rules('title', display('title'), 'trim|required');
      $this->form_validation->set_rules('start_date', display('start_date'), 'trim|required');
      $this->form_validation->set_rules('end_date', display('end_date'), 'trim|required');

      if ($this->form_validation->run() == TRUE) {
        $start_date = $this->input->post('start_date', TRUE);
        $end_date = $this->input->post('end_date', TRUE);
        $check_year = $this->account_model->check_fiscal_year($start_date, $end_date, $item_id);

        if ($check_year >  0) {
          $this->session->set_flashdata('message', display('another_fiscal_year_exist_in_given_range'));
          redirect('accounting/fiscal_year/edit/' . $item_id);
        }
        $fdata = array(
          'title' => $this->input->post('title', TRUE),
          'start_date' => date('Y-m-d', strtotime($start_date)),
          'end_date' => date('Y-m-d', strtotime($end_date)),
        );

        $this->db->trans_start();
        $this->db->update('acc_fiscal_year', $fdata, array('id' => $item_id));
        $this->db->trans_complete();

        if ($this->db->trans_status() == TRUE) {
          $this->session->set_flashdata('message', display('successfully_updated'));
          redirect('accounting/fiscal_year');
        } else {
          $this->session->set_flashdata('exception', display('failed_try_again'));
        }
      }

      $data = array(
        'title'    => display('fiscal_year'),
        'iteminfo' => $iteminfo
      );
      $content = $this->parser->parse('accounting/fiscal_year/edit', $data, true);
      $this->template_lib->full_admin_html_view($content);
    } else if (($param == 'delete') && !empty($item_id)) {
      $result = $this->db->delete('acc_fiscal_year',  array('id' => $item_id));
      if ($result) {
        $this->session->set_flashdata('message', display('successfully_delete'));
      } else {
        $this->session->set_flashdata('exception', display('failed_try_again'));
      }
      redirect('accounting/fiscal_year');
    } else {
      $fiscal_years = $this->account_model->get_fiscal_year();
      $data = array(
        'title'        => display('fiscal_year'),
        'fiscal_years' => $fiscal_years
      );
      $content = $this->parser->parse('accounting/fiscal_year/list', $data, true);
      $this->template_lib->full_admin_html_view($content);
    }
  }

  public function active_fiscal_year($id)
  {
    $find_active = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    if (!empty($find_active)) {
      $this->session->set_flashdata('exception', display('an_active_fiscal_year_exists'));
      redirect('accounting/fiscal_year/list');
    }
    $fy_status = $this->input->post('fy_status', true);
    $data = array('status' => $fy_status);
    $res  = $this->db->where('id', $id)->update('acc_fiscal_year', $data);
    $this->session->set_flashdata('message', display('Updated_successfully'));
    redirect('accounting/fiscal_year/list');
  }
  public function fiscal_year_ending()
  {
    $find_active = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->result();
    $data = array(
      'title'      => display('fiscal_year_ending'),
      'fiscal_year' => $find_active
    );
    $content = $this->parser->parse('accounting/fiscal_year/fiscal_year_ending', $data, true);
    $this->template_lib->full_admin_html_view($content);
  }

  public function complete_fiscal_year_ending()
  {
    $find_new_fy = $this->db->select('id')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    $find_active = $this->db->select('id,title')->from('acc_fiscal_year')->where('status', 1)->get()->row();
    $find_new_fy = $this->db->select('id')->from('acc_fiscal_year')->where('status', 0)->where('id>' . $find_active->id)->get()->row();
    if (!empty($find_new_fy->id)) {
      $this->db->select('COAID, SUM(Debit) AS total_debit, SUM(Credit) AS total_credit');
      $this->db->from('acc_transaction');
      $this->db->where('fy_id', $find_active->id);
      $this->db->group_by('COAID');
      $transection_summery = $this->db->get()->result_array();
      if (!empty($transection_summery)) {
        $query = $this->db->query('CREATE TABLE ' . str_replace("-", "_", $find_active->title) . '_closing_balances' . ' (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `fy_id` int(11) NOT NULL,
            `headcode` int(11) NOT NULL,
            `amount` int(11) NOT NULL,
            `adjustment_date` date DEFAULT NULL,
            `created_by` varchar(50) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8');

        $query2 = $this->db->query('CREATE TABLE ' . str_replace("-", "_", $find_active->title) . '_closed_transections' . ' (
                                    `ID` int(11) NOT NULL AUTO_INCREMENT,
                                    `fy_id` int(11) NOT NULL,
                                    `VNo` varchar(50) DEFAULT NULL,
                                    `Vtype` varchar(50) DEFAULT NULL,
                                    `VDate` date DEFAULT NULL,
                                    `COAID` varchar(50) NOT NULL,
                                    `Narration` text DEFAULT NULL,
                                    `Debit` decimal(18,2) DEFAULT NULL,
                                    `Credit` decimal(18,2) DEFAULT NULL,
                                    `IsPosted` char(10) DEFAULT NULL,
                                    `is_opening` int(11) NOT NULL DEFAULT 0,
                                    `store_id` varchar(50) DEFAULT NULL,
                                    `CreateBy` varchar(50) DEFAULT NULL,
                                    `CreateDate` datetime DEFAULT NULL,
                                    `UpdateBy` varchar(50) DEFAULT NULL,
                                    `UpdateDate` datetime DEFAULT NULL,
                                    `IsAppove` char(10) DEFAULT NULL,
                                    UNIQUE KEY `ID` (`ID`),
                                    KEY `COAID` (`COAID`)
                                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
        $archieve = $this->db->query('INSERT INTO ' . str_replace("-", "_", $find_active->title) . '_closed_transections (fy_id,VNo,Vtype,VDate,COAID,Narration,Debit,Credit,IsPosted,is_opening,store_id,CreateBy,CreateDate,UpdateBy,UpdateDate,IsAppove) SELECT fy_id,VNo,Vtype,VDate,COAID,Narration,Debit,Credit,IsPosted,is_opening,store_id,CreateBy,CreateDate,UpdateBy,UpdateDate,IsAppove FROM acc_transaction WHERE fy_id = ' . $find_active->id . ' ');
      }
      $date = date("Y-m-d");
      $createby = $this->session->userdata('user_id');
      foreach ($transection_summery as $key => $transection) {
        $past_op_balance = $this->db->select('amount')->from('acc_opening_balances')->where('headcode', $transection['COAID'])->get()->row();
        if (!empty($past_op_balance) && !empty($past_op_balance->amount)) {
          $past_balance = $past_op_balance->amount;
        } else {
          $past_balance = 0;
        }
        $amount = $past_balance + ($transection['total_debit'] - $transection['total_credit']);
        $data1 = array(
          'fy_id'          => $find_active->id,
          'headcode'       => $transection['COAID'],
          'adjustment_date' => $date,
          'amount'         => $amount,
          'created_by'     => $createby,
        );
        $insert1 = $this->db->insert(str_replace("-", "_", $find_active->title) . '_closing_balances', $data1);
        $head_type = $this->db->select('HeadType')->from('acc_coa')->where('HeadCode', $transection['COAID'])->get()->row();
        $data2 = array(
          'fy_id'          => $find_new_fy->id,
          'headcode'       => $transection['COAID'],
          'adjustment_date' => $date,
          'amount'         => (($head_type->HeadType == 'E' || $head_type->HeadType == 'I') ? 0 : $amount),
          'created_by'     => $createby,
        );
        $insert2 = $this->db->insert('acc_opening_balances', $data2);
      }
      $active_year_id = $this->input->post('active_year_id', TRUE);
      $data = array('status' => 2);
      $res  = $this->db->where('id', $active_year_id)->update('acc_fiscal_year', $data);
      $this->session->set_flashdata('message', display('fiscal_year_closed_successfully'));
      redirect('accounting/fiscal_year/list');
    } else {
      $this->session->set_flashdata('exception', display('please_add_new_fiscal_year_first'));
      return $this->fiscal_year('list');
    }
  }
}
