<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_model extends CI_Model {

    public function atten_create($data = array())
    {
        return $this->db->insert('attendance', $data);
    }

    public function signout($data = [])
    {
        return $this->db->where('att_id',$data['att_id'])
            ->update('attendance',$data); 
    } 




    public function delete_attendance($id){
        $this->db->where('att_id', $id)
            ->delete("attendance");
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }


    public function attn_updateForm($id){
        $this->db->where('att_id',$id);
        $query = $this->db->get('attendance');
        return $query->result_array();
    }

    public function attendance_list_count(){
     $this->db->select('*');
    $this->db->from('attendance');
    $this->db->order_by('att_id', 'DESC');
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->num_rows();
    }
    return false;

    }

       public function manage_attendance($per_page = null, $page = null) {
        $this->db->select('a.*,b.first_name,b.last_name');
        $this->db->from('attendance a');
        $this->db->join('employee_history b','a.employee_id=b.id');
        $this->db->order_by('a.att_id', 'DESC');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }


     public function designation_list(){
        return $this->db->select('*')
                        ->from('designation')
                        ->get()
                        ->result_array();
     }

      public function employee_dropdown()
    {
        $this->db->select('*');
        $this->db->from('employee_history');
        $query=$this->db->get();
        $data=$query->result();
        
       $list = array('' => 'Select One...');
        if(!empty($data)){
            foreach ($data as $value){
                $list[$value->id]=$value->first_name.' '.$value->last_name."(".$value->id.")";
            }
        }
        return $list;
    }

       //attendance List
    public function attendance_list() {
        $date = date('Y-m-d');
        $query =$this->db->select("count(DISTINCT(e.att_id)) as att_id,e.*,p.id,p.first_name,p.last_name")->join('employee_history p','e.employee_id = p.id','left')->where('e.date',$date)->group_by('e.att_id')->order_by('e.att_id', 'desc')->get('attendance e');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    public function datewiseReport($format_start_date,$format_end_date){
    $this->db->select('e.*,count(DISTINCT(p.id)) as emp_his_id,p.id,p.first_name,p.last_name');
    $this->db->from('attendance e');
    $this->db->join('employee_history p','e.employee_id = p.id','left');
    $this->db->where('e.date >=', $format_start_date);
    $this->db->where('e.date <=', $format_end_date);
    $this->db->group_by('e.att_id');
    $query = $this->db->get();
    $result = $query->result();
    return $result;

    }

       public function check_exist($employee_id,$date){
        $this->db->select('*');
        $this->db->from('attendance');
        $this->db->where('employee_id', $employee_id);
        $this->db->where('date', $date);
        $query = $this->db->get();
            return $query->num_rows();
     
    }

    public function emp_information($id){
    $this->db->select('a.*,b.designation as emdesignation');
    $this->db->from('employee_history a');
    $this->db->join('designation b','a.designation=b.id');
    $this->db->where('a.id',$id);
    $ab = $this->db->get();
    return $ab->result_array();
}

  function search($id,$start_date,$end_date)
    {
        if (!empty($id)){
        $this->db->from('attendance');
        $this->db->like('employee_id', $id);
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date); 
        $query = $this->db->get();
        return $query->result();
        }
        else {echo 'Sorry Enter Employee Id';}
    }

}

