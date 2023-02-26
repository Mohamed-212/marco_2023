<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Manage order Start -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="header-icon">
			<i class="pe-7s-note2"></i>
		</div>
		<div class="header-title">
			<h1><?php echo display('manage_order') ?></h1>
			<small><?php echo display('order_csv_export') ?></small>
			<ol class="breadcrumb">
				<li>
					<a href="#">
						<i class="pe-7s-home"></i> 
						<?php echo display('home') ?>
					</a>
				</li>
				<li>
					<a href="#">
						<?php echo display('order') ?>
					</a>
				</li>
				<li class="active">
					<?php echo display('order_csv_export') ?>
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
		<?php 
			date_default_timezone_set(DEF_TIMEZONE);
            $date = date('Y-m-d');
        ?>

	<!-- Manage order report -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-bd">
				<div class="panel-heading">
					<div class="panel-title">
						<h4><?php echo display('order_csv_export') ?></h4>
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-4 col-sm-offset-1">
							<?php echo form_open('dashboard/Cinvoice/order_export_csv'); ?>
							<div class="form-group row">
                                <label for="order_date" class="col-sm-4 col-form-label"><?php echo display('date') ?> <i class="text-danger">*</i></label>
                                <div class="col-sm-8">
                                    
                                    <input class="form-control datepicker" type="text" size="50" name="order_date"
                                           id="order_date" required value="<?php echo html_escape($date); ?>"/>
                                </div>
                            </div>
                            <div class="form-group row">
	                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
	                            <div class="col-sm-8">
	                                <input type="submit" class="btn btn-success btn-large" value="<?php echo display('export_csv') ?>" />
	                            </div>
	                        </div>
	                        <?php echo form_close(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</div>
<!-- Manage order End -->