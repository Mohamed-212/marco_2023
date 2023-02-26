<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script src="<?php echo MOD_URL . 'dashboard/assets/js/print.js'; ?>"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('invoice_details') ?></h1>
            <small><?php echo display('invoice_details') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('invoice') ?></a></li>
                <li class="active"><?php echo display('invoice_details') ?></li>
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
                        <style type="text/css">
                            @media print {
                                .cominfo_div {
                                    display: inline-block;
                                    width: 66%;
                                }

                                .cus_div {
                                    display: inline-block;
                                    margin-left: 5px;
                                }

                                .width_30p {
                                    width: 30%;
                                }

                                .width_70p {
                                    width: 70%;
                                }
                            }
                        </style>
                        <div class="panel-body">
                            <div class="row">

                                <div class="col-sm-9 cominfo_div">
                                    <img src="<?php
                                    if (isset($Soft_settings[0]['invoice_logo'])) {
                                        echo base_url() . $Soft_settings[0]['invoice_logo'];
                                    }
                                    ?>" class="img img-responsive inv_logo" alt="logo">
                                    <br>
                                    <span
                                        class="label label-success-outline m-r-15 p-10"><?php echo display('billing_from') ?></span>
                                    <address class="mt_10">
                                        <strong>
                                        <?php echo html_escape($company_info[0]['company_name']); ?></strong><br>
                                        <?php echo html_escape($company_info[0]['address']); ?><br>
                                        <abbr><?php echo display('mobile') ?>:</abbr>
                                        <?php echo html_escape($company_info[0]['mobile']); ?><br>
                                        <abbr><?php echo display('email') ?>:</abbr>
                                        <?php echo html_escape($company_info[0]['email']); ?><br>
                                        <abbr><?php echo display('website') ?>:</abbr>
<?php echo html_escape($company_info[0]['website']); ?>
                                    </address>
                                </div>

                                <div class="col-sm-2 text-left cus_div">

                                    <h2 class="m-t-0"><?php echo display('purchase_order') ?></h2>
                                    <div><?php echo display('purchase_order') ?>:
                                        <strong><?php echo html_escape($pur_order_no); ?></strong>
                                    </div>
                                    <div class="m-b-15"><?php echo display('billing_date') ?>:
<?php echo date('d-m-Y', strtotime($purchase_date)) ?></div>

                                </div>
                            </div>
                            <hr>

                            <div class="table-responsive m-b-20">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><?php echo display('sl') ?></th>
                                            <th><?php echo display('product_name') ?></th>
                                            <th><?php echo display('size') ?></th>
                                            <th><?php echo display('quantity') ?></th>
                                            <th><?php echo display('rate') ?></th>
                                            <th><?php echo display('ammount') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $grand_total = 0;
                                        if (!empty($po_details)) {
                                            $i = 1;
                                            foreach ($po_details as $invoice) {
                                                ?>

                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><strong><?php echo html_escape($invoice['product_name']); ?> -
                                                            (<?php echo html_escape($invoice['product_model']); ?>)</strong>
                                                    </td>
                                                    <td><?php
                                                        echo html_escape($invoice['variant_name']);
                                                        if (!empty($invoice['variant_color'])) {
                                                            $cvarinfo = $this->db->select('variant_name')->from('variant')->where('variant_id', $invoice['variant_color'])->get()->row();
                                                            if (!empty($cvarinfo)) {
                                                                echo ', ' . $cvarinfo->variant_name;
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php
                                                        if ($receive_status == '1') {
                                                            $rc_quantity = $invoice['rc_quantity'] - $invoice['rt_quantity'];
                                                        } else {
                                                            $rc_quantity = $invoice['quantity'];
                                                        }
                                                        echo html_escape($rc_quantity);
                                                        ?></td>
                                                    <td><?php
                                                        if ($receive_status == '1') {
                                                            echo (($position == 0) ? $currency . " " . $invoice['rc_rate'] : $invoice['rc_rate'] . " " . $currency);
                                                        } else {
                                                            echo (($position == 0) ? $currency . " " . $invoice['rate'] : $invoice['rate'] . " " . $currency);
                                                        }
                                                        ?></td>
                                                    <td><?php
                                                        if ($receive_status == '1') {
                                                            $pur_total_amount = $invoice['rc_total_amount'] - $invoice['rt_total_amount'];
                                                        } else {
                                                            $pur_total_amount = $invoice['total_amount'];
                                                        }
                                                        echo html_escape($pur_total_amount);
                                                        $grand_total += $pur_total_amount;
                                                        $total_discount = $total_purchase_dis;
                                                        $total_vat = $total_purchase_vat;
                                                        $grand_total2 = $grand_total - $total_discount + $total_vat;
                                                        ?></td>
                                                </tr>
                                            <?php }
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="4">
                                                <strong><?php echo htmlspecialchars_decode($purchase_details) ?></strong>
                                            </td>
                                            <td class="grand_total"><strong><?php echo display('total_dis') ?>
                                                    :</strong></td>
                                            <td class="grand_total">
<?php echo (($position == 0) ? $currency . " " . $total_discount : $total_discount . " " . $currency) ?>
                                            </td>
                                        </tr>
<!--                                        <tr>
                                            <td colspan="4">
                                                <strong><?php echo htmlspecialchars_decode($purchase_details) ?></strong>
                                            </td>
                                            <td class="grand_total"><strong><?php echo display('vat_rate') ?>
                                                    :</strong></td>
                                            <td class="grand_total">
<?php echo (($position == 0) ? $currency . " " . $total_vat : $total_vat . " " . $currency) ?>
                                            </td>
                                        </tr>-->
                                        <tr>
                                            <td colspan="4">
                                                <strong><?php echo htmlspecialchars_decode($purchase_details) ?></strong>
                                            </td>
                                            <td class="grand_total"><strong><?php echo display('grand_total') ?>
                                                    :</strong></td>
                                            <td class="grand_total">
<?php echo (($position == 0) ? $currency . " " . $grand_total2 : $grand_total2 . " " . $currency) ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer text-left">
<?php if ($this->permission->check_label('manage_sale')->read()->access()) { ?>
                            <a class="btn btn-danger"
                               href="<?php echo base_url('dashboard/Cpurchase/purchase_order'); ?>"><?php echo display('cancel') ?></a>
<?php } ?>
                        <a class="btn btn-info" href="<?php echo current_url(); ?>"
                           onclick="printPageDiv('printableArea')"><span class="fa fa-print"></span>
<?php echo display('print') ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->