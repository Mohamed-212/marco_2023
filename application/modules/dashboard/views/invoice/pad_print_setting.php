<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo MOD_URL.'dashboard/assets/css/invoice/add_invoice_form.css' ?>">
<!-- Add New Invoice Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('pad_print_setting') ?></h1>
            <small><?php echo display('add_pad_print_setting') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('invoice') ?></a></li>
                <li class="active"><?php echo display('pad_print_setting') ?></li>
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
                    <?php if($this->permission->check_label('manage_sale')->read()->access()){ ?>
                    <a href="<?php echo base_url('dashboard/'.($this->auth->is_store()?'Store_invoice':'Cinvoice').'/manage_invoice') ?>"
                       class="btn btn-primary color4 color5 m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('manage_invoice') ?></a>
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
                            <h4><?php echo display('add_pad_print_setting') ?></h4>
                        </div>
                    </div>
                    <?php echo form_open('dashboard/Cinvoice/pad_print_setting_insert', array('class' => 'form-vertical', 'id' => 'validate')) ?>
                        <div class="panel-body">
                            <div id="home" class="tab-pane fade in active">
                                <div class="panel-body">
                                    <div class="form-group row">
                                        <label for="header" class="col-sm-3 col-form-label"><?php echo display('header') ?> <i class="text-danger">*</i></label>
                                        <div class="col-sm-6">
                                           
                                            <input type="number" name="header" value="<?php echo @$print_data->header?>" class="form-control" required>

                                            <input type="hidden" name="id" value="<?php echo @$print_data->id?>" class="form-control" >
                                        </div>
                                        <label class="col-sm-1">px</label>
                                    </div>

                                   <div class="form-group row">
                                        <label for="footer" class="col-sm-3 col-form-label"><?php echo display('footer') ?> <i class="text-danger">*</i></label>
                                        <div class="col-sm-6">
                                           
                                            <input type="number" name="footer" value="<?php echo @$print_data->footer?>" class="form-control" required>
                                        </div>
                                        <label class="col-sm-1">px</label>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                                        <div class="col-sm-6">
                                            <input type="submit" id="add-pad_print_setting" class="btn btn-success  btn-large" name="add-brand" value="<?php echo display('save') ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Invoice Report End -->