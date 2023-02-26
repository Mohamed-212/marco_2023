<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- Product js php -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/product.js.php"></script>
<script src="<?php echo MOD_URL . 'dashboard/assets/js/print.js'; ?>"></script>

<!-- Stock List Supplier Wise Start -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="header-icon">
			<i class="pe-7s-note2"></i>
		</div>
		<div class="header-title">
			<h1><?php echo display('sales_report_latest_customers') ?></h1>
			<small><?php echo display('sales_report_latest_customers') ?></small>
			<ol class="breadcrumb">
				<li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
				<li><a href="#"><?php echo display('report') ?></a></li>
				<li class="active"><?php echo display('sales_report_latest_customers') ?></li>
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


		<!-- Stock report supplier wise -->
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-body">

						<?php echo form_open('dashboard/Admin_dashboard/retrieve_sales_report_latest_customers', array('class' => '', 'id' => 'validate')); ?>
						<?php
						date_default_timezone_set(DEF_TIMEZONE);
						$today = date('d-m-Y'); ?>

						<div class="form-group row">
							<label for="start_date" class="col-sm-2 col-form-label"><?php echo display('start_date') ?>:</label>
							<div class="col-sm-4">
								<input type="text" name="start_date" class="form-control datepicker2" id="start_date" placeholder="<?php echo display('start_date') ?>" value="<?= $start_date ?>" autocomplete="off">
							</div>
						</div>

						<div class="form-group row">
							<label for="end_date" class="col-sm-2 col-form-label"><?php echo display('end_date') ?>:</label>
							<div class="col-sm-4">
								<input type="text" name="end_date" class="form-control datepicker2" id="end_date" value="<?= $end_date ? $end_date : $today ?>" placeholder="<?php echo display('end_date') ?>" autocomplete="off">
							</div>
						</div>

						<div class="form-group row">
							<label for="" class="col-sm-3 col-form-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-primary"><?php echo display('search') ?></button>
								<!-- <a class="btn btn-warning" href="#" onclick="printDiv('printableArea')"><?php echo display('print') ?></a> -->
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
							<h4><?php echo display('sales_report_latest_customers') ?></h4>
						</div>
					</div>
					<div class="panel-body">
						<div id="printableArea" class="ml_2">
							<link href="<?php echo MOD_URL . 'dashboard/assets/css/print.css'; ?>" rel="stylesheet" type="text/css" />

							<?php if (@$sales_reports) : ?>
								<p class="store_name"><?php echo html_escape($sales_reports[0]['store_name']) ?></p>
								<div class="store_div">
									<?php if ($start_date) : ?>
										<p class="mr_p8e"><?php echo display('report') ?> <?php echo display('from') ?> :
											<strong><?php echo html_escape($start_date) ?></strong>
										</p>
										<p class="mr_p8e"><?php echo display('to') ?> : <strong><?php echo html_escape($end_date) ?></strong></p>
									<?php endif; ?>
									<p><?php echo display('total_invoice') ?> : <strong><?php echo count($sales_reports) ?></strong></p>
								</div>
							<?php endif; ?>
							<div class="table-responsive mt_10">
								<table id="" class="table table-bordered table-striped table-hover dataTablePagination">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center"><?php echo display('customer_name') ?></th>
											<th class="text-center"><?php echo display('first_date') ?></th>
											<th class="text-center"><?php echo display('grand_total') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$total_sale = 0;
										$total_paid = 0;
										$total_due  = 0;
										if (@$sales_reports) {
											$sl = 0;
											foreach ($sales_reports as $invoice) :
												$sl++;
												$next = 0;
												$total_sale += $invoice['balance'];
										?>

												<tr>
													<td>
														<?= $sl ?>
													</td>
													<td>
														<a href="<?= base_url() . '/dashboard/Ccustomer/customerledger/' . $invoice['customer_id'] ?>"><?= $invoice['customer_name'] ?></a>
													</td>
													<td>
														<?php
														$q = $this->db->select('created_at')->from('invoice')->where('customer_id', $invoice['customer_id'])->order_by('created_at', 'asc')->limit(1)->get()->result_array();

														echo !empty($q[0]['created_at']) ? date('d-m-Y', strtotime($q[0]['created_at'])) : '...';
														?>
													</td>
													<td>
														<?php
														echo round($invoice['balance'], 2);
														?>
													</td>
												</tr>
										<?php
											endforeach;
										}
										?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="3" align="right"><b><?php echo display('grand_total') ?>:</b></td>
											<td align="center"><b><?php echo html_escape($total_sale); ?></td>
										</tr>
									</tfoot>
								</table>
							</div>

							<div class="table-responsive mt_10">
								<table id="" class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="text-center"><?php echo display('grand_total') ?></th>
										</tr>
									</thead>
									<tbody>
										<td align="center"><b><?php echo html_escape(round($total_sale, 2)); ?></td>
									</tbody>
								</table>
							</div>
						</div>
						<div class="text-center"><?php echo htmlspecialchars_decode(@$links) ?></div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<!-- Stock List Supplier Wise End -->
<script>
	$(document).ready(function() {
		$(".datepicker2").datepicker({
			dateFormat: "dd-mm-yy"
		});

		$(document).on('change', '#country', function() {
			var val = $(this).val();

			// get city list
			var base_url = $("#base_url").val();
			$.ajax({
				url: base_url + "hrm/hrm/get_country_cities/",
				type: "POST",
				data: {
					country_id: val,
					csrf_test_name: csrf_test_name,
				},
				success: function(data) {
					// console.log(data);
					$('#city').append(data);
				}
			});
		});
	});
</script>