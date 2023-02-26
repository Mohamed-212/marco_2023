<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stock_opening_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	public function product_search_item($product_name){
		$query = $this->db->query("SELECT * FROM `product_information` WHERE `assembly` = '0' AND (`product_name` LIKE '%".$product_name."%' ESCAPE '!' OR `product_model` LIKE '%".$product_name."%')");
		return $query->result_array();
	}
	public function check_stock($store_id=null,$product_id=null,$variant=null,$variant_color=null)
	{
		$this->db->select('stock_id,quantity');
		$this->db->from('purchase_stock_tbl');
		if (!empty($store_id)) {
			$this->db->where('store_id',$store_id);
		}
		if (!empty($product_id)) {
			$this->db->where('product_id',$product_id);
		}
		if (!empty($variant)) {
			$this->db->where('variant_id',$variant);
		}
		if (!empty($variant_color)) {
			$this->db->where('variant_color',$variant_color);
		}
		$query = $this->db->get();
		return $query->row();
	}
}