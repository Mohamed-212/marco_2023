<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Expriy_report_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	//Product List Count
	public function  product_list_count($filter){
        $this->db->select('product_purchase_details.product_id,product_purchase_details.batch_no,product_purchase_details.expiry_date,product_purchase_details.quantity,product_information.product_name');
    	$this->db->from('product_purchase_details');
    	$this->db->join('product_information','product_information.product_id = product_purchase_details.product_id');
    	if(!empty($filter['product_name'])){
            $this->db->like('product_information.product_name', $filter['product_name'],'both');
        }
    	if(!empty($filter['batch_no'])){
            $this->db->like('product_purchase_details.batch_no', $filter['batch_no'],'both');
        }
        if(!empty($filter['from_date'])&&empty($filter['to_date'])){
        	$end_date  =date("Y-m-d");
        	$start_date=date('Y-m-d', strtotime($filter["from_date"]));
        	$date_range="DATE(product_purchase_details.expiry_date) BETWEEN '$start_date' AND '$end_date'";
           	$this->db->where($date_range);
        }elseif (!empty($filter['from_date'])&&!empty($filter['to_date'])) {
        	$end_date  = date('Y-m-d', strtotime($filter['to_date']));
        	$start_date=date('Y-m-d', strtotime($filter["from_date"]));
        	$date_range="DATE(product_purchase_details.expiry_date) BETWEEN '$start_date' AND '$end_date'";
           	$this->db->where($date_range);
        }
        $this->db->where('product_purchase_details.expiry_date is NOT NULL', NULL, FALSE);
        $query = $this->db->get();
        return $query->num_rows();
	}

	//Product List
    public function product_list($filter = null,$per_page = null, $page = null)
    {
    	$this->db->select('product_purchase_details.product_id,product_purchase_details.batch_no,product_purchase_details.expiry_date,product_purchase_details.quantity,product_information.product_name');
    	$this->db->from('product_purchase_details');
    	$this->db->join('product_information','product_information.product_id = product_purchase_details.product_id');
    	if(!empty($filter['product_name'])){
            $this->db->like('product_information.product_name', $filter['product_name'],'both');
        }
    	if(!empty($filter['batch_no'])){
            $this->db->like('product_purchase_details.batch_no', $filter['batch_no'],'both');
        }
        if(!empty($filter['from_date'])&&empty($filter['to_date'])){
        	$end_date  =date("Y-m-d");
        	$start_date=date('Y-m-d', strtotime($filter["from_date"]));
        	$date_range="DATE(product_purchase_details.expiry_date) BETWEEN '$start_date' AND '$end_date'";
           	$this->db->where($date_range);
        }elseif (!empty($filter['from_date'])&&!empty($filter['to_date'])) {
        	$end_date  = date('Y-m-d', strtotime($filter['to_date']));
        	$start_date=date('Y-m-d', strtotime($filter["from_date"]));
        	$date_range="DATE(product_purchase_details.expiry_date) BETWEEN '$start_date' AND '$end_date'";
           	$this->db->where($date_range);
        }
        $this->db->where('product_purchase_details.expiry_date is NOT NULL', NULL, FALSE);
	    $this->db->limit($per_page, $page);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;
    }
}