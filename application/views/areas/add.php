<div class="page-header">
    <div class="align-items-end">
        <div class="row">
            <div class="col-md-6">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4><?= $_title ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="card">
        <form method="post" action="<?= base_url('customers/save') ?>">
            <div class="card-block">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Area Name <span class="-req">*</span></label>
                            <input name="name" type="text" class="form-control" value="<?= set_value('name'); ?>" placeholder="Area Name">
                            <?= form_error('name') ?>
                        </div>
                        <div class="form-group">
                            <label>Services <span class="-req">*</span></label>
                            <div class="form-control">
                                <div class="checkbox-fade fade-in-primary d-">
                                    <label>
                                        <input type="checkbox" value="supplier" name="services[]">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">Supplier</span>
                                    </label>
                                </div>
                                <div class="checkbox-fade fade-in-primary d-">
                                    <label>
                                        <input type="checkbox" value="service" name="services[]">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">Service</span>
                                    </label>
                                </div>
                                <div class="checkbox-fade fade-in-primary d-">
                                    <label>
                                        <input type="checkbox" value="alignment" name="services[]">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">Alignment</span>
                                    </label>
                                </div>
                                <div class="checkbox-fade fade-in-primary d-">
                                    <label>
                                        <input type="checkbox" value="ourpartner" name="services[]">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">Our Partner</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-9">
                        <div id="map-canvas"></div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="<?= base_url('areas') ?>" class="btn btn-danger">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-save"></i> Save
                </button>
            </div>
        </form>
    </div>
</div>


<style type="text/css">
    #map-canvas{
        width: auto;
        height: 400px;
    }
</style>