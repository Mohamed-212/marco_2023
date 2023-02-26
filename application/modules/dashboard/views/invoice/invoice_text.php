<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo MOD_URL . 'dashboard/assets/css/invoice/add_invoice_form.css' ?>">
<!-- Add New Invoice Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('invoice_text') ?></h1>
            <small><?php echo display('add_invoice_text') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('invoice') ?></a></li>
                <li class="active"><?php echo display('invoice_text') ?></li>
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
                    <?php if ($this->permission->check_label('manage_sale')->read()->access()) { ?>
                    <a href="<?php echo base_url('dashboard/' . ($this->auth->is_store() ? 'Store_invoice' : 'Cinvoice') . '/manage_invoice') ?>"
                        class="btn btn-primary color4 color5 m-b-5 m-r-2"><i class="ti-align-justify"> </i>
                        <?php echo display('manage_invoice') ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!--Add Invoice -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('add_invoice_text') ?></h4>
                        </div>
                    </div>
                    <?php echo form_open('dashboard/Cinvoice/invoice_text_insert', array('class' => 'form-vertical', 'id' => 'validate')) ?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <table class="table table-bordered table-hover mx-auto">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><?php echo display('invoice_text'); ?></th>
                                            <th class="text-center"><?php echo display('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="add_invoice_text_row">
                                        <?php if (empty($invoice_text_details)) { ?>
                                        <tr>
                                            <td><textarea class="form-control" name="invoice_text[]"
                                                    rows="1"></textarea></td>
                                            <td class="text-center"><button type="button" class="btn btn-success"
                                                    onClick="addInputField('add_invoice_text_row');"><i
                                                        class="fa fa-plus"></i></button></td>
                                        </tr>
                                        <?php } else { ?>
                                        <?php foreach ($invoice_text_details as $key => $invoice_text) { ?>
                                        <tr class="tr">
                                            <td><textarea class="form-control" name="invoice_text[]"
                                                    rows="1"><?php echo html_escape($invoice_text->invoice_text) ?></textarea>
                                            </td>
                                            <?php if ($key == 0) { ?>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-success"
                                                    onClick="addInputField('add_invoice_text_row');"><i
                                                        class="fa fa-plus"></i></button>
                                            </td>
                                            <?php } else { ?>
                                            <td class="text-center"><button type="button"
                                                    class="btn btn-danger removeInputField"><i
                                                        class="fa fa-minus"></i></button></td>
                                            <?php } ?>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-center">
                                                <input class="btn btn-success" type="submit" value="Submit">
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
            <script src="<?php echo MOD_URL . 'dashboard/assets/js/add_invoice_text_form.js'; ?>"></script>
        </div>
    </section>
</div>
<!-- Invoice Report End -->