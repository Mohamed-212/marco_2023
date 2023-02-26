<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
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
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo(!empty($title) ? $title : null) ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open('hrm/payroll/update_benefitstype/' . $data[0]['salary_type_id']) ?>

                        <input name="salary_type_id" type="hidden" value="<?php echo $data[0]['salary_type_id'] ?>">

                        <div class="form-group row">
                            <label for="benefits" class="col-sm-3 col-form-label"><?php echo display('benefits') ?>
                                <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input name="sal_name" class="form-control" type="text" id="emp_sal_name"
                                       value="<?php echo $data[0]['sal_name'] ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="salary_benefits_type"
                                   class="col-sm-3 col-form-label"><?php echo display('salary_benefits_type') ?><span
                                        class="text-danger">*</span> </label>
                            <div class="col-sm-6">
                                <select name="emp_sal_type" class="form-control"
                                        placeholder="<?php echo display('salary_benefits_type') ?>" id="emp_sal_type"
                                        required>
                                    <option value="1" <?php if ($data[0]['salary_type'] == 1) {
                                        echo 'selected';
                                    } ?>><?php echo display('add') ?></option>
                                    <option value="0" <?php if ($data[0]['salary_type'] == 0) {
                                        echo 'selected';
                                    } ?>><?php echo display('deduct') ?></option>
                                </select>
                            </div>


                        </div>

                        <div class="form-group text-center">

                            <button type="submit"
                                    class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                        </div>

                        <?php echo form_close() ?>


                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
