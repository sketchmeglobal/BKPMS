<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class DepartmentM extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'departments';
    protected $primaryKey       = 'de_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['de_id','dept_name', 'dept_code'];

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


    public function office($ins_data){
      $this->db->table('departments')->insert($ins_data);
      return true;
    }

    public function insertTableData($validatedData){
      $status = true;
      $return_data = array();
      $ho_id = 0;
      $table_id = $validatedData['table_id'];

      $fields_array = [
        'dept_name'     => $validatedData['dept_name'],
        'dept_code'  => $validatedData['dept_code'],
      ];

      if($table_id > 0){
        //update query
        $this->db->table('departments')->update($fields_array, ['de_id' => $table_id]);
      }else{
        //insert query
        $this->db->table('departments')->insert($fields_array);
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

    public function removeTableDataDE($table_id){
      $status = true;
      $return_data = array();

      $this->db->table('departments')->where('de_id', $table_id)->delete();

      $return_data['status'] = $status;
      return $return_data;
    }//end function

    public function getTableDataDE($table_id){
      $status = true;
      $return_data = array();

      $row = $this->db->table('departments')->select('*')->where(['row_status' => 1, 'de_id' => $table_id])->get()->getResult();

      $return_data['status'] = $status;
      $return_data['row'] = $row;
      return $return_data;
    }//end function
}