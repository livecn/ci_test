<?php $this->layout('layouts::admin/base') ?>

<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url('admin'); ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b><?php echo $short_site_name; ?></b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b><?php echo $site_name; ?></b></span>
        </a>

        <?php $this->insert('partials::admin/navbar') ?>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <?php $this->insert('partials::admin/sidebar') ?>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <?php if (!$hide_content_header): ?>
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <?php $this->insert('partials::admin/page_header') ?>
            </section>
        <?php endif; ?>

        <!-- Main content -->
        <section class="content">
            <?= $this->section('content') ?>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <?php $this->insert('partials::admin/page_footer') ?>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php $this->insert('partials::admin/modal/msg') ?>
<?php $this->insert('partials::admin/modal/yesno') ?>
<?php if ($error_msg): ?>
    <?php $this->push('script') ?>
    <script type="text/javascript">
        $(function () {
            $('#msgModal .modal-title').html('Error');
            $('#msgModal .modal-body p').html('<?php echo $error_msg; ?>');
            $('#msgModal').modal('show');
        })
    </script>
    <?php $this->end() ?>
<?php elseif ($success_msg): ?>
    <?php $this->push('script') ?>
    <script type="text/javascript">
        $(function () {
            $('#msgModal .modal-title').html('Success');
            $('#msgModal .modal-body p').html('<?php echo $success_msg; ?>');
            $('#msgModal').modal('show');
        })
    </script>
    <?php $this->end() ?>
<?php endif; ?>

