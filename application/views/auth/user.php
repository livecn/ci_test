<?php $this->layout('layouts::admin/default') ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <!--            <div class="box-header">
                            <h3 class="box-title">Data Table With Full Features</h3>
                        </div>-->
            <!-- /.box-header -->
            <div class="box-body">
                <table id="userTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Active</th>
                            <th>Last Login</th>
                            <th>Created At</th>
                            <th>Operator</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $this->a($user, 'username') ?></td>
                                    <td><?= $this->a($user, 'email') ?></td>
                                    <td><span class="label <?php echo $this->a($user, 'active') == '1' ? 'label-success' : 'label-danger'; ?>"><?php echo $this->a($user, 'active') == '1' ? 'Yes' : 'No'; ?></span></td>
                                    <td><?php echo $this->a($user, 'last_login'); ?></td>
                                    <td><?php echo $this->a($user, 'date_created'); ?></td>
                                    <td>
                                        <a class="btn btn-operator" data-toggle="modal" data-id="<?php echo $this->a($user, 'id'); ?>" data-url="<?php echo base_url('auth/user/edit') ?>" data-target="#userEditModal">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-operator" data-toggle="modal" data-id="<?php echo $this->a($user, 'id'); ?>"  data-url="<?php echo base_url('auth/user/delete') ?>" data-target="#yesnoModal">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Active</th>
                            <th>Last Login</th>
                            <th>Created At</th>
                            <th>Operator</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

<?php //$this->insert('admin/user/edit') ?>
<div class="modal fade" id="userEditModal" tabindex="-1" role="dialog" aria-labelledby="userEditModalLabel"></div>



<?php $this->start('before_style') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= asset_admin_url('plugins/datatables/dataTables.bootstrap.css') ?>">
<!-- Select2 -->
<link rel="stylesheet" href="<?= asset_admin_url('plugins/select2/select2.min.css') ?>">
<?php $this->stop() ?>

<?php $this->start('style') ?>
<style type="text/css">
    .btn-operator{
        font-size: 18px;
        padding: 0px 6px;
    }
    .error-msg-notice{
        color: red;
        display: block;
        margin: 4px;
    }
    #userTable_filter label{
        font-size: 16px;
        margin-left: 10px;
    }
</style>
<?php $this->stop() ?>

<?php $this->start('script') ?>
<!-- DataTables -->
<script src="<?= asset_admin_url('plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= asset_admin_url('plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<!-- Select2 -->
<script src="<?= asset_admin_url('plugins/select2/select2.full.min.js') ?>"></script>
<script src="<?= asset_url('js/jquery.cookie.js') ?>"></script>
<!-- page script -->
<script type="text/javascript">
    $.cookie('refresh_panel', 0);
    // $(".select2").select2();
//    $('.select2').val([1, 2]).trigger('change');
    $(function () {
        $('#userTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "aaSorting": [[4, 'desc']],
            "info": true,
            "autoWidth": false,
            "bStateSave": true,
            "aoColumnDefs": [{"bSortable": false, "aTargets": [2, 5]}],
        });
        $('<button data-target="#userEditModal" data-toggle="modal" data-url="<?php echo base_url('auth/user/edit') ?>" class="btn btn-default btn-sm btn-operator" type="button" id="refresh"> Add New User </button>').insertBefore('div.dataTables_filter label');
    });
    $('#yesnoModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        $('#yesnoModalYes').attr('data-id', button.attr('data-id'));
        $('#yesnoModalYes').attr('data-url', button.attr('data-url'));
    });
    $('#yesnoModalYes').on('click', function () {
        $(this).attr('disabled', "disabled");
        $('#yesnoModal').modal('hide');
        $.ajax({
            dataType: "json",
            url: $('#yesnoModalYes').attr('data-url'),
            data: {id: $('#yesnoModalYes').attr('data-id')},
            method: 'POST',
            success: function (data) {
                if (data.status == 'error') {
                    $('#msgModal .modal-title').html('Error');
                    $('#msgModal .modal-body p').html(data.msg);
                    $('#msgModal').modal('show');
                } else {
                    $('#msgModal .modal-title').html('Success');
                    $('#msgModal .modal-body p').html(data.msg);
                    $('#msgModal').modal('show');
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
            }
        }).done(function () {
            $('#yesnoModalYes').removeAttr('disabled');
        }).fail(function () {
            $('#yesnoModalYes').removeAttr('disabled');
            alert('Something went wrong!')
        });
    })

    $('#userEditModal').on('hidden.bs.modal', function (event) {
        $('#userEditModal').modal('hide');
        if ($.cookie('refresh_panel') == 1) {
            $.cookie('refresh_panel', 0);
            setTimeout(function () {
                location.reload();
            }, 2000);
        }
    })

    $('#userEditModal').on('show.bs.modal', function (event) {
        $('#userEditModal').html('');
        var button = $(event.relatedTarget);
        var id = button.attr('data-id');
        var url = button.attr('data-url');

        $.ajaxSetup({
            async: false
        });
        status = true;
        $.ajax({
            dataType: "text",
            url: url,
            data: {id: id},
            method: 'GET',
            success: function (data) {
                $('#userEditModal').html(data);
            }
        }).fail(function () {
            status = false;
        });
        if (!id) {
            $("#userEditModalLabel").html('Add New User');
        }
        $.ajaxSetup({
            async: true
        });
        if (!status || status == 'false') {
            $('#msgModal .modal-title').html('Error');
            $('#msgModal .modal-body p').html('Something went wrong&hellip;');
            $('#msgModal').modal('show');
            return false;
        }

    }
    )
</script>
<?php $this->stop() ?>