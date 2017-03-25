<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

            <li class="dropdown user user-menu">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
<!--                                    <img alt="User Image" class="user-image" src="<?= asset_admin_url('dist/img/user2-160x160.jpg') ?>">-->
                    <span class="ion-person user-image" data-pack="default" style="font-size: 27px;" data-tags="users, staff, head, human"></span>
                    <span class="hidden-xs"><?php echo $user['username']; ?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <span class="ion-person img-circle" data-pack="default" style="font-size: 60px;" data-tags="users, staff, head, human"></span>
<!--                                        <img alt="User Image" class="img-circle" src="<?= asset_admin_url('dist/img/user2-160x160.jpg') ?>">-->
                        <p>
                            <?php echo $user['username']; ?> - <?php echo $user['email']; ?>
                            <small>Member since <?php echo $user['date_created']; ?></small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-right">
                            <a class="btn btn-default btn-flat" href="#">Sign out</a>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
        </ul>
    </div>
</nav>