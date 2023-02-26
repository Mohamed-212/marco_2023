<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta charset="utf-8" /> -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sale Invoice</title>
    <!-- Invoice styling -->
    <style>
    body {
        font-family: 'DejaVu Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif !important;
    }

    .text-right {
        text-align: right;
    }

    .text-center {
        text-align: center;
    }
    </style>
</head>

<body>
    <div style="font-size: 10px;">
        <div class="text-center">
            <?php
            $path = base_url(!empty($Soft_settings[0]['invoice_logo']) ? $Soft_settings[0]['invoice_logo'] : "/my-assets/image/no-image.jpg");
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64img = 'data:image/' . $type . ';base64,' . base64_encode($data);
            ?>
            <img src="<?php if (isset($base64img)) {
                            echo $base64img;
                        } ?>" class="img img-responsive inv_logo" alt="logo" style="height: 100px"><br>
            <strong><?php echo ucfirst(html_escape($company_info[0]['company_name'])); ?></strong>
            <hr>
        </div>
        <table width="100%" style="margin: 0 auto;">
            <tr>
                <td>
                    <strong><?php echo display('billing_from') ?></strong><br>
                    <?php echo ucfirst(html_escape($company_info[0]['company_name'])); ?><br>
                    <?php echo display('email') ?>:
                    <?php echo html_escape($company_info[0]['email']); ?><br>
                    <?php echo display('mobile') ?> :
                    <?php echo html_escape($company_info[0]['mobile']); ?><br>
                    <?php echo display('address') ?>: <?php echo html_escape($company_info[0]['address']); ?><br>
                    <?php echo display('website') ?>:
                    <?php echo html_escape($company_info[0]['website']); ?><br>
                    <?php echo display('payment_status_paid_or_not_paid') ?>:
                    <?php echo (($total_amount == $paid_amount) ? '<strong style="color:green">Paid</strong>' : '<strong style="color:red">Due</strong>'); ?><br>
                    <?php $store = $this->db->select('store_name')->from('store_set')->where('store_id', $store_id)->get()->row(); ?>
                    <?php echo display('branch') ?>( الفرع ): <?php echo html_escape($store->store_name); ?><br>
                    <?php
                    $company_vat = $this->db->select('vat_no')->from('company_information')->where('status', 1)->get()->row();
                    if (!empty($company_vat)) {
                    ?>
                    <?php echo display('our_vat_no') ?>: <?php echo html_escape($company_vat->vat_no); ?>
                    <?php
                    }
                    ?>
                </td>
                <td style="text-align: right;">
                    <strong><?php echo display('billing_to') ?></strong><br>
                    <?php if (!strcmp($customer_mobile, $ship_customer_mobile)) { ?>
                    <strong><?php echo display('customer_name') ?> (اسم العميل
                        ):<?php echo html_escape($customer_name); ?></strong><br>
                    <?php if ($customer_address) { ?> <?php echo display('address') ?> (عنوان):
                    <?php echo html_escape($customer_address); ?> <?php } ?><br>
                    <?php if ($customer_mobile) { ?><?php echo display('mobile') ?> (جوال العميل) :
                    <?php echo html_escape($customer_mobile) ?><?php } ?><br>
                    <?php if ($customer_email) {  ?><?php echo display('email') ?> (بريد الالكتروني):
                    <?php echo html_escape($customer_email); ?> <?php } ?><br>
                    <?php if ($vat_no) {  ?><?php echo display('vat_for_customer') ?> (رقم العميل الضريبي ):
                    <?php echo html_escape($vat_no); ?> <?php } ?><br>
                    <?php } else { ?>
                    <strong><?php echo display('customer_name') ?> (اسم العميل ):
                        <?php echo html_escape($ship_customer_name) ?> </strong><br>
                    <?php if ($ship_customer_short_address) { ?> <?php echo display('address') ?> (عنوان):
                    <?php echo html_escape($ship_customer_short_address); ?><?php } ?><br>
                    <?php if ($ship_customer_mobile) { ?> <?php echo display('mobile') ?> (جوال العميل) :
                    {ship_customer_mobile} <?php } ?><br>
                    <?php if ($ship_customer_email) { ?> <?php echo display('email') ?> (بريد الالكتروني):
                    <?php echo html_escape($ship_customer_email); ?><?php } ?>
                    <?php if ($vat_no) {  ?><?php echo display('vat_for_customer') ?> (رقم العميل الضريبي ):
                    <?php echo html_escape($vat_no); ?> <?php } ?><br>
                    <?php } ?>
                    <br>
                    <strong><?php echo display('invoice') ?></strong><br>
                    <?php echo display('invoice_no') ?>: <?php echo html_escape($invoice_no); ?><br>
                    <?php echo display('order_no') ?>:
                    <?php echo (!empty($order_no['0']->order_no)) ? $order_no['0']->order_no : 'N/A' ?><br>
                    <?php echo display('quotation_no') ?>:
                    <?php echo (!empty($quotation_no['0']->quotation_no)) ? $quotation_no['0']->quotation_no : 'N/A' ?><br>
                    <?php echo display('invoice_date') ?> :<?php echo html_escape($final_date) ?><br>
                    <?php echo display('invoice_time') ?><span lang="ar" dir="rtl">(وقت الفاتورة )</span>
                    :<?php echo html_escape($invoice_time) ?><br>
                </td>
            </tr>
        </table>
        <br>
        <table width="100%" style="margin: 0 auto;">
            <thead>

                <tr>
                    <th><?php echo display('sl') ?></th>
                    <th><?php echo display('item_code') ?></th>
                    <th><?php echo display('item_picture') ?></th>
                    <th><?php echo display('product_name') ?></th>
                    <th><?php echo display('variant') ?></th>
                    <th><?php echo display('unit') ?></th>
                    <th><?php echo display('batch_no') ?></th>
                    <th><?php echo display('quantity') ?></th>
                    <th><?php echo display('unit_price_before_VAT') ?></th>
                    <th><?php echo display('discount') ?></th>
                    <th><?php echo display('vat_rate') ?></th>
                    <th><?php echo display('vat_value') ?></th>
                    <th><?php echo display('total_value') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($invoice_all_data)) {
                    $total_quantity = $total_return_amount = $i_grand_discount = $i_total_discount_price_amount = $i_total_discount_price = $i_grand_amount = 0;
                    foreach ($invoice_all_data as $invoice) {

                ?>
                <tr>
                    <td><?php echo html_escape($invoice['sl']); ?></td>
                    <td><?php echo html_escape($invoice['product_id']); ?></td>
                    <?php
                            $path = base_url(!empty($invoice['image_thumb']) ? $invoice['image_thumb'] : "/my-assets/image/no-image.jpg");
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $data = file_get_contents($path);
                            $base64img = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            ?>
                    <td><img src="<?php echo $base64img; ?>" width="50" height="50"></td>
                    <td><strong><?php echo html_escape($invoice['product_name']); ?> -
                            (<?php echo html_escape($invoice['product_model']); ?>)</strong></td>
                    <td><?php echo html_escape($invoice['variant_name']);
                                if (!empty($invoice['variant_color'])) {
                                    $cvarinfo = $this->db->select('variant_name')->from('variant')->where('variant_id', $invoice['variant_color'])->get()->row();
                                    if (!empty($cvarinfo)) {
                                        echo ', ' . $cvarinfo->variant_name;
                                    }
                                }
                                ?>
                    </td>
                    <td><?php echo html_escape($invoice['unit_short_name']); ?></td>
                    <td><?php echo html_escape($invoice['batch_no']); ?></td>
                    <td><?php echo html_escape($invoice['quantity']); ?></td>
                    <td><?php echo (($position == 0) ? $currency . " " . $invoice['rate'] : $invoice['rate'] . " " . $currency) ?>
                    </td>
                    <td><?php echo (($position == 0) ? $currency . " " . $invoice['discount'] : $invoice['discount'] . " " . $currency) ?>
                    </td>
                    <?php
                            $item_tax = $this->db->select('*')->from('tax_product_service')->where('product_id', $invoice['product_id'])->where('tax_id', '52C2SKCKGQY6Q9J')->get()->row();
                            ?>
                    <td><?php if (!empty($item_tax)) {
                                    echo $item_tax->tax_percentage . '%';
                                } else {
                                    echo '0%';
                                } ?></td>

                    <td>
                        <?php
                                if (!empty($item_tax)) {
                                    echo (($position == 0) ? $currency . " " . ($item_tax->tax_percentage * ($invoice['total_price'] - ($invoice['discount'] * $invoice['quantity'])) / 100) : ($item_tax->tax_percentage * ($invoice['total_price'] - ($invoice['discount'] * $invoice['quantity'])) / 100) . " " . $currency);
                                } else {
                                    echo (($position == 0) ? $currency . " " . 0 : 0 . " " . $currency);
                                }
                                ?>
                    </td>

                    <td><?php if (!empty($invoice['total_price'])) {
                                    echo (($position == 0) ? $currency . " " . $invoice['total_price'] : $invoice['total_price'] . " " . $currency);
                                } ?></td>
                </tr>
                <?php
                        $invoice['price'] = ($invoice['rate']);
                        $i_total_price    = $invoice['quantity'] * ($invoice['price']);
                        $i_total_discount_price = $invoice['quantity'] * ($invoice['price'] - $invoice['discount']);
                        $i_discount_amount = $invoice['discount'] * ($invoice['quantity']);
                        $i_grand_discount += $i_discount_amount;
                        $i_total_discount_price_amount += $i_total_discount_price;
                        $i_grand_amount   += $i_total_price;
                        ?>
                <?php }
                } ?>
            </tbody>
        </table>
        <br>
        <div width="100%" style="margin-top: 5%;margin: 0 auto;">
            <table width="30%" style=" float: right; margin-right:0%;">
                <tr>
                    <th style="text-align: right;">Total price before Discount: </th>
                    <td>
                        <?php echo (($position == 0) ? $currency . " " . $i_grand_amount : $i_grand_amount . " " . $currency); ?>
                    </td>
                </tr>

                <?php if ($invoice_all_data[0]['total_discount'] != 0) { ?>
                <tr>
                    <th style="text-align: right;"> Product Discount Value: </th>
                    <td>
                        <?php echo (($position == 0) ? $currency . " " . $invoice_all_data[0]['total_discount'] : $invoice_all_data[0]['total_discount'] . " " . $currency); ?>
                    </td>
                </tr>

                <tr>
                    <th style="text-align: right;">Total price after Discount: </th>
                    <td>
                        <?php echo (($position == 0) ? $currency . " " . $i_total_discount_price_amount : $i_total_discount_price_amount . " " . $currency); ?>
                    </td>
                </tr>
                <?php } else { ?>
                <tr>
                    <th style="text-align: right;"> Discount Value: </th>
                    <td>
                        <?php echo (($position == 0) ? $currency . " " . 0 : 0 . " " . $currency); ?>
                    </td>
                </tr>
                <?php } ?>

                <?php if ($invoice_all_data[0]['invoice_discount'] != 0) { ?>
                <tr>
                    <th style="text-align: right;">Total Product discount:</th>
                    <td><?php echo (($position == 0) ? $currency . " " . $invoice_discount : $invoice_discount . " " . $currency) ?>
                    </td>
                </tr>
                <?php } ?>

                <?php if ($invoice_all_data[0]['service_charge'] != 0) { ?>
                <tr>
                    <th style="text-align: right;"><?php echo display('service_charge') ?>:</th>
                    <td><?php echo (($position == 0) ? "$currency " . " $service_charge" : "$service_charge " . " $currency") ?>
                    </td>
                </tr>
                <?php } ?>


                <?php if ($invoice_all_data[0]['shipping_charge'] != 0) { ?>
                <tr>
                    <th style="text-align: right;"><?php echo display('shipping_charge') ?>:</th>
                    <td><?php echo (($position == 0) ? "$currency " . " $shipping_charge" : "$shipping_charge " . " $currency") ?>
                    </td>
                </tr>
                <?php } ?>

                <?php if (!empty($invoice_all_data[0]['shipping_method'])) { ?>
                <tr>
                    <th style="text-align: right;"><?php echo display('shipping_method') ?>:</th>
                    <td><?php echo html_escape($shipping_method); ?></td>
                </tr>
                <?php } ?>
                <?php $taxAmount = 0; ?>
                <?php
                $this->db->select('a.*,b.tax_name');
                $this->db->from('tax_collection_summary a');
                $this->db->join('tax b', 'a.tax_id = b.tax_id');
                $this->db->where('a.invoice_id', $invoice_id);
                $this->db->where('a.tax_id', 'H5MQN4NXJBSDX4L');
                $tax_info = $this->db->get()->row();
                if ($tax_info) { ?>
                <tr>
                    <th style="text-align: right;">The total value of the tax <span></span>:
                    </th>
                    <td>
                        <?php echo (($position == 0) ? $currency . " " . $tax_info->tax_amount : $tax_info->tax_amount . " " . $currency);
                            $taxAmount = $tax_info->tax_amount; ?>
                    </td>
                </tr>
                <?php }
                $this->db->select('a.*,b.tax_name');
                $this->db->from('tax_collection_summary a');
                $this->db->join('tax b', 'a.tax_id = b.tax_id');
                $this->db->where('a.invoice_id', $invoice_id);
                $this->db->where('a.tax_id', '52C2SKCKGQY6Q9J');
                $tax_info = $this->db->get()->row();
                if ($tax_info) { ?>
                <tr>
                    <th style="text-align: right;">The total value of the tax <span></span>:
                    </th>
                    <td>
                        <?php echo (($position == 0) ? $currency . " " . $tax_info->tax_amount : $tax_info->tax_amount . " " . $currency);
                            $taxAmount = $tax_info->tax_amount; ?>
                    </td>
                </tr>
                <?php }
                $this->db->select('a.*,b.tax_name');
                $this->db->from('tax_collection_summary a');
                $this->db->join('tax b', 'a.tax_id = b.tax_id');
                $this->db->where('a.invoice_id', $invoice_id);
                $this->db->where('a.tax_id', '5SN9PRWPN131T4V');
                $tax_info = $this->db->get()->row();
                if ($tax_info) {
                ?>
                <tr>
                    <th style="text-align: right;">The total value of the tax <span></span>:
                    </th>
                    <td>
                        <?php echo (($position == 0) ? $currency . " " . $tax_info->tax_amount : $tax_info->tax_amount . " " . $currency);
                            $taxAmount = $tax_info->tax_amount; ?>
                    </td>
                </tr>
                <?php } ?>
                <?php if ($invoice_all_data[0]['total_discount'] != 0) { ?>
                <tr>
                    <th style="text-align: right;">Total with VAT <span>:</span></th>
                    <td><?php echo (($position == 0) ? $currency . " " . $i_total_discount_price_amount + $taxAmount : $i_total_discount_price_amount + $taxAmount . " " . $currency) ?>
                    </td>
                </tr>
                <?php } else { ?>
                <tr>
                    <th style="text-align: right;">Total with VAT <span>:</span></th>
                    <td><?php echo (($position == 0) ? $currency . " " . $total_amount : $total_amount . " " . $currency) ?>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <th style="text-align: right;"><?php echo display('paid_ammount') ?> :</th>
                    <td><?php echo (($position == 0) ? $currency . " " . $paid_amount : $paid_amount . " " . $currency) ?>
                    </td>
                </tr>
                <?php if ($invoice_all_data[0]['due_amount'] != 0) { ?>
                <tr>
                    <th style="text-align: right;"><?php echo display('due') ?>: </th>
                    <td><?php echo (($position == 0) ? $currency . " " . $due_amount : $due_amount . " " . $currency) ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <br>
        <table width="100%" style="margin-top: 30%;">
            <tr>
                <td>
                    <br>
                    <br>
                    <br>
                    <strong style="border-top:1px solid #ddd">Buyer's signature </strong><br>
                </td>
                <td align="right">
                    <br>
                    <br>
                    <br>
                    <strong style="border-top:1px solid #ddd">Seller's signature </strong>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>