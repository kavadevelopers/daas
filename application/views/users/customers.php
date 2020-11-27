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
    	<div class="col-md-12">
            <div class="card">
                <div class="card-block table-responsive">
                    <table class="table table-striped table-bordered table-mini table-dt">
                        <thead>
                            <tr>
                                <th class="text-center"></th>
                                <th>Name</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Gender</th>
                                <th class="text-center">Verified</th>
                                <th class="text-center">Blocked</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $key => $value) { ?>
                                <tr>
                                    <td class="text-center">
                                        <img src="<?= base_url('uploads/user/').$value['image'] ?>" style="max-width: 50px;">
                                    </td>
                                    <td><?= $value['fname'].' '.$value['lname'] ?></td>
                                    <td class="text-center"><?= $value['mobile'] ?></td>
                                    <td class="text-center"><?= $value['gender'] ?></td>
                                    <td class="text-center"><?= $value['verified'] ?></td>
                                    <td class="text-center">
                                    	<?php if($value['block'] == "yes"){ ?>
                                    		<a href="<?= base_url('customers/block/').$value['id'] ?>" class="btn btn-mini btn-danger btn-status">Blocked</a>
                                    	<?php }else{ ?>
                                    		<a href="<?= base_url('customers/block/').$value['id'] ?>/yes" class="btn btn-mini btn-success btn-status">Active</a>
                                    	<?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url('customers/delete/').$value['id'] ?>" class="btn btn-danger btn-mini btn-delete">
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