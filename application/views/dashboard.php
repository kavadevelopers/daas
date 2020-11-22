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
	<?php if(get_user()['user_type'] == '3'){ ?>
	   	<div class="row">
	   		<div class="col-md-6 col-xl-3">
                <div class="card user-widget-card bg-c-green">
                    <div class="card-block">
                        <i class="feather icon-file-text bg-simple-c-green card1-icon"></i>
                        <h4><?= $this->db->get_where('leads',['df' => '','owner'   => get_user()['id'] ,'date >=' => date("Y-m-1"),'date <=' => date("Y-m-t")])->num_rows(); ?></h4>
                        <p>Total Leads</p>
                        <a href="<?= base_url('leads') ?>" class="more-info">More Info</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card user-widget-card bg-c-yellow">
                    <div class="card-block">
                        <i class="feather icon-file-text bg-simple-c-yellow card1-icon"></i>
                        <h4><?= $this->db->get_where('leads',['df' => '','status !=' => '0','owner'    => get_user()['id'],'date >=' => date("Y-m-1"),'date <=' => date("Y-m-t")])->num_rows(); ?></h4>
                        <p>Converted Leads</p>
                        <a href="<?= base_url('leads/converted_leads') ?>" class="more-info">More Info</a>
                    </div>
                </div>
            </div>
            
	   	</div>
	<?php } ?>	
   	<div class="row">
   		<div class="col-md-6">
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
   		<?php if(get_user()['user_type'] == '3'){ ?>
	   		<div class="col-md-6">
	        	<div class="card">
	            	<div class="card-header" style="padding: 10px;">
	   					<div class="row"> 
		                    <div class="col-md-6">
		                    	<h5>Top 5 Services Sold In this month</h5>
		                    </div>
				        </div>
	                </div>
	                <div class="card-block">
	                	<table class="table table-bordered table-mini table-ndt">
	                		<tbody>
	                			<?php foreach ($top_five_services_sold as $key => $value) { ?>
	                				<tr>
	                					<td><?= $key + 1 ?></td>
		                				<td><?= $this->general_model->_get_service($value['service'])['name'] ?></td>
		                			</tr>
	                			<?php } ?>
	                		</tbody>
	                	</table>
	                </div>
	        	</div>
	        </div>
	    <?php } ?>
   	</div>

   	

   	
</div>




