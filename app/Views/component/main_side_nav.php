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

    } else{

        $module_master_permission = $module_user_permission = 1;

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