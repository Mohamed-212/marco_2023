<script src="<?php echo MOD_URL.'dashboard/assets/js/print.js'; ?>"></script>
<link rel="stylesheet" href="<?php echo MOD_URL.'accounting/assets/css/reports_by_voucher.css' ?>">
<!-- Sales Report Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('voucher_reports') ?></h1>
            <small><?php echo display('reports_by_voucher') ?></small>
            <ol class="breadcrumb">
                <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('report') ?></a></li>
                <li class="active"><?php echo display('sales_report') ?></li>
            </ol>
        </div>
    </section>
    <section class="content">
        <!-- Voucher report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('voucher_reports') ?> </h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group row">
                            <div class="col-sm-8 custom_select">
                                <select class="get-all-voucher-info-ajax" id="voucher_no"></select>
                            </div>
                        </div>
                        <div id="purchase_div" class="ml_2">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th><?php echo display('account_code') ?></th>
                                            <th><?php echo display('name') ?></th>
                                            <th><?php echo display('description') ?></th>
                                            <th><?php echo display('debit') ?></th>
                                            <th><?php echo display('credit') ?></th>
                                            <th><?php echo display('created_date') ?></th>
                                            <th><?php echo display('created_by') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="voucher_row">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-right"></td>
                                            <td class="text-right" id="total_debit"><b>0</b></td>
                                            <td class="text-right" id="total_credit"><b>0</b></td>
                                            <td colspan="2" class="text-right"></td>
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
<!-- Voucher Report End -->