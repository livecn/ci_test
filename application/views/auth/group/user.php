
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="groupEditModalLabel">Edit Group User</h4>
        </div>
        <form id="groupUserEditForm" method="post" action="<?php echo base_url('auth/group/user_save'); ?>">
            <div class="modal-body">
                <input type="hidden" name="id" value="<?= $group_id ?>" />
                <div class="form-group">
                    <label id="selectUnselectAll">
                        <button type="button" <?php
                        if ($selectAll) {
                            echo "clicks=1";
                        }
                        ?>  class="btn btn-default btn-sm checkbox-toggle" ><i class="fa fa-square-o"></i></button> <span>Select/Unselect All User</span>
                    </label>
                </div>
                <div class="form-group" id="userSelect">
                    <?php echo getAllUserSelectHtmlWithIds($users); ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="groupUserEditSave">Save</button>
            </div>
        </form>
    </div>
</div>
<!-- Slimscroll -->
<script src="<?= asset_admin_url('plugins/slimScroll/jquery.slimscroll.min.js') ?>"></script>
<style type="text/css">
    #selectUnselectAll span{
        font-size: 16px;
        margin-left: 5px;
        display: inline-block;
        font-weight: 500;
    }
    #userSelect span{
        display: inline-block;
        margin:3px 8px;
        padding: 2px 4px;
        background:#f7f7f7;
    }
</style>
<script type="text/javascript">
    $('#userSelect').slimScroll({
        height: '400px'
    });
    $(function () {
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('#groupUserEditForm input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });



        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
            var clicks = $(this).data('clicks');
            if (clicks) {
                //Uncheck all checkboxes
                $("#userSelect input[type='checkbox']").iCheck("uncheck");
                $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
            } else {
                //Check all checkboxes
                $("#userSelect input[type='checkbox']").iCheck("check");
                $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
            }
            $(this).data("clicks", !clicks);
        });

        var clicks = $(".checkbox-toggle").data('clicks');
        if (clicks) {
            //Uncheck all checkboxes
            $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
        }
    });
    $('#groupUserEditSave').on('click', function () {
        $(this).attr('disabled', "disabled");
        $('.error-msg-notice').remove()
        $.ajax({
            dataType: "json",
            url: $('#groupUserEditForm').attr('action'),
            data: $('#groupUserEditForm').serializeArray(),
            method: 'POST',
            success: function (data) {
                if (data.status == 'fail') {
                    $('#msgModal .modal-title').html('Error');
                    $('#msgModal .modal-body p').html(data.msg);
                    $('#msgModal').modal('show');
                    setTimeout(function () {
                        $('#msgModal').modal('hide');
                    }, 3000);
                } else {
                    $('#groupUserEditModal').modal('toggle');
                    $('#msgModal .modal-title').html('Success');
                    $('#msgModal .modal-body p').html(data.msg + '&hellip;');
                    $('#msgModal').modal('show');
                }
            }
        }).done(function () {
            $('#groupUserEditSave').removeAttr('disabled');
        }).fail(function () {
            $('#groupUserEditSave').removeAttr('disabled');
            alert('Something went wrong!')
        });
    })
</script>

