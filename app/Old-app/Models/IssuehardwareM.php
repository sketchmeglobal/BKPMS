<?php

namespace App\Models;

use CodeIgniter\Model;

class IssuehardwareM extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'hw_issue_return';
    protected $primaryKey       = 'issue_return_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['issue_return_id','ticket_id', 'ticket_no', 'hw_id', 'hw_sl_id', 'issue_return_note', 'issue_or_return'];

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

    public function getAllIssuedHardware(){
      $rows = $this->db
        ->table('hw_issue_return')
        ->select('hw_issue_return.issue_return_id, hw_issue_return.ticket_id, hw_issue_return.ticket_no, hw_issue_return.hw_id, hw_issue_return.hw_sl_id, hw_issue_return.issue_or_return, hw_issue_return.issue_return_note, hardware.hw_name, hardware.hw_code, hardware_serial.serial_no')
        ->join('hardware', 'hardware.hw_id = hw_issue_return.hw_id', 'left')
        ->join('hardware_serial', 'hardware_serial.hw_sl_id = hw_issue_return.hw_sl_id', 'left')
        ->where(['hw_issue_return.row_status' => 1])
        ->limit(100)->get()->getResult();
      return $rows;
    }//end function 

    public function insertTableData($validatedData){
      $status = true;
      $return_data = array();
      $ho_id = 0;
      $table_id = $validatedData['table_id'];
      $ticketNo = $validatedData['ticketNo'];
      $hw_id = $validatedData['hw_id'];
      $hw_sl_id = $validatedData['hw_sl_id'];
      $issueNote = $validatedData['issueNote'];
      $issue_or_return = $validatedData['issue_or_return'];
      $ticket_id = $validatedData['ticket_id'];
      $issue_return_id = 0;

      $fields_array = [
        'ticket_id' => $ticket_id,
        'ticket_no' => $ticketNo,
        'hw_id' => $hw_id,
        'hw_sl_id' => $hw_sl_id,
        'issue_return_note' => $issueNote,
        'issue_or_return' => $issue_or_return
      ];

      if($table_id > 0){
        //update query
        $this->db->table('hw_issue_return')->update($fields_array, ['issue_return_id' => $table_id]);
      }else{
        //insert query
        $this->db->table('hw_issue_return')->insert($fields_array);
        $issue_return_id = $this->db->insertID();
        if($issue_return_id > 0){
          $status = true;          
        }else{
          $status = false;
        }
      }

      $return_data['issue_return_id'] = $issue_return_id;
      $return_data['status'] = $status;
      return $return_data;
    }

    public function removeTableDataEM($table_id){
      $status = true;
      $return_data = array();

      $this->db->table('hw_issue_return')->where('issue_return_id', $table_id)->delete();

      $return_data['status'] = $status;
      return $return_data;
    }//end function

    public function getTableDataHIS($table_id){
      $status = true;
      $return_data = array();

      $row = $this->db->table('hw_issue_return')->select('*')->where(['row_status' => 1, 'issue_return_id' => $table_id])->get()->getResult();

      $return_data['status'] = $status;
      $return_data['row'] = $row;
      return $return_data;
    }//end function
    

    public function getDeviceSerialonHIS($hw_id){
      $status = true;
      $return_data = array();

      $row = $this->db->table('hardware_serial')->select('*')->where(['row_status' => 1, 'hw_id' => $hw_id])->get()->getResult();

      $option_text = '<option value="0">Select</option>';
      for($i = 0; $i < sizeof($row); $i++){
        $option_text .= '<option value="'.$row[$i]->hw_sl_id.'">'.$row[$i]->serial_no.'</option>';
      }//end for

      $return_data['status'] = $status;
      $return_data['option_text'] = $option_text;

      return $return_data;
    }//end function


    public function getDesigTableDataEM(){
      $request = \Config\Services::request();
      $ho_id = $request->getPost('ho_id');      
      $wh_id = $request->getPost('wh_id');     
      $ol_id = $request->getPost('ol_id');

      $data = array();
      $particulars = array();
      $invoice_details = array();
      $inv_paymentHistory = array();

      $result = $this->db->table('hw_issue_return')->select('*')->where(['ho_id' => $ho_id, 'wh_id' => $wh_id, 'ol_id' => $ol_id, 'row_status' => 1 ])->get()->getResult();

      //echo json_encode($result);

      $counter = 1;
      if(count($result) > 0){
        for($i = 0; $i < sizeof($result); $i++){
          $nestedData['slNo'] = $counter;
          $nestedData['ticket_id'] = $result[$i]->ticket_id;
          $nestedData['primary_phone'] = $result[$i]->primary_phone;
          $nestedData['secondary_phone'] = $result[$i]->secondary_phone;
          $nestedData['email_id'] = $result[$i]->email_id;
          $nestedData['action'] = '<td class="d-flex justify-content-evenly"><a href="javascript: void(0);" class="edit_class" data-table_id="'.$result[$i]->issue_return_id.'"><i class="fa fa-edit"></i></a> <a class="remove" href="javascript: void(0);"><i class="fas fa-times" data-table_id="'.$result[$i]->issue_return_id.'"></i></a></td>';

          $counter++;
          array_push($data, $nestedData);
        }
      }
      $json_data = array(
          "recordsTotal"    => sizeof($data),
          "recordsFiltered" => sizeof($data),
          "data"            => $data
      );       
      
      return $json_data;
    }//end function    

    public function checkTicketStatus($ticketNo){
      $status = true;
      $ticket_id = 0;
      $return_data = array();

      $row = $this->db->table('ticket_details')->select('*')->where([ 'ticket_number' => $ticketNo ])->get()->getResult();
      $arr_size = sizeof($row);
      if($arr_size > 0){
        $ticket_status = $row[0]->ticket_status;
        $ticket_id = $row[0]->ticket_id;
        if($ticket_status == 8){
          $status = true;
          $message = 'SR Requested and Approved';
        }else{
          $status = false;
          $message = 'SR Pending';
        }        
      }else{
        $status = false;
        $message = 'Invallid ticket number';
      }

      $return_data['status'] = $status;
      $return_data['message'] = $message;
      $return_data['ticket_id'] = $ticket_id;
      return $return_data;
    }//end function   

    public function getHwSerialNo($hw_id){
      $status = true;
      $return_data = array();      

      $row = $this->db
        ->table('hardware_serial')
        ->select('hardware_serial.*,hw_issue_return.issue_return_id')
        ->join('hw_issue_return','hw_issue_return.hw_sl_id=hardware_serial.hw_sl_id AND hw_issue_return.issue_or_return = 1','left')
        ->where(['hardware_serial.row_status' => 1, 'hardware_serial.hw_id' => $hw_id ])
        ->get()->getResult();

      $option_text = '<option value="0">Select</option>';
      for($i = 0; $i < sizeof($row); $i++){
          if($row[$i]->issue_return_id > 0 ){
            $option_text .= '<option value="'.$row[$i]->hw_sl_id.'">'.$row[$i]->serial_no.'</option>';      
          } 
      }//end for

      $return_data['status'] = $status;
      $return_data['option_text'] = $option_text;

      return $return_data;
    }//end function

    public function getDeviceNameList(){
      $hw_rows = $this->db->table('hardware')->select('*')->where(['row_status' => 1])->get()->getResult();
      return $hw_rows;
    }//end function    

    public function removeTableDataHIS($table_id){
      $status = true;
      $return_data = array();

      $this->db->table('hw_issue_return')->where('issue_return_id', $table_id)->delete();

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