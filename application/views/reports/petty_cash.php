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
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <form method="post" action="<?= base_url('reports/petty_cash_result') ?>">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>User <span class="-req">*</span></label>
                                    <select class="form-control form-control-sm select2" name="user" required>
                                        <option value="">-- Select --</option>
                                        <?php foreach ($this->general_model->get_pettycash_users() as $bkey => $bvalue) { ?>
                                            <option value="<?= $bvalue['id'] ?>" <?= $bvalue['id'] == $user?'selected':''; ?>><?= $bvalue['name'] ?> - <?= _user_type($bvalue['id']) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>   
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>From Date <span class="-req">*</span></label> 
                                    <input name="fdate" type="text" placeholder="From Date" autocomplete="off" class="form-control form-control-sm datepicker" value="<?= $fdate ?>" required>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>To Date</label> 
                                    <input name="tdate" type="text" placeholder="To Date" autocomplete="off" class="form-control form-control-sm datepicker" value="<?= $tdate ?>">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <button class="btn btn-success btn-mini" style="margin-top: 30px;">
                                    <i class="fa fa-eye"></i> Show
                                </button>    
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <?php if($user != ""){  ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block">
                        <table class="table table-bordered table-striped table-sm" id="sales">
                            <thead>
                                <tr>
                                    <th class="text-center">Date</th>
                                    <th>Particulars</th>
                                    <th class="text-right">Debit</th>
                                    <th class="text-right">Credit</th>
                                    <th class="text-right">Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $credit_total = 0;$debit_total = 0; ?>
                                <?php if($fdate != ""){ ?>
                                    <tr>
                                        <td class="text-center"><?= vd($fdate) ?></td>
                                        <th>Opening Balance</th>
                                        <?php if($opening[0] == 'd'){ ?>
                                            <td class="text-right"><?= moneyFormatIndia($opening[1]) ?></td>
                                            <td class="text-right"></td>
                                            <?php $debit_total += $opening[1]; ?>
                                        <?php }else{ ?>
                                            <td class="text-right"></td>
                                            <td class="text-right"><?= moneyFormatIndia($opening[1]) ?></td>
                                            <?php $credit_total += $opening[1]; ?>
                                        <?php } ?>
                                        <th class="text-right"><?= moneyFormatIndia($credit_total - $debit_total) ?></th>
                                    </tr>
                                <?php } ?>
                                <?php foreach($list as $key => $value){ ?>
                                    <?php $debit_total += tledamtc($value['debit'],$value['credit']); ?>
                                    <?php $credit_total += tledamtd($value['debit'],$value['credit']); ?>
                                    <tr>
                                        <td class="text-center"><?= vd($value['date']) ?></td>
                                        <th><?= nl2br($value['remarks']) ?></th>
                                        <th class="text-right"><?= ledamtc($value['debit'],$value['credit']) ?></th>
                                        <th class="text-right"><?= ledamtd($value['debit'],$value['credit']) ?></th>
                                        <th class="text-right"><?= moneyFormatIndia($credit_total - $debit_total) ?></th>
                                    </tr>
                                <?php } ?>

                                <tr>
                                    <td class="text-right"></td>
                                    <th class="text-right">Total:</th>
                                    <td class="text-right"><?= moneyFormatIndia($debit_total) ?></td>
                                    <td class="text-right"><?= moneyFormatIndia($credit_total) ?></td>
                                    <th class="text-right"><?= moneyFormatIndia($credit_total - $debit_total) ?></th>
                                </tr>

                                <?php if($credit_total > $debit_total){ ?>
                                    <tr>
                                        <td class="text-right"></td>
                                        <th class="text-right">Cr Closing Balance</th>
                                        <th class="text-right"><?= moneyFormatIndia($credit_total - $debit_total) ?></th>
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                    </tr>
                                <?php } ?>

                                <?php if($credit_total < $debit_total){ ?>
                                    <tr>
                                        <td class="text-right"></td>
                                        <th class="text-right">Dr Closing Balance</th>
                                        <td class="text-right"></td>
                                        <th class="text-right"><?= moneyFormatIndia($debit_total - $credit_total) ?></th>
                                        <td class="text-right"></td>
                                    </tr>
                                <?php } ?>

                                <tr>
                                    <td class="text-right"></td>
                                    <th class="text-right">Total</td>
                                    <th class="text-right">
                                        <?= moneyFormatIndia(max($debit_total,$credit_total)) ?>
                                    </th>
                                    <th class="text-right">
                                        <?= moneyFormatIndia(max($debit_total,$credit_total)) ?>
                                    </th>
                                    <th></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>

<script type="text/javascript" language="javascript" >  
 
</script>