<?php
defined('BASEPATH') or exit('No direct script access allowed');
#------------------------------------
# Author: Bdtask Ltd
# Author link: https://www.bdtask.com/
# Dynamic style php file
# Developed by :Isahaq
#------------------------------------

class Expense extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->check_user_auth();
        $this->load->model(array('expense_model', 'dashboard/Settings'));
    }


    public function bdtask_expense_item_list()
    {
        $data['title'] = display('manage_expense_item');
        $data['expense_item_list'] = $this->expense_model->expense_item_list();
//        $data['module']            = "hrm";
//        $data['page']              = "expense/manage_expense_item";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/expense/manage_expense_item', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }


    public function bdtask_expense_item_form($id = null)
    {
        $data['title'] = display('add_expense_item');
        #-------------------------------#
        $this->form_validation->set_rules('expense_item_name', display('expense_item_name'), 'required|max_length[200]');

        #-------------------------------#
        $data['items'] = (object)$postData = [
            'id' => $id,
            'expense_item_name' => $this->input->post('expense_item_name', true),
        ];
        #-------------------------------#
        if ($this->form_validation->run() === true) {

            if (empty($id)) {
                if ($this->expense_model->create_expense_item($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect("hrm/expense/bdtask_expense_item_list");
            } else {
                if ($this->expense_model->update_expense_item($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect("hrm/expense/bdtask_expense_item_list");
            }
        } else {
            if (!empty($id)) {
                $data['title'] = display('item_update_form');
                $data['items'] = $this->expense_model->single_expense_item_data($id);
            }
            $data['module'] = "hrm";
            $data['page'] = "expense/item_form";
            echo Modules::run('template/layout', $data);
//            $content = $this->parser->parse('hrm/expense/item_form', $data, true);
//            $this->template_lib->full_admin_html_view($content);
        }
    }


    public function delete_expense_item($id = null)
    {
        if ($this->expense_model->expense_item_delete($id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect("hrm/expense/bdtask_expense_item_list");
    }


    public function bdtask_add_expense()
    {
        $data['title'] = display('add_expense');
        $data['expense_item'] = $this->expense_model->expense_item_list();
        $data['bank_list'] = $this->Settings->get_bank_list();
//        $data['module'] = "hrm";
//        $data['page'] = "expense/expense_form";
//        echo Modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/expense/expense_form', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }


    public function bdtask_create_expense()
    {
        $this->form_validation->set_rules('amount', display('amount'), 'max_length[100]');
        if ($this->form_validation->run()) {
            if ($this->expense_model->expense_insert()) {
                $this->session->set_flashdata('message', display('save_successfully'));
                redirect('hrm/expense/manage_expense');
            } else {
                $this->session->set_flashdata('exception', display('please_try_again'));
            }
            redirect("hrm/expense/bdtask_add_expense");
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
            redirect("hrm/expense/bdtask_add_expense");
        }

    }


    public function manage_expense()
    {
        $data['title'] = display('manage_expense');
        $config["base_url"] = base_url('manage_expense');
        $config["total_rows"] = $this->db->count_all('expense');
        $config["per_page"] = 10;
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
        $data['expense_list'] = $this->expense_model->expense_list($config["per_page"], $page);
//        $data['module'] = "hrm";
//        $data['page'] = "expense/manage_expense";
//        echo Modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/expense/manage_expense', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }


    public function delete_expense($id = null)
    {
        if ($this->expense_model->expense_delete($id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect("hrm/expense/manage_expense");
    }


    public function expense_statement()
    {
        $expense_id = (!empty($this->input->get('expense_item')) ? $this->input->get('expense_item') : '');
        $from_date = (!empty($this->input->get('from_date')) ? $this->input->get('from_date') : date('Y-m-d'));
        $to_date = (!empty($this->input->get('to_date')) ? $this->input->get('to_date') : date('Y-m-d'));
        $customer_statement = $this->expense_model->get_expense_statement($expense_id, $from_date, $to_date);
        $expense_item = $this->expense_model->expense_item_list();
        $data = array(
            'item_list' => $expense_item,
            'expense_statement' => $customer_statement,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'expense_id' => $expense_id,
        );
        $data['title'] = display('expense_statement');
//        $data['module'] = "hrm";
//        $data['page'] = "expense/expense_statement";
//        echo Modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/expense/expense_statement', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

}

