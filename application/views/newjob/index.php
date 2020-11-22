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
            <button class="btn btn-primary btn-sm" type="button" id="addNewFollowupJob">
                <i class="fa fa-plus"></i> Add Job
            </button>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="card">
        <div class="card-block dt-responsive table-responsive">
            <table class="table table-striped table-bordered table-mini table-dt">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center ">Date</th>
                        <th>Service</th>
                        <th class="text-right">Price</th>
                        <th>Client</th>
                        <th class="text-center">NFD</th>
                        <?php if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){ ?>
                            <th>Owner</th>
                        <?php } ?>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jobs as $key => $value) { ?>
                        <?php $client = $this->general_model->_get_client($value['client']); ?>
                        <tr>
                            <td class="text-center">#NEW_WORK_<?= $value['id'] ?></td>
                            <td class="text-center" data-sort="<?= _sortdate($value['created_at']) ?>"><?= vd($value['created_at']) ?></td>
                            <td>
                                <?php foreach (json_decode($value['service']) as $skey => $svalue) { ?>
                                    <?= $this->general_model->_get_service($svalue[0])['name'] ?><br>
                                <?php } ?>
                            </td>
                            <td class="text-right">
                                <?php foreach (json_decode($value['service']) as $skey => $svalue) { ?>
                                    <?= $svalue[1] ?><br>
                                <?php } ?>
                            </td>
                            <td>
                                #<?= $client['c_id'] ?> <br><b><?= $client['fname'] ?> <?= $client['mname'] ?> <?= $client['lname'] ?></b> <?= $client['firm'] != ""?'<br>'.$client['firm'] :'' ?> <br><small><?= $client['mobile'] ?></small>
                            </td>
                            <td class="text-center" id="" data-sort="<?= _sortdate($value['fdate'] != null?vd($value['fdate']):'') ?>"><?= $value['fdate'] != null?vd($value['fdate']):'NA'; ?><?= get_from_to($value['from'],$value['to']) ?></td>
                            <?php if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){ ?>
                                <td><?= $this->general_model->_get_user($value['owner'])['name'] ?></td>
                            <?php } ?>
                            <td class="text-center">
                                <a href="<?= base_url('newjob/view/').$value['id'] ?>" class="btn btn-success btn-mini" title="View">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>