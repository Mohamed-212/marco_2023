<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link href="<?php echo MOD_URL . 'dashboard/assets/css/add_product_form.css'; ?>" rel="stylesheet" type="text/css" />
<!-- Assemply Product  js -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/assemply_product.js.php"></script>
<!--  Assemply Product js -->
<!-- Add Product Form Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('new_product') ?></h1>
            <small><?php echo display('add_new_product') ?></small>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('') ?>">
                        <i class="pe-7s-home"></i> <?php echo display('home') ?></a>
                </li>
                <li>
                    <a href="<?php echo base_url('dashboard/Cproduct') ?>"><?php echo display('product') ?></a>
                </li>
                <li class="active"><?php echo display('new_product') ?></li>
            </ol>
        </div>
    </section>

    <!-- Main content -->
    <div class="content">
        <?php if (validation_errors()) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo validation_errors(); ?>
                <!-- Alert Message -->
            </div>
        <?php } ?>

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
        <!-- Add Product Form -->
        <div class="row">
            <div class="col-sm-12">
                <div class="column">
                    <!-- All modals added here for the demo. You would of course just have one, dynamically created -->
                    <!-- Modal fade in & scale effect -->
                    <div class="md-modal md-effect-1" id="modal-1">
                        <div class="md-content">
                            <h3><?php echo display('add_supplier') ?></h3>
                            <div class="n-modal-body">
                                <h4 class="text-success prodcsvtext" id="message"></h4>
                                <h4 class="text-danger prodcsvtext" id="error_message"></h4>
                                <?php echo form_open("dashboard/Cproduct/add_supplier", array('class' => 'add_supplier', 'id' => 'add_supplier')); ?>
                                <div class="panel-body">
                                    <div class="form-group row">
                                        <label for="supplier_name"
                                               class="col-sm-4 col-form-label"><?php echo display('supplier_name') ?> <i
                                                class="text-danger">*</i></label>
                                        <div class="col-sm-6">
                                            <input class="form-control" name="supplier_name" id="supplier_name"
                                                   type="text" placeholder="<?php echo display('supplier_name') ?>"
                                                   required="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="mobile"
                                               class="col-sm-4 col-form-label"><?php echo display('supplier_mobile') ?> <i
                                                class="text-danger">*</i></label>
                                        <div class="col-sm-6">
                                            <input class="form-control" name="mobile" id="mobile" type="number"
                                                   placeholder="<?php echo display('supplier_mobile') ?>" required=""
                                                   min="0">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="address "
                                               class="col-sm-4 col-form-label"><?php echo display('supplier_address') ?></label>
                                        <div class="col-sm-6">
                                            <textarea class="form-control" name="address" id="address " rows="3"
                                                      placeholder="<?php echo display('supplier_address') ?>"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="details"
                                               class="col-sm-4 col-form-label"><?php echo display('supplier_details') ?></label>
                                        <div class="col-sm-6">
                                            <textarea class="form-control" name="details" id="details" rows="3"
                                                      placeholder="<?php echo display('supplier_details') ?>"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                                        <div class="col-sm-6">
                                            <input type="submit" id="add-supplier" class="btn btn-primary btn-large"
                                                   name="add-supplier" value="<?php echo display('save') ?>" />
                                            <input type="button" class="btn btn-success md-close"
                                                   value="<?php echo display('close') ?>" />
                                        </div>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="md-modal md-effect-1" id="modal-2">
                        <div class="md-content">
                            <h3><?php echo display('add_category') ?></h3>
                            <div class="n-modal-body">
                                <h4 class="text-success prodcsvtext" id="message1"></h4>
                                <h4 class="text-danger prodcsvtext" id="error_message1"></h4>
                                <?php echo form_open("dashboard/Cproduct/insert_category", array('id' => 'add_category')); ?>
                                <div class="panel-body">
                                    <div class="form-group row">
                                        <label for="category_name"
                                               class="col-sm-4 col-form-label"><?php echo display('category_name') ?> <i
                                                class="text-danger">*</i></label>
                                        <div class="col-sm-6">
                                            <input class="form-control" name="category_name" id="category_name"
                                                   type="text" placeholder="<?php echo display('category_name') ?>"
                                                   required="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                                        <div class="col-sm-6">
                                            <input type="submit" id="add-supplier" class="btn btn-primary btn-large"
                                                   name="add-supplier" value="<?php echo display('save') ?>" />
                                            <input type="button" class="btn btn-success md-close"
                                                   value="<?php echo display('close') ?>" />
                                        </div>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
<!--                    <button class="btn btn-success md-trigger m-b-5 m-r-2" data-modal="modal-1">
                        <i class="ti-plus"></i><span> <?php echo display('add_supplier') ?></span></button>
                    <button class="btn btn-info color4 color5 md-trigger m-b-5 m-r-2" data-modal="modal-2"><i
                            class="ti-plus"></i> <?php echo display('add_category') ?></button>-->
                        <?php if ($this->permission->check_label('manage_product')->read()->access()) { ?>
                        <a href="<?php echo base_url('dashboard/Cproduct/manage_product') ?>"
                           class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"></i>
                            <?php echo display('manage_product') ?></a>
                        <?php
                    }
                    if ($this->permission->check_label('import_product_csv')->create()->access()) {
                        ?>
<!--                        <a href="<?php echo base_url('dashboard/Cproduct/add_product_csv') ?>"
                           class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"></i>
                            <?php echo display('import_product_csv') ?></a>-->
                        <?php
                    }
                    if ($this->permission->check_label('manage_product')->read()->access()) {
                        ?>
                        <a href="<?php echo base_url('dashboard/Cproduct/product_details_single') ?>"
                           class="btn btn-warning m-b-5 m-r-2"><i class="ti-align-justify">
                            </i><?php echo display('product_ledger') ?></a>
                    <?php } ?>

                    <!-- the overlay element -->
                    <div class="md-overlay"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('new_product') ?></h4>
                        </div>
                    </div>

                    <?php echo form_open_multipart('dashboard/Cproduct/insert_product', array('class' => '', 'id' => 'commentForm')) ?>
                    <div class="panel-body">
                        <div id="rootwizard">
                            <div class="navbar">
                                <div class="navbar-inner form-wizard">
                                    <ul class="nav nav-pills nav-justified steps">
                                        <li>
                                            <a href="#tab1" data-toggle="tab" class="step" aria-expanded="true">
                                                <span class="number"> <?php echo display('1') ?> </span>
                                                <span class="desc"><?php echo display('item_information') ?> </span>
                                            </a>
                                        </li>
                                        <!-- <li>
                                            <a href="#tab2" data-toggle="tab" class="step" aria-expanded="true">
                                                <span class="number"> <?php echo display('2') ?> </span>
                                                <span class="desc"><?php echo display('assembly') ?></span>
                                            </a>
                                        </li> -->
                                        <li>
                                            <a href="#tab2" data-toggle="tab" class="step" aria-expanded="true">
                                                <span class="number"> <?php echo display('2') ?> </span>
                                                <span class="desc"><?php echo display('price') ?></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab3" data-toggle="tab" class="step" aria-expanded="true">
                                                <span class="number"> <?php echo display('3') ?> </span>
                                                <span class="desc"><?php echo display('image') ?></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab4" data-toggle="tab" class="step" aria-expanded="true">
                                                <span class="number"> <?php echo display('5') ?> </span>
                                                <span class="desc"><?php echo display('web_store') ?></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab6" data-toggle="tab" class="step" aria-expanded="true">
                                                <span class="number"> <?php echo display('6') ?> </span>
                                                <span class="desc"><?php echo display('product_translation') ?></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div id="bar" class="progress">
                                <div class="progress-bar progress-bar-success progress-bar-striped width_0p active"
                                     role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane" id="tab1">
                                    <div class="row">
                                        
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="brand"
                                                       class="col-sm-3 col-form-label"><?php echo display('brand') ?></label>
                                                <div class="col-sm-9">
                                                    <select class="form-control select2 width_100p" id="brand"
                                                            name="brand" data-tags="true">
                                                        <option value=""><?php echo display('select_one') ?></option>
                                                        <?php foreach ($brand_list as $brand) { ?>
                                                            <option value="<?php echo html_escape($brand['brand_id']); ?>">
                                                                <?php echo html_escape($brand['brand_name']); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row hidden">
                                                <label for="bar_code"
                                                       class="col-sm-3 col-form-label"><?php echo display('bar_code') ?></label>
                                                <div class="col-sm-9">
                                                    <input type="number" id="bar_code" name="bar_code"
                                                           placeholder="<?php echo display('please_enter_bar_code'); ?>"
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="product_model"
                                                       class="col-sm-3 col-form-label"><?php echo display('item_code') ?>
                                                    <span class="color-red">*</span></label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" name="product_model_only" autofocus
                                                           type="text" id="product_model" required=""
                                                           placeholder="<?php echo display('product_model') ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="color"
                                                       class="col-sm-3 col-form-label"><?php echo display('color') ?>
                                                    <span class="color-red">*</span></label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" name="pcolor" autofocus
                                                           type="text" id="color" required=""
                                                           placeholder="<?php echo display('color') ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                         <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="variant"
                                                       class="col-sm-3 col-form-label"><?php echo display('size') ?> <span
                                                        class="color-red">*</span></label>
                                                <div class="col-sm-9 custom_select">
                                                    <select name="variant[]" class="form-control select2" data-tags="true" required=""
                                                            id="variant">
                                                        <option></option>
                                                        <?php
                                                        if ($variant_list) {
                                                            foreach ($variant_list as $variant) {
                                                                if ($variant['variant_type'] == 'size') {
                                                                    ?>
                                                                    <option value="<?php echo html_escape($variant['variant_id']) ?>">
                                                                        <?php echo html_escape($variant['variant_name']); ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row hidden">
                                                <label for="default_variant"
                                                       class="col-sm-3 col-form-label"><?php echo display('default_variant') ?>
                                                    <span class="color-red">*</span></label>
                                                <div class="col-sm-9 custom_select">
                                                    <select name="default_variant" class="form-control select2" required=""
                                                            id="default_variant">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                          <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="category_id"
                                                       class="col-sm-3 col-form-label"><?php echo display('category') ?>
                                                    <span class="color-red">*</span></label>
                                                <div class="col-sm-9">
                                                    <select class="form-control select2 width_100p find_filter"
                                                            id="category_id" name="category_id" data-tags="true" required="">
                                                        <option value=""><?php echo display('select_one') ?></option>
                                                        <?php
                                                        if ($category_list) {
                                                            foreach ($category_list as $category) {
                                                                ?>
                                                                <option
                                                                    value="<?php echo html_escape($category['category_id']) ?>">
                                                                        <?php echo html_escape($category['category_name']); ?>
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
                                        <div class="col-sm-12">
                                            <div class="row" id="filter_type_main_row">
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label for="filter_type"
                                                               class="col-sm-3 col-form-label"><?php echo display('filter_type') ?></label>
                                                        <div class="col-sm-9">
                                                            <select
                                                                class="form-control filter-control width_100p filter_type"
                                                                name="filter_type[]">
                                                                <option value=""><?php echo display('select_one') ?>
                                                                </option>
                                                                <?php foreach ($filter_types as $filter_type) { ?>
                                                                    <option
                                                                        value="<?php echo $filter_type['fil_type_id']; ?>">
                                                                            <?php echo html_escape($filter_type['fil_type_name']); ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label for="filter_name"
                                                               class="col-sm-3 col-form-label"><?php echo display('filter_names') ?></label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group">
                                                                <select
                                                                    class="form-control filter-control width_100p filter_name"
                                                                    name="filter_name[]">
                                                                    <option value=""><?php echo display('select_one') ?>
                                                                    </option>
                                                                </select>
                                                                <div class="input-group-addon btn btn-success"
                                                                     id="add_filter_row">
                                                                    <i class="ti-plus"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row filter_type_row">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                      

                                        
                                           <div class="col-sm-6">
                                            <div class="form-group row">
                                                <!-- <label for="variant_colors"
                                                       class="col-sm-3 col-form-label"><?php echo display('color') ?></label>
                                                <div class="col-sm-9 custom_select">
                                                    <select name="variant_colors[]" class="form-control select2" 
                                                            id="variant_colors">
                                                        <option value="">Select</option>
                                                        <?php
                                                        if ($variant_list) {
                                                            foreach ($variant_list as $variant) {
                                                                if ($variant['variant_type'] == 'color') {
                                                                    ?>
                                                                    <option value="<?php echo html_escape($variant['variant_id']) ?>">
                                                                        <?php echo html_escape($variant['variant_name']); ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div> -->
                                            </div>
                                            <div id="variant_price_area">
                                                <div class="form-group row hidden">
                                                    <div class="col-sm-4 col-sm-offset-4">
                                                        <div class="checkbox checkbox-success">
                                                            <input type="checkbox" name="variant_prices" value="1"
                                                                   id="variant_prices">
                                                            <label class=""
                                                                   for="variant_prices"><?php echo display('set_variant_wise_price') ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row none" id="set_variant_price">
                                                    <div class="col-sm-6 col-sm-offset-4">
                                                        <div>
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>

                                                                        <th><?php echo display('size') ?><span
                                                                                class="color-red">*</span></th>
                                                                        <th><?php echo display('color') ?></th>
                                                                        <th><?php echo display('price') ?><span
                                                                                class="color-red">*</span></th>
                                                                        <th><?php echo display('action') ?></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="variant_area">
                                                                    <?php $i = 0; ?>
                                                                    <tr>

                                                                        <td>
                                                                            <select name="variant_1" id="size_var"
                                                                                    class="form-control select2 custom_select">
                                                                                <option value=""></option>
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <select name="variant_2" id="color_var"
                                                                                    class="form-control select2 custom_select">
                                                                                <option value=""></option>
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" name="var_price_1" id="var_price"
                                                                                   class="form-control" placeholder="0.00"
                                                                                   value="">
                                                                        </td>
                                                                        <td>
                                                                            <input type="button" value="Add"
                                                                                   class="btn btn-info" id="variant-row-add"
                                                                                   data-key="<?php echo $i; ?>">
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label for="supplier"
                                                               class="col-sm-3 col-form-label"><?php echo display('supplier') ?> </label>
                                                        <div class="col-sm-9 custom_select">
                                                            <select name="supplier_id" class="form-control select2" 
                                                                    id="supplier">
                                                                <option value=""><?php echo display('select_supplier') ?></option>
                                                                <?php if ($supplier) { ?>
                                                                    {supplier}
                                                                    <option value="{supplier_id}">{supplier_name}</option>
                                                                    {/supplier}
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label for="warrantee"
                                                               class="col-sm-3 col-form-label"><?php echo display('warrantee') ?></label>
                                                        <div class="col-sm-9">
                                                            <input type="number" id="warrantee" name="warrantee"
                                                                   placeholder="<?php echo display('please_enter_number_of_months'); ?>"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                  


                                </div>
                                <?php /* ?>
                                <div class="tab-pane" id="tab2">
                                    <div class="assembly_row assembly_row_mb">
                                        <input type="hidden" class="baseUrl" value="<?php echo base_url(); ?>" />
                                        <!-- Start Row for assembly -->
                                        <table class="table" id="addassemblypro">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-6 text-center">
                                                        <div class="btn btn-success" id="addassemblyprorow">
                                                            Add <i class="ti-plus"></i>
                                                        </div>
                                                        <?php echo display('product_name') ?>
                                                    </th>
                                                    <th class="col-sm-3 text-center"><?php echo display('supplier_price') ?></th>
                                                    <th class="col-sm-3 text-center"><?php echo display('sell_price') ?></th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                for ($x = 1; $x < 2; $x++) {
                                                    ?>
                                                    <tr id="pro<?php echo $x; ?>" class="<?php echo $x; ?>">
                                                        <td class="col-sm-6">
                                                            <div class="col-sm-12">
                                                                <div class="form-group row">
                                                                    <div class="input-group">
                                                                        <input type="text" name="assemblypro[<?php echo $x; ?>]" onkeyup="assembly_productList(<?php echo $x; ?>);"
                                                                               class="form-control assemblyproductSelection"
                                                                               placeholder='<?php echo display('product_name') ?>' 
                                                                               id="assemblypro<?php echo $x; ?>">

                                                                        <input type="hidden" class="autocomplete_hidden_value assembly_product_id_1" value="" name="assembly_product_id[<?php echo $x; ?>]" />

                                                                        <div class="input-group-addon btn btn-danger remove_assembly_row" onclick="removeassemblyrow(<?php echo $x; ?>)">
                                                                            <i class="ti-minus"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="col-sm-3">
                                                            <div class="col-sm-12">
                                                                <div class="form-group row">
                                                                    <input type="text" name="product_rate[<?php echo $x; ?>]"  id="price_item_<?php echo $x; ?>"
                                                                           class="price_item<?php echo $x; ?> form-control"  min="0" readonly="" />
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="col-sm-3">
                                                            <div class="col-sm-12">
                                                                <div class="form-group row">
                                                                    <input type="text" name="product_price[<?php echo $x; ?>]"  id="product_price_<?php echo $x; ?>"
                                                                           class="product_price<?php echo $x; ?> form-control"  min="0" readonly="" />
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                } // /.foreach 
                                                ?>
                                            </tbody>
                                        </table>
                                        <!-- End Row for assembly  --> 
                                    </div>
                                    <div class="new_pro_row"></div>
                                </div>
                                <?php */ ?>
                                <div class="tab-pane" id="tab2">
                                    <div class="form-group row">
                                        <label for="supplier_price"
                                               class="col-sm-4 col-form-label"><?php echo display('supplier_price') ?>
                                        </label>
                                        <div class="col-sm-4">
                                            <input type="number" tabindex="4" class="form-control text-right"
                                                   name="supplier_price" value="<?php echo set_value('supplier_price') ?>"
                                                   onchange="check_price();" placeholder="<?php echo display('supplier_price') ?>" readonly=""
                                                   min="0" id="supplier_price" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="unit"
                                               class="col-sm-4 col-form-label"><?php echo display('unit') ?></label>
                                        <div class="col-sm-4 custom_select">
                                            <select class="form-control select2 width_100p" id="unit"
                                                    name="unit">
                                                <option value=""><?php echo display('select_one') ?></option>
                                                <?php foreach ($unit_list as $unit) { ?>
                                                    <option value="<?php echo html_escape($unit['unit_id']); ?>">
                                                        <?php echo display($unit['unit_name']); ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sell_price"
                                               class="col-sm-4 col-form-label"><?php echo display('sell_price') ?> <span
                                                class="color-red">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control text-right" name="price" type="number"
                                                   required="" onchange="check_price();" placeholder="<?php echo display('sell_price') ?>"
                                                   value="<?php echo set_value('price') ?>" min="0" id="sell_price">
                                        </div>
                                    </div>

                                    <!-- Start for pricing -->
                                    <div class="form-group row">
                                        <label for="pricing_type" class="col-sm-4 col-form-label"><?php echo display('pricing') ?></label>
                                        <div class="col-sm-4">
                                            <!-- Start Row for pricing -->
                                            <div class="row pricing_type_row">
                                                <table class="" id="addprice">
                                                    <tbody>
                                                        <?php
                                                        for ($x = 1; $x < 2; $x++) {
                                                            ?>
                                                            <tr id="row<?php echo $x; ?>" class="<?php echo $x; ?>">
                                                                <td class="col-sm-6">
                                                                    <div class="col-sm-12 custom_select">
                                                                        <div class="form-group row">
                                                                            <select class="form-control pricing-control width_100p pricing_type" name="pricetype[<?php echo $x; ?>]" id="pricetype<?php echo $x; ?>" onchange="" >
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="col-sm-6">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group row">
                                                                            <div class="input-group">
                                                                                <input type="number" class="form-control text-left"  onchange="check_price2(<?php echo $x; ?>);"  value="<?php echo set_value('pricepri' . $x) ?>" id="pricepri<?php echo $x; ?>" name="pricepri[<?php echo $x; ?>]" placeholder="0.00" />
                                                                                <div class="input-group-addon btn btn-success" id="addpricerow">
                                                                                    <i class="ti-plus"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        } // /.foreach 
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- End Row for pricing  --> 
                                        </div>
                                    </div>
                                    <!-- End for pricing  --> 
                                    <div class="form-group row">
                                        <label for="onsale"
                                               class="col-sm-4 col-form-label"><?php echo display('onsale') ?> <span
                                                class="color-red">*</span></label>
                                        <div class="col-sm-4 custom_select">
                                            <select class="form-control select2 width_100p" id="onsale" name="onsale"
                                                    required="">
                                                <option value="0"><?php echo display('no') ?></option>
                                                <option value="1"><?php echo display('yes') ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row onsale_price none">
                                        <label for="onsale_price"
                                               class="col-sm-4 col-form-label"><?php echo display('onsale_price') ?> <i
                                                class="text-danger">*</i></label>
                                        <div class="col-md-4">
                                            <input class="form-control text-right" name="onsale_price" type="number"
                                                   required="" placeholder="<?php echo display('onsale_price') ?>" min="0"
                                                   id="onsale_price">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="details"
                                                       class="col-sm-2 col-form-label"><?php echo display('details') ?></label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control summernote" name="details"
                                                              id="details" rows="3"
                                                              placeholder="<?php echo display('details') ?>"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="invoice_details"
                                                       class="col-sm-2 col-form-label"><?php echo display('invoice_details') ?></label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" name="invoice_details"
                                                              id="invoice_details" rows="3"
                                                              placeholder="<?php echo display('invoice_details') ?>"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="tab3">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="image_thumb"
                                                   class="col-sm-2 col-form-label"><?php echo display('default_image') ?></label>
                                            <div class="col-sm-4">
                                                <input type="file" name="image_thumb" class="form-control"
                                                       id="image_thumb">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="image_row">
                                        <!-- <div id="image_row_0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="imageUpload"
                                                               class="col-sm-4 col-form-label"><?php echo display('image') ?></label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" name="imageUpload[]" type="file"
                                                                   id="imageUpload" data-toggle="tooltip"
                                                                   data-placement="top" title="" aria-required="true"
                                                                   data-original-title="<?php echo display('image_size_width_3000_height_3000') ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="button" value="+" onClick="addImageRow(1);"
                                                       class="btn btn-info" id="image-add">
                                                <input type="button" value="-" onclick="deleteImageRow(this);"
                                                       class="btn btn-danger" id="image-remove">
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab4">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="type"
                                                       class="col-sm-3 col-form-label"><?php echo display('type') ?>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="type" class="form-control" id="type"
                                                           placeholder="<?php echo display('type') ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="tag"
                                                       class="col-sm-3 col-form-label"><?php echo display('tag') ?></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" data-role="tagsinput"
                                                           name="tag" placeholder="<?php echo display('tag') ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="best_sale"
                                                       class="col-sm-3 col-form-label"><?php echo display('best_sale') ?></label>
                                                <div class="col-md-9 custom_select">
                                                    <select class="form-control select2 width_100p" id="best_sale"
                                                            name="best_sale">
                                                        <option value=""><?php echo display('select_one') ?></option>
                                                        <option value="1"><?php echo display('yes') ?></option>
                                                        <option value="0"><?php echo display('no') ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row ">
                                                <label for="video"
                                                       class="col-sm-3 col-form-label"><?php echo display('video_link') ?> </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="video" class="form-control" />
                                                    <p class="color4 color5 demo-notice hidden">Demo Video Link :
                                                        <b>https://www.youtube.com/watch?v=nQZvbmaO0ws</b>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="review"
                                                       class="col-sm-3 col-form-label"><?php echo display('review') ?></label>
                                                <div class="col-md-9">
                                                    <textarea name="review" class="form-control summernote"
                                                              placeholder="<?php echo display('review') ?>" id="review"
                                                              required row="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="specification"
                                                       class="col-sm-2 col-form-label"><?php echo display('specification') ?></label>
                                                <div class="col-md-10">
                                                    <textarea name="specification" class="form-control summernote"
                                                              placeholder="<?php echo display('specification') ?>"
                                                              id="specification" required row="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab6">
                                    <div class="trans_row trans_row_mb">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="language"
                                                           class="col-sm-4 col-form-label"><?php echo display('language') ?></label>
                                                    <div class="col-sm-8 custom_select">
                                                        <div class="input-group">
                                                            <select class="form-control" id="language"
                                                                    name="language[0]">
                                                                <option value=""></option>
                                                                <?php
                                                                if (!empty($languages)) {
                                                                    foreach ($languages as $lkey => $lvalue) {
                                                                        ?>
                                                                        <option value="<?php echo html_escape($lvalue); ?>">
                                                                            <?php echo html_escape($lvalue); ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                            <div class="input-group-addon btn btn-success" id="add_row">
                                                                <i class="ti-plus"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="product_name"
                                                           class="col-sm-4 col-form-label"><?php echo display('product_name') ?></label>
                                                    <div class="col-sm-8">
                                                        <input class="form-control" name="trans_name[0]" autofocus
                                                               type="text" id="product_name"
                                                               placeholder="<?php echo display('product_name') ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <label for="details"
                                                           class="col-sm-2 col-form-label"><?php echo display('details') ?></label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control summernote"
                                                                  name="trans_details[0]" id="details" rows="1"
                                                                  placeholder="<?php echo display('details') ?>"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="specification"
                                                           class="col-sm-4 col-form-label"><?php echo display('specification') ?></label>
                                                    <div class="col-md-8">
                                                        <textarea name="trans_specification[0]"
                                                                  class="form-control summernote"
                                                                  placeholder="<?php echo display('specification') ?>"
                                                                  id="specification" row="1"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="new_row"></div>
                                </div>
                                <ul class="pager wizard">
                                    <li class="previous first none"><a href="#"><?php echo display('first') ?></a></li>
                                    <li class="previous"><a href="#"><?php echo display('prev') ?></a></li>
                                    <li class="next last none"><a href="#"><?php echo display('last') ?></a></li>
                                    <li class="next"><a href="#"><?php echo display('next') ?></a></li>
                                    <li class="finish pull-right">
                                        <button type="submit" name="add-product" class="btn btn-success"><?php echo display('submit') ?>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    <!-- <button class="btn btn-primary" type="button" id="log" >Loggg</button> -->
                </div>
            </div>
        </div>
    </div> <!-- /.content -->
</div>
<!-- Add Product Form End -->
<script src="<?php echo MOD_URL . 'dashboard/assets/js/add_product_form.js'; ?>"></script>
<script>
    // $(document).ready(function() {
    //     $('#log').click(function() {
    //         console.log($('#variant').val());
    //     });
    // });
</script>