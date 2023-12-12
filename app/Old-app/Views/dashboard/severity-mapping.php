<?= view('component/header') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />


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
                    <div class="col-lg-5 col-md-6 col-10 bg-light py-2 text-center border-bottom-all-rd">
                        <h5 class="text-primary">Severity Mapping</h5>
                    </div>
                </div>
            </div>
            <div class="container">

                <div class="row">



                    <div class="col-md-12 px-4 my-5 overflow-x-hidden">
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>S. No</th>
                                    <th>Severity</th>
                                    <th>Hours</th>
                                    <th>Note</th>
                                    <th>Options</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1 </td>
                                    <td>Low</td>
                                    <td>48 hours</td>
                                    <td>- </td>
                                    <td>- </td>
                                </tr>
                                <tr>
                                    <td>2 </td>
                                    <td>Medium</td>
                                    <td>24 hours</td>
                                    <td>- </td>
                                    <td>- </td>
                                </tr>
                                <tr>
                                    <td>3 </td>
                                    <td>Normal</td>
                                    <td>14 hours</td>
                                    <td>- </td>
                                    <td>- </td>
                                </tr>
                                <tr>
                                    <td>4 </td>
                                    <td>High</td>
                                    <td>8 hours </td>
                                    <td>- </td>
                                    <td>- </td>
                                </tr>
                                <tr>
                                    <td>5 </td>
                                    <td>Critical</td>
                                    <td>4 hours </td>
                                    <td>- </td>
                                    <td>- </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">

                            Distributed By <a class="border-bottom" href="https://sketchmeglobal.com/" target="_blank">SMG</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <?= view('component/js') ?>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

</body>

</html>