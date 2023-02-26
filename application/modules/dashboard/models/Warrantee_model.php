<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Warrantee_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}

	public function invoice_wise_warrantee($invoice_no)
	{
		$this->db->select('a.created_at,a.date,b.*');
        $this->db->from('invoice a');
        $this->db->where('a.invoice',$invoice_no);
        $this->db->join('invoice_details b','b.invoice_id = a.invoice_id','left');
        $warrantee_detail=$this->db->get();
        if ($warrantee_detail->num_rows() > 0){
            return $warrantee_detail->result_array();
        }
        return false;
	}
	public function product_wise_warrantee($product_id)
	{
		$this->db->select('product_name,warrantee');
		$this->db->from('product_information');
		$this->db->where('product_id',$product_id);
		$product_wise = $this->db->get();
		if ($product_wise->num_rows() > 0){
			return $product_wise->row();
		}
		return false;
	}
}