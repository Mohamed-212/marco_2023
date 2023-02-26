<?php
defined('BASEPATH') or exit('No direct script access allowed');
#------------------------------------
# Author: Bdtask Ltd
# Author link: https://www.bdtask.com/
# Dynamic style php file
# Developed by :Isahaq
#------------------------------------

class Payroll extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->check_user_auth();
        $this->load->model(array('payroll_model'));
    }


    public function bdtask_beneficial_form()
    {
        $data['title'] = display('add_beneficial');
//        $data['module']     = "hrm";
//        $data['page']       = "payroll/beneficial_form";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/payroll/beneficial_form', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    //Add Salary Beneficial
    public function beneficial_entry()
    {
        $this->form_validation->set_rules('sal_name', display('salary_benefits'), 'required|max_length[200]');
        $this->form_validation->set_rules('emp_sal_type', display('salary_benefits_type'), 'required|max_length[200]');
        if ($this->form_validation->run() === true) {
            $postData = [
                'sal_name' => $this->input->post('sal_name', true),
                'salary_type' => $this->input->post('emp_sal_type', true),
                'status' => 1,
            ];
            if ($this->payroll_model->add_beneficial($postData)) {
                $this->session->set_flashdata('message', display('save_successfully'));
            } else {
                $this->session->set_flashdata('exception', display('please_try_again'));
            }
            redirect("hrm/payroll/manage_benefits");
        } else {
            $this->session->set_flashdata('exception', validation_errors());
            redirect("hrm/payroll/bdtask_beneficial_form");
        }
    }


    public function benefits_update_form($id)
    {
        $data['title'] = display('edit_beneficials');
        $data['data'] = $this->payroll_model->salarysetup_updateForm($id);
//        $data['module'] = "hrm";
//        $data['page'] = "payroll/update_beneficial_form";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/payroll/update_beneficial_form', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    // benefits type update
    public function update_benefitstype()
    {
        $postData = [
            'salary_type_id' => $this->input->post('salary_type_id', true),
            'sal_name' => $this->input->post('sal_name', true),
            'salary_type' => $this->input->post('emp_sal_type', true),

        ];
        if ($this->payroll_model->update_benefits($postData)) {
            $this->session->set_flashdata('message', display('successfully_updated'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect("hrm/payroll/manage_benefits");
    }


    // Manage Beneficial
    public function manage_benefits()
    {
        $data['title'] = display('manage_benefits');
        $data['beneficial_list'] = $this->payroll_model->salary_setupView();
//        $data['module'] = "hrm";
//        $data['page'] = "payroll/beneficial_list";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/payroll/beneficial_list', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }


    public function delete_benefits($id = null)
    {
        if ($this->payroll_model->benefits_delete($id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set error_message message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect("hrm/payroll/manage_benefits");
    }


    // ====================== Salary Setup part start ========================
    public function bdtask_salary_setup_form()
    {
        $data['title'] = display('salary_setup');
        $data['slname'] = $this->payroll_model->salary_typeName();
        $data['sldname'] = $this->payroll_model->salary_typedName();
        $data['employee'] = $this->payroll_model->empdropdown();
//        $data['module'] = "hrm";
//        $data['page'] = "payroll/salarysetup_form";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/payroll/salarysetup_form', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function employeebasic()
    {
        $id = $this->input->post('employee_id', TRUE);
        $data = $this->db->select('hrate,rate_type')->from('employee_history')->where('id', $id)->get()->row();
        $basic = $data->hrate;
        if ($data->rate_type == 1) {
            $type = 'Hourly';
        } else {
            $type = 'Salary';
        }
        $sent = array(
            'rate' => $data->hrate,
            'rate_type' => $data->rate_type,
            'stype' => $type
        );
        echo json_encode($sent);
    }

    public function salarywithtax()
    {
        $tamount = $this->input->post('amount', TRUE);
        $amount = (int)($tamount * 12);
        $this->db->select('*');
        $this->db->from('payroll_tax_setup');
        $this->db->where("start_amount <", $amount);
        $query = $this->db->get();
        $taxrate = $query->result_array();
        $TotalTax = 0;
        $total_diff = 0;
        foreach ($taxrate as $row) {
            // "Inside tax calculation";
            if ($amount > $row['start_amount'] && $amount > $row['end_amount']) {
                $diff = $row['end_amount'] - $row['start_amount'];
                $total_diff += $diff;
            }
            if ($amount > $row['start_amount'] && $amount < $row['end_amount']) {
                $diff = $amount - $total_diff;
            }
            $tax = (($row['rate'] / 100) * $diff);
            $TotalTax += $tax;
        }
        $salary = $TotalTax / 12;
        echo json_encode(number_format($salary, 2));
    }

    public function salary_setup_entry()
    {
        $date = date('Y-m-d');
        $check_exist = $this->payroll_model->check_exist($this->input->post('employee_id', true));
        if ($check_exist == 0) {
            $amount = $this->input->post('amount', TRUE);
            foreach ($amount as $key => $value) {
                $postData = [
                    'employee_id' => $this->input->post('employee_id', true),
                    'sal_type' => $this->input->post('sal_type', true),
                    'salary_type_id' => $key,
                    'amount' => (!empty($value) ? $value : 0),
                    'create_date' => $date,
                    'gross_salary' => $this->input->post('gross_salary', true),
                ];

                $this->payroll_model->salary_setup_create($postData);

            }
            $this->session->set_flashdata('message', display('save_successfully'));
            redirect("hrm/payroll/manage_salary_setup");
        } else {
            $this->session->set_flashdata('exception', display('already_exist'));
            redirect("hrm/payroll/bdtask_salary_setup_form");
        }
    }

    // Manage Salary Setup
    public function manage_salary_setup()
    {
        $data['title'] = display('manage_salary_setup');
        $data['emp_sl_setup'] = $this->payroll_model->salary_setupindex();
//        $data['module'] = "hrm";
//        $data['page'] = "payroll/manage_salary_setup";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/payroll/manage_salary_setup', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function salsetup_upform($id)
    {
        $data['title'] = display('edit_setup_update');
        $data['data'] = $this->payroll_model->salary_s_updateForm($id);
        $data['samlft'] = $this->payroll_model->salary_amountlft($id);
        $data['amo'] = $this->payroll_model->salary_amount($id);
        $data['employee'] = $this->payroll_model->empdropdown();
        $data['EmpRate'] = $this->payroll_model->employee_informationId($id);
//        $data['module'] = "hrm";
//        $data['page'] = "payroll/update_sal_setup_form";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/payroll/update_sal_setup_form', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    // salary setup update
    public function salary_setup_update()
    {
        $amount = $this->input->post('amount', true);
        foreach ($amount as $key => $value) {
            $postData = array(
                'employee_id' => $this->input->post('employee_id', true),
                'sal_type' => $this->input->post('sal_type', true),
                'salary_type_id' => $key,
                'amount' => $value,
                'gross_salary' => $this->input->post('gross_salary', true),
            );
            $this->payroll_model->update_sal_stup($postData);
        }
        redirect("hrm/payroll/manage_salary_setup");
    }

    public function delete_salsetup($id = null)
    {
        if ($this->payroll_model->emp_salstup_delete($id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set error_message message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect("hrm/payroll/manage_salary_setup");
    }

    public function bdtask_salary_generate()
    {
        $data['title'] = display('salary_generate');
//        $data['module'] = "hrm";
//        $data['page'] = "payroll/salary_generate_form";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/payroll/salary_generate_form', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function create_salary_generate()
    {
        $employee = $this->db->select('employee_id')->from('employee_salary_setup')->group_by('employee_id')->get()->result();
        list($month, $year) = explode(' ', $this->input->post('myDate', TRUE));
        $query = $this->db->select('*')->from('salary_sheet_generate')->where('gdate', $this->input->post('myDate', TRUE))->get()->num_rows();
        if ($query > 0) {
            $this->session->set_userdata(array('exception' => display('the_salary_of') . $month . display('already_generated')));
            redirect("hrm/payroll/bdtask_salary_generate");
        }

        switch ($month) {
            case "January":
                $month = '1';
                break;
            case "February":
                $month = '2';
                break;
            case "March":
                $month = '3';
                break;
            case "April":
                $month = '4';
                break;
            case "May":
                $month = '5';
                break;
            case "June":
                $month = '6';
                break;
            case "July":
                $month = '7';
                break;
            case "August":
                $month = '8';
                break;
            case "September":
                $month = '9';
                break;
            case "October":
                $month = '10';
                break;
            case "November":
                $month = '11';
                break;
            case "December":
                $month = '12';
                break;
        }
        $fdate = $year . '-' . $month . '-' . '1';
        $lastday = date('t', strtotime($fdate));
        $edate = $year . '-' . $month . '-' . $lastday;
        $startd = $fdate;
        $ab = $this->input->post('myDate', TRUE);

        $postData = [
            'name' => '',
            'gdate' => $ab,
            'start_date' => $fdate,
            'end_date' => $edate,
            // 'generate_by' => $this->session->userdata('user_name'),
            'generate_by' => $this->session->userdata('user_name'),
        ];

        $this->db->insert('salary_sheet_generate', $postData);
        $generate_id = $this->db->insert_id();
        if (sizeof($employee) > 0)
            foreach ($employee as $key => $value) {
                $aAmount = $this->db->select('gross_salary,sal_type,employee_id')->from('employee_salary_setup')->where('employee_id', $value->employee_id)->get()->row();
                $Amount = $aAmount->gross_salary;
                $startd = $fdate;
                $end = $edate;
                $times = $this->db->select('SUM(TIME_TO_SEC(staytime)) AS staytime')->from('attendance')->where('date BETWEEN "' . date('Y-m-d', strtotime($startd)) . '" and "' . date('Y-m-d', strtotime($end)) . '"')->where("employee_id", $value->employee_id)->get()->row()->staytime;
                $wormin = ($times / 60);
                $worhour = $wormin / 60;
                if ((int)$aAmount->sal_type == 1) {
                    $dStart = new DateTime($startd);
                    $dEnd = new DateTime($end);
                    $dDiff = $dStart->diff($dEnd);
                    $numberofdays = $dDiff->days + 1;
                    $totamount = $Amount * $worhour;
                    $PYI = ($totamount / $numberofdays) * 365;
                    $PossibleYearlyIncome = round($PYI);
                    $this->db->select('*');
                    $this->db->from('payroll_tax_setup');
                    $this->db->where("start_amount <", $PossibleYearlyIncome);
                    $query = $this->db->get();
                    $taxrate = $query->result_array();
                    $TotalTax = 0;
                    foreach ($taxrate as $row) {

                        if ($PossibleYearlyIncome > $row['start_amount'] && $PossibleYearlyIncome > $row['end_amount']) {
                            $diff = $row['end_amount'] - $row['start_amount'];
                        }
                        if ($PossibleYearlyIncome > $row['start_amount'] && $PossibleYearlyIncome < $row['end_amount']) {
                            $diff = $PossibleYearlyIncome - $row['start_amount'];
                        }
                        $tax = (($row['rate'] / 100) * $diff);
                        $TotalTax += $tax;
                    }
                    $TaxAmount = ($TotalTax / 365) * $numberofdays;

                    $netAmount = $totamount - $TaxAmount;
                    
                } else if ((int)$aAmount->sal_type == 2) {
                    $netAmount = $Amount;
                }

                $workingper = $this->db->select('COUNT(date) AS date')->from('attendance')->where('date BETWEEN "' . date('Y-m-d', strtotime($startd)) . '" and "' . date('Y-m-d', strtotime($end)) . '"')->where("employee_id", $value->employee_id)->get()->row()->date;
                $emp_info = $this->db->select('first_name,last_name')->from('employee_history')->where('id', $value->employee_id)->get()->row();
                $headname = $value->employee_id . '-' . $emp_info->first_name . '' . $emp_info->last_name;
                $headcode = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName', $headname)->get()->row()->HeadCode;
                $paymentData = array(
                    'generate_id' => $generate_id,
                    'employee_id' => $value->employee_id,
                    'total_salary' => $netAmount,
                    'total_working_minutes' => $worhour,
                    'working_period' => $workingper,
                    'salary_month' => $ab,
                    // 'paid_by' => $this->session->userdata('user_name'),
                    'paid_by' => $this->session->userdata('user_name'),
                );
                // echo"<pre>";var_dump($paymentData);exit;
//                    $empsalgen = array(
//                        'fy_id' => $find_active_fiscal_year->id,
//                        'VNo' => $ab,
//                        'Vtype' => 'Salary',
//                        'VDate' => date('Y-m-d'),
//                        'COAID' => $headcode,
//                        'Narration' => 'Employee Salary Generate Month of ' . $ab,
//                        'Debit' => 0,
//                        'Credit' => $netAmount,
//                        'IsPosted' => 1,
//                        'CreateBy' => $this->session->userdata('id'),
//                        'CreateDate' => date('Y-m-d H:i:s'),
//                        'IsAppove' => 1
//                    );
                if (!empty($aAmount->employee_id)) {
                    $this->db->insert('employee_salary_payment', $paymentData);
//                    $this->db->insert('acc_transaction', $empsalgen);
                }
            }
        $this->session->set_flashdata('message', display('successfully_generated'));
        redirect("hrm/payroll/manage_salary_generate");
    }


    //manage Salary Generate
    public function manage_salary_generate()
    {
        $data['title'] = display('salary_generate');
        $config["base_url"] = base_url('manage_salary_generate');
        $config["total_rows"] = $this->db->count_all('salary_sheet_generate');
        $config["per_page"] = 20;
        $config["uri_segment"] = 2;
        $config["last_link"] = "Last";
        $config["first_link"] = "First";
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['full_tag_open'] = "<ul class='pagination col-xs pull-right'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['salgen'] = $this->payroll_model->salary_generateView($config["per_page"], $page);
//        $data['module'] = "hrm";
//        $data['page'] = "payroll/sal_genview";
//        echo Modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/payroll/sal_genview', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }


    public function delete_salgenerate($id = null)
    {
        if ($this->payroll_model->sal_generate_delete($id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set error_message message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect("hrm/payroll/manage_salary_generate");
    }


    // Employee Salary Payment
    public function salary_payment()
    {
        $data['title'] = display('employee_salary_payment');
        $config["base_url"] = base_url('salary_payment');
        $config["total_rows"] = $this->db->count_all('employee_salary_payment');
        $config["per_page"] = 20;
        $config["uri_segment"] = 2;
        $config["last_link"] = "Last";
        $config["first_link"] = "First";
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['full_tag_open'] = "<ul class='pagination col-xs pull-right'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['emp_pay'] = $this->payroll_model->emp_paymentView($config["per_page"], $page);

        $bank_list = $this->db->select('*')->from('acc_coa')->where('PHeadCode', 111)
            ->or_where('PHeadCode', 112)
            ->get()
            ->result();
        $data['bank_list'] = $bank_list;
        // echo "<pre>";var_dump($bank_list);exit;

//        $data['module'] = "hrm";
//        $data['page'] = "payroll/paymentview";
//        echo Modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/payroll/paymentview', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function EmployeePayment()
    {
        $sal_id = $this->input->post('sal_id', TRUE);
        $employee_id = $this->input->post('employee_id', TRUE);
        $emplyeeinfo = $this->db->select('first_name,last_name')->from('employee_history')->where('id', $employee_id)->get()->row();
        $data = array(
            'employee_id' => $employee_id,
            'Ename' => $emplyeeinfo->first_name . ' ' . $emplyeeinfo->last_name,
            'salP_id' => $sal_id,
        );
        echo json_encode($data);
    }


    public function payconfirm($id = null)
    {
        $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
        if (!empty($find_active_fiscal_year)) {
            $postData = [
                'emp_sal_pay_id' => $this->input->post('emp_sal_pay_id', true),
                'payment_due' => 'paid',
                'payment_date' => date('Y-m-d'),
                'paid_by' => $this->session->userdata('user_name'),
            ];

            $emp_id = $this->input->post('employee_id', true);
            $c_name = $this->db->select('first_name,last_name')->from('employee_history')->where('id', $emp_id)->get()->row();
            $c_acc = $emp_id . '-' . $c_name->first_name . '' . $c_name->last_name;
//        $coatransactionInfo = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName', $c_acc)->get()->row();
//        $COAID = $coatransactionInfo->HeadCode;

            $bank_head = $this->input->post('bank_head', true);

            $cashinhand_credit = array(
                'fy_id' => $find_active_fiscal_year->id,
                'VNo' => $this->input->post('emp_sal_pay_id', true),
                'Vtype' => 'Salary',
                'VDate' => date('Y-m-d'),
                'COAID' => $bank_head,
                'Narration' => 'Cash in hand Credit For Employee Salary for-  ' . $c_name->first_name . ' ' . $c_name->last_name,
                'Debit' => 0,
                'Credit' => $this->input->post('total_salary', true),
                'IsPosted' => 1,
                'CreateBy' => $this->session->userdata('user_name'),
                'CreateDate' => date('Y-m-d H:i:s'),
                'IsAppove' => 1
            );
//        $accpayable = array(
//            'VNo' => $this->input->post('emp_sal_pay_id', true),
//            'Vtype' => 'Salary',
//            'VDate' => date('Y-m-d'),
//            'COAID' => $COAID,
//            'Narration' => 'Salary paid For- ' . $c_name->first_name . ' ' . $c_name->last_name,
//            'Debit' => $this->input->post('total_salary', true),
//            'Credit' => 0,
//            'IsPosted' => 1,
//            'CreateBy' => $this->session->userdata('user_name'),
//            'CreateDate' => date('Y-m-d H:i:s'),
//            'IsAppove' => 1
//        );
            //company expense for employee salary
            $expense = array(
                'fy_id' => $find_active_fiscal_year->id,
                'VNo' => $this->input->post('emp_sal_pay_id', true),
                'Vtype' => 'Salary',
                'VDate' => date('Y-m-d'),
                'COAID' => 42111,
                'Narration' => 'Salary paid For- ' . $c_acc,
                'Debit' => $this->input->post('total_salary', true),
                'Credit' => 0,
                'IsPosted' => 1,
                'CreateBy' => $this->session->userdata('user_name'),
                'CreateDate' => date('Y-m-d H:i:s'),
                'IsAppove' => 1
            );
            if ($this->payroll_model->update_payment($postData)) {
                $this->db->insert('acc_transaction', $cashinhand_credit);
                $this->db->insert('acc_transaction', $expense);
//            $this->db->insert('acc_transaction', $accpayable);
                $this->session->set_flashdata('message', display('successfully_paid'));
            } else {
                $this->session->set_flashdata('exception', display('please_try_again'));
            }
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
            redirect(base_url('Admin_dashboard'));
        }
    }


    public function payslip($id = null)
    {
        $data['title'] = display('salary_slip');
        $data['paymentdata'] = $this->payroll_model->salary_paymentinfo($id);
        $data['addition'] = $this->payroll_model->salary_addition_fields($data['paymentdata'][0]['employee_id']);
        $data['deduction'] = $this->payroll_model->salary_deduction_fields($data['paymentdata'][0]['employee_id']);
        $data['amountinword'] = $this->payroll_model->convert_number(intval(str_replace(',', '', $data['paymentdata'][0]['total_salary'])));
        $data['settingss'] = $this->payroll_model->setting();
        $data['company'] = $this->payroll_model->companyinfo();
//        $data['module'] = "hrm";
//        $data['page'] = "payroll/payslip";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/payroll/payslip', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }
}

