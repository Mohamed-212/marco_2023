<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('includes/head') ?>

        <script>
    var products_with_no_quantity = "<?= display('products_with_no_quantity') ?>";
    var installment_amount_is_not_valid = "<?= display('installment_total_amount_not_match') ?>";
    var payment_bank_not_selected = "<?= display('payment_bank_not_selected') ?>";
    var accessories_category_id = 'a';
    var installErr = "<?= display('choose_installment_if_invoice_not_full_paid')?>";
    var paidErr = "<?= display('paid_error')?>";

    <?php
    $access = $this->db->select('category_id')->from('product_category')->where('category_name', 'ACCESSORIES')->get()->row();
    echo "accessories_category_id = '" . $access->category_id . "';";
    ?>
</script>
    </head>
    
    <body class="hold-transition sidebar-mini  <?php echo (@$this->uri->segment(3)=='pos_invoice'?'sidebar-collapse':'') ?>">
        <!-- Site wrapper -->
        <div class="wrapper">
 <?php
    $url = $this->uri->segment(1);
    if ($url != "admin") {?>
            <header class="main-header">
           
         <?php     $this->load->view('includes/header');?>
   
             
            </header>
<?php } ?>
 
            <!-- Left side column. contains the sidebar -->
              <?php
    $url = $this->uri->segment(1);
    if ($url != "admin") {?>
            <aside class="main-sidebar color1">
                <!-- sidebar -->
              
        <?php  $this->load->view('includes/sidebar'); ?>
 
               
            </aside>
 <?php  } ?>
<?php echo $content; ?>
<?php
    $url = $this->uri->segment(1);
    if ($url != "admin") {?>

            <footer class="main-footer color2">
                <div class="pull-right hidden-xs">
                    <?php echo (!empty($setting['address'])?htmlspecialchars_decode($setting['address']):null) ?> 
                </div>
                &copy; <?php echo date("Y"); ?>
                <strong>
                    <?php echo (!empty($setting['footer_text'])?htmlspecialchars_decode($setting['footer_text']):null) ?>
                </strong>
                    <a href="<?php echo current_url() ?>">
                    <?php echo (!empty($setting['title'])?htmlspecialchars_decode($setting['title']):null) ?></a>
            </footer>

            <?php }?>
        </div> <!-- ./wrapper -->
 
        <!-- Start Core Plugins-->
        <?php $this->load->view('includes/js') ?>
    </body>
</html>
