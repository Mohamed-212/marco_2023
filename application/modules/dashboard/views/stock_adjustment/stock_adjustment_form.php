<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo MOD_URL . 'dashboard/assets/css/stock_adjustment_form.css' ?>">
<!-- Add new customer start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('stock_adjustment') ?></h1>
            <small><?php echo display('stock_adjustment_form') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('stock') ?></a></li>
                <li class="active"><?php echo display('stock_adjustment') ?></li>
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
        <!-- New customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('stock_adjustment_form') ?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('dashboard/Cstock_adjustment/insert_stock_adjustment', array('class' => 'form-vertical', 'id' => 'validate')) ?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="invoice_no"
                                        class="col-sm-4 col-form-label"><?php echo display('store') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="store_id" id="store_id" class="form-control store_id width_100p"
                                            required="">
                                            <option value=""></option>
                                            
                                            <?php if (count($stores) > 0) {
                                                foreach ($stores as $store) { ?>
                                            <option value="<?php echo html_escape($store['store_id']) ?>" <?=$store['default_status'] == 1 ? 'selected' : '' ?> >
                                                <?php echo html_escape($store['store_name']) ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="invoice_no"
                                        class="col-sm-4 col-form-label"><?php echo display('date') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" tabindex="3" class="form-control datepicker2"
                                            autocomplete="off" name="date" placeholder="<?php echo display('date') ?>"
                                            id="invoice_no" required value="<?=date('d-m-Y')?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="adress" class="col-sm-4 col-form-label"><?php echo display('details') ?>
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" tabindex="1" id="adress"
                                            name="adjustment_details" placeholder=" <?php echo display('details') ?>"
                                            rows="1"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive mt_10">
                            <table class="table table-bordered table-hover" id="purchaseTable">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_information') ?><i
                                                class="text-danger">*</i></th>
                                        <th class="text-center" width="130"><?php echo display('variant') ?><i
                                                class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('available_quantity') ?></th>
                                        <th class="text-center"><?php echo display('adjustment_type') ?></th>
                                        <th class="text-center"><?php echo display('adjusted_quantity') ?><i
                                                class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('delete') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="addPurchaseItem">
                                    <tr>
                                        <td>
                                            <input type="text" name="product_name[1]" required
                                                class="form-control product_name productSelection"
                                                onkeyup="product_pur_or_list(1);"
                                                placeholder="<?php echo display('product_name') ?>" id="product_name_1"
                                                tabindex="5">
                                            <input type="hidden" class="autocomplete_hidden_value product_id_1"
                                                name="product_id[1]" id="SchoolHiddenId" />
                                            <input type="hidden" class="sl" value="1">
                                        </td>
                                        <td class="text-center">
                                            <div class="variant_id_div">
                                                <select name="variant_id[1]" id="variant_id_1"
                                                    class="form-control variant_id width_100p" required="">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div id="color_variant_area_1" style="display: none;">
                                                <select name="color_variant[1]" id="color_variant_1"
                                                    class="form-control color_variant width_100p" >
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <input type="number" id="avl_qntt_1" name="previous_quantity[1]"
                                                class="form-control text-right" placeholder="0" readonly />
                                        </td>
                                        <td class="">
                                            <select name="adjustment_type[1]" style="width: 100%" id="adjustment_type"
                                                class="form-control adjustment_type" required="">
                                                <option value=""></option>
                                                <option value="increase"><?php echo display('increase'); ?></option>
                                                <option value="decrease"><?php echo display('decrease'); ?></option>
                                            </select>
                                        </td>
                                        <td class="text-right">
                                            <input type="number" name="adjusted_quantity[1]" id="adjusted_quantity_1"
                                                class="form-control text-right" placeholder="0" min="0" required="" />
                                        </td>
                                        <td>
                                            <button class="btn btn-danger text-right" type="button"
                                                value="<?php echo display('delete') ?>"
                                                onclick="deleteRow(this)"><?php echo display('delete') ?></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <input type="button" id="add-invoice-item"
                                                class="btn -btn-info color4 color5" name="add-invoice-item"
                                                onClick="addStockAdjustmentField('addPurchaseItem');"
                                                value="<?php echo display('add_new_item') ?>" />
                                            <input type="hidden" name="baseUrl" class="baseUrl"
                                                value="<?php echo base_url(); ?>" />
                                        </td>
                                        <td class="text-right"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="submit" id="add-purchase" class="btn btn-primary btn-large"
                                    name="add-purchase" value="<?php echo display('submit') ?>" />
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="<?php echo MOD_URL . 'dashboard/assets/js/stock_adjustment_form.js'; ?>"></script>
<script>
    $(document).ready(function() {
        $(".datepicker2").datepicker({
            dateFormat: "dd-mm-yy"
        });
    });
</script>