
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="userEditModalLabel">Edit User</h4>
        </div>
        <form id="userEditForm" method="post" action="<?php echo base_url('auth/user/save'); ?>">
            <div class="modal-body">
                <input type="hidden" name="id" value="<?= $this->a($user, 'id') ?>" />
                <div class="form-group">
                    <label for="user_name" class="control-label">User Name:</label>
                    <input type="text" class="form-control" name="username" value="<?= $this->a($user, 'username') ?>" />
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email:</label>
                    <input type="text" class="form-control" name="email" value="<?= $this->a($user, 'email') ?>" />
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Password:</label>
                    <input type="password" class="form-control" name="password" />
                </div>
                <div class="form-group">
                    <label for="password_confirm" class="control-label">Confirm Password:</label>
                    <input type="password" class="form-control" name="password_confirm" />
                </div>
                <div class="form-group">
                    <label for="password_confirm" class="control-label">Active:</label>
                    <select class="form-control" name="active">
                        <option <?= $this->a($user, 'active') == '1' ? 'selected="selected"' : '' ?> value="1">Yes</option>
                        <option <?= $this->a($user, 'active') == '0' ? 'selected="selected"' : '' ?> value="0">No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Groups</label>
                    <select class="form-control select2" multiple="multiple" name="group_ids[]" data-placeholder="Select groups" style="width: 100%;">
                        <?php echo getGroupSelectHtml(); ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="userEditSave">Save</button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(".select2").select2();
    $('#userEditSave').on('click', function () {
        $(this).attr('disabled', "disabled");
        $('.error-msg-notice').remove()
        $.ajax({
            dataType: "json",
            url: $('#userEditForm').attr('action'),
            data: $('#userEditForm').serializeArray(),
            method: 'POST',
            success: function (data) {
                if (data.status == 'fail') {
                    if (data.data.error_field) {
                        var field = $("[name='" + data.data.error_field + "']");
                        field.focus();
                        field.parent().append('<span class="error-msg-notice">' + data.data.error_field_msg + '</span>');
                    }
                    $('#msgModal .modal-title').html('Error');
                    $('#msgModal .modal-body p').html(data.msg);
                    $('#msgModal').modal('show');
                    setTimeout(function () {
                        $('#msgModal').modal('hide');
                    }, 3000);
                } else {
                    $('#userEditModal').modal('toggle');
                    $.cookie('refresh_panel', 1)
                    $('#msgModal .modal-title').html('Success');
                    $('#msgModal .modal-body p').html(data.msg + '&hellip;');
                    $('#msgModal').modal('show');
                }
            }
        }).done(function () {
            $('#userEditSave').removeAttr('disabled');
        }).fail(function () {
            $('#userEditSave').removeAttr('disabled');
            alert('Something went wrong!')
        });
    })
</script>
<?php if (isset($user['group_ids'])): ?>
    <script type="text/javascript">
        $('.select2').val(<?= json_encode($user['group_ids']); ?>).trigger('change');
    </script>
<?php else: ?>
    <script type="text/javascript">
        $('.select2').val('').trigger('change');
    </script>
<?php endif; ?>
