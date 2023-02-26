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
                            <button class="btn btn-warning" onclick="printDiv('printableArea')"><span
                                        class="fa fa-print"></span></button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row" id="printableArea">

                            <table class="table table-striped" width="100%">


                                <div class="form-group text-center rpthtext">

                                    <?php echo display('attendance_report') ?>


                                </div>
                                <div class="row">
                                    <div class="col-sm-4 text-center">
                                        <?php echo "<img src='" . html_escape($ab[0]['image']) . "' width=120px; height=120px;>"; ?>
                                    </div>
                                    <div class="col-sm-8">

                                        <div class="form-group text-left rptname">

                                            <?php echo display('name') ?>:<?php


                                            echo html_escape($ab[0]['first_name']) . " " . html_escape($ab[0]['last_name']); ?>

                                        </div>
                                        <div class="form-group text-left rptname">

                                            ID NO: <?php

                                            echo html_escape($ab[0]['id']);


                                            ?>
                                        </div>

                                        <div class="form-group text-left rptname">

                                            <?php echo display('designation') ?>
                                            : <?php echo html_escape($ab[0]['emdesignation']); ?>
                                        </div>
                                    </div>
                                </div>
                            </table>
                            <table class="table table-striped">
                                <tr>
                                    <th> <?php echo display('sl') ?></th>
                                    <th> <?php echo display('date') ?></th>
                                    <th> <?php echo display('checkin') ?></th>
                                    <th> <?php echo display('checkout') ?></th>
                                    <th> <?php echo display('work_hour') ?></th>
                                </tr>
                                <?php
                                $x = 1;
                                foreach ($query as $qr) {
                                    ?>
                                    <tr>
                                        <td><?php echo $x++; ?></td>
                                        <td><?php echo html_escape($qr->date) ?></td>
                                        <td><?php echo html_escape($qr->sign_in) ?></td>
                                        <td><?php echo html_escape($qr->sign_out) ?></td>
                                        <td><?php echo html_escape($qr->staytime) ?></td>
                                    </tr>
                                <?php } ?>

                            </table>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>



