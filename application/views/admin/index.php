<?php $this->layout('layouts::admin/default') ?>

<div class="row" >
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-file-text"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Posts</span>
                <span class="info-box-number">90<small>%</small></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-tag"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Tags</span>
                <span class="info-box-number">41,410</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-comments"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Comments</span>
                <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-commenting-o"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Chats</span>
                <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>

<div class="row">
    <section class="col-lg-7 connectedSortable ui-sortable">
        <div class="box box-success">
            <div class="box-header">
                <i class="fa fa-comments-o"></i>

                <h3 class="box-title">Chat</h3>

                <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i>
                        </button>
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                    </div>
                    <button data-widget="remove" class="btn btn-default btn-sm" type="button"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body chat" id="chat-box">
                <!-- chat item -->
                <div class="item">
                    <img src="<?= asset_admin_url('dist/img/user4-128x128.jpg') ?>" alt="user image" class="online">

                    <p class="message">
                        <a href="#" class="name">
                            <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                            Mike Doe
                        </a>
                        I would like to meet you to discuss the latest news about
                        the arrival of the new theme. They say it is going to be one the
                        best themes on the market
                    </p>
                    <div class="attachment">
                        <h4>Attachments:</h4>

                        <p class="filename">
                            Theme-thumbnail-image.jpg
                        </p>

                        <div class="pull-right">
                            <button type="button" class="btn btn-primary btn-sm btn-flat">Open</button>
                        </div>
                    </div>
                    <!-- /.attachment -->
                </div>
                <!-- /.item -->
                <!-- chat item -->
                <div class="item">
                    <img src="<?= asset_admin_url('dist/img/user3-128x128.jpg') ?>" alt="user image" class="offline">

                    <p class="message">
                        <a href="#" class="name">
                            <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
                            Alexander Pierce
                        </a>
                        I would like to meet you to discuss the latest news about
                        the arrival of the new theme. They say it is going to be one the
                        best themes on the market
                    </p>
                </div>
                <!-- /.item -->
                <!-- chat item -->
                <div class="item">
                    <img src="<?= asset_admin_url('dist/img/user2-160x160.jpg') ?>" alt="user image" class="offline">

                    <p class="message">
                        <a href="#" class="name">
                            <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
                            Susan Doe
                        </a>
                        I would like to meet you to discuss the latest news about
                        the arrival of the new theme. They say it is going to be one the
                        best themes on the market
                    </p>
                </div>
                <!-- /.item -->
            </div>
            <!-- /.chat -->
            <div class="box-footer">
                <div class="input-group">
                    <input class="form-control" placeholder="Type message...">

                    <div class="input-group-btn">
                        <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-envelope"></i>

                <h3 class="box-title">Quick Email</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
                <!-- /. tools -->
            </div>
            <div class="box-body">
                <form action="#" method="post">
                    <div class="form-group">
                        <input type="email" class="form-control" name="emailto" placeholder="Email to:">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" placeholder="Subject">
                    </div>
                    <div>
                        <textarea class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                </form>
            </div>
            <div class="box-footer clearfix">
                <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
                    <i class="fa fa-arrow-circle-right"></i></button>
            </div>
        </div>

    </section>
    <section class="col-lg-5 connectedSortable ui-sortable">
        <div class="box box-primary ">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="ion-android-apps ion"></i>
                <h3 class="box-title">Shortcuts</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button data-widget="collapse" class="btn btn-primary btn-sm" type="button"><i class="fa fa-minus"></i>
                    </button>
                    <button data-widget="remove" class="btn btn-primary btn-sm" type="button"><i class="fa fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <div class="box-body">
                <a href="#" class="btn btn-app">
                    <span class="badge bg-purple">1</span><i class="fa fa-pencil"></i> Write Post
                </a>			
                <a href="<?php echo base_url('auth/user'); ?>" class="btn btn-app">
                    <span class="badge bg-purple">1</span><i class="fa fa-users"></i> Users
                </a>			
                <a href="account" class="btn btn-app">
                    <span class="badge bg-purple"></span><i class="fa fa-user"></i> Account
                </a>			
                <a href="<?php echo base_url('auth/user/logout'); ?>" class="btn btn-app"><span class="badge bg-purple"></span><i class="fa fa-sign-out"></i> Logout
                </a>		
            </div>
        </div>
        <div class="box box-solid bg-green-gradient">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-calendar"></i>
                <h3 class="box-title">Calendar</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bars"></i></button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#">Add new event</a></li>
                            <li><a href="#">Clear events</a></li>
                            <li class="divider"></li>
                            <li><a href="#">View calendar</a></li>
                        </ul>
                    </div>
                    <button data-widget="collapse" class="btn btn-success btn-sm" type="button"><i class="fa fa-minus"></i>
                    </button>
                    <button data-widget="remove" class="btn btn-success btn-sm" type="button"><i class="fa fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <div class="box-body no-padding">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
            </div>
        </div>
    </section>
</div>

<?php $this->start('style') ?>
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?= asset_admin_url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>">
<!-- Date Picker -->
<link rel="stylesheet" href="<?= asset_admin_url('plugins/datepicker/datepicker3.css') ?>">
<?php $this->stop() ?>


<?php $this->start('script') ?>
<!-- datepicker -->
<script src="<?= asset_admin_url('plugins/datepicker/bootstrap-datepicker.js') ?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= asset_admin_url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
<!-- Slimscroll -->
<script src="<?= asset_admin_url('plugins/slimScroll/jquery.slimscroll.min.js') ?>"></script>
<script src="<?= asset_admin_url('dist/js/pages/dashboard.js') ?>"></script>
<?php $this->stop() ?>