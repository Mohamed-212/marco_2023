<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Customer Ledger Start -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="header-icon">
			<i class="pe-7s-note2"></i>
		</div>
		<div class="header-title">
			<h1><?php echo display('customer_ledger') ?></h1>
			<small><?php echo display('manage_customer_ledger') ?></small>
			<ol class="breadcrumb">
				<li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
				<li><a href="#"><?php echo display('customer') ?></a></li>
				<li class="active"><?php echo display('customer_ledger') ?></li>
			</ol>
		</div>
	</section>

	<!-- Customer information -->
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
				<?php echo $error_message; ?>
			</div>
		<?php
			$this->session->unset_userdata('error_message');
		}
		?>

		<div class="row">
			<div class="col-sm-12">

				<div class="column">
					<?php if ($this->permission->check_label('manage_customer')->read()->access()) { ?>
						<a href="<?php echo base_url('dashboard/Ccustomer/manage_customer') ?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('manage_customer') ?></a>
					<?php }
					if ($this->permission->check_label('customer_ledger')->read()->access()) { ?>
						<a href="<?php echo base_url('dashboard/Ccustomer/customer_ledger_report') ?>" class="btn btn-warning m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('customer_ledger') ?></a>
					<?php } ?>
				</div>
			</div>
		</div>

		<?php if (isset($not_report) && !$not_report) : ?>
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<?php echo form_open("dashboard/Ccustomer/customer_ledger_report", array('class' => 'form-inline')); ?>
							<div class="form-group">
								<label for="customer_id"><?php echo display('customer') ?><span class="text-danger">*</span>:</label>
								<select class="form-control" name="customer_id" id="customer_id" required>
									<?php foreach ($customers_list as $cust) : ?>
										<option value=""></option>
										<option value="<?= $cust['customer_id'] ?>" <?= isset($customer_id) && $customer_id == $cust['customer_id'] ? 'selected' : '' ?>><?= $cust['customer_name'] ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-group">
								<label for="from_date"><?php echo display('from_date') ?><span class="text-danger">*</span>:</label>
								<input type="text" class="form-control datepicker2" autocomplete="off" placeholder="<?php echo display('from_date'); ?>" name="from_date" value="<?= $this->input->post('from_date', TRUE); ?>" required>
							</div>
							<div class="form-group">
								<label for="to_date"><?php echo display('to_date') ?><span class="text-danger">*</span>:</label>
								<input type="text" class="form-control datepicker2" autocomplete="off" placeholder="<?php echo display('to_date'); ?>" name="to_date" value="<?= $this->input->post('to_date', TRUE); ?>" required>
							</div>
							<button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
							<button type="submit" formaction="<?= base_url('dashboard/Ccustomer/customer_ledger_print') ?>" class="btn btn-primary"><?php echo display('print') ?></button>
							<?php echo form_close() ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif ?>

		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
					<div class="panel-heading">
						<div class="panel-title">
							<h4><?php echo display('customer_information') ?></h4>
						</div>
					</div>
					<div class="panel-body">
						<div class="ft_left mr_10">

							<h5><u> <?php echo html_escape($company_info[0]['company_name']); ?></u></h5>

							<?php echo display('customer_name') ?> : <?php echo html_escape($customer_name); ?> <br>
							<?php if (!empty($customer_address)) { ?>
								<?php echo display('customer_address') ?> : <?php echo html_escape($customer_address); ?><br>
							<?php } else { ?>
								<?php echo display('customer_address') ?> : <?php echo html_escape($customer_address_1) ?><br>
							<?php } ?>
							<?php echo display('mobile') ?> : <?php echo html_escape($customer_mobile); ?><br>
							<?php echo display('customer_email') ?> : <?php echo html_escape($customer_email); ?><br>
						</div>

						<div class="ft_left">
							<br>
							<?php echo display('city') ?> : <?php echo html_escape($city); ?><br>
							<?php echo display('state') ?> : <?php echo remove_hyphen($state); ?><br>
							<?php echo display('country') ?> : <?php echo html_escape($country); ?><br>
							<?php echo display('zip') ?> : <?php echo html_escape($zip); ?><br>
							<?php echo display('company') ?> : <?php echo html_escape($company); ?><br>

						</div>
						<div class="ft_right mr_50">
							<br>
							<table class="table table-striped table-condensed table-bordered">

								<!-- <tr>
									<td> <?php echo display('previous_balance') ?> </td>
									<td class="text-right mr_20"> <?php echo (($position == 0) ? $currency . " " . $previous_balance : $previous_balance . " " . $currency) ?></td>
								</tr> -->
								<tr>
									<td> <?php echo display('debit_ammount') ?> </td>
									<td class="text-right mr_20"> <?php echo (($position == 0) ? $currency . " " . $total_debit : $total_debit . " " . $currency) ?></td>
								</tr>
								<tr>
									<td><?php echo display('credit_ammount'); ?></td>
									<td class="text-right mr_20"> <?php echo (($position == 0) ? $currency . " " . $total_credit : $total_credit . " " . $currency) ?></td>
								</tr>
								<tr>
									<td><?php echo display('balance_ammount'); ?> </td>
									<td class="text-right mr_20"> 
									<?php
																								echo (float)$total_balance_pure > 0 ? display('debit') : '';

                                                                                                echo (float)$total_balance_pure < 0 ? display('has_credit') : '';
                                                                                            ?>
										<?php echo (($position == 0) ? $currency . " " . $total_balance : $total_balance . " " . $currency) ?>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="card-body px-3">

						<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse<?= $customer_id ?>" aria-expanded="false" aria-controls="collapse<?= $customer_id ?>" style="margin: 15px;">
							<?= display('see_more') ?> <?= display('contact_info') ?>
						</button>
						<div class="collapse" id="collapse<?= $customer_id ?>">
							<div class="well">
								<?php foreach ($contact_info as $cinfo) : ?>
									<div class="" style="padding: 0.5rem;border-bottom: 1px solid #ddd;">
										<div class="row" style="line-height: 2.8rem;">
											<div class="col-sm-6">
												<?= display('customer_name') ?>: <?= $cinfo->name ?>
											</div>
											<div class="col-sm-6">
												<?= display('customer_mobile') ?>: <?= $cinfo->phone ?>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<?= display('customer_address') ?>: <?= $cinfo->address ?>
											</div>
										</div>
									</div>
								<?php endforeach ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Manage Customer -->
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
					<div class="panel-heading">
						<div class="panel-title">
							<h4><?php echo display('customer_ledger') ?></h4>
						</div>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table id="dataTableExample2" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th><?php echo display('Document No') ?></th>
										<th class="text-right mr_20"><?php echo display('debit') ?></th>
										<th class="text-right mr_20"><?php echo display('credit') ?></th>
										<th class="text-right mr_20"><?php echo display('balance') ?></th>
										<th><?php echo display('date') ?></th>
										<th><?php echo display('details') ?></th>
										<!-- <th><?php echo display('receipt_no') ?></th>
										<th><?php echo display('description') ?></th> -->


									</tr>
								</thead>
								<tbody>
									<?php
									if ($ledger) {
									?>
										<?php foreach ($ledger as $v_ledger) { ?>
											<tr>
												<td>
													<!-- doc no -->
													<?php
													if ($v_ledger['voucher'] == 'Pb') {
														echo "Pb / " . $v_ledger['c_id'];
													} elseif ($v_ledger['voucher'] == 'Rdv') {
														echo "Rdv / " . $v_ledger['c_id'];
													} elseif ($v_ledger['voucher'] == 'Rcv') {
														echo "Rcv / " . $v_ledger['c_id'];
													} elseif ($v_ledger['voucher'] == 'SalRe') {
														echo "SalRe / " . $v_ledger['c_id'];
													} elseif ($v_ledger['voucher'] == 'Sall') {
														echo "Sall / " . $v_ledger['c_id'];
													} else {
														echo "Pb / " . $v_ledger['c_id'];
													}
													?>
												</td>
												<td class="text-right">
													<?php
													echo (($position == 0) ? $currency . ' ' . (float)$v_ledger['debit'] : (float)$v_ledger['debit'] . ' ' . $currency) ?>
												</td>
												<td class="text-right"> <?php echo (($position == 0) ? $currency . ' ' . (float)$v_ledger['credit'] : (float)$v_ledger['credit'] . ' ' . $currency) ?></td>
												<td class="text-right">
												<?php
                                                                                                echo (float)$v_ledger['balance'] > 0 ? display('debit') : '';

                                                                                                echo (float)$v_ledger['balance'] < 0 ? display('has_credit') : '';
                                                                                            ?>
													<?php echo (($position == 0) ? $currency . ' ' . abs($v_ledger['balance']) : abs($v_ledger['balance']) . ' ' . $currency) ?>
												</td>
												<td><?php echo date('d-m-Y', strtotime($v_ledger['cl_created_at'])); ?></td>
												<td dir="rtl" align="center">
													<?php echo str_replace('PLHH', $v_ledger['c_id'], $v_ledger['details']);?>
												</td>
											</tr>
									<?php
										}
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<!-- Customer Ledger End  -->
<script>
	$(document).ready(function() {
		$(".datepicker2").datepicker({
			dateFormat: "dd-mm-yy"
		});
	});
</script>