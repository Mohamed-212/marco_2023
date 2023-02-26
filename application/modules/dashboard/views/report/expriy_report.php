<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Add new currency start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('expriy_report') ?></h1>
            <small><?php echo display('batch_wise_expire_report') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('loyalty_points') ?></a></li>
                <li class="active"><?php echo display('expriy_report') ?></li>
            </ol>
        </div>
    </section>
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
        $validatio_error = validation_errors();
        if (($error_message || $validatio_error)) {
        ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $error_message ?>
            <?php echo $validatio_error ?>
        </div>
        <?php
            $this->session->unset_userdata('error_message');
        }
        ?>
        <!-- Loyalty Point Settings Start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo form_open("dashboard/cexpriy_report/expriy_report_index", array('method' => 'GET')); ?>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label"><?php echo display('product_name') ?></label>
                                    <input type="text" class="form-control" name="product_name" value=""
                                        placeholder='<?php echo display('product_name') ?>'>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label"><?php echo display('batch_no') ?></label>
                                    <input type="text" class="form-control" name="batch_no" value=""
                                        placeholder='<?php echo display('batch_no') ?>'>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label"><?php echo display('from_date') ?></label>
                                    <input type="text" class="form-control datepicker2" name="from_date" value=""
                                        placeholder='<?php echo display('expire_date_from') ?>' autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label"><?php echo display('to_date') ?></label>
                                    <input type="text" class="form-control datepicker2" name="to_date" value=""
                                        placeholder='<?php echo display('expire_date_till') ?>' autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label"></label>
                                    <button type="submit"
                                        class="btn btn-primary filter_btn"><?php echo display('search') ?></button>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('expriy_report') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo display('product_name') ?></th>
                                        <th><?php echo display('batch_no') ?></th>
                                        <th><?php echo display('quantity') ?></th>
                                        <th><?php echo display('expire_date') ?></th>
                                        <th><?php echo display('expire_duration') ?> (days)</th>
                                        <th><?php echo display('status') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($products_expiry_list) {
                                        foreach ($products_expiry_list as $product) { ?>
                                    <tr>
                                        <td><?php echo html_escape($product['product_name']) ?></td>
                                        <td><?php echo html_escape($product['batch_no']) ?></td>
                                        <td><?php echo html_escape($product['quantity']) ?></td>
                                        <td><?php echo ($product['expiry_date'] != '') ? html_escape(date('d-m-Y', strtotime($product['expiry_date']))) : 'N/A' ?>
                                        </td>
                                        <?php
                                                if ($product['expiry_date'] != '') {
                                                    $now = time(); // or your date as well
                                                    $expiry_date = strtotime($product['expiry_date']);
                                                    $datediff  = $expiry_date - $now;
                                                    $left_days = round($datediff / (60 * 60 * 24)); ?>
                                        <td><?php echo $left_days ?></td>
                                        <td><?php echo ($left_days <= 0) ? 'Expired' : 'Valid' ?></td>
                                        <?php } else { ?>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <?php } ?>
                                    </tr>
                                    <?php  }
                                    } ?>
                                </tbody>
                            </table>
                            <div class="text-right">
                                <?php echo htmlspecialchars_decode(@$links); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Loyalty Point Settings End -->
    </section>
</div>
<script>
    $(document).ready(function() {
        $(".datepicker2").datepicker({
			dateFormat: "dd-mm-yy"
		});
    });
</script>