<link rel="stylesheet" href="<?php echo MOD_URL.'accounting/assets/js/jstree/themes/default/style.min.css'; ?>" />

<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Add new block start -->
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
        <!-- New customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('chart_of_account') ?> </h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-11">
                                <div id="coa_jstree">
                                    <ul>
                                        <?php
                                            $itemTotal = array_fill(0, count($itemList), FALSE);
                                            $this->account_model->dfs("COA","0",$itemList,$itemTotal,0);
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="treeviewmodal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="newform"> </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo MOD_URL.'accounting/assets/js/jstree/jstree.min.js'; ?>"></script>
<script src="<?php echo MOD_URL.'accounting/assets/js/treeview.js'; ?>"></script>