<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Rozarback extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
       
        $this->load->model(array(
           
            'rozarpay/rozar_model',
            'setting/payment_model',
            'setting/logs_model'
           
        ));
       
    }

    public function editpayment($id=null)
    {

    		$this->permission->method('setting','update')->redirect();
            $this->form_validation->set_rules('payment',display('payment_name'),'required|max_length[50]');
       $this->form_validation->set_rules('status',display('status')  ,'required');
       $saveid=$this->session->userdata('id');
       $data['payments']   = (Object) $postData = [
           'setupid'             => $this->input->post('setupid'),
           'paymentid'           => $this->input->post('payment',true),
           'marchantid'          => $this->input->post('marchantid',true),
           'password'            => $this->input->post('password',true),
           'email'               => $this->input->post('email',true),
           'currency'            => $this->input->post('currency',true),
           'Islive'              => $this->input->post('islive',true),
           'status'              => $this->input->post('status',true),
           'country_list'        => $this->input->post('country_list',true),
           'zone_list'        => $this->input->post('zone_list',true),
          ]; 
      $data['intinfo']="";
      if ($this->form_validation->run()) { 
   
        $this->permission->method('setting','update')->redirect();
        
   
      //print_r($postData);
        if ($this->klrana_model->psetupupdate($postData)) { 
        
         $this->session->set_flashdata('message', display('update_successfully'));
        } else {
        $this->session->set_flashdata('exception',  display('please_try_again'));
        }
        redirect("setting/paymentmethod/paymentsetup");  
       
       } 
            else{
		$data['title'] = display('payment_edit');
		$data['intinfo']   = $this->klrana_model->psetupById($id);
		$data['paymentlist']   =  $this->klrana_model->payment_dropdown();
		 $data['currency_list'] = array(
		 	'INR' => '(INR) Indian rupee',
			'EUR' => '(EUR) Euro',
			'SGD' => '(SGD) Singapore dollar',
            'USD' => '(USD) U.S. Dollar',
            'AUD' => '(AUD) Australian Dollar',
			'AED' => '(AED) United Arab Emirates Dirham',
            'CAD' => '(CAD) Canadian Dollar',
            'GBP' => '(GBP) Pound Sterling',
			'SEK' => '(SEK) Swedish Krona',
			'BDT' => '(BDT) Bangladeshi taka',
		);
           
        $data['module'] = "rozarpay";  
        $data['page']   = "payment_setup";
		$this->load->view('rozarpay/payment_setup', $data);
        } 
    }
}
