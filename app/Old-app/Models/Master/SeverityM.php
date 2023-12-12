<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class SeverityM extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ticket_severity_master';
    protected $primaryKey       = 'ticket_severity_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ticket_severity_id','ticket_severity_name', 'max_allowed_time'];

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
   

    public function insertTableData($validatedData){
      $status = true;
      $return_data = array();
      $ho_id = 0;
      $table_id = $validatedData['table_id'];

      $fields_array = [
        'ticket_severity_name'     => $validatedData['ticket_severity_name'],
        'max_allowed_time'  => $validatedData['max_allowed_time'],
      ];

      if($table_id > 0){
        //update query
        $this->db->table('ticket_severity_master')->update($fields_array, ['ticket_severity_id' => $table_id]);
      }else{
        //insert query
        $this->db->table('ticket_severity_master')->insert($fields_array);
        $ho_id = $this->db->insertID();
        if($ho_id > 0){
          $status = true;          
        }else{
          $status = false;
        }
      }

      $return_data['status'] = $status;
      $return_data['ho_id'] = $ho_id;
      return $return_data;
    }

    public function removeTableDataSE($table_id){
      $status = true;
      $return_data = array();

      $this->db->table('ticket_severity_master')->where('ticket_severity_id', $table_id)->delete();

      $return_data['status'] = $status;
      return $return_data;
    }//end function

    public function getTableDataSE($table_id){
      $status = true;
      $return_data = array();

      $row = $this->db->table('ticket_severity_master')->select('*')->where(['row_status' => 1, 'ticket_severity_id' => $table_id])->get()->getResult();

      $return_data['status'] = $status;
      $return_data['row'] = $row;
      return $return_data;
    }//end function
}