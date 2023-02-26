<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Add new currency start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('filtration') ?></h1>
            <small><?php echo display('add_filter') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('filtration') ?></a></li>
                <li class="active"><?php echo display('add_filter') ?></li>
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
        <!-- New customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('add_filter') ?> </h4>
                        </div>
                    </div>
                  <?php echo form_open_multipart('dashboard/cfiltration/add_filter', array('class' => 'form-vertical','id' => 'validate'))?>
                    <div class="panel-body">
                        <div class="form-group row">
                            <label for="filter_type" class="col-sm-3 col-form-label"><?php echo display('filter_type')?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="filter_type" id="filter_type" type="text" placeholder="<?php echo display('filter_type') ?>"  required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="filter_names" class="col-sm-3 col-form-label"><?php echo display('filter_names')?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input class="form-control" name ="filter_names[]" id="filter_names" type="text" placeholder="<?php echo display('filter_name') ?>"  required="">
                                    <div class="input-group-addon btn btn-success" id="add_more">
                                        <i class="ti-plus"></i>
                                    </div>
                                </div>
                                <div id="filter_name_area"></div>
                            </div>
                        </div>                                  
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" id="add-item" class="btn btn-success btn-large" name="add-item" value="<?php echo display('save') ?>" />
                                <input type="submit" id="add-item-another" class="btn btn-primary btn-large" name="add-item-another" value="<?php echo display('save_and_add_another') ?>" />
                            </div>
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Add new currency end -->
<script src="<?php echo MOD_URL.'dashboard/assets/js/filter_add.js'; ?>"></script>