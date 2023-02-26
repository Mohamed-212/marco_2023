<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
 <!-- Manage Customer Start -->
 <div class="content-wrapper">
     <section class="content-header">
         <div class="header-icon">
             <i class="pe-7s-note2"></i>
         </div>
         <div class="header-title">
             <h1><?php echo display('designation') ?></h1>
             <small><?php echo $title ?></small>
             <ol class="breadcrumb">
                 <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                 <li><a href="#"><?php echo display('hrm') ?></a></li>
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
         <div class="row">
             <div class="col-sm-12">
                 <div class="column">
                     <a href="<?php echo base_url('hrm/hrm/bdtask_designation_list')?>" class="btn btn-success m-b-5 m-r-2"><i
                                 class="ti-align-justify"> </i> <?php echo display('manage_designation')?></a>
                 </div>
             </div>
         </div>
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
                         <?php echo form_open('designation_form/'.$designation->id,'class="" id="designation_form"')?>


                         <div class="form-group row">
                             <label for="designation" class="col-sm-2 text-right col-form-label"><?php echo display('designation')?> <i class="text-danger"> * </i>:</label>
                             <div class="col-sm-4">


                                 <input type="text" name="designation" class="form-control" id="designation" placeholder="<?php echo display('designation')?>" value="<?php echo $designation->designation?>">
                             </div>
                         </div>

                         <div class="form-group row">
                             <label for="details" class="col-sm-2 text-right col-form-label"><?php echo display('details')?> <i class="text-danger"> </i>:</label>
                             <div class="col-sm-4">


                                 <input type="text" name="details" class="form-control" id="details" placeholder="<?php echo display('details')?>" value="<?php echo $designation->details?>">
                             </div>
                         </div>

                         <div class="form-group row">

                             <div class="col-sm-6 text-right">


                                 <button type="submit" class="btn btn-success ">
                                     <?php echo (empty($designation->id)?display('save'):display('update')) ?></button>



                             </div>
                         </div>


                         <?php echo form_close();?>
                     </div>

                 </div>
             </div>
         </div>
     </section>
 </div>