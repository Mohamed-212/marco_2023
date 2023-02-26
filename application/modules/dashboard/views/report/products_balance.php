<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Product invoice js -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css" />

<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/product_balance_invoice.js.php"></script>

<div class="content-wrapper">
	<section class="content-header">
		<div class="header-icon">
			<i class="pe-7s-note2"></i>
		</div>
		<div class="header-title">
			<h1><?php echo display('products_balance') ?></h1>
			<small><?php echo display('products_balance') ?></small>
			<ol class="breadcrumb">
				<li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
				<li><a href="#"><?php echo display('report') ?></a></li>
				<li class="active"><?php echo display('products_balance') ?></li>
			</ol>
		</div>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
					<div class="panel-body">
						<?php echo form_open("dashboard/Creport/products_balance", array('class' => 'form')); ?>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group row">
									<label for="store_name" class="col-sm-4 col-form-label"><?php echo display('store') ?>

									</label>
									<div class="col-sm-8">
										<select class="form-control" id="store_id" name="store_id"="">
											<option value="">select <?php echo display('store') ?></option>
											<?php foreach ($store_list as $st) : ?>
												<option value="<?= $st['store_id'] ?>" <?= $st['store_id'] == $store_id ? 'selected' : '' ?>><?= $st['store_name'] ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="form-group row">
									<label for="store_name" class="col-sm-4 col-form-label"><?php echo display('product_name') ?>

									</label>
									<div class="col-sm-8">
										<input type="text" name="product_name" onkeyup="invoice_productList(1);" class="form-control productSelection" placeholder='<?php echo display('product_name') ?>' value="<?= $product_name ?>" id="product_name_1">

										<input type="hidden" class="autocomplete_hidden_value product_id_1" name="product_id" value="<?= $product_id ?>" />

										<input type="hidden" class="sl" value="1">
										<input type="hidden" name="assembly" id="assembly1" value="">
										<input type="hidden" name="colorv" id="color1" value="">
										<input type="hidden" name="sizev" id="size1" value="">
										<input type="hidden" class="baseUrl" value="<?php echo base_url(); ?>" />
										<input type="hidden" hidden name="category_id" id="category_id_1" value="" />
										<input type="hidden" hidden name="product_model" id="product_model_1" value="" />

										<!-- <div id="viewassembly1" class="text-center hidden">
											<a style="color: blue" href="" data-toggle="modal" data-target="#viewprom" onclick="viewpro(1)">view products </a>
										</div> -->
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="form-group row">
									<label for="date" class="col-sm-4 col-form-label"><?php echo display('start_date') ?> </label>
									<div class="col-sm-8">

										<input class="form-control datepicker2" type="text" size="50" name="date_from" id="date_from" value="<?php echo html_escape($date_from); ?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group row">
									<label for="date" class="col-sm-4 col-form-label"><?php echo display('end_date') ?> </label>
									<div class="col-sm-8">
										<?php
										date_default_timezone_set(DEF_TIMEZONE);
										$date_to = !empty($date_to) ? $date_to : date('d-m-Y');
										?>
										<input class="form-control datepicker2" type="text" size="50" name="date_to" id="date_to" value="<?php echo html_escape($date_to); ?>" />
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-sm-4"></div>
									<div class="col-sm-6">
										<input type="submit" class="btn btn-success" value="<?= display('search') ?>" />
									</div>
								</div>
							</div>
						</div>

						<?php echo form_close(); ?>
					</div>

					<div class="panel-heading">
						<div class="panel-title">
							<h4><?php echo display('products_balance') ?></h4>
						</div>
					</div>
					<div class="panel-body">
						<div class="table-responsive mt_10">
							<style>
								thead tr {
									text-align: center;
								}
								li.paginate_button {
									padding: 0 !important;
								}
							</style>
							<table class="table table-bordered table-striped table-hover stripe dataTablePagination" id="example">

								<thead>
									<tr>
										<th class="text-center"><?php echo display('sl') ?></th>
										<th class="text-center"><?php echo display('product_name') ?></th>
										<?php if ($store_id) : ?>
											<th>
												<?php
												foreach ($store_list as $st) {
													if ($st['store_id'] == $store_id) {
														echo $st['store_name'];
														break;
													}
												}
												?>
											</th>
										<?php else : ?>
											<?php foreach ($store_list as $store) : ?>
												<th>
													<?= $store['store_name'] ?>
												</th>
											<?php endforeach ?>
										<?php endif ?>
										<th>
											<?= display('total') ?>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if ($products_balance) {
									?>
										<?php foreach ($products_balance as $d) : $d = (object) $d; ?>
											<tr class="text-center">
												<td><?= $d->sl ?></td>
												<td>
													<a href="<?php echo base_url() . 'dashboard/Cproduct/product_details/' . $d->product_id; ?>">
														<?= $d->product_name ?>
													</a>
												</td>

												<?php
												if ($store_id) : ?>
													<td>
														<?php $store_quantity = 0;
														foreach ($d->stores as $key => $val) {
															if ($key == $store_id) {
																$store_quantity = $val;
																break;
															}
														}
														echo $store_quantity;
														?>
													</td>
												<?php else : ?>
													<?php foreach ($store_list as $st) : ?>
														<td>
															<?php $store_quantity = 0;
															foreach ($d->stores as $key => $val) {
																if ($key == $st['store_id']) {
																	$store_quantity = $val;
																	break;
																}
															}
															echo $store_quantity;
															?>
														</td>
													<?php endforeach ?>
												<?php endif ?>
												<td>
													<?php
													$total = 0;
													foreach ($d->stores as $key => $val) {
														$total += (int)$val;
													}
													echo $total;
													?>
												</td>
											</tr>
										<?php endforeach ?>

									<?php
									}
									?>
								</tbody>
							</table>
						</div>

						<div class="text-center">
							<?php if (isset($link)) {
								echo $link;
							} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<!-- Stock List End -->
<script src="<?php echo MOD_URL . 'dashboard/assets/js/add_invoice_form_2.js'; ?>"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>

<script>
	$(document).ready(function() {
		$(".datepicker2").datepicker({
			dateFormat: "dd-mm-yy"
		});

		$.fn.dataTable.ext.errMode = 'none';
		$('#example').DataTable();
	});
</script>