<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Manage Purchase Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('manage_purchase_order_receive') ?></h1>
            <small><?php echo display('manage_purchase_order_receive_list') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('purchase') ?></a></li>
                <li><a href="#"><?php echo display('purchase_order') ?></a></li>
                <li class="active"><?php echo display('receive_item') ?></li>
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
                    <?php if ($this->permission->check_label('purchase_order')->read()->access()) { ?>
                        <a href="<?php echo base_url('dashboard/Cpurchase/purchase_order') ?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('purchase_order') ?></a>  
                    <?php } ?>
                </div>
            </div>
        </div>


        <!-- Manage Purchase report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('manage_purchase_order_receive_list') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample4" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo display('sl') ?></th>
                                        <th><?php echo display('purchase_order') ?></th>
                                        <th><?php echo display('date') ?></th>
                                        <th><?php echo display('store') ?></th>
                                        <th><?php echo display('supplier') ?></th>
                                        <th><?php echo display('total_amount') ?></th>
                                        <th><?php echo display('status') ?></th>
                                        <th><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($order_list)) {
                                        $i = 1;
                                        foreach ($order_list as $purchase) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url().'dashboard/Cpurchase/manage_purorder/view/'.$purchase['pur_order_id']; ?>">
                                                        <?php echo html_escape($purchase['pur_order_no']) ?><i class="fa fa-tasks pull-right" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                <td><?php echo date('d-m-Y', strtotime($purchase['purchase_date'])) ?></td>
                                                <td>
                                                    <?php echo html_escape($purchase['store_name']) ?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo base_url() . 'dashboard/Csupplier/supplier_details/' . $purchase['supplier_id']; ?>">
                                                        <?php echo html_escape($purchase['supplier_name']) ?> <i class="fa fa-user pull-right" aria-hidden="true"></i>
                                                    </a>
                                                </td>

                                                <td class="text-right"><?php echo html_escape(($position == 0) ? $currency . ' ' . $purchase['grand_total_amount'] : $purchase['grand_total_amount'] . ' ' . $currency) ?></td>
                                                <td>
                                                    <?php
                                                    if ($purchase['approve_status']) {
                                                        echo '<span class="label label-primary">' . display('approved') . '</span> ';
                                                    }
                                                    if ($purchase['receive_status']) {
                                                        echo '<span class="label label-success">' . display('received') . '</span> ';
                                                    } else {
                                                        echo '<span class="label label-warning">' . display('not_received') . '</span> ';
                                                    }
                                                    if ($purchase['return_status']) {
                                                        echo '<span class="label label-danger">' . display('returned') . '</span> ';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                        <center>
                                            <?php if ($this->permission->check_label('receive_item')->update()->access()) { ?>
                                                <?php if (!$purchase['receive_status']) { ?>
                                                    <a href="<?php echo base_url().'dashboard/Cpurchase/manage_purorder/view/'.$purchase['pur_order_id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('view_details') ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                                    <a href="<?php echo base_url() . 'dashboard/Cpurchase/manage_purorder/receive/' . $purchase['pur_order_id']; ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('receive_item') ?>"><i class="ti-plus"> </i></a>
                                                <?php } ?>
                                                <?php if ($purchase['receive_status'] && !$purchase['return_status']) { ?>
                                                    <a href="<?php echo base_url() . 'dashboard/Cpurchase/manage_purorder/view1/' . $purchase['pur_order_id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('view_details') ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                                    <a href="<?php echo base_url() . 'dashboard/Cpurchase/manage_purorder/view2/' . $purchase['pur_order_id']; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('view_details') ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                                <!--											<a href="<?php echo base_url() . 'dashboard/Cpurchase/manage_purorder/return/' . $purchase['pur_order_id']; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('return_item') ?>"><i class="fa fa-undo" aria-hidden="true"></i></a>-->
                                                    <?php
                                                }
                                            }
                                            ?>
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
<!-- Manage Purchase End -->