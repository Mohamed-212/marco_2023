<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hrm_model extends CI_Model {

   public function create_designation($data = [])
    {    
        return $this->db->insert('designation',$data);
    }

    public function update_designation($data = [])
    {
        return $this->db->where('id',$data['id'])
            ->update('designation',$data); 
    } 


     public function single_designation_data($id){
        return $this->db->select('*')
            ->from('designation')
            ->where('id', $id)
            ->get()
            ->row();
    }

    public function delete_designation($id){
        $this->db->where('id', $id)
            ->delete("designation");
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }


     public function designation_list(){
        return $this->db->select('*')
                        ->from('designation')
                        ->get()
                        ->result_array();
     }

     /*employee part*/
     public function single_employee_data($id){
        return $this->db->select('*')
            ->from('employee_history')
            ->where('id', $id)
            ->get()
            ->row();
     }

     public function create_employee($data = []){
          $this->db->insert('employee_history',$data);

          $id =$this->db->insert_id();
      $coa = $this->headcode();
     
           if($coa->HeadCode!=NULL){
                $headcode=$coa->HeadCode+1;
           }else{
                $headcode="2116000001";
            }
    $c_acc=$id.'-'.$data['first_name'].''.$data['last_name'];
    $createby=$this->session->userdata('user_id');
    $createdate=date('Y-m-d H:i:s');
    $employee_coa = [
             'HeadCode'         => $headcode,
             'HeadName'         => $c_acc,
             'PHeadName'        => 'Employee Ledger',
             'HeadLevel'        => '4',
             'IsActive'         => '1',
             'IsTransaction'    => '1',
             'IsGL'             => '0',
             'HeadType'         => 'L',
             'IsBudget'         => '0',
             'IsDepreciation'   => '0',
             'DepreciationRate' => '0',
             'CreateBy'         => $createby,
             'CreateDate'       => $createdate,
        ];
        $this->db->insert('acc_coa',$employee_coa);
        return $id;
     }

        public function headcode(){
        $query=$this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='4' And HeadCode LIKE '2116000%'");
        return $query->row();

    }

      public function designation_dropdown(){
        $this->db->select('*');
        $this->db->from('designation');
        $query=$this->db->get();
        $data=$query->result();
        $list[''] = display('select_option');
        if(!empty($data)){
            foreach ($data as  $value) {
                $list[$value->id]=$value->designation;
            }
        }
        return $list;
    }


    public function update_employee($data = []){
         return $this->db->where('id',$data['id'])
            ->update('employee_history',$data); 
            
    }

       // Employee list
      public function employee_list(){
        $this->db->select('a.*,b.designation');
        $this->db->from('employee_history a');
        $this->db->join('designation b','a.designation = b.id');
        $this->db->order_by('a.id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
   }

      public function employee_details($id){
        $this->db->select('a.*,b.designation');
        $this->db->from('employee_history a');
        $this->db->join('designation b','a.designation = b.id');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
   }

     public function delete_employee($id){
        $this->db->where('id', $id)
            ->delete("employee_history");
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

}

