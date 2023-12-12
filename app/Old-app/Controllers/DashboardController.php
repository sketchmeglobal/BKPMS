<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PermissionModel;

class DashboardController extends BaseController
{

    private $dashboard = '' ;
    private $permission = '';
    private $session_exists = 1;
    public function __construct(){
        // $this->dashboard = new DashboardModel();
        $this->permission = new PermissionModel();
        $session = session();
        if($session->logged_in == true and !empty($session->get('id'))) {
            $this->session_exists = 1;
        }else{
            $this->session_exists = 0;
        }
    }

    public function check_session(){
        if(!$this->session_exists){
            return redirect()->to(base_url('login'));
        }
    }
    
    public function index() {
        
        $session = session();
        $this->check_session();
        
        $data['page_title'] = "Dashboard || " . COMPANY_SHORT_NAME;
        $data['meta_tag'] = '<meta content="Baazar Kolkata, Sketch Me Global" name="keywords"><meta content="Baazar Kolkata, Sketch Me Global" name="description">';
        $data['approved_menu'] = $this->permission->fetch_navbar($session->get('user_level'), $session->get('id'));
        // echo '<pre>';print_r($data['approved_menu']);
        return view('dashboard/main_index', $data);

    }





    // ----------- WORKING  ^ --------------

    public function all_tickets()
    {
        return view('dashboard/all-tickets');
    }
    public function profile()
    {
        return view('dashboard/profile');
    }
    public function site_hierancy()
    {
        return view('dashboard/site-hierancy');
    }
    public function sr_association()
    {
        return view('dashboard/sr-association');
    }
    public function severity()
    {
        return view('dashboard/severity-mapping');
    }
    public function internet_masg()
    {
        return view('dashboard/intranet-massaging');
    }
    public function all_users()
    {
        return view('dashboard/all-users');
    }
    public function new_ticket()
    {
        return view('dashboard/new-ticket');
    }
    // FOR VIEW TICKETS
    public function view_tickets1()
    {
        return view('view-tickets/view-tickets');
    }
    public function view_tickets2()
    {
        return view('view-tickets/view-tickets2');
    }
}