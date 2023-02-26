<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Supplier Ledger Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('supplier_ledger') ?></h1>
            <small><?php echo display('manage_supplier_ledger') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('supplier') ?></a></li>
                <li class="active"><?php echo display('supplier_ledger') ?></li>
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
                    <?php if ($this->permission->check_label('add_supplier')->create()->access()) { ?>
                        <a href="<?php echo base_url('dashboard/Csupplier') ?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-plus"> </i> <?php echo display('add_supplier') ?></a>
                    <?php }
                    if ($this->permission->check_label('manage_supplier')->read()->access()) {
                    ?>
                        <a href="<?php echo base_url('dashboard/Csupplier/manage_supplier') ?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i>
                            <?php echo display('manage_supplier') ?></a>
                    <?php } ?>

                </div>
            </div>
        </div>

        <!-- Supplier select -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo form_open('dashboard/Csupplier/supplier_ledger_report', array('class' => 'form-inline')); ?>
                        <div class="form-group">
                            <label for="supplier_name"><?php echo display('select_supplier') ?><span class="text-danger">*</span>:</label>
                            <select class="form-control" name="supplier_id" id="supplier_id">
                                <?php foreach ($suppliers_list as $sub) : ?>
                                    <option value=""></option>
                                    <option value="<?= $sub['supplier_id'] ?>" <?= $supplier_id == $sub['supplier_id'] ? 'selected' : '' ?>><?= $sub['supplier_name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="from_date"><?php echo display('from_date') ?><span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control datepicker2" autocomplete="off" placeholder="<?php echo display('from_date'); ?>" name="from_date" value="<?= $from_date ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="to_date"><?php echo display('to_date') ?><span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control datepicker2" autocomplete="off" placeholder="<?php echo display('to_date'); ?>" name="to_date" value="<?= $to_date ?>" required>
                        </div>
                        <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
                        <button type="submit" formaction="<?= base_url('dashboard/Csupplier/supplier_ledger_report_print') ?>" class="btn btn-primary"><?php echo display('print') ?></button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if ($supplier_name) {
        ?>

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4><?php echo display('supplier_information') ?></h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="ft_left">
                                <h4>{supplier_name}</h4>
                            </div>
                            <div class="ft_right mr_100">
                                <table class="table table-striped table-condensed table-bordered">
                                    <tr>
                                        <td> <?php echo display('debit_ammount') ?> </td>
                                        <td> <?php
                                                if ($total_debit) {
                                                    echo (($position == 0) ? "$currency {total_debit}" : "{total_debit} $currency");
                                                } else {
                                                    echo (($position == 0) ? "$currency 00" : " 00 $currency");
                                                }
                                                ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo display('credit_ammount') ?></td>
                                        <td class="balance_txt">
                                            <?php
                                            if ($total_credit) {
                                                echo (($position == 0) ? "$currency {total_credit}" : "{total_credit} $currency");
                                            } else {
                                                echo (($position == 0) ? "$currency 00" : " 00 $currency");
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo display('balance_ammount') ?> </td>
                                        <td class="balance_txt">
                                            <?php
                                            if ($total_balance) {
                                                echo (($position == 0) ? "$currency {total_balance}" : "{total_balance} $currency");
                                            } else {
                                                echo (($position == 0) ? "$currency 00" : " 00 $currency");
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Manage Supplier -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4><?php echo display('supplier_ledger') ?></h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                                    <thead>

                                        <!-- <tr>
                                            <th colspan="9" class="text-center">
                                                Date : {from_date} - {to_date}
                                            </th>
                                        </tr>

                                        <tr>
                                            <th colspan="2" class="text-right">Supplier's Commercial Registration Number:
                                            </th>
                                            <th colspan="1" class="text-left">{cr_no}</th>
                                            <th colspan="1" class="text-right">Mobile Number:</th>
                                            <th colspan="1" class="text-left">{supplier_mobile}</th>
                                            <th colspan="2" class="text-right">Supplier TAX Number:</th>
                                            <th colspan="1" class="text-left">{vat_no}</th>
                                        </tr>

                                        <tr>
                                            <th class="text-center">NO</th>
                                            <th class="text-center">The Document</th>
                                            <th class="text-center">Document Number</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Debit</th>
                                            <th class="text-center">Credit</th>
                                            <th class="text-center">Balance</th>
                                            <th class="text-center">Notes</th>
                                        </tr> -->
                                        <tr>
                                            <th><?php echo display('date') ?></th>
                                            <th><?php echo display('transaction_type') ?></th>
                                            <th class="text-right mr_20"><?php echo display('debit') ?></th>
                                            <th class="text-right mr_20"><?php echo display('credit') ?></th>
                                            <th class="text-right mr_20"><?php echo display('balance') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // $this->db->select('a.HeadCode,b.*');
                                        // $this->db->from('acc_coa a');
                                        // $this->db->where('a.supplier_id', $supplier_id);
                                        // $this->db->join('acc_transaction b', 'b.COAID=a.HeadCode', 'left');
                                        // $this->db->where('b.is_opening', 1);
                                        // $supplier_openning_info = $this->db->get()->row();
                                        ?>
                                        <?php
                                        if (!empty($supplier_openning_info)) {
                                        ?>
                                            <!-- <tr>
                                                <td class="text-center">1</td>
                                                <td><?php echo html_escape($supplier_openning_info->Vtype) ?></td>
                                                <td><?php echo $supplier_openning_info->ID ?></td>
                                                <td><?php echo html_escape($supplier_openning_info->VDate) ?></td>
                                                <td class="text-right">
        <?php echo (($position == 0) ? $currency . " " . $supplier_openning_info->Debit : $supplier_openning_info->Debit . " " . $currency) ?>
                                                </td>
                                                <td class="text-right">
                                            <?php echo (($position == 0) ? $currency . " " . $supplier_openning_info->Credit : $supplier_openning_info->Credit . " " . $currency) ?>
                                                </td>
                                                <td class="text-right"><?= $supplier_openning_info->Debit - $supplier_openning_info->Credit ?></td>
                                                <td><?php echo html_escape($supplier_openning_info->Narration) ?></td>
                                            </tr> -->
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($ledger) {
                                            $total_sup_debit = $total_sup_credit = $total_sup_balance = 0;
                                            foreach ($ledger as $key => $ledger) {
                                                $invoice = $this->db->select('invoice')->from('product_purchase')->where('purchase_id', $ledger['purchase_id'])->get()->row();
                                        ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <?= date('d-m-Y', strtotime($ledger['sl_created_at'])) ?>
                                                    </td>
                                                    <!-- <td>
                                                        <?php
                                                        $transaction_info = $this->db->select('Vtype,Narration')->from('acc_transaction')->where('VNo', $ledger['invoice'])->get()->row();
                                                        if (!empty($transaction_info)) {
                                                            echo $transaction_info->Vtype;
                                                        }
                                                        ?>
                                                    </td> -->
                                                    <td>
                                                        <?php if (empty($invoice)) : ?>
                                                            <?php
                                                                if (empty($ledger['voucher'])) {
                                                                    echo display('previous_balance');
                                                                } else {
                                                                    if ($ledger['voucher'] == 'JV') {
                                                                        echo display('journal_voucher');
                                                                    }
                                                                    if ($ledger['voucher'] == 'CV') {
                                                                        echo display('debit_voucher');
                                                                    }
                                                                    if ($ledger['voucher'] == 'return') {
                                                                        echo display('purchase_return');
                                                                    }
                                                                }
                                                            ?>
                                                        <?php else : ?>
                                                            <a href="<?php echo base_url() . 'dashboard/Cpurchase/purchase_details_data/' . $ledger['purchase_id']; ?>"><?php echo $invoice->invoice; ?>
                                                                <i class="fa fa-tasks pull-right" aria-hidden="true"></i></a>
                                                        <?php endif ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php $total_sup_debit += ((empty($ledger['debit'])) ? 0 : $ledger['debit']);
                                                        echo (($position == 0) ? $currency . " " . ((empty($ledger['debit'])) ? 0 : $ledger['debit']) : ((empty($ledger['debit'])) ? 0 : $ledger['debit']) . " " . $currency)
                                                        ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php $total_sup_credit += ((empty($ledger['credit'])) ? 0 : $ledger['credit']);
                                                        echo (($position == 0) ? $currency . " " . $ledger['credit'] : $ledger['credit'] . " " . $currency)
                                                        ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php $total_sup_balance += ((empty($ledger['balance'])) ? 0 : $ledger['balance']);
                                                        echo (($position == 0) ? $currency . " " . $ledger['balance'] : $ledger['balance'] . " " . $currency)
                                                        ?>
                                                    </td>
                                                    <!-- <td><?php
                                                                if (!empty($transaction_info)) {
                                                                    echo html_escape($transaction_info->Narration);
                                                                }
                                                                ?>
                                                    </td> -->
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>--</td>
                                            <th class="text-center"><?= display('grand_total') ?></th>
                                            <th class="text-center"><?php echo html_escape($total_sup_debit); ?></th>
                                            <th class="text-center"><?php echo html_escape($total_sup_credit); ?></th>
                                            <th class="text-center"><?php echo html_escape($total_sup_debit - $total_sup_credit); ?></th>
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
<!-- Supplier Ledger End -->
<script>
    $(document).ready(function() {
        $(".datepicker2").datepicker({
            dateFormat: "dd-mm-yy"
        });
    });
</script>