<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Manage order Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('manage_stock_adjustment') ?></h1>
            <small><?php echo display('stock_adjustment') ?></small>
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        <i class="pe-7s-home"></i>
                        <?php echo display('home') ?>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <?php echo display('stock') ?>
                    </a>
                </li>
                <li class="active">
                    <?php echo display('manage_stock_adjustment') ?>
                </li>
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
                    <a href="<?php echo base_url('dashboard/Cstock_adjustment/stock_adjustment') ?>"
                        class="btn btn-info color4 color5 m-b-5 m-r-2">
                        <i class="ti-plus"></i> <?php echo display('stock_adjustment') ?>
                    </a>
                </div>
            </div>
        </div>
        <!-- Manage order report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('manage_stock_adjustment') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo display('sl') ?></th>
                                        <th><?php echo display('store') ?></th>
                                        <th><?php echo display('date') ?></th>
                                        <th><?php echo display('details') ?></th>
                                        <th><?php echo display('status') ?></th>
                                        <th><?php echo display('created_by') ?></th>
                                        <th><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									if ($stock_adjustment_list) {
										foreach ($stock_adjustment_list as $key => $adjustment) { ?>
                                    <tr>
                                        <td><?php echo $key + 1; ?></td>
                                        <td><?php echo html_escape($adjustment['store_name']); ?></td>
                                        <td><?php echo html_escape($adjustment['date']); ?></td>
                                        <td><?php echo substr_replace($adjustment['details'], '...', 25); ?></td>
                                        <td>
                                        <?php if ($adjustment['adjustment_status'] == '0') : ?>
                                            <?php echo form_open('dashboard/Cstock_adjustment/update_status/' . $adjustment['adjustment_id'], array('id' => 'validate')); ?>
                                            <?php endif ?>

                                            <select class="form-control" name="adjustment_status" required="">
                                                <option value=""></option>
                                                <option value="0" <?php if ($adjustment['adjustment_status'] == '0') {
																				echo "selected";
																			} ?>><?php echo display('pending') ?></option>
                                                <option value="1" <?php if ($adjustment['adjustment_status'] == '1') {
																				echo "selected";
																			} ?>><?php echo display('approved') ?></option>
                                                <option value="2" <?php if ($adjustment['adjustment_status'] == '2') {
																				echo "selected";
																			} ?>><?php echo display('cancel') ?></option>
                                            </select>
                                            <?php if ($adjustment['adjustment_status'] == '0') : ?>
                                            <button type="submit"
                                                class="btn btn-primary inv_updatebtn"><?php echo display('update') ?></button>
                                            
                                            <?php echo form_close() ?>
                                            <?php endif ?>
                                        </td>
                                        <td><?php echo html_escape($adjustment['first_name']) . ' ' . html_escape($adjustment['last_name']); ?>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="<?php echo base_url() . 'dashboard/Cstock_adjustment/adjustment_details/' . $adjustment['adjustment_id'] ?>"
                                                    class="btn btn-primary btn-sm" data-toggle="tooltip"
                                                    data-placement="left" title="<?php echo display('details') ?>"><i
                                                        class="fa fa-eye" aria-hidden="true"></i></a>

                                                <a href="<?php echo base_url() . 'dashboard/Cstock_adjustment/adjustment_voucher/' . $adjustment['adjustment_id'] ?>"
                                                    class="btn btn-success btn-sm" data-toggle="tooltip"
                                                    data-placement="left" title="<?php echo display('details') ?>"><i
                                                        class="fa fa-window-restore" aria-hidden="true"></i></a>
                                            </center>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right">
                            <?php echo htmlspecialchars_decode($links); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>