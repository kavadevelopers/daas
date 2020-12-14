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
                                <th class="text-center">#</th>
                                <th>Customer</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Category</th>
                                <th>Discription</th>
                                <th>Status</th>
                                <th class="text-center">Order Time</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $key => $value) { ?>
                                <tr>
                                    <td class="text-center">#<?= $value['order_id'] ?></td>
                                    <th><?= get_customer($value['userid'])['fname'] ?> <?= get_customer($value['userid'])['lname'] ?></th>
                                    <td class="text-center"><?= ucfirst($value['type']) ?></td>
                                    <td class="text-center"><?= _get_category($value['category'])['name'] ?></td>
                                    <td class="text-center"><?= nl2br($value['descr']) ?></td>
                                    <td><?= $value['notes'] ?></td>
                                    <td class="text-center"><?= getPretyDateTime($value['created_at']) ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-mini" onclick="assignService('<?= $value["id"] ?>','<?= $value["type"] ?>');" title="Assign Service Provider">
                                            <i class="fa fa-send"></i>
                                        </button>
                                        <a href="<?= base_url('orders/delete/').$value['id'] ?>/new" class="btn btn-danger btn-mini btn-delete" title="Delete">
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

<div class="modal fade" id="modalAssignService" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="<?= base_url('orders/assign_service') ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Service Provider</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Service Provider</label>
                        <select class="form-control select2n" name="service" required>
                            <option value="">-- Select --</option>
                            <?php foreach (getServiceProviders() as $skey => $svalue) { ?>
                                <option value="<?= $svalue['id'] ?>"><?= $svalue['fname'] ?> <?= $svalue['lname'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group" id="modalPriceContainer" style="display: none;">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control decimal-num" placeholder="Price" id="modalPrice">
                    </div>
                    <input type="hidden" name="id" id="modalOrderId">
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
    function assignService(id,type){
        $('.select2n').select2({
            dropdownParent: $('#modalAssignService .modal-content')
        });
        $('#modalAssignService').modal('show');
        $('#modalOrderId').val(id);
        if(type == 'delivery'){
            $('#modalPriceContainer').show(); 
            $('#modalPrice').val(''); 
            $('#modalPrice').prop('required',true); 
        }else{
            $('#modalPriceContainer').hide(); 
            $('#modalPrice').val(''); 
            $('#modalPrice').removeProp('required');
        }
    }
</script>