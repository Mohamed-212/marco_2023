<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Manage Customer Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('attendance') ?></h1>
            <small><?php echo $title ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('attendance') ?></a></li>
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
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('manage_attendance') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover datatable">
                                <thead>
                                <tr>
                                    <th><?php echo display('Sl') ?></th>
                                    <th><?php echo display('name') ?></th>
                                    <th><?php echo display('date') ?></th>
                                    <th><?php echo display('checkin') ?></th>
                                    <th><?php echo display('checkout') ?></th>
                                    <th><?php echo display('stay') ?></th>
                                    <th><?php echo display('action') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if ($attendance_list == FALSE): ?>

                                    <tr>
                                        <td colspan="7" class="text-center">There are currently No Attendance</td>
                                    </tr>
                                <?php else: ?>
                                    <?php $sl = 1; ?>
                                    <?php foreach ($attendance_list as $row): ?>
                                        <tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>">
                                            <td><?php echo $sl; ?></td>
                                            <td><?php echo html_escape($row['first_name']) . ' ' . html_escape($row['last_name']); ?></td>
                                            <td><?php echo html_escape($row['date']); ?></td>
                                            <td><?php echo html_escape($row['sign_in']); ?></td>
                                            <td><?php
                                                if (!empty($row['sign_out'])) {
                                                    echo html_escape($row['sign_out']);
                                                } else {
                                                    ?>
                                                    <a href='javascript:void(0)' class='btn btn-primary btn-xs'
                                                       onclick='signout("<?php echo $row['att_id'] ?>","<?php echo $row['sign_in'] ?>")'><?php echo display('sign_out') ?></a>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo html_escape($row['staytime']); ?></td>
                                            <td>
                                                <center>
                                                <?php if ($this->permission->method('manage_attendance', 'update')->access()){ ?>
                                                    <a href="<?php echo base_url("hrm/attendance/bdtask_edit_attendance/" . $row['att_id']) ?>"
                                                       class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                                <?php } ?>
                                                <?php if ($this->permission->check_label('manage_attendance', 'delete')->access()){ ?>
                                                    <a href="<?php echo base_url("hrm/attendance/bdtask_delete_attendance/" . $row['att_id']) ?>"
                                                       class="btn btn-sm btn-danger"
                                                       onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i
                                                                class="fa fa-times" aria-hidden="true"></i></a>
                                                <?php } ?>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php $sl++; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>

                            <div class="text-right"><?php echo $links ?></div>
                            <!-- /.table-responsive -->


                        </div>
                    </div>
                </div>
            </div>

            <div id="signoutModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <strong>
                                <center> <?php echo display('sign_out') ?></center>
                            </strong>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="panel panel-bd">

                                        <div class="panel-body">

                                            <?php echo form_open('hrm/attendance/sign_out/', 'id="add_signout"') ?>
                                            <input name="attendance_id" id="att_id" type="hidden" value="">
                                            <div class="form-group row">
                                                <label for="sign_in"
                                                       class="col-sm-3 col-form-label"><?php echo display('sign_in') ?> </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="sign_in" class="form-control timepicker"
                                                           id="sign_inss" readonly="">

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="sign_out"
                                                       class="col-sm-3 col-form-label"><?php echo display('sign_out') ?> </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="sign_out" class="form-control timepicker2"
                                                           id="sign_out" autocomplete="false" value="<?php echo date('h:i a'); ?>" required="">

                                                </div>
                                            </div>

                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-danger" data-dismiss="modal">
                                                    &times; Cancel
                                                </button>
                                                <button type="submit"
                                                        class="btn btn-primary"><?php echo display('confirm') ?></button>
                                            </div>

                                            <?php echo form_close() ?>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">

                    </div>

                </div>

            </div>

        </div>
    </section>
</div>


<script type="text/javascript">
    "use strict";

    function signout(att_id, sign_ins) {
        document.getElementById('att_id').value = att_id;
        document.getElementById('sign_inss').value = sign_ins;
        $("#signoutModal").modal('show');
    }


    $(document).ready(function () {
        "use strict";
        var frm = $("#add_signout");
        frm.on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                dataType: 'json',
                data: frm.serialize(),
                success: function (data) {

                    if (data.status == true) {
                        toastr["success"](data.message);
                        setTimeout(function () {
                        }, 1000);
                        location.reload();

                    } else {
                        toastr["error"](data.exception);
                    }
                },
                error: function (xhr) {
                    alert('failed!');
                }
            });
        });
    });
</script>