<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_dashboard extends MX_Controller
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
        $this->load->model('dashboard/Reports');
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

        $this->load->model('hrm/Hrm_model');
        $this->load->model('dashboard/States');
    }

    //Default index page loading
    public function index()
    {

        if (!$this->auth->is_logged()) {
            $this->output->set_header("Location: " . base_url() . 'admin', TRUE, 302);
        }
        $total_customer      = $this->Customers->count_customer();
        $total_product       = $this->Products->count_product();
        $total_suppliers     = $this->Suppliers->count_supplier();
        $total_sales         = $this->Invoices->count_invoice();
        $total_store_invoice = $this->Invoices->total_store_invoice();
        $total_purchase      = $this->Purchases->count_purchase();

        $this->Accounts->accounts_summary(1);
        $total_expese         = $this->Accounts->sub_total;
        $monthly_sales_report = $this->Reports->monthly_sales_report();

        $sales_report         = $this->Reports->todays_total_sales_report();
        $purchase_report      = $this->Reports->todays_total_purchase_report();
        $discount_report      = $this->Reports->todays_total_discount_report();
        $currency_details     = $this->Soft_settings->retrieve_currency_info();
        $search_histories     = $this->Search_history->search_histries();
        $product_reviews      = $this->Product_reviews->d_product_reviews();
        $category_products    = $this->Categories->category_products();
        $best_sale_products   = $this->Orders->best_sale_product();

        //customer Activities
        $new_customers               = $this->Customer_activities->new_customers();
        $returning_customers         = $this->Customer_activities->returning_customers();
        $date_array                  = $this->Customer_activities->date_array();
        $monthly_new_customers       = $this->Customer_activities->monthly_new_customers($date_array);
        $monthly_returning_customers = $this->Customer_activities->monthly_returning_customers($date_array);

        $average_spending_per_visit  = $this->Customer_activities->average_spending_per_visit();
        $average_visits_per_customer = $this->Customer_activities->average_visits_per_customer();
        $positive_review_count       = $this->Customer_activities->positive_review_count();

        $data = array(
            'title'                      => display('dashboard'),
            'total_customer'             => $total_customer,
            'total_product'              => $total_product,
            'total_suppliers'            => $total_suppliers,
            'total_sales'                => $total_sales,
            'total_purchase'             => $total_purchase,
            'total_store_invoice'        => $total_store_invoice,
            'sales_amount'               => number_format($sales_report[0]['total_sale'], 2, '.', ','),
            'purchase_amount'            => number_format($purchase_report[0]['total_purchase'], 2, '.', ','),
            'discount_amount'            => number_format($discount_report[0]['total_discount'], 2, '.', ','),
            'total_expese'               => $total_expese,
            'monthly_sales_report'       => $monthly_sales_report,
            'currency'                   => $currency_details[0]['currency_icon'],
            'position'                   => $currency_details[0]['currency_position'],
            'search_histories'           => $search_histories,
            'product_reviews'            => $product_reviews,
            'category_products'          => $category_products,
            'best_sale_products'         => $best_sale_products,
            'new_customers'              => $new_customers->new_customers,
            'returning_customers'        => $returning_customers->returning_customers,
            'monthly_new_customers'      => $monthly_new_customers,
            'monthly_returning_customers' => $monthly_returning_customers,
            'average_spending_per_visit' => $average_spending_per_visit,
            'average_visits_per_customer' => $average_visits_per_customer,
            'positive_review_count'      => $positive_review_count,
        );

        $content = $this->parser->parse('dashboard/home/home', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function latest_search_keywords()
    {
        $search_histories     = $this->Search_history->all_search_histries();
        $data = array(
            'title' => display('latest_search_keywords'),
            'search_histories' => $search_histories
        );
        $content = $this->parser->parse('dashboard/product/latest_search_keywords', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function all_category_products()
    {
        $category_products = $this->Categories->all_category_products();
        $data = array(
            'title' => display('category_products'),
            'category_products' => $category_products
        );
        $content = $this->parser->parse('dashboard/category/all_category_products', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function find_products()
    {
        $product_name     = $this->input->post('product_name', TRUE);
        $retrive_products = $this->Products->retrive_products($product_name);
        foreach ($retrive_products as $value) {
            //$json_product[] = array('label' => $value['product_name'] . '-(' . $value['product_model'] . ')', 'value' => $value['product_id']);
            $json_product[] = array('label' => $value['product_name'], 'value' => $value['product_id']);
        }
        echo json_encode($json_product);
    }

    public function retrieve_product_data()
    {
        $product_id = $this->input->post('product_id', TRUE);
        $product_info = $this->Purchases->get_total_product($product_id);
        echo json_encode($product_info);
    }

    public function best_sale_products()
    {
        $best_sale_products = $this->Orders->all_best_sale_product();
        $data = array(
            'title' => display('best_sale_product'),
            'best_sale_products' => $best_sale_products
        );
        $content = $this->parser->parse('dashboard/order/all_best_sale_products', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function monthly_best_sale_product()
    {

        $from_date  = $this->input->get('from_date', TRUE);
        $to_date    = $this->input->get('to_date', TRUE);
        $product_id = $this->input->get('product_id', TRUE);
        $best_sale_products   = $this->Orders->all_best_sale_product($from_date, $to_date, $product_id);
        $data = array(
            'title' => display('monthly_best_sale_product'),
            'best_sale_products' => $best_sale_products
        );
        $content = $this->parser->parse('dashboard/order/all_best_sale_products', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    #==============Todays_sales_report============#
    public function todays_sales_report()
    {

        $this->permission->check_label('sales_report')->read()->redirect();

        $this->load->library('dashboard/lreport');

        #
        #pagination starts
        #
        $config["base_url"] = base_url('dashboard/Admin_dashboard/todays_sales_report/');
        $config["total_rows"] = $this->Reports->todays_sales_report_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;
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
        $page = ($this->uri->segment(4)) ? $this->uri->segment(3) : 0;
        $links = $this->pagination->create_links();
        #
        #pagination ends
        # 

        $content = $this->lreport->todays_sales_report($links, $config["per_page"], $page);
        $this->template_lib->full_admin_html_view($content);
    }


    public function sales_report_store_wise()
    {

        $this->permission->check_label('sales_report_store_wise')->read()->redirect();

        $store_list = $this->Stores->store_list();
        $data = [
            'title' => display('sales_report_store_wise'),
            'stores' => $store_list
        ];

        $content = $this->parser->parse('dashboard/report/sales_report_store_wise', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    #============Date wise sales report==============#
    public function retrieve_sales_report_store_wise()
    {
        $this->permission->check_label('sales_report_store_wise')->read()->redirect();

        $store_id = $this->input->post('store_id', TRUE);
        $start_date = $this->input->post('start_date', TRUE);
        $end_date = $this->input->post('end_date', TRUE);

        $content = $this->lreport->retrieve_sales_report_store_wise($store_id, $start_date, $end_date);
        $this->template_lib->full_admin_html_view($content);
    }

    public function sales_report_employee_wise()
    {

        $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        $employee_list = $this->Hrm_model->employee_list();
        // echo "<pre>";print_r($employee_list);exit;

        $data = [
            'title' => display('sales_report_employee_wise'),
            'employees' => $employee_list
        ];

        $content = $this->parser->parse('dashboard/report/sales_report_employee_wise', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    #============Date Employee wise sales report==============#
    public function retrieve_sales_report_employee_wise()
    {
        $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        $employee_id = $this->input->post('employee_id', TRUE);
        $start_date = $this->input->post('start_date', TRUE);
        $end_date = $this->input->post('end_date', TRUE);

        $content = $this->lreport->retrieve_sales_report_employee_wise($employee_id, $start_date, $end_date);
        $this->template_lib->full_admin_html_view($content);
    }


    public function sales_report_city_wise()
    {

        $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        $country_list = $this->States->get_country_list();
        $data = [
            'title' => display('sales_report_city_wise'),
            'countries' => $country_list
        ];

        $content = $this->parser->parse('dashboard/report/sales_report_city_wise', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    #============Date Employee wise sales report==============#
    public function retrieve_sales_report_city_wise()
    {
        $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        $cities = $this->input->post('cities', TRUE);
        $start_date = $this->input->post('start_date', TRUE);
        $end_date = $this->input->post('end_date', TRUE);

        $content = $this->lreport->retrieve_sales_report_city_wise($cities, $start_date, $end_date);
        $this->template_lib->full_admin_html_view($content);
    }

    public function sales_report_product_wise()
    {

        $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        $data = [
            'title' => display('sales_report_product_wise'),
        ];

        $content = $this->parser->parse('dashboard/report/sales_report_product_wise', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    #============Product wise sales report==============#
    public function retrieve_sales_report_product_wise()
    {
        $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        $start_date = $this->input->post('start_date', TRUE);
        $end_date = $this->input->post('end_date', TRUE);

        $content = $this->lreport->retrieve_sales_report_product_wise($start_date, $end_date);
        $this->template_lib->full_admin_html_view($content);
    }

    #============Invoice wise sales report==============#
    public function sales_report_invoice_wise()
    {

        $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        $data = [
            'title' => display('sales_report_invoice_wise'),
        ];

        $content = $this->parser->parse('dashboard/report/sales_report_invoice_wise', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function retrieve_sales_report_invoice_wise()
    {
        $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        $start_date = $this->input->post('start_date', TRUE);
        $end_date = $this->input->post('end_date', TRUE);

        $content = $this->lreport->retrieve_sales_report_invoice_wise($start_date, $end_date);
        $this->template_lib->full_admin_html_view($content);
    }

    #============Invoice wise sales report==============#
    public function sales_report_graph_wise()
    {
        $this->load->model(array(
            'dashboard/Invoices',
        ));

        // $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        $all_pri_type = $this->Invoices->select_all_pri_type();

        $data = [
            'title' => display('sales_report_graph_wise'),
            'all_pri_type' => $all_pri_type
        ];

        $content = $this->parser->parse('dashboard/report/sales_report_graph_wise', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function retrieve_sales_report_graph_wise()
    {
        $this->load->model(array(
            'dashboard/Invoices',
        ));
        // $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        $start_date = $this->input->get('start_date', TRUE);
        $end_date = $this->input->get('end_date', TRUE);
        $pri_type = $this->input->get('pri_type', TRUE);

        $all_pri_type = $this->Invoices->select_all_pri_type();

        $content = $this->lreport->retrieve_sales_report_graph_wise($start_date, $end_date, $pri_type ?? 1, $all_pri_type);
        $this->template_lib->full_admin_html_view($content);
    }

    #============Invoice wise sales report==============#
    public function purchase_report_graph_wise()
    {
        $this->load->model(array(
            'dashboard/Invoices',
        ));
        // $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        $all_pri_type = $this->Invoices->select_all_pri_type();

        $data = [
            'title' => display('purchase_report_graph_wise'),
            'all_pri_type' => $all_pri_type
        ];

        $content = $this->parser->parse('dashboard/report/purchase_report_graph_wise', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function retrieve_purchase_report_graph_wise()
    {
        $this->load->model(array(
            'dashboard/Invoices',
        ));
        // $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        $start_date = $this->input->get('start_date', TRUE);
        $end_date = $this->input->get('end_date', TRUE);
        $pri_type = $this->input->get('pri_type', TRUE);

        $all_pri_type = $this->Invoices->select_all_pri_type();

        $content = $this->lreport->retrieve_purchase_report_graph_wise($start_date, $end_date, $pri_type ?? 1, $all_pri_type);
        $this->template_lib->full_admin_html_view($content);
    }

    #============customer wise sales report==============#
    public function sales_report_customer_wise()
    {

        $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        $data = [
            'title' => display('sales_report_customer_wise'),
        ];

        $content = $this->parser->parse('dashboard/report/sales_report_customer_wise', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function retrieve_sales_report_customer_wise()
    {
        $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        $start_date = $this->input->post('start_date', TRUE);
        $end_date = $this->input->post('end_date', TRUE);

        $content = $this->lreport->retrieve_sales_report_customer_wise($start_date, $end_date);
        $this->template_lib->full_admin_html_view($content);
    }

    #============customer wise sales report==============#
    public function sales_report_summary_wise()
    {

        $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        $start_date = date('d-m-Y');
        $end_date = date('d-m-Y');

        $content = $this->lreport->retrieve_sales_report_summary_wise($start_date, $end_date);
        $this->template_lib->full_admin_html_view($content);
    }

    public function retrieve_sales_report_summary_wise()
    {
        $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        $start_date = $this->input->post('start_date', TRUE);
        $end_date = $this->input->post('end_date', TRUE);

        $content = $this->lreport->retrieve_sales_report_summary_wise($start_date, $end_date);
        $this->template_lib->full_admin_html_view($content);
    }

    #============customer wise sales report==============#
    public function sales_report_latest_customers()
    {

        $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        $data = [
            'title' => display('sales_report_latest_customers'),
        ];

        $content = $this->parser->parse('dashboard/report/sales_report_latest_customers', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function retrieve_sales_report_latest_customers()
    {
        $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        $start_date = $this->input->post('start_date', TRUE);
        $end_date = $this->input->post('end_date', TRUE);

        $content = $this->lreport->retrieve_sales_report_latest_customers($start_date, $end_date);
        $this->template_lib->full_admin_html_view($content);
    }

    #============customer wise sales report==============#
    public function sales_report_all_details($page = 0)
    {

        // $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        // $page = $this->input->get('page', true) ? $this->input->get('page', true) : 0;

        $product_name = $this->input->get('product_name', true);
        $product_id = $this->input->get('product_id', TRUE);
        $pricing_type = $this->input->get('pri_type', TRUE);
        $category_id = $this->input->get('category_id', TRUE);
        $product_type = $this->input->get('product_type', TRUE);
        $general_filter = $this->input->get('filter_1_id', TRUE);
        $material_filter = $this->input->get('filter_2_id', TRUE);
        $start_date = $this->input->get('from_date', TRUE);
        $end_date = $this->input->get('to_date', TRUE);

        if (isset($category_id[0]) && empty($category_id[0])) {
            $category_id = null;
        }
        if (isset($general_filter[0]) && empty($general_filter[0])) {
            $general_filter = null;
        }
        if (isset($material_filter[0]) && empty($material_filter[0])) {
            $material_filter = null;
        }

        if (!$pricing_type) {
            $pricing_type = 0;
        }

        // sales
        $sales_from = $this->input->get('sales_from', TRUE);
        $sales_to = $this->input->get('sales_to', TRUE);
        // purchase
        $purchase_from = $this->input->get('purchase_from', TRUE);
        $purchase_to = $this->input->get('purchase_to', TRUE);
        // balance
        $balance_from = $this->input->get('balance_from', TRUE);
        $balance_to = $this->input->get('balance_to', TRUE);

        // supplier
        $supplier_from = $this->input->get('supplier_from', TRUE);
        $supplier_to = $this->input->get('supplier_to', TRUE);
        // total_supplier
        $total_supplier_from = $this->input->get('total_supplier_from', TRUE);
        $total_supplier_to = $this->input->get('total_supplier_to', TRUE);

        // sell
        $sell_from = $this->input->get('sell_from', TRUE);
        $sell_to = $this->input->get('sell_to', TRUE);
        // total_sell
        $total_sell_from = $this->input->get('total_sell_from', TRUE);
        $total_sell_to = $this->input->get('total_sell_to', TRUE);

        $data = [
            'title' => display('sales_report_all_details'),
        ];

        

        #
        #pagination starts
        #
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $pageUrl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $footer = $this->lreport->retrieve_sales_report_all_details_count_all(
            $product_id,
            $pricing_type,
            $category_id,
            $product_type,
            $general_filter,
            $material_filter,
            $sales_from,
            $sales_to,
            $purchase_from,
            $purchase_to,
            $balance_from,
            $balance_to,
            $supplier_from,
            $supplier_to,
            $total_supplier_from,
            $total_supplier_to,
            $sell_from,
            $sell_to,
            $total_sell_from,
            $total_sell_to,
            $start_date,
            $end_date,
            null,
            $product_name
        );

        // echo "<pre>";print_r($footer);exit;

        $config["base_url"] = base_url('/dashboard/Admin_dashboard/sales_report_all_details/');
        $config["total_rows"] = (int)$footer['count'];
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;
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
        $config['reuse_query_string'] = true;
        // echo "<pre>";var_dump($config);exit;
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        // $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $links = $this->pagination->create_links();
        #
        #pagination ends
        #

        // $content = $this->parser->parse('dashboard/report/sales_report_all_details', $data, true);
        $content = $this->lreport->retrieve_sales_report_all_details(
            $product_id,
            $pricing_type,
            $category_id,
            $product_type,
            $general_filter,
            $material_filter,
            $sales_from,
            $sales_to,
            $purchase_from,
            $purchase_to,
            $balance_from,
            $balance_to,
            $supplier_from,
            $supplier_to,
            $total_supplier_from,
            $total_supplier_to,
            $sell_from,
            $sell_to,
            $total_sell_from,
            $total_sell_to,
            $start_date,
            $end_date,
            null,
            $product_name,
            $config["per_page"],
            $page,
            $links,
            $footer
        );
        $this->template_lib->full_admin_html_view($content);
    }

    /** Purchaes reports */

    /** purchase report product wise */
    public function purchase_report_product_wise()
    {

        $this->permission->check_label('purchase_report')->read()->redirect();

        $data = [
            'title' => display('purchase_report_product_wise'),
        ];

        $content = $this->parser->parse('dashboard/report/purchase_report_product_wise', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    #============Product wise sales report==============#
    public function retrieve_purchase_report_product_wise()
    {
        $this->permission->check_label('purchase_report')->read()->redirect();

        $start_date = $this->input->post('start_date', TRUE);
        $end_date = $this->input->post('end_date', TRUE);

        $content = $this->lreport->retrieve_purchase_report_product_wise($start_date, $end_date);
        $this->template_lib->full_admin_html_view($content);
    }

    /** purchase report invoice wise */
    public function purchase_report_invoice_wise()
    {

        $this->permission->check_label('purchase_report')->read()->redirect();

        $data = [
            'title' => display('purchase_report_invoice_wise'),
        ];

        $content = $this->parser->parse('dashboard/report/purchase_report_invoice_wise', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    #============invoice wise sales report==============#
    public function retrieve_purchase_report_invoice_wise()
    {
        $this->permission->check_label('purchase_report')->read()->redirect();

        $start_date = $this->input->post('start_date', TRUE);
        $end_date = $this->input->post('end_date', TRUE);

        $content = $this->lreport->retrieve_purchase_report_invoice_wise($start_date, $end_date);
        $this->template_lib->full_admin_html_view($content);
    }

    /** purchase report customer wise */
    public function purchase_report_customer_wise()
    {

        $this->permission->check_label('purchase_report')->read()->redirect();

        $data = [
            'title' => display('purchase_report_customer_wise'),
        ];

        $content = $this->parser->parse('dashboard/report/purchase_report_customer_wise', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    #============customer wise sales report==============#
    public function retrieve_purchase_report_customer_wise()
    {
        $this->permission->check_label('purchase_report')->read()->redirect();

        $start_date = $this->input->post('start_date', TRUE);
        $end_date = $this->input->post('end_date', TRUE);

        $content = $this->lreport->retrieve_purchase_report_customer_wise($start_date, $end_date);
        $this->template_lib->full_admin_html_view($content);
    }

    /** purchase report summary wise */
    public function purchase_report_summary_wise()
    {

        $this->permission->check_label('purchase_report')->read()->redirect();

        $data = [
            'title' => display('purchase_report_summary_wise'),
        ];

        $content = $this->parser->parse('dashboard/report/purchase_report_summary_wise', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    #============summary wise sales report==============#
    public function retrieve_purchase_report_summary_wise()
    {
        $this->permission->check_label('purchase_report')->read()->redirect();

        $start_date = $this->input->post('start_date', TRUE);
        $end_date = $this->input->post('end_date', TRUE);

        $content = $this->lreport->retrieve_purchase_report_summary_wise($start_date, $end_date);
        $this->template_lib->full_admin_html_view($content);
    }

    #============supplier wise purchase report==============#
    public function purchase_report_latest_suppliers()
    {

        $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        $data = [
            'title' => display('purchase_report_latest_suppliers'),
        ];

        $content = $this->parser->parse('dashboard/report/purchase_report_latest_suppliers', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function retrieve_purchase_report_latest_suppliers()
    {
        $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        $start_date = $this->input->post('start_date', TRUE);
        $end_date = $this->input->post('end_date', TRUE);

        $content = $this->lreport->retrieve_purchase_report_latest_suppliers($start_date, $end_date);
        $this->template_lib->full_admin_html_view($content);
    }

    #==============Transfer Report============#
    public function transfer_report()
    {
        $this->permission->check_label('transfer_report')->read()->redirect();
        $from_date = $this->input->post('from_date', TRUE);
        $to_date = $this->input->post('to_date', TRUE);

        $content = $this->lreport->transfer_report($from_date, $to_date);
        $this->template_lib->full_admin_html_view($content);
    }

    #==============Store To Store Transfer============#
    public function store_to_store_transfer()
    {
        $this->permission->check_label('store_to_store_transfer')->read()->redirect();

        $from_date = $this->input->get('from_date', TRUE);
        $to_date = $this->input->get('to_date', TRUE);
        $from_store = $this->input->get('from_store', TRUE);
        $to_store = $this->input->get('to_store', TRUE);

        $content = $this->lreport->store_to_store_transfer($from_date, $to_date, $from_store, $to_store);
        $this->template_lib->full_admin_html_view($content);
    }

    #==============Store To Wearhouse============#
    public function store_to_warehouse_transfer()
    {
        $this->permission->check_label('store_to_store_transfer')->read()->redirect();

        $from_date = $this->input->post('from_date', TRUE);
        $to_date   = $this->input->post('to_date', TRUE);
        $from_store = $this->input->post('from_store', TRUE);
        $t_wearhouse    = $this->input->post('t_wearhouse', TRUE);

        $content = $this->lreport->store_to_warehouse_transfer($from_date, $to_date, $from_store, $t_wearhouse);
        $this->template_lib->full_admin_html_view($content);
    }

    #==============Wearhouse To Store============#
    public function warehouse_to_store_transfer()
    {
        $this->permission->check_label('store_to_store_transfer')->read()->redirect();

        $from_date = $this->input->post('from_date', TRUE);
        $to_date   = $this->input->post('to_date', TRUE);
        $wearhouse = $this->input->post('wearhouse', TRUE);
        $t_store   = $this->input->post('t_store', TRUE);

        $content = $this->lreport->warehouse_to_store_transfer($from_date, $to_date, $wearhouse, $t_store);
        $this->template_lib->full_admin_html_view($content);
    }
    #==============Wearhouse To Wearhouse============#
    public function warehouse_to_warehouse_transfer()
    {
        $this->permission->check_label('store_to_store_transfer')->read()->redirect();

        $from_date = $this->input->post('from_date', TRUE);
        $to_date   = $this->input->post('to_date', TRUE);
        $wearhouse = $this->input->post('wearhouse', TRUE);
        $t_wearhouse   = $this->input->post('t_wearhouse', TRUE);

        $content = $this->lreport->warehouse_to_warehouse_transfer($from_date, $to_date, $wearhouse, $t_wearhouse);
        $this->template_lib->full_admin_html_view($content);
    }


    #==============Tax Report============#
    public function tax_report_product_wise()
    {
        $this->permission->check_label('tax_report_product_wise')->read()->redirect();

        $from_date = date("Y-m-d", strtotime($this->input->post('from_date', TRUE)));
        $to_date = date("Y-m-d", strtotime($this->input->post('to_date', TRUE)));

        $content = $this->lreport->tax_report($from_date, $to_date);
        $this->template_lib->full_admin_html_view($content);
    }

    #==============Tax Report Invoice Wise============#
    public function tax_report_invoice_wise()
    {
        $this->permission->check_label('tax_report_invoice_wise')->read()->redirect();

        $from_date = date("Y-m-d", strtotime($this->input->post('from_date', TRUE)));
        $to_date = date("Y-m-d", strtotime($this->input->post('to_date', TRUE)));

        $content = $this->lreport->tax_report_invoice_wise($from_date, $to_date);
        $this->template_lib->full_admin_html_view($content);
    }

    #=============Total profit report===================#
    public function total_profit_report()
    {

        #
        #pagination starts
        #
        $config["base_url"] = base_url('dashboard/Admin_dashboard/total_profit_report/');
        $config["total_rows"] = $this->Reports->total_profit_report_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;
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
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $links = $this->pagination->create_links();
        #
        #pagination ends
        #  
        $content = $this->lreport->total_profit_report($links, $config["per_page"], $page);

        $this->template_lib->full_admin_html_view($content);
    }

    #==============Date wise profit report=============#
    public function retrieve_dateWise_profit_report()
    {

        $start_date = $this->input->post('from_date', TRUE);
        $end_date = $this->input->post('to_date', TRUE);
        $content = $this->lreport->retrieve_dateWise_profit_report($start_date, $end_date);
        $this->template_lib->full_admin_html_view($content);
    }

    #============Date wise sales report==============#
    public function retrieve_dateWise_SalesReports()
    {

        $this->load->library('dashboard/lreport');
        $from_date = $this->input->post('from_date', TRUE);
        $to_date = $this->input->post('to_date', TRUE);
        $employee_id = $this->input->post('employee_id', TRUE);
        $city_name = $this->input->post('city_name', TRUE);
        $content = $this->lreport->retrieve_dateWise_SalesReports($from_date, $to_date, $employee_id, $city_name);
        $this->template_lib->full_admin_html_view($content);
    }

    #================todays_purchase_report========#
    public function todays_purchase_report()
    {
        $this->permission->check_label('purchase_report')->read()->redirect();
        #
        #pagination starts
        #
        $config["base_url"] = base_url('dashboard/Admin_dashboard/todays_purchase_report/');
        $config["total_rows"] = $this->Reports->todays_sales_report_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;
        $config["num_links"] = 5;
        /* This Application Must Be Used With BootStrap 3 * */
        $config['full_tag_open']   = "<ul class='pagination'>";
        $config['full_tag_close']  = "</ul>";
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        $config['cur_tag_open']    = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']   = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']   = "<li>";
        $config['next_tag_close']  = "</li>";
        $config['prev_tag_open']   = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open']  = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']   = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $links = $this->pagination->create_links();
        #
        #pagination ends
        # 
        $content = $this->lreport->todays_purchase_report($links, $config["per_page"], $page);
        $this->template_lib->full_admin_html_view($content);
    }

    #==============Date wise purchase report=============#
    public function retrieve_dateWise_PurchaseReports()
    {
        $this->permission->check_label('purchase_report')->read()->redirect();

        $start_date = $this->input->post('from_date', TRUE);
        $end_date = $this->input->post('to_date', TRUE);

        $content = $this->lreport->retrieve_dateWise_PurchaseReports($start_date, $end_date);
        $this->template_lib->full_admin_html_view($content);
    }

    #==============Product sales search reports============#
    public function product_sales_search_reports()
    {

        $from_date = $this->input->post('from_date', TRUE);
        $to_date = $this->input->post('to_date', TRUE);
        $content = $this->lreport->get_products_search_report($from_date, $to_date);
        $this->template_lib->full_admin_html_view($content);
    }

    #===============Logout=======#
    public function logout()
    {
        if ($this->auth->logout())
            $this->output->set_header("Location: " . base_url() . 'admin', TRUE, 302);
    }

    public function forget_admin_password()
    {

        $this->form_validation->set_rules('admin_email', display('email'), 'required|valid_email|max_length[100]|trim');

        $email = $this->input->post('admin_email', TRUE);
        if ($this->form_validation->run()) {
            $admin = $this->get_admin_info($email);

            $ptoken = date('ymdhis');
            if ($admin) {
                $email = $admin[0]['username'];

                $precdat = array(
                    'email' => $email,
                    'token' => $ptoken,

                );
                $send_email = '';
                if (!empty($email)) {
                    $send_email = $this->send_mail($email, $ptoken);
                    $this->add_token($precdat);
                }
                if ($send_email) {
                    echo 1;
                } else {
                    echo 2;
                }
            } else {
                echo 3;
            }
        } else {
            echo 4;
        }
    }


    //check user exists on the database or not
    public function get_admin_info($email)
    {
        $result = $this->db->select('*')->from('user_login')->where('username =', $email)->get()->result_array();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function add_token($precdat)
    {
        $this->db->set('token', $precdat['token']);
        $this->db->where('username', $precdat['email']);
        $result = $this->db->update('user_login');

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function admin_password_update()
    {
        $data = [
            'token' => $this->input->post('token', TRUE),
            'password' => $this->input->post('admin_password', TRUE)
        ];

        $password = md5("gef" . $data['password']);
        $this->db->set('password', $password);
        $this->db->where('token', $data['token']);
        $result = $this->db->update('user_login');

        if ($result) {
            $this->session->set_userdata(array('message' => display('successfully_updated')));
            redirect('admin');
        } else {
            return false;
        }
    }


    public function send_mail($email, $ptoken)
    {


        $setting_detail = $this->Soft_settings->retrieve_email_editdata();

        $subject = display("password_recovery");
        $message = base_url('admin_password_reset/' . $ptoken);
        $message2 = "Click here";

        $link = "To Reset your Password <a href='" . $message . "'>" . $message2 . "</a>";
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
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($link);

        if ($this->email->send()) {
            $this->session->set_userdata(array('message' => display('email_send_to_customer')));
            return true;
        } else {
            return false;
        }
    }


    public function admin_password_reset_form($token)
    {
        $data['token'] = $token;

        $this->load->view('web/admin_password_reset', $data);
    }

    #=============Edit Profile======#
    public function edit_profile()
    {
        $this->auth->check_admin_store_auth();
        $this->load->library('dashboard/luser');
        $content = $this->luser->edit_profile_form();
        $this->template_lib->full_admin_html_view($content);
    }
    #=============Update Profile========#
    public function update_profile()
    {
        $this->auth->check_admin_store_auth();
        $this->load->model('dashboard/Users');
        $this->Users->profile_update();
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('dashboard/Admin_dashboard/edit_profile'));
    }
    #=============Change Password=========# 
    public function change_password_form()
    {
        $this->auth->check_admin_store_auth();
        $content = $this->parser->parse('dashboard/user/change_password', array('title' => "Change Password"), true);
        $this->template_lib->full_admin_html_view($content);
    }

    #============Change Password===========#
    public function change_password()
    {
        $this->auth->check_admin_store_auth();
        $error = '';
        $email = $this->input->post('email', TRUE);
        $old_password = $this->input->post('old_password', TRUE);
        $new_password = $this->input->post('password', TRUE);
        $repassword = $this->input->post('repassword', TRUE);

        if ($email == '' || $old_password == '' || $new_password == '') {
            $error = display('blank_field_does_not_accept');
        } else if ($email != $this->session->userdata('user_email')) {
            $error = display('you_put_wrong_email_address');
        } else if (strlen($new_password) < 6) {
            $error = display('new_password_at_least_six_character');
        } else if ($new_password != $repassword) {
            $error = display('password_and_repassword_does_not_match');
        } else if ($this->Users->change_password($email, $old_password, $new_password) === FALSE) {
            $error = display('you_are_not_authorised_person');
        }

        if ($error != '') {
            $this->session->set_userdata(array('error_message' => $error));
            $this->output->set_header("Location: " . base_url() . 'dashboard/Admin_dashboard/change_password_form', TRUE, 302);
        } else {
            $this->session->set_userdata(array('message' => display('successfully_changed_password')));
            $this->output->set_header("Location: " . base_url() . 'dashboard/Admin_dashboard/change_password_form', TRUE, 302);
        }
    }
}
