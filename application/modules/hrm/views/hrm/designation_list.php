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
                    <a href="<?php echo base_url('hrm/hrm/bdtask_designation_form')?>" class="btn btn-success m-b-5 m-r-2"><i
                                class="ti-plus"> </i> <?php echo display('add_designation')?></a>
                </div>
            </div>
        </div>

        <!-- Manage Customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('manage_designation')?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="" class="table table-bordered table-striped table-hover datatable">
                                <thead>
                                <tr>
                                    <th class="text-center"><?php echo display('sl') ?></th>
                                    <th class="text-center"><?php echo display('designation') ?></th>
                                    <th class="text-center"><?php echo display('details') ?></th>
                                    <th class="text-center"><?php echo display('action') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($designation_list) {
                                    ?>

                                    <?php
                                    $sl =1;
                                    foreach($designation_list as $designations){?>
                                        <tr>
                                            <td class="text-center"><?php echo $sl;?></td>
                                            <td class="text-center"><?php echo html_escape($designations['designation']);?></td>
                                            <td class="text-center"><?php echo html_escape($designations['details']);?></td>
                                            <td>
                                                <center>
                                                    <?php echo form_open() ?>
                                                    <?php if($this->permission->method('manage_designation','update')->access()){ ?>
                                                        <a href="<?php echo base_url() . 'hrm/hrm/bdtask_designation_form/'.$designations['id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    <?php } ?>
                                                    <?php if($this->permission->method('manage_designation', 'delete')->access()){ ?>
                                                        <a href="<?php echo base_url('hrm/hrm/bdtask_deletedesignation/'.$designations["id"]) ?>" class="btn btn-danger btn-sm"  onclick="return confirm('<?php echo display('are_you_sure') ?>')" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                    <?php }?>

                                                    <?php echo form_close() ?>
                                                </center>
                                            </td>
                                        </tr>

                                        <?php
                                        $sl++;
                                    }}
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>