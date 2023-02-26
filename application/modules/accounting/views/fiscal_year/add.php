<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Manage Customer Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('accounts') ?></h1>
            <small><?php echo display('fiscal_year') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('accounts') ?></a></li>
                <li class="active"><?php echo display('fiscal_year') ?></li>
            </ol>
        </div>
    </section>
    <section class="content">
        <?php if (!empty($this->session->flashdata('message'))) { ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('message') ?>
        </div>
        <?php } ?>
        <?php if (!empty($this->session->flashdata('exception'))) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('exception') ?>
        </div>
        <?php } ?>
        <?php if (!empty(validation_errors())) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <?php echo validation_errors() ?>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="column">
                    <a href="<?php echo base_url('accounting/fiscal_year')?>" class="btn btn-success m-b-5 m-r-2"><i
                            class="ti-align-justify"> </i> <?php echo display('list')?></a>
                </div>
            </div>
        </div>
        <!-- Manage Customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('fiscal_year') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <?php echo form_open('accounting/fiscal_year/add'); ?>
                                <div class="form-group row">
                                    <label for="title" class="col-sm-3 col-form-label"><?php echo display('title')?> <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="title" id="title" type="text"
                                            placeholder="<?php echo display('fiscal_year').' '.display('title'); ?>"
                                            value="<?php echo set_value('title', date('Y').'-'.date('Y', strtotime('+1 Year'))) ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="start_date"
                                        class="col-sm-3 col-form-label"><?php echo display('start_date')?> <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input class="form-control datepicker" name="start_date" id="start_date"
                                            type="text" placeholder="<?php echo display('start_date'); ?>"
                                            value="<?php echo set_value('start_date', date('Y-07-01')) ?>"
                                            autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="end_date"
                                        class="col-sm-3 col-form-label"><?php echo display('end_date')?> <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input class="form-control datepicker" name="end_date" id="end_date" type="text"
                                            placeholder="<?php echo display('end_date'); ?>"
                                            value="<?php echo set_value('end_date', date('Y-06-30', strtotime('+1 Year'))) ?>"
                                            autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <button class="btn btn-success"
                                            type="submit"><?php echo display('submit');?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>