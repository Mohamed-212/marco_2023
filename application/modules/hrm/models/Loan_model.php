<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loan_model extends CI_Model {

 
       public function submit_officeloan_person($data = []) {
       return $result = $this->db->insert('person_information', $data);
    }

       //Person  List
    public function office_loan_list($per_page, $limit) {
        $this->db->select('*');
        $this->db->from('person_information');
        $this->db->where('status', 1);
        $this->db->limit($per_page, $limit);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }


        public function office_person_list_count() {
        $this->db->select('*');
        $this->db->from('person_information');
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

        //Person  List Count
    public function person_list_count() {
        $this->db->select('*');
        $this->db->from('pesonal_loan_information');
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    public function office_loan_persons(){
    	$this->db->select('*');
        $this->db->from('person_information');
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

        public function select_person_by_id($person_id) {
        $this->db->select('*');
        $this->db->from('person_information');
        $this->db->where('person_id', $person_id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

      public function personledger_tradational($person_id) {
        $this->db->select('
            person_ledger.*,
            sum(person_ledger.debit) as debit,
            sum(person_ledger.credit) as credit
            ');
        $this->db->from('person_ledger');
        $this->db->where('person_id', $person_id);
        $this->db->order_by('date', 'desc');
        $this->db->group_by('transaction_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
   


       public function ledger_search_by_date($person_id, $from_date, $to_date) {
        $this->db->select('
            person_ledger.*,
            sum(person_ledger.debit) as debit,
            sum(person_ledger.credit) as credit
            ');
        $this->db->from('person_ledger');
        $this->db->where('person_id', $person_id);
        $this->db->where('date >=', $from_date);
        $this->db->where('date <=', $to_date);
        $this->db->group_by('transaction_id');
        $this->db->order_by('date','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

        //Submit payment
     public function submit_payment($data) {
        $result = $this->db->insert('person_ledger', $data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


        // submit person for personal loan
    public function submit_person_personal_loan($data) {
      return   $result = $this->db->insert('pesonal_loan_information', $data);
        
       
    }

        //personal loan limit 
    public function person_list_limt_loan($per_page, $limit) {
        $this->db->select('
                pesonal_loan_information.*,
                sum(personal_loan.debit) as debit,
                sum(personal_loan.credit) as credit
            ');
        $this->db->from('pesonal_loan_information');
        $this->db->join('personal_loan', 'pesonal_loan_information.person_id = personal_loan.person_id', 'left');
        $this->db->where('pesonal_loan_information.status', 1);
        $this->db->group_by('pesonal_loan_information.person_id');
        $this->db->limit($per_page, $limit);
        $this->db->order_by('pesonal_loan_information.id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }


        public function person_list_personal_loan() {
        $this->db->select('*');
        $this->db->from('pesonal_loan_information');
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
       }

        public function update_person($data, $person_id) {
        $this->db->where('person_id', $person_id);
        $result = $this->db->update('person_information', $data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_office_loan($id = null){
         $this->db->where('person_id',$id)
            ->delete('person_information');
             $this->db->select('*');
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    } 

         // personal loan person id selecetd
        public function select_loan_person_by_id($person_id) {
        $this->db->select('*');
        $this->db->from('pesonal_loan_information');
        $this->db->where('person_id', $person_id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

        //Personal loan detail ledger
    public function personal_loan_tradational($person_id) {

        $this->db->select('
            personal_loan.*,
            sum(personal_loan.debit) as debit,
            sum(personal_loan.credit) as credit
            ');
        $this->db->from('personal_loan');
        $this->db->where('person_id', $person_id);
        $this->db->group_by('transaction_id');
        $this->db->order_by('per_loan_id','asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }


        public function person_loan_search_by_date($person_id, $from_date, $to_date) {
        $this->db->select('
            personal_loan.*,
            sum(personal_loan.debit) as debit,
            sum(personal_loan.credit) as credit
            ');
        $this->db->from('personal_loan');
        $this->db->where('person_id', $person_id);
        $this->db->where('date >=', $from_date);
        $this->db->where('date <=', $to_date);
        $this->db->group_by('transaction_id');
        $this->db->order_by('per_loan_id','asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

       public function submit_loan_personal($data) {
        return $result = $this->db->insert('personal_loan', $data);
    }


        public function submit_payment_per_loan($data) {
        $result = $this->db->insert('personal_loan', $data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

     public function update_person_personal($data, $person_id) {
        $this->db->where('person_id', $person_id);
        $result = $this->db->update('pesonal_loan_information', $data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

      public function delete_personal_loan($id = null)
    {
         $this->db->where('person_id',$id)
            ->delete('personal_loan');
         $this->db->where('person_id',$id)
            ->delete('pesonal_loan_information');
        
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    } 
}

