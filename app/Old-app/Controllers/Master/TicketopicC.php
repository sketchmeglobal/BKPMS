<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AuthM;
use App\Models\Master\TicketopicM;

class TicketopicC extends BaseController
{
   public function index(){ 
      $session = session();
      if($session->logged_in == '') {
          return redirect()->to('logout');
      }else{
          $head_officeM = new TicketopicM();            
         $data['head'] = $head_officeM->findAll();            
         return view('master/ticket-topic', $data);
      }
   }

   public function formValidationTT(){
      if($this->request->isAJAX()) {
         $query = service('request')->getPost('query');
         $topic_name = $query['topic_name'];
         $table_id = $query['table_id'];

         $return_data = array();
         $status = true;
         $session = session();
         $officeM = new TicketopicM();
            
         $validation = \Config\Services::validation();
         $validation->setRules([
            'topic_name' => 'required',
            'table_id' => 'required'
         ]);

         $data = [
            'topic_name'   => $topic_name,
            'table_id' => $table_id
         ];
         $validatedData = array();

         if ($validation->run($data)) {
            $validatedData = $validation->getValidated(); 
            //print_r($validatedData);
            $result = $officeM->insertTableData($validatedData);

            $topic_id = 0;
            if($result['status'] == true){
               $status = true;
               $topic_id = $result['topic_id'];
               $return_data['topic_id'] = $topic_id;
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

   public function removeTableDataTT(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new TicketopicM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->removeTableDataTT($table_id);
         if($result['status'] == true){

         }
      }

      $return_data['status'] = $status;
      echo json_encode($return_data);
   }//end 

   public function getTableDataTT(){
      if($this->request->isAJAX()) {
         $return_data = array();
         $status = true;
         $officeM = new TicketopicM();

         $table_id = service('request')->getPost('table_id');
         $result = $officeM->getTableDataTT($table_id);
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