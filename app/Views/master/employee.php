<?= view('component/header') ?>
<!-- < ?= isset($validation) ? print_r($validation) : ''; die; ?> -->

<style>
#s_myFormName .error {
    color: red !important;
    position: relative;
    padding: 0;
}
</style>
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
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
                          <li class="breadcrumb-item active"><span>Employee</span></li>
                        </ol>
                      </nav>
                    </div>
                </div>
            </div>
            <div></div>
            <div class="container">
            <div class="row bg-light">
                    <div class="col-md-12 my-2 px-4">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 form-group">
                                <label for="ho_id">H.O Name</label>
                                <select class="form-control" id="ho_id" name="ho_id">
                                    <option value="0">Select</option>
                                    <?php if($ho_rows): ?>
                                    <?php foreach($ho_rows as $ho_row): ?>
                                    <option value="<?=$ho_row->id?>"><?=$ho_row->ho_name?> (<?=$ho_row->ho_location?>)</option>
                                    <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 form-group">
                                <label for="wh_id">W.H Name</label>
                                <select class="form-control" id="wh_id" name="wh_id">
                                    <option value="0">Select</option>
                                    <?php if($wh_rows): ?>
                                    <?php foreach($wh_rows as $wh_row): ?>
                                    <option value="<?=$wh_row->wh_id?>"><?=$wh_row->wh_name?> (<?=$wh_row->wh_location?>)</option>
                                    <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 form-group">
                                <label for="ol_id">Outlet Name</label>
                                <select class="form-control" id="ol_id" name="ol_id">
                                    <option value="0">Select</option>
                                    <?php if($ol_rows): ?>
                                    <?php foreach($ol_rows as $ol_row): ?>
                                    <option value="<?=$ol_row->ol_id?>"><?=$ol_row->ol_name?> (<?=$ol_row->ol_location?>)</option>
                                    <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                            <div class="col-lg-3 form-group mt-4">
                                <button type="button" id="filterDept" name="filterDept" class="btn btn-primary ms-2" style="float: left; margin-bottom: 5px;">Search</button>                                
                            </div>
                            <span class="error" id="desigSearchError"></span>

                        </div>
                    </div> 

                    <div class="col-md-12 px-4" id="part_2" style="display: none">
                        <button type="button" id="addNewRecord" class="btn btn-primary ms-2"
                            style="float: right; margin-bottom: 5px;">Add New</button>

                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Employee Code</th>
                                    <th>Employee Name</th>
                                    <th>Primary Phone</th>
                                    <th>Secondary Phone</th>
                                    <th>Email</th>
                                    <th>Designation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal start -->
            <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="text-primary modal-title" id="exampleModalLongTitle">Employee</h5>

                            <button type="button" class=" btn btn-lg btn-primary btn-lg-square back-to-topclose" data-dismiss="modal" aria-label="Close" id="closeModal1"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" id="s_myFormName" method="post">
                                <div class="form-row row">
                                    <?php
                                    if (!empty(session()->getFlashdata('success'))) { ?>
                                    <div class="alert alert-success">
                                        <?php echo session()->getFlashdata('success'); ?>
                                    </div>
                                    <?php } ?>
                                    <div class="col-md-4 mb-1">
                                        <label for="emp_name">Employee Name</label>
                                        <input type="text" class="form-control" name="emp_name" id="emp_name" required value="">
                                        <span class="error" id="emp_nameError"> </span>
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <label for="primary_phone">Primary Phone</label>
                                        <input type="number" class="form-control" name="primary_phone"
                                            id="primary_phone" required value="">
                                        <span class="error" id="primary_phoneError"> </span>
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <label for="secondary_phone">Secondary Phone</label>
                                        <input type="number" class="form-control" name="secondary_phone"
                                            id="secondary_phone" required value="">
                                        <span class="error" id="secondary_phoneError"> </span>
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <label for="email_id">Email ID</label>
                                        <input type="email" class="form-control" name="email_id" id="email_id" required value="">
                                        <span class="error" id="email_idError"> </span>
                                    </div>
                                    
                                    <div class="col-md-4 mb-1">
                                        <label for="dg_id">Designation Name</label>
                                        <select class="form-control" id="dg_id" name="dg_id">
                                            <option value="0">Select</option>
                                            <?php if ($designation) : ?>
                                            <?php 
                                            $i = 1;
                                            foreach ($designation as $desig) : ?>
                                                <option value="<?=$desig->dg_id?>"><?=$desig->desig_name?></option>                                            
                                            <?php 
                                            $i++;
                                            endforeach ?>
                                            <?php endif ?>                                                
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-4 mb-1">
                                        <label for="user_level">User Level</label>
                                        <select class="form-control" id="user_level" name="user_level">
                                            <option value="0">Select</option>
                                            <?php if($u_level_rows): ?>
                                            <?php foreach($u_level_rows as $u_level_row): ?>
                                            <option value="<?=$u_level_row->user_level_id?>"><?=$u_level_row->user_level_name?> </option>
                                            <?php endforeach ?>
                                            <?php endif ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-4 mb-1">
                                        <label for="emp_gr_id">Group Name</label>
                                        <select class="form-control" id="emp_gr_id" name="emp_gr_id">
                                            <option value="">Select</option>
                                            <?php if ($emp_groups) : ?>
                                            <?php 
                                            $i = 1;
                                            foreach ($emp_groups as $emp_group) : ?>
                                                <option value="<?=$emp_group->emp_gr_id?>"><?=$emp_group->group_name?></option>                                            
                                            <?php 
                                            $i++;
                                            endforeach ?>
                                            <?php endif ?>                                                
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-4 mb-1">
                                        <label for="state_name">State Name</label>
                                        <select class="form-control" id="state_name" name="state_name">
                                            <option value="0">Select</option>
                                            <?php if($state_rows): ?>
                                            <?php foreach($state_rows as $state_row): ?>
                                            <option value="<?=$state_row->state_id?>"><?=$state_row->state_name?> </option>
                                            <?php endforeach ?>
                                            <?php endif ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-4 mb-1">
                                        <label for="city_name">City Name</label>
                                        <select class="form-control" id="city_name" name="city_name">
                                            <option value="0">Select</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-1">
                                        <label for="parent_emp_code">Immediate Boss</label>
                                        <input type="text" class="form-control" name="parent_emp_code" id="parent_emp_code" value="">
                                        <span class="error" id="parent_emp_codeError"> </span>
                                    </div>

                                    <div class="col-md-4 mb-1">
                                        <span class="error" id="formError">  </span>
                                        <label for="s_parentDesignation">&nbsp;</label>
                                        <input class="btn btn-primary py-2 w-50 mt-4" type="button" value="Save" name="submit" id="s_submitForm">
                                    </div>
                                </div>
                                <input type="hidden" id="table_id" name="table_id" value="0">
                            </form>

                        </div>
                        <!-- <div class="modal-footer">
                            <div id="formValidMsg" class="invalid-feedback"> </div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                id="closeModal">Close</button>
                        </div> -->
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
            //Form Validation    
            //$("#s_myFormName").validate();
            //Validation Form
            function validateForm(){
                $emp_name = $('#emp_name').val().replace(/^\s+|\s+$/gm,'');
                $primary_phone = $('#primary_phone').val().replace(/^\s+|\s+$/gm,'');
                $user_level = $('#user_level').val();
                $state_name = $('#state_name').val();
                $city_name = $('#city_name').val();
                
                $status = true;
                $formValidMsg = 'Please enter';
                
                if($emp_name == ''){
                    $status = false;
                    $formValidMsg += ', Employee name';
                    $('#emp_name').removeClass('is-valid');
                    $('#emp_name').addClass('is-invalid');
                }else{
                    $('#emp_name').removeClass('is-invalid');
                    $('#emp_name').addClass('is-valid');
                }

                if($primary_phone == ''){
                    $status = false;
                    $formValidMsg += ', Phone';
                    $('#primary_phone').removeClass('is-valid');
                    $('#primary_phone').addClass('is-invalid');
                }else{
                    $('#primary_phone').removeClass('is-invalid');
                    $('#primary_phone').addClass('is-valid');
                } 

                if($user_level == '0'){
                    $status = false;
                    $formValidMsg += ', uSER lEVEL';
                    $('#user_level').removeClass('is-valid');
                    $('#user_level').addClass('is-invalid');
                }else{
                    $('#user_level').removeClass('is-invalid');
                    $('#user_level').addClass('is-valid');
                } 

                if($state_name == '0'){
                    $status = false;
                    $formValidMsg += ', State Name';
                    $('#state_name').removeClass('is-valid');
                    $('#state_name').addClass('is-invalid');
                }else{
                    $('#state_name').removeClass('is-invalid');
                    $('#state_name').addClass('is-valid');
                } 

                if($city_name == '0'){
                    $status = false;
                    $formValidMsg += ', City Name';
                    $('#city_name').removeClass('is-valid');
                    $('#city_name').addClass('is-invalid');
                }else{
                    $('#city_name').removeClass('is-invalid');
                    $('#city_name').addClass('is-valid');
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
                        $table_id = $('#table_id').val();                        
                        $ho_id = $('#ho_id').val();
                        $wh_id = $('#wh_id').val();
                        $ol_id = $('#ol_id').val();
                        $secondary_phone = $('#secondary_phone').val();
                        $email_id = $('#email_id').val();
                        $dg_id = $('#dg_id').val();
                        $desig_name = $('#dg_id option:selected').text();
                        $user_level = $('#user_level').val();
                        $emp_gr_id = $('#emp_gr_id').val();
                        $state_name = $('#state_name').val();
                        $city_name = $('#city_name').val();
                        $parent_emp_code = $('#parent_emp_code').val();
                        
                        $query = {
                            emp_name: $emp_name,
                            primary_phone: $primary_phone,
                            secondary_phone: $secondary_phone,
                            email_id: $email_id,
                            dg_id: $dg_id,
                            table_id: $table_id,
                            ho_id: $ho_id,
                            wh_id: $wh_id,
                            ol_id: $ol_id,
                            user_level: $user_level,
                            emp_gr_id: $emp_gr_id,
                            state_name: $state_name,
                            city_name: $city_name,
                            parent_emp_code: $parent_emp_code                              
                        };

                        console.log('form validated, save data & populate the data table')
                        $.ajax({  
                            url: '<?php echo base_url('admin/formValidationEM'); ?>',
                            type: 'post',
                            dataType:'json',
                            data:{query: $query},
                            success:function(data){
                                //console.log(JSON.stringify(data));
                                //console.log('status: ' + data.status);
                                if(data.status == true ){
                                    $('#emp_nameError').html('');
                                    $('#primary_phoneError').html('');
                        
                                    $('#formValidMsg').hide();
                                    $("#s_myFormName").trigger("reset");

                                    if(parseInt(data.emp_id) > 0){
                                        //Creat the row
                                        var row = $('<tr>')
                                            .append('<td>1</td>')
                                            .append('<td>'+data.emp_code+'</td>')
                                            .append('<td>'+$emp_name+'</td>')
                                            .append('<td>'+$primary_phone+'</td>')
                                            .append('<td>'+$secondary_phone+'</td>')
                                            .append('<td>'+$email_id+'</td>')
                                            .append('<td>'+$desig_name+'</td>')
                                            .append('<td class="d-flex justify-content-evenly"><a href="javascript: void(0);" class="edit_class" data-table_id="'+data.emp_id+'"><i class="fa fa-edit"></i></a> <a class="remove_class" href="javascript: void(0);"><i class="fas fa-times" data-table_id="'+data.emp_id+'"></i></a></td>')

                                        //Prepend row with Table
                                        //myTable.row.add(row);
                                        $('#myTable tbody').prepend(row);
                                    }else{
                                        populateDataTable();
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

                                    $error_message = data.message;
                                    $('#formError').html($error_message);
                                }
                            }  
                        });
                    }else{
                        console.log('form validation Error')                    
                        $('#formValidMsg').show();
                    }

                }, 500)    
            })

            //Add Data
            $('#addNewRecord').on('click', function() {
                $("#s_myFormName").trigger("reset");
                $('#table_id').val('0');
                $('#myModal').modal('show');
            })

            //Hide Modal
            $('#closeModal1, #closeModal').on('click', function() {
                $('#myModal').modal('hide');
            })

            //Delete Data            
            $('#myTable').on('click', '.remove_class', function(){
                $table_id = $(this).data('table_id');
                console.log('Delete table_id: ' + $table_id);

                if(confirm("Are You Sure? This Process Can\'t be Undone.")){
                    $(this).closest('tr').remove();

                    $.ajax({  
                        url: '<?php echo base_url('admin/removeTableDataEM'); ?>',
                        type: 'post',
                        dataType:'json',
                        data:{table_id: $table_id},
                        success:function(data){
                            //console.log(JSON.stringify(data));
                            //console.log('status: ' + data.status);
                            if(data.status == true){
                                //$(this).closest('tr').remove();
                            }
                        }  
                    });//end ajak

                }//end
            });

            //Edit Data
            $('#myTable').on('click', '.edit_class', function(){
                $table_id = $(this).data('table_id');
                console.log('Edit table_id: ' + $table_id);

                $.ajax({  
                    url: '<?php echo base_url('admin/getTableDataEM'); ?>',
                    type: 'post',
                    dataType:'json',
                    data:{table_id: $table_id},
                    success:function(data){
                        console.log(JSON.stringify(data));
                        //console.log('status: ' + data.status);
                        if(data.status == true ){
                            $('#emp_name').val(data.result.emp_name);
                            $('#primary_phone').val(data.result.primary_phone);
                            $('#secondary_phone').val(data.result.secondary_phone);
                            $('#email_id').val(data.result.email_id);
                            $('#table_id').val(data.result.emp_id);
                            $('#dg_id').val(data.result.dg_id);
                            $('#user_level').val(data.result.user_level);
                            $('#emp_gr_id').val(data.result.emp_gr_id);
                            $('#parent_emp_code').val(data.result.parent_emp_code);
                            $('#state_name').val(data.result.state_id).trigger('change');
                            setTimeout(function(){
                                $('#city_name').val(data.result.city_id).trigger('change');                                
                            }, 1000);
                            $('#myModal').modal('show');
                        }
                    }  
                });//end ajak
            });

            
        
            $('#filterDept').on('click', function(){ 
                $ho_id = $('#ho_id').val();
                $wh_id = $('#wh_id').val();
                $ol_id = $('#ol_id').val();
                $counter = 0;
                $('#desigSearchError').html('');

                if(parseInt($ho_id) == 0 && parseInt($wh_id) == 0 && parseInt($ol_id) == 0){
                    $('#desigSearchError').html('Please choose Head Office or Ware House or Outlet');
                }else{
                    if(parseInt($ho_id) > 0){
                        $counter++;
                    }
                    if(parseInt($wh_id) > 0){
                        $counter++;
                    }
                    if(parseInt($ol_id) > 0){
                        $counter++;
                    }
                    console.log('counter: ' + $counter);
                    if(parseInt($counter) > 1){
                        $('#desigSearchError').html('Please choose any one of Head Office or Ware House or Outlet');
                    }else{
                        populateDataTable();
                        //getDesignationEM();
                        $('#part_2').show();
                    }

                }
            })
            
            function populateDataTable(){                
                $ho_id = $('#ho_id').val();
                $wh_id = $('#wh_id').val();
                $ol_id = $('#ol_id').val();

                $('#myTable').dataTable().fnClearTable();
                $('#myTable').dataTable().fnDestroy();
                
                $('#myTable').DataTable( {
                    "processing": true,
                    "language": {
                        processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
                    },
                    "serverSide": true,
                    "ajax": {
                        "url": "<?=base_url('admin/getDesigTableDataEM')?>",
                        "type": "POST",
                        "dataType": "json",
                        data: {
                            ho_id: function () {
                                return $ho_id;
                            },
                            wh_id: function () {
                                return $wh_id;
                            },
                            ol_id: function () {
                                return $ol_id;
                            }
                        },
                    },
                    //will get these values from JSON 'data' variable
                    "columns": [
                        { "data": "slNo" },
                        { "data": "emp_code" },
                        { "data": "emp_name" },
                        { "data": "primary_phone" },
                        { "data": "secondary_phone" },
                        { "data": "email_id" },
                        { "data": "desig_name" },
                        { "data": "action" },
                    ],
                    //column initialisation properties
                    "columnDefs": [{
                        "targets": [0, 1, 2, 3],
                        "orderable": false,
                    }]
                });
                
            }//end fun

            function getDesignationEM(){               
                $ho_id = $('#ho_id').val();
                $wh_id = $('#wh_id').val();
                $ol_id = $('#ol_id').val();

                $.ajax({  
                    url: '<?php echo base_url('admin/getDesignationEM'); ?>',
                    type: 'post',
                    dataType:'json',
                    data:{ho_id: $ho_id, wh_id: $wh_id, ol_id: $ol_id },
                    success:function(data){
                        console.log(JSON.stringify(data));
                        
                        if(data.status == true ){
                            $('#dg_id').html(data.option_text);
                        }
                    }  
                });//end ajak                
            }//end fun


            $('#state_name').on('change', function(){
                $state_name = $('#state_name').val();
                console.log('state_name: ' + $state_name);

                $.ajax({  
                    url: '<?php echo base_url('admin/get-city-list'); ?>',
                    type: 'post',
                    dataType: 'json',
                    data:{state_name: $state_name},
                    success:function(data){
                        //console.log(JSON.stringify(data));
                        if(data.status == true ){
                            $('#city_name').html(data.option_text);
                        }
                    }  
                });//end ajak
            })
            </script>