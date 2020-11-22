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
        <form method="post" action="<?= base_url('user/update_sales_person') ?>" enctype="multipart/form-data">
            <div class="card-block">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Name <span class="-req">*</span></label>
                                    <input name="name" type="text" placeholder="Name" class="form-control" value="<?= set_value('name',$user['name']); ?>">
                                    <?= form_error('name') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Username <span class="-req">*</span></label>
                                    <input name="username" type="text" placeholder="Username" class="form-control" value="<?= set_value('username',$user['username']); ?>">
                                    <?= form_error('username') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" type="text" placeholder="Password" class="form-control" value="<?= set_value('password'); ?>">
                                    <?= form_error('password') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Mobile <span class="-req">*</span></label>
                                    <input name="mobile" type="text" placeholder="Mobile" class="form-control" value="<?= set_value('mobile',$user['mobile']); ?>">
                                    <?= form_error('mobile') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Email <span class="-req">*</span></label>
                                    <input name="email" type="text" placeholder="Email" class="form-control" value="<?= set_value('email',$user['email']); ?>">
                                    <?= form_error('email') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Gender <span class="-req">*</span></label>
                                    <select class="form-control" name="gender">
                                        <option value="Male" <?= set_value('gender',$user['gender']) == 'Male'?'selected':'' ?>>Male</option>
                                        <option value="Female" <?= set_value('gender',$user['gender']) == 'Female'?'selected':'' ?>>Female</option>
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
                                            <option value="<?= $value['id'] ?>" <?= $value['id'] == set_value('branch',$user['branch'])?'selected':'' ?>><?= $value['name'] ?></option>
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
                                        <option value="1" <?= selected(set_value('type',$user['type']),"1") ?>>Field Sales</option>
                                        <option value="2" <?= selected(set_value('type',$user['type']),"2") ?>>Tele Sales</option>
                                        <option value="3" <?= selected(set_value('type',$user['type']),"3") ?>>Freelance Sales</option>
                                        <option value="4" <?= selected(set_value('type',$user['type']),"4") ?>>Admin Tele Sales</option>
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
                                    <input name="alt_mobile" type="text" placeholder="Alt. Mobiles" autocomplete="off" class="form-control" value="<?= set_value('alt_mobile',$detail['alternet_mobile']); ?>">
                                    <?= form_error('alt_mobile') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Urgent Mobiles</label>
                                    <input name="urgent_mobile" type="text" placeholder="Urgent Mobiles" autocomplete="off" class="form-control" value="<?= set_value('urgent_mobile',$detail['urgent_mobile']); ?>">
                                    <?= form_error('urgent_mobile') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea name="address" type="text" placeholder="Address" autocomplete="off" class="form-control" ><?= set_value('address',$detail['address']); ?></textarea>
                                    <?= form_error('address') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Alt. Address</label>
                                    <textarea name="alt_address" type="text" placeholder="Alt. Address" autocomplete="off" class="form-control" ><?= set_value('alt_address',$detail['alternet_address']); ?></textarea>
                                    <?= form_error('alt_address') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Blood Group</label>
                                    <input name="blood_group" type="text" placeholder="Blood Group" autocomplete="off" class="form-control" value="<?= set_value('blood_group',$detail['blood_group']); ?>">
                                    <?= form_error('blood_group') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Agreement Remarks</label>
                                    <textarea name="agreement" type="text" placeholder="Agreement Remarks" autocomplete="off" class="form-control" ><?= set_value('agreement',$detail['agreement_remarks']); ?></textarea>
                                    <?= form_error('agreement') ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Agreement Attchment</label>
                                    <input type="file" name="agreement_att" class="form-control fileupload-change" onchange="readFile(this)">
                                    <div class="row col-md-12" style="margin-top: 5px;">
                                        <?php if($detail['agreement']!=""){ 
                                            $agreementFile = $detail['agreement'];$agreementEx = pathinfo($detail['agreement'], PATHINFO_EXTENSION); ?>

                                            <?php if($agreementEx == 'png' || $agreementEx == 'jpg' || $agreementEx == 'jpeg'){ ?>
                                                <img src="<?= base_url('uploads/doc/').$dovalue['file'] ?>" class="list-images" style="width: 20px;"> 
                                            <?php } ?>
                                            <?php if($agreementEx == 'docx'){ ?>
                                                <img src="<?= base_url('asset/images/word.jpg') ?>" class="list-images" style="width: 20px;"> 
                                            <?php } ?>
                                            <?php if($agreementEx == 'csv' || $agreementEx == 'xlsx'){ ?>
                                                <img src="<?= base_url('asset/images/excel.jpg') ?>" class="list-images" style="width: 20px;"> 
                                            <?php } ?>
                                            <?php if($agreementEx == 'pdf'){ ?>
                                                <img src="<?= base_url('asset/images/pdf.jpg') ?>" class="list-images" style="width: 20px;"> 
                                            <?php } ?>
                                            <span class="list-image-span" style="width: 70%;">Agreement</span>
                                            <a href="<?= base_url('uploads/employee/').$agreementFile ?>" target="_blank" title="Download" download="Agreement.<?=  $agreementEx ?>">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Photo</label>
                                    <input type="file" name="photo" class="form-control fileupload-change" onchange="readFile(this)">
                                    <div class="row col-md-12" style="margin-top: 5px;">
                                        <?php if($detail['photo']!=""){ 
                                            $photoFile = $detail['photo'];$photoFileEx = pathinfo($detail['photo'], PATHINFO_EXTENSION); ?>

                                            <?php if($photoFileEx == 'png' || $photoFileEx == 'jpg' || $photoFileEx == 'jpeg'){ ?>
                                                <img src="<?= base_url('uploads/employee/').$photoFile ?>" class="list-images" style="width: 20px;"> 
                                            <?php } ?>
                                            <?php if($photoFileEx == 'docx'){ ?>
                                                <img src="<?= base_url('asset/images/word.jpg') ?>" class="list-images" style="width: 20px;"> 
                                            <?php } ?>
                                            <?php if($photoFileEx == 'csv' || $photoFileEx == 'xlsx'){ ?>
                                                <img src="<?= base_url('asset/images/excel.jpg') ?>" class="list-images" style="width: 20px;"> 
                                            <?php } ?>
                                            <?php if($photoFileEx == 'pdf'){ ?>
                                                <img src="<?= base_url('asset/images/pdf.jpg') ?>" class="list-images" style="width: 20px;"> 
                                            <?php } ?>
                                            <span class="list-image-span" style="width: 70%;">Photo</span>
                                            <a href="<?= base_url('uploads/employee/').$photoFile ?>" target="_blank" title="Download" download="Photo.<?=  $photoFileEx ?>">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                </div>
            </div>

            <div class="card-footer text-right">
                <a href="<?= base_url('user/sales_person') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-save"></i> Save
                </button>
            </div>
        </form>
    </div>
</div>