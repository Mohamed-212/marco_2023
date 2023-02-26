<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Customer js php -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/customer.js.php"></script>
<!-- Product invoice js -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/product_invoice.js.php"></script>
<!-- Invoice js -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/invoice.js" type="text/javascript"></script>

<!-- Edit order Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('create_invoice') ?></h1>
            <small><?php echo display('create_invoice_form') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('order') ?></a></li>
                <li class="active"><?php echo display('create_invoice') ?></li>
            </ol>
        </div>
    </section>
    <section class="content">
        <!-- order report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <?php if ($this->permission->check_label('manage_customer')->update()->access()) { ?>
                            <a
                                href="<?php echo base_url('dashboard/Ccustomer/customer_update_form/' . $order_all_data[0]['customer_id']) ?>">
                                <button class="btn btn-warning"><?php echo display('customer_edit') ?></button>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                    <?php echo form_open('dashboard/Corder/order_to_invoice/' . $order_id, array('class' => 'form-vertical', 'id' => 'validate')) ?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6" id="">
                                <div class="form-group row">
                                    <label for="customer_name"
                                        class="col-sm-4 col-form-label"><?php echo display('customer_name') ?> <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="customer_name"
                                            value="<?php echo html_escape($customer_name) ?>"
                                            class="form-control customerSelection"
                                            placeholder='<?php echo display('customer_name_or_phone') ?>'
                                            id="customer_name" required readonly>
                                        <input type="hidden" class="customer_hidden_value" name="customer_id"
                                            value="<?php echo html_escape($customer_id) ?>" id="SchoolHiddenId" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" id="store">
                                <div class="form-group row">
                                    <label for="store_id" class="col-sm-4 col-form-label">
                                        <?php echo display('store') ?>
                                        <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="store_id" id="store_id">
                                            <option value=""></option>
                                            <?php foreach ($store_list as $store) { ?>
                                            <option value="<?php echo html_escape($store['store_id']); ?>" <?php if ($store['store_id'] == $store_id) {
                                                                                                                    echo "selected";
                                                                                                                } ?>>
                                                <?php echo html_escape($store['store_name']); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('date') ?> <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" tabindex="3" class="form-control datepicker"
                                            name="invoice_date" value="<?php echo html_escape($date); ?>" id="date"
                                            required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive mt_10">
                            <table class="table table-bordered table-hover" id="normalinvoice">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_information') ?> <i
                                                class="text-danger">*</i></th>
                                        <th class="text-center" width="130"><?php echo display('variant') ?> <i
                                                class="text-danger">*</i></th>
                                        <th class="text-center" width="130"><?php echo display('batch_no') ?> <i
                                                class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('available_quantity') ?></th>
                                        <th class="text-center"><?php echo display('quantity') ?> <i
                                                class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('rate') ?> <i
                                                class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('discount') ?> <i
                                                class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('total') ?> <i
                                                class="text-danger">*</i></th>
                                    </tr>
                                </thead>
                                <tbody id="addinvoiceItem">
                                    <?php
                                    $i = 0;
                                    if ($order_all_data) {
                                        foreach ($order_all_data as $value) {
                                            $i++;
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="text" name="product_name" required
                                                class="form-control product_name productSelection"
                                                onkeyup="invoice_productList(<?php echo $i ?>);"
                                                placeholder="<?php echo display('product_name') ?>"
                                                id="product_name_<?php echo $i ?>" tabindex="5"
                                                value="<?php echo html_escape($value['product_name']) . '-(' . html_escape($value['product_model']) ?>)">

                                            <input type="hidden"
                                                class="autocomplete_hidden_value product_id_<?php echo $i ?>"
                                                name="product_id[]" id=""
                                                value="<?php echo html_escape($value['product_id']) ?>" />

                                            <input type="hidden" class="sl" value="<?php echo $i ?>">
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                    //Variant for per product
                                                    $this->db->select('a.variants');
                                                    $this->db->from('product_information a');
                                                    $this->db->where(array('a.product_id' => $value['product_id'], 'a.status' => 1));
                                                    $product_information = $this->db->get()->row();
                                                    $exploded = explode(',', $product_information->variants);

                                                    $this->db->select('*');
                                                    $this->db->from('variant');
                                                    $this->db->where_in('variant_id', $exploded);
                                                    $this->db->order_by('variant_name', 'asc');
                                                    $pvariants = $this->db->get()->result_array();
                                                    $vtypes_arr = array_column($pvariants, 'variant_type');

                                                    //Stock available check from purchase
                                                    $this->db->select('SUM(a.quantity) as total_purchase');
                                                    $this->db->from('product_purchase_details a');
                                                    $this->db->where('a.product_id', $value['product_id']);
                                                    $this->db->where('a.variant_id', $value['variant_id']);
                                                    $this->db->where('a.store_id', $value['store_id']);
                                                    $total_purchase = $this->db->get()->row();

                                                    //Stock available check from invoice
                                                    $this->db->select('SUM(b.quantity) as total_sale');
                                                    $this->db->from('invoice_stock_tbl b');
                                                    $this->db->where('b.product_id', $value['product_id']);
                                                    $this->db->where('b.variant_id', $value['variant_id']);
                                                    $this->db->where('b.store_id', $value['store_id']);
                                                    $total_sale = $this->db->get()->row();

                                                    ?>
                                            <div class="variant_id_div">
                                                <select name="variant_id[]" id="variant_id_<?php echo $i ?>"
                                                    class="form-control variant_id width_100p" required="">
                                                    <?php
                                                            if (!empty($pvariants)) {
                                                                foreach ($pvariants as $vitem) {
                                                                    if ($vitem['variant_type'] == 'size') {
                                                            ?>
                                                    <option value="<?php echo html_escape($vitem['variant_id']) ?>"
                                                        <?php if ($value['variant_id'] == $vitem['variant_id']) {
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
                                                <select name="color_variant[]" id="variant_color_id_<?php echo $i ?>"
                                                    class="form-control color_variant width_100p">
                                                    <option value=""></option>
                                                    <?php
                                                                if (!empty($pvariants)) {
                                                                    foreach ($pvariants as $vitem) {
                                                                        if ($vitem['variant_type'] == 'color') {
                                                                ?>
                                                    <option value="<?php echo html_escape($vitem['variant_id']) ?>"
                                                        <?php if ($value['variant_color'] == $vitem['variant_id']) {
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
                                                    id="variant_color_id_<?php echo $i ?>">
                                                <?php } ?>
                                            </div>
                                        </td>
                                        <td class="text-center">

                                            <?php
                                                    $this->db->select('batch_no,expiry_date');
                                                    $this->db->from('product_purchase_details');
                                                    $this->db->where('product_id', $value['product_id']);
                                                    if (!empty($value['variant_id'])) {
                                                        $this->db->where('variant_id', $value['variant_id']);
                                                    }
                                                    if (!empty($value['variant_color'])) {
                                                        $this->db->where('variant_color', $value['variant_color']);
                                                    }
                                                    $batches = $this->db->get()->result_array();

                                                    if (!empty($batches)) { ?>
                                            <div>
                                                <select name="batch_no[]" id="batch_no_1"
                                                    class="form-control batch_no width_100p">
                                                    <?php foreach ($batches as $batch) { ?>
                                                    <option value="<?php echo $batch['batch_no'] ?>">
                                                        <?php echo $batch['batch_no'] . '(' . $batch['expiry_date'] . ')'; ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <?php } else { ?>
                                            <div>
                                                <select name="batch_no[]" id="batch_no_1"
                                                    class="form-control batch_no width_100p">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <input type="text" name="available_quantity[]"
                                                id="avl_qntt_<?php echo $i ?>"
                                                class="form-control text-right available_quantity_<?php echo $i ?>"
                                                placeholder="0" readonly=""
                                                value="<?php echo ($total_purchase->total_purchase - $total_sale->total_sale) ?>" />
                                        </td>
                                        <td class="text-right">
                                            <input type="number" name="product_quantity[]"
                                                value="<?php echo html_escape($value['quantity']) ?>"
                                                id="total_qntt_<?php echo $i ?>" class="form-control text-right" min="1"
                                                required="" />
                                        </td>
                                        <td>
                                            <input type="number" name="product_rate[]"
                                                value="<?php echo html_escape($value['rate']) ?>"
                                                id="price_item_<?php echo $i ?>"
                                                class="price_item<?php echo $i ?> form-control text-right" required=""
                                                min="0" />
                                            <input type="hidden" name="supplier_rate[]"
                                                value="<?php echo html_escape($value['supplier_rate']) ?>" required />
                                            <input type="hidden" name="status[]"
                                                value="<?php echo html_escape($value['status']) ?>" required />
                                        </td>
                                        <td>
                                            <input type="number" name="discount[]" id="discount_<?php echo $i ?>"
                                                class="form-control text-right" placeholder="Discount"
                                                value="<?php echo html_escape($value['discount']) ?>" min="0" />
                                        </td>
                                        <td>
                                            <input class="total_price form-control text-right" type="text"
                                                name="total_price[]" id="total_price_<?php echo $i ?>"
                                                value="<?php echo $value['total_price'] ?>" readonly="readonly" />
                                            <input type="hidden" name="order_details_id[]" id="order_details_id"
                                                value="<?php echo html_escape($value['order_details_id']) ?>" />
                                        </td>
                                    </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td align="center" colspan="7" class="width_220">
                                            <input type="submit" id="add-invoice" class="btn btn-success btn-large"
                                                name="add-invoice" value="Send to Invoice" />
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Edit order End -->
<script src="<?php echo MOD_URL . 'dashboard/assets/js/edit_order_form.js'; ?>"></script>