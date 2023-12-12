<?= view('component/main_header') ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <style>
        #s_myFormName .error {color: red !important;position: relative;padding: 0;}
        .card{border-left: 4px solid #f7f7f7;}
        label{color:#000}
    </style>
</head>
<?php #echo '<pre>', print_r($approved_menu), '</pre>'; ?>

<body>

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
                        <h4 class="page-title">Messaging</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?=base_url('portal/dashboard')?>">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Intranet Messaging</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

                <div class="row">
                    <!-- Send Message box -->
                    <div class="col-12">
                        <div class="card border border-dark">
                            <div class="card-body">
                                <form method="post" id="add_intranet_form">
                                   
                                    <div class="row mt-2">
                                        
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="dg_id">Designation</label>
                                                <select required class="form-control" id="to_dg_id" name="to_dg_id">
                                                    <option selected disabled>Select from the list</option>
                                                    <?php if ($designation) : ?>
                                                    <?php 
                                                    $i = 1;
                                                    foreach ($designation as $desig) : ?>
                                                        <option value="<?=$desig->id?>"><?=$desig->desig_name?></option>                                            
                                                    <?php 
                                                    $i++;
                                                    endforeach ?>
                                                    <?php endif ?>                                                
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="end_date">End date</label>
                                                <input required type="date" class="form-control" id="end_date" name="end_date" >
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="message">Message</label>
                                                <textarea name="message" id="message" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="action">Action</label><br>
                                                <button class="btn btn-success" type="submit" id="s_submitForm" >
                                                    Send <i class="fa fa-reply"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>                            
                            </div>
                        </div>
                    </div>
                    <!-- Send Message box -->
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card border border-dark">
                            <div class="card-body">
                                <table id="intra_msg_table" class="display">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>From</th>
                                            <th>Message</th>
                                            <th>Sent date</th>
                                            <th>End date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($rows) : ?>
                                        <?php 
                                            $i = 1;
                                            foreach ($rows as $row) : ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$row->emp_name?></td>
                                            <td><?=$row->message?></td>
                                            <td><?=date('d-M-Y', strtotime($row->sent_date))?></td>
                                            <td><?=date('d-M-Y', strtotime($row->end_date))?></td>
                                            <td>
                                                <button data-pid="<?=$row->im_id?>" class="btn btn-sm btn-danger remove">Delete</button>
                                            </td>
                                        </tr>
                                        <?php 
                                        $i++;
                                        endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= view('component/main_footer') ?>
        </div>
    </div>
    <?= view('component/main_scripts') ?>
    <script>
        $(document).ready(function(){

            $('#intra_msg_table').DataTable();
            
            // validation and notification area
            $validation_status = "<?=$validation_status?>";
            $notification_status = "<?=$notify_status?>";
            $notify_type = "<?=$notify_type?>";
            $notify_msg = "<?=$notify_msg?>";

            if($notification_status == '1'){
                if($notify_type == 'success'){
                    toastr.success($notify_msg, 'Success', { "closeButton": true });
                }
                if($notify_type == 'error'){
                    toastr.error($notify_msg, 'Failure', { "closeButton": true });
                }
            }

            // jQuery validation
            $("#add_intranet_form").validate({
                rules: {
                    to_dg_id: {
                        required: true
                    },
                    end_date: {
                        required: true
                    },
                    message: {
                        required: true,
                        minlength: 8
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
                pid = $(this).data('pid')
                $.ajax({
                    url: '<?php echo base_url('portal/message/ajax-remove-table-data'); ?>',
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