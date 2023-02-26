<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Customers extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	//Count customer
	public function count_customer()
	{
		return $this->db->count_all("customer_information");
	}
	//Customer List
	public function customer_list()
	{
		$this->db->select('*');
		$this->db->from('customer_information');
		$this->db->order_by('customer_name', 'asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}

	//Country List
	public function country_list()
	{
		$this->db->select('*');
		$this->db->from('countries');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}

	//Select City By Country ID List
	public function select_city_country_id($country_id)
	{
		$this->db->select('*');
		$this->db->from('states');
		$this->db->where('country_id', $country_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return false;
	}

	//Credit customer List
	public function credit_customer_list()
	{

		$query = $this->db->query("

			select `customer_information`.`customer_name` AS `customer_name`,
			`customer_ledger`.`customer_id` AS `customer_id`,
			'credit' AS `type`,
			sum(-(`customer_ledger`.`amount`)) AS `amount` 
			from (`customer_ledger` 
			join `customer_information` 
			on((`customer_information`.`customer_id` = `customer_ledger`.`customer_id`))) 
			where (isnull(`customer_ledger`.`receipt_no`) 
			and (`customer_ledger`.`status` = 1)) 
			group by `customer_ledger`.`customer_id` 
			union all 
			select `customer_information`.`customer_name` AS `customer_name`,
			`customer_ledger`.`customer_id` AS `customer_id`,
			'debit' AS `type`,sum(`customer_ledger`.`amount`) AS `amount` 
			from (`customer_ledger` join `customer_information` 
			on((`customer_information`.`customer_id` = `customer_ledger`.`customer_id`))) 
			where (isnull(`customer_ledger`.`invoice_no`) 
			and (`customer_ledger`.`status` = 1)) 
			group by `customer_ledger`.`customer_id`");


		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}

	//Paid Customer list
	public function paid_customer_list()
	{
		$this->db->select('customer_information.*,sum(customer_transection_summary.amount) as customer_balance');
		$this->db->from('customer_information');
		$this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');
		$this->db->where('customer_transection_summary.amount >', 0);
		$this->db->group_by('customer_transection_summary.customer_id');
		$this->db->limit('50');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}

	//Customer Search List
	public function customer_search_item($customer_id)
	{
		$this->db->select('customer_information.*,sum(customer_transection_summary.amount) as customer_balance');
		$this->db->from('customer_information');
		$this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');
		$this->db->where('customer_information.customer_id', $customer_id);
		$this->db->group_by('customer_transection_summary.customer_id');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	//Count customer
	public function customer_entry($data)
	{

		$this->db->select('*');
		$this->db->from('customer_information');
		$this->db->where('customer_name', $data['customer_name']);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return FALSE;
		} else {
			if (isset($data['password']) && !empty($data['password'])) {
				$data['password'] = md5("gef" . $this->input->post('password', TRUE));
			}
			$result = $this->db->insert('customer_information', $data);
			$customer_id = $data['customer_id'];
			if ($result) {
				if (check_module_status('accounting') == 1) {
					$this->load->model('accounting/account_model');
					$this->account_model->insert_customer_head($data);

					$previous_balance = $data['previous_balance'];
					if (!empty($previous_balance)) {
						$find_active_fiscal_year = $this->db->select('id')->from('acc_fiscal_year')->where('status', 1)->get()->row();
						if (!empty($find_active_fiscal_year)) {
							$headcode = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('customer_id', $customer_id)->get()->row();
							$dtpDate = date('Y-m-d');
							$datecheck = $this->fiscal_date_check($dtpDate);
							if (!$datecheck) {
								$this->session->set_userdata('error_message', 'Invalid date selection! Please select a date from active fiscal year.');
								redirect('accounting/opening_balance');
							}
							$createby   = $this->session->userdata('user_id');
							$postData = array(
								'fy_id'          => $find_active_fiscal_year->id,
								'headcode'       => $headcode->HeadCode,
								'amount'         => $previous_balance,
								'adjustment_date' => $dtpDate,
								'created_by'     => $createby,
							);
							if ($this->account_model->create_opening($postData)) {
								$headcode  = $headcode->HeadCode;
								$headname  = $this->db->select('HeadName')->from('acc_coa')->where('HeadCode', $headcode->HeadCode)->get()->row();
								$createdate = date('Y-m-d H:i:s');
								$date      = $createdate;
								$balance_type = $this->input->post('balance_type', TRUE);
								if ($balance_type == 1) {
									// credit
									// add to customer ledger
									$customer_ledger_data = array(
										'transaction_id' => generator(15),
										'customer_id' => $customer_id,
										'date' => $date,
										'amount' => $previous_balance,
										'payment_type' => 1,
										'description' => 'ITP',
										'status' => 1,
										'cl_created_at' => date('Y-m-d H:i:s'),
										'details' => 'رصيد إبتدائى ماقبل',
										'voucher' => 'Pb',
										'acc' => 'OP-' . $headcode
									);
									$this->db->insert('customer_ledger', $customer_ledger_data);

									// add acc trans
									$customer_credit = array(
										'fy_id' => $find_active_fiscal_year->id,
										'VNo'   => 'OP-' . $headcode,
										'Vtype' => 'Sales',
										'VDate' => $date,
										'COAID' => $headcode, // account payable game 11
										'Narration' => 'Opening balance credired by customer id: ' . $headname->HeadName . '(' . $customer_id . ')',
										'Debit' => 0,
										'Credit' => $previous_balance,
										'IsPosted' => 1,
										'CreateBy' => $createby,
										'CreateDate' => $createdate,
										'IsAppove' => 1
									);
									$this->db->insert('acc_transaction', $customer_credit);

									$opening_balance_debit = array(
										'fy_id'     => $find_active_fiscal_year->id,
										'VNo'       => 'OP-' . $headcode,
										'Vtype'     => 'Sales',
										'VDate'     => $date,
										'COAID'     => 3,
										'Narration' => 'Opening balance dibited from "Owners Equity And Capital" from: ' . $headname->HeadName,
										'Debit'     => $previous_balance,
										'Credit'    => 0,
										'is_opening' => 1,
										'IsPosted'  => 1,
										'CreateBy'  => $createby,
										'CreateDate' => $createdate,
										'IsAppove'  => 1
									);
									$this->db->insert('acc_transaction', $opening_balance_debit);
								} elseif ($balance_type == 2) {
									// debit
									// add to customer ledger
									$customer_ledger_data = array(
										'transaction_id' => generator(15),
										'receipt_no' => $this->auth->generator(15),
										'customer_id' => $customer_id,
										'date' => $date,
										'amount' => $previous_balance,
										'status' => 1,
										'cl_created_at' => date('Y-m-d H:i:s'),
										'details' => 'رصيد إبتدائى ماقبل',
										'voucher' => 'Pb',
										'acc' => 'OP-' . $headcode
									);
									$this->db->insert('customer_ledger', $customer_ledger_data);

									// add acc trans
									$customer_debit = array(
										'fy_id' => $find_active_fiscal_year->id,
										'VNo'   => 'OP-' . $headcode,
										'Vtype' => 'Sales',
										'VDate' => $date,
										'COAID' => $headcode, // account payable game 11
										'Narration' => 'Opening balance debited by customer id: ' . $headname->HeadName . '(' . $customer_id . ')',
										'Debit' => $previous_balance,
										'Credit' => 0,
										'IsPosted' => 1,
										'CreateBy' => $createby,
										'CreateDate' => $createdate,
										'IsAppove' => 1
									);
									$this->db->insert('acc_transaction', $customer_debit);

									$opening_balance_credit = array(
										'fy_id'     => $find_active_fiscal_year->id,
										'VNo'       => 'OP-' . $headcode,
										'Vtype'     => 'Sales',
										'VDate'     => $date,
										'COAID'     => 3,
										'Narration' => 'Opening balance credited from "Owners Equity And Capital" from: ' . $headname->HeadName,
										'Debit'     => 0,
										'Credit'    => $previous_balance,
										'is_opening' => 1,
										'IsPosted'  => 1,
										'CreateBy'  => $createby,
										'CreateDate' => $createdate,
										'IsAppove'  => 1
									);
									$this->db->insert('acc_transaction', $opening_balance_credit);
								}
							}
						}
					}
				}
			}


			$this->db->select('*');
			$this->db->from('customer_information');
			$this->db->order_by('customer_name', 'asc');
			$query = $this->db->get();
			foreach ($query->result() as $row) {
				$json_customer[] = array('label' => $row->customer_name . (!empty($row->customer_mobile) ? ' (' . $row->customer_mobile . ')' : ''), 'value' => $row->customer_id);
			}
			$cache_file = './my-assets/js/admin_js/json/customer.json';
			$customerList = json_encode($json_customer);
			file_put_contents($cache_file, $customerList);
			return TRUE;
		}
	}

	public function fiscal_date_check($date)
	{
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

	//Customer Previous balance adjustment
	public function previous_balance_add($balance, $customer_id)
	{
		$this->load->library('auth');
		$transaction_id = $this->auth->generator(10);
		$data = array(
			'transaction_id' => $transaction_id,
			'customer_id' 	=> $customer_id,
			'invoice_no' 	=> "NA",
			'receipt_no' 	=> NULL,
			'amount' 		=> $balance,
			'description' 	=> "Previous adjustment with software",
			'payment_type' 	=> "NA",
			'cheque_no' 	=> "NA",
			'date' 			=> date("Y-m-d"),
			'status' 		=> 1,
			'details' => 'رصيد إبتدائى ماقبل',
			'voucher' => 'Pb',
		);

		$this->db->insert('customer_ledger', $data);
	}

	//Retrieve company Edit Data
	public function retrieve_company()
	{
		$this->db->select('*');
		$this->db->from('company_information');
		$this->db->limit('1');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	//Retrieve customer Edit Data
	public function retrieve_customer_editdata($customer_id)
	{
		$this->db->select('*');
		$this->db->from('customer_information');
		$this->db->where('customer_id', $customer_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	//Retrieve customer Personal Data 
	public function customer_personal_data($customer_id)
	{
		$this->db->select('*');
		$this->db->from('customer_information');
		$this->db->where('customer_id', $customer_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	//Retrieve customer Invoice Data 
	public function customer_invoice_data($customer_id)
	{
		$this->db->select('*');
		$this->db->from('customer_ledger');
		$this->db->where(array('customer_id' => $customer_id, 'receipt_no' => NULL, 'status' => 1));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	//Retrieve customer Receipt Data 
	public function customer_receipt_data($customer_id)
	{
		$this->db->select('*');
		$this->db->from('customer_ledger');
		$this->db->where(array('customer_id' => $customer_id, 'invoice_no' => NULL, 'status' => 1));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	//Retrieve customer All data 
	public function customerledger_tradational($customer_id, $from_date = null, $to_date = null)
	{
		$from_addon = '';
		$to_addon = '';
		// $this->db->select('customer_ledger.*');
		// $this->db->from('customer_ledger');
		// $this->db->where(array('customer_ledger.customer_id'=>$customer_id,'status'=>1));
		if (!empty($from_date)) {
			$time1 = strtotime($from_date);
			$newformat1 = date('Y-m-d', $time1);
			// $this->db->where('customer_ledger.date >= "' . $newformat1 . '"', null, false);
			// $from_addon = "AND STR_TO_DATE(customer_ledger.date, '%Y-%m-%d')>=DATE('" . $newformat1. "')";
			$from_addon = "AND DATE(customer_ledger.cl_created_at) >= DATE('" . $newformat1 . "')";
		}
		if (!empty($to_date)) {
			$time2 = strtotime($to_date);
			$newformat2 = date('Y-m-d', $time2);
			// $this->db->where('customer_ledger.date <= ', "'$newformat2'", false);
			// $to_addon = "AND STR_TO_DATE(customer_ledger.date, '%Y-%m-%d')<=DATE('" . $newformat2. "')";
			$to_addon = "AND DATE(customer_ledger.cl_created_at) <= DATE('" . $newformat2 . "')";
		}
		$this->db->reset_query();
		$query = $this->db->query("SELECT * FROM customer_ledger WHERE customer_ledger.customer_id = '$customer_id' AND customer_ledger.status = 1 $from_addon $to_addon;");

		if ($query->num_rows() > 0) {

			return $query->result_array();
		}
		return false;
	}
	//Retrieve customer total information
	public function customer_transection_summary($customer_id, $from_date = null, $to_date = null)
	{
		$from_addon = '';
		$to_addon = '';
		$result = array();
		$this->db->select_sum('amount', 'total_credit');
		$this->db->from('customer_ledger');
		$this->db->where(array('customer_id' => $customer_id, 'receipt_no' => NULL, 'status' => 1));
		if (!empty($from_date)) {
			$time1 = strtotime($from_date);
			$newformat1 = date('Y-m-d', $time1);
			// $this->db->where('customer_ledger.date >= "' . $newformat1 . '"', null, false);
			// $from_addon = "AND  customer_ledger.date >= $newformat1";
			$from_addon = "AND DATE(customer_ledger.cl_created_at) >= DATE('" . $newformat1 . "')";
		}
		if (!empty($to_date)) {
			$time2 = strtotime($to_date);
			$newformat2 = date('Y-m-d', $time2);
			// $this->db->where('customer_ledger.date <= ', "'$newformat2'", false);
			// $to_addon = "AND customer_ledger.date >= $newformat2";
			$to_addon = "AND DATE(customer_ledger.cl_created_at) <= DATE('" . $newformat2 . "')";
		}
		$this->db->reset_query();
		$query = $this->db->query("SELECT SUM(amount) as total_credit FROM customer_ledger WHERE customer_ledger.customer_id = '$customer_id' AND customer_ledger.status = 1 AND customer_ledger.receipt_no IS NULL $from_addon $to_addon;
		");
		if ($query->num_rows() > 0) {
			$result[] = $query->result_array();
		}

		$from_addon = '';
		$to_addon = '';
		$this->db->select_sum('amount', 'total_debit');
		$this->db->from('customer_ledger');
		$this->db->where(array('customer_id' => $customer_id, 'status' => 1));
		$this->db->where('receipt_no !=', NULL);
		if (!empty($from_date)) {
			$time1 = strtotime($from_date);
			$newformat1 = date('Y-m-d', $time1);
			// $this->db->where('customer_ledger.date >= "' . $newformat1 . '"', null, false);
			// $from_addon = "AND  customer_ledger.date >= $newformat1";
			$from_addon = "AND DATE(customer_ledger.cl_created_at) >= DATE('" . $newformat1 . "')";
		}
		if (!empty($to_date)) {
			$time2 = strtotime($to_date);
			$newformat2 = date('Y-m-d', $time2);
			// $this->db->where('customer_ledger.date <= ', "'$newformat2'", false);
			// $to_addon = "AND customer_ledger.date >= $newformat2";
			$to_addon = "AND DATE(customer_ledger.cl_created_at) <= DATE('" . $newformat2 . "')";
		}
		$this->db->reset_query();
		$query = $this->db->query("SELECT SUM(amount) as total_debit FROM customer_ledger WHERE customer_ledger.customer_id = '$customer_id' AND customer_ledger.status = 1 AND customer_ledger.receipt_no IS NOT NULL $from_addon $to_addon;
		");

		if ($query->num_rows() > 0) {
			$result[] = $query->result_array();
		}

		// get customer opening balance
		$customer = $this->db->select('previous_balance')->from('customer_information')->where('customer_id', $customer_id)->limit(1)->get()->row();


		// if ($customer->previous_balance > 0 && $result[0][0]['total_credit'] > 0) {
		// 	// previous_balance is credit
		// 	$result[0][0]['total_credit'] = (float)$result[0][0]['total_credit'] - (float)$customer->previous_balance;

		// } elseif ($customer->previous_balance < 0 && $result[1][0]['total_debit'] > 0) {
		// 	// previous_balance is debit
		// 	$result[1][0]['total_debit'] = (float)$result[1][0]['total_debit'] - (float)$customer->previous_balance;
		// }

		$result[2][0]['previous_balance'] = $customer->previous_balance;

		return $result;
	}

	//Update Categories
	public function update_customer($data, $customer_id)
	{
		if (isset($data['password']) && !empty($data['password'])) {
			$data['password'] = md5("gef" . $this->input->post('password', TRUE));
		}
		$this->db->where('customer_id', $customer_id);
		$result = $this->db->update('customer_information', $data);

		if ($result) {
			if (check_module_status('accounting') == 1) {
				$this->load->model('accounting/account_model');
				$this->account_model->update_customer_head($data, $customer_id);
			}
		}


		$this->db->select('*');
		$this->db->from('customer_information');
		$this->db->order_by('customer_name', 'asc');
		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$json_customer[] = array('label' => $row->customer_name . (!empty($row->customer_mobile) ? ' (' . $row->customer_mobile . ')' : ''), 'value' => $row->customer_id);
		}
		$cache_file = './my-assets/js/admin_js/json/customer.json';
		$customerList = json_encode($json_customer);
		file_put_contents($cache_file, $customerList);
		return true;
	}
	// Delete customer Item
	public function delete_customer($customer_id)
	{
		$result = $this->db->select('*')
			->from('invoice')
			->where('customer_id', $customer_id)
			->get()
			->num_rows();
		if ($result > 0) {
			$this->session->set_userdata(array('error_message' => display('you_cant_delete_this_customer')));
			redirect('dashboard/Ccustomer/manage_customer');
		} else {
			$this->db->where('customer_id', $customer_id);
			$this->db->delete('customer_information');

			$this->db->select('*');
			$this->db->from('customer_information');
			$query = $this->db->get();
			foreach ($query->result() as $row) {
				$json_customer[] = array('label' => $row->customer_name . (!empty($row->customer_mobile) ? ' (' . $row->customer_mobile . ')' : ''), 'value' => $row->customer_id);
			}
			$cache_file = './my-assets/js/admin_js/json/customer.json';
			$customerList = json_encode($json_customer);
			file_put_contents($cache_file, $customerList);
			return true;
		}
	}
	public function customer_search_list($cat_id, $company_id)
	{
		$this->db->select('a.*,b.sub_category_name,c.category_name');
		$this->db->from('customers a');
		$this->db->join('customer_sub_category b', 'b.sub_category_id = a.sub_category_id');
		$this->db->join('customer_category c', 'c.category_id = b.category_id');
		$this->db->where('a.sister_company_id', $company_id);
		$this->db->where('c.category_id', $cat_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}


	//get this data for recovery password
	public function get_user_info($email)
	{
		$this->db->select('*');
		$this->db->from('customer_information');
		$this->db->where('customer_email', $email);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	//insert token to resent password 
	public function set_token($precdat)
	{
		$this->db->set('token', $precdat['token']);
		$this->db->where('customer_email', $precdat['email']);
		$result = $this->db->update('customer_information');
		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	public function password_update($data)
	{

		$this->db->where('token', $data['token']);
		$result = $this->db->get('customer_information')->result();
		if (empty($result) || empty($data['token'])) {
			return false;
		}

		$password = md5("gef" . $data['password']);
		$this->db->set('password', $password);
		$this->db->where('token', $data['token']);
		$result = $this->db->update('customer_information');

		if ($result) {
			$this->db->update('customer_information', array('token' => ''), array('token' => $data['token']));
			return true;
		} else {
			return false;
		}
	}

	public function customer_balance_report($from_date = null, $to_date = null)
	{
		$this->db->select('a.HeadCode,SUM(b.Debit) as total_debit,SUM(b.Credit) as total_credit,c.customer_name,c.customer_mobile,c.vat_no,c.cr_no');
		$this->db->from('acc_coa a');
		$this->db->where('a.customer_id IS NOT NULL');
		$this->db->join('acc_transaction b', 'b.COAID = a.HeadCode', 'left');
		$this->db->join('customer_information c', 'c.customer_id = a.customer_id', 'left');
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
}
