<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stock_adjustment_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	public function count_stock_adjustment_list()
	{
		$this->db->select('a.*');
        $this->db->from('stock_adjustment_table a');
        $query = $this->db->get();
        return $query->num_rows();
	}
	public function stock_adjustment_list($page, $per_page)
    {
        $this->db->select('a.*,b.store_name,c.first_name,c.last_name');
        $this->db->from('stock_adjustment_table a');
        $this->db->join('store_set b','b.store_id = a.store_id','left');
        $this->db->join('users c','c.user_id = a.created_by','left');
        $this->db->order_by('a.adjustment_id','desc');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;
    }
    public function adjustment_details($adjustment_id){
    	$this->db->select('a.*,b.*,c.variant_name,d.variant_name as variant_color,e.unit_short_name');
    	$this->db->from('stock_adjustment_details a');
    	$this->db->join('product_information b','b.product_id = a.product_id','left');
        $this->db->join('variant c','c.variant_id = a.variant_id','left');
        $this->db->join('variant d','d.variant_id = a.color_variant','left');
        $this->db->join('unit e','e.unit_id = b.unit','left');
    	$this->db->where('a.adjustment_id',$adjustment_id);
    	$query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;
    }

    public function product_adjustment_details($product_id){
    	$this->db->select('a.*,b.*,c.variant_name,d.variant_name as variant_color,e.unit_short_name');
    	$this->db->from('stock_adjustment_details a');
    	$this->db->join('product_information b','b.product_id = a.product_id','left');
        $this->db->join('variant c','c.variant_id = a.variant_id','left');
        $this->db->join('variant d','d.variant_id = a.color_variant','left');
        $this->db->join('unit e','e.unit_id = b.unit','left');
    	$this->db->where('a.product_id',$product_id);
    	$query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;
    }
}