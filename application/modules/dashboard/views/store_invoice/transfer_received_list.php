<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Manage store Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('transfer') ?></h1>
	        <small><?php echo display('manage_transfer_request') ?></small>
	        <ol class="breadcrumb">
	            <li><a href=""><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('transfer') ?></a></li>
	            <li class="active"><?php echo display('manage_transfer_request') ?></li>
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
                <div class="column">
                  	<a href="<?php echo base_url('dashboard/Store_invoice/manage_transfer_request')?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('manage_transfer_request')?></a>
                </div>
            </div>
        </div>

		<!-- Manage store -->
		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo display('manage_store_product') ?></h4>
		                </div>
		            </div>
		            <div class="panel-body">
		                <div class="table-responsive">
		                    <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th class="text-center"><?php echo display('sl') ?></th>
										<th class="text-center"><?php echo display('transfer_id') ?></th>
										<th class="text-center"><?php echo display('date') ?></th>
										<th class="text-center"><?php echo display('transfer_from') ?></th>
										<th class="text-center"><?php echo display('transfer_to') ?></th>
										<th class="text-center"><?php echo display('status') ?></th>
										<th class="text-center"><?php echo display('action') ?></th>
									</tr>
								</thead>
								<tbody>
								<?php
								if (!empty($store_product_list)) {
									$i=1;
									foreach ($store_product_list as $item) {
								?>
									<tr>
										<td class="text-center"><?php echo $i++; ?></td>
										<td class="text-center"><?php echo $item['transfer_id']; ?></td>
										<td class="text-center"><?php echo date('Y-m-d', strtotime($item['created_at'])); ?></td>
										<td class="text-center"><?php echo $item['transfer_from_store']; ?></td>
										<td class="text-center"><?php echo $item['transfer_to_store']; ?></td>
										<td class="text-center">
											<?php echo form_open('dashboard/Store_invoice/update_received_status/'.$item['transfer_id']); ?>

												<select name="transfer_status" class="form-control">
													<option value="0" <?php echo (($item['transfer_status']=='0')?'selected':'') ?>><?php echo display('pending'); ?></option>
													<option value="1" <?php echo (($item['transfer_status']=='1')?'selected':'') ?>><?php echo display('approved'); ?></option>
													<option value="2" <?php echo (($item['transfer_status']=='2')?'selected':'') ?>><?php echo display('not_approved'); ?></option>
													<option value="3" <?php echo (($item['transfer_status']=='3')?'selected':'') ?>><?php echo display('collected'); ?></option>
													<option value="4" <?php echo (($item['transfer_status']=='4')?'selected':'') ?>><?php echo display('cancel'); ?></option>
												</select>
												<button type="submit" class="btn btn-success btn-sm" ><?php echo display('update') ?></button>
											<?php echo form_close(); ?>

										</td>
										  <td>
											<center>
												<a href="<?php echo base_url().'dashboard/Store_invoice/transfer_receive_update/'.$item['transfer_id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

												<?php if($item['transfer_status'] !='1'){ ?>
												<a href="<?php echo base_url('dashboard/Store_invoice/transfer_receive_delete/'.$item['transfer_id'])?>" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo display('are_you_sure_want_to_delete')?>');" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
												<?php } ?>
											</center>
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
<!-- Manage store End -->
<script src="<?php echo MOD_URL.'dashboard/assets/js/manage_store_product.js'; ?>"></script>
