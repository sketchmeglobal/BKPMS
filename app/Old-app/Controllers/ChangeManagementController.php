<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\PermissionModel;
// use App\Models\MessageModel;
use App\Models\ChangeManagementModel;

// use App\Libraries\GroceryCrud;

class ChangeManagementController extends BaseController
{

   private $permission = '';
   private $cm_obj = '';
   private $session_exists = 1;
   private $table_name = '';

   public function __construct(){

      $this->permission = new PermissionModel();
      $this->cm_obj = new ChangeManagementModel();
    //   $crud = new GroceryCrud();

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

   public function cm_list(){

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
    if(!in_array('cm-list', array_column($approved_menu, 'menu_slug'))){
        return redirect()->to(base_url('login?st=1'));
    }

    
    // ADD NEW
    $data['validation_status'] = $data['notify_status'] = 0;
    $data['notify_type'] = ''; 
    $data['notify_msg'] = '';

    if($this->request->getPost()){

        $cm_add_rule = [
            'reference_number' => 'required',
            'title' => 'required|min_length[5]',
            'cm_impact_id' => 'required'
        ];

        if ($this->validate($cm_add_rule)) {
            
            $data['notify_status'] = 1;

            $insert_array = array();
            foreach($this->request->getPost() as $key => $value){

                if($key == 'submit'){ continue; }
                $value = ($value == '') ? null : $value;

                $insert_array[$key] = $value;

            }
            if($this->cm_obj->data_insert('cm_header', $insert_array)){
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

    $data['page_title'] = "Change Management || " . COMPANY_SHORT_NAME;
    $data['meta_tag'] = '<meta content="Baazar Kolkata, Sketch Me Global" name="keywords"><meta content="Baazar Kolkata, Sketch Me Global" name="description">';
    $data['approved_menu'] = $this->permission->fetch_navbar($ul, $uid);
    // echo '<pre>';print_r($data['approved_menu']);

    if($ul == 1){ // admin
        $data['cm_list'] = $this->cm_obj->data_all();
    }else{
        $row_cond = array(
            'project_inititor' => $uid,
            'row_status' => 1
        );
        $data['cm_list'] = $this->cm_obj->data_batch($table='',$row_cond);
    }

    $row_cond = array(
        'row_status' => 1
    );
    $data['data_last_row'] = $this->cm_obj->data_last_row($row_cond);
    $data['impact_list'] = $this->cm_obj->data_batch($table='master_cm_impact',$row_cond);
    $data['project_inititor'] = $uid;

    return view('cm/cm_list', $data);
    
   }

   public function edit_cm_list($cm_head_id){

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
        if(!in_array('cm-list', array_column($approved_menu, 'menu_slug'))){
            return redirect()->to(base_url('login?st=1'));
        }

    // edit
        $data['validation_status'] = $data['notify_status'] = 0;
        $data['notify_type'] = ''; 
        $data['notify_msg'] = '';

        if($this->request->getPost('activity_form')){
            $this->activity_form($cm_head_id);
        }
        if($this->request->getPost('stakeholder_form')){
            $this->stakeholder_form($cm_head_id);
        }
        if($this->request->getPost('risk_form')){
            $this->risk_form($cm_head_id);
        }
        if($this->request->getPost('technology_form')){
            $this->technology_form($cm_head_id);
        }
        if($this->request->getPost('cost_form')){
            $this->cost_form($cm_head_id);
        }
        if($this->request->getPost()){

            $cm_edit_rule = [
                'title' => 'required|min_length[5]',
                'cm_impact_id' => 'required'
            ];

            if ($this->validate($cm_edit_rule)) {
                
                $data['notify_status'] = 1;

                $update_array = array();
                foreach($this->request->getPost() as $key => $value){

                    if($key == 'submit'){ continue; }
                    $value = ($value == '') ? null : $value;

                    $update_array[$key] = $value;

                }
                if($this->cm_obj->data_update($cm_head_id, $update_array)){
                    $data['notify_type'] = 'success';
                    $data['notify_msg'] = 'Data Updated Successfully';
                }else{
                    $data['notify_type'] = 'error';
                    $data['notify_msg'] = 'Data Updation Error';
                }

            }else{

                $data['validation_status'] = 1;
                $data['validation'] = $this->validator;

            }

        }

        $data['page_title'] = "Edit Change Management || " . COMPANY_SHORT_NAME;
        $data['meta_tag'] = '<meta content="Baazar Kolkata, Sketch Me Global" name="keywords"><meta content="Baazar Kolkata, Sketch Me Global" name="description">';
        $data['approved_menu'] = $this->permission->fetch_navbar($ul, $uid);
        // echo '<pre>';print_r($data['approved_menu']);

        $row_cond = array(
            'cm_header.id' => $cm_head_id,
            'row_status' => 1
        );
        $data['cm_header_data'] = $this->cm_obj->data_current_row($row_cond);

        $row_cond = array(
            'row_status' => 1
        );
        $data['impact_list'] = $this->cm_obj->data_batch($table='master_cm_impact',$row_cond);

        $data['activity_list'] = $this->cm_obj->data_activity_list($cm_head_id);
        $data['stakeholder_list'] = $this->cm_obj->data_stakeholder_list($cm_head_id);
        $data['risk_list'] = $this->cm_obj->data_risk_list($cm_head_id);
        $data['technology_list'] = $this->cm_obj->data_technology_list($cm_head_id);
        $data['cost_list'] = $this->cm_obj->data_cost_list($cm_head_id);
        // echo $this->cm_obj->getLastQuery()->getQuery(); die;

        return view('cm/edit_cm_list', $data);
    
   }

   private function activity_form($cm_head_id){
    $rules = [
        'title' => 'required|min_length[5]'
    ];

    if (!$this->validate($rules)) {
        /* $data['validation_status'] = 1;
        $data['validation'] = $this->validator; */
    }
    $activity_array = [];
    foreach ($this->request->getVar() as $key => $value) {
        if($key == 'activity_form'){ continue; }
            $value = ($value == '') ? null : $value;

            $activity_array[$key] = $value;
    }
    if(!empty($activity_array)){
        $session = session();
        $uid = $session->get('id');
        $activity_array['cm_header_id'] = $cm_head_id;
        $activity_array['created_by'] = $uid;
        $data['notification_status'] = 1;
        if($this->cm_obj->data_insert('cm_detail_activity',$activity_array)){
            $data['notify_type'] = 'success';
            $data['notify_msg'] = 'Data Added Successfully';
        }else{
            $data['notify_type'] = 'error';
            $data['notify_msg'] = '!Oops something went wrong. Please try again.';
        }
    }
    echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
    exit();
   }
   private function stakeholder_form($cm_head_id){
    $rules = [
        'title' => 'required|min_length[5]'
    ];

    if (!$this->validate($rules)) {
        /* $data['validation_status'] = 1;
        $data['validation'] = $this->validator; */
    }
    $array = [];
    foreach ($this->request->getVar() as $key => $value) {
        if($key == 'stakeholder_form'){ continue; }
            $value = ($value == '') ? null : $value;

            $array[$key] = $value;
    }
    if(!empty($array)){
        $session = session();
        $uid = $session->get('id');
        $array['cm_header_id'] = $cm_head_id;
        $array['created_by'] = $uid;
        $data['notification_status'] = 1;
        if($this->cm_obj->data_insert('cm_detail_stakeholder',$array)){
            $data['notify_type'] = 'success';
            $data['notify_msg'] = 'Data Added Successfully';
        }else{
            $data['notify_type'] = 'error';
            $data['notify_msg'] = '!Oops something went wrong. Please try again.';
        }
    }
    echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
    exit();
   }
   private function risk_form($cm_head_id){
    $rules = [
        'title' => 'required|min_length[5]'
    ];

    if (!$this->validate($rules)) {
        /* $data['validation_status'] = 1;
        $data['validation'] = $this->validator; */
    }
    $array = [];
    foreach ($this->request->getVar() as $key => $value) {
        if($key == 'risk_form'){ continue; }
            $value = ($value == '') ? null : $value;

            $array[$key] = $value;
    }
    if(!empty($array)){
        $session = session();
        $uid = $session->get('id');
        $array['cm_header_id'] = $cm_head_id;
        $array['created_by'] = $uid;
        $data['notification_status'] = 1;
        if($this->cm_obj->data_insert('cm_detail_risk',$array)){
            $data['notify_type'] = 'success';
            $data['notify_msg'] = 'Data Added Successfully';
        }else{
            $data['notify_type'] = 'error';
            $data['notify_msg'] = '!Oops something went wrong. Please try again.';
        }
    }
    echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
    exit();
   }
   private function technology_form($cm_head_id){
    $rules = [
        'title' => 'required|min_length[5]'
    ];

    if (!$this->validate($rules)) {
        /* $data['validation_status'] = 1;
        $data['validation'] = $this->validator; */
    }
    $array = [];
    foreach ($this->request->getVar() as $key => $value) {
        if($key == 'technology_form'){ continue; }
            $value = ($value == '') ? null : $value;

            $array[$key] = $value;
    }
    if(!empty($array)){
        $session = session();
        $uid = $session->get('id');
        $array['cm_header_id'] = $cm_head_id;
        $array['created_by'] = $uid;
        $data['notification_status'] = 1;
        if($this->cm_obj->data_insert('cm_detail_technology',$array)){
            $data['notify_type'] = 'success';
            $data['notify_msg'] = 'Data Added Successfully';
        }else{
            $data['notify_type'] = 'error';
            $data['notify_msg'] = '!Oops something went wrong. Please try again.';
        }
    }
    echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
    exit();
   }
   private function cost_form($cm_head_id){
    $rules = [
        'title' => 'required|min_length[5]'
    ];

    if (!$this->validate($rules)) {
        /* $data['validation_status'] = 1;
        $data['validation'] = $this->validator; */
    }
    $array = [];
    foreach ($this->request->getVar() as $key => $value) {
        if($key == 'cost_form'){ continue; }
            $value = ($value == '') ? null : $value;

            $array[$key] = $value;
    }
    if(!empty($array)){
        $session = session();
        $uid = $session->get('id');
        $array['cm_header_id'] = $cm_head_id;
        $array['created_by'] = $uid;
        $data['notification_status'] = 1;
        if($this->cm_obj->data_insert('cm_detail_cost',$array)){
            $data['notify_type'] = 'success';
            $data['notify_msg'] = 'Data Added Successfully';
        }else{
            $data['notify_type'] = 'error';
            $data['notify_msg'] = '!Oops something went wrong. Please try again.';
        }
    }
    echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
    exit();
   }

   public function ajax_remove_cm_list(){
    
        $pid = $this->request->getPost('pid');
        $remove_cond = array(
            'id' => $pid
        );
        $data = $this->cm_obj->data_remove('cm_header',$remove_cond);
        echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
        exit();

   }
   public function ajax_remove_cm_activity_list(){
    
    $pid = $this->request->getPost('pid');
    $remove_cond = array(
        'id' => $pid
    );
    $data = $this->cm_obj->data_remove('cm_detail_activity', $remove_cond);
    echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
    exit();

   }
   public function ajax_remove_cm_stakeholder_list(){
    
    $pid = $this->request->getPost('pid');
    $remove_cond = array(
        'id' => $pid
    );
    $data = $this->cm_obj->data_remove('cm_detail_stakeholder', $remove_cond);
    echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
    exit();

   }
   public function ajax_remove_cm_risk_list(){
    
    $pid = $this->request->getPost('pid');
    $remove_cond = array(
        'id' => $pid
    );
    $data = $this->cm_obj->data_remove('cm_detail_risk', $remove_cond);
    echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
    exit();

   }
   public function ajax_remove_cm_technology_list(){
    
    $pid = $this->request->getPost('pid');
    $remove_cond = array(
        'id' => $pid
    );
    $data = $this->cm_obj->data_remove('cm_detail_technology', $remove_cond);
    echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
    exit();

   }
   public function ajax_remove_cm_cost_list(){
    
    $pid = $this->request->getPost('pid');
    $remove_cond = array(
        'id' => $pid
    );
    $data = $this->cm_obj->data_remove('cm_detail_cost', $remove_cond);
    echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
    exit();

   }

//    public function log_before_update($array){

//       // print_r($array); die;
//       $session = session();
//       $MessageM = new MessageModel(); 

//       $insertArray = array(
//           'target_table' => $this->table_name,
//           'action_taken'=>'edit', 
//           'topic_details' => json_encode($array),
//           'user_id' => $session->get('id'),
//           'comment' => 'messaging'
//       );
      
//       $MessageM->LogInsert($insertArray);

//    }

//   public function log_before_delete($array){

//       $MessageM = new MessageModel(); 
//       $row_cond = array(
//           'id' => $array->primaryKeyValue
//       );
//       $row_rs = $MessageM->GetRow($row_cond);
      
//       $session = session();
      
//       $insertArray = array(
//           'target_table' => $this->table_name,
//           'action_taken'=>'delete', 
//           'topic_details' => json_encode($row_rs),
//           'user_id' => $session->get('id'),
//           'comment' => 'master'
//       );
      
//       $MessageM->LogInsert($insertArray);

//   }


}