<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lcustomer {

	//Customer add form
	public function customer_add_form()
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Customers');
		$country_list 	= $CI->Customers->country_list();

		$data = array(
				'title' => display('add_customer'),
				'country_list' => $country_list
			);
		$customerForm = $CI->parser->parse('dashboard/customer/add_customer_form',$data,true);
		return $customerForm;
	}


	//Retrieve  Customer List	
	public function customer_list()
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Customers');
		$customers_list = $CI->Customers->customer_list();

		$i=0;
		$total=0;
		if(!empty($customers_list)){	
			foreach($customers_list as $k=>$v){$i++;
			   $customers_list[$k]['sl']=$i;
			}
		}
		$data = array(
				'title'		     => display('manage_customer'),
				'customers_list' => $customers_list,
			);
		$customerList = $CI->parser->parse('dashboard/customer/customer',$data,true);
		return $customerList;
	}

	//Retrieve  Credit Customer List	
	public function credit_customer_list()
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Customers');
		$CI->load->model('dashboard/Soft_settings');
		$customers_list = $CI->Customers->credit_customer_list();  //It will get only Credit Customers
		$i=0;
		$total=0;
		if(!empty($customers_list)){	
			foreach($customers_list as $k=>$v){$i++;
			   $customers_list[$k]['sl']=$i;
			   $total+=$customers_list[$k]['customer_balance'];
			}
		}
		$currency_details = $CI->Soft_settings->retrieve_currency_info();
		$data = array(
				'title' => display('credit_customer'),
				'customers_list' => $customers_list,
				'subtotal'	=>number_format($total, 2, '.', ','),
				'currency' => $currency_details[0]['currency_icon'],
				'position' => $currency_details[0]['currency_position'],
			);
		$customerList = $CI->parser->parse('dashboard/customer/cedit_customer',$data,true);
		return $customerList;
	}

	//##################  Paid  Customer List  ##########################	
	public function paid_customer_list()
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Customers');
		$CI->load->model('dashboard/Soft_settings');
		$customers_list = $CI->Customers->paid_customer_list();
	
		$i=0;
		$total=0;
		if(!empty($customers_list)){	
			foreach($customers_list as $k=>$v){$i++;
			   $customers_list[$k]['sl']=$i;
			   $total+=$customers_list[$k]['customer_balance'];
			}
		}
		$currency_details = $CI->Soft_settings->retrieve_currency_info();
		$data = array(
				'title' => 'Paid customer',
				'customers_list' => $customers_list,
				'subtotal'=>number_format($total, 2, '.', ','),
				'currency' => $currency_details[0]['currency_icon'],
				'position' => $currency_details[0]['currency_position'],
			);
		$customerList = $CI->parser->parse('dashboard/customer/paid_customer',$data,true);
		return $customerList;
	}
	
	//Retrieve  Customer Search List	
	public function customer_search_item($customer_id)
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Customers');
		$customers_list = $CI->Customers->customer_search_item($customer_id);
		$i=0;
		$total=0;
		if ($customers_list) {
			foreach($customers_list as $k=>$v){$i++;
           		$customers_list[$k]['sl']=$i;
		    	$total+=$customers_list[$k]['customer_balance'];
			}
			$data = array(
					'title' => 'Customers Search Item',
					'subtotal'=>$total,
					'customers_list' => $customers_list
				);
			$customerList = $CI->parser->parse('dashboard/customer/customer',$data,true);
			return $customerList;
		}else{
			redirect('dashbaord/Ccustomer/manage_customer');
		}
		
	}
	//Insert customer
	public function insert_customer($data)
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Customers');
        $CI->Customers->customer_entry($data);
		return true;
	}
	
	//Customer Previous Balance Adjustment.
	public function previous_balance_form()
	{
		$CI =& get_instance();
		$data = array(
				'title' => 'Previous Balance Adjustment'
			);
		$customerForm = $CI->parser->parse('dashboard/customer/add_customer_pre_balance',$data,true);
		return $customerForm;
	}
	
	//customer Edit Data
	public function customer_edit_data($customer_id)
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Customers');
		$CI->load->model('dashboard/Customer_contact_info');
		$customer_detail = $CI->Customers->retrieve_customer_editdata($customer_id);
		$state_list = $CI->Customers->select_city_country_id($customer_detail[0]['country']);
		$contact_info = $CI->Customer_contact_info->get_contact_info_data($customer_detail[0]['customer_id']);

		$country_list 	= $CI->Customers->country_list();
		$data=array(
			'title'			    =>display('customer_edit'),
			'customer_id' 	    =>$customer_detail[0]['customer_id'],
			'customer_name'     =>$customer_detail[0]['customer_name'],
			'customer_address'  =>$customer_detail[0]['customer_short_address'],
			'customer_mobile'   =>$customer_detail[0]['customer_mobile'],
			'customer_email'    =>$customer_detail[0]['customer_email'],
			'vat_no'            =>$customer_detail[0]['vat_no'],
			'cr_no'             =>$customer_detail[0]['cr_no'],
			'customer_address_1'=>$customer_detail[0]['customer_address_1'],
			'customer_address_2'=>$customer_detail[0]['customer_address_2'],
			'city' 			    =>$customer_detail[0]['city'],
			'state' 		    =>$customer_detail[0]['state'],
			'country' 		    =>$customer_detail[0]['country'],
			'zip' 			    =>$customer_detail[0]['zip'],
			'status' 		    =>$customer_detail[0]['status'],
			'state_name' 		=>$customer_detail[0]['state'],
			'country_id' 		=>$customer_detail[0]['country'],
			'country_list' 	    =>$country_list,
			'state_list' 		=>$state_list,
			'contact_info' 	    =>$contact_info,
			);
		$chapterList = $CI->parser->parse('dashboard/customer/edit_customer_form',$data,true);
		return $chapterList;
	}
	//Customer ledger Data
	public function customer_ledger_data($customer_id)
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Customers');
		$CI->load->model('dashboard/Soft_settings');
		$CI->load->library('dashboard/occational');
		$CI->load->model('dashboard/Customer_contact_info');
		$customer_detail = $CI->Customers->customer_personal_data($customer_id);
		$invoice_info 	= $CI->Customers->customer_invoice_data($customer_id);
		$contact_info = $CI->Customer_contact_info->get_contact_info_data($customer_detail[0]['customer_id']);
		$invoice_amount = 0;
		if(!empty($invoice_info)){
			foreach($invoice_info as $k=>$v){
				$invoice_info[$k]['final_date'] = $CI->occational->dateConvert($invoice_info[$k]['date']);
				$invoice_amount = $invoice_amount+$invoice_info[$k]['amount'];
			}
		}
		$receipt_info 	= $CI->Customers->customer_receipt_data($customer_id);
		$receipt_amount = 0;
		if(!empty($receipt_info)){
			foreach($receipt_info as $k=>$v){
				$receipt_info[$k]['final_date'] = $CI->occational->dateConvert($receipt_info[$k]['date']);
				$receipt_amount = $receipt_amount+$receipt_info[$k]['amount'];
			}
		}
		$currency_details = $CI->Soft_settings->retrieve_currency_info();
		$data=array(
			'title'				=> display('customer_ledger'),
			'customer_id' 		=> $customer_detail[0]['customer_id'],
			'customer_name' 	=> $customer_detail[0]['customer_name'],
			'customer_address' 	=> $customer_detail[0]['customer_short_address'],
			'customer_mobile' 	=> $customer_detail[0]['customer_mobile'],
			'customer_email' 	=> $customer_detail[0]['customer_email'],
			'receipt_amount' 	=> $receipt_amount,
			'invoice_amount' 	=> $invoice_amount,
			'invoice_info' 		=> $invoice_info,
			'receipt_info' 		=> $receipt_info,
			'currency' 			=> $currency_details[0]['currency_icon'],
			'position' 			=> $currency_details[0]['currency_position'],
			'contact_info'     => $contact_info,
			);
		$chapterList = $CI->parser->parse('dashboard/customer/customer_details',$data,true);
		return $chapterList;
	}	
	//Customer ledger Report
	public function customer_ledger_report($customer_id=null,$from_date=null,$to_date=null)
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Customers');
		$CI->load->model('dashboard/Soft_settings');
		$CI->load->library('dashboard/occational');
		$customer_detail=$CI->Customers->customer_personal_data($customer_id);
		$ledger 	    =$CI->Customers->customerledger_tradational($customer_id,$from_date,$to_date);
		$summary 	    =$CI->Customers->customer_transection_summary($customer_id,$from_date,$to_date);
		$customers_list =$CI->Customers->customer_list(); 
		$balance = 0;
		
		if(!empty($ledger)){
			foreach($ledger as $index=>$value){
				$ledger[$index]['final_date'] = $CI->occational->dateConvert($ledger[$index]['date']);
				// get invoice no
				if (!empty($ledger[$index]['invoice_no'])) {
					$invoice = $CI->db->select('invoice')->from('invoice')->where('invoice_id', $ledger[$index]['invoice_no'])->get()->row();
					$ledger[$index]['invoice'] = $invoice->invoice;
				}
				if(empty($ledger[$index]['receipt_no'])or  $ledger[$index]['receipt_no']=="NA")
				{
					$ledger[$index]['credit']=$ledger[$index]['amount'];
					$ledger[$index]['balance']=$balance-$ledger[$index]['amount'];
					$ledger[$index]['debit']="";
					$balance=$ledger[$index]['balance'];
					
				}
				else
				{
					$ledger[$index]['debit']=$ledger[$index]['amount'];
					$ledger[$index]['balance']=$balance+$ledger[$index]['amount'];
					$ledger[$index]['credit']="";
					$balance=$ledger[$index]['balance'];
				}
				// var_dump($balance);
			}
		}
		$company_info 	= $CI->Customers->retrieve_company();
		$currency_details = $CI->Soft_settings->retrieve_currency_info();
		$data=array(
			'title'				=>display('customer_ledger'),
			'customer_id' 		=>@$customer_detail[0]['customer_id'],
			'customer_name' 	=>@$customer_detail[0]['customer_name'],
			'customer_address' 	=>@$customer_detail[0]['customer_short_address'],
			'customer_address_1'=>@$customer_detail[0]['customer_address_1'],
			'customer_mobile' 	=>@$customer_detail[0]['customer_mobile'],
			'customer_email' 	=>@$customer_detail[0]['customer_email'],
			'vat_no' 	        =>@$customer_detail[0]['vat_no'],
			'cr_no' 	        =>@$customer_detail[0]['cr_no'],
			'ledger' 			=>$ledger,
			'customers_list' 	=>$customers_list,
			'total_credit'		=>number_format($summary[0][0]['total_credit'], 2, '.', ','),
			'total_debit'		=>number_format($summary[1][0]['total_debit'], 2, '.', ','),
			'total_balance'		=>number_format($summary[1][0]['total_debit']-$summary[0][0]['total_credit'], 2, '.', ','),
			'company_info'		=>$company_info,
			'currency' 			=>@$currency_details[0]['currency_icon'],
			'position' 			=>@$currency_details[0]['currency_position'],
			'from_date' 		=>$from_date,
			'to_date' 			=>$to_date,
			);
			
		$singlecustomerdetails = $CI->parser->parse('dashboard/customer/customer_ledger_report',$data,true);
		return $singlecustomerdetails;
	}
	
	//Customer ledger Data
	public function customerledger_data($customer_id, $from_date = null, $to_date = null)
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Customers');
		$CI->load->model('web/Homes');
		$CI->load->model('dashboard/Soft_settings');
		$CI->load->library('dashboard/occational');
		$CI->load->model('dashboard/Customer_contact_info');
		$not_report = false;
		if ($from_date === 'no') {
			$from_date = null;
			$not_report = true;
		}
		$customer_detail = $CI->Customers->customer_personal_data($customer_id);
		$ledger 	    =$CI->Customers->customerledger_tradational($customer_id,$from_date,$to_date);
		$summary 	    =$CI->Customers->customer_transection_summary($customer_id,$from_date,$to_date);
		$contact_info = $CI->Customer_contact_info->get_contact_info_data($customer_id);
		$customers_list =$CI->Customers->customer_list(); 

		$balance = 0;
		if(!empty($ledger)){
			foreach($ledger as $index=>$value){
				$ledger[$index]['final_date'] = $CI->occational->dateConvert($ledger[$index]['date']);
				
				// get invoice no
				if (!empty($ledger[$index]['invoice_no'])) {
					$invoice = $CI->db->select('invoice')->from('invoice')->where('invoice_id', $ledger[$index]['invoice_no'])->get()->row();
					$ledger[$index]['invoice'] = $invoice->invoice;
				}
				

				if(!empty($ledger[$index]['receipt_no']))
				{
					$ledger[$index]['debit']=$ledger[$index]['amount'];
					$ledger[$index]['balance']=$balance+$ledger[$index]['amount'];
					$ledger[$index]['credit']="";
					$balance=$ledger[$index]['balance'];
					
				}
				else
				{
					$ledger[$index]['credit']=$ledger[$index]['amount'];
					$ledger[$index]['balance']=$balance-$ledger[$index]['amount'];
					$ledger[$index]['debit']="";
					$balance=$ledger[$index]['balance'];
				}
				
			}
		}
		$country_name = $CI->Homes->get_country_name($customer_detail[0]['country']);
		if(!empty($country_name)){
		    $country_name=$country_name->name;
		}else{
		    $country_name='';
		}
		$company_info 	= $CI->Customers->retrieve_company();
		$currency_details = $CI->Soft_settings->retrieve_currency_info();

		$data=array(
			'title'				=> display('customer_ledger'),
			'customer_id' 		=> $customer_detail[0]['customer_id'],
			'customer_name' 	=> $customer_detail[0]['customer_name'],
			'customer_address' 	=> $customer_detail[0]['customer_short_address'],
			'customer_address_1' 	=> $customer_detail[0]['customer_address_1'],
			'customer_mobile' 	=> $customer_detail[0]['customer_mobile'],
			'customer_email' 	=> $customer_detail[0]['customer_email'],
			'city' 				=> $customer_detail[0]['city'],
			'state' 			=> $customer_detail[0]['state'],
			'country' 			=> $country_name,
			'zip' 				=> $customer_detail[0]['zip'],
			'company' 			=> $customer_detail[0]['company'],
			'ledger' 			=> $ledger,
			'total_credit'		=> number_format($summary[0][0]['total_credit'], 2, '.', ','),
			'total_debit'		=> number_format($summary[1][0]['total_debit'], 2, '.', ','),
			'total_balance'		=> number_format(abs($summary[1][0]['total_debit']-$summary[0][0]['total_credit']), 2, '.', ','),
			'total_balance_pure' => (float)$summary[1][0]['total_debit']-$summary[0][0]['total_credit'],
			// 'previous_balance'  => number_format($summary[2][0]['previous_balance'], 2, '.', ','),
			'company_info'		=> $company_info,
			'currency' => $currency_details[0]['currency_icon'],
			'position' => $currency_details[0]['currency_position'],
			'contact_info' => $contact_info,
			'customers_list' => $customers_list,
			'not_report' => $not_report,
			);

		$singlecustomerdetails = $CI->parser->parse('dashboard/customer/customer_ledger',$data,true);
		return $singlecustomerdetails;
	}

	public function customerledger_data_print($customer_id, $from_date = null, $to_date = null)
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Customers');
		$CI->load->model('web/Homes');
		$CI->load->model('dashboard/Soft_settings');
		$CI->load->library('dashboard/occational');
		$CI->load->model('dashboard/Customer_contact_info');
		$not_report = false;
		if ($from_date === 'no') {
			$from_date = null;
			$not_report = true;
		}
		$customer_detail = $CI->Customers->customer_personal_data($customer_id);
		$ledger 	    =$CI->Customers->customerledger_tradational($customer_id,$from_date,$to_date);
		$summary 	    =$CI->Customers->customer_transection_summary($customer_id,$from_date,$to_date);
		$contact_info = $CI->Customer_contact_info->get_contact_info_data($customer_id);
		$customers_list =$CI->Customers->customer_list(); 

		$balance = 0;
		if(!empty($ledger)){
			foreach($ledger as $index=>$value){
				$ledger[$index]['final_date'] = $CI->occational->dateConvert($ledger[$index]['date']);
				
				// get invoice no
				if (!empty($ledger[$index]['invoice_no'])) {
					$invoice = $CI->db->select('invoice')->from('invoice')->where('invoice_id', $ledger[$index]['invoice_no'])->get()->row();
					$ledger[$index]['invoice'] = $invoice->invoice;
				}
				

				if(!empty($ledger[$index]['receipt_no']))
				{
					$ledger[$index]['debit']=$ledger[$index]['amount'];
					$ledger[$index]['balance']=$balance-$ledger[$index]['amount'];
					$ledger[$index]['credit']="";
					$balance=$ledger[$index]['balance'];
					
				}
				else
				{
					$ledger[$index]['credit']=$ledger[$index]['amount'];
					$ledger[$index]['balance']=$balance+$ledger[$index]['amount'];
					$ledger[$index]['debit']="";
					$balance=$ledger[$index]['balance'];
				}
				
			}
		}
		$country_name = $CI->Homes->get_country_name($customer_detail[0]['country']);
		if(!empty($country_name)){
		    $country_name=$country_name->name;
		}else{
		    $country_name='';
		}
		$company_info 	= $CI->Customers->retrieve_company();
		$currency_details = $CI->Soft_settings->retrieve_currency_info();

		$data=array(
			'title'				=> display('customer_ledger'),
			'customer_id' 		=> $customer_detail[0]['customer_id'],
			'customer_name' 	=> $customer_detail[0]['customer_name'],
			'customer_address' 	=> $customer_detail[0]['customer_short_address'],
			'customer_address_1' 	=> $customer_detail[0]['customer_address_1'],
			'customer_mobile' 	=> $customer_detail[0]['customer_mobile'],
			'customer_email' 	=> $customer_detail[0]['customer_email'],
			'city' 				=> $customer_detail[0]['city'],
			'state' 			=> $customer_detail[0]['state'],
			'country' 			=> $country_name,
			'zip' 				=> $customer_detail[0]['zip'],
			'company' 			=> $customer_detail[0]['company'],
			'ledger' 			=> $ledger,
			'total_credit'		=> number_format($summary[0][0]['total_credit'], 2, '.', ','),
			'total_debit'		=> number_format($summary[1][0]['total_debit'], 2, '.', ','),
			'total_balance'		=> number_format($summary[1][0]['total_debit']-$summary[0][0]['total_credit'], 2, '.', ','),
			// 'previous_balance'  => number_format($summary[2][0]['previous_balance'], 2, '.', ','),
			'company_info'		=> $company_info,
			'currency' => $currency_details[0]['currency_icon'],
			'position' => $currency_details[0]['currency_position'],
			'contact_info' => $contact_info,
			'customers_list' => $customers_list,
			'not_report' => $not_report,
			);

		$singlecustomerdetails = $CI->parser->parse('dashboard/customer/customer_ledger_print',$data,true);
		return $singlecustomerdetails;
	}
	//Search customer
	public function customer_search_list($cat_id,$company_id)
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Customers');
		$category_list = $CI->Customers->retrieve_category_list();
		$customers_list = $CI->Customers->customer_search_list($cat_id,$company_id);
		$data = array(
				'title' => 'customers List',
				'customers_list' => $customers_list,
				'category_list' => $category_list
			);
		$customerList = $CI->parser->parse('dashboard/customer/customer',$data,true);
		return $customerList;
	}
	
	public function customer_balance_report($from_date=null,$to_date=null){
		$CI =& get_instance();
		$CI->load->model('dashboard/Customers');
		$CI->load->model('dashboard/Soft_settings');
		$CI->load->library('dashboard/occational');

		$customers_transection_report =$CI->Customers->customer_balance_report($from_date,$to_date);
		
		if(!empty($customers_transection_report)){
			foreach($customers_transection_report as $index=>$value){
				if(!empty($customers_transection_report[$index]['total_debit']) or  !empty($customers_transection_report[$index]['total_credit']))
				{
					$customers_transection_report[$index]['balance']=$customers_transection_report[$index]['total_debit']-$customers_transection_report[$index]['total_credit'];
				}else{
					$customers_transection_report[$index]['balance']=0;
				}
			}
		}
		$currency_details = $CI->Soft_settings->retrieve_currency_info();
		$data=array(
			'title'    =>display('customer_balance_report'),
			'customers_transection_report'=>$customers_transection_report,
			'currency' =>$currency_details[0]['currency_icon'],
			'position' =>$currency_details[0]['currency_position'],
			'from_date'=>$from_date,
			'to_date'  =>$to_date,
			);
		$singlecustomerdetails = $CI->parser->parse('customer/customer_balance_report',$data,true);
		return $singlecustomerdetails;
	}
}
?>