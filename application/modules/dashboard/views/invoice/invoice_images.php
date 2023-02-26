<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Stock List Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('invoice_images') ?></h1>
            <small><?php echo display('invoice_images') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('report') ?></a></li>
                <li class="active"><?php echo display('invoice_images') ?></li>
            </ol>
        </div>
    </section>

    <section class="content">
        <?php
        $success_message = $this->session->userdata('success_message');
        if (isset($success_message)) {
        ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $success_message ?>
            </div>
        <?php
            $this->session->unset_userdata('success_message');
        }
        ?>
        <div class="row">
            <div class="col-sm-12">

            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('invoice_images') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open("dashboard/Cinvoice/invoice_images", array('class' => '')); ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="invoice_no" class="col-sm-4" style="display: inline"><?php echo display('invoice_no') ?></label>
                                    <select class="form-select form-control col-sm-8 d-inline select2" id="invoice_no" name="invoice_no">
                                        <?php foreach ($invoices as $inx => $inv) : ?>
                                            <option value="<?=$inv->invoice?>" <?=$inx == 0 ? 'selected' : ''?>><?=$inv->invoice?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 25px">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                    <?php if ($items) : ?>
                        <div class="panel-body">
                            <div class="table-responsive mt_10">
                                <table id="" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><?php echo display('sl') ?></th>
                                            <th class="text-center"><?php echo display('customer_name') ?></th>
                                            <th class="text-center"><?php echo display('invoice_no') ?></th>
                                            <th class="text-center"><?php echo display('payment_amount') ?></th>
                                            <th class="text-center"><?php echo display('due_date') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($invoice_imagess) {
                                        ?>
                                            <?php foreach ($invoice_imagess as $d) : $d = (object) $d; ?>
                                                <tr class="text-center">
                                                    <td><?= $d->sl ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url() . 'dashboard/Ccustomer/customerledger/' . $d->customer_id; ?>">
                                                            <?= $d->customer_name ?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url() ?>dashboard/Cinvoice/invoice_inserted_data/<?= $d->invoice_id ?>">
                                                            <?= $d->invoice ?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url() ?>dashboard/Cinstallment/installment_update_form/<?= $d->invoice_id ?>">
                                                            <?= $d->amount ?>
                                                        </a>
                                                    </td>
                                                    <td><?= $d->due_date ?></td>
                                                </tr>
                                            <?php endforeach ?>

                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-center">
                                <?php if (isset($link)) {
                                    echo $link;
                                } ?>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Stock List End -->