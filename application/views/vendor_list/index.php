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
            <?php if(get_user()['user_type'] == "0" || get_user()['user_type'] == "1" || (get_user()['user_type'] == "2" && get_user()['type'] == "1") || (get_user()['user_type'] == "3" && get_user()['type'] == "4")){ ?>
                <button class="btn btn-primary btn-mini add-new-vendor"><i class="fa fa-plus"></i> Add Vendor</button>
            <?php } ?>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="card">
        <div class="card-block dt-responsive table-responsive">
            <table class="table table-striped table-bordered table-mini table-dt">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Remarks</th>
                        <?php if(get_user()['user_type'] == "0" || get_user()['user_type'] == "1" || (get_user()['user_type'] == "2" && get_user()['type'] == "1") || (get_user()['user_type'] == "3" && get_user()['type'] == "4")){ ?>
                            <th class="text-center">Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $key => $single) { ?>
                        <tr>
                            <td><?= $single['name'] ?></td>
                            <td><?= $single['category'] ?></td>
                            <td><?= $single['mobile'] ?></td>
                            <td><?= nl2br($single['address']) ?></td>
                            <td><?= nl2br($single['remarks']) ?></td>
                            <?php if(get_user()['user_type'] == "0" || get_user()['user_type'] == "1" || (get_user()['user_type'] == "2" && get_user()['type'] == "1") || (get_user()['user_type'] == "3" && get_user()['type'] == "4")){ ?>
                                <td class="text-center">
                                    <a href="<?= base_url('vendor_list/delete/').$single['id'] ?>" class="btn btn-danger btn-mini btn-delete" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>