<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!--Edit customer start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('customer_edit') ?></h1>
            <small><?php echo display('customer_edit') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('customer') ?></a></li>
                <li class="active"><?php echo display('customer_edit') ?></li>
            </ol>
        </div>
    </section>

    <section class="content">
        <!-- alert message -->
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

        <!-- New customer -->
        <div class="row">
            <div class="col-sm-12" x-data="{
                infos: [],
                info_object: {
                    id: 0,
                    info_id: 0,
                    name: '',
                    mobile: '',
                    address: '',
                },
                addOne: function() {
                    this.infos.push({
                        info_id: Math.random() * 10000,
                        name: '',
                        mobile: '',
                        address: '',
                    });
                },
                addOneFromData: function (id, name, mobile, address) {
                    this.infos.push({
                        info_id: Math.random() * 10000 + id,
                        id: id,
                        name: name,
                        mobile: mobile,
                        address: address,
                    });
                },
                removeOne: function(id) {
                    this.infos.splice(this.infos.findIndex(x => x.info_id == id), 1);
                }
            }" x-init="$watch('infos', value => {
                const contactInfo = document.querySelector('#contact_info');
                contactInfo.value = JSON.stringify(value);
            });<?php foreach($contact_info as $info) {echo "addOneFromData({$info->id}, '{$info->name}', '{$info->phone}', '{$info->address}');";} ?>">
                
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('customer_edit') ?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('dashboard/Ccustomer/customer_update',array('class' => 'form-vertical', 'id' => 'validate'))?>
                    <div class="panel-body">
                        <div class="form-group row">
                            <label for="customer_name"
                                class="col-sm-3 col-form-label"><?php echo display('customer_name') ?> <i
                                    class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name="customer_name" id="customer_name" type="text"
                                    placeholder="<?php echo display('customer_name') ?>" required=""
                                    value="{customer_name}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label"><?php echo display('customer_email') ?>
                                <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name="email" value="{customer_email}" id="email"
                                    type="email" placeholder="<?php echo display('customer_email') ?>" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-sm-3 col-form-label"><?php echo display('customer_mobile') ?>
                                <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name="mobile" value="{customer_mobile}" id="mobile"
                                    type="number" placeholder="<?php echo display('customer_mobile') ?>" required="">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label"><?php echo display('customer_password') ?>
                                <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name="password" id="password" type="text" placeholder="<?php echo display('customer_password') ?>" maxlength="6">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="vat_no" class="col-sm-3 col-form-label"><?php echo display('vat_no') ?></label>
                            <div class="col-sm-6">
                                <input class="form-control" name="vat_no" value="{vat_no}" id="vat_no" type="text"
                                    placeholder="<?php echo display('vat_no') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cr_no" class="col-sm-3 col-form-label"><?php echo display('cr_no') ?></label>
                            <div class="col-sm-6">
                                <input class="form-control" name="cr_no" id="cr_no" value="{cr_no}" type="text"
                                    placeholder="<?php echo display('cr_no') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address "
                                class="col-sm-3 col-form-label"><?php echo display('customer_address') ?></label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="address" id="address " rows="3"
                                    placeholder="<?php echo display('customer_address') ?>">{customer_address} </textarea>
                            </div>
                        </div>
                        <input type="hidden" value="{customer_id}" name="customer_id">
                        <div class="form-group row">
                            <label for="customer_address_1 "
                                class="col-sm-3 col-form-label"><?php echo display('customer_address_1') ?></label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="customer_address_1" id="customer_address_1 "
                                    rows="3"
                                    placeholder="<?php echo display('customer_address_1') ?>">{customer_address_1}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_address_2 "
                                class="col-sm-3 col-form-label"><?php echo display('customer_address_2') ?></label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="customer_address_2" id="customer_address_2 "
                                    rows="3"
                                    placeholder="<?php echo display('customer_address_2') ?>">{customer_address_2}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city " class="col-sm-3 col-form-label"><?php echo display('city') ?></label>
                            <div class="col-sm-6">
                                <input class="form-control" name="city" id="city" type="text"
                                    placeholder="<?php echo display('city') ?>" value="{city}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="country "
                                class="col-sm-3 col-form-label"><?php echo display('country') ?></label>
                            <div class="col-sm-6">
                                <select class="form-control select2 width_100p" id="country" name="country">
                                    <option value=""><?php echo display('select_one') ?></option>
                                    <?php 
                                    if ($country_list) {
                                        foreach ($country_list as $country) { 
                                    ?>
                                    <option value="<?php echo html_escape($country['id'])?>"
                                        <?php if ($country['id'] == $country_id) {echo "selected"; }?>>
                                        <?php echo html_escape($country['name'])?></option>
                                    <?php 
                                        } 
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="state " class="col-sm-3 col-form-label"><?php echo display('state') ?></label>
                            <div class="col-sm-6">
                                <select class="form-control select2 width_100p" id="state" name="state">
                                    <option value=""><?php echo display('select_one') ?></option>
                                    <?php 
                                    if ($state_list) { 
                                        foreach ($state_list as $state) {
                                    ?>
                                    <option value="<?php echo html_escape($state->name)?>"
                                        <?php if ($state->name == $state_name) {echo "selected";}?>>
                                        <?php echo html_escape($state->name)?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="zip " class="col-sm-3 col-form-label"><?php echo display('zip') ?></label>
                            <div class="col-sm-6">
                                <input class="form-control" name="zip" id="zip" type="text"
                                    placeholder="<?php echo display('zip') ?>" value="{zip}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <input type="hidden" hidden id="contact_info" name="contact_info" value="<?=json_encode($contact_info)?>" />
                            <div class="col-sm-12">
                                <div class="card-body" style="margin-top: 35px;">
                                    <div class="row">
                                        <div class="col-sm-11">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">
                                                    <b><?php echo display('contact_info') ?>:</b>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <template x-for="(c, inx) in infos" :key="c.info_id">
                                        <div class="row" style="margin: 30px 0;border-bottom: 1px solid #ccc;">
                                            <div class="col-sm-11">
                                                <div class="form-group row">
                                                    <label x-bind:for="'customer_name' + c.info_id" class="col-sm-3 col-form-label"><?php echo display('customer_name') ?></label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="info_names[]" x-bind:id="'customer_name' + c.info_id" x-model.trim="c.name" type="text" placeholder="<?php echo display('customer_name') ?>" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label x-bind:for="'mobile' + c.info_id" class="col-sm-3 col-form-label"><?php echo display('customer_mobile') ?></label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="infos_mobile[]" x-bind:id="'mobile' +c.info_id" x-model.number="c.mobile" type="number" placeholder="<?php echo display('customer_mobile') ?>" required="" min="0" data-toggle="tooltip" data-placement="bottom" title="<?php echo display('add_country_code') ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label x-bind:for="'customer_address_1' + c.info_id" class="col-sm-3 col-form-label"><?php echo display('customer_address') ?></label>
                                                    <div class="col-sm-6">
                                                        <textarea class="form-control" name="infos_address[]" x-bind:id="'customer_address_1' + c.info_id" x-model.trim="c.address" rows="3" placeholder="<?php echo display('customer_address') ?>"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-1" style="display: flex;align-items: center;align-content: center;height: 150px;">
                                                <button type="button" class="btn btn-danger" x-on:click.prevent="removeOne(c.info_id)">
                                                    <i class="fa fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                    <button type="button" class="btn btn-info" x-on:click.prevent="addOne">
                                        <?= display('add_contact_info') ?>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" id="add-Customer" class="btn btn-success btn-large"
                                    name="add-Customer" value="<?php echo display('save_changes') ?>" />
                            </div>
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Edit customer end -->
<script src="<?php echo MOD_URL.'dashboard/assets/js/edit_customer_form.js'; ?>"></script>