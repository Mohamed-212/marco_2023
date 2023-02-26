<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Manage Customer Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('office_loan') ?></h1>
            <small><?php echo $title ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('office_loan') ?></a></li>
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


                <a href="<?php echo base_url('hrm/loan/bdtask_add_office_loan_person') ?>" class="btn btn-warning m-b-5 m-r-2"><i
                            class="ti-plus"> </i> <?php echo display('add_person') ?> </a>
                <a href="<?php echo base_url('hrm/loan/manage_ofln_person') ?>" class="btn btn-primary m-b-5 m-r-2"><i
                            class="ti-align-justify"> </i> <?php echo display('manage_person') ?> </a>

            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <?php echo form_open('office_loan_person_ledgerdata', array('class' => 'form-vertical', 'id' => 'person_ledger')); ?>

                        <?php

                        $today = date('Y-m-d');
                        ?>


                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label"><?php echo display('name') ?> <i
                                        class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="person_id" id="nameofficeloanperson">
                                    <option><?php echo display('select_one') ?></option>
                                    <?php foreach ($person_details_all as $persons) { ?>
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
                                       placeholder="<?php echo display('phone') ?>" min="0"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="from_date" class="col-sm-3 col-form-label"><?php echo display('from') ?>: <i
                                        class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="text" id="from_date" name="from_date" value="<?php echo $today; ?>"
                                       class="form-control datepicker" required/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="to_date" class="col-sm-3 col-form-label"><?php echo display('to') ?>: <i
                                        class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="text" id="to_date" name="to_date" value="<?php echo $today; ?>"
                                       class="form-control datepicker" required/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-6 text-center">
                                <button type="submit" class="btn btn-primary"><?php echo display('search') ?></button>
                                <a class="btn btn-warning" href="#"
                                   onclick="printDiv('printableArea')"><?php echo display('print') ?></a>
                            </div>
                        </div>

                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('person_ledger') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div id="printableArea">

                            <div class="text-center">
                                <?php if ($person_details) { ?>

                                    <h3> <?php echo $person_details[0]['person_name'] ?> </h3>
                                    <h4><?php echo display('address') ?>
                                        : <?php echo $person_details[0]['person_address'] ?> </h4>
                                    <h4><?php echo display('phone') ?>
                                        : <?php echo $person_details[0]['person_phone'] ?> </h4>

                                <?php } ?>
                                <h4> <?php echo display('print_date') ?>: <?php echo date("d/m/Y h:i:s"); ?> </h4>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('date') ?></th>
                                        <th class="text-center"><?php echo display('details') ?></th>

                                        <th class="text-right"><?php echo display('debit') ?></th>

                                        <th class="text-right"><?php echo display('credit') ?></th>
                                        <th class="text-right"><?php echo display('balance') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ($ledger) {
                                        ?>

                                        <?php foreach ($ledger as $value) {
                                            ?>
                                            <tr>
                                            <td class="text-center"><?php echo $value['date'] ?></td>
                                            <td align="text-center"><?php echo $value['details'] ?></td>
                                            <td align="right"><?php
                                                echo(($position == 0) ? "$currency" : " $currency");
                                                echo number_format($value['debit'], 2, '.', ',');
                                                ?></td>
                                            <td align="right"><?php
                                                echo(($position == 0) ? "$currency " : " $currency");
                                                echo number_format($value['credit'], 2, '.', ',');
                                                ?></td>
                                            <td align="right"><?php
                                                echo(($position == 0) ? "$currency" : " $currency");
                                                echo number_format($value['balance'], 2, '.', ',')
                                                ?></td>

                                        <?php } ?>
                                        <?php
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="5" class="text-center text-danger">No Record Found</td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="2" align="right"><b><?php echo display('grand_total') ?>:</b></td>
                                        <td align="right">
                                            <b><?php echo(($position == 0) ? $currency . ' ' . $subtotalDebit : $subtotalDebit . ' ' . $currency) ?></b>
                                        </td>

                                        <td align="right">
                                            <b><?php echo(($position == 0) ? $currency . ' ' . $subtotalCredit : $subtotalCredit . ' ' . $currency) ?></b>
                                        </td>

                                        <td align="right"><b>
                                            <?php echo(($position == 0) ? $currency . ' ' . $subtotalBalance : $subtotalBalance . ' ' . $currency) ?>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

