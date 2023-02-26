<?php
defined('BASEPATH') or exit('No direct script access allowed');
#------------------------------------
# Author: Bdtask Ltd
# Author link: https://www.bdtask.com/
# Dynamic style php file
# Developed by :Isahaq
#------------------------------------

class Loan extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->check_user_auth();
        $this->load->model(array('loan_model'));
    }


    public function bdtask_add_office_loan_person()
    {
        $data['title'] = display('add_person');
//        $data['module']     = "hrm";
//        $data['page']       = "office_loan/add_person";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/office_loan/add_person', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }


    public function submit_office_loan_person()
    {
        $person_id = $this->occational->generator(10);
        $coa = $this->loanheadcode();
        if ($coa->HeadCode != NULL) {
            $headcode = $coa->HeadCode + 1;
        } else {
            $headcode = "10203020001";
        }
        $data = array(
            'person_id' => $person_id,
            'person_name' => $this->input->post('name', TRUE),
            'person_phone' => $this->input->post('phone', TRUE),
            'person_address' => $this->input->post('address', TRUE),
            'status' => 1
        );
        $loan_coa = [
            'HeadCode' => $headcode,
            'HeadName' => $person_id . '-' . $this->input->post('name', TRUE),
            'PHeadName' => 'Loan Receivable',
            'HeadLevel' => '4',
            'IsActive' => '1',
            'IsTransaction' => '1',
            'IsGL' => '0',
            'HeadType' => 'A',
            'IsBudget' => '0',
            'IsDepreciation' => '0',
            'DepreciationRate' => '0',
            'CreateBy' => $this->session->userdata('id'),
            'CreateDate' => date('Y-m-d H:i:s'),
        ];

        $result = $this->loan_model->submit_officeloan_person($data);
        if ($result) {
            $this->db->insert('acc_coa', $loan_coa);
            $this->session->set_flashdata(array('message' => display('successfully_added')));
            redirect('hrm/loan/manage_ofln_person');
        } else {
            $this->session->set_flashdata(array('exception' => display('not_added')));
            redirect('hrm/loan/bdtask_add_office_loan_person');
        }
    }

    public function loanheadcode()
    {
        $query = $this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='4' And HeadCode LIKE '1020302000%'");
        return $query->row();
    }


    public function manage_ofln_person()
    {
        #pagination starts
        $data['title'] = display('manage_person');
        $config["base_url"] = base_url('manage_office_loan_person/');
        $config["total_rows"] = $this->loan_model->office_person_list_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 2;
        $config["num_links"] = 5;
        /* This Application Must Be Used With BootStrap 3 * */
        $config['full_tag_open'] = "<ul class='pagination'>";
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
        $data['person_list'] = $this->loan_model->office_loan_list($config["per_page"], $page);
//        $data['module']  = "hrm";
//        $data['page']   = "office_loan/manage_person";
//        echo Modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/office_loan/manage_person', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }


    public function office_loan_person_ledger($person_id)
    {
        $person_details_all = $this->loan_model->office_loan_persons();
        $person_details = $this->loan_model->select_person_by_id($person_id);
        $ledger = $this->loan_model->personledger_tradational($person_id);
        $balance = 0;
        $total_credit = 0;
        $total_debit = 0;
        $total_balance = 0;

        if (!empty($ledger)) {
            foreach ($ledger as $k => $v) {
                $ledger[$k]['balance'] = ($ledger[$k]['debit'] - $ledger[$k]['credit']) + $balance;
                $balance = $ledger[$k]['balance'];
                $ledger[$k]['subtotalDebit'] = $total_debit + $ledger[$k]['debit'];
                $ledger[$k]['date'] = $this->occational->dateConvert($ledger[$k]['date']);
                $total_debit = $ledger[$k]['subtotalDebit'];
                $ledger[$k]['subtotalCredit'] = $total_credit + $ledger[$k]['credit'];
                $total_credit = $ledger[$k]['subtotalCredit'];
                $ledger[$k]['subtotalBalance'] = $total_balance + $ledger[$k]['balance'];
                $total_balance = $ledger[$k]['subtotalDebit'] - $ledger[$k]['subtotalCredit'];
            }
        }
        $data = array(
            'title' => display('person_ledger'),
            'person_details' => $person_details,
            'person_details_all' => $person_details_all,
            'person_id' => $person_details[0]['person_id'],
            'person_name' => $person_details[0]['person_name'],
            'person_phone' => $person_details[0]['person_phone'],
            'person_address' => $person_details[0]['person_address'],
            'ledger' => $ledger,
            'subtotalDebit' => number_format($total_debit, 2, '.', ','),
            'subtotalCredit' => number_format($total_credit, 2, '.', ','),
            'subtotalBalance' => number_format($total_balance, 2, '.', ','),
            'links' => '',
        );
//        $data['module'] = "hrm";
//        $data['page'] = "office_loan/person_ledger";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/office_loan/person_ledger', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function phone_search_by_name()
    {
        $person_id = $this->input->post('person_id', TRUE);
        $result = $this->db->select('person_phone')
            ->from('person_information')
            ->where('person_id', $person_id)
            ->get()
            ->row();
        if ($result) {
            echo $result->person_phone;
        } else {
            return false;
        }
    }

    public function office_loan_ledger_search()
    {
        $today = date('Y-m-d');

        $person_id = $this->input->post('person_id', TRUE) ? $this->input->post('person_id', TRUE) : "";
        $from_date = $this->input->post('from_date', TRUE);
        $to_date = $this->input->post('to_date', TRUE) ? $this->input->post('to_date', TRUE) : $today;
        $person_details_all = $this->loan_model->office_loan_persons();
        $person_details = $this->loan_model->select_person_by_id($person_id);
        $ledger = $this->loan_model->ledger_search_by_date($person_id, $from_date, $to_date);
        $balance = 0;
        $total_credit = 0;
        $total_debit = 0;
        $total_balance = 0;

        if (!empty($ledger)) {
            foreach ($ledger as $k => $v) {
                $ledger[$k]['balance'] = ($ledger[$k]['debit'] - $ledger[$k]['credit']) + $balance;
                $balance = $ledger[$k]['balance'];
                $ledger[$k]['date'] = $this->occational->dateConvert($ledger[$k]['date']);
                $ledger[$k]['subtotalDebit'] = $total_debit + $ledger[$k]['debit'];
                $total_debit = $ledger[$k]['subtotalDebit'];
                $ledger[$k]['subtotalCredit'] = $total_credit + $ledger[$k]['credit'];
                $total_credit = $ledger[$k]['subtotalCredit'];
                $ledger[$k]['subtotalBalance'] = $total_balance + $ledger[$k]['balance'];
                $total_balance = $ledger[$k]['subtotalBalance'];
            }
        }

        $data = array(
            'title' => display('person_ledger'),
            'person_details' => $person_details,
            'person_details_all' => $person_details_all,
            'person_id' => $person_details[0]['person_id'],
            'person_name' => $person_details[0]['person_name'],
            'person_phone' => $person_details[0]['person_phone'],
            'person_address' => $person_details[0]['person_address'],
            'ledger' => $ledger,
            'subtotalDebit' => $total_debit,
            'subtotalCredit' => $total_credit,
            'subtotalBalance' => $total_balance,

        );
//        $data['module'] = "hrm";
//        $data['page'] = "office_loan/person_ledger";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/office_loan/person_ledger', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function bdtask_add_office_loan()
    {
        $data['title'] = display('add_office_loan');
        $data['person_list'] = $this->loan_model->office_loan_persons();
//        $data['module'] = "hrm";
//        $data['page'] = "office_loan/add_office_loan";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/office_loan/add_office_loan', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }


    public function bdtask_insert_office_loan()
    {
        $personid = $this->input->post('person_id', TRUE);
        $personinfo = $this->db->select('person_name')->from('person_information')->where('person_id', $personid)->get()->row();
        $headname = $personid . '-' . $personinfo->person_name;
        $headcid = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName', $headname)->get()->row()->HeadCode;
        $transaction_id = $this->occational->generator(10);

        $bank_id = $this->input->post('bank_id', TRUE);
        if (!empty($bank_id)) {
            $bankname = $this->db->select('bank_name')->from('bank_list')->where('bank_id', $bank_id)->get()->row()->bank_name;

            $bankcoaid = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName', $bankname)->get()->row()->HeadCode;
        } else {
            $bankcoaid = '';
        }

        $data = array(
            'transaction_id' => $transaction_id,
            'person_id' => $this->input->post('person_id', TRUE),
            'debit' => $this->input->post('ammount', TRUE),
            'date' => $this->input->post('date', TRUE),
            'details' => $this->input->post('details', TRUE),
            'status' => 1
        );
        $loan = array(
            'VNo' => $transaction_id,
            'Vtype' => 'LNR',
            'VDate' => $this->input->post('date', TRUE),
            'COAID' => $headcid,
            'Narration' => 'Loan for .' . $personinfo->person_name,
            'Debit' => $this->input->post('ammount', TRUE),
            'Credit' => 0,
            'IsPosted' => 1,
            'CreateBy' => $this->session->userdata('id'),
            'CreateDate' => date('Y-m-d H:i:s'),
            'IsAppove' => 1
        );
        $cc = array(
            'VNo' => $transaction_id,
            'Vtype' => 'LNR',
            'VDate' => $this->input->post('date', TRUE),
            'COAID' => 111000002,
            'Narration' => 'Cash in Hand Credit For ' . $personinfo->person_name,
            'Debit' => 0,
            'Credit' => $this->input->post('ammount', TRUE),
            'IsPosted' => 1,
            'CreateBy' => $this->session->userdata('id'),
            'CreateDate' => date('Y-m-d H:i:s'),
            'IsAppove' => 1
        );

        // bank ledger
        $bankc = array(
            'VNo' => $transaction_id,
            'Vtype' => 'LNR',
            'VDate' => $this->input->post('date', TRUE),
            'COAID' => $bankcoaid,
            'Narration' => 'Loan for .' . $personinfo->person_name,
            'Debit' => 0,
            'Credit' => $this->input->post('ammount', TRUE),
            'IsPosted' => 1,
            'CreateBy' => $this->session->userdata('id'),
            'CreateDate' => date('Y-m-d H:i:s'),
            'IsAppove' => 1
        );


        $result = $this->loan_model->submit_payment($data);
        if ($result) {
            $this->db->insert('acc_transaction', $loan);
            if ($this->input->post('paytype', TRUE) == 2) {
                $this->db->insert('acc_transaction', $bankc);

            }
            if ($this->input->post('paytype', TRUE) == 1) {
                $this->db->insert('acc_transaction', $cc);
            }
            $this->session->set_flashdata(array('message' => display('successfully_added')));
            redirect('hrm/loan/bdtask_add_office_loan');
        } else {
            $this->session->set_flashdata(array('exception' => display('not_added')));
            redirect('hrm/loan/bdtask_add_office_loan');
        }
    }


    public function bdtask_add_office_loan_payment()
    {
        $data['title'] = display('add_payment');
        $data['person_list'] = $this->loan_model->office_loan_persons();
//        $data['module'] = "hrm";
//        $data['page'] = "office_loan/add_officeloan_payment";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/office_loan/add_officeloan_payment', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }


    public function bdtask_submit_payment()
    {
        $personid = $this->input->post('person_id', TRUE);
        $personinfo = $this->db->select('person_name')->from('person_information')->where('person_id', $personid)->get()->row();
        $headname = $personid . '-' . $personinfo->person_name;
        $headcid = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName', $headname)->get()->row()->HeadCode;
        $transaction_id = $this->occational->generator(10);

        $bank_id = $this->input->post('bank_id', TRUE);
        if (!empty($bank_id)) {
            $bankname = $this->db->select('bank_name')->from('bank_list')->where('bank_id', $bank_id)->get()->row()->bank_name;

            $bankcoaid = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName', $bankname)->get()->row()->HeadCode;
        } else {
            $bankcoaid = '';
        }

        $data = array(
            'transaction_id' => $transaction_id,
            'person_id' => $this->input->post('person_id', TRUE),
            'credit' => $this->input->post('ammount', TRUE),
            'date' => $this->input->post('date', TRUE),
            'details' => $this->input->post('details', TRUE),
            'status' => 2
        );
        $paidloan = array(
            'VNo' => $transaction_id,
            'Vtype' => 'LNP',
            'VDate' => $this->input->post('date', TRUE),
            'COAID' => $headcid,
            'Narration' => 'Loan Payment from .' . $personinfo->person_name,
            'Debit' => 0,
            'Credit' => $this->input->post('ammount', TRUE),
            'IsPosted' => 1,
            'CreateBy' => $this->session->userdata('id'),
            'CreateDate' => date('Y-m-d H:i:s'),
            'IsAppove' => 1
        );
        $cc = array(
            'VNo' => $transaction_id,
            'Vtype' => 'LNR',
            'VDate' => $this->input->post('date', TRUE),
            'COAID' => 111000002,
            'Narration' => 'Cash in Hand Debit For ' . $personinfo->person_name,
            'Debit' => $this->input->post('ammount', TRUE),
            'Credit' => 0,
            'IsPosted' => 1,
            'CreateBy' => $this->session->userdata('id'),
            'CreateDate' => date('Y-m-d H:i:s'),
            'IsAppove' => 1
        );


        // bank ledger
        $bankc = array(
            'VNo' => $transaction_id,
            'Vtype' => 'LNR',
            'VDate' => $this->input->post('date', TRUE),
            'COAID' => $bankcoaid,
            'Narration' => 'Loan for .' . $personinfo->person_name,
            'Debit' => $this->input->post('ammount', TRUE),
            'Credit' => 0,
            'IsPosted' => 1,
            'CreateBy' => $this->session->userdata('id'),
            'CreateDate' => date('Y-m-d H:i:s'),
            'IsAppove' => 1
        );


        $result = $this->loan_model->submit_payment($data);
        if ($result) {
            $this->db->insert('acc_transaction', $paidloan);
            if ($this->input->post('paytype', TRUE) == 2) {
                $this->db->insert('acc_transaction', $bankc);

            }
            if ($this->input->post('paytype', TRUE) == 1) {
                $this->db->insert('acc_transaction', $cc);
            }
            $this->session->set_flashdata(array('message' => display('successfully_added')));
            redirect('hrm/loan/bdtask_add_office_loan_payment');
        } else {
            $this->session->set_flashdata(array('exception' => display('not_added')));
            redirect('hrm/loan/bdtask_add_office_loan_payment');
        }
    }

    public function bdtask_edit_office_person($person_id)
    {
        $person_list = $this->loan_model->select_person_by_id($person_id);
        $data = array(
            'title' => display('personal_edit'),
            'person_id' => $person_list[0]['person_id'],
            'person_name' => $person_list[0]['person_name'],
            'person_phone' => $person_list[0]['person_phone'],
            'person_address' => $person_list[0]['person_address'],
        );

//        $data['module'] = "hrm";
//        $data['page'] = "office_loan/person_edit";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/office_loan/person_edit', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }


    public function update_person($person_id)
    {
        $data = array(
            'person_name' => $this->input->post('name', TRUE),
            'person_phone' => $this->input->post('phone', TRUE),
            'person_address' => $this->input->post('address', TRUE),
            'status' => 1
        );
        $result = $this->loan_model->update_person($data, $person_id);
        if ($result) {
            $this->session->set_flashdata(array('message' => display('successfully_updated')));
            redirect('hrm/loan/manage_ofln_person');
        } else {
            $this->session->set_flashdata(array('exception' => display('not_added')));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete_office_loan($id = null)
    {
        if ($this->loan_model->delete_office_loan($id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect($_SERVER['HTTP_REFERER']);
    }


    /*personal loan part start*/
    public function bdtask_add_person()
    {
        $data['title'] = display('add_person');
//        $data['module'] = "hrm";
//        $data['page'] = "personal_loan/add_person";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/personal_loan/add_person', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }


    public function bdtask_submit_person()
    {
        $person_id = $this->occational->generator(10);
        $data = array(
            'person_id' => $person_id,
            'person_name' => $this->input->post('name', TRUE),
            'person_phone' => $this->input->post('phone', TRUE),
            'person_address' => $this->input->post('address', TRUE),
            'status' => 1
        );

        $result = $this->loan_model->submit_person_personal_loan($data);
        if ($result) {

            $this->session->set_flashdata(array('message' => display('successfully_added')));
            redirect('hrm/loan/manage_person');
        } else {
            $this->session->set_flashdata(array('exception' => display('not_added')));
            redirect('hrm/loan/manage_person');
        }
    }


    public function manage_person()
    {
        $data['title'] = display('manage_person');
        $config["base_url"] = base_url('manage_person/');
        $config["total_rows"] = $this->loan_model->person_list_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 2;
        $config["num_links"] = 5;
        /* This Application Must Be Used With BootStrap 3 * */
        $config['full_tag_open'] = "<ul class='pagination'>";
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
        $data['person_list'] = $this->loan_model->person_list_limt_loan($config["per_page"], $page);
//        $data['module'] = "hrm";
//        $data['page'] = "personal_loan/pesonal_loan_manage";
//        echo Modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/personal_loan/pesonal_loan_manage', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function bdtask_personal_ledger($person_id)
    {

        $person_details_all = $this->loan_model->person_list_personal_loan();
        $person_details = $this->loan_model->select_loan_person_by_id($person_id);
        $ledger = $this->loan_model->personal_loan_tradational($person_id);
        $balance = 0;
        $total_credit = 0;
        $total_debit = 0;
        $total_balance = 0;

        if (!empty($ledger)) {
            foreach ($ledger as $k => $v) {
                $ledger[$k]['balance'] = ($ledger[$k]['debit'] - $ledger[$k]['credit']) + $balance;
                $balance = $ledger[$k]['balance'];
                $ledger[$k]['date'] = $this->occational->dateConvert($ledger[$k]['date']);
                $ledger[$k]['subtotalDebit'] = $total_debit + $ledger[$k]['debit'];
                $total_debit = $ledger[$k]['subtotalDebit'];
                $ledger[$k]['subtotalCredit'] = $total_credit + $ledger[$k]['credit'];
                $total_credit = $ledger[$k]['subtotalCredit'];
                $ledger[$k]['subtotalBalance'] = $ledger[$k]['subtotalDebit'] - $ledger[$k]['subtotalCredit'];
                $total_balance = $ledger[$k]['subtotalBalance'];
            }
        }

        $data = array(
            'title' => display('person_ledger'),
            'person_details_all' => $person_details_all,
            'person_details' => $person_details,
            'person_id' => $person_details[0]['person_id'],
            'person_name' => $person_details[0]['person_name'],
            'person_phone' => $person_details[0]['person_phone'],
            'person_address' => $person_details[0]['person_address'],
            'ledger' => $ledger,
            'subtotalDebit' => number_format($total_debit, 2, '.', ','),
            'subtotalCredit' => number_format($total_credit, 2, '.', ','),
            'subtotalBalance' => number_format($total_balance, 2, '.', ','),
            'links' => '',
        );
//        $data['module'] = "hrm";
//        $data['page'] = "personal_loan/person_loan_summary";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/personal_loan/person_loan_summary', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }


    //Person loan search by phone number
    public function loan_phone_search_by_name()
    {
        $person_id = $this->input->post('person_id', TRUE);
        $result = $this->db->select('person_phone')
            ->from('pesonal_loan_information')
            ->where('person_id', $person_id)
            ->get()
            ->row();
        if ($result) {
            echo $result->person_phone;
        } else {
            return false;
        }
    }


    public function bdtask_personal_loan_summary()
    {

        $today = date('Y-m-d');
        $person_id = $this->input->post('person_id', TRUE) ? $this->input->post('person_id', TRUE) : "";
        $from_date = $this->input->post('from_date', TRUE);
        $to_date = $this->input->post('to_date', TRUE) ? $this->input->post('to_date', TRUE) : $today;
        $person_details_all = $this->loan_model->person_list_personal_loan();
        $person_details = $this->loan_model->select_loan_person_by_id($person_id);
        $ledger = $this->loan_model->person_loan_search_by_date($person_id, $from_date, $to_date);
        $balance = 0;
        $total_credit = 0;
        $total_debit = 0;
        $total_balance = 0;

        if (!empty($ledger)) {
            foreach ($ledger as $k => $v) {
                $ledger[$k]['balance'] = ($ledger[$k]['debit'] - $ledger[$k]['credit']) + $balance;
                $balance = $ledger[$k]['balance'];
                $ledger[$k]['date'] = $this->occational->dateConvert($ledger[$k]['date']);
                $ledger[$k]['subtotalDebit'] = $total_debit + $ledger[$k]['debit'];
                $total_debit = $ledger[$k]['subtotalDebit'];
                $ledger[$k]['subtotalCredit'] = $total_credit + $ledger[$k]['credit'];
                $total_credit = $ledger[$k]['subtotalCredit'];
                $ledger[$k]['subtotalBalance'] = $total_balance + $ledger[$k]['balance'];
                $total_balance = $ledger[$k]['subtotalBalance'];
            }
        }
        $data = array(
            'title' => display('person_ledger'),
            'person_details' => $person_details,
            'person_details_all' => $person_details_all,
            'person_id' => $person_details[0]['person_id'],
            'person_name' => $person_details[0]['person_name'],
            'person_phone' => $person_details[0]['person_phone'],
            'person_address' => $person_details[0]['person_address'],
            'ledger' => $ledger,
            'subtotalDebit' => $total_debit,
            'subtotalCredit' => $total_credit,
            'subtotalBalance' => $total_balance,
            'links' => '',
        );
//        $data['module'] = "hrm";
//        $data['page'] = "personal_loan/person_loan_summary";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/personal_loan/person_loan_summary', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }


    public function bdtask_add_loan()
    {
        $data['title'] = display('add_loan');
        $data['person_list'] = $this->loan_model->person_list_personal_loan();
//        $data['module'] = "hrm";
//        $data['page'] = "personal_loan/add_loan";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/personal_loan/add_loan', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }


    public function bdtask_submit_loan()
    {
        $transaction_id = $this->occational->generator(10);
        $data = array(
            'transaction_id' => $transaction_id,
            'person_id' => $this->input->post('person_id', TRUE),
            'debit' => $this->input->post('ammount', TRUE),
            'date' => $this->input->post('date', TRUE),
            'details' => $this->input->post('details', TRUE),
            'status' => 1
        );


        $result = $this->loan_model->submit_loan_personal($data);
        if ($result) {

            $this->session->set_flashdata(array('message' => display('successfully_added')));
            redirect('hrm/loan/bdtask_add_loan');
        } else {
            $this->session->set_flashdata(array('exception' => display('not_added')));
            redirect('hrm/loan/bdtask_add_loan');
        }
    }

    public function bdtask_add_payment()
    {
        $data['title'] = display('add_payment');
        $data['person_list'] = $this->loan_model->person_list_personal_loan();
//        $data['module'] = "hrm";
//        $data['page'] = "personal_loan/add_payment";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/personal_loan/add_payment', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }


    public function bdtask_submit_personal_payment()
    {
        $transaction_id = $this->occational->generator(10);
        $data = array(
            'transaction_id' => $transaction_id,
            'person_id' => $this->input->post('person_id', TRUE),
            'credit' => $this->input->post('ammount', TRUE),
            'date' => $this->input->post('date', TRUE),
            'details' => $this->input->post('details', TRUE),
            'status' => 2
        );

        $result = $this->loan_model->submit_payment_per_loan($data);
        if ($result) {
            $this->session->set_flashdata(array('message' => display('successfully_added')));
            redirect('hrm/loan/bdtask_add_payment');
        } else {
            $this->session->set_flashdata(array('exception' => display('not_added')));
            redirect('hrm/loan/bdtask_add_payment');
        }
    }

    public function edit_person_loan($person_id)
    {
        $person_list = $this->loan_model->select_loan_person_by_id($person_id);
        $data = array(
            'title' => display('personal_edit'),
            'person_id' => $person_list[0]['person_id'],
            'person_name' => $person_list[0]['person_name'],
            'person_phone' => $person_list[0]['person_phone'],
            'person_address' => $person_list[0]['person_address'],
        );
//        $data['module'] = "hrm";
//        $data['page'] = "personal_loan/person_loan_edit";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/personal_loan/person_loan_edit', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function update_person_personalloan($person_id)
    {
        $data = array(
            'person_name' => $this->input->post('name', TRUE),
            'person_phone' => $this->input->post('phone', TRUE),
            'person_address' => $this->input->post('address', TRUE),
            'status' => 1
        );
        $result = $this->loan_model->update_person_personal($data, $person_id);
        if ($result) {
            $this->session->set_flashdata(array('message' => display('successfully_updated')));
            redirect('hrm/loan/manage_person');
        } else {
            $this->session->set_flashdata(array('exception' => display('not_added')));
            redirect('hrm/loan/manage_person');
        }
    }


    public function delete_personal_loan($id = null)
    {
        if ($this->loan_model->delete_personal_loan($id)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

}

