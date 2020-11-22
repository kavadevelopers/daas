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
        <form method="post" action="<?= base_url('user/save_back_office') ?>" enctype="multipart/form-data">
            <div class="card-block">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Name <span class="-req">*</span></label>
                                    <input name="name" type="text" placeholder="Name" class="form-control" value="<?= set_value('name'); ?>">
                                    <?= form_error('name') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Username <span class="-req">*</span></label>
                                    <input name="username" type="text" placeholder="Username" class="form-control" value="<?= set_value('username'); ?>">
                                    <?= form_error('username') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Password <span class="-req">*</span></label>
                                    <input name="password" type="text" placeholder="Password" class="form-control" value="<?= set_value('password'); ?>">
                                    <?= form_error('password') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Mobile <span class="-req">*</span></label>
                                    <input name="mobile" type="text" placeholder="Mobile" class="form-control" value="<?= set_value('mobile'); ?>">
                                    <?= form_error('mobile') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Email <span class="-req">*</span></label>
                                    <input name="email" type="text" placeholder="Email" class="form-control" value="<?= set_value('email'); ?>">
                                    <?= form_error('email') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Gender <span class="-req">*</span></label>
                                    <select class="form-control" name="gender">
                                        <option value="Male" <?= set_value('gender') == 'Male'?'selected':'' ?>>Male</option>
                                        <option value="Female" <?= set_value('gender') == 'Female'?'selected':'' ?>>Female</option>
                                    </select>
                                    <?= form_error('gender') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Branch <span class="-req">*</span></label>
                                    <select class="form-control" name="branch">
                                        <option value="">-- Select Branch --</option>
                                        <?php foreach ($this->general_model->get_branches() as $key => $value) { ?>
                                            <option value="<?= $value['id'] ?>" <?= $value['id'] == set_value('branch')?'selected':'' ?>><?= $value['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <?= form_error('branch') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Type <span class="-req">*</span></label>
                                    <select class="form-control" name="type">
                                        <option value="">-- Select Type --</option>
                                        <option value="1" <?= selected(set_value('type'),"1") ?>>Manager</option>
                                        <option value="2" <?= selected(set_value('type'),"2") ?>>Senior</option>
                                        <option value="3" <?= selected(set_value('type'),"3") ?>>Junior</option>
                                    </select>
                                    <?= form_error('type') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Employee Details</h4>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Alt. Mobiles</label>
                                    <input name="alt_mobile" type="text" placeholder="Alt. Mobiles" autocomplete="off" class="form-control" value="<?= set_value('alt_mobile'); ?>">
                                    <?= form_error('alt_mobile') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Urgent Mobiles</label>
                                    <input name="urgent_mobile" type="text" placeholder="Urgent Mobiles" autocomplete="off" class="form-control" value="<?= set_value('urgent_mobile'); ?>">
                                    <?= form_error('urgent_mobile') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea name="address" type="text" placeholder="Address" autocomplete="off" class="form-control" ><?= set_value('address'); ?></textarea>
                                    <?= form_error('address') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Alt. Address</label>
                                    <textarea name="alt_address" type="text" placeholder="Alt. Address" autocomplete="off" class="form-control" ><?= set_value('alt_address'); ?></textarea>
                                    <?= form_error('alt_address') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Blood Group</label>
                                    <input name="blood_group" type="text" placeholder="Blood Group" autocomplete="off" class="form-control" value="<?= set_value('blood_group'); ?>">
                                    <?= form_error('blood_group') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Agreement Remarks</label>
                                    <textarea name="agreement" type="text" placeholder="Agreement Remarks" autocomplete="off" class="form-control" ><?= set_value('agreement'); ?></textarea>
                                    <?= form_error('agreement') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Agreement Attchment</label>
                                    <input type="file" name="agreement_att" class="form-control fileupload-change" onchange="readFile(this)">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Photo</label>
                                    <input type="file" name="photo" class="form-control fileupload-change" onchange="readFile(this)">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-right">
                <a href="<?= base_url('user/back_office') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-plus"></i> Add
                </button>
            </div>
        </form>
    </div>
</div>