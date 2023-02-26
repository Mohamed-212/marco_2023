<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rozarpay extends MX_Controller {
    public  $webinfo;
    public $settinginfo;
    public $version='';
    public function __construct() {
       parent::__construct();
    }

	  public function payment_success()
    { 
      $data = array(
          'user_id' => '1',
          'product_id' => $this->input->post('product_id'),
          'payment_id' => $this->input->post('razorpay_payment_id'),
          'amount' => $this->input->post('totalAmount')
      );
      $arr = array('msg' => 'Payment successfully credited', 'status' => true);
	    echo json_encode($arr);
    }
}