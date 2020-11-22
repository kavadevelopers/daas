<div class="page-header">
    <div class="row align-items-end">
        <div class="col-md-12 text-right">
            <div class="page-header-title ">
            	<?php if(get_user()['user_type'] != '3'){ ?>
               		<button type="button" class="btn btn-warning btn-mini" data-toggle="modal" data-target="#dueDateModal">Due Dates</button>
               	<?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="page-body">


	<div class="row">
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-4 col-xl-4">
		            <div class="card user-widget-card bg-c-green">
		                <div class="card-block">
		                    <i class="feather icon-file-text bg-simple-c-green card1-icon"></i>
		                    <h4><?= $this->db->get_where('leads',['df' => '','owner'   => get_user()['id'] ,'date >=' => date("Y-m-1"),'date <=' => date("Y-m-t")])->num_rows(); ?></h4>
		                    <p>Total Leads</p>
		                    <a href="<?= base_url('leads') ?>" class="more-info">More Info</a>
		                </div>
		            </div>
		        </div>
		        <div class="col-md-4 col-xl-4">
		            <div class="card user-widget-card bg-c-yellow">
		                <div class="card-block">
		                    <i class="feather icon-file-text bg-simple-c-yellow card1-icon"></i>
		                    <h4><?= $this->db->get_where('leads',['df' => '','status !=' => '0','owner' => get_user()['id'],'date >=' => date("Y-m-1"),'date <=' => date("Y-m-t")])->num_rows(); ?></h4>
		                    <p>Converted Leads</p>
		                    <a href="<?= base_url('leads/converted_leads') ?>" class="more-info">More Info</a>
		                </div>
		            </div>
		        </div>
		        <div class="col-md-4 col-xl-4">
		            <div class="card user-widget-card bg-c-pink">
		                <div class="card-block">
		                    <i class="feather icon-file-text bg-simple-c-pink card1-icon"></i>
		                    <h4><?= $this->db->get_where('leads',['df' => '','dump' => 'yes','owner' => get_user()['id'],'date >=' => date("Y-m-1"),'date <=' => date("Y-m-t")])->num_rows(); ?></h4>
		                    <p>Dump Leads</p>
		                    <a href="<?= base_url('leads/dump_leads') ?>" class="more-info">More Info</a>
		                </div>
		            </div>
		        </div>
		        <div class="col-md-12">
		   			<div class="card">
		   				<div class="card-header">
		   					<div class="row"> 
			                    <div class="col-md-6">
			                    	<h5>To Do List</h5>
			                    </div>
			                    <div class="col-md-6 text-right">
						            <button class="btn btn-primary btn-sm btn-mini" type="button" id="addTodo">
						                <i class="fa fa-plus"></i> Add
						            </button>
						        </div>
					        </div>
		                </div>
		                <div class="card-block">
		                	<table class="table table-striped table-bordered table-mini table-dt">
				                <thead>
				                    <tr>
				                        <th class="text-center">Date</th>
				                        <th>Remarks</th> 
				                        <th class="text-center">Action</th>
				                    </tr>
				                </thead>
				                <tbody>
				                    <?php foreach ($todo as $key => $value) { ?>
				                        <tr>
				                            <td class="text-center" data-sort="<?= _sortdate($value['date']) ?>">
				                            	<?= vd($value['date']) ?>
				                            	<?= get_from_to($value['ftime'],$value['ttime']) ?>        
				                            </td>
				                            <td><?= nl2br($value['remarks']) ?></td>
				                            <td class="text-center">
				                                <button class="btn btn-danger btn-mini btn-delete delete-todo" data-id="<?= $value['id'] ?>" title="Delete">
				                                    <i class="fa fa-trash"></i>
				                                </button>
				                            </td>
				                        </tr>
				                    <?php } ?>
				                </tbody>
				            </table>
		                </div>
		   			</div>
		   		</div>
		   		<div class="col-md-12">
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
		                            <?php foreach ($my_task as $key => $value) { ?>
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
            	<div class="col-md-12">
            		<div class="card">
            			<div class="card-header">
		   					<div class="row"> 
			                    <div class="col-md-6">
			                    	<h5>Other Task</h5>
			                    </div>
			                    <div class="col-md-6 text-right">
						            <button class="btn btn-primary btn-sm btn-mini" type="button" id="addTask">
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
		                            <?php foreach ($other_task as $key => $value) { ?>
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
		<div class="col-md-3">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
			            <div class="card-header">
			                <h5>Leads</h5>
			            </div>
			            <div class="card-block">
			                <canvas id="leadChart" width="400" height="400"></canvas>
			            </div>
			        </div>
				</div>
				<div class="col-md-12">
					<div class="card">
			            <div class="card-header">
			                <h5>Top 5 Servies Sold</h5>
			            </div>
			            <div class="card-block">
			                <canvas id="pieChart" width="400" height="400"></canvas>
			            </div>
			        </div>
				</div>
	        </div>
		</div>
	</div>
</div>








<script type="text/javascript" src="<?= base_url() ?>asset/bower_components/chart.js/js/Chart.js"></script>

<script type="text/javascript">
	var labels_array = [];
	var total_count = [];
	<?php foreach ($top_five_services_sold as $key => $value) { ?>
		labels_array.push('<?= $value['total'].' - '.$this->general_model->_get_service($value['service'])['name'] ?>');
		total_count.push('<?= $value['total'] ?>');
	<?php } ?>
	
    var pieElem = document.getElementById("pieChart");
    var data4 = {
        labels: labels_array,
        datasets: [{
            data: total_count,
            backgroundColor: [
                "#99b898",
                "#feceab",
                "#ff847c",
                "#e84a5f",
                "#2a363b"
            ],
            hoverBackgroundColor: [
                "#99b898e6",
                "#feceabe6",
                "#ff847ce6",
                "#e84a5fe6",
                "#2a363be6"
            ]
        }]
    };

    var myPieChart = new Chart(pieElem, {
        type: 'pie',
        data: data4
    });


    var pieElem = document.getElementById("leadChart");
    var data4 = {
        labels: ['Total Leads','Converted Leads','Dump Leads'],
        datasets: [{
            data: ['<?= $this->db->get_where('leads',['df' => '','owner'   => get_user()['id'] ,'date >=' => date("Y-m-1"),'date <=' => date("Y-m-t")])->num_rows(); ?>','<?= $this->db->get_where('leads',['df' => '','status !=' => '0','owner' => get_user()['id'],'date >=' => date("Y-m-1"),'date <=' => date("Y-m-t")])->num_rows(); ?>','<?= $this->db->get_where('leads',['df' => '','dump' => 'yes','owner' => get_user()['id'],'date >=' => date("Y-m-1"),'date <=' => date("Y-m-t")])->num_rows(); ?>'],
            backgroundColor: [
                "#0ac282",
                "#fe9365",
                "#fe5d70"
            ],
            hoverBackgroundColor: [
                "#0ac282c6",
                "#fe9365c6",
                "#fe5d70c6"
            ]
        }]
    };

    var myPieChart = new Chart(pieElem, {
        type: 'pie',
        data: data4
    });
</script>