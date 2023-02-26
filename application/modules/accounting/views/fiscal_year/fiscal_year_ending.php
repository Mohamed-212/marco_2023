<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<link rel="stylesheet" href="<?php echo MOD_URL.'accounting/assets/css/fiscal_year_ending.css' ?>">
<!-- Manage Customer Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('accounts') ?></h1>
            <small><?php echo display('fiscal_year_ending') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('accounts') ?></a></li>
                <li class="active"><?php echo display('fiscal_year_ending') ?></li>
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
                            <h4><?php echo display('fiscal_year_ending') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <p class=" text-center text-danger fy-paragraph">
                                    You can end Fiscal Year at the end of Fiscal Year. If you end fiscal year Your all
                                    closing balance will be added in opening Balance for new Fiscal year
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center text-danger fy-close">
                                <?php if (!empty($fiscal_year[0]->id)) { ?>
                                <?php echo form_open('accounting/Accounting/complete_fiscal_year_ending'); ?>
                                <input type="hidden" name="active_year_id" value="<?php echo $fiscal_year[0]->id;?>">
                                <button class="btn btn-danger" type="submit">End Your Fiscal Year</button>
                                <?php echo form_close() ?>
                                <?php }else{ ?>
                                <button class="btn btn-danger" type="submit">No Active Fiscal Year Available</button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>