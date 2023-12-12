<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SMG HELPDESK | Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <?= view('component/css') ?>
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


            <!-- Sale & Revenue Start -->

            <!-- Sale & Revenue End -->

            <!-- Ticiekte Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4 justify-content-evenly">
                    <div class="col-lg-6 col-md-12">
                        <div class="ticked-head mb-3 overflow-hidden d-flex">
                            <div>
                                <div class=""><span class="text-bg-green px-2 text-light">Open</span></div>
                                <div class="mt-2"><i class="fa fa-ticket"></i><span> TIK-SMG-000112</span></div>
                            </div>
                            <div class="ms-3 pt-2">
                                <h5 class="text-primary">Printer issue</h5>
                                <p>Printer not starting</p>
                                <p class="">
                                    <a href="#"><i class="fa fa-file-image-o"></i>
                                        file_example_PNG_500kB.png</a>
                                </p>
                            </div>

                        </div>
                        <ul class="comments-list">
                            <li class="position-relative list-style-none ">
                                <div class="edit-text"><i class="activity-icon fa fa-user-plus"></i></div>
                                <div class="margin-l">
                                    <a href="#">@admin.demo</a><span> Changed assignee to </span><span
                                        class="bg-red mx-1 px-1">AD</span><span> 2 months ago</span>
                                </div>
                            </li>
                            <li class="position-relative list-style-none mt-3">
                                <div class="edit-text"><i class="activity-icon fa fa-warning"></i></div>
                                <div class="margin-l">
                                    <a href="#">@admin.demo</a><span> Changed severity to </span><span
                                        class="bg-red mx-1 px-1">High</span><span> 2 months ago</span>
                                </div>
                            </li>
                            <li class="position-relative list-style-none mt-3">
                                <div class="ticket" data-toggle="tooltip" data-placement="top"
                                    title="Admin Demo @admin.demo">
                                    <span class="">AD</span>
                                </div>
                                <div class="margin-l">
                                    <div class="bg-dark d-flex hd-style py-3 border-top-all-rd">
                                        <p class="m-0 ms-3 me-3"><a href="#" class="text-light">@admin.demo</a></p>
                                        <span>2 months ago</span>
                                    </div>
                                    <div class="comment-content py-3 border-bottom-all-rd">
                                        <p class="ms-3">Issue escalated</p>
                                        <p class="ms-3 mb-0">
                                            <a href="#"><i class="fa fa-file-image-o"></i>
                                                file_example_PNG_500kB.png</a>
                                        </p>
                                    </div>
                                </div>

                            </li>

                            <li class="position-relative list-style-none mt-3">
                                <div class="ticket" data-toggle="tooltip" data-placement="top"
                                    title="Agent Demo @agent.demo">
                                    <span class="">AD</span>
                                </div>
                                <div class="margin-l">
                                    <div class="bg-dark d-flex hd-style py-3 border-top-all-rd">
                                        <p class="m-0 ms-3 me-3"><a href="#" class="text-light">@agent.demo</a></p>
                                        <span>2 months ago</span>
                                    </div>
                                    <div class="comment-content py-3 border-bottom-all-rd">
                                        <p class="ms-3 mb-0">Issue checked.</p>

                                    </div>
                                </div>

                            </li>
                            <li class="position-relative list-style-none mt-3">
                                <div class="edit-text"><i class="activity-icon fa fa-user-plus"></i></div>
                                <div class="margin-l">
                                    <a href="#">@agent.demo</a><span> Changed status to </span><span
                                        class="bg-red mx-1 px-1">Closed</span><span> 2 months ago</span>
                                </div>

                            </li>
                            <li class="position-relative list-style-none mt-3">
                                <div class="edit-text"><i class="activity-icon fa fa-folder-open"></i></div>
                                <div class="margin-l">
                                    <a href="#">@user.demo</a><span class="ms-1">Re-opened the ticket</span><span class="ms-1"> 2 months ago</span>
                                </div>
                            </li>
                            

                        </ul>
                        <div class="mt-5">
                            <div><h3>Leave a comment</h3></div>
                            <form action="">
                                <textarea name="" id="editor" style="height: 195px;"></textarea>
                                <div class="custom-file mt-4">
                                    <input id="fileInput" type="file" class="custom-file-input">
                                    
                                </div>
                                <div class="col-md-12 mt-4 float-right">
                                    <button class="btn btn-primary" id="reply" data-ticket-no="TIK-SMG-000113">Reply <i
                                            class="fa fa-reply"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="sticky-this">
                            <div class="card-header text-center">
                                <h5 class="text-primary">Details</h5>
                            </div>
                            <div class="card-body-text">
                                <div class="d-flex align-items-center py-4">
                                    <p class="mx-3 mb-0">Ticket Number</p><span>TIK-SMG-000112</span>
                                </div>
                                <div class="d-flex align-items-center py-4">
                                    <p class="mx-3 mb-0">Created on</p><span>2 months ago</span>
                                </div>
                                <div class="d-flex align-items-center py-4">
                                    <p class="mx-3 mb-0">Created By</p><span>
                                        <div data-toggle="tooltip" data-placement="top" title="User Demo @user.demo">
                                            <span class="card-ud">UD</span>
                                        </div>
                                    </span>
                                </div>
                                <div class="d-flex align-items-center py-4">
                                    <p class="mx-3 mb-0">Purpose</p><span>Error in printing</span>
                                </div>
                                <div class="d-flex align-items-center py-4">
                                    <p class="mx-3 mb-0">SR Status</p><span><a href="#">Generated
                                            (SR/WB0O2C/001)</a></span>
                                    <p>Approval: Pending
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center py-4">
                                    <p class="mx-3 mb-0">Ticket Status </p><span class="bg-green mx-1 px-1">Open</span>
                                    <p class="mb-0 ms-3"><a href="#">edit</a></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center py-4">
                                    <p class="mx-3 mb-0">Ticket Severity </p><span class="bg-red mx-1 px-1">High</span>
                                    <p class="mb-0 ms-3"><a href="#">edit</a></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center py-4">
                                    <p class="mx-3 mb-0">Ticket Category</p><span>Network</span>
                                    <p class="mb-0 ms-3"><a href="#">edit</a></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center py-4">
                                    <p class="mx-3 mb-0">Ticket Priority</p><span>-</span>
                                    <p class="mb-0 ms-3"><a href="#">edit</a></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center py-4">
                                    <p class="mx-3 mb-0">Assigned to</p><span>
                                        <div data-toggle="tooltip" data-placement="top" title="Agent Demo @agent.demo">
                                            <span class="card-ud">AD</span>
                                        </div>
                                    </span>
                                    <p class="mb-0 ms-3"><a href="#">edit</a></p>
                                </div>
                                <div class="d-flex align-items-center py-4">
                                    <p class="mx-3 mb-0">Assigned on </p><span>2 months ago</span>
                                </div>
                                <div class="d-flex align-items-center py-4">
                                    <p class="mx-3 mb-0">CC</p><span>
                                        <div data-toggle="tooltip" data-placement="top" title="User Demo @user.demo">
                                            <span class="card-ud">UD</span>
                                        </div>
                                    </span>
                                </div>
                                <div class="d-flex align-items-center py-4">
                                    <p class="mx-3 mb-0">Last Updated on</p><span>-</span>
                                </div>


                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <!-- Ticiekte End -->




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
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
    </script>

    <script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
    </script>
</body>

</html>