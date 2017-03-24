<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $title ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?= asset_admin_url('bootstrap/css/bootstrap.min.css') ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= asset_admin_url('font-awesome-4.7.0/css/font-awesome.css') ?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?= asset_admin_url('ionicons-2.0.1/css/ionicons.css') ?>">

        <?= $this->section('before_style') ?>

        <!-- Theme style -->
        <link rel="stylesheet" href="<?= asset_admin_url('dist/css/AdminLTE.css') ?>">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?= asset_admin_url('dist/css/skins/_all-skins.min.css') ?>">

        <?= $this->section('style') ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-black-light sidebar-mini">
        <?= $this->section('content') ?>
        <!-- jQuery 2.2.3 -->
        <script src="<?= asset_admin_url('plugins/jQuery/jquery-2.2.3.min.js') ?>"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?= asset_admin_url('bootstrap/js/bootstrap.min.js') ?>"></script>
        <!-- AdminLTE App -->
        <script src="<?= asset_admin_url('dist/js/app.js') ?>"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?= asset_admin_url('dist/js/skin.js') ?>"></script>

        <?= $this->section('script') ?>
    </body>
</html>
