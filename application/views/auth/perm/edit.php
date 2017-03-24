
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="permEditModalLabel">Edit Permission</h4>
        </div>
        <form id="permEditForm" method="post" action="<?php echo base_url('auth/perm/save'); ?>">
            <div class="modal-body">
                <input type="hidden" name="id" value="<?= $this->a($perm, 'id') ?>" />
                <div class="form-perm">
                    <label for="name" class="control-label">Name:</label>
                    <input type="text" class="form-control" name="name" value="<?= $this->a($perm, 'name') ?>" />
                </div>
                <div class="form-perm">
                    <label for="definition" class="control-label">Definition:</label>
                    <input type="text" class="form-control" name="definition" value="<?= $this->a($perm, 'definition') ?>" />
                </div>
                <div class="form-perm">
                    <label for="type" class="control-label">Type:</label>
                    <select class="form-control" name="type">
                        <option <?= $this->a($perm, 'type') == 'html' ? 'selected="selected"' : '' ?> value="html">Html</option>
                        <option <?= $this->a($perm, 'type') == 'json' ? 'selected="selected"' : '' ?> value="json">Json</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="permEditSave">Save</button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $('#permEditSave').on('click', function () {
        $(this).attr('disabled', "disabled");
        $('.error-msg-notice').remove()
        $.ajax({
            dataType: "json",
            url: $('#permEditForm').attr('action'),
            data: $('#permEditForm').serializeArray(),
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
                    $('#permEditModal').modal('toggle');
                    $.cookie('refresh_panel', 1)
                    $('#msgModal .modal-title').html('Success');
                    $('#msgModal .modal-body p').html(data.msg + '&hellip;');
                    $('#msgModal').modal('show');
                }
            }
        }).done(function () {
            $('#permEditSave').removeAttr('disabled');
        }).fail(function () {
            $('#permEditSave').removeAttr('disabled');
            alert('Something went wrong!')
        });
    })
</script>
