<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\PermissionModel;
use App\Models\TicketModel;
// use App\Models\TicketModel;

class TicketController extends BaseController
{

   private $permission = '';
   private $session_exists = 1;

   public function __construct(){

      $this->permission = new PermissionModel();
      $this->ticket_model = new TicketModel();

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

   public function index(){
      
      $session = session();
      $this->check_session();               

      $TicketModel = new TicketModel();
      $emp_id = $session->emp_id;
      $data['rows'] = $TicketModel->getAllTickets($emp_id);
      return view('tickets/all-tickets', $data);
      
   }

   public function all_ticket(){

      // common permission area
         $data = array();
         $this->check_session();
         $session = session();
         $cur_slug = 'all-ticket';
         $approved_menu = $this->permission->fetch_navbar($session->get('user_level'), $session->get('id'));
         if(!in_array($cur_slug, array_column($approved_menu, 'menu_slug'))){
            die('No permission for direct URL access');
         }
         foreach($approved_menu as $am){
            if($am->menu_slug == $cur_slug){
               $data['action_button_1'] = $am->action_button_1;
               $data['action_button_2'] = $am->action_button_2;
            }
         }
      // common permission area

      $TicketModel = new TicketModel();
      $emp_id = $session->emp_id;
      $data['rows'] = $TicketModel->getAllTickets($emp_id);

      $data['page_title'] = "My Tickets || " . COMPANY_SHORT_NAME;
      $data['meta_tag'] = '<meta content="Baazar Kolkata, Sketch Me Global" name="keywords"><meta content="Baazar Kolkata, Sketch Me Global" name="description">';
      $data['approved_menu'] = $approved_menu;   

      return view('tickets/all-ticket', $data);
   }

   public function my_ticket(){
      
      // ------INITIALLISATION------
      $session = session();
      $uid = $session->get('id');
      $ul = $session->get('user_level');
      $cur_slug = 'my-ticket';
      // ------INITIALLISATION ENDS------

      // ------PERMISSION------
      $this->check_session();
      $approved_menu = $this->permission->fetch_navbar($ul,$uid);
      foreach($approved_menu as $am){
         if($am->menu_slug == $cur_slug){
            $data['action_button_1'] = $am->action_button_1;
            $data['action_button_2'] = $am->action_button_2;
         }
      }
         #stop direct URL access
      if(!in_array($cur_slug, array_column($approved_menu, 'menu_slug'))){
         return redirect()->to(base_url('login?st=1'));
      }

      // ADD NEW
      $data['validation_status'] = $data['notify_status'] = 0;
      $data['notify_type'] = $data['notify_msg'] = '';

      $TicketModel = new TicketModel();
      $emp_id = $session->emp_id;
      $data['rows'] = $TicketModel->getMyTickets($emp_id);
      $data['topic_rows'] = $TicketModel->getTopicMaster();
      $data['category_rows'] = $TicketModel->getCategoryMaster();

      $data['page_title'] = "My Tickets || " . COMPANY_SHORT_NAME;
      $data['meta_tag'] = '<meta content="Baazar Kolkata, Sketch Me Global" name="keywords"><meta content="Baazar Kolkata, Sketch Me Global" name="description">';
      $data['approved_menu'] = $approved_menu;

      return view('tickets/my-tickets', $data);

   }

   public function new_ticket(){

      // ------INITIALLISATION------
      $session = session();
      $uid = $session->get('id');
      $ul = $session->get('user_level');
      $cur_slug = 'new-ticket';
      // ------INITIALLISATION ENDS------

      // ------PERMISSION------
      $this->check_session();
      $approved_menu = $this->permission->fetch_navbar($ul,$uid);
      foreach($approved_menu as $am){
         if($am->menu_slug == $cur_slug){
            $data['action_button_1'] = $am->action_button_1;
            $data['action_button_2'] = $am->action_button_2;
         }
      }
         #stop direct URL access
      if(!in_array($cur_slug, array_column($approved_menu, 'menu_slug'))){
         return redirect()->to(base_url('login?st=1'));
      }

      // ADD NEW
      $data['validation_status'] = $data['notify_status'] = 0;
      $data['notify_type'] = $data['notify_msg'] = '';

      $TicketModel = new TicketModel();
      $data['topic_rows'] = $TicketModel->getTopicMaster();
      $data['category_rows'] = $TicketModel->getCategoryMaster();

      $data['page_title'] = "My Tickets || " . COMPANY_SHORT_NAME;
      $data['meta_tag'] = '<meta content="Baazar Kolkata, Sketch Me Global" name="keywords"><meta content="Baazar Kolkata, Sketch Me Global" name="description">';
      $data['approved_menu'] = $approved_menu;   

      return view('tickets/new-ticket', $data);
   }

   public function ajax_fetch_topic_category() {
      $topic_id = service('request')->getPost('topic_id');
      $TicketModel = new TicketModel();
      $category_rows = $TicketModel->getCategoryMasterByTopicId($topic_id);

      $html = '<option value="">Select</option>';
      foreach ($category_rows as $row) {
          $html .= '<option value="'.$row->id.'">'.$row->ticket_category_name.'</option>';
      }
      echo json_encode($html);
   }

   public function ajax_fetch_solutions() {
      $ticket_category_id = service('request')->getPost('ticket_category_id');
      $TicketModel = new TicketModel();
      $solution_rows = $TicketModel->getSolutionByCategoryId($ticket_category_id);

      $html = '';
      $counter = 1;
      foreach ($solution_rows as $row) {
          $html .= '<div class="card">
                      <div class="card-header" id="heading_'.$counter.'">
                          <h5 class="mb-0">
                              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse_'.$counter.'" aria-expanded="false" aria-controls="collapse_'.$counter.'">
                                  Solution '.$counter.'
                              </button>
                          </h5>
                      </div>
                      <div id="collapse_'.$counter.'" class="collapse" aria-labelledby="heading_'.$counter.'" data-parent="#accordion">
                          <div class="card-body">
                              '.$row->solution.'
                          </div>
                      </div>
                  </div>';
          $counter++;
      }
      echo json_encode($html);
   }

   public function new_ticket_validation(){
   if($this->request->isAJAX()) {      
      $session = session();
      $logged_in = $session->logged_in;
      $emp_id = $session->emp_id;
      $ol_id = $session->ol_id;
      
      $query = service('request')->getPost('query');
      $topic_id = $query['topic_id'];
      $ticket_category = $query['ticket_category'];
      $ticket_subject = $query['ticket_subject'];
      $ticket_description = $query['ticket_description'];
      $self_assign = $query['self_assign'];
      $self_assign_msg = $query['self_assign_msg'];

      $return_data = array();
      $status = true;
      $officeM = new TicketModel();
         
      $validation = \Config\Services::validation();
      $validation->setRules([
         'topic_id' => 'required',
         'ticket_subject' => 'required'
      ]);

      $data = [
         'topic_id' => $topic_id,
         'ticket_subject' => $ticket_subject
      ];
      $validatedData = array();

      if ($validation->run($data)) {
         $validatedData = $validation->getValidated(); 

         $post_data = [
            'topic_id' => $topic_id,
            'ticket_category' => $ticket_category,
             'ticket_subject' => $ticket_subject,
             'ticket_description' => $ticket_description,
             'self_assign' => $self_assign,
             'self_assign_msg' => $self_assign_msg,
            'created_by' => $emp_id,
            'ol_id' => $ol_id
         ];
         
         $result = $officeM->insertTableData($post_data);

         //echo '****** return form model *******';
         //echo json_encode($result);
         //echo 'ho id: ' . $result['ho_id'];
         $ticket_id = 0;
         if($result['status'] == true){
            $status = true;
            $ticket_id = $result['ticket_id'];
            $return_data['ticket_id'] = $ticket_id;
         }else{
            $status = false; 
         }
      }else {
         $return_data['validation'] = $validation->getErrors();
         $status = false;
      } 

      $return_data['status'] = $status;

      echo json_encode($return_data);
      //var_dump($this->request->getPost('query'));
  }
   }

   public function view_ticket($ticket_id){

      // common permission area
         $data = array();
         $this->check_session();
         $session = session();
         $cur_slug = 'view-ticket';
         $approved_menu = $this->permission->fetch_navbar($session->get('user_level'), $session->get('id'));
         if(!in_array($cur_slug, array_column($approved_menu, 'menu_slug'))){
            return redirect()->to(base_url('login?st=1'));
         }
         foreach($approved_menu as $am){
            if($am->menu_slug == $cur_slug){
               $data['action_button_1'] = $am->action_button_1;
               $data['action_button_2'] = $am->action_button_2;
            }
         }
      // common permission area

      $TicketModel = new TicketModel();
      $data['rows'] = $TicketModel->getTicketDetails($ticket_id);
      $data['tic_stat_rows'] = $TicketModel->getTicketStatus();
      $data['holiday_list'] = $TicketModel->getHolidayList();
      $data['emp_groups'] = $TicketModel->getAllEmpGroup();
      $data['issued_devices'] = $TicketModel->getIssuedDevices();
      $data['solutions'] = $TicketModel->getTicketSolutions($ticket_id);

      $data['page_title'] = "View Ticket || " . COMPANY_SHORT_NAME;
      $data['meta_tag'] = '<meta content="Baazar Kolkata, Sketch Me Global" name="keywords"><meta content="Baazar Kolkata, Sketch Me Global" name="description">';
      $data['approved_menu'] = $approved_menu;   

      return view('tickets/view-ticket', $data);


   }

   public function view_ticket_validation(){
   
      if ($this->request->isAJAX()) {
         $session = session();
         $logged_in = $session->logged_in;
         $emp_id = $session->emp_id;
         $emp_name = $session->emp_name;
         $email = $session->email;

         $ticket_id = service('request')->getPost('ticket_id');
         $reply_text = service('request')->getPost('reply_text');

         $return_data = array();
         $status = true;
         $session = session();
         $officeM = new TicketModel();

         $validation = \Config\Services::validation();
         $validation->setRules([
             'reply_text' => 'required'
         ]);

         $data = [
             'reply_text' => $reply_text
         ];
         $validatedData = array();

         if ($validation->run($data)) {
             $validatedData = $validation->getValidated();

             $post_data = [
                 'ticket_id' => $ticket_id,
                 'reply_text' => $reply_text,
                 'replied_by' => $emp_id,
                 'emp_name' => $emp_name,
                 'email' => $email
             ];

             $result = $officeM->insertTableData_view($post_data);

             //echo '****** return form model *******';
             //echo json_encode($result);
             //echo 'ho id: ' . $result['ho_id'];
             $ticket_comment_id = 0;
             $message = $result['message'];
             if ($result['status'] == true) {
                 $status = true;
                 $ticket_comment_id = $result['ticket_comment_id'];
                 $return_data['ticket_comment_id'] = $ticket_comment_id;
             } else {
                 $status = false;
             }
         } else {
             $return_data['validation'] = $validation->getErrors();
             $status = false;
         }

         $return_data['status'] = $status;
         $return_data['message'] = $message;

         echo json_encode($return_data);
         //var_dump($this->request->getPost('query'));
     }

   }

   public function accept_ticket() {
        if ($this->request->isAJAX()) {
            $return_data = array();
            $TicketModel = new TicketModel();
            $session = session();
            $parent_emp_code = $session->parent_emp_code;

            $ticket_id = service('request')->getPost('ticket_id');
            $created_by = service('request')->getPost('created_by');
            $accepted_by = service('request')->getPost('accepted_by');
            $accepted_by_name = service('request')->getPost('accepted_by_name');
            $ticket_status_id = service('request')->getPost('ticket_status_id');
            $ticket_status_text = service('request')->getPost('ticket_status_text');
            $old_ticket_status_id = service('request')->getPost('old_ticket_status_id');
            $old_ticket_status_text = service('request')->getPost('old_ticket_status_text');
            $max_allowed_time = service('request')->getPost('max_allowed_time');
            $emp_gr_id = service('request')->getPost('emp_gr_id');
            $emp_gr_text = service('request')->getPost('emp_gr_text');
            $hw_sl_id = service('request')->getPost('hw_sl_id');
            $hw_text = service('request')->getPost('hw_text');
            $sr_req_msg = service('request')->getPost('sr_req_msg');

            $post_data = [
                'ticket_id' => $ticket_id,
                'created_by' => $created_by,
                'ticket_status_id' => $ticket_status_id,
                'ticket_status_text' => $ticket_status_text,
                'old_ticket_status_id' => $old_ticket_status_id,
                'old_ticket_status_text' => $old_ticket_status_text,
                'accepted_by' => $accepted_by,
                'accepted_by_name' => $accepted_by_name,
                'max_allowed_time' => $max_allowed_time,
                'emp_gr_id' => $emp_gr_id,
                'emp_gr_text' => $emp_gr_text,
                'hw_sl_id' => $hw_sl_id,
                'hw_text' => $hw_text,
                'sr_req_msg' => $sr_req_msg,
            ];
            $result = $TicketModel->acceptTicket($parent_emp_code, $post_data);
            $message = $result['message'];
            $status = $result['status'];
            $last_updated = $result['last_updated'];
            $deadline = $result['deadline'];
        }

        $return_data['status'] = $status;
        $return_data['message'] = $message;
        $return_data['last_updated'] = $last_updated;
        $return_data['deadline'] = $deadline;
        echo json_encode($return_data);
   }//end






}
