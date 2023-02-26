<script src="<?php echo MOD_URL . 'dashboard/assets/js/print.js'; ?>"></script>

<!-- Sales Report Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('sales_report') ?></h1>
            <small><?php echo display('total_sales_report') ?></small>
            <ol class="breadcrumb">
                <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('report') ?></a></li>
                <li class="active"><?php echo display('sales_report') ?></li>
            </ol>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="column">
                    <?php if ($this->permission->check_label('purchase_report')->read()->access()) { ?>
                        <a href="<?php echo base_url('dashboard/Admin_dashboard/todays_purchase_report') ?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i>
                            <?php echo display('purchase_report') ?> </a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- Sales report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo form_open('dashboard/Admin_dashboard/retrieve_dateWise_SalesReports', array('class' => 'form-class="form-horizontal')) ?>
                        <?php
                        date_default_timezone_set(DEF_TIMEZONE);
                        $today = date('d-m-Y');
                        ?>
                        <div class="row">
                        <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="" for="from_date"><?php echo display('start_date') ?></label>
                                    <input type="text" name="from_date" class="form-control datepicker2" id="from_date" placeholder="<?php echo display('start_date') ?>" autocomplete="off">
                                </div>
                            </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="" for="to_date"><?php echo display('end_date') ?></label>
                                        <input type="text" name="to_date" class="form-control datepicker2" id="to_date" placeholder="<?php echo display('end_date') ?>" value="<?php echo $today ?>" autocomplete="off">
                                    </div>
                                </div>
                        </div>
                            <!--  -->
                        <div class="row mt-2" style="margin-top: 7px;margin-bottom: 7px;">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="" for="employee_name"><?php echo display('employee_name') ?></label>
                                    <input type="text" name="employee_name" class="form-control employeeSelection" id="city" placeholder="<?php echo display('employee_name') ?>" onclick="employeeList();" value="" autocomplete="off">

                                </div>
                                <input hidden type="hidden" class="employee_hidden_value" name="employee_id" />
                            </div>
                            
                        </div>
                        <div class="row">
                        <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="" for="city"><?php echo display('city') ?></label>
                                    <input type="text" name="city_name_input" class="form-control citySelection" id="city" placeholder="<?php echo display('city_name') ?>" onclick="cityList();" value="" autocomplete="off">
                                </div>
                                <input hidden type="hidden" class="city_hidden_value" name="city_name" />
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
                                <!-- <a class="btn btn-warning" href="#" onclick="printDiv('purchase_div')"><?php echo display('print') ?></a> -->
                                <?php echo form_close() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('sales_report') ?> </h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div id="purchase_div" class="ml_2">
                            <div class="text-center">
                                {company_info}
                                <h3> {company_name} </h3>
                                <h4>{address} </h4>
                                {/company_info}
                                <h4> <?php echo display('print_date') ?>: <?php echo date("d/m/Y h:i:s"); ?> </h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTablePagination">
                                    <thead>
                                        <tr>
                                            <th><?php echo display('sales_date') ?></th>
                                            <th><?php echo display('invoice_no') ?></th>
                                            <th><?php echo display('customer_name') ?></th>
                                            <th><?php echo display('total_amount') ?></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-right">
                                                <b><?php echo display('total_seles') ?></b>
                                            </td>
                                            <td class="text-right">
                                                <b><?php echo (($position == 0) ? "$currency {sales_amount}" : "{sales_amount} $currency") ?></b>
                                            </td>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        if ($sales_report) {
                                        ?>
                                            <?php foreach ($sales_report as $repo) :  $repo = (object)$repo; ?>
                                            <tr>
                                                <td>
                                                    <?=date('d-m-Y', strtotime($repo->created_at))?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo base_url() . 'dashboard/Cinvoice/invoice_inserted_data/' . $repo->invoice_id; ?>">
                                                        <?=$repo->invoice?> <i class="fa fa-tasks pull-right" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                <td><a href="<?php echo base_url() . 'dashboard/Ccustomer/customerledger/' . $repo->customer_id; ?>">
                                                        <?=$repo->customer_name?> <i class="fa fa-user pull-right" aria-hidden="true"></i></a></td>
                                                <td class="text-right">
                                                    <?php echo (($position == 0) ? "$currency {$repo->total_amount}" : "{$repo->total_amount} $currency") ?>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="text-right"><?php echo htmlspecialchars_decode($links) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Sales Report End -->
<script>
    var csrf_test_name = $("#CSRF_TOKEN").val();

    function employeeList() {
        $(".employeeSelection").autocomplete({
            //source: productList,
            source: function(request, response) {
                $.ajax({
                    url: base_url + "dashboard/Creport/search_all_employees",
                    method: "post",
                    dataType: "json",
                    data: {
                        csrf_test_name: csrf_test_name,
                        name: request.term,
                    },
                    success: function(data) {
                        console.log(data);
                        response(data);
                    },
                });
            },
            delay: 300,
            focus: function(event, ui) {
                $(".employee_hidden_value").val(ui.item.value);
                $(this).val(ui.item.label);
                return false;
            },
            select: function(event, ui) {
                $(".employee_hidden_value").val(ui.item.value);
                $(this).val(ui.item.label);
                $(this).unbind("change");
                return false;
            }
        });
        var APchange = function(event, ui) {
            $(this).data("autocomplete").menu.activeMenu.children(":first-child").trigger("click");
        }
        $(".employeeSelection").focus(function() {
            $(this).change(APchange);
        });
    }

    function cityList() {
        $(".citySelection").autocomplete({
            //source: productList,
            source: function(request, response) {
                $.ajax({
                    url: base_url + "dashboard/Creport/search_all_cities",
                    method: "post",
                    dataType: "json",
                    data: {
                        csrf_test_name: csrf_test_name,
                        name: request.term,
                    },
                    success: function(data) {
                        console.log(data);
                        response(data);
                    },
                });
            },
            delay: 300,
            focus: function(event, ui) {
                $(".city_hidden_value").val(ui.item.value);
                $(this).val(ui.item.value);
                return false;
            },
            select: function(event, ui) {
                $(".city_hidden_value").val(ui.item.value);
                $(this).val(ui.item.value);
                $(this).unbind("change");
                return false;
            }
        });
        var APchange = function(event, ui) {
            $(this).data("autocomplete").menu.activeMenu.children(":first-child").trigger("click");
        }
        $(".citySelection").focus(function() {
            $(this).change(APchange);
        });
    }
</script>
<script>
	$(document).ready(function() {
		$(".datepicker2").datepicker({
			dateFormat: "dd-mm-yy"
		});
	});
</script>