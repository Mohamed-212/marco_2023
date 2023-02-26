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
                        <div class="panel-body">
                            <div class="row"
                                style="height:<?php echo (!empty($print_setting->header) ? $print_setting->header : 200) . 'px' ?>">
                            </div>
                            <address>
                                <b class="text-right"><?php echo display('customer_name') . ' : ' . $customer_name ?>
                                </b><br>
                                <b class="pad-print-customername"><?php echo display('invoice_no') . ':' . $invoice_no ?>
                                </b><br>
                                <b class="padprint-date"><?php echo display('date') . ': ' . $final_date ?> </b><br>
                            </address>
                            <table width="100%" class="table table-striped">
                                <thead>
                                    <tr class="pthead">
                                        <th><?php echo display('sl'); ?></th>
                                        <th><?php echo display('product_name'); ?></th>
                                        <th align="center"><?php echo display('unit'); ?></th>
                                        <th align="right"><?php echo display('quantity'); ?></th>
                                        <th align="right"><?php echo display('discount'); ?></th>
                                        <th align="right"><?php echo display('total_discount'); ?></th>
                                        <th align="right"><?php echo display('rate'); ?></th>
                                        <th align="right"><?php echo display('vat') . ' %'; ?></th>
                                        <th align="right"><?php echo display('vat_value'); ?></th>
                                        <th align="right"><?php echo display('amount'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sl = 1;
                                    $s_total = 0;
                                    $i_grand_amount = 0;
                                    foreach ($invoice_all_data as $invoice_data) {
                                    ?>
                                    <tr>
                                        <td align="left">
                                            <nobr><?php echo $sl; ?></nobr>
                                        </td>
                                        <td align="left">
                                            <nobr>
                                                <?php echo html_escape($invoice_data['product_name']) . '(' . html_escape($invoice_data['product_model']) . ')'; ?>
                                            </nobr>
                                        </td>
                                        <td align="left">
                                            <nobr><?php echo html_escape($invoice_data['unit_short_name']); ?></nobr>
                                        </td>
                                        <td align="left">
                                            <nobr><?php echo html_escape($invoice_data['quantity']); ?></nobr>
                                        </td>
                                        <td align="left">
                                            <nobr><?php echo html_escape($invoice_data['discount']); ?></nobr>
                                        </td>
                                        <td align="left">
                                            <nobr>
                                                <?php
                                                    $total_discount = $invoice_data['discount'] * $invoice_data['quantity'];
                                                    echo html_escape((($position == 0) ? $currency . ' ' . $total_discount : $total_discount . ' ' . $currency));
                                                    ?>
                                            </nobr>
                                        </td>
                                        <?php
                                            $tax_id = $this->db->select('tax_id')->from('tax')->where('status', 1)->get()->row();
                                            $tax_rate = $this->db->select('*')->from('tax_product_service')->where('product_id', $invoice_data['product_id'])->where('tax_id', $tax_id->tax_id)->get()->row();
                                            $vat_rate = (!empty($tax_rate->tax_percentage) ? $tax_rate->tax_percentage : 0);
                                            ?>
                                        <td align="left">
                                            <nobr>
                                                <?php
                                                    echo html_escape((($position == 0) ? $currency . ' ' . $invoice_data['rate'] : $invoice_data['rate'] . ' ' . $currency));
                                                    ?>

                                            </nobr>
                                        </td>
                                        <td align="left">
                                            <nobr><?php echo html_escape($vat_rate); ?></nobr>
                                        </td>
                                        <td align="left">
                                            <nobr>
                                                <?php
                                                    $total_vat = (($invoice_data['rate'] - $invoice_data['discount']) * $invoice_data['quantity'] * $vat_rate) / 100;
                                                    echo html_escape((($position == 0) ? $currency . ' ' . $total_vat : $total_vat . ' ' . $currency));
                                                    ?>
                                            </nobr>
                                        </td>
                                        <td align="left">
                                            <nobr>
                                                <?php
                                                    $amount = (($invoice_data['rate'] - $invoice_data['discount']) * $invoice_data['quantity']) + $total_vat;
                                                    echo html_escape((($position == 0) ? $currency . ' ' . $amount : $amount . ' ' . $currency));
                                                    ?>

                                            </nobr>
                                        </td>
                                    </tr>
                                    <?php
                                        $sl++;
                                        $i_total_price    = $invoice_data['quantity'] * ($invoice_data['rate']);
                                        $i_grand_amount   += $i_total_price;
                                    } ?>
                                </tbody>
                                <tfoot>

                                    <tr>
                                        <td align="left">
                                            <nobr></nobr>
                                        </td>
                                        <td align="right" colspan="8"><b><?php echo display('total') ?></b></td>
                                        <td align="left">
                                            <b>
                                                <?php
                                                if ($position == 0) {
                                                    echo  $currency . ' ' . html_escape(number_format($i_grand_amount, 2, '.', ','));
                                                } else {
                                                    echo html_escape(number_format($i_grand_amount, 2, '.', ',')) . ' ' . $currency;
                                                }
                                                ?>
                                            </b>
                                        </td>
                                    </tr>

                                    <?php if ($invoice_discount > 0) { ?>
                                    <tr>
                                        <td align="left">
                                            <nobr></nobr>
                                        </td>
                                        <td align="right" colspan="8"><b><?php echo display('invoice_discount'); ?></b>
                                        </td>
                                        <td align="left">
                                            <b>
                                                <?php echo html_escape((($position == 0) ? $currency . ' ' . $invoice_discount  : $invoice_discount . ' ' . $currency)) ?>
                                            </b>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php if ($total_discount > 0) { ?>
                                    <tr>
                                        <td align="left">
                                            <nobr></nobr>
                                        </td>
                                        <td align="right" colspan="8"><b><?php echo display('total_discount') ?></b>
                                        </td>
                                        <td align="left">
                                            <b>
                                                <?php echo html_escape((($position == 0) ? $currency . ' ' . $total_discount : $total_discount . ' ' . $currency)) ?>
                                            </b>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php if ($total_vat > 0) { ?>
                                    <tr>
                                        <td align="left">
                                            <nobr></nobr>
                                        </td>
                                        <td align="right" colspan="8"><b><?php echo display('total_vat') ?></b></td>
                                        <td align="left">
                                            <b>
                                                <?php echo html_escape((($position == 0) ? $currency . ' ' . $total_vat : $total_vat . ' ' . $currency)) ?>
                                            </b>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php if ($shipping_cost > 0) { ?>
                                    <tr>
                                        <td align="left">
                                            <nobr></nobr>
                                        </td>
                                        <td align="right" colspan="8"><b><?php echo display('shipping_cost') ?></b></td>
                                        <td align="left">
                                            <b>
                                                <?php echo html_escape((($position == 0) ? $currency . ' ' . $shipping_cost : $shipping_cost . ' ' . $currency)) ?>
                                            </b>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td align="left">
                                            <nobr></nobr>
                                        </td>
                                        <td colspan="7">
                                            <span
                                                align="right"><b><?php echo display('in_word') . ' : ' ?></b><?php echo html_escape($am_inword) ?></span>
                                            <?php echo display('taka_only') ?>
                                        </td>
                                        <td align="right">
                                            <strong><?php echo display('grand_total') ?></strong>
                                        </td>

                                        <td align="left">
                                            <nobr>
                                                <strong>
                                                    <?php echo html_escape((($position == 0) ? $currency . ' ' . $total_amount : $total_amount . ' ' . $currency))
                                                    ?>
                                                </strong>
                                            </nobr>
                                        </td>
                                    </tr>
                                    <?php if ($paid_amount > 0) { ?>
                                    <tr>
                                        <td align="left">
                                            <nobr></nobr>
                                        </td>
                                        <td align="right" colspan="8">
                                            <b>
                                                <?php echo display('paid_ammount') ?>
                                            </b>
                                        </td>
                                        <td align="left">
                                            <b>
                                                <?php echo html_escape((($position == 0) ? $currency . ' ' . $paid_amount : $paid_amount . ' ' . $currency)) ?>
                                            </b>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php if ($due_amount > 0) { ?>
                                    <tr>
                                        <td align="left">
                                            <nobr></nobr>
                                        </td>
                                        <td align="right" colspan="8"><b><?php echo display('due') ?></b></td>
                                        <td align="left">
                                            <b><?php echo html_escape((($position == 0) ? $currency . ' ' . $due_amount : $due_amount . ' ' . $currency)) ?></b>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tfoot>
                            </table>
                            <table width="100%" class="table table-striped">

                                <tr>
                                    <td>
                                        <b><?php echo display('sold_by') ?> </b>:
                                        <?php echo html_escape($users_name); ?><br>
                                        Website: <a
                                            href="javascript:void(0)"><?php echo html_escape($company_info[0]['website']) ?></a>
                                    </td>
                                    <td class="text-right" colspan="2">
                                        <div class="sig_div">
                                            <?php echo display('signature') ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div class="row"
                                style="height:<?php echo (!empty($print_setting->footer) ? $print_setting->footer : 100) . 'px' ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-left">
                    <a class="btn btn-danger"
                        href="<?php echo base_url('add_invoice'); ?>"><?php echo display('cancel') ?></a>
                    <a class="btn btn-info" href="#" onclick="printDiv('printableArea')"><span
                            class="fa fa-print"></span></a>
                </div>
            </div>
        </div>
    </section>
</div>