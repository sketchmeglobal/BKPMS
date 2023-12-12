<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\PermissionModel;
use App\Models\MessageModel;

use App\Libraries\GroceryCrud;

class MessageController extends BaseController
{

   private $permission = '';
   private $session_exists = 1;

   private $table_name = '';

   public function __construct(){

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

   public function intranet_messaging(){

      // ------INITIALLISATION------
      $session = session();
      $uid = $session->get('id');
      $ul = $session->get('user_level');
      // ------INITIALLISATION ENDS------

      // ------PERMISSION------
      $this->check_session();
      $approved_menu = $this->permission->fetch_navbar($ul,$uid);
      //   print_r($approved_menu);
         #stop direct URL access
      if(!in_array('intranet-messaging', array_column($approved_menu, 'menu_slug'))){
         return redirect()->to(base_url('login?st=1'));
      }

      // ADD NEW MSG
      $data['validation_status'] = $data['notify_status'] = 0;
      $data['notify_type'] = ''; 
      $data['notify_msg'] = '';

      $MessageM = new MessageModel(); 
      $emp_id = $session->emp_id;   
      $dg_id = $MessageM->getUserDesignation($emp_id);
      if(!$dg_id){
         die('Please set desgnation of the session employee first');
      }
      $data['designation'] = $MessageM->getAllDesignation();
      $data['rows'] = $MessageM->getAllMessage($emp_id, $dg_id);
        
      if($this->request->getPost()){

         $msg_add_rule = [
             'to_dg_id' => 'required',
             'message' => 'required|min_length[5]',
             'end_date' => 'required'
         ];
 
         if ($this->validate($msg_add_rule)) {
             
             $data['notify_status'] = 1;
 
             $insert_array = array();
             foreach($this->request->getPost() as $key => $value){
 
                 if($key == 'submit'){ continue; }
               //   $value = ($value == '') ? null : $value;
                 $insert_array[$key] = $value;
 
             }
             if($MessageM->data_insert('intra_messaging', $insert_array)){
                 $data['notify_type'] = 'success';
                 $data['notify_msg'] = 'Data Inserted Successfully';
             }else{
                 $data['notify_type'] = 'error';
                 $data['notify_msg'] = 'Data Insertion Error';
             }
 
         }else{
 
             $data['validation_status'] = 1;
             $data['validation'] = $this->validator;
 
         }
 
      }

      $data['page_title'] = "Messages || " . COMPANY_SHORT_NAME;
      $data['meta_tag'] = '<meta content="Baazar Kolkata, Sketch Me Global" name="keywords"><meta content="Baazar Kolkata, Sketch Me Global" name="description">';
      $data['approved_menu'] = $approved_menu;

      return view('message/intranet-messaging', $data);
      
   }

   public function group_messaging(){
      // ------INITIALLISATION------
      $session = session();
      $crud = new GroceryCrud();
      $this->table_name = 'group_messaging';
      $this->pk_field_name = 'id';
      $uid = $session->get('id');

      $crud->setTable($this->table_name);
      $crud->setSubject('Group Message');
      // ------INITIALLISATION ENDS------

      // ------PERMISSION------
      $this->check_session();
      $approved_menu = $this->permission->fetch_navbar($session->get('user_level'),$uid);

          #stop direct URL access
      if(!in_array('group-messaging', array_column($approved_menu, 'menu_slug'))){
          die('No permission');
      }

      $data = [];
      foreach ($approved_menu as $item) {
          if($item->menu_slug == 'group_messaging'){
              $data = [
                  'menu_module'=>$item->menu_module,
                  'menu_name'=>$item->menu_name,
                  'menu_slug'=>$item->menu_slug,
                  'action_button_1'=>$item->action_button_1,
                  'action_button_2'=>$item->action_button_2
              ];
          }
      }

      if(!empty($data)){
          if(!$data['action_button_1']){
              $crud->unsetAdd();
              $crud->unsetEdit();
              $crud->unsetDelete();
          }
          if(!$data['action_button_2']){
              $crud->unsetPrint();
              $crud->unsetExport();
          }
      }
      // ------PERMISSION ENDS------

      $crud->unsetColumns(['created_at','created_by','updated_at', 'updated_by', 'row_status']);
      $crud->unsetFields(['created_at','created_by','updated_at', 'updated_by', 'row_status']);

      // ------DB LOG AREA STARTS------
         $crud->callbackBeforeUpdate(function ($commonParameters) {
               $this->log_before_update($commonParameters);
         });
         $crud->callbackBeforeDelete(function ($commonParameters) {
               $this->log_before_delete($commonParameters);
         });
      // ------DB LOG AREA ENDS------

      $output = $crud->render();

      $output->breadcrumb = 'Group Messaging';
      $output->page_title = 'Group Messaging' . " || " . COMPANY_SHORT_NAME;
      $output->meta_tag = '<meta content="Baazar Kolkata, Sketch Me Global" name="keywords"><meta content="Baazar Kolkata, Sketch Me Global" name="description">';
      $output->approved_menu = $approved_menu;

      return view('master/main_common', (array)$output);

   }

   public function log_before_update($array){

      // print_r($array); die;
      $session = session();
      $MessageM = new MessageModel(); 

      $insertArray = array(
          'target_table' => $this->table_name,
          'action_taken'=>'edit', 
          'topic_details' => json_encode($array),
          'user_id' => $session->get('id'),
          'comment' => 'messaging'
      );
      
      $MessageM->LogInsert($insertArray);

   }

  public function log_before_delete($array){

      $MessageM = new MessageModel(); 
      $row_cond = array(
          'id' => $array->primaryKeyValue
      );
      $row_rs = $MessageM->GetRow($row_cond);
      
      $session = session();
      
      $insertArray = array(
          'target_table' => $this->table_name,
          'action_taken'=>'delete', 
          'topic_details' => json_encode($row_rs),
          'user_id' => $session->get('id'),
          'comment' => 'master'
      );
      
      $MessageM->LogInsert($insertArray);

  }

   public function ajax_form_validation_messaging(){
      if($this->request->isAJAX()) {
         $query = service('request')->getPost('query');
         $message = $query['message'];
         $end_date = $query['end_date'];
         $dg_id = $query['dg_id'];

         $return_data = array();
         $status = true;
         $session = session();
         $emp_id = $session->emp_id;
         $MessageM = new MessageModel();
            
         $validation = \Config\Services::validation();
         $validation->setRules([
            'message' => 'required|min_length[5]',
            'end_date' => 'required|min_length[1]',
            'dg_id' => 'required|min_length[1]'
         ]);

         $data = [
            'message'   => $message,
            'end_date'   => $end_date,
            'dg_id' => $dg_id
         ];
         $validatedData = array();

         $pose_data = [
            'message'   => $message,
            'end_date'   => $end_date,
            'emp_id' => $emp_id,
            'dg_id' => $dg_id
         ];

         if ($validation->run($data)) {

            $validatedData = $validation->getValidated(); 
            //print_r($validatedData);
            $result = $MessageM->insertTableData($pose_data);
            
            if($result['status'] == true){
               $status = true;
               $im_id = $result['im_id'];
               $return_data['im_id'] = $im_id;
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


   public function ajax_remove_table_data(){

      $status = true;
      if($this->request->isAJAX()) {
         $return_data = array();
         $MessageM = new MessageModel();

         $pid = service('request')->getPost('pid');
         $status = $MessageM->ajax_remove_table_data($pid);
         
      }

      $return_data['status'] = $status;
      echo json_encode($return_data);
   }//end 

   // public function getTableDataDG(){
   //    if($this->request->isAJAX()) {
   //       $return_data = array();
   //       $status = true;
   //       $MessageM = new MessageModel();

   //       $table_id = service('request')->getPost('table_id');
   //       $result = $MessageM->getTableDataDG($table_id);
   //       if($result['status'] == true){
   //          $status = true;
   //          $row = $result['row'];
   //          //echo json_encode($row);
   //          $result = $row[0];
   //          $return_data['result'] = $result;
   //       }else{
   //          $status = false;
   //       }
   //    }

   //    $return_data['status'] = $status;
   //    echo json_encode($return_data);
   // }//end 

   // public function getDesigTableData(){
   //    if($this->request->isAJAX()) {
   //       $return_data = array();
   //       $status = true;
   //       $MessageM = new MessageModel();

   //       $ho_id = service('request')->getPost('ho_id');
   //       $wh_id = service('request')->getPost('wh_id');
   //       $ol_id = service('request')->getPost('ol_id');

   //       $result = $MessageM->getDesigTableData($ho_id, $wh_id, $ol_id);
   //       echo json_encode($result);
         
   //       // if($result['status'] == true){
   //       //    $status = true;
   //       //    $row = $result['row'];
   //       //    echo json_encode($row);
   //       //    $result = $row[0];
   //       //    $return_data['result'] = $result;
   //       // }else{
   //       //    $status = false;
   //       // }
   //    }

   //    // $return_data['status'] = $status;
   //    // echo json_encode($return_data);
      
   // }//end 

}