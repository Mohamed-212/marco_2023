<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
 <!-- Manage Customer Start -->
 <div class="content-wrapper">
     <section class="content-header">
         <div class="header-icon">
             <i class="pe-7s-note2"></i>
         </div>
         <div class="header-title">
             <h1><?php echo display('expense') ?></h1>
             <small><?php echo $title ?></small>
             <ol class="breadcrumb">
                 <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                 <li><a href="#"><?php echo display('expense') ?></a></li>
                 <li class="active"><?php echo $title ?></li>
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

         <!-- Manage Customer -->
         <div class="row">
             <div class="col-sm-12">
                 <div class="panel panel-bd lobidrag">
                     <div class="panel-heading">
                         <div class="panel-title">
                             <h4><?php echo $title ?> </h4>
                         </div>
                     </div>

                     <div class="panel-body">
                         <?php echo form_open('add_expense_item/'.$items->id,'class="" id="item_form"')?>


                         <div class="form-group row">
                             <label for="item" class="col-sm-4 text-right col-form-label"><?php echo display('expense_item_name')?> <i class="text-danger"> * </i>:</label>
                             <div class="col-sm-6">


                                 <input type="text" name="expense_item_name" class="form-control" id="expense_item_name" placeholder="<?php echo display('expense_item_name')?>" value="<?php echo $items->expense_item_name?>" required>
                             </div>
                             <div class="col-sm-2">
                                 <button type="submit" class="btn btn-success ">
                                     <?php echo (empty($items->id)?display('save'):display('update')) ?></button>
                             </div>
                         </div>

                         <?php echo form_close();?>
                     </div>

                 </div>
             </div>
         </div>
     </section>
 </div>
