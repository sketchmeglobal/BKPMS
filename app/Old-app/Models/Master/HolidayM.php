<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class HolidayM extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'holiday_list';
    protected $primaryKey       = 'hl_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['hl_id','hl_date', 'hl_description'];

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
        'hl_date'     => $validatedData['hl_date'],
        'hl_description'  => $validatedData['hl_description'],
      ];

      if($table_id > 0){
        //update query
        $this->db->table('holiday_list')->update($fields_array, ['hl_id' => $table_id]);
      }else{
        //insert query
        $this->db->table('holiday_list')->insert($fields_array);
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

    public function removeTableDataHL($table_id){
      $status = true;
      $return_data = array();

      $this->db->table('holiday_list')->where('hl_id', $table_id)->delete();

      $return_data['status'] = $status;
      return $return_data;
    }//end function

    public function getTableDataHL($table_id){
      $status = true;
      $return_data = array();

      $row = $this->db->table('holiday_list')->select('*')->where(['row_status' => 1, 'hl_id' => $table_id])->get()->getResult();

      $return_data['status'] = $status;
      $return_data['row'] = $row;
      return $return_data;
    }//end function
}