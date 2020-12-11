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
    <div class="card">
        <form method="post" action="<?= base_url('setting/save') ?>">
            <div class="card-block">
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Company Name <span class="-req">*</span></label>
                            <input name="company" type="text" class="form-control" value="<?= set_value('company',get_setting()['name']); ?>" >
                            <?= form_error('company') ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Firebase Server Key <span class="-req">*</span></label>
                            <input name="fserverkey" type="text" class="form-control" value="<?= set_value('fserverkey',get_setting()['fserverkey']); ?>" >
                            <?= form_error('fserverkey') ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Razorpay Key <span class="-req">*</span></label>
                            <input name="razorpay_key" type="text" class="form-control" placeholder="Razorpay Key" value="<?= set_value('razorpay_key',get_setting()['razorpay_key']); ?>" >
                            <?= form_error('razorpay_key') ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>2Factor API Key <span class="-req">*</span></label>
                            <input name="twofecturekey" type="text" class="form-control" placeholder="Razorpay Key" value="<?= set_value('twofecturekey',get_setting()['twofecturekey']); ?>" >
                            <?= form_error('twofecturekey') ?>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="card-footer text-right">
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-save"></i> Save
                </button>
            </div>
        </form>
    </div>
</div>