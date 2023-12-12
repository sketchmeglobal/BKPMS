    <?= view('component/main_header') ?>
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" /> -->
    <?php foreach($css_files as $file): ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; ?>
    <style>
        .card{border-left: 4px solid #f7f7f7;}
        label{color:#000}
        .chosen-container{width:300px!important}
    </style>
</head>
<?php #echo '<pre>', print_r($approved_menu), '</pre>'; ?>
<body>
    
    <!-- validation and notification area -->
    <div class="d-none" id="validation_error"></div>
    
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
                        <h4 class="page-title">Users</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?=base_url('portal/dashboard')?>">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid"><?=$output?></div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <?= view('component/main_footer') ?>
        </div>
        
    </div>

    <?php foreach($js_files as $file): ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>
    <?= view('component/grocery_scripts') ?>
    
</body>

</html>