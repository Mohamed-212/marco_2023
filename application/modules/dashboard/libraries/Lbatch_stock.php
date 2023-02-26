<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lbatch_stock {
	//Add block
	public function batch_wise_stock($filter=null)
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Blocks');
		$CI->load->model('dashboard/Reports');
		$CI->load->model('dashboard/Batch_wise_stock_model');
		$company_info = $CI->Reports->retrieve_company();
		$batch_wise_product = $CI->Batch_wise_stock_model->batch_wise_product($filter);
		$stock_data = [];
		if ($batch_wise_product) {
			foreach($batch_wise_product as $product) {
				$sale_quantity = 0;
				$total_sale = $CI->Batch_wise_stock_model->batch_wise_invoice_details($product['batch_no']);
				// batch wise stock price
				$stock_data[] = array(
					'product_id'       =>$product['product_id'],
					'product_name'     =>$product['product_name'],
					'batch_no'         =>$product['batch_no'],
					'expiry_date'      =>$product['expiry_date'],
					'purchase_quantity'=>$product['quantity'],
					'sale_quantity'    =>$total_sale[0]['total_sale'],
					'current_quantity' =>$product['quantity']-$total_sale[0]['total_sale'],
					'supplier_rate'    =>$product['supplier_price'],
					'rate'             =>$product['price'],
				);
			}
		}
		
		$data = array(
				'title'       =>display('batch_wise_stock'),
				'company_info'=>$company_info,
				'stock_data'  =>$stock_data,
			);
		$content = $CI->parser->parse('dashboard/batch_wise_stock/batch_wise_stock',$data,true);
		return $content;
	}
}
?>