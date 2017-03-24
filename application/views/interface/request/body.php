<div class="tab-pane fade" id="body">
    <div class="col-lg-12">
        <div class="well bs-component">
            <fieldset>
                <legend>Data</legend>
                <div class="form-group" id="body-type-div">
                    <div class="col-lg-12">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-3">
                            <div class="radio">
                                <label>
                                    <input type="radio" data="bodyForm" name="body-type" id="" value="form" <?= $this->a($data, 'body-type', 'form') == "form" ? 'checked=""' : ''; ?>>
                                    Form
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="radio">
                                <label>
                                    <input type="radio" data="bodyJson" name="body-type" id="" value="json" <?= $this->a($data, 'body-type') == "json" ? 'checked=""' : ''; ?>>
                                    JSON
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="radio">
                                <label>
                                    <input type="radio" data="bodyArray" name="body-type" id="" value="array" <?= $this->a($data, 'body-type') == "array" ? 'checked=""' : ''; ?>>
                                    Array
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="radio">
                                <label>
                                    <input type="radio" data="bodyXml" name="body-type" id="" value="xml" <?= $this->a($data, 'body-type') == "xml" ? 'checked=""' : ''; ?>>
                                    XML
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group body-type-field <?= $this->a($data, 'body-type', 'form') == "form" ? 'display-block' : ''; ?>" id='bodyForm'>
                    <div id="fieldsDiv">
                        <?php $body_form_key = array(); ?>
                        <?php if (isset($data['body-form-key']) && count($body_form_key = $data['body-form-key'])): ?>
                            <?php $body_form_value = $data['body-form-value']; ?>
                            <?php for ($i = 0; $i < count($body_form_key); $i++): ?>
                                <div class="form-group">
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="body-form-key[]" placeholder="key" value="<?= $body_form_key[$i] ?>">
                                    </div>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="body-form-value[]" placeholder="value" value="<?= $body_form_value[$i] ?>">
                                    </div>
                                </div>
                            <?php endfor; ?>
                        <?php endif; ?>
                        <?php if (count($body_form_key) < 4): ?>
                            <?php for ($i = 0; $i < 4 - count($body_form_key); $i++): ?>
                                <div class = "form-group">
                                    <div class = "col-lg-1"></div>
                                    <div class = "col-lg-5">
                                        <input type = "text" class = "form-control" name = "body-form-key[]" placeholder = "key" value = "">
                                    </div>
                                    <div class = "col-lg-5">
                                        <input type = "text" class = "form-control" name = "body-form-value[]" placeholder = "value" value = "">
                                    </div>
                                </div>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>
                    <div class = "form-group"></div>
                    <div class = "form-group">
                        <div class = "col-lg-7 col-lg-offset-5">
                            <button id = "newLine" class = "btn btn-default">&nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                New&nbsp;
                                &nbsp;
                                &nbsp;
                                Line&nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                            </button>
                        </div>
                    </div>
                </div>



                <div class = "form-group body-type-field <?= $this->a($data, 'body-type') == "json" ? 'display-block' : ''; ?>" id = 'bodyJson'>
                    <div class = "col-lg-1"></div>
                    <div class = "col-lg-10">
                        <textarea class = "form-control" rows = "10" name = 'body-json' id = "textArea"><?= $this->a($data, 'body-json') ?></textarea>
                        <span class = "help-block">Example&nbsp;
                            &nbsp;
                            {"a":1, "b":2}</span>
                    </div>
                </div>

                <div class = "form-group body-type-field <?= $this->a($data, 'body-type') == "array" ? 'display-block' : ''; ?>" id = 'bodyArray'>
                    <div class = "col-lg-1"></div>
                    <div class = "col-lg-10">
                        <textarea class = "form-control" rows = "10" name = 'body-array' id = "textArea"><?= $this->a($data, 'body-array') ?></textarea>
                        <span class = "help-block">Example&nbsp;
                            &nbsp;
                            array('a' => 'b')</span>
                    </div>
                </div>

                <div class = "form-group body-type-field <?= $this->a($data, 'body-type') == "xml" ? 'display-block' : ''; ?>" id = 'bodyXml'>
                    <div class = "col-lg-1"></div>
                    <div class = "col-lg-10">
                        <textarea class = "form-control" rows = "10" name = 'body-xml' id = "textArea"><?= $this->a($data, 'body-xml') ?></textarea>
                        <span class = "help-block">Example&nbsp;
                            &nbsp;
                            <?php echo $this->e('<root><a>b</a></root>');?></span>
                    </div>
                </div>


            </fieldset>
        </div>
    </div>
</div>