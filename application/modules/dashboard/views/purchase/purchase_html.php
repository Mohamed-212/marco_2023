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
                        <link href="<?php echo MOD_URL . 'dashboard/assets/css/print.css'; ?>" rel="stylesheet" type="text/css" />
                        <style type="text/css">
                            @media print {
                                .panel-body {
                                    font-size: 10px;
                                }

                                .r_cominfo_div {
                                    display: inline-block;
                                    width: 60%;
                                }

                                .cus_div {
                                    display: inline-block;
                                    margin-left: 2px;
                                    width: 30%;
                                }

                                .width_30p {
                                    width: 30%;
                                }

                                .width_70p {
                                    width: 70%;
                                }
                            }
                        </style>
                        <style type="text/css">
                            * {
                                font-family: 'Roboto', sans-serif;
                            }

                            table {
                                width: 100%
                            }

                            @media print {
                                table tbody tr:nth-child(even) td {
                                    background-color: #f9f9f9 !important;
                                    -webkit-print-color-adjust: exact;
                                }

                                .panel-body {
                                    font-size: 10px;
                                }

                                img:not(.show) {
                                    display: none;
                                }

                                .content-header,
                                .logo,
                                .panel-footer,
                                .main-header,
                                .main-sidebar {
                                    display: none;
                                }

                                .cominfo_div {
                                    display: inline-block;
                                    width: 30%;
                                }

                                .cus_div {
                                    display: inline-block;
                                    margin-left: 4%;
                                    width: 25%;
                                    margin-top: 6%
                                }

                                .qr_div {
                                    display: width: 10%;
                                }

                                .width_30p {
                                    width: 30%;
                                }

                                .width_70p {
                                    width: 70%;
                                }

                                .thead tr,
                                .borderd,
                                .borderd th,
                                .borderd td {
                                    border: 2px solid orange !important;
                                    color: orange !important;
                                }

                                .colored>tbody>tr>th,
                                .colored>tbody>tr>td {
                                    border-top: 1px solid orange;
                                    border-color: orange !important;
                                    color: orange !important;
                                }

                                .line-height {
                                    line-height: .5rem !important;
                                }

                                #toTop,
                                footer,
                                .btn.back-top,
                                .hide-me,
                                .pace,
                                .pace-activity {
                                    display: none;
                                }

                                div.divFooter {
                                    position: fixed;
                                    bottom: 0;
                                }

                                .empty-footer {
                                    height: 100px
                                }

                                .footerr {
                                    position: fixed;
                                    height: 100px;
                                }

                                .footerr {
                                    bottom: 35px;
                                }
                            }

                            .thead tr,
                            .borderd,
                            .borderd th,
                            .borderd td {
                                border: 2px solid orange !important;
                                color: orange !important;
                            }

                            .thead tr th {
                                color: orange !important;
                            }

                            .colored>tbody>tr>th,
                            .colored>tbody>tr>td {
                                border-top: 1px solid orange;
                                border-color: orange !important;
                                color: orange !important;
                            }

                            .thead tr th {
                                text-transform: uppercase;
                            }

                            .line-height {
                                line-height: 1rem;
                            }
                        </style>
                        <div class="panel-body mt-0 pt-0" style="padding: 0">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="content" style="padding: 0 15px 10px;">
                                                <div class="row">
                                                    <div class="col-sm-12 p-0" style="background-image: url();">
                                                        <img class="show" src="<?= base_url() ?>/assets/img/header.png" style="width: 100%;height: auto;" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table style="width: 100%">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <!-- <div class="col-sm-12 r_cominfo_div"> -->
                                                                            <!-- <img src="<?php if (isset($Soft_settings[0]['invoice_logo'])) {
                                                                                            echo base_url() . $Soft_settings[0]['invoice_logo'];
                                                                                        } ?>" class="img img-responsive inv_logo" alt="logo">
                                                                            <br> -->
                                                                            <span class="label label-success-outline m-r-15 p-10"><?php echo display('billing_from') ?></span>
                                                                            <address class="mt_10">
                                                                                <strong>
                                                                                    <?php echo html_escape($company_info[0]['company_name']); ?></strong><br>
                                                                                <div>
                                                                                    <?php echo display('address') ?>:
                                                                                    <?php echo html_escape($company_info[0]['address']); ?></div>

                                                                                <div>
                                                                                    <abbr>
                                                                                        <?php echo display('mobile') ?>:
                                                                                        <?php echo html_escape($company_info[0]['mobile']); ?>
                                                                                    </abbr>
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
                                                                        <!-- </div> -->
                                                                    </td>
                                                                    <td style="float: right;">
                                                                        <!-- <div class="col-sm-12 text-left cus_div"> -->
                                                                            <h2 class="m-t-0"><?php echo display('invoice') ?></h2>
                                                                            <div>
                                                                                <?php echo display('invoice_no') ?> : <?php echo html_escape($invoice); ?>
                                                                            </div>
                                                                            <div>
                                                                                <?php echo display('supplier_invoice_no') ?> :
                                                                                <?php echo html_escape($invoice_no); ?>
                                                                            </div>
                                                                            <div>
                                                                                <?php echo display('supplier_name') ?>:
                                                                                <?php echo html_escape($supplier_name); ?>
                                                                            </div>
                                                                            <div>
                                                                                <?php echo display('vat_for_supplier') ?> :<?php echo html_escape($vat_no) ?>
                                                                            </div>
                                                                             <div>
                                                                                <?php echo display('invoice_creation_date') ?>
                                                                                :<?php echo html_escape($purchase_date); ?>
                                                                            </div>
<!--                                                                            <div>-->
<!--                                                                                --><?php //echo display('invoice_creation_date') ?>
<!--                                                                                :--><?php //echo html_escape(date('d-m-Y', strtotime($created_date))) ?>
<!--                                                                            </div>-->
                                                                            <!-- <div class="m-b-15">
                                                                                <?php echo display('invoice_time') ?> :<?php echo html_escape($created_time) ?>
                                                                            </div> -->
                                                                        <!-- </div> -->
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>

                                                <div class="table-responsive m-b-20">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr class="borderd">
                                                                <th><?php echo display('sl') ?></th>
                                                                <th><?php echo display('product_name') ?></th>
                                                                <th><?php echo display('item_code') ?></th>
                                                                <th class="hide-me"><?php echo display('item_picture') ?></th>
                                                                <th><?php echo display('size') ?></th>
                                                                <!-- <th><?php echo display('unit') ?></th> -->
                                                                <!-- <th><?php echo display('batch_no') ?></th> -->
                                                                <th><?php echo display('quantity') ?></th>
                                                                <th><?php echo display('price') ?></th>
                                                                <!--                                            <th><?php echo display('discount') ?></th>
                                            <th><?php echo display('vat_rate') ?></th>
                                            <th><?php echo display('vat_value') ?></th>-->
                                                                <!--                                            <th><?php echo display('cost_price_per_unit') ?></th>-->
                                                                <th><?php echo display('total_value') ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if (!empty($purchase_all_data)) {
                                                                $all_quantity = $total_quantity = $total_without_discount = $grand_total_without_discount = $item_total_discount = $total_discount = $total_vat = 0;
                                                                foreach ($purchase_all_data as $key => $purch) {
                                                                    $all_quantity += $purch['quantity'];
                                                                }
                                                                foreach ($purchase_all_data as $key => $purchase) {
                                                            ?>
                                                                    <tr>
                                                                        <td><?php echo $key + 1; ?></td>
                                                                        <td><strong><?php echo html_escape($purchase['product_name']); ?></strong>
                                                                        </td>
                                                                        <td><?php echo html_escape($purchase['product_model']); ?></td>
                                                                        <td class="hide-me"><img src="<?php echo  base_url() . (!empty(html_escape($purchase['image_thumb'])) ? html_escape($purchase['image_thumb']) : 'assets/img/icons/default.jpg') ?>" width="50" height="50"></td>

                                                                        <td><?php echo html_escape($purchase['variant_name']); ?></td>
                                                                        <!-- <td><?php echo html_escape($purchase['unit_short_name']); ?></td> -->
                                                                        <!-- <td><?php echo html_escape($purchase['batch_no']); ?></td> -->
                                                                        <td><?php $total_quantity += $purchase['quantity'];
                                                                            echo html_escape($purchase['quantity']); ?>
                                                                        </td>
                                                                        <td><?php $total_without_discount += ($purchase['quantity'] * $purchase['rate']);
                                                                            echo (($position == 0) ? $currency . " " . $purchase['rate'] : $purchase['rate'] . " " . $currency); ?>
                                                                        </td>
                                                                        <!--                                            <td><?php $item_total_discount = (($purchase['quantity'] * $purchase['rate'] * $purchase['discount']) / 100);
                                                                                                                            echo html_escape($purchase['discount']) . ' %'; ?>
                                            </td>
                                            <td><?php echo html_escape(!empty($purchase['vat_rate']) ? $purchase['vat_rate'] : 0) . ' %'; ?>
                                            </td>
                                            <td>
                                                <?php
                                                                    echo (($position == 0) ? $currency . " " . html_escape(!empty($purchase['vat']) ? $purchase['vat'] : 0) : html_escape(!empty($purchase['vat']) ? $purchase['vat'] : 0) . " " . $currency);
                                                ?>
                                            </td>-->
                                                                        <!--                                            <td>
                                                <?php
                                                                    // $item_cost = ($purchase_all_data[0]['purchase_expences'] / $all_quantity);
                                                                    // echo (($position == 0) ? $currency . " " . number_format($item_cost, 2, '.', '') : number_format($item_cost, 2, '.', '') . " " . $currency);
                                                ?>
                                            </td>-->
                                                                        <td>
                                                                            <?php
                                                                            $total_value = $purchase['total_amount'];
                                                                            echo (($position == 0) ? $currency . " " . $total_value : $total_value . " " . $currency);
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                    $grand_total_without_discount = +$total_without_discount;
                                                                    $total_discount += $item_total_discount;
                                                                    $total_vat += $purchase['vat'];
                                                                    $total_purchase_dis = $total_purchase_dis;
                                                                    ?>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th class="text-right" colspan="7">Total number of items :</th>
                                                                <td><?php echo html_escape($total_quantity); ?></td>
                                                                <!-- <td colspan="5"></td> -->
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="width_70p ft_left">
                                                            <?php if (!empty($purchase_expense_detail)) { ?>
                                                                <table class="table table-bordered table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Expense name</th>
                                                                            <th>Expense value</th>
                                                                            <th>Method of Payment</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="addPurchaseCost">
                                                                        <?php
                                                                        foreach ($purchase_expense_detail as $key => $purchase_expense) {
                                                                        ?>
                                                                            <tr>
                                                                                <th class="text-left">
                                                                                    <?php echo html_escape($purchase_expense->expense_title) ?>
                                                                                </th>
                                                                                <td class="text-left">
                                                                                    <?php echo html_escape($purchase_expense->purchase_expense) ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?php
                                                                                    if ($purchase_expense->payment_method == 'cash') {
                                                                                        echo 'Cash';
                                                                                    } else {
                                                                                        $bank_info = $this->db->select('bank_name')->from('bank_list')->where('bank_id', $purchase_expense->payment_method)->get()->row();
                                                                                        echo html_escape($bank_info->bank_name);
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                            </tr>
                                                                        <?php }  ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <th class="text-left">Total</th>
                                                                            <td class="text-left">
                                                                                <strong><?php echo html_escape($purchase_all_data[0]['purchase_expences']) ?></strong>
                                                                            </td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="width_30p ft_right">
                                                            <table class="table">
                                                                <tr class="borderd">
                                                                    <th class="grand_total">Total price before Discount : </th>
                                                                    <td>
                                                                        <?php echo (($position == 0) ? $currency . " " . $grand_total_without_discount : $grand_total_without_discount . " " . $currency); ?>
                                                                    </td>
                                                                </tr>
                                                                <!--                                            <tr>
                                                <th class="grand_total"> Discount For Items : </th>
                                                <td>
                                                    <?php echo (($position == 0) ? $currency . " " . $total_discount : $total_discount . " " . $currency); ?>
                                                </td>
                                            </tr>-->
                                                                <tr class="borderd">
                                                                    <th class="grand_total"> Discount For Purchase : </th>
                                                                    <td>
                                                                        <?php echo (($position == 0) ? $currency . " " . $total_purchase_dis : $total_purchase_dis . " " . $currency); ?>
                                                                    </td>
                                                                </tr>
                                                                <tr class="borderd">
                                                                    <th class="invoice_discount">Total price After Discount : </th>
                                                                    <td class="invoice_discount">
                                                                        <?php $after_discount = ($grand_total_without_discount - $total_discount - $total_purchase_dis);
                                                                        echo (($position == 0) ? $currency . " " . $after_discount : $after_discount . " " . $currency) ?>
                                                                    </td>
                                                                </tr>
                                                                <!--                                            <tr>
                                                <th class="total_cgst">The total value of the tax:</th>
                                                <td class="total_cgst">
                                                    <?php echo (($position == 0) ? $currency . " " . $total_vat : $total_vat . " " . $currency); ?>
                                                </td>
                                            </tr>-->
                                                                <tr class="borderd">
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
                                                                    <strong style="border-top:1px solid #ddd">Buyer's signature</strong>
                                                                </th>

                                                                <th class="text-right" style="width: 50%">
                                                                    <strong style="border-top:1px solid #ddd">Seller's signature</strong>
                                                                </th>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <div class="empty-footer"></div>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="footerr row position-relative">
                                <div class="col-xs-12 divFoote" style="background-image: url();">
                                    <img class="show" src="<?= base_url() ?>/assets/img/footer.png" style="width: 100%;height: auto;" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer text-left">

                        <a class="btn btn-danger" href="<?php echo base_url('dashboard/Cpurchase/manage_purchase'); ?>"><?php echo display('back') ?></a>

                        <a class="btn btn-info" href="<?php echo current_url(); ?>" onclick="printPageDiv('printableArea')"><span class="fa fa-print"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->