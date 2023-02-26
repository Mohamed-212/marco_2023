<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Suppliers extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //Count supplier
    public function count_supplier() {
        return $this->db->count_all("supplier_information");
    }

    //supplier List
    public function supplier_list() {
        $this->db->select('*');
        $this->db->from('supplier_information');
        $this->db->order_by('supplier_name', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //supplier List For Report
    public function supplier_list_report() {
        $this->db->select('*');
        $this->db->from('supplier_information');
        $this->db->order_by('supplier_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve company Edit Data
    public function retrieve_company() {
        $this->db->select('*');
        $this->db->from('company_information');
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //supplier Search List
    public function supplier_search_item($supplier_id) {
        $this->db->select('*');
        $this->db->from('supplier_information');
        $this->db->where('supplier_id', $supplier_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Product search item
    public function product_search_item($supplier_id, $product_name) {

        //$query = $this->db->query("SELECT * FROM `product_information` WHERE `assembly` = '0' AND `supplier_id` = '".$supplier_id."' AND  (`product_name` LIKE '%".$product_name."%' ESCAPE '!' OR `product_model` LIKE '%".$product_name."%')");

        if (strlen($product_name) > 6 && preg_match("/^[0-9]+/i", $product_name)) {
            $product_name = str_replace(2023, '', $product_name);
        }

        $query = $this->db->query("SELECT * FROM `product_information` WHERE `assembly` = '0' AND   (`product_name` LIKE '%" . $product_name . "%' ESCAPE '!' OR `product_model` LIKE '%" . $product_name . "%' OR `product_id` = '".$product_name."') ");

        return $query->result_array();
    }

    //Count supplier
    public function supplier_entry($data) {

        $this->db->select('*');
        $this->db->from('supplier_information');
        $this->db->where('supplier_name', $data['supplier_name']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {

            $result = $this->db->insert('supplier_information', $data);
            $supplier_id = $data['supplier_id'];
            // Insert chart of account data
            if ($result) {
                if (check_module_status('accounting') == 1) {
                    $this->load->model('accounting/account_model');
                    $this->account_model->insert_supplier_head($data, $supplier_id);

                    $previous_balance = $data['previous_balance'];
                    if (!empty($previous_balance)) {
                        $find_active_fiscal_year = $this->db->select('id')->from('acc_fiscal_year')->where('status', 1)->get()->row();
                        if (!empty($find_active_fiscal_year)) {
                            $headcode = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('supplier_id', $supplier_id)->get()->row();
                            $dtpDate = date('Y-m-d');
                            $datecheck = $this->fiscal_date_check($dtpDate);
                            if (!$datecheck) {
                                $this->session->set_userdata('error_message', 'Invalid date selection! Please select a date from active fiscal year.');
                                redirect('accounting/opening_balance');
                            }
                            $createby = $this->session->userdata('user_id');
                            $postData = array(
                                'fy_id' => $find_active_fiscal_year->id,
                                'headcode' => $headcode->HeadCode,
                                'amount' => $previous_balance,
                                'adjustment_date' => $dtpDate,
                                'created_by' => $createby,
                            );
                            if ($this->account_model->create_opening($postData)) {
                                $headcode = $headcode->HeadCode;
                                $headname = $this->db->select('HeadName')->from('acc_coa')->where('HeadCode', $headcode->HeadCode)->get()->row();
                                $createdate = date('Y-m-d H:i:s');
                                $date = $createdate;

                                $deposit_no     = $this->auth->generator(10);
                                $transaction_id = $this->auth->generator(15);
                        
                                //Data ready for transferring to customer_ledger
                                $balance_type=$this->input->post('balance_type', TRUE);
								if($balance_type==1)
								{
                                    $data = array(
                                        'transaction_id' =>  $transaction_id,
                                        'supplier_id'   =>  $supplier_id,
                                        'invoice_no'    =>  NULL,
                                        'deposit_no'    =>  $deposit_no,
                                        'amount'        =>  $previous_balance,
                                        'description'   =>  $this->input->post('details', true),
                                        'payment_type'  =>  1,
                                        'date'          =>  date('Y-m-d'),
                                        'status'        =>  1,
                                        'sl_created_at' => date('Y-m-d H:i:s')
                                    );
                                    $this->db->insert('supplier_ledger', $data);

                                    // add acc trans
                                    $customer_credit = array(
                                        'fy_id' => $find_active_fiscal_year->id,
                                        'VNo'   =>'OP-'.$headcode,
                                        'Vtype' => 'Sales',
                                        'VDate' => $date,
                                        'COAID' => $headcode, // account payable game 11
                                        'Narration' => 'Opening balance credired by customer id: ' .$headname->HeadName . '(' . $supplier_id . ')',
                                        'Debit' => 0,
                                        'Credit' =>$previous_balance,
                                        'is_opening' => 1,
                                        'IsPosted' => 1,
                                        'CreateBy' => $receive_by,
                                        'CreateDate' => $createdate,
                                        'IsAppove' => 1
                                        
                                    );
                                    $this->db->insert('acc_transaction', $customer_credit);

                                    $opening_balance_credit = array(
                                        'fy_id' => $find_active_fiscal_year->id,
                                        'VNo' => 'OP-' . $headcode,
                                        'Vtype' => 'Sales',
                                        'VDate' => $date,
                                        'COAID' => 3,
                                        'Narration' => 'Opening balance credired from "Owners Equity And Capital" from: ' . $headname->HeadName,
                                        'Debit' =>$previous_balance,
                                        'Credit' => 0,
                                        'is_opening' => 1,
                                        'IsPosted' => 1,
                                        'CreateBy' => $receive_by,
                                        'CreateDate' => $createdate,
                                        'IsAppove' => 1
                                    );
                                    $this->db->insert('acc_transaction', $opening_balance_credit);
                                }
                                else
                                {
                                    $data = array(
                                        'transaction_id' =>  $transaction_id,
                                        'supplier_id'   =>  $supplier_id,
                                        'invoice_no'    =>  NULL,
                                        'deposit_no'    =>  null,
                                        'amount'        =>  $previous_balance,
                                        'description'   =>  $this->input->post('details', true),
                                        'payment_type'  =>  1,
                                        'date'          =>  date('Y-m-d'),
                                        'status'        =>  1,
                                        'sl_created_at' => date('Y-m-d H:i:s')

                                    );
                                    $this->db->insert('supplier_ledger', $data);

                                    // add acc trans
                                    $customer_credit = array(
                                        'fy_id' => $find_active_fiscal_year->id,
                                        'VNo'   =>'OP-'.$headcode,
                                        'Vtype' => 'Sales',
                                        'VDate' => $date,
                                        'COAID' => $headcode, // account payable game 11
                                        'Narration' => 'Opening balance credired by customer id: ' .$headname->HeadName . '(' . $supplier_id . ')',
                                        'Debit' => $previous_balance,
                                        'Credit' =>0,
                                        'is_opening' => 1,
                                        'IsPosted' => 1,
                                        'CreateBy' => $receive_by,
                                        'CreateDate' => $createdate,
                                        'IsAppove' => 1
                                    );
                                    $this->db->insert('acc_transaction', $customer_credit);

                                    $opening_balance_credit = array(
                                        'fy_id' => $find_active_fiscal_year->id,
                                        'VNo' => 'OP-' . $headcode,
                                        'Vtype' => 'Sales',
                                        'VDate' => $date,
                                        'COAID' => 3,
                                        'Narration' => 'Opening balance credired from "Owners Equity And Capital" from: ' . $headname->HeadName,
                                        'Debit' => 0,
                                        'Credit' => $previous_balance,
                                        'is_opening' => 1,
                                        'IsPosted' => 1,
                                        'CreateBy' => $receive_by,
                                        'CreateDate' => $createdate,
                                        'IsAppove' => 1
                                    );
                                    $this->db->insert('acc_transaction', $opening_balance_credit);
                                }
                            }
                        }
                    }
                }
            }

            $this->db->select('*');
            $this->db->from('supplier_information');
            $this->db->where('status', 1);
            $query = $this->db->get();
            foreach ($query->result() as $row) {
                $json_product[] = array('label' => $row->supplier_name, 'value' => $row->supplier_id);
            }
            $cache_file = './my-assets/js/admin_js/json/supplier.json';
            $productList = json_encode($json_product);
            file_put_contents($cache_file, $productList);
            return TRUE;
        }
    }

    public function fiscal_date_check($date) {
        $fiscaldate = date('Y-m-d', strtotime($date));
        $this->db->select('id');
        $this->db->from('acc_fiscal_year');
        $this->db->where("DATE('" . $fiscaldate . "') BETWEEN DATE(start_date) AND DATE(end_date)");
        $this->db->where('status', '1');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //Retrieve supplier Edit Data
    public function retrieve_supplier_editdata($supplier_id) {
        $this->db->select('*');
        $this->db->from('supplier_information');
        $this->db->where('supplier_id', $supplier_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Update Categories
    public function update_supplier($data, $supplier_id) {
        $this->db->where('supplier_id', $supplier_id);
        $result = $this->db->update('supplier_information', $data);

        // Insert chart of account data
        if ($result) {
            $this->load->model('accounting/account_model');
            $this->account_model->update_supplier_head($data, $supplier_id);
        }

        $this->db->select('*');
        $this->db->from('supplier_information');
        $this->db->where('status', 1);
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $json_product[] = array('label' => $row->supplier_name, 'value' => $row->supplier_id);
        }
        $cache_file = './my-assets/js/admin_js/json/supplier.json';
        $productList = json_encode($json_product);
        file_put_contents($cache_file, $productList);
        return true;
    }

    // Delete supplier Item
    public function delete_supplier($supplier_id) {
        $result = $this->db->select('*')
                ->from('product_purchase')
                ->where('supplier_id', $supplier_id)
                ->get()
                ->num_rows();
        if ($result > 0) {
            $this->session->set_userdata(array('error_message' => display('you_cant_delete_this_supplier')));
            redirect('dashboard/Csupplier/manage_supplier');
        } else {
            $this->db->where('supplier_id', $supplier_id);
            $result = $this->db->delete('supplier_information');
            // Delete supplier head on coa
            if ($result) {
                $this->load->model('accounting/account_model');
                $this->account_model->delete_supplier_head($supplier_id);
            }
            $this->db->select('*');
            $this->db->from('supplier_information');
            $this->db->where('status', 1);
            $query = $this->db->get();
            foreach ($query->result() as $row) {
                $json_product[] = array('label' => $row->supplier_name, 'value' => $row->supplier_id);
            }
            $cache_file = './my-assets/js/admin_js/json/supplier.json';
            $productList = json_encode($json_product);
            file_put_contents($cache_file, $productList);
            return true;
        }
    }

    //Retrieve supplier Personal Data 
    public function supplier_personal_data($supplier_id) {
        $this->db->select('*');
        $this->db->from('supplier_information');
        $this->db->where('supplier_id', $supplier_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve Supplier All Data
    public function supplier_all_data() {
        $this->db->select('*');
        $this->db->from('supplier_information');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve Supplier Purchase Data 
    public function supplier_purchase_data($supplier_id) {
        $this->db->select('*');
        $this->db->from('product_purchase');
        $this->db->where(array('supplier_id' => $supplier_id, 'status' => 1));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Supplier Search Data
    public function supplier_search_list($cat_id, $company_id) {
        $this->db->select('a.*,b.sub_category_name,c.category_name');
        $this->db->from('suppliers a');
        $this->db->join('supplier_sub_category b', 'b.sub_category_id = a.sub_category_id');
        $this->db->join('supplier_category c', 'c.category_id = b.category_id');
        $this->db->where('a.sister_company_id', $company_id);
        $this->db->where('c.category_id', $cat_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //To get certain supplier's chalan info by which this company got products day by day
    public function suppliers_ledger1($supplier_id) {
        $this->db->select('*');
        $this->db->from('supplier_ledger');
        $this->db->where('supplier_ledger.supplier_id', $supplier_id);
        $this->db->order_by('supplier_ledger.invoice_no', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function suppliers_ledger($supplier_id, $from_date, $to_date) {
        $this->db->select('*');
        $this->db->from('supplier_ledger');
        $this->db->where('supplier_ledger.supplier_id', $supplier_id);
        if (!empty($from_date)) {
            $time1 = strtotime($from_date);
            $newformat1 = date('Y-m-d', $time1);
            // $this->db->where("STR_TO_DATE(supplier_ledger.date, '%Y-%m-%d')>=DATE('" . $newformat1. "')");
            $this->db->where("DATE(supplier_ledger.sl_created_at) >= DATE('" . date('Y-m-d', strtotime($newformat1)). "')");
        }
        if (!empty($to_date)) {
            $time2 = strtotime($to_date);
            $newformat2 = date('Y-m-d', $time2);
            // $this->db->where("STR_TO_DATE(supplier_ledger.date, '%Y-%m-%d')<=DATE('" . $newformat2. "')");
            $this->db->where("DATE(supplier_ledger.sl_created_at) <= DATE('" . date('Y-m-d', strtotime($newformat2)). "')");
        }
        $this->db->order_by('supplier_ledger.sl_created_at', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //supplier Balance report
    public function supplier_balance_report($from_date = null, $to_date = null) {
        $this->db->select('a.HeadCode,SUM(b.Debit) as total_debit,SUM(b.Credit) as total_credit,c.supplier_name,c.mobile,c.vat_no,c.cr_no');
        $this->db->from('acc_coa a');
        $this->db->where('a.supplier_id IS NOT NULL');
        $this->db->join('acc_transaction b', 'b.COAID = a.HeadCode', 'left');
        $this->db->join('supplier_information c', 'c.supplier_id = a.supplier_id', 'left');

        if (!empty($from_date)) {
            $time1 = strtotime($from_date);
            $newformat1 = date('Y-m-d', $time1);
            $this->db->where('b.VDate >=', $newformat1);
        }
        if (!empty($to_date)) {
            $time2 = strtotime($to_date);
            $newformat2 = date('Y-m-d', $time2);
            $this->db->where('b.VDate <=', $newformat2);
        }

        $this->db->group_by('b.COAID');
        return $this->db->get()->result_array();
    }

    //Retrieve supplier Transaction Summary
    public function suppliers_transection_summary1($supplier_id) {
        $result = array();
        $this->db->select_sum('amount', 'total_credit');
        $this->db->from('supplier_ledger');
        $this->db->where(array('supplier_id' => $supplier_id, 'deposit_no' => NULL, 'status' => 1));
        if (!empty($from_date)) {
            $time1 = strtotime($from_date);
            $newformat1 = date('m-d-Y', $time1);
            $this->db->where('date >=', $newformat1);
        }
        if (!empty($to_date)) {
            $time2 = strtotime($to_date);
            $newformat2 = date('m-d-Y', $time2);
            $this->db->where('date <=', $newformat2);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result[] = $query->result_array();
        }

        $this->db->select_sum('amount', 'total_debit');
        $this->db->from('supplier_ledger');
        if (!empty($from_date)) {
            $time1 = strtotime($from_date);
            $newformat1 = date('m-d-Y', $time1);
            $this->db->where('date >=', $newformat1);
        }
        if (!empty($to_date)) {
            $time2 = strtotime($to_date);
            $newformat2 = date('m-d-Y', $time2);
            $this->db->where('date <=', $newformat2);
        }
        $this->db->where('deposit_no IS NOT NULL');
        $this->db->where(array('supplier_id' => $supplier_id, 'status' => 1));
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result[] = $query->result_array();
        }
        return $result;
    }

    public function suppliers_transection_summary($supplier_id, $from_date, $to_date) {
        $result = array();
        $this->db->select_sum('amount', 'total_credit');
        $this->db->from('supplier_ledger');
        $this->db->where(array('supplier_id' => $supplier_id, 'status' => 1));
        $this->db->where('deposit_no IS NOT NULL');
        if (!empty($from_date)) {
            $time1 = strtotime($from_date);
            $newformat1 = date('Y-m-d', $time1);
            // $this->db->where("STR_TO_DATE(supplier_ledger.date, '%Y-%m-%d')>=DATE('" . $newformat1. "')");
            $this->db->where("DATE(supplier_ledger.sl_created_at) >= DATE('" . date('Y-m-d', strtotime($newformat1)). "')");
        }
        if (!empty($to_date)) {
            $time2 = strtotime($to_date);
            $newformat2 = date('Y-m-d', $time2);
            // $this->db->where("STR_TO_DATE(supplier_ledger.date, '%Y-%m-%d')<=DATE('" . $newformat2. "')");
            $this->db->where("DATE(supplier_ledger.sl_created_at) <= DATE('" . date('Y-m-d', strtotime($newformat2)). "')");
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result[] = $query->result_array();
        }
        $this->db->select_sum('amount', 'total_debit');
        $this->db->from('supplier_ledger');
        if (!empty($from_date)) {
            $time1 = strtotime($from_date);
            $newformat1 = date('Y-m-d', $time1);
            // $this->db->where("STR_TO_DATE(supplier_ledger.date, '%Y-%m-%d')>=DATE('" . $newformat1. "')");
            $this->db->where("DATE(supplier_ledger.sl_created_at) >= DATE('" . date('Y-m-d', strtotime($newformat1)). "')");
        }
        if (!empty($to_date)) {
            $time2 = strtotime($to_date);
            $newformat2 = date('Y-m-d', $time2);
            // $this->db->where("STR_TO_DATE(supplier_ledger.date, '%Y-%m-%d')<=DATE('" . $newformat2. "')");
            $this->db->where("DATE(supplier_ledger.sl_created_at) <= DATE('" . date('Y-m-d', strtotime($newformat2)). "')");
        }
        $this->db->where(array('supplier_id' => $supplier_id, 'status' => 1, 'deposit_no' => NULL));
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result[] = $query->result_array();
        }
        return $result;
    }

    //Findings a certain supplier products sales information
    public function supplier_sales_details($supplier_id) {
        $from_date = $this->input->post('from_date', TRUE);
        $to_date = $this->input->post('to_date', TRUE);

        $this->db->select('date,product_name,product_model,product_id,cartoon,quantity,supplier_rate,(quantity*supplier_rate) as total');
        $this->db->from('sales_report');
        $this->db->where('supplier_id', $supplier_id);
        if ($from_date != null AND $to_date != null) {
            $this->db->where('date >', $from_date . ' 00:00:00');
            $this->db->where('date <', $to_date . ' 00:00:00');
        }
        $this->db->order_by('date', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function supplier_sales_summary($supplier_id) {
        $from_date = $this->input->post('from_date', TRUE);
        $to_date = $this->input->post('to_date', TRUE);


        $this->db->select('date,product_name,product_model,product_id,sum(cartoon) as cartoon, sum(quantity) as quantity ,supplier_rate,sum(quantity*supplier_rate) as total');
        $this->db->from('sales_report');
        $this->db->where('supplier_id', $supplier_id);
        if ($from_date != null AND $to_date != null) {
            $this->db->where('date >=', $from_date . ' 00:00:00');
            $this->db->where('date <=', $to_date . ' 00:00:00');
        }
        $this->db->group_by('product_id,date,supplier_rate');
        $this->db->order_by('date', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }


        return false;
    }

    ################## Ssales & Payment Details ####################

    public function sales_payment_actual($supplier_id, $limit, $start_record, $from_date = null, $to_date = null) {
        $this->db->select('*');
        $this->db->from('sales_actual');
        $this->db->where('supplier_id', $supplier_id);
        if ($from_date != null AND $to_date != null) {
            $this->db->where('date >', $from_date . ' 00:00:00');
            $this->db->where('date <', $to_date . ' 00:00:00');
        }
        $this->db->limit($limit, $start_record);
        $this->db->order_by('date');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return false;
    }

    ################## total sales & payment information ####################

    public function sales_payment_actual_total($supplier_id) {
        $this->db->select_sum('sub_total');
        $this->db->from('sales_actual');
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where('sub_total >', 0);
        $query = $this->db->get();
        $result = $query->result_array();
        $data[0]["debit"] = $result[0]["sub_total"];

        $this->db->select_sum('sub_total');
        $this->db->from('sales_actual');
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where('sub_total <', 0);
        $query = $this->db->get();
        $result = $query->result_array();
        $data[0]["credit"] = $result[0]["sub_total"];

        $data[0]["balance"] = $data[0]["debit"] + $data[0]["credit"];

        return $data;
    }

    //To get certain supplier's payment info which was paid day by day
    public function supplier_paid_details($supplier_id) {
        $this->db->select('*');
        $this->db->from('supplier_ledger');
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where('chalan_no', NULL);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //To get certain supplier's chalan info by which this company got products day by day
    public function supplier_chalan_details($supplier_id) {
        $this->db->select('*');
        $this->db->from('supplier_ledger');
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where('deposit_no', NULL);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

}
