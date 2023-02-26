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
            <!--  table area -->
            <div class="col-sm-12">

                <div class="panel panel-default thumbnail">

                    <div class="panel-body">
                        <table width="100%" class="datatable table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>
                                <th><?php echo display('employee_name') ?></th>
                                <th><?php echo display('salary_type') ?></th>
                                <th><?php echo display('date') ?></th>
                                <th><?php echo display('action') ?></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($emp_sl_setup)) { ?>
                                <?php $sl = 1; ?>
                                <?php foreach ($emp_sl_setup as $que) { ?>
                                    <tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>">
                                        <td><?php echo $sl; ?></td>
                                        <td><?php echo html_escape($que->first_name) . ' ' . html_escape($que->last_name); ?></td>
                                        <td><?php if ($que->sal_type == 1) {
                                                echo 'Hourly';
                                            } else {
                                                echo 'Salary';
                                            } ?></td>
                                        <td><?php echo html_escape($que->create_date); ?></td>
                                        <td>
                                            <center>
                                            <?php if ($this->permission->method('manage_salary_setup', 'update')->access()){ ?>
                                                <a href="<?php echo base_url("hrm/payroll/salsetup_upform/$que->employee_id") ?>"
                                                   class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                                            <?php } ?>
                                            <?php if ($this->permission->method('manage_salary_setup', 'delete')->access()){ ?>
                                                <a href="<?php echo base_url("hrm/payroll/delete_salsetup/$que->employee_id") ?>"
                                                   class="btn btn-sm btn-danger"
                                                   onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i
                                                            class="fa fa-trash"></i></a>
                                            <?php } ?>
                                            </center>
                                        </td>
                                    </tr>
                                    <?php $sl++; ?>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>  <!-- /.table-responsive -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
