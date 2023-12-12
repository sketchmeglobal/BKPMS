<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AuthM;
use App\Models\Master\EmpGroupM;

class EmpGroupC extends BaseController
{
   public function index(){  
      $session = session();
      if($session->logged_in == '') {
          return redirect()->to('logout');
      }else{
         $head_officeM = new EmpGroupM();            
         $data['rows'] = $head_officeM->findAll();            
         return view('master/emp_group', $data);
      }
   }

   public function formValidationEG(){
      if($this->request->isAJAX()) {
         $query = service('request')->getPost('query');
         $group_name = $query['group_name'];
         $table_id = $query['table_id'];

         $return_data = array();
         $status = true;
         $session = session();
         $officeM = new EmpGroupM();
            
         $validation = \Config\Services::validation();
         $validation->setRules([
            'group_name' => 'required',
            'table_id' => 'required'
         ]);

         $data = [
            'group_name'   => $group_name,
            'table_id' => $table_id
         ];

         $post_data = [
            'group_name'   => $group_name,
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

   public function removeTableDataEG(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new EmpGroupM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->removeTableDataEG($table_id);
         if($result['status'] == true){
         }
      }

      $return_data['status'] = $status;
      echo json_encode($return_data);
   }//end 

   public function getTableDataEG(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new EmpGroupM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->getTableDataEG($table_id);
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