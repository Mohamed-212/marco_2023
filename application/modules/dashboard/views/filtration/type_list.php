<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Add new currency start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('filtration') ?></h1>
            <small><?php echo display('manage_filters') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('filtration') ?></a></li>
                <li class="active"><?php echo display('manage_filters') ?></li>
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
        <!-- New customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('manage_filters') ?> </h4>
                        </div>
                    </div>
                  <?php echo form_open_multipart('dashboard/cfiltration/add_filter', array('class' => 'form-vertical','id' => 'validate'))?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center"><?php echo display('sl') ?></th>
                                                <th class="text-center"><?php echo display('filter_type') ?></th>
                                                <th class="text-center"><?php echo display('filter_names') ?></th>
                                                <th class="text-center"><?php echo display('categories') ?></th>
                                                <th class="text-center"><?php echo display('action') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if ($types) {
                                                $i=1;
                                                foreach ($types as $type) {
                                                    $names = $this->db->select('item_name')->where('type_id', $type['fil_type_id'])->get('filter_items')->result();
                                                    $categories = $this->db->select('b.category_name')->from('filter_type_category a')->join('product_category b', 'b.category_id=a.category_id','left')->where('a.type_id', $type['fil_type_id'])->get()->result();
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i++; ?></td>
                                                <td class="text-center"><?php echo html_escape($type['fil_type_name'])?></td>
                                                <td class="text-center"><?php 
                                                    if(!empty($names)){
                                                        echo implode(', ', array_column($names, 'item_name'));
                                                    }
                                                ?></td>
                                                <td class="text-center">
                                                    <?php 
                                                       if(!empty($categories)){
                                                            echo implode(', ', array_column($categories, 'category_name'));
                                                        }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?php echo base_url().'dashboard/cfiltration/type_edit/'.$type['fil_type_id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    <a href="<?php echo base_url('dashboard/cfiltration/type_delete/'.$type['fil_type_id'])?>" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo display('are_you_sure_want_to_delete')?>');" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>

                                                </td>
                                            </tr>
                                        <?php }} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
