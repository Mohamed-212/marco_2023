<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cquotation extends MX_Controller {
	
	function __construct() {
      	parent::__construct();
      	$this->auth->check_user_auth();
      	$this->load->library('dashboard/Lquotation');
		$this->load->model('dashboard/Quotations');
    }

    //Product Add Form
	public function index()
	{	
        $content = $this->lquotation->quotation_list();
		$this->template_lib->full_admin_html_view($content);
	}

	//Add new quotation
	public function new_quotation()
	{
		$this->permission->check_label('new_quotation')->create()->redirect();
		if(check_module_status('accounting') == 1){
            $find_active_fiscal_year=$this->db->select('*')->from('acc_fiscal_year')->where('status',1)->get()->row();
            if (!empty($find_active_fiscal_year)) {
//				$CI =& get_instance();
//				$CI->load->library('dashboard/Lquotation');
//				$content = $CI->lquotation->quotation_add_form();
//				$this->template_lib->full_admin_html_view($content);
                $this->load->model(array(
                    'dashboard/Stores',
                    'dashboard/Invoices',
                    'dashboard/Variants',
                    'dashboard/Customers',
                    'dashboard/Shipping_methods'
                ));
                $store_list = $this->Stores->store_list();
                $variant_list = $this->Variants->variant_list();
                $shipping_methods = $this->Shipping_methods->shipping_method_list();
                $customer = $this->Customers->customer_list();
                $bank_list = $this->Invoices->bank_list();
                $payment_info = $this->Invoices->payment_info();
                $all_pri_type = $this->Invoices->select_all_pri_type();
				$summary = $this->Customers->customer_transection_summary($customer[0]['customer_id'], null, null);
                $data = array(
                    'title' => display('new_quotation'),
                    'store_list' => $store_list,
                    'variant_list' => $variant_list,
                    'customer' => $customer[0],
                    'bank_list' => $bank_list,
                    'payment_info' => $payment_info,
                    'employee' => $this->empdropdown(),
                    'all_pri_type' => $all_pri_type,
					'total_balance'	=> round($summary[1][0]['total_debit']-$summary[0][0]['total_credit'], 2),
                );
                $data['module'] = "dashboard";
                $data['page'] = "quotation/add_quotation_form";
                echo Modules::run('template/layout', $data);
			}else{
				$this->session->set_userdata(array('error_message'=>display('no_active_fiscal_year_found')));
                redirect(base_url('Admin_dashboard'));
			}
		}else{
			$CI =& get_instance();
			$CI->load->library('dashboard/Lquotation');
			$content = $CI->lquotation->quotation_add_form();
			$this->template_lib->full_admin_html_view($content);
		}
	}

    public function empdropdown() {
        $this->db->select('*');
        $this->db->from('employee_history');
        $query = $this->db->get();
        $data = $query->result();

        $list = array('' => 'Select One...');
        if (!empty($data)) {
            foreach ($data as $value) {
                $list[$value->id] = $value->first_name . " " . $value->last_name;
            }
        }
        return $list;
    }

	//Insert product and upload
	public function insert_quotation()
	{
        $this->load->library('form_validation');
        $this->form_validation->set_rules('product_id[]', display('product_id'), 'required');
        // $this->form_validation->set_rules('variant_id[]', display('variant'), 'required');
        // $this->form_validation->set_rules('batch_no[]', display('batch_no'), 'required');
        $this->form_validation->set_rules('employee_id', display('employee_id'), 'required');

		$this->form_validation->set_rules('available_quantity[]', display('available_quantity'), 'required|greater_than[0]');
		$this->form_validation->set_rules('product_quantity[]', display('quantity'), 'required|greater_than[0]');

        if ($this->form_validation->run() == false) {
            $this->session->set_userdata(array('error_message' => display('failed_try_again')));
            // $this->index();
			$this->new_quotation();
        } else {
            $quotation_id = $this->Quotations->quotation_entry();
            $this->session->set_userdata(array('message'=>display('successfully_added')));
            //$this->quotation_inserted_data($quotation_id);
            $this->quotation_details_data($quotation_id);
            if(isset($_POST['add-quotation'])){
                redirect(base_url('dashboard/Cquotation'));
            }elseif(isset($_POST['add-quotation-another'])){
                redirect(base_url('dashboard/Cquotation/new_quotation'));
            }
        }
	}

	//Search Inovoice Item
	public function search_inovoice_item()
	{
		$CI =& get_instance();
		$CI->load->library('dashboard/Lquotation');
		
		$customer_id = $this->input->post('customer_id',TRUE);
        $content = $CI->lquotation->search_inovoice_item($customer_id);
		$this->template_lib->full_admin_html_view($content);
	}
	
	//quotation Update Form
	public function quotation_update_form($quotation_id)
	{	
		$content = $this->lquotation->quotation_edit_data($quotation_id);
		$this->template_lib->full_admin_html_view($content);
	}

	//POS quotation page load
	public function pos_quotation(){
		$CI =& get_instance();
		$CI->load->library('dashboard/Lquotation');
		$content = $CI->lquotation->pos_quotation_add_form();
		$this->template_lib->full_admin_html_view($content);
	}

	// Quotation Update
	public function quotation_update($quotation_id)
	{
        // $this->load->library('form_validation');
        // $this->form_validation->set_rules('product_id[]', display('product_id'), 'required');
        // // $this->form_validation->set_rules('variant_id[]', display('variant'), 'required');
        // // $this->form_validation->set_rules('batch_no[]', display('batch_no'), 'required');
        // $this->form_validation->set_rules('employee_id', display('employee_id'), 'required');
        // if ($this->form_validation->run() == false) {
        //     $this->session->set_userdata(array('error_message' => display('failed_try_again')));
        //     $this->index();
        // } else {
        //     if(check_module_status('accounting') == 1){
        //         $find_active_fiscal_year=$this->db->select('*')->from('acc_fiscal_year')->where('status',1)->get()->row();
        //         if (!empty($find_active_fiscal_year)) {
        //             $quotation_id = $this->Quotations->quot_paid_data($quotation_id);
        //             $this->session->set_userdata(array('message'=>display('successfully_added')));
        //             redirect('dashboard/Cquotation');
        //         }else{
        //             $this->session->set_userdata(array('error_message'=>display('no_active_fiscal_year_found')));
        //             redirect(base_url('Admin_dashboard'));
        //         }
        //     }else{
        //         $quotation_id = $this->Quotations->quot_paid_data($quotation_id);
        //         $this->session->set_userdata(array('message'=>display('successfully_added')));
        //         redirect('dashboard/Cquotation');
        //     }
        // }

		$this->permission->check_label('manage_sale')->update()->redirect();

		$this->load->library('form_validation');
        $this->form_validation->set_rules('product_id[]', display('product_id'), 'required');
        // $this->form_validation->set_rules('variant_id[]', display('variant'), 'required');
        // $this->form_validation->set_rules('batch_no[]', display('batch_no'), 'required');
        $this->form_validation->set_rules('employee_id', display('employee_id'), 'required');

		$this->form_validation->set_rules('available_quantity[]', display('available_quantity'), 'required|greater_than[0]');
		$this->form_validation->set_rules('product_quantity[]', display('quantity'), 'required|greater_than[0]');

        if ($this->form_validation->run() == false) {
            $this->session->set_userdata(array('error_message' => display('failed_try_again')));
            // $this->index();
			$this->quotation_update_form($quotation_id);
			return;
        }

        $quotation_id = $this->Quotations->update_quotation($quotation_id);

        $this->session->set_userdata(array('message' => display('successfully_updated')));

        $invoice_id = $this->db->select('invoice_id')->from('invoice')->where('quotation_id', $quotation_id)->get();
        if ($invoice_id) {
            redirect('dashboard/Cinvoice/invoice_inserted_data/' . $invoice_id->row()->invoice_id);
        } else {
            redirect('dashboard/Cquotation');
        }

//		$quotation_id = $this->Quotations->update_quotation();
//		$this->session->set_userdata(array('message'=>display('successfully_updated')));
//		redirect('dashboard/Cquotation/quotation_details_data/'.$quotation_id);
	}

	// Quotation paid data
	public function quot_paid_data($quotation_id){

		if(check_module_status('accounting') == 1){
            $find_active_fiscal_year=$this->db->select('*')->from('acc_fiscal_year')->where('status',1)->get()->row();
            if (!empty($find_active_fiscal_year)) {
                    $quotation_id = $this->Quotations->quot_paid_data($quotation_id);
				$this->session->set_userdata(array('message'=>display('successfully_added')));
				redirect('dashboard/Cquotation');
			}else{
				$this->session->set_userdata(array('error_message'=>display('no_active_fiscal_year_found')));
                redirect(base_url('Admin_dashboard'));
			}
		}else{
			$quotation_id = $this->Quotations->quot_paid_data($quotation_id);
			$this->session->set_userdata(array('message'=>display('successfully_added')));
			redirect('dashboard/Cquotation');
		}

	}

	//Retrive right now inserted data to cretae html
	public function quotation_inserted_data($quotation_id)
	{	
		$content = $this->lquotation->quotation_html_data($quotation_id);
		$this->template_lib->full_admin_html_view($content);
	}

	//Retrive right now inserted data to cretae html
	public function quotation_details_data($quotation_id)
	{	
		$content = $this->lquotation->quotation_details_data($quotation_id);
		$this->template_lib->full_admin_html_view($content);
	}

	public function quotation_details_pdf($quotation_id)
    {
        $CI =& get_instance();
		$CI->load->model('dashboard/quotations');
		$CI->load->model('dashboard/Soft_settings');
		$CI->load->library('occational');
		$CI->load->library('Pdfgenerator');
		$quotation_detail = $CI->quotations->retrieve_quotation_html_data($quotation_id);

		$subTotal_quantity 	= 0;
		$subTotal_cartoon 	= 0;
		$subTotal_discount 	= 0;

		if(!empty($quotation_detail)){
			foreach($quotation_detail as $k=>$v){
				$subTotal_quantity = $subTotal_quantity+$quotation_detail[$k]['quantity'];
			}
			$i=0;
			foreach($quotation_detail as $k=>$v){$i++;
			   $quotation_detail[$k]['sl']=$i;
			}
		}

		$currency_details = $CI->Soft_settings->retrieve_currency_info();
		$company_info = $CI->quotations->retrieve_company();
		$soft_settings = $CI->Soft_settings->retrieve_setting_editdata();
		$data=array(
			'title'				=>display('quotation_details'),
			'quotation_id'		=>$quotation_detail[0]['quotation_id'],
			'quotation_no'		=>$quotation_detail[0]['quotation'],
			'customer_address'	=>$quotation_detail[0]['customer_short_address'],
			'customer_name'		=>$quotation_detail[0]['customer_name'],
			'customer_mobile'	=>$quotation_detail[0]['customer_mobile'],
			'customer_email'	=>$quotation_detail[0]['customer_email'],
			'final_date'		=>$quotation_detail[0]['date'],
			'total_amount'		=>$quotation_detail[0]['total_amount'],
			'quotation_discount'=>$quotation_detail[0]['quotation_discount'],
			'service_charge' 	=>$quotation_detail[0]['service_charge'],
			'paid_amount'		=>$quotation_detail[0]['paid_amount'],
			'due_amount'		=>$quotation_detail[0]['due_amount'],
			'details'			=>$quotation_detail[0]['details'],
			'subTotal_quantity'	=>$subTotal_quantity,
			'quotation_all_data'=>$quotation_detail,
			'company_info'		=>$company_info,
			'currency' 			=>$currency_details[0]['currency_icon'],
			'position' 			=>$currency_details[0]['currency_position'],
			'Soft_settings' 	=>$soft_settings,
			);

		$content = $CI->parser->parse('dashboard/quotation/quotation_pdf',$data,true);
        $file_path = $this->pdfgenerator->generate_order($quotation_id, $content);
        $this->load->helper('download');
        force_download($file_path, NULL);
        redirect('dashboard/Cquotation');
    }

	//Retrive right now inserted data to cretae html
	public function pos_quotation_inserted_data($quotation_id)
	{	
		$CI =& get_instance();
		$CI->load->library('dashboard/Lquotation');
		$content = $CI->lquotation->pos_quotation_html_data($quotation_id);		
		$this->template_lib->full_admin_html_view($content);
	}

	// retrieve_product_data
	public function retrieve_product_data()
	{	
		$CI =& get_instance();
		$CI->load->model('dashboard/Quotations');
		$product_id = $this->input->post('product_id',TRUE);
		$product_info = $CI->Quotations->get_total_product($product_id);
		echo json_encode($product_info);
	}

	// product_delete
	public function quotation_delete($quotation_id)
	{	
		$CI =& get_instance();
		$CI->load->model('dashboard/Quotations');
		$result = $CI->Quotations->delete_quotation($quotation_id);
		if ($result) {
			$this->session->set_userdata(array('message'=>display('successfully_delete')));
		}else{
			$this->session->set_userdata(array('error_message'=>display('failed_try_again')));
		}	
		redirect('dashboard/Cquotation');
	}

	//AJAX quotation STOCKs
	public function product_stock_check($product_id)
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Quotations');

		$purchase_stocks = $CI->Quotations->get_total_purchase_item($product_id);	
		$total_purchase = 0;		
		if(!empty($purchase_stocks)){	
			foreach($purchase_stocks as $k=>$v){
				$total_purchase = ($total_purchase + $purchase_stocks[$k]['quantity']);
			}
		}
		$sales_stocks = $CI->Quotations->get_total_sales_item($product_id);
		$total_sales = 0;	
		if(!empty($sales_stocks)){	
			foreach($sales_stocks as $k=>$v){
				$total_sales = ($total_sales + $sales_stocks[$k]['quantity']);
			}
		}
		
		$final_total = ($total_purchase - $total_sales);
		return $final_total ;
	}


	//Search product by product name and category
	public function search_product(){
		$CI =& get_instance();
		$CI->load->model('dashboard/Quotations');
		$product_name = $this->input->post('product_name',TRUE);
		$category_id  = $this->input->post('category_id',TRUE);
		$product_search = $this->Quotations->product_search($product_name,$category_id);
        if ($product_search) {
            foreach ($product_search as $product) {
            echo "<div class=\"col-xs-6 col-sm-4 col-md-2 col-p-3\">";
                echo "<div class=\"panel panel-bd product-panel select_product\">";
                    echo "<div class=\"panel-body\">";
                        echo "<img src=\"$product->image_thumb\" class=\"img-responsive\" alt=\"\">";
                        echo "<input type=\"hidden\" name=\"select_product_id\" class=\"select_product_id\" value='".$product->product_id."'>";
                    echo "</div>";
                    echo "<div class=\"panel-footer\">$product->product_model - $product->product_name</div>";
                echo "</div>";
            echo "</div>";
        	}
        }else{
        	echo "420";
        }
	}

	//Insert new customer
	public function insert_customer(){
		$CI =& get_instance();
		$CI->load->model('dashboard/Quotations');

		$customer_id=$this->auth->generator(15);

	  	//Customer  basic information adding.
		$data=array(
			'customer_id' 		=> $customer_id,
			'customer_name' 	=> $this->input->post('customer_name',TRUE),
			'customer_mobile' 	=> $this->input->post('mobile',TRUE),
			'customer_email' 	=> $this->input->post('email',TRUE),
			'status' 			=> 1
			);

		$result=$this->Quotations->customer_entry($data);
		
		if ($result == TRUE) {		
			$this->session->set_userdata(array('message'=>display('successfully_added')));
			redirect(base_url('Cquotation/pos_quotation'));
		}else{
			$this->session->set_userdata(array('error_message'=>display('already_exists')));
			redirect(base_url('Cquotation/pos_quotation'));
		}
	}

	//This function is used to Generate Key
	public function generator($lenth)
	{
		$number=array("1","2","3","4","5","6","7","8","9");
	
		for($i=0; $i<$lenth; $i++)
		{
			$rand_value=rand(0,8);
			$rand_number=$number["$rand_value"];
		
			if(empty($con))
			{ 
			$con=$rand_number;
			}
			else
			{
			$con="$con"."$rand_number";}
		}
		return $con;
	}
}