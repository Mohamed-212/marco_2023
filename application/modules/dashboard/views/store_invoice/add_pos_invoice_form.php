<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Customer js php -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/customer.js.php"></script>
<!-- Product invoice js -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/product_invoice.js.php"></script>
<!-- Invoice js -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/invoice.js" type="text/javascript"></script>
<!-- Pos invoice form js -->
<script src="<?php echo MOD_URL . 'dashboard/assets/js/add_pos_invoice_form.js'; ?>"></script>
<link rel="stylesheet" href="<?php echo MOD_URL . 'dashboard/assets/css/dashboard.css' ?>">
<!-- POS CSS -->
<link rel="stylesheet" href="<?php echo MOD_URL . 'dashboard/assets/css/pos_gui.min.css' ?>">

<div class="content-wrapper">
    <!-- Alert Message -->
    <?php
    // Dynamic Message
    $message = $this->session->userdata('message');
    if (isset($message)) {
    ?>
    <script>
    "use strict";
    Swal({
        position: 'center',
        type: 'success',
        title: '<?php echo $message; ?>',
        showConfirmButton: false,
        timer: 3000
    })
    </script>

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
    <div id="openregister" class="modal fade  bd-example-modal-lg" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="openclosecash">
            </div>
        </div>
    </div>
    <div class="pl-3 pr-3">
        <div class="top-bar">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active">
                    <a href="#home" role="tab" data-toggle="tab" class="home" id="new_sale">
                        New Sale </a>
                </li>
                <li class="onprocessg"><a href="#saleList" role="tab" data-toggle="tab" class="ongord"
                        id="todays_salelist">
                        Todays sale </a>
                </li>
            </ul>
            <div class="tgbar d-flex">
                <?php
                $checkModule = $this->db->where('directory', 'day_closing')->where('status', 1)->get('module')->num_rows();
                if ($checkModule == 1) {
                    $saveid = $this->session->userdata('user_email');
                    $checkuser = $this->db->select('*')->from('tbl_cashregister')->where('userid', $saveid)->where('status', 0)->order_by('id', 'DESC')->get()->row();
                    if (!empty($checkuser)) {
                ?>
                <div>
                    <li class="day-close"><a href="javascript:;" class="btn" onclick="closeopenresister()"
                            role="button"><span class="text-white"><?php echo display("day_close") ?></span></a></li>
                </div>
                <?php }
                } ?>
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <!-- Sidebar toggle button-->
                    <span class="sr-only">Toggle navigation</span>
                    <span class="pe-7s-keypad"></span>
                </a>
                <a href="" class="topbar-icon" id="keyshortcut" aria-hidden="true" data-toggle="modal"
                    data-target="#cheetsheet"><i class="fa fa-keyboard-o"></i></a>
            </div>
        </div>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade active in" id="home">
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="row">
                            <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3 col-xl-2 all_category_area">
                                <div class="btn-check-group">
                                    <div class="btn-check">
                                        <input type="checkbox" class="category_id" autocomplete="off" name="category_id"
                                            id="category_id_all" value="">
                                        <label class="btn btn-success btn-block" for="category_id_all">
                                            <?php echo display('all') ?>
                                        </label>
                                    </div>
                                    <?php
                                    if (!empty($category_list)) {
                                        foreach ($category_list as $category) { ?>
                                    <div class="btn-check">
                                        <input type="checkbox" class="category_id" autocomplete="off" name="category_id"
                                            id="category_id_<?php echo $category->category_id; ?>"
                                            value="<?php echo $category->category_id; ?>">
                                        <label class="btn btn-success btn-block"
                                            for="category_id_<?php echo $category->category_id; ?>">
                                            <?php echo html_escape($category->category_name); ?>
                                        </label>
                                    </div>
                                    <?php }
                                    } ?>

                                </div>
                            </div>
                            <div class="col-xs-8 col-sm-9 col-md-8 col-lg-9 col-xl-10 " id="style-3">

                                <div class="row search-bar">
                                    <div class="col-sm-12">
                                        <!-- Actual search box -->
                                        <div class="form-group has-feedback has-search">
                                            <span
                                                class="ti-search form-control-feedback d-flex align-items-center justify-content-center"></span>
                                            <input type="text" id="product_name" class="form-control search-field"
                                                dir="ltr" value="" name="s"
                                                placeholder="<?php echo display('search_by_product') ?>" />

                                        </div>
                                    </div>
                                </div>



                                <div class="product-grid">
                                    <div class="row row-m-3">
                                        <div id="product_search">

                                            <?php
                                            if ($product_list) {
                                                foreach ($product_list as $product) {
                                            ?>
                                            <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3 col-p-3">
                                                <div
                                                    class="product-panel overflow-hidden border-0 shadow-sm select_product">
                                                    <div class="item-image position-relative overflow-hidden">
                                                        <img src="<?php echo  base_url() . (!empty(html_escape($product->image_thumb)) ? $product->image_thumb : 'assets/img/icons/default.jpg') ?>"
                                                            class="img-responsive" alt="">
                                                        <input type="hidden" name="select_product_id"
                                                            class="select_product_id"
                                                            value="<?php echo html_escape($product->product_id) ?>">
                                                    </div>
                                                    <div class="panel-footer border-0 bg-white">
                                                        <h3 class="item-details-title">
                                                            <?php echo html_escape($product->product_name . '-(' . $product->product_model) . ')' ?>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                }
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="form-inline mb-3">
                            <div class="form-group">
                                <input type="text" name="product_name" class="form-control"
                                    placeholder='<?php echo display('barcode_qrcode_scan_here') ?>' id="add_item">
                            </div>
                            <div class="form-group">
                                <label class="mr-3 ml-3">OR</label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="product_name2" class="form-control"
                                    placeholder="Manual Input barcode" id="manual_barcode">
                            </div>
                        </div>
                        <?php echo form_open_multipart('dashboard/Store_invoice/insert_posInvoice', array('class' => 'form-vertical', 'id' => 'validate')) ?>
                        <div class="d-flex align-items-center form-inline mb-5 mt-2">
                            <div class="input-group mr-3">

                                <input type="hidden" name="pos" value="pos">

                                <input type="text"
                                    value="<?php echo html_escape(@$customer_details[0]->customer_name); ?>"
                                    name="customer_name" class="customerSelection form-control"
                                    placeholder='<?php echo display('customer_name_or_phone') ?>' id="customer_name"
                                    required />

                                <span class="input-group-btn">
                                    <button class="client-add-btn btn btn-success" type="button" aria-hidden="true"
                                        data-toggle="modal" data-target="#client-info"><i class="ti-plus"></i></button>
                                </span>

                                <input id="SchoolHiddenId"
                                    value="<?php echo html_escape(@$customer_details[0]->customer_id) ?>"
                                    class="customer_hidden_value" type="hidden" name="customer_id" required>
                            </div><!-- /input-group -->

                            <div class="d-flex align-items-center">
                                <div class="form-group">
                                    <select id="store_id" class="form-control" name="store_id" required="">
                                        <option value=""><?php echo display('store') ?></option>
                                        <?php

                                        if ($store_list) {
                                            foreach ($store_list as $store) { ?>
                                        <option value="<?php echo html_escape($store->store_id) ?>"
                                            <?php echo (($store_id == $store->store_id) ? 'selected' : ''); ?>>
                                            <?php echo html_escape($store->store_name) ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <?php date_default_timezone_set(DEF_TIMEZONE);
                        $date = date('m-d-Y'); ?>
                        <input class="form-control" type="hidden" id="invoice_date" name="invoice_date" required
                            value="<?php echo html_escape($date); ?>" />
                        <input type="hidden" id="product_value" name="">



                        <div class="table-responsive guiproductdata">
                            <table class="table table-bordered table-hover table-sm nowrap gui-products-table"
                                id="addinvoice">
                                <thead>
                                    <tr>
                                        <th><?php echo display('item') ?></th>
                                        <th><?php echo display('variant') ?></th>
                                        <th><?php echo display('batch_no') ?></th>
                                        <th><?php echo display('available_quantity') ?></th>
                                        <th><?php echo display('price') ?></th>
                                        <th><?php echo display('quantity') ?></th>
                                        <th><?php echo display('total') ?></th>
                                        <th><?php echo display('action') ?></th>


                                    </tr>
                                </thead>
                                <tbody id="addinvoiceItem" class="itemNumber">
                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="footer"> -->
                        <div class="">

                            <div class="row">
                                <div class="col-md-7">

                                    <div class="payment_method none" id="payment_method_zone"></div>
                                </div>
                                <div class="col-md-5">

                                    <div class="form-group row guifooterpanel">
                                        <div class="col-sm-12">
                                            <label for="date"
                                                class="col-sm-5 col-lg-5 col-xl-6 col-form-label"><?php echo display('invoice_discount') ?>:</label>
                                            <div class="col-sm-7 col-lg-7 col-xl-6">
                                                <input type="text" id="invoice_discount" class="form-control text-right"
                                                    name="invoice_discount" placeholder="0.00" onkeyup="calculateSum();"
                                                    onchange="calculateSum();" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row guifooterpanel">
                                        <div class="col-sm-12">
                                            <label for="date"
                                                class="col-sm-5 col-lg-5 col-xl-6 col-form-label"><?php echo display('total_discount') ?>:</label>
                                            <div class="col-sm-7 col-lg-7 col-xl-6"><input type="text"
                                                    id="total_discount_ammount" class="form-control text-right"
                                                    name="total_discount" placeholder="0.00" readonly="readonly" />
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    //Tax basic info
                                    $this->db->select('*');
                                    $this->db->from('tax');
                                    $this->db->order_by('tax_name', 'asc');
                                    $tax_information = $this->db->get()->result();

                                    if (!empty($tax_information)) {
                                        foreach ($tax_information as $k => $v) {
                                            if ($v->tax_id == 'H5MQN4NXJBSDX4L') {
                                                $tax['cgst_name'] = $v->tax_name;
                                                $tax['cgst_id'] = $v->tax_id;
                                                $tax['cgst_status'] = $v->status;
                                            } elseif ($v->tax_id == '52C2SKCKGQY6Q9J') {
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


                                    <?php if ($tax['cgst_status'] == 1) { ?>
                                    <div class="form-group row guifooterpanel">
                                        <div class="col-sm-12">
                                            <label for="date"
                                                class="col-sm-5 col-lg-5 col-xl-6 col-form-label"><?php echo html_escape($tax['cgst_name']) ?>:</label>
                                            <div class="col-sm-7 col-lg-7 col-xl-6"><input type="text" id="total_cgst"
                                                    class="form-control text-right" name="total_cgst" value="0.00"
                                                    readonly="readonly" /></div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php if ($tax['sgst_status'] == 1) { ?>
                                    <div class="form-group row guifooterpanel">
                                        <div class="col-sm-12">
                                            <label for="date"
                                                class="col-sm-5 col-lg-5 col-xl-6 col-form-label"><?php echo html_escape($tax['sgst_name']) ?>:</label>
                                            <div class="col-sm-7 col-lg-7 col-xl-6"><input type="text" id="total_sgst"
                                                    class="form-control text-right" name="total_sgst" value="0.00"
                                                    readonly="readonly" /></div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php if ($tax['igst_status'] == 1) { ?>
                                    <div class="form-group row guifooterpanel">
                                        <div class="col-sm-12">
                                            <label for="date"
                                                class="col-sm-5 col-lg-5 col-xl-6 col-form-label"><?php echo html_escape($tax['igst_name']) ?>:</label>
                                            <div class="col-sm-7 col-lg-7 col-xl-6"><input type="text" id="total_igst"
                                                    class="form-control text-right" name="total_igst" value="0.00"
                                                    readonly="readonly" /></div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <div class="form-group row guifooterpanel">
                                        <div class="col-sm-12">
                                            <label for="date"
                                                class="col-sm-5 col-lg-5 col-xl-6 col-form-label"><?php echo display('service_charge') ?>:</label>
                                            <div class="col-sm-7 col-lg-7 col-xl-6">
                                                <input type="text" id="service_charge" onkeyup="calculateSum();"
                                                    class="form-control text-right" name="service_charge"
                                                    placeholder="0.00" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row guifooterpanel">
                                        <div class="col-sm-12">
                                            <label for="date"
                                                class="col-sm-5 col-lg-5 col-xl-6 col-form-label"><?php echo display('grand_total') ?>:</label>
                                            <div class="col-sm-7 col-lg-7 col-xl-6"><input type="text" id="grandTotal"
                                                    class="form-control text-right" name="grand_total_price"
                                                    placeholder="0.00" readonly="readonly" /></div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="fixedclasspos">
                            <div class="bottomarea">
                                <div class="row">
                                    <div class="col-lg-8 col-xl-8">
                                        <div class="calculation d-lg-flex">
                                            <div class="cal-box d-lg-flex align-items-lg-center mr-4">
                                                <label
                                                    class="cal-label mr-2 mb-0"><?php echo display('net_total') ?>:</label><span
                                                    class="amount total_bill">0.00</span>
                                            </div>
                                            <div class="cal-box d-lg-flex align-items-lg-center mr-4">
                                                <div class="form-inline d-inline-flex align-items-center">
                                                    <label
                                                        class="cal-label mr-2 mb-0"><?php echo display('paid_ammount') ?>:</label>
                                                    <input type="text" id="paidAmount" onkeyup="invoice_paidamount();"
                                                        class="form-control text-right" name="paid_amount"
                                                        placeholder="0.00" />
                                                </div>
                                            </div>
                                            <div class="cal-box d-lg-flex align-items-lg-center mr-4">
                                                <label
                                                    class="cal-label mr-2 mb-0"><?php echo display('due') ?>:</label><span
                                                    class="amount"><input type="text" id="dueAmmount"
                                                        class="form-control text-right" name="due_amount"
                                                        placeholder="0.00" readonly="readonly" /></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-xl-4 text-xl-right">
                                        <div class="action-btns d-flex justify-content-end">

                                            <input class="btn btn-warning btn-lg mr-2"
                                                value="<?php echo display('full_paid') ?>" onclick="full_paid();"
                                                type="button">
                                            <button type="button"
                                                class="btn btn-purple btn-lg mr-2 payment_button"><?php echo display('payment') ?></button>
                                            <a href="<?php base_url('dashboard/Cinvoice/manage_invoice') ?>"
                                                class="btn btn-danger btn-lg mr-2"><?php echo display('cancel') ?></a>
                                            <button type="submit"
                                                class="btn btn-success btn-lg mr-2"><?php echo display('submit') ?></button>

                                            <a href="#" class="btn btn-info btn-lg" data-toggle="modal"
                                                id="calculator_modal" data-target="#calculator"><i
                                                    class="fa fa-calculator" aria-hidden="true"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="saleList">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive padding10" id="invoic_list">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo display('sl') ?></th>
                                        <th><?php echo display('invoice_no') ?></th>
                                        <th><?php echo display('customer_name') ?></th>
                                        <th><?php echo display('date') ?></th>
                                        <th><?php echo display('total_amount') ?></th>
                                        <th class="width_25p"><?php echo display('status') ?></th>
                                        <th><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($today_sales)) {
                                        $i = 1;
                                        foreach ($today_sales as $invoice) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td>
                                            <a
                                                href="<?php echo base_url() . 'dashboard/Cinvoice/invoice_inserted_data/' . html_escape($invoice['invoice_id']); ?>">

                                                <?php echo html_escape($invoice['invoice']) ?>
                                                <i class="fa fa-tasks pull-right" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a
                                                href="<?php echo base_url() . 'dashboard/Ccustomer/customerledger/' . html_escape($invoice['customer_id']); ?>">
                                                <?php echo html_escape($invoice['customer_name']) ?> <i
                                                    class="fa fa-user pull-right" aria-hidden="true"></i></a>

                                        </td>
                                        <td><?php echo date('M d, Y', strtotime($invoice['date'])) ?></td>
                                        <td class="text-right">
                                            <?php echo (($position == 0) ? $currency . ' ' . $invoice['total_amount'] : $invoice['total_amount'] . ' ' . $currency) ?>
                                        </td>
                                        <td>
                                            <?php echo form_open('dashboard/Cinvoice/update_status/' . $invoice['invoice_id'], array('id' => 'validate')); ?>

                                            <select class="form-control" name="invoice_status" required="">
                                                <option value=""></option>
                                                <option value="1" <?php if ($invoice['invoice_status'] == '1') {
                                                                                echo "selected";
                                                                            } ?>>
                                                    <?php echo display('shipped') ?></option>
                                                <option value="2" <?php if ($invoice['invoice_status'] == '2') {
                                                                                echo "selected";
                                                                            } ?>>
                                                    <?php echo display('cancel') ?></option>
                                                <option value="3" <?php if ($invoice['invoice_status'] == '3' || $invoice['invoice_status'] == '0') {
                                                                                echo "selected";
                                                                            } ?>>
                                                    <?php echo display('pending') ?></option>
                                                <option value="4" <?php if ($invoice['invoice_status'] == '4') {
                                                                                echo "selected";
                                                                            } ?>>
                                                    <?php echo display('complete') ?></option>
                                                <option value="5" <?php if ($invoice['invoice_status'] == '5') {
                                                                                echo "selected";
                                                                            } ?>>
                                                    <?php echo display('processing') ?></option>
                                                <option value="6" <?php if ($invoice['invoice_status'] == '6') {
                                                                                echo "selected";
                                                                            } ?>>
                                                    <?php echo display('return') ?></option>
                                            </select>

                                            <?php if ($this->permission->check_label('manage_sale')->update()->access()) { ?>

                                            <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#myModal_<?php echo $i ?>"
                                                title="<?php echo display('add_note') ?>"><i class="fa fa-plus"
                                                    aria-hidden="true"></i></button>

                                            <input type="hidden"
                                                value="<?php echo html_escape($invoice['customer_email']) ?>"
                                                name="customer_email" />
                                            <input type="hidden"
                                                value="<?php echo html_escape($invoice['customer_id']) ?>"
                                                name="customer_id" />
                                            <input type="hidden" value="<?php echo html_escape($invoice['order']) ?>"
                                                name="order_no" />
                                            <input type="hidden" value="<?php echo html_escape($invoice['order_id']) ?>"
                                                name="order_id" />

                                            <div class="modal fade" id="myModal_<?php echo $i ?>" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                            <h1 class="modal-title"><?php echo display('add_note') ?>
                                                            </h1>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group row">
                                                                <label for=""
                                                                    class="col-sm-4 col-form-label"><?php echo display('add_note') ?>
                                                                </label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="add_note"
                                                                        class="form-control"
                                                                        placeholder="<?php echo display('add_note') ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-success"
                                                                data-dismiss="modal"><?php echo display('add') ?></button>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                            <button type="submit"
                                                class="btn btn-primary inv_updatebtn"><?php echo display('update') ?></button>
                                            <?php } ?>
                                            <?php echo form_close() ?>
                                        </td>
                                        <td>
                                            <center>
                                                <?php if ($this->permission->check_label('new_sale')->access()) { ?>
                                                <a href="<?php echo base_url() . 'dashboard/Cinvoice/invoice_inserted_data/' . $invoice['invoice_id']; ?>"
                                                    class="btn btn-success btn-sm" data-toggle="tooltip"
                                                    data-placement="left" title="<?php echo display('invoice') ?>"><i
                                                        class="fa fa-window-restore" aria-hidden="true"></i></a>
                                                <?php }
                                                        if ($this->permission->check_label('pos_sale')->read()->access()) { ?>
                                                <a href="<?php echo base_url() . 'dashboard/Cinvoice/pos_invoice_inserted_data/' . $invoice['invoice_id']; ?>"
                                                    class="btn btn-warning btn-sm" data-toggle="tooltip"
                                                    data-placement="left"
                                                    title="<?php echo display('pos_invoice') ?>"><i class="fa fa-fax"
                                                        aria-hidden="true"></i></a>
                                                <?php }
                                                        if ($this->permission->check_label('manage_sale')->update()->access()) { ?>
                                                <a href="<?php echo base_url() . 'dashboard/Cinvoice/invoice_update_form/' . $invoice['invoice_id']; ?>"
                                                    class="btn btn-info btn-sm" data-toggle="tooltip"
                                                    data-placement="left" title="<?php echo display('update') ?>"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <?php }
                                                        if ($this->permission->check_label('manage_sale')->delete()->access()) { ?>
                                                <a href="<?php echo base_url('dashboard/Cinvoice/invoice_delete/' . $invoice['invoice_id']) ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('<?php echo display('are_you_sure_want_to_delete') ?>');"
                                                    data-toggle="tooltip" data-placement="right" title=""
                                                    data-original-title="<?php echo display('delete') ?> "><i
                                                        class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                <?php } ?>
                                            </center>
                                        </td>
                                    </tr>
                                    <?php $i++;
                                        }
                                    } ?>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>

            </div>


        </div>
    </div>




    <!-- Print order for customer -->
    <div id="order_tbl">
        <span id="order_span">

        </span>

        <table id="order-table" class="prT table table-striped mb_0" width="100%">
            <tbody>

            </tbody>
        </table>
    </div>
    <!-- End Print order for customer -->

    <!-- Print bill for customer -->
    <div id="bill_tbl">
        <span id="bill_span">

        </span>
        <table id="bill-table" width="100%" class="prT table table-striped mb_0">
            <tbody>

            </tbody>
        </table>
        <table id="bill-total-table" class="prT table mb_0" width="100%">
            <tbody>
                <tr class="bold">
                    <td><?php echo display('total_cgst') ?></td>
                    <td class="total_cgst_bill text-right">0</td>
                </tr>
                <tr class="bold">
                    <td><?php echo display('total_sgst') ?></td>
                    <td class="total_sgst_bill  text-right">0</td>
                </tr>
                <tr class="bold">
                    <td><?php echo display('total_igst') ?></td>
                    <td class="total_igst_bill  text-right">0</td>
                </tr>
                <tr class="bold">
                    <td><?php echo display('total_discount') ?></td>
                    <td class="total_discount_bill  text-right">0</td>
                </tr>
                <tr class="bold">
                    <td class=""><?php echo display('grand_total') ?></td>
                    <td class="total_bill text-right">00</td>
                </tr>
                <tr class="bold">
                    <td><?php echo display('items') ?></td>
                    <td class="item_bill text-right">0</td>
                </tr>
            </tbody>
        </table>
        <span id="bill_footer">
            <p class="text-center"><br><?php echo display('merchant_copy') ?></p>
        </span>
    </div>
    <!-- End Print bill for customer -->


    <?php echo form_open('dashboard/Cinvoice/insert_customer', array('class' => 'form-vertical', 'id' => 'validate')) ?>
    <div class="modal fade modal-warning" id="client-info" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title"><?php echo display('add_customer') ?></h3>
                </div>

                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label"><?php echo display('name') ?> <i
                                class="text-danger">*</i></label>
                        <div class="col-sm-6">
                            <input class="form-control simple-control" name="customer_name" id="name" type="text"
                                placeholder="<?php echo display('customer_name') ?>" required="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label"><?php echo display('email') ?> <i
                                class="text-danger">*</i></label>
                        <div class="col-sm-6">
                            <input class="form-control" name="email" id="email" type="email"
                                placeholder="<?php echo display('customer_email') ?>" required="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="mobile" class="col-sm-3 col-form-label"><?php echo display('mobile') ?> <i
                                class="text-danger">*</i></label>
                        <div class="col-sm-6">
                            <input class="form-control" name="mobile" id="mobile" type="number"
                                placeholder="<?php echo display('customer_mobile') ?>" required="" min="0">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address " class="col-sm-3 col-form-label"><?php echo display('address') ?></label>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="address" id="address " rows="3"
                                placeholder="<?php echo display('customer_address') ?>"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo display('close') ?>
                    </button>
                    <button type="submit" class="btn btn-success"><?php echo display('submit') ?> </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php echo form_close(); ?>

    <div class="modal fade modal-warning" id="myModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title"></h3>
                </div>
                <?php echo form_open("", array('id' => 'updateCart')); ?>
                <div class="modal-body">
                    <input type="hidden" id="net_price" class="price" value="0">
                    <div class="form-group row">
                        <label for="available_quantity"
                            class="col-sm-4 col-form-label"><?php echo display('available_quantity') ?></label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="available_quantity"
                                placeholder="<?php echo display('available_quantity') ?>" name="available_quantity"
                                readonly="readonly">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="unit" class="col-sm-4 col-form-label"><?php echo display('unit') ?></label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="unit"
                                placeholder="<?php echo display('unit') ?>" name="unit" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="<?php echo display('quantity') ?>"
                            class="col-sm-4 col-form-label"><?php echo display('quantity') ?> <span
                                class="color-red">*</span></label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="<?php echo display('quantity') ?>"
                                name="quantity">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="<?php echo display('rate') ?>"
                            class="col-sm-4 col-form-label"><?php echo display('rate') ?> <span
                                class="color-red">*</span></label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="<?php echo display('rate') ?>" name="rate">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="<?php echo display('discount') ?>"
                            class="col-sm-4 col-form-label"><?php echo display('discount') ?></label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="<?php echo display('discount') ?>"
                                placeholder="<?php echo display('discount') ?>" name="discount">
                        </div>
                    </div>
                    <input type="hidden" name="rowID">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-dismiss="modal"><?php echo display('close') ?></button>
                    <button type="submit" class="btn btn-success"><?php echo display('save_changes') ?></button>
                </div>
                <?php echo form_close() ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>


<!-- Calculator modal -->
<div class="modal fade-scale" id="calculator" role="dialog">
    <div class="modal-dialog" id="calculatorcontent">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="calcontainer">
                    <div class="screen">
                        <h1 id="mainScreen">0</h1>
                    </div>
                    <table class="cal-table">
                        <tr>
                            <td><button class="cal-btn" onclick="DeleteLastSymbol()">CE</button></td>
                            <td colspan="2"><button class="cal-btn" onclick="ClearScreen()">C</button></td>
                            <td colspan="1"><button class="cal-btn" data-dismiss="modal" class="btn-danger"><i
                                        class="fa fa-power-off"></i></button></td>
                        </tr>
                        <tr>
                            <td><button class="cal-btn" value="7" id="7" onclick="InputSymbol(7)">7</button></td>
                            <td><button class="cal-btn" value="8" id="8" onclick="InputSymbol(8)">8</button></td>
                            <td><button class="cal-btn" value="9" id="9" onclick="InputSymbol(9)">9</button></td>
                            <td><button class="cal-btn" value="/" id="104" onclick="InputSymbol(104)">/</button></td>
                        </tr>
                        <tr>
                            <td><button class="cal-btn" value="4" id="4" onclick="InputSymbol(4)">4</button></td>
                            <td><button class="cal-btn" value="5" id="5" onclick="InputSymbol(5)">5</button></td>
                            <td><button class="cal-btn" value="6" id="6" onclick="InputSymbol(6)">6</button></td>
                            <td><button class="cal-btn" value="*" id="103" onclick="InputSymbol(103)">*</button></td>
                        </tr>
                        <tr>

                            <td><button class="cal-btn" value="1" id="1" onclick="InputSymbol(1)">1</button></td>
                            <td><button class="cal-btn" value="2" id="2" onclick="InputSymbol(2)">2</button></td>
                            <td><button class="cal-btn" value="3" id="3" onclick="InputSymbol(3)">3</button></td>
                            <td><button class="cal-btn" value="-" id="102" onclick="InputSymbol(102)">-</button></td>
                        </tr>
                        <tr>

                            <td><button class="cal-btn" value="." id="128" onclick="InputSymbol(128)">.</button></td>
                            <td><button class="cal-btn" value="0" id="0" onclick="InputSymbol(0)">0</button></td>
                            <td colspan="1"><button class="cal-btn" onclick="CalculateTotal()">=</button></td>
                            <td><button class="cal-btn" value="+" id="101" onclick="InputSymbol(101)">+</button></td>

                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div><!-- /.modal -->

<!-- POS Invoice Report End -->
<input type="hidden" id="user_name" value="<?php echo $this->session->userdata('user_name'); ?>">
<input type="hidden" id="company_name" value="<?php echo html_escape($company_name) ?>">
<input type="hidden" id="total_product" value="<?php echo  html_escape($total_product); ?>">
<input type="hidden" id="display_product" value="<?php echo  count(@$product_list); ?>">
<?php $checkModule = $this->db->where('directory', 'day_closing')->where('status', 1)->get('module')->num_rows();
if ($checkModule == 1) { ?>
<a id="dayClose" hidden></a>
<script src="<?php echo base_url('application/modules/day_closing/assets/js/cashregister.js') ?>"
    type="text/javascript"></script>
<?php } ?>
<script src="<?php echo MOD_URL . 'dashboard/assets/js/add_pos_invoice_form2.js'; ?>"></script>

<script type="text/javascript">
$(document).ready(function() {
    $("#store_id").select2({
        disabled: 'readonly'
    });
});
</script>