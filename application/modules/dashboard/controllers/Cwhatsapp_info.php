<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cwhatsapp_info extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->auth->check_user_auth();
        $this->load->model(array('dashboard/Whatsapp_info'));
        $this->load->library('dashboard/occational');
    }
    //Default invoice add from loading
    public function whatsapp_info()
    {
        $whatsapp_info_details = $this->db->select('*')->from('whatsapp_info_table')->get()->row();
        $data = array(
            'title' => display('whatsapp_info'),
            'whatsapp_info_details' => $whatsapp_info_details,
        );
        $data['module'] = "dashboard";
        $data['page'] = "whatsapp_info/whatsapp_info_form";
        echo Modules::run('template/layout', $data);
    }
    public function whatsapp_info_insert()
    {
        $whatsapp_info_details = $this->db->select('*')->from('whatsapp_info_table')->get()->row();
        if(empty($whatsapp_info_details)){
            $data = array('whatsapp_number' => $this->input->post('whatsapp_number',TRUE));
            $result = $this->db->insert('whatsapp_info_table',$data);
        }else{
            $whatsapp_id = $this->input->post('whatsapp_id',TRUE);
            $data = array('whatsapp_number' => $this->input->post('whatsapp_number',TRUE));
            $this->db->where('id',$whatsapp_id);
            $result = $this->db->update('whatsapp_info_table',$data);
        }
        if($result){
            $this->session->set_userdata(array('message' => display('successfully_updated')));
            return redirect(base_url('dashboard/Cwhatsapp_info/whatsapp_info'));
        }else{
            $this->session->set_userdata(array('error_message' => display('ooops_something_went_wrong')));
            return redirect(base_url('dashboard/Cwhatsapp_info/whatsapp_info'));
        }
    }
}