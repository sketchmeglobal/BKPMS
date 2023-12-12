<?= view('component/header') ?>
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
                          <li class="breadcrumb-item active"><span>Issue / Return Hardware</span></li>
                        </ol>
                      </nav>
                    </div>
                </div>
            </div>
            <div></div>
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-12 px-4">
                        <button type="button" id="addNewRecord" class="btn btn-primary ms-2" style="float: right; margin-bottom: 5px;">Add New</button>

                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Ticket No</th>
                                    <th>Device Name</th>
                                    <th>Serial No</th>
                                    <th>Note</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($rows) : 
                                    $i = 1;?>
                                <?php foreach ($rows as $row) : ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=$row->ticket_no?></td>
                                    <td><?=$row->hw_name?>(<?=$row->hw_code?>)</td>
                                    <td><?=$row->serial_no?></td>
                                    <td><?=$row->issue_return_note?></td>
                                    <td><?=($row->issue_or_return == 1)? 'Issue': 'Return'?></td>
                                    <td class="d-flex justify-content-evenly">
                                        <!--<a href="javascript: void(0);" class="edit_class" data-table_id="<?=$row->issue_return_id?>"><i class="fa fa-edit"></i></a>-->
                                        <a class="remove" href="javascript: void(0);" data-table_id="<?=$row->issue_return_id?>"><i class="fas fa-times"></i></a>
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

                <!-- Modal start -->
                <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Issue / Return Hardware</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal1"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate name="s_myFormName" id="s_myFormName">
                                    <div class="form-row row"> 
                                        <div class="col-md-4 mb-1">
                                            <label for="ticketNo">Type</label>
                                            <select class="form-control" id="issue_or_return" name="issue_or_return">
                                                <option value="0">Select</option>
                                                <option value="1">Issue</option>
                                                <option value="2">Return</option>
                                            </select>
                                        </div>  
                                    
                                        <div class="col-md-4 mb-1">
                                            <label for="ticketNo">Ticket No</label>
                                            <input type="text" class="form-control" name="ticketNo" id="ticketNo" value="" > 
                                            <span class="error" id="ticketNoError"> </span>
                                        </div>  
                                        <div class="col-md-4 mb-1">
                                            <label for="hw_id">Device Name</label>
                                            <select class="form-control" id="hw_id" name="hw_id">
                                                <option value="0">Select</option>
                                                <?php if($hw_rows): ?>
                                                <?php foreach($hw_rows as $hw_row): ?>
                                                <option value="<?=$hw_row->hw_id?>"><?=$hw_row->hw_name?> (<?=$hw_row->hw_code?>)</option>
                                                <?php endforeach ?>
                                                <?php endif ?>
                                            </select>
                                            <span class="error" id="hw_idError"> </span> 
                                        </div>  

                                        <div class="col-md-4 mb-1">
                                            <label for="hw_sl_id">Serial No</label>
                                            <select class="form-control" id="hw_sl_id" name="hw_sl_id">
                                                <option value="0">Select</option>
                                            </select>
                                            <span class="error" id="hw_sl_idError"> </span> 
                                        </div>    

                                        <div class="col-md-4 mb-1">
                                            <label for="issueNote">Note</label>
                                            <input type="text" class="form-control" name="issueNote" id="issueNote" value="" > 
                                        </div>                              
                                        
                                        <div class="col-md-4 pt-4">
                                        <label for="s_parentDesignation">&nbsp;</label>
                                            <button class="btn  btn-primary" type="button" id="s_submitForm" >
                                                <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="s_submitForm_spinner"></span>
                                                <span class="load-text" style="display: none;" id="s_submitForm_spinner_text">Loading...</span>
                                                <span class="btn-text" id="s_submitForm_text">Save</span>
                                            </button>
                                        </div>
                                    </div>
                                    <input type="hidden" id="table_id" name="table_id" value="0">
                                    <input type="hidden" id="ticket_id" name="ticket_id" value="0">
                                </form>
                                
                            </div>
                            <div class="modal-footer">   
                                <div id="formValidMsg" class="invalid-feedback"> </div>                         
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModal" >Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Modal end -->

            <!-- Footer Start -->
            <?= view('component/footer') ?>
            <!-- Footer End -->
    <!-- JavaScript Libraries -->

    <?= view('component/js') ?>
    <script>
        $(".remove").click(function() {
            if(confirm("Are You Sure? This Process Can\'t be Undone.")){
                $table_id = $(this).data('table_id');
                $(this).closest('tr').remove();
                //console.log('Delete table_id: ' + $table_id);
                $.ajax({  
                    url: '<?php echo base_url('admin/removeTableDataHIS'); ?>',
                    type: 'post',
                    dataType:'json',
                    data:{table_id: $table_id},
                    success:function(data){
                        if(data.status == true){
                            //$(this).closest('tr').remove();
                        }
                    }  
                });//end ajak
            }//end
        });

        //Show Modal
        $('#addNewRecord').on('click', function(){
            $('#table_id').val('0');
            $("#s_myFormName").trigger("reset");
            $('#myModal').modal('show');
        })
        $('#closeModal1, #closeModal').on('click', function(){
            $('#myModal').modal('hide');
        })
        
        //Validation Form
        function validateForm(){
            $issue_or_return = $('#issue_or_return').val();
            $ticketNo = $('#ticketNo').val().replace(/^\s+|\s+$/gm,'');
            $hw_id = $('#hw_id').val();
            
            $status = true;
            $formValidMsg = 'Please enter ';
            
            if($issue_or_return == '0'){
                $status = false;
                $formValidMsg += 'Type';
                $('#issue_or_return').removeClass('is-valid');
                $('#issue_or_return').addClass('is-invalid');
            }else{
                $('#issue_or_return').removeClass('is-invalid');
                $('#issue_or_return').addClass('is-valid');
            }
            
            if($ticketNo == ''){
                $status = false;
                $formValidMsg += ', ticket number';
                $('#ticketNo').removeClass('is-valid');
                $('#ticketNo').addClass('is-invalid');
            }else{
                $('#ticketNo').removeClass('is-invalid');
                $('#ticketNo').addClass('is-valid');
            }

            if($hw_id == '0'){
                $status = false;
                $formValidMsg += ', Device name';
                $('#hw_id').removeClass('is-valid');
                $('#hw_id').addClass('is-invalid');
            }else{
                $('#hw_id').removeClass('is-invalid');
                $('#hw_id').addClass('is-valid');
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

                if($formVallidStatus == true && $ticket_found == true){
                    $table_id = $('#table_id').val();
                    $ticketNo = $('#ticketNo').val();
                    $hw_id = $('#hw_id').val();
                    $hw_sl_id = $('#hw_sl_id').val();
                    $issueNote = $('#issueNote').val();
                    $ticket_id = $('#ticket_id').val();

                    $hw_text = $('#hw_id option:selected').text();
                    $hw_sl_text = $('#hw_sl_id option:selected').text();
                    
                    $query = {
                        issue_or_return: $issue_or_return,
                        ticketNo: $ticketNo,
                        hw_id: $hw_id,
                        hw_sl_id: $hw_sl_id,
                        issueNote: $issueNote,
                        table_id: $table_id,
                        ticket_id: $ticket_id
                    };
                    
                    $.ajax({  
                        url: '<?php echo base_url('admin/formValidationHIS'); ?>',
                        type: 'post',
                        dataType:'json',
                        data:{query: $query},
                        success:function(data){
                            console.log(JSON.stringify(data));
                            console.log('status: ' + data.status);
                            if(data.status == true ){
                                if(parseInt(data.issue_return_id) > 0){
                                    //Creat the row
                                    var row = $('<tr>')
                                        .append('<td>1</td>')
                                        .append('<td>'+$ticketNo+'</td>')
                                        .append('<td>'+$hw_text+'</td>')
                                        .append('<td>'+$hw_sl_text+'</td>')
                                        .append('<td>'+$issueNote+'</td>')
                                        .append('<td>'+$issue_or_return_text+'</td>')
                                        .append('<td class="d-flex justify-content-evenly"><a href="javascript: void(0);" class="edit_class" data-table_id="'+data.issue_return_id+'"><i class="fa fa-edit"></i></a> <a class="remove" href="javascript: void(0);"><i class="fas fa-times" data-table_id="'+data.issue_return_id+'"></i></a></td>')

                                    //Prepend row with Table
                                    //myTable.row.add(row);
                                    $('#myTable tbody').prepend(row);
                                }
                                //Hide Modal
                                $('#myModal').modal('hide');
                            }else{
                                console.log('validation' + JSON.stringify(data.validation));
                                $validation = data.validation;
                                for($i in $validation){
                                    console.log($i + '' + $validation[$i])
                                    $('#'+$i+'Error').html($validation[$i])
                                }
                            }
                        }  
                    });
                }else{
                    console.log('form validation Error')                    
                    $('#formValidMsg').show();
                }

            }, 500)    
        })

        //Edit Data
        $(".edit_class").click(function() {
            $table_id = $(this).data('table_id');

            $.ajax({  
                url: '<?php echo base_url('admin/getTableDataHIS'); ?>',
                type: 'post',
                dataType:'json',
                data:{table_id: $table_id},
                success:function(data){
                    console.log(JSON.stringify(data));
                    //console.log('status: ' + data.status);
                    if(data.status == true ){
                        $ticket_found = true;
                        getDeviceSerialonHIS(data.result.hw_id);
                        setTimeout(function(){
                            $('#issue_or_return').val(data.result.issue_or_return);
                            $('#ticketNo').val(data.result.ticket_no);
                            $('#hw_id').val(data.result.hw_id);
                            $('#hw_sl_id').val(data.result.hw_sl_id);
                            $('#issueNote').val(data.result.issue_return_note);
                            $('#table_id').val(data.result.issue_return_id);
                            $('#ticket_id').val(data.result.ticket_id);
                            $('#myModal').modal('show');
                        }, 300)
                    }
                }  
            });//end ajak
        });
        

        function getDeviceSerialonHIS($hw_id){ 
            $.ajax({  
                url: '<?php echo base_url('admin/getDeviceSerialonHIS'); ?>',
                type: 'post',
                dataType:'json',
                data:{hw_id: $hw_id },
                success:function(data){
                    console.log(JSON.stringify(data));
                    
                    if(data.status == true ){
                        $('#hw_sl_id').html(data.option_text);
                    }
                }  
            });//end ajak                
        }//end fun

        $('#ticketNo').on('change', function(){
            $ticketNo = $('#ticketNo').val();
            console.log('ticketNo: ' + $ticketNo);
            $ticket_found = false;
            $ticket_id = 0;

            $.ajax({  
                url: '<?php echo base_url('admin/check-ticket-status'); ?>',
                type: 'post',
                dataType:'json',
                data:{ticketNo: $ticketNo},
                success:function(data){
                    //console.log(JSON.stringify(data));
                    if(data.status == false ){
                        $ticket_found = false; 
                        $('#ticketNoError').html(data.message);                        
                        $('#ticketNo').removeClass('is-valid');
                        $('#ticketNo').addClass('is-invalid');
                    }else{
                        $ticket_found = true;
                        $ticket_id = data.ticket_id;
                        $('#ticket_id').val($ticket_id);
                        $('#ticketNo').removeClass('is-invalid');
                        $('#ticketNo').addClass('is-valid');
                    }
                }  
            });//end ajak
        })
        

        $('#hw_id').on('change', function(){
            $hw_id = $('#hw_id').val();
            console.log('hw_id: ' + $hw_id);

            $.ajax({  
                url: '<?php echo base_url('admin/get-hw-serial'); ?>',
                type: 'post',
                dataType: 'json',
                data:{hw_id: $hw_id},
                success:function(data){
                    //console.log(JSON.stringify(data));
                    if(data.status == true ){
                        $('#hw_sl_id').html(data.option_text);
                    }
                }  
            });//end ajak
        })

        $('#issue_or_return').on('change', function(){
            $issue_or_return = $('#issue_or_return').val();
            $issue_or_return_text = $('#issue_or_return option:selected').text();
            if($issue_or_return == '1'){
                $('#issueNote').val('New Hardware issued');
            }else if($issue_or_return == '2'){
                $('#issueNote').val('Old Hardware returned');
            }else{
                $('#issueNote').val('');                
            }
        })

    </script>
    