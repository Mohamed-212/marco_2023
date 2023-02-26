<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Customer Ledger Start  -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('customer_ledger') ?></h1>
            <small><?php echo display('manage_customer_ledger') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('customer') ?></a></li>
                <li class="active"><?php echo display('customer_ledger') ?></li>
            </ol>
        </div>
    </section>

    <!-- Supplier information -->
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

        <div class="row">
            <div class="col-sm-12">
                <div class="column">
                    <?php if ($this->permission->check_label('add_customer')->create()->access()) { ?>
                    <a href="<?php echo base_url('dashboard/Ccustomer') ?>" class="btn btn-success m-b-5 m-r-2"><i
                            class="ti-plus"> </i><?php echo display('add_customer') ?></a>
                    <?php }
                    if ($this->permission->check_label('manage_customer')->read()->access()) { ?>
                    <a href="<?php echo base_url('dashboard/Ccustomer/manage_customer') ?>"
                        class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify">
                        </i><?php echo display('manage_customer') ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo form_open("dashboard/Ccustomer/customer_ledger_report", array('class' => 'form-inline')); ?>
                        <div class="form-group">
                            <label for="customer_id"><?php echo display('customer') ?><span
                                    class="text-danger">*</span>:</label>
                            <select class="form-control" name="customer_id" id="customer_id" required>
                                {customers_list}
                                <option value=""></option>
                                <option value="{customer_id}">{customer_name}</option>
                                {/customers_list}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="from_date"><?php echo display('from_date') ?><span
                                    class="text-danger">*</span>:</label>
                            <input type="text" class="form-control datepicker2" autocomplete="off"
                                placeholder="<?php echo display('from_date'); ?>" name="from_date" required>
                        </div>
                        <div class="form-group">
                            <label for="to_date"><?php echo display('to_date') ?><span
                                    class="text-danger">*</span>:</label>
                            <input type="text" class="form-control datepicker2" autocomplete="off"
                                placeholder="<?php echo display('to_date'); ?>" name="to_date" required>
                        </div>
                        <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($customer_name) { ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('customer_information') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="ft_left">
                            {company_info}
                            <h5><u> {company_name}</u></h5>
                            {/company_info}
                            <?php echo display('customer_name') ?> : {customer_name} <br>
                            <?php if (!empty($customer_address)) { ?>
                            <?php echo display('customer_address') ?> : {customer_address}<br>
                            <?php } else { ?>
                            <?php echo display('customer_address') ?> : {customer_address_1}<br>
                            <?php } ?>
                            <?php echo display('mobile') ?> : {customer_mobile}
                        </div>
                        <div class="ft_right_mr_100">
                            <table class="table table-striped table-condensed table-bordered">
                                <tr>
                                    <td> <?php echo display('debit_ammount') ?> </td>
                                    <td class="ta_right_mr_20">
                                        <?php echo (($position == 0) ? "$currency {total_debit}" : "{total_debit} $currency") ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo display('credit_ammount'); ?></td>
                                    <td class="ta_right_mr_20">
                                        <?php echo (($position == 0) ? "$currency {total_credit}" : "{total_credit} $currency") ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo display('balance_ammount'); ?> </td>
                                    <td class="ta_right_mr_20">
                                        <?php echo (($position == 0) ? "$currency {total_balance}" : "{total_balance} $currency") ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manage Customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('customer_ledger') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                                <thead>

                                    <tr>
                                        <th colspan="9" class="text-center">
                                            Date From : {from_date} - To: {to_date}
                                        </th>
                                    </tr>

                                    <tr>
                                        <th colspan="3" class="text-right">Customer's Commercial Registration Number:
                                        </th>
                                        <th colspan="2" class="text-left">{cr_no}</th>
                                        <th colspan="2" class="text-right">Customer TAX Number:</th>
                                        <th colspan="2" class="text-left">{vat_no}</th>
                                    </tr>

                                    <tr>
                                        <th>NO</th>
                                        <!-- <th>The Document</th> -->
                                        <th><?php echo display('date') ?></th>
                                        <th><?php echo display('invoice_no') ?></th>
                                        <th><?php echo display('receipt_no') ?></th>
                                        <th><?php echo display('debit') ?></th>
                                        <th><?php echo display('credit') ?></th>
                                        <th><?php echo display('balance') ?></th>
                                        <!-- <th>Mobile Number</th> -->
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $this->db->select('a.HeadCode,b.*');
                                        $this->db->from('acc_coa a');
                                        $this->db->where('a.customer_id', $customer_id);
                                        $this->db->join('acc_transaction b', 'b.COAID=a.HeadCode', 'left');
                                        $this->db->where('b.is_opening', 1);
                                        $customer_openning_info = $this->db->get()->row();
                                        ?>
                                    <?php
                                        if (!empty($customer_openning_info)) {
                                        ?>
                                    <tr>
                                        <td>1</td>
                                        <td><?php echo html_escape($customer_openning_info->Vtype) ?></td>
                                        <td><?php echo html_escape($customer_openning_info->ID) ?></td>
                                        <td><?php echo html_escape($customer_openning_info->VDate) ?></td>
                                        <td class="text-right">
                                            <?php echo (($position == 0) ? $currency . " " . $customer_openning_info->Debit : $customer_openning_info->Debit . " " . $currency) ?>
                                        </td>
                                        <td class="text-right">
                                            <?php echo (($position == 0) ? $currency . " " . $customer_openning_info->Credit : $customer_openning_info->Credit . " " . $currency) ?>
                                        </td>
                                        <td class="text-right"></td>
                                        <td></td>
                                        <td><?php echo html_escape($customer_openning_info->Narration) ?></td>
                                    </tr>
                                    <?php
                                        }
                                        ?>
                                    <?php
                                        if ($ledger) {
                                            $total_cus_debit = $total_cus_credit = $total_cus_balance = 0;
                                            foreach ($ledger as $key => $ledger) {
                                        ?>
                                    <tr>
                                        <td><?php echo ((!empty($customer_openning_info)) ? $key + 2 : $key + 1); ?>
                                        </td>
                                        <td><?php echo html_escape($ledger['final_date']); ?></td>
                                        <!-- <td>
                                            <?php
                                                        $transaction_info = $this->db->select('Vtype,Narration')->from('acc_transaction')->where('VNo', $ledger['invoice_no'])->get()->row();
                                                        echo ($transaction_info) ? $transaction_info->Vtype : '';
                                                        ?>
                                        </td> -->
                                        <td>
                                            <?php if ($this->permission->check_label('new_sale')->access()) { ?>
                                            <a
                                                href="<?php echo base_url() . 'dashboard/Cinvoice/invoice_inserted_data/' . $ledger['invoice_no']; ?>">
                                                <?php echo html_escape($ledger['invoice']); ?> <i
                                                    class="fa fa-tasks pull-right" aria-hidden="true"></i>
                                            </a>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php echo html_escape($ledger['receipt_no']); ?>
                                        </td>
                                        
                                        <td class="text-right">
                                            <?php $total_cus_debit += ((empty($ledger['debit'])) ? 0 : $ledger['debit']);
                                                        echo (($position == 0) ? $currency . " " . $ledger['debit'] : $ledger['debit'] . " " . $currency) ?>
                                        </td>
                                        <td class="text-right">
                                            <?php $total_cus_credit += ((empty($ledger['credit'])) ? 0 : $ledger['credit']);
                                                        echo (($position == 0) ? $currency . " " . $ledger['credit'] : $ledger['credit'] . " " . $currency) ?>
                                        </td>
                                        <td class="text-right">
                                            <?php $total_cus_balance += ((empty($ledger['balance'])) ? 0 : $ledger['balance']);
                                                        echo (($position == 0) ? $currency . " " . $ledger['balance'] : $ledger['balance'] . " " . $currency) ?>
                                        </td>
                                        <!-- <td>
                                            <?php
                                                        $customer_info = $this->db->select('customer_mobile')->from('customer_information')->where('customer_id', $ledger['customer_id'])->get()->row();
                                                        echo html_escape($customer_info->customer_mobile);
                                                        ?>
                                        </td> -->
                                        <td><?php echo ($transaction_info) ? $transaction_info->Narration : ''; ?></td>
                                    </tr>
                                    <?php  } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center" colspan="4">Total</th>
                                        <td class="text-center"><?php echo html_escape($total_cus_debit); ?></td>
                                        <td class="text-center"><?php echo html_escape($total_cus_credit); ?></td>
                                         <td class="text-center"><?php echo html_escape($total_cus_credit - $total_cus_debit); ?></td>
                                        <td colspan="2"></td>

                                    </tr>
                                </tfoot>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </section>
</div>
<!-- Customer Ledger End  -->
<script>
    $(document).ready(function() {
        $(".datepicker2").datepicker({
			dateFormat: "dd-mm-yy"
		});
    });
</script>