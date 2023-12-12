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
                          <li class="breadcrumb-item active"><span>Holiday</span></li>
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
                                    <th>Date</th>
                                    <th>Description</th>
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
                                    <td><?=date('d-M-Y', strtotime($row['hl_date']))?></td>
                                    <td><?=$row['hl_description']?></td>
                                    <td class="d-flex justify-content-evenly">
                                        <a href="javascript: void(0);" class="edit_class" data-table_id="<?=$row['hl_id']?>"><i class="fa fa-edit"></i></a>
                                        <a class="remove" href="javascript: void(0);" data-table_id="<?=$row['hl_id']?>"><i class="fas fa-times"></i></a>
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
                            <h5 class="text-primary modal-title" id="exampleModalLongTitle">Holiday</h5>

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
                                        <label for="hl_date">Date</label>
                                        <input type="date" class="form-control" name="hl_date" id="hl_date" required >
                                        <span class="error" id="hl_dateError">
                                            <?=(isset($validation['name']) ? $validation['name'] : '' ); ?>
                                        </span>
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <label for="hl_description">Description</label>
                                        <input minlength="5" type="text" class="form-control" name="hl_description" id="hl_description" required >
                                        <span class="error" id="hl_descriptionError"><?= (isset($validation['address']) ? $validation['address'] : ''); ?></span>
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
                $hl_date = $('#hl_date').val().replace(/^\s+|\s+$/gm,'');
                $hl_description = $('#hl_description').val().replace(/^\s+|\s+$/gm,'');
                
                $status = true;
                $formValidMsg = '';
                
                if($hl_date == ''){
                    $status = false;
                    $formValidMsg += 'Please enter Date';
                    $('#hl_date').removeClass('is-valid');
                    $('#hl_date').addClass('is-invalid');
                }else{
                    $('#hl_date').removeClass('is-invalid');
                    $('#hl_date').addClass('is-valid');
                }

                if($hl_description == ''){
                    $status = false;
                    $formValidMsg += ', Description';
                    $('#hl_description').removeClass('is-valid');
                    $('#hl_description').addClass('is-invalid');
                }else{
                    $('#hl_description').removeClass('is-invalid');
                    $('#hl_description').addClass('is-valid');
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
                        $hl_description = $('#hl_description').val().replace(/^\s+|\s+$/gm,'');

                        $query = {
                            hl_date: $hl_date,
                            hl_description: $hl_description,
                            table_id: $table_id
                        };

                        console.log('form validated, save data & populate the data table')
                        $.ajax({  
                            url: '<?php echo base_url('admin/formValidationHL'); ?>',
                            type: 'post',
                            dataType:'json',
                            data:{query: $query},
                            success:function(data){
                                console.log(JSON.stringify(data));
                                console.log('status: ' + data.status);
                                if(data.status == true ){
                                    $('#hl_dateError').html('');
                                    $('#hl_descriptionError').html('');
                        
                                    $('#formValidMsg').hide();
                                    $("#s_myFormName").trigger("reset");

                                    if(parseInt(data.ho_id) > 0){
                                        //Creat the row
                                        var row = $('<tr>')
                                            .append('<td>'+data.ho_id+'</td>')
                                            .append('<td>'+$hl_date+'</td>')
                                            .append('<td>'+$hl_description+'</td>')
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
                        url: '<?php echo base_url('admin/removeTableDataHL'); ?>',
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
                    url: '<?php echo base_url('admin/getTableDataHL'); ?>',
                    type: 'post',
                    dataType:'json',
                    data:{table_id: $table_id},
                    success:function(data){
                        console.log(JSON.stringify(data));
                        //console.log('status: ' + data.status);
                        if(data.status == true ){
                            $('#hl_date').val(data.result.hl_date);
                            $('#hl_description').val(data.result.hl_description);
                            $('#table_id').val(data.result.hl_id);
                            $('#myModal').modal('show');
                        }
                    }  
                });//end ajak
            });
            </script>