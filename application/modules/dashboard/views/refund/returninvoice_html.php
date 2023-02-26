<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script src="<?php echo MOD_URL . 'dashboard/assets/js/print.js'; ?>"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display(isset($is_order) ? 'order_details' : 'invoice_details') ?></h1>
            <small><?php echo display(isset($is_order) ? 'order_details' : 'invoice_details') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display(isset($is_order) ? 'order' : 'invoice') ?></a></li>
                <li class="active"><?php echo display(isset($is_order) ? 'order_details' : 'invoice_details') ?></li>
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
                            * {
                                font-family: 'Roboto', sans-serif;
                            }
                            table{
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
                                .borderd {
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
                                .pace, .pace-activity {
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
                            .borderd {
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
                                                    <!-- <div class="col-sm-6 cominfo_div" style="float: left;">
                                    <img src="<?php if (isset($Soft_settings[0]['invoice_logo'])) {
                                                    echo base_url() . $Soft_settings[0]['invoice_logo'];
                                                } ?>" class="img img-responsive inv_logo" alt="logo">
                                    <br>
                                    <span
                                            class="label label-success-outline m-r-15 p-10"><?php echo display('billing_from') ?></span>
                                    <address class="mt_10">
                                        <strong>
                                            <?php echo html_escape($company_info[0]['company_name']); ?></strong><br>
                                        <div><?php echo html_escape($company_info[0]['address']); ?> :
                                            <?php echo display('address') ?></div>
                                        <div><abbr><?php echo display('mobile'); ?> :
                                                <?php echo html_escape($company_info[0]['mobile']); ?></abbr></div>
                                        <div><abbr><?php echo display('email') ?> :
                                            </abbr><?php echo html_escape($company_info[0]['email']); ?></div>
                                        <div><abbr><?php echo display('website') ?> :
                                            </abbr><?php echo html_escape($company_info[0]['website']); ?></div>
                                        <div>
                                            <abbr><?php echo display('payment_status') ?>:</abbr>
                                            <span
                                                    class="<?php echo (($total_amount == $paid_amount) ? 'text-success' : 'text-danger'); ?>">
                                                <?php echo (($total_amount == $paid_amount) ? '<strong>Paid </strong>' : '<strong>Due</strong>'); ?>
                                            </span>
                                        </div>
                                        <div>
                                            <?php $store = $this->db->select('store_name')->from('store_set')->where('store_id', $store_id)->get()->row(); ?>
                                            <abbr><?php echo display('branch') ?>:</abbr>
                                            <?php echo html_escape(@$store->store_name); ?>
                                        </div>
                                        <?php
                                        $company_vat = $this->db->select('vat_no')->from('company_information')->where('status', 1)->get()->row();
                                        if (!empty($company_vat)) {
                                        ?>
                                            <div>
                                                <abbr><?php echo display('our_vat_no') ?>
                                                    :</abbr><?php echo html_escape($company_vat->vat_no); ?>
                                            </div>
                                            <?php
                                        }
                                            ?>
                                    </address>
                                </div>

                                <div class="col-sm-3 qr_div" style="float: left;">
                                    <?php
                                    $base_encoded = base64_encode($company_info[0]['company_name'] . '  ' . $company_vat->vat_no . '  ' . $invoice_all_data[0]['created_at'] . '  ' . $total_amount . '  ' . $invoice_all_data[0]['total_vat']);
                                    ?>
                                    <?php
                                    $checkQr = $this->db->select("isActive")->from("captcha_print_setting")->get()->row();
                                    if (@$checkQr->isActive == 1) {
                                    ?>
                                        <img src="https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=<?php echo $base_encoded; ?>"
                                             alt="Invoice QR code">
                                    <?php } ?>
                                    <h3 class="text-center"> <?php
                                                                if ($isTaxed == 1) {
                                                                    echo display('tax_invoice');
                                                                } else {
                                                                    echo display('not_tax_invoice');
                                                                }
                                                                ?> </h3>
                                </div>
                                <div class="col-sm-2 text-left cus_div" style="float: right; ">
                                    <h4 class="m-t-0">
                                        <?php if ($total_amount == $paid_amount) { ?>
                                            <span class="label label-success-outline "><?php echo display('paid') ?></span>
                                        <?php } elseif (($paid_amount > 0) && ($paid_amount < $total_amount)) { ?>
                                            <span
                                                    class="label label-warning-outline"><?php echo display('partial_paid') ?></span>
                                        <?php } elseif ($paid_amount == 0) {
                                        ?>
                                            <span class="label label-danger-outline"><?php echo display('unpaid') ?></span>
                                        <?php } ?>
                                    </h4>
                                    <h2 class="m-t-0" style="margin-bottom: 0px;"><?php echo display('invoice') ?></h2>
                                    <br>
                                    <div>
                                        <?php echo display('invoice_no') ?> : <?php echo html_escape($invoice_no); ?>
                                    </div>

                                    <div>
                                        <?php echo display('order_no') ?> :
                                        <?php echo (!empty($order_no['0']->order_no)) ? $order_no['0']->order_no : 'N/A' ?>
                                    </div>
                                    <div>
                                        <?php echo display('quotation_no') ?> :
                                        <?php echo (!empty($quotation_no['0']->quotation_no)) ? $quotation_no['0']->quotation_no : 'N/A' ?>
                                    </div>
                                    <div>
                                        <?php echo display('invoice_date') ?> :<?php echo html_escape($final_date) ?>
                                    </div>
                                    <div class="m-b-15">
                                        <?php echo display('invoice_time') ?> :<?php echo html_escape($invoice_time) ?>
                                    </div>
                                    <span
                                            class="label label-success-outline m-r-15"><?php echo display('billing_to') ?></span>
                                    <?php if (!strcmp($customer_mobile, $ship_customer_mobile)) { ?>
                                        <address class="mt_10">
                                            <strong>
                                                <?php echo display('customer_name') ?>
                                                :<?php echo html_escape($customer_name); ?>
                                            </strong>
                                            <br>
                                            <abbr><?php echo display('address') ?> :</abbr>
                                            <?php if ($customer_address) { ?>
                                                <c class="ctext"><?php echo html_escape($customer_address) ?></c>
                                            <?php } ?><br>
                                            <abbr lang="ar"
                                                  dir="rtl"><?php if ($customer_mobile) { ?><?php echo html_escape($customer_mobile) ?><?php } ?>
                                                :<?php echo display('mobile') ?></abbr>

                                            <?php if ($customer_email) { ?>
                                                <br>
                                                <abbr><?php echo display('email') ?> :</abbr>
                                                <?php echo html_escape($customer_email); ?>
                                            <?php } ?>
                                            <?php if ($vat_no) { ?>
                                                <br>
                                                <abbr><?php echo display('vat_for_customer') ?>:</abbr>
                                                <?php echo html_escape($vat_no); ?>
                                            <?php } ?>

                                        </address>
                                    <?php } else { ?>
                                        <address class="mt_10">
                                            <strong><?php echo html_escape($ship_customer_name) ?> </strong><br>
                                            <abbr><?php echo display('address') ?>:</abbr>
                                            <?php if ($ship_customer_short_address) { ?>
                                                <c class="ctext">
                                                    <?php echo html_escape($ship_customer_short_address); ?>
                                                </c>
                                            <?php } ?><br>
                                            <abbr><?php echo display('mobile') ?> :
                                                <?php if ($ship_customer_mobile) { ?>{ship_customer_mobile}<?php } ?></abbr>
                                            <?php if ($ship_customer_email) { ?>
                                                <br>
                                                <abbr><?php echo display('email') ?>
                                                :</abbr><?php echo html_escape($ship_customer_email); ?>
                                            <?php } ?>
                                        </address>
                                    <?php } ?>
                                </div> -->
                                                    <div class="col-xs-12 p-0" style="background-image: url();">
                                                        <img class="show" src="<?= base_url() ?>/assets/img/header.png" style="width: 100%;height: auto;" />
                                                    </div>
                                                </div>
                                                <div style="padding: 0 25px;">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <h3><?php echo display('invoice_to'); ?> : <?php echo html_escape($customer['customer_name']); ?></h3>
                                                            <div class="line-height" style=" margin-top: 15px;">
                                                                <p>
                                                                    <?php echo display('client_code'); ?>  : <?php echo html_escape($customer['customer_id']); ?>
                                                                </p>
                                                                <p>
                                                                    <?php echo display('client_phone'); ?>  : <?php echo html_escape($customer['customer_mobile']) ?>
                                                                </p>
                                                                <p>
                                                                    <?php echo display('client_address'); ?>  : <?php echo html_escape($customer['customer_address_1']) ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-2 mt_20" style="margin-top: 30px;">
                                                            <div class="line-height" style="">
                                                                <h3 class="text-center borderd"> <?php
                                                               
                                                                        echo display('return');
                                                             
                                                                    ?> </h3>
                                                            </div>

                                                        </div>
                                                        <div class="col-xs-5 mt_20" style="margin-top: 30px;">
                                                            <div class="line-height" style="">
                                                                <p>
                                                                    <?php echo display('sl'); ?> : <?php echo 'SalRe-' . html_escape($sl); ?>&nbsp;(<?php
                                                        $cl = $this->db->select('voucher, c_id')->from('customer_ledger')->where('Vno', $invoice_return[0]['return_invoice_id'])->get()->row();
                                                    ?>
                                                            <?php echo $cl->voucher . ' / ' . $cl->c_id; ?> )
                                                                </p>
                                                                <p>
                                                                    <?php echo display('date'); ?> : <?php echo html_escape($createdate) ?>
                                                                </p>
                                                                <p>
                                                                   <?php echo display('employee'); ?> : <?= $receive_by ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="table-responsive m-b-20" style="margin-top: 10px;">
                                                        <table class="table table-striped">
                                                            <thead class="thead">
                                                                <tr>
                                                                    <th><?php echo display('sl') ?></th>
                                                                    <th><?php echo display('product_name') ?></th>
                                                                     <th><?php echo display('quantity') ?></th>
                                                                    <th><?php echo display('price') ?></th>                                                                   
                                                                    <th><?php echo display('customer_price') ?></th>
                                                                    <th><?php echo display('total_value') ?></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                        $return_qnty=0;
                                                                        $total=0;
                                                                        $total_discount=0;
                                                                    ?>
                                                            <?php for($i=0;$i<count($invoice_return);$i++){ ?>
                                                                        <tr>
                                                                            <td><?php echo html_escape($i+1); ?></td>
                                                                            <td>
                                                                                <strong><?php echo html_escape($product[$i]['product_name']); ?> </strong><br>
                                                                            </td>
                                                                            <td><?php echo html_escape($invoice_return[$i]['return_quantity']);?></td>
                                                                            <td><?php echo html_escape($invoice_return[$i]['rate']); ?></td>
                                                                            <td><?php echo html_escape($customer_price[$i]['product_price']); ?></td>
                                                                            <td><?php echo html_escape($invoice_return[$i]['rate']*$invoice_return[$i]['return_quantity']); ?></td>
                                                                                                                             
                                                                        </tr>
                                                                    <?php
                                                                        $return_qnty+=$invoice_return[$i]['return_quantity'];
                                                                        $total+=$invoice_return[$i]['total_return'];
                                                                        $total_discount+=$invoice_return[$i]['total_discount'];
                                                                    ?>
                                                            <?php }?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="row">
                                                        <div style="text-align:center;">
                                                            <p><?php echo display('total_qnty'); ?> : <?php echo html_escape($return_qnty); ?></p>
                                                           
                                                                <p>
                                                                    <?php echo '('.display('Do_not_approve_any_payment_except_through_a_receipt_voucher').')'; ?> 
                                                                </p>
                                                                <p>
                                                                    <?php echo '('.display('The_product_cannot_be_exchanged_or_returned within_a_week_of_receiving_the_invoice').')'; ?> 
                                                                </p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="row" style="break-inside: avoid;">
                                                        <div class="col-sm-12">
                                                           <table style="width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                <?php for($tr = 0; $tr < 6; $tr++) :?>
                                                                        <th>.</th>
                                                                    <?php endfor; ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <?php for($tr = 0; $tr < 6; $tr++) :?>
                                                                        <td></td>
                                                                    <?php endfor; ?>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5">
                                                                    <div class="width_70p ft_left">
                                                                <?php if (!empty($cardpayments)) { ?>
                                                                    <div class="col-sm-7">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered">
                                                                                <tr class="info">
                                                                                    <th><?php echo display('card_type'); ?></th>
                                                                                    <th><?php echo display('card_no'); ?></th>
                                                                                    <th><?php echo display('pay_amount'); ?></th>
                                                                                </tr>
                                                                                <?php foreach ($cardpayments as $payitem) { ?>
                                                                                    <tr>
                                                                                        <td><?php echo html_escape($payitem['card_type']); ?></td>
                                                                                        <td><?php echo html_escape($payitem['card_no']); ?></td>
                                                                                        <td><?php echo html_escape($payitem['amount']); ?></td>
                                                                                    </tr>
                                                                                <?php } ?>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                                <div>
                                                                    <p><strong><?php echo htmlspecialchars_decode($invoice_details) ?></strong>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="width_30p ft_left">

                                                                <table class="table colored">
                                                                    <tr>
                                                                        <th class="grand_total"> <?php echo display('total') ?>:</th>
                                                                        <td>
                                                                            <?php echo ($total); ?>
                                                                        </td>
                                                                    </tr>

                                                                  
                                                                        <tr>
                                                                            <th class="grand_total"> <?php echo display('total_discount') ?>:</th>
                                                                            <td>
                                                                                <?php echo ($total_discount); ?>
                                                                            </td>
                                                                        </tr>
                                                                    <tr class="borderd">
                                                                            <th class="grand_total"> <?php echo display('total'); ?>:</th>
                                                                        <td class="grand_total">
                                                                            <?php echo ($total-$total_discount) ?>
                                                                        </td>
                                                                    </tr>
                                                                  
                                                                </table>
                                                            </div>

                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                           </table>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="padding: 50px  0px 0px;break-inside: avoid;">
                                                        <div class="col-sm-12">
                                                            <table class="table">
                                                                <thead>
                                                                    <th class="text-left" style="width: 50%">
                                                                        <strong style="border-top:1px solid #ddd"> <?php echo display('buyer_signature'); ?> </strong>
                                                                    </th>

                                                                    <th class="text-right" style="width: 50%">
                                                                        <strong style="border-top:1px solid #ddd"> <?php echo display('seller_signature'); ?> </strong>
                                                                    </th>
                                                                </thead>
                                                            </table>
                                                        </div>
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
                        <?php if ($this->permission->check_label('manage_sale')->read()->access()) { ?>
                            <a class="btn btn-danger" href="<?php echo base_url(isset($is_order) ? 'dashboard/Corder/manage_order' : 'dashboard/Cinvoice/manage_invoice'); ?>"><?php echo display('back') ?></a>
                        <?php } ?>
                        <a class="btn btn-info" href="<?php echo current_url(); ?>" onclick="printPageDiv('printableArea')"><span class="fa fa-print"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->