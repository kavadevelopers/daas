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

<?php if($this->session->flashdata('error') && !empty($this->session->flashdata('error'))){ ?>
<div class="page-body">
    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error') ?>         
            </div>      
        </div>
    </div>
</div>
<?php } ?>

<?php if($this->session->flashdata('msg') && !empty($this->session->flashdata('msg'))){ ?>
<div class="page-body">
    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-success">
                <?= $this->session->flashdata('msg') ?>         
            </div>      
        </div>
    </div>
</div>
<?php } ?>

<div class="page-body">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form method="post" action="<?= base_url('importexport/import_client') ?>" enctype="multipart/form-data">
                    <div class="card-block">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select File <span class="-req">*</span></label> 
                                    <input type="file" name="file" class="form-control" onchange="excelAlowed(this)" required>
                                </div>
                            </div>

                            <div class="col-md-3 text-center">
                                <a href="<?= base_url() ?>asset/client-template.xlsx" class="btn btn-mini btn-primary" style="margin-top: 36px;"><i class="fa fa-download"></i> Download Template</a>        
                            </div>

                            <?php if(file_exists(FCPATH.'backup/clients-backup.xlsx')){ ?>
                                <div class="col-md-3 text-center">
                                    <a href="<?= base_url() ?>backup/clients-backup.xlsx" class="btn btn-mini btn-danger" style="margin-top: 36px;"><i class="fa fa-download"></i> Download Error File</a>        
                                </div>
                            <?php } ?>
                            
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-mini btn-success"><i class="fa fa-upload"></i> Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>