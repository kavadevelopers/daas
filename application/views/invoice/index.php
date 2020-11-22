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
        <div class="card-block dt-responsive table-responsive">
            <table class="table table-striped table-bordered table-mini table-dt">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Date</th>
                        <th>Customer Name</th>
                        <th class="text-right">Amount</th>
                        <th>Created By</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($invoices as $key => $value) { ?>
                        <?php $client = $this->general_model->_get_client($value['client']); ?>
                        <tr>
                            <td class="text-center"><?= $value['inv'] ?></td>
                            <td class="text-center" data-sort="<?= _sortdate($value['date']) ?>"><?= vd($value['date']) ?></td>
                            <td>#<?= $client['c_id'] ?> <br><b><?= $client['fname'] ?> <?= $client['mname'] ?> <?= $client['lname'] ?></b> <?= $client['firm'] != ""?'<br>'.$client['firm'] :'' ?> <br><small><?= $client['mobile'] ?></small></td>
                            <td class="text-right"><?= $value['total'] ?></td>
                            <td>
                                <?= $this->general_model->_get_user($value['created_by'])['name'] ?>
                                <?php if(get_user()['user_type'] == 0 && $value['created_by'] != 1){ ?>
                                    <br><p><b>Branch</b> : <?= $this->general_model->_get_branch($value['branch'])['name'] ?></p>  
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('pdf/invoice/').$value['id'] ?>" target="_blank" class="btn btn-primary btn-mini" title="PDF">
                                    <i class="fa fa-file-pdf-o"></i>
                                </a>
                                <a href="<?= base_url('pdf/invoiceD/').$value['id'] ?>" target="_blank" class="btn btn-secondary btn-mini" title="Download PDF">
                                    <i class="fa fa-download"></i>
                                </a>
                                <?php if(get_user()['user_type'] == 0){ ?>
                                    <button class="btn btn-primary btn-mini btn-invoice-edit" data-id="<?= $value['id'] ?>" title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>