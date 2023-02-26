<?php 
    $order_id   ='272';
    $merchant   ='TEST3000001135';
    $apipassword='b485ab4058c035568dfb7e7f599a567d';
    $amount     =100.00;
    $returnURL  =base_url();
    $currency   ='SAR';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://test-gateway.mastercard.com/api/nvp/version/49");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POST,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,'apiOperation=CREATE_CHECKOUT_SESSION&apiPassword='.$apipassword.'&apiUsername=merchant.'.$merchant.'&merchant='.$merchant.'&interaction.returnUrl='.$returnURL.'&order.id='.$order_id.'&order.amount='.$amount.'&order.currency='.$currency.'');
    $headers   = array();
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    $result    = curl_exec($ch);
    if(curl_errno($ch)){
        echo 'ERROR :'.curl_error($ch);
    }
    curl_close($ch);
    $sessionid = explode("=",explode("&", $result)[2])[1];
?>
<script src="https://test-gateway.mastercard.com/checkout/version/49/checkout.js" 
        data-error="errorCallback"
        data-cancel="<?php echo base_url() ?>">
</script>
<script type="text/javascript">
    function errorCallback(error){
        alert("Error: "+ JSON.stringify(error));
        window.location.href="<?php echo base_url('Payment') ?>";
    }
    Checkout.configure({
        merchant: '<?php echo $merchant ?>',
        order:{
                amount:function(){
                    return <?php echo $amount ?> 
                },
                currency: '<?php echo $currency ?>',
                description:"Order Goods",
                id:<?php echo $order_id ?>
            },
            interaction:{
                
                merchant: {
                    name:"Muhammad Usman",
                    address:{
                        line1: "Dhaka",
                        line1: "Bangladesh"
                    }
                }
            },
            session: {
                id: '<?php echo $sessionid; ?>'
            }
            
            
    });
    Checkout.showPaymentPage();
</script>




















<!-- 
<html>
    <head>
        <script src="https://test-gateway.mastercard.com/checkout/version/61/checkout.js"
                data-error="errorCallback"
                data-cancel="cancelCallback">
        </script>

        <script type="text/javascript">
            function errorCallback(error) {
                  console.log(JSON.stringify(error));
            }
            function cancelCallback() {
                  console.log('Payment cancelled');
            }

            Checkout.configure({
                session: { 
                    id: "<?php //echo md5('1000')?>"
                 },
                merchant: 'TEST3000001135',
                order: {
                    amount: function() {
                        //Dynamic calculation of amount
                        return 80 + 20;
                    },
                    currency: 'USD',
                    description: 'Ordered goods',
                    id: "2000"
                },
                interaction: {
                    merchant: {
                        name: 'Your merchant name',
                        address: {
                            line1: '200 Sample St',
                            line2: '1234 Example Town'
                        }
                    }
                }
            });
        </script>
    </head>
    <body>
        ...
        <input type="button" value="Pay with Lightbox" onclick="Checkout.showLightbox();" />
        <input type="button" value="Pay with Payment Page" onclick="Checkout.showPaymentPage();" />
        ...
    </body>
</html> -->