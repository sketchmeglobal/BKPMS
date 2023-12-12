<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthM;
use App\Models\IssuehardwareM;

class IssuehardwareC extends BaseController
{
   public function index(){ 
      $session = session();
      if($session->logged_in == '') {
          return redirect()->to('logout');
      }else{
         $head_officeM = new IssuehardwareM();                
         $data['rows'] = $head_officeM->getAllIssuedHardware();    
         $data['hw_rows'] = $head_officeM->getDeviceNameList(); 
        //  echo '<pre>', print_r($data), '</pre>';
         return view('issuehardware', $data);
      }
   }   

   public function formValidationHIS(){
      if($this->request->isAJAX()) {
         $query = service('request')->getPost('query');
         $issue_or_return = $query['issue_or_return'];
         $ticketNo = $query['ticketNo'];
         $hw_id = $query['hw_id'];
         $hw_sl_id = $query['hw_sl_id'];
         $issueNote = $query['issueNote'];
         $table_id = $query['table_id'];
         $ticket_id = $query['ticket_id'];

         $return_data = array();
         $status = true;
         $session = session();
         $officeM = new IssuehardwareM();
            
         $validation = \Config\Services::validation();
         $validation->setRules([
            'ticketNo' => 'required',
            'hw_id' => 'required',
            'hw_sl_id' => 'required',
            'table_id' => 'required',
            'ticket_id' => 'required'
         ]);

         $data = [
            'ticketNo' => $ticketNo,
            'hw_id' => $hw_id,
            'hw_sl_id' => $hw_sl_id,
            'table_id' => $table_id,
            'ticket_id' => $ticket_id
         ];
         $validatedData = array();

         if ($validation->run($data)) {
            $validatedData = $validation->getValidated(); 
            //print_r($validatedData);            

            $post_data = [
               'issue_or_return' => $issue_or_return,
               'ticketNo' => $ticketNo,
               'hw_id' => $hw_id,
               'hw_sl_id' => $hw_sl_id,
               'issueNote' => $issueNote,
               'table_id' => $table_id,
               'ticket_id' => $ticket_id
            ];
            
            $result = $officeM->insertTableData($post_data);

            //echo '****** return form model *******';
            //echo json_encode($result);
            //echo 'ho id: ' . $result['ho_id'];
            $issue_return_id = 0;
            if($result['status'] == true){
               $status = true;
               $issue_return_id = $result['issue_return_id'];
               $return_data['issue_return_id'] = $issue_return_id;
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

   public function checkTicketStatus(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $message = '';
         $ticket_id = 0;
         $officeM = new IssuehardwareM();

         $ticketNo = service('request')->getPost('ticketNo');
         $result = $officeM->checkTicketStatus($ticketNo);
         if($result['status'] == true){
            $ticket_id = $result['ticket_id'];
            $status = true;            
         }else{
            $status = false;
         }
         $message = $result['message'];
      }

      $return_data['status'] = $status;
      $return_data['message'] = $message;
      $return_data['ticket_id'] = $ticket_id;
      echo json_encode($return_data);
   }//end 

   public function getHwSerialNo(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $message = '';
         $officeM = new IssuehardwareM();

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
         $officeM = new IssuehardwareM();

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
         $officeM = new IssuehardwareM();

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
         $officeM = new IssuehardwareM();

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
