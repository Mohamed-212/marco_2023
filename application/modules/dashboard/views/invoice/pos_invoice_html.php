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

            <div class="col-sm-6">
                <div class="panel panel-bd">
                    <div>
                        <style type="text/css" media="print">
                        body {
                            zoom: 65%;
                        }
                        </style>
                        <link href="<?php echo MOD_URL . 'dashboard/assets/css/print.css'; ?>" rel="stylesheet"
                            type="text/css" />
                        <div class="invoice-wrap" id="printableArea" dir="ltr" lang="ar"
                            style="max-width:272.12598425px;background:#fff;margin-right:auto;margin-left:auto;font-size:14px;color:#5b5b5b">
                            <link href="<?php echo MOD_URL . 'dashboard/assets/css/print.css'; ?>" rel="stylesheet"
                                type="text/css" />
                            <div style="text-align: center; margin-bottom: 10px;">
                                <div style="border: 1px solid #000;font-weight: 700;font-size: 17px;color: #000;">
                                    <?php echo html_escape($company_info[0]['company_name']); ?> </div>
                            </div>

                            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center"
                                style="color: #000;font-size: 11px;margin-bottom: 10px;">

                                <tbody>
                                    <tr>
                                        <th style="text-align: left;">Date</th>
                                        <th style="text-align: center;" dir="ltr" lang="eng">
                                            <?php echo html_escape($final_date) ?> </th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: left;">Invoice No</th>
                                        <th style="text-align: center;" dir="ltr" lang="eng">
                                            <?php echo html_escape($invoice_no); ?></th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: left;">Customer</th>
                                        <th style="text-align: center;"> <?php echo html_escape($customer_name); ?>
                                        </th>
                                    </tr>
                                    <?php if ($customer_mobile) : ?>
                                    <tr>
                                        <th style="text-align: left;">Customer Phone</th>
                                        <th style="text-align: center;"> <?php echo html_escape($customer_mobile); ?>
                                        </th>
                                    </tr>
                                    <?php endif ?>
                                </tbody>
                            </table>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center"
                                style="color: #000;font-size: 11px;border-collapse: collapse;margin-bottom: 10px;">
                                <thead>
                                    <tr>
                                        <th style="background-color: #ccc;border: 1px solid #000;">
                                            <div>Item</div>

                                        </th>
                                        <th style="background-color: #ccc;border: 1px solid #000;">
                                            <div>Qty</div>

                                        </th>
                                        <th style="background-color: #ccc;border: 1px solid #000;">
                                            <div>Batch</div>

                                        </th>
                                        <th style="background-color: #ccc;border: 1px solid #000;">
                                            <div>Price</div>

                                        </th>
                                        <th style="background-color: #ccc;border: 1px solid #000;">
                                            <div>Disc</div>

                                        </th>
                                        <th style="background-color: #ccc;border: 1px solid #000;">
                                            <div>VAT</div>

                                        </th>
                                        <th style="background-color: #ccc;border: 1px solid #000;">
                                            <div>Tot Price</div>

                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="7" style="border: 1px solid #000;">
                                            <div style="position: relative;">
                                                <div
                                                    style="height: 3px;background-color: #000;width: 99%;margin: auto;">
                                                </div>
                                                <div
                                                    style="height: 1px;background-color: #fff;width: 100%;position: absolute;z-index: 9;top: 1px;left: 0;">
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_quantity = $total_return_amount = $i_grand_discount = $i_total_discount_price_amount = $i_total_discount_price = $i_grand_amount = 0;
                                    foreach ($invoice_all_data as $item) {
                                    ?>
                                    <tr>
                                        <th style="border: 1px solid #000;">
                                            <?php echo html_escape($item['product_model']); ?></th>
                                        <th style="border: 1px solid #000;">
                                            <?php echo html_escape($item['quantity']); ?></th>
                                        <th style="border: 1px solid #000;">
                                            <?php echo html_escape($item['batch_no']); ?></th>
                                        <th style="border: 1px solid #000;"><?php echo $item['rate']; ?></th>
                                        <th style="border: 1px solid #000;"><?php echo $item['discount']; ?></th>
                                        <?php
                                            $item_tax = $this->db->select('*')->from('tax_product_service')->where('product_id', $item['product_id'])->where('tax_id', '52C2SKCKGQY6Q9J')->get()->row();
                                            ?>
                                        <th style="border: 1px solid #000;">
                                            <?php
                                                if (!empty($item_tax)) {
                                                    echo (($position == 0) ? $currency . "" . ($item_tax->tax_percentage * ($item['total_price'] - ($item['discount'] * $item['quantity'])) / 100) : ($item_tax->tax_percentage * ($item['total_price'] - ($item['discount'] * $item['quantity'])) / 100) . "" . $currency);
                                                } else {
                                                    echo (($position == 0) ? $currency . " " . 0 : 0 . " " . $currency);
                                                }
                                                ?>
                                        </th>
                                        <th style="border: 1px solid #000;">
                                            <?php echo (($position == 0) ? $currency . '' . $item['total_price'] : $item['total_price'] . '' . $currency) ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="7" style="border: 1px solid #000;">
                                            <?php
                                                $arabic_name = $this->db->select('trans_name')->from('product_translation')->where('language', 'Arabic')->where('product_id', $item['product_id'])->get()->row();
                                                if (!empty($arabic_name->trans_name)) { ?>
                                            <div><?php echo html_escape($arabic_name->trans_name); ?></div>
                                            <?php
                                                }

                                                ?>

                                            <div dir="ltr" lang="eng"><?php echo html_escape($item['product_name']); ?>
                                                - (<?php echo html_escape($item['product_model']); ?>)</div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="7" style="border: 1px solid #000;">
                                            <div style="position: relative;">
                                                <div
                                                    style="height: 3px;background-color: #000;width: 99%;margin: auto;">
                                                </div>
                                                <div
                                                    style="height: 1px;background-color: #fff;width: 100%;position: absolute;z-index: 9;top: 1px;left: 0;">
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <?php
                                        $item['price']    = ($item['rate']);
                                        $i_total_price    = $item['quantity'] * ($item['price']);
                                        $i_total_discount_price = $item['quantity'] * ($item['price'] - $item['discount']);
                                        $i_discount_amount = $item['discount'] * ($item['quantity']);
                                        $i_grand_discount += $i_discount_amount;
                                        $i_total_discount_price_amount += $i_total_discount_price;
                                        $i_grand_amount   += $i_total_price;
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center"
                                style="color: #000;font-size: 11px;margin-bottom: 20px;">
                                <tbody>
                                    <tr>
                                        <th style="text-align: left;padding: 3px 10px 3px 0px">Total Before Discount
                                        </th>
                                        <th style="text-align: center;">
                                            <?php echo (($position == 0) ? $currency . "" . $i_grand_amount : $i_grand_amount . "" . $currency); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: left;padding: 3px 10px 3px 0px">Discount</th>
                                        <th style="text-align: center;">
                                            <?php echo (($position == 0) ? $currency . "" . $invoice_all_data[0]['total_discount'] : $invoice_all_data[0]['total_discount'] . "" . $currency); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: left;padding: 3px 10px 3px 0px">Total with Discount</th>
                                        <th style="text-align: center;">
                                            <?php echo (($position == 0) ? $currency . "" . $i_total_discount_price_amount : $i_total_discount_price_amount . "" . $currency); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <?php $taxAmount = 0; ?>
                                        <?php
                                        $this->db->select('a.*,b.tax_name');
                                        $this->db->from('tax_collection_summary a');
                                        $this->db->join('tax b', 'a.tax_id = b.tax_id');
                                        $this->db->where('a.invoice_id', $invoice_id);
                                        $this->db->where('a.tax_id', 'H5MQN4NXJBSDX4L');
                                        $tax_info = $this->db->get()->row();
                                        if ($tax_info) {
                                            $taxAmount = $tax_info->tax_amount;
                                        }
                                        $this->db->select('a.*,b.tax_name');
                                        $this->db->from('tax_collection_summary a');
                                        $this->db->join('tax b', 'a.tax_id = b.tax_id');
                                        $this->db->where('a.invoice_id', $invoice_id);
                                        $this->db->where('a.tax_id', '52C2SKCKGQY6Q9J');
                                        $tax_info = $this->db->get()->row();
                                        if ($tax_info) {
                                            $taxAmount = $tax_info->tax_amount;
                                        }
                                        $this->db->select('a.*,b.tax_name');
                                        $this->db->from('tax_collection_summary a');
                                        $this->db->join('tax b', 'a.tax_id = b.tax_id');
                                        $this->db->where('a.invoice_id', $invoice_id);
                                        $this->db->where('a.tax_id', '5SN9PRWPN131T4V');
                                        $tax_info = $this->db->get()->row();
                                        if ($tax_info) {
                                            $taxAmount = $tax_info->tax_amount;
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <th style="text-align: left;padding: 3px 10px 3px 0px">VAT Value</th>
                                        <th style="text-align: center;">
                                            <?php echo (($position == 0) ? $currency . "" . $taxAmount : $taxAmount . "" . $currency); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: left;padding: 3px 10px 3px 0px">Total with VAT</th>
                                        <th style="text-align: center;">
                                            <?php echo (($position == 0) ? $currency . "" . $total_amount : $total_amount . "" . $currency) ?>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                            <ul style="font-size: 13px;color: #000;font-weight: 700;padding-right: 15px;">
                                <?php
                                if (!empty($invoice_text_details)) {
                                    foreach ($invoice_text_details as $key => $invoice_text) {

                                ?>
                                <li> <?php echo $invoice_text->invoice_text; ?> </li>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                            <div style="text-align: center;">
                                <?php
                                $company_vat = $this->db->select('vat_no')->from('company_information')->where('status', 1)->get()->row();
                                $base_encoded = base64_encode($company_info[0]['company_name'] . '  ' . $company_vat->vat_no . '  ' . $invoice_all_data[0]['created_at'] . '  ' . $total_amount . '  ' . $invoice_all_data[0]['total_vat']);
                                ?>
                                <?php
                                $checkQr = $this->db->select("isActive")->from("captcha_print_setting")->get()->row();
                                if (@$checkQr->isActive == 1) {
                                ?>
                                <img src="https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=<?php echo $base_encoded; ?>"
                                    alt="Invoice QR code">
                                <?php } ?>
                            </div>
                            <table width="70%" border="0" cellpadding="0" cellspacing="0" align="center"
                                style="color: #000;font-size: 13px;margin-top: 20px;">

                            </table>
                        </div>
                        <input type="hidden" id="pos_place" value="<?php echo @$this->input->get('place', TRUE); ?>">
                        <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
                        <script src="<?php echo MOD_URL . 'dashboard/assets/js/pos_invoice_html_redirect.js'; ?>">
                        </script>
                    </div>

                    <div class="panel-footer text-left">
                        <a class="btn btn-danger"
                            href="<?php echo base_url('dashboard/Cinvoice'); ?>"><?php echo display('cancel') ?></a>
                        <a class="btn btn-info" href="#" onclick="printPageDiv('printableArea')"><span
                                class="fa fa-print"></span></a>
                    </div>
                </div>
            </div>

        </div>
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->