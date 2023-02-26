<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Batch_wise_stock_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	public function batch_wise_product($filter=null)
	{
		$this->db->select('a.*,b.product_name,b.price,b.supplier_price');
		$this->db->from('product_purchase_details a');
		if (!empty($filter['product_id']) && empty($filter['batch_no'])){
			$this->db->where('a.product_id ', $filter['product_id']);
		}elseif (empty($filter['product_id']) && !empty($filter['batch_no'])) {
			$this->db->where('a.batch_no ', $filter['batch_no']);
		}elseif (!empty($filter['product_id']) && !empty($filter['batch_no'])) {
			$this->db->where('a.product_id ', $filter['product_id']);
			$this->db->where('a.batch_no ', $filter['batch_no']);
		}
		$this->db->join('product_information b','b.product_id = a.product_id');
		$this->db->where('a.batch_no is NOT NULL', NULL, FALSE);
		$this->db->group_by('a.batch_no');
		$this->db->order_by('a.batch_no','desc');
		$product = $this->db->get();
		if($product->num_rows()){
			return $product->result_array();
		}
		return false;
	}

	public function batch_wise_invoice_details($batch_no){
		$this->db->select('SUM(quantity) AS total_sale');
		$this->db->from('invoice_details');
		$this->db->where('batch_no',$batch_no);
		$invoice_details = $this->db->get();
		if ($invoice_details->num_rows()>0) {
			
			$invoice_details->result_array();
			return $invoice_details->result_array();
			
		}
		return array(array('total_sale'=>0));
	}
}