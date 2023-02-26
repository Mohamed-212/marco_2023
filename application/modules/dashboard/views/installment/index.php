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
            <h1><?php echo display('manage_installment') ?></h1>
            <small><?php echo display('manage_your_installment') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li class="active"><?php echo display('installment') ?></li>
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
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo form_open("dashboard/Cinstallment/manage_installment", array('method' => 'GET')); ?>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label"><?php echo display('invoice_no') ?>:</label>
                                <input type="text" class="form-control" name="invoice_no"
                                       value="<?php echo set_value('invoice_no', @$_GET['invoice_no']) ?>"
                                       placeholder='<?php echo display('invoice_no') ?>'>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group row">
                                <label for="customer_name" class="control-label"><?php echo display('customer_name') ?>
                                    <i class="text-danger">*</i></label>

                                <input type="text" size="100"
                                       value="<?php echo html_escape(@$_GET['customer_name']); ?>" name="customer_name"
                                       class="customerSelection form-control"
                                       placeholder='<?php echo display('customer_name_or_phone') ?>' id="customer_name" />
                                <input id="SchoolHiddenId"
                                       value="<?php echo html_escape(@$_GET['customer_hidden_value']) ?>"
                                       class="customer_hidden_value" type="hidden" name="customer_id">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label"><?php echo display('date') ?>:</label>
                                <input type="text" class="form-control datepicker2 " name="date"
                                       value="<?php echo set_value('date', @$_GET['date']) ?>"
                                       placeholder='<?php echo display('date') ?>' autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group" style="margin-top: 15px">
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
                            <h4><?php echo display('manage_installment') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th><?php echo display('sl') ?></th>
                                    <th><?php echo display('invoice_no') ?></th>
                                    <th><?php echo display('customer_name') ?></th>
                                    <th><?php echo display('date') ?></th>
                                    <th><?php echo display('paid_amount') ?></th>
                                    <th><?php echo display('due_amount') ?></th>
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
                                                <a
                                                        href="<?php echo base_url() . 'dashboard/Cinvoice/invoice_inserted_data/' . html_escape($invoice['invoice_id']); ?>">

                                                    <?php echo html_escape($invoice['invoice']) ?>
                                                    <i class="fa fa-tasks pull-right" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a
                                                        href="<?php echo base_url() . 'dashboard/Ccustomer/customerledger/' . $invoice['customer_id']; ?>">
                                                    <?php echo html_escape($invoice['customer_name']) ?> <i
                                                            class="fa fa-user pull-right" aria-hidden="true"></i></a>

                                            </td>
                                            <td><?php echo html_escape(date('d-m-Y', strtotime($invoice['date_time']))) ?></td>
                                            <td class="text-right">
                                                <?php echo (($position == 0) ? $currency . ' ' . $invoice['paid_amount'] : $invoice['paid_amount'] . ' ' . $currency) ?>
                                            </td>
                                            <td class="text-right">
                                                <?php echo (($position == 0) ? $currency . ' ' . $invoice['due_amount'] : $invoice['due_amount'] . ' ' . $currency) ?>
                                            </td>
                                            <td>
                                                <center>
                                                    <?php if ($this->permission->check_label('installment')->read()->access()) { ?>
                                                    <a href="<?php echo base_url() . 'dashboard/Cinstallment/installment_update_form/' . $invoice['invoice_id']; ?>"
                                                    class="btn btn-info btn-sm" data-toggle="tooltip"
                                                    data-placement="left" title="<?php echo display('update') ?>"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a>
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