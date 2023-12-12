<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AuthM;
use App\Models\Master\OutletM;

class OutletC extends BaseController
{
   public function index(){ 
      $session = session();
      if($session->logged_in == '') {
          return redirect()->to('logout');
      }else{
         $head_officeM = new OutletM();            
         $data['rows'] = $head_officeM->findAll();            
         $data['state_rows'] = $head_officeM->getAllStates();               
         return view('master/outlet', $data);
      }
   }

   public function formValidationOL(){
      if($this->request->isAJAX()) {
         $query = service('request')->getPost('query');
         $ol_name = $query['ol_name'];
         $ol_location = $query['ol_location'];
         $table_id = $query['table_id'];
         $state_name = $query['state_name'];
         $city_name = $query['city_name'];

         $return_data = array();
         $status = true;
         $session = session();
         $officeM = new OutletM();
            
         $validation = \Config\Services::validation();
         $validation->setRules([
            'ol_name' => 'required|min_length[5]',
            'ol_location' => 'required|min_length[5]',
            'table_id' => 'required'
         ]);

         $data = [
            'ol_name'   => $ol_name,
            'ol_location'   => $ol_location,
            'table_id' => $table_id
         ];
         $validatedData = array();

         $post_data = [
            'ol_name'   => $ol_name,
            'ol_location'   => $ol_location,
            'table_id' => $table_id,
            'state_name' => $state_name,
            'city_name' => $city_name
         ];

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

   public function removeTableDataOL(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new OutletM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->removeTableDataOL($table_id);
         if($result['status'] == true){

         }
      }

      $return_data['status'] = $status;
      echo json_encode($return_data);
   }//end 

   public function getTableDataOL(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new OutletM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->getTableDataOL($table_id);
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