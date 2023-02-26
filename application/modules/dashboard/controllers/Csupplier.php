<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Csupplier extends MX_Controller
{

    public $supplier_id;

    function __construct()
    {
        parent::__construct();
        $this->load->library('auth'); 
        $this->load->library('dashboard/lsupplier');
        $this->load->library('session');
        $this->load->model('dashboard/Suppliers');
        $this->auth->check_user_auth();
    }

    public function index()
    {
        $this->permission->check_label('add_supplier')->create()->redirect();

        $content = $this->lsupplier->supplier_add_form();
        $this->template_lib->full_admin_html_view($content);
    }

    //Supplier Search Item
    public function supplier_search_item()
    {
        $supplier_id = $this->input->post('supplier_id', TRUE);
        $content = $this->lsupplier->supplier_search_item($supplier_id);

        $this->template_lib->full_admin_html_view($content);
    }

    //Product Add Form
    public function manage_supplier()
    {
        $this->permission->check_label('manage_supplier')->read()->redirect();
        $content = $this->lsupplier->supplier_list();
        $this->template_lib->full_admin_html_view($content);
    }

    //Insert Product and uload
    public function insert_supplier()
    {
        $this->permission->check_label('add_supplier')->create()->redirect();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('supplier_name', display('supplier_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('address', display('address'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('mobile', display('mobile'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->session->set_userdata(array('error_message' => 'fields_must_not_be_empty'));
            $this->index();
        } else {

            $supplier_id = $this->auth->generator(20);
            $data = array(
                'supplier_id'  => $supplier_id,
                'supplier_name' => $this->input->post('supplier_name', TRUE),
                'address'      => $this->input->post('address', TRUE),
                'email'        => $this->input->post('email', TRUE),
                'vat_no'       => $this->input->post('vat_no', TRUE),
                'cr_no'        => $this->input->post('cr_no', TRUE),
                'mobile'       => $this->input->post('mobile', TRUE),
                'details'      => $this->input->post('details', TRUE),
                'previous_balance' => $this->input->post('previous_balance', TRUE),
                'status'       => 1
            );
            $supplier = $this->Suppliers->supplier_entry($data);
        }
        if ($supplier == TRUE) {
            $this->session->set_userdata(array('message' => display('successfully_added')));
            if (isset($_POST['add-supplier'])) {
                redirect(base_url('dashboard/Csupplier/manage_supplier'));
                exit;
            } elseif (isset($_POST['add-supplier-another'])) {
                redirect(base_url('dashboard/Csupplier'));
                exit;
            }
        } else {
            $this->session->set_userdata(array('error_message' => display('already_exists')));
            if (isset($_POST['add-supplier'])) {
                redirect(base_url('dashboard/Csupplier/manage_supplier'));
                exit;
            } elseif (isset($_POST['add-supplier-another'])) {
                redirect(base_url('dashboard/Csupplier'));
                exit;
            }
        }
    }

    //Supplier Update Form
    public function supplier_update_form($supplier_id)
    {
        $this->permission->check_label('manage_supplier')->update()->redirect();
        $content = $this->lsupplier->supplier_edit_data($supplier_id);
        $this->template_lib->full_admin_html_view($content);
    }

    // Supplier Update
    public function supplier_update()
    {
        $this->permission->check_label('manage_supplier')->update()->redirect();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('supplier_name', display('supplier_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('address', display('address'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('mobile', display('mobile'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->session->set_userdata(array('error_message' => 'fields_must_not_be_empty'));
            $supplier_id = $this->input->post('supplier_id', TRUE);
            $this->supplier_update_form($supplier_id);
        } else {
            $supplier_id = $this->input->post('supplier_id', TRUE);
            $data = array(
                'supplier_name' => $this->input->post('supplier_name', TRUE),
                'address'      => $this->input->post('address', TRUE),
                'email'        => $this->input->post('email', TRUE),
                'vat_no'       => $this->input->post('vat_no', TRUE),
                'cr_no'        => $this->input->post('cr_no', TRUE),
                'mobile'       => $this->input->post('mobile', TRUE),
                'details'      => $this->input->post('details', TRUE)
            );
            $this->Suppliers->update_supplier($data, $supplier_id);
            $this->session->set_userdata(array('message' => display('successfully_updated')));
            redirect(base_url('dashboard/Csupplier/manage_supplier'));
            exit;
        }
    }

    // Supplier Delete from System
    public function supplier_delete($supplier_id)
    {
        $this->permission->check_label('manage_supplier')->delete()->redirect();

        $result = $this->Suppliers->delete_supplier($supplier_id);
        if ($result) {
            $this->session->set_userdata(array('message' => display('successfully_delete')));
            redirect(base_url('dashboard/Csupplier/manage_supplier'));
        }
    }

    // Supplier details findings
    public function supplier_details($supplier_id)
    {
        $this->permission->check_label('manage_supplier')->read()->redirect();

        $content = $this->lsupplier->supplier_detail_data($supplier_id);
        $this->supplier_id = $supplier_id;
        $this->template_lib->full_admin_html_view($content);
    }

    public function supplier_ledger($supplier_id)
    {
        $this->supplier_id = $supplier_id;
        $content = $this->lsupplier->supplier_ledger_report($supplier_id, null, null);
        $this->template_lib->full_admin_html_view($content);
    }

    //Supplier Ledger Report
    public function supplier_ledger_report()
    {
        $this->permission->check_label('supplier_ledger')->read()->redirect();

        $supplier_id = $this->input->post('supplier_id', TRUE);
        $from_date  = $this->input->post('from_date', TRUE);
        $to_date    = $this->input->post('to_date', TRUE);
        $this->supplier_id = $supplier_id;
        $content = $this->lsupplier->supplier_ledger_report($supplier_id, $from_date, $to_date);
        $this->template_lib->full_admin_html_view($content);
    }

     //Supplier Ledger Report print
     public function supplier_ledger_report_print()
     {
         $this->permission->check_label('supplier_ledger')->read()->redirect();
 
         $supplier_id = $this->input->post('supplier_id', TRUE);
         $from_date  = $this->input->post('from_date', TRUE);
         $to_date    = $this->input->post('to_date', TRUE);
         $this->supplier_id = $supplier_id;
         $content = $this->lsupplier->supplier_ledger_report($supplier_id, $from_date, $to_date, true);
         $this->template_lib->full_admin_html_view($content);
     }

    // Supplier wise sales report details
    public function supplier_sales_details($supplier_id)
    {

        $content = $this->lsupplier->supplier_sales_details($supplier_id);
        $this->supplier_id = $supplier_id;
        $this->template_lib->full_admin_html_view($content);
    }

    // Supplier wise sales report summary
    public function supplier_sales_summary($supplier_id)
    {
        $content = $this->lsupplier->supplier_sales_summary($supplier_id);
        $this->supplier_id = $supplier_id;
        $this->template_lib->full_admin_html_view($content);
    }

    // Actual Ledger based on sales & deposited amount
    public function sales_payment_actual($supplier_id)
    {

        $limit = 300;
        $start_record = 0;
        $links = "";
        $content = $this->lsupplier->sales_payment_actual($supplier_id, $limit, $start_record, $links);
        $this->supplier_id = $supplier_id;
        $this->template_lib->full_admin_html_view($content);
    }

    public function supplier_balance_report()
    {
        $this->permission->check_label('supplier_balance_report')->read()->redirect();

        $from_date  = $this->input->post('from_date', TRUE);
        $to_date    = $this->input->post('to_date', TRUE);
        $content = $this->lsupplier->supplier_balance_report($from_date, $to_date);
        $this->template_lib->full_admin_html_view($content);
    }
}