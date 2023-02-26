<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Settings extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	//Bank list
	public function get_bank_list()
	{
		$this->db->select('*');
		$this->db->from('bank_list');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Get bank by id
	public function get_bank_by_id($bank_id)
	{
		$this->db->select('*');
		$this->db->from('bank_list');
		$this->db->where('bank_id',$bank_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	//Bank update by id
	public function bank_update_by_id($bank_id)
	{
		$data = array(
			'bank_name'	=>	$this->input->post('bank_name',TRUE),
			'ac_name'	=>	$this->input->post('ac_name',TRUE),
			'branch'	=>	$this->input->post('branch',TRUE),
			'ac_number' =>	$this->input->post('ac_number',TRUE),
		);
		// create bank head start
        if(check_module_status('accounting') == 1){
            $this->load->model('accounting/account_model');
            if(check_module_status('accounting') == 1){
            	$check_bank = $this->db->select('*')->from('acc_coa')->where('bank_id',$bank_id)->get()->row();
            	if (empty($check_bank)) {
            		$PHead = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('HeadCode','112')->get()->row();
                    if (!empty($PHead)) {
                        $childCount= $this->db->select('MAX(HeadCode) as HeadCode')->from('acc_coa')->where('PHeadCode','112')->get()->row();
                        if(!empty($childCount)){
                            $HeadCode = $childCount->HeadCode+2;
                        }else{
                            $HeadCode='1121';
                        }
                        $c_acc=$bank_id.' - '.$this->input->post('bank_name',TRUE);
                        $createby=$this->session->userdata('user_name');
                        $createdate=date('Y-m-d H:i:s');
                        $bank_coa = [
                          'HeadCode'     =>$HeadCode,
                          'HeadName'     =>$c_acc,
                          'PHeadName'    =>$PHead->HeadName,
                          'PHeadCode'    =>$PHead->HeadCode,
                          'HeadLevel'    =>'3',
                          'IsActive'     =>'1',
                          'IsTransaction'=>'1',
                          'IsGL'         =>'0',
                          'HeadType'     =>'A',
                          'bank_id'      =>$bank_id,
                          'CreateBy'     =>$createby,
                          'CreateDate'   =>$createdate,
                        ];
                        $this->db->insert('acc_coa', $bank_coa);
                    }
            	}
            }
        }
        // create bank head END
		$this->db->where('bank_id',$bank_id);
		$this->db->update('bank_list',$data); 
		return true;
	}
	//Bank entry
	public function bank_entry( $data )
	{
		$this->db->insert('bank_list',$data);
	}
}