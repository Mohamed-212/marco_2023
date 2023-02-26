<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Add new link page start -->
<div class="content-wrapper">
<section class="content-header">
<div class="header-icon">
<i class="pe-7s-note2"></i>
</div>
<div class="header-title">
<h1><?php echo display('add_link_page') ?></h1>
<small><?php echo display('add_new_link_page') ?></small>
<ol class="breadcrumb">
    <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
    <li><a href="#"><?php echo display('web_settings') ?></a></li>
    <li class="active"><?php echo display('add_link_page') ?></li>
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
        <?php if($this->permission->check_label('link_page')->read()->access()){ ?>
            <a href="<?php echo base_url('dashboard/Clink_page/manage_link_page')?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('manage_link_page')?></a>
        <?php } ?>
    </div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
    <div class="panel panel-bd lobidrag">
        <div class="panel-heading">
            <div class="panel-title">
                <h4><?php echo display('add_link_page') ?> </h4>
            </div>
        </div>
        <?php echo form_open_multipart('dashboard/Clink_page/insert_link_page', array('class' => 'form-vertical','id' => 'validate'))?>
        <div class="panel-body">

            <div class="form-group row">
                <label for="page" class="col-sm-2 col-form-label"><?php echo display('page')?> <i class="text-danger">*</i></label>
                <div class="col-sm-6">
                    <select class="form-control select2 " id="page" name="page_id" required="">
                        <option></option>
                        <option value="1"><?php echo display('about_us')?></option>
                        <option value="3"><?php echo display('delivery_info')?></option>
                        <option value="4"><?php echo display('privacy_policy')?></option>
                        <option value="5"><?php echo display('terms_and_condition')?></option>
                        <option value="6"><?php echo display('help')?></option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="image" class="col-sm-2 col-form-label"><?php echo display('image')?> <i class="text-danger">*</i></label>
                <div class="col-sm-6">
                    <input class="form-control" name ="image" id="image" type="file" required="">
                </div>
            </div>

            <div class="form-group row">
                <label for="headlines" class="col-sm-2 col-form-label"><?php echo display('headlines')?> <i class="text-danger">*</i></label>
                <div class="col-sm-9">
                    <div id="rootwizard">
                        <div class="navbar">
                            <div class="navbar-inner form-wizard">
                                <ul class="nav nav-pills nav-justified steps">
                                    <?php
                                    if ($languages) {
                                        $i=1;
                                        foreach ($languages as $language) {
                                    ?>
                                    <li>
                                        <a href="#tab<?php echo $i?>" data-toggle="tab" class="step" aria-expanded="true">
                                            <span class="number"><?php echo $i?></span>
                                            <span class="desc"><?php echo html_escape($language)?></span>
                                        </a>
                                    </li>
                                    <?php
                                        $i++;
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div id="bar" class="progress">
                            <div class="progress-bar progress-bar-success progress-bar-striped width_0p active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="tab-content">
                            <?php
                            if ($languages) {
                                $i=1;
                                foreach ($languages as $language) {
                            ?>
                            <div class="tab-pane" id="tab<?php echo $i?>">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        
                                        <textarea name="headlines[]" class="form-control summernote" placeholder="<?php echo display('headlines')?>" id="content4" required row="3"></textarea>

                                        <input name="language_id[]" type="hidden" value="<?php echo strtolower($language);?>"  required="">
                                    </div>
                                </div>
                            </div>
                            <?php
                                $i++;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="headlines" class="col-sm-2 col-form-label"><?php echo display('details')?> <i class="text-danger">*</i></label>
                <div class="col-sm-9">
                    <div id="rootwizard1">
                        <div class="navbar">
                            <div class="navbar-inner form-wizard">
                                <ul class="nav nav-pills nav-justified steps">
                                    <?php
                                    if ($languages) {
                                        $i=1;
                                        foreach ($languages as $language) {
                                    ?>
                                    <li>
                                        <a href="#ta<?php echo $i?>" data-toggle="tab" class="step" aria-expanded="true">
                                            <span class="number"> <?php echo $i?> </span>
                                            <span class="desc"><?php echo html_escape($language)?></span>
                                        </a>
                                    </li>
                                    <?php
                                        $i++;
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div id="bar1" class="progress">
                            <div class="progress-bar progress-bar-success progress-bar-striped width_0p active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="tab-content">
                            <?php
                            if ($languages) {
                                $i=1;
                                foreach ($languages as $language) {
                            ?>
                            <div class="tab-pane" id="ta<?php echo $i?>">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <textarea name="details[]" class="form-control summernote" placeholder="<?php echo display('details')?>" id="content4" required row="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $i++;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-6">
                    <input type="submit" id="add-link_page" class="btn btn-success btn-large" name="add-link_page" value="<?php echo display('save') ?>" />
                    <input type="submit" id="add-link_page-another" class="btn btn-primary btn-large" name="add-link_page-another" value="<?php echo display('save_and_add_another') ?>" />
                </div>
            </div>
        </div>
        <?php echo form_close()?>
    </div>
</div>
</div>
</section>
</div>
<!-- Add new link page end -->

<script src="<?php echo MOD_URL.'dashboard/assets/js/add_link_page.js'; ?>"></script>

