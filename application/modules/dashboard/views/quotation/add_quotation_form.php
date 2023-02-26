<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script>
    var products_with_no_quantity = "<?=display('products_with_no_quantity')?>";
    var installment_amount_is_not_valid = "<?=display('installment_total_amount_not_match')?>";
    var payment_bank_not_selected = "<?=display('payment_bank_not_selected')?>";
    var accessories_category_id = 'a';
    var installErr = "<?= display('choose_installment_if_invoice_not_full_paid')?>";
    var noinstallErr = true;
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

<!-- Add New Invoice Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('quotation') ?></h1>
            <small><?php echo display('add_new_quotation') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('quotation') ?></a></li>
                <li class="active"><?php echo display('quotation') ?></li>
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
                </div>
            </div>
        </div>

        <!--Add Invoice -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('quotation') ?></h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('dashboard/Cquotation/insert_quotation', array('class' => 'form-vertical', 'id' => 'validate')) ?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="customer_name" class="col-sm-4 col-form-label"><?php echo display('customer_name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" size="100" value="<?php echo html_escape($customer['customer_name']); ?>" name="customer_name" required class="customerSelection form-control" placeholder='<?php echo display('customer_name_or_phone'); ?>' id="customer_name" autocomplete="off" />
                                        <input id="SchoolHiddenId" value="<?php echo html_escape($customer['customer_id']) ?>" class="customer_hidden_value" type="hidden" name="customer_id" required>
                                    </div>
                                    <!--                                    <div class=" col-sm-3">-->
                                    <!--                                        <input id="myRadioButton_1" type="button"-->
                                    <!--                                               onClick="active_customer('payment_from_1')" id="myRadioButton_1"-->
                                    <!--                                               class="btn btn-success checkbox_account" name="customer_confirm"-->
                                    <!--                                               checked="checked" value="-->
                                    <?php //echo display('new_customer')        
                                    ?>
                                    <!--">-->
                                    <!--                                    </div>-->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('date') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <?php
                                        date_default_timezone_set(DEF_TIMEZONE);
                                        $date = date('d-m-Y');
                                        ?>
                                        <input class="form-control datepicker2" type="text" size="50" name="invoice_date" id="date" required value="<?php echo html_escape($date); ?>" />
                                    </div>
                                </div>
                            </div>
                            <!--                            <div class="col-sm-8" id="payment_from_2">-->
                            <!--                                <div class="form-group row">-->
                            <!--                                    <label for="customer_name_others"-->
                            <!--                                           class="col-sm-3 col-form-label">-->
                            <?php //echo display('customer_name')        
                            ?>
                            <!-- <i-->
                            <!--                                                class="text-danger">*</i></label>-->
                            <!--                                    <div class="col-sm-6">-->
                            <!--                                        <input autofill="off" type="text" size="100" name="customer_name_others"-->
                            <!--                                               placeholder='-->
                            <?php //echo display('customer_name')        
                            ?>
                            <!--'-->
                            <!--                                               id="customer_name_others" class="form-control" />-->
                            <!--                                    </div>-->
                            <!---->
                            <!--                                    <div class="col-sm-3">-->
                            <!--                                        <input onClick="active_customer('payment_from_2')" type="button"-->
                            <!--                                               id="myRadioButton_2" class="checkbox_account btn btn-success"-->
                            <!--                                               name="customer_confirm_others"-->
                            <!--                                               value="-->
                            <?php //echo display('old_customer')        
                            ?>
                            <!--">-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                                <div class="form-group row">-->
                            <!--                                    <label for="customer_name_others_address"-->
                            <!--                                           class="col-sm-3 col-form-label">-->
                            <?php //echo display('mobile')        
                            ?>
                            <!-- </label>-->
                            <!--                                    <div class="col-sm-6">-->
                            <!--                                        <input type="number" size="100" name="customer_mobile_no" class=" form-control"-->
                            <!--                                               placeholder='-->
                            <?php //echo display('mobile')        
                            ?>
                            <!--' id="customer_mobile_no" />-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                                <div class="form-group row">-->
                            <!--                                    <label for="customer_name_others_address"-->
                            <!--                                           class="col-sm-3 col-form-label">-->
                            <?php //echo display('address')        
                            ?>
                            <!-- </label>-->
                            <!--                                    <div class="col-sm-6">-->
                            <!--                                        <input type="text" size="100" name="customer_name_others_address"-->
                            <!--                                               class=" form-control" placeholder='-->
                            <?php //echo display('address')        
                            ?>
                            <!--'-->
                            <!--                                               id="customer_name_others_address" />-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="store_id" class="col-sm-4 col-form-label"><?php echo display('store') ?>
                                        <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="store_id" required="" name="store_id">
                                            <option value=""></option>
                                            <?php
                                            foreach ($store_list as $v_store_list) :
                                                if (1 == $v_store_list['default_status']) {
                                            ?>
                                                    <option value="<?php echo html_escape($v_store_list['store_id']) ?>" <?php echo (empty(@$store_id) ? 'selected' : '') ?>>
                                                        <?php echo html_escape($v_store_list['store_name']) ?></option>
                                                <?php } else {
                                                ?>
                                                    <option value="<?php echo html_escape($v_store_list['store_id']) ?>" <?php echo ((@$store_id == $v_store_list['store_id']) ? 'selected' : '') ?>>
                                                        <?php echo html_escape($v_store_list['store_name']) ?></option>
                                            <?php
                                                }
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--                            <div class="col-sm-6">-->
                            <!--                                <div class="form-group row">-->
                            <!--                                    <label for="date" class="col-sm-4 col-form-label">-->
                            <?php //echo display('date')        
                            ?>
                            <!-- <i-->
                            <!--                                                class="text-danger">*</i></label>-->
                            <!--                                    <div class="col-sm-8">-->
                            <!--                                        --><?php
                                                                            //                                        date_default_timezone_set(DEF_TIMEZONE);
                                                                            //                                        $date = date('m-d-Y');
                                                                            //
                                                                            ?>
                            <!--                                        <input class="form-control datepicker" type="text" size="50" name="invoice_date"-->
                            <!--                                               id="date" required value="-->
                            <?php //echo html_escape($date);        
                            ?>
                            <!--" />-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('employee_name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <?php echo form_dropdown('employee_id', $employee, null, 'class="form-control" id="employee_id" required') ?>
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
                                        <select name="pri_type" id="pri_type" onchange="get_pri_type_rate()" class="form-control " required="">
                                            <?php foreach ($all_pri_type as $pri_type) : ?>
                                                <option value="<?php echo html_escape($pri_type['pri_type_id']) ?>"><?php echo display($pri_type['pri_type_name']) ?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                            <option value="0"><?=display('sell_price')?></option>
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
                                            <option value="1" selected><?php echo display('normal') ?></option>
                                            <option value="2"><?php echo display('assemply') ?></option>
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
                                        <th class="text-center"><?php echo display('price') ?> <i class="text-danger">*</i></th>
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
                                                <select name="color_variant[]" id="variant_color_id_1" class="form-control color_variant width_100p">
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
                                            <input type="hidden" hidden id="price_item_saved_1" value="" />
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
                                            <td class="text-right" colspan="6">
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
                                            <td class="text-right" colspan="6">
                                                <b><?php echo html_escape($tax['igst_name']) ?>
                                                    :</b>
                                            </td>
                                            <td class="text-right">
                                                <input type="text" id="total_igst" class="form-control text-right" name="total_igst" placeholder="0.00" readonly="readonly" />
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td class="text-right" colspan="6">
                                            <b><?php echo display('quotation') ?>:</b>
                                        </td>
                                        <td class="text-right" colspan="2">
                                            <input type="checkbox" id="is_quotation" onclick="check_quotation();" value="0" class="form-control text-right" name="is_quotation" />
                                        </td>
                                    </tr>
                                    <tr>

                                        <td colspan="4" rowspan="4">
                                            <label for="details" class=""><?php echo display('details') ?></label>
                                            <textarea class="form-control" name="details" id="details" rows="6" placeholder="<?php echo display('details') ?>"></textarea>
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
                                            <b><?php echo display('quotation_discount') ?>:</b>
                                        </td>
                                        <td class="text-right" colspan="2">
                                            <input type="text" id="invoice_discount" class="form-control text-right" name="invoice_discount" placeholder="0.00" onkeyup="calculateSum();" onchange="calculateSum();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="2">
                                            <b><?php echo display('quotation_discount_percentage') ?>:</b>
                                        </td>
                                        <td class="text-right" colspan="2">
                                            <input type="text" id="percentage_discount" class="form-control text-right" name="percentage_discount" placeholder="0 %" onkeyup="calculateSum();" onchange="calculateSum();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="display: none;"  class="text-right" colspan="2"><b><?php echo display('service_charge') ?>
                                                :</b></td>
                                        <td style="display: none;"  class="text-right" colspan="2">
                                            <input type="text" id="service_charge" class="form-control text-right" name="service_charge" placeholder="0.00" onkeyup="calculateSum();" onchange="calculateSum();" />
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
                                        <td colspan="2" class="text-right"><b><?php echo display('grand_total') ?> :</b>
                                        </td>
                                        <td class="text-right" colspan="2">
                                            <input type="text" id="grandTotal" class="form-control text-right" name="grand_total_price" placeholder="0.00" readonly="readonly" />
                                            <!-- <input type="hidden" hidden id="paidAmount" class="form-control text-right" name="paid_amount" placeholder="0.00" value="0" readonly="readonly" /> -->
                                            <!-- <input type="hidden" hidden id="dueAmmount" class="form-control text-right" name="due_amount" placeholder="0.00" readonly="readonly" value="0" /> -->
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
                                        <td align="center" class="width_220">
                                            <input type="button" id="add-invoice-item" class="btn btn-info color4 color5" name="add-invoice-item" onClick="addInputField('addinvoiceItem');" value="<?php echo display('add_new_item') ?>" />
                                            <input type="button" id="add-invoice_btn" class="btn btn-success" name="add-invoice" onclick="submit_form(event)" value="<?php echo display('submit') ?>" />
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
    });
</script>