<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AuthM;
use App\Models\Master\StatemasterM;

class StatemasterC extends BaseController
{
   public function index(){  
      $session = session();
      if($session->logged_in == '') {
          return redirect()->to('logout');
      }else{
          $head_officeM = new StatemasterM();            
         $data['rows'] = $head_officeM->getAllStates();            
         return view('master/state', $data);
      }
   }

   public function formValidationST(){
      if($this->request->isAJAX()) {
         $query = service('request')->getPost('query');
         $state_name = $query['state_name'];
         $state_code = $query['state_code'];
         $table_id = $query['table_id'];

         $return_data = array();
         $status = true;
         $session = session();
         $officeM = new StatemasterM();
            
         $validation = \Config\Services::validation();
         $validation->setRules([
            'state_name' => 'required',
            'table_id' => 'required'
         ]);

         $data = [
            'state_name'   => $state_name,
            'table_id' => $table_id
         ];

         $post_data = [
            'state_name'   => $state_name,
            'state_code'   => $state_code,
            'table_id' => $table_id
         ];

         $validatedData = array();

         if ($validation->run($data)) {
            $validatedData = $validation->getValidated(); 
            //print_r($validatedData);
            $result = $officeM->insertTableData($post_data);

            //echo '****** return form model *******';
            //echo json_encode($result);
            //echo 'ho id: ' . $result['ho_id'];
            $ho_id = 0;
            if($result['status'] == true){
               $status = true;
               $ho_id = $result['ho_id'];
               $return_data['ho_id'] = $ho_id;
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

   public function removeTableDataST(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new StatemasterM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->removeTableDataST($table_id);
         if($result['status'] == true){
         }
      }

      $return_data['status'] = $status;
      echo json_encode($return_data);
   }//end 

   public function getTableDataST(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new StatemasterM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->getTableDataST($table_id);
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

}