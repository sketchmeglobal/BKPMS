<?= view('component/header') ?>

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
        <div class="content open"  style="min-height:100vh">
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
                          <li class="breadcrumb-item active"><span> Dashboard</span></li>
                        </ol>
                      </nav>
                    </div>
                </div>
            </div>

            <div class="container-fluid pt-4 px-4 mb-5">
                <div class="row"><hr></div>
                <div class="row border-start border-success border-5">
                    <div class="col-lg-4">
                        <div class="rounded d-flex align-items-center justify-content-between p-4" style="background: #102542; color: white;">
                            <i class="fa fa-users fa-3x text-light pe-5 border-end"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Users</p>
                                <h6 class="mb-0 text-white text-center">1</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="rounded d-flex align-items-center justify-content-between p-4" style="background: #2f9c66; color: white;">
                            <i class="fa fa-user-secret fa-3x text-light pe-5 border-end"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Agents</p>
                                <h6 class="mb-0 text-white text-center">1</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="rounded d-flex align-items-center justify-content-between p-4" style="background: #2290f4; color: white;">
                            <i class="fa fa-user-circle fa-3x text-light pe-5 border-end"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Managers</p>
                                <h6 class="mb-0 text-white text-center">1</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4"><hr></div>
                <div class="row border-start border-primary border-5">
                    <div class="col-lg-4">
                        <a href="<?= base_url('admin/all-tickets')  ?>">
                            <div class="rounded d-flex align-items-center justify-content-between p-4" style="background: #7a9ea3; color: white;">
                                <i class="fa fa-tasks fa-3x text-white pe-5 border-end"></i>
                                <div class="ms-3">
                                    <p class="mb-2">All Tickets</p>
                                    <h6 class="mb-0 text-white text-center">8</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <a href="<?= base_url('admin/all-tickets')  ?>">
                            <div class="rounded d-flex align-items-center justify-content-between p-4" style="background: #ff4d00; color: white;">
                                <i class="fa fa-check fa-3x text-white pe-5 border-end"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Open Tickets</p>
                                    <h6 class="mb-0 text-white text-center">1</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <a href="<?= base_url('admin/all-tickets')  ?>">
                            <div class="rounded d-flex align-items-center justify-content-between p-4" style="background: #bfa0a6; color: white;">
                                <i class="fa fa-user fa-3x text-white pe-5 border-end"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Assigned Tickets</p>
                                    <h6 class="mb-0 text-white text-center">4</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 mt-lg-4">
                        <a href="<?= base_url('admin/all-tickets')  ?>">
                            <div class="rounded d-flex align-items-center justify-content-between p-4" style="background: #8a7fbf; color: white;">
                                <i class="fa fa-window-close fa-3x text-white pe-5 border-end"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Closed Tickets</p>
                                    <h6 class="mb-0 text-white text-center">3</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row mt-4"><hr></div>
                <div class="row border-start border-warning border-5">
                    <div class="col-xl-4">
                        <!--https://sketchmeglobal.com/site_management/admin/project-detail/7-->
                        <a href="<?= base_url('admin/change-management')  ?>">
                            <div class="rounded d-flex align-items-center justify-content-between p-4" style="background: #4bbccc; color: white;">
                                <i class="fa fa-exchange-alt fa-3x text-white pe-5 border-end"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Change Request</p>
                                    <h6 class="mb-0 text-white text-center">3</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row mt-4"><hr></div>
            </div>
            <!-- Footer Start -->
            <div class="container-fluid mt-5">
                <div class="bg-light rounded-top p-2">
                    <div class="row">
                        <div class="col-md-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                        </div>
                        <div class="col-md-6 text-center text-sm-end">
                            Distributed By <a class="border-bottom" href="https://sketchmeglobal.com/" target="_blank">SMG</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->

        </div>
        <!-- Content End -->
    </div>
    
    
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <?= view('component/js') ?>
</body>

</html>