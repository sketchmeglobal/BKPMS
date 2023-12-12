<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AuthM;
use App\Models\Master\EmployeeM;

class EmployeeC extends BaseController
{
   public function index(){    
      $session = session();
      if($session->logged_in == '') {
          return redirect()->to('logout');
      }else{
         $head_officeM = new EmployeeM();             
         $data['designation'] = $head_officeM->getAllDesignation();           
         $data['ho_rows'] = $head_officeM->getAllHeadOffice();           
         $data['wh_rows'] = $head_officeM->getAllWareHouse();           
         $data['ol_rows'] = $head_officeM->getAllOutlet();           
         $data['u_level_rows'] = $head_officeM->getAllUserLevel();            
         $data['state_rows'] = $head_officeM->getAllStates();               
         $data['emp_groups'] = $head_officeM->getAllEmpGroup();     

         return view('master/employee', $data);
      }
   }

   public function formValidationEM(){
      if($this->request->isAJAX()) {
         $query = service('request')->getPost('query');
         $emp_name = $query['emp_name'];
         $primary_phone = $query['primary_phone'];
         $secondary_phone = $query['secondary_phone'];
         $email_id = $query['email_id'];
         $dg_id = $query['dg_id'];
         $table_id = $query['table_id'];
         $ho_id = $query['ho_id'];
         $wh_id = $query['wh_id'];
         $ol_id = $query['ol_id'];
         $user_level = $query['user_level'];
         if($query['emp_gr_id'] != '') $emp_gr_id=$query['emp_gr_id']; else $emp_gr_id=null;
         $state_name = $query['state_name'];
         $city_name = $query['city_name'];
         $parent_emp_code = $query['parent_emp_code'];

         $return_data = array();
         $status = true;
         $session = session();
         $officeM = new EmployeeM();
            
         $validation = \Config\Services::validation();
         $validation->setRules([
            'emp_name' => 'required',
            'primary_phone' => 'required',
            'table_id' => 'required',
            'ho_id' => 'required',
            'wh_id' => 'required',
            'ol_id' => 'required'
         ]);

         $data = [
            'emp_name' => $emp_name,
            'primary_phone' => $primary_phone,
            'table_id' => $table_id,
            'ho_id' => $ho_id,
            'wh_id' => $wh_id,
            'ol_id' => $ol_id
         ];         

         $post_data = [
            'emp_name' => $emp_name,
            'primary_phone' => $primary_phone,
            'secondary_phone' => $secondary_phone,
            'email_id' => $email_id,
            'dg_id' => $dg_id,
            'table_id' => $table_id,
            'ho_id' => $ho_id,
            'wh_id' => $wh_id,
            'ol_id' => $ol_id,
            'user_level' => $user_level,
            'emp_gr_id' => $emp_gr_id,
            'state_name' => $state_name,
            'city_name' => $city_name,
            'parent_emp_code' => $parent_emp_code
         ];

         $validatedData = array();

         if ($validation->run($data)) {
            $validatedData = $validation->getValidated(); 
            
            $result = $officeM->insertTableData($post_data);
            
            if($result['status'] == true){
               $status = true;
               $emp_id = $result['emp_id'];
               $return_data['emp_id'] = $emp_id;
               $return_data['arr_size'] = $result['arr_size'];
               $return_data['message'] = $result['message'];
               $return_data['emp_code'] = $result['emp_code'];
            }else{
               $status = false; 
               $return_data['message'] = $result['message'];
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

   public function removeTableDataEM(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new EmployeeM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->removeTableDataEM($table_id);
         if($result['status'] == true){

         }
      }

      $return_data['status'] = $status;
      echo json_encode($return_data);
   }//end 

   public function getTableDataEM(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new EmployeeM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->getTableDataEM($table_id);
         if($result['status'] == true){
            $status = true;
            $row = $result['row'];
            //echo json_encode($row);
            $result = $row[0];
            $return_data['result'] = $result;
         }else{
            $status = false;
         }
      }

      $return_data['status'] = $status;
      echo json_encode($return_data);
   }//end    

   public function getDesignationEM(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new EmployeeM();

         $ho_id = service('request')->getPost('ho_id');
         $wh_id = service('request')->getPost('wh_id');
         $ol_id = service('request')->getPost('ol_id');

         $result = $officeM->getDesignationEM($ho_id, $wh_id, $ol_id);
         if($result['status'] == true){
            $status = true;
            $option_text = $result['option_text'];
            $return_data['option_text'] = $option_text;
            //echo json_encode($row);
            
         }else{
            $status = false;
         }
      }

      $return_data['status'] = $status;
      echo json_encode($return_data);
   }//end 

   public function getDesigTableDataEM(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new EmployeeM();

         $ho_id = service('request')->getPost('ho_id');
         $wh_id = service('request')->getPost('wh_id');
         $ol_id = service('request')->getPost('ol_id');

         $result = $officeM->getDesigTableDataEM($ho_id, $wh_id, $ol_id);
         echo json_encode($result);
      }      
   }//end 

   public function getCityList(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $message = '';
         $officeM = new EmployeeM();

         $state_name = service('request')->getPost('state_name');
         $result = $officeM->getCityList($state_name);
         if($result['status'] == true){
            $status = true;
            $option_text = $result['option_text'];            
         }else{
            $status = false;
         }
      }

      $return_data['status'] = $status;
      $return_data['option_text'] = $option_text;
      echo json_encode($return_data);
   }//end 

}