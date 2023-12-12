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
                          <li class="breadcrumb-item active"><span>Hardware Stock Entry</span></li>
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
                                    <th>Device Name</th>
                                    <th>Device Serial No</th>
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
                                    <td><?=$row->hw_name?>(<?=$row->hw_code?>)</td>
                                    <td><?=$row->serial_no?></td>
                                    <td class="d-flex justify-content-evenly">
                                        <a href="javascript: void(0);" class="edit_class" data-table_id="<?=$row->hw_sl_id?>"><i class="fa fa-edit"></i></a>
                                        <a class="remove" href="javascript: void(0);" data-table_id="<?=$row->hw_sl_id?>"><i class="fas fa-times"></i></a>
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
                            <h5 class="text-primary modal-title" id="exampleModalLongTitle">Hardware Stock Entry</h5>

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
                                    <div class="col-12">
                                        <div class="form-row row bg-bk text-white p-2"> 
                                            <div class="form-group col-md-4">
                                                <label class="text-white" for="customLabel">Custom Label</label>
                                                <input type="text" class="form-control" name="customLabel" id="customLabel">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="text-white" for="customValue">Custom Value</label>
                                                <input type="text" class="form-control" name="customValue" id="customValue">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="text-white" for="addNew">Action</label><br>
                                                <input class="btn btn-primary" type="button" value="Add New" name="submit" id="addNew">
                                            </div>
                                        </div>
                                        <div class="form-row mt-3" id="metaData">
                                            <table class="table" id="tableMetaData">
                                                <thead>
                                                    <tr>
                                                        <th>Label</th>
                                                        <th>Value</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>    
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="hw_id">Device Name</label>
                                        <select class="form-control" id="hw_id" name="hw_id">
                                            <option value="0">Select</option>
                                            <?php if($hw_rows): ?>
                                            <?php foreach($hw_rows as $hw_row): ?>
                                            <option value="<?=$hw_row->hw_id?>"><?=$hw_row->hw_name?> (<?=$hw_row->hw_code?>)</option>
                                            <?php endforeach ?>
                                            <?php endif ?>
                                        </select>
                                        <!-- <input type="text" class="form-control" name="hw_id" id="hw_id" required value=""> -->
                                        <span class="error" id="hw_idError"> </span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="serial_no">Device Serial No</label>
                                        <input minlength="5" type="text" class="form-control" name="serial_no" id="serial_no" required value="">
                                        <span class="error" id="serial_noError"> </span>
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group col-md-4">
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
                $hw_id = $('#hw_id').val();
                $serial_no = $('#serial_no').val().replace(/^\s+|\s+$/gm,'');
                
                $status = true;
                $formValidMsg = '';
                
                if($hw_id == '0'){
                    $status = false;
                    $formValidMsg += 'Please select Hardware Name';
                    $('#hw_id').removeClass('is-valid');
                    $('#hw_id').addClass('is-invalid');
                }else{
                    $('#hw_id').removeClass('is-invalid');
                    $('#hw_id').addClass('is-valid');
                }

                if($serial_no == ''){
                    $status = false;
                    $formValidMsg += ', Serial No';
                    $('#serial_no').removeClass('is-valid');
                    $('#serial_no').addClass('is-invalid');
                }else{
                    $('#serial_no').removeClass('is-invalid');
                    $('#serial_no').addClass('is-valid');
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
                        $hw_id = $('#hw_id').val();
                        console.log('hw_id:' + $hw_id);
                        $query = {
                            hw_id: $hw_id,
                            serial_no: $serial_no,
                            table_id: $table_id,
                            deviceMetaData: $metaData
                        };

                        console.log('form validated, save data & populate the data table')
                        $.ajax({  
                            url: '<?php echo base_url('admin/formValidationHWS'); ?>',
                            type: 'post',
                            dataType:'json',
                            data:{query: $query},
                            success:function(data){
                                //console.log(JSON.stringify(data));
                                console.log('status: ' + data.status);
                                if(data.status == true ){
                                    window.location.href = 'hardwarestockentry';
                                    $('#hw_idError').html('');
                                    $('#serial_noError').html('');
                                    $('#metaData').html('');
                        
                                    $('#formValidMsg').hide();
                                    $("#s_myFormName").trigger("reset");

                                    if(parseInt(data.ho_id) > 0){
                                        //Creat the row
                                        var row = $('<tr>')
                                            .append('<td>'+data.ho_id+'</td>')
                                            .append('<td>'+$hw_id+'</td>')
                                            .append('<td>'+$serial_no+'</td>')
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
                $metaData = [];
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
                        url: '<?php echo base_url('admin/removeTableDataHWS'); ?>',
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
                    url: '<?php echo base_url('admin/getTableDataHWS'); ?>',
                    type: 'post',
                    dataType:'json',
                    data:{table_id: $table_id},
                    success:function(data){
                        //console.log(JSON.stringify(data));
                        //console.log('status: ' + data.status);
                        if(data.status == true ){
                            $('#hw_id').val(data.result.hw_id);
                            $('#serial_no').val(data.result.serial_no);
                            $('#table_id').val(data.result.hw_sl_id);
                            
                            if(data.result.deviceMetaData){
                                $metaData = JSON.parse(data.result.deviceMetaData);
                            }else{
                                $metaData = [];
                            }
                            populateMetaData($metaData, 'existing', $table_id);

                            $('#myModal').modal('show');
                        }
                    }  
                });//end ajak
            });

            $('#addNew').on('click', function(){
                $customLabel = $('#customLabel').val();
                $customValue = $('#customValue').val();

                $metaDataObj = {
                    objId: Math.floor(Math.random() * 100) + 1,
                    customLabel: $customLabel,
                    customValue: $customValue
                }

                $metaData.push($metaDataObj);
                $('#customLabel').val('');
                $('#customValue').val('');
                console.log(JSON.stringify($metaData))
                populateMetaData($metaData, 'new', '');
                
            })

            $(document).ready(function(){
                $metaData = [];
            })

            function populateMetaData($metaData, $type, $table_id){
                if($type == 'existing'){
                    $status_text = 'Saved';
                 }else{ 
                    $status_text = 'Waiting to be saved';
                 }

                $metaDataText = "";
                //$('#metaData').find('table tbody').html($metaDataText);
                for(var i = 0; i < $metaData.length; i++){
                    $metaDataText += '<tr>';
                    $metaDataText += '<td>' + $metaData[i].customLabel +"</td><td>"+ $metaData[i].customValue + '</td>';
                    $metaDataText += '<td>'+$status_text+ '</td>';                    
                    $metaDataText += '<td> <a class="remove_items" href="javascript: void(0);" data-table_id="'+$table_id+'" data-obj_id="'+ $metaData[i].objId +'"><i class="fas fa-times"></i></a> </td></tr>'; 
                }//end for

                $('#metaData').find('table tbody').html($metaDataText);
            }

            
            $('#tableMetaData').on('click', '.remove_items', function(){
                $objId = $(this).data('obj_id');
                $table_id = $(this).data('table_id');
                console.log('table_id: ' + $table_id + ' Delete objId: ' + $objId);

                if(confirm("Are You Sure? This Process Can\'t be Undone.")){
                    $filteredMetaData = [];
                    for(var $i = 0; $i < $metaData.length; $i++){
                        if($metaData[$i].objId != $objId){
                            $filteredMetaData.push($metaData[$i])
                        }
                    }//end for
                    $metaData = [];
                    $metaData = $filteredMetaData;
                    populateMetaData($metaData, 'new', $table_id)
                    //$( "#s_submitForm" ).trigger( "click" );
                }
            });


            </script>