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
            <?php if(get_user()['user_type'] != "3"){ ?>
            <button class="btn btn-warning btn-sm" type="button" id="tranferJob"  data-type="2">
                <i class="fa fa-share"></i> Transfer Job
            </button>
            <?php } ?>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="card">
        <div class="card-block dt-responsive table-responsive">
            <table class="table table-striped table-bordered table-mini table-dt">
                <thead>
                    <tr>
                        <?php if(get_user()['user_type'] != "3"){ ?>
                        <th class="text-center">
                            <div class="checkbox-fade fade-in-primary d-">
                                <label>
                                    <input type="checkbox" value="1" class="checkAll">
                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                    <span class="text-inverse"></span>
                                </label>
                            </div>
                        </th>
                        <?php } ?>
                        <th class="text-center">#</th>
                        <th class="text-center">Completed<br>Date</th>
                        <th>Service</th>
                        <?php if(get_user()['user_type'] != 2){ ?>
                            <th class="text-right">Price</th>
                        <?php } ?>
                        <th>Client</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Imp</th>
                        <?php if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1 || get_user()['user_type'] == 3){ ?>
                            <th>Owner</th>
                        <?php } ?>
                        <?php if(get_user()['user_type'] != "3"){ ?>
                        <th class="text-center">Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jobs as $key => $value) { ?>
                        <?php $client = $this->general_model->_get_client($value['client']); ?>
                        <tr>
                            <?php if(get_user()['user_type'] != "3"){ ?>
                            <td class="text-center">
                                <div class="checkbox-fade fade-in-primary d-">
                                    <label>
                                        <input type="checkbox" class="checkBox" value="<?= $value['id'] ?>">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                    </label>
                                </div>
                            </td>
                            <?php } ?>
                            <td class="text-center"><?= $value['job_id'] ?></td>
                            <td class="text-center" data-sort="<?= _sortdate($value['updated_date']) ?>">
                                <?= vd($value['updated_date']) ?>
                            </td>
                            <td><?= $this->general_model->_get_service($value['service'])['name'] ?></td>
                            <?php if(get_user()['user_type'] != 2){ ?>
                                <td class="text-right"><?= $value['price'] ?></td>
                            <?php } ?>
                            <td>
                                #<?= $client['c_id'] ?> <br><b><?= $client['fname'] ?> <?= $client['mname'] ?> <?= $client['lname'] ?></b> <?= $client['firm'] != ""?'<br>'.$client['firm'] :'' ?> <br><small><?= $client['mobile'] ?></small>
                            </td>
                            <td class="text-center" id="status-<?= $value['id'] ?>"><?= getjobStatus($value['status']) ?></td>
                            <td class="text-center"><?= $value['importance'][0] ?></td>
                            <?php if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1 || get_user()['user_type'] == 3){ ?>
                                <td><?= $this->general_model->_get_user($value['owner'])['name'] ?>
                                    <?php if($value['pre_owner'] != ""){ ?>
                                        <br><b>old</b> : <?= $this->general_model->_get_user($value['pre_owner'])['name'] ?>
                                    <?php } ?>
                                </td>
                            <?php } ?>
                            <?php if(get_user()['user_type'] != "3"){ ?>
                            <td class="text-center">
                                <button type="button" class="btn btn-success btn-mini add-job-followup" data-status="<?= $value['status'] ?>" data-id="<?= $value['id'] ?>" data-stop="Job Is Closed" data-type="job" title="Check Followup">
                                    <i class="fa fa-question"></i>
                                </button>
                            </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>