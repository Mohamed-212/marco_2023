<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Add New Invoice Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('whatsapp_info') ?></h1>
            <small><?php echo display('add_whatsapp_info') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('web_settings') ?></a></li>
                <li class="active"><?php echo display('whatsapp_info') ?></li>
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
        <!--Add Invoice -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('add_whatsapp_info') ?></h4>
                        </div>
                    </div>
                    <?php echo form_open('dashboard/cwhatsapp_info/whatsapp_info_insert', array('class' => 'form-vertical', 'id' => 'validate')) ?>
                    <div class="panel-body">
                        <div class="row">
                            <div class=" col-sm-8">
                                <div class="form-group row">
                                    <label for="whatsapp_number"
                                        class="col-sm-2 col-form-label"><?php echo display('whatsapp_number') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" value="<?php if (!empty($whatsapp_info_details)) {
                                                                                                echo html_escape($whatsapp_info_details->whatsapp_number);
                                                                                            } ?>"
                                            name="whatsapp_number" placeholder="Your whatsapp number">
                                        <input type="hidden" name="whatsapp_id" value="<?php if (!empty($whatsapp_info_details)) {
                                                                                            echo html_escape($whatsapp_info_details->id);
                                                                                        } ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label for="submit" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-8">
                                        <input class="btn btn-success" type="submit" value="Submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
            <script src="<?php echo MOD_URL . 'dashboard/assets/js/add_invoice_form_2.js'; ?>"></script>
        </div>
    </section>
</div>
<!-- Invoice Report End -->