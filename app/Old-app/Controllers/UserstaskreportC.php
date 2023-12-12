<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthM;
use App\Models\UserstaskreportM;

class UserstaskreportC extends BaseController
{
   public function index(){  
      $session = session();
      if($session->logged_in == '') {
          return redirect()->to('logout');
      }else{               
         $head_officeM = new UserstaskreportM();  
         $ol_id = $session->ol_id;  
         $data['status'] = true;
         //$data['rows'] = $head_officeM->getAllTickets($ol_id);
         return view('reports/user_task_search', $data);
      }
   }  
   
   public function getSearchResult(){
      $from_date = $this->request->getVar('from_date');
      $to_date = $this->request->getVar('to_date');

      $return_data = array();
      $status = true;
      $session = session();
      $officeM = new UserstaskreportM();           

      $post_data = [
         'from_date' => $from_date,
         'to_date' => $to_date
      ]; 

      $ol_id = $session->ol_id;              
      
      $rows = $officeM->getAllTickets($ol_id, $from_date, $to_date);
      
      $issue_return_id = 0;
      $data['rows'] = $rows;  

      return view('reports/user_task_report', $data);    
         
   }

}
