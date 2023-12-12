<?php

namespace App\Models;

use CodeIgniter\Model;

class AllticketM extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'ticket_details';
    protected $primaryKey = 'ticket_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['ticket_id', 'topic_id', 'topic_name', 'ticket_subject', 'ticket_category', 'ticket_category_name', 'ticket_severity', 'ticket_severity_name', 'authority_cc', 'ticket_description', 'ticket_status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function getAllTickets($emp_id) {
        //get all ticket_ids referred to this user
        $sr_route_rs = $this->db->table('ticket_sr_approval_route')->where(['emp_id'=>$emp_id,'active'=>1])->get()->getResultArray();
        $ticket_ids = array_column($sr_route_rs, 'ticket_id');

        $builder = $this->db->table('ticket_details')
            ->select('ticket_details.ticket_id, ticket_details.ticket_number, ticket_details.topic_id, ticket_details.ticket_subject, ticket_details.ticket_category, ticket_details.ticket_severity, ticket_details.ticket_category, ticket_details.created_on, ticket_details.created_by, ticket_details.ticket_status, ticket_status_master.ticket_status_id, ticket_status_master.ticket_status_name, ticket_severity_master.ticket_severity_id, ticket_severity_master.ticket_severity_name, master_ticket_category.ticket_category_name, master_employee.emp_name, master_employee.email_id, ticket_comments.accepted_by_name, ticket_comments.accepted_at, ticket_comments.status_history')
            ->join('ticket_severity_master', 'ticket_severity_master.ticket_severity_id = ticket_details.ticket_severity')
            ->join('master_ticket_category', 'master_ticket_category.ticket_category_id = ticket_details.ticket_category')
            ->join('employee', 'employee.emp_id = ticket_details.created_by')
            ->join('ticket_comments', 'ticket_comments.ticket_id = ticket_details.ticket_id')
            ->join('ticket_status_master', 'ticket_status_master.ticket_status_id = ticket_details.ticket_status')
            ->where([
                'ticket_details.row_status' => 1, //ticket active
                'ticket_details.created_by !=' => $emp_id, //skip own created tickets
            ])
            ->groupStart();
        $builder->where('ticket_details.ticket_status', 1); //ticket status open
        if (session('emp_gr_id')) { //if this user belongs to any group
            $builder->orWhere('ticket_details.emp_gr_id', session('emp_gr_id')); //user belongs to a group, to where the ticket is delegated
        }
        $builder->orWhere('ticket_comments.accepted_by', $emp_id); //accepted tickets
        if (count($ticket_ids) > 0) {
            $builder->orWhereIn('ticket_details.ticket_id', $ticket_ids); //awaiting SR approval from this user (table: ticket_sr_approval_route)
        }
        $builder->orWhere(' JSON_CONTAINS(JSON_EXTRACT(ticket_comments.status_history, "$[*].updated_by"), \'"'.$emp_id.'"\', "$") '); //ticket status updated by this user
        $tickets_rs = $builder->groupEnd()
            ->orderBy('ticket_details.ticket_id', 'DESC')
            ->limit(100)
            ->get()->getResult();
//        echo $this->db->getLastQuery();die();

        return $tickets_rs;
    }

    

    public function insertTableData($validatedData)
    {
        $status = true;
        $return_data = array();

        $topic_id = $validatedData['topic_id'];
        $ticket_subject = $validatedData['ticket_subject'];
        $ticket_category = $validatedData['ticket_category'];
        $ticket_severity = $validatedData['ticket_severity'];
        $authority_cc = $validatedData['authority_cc'];
        $ticket_description = $validatedData['ticket_description'];

        $topic_name = $validatedData['topic_name'];
        $ticket_category_name = $validatedData['ticket_category_name'];
        $ticket_severity_name = $validatedData['ticket_severity_name'];

        $fields_array = [
            'topic_id' => $topic_id,
            'topic_name' => $topic_name,
            'ticket_subject' => $ticket_subject,
            'ticket_category' => $ticket_category,
            'ticket_category_name' => $ticket_category_name,
            'ticket_severity' => $ticket_severity,
            'ticket_severity_name' => $ticket_severity_name,
            'authority_cc' => $authority_cc,
            'ticket_description' => $ticket_description
        ];

        //insert query
        $this->db->table('ticket_details')->insert($fields_array);
        $ticket_id = $this->db->insertID();
        if ($ticket_id > 0) {
            $status = true;
        } else {
            $status = false;
        }

        $return_data['ticket_id'] = $ticket_id;
        $return_data['status'] = $status;
        return $return_data;
    }

    public function removeTableDataEM($table_id)
    {
        $status = true;
        $return_data = array();

        $this->db->table('ticket_details')->where('ticket_id', $table_id)->delete();

        $return_data['status'] = $status;
        return $return_data;
    }//end function

    public function getTableDataHIS($table_id)
    {
        $status = true;
        $return_data = array();

        $row = $this->db->table('ticket_details')->select('*')->where(['row_status' => 1, 'ticket_id' => $table_id])->get()->getResult();

        $return_data['status'] = $status;
        $return_data['row'] = $row;
        return $return_data;
    }//end function


    public function getDeviceSerialonHIS($hw_id)
    {
        $status = true;
        $return_data = array();

        $row = $this->db->table('hardware_serial')->select('*')->where(['row_status' => 1, 'hw_id' => $hw_id])->get()->getResult();

        $option_text = '<option value="0">Select</option>';
        for ($i = 0; $i < sizeof($row); $i++) {
            $option_text .= '<option value="' . $row[$i]->hw_sl_id . '">' . $row[$i]->serial_no . '</option>';
        }//end for

        $return_data['status'] = $status;
        $return_data['option_text'] = $option_text;

        return $return_data;
    }//end function


    public function getDesigTableDataEM()
    {
        $request = \Config\Services::request();
        $ho_id = $request->getPost('ho_id');
        $wh_id = $request->getPost('wh_id');
        $ol_id = $request->getPost('ol_id');

        $data = array();
        $particulars = array();
        $invoice_details = array();
        $inv_paymentHistory = array();

        $result = $this->db->table('ticket_details')->select('*')->where(['ho_id' => $ho_id, 'wh_id' => $wh_id, 'ol_id' => $ol_id, 'row_status' => 1])->get()->getResult();

        //echo json_encode($result);

        $counter = 1;
        if (count($result) > 0) {
            for ($i = 0; $i < sizeof($result); $i++) {
                $nestedData['slNo'] = $counter;
                $nestedData['ticket_id'] = $result[$i]->ticket_id;
                $nestedData['primary_phone'] = $result[$i]->primary_phone;
                $nestedData['secondary_phone'] = $result[$i]->secondary_phone;
                $nestedData['email_id'] = $result[$i]->email_id;
                $nestedData['action'] = '<td class="d-flex justify-content-evenly"><a href="javascript: void(0);" class="edit_class" data-table_id="' . $result[$i]->ticket_id . '"><i class="fa fa-edit"></i></a> <a class="remove" href="javascript: void(0);"><i class="fas fa-times" data-table_id="' . $result[$i]->ticket_id . '"></i></a></td>';

                $counter++;
                array_push($data, $nestedData);
            }
        }
        $json_data = array(
            "recordsTotal" => sizeof($data),
            "recordsFiltered" => sizeof($data),
            "data" => $data
        );

        return $json_data;
    }//end function    

    public function checkTicketStatus($ticketNo)
    {
        $status = true;
        $message = 'Invallid ticket number';
        $return_data = array();

        //$this->db->table('ticket_details')->where('ticket_id', $table_id)->delete();

        $return_data['status'] = $status;
        $return_data['message'] = $message;
        return $return_data;
    }//end function   

    public function getHwSerialNo($hw_id)
    {
        $status = true;
        $return_data = array();

        $row = $this->db->table('hardware_serial')->select('*')->where(['row_status' => 1, 'hw_id' => $hw_id])->get()->getResult();

        $option_text = '<option value="0">Select</option>';
        for ($i = 0; $i < sizeof($row); $i++) {
            $option_text .= '<option value="' . $row[$i]->hw_sl_id . '">' . $row[$i]->serial_no . '</option>';
        }//end for

        $return_data['status'] = $status;
        $return_data['option_text'] = $option_text;

        return $return_data;
    }//end function  

    public function removeTableDataHIS($table_id)
    {
        $status = true;
        $return_data = array();

        $this->db->table('ticket_details')->where('ticket_id', $table_id)->delete();

        $return_data['status'] = $status;
        return $return_data;
    }//end function


    /*public function getAllHeadOffice(){
      $ho_rows = $this->db->table('head_office')->select('*')->where(['row_status' => 1])->get()->getResult();      
      return $ho_rows;
    }//end function

    public function getAllWareHouse(){
      $wh_rows = $this->db->table('ware_house')->select('*')->where(['row_status' => 1])->get()->getResult();
      return $wh_rows;
    }//end function

    public function getAllOutlet(){
      $ol_rows = $this->db->table('oultlet')->select('*')->where(['row_status' => 1])->get()->getResult();
      return $ol_rows;
    }//end function

    public function getDesignation(){
      $ol_rows = $this->db->table('oultlet')->select('*')->where(['row_status' => 1])->get()->getResult();
      return $ol_rows;
    }//end function*/


}