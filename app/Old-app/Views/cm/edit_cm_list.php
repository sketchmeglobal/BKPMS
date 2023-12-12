<?= view('component/main_header') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
<style>
.card-border-left {
    border-left: 2px solid #91a498;
}

.card-header {
    border-top: 1px solid #91a498;
    border-bottom: 1px solid #91a498;
    border-right: 1px solid #91a498;
}

label {
    color: #000
}
</style>
</head>
<?php #echo '<pre>', print_r($approved_menu), '</pre>'; ?>

<body>

    <!-- validation and notification area
    <div class="d-none" id="validation_error"></div> -->

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
                        <h4 class="page-title">Change Management</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?=base_url('portal/dashboard')?>">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Request</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- basic table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <div class="card card-border-left">
                                        <a class="card-header" id="heading11">
                                            <button class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                                <h5 class="m-b-0">Details for - <?=$cm_header_data->title?></h5>
                                            </button>
                                        </a>
                                        <form id="edit_cm_form" class="form-horizontal r-separator" method="post">
                                            <div id="collapse1" class="collapse show" aria-labelledby="heading11"
                                                data-parent="#accordian-3">
                                                <div class="card-body">
                                                    <?php #print_r($cm_header_data); ?>
                                                    <h5
                                                        class="card-title m-t-10 p-b-20 text-info text-center font-weight-bold">
                                                        Reference No. -
                                                        <?=str_pad(($cm_header_data->reference_number), (CM_REF_LEADING_ZERO + 1), '0', STR_PAD_LEFT);?>
                                                    </h5>
                                                    <div class="row border-bottom">
                                                        <div class="col-sm-12 col-lg-6">
                                                            <div class="form-group row align-items-center m-b-0">
                                                                <label for="title"
                                                                    class="col-3 text-right control-label col-form-label">Title</label>
                                                                <div class="col-9 border-left p-t-10 p-b-10">
                                                                    <input value="<?=$cm_header_data->title?>" required
                                                                        type="text" class="form-control" id="title"
                                                                        name="title" placeholder="Title Here">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-lg-6">
                                                            <div class="form-group row align-items-center m-b-0">
                                                                <label for="details"
                                                                    class="col-3 text-right control-label col-form-label">Brief</label>
                                                                <div class="col-9 border-left p-t-10 p-b-10">
                                                                    <textarea name="details" id="details"
                                                                        placeholder="Details here"
                                                                        class="form-control"><?=$cm_header_data->details?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row border-bottom">
                                                        <div class="col-sm-12 col-lg-6">
                                                            <div class="form-group row align-items-center m-b-0">
                                                                <label for="proposed_start_date"
                                                                    class="col-3 text-right control-label col-form-label">Proposed
                                                                    start date</label>
                                                                <div class="col-9 border-left p-t-10 p-b-10">
                                                                    <input
                                                                        value="<?=$cm_header_data->proposed_start_date?>"
                                                                        type="date" name="proposed_start_date"
                                                                        id="proposed_start_date"
                                                                        placeholder="Proposed start date"
                                                                        class="form-control" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-lg-6">
                                                            <div class="form-group row align-items-center m-b-0">
                                                                <label for="proposed_end_date"
                                                                    class="col-3 text-right control-label col-form-label">Proposed
                                                                    end date</label>
                                                                <div class="col-9 border-left p-t-10 p-b-10">
                                                                    <input
                                                                        value="<?=$cm_header_data->proposed_end_date?>"
                                                                        type="date" name="proposed_end_date"
                                                                        id="proposed_end_date"
                                                                        placeholder="Proposed end date"
                                                                        class="form-control" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row border-bottom">
                                                        <div class="col-sm-12 col-lg-6">
                                                            <div class="form-group row align-items-center m-b-0">
                                                                <label for="cm_impact_id"
                                                                    class="col-3 text-right control-label col-form-label">Impact</label>
                                                                <div class="col-9 border-left p-t-10 p-b-10">
                                                                    <select class="form-control" required
                                                                        name="cm_impact_id" id="cm_impact_id">
                                                                        <option selected disabled value="">Select from
                                                                            the list</option>
                                                                        <?php foreach($impact_list as $il){ ?>
                                                                        <option
                                                                            <?=($il->id == $cm_header_data->cm_impact_id) ? 'selected' : ''?>
                                                                            value="<?=$il->id?>"><?=$il->impact_title?>
                                                                        </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-lg-6">
                                                            <div class="form-group row align-items-center m-b-0">
                                                                <label for="comments"
                                                                    class="col-3 text-right control-label col-form-label">Comment</label>
                                                                <div class="col-9 border-left p-t-10 p-b-10">
                                                                    <textarea name="comments" id="comments"
                                                                        placeholder="Comment"
                                                                        class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if(isset($validation) and !empty($validation->listErrors())){ ?>
                                                <hr>
                                                <?= $validation->listErrors()?>
                                                <?php } ?>
                                                <div class="card-footer bg-white">
                                                    <div class="form-group m-b-0 text-center">
                                                        <button type="submit" name="submit"
                                                            class="btn btn-info waves-effect waves-light">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <hr>

                                    <!-- ACTIVITY AREA -->
                                    <div class="card card-border-left">
                                        <a class="card-header" id="heading2">
                                            <button class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#collapse2" aria-expanded="false"
                                                aria-controls="collapse2">
                                                <h5 class="m-b-0">Activity Management</h5>
                                            </button>
                                        </a>
                                        <div id="collapse2" class="collapse" aria-labelledby="heading2"
                                            data-parent="#accordian-2">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs mt-3 ml-2" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab"
                                                        href="#list_cm_activity" role="tab">
                                                        <span class="hidden-sm-up font-weight-bold"><i
                                                                class="ti-list"></i></span>
                                                        <span
                                                            class="hidden-xs-down font-weight-bold">&nbsp;&nbsp;List</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#add_cm_activity"
                                                        role="tab">
                                                        <span class="hidden-sm-up font-weight-bold"><i
                                                                class="ti-plus"></i></span>
                                                        <span
                                                            class="hidden-xs-down font-weight-bold">&nbsp;&nbsp;Add</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content tabcontent-border">

                                                <div class="tab-pane active mt-3" id="list_cm_activity" role="tabpanel">
                                                    <div class="table-responsive">
                                                        <table id="cm_activity_table"
                                                            class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Title</th>
                                                                    <th>Description</th>
                                                                    <th>Benifits</th>
                                                                    <th>Adverse Effects</th>
                                                                    <th>Risk Covered</th>
                                                                    <th>Approval Status</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                    if((array)count($activity_list) > 0){ 
                                                                        $iter = 1;
                                                                        foreach($activity_list as $al){
                                                                    ?>
                                                                <tr>
                                                                    <td><?=$iter++?>.</td>
                                                                    <td><?=$al->title?></td>
                                                                    <td><?=$al->description?></td>
                                                                    <td><?=$al->benifits?></td>
                                                                    <td><?=$al->adverse_effects?></td>
                                                                    <td><?=($al->risk_covered == 1) ? 'Covered' : '<b>No</b>'?>
                                                                    </td>
                                                                    <td><?=($al->is_approved == 1) ? 'Approved by <b>'. $al->emp_name . '</b>' : 'Not approved' ?>
                                                                    </td>
                                                                    <td>
                                                                        <!-- <a data-pk="< ?=$al->id?>" class="btn btn-sm btn-warning" href="< ?=base_url('portal/change-management/edit-cm-list/') . $cl->id?>"> <i class="mdi mdi-table-edit"></i> Edit</a> -->
                                                                        <button data-pk="<?=$al->id?>" type="button"
                                                                            class="btn btn-sm btn-danger cm-activity-remove">
                                                                            <i class="mdi mdi-minus"></i>
                                                                            Remove</button>
                                                                    </td>
                                                                </tr>
                                                                <?php 
                                                                        }
                                                                    } 
                                                                    ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="tab-pane p-20" id="add_cm_activity" role="tabpanel">
                                                    <form id="add_cm_activity_form" action=""
                                                        class="form-horizontal r-separator" method="post">
                                                        <div class="card">
                                                            <div class="card-body p-0">
                                                                <div class="card-body bg-light">
                                                                    <div class="row border-bottom">
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="inputEmail3"
                                                                                    class="col-3 text-right control-label col-form-label">Title</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <input required type="text"
                                                                                        class="form-control" id="title"
                                                                                        name="title"
                                                                                        placeholder="Title Here">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="description"
                                                                                    class="col-3 text-right control-label col-form-label">Description</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <textarea required
                                                                                        name="description"
                                                                                        id="description"
                                                                                        placeholder="Description here"
                                                                                        class="form-control"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row border-bottom">
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="benifits"
                                                                                    class="col-3 text-right control-label col-form-label">Benifits</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <textarea name="benifits"
                                                                                        id="benifits"
                                                                                        placeholder="Benifits here"
                                                                                        class="form-control"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="adverse_effects"
                                                                                    class="col-3 text-right control-label col-form-label">Adverse
                                                                                    Effects</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <textarea name="adverse_effects"
                                                                                        id="adverse_effects"
                                                                                        placeholder="Adverse Effects here"
                                                                                        class="form-control"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row border-bottom">
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="approval_authority"
                                                                                    class="col-3 text-right control-label col-form-label">Approval
                                                                                    Authority</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <select class="form-control"
                                                                                        name="approval_authority"
                                                                                        id="approval_authority">
                                                                                        <option selected disabled
                                                                                            value="">Select from the
                                                                                            list</option>
                                                                                        <?php foreach(getUserList() as $row){ ?>
                                                                                        <option value="<?=$row->id?>">
                                                                                            <?=$row->emp_name?>
                                                                                        </option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="risk_covered"
                                                                                    class="col-3 text-right control-label col-form-label">Risk
                                                                                    Covered</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <div class="form-check">
                                                                                        <select class="form-control"
                                                                                            name="risk_covered" required
                                                                                            id="risk_covered">
                                                                                            <option selected value="">
                                                                                                Select from the
                                                                                                list</option>
                                                                                            <option value="1">Yes
                                                                                            </option>
                                                                                            <option value="0">No
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row border-bottom">
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="is_approved"
                                                                                    class="col-3 text-right control-label col-form-label">Approved
                                                                                    ?</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <div class="form-check">
                                                                                        <select class="form-control"
                                                                                            required name="is_approved"
                                                                                            id="is_approved">
                                                                                            <option value="1">Yes
                                                                                            </option>
                                                                                            <option value="0" selected>
                                                                                                No</option>
                                                                                        </select>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="card-footer bg-white">
                                                                    <!-- <input type="hidden"name="" id=""> -->
                                                                    <div class="form-group m-b-0 text-center">
                                                                        <button type="submit" name="activity_form"
                                                                            value="activity_form"
                                                                            class="btn btn-info waves-effect waves-light">Save</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- STAKEHOLDER AREA -->
                                    <div class="card card-border-left">
                                        <a class="card-header" id="heading3">
                                            <button class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#collapse3" aria-expanded="false"
                                                aria-controls="collapse3">
                                                <h5 class="m-b-0">Stakeholder Management</h5>
                                            </button>
                                        </a>
                                        <div id="collapse3" class="collapse" aria-labelledby="heading3"
                                            data-parent="#accordian-3">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs mt-3 ml-2" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab"
                                                        href="#list_cm_stakeholder" role="tab">
                                                        <span class="hidden-sm-up font-weight-bold"><i
                                                                class="ti-list"></i></span>
                                                        <span
                                                            class="hidden-xs-down font-weight-bold">&nbsp;&nbsp;List</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#add_cm_stakeholder"
                                                        role="tab">
                                                        <span class="hidden-sm-up font-weight-bold"><i
                                                                class="ti-plus"></i></span>
                                                        <span
                                                            class="hidden-xs-down font-weight-bold">&nbsp;&nbsp;Add</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content tabcontent-border">

                                                <div class="tab-pane active mt-3" id="list_cm_stakeholder"
                                                    role="tabpanel">
                                                    <div class="table-responsive">
                                                        <table id="cm_stakeholder_table"
                                                            class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Title</th>
                                                                    <th>Description</th>
                                                                    <th>Benifits</th>
                                                                    <th>Adverse Effects</th>
                                                                    <th>Risk Covered</th>
                                                                    <th>Approval Status</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                    if((array)count($stakeholder_list) > 0){ 
                                                                        $iter = 1;
                                                                        foreach($stakeholder_list as $sl){
                                                                        ?>
                                                                <tr>
                                                                    <td><?=$iter++?>.</td>
                                                                    <td><?=$sl->title?></td>
                                                                    <td><?=$sl->description?></td>
                                                                    <td><?=$sl->benifits?></td>
                                                                    <td><?=$sl->adverse_effects?></td>
                                                                    <td><?=($sl->risk_covered == 1) ? 'Covered' : '<b>No</b>'?>
                                                                    </td>
                                                                    <td><?=($sl->is_approved == 1) ? 'Approved by <b>'. $sl->emp_name . '</b>' : 'Not approved' ?>
                                                                    </td>
                                                                    <td>
                                                                        <!-- <a data-pk="< ?=$al->id?>" class="btn btn-sm btn-warning" href="< ?=base_url('portal/change-management/edit-cm-list/') . $cl->id?>"> <i class="mdi mdi-table-edit"></i> Edit</a> -->
                                                                        <button data-pk="<?=$sl->id?>" type="button"
                                                                            class="btn btn-sm btn-danger cm-stakeholder-remove">
                                                                            <i class="mdi mdi-minus"></i>
                                                                            Remove</button>
                                                                    </td>
                                                                </tr>
                                                                <?php 
                                                                        }
                                                                    } 
                                                                    ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="tab-pane p-20" id="add_cm_stakeholder" role="tabpanel">
                                                    <form id="add_cm_stakeholder_form" action=""
                                                        class="form-horizontal r-separator" method="post">
                                                        <div class="card">
                                                            <div class="card-body p-0">
                                                                <div class="card-body bg-light">
                                                                    <div class="row border-bottom">
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="inputEmail3"
                                                                                    class="col-3 text-right control-label col-form-label">Title</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <input required type="text"
                                                                                        class="form-control" id="title"
                                                                                        name="title"
                                                                                        placeholder="Title Here">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="description"
                                                                                    class="col-3 text-right control-label col-form-label">Description</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <textarea required
                                                                                        name="description"
                                                                                        id="description"
                                                                                        placeholder="Description here"
                                                                                        class="form-control"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row border-bottom">
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="benifits"
                                                                                    class="col-3 text-right control-label col-form-label">Benifits</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <textarea name="benifits"
                                                                                        id="benifits"
                                                                                        placeholder="Benifits here"
                                                                                        class="form-control"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="adverse_effects"
                                                                                    class="col-3 text-right control-label col-form-label">Adverse
                                                                                    Effects</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <textarea name="adverse_effects"
                                                                                        id="adverse_effects"
                                                                                        placeholder="Adverse Effects here"
                                                                                        class="form-control"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row border-bottom">
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="approval_authority"
                                                                                    class="col-3 text-right control-label col-form-label">Approval
                                                                                    Authority</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <select class="form-control"
                                                                                        name="approval_authority"
                                                                                        id="approval_authority">
                                                                                        <option selected disabled
                                                                                            value="">Select from the
                                                                                            list</option>
                                                                                        <?php foreach(getUserList() as $row){ ?>
                                                                                        <option value="<?=$row->id?>">
                                                                                            <?=$row->emp_name?>
                                                                                        </option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="risk_covered"
                                                                                    class="col-3 text-right control-label col-form-label">Risk
                                                                                    Covered</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <div class="form-check">
                                                                                        <select class="form-control"
                                                                                            name="risk_covered" required
                                                                                            id="risk_covered">
                                                                                            <option selected value="">
                                                                                                Select from the
                                                                                                list</option>
                                                                                            <option value="1">Yes
                                                                                            </option>
                                                                                            <option value="0">No
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row border-bottom">
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="is_approved"
                                                                                    class="col-3 text-right control-label col-form-label">Approved
                                                                                    ?</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <div class="form-check">
                                                                                        <select class="form-control"
                                                                                            required name="is_approved"
                                                                                            id="is_approved">
                                                                                            <option value="1">Yes
                                                                                            </option>
                                                                                            <option value="0" selected>
                                                                                                No</option>
                                                                                        </select>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="card-footer bg-white">
                                                                    <!-- <input type="hidden"name="" id=""> -->
                                                                    <div class="form-group m-b-0 text-center">
                                                                        <button type="submit" name="stakeholder_form"
                                                                            value="stakeholder_form"
                                                                            class="btn btn-info waves-effect waves-light">Save</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- RISK MANAGEMNT -->
                                    <div class="card card-border-left">
                                        <a class="card-header" id="heading4">
                                            <button class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#collapse4" aria-expanded="false"
                                                aria-controls="collapse4">
                                                <h5 class="m-b-0">Risk Management</h5>
                                            </button>
                                        </a>
                                        <div id="collapse4" class="collapse" aria-labelledby="heading4"
                                            data-parent="#accordian-4">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs mt-3 ml-2" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#list_cm_risk"
                                                        role="tab">
                                                        <span class="hidden-sm-up font-weight-bold"><i
                                                                class="ti-list"></i></span>
                                                        <span
                                                            class="hidden-xs-down font-weight-bold">&nbsp;&nbsp;List</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#add_cm_risk"
                                                        role="tab">
                                                        <span class="hidden-sm-up font-weight-bold"><i
                                                                class="ti-plus"></i></span>
                                                        <span
                                                            class="hidden-xs-down font-weight-bold">&nbsp;&nbsp;Add</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content tabcontent-border">

                                                <div class="tab-pane active mt-3" id="list_cm_risk" role="tabpanel">
                                                    <div class="table-responsive">
                                                        <table id="cm_risk_table"
                                                            class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Risk Involved</th>
                                                                    <th>Risk Handling</th>
                                                                    <th>Description</th>
                                                                    <th>Approval Status</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                    if((array)count($risk_list) > 0){ 
                                                                        $iter = 1;
                                                                        foreach($risk_list as $rl){
                                                                    ?>
                                                                <tr>
                                                                    <td><?=$iter++?>.</td>
                                                                    <td><?=$rl->risk_involved?></td>
                                                                    <td><?=$rl->risk_handling_method?></td>
                                                                    <td><?=$rl->description?></td>
                                                                    <td><?=($rl->is_approved == 1) ? 'Approved by <b>'. $rl->emp_name . '</b>' : 'Not approved' ?>
                                                                    </td>
                                                                    <td>
                                                                        <!-- <a data-pk="< ?=$al->id?>" class="btn btn-sm btn-warning" href="< ?=base_url('portal/change-management/edit-cm-list/') . $cl->id?>"> <i class="mdi mdi-table-edit"></i> Edit</a> -->
                                                                        <button data-pk="<?=$rl->id?>" type="button"
                                                                            class="btn btn-sm btn-danger cm-risk-remove">
                                                                            <i class="mdi mdi-minus"></i>
                                                                            Remove</button>
                                                                    </td>
                                                                </tr>
                                                                <?php 
                                                                        }
                                                                    } 
                                                                    ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="tab-pane p-20" id="add_cm_risk" role="tabpanel">
                                                    <form id="add_cm_risk_form" action=""
                                                        class="form-horizontal r-separator" method="post">
                                                        <div class="card">
                                                            <div class="card-body p-0">
                                                                <div class="card-body bg-light">
                                                                    <div class="row border-bottom">
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="risk_involved"
                                                                                    class="col-3 text-right control-label col-form-label">Risk
                                                                                    Involved</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <textarea name="risk_involved"
                                                                                        id="risk_involved"
                                                                                        placeholder="Risk Involved here"
                                                                                        class="form-control"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="risk_handling_method"
                                                                                    class="col-3 text-right control-label col-form-label">Risk
                                                                                    Handlin Method</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <textarea
                                                                                        name="risk_handling_method"
                                                                                        id="risk_handling_method"
                                                                                        placeholder="Risk Handlin Method here"
                                                                                        class="form-control"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row border-bottom">
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="description"
                                                                                    class="col-3 text-right control-label col-form-label">Description</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <textarea required
                                                                                        name="description"
                                                                                        id="description"
                                                                                        placeholder="Description here"
                                                                                        class="form-control"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="is_approved"
                                                                                    class="col-3 text-right control-label col-form-label">Approved
                                                                                    ?</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <div class="form-check">
                                                                                        <select class="form-control"
                                                                                            required name="is_approved"
                                                                                            id="is_approved">
                                                                                            <option value="1">Yes
                                                                                            </option>
                                                                                            <option value="0" selected>
                                                                                                No</option>
                                                                                        </select>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row border-bottom">
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="approval_authority"
                                                                                    class="col-3 text-right control-label col-form-label">Approval
                                                                                    Authority</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <select class="form-control"
                                                                                        name="approval_authority"
                                                                                        id="approval_authority">
                                                                                        <option selected disabled
                                                                                            value="">
                                                                                            Select from the
                                                                                            list</option>
                                                                                        <?php foreach(getUserList() as $row){ ?>
                                                                                        <option value="<?=$row->id?>">
                                                                                            <?=$row->emp_name?>
                                                                                        </option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                                <hr>
                                                                <div class="card-footer bg-white">
                                                                    <!-- <input type="hidden"name="" id=""> -->
                                                                    <div class="form-group m-b-0 text-center">
                                                                        <button type="submit" name="risk_form"
                                                                            value="risk_form"
                                                                            class="btn btn-info waves-effect waves-light">Save</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- TECHNOLOGY MANAGEMNT -->
                                    <div class="card card-border-left">
                                        <a class="card-header" id="heading5">
                                            <button class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#collapse5" aria-expanded="false"
                                                aria-controls="collapse5">
                                                <h5 class="m-b-0">Technology Management</h5>
                                            </button>
                                        </a>
                                        <div id="collapse5" class="collapse" aria-labelledby="heading5"
                                            data-parent="#accordian-5">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs mt-3 ml-2" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab"
                                                        href="#list_cm_technology" role="tab">
                                                        <span class="hidden-sm-up font-weight-bold"><i
                                                                class="ti-list"></i></span>
                                                        <span
                                                            class="hidden-xs-down font-weight-bold">&nbsp;&nbsp;List</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#add_cm_technology"
                                                        role="tab">
                                                        <span class="hidden-sm-up font-weight-bold"><i
                                                                class="ti-plus"></i></span>
                                                        <span
                                                            class="hidden-xs-down font-weight-bold">&nbsp;&nbsp;Add</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content tabcontent-border">

                                                <div class="tab-pane active mt-3" id="list_cm_technology"
                                                    role="tabpanel">
                                                    <div class="table-responsive">
                                                        <table id="cm_technology_table"
                                                            class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Code Backup</th>
                                                                    <th>Code Rollback</th>
                                                                    <th>DB Backup</th>
                                                                    <th>DB Rollback</th>
                                                                    <th>Retention</th>
                                                                    <th>Risk Covered?</th>
                                                                    <!-- <th>Approval Status</th> -->
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                    if((array)count($technology_list) > 0){ 
                                                                        $iter = 1;
                                                                        foreach($technology_list as $tl){
                                                                    ?>
                                                                <tr>
                                                                    <td><?=$iter++?>.</td>
                                                                    <td><?=($tl->code_backup_ready == 1) ? 'Yes' : 'No' ?>
                                                                    </td>
                                                                    <td><?=($tl->code_rollback_possible == 1) ? 'Yes' : 'No' ?>
                                                                    </td>
                                                                    <td><?=($tl->db_backup_ready == 1) ? 'Yes' : 'No' ?>
                                                                    </td>
                                                                    <td><?=($tl->db_rollback_possible == 1) ? 'Yes' : 'No' ?>
                                                                    </td>
                                                                    <td><?=($tl->retention_ready == 1) ? 'Yes' : 'No' ?>
                                                                    </td>
                                                                    <td><?=($tl->risk_covered == 1) ? 'Yes' : 'No' ?>
                                                                    </td>
                                                                    <td>
                                                                        <!-- <a data-pk="< ?=$al->id?>" class="btn btn-sm btn-warning" href="< ?=base_url('portal/change-management/edit-cm-list/') . $cl->id?>"> <i class="mdi mdi-table-edit"></i> Edit</a> -->
                                                                        <button data-pk="<?=$tl->id?>" type="button"
                                                                            class="btn btn-sm btn-danger cm-technology-remove">
                                                                            <i class="mdi mdi-minus"></i>
                                                                            Remove</button>
                                                                    </td>
                                                                </tr>
                                                                <?php 
                                                                        }
                                                                    } 
                                                                    ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="tab-pane p-20" id="add_cm_technology" role="tabpanel">
                                                    <form id="add_cm_technology_form" action=""
                                                        class="form-horizontal r-separator" method="post">
                                                        <div class="card">
                                                            <div class="card-body p-0">
                                                                <div class="card-body bg-light">
                                                                    <div class="row border-bottom">
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="code_backup_ready"
                                                                                    class="col-3 text-right control-label col-form-label">Code
                                                                                    Backup Ready</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <div class="form-check">
                                                                                        <select class="form-control"
                                                                                            name="code_backup_ready"
                                                                                            id="code_backup_ready">
                                                                                            <option selected=""
                                                                                                value="">
                                                                                                Select from the
                                                                                                list</option>
                                                                                            <option value="1">Yes
                                                                                            </option>
                                                                                            <option value="0">
                                                                                                No</option>
                                                                                        </select>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="code_rollback_possible"
                                                                                    class="col-3 text-right control-label col-form-label">Code
                                                                                    Rollback Possible</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <div class="form-check">
                                                                                        <select class="form-control"
                                                                                            name="code_rollback_possible"
                                                                                            id="code_rollback_possible">
                                                                                            <option selected=""
                                                                                                value="">
                                                                                                Select from the
                                                                                                list</option>
                                                                                            <option value="1">Yes
                                                                                            </option>
                                                                                            <option value="0">
                                                                                                No</option>
                                                                                        </select>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row border-bottom">
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="db_backup_ready"
                                                                                    class="col-3 text-right control-label col-form-label">DB
                                                                                    Backup Ready</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <div class="form-check">
                                                                                        <select class="form-control"
                                                                                            name="db_backup_ready"
                                                                                            id="db_backup_ready">
                                                                                            <option selected=""
                                                                                                value="">
                                                                                                Select from the
                                                                                                list</option>
                                                                                            <option value="1">Yes
                                                                                            </option>
                                                                                            <option value="0">
                                                                                                No</option>
                                                                                        </select>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="db_rollback_possible"
                                                                                    class="col-3 text-right control-label col-form-label">DB
                                                                                    Rollback Possible</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <div class="form-check">
                                                                                        <select class="form-control"
                                                                                            name="db_rollback_possible"
                                                                                            id="db_rollback_possible">
                                                                                            <option selected=""
                                                                                                value="">
                                                                                                Select from the
                                                                                                list</option>
                                                                                            <option value="1">Yes
                                                                                            </option>
                                                                                            <option value="0">
                                                                                                No</option>
                                                                                        </select>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row border-bottom">
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="retention_ready"
                                                                                    class="col-3 text-right control-label col-form-label">Retention
                                                                                    Ready</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <div class="form-check">
                                                                                        <select class="form-control"
                                                                                            name="retention_ready"
                                                                                            id="retention_ready">
                                                                                            <option selected=""
                                                                                                value="">
                                                                                                Select from the
                                                                                                list</option>
                                                                                            <option value="1">Yes
                                                                                            </option>
                                                                                            <option value="0">
                                                                                                No</option>
                                                                                        </select>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="risk_covered"
                                                                                    class="col-3 text-right control-label col-form-label">Risk
                                                                                    Covered</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <div class="form-check">
                                                                                        <select class="form-control"
                                                                                            name="risk_covered" required
                                                                                            id="risk_covered">
                                                                                            <option selected value="">
                                                                                                Select from the
                                                                                                list</option>
                                                                                            <option value="1">Yes
                                                                                            </option>
                                                                                            <option value="0">No
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="card-footer bg-white">
                                                                    <!-- <input type="hidden"name="" id=""> -->
                                                                    <div class="form-group m-b-0 text-center">
                                                                        <button type="submit" name="technology_form"
                                                                            value="technology_form"
                                                                            class="btn btn-info waves-effect waves-light">Save</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- COST MANAGEMNT -->
                                    <div class="card card-border-left">
                                        <a class="card-header" id="heading6">
                                            <button class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#collapse6" aria-expanded="false"
                                                aria-controls="collapse6">
                                                <h5 class="m-b-0">Cost Management </h5>
                                            </button>
                                        </a>
                                        <div id="collapse6" class="collapse" aria-labelledby="heading6"
                                            data-parent="#accordian-6">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs mt-3 ml-2" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#list_cm_cost"
                                                        role="tab">
                                                        <span class="hidden-sm-up font-weight-bold"><i
                                                                class="ti-list"></i></span>
                                                        <span
                                                            class="hidden-xs-down font-weight-bold">&nbsp;&nbsp;List</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#add_cm_cost"
                                                        role="tab">
                                                        <span class="hidden-sm-up font-weight-bold"><i
                                                                class="ti-plus"></i></span>
                                                        <span
                                                            class="hidden-xs-down font-weight-bold">&nbsp;&nbsp;Add</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content tabcontent-border">

                                                <div class="tab-pane active mt-3" id="list_cm_cost" role="tabpanel">
                                                    <div class="table-responsive">
                                                        <table id="cm_cost_table"
                                                            class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Title</th>
                                                                    <th>Description</th>
                                                                    <th>Cost Amount</th>
                                                                    <th>Approval Status</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                    if((array)count($cost_list) > 0){ 
                                                                        $iter = 1;
                                                                        foreach($cost_list as $cl){
                                                                        ?>
                                                                <tr>
                                                                    <td><?=$iter++?>.</td>
                                                                    <td><?=$cl->title?></td>
                                                                    <td><?=$cl->description?></td>
                                                                    <td><?=$cl->cost_amount?></td>
                                                                    <td><?=($cl->is_approved == 1) ? 'Approved by <b>'. $cl->emp_name . '</b>' : 'Not approved' ?>
                                                                    </td>
                                                                    <td>
                                                                        <!-- <a data-pk="< ?=$al->id?>" class="btn btn-sm btn-warning" href="< ?=base_url('portal/change-management/edit-cm-list/') . $cl->id?>"> <i class="mdi mdi-table-edit"></i> Edit</a> -->
                                                                        <button data-pk="<?=$cl->id?>" type="button"
                                                                            class="btn btn-sm btn-danger cm-cost-remove">
                                                                            <i class="mdi mdi-minus"></i>
                                                                            Remove</button>
                                                                    </td>
                                                                </tr>
                                                                <?php 
                                                                        }
                                                                    } 
                                                                    ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="tab-pane p-20" id="add_cm_cost" role="tabpanel">
                                                    <form id="add_cm_cost_form" action=""
                                                        class="form-horizontal r-separator" method="post">
                                                        <div class="card">
                                                            <div class="card-body p-0">
                                                                <div class="card-body bg-light">
                                                                    <div class="row border-bottom">
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="inputEmail3"
                                                                                    class="col-3 text-right control-label col-form-label">Title</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <input required type="text"
                                                                                        class="form-control" id="title"
                                                                                        name="title"
                                                                                        placeholder="Title Here">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="cost_amount"
                                                                                    class="col-3 text-right control-label col-form-label">Cost Amount</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <input required type="number"
                                                                                        class="form-control" id="cost_amount"
                                                                                        name="cost_amount"
                                                                                        placeholder="Cost Amount">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row border-bottom">
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="description"
                                                                                    class="col-3 text-right control-label col-form-label">Description</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <textarea required
                                                                                        name="description"
                                                                                        id="description"
                                                                                        placeholder="Description here"
                                                                                        class="form-control"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="is_approved"
                                                                                    class="col-3 text-right control-label col-form-label">Approved
                                                                                    ?</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <div class="form-check">
                                                                                        <select class="form-control"
                                                                                            required name="is_approved"
                                                                                            id="is_approved">
                                                                                            <option value="1">Yes
                                                                                            </option>
                                                                                            <option value="0" selected>
                                                                                                No</option>
                                                                                        </select>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row border-bottom">
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <div
                                                                                class="form-group row align-items-center m-b-0">
                                                                                <label for="approval_authority"
                                                                                    class="col-3 text-right control-label col-form-label">Approval
                                                                                    Authority</label>
                                                                                <div
                                                                                    class="col-9 border-left p-t-10 p-b-10">
                                                                                    <select class="form-control"
                                                                                        name="approval_authority"
                                                                                        id="approval_authority">
                                                                                        <option selected disabled
                                                                                            value="">Select from the
                                                                                            list</option>
                                                                                        <?php foreach(getUserList() as $row){ ?>
                                                                                        <option value="<?=$row->id?>">
                                                                                            <?=$row->emp_name?>
                                                                                        </option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="card-footer bg-white">
                                                                    <!-- <input type="hidden"name="" id=""> -->
                                                                    <div class="form-group m-b-0 text-center">
                                                                        <button type="submit" name="cost_form"
                                                                            value="cost_form"
                                                                            class="btn btn-info waves-effect waves-light">Save</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
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
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <?= view('component/main_footer') ?>
        </div>

    </div>

    <?= view('component/main_scripts') ?>

    <script>
    // validation and notification area
    $validation_status = "<?=$validation_status?>";
    $notification_status = "<?=$notify_status?>";
    $notify_type = "<?=$notify_type?>";
    $notify_msg = "<?=$notify_msg?>";

    if ($notification_status == '1') {
        if ($notify_type == 'success') {
            toastr.success($notify_msg, 'Success', {
                "closeButton": true
            });
        }
        if ($notify_type == 'error') {
            toastr.error($notify_msg, 'Failure', {
                "closeButton": true
            });
        }
    }
    // jQuery validation
    $("#edit_cm_form").validate({
        rules: {
            title: {
                required: true,
                minlength: 5
            }
        },
        submitHandler: function(form) {
            // maybe some code
            $(form).submit();
        }
    });

    // ACTIVITY DETAILS
    // remove area
    $('.cm-activity-remove').click(function() {
        $this = $(this);
        pid = $(this).data('pk')
        $.ajax({
            url: "<?= base_url('portal/change-management/ajax-remove-cm-activity-list') ?>",
            dataType: 'json',
            type: 'POST',
            data: {
                pid: pid
            },
            success: function(returnData) {
                // console.log(returnData);
                $this.closest('tr').remove();
                toastr.success("Item deleted succesfully", 'Success', {
                    "closeButton": true
                });
            },
            error: function(returnData) {
                obj = JSON.parse(returnData);
                console.log(obj);
                toastr.error("Item deleted succesfully", 'Error', {
                    "closeButton": true
                });
            }
        })
    });

    // STAKEHOLDER DETAILS
    // remove area
    $('.cm-stakeholder-remove').click(function() {
        $this = $(this);
        pid = $(this).data('pk')
        $.ajax({
            url: "<?= base_url('portal/change-management/ajax-remove-cm-stakeholder-list') ?>",
            dataType: 'json',
            type: 'POST',
            data: {
                pid: pid
            },
            success: function(returnData) {
                // console.log(returnData);
                $this.closest('tr').remove();
                toastr.success("Item deleted succesfully", 'Success', {
                    "closeButton": true
                });
            },
            error: function(returnData) {
                obj = JSON.parse(returnData);
                console.log(obj);
                toastr.error("Item deleted succesfully", 'Error', {
                    "closeButton": true
                });
            }
        })
    });


    // RISK DETAILS
    // remove area
    $('.cm-risk-remove').click(function() {
        $this = $(this);
        pid = $(this).data('pk')
        $.ajax({
            url: "<?= base_url('portal/change-management/ajax-remove-cm-risk-list') ?>",
            dataType: 'json',
            type: 'POST',
            data: {
                pid: pid
            },
            success: function(returnData) {
                // console.log(returnData);
                $this.closest('tr').remove();
                toastr.success("Item deleted succesfully", 'Success', {
                    "closeButton": true
                });
            },
            error: function(returnData) {
                obj = JSON.parse(returnData);
                console.log(obj);
                toastr.error("Item deleted succesfully", 'Error', {
                    "closeButton": true
                });
            }
        })
    });

    // TECHNOLOGY DETAILS
    // remove area
    $('.cm-technology-remove').click(function() {
        $this = $(this);
        pid = $(this).data('pk')
        $.ajax({
            url: "<?= base_url('portal/change-management/ajax-remove-cm-technology-list') ?>",
            dataType: 'json',
            type: 'POST',
            data: {
                pid: pid
            },
            success: function(returnData) {
                // console.log(returnData);
                $this.closest('tr').remove();
                toastr.success("Item deleted succesfully", 'Success', {
                    "closeButton": true
                });
            },
            error: function(returnData) {
                obj = JSON.parse(returnData);
                console.log(obj);
                toastr.error("Item deleted succesfully", 'Error', {
                    "closeButton": true
                });
            }
        })
    });

    // COST DETAILS
    // remove area
    $('.cm-cost-remove').click(function() {
        $this = $(this);
        pid = $(this).data('pk')
        $.ajax({
            url: "<?= base_url('portal/change-management/ajax-remove-cm-cost-list') ?>",
            dataType: 'json',
            type: 'POST',
            data: {
                pid: pid
            },
            success: function(returnData) {
                // console.log(returnData);
                $this.closest('tr').remove();
                toastr.success("Item deleted succesfully", 'Success', {
                    "closeButton": true
                });
            },
            error: function(returnData) {
                obj = JSON.parse(returnData);
                console.log(obj);
                toastr.error("Item deleted succesfully", 'Error', {
                    "closeButton": true
                });
            }
        })
    });

    $(document).ready(function() {
        $('#add_cm_activity_form').ajaxForm({
            success: function(res) {
                res = JSON.parse(res);
                notification(res);
            }

        });
        $('#add_cm_stakeholder_form').ajaxForm({
            success: function(res) {
                res = JSON.parse(res);
                notification(res);
            }

        });

        $('#add_cm_risk_form').ajaxForm({
            success: function(res) {
                res = JSON.parse(res);
                notification(res);
            }

        });
        $('#add_cm_technology_form').ajaxForm({
            success: function(res) {
                res = JSON.parse(res);
                notification(res);
            }

        });
        $('#add_cm_cost_form').ajaxForm({
            success: function(res) {
                res = JSON.parse(res);
                notification(res);
            }

        });
    });

    $("#add_cm_activity_form").validate();
    $("#add_cm_stakeholder_form").validate();
    $("#add_cm_risk_form").validate();
    $("#add_cm_technology_form").validate();
    $("#add_cm_cost_form").validate();
    </script>

</body>

</html>