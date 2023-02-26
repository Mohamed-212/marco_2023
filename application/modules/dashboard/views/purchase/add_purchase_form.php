<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo MOD_URL . 'dashboard/assets/css/dashboard.css' ?>">


<!-- Add New Purchase Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('add_purchase') ?></h1>
            <small><?php echo display('add_new_purchase') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('purchase') ?></a></li>
                <li class="active"><?php echo display('add_purchase') ?></li>
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
        <div class="row">
            <div class="col-sm-12">
                <div class="column">
                    <?php if ($this->permission->check_label('manage_purchase')->read()->access()) { ?>
                        <a href="<?php echo base_url('dashboard/Cpurchase/manage_purchase') ?>"
                           class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i>
                            <?php echo display('manage_purchase') ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- Add New Purchase -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('add_purchase') ?> (<span style="color:blue" >Default  Currency </span><span style="color:red" >:<?php echo ($def_currency['currency_name']) ?> <?php echo ('-' . $def_currency['currency_icon']) ?></span >)</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open_multipart('dashboard/Cpurchase/insert_purchase', array('class' => 'form-vertical', 'id' => 'validate', 'name' => 'insert_purchase')) ?>
                        <div class="row">
                            <input type="hidden" name="def_currency_id" value="<?php echo ($def_currency['currency_id']) ?>">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="supplier_sss"
                                           class="col-sm-4 col-form-label"><?php echo display('supplier') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="supplier_id" id="supplier_id" class="form-control " required="">
                                            <option value=""><?php echo display('select_one') ?></option>
                                            {all_supplier}
                                            <option value="{supplier_id}">{supplier_name}-({mobile})</option>
                                            {/all_supplier}
                                        </select>
                                    </div>
                                    <!-- <div class="col-sm-3">
                                                                               <a
                                                                                    href="<?php echo base_url('dashboard/Csupplier'); ?>"><?php echo display('add_supplier') ?></a>
                                    </div>-->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date"
                                           class="col-sm-4 col-form-label"><?php echo display('purchase_date') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <?php $date = date('d-m-Y'); ?>
                                        <input type="text" tabindex="3" class="form-control datepicker2"
                                               name="purchase_date" value="<?php echo $date; ?>" id="date" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="invoice_no"
                                           class="col-sm-4 col-form-label"><?php echo display('supplier_invoice_no') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" tabindex="3" class="form-control" name="invoice_no"
                                               placeholder="<?php echo display('supplier_invoice_no') ?>" id="invoice_no"
                                               required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="adress" class="col-sm-4 col-form-label"><?php echo display('details') ?>
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" tabindex="1" id="adress" name="purchase_details"
                                                  placeholder=" <?php echo display('details') ?>" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6" id="-store_hide">
                                <div class="form-group row">
                                    <label for="store_id"
                                           class="col-sm-4 col-form-label"><?php echo display('purchase_to') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="store_id" id="store_id" class="form-control width_100p"
                                                required="">
                                            <option value=""></option>
                                            <?php foreach ($store_list as $store) : ?>
                                                <option value="<?php echo html_escape($store['store_id']) ?>"
                                                        <?php echo ((@$def_store['store_id'] == $store['store_id']) ? 'selected' : '') ?>>
                                                    <?php echo html_escape($store['store_name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="currency"
                                           class="col-sm-4 col-form-label"><?php echo display('currency') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-3">
                                        <select name="currency_id" id="currency_id"   onchange="get_conversion_rate()" class="form-control " required="">
                                            <option value=""><?php echo display('select_one') ?></option>
                                            {all_currency}
                                            <option value="{currency_id}">{currency_name}-({currency_icon})</option>
                                            {/all_currency}
                                        </select>
                                    </div>
                                    <label for="conversion"
                                           class="col-sm-2 col-form-label"> <?php echo display('purchase_rate') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-3">
                                        <input type="number" name="conversion" id="conversion" onchange="get_conversion_rate2()"
                                               class="form-control text-right" placeholder="1" min="1"
                                               required="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="model_no" class="col-sm-4 col-form-label"><?php echo display('item_code')?> </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control"
                                               placeholder="<?php echo display('item_code') ?>" id="model_no"
                                               tabindex="5" autocomplete="off">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="button" class="btn btn-primary btn-large"
                                               onclick="product_per_model();" value="<?php echo display('add') ?>" />
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
                                                                    <th class="text-center"><input type="checkbox" id="all_pro" onclick="select_all();"></th>
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
                                        <input type="button" class="btn btn-primary btn-large"
                                               onclick="add_products_model();" value="<?php echo display('confirm') ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if (check_module_status('woocommerce')) { ?>
                            <div id="store_stock_update"
                                 class="<?php echo (!empty($def_store['store_id']) ? '' : 'none') ?>">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="store_id"
                                                   class="col-sm-4 col-form-label"><?php echo display('stock') ?>
                                            </label>
                                            <div class="col-sm-8">
                                                <div class="checkbox checkbox-success">
                                                    <input id="checkbox2" name="woocom_stock" value="1" type="checkbox">
                                                    <label
                                                        for="checkbox2"><?php echo display('update_woocommerce_stock') ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                "use strict";
                                $(document).ready(function () {
                                    $('#store_id').on('change', function () {
                                        var store_id = $(this).val();
                                        var csrf_test_name = $("#CSRF_TOKEN").val();
                                        $.ajax({
                                            url: base_url + 'dashboard/Cpurchase/check_default_store',
                                            method: 'post',
                                            data: {
                                                csrf_test_name: csrf_test_name,
                                                store_id: store_id
                                            },
                                            success: function (data) {
                                                if (data) {
                                                    $('#store_stock_update').show();
                                                } else {
                                                    $('#store_stock_update').hide();
                                                }
                                            }
                                        });
                                    });
                                });
                            </script>
                        <?php } ?>
                        <div class="table-responsive mt_10">
                            <style>
table#purchaseTable tr, tr th, tr td, td input {
    font-size: 12px !important;
}
                                </style>

                                
                            <table class="table table-bordered table-hover" id="purchaseTable">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 255px;"><?php echo display('item_information') ?> <i
                                                class="text-danger">*</i></th>
                                        <th class="text-center" style="width: 130px;"><?php echo display('size') ?> <i
                                                class="text-danger">*</i></th>
                                        <th hidden="" class="text-center" width="130"><?php echo display('batch_no') ?><i
                                                class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('available_quantity') ?> </th>
                                        <th class="text-center"><?php echo display('quantity') ?> <i
                                                class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('rate') ?> <i
                                                class="text-danger">*</i></th>
                                        <th hidden="" class="text-center"><?php echo display('discount') . ' (%)' ?> </th>
                                        <th hidden="" class="text-center"><?php echo display('vat') . ' (%)' ?> </th>
                                        <th hidden="" class="text-center"><?php echo display('product_vat') ?> </th>
                                        <th class="text-center"><?php echo display('total') ?> </th>
                                        <th class="text-center" colspan="" style="font-size: 9px;"><?php echo display('delete') ?> </th>
                                    </tr>
                                </thead>
                                <tbody id="addPurchaseItem">
                                    <tr>
                                        <td >
                                            <input type="text" name="product_name" required
                                                   class="form-control product_name productSelection"
                                                   onkeyup="product_pur_or_list(1);"
                                                   placeholder="<?php echo display('product_name') ?>" id="product_name_1"
                                                   tabindex="5" autocomplete="off">
                                            <input type="hidden" class="autocomplete_hidden_value product_id_1"
                                                   name="product_id[1]" id="SchoolHiddenId" />
                                            <input type="hidden" class="sl" value="1">
                                            <input type="hidden" name="category_id[1]" id="category_id1" value="">
                                            <input type="hidden" id="color1" value="">
                                            <input type="hidden" name="sizev[1]" id="size1" value="">
                                        </td>
                                        <td class="text-center">
                                            <div id="color_variant_area_1" hidden="">
                                                <select name="color_variant[1]" id="color_variant_1"
                                                        class="form-control color_variant width_100p" disabled="">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="variant_id_div">
                                                <select name="variant_id[1]" id="variant_id_1"
                                                        class="form-control variant_id width_100p" disabled="">
                                                    <option value=""></option>
                                                    <?php foreach ($variant_list as $variant) : ?>
                                                        <option value=" <?php echo html_escape($variant['variant_id']) ?>">
                                                            <?php echo html_escape($variant['variant_name']) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                        </td>
                                        <td class="text-right" hidden="">
                                            <input type="text" id="batch_no_1" required
                                                   class="form-control text-right" value="<?php echo $batch_no ?>1"
                                                   placeholder="0" readonly />
                                            <input type="hidden" id="generated_batch" value="<?php echo $batch_no ?>">
                                        </td>
                                        <td class="text-right" hidden>
<!--                                            <input type="text" id="expiry_date_1" name="expiry_date[1]"-->
<!--                                                   class="form-control datepicker2"-->
<!--                                                   placeholder="--><?php //echo display('enter_expire_date') ?><!--" />-->
                                            <input type="text" id="expiry_date_1"
                                                   class="form-control datepicker2"
                                                   placeholder="<?php echo display('enter_expire_date') ?>" />
                                        </td>
                                        <td class="text-right">
                                            <input type="number" id="avl_qntt_1" class="form-control text-right"
                                                   placeholder="0" readonly />
                                        </td>
                                        <td class="text-right">
                                            <input type="number" name="product_quantity[1]" id="total_qntt_1"
                                                   onkeyup="calculate_add_purchase('1')"
                                                   onchange="calculate_add_purchase('1')"
                                                   class="form-control text-right p_quantity" placeholder="0" min="0"
                                                   required="" />
                                        </td>
                                        <td>
                                            <input type="number" name="product_rate2[1]" id="price_item2_1"
                                                   class="price_item2 text-right form-control" placeholder="0.00"
                                                   onkeyup="calculate_add_purchase('1')"
                                                   onchange="calculate_add_purchase('1')"  min="0"/>
                                            <input type="number" name="product_rate[1]" id="price_item_1"
                                                   class="price_item1 text-right form-control" placeholder="0.00"
                                                   onkeyup="calculate_add_purchase('1')"
                                                   onchange="calculate_add_purchase('1')"
                                                   min="0" readonly=""/>
                                        </td>
                                        <!-- Discount -->
                                        <td hidden="">
                                            <input type="number" onkeyup="calculate_add_purchase(1);"
                                                   onchange="calculate_add_purchase(1);" id="discount2_1"
                                                   class="form-control text-right" placeholder="0.00" min="0" />
                                            <input type="number" name="discount[1]" onkeyup="calculate_add_purchase(1);"
                                                   onchange="calculate_add_purchase(1);" id="discount_1"
                                                   class="form-control text-right" placeholder="0.00" min="0" readonly=""/>
                                        </td>
                                        <td hidden="">
                                            <input type="number" onkeyup="calculate_add_purchase(1);"
                                                   onchange="calculate_add_purchase(1);" id="item_vat_rate2_1"
                                                   class="form-control text-right" placeholder="0.00" min="0" />
                                            <input type="number" name="vat_rate[1]" onkeyup="calculate_add_purchase(1);"
                                                   onchange="calculate_add_purchase(1);" id="item_vat_rate_1"
                                                   class="form-control text-right" placeholder="0.00" min="0" readonly=""/>
                                        </td>
                                        <td hidden="">
                                            <input type="number" name="vat2[1]" id="item_vat2_1"
                                                   class="form-control text-right item_vat2" placeholder="0.00" min="0"
                                                   readonly />
                                            <input type="number" name="vat[1]" id="item_vat_1"
                                                   class="form-control text-right item_vat" placeholder="0.00" min="0"
                                                   readonly />

                                        </td>
                                        <td class="text-right">
<!--                                            <input class="total_price2 text-right form-control" type="text"-->
<!--                                                   name="total_price2[1]" id="total_price2_1" placeholder="0.00"-->
<!--                                                   readonly="readonly" />-->
                                            <input class="total_price2 text-right form-control" type="text"
                                                   id="total_price2_1" placeholder="0.00"
                                                   readonly="readonly" />
                                            <input class="total_price text-right form-control" type="text"
                                                   name="total_price[1]" id="total_price_1" placeholder="0.00"
                                                   readonly="readonly" />
                                        </td>
                                        <td class="text-center" style="font-size: 10px;">
                                            <button class="btn btn-danger text-right btn-sm" type="button"
                                                    value="<?php echo display('delete') ?>"
                                                    onclick="deleteRow(this)">
                                                        <i class="fas fa fa-trash fa-trash-o"></i>
                                                </button>
                                        </td>
                                    </tr>
                                </tbody>
                                
                            </table>

                            <table class="table table-bordered table-hover">
                                
                            <tbody>
                                    <tr>
                                        <td>
                                            <input type="button" id="add-invoice-item"
                                                   class="btn -btn-info color4 color5" name="add-invoice-item"
                                                   onClick="addPurchaseOrderField('addPurchaseItem');"
                                                   value="<?php echo display('add_new_item') ?>" />

                                            <input type="hidden" name="baseUrl" class="baseUrl"
                                                   value="<?php echo base_url(); ?>" />
                                        </td>
                                        <td class="text-right">
                                            <b><?php echo display('sub_total') ?>:</b>
                                        </td>
                                        <td class="text-right">
                                           <input type="text" id="subTotal2" class="text-right form-control"
                                                   placeholder="0.00" readonly="readonly" />
                                            <input type="text" id="subTotal2" class="text-right form-control"
                                                    placeholder="0.00" readonly="readonly" />
                                            <input type="text" id="subTotal" class="text-right form-control"
                                                   name="sub_total_price" placeholder="0.00" readonly="readonly" />
                                        </td>

                                        <th><?php echo display('total_number_of_items') ?></th>
                                        <td><input type="text" id="total_items"
                                                   onchange="calculate_add_purchase_cost(1);"
                                                   class="text-right form-control" name="total_number_of_items"
                                                   placeholder="0.00" readonly="readonly" /></td>
                                        <td class="text-right" hidden="">
                                            <b><?php echo display('total_vat') ?>:</b>
                                        </td>
                                        <td hidden="">
                                            <input type="text" id="total_vat2" class="text-right form-control"
                                                   name="total_purchase_vat2" placeholder="0.00" readonly="readonly" />
                                            <input type="text" id="total_vat" class="text-right form-control"
                                                   name="total_purchase_vat" placeholder="0.00" readonly="readonly" />
                                        </td>
                                        <td>
                                        <b><?php echo display('total_dis') ?>:</b>
                                            <input type="number" id="total_dis2" class="text-right form-control" value=""
                                                   onkeyup="calculate_total();"
                                                   onchange="calculate_total();"
                                                   name="total_purchase_dis2" placeholder="0.00"  />
                                            <input type="number" id="total_dis" class="text-right form-control" value=""
                                                   onkeyup="calculate_total();"
                                                   onchange="calculate_total();"
                                                   name="total_purchase_dis" placeholder="0.00" readonly=""  />
                                        </td>
                                        <td class="text-right">
                                        <b><?php echo display('grand_total') ?>:</b>
<!--                                            <input type="text" id="grandTotal2" class="text-right form-control"-->
<!--                                                   name="grand_total_price2" placeholder="0.00" readonly="readonly" />-->
                                            <input type="text" id="grandTotal2" class="text-right form-control"
                                                    placeholder="0.00" readonly="readonly" />
                                            <input type="text" id="grandTotal" class="text-right form-control"
                                                   name="grand_total_price" placeholder="0.00" readonly="readonly" />
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="7">
                                            <b><?php echo display('proof_of_purchase_expences') ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="7">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo display('expense_name') ?></th>
                                                        <th><?php echo display('expense_value') ?></th>
                                                        <th><?php echo display('method_of_Payment') ?></th>
                                                        <th><?php echo display('action') ?> </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="addPurchaseCost">
                                                    <tr>
                                                        <td class="text-left">
                                                            <input type="text"
                                                                   class="text-right form-control purchase_expences"
                                                                   name="purchase_expences_title_1"
                                                                   placeholder="<?php echo display('please_Provide_expense_name') ?>" />
                                                        </td>
                                                        <td class="text-left">
                                                            <input type="text" onkeyup="calculate_add_purchase_cost(1);"
                                                                   onchange="calculate_add_purchase_cost(1);"
                                                                   id="purchase_expences2_1"
                                                                   class="text-right form-control purchase_expences2"
                                                                   name="purchase_expences2_1" placeholder="0.00" />
                                                            <input type="text" onkeyup="calculate_add_purchase_cost(1);"
                                                                   onchange="calculate_add_purchase_cost(1);"
                                                                   id="purchase_expences_1"
                                                                   class="text-right form-control purchase_expences"
                                                                   name="purchase_expences_1" placeholder="0.00" readonly="" />
                                                        </td>
                                                        <td>
                                                            <select class="form-control dont-select-me"
                                                                    name="bank_id[]">
                                                                <option value="cash"><?php echo display('cash') ?>
                                                                </option>
                                                                <?php
                                                                if ($bank_list) {
                                                                    foreach ($bank_list as $bank) {
                                                                        ?>
                                                                        <option value="<?php echo $bank->bank_id ?>">
                                                                            <?php echo html_escape($bank->bank_name) ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>
                                                        <td class="text-left">
                                                            <button type="button" class="btn btn-success btn-sm"
                                                                    onclick="add_new_p_cost_row('addPurchaseCost');">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th class="text-left"></th>
                                                        <th class="text-left"><?php echo display('total') ?></th>
                                                        <td class="text-left">
                                                            <input type="text" id="purchase_expences2"
                                                                   class="text-right form-control" name="purchase_expences2"
                                                                   placeholder="0.00" readonly />
                                                            <input type="text" id="purchase_expences"
                                                                   class="text-right form-control" name="purchase_expences"
                                                                   placeholder="0.00" readonly />
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <th class="text-center danger">Sunglasses VAT (%)</th>
                                                        <th class="text-center danger">  <input type="number" id="sunglasses_vat"
                                                                                                class="text-right form-control " name="sunglasses_vat"
                                                                                                placeholder="0.00" value="0" />
                                                        </th>
                                                        <th class="text-left"> </th>
                                                        <th class="text-left"> </th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 offset-sm-6">
                                <label for="attachment_file"><?=display('attach_file')?></label>
                                <input type="file" id="attachment_file" name="file" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="submit" id="add-purchase" class="btn btn-primary btn-large"
                                       name="add-purchase" value="<?php echo display('submit') ?>" />
                                <input type="submit" value="<?php echo display('submit_and_add_another') ?>"
                                       name="add-purchase-another" class="btn btn-large btn-success"
                                       id="add-purchase-another">
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Add New Purchase End -->
<script src="<?php echo MOD_URL . 'dashboard/assets/js/add_purchase_form.js'; ?>"></script>
<script>
    $(document).ready(function() {
        $(".datepicker2").datepicker({
			dateFormat: "dd-mm-yy"
		});
    });
</script>