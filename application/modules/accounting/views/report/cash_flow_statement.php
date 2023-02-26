<script src="<?php echo MOD_URL.'dashboard/assets/js/print.js'; ?>"></script>
<!-- Daterange picker -->
<link href="<?php echo MOD_URL.'accounting/assets/css/daterangepicker.css';?> ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo MOD_URL.'accounting/assets/js/moment.min.js'; ?>" type="text/javascript"></script>
<script src="<?php echo MOD_URL.'accounting/assets/js/daterangepicker.js'?>" type="text/javascript"></script>
<script src="<?php echo MOD_URL.'accounting/assets/js/daterangepicker.active.js'; ?>" type="text/javascript"></script>

<!-- Sales Report Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon"><i class="pe-7s-note2"></i></div>
	    <div class="header-title">
	        <h1><?php echo display('cash_flow_statement') ?></h1>
	        <small><?php echo display('cash_flow_statement') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('accounts') ?></a></li>
	            <li><a href="#"><?php echo display('account_reports') ?></a></li>
	            <li class="active"><?php echo display('cash_flow_statement') ?></li>
	        </ol>
	    </div>
	</section>
	<section class="content">
		<!-- General Ledger report -->
		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-body">
		            	<?php echo form_open('accounting/areports/cashFlowResports')?>
		            	<div class="form-group row" style="margin-bottom: 0px;">
	                        <div class="col-sm-3">
	                        	<input type="text" name="date_range" class="form-control reportrange1" autocomplete="off" placeholder="Select Date">
	                    	</div>
	                    	<div class="col-sm-2">
	                        	<div class="form-group">
									<button type="submit" class="btn btn-sm btn-success">Filter</button>
								</div>
	                    	</div>
	                    </div>
	                    <?php echo form_close()?>
		            </div>
		        </div>
		    </div>
		</div>
	</section>
</div>
 <!-- General Ledger Report End -->