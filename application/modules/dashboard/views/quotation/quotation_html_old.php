<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$CI = &get_instance();
$CI->load->model('Soft_settings');
$Soft_settings = $CI->Soft_settings->retrieve_setting_editdata();
?>
<script src="<?php echo MOD_URL . 'dashboard/assets/js/print.js'; ?>"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('quotation_details') ?></h1>
            <small><?php echo display('quotation_details') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('quotation') ?></a></li>
                <li class="active"><?php echo display('quotation_details') ?></li>
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
                        <link href="<?php echo MOD_URL . 'dashboard/assets/css/print.css'; ?>" type="text/css"
                            rel="stylesheet" />
                        <link href="<?php echo MOD_URL . 'dashboard/assets/css/quotation_html.css'; ?>" type="text/css"
                            rel="stylesheet" />
                        <div class="panel-body">
                            <div class="row">

                                {company_info}
                                <div class="col-sm-9 r_cominfo_div">
                                    <img src="<?php if (isset($Soft_settings[0]['invoice_logo'])) {
                                                    echo base_url($Soft_settings[0]['invoice_logo']);
                                                } ?>" class="img img-responsive inv_logo" alt="">
                                    <br>
                                    <span
                                        class="label label-success-outline m-r-15 p-10"><?php echo display('quotation_from') ?></span>
                                    <address class="mt_10">
                                        <strong>{company_name}</strong><br>
                                        <div><?php echo display('address') ?>{address}</div>
                                        <div><abbr><?php echo display('mobile') ?> : {mobile}</abbr></div>
                                        <div><abbr><?php echo display('email') ?> : </abbr>{email}</div>
                                        <div><abbr><?php echo display('website') ?> : </abbr>{website}</div>
                                        <div>
                                            <?php $store = $this->db->select('store_name')->from('store_set')->where('store_id', $store_id)->get()->row(); ?>
                                            <abbr><?php echo display('branch') ?> : </abbr>
                                            <?php echo html_escape($store->store_name); ?>
                                        </div>
                                        <?php
                                        $company_vat = $this->db->select('vat_no')->from('company_information')->where('status', 1)->get()->row();
                                        if (!empty($company_vat)) {
                                        ?>
                                        <div>
                                            <abbr><?php echo display('our_vat_no') ?> :
                                            </abbr><?php echo html_escape($company_vat->vat_no); ?>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                    </address>
                                </div>
                                {/company_info}

                                <div class="col-sm-3 text-left quotation_div">
                                    <h2 class="m-t-0"><?php echo display('quotation') ?></h2>
                                    <div>
                                        <?php echo display('quotation_no') ?> : {quotation_no}

                                    </div>
                                    <div>
                                        <?php echo display('quotation_start_date') ?>
                                        :<?php echo date('d M, Y', strtotime($final_date)); ?>
                                    </div>
                                    <div class="m-b-15">
                                        <?php echo display('quotation_expiry_date') ?>
                                        :<?php echo date('d M, Y', strtotime($expire_date)); ?>
                                    </div>
                                    <span
                                        class="label label-success-outline m-r-15"><?php echo display('quotation_to') ?></span>
                                    <address class="mt_10">
                                        <strong>
                                            <?php echo display('customer_name') ?>:{customer_name}
                                        </strong><br>
                                        <?php $customer_address = 0;
                                        if ($customer_address) { ?>
                                        <abbr><?php echo display('address') ?>:</abbr>
                                        <p class="ctext">
                                            {customer_address}
                                        </p>
                                        <?php }  ?>
                                        <?php if ($customer_mobile) { ?>
                                        <abbr> <?php echo display('mobile') ?> : {customer_mobile}</abbr>
                                        <?php }
                                        if ($customer_email) { ?>
                                        <br>
                                        <abbr><?php echo display('email') ?> : {customer_email} </abbr>
                                        <?php }  ?>
                                        <?php if ($vat_no) {  ?>
                                        <br>
                                        <abbr><?php echo display('vat_for_customer') ?> : </abbr>
                                        <?php echo html_escape($vat_no); ?>
                                        <?php } ?>
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
<!--                                            <th>--><?php //echo display('batch_no') ?><!--</th>-->
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
                                        if (!empty($quotation_all_data)) {
                                            $total_quantity = $total_quotation_amount = $q_grand_discount = $q_total_discount_price_amount = $q_total_discount_price = $q_grand_amount = 0;
                                            foreach ($quotation_all_data as $key => $quotation) { ?>
                                        <tr>
                                            <td><?php echo $key + 1; ?></td>
                                            <td><?php echo $quotation['product_id'] ?></td>
                                            <td><img src="<?php echo  base_url() . (!empty($quotation['image_thumb']) ? $quotation['image_thumb'] : 'assets/img/icons/default.jpg') ?>"
                                                    width="50" height="50"></td>
                                            <td><strong><?php echo html_escape($quotation['product_name']) ?> -
                                                    (<?php echo html_escape($quotation['product_model']) ?>)</strong>
                                            </td>
                                            <td><?php echo html_escape($quotation['variant_name']) ?>
                                                <?php echo html_escape($quotation['variant_color']) ?></td>
                                            <td><?php echo html_escape($quotation['unit_short_name']) ?></td>
<!--                                            <td>--><?php //echo html_escape($quotation['batch_no']) ?><!--</td>-->
                                            <td><?php echo html_escape($quotation['quantity']) ?></td>
                                            <td><?php echo (($position == 0) ? $currency . " " . $quotation['rate'] : $quotation['rate'] . " " . $currency) ?>
                                            </td>
                                            <td><?php echo (($position == 0) ? $currency . " " . $quotation['discount'] : $quotation['discount'] . " " . $currency) ?>
                                            </td>
                                            <?php
                                                    $item_tax = $this->db->select('*')->from('tax_product_service')->where('product_id', $quotation['product_id'])->where('tax_id', '52C2SKCKGQY6Q9J')->get()->row();
                                                    ?>
                                            <td><?php if (!empty($item_tax)) {
                                                            echo $item_tax->tax_percentage . '%';
                                                        } else {
                                                            echo '0%';
                                                        } ?></td>
                                            <td>
                                                <?php
                                                        if (!empty($item_tax)) {
                                                            echo (($position == 0) ? $currency . " " . ($item_tax->tax_percentage * ($quotation['total_price'] - ($quotation['discount'] * $quotation['quantity'])) / 100) : ($item_tax->tax_percentage * ($quotation['total_price'] - ($quotation['discount'] * $quotation['quantity'])) / 100) . " " . $currency);
                                                        } else {
                                                            echo (($position == 0) ? $currency . " " . 0 : 0 . " " . $currency);
                                                        }
                                                        ?>
                                            </td>
                                            <td><?php echo (($position == 0) ? $currency . " " . $quotation['total_price'] : $quotation['total_price'] . " " . $currency) ?>
                                            </td>
                                        </tr>
                                        <?php
                                                $quotation['price']    = ($quotation['rate']);
                                                $q_total_price         = $quotation['quantity'] * ($quotation['price']);
                                                $q_total_discount_price = $quotation['quantity'] * ($quotation['price'] - $quotation['discount']);
                                                $q_discount_amount     = $quotation['discount'] * ($quotation['quantity']);
                                                $q_grand_discount      += $q_discount_amount;
                                                $q_total_discount_price_amount += $q_total_discount_price;
                                                $q_grand_amount        += $q_total_price;
                                                $total_quantity        += $quotation['quantity'];
                                                ?>
                                        <?php }
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7" class="text-right"> <strong>
                                                    <?php echo display('total_number_of_items') ?> </strong> :</td>
                                            <td colspan="6"><strong><?php echo html_escape($total_quantity) ?></strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="width_70p ft_left">
                                        <p><strong>{details}</strong></p>
                                    </div>
                                    <div class="width_30p ft_left">
                                        <table class="table">
                                            <tr>
                                                <th class="grand_total">Total price before Discount: </th>
                                                <td><?php echo (($position == 0) ? $currency . " " . $q_grand_amount : $q_grand_amount . " " . $currency); ?>
                                                </td>
                                            </tr>
                                            <?php if ($quotation_all_data[0]['discount'] != 0) { ?>
                                            <tr>
                                                <th class="grand_total"> Product Discount Value: </th>
                                                <td>
                                                    <?php echo (($position == 0) ? $currency . " " . $quotation_all_data[0]['total_discount'] : $quotation_all_data[0]['total_discount'] . " " . $currency); ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th class="grand_total">Total price after Discount: </th>
                                                <td>
                                                    <?php echo (($position == 0) ? $currency . " " . $q_total_discount_price_amount : $q_total_discount_price_amount . " " . $currency); ?>
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
                                            <?php if ($quotation_all_data[0]['discount'] != 0) { ?>
                                            <tr>
                                                <th class="bt_bb_0"><?php echo display('total_discount') ?>
                                                    :
                                                </th>
                                                <td class="bt_bb_0">
                                                    <?php echo (($position == 0) ? "$currency {quotation_discount}" : "{quotation_discount} $currency") ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php
                                            $this->db->select('a.*,b.tax_name');
                                            $this->db->from('quotation_tax_col_summary a');
                                            $this->db->join('tax b', 'a.tax_id = b.tax_id');
                                            $this->db->where('a.quotation_id', $quotation_id);
                                            $this->db->where('a.tax_id', 'H5MQN4NXJBSDX4L');
                                            $tax_info = $this->db->get()->row();
                                            if ($tax_info) {
                                            ?>
                                            <tr>
                                                <th class="total_cgst">The total value of the tax:</th>
                                                <td class="total_cgst">
                                                    <?php echo (($position == 0) ? $currency . $tax_info->tax_amount : $tax_info->tax_amount . $currency); ?>
                                                </td>
                                            </tr>
                                            <?php }
                                            $this->db->select('a.*,b.tax_name');
                                            $this->db->from('quotation_tax_col_summary a');
                                            $this->db->join('tax b', 'a.tax_id = b.tax_id');
                                            $this->db->where('a.quotation_id', $quotation_id);
                                            $this->db->where('a.tax_id', '52C2SKCKGQY6Q9J');
                                            $tax_info = $this->db->get()->row();
                                            if ($tax_info) {
                                            ?>
                                            <tr>
                                                <th class="total_sgst">The total value of the tax :</th>
                                                <td class="total_sgst">
                                                    <?php echo (($position == 0) ? $currency . $tax_info->tax_amount : $tax_info->tax_amount . $currency); ?>
                                                </td>
                                            </tr>
                                            <?php }
                                            $this->db->select('a.*,b.tax_name');
                                            $this->db->from('quotation_tax_col_summary a');
                                            $this->db->join('tax b', 'a.tax_id = b.tax_id');
                                            $this->db->where('a.quotation_id', $quotation_id);
                                            $this->db->where('a.tax_id', '5SN9PRWPN131T4V');
                                            $tax_info = $this->db->get()->row();
                                            if ($tax_info) { ?>
                                            <tr>
                                                <th class="total_igst">The total value of the tax : </th>
                                                <td class="total_igst">
                                                    <?php echo (($position == 0) ? $currency . $tax_info->tax_amount : $tax_info->tax_amount . $currency); ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php if ($quotation_all_data[0]['service_charge'] != 0) { ?>
                                            <tr>
                                                <th class="service_charge"><?php echo display('service_charge') ?> :
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
                                        </table>
                                        <div class="auth_by"><?php echo display('authorised_by') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-left">
                        <a class="btn btn-danger"
                            href="<?php echo base_url('dashboard/Cquotation'); ?>"><?php echo display('back') ?></a>
                        <a class="btn btn-info" href="#" onclick="printDiv('printableArea')"><span
                                class="fa fa-print"></span> <?php echo display('print') ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->