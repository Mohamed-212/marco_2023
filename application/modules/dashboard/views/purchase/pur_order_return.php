<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo MOD_URL . 'dashboard/assets/css/dashboard.css' ?>">


<!-- Add New Purchase Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('purchase_order_return') ?></h1>
            <small><?php echo display('return_item') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('purchase') ?></a></li>
                <li><a href="#"><?php echo display('purchase_order') ?></a></li>
                <li><a href="#"><?php echo display('receive_item') ?></a></li>
                <li class="active"><?php echo display('return_item') ?></li>
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
                    <?php if ($this->permission->check_label('purchase_order')->read()->access()) { ?>
                    <a href="<?php echo base_url('dashboard/Cpurchase/purchase_order') ?>"
                        class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i>
                        <?php echo display('manage_purchase_order') ?></a>
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
                            <h4><?php echo display('return_item') ?></h4>
                        </div>
                    </div>

                    <div class="panel-body">
                        <?php echo form_open('dashboard/Cpurchase/manage_purorder/return/' . $pur_order_id, array('class' => 'form-vertical', 'id' => 'validate', 'name' => 'insert_purchase')) ?>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="supplier_sss"
                                        class="col-sm-4 col-form-label"><?php echo display('supplier') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-5">
                                        <select name="supplier_id" id="supplier_id" class="form-control " required=""
                                            readonly>
                                            <option value=""><?php echo display('select_one') ?></option>
                                            <?php foreach ($all_supplier as $supplier) { ?>
                                            <option value="<?php echo $supplier['supplier_id']; ?>"
                                                <?php echo (($supplier['supplier_id'] == $supplier_id) ? 'selected' : '') ?>>
                                                <?php echo html_escape($supplier['supplier_name']); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <a
                                            href="<?php echo base_url('dashboard/Csupplier'); ?>"><?php echo display('add_supplier') ?></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date"
                                        class="col-sm-4 col-form-label"><?php echo display('purchase_date') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" tabindex="3" class="form-control datepicker"
                                            name="purchase_date" value="<?php echo html_escape($purchase_date); ?>"
                                            id="date" required readonly />

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="purchase_order"
                                        class="col-sm-4 col-form-label"><?php echo display('purchase_order') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" tabindex="3" class="form-control" name="purchase_order"
                                            value="<?php echo html_escape($pur_order_no); ?>"
                                            placeholder="<?php echo display('purchase_order') ?>" id="purchase_order"
                                            readonly />
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="adress" class="col-sm-4 col-form-label"><?php echo display('details') ?>
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" tabindex="1" id="adress" name="purchase_details"
                                            placeholder=" <?php echo display('details') ?>" rows="1"
                                            readonly><?php echo html_escape($purchase_details); ?></textarea>
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
                                            required="" readonly>
                                            <option value=""></option>
                                            <?php foreach ($store_list as $store) : ?>
                                            <option value="<?php echo html_escape($store['store_id']) ?>"
                                                <?php echo ((@$store_id == $store['store_id']) ? 'selected' : '') ?>>
                                                <?php echo html_escape($store['store_name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="product_name"
                                        class="col-sm-4 col-form-label"><?php echo display('supplier_invoice_no') ?> <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" tabindex="3" class="form-control" name="invoice_no"
                                            placeholder="<?php echo display('supplier_invoice_no') ?>" required
                                            value="{invoice_no}" required readonly />
                                        <input type="hidden" name="purchase_id"
                                            value="<?php echo html_escape($purchase_id[0]->purchase_id); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive mt_10">
                            <table class="table table-bordered table-hover" id="purchaseTable">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_information') ?> <i
                                                class="text-danger">*</i></th>
                                        <th class="text-center" width="130"><?php echo display('variant') ?> <i
                                                class="text-danger">*</i></th>
                                        <th class="text-center" width="130"><?php echo display('batch') ?></th>
                                        <th class="text-center" width="130"><?php echo display('expire_date') ?></th>
                                        <th class="text-center"><?php echo display('available_quantity') ?> </th>
                                        <th class="text-center"><?php echo display('quantity') ?> <i
                                                class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('rate') ?> <i
                                                class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('discount') . ' (%)' ?> </th>
                                        <th class="text-center"><?php echo display('vat') . ' (%)' ?> </th>
                                        <th class="text-center"><?php echo display('product_vat') ?> </th>
                                        <th class="text-center"><?php echo display('total') ?> <i
                                                class="text-danger">*</i></th>
                                    </tr>
                                </thead>
                                <tbody id="addPurchaseItem">
                                    <?php
                                    if ($po_details) {
                                        $sl = 1;
                                        $grand_total = 0;
                                        foreach ($po_details as $purchase) {

                                            //Stock available qty variant wise
                                            $this->db->select('SUM(a.quantity) as total_purchase');
                                            $this->db->from('product_purchase_details a');
                                            $this->db->where('a.product_id', $purchase['product_id']);
                                            $this->db->where('a.variant_id', $purchase['variant_id']);
                                            if (!empty($purchase['variant_color'])) {
                                                $this->db->where('a.variant_color', $purchase['variant_color']);
                                            }
                                            $this->db->where('a.store_id', $purchase['store_id']);

                                            $total_purchase = $this->db->get()->row();

                                            //Total purchase
                                            $this->db->select('SUM(b.quantity) as total_sale');
                                            $this->db->from('invoice_stock_tbl b');
                                            $this->db->where('b.product_id', $purchase['product_id']);
                                            $this->db->where('b.variant_id', $purchase['variant_id']);

                                            if (!empty($purchase['variant_color'])) {
                                                $this->db->where('b.variant_color', $purchase['variant_color']);
                                            }

                                            $this->db->where('b.store_id', $purchase['store_id']);

                                            $total_sale = $this->db->get()->row();

                                            //Variant for per product
                                            $this->db->select('a.variants');
                                            $this->db->from('product_information a');
                                            $this->db->where(array('a.product_id' => $purchase['product_id'], 'a.status' => 1));
                                            $product_information = $this->db->get()->row();
                                            $exploded = explode(',', $product_information->variants);

                                            $this->db->select('*');
                                            $this->db->from('variant');
                                            $this->db->where_in('variant_id', $exploded);
                                            $this->db->order_by('variant_name', 'asc');
                                            $pvariants = $this->db->get()->result_array();
                                            $vtypes_arr = array_column($pvariants, 'variant_type');

                                    ?>
                                    <tr>
                                        <td>
                                            <input type="text" name="product_name" required
                                                class="form-control product_name productSelection"
                                                onkeyup="product_pur_or_list(<?php echo $sl ?>);"
                                                placeholder="<?php echo display('product_name') ?>"
                                                id="product_name_<?php echo $sl ?>" tabindex="5"
                                                value="<?php echo html_escape($purchase['product_name']) . '-(' . html_escape($purchase['product_model']) ?>)"
                                                readonly>

                                            <input type="hidden"
                                                class="autocomplete_hidden_value product_id_<?php echo $sl ?>"
                                                name="product_id[]" id=""
                                                value="<?php echo html_escape($purchase['product_id']) ?>" />
                                            <input type="hidden" name="pur_order_detail_id[]"
                                                value="<?php echo html_escape($purchase['pur_order_detail_id']) ?>" />

                                            <input type="hidden" class="sl" value="<?php echo $sl ?>">
                                        </td>

                                        <td class="text-center">
                                            <div class="variant_id_div">
                                                <select name="variant_id[]" id="variant_id_<?php echo $sl ?>"
                                                    class="form-control variant_id width_100p" required="" readonly>
                                                    <option value=""></option>
                                                    <?php
                                                            if (!empty($pvariants)) {
                                                                foreach ($pvariants as $vitem) {
                                                                    if ($vitem['variant_type'] == 'size') {
                                                            ?>
                                                    <option value="<?php echo html_escape($vitem['variant_id']) ?>"
                                                        <?php if ($purchase['variant_id'] == $vitem['variant_id']) {
                                                                                                                                            echo "selected";
                                                                                                                                        } ?>>
                                                        <?php echo html_escape($vitem['variant_name']) ?></option>
                                                    <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                </select>
                                            </div>
                                            <?php if (in_array('color', $vtypes_arr)) { ?>
                                            <div>
                                                <select name="color_variant[]" id="color_variant_<?php echo $sl ?>"
                                                    class="form-control color_variant width_100p" readonly>
                                                    <option value=""></option>
                                                    <?php
                                                                if (!empty($pvariants)) {
                                                                    foreach ($pvariants as $vitem) {
                                                                        if ($vitem['variant_type'] == 'color') {
                                                                ?>
                                                    <option value="<?php echo html_escape($vitem['variant_id']) ?>"
                                                        <?php if ($purchase['variant_color'] == $vitem['variant_id']) {
                                                                                                                                                echo "selected";
                                                                                                                                            } ?>>
                                                        <?php echo html_escape($vitem['variant_name']) ?></option>
                                                    <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                </select>
                                                <?php } else { ?>
                                                <input type="hidden" name="color_variant[]"
                                                    id="variant_color_id<?php echo $sl ?>">
                                                <?php } ?>
                                            </div>
                                        </td>

                                        <td class="text-right">
                                            <input type="text" name="batch_no[]" id="batch_no_1"
                                                class="form-control text-right" placeholder="0" />
                                            <input type="hidden" id="generated_batch"
                                                value="<?php echo $purchase['batch_no'] ?>">
                                        </td>
                                        <td class="text-right">
                                            <input type="text" id="expiry_date_1"
                                                value="<?php echo html_escape($purchase['expiry_date']) ?>"
                                                name="expiry_date[]" class="form-control datepicker"
                                                placeholder="<?php echo display('enter_expire_date') ?>" />
                                        </td>
                                        <td class="text-right">
                                            <input type="number" id="avl_qntt_<?php echo $sl ?>"
                                                class="form-control text-right" placeholder="0" readonly
                                                value="<?php echo html_escape($total_purchase->total_purchase - $total_sale->total_sale); ?>" />
                                        </td>


                                        <td class="text-right">

                                            <?php
                                                    if ($receive_status == '1') {
                                                        $pur_qnty = $purchase['rc_quantity'];
                                                    } else {
                                                        $pur_qnty = $purchase['quantity'];
                                                    }
                                                    ?>

                                            <input type="number" name="product_quantity[]"
                                                onkeyup="calculate_add_purchase(<?php echo $sl ?>);"
                                                onchange="calculate_add_purchase(<?php echo $sl ?>);"
                                                id="total_qntt_<?php echo $sl ?>"
                                                class="p_quantity form-control text-right" placeholder="0"
                                                value="<?php echo html_escape($pur_qnty) ?>" min="0" required />
                                        </td>


                                        <td>
                                            <?php
                                                    if ($receive_status == '1') {
                                                        $pur_rate = $purchase['rc_rate'];
                                                    } else {
                                                        $pur_rate = $purchase['rate'];
                                                    }
                                                    ?>

                                            <input type="number" name="product_rate[]"
                                                value="<?php echo html_escape($pur_rate) ?>"
                                                id="price_item_<?php echo $sl ?>"
                                                class="price_item<?php echo $sl ?> text-right form-control"
                                                onkeyup="calculate_add_purchase(<?php echo $sl ?>);"
                                                onchange="calculate_add_purchase(<?php echo $sl ?>);" placeholder="0.00"
                                                min="0" required readonly />
                                        </td>
                                        <!-- Discount -->
                                        <td>
                                            <input type="number" name="discount[]"
                                                value="<?php echo html_escape($purchase['discount']) ?>"
                                                onkeyup="calculate_add_purchase(<?php echo $sl ?>);"
                                                onchange="calculate_add_purchase(<?php echo $sl ?>);"
                                                id="discount_<?php echo $sl ?>" class="form-control text-right"
                                                placeholder="0.00" min="0" />
                                        </td>
                                        <td>
                                            <input type="number" name="vat_rate[]"
                                                value="<?php echo html_escape($purchase['vat_rate']) ?>"
                                                onkeyup="calculate_add_purchase(<?php echo $sl ?>);"
                                                onchange="calculate_add_purchase(<?php echo $sl ?>);"
                                                id="item_vat_rate_<?php echo $sl ?>" class="form-control text-right"
                                                placeholder="0.00" min="0" readonly />
                                        </td>
                                        <td>
                                            <input type="number" name="vat[]"
                                                value="<?php echo html_escape($purchase['vat']) ?>"
                                                id="item_vat_<?php echo $sl ?>" class="form-control text-right item_vat"
                                                placeholder="0.00" min="0" readonly />
                                        </td>
                                        <td class="text-right">
                                            <?php
                                                    if ($receive_status == '1') {
                                                        $pur_total_amt = $purchase['rc_total_amount'];
                                                    } else {
                                                        $pur_total_amt = $purchase['total_amount'];
                                                    }

                                                    $grand_total += $pur_total_amt;
                                                    ?>

                                            <input class="total_price text-right form-control"
                                                value="<?php echo html_escape($pur_total_amt) ?>" type="text"
                                                name="total_price[]" id="total_price_<?php echo $sl ?>"
                                                readonly="readonly" />

                                            <input type="hidden" name="purchase_detail_id[]"
                                                value="<?php echo html_escape($pur_total_amt) ?>" />
                                        </td>

                                    </tr>
                                    <?php
                                            $sl++;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>








                                    <tr>
                                        <td></td>
                                        <td class="text-right">
                                            <b><?php echo display('sub_total') ?>:</b>
                                        </td>
                                        <td class="text-right">
                                            <input type="text" id="subTotal" value="{sub_total_price}"
                                                class="text-right form-control" name="sub_total_price"
                                                placeholder="0.00" readonly="readonly" />
                                        </td>
                                        <th>
                                            <?php echo display('total_number_of_items') ?>
                                        </th>
                                        <td>
                                            <input type="text" id="total_items"
                                                onchange="calculate_add_purchase_cost(1);"
                                                value="<?php echo html_escape($purchase_info[0]['total_items']) ?>"
                                                class="text-right form-control" name="total_number_of_items"
                                                placeholder="0" readonly="readonly" />
                                        </td>
                                        <td class="text-right">
                                            <b><?php echo display('total_vat') ?>:</b>
                                        </td>
                                        <td>
                                            <input type="text" id="total_vat" class="text-right form-control"
                                                value="{total_purchase_vat}" name="total_purchase_vat"
                                                placeholder="0.00" readonly="readonly" />
                                        </td>
                                        <td class="text-right"><b><?php echo display('grand_total') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="grandTotal"
                                                value="<?php echo html_escape($grand_total); ?>"
                                                class="text-right form-control" name="grand_total_price" value="0.00"
                                                readonly="readonly" />
                                        </td>
                                        <td></td>
                                    </tr>




                                    <tr>
                                        <td class="text-center" colspan="11">
                                            <b><?php echo display('proof_of_purchase_expences') ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="11">
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
                                                    <?php if (count($proof_of_purchase_expese) > 0) {
                                                        foreach ($proof_of_purchase_expese as $key => $expese) {
                                                            $row_id = mt_rand();
                                                    ?>
                                                    <tr id="row_<?php echo $row_id ?>">
                                                        <td class="text-left">
                                                            <input type="text"
                                                                class="text-right form-control purchase_expences"
                                                                value="<?php echo html_escape($expese['expense_title']) ?>"
                                                                name="purchase_expences_title_<?php echo $key + 1 ?>"
                                                                placeholder="<?php echo display('please_Provide_expense_name') ?>" />
                                                        </td>
                                                        <td class="text-left">
                                                            <input type="text" onkeyup="calculate_add_purchase_cost(1);"
                                                                onchange="calculate_add_purchase_cost(1);"
                                                                value="<?php echo html_escape($expese['purchase_expense']) ?>"
                                                                id="purchase_expences_1"
                                                                class="text-right form-control purchase_expences"
                                                                name="purchase_expences_<?php echo $key + 1 ?>"
                                                                placeholder="0.00" />
                                                        </td>
                                                        <td>
                                                            <select class="form-control dont-select-me"
                                                                name="bank_id[]">
                                                                <option
                                                                    <?php echo ($expese['payment_method'] == 'cash') ? 'selected' : '' ?>
                                                                    value="cash"><?php echo display('cash') ?></option>
                                                                <?php
                                                                        if ($bank_list) {
                                                                            foreach ($bank_list as $bank) { ?>
                                                                <option
                                                                    <?php echo ($expese['payment_method'] == $bank->bank_id) ? 'selected' : '' ?>
                                                                    value="<?php echo $bank->bank_id ?>">
                                                                    <?php echo html_escape($bank->bank_name) ?>
                                                                </option>
                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                    if ($key == 0) {
                                                                    ?>
                                                            <button type="button" class="btn btn-success btn-sm"
                                                                onclick="add_new_p_cost_row('addPurchaseCost');">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                            <?php
                                                                    } else {
                                                                    ?>

                                                            <button type="button"
                                                                class="btn btn-danger btn-sm del_more_btn"
                                                                data-row_id="<?php echo $row_id ?>">
                                                                <i class="fa fa-minus"></i>
                                                            </button>

                                                            <?php
                                                                    }
                                                                    ?>

                                                        </td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    } else {
                                                        ?>
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
                                                                id="purchase_expences_1"
                                                                class="text-right form-control purchase_expences"
                                                                name="purchase_expences_1" placeholder="0.00" />
                                                        </td>
                                                        <td>
                                                            <select class="form-control dont-select-me"
                                                                name="bank_id[]">
                                                                <option value="cash"><?php echo display('cash') ?>
                                                                </option>
                                                                <?php

                                                                    if ($bank_list) {
                                                                        foreach ($bank_list as $bank) { ?>
                                                                <option value="<?php echo $bank->bank_id ?>">
                                                                    <?php echo html_escape($bank->bank_name) ?></option>
                                                                <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-success btn-sm"
                                                                onclick="add_new_p_cost_row('addPurchaseCost');">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <?php

                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th class="text-left"></th>
                                                        <th class="text-left"><?php echo display('total') ?></th>
                                                        <td class="text-left">
                                                            <input type="text" id="purchase_expences"
                                                                class="text-right form-control"
                                                                value="<?php echo html_escape($total_purchase_expense[0]['purchase_expense']) ?>"
                                                                name="purchase_expences" placeholder="0.00" readonly />
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </td>
                                    </tr>






                                </tfoot>
                            </table>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 text-right">
                                <a href="<?php echo base_url('dashboard/Cpurchase/receive_item'); ?>"
                                    class="btn btn-danger"><?php echo display('cancel') ?></a>
                                <input type="submit" id="add-purchase" class="btn btn-success btn-large"
                                    name="add-purchase" value="<?php echo display('return_item') ?>" />
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