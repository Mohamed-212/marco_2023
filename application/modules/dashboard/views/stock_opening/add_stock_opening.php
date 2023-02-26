<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo MOD_URL . 'dashboard/assets/css/dashboard.css' ?>">

<!-- add_stock_opening Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('stock_opening') ?></h1>
            <small><?php echo display('add_stock_opening') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('stock') ?></a></li>
                <li><a href="#"><?php echo display('stock_opening') ?></a></li>
                <li class="active"><?php echo display('add_stock_opening') ?></li>
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
        <!-- Add New Purchase -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('stock_opening_voucher') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open_multipart('dashboard/cstock_opening/insert_stock_opening', array('class' => 'form-vertical', 'id' => 'validate', 'name' => 'insert_purchase')) ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="voucher_no" class="col-sm-4 col-form-label"><?php echo display('voucher_no') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" tabindex="3" class="form-control" value="<?php echo html_escape($voucher_no) ?>" name="voucher_no" placeholder="<?php echo display('voucher_no') ?>" id="voucher_no" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('voucher_date') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <?php $date = date('d-m-Y'); ?>
                                        <input type="text" tabindex="3" class="form-control datepicker2" name="voucher_date" value="<?php echo html_escape($date); ?>" id="date" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6" id="-store_hide">
                                <div class="form-group row">
                                    <label for="store_id" class="col-sm-4 col-form-label"><?php echo display('enter_to') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="store_id" id="store_id" class="form-control width_100p" required="">
                                            <option value=""></option>
                                            <?php foreach ($store_list as $store) : ?>
                                                <option value="<?php echo html_escape($store['store_id']) ?>" <?php echo ((@$def_store['store_id'] == $store['store_id']) ? 'selected' : '') ?>>
                                                    <?php echo html_escape($store['store_name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="adress" class="col-sm-4 col-form-label"><?php echo display('details') ?>
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" tabindex="1" id="adress" name="voucher_detail" placeholder=" <?php echo display('details') ?>" rows="1"></textarea>
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
                            <table class="table table-bordered table-hover" id="purchaseTable">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="padding: 0px 10rem;"><?php echo display('item_information') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center" width="130"><?php echo display('variant') ?> <i class="text-danger">*</i></th>
                                        <!-- <th class="text-center" width="130"><?php echo display('batch_no') ?><i class="text-danger">*</i></th> -->
                                        <!-- <th class="text-center" width="130"><?php echo display('expire_date') ?></th> -->
                                        <th class="text-center" style="padding: 0 3rem;"><?php echo display('available_quantity') ?> </th>
                                        <th class="text-center" style="padding: 0 3rem;"><?php echo display('quantity') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center" style="padding: 0 3rem;"><?php echo display('rate') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center" style="padding: 0 3rem;"><?php echo display('total') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('delete') ?> </th>
                                    </tr>
                                </thead>
                                <tbody id="addPurchaseItem">
                                    <tr>
                                        <td>
                                            <input type="text" name="product_name" required class="form-control product_name productSelection" onkeyup="product_pur_or_list(1);" placeholder="<?php echo display('product_name_or_item_code') ?>" id="product_name_1" tabindex="5" autocomplete="off">

                                            <input type="hidden" class="autocomplete_hidden_value product_id_1" name="product_id[]" id="SchoolHiddenId" />

                                            <input type="hidden" class="sl" value="1">
                                        </td>

                                        <td class="text-center">
                                            <div class="variant_id_div">
                                                <select name="variant_id[]" id="variant_id_1" class="form-control variant_id width_100p" readonly="" required="">
                                                    <option value=""></option>
                                                    <?php foreach ($variant_list as $variant) : ?>
                                                        <option value="<?php echo html_escape($variant['variant_id']) ?>">
                                                            <?php echo html_escape($variant['variant_name']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <!--                                            <div id="color_variant_area_1">-->
                                            <!--                                                <select name="color_variant[]" id="color_variant_1"-->
                                            <!--                                                    class="form-control color_variant width_100p">-->
                                            <!--                                                    <option value=""></option>-->
                                            <!--                                                </select>-->
                                            <!--                                            </div>-->
                                        </td>
                                        <td class="text-right" style="display: none;">
                                            <input type="text" name="batch_no[]" required id="batch_no_1" class="form-control text-right" value="" placeholder="0" />
                                        </td>
                                        <td class="text-right" style="display: none;">
                                            <input type="text" id="expiry_date_1" name="expiry_date[]" class="form-control datepicker2" placeholder="<?php echo display('enter_expire_date') ?>" />
                                        </td>
                                        <td class="text-right">
                                            <input type="number" id="avl_qntt_1" class="form-control text-right" placeholder="0" readonly />
                                        </td>
                                        <td class="text-right">
                                            <input type="number" name="product_quantity[]" id="total_qntt_1" onkeyup="calculate_add_purchase('1')" onchange="calculate_add_purchase('1')" class="form-control text-right p_quantity" placeholder="0" min="0" required="" />
                                        </td>
                                        <td>
                                            <input type="number" name="product_rate[]" id="price_item_1" class="price_item1 text-right form-control" placeholder="0.00" onkeyup="calculate_add_purchase('1')" onchange="calculate_add_purchase('1')" min="0" />
                                        </td>


                                        <td class="text-right">
                                            <input class="total_price text-right form-control" type="text" name="total_price[]" id="total_price_1" placeholder="0.00" readonly="readonly" />
                                        </td>
                                        <td>
                                            <button class="btn btn-danger text-right" type="button" value="<?php echo display('delete') ?>" onclick="deleteRow(this)"><?php echo display('delete') ?></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                            <input type="button" id="add-invoice-item" class="btn -btn-info color4 color5" name="add-invoice-item" onClick="addPurchaseOrderField('addPurchaseItem');" value="<?php echo display('add_new_item') ?>" />

                                            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url(); ?>" />
                                        </td>
                                        <td class="text-right">
                                            <b><?php echo display('sub_total') ?>:</b>
                                        </td>
                                        <td class="text-right">
                                            <input type="text" id="subTotal" class="text-right form-control" name="sub_total_price" placeholder="0.00" readonly="readonly" />
                                        </td>
                                        <!-- <td></td> -->
                                        <th>Total number of items</th>
                                        <td><input type="text" id="total_items" onchange="calculate_add_purchase_cost(1);" class="text-right form-control" name="sub_total_price" placeholder="0.00" readonly="readonly" /></td>
                                        <td class="text-right">
                                            <b><?php echo display('grand_total') ?>:</b>
                                        </td>
                                        <td class="text-right">
                                            <input type="text" id="grandTotal" class="text-right form-control" name="grand_total_price" placeholder="0.00" readonly="readonly" />
                                        </td>
                                        <!-- <td colspan="2"></td> -->
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="submit" id="add-stock-opening" class="btn btn-primary btn-large" name="add-stock-opening" value="<?php echo display('submit') ?>" />
                                <input type="submit" value="<?php echo display('submit_and_add_another') ?>" name="add-another-stock-opening" class="btn btn-large btn-success" id="add-stock-opening-another">
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- add_stock_opening  End -->
<script src="<?php echo MOD_URL . 'dashboard/assets/js/add_stock_opening.js'; ?>"></script>
<script>
    $(document).ready(function() {
        $(".datepicker2").datepicker({
            dateFormat: "dd-mm-yy"
        });
    });
</script>