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

        </div>
    </div>
</div>

<div class="page-body">
    <div class="card">
        <form method="post" action="<?= base_url('followup/payment') ?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Outstanding Days</label> 
                                    <input name="out" type="text" placeholder="Outstanding Days" autocomplete="off" class="form-control form-control-sm numbers" value="<?= $out ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-success btn-mini" type="submit">
                            <i class="fa fa-eye"></i> Show
                        </button>  
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="page-body">
    <div class="card">
        <div class="card-block dt-responsive table-responsive">
            <table class="table table-striped table-bordered table-mini table-dt">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Days</th>
                        <th>Customer Name</th>
                        <th class="text-right">Amount</th>
                        <th class="text-center">NFD</th>
                        <th class="text-right">Last Payment</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($client as $key => $value) { ?>
                        <?php $client = $this->general_model->_get_client($value); ?>
                        <?php $lastPay = $this->general_model->getLastPayment($value); ?>
                        <tr id="tr_payment-<?= $value ?>">
                            <td class="text-center"><?= $client['c_id'] ?></td>
                            <td class="text-center"><?= $this->general_model->getOutStandingClient($value)[1] ?></td>
                            <td>#<?= $client['c_id'] ?> <br><b><?= $client['fname'] ?> <?= $client['mname'] ?> <?= $client['lname'] ?></b> <?= $client['firm'] != ""?'<br>'.$client['firm'] :'' ?> <br><small><?= $client['mobile'] ?></small></td>
                            <td class="text-right"><?= $this->general_model->getOutStandingClient($value)[0] ?></td>
                            <td id="tr_payment-date<?= $value ?>" class="text-center">
                                <?= $client['fdate'] != null?vd($client['fdate']):'NA'; ?>
                            </td>
                            <td class="text-right">
                                <?= $lastPay[0] ?><br>
                                <?= $lastPay[1] ?>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-mini payment-followup-transaction" title="Transaction History" data-client="<?= $value ?>">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-success btn-mini add-payment-followup" data-id="<?= $value ?>" data-type="jobpayment" title="Check Followup">
                                    <i class="fa fa-question"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>