<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title><?php echo (!empty($setting->title)?$setting->title:null) ?> :: <?php echo (!empty($title)?$title:null) ?></title>

<!-- Favicon and touch icons -->
<link rel="shortcut icon" href="<?php echo base_url((!empty($setting->favicon)?$setting->favicon:'assets/img/icons/favicon.png')) ?>" type="image/x-icon">

<!-- Bootstrap -->
<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"/>

<script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
<style>
body{background:#CCC;}
.contact_area{    width: 270px;
    margin: 60px auto;
    background: #FFF;
    padding: 25px;}
#form-container {
    position: relative;
}
</style>
 </head>
  <body>  
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" id="CSRF_TOKEN"
        value="<?php echo $this->security->get_csrf_hash(); ?>">
  <!-- Contact Area -->
    <section class="contact_area">
            <div class="row">
                <div class="col-sm-12">  
                	 <div id="form-container">
                         <div class="row">
                          <div class="col-md-12 text-center">
                              <h4><?php echo $customerinfo['customer_name'];?></h4>
                              <h5><?php echo $orderinfo['total_amount'];?></h5>
                          </div>
                          
                          <div class="col-md-12 text-center">
                              <button id="paymentsubmit" class="btn btn-success btn-lg buy_now" data-amount="<?php echo round($orderinfo['total_amount']*100);?>" data-id="<?php echo $orderinfo['order_id'];?>" data-product="Product 3">Submit</button>
                              <a href="<?php echo base_url() ?>" class="btn btn-danger btn-lg">Cancel</a>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- End Contact Area -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
		  $(document).ready(function(){
				$("#paymentsubmit").trigger('click');
			});     
        </script>
    <script type="text/javascript">
      $('body').on('click', '.buy_now', function(e){
        var totalAmount = $(this).attr("data-amount");
        var product_id =  $(this).attr("data-id");
    	  var csrf = $('#CSRF_TOKEN').val();
        console.log(csrf);
        var options = {
          "key": "<?php echo $apikey;?>",
          "currency": "INR",
          "amount": totalAmount,   
          "description": "Test Transaction",
          "handler": function (response){
            $.ajax({
              url: '<?php echo base_url() ?>'+'rozarpay/rozarpay/payment_success',
              type: 'post',
              dataType: 'json',
              data: {
                  csrf_test_name:csrf,
                  razorpay_payment_id: response.razorpay_payment_id,
                  totalAmount : totalAmount,
                  product_id : product_id
              },
              success: function (msg) {
                 window.location.href = '<?php echo base_url() ?>'+'web/home/r_pay_successful/<?php echo $orderinfo['order_id'];?>/<?php echo $customerinfo['customer_id'];?>';
              }
            });
          },
        	"prefill": {
            "name"   : "<?php echo $customerinfo['customer_name'];?>",
            "email"  : "<?php echo $customerinfo['customer_email'];?>",
            "contact": "<?php echo $customerinfo['customer_mobile'];?>"
          },
      	  "callback_url":"<?php echo base_url() ?>'+'web/home/r_pay_successful/<?php echo $orderinfo['order_id'];?>"
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
        e.preventDefault();
      });
    </script>
<!-- Bootstrap -->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
</body>
</html>
