<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('accounts') ?></h1>
            <small><?php echo display('chart_of_account') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('accounts') ?></a></li>
                <li class="active"><?php echo display('chart_of_account') ?></li>
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
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>
                                <?php echo display('debit_voucher') ?>
                            </h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php echo  form_open_multipart('accounting/accounting/debit_voucher', 'id="validate"') ?>
                        <div class="form-group row">
                            <label for="vo_no"
                                class="col-sm-2 col-form-label"><?php echo display('voucher_no') ?></label>
                            <div class="col-sm-4">
                                <input type="text" name="txtVNo" id="txtVNo" value="<?php if (!empty($voucher_no[0]['voucher'])) {
                                                                                        $vn = substr($voucher_no[0]['voucher'], 3) + 1;
                                                                                        echo $voucher_n = 'DV-' . $vn;
                                                                                    } else {
                                                                                        echo $voucher_n = 'DV-1';
                                                                                    } ?>" class="form-control"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ac" class="col-sm-2 col-form-label"><?php echo display('credit_account_head') ?>
                                <i class="text-danger">*</i>
                            </label>
                            <div class="col-sm-4">
                                <select name="cmbDebit" id="cmbDebit" class="form-control" required="">
                                    <?php if (!empty($crcc)) {
                                        foreach ($crcc as $cracc) { ?>
                                    <option value="<?php echo $cracc->HeadCode ?>">
                                        <?php echo html_escape($cracc->HeadName) ?></option>
                                    <?php  }
                                    } else { ?>
                                    <option value='1111'> Cash in box general administration(صندوق الإدارة العامة)
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-sm-2 col-form-label"><?php echo display('date') ?>
                                <i class="text-danger">*</i>
                            </label>
                            <div class="col-sm-4">
                                <input type="text" name="dtpDate" id="dtpDate" class="form-control"
                                    value="<?php echo date('Y-m-d'); ?>" required>
                                <input type="hidden" name="limitDate" id="limitDate" class="form-control"
                                    value="<?php echo  date('Y-m-d') ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtRemarks"
                                class="col-sm-2 col-form-label"><?php echo display('remark') ?></label>
                            <div class="col-sm-4">
                                <textarea name="txtRemarks" id="txtRemarks" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="debtAccVoucher">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('account_name') ?><i
                                                class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('code') ?></th>
                                        <th class="text-center"><?php echo display('amount') ?><i
                                                class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="debitvoucher">
                                    <tr>
                                        <td class="" width="200">
                                            <select name="cmbCode[]" id="cmbCode_1" class="form-control"
                                                onchange="load_dbtvouchercode(this.value,1)" required="">
                                                <option value="">Please select One</option>
                                                <?php foreach ($acc as $acc1) { ?>
                                                <option value="<?php echo $acc1->HeadCode; ?>">
                                                    <?php echo html_escape($acc1->HeadName); ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="txtCode[]" value="" class="form-control "
                                                id="txtCode_1" readonly="">
                                        </td>
                                        <td>
                                            <input type="number" name="txtAmount[]" value=""
                                                class="form-control total_price text-right" id="txtAmount_1"
                                                onkeyup="dbtvouchercalculation(1)" required="">
                                        </td>
                                        <td>
                                            <button class="btn btn-danger red text-right" type="button"
                                                value="<?php echo display('delete') ?>"
                                                onclick="deleteRowdbtvoucher(this)">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>

                                        </td>
                                        <td colspan="1" class="text-right"><label for="reason"
                                                class="  col-form-label"><?php echo display('total') ?></label>
                                        </td>
                                        <td class="text-right">
                                            <input type="text" id="grandTotal" class="form-control text-right "
                                                name="grand_total" value="" readonly="readonly" />
                                        </td>
                                        <td> <a id="add_more" class="btn btn-info" name="add_more"
                                                onClick="addaccountdbt('debitvoucher')"><i class="fa fa-plus"></i></a>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 text-right">
                                <input type="submit" id="add_receive" class="btn btn-success btn-large" name="save"
                                    value="<?php echo display('save') ?>" tabindex="9" />
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                    <input type="hidden" id="headoption"
                        value="<option value=''>Select One</option><?php foreach ($acc as $acc2) { ?><option value='<?php echo html_escape($acc2->HeadCode); ?>'><?php echo html_escape($acc2->HeadName); ?></option><?php } ?>"
                        name="">
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('accounting/components/debit_voucher_js') ?>