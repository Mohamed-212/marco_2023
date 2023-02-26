<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cbatch_stock extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('dashboard/lbatch_stock');
        $this->load->model('dashboard/Brands');
        $this->auth->check_user_auth();

    }
    public function batch_wise_stock()
    {
        $this->permission->check_label('batch_wise_stock')->create()->redirect();
        $filter = array(
            'product_id' => $this->input->post('product_id',TRUE),
            'batch_no'   => $this->input->post('batch_no',TRUE)
        );
        $content = $this->lbatch_stock->batch_wise_stock($filter);
        $this->template_lib->full_admin_html_view($content);
    }
}