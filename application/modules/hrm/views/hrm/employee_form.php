<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
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
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $this->session->flashdata('message') ?>
            </div>
        <?php } ?>
        <?php if (!empty($this->session->flashdata('exception'))) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $this->session->flashdata('exception') ?>
            </div>
        <?php } ?>
        <?php if (!empty(validation_errors())) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo validation_errors() ?>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="column">
                    <a href="<?php echo base_url('hrm/hrm/bdtask_employee_list') ?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('manage_employee') ?></a>
                </div>
            </div>
        </div>
        <!-- Manage Customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo html_escape($title) ?> </h4>
                        </div>
                    </div>

                    <div class="panel-body">

                        <?php echo form_open_multipart('employee_form/' . $employee->id, 'id="validate"') ?>
                        <input type="hidden" name="id" id="id" value="<?php echo $employee->id ?>">
                        <div class="form-group row">
                            <label for="first_name" class="col-sm-2 col-form-div"><?php echo display('first_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input name="first_name" class="form-control" type="text" placeholder="<?php echo display('first_name') ?>" required id="first_name" value="<?php echo $employee->first_name ?>">
                                <input type="hidden" name="old_first_name" value="<?php echo $employee->first_name ?>">
                            </div>
                            <label for="last_name" class="col-sm-2 col-form-div"><?php echo display('last_name') ?><i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input name="last_name" class="form-control" type="text" placeholder="<?php echo display('last_name') ?>" id="last_name" value="<?php echo $employee->last_name ?>">
                                <input type="hidden" name="old_last_name" value="<?php echo $employee->last_name ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="designation" class="col-sm-2 col-form-div"><?php echo display('designation') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <?php echo form_dropdown('designation', $desig, $employee->designation, 'class="form-control" required') ?>
                            </div>
                            <label for="phone" class="col-sm-2 col-form-div"><?php echo display('phone') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input name="phone" class="form-control" type="number" placeholder="<?php echo display('phone') ?>" id="phone" required value="<?php echo $employee->phone ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rate_type" class="col-sm-2 col-form-div"><?php echo display('rate_type') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <select name="rate_type" class="form-control" required="required" data-required="required">
                                    <option value="">Select type</option>
                                    <option value="1" <?php if ($employee->rate_type == 1) {
                                                            echo 'selected';
                                                        } ?>><?php echo display('hourly') ?></option>
                                    <option value="2" <?php if ($employee->rate_type == 2) {
                                                            echo 'selected';
                                                        } ?>><?php echo display('salary') ?></option>

                                </select>
                            </div>
                            <label for="hour_rate_or_salary" class="col-sm-2 col-form-div"><?php echo display('hour_rate_or_salary') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input name="hrate" class="form-control" type="number" placeholder="<?php echo display('hour_rate_or_salary') ?>" id="hrate" required value="<?php echo $employee->hrate ?>">
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-div"><?php echo display('email') ?></label>
                            <div class="col-sm-4">
                                <input name="email" class="form-control" type="email" placeholder="<?php echo display('email') ?>" id="email" value="<?php echo $employee->email ?>">
                            </div>
                            <label for="blood_group" class="col-sm-2 col-form-div"><?php echo display('blood_group') ?> </label>
                            <div class="col-sm-4">
                                <input name="blood_group" class="form-control" type="text" placeholder="<?php echo display('blood_group') ?>" id="blood_group" value="<?php echo $employee->blood_group ?>">
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="address_line_1" class="col-sm-2 col-form-div"><?php echo display('address_line_1') ?></label>
                            <div class="col-sm-4">
                                <textarea name="address_line_1" class="form-control" placeholder="<?php echo display('address_line_1') ?>" id="address_line_1"><?php echo $employee->address_line_1 ?></textarea>
                            </div>
                            <label for="address_line_2" class="col-sm-2 col-form-div"><?php echo display('address_line_2') ?></label>
                            <div class="col-sm-4">
                                <textarea name="address_line_2" class="form-control" placeholder="<?php echo display('address_line_2') ?>" id="address_line_2"><?php echo $employee->address_line_2 ?></textarea>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="picture" class="col-sm-2 col-form-div"><?php echo display('picture') ?></label>
                            <div class="col-sm-4">
                                <input type="file" name="image" class="form-control" placeholder="<?php echo display('picture') ?>" id="image">
                                <input type="hidden" name="old_image" value="<?php echo $employee->image ?>">
                            </div>
                            <label for="country" class="col-sm-2 col-form-div"><?php echo display('country') ?> </label>
                            <div class="col-sm-4">
                                <select name="country" id="country" class="form-control">
                                        <option><?php echo display('country') ?></option>
                                        <?php if ($countries) {
                                            foreach ($countries as $country) {  ?>
                                        <option value="<?php echo $country['id']; ?>" <?=$employee->country == $country['id'] ? 'selected' : ''?>>
                                            <?php echo html_escape($country['name']); ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-sm-2 col-form-div"><?php echo display('city') ?></label>
                            <div class="col-sm-4 custom-select">
                                <!-- <input name="city" class="form-control" type="text" placeholder="<?php echo display('city') ?>" id="city" value="<?php echo $employee->city ?>"> -->

                                <select name="cities[]" class="form-control select2" data-placeholder="<?php echo display('city') ?>" id="city"  multiple data-multiple="true" data-val="<?=($employee->cities)?>">
                                    <option><?php echo display('city') ?></option>        
                                    <?php foreach ($states as $state) : ?>
                                        <option value="<?=$state->id?>" <?=in_array($state->id, explode(',', $employee->cities)) ? 'selected' : ''?>><?=$state->name?></option>
                                    <?php endforeach ?>
                                </select>

                            </div>
                            <label for="zip" class="col-sm-2 col-form-div"><?php echo display('zip') ?></label>
                            <div class="col-sm-4">
                                <input name="zip" class="form-control" type="text" placeholder="<?php echo display('zip') ?>" value="<?php echo $employee->zip ?>" id="zip">
                            </div>
                        </div>

                        <div class="form-group row" style="display: <?php echo $employee->id ? '' : 'none';?>;<?=$employee->is_website?>">
                            <div class="col-sm-7 custom-select">
                                <input name="is_website" class="form-control" type="checkbox" placeholder="<?php echo display('is_website') ?>" id="is_website" style="width: 10%;display: inline-block;" <?php echo $employee->is_website == 1 ? 'checked' : '' ?>>
                                <label for="is_website" class="col-form-di" style="vertical-align: text-top;margin-top: -10px;"><?php echo display('set_website_emp') ?></label>
                            </div>
                        </div>

                        <!-- <div class="contact-info-conatiner">
                            <div class="row form-group">
                                <div class="col-sm-12">
                                    <h3 class="card-title">
                                    <?php echo display('contact_info') ?>
                                    </h3>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-12">
                                    <div id="contact_info">
                                        <?php if ($employee) : ?>
                                            <?php
                                            if (!is_array($contact_info) || !is_object($contact_info)) {
                                                $contact_info = [];
                                            }
                                            ?>
                                            <?php foreach ($contact_info as $inx => $c) : ?>
                                                <div class="form-group row" style="padding-top: 20px;">
                                                <label for="contact<?= $inx ?>" class="col-sm-2 col-form-div"><?php echo display('name') ?></label>
                                                <div class="col-sm-4">
                                                    <input name="contact_info[<?= $inx ?>][name]" class="form-control" type="text" placeholder="<?php echo display('name') ?>" id="contact<?= $inx ?>" value="<?= $c->name ?>">
                                                </div>
                                                <label for="contact<?= $inx ?>" class="col-sm-2 col-form-div"><?php echo display('phone') ?></label>

                                                <div class="col-sm-4">
                                                    <input name="contact_info[<?= $inx ?>][phone]" class="form-control" type="text" placeholder="<?php echo display('phone') ?>" value="<?php echo $c->phone ?>" id="contact<?= $inx ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row " style="padding-bottom: 20px;border-bottom: 1px solid #ababab;">
                                                <label for="contact<?= $inx ?>" class="col-sm-2 col-form-div"><?php echo display('customer_address') ?>
                                                </label>
                                                <div class="col-sm-10">
                                                    <input name="contact_info[<?= $inx ?>][address]" class="form-control" type="text" placeholder="<?php echo display('customer_address') ?>" id="contact<?= $inx ?>" value="<?php echo $c->address ?>" />
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-12">
                                    <button type="button" class="btn btn-info" id="add-contact">
                                        <?= display('add_contact_info') ?>
                                    </button>
                                </div>
                            </div>
                        </div> -->


                        <div class="form-group text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                        </div>
                        <?php echo form_close() ?>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
<i id="counter" data-val="<?= $employee ? count($contact_info) + 1 : 0 ?>"></i>
<script>
    $(document).ready(function() {
        var csrf_test_name=  $("#CSRF_TOKEN").val();

        // $('#contact_info').append(getInputs());
        $('#counter').attr('data-val', parseInt($('#counter').attr('data-val'), 10) + 1);

        $(document).on('click', '#add-contact', function() {
            // $('#contact_info').append(getInputs());
            $('#counter').attr('data-val', parseInt($('#counter').attr('data-val'), 10) + 1);
        });

        function getCount() {
            return parseInt($('#counter').attr('data-val'), 10);
        }

        function randInt() {
            return Math.round(Math.random() * 1000000);
        }

        function getInputs() {
            var rand1 = randInt();
            var rand2 = randInt();
            var rand3 = randInt();
            return '<div class="form-group row" style="padding-top: 20px;"><label for="contact' + rand1 + '" class="col-sm-2 col-form-div"><?php echo display('name') ?></label><div class="col-sm-4"><input name="contact_info[' + getCount() + '][name]" class="form-control" type="text" placeholder="<?php echo display('name') ?>" id="contact' + rand1 + '"></div><label for="contact' + rand2 + '" class="col-sm-2 col-form-div"><?php echo display('phone') ?></label><div class="col-sm-4"><input name="contact_info[' + getCount() + '][phone]" class="form-control" type="text" placeholder="<?php echo display('phone') ?>" value="<?php echo $employee->zip ?>" id="contact' + rand2 + '"></div></div><div class="form-group row " style="padding-bottom: 20px;border-bottom: 1px solid #ababab;"><label for="contact' + rand3 + '" class="col-sm-2 col-form-div"><?php echo display('customer_address') ?></label><div class="col-sm-10"><input name="contact_info[' + getCount() + '][address]" class="form-control" type="text" placeholder="<?php echo display('customer_address') ?>" id="contact' + rand3 + '" value="<?php echo $employee->city ?>"></div></div>';
        }

        // $('input,select,textarea').removeAttr('required');

        $(document).on('change', '#country', function() {
            var val = $(this).val();

            // get city list
            var base_url = $("#base_url").val();
            $.ajax({
                url: base_url + "hrm/hrm/get_country_cities/",
                type: "POST",
                data: {
                    country_id: val,
                    csrf_test_name: csrf_test_name,
                },
                success: function(data) {
                    // console.log(data);
                    $('#city').append(data);
                }
            });
        });
    });
</script>