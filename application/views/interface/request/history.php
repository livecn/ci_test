<div class="tab-pane fade" id="history">
    <div class="col-lg-12">
        <div class="well bs-component">
            <fieldset>
                <legend>History</legend>

                <table class="table table-striped table-hover ">
                    <thead>
                        <tr>
                            <th width="7%">#</th>
                            <th width="13%">Method</th>
                            <th width="62%">Url</th>
                            <th width="18%">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($history)): ?>
                            <?php foreach ($history as $k => $v): ?>
                                <tr class="data-tr <?php echo $ci_object->history_model->getStatusLable($v['status']); ?>">
                                    <td><?php echo $k + 1; ?></td>
                                    <td><?php echo $v['method']; ?></td>
                                    <td class="history-url"><?php echo $this->e($v['url']); ?></td>
                                    <td><?php echo $this->f($v['create_time'], 'date', 'Y-m-d H:i:s'); ?></td>
                                    <td><button data-original-title="Request with data" data="<?php echo gen_url('interface', array('hid' => $v['id'])); ?>" title="" data-placement="bottom" data-toggle="tooltip" class="btn btn-default btn-request" type="button">Request</button></td>
                                </tr>
                                <tr class="content-tr info">
                                    <td></td>
                                    <td colspan="4" >
                                        <?php if (is_array(($content = $this->af($v, 'content', 'json_decode', true)))): ?>
                                            <?php echo $ci_object->history_model->getContentText($content); ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="col-lg-4  col-lg-offset-4 pagination-div">
                    <div class="bs-component">
                        <?php echo $pagination; ?>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>