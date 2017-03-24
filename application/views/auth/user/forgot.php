<?php $this->layout('layouts::admin/base') ?>

<div class="login-box">
    <div class="login-logo">
        <a href="<?php echo base_url('admin'); ?>"><?php echo $site_name; ?></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Complete input to resetting your password</p>

        <form action="<?php echo base_url('auth/user/forgot_post'); ?>" method="post" id="forgotForm">
            <input type="hidden" name="referer" id="referer" value="<?php echo base_url('admin'); ?>">
            <div class="form-group has-feedback">
                <input type="text" name="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-email form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">

                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" id="loginButton" class="btn btn-primary btn-block btn-flat">Submit</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<?php $this->start('style') ?>
<!-- iCheck -->
<link rel="stylesheet" href="<?= asset_admin_url('plugins/iCheck/square/blue.css') ?>">
<?php $this->stop() ?>

<?php $this->insert('partials::admin/modal/msg') ?>

<?php $this->start('script') ?>
<!-- iCheck -->
<script src="<?= asset_admin_url('plugins/iCheck/icheck.min.js') ?>"></script>
<script type="text/javascript">
    $(function () {
        $('#loginButton').on('click', function (e) {
            e.preventDefault();
            $(this).attr('disabled', "disabled");
            $.ajax({
                dataType: "json",
                url: $('#forgotForm').attr('action'),
                data: $('#forgotForm').serializeArray(),
                method: 'POST',
                success: function (data) {
                    if (data.status == 'fail') {
                        $('#msgModal .modal-title').html('Error');
                        $('#msgModal .modal-body p').html(data.msg);
                        $('#msgModal').modal('show');
                    } else {
                        $('#msgModal .modal-title').html('Success');
                        $('#msgModal .modal-body p').html(data.msg);
                        $('#msgModal .modal-footer').css('display', 'none');
                        $('#msgModal').modal('show');
                        setTimeout(function () {
                            location.href = $('#referer').val();
                        }, 2000);
                    }
                }
            }).done(function () {
                $("#loginButton").removeAttr('disabled');
            }).fail(function () {
                $("#loginButton").removeAttr('disabled');
                alert('Something went wrong!')
            });
        })
        $('body').addClass('login-page');
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
<?php $this->stop() ?>
