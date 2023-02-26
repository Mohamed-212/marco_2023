<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Customer_contact_info extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert($data)
    {
        $this->db->insert('customer_contact_info', $data);
    }

    public function get_contact_info_data($customer_id)
    {
        $query = $this->db->select('*')->from('customer_contact_info')->where('customer_id', $customer_id)->get();

        if (!$query) return [];

        return $query->result();
    }

    public function update($data, $customer_id)
    {
        $this->db->set('name', $data['name'])
            ->set('phone', $data['phone'])
            ->set('address', $data['address'])
            ->where('id', $data['id'])
            ->where('customer_id', $customer_id)
            ->update('customer_contact_info');
    }

    public function deleteAll($customer_id)
    {
        $this->db->delete('customer_contact_info', array('customer_id' => $customer_id));
    }
}
