<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Linvoice {
		//Retrieve  Invoice List
	public function invoice_list()
	{
		$CI =& get_instance();
		$CI->load->model('web/customer/Invoices');
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
		$invoiceList = $CI->parser->parse('web/customer/invoice/invoice',$data,true);
		return $invoiceList;
	}

	//Invoice html Data
	public function invoice_html_data_old($invoice_id)
	{
		$CI =& get_instance();
		$CI->load->model('web/customer/Invoices');
		$CI->load->model('web/customer/Orders');
		$CI->load->model('dashboard/Soft_settings');
		$CI->load->model('dashboard/Shipping_methods');
		$CI->load->library('dashboard/occational');
		$invoice_detail = $CI->Invoices->retrieve_invoice_html_data($invoice_id);

 		$shipping_method = $CI->Shipping_methods->shipping_method_search_item($invoice_detail[0]['shipping_method']);

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
		$company_info = $CI->Orders->retrieve_company();
		$data=array(
			'title'				=>	display('invoice_details'),
			'invoice_id'		=>	$invoice_detail[0]['invoice_id'],
			'invoice_no'		=>	$invoice_detail[0]['invoice'],
			'customer_name'		=>	$invoice_detail[0]['customer_name'],
			'customer_mobile'	=>	$invoice_detail[0]['customer_mobile'],
			'customer_email'	=>	$invoice_detail[0]['customer_email'],
			'final_date'		=>	$invoice_detail[0]['final_date'],
			'total_amount'		=>	$invoice_detail[0]['total_amount'],
			'invoice_discount'	=>	$invoice_detail[0]['invoice_discount'],
			'total_discount'	=>	$invoice_detail[0]['total_discount'],
			'service_charge'	=>	$invoice_detail[0]['service_charge'],
			'shipping_charge'	=>	$invoice_detail[0]['shipping_charge'],
			'shipping_method'	=>  $shipping_method[0]['method_name'],
			'paid_amount'		=>	$invoice_detail[0]['paid_amount'],
			'due_amount'		=>	$invoice_detail[0]['due_amount'],
			'details'			=>	$invoice_detail[0]['invoice_details'],
			'subTotal_quantity'	=>	$subTotal_quantity,
			'invoice_all_data'	=>	$invoice_detail,
			'company_info'		=>	$company_info,
			'currency' 			=> $currency_details[0]['currency_icon'],
			'position' 			=> $currency_details[0]['currency_position'],
			);

		$chapterList = $CI->parser->parse('web/customer/invoice/invoice_html',$data,true);
		return $chapterList;
	}

	public function invoice_html_data_older($invoice_id)
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
			'hide_discount' => $hide_discount
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
		
		$chapterList = $CI->parser->parse('web/customer/invoice/invoice_html',$data,true);
		return $chapterList;
	}


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
		
		$chapterList = $CI->parser->parse('web/customer/invoice/invoice_html',$data,true);
		return $chapterList;
	}

}
?>