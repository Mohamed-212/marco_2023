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
            <h1><?php echo display(isset($is_order) ? 'manage_order' : 'manage_return') ?></h1>
            <small><?php echo display(isset($is_order) ? 'manage_your_order' : 'manage_your_return') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display(isset($is_order) ? 'order' : 'return') ?></a></li>
                <li class="active"><?php echo display(isset($is_order) ? 'manage_order' : 'manage_return') ?></li>
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
                            <a href="<?php echo base_url('dashboard/Cinvoice/pos_invoice') ?>" class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"> </i>
                                <?php echo display('pos_invoice') ?></a>
                        <?php } ?>
                    <?php endif ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo form_open(isset($is_order) ? 'dashboard/Corder/manage_order' : "dashboard/Crefund/manage_return", array('method' => 'GET')); ?>
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
                                <input type="text" class="form-control datepicker " name="from_date" id="from_date" value="<?php echo set_value('from_date', @$_GET['from_date']) ?>" placeholder='<?php echo display('start_date') ?>' autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label"><?php echo display('end_date') ?>:</label>
                                <input type="text" class="form-control datepicker " name="to_date" id="to_date" value="<?php echo set_value('to_date', @$_GET['to_date']) ?>" placeholder='<?php echo display('end_date') ?>' autocomplete="off">
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

                                                        <a href="<?= base_url('dashboard/Crefund/return_invoice/'.$invoice['return_invoice_id']);?>" class="text-success " data-toggle="tooltip" data-placement="left" title="" data-original-title="Invoice">
                                                    <?php echo 'SalRe-' . html_escape($invoice['id']) ?>
                                                    </a>
                                                        <i class="fa fa-tasks pull-right" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="<?php echo base_url() . 'dashboard/Ccustomer/customerledger/' . $invoice['customer_id']; ?>">
                                                        <?php echo html_escape($invoice['customer_name']) ?> <i class="fa fa-user pull-right" aria-hidden="true"></i></a>

                                                </td>
                                                <td><?php echo html_escape($invoice['created_at']) ?></td>
                                                <td class="text-right">
                                                    <?php echo ( $invoice['total_return'] ." ". $currency) ?>
                                                </td>
                                               
                                                <td>
                                                    <center>
                                                        <a href="<?= base_url('dashboard/Crefund/return_invoice/'.$invoice['return_invoice_id']);?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="Invoice"><i class="fa fa-window-restore" aria-hidden="true"></i></a>
                                                    </center>
                                                    </td>
                                           
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