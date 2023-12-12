<?php

namespace App\Models;

use CodeIgniter\Model;

class UserstaskreportM extends Model
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

    public function getAllTickets($ol_id, $from_date, $to_date){
      $rows = $this->db->table('ticket_details')->select('ticket_details.ticket_id, ticket_details.ticket_number, ticket_details.topic_id, ticket_details.ticket_subject, ticket_details.ticket_category, ticket_details.ticket_severity, ticket_details.ticket_category, ticket_details.created_on, ticket_details.created_by, ticket_details.ticket_status, ticket_status_master.ticket_status_name, ticket_severity_master.ticket_severity_name, ticket_category_master.ticket_category_name, employee.emp_name, employee.email_id, ticket_comments.accepted_by_name, ticket_comments.accepted_at,')->join('ticket_severity_master', 'ticket_severity_master.ticket_severity_id = ticket_details.ticket_severity')->join('ticket_category_master', 'ticket_category_master.ticket_category_id = ticket_details.ticket_category')->join('employee', 'employee.emp_id = ticket_details.created_by')->join('ticket_comments', 'ticket_comments.ticket_id = ticket_details.ticket_id')->join('ticket_status_master', 'ticket_status_master.ticket_status_id = ticket_details.ticket_status')->where(['ticket_details.row_status' => 1, 'ticket_details.ol_id' => $ol_id])->orderBy('ticket_details.ticket_id', 'DESC')->limit(100)->get()->getResult();
      return $rows;
    }//end function 
    


}