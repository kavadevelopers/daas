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
                    <form method="post" action="<?= base_url('business_category/save') ?>" enctype="multipart/form-data">
                        <div class="card-block">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name <span class="-req">*</span></label>
                                    <input name="name" type="text" class="form-control" value="<?= set_value('name'); ?>" placeholder="Name" required>
                                    <?= form_error('name') ?>
                                </div>
                            </div>                 
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Type <span class="-req">*</span></label>
                                    <select class="form-control" name="type" id="typeCate" required>
                                        <option value="">-- Select --</option>
                                        <option value="supplier">Supplier</option>
                                        <option value="service">Service</option>
                                        <option value="alignment">Alignment</option>
                                        <option value="ourpartner">Our Partner</option>
                                    </select>
                                    <?= form_error('type') ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Admin Cutoff Percent <span class="-req">*</span></label>
                                    <input name="cutoff" type="text" class="form-control decimal-num" value="<?= set_value('cutoff'); ?>" placeholder="Admin Cutoff Percent" required>
                                    <?= form_error('cutoff') ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Add Shop Open Time Format-"hh:mm:ss" 24 hour format<span class="-req">*</span></label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input name="from" type="text" class="form-control" value="<?= set_value('from'); ?>" placeholder="From format-hh:mm:ss" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input name="to" type="text" class="form-control" value="<?= set_value('to'); ?>" placeholder="To format-hh:mm:ss" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Thumbnail <span class="-req">*</span></label>
                                    <input name="image" type="file" class="form-control" onchange="readFileImage(this)" value="<?= set_value('image'); ?>" required>
                                    <?= form_error('image') ?>
                                </div>
                            </div> 
                            <div class="col-md-12" style="display: none;" id="containerMenu">
                                <div class="form-group">
                                    <label>Menu <span class="-req">*</span></label>
                                    <input name="menu" type="file" class="form-control" onchange="pdfImageAllowed(this)" value="<?= set_value('menu'); ?>" id="menuFile">
                                    <?= form_error('menu') ?>
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
                    <form method="post" action="<?= base_url('business_category/update') ?>" enctype="multipart/form-data">
                        <div class="card-block">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name <span class="-req">*</span></label>
                                    <input name="name" type="text" class="form-control" value="<?= set_value('name',$single['name']); ?>" placeholder="Name" required>
                                    <?= form_error('name') ?>
                                </div>
                            </div>    
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Type <span class="-req">*</span></label>
                                    <select class="form-control" name="type" id="typeCate" required>
                                        <option value="">-- Select --</option>
                                        <option value="supplier" <?= $single['type'] == "supplier"?'selected':''; ?>>Supplier</option>
                                        <option value="service" <?= $single['type'] == "service"?'selected':''; ?>>Service</option>
                                        <option value="alignment" <?= $single['type'] == "alignment"?'selected':''; ?>>Alignment</option>
                                        <option value="ourpartner" <?= $single['type'] == "ourpartner"?'selected':''; ?>>Our Partner</option>
                                    </select>
                                    <?= form_error('type') ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Admin Cutoff Percent <span class="-req">*</span></label>
                                    <input name="cutoff" type="text" class="form-control decimal-num" value="<?= set_value('cutoff',$single['cutoff']); ?>" placeholder="Admin Cutoff Percent" required>
                                    <?= form_error('cutoff') ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Add Shop Open Time Format-"hh:mm:ss" 24 hour format<span class="-req">*</span></label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input name="from" type="text" class="form-control" value="<?= set_value('from',$single['start']); ?>" placeholder="From format-hh:mm:ss" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input name="to" type="text" class="form-control" value="<?= set_value('to',$single['end']); ?>" placeholder="To format-hh:mm:ss" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Thumbnail</label>
                                    <input name="image" type="file" class="form-control" onchange="readFileImage(this)" value="<?= set_value('image'); ?>" >
                                    <?= form_error('image') ?>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <img src="<?= getCategoryThumb($single['image']) ?>" style="max-width: 50px;">
                            </div>
                            <div class="col-md-12" style="display: none;" id="containerMenu">
                                <div class="form-group">
                                    <label>Menu</label>
                                    <input name="menu" type="file" class="form-control" onchange="pdfImageAllowed(this)" value="<?= set_value('menu'); ?>" id="menuFile">
                                    <?= form_error('menu') ?>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="<?= getCategoryThumb($single['menu']) ?>" download>Download File</a>
                                </div>
                            </div>       
                        </div>
                        <div class="card-footer text-right">
                            <a href="<?= base_url('business_category') ?>" class="btn btn-danger">
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
                <div class="card-block table-responsive">
                    <table class="table table-striped table-bordered table-mini table-dt">
                        <thead>
                            <tr>
                                <th class="text-center">Type</th>
                                <th>Name</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Cutoff</th>
                                <th class="text-center">Shop Timing</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $key => $value) { ?>
                                <tr>
                                    <td class="text-center">
                                        <img src="<?= getCategoryThumb($value['image'])?>" style="max-width: 50px;">
                                    </td>
                                    <td><?= $value['name'] ?></td>
                                    <td class="text-center"><?= ucfirst($value['type'])  ?></td>
                                    <td class="text-center"><?= $value['cutoff']  ?>%</td>
                                    <td class="text-center"><?= $value['start']  ?> to <?= $value['end']  ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('business_category/edit/').$value['id'] ?>" class="btn btn-primary btn-mini">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('business_category/delete/').$value['id'] ?>" class="btn btn-danger btn-mini btn-delete">
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

<script type="text/javascript">
    $(function(){
        $('#typeCate').change(function() {
            if($(this).val() == "ourpartner"){
                $('#containerMenu').show();
                $('#menuFile').attr('required','required');
            }else{
                $('#containerMenu').hide();
                $('#menuFile').removeAttr('required');
            }
        });
        if($('#typeCate').val() == "ourpartner"){
            $('#containerMenu').show();
            $('#menuFile').attr('required','required');
        }else{
            $('#containerMenu').hide();
            $('#menuFile').removeAttr('required');
        }
    })
</script>