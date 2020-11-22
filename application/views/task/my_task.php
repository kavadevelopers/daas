
<div class="page-body">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="row"> 
                        <div class="col-md-6">
                            <h5>My Task</h5>
                        </div>
                    </div>
                </div>
                <div class="card-block dt-responsive table-responsive">
                    <table class="table table-striped table-bordered table-mini table-dt">
                        <thead>
                            <tr>
                                <th class="text-center">Date</th>
                                <th class="text-center">Reply</th>
                                <th>Particulars</th>
                                <th>From</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($task as $key => $value) { ?>
                                <tr>
                                    <td class="text-center" data-sort="<?= _sortdate($value['date']) ?>">
                                        <?= vd($value['date']) ?>        
                                    </td>
                                    <td class="text-center">
                                        <span class="pcoded-badge label label-danger">
                                            <?php $coReply = $this->db->get_where('task_reply',['to' => get_user()['id'],'read' => '0','task' => $value['id']])->num_rows(); ?>
                                            <?php 
                                                if($coReply > 9){
                                                    echo "9+";
                                                }else{
                                                    echo $coReply;
                                                }
                                            ?>
                                        </span>
                                    </td>
                                    <td class="td-big"><?= $value['name'] ?></td>
                                    <td><?= $this->general_model->_get_user($value['from'])['name'] ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('task/view/').$value['id'] ?>" class="btn btn-success btn-mini" data-id="<?= $value['id'] ?>" title="View">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="row"> 
                        <div class="col-md-6">
                            <h5>Other Task</h5>
                        </div>
                        <div class="col-md-6 text-right">
                            <button class="btn btn-primary btn-sm" type="button" id="addTask">
                                <i class="fa fa-plus"></i> Add
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-block dt-responsive table-responsive">
                    <table class="table table-striped table-bordered table-mini table-dt">
                        <thead>
                            <tr>
                                <th class="text-center">Date</th>
                                <th class="text-center">Reply</th>
                                <th>Particulars</th>
                                <th>To</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($other as $key => $value) { ?>
                                <tr>
                                    
                                    <td class="text-center" data-sort="<?= _sortdate($value['date']) ?>">
                                        <?= vd($value['date']) ?>        
                                    </td>
                                    <td class="text-center">
                                        <span class="pcoded-badge label label-danger">
                                            <?php $coReply = $this->db->get_where('task_reply',['to' => get_user()['id'],'read' => '0','task' => $value['id']])->num_rows(); ?>
                                            <?php 
                                                if($coReply > 9){
                                                    echo "9+";
                                                }else{
                                                    echo $coReply;
                                                }
                                            ?>
                                        </span>
                                    </td>
                                    <td class="td-big"><?= $value['name'] ?></td>
                                    <td><?= $this->general_model->_get_user($value['to'])['name'] ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('task/view/').$value['id'] ?>" class="btn btn-success btn-mini" data-id="<?= $value['id'] ?>" title="View">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="<?= base_url('task/done/').$value['id'] ?>" class="btn btn-danger btn-mini" onclick="return confirm('Are You sure you want to confirm?')" title="Delete">
                                            Done ?
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