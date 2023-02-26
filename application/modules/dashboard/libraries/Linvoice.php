<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Linvoice {
	//Invoice add form
	public function invoice_add_form()
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Invoices');
		$CI->load->model('dashboard/Stores');
		$CI->load->model('dashboard/Variants');
		$CI->load->model('dashboard/Customers');
		$CI->load->model('dashboard/Shipping_methods');

		$store_list 	    = $CI->Stores->store_list();
		$variant_list 	    = $CI->Variants->variant_list();
		$shipping_methods 	= $CI->Shipping_methods->shipping_method_list();
		$bank_lists 	    = $CI->Invoices->bank_lists();

		$customer =$CI->Customers->customer_list();
	
		$data = array(
			'title' 		=> display('new_invoice'),
			'store_list' 	=> $store_list,
			'variant_list' 	=> $variant_list,
			'customer' 		=> $customer[0],
            'shipping_methods'=>$shipping_methods
			);
		$invoiceForm = $CI->parser->parse('dashboard/invoice/add_invoice_form',$data,true);
		return $invoiceForm;
	}

	//Retrieve  Invoice List
	public function invoice_list()
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Invoices');
		$CI->load->model('dashboard/Soft_settings');
		$CI->load->library('dashboard/occational');
		
		$invoices_list = $CI->Invoices->invoice_list();
		if(!empty($invoices_list)){
			foreach($invoices_list as $k=>$v){
				$invoices_list[$k]['final_date'] = $CI->occational->dateConvert($invoices_list[$k]['date']);
			}
			$i=0;
			foreach($invoices_list as $k=>$v){$i++;
			   $invoices_list[$k]['sl']=$i;
			}
		}

		$currency_details = $CI->Soft_settings->retrieve_currency_info();
		$data = array(
				'title' => display('manage_invoice'),
				'invoices_list' => $invoices_list,
				'currency' => $currency_details[0]['currency_icon'],
				'position' => $currency_details[0]['currency_position'],
			);
		$invoiceList = $CI->parser->parse('dashboard/invoice/invoice',$data,true);
		return $invoiceList;
	}

	//Pos invoice add form
	public function pos_invoice_add_form()
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Invoices');
		$CI->load->model('dashboard/Stores');
		$CI->load->model('dashboard/Reports');
		$CI->load->model('dashboard/Soft_settings');
		$CI->load->model('web/Homes');
		$customer_details = $CI->Invoices->pos_customer_setup();
		$category_list	  = $CI->Invoices->category_list();
		$customer_list	  = $CI->Invoices->customer_list();
		$store_list   	  = $CI->Invoices->store_list();
		$most_popular_product 	= $CI->Invoices->pos_invoice_popular_product();
		$first20  = $CI->Invoices->get_first20_product();

		$total_product  = $CI->db->count_all('product_information'); 

		$today = date('Y-m-d');
		$today_sales = $CI->Invoices->get_today_invoice_list($today);

		$currency_details = $CI->Soft_settings->retrieve_currency_info();
		
		$company_info 	  = $CI->Reports->retrieve_company();

		$data = array(
				'title' 		  =>display('add_pos_invoice'),
				'sidebar_collapse'=>'sidebar-collapse',
				'product_list' 	  =>(!empty($most_popular_product))?$most_popular_product:$first20,
				'total_product'   =>$total_product,
				'category_list'   =>$category_list,
				'store_list' 	  =>$store_list,
				'customer_details'=>$customer_details,
				'customer_list'   =>$customer_list,
				'company_info'    =>$company_info,
				'company_name'    =>$company_info[0]['company_name'],
				'today_sales'     =>$today_sales,
				'currency'        => $currency_details[0]['currency_icon'],
				'position'        => $currency_details[0]['currency_position'],
			);
		$invoiceForm = $CI->parser->parse('dashboard/invoice/add_pos_invoice_form',$data,true);
		return $invoiceForm;
	}

	//Retrieve  Invoice List
	public function search_inovoice_item($customer_id)
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Invoices');
		$CI->load->library('dashboard/occational');
		$invoices_list = $CI->Invoices->search_inovoice_item($customer_id);

		if(!empty($invoices_list)){
			foreach($invoices_list as $k=>$v){
				$invoices_list[$k]['final_date'] = $CI->occational->dateConvert($invoices_list[$k]['date']);
			}
			$i=0;
			foreach($invoices_list as $k=>$v){$i++;
			   $invoices_list[$k]['sl']=$i;
			}
		}
		$data = array(
				'title' => display('invoice_search_item'),
				'invoices_list' => $invoices_list
			);
		$invoiceList = $CI->parser->parse('dashboard/invoice/invoice',$data,true);
		return $invoiceList;
	}

	//Insert invoice
	public function insert_invoice($data)
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Invoices');
        $CI->Invoices->invoice_entry($data);
		return true;
	}

	//Invoice Edit Data
	public function invoice_edit_data($invoice_id)
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Invoices');
		$CI->load->model('dashboard/Stores');
		$CI->load->model('dashboard/Shipping_methods');

		$invoice_detail = $CI->Invoices->retrieve_invoice_editdata($invoice_id);
        $shipping_methods = $CI->Shipping_methods->shipping_method_list();
        $store_id = $invoice_detail[0]['store_id'];
        $store_list = $CI->Stores->store_list();
        $store_list_selected = $CI->Stores->store_list_selected($store_id);

        $i = 0;
        foreach ($invoice_detail as $k => $v) {
            $i++;
            $invoice_detail[$k]['sl'] = $i;
        }

        $data = array(
            'title' => display('invoice_edit'),
            'invoice_id' => $invoice_detail[0]['invoice_id'],
            'customer_id' => $invoice_detail[0]['customer_id'],
            'store_id' => $invoice_detail[0]['store_id'],
            'invoice' => $invoice_detail[0]['invoice'],
            'customer_name' => $invoice_detail[0]['customer_name'],
            'date' => $invoice_detail[0]['date'],
            'total_amount' => $invoice_detail[0]['total_amount'],
            'paid_amount' => $invoice_detail[0]['paid_amount'],
            'due_amount' => $invoice_detail[0]['due_amount'],
            'total_discount' => $invoice_detail[0]['total_discount'],
            'invoice_discount' => $invoice_detail[0]['invoice_discount'],
            'service_charge' => $invoice_detail[0]['service_charge'],
            'shipping_charge' => $invoice_detail[0]['shipping_charge'],
            'shipping_method_id' => $invoice_detail[0]['shipping_method'],
            'invoice_details' => $invoice_detail[0]['invoice_details'],
            'invoice_status' => $invoice_detail[0]['invoice_status'],
            'invoice_all_data' => $invoice_detail,
            'store_list' => $store_list,
            'store_list_selected' => $store_list_selected,
            'shipping_methods' => $shipping_methods
        );

		$chapterList = $CI->parser->parse('dashboard/invoice/edit_invoice_form',$data,true);
		return $chapterList;
	}

	//Invoice html Data
	public function invoice_html_data($invoice_id)
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Invoices');
		$CI->load->model('dashboard/Soft_settings');
		$CI->load->library('dashboard/occational');
		$CI->load->model('dashboard/Shipping_methods');
		$CI->load->model('hrm/Hrm_model');
		$CI->load->model('dashboard/Products');
		
		$invoice_detail = $CI->Invoices->retrieve_invoice_html_data($invoice_id);
		// echo "<pre>";var_dump($invoice_detail);exit;
        $invoice_detail[0]['invoice_discount'] = $invoice_detail[0]['total_invoice_discount'];
		$order_no=$CI->db->select('b.order as order_no')->from('invoice a')->where('a.order_id',$invoice_detail[0]['order_id'])->join('order b','a.order_id = b.order_id','left')->get()->result();
		$quotation_no = $CI->db->select('q.quotation as quotation_no')->from('invoice a')->where('a.quotation_id',$invoice_detail[0]['quotation_id'])->join('quotation q','q.quotation_id = a.quotation_id','left')->get()->result();

		$cardpayments=$CI->Invoices->get_invoice_card_payments($invoice_id);
        $shipping_method  =$CI->Shipping_methods->shipping_method_search_item($invoice_detail[0]['shipping_method']);
		$subTotal_quantity=0;
		$subTotal_cartoon =0;
		$subTotal_discount=0;
        $isTaxed = 1;
        if ($invoice_detail[0]['is_quotation'] > 0){
            $isTaxed = 0;
        }
		if(!empty($invoice_detail)){
			foreach($invoice_detail as $k=>$v){
				$invoice_detail[$k]['final_date']=$CI->occational->dateConvert($invoice_detail[$k]['date']);
				$subTotal_quantity=$subTotal_quantity+$invoice_detail[$k]['quantity'];
			}
			$i=0;
			$products = [];
			foreach($invoice_detail as $k=>$v){
				$i++;
			    $invoice_detail[$k]['sl']=$i;
				$invoice_detail[$k]['product_price'] = ($CI->Products->get_product_model([
					'product_model' => $invoice_detail[0]['product_model'],
					'product_name' => $invoice_detail[0]['product_name'],
				]))->price;
			}
		}

		$currency_details=$CI->Soft_settings->retrieve_currency_info();
		$company_info 	 =$CI->Invoices->retrieve_company();
		
		$created_at      =explode(' ', $invoice_detail[0]['date_time']);
		$invoice_time=@$created_at[1];

		$all_details = [];

		$hide_discount = false;
		foreach ($invoice_detail as $detail) {
			$detail['customer_price'] = 0;
			$customer_price = $CI->db->select('product_price')->from('pricing_types_product')->where('product_id', $detail['product_id'])->where('pri_type_id', 2)->get()->row();
			$detail['customer_price'] = $customer_price->product_price;

			// hide discount if equal to zero
			if ((int)$detail['discount'] != 0) {
				$hide_discount = true;
			}

			$all_details[] = $detail;
		}

		$data=array(
			'title'			   =>display('invoice_details'),
			'invoice_id'	   =>$invoice_detail[0]['invoice_id'],
			'invoice_no'	   =>$invoice_detail[0]['invoice'],
			'customer_id'      => $invoice_detail[0]['customer_id'],
			'customer_no'      => $invoice_detail[0]['customer_no'],
			'customer_name'	   =>$invoice_detail[0]['customer_name'],
			'customer_mobile'  =>$invoice_detail[0]['customer_mobile'],
			'customer_email'   =>$invoice_detail[0]['customer_email'],
			'store_id'	       =>(empty($invoice_detail[0]['store_id'])?'':$invoice_detail[0]['store_id']),
			'vat_no'	       =>$invoice_detail[0]['vat_no'],
			'cr_no'	           =>$invoice_detail[0]['cr_no'],
			'customer_address' =>$invoice_detail[0]['customer_address_1'],
			'final_date'	   =>$invoice_detail[0]['final_date'],
			'invoice_time'	   =>$invoice_time,
			'total_amount'	   =>$invoice_detail[0]['total_amount'],
			'total_discount'   =>$invoice_detail[0]['total_discount'],
			'invoice_discount' =>$invoice_detail[0]['invoice_discount'],
			'percentage_discount' =>$invoice_detail[0]['percentage_discount'],
			'service_charge'   =>$invoice_detail[0]['service_charge'],
			'shipping_charge'  =>$invoice_detail[0]['shipping_charge'],
			'shipping_method'  =>@$shipping_method[0]['method_name'],
			'paid_amount'	   =>$invoice_detail[0]['paid_amount'],
			'due_amount'	   =>$invoice_detail[0]['due_amount'],
			'product_type'     => $invoice_detail[0]['product_type'],
			'invoice_details'  =>$invoice_detail[0]['invoice_details'],
			'subTotal_quantity'=>$subTotal_quantity,
			'invoice_all_data' =>$all_details,
			'isTaxed'          =>$isTaxed,
			'order_no'         =>$order_no,
			'quotation_no'     =>$quotation_no,
			'company_info'	   =>$company_info,
			'currency' 		   =>$currency_details[0]['currency_icon'],
			'position' 		   =>$currency_details[0]['currency_position'],
            'ship_customer_short_address'=>$invoice_detail[0]['ship_customer_short_address'],
            'ship_customer_name' =>$invoice_detail[0]['ship_customer_name'],
            'ship_customer_mobile'=>$invoice_detail[0]['ship_customer_mobile'],
            'ship_customer_email'=>$invoice_detail[0]['ship_customer_email'],
            'cardpayments'	     =>$cardpayments,
			'hide_discount' => $hide_discount,
			'customer_balance' => $invoice_detail[0]['customer_balance'],
			'customer_balance_after' => $invoice_detail[0]['customer_balance_after'],
			);
		$data['Soft_settings'] = $CI->Soft_settings->retrieve_setting_editdata();
		$emp_name = $emp_id = null;
		if (!empty($invoice_detail) && isset($invoice_detail[0]['employee_id'])) {
			$emp = $CI->Hrm_model->single_employee_data($invoice_detail[0]['employee_id']);
			if (null !== $emp) {
				$emp_name = $emp->first_name . ' ' . $emp->last_name;
				$emp_id = $emp->id;
			}
		}

// 		$product = $CI->Products->get_product_model([
// 			'product_model' => $invoice_detail[0]['product_model'],
// 			'product_name' => $invoice_detail[0]['product_name'],
// 		]);
// echo "<pre>";
// 		var_dump($product);
// 		exit;
		
		$data['emp_name'] = $emp_name;
		$data['emp_id'] = $emp_id;
		
		$chapterList = $CI->parser->parse('dashboard/invoice/invoice_html',$data,true);
		return $chapterList;
	}

	//POS invoice html Data
	public function pos_invoice_html_data($invoice_id)
	{	
		$CI =& get_instance();
		$CI->load->model('dashboard/Invoices');
		$CI->load->model('dashboard/Soft_settings');
		$CI->load->library('dashboard/occational');
		$invoice_detail = $CI->Invoices->retrieve_invoice_html_data($invoice_id);

		$subTotal_quantity=0;
		$subTotal_cartoon =0;
		$subTotal_discount=0;
		if(!empty($invoice_detail)){
			foreach($invoice_detail as $k=>$v){
				$invoice_detail[$k]['final_date']=$CI->occational->dateConvert($invoice_detail[$k]['date']);
				$subTotal_quantity = $subTotal_quantity+$invoice_detail[$k]['quantity'];
			}
			$i=0;
			foreach($invoice_detail as $k=>$v){
				$i++;
			    $invoice_detail[$k]['sl']=$i;
			}
		}

		$currency_details = $CI->Soft_settings->retrieve_currency_info();
		$company_info = $CI->Invoices->retrieve_company();
		$invoice_text_details = $CI->Invoices->invoice_text_details();
		$data=array(
			'title'				  =>display('invoice_details'),
			'invoice_id'		  =>$invoice_detail[0]['invoice_id'],
			'invoice_no'		  =>$invoice_detail[0]['invoice'],
			'customer_name'		  =>$invoice_detail[0]['customer_name'],
			'customer_address'	  =>$invoice_detail[0]['customer_short_address'],
			'customer_mobile'	  =>$invoice_detail[0]['customer_mobile'],
			'customer_email'	  =>$invoice_detail[0]['customer_email'],
			'final_date'		  =>$invoice_detail[0]['final_date'],
			'total_amount'		  =>$invoice_detail[0]['total_amount'],
			'subTotal_discount'	  =>$invoice_detail[0]['total_discount'],
			'service_charge'	  =>$invoice_detail[0]['service_charge'],
			'shipping_charge'	  =>$invoice_detail[0]['shipping_charge'],
			'paid_amount'		  =>$invoice_detail[0]['paid_amount'],
			'due_amount'		  =>$invoice_detail[0]['due_amount'],
			'invoice_details'	  =>$invoice_detail[0]['invoice_details'],
			'subTotal_quantity'	  =>$subTotal_quantity,
			'invoice_all_data'	  =>$invoice_detail,
			'company_info'		  =>$company_info,
			'currency' 			  =>$currency_details[0]['currency_icon'],
			'position' 			  =>$currency_details[0]['currency_position'],
			'invoice_text_details'=>$invoice_text_details,
		);
		$data['Soft_settings'] = $CI->Soft_settings->retrieve_setting_editdata();
		$chapterList = $CI->parser->parse('dashboard/invoice/pos_invoice_html',$data,true);
		return $chapterList;
	}

	public function pos_invoice_html_data_redirect($invoice_id)
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Invoices');
		$CI->load->model('dashboard/Soft_settings');
		$CI->load->library('dashboard/occational');
		$invoice_detail = $CI->Invoices->retrieve_invoice_html_data($invoice_id);

		$subTotal_quantity = 0;
		$subTotal_cartoon = 0;
		$subTotal_discount = 0;
		if(!empty($invoice_detail)){
			foreach($invoice_detail as $k=>$v){
				$invoice_detail[$k]['final_date'] = $CI->occational->dateConvert($invoice_detail[$k]['date']);
				$subTotal_quantity = $subTotal_quantity+$invoice_detail[$k]['quantity'];
			}
			$i=0;
			foreach($invoice_detail as $k=>$v){$i++;
			   $invoice_detail[$k]['sl']=$i;
			}
		}

		$currency_details = $CI->Soft_settings->retrieve_currency_info();
		$company_info = $CI->Invoices->retrieve_company();
		$invoice_text_details = $CI->Invoices->invoice_text_details();
		$data=array(
			'title'			      =>display('invoice_details'),
			'invoice_id'	      =>$invoice_detail[0]['invoice_id'],
			'invoice_no'	      =>$invoice_detail[0]['invoice'],
			'customer_name'	      =>$invoice_detail[0]['customer_name'],
			'customer_address'    =>$invoice_detail[0]['customer_short_address'],
			'customer_mobile'     =>$invoice_detail[0]['customer_mobile'],
			'customer_email'      =>$invoice_detail[0]['customer_email'],
			'final_date'	      =>$invoice_detail[0]['final_date'],
			'total_amount'	      =>$invoice_detail[0]['total_amount'],
			'subTotal_discount'   =>$invoice_detail[0]['total_discount'],
			'service_charge'      =>$invoice_detail[0]['service_charge'],
			'shipping_charge'     =>$invoice_detail[0]['shipping_charge'],
			'paid_amount'	      =>$invoice_detail[0]['paid_amount'],
			'due_amount'	      =>$invoice_detail[0]['due_amount'],
			'invoice_details'     =>$invoice_detail[0]['invoice_details'],
			'subTotal_quantity'   =>$subTotal_quantity,
			'invoice_all_data'    =>$invoice_detail,
			'company_info'	      =>$company_info,
			'position' 		      =>$currency_details[0]['currency_position'],
			'currency' 		      =>$currency_details[0]['currency_icon'],
			'invoice_text_details'=>$invoice_text_details,
			);
		$data['Soft_settings'] = $CI->Soft_settings->retrieve_setting_editdata();

		$CI->load->view('dashboard/invoice/pos_invoice_html_redirect',$data);
	}
}