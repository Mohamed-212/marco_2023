<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense_model extends CI_Model {

   public function create_expense_item($data = [])
    {    
            $expense_type =$data['expense_item_name'];
            $CreateBy=$this->session->userdata('id');
            $createdate=date('Y-m-d H:i:s');
            $coa = $this->headcode();
        
           if($coa->HeadCode!=NULL){
                $headcode=$coa->HeadCode+1;
           }else{
                $headcode="421005000001";
            }
            $expense = array(
      'expense_item_name' =>  $expense_type,
    ); 
        // coa head create   
     $expense_coa = [
             'HeadCode'         => $headcode,
             'HeadName'         => $expense_type,
             'PHeadName'        => 'Expenses of public utilities and services',
             'HeadLevel'        => '4',
             'IsActive'         => '1',
             'IsTransaction'    => '1',
             'IsGL'             => '0',
             'HeadType'         => 'E',
             'IsBudget'         => '1',
             'IsDepreciation'   => '1',
             'DepreciationRate' => '1',
             'CreateBy'         => $CreateBy,
             'CreateDate'       => $createdate,
        ];
              $this->db->insert('expense_item',$expense);
              $this->db->insert('acc_coa',$expense_coa);

    return true;
    }



     public function headcode(){
        $query=$this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='3' And HeadCode LIKE '42100500%' ORDER BY CreateDate DESC");
        return $query->row();

    }

    public function update_expense_item($data = [])
    {
        return $this->db->where('id',$data['id'])
            ->update('expense_item',$data); 
    } 


     public function single_expense_item_data($id){
        return $this->db->select('*')
            ->from('expense_item')
            ->where('id', $id)
            ->get()
            ->row();
    }

      public function expense_item_delete($id = null){
      $headname = $this->db->select('*')->from('expense_item')->where('id',$id)->get()->row()->expense_item_name;
             $this->db->where('HeadName',$headname)
            ->delete('acc_coa');
        $this->db->where('id',$id)
            ->delete('expense_item');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
  }


     public function expense_item_list(){
        return $this->db->select('*')
                        ->from('expense_item')
                        ->get()
                        ->result_array();
     }


        public function expense_insert(){
           $voucher_no = date('Ymdhis');
            $Vtype="Expense";
            $expense_type = $this->input->post('expense_type',true);
            $pay_type = $this->input->post('paytype',true);
            $cAID     = $this->input->post('cmbDebit',true);
            $Credit   = $this->input->post('amount',true);
            $VDate    = $this->input->post('dtpDate',true);
            $Narration=addslashes(trim($this->input->post('txtRemarks',true)));
            $IsPosted=1;
            $IsAppove=1;
            $CreateBy=$this->session->userdata('user_id');
            $createdate=date('Y-m-d H:i:s');
           $coid = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName',$expense_type)->get()->row()->HeadCode;
           $bank_id = $this->input->post('bank_id',true);

         $bankname = $this->db->select('bank_name')->from('bank_list')->where('bank_id',$bank_id)->get()->row()->bank_name;
         $coaid = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName',$bankname)->get()->row()->HeadCode;
  


            $expense = array(
      'voucher_no'     =>  $voucher_no,
      'type'           =>  $expense_type,
      'date'           =>  $VDate,
      'amount'         =>  $Credit,
    ); 
         // expense type credit  
     $expense_acc = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  $coid,
      'Narration'      =>  $expense_type.' Expense '.$voucher_no,
      'Debit'          =>  $Credit,
      'Credit'         =>  0,
      'IsPosted'       =>  1,
      'CreateBy'       =>  $CreateBy,
      'CreateDate'     =>  $createdate,
      'IsAppove'       =>  1
    ); 
     // bank credit
      $bankexpense = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  $coaid,
      'Narration'      =>  $bankname.' Expense '.$voucher_no,
      'Debit'          =>  0,
      'Credit'         =>  $Credit,
      'IsPosted'       =>  1,
      'CreateBy'       =>  $CreateBy,
      'CreateDate'     =>  $createdate,
      'IsAppove'       =>  1
    );
      // cash in hand credit
           $cashinhand = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  111000001,
      'Narration'      => $expense_type.' Expense'.$voucher_no,
      'Debit'          =>  0,
      'Credit'         =>  $Credit,
      'IsPosted'       =>  1,
      'CreateBy'       =>  $CreateBy,
      'CreateDate'     =>  $createdate,
      'IsAppove'       =>  1
    ); 

      $this->db->insert('expense',$expense);
      $this->db->insert('acc_transaction',$expense_acc);
        if($pay_type == 1){
        $this->db->insert('acc_transaction',$cashinhand);  
      }else{
       
        $this->db->insert('acc_transaction',$bankexpense);
      }
               


    return true;
}



     public function expense_list($limit = null, $start = null)
    {
             return $this->db->select('*')   
            ->from('expense')
            ->order_by('id', 'desc')
            ->limit($limit, $start)
            ->get()
            ->result_array();
    }


    public function expense_delete($id = null)
    {
        $this->db->where('voucher_no',$id)
            ->delete('expense');
             $this->db->where('VNo',$id)
            ->delete('acc_transaction');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
  

       public function get_expense_statement($expense,$from_date,$to_date){
        $this->db->select('*');
        $this->db->from('expense');
        if($expense){
        $this->db->where('type', $expense);
           }
        $this->db->where('date >=', $from_date);
        $this->db->where('date <=', $to_date);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

}

