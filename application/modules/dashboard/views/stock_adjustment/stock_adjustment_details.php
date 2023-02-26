<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Add new customer start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('stock_adjustment_details') ?></h1>
            <small><?php echo display('stock_adjustment') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('stock') ?></a></li>
                <li><a href="#"><?php echo display('stock_adjustment') ?></a></li>
                <li class="active"><?php echo display('stock_adjustment_details') ?></li>
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
        <div class="row">
            <div class="col-sm-12">
                <div class="column">
                    <a href="<?php echo base_url('dashboard/Cstock_adjustment/manage_stock_adjustment') ?>"
                        class="btn btn-info color4 color5 m-b-5 m-r-2">
                        <i class="fa fa-arrow-left"></i> <b><?php echo display('manage_stock_adjustment') ?></b>
                    </a>
                </div>
            </div>
        </div>
        <!-- New customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('stock_adjustment_details') ?> </h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo display('adjustment_id') ?></th>
                                        <th><?php echo display('product') ?></th>
                                        <th><?php echo display('variant') ?></th>
                                        <!-- <th><?php echo display('color_variant') ?></th> -->
                                        <th><?php echo display('previous_quantity') ?></th>
                                        <th><?php echo display('adjustment_quantity') ?></th>
                                        <th><?php echo display('adjustment_type') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($adjustment_details)) {
                                        foreach ($adjustment_details as $details) {
                                    ?>
                                    <tr>
                                        <td><?php echo html_escape($details['adjustment_id']); ?></td>
                                        <td><?php echo html_escape($details['product_name']); ?></td>
                                        <td><?php echo html_escape(@$details['variant_name']); ?></td>
                                        <!-- <td><?php echo html_escape(@$details['color_variant']); ?></td> -->
                                        <td><?php echo html_escape(@$details['previous_quantity']); ?></td>
                                        <td><?php echo html_escape(@$details['adjustment_quantity']); ?></td>
                                        <td><?php echo html_escape(ucfirst($details['adjustment_type'])); ?></td>
                                    </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo MOD_URL . 'dashboard/assets/js/stock_adjustment_form.js'; ?>"></script>