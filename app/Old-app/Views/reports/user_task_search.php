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
                          <li class="breadcrumb-item active"><span>User Task Search</span></li>
                        </ol>
                      </nav>
                    </div>
                </div>
            </div>
            <div></div>
            <div class="container">
                <div class="row">
                    <form class="needs-validation" novalidate name="s_myFormName" id="s_myFormName" action="<?php echo base_url('admin/user-task-report'); ?>" method="post" target="_blank">
                        <div class="form-row row"> 
                            <div class="col-md-3 mb-1">
                                <label for="from_date">From date</label>
                                <input type="date" class="form-control" id="from_date" name="from_date">
                            </div> 
                            <div class="col-md-3 mb-1">
                                <label for="to_date">To Date</label>
                                <input type="date" class="form-control" id="to_date" name="to_date">
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
            $from_date = $('#from_date').val();
            $to_date = $('#to_date').val();

            $('#s_submitForm_spinner').show();
            $('#s_submitForm_spinner_text').show();
            $('#s_submitForm_text').hide();
            $('#formValidMsg').hide();

            $('#formValidMsg').html('');
            
            if($from_date == '' || $to_date == ''){                
                $('#formValidMsg').html('Please select any of the search parameter');
                $('#formValidMsg').show();

                $('#s_submitForm_spinner').hide();
                $('#s_submitForm_spinner_text').hide();
                $('#s_submitForm_text').show();
                $('#formValidMsg').show();
            }else{                
                $query = {
                    from_date: $from_date,
                    to_date: $to_date
                };

                $('#s_submitForm_spinner').hide();
                $('#s_submitForm_spinner_text').hide();
                $('#s_submitForm_text').show();
                $('#formValidMsg').hide();
                
            }//end if  
        })

    </script>
    