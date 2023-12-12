<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AuthM;
use App\Models\Master\DepartmentM;

class DepartmentC extends BaseController
{
   public function index(){  
      $session = session();
      if($session->logged_in == '') {
          return redirect()->to('logout');
      }else{
          $head_officeM = new DepartmentM();            
         $data['rows'] = $head_officeM->findAll();            
         return view('master/department', $data);
      }
   }

   public function formValidationDE(){
      if($this->request->isAJAX()) {
         $query = service('request')->getPost('query');
         $dept_name = $query['dept_name'];
         $dept_code = $query['dept_code'];
         $table_id = $query['table_id'];

         $return_data = array();
         $status = true;
         $session = session();
         $officeM = new DepartmentM();
            
         $validation = \Config\Services::validation();
         $validation->setRules([
            'dept_name' => 'required',
            'table_id' => 'required'
         ]);

         $data = [
            'dept_name'   => $dept_name,
            'table_id' => $table_id
         ];

         $post_data = [
            'dept_name'   => $dept_name,
            'dept_code'   => $dept_code,
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

   public function removeTableDataDE(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new DepartmentM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->removeTableDataDE($table_id);
         if($result['status'] == true){
         }
      }

      $return_data['status'] = $status;
      echo json_encode($return_data);
   }//end 

   public function getTableDataDE(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new DepartmentM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->getTableDataDE($table_id);
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