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
                          <li class="breadcrumb-item active"><span>Inventory Stock Report</span></li>
                        </ol>
                      </nav>
                    </div>
                </div>
            </div>
            <div></div>
            <div class="container">
                <div class="row">
                    <form class="needs-validation" novalidate name="s_myFormName" id="s_myFormName" action="<?php echo base_url('admin/inventory-stock-report'); ?>" method="post" target="_blank">
                        <div class="form-row row"> 
                            <div class="col-md-3 mb-1">
                                <label for="from_date">From date</label>
                                <input type="date" class="form-control" id="from_date" name="from_date">
                            </div> 
                            <div class="col-md-3 mb-1">
                                <label for="to_date">To Date</label>
                                <input type="date" class="form-control" id="to_date" name="to_date">
                            </div> 

                            <div class="col-md-3 mb-1">
                                <label for="issue_or_return">Type</label>
                                <select class="form-control" id="issue_or_return" name="issue_or_return">
                                    <option value="0">Select</option>
                                    <option value="1">Issue</option>
                                    <option value="2">Return</option>
                                </select>
                            </div> 
                            <div class="col-md-3 mb-1">
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
                            
                            <div class="col-md-3 pt-4">
                                <label for="s_parentDesignation">&nbsp;</label>
                                <button class="btn  btn-primary" type="submit" id="s_submitForm" >
                                    <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="s_submitForm_spinner"></span>
                                    <span class="load-text" style="display: none;" id="s_submitForm_spinner_text">Loading...</span>
                                    <span class="btn-text" id="s_submitForm_text">Search</span>
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="form-row row"> 
                        <div class="col-md-12 mb-1">
                            <span style="color: #f00; display: none;" id="formValidMsg"></span>
                        </div>
                    </div>  
                </div>
            </div>

                

            <!-- Footer Start -->
            <?= view('component/footer') ?>
            <!-- Footer End -->
    <!-- JavaScript Libraries -->

    <?= view('component/js') ?>
    <script>
        //Submit Form
        $('#s_submitForm').click(function(){
            $issue_or_return = $('#issue_or_return').val();
            $hw_id = $('#hw_id').val();
            $from_date = $('#from_date').val();
            $to_date = $('#to_date').val();

            $('#s_submitForm_spinner').show();
            $('#s_submitForm_spinner_text').show();
            $('#s_submitForm_text').hide();
            $('#formValidMsg').hide();

            $('#formValidMsg').html('');
            
            if($issue_or_return == 0 && $hw_id == 0 && $from_date == '' && $to_date == ''){                
                $('#formValidMsg').html('Please select any of the search parameter');
                $('#formValidMsg').show();

                $('#s_submitForm_spinner').hide();
                $('#s_submitForm_spinner_text').hide();
                $('#s_submitForm_text').show();
                $('#formValidMsg').show();
            }else{                
                $query = {
                    issue_or_return: $issue_or_return,
                    hw_id: $hw_id,
                    from_date: $from_date,
                    to_date: $to_date
                };

                $('#s_submitForm_spinner').hide();
                $('#s_submitForm_spinner_text').hide();
                $('#s_submitForm_text').show();
                $('#formValidMsg').hide();
                
            }//end if  
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
                            //$('#hw_sl_id').val(data.result.hw_sl_id);
                            $('#issueNote').val(data.result.issue_return_note);
                            $('#table_id').val(data.result.issue_return_id);
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
                        //$('#hw_sl_id').html(data.option_text);
                    }
                }  
            });//end ajak                
        }//end fun

        $('#ticketNo').on('change', function(){
            $ticketNo = $('#ticketNo').val();
            console.log('ticketNo: ' + $ticketNo);
            $ticket_found = false;

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
                        //$('#hw_sl_id').html(data.option_text);
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
    