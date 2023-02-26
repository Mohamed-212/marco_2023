<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Supplier Ledger Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('return_product_report') ?></h1>
            <small><?php echo display('return_product_report') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('return') ?></a></li>
                <li class="active"><?php echo display('return_product_report') ?></li>
            </ol>
        </div>
    </section>
    <!-- Supplier information -->
    <section class="content">
        <!-- Alert Message -->
        <?php
        $message = $this->session->userdata('message');
        if (isset($message)) {
        ?>
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $message ?>
            </div>
        <?php
            $this->session->unset_userdata('message');
        }
        $error_message = $this->session->userdata('error_message');
        if (isset($error_message)) {
        ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error_message ?>
            </div>
        <?php
            $this->session->unset_userdata('error_message');
        }
        ?>

        <!-- Supplier select -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo form_open('dashboard/Crefund/return_report', array('class' => 'form-inline')); ?>
                        <div class="form-group">
                            <label for="from_date"><?php echo display('from_date') ?><span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control datepicker" autocomplete="off" placeholder="<?php echo display('from_date'); ?>" name="from_date" required>
                        </div>
                        <div class="form-group">
                            <label for="to_date"><?php echo display('to_date') ?><span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control datepicker" autocomplete="off" placeholder="<?php echo display('to_date'); ?>" name="to_date" required>
                        </div>
                        <div class="form-group" style="display: none;">
                            <label for="status"><?php echo display('status') ?><span class="text-danger">*</span>:</label>
                            <select class='form-control' id='status' name='status'>
                                <option value=''><?= display('status') ?></option>
                                <option value='1'><?php echo display('damaged') ?></option>
                                <option value='2'><?php echo display('no warranty') ?></option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Manage Supplier -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('return_product_report') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="" class="table table-bordered table-striped table-hover dataTablePaginationNoSorting">
                                <thead>

                                    <tr>
                                        <th colspan="8" class="text-center">
                                            <?= display('from_date') ?> :
                                            <?php if (!empty($from_date)) {
                                                echo $from_date;
                                            } else {
                                                echo display('from_date');
                                            } ?>
                                            <?= display('to_date') ?> : - :
                                            <?php if (!empty($from_date)) {
                                                echo $to_date;
                                            } else {
                                                echo display('to_date');
                                            } ?>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th class="text-center"><?= display('sl') ?></th>
                                        <th class="text-center"><?= display('product_name') ?></th>
                                        <th class="text-center"><?= display('variant_name') ?></th>
                                        <!-- <th class="text-center"><?= display('status') ?></th> -->
                                        <th class="text-center"><?= display('quantity') ?></th>
                                        <th class="text-center"><?= display('date') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($return_product_report)) {
                                        $totalSl = 0;
                                        $totalQuantity = 0;
                                        $sl = 0;
                                        foreach ($return_product_report as $key => $return_report) {
                                            $totalSl += $key + 1;
                                            $totalQuantity += (int)$return_report['quantity'];
                                    ?>
                                            <tr>
                                                <td><?php echo ++$sl; ?></td>
                                                <td><?php echo html_escape($return_report['product_name']); ?></td>
                                                <td><?php echo html_escape($return_report['variant_name']); ?></td>
                                                <!-- <td><?php echo ($return_report['status'] == 1) ? display('damaged') : display('no warranty') ?></td> -->
                                                <td><?php echo html_escape($return_report['quantity']); ?></td>
                                                <td><?php echo html_escape(date('d-m-Y', strtotime($return_report['created_at']))); ?></td>
                                            </tr>
                                        <?php } ?>

                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><?php echo $totalSl; ?></td>
                                        <td align="center">
                                            <b><?= display('grand_total') ?></b>
                                        </td>
                                        <td>--</td>
                                        <td>--</td>
                                        <td><?php echo $totalQuantity; ?></td>
                                        <td>--</td>
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
<!-- Supplier Ledger End 