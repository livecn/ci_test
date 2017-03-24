<div class="tab-pane fade" id="base-auth">
    <div class="col-lg-12">
        <div class="well bs-component">
            <fieldset>
                <legend>Base Auth</legend>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Username</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="baseAuthUsername" name="base-username" placeholder="" value="<?= $this->a($data, 'base-username') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" id="baseAuthPassword" name="base-password" placeholder="" value="<?= $this->a($data, 'base-password') ?>">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="showPass"> Show Password
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>