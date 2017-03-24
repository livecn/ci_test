<?php $this->layout('layouts::frontend/default') ?>

<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h1 id="navs">Http Request</h1>
        </div>
    </div>
</div>

<div class="row notice-box">
    <div class="col-lg-12">
        <div class="bs-component">
            <div class="alert alert-dismissible alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <div id="alertDiv"></div>
            </div>
        </div>
        <div class="bs-component">
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <div id="successDiv"></div>
            </div>
        </div>
        <div class="bs-component">
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <p><strong>Request fail!</strong> Wait a minute and try submitting again.</p>
            </div>
        </div>
    </div>
</div>

<?php echo form_open('interface/home/request', array("class" => "form-horizontal", "id" => "requestForm")); ?>
<div class="col-lg-12">
    <div class="bs-component">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav" id="methodSelect">
                        <li class="dropdown active">
                            <input type='hidden' name='request-method' id='requestMethodInput' value='<?= $this->a($data, 'request-method', 'POST') ?>' />
                            <a aria-expanded="false" role="button" data-toggle="dropdown" class="navbar-brand dropdown-toggle" href="javascript:void(0)"><span id='requestMethodText'><?= $this->a($data, 'request-method', 'POST') ?></span> <span class="caret"></span></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="javascript:void(0)">POST</a></li>
                                <li><a href="javascript:void(0)">GET</a></li>
                            </ul>
                        </li>
                    </ul>

                    <div role="search" class="navbar-form navbar-left" id="requestUrl">
                        <div class="form-group">
                            <input type="text" name="request-url" placeholder="http://" class="form-control" value="<?= $this->a($data, 'request-url') ?>">
                        </div>
                        <button class="btn btn-default" type="submit">Submit</button>
                    </div>
                    <ul class="nav navbar-nav navbar-right" id="saveData">
                        <li><a id="saveLink" href="javascript:void(0)" data="<?php echo base_url('interface/home/save'); ?>">Save</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="bs-component">
                <ul class="nav nav-tabs">
                    <li><a href="#body" data-toggle="tab">Body</a></li>
                    <li><a href="#params" data-toggle="tab">Params</a></li>
                    <li><a href="#cookie" data-toggle="tab">Cookie</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            Auth <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#base-auth" data-toggle="tab">Base Auth</a></li>
                        </ul>
                    </li>
                    <li><a href="#response" data-toggle="tab" id="requestReponse">Response</a></li>
                    <li><a href="#history" data-toggle="tab" id="requestHistory">History</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <?php $this->insert('interface/request/body', array('data' => $data)) ?>
                    <?php $this->insert('interface/request/params', array('data' => $data)) ?>
                    <?php $this->insert('interface/request/cookie', array('data' => $data)) ?>
                    <?php $this->insert('interface/request/auth/base', array('data' => $data)) ?>
                    <?php $this->insert('interface/request/response', array('data' => $data)) ?>
                    <?php $this->insert('interface/request/history', array('history' => $history, 'pagination' => $pagination)) ?>
                </div>
            </div>
        </div>

    </div>
</div>
<?php echo form_close(); ?>




<?php $this->start('script') ?>
<script src="<?= asset_url('js/jquery.cookie.js') ?>"></script>
<?php $this->stop() ?>

