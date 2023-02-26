<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Product js php -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/product.js.php"></script>

<!-- Product invoice js -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/product_invoice.js.php"></script>

<script src="<?php echo MOD_URL . 'dashboard/assets/js/print.js'; ?>"></script>

<style>
	@media print {
		.dt-buttons.btn-group {
			display: none !important;
		}
	}

	.dt-buttons.btn-group {
		display: none !important;
	}

	.footer tr td {
		font-weight: bold;
	}
</style>

<!-- Stock List Supplier Wise Start -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="header-icon">
			<i class="pe-7s-note2"></i>
		</div>
		<div class="header-title">
			<h1><?php echo display('sales_report_all_details') ?></h1>
			<small><?php echo display('sales_report_all_details') ?></small>
			<ol class="breadcrumb">
				<li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
				<li><a href="#"><?php echo display('stock') ?></a></li>
				<li class="active"><?php echo display('sales_report_all_details') ?></li>
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


		<div class="row">
			<div class="col-sm-12">
				<div class="column">
					<?php if ($this->permission->check_label('stock_report')->read()->access()) { ?>
						<a href="<?php echo base_url('dashboard/Creport') ?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i><?php echo display('stock_report') ?></a>
					<?php }
					if ($this->permission->check_label('stock_report_product_wise')->read()->access()) { ?>
						<a href="<?php echo base_url('dashboard/Creport/stock_report_product_wise') ?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify">
							</i><?php echo display('stock_report_product_wise') ?></a>
					<?php } ?>
				</div>
			</div>
		</div>

		<?php
		date_default_timezone_set(DEF_TIMEZONE);
		$today = date('d-m-Y');
		$this_month = date('01-m-Y');
		?>

		<style>
			.quantity_rows {
				margin: 10px 0;
				padding: 5px;
				border: 1px solid #727272;
			}
		</style>


		<!-- Stock report supplier wise -->
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-body">

						<?php echo form_open('dashboard/Admin_dashboard/sales_report_all_details', array(
							'class' => 'filters_form', 'id' => 'validate', 'method' => 'GET'
						)); ?>


						<div class="row">
							<!-- <div class="col-md-4">
								<div class="form-group row" style="width: 100%;">
									<label for="store_id" class="col-sm-3 col-form-label"><?php echo display('store') ?>:</label>
									<div class="col-sm-9">
										<select class="form-control" name="store_id" id="store_id">
											<option value=""></option>
											<?php foreach ($store_list as $single_store) :
												if (1 == $single_store['default_status']) {
											?>

													<option selected value="<?php echo html_escape($single_store['store_id']) ?>">
														<?php echo html_escape($single_store['store_name']) ?>
													</option>
												<?php } else { ?>
													<option value="<?php echo html_escape($single_store['store_id']) ?>">
														<?php echo html_escape($single_store['store_name']) ?>
													</option>
											<?php }
											endforeach; ?>
										</select>
									</div>
								</div>
							</div> -->

							<div class="col-md-6">
								<div class="form-group row">
									<!-- <label for="product_id" class="col-sm-3 col-form-label"><?php echo display('product') ?>:</label>
									<div class="col-sm-9">
										<select class="form-control select3" name="product_id" id="product_id">
											<option value=""></option>
											<?php foreach ($product_list as $product_item) { ?>
												<option value="<?php echo $product_item['product_id'] ?>" <?php echo (($product_item['product_id'] == @$_GET['product_id']) ? 'selected' : '') ?>>
													<?php echo html_escape($product_item['product_name']) ?></option>
											<?php } ?>
										</select>
									</div> -->
									<label class="control-label col-sm-3"><?php echo display('product_name') ?>:</label>
									<!-- <input type="text" class="form-control" name="product_name" value=""
                                           placeholder='<?php echo display('product_name') ?>'> -->
									<div class="col-sm-9">
										<input type="text" name="product_name" class="form-control productSelection" placeholder='<?php echo display('product_name') ?>' id="product_name_1" value="<?= $product_name ?>">

										<!-- <input type="hidden" class="autocomplete_hidden_value product_id_1" name="product_id" /> -->
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group row">
									<label for="category_id" class="col-sm-3 col-form-label"><?php echo display('category') ?>:</label>
									<div class="col-sm-9">
										<select class="form-control select3" name="category_id[]" id="category_id" multiple data-multiple="true">
											<option value=""></option>
											<?php foreach ($category_list as $category_item) { ?>
												<option value="<?php echo $category_item['category_id'] ?>" <?= in_array($category_item['category_id'], $_GET['category_id'] ?? []) ? 'selected' : '' ?>>
													<?php echo html_escape($category_item['category_name']) ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label for="filter_1_id" class="col-sm-3 col-form-label">GENDER:</label>
									<div class="col-sm-9">
										<select class="form-control select3" name="filter_1_id[]" id="filter_1_id" multiple data-multiple="true">
											<option value=""></option>
											<?php foreach ($filter_1_list as $filter_1_item) { ?>
												<option value="<?php echo $filter_1_item['item_id'] ?>" <?= in_array($filter_1_item['item_id'], $_GET['filter_1_id'] ?? []) ? 'selected' : '' ?>>
													<?php echo html_escape($filter_1_item['item_name']) ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group row">
									<label for="filter_2_id" class="col-sm-3 col-form-label">MATERIAL:</label>
									<div class="col-sm-9">
										<select class="form-control select3" name="filter_2_id[]" id="filter_2_id" multiple data-multiple="true">
											<option value=""></option>
											<?php foreach ($filter_2_list as $filter_2_item) { ?>
												<option value="<?php echo $filter_2_item['item_id'] ?>" <?= in_array($filter_2_item['item_id'], $_GET['filter_2_id'] ?? []) ? 'selected' : '' ?>>
													<?php echo html_escape($filter_2_item['item_name']) ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label for="currency" class="col-sm-4 col-form-label"><?php echo display('pricing') ?></label>
									<div class="col-sm-8">
										<select name="pri_type" id="pri_type" class="form-control select3">
											<option value=""></option>
											<?php foreach ($all_pri_type as $pri_type) : ?>
												<option value="<?php echo html_escape($pri_type['pri_type_id']) ?>" <?= $pri_type['pri_type_id'] == $_GET['pri_type'] ? 'selected' : '' ?>><?php echo display($pri_type['pri_type_name']) ?></option>
											<?php
											endforeach;
											?>
											<option value="0">
												<?= display('sell_price') ?>
											</option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="row border quantity_rows">
							<div class="col-sm-6">
								<div class="form-group row">
									<label for="from_date" class="col-sm-4 col-form-label"><?php echo display('receive_quantity') ?>:</label>
									<div class="col-sm-4">
										<input type="text" name="purchase_from" class="form-control" id="purchase_from" value="<?php echo $this->input->get('purchase_from', TRUE); ?>" placeholder="<?php echo display('from') ?>">
									</div>
									<div class="col-sm-4">
										<input type="text" name="purchase_to" class="form-control" id="purchase_to" value="<?php echo $this->input->get('purchase_to', TRUE); ?>" placeholder="<?php echo display('to') ?>">
									</div>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group row">
									<label for="from_date" class="col-sm-4 col-form-label"><?php echo display('transfer_quantity') ?>:</label>
									<div class="col-sm-4">
										<input type="text" name="sales_from" class="form-control" id="sales_from" value="<?php echo $this->input->get('sales_from', TRUE); ?>" placeholder="<?php echo display('from') ?>">
									</div>
									<div class="col-sm-4">
										<input type="text" name="sales_to" class="form-control" id="sales_to" value="<?php echo $this->input->get('sales_to', TRUE); ?>" placeholder="<?php echo display('to') ?>">
									</div>
								</div>
							</div>

						</div>
						<div class="row quantity_rows">
							<dvi class="col-sm-12">
								<div class="form-group row">
									<label for="from_date" class="col-sm-2 col-form-label" style=""><?php echo display('balance') ?>:</label>
									<div class="col-sm-4">
										<input type="text" name="balance_from" class="form-control" id="balance_from" value="<?php echo $this->input->get('balance_from', TRUE); ?>" placeholder="<?php echo display('from') ?>">
									</div>
									<div class="col-sm-4">
										<input type="text" name="balance_to" class="form-control" id="balance_to" value="<?php echo $this->input->get('balance_to', TRUE); ?>" placeholder="<?php echo display('to') ?>">
									</div>
								</div>
							</dvi>
						</div>

						<div class="row border quantity_rows mt-3">
							<div class="col-sm-6">
								<div class="form-group row">
									<label for="from_date" class="col-sm-3 col-form-label"><?php echo display('cost_price') ?>:</label>
									<div class="col-sm-4">
										<input type="text" name="supplier_from" class="form-control" id="supplier_from" value="<?php echo $this->input->get('supplier_from', TRUE); ?>" placeholder="<?php echo display('from') ?>">
									</div>
									<div class="col-sm-4">
										<input type="text" name="supplier_to" class="form-control" id="supplier_to" value="<?php echo $this->input->get('supplier_to', TRUE); ?>" placeholder="<?php echo display('to') ?>">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group row">
									<label for="from_date" class="col-sm-3 col-form-label"><?php echo display('total_cost') ?>:</label>
									<div class="col-sm-4">
										<input type="text" name="total_supplier_from" class="form-control" id="total_supplier_from" value="<?php echo $this->input->get('total_supplier_from', TRUE); ?>" placeholder="<?php echo display('from') ?>">
									</div>
									<div class="col-sm-4">
										<input type="text" name="total_supplier_to" class="form-control" id="total_supplier_to" value="<?php echo $this->input->get('total_supplier_to', TRUE); ?>" placeholder="<?php echo display('to') ?>">
									</div>
								</div>
							</div>
						</div>

						<div class="row border quantity_rows mt-3">
							<div class="col-sm-6">
								<div class="form-group row">
									<label for="from_date" class="col-sm-3 col-form-label"><?php echo display('price') ?>:</label>
									<div class="col-sm-4">
										<input type="text" name="sell_from" class="form-control" id="sell_from" value="<?php echo $this->input->get('sell_from', TRUE); ?>" placeholder="<?php echo display('from') ?>">
									</div>
									<div class="col-sm-4">
										<input type="text" name="sell_to" class="form-control" id="sell_to" value="<?php echo $this->input->get('sell_to', TRUE); ?>" placeholder="<?php echo display('to') ?>">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group row">
									<label for="from_date" class="col-sm-3 col-form-label"><?php echo display('total_value') ?>:</label>
									<div class="col-sm-4">
										<input type="text" name="total_sell_from" class="form-control" id="total_sell_from" value="<?php echo $this->input->get('total_sell_from', TRUE); ?>" placeholder="<?php echo display('from') ?>">
									</div>
									<div class="col-sm-4">
										<input type="text" name="total_sell_to" class="form-control" id="total_sell_to" value="<?php echo $this->input->get('total_sell_to', TRUE); ?>" placeholder="<?php echo display('to') ?>">
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="form-group row">
									<label for="from_date" class="col-sm-3 col-form-label"><?php echo display('start_date') ?>:</label>
									<div class="col-sm-9">
										<input type="text" name="from_date" class="form-control datepicker2" id="from_date" value="<?php echo $this->input->get('from_date', TRUE); ?>" placeholder="<?php echo display('start_date') ?>">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group row">
									<label for="to_date" class="col-sm-3 col-form-label"><?php echo display('end_date') ?>:</label>
									<div class="col-sm-9">
										<input type="text" name="to_date" class="form-control datepicker2" id="to_date" value="<?= empty($this->input->get('to_date', TRUE)) ? date('d-m-Y') : $this->input->get('to_date', TRUE) ?>" placeholder="<?php echo display('end_date') ?>">
									</div>
								</div>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-sm-12 text-center">
								<button type="submit" id="submit" class="btn btn-primary"><?php echo display('search') ?></button>
								<!-- <a class="btn btn-warning" href="#" onclick="printDiv('printableArea')"><?php echo display('print') ?></a> -->
								<button type="button" id="reset" class="btn btn-danger"><?php echo display('reset') ?></button>
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
							<h4><?php echo display('sales_report_all_details') ?></h4>
						</div>
					</div>
					<div class="panel-body">
						<div id="printableArea" class="ml_2">
							<div class="table-responsive mt_10">
								<table id="" class="table table-bordered table-striped table-hover dataTableNoPagination">
									<thead>
										<tr>
											<th class="text-center"><?php echo display('sl') ?></th>
											<th class="text-center"><?php echo display('product_name') ?></th>
											<th class="text-center"><?php echo display('category_name') ?></th>
											<!-- <th class="text-center"><?php echo display('product_type') ?></th> -->
											<th class="text-center">GENDER</th>
											<th class="text-center">MATERIAL</th>
											<th class="text-center"><?php echo display('receive_quantity') ?></th>
											<th class="text-center"><?php echo display('transfer_quantity') ?></th>
											<th class="text-center"><?php echo display('balance') ?></th>
											<th class="text-center"><?php echo display('cost_price') ?></th>
											<th class="text-center"><?php echo display('total_cost') ?></th>
											<th class="text-center"><?php echo display('price') ?></th>
											<th class="text-center"><?php echo display('total_price') ?></th>
										</tr>
									</thead>
									<tbody>

										<?php
										// $total_sales_quantity = 0;
										// $total_purchase_quantity = 0;
										// $total_balance = 0;
										// $total_supplier_price = 0;
										// $total_sell_price = 0;
										$sl = $page ?? 0;
										foreach ($stock_reports as $repo) :
											$sales_quantity = (int)$repo['totalSalesQnty'];
											$purchase_quantity = (int)$repo['totalPurchaseQnty'];
											$balance = $purchase_quantity - $sales_quantity;
											$supplier_price_total = abs(round((float)$repo['supplier_price'] * $balance, 2));
											$sell_price_total = abs(round((float)$repo['selected_price'] * $balance, 2));

											// $total_sales_quantity += $sales_quantity;
											// $total_purchase_quantity += $purchase_quantity;
											// $total_balance += $balance;
											// $total_supplier_price += (float)$repo['supplier_price'];
											// $total_sell_price += (float)$repo['selected_price'];
										?>
											<tr>
												<td>
													<?= ++$sl ?>
												</td>
												<td>
													<a href="<?= base_url() ?>/dashboard/Cproduct/product_details/<?= $repo['product_id'] ?>">
														<?= $repo['product_name'] ?>
													</a>
												</td>
												<td>
													<?= $repo['category_name'] ?>
												</td>
												<!-- <td>
													<?= display($repo['assembly'] ? 'assemply' : 'normal') ?>
												</td> -->
												<td>
													<?= $repo['filter_1'] ?>
												</td>
												<td>
													<?= $repo['filter_2'] ?>
												</td>
												<td>
													<?= number_format($purchase_quantity) ?>
												</td>
												<td>
													<?= number_format($sales_quantity) ?>
												</td>
												<td>
													<?= number_format($balance) ?>
												</td>
												<td>
													<?= number_format($repo['supplier_price'], 2) ?>
												</td>
												<td>
													<?= number_format($supplier_price_total, 2) ?>
												</td>
												<td>
													<?= number_format($repo['selected_price'], 2) ?>
												</td>
												<td>
													<?= number_format($sell_price_total, 2) ?>
												</td>
											</tr>
										<?php endforeach ?>
										<tr class="footer">
											<th>
												<?=(int)$footer['count']?>
											</th>
											<th align="center"><b><?= display('grand_total') ?></b></th>
											<th>--</th>
											<th>--</th>
											<th>--</th>
											<th><?= number_format($footer['totalPurchase']) ?></th>
											<th><?= number_format($footer['totalSales']) ?></th>
											<th><?= number_format($footer['totalBalance']) ?></th>
											<th><?= number_format($footer['totalSupplierPrice'], 2, '.', ',') ?></th>
											<th>
												<?= number_format($footer['totalSupplierPrice'] * $footer['totalBalance'], 2) ?>
											</th>
											<th>
												<?= number_format($footer['totalSellPrice'], 2) ?>
											</th>
											<th>
												<?= number_format($footer['totalSellPrice'] * $footer['totalBalance'], 2) ?>
											</th>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="text-right">
								<?php echo htmlspecialchars_decode(@$links); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<!-- Stock List Supplier Wise End -->
<script src="<?php echo MOD_URL . 'dashboard/assets/js/stock_report_variant_wise.js'; ?>"></script>
<script>
	$(document).ready(function() {
		$(".datepicker2").datepicker({
			dateFormat: "dd-mm-yy"
		});

		$('#reset').click(function() {
			$('.filters_form input[type="text"]').each(function(nx, el) {
				$(el).val('');
			});
			$('.filters_form select').each(function(nx, el) {
				$(el).val('').trigger('change');
			});
		});

		$('.select3').select2({
			placeholder: 'select one',
			allowClear: true
		});
	});
</script>