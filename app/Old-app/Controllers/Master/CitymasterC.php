<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AuthM;
use App\Models\Master\CitymasterM;

class CitymasterC extends BaseController
{
   public function index(){ 
      $session = session();
      if($session->logged_in == '') {
          return redirect()->to('logout');
      }else{
          $head_officeM = new CitymasterM();           
          $data['rows'] = $head_officeM->getAllTicketCategory();            
          $data['state_rows'] = $head_officeM->getAllStates();           
         return view('master/city-master', $data);
      }
   }

   public function formValidationCM(){
      if($this->request->isAJAX()) {
         $query = service('request')->getPost('query');
         $state_id = $query['state_id'];
         $city_name = $query['city_name'];
         $table_id = $query['table_id'];

         $return_data = array();
         $status = true;
         $session = session();
         $officeM = new CitymasterM();
            
         $validation = \Config\Services::validation();
         $validation->setRules([
            'state_id' => 'required',
            'city_name' => 'required',
            'table_id' => 'required'
         ]);

         $data = [
            'state_id' => $state_id,
            'city_name' => $city_name,
            'table_id' => $table_id
         ];
         $validatedData = array();

         if ($validation->run($data)) {
            $validatedData = $validation->getValidated(); 
            //print_r($validatedData);
            $result = $officeM->insertTableData($validatedData);

            $state_id = 0;
            if($result['status'] == true){
               $status = true;
               $state_id = $result['state_id'];
               $city_name = $result['city_name'];
               $return_data['state_id'] = $state_id;
               $return_data['city_name'] = $city_name;
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

   public function removeTableDataCM(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new CitymasterM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->removeTableDataCM($table_id);
         if($result['status'] == true){

         }
      }

      $return_data['status'] = $status;
      echo json_encode($return_data);
   }//end 

   public function getTableDataCM(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new CitymasterM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->getTableDataCM($table_id);
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