<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Customer js php -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/customer.js.php"></script>
<!-- Product invoice js -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/product_invoice.js.php"></script>
<!-- Invoice js -->

<script src="<?php echo MOD_URL . 'dashboard/assets/js/add_refund_form.js'; ?>"></script>
<script src="<?php echo MOD_URL . 'dashboard/assets/js/add_invoice_form_2.js'; ?>"></script>
<link rel="stylesheet" href="<?php echo MOD_URL . 'dashboard/assets/css/invoice/add_invoice_form.css' ?>">

<!-- Add New Invoice Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('return_quantity_adjustment') ?></h1>
            <small><?php echo display('return_quantity_adjustment') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('return') ?></a></li>
                <li class="active"><?php echo display('return_quantity_adjustment') ?></li>
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


        <!--Add return -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('return_quantity_adjustment') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open(base_url() . '/dashboard/Crefund/return_quantity_adjustment', array('class' => 'form-vertical', 'id' => 'validate', 'name' => 'insert_invoice')) ?>
                        <div class="row">
                            <!-- <div class="col-sm-6" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="customer_name" class="col-sm-4 col-form-label"><?php echo display('customer_name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" size="100" value="<?php echo html_escape($customer_name); ?>" name="customer_name" required class="customerSelection form-control" placeholder='<?php echo display('customer_name_or_phone'); ?>' id="customer_name" autocomplete="off" />
                                        <input id="SchoolHiddenId" value="<?php echo html_escape($customer_id) ?>" class="customer_hidden_value" type="hidden" name="customer_id" required>
                                    </div>
                                </div>
                            </div> -->
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label"><?php echo display('product_name') ?>:</label>
                                    <div class="col-sm-8">
                                        <!-- <input type="text" class="form-control" name="invoice_no" id="invoice_no" value="<?php echo set_value('invoice_no', @$_GET['invoice_no']) ?>" placeholder='<?php echo display('invoice_no') ?>'> -->
                                        <!-- <input type="hidden" class="form-control" name="product_id" id="product_id" value=""> -->
                                        <input type="text" name="product_name" onkeyup="invoice_productList(1);" class="form-control productSelection" placeholder='<?php echo display('product_name') ?>' required="" id="product_name_1" value="<?= $product_name ?>">

                                        <?php
                                        $defaultStore = $this->db->select('store_id')
                                            ->from('store_set')
                                            ->where('default_status', 1)
                                            ->limit(1)
                                            ->get()
                                            ->row();
                                        ?>
                                        <input type="hidden" hidden id="store_id" name="store_id" value="<?= $defaultStore->store_id ?>" />

                                        <input type="hidden" class="autocomplete_hidden_value product_id_1" name="product_id[]" required value="<?= $product_id ?>" />

                                        <input type="hidden" class="sl" value="1">
                                        <input type="hidden" name="assembly[]" id="assembly1" value="">
                                        <input type="hidden" name="colorv[]" id="color1" value="">
                                        <input type="hidden" name="sizev[]" id="size1" value="">
                                        <input type="hidden" class="baseUrl" value="<?php echo base_url(); ?>" />
                                        <input type="hidden" hidden name="category_id" id="category_id_1" value="" />
                                        <input type="hidden" hidden name="product_model" id="product_model_1" value="" />
                                        <div style="display: none;">
                                            <select name="variant_id" id="variant_id_1" class="variant_id" style="display: none;" disabled="">
                                                <?php if (!empty($variant_id)) : ?>
                                                    <option value="<?= $variant_id ?>" selected><?= $variant_id ?></option>
                                                <?php else : ?>
                                                    <option value=""></option>
                                                <?php endif ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label"><?php echo display('quantity') ?>:</label>
                                    <div class="col-sm-8">
                                        <input type='number' class='form-control' id='quantity' required='required' min='0' value='0' name='quantity'>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label"><?php echo display('stock') ?>:</label>
                                    <div class="col-sm-8">
                                        <select class='form-control' id='stock' required='required' name='stock'>
                                            <option value='1'><?= display('in') ?></option>
                                            <option value='2'><?= display('out') ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row" style="visibility: hidden;">
                                    <label class="col-sm-4 col-form-label"><?php echo display('status') ?>:</label>
                                    <div class="col-sm-8">
                                        <select class='form-control' id='status' required='required' name='status' >
                                            <option value='1' selected><?= display('damaged') ?></option>
                                            <option value='2'><?= display('no warranty') ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label"></label>
                                    <div class="col-sm-8">
                                        <button type="submit" class="btn btn-success"><?= display('submit') ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Invoice Report End -->
<script>
    $(document).ready(function() {
        $(document).on('change', '#invoice_no', function() {
            var val = $(this).val();
            $('option#invid').each(function(inx, el) {
                if ($(this).val() == val) {
                    $('#invoice_id').val($(this).attr('data-invoice-id'));
                }
            });
        });
        $(document).on('change', '#payment_type', function() {
            var val = $(this).val();

            if (val == 1) {
                $('#bank_list_container').removeClass('hidden');
            } else {
                $('#bank_list_container').addClass('hidden');
            }
        });
    });
</script>