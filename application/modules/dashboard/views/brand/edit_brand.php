<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo MOD_URL . 'dashboard/assets/css/brand.css'; ?>">
<!--Edit customer start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('brand_edit') ?></h1>
            <small><?php echo display('brand_edit') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('brand') ?></a></li>
                <li class="active"><?php echo display('brand_edit') ?></li>
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

        <!--Edit brand -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('brand_edit') ?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('dashboard/Cbrand/brand_update/{brand_id}', array('class' => 'form-vertical', 'id' => 'validate')) ?>
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab"
                                    href="#home"><?php echo display('brand_information') ?></a></li>
                            <li><a data-toggle="tab" href="#menu1"><?php echo display('brand_translation') ?></a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                                <?php echo form_open_multipart('dashboard/Cbrand/insert_brand', array('class' => 'form-vertical', 'id' => 'validate')) ?>
                                <div class="panel-body">
                                    <div class="form-group row">
                                        <label for="brand_name"
                                            class="col-sm-3 col-form-label"><?php echo display('brand_name') ?> <i
                                                class="text-danger">*</i></label>
                                        <div class="col-sm-6">
                                            <input class="form-control" name="brand_name" id="brand_name" type="text"
                                                placeholder="<?php echo display('brand_name') ?>" required=""
                                                value="{brand_name}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="brand_image"
                                            class="col-sm-3 col-form-label"><?php echo display('brand_image') ?> <i
                                                class="text-danger">*</i></label>
                                        <div class="col-sm-6">
                                            <input class="form-control" name="brand_image" id="brand_image" type="file">
                                            <img src="<?php echo base_url(); ?>{brand_image}" height="100" width="100"
                                                class="img img-responsive mt_5">
                                            <input class="form-control" name="old_image" id="old_image" type="hidden"
                                                value="{brand_image}">
                                            <p class="help-block">Recommend Size (100*80)</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                                        <div class="col-sm-6">
                                            <input type="submit" id="add-brand" class="btn btn-success  btn-large"
                                                name="add-brand" value="<?php echo display('update') ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <div class="panel-body ">
                                    <?php $brand_languages = $this->db->select('*')
                                        ->from('brand_translation')
                                        ->where('brand_id', $brand_id)
                                        ->get()
                                        ->result();
                                    ?>
                                    <?php if ($brand_languages) {
                                        foreach ($brand_languages as $key => $brand_language) { ?>
                                    <div class="trans_row trans_row_mb">
                                        <div class="form-group row">
                                            <label for="language"
                                                class="col-sm-3 col-form-label"><?php echo display('language') ?></label>
                                            <div class="col-sm-6 custom_select">
                                                <div class="input-group">
                                                    <select class="form-control" id="language" name="language[0]">
                                                        <option value=""></option>
                                                        <?php if (!empty($languages)) {
                                                                    foreach ($languages as $lkey => $lvalue) { ?>
                                                        <option value="<?php echo html_escape($lvalue); ?>"
                                                            <?php echo ($brand_language->language == $lvalue) ? 'selected' : '' ?>>
                                                            <?php echo html_escape($lvalue); ?></option>
                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                    </select>
                                                    <?php if ($key == 0) { ?>
                                                    <div class="input-group-addon btn btn-success" id="add_row">
                                                        <i class="ti-plus"></i>
                                                    </div>
                                                    <?php } else { ?>
                                                    <div class="input-group-addon btn btn-danger remove_data_row">
                                                        <i class="ti-minus"></i>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="brand_translation"
                                                class="col-sm-3 col-form-label"><?php echo display('brand_name') ?></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" name="trans_name[0]" id="brand_translation"
                                                    value="<?php echo html_escape($brand_language->trans_name); ?>"
                                                    type="text" placeholder="<?php echo display('brand_name') ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <?php }
                                    } else { ?>
                                    <div class="trans_row trans_row_mb">
                                        <div class="form-group row">
                                            <label for="language"
                                                class="col-sm-3 col-form-label"><?php echo display('language') ?></label>
                                            <div class="col-sm-6 custom_select">
                                                <div class="input-group">
                                                    <select class="form-control" id="language" name="language[0]">
                                                        <option value=""></option>
                                                        <?php if (!empty($languages)) {
                                                                foreach ($languages as $lkey => $lvalue) { ?>
                                                        <option value="<?php echo html_escape($lvalue); ?>">
                                                            <?php echo html_escape($lvalue); ?></option>
                                                        <?php
                                                                }
                                                            }
                                                            ?>
                                                    </select>
                                                    <div class="input-group-addon btn btn-success" id="add_row">
                                                        <i class="ti-plus"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="brand_translation"
                                                class="col-sm-3 col-form-label"><?php echo display('brand_name') ?></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" name="trans_name[0]" id="brand_translation"
                                                    type="text" placeholder="<?php echo display('brand_name') ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="new_row"></div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                                        <div class="col-sm-6">
                                            <input type="submit" id="add-brand" class="btn btn-success  btn-large"
                                                name="add-brand" value="<?php echo display('update') ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
    </section>
</div>
<!-- Edit customer end -->
<script src="<?php echo MOD_URL . 'dashboard/assets/js/brand.js'; ?>"></script>