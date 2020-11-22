<div class="modal fade" id="lead_transfer_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="<?= base_url('leads/transfer') ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lead Transfer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Select User <span class="-req">*</span></label> 
                            <select class="form-control form-control-sm select2n" name="owner" required>
                                <option value="">-- Select --</option>
                                <?php foreach ($this->general_model->get_lead_owners() as $bkey => $bvalue) { ?>
                                    <option value="<?= $bvalue['id'] ?>"><?= $bvalue['name'] ?> - <?= getRole($bvalue['user_type']) ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('owner') ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="lead" id="lead_tranfer_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Transfer</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="dueDateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Due Dates</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-mini table-ndt">
                        <tr>
                            <th>Date</th>
                            <th>Remarks</th>
                        </tr>
                        <?php $dueDates = $this->db->get_where('due_dates',['date >=' => date('Y-m-01'),'date <=' => date('Y-m-t')])->result_array(); ?>
                        <?php foreach ($dueDates as $dueDateskey => $dueDatesvalue) { ?>
                            <tr>
                                <td><?= vd($dueDatesvalue['date']) ?></td>
                                <td><?= $dueDatesvalue['remarks'] ?></td>
                            </tr>
                        <?php } ?>
                        <?php if(count($dueDates) == 0){ ?>
                            <tr>
                                <td class="text-center" colspan="2">No Data Found</td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="jobTransferModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="<?= base_url('job/transfer') ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Job Transfer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Select User <span class="-req">*</span></label> 
                            <select class="form-control form-control-sm select2n" name="owner" required>
                                <option value="">-- Select --</option>
                                <?php foreach ($this->general_model->get_job_owners() as $bkey => $bvalue) { ?>
                                    <option value="<?= $bvalue['id'] ?>"><?= $bvalue['name'] ?> - <?= _user_type($bvalue['id']) ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('owner') ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="jobs" id="jobIds">
                    <input type="hidden" name="type" id="typeJob">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Transfer</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="jobEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="#" id="jobEditForm"> 
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Job - <span id="editJobId"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">

                        <div class="form-group">
                            <h6 id="jobEditClientName">Client </h6>
                        </div>

                        <div class="form-group">
                            <label>Select Service <span class="-req">*</span></label> 
                            <select class="form-control form-control-sm" id="jobEditService" required>
                                <option value="">-- Select Service --</option>
                                <?php foreach ($this->general_model->get_services() as $sekey => $sevalue) { ?> 
                                    <option value="<?= $sevalue['id'] ?>"><?= $sevalue['name'] ?></option>
                                <?php } ?>
                            </select>   
                        </div>
                        <div class="form-group" <?php if(get_user()['user_type'] == '2'){ ?>style="display:none;"<?php } ?>>
                            <label>Price <span class="-req">*</span></label> 
                            <input type="text" id="jobEditPrice" class="form-control form-control-sm decimal-num" autocomplete="off" placeholder="Price" required>   
                        </div>
                        <div class="form-group">
                            <label>Importance <span class="-req">*</span></label>
                            <select class="form-control" id="editJobImportance" required>
                                <option value="">-- Select --</option>
                                <option value="NORMAL">NORMAL</option>
                                <option value="URGENT">URGENT</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="jobId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveJobBtn">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="leads_transfer_model" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="<?= base_url('leads/transfer_all') ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lead Transfer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Select User <span class="-req">*</span></label> 
                            <select class="form-control form-control-sm select2n" name="owner" required>
                                <option value="">-- Select --</option>
                                <?php foreach ($this->general_model->get_lead_owners() as $bkey => $bvalue) { ?>
                                    <option value="<?= $bvalue['id'] ?>"><?= $bvalue['name'] ?> - <?= getRole($bvalue['user_type']) ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('owner') ?>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="leads" value="" id="leadIds">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Transfer</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php if($this->uri->segment(1) == 'leads' || $this->uri->segment(2) == 'lead'){ ?>
<div class="modal fade bd-example-modal-lg" id="followup_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="" id="followupForm">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Followup</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Remarks <span class="-req">*</span></label> 
                            <textarea class="form-control" placeholder="Remarks" name="remarks" id="followup_remarks" required></textarea>
                            <?= form_error('owner') ?>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Next Followup Date <span class="-req">*</span></label> 
                                <input name="date" type="text" placeholder="Next Followup Date" class="form-control form-control-sm datepicker-new" value="<?= set_value('date',date('d-m-Y')); ?>" id="followup_date" readonly required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Next Follow up Time</label> 
                                <input name="nftime" type="text" placeholder="From" class="form-control form-control-sm hour-mask" value="" id="followup_timef">
                                <input name="nttime" type="text" placeholder="To" class="form-control form-control-sm hour-mask" value="" id="followup_timet">
                            </div>
                        </div>
                        <div class="checkbox-fade fade-in-primary d-">
                            <label>
                                <input type="checkbox" value="1" name="customer" id="customer_checkbox">
                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                <span class="text-inverse">Client ?</span>
                            </label>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" id="followup_save">Save</button>
                        </div>
                        <input type="hidden" name="id" id="id_followup_lead">
                        <input type="hidden" name="type" id="type_followup_lead">
                        <input type="hidden" name="cus" id="type_followup_cus">
                        <input type="hidden" name="message" id="message_followup">

                        <table class="table table-bordered table-mini table-no-padding" id="followup_table" style="max-width: 100%; display: none;">
                            <thead>
                                <th class="text-center">Next Followup</th>
                                <th class="text-center">Date</th>
                                <th>Remarks</th>
                                <th class="text-center">Is Client ?</th>
                                <?php if(get_user()['user_type'] == '0' || get_user()['user_type'] == '1'){ ?>
                                    <th>Followup By</th>
                                <?php } ?>
                            </thead>
                            <tbody id="followup_body">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php }else{ ?>

<div class="modal fade bd-example-modal-lg show" id="job_followup_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="" id="jobfollowupForm">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Followup</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div id="hideJobFollowupForm">
                            <div class="form-group">
                                <label>Remarks <span class="-req">*</span></label> 
                                <textarea class="form-control" placeholder="Remarks" name="remarks" id="followup_remarks" required></textarea>
                                <?= form_error('owner') ?>
                            </div>
                            <div class="form-group">
                                <label>Status<span class="-req">*</span></label>
                                <select class="form-control" name="status" id="jobStatus" required>
                                    <option value="">-- Select --</option>
                                    <?php foreach (getjobStatusList() as $key => $value) { ?>
                                        <?php if($key <= 3){ ?>
                                            <option value="<?= $key ?>"><?= $value ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="row" style="display: none;" id="followUpNeededJob">
                                <div class="col-md-6 form-group">
                                    <label>Next Followup Date <span class="-req">*</span></label> 
                                    <input name="date" type="text" placeholder="Next Followup Date" class="form-control form-control-sm datepicker-new" value="" id="followup_date" autocomplete="off">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Next Follow up Time</label> 
                                    <input name="nftime" type="text" placeholder="From" class="form-control form-control-sm hour-mask" value="" id="followup_timef">
                                    <input name="nttime" type="text" placeholder="To" class="form-control form-control-sm hour-mask" value="" id="followup_timet">
                                </div>
                            </div>
                            <div class="checkbox-fade fade-in-primary d-">
                                <label>
                                    <input type="checkbox" value="1" name="" id="followup_needed">
                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                    <span class="text-inverse">Followup Needed ?</span>
                                </label>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary" id="followup_save">Save</button>
                            </div>
                            <input type="hidden" name="id" id="id_jobModel">
                            <input type="hidden" name="type" id="type_followup_job">
                            <input type="hidden" name="cus" id="type_followup_jobdone">
                            <input type="hidden" name="message" id="message_followup_job">
                        </div>
                        <table class="table table-bordered table-mini table-no-padding" id="jobfollowup_table" style="max-width: 100%; display: none;">
                            <thead>
                                <th class="text-center">Next Followup</th>
                                <th class="text-center">Date</th>
                                <th>Remarks</th>
                                <th class="text-center">Is Done ?</th>
                                <th class="text-center">Followup ?</th>
                                <?php if(get_user()['user_type'] == '0' || get_user()['user_type'] == '1'){ ?>
                                    <th>Followup By</th>
                                <?php } ?>
                            </thead>
                            <tbody id="jobfollowup_body">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php } ?>

<div class="modal fade bd-example-modal-lg show" id="payment_followup_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="" id="paymentfollowupForm">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Followup</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div id="hideJobFollowupForm">
                            <div class="form-group">
                                <label>Remarks <span class="-req">*</span></label> 
                                <textarea class="form-control" placeholder="Remarks" name="remarks" id="payment_followup_remarks" required></textarea>
                                <?= form_error('owner') ?>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Next Followup Date <span class="-req">*</span></label> 
                                    <input name="date" type="text" placeholder="Next Followup Date" class="form-control form-control-sm datepicker-new" autocomplete="off" value="" id="payment_followup_date">
                                </div>
                            </div>
                            <div class="checkbox-fade fade-in-primary d-" style="display: none;">
                                <label>
                                    <input type="checkbox" value="1" name="" id="payment_done">
                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                    <span class="text-inverse">Done ?</span>
                                </label>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary" id="payment_followup_save">Save</button>
                            </div>
                            <input type="hidden" name="id" id="id_paymentModel">
                            <input type="hidden" name="type" value="payment">
                        </div>
                        <table class="table table-bordered table-mini table-no-padding" id="paymentfollowup_table" style="max-width: 100%; display: none;">
                            <thead>
                                <th class="text-center">Next Followup</th>
                                <th class="text-center">Date</th>
                                <th>Remarks</th>
                                <th class="text-center">Is Done ?</th>
                                <?php if(get_user()['user_type'] == '0' || get_user()['user_type'] == '1'){ ?>
                                    <th>Followup By</th>
                                <?php } ?>
                            </thead>
                            <tbody id="paymentfollowup_body">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="add_payment_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="<?= base_url('payment/save') ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Receipt</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Client <span class="-req">*</span></label> 
                                <select class="form-control form-control-sm addPaymentClient" name="client" required>
                                    <option value="">-- Select --</option>
                                    <?php foreach ($this->general_model->getFilteredClients() as $bkey => $bvalue) { ?>
                                        <option value="<?= $bvalue['id'] ?>"><?= $bvalue['c_id'] ?> - <?= $bvalue['fname'] ?> <?= $bvalue['mname'] ?> <?= $bvalue['lname'] ?> - <?= $bvalue['mobile'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date <span class="-req">*</span></label> 
                                <input name="date" type="text" placeholder="Date" class="form-control form-control-sm datepicker" value="<?= set_value('date',date('d-m-Y')); ?>" readonly required>
                                <?= form_error('date') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Amount <span class="-req">*</span></label> 
                            <input type="text" name="amount" class="form-control form-control-sm decimal-num" autocomplete="off" placeholder="Amount" required>   
                        </div>
                        <div class="col-md-6">
                            <label>Payment Type <span class="-req">*</span></label> 
                            <select class="form-control form-control-sm" name="payment_type" required>
                                <option value="">-- Select --</option>
                                <option value="Cash">Cash</option>
                                <option value="Bank">Bank</option>
                                <option value="UPI">UPI</option>
                                <option value="Cheque">Cheque</option>
                            </select> 
                        </div>
                        <div class="col-md-6">
                            <label>Payment Remarks </label> 
                            <input type="text" name="pay_remarks" class="form-control form-control-sm" autocomplete="off" placeholder="Payment Remarks" > 
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks</label> 
                                <textarea class="form-control" name="remarks" placeholder="Remarks"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="edit_payment_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="<?= base_url('payment/update') ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date <span class="-req">*</span></label> 
                                <input name="date" type="text" placeholder="Date" class="form-control form-control-sm datepicker" id="editPaymentDate" value="<?= set_value('date',date('d-m-Y')); ?>" readonly required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Amount <span class="-req">*</span></label> 
                            <input type="text" name="amount" class="form-control form-control-sm decimal-num" id="editPaymentAmount" autocomplete="off" placeholder="Amount" required>   
                        </div>
                        <div class="col-md-6">
                            <label>Payment Type <span class="-req">*</span></label> 
                            <select class="form-control" name="payment_type" id="editPaymentType" required>
                                <option value="">-- Select --</option>
                                <option value="Cash">Cash</option>
                                <option value="Bank">Bank</option>
                                <option value="UPI">UPI</option>
                                <option value="Cheque">Cheque</option>
                            </select> 
                        </div>
                        <div class="col-md-6">
                            <label>Payment Remarks </label> 
                            <input type="text" name="pay_remarks" class="form-control form-control-sm" id="editPaymentPayRemarks" autocomplete="off" placeholder="Payment Remarks" > 
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Client <span class="-req">*</span></label> 
                                <select class="form-control form-control-sm editPaymentClient" name="client" required id="editPaymentClient">
                                    <option value="">-- Select --</option>
                                    <?php foreach ($this->general_model->getFilteredClients() as $bkey => $bvalue) { ?>
                                        <option value="<?= $bvalue['id'] ?>"><?= $bvalue['c_id'] ?> - <?= $bvalue['fname'] ?> <?= $bvalue['mname'] ?> <?= $bvalue['lname'] ?> - <?= $bvalue['mobile'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks</label> 
                                <textarea class="form-control" name="remarks" placeholder="Remarks" id="editPaymentRemarks"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="editPaymentId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="modal fade" id="add_todo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="<?= base_url('todo/save') ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add To-Do</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12"> 
                        <div class="row">
                            <input type="hidden" name="owner" value="<?= get_user()['id'] ?>">
                            <div class="col-md-6 form-group">
                                <label>Date <span class="-req">*</span></label> 
                                <input name="date" type="text" placeholder="Date" class="form-control form-control-sm datepicker" value="<?= set_value('date',date('d-m-Y')); ?>" readonly required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Time</label> 
                                <input name="ftime" type="text" placeholder="From" class="form-control form-control-sm hour-mask" value="">
                                <input name="ttime" type="text" placeholder="To" class="form-control form-control-sm hour-mask" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Remarks <span class="-req">*</span></label> 
                            <textarea class="form-control" name="remarks" placeholder="Remarks" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="edit_todo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="<?= base_url('todo/update') ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Edit To-Do</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Date <span class="-req">*</span></label> 
                                <input name="date" type="text" id="editToDoDate" placeholder="Date" class="form-control form-control-sm datepicker" value="" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Time</label> 
                                <input name="ftime" type="text" id="editToDoFtime" placeholder="From" class="form-control form-control-sm hour-mask" value="">
                                <input name="ttime" type="text" id="editToDoTtime" placeholder="To" class="form-control form-control-sm hour-mask" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Remarks <span class="-req">*</span></label> 
                            <textarea class="form-control" name="remarks" id="editToDoRemarks" placeholder="Remarks" required></textarea>
                        </div>
                        <div class="checkbox-fade fade-in-primary d-">
                            <label>
                                <input type="checkbox" value="1" name="needed" id="">
                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                <span class="text-inverse">Followup Needed ?</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="editToDoId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade bd-example-modal-lg" id="generateBillModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="<?= base_url('generate_bill/single') ?>">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Generate Bill</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="clientDataBill">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                              <div class="form-group">
                                <label>Service <span class="-req">*</span></label> 
                                <input name="" type="text" placeholder="Service" class="form-control form-control-sm" id="generateBillService" value="" readonly>
                            </div>
                        </div>    
                        <div class="col-md-3">
                              <div class="form-group">
                                <label>Qty <span class="-req">*</span></label> 
                                <input name="qty" type="text" placeholder="Qty" class="form-control form-control-sm numbers" id="generateBillQty" value="" required>
                            </div>
                        </div>    
                        <div class="col-md-3">
                              <div class="form-group">
                                <label>Price <span class="-req">*</span></label>
                                <input name="price" type="text" placeholder="Price" class="form-control form-control-sm decimal-num" id="generateBillPrice" value="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                              <div class="form-group">
                                    <label>Total</label>
                                    <input name="" type="text" placeholder="Total" class="form-control form-control-sm" id="generateBillTotal" value="" readonly>
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks</label> 
                                <textarea class="form-control" name="remarks" placeholder="Remarks" ></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="job" id="generateBillJob">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Generate</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="generateAllBillModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="<?= base_url('generate_bill/all') ?>">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Generate Bill</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="clientDataBills">
                            
                        </div>
                    </div>
                    <div class="row" id="generateAllBillAppend">
                           
                    </div>
                    <div class="row">
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Invoice Total</label>
                                <input name="" type="text" placeholder="Invoice Total" class="form-control form-control-sm" id="generateBillsTotal" value="" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks</label> 
                                <textarea class="form-control" name="remarks" placeholder="Remarks" ></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="client" id="generateAllBillClient">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Generate</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="editInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="<?= base_url('invoices/update') ?>">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editInvoiceModalTitle">Edit Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="editInvoiceClient">
                            
                        </div>
                    </div>
                    <div class="row" id="editBillDataServices">
                           
                    </div>
                    <div class="row">
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Invoice Total</label>
                                <input name="" type="text" placeholder="Invoice Total" class="form-control form-control-sm" id="editInvoiceModalTotal" value="" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks</label> 
                                <textarea class="form-control" name="remarks" placeholder="Remarks" id="editInvoiceRemarks"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="invoice" id="editInvoiceId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
    

<div class="modal fade" id="add_job_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="<?= base_url('job/save') ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Client <span class="-req">*</span></label> 
                                    <select class="form-control form-control-sm select2n" name="client" required>
                                        <option value="">-- Select --</option>
                                        <?php foreach ($this->general_model->getFilteredClients() as $bkey => $bvalue) { ?>
                                            <option value="<?= $bvalue['id'] ?>"><?= $bvalue['c_id'] ?> - <?= $bvalue['fname'] ?> <?= $bvalue['mname'] ?> <?= $bvalue['lname'] ?> - <?= $bvalue['mobile'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>For <span class="-req">*</span></label> 
                                    <select class="form-control form-control-sm select2n" name="owner" required>
                                        <option value="">-- Select --</option>
                                        <?php foreach ($this->general_model->get_job_owners() as $bkey => $bvalue) { ?>
                                            <option value="<?= $bvalue['id'] ?>"><?= $bvalue['name'] ?> - <?= getRole($bvalue['user_type']) ?> - <?= _user_type($bvalue['id']) ?></option>
                                        <?php } ?>
                                    </select>
                                    <?= form_error('owner') ?>
                                </div>        
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Service <span class="-req">*</span></label> 
                                    <select class="form-control form-control-sm serviceToPrice select2n" id="jobAddService" name="service" required>
                                        <option value="">-- Select Service --</option>
                                        <?php foreach ($this->general_model->get_services() as $sekey => $sevalue) { ?> 
                                            <option value="<?= $sevalue['id'] ?>-<?= $sevalue['price'] ?>"><?= $sevalue['name'] ?></option>
                                        <?php } ?>
                                    </select>   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price <span class="-req">*</span></label> 
                                    <input type="text" id="jobAddPrice" class="form-control form-control-sm decimal-num serviewFromPrice" name="price" autocomplete="off" placeholder="Price" required>   
                                </div>
                            </div>
                        </div>
                        
                        
                        <!-- <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Date <span class="-req">*</span></label> 
                                <input name="date" type="text" placeholder="Date" class="form-control form-control-sm datepicker-new" value="<?= set_value('date',date('d-m-Y')); ?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Time</label> 
                                <input name="ftime" type="text" placeholder="From" class="form-control form-control-sm hour-mask" value="">
                                <input name="ttime" type="text" placeholder="To" class="form-control form-control-sm hour-mask" value="">
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="<?= base_url('task/save') ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>For <span class="-req">*</span></label> 
                            <select class="form-control form-control-sm select2n" name="to" required>
                                <option value="">-- Select --</option>
                                <?php foreach ($this->general_model->get_task_users() as $bkey => $bvalue) { ?>
                                    <option value="<?= $bvalue['id'] ?>"><?= $bvalue['name'] ?> - <?= getRole($bvalue['user_type']) ?> - <?= _user_type($bvalue['id']) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Particulars <span class="-req">*</span></label> 
                            <input type="text" class="form-control form-control-sm" name="name" autocomplete="off" placeholder="Particulars" required>   
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Transactions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-ndt">
                        <thead>
                            <tr>
                                <th class="text-center">Date</th>
                                <th>Particulars</th>
                                <th class="text-center">Inv/Receipt No.</th>
                                <th class="text-right">Debit</th>
                                <th class="text-right">Credit</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-transactionModal">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="modal fade" id="addNewFollowupJobModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="<?= base_url('newjob/save') ?>">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Work Followup</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php if(get_user()['user_type'] == "0"){ ?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Branch <span class="-req">*</span></label> 
                                    <select class="form-control form-control-sm select2n" name="branch" required>
                                        <option value="">-- Select Branch --</option>
                                        <?php foreach ($this->general_model->get_branches() as $bkey => $bvalue) { ?>
                                            <option value="<?= $bvalue['id'] ?>"><?= $bvalue['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        <?php }else{ ?>
                            <input type="hidden" name="branch" value="<?= get_user()['branch'] ?>">
                        <?php } ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select Client <span class="-req">*</span></label> 
                                <select class="form-control form-control-sm select2n" name="client" required>
                                    <option value="">-- Select --</option>
                                    <?php foreach ($this->general_model->getFilteredClients() as $bkey => $bvalue) { ?>
                                        <option value="<?= $bvalue['id'] ?>"><?= $bvalue['c_id'] ?> - <?= $bvalue['fname'] ?> <?= $bvalue['mname'] ?> <?= $bvalue['lname'] ?> - <?= $bvalue['mobile'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Next Followup Date </label> 
                            <input name="date" type="text" placeholder="Next Followup Date" class="form-control form-control-sm datepicker-new" value="" autocomplete="off">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Next Follow up Time</label> 
                            <div class="row">
                                <div class="col-md-6">
                                    <input name="from" type="text" placeholder="From" class="form-control form-control-sm hour-mask" value="">
                                </div>
                                <div class="col-md-6">
                                    <input name="to" type="text" placeholder="To" class="form-control form-control-sm hour-mask" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Select Service <span class="-req">*</span></label> 
                                <div class="service-body-newwork">
                                    <select class="form-control form-control-sm select2n service-change-newwork" name="service[]" required>
                                        <option value="">-- Select Service --</option>
                                        <?php foreach ($this->general_model->get_services() as $sekey => $sevalue) { ?> 
                                            <option value="<?= $sevalue['id'] ?>-<?= $sevalue['price'] ?>"><?= $sevalue['name'] ?></option>
                                        <?php } ?>
                                    </select>   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Price <span class="-req">*</span></label> 
                                <div class="amount-body-newwork">
                                    <input type="text" class="form-control form-control-sm decimal-num" name="price[]" autocomplete="off" placeholder="price" required>   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks</label> 
                                <textarea class="form-control" placeholder="Remarks" name="remarks" ></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="modal fade" id="resone_for_dump_model" tabindex="-1" role="dialog" aria-hidden="true">
    <form method="post" action="<?= base_url('leads/dump') ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Transfer To Dump</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12"> 
                        <input type="hidden" name="lead" id="dump_model_lead_id" value="">    
                        <div class="form-group">
                            <label>Reson Remarks <span class="-req">*</span></label> 
                            <textarea class="form-control" name="remarks" placeholder="Remarks" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Transfer</button>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="modal fade" id="add_vendor_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form method="post" action="<?= base_url('vendor_list/save') ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Vendor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name <span class="-req">*</span></label> 
                                    <input name="name" type="text" placeholder="Name" class="form-control form-control-sm" value="" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category <span class="-req">*</span></label> 
                                    <input type="text" class="form-control form-control-sm" name="category" placeholder="Category" required>   
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mobile <span class="-req">*</span></label> 
                                    <input name="mobile" type="text" placeholder="Mobile" class="form-control form-control-sm" value="" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address <span class="-req">*</span></label> 
                                    <textarea type="text" class="form-control form-control-sm" name="address" placeholder="Address" required></textarea>   
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Remarks</label> 
                            <textarea type="text" class="form-control form-control-sm" name="remarks" placeholder="Remarks"></textarea>   
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="add_pettycash_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form method="post" action="<?= base_url('petty_cash/save') ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Petty Cash</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if(get_user()['user_type'] == 0){ ?>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>User/Owner <span class="-req">*</span></label> 
                                        <select class="form-control form-control-sm select2n" name="user" required>
                                            <option value="">-- Select --</option>
                                            <?php foreach ($this->general_model->get_pettycash_users() as $bkey => $bvalue) { ?>
                                                <option value="<?= $bvalue['id'] ?>"><?= $bvalue['name'] ?> - <?= _user_type($bvalue['id']) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Type <span class="-req">*</span></label> 
                                        <select class="form-control form-control-sm" name="type" required>
                                            <option value="credit">Credit</option>
                                            <option value="debit">Debit</option>
                                        </select>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    <?php } ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date <span class="-req">*</span></label> 
                                    <input name="date" type="text" placeholder="Date" class="form-control form-control-sm datepicker" value="<?= date('d-m-Y') ?>" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Amount <span class="-req">*</span></label> 
                                    <input type="text" class="form-control form-control-sm decimal-num" name="amount" autocomplete="off" placeholder="Amount" required>    
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Perticulars</label> 
                            <textarea type="text" class="form-control form-control-sm" name="remarks" placeholder="Perticulars"></textarea>   
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="add_reimburs_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form method="post" action="<?= base_url('reimburs/save') ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Reimbursement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Select Client <span class="-req">*</span></label> 
                            <select class="form-control form-control-sm select2n" name="client" required>
                                <option value="">-- Select --</option>
                                <?php foreach ($this->general_model->getFilteredClients() as $bkey => $bvalue) { ?>
                                    <option value="<?= $bvalue['id'] ?>"><?= $bvalue['c_id'] ?> - <?= $bvalue['fname'] ?> <?= $bvalue['mname'] ?> <?= $bvalue['lname'] ?> - <?= $bvalue['mobile'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date <span class="-req">*</span></label> 
                                    <input name="date" type="text" placeholder="Date" class="form-control form-control-sm datepicker" value="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Amount <span class="-req">*</span></label> 
                                    <input type="text" class="form-control form-control-sm decimal-num" name="amount" autocomplete="off" placeholder="Amount" required>   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">    
                        <div class="form-group">
                            <label>Perticulars <span class="-req">*</span></label> 
                            <textarea class="form-control" name="remarks" placeholder="Perticulars" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="edit_reimburs_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form method="post" action="<?= base_url('reimburs/update') ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Reimbursement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Select Client <span class="-req">*</span></label> 
                            <select class="form-control form-control-sm select2n" name="client" id="editReimbursClient" required>
                                <option value="">-- Select --</option>
                                <?php foreach ($this->general_model->getFilteredClients() as $bkey => $bvalue) { ?>
                                    <option value="<?= $bvalue['id'] ?>"><?= $bvalue['c_id'] ?> - <?= $bvalue['fname'] ?> <?= $bvalue['mname'] ?> <?= $bvalue['lname'] ?> - <?= $bvalue['mobile'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date <span class="-req">*</span></label> 
                                    <input name="date" type="text" id="editReimbursDate" placeholder="Date" class="form-control form-control-sm datepicker" value="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Amount <span class="-req">*</span></label> 
                                    <input type="text" class="form-control form-control-sm decimal-num" id="editReimbursAmount" name="amount" autocomplete="off" placeholder="Amount" required>   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label>Perticulars <span class="-req">*</span></label> 
                            <textarea class="form-control" name="remarks" id="editReimbursRemarks" placeholder="Perticulars" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="editReimbursId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="add_document" tabindex="-1" role="dialog" aria-hidden="true">
    <form method="post" action="<?= base_url('documents/save') ?>">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Document</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Client<span class="-req">*</span></label> 
                                    <select class="form-control form-control-sm select2n" name="client" required>
                                        <option value="">-- Select --</option>
                                        <?php foreach ($this->general_model->getFilteredClients() as $bkey => $bvalue) { ?>
                                            <option value="<?= $bvalue['id'] ?>"><?= $bvalue['c_id'] ?> - <?= $bvalue['fname'] ?> <?= $bvalue['mname'] ?> <?= $bvalue['lname'] ?> - <?= $bvalue['mobile'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Responsible Person<span class="-req">*</span></label> 
                                    <input type="text" class="form-control form-control-sm" name="res_person" placeholder="Responsible Person" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cupboard<span class="-req">*</span></label> 
                                    <select class="form-control form-control-sm" name="cupboard" required>
                                        <option value="">-- Select --</option>
                                        <?php foreach ($this->general_model->get_cupboards() as $bkey => $bvalue) { ?>
                                            <option value="<?= $bvalue['name'] ?>"><?= $bvalue['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reck<span class="-req">*</span></label> 
                                    <select class="form-control form-control-sm" name="reck" required>
                                        <option value="">-- Select --</option>
                                        <?php foreach ($this->general_model->get_recks() as $bkey => $bvalue) { ?>
                                            <option value="<?= $bvalue['name'] ?>"><?= $bvalue['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Get Person(Remarks)<span class="-req">*</span></label> 
                                    <textarea class="form-control form-control-sm" name="get_person" placeholder="Get Person(Remarks)" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sent Person(Remarks)</label> 
                                    <textarea class="form-control form-control-sm" name="sent_person" placeholder="Sent Person(Remarks)"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Get Date<span class="-req">*</span></label> 
                                <input name="get_date" type="text" placeholder="Get Date" class="form-control form-control-sm datepicker" value="<?= date('d-m-Y'); ?>" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Sent Date</label> 
                                <input name="sent_date" type="text" placeholder="Sent Date" class="form-control form-control-sm datepicker" value=""/>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Remarks</label> 
                                    <textarea class="form-control form-control-sm" name="remarks" placeholder="Remarks"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="checkbox-fade fade-in-primary d- col-md-12">
                        <label>
                            <input type="checkbox" value="1" name="verified">
                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                            <span class="text-inverse">Verified ?</span>
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="modal fade" id="edit_document" tabindex="-1" role="dialog" aria-hidden="true">
    <form method="post" action="<?= base_url('documents/save') ?>" id="edit_document_form">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Document</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Client<span class="-req">*</span></label> 
                                    <select class="form-control form-control-sm select2n" name="client" id="edit_document_client" required>
                                        <option value="">-- Select --</option>
                                        <?php foreach ($this->general_model->getFilteredClients() as $bkey => $bvalue) { ?>
                                            <option value="<?= $bvalue['id'] ?>"><?= $bvalue['c_id'] ?> - <?= $bvalue['fname'] ?> <?= $bvalue['mname'] ?> <?= $bvalue['lname'] ?> - <?= $bvalue['mobile'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Responsible Person<span class="-req">*</span></label> 
                                    <input type="text" class="form-control form-control-sm" name="res_person" placeholder="Responsible Person" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cupboard<span class="-req">*</span></label> 
                                    <select class="form-control form-control-sm" name="cupboard" id="edit_document_cupboard" required>
                                        <option value="">-- Select --</option>
                                        <?php foreach ($this->general_model->get_cupboards() as $bkey => $bvalue) { ?>
                                            <option value="<?= $bvalue['name'] ?>"><?= $bvalue['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reck<span class="-req">*</span></label> 
                                    <select class="form-control form-control-sm" name="reck" id="edit_document_reck" required>
                                        <option value="">-- Select --</option>
                                        <?php foreach ($this->general_model->get_recks() as $bkey => $bvalue) { ?>
                                            <option value="<?= $bvalue['name'] ?>"><?= $bvalue['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Get Person(Remarks)<span class="-req">*</span></label> 
                                    <textarea class="form-control form-control-sm" name="get_person" id="edit_document_get_person" placeholder="Get Person(Remarks)" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sent Person(Remarks)</label> 
                                    <textarea class="form-control form-control-sm" name="sent_person" id="edit_document_sent_person" placeholder="Sent Person(Remarks)"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Get Date<span class="-req">*</span></label> 
                                <input name="get_date" type="text" placeholder="Get Date" class="form-control form-control-sm datepicker" value="<?= date('d-m-Y'); ?>" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Sent Date</label> 
                                <input name="sent_date" type="text" placeholder="Sent Date" class="form-control form-control-sm datepicker" value=""/>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Remarks</label> 
                                    <textarea class="form-control form-control-sm" id="edit_document_remarks" name="remarks" placeholder="Remarks"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="checkbox-fade fade-in-primary d- col-md-12">
                        <label>
                            <input type="checkbox" value="1" name="verified" id="edit_document_done">
                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                            <span class="text-inverse">Verified ?</span>
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="edit_document_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="edit_document_save">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
