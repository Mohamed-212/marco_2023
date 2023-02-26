<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cexpriy_report extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard/expriy_report_model');
        $this->load->library('dashboard/lexpriy_report');
        $this->auth->check_user_auth();

    }
    public function expriy_report_index()
    {
        $this->permission->check_label('expriy_report_index')->read()->redirect();
        $filter = array(
            'product_name' => $this->input->get('product_name',TRUE),
            'batch_no'     => $this->input->get('batch_no',TRUE),
            'from_date'    => $this->input->get('from_date',TRUE),
            'to_date'      => $this->input->get('to_date',TRUE),
        );
        #
        #pagination starts
        #
        $config["base_url"]    = base_url('dashboard/cexpriy_report/expriy_report_index/');
        $config["total_rows"]  = $this->expriy_report_model->product_list_count($filter);
        $config["per_page"]    = 20;
        $config["uri_segment"] = 4;
        $config["num_links"]   = 5;
        /* This Application Must Be Used With BootStrap 3 * */
        $config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tag_close']   = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tagl_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tagl_close']  = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $links = $this->pagination->create_links();
        #
        #pagination ends
        #
        $content = $this->lexpriy_report->product_list($filter,$links,$config["per_page"],$page);
        $this->template_lib->full_admin_html_view($content);
    }

    //Product List
    public function product_list($filter = null,$per_page = null, $page = null)
    {
        $is_aff = false;
        if(check_module_status('affiliate_products') == 1){
            $is_aff = true;
        }
        $this->db->select('
            supplier_information.supplier_name,
            product_information.product_id,
            product_information.product_name,
            product_information.product_model,
            product_information.unit,
            product_information.price,
            product_information.supplier_price,
            product_information.onsale_price,
            product_information.image_thumb,
            product_category.category_name,
            unit.unit_short_name');  
        $this->db->from('product_information');
        $this->db->join('supplier_information', 'product_information.supplier_id = supplier_information.supplier_id', 'left');
        $this->db->join('product_category', 'product_category.category_id = product_information.category_id', 'left');
        $this->db->join('unit', 'unit.unit_id = product_information.unit', 'left');
        if(!empty($filter['product_name'])){
            $this->db->like('product_information.product_name', $filter['product_name'],'both');
        }
        if(!empty($filter['supplier_id'])){
            $this->db->where('product_information.supplier_id', $filter['supplier_id']);
        }
        if(!empty($filter['category_id'])){
            $this->db->where('product_information.category_id', $filter['category_id']);
        }
        if(!empty($filter['unit_id'])){
            $this->db->where('product_information.unit', $filter['unit_id']);
        }
        if(!empty($filter['model_no'])){
            $this->db->like('product_information.product_model', $filter['model_no'],'both');
        }
        if($is_aff){
            $this->db->where('product_information.is_affiliate IS NULL');
        }
        $this->db->limit($per_page, $page);
        $this->db->order_by('product_information.product_name','asc');
        $this->db->group_by('product_information.product_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;
    }
}