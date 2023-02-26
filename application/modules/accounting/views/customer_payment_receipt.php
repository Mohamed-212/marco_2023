<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-bd">
            <div id="printableArea">
                <div class="panel-body">
                    <div bgcolor='#e4e4e4' text='#ff6633' link='#666666' vlink='#666666' alink='#ff6633' class="phdiv">
                        <table border="0" width="100%">
                            <tr>
                                <td>
                                    <table border="0" width="100%">
                                        <tr>
                                            <td align="center">
                                                <span class="company-txt">
                                                    <?php echo html_escape($company_info[0]['company_name']) ?>
                                                </span><br>
                                                <?php echo html_escape($company_info[0]['address']) ?><br>
                                                <?php echo html_escape($company_info[0]['mobile']) ?><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                <b><?php echo  html_escape($customer_info[0]['customer_name']); ?></b><br>
                                                <?php if ($customer_info[0]['customer_address']) { ?>
                                                <?php echo  html_escape($customer_info[0]['customer_address']); ?><br>
                                                <?php } ?>
                                                <?php if ($customer_info[0]['customer_mobile']) { ?>
                                                <?php echo  html_escape($customer_info[0]['customer_mobile']); ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                <nobr>
                                                    <date>
                                                        <?php echo  display('date') ?>:
                                                        <?php echo  html_escape($payment_info[0]['VDate']) ?>
                                                    </date>
                                                </nobr>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">
                                                <?php echo display('voucher_no'); ?> :
                                                <?php echo  html_escape($payment_info[0]['VNo']) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">
                                                <?php echo display('payment_type'); ?> : <?php echo  'Receive'; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">
                                                <?php echo display('amount'); ?> :
                                                <?php echo  html_escape($payment_info[0]['Credit']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left"><?php echo display('remark'); ?> :
                                                <?php echo  html_escape($payment_info[0]['Narration']); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            <tr>
                                <td> <?php echo display('paid_by') ?>:
                                    <?php echo  $this->session->userdata('user_name'); ?>
                                    <div class="psigpart">
                                        <?php echo display('signature') ?>
                                    </div>
                                </td>
                            </tr>
                            </tr>
                            <tr>
                                <td>Powered By:
                                    <a href="javascript:void(0)">
                                        <?php echo html_escape($company_info[0]['company_name']) ?>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel-footer text-left">
                <a class="btn btn-danger"
                    href="<?php echo base_url('customer_receive'); ?>"><?php echo display('cancel') ?></a>
                <a class="btn btn-info" href="#" onclick="printDiv('printableArea')"><span
                        class="fa fa-print"></span></a>

            </div>
        </div>
    </div>
</div>