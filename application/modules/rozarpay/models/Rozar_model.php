<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 
class Rozar_model extends CI_Model{ 
        

    public function __construct()
    {
        parent::__construct();
    }
    
    public function read($select_items, $table, $where_array)
			{
				$this->db->select($select_items);
				$this->db->from($table);
				foreach ($where_array as $field => $value) {
					$this->db->where($field, $value);
					
				}
				return $this->db->get()->row();
			}
	public function customerorder($id){
		$this->db->select('order_menu.*,item_foods.*,variant.variantid,variant.variantName,variant.price');
        $this->db->from('order_menu');
		$this->db->join('item_foods','order_menu.menu_id=item_foods.ProductsID','left');
		$this->db->join('variant','order_menu.varientid=variant.variantid','left');
		$this->db->where('order_menu.order_id',$id);
		$query = $this->db->get();
		$orderinfo=$query->result();
	    return $orderinfo;
		}
	public function psetupById($id = null)
	{ 
		return $this->db->select("*")->from('paymentsetup')
			->where('setupid',$id) 
			->get()
			->row();
	} 
	// payment Dropdown
	public function payment_dropdown()
	{
		$data = $this->db->select("*")
			->from('payment_method')
			->get()
			->result();

		$list[''] = display('payment_name');
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->payment_method_id] = $value->payment_method;
			return $list;
		} else {
			return false; 
		}
	}
	public function psetupupdate($data = array())
	{
		return $this->db->where('setupid',$data["setupid"])
			->update('paymentsetup', $data);
	}

   

     
}