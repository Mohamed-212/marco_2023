<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script>
    var products_with_no_quantity = "<?=display('products_with_no_quantity')?>";
    var installment_amount_is_not_valid = "<?=display('installment_total_amount_not_match')?>";
    var payment_bank_not_selected = "<?=display('payment_bank_not_selected')?>";
    var add_order_only = true;
    var accessories_category_id = 'a';
    <?php
        $access = $this->db->select('category_id')->from('product_category')->where('category_name', 'ACCESSORIES')->get()->row();
        echo "accessories_category_id = '" . $access->category_id . "';";
    ?>
</script>
<!-- Customer js php -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/customer.js.php"></script>
<!-- Product invoice js -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/product_invoice.js.php"></script>
<!-- Invoice js -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/order.js" type="text/javascript"></script>

<script src="<?php echo MOD_URL . 'dashboard/assets/js/add_invoice_form.js'; ?>"></script>
<link rel="stylesheet" href="<?php echo MOD_URL . 'dashboard/assets/css/invoice/add_invoice_form.css' ?>">

<!-- Add New Invoice Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display(isset($order) ? 'new_order' : 'new_invoice') ?></h1>
            <small><?php echo display(isset($order) ? 'add_new_order' : 'add_new_invoice') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display(isset($order) ? 'order' : 'invoice') ?></a></li>
                <li class="active"><?php echo display(isset($order) ? 'new_order' : 'new_invoice') ?></li>
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

        <div class="row">
            <div class="col-sm-12">
                <div class="column">
                    <?php if (isset($order)) : ?>
                        <?php if ($this->permission->check_label('manage_order')->read()->access()) { ?>
                            <a href="<?php echo base_url('customer/order/manage_order') ?>" class="btn btn-primary color4 color5 m-b-5 m-r-2"><i class="ti-align-justify"> </i>
                                <?php echo display('manage_order') ?></a>
                        <?php
                        } ?>
                    <?php else : ?>
                        <?php if ($this->permission->check_label('manage_sale')->read()->access()) { ?>
                            <a href="<?php echo base_url('dashboard/' . ($this->auth->is_store() ? 'Store_invoice' : 'Cinvoice') . '/manage_invoice') ?>" class="btn btn-primary color4 color5 m-b-5 m-r-2"><i class="ti-align-justify"> </i>
                                <?php echo display('manage_invoice') ?></a>
                        <?php
                        }
                        if ($this->permission->check_label('pos_sale')->read()->access()) {
                        ?>
                            <!--                        <a href="<?php echo base_url('dashboard/' . ($this->auth->is_store() ? 'Store_invoice' : 'Cinvoice') . '/pos_invoice') ?>"
                           class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"> </i>
                        <?php echo display('pos_invoice') ?></a>-->
                        <?php } ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!--Add Invoice -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display(isset($order) ? 'new_order' : 'new_invoice') ?></h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart(isset($order) ? 'dashboard/Corder/insert_order' : 'dashboard/Cinvoice/insert_invoice', array('class' => 'form-vertical', 'id' => 'validate', 'name' => isset($order) ? 'insert_order' : 'insert_invoice')) ?>
                    <div class="panel-body">
                        <!-- Input hidden value start-->
            <?php 
                
                date_default_timezone_set(DEF_TIMEZONE); $date = date('d-m-Y'); 
                                $result = $this->db->select('*')
                                                ->from('store_set')
                                                ->where('default_status','1')
                                                ->get()
                                                ->row();

                                $emp = $this->db->select('id')
                                    ->from('employee_history')
                                    ->where('first_name', 'Website')
                                    ->get()
                                    ->row();
                            ?>
                            <input type="hidden" name="invoice_date" value="<?php echo html_escape($date); ?>" />
                            <input type="hidden" name="customer_id" value="<?php echo $this->session->userdata('customer_id')?>">
                            <input type="hidden" name="store_id" id="store_id" value="<?php echo html_escape($result->store_id)?>">
                            <input type="hidden" name="pri_type" id="pri_type" value="1">
                            <input type="hidden" name="product_type" id="product_type" value="1">
                            <input type="hidden" name="employee_id" id="product_type" value="<?=$emp->id?>">
                            <!-- Input hidden value end-->

                        
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
                            <table class="table table-bordered table-hover" id="normalinvoice">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_information') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center" width="130"><?php echo display('size') ?> <i class="text-danger">*</i></th>
                                        <!--                                    <th class="text-center" width="130"><?php echo display('pricing') ?> </th>-->
                                        <!--                                        <th class="text-center" width="130"><?php echo display('batch_no') ?> <i
                                                class="text-danger">*</i></th>-->
                                        <th class="text-center"><?php echo display('available_quantity') ?></th>
                                        <!--                                    <th class="text-center">--><?php //echo display('unit') 
                                                                                                            ?>
                                        <!--</th>-->
                                        <th class="text-center"><?php echo display('quantity') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('rate') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('discount') ?> </th>
                                        <th class="text-center"><?php echo display('total') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="addinvoiceItem">
                                    <tr>
                                        <td>
                                            <input type="text" name="product_name" onkeyup="invoice_productList(1);" class="form-control productSelection" placeholder='<?php echo display('product_name') ?>' required="" id="product_name_1">

                                            <input type="hidden" class="autocomplete_hidden_value product_id_1" name="product_id[]" />

                                            <input type="hidden" class="sl" value="1">
                                            <input type="hidden" name="assembly[]" id="assembly1" value="">
                                            <input type="hidden" name="colorv[]" id="color1" value="">
                                            <input type="hidden" name="sizev[]" id="size1" value="">
                                            <input type="hidden" class="baseUrl" value="<?php echo base_url(); ?>" />
                                            <input type="hidden" hidden name="category_id" id="category_id_1" value="" />
                                            <input type="hidden" hidden name="product_model" id="product_model_1" value="" />

                                            <div id="viewassembly1" class="text-center hidden">
                                                <a style="color: blue" href="" data-toggle="modal" data-target="#viewprom" onclick="viewpro(1)">view products </a>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div hidden="">
                                                <select name="color_variant[]" id="variant_color_id_1" class="form-control color_variant width_100p" style="display: none;">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="variant_id_div">
                                                <select name="variant_id[]" id="variant_id_1" class="form-control variant_id width_100p" disabled="">
                                                    <option value=""></option>
                                                </select>
                                            </div>

                                        </td>
                                        <!--                                    <td class="text-center">
                                                                            <div>
                                                                                <select name="pricing[]" id="pricing_1"
                                                                                        class="form-control pricing width_100p" >
                                                                                    <option value=""></option>
                                                                                </select>
                                                                            </div>
                                                                        </td>-->
                                        <td hidden="" class="text-center">
                                            <div>
                                                <select name="batch_no[]" id="batch_no_1" class="form-control batch_no width_100p">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="available_quantity[]" class="form-control text-right available_quantity_1" id="avl_qntt_1" placeholder="0" readonly="" />
                                        </td>
                                        <!--                                    <td>-->
                                        <!--                                        <input type="text" id="" class="form-control text-right unit_1"-->
                                        <!--                                               placeholder="None" readonly=""/>-->
                                        <!--                                    </td>-->
                                        <td>
                                            <input type="number" name="product_quantity[]" onkeyup="quantity_calculate(1);" onchange="quantity_limit(1);" id="total_qntt_1" class="form-control text-right" value="0" min="0" required="" />
                                        </td>
                                        <td>
                                            <input type="number" name="product_rate[]" onkeyup="quantity_calculate(1);" onchange="quantity_calculate(1);" placeholder="0.00" id="price_item_1" class="price_item1 form-control text-right" required="" min="0" readonly="readonly" />
                                        </td>
                                        <!-- Discount -->
                                        <td>
                                            <input type="number" name="discount[]" onkeyup="quantity_calculate(1);" onchange="quantity_calculate(1);" id="discount_1" class="form-control text-right" placeholder="0.00" min="0" />
                                        </td>

                                        <td>
                                            <input class="total_price form-control text-right" type="text" name="total_price[]" id="total_price_1" placeholder="0.00" readonly="readonly" />
                                        </td>

                                        <td>
                                            <?php
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
                                                <input type="hidden" id="cgst_1" class="cgst" />
                                                <input type="hidden" id="total_cgst_1" class="total_cgst" name="cgst[]" />
                                                <input type="hidden" name="cgst_id[]" id="cgst_id_1">
                                            <?php
                                            }
                                            if ($tax['sgst_status'] == 1) {
                                            ?>
                                                <input type="hidden" id="sgst_1" class="sgst" />
                                                <input type="hidden" id="total_sgst_1" class="total_sgst" name="sgst[]" />
                                                <input type="hidden" name="sgst_id[]" id="sgst_id_1">
                                            <?php
                                            }
                                            if ($tax['igst_status'] == 1) {
                                            ?>
                                                <input type="hidden" id="igst_1" class="igst" />
                                                <input type="hidden" id="total_igst_1" class="total_igst" name="igst[]" />
                                                <input type="hidden" name="igst_id[]" id="igst_id_1">
                                            <?php } ?>
                                            <!-- Tax calculate end -->

                                            <!-- Discount calculate start-->
                                            <input type="hidden" id="total_discount_1" class="" />
                                            <input type="hidden" id="all_discount_1" class="total_discount" />
                                            <!-- Discount calculate end -->

                                            <button class="btn btn-danger text-right" type="button" value="<?php echo display('delete') ?>" onclick="deleteRow(this)"><?php echo display('delete') ?>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <?php if ($tax['cgst_status'] == 1) { ?>
                                        <tr>

                                            <td class="text-right" colspan="6">
                                                <b><?php echo html_escape($tax['cgst_name']) ?>:</b>
                                            </td>
                                            <td class="text-right" colspan="2">
                                                <input type="number" id="total_cgst" class="form-control text-right" name="total_cgst" placeholder="0.00" readonly="readonly" />
                                            </td>
                                        </tr>

                                    <?php
                                    }
                                    if ($tax['sgst_status'] == 1) {
                                    ?>
                                        <tr>
                                            <td class="text-right" colspan="8">
                                                <b><?php echo html_escape($tax['sgst_name']) ?>
                                                    :</b>
                                            </td>
                                            <td class="text-right">
                                                <input type="text" id="total_sgst" class="form-control text-right" name="total_sgst" placeholder="0.00" readonly="readonly" />
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    if ($tax['igst_status'] == 1) {
                                    ?>
                                        <tr>
                                            <td class="text-right" colspan="8">
                                                <b><?php echo html_escape($tax['igst_name']) ?>
                                                    :</b>
                                            </td>
                                            <td class="text-right">
                                                <input type="text" id="total_igst" class="form-control text-right" name="total_igst" placeholder="0.00" readonly="readonly" />
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td class="text-center" colspan="1">
                                            <input type="button" id="add-invoice-item" class="btn btn-info color4 color5" name="add-invoice-item" onClick="addInputField('addinvoiceItem');" value="<?php echo display('add_new_item') ?>" />
                                        </td>
                                        <td class="text-right" colspan="5">
                                            <b><?php echo display('quotation') ?>:</b>
                                        </td>
                                        <td class="text-right" colspan="2">
                                            <input type="checkbox" id="is_quotation" onclick="check_quotation();" value="0" class="form-control text-right" name="is_quotation" />
                                        </td>
                                    </tr>
                                    <tr>

                                        <td colspan="4" rowspan="5">
                                            <label for="invoice_details" class=""><?php echo display(isset($order) ? 'order_details' : 'invoice_details') ?></label>
                                            <textarea class="form-control" name="invoice_details" id="invoice_details" rows="6" placeholder="<?php echo display(isset($order) ? 'details' : 'invoice_details') ?>"></textarea>
                                        </td>

                                        <td class="text-right" colspan="2">
                                            <b><?php echo display('product_discount') ?>:</b>
                                        </td>
                                        <td class="text-right" colspan="2">
                                            <input type="text" id="total_discount_ammount" class="form-control text-right" name="total_discount" placeholder="0.00" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="2">
                                            <b><?php echo display(isset($order) ? 'order_discount' : 'invoice_discount') ?>:</b>
                                        </td>
                                        <td class="text-right" colspan="2">
                                            <input type="text" id="invoice_discount" class="form-control text-right" name="invoice_discount" placeholder="0.00" onkeyup="calculateSum();" onchange="calculateSum();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="2">
                                            <b><?php echo display('order_discount_percentage') ?>:</b>
                                        </td>
                                        <td class="text-right" colspan="2">
                                            <input type="text" id="percentage_discount" class="form-control text-right" name="percentage_discount" placeholder="0 %" onkeyup="calculateSum();" onchange="calculateSum();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="2"><b><?php echo display('service_charge') ?>
                                                :</b></td>
                                        <td class="text-right" colspan="2">
                                            <input type="text" id="service_charge" class="form-control text-right" name="service_charge" placeholder="0.00" onkeyup="calculateSum();" onchange="calculateSum();" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                    <?php if (!isset($order)) : ?>
                                        <td class="text-right" colspan="2">
                                            <b><?php echo display('shipping_charge') ?>
                                                :</b>
                                            <select name="shipping_method" id="shipping_method" class="form-control">
                                                <option value=""></option>
                                                <?php foreach ($shipping_methods as $shipping_method) : ?>
                                                    <option value="<?php echo html_escape($shipping_method['method_id']); ?>" data-amount="<?php echo html_escape($shipping_method['charge_amount']); ?>">
                                                        <?php echo html_escape($shipping_method['method_name']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td class="text-right" colspan="2">
                                            <input type="text" id="shipping_charge" class="form-control text-right" name="shipping_charge" onkeyup="calculateSum();" placeholder="0.00" />
                                        </td>
                                        <?php endif?>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="6" class="text-right"><b><?php echo display('grand_total') ?> :</b>
                                        </td>
                                        <td class="text-right" colspan="2">
                                            <input type="text" id="grandTotal" class="form-control text-right" name="grand_total_price" placeholder="0.00" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url(); ?>" />
                                            <input class="btn btn-warning" id="full" value="<?php echo display('full_paid') ?>" tabindex="15" onclick="full_paid();" type="button">

                                            <input type="hidden" name="is_installment" id="is_installment" value="0">
                                            <?php if (!isset($order)) : ?>
                                                <input class="btn btn-primary" id="installment_id" value="<?php echo display('installment') ?>" tabindex="15" onclick="installment();" type="button">
                                            <?php endif ?>

                                        </td>
                                        <td class="text-right" colspan="5"><b><?php echo display('paid_ammount') ?>
                                                :</b></td>
                                        <td class="text-right" colspan="2">
                                            <input type="text" id="paidAmount" onkeyup="invoice_paidamount();" class="form-control text-right" name="paid_amount" placeholder="0.00" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="width_220">
                                            <?php if (!isset($order)) : ?>
                                                <input type="button" id="add-invoice" class="btn btn-primary payment_button" value="<?php echo display('payment') ?>" />
                                            <?php endif ?>
                                            <input type="button" id="add-invoice_btn" class="btn btn-success" name="add-invoice" onclick="submit_form();" value="<?php echo display('submit') ?>" />
                                        </td>
                                        <td class="text-right" colspan="5"><b><?php echo display('due') ?>:</b></td>
                                        <td class="text-right" colspan="2">
                                            <input type="text" id="dueAmmount" class="form-control text-right" name="due_amount" placeholder="0.00" readonly="readonly" />
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
                                                                <option value="000"></option>
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
                                                    <!-- <div class="form-group row">
                                                        <label for="account_no" class="col-sm-4 col-form-label"><?php echo display('account_no') ?>
                                                            :</label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" type="text" name="account_no" id="account_no" placeholder="<?php echo display('account_no') ?>">
                                                        </div>
                                                    </div> -->
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
            <script src="<?php echo MOD_URL . 'dashboard/assets/js/add_invoice_form_2.js'; ?>"></script>
        </div>
    </section>
</div>
<!-- Invoice Report End -->
<script>
    $(document).ready(function() {
        $(".datepicker2").datepicker({
			dateFormat: "dd-mm-yy"
		});
    });

    var csrf_test_name = $("#CSRF_TOKEN").val();
//Add invocie row field
function addInputField(t) {
    //Variable declaratipn
    alert('asdasdasd');
    var count = 2,
            limits = 500;

    if (count == limits)
        alert("You have reached the limit of adding " + count + " inputs");
    else {
        var a = "product_name" + count,
                e = document.createElement("tr");
        //e.innerHTML = "<td><input type='text' name='product_name' placeholder='Product Name' onkeypress='invoice_productList(" + count + ");' class='form-control productSelection' required='' id='product_name" + count + "' ><input type='hidden' class='autocomplete_hidden_value product_id_" + count + "' name='product_id[]' id='SchoolHiddenId'/></td><td><input type='text' name='available_quantity[]' id='' class='form-control text-right available_quantity_" + count + "' placeholder='0' readonly='' /></td><td><input type='text' class='form-control text-right unit_" + count + "' placeholder='None' readonly='' /></td><td><input type='number' name='product_quantity[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' id='total_qntt_" + count + "' class='form-control text-right' value='1' min='1' /></td><td><input type='number' name='product_rate[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' placeholder='0.00' min='0' id='price_item_" + count + "' class='price_item" + count + " form-control text-right' required='' /></td><td><input type='number' name='discount[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' id='discount_" + count + "' class='form-control text-right' placeholder='0.00' min='0' /></td><td><input class='total_price form-control text-right' type='text' name='total_price[]' id='total_price_" + count + "' placeholder='0.00' tabindex='' readonly='readonly' /></td><td><input type='hidden' id='cgst_" + count + "' class='cgst'/> <input type='hidden' id='sgst_" + count + "' class='sgst'/><input type='hidden' id='igst_" + count + "' class='igst'/><input type='hidden' id='total_cgst_" + count + "' class='total_cgst' name='cgst[]' /><input type='hidden' id='total_sgst_" + count + "' class='total_sgst' name='sgst[]'/><input type='hidden' id='total_igst_" + count + "' class='total_igst' name='igst[]'/><input type='hidden' name='cgst_id[]' id='cgst_id_" + count + "'><input type='hidden' name='sgst_id[]' id='sgst_id_" + count + "'><input type='hidden' name='igst_id[]' id='igst_id_" + count + "'><input type='hidden' name='variant_id[]' id='variant_" + count + "'><input type='hidden' id='total_discount_" + count + "' /><input type='hidden' id='all_discount_" + count + "' class='total_discount'/><button style='text-align: right;' class='btn btn-danger' type='button' value='Delete' onclick='deleteRow(this)'>Delete</button></td>", document.getElementById(t).appendChild(e), document.getElementById(a).focus(), count++
        e.innerHTML = "<td><input type='text' name='product_name' placeholder='Product Name' onkeypress='invoice_productList(" + count + ");' class='form-control productSelection' required='' id='product_name" + count + "' ><input type='hidden' class='autocomplete_hidden_value product_id_" + count + "' name='product_id[]' id='SchoolHiddenId'/></td><td><input type='text' name='available_quantity[]' id='' class='form-control text-right available_quantity_" + count + "' placeholder='0' readonly='' /></td><td><input type='number' name='product_quantity[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' id='total_qntt_" + count + "' class='form-control text-right' value='1' min='1' /></td><td><input type='number' name='product_rate[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' placeholder='0.00' min='0' id='price_item_" + count + "' class='price_item" + count + " form-control text-right' required='' /></td><td><input type='number' name='discount[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' id='discount_" + count + "' class='form-control text-right' placeholder='0.00' min='0' /></td><td><input class='total_price form-control text-right' type='text' name='total_price[]' id='total_price_" + count + "' placeholder='0.00' tabindex='' readonly='readonly' /></td><td><input type='hidden' id='cgst_" + count + "' class='cgst'/> <input type='hidden' id='sgst_" + count + "' class='sgst'/><input type='hidden' id='igst_" + count + "' class='igst'/><input type='hidden' id='total_cgst_" + count + "' class='total_cgst' name='cgst[]' /><input type='hidden' id='total_sgst_" + count + "' class='total_sgst' name='sgst[]'/><input type='hidden' id='total_igst_" + count + "' class='total_igst' name='igst[]'/><input type='hidden' name='cgst_id[]' id='cgst_id_" + count + "'><input type='hidden' name='sgst_id[]' id='sgst_id_" + count + "'><input type='hidden' name='igst_id[]' id='igst_id_" + count + "'><input type='hidden' name='variant_id[]' id='variant_" + count + "'><input type='hidden' id='total_discount_" + count + "' /><input type='hidden' id='all_discount_" + count + "' class='total_discount'/><button style='text-align: right;' class='btn btn-danger' type='button' value='Delete' onclick='deleteRow(this)'>Delete</button></td>", document.getElementById(t).appendChild(e), document.getElementById(a).focus(), count++
    }
}
</script>