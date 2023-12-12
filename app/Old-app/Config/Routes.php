<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->match(['get', 'post'], '/', 'AuthController::index');
$routes->match(['get', 'post'], 'login', 'AuthController::index');
$routes->match(['get', 'post'], 'logout', 'AuthController::logout');

/*logout*/
//$routes->match(['get', 'post'], '/logout', 'AuthController::logout'); 
// $routes->match(['get', 'post'], '/do_login', 'AuthController::do_login');

// $routes->match(['get', 'post'], '/auth', 'DashboardC::index');
//$routes->match(['get', 'post'], '/all-tickets', 'DashboardC::all_tickets');

$routes->group('portal', static function ($routes) {
    
    $routes->match(['get', 'post'], 'dashboard', 'DashboardController::index');
    
    $routes->group('master', static function ($routes) {
        $routes->match(['get', 'post'], '(:any)', 'MasterController::index/$1');
    });

    $routes->group('user', static function ($routes) {
        $routes->match(['get', 'post'], 'user-list', 'UserController::user_list');
        $routes->match(['get', 'post'], 'user-list/(:any)', 'UserController::user_list');
        $routes->match(['get', 'post'], 'user-list/(:any)/(:any)', 'UserController::user_list');
        
        $routes->match(['get', 'post'], 'user-permission', 'UserController::user_permission');
        $routes->match(['get', 'post'], 'user-permission(:any)', 'UserController::user_permission');
        $routes->match(['get', 'post'], 'user-permission/(:any)/(:any)', 'UserController::user_permission');
    });

    $routes->group('ticket', static function ($routes) {

        $routes->match(['get', 'post'], 'all-ticket', 'TicketController::all_ticket');
        $routes->match(['get', 'post'], 'my-ticket', 'TicketController::my_ticket');
        $routes->match(['get', 'post'], 'new-ticket', 'TicketController::new_ticket');
        $routes->match(['get', 'post'], 'view-ticket/(:num)', 'TicketController::view_ticket/$1');

        // ajax
        $routes->post('ajax_fetch_topic_category', 'TicketController::ajax_fetch_topic_category');
        $routes->post('ajax_fetch_solutions', 'TicketController::ajax_fetch_solutions');
        $routes->post('new-ticket-validation', 'TicketController::new_ticket_validation');
        $routes->post('view-ticket-validation', 'TicketController::view_ticket_validation');
        $routes->post('accept-ticket', 'TicketController::accept_ticket');        

    });

    $routes->group('message', static function ($routes) {
        // //Intranet Messaging
        $routes->match(['get', 'post'], 'intranet-messaging', 'MessageController::intranet_messaging');

        $routes->match(['get', 'post'], 'group-messaging', 'MessageController::group_messaging');
        $routes->match(['get', 'post'], 'group-messaging/(:any)', 'MessageController::group_messaging');
        $routes->match(['get', 'post'], 'group-messaging/(:any)/(:any)', 'MessageController::group_messaging');

        // ajax
        $routes->post('ajax-form-validation-messaging', 'MessageController::ajax_form_validation_messaging');
        $routes->post('ajax-remove-table-data', 'MessageController::ajax_remove_table_data');
    });

    $routes->group('change-management', static function ($routes) {

        $routes->match(['get', 'post'], 'cm-list', 'ChangeManagementController::cm_list');
        // $routes->match(['get', 'post'], 'add-cm-list', 'ChangeManagementController::add_cm_list');
        $routes->match(['get', 'post'], 'edit-cm-list/(:any)', 'ChangeManagementController::edit_cm_list/$1');

        $routes->post('ajax-remove-cm-list', 'ChangeManagementController::ajax_remove_cm_list');
        $routes->post('ajax-remove-cm-activity-list', 'ChangeManagementController::ajax_remove_cm_activity_list');
        $routes->post('ajax-remove-cm-stakeholder-list', 'ChangeManagementController::ajax_remove_cm_stakeholder_list');
        $routes->post('ajax-remove-cm-risk-list', 'ChangeManagementController::ajax_remove_cm_risk_list');
        $routes->post('ajax-remove-cm-technology-list', 'ChangeManagementController::ajax_remove_cm_technology_list');
        $routes->post('ajax-remove-cm-cost-list', 'ChangeManagementController::ajax_remove_cm_cost_list');

    });
    
    // //Category Solution
    // $routes->match(['get', 'post'], 'solutions', 'Master\SolutionsC::index');

    
    // //Issue Hardware
    // $routes->match(['get', 'post'], 'issue-return-hardware', 'IssuehardwareC::index');
    // $routes->match(['get', 'post'], 'check-ticket-status', 'IssuehardwareC::checkTicketStatus');
    // $routes->match(['get', 'post'], 'get-hw-serial', 'IssuehardwareC::getHwSerialNo');
    // $routes->match(['get', 'post'], 'formValidationHIS', 'IssuehardwareC::formValidationHIS');
    // $routes->match(['get', 'post'], 'removeTableDataHIS', 'IssuehardwareC::removeTableDataHIS');
    // $routes->match(['get', 'post'], 'getTableDataHIS', 'IssuehardwareC::getTableDataHIS');
    // $routes->match(['get', 'post'], 'getDeviceSerialonHIS', 'IssuehardwareC::getDeviceSerialonHIS');

    // $routes->post('ajax_fetch_topic_category', 'NewticketC::ajax_fetch_topic_category');
    

    // //Report Section    
    // $routes->match(['get', 'post'], 'summary_report/(:num)', 'SummaryreportC::index/$1');
    // $routes->match(['get', 'post'], 'ticket_progress_report/(:num)', 'SummaryreportC::ticket_progress_report/$1');
    // $routes->match(['get', 'post'], 'inventory-stock', 'InventorystockC::index');
    // $routes->match(['get', 'post'], 'inventory-stock-report', 'InventorystockC::formValidationRIS');
    // $routes->match(['get', 'post'], 'user-task-search', 'UserstaskreportC::index');
    // $routes->match(['get', 'post'], 'user-task-report', 'UserstaskreportC::getSearchResult');
    
    

    //above links are working


});

// FOR VIEW TICKETS ONLY
/*$routes->group('tickets-view', static function ($routes) {
    $routes->match(['get', 'post'], 'view1', 'DashboardC::view_tickets1');
    $routes->match(['get', 'post'], 'view2', 'DashboardC::view_tickets2');
});

$routes->get('/example/customers', 'Example::customers');
$routes->post('/example/customers', 'Example::customers');*/