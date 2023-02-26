<?php defined('BASEPATH') or exit('No direct script access allowed');

class Employee_Contact_info extends CI_Model
{

    public function insert($empId, $data)
    {
        $arr = [];
        foreach ($data as $d) {
            if (empty($d['phone'])) continue;
            $d['customer_id'] = $empId;
            $arr[] = $d;
        }

        $this->db->insert_batch('employee_contact_info', $arr);
        return true;
    }

    public function allInfos($empId)
    {
        $this->db->select("*");
        $this->db->from("employee_contact_info");
        $this->db->where('customer_id', $empId);
        $query = $this->db->get();

        return $query->result();
    }

    public function deleteAll($empId)
    {
        return $this->db->delete('employee_contact_info', array('customer_id' => $empId));
    }

    public function update($empId, $data)
    {
        $this->deleteAll($empId);

        $this->insert($empId, $data);
    }
}
