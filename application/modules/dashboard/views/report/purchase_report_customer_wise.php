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
			<h1><?php echo display('purchase_report_customer_wise') ?></h1>
			<small><?php echo display('purchase_report_customer_wise') ?></small>
			<ol class="breadcrumb">
				<li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
				<li><a href="#"><?php echo display('report') ?></a></li>
				<li class="active"><?php echo display('purchase_report_customer_wise') ?></li>
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

						<?php echo form_open('dashboard/Admin_dashboard/retrieve_purchase_report_customer_wise', array('class' => '', 'id' => 'validate')); ?>
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
							<h4><?php echo display('purchase_report_customer_wise') ?></h4>
						</div>
					</div>
					<div class="panel-body">
						<div id="printableArea" class="ml_2">
							<link href="<?php echo MOD_URL . 'dashboard/assets/css/print.css'; ?>" rel="stylesheet" type="text/css" />

							<?php if ($purchase_reports) : ?>
								<div class="store_div">
									<?php if ($start_date) : ?>
										<p class="mr_p8e"><?php echo display('report') ?> <?php echo display('from') ?> :
											<strong><?php echo html_escape($start_date) ?></strong>
										</p>
										<p class="mr_p8e"><?php echo display('to') ?> : <strong><?php echo html_escape($end_date) ?></strong></p>
									<?php endif; ?>
									<p><?php echo display('total_invoice') ?> : <strong><?php echo count($purchase_reports) - 1 ?></strong></p>
								</div>
							<?php endif; ?>
							<div class="table-responsive mt_10">
								<table id="djkjk" class="table table-bordered table-striped table-hover dataTablePagination dataTablePaginationNoSorting">
									<thead>
										<tr>
											<th class="text-center"><?php echo display('invoice') ?></th>
											<th class="text-center"><?php echo display('date') ?></th>
											<th class="text-center"><?php echo display('quantity') ?></th>
											<th class="text-center"><?php echo display('supplier_name') ?></th>
											<th class="text-center"><?php echo display('total_value') ?></th>
											<th class="text-center"><?php echo display('total_discount') ?></th>
											<th class="text-center"><?php echo display('total_vat') ?></th>
											<th class="text-center"><?php echo display('grand_total') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$total_sale = 0;
										if ($purchase_reports) {
											$sl = 1;
											$next = 1;
											foreach ($purchase_reports as $invoice) :

												if (empty($invoice['invoice'])) continue;

												$total_sale += $invoice['grand_total_amount'];

												$total_sale_supplier += $invoice['grand_total_amount'];
										?>
												<tr>
													<td align="center">
														<a href="<?php echo base_url() . 'dashboard/Cpurchase/purchase_inserted_data/' . $invoice['purchase_id']; ?>">
															<?php echo html_escape($invoice['invoice']) ?> <i class="fa fa-tasks pull-right" aria-hidden="true"></i>
														</a>
													</td>
													<td>
														<?= date('d-m-Y', strtotime($invoice['date_time'])) ?>
													</td>
													<td>
														<?= $invoice['total_items'] ?>
													</td>
													<td>
														<?= $invoice['supplier_name'] ?>
													</td>
													<td>
														<?= $invoice['sub_total_price'] ?>
													</td>
													<td>
														<?= $invoice['total_purchase_dis'] ?>
													</td>
													<td>
														<?= $invoice['total_purchase_vat'] ?>
													</td>
													<td>
														<?= $invoice['grand_total_amount'] ?>
													</td>
												</tr>
												<?php if ($purchase_reports['suppliers'][$invoice['supplier_id']] == $next) : $next = 0; ?>
													<tr>
														<td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td>
														<td align="right"><b><?php echo display('grand_total') ?>:</b></td>
														<td align="center"><b><?php echo html_escape($total_sale_supplier); ?></td>
													</tr>
												<?php $total_sale_supplier = 0;
												endif ?>
										<?php
												$next++;
											endforeach;
										}
										?>
									</tbody>
									<tfoot>
										<tr>
										<td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td>

											<td align="right"><b><?php echo display('grand_total') ?>:</b></td>
											<td align="center"><b><?php echo html_escape($total_sale); ?></td>
										</tr>
									</tfoot>
								</table>
							</div>

							<div class="panel-heading">
								<div class="panel-title">
									<h4><?php echo display('return_purchase') ?>:</h4>
								</div>
							</div>
							<div class="table-responsive mt_10">
								<table id="qas" class="table table-bordered table-striped table-hover dataTablePagination dataTablePaginationNoSorting">
									<thead>
										<tr>
											<th class="text-center"><?php echo display('invoice') ?></th>
											<th class="text-center"><?php echo display('date') ?></th>
											<th class="text-center"><?php echo display('quantity') ?></th>
											<th class="text-center"><?php echo display('supplier_name') ?></th>
											<th class="text-center"><?php echo display('total_value') ?></th>
											<th class="text-center"><?php echo display('total_discount') ?></th>
											<th class="text-center"><?php echo display('total_vat') ?></th>
											<th class="text-center"><?php echo display('grand_total') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$total_return_purchases = 0;
										$total_paid = 0;
										$total_due  = 0;
										if ($return_reports) {
											$sl = 1;
											$next = 1;
											foreach ($return_reports as $invoice) :
												if (empty($invoice['purchase_id'])) continue;


												$total_return_purchases += $invoice['total_total_return'];
												$total_return_purchases_customer += $invoice['total_total_return'];
										?>

												<tr>
													<td align="center">
														<a href="<?php echo base_url() . 'dashboard/Cpurchase_return/purchase_return_details_data/' . $invoice['purchase_return_id']; ?>">
															<?php echo html_escape($invoice['purchase_return_id']) ?> <i class="fa fa-tasks pull-right" aria-hidden="true"></i>
														</a>
													</td>
													<td>
														<?= date('d-m-Y', strtotime($invoice['date_time'])) ?>
													</td>
													<td>
														<?= $invoice['total_return_quantity'] ?>
													</td>
													<td>
														<?= $invoice['supplier_name'] ?>
													</td>
													<td>
														<?= $invoice['total_total_return'] + $invoice['total_total_discount'] ?>
													</td>
													<td>
														<?= $invoice['total_total_discount'] ?>
													</td>
													<td>
														<?= $invoice['total_total_return'] - $invoice['total_rate'] ?>
													</td>
													<td>
														<?= $invoice['total_total_return'] ?>
													</td>
												</tr>
												<?php if ($return_reports['customers'][$invoice['customer_id']] == $next) : $next = 0; ?>
													<tr>
																												<td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td>

														<td align="right"><b><?php echo display('grand_total') ?>:</b></td>
														<td align="center" col><b><?php echo html_escape($total_return_purchases_customer); ?></td>
													</tr>
												<?php $total_sale_supplier = 0;
												endif ?>
										<?php
												$next++;
											endforeach;
										}
										?>
									</tbody>
									<tfoot>
										<tr>
																									<td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td>

											<td align="right"><b><?php echo display('grand_total') ?>:</b></td>
											<td align="center" col><b><?php echo html_escape($total_return_purchases); ?></td>
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
										<td align="center"><b><?php echo html_escape($total_sale - $total_return_purchases); ?></td>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<!-- Stock List Supplier Wise End -->
<script>
	$(document).ready(function() {
		$.fn.dataTable.ext.errMode = 'none';
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