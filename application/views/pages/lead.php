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
            <a href="<?= base_url('dashboard') ?>" class="btn btn-danger btn-mini"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="padding: 10px;">
                    <div class="row"> 
                        <div class="col-md-6">
                            <h5>Today Leads</h5>
                        </div>
                    </div>
                </div>
                <div class="card-block table-responsive">
                    <table class="table table-striped table-bordered table-mini table-dt">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Date</th>
                                <th>Customer Name</th>
                                <th class="">Area</th>
                                <th class="">Imp</th>
                                <th class="text-center">Contact</th>
                                <th class="">Services</th>
                                <th class="text-center">NFD</th>
                                <?php if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){ ?>
                                    <th>User</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($today as $key => $value) { ?>
                                <tr id="tr-lead-<?= $value['id'] ?>">
                                    <td class="text-center"><?= $value['lead'] ?></td>
                                    <td class="text-center" data-sort="<?= _sortdate($value['date']) ?>"><?= vd($value['date']) ?></td>
                                    <td>
                                        <?= $value['customer'] ?>
                                        <?= $value['firm'] != ''?'<br>-'.$value['firm']:'' ?>        
                                    </td>
                                    <td class="">
                                        <?= $this->general_model->_get_area($value['area'])['name'] ?>,<br> <?= $this->general_model->_get_city($value['city'])['name'] ?>,<br> <?= $this->general_model->_get_district($value['district'])['name'] ?>,<br> <?= $this->general_model->_get_state($value['state'])['name'] ?>
                                    </td>
                                    <th class="text-center"><?= $value['importance'][0] ?></th>
                                    <td class="text-center">
                                        <?php foreach (explode(",", $value['mobile']) as $mkey => $mvalue) { ?>
                                            <?php if($mkey > 0){ ?><br><?php } ?>
                                            <?= $mvalue ?>
                                        <?php } ?>
                                    </td>
                                    <td class="">
                                        <?php foreach (json_decode($value['services']) as $mkey => $mvalue) { ?>
                                            <?php if($mkey > 0){ ?><br><?php } ?>
                                            <?= $this->general_model->_get_service($mvalue[0])['name'] ?>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center" id="fdate-<?= $value['id'] ?>" data-sort="<?= _sortdate($value['next_followup_date']) ?>">
                                        <?= vd($value['next_followup_date']) ?>
                                        <?= get_from_to($value['tfrom'],$value['tto']) ?>
                                    </td>
                                    <?php if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){ ?>
                                        <td>
                                            <small>
                                            <?= $this->general_model->_get_user($value['owner'])['name'] ?>
                                            <?php if($value['old_owner'] != ""){ ?>
                                                <br><b>old</b> : <?= $this->general_model->_get_user($value['old_owner'])['name'] ?>
                                            <?php } ?>
                                            <br><b>Br</b> : <?= $this->general_model->_get_branch($value['branch'])['sname'] ?></small>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="padding: 10px;">
                    <div class="row"> 
                        <div class="col-md-6">
                            <h5>Monthly Leads</h5>
                        </div>
                    </div>
                </div>
                <div class="card-block table-responsive">
                    <table class="table table-striped table-bordered table-mini table-dt">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Date</th>
                                <th>Customer Name</th>
                                <th class="">Area</th>
                                <th class="">Imp</th>
                                <th class="text-center">Contact</th>
                                <th class="">Services</th>
                                <th class="text-center">NFD</th>
                                <?php if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){ ?>
                                    <th>User</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($month as $key => $value) { ?>
                                <tr id="tr-lead-<?= $value['id'] ?>">
                                    <td class="text-center"><?= $value['lead'] ?></td>
                                    <td class="text-center" data-sort="<?= _sortdate($value['date']) ?>"><?= vd($value['date']) ?></td>
                                    <td>
                                        <?= $value['customer'] ?>
                                        <?= $value['firm'] != ''?'<br>-'.$value['firm']:'' ?>        
                                    </td>
                                    <td class="">
                                        <?= $this->general_model->_get_area($value['area'])['name'] ?>,<br> <?= $this->general_model->_get_city($value['city'])['name'] ?>,<br> <?= $this->general_model->_get_district($value['district'])['name'] ?>,<br> <?= $this->general_model->_get_state($value['state'])['name'] ?>
                                    </td>
                                    <th class="text-center"><?= $value['importance'][0] ?></th>
                                    <td class="text-center">
                                        <?php foreach (explode(",", $value['mobile']) as $mkey => $mvalue) { ?>
                                            <?php if($mkey > 0){ ?><br><?php } ?>
                                            <?= $mvalue ?>
                                        <?php } ?>
                                    </td>
                                    <td class="">
                                        <?php foreach (json_decode($value['services']) as $mkey => $mvalue) { ?>
                                            <?php if($mkey > 0){ ?><br><?php } ?>
                                            <?= $this->general_model->_get_service($mvalue[0])['name'] ?>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center" id="fdate-<?= $value['id'] ?>" data-sort="<?= _sortdate($value['next_followup_date']) ?>">
                                        <?= vd($value['next_followup_date']) ?>
                                        <?= get_from_to($value['tfrom'],$value['tto']) ?>
                                    </td>
                                    <?php if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){ ?>
                                        <td>
                                            <small>
                                            <?= $this->general_model->_get_user($value['owner'])['name'] ?>
                                            <?php if($value['old_owner'] != ""){ ?>
                                                <br><b>old</b> : <?= $this->general_model->_get_user($value['old_owner'])['name'] ?>
                                            <?php } ?>
                                            <br><b>Br</b> : <?= $this->general_model->_get_branch($value['branch'])['sname'] ?></small>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>