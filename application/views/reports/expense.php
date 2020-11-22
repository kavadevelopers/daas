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
            
        </div>
    </div>
</div>

<div class="page-body">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <form method="post" action="<?= base_url('reports/expense_result') ?>">
                    <div class="card-block">
                        <div class="row">  
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>From Date <span class="-req">*</span></label> 
                                    <input name="fdate" type="text" placeholder="From Date" autocomplete="off" class="form-control form-control-sm datepicker" value="<?= $fdate ?>" required>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>To Date</label> 
                                    <input name="tdate" type="text" placeholder="To Date" autocomplete="off" class="form-control form-control-sm datepicker" value="<?= $tdate ?>">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <button class="btn btn-success btn-mini" style="margin-top: 30px;">
                                    <i class="fa fa-eye"></i> Show
                                </button>    
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <?php if($fdate != ""){ ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block">
                        <table class="table table-bordered table-striped table-sm" id="sales">
                            <thead>
                                <tr>
                                    <th class="text-center">Date</th>
                                    <th>Particulars</th>
                                    <th class="text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0; foreach($list as $key => $value){ ?>
                                    <tr>
                                        <td class="text-center"><?= vd($value['date']) ?></td>
                                        <th><?= $value['perticulars'] ?></th>
                                        <th class="text-right"><?= moneyFormatIndia($value['amount']) ?></th>
                                    </tr>
                                    <?php $total += $value['amount']; ?>
                                <?php } ?>
                                <tr>
                                    <th></th>
                                    <th class="text-right" >Total : </td>
                                    <th class="text-right">
                                        <?= moneyFormatIndia($total) ?>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>

<script type="text/javascript" language="javascript" >  
 $(function(){ 
    $('#sales').DataTable({
            "paging": false,
           "dom": "<'row'<'col-md-12 my-marD'B>><'row'<'col-md-6'l>>",
           buttons: [ 
                { 
                    extend: 'print',
                    title: 'Expense',
                    exportOptions: {
                        columns: [0,1,2]
                    }
                },
                { 
                    extend: 'pdf',
                    title: 'Expense',
                    exportOptions: {
                        columns: [0,1,2]
                    },customize: function (doc) {
                        doc.content[1].table.widths = ['*','*','*'];
                        doc.styles.tableHeader.alignment = 'center';
                        doc.styles.tableBodyOdd.alignment = 'center';
                        doc.styles.tableBodyEven.alignment = 'center';
                    }
                },
                { 
                    extend: 'excel',
                    title: 'Expense',
                    exportOptions: {
                        columns: [0,1,2]
                    }
                }
                
            ],
            order : []
        }); 
    });
</script>