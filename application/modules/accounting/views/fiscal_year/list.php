<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Manage Customer Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('accounts') ?></h1>
            <small><?php echo display('fiscal_year') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('accounts') ?></a></li>
                <li class="active"><?php echo display('fiscal_year') ?></li>
            </ol>
        </div>
    </section>

    <section class="content">

        <?php if (!empty($this->session->flashdata('message'))) { ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('message') ?>
        </div>
        <?php } ?>
        <?php if (!empty($this->session->flashdata('exception'))) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('exception') ?>
        </div>
        <?php } ?>
        <?php if (!empty(validation_errors())) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <?php echo validation_errors() ?>
        </div>
        <?php } ?>


        <div class="row">
            <div class="col-sm-12">
                <div class="column">
                    <a href="<?php echo base_url('accounting/fiscal_year/add')?>" class="btn btn-success m-b-5 m-r-2"><i
                            class="ti-plus"> </i> <?php echo display('add')?></a>
                </div>
            </div>
        </div>

        <!-- Manage Customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('fiscal_year') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo display('sl') ?></th>
                                        <th><?php echo display('title') ?></th>
                                        <th><?php echo display('start_date') ?></th>
                                        <th><?php echo display('end_date') ?></th>
                                        <th><?php echo display('status') ?></th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                            if ($fiscal_years) { 
                            $i=1;
							foreach($fiscal_years as $item):
						      ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo html_escape($item['title']);?></td>
                                        <td><?php echo date('d F, Y', strtotime($item['start_date']));?></td>
                                        <td><?php echo date('d F, Y', strtotime($item['end_date']));?></td>
                                        <td class="text-center">
                                            <?php 
                                        if ($item['status']==0) { 
                                        $find_active=$this->db->select('*')->from('acc_fiscal_year')->where('status',1)->get()->row();
                                    ?>
                                            <?php echo form_open('accounting/Accounting/active_fiscal_year/'.$item['id'], array('id' => 'validate')); ?>
                                            <select class="form-control" name="fy_status" required=""
                                                <?php if(!empty($find_active)){echo 'disabled'; } ?>>
                                                <option value=""></option>
                                                <option value="0" <?php if ($item['status'] == '0'){echo "selected";}?>>
                                                    <?php echo display('inactive')?></option>
                                                <option value="1" <?php if ($item['status'] == '1'){echo "selected";}?>>
                                                    <?php echo display('active')?></option>
                                            </select>
                                            <button type="submit" class="btn btn-primary inv_updatebtn"
                                                <?php if(!empty($find_active)){echo 'disabled'; } ?>><?php echo display('update') ?></button>
                                            <?php echo form_close() ?>
                                            <?php }elseif ($item['status']==1) { ?>
                                            <span class="label label-success">Active</span>
                                            <?php }else{?>
                                            <span class="label label-danger">Closed</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="<?php echo base_url().'accounting/fiscal_year/edit/'.$item['id']; ?>"
                                                    class="btn btn-info btn-sm" data-toggle="tooltip"
                                                    data-placement="left" title="<?php echo display('update') ?>">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                                <a href="<?php echo base_url('accounting/fiscal_year/delete/'.$item['id']);?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('<?php echo display('are_you_sure_want_to_delete')?>');"
                                                    data-toggle="tooltip" data-placement="right" title=""
                                                    data-original-title="<?php echo display('delete') ?> ">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                            </center>
                                        </td>
                                    </tr>

                                    <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>