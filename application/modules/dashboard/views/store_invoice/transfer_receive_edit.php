<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Store product transfer start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('transfer') ?></h1>
            <small><?php echo display('transfer_product') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('transfer_product') ?></a></li>
                <li class="active"><?php echo display('transfer') ?></li>
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
                    <a href="<?php echo base_url('dashboard/Store_invoice/received_transfer_request') ?>"
                        class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i>
                        <?php echo display('received_transfer_request') ?></a>
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
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="transfer_from"
                                        class="col-sm-4 col-form-label"><?php echo display('transfer_from') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="transfer_from" name="transfer_from" disabled>
                                            <option value=""></option>
                                            <?php if (!empty($store_list)) {
                                                foreach ($store_list as $store_item) {
                                                    if ($mystore_id == $store_item['store_id']) {
                                            ?>
                                            <option value="<?php echo $store_item['store_id']; ?>" selected>
                                                <?php echo html_escape($store_item['store_name']); ?></option>
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="transfer_to"
                                        class="col-sm-4 col-form-label"><?php echo display('transfer_to') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="transfer_to" name="transfer_to" required="">
                                            <option value=""></option>
                                            <?php if (!empty($store_list)) {
                                                foreach ($store_list as $store_item) {
                                                    if ($mystore_id != $store_item['store_id']) {
                                            ?>
                                            <option value="<?php echo $store_item['store_id']; ?>"
                                                <?php echo (($transinfo['transfer_to'] == $store_item['store_id']) ? 'selected' : '') ?>>
                                                <?php echo html_escape($store_item['store_name']); ?></option>
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
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
                                        <th class="text-center"><?php echo display('quantity') ?><i
                                                class="text-danger">*</i></th>
                                    </tr>
                                </thead>
                                <tbody id="addPurchaseItem">
                                    <?php foreach ($trans_list as $key => $item) {
                                        $index = $key + 1;
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="text" name="product_name[<?php echo $index; ?>]" required
                                                class="form-control product_name productSelection"
                                                onkeyup="get_store_product_list(<?php echo $index; ?>);"
                                                placeholder="<?php echo display('product_name') ?>"
                                                id="product_name_<?php echo $index; ?>" tabindex="5"
                                                value="<?php echo html_escape($item['product_name']) ?>">
                                            <input type="hidden"
                                                class="autocomplete_hidden_value product_id_<?php echo $index; ?>"
                                                name="product_id[<?php echo $index; ?>]" id="SchoolHiddenId"
                                                value="<?php echo $item['product_id'] ?>" />
                                            <input type="hidden" class="sl" value="<?php echo $index; ?>">
                                        </td>
                                        <td class="text-center">
                                            <div class="variant_id_div">
                                                <select name="variant_id[<?php echo $index; ?>]"
                                                    id="variant_id_<?php echo $index; ?>" value=""
                                                    class="form-control variant_id width_100p" required="">
                                                    <option value=""></option>
                                                    <option value="<?php echo $item['variant_id'] ?>" selected>
                                                        <?php echo html_escape($item['variant_name']) ?></option>
                                                </select>
                                            </div>
                                            <div id="color_variant_area_<?php echo $index; ?>">
                                                <select name="color_variant[<?php echo $index; ?>]"
                                                    id="color_variant_<?php echo $index; ?>" value=""
                                                    class="form-control color_variant width_100p">
                                                    <option value=""></option>
                                                    <?php if (!empty($item['variant_color'])) { ?>
                                                    <option value="<?php echo $item['variant_color'] ?>" selected>
                                                        <?php echo html_escape($item['variant_color_name']) ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <?php
                                                $filterdata = array(
                                                    'product_id' => $item['product_id'],
                                                    'variant_id' => $item['variant_id'],
                                                    'variant_color' => $item['variant_color'],
                                                    'store_id' => $item['store_id']
                                                );
                                                $prod_stock = $this->Store_invoices->store_available_stock($filterdata);
                                                ?>
                                            <input type="number" id="avl_qntt_<?php echo $index; ?>"
                                                class="form-control text-right" placeholder="0"
                                                value="<?php echo $prod_stock ?>" readonly />
                                        </td>
                                        <td class="text-right">
                                            <input type="number" name="product_quantity[<?php echo $index; ?>]"
                                                id="total_qntt_<?php echo $index; ?>" class="form-control text-right"
                                                placeholder="0" min="0" required=""
                                                value="<?php echo html_escape($item['quantity']) ?>" />
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-8">
                                <a href="<?php echo base_url('dashboard/Store_invoice/received_transfer_request'); ?>"
                                    class="btn btn-danger">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Store product transfer end -->
<script src="<?php echo MOD_URL . 'dashboard/assets/js/store_transfer_product.js'; ?>"></script>