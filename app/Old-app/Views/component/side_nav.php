<!-- Sidebar Start -->
<?php         
    $session = session();
    // echo '<pre>',print_r($approved_menu),'</pre>';
    
    if($session->user_level != 1){ // Normal User Level
        
        $module_master_permission = in_array('Master', array_column($approved_menu, 'menu_module'));
        $module_ticket_permission = in_array('Ticket', array_column($approved_menu, 'menu_module'));
        $module_hardware_permission = in_array('Hardware', array_column($approved_menu, 'menu_module'));
        $module_messaging_permission = in_array('Messaging', array_column($approved_menu, 'menu_module'));
        $module_report_permission = in_array('Report', array_column($approved_menu, 'menu_module'));
        $module_change_m_permission = in_array('Change_management', array_column($approved_menu, 'menu_module'));

    } else{

        $module_master_permission = $module_ticket_permission = $module_hardware_permission = $module_messaging_permission = $module_report_permission = $module_change_m_permission = 1;

    }
?>
<div class="sidebar pb-3 open">
    <nav class="navbar">
        <div class="bg-primary text-center w-100 mb-3">
            <a href="<?= base_url('portal/dashboard') ?>" class=""> <!-- navbar-brand -->
                <img src="http://sketchmeglobal.com/demo-baazarkolkata-pms/dist/assets/img/logo.png" style="height:50px" class="d-block mx-auto" />
                <h5 class="text-light"><?=COMPANY_SHORT_NAME?></h5>
            </a>
        </div>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="<?= base_url('assets/img/user.jpg') ?>" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0 text-white"><?=$session->get('username')?></h6>
                <span class="text-light sm small"><?=($session->get('user_level') == 1 ? 'admin' : 'user')?></span>
            </div>
        </div>
        
        <?php
        
        $router = service('router'); 
        $controller  = $router->controllerName();
        $methodName  = $router->methodName();
        $words = explode('\\', $controller);
        $showword = trim($words[count($words) - 1], '\\');

        $dashboard_show_hide = '';
        if($showword == 'DashboardController'){
            $dashboard_show_hide = 'active';
        }

        $dashboard_show_hide = '';
        if($showword == 'UserController'){
            $dashboard_show_hide = 'show active';
        }

        $master_show_hide = '';
        if($showword == 'MasterController'){
            $master_show_hide = 'show active';
        }

        $tickets_show_hide = '';
        if($showword == 'TicketController'){
            $tickets_show_hide = 'show active';
        }

        $hardware_show_hide = '';
        if($showword == 'IssuehardwareC'){
            $hardware_show_hide = 'show active';
        }

        $reports_show_hide = '';
        if($showword == 'ReportController'){
            $reports_show_hide = 'show active';
        }
        
        $intra_message_show_hide = '';
        if($showword == 'MessageController'){
            $intra_message_show_hide = 'active';
        }

        $change_management_show_hide = '';
        if($showword == 'ChangeManagementController'){
            $change_management_show_hide = 'active';
        }
        
        ?>
        
        <div class="navbar-nav w-100">
            <a href="<?= base_url('portal/dashboard') ?>" class="nav-item nav-link <?=$dashboard_show_hide?>"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?=$master_show_hide?>" data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>Users</a>
                <div class="dropdown-menu bg-transparent border-0 <?=$master_show_hide?>">
                    <?php 
                    foreach($approved_menu as $am){
                        if($am->menu_module == "User"){
                            ?>
                            <a href="<?= base_url('portal/user') . '/' . $am->menu_slug?>" class="dropdown-item <?=($showword == 'UserController') ? 'activex' : ''?>"><?=$am->menu_name?></a>
                            <?php
                        }
                    } 
                    ?>    
                </div>                  
            </div>

            <?php
            
                if($module_master_permission){
                    ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?=$master_show_hide?>" data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>Masters</a>
                        <div class="dropdown-menu bg-transparent border-0 <?=$master_show_hide?>">
                            <?php 
                            foreach($approved_menu as $am){
                                if($am->menu_module == "Master"){
                                    ?>
                                    <a href="<?= base_url('portal/master') . '/' . $am->menu_slug?>" class="dropdown-item <?=($showword == 'MasterController') ? 'activex' : ''?>"><?=$am->menu_name?></a>
                                    <?php
                                }
                            } 
                            ?>    
                        </div>                  
                    </div>
                <?php
                }

                if($module_ticket_permission){
                    ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?=$tickets_show_hide?>" data-bs-toggle="dropdown"><i class="fa fa-list me-2"></i>Tickets</a>
                        <div class="dropdown-menu bg-transparent border-0 <?=$tickets_show_hide?>">
                            <?php 
                            foreach($approved_menu as $am){
                                if($am->menu_module == "Ticket"){
                                    ?>
                                    <a href="<?= base_url('portal/ticket') . '/' . $am->menu_slug?>" class="dropdown-item <?=($showword == 'TicketController') ? 'active' : ''?>"><?=$am->menu_name?></a>
                                    <?php
                                }
                            } 
                            ?>    
                        </div>
                    </div>
                <?php
                }

                if($module_hardware_permission){
                ?>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle <?=$hardware_show_hide?>" data-bs-toggle="dropdown"><i class="fa fa-list me-2"></i>Hardware</a>
                    <div class="dropdown-menu bg-transparent border-0 <?=$hardware_show_hide?>">
                        <?php 
                            foreach($approved_menu as $am){
                                if($am->menu_module == "Hardware"){
                                    ?>
                                    <a href="<?= base_url('portal/inventory') . '/' . $am->menu_slug?>" class="dropdown-item <?=($showword == 'InventoryController') ? 'activex' : ''?>"><?=$am->menu_name?></a>
                                    <?php
                                }
                            } 
                        ?> 
                    </div>
                </div>    
                <?php
                }

                if($module_messaging_permission){
                ?>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle <?=$intra_message_show_hide?>" data-bs-toggle="dropdown"><i class="fa fa-list me-2"></i>Intra Message</a>
                    <div class="dropdown-menu bg-transparent border-0 <?=$intra_message_show_hide?>">
                        <?php 
                            foreach($approved_menu as $am){
                                if($am->menu_module == "Messaging"){
                                    ?>
                                    <a href="<?= base_url('portal/message') . '/' . $am->menu_slug?>" class="dropdown-item <?=($showword == 'MessagingController') ? 'activex' : ''?>"><?=$am->menu_name?></a>
                                    <?php
                                }
                            } 
                        ?> 
                    </div>
                </div> 
                <?php 
                }

                if($module_report_permission){
                ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?=$reports_show_hide?>" data-bs-toggle="dropdown"><i class="fa fa-list me-2"></i>Report</a>
                        <div class="dropdown-menu bg-transparent border-0 <?=$reports_show_hide?>">
                            <?php 
                                foreach($approved_menu as $am){
                                    if($am->menu_module == "Report"){
                                        ?>
                                        <a href="<?= base_url('portal/report') . '/' . $am->menu_slug?>" class="dropdown-item <?=($showword == 'ReportController') ? 'activex' : ''?>"><?=$am->menu_name?></a>
                                        <?php
                                    }
                                } 
                            ?> 
                        </div>
                    </div>
                <?php
                }

                if($module_change_m_permission){
                ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?=$change_management_show_hide?>" data-bs-toggle="dropdown"><i class="fa fa-list me-2"></i>Change Management</a>
                        <div class="dropdown-menu bg-transparent border-0 <?=$change_management_show_hide?>">
                            <?php 
                                foreach($approved_menu as $am){
                                    isset($am->user_id) ? ($user_id = $am->user_id) : ($user_id  = '');
                                    if($session->user_level != 1){

                                        if($am->menu_module == "Change_management" and $user_id == $session->id){
                                            ?>
                                            <a href="<?= base_url('portal/change-management') . '/' . $am->menu_slug?>" class="dropdown-item <?=($showword == 'ChangeManagementController') ? 'activex' : ''?>"><?=$am->menu_name?></a>
                                            <?php
                                        }

                                    } else{

                                        if($am->menu_module == "Change_management"){
                                            ?>
                                            <a href="<?= base_url('portal/change-management') . '/' . $am->menu_slug?>" class="dropdown-item <?=($showword == 'ChangeManagementController') ? 'activex' : ''?>"><?=$am->menu_name?></a>
                                            <?php
                                        }

                                    }
                                    
                                } 
                            ?> 
                        </div>
                    </div>
                <?php
                }

            ?>
        </div>
    </nav>
</div>
<!-- Sidebar End -->