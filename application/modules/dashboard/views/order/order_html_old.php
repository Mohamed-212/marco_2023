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
            <h1><?php echo display('order_details') ?></h1>
            <small><?php echo display('order_details') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('order') ?></a></li>
                <li class="active"><?php echo display('order_details') ?></li>
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
                        <div class="panel-body">
                            <div class="row">
                                {company_info}
                                <div class="col-sm-10 r_cominfo_div">
                                    <img src="<?php if (isset($Soft_settings[0]['invoice_logo'])) {
                                                    echo base_url() . $Soft_settings[0]['invoice_logo'];
                                                } ?>" class="img img-responsive inv_logo" alt="logo">
                                    <br>
                                    <span class="label label-success-outline m-r-15 p-10"><?php echo display('order_to') ?></span>
                                    <address class="mt_10">
                                        <strong>{company_name}</strong><br>
                                        <div><?php echo display('address') ?>: {address}</div>
                                        <div>
                                            <abbr>
                                                <?php echo display('mobile') ?>:
                                                {mobile}
                                            </abbr>
                                        </div>
                                        <div><abbr><?php echo display('email') ?>:</abbr> {email}</div>
                                        <div><abbr><?php echo display('website') ?>:</abbr> {website}
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
                                                <abbr><?php echo display('our_vat_no') ?>:</abbr>
                                                <?php echo html_escape($company_vat->vat_no); ?>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </address>
                                </div>
                                {/company_info}


                                <?php if (!strcmp($customer_mobile, $ship_customer_mobile)) { ?>
                                    <div class="col-sm-2 text-left cus_div">
                                        <h2 class="m-t-0"><?php echo display('order') ?></h2>
                                        <div>
                                            <?php echo display('sales_order_no') ?>:
                                            <?php if ($order_no) { ?>
                                                <?php echo html_escape($order_no) ?>
                                            <?php } ?>
                                        </div>
                                        <div>
                                            <?php echo display('sales_order_date') ?>:
                                            <?php echo html_escape($final_date); ?>
                                        </div>
                                        <?php if (!empty($payinfo)) { ?>
                                            <div><strong><?php echo display('payment_method') ?>:
                                                    <?php echo (($payinfo['payment_id'] > 1) ? ucfirst($payinfo['payment_method']) : 'Cash on Delivery') ?></strong>
                                            </div>
                                        <?php } ?>
                                        <br>
                                        <span class="label label-success-outline m-r-15"><?php echo display('order_from') ?></span>
                                        <address class="mt_10">
                                            <div>
                                                <?php echo display('customer_name') ?>:<?php echo html_escape($customer_name); ?>
                                            </div>
                                            <div>
                                                :<?php echo display('customer_mobile_number') ?>:
                                                <?php if ($customer_mobile) { ?>
                                                    <?php echo html_escape($customer_mobile) ?>
                                                <?php } ?>
                                            </div>
                                            <div>
                                                <?php echo display('notes') ?> :
                                                <?php if ($details) { ?>
                                                    <?php echo html_escape($details) ?>
                                                <?php } ?>
                                            </div>
                                            <div><?php echo display('address') ?>:
                                                <?php if ($customer_address) { ?>
                                                    <c class="m_0 p_0"><?php echo html_escape($customer_address); ?></c>
                                                <?php } ?>
                                            </div>
                                            <?php if ($vat_no) {  ?>
                                                <abbr><?php echo display('vat_for_customer') ?> : </abbr>
                                                <?php echo html_escape($vat_no); ?>
                                            <?php } ?>
                                            <br>
                                        </address>
                                    </div>




                                <?php } else { ?>
                                    <div class="col-sm-2 text-left cus_div">
                                        <h2 class="m-t-0"><?php echo display('order') ?></h2>

                                        <div lang="ar" dir="rtl">
                                            <?php echo display('sales_order_no') ?> :
                                            <?php if ($order_no) { ?>
                                                <?php echo html_escape($order_no) ?>
                                            <?php } ?>
                                        </div>

                                        <div>
                                            <?php echo display('customer_name') ?>
                                            :<?php echo html_escape($customer_name); ?>
                                        </div>
                                        <div>
                                            <?php echo display('customer_mobile_number') ?>:
                                            <?php if ($customer_mobile) { ?>
                                                <?php echo html_escape($customer_mobile) ?>
                                            <?php } ?>
                                        </div>
                                        <div>
                                            <?php echo display('notes') ?>:
                                            <?php if ($details) { ?>
                                                <?php echo html_escape($details) ?>
                                            <?php } ?>
                                        </div>
                                        <?php if ($vat_no) {  ?>
                                            <div>
                                                <?php echo display('vat_for_customer') ?>
                                                <?php echo html_escape($vat_no); ?>
                                            </div>
                                        <?php } ?>

                                        <div>
                                            <?php echo display('sales_order_date') ?>
                                            <?php echo html_escape($final_date); ?>
                                        </div><br>


                                        <span class="label label-success-outline m-r-15"><?php echo display('order_from') ?></span>
                                        <address class="mt_10">
                                            <strong>{ship_customer_name} </strong><br>
                                            <?php if ($ship_customer_short_address) { ?>
                                                <div><?php echo display('address') ?>:
                                                    <?php echo html_escape($ship_customer_short_address); ?></div>
                                            <?php } ?>
                                            <div>
                                                <?php echo display('customer_mobile_number') ?>:
                                                <?php if ($ship_customer_mobile) { ?>
                                                    <?php echo html_escape($ship_customer_mobile) ?>
                                                <?php } ?>
                                            </div>
                                            <?php if ($ship_customer_email) { ?>
                                                <br>
                                                <abbr><?php echo display('email') ?>:</abbr>{ship_customer_email}
                                                <div><abbr><?php echo display('email') ?>:</abbr>
                                                    <?php echo html_escape($ship_customer_email); ?></div>
                                            <?php } ?>
                                            <?php if ($vat_no) { ?>
                                                <abbr><?php echo display('vat_for_customer') ?> :</abbr>
                                                <?php echo html_escape($vat_no); ?>
                                            <?php } ?>
                                        </address>
                                    </div>
                                <?php } ?>
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
                                            <th><?php echo display('quantity') ?></th>
                                            <th><?php echo display('unit_price_before_VAT') ?></th>
                                            <th><?php echo display('discount') ?></th>
                                            <th><?php echo display('vat_rate') ?></th>
                                            <th><?php echo display('vat_value') ?></th>
                                            <th><?php echo display('total_value') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total_quantity = $o_grand_discount = $o_total_discount_price_amount = $o_total_discount_price = $o_grand_amount = 0;
                                        if (!empty($order_all_data)) {
                                            foreach ($order_all_data as $order) {
                                        ?>
                                                <tr>
                                                    <td><?php echo html_escape($order['sl']); ?></td>
                                                    <td><?php echo html_escape($order['product_id']); ?></td>
                                                    <td><img src="<?php echo  base_url() . (!empty($order['image_thumb']) ? $order['image_thumb'] : 'assets/img/icons/default.jpg') ?>" width="50" height="50"></td>
                                                    <td><strong><?php echo html_escape($order['product_name']); ?> -
                                                            (<?php echo html_escape($order['product_model']); ?>)</strong></td>
                                                    <td><?php echo html_escape($order['variant_name']);
                                                        if (!empty($order['variant_color'])) {
                                                            $cvarinfo = $this->db->select('variant_name')->from('variant')->where('variant_id', $order['variant_color'])->get()->row();
                                                            if (!empty($cvarinfo)) {
                                                                echo ', ' . $cvarinfo->variant_name;
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo html_escape($order['unit_short_name']); ?></td>
                                                    <td><?php echo html_escape($order['quantity']); ?></td>
                                                    <td><?php echo (($position == 0) ? $currency . " " . $order['rate'] : $order['rate'] . " " . $currency) ?>
                                                    </td>
                                                    <td><?php echo (($position == 0) ? $currency . " " . $order['discount'] : $order['discount'] . " " . $currency) ?>
                                                    </td>
                                                    <?php
                                                    $item_tax = $this->db->select('*')->from('tax_product_service')->where('product_id', $order['product_id'])->where('tax_id', '52C2SKCKGQY6Q9J')->get()->row();
                                                    ?>
                                                    <td><?php if (!empty($item_tax)) {
                                                            echo $item_tax->tax_percentage . '%';
                                                        } else {
                                                            echo '0%';
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (!empty($item_tax)) {
                                                            echo (($position == 0) ? $currency . " " . ($item_tax->tax_percentage * ($order['total_price'] - ($order['discount'] * $order['quantity'])) / 100) : ($item_tax->tax_percentage * ($order['total_price'] - ($order['discount'] * $order['quantity'])) / 100) . " " . $currency);
                                                        } else {
                                                            echo (($position == 0) ? $currency . " " . 0 : 0 . " " . $currency);
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo (($position == 0) ? $currency . " " . $order['total_price'] : $order['total_price'] . " " . $currency) ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $order['price']        = ($order['rate']);
                                                $o_total_price         = $order['quantity'] * ($order['price']);
                                                $o_total_discount_price = $order['quantity'] * ($order['price'] - $order['discount']);
                                                $o_discount_amount     = $order['discount'] * ($order['quantity']);
                                                $o_grand_discount      += $o_discount_amount;
                                                $o_total_discount_price_amount += $o_total_discount_price;
                                                $o_grand_amount        += $o_total_price;
                                                $total_quantity        += $order['quantity'];
                                                ?>
                                        <?php }
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6" class="text-right">
                                                <?php echo display('total_number_of_items') ?> :</td>
                                            <td colspan="6"><?php echo html_escape($total_quantity) ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="width_70p ft_left">
                                        <p><strong>{details}</strong></p>
                                    </div>

                                    <div class="ft_left width_30p">

                                        <table class="table">
                                            <tr>
                                                <th class="grand_total">Total price before Discount : </th>
                                                <td><?php echo (($position == 0) ? $currency . " " . $o_grand_amount : $o_grand_amount . " " . $currency); ?>
                                                </td>
                                            </tr>
                                            <?php if ($order_all_data[0]['total_discount'] != 0) { ?>
                                                <tr>
                                                    <th class="grand_total"> Product Discount Value : </th>
                                                    <td>
                                                        <?php echo (($position == 0) ? $currency . " " . $order_all_data[0]['total_discount'] : $order_all_data[0]['total_discount'] . " " . $currency); ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th class="grand_total">Total price after Discount :
                                                    </th>
                                                    <td>
                                                        <?php echo (($position == 0) ? $currency . " " . $o_total_discount_price_amount : $o_total_discount_price_amount . " " . $currency); ?>
                                                    </td>
                                                </tr>
                                            <?php } else { ?>
                                                <tr>
                                                    <th class="grand_total"> Discount Value : </th>
                                                    <td>
                                                        <?php echo (($position == 0) ? $currency . " " . 0 : 0 . " " . $currency); ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php if ($order_all_data[0]['discount'] != 0) { ?>
                                                <tr>
                                                    <th class="bt_bb_0"><?php echo display('total_discount') ?>
                                                        :
                                                    </th>
                                                    <td class="bt_bb_0">
                                                        <?php echo (($position == 0) ? "$currency {order_discount}" : "{order_discount} $currency") ?>
                                                    </td>
                                                </tr>
                                            <?php }

                                            $this->db->select('a.*,b.tax_name');
                                            $this->db->from('order_tax_col_summary a');
                                            $this->db->join('tax b', 'a.tax_id = b.tax_id');
                                            $this->db->where('a.order_id', $order_id);
                                            $this->db->where('a.tax_id', 'H5MQN4NXJBSDX4L');
                                            $tax_info = $this->db->get()->row();

                                            if ($tax_info) { ?>
                                                <tr>
                                                    <th class="total_cgst">The total value of the tax :
                                                    </th>
                                                    <td class="total_cgst">
                                                        <?php echo (($position == 0) ? $currency . $tax_info->tax_amount : $tax_info->tax_amount . $currency); ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                            $this->db->select('a.*,b.tax_name');
                                            $this->db->from('order_tax_col_summary a');
                                            $this->db->join('tax b', 'a.tax_id = b.tax_id');
                                            $this->db->where('a.order_id', $order_id);
                                            $this->db->where('a.tax_id', '52C2SKCKGQY6Q9J');
                                            $tax_info = $this->db->get()->row();

                                            if ($tax_info) { ?>
                                                <tr>
                                                    <th class="total_sgst">The total value of the tax :</th>
                                                    <td class="total_sgst">
                                                        <?php echo (($position == 0) ? $currency . $tax_info->tax_amount : $tax_info->tax_amount . $currency); ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                            $this->db->select('a.*,b.tax_name');
                                            $this->db->from('order_tax_col_summary a');
                                            $this->db->join('tax b', 'a.tax_id = b.tax_id');
                                            $this->db->where('a.order_id', $order_id);
                                            $this->db->where('a.tax_id', '5SN9PRWPN131T4V');
                                            $tax_info = $this->db->get()->row();
                                            if ($tax_info) {
                                            ?>
                                                <tr>
                                                    <th class="total_igst">The total value of the tax :</th>
                                                    <td class="total_igst">
                                                        <?php echo (($position == 0) ? $currency . $tax_info->tax_amount : $tax_info->tax_amount . $currency); ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php if ($order_all_data[0]['service_charge'] != 0) { ?>
                                                <tr>
                                                    <th class="service_charge"><?php echo display('service_charge') ?>
                                                        :
                                                    </th>
                                                    <td class="service_charge">
                                                        <?php echo (($position == 0) ? "$currency {service_charge}" : "{service_charge} $currency") ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <th class="grand_total"> Total with VAT :</th>
                                                <td class="grand_total">
                                                    <?php echo (($position == 0) ? "$currency {total_amount}" : "{total_amount} $currency") ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="bt_bb_0"><?php echo display('paid_ammount') ?> : </th>
                                                <td class="bt_bb_0">
                                                    <?php echo (($position == 0) ? "$currency {paid_amount}" : "{paid_amount} $currency") ?>
                                                </td>
                                            </tr>
                                            <?php if ($order_all_data[0]['due_amount'] != 0) { ?>
                                                <tr>
                                                    <th><?php echo display('due') ?> :</th>
                                                    <td><?php echo (($position == 0) ? "$currency {due_amount}" : "{due_amount} $currency") ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                        <div class="auth_by"><?php echo display('authorised_by') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer text-left">
                        <a class="btn btn-danger" href="<?php echo base_url('dashboard/Corder/manage_order'); ?>"><?php echo display('back') ?></a>
                        <a class="btn btn-info" href="#" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->