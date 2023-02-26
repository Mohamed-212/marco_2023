<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Product details page start -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="header-icon">
			<i class="pe-7s-note2"></i>
		</div>
		<div class="header-title">
			<h1><?php echo display('product_report') ?></h1>
			<small><?php echo display('product_sales_and_purchase_report') ?></small>
			<ol class="breadcrumb">
				<li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
				<li><a href="#"><?php echo display('report') ?></a></li>
				<li class="active"><?php echo display('product_report') ?></li>
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
				<div class="panel panel-default">
					<div class="panel-body">
						<?php echo form_open("dashboard/Cproduct/product_details_single"); ?>
						<div class="form-group row">
							<label for="product_id" class="col-sm-2"><?php echo display('select_product') ?>:</label>
							<div class="col-sm-6">
								<select class="form-control" name="product_id" id="product_id">
									<?php foreach ($product_list as $product) { ?>
										<option value=""></option>
										<option value="<?php echo html_escape($product['product_id']) ?>">
											<?php echo html_escape($product['product_name']) ?>-(<?php echo html_escape($product['product_model']) ?>)
										</option>
									<?php } ?>
								</select>
							</div>
							<div class="col-sm-2">
								<button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>

		<!-- Product details -->
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
					<div class="panel-heading">
						<div class="panel-title">
							<h4><?php echo display('product_details') ?> </h4>
						</div>
					</div>
					<div class="panel-body">
						<h2><span class="fw_normal"><?php echo display('product_name') ?>: </span><span class="color_005580">{product_name}</span></h2>
						<h4><span class="fw_normal"><?php echo display('item_code') ?>:</span> <span class="color_005580">{product_model}</span></h4>
						<table class="table">
							<tr>
								<th>
									<span class="fw_normal"><?php echo display('sell_price') ?>:</span> <span class="color_005580">
										<?php echo (($position == 0) ? "$currency {price}" : "{price} $currency") ?></span>
								</th>
								<?php foreach ($pri_types as $pri) : ?>
									<th>
										<span class="fw_normal"><?php echo $pri->pri_type_name ?>:</span> <span class="color_005580">
											<?php echo (($position == 0) ? "$currency {$pri->product_price}" : "{$pri->product_price} $currency") ?></span>
									</th>
								<?php endforeach ?>
							</tr>
						</table>

						<table class="table">
							<tr>
								<th><?php echo display('open_quantity') ?> = <span class="color_red">{openQuantity}</span></th>
								<th><?php echo display('total_purchase') ?> = <span class="color_red">{total_purchase}</span></th>
								<th><?php echo display('total_sales') ?> = <span class="color_red"><?= $total_sales + $total_return ?></span></th>
								<th><?php echo display('total_return') ?> = <span class="color_red">{total_return}</span></th>
								<th><?php echo display('stock') ?> = <span class="color_red">{stock}</span></th>
							</tr>
						</table>
						<!-- <p class="text-center"><a class="btn btn-success" href="<?php echo base_url('dashboard/Creport/stock_report_store_wise') ?>"><?php echo display('stock_report') . ' ' . display('details'); ?></a></p> -->
					</div>
				</div>
			</div>
		</div>

		<!-- Total Purchase report -->
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
					<div class="panel-heading">
						<div class="panel-title">
							<h4><?php echo display('purchase_report') ?> </h4>
						</div>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table id="dataTableExample2" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th><?php echo display('date') ?></th>
										<th><?php echo display('invoice_no') ?></th>
										<th><?php echo display('supplier_name') ?></th>
										<th><?php echo display('variant') ?></th>
										<th><?php echo display('quantity') ?></th>
										<th><?php echo display('rate') ?></th>
										<th class="text-right"><?php echo display('total_ammount') ?></th>
									</tr>
								</thead>
								<tbody>
									<?php $t_pr = 0;
									if ($purchaseData) { 
										$sunGlasses = $this->db->select('category_id')->from('product_category')->where('category_name', 'SUNGLASSES')->get()->row();
										?>

										<?php 
										
											
										foreach ($purchaseData as $pur) { 
											$pur_rate = $pur['rate_after_exp'];
											if ($pur['category_id'] == $sunGlasses->category_id) {
												$pur_rate = $pur['rate_after_sunvat'];
											}
											$t_pr += (float) ($pur_rate * $pur['quantity']);
											// var_dump($t_pr);
											?>
											<tr>
												<td><?=date('d-m-Y', strtotime($pur['created_at']))?></td>
												<td>
													<a href="<?php echo base_url() . 'dashboard/Cpurchase/purchase_inserted_data/' . $pur['purchase_id']; ?>"><?=$pur['invoice']?> <i class="fa fa-tasks pull-right" aria-hidden="true"></i>
													</a>
												</td>
												<td>
													<a href="<?php echo base_url() . 'dashboard/Csupplier/supplier_details/' . $pur['supplier_id']; ?>"><?=$pur['supplier_name']?> <i class="fa fa-user pull-right" aria-hidden="true"></i></a>
												</td>
												<td><?=$pur['variant_name']?></td>
												<td><?=$pur['quantity']?></td>
												<td><?php echo (($position == 0) ? "$currency " . $pur_rate : $pur_rate ." $currency") ?></td>
												<td class="text-right"> <?php echo (($position == 0) ? "$currency " . ($pur_rate * $pur['quantity']) : ($pur_rate * $pur['quantity']) . " $currency") ?></td>
											</tr>
										<?php } ?>
									<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="4" class="text-right"><b><?php echo display('grand_total') ?></b></td>
										<td>{total_purchase}</td>
										<td></td>
										<td class="text-right"><b> <?php echo (($position == 0) ? "$currency " . $t_pr : $t_pr . " $currency") ?></b></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--Total sales report -->
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
					<div class="panel-heading">
						<div class="panel-title">
							<h4><?php echo display('sales_report') ?> </h4>
						</div>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover dataTablePagination">
								<thead>
									<tr>
										<th><?php echo display('date') ?></th>
										<th><?php echo display('invoice_no') ?></th>
										<th><?php echo display('customer_name') ?></th>
										<th><?php echo display('variant') ?></th>
										<th><?php echo display('quantity') ?></th>
										<th><?php echo display('rate') ?></th>
										<th><?php echo display('total_discount') ?></th>
										<th class="text-right"><?php echo display('total_ammount') ?></th>
									</tr>
								</thead>
								<tbody>
									<?php if ($salesData) { ?>
										{salesData}
										<tr>
											<td>{final_date}</td>
											<td>
												<a href="<?php echo base_url() . 'dashboard/Cinvoice/invoice_inserted_data/{invoice_id}'; ?>">
													{invoice} <i class="fa fa-tasks pull-right" aria-hidden="true"></i>
												</a>
											</td>
											<td>
												<a href="<?php echo base_url() . 'dashboard/Ccustomer/customerledger/{customer_id}'; ?>">{customer_name} <i class="fa fa-user pull-right" aria-hidden="true"></i></a>
											</td>
											<td>{variant_name}</td>
											<td>{quantity}</td>
											<td> <?php echo (($position == 0) ? "$currency {rate}" : "{rate} $currency") ?></td>
											<td> <?php echo (($position == 0) ? "$currency {item_discount}" : "{item_discount} $currency") ?></td>
											<td class="text-right"> <?php echo (($position == 0) ? "$currency {total_price_after_discount}" : "{total_price_after_discount} $currency") ?></td>
										</tr>
										{/salesData}
									<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="4" class="text-right"><b><?php echo display('grand_total') ?></b></td>
										<td>
											<?php
											$totalSales = 0;
											foreach ($salesData as $sale) {
												$totalSales += $sale['quantity'];
											}

											echo $totalSales;
											?>
										</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td class="text-right"><b> <?php echo (($position == 0) ? "$currency {salesTotalAmount}" : "{salesTotalAmount} $currency") ?></b></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--Total return report -->
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
					<div class="panel-heading">
						<div class="panel-title">
							<h4><?php echo display('return_report') ?> </h4>
						</div>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table id="dataTableExample44" class="table table-bordered table-striped table-hover dataTablePagination">
								<thead>
									<tr>
										<th><?php echo display('date') ?></th>
										<th><?php echo display('invoice_no') ?></th>
										<th><?php echo display('customer_name') ?></th>
										<th><?php echo display('variant') ?></th>
										<th><?php echo display('quantity') ?></th>
										<th><?php echo display('rate') ?></th>
										<th><?php echo display('discount') ?></th>
										<th class="text-right"><?php echo display('total_ammount') ?></th>
									</tr>
								</thead>
								<tbody>
									<?php if ($returnData) { ?>
										{returnData}
										<tr>
											<td>{final_date}</td>
											<td>
												<a href="<?php echo base_url() . 'dashboard/Crefund/return_invoice/{return_invoice_id}'; ?>">
													{invoice} <i class="fa fa-tasks pull-right" aria-hidden="true"></i>
												</a>
											</td>
											<td>
												<a href="<?php echo base_url() . 'dashboard/Ccustomer/customerledger/{customer_id}'; ?>">{customer_name} <i class="fa fa-user pull-right" aria-hidden="true"></i></a>
											</td>
											<td>{variant_name}</td>
											<td>{return_quantity}</td>
											<td> <?php echo (($position == 0) ? "$currency {rate}" : "{rate} $currency") ?></td>
											<td> <?php echo (($position == 0) ? "$currency {total_discount}" : "{total_discount} $currency") ?></td>
											<td class="text-right"> <?php echo (($position == 0) ? "$currency {total_return}" : "{total_return} $currency") ?></td>
										</tr>
										{/returnData}
									<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="4" class="text-right"><b><?php echo display('grand_total') ?></b></td>
										<td>{total_return}</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td class="text-right"><b> <?php

																	$totalReturnAmount = 0;
																	foreach ($returnData as $return) {
																		$totalReturnAmount += $return['total_return'];
																	}

																	echo (($position == 0) ? "$currency {$totalReturnAmount}" : "{$totalReturnAmount} $currency") ?></b></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Stock Adjustment table -->
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
					<div class="panel-heading">
						<div class="panel-title">
							<h4><?php echo display('stock_adjustment_details') ?> </h4>
						</div>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table id="dataTableExample3" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th><?php echo display('adjustment_id') ?></th>
										<th><?php echo display('product') ?></th>
										<th><?php echo display('variant') ?></th>
										<!-- <th><?php echo display('color_variant') ?></th> -->
										<th><?php echo display('previous_quantity') ?></th>
										<th><?php echo display('adjustment_quantity') ?></th>
										<th><?php echo display('adjustment_type') ?></th>
									</tr>
								</thead>
								<tbody>
									<?php
									if (!empty($adjustments)) {
										$total_qty = 0;
										$total_prev = 0;
										foreach ($adjustments as $details) {
											$total_qty += (int)$details['adjustment_quantity'];
											$total_prev += (int)$details['previous_quantity'];
									?>
											<tr>
												<td><?php echo html_escape($details['adjustment_id']); ?></td>
												<td><?php echo html_escape($details['product_name']); ?></td>
												<td><?php echo html_escape(@$details['variant_name']); ?></td>
												<!-- <td><?php echo html_escape(@$details['color_variant']); ?></td> -->
												<td><?php echo html_escape(@$details['previous_quantity']); ?></td>
												<td><?php echo html_escape(@$details['adjustment_quantity']); ?></td>
												<td><?php echo html_escape(ucfirst($details['adjustment_type'])); ?></td>
											</tr>
									<?php }
									} ?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="3"><?= display('total') ?></th>
										<th>
											<?= $total_prev ?>
										</th>
										<th><?= $total_qty ?></th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

	</section>
</div>
<!-- Product details page end