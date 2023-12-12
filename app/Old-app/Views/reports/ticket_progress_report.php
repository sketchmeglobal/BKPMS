<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Ticket Progress Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
    <link href="https://fonts.googleapis.com/css?family=Chivo|Signika" rel="stylesheet">
    <style>
        body{
            /*font-family: 'Chivo', sans-serif;*/
            font-family: Calibri;
        }
        p {
            margin: 0 0 5px;
        }
        table{ border: 1px solid #777; }
        .table{
            margin-bottom: 3px;
        }
        .head_font{
            /*font-family: 'Signika', sans-serif;*/
            font-family: Calibri;
        }
        .container{width: 100%}
        .border_all{
            border: 1px solid #000;
        }
        .border_bottom{
            border-bottom: 1px solid #000;
        }
        .border_right{ border-right:1px solid}
        .border_left{ border-left:1px solid}
        .mar_0{
            margin: 0
        }
        .mar_bot_3{
            margin-bottom: 3px
        }

        .header_left, .header_right{
            height: 126px
        }

        .width-100{width: 100%}

        .height_60{ height: 60px }
        .height_42{ height: 42px }
        .height_135{height: 150px}
        .height_90{height: 90px}
        .height_100{height: 100px}
        .height_110{height: 110px}
        .height_41{ height: 41px }
        .height_23{ height: 23px }
        .height_63{ height: 63px }
        .height_21{ height: 21px }

        .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid #000!important;  text-align: center;}
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 13px}

        .border-bottom{border-bottom:  1px solid #000}

        @page { size: A4 }

        @media print{
            .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid #000;  text-align: center;}
            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 13px}
            .col-sm-6{ width: 50%!important;float:left; }.col-sm-5 { width: 41.66666667%;float:left; }.col-sm-7 { width: 58.33333333%;float:left; }
            .border-bottom{border-bottom:  1px solid #000}
            /*body.A4 .sheet{*/
            /*    height: 500px;*/
            /*}*/
            thead{
                margin-top: 15px;
            }
        }
        thead{
            margin-top: 15px;
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4" id="page-content">
<?php
//echo json_encode($rows);
//echo json_encode($return_lists);
//echo json_encode($issue_lists);
$status_history = json_decode($rows->status_history);
//echo '<pre>',print_r($status_history),'</pre>';
$updated_by_name = '';
$sr_generated_by = '';
$sr_approved_by = '';
for($i = 0; $i < sizeof($status_history); $i++){
    if($status_history[$i]->old_status == 1 && $status_history[$i]->new_status == 2){
        $updated_by_name = $status_history[$i]->updated_by_name;
    }//end if
    if($status_history[$i]->new_status == 7){
        $sr_generated_by = $status_history[$i]->updated_by_name;
    }//end if
    if($status_history[$i]->new_status == 8){
        $sr_approved_by = $status_history[$i]->updated_by_name;
    }//end if
}//end for
?>
<!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
<section class="sheet padding-10mm" style="height:auto">
    <div>
        <!-- <header class="pull-right">
            <small>Page No. 1</small>
        </header> -->
        <div class="clearfix"></div>
        <div class="container">
            <div class="row border_all text-center text-uppercase mar_bot_3">
                <h3 class="mar_0 head_font">Ticket Progress Report</h3>
            </div>
            <div class="row mar_bot_3">
                <div class="col-sm-6 border_all header_left">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="http://sketchmeglobal.com/demo-baazarkolkata-pms/dist/assets/img/banner.png" style="width:100%;margin-top: 35px;border: 1px solid;padding: 2px;" />
                        </div>
                        <div class="col-sm-9">
                            <h4  class=""><strong><?=COMPANY_SHORT_NAME?> </strong></h4>
                            <p class="mar_0"><?=COMPANY_ADDRESS?></p>
                            <!--<p class="mar_0">TEL:+91-33-40031411,40031412</p>-->
                            <!--<p class="mar_0">Email : info@shilpaoverseas.com</p>-->
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 header_right">
                    <div class="row mar_bot_3">
                        <div class="col-sm-6 border_all height_60">
                            <div class="">
                                <p class="mar_0">Ticket No.: <strong><?=$rows->ticket_number?></strong></p>
                                <p class="mar_0">Report Date: <strong><?=date('d-m-Y')?></strong></p>
                            </div>
                        </div>
                        <div class="col-sm-6 border_all height_60">
                            <div class="">
                                <p class="mar_0"></p>
                                <p class="mar_0">Current Ticket Status: <br/><strong><?=end($status_history)->new_status_text?></strong></p>
                            </div>
                        </div>
                    </div>
                    <div class="row border_all height_63 mar_bot_3">
                        <div class="col-sm-12">
                            <p class="mar_0">Ticket Created by: Outlet <strong>'<?=$rows->ol_name?>' (<?=$rows->ol_location?>)</strong></p>
                        </div>
                    </div>
                </div>
            </div>
            <br/>

            <div class="row border_all">
                <div class="col-sm-3 border_right border_bottom">
                    Issue Type: <br><strong><?=$rows->topic_name?></strong>
                </div>
                <div class="col-sm-6 border_right border_bottom">
                    Issue Category: <br><strong><?= $rows->ticket_category_name?></strong>
                </div>
                <div class="col-sm-3 border_bottom">
                    Severity: <br><strong><?=$rows->ticket_severity_name?></strong>
                </div>

                <div class="col-sm-6">
                    <strong>Subject:</strong> <?=$rows->ticket_subject?>
                    <br/>
                    <strong>Purpose:</strong>
                </div>
                <div class="col-sm-6 border_left">
                    <strong>Description:</strong> <br/><?=$rows->ticket_description?>
                </div>
            </div>
            <br/>

            <!--table data-->
            <div class="row">
                <!--<h4 class="text-center border-bottom">Consumption Details</h4>-->
                <div class="table-responsive">
                    <?php
                    if($status_history):
                        ?>
                        <table id="" class="table table-bordered table-hover width-100" >
                            <thead>
                            <tr>
                                <th colspan="4"><h4 class="text-center"><b>Progress History</b></h4></th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Ticket Status</th>
                                <th>Updated By</th>
                                <th>Date Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Open</td>
                                <td>'<?=$rows->ol_name?>' (<?=$rows->ol_location?>)</td>
                                <td><?=date('d-m-Y h:i A', strtotime($rows->created_on))?></td>
                            </tr>
                            <?php
                            $counter = 2;
                            foreach($status_history as $val):
                                ?>
                                <tr>
                                    <td><?=$counter?></td>
                                    <td><?=$val->new_status_text?></td>
                                    <td><?=$val->updated_by_name?></td>
                                    <td><?=date('d-m-Y h:i A', strtotime($val->updated_on))?></td>
                                </tr>
                                <?php
                                $counter++;
                            endforeach;
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="4">
                                    Baazar Kolkata and Kolkata Baazar are registered trademarks of Baazar Retail Private Limited<br> (Formerly known as Bees Merchandise Private Limited)
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
