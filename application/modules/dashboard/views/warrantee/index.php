<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<link rel="stylesheet" href="<?php echo MOD_URL.'dashboard/assets/css/dashboard.css' ?>">


<!-- Add New Purchase Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('warrantee') ?></h1>
            <small><?php echo display('invoice_wise_warrantee') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li class="active"><?php echo display('warrantee') ?></li>
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
        <!-- Add New Purchase -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('invoice_wise_warrantee') ?></h4>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="form-group row">
                            <label for="invoice_no" class="col-sm-2 col-form-label"><?php echo display('invoice_no')?>
                            </label>
                            <div class="col-sm-4">
                                <input type="text" name="invoice_no" id="invoice_no" placeholder="Enter invoice number"
                                    class="form-control" value="" required>
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-success btn-sm"
                                    id="search_invoice_details"><?php echo display('search')?> <i class="fa fa-search"
                                        aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="warrantee_products_table">
                                <thead>
                                    <tr>
                                        <th class="text-center align-items-center"><?php echo display('product_name')?>
                                        </th>
                                        <th class="text-center"><?php echo display('quantity')?></th>
                                        <th class="text-center"><?php echo display('purchase_date')?></th>
                                        <th class="text-center"><?php echo display('warrantee_period_month')?></th>
                                        <th class="text-center"><?php echo display('warrantee_expiry_date')?></th>
                                        <th class="text-center"><?php echo display('status')?></th>
                                    </tr>
                                </thead>
                                <tbody id="warrantee_products">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Add New Purchase End -->
<script src="<?php echo MOD_URL.'dashboard/assets/js/warrantee.js'; ?>"></script>