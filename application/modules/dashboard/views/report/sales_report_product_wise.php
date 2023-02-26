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
			<h1><?php echo display('sales_report_product_wise') ?></h1>
			<small><?php echo display('sales_report_product_wise') ?></small>
			<ol class="breadcrumb">
				<li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
				<li><a href="#"><?php echo display('report') ?></a></li>
				<li class="active"><?php echo display('sales_report_product_wise') ?></li>
			</ol>
		</div>
	</section>
f 
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

						<?php echo form_open('dashboard/Admin_dashboard/retrieve_sales_report_product_wise', array('class' => '', 'id' => 'validate')); ?>
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
							<h4><?php echo display('sales_report_product_wise') ?></h4>
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
								<table id="sadasd" class="table table-bordered table-striped table-hover dataTablePagination dataTablePaginationNoSorting">
									<thead>
										<tr>
											<th class="text-center"><?php echo display('sl') ?></th>
											<th class="text-center"><?php echo display('invoice') ?></th>
											<th class="text-center"><?php echo display('date') ?></th>
											<th class="text-center"><?php echo display('customer_name') ?></th>
											<th class="text-center"><?php echo display('product_name') ?></th>
											<th class="text-center"><?php echo display('quantity') ?></th>
											<th class="text-center"><?php echo display('price') ?></th>
											<th class="text-center"><?php echo display('discount') ?></th>
											<th class="text-center"><?php echo display('vat_rate') ?></th>
											<th class="text-center"><?php echo display('vat_value') ?></th>
											<th class="text-center"><?php echo display('total_value') ?></th>
											<th class="text-center"><?php echo display('paid_amount') ?></th>
											<th class="text-center"><?php echo display('due_amount') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$total_sale = 0;
										$total_paid = 0;
										$total_due  = 0;
										if (@$sales_reports) {
											$sl = 0;
											foreach ($sales_reports as $sales_report) :
												$next = 0;
										?>

												<tr>
													<td align="center"><?php echo ++$sl; ?></td>
													<td align="center">
														<a href="<?php echo base_url() . 'dashboard/Cinvoice/invoice_inserted_data/' . $sales_report['invoice_id']; ?>">
															<?php echo html_escape($sales_report['invoice_no']) ?> <i class="fa fa-tasks pull-right" aria-hidden="true"></i>
														</a>
													</td>
													<td align="center"><?php echo html_escape(date('d-m-Y', strtotime($sales_report['invoice_all_data'][0]['date_time']))) ?></td>
													<td align="center">
														<?= $sales_report['invoice_all_data'][0]['customer_name'] ?>
													</td>
													<td>--</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>
												</tr>
												<?php foreach ($sales_report['invoice_all_data'] as $invoice) : $next++; ?>
													<tr>
														<td><?php echo $sl; ?>*</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>
														<td>
															<?= $invoice['product_name'] ?>
														</td>
														<td>
															<?= $invoice['quantity'] ?>
														</td>
														<td><?= $invoice['rate'] ?></td>
														<td><?php echo (($position == 0) ? $currency . " " . $invoice['discount'] : $invoice['discount'] . " " . $currency) ?>
														</td>
														<?php
														$item_tax = $this->db->select('*')->from('tax_product_service')->where('product_id', $invoice['product_id'])->where('tax_id', '52C2SKCKGQY6Q9J')->get()->row();
														?>


														<td class='hide-me'><?php if (!empty($item_tax)) {
																				echo $item_tax->tax_percentage . '%';
																			} else {
																				echo '0%';
																			} ?></td>

														<td class='hide-me'>
															<?php
															if (!empty($item_tax)) {
																echo (($position == 0) ? $currency . " " . ($item_tax->tax_percentage * ($invoice['total_price'] - ($invoice['discount'] * $invoice['quantity'])) / 100) : ($item_tax->tax_percentage * ($invoice['total_price'] - ($invoice['discount'] * $invoice['quantity'])) / 100) . " " . $currency);
															} else {
																echo (($position == 0) ? $currency . " " . 0 : 0 . " " . $currency);
															}
															?>

														</td>
														<td><?php if (!empty($invoice['total_price'])) {
																			echo (($position == 0) ?
																				$currency . " " .
																				($invoice['total_price'] - (($invoice['discount'] * $invoice['quantity']) - ($item_tax->tax_percentage * ($invoice['total_price'] - ($invoice['discount'] * $invoice['quantity'])) / 100)))
																				: ($invoice['total_price'] - (($invoice['discount'] * $invoice['quantity']) - ($item_tax->tax_percentage * ($invoice['total_price'] - ($invoice['discount'] * $invoice['quantity'])) / 100)))
																				. " " . $currency);
																		} else {echo 0;} ?></td>
																		<td>
																			--
																		</td>

																		<td>
																			--
																		</td>
													</tr>
												<?php endforeach ?>

												<?php if ($next == count($sales_report['invoice_all_data'])) : ?>
													<tr>
														<td>--</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>

														<td align="right"><b><?php echo display('grand_total') ?>:</b></td>
														<td align="center"><b><?php echo html_escape($sales_report['total_amount']); ?></td>
														<?php
															$total_sale += (float) $sales_report['total_amount'];
															$total_paid += (float)$sales_report['paid_amount'];
															$total_due += (float)$sales_report['due_amount'];
														?>
														<td align="center"><b><?php echo html_escape((float)$sales_report['paid_amount']); ?></td>
														<td align="center"><b><?php echo html_escape((float)$sales_report['due_amount']); ?></td>
													</tr>
												<?php endif ?>
										<?php
											endforeach;
										}
										?>
									</tbody>
									<tfoot>
										<tr>
										<td>--</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>
											<td align="right"><b><?php echo display('grand_total') ?>:</b></td>
											<td align="center"><b><?php echo html_escape($total_sale); ?></td>
											<td align="center"><b><?php echo html_escape($total_paid); ?></td>
											<td align="center"><b><?php echo html_escape($total_due); ?></td>
										</tr>
									</tfoot>
								</table>
							</div>

							<div class="panel-heading">
								<div class="panel-title">
									<h4><?php echo display('return_invoice') ?>:</h4>
								</div>
							</div>
							<div class="table-responsive mt_10">
								<table id="www" class="table table-bordered table-striped table-hover dataTablePagination dataTablePaginationNoSorting">
									<thead>
										<tr>
											<th class="text-center"><?php echo display('sl') ?></th>
											<th class="text-center"><?php echo display('invoice') ?></th>
											<th class="text-center"><?php echo display('date') ?></th>
											<th class="text-center"><?php echo display('customer_name') ?></th>
											<th class="text-center"><?php echo display('product_name') ?></th>
											<th class="text-center"><?php echo display('quantity') ?></th>
											<th class="text-center"><?php echo display('price') ?></th>
											<th class="text-center"><?php echo display('discount') ?></th>
											<th class="text-center"><?php echo display('vat_rate') ?></th>
											<th class="text-center"><?php echo display('vat_value') ?></th>
											<th class="text-center"><?php echo display('total_value') ?></th>
											<th class="text-center"><?php echo display('paid_amount') ?></th>
											<th class="text-center"><?php echo display('due_amount') ?></th>
										</tr>
									</thead>
									<tbody>
										<!-- <pre>
											<?php var_dump($return_reports); ?>
										</pre> -->
										<?php
										$total_return_sales = 0;
										$total_paid = 0;
										$total_due  = 0;
										$totalPrice = 0;
										if (@$return_reports) {
											$sl = 0;
											$invoice = '';
											foreach ($return_reports as $sales_report) :
												$next = 0;
												$totalPrice = $sales_report['total_return'] - ($sales_report['total_discount'] * $sales_report['return_quantity']);
												$total_return_sales += $totalPrice;
										?>
												<?php if ($invoice != $sales_report['invoice']) : $invoice = $sales_report['invoice']; ?>
													<tr>
														<td align="center"><?php echo ++$sl; ?></td>
														<td align="center">
															<a href="<?php echo base_url() . 'dashboard/Crefund/return_invoice/' . $sales_report['return_invoice_id']; ?>">
																<?php echo html_escape($sales_report['invoice']) ?> <i class="fa fa-tasks pull-right" aria-hidden="true"></i>
															</a>
														</td>
														<td align="center"><?php echo html_escape(date('d-m-Y', strtotime($sales_report['date_time']))) ?></td>
														<td>
															<?=$sales_report['customer_name']?>
														</td>
														<td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td>
													</tr>
												<?php endif ?>
												<tr>
													<td><?=$sl?>*</td>
													<td>--</td>
													<td>--</td>
													<td>--</td>
													<td>
														<?= $sales_report['product_name'] ?>
													</td>
													<td>
														<?= $sales_report['return_quantity'] ?>
													</td>
													<td><?= $sales_report['rate'] ?></td>
													<td><?php echo (($position == 0) ? $currency . " " . $sales_report['total_discount'] : $sales_report['total_discount'] . " " . $currency) ?>
													</td>
													<?php
													$item_tax = $this->db->select('*')->from('tax_product_service')->where('product_id', $sales_report['product_id'])->where('tax_id', '52C2SKCKGQY6Q9J')->get()->row();
													?>


													<td class='hide-me'><?php if (!empty($item_tax)) {
																			echo $item_tax->tax_percentage . '%';
																		} else {
																			echo '0%';
																		} ?></td>

													<td class='hide-me'>
														<?php
														if (!empty($item_tax)) {
															echo ($item_tax->tax_percentage / 100) * $sales_report['rate'];
															// echo ($item_tax->tax_percentage / 100) * ($sales_report['total_return']) . ' ww';
															// echo (($position == 0) ? $currency . " " . ($item_tax->tax_percentage * ($sales_report['total_return'] - ($sales_report['total_discount'] * $sales_report['quantity'])) / 100) : ($item_tax->tax_percentage * ($sales_report['total_return'] - ($sales_report['total_discount'] * $sales_report['quantity'])) / 100) . " " . $currency);
														} else {
															echo (($position == 0) ? $currency . " " . 0 : 0 . " " . $currency);
														}
														?>

													</td>
													<td><?php /*if (!empty($sales_report['total_return'])) {
																echo (($position == 0) ?
																	$currency . " " .
																	($sales_report['total_return'] - (($sales_report['total_discount'] * $sales_report['quantity']) - ($item_tax->tax_percentage * ($sales_report['total_return'] - ($sales_report['total_discount'] * $sales_report['quantity'])) / 100)))
																	: ($sales_report['total_return'] - (($sales_report['total_discount'] * $sales_report['quantity']) - ($item_tax->tax_percentage * ($sales_report['total_return'] - ($sales_report['total_discount'] * $sales_report['quantity'])) / 100)))
																	. " " . $currency);
															} */ ?>
														<?= $totalPrice ?>
													</td>
													<td>--</td>
													<td>--</td>
												</tr>
											<?php endforeach ?>

											<?php if ($next == count($sales_report)) : ?>
												<tr>
												<td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td>
													<td align="right"><b><?php echo display('grand_total') ?>:</b></td>
													<td align="center"><b><?php echo html_escape($sales_report['total_amount']); ?></td>
													<td align="center"><b><?php echo html_escape($sales_report['paid_amount']); ?></td>
													<td align="center"><b><?php echo html_escape($sales_report['due_amount']); ?></td>
												</tr>
											<?php endif ?>
										<?php
										}
										?>
									</tbody>
									<tfoot>
										<tr>
										<td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td>
											<td align="right"><b><?php echo display('grand_total') ?>:</b></td>
											<td align="center"><b><?php echo html_escape($total_return_sales); ?></td>
											<td align="center"><b><?php echo html_escape($total_paid); ?></td>
											<td align="center"><b><?php echo html_escape($total_due); ?></td>
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
										<td align="center"><b><?php echo html_escape($total_sale - $total_return_sales); ?></td>
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