<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Payment type select by js start-->
<style>
<?php if ($wearhouse_id) {
    echo "#store_hide{display:none;}";
}

else {
    echo "#wearhouse_hide{display:none;}";
}

?>
</style>
<link rel="stylesheet" href="<?php echo MOD_URL . 'dashboard/assets/css/purchase_return_form.css' ?>">
<!-- Edit Purchase Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('purchase_return') ?></h1>
            <small><?php echo display('purchase_return_form') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('purchase') ?></a></li>
                <li><a href="#"><?php echo display('manage_purchase') ?></a></li>
                <li class="active"><?php echo display('purchase_return_form') ?></li>
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

        <!-- Purchase report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('purchase_return_form') ?></h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('dashboard/Cpurchase_return/insert_purchase_return', array('class' => 'form-vertical', 'id' => 'validate')) ?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="description"
                                        class="col-sm-3 col-form-label"><?php echo display('supplier') ?> <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-6">
                                        <!-- js-example-basic-single -->
                                        <select name="supplier_id" id="supplier_id" class="form-control " required=""
                                            readonly>
                                            <!-- {supplier_list}
                                            <option value="{supplier_id}">{supplier_name}</option>
                                            {/supplier_list} -->
                                            {supplier_selected}
                                            <option selected value="{supplier_id}">{supplier_name} </option>
                                            {/supplier_selected}
                                        </select>
                                    </div>
                                    <div class="col-sm-3 hidden">
                                        <a
                                            href="<?php echo base_url('dashboard/Csupplier'); ?>"><?php echo display('add_supplier') ?></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="product_name"
                                        class="col-sm-4 col-form-label"><?php echo display('return_date') ?> <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" tabindex="3" class="form-control datepicker"
                                            name="return_date" value="<?php echo date('Y-m-d') ?>" required readonly />
                                        <input type="hidden" name="purchase_id" value="{purchase_id}">
                                        <input type="hidden" id="generated_batch"
                                            value="<?php echo html_escape($batch_no) ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="product_name"
                                        class="col-sm-3 col-form-label"><?php echo display('supplier_invoice_no') ?> <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text" tabindex="3" class="form-control" name="invoice_no"
                                            placeholder="<?php echo display('supplier_invoice_no') ?>" required
                                            value="{invoice_no}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="adress"
                                        class="col-sm-4 col-form-label"><?php echo display('details') ?></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" tabindex="1" id="adress" name="return_details"
                                            placeholder=" <?php echo display('details') ?>">{purchase_details}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6" id="-store_hide">
                                <div class="form-group row">
                                    <label for="store_id"
                                        class="col-sm-3 col-form-label"><?php echo display('purchase_to') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-9">
                                        <select name="store_id" id="store_id" class="form-control width_100p"
                                            required="" readonly>
                                            <option value=""></option>
                                            <?php
                                            if ($store_list) {
                                                foreach ($store_list as $store) {
                                            ?>
                                            <option value="<?php echo html_escape($store['store_id']) ?>" <?php if ($store['store_id'] == $store_id) {
                                                                                                                        echo "selected";
                                                                                                                    }
                                                                                                                    ?>>
                                                <?php echo html_escape($store['store_name']) ?>
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
                        <?php
                        if (check_module_status('woocommerce')) {
                            $defstore_status = $this->db->where('store_id', $store_id)->where('default_status', 1)->get('store_set');
                        ?>
                        <div id="store_stock_update"
                            class="<?php echo (($defstore_status->num_rows() > 0) ? '' : 'none'); ?>">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="store_id"
                                            class="col-sm-3 col-form-label"><?php echo display('stock') ?>
                                        </label>
                                        <div class="col-sm-9">
                                            <div class="checkbox checkbox-success">
                                                <input id="checkbox2" name="woocom_stock" value="1" type="checkbox"
                                                    readonly>
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
                        $(document).ready(function() {
                            $('#store_id').on('change', function() {
                                var store_id = $(this).val();
                                var csrf_test_name = $("#CSRF_TOKEN").val();
                                $.ajax({
                                    url: base_url + 'dashboard/Cpurchase/check_default_store',
                                    method: 'post',
                                    data: {
                                        csrf_test_name: csrf_test_name,
                                        store_id: store_id
                                    },
                                    success: function(data) {
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
                            <table class="table table-bordered table-hover" id="purchaseTable">
                                <thead>
                                    <tr>
                                        <th class="text-center w5">
                                            <div class="row">
                                                <label for="select_all"><?php echo display('select_all'); ?><i
                                                        class="text-danger">*</i></label><br>
                                                <input type="checkbox" id="select_all" name="" value="1"
                                                    id="select_all">
                                            </div>
                                        </th>
                                        <th class="text-center"><?php echo display('item_information') ?><i
                                                class="text-danger">*</i></th>
                                        <th class="text-center" width="130"><?php echo display('variant') ?><i
                                                class="text-danger">*</i></th>
                                        <th class="text-center" width="130">Batch</th>
                                        <th class="text-center" width="130">Expire Date</th>
                                        <th class="text-center"><?php echo display('available_quantity') ?></th>
                                        <th class="text-center"><?php echo display('quantity') ?><i
                                                class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('rate') ?><i
                                                class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('discount') ?><i
                                                class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('total') ?><i
                                                class="text-danger">*</i></th>
                                    </tr>
                                </thead>
                                <tbody id="addPurchaseItem">
                                    <?php
                                    if ($purchase_info) {
                                        $row = 0;
                                        foreach ($purchase_info as $purchase) {
                                            $row++;
                                            //Stock available qty variant wise
                                            $this->db->select('SUM(a.quantity) as total_purchase');
                                            $this->db->from('product_purchase_details a');
                                            $this->db->where('a.product_id', $purchase['product_id']);
                                            $this->db->where('a.variant_id', $purchase['variant_id']);
                                            if (!empty($purchase['wearhouse_id'])) {
                                                $this->db->where('a.wearhouse_id', $purchase['wearhouse_id']);
                                            } else {
                                                $this->db->where('a.store_id', $purchase['store_id']);
                                            }
                                            $total_purchase = $this->db->get()->row();

                                            //Total purchase
                                            $this->db->select('SUM(b.quantity) as total_sale');
                                            $this->db->from('invoice_stock_tbl b');
                                            $this->db->where('b.product_id', $purchase['product_id']);
                                            $this->db->where('b.variant_id', $purchase['variant_id']);

                                            if (!empty($purchase['wearhouse_id'])) {
                                                $this->db->where('b.status', 1);
                                            } else {
                                                $this->db->where('b.store_id', $purchase['store_id']);
                                            }
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
                                            <div class="text-center">
                                                <input type="checkbox" class="checkboxx"
                                                    name="product[<?php echo $row ?>]"
                                                    value="<?php echo html_escape($purchase['product_id']) ?>">
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="product_name" required
                                                class="form-control product_name productSelection"
                                                onkeyup="product_pur_or_list(<?php echo $purchase['sl'] ?>);"
                                                placeholder="<?php echo display('product_name') ?>"
                                                id="product_name_<?php echo $purchase['sl'] ?>" tabindex="5"
                                                value="<?php echo html_escape($purchase['product_name']) . '-(' . html_escape($purchase['product_model']) ?>)"
                                                readonly>
                                            <input type="hidden"
                                                class="autocomplete_hidden_value product_id_<?php echo $purchase['sl'] ?>"
                                                name="product_id[<?php echo $row ?>]" id=""
                                                value="<?php echo html_escape($purchase['product_id']) ?>" />
                                            <input type="hidden" class="sl" value="<?php echo $purchase['sl'] ?>">
                                        </td>
                                        <td class="text-center">
                                            <div class="variant_id_div">
                                                <select name="variant_id[<?php echo $row ?>]"
                                                    id="variant_id_<?php echo $purchase['sl'] ?>"
                                                    class="form-control variant_id width_100p" required>
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
                                                <select name="color_variant[<?php echo $row ?>]"
                                                    id="color_variant_<?php echo $purchase['sl'] ?>"
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
                                                <input type="hidden" name="color_variant[<?php echo $row ?>]"
                                                    id="variant_color_id<?php echo $purchase['sl'] ?>">
                                                <?php } ?>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <input type="text" name="batch_no[<?php echo $row ?>]" id="batch_no_1"
                                                class="form-control text-right"
                                                value="<?php echo html_escape($purchase['batch_no']) ?>" placeholder="0"
                                                readonly />
                                            <input type="hidden" id="generated_batch" value="">
                                        </td>
                                        <td class="text-right">
<!--                                            <input type="text" id="expiry_date_1" name="expiry_date[--><?php //echo $row ?><!--]"-->
<!--                                                value="--><?php //echo html_escape($purchase['expiry_date']) ?><!--"-->
<!--                                                class="form-control datepicker"-->
<!--                                                placeholder="--><?php //echo display('enter_expire_date') ?><!--" readonly />-->
                                            <input type="text" id="expiry_date_1"
                                                   value="<?php echo html_escape($purchase['expiry_date']) ?>"
                                                   class="form-control datepicker"
                                                   placeholder="<?php echo display('enter_expire_date') ?>" readonly />
                                        </td>
                                        <td class="text-right">
                                            <input type="number" id="avl_qntt_<?php echo $purchase['sl'] ?>"
                                                class="form-control text-right" placeholder="0" readonly
                                                value="<?php echo html_escape($total_purchase->total_purchase - $total_sale->total_sale); ?>" />
                                        </td>
                                        <td class="text-right">
                                            <input type="number" class="form-control product_quantity"
                                                name="product_quantity[<?php echo $row ?>]"
                                                data-row="<?php echo $row ?>" class="form-control text-right"
                                                placeholder="0" value="<?php echo html_escape($purchase['quantity']) ?>"
                                                min="0" required readonly />
                                        </td>
                                        <td id="rate_<?php echo $row ?>">
                                            <input type="number" name="product_rate[<?php echo $row ?>]"
                                                value="<?php echo html_escape($purchase['rate']) ?>"
                                                id="price_item_<?php echo $purchase['sl'] ?>"
                                                class="price_item<?php echo $purchase['sl'] ?> text-right form-control"
                                                placeholder="0.00" min="0" required readonly />
                                        </td>
                                        <td id="discount_<?php echo $row ?>">
                                            <input type="number" name="discount[<?php echo $row ?>]"
                                                value="<?php echo html_escape($purchase['discount']) ?>"
                                                id="price_item_<?php echo $purchase['sl'] ?>"
                                                class="price_item<?php echo $purchase['sl'] ?> text-right form-control"
                                                placeholder="0.00" min="0" required readonly />
                                        </td>
                                        <td class="text-right" id="total_<?php echo $row ?>">
                                            <input class="total_price text-right form-control"
                                                value="<?php echo html_escape($purchase['total_amount']) ?>" type="text"
                                                name="total_price[<?php echo $row ?>]"
                                                id="total_price_<?php echo $purchase['sl'] ?>" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <input type="submit" id="return-purchase" class="btn btn-success btn-large"
                                    name="return-purchase" value="<?php echo display('return') ?>" />
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Edit Purchase End -->
<script src="<?php echo MOD_URL . 'dashboard/assets/js/purchase_return.js'; ?>"></script>