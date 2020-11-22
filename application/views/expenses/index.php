<div class="page-header">
    <div class="row align-items-end">
        <div class="col-md-12">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4><?= $_title ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="row">

        <?php if($_e == 0){ ?>
            <div class="col-md-4">
                <div class="card">
                    <form method="post" action="<?= base_url('expenses/save') ?>">
                        <div class="card-block">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Date <span class="-req">*</span></label>
                                    <input name="date" type="text" class="form-control datepicker" value="<?= set_value('date'); ?>" autocomplete="off" placeholder="Date" required>
                                    <?= form_error('date') ?>
                                </div>
                            </div>  
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Perticulars <span class="-req">*</span></label>
                                    <input name="perticulars" type="text" class="form-control" value="<?= set_value('perticulars'); ?>" placeholder="Perticulars" required>
                                    <?= form_error('perticulars') ?>
                                </div>
                            </div> 
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Amount <span class="-req">*</span></label>
                                    <input name="amount" type="text" class="form-control decimal-num" value="<?= set_value('amount'); ?>" autocomplete="off" placeholder="Amount" required>
                                    <?= form_error('amount') ?>
                                </div>
                            </div>                
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-success">
                                <i class="fa fa-plus"></i> Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php }else{ ?>
            <div class="col-md-4">
                <div class="card">
                    <form method="post" action="<?= base_url('expenses/update') ?>">
                        <div class="card-block">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Date <span class="-req">*</span></label>
                                    <input name="date" type="text" class="form-control datepicker" value="<?= set_value('date',vd($single['date'])); ?>" autocomplete="off" placeholder="Date" required>
                                    <?= form_error('date') ?>
                                </div>
                            </div>  
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Perticulars <span class="-req">*</span></label>
                                    <input name="perticulars" type="text" class="form-control" value="<?= set_value('perticulars',$single['perticulars']); ?>" placeholder="Perticulars" required>
                                    <?= form_error('perticulars') ?>
                                </div>
                            </div> 
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Amount <span class="-req">*</span></label>
                                    <input name="amount" type="text" class="form-control decimal-num" value="<?= set_value('amount',$single['amount']); ?>" autocomplete="off" placeholder="Amount" required>
                                    <?= form_error('amount') ?>
                                </div>
                            </div>           
                        </div>
                        <div class="card-footer text-right">
                            <a href="<?= base_url('expenses') ?>" class="btn btn-danger">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                            <button class="btn btn-success">
                                <i class="fa fa-save"></i> Save
                            </button>
                        </div>
                        <input type="hidden" name="id" value="<?= $single['id'] ?>">
                    </form>
                </div>
            </div>
        <?php } ?>
        

        <div class="col-md-8">
            <div class="card">
                <div class="card-block">
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
                            <?php foreach ($list as $key => $value) { ?>
                                <tr>
                                    <td class="text-center"><?= vd($value['date']) ?></td>
                                    <td><?= $value['perticulars'] ?></td>
                                    <td class="text-right"><?= $value['amount'] ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('expenses/edit/').$value['id'] ?>" class="btn btn-primary btn-mini">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('expenses/delete/').$value['id'] ?>" class="btn btn-danger btn-mini btn-delete">
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
    </div>
</div>