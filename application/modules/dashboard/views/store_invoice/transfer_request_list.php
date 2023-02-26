<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Manage store Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('transfer') ?></h1>
	        <small><?php echo display('transfer_list') ?></small>
	        <ol class="breadcrumb">
	            <li><a href=""><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('transfer') ?></a></li>
	            <li class="active"><?php echo display('transfer_list') ?></li>
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
                  	<a href="<?php echo base_url('dashboard/Store_invoice/add_transfer_request')?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-plus"> </i> <?php echo display('new_request')?></a>
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
										<td class="text-center"><?php echo $item['transfer_from']; ?></td>
										<td class="text-center"><?php echo $item['transfer_to']; ?></td>
										<td class="text-center"><?php
										if($item['transfer_status']=='1'){
											echo '<span class="label label-success">'.display('approved').'</span>';
										}else if($item['transfer_status']=='2'){
											echo '<span class="label label-success">'.display('not_approved').'</span>';
										}else if($item['transfer_status']=='3'){
											echo '<span class="label label-success">'.display('collected').'</span>';
										}else if($item['transfer_status']=='4'){
											echo '<span class="label label-success">'.display('cancel').'</span>';
										}else {
											echo '<span class="label label-success">'.display('pending').'</span>';
										}
										  ?></td>
										  <td>
											<center>
												<a href="<?php echo base_url().'dashboard/Store_invoice/transfer_update/'.$item['transfer_id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

												<a href="<?php echo base_url('dashboard/Store_invoice/transfer_delete/'.$item['transfer_id'])?>" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo display('are_you_sure_want_to_delete')?>');" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
