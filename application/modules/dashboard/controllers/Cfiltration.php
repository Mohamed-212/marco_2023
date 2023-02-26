<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cfiltration extends MX_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('dashboard/cfiltration_model');
    }
    public function index($page = 0)
    {
        $this->permission->check_label('manage_filters')->read()->redirect();
    	$types = $this->cfiltration_model->get_all_types();
    	$data = array(
    		'title' => display('manage_filters'),
    		'types' => $types
    	);
    	$content = $this->parser->parse('dashboard/filtration/type_list',$data,true);
        $this->template_lib->full_admin_html_view($content);
    }
    public function add_filter()
    {
        $this->permission->check_label('add_filter')->create()->redirect();

    	$this->form_validation->set_rules('filter_type', display('filter_type'), 'trim|required');
    	$this->form_validation->set_rules('filter_names[]', display('filter_names'), 'trim|required');
    	if($this->form_validation->run() == TRUE)
    	{
    		$tdata = array(
    			'fil_type_name' => $this->input->post('filter_type', TRUE)
    		);
    		$result = $this->db->insert('filter_types', $tdata);
    		$type_id = $this->db->insert_id();
    		if($result){
    				$filter_names = $this->input->post('filter_names', TRUE);
		    		$tdata2 = [];
		    		foreach ($filter_names as $item) {
		    			$tdata2[] = array(
			    			'item_name' => $item,
			    			'type_id' => $type_id
			    		);
		    		}
		    		$this->db->insert_batch('filter_items', $tdata2);
		    		$category_ids = $this->input->post('category_ids', TRUE);
		    		
    			$this->session->set_flashdata('message', display('successfully_added'));
    		}else{
    			$this->session->set_flashdata('error_message', display('failed_try_again'));
    		}
    	}
    	$categories = $this->cfiltration_model->category_list_all();
    	$data = array(
    		'title' => display('add_filter'),
    		'categories' => $categories
    	);
    	$content = $this->parser->parse('dashboard/filtration/filter_add',$data,true);
        $this->template_lib->full_admin_html_view($content);
    }
    public function type_edit($id)
    {
        $this->form_validation->set_rules('filter_type', display('filter_type'), 'trim|required');
        $this->form_validation->set_rules('filter_names[]', display('filter_names'), 'trim|required');
        if($this->form_validation->run() == TRUE)
        {
            $tdata = array(
                'fil_type_name' => $this->input->post('filter_type', TRUE)
            );
            $result = $this->db->where('fil_type_id', $id)->update('filter_types', $tdata);
            if($result){
                $this->db->where('type_id', $id)->delete('filter_items');

                $filter_names = $this->input->post('filter_names', TRUE);
                $tdata2 = [];
                foreach ($filter_names as $item) {
                    $tdata2[] = array(
                        'item_name' => $item,
                        'type_id' => $id
                    );
                }
                $this->db->insert_batch('filter_items', $tdata2);

                $category_ids = $this->input->post('category_ids', TRUE);
                $tdata3 = [];
                foreach ($category_ids as $item) {
                    $tdata3[] = array(
                        'type_id' => $id,
                        'category_id' => $item
                    );
                }
                $this->db->where('type_id', $id)->delete('filter_type_category');
                $this->db->insert_batch('filter_type_category', $tdata3);
                $this->session->set_flashdata('message', display('successfully_updated'));
                redirect('dashboard/cfiltration');
            }else{
                $this->session->set_flashdata('error_message', display('failed_try_again'));
            }
        }
        $categories        = $this->cfiltration_model->category_list_all();
        $filter_type       = $this->cfiltration_model->get_filter_type($id);
        $filter_names      = $this->cfiltration_model->get_filter_names($id);
        $filter_categories = $this->cfiltration_model->get_filter_categories($id);
        $get_filter_categories=[];
        if (!empty($filter_categories)) {
            $get_filter_categories = array_column($filter_categories, 'category_id');
        }
        $data = array(
            'title'                 => display('edit_filter'),
            'categories'            => $categories,
            'filter_type'           => $filter_type,
            'filter_names'          => $filter_names,
            'get_filter_categories' => $get_filter_categories,
        );
        $content = $this->parser->parse('dashboard/filtration/filter_edit',$data,true);
        $this->template_lib->full_admin_html_view($content);
    }
    public function type_delete($id)
    {
        if($this->db->where('fil_type_id', $id)->delete('filter_types')){
            $this->db->where('type_id', $id)->delete('filter_type_category');
            $this->db->where('type_id', $id)->delete('filter_items');
            $this->session->set_flashdata('message', display('successfully_delete'));
            redirect('dashboard/cfiltration');
        }else{
            $this->session->set_flashdata('error_message', display('failed_try_again'));
            redirect('dashboard/cfiltration');
        }
        
    }
}