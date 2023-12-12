
<?php

    // echo '<pre>',print_r($approved_menu),'</pre>';

?>

    <?= view('component/header') ?>

    <?php foreach($css_files as $file): ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; ?>

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
                            <li class="breadcrumb-item active"><span><?=$breadcrumb?></span></li>
                            </ol>
                        </nav>
                        </div>
                    </div>
                </div>
                
                <div class="container">
                    <?=$output?>
                </div>

            </div>
        </div>

                <!-- Footer Start -->
        <?= view('component/footer') ?>
        <?= view('component/js') ?>
        <?php foreach($js_files as $file): ?>
            <script src="<?php echo $file; ?>"></script>
        <?php endforeach; ?>
    </body>
</html>