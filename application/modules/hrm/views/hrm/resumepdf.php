<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
   <!-- Manage Customer Start -->
   <div class="content-wrapper">
       <section class="content-header">
           <div class="header-icon">
               <i class="pe-7s-note2"></i>
           </div>
           <div class="header-title">
               <h1><?php echo display('employee') ?></h1>
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
                       <a href="<?php echo base_url('hrm/hrm/bdtask_employee_form')?>" class="btn btn-success m-b-5 m-r-2"><i
                                   class="ti-plus"> </i> <?php echo display('add_employee')?></a>
                       <a href="<?php echo base_url('hrm/hrm/bdtask_employee_list')?>" class="btn btn-warning m-b-5 m-r-2"><i
                                   class="ti-align-justify"> </i> <?php echo display('manage_employee')?></a>
                   </div>
               </div>
           </div>

           <!-- Manage Customer -->
           <div class="row">
               <div class="col-sm-12 col-md-4">

                   <div class="card-content-member">
                       <div > <?php echo "<img src='" . (!empty($row[0]['image'])?base_url().$row[0]['image']:base_url('assets/img/icons/default.jpg'))."' width=100px; height=100px; class=img-circle>";?></div>
                   </div>
                   <div class="card-content">
                       <div class="card-content-member">
                           <h4 class="m-t-0"><?php echo html_escape($row[0]['first_name'])."  " .html_escape($row[0]['last_name']);?></h4>
                           <h5><?php echo display('designation')?>: <?php echo html_escape($row[0]['designation']);
                               ?></h5>
                           <p class="m-0"><i class="fa fa-mobile" aria-hidden="true"></i>
                               <?php echo html_escape($row[0]['phone']) ;?></p>
                       </div>
                       <div class="card-content-languages">
                           <div class="card-content-languages-group"></div>
                           <div class="card-content-languages-group">
                               <table class="table table-hover" width="100%">
                                   <caption  class="resumehead"><?php echo display('personal_information')?></caption>
                                   <tr>
                                       <th><?php echo display('name')?></th>
                                       <td><?php echo html_escape($row[0]['first_name'])." " .html_escape($row[0]['last_name']);?></td>
                                   </tr>
                                   <tr>
                                       <th><?php echo display('phone')?></th>
                                       <td><?php echo $row[0]['phone'] ;?></td>
                                   </tr>
                                   <tr>
                                       <th><?php echo display('email')?></th>
                                       <td><?php echo html_escape($row[0]['email'])  ;?></td>
                                   </tr>
                                   <tr>
                                       <th><?php echo display('country')?></th>
                                       <td><?php echo html_escape($row[0]['country']) ;?></td>
                                   </tr>
                                   <tr>
                                       <th><?php echo display('city')?></th>
                                       <td><?php echo html_escape($row[0]['city']) ;?></td>
                                   </tr>
                                   <tr>
                                       <th><?php echo display('zip')?></th>
                                       <td><?php echo html_escape($row[0]['zip']) ;?></td>
                                   </tr>
                               </table>


                           </div>

                       </div>
                       <div class="card-footer">
                           <div class="card-footer-stats">
                               <div>
                                   <p></p><span class="stats-small"></span>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="col-sm-12 col-md-8">
                   <div class="row">
                       <div class="col-sm-12 col-md-12 rating-block" >

                           <table class="table table-hover" width="100%">


                               <caption  class="resumehead"><?php echo display('positional_information')?></caption>

                               <tr>
                                   <th><?php echo display('designation')?></th>
                                   <td><?php echo html_escape($row[0]['designation']);?></td>
                               </tr>
                               <tr>
                                   <th><?php echo display('phone')?></th>
                                   <td><?php echo html_escape($row[0]['phone']) ;?></td>
                               </tr>


                               <tr>
                                   <th><?php echo display('rate_type')?></th>
                                   <td><?php if($row[0]['rate_type'] == 1){
                                           echo 'Hourly';
                                       }else{
                                           echo 'Salary';
                                       }?></td>
                               </tr>
                               <tr>
                                   <th><?php echo display('hour_rate_or_salary')?></th>
                                   <td><?php echo html_escape($row[0]['hrate']);?></td>
                               </tr>


                           </table>

                           <table class="table table-hover" width="100%">
                            <caption  class="resumehead"><?php echo display('contact_info')?></caption>
                            <tr>
                            <th>
                            <?php echo display('name') ?>
                            </th>
                            <th>
                            <?php echo display('phone') ?>
                            </th>
                            <th>
                            <?php echo display('customer_address') ?>
                            </th>
                            </tr>
                            <tbody>
                                <?php foreach ($contact_info as $c) :?>
                                    <tr>
                                        <td>
                                            <?=$c->name?>
                                        </td>
                                        <td>
                                            <?=$c->phone?>
                                        </td>
                                        <td>
                                            <?=$c->address?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                           </table>

                       </div>



                   </div>


               </div>


           </div>
       </section>
   </div>

