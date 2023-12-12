<?= view('component/header') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- SIDE-NAV-START -->
        <?= view('component/side_nav') ?>
        <!-- SIDE-NAV-END -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?= view('component/top_nav') ?>
            <!-- Navbar End -->
            <div class="container">
                <div class="row justify-content-center">
                <div class="container-fluid">
                      <nav aria-label="breadcrumb" class="row bg-breadcrumb">
                        <ol class="breadcrumb my-0 ms-2">
                          <li class="breadcrumb-item">
                            <span>Home</span>
                          </li>
                          <li class="breadcrumb-item active"><span>New Ticket</span></li>
                        </ol>
                      </nav>
                    </div>
                </div>
            </div>
            <div class="container">

                <div class="row justify-content-center align-items-center">

                    <div class="col-md-12 bg-light mt-3" style="border-radius:5px;">
                        <div class="row py-4">
                            <div class="col-md-6">
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
                            <div class="col-md-6 col-12">
                                <div class="card-header text-center">
                                    <h6 class="text-primary">Read Knowledge Base Before Inquiring</h6>
                                </div>
                                <div>
                                    <div id="accordion">
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>

            <!-- Footer Start -->
            <?= view('component/footer') ?>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <?= view('component/js') ?>

    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>

    <!-- <script>
        ClassicEditor
            .create(document.querySelector('#ticket_description'))
            .catch(error => {
                console.error(error);
            });
    </script> -->
    
    <script>        
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
            
            /*if($ticket_description == ''){
                $status = false;
                $formValidMsg += ', Description';
                $('#ticket_description').removeClass('is-valid');
                $('#ticket_description').addClass('is-invalid');
            }else{
                $('#ticket_description').removeClass('is-invalid');
                $('#ticket_description').addClass('is-valid');
            }*/

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
                                    alert('Your Request save successfully.')
                                }
                                
                            }else{
                                console.log('validation' + JSON.stringify(data.validation));
                                $validation = data.validation;
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