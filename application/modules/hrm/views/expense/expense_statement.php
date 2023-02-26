<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Manage Customer Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('expense') ?></h1>
            <small><?php echo $title ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('expense') ?></a></li>
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
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo form_open('expense_statement', array('class' => 'form-inline', 'method' => 'get')) ?>

                        <div class="col-sm-3">

                            <label class="col-sm-4"
                                   for="expense_item_name"><?php echo display('expense_item_name') ?></label>
                            <div class="col-sm-8">
                                <select class="form-control" name="expense_item">
                                    <option value="">Select One</option>

                                    <?php foreach ($item_list as $expenses) { ?>
                                        <option value="<?php echo html_escape($expenses['expense_item_name']) ?>" <?php if ($expenses['expense_item_name'] == $expense_id) {
                                            echo 'selected';
                                        } ?>><?php echo html_escape($expenses['expense_item_name']) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="col-sm-6">
                                <label class="col-sm-4" for="from_date"><?php echo display('start_date') ?></label>
                                <div class="col-sm-8">
                                    <input type="text" name="from_date" class="form-control datepicker" id="from_date"
                                           placeholder="<?php echo display('start_date') ?>"
                                           value="<?php echo(!empty($from_date) ? html_escape($from_date) : html_escape($today)) ?>">

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="col-sm-4" for="to_date"><?php echo display('end_date') ?></label>
                                <div class="col-sm-8">
                                    <input type="text" name="to_date" class="form-control datepicker" id="to_date"
                                           placeholder="<?php echo display('end_date') ?>"
                                           value="<?php echo(!empty($to_date) ? html_escape($to_date) : html_escape($today)) ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
                            <a class="btn btn-warning" href="#"
                               onclick="printDiv('printArea')"><?php echo display('print') ?></a>
                        </div>

                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12" id="printArea">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('expense_statement') ?> </h4>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th><?php echo display('date') ?></th>
                                    <th><?php echo display('expense_item_name') ?></th>
                                    <th><?php echo display('amount') ?></th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $Totalamount = 0;
                                if ($expense_statement) {
                                    ?>
                                    <?php
                                    foreach ($expense_statement as $statement) {
                                        ?>
                                        <tr>
                                            <td><?php echo html_escape($statement['date']) ?></td>
                                            <td><?php echo html_escape($statement['type']) ?></td>
                                            <td class="text-right"><?php echo html_escape(number_format($statement['amount'], 2, '.', ','));

                                                $Totalamount += $statement['amount'];
                                                ?></td>


                                        </tr>
                                    <?php } ?>
                                <?php } else {
                                    ?>
                                    <tr>
                                        <td class="text-center" colspan="3">No Record Found</td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="2" class="text-right"><b><?php echo display('total') ?></b></td>
                                    <td class="text-right"><?php echo html_escape(number_format($Totalamount, 2, '.', ',')); ?></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

