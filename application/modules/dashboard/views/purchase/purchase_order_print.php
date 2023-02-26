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
            <h1><?php echo display('purchase_order') ?></h1>
            <small><?php echo display('purchase_order_print') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('purchase') ?></a></li>
                <li class="active"><?php echo display('purchase_order') ?></li>
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

                                <div class="col-sm-6 r_cominfo_div">
                                    <img src="<?php if (isset($Soft_settings[0]['invoice_logo'])) {
                                                    echo base_url() . $Soft_settings[0]['invoice_logo'];
                                                } ?>" class="img img-responsive inv_logo" alt="logo">
                                    <br>
                                    <span
                                        class="label label-success-outline m-r-15 p-10"><?php echo display('billing_from') ?></span>
                                    <address class="mt_10">
                                        <strong>
                                            <?php echo html_escape($company_info[0]['company_name']); ?></strong><br>
                                        <div><?php echo display('address') ?>:
                                            <?php echo html_escape($company_info[0]['address']); ?></div>

                                        <div>
                                            <abbr>
                                                <?php echo display('mobile') ?>
                                            </abbr> :
                                            <?php echo html_escape($company_info[0]['mobile']); ?>
                                        </div>

                                        <div>
                                            <abbr><?php echo display('email') ?>:</abbr><?php echo html_escape($company_info[0]['email']); ?>
                                        </div>
                                        <div>
                                            <abbr><?php echo display('website') ?>:</abbr><?php echo html_escape($company_info[0]['website']); ?>
                                        </div>
                                        <div>
                                            <?php $store = $this->db->select('store_name')->from('store_set')->where('store_id', $store_id)->get()->row(); ?>
                                            <abbr><?php echo display('branch') ?>:</abbr>
                                            <?php echo html_escape($store->store_name); ?>
                                        </div>
                                        <?php
                                        $company_vat = $this->db->select('vat_no')->from('company_information')->where('status', 1)->get()->row();
                                        if (!empty($company_vat)) {
                                        ?>
                                        <div>
                                            <abbr><?php echo display('our_vat_no') ?>:</abbr><?php echo html_escape($company_vat->vat_no); ?>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                    </address>
                                </div>

                                <div class="col-sm-2 text-left cus_div">
                                    <h2 class="m-t-0"><?php echo display('purchase_order') ?></h2>
                                    <div>
                                        <?php echo display('purchase_order_no') ?>:
                                        <?php echo html_escape($pur_order_no); ?>
                                    </div>
                                    <div>
                                        <?php echo display('supplier_name') ?>:
                                        <?php echo html_escape($supplier_name); ?>
                                    </div>
                                    <div>
                                        <?php echo display('supplier_mobile') ?>:
                                        <?php echo html_escape($supplier_mobile); ?>
                                    </div>
                                    <div>
                                        <?php echo display('cr_no') ?>
                                        :<?php echo html_escape($supplier_cr_no) ?>
                                    </div>
                                    <div>
                                        <?php echo display('vat_for_supplier') ?>
                                        :<?php echo html_escape($supplier_vat_no) ?>
                                    </div>
                                    <div>
                                        <?php echo display('purchase_order_date') ?>
                                        :<?php echo html_escape($purchase_date) ?>
                                    </div>
                                    <div>
                                        <?php echo display('purchase_order_expiration_date') ?>
                                        :<?php echo html_escape($expire_date) ?>
                                    </div>
                                    <div class="m-b-15">
                                        <?php echo display('date_of_supply') ?> :<?php echo html_escape($supply_date) ?>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive m-b-20">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            
                                            <th><?php echo display('sl') ?></th>
                                             <th><?php echo display('product_name') ?></th>
                                            <th><?php echo display('item_code') ?></th>
                                            <th><?php echo display('item_picture') ?></th>
                                           
                                            <th><?php echo display('size') ?></th>
<!--                                            <th><?php echo display('unit') ?></th>-->
<!--                                            <th><?php echo display('batch_no') ?></th>-->
                                            <th><?php echo display('quantity') ?></th>
                                            <th><?php echo display('price') ?></th>
<!--                                            <th><?php echo display('discount') ?></th>
                                            <th><?php echo display('vat_rate') ?></th>
                                            <th><?php echo display('vat_value') ?></th>-->
                                            <th><?php echo display('total_value') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $grand_total = 0;
                                        if (!empty($po_details)) {
                                            $total_quantity = $total_without_discount = $grand_total_without_discount = $item_total_discount = $total_discount = $total_vat = 0;
                                            $i = 1;
                                            foreach ($po_details as $invoice) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                              <td><strong><?php echo html_escape($invoice['product_name']); ?></strong>
                                            </td>
                                            <td><?php echo html_escape($invoice['product_model']); ?></td>
                                            <td><img src="<?php echo  base_url() . (!empty(html_escape($invoice['image_thumb'])) ? $invoice['image_thumb'] : 'assets/img/icons/default.jpg') ?>"
                                                    width="50" height="50"></td>
                                          
                                            <td>
                                                <?php
                                                        echo html_escape($invoice['variant_name']);
                                                        if (!empty($invoice['variant_color'])) {
                                                            $cvarinfo = $this->db->select('variant_name')->from('variant')->where('variant_id', $invoice['variant_color'])->get()->row();
                                                            if (!empty($cvarinfo)) {
                                                                echo ', ' . $cvarinfo->variant_name;
                                                            }
                                                        }
                                                        ?>
                                            </td>
<!--                                            <td><?php echo html_escape($invoice['unit_name']); ?></td>-->
<!--                                            <td><?php echo html_escape($invoice['batch_no']); ?></td>-->
                                            <td><?php $total_quantity += $invoice['quantity'];
                                                        echo html_escape($invoice['quantity']); ?>
                                            </td>
                                            <td><?php $total_without_discount += ($invoice['quantity'] * $invoice['rate']);
                                                        echo (($position == 0) ? $currency . " " . $invoice['rate'] : $invoice['rate'] . " " . $currency); ?>
                                            </td>
<!--                                            <td><?php $item_total_discount = (($invoice['quantity'] * $invoice['rate'] * $invoice['discount']) / 100);
                                                        echo html_escape($invoice['discount']) . ' %'; ?>
                                            </td>
                                            <td><?php echo html_escape($invoice['vat_rate']) . '%'; ?></td>
                                            <td>
                                                <?php
                                                        if (!empty($invoice['vat_rate'])) {
                                                            $vat_value = (($invoice['rate'] * $invoice['quantity'] * $invoice['vat_rate']) / 100);
                                                        } else {
                                                            $vat_value = 0;
                                                        }
                                                        echo (($position == 0) ? $currency . " " . $vat_value : $vat_value . " " . $currency);
                                                        ?>
                                            </td>-->
                                            <td>
                                                <?php
                                                        $pur_total_amount = $vat_value + $invoice['total_amount'];
                                                        echo (($position == 0) ? $currency . " " . ($pur_total_amount) : ($pur_total_amount) . " " . $currency);
                                                        $grand_total += $pur_total_amount;
                                                        ?>
                                            </td>
                                        </tr>
                                        <?php
                                                $grand_total_without_discount = +$total_without_discount;
                                                $total_discount += $item_total_discount;
                                                $total_vat += $vat_value;
                                                $total_discount2=$total_purchase_dis;
                                                ?>
                                        <?php }
                                        } ?>
                                        <tr>
                                            <th class="text-right" colspan="7">Total number of items :</th>
                                            <td><?php echo html_escape($total_quantity); ?></td>
                                            <td colspan="5"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="width_70p ft_left">
                                    </div>
                                    <div class="width_30p ft_right">
                                        <table class="table">
                                            <tr>
                                                <th class="grand_total">Total price before Discount : </th>
                                                <td>
                                                    <?php echo (($position == 0) ? $currency . " " . $grand_total_without_discount : $grand_total_without_discount . " " . $currency); ?>
                                                </td>
                                            </tr>
<!--                                            <tr>
                                                <th class="grand_total"> Discount For Items: </th>
                                                <td>
                                                    <?php echo (($position == 0) ? $currency . " " . $total_discount : $total_discount . " " . $currency); ?>
                                                </td>
                                            </tr>-->
                                            <tr>
                                                <th class="grand_total"> Discount For Purchase : </th>
                                                <td>
                                                    <?php echo (($position == 0) ? $currency . " " . $total_discount2 : $total_discount2 . " " . $currency); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="invoice_discount">Total price After Discount : </th>
                                                <td class="invoice_discount">
                                                    <?php $after_discount = ($grand_total_without_discount - $total_discount-$total_discount2);
                                                    echo (($position == 0) ? $currency . " " . $after_discount : $after_discount . " " . $currency) ?>
                                                </td>
                                            </tr>
<!--                                            <tr>
                                                <th class="total_cgst">The total VAT Value :</th>
                                                <td class="total_cgst">
                                                    <?php echo (($position == 0) ? $currency . " " . $total_vat : $total_vat . " " . $currency); ?>
                                                </td>
                                            </tr>-->
                                            <tr>
                                                <th class="grand_total">Total:</th>
                                                <td class="grand_total">
                                                    <?php echo (($position == 0) ? $currency . " " . ($after_discount + $total_vat) : ($after_discount + $total_vat) . " " . $currency) ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 50px  0px 0px; ">
                                <div class="col-sm-12">
                                    <table class="table">
                                        <thead>
                                            <th class="text-left" style="width: 50%">
                                                <strong style="border-top:1px solid #ddd">Invoice entry according to the
                                                    user </strong>
                                            </th>
                                            <th class="text-right" style="width: 50%">
                                                <strong style="border-top:1px solid #ddd">Signature of the references
                                                </strong>
                                            </th>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-left">
                        <?php if ($this->permission->check_label('manage_sale')->read()->access()) { ?>
                        <a class="btn btn-danger"
                            href="<?php echo base_url('dashboard/Cinvoice/manage_invoice'); ?>"><?php echo display('cancel') ?></a>
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