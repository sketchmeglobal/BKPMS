<!-- Sidebar Start -->
<?php         
    $session = session();
    // echo '<pre>',print_r($approved_menu),'</pre>';
    
    foreach($approved_menu as $key=>$am){
        if($am->show_on_left_nav == 0){
            unset($approved_menu[$key]);
        }
    }

    if($session->user_level != 1){ // Normal User Level
        
        $module_master_permission = in_array('Master', array_column($approved_menu, 'menu_module'));
        $module_user_permission = in_array('User', array_column($approved_menu, 'menu_module'));
        $module_ticket_permission = in_array('Ticket', array_column($approved_menu, 'menu_module'));
        $module_hardware_permission = in_array('Hardware', array_column($approved_menu, 'menu_module'));
        $module_messaging_permission = in_array('Messaging', array_column($approved_menu, 'menu_module'));
        $module_report_permission = in_array('Report', array_column($approved_menu, 'menu_module'));
        $module_cm_permission = in_array('Change_management', array_column($approved_menu, 'menu_module'));

    } else{

        $module_master_permission = $module_user_permission = $module_ticket_permission = $module_hardware_permission = $module_messaging_permission = $module_report_permission = $module_cm_permission = 1;

    }
?>

<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Menu Management</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('portal/dashboard') ?>" aria-expanded="false">
                        <i class="mdi mdi-directions"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <?php if($module_user_permission){ ?>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-account-switch"></i>
                        <span class="hide-menu">User Management</span>
                        <!-- <span class="badge badge-pill badge-info ml-auto m-r-15">3</span> -->
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <?php 
                        foreach($approved_menu as $am){
                            if($am->menu_module == "User"){
                                ?>
                                <li class="sidebar-item">
                                    <a href="<?= base_url('portal/user') . '/' . $am->menu_slug?>" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> <?=$am->menu_name?> </span>
                                    </a>
                                </li>
                                <?php
                            }
                        } 
                        ?>   
                    </ul>
                </li>
                <?php } ?> 

                <?php if($module_master_permission){ ?>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-database-plus"></i>
                        <span class="hide-menu">Master Data Management</span>
                        <!-- <span class="badge badge-pill badge-info ml-auto m-r-15">3</span> -->
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <?php 
                        foreach($approved_menu as $am){
                            if($am->menu_module == "Master"){
                                ?>
                                <li class="sidebar-item">
                                    <a href="<?= base_url('portal/master') . '/' . $am->menu_slug?>" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> <?=$am->menu_name?> </span>
                                    </a>
                                </li>
                                <?php
                            }
                        } 
                        ?>   
                    </ul>
                </li>
                <?php } ?>
                
                <?php if($module_ticket_permission){ ?>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-ticket"></i>
                        <span class="hide-menu">Ticket Management</span>
                        <!-- <span class="badge badge-pill badge-info ml-auto m-r-15">3</span> -->
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <?php 
                        foreach($approved_menu as $am){
                            if($am->menu_module == "Ticket"){
                                ?>
                                <li class="sidebar-item">
                                    <a href="<?= base_url('portal/ticket') . '/' . $am->menu_slug?>" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> <?=$am->menu_name?> </span>
                                    </a>
                                </li>
                                <?php
                            }
                        } 
                        ?>   
                    </ul>
                </li>
                <?php } ?>

                <?php if($module_hardware_permission){ ?>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-transit-transfer"></i>
                        <span class="hide-menu">inventory Management</span>
                        <!-- <span class="badge badge-pill badge-info ml-auto m-r-15">3</span> -->
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <?php 
                        foreach($approved_menu as $am){
                            if($am->menu_module == "Hardware"){
                                ?>
                                <li class="sidebar-item">
                                    <a href="<?= base_url('portal/inventory') . '/' . $am->menu_slug?>" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> <?=$am->menu_name?> </span>
                                    </a>
                                </li>
                                <?php
                            }
                        } 
                        ?>   
                    </ul>
                </li>
                <?php } ?>

                <?php if($module_messaging_permission){ ?>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-message-text"></i>
                        <span class="hide-menu">Message Management</span>
                        <!-- <span class="badge badge-pill badge-info ml-auto m-r-15">3</span> -->
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <?php 
                        foreach($approved_menu as $am){
                            if($am->menu_module == "Messaging"){
                                ?>
                                <li class="sidebar-item">
                                    <a href="<?= base_url('portal/message') . '/' . $am->menu_slug?>" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> <?=$am->menu_name?> </span>
                                    </a>
                                </li>
                                <?php
                            }
                        } 
                        ?>   
                    </ul>
                </li>
                <?php } ?>

                <?php if($module_report_permission){ ?>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-file-document"></i>
                        <span class="hide-menu">Report Management</span>
                        <!-- <span class="badge badge-pill badge-info ml-auto m-r-15">3</span> -->
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <?php 
                        foreach($approved_menu as $am){
                            if($am->menu_module == "Report"){
                                ?>
                                <li class="sidebar-item">
                                    <a href="<?= base_url('portal/report') . '/' . $am->menu_slug?>" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> <?=$am->menu_name?> </span>
                                    </a>
                                </li>
                                <?php
                            }
                        } 
                        ?>   
                    </ul>
                </li>
                <?php } ?>

                <?php if($module_cm_permission){ ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-lumx"></i>
                            <span class="hide-menu">Change Management</span>
                            <!-- <span class="badge badge-pill badge-info ml-auto m-r-15">3</span> -->
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <?php 
                            foreach($approved_menu as $am){
                                isset($am->user_id) ? ($user_id = $am->user_id) : ($user_id  = '');
                                if($session->user_level != 1){

                                    if($am->menu_module == "Change_management" and $user_id == $session->id){
                                        ?>
                                        <li class="sidebar-item">
                                            <a href="<?= base_url('portal/change-management') . '/' . $am->menu_slug?>" class="sidebar-link">
                                                <i class="mdi mdi-adjust"></i>
                                                <span class="hide-menu"> <?=$am->menu_name?> </span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                } else{

                                    if($am->menu_module == "Change_management"){
                                        ?>
                                        <li class="sidebar-item">
                                            <a href="<?= base_url('portal/change-management') . '/' . $am->menu_slug?>" class="sidebar-link">
                                                <i class="mdi mdi-adjust"></i>
                                                <span class="hide-menu"> <?=$am->menu_name?> </span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                }
                                
                            } 
                            ?>   
                        </ul>
                    </li>
                <?php } ?>

                <hr class="border-primary border-1">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('logout')?>" aria-expanded="false">
                        <i class="mdi mdi-directions"></i>
                        <span class="hide-menu">Log Out</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- Sidebar End -->