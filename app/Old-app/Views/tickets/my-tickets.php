
<?= view('component/main_header') ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <style>
        .card{border-left: 4px solid #f7f7f7;}
        label{color:#000}
    </style>
</head>
<?php #echo '<pre>', print_r($approved_menu), '</pre>'; ?>
<body>

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
                        <h4 class="page-title">Ticket Management</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?=base_url('portal/dashboard')?>">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Ticket List</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <?php if($action_button_1 == 1): ?>
                                    <a class="btn btn-sm btn-success" href="<?=base_url('portal/ticket/new-ticket')?>"> <i class="mdi mdi-plus"></i> Create Ticket</a>
                                    <?php endif ?>
                                </h4>
                                <div class="table-responsive">
                                    <table id="my_ticket_list" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Ticket No</th>
                                            <th>Status</th>
                                            <th>Severity</th>
                                            <th>Category</th>
                                            <th>Subject</th>
                                            <th>Created By</th>
                                            <th>Creared On</th>
                                            <th>Accepted By</th>
                                            <th>Accepted On</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if ($rows) : ?>
                                            <?php foreach ($rows as $row) :
                                                $emp_name_exp = explode(" ", $row->emp_name);
                                                //status text background colour
                                                switch ($row->ticket_status_id) {
                                                    case 1 : $status_bg = 'red'; break;
                                                    case 2 : $status_bg = 'goldenrod'; break;
                                                    case 3 : $status_bg = 'blueviolet'; break;
                                                    case 4 : $status_bg = 'gray'; break;
                                                    case 5 : $status_bg = 'blue'; break;
                                                    case 6 : $status_bg = 'green'; break;
                                                    case 7 : $status_bg = 'deeppink'; break;
                                                    case 8 : $status_bg = 'orange'; break;
                                                    case 9 : $status_bg = 'orangered'; break;
                                                    default : $status_bg = 'darkcyan'; break;
                                                }
                                                //severity text background colour
                                                switch ($row->id) {
                                                    case 1 : $severity_bg = 'limegreen'; break;
                                                    case 2 : $severity_bg = 'orange'; break;
                                                    case 3 : $severity_bg = 'red'; break;
                                                    case 4 : $severity_bg = 'gray'; break;
                                                    default : $severity_bg = 'darkcyan'; break;
                                                }
                                                ?>
                                                <tr>
                                                    <td width="10%"><?=$row->ticket_number?></td>
                                                    <td width="11%"><span class="mx-1 px-1" style="background:<?=$status_bg?>;border-radius: 5px;color: white;"><?=$row->ticket_status_name?></span></td>
                                                    <td><span class="mx-1 px-1" style="background:<?=$severity_bg?>;border-radius: 5px;color: white;"><?=$row->ticket_severity_name?></span></td>
                                                    <td><?=$row->ticket_category_name?></td>
                                                    <td><?=$row->ticket_subject?></td>
                                                    <td>
                                                        <div data-toggle="tooltip" data-placement="top" title="<?=$row->emp_name?> <?=$row->email_id?>">
                                                            <?=$row->emp_name.'<br/>'.$row->email_id?>
                                                        </div>
                                                    </td>
                                                    <td><?=date('d-M-Y H:i A', strtotime($row->created_on))?></td>
                                                    <td><?=$row->accepted_by_name?></td>
                                                    <td><?php if($row->accepted_by_name != ''){ echo date('d-M-Y H:i A', strtotime($row->accepted_at)); }?></td>
                                                    <td width="6%">
                                                        <?php if($action_button_2 == 1){ ?>
                                                            <span data-toggle="tooltip" data-placement="top" title="View Ticket Details">
                                                                <a href="<?=base_url('portal/ticket/view-ticket/'.$row->ticket_id)?>"><i class="fa fa-eye"></i></a>
                                                            </span>
                                                            <span data-toggle="tooltip" data-placement="top" title="Ticket Progress Report">
                                                                <a href="<?=base_url('portal/ticket/ticket_progress_report/'.$row->ticket_id)?>" target="_blank"><i class="fa fa-file-pdf"></i></a>
                                                            </span>
                                                            <?php
                                                            if(str_contains($row->status_history, 'SR Approved')) {
                                                            ?>
                                                            <span data-toggle="tooltip" data-placement="top" title="Service Request Receipt">
                                                                    <a href="<?=base_url('portal/ticket/summary_report/'.$row->ticket_id)?>" target="_blank"><i class="fa fa-gavel"></i></a>
                                                                </span>
                                                            <?php
                                                            }
                                                        }else{
                                                            echo '-';
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= view('component/main_footer') ?>
        </div>
    </div>

    <?= view('component/main_scripts') ?>

    <script>
        $(document).ready(function(){
            $('#my_ticket_list').DataTable();
        })
    </script>
</body>
</html>


