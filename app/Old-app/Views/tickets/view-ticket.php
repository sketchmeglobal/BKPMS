<?= view('component/main_header') ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <style>
        .card{border-left: 4px solid #f7f7f7;}
        label{color:#000}
    </style>
</head>
<?php #echo '<pre>', print_r($approved_menu), '</pre>'; ?>
<?php 
    $session = session();

    switch ($rows->ticket_status_id) {
        case 1 : $status_bg = 'red'; break;
        case 2 : $status_bg = 'goldenrod'; break;
        case 3 : $status_bg = 'blueviolet'; break;
        case 4 : $status_bg = 'gray'; break;
        case 5 : $status_bg = 'blue'; break;
        case 6 : $status_bg = 'green'; break;
        case 7 : $status_bg = 'deeppink'; break;
        case 8 : $status_bg = 'orange'; break;
        case 9 : $status_bg = 'orangered'; break;
        default : $status_bg = 'darkcyan'; break;
    }
    //severity text background colour
    switch ($rows->id) {
        case 1 : $severity_bg = 'limegreen'; break;
        case 2 : $severity_bg = 'orange'; break;
        case 3 : $severity_bg = 'red'; break;
        case 4 : $severity_bg = 'gray'; break;
        default : $severity_bg = 'darkcyan'; break;
    }
?>
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
                                    <li class="breadcrumb-item active" aria-current="page">Ticket Details</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card border box-shadow1">
                            <div class="card-body">
                                <h4 class="card-title"><?=$rows->ticket_subject?>: <strong><?=$rows->ticket_number?></strong></h4>
                                <hr>
                                <p class="mb-0 pb-0"><?=$rows->ticket_description?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">

                    <!-- LEFT SIDE -->
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-12">
                                <div class="card border box-shadow1">
                                    <div class="card-body">
                                        <h4 class="card-title">Ticket Communications</h4>
                                        <ul class="list-unstyled m-t-40">
                                            <?php
                                            function time_elapsed_string($datetime, $full = false) {
                                                $now = new DateTime;
                                                $ago = new DateTime($datetime);
                                                $diff = $now->diff($ago);
                                            
                                                $diff->w = floor($diff->d / 7);
                                                $diff->d -= $diff->w * 7;
                                            
                                                $string = array(
                                                    'y' => 'year',
                                                    'm' => 'month',
                                                    'w' => 'week',
                                                    'd' => 'day',
                                                    'h' => 'hour',
                                                    'i' => 'minute',
                                                    's' => 'second',
                                                );
                                                foreach ($string as $k => &$v) {
                                                    if ($diff->$k) {
                                                        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                                                    } else {
                                                        unset($string[$k]);
                                                    }
                                                }
                                            
                                                if (!$full) $string = array_slice($string, 0, 1);
                                                return $string ? implode(', ', $string) . ' ago' : 'just now';
                                            }

                                            $accepted_by = $rows->accepted_by;
                                            $accepted_by_name = $rows->accepted_by_name;
                                            $accepted_at = $rows->accepted_at;
                                            $last_updated = $rows->last_updated;
                                            $max_allowed_time = $rows->max_allowed_time;

                                            $temp_deadline = date('Y-m-d H:i:s', strtotime($accepted_at. ' + '.$max_allowed_time.' hours'));
                                            $temp_deadline = date('Y-m-d H:i:s', strtotime($temp_deadline. ' - '.'24 hours'));
                                            //echo 'temp_deadline: ' . $temp_deadline;
                                            $holidayCount = 0;
                                            for($x = 0; $x < sizeof($holiday_list); $x++){
                                                if($holiday_list[$x]->hl_date > $accepted_at && $holiday_list[$x]->hl_date <= $temp_deadline){
                                                    $holidayCount++;
                                                }//end if
                                            }//end for
                                            $max_allowed_time = $max_allowed_time + ($holidayCount * 24);
                                            $deadline = date('Y-m-d H:i:s', strtotime($accepted_at. ' + '.$max_allowed_time.' hours'));

                                            $comment_description1 = $rows->comment_description;
                                            if($comment_description1 != null){
                                                $comment_description = json_decode($comment_description1);
                                                if(sizeof($comment_description) > 0){
                                                    for($i = 0; $i < sizeof($comment_description); $i++){
                                                        $obj_id = $comment_description[$i]->obj_id;
                                                        $reply_text = $comment_description[$i]->reply_text;
                                                        $replied_by = $comment_description[$i]->replied_by;
                                                        $emp_name = $comment_description[$i]->emp_name;
                                                        $email = $comment_description[$i]->email;
                                                        $replied_at = $comment_description[$i]->replied_at;

                                                        $emp_name_exp = explode(" ", $emp_name);
                                                        if(sizeof($emp_name_exp) > 1){
                                                            $short_name = substr($emp_name_exp[0], 0, 1). '' .substr($emp_name_exp[1], 0, 1);
                                                        }else{
                                                            $short_name = substr($emp_name_exp[0], 0, 1);
                                                        }
                                                        ?>
                                                        <li class="media border mt-2 p-2">
                                                            <img class="m-r-15" src="https://img.freepik.com/premium-vector/human-symbol-3d-icon-user-business-symbology-website-profile_593228-130.jpg?w=2000" width="60" alt="Generic placeholder image">
                                                            <div class="media-body">
                                                                <h5 class="mt-0 mb-1"><strong><?=$emp_name.'</strong> <small>('.$email.')</small>'?></h5> 
                                                                <?=$reply_text?>
                                                                <hr>
                                                                <small class="d-block text-right"><?=time_elapsed_string($replied_at)?></small>
                                                            </div>
                                                        </li>
                                                        
                                                    <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card border box-shadow1">
                                    <div class="card-body">
                                        <div class="mt-5 border border-dark p-3">
                                            <div><h3>Leave a comment</h3></div>
                                            <form action="" name="s_myFormName" id="s_myFormName">
                                                <textarea name="reply_text" id="reply_text" class="col-lg-12 col-md-12" style="min-height: 100px;"></textarea>
                                                <!-- <div class="custom-file mt-4">
                                                    <input id="fileInput" type="file" class="custom-file-input">
                                                </div> -->
                                                <hr>
                                                <div class="col-md-12 mt-4 text-center">
                                                    <button class="btn btn-primary" type="button" id="s_submitForm" data-ticket_id="<?=$rows->ticket_id?>"><i class="fa fa-reply"></i> Reply</button>
                                                </div>
                                                <div class="col-md-12 mt-4 float-right">
                                                    <span id="save_comment_msg"></span>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT SIDE -->
                    <div class="col-lg-4">
                        <div class="card border box-shadow1">
                            <div class="card-body">
                                <h4 class="card-title">Ticket Info: <strong><?=$rows->ticket_number?></strong></h4>
                            </div>
                            <div class="card-body bg-light p-0">
                                <div class="row text-center">
                                    <div class="col-6 m-t-10 m-b-10 border-right">
                                        <p class="mx-3 mb-0">Status:</p>
                                        <span id="ticket_status_2" class="mx-1 px-1" style="background:<?=$status_bg?>;border-radius: 5px;color: white;"><?=$rows->ticket_status_name?></span>
                                    </div>
                                    <div class="col-6 m-t-10 m-b-10">
                                        <p class="mx-3 mb-0">Severity:</p>
                                        <span class="mx-1 px-1" style="background:<?=$severity_bg?>;border-radius: 5px;color: white;"><?=$rows->ticket_severity_name?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="p-t-20"><b>Ticket Category</b>: <?=$rows->ticket_category_name?></h6>

                                <h6 class="m-t-30"><b>Generated By</b>: <?=$rows->emp_name.' ('.$rows->email_id . ')'?></h6>
                                <span>On <?=date('d-M-Y H:i A', strtotime($rows->created_on))?></span>

                                <h6 class="m-t-30"><b>Accepted By</b>: <?=$accepted_by_name?></h6>

                                <h6 class="m-t-30"><b>Last updated</b>: <span id="accepted_on"><?php echo date('d-M-Y h:i A', strtotime($last_updated)); ?> </span></h6>
                                
                            </div>
                            <div class="card-body bg-light">
                                <div class="row text-center">
                                    <div class="col-12 p-0">
                                        <p class="mx-3 mb-0">Time Remaining:</p>
                                        <span id="countdown"><?=$max_allowed_time?> hrs.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="mx-3 mb-0 text-primary">Change Ticket Status </p>
                                <select class="form-control" name="ticket_status_id" id="ticket_status_id">
                                    <?php if ($tic_stat_rows) : ?>
                                        <?php foreach ($tic_stat_rows as $tic_stat_row) : ?>
                                            <option value="<?=$tic_stat_row->ticket_status_id?>" <?php if($rows->ticket_status == $tic_stat_row->ticket_status_id){?> selected <?php } ?>><?=$tic_stat_row->ticket_status_name?></option>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                                
                                <input type="hidden" name="created_by" id="created_by" value="<?=$rows->created_by?>">
                                <input type="hidden" name="accepted_by" id="accepted_by" value="<?=$accepted_by?>">
                                <input type="hidden" name="accepted_by_name" id="accepted_by_name" value="<?=$accepted_by_name?>">
                                <input type="hidden" name="deadline" id="deadline" value="<?=$deadline?>">
                                <input type="hidden" name="max_allowed_time" id="max_allowed_time" value="<?=$max_allowed_time?>">
                                <input type="hidden" name="old_ticket_status_id" id="old_ticket_status_id" value="<?=$rows->ticket_status?>">
                                <input type="hidden" name="old_ticket_status_text" id="old_ticket_status_text" value="<?=$rows->ticket_status_name?>">
                                
                                <!--select group-->
                                <span id="select_group_section" class="d-none">
                                    <div class="d-flex align-items-center py-2">
                                        <p class="mx-3 mb-0" style="color: orange;">Delegate to Group</p>
                                    </div>
                                    <div class="d-flex align-items-center px-2">
                                        <select class="form-control" id="emp_gr_id" name="emp_gr_id">
                                            <option value="">Select</option>
                                            <?php if ($emp_groups) : ?>
                                            <?php
                                            foreach ($emp_groups as $emp_group) : ?>
                                                <option value="<?=$emp_group->id?>" <?php if($emp_group->id == $rows->emp_gr_id){?> selected <?php } ?>><?=$emp_group->group_name?></option>
                                            <?php
                                            endforeach ?>
                                            <?php endif ?>
                                        </select>
                                    </div>
                                </span>

                                <!--select device for SR-->
                                <span id="select_device_serial_section" class="d-none">
                                    <div class="d-flex align-items-center py-2">
                                        <p class="mx-3 mb-0" style="color: blue;">Select Device Serial No</p>
                                    </div>
                                    <div class="d-flex align-items-center px-2">
                                        <select class="form-control" id="hw_sl_id" name="hw_sl_id">
                                            <option value="">Select</option>
                                            <?php if ($issued_devices) : ?>
                                                <?php
                                                foreach ($issued_devices as $issued_device) : ?>
                                                    <option value="<?=$issued_device->hw_sl_id?>" <?php if($issued_device->hw_sl_id == $rows->hw_sl_id){?> selected <?php } ?>><?=$issued_device->serial_no?> (<?=$issued_device->hw_name.' '.$issued_device->hw_code?>)</option>
                                                <?php
                                                endforeach ?>
                                            <?php endif ?>
                                        </select>
                                    </div>
                                    <div class="d-flex align-items-center py-2">
                                        <p class="mx-3 mb-0" style="color: blue;">Reason for SR?</p>
                                    </div>
                                    <div class="d-flex align-items-center px-2">
                                        <input type="text" name="sr_req_msg" id="sr_req_msg" class="form-control" value="<?=$rows->sr_reason_msg?>">
                                    </div>
                                </span>

                                <div class="d-flex align-items-center px-2 py-2">
                                    <button class="btn btn-primary btn-lg" type="button" id="accept_ticket" data-ticket_id="<?=$rows->ticket_id?>" style="width: 100%;"><i class="bi bi-check2-square"></i> Update</button>
                                </div>

                                <?php
                                if(str_contains($rows->status_history, 'SR Approved')) {
                                    ?>
                                    <div class="d-flex align-items-center px-2 py-2" id="summary_report_div" >
                                        <button class="btn btn-success btn-lg" type="button" id="summary_report" data-ticket_id="<?=$rows->ticket_id?>" style="width: 100%;"><i class="bi bi-printer"></i> SR Receipt</button>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="d-flex align-items-center px-2 py-2">
                                    <span id="ticket_stat_msg"> </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- SOLUTIONS -->
                        <div class="card border box-shadow1">
                            <div class="card-body text-center">
                                <h4 class="card-title">Probable Solutions</h4>
                                <div id="accordion_head" class="accordion" role="tablist" aria-multiselectable="true">
                                    <?php
                                    $counter = 1;
                                    foreach($solutions as $solution) {
                                        ?>
                                        <div class="card border box-shadow1">
                                            <div class="card-header" role="tab" id="headingOne">
                                                <h5 class="mb-0">
                                                    <a data-toggle="collapse" data-parent="#accordion_head" href="#collapse<?=$counter;?>" aria-expanded="false" aria-controls="collapseOne">
                                                        Solution <?=$counter;?>
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapse<?=$counter;?>" class="collapsed collapse" role="tabpanel" aria-labelledby="headingOne">
                                                <div class="card-body">
                                                <?=$solution->solution?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $counter++;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card border box-shadow1">
                            <div class="card-header p-2 bg-white border-bottom">
                                <p class="mx-3 mb-0" >Ticket status of: <strong><?=$rows->ticket_number?></strong></p>
                            </div>
                            <div class="card-body row" style="background-color: #fff;">
                                <?php
                                if($rows->status_history != null){
                                    $status_history = json_decode($rows->status_history);
                                    if(sizeof($status_history) > 0){
                                        for($j = 0; $j < sizeof($status_history); $j++){
                                            switch ($status_history[$j]->new_status) {
                                                case 1 : $status_bg = 'red'; break;
                                                case 2 : $status_bg = 'goldenrod'; break;
                                                case 3 : $status_bg = 'blueviolet'; break;
                                                case 4 : $status_bg = 'gray'; break;
                                                case 5 : $status_bg = 'blue'; break;
                                                case 6 : $status_bg = 'green'; break;
                                                case 7 : $status_bg = 'deeppink'; break;
                                                case 8 : $status_bg = 'orange'; break;
                                                case 9 : $status_bg = 'orangered'; break;
                                                default : $status_bg = 'darkcyan'; break;
                                            }
                                            ?>
                                            <div class="col-sm-4 py-2">
                                                <span style="position: relative;top: 10px;left: 10px;" class="badge badge-warning"><?=$j+1?></span>
                                                <p class="mx-3 mb-0 border" style="background-color: #F3F6F9;padding: 15px;font-size: 12px;">
                                                    Ticket status changed to <strong style="background:<?=$status_bg?>;border-radius: 5px;color: white;">&nbsp;<?=$status_history[$j]->new_status_text?>&nbsp;</strong>
                                                    <br/>
                                                    <strong>Author: </strong><?=$status_history[$j]->updated_by_name?>
                                                    <br/>
                                                    <strong>Updated on: </strong> <?=date('d-M-Y h:i A', strtotime($status_history[$j]->updated_on))?>
                                                    <?php if(isset($status_history[$j]->custom_msg)) { ?>
                                                        <br/>
                                                        <?=$status_history[$j]->custom_msg?>
                                                    <?php } ?>
                                                </p>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?= view('component/main_footer') ?>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <?= view('component/main_scripts') ?>
    <!-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script> -->
    <script>
        //let table = new DataTable('#myTable');

        /*var x = "<?= $rows->emp_name?>";
        var nameparts = x.split(" ");
        if(nameparts.length > 1){
            var initials = nameparts[0].charAt(0).toUpperCase() + nameparts[1].charAt(0).toUpperCase(); //Output: SR
        }else{
            var initials = nameparts[0].charAt(0).toUpperCase();
        }
        $('#emp_short_name').html(initials);*/

        var emp_name = "<?=$session->emp_name?>";
        var email = "<?=$session->email?>";
        var nameparts1 = emp_name.split(" ");
        if(nameparts1.length > 1){
            var initials1 = nameparts1[0].charAt(0).toUpperCase() + nameparts1[1].charAt(0).toUpperCase(); //Output: SR
        }else{
            var initials1 = nameparts1[0].charAt(0).toUpperCase();
        }

        //Submit Form
        $('#s_submitForm').click(function(){
            $ticket_id = $(this).data('ticket_id');
            $reply_text = $('#reply_text').val();


            if($reply_text == ''){
                alert('Please write your reply');
            }else{
                $.ajax({
                    url: '<?php echo base_url('portal/ticket/view-ticket-validation'); ?>',
                    type: 'post',
                    dataType:'json',
                    data:{ticket_id: $ticket_id, reply_text: $reply_text},
                    success:function(data){
                        //alert(data.message)
                        $('#save_comment_msg').html(data.message);
                        if(data.status == true ){
                            $('#s_myFormName')[0].reset();

                            // Get the ul element
                            var ul = $("#commentList");

                            // Create a new li element
                            var li = $("<li class='position-relative list-style-none'> <div class='ticket' data-toggle='tooltip' data-placement='top' title='"+emp_name+" "+email+"'> <span class=''>"+initials1+"</span> </div> <div class='margin-l'> <div class='bg-dark d-flex hd-style py-3 border-top-all-rd'> <p class='m-0 ms-3 me-3'><a href='#' class='text-light'>"+email+"</a></p> <span>Just Now</span> </div> <div class='comment-content py-3 border-bottom-all-rd'> <p class='ms-3'>"+$reply_text+"</p> <p class='ms-3 mb-0'> </p> </div> </div> </li>");

                            // Append the li element to the ul element
                            ul.append(li);
                        }else{
                            $validation = data.validation;
                        }
                    }
                });
            }//end if
        })

        //Accept ticket
        $('#accept_ticket').on('click', function(){
            $ticket_id = $(this).data('ticket_id');
            $created_by = $('#created_by').val();
            $accepted_by = $('#accepted_by').val();
            $accepted_by_name = $('#accepted_by_name').val();
            $ticket_status_id = $('#ticket_status_id').val();
            $ticket_status_text = $('#ticket_status_id option:selected').text();
            $max_allowed_time = $('#max_allowed_time').val();
            $old_ticket_status_id = $('#old_ticket_status_id').val();
            $old_ticket_status_text = $('#old_ticket_status_text').val();
            $emp_gr_id = $('#emp_gr_id').val();
            $emp_gr_text = $('#emp_gr_id option:selected').text();
            $hw_sl_id = $('#hw_sl_id').val();
            $hw_text = $('#hw_sl_id option:selected').text();
            $sr_req_msg = $('#sr_req_msg').val();

            $.ajax({
                url: '<?php echo base_url('portal/ticket/accept-ticket'); ?>',
                type: 'post',
                dataType:'json',
                data:{ticket_id: $ticket_id, created_by: $created_by, accepted_by:$accepted_by, accepted_by_name:$accepted_by_name, ticket_status_id: $ticket_status_id, ticket_status_text: $ticket_status_text, old_ticket_status_id: $old_ticket_status_id, old_ticket_status_text: $old_ticket_status_text, max_allowed_time: $max_allowed_time, emp_gr_id: $emp_gr_id, emp_gr_text: $emp_gr_text, hw_sl_id:$hw_sl_id, hw_text:$hw_text, sr_req_msg:$sr_req_msg},
                success:function(data){
                    if(data.status == true){
                        $('#accepted_by_short').html(initials1);
                        $('#accepted_on').html(data.last_updated);
                        $('#ticket_status_1').html($ticket_status_text);
                        $('#ticket_status_2').html($ticket_status_text);

                        $('#old_ticket_status_id').val($ticket_status_id);
                        $('#old_ticket_status_text').val($ticket_status_text);

                        if(data.deadline != ''){
                            onCountdown(data.deadline);
                        }

                        if($ticket_status_id == 8){
                            //$('#summary_report_div').show();
                            //$("#summary_report_div").css({ display: "block" });
                            $("#summary_report_div").attr("display", "block");
                        }else{
                            //$('#summary_report_div').hide();
                            //$("#summary_report_div").css({ display: "none" });
                            $("#summary_report_div").attr("display", "none");
                        }
                    }else{
                        $('#ticket_status_1').html($ticket_status_text);
                        $('#ticket_status_2').html($ticket_status_text);
                        console.log('Ticket Accept problem')
                    }

                    $('#ticket_stat_msg').html(data.message);
                    //alert(data.message)
                }
            });
        })

        $('#summary_report').on('click', function(){
            // Select the button you want to disable.
            $ticket_id = $(this).data('ticket_id');
            var anchor = document.createElement('a');
            anchor.href = '../summary_report/'+$ticket_id;
            anchor.target="_blank";
            anchor.click();
        })

        //countdown timer
        function onCountdown(countDownDate){
            var countDownDate = new Date(countDownDate);
            // Get the current date and time.
            var currentDate = new Date();
            // Calculate the difference between the two dates.
            if(countDownDate > currentDate){
                var timeRemaining = countDownDate - currentDate;

                // Convert the time to days, hours, minutes, and seconds.
                var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                // Display the countdown timer.
                document.getElementById("countdown").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s";

                // Update the countdown timer every second.
                setInterval(function() {
                    // Get the current date and time.
                    var currentDate = new Date();

                    // Calculate the difference between the two dates.
                    var timeRemaining = countDownDate - currentDate;

                    // Convert the time to days, hours, minutes, and seconds.
                    var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                    // Display the countdown timer.
                    document.getElementById("countdown").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s";
                }, 1000);
            }
        }//end

        $(document).ready(function() {
            $accepted_by = $('#accepted_by').val();
            $deadline = $('#deadline').val();
            if($accepted_by > 0){
                onCountdown($deadline);
            }

            //on status change
            $('#ticket_status_id').change(function (){
                var selected_val = $(this).val();
                //Delegate
                if(selected_val == 8){
                    $('#select_group_section').removeClass('d-none'); //show group select-box
                } else {
                    $('#select_group_section').addClass('d-none'); //hide group select-box
                }
                //SR Request
                if(selected_val == 5){
                    $('#select_device_serial_section').removeClass('d-none'); //show select-box
                } else {
                    $('#select_device_serial_section').addClass('d-none'); //hide select-box
                }
            });
        });
    </script>

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

</body>

</html>