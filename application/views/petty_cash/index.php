<div class="page-header">
    <div class="row align-items-end">
        <div class="col-md-6">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4><?= $_title ?> <?php if(get_user()['user_type'] != '0'){ ?> - Balance : <?= $this->general_model->getPettyCashBalanceByUser(get_user()['id']) ?><?php } ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-right">
            <button class="btn btn-primary btn-mini add-petty-cash"><i class="fa fa-plus"></i> Add</button>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="card">
        <div class="card-block dt-responsive table-responsive">
            <table class="table table-striped table-bordered table-mini table-dt">
                <thead>
                    <tr>
                        <th class="text-center">Date</th>
                        <th>Perticulars</th>
                        <th class="text-right">Amount</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $key => $single) { ?>
                        <tr>
                            <td class="text-center"><?= vd($single['date']) ?></td>
                            <td><?= nl2br($single['remarks']) ?></td>
                            <th class="text-right">
                                <?php if($single['debit'] == 0){ ?><b>Cr.</b> <?= $single['credit'] ?><?php }else{ ?><b>Dr.</b> <?= $single['debit'] ?><?php } ?>
                            </th>
                            <td class="text-center">
                                <a href="<?= base_url('petty_cash/delete/').$single['id'] ?>" class="btn btn-danger btn-mini btn-delete" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>