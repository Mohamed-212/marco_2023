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

                <?php if ($this->permission->method('add_loan', 'create')->access()) { ?>
                    <a href="<?php echo base_url('hrm/loan/bdtask_add_loan') ?>" class="btn btn-info m-b-5 m-r-2"><i
                                class="ti-plus"> </i> <?php echo display('add_loan') ?> </a>
                <?php } ?>

                <?php if ($this->permission->method('add_payment', 'create')->access()) { ?>
                    <a href="<?php echo base_url('hrm/loan/bdtask_add_payment') ?>" class="btn btn-success m-b-5 m-r-2"><i
                                class="ti-plus"> </i> <?php echo display('add_payment') ?> </a>
                <?php } ?>


            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('manage_person') ?> </h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th><?php echo display('name') ?></th>
                                    <th><?php echo display('address') ?></th>
                                    <th><?php echo display('phone') ?></th>
                                    <th><?php echo display('balance') ?></th>
                                    <th><?php echo display('action') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($person_list) {
                                    ?>
                                    <?php foreach ($person_list as $persons) {
                                        $balance = $persons['debit'] - $persons['credit'];
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo base_url('person_ledger/' . $persons['person_id']); ?>"><?php echo $persons['person_name'] ?></a>
                                            </td>
                                            <td><?php echo $persons['person_address'] ?></td>
                                            <td><?php echo $persons['person_phone'] ?></td>
                                            <td><?php echo(($position == 0) ? $currency . ' ' . $balance : $balance . ' ' . $currency); ?></td>
                                            <td>
                                                <center>
                                                    <?php echo form_open() ?>
                                                    <?php if ($this->permission->method('manage_person')->update()->access()){ ?>
                                                        <a href="<?php echo base_url('personal_loan_edit/' . $persons['person_id']); ?>"
                                                           class="btn btn-info btn-sm" data-toggle="tooltip"
                                                           data-placement="left" title=""
                                                           data-original-title="Update"><i class="fa fa-pencil"
                                                                                           aria-hidden="true"></i></a>
                                                    <?php } ?>
                                                    <?php if ($this->permission->method('manage_person', 'delete')->access()){ ?>
                                                        <a href="<?php echo base_url("hrm/loan/delete_personal_loan/" . $persons['person_id']) ?>"
                                                           class="btn btn-sm btn-danger"
                                                           onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i
                                                                    class="fa fa-trash"></i></a>
                                                    <?php } ?>
                                                    <?php echo form_close() ?>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right"><?php echo $links ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



