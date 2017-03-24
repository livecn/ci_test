
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="groupEditModalLabel">Edit Group</h4>
        </div>
        <form id="groupEditForm" method="post" action="<?php echo base_url('auth/group/save'); ?>">
            <div class="modal-body">
                <input type="hidden" name="id" value="<?= $this->a($group, 'id') ?>" />
                <div class="form-group">
                    <label for="name" class="control-label">Name:</label>
                    <input type="text" class="form-control" name="name" value="<?= $this->a($group, 'name') ?>" />
                </div>
                <div class="form-group">
                    <label for="definition" class="control-label">Definition:</label>
                    <input type="text" class="form-control" name="definition" value="<?= $this->a($group, 'definition') ?>" />
                </div>
                <div class="form-group">
                    <label>Users</label>
                    <select class="form-control select2" multiple="multiple" name="user_ids[]" data-placeholder="Select Users" style="width: 100%;">
                        <?php echo getUserSelectHtml(); ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="groupEditSave">Save</button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(".select2").select2();
    $('#groupEditSave').on('click', function () {
        $(this).attr('disabled', "disabled");
        $('.error-msg-notice').remove()
        $.ajax({
            dataType: "json",
            url: $('#groupEditForm').attr('action'),
            data: $('#groupEditForm').serializeArray(),
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
                    $('#groupEditModal').modal('toggle');
                    $.cookie('refresh_panel', 1)
                    $('#msgModal .modal-title').html('Success');
                    $('#msgModal .modal-body p').html(data.msg + '&hellip;');
                    $('#msgModal').modal('show');
                }
            }
        }).done(function () {
            $('#groupEditSave').removeAttr('disabled');
        }).fail(function () {
            $('#groupEditSave').removeAttr('disabled');
            alert('Something went wrong!')
        });
    })
</script>
<?php if (isset($group['user_ids'])): ?>
    <script type="text/javascript">
        $('.select2').val(<?= json_encode($group['user_ids']); ?>).trigger('change');
    </script>
<?php else: ?>
    <script type="text/javascript">
        $('.select2').val('').trigger('change');
    </script>
<?php endif; ?>
