<?php

namespace App\Models;

use CodeIgniter\Model;

class SummaryreportM extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ticket_details';
    protected $primaryKey       = 'ticket_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ticket_id','topic_id', 'topic_name', 'ticket_subject', 'ticket_category', 'ticket_category_name', 'ticket_severity', 'ticket_severity_name', 'authority_cc', 'ticket_description', 'ticket_status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getTicketDetails($ticket_id){
      $hw_rows = $this->db->table('ticket_details')->select('ticket_details.ticket_id, ticket_details.ticket_number, ticket_details.topic_id, ticket_details.ticket_subject, ticket_details.ticket_category, ticket_details.ticket_severity, ticket_details.ticket_category, ticket_details.authority_cc, ticket_details.ticket_description, ticket_details.created_by, ticket_details.ticket_status, ticket_details.created_on, ticket_details.ol_id, ticket_severity_master.ticket_severity_name, ticket_severity_master.max_allowed_time, ticket_category_master.ticket_category_name, ticket_status_master.ticket_status_name, employee.emp_name, employee.email_id, ticket_comments.comment_description, ticket_comments.status_history, ticket_comments.accepted_by, ticket_comments.accepted_by_name, ticket_comments.accepted_at, ticket_comments.last_updated, oultlet.ol_name, oultlet.ol_location, topic_master.topic_name')->join('topic_master', 'topic_master.topic_id = ticket_details.topic_id')->join('ticket_severity_master', 'ticket_severity_master.ticket_severity_id = ticket_details.ticket_severity')->join('ticket_category_master', 'ticket_category_master.ticket_category_id = ticket_details.ticket_category')->join('ticket_status_master', 'ticket_status_master.ticket_status_id = ticket_details.ticket_status')->join('employee', 'employee.emp_id = ticket_details.created_by')->join('ticket_comments', 'ticket_comments.ticket_id = ticket_details.ticket_id')->join('oultlet', 'oultlet.ol_id = ticket_details.ol_id')->where(['ticket_details.ticket_id' => $ticket_id])->get()->getResult();
      //echo $this->db->getLastQuery();
      //die;

      return $hw_rows[0];
    }//end function  

    public function getTicketStatus(){
      $tic_stat_rows = $this->db->table('ticket_status_master')->select('*')->where(['row_status' => 1])->get()->getResult();      
      return $tic_stat_rows;
    }//end function

    public function getHolidayList(){
      $holiday_list = $this->db->table('holiday_list')->select('*')->where(['row_status' => 1])->get()->getResult();
      return $holiday_list;
    }//end function

    public function getReturnList($ticket_id){
      $return_lists = $this->db->table('hw_issue_return')->select('hw_issue_return.issue_return_id, hw_issue_return.ticket_id, hw_issue_return.ticket_no, hw_issue_return.hw_id, hw_issue_return.hw_sl_id, hw_issue_return.issue_or_return, hw_issue_return.issue_return_note, hardware.hw_name, hardware.hw_code, hardware_serial.serial_no')->join('hardware', 'hardware.hw_id = hw_issue_return.hw_id')->join('hardware_serial', 'hardware_serial.hw_id = hw_issue_return.hw_id')->where(['hw_issue_return.row_status' => 1, 'hw_issue_return.issue_or_return' => 2, 'hw_issue_return.ticket_id' => $ticket_id])->limit(100)->get()->getResult();
      return $return_lists;
    }//end function 

    public function getIssueList($ticket_id){
      $issue_lists = $this->db->table('hw_issue_return')
        ->select('hw_issue_return.issue_return_id, hw_issue_return.ticket_id, hw_issue_return.ticket_no, hw_issue_return.hw_id, hw_issue_return.hw_sl_id, hw_issue_return.issue_or_return, hw_issue_return.issue_return_note, hardware.hw_name, hardware.hw_code, hardware_serial.serial_no')
        ->join('hardware', 'hardware.hw_id = hw_issue_return.hw_id')
        ->join('hardware_serial', 'hardware_serial.hw_sl_id = hw_issue_return.hw_sl_id')
        ->where(['hw_issue_return.row_status' => 1, 'hw_issue_return.issue_or_return' => 1, 'hw_issue_return.ticket_id' => $ticket_id])
        ->limit(100)->get()->getResult();
      return $issue_lists;
    }//end function 

}