<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AuthM;
use App\Models\Master\DesignationM;

class DesignationC extends BaseController
{
   public function index(){
      $session = session();
      if($session->logged_in == '') {
          return redirect()->to('logout');
      }else{
          $head_officeM = new DesignationM();            
         $data['rows'] = $head_officeM->getAllDesignation();           
         $data['ho_rows'] = $head_officeM->getAllHeadOffice();           
         $data['wh_rows'] = $head_officeM->getAllWareHouse();           
         $data['ol_rows'] = $head_officeM->getAllOutlet();            
         return view('master/designation', $data);
      }
   }

   public function formValidationDG(){
      if($this->request->isAJAX()) {
         $query = service('request')->getPost('query');
         $desig_name = $query['desig_name'];
         $desig_priority = $query['desig_priority'];
         $table_id = $query['table_id'];
         // $ho_id = $query['ho_id'];
         // $wh_id = $query['wh_id'];
         // $ol_id = $query['ol_id'];

         $return_data = array();
         $status = true;
         $session = session();
         $officeM = new DesignationM();
            
         $validation = \Config\Services::validation();
         $validation->setRules([
            'desig_name' => 'required|min_length[1]',
            'desig_priority' => 'required|min_length[1]',
            'table_id' => 'required'
         ]);

         $data = [
            'desig_name'   => $desig_name,
            'desig_priority'   => $desig_priority,
            'table_id' => $table_id
         ];
         $validatedData = array();

         if ($validation->run($data)) {
            $validatedData = $validation->getValidated(); 
            //print_r($validatedData);
            $result = $officeM->insertTableData($validatedData);
            
            if($result['status'] == true){
               $status = true;
               $dg_id = $result['dg_id'];
               $return_data['dg_id'] = $dg_id;
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

   public function removeTableDataDG(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new DesignationM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->removeTableDataDG($table_id);
         if($result['status'] == true){

         }
      }

      $return_data['status'] = $status;
      echo json_encode($return_data);
   }//end 

   public function getTableDataDG(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new DesignationM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->getTableDataDG($table_id);
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

   public function getDesigTableData(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new DesignationM();

         $ho_id = service('request')->getPost('ho_id');
         $wh_id = service('request')->getPost('wh_id');
         $ol_id = service('request')->getPost('ol_id');

         $result = $officeM->getDesigTableData($ho_id, $wh_id, $ol_id);
         echo json_encode($result);
         
         // if($result['status'] == true){
         //    $status = true;
         //    $row = $result['row'];
         //    echo json_encode($row);
         //    $result = $row[0];
         //    $return_data['result'] = $result;
         // }else{
         //    $status = false;
         // }
      }

      // $return_data['status'] = $status;
      // echo json_encode($return_data);
      
   }//end 

}