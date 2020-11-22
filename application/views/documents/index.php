<div class="page-header">
    <div class="row align-items-end">
        <div class="col-md-6">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4><?= $_title ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-right">
            <button class="btn btn-primary btn-mini add-document-locker"><i class="fa fa-plus"></i> Add</button>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="card">
        <div class="card-block dt-responsive table-responsive">
            <table class="table table-striped table-bordered table-mini table-dt">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th class="text-left">Responsible</th>
                        <th class="text-left">Cupboard</th>
                        <th>Get Remarks</th>
                        <th>Sent Remarks</th>
                        <th>Remarks</th>
                        <th class="text-center">Verified ?</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $key => $value) { ?>
                        <?php $client = $this->general_model->_get_client($value['client']); ?>
                        <tr>
                            <td id="doc_client<?= $value['id'] ?>">
                                #<?= $client['c_id'] ?> <br><b><?= $client['fname'] ?> <?= $client['mname'] ?> <?= $client['lname'] ?></b> <?= $client['firm'] != ""?'<br>'.$client['firm'] :'' ?> <br><small><?= $client['mobile'] ?></small></td>
                            <td id="doc_responsible<?= $value['id'] ?>"><?= $value['responsible'] ?></td>
                            <td id="doc_cupboard<?= $value['id'] ?>">
                                <?= $value['cupboard'] ?><br>
                                <b>Reck</b> - <?= $value['reck'] ?>
                            </td>
                            <td id="doc_get_remarks<?= $value['id'] ?>">
                                <p style="margin: 0;"><b><?= vd($value['get_date']) ?></b></p>
                                <?= nl2br($value['get_remarks']) ?>
                            </td>
                            <td id="doc_send_remarks<?= $value['id'] ?>">
                                <p style="margin: 0;"><b><?= $value['sent_date'] != null?vd($value['sent_date']):'' ?></b></p>
                                <?= nl2br($value['sent_remarks']) ?>
                            </td>
                            <td id="doc_remarks<?= $value['id'] ?>">
                                <?= nl2br($value['doc_remarks']) ?>
                            </td>
                            <td class="text-center" id="doc_done<?= $value['id'] ?>">
                                <?= $value['done'] == "1"?'yes':'no' ?>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-mini btn-document-edit" data-id="<?= $value['id'] ?>" data-client="<?= $value['client'] ?>" data-res_person="<?= $value['responsible'] ?>" data-cupboard="<?= $value['cupboard'] ?>" data-reck="<?= $value['reck'] ?>" data-get_remarks="<?= $value['get_remarks'] ?>" data-sent_remarks="<?= $value['sent_remarks'] ?>" data-get_date="<?= vd($value['get_date']) ?>" data-sent_date="<?= $value['sent_date'] != null?vd($value['sent_date']):'' ?>" data-remarks="<?= $value['doc_remarks'] ?>" data-done="<?= $value['done'] ?>" title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </button>

                                <button class="btn btn-danger btn-mini btn-document-delete" type="button" data-id="<?= $value['id'] ?>"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>