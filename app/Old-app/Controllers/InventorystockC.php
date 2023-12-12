<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthM;
use App\Models\InventorystockM;

class InventorystockC extends BaseController
{
   public function index(){ 
      $session = session();
      if($session->logged_in == '') {
          return redirect()->to('logout');
      }else{
         $head_officeM = new InventorystockM();                
         //$data['rows'] = $head_officeM->getAllFilteredHardware();    
         $data['hw_rows'] = $head_officeM->getDeviceNameList(); 
         return view('reports/inventorystock', $data);
      }
   }   

   public function formValidationRIS(){
      $issue_or_return = $this->request->getVar('issue_or_return');
      $hw_id = $this->request->getVar('hw_id');
      $from_date = $this->request->getVar('from_date');
      $to_date = $this->request->getVar('to_date');

      $return_data = array();
      $status = true;
      $session = session();
      $officeM = new InventorystockM();           

      $post_data = [
         'issue_or_return' => $issue_or_return,
         'hw_id' => $hw_id,
         'from_date' => $from_date,
         'to_date' => $to_date
      ];
      
      $result = $officeM->getAllFilteredHardware($post_data);
      
      $issue_return_id = 0;
      $data['rows'] = $result;  
      $data['hw_rows'] = $officeM->getDeviceNameList(); 

      return view('reports/inventory_stock_report', $data);    
         
   }

     public function checkTicketStatus(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $message = '';
         $officeM = new InventorystockM();

         $ticketNo = service('request')->getPost('ticketNo');
         $result = $officeM->checkTicketStatus($ticketNo);
         if($result['status'] == true){
            $status = true;            
         }else{
            $status = false;
         }
         $message = $result['message'];
      }

      $return_data['status'] = $status;
      $return_data['message'] = $message;
      echo json_encode($return_data);
   }//end 

   public function getHwSerialNo(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $message = '';
         $officeM = new InventorystockM();

         $hw_id = service('request')->getPost('hw_id');
         $result = $officeM->getHwSerialNo($hw_id);
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

   public function removeTableDataHIS(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new InventorystockM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->removeTableDataHIS($table_id);
         if($result['status'] == true){
         }
      }

      $return_data['status'] = $status;
      echo json_encode($return_data);
   }//end 

   public function getTableDataHIS(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new InventorystockM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->getTableDataHIS($table_id);
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

   public function getDeviceSerialonHIS(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new InventorystockM();

         $hw_id = service('request')->getPost('hw_id');

         $result = $officeM->getDeviceSerialonHIS($hw_id);
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

}
