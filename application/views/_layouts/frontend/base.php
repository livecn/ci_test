<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?= $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <base href="<?= base_url() ?>" />
        <link rel="stylesheet" href="<?= asset_url('css/bootstrap.css') ?>" media="screen">
        <link rel="stylesheet" href="<?= asset_url('css/custom.css') ?>">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="<?= asset_url('bower_components/html5shiv/dist/html5shiv.js') ?>"></script>
          <script src="<?= asset_url('bower_components/respond/dest/respond.min.js') ?>"></script>
        <![endif]-->
        <?= $this->section('style') ?>
    </head>
    <body>

        <div id='greyLayer'></div>

        <div id="processBar"> 
            <div class="bs-component">
                <div class="progress progress-striped active">
                    <div class="progress-bar" style="width: 100%"></div>
                </div>
            </div>
        </div>

        <?= $this->section('content') ?>
        <?= $this->section('script') ?>
        <script src="<?= asset_url('js/jquery-1.10.2.min.js') ?>"></script>
        <script src="<?= asset_url('bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
        <?= $this->section('script') ?>
        <script src="<?= asset_url('js/custom.js') ?>"></script>
    </body>
</html>