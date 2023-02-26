<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script src="<?php echo base_url('my-assets/js/admin_js/payroll.js') ?>" type="text/javascript"></script>
<!-- Manage Customer Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('payroll') ?></h1>
            <small><?php echo $title ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('payroll') ?></a></li>
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
            <div class="col-sm-12 col-md-12">
                <div class="panel">

                    <div class="panel-body">

                        <?php echo form_open('hrm/payroll/create_salary_generate') ?>

                        <div class="form-group row">
                            <label for="salary_month"
                                   class="col-sm-3 col-form-label"><?php echo display('salary_month') ?><span
                                        class="text-danger">*</span> </label>
                            <div class="col-sm-6">
                                <input name="myDate" class="monthYearPicker form-control" required=""/>

                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button type="reset"
                                    class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button type="submit"
                                    class="btn btn-success w-md m-b-5"><?php echo display('generate') ?></button>
                        </div>
                        <?php echo form_close() ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


