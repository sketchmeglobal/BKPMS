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
                          <li class="breadcrumb-item active"><span>Outlet</span></li>
                        </ol>
                      </nav>
                    </div>
                </div>
            </div>
            <div></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 px-4">
                        <button type="button" id="addNewRecord" class="btn btn-primary ms-2"
                            style="float: right; margin-bottom: 5px;">Add New</button>

                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Outlet Name</th>
                                    <th>Outlet Location</th>
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
                                    <td><?=$row['ol_name']?></td>
                                    <td><?=$row['ol_location']?></td>
                                    <td class="d-flex justify-content-evenly">
                                        <a href="javascript: void(0);" class="edit_class" data-table_id="<?=$row['ol_id']?>"><i class="fa fa-edit"></i></a>
                                        <a class="remove" href="javascript: void(0);" data-table_id="<?=$row['ol_id']?>"><i class="fas fa-times"></i></a>
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
            <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="text-primary modal-title" id="exampleModalLongTitle">Outlet</h5>

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
                                        <label for="ol_name">Outlet Name</label>
                                        <input type="text" class="form-control" name="ol_name" id="ol_name" required
                                            value="<?= isset($name) ? $name : '' ?>">
                                        <span class="error" id="ol_nameError">
                                            <?=(isset($validation['name']) ? $validation['name'] : '' ); ?>
                                        </span>
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <label for="ol_location">Outlet Location</label>
                                        <input minlength="5" type="text" class="form-control" name="ol_location"
                                            id="ol_location" required
                                            value="<?= isset($address) ? $address : '' ?>">
                                        <span class="error" id="ol_locationError"><?= (isset($validation['address']) ? $validation['address'] : ''); ?></span>
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
                $ol_name = $('#ol_name').val().replace(/^\s+|\s+$/gm,'');
                $ol_location = $('#ol_location').val().replace(/^\s+|\s+$/gm,'');
                $state_name = $('#state_name').val();
                $city_name = $('#city_name').val();
                
                $status = true;
                $formValidMsg = '';
                
                if($ol_name == ''){
                    $status = false;
                    $formValidMsg += 'Please enter Outlet name';
                    $('#ol_name').removeClass('is-valid');
                    $('#ol_name').addClass('is-invalid');
                }else{
                    $('#ol_name').removeClass('is-invalid');
                    $('#ol_name').addClass('is-valid');
                }

                if($ol_location == ''){
                    $status = false;
                    $formValidMsg += ', location';
                    $('#ol_location').removeClass('is-valid');
                    $('#ol_location').addClass('is-invalid');
                }else{
                    $('#ol_location').removeClass('is-invalid');
                    $('#ol_location').addClass('is-valid');
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
                        $state_name = $('#state_name').val();
                        $city_name = $('#city_name').val();
                        $query = {
                            ol_name: $ol_name,
                            ol_location: $ol_location,
                            table_id: $table_id,
                            state_name: $state_name,
                            city_name: $city_name    
                        };

                        console.log('form validated, save data & populate the data table')
                        $.ajax({  
                            url: '<?php echo base_url('admin/formValidationOL'); ?>',
                            type: 'post',
                            dataType:'json',
                            data:{query: $query},
                            success:function(data){
                                console.log(JSON.stringify(data));
                                console.log('status: ' + data.status);
                                if(data.status == true ){
                                    $('#ol_nameError').html('');
                                    $('#ol_locationError').html('');
                        
                                    $('#formValidMsg').hide();
                                    $("#s_myFormName").trigger("reset");

                                    if(parseInt(data.ho_id) > 0){
                                        //Creat the row
                                        var row = $('<tr>')
                                            .append('<td>'+data.ho_id+'</td>')
                                            .append('<td>'+$ol_name+'</td>')
                                            .append('<td>'+$ol_location+'</td>')
                                            .append('<td class="d-flex justify-content-evenly"><a href="javascript: void(0);" class="edit_class" data-table_id="'+data.ho_id+'"><i class="fa fa-edit"></i></a> <a class="remove" href="javascript: void(0);"><i class="fas fa-times" data-table_id="'+data.ho_id+'"></i></a></td>')

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
            $(".remove").click(function() {
                if(confirm("Are You Sure? This Process Can\'t be Undone.")){
                    $table_id = $(this).data('table_id');
                    $(this).closest('tr').remove();
                    //console.log('Delete table_id: ' + $table_id);

                    $.ajax({  
                        url: '<?php echo base_url('admin/removeTableDataOL'); ?>',
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
            $(".edit_class").click(function() {
                $table_id = $(this).data('table_id');
                //console.log('Delete table_id: ' + $table_id);

                $.ajax({  
                    url: '<?php echo base_url('admin/getTableDataOL'); ?>',
                    type: 'post',
                    dataType:'json',
                    data:{table_id: $table_id},
                    success:function(data){
                        console.log(JSON.stringify(data));
                        //console.log('status: ' + data.status);
                        if(data.status == true ){
                            $('#ol_name').val(data.result.ol_name);
                            $('#ol_location').val(data.result.ol_location);
                            $('#table_id').val(data.result.ol_id);
                            $('#state_name').val(data.result.state_id).trigger('change');
                            setTimeout(function(){
                                $('#city_name').val(data.result.city_id).trigger('change');                                
                            }, 1000);
                            $('#myModal').modal('show');
                        }
                    }  
                });//end ajak
            });


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