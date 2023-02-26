<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script>
    var products_with_no_quantity = "<?= display('products_with_no_quantity') ?>";
    var installment_amount_is_not_valid = "<?=display('installment_total_amount_not_match')?>";
    var payment_bank_not_selected = "<?=display('payment_bank_not_selected')?>";
    var accessories_category_id = 'a';
    var installErr = "<?= display('choose_installment_if_invoice_not_full_paid')?>";
    var paidErr = "<?= display('paid_error')?>";
    <?php
        $access = $this->db->select('category_id')->from('product_category')->where('category_name', 'ACCESSORIES')->get()->row();
        echo "accessories_category_id = '" . $access->category_id . "';";
    ?>
</script>
<!-- Customer js php -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/add_invoice_customer.js.php"></script>
<!-- Product invoice js -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/product_invoice.js.php"></script>
<!-- Invoice js -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/order.js" type="text/javascript"></script>

<script src="<?php echo MOD_URL . 'dashboard/assets/js/add_invoice_form.js'; ?>"></script>
<link rel="stylesheet" href="<?php echo MOD_URL . 'dashboard/assets/css/invoice/add_invoice_form.css' ?>">

<!-- Edit order Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('quotation_update') ?></h1>
            <small><?php echo display('quotation_update') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('quotation') ?></a></li>
                <li class="active"><?php echo display('quotation_update') ?></li>
            </ol>
        </div>
    </section>
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

        <?php if (!empty(validation_errors())) : ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>

        <!-- quotation report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('quotation_update') ?></h4>
                        </div>
                    </div>
                    <?php echo form_open('dashboard/Cquotation/quotation_update/' . $quotation_id, array('class' => 'form-vertical', 'id' => 'normalinvoice')) ?>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-6" id="">
                                <div class="form-group row">
                                    <label for="customer_name" class="col-sm-4 col-form-label"><?php echo display('customer_name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="customer_name" value="{customer_name}" class="form-control customerSelection" placeholder='<?php echo display('customer_name_or_phone') ?>' required id="customer_name" required>

                                        <input type="hidden" class="customer_hidden_value" name="customer_id" value="{customer_id}" id="SchoolHiddenId" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('date') ?>
                                        <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" tabindex="3" class="form-control datepicker" autocomplete="off" name="invoice_date" value="{date}" id="date" required />
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6" id="store">
                                <div class="form-group row">
                                    <label for="store_id" class="col-sm-4 col-form-label">
                                        <?php echo display('store') ?>
                                        <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="store_id" id="store_id">
                                            <option value=""></option>
                                            <?php
                                            foreach ($store_list as $store) {
                                            ?>
                                                <option value="<?php echo $store['store_id'] ?>" <?php if ($store['store_id'] == $store_id) echo 'selected' ?>> <?php echo $store['store_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" id="employee">
                                <div class="form-group row">
                                    <label for="employee_id" class="col-sm-4 col-form-label">
                                        <?php echo display('employee_name') ?>
                                        <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="employee_id" id="employee_id">
                                            <option value=""></option>
                                            <?php
                                            foreach ($employee_list as $employee) {
                                            ?>
                                                <option value="<?php echo $employee['id'] ?>" <?php if ($employee['id'] == $employee_id) echo 'selected' ?>> <?php echo $employee['first_name'] . ' ' . $employee['last_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="currency" class="col-sm-4 col-form-label"><?php echo display('pricing') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                    <select name="pri_type" id="pri_type" onchange="get_pri_type_rate()" class="form-control " required="" data-val="<?=$pricing_type?>">
                                            <?php foreach ($all_pri_type as $pri_type) : ?>
                                                <option value="<?php echo html_escape($pri_type['pri_type_id']) ?>" <?=$pricing_type == $pri_type['pri_type_id'] ? 'selected' : ''?> ><?php echo display($pri_type['pri_type_name']) ?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                            <option value="0" <?=$pricing_type == 0 ? 'selected' : ''?> ><?=display('sell_price')?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="currency" class="col-sm-4 col-form-label"><?php echo display('product_type') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="product_type" id="product_type" class="form-control " required="">
                                            <option value="1" <?=$product_type == 1 ? 'selected' : ''?> ><?php echo display('normal') ?></option>
                                            <option value="2" <?=$product_type == 2 ? 'selected' : ''?> ><?php echo display('assemply') ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="model_no" class="col-sm-4 col-form-label"><?php echo display('item_code') ?> </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" placeholder="<?php echo display('item_code') ?>" id="model_no" tabindex="5" autocomplete="off">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="button" class="btn btn-primary btn-large" onclick="product_per_model();" value="<?php echo display('add') ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="modelModal" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12">
                                                <div class="panel panel-bd">
                                                    <div class="panel-body">
                                                        <div class="table-responsive mt_10">
                                                            <table class="table table-bordered table-hover" id="purchaseTable">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center"><input type="checkbox" id="all_pro" onclick="select_all();">
                                                                        </th>
                                                                        <th class="text-center"><?php echo display('item_information') ?> </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="model_no_text"></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="button" class="btn btn-primary btn-large" onclick="add_products_model();" value="<?php echo display('confirm') ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive mt_10">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_information') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center" width="130"><?php echo display('size') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('available_quantity') ?></th>
                                        <th class="text-center"><?php echo display('quantity') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('price') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('discount') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('total') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="addinvoiceItem">
                                    <input type="hidden" hidden name="quotation" value="<?= $quotation ?>" />
                                    <?php
                                    $i = 0;
                                    if ($quotation_all_data) {
                                        foreach ($quotation_all_data as $value) {

                                            $i++;
                                            $cgst = null;
                                            $sgst = null;
                                            $igst = null;

                                            $sgst_tax_amount = 0;
                                            $cgst_tax_amount = 0;
                                            $igst_tax_amount = 0;

                                            $cgst_value = $this->db->select('tcd.tax_id, tcd.amount, tcd.product_id, t.tax_name')
                                                ->from('quotation_tax_col_details AS tcd')
                                                ->join('tax AS t', 't.tax_id = tcd.tax_id', 'left')
                                                ->where('tcd.product_id', $value['product_id'])
                                                ->where('tcd.quotation_id', $value['quotation_id'])
                                                ->where('tcd.variant_id', $value['variant_id'])
                                                // ->where('t.tax_id', 'H5MQN4NXJBSDX4L')
                                                ->get()
                                                ->row();

                                            $sgst_value = $this->db->select('tcd.tax_id, tcd.amount, tcd.product_id, t.tax_name')
                                                ->from('quotation_tax_col_details AS tcd')
                                                ->join('tax AS t', 't.tax_id = tcd.tax_id', 'left')
                                                ->where('tcd.product_id', $value['product_id'])
                                                ->where('tcd.quotation_id', $value['quotation_id'])
                                                ->where('tcd.variant_id', $value['variant_id'])
                                                // ->where('t.tax_id', '52C2SKCKGQY6Q9J')
                                                ->get()
                                                ->row();

                                            $igst_value = $this->db->select('tcd.tax_id, tcd.amount, tcd.product_id, t.tax_name')
                                                ->from('quotation_tax_col_details AS tcd')
                                                ->join('tax AS t', 't.tax_id = tcd.tax_id', 'left')
                                                ->where('tcd.product_id', $value['product_id'])
                                                ->where('tcd.quotation_id', $value['quotation_id'])
                                                ->where('tcd.variant_id', $value['variant_id'])
                                                // ->where('t.tax_id', '5SN9PRWPN131T4V')
                                                ->get()
                                                ->row();

                                            $cgst = (!empty($cgst_value->tax_name) ? $cgst_value->amount : null);
                                            $sgst = (!empty($sgst_value->tax_name) ? $sgst_value->amount : null);
                                            $igst = (!empty($igst_value->tax_name) ? $igst_value->amount : null);
                                            $cgst_id = (!empty($cgst_value->tax_id) ? $cgst_value->tax_id : null);
                                            $sgst_id = (!empty($sgst_value->tax_id) ? $sgst_value->tax_id : null);
                                            $igst_id = (!empty($igst_value->tax_id) ? $igst_value->tax_id : null);

                                            $cgst_tax = $this->db->select('tcd.tax_id, tcd.tax_amount, t.tax_name')
                                                ->from('quotation_tax_col_summary AS tcd')
                                                ->join('tax AS t', 't.tax_id = tcd.tax_id', 'left')
                                                ->where('tcd.quotation_id', $value['quotation_id'])
                                                // ->where('t.tax_id', 'H5MQN4NXJBSDX4L')
                                                ->get()
                                                ->row();

                                            $sgst_tax = $this->db->select('tcd.tax_id, tcd.tax_amount, t.tax_name')
                                                ->from('quotation_tax_col_summary AS tcd')
                                                ->join('tax AS t', 't.tax_id = tcd.tax_id', 'left')
                                                ->where('tcd.quotation_id', $value['quotation_id'])
                                                // ->where('t.tax_id', '52C2SKCKGQY6Q9J')
                                                ->get()
                                                ->row();

                                            $igst_tax = $this->db->select('tcd.tax_id, tcd.tax_amount, t.tax_name')
                                                ->from('quotation_tax_col_summary AS tcd')
                                                ->join('tax AS t', 't.tax_id = tcd.tax_id', 'left')
                                                ->where('tcd.quotation_id', $value['quotation_id'])
                                                // ->where('t.tax_id', '5SN9PRWPN131T4V')
                                                ->get()
                                                ->row();

                                            $sgst_tax_amount = (!empty($sgst_tax->tax_name) ? $sgst_tax->tax_amount : 0);
                                            $cgst_tax_amount = (!empty($cgst_tax->tax_name) ? $cgst_tax->tax_amount : 0);
                                            $igst_tax_amount = (!empty($igst_tax->tax_name) ? $igst_tax->tax_amount : 0);

                                            //Tax basic price
                                            $this->db->select('tax.*,tax_product_service.product_id,tax_percentage');
                                            $this->db->from('tax_product_service');
                                            $this->db->join('tax', 'tax_product_service.tax_id = tax.tax_id', 'left');
                                            $this->db->where('tax_product_service.product_id', $value['product_id']);
                                            $tax_information = $this->db->get()->result();

                                            if (!empty($tax_information)) {
                                                foreach ($tax_information as $k => $v) {
                                                    if ($v->tax_id == 'H5MQN4NXJBSDX4L') {
                                                        $tax['cgst_tax'] = ($v->tax_percentage) / 100;
                                                        $tax['cgst_name'] = $v->tax_name;
                                                        $tax['cgst_id'] = $v->tax_id;
                                                    } elseif ($v->tax_id == '52C2SKCKGQY6Q9J') {
                                                        $tax['sgst_tax'] = ($v->tax_percentage) / 100;
                                                        $tax['sgst_name'] = $v->tax_name;
                                                        $tax['sgst_id'] = $v->tax_id;
                                                    } elseif ($v->tax_id == '5SN9PRWPN131T4V') {
                                                        $tax['igst_tax'] = ($v->tax_percentage) / 100;
                                                        $tax['igst_name'] = $v->tax_name;
                                                        $tax['igst_id'] = $v->tax_id;
                                                    }
                                                }
                                            }

                                            //Variant for per product
                                            $this->db->select('a.variants, a.assembly, a.category_id, pt.product_price, a.*');
                                            $this->db->from('product_information a');
                                            $this->db->join('pricing_types_product pt', 'pt.product_id = a.product_id AND pt.pri_type_id = 1');
                                            $this->db->where(array('a.product_id' => $value['product_id'], 'a.status' => 1));
                                            $product_information = $this->db->get()->row();
                                            $exploded = explode(',', $product_information->variants);

                                            //Stock available check from purchase
                                            $this->db->select('SUM(a.quantity) as total_purchase');
                                            $this->db->from('product_purchase_details a');
                                            $this->db->where('a.product_id', $value['product_id']);
                                            $total_purchase = $this->db->get()->row();

                                            //Stock available check from invoice
                                            $this->db->select('SUM(b.quantity) as total_sale');
                                            $this->db->from('invoice_stock_tbl b');
                                            $this->db->where('b.product_id', $value['product_id']);
                                            $total_sale = $this->db->get()->row();
                                    ?>
                                            <tr>
                                                <td class="span3">
                                                    <input type="text" name="product_name" onclick="invoice_productList(<?php echo $i ?>);" value="<?php echo html_escape($value['product_name']) ?>" class="form-control productSelection" required placeholder='<?php echo display('product_name') ?>' id="product_name_<?php echo $i ?>">
                                                    <input type="hidden" class="autocomplete_hidden_value product_id_<?php echo $i ?>" name="product_id[]" value="<?php echo html_escape($value['product_id']) ?>" />
                                                    <input type="hidden" class="sl" value="<?php echo $i ?>">
                                                    <input type="hidden" name="assembly[]" id="assembly<?php echo $i ?>" value="<?php echo $product_information->assembly ?>">
                                                    <input type="hidden" name="colorv[]" id="color<?php echo $i ?>" value="<?php echo $exploded[1] ?>">
                                                    <input type="hidden" name="sizev[]" id="size<?php echo $i ?>" value="<?php echo $exploded[0] ?>">
                                                    <input type="hidden" class="baseUrl" value="<?php echo base_url(); ?>" />
                                                    <input type="hidden" hidden name="category_id" id="category_id_<?php echo $i ?>" value="<?=$product_information->category_id?>" />
                                                    <input type="hidden" hidden name="product_model" id="product_model_<?php echo $i ?>" value="<?=$product_information->product_model?>" />
                                                    <div id="viewassembly<?php echo $i ?>" class="text-center <?php if ($product_information->assembly == 0) {
                                                                                                                    echo 'hidden';
                                                                                                                } ?> ">
                                                        <a style="color: blue" href="" data-toggle="modal" data-target="#viewprom" onclick="viewpro(<?php echo $i ?>)">view products </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php
                                                    $this->db->select('*');
                                                    $this->db->from('variant');
                                                    $this->db->where('variant_id', $exploded[0]);
                                                    $pvariants = $this->db->get()->result_array();
                                                    ?>
                                                    <div hidden="">
                                                        <select name="color_variant[]" id="variant_color_id_<?php echo $i ?>" class="form-control color_variant width_100p">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                    <div class="variant_id_div">
                                                        <select name="variant_id[]" id="variant_id_<?php echo $i ?>" class="form-control variant_id width_100p" disabled="">
                                                            <option value=""></option>
                                                            <option value="<?php echo html_escape($pvariants[0]['variant_id']) ?>" selected>
                                                                <?php echo html_escape($pvariants[0]['variant_name']) ?>
                                                            </option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td hidden="" class="text-center">
                                                    <div>
                                                        <select name="batch_no[]" id="batch_no_<?php echo $i ?>" class="form-control batch_no width_100p">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="available_quantity[]" id="avl_qntt_<?php echo $i ?>" class="form-control text-right available_quantity_<?php echo $i ?>" placeholder="0" readonly="1" value="<?php echo ($total_purchase->total_purchase - $total_sale->total_sale) ?>" />
                                                </td>
                                                <td>
                                                    <input type="number" name="product_quantity[]" onkeyup="quantity_calculate(<?php echo $i ?>);" onchange="quantity_limit(<?php echo $i ?>);" value="<?php echo html_escape($value['quantity']) ?>" id="total_qntt_<?php echo $i ?>" class="form-control text-right" min="0" required="" />
                                                </td>
                                                <td>
                                                    <?php
                                                        $pr = $product_information->price;
                                                        if ($value['product_type'] == 2) {
                                                            if ($value['pricing_type'] == 1) {
                                                                $pri = $this->db->select('product_price')->from('pricing_types_product')->where(array('product_id' => $value['product_id'], 'pri_type_id' => 1))->get()->row();
                                                                if ($pri) {
                                                                    $pr = $pri->product_price;
                                                                }
                                                            } elseif ($value['pricing_type'] == 2) {
                                                                $pri = $this->db->select('product_price')->from('pricing_types_product')->where(array('product_id' => $value['product_id'], 'pri_type_id' => 2))->get()->row();
                                                                if ($pri) {
                                                                    $pr = $pri->product_price;
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                    <input type="number" name="product_rate[]" onkeyup="quantity_calculate(<?php echo $i ?>);" onchange="quantity_calculate(<?php echo $i ?>);" value="<?php echo html_escape($value['rate']) ?>" id="price_item_<?php echo $i ?>" class="price_item<?php echo $i ?> form-control text-right" required="" min="0" readonly="readonly" />
                                                    <input type="hidden" hidden id="price_item_saved_<?php echo $i ?>" value="<?php echo html_escape($pr) ?>" data-val="<?php echo html_escape($pr) ?>" data-valasdasd="<?php echo html_escape($pr) ?>" />
                                                </td>
                                                <td>
                                                    <input type="number" name="discount[]" onkeyup="quantity_calculate(<?php echo $i ?>);" onchange="quantity_calculate(<?php echo $i ?>);" id="discount_<?php echo $i ?>" class="form-control text-right" placeholder="0.00" <?php if ($value['discount'] > 0) : ?>data-value="<?php echo html_escape($value['discount']) ?>" <?php endif ?> value="<?php echo html_escape($value['discount']) ?>" min="0" />
                                                </td>
                                                <td>
                                                    <input class="total_price form-control text-right" type="text" name="total_price[]" id="total_price_<?php echo $i ?>" value="<?php echo html_escape($value['total_price']) ?>" readonly="readonly" placeholder="0.00" />
                                                    <input type="hidden" name="quotation_details_id[]" id="quotation_details_id" value="<?php echo html_escape($value['quotation_details_id']) ?>" />
                                                </td>
                                                <td>

                                                    <?php
                                                    // product tax info
                                                    $this->db->select('*')
                                                        ->from('tax_product_service s')
                                                        ->where('product_id', $value['product_id'])
                                                        ->join('tax t', 't.tax_id = s.tax_id', 'left');
                                                    $productTax = $this->db->get();
                                                    if ($productTax) {
                                                        $productTax = $productTax->row();
                                                    }

                                                    //Tax basic info
                                                    $this->db->select('*');
                                                    $this->db->from('tax');
                                                    $this->db->order_by('tax_name', 'asc');
                                                    $tax_information = $this->db->get()->result();

                                                    if (!empty($tax_information)) {
                                                        foreach ($tax_information as $k => $v) {
                                                            if ($v->tax_id == '52C2SKCKGQY6Q9J') {
                                                                $tax['cgst_name'] = $v->tax_name;
                                                                $tax['cgst_id'] = $v->tax_id;
                                                                $tax['cgst_status'] = $v->status;
                                                            } elseif ($v->tax_id == 'H5MQN4NXJBSDX4L') {
                                                                $tax['sgst_name'] = $v->tax_name;
                                                                $tax['sgst_id'] = $v->tax_id;
                                                                $tax['sgst_status'] = $v->status;
                                                            } elseif ($v->tax_id == '5SN9PRWPN131T4V') {
                                                                $tax['igst_name'] = $v->tax_name;
                                                                $tax['igst_id'] = $v->tax_id;
                                                                $tax['igst_status'] = $v->status;
                                                            }
                                                        }
                                                    }
                                                    ?>

                                                    <!-- Tax calculate start-->
                                                    <?php if ($tax['cgst_status'] == 1) { ?>
                                                        <input type="hidden" id="cgst_<?php echo $i ?>" class="cgst" value="<?php echo (!empty($productTax->tax_percentage) ? (float)($productTax->tax_percentage / 100) : null) ?>" />
                                                        <input type="hidden" id="total_cgst_<?php echo $i ?>" class="total_cgst" name="cgst[]" data-value="<?php echo ((float)$productTax->tax_percentage / 100) * ($value['total_price'] - ($value['discount'] * $value['quantity'])) ?>" value="<?php echo ((float)$productTax->tax_percentage / 100) * ($value['total_price'] - ($value['discount'] * $value['quantity'])) ?>" />
                                                        <input type="hidden" name="cgst_id[]" id="cgst_id_<?php echo $i ?>" value="<?php echo html_escape($productTax->tax_id) ?>">
                                                    <?php } ?>
                                                    <!-- Tax calculate end -->

                                                    <input type="hidden" id="total_discount_<?php echo $i ?>" class="" />
                                                    <input type="hidden" id="all_discount_<?php echo $i ?>" class="total_discount" value="<?php echo ($value['discount'] * $value['quantity']) ?>" />
                                                    <!-- Discount calculate end -->

                                                    <!-- Tax calculate end -->
                                                    <button class="btn btn-danger text-right" type="button" value="<?php echo display('delete') ?>" onclick="deleteRow(this)"><?php echo display('delete') ?></button>
                                                    </button>
                                                </td>
                                                <script>
                                                    $(document).ready(function() {
                                                        stock_by_product_variant_id(<?php echo $i ?>);
                                                        stock_by_product_variant_color(<?php echo $i ?>);
                                                        get_pri_type_rate1(<?php echo $i ?>);
                                                    });
                                                </script>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <?php if ($tax['cgst_status'] == 1) { ?>
                                        <tr>
                                            <td class="text-right" colspan="6">
                                                <b><?php echo html_escape($tax['cgst_name']) ?>:</b>
                                            </td>
                                            <td class="text-right" colspan="2">
                                                <input type="text" id="total_cgst" class="form-control text-right" name="total_cgst" value="<?php echo html_escape($cgst_tax_amount) ?>" readonly="readonly" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" colspan="1">
                                                <input type="button" id="add-invoice-item" class="btn btn-info color4 color5" name="add-invoice-item" onClick="addInputField('addinvoiceItem');" value="<?php echo display('add_new_item') ?>" />
                                            </td>
                                            <td class="text-right" colspan="5">
                                                <b><?php echo display('quotation') ?>:</b>
                                            </td>
                                            <td class="text-right" colspan="2">
                                                <input type="checkbox" id="is_quotation" <?php if ($is_quotation == 1) echo 'checked'; ?> onclick="check_quotation();" value="{is_quotation}" class="form-control text-right" name="is_quotation" />
                                            </td>
                                        </tr>
                                    <?php }
                                    if ($tax['sgst_status'] == 1) { ?>
                                        <tr>
                                            <td class="text-right" colspan="6">
                                                <b><?php echo html_escape($tax['sgst_name']) ?>:</b>
                                            </td>
                                            <td class="text-right" colspan="2">
                                                <input type="text" id="total_sgst" class="form-control text-right" name="total_sgst" value="<?php echo html_escape($sgst_tax_amount)
                                                                                                                                            ?>" readonly="readonly" />
                                            </td>
                                        </tr>
                                    <?php }
                                    if ($tax['igst_status'] == 1) { ?>
                                        <tr>
                                            <td class="text-right" colspan="6">
                                                <b><?php echo html_escape($tax['igst_name']) ?>:</b>
                                            </td>
                                            <td class="text-right" colspan="2">
                                                <input type="text" id="total_igst" class="form-control text-right" name="total_igst" value="<?php echo html_escape($igst_tax_amount)
                                                                                                                                            ?>" readonly="readonly" />
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="4" rowspan="4">
                                            <label for="details" class=""><?php echo display('details') ?></label>
                                            <textarea class="form-control" name="invoice_details" id="details" rows="6" placeholder="<?php echo display('details') ?>">{details}</textarea>
                                        </td>
                                        <td class="text-right" colspan="2">
                                            <b><?php echo display('product_discount') ?>:</b>
                                        </td>
                                        <td class="text-right" colspan="2">
                                            <input type="text" id="total_discount_ammount" class="form-control text-right" name="total_discount" readonly="readonly" value="{total_discount}" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="2">
                                            <b><?php echo display('quotation_discount') ?>:</b>
                                        </td>
                                        <td class="text-right" colspan="2">
                                            <input type="text" id="invoice_discount" class="form-control text-right" name="invoice_discount" <?php if ($quotation_discount > 0) : ?> data-value="<?php if ($quotation_discount) {
                                                                                                                                                                                                        echo ($quotation_discount);
                                                                                                                                                                                                    } else {
                                                                                                                                                                                                        echo 0;
                                                                                                                                                                                                    } ?>" <?php endif ?> value="<?php if ($quotation_discount) {
                                                                                    echo ($quotation_discount);
                                                                                } else {
                                                                                    echo 0;
                                                                                } ?>" onkeyup="calculateSum();" onchange="calculateSum();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="2">
                                            <b><?php echo display('quotation_percentage_discount') ?>:</b>
                                        </td>
                                        <td class="text-right" colspan="2">
                                            <input type="text" id="percentage_discount" class="form-control text-right" name="percentage_discount" placeholder="0 %" onkeyup="calculateSum();" onchange="calculateSum();" data-value="<?= $value['percentage_discount'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="display: none;"  class="text-right" colspan="2">
                                            <b><?php echo display('service_charge') ?>:</b>
                                        </td>
                                        <td style="display: none;"  class="text-right" colspan="2">
                                            <input type="text" id="service_charge" class="form-control text-right" name="service_charge" value="<?php echo html_escape($service_charge) ?>" onkeyup="quantity_calculate();" onchange="quantity_calculate();" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="6" class="text-right"><b><?php echo display('total_quantity') ?> :</b>
                                        </td>
                                        <td class="text-right" colspan="2">
                                            <input type="number" step="1" min="0" id="total_quantity" class="form-control text-right" name="total_quantity" placeholder="0" readonly="readonly" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="text-right"><b><?php echo display('grand_total') ?>:</b>
                                        </td>
                                        <td class="text-right" colspan="2">
                                            <input type="text" id="grandTotal" class="form-control text-right" name="grand_total_price" value="{total_amount}" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="text-right"><b><?php echo display('balance') ?> :</b>
                                        </td>
                                        <td class="text-right" colspan="2">
                                            <input type="text" id="customer_balance" class="form-control text-right" name="customer_balance" placeholder="0.00" readonly="readonly" value="<?=$total_balance?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input class="btn btn-warning" id="full" value="<?php echo display('full_paid') ?>" tabindex="15" onclick="full_paid();" type="button">
                                            <input type="hidden" name="is_installment" id="is_installment" value="0">
                                            <input class="btn btn-warning" id="installment_id" value="<?php echo display('installment') ?>" tabindex="15" onclick="installment();" type="button">

                                            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url(); ?>" />
                                            <input type="hidden" name="quotation_id" id="quotation_id" value="{quotation_id}" />
                                            <input type="hidden" name="quotation" id="quotation" value="{quotation}" />
                                            <input type="hidden" name="status" id="status" value="{status}" />
                                        </td>
                                        <td class="text-right" colspan="5"><b><?php echo display('paid_ammount') ?>:</b>
                                        </td>
                                        <td class="text-right" colspan="2">
                                            <input type="text" id="paidAmount" onkeyup="invoice_paidamount();" class="form-control text-right" name="paid_amount" value="{paid_amount}" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="width_220">
                                            <input type="button" id="add-invoice" class="btn btn-primary payment_button" value="<?php echo display('payment') ?>" />

                                            <input type="button" id="add-invoice_btn" class="btn btn-success" name="add-invoice" onclick="submit_form(event)" value="<?php echo display('submit') ?>" />
                                        </td>
                                        <td class="text-right" colspan="5"><b><?php echo display('due') ?>:</b></td>
                                        <td class="text-right" colspan="2">
                                            <input type="text" id="dueAmmount" class="form-control text-right" name="due_amount" value="{total_amount}" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <!-- Payment method -->
                                    <tr class="payment_method none">
                                        <td colspan="9">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <div class="form-group row">
                                                        <label for="bank_id" class="col-sm-4 col-form-label">
                                                            <?php echo display('bank_list') ?> :
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" name="payment_id" id="payment_id">
                                                                <option value=""></option>
                                                                <?php
                                                                if ($payment_info) {
                                                                    foreach ($payment_info as $payment_method) {
                                                                ?>
                                                                        <option value="<?php echo html_escape($payment_method->HeadCode); ?>">
                                                                            <?php echo html_escape($payment_method->HeadName); ?>
                                                                        </option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <div class="form-group row">
                                                        <!-- <label for="account_no" class="col-sm-4 col-form-label"><?php echo display('account_no') ?>
                                                            :</label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" type="text" name="account_no" id="account_no" placeholder="<?php echo display('account_no') ?>">
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Installment method -->
                                    <tr class="installment_setup none">
                                        <td colspan="10">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label for="bank_id" class="col-sm-4 col-form-label">
                                                            <?php echo display('number_of_month') ?> :
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" onchange="add_month()" type="number" id="month_no" name="month_no">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label for="pay_day" class="col-sm-4 col-form-label"><?php echo display('payment_day') ?>
                                                            :</label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" onchange="add_month()" type="number" max="30" id="pay_day" name="due_day">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="installment_header" class="none">
                                                <div class="row" style="display: flex;justify-content: space-around;">
                                                    <div class="col-sm-4" style="float: none">
                                                        <div class="form-group">
                                                            <label class="col-sm-12 col-form-label" style="text-align: center;"><?php echo display('amount') ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4" style="float: none">
                                                        <div class="form-group">
                                                            <label class="col-sm-12 col-form-label" style="text-align: center;"><?php echo display('due_date') ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="installment_details">

                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
            <!-- view -->
            <div class="modal fade modal-warning" id="viewprom" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title"><?php echo display('product_information') ?></h3>
                        </div>
                        <div class="modal-body">
                            <div id="viewpros" class="card-block">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <input type="hidden" id="cgst_status" value="<?php echo html_escape($tax['cgst_status']); ?>">
            <input type="hidden" id="sgst_status" value="<?php echo html_escape($tax['sgst_status']); ?>">
            <input type="hidden" id="igst_status" value="<?php echo html_escape($tax['igst_status']); ?>">
            <script src="<?php echo MOD_URL . 'dashboard/assets/js/edit_invoice_form_2.js'; ?>"></script>
        </div>
    </section>
</div>
<!-- Edit Quotation End -->
<!--<input type="hidden" id="cgst_status" value="--><?php //echo html_escape($tax['cgst_status']); 
                                                    ?>
<!--">-->
<!--<input type="hidden" id="sgst_status" value="--><?php //echo html_escape($tax['sgst_status']); 
                                                    ?>
<!--">-->
<!--<input type="hidden" id="igst_status" value="--><?php //echo html_escape($tax['igst_status']); 
                                                    ?>
<!--">-->
<!--<script src="--><?php //echo MOD_URL . 'dashboard/assets/js/edit_quotation_form.js'; 
                    ?>
<!--"></script>-->
<!---->
<!--<script src="--><?php //echo MOD_URL 
                    ?>
<!--dashboard/assets/js/edit_quotation_form.js.php"></script>-->
<?php //$this->load->view('quotation/edit_quotation_form_js'); 
?>
<script>
    $(document).ready(function() {
        $(".datepicker2").datepicker({
			dateFormat: "dd-mm-yy"
		});
        $(document).on('change', '#product_type', function() {
            var val = $(this).val();

            // console.log(val, accessories_category_id);
            $('[name="product_rate[]"]').each(function(inx, el) {
                var counter = inx + 1;
                var catId = $('#category_id_' + counter).val();
                // if (catId == accessories_category_id) {
                var price = $('#price_item_' + counter).val();
                // console.log(parseFloat(price));
                if (parseFloat(price) != 0) {
                    // $('#price_item_saved_' + counter).val(price);
                }
                // }

                if (val == '2') {
                    if (catId == accessories_category_id) {
                        $('#price_item_' + counter).val(0);
                        quantity_calculate(counter);
                    }
                } else {
                    if (catId == accessories_category_id) {
                        $('#price_item_' + counter).val($('#price_item_saved_' + counter).val());
                        quantity_calculate(counter);
                    }
                }
            });
        });

        setTimeout(() => {
            $('[name="product_rate[]"]').each(function(inx, el) {
                var counter = inx + 1;

                $('#price_item_saved_' + counter).val($('#price_item_saved_' + counter).attr('data-val'));
            });
        }, 560);
    });
</script>