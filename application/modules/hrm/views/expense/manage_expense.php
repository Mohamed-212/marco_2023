<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/employee.js.php" ></script>
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
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('manage_expense') ?></h4>
                        </div>

                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>

                                    <th><?php echo display('date') ?></th>
                                    <th><?php echo display('type') ?></th>
                                    <th class="text-center"><?php echo display('amount') ?></th>

                                    <th><?php echo display('action') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $totalam = 0;
                                if ($expense_list) {
                                    foreach ($expense_list as $expense) {
                                        ?>
                                        <tr>

                                            <td><?php echo html_escape($expense['date']); ?></td>
                                            <td>

                                                <?php echo html_escape($expense['type']).' Expense'; ?>

                                            </td>
                                            <td class="text-right"><?php echo html_escape($expense['amount']);
                                                $totalam += $expense['amount'];
                                                ?></td>

                                            <td>

                                                <?php if($this->permission->method('manage_expense', 'delete')->access()){ ?>
                                                    <a href="<?php echo base_url("hrm/expense/delete_expense/".$expense['voucher_no']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') " data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash"></i></a>
                                                <?php }?>

                                            </td>
                                        </tr>


                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="2" class="text-right"><b><?php echo display('total')?></b></td>
                                    <td class="text-right"><b><?php echo html_escape(number_format($totalam,2))?></b></td>
                                    <td></td>
                                </tr>
                                </tfoot>

                            </table>
                            <div class="text-center"><?php echo $links ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
