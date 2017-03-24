<?php $this->layout('layouts::admin/default') ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">

            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-group"></i> Groups</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <?php if (count($groups)): ?>
                            <?php foreach ($groups as $group): ?>
                                <li <?php
                                if (!isset($get['gid']) && !isset($get['uid'])) {
                                    if (strtolower($this->a($group, 'name')) == strtolower($ci_object->aauth_config['group']['default_group'])) {
                                        echo "class=active";
                                    }
                                } elseif (isset($group['id']) && isset($get['gid'])) {
                                    if ($group['id'] == $get['gid']) {
                                        echo "class=active";
                                    }
                                }
                                ?> ><a href="<?php echo gen_url('auth/allot', array('gid' => $this->a($group, 'id'))); ?>"> <?php echo $this->a($group, 'name'); ?></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>

            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-user"></i> Users</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <table id="allotUserTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>User Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td <?php
                                        if (isset($user['id']) && isset($get['uid'])) {
                                            if ($user['id'] == $get['uid']) {
                                                echo "class=active";
                                            }
                                        }
                                        ?>>
                                            <a href="<?php echo gen_url('auth/allot', array('uid' => $this->a($user, 'id'))); ?>"> <?php echo $this->a($user, 'username'); ?></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary" id="permBox">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-key"></i> Permissions</h3>
                </div>

                <form action="<?php echo gen_url('auth/allot/save'); ?>" method="post">
                    <input type="hidden" name="uid" value="<?php echo $this->a($get, 'uid'); ?>" />
                    <input type="hidden" name="gid" value="<?php echo $this->a($get, 'gid'); ?>" />

                    <table id="permsTable" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th><button type="button" class="btn btn-default btn-sm checkbox-toggle" /><i class="fa fa-square-o"></i></th>
                                <th>Name</th>
                                <th>Definition</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($perms)): ?>
                                <?php foreach ($perms as $perm): ?>
                                    <tr>
                                        <td width="5%"><input type="checkbox" <?php
                                            if (isset($perm['id'])) {
                                                if (in_array($perm['id'], $selected_perms)) {
                                                    echo " checked=checked ";
                                                }
                                            }
                                            ?> name="pid[<?php echo $this->a($perm, 'id'); ?>]"></td>
                                        <td width="30%" class=""><?php echo $this->a($perm, 'name'); ?></td>
                                        <td width="50%" class=""><?php echo $this->a($perm, 'definition'); ?></td>
                                        <td width="15%" class=""><?php echo $this->a($perm, 'type'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="col-md-5"></div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-primary" type="submit" id="allotSaveButton">Save</button>
                    </div>
                </form>
                <div id="allotSaveAfter"></div>
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->


<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<!--<div class="control-sidebar-bg"></div>-->

<!-- ./wrapper -->

<?php $this->start('style') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= asset_admin_url('plugins/datatables/dataTables.bootstrap.css') ?>">
<!-- iCheck -->
<link rel="stylesheet" href="<?= asset_admin_url('plugins/iCheck/flat/blue.css') ?>">
<style type="text/css">
    /*    #allotUserTable_wrapper .row{
            margin: 0px;
        }*/
    #allotUserTable_wrapper .row .col-sm-6:first-child{
        display: none;
    }
    #allotUserTable_wrapper .row .col-sm-6:last-child{
        width: 100%;
    }
    #allotUserTable_wrapper label{
        margin-bottom:0px;
        display: block;
    }
    #allotUserTable_wrapper label input{
        width: 100%;
    }
    #allotUserTable_wrapper .row .col-sm-5{
        display: none;
    }
    #allotUserTable_wrapper .row .col-sm-7{
        width: 100%;
    }
    #allotUserTable{
        margin: 0px !important;
    }
    #allotUserTable_wrapper .pagination{
        margin: 0 auto;
        float: right;
    }
    #allotUserTable_wrapper:after{
        clear: both;
    }
    #allotUserTable_wrapper .pagination > li > a,#allotUserTable_wrapper .pagination > li > span{
        padding: 6px 11px;
    }
    #allotUserTable_wrapper td.active{
        border-left: 3px solid #3c8dbc;
    }
    #allotUserTable_wrapper td a{
        color: #444;
        padding: 10px 8px;
        display: block;
    }
    #allotUserTable_wrapper .table-striped > tbody > tr:nth-of-type(2n+1){
        background: none;
    }
    #allotUserTable_wrapper div.dataTables_filter input{
        margin-left: 0px;
    }
    #allotUserTable td .active{
        font-weight: 700;
    }
    #permsTable_wrapper{
        margin: 5px 0px;
    }
    #permsTable_wrapper .row{
        margin-left: -5px;
        margin-right: -5px;
    }
    #permsTable_wrapper thead th{
        vertical-align: middle;
    }
    #permsTable_wrapper table.dataTable thead .sorting_asc::after{
        vertical-align: middle;
        line-height: 30px;
    }
    #allotSaveAfter{
        clear: both;
    }
    #allotSaveButton{
        margin: 15px 0px;
    }
    #permBox{
        min-height: 500px;
    }
    #allotUserTable  tr  td:hover,
    #allotUserTable  tr  td:active,
    #allotUserTable  tr  td:focus {
        color: #444;
        background: #f7f7f7;
    }
    #allotUserTable > tbody > tr > td, #allotUserTable > tbody > tr > th, #allotUserTable > tfoot > tr > td, #allotUserTable > tfoot > tr > th, #allotUserTable > thead > tr > td, #allotUserTable > thead > tr > th{
        padding: 0px 10px;
    }
</style>
<?php $this->stop() ?>

<?php $this->start('script') ?>
<!-- DataTables -->
<script src="<?= asset_admin_url('plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= asset_admin_url('plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<!-- FastClick -->
<script src="<?= asset_admin_url('plugins/fastclick/fastclick.js') ?>"></script>
<!-- iCheck -->
<script src="<?= asset_admin_url('plugins/iCheck/icheck.min.js') ?>"></script>
<!-- Page Script -->
<script type="text/javascript">
    $(function () {
        $('#permsTable').DataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0]}],
            "aaSorting": [[1, 'asc']],
        });


        $('#allotUserTable').DataTable({
            "fnDrawCallback": function (oSettings) {
                $(oSettings.nTHead).hide();
                if (oSettings._iDisplayLength > oSettings.fnRecordsDisplay()) {
                    $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
                }
            },
//            "pageLength": 1,
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            "oLanguage": {
                "sSearch": "",
                sSearchPlaceholder: "Search name"
            }
        });
    });
    $(function () {
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('#permsTable input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });

        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
            var clicks = $(this).data('clicks');
            if (clicks) {
                //Uncheck all checkboxes
                $("#permsTable input[type='checkbox']").iCheck("uncheck");
                $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
            } else {
                //Check all checkboxes
                $("#permsTable input[type='checkbox']").iCheck("check");
                $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
            }
            $(this).data("clicks", !clicks);
        });
    });
</script>
<?php $this->stop() ?>

