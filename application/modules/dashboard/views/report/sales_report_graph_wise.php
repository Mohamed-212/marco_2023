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
			<h1><?php echo display('sales_report_graph_wise') ?></h1>
			<small><?php echo display('sales_report_graph_wise') ?></small>
			<ol class="breadcrumb">
				<li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
				<li><a href="#"><?php echo display('report') ?></a></li>
				<li class="active"><?php echo display('sales_report_graph_wise') ?></li>
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

						<?php echo form_open('dashboard/Admin_dashboard/retrieve_sales_report_graph_wise', array('class' => '', 'id' => 'validate', 'method' => 'get')); ?>
						<?php
						date_default_timezone_set(DEF_TIMEZONE);
						$today = date('d-m-Y'); ?>

							<div class="row">
							<div class="col-sm-6 ">
                                <div class="form-group row">
                                    <label for="currency" class="col-sm-4 col-form-label"><?php echo display('pricing') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="pri_type" id="pri_type" onchange="get_pri_type_rate()" class="form-control " required="">
                                            <?php foreach ($all_pri_type as $pri_type) : ?>
                                                <option <?php echo (!isset($_GET['pri_type']) && $pri_type['pri_type_id'] == 1) ? 'selected' : '' ?> <?php echo @$_GET['pri_type'] == $pri_type['pri_type_id'] ? 'selected' : ''?> value="<?php echo html_escape($pri_type['pri_type_id']) ?>"><?php echo display($pri_type['pri_type_name']) ?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                            <option <?php @$_GET['pri_type'] == '0' ? 'selected' : ''?> value="0">
                                                <?= display('sell_price') ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
							</div>


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
				<div class="panel panel-default">
					<div class="panel-body">
					<div>
  <canvas id="myChart"></canvas>
</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
					<div class="panel-heading">
						<div class="panel-title">
							<h4><?php echo display('sales_report_graph_wise') ?></h4>
						</div>
					</div>
					<div class="panel-body">
						<div id="printableArea" class="ml_2">
							<link href="<?php echo MOD_URL . 'dashboard/assets/css/print.css'; ?>" rel="stylesheet" type="text/css" />

							<?php if (@$repos) : ?>
								<div class="store_div">
									<?php if ($start_date) : ?>
										<p class="mr_p8e"><?php echo display('report') ?> <?php echo display('from') ?> :
											<strong><?php echo html_escape($start_date) ?></strong>
										</p>
										<p class="mr_p8e"><?php echo display('to') ?> : <strong><?php echo html_escape($end_date) ?></strong></p>
									<?php endif; ?>
									<p><?php echo display('total_invoice') ?> : <strong><?php echo count($repos) ?></strong></p>
								</div>
							<?php endif; ?>
							<div class="table-responsive mt_10">
								<table id="" class="table table-bordered table-striped table-hover dataTablePagination">
									<thead>
										<tr>
											<th class="text-center"><?php echo display('date') ?></th>
											<th class="text-center"><?php echo display('total_sales') ?></th>
											<th class="text-center"><?php echo '%' ?></th>
											<th class="text-center"><?php echo display('total_quantity') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$tqty = 0;
										// $total_price = 0;
										$total_due  = 0;
										if (@$repos) {
											$sl = 1;
											foreach ($repos as $repo) :
										?>

												<tr>
													<td align="center"><?php echo html_escape(date('M Y', strtotime($repo->created_at))) ?></td>
													<td align="center"><?php echo round($repo->t_price, 2)?></td>
													<td align="center"><?php echo round(($repo->tqty / $t_qty) * 100, 2)?>%</td>
													<td align="center"><?php echo (int)$repo->tqty?></td>
													
													<?php $tqty += (int) $repo->tqty; ?>
												</tr>
										<?php
											endforeach;
										}
										?>
									</tbody>
									<tfoot>
										<tr>
											<td align="center"><b><?php echo display('grand_total') ?>:</b></td>
											<td align="center"><b><?php echo round($t_price, 2); ?></td>
											<td align="center">
												100%
											</td>
											<td align="center"><b><?php echo html_escape($t_qty); ?></td>

										</tr>
									</tfoot>
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
<script type="text/javascript" src="<?php echo base_url('/assets/js/chart.js') ?>"></script>
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

		const ctx = document.getElementById('myChart');
		const xr = [];
		const data = [];
		<?php
			foreach ($repos as $r) {
				echo "xr.push('". date('M Y', strtotime($r->created_at)) ."');";
				echo "data.push('". $r->tqty ."');";
			}
		?>

		console.log(xr, data);

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: xr,
      datasets: [{
        label: "",
        data: data,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
	});

	function get_pri_type_rate() {
		return true;
	}
	
</script>