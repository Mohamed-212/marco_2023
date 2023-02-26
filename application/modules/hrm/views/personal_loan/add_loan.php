<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Manage Customer Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('personal_loan') ?></h1>
            <small><?php echo $title ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('personal_loan') ?></a></li>
                <li class="active"><?php echo $title ?></li>
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

        <!-- Manage Customer -->
        <div class="row">
            <div class="col-sm-12">

                <?php if ($this->permission->method('add_person', 'create')->access()) { ?>
                    <a href="<?php echo base_url('hrm/loan/bdtask_add_person') ?>" class="btn btn-info m-b-5 m-r-2"><i
                                class="ti-plus"> </i> <?php echo display('add_person') ?> </a>
                <?php } ?>

                <?php if ($this->permission->method('add_payment', 'create')->access()) { ?>
                    <a href="<?php echo base_url('hrm/loan/bdtask_add_payment') ?>" class="btn btn-success m-b-5 m-r-2"><i
                                class="ti-plus"> </i> <?php echo display('add_payment') ?> </a>
                <?php } ?>
                <?php if ($this->permission->method('manage_person', 'read')->access()) { ?>
                    <a href="<?php echo base_url('hrm/loan/manage_person') ?>" class="btn btn-primary m-b-5 m-r-2"><i
                                class="ti-plus"> </i> <?php echo display('manage_loan') ?> </a>
                <?php } ?>

            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('add_loan') ?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('hrm/loan/bdtask_submit_loan', array('class' => 'form-vertical', 'id' => 'inflow_entry')) ?>
                    <div class="panel-body">

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label"><?php echo display('name') ?> <i
                                        class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="person_id" id="namepersonloan" tabindex="1">
                                    <option><?php echo display('select_one') ?></option>
                                    <?php foreach ($person_list as $persons) { ?>
                                        <option value="<?php echo $persons['person_id'] ?>"><?php echo $persons['person_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-sm-3 col-form-label"><?php echo display('phone') ?> <i
                                        class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control phone" name="phone" id="phone" required=""
                                       placeholder="<?php echo display('phone') ?>" min="0" tabindex="2"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ammount" class="col-sm-3 col-form-label"><?php echo display('ammount') ?> <i
                                        class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="ammount" id="ammount" required=""
                                       placeholder="<?php echo display('ammount') ?>" min="0" tabindex="3"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-sm-3 col-form-label"><?php echo display('date') ?> <i
                                        class="text-danger"></i></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control datepicker" name="date" id="date"
                                       value="<?php echo date("Y-m-d"); ?>" placeholder="<?php echo display('date') ?>"
                                       tabindex="4"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="details" class="col-sm-3 col-form-label"><?php echo display('details') ?> <i
                                        class="text-danger"></i></label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="details" id="details"
                                          placeholder="<?php echo display('details') ?>" tabindex="5"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="reset" class="btn btn-danger" value="<?php echo display('reset') ?>"
                                       tabindex="6"/>
                                <input type="submit" id="add-deposit" class="btn btn-success" name="add-deposit"
                                       value="<?php echo display('save') ?>" tabindex="7"/>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>

