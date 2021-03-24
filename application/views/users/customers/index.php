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
            <div class="col-md-6 text-right">
                 <a href="<?= base_url('customers/add') ?>" class="btn btn-primary btn-mini"><i class="fa fa-plus"></i> Add</a>  
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
                                <!-- <th class="text-center"></th> -->
                                <th>Name</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Gender</th>
                                <th class="text-center">Subscription</th>
                                <th class="text-center">Verified</th>
                                <th class="text-center">Wallet Balance</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $key => $value) { ?>
                                <tr>
                                    <!-- <td class="text-center">
                                        <img src="<?= base_url('uploads/user/').$value['image'] ?>" style="max-width: 50px;">
                                    </td> -->
                                    <td><?= $value['fname'].' '.$value['lname'] ?></td>
                                    <td class="text-center"><?= $value['mobile'] ?></td>
                                    <td class="text-center"><?= $value['gender'] ?></td>
                                    <td class="text-left">
                                        <?= ucfirst(checkSubscriptionExpiration($value['sub_expired_on'])) ?><br>
                                        <b>Registered At</b>
                                        <p><?= vd($value['registered_at']) ?></p>
                                        <b>Expired On</b>
                                        <p><?= vd($value['sub_expired_on']) ?></p>
                                    </td>
                                    <td class="text-center"><?= $value['verified'] ?></td>
                                    <td class="text-center">
                                        <?= rs().' '.number_format($this->general_model->getTotalPoints($value['id'],'amount'),2) ?><br>
                                        Points : <?= $this->general_model->getTotalPoints($value['id'],'point') ?>
                                    </td>
                                    <td class="text-center">
                                    	<?php if($value['block'] == "yes"){ ?>
                                    		<a href="<?= base_url('customers/block/').$value['id'] ?>" class="btn btn-mini btn-danger btn-status">Blocked</a>
                                    	<?php }else{ ?>
                                    		<a href="<?= base_url('customers/block/').$value['id'] ?>/yes" class="btn btn-mini btn-success btn-status">Active</a>
                                    	<?php } ?>
                                        <?php if($value['free'] == "yes"){ ?>
                                            <a href="<?= base_url('customers/paid/').$value['id'] ?>" class="btn btn-mini btn-danger btn-status">Free</a>
                                        <?php }else{ ?>
                                            <a href="<?= base_url('customers/paid/').$value['id'] ?>/yes" class="btn btn-mini btn-success btn-status">Paid</a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url('customers/edit/').$value['id'] ?>" class="btn btn-primary btn-mini" title="Edit">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button class="btn btn-primary btn-mini clsAddBalance" title="Add Balance" data-id="<?= $value['id'] ?>">
                                            <i class="fa fa-rupee"></i>
                                        </button>
                                        <a href="<?= base_url('customers/delete/').$value['id'] ?>" class="btn btn-danger btn-mini btn-delete" title="Delete">
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

<div class="modal fade" id="modalAddBalance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="<?= base_url('customers/add_balance') ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Wallet Balance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" name="amount" class="form-control decimal-num" placeholder="Amount" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" name="desc" class="form-control" placeholder="Description" required></textarea>
                    </div>
                    <input type="hidden" name="id" id="modalClientId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(function(){
        $('.clsAddBalance').click(function() {
            $('#modalClientId').val($(this).data('id'));
            $('#modalAddBalance').modal('show');
        });
    })
</script>