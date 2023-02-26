<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Store product transfer start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('store_product_transfer') ?></h1>
            <small><?php echo display('store_product_transfer') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('store_set') ?></a></li>
                <li class="active"><?php echo display('store_product_transfer') ?></li>
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
        $validatio_error = validation_errors();
        if (($error_message || $validatio_error)) {
        ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error_message ?>
                <?php echo $validatio_error ?>
            </div>
        <?php
            $this->session->unset_userdata('error_message');
        }
        ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="column">
                    <?php if ($this->permission->check_label('store_add')->create()->access()) { ?>
                        <a href="<?php echo base_url('dashboard/Cstore') ?>" class="btn -btn-info color4 color5 m-b-5 m-r-2"><i class="ti-align-justify"> </i>
                            <?php echo display('add_store') ?></a>
                    <?php }
                    if ($this->permission->check_label('manage_store')->read()->access()) { ?>
                        <a href="<?php echo base_url('dashboard/Cstore/manage_store') ?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i>
                            <?php echo display('manage_store') ?></a>
                    <?php }
                    if ($this->permission->check_label('manage_store_product')->update()->access()) { ?>
                        <a href="<?php echo base_url('dashboard/Cstore/manage_store_product') ?>" class="btn btn-warning m-b-5 m-r-2"><i class="ti-align-justify"> </i>
                            <?php echo display('manage_store_product') ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- Store product transfer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('store_product_transfer') ?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('dashboard/Cstore/insert_store_product', array('class' => 'form-vertical', 'id' => 'validate')) ?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="store_name" class="col-sm-4 col-form-label"><?php echo display('transfer_from') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="store_id" name="store_id" required="">
                                            <option value=""></option>
                                            {store_list}
                                            <option value="{store_id}">{store_name}</option>
                                            {/store_list}
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="transfer" class="col-sm-4 col-form-label"><?php echo display('transfer_to') ?> <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="transfer" name="t_store_id" required=""></select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('date') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <?php
                                        date_default_timezone_set(DEF_TIMEZONE);
                                        $date = date('d-m-Y');
                                        ?>
                                        <input class="form-control datepicker2" type="text" size="50" name="trans_date" id="date" required value="<?php echo html_escape($date); ?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="vo_no" class="col-sm-4 col-form-label"><?php echo display('transfer_no') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <?php
                                        $transfer_no = 1;
                                        $latest = $this->db->select('transfer_no')->from('transfer_details')->order_by('id', 'desc')->limit(1)->get()->row();
                                        if (!empty($latest->transfer_no)) {
                                            $latest = str_replace('Trans-', '', $latest->transfer_no);
                                            $transfer_no = (int)$latest + 1;
                                        } else {
                                            $transfer_no = 1000;
                                        }
                                        ?>
                                        <input type="text" name="txtTNo" id="txtTNo" value="Trans-<?= $transfer_no ?>" class="form-control" readonly required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                            <div class="form-group row">
                                    <label for="txtRemarks" class="col-sm-2 col-form-label"><?php echo display('remark') ?>
                                    <i class="text-danger">*</i>
                                </label>
                                    <div class="col-sm-8">
                                        <textarea name="txtRemarks" id="txtRemarks" class="form-control"  required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive mt_10">
                            <table class="table table-bordered table-hover" id="purchaseTable">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_information') ?><i class="text-danger">*</i></th>
                                        <th class="text-center" width="130"><?php echo display('variant') ?><i class="text-danger">*</i></th>
                                        <!-- <th class="text-center" width="130"><?php echo display('batch_no') ?> <i class="text-danger">*</i></th> -->
                                        <th class="text-center"><?php echo display('available_quantity') ?></th>
                                        <th class="text-center"><?php echo display('quantity') ?><i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('delete') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="addPurchaseItem">
                                    <tr>
                                        <td>
                                            <input type="text" name="product_name[1]" required class="form-control product_name productSelection" onkeyup="product_pur_or_list(1);" placeholder="<?php echo display('product_name') ?>" id="product_name_1" tabindex="5">
                                            <input type="hidden" class="autocomplete_hidden_value product_id_1" name="product_id[1]" id="SchoolHiddenId" />
                                            <input type="hidden" class="sl" value="1">
                                        </td>
                                        <td class="text-center">
                                            <div class="variant_id_div">
                                                <select name="variant_id[1]" id="variant_id_1" value="" class="form-control variant_id width_100p" required="" aria-readonly="true" readonly data-readonly="true" data-disabled="true" disabled>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div id="color_variant_area_1" style="visibility: hidden;">
                                                <select name="color_variant[1]" id="color_variant_1" value="" class="form-control color_variant width_100p">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="text-center" style="display: none;">
                                            <div>
                                                <select name="batch_no[1]" id="batch_no_1" class="form-control batch_no width_100p" data-tags="true" required>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <input type="number" id="avl_qntt_1" class="form-control text-right" placeholder="0" readonly />
                                        </td>
                                        <td class="text-right">
                                            <input type="number" name="product_quantity[1]" id="total_qntt_1" class="form-control text-right" placeholder="0" min="0" required="" />
                                        </td>
                                        <td>
                                            <button class="btn btn-danger text-right" type="button" value="<?php echo display('delete') ?>" onclick="deleteRow(this)"><?php echo display('delete') ?></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <input type="button" id="add-invoice-item" class="btn -btn-info color4 color5" name="add-invoice-item" onClick="addPurchaseOrderField('addPurchaseItem');" value="<?php echo display('add_new_item') ?>" />
                                            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url(); ?>" />
                                        </td>
                                        <td class="text-right"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" id="add-store" class="btn btn-success btn-large" name="add-store" value="<?php echo display('save') ?>" />
                                <input type="submit" id="add-store-another" class="btn btn-success btn-large" name="add-store-another" value="<?php echo display('save_and_add_another') ?>" />
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Store product transfer end -->
<script src="<?php echo MOD_URL . 'dashboard/assets/js/store_product_transfer.js'; ?>"></script>
<script>
    $(document).ready(function() {
        $(".datepicker2").datepicker({
            dateFormat: "dd-mm-yy"
        });
    });
</script>