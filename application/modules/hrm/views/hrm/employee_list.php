<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Manage Customer Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('designation') ?></h1>
            <small><?php echo $title ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('hrm') ?></a></li>
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

        <div class="row">
            <div class="col-sm-12">
                <div class="column">
                    <a href="<?php echo base_url('hrm/hrm/bdtask_employee_form')?>" class="btn btn-success m-b-5 m-r-2"><i
                                class="ti-plus"> </i> <?php echo display('add_employee')?></a>
                </div>
            </div>
        </div>

        <!-- Manage Customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="" class="table table-bordered table-striped table-hover datatable">
                                <thead>
                                <tr>
                                    <th class="text-center"><?php echo display('sl') ?></th>
                                    <th class="text-center"><?php echo display('name') ?></th>
                                    <th class="text-center"><?php echo display('designation') ?></th>
                                    <th class="text-center"><?php echo display('phone') ?></th>
                                    <th class="text-center"><?php echo display('email') ?></th>
                                    <th class="text-center"><?php echo display('picture') ?></th>
                                    <th class="text-center"><?php echo display('action') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($employee_list) {
                                    ?>

                                    <?php
                                    $sl = 1;
                                    foreach ($employee_list as $employees) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $sl; ?></td>
                                            <td class="text-center"><?php echo html_escape($employees['first_name']) . ' ' . html_escape($employees['last_name']); ?></td>
                                            <td class="text-center"><?php echo html_escape($employees['designation']); ?></td>
                                            <td class="text-center"><?php echo html_escape($employees['phone']); ?></td>
                                            <td class="text-center"><?php echo html_escape($employees['email']); ?></td>
                                            <td class="text-center"><img
                                                        src="<?php echo(!empty($employees['image']) ? base_url() . $employees['image'] : base_url('assets/img/icons/default.jpg')); ?>"
                                                        height="60px" width="80px"></td>
                                            <td>
                                                <center>
                                                    <?php echo form_open() ?>
                                                    <?php if ($this->permission->method('manage_employee', 'update')->access()){ ?>
                                                        <a href="<?php echo base_url() . 'hrm/hrm/bdtask_employee_form/' . $employees['id']; ?>"
                                                           class="btn btn-info btn-sm" data-toggle="tooltip"
                                                           data-placement="left"
                                                           title="<?php echo display('update') ?>"><i
                                                                    class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    <?php } ?>
                                                    <?php if ($this->permission->method('manage_employee', 'delete')->access()){ ?>
                                                        <a href="<?php echo base_url('hrm/hrm/bdtask_delete_employee/' . $employees['id']) ?>"
                                                           class="btn btn-danger btn-sm"
                                                           onclick="return confirm('<?php echo display('are_you_sure') ?>')"
                                                           data-toggle="tooltip" data-placement="right" title=""
                                                           data-original-title="<?php echo display('delete') ?> "><i
                                                                    class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                    <?php } ?>
                                                    <a href="<?php echo base_url('hrm/hrm/bdtask_employee_profile/' . $employees['id']); ?>"
                                                       class="btn btn-default"><i class="fa fa-user"></i></a>
                                                    <?php echo form_close() ?>
                                                </center>
                                            </td>
                                        </tr>

                                        <?php
                                        $sl++;
                                    }
                                }
                                ?>
                                </tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

