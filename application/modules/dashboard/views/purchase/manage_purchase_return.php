<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Manage Purchase Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('manage_purchase_return') ?></h1>
            <small><?php echo display('manage_purchase_return') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('purchase') ?></a></li>
                <li class="active"><?php echo display('manage_purchase_return') ?></li>
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
        <!-- Manage Purchase report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('manage_purchase_return') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample4" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo display('sl') ?></th>
                                        <th><?php echo display('invoice_no') ?></th>
                                        <th><?php echo display('supplier_name') ?></th>
                                        <th><?php echo display('store_or_warehouse') ?></th>
                                        <th><?php echo display('return_date') ?></th>
                                        <th><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
								if ($purchase_return_list) {
									foreach ($purchase_return_list as $purchase) {
								?>
                                    <tr>
                                        <td><?php echo $purchase['sl']?></td>
                                        <td>
                                            <a
                                                href="<?php echo base_url().'dashboard/Cpurchase_return/purchase_return_details_data/'.$purchase['purchase_return_id']; ?>">
                                                <?php echo html_escape($purchase['invoice'])?><i
                                                    class="fa fa-tasks pull-right" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a
                                                href="<?php echo base_url().'dashboard/Csupplier/supplier_details/'.$purchase['supplier_id']; ?>">
                                                <?php echo html_escape($purchase['supplier_name'])?> <i
                                                    class="fa fa-user pull-right" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <?php
										 if (!empty($purchase['store_id'])) {
										 	$store = $this->db->select('*')
											 			->from('store_set')
											 			->where('store_id',$purchase['store_id'])
											 			->get()
											 			->row();
											echo html_escape($store->store_name.' ('.display('store').')') ;
										 }else{
										 	$wearhouse = $this->db->select('*')
											 			->from('wearhouse_set')
											 			->where('wearhouse_id',$purchase['wearhouse_id'])
											 			->get()
											 			->row();
											echo html_escape($wearhouse->wearhouse_name).' ('.display('wearhouse').')' ;
										 }
										?>
                                        </td>
                                        <td><?php echo date("d-m-Y", strtotime($purchase['return_date']) )?></td>
                                        <td>
                                            <center>
                                                <?php echo form_open()?>
                                                 <a href="<?php echo base_url('dashboard/Cpurchase_return/purchase_return_details_data/'.$purchase['purchase_return_id']);?>"
                                                    class="btn btn-info btn-sm" data-toggle="tooltip"
                                                    data-placement="left" title="<?php echo display('view_details') ?>"><i
                                                        class="fa fa-eye" aria-hidden="true"></i></a>
<!--                                                <a href="<?php echo base_url('dashboard/Cpurchase_return/edit_purchase_return/'.$purchase['purchase_return_id']);?>"
                                                    class="btn btn-info btn-sm" data-toggle="tooltip"
                                                    data-placement="left" title="<?php echo display('update') ?>"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <a href="<?php echo base_url('dashboard/Cpurchase_return/delete_purchase_return/'.$purchase['purchase_return_id']);?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('<?php echo display('are_you_sure_want_to_delete')?>');"
                                                    data-toggle="tooltip" data-placement="right" title=""
                                                    data-original-title="<?php echo display('delete') ?> "><i
                                                        class="fa fa-trash-o" aria-hidden="true"></i></a>-->
                                            </center>
                                            <?php echo form_close()?>
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
<!-- Manage Purchase End -->