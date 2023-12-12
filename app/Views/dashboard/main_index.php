<?= view('component/main_header') ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <style>
        .card{border-left: 4px solid #f7f7f7;}
        label{color:#000}
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
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?=base_url('portal/dashboard')?>">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
            
                <div class="row">

                    <div class="card col-12">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-6 border card">
                                    <h4 class="bg-light p-1">Group Message</h4>
                                    <div class="row demo5">
                                        <ul class="list-unstyled card-body">
                                            <li class="media border-bottom py-2 my-2">
                                                <img class="d-flex m-r-15" src="https://cdn.icon-icons.com/icons2/3719/PNG/512/communication_info_data_learning_book_information_icon_230354.png" width="60" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="mt-0 mb-1">List-based media object</h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                                </div>
                                            </li>
                                            <li class="media border-bottom py-2 my-2">
                                                <img class="d-flex m-r-15" src="https://cdn.icon-icons.com/icons2/3719/PNG/512/communication_info_data_learning_book_information_icon_230354.png" width="60" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="mt-0 mb-1">List-based media object</h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                                </div>
                                            </li>
                                            <li class="media border-bottom py-2 my-2">
                                                <img class="d-flex m-r-15" src="https://cdn.icon-icons.com/icons2/3719/PNG/512/communication_info_data_learning_book_information_icon_230354.png" width="60" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="mt-0 mb-1">List-based media object</h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="row bg-light text-center">
                                        <a href="#" class="col-4 p-0 text-warning list-group-item btnUp" style="font-size: 25px;"><i class="mdi mdi-arrow-up-bold-circle-outline"></i></a>
                                        <a href="#" class="col-4 p-0 text-warning list-group-item btnUp" style="font-size: 25px;"><i class="mdi mdi-arrow-down-bold-circle-outline"></i></a>
                                        <a href="#" class="col-4 p-0 text-warning list-group-item btnToggle" style="font-size: 25px;"><i class="mdi mdi-play"></i></a>
                                    </div>        
                                </div>
                                <div class="col-lg-6 border card">
                                    <h4 class="bg-light p-1">Your Message</h4>
                                    <div class="row demo5">
                                        <ul class="list-unstyled card-body">
                                            <li class="media border-bottom py-2 my-2">
                                                <img class="d-flex m-r-15" src="https://cdn.icon-icons.com/icons2/3719/PNG/512/communication_info_data_learning_book_information_icon_230354.png" width="60" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="mt-0 mb-1">List-based media object</h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                                </div>
                                            </li>
                                            <li class="media border-bottom py-2 my-2">
                                                <img class="d-flex m-r-15" src="https://cdn.icon-icons.com/icons2/3719/PNG/512/communication_info_data_learning_book_information_icon_230354.png" width="60" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="mt-0 mb-1">List-based media object</h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                                </div>
                                            </li>
                                            <li class="media border-bottom py-2 my-2">
                                                <img class="d-flex m-r-15" src="https://cdn.icon-icons.com/icons2/3719/PNG/512/communication_info_data_learning_book_information_icon_230354.png" width="60" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="mt-0 mb-1">List-based media object</h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="row bg-light text-center">
                                        <a href="#" class="col-4 p-0 text-warning list-group-item btnUp" style="font-size: 25px;"><i class="mdi mdi-arrow-up-bold-circle-outline"></i></a>
                                        <a href="#" class="col-4 p-0 text-warning list-group-item btnUp" style="font-size: 25px;"><i class="mdi mdi-arrow-down-bold-circle-outline"></i></a>
                                        <a href="#" class="col-4 p-0 text-warning list-group-item btnToggle" style="font-size: 25px;"><i class="mdi mdi-play"></i></a>
                                    </div>        
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card border">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-7">
                                        <i class="mdi mdi-emoticon font-20 text-info"></i>
                                        <p class="font-16 m-b-5">New Clients</p>
                                    </div>
                                    <div class="col-5">
                                        <h1 class="font-light text-right mb-0">23</h1>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card border">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-7">
                                        <i class="mdi mdi-image font-20 text-success"></i>
                                        <p class="font-16 m-b-5">New Projects</p>
                                    </div>
                                    <div class="col-5">
                                        <h1 class="font-light text-right mb-0">169</h1>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card border">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-7">
                                        <i class="mdi mdi-currency-eur font-20 text-purple"></i>
                                        <p class="font-16 m-b-5">New Invoices</p>
                                    </div>
                                    <div class="col-5">
                                        <h1 class="font-light text-right mb-0">157</h1>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card border">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-7">
                                        <i class="mdi mdi-poll font-20 text-danger"></i>
                                        <p class="font-16 m-b-5">New Sales</p>
                                    </div>
                                    <div class="col-5">
                                        <h1 class="font-light text-right mb-0">236</h1>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12 col-lg-4">
                        <div class="card border">
                            <div class="card-body">
                                <h4 class="card-title">Ticket Status</h4>
                                <div class="status m-t-30 c3" style="height: 280px; width: 100%; max-height: 280px; position: relative;"><svg style="overflow: hidden;" width="299.6499938964844" height="280"><defs><clipPath id="c3-1702130291606-clip"><rect width="299.6499938964844" height="256"></rect></clipPath><clipPath id="c3-1702130291606-clip-xaxis"><rect x="-31" y="-20" width="361.6499938964844" height="40"></rect></clipPath><clipPath id="c3-1702130291606-clip-yaxis"><rect x="-29" y="-4" width="20" height="280"></rect></clipPath><clipPath id="c3-1702130291606-clip-grid"><rect width="299.6499938964844" height="256"></rect></clipPath><clipPath id="c3-1702130291606-clip-subchart"><rect width="299.6499938964844"></rect></clipPath></defs><g transform="translate(0.5,4.5)"><text class="c3-text c3-empty" text-anchor="middle" dominant-baseline="middle" x="149.8249969482422" y="128" style="opacity: 0;"></text><rect class="c3-zoom-rect" width="299.6499938964844" height="256" style="opacity: 0;"></rect><g clip-path="url(file:///C:/Users/SMG/Downloads/Nice-Admin-master/Nice-Admin-master/html/ltr/index3.html#c3-1702130291606-clip)" class="c3-regions" style="visibility: hidden;"></g><g clip-path="url(file:///C:/Users/SMG/Downloads/Nice-Admin-master/Nice-Admin-master/html/ltr/index3.html#c3-1702130291606-clip-grid)" class="c3-grid" style="visibility: hidden;"><g class="c3-xgrid-focus"><line class="c3-xgrid-focus" x1="-10" x2="-10" y1="0" y2="256" style="visibility: hidden;"></line></g></g><g clip-path="url(file:///C:/Users/SMG/Downloads/Nice-Admin-master/Nice-Admin-master/html/ltr/index3.html#c3-1702130291606-clip)" class="c3-chart"><g class="c3-event-rects c3-event-rects-single" style="fill-opacity: 0;"><rect class=" c3-event-rect c3-event-rect-0" x="0.1750030517578125" y="0" width="299.6499938964844" height="256"></rect></g><g class="c3-chart-bars"><g class="c3-chart-bar c3-target c3-target-Pending" style="pointer-events: none;"><g class=" c3-shapes c3-shapes-Pending c3-bars c3-bars-Pending" style="cursor: pointer;"></g></g><g class="c3-chart-bar c3-target c3-target-Failed" style="pointer-events: none;"><g class=" c3-shapes c3-shapes-Failed c3-bars c3-bars-Failed" style="cursor: pointer;"></g></g><g class="c3-chart-bar c3-target c3-target-Success" style="pointer-events: none;"><g class=" c3-shapes c3-shapes-Success c3-bars c3-bars-Success" style="cursor: pointer;"></g></g></g><g class="c3-chart-lines"><g class="c3-chart-line c3-target c3-target-Pending" style="opacity: 1; pointer-events: none;"><g class=" c3-shapes c3-shapes-Pending c3-lines c3-lines-Pending"></g><g class=" c3-shapes c3-shapes-Pending c3-areas c3-areas-Pending"></g><g class=" c3-selected-circles c3-selected-circles-Pending"></g><g class=" c3-shapes c3-shapes-Pending c3-circles c3-circles-Pending" style="cursor: pointer;"></g></g><g class="c3-chart-line c3-target c3-target-Failed" style="opacity: 1; pointer-events: none;"><g class=" c3-shapes c3-shapes-Failed c3-lines c3-lines-Failed"></g><g class=" c3-shapes c3-shapes-Failed c3-areas c3-areas-Failed"></g><g class=" c3-selected-circles c3-selected-circles-Failed"></g><g class=" c3-shapes c3-shapes-Failed c3-circles c3-circles-Failed" style="cursor: pointer;"></g></g><g class="c3-chart-line c3-target c3-target-Success" style="opacity: 1; pointer-events: none;"><g class=" c3-shapes c3-shapes-Success c3-lines c3-lines-Success"></g><g class=" c3-shapes c3-shapes-Success c3-areas c3-areas-Success"></g><g class=" c3-selected-circles c3-selected-circles-Success"></g><g class=" c3-shapes c3-shapes-Success c3-circles c3-circles-Success" style="cursor: pointer;"></g></g></g><g class="c3-chart-arcs" transform="translate(149.8249969482422,123)"><text class="c3-chart-arcs-title" style="text-anchor: middle; opacity: 1;">Status</text><g class="c3-chart-arc c3-target c3-target-Pending"><g class=" c3-shapes c3-shapes-Pending c3-arcs c3-arcs-Pending"><path class=" c3-shape c3-shape c3-arc c3-arc-Pending" style="fill: rgb(19, 126, 255); cursor: pointer;" transform="" d="M7.154998924018411e-15,-116.85A116.85,116.85 0 1,1 -99.68873168216227,60.95965285007662L-69.82903455870759,42.700450028059656A81.85,81.85 0 1,0 5.0118670255105426e-15,-81.85Z"></path></g><text dy=".35em" style="opacity: 1; text-anchor: middle; pointer-events: none;" class="" transform="translate(81.53930671381788,45.714897578688)"></text></g><g class="c3-chart-arc c3-target c3-target-Failed"><g class=" c3-shapes c3-shapes-Failed c3-arcs c3-arcs-Failed"><path class=" c3-shape c3-shape c3-arc c3-arc-Failed" style="fill: rgb(90, 193, 70); cursor: pointer;" transform="" d="M-80.24689071529764,-84.93738299787131A116.85,116.85 0 0,1 -2.146499677205523e-14,-116.85L-1.5035601076531626e-14,-81.85A81.85,81.85 0 0,0 -56.21059482282509,-59.49614718336129Z"></path></g><text dy=".35em" style="opacity: 1; text-anchor: middle; pointer-events: none;" class="" transform="translate(-34.54383555634198,-86.86330540024599)"></text></g><g class="c3-chart-arc c3-target c3-target-Success"><g class=" c3-shapes c3-shapes-Success c3-arcs c3-arcs-Success"><path class=" c3-shape c3-shape c3-arc c3-arc-Success" style="fill: rgb(139, 94, 221); cursor: pointer;" transform="" d="M-99.68873168216227,60.95965285007662A116.85,116.85 0 0,1 -80.24689071529764,-84.93738299787131L-56.21059482282509,-59.49614718336129A81.85,81.85 0 0,0 -69.82903455870759,42.700450028059656Z"></path></g><text dy=".35em" style="opacity: 1; text-anchor: middle; pointer-events: none;" class="" transform="translate(-92.6609072062463,-12.34773970066635)"></text></g></g><g class="c3-chart-texts"><g class="c3-chart-text c3-target c3-target-Pending" style="opacity: 1; pointer-events: none;"><g class=" c3-texts c3-texts-Pending"></g></g><g class="c3-chart-text c3-target c3-target-Failed" style="opacity: 1; pointer-events: none;"><g class=" c3-texts c3-texts-Failed"></g></g><g class="c3-chart-text c3-target c3-target-Success" style="opacity: 1; pointer-events: none;"><g class=" c3-texts c3-texts-Success"></g></g></g></g><g clip-path="url(file:///C:/Users/SMG/Downloads/Nice-Admin-master/Nice-Admin-master/html/ltr/index3.html#c3-1702130291606-clip-grid)" class="c3-grid c3-grid-lines"><g class="c3-xgrid-lines"></g><g class="c3-ygrid-lines"></g></g><g class="c3-axis c3-axis-x" clip-path="url(file:///C:/Users/SMG/Downloads/Nice-Admin-master/Nice-Admin-master/html/ltr/index3.html#c3-1702130291606-clip-xaxis)" transform="translate(0,256)" style="visibility: visible; opacity: 0;"><text class="c3-axis-x-label" transform="" style="text-anchor: end;" x="299.6499938964844" dx="-0.5em" dy="-0.5em"></text><g class="tick" style="opacity: 1;" transform="translate(150, 0)"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">0</tspan></text></g><path class="domain" d="M0,6V0H299.6499938964844V6"></path></g><g class="c3-axis c3-axis-y" clip-path="url(file:///C:/Users/SMG/Downloads/Nice-Admin-master/Nice-Admin-master/html/ltr/index3.html#c3-1702130291606-clip-yaxis)" transform="translate(0,0)" style="visibility: visible; opacity: 0;"><text class="c3-axis-y-label" transform="rotate(-90)" style="text-anchor: end;" x="0" dx="-0.5em" dy="1.2em"></text><g class="tick" style="opacity: 1;" transform="translate(0,235)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">10</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,212)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">15</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,188)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">20</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,164)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">25</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,141)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">30</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,117)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">35</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,94)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">40</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,70)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">45</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,46)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">50</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,23)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">55</tspan></text></g><path class="domain" d="M-6,1H0V256H-6"></path></g><g class="c3-axis c3-axis-y2" transform="translate(299.6499938964844,0)" style="visibility: hidden; opacity: 0;"><text class="c3-axis-y2-label" transform="rotate(-90)" style="text-anchor: end;" x="0" dx="-0.5em" dy="-0.5em"></text><g class="tick" style="opacity: 1;" transform="translate(0,256)"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,231)"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.1</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,205)"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.2</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,180)"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.3</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,154)"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.4</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,129)"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.5</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,103)"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.6</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,78)"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.7</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,52)"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.8</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,27)"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.9</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,1)"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">1</tspan></text></g><path class="domain" d="M6,1H0V256H6"></path></g></g><g transform="translate(0.5,280.5)" style="visibility: hidden;"><g clip-path="url(file:///C:/Users/SMG/Downloads/Nice-Admin-master/Nice-Admin-master/html/ltr/index3.html#c3-1702130291606-clip-subchart)" class="c3-chart"><g class="c3-chart-bars"></g><g class="c3-chart-lines"></g></g><g clip-path="url(file:///C:/Users/SMG/Downloads/Nice-Admin-master/Nice-Admin-master/html/ltr/index3.html#c3-1702130291606-clip)" class="c3-brush" style="pointer-events: all;"><rect class="background" style="visibility: hidden; cursor: crosshair;" x="0" width="299.6499938964844"></rect><rect class="extent" style="cursor: move;" x="0" width="0"></rect><g class="resize e" style="cursor: ew-resize; display: none;" transform="translate(0,0)"><rect x="-3" width="6" height="6" style="visibility: hidden;"></rect></g><g class="resize w" style="cursor: ew-resize; display: none;" transform="translate(0,0)"><rect x="-3" width="6" height="6" style="visibility: hidden;"></rect></g></g><g class="c3-axis-x" transform="translate(0,0)" clip-path="url(file:///C:/Users/SMG/Downloads/Nice-Admin-master/Nice-Admin-master/html/ltr/index3.html#c3-1702130291606-clip-xaxis)" style="visibility: hidden; opacity: 0;"><g class="tick" style="opacity: 1;" transform="translate(150, 0)"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">0</tspan></text></g><path class="domain" d="M0,6V0H299.6499938964844V6"></path></g></g><g transform="translate(0,260)"><g class="c3-legend-item c3-legend-item-Pending" style="visibility: hidden; cursor: pointer; opacity: 1;"><text style="pointer-events: none;" x="14" y="9">Pending</text><rect class="c3-legend-item-event" style="fill-opacity: 0;" x="0" y="-5" width="0" height="0"></rect><line class="c3-legend-item-tile" style="stroke: rgb(19, 126, 255); pointer-events: none;" x1="-2" y1="4" x2="8" y2="4" stroke-width="10"></line></g><g class="c3-legend-item c3-legend-item-Failed" style="visibility: hidden; cursor: pointer; opacity: 1;"><text style="pointer-events: none;" x="14" y="9">Failed</text><rect class="c3-legend-item-event" style="fill-opacity: 0;" x="0" y="-5" width="0" height="0"></rect><line class="c3-legend-item-tile" style="stroke: rgb(90, 193, 70); pointer-events: none;" x1="-2" y1="4" x2="8" y2="4" stroke-width="10"></line></g><g class="c3-legend-item c3-legend-item-Success" style="visibility: hidden; cursor: pointer; opacity: 1;"><text style="pointer-events: none;" x="14" y="9">Success</text><rect class="c3-legend-item-event" style="fill-opacity: 0;" x="0" y="-5" width="0" height="0"></rect><line class="c3-legend-item-tile" style="stroke: rgb(139, 94, 221); pointer-events: none;" x1="-2" y1="4" x2="8" y2="4" stroke-width="10"></line></g></g><text class="c3-title" x="149.8249969482422" y="0"></text></svg><div class="c3-tooltip-container" style="position: absolute; pointer-events: none; display: none; top: 89.4px; left: 254.5px;"><table class="c3-tooltip"><tbody><tr class="c3-tooltip-name--Pending"><td class="name"><span style="background-color:#137eff"></span>Pending</td><td class="value">66.3%</td></tr></tbody></table></div></div>
                            
                                <div class="row">
                                    <div class="col-4 border-right">
                                        <i class="fa fa-circle text-primary"></i>
                                        <h4 class="mb-0 font-medium">5489</h4>
                                        <span>Success</span>
                                    </div>
                                    <div class="col-4 border-right p-l-20">
                                        <i class="fa fa-circle text-info"></i>
                                        <h4 class="mb-0 font-medium">954</h4>
                                        <span>Pending</span>
                                    </div>
                                    <div class="col-4 p-l-20">
                                        <i class="fa fa-circle text-success"></i>
                                        <h4 class="mb-0 font-medium">736</h4>
                                        <span>Failed</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-8">
                        <div class="card border">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Yearly Comparison</h4>
                                    </div>
                                    <div class="ml-auto">
                                        <div class="dl m-b-10">
                                            <select class="custom-select border-0 text-muted">
                                                <option value="0" selected="">2018</option>
                                                <option value="1">2015</option>
                                                <option value="2">2016</option>
                                                <option value="3">2017</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="chart1 m-t-40" style="position: relative; height:250px;"><div class="chartist-tooltip" style="top: 51.5px; left: 17.35px;"></div><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-bar" style="width: 100%; height: 100%;"><g class="ct-grids"><line y1="215" y2="215" x1="40" x2="644.3333740234375" class="ct-grid ct-vertical"></line><line y1="115" y2="115" x1="40" x2="644.3333740234375" class="ct-grid ct-vertical"></line><line y1="15" y2="15" x1="40" x2="644.3333740234375" class="ct-grid ct-vertical"></line></g><g><g class="ct-series ct-series-a"><line x1="65.18055725097656" x2="65.18055725097656" y1="215" y2="165" class="ct-bar" ct:value="5" style="stroke-width: 25px"></line><line x1="115.54167175292969" x2="115.54167175292969" y1="215" y2="175" class="ct-bar" ct:value="4" style="stroke-width: 25px"></line><line x1="165.9027862548828" x2="165.9027862548828" y1="215" y2="165" class="ct-bar" ct:value="5" style="stroke-width: 25px"></line><line x1="216.26390075683594" x2="216.26390075683594" y1="215" y2="185" class="ct-bar" ct:value="3" style="stroke-width: 25px"></line><line x1="266.62501525878906" x2="266.62501525878906" y1="215" y2="95" class="ct-bar" ct:value="12" style="stroke-width: 25px"></line><line x1="316.9861297607422" x2="316.9861297607422" y1="215" y2="175" class="ct-bar" ct:value="4" style="stroke-width: 25px"></line><line x1="367.3472442626953" x2="367.3472442626953" y1="215" y2="65" class="ct-bar" ct:value="15" style="stroke-width: 25px"></line><line x1="417.70835876464844" x2="417.70835876464844" y1="215" y2="135" class="ct-bar" ct:value="8" style="stroke-width: 25px"></line><line x1="468.06947326660156" x2="468.06947326660156" y1="215" y2="115" class="ct-bar" ct:value="10" style="stroke-width: 25px"></line><line x1="518.4305877685547" x2="518.4305877685547" y1="215" y2="135" class="ct-bar" ct:value="8" style="stroke-width: 25px"></line><line x1="568.7917022705078" x2="568.7917022705078" y1="215" y2="145" class="ct-bar" ct:value="7" style="stroke-width: 25px"></line><line x1="619.1528167724609" x2="619.1528167724609" y1="215" y2="165" class="ct-bar" ct:value="5" style="stroke-width: 25px"></line></g><g class="ct-series ct-series-b"><line x1="65.18055725097656" x2="65.18055725097656" y1="165" y2="125" class="ct-bar" ct:value="4" style="stroke-width: 25px"></line><line x1="115.54167175292969" x2="115.54167175292969" y1="175" y2="75" class="ct-bar" ct:value="10" style="stroke-width: 25px"></line><line x1="165.9027862548828" x2="165.9027862548828" y1="165" y2="115" class="ct-bar" ct:value="5" style="stroke-width: 25px"></line><line x1="216.26390075683594" x2="216.26390075683594" y1="185" y2="145" class="ct-bar" ct:value="4" style="stroke-width: 25px"></line><line x1="266.62501525878906" x2="266.62501525878906" y1="95" y2="15" class="ct-bar" ct:value="8" style="stroke-width: 25px"></line><line x1="316.9861297607422" x2="316.9861297607422" y1="175" y2="145" class="ct-bar" ct:value="3" style="stroke-width: 25px"></line><line x1="367.3472442626953" x2="367.3472442626953" y1="65" y2="35" class="ct-bar" ct:value="3" style="stroke-width: 25px"></line><line x1="417.70835876464844" x2="417.70835876464844" y1="135" y2="95" class="ct-bar" ct:value="4" style="stroke-width: 25px"></line><line x1="468.06947326660156" x2="468.06947326660156" y1="115" y2="25" class="ct-bar" ct:value="9" style="stroke-width: 25px"></line><line x1="518.4305877685547" x2="518.4305877685547" y1="135" y2="65" class="ct-bar" ct:value="7" style="stroke-width: 25px"></line><line x1="568.7917022705078" x2="568.7917022705078" y1="145" y2="45" class="ct-bar" ct:value="10" style="stroke-width: 25px"></line><line x1="619.1528167724609" x2="619.1528167724609" y1="165" y2="125" class="ct-bar" ct:value="4" style="stroke-width: 25px"></line></g></g><g class="ct-labels"><foreignObject style="overflow: visible;" x="40" y="220" width="50.361114501953125" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 50px; height: 20px;">Jan</span></foreignObject><foreignObject style="overflow: visible;" x="90.36111450195312" y="220" width="50.361114501953125" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 50px; height: 20px;">Feb</span></foreignObject><foreignObject style="overflow: visible;" x="140.72222900390625" y="220" width="50.361114501953125" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 50px; height: 20px;">Mar</span></foreignObject><foreignObject style="overflow: visible;" x="191.08334350585938" y="220" width="50.361114501953125" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 50px; height: 20px;">Apr</span></foreignObject><foreignObject style="overflow: visible;" x="241.4444580078125" y="220" width="50.361114501953125" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 50px; height: 20px;">May</span></foreignObject><foreignObject style="overflow: visible;" x="291.8055725097656" y="220" width="50.361114501953125" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 50px; height: 20px;">Jun</span></foreignObject><foreignObject style="overflow: visible;" x="342.16668701171875" y="220" width="50.361114501953125" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 50px; height: 20px;">Jul</span></foreignObject><foreignObject style="overflow: visible;" x="392.5278015136719" y="220" width="50.361114501953125" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 50px; height: 20px;">Aug</span></foreignObject><foreignObject style="overflow: visible;" x="442.888916015625" y="220" width="50.361114501953125" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 50px; height: 20px;">Sep</span></foreignObject><foreignObject style="overflow: visible;" x="493.2500305175781" y="220" width="50.361114501953125" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 50px; height: 20px;">Oct</span></foreignObject><foreignObject style="overflow: visible;" x="543.6111450195312" y="220" width="50.361114501953125" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 50px; height: 20px;">Nov</span></foreignObject><foreignObject style="overflow: visible;" x="593.9722595214844" y="220" width="50.361114501953125" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 50px; height: 20px;">Dec</span></foreignObject><foreignObject style="overflow: visible;" y="115" x="0" height="100" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 100px; width: 30px;">0k</span></foreignObject><foreignObject style="overflow: visible;" y="15" x="0" height="100" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 100px; width: 30px;">10k</span></foreignObject><foreignObject style="overflow: visible;" y="-15" x="0" height="30" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 30px; width: 30px;">20k</span></foreignObject></g></svg></div>
                                <ul class="list-inline m-t-30 text-center font-12">
                                    <li class="list-inline-item text-muted"><i class="fa fa-circle text-info m-r-5"></i> This Year</li>
                                    <li class="list-inline-item text-muted"><i class="fa fa-circle text-light m-r-5"></i> Last Year</li>
                                </ul>
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
    <script src="https://www.jqueryscript.net/demo/Flexible-Customizable-jQuery-News-Ticker-Plugin-Easy-Ticker/jquery.easy-ticker.js"></script>
    <script>
        $('.demo5').easyTicker({
            direction: 'up',
            visible: 3,
            interval: 2500,
            controls: {
                up: '.btnUp',
                down: '.btnDown',
                toggle: '.btnToggle'
            }
        });
    </script>
</body>

</html>