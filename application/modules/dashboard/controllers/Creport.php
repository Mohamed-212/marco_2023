<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Creport extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->auth->check_user_auth();
        $this->load->model(array(
            'dashboard/Soft_settings',
            'dashboard/Reports',
            'dashboard/Suppliers',
            'dashboard/Products',
            'dashboard/Stores',
            'template/Template_model',
        ));
        $this->load->library('dashboard/occational');
        $this->load->library('dashboard/lreport');
    }


    public function index()
    {

        $today = date('d-m-Y');
        $product_id = $this->input->post('product_id', TRUE) ? $this->input->post('product_id', TRUE) : "";
        $date = $this->input->post('stock_date', TRUE) ? $this->input->post('stock_date', TRUE) : $today;
        #
        #pagination starts
        #
        $config["base_url"]   = base_url('dashboard/Creport/index/');
        $config["total_rows"] = $this->Reports->count_stock_report_bydate($product_id);
        $config["per_page"]   = 20;
        $config["uri_segment"] = 4;
        $config["num_links"]  = 5;
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
        $content = $this->lreport->stock_report_single_item($product_id, $date, $config["per_page"], $page, $links);
        $this->template_lib->full_admin_html_view($content);
    }

    //=======stock report store wise ==========
    public function store_wise_product()
    {

        #
        #pagination starts
        #
        $config["base_url"] = base_url('dashboard/Creport/store_wise_product/');
        $config["total_rows"] = @count($this->Reports->store_wise_product());
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
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $links = $this->pagination->create_links();
        #
        #pagination ends
        #
        $content = $this->lreport->store_wise_product($links, $config["per_page"], $page);
        $this->template_lib->full_admin_html_view($content);
    }

    //Out of stock product
    public function out_of_stock()
    {
        $this->load->library('lreport');
        $content = $this->lreport->out_of_stock();
        $this->template_lib->full_admin_html_view($content);
    }


    //Stock report product wise
    public function stock_report_product_wise()
    {
        $this->permission->check_label('stock_report_product_wise')->read()->redirect();

        $today = date('m-d-Y');

        $product_id  = $this->input->post('product_id', TRUE) ? $this->input->post('product_id', TRUE) : "";
        $supplier_id = $this->input->post('supplier_id', TRUE) ? $this->input->post('supplier_id', TRUE) : "";
        $from_date   = $this->input->post('from_date', TRUE);
        $to_date     = $this->input->post('to_date', TRUE) ? $this->input->post('to_date', TRUE) : $today;

        #
        #pagination starts
        #
        $config["base_url"]    = base_url('dashboard/Creport/stock_report_product_wise');
        $config["total_rows"]  = $this->Reports->stock_report_product_bydate_count($supplier_id, $supplier_id, $from_date, $to_date);
        $config["per_page"]    = 20;
        $config["uri_segment"] = 4;
        $config["num_links"]   = 5;
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
        $content = $this->lreport->stock_report_product_wise($product_id, $supplier_id, $from_date, $to_date, $links, $config["per_page"], $page);

        $this->template_lib->full_admin_html_view($content);
    }

    //Stock report supplier report
    public function stock_report_supplier_wise()
    {
        $this->permission->check_label('stock_report_supplier_wise')->read()->redirect();

        $today = date('m-d-Y');

        $product_id = $this->input->post('product_id', TRUE) ? $this->input->post('product_id', TRUE) : "";
        $supplier_id = $this->input->post('supplier_id', TRUE) ? $this->input->post('supplier_id', TRUE) : "";
        $date = $this->input->post('stock_date', TRUE) ? $this->input->post('stock_date', TRUE) : $today;

        #
        #pagination starts
        #
        $config["base_url"] = base_url('dashboard/Creport/stock_report_supplier_wise/');
        $config["total_rows"] = $this->Reports->product_counter_by_supplier($supplier_id, $date);
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
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $links = $this->pagination->create_links();
        #
        #pagination ends
        #
        $content = $this->lreport->stock_report_supplier_wise($product_id, $supplier_id, $date, $links, $config["per_page"], $page);
        $this->template_lib->full_admin_html_view($content);
    }

    public function stock_report_store_wise()
    {

        $this->permission->check_label('stock_report_store_wise')->read()->redirect();

        $today = date('Y-m-d');
        $from_date = $this->input->get('from_date', TRUE);
        $product_id = $this->input->get('product_id', TRUE);
        $to_date = $this->input->get('to_date', TRUE);
        $store_id = $this->input->get('store_id', TRUE);
        if (empty($store_id)) {
            $from_date = date('Y-m-01');
            $to_date = date('Y-m-d');
            $result = $this->db->select('store_id')->from('store_set')->where('default_status=', 1)->get()->row();
            $store_id = $result->store_id;
        }
        #
        #pagination starts
        #
        $config["base_url"] = base_url('dashboard/Creport/stock_report_store_wise/');
        $config["reuse_query_string"] = true;
        $config["total_rows"] = $this->Reports->stock_report_variant_bydate_count($from_date, $to_date, $store_id, $product_id);
        // echo "<pre>";var_dump($config);exit;
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
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $links = $this->pagination->create_links();
        #
        #pagination ends
        #
        $content = $this->lreport->stock_report_variant_wise($from_date, $to_date, $store_id, $links, $config["per_page"], $page, $product_id);
        $this->template_lib->full_admin_html_view($content);
    }

    public function stock_report_product_card()
    {

        // $this->permission->check_label('stock_report_product_card')->read()->redirect();

        $today = date('Y-m-d');
        $from_date = $this->input->get('from_date', TRUE);
        $product_id = $this->input->get('product_id', TRUE);
        $to_date = $this->input->get('to_date', TRUE);
        $store_id = $this->input->get('store_id', TRUE);
        if (empty($store_id)) {
            // $from_date = date('Y-m-01');
            // $to_date = date('Y-m-d');
            $result = $this->db->select('store_id')->from('store_set')->where('default_status', 1)->get()->row();
            $store_id = $result->store_id;
        }
        
        $content = $this->lreport->stock_report_product_card($from_date, $to_date, $store_id, $product_id);
        $this->template_lib->full_admin_html_view($content);
    }

    //Get product by supplier
    public function get_product_by_supplier()
    {
        $supplier_id = $this->input->post('supplier_id', TRUE);

        $product_info_by_supplier = $this->db->select('*')
            ->from('product_information')
            ->where('supplier_id', $supplier_id)
            ->get()
            ->result();

        if ($product_info_by_supplier) {
            echo "<select class=\"form-control\" id=\"supplier_id\" name=\"supplier_id\">
			<option value=\"\">" . display('select_one') . "</option>";
            foreach ($product_info_by_supplier as $product) {
                echo "<option value='" . $product->product_id . "'>" . $product->product_name . '-(' . $product->product_model . ')' . " </option>";
            }
            echo " </select>";
        }
    }

    //Get variant by product
    public function retrive_variant_by_product()
    {
        $product_id = $this->input->post('product_id', TRUE);
        $product_information = $this->db->select('variants')
            ->from('product_information')
            ->where('product_id', $product_id)
            ->get()
            ->row();

        $html = "";
        if ($product_information->variants) {
            $exploded = explode(',', $product_information->variants);
            $html .= "<select id=\"variant_id\" class=\"form-control variant_id\" required=\"\" style=\"width:200px\">
			<option>Select Variant</option>";
            foreach ($exploded as $elem) {
                $this->db->select('*');
                $this->db->from('variant');
                $this->db->where('variant_id', $elem);
                $this->db->order_by('variant_name', 'asc');
                $result = $this->db->get()->row();

                $html .= "<option value=" . $result->variant_id . ">" . $result->variant_name . "</option>";
            }
            $html .= "</select>";
        }
        echo $html;
    }

    #===============Report paggination=============#
    public function pagination($per_page, $page, $date)
    {

        $product_id = $this->input->post('product_id', TRUE);
        $config = array();
        $config["base_url"] = base_url() . $page;
        $config["total_rows"] = $this->Reports->product_counter($product_id, $date);
        $config["per_page"] = $per_page;
        $config["uri_segment"] = 5;
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

        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        $limit = $config["per_page"];
        return $links = $this->pagination->create_links();
    }


    public function stock_by_variant($id)
    {
        $data = $this->Reports->get_stock_items($id);

        $content = $this->parser->parse('report/stock_report_by_variant', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function search_all_employees()
    {
        $name = $this->input->post('name', TRUE);

        $query = $this->db->query("SELECT * FROM `employee_history` WHERE (`first_name` LIKE '%" . $name . "%' OR `last_name` LIKE '%" . $name . "%' OR `id` = '" . $name . "')");
        $product_info = $query->result_array();
        $json_product = [];
        foreach ($product_info as $value) {
            $json_product[] = array('label' => $value['first_name'] . ' ' . $value['last_name'], 'value' => $value['id']);
        }

        echo json_encode($json_product);
    }

    public function search_all_cities()
    {
        $name = $this->input->post('name', TRUE);

        $query = $this->db->query("SELECT * FROM `employee_history` WHERE (`city` LIKE '%" . $name . "%' )");
        $product_info = $query->result_array();
        $json_product = [];
        foreach ($product_info as $value) {
            $json_product[] = array('label' => $value['city'], 'value' => $value['city']);
        }

        echo json_encode($json_product);
    }

    public function unpaid_installment()
    {
        $this->load->library('lreport');

        $from_date = $this->input->post('from_date', true);
        $to_date = $this->input->post('to_date', true);
        $customer_id = $this->input->post('customer_id', true);

        $content = $this->lreport->unpaid_installments($from_date, $to_date, $customer_id);
        $this->template_lib->full_admin_html_view($content);
    }

    public function products_balance()
    {
        $this->load->library('lreport');

        $from_date = $this->input->post('date_from', true);
        $to_date = $this->input->post('date_to', true);
        $store_id = $this->input->post('store_id', true);
        $product_id = $this->input->post('product_id', true);
        $product_name = $this->input->post('product_name', true);

        if (empty($product_name)) {
            $product_id = null;
        }

        $content = $this->lreport->get_products_balance($from_date, $to_date, $store_id, $product_id);
        $this->template_lib->full_admin_html_view($content);
    }
}
