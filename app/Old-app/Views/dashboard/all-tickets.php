<?= view('component/header') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />


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
                    <div class="col-lg-5 col-md-6 col-10 bg-light py-2 text-center border-bottom-all-rd">
                        <h5 class="text-primary">All Tickets</h5>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 my-5 px-4">
                        <div class="row">
                            <div class=" col-md-3 form-group">
                                <label class="control-label alpaca-control-label" for="alpaca3">Assigned To</label>
                                <input type="text" id="alpaca3" name="assign_to" class="alpaca-control form-control"
                                    autocomplete="off">
                            </div>
                            <div class="col-lg-3 col-md-6 form-group">
                                <label for="exampleFormControlSelect1">Example select</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>None</option>
                                    <option>Closed</option>
                                    <option>In-progress</option>
                                    <option>Open</option>

                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 form-group">
                                <label for="exampleFormControlSelect1">Priority</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>None</option>
                                    <option>High</option>
                                    <option>Low</option>
                                    <option>Medium</option>

                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 form-group">
                                <label for="exampleFormControlSelect1">Severity</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>None</option>
                                    <option>High</option>
                                    <option>Low</option>
                                    <option>Medium</option>

                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 form-group mt-3">
                                <label for="exampleFormControlSelect1">Category</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>Access and Authorization</option>
                                    <option>Bug</option>
                                    <option>Feature requests</option>
                                    <option>Hardware</option>
                                    <option>How to</option>
                                    <option>Network</option>
                                    <option>Password Reset</option>
                                    <option>Software Troubleshooting</option>



                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 px-4">
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>Ticket No</th>
                                    <th>Subject</th>
                                    <th>Severity</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Category</th>
                                    <th>Created By</th>
                                    <th>Assigned To</th>
                                    <th>Creared On</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>TIK-SMG-000113 </td>
                                    <td>Mouse problem</td>
                                    <td><span class="bg-red mx-1 px-1">High</span></td>
                                    <td>Not Assigned </td>
                                    <td><span class="bg-red mx-1 px-1">Closed</span></td>
                                    <td>Network</td>
                                    <td><span>
                                            <div data-toggle="tooltip" data-placement="top"
                                                title="User Demo @user.demo">
                                                <span class="card-ud" style="padding:4px !important">UD</span>@user.demo
                                    </td>
                                    <td><span>
                                            <div data-toggle="tooltip" data-placement="top"
                                                title="Admin Demo @admin.demo">
                                                <span class="card-ud"
                                                    style="padding:4px !important">AD</span>@agent.demo</td>
                                    <td>2 months ago</td>
                                    <td class="d-flex">
                                        <div><a href="<?= base_url('tickets-view/view1')  ?>"><i
                                                    class="fa fa-eye"></i></a></div>
                                        <div><a href="#"><i class="fa fa-repeat"></i></a></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>TIK-SMG-000112 </td>
                                    <td>Printer issue</td>
                                    <td><span class="bg-red mx-1 px-1">High</span></td>
                                    <td>Not Assigned </td>
                                    <td><span class="bg-green mx-1 px-1">Open</span></td>
                                    <td>Network</td>
                                    <td><span>
                                            <div data-toggle="tooltip" data-placement="top"
                                                title="User Demo @user.demo">
                                                <span class="card-ud" style="padding:4px !important">UD</span>@user.demo
                                    </td>
                                    <td><span>
                                            <div data-toggle="tooltip" data-placement="top"
                                                title="Admin Demo @admin.demo">
                                                <span class="card-ud"
                                                    style="padding:4px !important">AD</span>@agent.demo</td>
                                    <td>2 months ago</td>
                                    <td class="d-flex">
                                        <div><a href="<?= base_url('tickets-view/view2')  ?>"><i
                                                    class="fa fa-eye"></i></a></div>
                                        <div><a href="#"><i class="fa fa-repeat"></i></a></div>
                                    </td>
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

                            Distributed By <a class="border-bottom" href="https://sketchmeglobal.com/"
                                target="_blank">SMG</a>
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