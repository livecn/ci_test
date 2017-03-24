<div class="tab-pane fade" id="params">
    <div class="col-lg-12">
        <div class="well bs-component">
            <fieldset>
                <legend>Header</legend>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Content-type</label>
                    <div class="col-lg-10">
                        <select class="form-control" name="headers[Content-type]" id="select">
                            <option <?= $this->aa($data, 'headers', 'Content-type', 'application/x-www-form-urlencoded') == 'application/x-www-form-urlencoded' ? 'selected="selected"' : '' ?> value="application/x-www-form-urlencoded">application/x-www-form-urlencoded</option>
                            <option <?= $this->aa($data, 'headers', 'Content-type') == 'application/json' ? 'selected="selected"' : '' ?> value="application/json">application/json</option>
                            <option <?= $this->aa($data, 'headers', 'Content-type') == 'application/javascript' ? 'selected="selected"' : '' ?> value="application/javascript">application/javascript</option>
                            <option <?= $this->aa($data, 'headers', 'Content-type') == 'application/xml' ? 'selected="selected"' : '' ?> value="application/xml">application/xml</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Accept</label>
                    <div class="col-lg-10">
                        <select class="form-control" name="headers[Accept]" multiple="" id="select">
                            <option <?= $this->aa($data, 'headers', 'Accept', 'text/plain') == 'text/plain' ? 'selected="selected"' : '' ?> value="text/plain">text/plain</option>
                            <option <?= $this->aa($data, 'headers', 'Accept') == 'text/xml' ? 'selected="selected"' : '' ?> value="text/xml,application/xml">text/xml</option>
                            <option <?= $this->aa($data, 'headers', 'Accept') == 'text/json' ? 'selected="selected"' : '' ?> value="text/json,application/json">text/json</option>
                            <option <?= $this->aa($data, 'headers', 'Accept') == 'text/html' ? 'selected="selected"' : '' ?> value="text/html">text/html</option>
                            <option <?= $this->aa($data, 'headers', 'Accept') == 'text/css' ? 'selected="selected"' : '' ?> value="text/css">text/css</option>
                            <option <?= $this->aa($data, 'headers', 'Accept') == 'application/x-javascript' ? 'selected="selected"' : '' ?> value="application/x-javascript">application/x-javascript</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Connection</label>
                    <div class="col-lg-10">
                        <select class="form-control" name="headers[Connection]" id="selectConnection">
                            <option <?= $this->aa($data, 'headers', 'Connection') == 'keep-alive' ? 'selected="selected"' : '' ?> value="keep-alive">keep-alive</option>
                            <option <?= $this->aa($data, 'headers', 'Connection', 'close') == 'close' ? 'selected="selected"' : '' ?> value="close">close</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Keep-Alive</label>
                    <div class="col-lg-10">
                        <input id="keepAliveTime" <?= $this->aa($data, 'headers', 'Connection', 'close') == 'close' ? 'disabled' : ''; ?>  type="text" class="form-control" name="headers[Keep-Alive]" placeholder="300" value="<?= $this->aa($data, 'headers', 'Keep-Alive') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Accept-Charset</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="headers[Accept-Charset]" placeholder="ISO-8859-1,utf-8" value="<?= $this->aa($data, 'headers', 'Accept-Charset') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Accept-Language</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="headers[Accept-Language]" placeholder="en-us,en" value="<?= $this->aa($data, 'headers', 'Accept-Language') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Cache-Control</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="headers[Cache-Control]" placeholder="" value="<?= $this->aa($data, 'headers', 'Cache-Control', 'no-cache') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Pragma</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="headers[Pragma]" placeholder="" value="<?= $this->aa($data, 'headers', 'Pragma', 'no-cache') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="textArea" class="col-lg-2 control-label">Other</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" rows="3" name="other-header" id="textArea"><?= $this->a($data, 'other-header') ?></textarea>
                        <span class="help-block">Example&nbsp;&nbsp;Option1: value1;Option2: value2</span>
                    </div>
                </div>
                <legend>HTTP Context </legend>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Timeout</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="timeout" placeholder="Seconds" value="<?= $this->a($data, 'timeout', '10') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Max Redirects</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="max_redirects" placeholder="Nums" value="<?= $this->a($data, 'max_redirects', '3') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Ignore Errors</label>
                    <div class="col-lg-10">
                        <select class="form-control" name="ignore_errors" id="select">
                            <option <?= $this->a($data, 'ignore_errors') == 'true' ? 'selected="selected"' : '' ?> value="true">True</option>
                            <option <?= $this->a($data, 'ignore_errors', 'false') == 'false' ? 'selected="selected"' : '' ?> value="false">False</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-lg-2 control-label">Referer</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="referer" placeholder="http://" value="<?= $this->a($data, 'referer') ?>">
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>