<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AuthM;
use App\Models\Master\TickecategoryM;

class TickecategoryC extends BaseController
{
   public function index(){ 
      $session = session();
      if($session->logged_in == '') {
          return redirect()->to('logout');
      }else{
          $head_officeM = new TickecategoryM();           
          $data['rows'] = $head_officeM->getAllTicketCategory();            
          $data['tt_rows'] = $head_officeM->getAllTicketTopic();           
         return view('master/ticket-category', $data);
      }
   }

   public function formValidationTC(){
      if($this->request->isAJAX()) {
         $query = service('request')->getPost('query');
         $topic_id = $query['topic_id'];
         $ticket_category_name = $query['ticket_category_name'];
         $table_id = $query['table_id'];

         $return_data = array();
         $status = true;
         $session = session();
         $officeM = new TickecategoryM();
            
         $validation = \Config\Services::validation();
         $validation->setRules([
            'topic_id' => 'required',
            'ticket_category_name' => 'required',
            'table_id' => 'required'
         ]);

         $data = [
            'topic_id' => $topic_id,
            'ticket_category_name' => $ticket_category_name,
            'table_id' => $table_id
         ];
         $validatedData = array();

         if ($validation->run($data)) {
            $validatedData = $validation->getValidated(); 
            //print_r($validatedData);
            $result = $officeM->insertTableData($validatedData);

            $ticket_category_id = 0;
            if($result['status'] == true){
               $status = true;
               $ticket_category_id = $result['ticket_category_id'];
               $return_data['ticket_category_id'] = $ticket_category_id;
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

   public function removeTableDataTC(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new TickecategoryM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->removeTableDataTC($table_id);
         if($result['status'] == true){

         }
      }

      $return_data['status'] = $status;
      echo json_encode($return_data);
   }//end 

   public function getTableDataTC(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new TickecategoryM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->getTableDataTC($table_id);
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