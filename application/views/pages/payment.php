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
                            <h5> > 30 Days</h5>
                        </div>
                    </div>
                </div>
                <div class="card-block table-responsive">
                    <table class="table table-striped table-bordered table-mini table-dt">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Customer Name</th>
                                <th class="text-center">Contact</th>
                                <th class="">Address</th>
                                <th class="text-center">Since</th>
                                <th class="text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $clients = $this->db->get('client')->result_array(); ?>
                            <?php foreach ($clients as $key => $value) { ?>
                                <?php if(30 < $this->general_model->getOutStandingClient($value['id'])[1]){ ?>
                                <tr>
                                    <td class="text-center"><?= $value['c_id'] ?></td>
                                    <td>
                                        <?= $value['fname'] ?> <?= $value['mname'] ?> <?= $value['lname'] ?>
                                        <?php if($value['firm']){ ?>
                                            <br><b>Firm : </b><?= $value['firm'] ?>
                                        <?php } ?>
                                        <br>-<?= $value['gender'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?php foreach (explode(",", $value['mobile']) as $mkey => $mvalue) { ?>
                                            <?php if($mkey > 0){ ?><br><?php } ?>
                                            <?= $mvalue ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?= $value['add1'] ?>,<br>
                                        <?php if(!empty($value['add2'])){ ?><?= $value['add2'] ?>,<br> <?php } ?>
                                        <?=  $this->general_model->_get_area($value['area'])['name'] ?>, <?= $this->general_model->_get_city($value['city'])['name'] ?>, <?= $this->general_model->_get_district($value['district'])['name'] ?>, <?= $this->general_model->_get_state($value['state'])['name'] ?> <?= $value['pin'] != ''?",".$value['pin']:''; ?>
                                    </td>
                                    <td class="text-center"><?= $this->general_model->getOutStandingClient($value['id'])[1] ?> Days</td>
                                    <td class="text-right"><?= rs().moneyFormatIndia($this->general_model->getOutStandingClient($value['id'])[0]) ?></td>
                                </tr>
                            <?php } } ?>
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
                            <h5> > 90 Days</h5>
                        </div>
                    </div>
                </div>
                <div class="card-block table-responsive">
                    <table class="table table-striped table-bordered table-mini table-dt">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Customer Name</th>
                                <th class="text-center">Contact</th>
                                <th class="">Address</th>
                                <th class="text-center">Since</th>
                                <th class="text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $clients = $this->db->get('client')->result_array(); ?>
                            <?php foreach ($clients as $key => $value) { ?>
                                <?php if(90 < $this->general_model->getOutStandingClient($value['id'])[1]){ ?>
                                <tr>
                                    <td class="text-center"><?= $value['c_id'] ?></td>
                                    <td>
                                        <?= $value['fname'] ?> <?= $value['mname'] ?> <?= $value['lname'] ?>
                                        <?php if($value['firm']){ ?>
                                            <br><b>Firm : </b><?= $value['firm'] ?>
                                        <?php } ?>
                                        <br>-<?= $value['gender'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?php foreach (explode(",", $value['mobile']) as $mkey => $mvalue) { ?>
                                            <?php if($mkey > 0){ ?><br><?php } ?>
                                            <?= $mvalue ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?= $value['add1'] ?>,<br>
                                        <?php if(!empty($value['add2'])){ ?><?= $value['add2'] ?>,<br> <?php } ?>
                                        <?=  $this->general_model->_get_area($value['area'])['name'] ?>, <?= $this->general_model->_get_city($value['city'])['name'] ?>, <?= $this->general_model->_get_district($value['district'])['name'] ?>, <?= $this->general_model->_get_state($value['state'])['name'] ?> <?= $value['pin'] != ''?",".$value['pin']:''; ?>
                                    </td>
                                    <td class="text-center"><?= $this->general_model->getOutStandingClient($value['id'])[1] ?> Days</td>
                                    <td class="text-right"><?= rs().moneyFormatIndia($this->general_model->getOutStandingClient($value['id'])[0]) ?></td>
                                </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>