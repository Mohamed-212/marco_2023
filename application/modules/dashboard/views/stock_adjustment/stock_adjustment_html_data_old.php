<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$CI = &get_instance();
$CI->load->model('Soft_settings');
$Soft_settings = $CI->Soft_settings->retrieve_setting_editdata();
?>
<script src="<?php echo MOD_URL . 'dashboard/assets/js/print.js'; ?>"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('stock_adjustment_details') ?></h1>
            <small><?php echo display('stock_adjustment') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('stock') ?></a></li>
                <li class="active"><?php echo display('manage_stock_adjustment') ?></li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Alert Message -->
        <?php
        $message = $this->session->userdata('message');
        if (isset($message)) {
        ?>
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $message ?>
        </div>
        <?php
            $this->session->unset_userdata('message');
        }
        $error_message = $this->session->userdata('error_message');
        if (isset($error_message)) {
        ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $error_message ?>
        </div>
        <?php
            $this->session->unset_userdata('error_message');
        }
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                    <div id="printableArea">
                        <link href="<?php echo MOD_URL . 'dashboard/assets/css/print.css'; ?>" rel="stylesheet"
                            type="text/css" />
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h2 class="text-center">
                                        Inventory Voucher Adjustment
                                    </h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 r_cominfo_div">
                                    <img src="<?php echo  base_url() . (!empty(html_escape($Soft_settings[0]['invoice_logo'])) ? $Soft_settings[0]['invoice_logo'] : 'assets/img/icons/default.jpg') ?>"
                                        class="img img-responsive inv_logo" alt="logo">
                                    <br>
                                    <address class="mt_10">
                                        <strong></strong><br>
                                        <div><strong><?php echo display('inventory_voucher_no') ?>:
                                            </strong></div>
                                        <div><strong><?php echo display('store_name') ?>:</strong></div>
                                        <div><strong><?php echo display('notes') ?>:</strong></div>
                                    </address>
                                </div>

                                <div class="col-sm-2 text-left cus_div" style="margin-top: 5.6%;">
                                    <address class="mt_10">
                                        <div><strong><?php echo display('inventory_voucher_date') ?> :</strong></div>
                                        <div><strong><?php echo display('inventory_supervisor') ?> :</strong></div>
                                        <br>
                                    </address>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive m-b-20">
                                <table class="table table-striped">
                                    <thead>

                                        <tr>
                                            <th><?php echo display('sl') ?></th>
                                            <th><?php echo display('item_code') ?></th>
                                            <th><?php echo display('item_picture') ?></th>
                                            <th><?php echo display('product_name') ?></th>
                                            <th><?php echo display('variant') ?></th>
                                            <th><?php echo display('unit') ?></th>
                                            <th><?php echo display('available_quantity') ?></th>
                                            <th><?php echo display('quantity') ?></th>
                                            <th><?php echo display('inventory_difference') ?></th>
                                            <th><?php echo display('unit_cost_price') ?></th>
                                            <th><?php echo display('unit_sale_price') ?></th>
                                            <th><?php echo display('total_unit_cost_price') ?></th>
                                            <th><?php echo display('total_unit_selling_price') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($adjustment_details)) {
                                            $total_cost_price = $total_selling_price = 0;
                                            foreach ($adjustment_details as $key => $details) {
                                        ?>
                                        <tr>
                                            <td><?php echo $key + 1 ?></td>
                                            <td><?php echo html_escape($details['product_id']); ?></td>
                                            <td><img src="<?php echo  base_url() . (!empty(html_escape($details['image_thumb'])) ? $details['image_thumb'] : 'assets/img/icons/default.jpg') ?>"
                                                    width="50" height="50"></td>
                                            <td><strong><?php echo html_escape($details['product_name']); ?> -
                                                    (<?php echo html_escape($details['product_model']); ?>)</strong>
                                            </td>
                                            <td>
                                                <?php echo html_escape($details['variant_name']);
                                                        if (!empty($details['variant_color'])) {
                                                            echo ', ' . $details['variant_color'];
                                                        }
                                                        ?>
                                            </td>
                                            <td><?php echo html_escape($details['unit_short_name']); ?></td>
                                            <td><?php echo html_escape($details['previous_quantity']); ?></td>
                                            <td>
                                                <?php
                                                        if ($details['adjustment_type'] == 'increase') {
                                                            echo ($details['previous_quantity'] + ($details['adjustment_quantity']));
                                                        } else {
                                                            echo ($details['previous_quantity'] - ($details['adjustment_quantity']));
                                                        }
                                                        ?>

                                            </td>
                                            <td>
                                                <?php
                                                        if ($details['adjustment_type'] == 'increase') {
                                                            echo "<span class='text-success'>+" . ($details['adjustment_quantity']) . "</span>";
                                                        } else {
                                                            echo "<span class='text-danger'>-" . ($details['adjustment_quantity']) . "</span>";
                                                        }
                                                        ?>
                                            </td>
                                            <td><?php echo html_escape($details['supplier_price']); ?></td>
                                            <td><?php echo html_escape($details['price']); ?></td>
                                            <td><?php $total_cost_price += ($details['supplier_price'] * $details['adjustment_quantity']);
                                                        echo $details['supplier_price'] * $details['adjustment_quantity']; ?>
                                            </td>
                                            <td><?php $total_selling_price += ($details['price'] * $details['adjustment_quantity']);
                                                        echo $details['price'] * $details['adjustment_quantity']; ?>
                                            </td>
                                        </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="11"></td>
                                            <td><?php echo html_escape($total_cost_price); ?></td>
                                            <td><?php echo html_escape($total_selling_price); ?></td>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                            <div class="row" style="margin-top: 50px;">
                                <div class="col-sm-6 text-center"><strong style="border-top:1px solid #000">inventory
                                        voucher entry according to the user:</strong></div>
                                <div class="col-sm-6 text-center"><strong style="border-top:1px solid #000">warehouse
                                        manager signature :</strong></div>
                            </div>
                            <div class="row" style="margin-top: 50px;">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6 text-center"><strong style="border-top:1px solid #000">Signature of
                                        the Chief Financial Officer :</strong></div>
                            </div>
                            <div class="row" style="margin-top: 50px;">
                                <div class="col-sm-6 text-center"><strong style="border-top:1px solid #000">Signature of
                                        the accountant :</strong></div>
                                <div class="col-sm-6 text-center"><strong style="border-top:1px solid #000">Signature of
                                        the Director General :</strong></div>
                            </div>
                        </div>


                    </div>

                    <div class="panel-footer text-left">
                        <a class="btn btn-danger"
                            href="<?php echo base_url('Cstock_adjustment/manage_stock_adjustment'); ?>"><?php echo display('cancel') ?></a>
                        <a class="btn btn-info" href="#" onclick="printDiv('printableArea')"><span
                                class="fa fa-print"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->