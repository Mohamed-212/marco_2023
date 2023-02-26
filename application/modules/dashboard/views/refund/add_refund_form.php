<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Customer js php -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/customer_add_refund.js.php"></script>
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
            <h1><?php echo display('new_return') ?></h1>
            <small><?php echo display('add_new_return') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('return') ?></a></li>
                <li class="active"><?php echo display('new_return') ?></li>
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
                            <h4><?php echo display('new_return') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open(base_url() . '/dashboard/Crefund/get_invoice_by_product', array('class' => 'form-vertical', 'id' => 'validate', 'name' => 'insert_invoice')) ?>
                        <div class="row">
                            <div class="col-sm-6" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="customer_name" class="col-sm-4 col-form-label"><?php echo display('customer_name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" size="100" value="<?php echo html_escape($customer_name); ?>" name="customer_name" required class="customerSelection form-control" placeholder='<?php echo display('customer_name_or_phone'); ?>' id="customer_name" autocomplete="off" />
                                        <input id="SchoolHiddenId" value="<?php echo html_escape($customer_id) ?>" class="customer_hidden_value" type="hidden" name="customer_id" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label"><?php echo display('type') ?>:</label>
                                    <div class="col-sm-8">
                                        <select name="type" id="type" class="form-control">
                                            <option value="0"></option>
                                            <option value="1"><?= display('invoice') ?></option>
                                            <option value="2"><?= display('without') ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="invoice_id_div" style="display: none;">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label"><?php echo display('invoice') ?>:</label>
                                    <div class="col-sm-8">
                                        <select name="invoice_id" id="invoice_id" class="form-control select2" style="width: 100%;">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="product_id_div" style="display: none;">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label"><?php echo display('product_name') ?>:</label>
                                    <div class="col-sm-8">
                                        <select name="product_id[]" id="product_id" class="form-control select2" multiple data-multiple="true" style="width: 100%;">
                                            <option value=""></option>
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
                                        <button type="submit" class="btn btn-success"><?= display('search') ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>

                    <div class="panel-body mt-5">
                        <div class="table-responsive mt_10">
                            <?php echo form_open(base_url() . '/dashboard/Crefund/new_return', ['class' => 'form-vertical new_return', 'id' => 'validate', 'name' => 'insert_invoice']) ?>
                            <table class="table table-bordered table-hover" id="normalinvoice">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <input type="checkbox" name="select_all" id="select_all" value="" />
                                        </th>
                                        <th class="text-center"><?php echo display('invoice') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('product_name') ?></i></th>
                                        <th class="text-center"><?php echo display('price') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('available_quantity') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center" id="trans" data-fit="<?= display('fit') ?>" data-warranty="<?= display('no warranty') ?>" data-damaged="<?= display('damaged') ?>"><?php echo display('status') ?></th>
                                        <th class="text-center"><?php echo display('return_price') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('quantity') ?> <i class="text-danger">*</i></th>
                                        <!-- <th class="text-center"><?php echo display('action') ?> <i class="text-danger">*</i></th> -->
                                    </tr>
                                </thead>
                                <tbody id="addinvoiceItem">

                                    <?php
                                        $warrntyId = $this->db->select('store_id')->from('store_set')->where('store_name', 'Warranty Store')->limit(1)->get()->row();
                                    ?>

                                    <?php if (!empty($invoices)) : $tqty = 0;?>
                                        <?php foreach ($invoices as $inx => $inv) : $tqty += $inv->ava_quantity >= 1 ? 1 : 0;?>
                                            <tr>

                                                <input type="hidden" hidden name="customer_id" value="<?= $customer_id ?>" />
                                                <input type="hidden" hidden name="product_id" value="<?= $product_id ?>" />
                                                <input type="hidden" hidden name="invoice_no" value="<?= $inv->invoice ?>" />
                                                <input type="hidden" hidden name="invoice_id" value="<?= $inv->invoice_id ?>" />
                                                <input type="hidden" hidden name="payment_id" value="<?= $inv->payment_id ?>" />
                                                <input type="hidden" hidden name="variant_id" value="<?= $inv->variant_id ?>" />
                                                <td>
                                                    <input class="select_product" type="checkbox" name="selected_products_inx[]" value="<?= $inx +1 ?>" />
                                                </td>
                                                <td>
                                                    <a href="<?= base_url() ?>/dashboard/Cinvoice/invoice_inserted_data/<?= $inv->invoice_id ?>"><?= $inv->invoice ?></a>
                                                    <input class="" type="hidden" hidden name="invoice_id_<?= $inx + 1 ?>" value="<?= $inv->invoice_id ?>" />
                                                    <input class="" type="hidden" hidden name="payment_id_<?= $inx + 1 ?>" value="<?= $inv->payment_id ?>" />
                                                </td>
                                                <td>
                                                    <a href="<?= base_url() ?>/dashboard/Cproduct/product_details/<?= $inv->product_id ?>"><?= $inv->product_name ?></a>
                                                    <input class="" type="hidden" hidden name="invoice_products_id_<?= $inx + 1 ?>" value="<?= $inv->product_id ?>" />
                                                    <input class="" type="hidden" hidden name="variant_id_<?= $inx + 1 ?>" value="<?= $inv->variant_id ?>" />
                                                </td>
                                                <td>
                                                    <span id="rate_<?= $inx + 1 ?>">
                                                    <?php
                                                    $item_discount = round(((float)$inv->item_invoice_discount * (float)$inv->ava_quantity) + ((float)$inv->discount * (float)$inv->ava_quantity), 2);
                                                    $total_price_after_discount = round((float)$inv->total_price - (float)$item_discount, 2);

                                                    // var_dump($item_discount, $total_price_after_discount, $inv->total_price);
                                                    // echo $total_price_after_discount;
                                                    echo round($inv->rate == $inv->price ? $inv->without_price_after_disc : $inv->whole_price_after_disc, 2);
                                                    ?>
                                                    </span>
                                                    
                                                    <input type="hidden" hidden name="rate_<?= $inx + 1 ?>" value="<?= $inv->rate ?>" />
                                                </td>
                                                <td><input type='text' id='available_quantity_<?= $inx + 1 ?>' name='available_quantity_<?= $inx + 1 ?>' class='form-control text-right available_quantity_<?= $inx + 1 ?>' id='avl_qntt_<?= $inx + 1 ?>' placeholder='0' readonly='' value="<?= $inv->ava_quantity ?>" /></td>
                                                </td>
                                                <td>
                                                    <select class='form-control' id='status_<?= $inx + 1 ?>' required='required' name='status_<?= $inx + 1 ?>'>
                                                        <option value='0'><?= display('fit') ?></option>
                                                        <option value='1'><?= display('damaged') ?></option>
                                                        <?php if ($inv->store_id != $warrntyId->store_id) { ?>
                                                        <option value='2'><?= display('no warranty') ?></option>
                                                        <?php 
                                                        }?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class='form-control pri-type' id='price_type_<?= $inx + 1 ?>' required='required' name='price_type_<?= $inx + 1 ?>' data-without-price="<?=$inv->without_price_after_disc?>" data-whole-price="<?=$inv->whole_price_after_disc?>" data-inx="<?= $inx + 1 ?>">
                                                        <option value='0' <?= $inv->rate != $inv->price ?: 'selected' ?>><?= display('sell_price') ?></option>
                                                        <option value='1' <?= $inv->rate == $inv->price ?: 'selected' ?>><?= display('with_cases_price') ?></option>
                                                    </select>
                                                </td>
                                                <td><input type='number' class='form-control qty44' id='quantity_<?= $inx + 1 ?>' required='required' min='0' max='<?= $inv->ava_quantity ?>' name='quantity_<?= $inx + 1 ?>' value="<?=$inv->ava_quantity >= 1 ? 1 : 0?>"></td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                        <td colspan="7" class="text-right"><b><?php echo display('total_quantity') ?> :</b>
                                        </td>
                                        <td class="text-right">
                                            <input type="number" step="1" min="0" id="total_quantity" class="form-control text-right" name="total_quantity" placeholder="0" readonly="readonly" value="<?=$tqty?>" />
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div style="text-align: center;">
                                <button type="submit" class="btn btn-primary"><?= display('submit') ?></button>
                            </div>
                            <?php echo form_close() ?>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Invoice Report End -->
<script>
    $(document).ready(function() {
        var csrf_test_name = $("#CSRF_TOKEN").val();
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

        $(document).on('change', '#type', function() {
            var val = $(this).val();
            var customer_id = $('#SchoolHiddenId').val();

            if (val == 1) {
                $('div#product_id_div').css('display', 'none');
                // get customer invoices
                $.ajax({
                    url: base_url + "dashboard/Crefund/get_customer_invoices",
                    method: "post",
                    data: {
                        csrf_test_name: csrf_test_name,
                        customer_id: customer_id,
                    },
                    success: function(data) {
                        $('select#invoice_id').html(data);
                        $('div#invoice_id_div').css('display', 'block');
                    },
                });
            } else {
                $('div#invoice_id_div').css('display', 'none');
                $.ajax({
                    url: base_url + "dashboard/Crefund/get_customer_invoice_products",
                    method: "post",
                    data: {
                        csrf_test_name: csrf_test_name,
                        customer_id: customer_id,
                    },
                    success: function(data) {
                        console.log(data);
                        $('select#product_id').html(data);
                        $('div#product_id_div').css('display', 'block');
                    },
                });
            }
        });
        $(document).on('click', '#select_all', function() {
            var val = $(this).prop('checked');
            $('.select_product').each(function(inx, el) {
                // console.log(el);

                $(el).prop("checked", true);
                if (val == true) {
                    $(el).prop('checked', true);
                } else {
                    $(el).prop('checked', false);
                }
            });
        });

        $('.pri-type').change(function() {
            if ($(this).val() == 0) {
                $('#rate_' + $(this).attr('data-inx')).text(
                    Number($(this).attr('data-without-price')).toFixed(2)
                );
            } else {
                $('#rate_' + $(this).attr('data-inx')).text(
                    Number($(this).attr('data-whole-price')).toFixed(2)
                );
            }
        });

        $('.qty44').change(function() {
            var tqty = 0;
            $('.qty44').each(function(inx, el) {
                tqty += Number($(this).val());
            }).promise().done(function() {
                $('#total_quantity').val(tqty);
            });
        });
    });
</script>