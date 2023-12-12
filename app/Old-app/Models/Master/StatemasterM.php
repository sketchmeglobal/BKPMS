<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class StatemasterM extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'state_master';
    protected $primaryKey       = 'state_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['state_id','state_name', 'state_code'];

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


    public function getAllStates(){
      $rows = $this->db->table('state_master')->select('*')->where(['row_status' => 1, 'parent_id' => 0])->get()->getResult();
      return $rows;
    }//end function

    public function insertTableData($validatedData){
      $status = true;
      $return_data = array();
      $ho_id = 0;
      $table_id = $validatedData['table_id'];

      $fields_array = [
        'state_name'     => $validatedData['state_name'],
        'state_code'  => $validatedData['state_code'],
      ];

      if($table_id > 0){
        //update query
        $this->db->table('state_master')->update($fields_array, ['state_id' => $table_id]);
      }else{
        //insert query
        $this->db->table('state_master')->insert($fields_array);
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

    public function removeTableDataST($table_id){
      $status = true;
      $return_data = array();

      $this->db->table('state_master')->where('state_id', $table_id)->delete();

      $return_data['status'] = $status;
      return $return_data;
    }//end function

    public function getTableDataST($table_id){
      $status = true;
      $return_data = array();

      $row = $this->db->table('state_master')->select('*')->where(['row_status' => 1, 'state_id' => $table_id])->get()->getResult();

      $return_data['status'] = $status;
      $return_data['row'] = $row;
      return $return_data;
    }//end function
}