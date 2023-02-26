<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Quotations extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('auth');
		$this->load->library('lcustomer');
		$this->load->library('session');
		$this->load->model('Customers');
		$this->auth->check_user_auth();
	}

	//Count quotation
	public function count_quotation()
	{
		return $this->db->count_all("quotation");
	}

	//quotation List
	public function quotation_list()
	{
		$this->db->select('a.*,b.customer_name');
		$this->db->from('quotation a');
		$this->db->join('customer_information b', 'b.customer_id = a.customer_id');
		$this->db->order_by('a.quotation', 'desc');
		$this->db->limit('500');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}

	//Stock Report by date
	public function stock_report_bydate($product_id)
	{
		$this->db->select("
				SUM(d.quantity) as 'totalSalesQnty',
				SUM(b.quantity) as 'totalPurchaseQnty',
				(sum(b.quantity) - sum(d.quantity)) as stock
			");
		$this->db->from('product_information a');
		$this->db->join('product_purchase_details b', 'b.product_id = a.product_id', 'left');
		$this->db->join('quotation_details d', 'd.product_id = a.product_id', 'left');
		$this->db->join('product_purchase e', 'e.purchase_id = b.purchase_id', 'left');
		$this->db->group_by('a.product_id');
		$this->db->order_by('a.product_name', 'asc');
		if (empty($product_id)) {
			$this->db->where(array('a.status' => 1));
		} else {
			//Single product information 
			$this->db->where('a.product_id', $product_id);
		}
		$query = $this->db->get();

		return $query->row();
	}

	//quotation Search Item
	public function search_inovoice_item($customer_id)
	{
		$this->db->select('a.*,b.customer_name');
		$this->db->from('quotation a');
		$this->db->join('customer_information b', 'b.customer_id = a.customer_id');
		$this->db->where('b.customer_id', $customer_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}

	//POS quotation entry
	public function pos_quotation_setup($product_id)
	{
		$product_information = $this->db->select('*')
			->from('product_information')
			->where('product_id', $product_id)
			->get()
			->row();

		if ($product_information != null) {

			$this->db->select('SUM(a.quantity) as total_purchase');
			$this->db->from('product_purchase_details a');
			$this->db->where('a.product_id', $product_id);
			$total_purchase = $this->db->get()->row();

			$this->db->select('SUM(b.quantity) as total_sale');
			$this->db->from('quotation_details b');
			$this->db->where('b.product_id', $product_id);
			$total_sale = $this->db->get()->row();

			$data2 = (object)array(
				'total_product' => ($total_purchase->total_purchase - $total_sale->total_sale),
				'supplier_price' => $product_information->supplier_price,
				'price'         => $product_information->price,
				'supplier_id'   => $product_information->supplier_id,
				'tax'           => $product_information->tax,
				'product_id'    => $product_information->product_id,
				'product_name'  => $product_information->product_name,
				'product_model' => $product_information->product_model,
				'unit'          => $product_information->unit,
			);

			return $data2;
		} else {
			return false;
		}
	}

	//POS customer setup
	public function pos_customer_setup()
	{
		$query = $this->db->select('*')
			->from('customer_information')
			->where('customer_name', 'Walking Customer')
			->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	//POS customer list
	public function customer_list()
	{
		$query = $this->db->select('*')
			->from('customer_information')
			->where('customer_name !=', 'Walking Customer')
			->order_by('customer_name', 'asc')
			->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	//Customer entry
	public function customer_entry($data)
	{

		$this->db->select('*');
		$this->db->from('customer_information');
		$this->db->where('customer_name', $data['customer_name']);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return FALSE;
		} else {
			$this->db->insert('customer_information', $data);

			$this->db->select('*');
			$this->db->from('customer_information');
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

	//update_quotation
	public function update_quotation_older()
	{

		//Quotation and customer info
		$quotation_id  = $this->input->post('quotation_id', TRUE);
		$customer_id   = $this->input->post('customer_id', TRUE);
		$invoice_discount  = $this->input->post('invoice_discount', TRUE);
		$total_discount   = $this->input->post('total_discount', TRUE);

		$quotation_discount = $invoice_discount + $total_discount;

		if (!empty($quotation_id)) {
			//Data update into quotation table
			$data = array(
				'customer_id'		=>	$customer_id,
				'date'				=>	$this->input->post('invoice_date', TRUE),
				'expire_date'		=>	$this->input->post('expire_date', TRUE),
				'total_amount'		=>	$this->input->post('grand_total_price', TRUE),
				'quotation'			=>	$this->input->post('quotation', TRUE),
				'total_discount' 	=> 	$this->input->post('total_discount', TRUE),
				'details' 			=> 	$this->input->post('details', TRUE),
				'quotation_discount' => (!empty($quotation_discount) ? $quotation_discount : 0),
				'service_charge'	=> 	$this->input->post('service_charge', TRUE),
				'user_id'			=>	$this->session->userdata('user_id'),
				'store_id'			=>	$this->input->post('store_id', TRUE),
				'paid_amount'		=>	$this->input->post('paid_amount', TRUE),
				'due_amount'		=>	$this->input->post('due_amount', TRUE),
				'status'			=>	$this->input->post('status', TRUE),
				'is_quotation'		=> ($this->input->post('is_quotation', True)) ? $this->input->post('is_quotation', True) : 0,
				'employee_id' => $this->input->post('employee_id', true),
			);

			$this->db->update('quotation', $data, array('quotation_id' => $quotation_id));
		}



		//Quotation details info
		$rate 			= $this->input->post('product_rate', TRUE);
		$p_id 			= $this->input->post('product_id', TRUE);
		$total_amount	= $this->input->post('total_price', TRUE);
		$discount 		= $this->input->post('discount', TRUE);
		$variants 		= $this->input->post('variant_id', TRUE);
		$color_variants = $this->input->post('color_variant', TRUE);
		$color = $this->input->post('colorv', TRUE);
		$size = $this->input->post('sizev', TRUE);
		$quotation_d_id = $this->input->post('quotation_details_id', TRUE);
		$quantity 		= $this->input->post('product_quantity', TRUE);

		//invoice details for invoice
		if (!empty($p_id)) {

			//Delete old quotation details info
			if (!empty($quotation_id)) {
				$this->db->where('quotation_id', $quotation_id);
				$this->db->delete('quotation_details');
			}

			for ($i = 0, $n = count($p_id); $i < $n; $i++) {
				$product_quantity = $quantity[$i];
				$product_rate 	  = $rate[$i];
				$product_id 	  = $p_id[$i];
				$discount_rate 	  = $discount[$i];
				$total_price 	  = $total_amount[$i];
				//$variant_id		  = $variants[$i];
				//$variant_color	  = (!empty($color_variants) ? @$color_variants[$i] : null);
				$variant_id = $size[$i];
				$variant_color = $color[$i];
				$supplier_rate    = $this->supplier_rate($product_id);

				$quotation_details = array(
					'quotation_details_id'	=>	$this->auth->generator(15),
					'quotation_id'			=>	$quotation_id,
					'product_id'			=>	$product_id,
					'variant_id'			=>	$variant_id,
					'variant_color'			=>	$variant_color,
					'quantity'				=>	$product_quantity,
					'rate'					=>	$product_rate,
					'store_id'				=>	$this->input->post('store_id', TRUE),
					'supplier_rate'         =>	$supplier_rate[0]['supplier_price'],
					'total_price'           =>	$total_price,
					'discount'           	=>	$discount_rate,
					'status'				=>	1
				);

				if (!empty($p_id)) {
					$this->db->select('*');
					$this->db->from('quotation_details');
					$this->db->where('quotation_id', $quotation_id);
					$this->db->where('product_id', $product_id);
					$this->db->where('variant_id', $variant_id);
					if (!empty($variant_color)) {
						$this->db->where('variant_color', $variant_color);
					}
					$result = $this->db->get()->num_rows();

					if ($result > 0) {
						$this->db->set('quantity', 'quantity+' . $product_quantity, FALSE);
						$this->db->set('total_price', 'total_price+' . $total_price, FALSE);
						$this->db->where('quotation_id', $quotation_id);
						$this->db->where('product_id', $product_id);
						$this->db->where('variant_id', $variant_id);
						if (!empty($variant_color)) {
							$this->db->where('variant_color', $variant_color);
						}
						$this->db->update('quotation_details');
					} else {
						$this->db->insert('quotation_details', $quotation_details);
					}
				}
			}
		}


		//Quotation tax collection summary
		$cgst = $this->input->post('cgst', TRUE);
		$sgst = $this->input->post('sgst', TRUE);
		$igst = $this->input->post('igst', TRUE);
		$cgst_id = $this->input->post('cgst_id', TRUE);
		$sgst_id = $this->input->post('sgst_id', TRUE);
		$igst_id = $this->input->post('igst_id', TRUE);
		//Tax collection summary for three

		//Delete all tax  from summary
		$this->db->where('quotation_id', $quotation_id);
		$this->db->delete('quotation_tax_col_summary');

		//CGST Tax Summary
		if (!empty($cgst)) {
			for ($i = 0, $n = count($cgst); $i < $n; $i++) {
				$cgst_tax = $cgst[$i];
				$cgst_tax_id = $cgst_id[$i];
				$cgst_summary = array(
					'quot_tax_col_id'	=>	$this->auth->generator(15),
					'quotation_id'		=>	$quotation_id,
					'tax_amount' 		=> 	$cgst_tax,
					'tax_id' 			=> 	$cgst_tax_id,
					'date'				=>	$this->input->post('invoice_date', TRUE),
				);
				if (!empty($cgst[$i])) {
					$result = $this->db->select('*')
						->from('quotation_tax_col_summary')
						->where('quotation_id', $quotation_id)
						->where('tax_id', $cgst_tax_id)
						->get()
						->num_rows();
					if ($result > 0) {
						$this->db->set('tax_amount', 'tax_amount+' . $cgst_tax, FALSE);
						$this->db->where('quotation_id', $quotation_id);
						$this->db->where('tax_id', $cgst_tax_id);
						$this->db->update('quotation_tax_col_summary');
					} else {
						$this->db->insert('quotation_tax_col_summary', $cgst_summary);
					}
				}
			}
		}

		//SGST Tax Summary
		if (!empty($sgst)) {
			for ($i = 0, $n = count($sgst); $i < $n; $i++) {
				$sgst_tax 	 = $sgst[$i];
				$sgst_tax_id = $sgst_id[$i];

				$sgst_summary = array(
					'quot_tax_col_id'	=>	$this->auth->generator(15),
					'quotation_id'		=>	$quotation_id,
					'tax_amount' 		=> 	$sgst_tax,
					'tax_id' 			=> 	$sgst_tax_id,
					'date'				=>	$this->input->post('invoice_date', TRUE),
				);
				if (!empty($sgst[$i])) {
					$result = $this->db->select('*')
						->from('quotation_tax_col_summary')
						->where('quotation_id', $quotation_id)
						->where('tax_id', $sgst_tax_id)
						->get()
						->num_rows();
					if ($result > 0) {
						$this->db->set('tax_amount', 'tax_amount+' . $sgst_tax, FALSE);
						$this->db->where('quotation_id', $quotation_id);
						$this->db->where('tax_id', $sgst_tax_id);
						$this->db->update('quotation_tax_col_summary');
					} else {
						$this->db->insert('quotation_tax_col_summary', $sgst_summary);
					}
				}
			}
		}

		//IGST Tax Summary
		if (!empty($igst)) {
			for ($i = 0, $n = count($igst); $i < $n; $i++) {
				$igst_tax = $igst[$i];
				$igst_tax_id = $igst_id[$i];

				$igst_summary = array(
					'quot_tax_col_id'	=>	$this->auth->generator(15),
					'quotation_id'		=>	$quotation_id,
					'tax_amount' 		=> 	$igst_tax,
					'tax_id' 			=> 	$igst_tax_id,
					'date'				=>	$this->input->post('invoice_date', TRUE),
				);
				if (!empty($igst[$i])) {
					$result = $this->db->select('*')
						->from('quotation_tax_col_summary')
						->where('quotation_id', $quotation_id)
						->where('tax_id', $igst_tax_id)
						->get()
						->num_rows();

					if ($result > 0) {
						$this->db->set('tax_amount', 'tax_amount+' . $igst_tax, FALSE);
						$this->db->where('quotation_id', $quotation_id);
						$this->db->where('tax_id', $igst_tax_id);
						$this->db->update('quotation_tax_col_summary');
					} else {
						$this->db->insert('quotation_tax_col_summary', $igst_summary);
					}
				}
			}
		}
		//Tax collection summary for three

		//Delete all tax  from summary
		$this->db->where('quotation_id', $quotation_id);
		$this->db->delete('quotation_tax_col_details');

		//Tax collection details for three
		//CGST Tax Details
		if (!empty($cgst)) {
			for ($i = 0, $n = count($cgst); $i < $n; $i++) {
				$cgst_tax 	 = $cgst[$i];
				$cgst_tax_id = $cgst_id[$i];
				$product_id  = $p_id[$i];
				$variant_id  = $variants[$i];
				$cgst_details = array(
					'quot_tax_col_de_id'	=>	$this->auth->generator(15),
					'quotation_id'		=>	$quotation_id,
					'amount' 			=> 	$cgst_tax,
					'product_id' 		=> 	$product_id,
					'tax_id' 			=> 	$cgst_tax_id,
					'variant_id' 		=> 	$variant_id,
					'date'				=>	$this->input->post('invoice_date', TRUE),
				);
				if (!empty($cgst[$i])) {
					$result = $this->db->select('*')
						->from('quotation_tax_col_details')
						->where('quotation_id', $quotation_id)
						->where('tax_id', $cgst_tax_id)
						->where('product_id', $product_id)
						->where('variant_id', $variant_id)
						->get()
						->num_rows();
					if ($result > 0) {
						$this->db->set('amount', 'amount+' . $cgst_tax, FALSE);
						$this->db->where('quotation_id', $quotation_id);
						$this->db->where('tax_id', $cgst_tax_id);
						$this->db->where('variant_id', $variant_id);
						$this->db->update('quotation_tax_col_details');
					} else {
						$this->db->insert('quotation_tax_col_details', $cgst_details);
					}
				}
			}
		}

		//SGST Tax Details
		if (!empty($sgst)) {
			for ($i = 0, $n = count($sgst); $i < $n; $i++) {
				$sgst_tax 	 = $sgst[$i];
				$sgst_tax_id = $sgst_id[$i];
				$product_id  = $p_id[$i];
				$variant_id  = $variants[$i];
				$sgst_summary = array(
					'quot_tax_col_de_id'	=>	$this->auth->generator(15),
					'quotation_id'		=>	$quotation_id,
					'amount' 			=> 	$sgst_tax,
					'product_id' 		=> 	$product_id,
					'tax_id' 			=> 	$sgst_tax_id,
					'variant_id' 		=> 	$variant_id,
					'date'				=>	$this->input->post('invoice_date', TRUE),
				);
				if (!empty($sgst[$i])) {
					$result = $this->db->select('*')
						->from('quotation_tax_col_details')
						->where('quotation_id', $quotation_id)
						->where('tax_id', $sgst_tax_id)
						->where('product_id', $product_id)
						->where('variant_id', $variant_id)
						->get()
						->num_rows();
					if ($result > 0) {
						$this->db->set('amount', 'amount+' . $sgst_tax, FALSE);
						$this->db->where('quotation_id', $quotation_id);
						$this->db->where('tax_id', $sgst_tax_id);
						$this->db->where('variant_id', $variant_id);
						$this->db->update('quotation_tax_col_details');
					} else {
						$this->db->insert('quotation_tax_col_details', $sgst_summary);
					}
				}
			}
		}

		//IGST Tax Details
		if (!empty($igst)) {
			for ($i = 0, $n = count($igst); $i < $n; $i++) {
				$igst_tax = $igst[$i];
				$igst_tax_id = $igst_id[$i];
				$product_id = $p_id[$i];

				if (!empty($igst[$i])) {
					$this->db->set('amount', $igst_tax, FALSE);
					$this->db->where('product_id', $product_id);
					$this->db->where('tax_id', $igst_tax_id);
					$this->db->update('quotation_tax_col_details');
				}
			}
		}

		if (!empty($igst)) {
			for ($i = 0, $n = count($igst); $i < $n; $i++) {
				$igst_tax 	 = $igst[$i];
				$igst_tax_id = $igst_id[$i];
				$product_id  = $p_id[$i];
				$variant_id  = $variants[$i];
				$igst_summary = array(
					'quot_tax_col_de_id'	=>	$this->auth->generator(15),
					'quotation_id'		=>	$quotation_id,
					'amount' 			=> 	$igst_tax,
					'product_id' 		=> 	$product_id,
					'tax_id' 			=> 	$igst_tax_id,
					'variant_id' 		=> 	$variant_id,
					'date'				=>	$this->input->post('invoice_date', TRUE),
				);
				if (!empty($igst[$i])) {
					$result = $this->db->select('*')
						->from('quotation_tax_col_details')
						->where('quotation_id', $quotation_id)
						->where('tax_id', $igst_tax_id)
						->where('product_id', $product_id)
						->where('variant_id', $variant_id)
						->get()
						->num_rows();
					if ($result > 0) {
						$this->db->set('amount', 'amount+' . $igst_tax, FALSE);
						$this->db->where('quotation_id', $quotation_id);
						$this->db->where('tax_id', $igst_tax_id);
						$this->db->where('variant_id', $variant_id);
						$this->db->update('quotation_tax_col_details');
					} else {
						$this->db->insert('quotation_tax_col_details', $igst_summary);
					}
				}
			}
		}
		//End tax details
		return $quotation_id;
	}

	//Quotation entry
	public function quotation_entry_old()
	{
		//Quotation entry info
		$quotation_id 		= $this->auth->generator(15);
		$quantity 			= $this->input->post('product_quantity', TRUE);
		$available_quantity = $this->input->post('available_quantity', TRUE);
		$product_id 		= $this->input->post('product_id', TRUE);
		$expire_date        = $this->input->post('expire_date', true);
		$batch              = $this->input->post('batch_no', true);
		$customer_id        = $this->input->post('customer_id', TRUE);

		//Stock availability check
		$result = array();
		foreach ($available_quantity as $k => $v) {
			if ($v < $quantity[$k]) {
				$this->session->set_userdata(array('error_message' => display('you_can_not_buy_greater_than_available_cartoon')));
				redirect('dashboard/Cquotation');
			}
		}
		//Product existing check
		if ($product_id == null) {
			$this->session->set_userdata(array('error_message' => display('please_select_product')));
			redirect('dashboard/Cquotation');
		}
		//Customer existing check
		if (($this->input->post('customer_name_others', TRUE) == null) && ($customer_id == null)) {
			$this->session->set_userdata(array('error_message' => display('please_select_customer')));
			redirect('dashboard/Cquotation');
		}
		//Customer data Existence Check.
		// if ($customer_id == "") {
		//     $customer_id = $this->auth->generator(15);
		//     //Customer  basic information adding.
		//     $data = array(
		//         'customer_id' 	    => $customer_id,
		//         'customer_name'     => $this->input->post('customer_name_others', TRUE),
		//         'customer_address_1' => $this->input->post('customer_name_others_address', TRUE),
		//         'customer_mobile' 	=> $this->input->post('customer_mobile_no', TRUE),
		//         'customer_email' 	=> "NONE",
		//         'status' 			=> 1
		//     );
		//     $this->Customers->customer_entry($data);
		//     //Previous balance adding -> Sending to customer model to adjust the data.
		//     $this->Customers->previous_balance_add(0, $customer_id);
		// } else {
		$customer_id = $this->input->post('customer_id', TRUE);
		// }
		//Data inserting into quotation table
		$invoice_discount = $this->input->post('invoice_discount', TRUE);
		$total_discount   = $this->input->post('total_discount', TRUE);
		$data = array(
			'quotation_id'		=> $quotation_id,
			'customer_id'		=> $customer_id,
			'date'				=> $this->input->post('invoice_date', TRUE),
			'expire_date'		=> $expire_date,
			'total_amount'		=> $this->input->post('grand_total_price', TRUE),
			'quotation'			=> 'Quot-' . $this->number_generator(),
			'details'			=> $this->input->post('details', true),
			'total_discount' 	=> $this->input->post('total_discount', TRUE),
			'quotation_discount' => (!empty($invoice_discount) ? $invoice_discount : 0) + (!empty($total_discount) ? $total_discount : 0),
			'service_charge'	=> $this->input->post('service_charge', TRUE),
			'user_id'			=> $this->session->userdata('user_id'),
			'store_id'			=> $this->input->post('store_id', TRUE),
			'is_quotation'		=> ($this->input->post('is_quotation', True)) ? $this->input->post('is_quotation', True) : 0,
			'employee_id' => $this->input->post('employee_id', true),
			'status'			=> 1
		);
		$this->db->insert('quotation', $data);
		// Information for quotation details
		$rate 		   = $this->input->post('product_rate', TRUE);
		$p_id 		   = $this->input->post('product_id', TRUE);
		$total_amount  = $this->input->post('total_price', TRUE);
		$discount 	   = $this->input->post('discount', TRUE);
		$variants 	   = $this->input->post('variant_id', TRUE);
		$color_variants = $this->input->post('color_variant', TRUE);
		$color = $this->input->post('colorv', TRUE);
		$size = $this->input->post('sizev', TRUE);
		//Entry for Quotation Details
		for ($i = 0, $n = count($quantity); $i < $n; $i++) {
			$product_quantity = $quantity[$i];
			$product_rate 	  = $rate[$i];
			$product_id 	  = $p_id[$i];
			$batch_no         = $batch[$i];
			$discount_rate 	  = $discount[$i];
			$total_price      = $total_amount[$i];
			//			$variant_id		  = $variants[$i];
			//			$color_variant	  = (!empty($color_variants) ? @$color_variants[$i] : null);
			$variant_id = $size[$i];
			$color_variant = $color[$i];
			$supplier_rate 	  = $this->supplier_rate($product_id);

			$quotation_details = array(
				'quotation_details_id' => $this->auth->generator(15),
				'quotation_id'		  => $quotation_id,
				'product_id'		  => $product_id,
				'batch_no'		      => $batch_no,
				'variant_id'		  => $variant_id,
				'variant_color'		  => $color_variant,
				'store_id'			  => $this->input->post('store_id', TRUE),
				'quantity'			  => $product_quantity,
				'rate'				  => $product_rate,
				'supplier_rate'       => $supplier_rate[0]['supplier_price'],
				'total_price'         => $total_price,
				'discount'            => $discount_rate,
				'status'			  => 1
			);
			if (!empty($quantity)) {
				$this->db->select('*');
				$this->db->from('quotation_details');
				$this->db->where('quotation_id', $quotation_id);
				$this->db->where('product_id', $product_id);
				$this->db->where('variant_id', $variant_id);
				if (!empty($color_variant)) {
					$this->db->where('variant_color', $color_variant);
				}
				$result = $this->db->get()->num_rows();
				if ($result > 0) {
					$this->db->set('quantity', 'quantity+' . $product_quantity, FALSE);
					$this->db->set('total_price', 'total_price+' . $total_price, FALSE);
					$this->db->where('quotation_id', $quotation_id);
					$this->db->where('product_id', $product_id);
					$this->db->where('variant_id', $variant_id);
					if (!empty($color_variant)) {
						$this->db->where('variant_color', $color_variant);
					}
					$this->db->update('quotation_details');
				} else {
					$this->db->insert('quotation_details', $quotation_details);
				}
			}
		}

		//Tax information
		$cgst = $this->input->post('cgst', TRUE);
		$sgst = $this->input->post('sgst', TRUE);
		$igst = $this->input->post('igst', TRUE);
		$cgst_id = $this->input->post('cgst_id', TRUE);
		$sgst_id = $this->input->post('sgst_id', TRUE);
		$igst_id = $this->input->post('igst_id', TRUE);

		//Tax collection summary for three start
		//CGST Tax Summary
		for ($i = 0, $n = count($cgst); $i < $n; $i++) {
			$cgst_tax = $cgst[$i];
			$cgst_tax_id = $cgst_id[$i];
			$cgst_summary = array(
				'quot_tax_col_id'	=>	$this->auth->generator(15),
				'quotation_id'		=>	$quotation_id,
				'tax_amount' 		=> 	$cgst_tax,
				'tax_id' 			=> 	$cgst_tax_id,
				'date'				=>	$this->input->post('invoice_date', TRUE),
			);
			if (!empty($cgst[$i])) {
				$result = $this->db->select('*')
					->from('quotation_tax_col_summary')
					->where('quotation_id', $quotation_id)
					->where('tax_id', $cgst_tax_id)
					->get()
					->num_rows();
				if ($result > 0) {
					$this->db->set('tax_amount', 'tax_amount+' . $cgst_tax, FALSE);
					$this->db->where('quotation_id', $quotation_id);
					$this->db->where('tax_id', $cgst_tax_id);
					$this->db->update('quotation_tax_col_summary');
				} else {
					$this->db->insert('quotation_tax_col_summary', $cgst_summary);
				}
			}
		}

		//SGST Tax Summary
		for ($i = 0, $n = count($sgst); $i < $n; $i++) {
			$sgst_tax = $sgst[$i];
			$sgst_tax_id = $sgst_id[$i];

			$sgst_summary = array(
				'quot_tax_col_id'	=>	$this->auth->generator(15),
				'quotation_id'		=>	$quotation_id,
				'tax_amount' 		=> 	$sgst_tax,
				'tax_id' 			=> 	$sgst_tax_id,
				'date'				=>	$this->input->post('invoice_date', TRUE),
			);
			if (!empty($sgst[$i])) {
				$result = $this->db->select('*')
					->from('quotation_tax_col_summary')
					->where('quotation_id', $quotation_id)
					->where('tax_id', $sgst_tax_id)
					->get()
					->num_rows();
				if ($result > 0) {
					$this->db->set('tax_amount', 'tax_amount+' . $sgst_tax, FALSE);
					$this->db->where('quotation_id', $quotation_id);
					$this->db->where('tax_id', $sgst_tax_id);
					$this->db->update('quotation_tax_col_summary');
				} else {
					$this->db->insert('quotation_tax_col_summary', $sgst_summary);
				}
			}
		}

		//IGST Tax Summary
		for ($i = 0, $n = count($igst); $i < $n; $i++) {
			$igst_tax = $igst[$i];
			$igst_tax_id = $igst_id[$i];

			$igst_summary = array(
				'quot_tax_col_id'	=>	$this->auth->generator(15),
				'quotation_id'		=>	$quotation_id,
				'tax_amount' 		=> 	$igst_tax,
				'tax_id' 			=> 	$igst_tax_id,
				'date'				=>	$this->input->post('invoice_date', TRUE),
			);
			if (!empty($igst[$i])) {
				$result = $this->db->select('*')
					->from('quotation_tax_col_summary')
					->where('quotation_id', $quotation_id)
					->where('tax_id', $igst_tax_id)
					->get()
					->num_rows();

				if ($result > 0) {
					$this->db->set('tax_amount', 'tax_amount+' . $igst_tax, FALSE);
					$this->db->where('quotation_id', $quotation_id);
					$this->db->where('tax_id', $igst_tax_id);
					$this->db->update('quotation_tax_col_summary');
				} else {
					$this->db->insert('quotation_tax_col_summary', $igst_summary);
				}
			}
		}
		//Tax collection summary for three end

		//Tax collection details for three
		//CGST Tax Details
		for ($i = 0, $n = count($cgst); $i < $n; $i++) {
			$cgst_tax 	 = $cgst[$i];
			$cgst_tax_id = $cgst_id[$i];
			$product_id  = $p_id[$i];
			$variant_id  = $variants[$i];
			$cgst_details = array(
				'quot_tax_col_de_id' =>	$this->auth->generator(15),
				'quotation_id'		=>	$quotation_id,
				'amount' 			=> 	$cgst_tax,
				'product_id' 		=> 	$product_id,
				'tax_id' 			=> 	$cgst_tax_id,
				'variant_id' 		=> 	$variant_id,
				'date'				=>	$this->input->post('invoice_date', TRUE),
			);
			if (!empty($cgst[$i])) {

				$result = $this->db->select('*')
					->from('quotation_tax_col_details')
					->where('quotation_id', $quotation_id)
					->where('tax_id', $cgst_tax_id)
					->where('product_id', $product_id)
					->where('variant_id', $variant_id)
					->get()
					->num_rows();
				if ($result > 0) {
					$this->db->set('amount', 'amount+' . $cgst_tax, FALSE);
					$this->db->where('quotation_id', $quotation_id);
					$this->db->where('tax_id', $cgst_tax_id);
					$this->db->where('variant_id', $variant_id);
					$this->db->update('quotation_tax_col_details');
				} else {
					$this->db->insert('quotation_tax_col_details', $cgst_details);
				}
			}
		}

		//SGST Tax Details
		for ($i = 0, $n = count($sgst); $i < $n; $i++) {
			$sgst_tax 	 = $sgst[$i];
			$sgst_tax_id = $sgst_id[$i];
			$product_id  = $p_id[$i];
			$variant_id  = $variants[$i];
			$sgst_summary = array(
				'quot_tax_col_de_id'	=>	$this->auth->generator(15),
				'quotation_id'		=>	$quotation_id,
				'amount' 			=> 	$sgst_tax,
				'product_id' 		=> 	$product_id,
				'tax_id' 			=> 	$sgst_tax_id,
				'variant_id' 		=> 	$variant_id,
				'date'				=>	$this->input->post('invoice_date', TRUE),
			);
			if (!empty($sgst[$i])) {
				$result = $this->db->select('*')
					->from('quotation_tax_col_details')
					->where('quotation_id', $quotation_id)
					->where('tax_id', $sgst_tax_id)
					->where('product_id', $product_id)
					->where('variant_id', $variant_id)
					->get()
					->num_rows();
				if ($result > 0) {
					$this->db->set('amount', 'amount+' . $sgst_tax, FALSE);
					$this->db->where('quotation_id', $quotation_id);
					$this->db->where('tax_id', $sgst_tax_id);
					$this->db->where('variant_id', $variant_id);
					$this->db->update('quotation_tax_col_details');
				} else {
					$this->db->insert('quotation_tax_col_details', $sgst_summary);
				}
			}
		}
		//IGST Tax Details
		for ($i = 0, $n = count($igst); $i < $n; $i++) {
			$igst_tax 	 = $igst[$i];
			$igst_tax_id = $igst_id[$i];
			$product_id  = $p_id[$i];
			$variant_id  = $variants[$i];
			$igst_summary = array(
				'quot_tax_col_de_id' =>	$this->auth->generator(15),
				'quotation_id'		=>	$quotation_id,
				'amount' 			=> 	$igst_tax,
				'product_id' 		=> 	$product_id,
				'tax_id' 			=> 	$igst_tax_id,
				'variant_id' 		=> 	$variant_id,
				'date'				=>	$this->input->post('invoice_date', TRUE),
			);
			if (!empty($igst[$i])) {
				$result = $this->db->select('*')
					->from('quotation_tax_col_details')
					->where('quotation_id', $quotation_id)
					->where('tax_id', $igst_tax_id)
					->where('product_id', $product_id)
					->where('variant_id', $variant_id)
					->get()
					->num_rows();
				if ($result > 0) {
					$this->db->set('amount', 'amount+' . $igst_tax, FALSE);
					$this->db->where('quotation_id', $quotation_id);
					$this->db->where('tax_id', $igst_tax_id);
					$this->db->where('variant_id', $variant_id);
					$this->db->update('quotation_tax_col_details');
				} else {
					$this->db->insert('quotation_tax_col_details', $igst_summary);
				}
			}
		}
		//Tax collection details for three
		return $quotation_id;
	}



	public function quotation_entry($quotation_id = null, $quotationNo = null)
	{
		// if (check_module_status('accounting') == 1) {
			$find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
			if (!empty($find_active_fiscal_year)) {
				$invoice_id = $quotation_id ? $quotation_id : generator(15);
				$quotationNo = $quotationNo ? $quotationNo : 'Quot-' . $this->number_generator();
				$quantity = $this->input->post('product_quantity', TRUE);
				$available_quantity = $this->input->post('available_quantity', TRUE);
				$product_id = $this->input->post('product_id', TRUE);
				$pricing_type = $this->input->post('pri_type', TRUE);
				$product_type = $this->input->post('product_type', TRUE);

				//Stock availability check
				$result = array();
				foreach ($available_quantity as $k => $v) {
					if ($v < $quantity[$k]) {
						$this->session->set_userdata(array('error_message' => display('you_can_not_buy_greater_than_available_cartoon')));
						redirect('dashboard/Cquotation');
					}
				}

				//Product existing check
				if ($product_id == null) {
					$this->session->set_userdata(array('error_message' => display('please_select_product')));
					redirect('dashboard/Cquotation');
				}

				//Customer existing check
				if (($this->input->post('customer_name_others', TRUE) == null) && ($this->input->post('customer_id', TRUE) == null)) {
					$this->session->set_userdata(array('error_message' => display('please_select_customer')));
					redirect(base_url() . 'dashboard/Cquotation');
				}

				//Customer data Existence Check.
				$customer_id = $this->input->post('customer_id', TRUE);

				// create customer head start
				if (check_module_status('accounting') == 1) {
					$this->load->model('accounting/account_model');
					$check_customer = $this->db->select('customer_name')->from('customer_information')->where('customer_id', $customer_id)->get()->row();
					if (!empty($check_customer)) {
						$customer_data = $data = array(
							'customer_id' => $customer_id,
							'customer_name' => $check_customer->customer_name,
						);
					} else {
						$customer_data = $data = array(
							'customer_id' => $customer_id,
							'customer_name' => $this->input->post('customer_id', TRUE)
						);
					}
					$this->account_model->insert_customer_head($customer_data);
				}
				// create customer head END
				//Full or partial Payment record.
				if ($this->input->post('paid_amount', TRUE) > 0) {
					//Insert to customer_ledger Table 
					$data2 = array(
						'transaction_id' => generator(15),
						'customer_id' => $customer_id,
						'invoice_no' => $invoice_id,
						'receipt_no' => $this->auth->generator(15),
						'date' => $this->input->post('invoice_date', TRUE),
						'amount' => $this->input->post('paid_amount', TRUE),
						'payment_type' => 1,
						'description' => 'ITP',
						'status' => 1
					);
					$this->db->insert('quotation_customer_ledger', $data2);
				}

				//Insert to customer ledger Table 
				$data2 = array(
					'transaction_id' => generator(15),
					'customer_id' => $customer_id,
					'invoice_no' => $invoice_id,
					'date' => $this->input->post('invoice_date', TRUE),
					'amount' => $this->input->post('grand_total_price', TRUE),
					'status' => 1
				);
				$this->db->insert('quotation_customer_ledger', $data2);

				//Data inserting into invoice table
				(($this->input->post('total_cgst', true) && $this->input->post('is_quotation', true) == 0) ? $total_cgsti = $this->input->post('total_cgst', true) : $total_cgsti = 0);
				(($this->input->post('total_sgst', true)) ? $total_sgsti = $this->input->post('total_sgst', true) : $total_sgsti = 0);
				(($this->input->post('total_igst', true)) ? $total_igsti = $this->input->post('total_igst', true) : $total_igsti = 0);

				$tota_vati = $total_cgsti + $total_sgsti + $total_igsti;
				$installment_month_no = $this->input->post('month_no', true);
				$data = array(
					'quotation_id' => $invoice_id,
					'customer_id' => $customer_id,
					'date' => $this->input->post('invoice_date', TRUE),
					'total_amount' => $this->input->post('grand_total_price', TRUE),
					'quotation' => $quotationNo,
					'total_discount' => $this->input->post('total_discount', TRUE),
					'total_vat' => $tota_vati,
					'is_quotation' => ($this->input->post('is_quotation', True)) ? $this->input->post('is_quotation', True) : 0,
					'employee_id' => $this->input->post('employee_id', true),
					'is_installment' => $this->input->post('is_installment', true),
					'month_no' => $installment_month_no,
					'due_day' => $this->input->post('due_day', true),
					'quotation_discount' => $this->input->post('invoice_discount', TRUE),
					'percentage_discount' => $this->input->post('percentage_discount', TRUE),
					'user_id' => $this->session->userdata('user_id'),
					'store_id' => $this->input->post('store_id', TRUE),
					'paid_amount' => $this->input->post('paid_amount', TRUE),
					'due_amount' => $this->input->post('due_amount', TRUE),
					'service_charge' => $this->input->post('service_charge', TRUE),
					'shipping_charge' => $this->input->post('shipping_charge', TRUE) ? $this->input->post('shipping_charge', TRUE) : 0,
					'shipping_method' => $this->input->post('shipping_method', TRUE),
					'details' => $this->input->post('details', TRUE),
					'status' => 1,
					'created_at' => date("Y-m-d H:i:s", strtotime($this->input->post('invoice_date', TRUE))),
					'pricing_type' => $pricing_type,
					'product_type' => $product_type,
					'customer_balance' => $this->input->post('customer_balance', TRUE),
				);
				$this->db->insert('quotation', $data);

				// insert installment
				if ($this->input->post('is_installment', true) == 1) {
					$installment_amount = $this->input->post('amount', TRUE);
					$installment_due_date = $this->input->post('due_date', TRUE);
					for ($i = 0; $i < $installment_month_no; $i++) {
						$installment_data = array(
							'quotation_id' => $invoice_id,
							'amount' => $installment_amount[$i],
							'due_date' => $installment_due_date[$i],
						);
						$this->db->insert('quotation_installment', $installment_data);
					}
				}

				//Invoice details info
				$rate = $this->input->post('product_rate', TRUE);
				$p_id = $this->input->post('product_id', TRUE);
				$total_amount = $this->input->post('total_price', TRUE);
				$discount = $this->input->post('discount', TRUE);
				$variants = $this->input->post('variant_id', TRUE);
				// $pricing = $this->input->post('pricing', TRUE);
				$color_variants = $this->input->post('color_variant', TRUE);
				$color = $this->input->post('colorv', TRUE);
				$size = $this->input->post('sizev', TRUE);
				$assembly = $this->input->post('assembly', TRUE);
				$batch_no = $this->input->post('batch_no', TRUE);
				$cogs_price = 0;

				//Invoice details for invoice
				for ($i = 0, $n = count($quantity); $i < $n; $i++) {
					$product_assembly = $assembly[$i];

					if ($product_assembly == 1) {
						$product_quantity = $quantity[$i];
						$product_rate = $rate[$i];
						$product_id = $p_id[$i];
						$discount_rate = $discount[$i];
						$total_price = $total_amount[$i];
						//  $variant_id = $variants[$i];
						$variant_id = $size[$i];
						//$pricing_id = $pricing[$i];
						// $variant_color = $color_variants[$i];
						$variant_color = $color[$i];
						$batch = $batch_no[$i];
						$supplier_rate = $this->supplier_rate($product_id); // سعر التكلفة للمنتج الواحد
						$cogs_price += ($supplier_rate[0]['supplier_price'] * $product_quantity); // التكلفة للكمية كلها
						$invoice_details = array(
							'quotation_details_id' => generator(15),
							'quotation_id' => $invoice_id,
							'product_id' => $product_id,
							'variant_id' => $variant_id,
							//  'pricing_id' => $pricing_id,
							'variant_color' => $variant_color,
							'batch_no' => $batch,
							'store_id' => $this->input->post('store_id', TRUE),
							'quantity' => $product_quantity,
							'rate' => $product_rate,
							'supplier_rate' => $supplier_rate[0]['supplier_price'],
							'total_price' => $total_price,
							'discount' => $discount_rate,
							'status' => 1
						);

						if (!empty($quantity)) {
							$this->db->select('*');
							$this->db->from('invoice_details');
							$this->db->where('invoice_id', $invoice_id);
							$this->db->where('product_id', $product_id);
							$this->db->where('variant_id', $variant_id);
							if (!empty($variant_color)) {
								$this->db->where('variant_color', $variant_color);
							}
							$query = $this->db->get();
							$result = $query->num_rows();
							if ($result > 0) {
								$this->db->set('quantity', 'quantity+' . $product_quantity, FALSE);
								$this->db->set('total_price', 'total_price+' . $total_price, FALSE);
								$this->db->where('invoice_id', $invoice_id);
								$this->db->where('product_id', $product_id);
								$this->db->where('variant_id', $variant_id);
								if (!empty($variant_color)) {
									$this->db->where('variant_color', $variant_color);
								}
								$this->db->update('quotation_details');
							} else {
								$this->db->insert('quotation_details', $invoice_details);
							}
						}
						//////////////////////////////////////////////////////////////////////
						$this->db->select('*');
						$this->db->from('assembly_products');
						$this->db->where('parent_product_id', $product_id);
						$this->db->join('product_information', 'product_information.product_id = assembly_products.child_product_id');
						$query = $this->db->get();
						$product_list = $query->result();
						///////////////////////////////////////////////////////////////////////////
						if (!empty($product_list)) {
							foreach ($product_list as $product) {

								if (!empty($quantity)) {
									// stock 
									$store_id = $this->input->post('store_id', TRUE);
									$check_stock = $this->check_stock($store_id, $product->child_product_id, $variant_id, $variant_color);
									if (empty($check_stock)) {
										// insert
										$stock = array(
											'store_id' => $store_id,
											'product_id' => $product->child_product_id,
											'variant_id' => $variant_id,
											'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
											'quantity' => $product_quantity,
											'warehouse_id' => '',
										);
										$this->db->insert('quotation_stock_tbl', $stock);
										// insert
									} else {
										//update
										$stock = array(
											'quantity' => $check_stock->quantity + $product_quantity
										);
										if (!empty($store_id)) {
											$this->db->where('store_id', $store_id);
										}
										if (!empty($product->child_product_id)) {
											$this->db->where('product_id', $product->child_product_id);
										}
										if (!empty($variant_id)) {
											$this->db->where('variant_id', $variant_id);
										}
										if (!empty($variant_color)) {
											$this->db->where('variant_color', $variant_color);
										}
										$this->db->update('quotation_stock_tbl', $stock);
										//update
									}
									// stock
								}
							}
						}
					} else {
						$product_quantity = $quantity[$i];
						$product_rate = $rate[$i];
						$product_id = $p_id[$i];
						$discount_rate = $discount[$i];
						$total_price = $total_amount[$i];
						//  $variant_id = $variants[$i];
						$variant_id = $size[$i];
						//$pricing_id = $pricing[$i];
						// $variant_color = $color_variants[$i];
						$variant_color = $color[$i];
						$batch = $batch_no[$i];
						$supplier_rate = $this->supplier_rate($product_id); // سعر التكلفة للمنتج الواحد
						$cogs_price += ($supplier_rate[0]['supplier_price'] * $product_quantity); // التكلفة للكمية كلها

						$invoice_details = array(
							'quotation_details_id' => generator(15),
							'quotation_id' => $invoice_id,
							'product_id' => $product_id,
							'variant_id' => $variant_id,
							//  'pricing_id' => $pricing_id,
							'variant_color' => $variant_color,
							'batch_no' => $batch,
							'store_id' => $this->input->post('store_id', TRUE),
							'quantity' => $product_quantity,
							'rate' => $product_rate,
							'supplier_rate' => $supplier_rate[0]['supplier_price'],
							'total_price' => $total_price,
							'discount' => $discount_rate,
							'status' => 1
						);

						if (!empty($quantity)) {
							$this->db->select('*');
							$this->db->from('quotation_details');
							$this->db->where('quotation_id', $invoice_id);
							$this->db->where('product_id', $product_id);
							$this->db->where('variant_id', $variant_id);
							if (!empty($variant_color)) {
								$this->db->where('variant_color', $variant_color);
							}
							$query = $this->db->get();
							$result = $query->num_rows();
							if ($result > 0) {
								$this->db->set('quantity', 'quantity+' . $product_quantity, FALSE);
								$this->db->set('total_price', 'total_price+' . $total_price, FALSE);
								$this->db->where('quotation_id', $invoice_id);
								$this->db->where('product_id', $product_id);
								$this->db->where('variant_id', $variant_id);
								if (!empty($variant_color)) {
									$this->db->where('variant_color', $variant_color);
								}
								$this->db->update('quotation_details');
							} else {
								$this->db->insert('quotation_details', $invoice_details);
							}

							// stock 
							$store_id = $this->input->post('store_id', TRUE);
							$check_stock = $this->check_stock($store_id, $product_id, $variant_id, $variant_color);
							if (empty($check_stock)) {
								// insert
								$stock = array(
									'store_id' => $store_id,
									'product_id' => $product_id,
									'variant_id' => $variant_id,
									'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
									'quantity' => $product_quantity,
									'warehouse_id' => '',
								);
								$this->db->insert('quotation_stock_tbl', $stock);
								// insert
							} else {
								//update
								$stock = array(
									'quantity' => $check_stock->quantity + $product_quantity
								);
								if (!empty($store_id)) {
									$this->db->where('store_id', $store_id);
								}
								if (!empty($product_id)) {
									$this->db->where('product_id', $product_id);
								}
								if (!empty($variant_id)) {
									$this->db->where('variant_id', $variant_id);
								}
								if (!empty($variant_color)) {
									$this->db->where('variant_color', $variant_color);
								}
								$this->db->update('quotation_stock_tbl', $stock);
								//update
							}
							// stock
						}
					}
				}

				// SALES/INVOICE TRANSECTIONS ENTRY
				$customer_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('customer_id', $customer_id)->get()->row();

				$createdate = date('Y-m-d H:i:s');
				$receive_by = $this->session->userdata('user_id');
				$date = $createdate;

				$i_vat = $this->db->select('total_vat')->from('quotation')->where('quotation_id', $invoice_id)->get()->row();
				$tota_vat = $i_vat->total_vat;
				$total_with_vat = $this->input->post('grand_total_price', TRUE);
				$cogs_price = $cogs_price;
				$total_discount = $this->input->post('total_discount', TRUE);
				$total_price_before_discount = ($total_with_vat - $tota_vat) + $total_discount;
				$store_id = $this->input->post('store_id', TRUE);
				$store_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('store_id', $store_id)->get()->row();

				$payment_id = $this->input->post('payment_id', TRUE);
				$account_no = $this->input->post('account_no', TRUE);

				// SALES/INVOICE TRANSECTIONS END
				//Tax information
				$cgst = $this->input->post('cgst', TRUE);
				$sgst = $this->input->post('sgst', TRUE);
				$igst = $this->input->post('igst', TRUE);
				$cgst_id = $this->input->post('cgst_id', TRUE);
				$sgst_id = $this->input->post('sgst_id', TRUE);
				$igst_id = $this->input->post('igst_id', TRUE);
				//Tax collection summary for three start
				//CGST tax info
				if (!empty($cgst)) {
					for ($i = 0, $n = count(@$cgst); $i < $n; $i++) {
						$cgst_tax = $cgst[$i];
						$cgst_tax_id = $cgst_id[$i];
						$cgst_summary = array(
							'quot_tax_col_id ' => $this->auth->generator(15),
							'quotation_id' => $invoice_id,
							'tax_amount' => $cgst_tax,
							'tax_id' => $cgst_tax_id,
							'date' => $this->input->post('invoice_date', TRUE),
						);
						if (!empty($cgst[$i])) {
							$result = $this->db->select('*')
								->from('quotation_tax_col_summary')
								->where('quotation_id', $invoice_id)
								->where('tax_id', $cgst_tax_id)
								->get()
								->num_rows();
							if ($result > 0) {
								$this->db->set('tax_amount', 'tax_amount+' . $cgst_tax, FALSE);
								$this->db->where('quotation_id', $invoice_id);
								$this->db->where('tax_id', $cgst_tax_id);
								$this->db->update('quotation_tax_col_summary');
							} else {
								$this->db->insert('quotation_tax_col_summary', $cgst_summary);
							}
						}
					}
				}
				//SGST tax info
				if (!empty($sgst)) {
					for ($i = 0, $n = count($sgst); $i < $n; $i++) {
						$sgst_tax = $sgst[$i];
						$sgst_tax_id = $sgst_id[$i];

						$sgst_summary = array(
							'quot_tax_col_id ' => $this->auth->generator(15),
							'quotation_id' => $invoice_id,
							'tax_amount' => $sgst_tax,
							'tax_id' => $sgst_tax_id,
							'date' => $this->input->post('invoice_date', TRUE),
						);
						if (!empty($sgst[$i])) {
							$result = $this->db->select('*')
								->from('quotation_tax_col_summary')
								->where('quotation_id', $invoice_id)
								->where('tax_id', $sgst_tax_id)
								->get()
								->num_rows();
							if ($result > 0) {
								$this->db->set('tax_amount', 'tax_amount+' . $sgst_tax, FALSE);
								$this->db->where('quotation_id', $invoice_id);
								$this->db->where('tax_id', $sgst_tax_id);
								$this->db->update('quotation_tax_col_summary');
							} else {
								$this->db->insert('quotation_tax_col_summary', $sgst_summary);
							}
						}
					}
				}
				if (!empty($igst)) {
					//IGST tax info
					for ($i = 0, $n = count($igst); $i < $n; $i++) {
						$igst_tax = $igst[$i];
						$igst_tax_id = $igst_id[$i];

						$igst_summary = array(
							'quot_tax_col_id ' => generator(15),
							'quotation_id' => $invoice_id,
							'tax_amount' => $igst_tax,
							'tax_id' => $igst_tax_id,
							'date' => $this->input->post('invoice_date', TRUE),
						);
						if (!empty($igst[$i])) {
							$result = $this->db->select('*')
								->from('quotation_tax_col_summary')
								->where('quotation_id', $invoice_id)
								->where('tax_id', $igst_tax_id)
								->get()
								->num_rows();

							if ($result > 0) {
								$this->db->set('tax_amount', 'tax_amount+' . $igst_tax, FALSE);
								$this->db->where('quotation_id', $invoice_id);
								$this->db->where('tax_id', $igst_tax_id);
								$this->db->update('quotation_tax_col_summary');
							} else {
								$this->db->insert('quotation_tax_col_summary', $igst_summary);
							}
						}
					}
				}
				//Tax collection summary for three end
				//Tax collection details for three start
				//CGST tax info
				if (!empty($cgst)) {
					for ($i = 0, $n = count($cgst); $i < $n; $i++) {
						$cgst_tax = $cgst[$i];
						$cgst_tax_id = $cgst_id[$i];
						$product_id = $p_id[$i];
						$variant_id =  $size[$i];

						$cgst_details = array(
							'quot_tax_col_de_id' => generator(15),
							'quotation_id' => $invoice_id,
							'amount' => $cgst_tax,
							'product_id' => $product_id,
							'tax_id' => $cgst_tax_id,
							'variant_id' => $variant_id,
							'date' => $this->input->post('invoice_date', TRUE),
						);
						if (!empty($cgst[$i])) {

							$result = $this->db->select('*')
								->from('quotation_tax_col_details')
								->where('quotation_id', $invoice_id)
								->where('tax_id', $cgst_tax_id)
								->where('product_id', $product_id)
								->where('variant_id', $variant_id)
								->get()
								->num_rows();
							if ($result > 0) {
								$this->db->set('amount', 'amount+' . $cgst_tax, FALSE);
								$this->db->where('quotation_id', $invoice_id);
								$this->db->where('tax_id', $cgst_tax_id);
								$this->db->where('variant_id', $variant_id);
								$this->db->update('quotation_tax_col_details');
							} else {
								$this->db->insert('quotation_tax_col_details', $cgst_details);
							}
						}
					}
				}

				//SGST tax info
				if (!empty($sgst)) {
					for ($i = 0, $n = count($sgst); $i < $n; $i++) {
						$sgst_tax = $sgst[$i];
						$sgst_tax_id = $sgst_id[$i];
						$product_id = $p_id[$i];
						$variant_id = $size[$i];
						$sgst_summary = array(
							'quot_tax_col_de_id' => generator(15),
							'quotation_id' => $invoice_id,
							'amount' => $sgst_tax,
							'product_id' => $product_id,
							'tax_id' => $sgst_tax_id,
							'variant_id' => $variant_id,
							'date' => $this->input->post('invoice_date', TRUE),
						);
						if (!empty($sgst[$i])) {
							$result = $this->db->select('*')
								->from('quotation_tax_col_details')
								->where('quotation_id', $invoice_id)
								->where('tax_id', $sgst_tax_id)
								->where('product_id', $product_id)
								->where('variant_id', $variant_id)
								->get()
								->num_rows();
							if ($result > 0) {
								$this->db->set('amount', 'amount+' . $sgst_tax, FALSE);
								$this->db->where('quotation_id', $invoice_id);
								$this->db->where('tax_id', $sgst_tax_id);
								$this->db->where('variant_id', $variant_id);
								$this->db->update('quotation_tax_col_details');
							} else {
								$this->db->insert('quotation_tax_col_details', $sgst_summary);
							}
						}
					}
				}
				// IGST tax info
				if (!empty($igst)) {
					for ($i = 0, $n = count($igst); $i < $n; $i++) {
						$igst_tax = $igst[$i];
						$igst_tax_id = $igst_id[$i];
						$product_id = $p_id[$i];
						$variant_id = $size[$i];
						$igst_summary = array(
							'quot_tax_col_de_id' => generator(15),
							'quotation_id' => $invoice_id,
							'amount' => $igst_tax,
							'product_id' => $product_id,
							'tax_id' => $igst_tax_id,
							'variant_id' => $variant_id,
							'date' => $this->input->post('invoice_date', TRUE),
						);
						if (!empty($igst[$i])) {
							$result = $this->db->select('*')
								->from('quotation_tax_col_details')
								->where('quotation_id', $invoice_id)
								->where('tax_id', $igst_tax_id)
								->where('product_id', $product_id)
								->where('variant_id', $variant_id)
								->get()
								->num_rows();
							if ($result > 0) {
								$this->db->set('amount', 'amount+' . $igst_tax, FALSE);
								$this->db->where('quotation_id', $invoice_id);
								$this->db->where('tax_id', $igst_tax_id);
								$this->db->where('variant_id', $variant_id);
								$this->db->update('quotation_tax_col_details');
							} else {
								$this->db->insert('quotation_tax_col_details', $igst_summary);
							}
						}
					}
				}
				//Tax collection details for three end

				return $invoice_id;
			} else {
				$this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
				redirect(base_url('Admin_dashboard'));
			}
		// } 
		// else {
		// 	//Invoice entry info
		// 	$invoice_id = $quotation_id ? $quotation_id : generator(15);
		// 	$quotationNo = $quotationNo ? $quotationNo : 'Quot-' . $this->number_generator();
		// 	$quantity = $this->input->post('product_quantity', TRUE);
		// 	$available_quantity = $this->input->post('available_quantity', TRUE);
		// 	$product_id = $this->input->post('product_id', TRUE);
		// 	$pricing_type = $this->input->post('pri_type', TRUE);

		// 	//Stock availability check
		// 	$result = array();
		// 	foreach ($available_quantity as $k => $v) {
		// 		if ($v < $quantity[$k]) {
		// 			$this->session->set_userdata(array('error_message' => display('you_can_not_buy_greater_than_available_cartoon')));
		// 			redirect('dashboard/Cquotation');
		// 		}
		// 	}

		// 	//Product existing check
		// 	if ($product_id == null) {
		// 		$this->session->set_userdata(array('error_message' => display('please_select_product')));
		// 		redirect('dashboard/Cquotation');
		// 	}

		// 	//Customer existing check
		// 	if (($this->input->post('customer_name_others', TRUE) == null) && ($this->input->post('customer_id', TRUE) == null)) {
		// 		$this->session->set_userdata(array('error_message' => display('please_select_customer')));
		// 		redirect(base_url() . 'dashboard/Cquotation');
		// 	}

		// 	//Customer data Existence Check.
		// 	if ($this->input->post('customer_id', TRUE)) {
		// 		$customer_id = $this->input->post('customer_id', TRUE);
		// 	}

		// 	//Data inserting into invoice table
		// 	(($this->input->post('total_cgst', true) && $this->input->post('is_quotation', true) == 0) ? $total_cgsti = $this->input->post('total_cgst', true) : $total_cgsti = 0);
		// 	(($this->input->post('total_sgst', true)) ? $total_sgsti = $this->input->post('total_sgst', true) : $total_sgsti = 0);
		// 	(($this->input->post('total_igst', true)) ? $total_igsti = $this->input->post('total_igst', true) : $total_igsti = 0);
		// 	$tota_vati = $total_cgsti + $total_sgsti + $total_igsti;
		// 	$installment_month_no = $this->input->post('month_no', true);
		// 	$data = array(
		// 		'quotation_id' => $invoice_id,
		// 		'customer_id' => $customer_id,
		// 		'date' => $this->input->post('invoice_date', TRUE),
		// 		'total_amount' => $this->input->post('grand_total_price', TRUE),
		// 		'quotation' => $quotationNo,
		// 		'total_discount' => $this->input->post('total_discount', TRUE),
		// 		'total_vat' => $tota_vati,
		// 		'is_quotation' => ($this->input->post('is_quotation', True)) ? $this->input->post('is_quotation', True) : 0,
		// 		'employee_id' => $this->input->post('employee_id', true),
		// 		'is_installment' => $this->input->post('is_installment', true),
		// 		'month_no' => $installment_month_no,
		// 		'due_day' => $this->input->post('due_day', true),
		// 		'quotation_discount' => $this->input->post('invoice_discount', TRUE),
		// 		'percentage_discount' => $this->input->post('percentage_discount', TRUE),
		// 		'user_id' => $this->session->userdata('user_id'),
		// 		'store_id' => $this->input->post('store_id', TRUE),
		// 		'paid_amount' => $this->input->post('paid_amount', TRUE),
		// 		'due_amount' => $this->input->post('due_amount', TRUE),
		// 		'service_charge' => $this->input->post('service_charge', TRUE),
		// 		'shipping_charge' => $this->input->post('shipping_charge', TRUE) ? $this->input->post('shipping_charge', TRUE) : 0,
		// 		'shipping_method' => $this->input->post('shipping_method', TRUE),
		// 		'details' => $this->input->post('details', TRUE),
		// 		'status' => 1,
		// 		'created_at' => date("Y-m-d H:i:s"),
		// 		'pricing_type' => $pricing_type
		// 	);
		// 	$this->db->insert('quotation', $data);

		// 	// insert installment
		// 	if ($this->input->post('is_installment', true) == 1) {
		// 		$installment_amount = $this->input->post('amount', TRUE);
		// 		$installment_due_date = $this->input->post('due_date', TRUE);
		// 		for ($i = 0; $i < $installment_month_no; $i++) {
		// 			$installment_data = array(
		// 				'quotation_id' => $invoice_id,
		// 				'amount' => $installment_amount[$i],
		// 				'due_date' => $installment_due_date[$i],
		// 			);
		// 			$this->db->insert('quotation_installment', $installment_data);
		// 		}
		// 	}


		// 	//Insert payment method
		// 	$terminal = $this->input->post('terminal', TRUE);
		// 	$bank_id = $this->input->post('bank_id', TRUE);
		// 	$account_no = $this->input->post('account_no', TRUE);
		// 	$payment_amount = $this->input->post('grand_total_price', TRUE);

		// 	//Invoice details info
		// 	$rate = $this->input->post('product_rate', TRUE);
		// 	$p_id = $this->input->post('product_id', TRUE);
		// 	$total_amount = $this->input->post('total_price', TRUE);
		// 	$discount = $this->input->post('discount', TRUE);
		// 	$variants = $this->input->post('variant_id', TRUE);
		// 	// $pricing = $this->input->post('pricing', TRUE);
		// 	$color_variants = $this->input->post('color_variant', TRUE);
		// 	$batch_no = $this->input->post('batch_no', TRUE);
		// 	$cogs_price = 0;

		// 	//Invoice details for invoice
		// 	for ($i = 0, $n = count($quantity); $i < $n; $i++) {
		// 		$product_quantity = $quantity[$i];
		// 		$product_rate = $rate[$i];
		// 		$product_id = $p_id[$i];
		// 		$discount_rate = $discount[$i];
		// 		$total_price = $total_amount[$i];
		// 		//  $pricing_id = $pricing[$i];
		// 		$variant_id = $variants[$i];
		// 		$variant_color = $color_variants[$i];
		// 		$batch = $batch_no[$i];
		// 		$supplier_rate = $this->supplier_rate($product_id);
		// 		$cogs_price += ($supplier_rate[0]['supplier_price'] * $product_quantity);

		// 		$invoice_details = array(
		// 			'quotation_details_id' => generator(15),
		// 			'quotation_id' => $invoice_id,
		// 			'product_id' => $product_id,
		// 			//  'pricing_id' => $pricing_id,
		// 			'variant_id' => $variant_id,
		// 			'variant_color' => $variant_color,
		// 			'batch_no' => $batch,
		// 			'store_id' => $this->input->post('store_id', TRUE),
		// 			'quantity' => $product_quantity,
		// 			'rate' => $product_rate,
		// 			'supplier_rate' => $supplier_rate[0]['supplier_price'],
		// 			'total_price' => $total_price,
		// 			'discount' => $discount_rate,
		// 			'status' => 1
		// 		);

		// 		if (!empty($quantity)) {
		// 			$this->db->select('*');
		// 			$this->db->from('quotation_details');
		// 			$this->db->where('quotation_id', $invoice_id);
		// 			$this->db->where('product_id', $product_id);
		// 			$this->db->where('variant_id', $variant_id);
		// 			if (!empty($variant_color)) {
		// 				$this->db->where('variant_color', $variant_color);
		// 			}
		// 			$query = $this->db->get();
		// 			$result = $query->num_rows();

		// 			if ($result > 0) {
		// 				$this->db->set('quantity', 'quantity+' . $product_quantity, FALSE);
		// 				$this->db->set('total_price', 'total_price+' . $total_price, FALSE);
		// 				$this->db->where('quotation_id', $invoice_id);
		// 				$this->db->where('product_id', $product_id);
		// 				$this->db->where('variant_id', $variant_id);
		// 				if (!empty($variant_color)) {
		// 					$this->db->where('variant_color', $variant_color);
		// 				}
		// 				$this->db->update('quotation_details');
		// 			} else {
		// 				$this->db->insert('quotation_details', $invoice_details);
		// 			}

		// 			// stock 
		// 			$store_id = $this->input->post('store_id', TRUE);
		// 			$check_stock = $this->check_stock($store_id, $product_id, $variant_id, $variant_color);
		// 			if (empty($check_stock)) {
		// 				// insert
		// 				$stock = array(
		// 					'store_id' => $store_id,
		// 					'product_id' => $product_id,
		// 					'variant_id' => $variant_id,
		// 					'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
		// 					'quantity' => $product_quantity,
		// 					'warehouse_id' => '',
		// 				);
		// 				$this->db->insert('quotation_stock_tbl', $stock);
		// 				// insert
		// 			} else {
		// 				//update
		// 				$stock = array(
		// 					'quantity' => $check_stock->quantity + $product_quantity
		// 				);
		// 				if (!empty($store_id)) {
		// 					$this->db->where('store_id', $store_id);
		// 				}
		// 				if (!empty($product_id)) {
		// 					$this->db->where('product_id', $product_id);
		// 				}
		// 				if (!empty($variant_id)) {
		// 					$this->db->where('variant_id', $variant_id);
		// 				}
		// 				if (!empty($variant_color)) {
		// 					$this->db->where('variant_color', $variant_color);
		// 				}
		// 				$this->db->update('quotation_stock_tbl', $stock);
		// 				//update
		// 			}
		// 			// stock
		// 		}
		// 	}

		// 	//Tax information
		// 	$cgst = $this->input->post('cgst', TRUE);
		// 	$sgst = $this->input->post('sgst', TRUE);
		// 	$igst = $this->input->post('igst', TRUE);
		// 	$cgst_id = $this->input->post('cgst_id', TRUE);
		// 	$sgst_id = $this->input->post('sgst_id', TRUE);
		// 	$igst_id = $this->input->post('igst_id', TRUE);

		// 	//Tax collection summary for three start
		// 	//CGST tax info
		// 	if (!empty($cgst)) {
		// 		for ($i = 0, $n = count(@$cgst); $i < $n; $i++) {
		// 			$cgst_tax = $cgst[$i];
		// 			$cgst_tax_id = $cgst_id[$i];
		// 			$cgst_summary = array(
		// 				'quot_tax_col_id' => $this->auth->generator(15),
		// 				'quotation_id' => $invoice_id,
		// 				'tax_amount' => $cgst_tax,
		// 				'tax_id' => $cgst_tax_id,
		// 				'date' => $this->input->post('invoice_date', TRUE),
		// 			);
		// 			if (!empty($cgst[$i])) {
		// 				$result = $this->db->select('*')
		// 					->from('quotation_tax_col_summary')
		// 					->where('quotation_id', $invoice_id)
		// 					->where('tax_id', $cgst_tax_id)
		// 					->get()
		// 					->num_rows();
		// 				if ($result > 0) {
		// 					$this->db->set('tax_amount', 'tax_amount+' . $cgst_tax, FALSE);
		// 					$this->db->where('quotation_id', $invoice_id);
		// 					$this->db->where('tax_id', $cgst_tax_id);
		// 					$this->db->update('quotation_tax_col_summary');
		// 				} else {
		// 					$this->db->insert('quotation_tax_col_summary', $cgst_summary);
		// 				}
		// 			}
		// 		}
		// 	}
		// 	//SGST tax info
		// 	if (!empty($sgst)) {
		// 		for ($i = 0, $n = count($sgst); $i < $n; $i++) {
		// 			$sgst_tax = $sgst[$i];
		// 			$sgst_tax_id = $sgst_id[$i];

		// 			$sgst_summary = array(
		// 				'quot_tax_col_id' => $this->auth->generator(15),
		// 				'quotation_id' => $invoice_id,
		// 				'tax_amount' => $sgst_tax,
		// 				'tax_id' => $sgst_tax_id,
		// 				'date' => $this->input->post('invoice_date', TRUE),
		// 			);
		// 			if (!empty($sgst[$i])) {
		// 				$result = $this->db->select('*')
		// 					->from('quotation_tax_col_summary')
		// 					->where('quotation_id', $invoice_id)
		// 					->where('tax_id', $sgst_tax_id)
		// 					->get()
		// 					->num_rows();
		// 				if ($result > 0) {
		// 					$this->db->set('tax_amount', 'tax_amount+' . $sgst_tax, FALSE);
		// 					$this->db->where('quotation_id', $invoice_id);
		// 					$this->db->where('tax_id', $sgst_tax_id);
		// 					$this->db->update('quotation_tax_col_summary');
		// 				} else {
		// 					$this->db->insert('quotation_tax_col_summary', $sgst_summary);
		// 				}
		// 			}
		// 		}
		// 	}
		// 	if (!empty($igst)) {
		// 		//IGST tax info
		// 		for ($i = 0, $n = count($igst); $i < $n; $i++) {
		// 			$igst_tax = $igst[$i];
		// 			$igst_tax_id = $igst_id[$i];

		// 			$igst_summary = array(
		// 				'quot_tax_col_id' => generator(15),
		// 				'quotation_id' => $invoice_id,
		// 				'tax_amount' => $igst_tax,
		// 				'tax_id' => $igst_tax_id,
		// 				'date' => $this->input->post('invoice_date', TRUE),
		// 			);
		// 			if (!empty($igst[$i])) {
		// 				$result = $this->db->select('*')
		// 					->from('quotation_tax_col_summary')
		// 					->where('quotation_id', $invoice_id)
		// 					->where('tax_id', $igst_tax_id)
		// 					->get()
		// 					->num_rows();

		// 				if ($result > 0) {
		// 					$this->db->set('tax_amount', 'tax_amount+' . $igst_tax, FALSE);
		// 					$this->db->where('quotation_id', $invoice_id);
		// 					$this->db->where('tax_id', $igst_tax_id);
		// 					$this->db->update('quotation_tax_col_summary');
		// 				} else {
		// 					$this->db->insert('quotation_tax_col_summary', $igst_summary);
		// 				}
		// 			}
		// 		}
		// 	}
		// 	//Tax collection summary for three end
		// 	//Tax collection details for three start
		// 	//CGST tax info
		// 	if (!empty($cgst)) {
		// 		for ($i = 0, $n = count($cgst); $i < $n; $i++) {
		// 			$cgst_tax = $cgst[$i];
		// 			$cgst_tax_id = $cgst_id[$i];
		// 			$product_id = $p_id[$i];
		// 			$variant_id = $variants[$i];
		// 			$cgst_details = array(
		// 				'quot_tax_col_de_id' => generator(15),
		// 				'quotation_id' => $invoice_id,
		// 				'amount' => $cgst_tax,
		// 				'product_id' => $product_id,
		// 				'tax_id' => $cgst_tax_id,
		// 				'variant_id' => $variant_id,
		// 				'date' => $this->input->post('invoice_date', TRUE),
		// 			);
		// 			if (!empty($cgst[$i])) {

		// 				$result = $this->db->select('*')
		// 					->from('quotation_tax_col_details')
		// 					->where('quotation_id', $invoice_id)
		// 					->where('tax_id', $cgst_tax_id)
		// 					->where('product_id', $product_id)
		// 					->where('variant_id', $variant_id)
		// 					->get()
		// 					->num_rows();
		// 				if ($result > 0) {
		// 					$this->db->set('amount', 'amount+' . $cgst_tax, FALSE);
		// 					$this->db->where('quotation_id', $invoice_id);
		// 					$this->db->where('tax_id', $cgst_tax_id);
		// 					$this->db->where('variant_id', $variant_id);
		// 					$this->db->update('quotation_tax_col_details');
		// 				} else {
		// 					$this->db->insert('quotation_tax_col_details', $cgst_details);
		// 				}
		// 			}
		// 		}
		// 	}

		// 	//SGST tax info
		// 	if (!empty($sgst)) {
		// 		for ($i = 0, $n = count($sgst); $i < $n; $i++) {
		// 			$sgst_tax = $sgst[$i];
		// 			$sgst_tax_id = $sgst_id[$i];
		// 			$product_id = $p_id[$i];
		// 			$variant_id = $variants[$i];
		// 			$sgst_summary = array(
		// 				'quot_tax_col_de_id' => generator(15),
		// 				'quotation_id' => $invoice_id,
		// 				'amount' => $sgst_tax,
		// 				'product_id' => $product_id,
		// 				'tax_id' => $sgst_tax_id,
		// 				'variant_id' => $variant_id,
		// 				'date' => $this->input->post('invoice_date', TRUE),
		// 			);
		// 			if (!empty($sgst[$i])) {
		// 				$result = $this->db->select('*')
		// 					->from('quotation_tax_col_details')
		// 					->where('quotation_id', $invoice_id)
		// 					->where('tax_id', $sgst_tax_id)
		// 					->where('product_id', $product_id)
		// 					->where('variant_id', $variant_id)
		// 					->get()
		// 					->num_rows();
		// 				if ($result > 0) {
		// 					$this->db->set('amount', 'amount+' . $sgst_tax, FALSE);
		// 					$this->db->where('quotation_id', $invoice_id);
		// 					$this->db->where('tax_id', $sgst_tax_id);
		// 					$this->db->where('variant_id', $variant_id);
		// 					$this->db->update('quotation_tax_col_details');
		// 				} else {
		// 					$this->db->insert('quotation_tax_col_details', $sgst_summary);
		// 				}
		// 			}
		// 		}
		// 	}
		// 	// IGST tax info
		// 	if (!empty($igst)) {
		// 		for ($i = 0, $n = count($igst); $i < $n; $i++) {
		// 			$igst_tax = $igst[$i];
		// 			$igst_tax_id = $igst_id[$i];
		// 			$product_id = $p_id[$i];
		// 			$variant_id = $variants[$i];
		// 			$igst_summary = array(
		// 				'quot_tax_col_de_id' => generator(15),
		// 				'quotation_id' => $invoice_id,
		// 				'amount' => $igst_tax,
		// 				'product_id' => $product_id,
		// 				'tax_id' => $igst_tax_id,
		// 				'variant_id' => $variant_id,
		// 				'date' => $this->input->post('invoice_date', TRUE),
		// 			);
		// 			if (!empty($igst[$i])) {
		// 				$result = $this->db->select('*')
		// 					->from('quotation_tax_col_details')
		// 					->where('quotation_id', $invoice_id)
		// 					->where('tax_id', $igst_tax_id)
		// 					->where('product_id', $product_id)
		// 					->where('variant_id', $variant_id)
		// 					->get()
		// 					->num_rows();
		// 				if ($result > 0) {
		// 					$this->db->set('amount', 'amount+' . $igst_tax, FALSE);
		// 					$this->db->where('quotation_id', $invoice_id);
		// 					$this->db->where('tax_id', $igst_tax_id);
		// 					$this->db->where('variant_id', $variant_id);
		// 					$this->db->update('quotation_tax_col_details');
		// 				} else {
		// 					$this->db->insert('quotation_tax_col_details', $igst_summary);
		// 				}
		// 			}
		// 		}
		// 	}
		// 	//Tax collection details for three end

		// 	return $invoice_id;
		// }
	}

	//update_quotation
	public function update_quotation_old()
	{

		//Quotation and customer info
		$quotation_id  = $this->input->post('quotation_id', TRUE);
		$customer_id   = $this->input->post('customer_id', TRUE);
		$invoice_discount  = $this->input->post('invoice_discount', TRUE);
		$total_discount   = $this->input->post('total_discount', TRUE);

		$quotation_discount = $invoice_discount + $total_discount;

		if (!empty($quotation_id)) {
			//Data update into quotation table
			$data = array(
				'customer_id'		=>	$customer_id,
				'date'				=>	$this->input->post('invoice_date', TRUE),
				'expire_date'		=>	$this->input->post('expire_date', TRUE),
				'total_amount'		=>	$this->input->post('grand_total_price', TRUE),
				'quotation'			=>	$this->input->post('quotation', TRUE),
				'total_discount' 	=> 	$this->input->post('total_discount', TRUE),
				'details' 			=> 	$this->input->post('details', TRUE),
				'quotation_discount' => (!empty($quotation_discount) ? $quotation_discount : 0),
				'service_charge'	=> 	$this->input->post('service_charge', TRUE),
				'user_id'			=>	$this->session->userdata('user_id'),
				'store_id'			=>	$this->input->post('store_id', TRUE),
				'paid_amount'		=>	$this->input->post('paid_amount', TRUE),
				'due_amount'		=>	$this->input->post('due_amount', TRUE),
				'status'			=>	$this->input->post('status', TRUE),
				'is_quotation'		=> ($this->input->post('is_quotation', True)) ? $this->input->post('is_quotation', True) : 0,
				'employee_id' => $this->input->post('employee_id', true),
			);

			$this->db->update('quotation', $data, array('quotation_id' => $quotation_id));
		}



		//Quotation details info
		$rate 			= $this->input->post('product_rate', TRUE);
		$p_id 			= $this->input->post('product_id', TRUE);
		$total_amount	= $this->input->post('total_price', TRUE);
		$discount 		= $this->input->post('discount', TRUE);
		$variants 		= $this->input->post('variant_id', TRUE);
		$color_variants = $this->input->post('color_variant', TRUE);
		$color = $this->input->post('colorv', TRUE);
		$size = $this->input->post('sizev', TRUE);
		$quotation_d_id = $this->input->post('quotation_details_id', TRUE);
		$quantity 		= $this->input->post('product_quantity', TRUE);

		//invoice details for invoice
		if (!empty($p_id)) {

			//Delete old quotation details info
			if (!empty($quotation_id)) {
				$this->db->where('quotation_id', $quotation_id);
				$this->db->delete('quotation_details');
			}

			for ($i = 0, $n = count($p_id); $i < $n; $i++) {
				$product_quantity = $quantity[$i];
				$product_rate 	  = $rate[$i];
				$product_id 	  = $p_id[$i];
				$discount_rate 	  = $discount[$i];
				$total_price 	  = $total_amount[$i];
				//$variant_id		  = $variants[$i];
				//$variant_color	  = (!empty($color_variants) ? @$color_variants[$i] : null);
				$variant_id = $size[$i];
				$variant_color = $color[$i];
				$supplier_rate    = $this->supplier_rate($product_id);

				$quotation_details = array(
					'quotation_details_id'	=>	$this->auth->generator(15),
					'quotation_id'			=>	$quotation_id,
					'product_id'			=>	$product_id,
					'variant_id'			=>	$variant_id,
					'variant_color'			=>	$variant_color,
					'quantity'				=>	$product_quantity,
					'rate'					=>	$product_rate,
					'store_id'				=>	$this->input->post('store_id', TRUE),
					'supplier_rate'         =>	$supplier_rate[0]['supplier_price'],
					'total_price'           =>	$total_price,
					'discount'           	=>	$discount_rate,
					'status'				=>	1
				);

				if (!empty($p_id)) {
					$this->db->select('*');
					$this->db->from('quotation_details');
					$this->db->where('quotation_id', $quotation_id);
					$this->db->where('product_id', $product_id);
					$this->db->where('variant_id', $variant_id);
					if (!empty($variant_color)) {
						$this->db->where('variant_color', $variant_color);
					}
					$result = $this->db->get()->num_rows();

					if ($result > 0) {
						$this->db->set('quantity', 'quantity+' . $product_quantity, FALSE);
						$this->db->set('total_price', 'total_price+' . $total_price, FALSE);
						$this->db->where('quotation_id', $quotation_id);
						$this->db->where('product_id', $product_id);
						$this->db->where('variant_id', $variant_id);
						if (!empty($variant_color)) {
							$this->db->where('variant_color', $variant_color);
						}
						$this->db->update('quotation_details');
					} else {
						$this->db->insert('quotation_details', $quotation_details);
					}
				}
			}
		}


		//Quotation tax collection summary
		$cgst = $this->input->post('cgst', TRUE);
		$sgst = $this->input->post('sgst', TRUE);
		$igst = $this->input->post('igst', TRUE);
		$cgst_id = $this->input->post('cgst_id', TRUE);
		$sgst_id = $this->input->post('sgst_id', TRUE);
		$igst_id = $this->input->post('igst_id', TRUE);
		//Tax collection summary for three

		//Delete all tax  from summary
		$this->db->where('quotation_id', $quotation_id);
		$this->db->delete('quotation_tax_col_summary');

		//CGST Tax Summary
		if (!empty($cgst)) {
			for ($i = 0, $n = count($cgst); $i < $n; $i++) {
				$cgst_tax = $cgst[$i];
				$cgst_tax_id = $cgst_id[$i];
				$cgst_summary = array(
					'quot_tax_col_id'	=>	$this->auth->generator(15),
					'quotation_id'		=>	$quotation_id,
					'tax_amount' 		=> 	$cgst_tax,
					'tax_id' 			=> 	$cgst_tax_id,
					'date'				=>	$this->input->post('invoice_date', TRUE),
				);
				if (!empty($cgst[$i])) {
					$result = $this->db->select('*')
						->from('quotation_tax_col_summary')
						->where('quotation_id', $quotation_id)
						->where('tax_id', $cgst_tax_id)
						->get()
						->num_rows();
					if ($result > 0) {
						$this->db->set('tax_amount', 'tax_amount+' . $cgst_tax, FALSE);
						$this->db->where('quotation_id', $quotation_id);
						$this->db->where('tax_id', $cgst_tax_id);
						$this->db->update('quotation_tax_col_summary');
					} else {
						$this->db->insert('quotation_tax_col_summary', $cgst_summary);
					}
				}
			}
		}

		//SGST Tax Summary
		if (!empty($sgst)) {
			for ($i = 0, $n = count($sgst); $i < $n; $i++) {
				$sgst_tax 	 = $sgst[$i];
				$sgst_tax_id = $sgst_id[$i];

				$sgst_summary = array(
					'quot_tax_col_id'	=>	$this->auth->generator(15),
					'quotation_id'		=>	$quotation_id,
					'tax_amount' 		=> 	$sgst_tax,
					'tax_id' 			=> 	$sgst_tax_id,
					'date'				=>	$this->input->post('invoice_date', TRUE),
				);
				if (!empty($sgst[$i])) {
					$result = $this->db->select('*')
						->from('quotation_tax_col_summary')
						->where('quotation_id', $quotation_id)
						->where('tax_id', $sgst_tax_id)
						->get()
						->num_rows();
					if ($result > 0) {
						$this->db->set('tax_amount', 'tax_amount+' . $sgst_tax, FALSE);
						$this->db->where('quotation_id', $quotation_id);
						$this->db->where('tax_id', $sgst_tax_id);
						$this->db->update('quotation_tax_col_summary');
					} else {
						$this->db->insert('quotation_tax_col_summary', $sgst_summary);
					}
				}
			}
		}

		//IGST Tax Summary
		if (!empty($igst)) {
			for ($i = 0, $n = count($igst); $i < $n; $i++) {
				$igst_tax = $igst[$i];
				$igst_tax_id = $igst_id[$i];

				$igst_summary = array(
					'quot_tax_col_id'	=>	$this->auth->generator(15),
					'quotation_id'		=>	$quotation_id,
					'tax_amount' 		=> 	$igst_tax,
					'tax_id' 			=> 	$igst_tax_id,
					'date'				=>	$this->input->post('invoice_date', TRUE),
				);
				if (!empty($igst[$i])) {
					$result = $this->db->select('*')
						->from('quotation_tax_col_summary')
						->where('quotation_id', $quotation_id)
						->where('tax_id', $igst_tax_id)
						->get()
						->num_rows();

					if ($result > 0) {
						$this->db->set('tax_amount', 'tax_amount+' . $igst_tax, FALSE);
						$this->db->where('quotation_id', $quotation_id);
						$this->db->where('tax_id', $igst_tax_id);
						$this->db->update('quotation_tax_col_summary');
					} else {
						$this->db->insert('quotation_tax_col_summary', $igst_summary);
					}
				}
			}
		}
		//Tax collection summary for three

		//Delete all tax  from summary
		$this->db->where('quotation_id', $quotation_id);
		$this->db->delete('quotation_tax_col_details');

		//Tax collection details for three
		//CGST Tax Details
		if (!empty($cgst)) {
			for ($i = 0, $n = count($cgst); $i < $n; $i++) {
				$cgst_tax 	 = $cgst[$i];
				$cgst_tax_id = $cgst_id[$i];
				$product_id  = $p_id[$i];
				$variant_id  = $variants[$i];
				$cgst_details = array(
					'quot_tax_col_de_id'	=>	$this->auth->generator(15),
					'quotation_id'		=>	$quotation_id,
					'amount' 			=> 	$cgst_tax,
					'product_id' 		=> 	$product_id,
					'tax_id' 			=> 	$cgst_tax_id,
					'variant_id' 		=> 	$variant_id,
					'date'				=>	$this->input->post('invoice_date', TRUE),
				);
				if (!empty($cgst[$i])) {
					$result = $this->db->select('*')
						->from('quotation_tax_col_details')
						->where('quotation_id', $quotation_id)
						->where('tax_id', $cgst_tax_id)
						->where('product_id', $product_id)
						->where('variant_id', $variant_id)
						->get()
						->num_rows();
					if ($result > 0) {
						$this->db->set('amount', 'amount+' . $cgst_tax, FALSE);
						$this->db->where('quotation_id', $quotation_id);
						$this->db->where('tax_id', $cgst_tax_id);
						$this->db->where('variant_id', $variant_id);
						$this->db->update('quotation_tax_col_details');
					} else {
						$this->db->insert('quotation_tax_col_details', $cgst_details);
					}
				}
			}
		}

		//SGST Tax Details
		if (!empty($sgst)) {
			for ($i = 0, $n = count($sgst); $i < $n; $i++) {
				$sgst_tax 	 = $sgst[$i];
				$sgst_tax_id = $sgst_id[$i];
				$product_id  = $p_id[$i];
				$variant_id  = $variants[$i];
				$sgst_summary = array(
					'quot_tax_col_de_id'	=>	$this->auth->generator(15),
					'quotation_id'		=>	$quotation_id,
					'amount' 			=> 	$sgst_tax,
					'product_id' 		=> 	$product_id,
					'tax_id' 			=> 	$sgst_tax_id,
					'variant_id' 		=> 	$variant_id,
					'date'				=>	$this->input->post('invoice_date', TRUE),
				);
				if (!empty($sgst[$i])) {
					$result = $this->db->select('*')
						->from('quotation_tax_col_details')
						->where('quotation_id', $quotation_id)
						->where('tax_id', $sgst_tax_id)
						->where('product_id', $product_id)
						->where('variant_id', $variant_id)
						->get()
						->num_rows();
					if ($result > 0) {
						$this->db->set('amount', 'amount+' . $sgst_tax, FALSE);
						$this->db->where('quotation_id', $quotation_id);
						$this->db->where('tax_id', $sgst_tax_id);
						$this->db->where('variant_id', $variant_id);
						$this->db->update('quotation_tax_col_details');
					} else {
						$this->db->insert('quotation_tax_col_details', $sgst_summary);
					}
				}
			}
		}

		//IGST Tax Details
		if (!empty($igst)) {
			for ($i = 0, $n = count($igst); $i < $n; $i++) {
				$igst_tax = $igst[$i];
				$igst_tax_id = $igst_id[$i];
				$product_id = $p_id[$i];

				if (!empty($igst[$i])) {
					$this->db->set('amount', $igst_tax, FALSE);
					$this->db->where('product_id', $product_id);
					$this->db->where('tax_id', $igst_tax_id);
					$this->db->update('quotation_tax_col_details');
				}
			}
		}

		if (!empty($igst)) {
			for ($i = 0, $n = count($igst); $i < $n; $i++) {
				$igst_tax 	 = $igst[$i];
				$igst_tax_id = $igst_id[$i];
				$product_id  = $p_id[$i];
				$variant_id  = $variants[$i];
				$igst_summary = array(
					'quot_tax_col_de_id'	=>	$this->auth->generator(15),
					'quotation_id'		=>	$quotation_id,
					'amount' 			=> 	$igst_tax,
					'product_id' 		=> 	$product_id,
					'tax_id' 			=> 	$igst_tax_id,
					'variant_id' 		=> 	$variant_id,
					'date'				=>	$this->input->post('invoice_date', TRUE),
				);
				if (!empty($igst[$i])) {
					$result = $this->db->select('*')
						->from('quotation_tax_col_details')
						->where('quotation_id', $quotation_id)
						->where('tax_id', $igst_tax_id)
						->where('product_id', $product_id)
						->where('variant_id', $variant_id)
						->get()
						->num_rows();
					if ($result > 0) {
						$this->db->set('amount', 'amount+' . $igst_tax, FALSE);
						$this->db->where('quotation_id', $quotation_id);
						$this->db->where('tax_id', $igst_tax_id);
						$this->db->where('variant_id', $variant_id);
						$this->db->update('quotation_tax_col_details');
					} else {
						$this->db->insert('quotation_tax_col_details', $igst_summary);
					}
				}
			}
		}
		//End tax details
		return $quotation_id;
	}

	public function update_quotation($quotation_id)
    {
		//Invoice entry info
        $quantity = $this->input->post('product_quantity', TRUE);
        $available_quantity = $this->input->post('available_quantity', TRUE);
        $product_id = $this->input->post('product_id', TRUE);
        $payment_id = $this->input->post('payment_id', TRUE);

        //Stock availability check
        foreach ($available_quantity as $k => $v) {
            if ($v < $quantity[$k]) {
                $this->session->set_userdata(array('error_message' => display('you_can_not_buy_greater_than_available_cartoon')));
                redirect('dashboard/Cquotation/quotation_update_form/' . $quotation_id);
            }
        }

        //Product existing check
        if ($product_id == null) {
            $this->session->set_userdata(array('error_message' => display('please_select_product')));
            redirect('dashboard/Cquotation/quotation_update_form/' . $quotation_id);
        }

        //payment account existing check
        if ((float)$this->input->post('paid_amount', TRUE) > 0 && $payment_id == null) {
            $this->session->set_userdata(array('error_message' => display('please_select_payment')));
            redirect('dashboard/Cquotation/quotation_update_form/' . $quotation_id);
        }

        //Customer existing check
        if (($this->input->post('customer_name_others', TRUE) == null) && ($this->input->post('customer_id', TRUE) == null)) {
            $this->session->set_userdata(array('error_message' => display('please_select_customer')));
            redirect('dashboard/Cquotation/quotation_update_form/' . $quotation_id);
        }

        // delete then insert new ==> update
        $this->delete_quotation($quotation_id);
        // insert as new
        $quotation_id = $this->quotation_entry($quotation_id);

        // turn to paid

        // turn into invoice
        // insert invoice from this input data
        $this->load->model('dashboard/Invoices');
        $invoice_id = $this->Invoices->invoice_entry(null, $quotation_id);

        // get invoice no
        $invoiceNo = $this->db->select('invoice')->from('invoice')->where('invoice_id', $invoice_id)->where('quotation_id', $quotation_id)->get()->row();
        // update quotation status
        $this->db->set('invoice_no', $invoiceNo->invoice)->set('status', 2)->where('quotation_id', $quotation_id)->update('quotation');

        return $quotation_id;
    }

	//Quotation paid to invoice
	public function quot_paid_data($quotation_id)
	{
		if (check_module_status('accounting') == 1) {
			$find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
			if (!empty($find_active_fiscal_year)) {
				//Invoice id
				$invoice_id = $this->auth->generator(15);
				$result = $this->db->select('*')
					->from('quotation')
					->where('quotation_id', $quotation_id)
					->get()
					->row();
				if ($result) {
					$data = array(
						'invoice_id' 	  => $invoice_id,
						'quotation_id' 	  => $result->quotation_id,
						'customer_id'     => $result->customer_id,
						'store_id' 		  => $result->store_id,
						'user_id' 		  => $result->user_id,
						'date' 			  => $result->date,
						'total_amount' 	  => $result->total_amount,
						'invoice'         => 'QInv-' . $this->invoice_number_generator(),
						'invoice_details' => $result->details,
						'total_discount'  => $result->total_discount,
						'service_charge'  => $result->service_charge,
						'invoice_discount' => $result->quotation_discount,
						'paid_amount' 	  => $result->paid_amount,
						'due_amount' 	  => $result->due_amount,
						'status' 		  => $result->status,
						'is_quotation' 		  => $result->is_quotation,
					);
					//Insert quotation data
					$quotation = $this->db->insert('invoice', $data);


					//Update to customer ledger Table 
					$data2 = array(
						'transaction_id' => $this->auth->generator(15),
						'customer_id'	=> $result->customer_id,
						'invoice_no'	=> $invoice_id,
						'quotation_no' 	=> $result->quotation_id,
						'date'			=> date('Y-m-d', strtotime($result->date)),
						'amount'		=> $result->total_amount,
						'status'		=> 1
					);
					$this->db->insert('customer_ledger', $data2);
				}

				if ($quotation) {
					//Quotation update
					$this->db->set('status', '2');
					$this->db->where('quotation_id', $quotation_id);
					$quotation = $this->db->update('quotation');

					$quotation_details = $this->db->select('*')
						->from('quotation_details')
						->where('quotation_id', $quotation_id)
						->get()
						->result();

					//Quotation details
					$sub_total_price = 0;
					$cogs_price = 0;
					$total_rate = 0;
					$total_inv_discount = 0;
					if ($quotation_details) {
						foreach ($quotation_details as $details) {
							$sub_total_price   += $details->total_price;
							$total_rate        += $details->rate * $details->quantity;
							$cogs_price        += $details->supplier_rate * $details->quantity;
							$total_inv_discount += $details->discount * $details->quantity;
							//Quotation details entry
							$data = array(
								'invoice_details_id' => $this->auth->generator(15),
								'invoice_id' 		=> $invoice_id,
								'product_id' 		=> $details->product_id,
								'variant_id'		=> $details->variant_id,
								'variant_color'		=> $details->variant_color,
								'batch_no'		    => $details->batch_no,
								'store_id'			=> $details->store_id,
								'quantity'			=> $details->quantity,
								'rate'				=> $details->rate,
								'supplier_rate'		=> $details->supplier_rate,
								'total_price'		=> $details->total_price,
								'discount'			=> $details->discount,
								'status'			=> $details->status,
							);
							$quotation_details = $this->db->insert('invoice_details', $data);
							// stock 
							$check_stock = $this->check_stock($details->store_id, $details->product_id, $details->variant_id, $details->variant_color);
							if (empty($check_stock)) {
								// insert
								$stock = array(
									'store_id'     => $details->store_id,
									'product_id'   => $details->product_id,
									'variant_id'   => $details->variant_id,
									'variant_color' => (!empty($details->variant_color) ? $details->variant_color : NULL),
									'quantity'     => $details->quantity,
									'warehouse_id' => '',
								);
								$this->db->insert('invoice_stock_tbl', $stock);
								// insert
							} else {
								//update
								$stock = array(
									'quantity' => ($check_stock->quantity + $details->quantity)
								);
								if (!empty($details->product_id)) {
									$this->db->where('store_id', $details->store_id);
								}
								if (!empty($details->product_id)) {
									$this->db->where('product_id', $details->product_id);
								}
								if (!empty($details->variant_id)) {
									$this->db->where('variant_id', $details->variant_id);
								}
								if (!empty($details->variant_color)) {
									$this->db->where('variant_color', $details->variant_color);
								}
								$this->db->update('invoice_stock_tbl', $stock);
								//update
							}
							// stock
						}
					}

					//Tax summary entry start
					$this->db->select('*');
					$this->db->from('quotation_tax_col_summary');
					$this->db->where('quotation_id', $quotation_id);
					$query = $this->db->get();
					$tax_summary = $query->result();

					if ($tax_summary) {
						foreach ($tax_summary as $summary) {
							$tax_col_summary = array(
								'tax_collection_id' => $summary->quot_tax_col_id,
								'invoice_id' 		=> $invoice_id,
								'tax_id' 			=> $summary->tax_id,
								'tax_amount' 		=> $summary->tax_amount,
								'date' 				=> $summary->date,
							);
							$this->db->insert('tax_collection_summary', $tax_col_summary);
						}
					}
					//Tax summary entry end

					// start quotation to invoice sales transection
					$store_id     = $result->store_id;
					$store_head   = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('store_id', $result->store_id)->get()->row();
					$customer_head    = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('customer_id', $result->customer_id)->get()->row();
					if (empty($customer_head)) {
						$this->load->model('accounting/account_model');
						$customer_name = $this->db->select('customer_id,customer_name')->from('customer_information')->where('customer_id', $result->customer_id)->get()->row();
						if ($customer_name) {
							$customer_data = $data = array(
								'customer_id'  => $customer_name->customer_id,
								'customer_name' => $customer_name->customer_name,
							);
							$this->account_model->insert_customer_head($customer_data);
						}
						$customer_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('customer_id', $result->customer_id)->get()->row();
					}
					$createdate   = date('Y-m-d H:i:s');
					$receive_by   = $this->session->userdata('user_id');
					$date         = date('Y-m-d');
					$get_tota_vat = $this->db->query("SELECT SUM(tax_amount) as total_vat FROM `tax_collection_summary` WHERE `invoice_id` = '" . $invoice_id . "'")->row();
					if (!empty($get_tota_vat->total_vat)) {
						$total_vat = $get_tota_vat->total_vat;
					} else {
						$total_vat = 0;
					}
					$total_with_vat = (($sub_total_price - $total_inv_discount) + $total_vat);
					$cogs_price    = $cogs_price;
					$total_discount = $total_inv_discount;
					$total_price_before_discount = $total_rate;
					//1st customer debit
					$customer_debit = array(
						'fy_id'     => $find_active_fiscal_year->id,
						'VNo'       => 'Inv-' . $invoice_id,
						'Vtype'     => 'Quotation sales',
						'VDate'     => $date,
						'COAID'     => $customer_head->HeadCode,
						'Narration' => 'Quotation sales "total with vat" debited by customer id: ' . $customer_head->HeadName . '(' . $result->customer_id . ')',
						'Debit'     => $total_with_vat,
						'Credit'    => 0,
						'IsPosted'  => 1,
						'CreateBy'  => $receive_by,
						'CreateDate' => $createdate,
						'store_id'  => $result->store_id,
						'IsAppove'  => 0
					);
					//2nd Allowed Discount Debit
					$allowed_discount_debit = array(
						'fy_id'     => $find_active_fiscal_year->id,
						'VNo'       => 'Inv-' . $invoice_id,
						'Vtype'     => 'Quotation sales',
						'VDate'     => $date,
						'COAID'     => 4114,
						'Narration' => 'Quotation sales "total discount" debited by customer id: ' . $customer_head->HeadName . '(' . $result->customer_id . ')',
						'Debit'     => $total_discount,
						'Credit'    => 0,
						'IsPosted'  => 1,
						'CreateBy'  => $receive_by,
						'CreateDate' => $createdate,
						'store_id'  => $result->store_id,
						'IsAppove'  => 0
					);
					//3rd Showroom Sales credit
					$showroom_sales_credit = array(
						'fy_id'     => $find_active_fiscal_year->id,
						'VNo'       => 'Inv-' . $invoice_id,
						'Vtype'     => 'Quotation sales',
						'VDate'     => $date,
						'COAID'     => 5111, // account payable game 11
						'Narration' => 'Quotation sales "total price before discount" credited by customer id: ' . $customer_head->HeadName . '(' . $result->customer_id . ')',
						'Debit'     => 0,
						'Credit'    => $total_price_before_discount,
						'IsPosted'  => 1,
						'CreateBy'  => $receive_by,
						'CreateDate' => $createdate,
						'store_id'  => $result->store_id,
						'IsAppove'  => 0
					);
					//4th VAT on Sales
					$vat_credit = array(
						'fy_id'     => $find_active_fiscal_year->id,
						'VNo'       => 'Inv-' . $invoice_id,
						'Vtype'     => 'Quotation sales',
						'VDate'     => $date,
						'COAID'     => 2114, // account payable game 11
						'Narration' => 'Quotation "total vat" credited by customer id: ' . $customer_head->HeadName . '(' . $result->customer_id . ')',
						'Debit'     => 0,
						'Credit'    => $total_vat,
						'IsPosted'  => 1,
						'CreateBy'  => $receive_by,
						'CreateDate' => $createdate,
						'store_id'  => $result->store_id,
						'IsAppove'  => 0
					);
					//5th cost of goods sold debit
					$cogs_debit = array(
						'fy_id'     => $find_active_fiscal_year->id,
						'VNo'       => 'Inv-' . $invoice_id,
						'Vtype'     => 'Quotation sales',
						'VDate'     => $date,
						'COAID'     => 4111,
						'Narration' => 'Quotation sales "COGS" debited by customer id: ' . $customer_head->HeadName . '(' . $result->customer_id . ')',
						'Debit'     => $cogs_price,
						'Credit'    => 0, //sales price asbe
						'IsPosted'  => 1,
						'CreateBy'  => $receive_by,
						'CreateDate' => $createdate,
						'store_id'  => $result->store_id,
						'IsAppove'  => 0
					);
					//6th cost of goods sold inventory Credit
					$inventory_credit = array(
						'fy_id'     => $find_active_fiscal_year->id,
						'VNo'       => 'Inv-' . $invoice_id,
						'Vtype'     => 'Quotation sales',
						'VDate'     => $date,
						'COAID'     => 1141,
						'Narration' => 'Quotation sales inventory "COGS" credited by customer id: ' . $customer_head->HeadName . '(' . $result->customer_id . ')',
						'Debit'     => 0,
						'Credit'    => $cogs_price, //supplier price asbe
						'IsPosted'  => 1,
						'CreateBy'  => $receive_by,
						'CreateDate' => $createdate,
						'store_id'  => $result->store_id,
						'IsAppove'  => 0
					);
					$this->db->insert('acc_transaction', $customer_debit);
					$this->db->insert('acc_transaction', $allowed_discount_debit);
					$this->db->insert('acc_transaction', $showroom_sales_credit);
					$this->db->insert('acc_transaction', $vat_credit);
					$this->db->insert('acc_transaction', $cogs_debit);
					$this->db->insert('acc_transaction', $inventory_credit);
					// end quotation to invoice sales transection

					//Tax details entry start
					$this->db->select('*');
					$this->db->from('quotation_tax_col_details');
					$this->db->where('quotation_id', $quotation_id);
					$query = $this->db->get();
					$tax_details = $query->result();

					if ($tax_details) {
						foreach ($tax_details as $details) {
							$tax_col_details = array(
								'tax_col_de_id' 	=> $details->quot_tax_col_de_id,
								'invoice_id' 		=> $invoice_id,
								'product_id' 		=> $details->product_id,
								'variant_id' 		=> $details->variant_id,
								'tax_id' 			=> $details->tax_id,
								'amount' 			=> $details->amount,
								'date' 				=> $details->date,
							);
							$this->db->insert('tax_collection_details', $tax_col_details);
						}
					}
					//Tax details entry end
				}
				return true;
			} else {
				$this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
				redirect(base_url('Admin_dashboard'));
			}
		} else {
			//Invoice id
			$invoice_id = $this->auth->generator(15);
			$result = $this->db->select('*')
				->from('quotation')
				->where('quotation_id', $quotation_id)
				->get()
				->row();

			if ($result) {
				$data = array(
					'invoice_id' 	=> $invoice_id,
					'quotation_id' 	=> $result->quotation_id,
					'store_id' 		=> $result->store_id,
					'customer_id' 	=> $result->customer_id,
					'user_id' 		=> $result->user_id,
					'date' 			=> $result->date,
					'total_amount' 	=> $result->total_amount,
					'invoice'       => 'Inv-' . $this->invoice_number_generator(),
					'invoice_details' => $result->details,
					'total_discount' => $result->total_discount,
					'service_charge' => $result->service_charge,
					'invoice_discount' => $result->quotation_discount,
					'paid_amount' 	=> $result->paid_amount,
					'due_amount' 	=> $result->due_amount,
					'status' 		=> $result->status,
				);
				//Insert quotation data
				$quotation = $this->db->insert('invoice', $data);

				//Update to customer ledger Table 
				$data2 = array(
					'transaction_id' => $this->auth->generator(15),
					'customer_id'	=> $result->customer_id,
					'invoice_no'	=> $invoice_id,
					'quotation_no' 	=> $result->quotation_id,
					'date'			=> date('Y-m-d', strtotime($result->date)),
					'amount'		=> $result->total_amount,
					'status'		=> 1
				);
				$this->db->insert('customer_ledger', $data2);
			}

			if ($quotation) {
				//Quotation update
				$this->db->set('status', '2');
				$this->db->where('quotation_id', $quotation_id);
				$quotation = $this->db->update('quotation');

				$quotation_details = $this->db->select('*')
					->from('quotation_details')
					->where('quotation_id', $quotation_id)
					->get()
					->result();

				//Quotation details
				$sub_total_price = 0;
				$cogs_price = 0;
				$total_rate = 0;
				$total_inv_discount = 0;
				if ($quotation_details) {
					foreach ($quotation_details as $details) {
						$sub_total_price   += $details->total_price;
						$total_rate        += $details->rate * $details->quantity;
						$cogs_price        += $details->supplier_rate * $details->quantity;
						$total_inv_discount += $details->discount * $details->quantity;
						//Quotation details entry
						$data = array(
							'invoice_details_id' => $this->auth->generator(15),
							'invoice_id' 		=> $invoice_id,
							'product_id' 		=> $details->product_id,
							'variant_id'		=> $details->variant_id,
							'variant_color'		=> $details->variant_color,
							'store_id'			=> $details->store_id,
							'quantity'			=> $details->quantity,
							'rate'				=> $details->rate,
							'supplier_rate'		=> $details->supplier_rate,
							'total_price'		=> $details->total_price,
							'discount'			=> $details->discount,
							'status'			=> $details->status,
						);
						$quotation_details = $this->db->insert('invoice_details', $data);
					}
				}

				//Tax summary entry start
				$this->db->select('*');
				$this->db->from('quotation_tax_col_summary');
				$this->db->where('quotation_id', $quotation_id);
				$query = $this->db->get();
				$tax_summary = $query->result();

				if ($tax_summary) {
					foreach ($tax_summary as $summary) {
						$tax_col_summary = array(
							'tax_collection_id' => $summary->quot_tax_col_id,
							'invoice_id' 		=> $invoice_id,
							'tax_id' 			=> $summary->tax_id,
							'tax_amount' 		=> $summary->tax_amount,
							'date' 				=> $summary->date,
						);
						$this->db->insert('tax_collection_summary', $tax_col_summary);
					}
				}
				//Tax summary entry end

				//Tax details entry start
				$this->db->select('*');
				$this->db->from('quotation_tax_col_details');
				$this->db->where('quotation_id', $quotation_id);
				$query = $this->db->get();
				$tax_details = $query->result();

				if ($tax_details) {
					foreach ($tax_details as $details) {
						$tax_col_details = array(
							'tax_col_de_id' 	=> $details->quot_tax_col_de_id,
							'invoice_id' 		=> $invoice_id,
							'product_id' 		=> $details->product_id,
							'variant_id' 		=> $details->variant_id,
							'tax_id' 			=> $details->tax_id,
							'amount' 			=> $details->amount,
							'date' 				=> $details->date,
						);
						$this->db->insert('tax_collection_details', $tax_col_details);
					}
				}
				//Tax details entry end
			}
			return true;
		}
	}

	public function check_stock($store_id = null, $product_id = null, $variant = null, $variant_color = null)
	{
		$this->db->select('stock_id,quantity');
		$this->db->from('invoice_stock_tbl');
		if (!empty($store_id)) {
			$this->db->where('store_id', $store_id);
		}
		if (!empty($product_id)) {
			$this->db->where('product_id', $product_id);
		}
		if (!empty($variant)) {
			$this->db->where('variant_id', $variant);
		}
		if (!empty($variant_color)) {
			$this->db->where('variant_color', $variant_color);
		}
		$query = $this->db->get();
		return $query->row();
	}

	//Store List
	public function store_list()
	{
		$this->db->select('*');
		$this->db->from('store_set');
		$this->db->order_by('store_name', 'asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return false;
	}

	//Terminal List
	public function terminal_list()
	{
		$this->db->select('*');
		$this->db->from('terminal_payment');
		$this->db->order_by('terminal_name', 'asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}

	//Get Supplier rate of a product
	public function supplier_rate($product_id)
	{
		$this->db->select('supplier_price');
		$this->db->from('product_information');
		$this->db->where(array('product_id' => $product_id));
		$query = $this->db->get();
		return $query->result_array();
	}

	//Retrieve quotation Edit Data
	public function retrieve_quotation_editdata($quotation_id)
	{
		$acc_category = $this->db->select('category_id')->from('product_category')->where('category_name', 'ACCESSORIES')->get()->row();

		$this->db->select('
				a.*,
				a.quotation_discount as quotation_discount_value,
				b.customer_name,
				c.*,
				c.product_id,
				d.product_name,
				d.product_model,
				d.category_id,
				a.status
			');

		$this->db->from('quotation a');
		$this->db->join('customer_information b', 'b.customer_id = a.customer_id');
		$this->db->join('quotation_details c', 'c.quotation_id = a.quotation_id');
		$this->db->join('product_information d', 'd.product_id = c.product_id');
		$this->db->where('a.quotation_id', $quotation_id);
		// $this->db->order_by('d.product_name');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$result = $query->result_array();
            uksort($result, fn ($a) => $result[$a]['category_id'] == $acc_category->category_id ? 1 : -1);

			// echo "<pre>";var_dump($result);exit;
            return $result;
		}
		return false;
	}

	//Retrieve quotation_html_data
	public function retrieve_quotation_html_data_old($quotation_id)
	{
		$this->db->select('
			a.*,
			a.quotation_discount as quotation_discount_value,
			b.*,
			c.*,
			d.product_id,
			d.product_name,
			d.product_details,
			d.product_model,
			d.image_thumb,
			d.unit,
			e.unit_short_name,
			f.variant_name,
			g.variant_name as variant_color
			');
		$this->db->from('quotation a');
		$this->db->join('customer_information b', 'b.customer_id = a.customer_id', 'left');
		$this->db->join('quotation_details c', 'c.quotation_id = a.quotation_id');
		$this->db->join('product_information d', 'd.product_id = c.product_id', 'left');
		$this->db->join('unit e', 'e.unit_id = d.unit', 'left');
		$this->db->join('variant f', 'f.variant_id = c.variant_id', 'left');
		$this->db->join('variant g', 'g.variant_id = c.variant_color', 'left');
		$this->db->where('a.quotation_id', $quotation_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}

	//Retrieve invoice_html_data
    public function retrieve_quotation_html_data($quotation_id) {
        $direct_quotation = $this->db->select('*')->from('quotation')->where('quotation', $quotation_id)->get()->result_array();
        $this->db->select('
			a.*,
			a.created_at as date_time,
			a.quotation_discount as total_quotation_discount,
			b.*,
			c.*,
			d.product_id,
			d.product_name,
			d.category_id,
			d.product_details,
			d.product_model,
			d.image_thumb,
			d.unit,
			e.unit_short_name,
			f.variant_name,
			g.customer_name as ship_customer_name,
			g.first_name as ship_first_name, g.last_name as ship_last_name,
			g.customer_short_address as ship_customer_short_address,
			g.customer_address_1 as ship_customer_address_1,
			g.customer_address_2 as ship_customer_address_2,
			g.customer_mobile as ship_customer_mobile,
			g.customer_email as ship_customer_email,
			g.city as ship_city,
			g.state as ship_state,
			g.country as ship_country,
			g.zip as ship_zip,
			g.company as ship_company
			');
        $this->db->from('quotation a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id', 'left');
        $this->db->join('quotation_details c', 'c.quotation_id = a.quotation_id', 'left');
        if (empty($direct_quotation[0]['order_id'])) {
            $this->db->join('customer_information g', 'g.customer_id = a.customer_id', 'left');
        } else {
            $this->db->join('shipping_info g', 'g.customer_id = a.customer_id', 'left');
        }

        $this->db->join('product_information d', 'd.product_id = c.product_id', 'left');
        $this->db->join('unit e', 'e.unit_id = d.unit', 'left');
        $this->db->join('variant f', 'f.variant_id = c.variant_id', 'left');
        $this->db->where('a.quotation_id', $quotation_id);
        $this->db->group_by('d.product_id, c.quotation_details_id');
        $this->db->order_by('d.product_name', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

	// Delete quotation Item
	public function retrieve_product_data($product_id)
	{
		$this->db->select('supplier_price,price,supplier_id,tax');
		$this->db->from('product_information');
		$this->db->where(array('product_id' => $product_id, 'status' => 1));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
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

	// Delete quotation Item
	public function delete_quotation($quotation_id)
	{
		//Delete quotation table
		$this->db->where('quotation_id', $quotation_id);
		$this->db->delete('quotation');
		//Delete quotation_details table
		$this->db->where('quotation_id', $quotation_id);
		$this->db->delete('quotation_details');
		//Quotation tax summary delete
		$this->db->where('quotation_id', $quotation_id);
		$this->db->delete('quotation_tax_col_summary');
		//Quotation tax details delete
		$this->db->where('quotation_id', $quotation_id);
		$this->db->delete('quotation_tax_col_details');
		return true;
	}

	public function quotation_search_list($cat_id, $company_id)
	{
		$this->db->select('a.*,b.sub_category_name,c.category_name');
		$this->db->from('quotations a');
		$this->db->join('quotation_sub_category b', 'b.sub_category_id = a.sub_category_id');
		$this->db->join('quotation_category c', 'c.category_id = b.category_id');
		$this->db->where('a.sister_company_id', $company_id);
		$this->db->where('c.category_id', $cat_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}

	// GET TOTAL PURCHASE PRODUCT
	public function get_total_purchase_item($product_id)
	{
		$this->db->select('SUM(quantity) as total_purchase');
		$this->db->from('product_purchase_details');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}

	// GET TOTAL SALES PRODUCT
	public function get_total_sales_item($product_id)
	{
		$this->db->select('SUM(quantity) as total_sale');
		$this->db->from('quotation_details');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}

	//Get total product
	public function get_total_product($product_id)
	{
		$this->db->select('SUM(a.quantity) as total_purchase');
		$this->db->from('product_purchase_details a');
		$this->db->where('a.product_id', $product_id);
		$total_purchase = $this->db->get()->row();

		$this->db->select('SUM(b.quantity) as total_sale');
		$this->db->from('quotation_details b');
		$this->db->where('b.product_id', $product_id);
		$total_sale = $this->db->get()->row();

		$this->db->select('
			product_name,
			product_id,
			supplier_price,
			price,
			supplier_id,
			unit,
			variants,
			product_model,
			unit.unit_short_name
			');
		$this->db->from('product_information');
		$this->db->join('unit', 'unit.unit_id = product_information.unit');
		$this->db->where(array('product_id' => $product_id, 'status' => 1));
		$product_information = $this->db->get()->row();

		$this->db->select('tax.*,tax_product_service.product_id,tax_percentage');
		$this->db->from('tax_product_service');
		$this->db->join('tax', 'tax_product_service.tax_id = tax.tax_id', 'left');
		$this->db->where('tax_product_service.product_id', $product_id);
		$tax_information = $this->db->get()->result();


		if (!empty($tax_information)) {
			foreach ($tax_information as $k => $v) {
				if ($v->tax_name == 'CGST') {
					$tax['cgst_tax'] = ($product_information->price * $v->tax_percentage) / 100;
					$tax['cgst_name']	= $v->tax_name;
					$tax['cgst_id']	= $v->tax_id;
				} elseif ($v->tax_name == 'SGST') {
					$tax['sgst_tax'] = ($product_information->price * $v->tax_percentage) / 100;
					$tax['sgst_name']	= $v->tax_name;
					$tax['sgst_id']	= $v->tax_id;
				} elseif ($v->tax_name == 'IGST') {
					$tax['igst_tax'] = ($product_information->price * $v->tax_percentage) / 100;
					$tax['igst_name']	= $v->tax_name;
					$tax['igst_id']	= $v->tax_id;
				}
			}
		}


		$data2 = array(
			'total_product' => ($total_purchase->total_purchase - $total_sale->total_sale),
			'supplier_price' => $product_information->supplier_price,
			'price' 		=> $product_information->price,
			'variant_id' 	=> $product_information->variants,
			'supplier_id' 	=> $product_information->supplier_id,
			'product_name' 	=> $product_information->product_name,
			'product_model' => $product_information->product_model,
			'product_id' 	=> $product_information->product_id,
			'sgst_tax' 		=> (!empty($tax['sgst_tax']) ? $tax['sgst_tax'] : null),
			'cgst_tax' 		=> (!empty($tax['cgst_tax']) ? $tax['cgst_tax'] : null),
			'igst_tax' 		=> (!empty($tax['igst_tax']) ? $tax['igst_tax'] : null),
			'cgst_id' 		=> (!empty($tax['cgst_id']) ? $tax['cgst_id'] : null),
			'sgst_id' 		=> (!empty($tax['sgst_id']) ? $tax['sgst_id'] : null),
			'igst_id' 		=> (!empty($tax['igst_id']) ? $tax['igst_id'] : null),
			'unit' 			=> $product_information->unit_short_name,
		);

		return $data2;
	}

	//This function is used to Generate Key
	public function generator($lenth)
	{
		$number = array("1", "2", "3", "4", "5", "6", "7", "8", "9");

		for ($i = 0; $i < $lenth; $i++) {
			$rand_value = rand(0, 8);
			$rand_number = $number["$rand_value"];

			if (empty($con)) {
				$con = $rand_number;
			} else {
				$con = "$con" . "$rand_number";
			}
		}
		return $con;
	}

	//QUOTATION NUMBER GENERATOR
	public function number_generator()
	{
		$this->db->select('quotation', 'quotation');
		$query = $this->db->get('quotation');
		$result = $query->result_array();
		$quotation_no = count($result);
		if ($quotation_no >= 1  && $quotation_no < 2) {
			$quotation_no = 1000 + (($quotation_no == 1) ? 0 : $quotation_no) + 1;
		} elseif ($quotation_no >= 2) {
			$quotation_no = 1000 + (($quotation_no == 1) ? 0 : $quotation_no);
		} else {
			$quotation_no = 1000;
		}
		return $quotation_no;
	}

	//INVOICE NUMBER GENERATOR
	public function invoice_number_generator()
	{
		$this->db->select('invoice', 'invoice');
		$query = $this->db->get('invoice');
		$result = $query->result_array();
		$quotation_no = count($result);
		if ($quotation_no >= 1  && $quotation_no < 2) {
			$quotation_no = 1000 + (($quotation_no == 1) ? 0 : $quotation_no) + 1;
		} elseif ($quotation_no >= 2) {
			$quotation_no = 1000 + (($quotation_no == 1) ? 0 : $quotation_no);
		} else {
			$quotation_no = 1000;
		}
		return $quotation_no;
	}

	//Product List
	public function product_list()
	{
		$query = $this->db->select('
					supplier_information.*,
					product_information.*,
					product_category.category_name
				')

			->from('product_information')
			->join('supplier_information', 'product_information.supplier_id = supplier_information.supplier_id', 'left')
			->join('product_category', 'product_category.category_id = product_information.category_id', 'left')
			->group_by('product_information.product_id')
			->order_by('product_information.product_name', 'asc')
			->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return false;
	}

	//Category List
	public function category_list()
	{
		$this->db->select('*');
		$this->db->from('product_category');
		$this->db->where('status', 1);
		$this->db->order_by('category_name', 'asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	//Product Search
	public function product_search($product_name, $category_id)
	{

		$this->db->select('*');
		$this->db->from('product_information');
		if (!empty($product_name)) {
			$this->db->like('product_name', $product_name, 'both');
		}

		if (!empty($category_id)) {
			$this->db->where('category_id', $category_id);
		}

		$this->db->where('status', 1);
		$this->db->order_by('product_name', 'asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
}
