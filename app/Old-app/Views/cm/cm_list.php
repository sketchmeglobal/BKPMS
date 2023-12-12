    <?= view('component/main_header') ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <style>
        .card{border-left: 4px solid #f7f7f7;}
        label{color:#000}
    </style>
</head>
<?php #echo '<pre>', print_r($approved_menu), '</pre>'; ?>
<body>
    
    <!-- validation and notification area -->
    <!-- <div class="d-none" id="validation_error"></div> -->
    
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper">
        
        <?= view('component/main_top_nav') ?>
        <?= view('component/main_side_nav') ?>
        
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Change Management</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?=base_url('portal/dashboard')?>">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Request List</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a data-toggle="modal" data-target="#addModal" class="btn btn-sm btn-success" href="<?=base_url('portal/add-cm-list')?>"> <i class="mdi mdi-plus"></i> Add</a>
                                </h4>
                                <div class="table-responsive">
                                    <table id="cm_list_table" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Ref. No.</th>
                                                <!-- <th>Initiator</th> -->
                                                <th>Start Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if((array)count($cm_list) > 0){ 
                                                $iter = 1;
                                                foreach($cm_list as $cl){
                                            ?>
                                                <tr>
                                                    <td><?=$iter++?>.</td>
                                                    <td><?=$cl->title?></td>
                                                    <td class="font-medium">
                                                        <?=str_pad($cl->reference_number, (CM_REF_LEADING_ZERO + 1), '0', STR_PAD_LEFT);?>
                                                    </td>
                                                    <!-- <td>< ?=$cl->project_inititor?></td> -->
                                                    <td><?= (($cl->proposed_start_date == '')) ? '-' : date('d-m-Y', strtotime($cl->proposed_start_date))?></td>
                                                    <td>
                                                        <a data-pk="<?=$cl->id?>" class="btn btn-sm btn-warning" href="<?=base_url('portal/change-management/edit-cm-list/') . $cl->id?>"> <i class="mdi mdi-table-edit"></i> Edit</a>
                                                        <button data-pk="<?=$cl->id?>" type="button" data-pk="<?=$cl->id?>" class="btn btn-sm btn-danger remove"> <i class="mdi mdi-minus"></i> Remove</button>
                                                    </td>
                                                </tr>
                                            <?php 
                                                }
                                            } 
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?= view('component/main_footer') ?>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="addModalLabel1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Request a Chage</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        
                        <form id="add_cm_form" class="form-horizontal r-separator" method="post">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="card-body bg-light">
                                        <?php
                                            // print_r($data_last_row);
                                            if(count((array)$data_last_row) == 0){
                                                $ref_no = CM_REF_PREFIX . CM_REF_START;
                                            }else{
                                                $no = str_pad(($data_last_row->reference_number + 1), (CM_REF_LEADING_ZERO + 1), '0', STR_PAD_LEFT);
                                                $ref_no = CM_REF_PREFIX . ($no);
                                            }
                                        ?>
                                        <h5 class="card-title m-t-10 p-b-20 text-info text-center font-weight-bold">Reference No. - <?=$ref_no?></h5>
                                        <div class="row border-bottom">
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="form-group row align-items-center m-b-0">
                                                    <label for="inputEmail3" class="col-3 text-right control-label col-form-label">Title</label>
                                                    <div class="col-9 border-left p-t-10 p-b-10">
                                                        <input required type="text" class="form-control" id="title" name="title" placeholder="Title Here">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="form-group row align-items-center m-b-0">
                                                    <label for="inputEmail3" class="col-3 text-right control-label col-form-label">Brief</label>
                                                    <div class="col-9 border-left p-t-10 p-b-10">
                                                        <textarea name="details" id="details" placeholder="Details here" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="form-group row align-items-center m-b-0">
                                                    <label for="inputEmail3" class="col-3 text-right control-label col-form-label">Proposed start date</label>
                                                    <div class="col-9 border-left p-t-10 p-b-10">
                                                        <input type="date" name="proposed_start_date" id="proposed_start_date" placeholder="Proposed start date" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="form-group row align-items-center m-b-0">
                                                    <label for="inputEmail3" class="col-3 text-right control-label col-form-label">Proposed end date</label>
                                                    <div class="col-9 border-left p-t-10 p-b-10">
                                                        <input type="date" name="proposed_end_date" id="proposed_end_date" placeholder="Proposed end date" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="row border-bottom">
                                            <div class="col-sm-12">
                                                <div class="form-group row align-items-center m-b-0">
                                                    <label for="inputEmail3" class="col-3 text-right control-label col-form-label">Justify time taken</label>
                                                    <div class="col-9 border-left p-t-10 p-b-10">
                                                        <textarea name="additional_info" id="additional_info" placeholder="Additional information" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="row border-bottom">
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="form-group row align-items-center m-b-0">
                                                    <label for="inputEmail3" class="col-3 text-right control-label col-form-label">Impact</label>
                                                    <div class="col-9 border-left p-t-10 p-b-10">
                                                        <select class="form-control" required name="cm_impact_id" id="cm_impact_id">
                                                            <option selected disabled value="">Select from the list</option>
                                                            <?php foreach($impact_list as $il){ ?>
                                                            <option value="<?=$il->id?>"><?=$il->impact_title?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="form-group row align-items-center m-b-0">
                                                    <label for="inputEmail3" class="col-3 text-right control-label col-form-label">Comment</label>
                                                    <div class="col-9 border-left p-t-10 p-b-10">
                                                        <textarea name="comments" id="comments" placeholder="Comment" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(isset($validation) and !empty($validation->listErrors())){ ?>
                                        <hr>
                                        <?= $validation->listErrors()?>
                                    <?php } ?>
                                    <hr>
                                    <div class="card-footer bg-white">
                                        <div class="form-group m-b-0 text-center">
                                            <input type="hidden" name="reference_number" value="<?=$data_last_row->reference_number + 1?>" class="d-none">
                                            <input type="hidden" name="project_inititor" value="<?=$project_inititor?>" class="d-none">
                                            <button type="submit" name="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                            <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-dark waves-effect waves-light">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= view('component/main_scripts') ?>

    <script>
        $(document).ready(function(){

            $('#cm_list_table').DataTable();
            
            // validation and notification area
            $validation_status = "<?=$validation_status?>";
            $notification_status = "<?=$notify_status?>";
            $notify_type = "<?=$notify_type?>";
            $notify_msg = "<?=$notify_msg?>";

            if($validation_status == '1'){
                $('#addModal').modal('show')
            }
            if($notification_status == '1'){
                if($notify_type == 'success'){
                    toastr.success($notify_msg, 'Success', { "closeButton": true });
                }
                if($notify_type == 'error'){
                    toastr.error($notify_msg, 'Failure', { "closeButton": true });
                }
            }

            // jQuery validation
            $("#add_cm_form").validate({
                rules: {
                    title: {
                        required: true,
                        minlength: 5
                    }
                },
                submitHandler: function(form) {
                    // maybe some code
                    $(form).submit();
                }
            });

            // remove area
            $('.remove').click(function(){
                $this = $(this);
                pid = $(this).data('pk')
                $.ajax({
                    url: "<?= base_url('portal/change-management/ajax-remove-cm-list') ?>",
                    dataType: 'json',
                    type: 'POST',
                    data: {pid: pid},
                    success: function (returnData) {
                        console.log(returnData);
                        $this.closest('tr').remove();
                        toastr.success("Item deleted succesfully", 'Success', { "closeButton": true });
                    },
                    error: function (returnData) {
                        obj = JSON.parse(returnData);
                        console.log(obj);
                        toastr.error("Item deleted succesfully", 'Error', { "closeButton": true });
                    }
                })
            });

        })
    </script>

</body>

</html>