<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script src="<?php echo base_url('my-assets/js/admin_js/payroll.js') ?>" type="text/javascript"></script>
<!-- Manage Customer Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('payroll') ?></h1>
            <small><?php echo $title ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('payroll') ?></a></li>
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
            <div class="col-sm-12 col-md-12">
                <div class="panel">

                    <div class="panel-body">

                        <?php echo form_open('hrm/payroll/salary_setup_update/' . $data[0]['employee_id']) ?>
                        <div class="form-group row">
                            <label for="employee_id"
                                   class="col-sm-3 col-form-label"><?php echo display('employee_name') ?> <span
                                        class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <?php echo form_dropdown('employee_id', $employee, (!empty($data[0]['employee_id']) ? $data[0]['employee_id'] : null), 'class="form-control" id="employee_id" onchange="employechange(this.value)"') ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="payment_period"
                                   class="col-sm-3 col-form-label"><?php echo display('salary_type') ?> <span
                                        class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="sal_type_name" readonly=""
                                       id="sal_type_name" value="<?php if ($EmpRate[0]['rate_type'] == 1) {
                                    echo 'Hourly';
                                } else {
                                    echo 'Salary';
                                } ?>">
                                <input type="hidden" class="form-control" name="sal_type" id="sal_type"
                                       value="<?php echo $EmpRate[0]['rate_type']; ?>">
                            </div>
                        </div>
                        <table border="1" width="100%">
                            <div class="row">

                                <td class="col-sm-6 text-center"><h4
                                            class="payrolladditiondeduction paddingtop30"><?php echo display('addition') ?></h4>
                                    <br>
                                    <table id="add">   <?php foreach ($amo as $basic) {
                                        } ?>
                                        <tr>
                                            <th class="padding10"><?php echo display('basic') ?></th>
                                            <td><input type="text" id="basic" name="basic" class="form-control"
                                                       disabled="" value="<?php echo $EmpRate[0]['rate']; ?>"></td>
                                        </tr>
                                        <?php
                                        $x = 0;
                                        foreach ($amo as $value) {
                                            ?>
                                            <tr>
                                                <th class="padding10"><?php echo $value->sal_name; ?> (%)</th>
                                                <td>
                                                    <input type="text"
                                                           name="amount[<?php echo $value->salary_type_id; ?>]"
                                                           class="form-control addamount" onkeyup="summary()"
                                                           value="<?php echo $value->amount; ?>"
                                                           id="add_<?php echo $x; ?>">
                                                </td>
                                            </tr>
                                            <?php $x++;
                                        } ?>
                                    </table>
                                </td>
                                <td class="col-sm-6 text-center"><h4
                                            class="payrolladditiondeduction"><?php echo display('deduction') ?></h4><br>
                                    <table id="dduct">
                                        <?php
                                        $y = 0;
                                        foreach ($samlft as $row) {

                                            ?>
                                            <tr>
                                            <th class="padding10"><?php echo $row->sal_name; ?> (%)</th>
                                            <td><input type="text" name="amount[<?php echo $row->salary_type_id; ?>]"
                                                       onkeyup="summary()" class="form-control deducamount"
                                                       value="<?php echo $row->amount ?>" id="dd_<?php echo $y; ?>">
                                            </td></tr><?php
                                            $y++;
                                        }
                                        ?>
                                        <tr>
                                            <th class="padding10"><?php echo display('tax') ?> (%)</th>
                                            <td><input type="text" name="amount[]" onkeyup="summary()"
                                                       class="form-control deducamount"
                                                       id="taxinput" <?php if ($EmpRate[0]['rate_type'] == 1) {
                                                    echo 'readonly';
                                                } ?>></td>
                                            <td class="padding10"><input type="checkbox" name="tax_manager"
                                                                         id="taxmanager" onchange='handletax(this);'
                                                                         value="1" <?php if ($EmpRate[0]['rate_type'] == 1) {
                                                    echo 'checked' . '  ' . 'disabled';
                                                } ?>>Tax Manager
                                            </td>
                                        </tr>

                                    </table>

                                </td>

                            </div>

                        </table>
                    </div>
                    <div class="form-group row">
                        <label for="payable"
                               class="col-sm-3 col-form-label text-center"><?php echo display('gross_salary') ?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="gross_salary"
                                   value="<?php echo $basic->gross_salary; ?>" id="grsalary" readonly="">
                        </div>
                    </div>

                    <div class="form-group text-right">
                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                        <button type="submit"
                                class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                    </div>
                    <?php echo form_close() ?>

                </div>
            </div>
        </div>
    </section>
</div>
