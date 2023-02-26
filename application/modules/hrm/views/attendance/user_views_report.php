<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Manage Customer Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('attendance') ?></h1>
            <small><?php echo $title ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('attendance') ?></a></li>
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
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('datewise_report') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">

                            <table width="100%" class="datatable table table-striped table-bordered table-hover">
                                <caption>
                                    <center><?php echo display('from') . ' -' . $from_date . '=>' . display('to') . ' -' . $to_date ?></center>
                                </caption>
                                <thead>
                                <tr>
                                    <th><?php echo display('Sl') ?></th>
                                    <th><?php echo display('employee_name') ?></th>
                                    <th><?php echo display('date') ?></th>
                                    <th><?php echo display('sign_in') ?></th>
                                    <th><?php echo display('sign_out') ?></th>
                                    <th><?php echo display('stay') ?></th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($query)) { ?>

                                    <?php $sl = 1; ?>
                                    <?php foreach ($query as $que) {
                                        ?>
                                        <tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>">
                                            <td><?php echo $sl; ?></td>
                                            <td><?php echo html_escape($que->first_name) . ' ' . html_escape($que->last_name); ?></td>
                                            <td><?php echo html_escape($que->date); ?></td>
                                            <td><?php echo html_escape($que->sign_in); ?></td>
                                            <td><?php echo html_escape($que->sign_out); ?></td>
                                            <td><?php echo html_escape($que->staytime); ?></td>

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

        </div>
    </section>
</div>