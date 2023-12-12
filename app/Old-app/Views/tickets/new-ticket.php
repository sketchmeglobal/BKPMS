
<?= view('component/main_header') ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <style>
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
                        <h4 class="page-title">Ticket Management</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?=base_url('portal/dashboard')?>">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Ticket List</li>
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
                                <div class="row py-4">
                                    <div class="col-lg-6">
                                        <form class="needs-validation" novalidate name="s_myFormName" id="s_myFormName">
                                            <div class="row">
                                                <div class="col-md-6 col-12 ">
                                                    <div class="form-group">
                                                        <label for="topic_id">Topic</label>
                                                        <select class="form-control" id="topic_id" name="topic_id">
                                                            <option value="0">Select</option>
                                                            <?php if ($topic_rows) : ?>
                                                                <?php foreach ($topic_rows as $topic_row) : ?>
                                                                    <option value="<?=$topic_row->id?>"><?=$topic_row->topic_name?></option>
                                                                <?php endforeach ?>
                                                            <?php endif ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="ticket_category">Category</label>
                                                        <select class="form-control" id="ticket_category" name="ticket_category">
                                                            <option value="">Select Topic</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 mt-4">
                                                    <div class="form-group">
                                                        <label for="ticket_subject">Subject</label>
                                                        <input type="text" class="form-control" id="ticket_subject" name="ticket_subject" >
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 mt-4">
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea name="ticket_description" id="ticket_description" style="min-height: 150px;min-width: 100%;"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 mt-4">
                                                    <div class="form-group">
                                                        <label>Assign this ticket to yourself?</label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" name="self_assign" value="Yes" id="self_assign_yes">
                                                        <label for="self_assign_yes">Yes</label> &nbsp;&nbsp;
                                                        <input type="radio" name="self_assign" value="No" id="self_assign_no" checked>
                                                        <label for="self_assign_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 mt-4 d-none" id="self_assign_msg_section">
                                                    <div class="form-group">
                                                        <label for="self_assign_msg">Reason of self-assignment?</label>
                                                        <input type="text" name="self_assign_msg" id="self_assign_msg" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-4 float-right">
                                                    <button class="btn btn-primary" type="button" id="s_submitForm" ><i class="fa fa-ticket"></i> Create Ticket</button>
                                                </div>

                                                <span class="col-md-12 mt-4 float-left" id="formValidMsg" style="color: #f00;"></span>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-1"></div>
                                    <div class="col-lg-5 col-12" style="box-shadow: 0px 0px 1px 0px;">
                                        <div class="card-header text-center font-weight-bold" style="background: #87919b;">
                                            <h5 class="text-light mb-0">Read Knowledge Base Before Inquiring</h5>
                                        </div>
                                        <div>
                                            <div id="accordion"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <?= view('component/main_footer') ?>
        </div>
    </div>

    <?= view('component/main_scripts') ?>

    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script> -->

    <!-- <script>
        ClassicEditor
            .create(document.querySelector('#ticket_description'))
            .catch(error => {
                console.error(error);
            });
    </script> -->
    
    <script>        
        $(document).ready(function(){
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
        });
        //Validation Form
        function validateForm(){
            $topic_id = $('#topic_id').val();
            $topic_name = $('#topic_id option:selected').text();
            $ticket_subject = $('#ticket_subject').val().replace(/^\s+|\s+$/gm,'');
            $ticket_category = $('#ticket_category').val();
            $ticket_category_name = $('#ticket_category option:selected').text();
            $ticket_description = $('#ticket_description').val();
            $self_assign = $("input[name='self_assign']:checked").val();
            $self_assign_msg = $('#self_assign_msg').val();

            $status = true;
            $formValidMsg = 'Please enter';
            
            if($topic_id == '0'){
                $status = false;
                $formValidMsg += ', Topic Type';
                $('#topic_id').removeClass('is-valid');
                $('#topic_id').addClass('is-invalid');
            }else{
                $('#topic_id').removeClass('is-invalid');
                $('#topic_id').addClass('is-valid');
            }

            if($ticket_subject == ''){
                $status = false;
                $formValidMsg += ', Subject';
                $('#ticket_subject').removeClass('is-valid');
                $('#ticket_subject').addClass('is-invalid');
            }else{
                $('#ticket_subject').removeClass('is-invalid');
                $('#ticket_subject').addClass('is-valid');
            } 
            
            if($ticket_category == '0'){
                $status = false;
                $formValidMsg += ', Category';
                $('#ticket_category').removeClass('is-valid');
                $('#ticket_category').addClass('is-invalid');
            }else{
                $('#ticket_category').removeClass('is-invalid');
                $('#ticket_category').addClass('is-valid');
            }

            $('#formValidMsg').html($formValidMsg);

            $('#s_submitForm_spinner').hide();
            $('#s_submitForm_spinner_text').hide();
            $('#s_submitForm_text').show();

            return $status;
        }//en validate form

        //Submit Form
        $('#s_submitForm').click(function(){
            $('#s_submitForm_spinner').show();
            $('#s_submitForm_spinner_text').show();
            $('#s_submitForm_text').hide();
            $('#formValidMsg').hide();

            setTimeout(function(){
                $formVallidStatus = validateForm();

                if($formVallidStatus == true){                    
                    $query = {
                        topic_id: $topic_id,
                        ticket_subject: $ticket_subject,
                        ticket_category: $ticket_category,
                        ticket_description: $ticket_description,
                        self_assign: $self_assign,
                        self_assign_msg: $self_assign_msg,
                    };
                    
                    $.ajax({  
                        url: '<?php echo base_url('portal/ticket/new-ticket-validation'); ?>',
                        type: 'post',
                        dataType:'json',
                        data:{query: $query},
                        success:function(data){
                            //console.log(JSON.stringify(data));
                            //console.log('status: ' + data.status);
                            if(data.status == true ){
                                if(parseInt(data.ticket_id) > 0){
                                    $('#s_myFormName')[0].reset();
                                    toastr.success("New ticket generated succesfully", 'Success', {
                                        "closeButton": true
                                    });
                                }
                                
                            }else{
                                console.log('validation' + JSON.stringify(data.validation));
                                $validation = data.validation;
                                toastr.erro("Error occurred", 'Error', {
                                    "closeButton": true
                                });
                                /*for($i in $validation){
                                    console.log($i + '' + $validation[$i])
                                    $('#'+$i+'Error').html($validation[$i])
                                }*/
                            }
                        }  
                    });
                }else{
                    console.log('form validation Error')                    
                    $('#formValidMsg').show();
                }

            }, 500)    
        })

        //on topic change
        $('#topic_id').on('change', function (){
            topic_id = $(this).val();
            $.ajax({
                url: "<?= base_url('portal/ticket/ajax_fetch_topic_category') ?>",
                method: "post",
                dataType: 'json',
                data: {'topic_id':topic_id,},
                success: function(returnData){
                    $('#ticket_category').html(returnData);
                    $('#accordion').html('');
                },
            });
        });

        //on category change
        $('#ticket_category').on('change', function (){
            ticket_category_id = $(this).val();
            $.ajax({
                url: "<?= base_url('portal/ticket/ajax_fetch_solutions') ?>",
                method: "post",
                dataType: 'json',
                data: {'ticket_category_id':ticket_category_id,},
                success: function(returnData){
                    $('#accordion').html(returnData);
                },
            });
        });

        //on self_assign change
        $('input[name=self_assign]').change(function(){
            var value = $('input[name=self_assign]:checked').val();
            if(value == 'Yes') {
                $('#self_assign_msg_section').removeClass('d-none');
            } else {
                $('#self_assign_msg_section').addClass('d-none');
            }
        });
    </script>

</body>

</html>