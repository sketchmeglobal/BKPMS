<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AuthM;
use App\Models\Master\HardwareStockEntryM;

class HardwareStockEntryC extends BaseController
{
   public function index(){ 
      $session = session();
      if($session->logged_in == '') {
          return redirect()->to('logout');
      }else{
         $head_officeM = new HardwareStockEntryM();            
         $data['rows'] = $head_officeM->getHwWithSerialNo();             
         $data['hw_rows'] = $head_officeM->getDeviceNameList();           
         return view('master/hardwarestockentry', $data);
      }
   }

   public function formValidationHWS(){
      if($this->request->isAJAX()) {
         $query = service('request')->getPost('query');
         $hw_id = $query['hw_id'];
         $serial_no = $query['serial_no'];
         $table_id = $query['table_id'];
         if(isset($query['deviceMetaData'])){
            $deviceMetaData = $query['deviceMetaData'];
         }else{
            $deviceMetaData = array();
         }

         $return_data = array();
         $status = true;
         $session = session();
         $officeM = new HardwareStockEntryM();
            
         $validation = \Config\Services::validation();
         $validation->setRules([
            'hw_id' => 'required',
            'serial_no' => 'required',
            'table_id' => 'required'
         ]);

         $data = [
            'hw_id'   => $hw_id,
            'serial_no'   => $serial_no,
            'table_id' => $table_id
         ];
         $validatedData = array();         

         $postData = [
            'hw_id'   => $hw_id,
            'serial_no'   => $serial_no,
            'table_id' => $table_id,
            'deviceMetaData' => $deviceMetaData
         ];

         if ($validation->run($data)) {
            $validatedData = $validation->getValidated(); 
            //print_r($validatedData);
            $result = $officeM->insertTableData($postData);

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

   public function removeTableDataHWS(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new HardwareStockEntryM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->removeTableDataHWS($table_id);
         if($result['status'] == true){

         }
      }

      $return_data['status'] = $status;
      echo json_encode($return_data);
   }//end 

   public function getTableDataHWS(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new HardwareStockEntryM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->getTableDataHWS($table_id);
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