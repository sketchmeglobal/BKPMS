<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthM;
use App\Models\SummaryreportM;

class SummaryreportC extends BaseController
{
   public function index($ticket_id){  
      $session = session();
      if($session->logged_in == '') {
          return redirect()->to('logout');
      }else{
          $head_officeM = new SummaryreportM();                
         $data['rows'] = $head_officeM->getTicketDetails($ticket_id);               
         $data['tic_stat_rows'] = $head_officeM->getTicketStatus();             
         $data['holiday_list'] = $head_officeM->getHolidayList();           
         $data['return_lists'] = $head_officeM->getReturnList($ticket_id);          
         $data['issue_lists'] = $head_officeM->getIssueList($ticket_id);
         return view('reports/summary_report', $data);
      }
   }

   public function ticket_progress_report($ticket_id) {
       $session = session();
       if($session->logged_in == '') {
           return redirect()->to('logout');
       }else{
           $head_officeM = new SummaryreportM();
           $data['rows'] = $head_officeM->getTicketDetails($ticket_id);
           $data['tic_stat_rows'] = $head_officeM->getTicketStatus();
           $data['holiday_list'] = $head_officeM->getHolidayList();
           $data['return_lists'] = $head_officeM->getReturnList($ticket_id);
           $data['issue_lists'] = $head_officeM->getIssueList($ticket_id);
           return view('reports/ticket_progress_report', $data);
       }
   }

}
