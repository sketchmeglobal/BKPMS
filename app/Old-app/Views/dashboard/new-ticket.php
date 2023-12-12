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
                        <h5 class="text-primary">New Ticket</h5>
                    </div>
                </div>
            </div>
            <div class="container">

                <div class="row justify-content-center align-items-center">

                    <div class="col-md-12 bg-light mt-3" style="border-radius:5px;">
                        <div class="row py-4">
                            <div class="col-md-8">
                                <form action="">
                                    <div class="row">
                                        <div class="col-md-6 col-12 ">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Topic Type</label>
                                                <select class="form-control" id="exampleFormControlSelect1">
                                                    <option value="0">Select</option>
                                                    <option value="1">Hardware replacement</option>
                                                    <option value="2">Software renewal</option>
                                                    <option value="3">Mouse / keyboard failure</option>
                                                    <option value="4">Other device failure</option>
                                                    <option value="5">Others</option>
                                                </select>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 ">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Subject</label>
                                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="subject of the ticket">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mt-4">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Category</label>
                                                <select class="form-control" id="exampleFormControlSelect1">
                                                    <option value="0" >Select</option>
                                                    <option value="0" >Bug</option>
                                                    <option value="1" >Feature requests</option>
                                                    <option value="2" >Software Troubleshooting</option>
                                                    <option value="3" >How to</option>
                                                    <option value="4" >Password Reset</option>
                                                    <option value="5" >Network</option>
                                                    <option value="6" >Hardware</option>
                                                    <option value="7" >Access and Authorization</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mt-4">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Severity</label>
                                                <select class="form-control" id="exampleFormControlSelect1">
                                                    <option value="0" >Select </option>
                                                    <option value="1" >Low</option>
                                                    <option value="2" >Medium</option>
                                                    <option value="3" >High</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mt-4">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput">Authority CC</label>
                                                <input type="text" class="form-control" id="exampleFormControlInput">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mt-4">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Purpose</label>
                                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="subject of the ticket">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-4">
                                            <div class="">
                                                <label for="exampleFormControlInput1">Message</label>

                                                <textarea name="" id="editor" style="height: 195px;"></textarea>

                                                <div class="custom-file mt-4">
                                                    <input id="fileInput" type="file" class="custom-file-input">
                                                </div>

                                                <div class="col-md-12 mt-4 float-right">
                                                    <button class="btn btn-primary" id="reply" data-ticket-no="TIK-SMG-000113">Reply <i class="fa fa-reply"></i>
                                                    </button>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="card-header text-center">
                                    <h6 class="text-primary">Read Knowledge Base Before Inquiring</h6>
                                </div>
                                <div>
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        Category name1
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    Some placeholder content for the first accordion panel.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingTwo">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        Category name 2
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                <div class="card-body">
                                                    Some placeholder content for the second accordion panel. This panel
                                                    is hidden by default.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingThree">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        Category name 3
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                                <div class="card-body">

                                                    And lastly, the placeholder content for the third and final
                                                    accordion panel. This panel is hidden by default.

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>

</body>

</html>