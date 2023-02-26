<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Customer js php -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/customer.js.php"></script>
<!-- Manage Invoice Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display(isset($is_order) ? 'manage_order' : 'manage_invoice') ?></h1>
            <small><?php echo display(isset($is_order) ? 'manage_your_order' : 'manage_your_invoice') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display(isset($is_order) ? 'order' : 'invoice') ?></a></li>
                <li class="active"><?php echo display(isset($is_order) ? 'manage_order' : 'manage_invoice') ?></li>
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
                    <?php if (isset($is_order)) : ?>
                        <?php if ($this->permission->check_label('new_order')->create()->access()) { ?>
                            <a href="<?php echo base_url('dashboard/Corder/new_order') ?>" class="btn btn-primary color4 color5 m-b-5 m-r-2"><i class="ti-align-justify"> </i>
                                <?php echo display('new_order') ?></a>
                        <?php } ?>
                    <?php else : ?>
                        <?php if ($this->permission->check_label('new_sale')->create()->access()) { ?>
                            <a href="<?php echo base_url('dashboard/Cinvoice/new_invoice') ?>" class="btn btn-primary color4 color5 m-b-5 m-r-2"><i class="ti-align-justify"> </i>
                                <?php echo display('new_invoice') ?></a>
                        <?php }
                        if ($this->permission->check_label('pos_sale')->read()->access()) { ?>
                            <!-- <a href="<?php echo base_url('dashboard/Cinvoice/pos_invoice') ?>" class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"> </i>
                                <?php echo display('pos_invoice') ?></a> -->
                        <?php } ?>
                    <?php endif ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo form_open(isset($is_order) ? 'dashboard/Corder/manage_order' : "dashboard/Cinvoice/manage_invoice", array('method' => 'GET')); ?>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label"><?php echo display(isset($is_order) ? 'order_no' : 'invoice_no') ?>:</label>
                                <input type="text" class="form-control" name="invoice_no" value="<?php echo set_value('invoice_no', @$_GET['invoice_no']) ?>" placeholder='<?php echo display('invoice_no') ?>'>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group row">
                                <!--                                <label for="customer_name" class="control-label">--><?php //echo display('customer_name') 
                                                                                                                        ?>
                                <!--                                    <i class="text-danger">*</i></label>-->
                                <label for="customer_name" class="control-label"><?php echo display('customer_name') ?></label>
                                <input type="text" size="100" value="<?php echo html_escape(@$_GET['customer_name']); ?>" name="customer_name" class="customerSelection form-control" placeholder='<?php echo display('customer_name_or_phone') ?>' id="customer_name" />
                                <input id="SchoolHiddenId" value="<?php echo html_escape(@$_GET['customer_hidden_value']) ?>" class="customer_hidden_value" type="hidden" name="customer_id">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label"><?php echo display('start_date') ?>:</label>
                                <input type="text" class="form-control datepicker2 " name="from_date" id="from_date" value="<?php echo set_value('from_date', @$_GET['from_date']) ?>" placeholder='<?php echo display('start_date') ?>' autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label"><?php echo display('end_date') ?>:</label>
                                <input type="text" class="form-control datepicker2 " name="to_date" id="to_date" value="<?php echo set_value('to_date', @$_GET['to_date']) ?>" placeholder='<?php echo display('end_date') ?>' autocomplete="off">
                            </div>
                        </div>
                        <?php /* ?>
                        <?php if (!isset($is_order)) : ?>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label"><?php echo display('status') ?>:</label>
                                    <select class="form-control" name="invoice_status">
                                        <option value=""></option>
                                        <option value="1" <?php if (@$_GET['invoice_status'] == '1') {
                                                                echo "selected";
                                                            } ?>><?php echo display('shipped') ?></option>
                                        <option value="2" <?php if (@$_GET['invoice_status'] == '2') {
                                                                echo "selected";
                                                            } ?>><?php echo display('cancel') ?></option>
                                        <option value="0" <?php if (@$_GET['invoice_status'] == '3' || @$_GET['invoice_status'] == '0') {
                                                                echo "selected";
                                                            } ?>><?php echo display('pending') ?></option>
                                        <option value="4" <?php if (@$_GET['invoice_status'] == '4') {
                                                                echo "selected";
                                                            } ?>><?php echo display('complete') ?></option>
                                        <option value="5" <?php if (@$_GET['invoice_status'] == '5') {
                                                                echo "selected";
                                                            } ?>><?php echo display('processing') ?></option>
                                        <option value="6" <?php if (@$_GET['invoice_status'] == '6') {
                                                                echo "selected";
                                                            } ?>><?php echo display('return') ?></option>
                                    </select>
                                </div>
                            </div>
                        <?php endif ?>
                         <?php */ ?>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label"><?php echo display('employee_name') ?>:</label>
                                <?php echo form_dropdown('employee_id', $employees, set_value('employee_id', @$_GET['employee_id']), 'class="form-control" id="employee_id"') ?>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><?php echo display('search') ?></button>
                            </div>
                        </div>

                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>


        <!-- Manage Invoice report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display(isset($is_order) ? 'manage_order' : 'manage_invoice') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo display('sl') ?></th>
                                        <th><?php echo display(isset($is_order) ? 'order_no' : 'invoice_no') ?></th>
                                        <th><?php echo display('customer_name') ?></th>
                                        <th><?php echo display('date') ?></th>
                                        <th><?php echo display('total_amount') ?></th>
                                        <?php if (isset($is_order)) :?>
                                        <th><?php echo display('invoice_no') ?></th>
                                        <?php endif ?>
<!--                                        <th>--><?php //echo display('status') ?><!--</th>-->
                                        <th><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($invoices_list)) {
                                        $i = 1;
                                        foreach ($invoices_list as $invoice) {

                                    ?>
                                            <tr>
                                                <td><?php echo html_escape($invoice['sl']) ?></td>
                                                <td>
                                                    <a href="<?php echo isset($is_order) ? base_url() . 'dashboard/Corder/order_inserted_data/' . html_escape($invoice['invoice_id']) :  base_url() . 'dashboard/Cinvoice/invoice_inserted_data/' . html_escape($invoice['invoice_id']); ?>">

                                                        <?php echo html_escape($invoice['invoice']) ?>
                                                        <i class="fa fa-tasks pull-right" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="<?php echo base_url() . 'dashboard/Ccustomer/customerledger/' . $invoice['customer_id']; ?>">
                                                        <?php echo html_escape($invoice['customer_name']) ?> <i class="fa fa-user pull-right" aria-hidden="true"></i></a>

                                                </td>
                                                <td><?php echo date('d-m-Y', strtotime($invoice['date_time'])) ?></td>
                                                <td class="text-right">
                                                    <?php echo (($position == 0) ? $currency . ' ' . $invoice['total_amount'] : $invoice['total_amount'] . ' ' . $currency) ?>
                                                </td>
                                                <?php if (isset($is_order)) :?>
                                                <td>
                                                <?php echo html_escape($invoice['invoice_no']) ?>
                                                </td>
                                                <?php endif ?>
                                                <?php /* ?>
                                                <td class="text-center">
                                                    <?php if ($is_order) : ?>
                                                        <label class='label label-warning'>
                                                            <?php echo display('pending') ?>
                                                        </label>
                                                    <?php else : ?>
                                                        <?php echo form_open('dashboard/Cinvoice/update_status/' . $invoice['invoice_id'], array('id' => 'validate')); ?>

                                                        <select class="form-control" name="invoice_status" required="">
                                                            <option value=""></option>

                                                            <option value="1" <?php if ($invoice['invoice_status'] == '1') {
                                                                                    echo "selected";
                                                                                } ?>><?php echo display('shipped') ?>
                                                            </option>
                                                            <option value="2" <?php if ($invoice['invoice_status'] == '2') {
                                                                                    echo "selected";
                                                                                } ?>><?php echo display('cancel') ?>
                                                            </option>
                                                            <option value="3" <?php if ($invoice['invoice_status'] == '3' || $invoice['invoice_status'] == '0') {
                                                                                    echo "selected";
                                                                                } ?>><?php echo display('pending') ?>
                                                            </option>
                                                            <?php if ($invoice['due_amount'] <= 0) { ?>
                                                                <option value="4" <?php if ($invoice['invoice_status'] == '4') {
                                                                                        echo "selected";
                                                                                    } ?>><?php echo display('complete') ?>
                                                                </option>
                                                            <?php } ?>
                                                            <option value="5" <?php if ($invoice['invoice_status'] == '5') {
                                                                                    echo "selected";
                                                                                } ?>>
                                                                <?php echo display('processing') ?>
                                                            </option>
                                                            <?php
                                                            if (check_module_status('return_refund') == 1) {
                                                                if ($invoice['due_amount'] <= 0) {
                                                                    if ($invoice['invoice_status'] == '4' || $invoice['invoice_status'] == '6') {
                                                            ?>
                                                                        <option value="6" <?php if ($invoice['invoice_status'] == '6') {
                                                                                                echo "selected";
                                                                                            } ?>>
                                                                            <?php echo display('return') ?>
                                                                        </option>
                                                            <?php }
                                                                }
                                                            } ?>
                                                        </select>

                                                        <?php if ($this->permission->check_label('manage_sale')->update()->access()) { ?>
                                                            <?php if ($invoice['invoice_status'] != '6') { ?>
                                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal_<?php echo $i ?>" title="<?php echo display('add_note') ?>">
                                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                                </button>
                                                            <?php } ?>
                                                            <input type="hidden" value="<?php echo html_escape($invoice['customer_email']) ?>" name="customer_email" />
                                                            <input type="hidden" value="<?php echo html_escape($invoice['customer_id']) ?>" name="customer_id" />
                                                            <input type="hidden" value="<?php echo html_escape($invoice['order']) ?>" name="order_no" />
                                                            <input type="hidden" value="<?php echo html_escape($invoice['order_id']) ?>" name="order_id" />

                                                            <div class="modal fade" id="myModal_<?php echo $i ?>" role="dialog">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                            <h1 class="modal-title"><?php echo display('add_note') ?>
                                                                            </h1>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group row">
                                                                                <label for="" class="col-sm-4 col-form-label"><?php echo display('add_note') ?>
                                                                                </label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" name="add_note" class="form-control" placeholder="<?php echo display('add_note') ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-success" data-dismiss="modal"><?php echo display('add') ?></button>
                                                                        </div>
                                                                    </div><!-- /.modal-content -->
                                                                </div><!-- /.modal-dialog -->
                                                            </div><!-- /.modal -->
                                                            <?php if ($invoice['invoice_status'] != '6') { ?>
                                                                <button type="submit" class="btn btn-primary inv_updatebtn">
                                                                    <?php echo display('update') ?>
                                                                </button>

                                                            <?php } ?>
                                                        <?php } ?>
                                                        <?php echo form_close() ?>
                                                    <?php endif ?>
                                                </td>
                                                <?php */ ?>
                                                <?php if (isset($is_order)) : ?>
                                                    <td>
                                                        <center>
                                                            <?php echo form_open() ?>
                                                            <?php if ($invoice['order_status'] == 1) { ?>
                                                                <?php if ($this->permission->check_label('new_sale')->create()->access()) { ?>
                                                                    <a href="<?php echo base_url() . 'dashboard/Corder/create_invoice_form/' . $invoice['invoice_id']; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="left" title="Invoice-2"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                                                <?php }
                                                            } else { ?>
                                                                <a href="javascript:void(0)" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('invoiced') ?>"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                            <?php } ?>
                                                            <a href="<?php echo base_url('dashboard/Corder/order_details_pdf/' . $invoice['invoice_id']) ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('download') ?>"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                            <?php if ($invoice['order_status'] == 1) { ?>
                                                                <?php if ($this->permission->check_label('manage_order')->update()->access()) { ?>
                                                                    <!-- <a href="<?php echo base_url() . 'dashboard/Corder/order_update_form/' . $invoice['invoice_id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a> -->
                                                                <?php }
                                                                if ($this->permission->check_label('manage_order')->delete()->access()) { ?>
                                                                    <a href="<?php echo base_url('dashboard/Corder/order_delete/' . $invoice['invoice_id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo display('are_you_sure_want_to_delete') ?>');" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                                <?php } ?>
                                                            <?php } ?>
                                                            <?php echo form_close() ?>
                                                        </center>
                                                    </td>
                                                <?php else : ?>
                                                    <td>
                                                        <center>
                                                            <?php if ($this->permission->check_label('new_sale')->access()) { ?>
                                                                <a href="<?php echo base_url() . 'dashboard/Cinvoice/invoice_inserted_data/' . $invoice['invoice_id']; ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('invoice') ?>"><i class="fa fa-window-restore" aria-hidden="true"></i></a>
                                                            <?php }
                                                            if ($this->permission->check_label('pos_sale')->read()->access()) { ?>
                                                                <!--<a href="<?php //echo base_url() . 'dashboard/Cinvoice/pos_invoice_inserted_data/' . $invoice['invoice_id']; 
                                                                                ?>"
                                                    class="btn btn-warning btn-sm" data-toggle="tooltip"
                                                    data-placement="left"
                                                    title="<?php //echo display('pos_invoice') 
                                                            ?>"><i class="fa fa-fax"
                                                        aria-hidden="true"></i></a>-->
                                                            <?php } ?>

                                                            <!--<a href="<?php //echo base_url() . 'dashboard/Cinvoice/pad_invoice/' . $invoice['invoice_id']; 
                                                                            ?>"
                                                    class="btn btn-primary btn-sm" data-toggle="tooltip"
                                                    data-placement="left"
                                                    title="<?php //echo display('pad_invoice') 
                                                            ?>"><i class="fa fa-fax"
                                                        aria-hidden="true"></i></a>-->

                                                            <?php if ($this->permission->check_label('manage_sale')->update()->access()) { ?>
                                                                <!--<a href="<?php //echo base_url() . 'dashboard/Cinvoice/invoice_update_form/' . $invoice['invoice_id']; 
                                                                                ?>"
                                                    class="btn btn-info btn-sm" data-toggle="tooltip"
                                                    data-placement="left" title="<?php //echo display('update') 
                                                                                    ?>"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a>-->
                                                            <?php }
                                                            if ($this->permission->check_label('manage_sale')->delete()->access()) { ?>
                                                                <!--<a href="<?php //echo base_url('dashboard/Cinvoice/invoice_delete/' . $invoice['invoice_id']) 
                                                                                ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('<?php //echo display('are_you_sure_want_to_delete') 
                                                                                ?>');"
                                                    data-toggle="tooltip" data-placement="right" title=""
                                                    data-original-title="<?php //echo display('delete') 
                                                                            ?> "><i
                                                        class="fa fa-trash-o" aria-hidden="true"></i></a>-->
                                                            <?php } ?>
                                                        </center>
                                                    </td>
                                                <?php endif ?>
                                            </tr>
                                    <?php $i++;
                                        }
                                    } ?>
                                </tbody>
                            </table>
                            <div class="text-right">
                                <?php echo htmlspecialchars_decode(@$links); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Manage Invoice End -->
<script src="<?php echo MOD_URL . 'dashboard/assets/js/invoice.js'; ?>"></script>
<script>
    $(document).ready(function() {
        $(".datepicker2").datepicker({
			dateFormat: "dd-mm-yy"
		});
    });
</script>