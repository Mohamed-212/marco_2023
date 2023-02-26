<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Store_invoice extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('lstore_invoice');
        $this->load->library('occational');
        $this->load->model([
            'dashboard/Store_invoices',
            'dashboard/Invoices',
            'dashboard/Stores',
            'dashboard/Variants',
            'dashboard/Customers',
            'dashboard/Shipping_methods',
            'dashboard/Reports',
            'dashboard/Soft_settings',
            'dashboard/Products',
            'web/Homes',
            'template/Template_model',

        ]);

        $this->auth->check_store_auth();
    }

    //Default invoice add from loading
    public function index()
    {
        $store_list = $this->Stores->store_list();
        $variant_list = $this->Variants->variant_list();
        $shipping_methods = $this->Shipping_methods->shipping_method_list();


        $customer = $this->Customers->customer_list();

        $data = array(
            'title' => display('new_invoice'),
            'store_list' => $store_list,
            'variant_list' => $variant_list,
            'customer' => $customer[0],
            'shipping_methods' => $shipping_methods
        );

        $data['setting'] = $this->Template_model->setting();
        $data['module'] = "dashboard";
        $data['page'] = 'invoice/add_invoice_form';
        $this->parser->parse('template/layout', $data);
    }

    //Add new invoice
    public function new_invoice()
    {

        $store_list = $this->Stores->store_list();
        $variant_list = $this->Variants->variant_list();
        $shipping_methods = $this->Shipping_methods->shipping_method_list();


        $customer = $this->Customers->customer_list();
        $store_id   = $this->session->userdata('store_id');

        $data = array(
            'title' => display('new_invoice'),
            'store_list' => $store_list,
            'variant_list' => $variant_list,
            'customer' => $customer[0],
            'shipping_methods' => $shipping_methods,
            'store_id' => $store_id
        );


        $data['setting'] = $this->Template_model->setting();
        $data['module'] = "dashboard";
        $data['page'] = 'invoice/add_invoice_form';
        $this->parser->parse('template/layout', $data);
    }

    //Insert new invoice
    public function insert_invoice()
    {
        $invoice_id = $this->Store_invoices->invoice_entry();
        $this->session->set_userdata(array('message' => display('successfully_added')));
        $this->invoice_inserted_data($invoice_id);
    }

    //Manage invoice
    public function manage_invoice()
    {

        $store_invoices_list = $this->Store_invoices->invoice_list();

        if (!empty($store_invoices_list)) {
            foreach ($store_invoices_list as $k => $v) {
                $store_invoices_list[$k]['final_date'] = $this->occational->dateConvert($store_invoices_list[$k]['date']);
            }
            $i = 0;
            foreach ($store_invoices_list as $k => $v) {
                $i++;
                $store_invoices_list[$k]['sl'] = $i;
            }
        }
        $currency_details = $this->Soft_settings->retrieve_currency_info();
        $data = array(
            'title' => display('manage_invoice'),
            'store_invoices_list' => $store_invoices_list,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );

        $data['setting'] = $this->Template_model->setting();
        $data['module'] = "dashboard";
        $data['page'] = 'store_invoice/invoice';
        $this->parser->parse('template/layout', $data);
    }

    //Invoice Update Form
    public function invoice_update_form($invoice_id)
    {
        $invoice_detail = $this->Store_invoices->retrieve_invoice_editdata($invoice_id);

        $store_id = $invoice_detail[0]['store_id'];
        $store_list = $this->Stores->store_list();
        $store_list_selected = $this->Stores->store_list_selected($store_id);
        $terminal_list = $this->Store_invoices->terminal_list();

        $i = 0;
        foreach ($invoice_detail as $k => $v) {
            $i++;
            $invoice_detail[$k]['sl'] = $i;
        }

        $data = array(
            'title' => display('invoice_edit'),
            'invoice_id' => $invoice_detail[0]['invoice_id'],
            'customer_id' => $invoice_detail[0]['customer_id'],
            'store_id' => $invoice_detail[0]['store_id'],
            'invoice' => $invoice_detail[0]['invoice'],
            'customer_name' => $invoice_detail[0]['customer_name'],
            'date' => $invoice_detail[0]['date'],
            'total_amount' => $invoice_detail[0]['total_amount'],
            'paid_amount' => $invoice_detail[0]['paid_amount'],
            'due_amount' => $invoice_detail[0]['due_amount'],
            'total_discount' => $invoice_detail[0]['total_discount'],
            'invoice_discount' => $invoice_detail[0]['invoice_discount'],
            'service_charge' => $invoice_detail[0]['service_charge'],
            'invoice_details' => $invoice_detail[0]['invoice_details'],
            'invoice_status' => $invoice_detail[0]['invoice_status'],
            'invoice_all_data' => $invoice_detail,
            'store_list' => $store_list,
            'store_list_selected' => $store_list_selected,
            'terminal_list' => $terminal_list,
        );


        $data['setting'] = $this->Template_model->setting();
        $data['module'] = "dashboard";
        $data['page'] = 'store_invoice/edit_invoice_form';
        $this->parser->parse('template/layout', $data);
    }

    // Invoice Update
    public function invoice_update()
    {

        $invoice_id = $this->Store_invoices->update_invoice();
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        $this->invoice_inserted_data($invoice_id);
    }

    //Retrive right now inserted data to cretae html
    public function invoice_inserted_data($invoice_id)
    {

        $invoice_detail = $this->Store_invoices->retrieve_invoice_html_data($invoice_id);

        $subTotal_quantity = 0;
        $subTotal_cartoon = 0;
        $subTotal_discount = 0;

        if (!empty($invoice_detail)) {
            foreach ($invoice_detail as $k => $v) {
                $invoice_detail[$k]['final_date'] = $this->occational->dateConvert($invoice_detail[$k]['date']);
                $subTotal_quantity = $subTotal_quantity + $invoice_detail[$k]['quantity'];
            }
            $i = 0;
            foreach ($invoice_detail as $k => $v) {
                $i++;
                $invoice_detail[$k]['sl'] = $i;
            }
        }

        $currency_details = $this->Soft_settings->retrieve_currency_info();
        $company_info = $this->Store_invoices->retrieve_company();

        $data = array(
            'title' => display('invoice_details'),
            'invoice_id' => $invoice_detail[0]['invoice_id'],
            'invoice_no' => $invoice_detail[0]['invoice'],
            'customer_name' => $invoice_detail[0]['customer_name'],
            'customer_mobile' => $invoice_detail[0]['customer_mobile'],
            'customer_email' => $invoice_detail[0]['customer_email'],
            'customer_address' => $invoice_detail[0]['customer_address_1'],
            'final_date' => $invoice_detail[0]['final_date'],
            'total_amount' => $invoice_detail[0]['total_amount'],
            'invoice_discount' => $invoice_detail[0]['invoice_discount'],
            'service_charge' => $invoice_detail[0]['service_charge'],
            'paid_amount' => $invoice_detail[0]['paid_amount'],
            'due_amount' => $invoice_detail[0]['due_amount'],
            'invoice_details' => $invoice_detail[0]['invoice_details'],
            'subTotal_quantity' => $subTotal_quantity,
            'invoice_all_data' => $invoice_detail,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );

        $data['setting'] = $this->Template_model->setting();
        $data['module'] = "dashboard";
        $data['page'] = 'store_invoice/invoice_html';
        $this->parser->parse('template/layout', $data);
    }

    //POS invoice page load
    public function pos_invoice()
    {

        $customer_details = $this->Invoices->pos_customer_setup();
        $category_list = $this->Invoices->category_list();
        $customer_list = $this->Invoices->customer_list();
        $store_list = $this->Invoices->store_list();
        $most_popular_product = $this->Invoices->pos_invoice_popular_product();
        $first20 = $this->Invoices->get_first20_product();
        $total_product = $this->db->count_all_results('product_information');

        $company_info = $this->Reports->retrieve_company();

        $data = array(
            'title'           => display('add_pos_invoice'),
            'sidebar_collapse' => 'sidebar-collapse',
            'product_list'    => (!empty($most_popular_product)) ? $most_popular_product : $first20,
            'total_product'   => $total_product,
            'category_list'   => $category_list,
            'customer_details' => $customer_details,
            'customer_list'   => $customer_list,
            'store_list'      => $store_list,
            'company_info'    => $company_info,
            'company_name'    => $company_info[0]['company_name'],
            'store_id'        => $this->session->userdata('store_id')
        );


        $data['setting'] = $this->Template_model->setting();
        $data['module'] = "dashboard";
        $data['page'] = 'store_invoice/add_pos_invoice_form';
        $this->parser->parse('template/layout', $data);
    }

    //Insert pos invoice
    public function insert_posInvoice()
    {
        $invoice_id = $this->Invoices->pos_invoice_entry();
        $this->session->set_userdata(array('message' => display('successfully_added')));
        redirect('dashboard/Cinvoice/pos_invoice_inserted_data_redirect/' . $invoice_id . '?place=pos');
    }

    //Insert new customer
    public function insert_customer()
    {
        $this->load->model('Store_invoices');

        $customer_id = $this->auth->generator(15);

        //Customer  basic information adding.
        $data = array(
            'customer_id' => $customer_id,
            'customer_name' => $this->input->post('customer_name', TRUE),
            'customer_mobile' => $this->input->post('mobile', TRUE),
            'customer_email' => $this->input->post('email', TRUE),
            'status' => 1
        );

        $result = $this->Store_invoices->customer_entry($data);

        if ($result == TRUE) {
            $this->session->set_userdata(array('message' => display('successfully_added')));
            redirect(base_url('dashboard/Store_invoice/pos_invoice'));
        } else {
            $this->session->set_userdata(array('error_message' => display('already_exists')));
            redirect(base_url('dashboard/Store_invoice/pos_invoice'));
        }
    }

    //Retrive right now inserted data to cretae html
    public function pos_invoice_inserted_data($invoice_id)
    {

        $invoice_detail = $this->Store_invoices->retrieve_invoice_html_data($invoice_id);

        $subTotal_quantity = 0;
        $subTotal_cartoon = 0;
        $subTotal_discount = 0;
        if (!empty($invoice_detail)) {
            foreach ($invoice_detail as $k => $v) {
                $invoice_detail[$k]['final_date'] = $this->occational->dateConvert($invoice_detail[$k]['date']);
                $subTotal_quantity = $subTotal_quantity + $invoice_detail[$k]['quantity'];
            }
            $i = 0;
            foreach ($invoice_detail as $k => $v) {
                $i++;
                $invoice_detail[$k]['sl'] = $i;
            }
        }

        $currency_details = $this->Soft_settings->retrieve_currency_info();
        $company_info = $this->Store_invoices->retrieve_company();
        $data = array(
            'title' => display('invoice_details'),
            'invoice_id' => $invoice_detail[0]['invoice_id'],
            'invoice_no' => $invoice_detail[0]['invoice'],
            'customer_name' => $invoice_detail[0]['customer_name'],
            'customer_address' => $invoice_detail[0]['customer_short_address'],
            'customer_mobile' => $invoice_detail[0]['customer_mobile'],
            'customer_email' => $invoice_detail[0]['customer_email'],
            'final_date' => $invoice_detail[0]['final_date'],
            'total_amount' => $invoice_detail[0]['total_amount'],
            'subTotal_discount' => $invoice_detail[0]['total_discount'],
            'service_charge' => $invoice_detail[0]['service_charge'],
            'paid_amount' => $invoice_detail[0]['paid_amount'],
            'due_amount' => $invoice_detail[0]['due_amount'],
            'invoice_details' => $invoice_detail[0]['invoice_details'],
            'subTotal_quantity' => $subTotal_quantity,
            'invoice_all_data' => $invoice_detail,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );


        $data['setting'] = $this->Template_model->setting();
        $data['module'] = "dashboard";
        $data['page'] = 'store_invoice/pos_invoice_html';
        $this->parser->parse('template/layout', $data);
    }

    // Retrieve product data
    public function retrieve_product_data()
    {
        $product_id = $this->input->post('product_id', TRUE);
        $product_info = $this->Store_invoices->get_total_product($product_id);
        echo json_encode($product_info);
    }

    //Stock report variant wise
    public function stock_report()
    {

        $today = date('Y-m-d');
        $from_date = $this->input->post('from_date', TRUE) ? $this->input->post('from_date', TRUE) : "";
        $to_date = $this->input->post('to_date', TRUE) ? $this->input->post('to_date') : "";
        $store_id = $this->session->userdata('store_id', TRUE);

        #
        #pagination starts
        #
        $config["base_url"] = base_url('Store_invoice/stock_report/');
        $config["total_rows"] = $this->Store_invoices->stock_report_variant_bydate_count($from_date, $to_date, $store_id);
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
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
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $links = $this->pagination->create_links();
        #
        #pagination ends
        #


        $stok_report = $this->Store_invoices->stock_report_variant_bydate($from_date, $to_date, $store_id, $config["per_page"], $page);
        $product_list = $this->Products->product_list();
        $store_list = $this->Stores->store_list();
        $sub_total_in = 0;
        $sub_total_out = 0;
        $sub_total_stock = 0;

        if (($stok_report)) {
            $i = $page;
            foreach ($stok_report as $k => $v) {
                $i++;
                $stok_report[$k]['sl'] = $i;
            }
            foreach ($stok_report as $k => $v) {
                $i++;

                $sales = $this->db->select("
						sum(quantity) as totalSalesQnty,
						quantity
					")
                    ->from('invoice_details')
                    ->where('product_id', $v['product_id'])
                    ->where('variant_id', $v['variant_id'])
                    ->where('store_id', $v['store_id'])
                    ->get()
                    ->row();

                $stok_report[$k]['stok_quantity'] = ($stok_report[$k]['totalPrhcsCtn'] - $sales->totalSalesQnty);
                $stok_report[$k]['SubTotalOut'] = ($sub_total_out + $sales->totalSalesQnty);
                $sub_total_out = $stok_report[$k]['SubTotalOut'];
                $stok_report[$k]['SubTotalIn'] = ($sub_total_in + $stok_report[$k]['totalPrhcsCtn']);
                $sub_total_in = $stok_report[$k]['SubTotalIn'];
                $stok_report[$k]['in_qnty'] = $stok_report[$k]['totalPrhcsCtn'];
                $stok_report[$k]['out_qnty'] = $sales->totalSalesQnty;
                $stok_report[$k]['SubTotalStock'] = ($sub_total_stock + $stok_report[$k]['stok_quantity']);
                $sub_total_stock = $stok_report[$k]['SubTotalStock'];
            }
        }

        $currency_details = $this->Soft_settings->retrieve_currency_info();
        $company_info = $this->Reports->retrieve_company();
        $data = array(
            'title' => display('stock_report_store_wise'),
            'stok_report' => $stok_report,
            'product_model' => @$stok_report[0]['product_model'],
            'links' => $links,
            'date' => '',
            'sub_total_in' => $sub_total_in,
            'sub_total_out' => $sub_total_out,
            'sub_total_stock' => $sub_total_stock,
            'product_list' => $product_list,
            'store_list' => $store_list,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );


        $data['setting'] = $this->Template_model->setting();
        $data['module'] = "dashboard";
        $data['page'] = 'store_invoice/stock_report_variant_wise';
        $this->parser->parse('template/layout', $data);
    }

    // Invoice Delete
    public function invoice_delete($invoice_id)
    {
        $result = $this->Store_invoices->delete_invoice($invoice_id);
        if ($result) {
            $this->session->set_userdata(array('message' => display('successfully_delete')));
            redirect('dashboard/Store_invoice/manage_invoice');
        }
    }

    //AJAX INVOICE STOCK Check
    public function product_stock_check($product_id)
    {

        $purchase_stocks = $this->Store_invoices->get_total_purchase_item($product_id);
        $total_purchase = 0;
        if (!empty($purchase_stocks)) {
            foreach ($purchase_stocks as $k => $v) {
                $total_purchase = ($total_purchase + $purchase_stocks[$k]['quantity']);
            }
        }
        $sales_stocks = $this->Store_invoices->get_total_sales_item($product_id);
        $total_sales = 0;
        if (!empty($sales_stocks)) {
            foreach ($sales_stocks as $k => $v) {
                $total_sales = ($total_sales + $sales_stocks[$k]['quantity']);
            }
        }

        $final_total = ($total_purchase - $total_sales);
        return $final_total;
    }

    //Search product by product name and category
    public function search_product()
    {
        $product_name = $this->input->post('product_name', TRUE);
        $category_id = $this->input->post('category_id', TRUE);
        $product_search = $this->Store_invoices->product_search($product_name, $category_id);
        if ($product_search) {
            foreach ($product_search as $product) {
                echo "<div class=\"col-xs-6 col-sm-4 col-md-2 col-p-3\">";
                echo "<div class=\"panel panel-bd product-panel select_product\">";
                echo "<div class=\"panel-body\">";
                echo "<img src=\"" . base_url() . $product->image_thumb . "\" class=\"img-responsive\" alt=\"\">";
                echo "<input type=\"hidden\" name=\"select_product_id\" class=\"select_product_id\" value='" . $product->product_id . "'>";
                echo "</div>";
                echo "<div class=\"panel-footer\">$product->product_name - ($product->product_model)</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "420";
        }
    }

    //Update status
    public function update_status($invoice_id)
    {


        $this->load->model('Invoices');
        $this->load->model('Soft_settings');

        //Update invoice status
        $this->db->set('invoice_status', $this->input->post('invoice_status', TRUE));
        $this->db->where('invoice_id', $invoice_id);
        $result = $this->db->update('invoice');

        if ($result == TRUE) {

            $setting_detail = $this->Soft_settings->retrieve_email_editdata();

            $subject = display("invoice_status");
            $message = $this->input->post('add_note', TRUE);

            $config = array(
                'protocol' => $setting_detail[0]['protocol'],
                'smtp_host' => $setting_detail[0]['smtp_host'],
                'smtp_port' => $setting_detail[0]['smtp_port'],
                'smtp_user' => $setting_detail[0]['sender_email'],
                'smtp_pass' => $setting_detail[0]['password'],
                'mailtype' => $setting_detail[0]['mailtype'],
                'charset' => 'utf-8'
            );

            $this->load->library('email');
            $this->email->initialize($config);

            $this->email->set_newline("\r\n");
            $this->email->from($setting_detail[0]['sender_email']);
            $this->email->to($this->input->post('customer_email', TRUE));
            $this->email->subject($subject);
            $this->email->message($message);

            $email = $this->test_input($this->input->post('customer_email', TRUE));
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if ($this->email->send()) {
                    $this->session->set_userdata(array('message' => display('email_send_to_customer')));
                    redirect(base_url('dashboard/Store_invoice/manage_invoice'));
                } else {
                    $this->session->set_userdata(array('error_message' => display('email_not_send')));
                    redirect(base_url('dashboard/Store_invoice/manage_invoice'));
                }
            } else {
                $this->session->set_userdata(array('message' => display('successfully_updated')));
                redirect(base_url('dashboard/Store_invoice/manage_invoice'));
            }
        } else {
            $this->session->set_userdata(array('error_message' => display('already_exists')));
            redirect(base_url('dashboard/Store_invoice/manage_invoice'));
        }
    }

    //Email testing for email
    public function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Search Inovoice Item
    public function search_inovoice_item()
    {
        $customer_id = $this->input->post('customer_id', TRUE);
        $content = $this->lstore_invoice->search_inovoice_item($customer_id);
        $this->template_lib->full_admin_html_view($content);
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
    // add new transfer request
    public function add_transfer_request()
    {

        $this->form_validation->set_rules('transfer_from', display('transfer_from'), 'trim|required');
        $this->form_validation->set_rules('product_name[]', display('product_name'), 'trim|required');
        $this->form_validation->set_rules('product_quantity[]', display('qnty'), 'trim|required');


        if ($this->form_validation->run() == TRUE) {

            $transfer_id1  = $this->auth->generator(15);
            $transfer_id2  = $this->auth->generator(15);
            $transfer_from     = $this->input->post('transfer_from', TRUE);
            $product_ids  = $this->input->post('product_id', TRUE);
            $variant_id   = $this->input->post('variant_id', TRUE);
            $variant_color = $this->input->post('color_variant', TRUE);
            $quantity     = $this->input->post('product_quantity', TRUE);
            $transfer_by  = $this->session->userdata('user_id');
            $t_store_id   = $this->session->userdata('store_id');
            $date_time    = date("m-d-Y");
            $status       = 1;

            $data1 = [];

            $transdata = array(
                'transfer_id' => $transfer_id1,
                'transfer_from' => $transfer_from,
                'transfer_to' => $t_store_id,
                'created_at' => date('Y-m-d h:i:s'),
                'transfer_by' => $transfer_by
            );
            foreach ($product_ids as $key => $product) {
                $data1[] = array(
                    'transfer_id'  => $transfer_id1,
                    'store_id'     => $transfer_from,
                    'product_id'   => $product,
                    'variant_id'   => $variant_id[$key],
                    'variant_color' => @$variant_color[$key],
                    'quantity'     => $quantity[$key],
                    'transfer_by'  => $transfer_by,
                    't_store_id'   => $t_store_id,
                    'date_time'    => $date_time,
                    'status'       => $status,
                    'transfer_status' => 0
                );
            }

            $result = $this->Store_invoices->transfer_product_request($transdata, $data1);

            if ($result == TRUE) {
                $this->session->set_userdata(array('message' => display('successfully_inserted')));
                if (isset($_POST['add-store'])) {
                    redirect(base_url('dashboard/Store_invoice/manage_transfer_request'));
                } elseif (isset($_POST['add-store-another'])) {
                    redirect(base_url('dashboard/Store_invoice/add_transfer_request'));
                }
            } else {
                $this->session->set_userdata(array('error_message' => display('failed_try_again')));
            }
        }

        $this->load->model('dashboard/Stores');
        $this->load->model('dashboard/Products');
        $this->load->model('dashboard/Variants');
        $store_list   = $this->Stores->store_list();
        $variant_list = $this->Variants->variant_list();
        $data = array(
            'title'         => display('transfer_product'),
            'mystore_id'    => $this->session->userdata('store_id'),
            'store_list'    => $store_list,
            'variant_list'  => $variant_list,
        );
        $content = $this->parser->parse('dashboard/store_invoice/transfer_new_request', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    // Manage store
    public function manage_transfer_request()
    {
        $store_id   = $this->session->userdata('store_id');
        $transfer_list = $this->Store_invoices->transfer_request_list($store_id);

        $data = array(
            'title' => display('transfer_list'),
            'store_product_list' => $transfer_list,
        );
        $content = $this->parser->parse('dashboard/store_invoice/transfer_request_list', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    // Update Transfer info
    public function transfer_update($trasfer_id)
    {

        $store_id   = $this->session->userdata('store_id');
        $this->form_validation->set_rules('transfer_from', display('transfer_from'), 'trim|required');
        $this->form_validation->set_rules('product_name[]', display('product_name'), 'trim|required');
        $this->form_validation->set_rules('product_quantity[]', display('qnty'), 'trim|required');

        $transinfo = $this->Store_invoices->get_transfer_request_info($trasfer_id, $store_id);
        $trans_list = $this->Store_invoices->get_transfer_request_details($trasfer_id, $store_id);


        if ($this->form_validation->run() == TRUE) {

            $transfer_id1  = $this->auth->generator(15);
            $transfer_from     = $this->input->post('transfer_from', TRUE);
            $product_ids  = $this->input->post('product_id', TRUE);
            $variant_id   = $this->input->post('variant_id', TRUE);
            $variant_color = $this->input->post('color_variant', TRUE);
            $quantity     = $this->input->post('product_quantity', TRUE);
            $transfer_by  = $this->session->userdata('user_id');
            $t_store_id   = $this->session->userdata('store_id');
            $date_time    = date("m-d-Y");
            $status       = 1;

            $data1 = [];

            $transdata = array(
                'transfer_id' => $trasfer_id,
                'transfer_from' => $transfer_from,
                'transfer_to' => $t_store_id,
                'created_at' => date('Y-m-d h:i:s'),
                'transfer_by' => $transfer_by
            );
            foreach ($product_ids as $key => $product) {
                $data1[] = array(
                    'transfer_id'  => $trasfer_id,
                    'store_id'     => $transfer_from,
                    'product_id'   => $product,
                    'variant_id'   => $variant_id[$key],
                    'variant_color' => @$variant_color[$key],
                    'quantity'     => $quantity[$key],
                    'transfer_by'  => $transfer_by,
                    't_store_id'   => $t_store_id,
                    'date_time'    => $date_time,
                    'status'       => $status,
                    'transfer_status' => 0
                );
            }

            $result = $this->Store_invoices->update_transfer_product_request($transdata, $data1);

            if ($result == TRUE) {
                $this->session->set_userdata(array('message' => display('updated_successfully')));
                redirect(base_url('dashboard/Store_invoice/manage_transfer_request'));
            } else {
                $this->session->set_userdata(array('error_message' => display('failed_try_again')));
            }
        }

        $this->load->model('dashboard/Stores');
        $this->load->model('dashboard/Products');
        $this->load->model('dashboard/Variants');
        $store_list   = $this->Stores->store_list();
        $variant_list = $this->Variants->variant_list();
        $data = array(
            'title'         => display('transfer_product'),
            'mystore_id'    => $this->session->userdata('store_id'),
            'trasfer_id'    => $trasfer_id,
            'transinfo'    => $transinfo,
            'trans_list'    => $trans_list,
            'store_list'    => $store_list,
            'variant_list'  => $variant_list,
        );
        $content = $this->parser->parse('dashboard/store_invoice/transfer_request_edit', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    // Transfer Delete  option
    public function transfer_delete($transfer_id)
    {
        $store_id   = $this->session->userdata('store_id');
        $is_transfer_exist = $this->Store_invoices->check_transfer_data($transfer_id, $store_id);

        if ($is_transfer_exist) {
            $result = $this->db->delete('transfer_request', array('transfer_id' => $transfer_id));
        }
        if ($result) {
            $this->session->set_userdata('message', display('deleted_successfully'));
        } else {
            $this->session->set_userdata('error_message', display('failed_try_again'));
        }
        redirect('dashboard/Store_invoice/manage_transfer_request');
    }

    // Received Transfer Request
    public function received_transfer_request()
    {
        $store_id   = $this->session->userdata('store_id');
        $transfer_list = $this->Store_invoices->received_request_list($store_id);


        $data = array(
            'title' => display('transfer_list'),
            'store_product_list' => $transfer_list,
        );
        $content = $this->parser->parse('dashboard/store_invoice/transfer_received_list', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    // Receive transfer list
    public function transfer_receive_update($trasfer_id)
    {

        $store_id   = $this->session->userdata('store_id');
        $this->form_validation->set_rules('transfer_from', display('transfer_from'), 'trim|required');
        $this->form_validation->set_rules('product_name[]', display('product_name'), 'trim|required');
        $this->form_validation->set_rules('product_quantity[]', display('qnty'), 'trim|required');

        $transinfo = $this->Store_invoices->get_transfer_received_info($trasfer_id, $store_id);
        $trans_list = $this->Store_invoices->get_transfer_received_details($trasfer_id, $store_id);

        $this->load->model('dashboard/Stores');
        $this->load->model('dashboard/Products');
        $this->load->model('dashboard/Variants');
        $store_list   = $this->Stores->store_list();
        $variant_list = $this->Variants->variant_list();
        $data = array(
            'title'         => display('transfer_product'),
            'mystore_id'    => $store_id,
            'trasfer_id'    => $trasfer_id,
            'transinfo'    => $transinfo,
            'trans_list'    => $trans_list,
            'store_list'    => $store_list,
            'variant_list'  => $variant_list,
        );
        $content = $this->parser->parse('dashboard/store_invoice/transfer_receive_edit', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function transfer_receive_delete($transfer_id)
    {
        $this->db->trans_start();

        $this->db->delete('transfer_request', array('transfer_id' => $transfer_id));
        $this->db->delete('transfer_request_details', array('transfer_id' => $transfer_id));

        $this->db->trans_complete();

        if ($this->db->trans_status() == TRUE) {
            $this->session->set_userdata('message', display('deleted_successfully'));
        } else {
            $this->session->set_userdata('error_message', display('failed_try_again'));
        }

        redirect('dashboard/Store_invoice/received_transfer_request');
    }

    public function update_received_status($transfer_id)
    {
        $transfer_status = $this->input->post('transfer_status', TRUE);

        $store_id   = $this->session->userdata('store_id');
        $transinfo = $this->Store_invoices->get_transfer_received_info($transfer_id, $store_id);
        $trans_list = $this->Store_invoices->get_transfer_received_details($transfer_id, $store_id);


        if ($transfer_status == '1') {

            $transfer_id2  = $this->auth->generator(15);

            $tdata  = [];
            $tdata1 = [];
            foreach ($trans_list as $item) {
                $tdata[] = array(
                    'transfer_id'  => $transfer_id,
                    'store_id'     => $item['store_id'],
                    'product_id'   => $item['product_id'],
                    'variant_id'   => $item['variant_id'],
                    'variant_color' => $item['variant_color'],
                    'quantity'     => "-" . $item['quantity'],
                    'transfer_by'  => $item['transfer_by'],
                    't_store_id'   => $item['t_store_id'],
                    'date_time'    => $item['date_time'],
                    'status'       => $item['status']
                );
                $tdata1[] = array(
                    'transfer_id'  => $transfer_id2,
                    'store_id'     => $item['t_store_id'],
                    'product_id'   => $item['product_id'],
                    'variant_id'   => $item['variant_id'],
                    'variant_color' => $item['variant_color'],
                    'quantity'     => $item['quantity'],
                    'transfer_by'  => $item['transfer_by'],
                    't_store_id'   => $item['store_id'],
                    'date_time'    => $item['date_time']
                );
            }

            $result = $this->Store_invoices->product_transfer_between_stores($tdata, $tdata1);
            if ($result) {
                $this->session->set_userdata('message', display('updated_successfully'));
            } else {
                $this->session->set_userdata('error_message', display('failed_try_again'));
            }



            $result = $this->Store_invoices->product_transfer_between_stores($tdata, $tdata1);
            if ($result) {
                $this->session->set_userdata('message', display('updated_successfully'));
            } else {
                $this->session->set_userdata('error_message', display('failed_try_again'));
            }
        } else {

            $data = array(
                'transfer_status' => $transfer_status
            );

            $this->db->trans_start();

            $this->db->update('transfer_request', $data);
            $this->db->update('transfer_request_details', $data);

            $this->db->trans_complete();

            if ($this->db->trans_status() == TRUE) {
                $this->session->set_userdata('message', display('updated_successfully'));
            } else {
                $this->session->set_userdata('error_message', display('failed_try_again'));
            }
        }

        redirect('dashboard/Store_invoice/received_transfer_request');
    }
}