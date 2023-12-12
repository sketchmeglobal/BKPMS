<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class HeadofficeM extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'head_office';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','name', 'location'];

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
      $this->db->table('head_office')->insert($ins_data);
      return true;
    }

    public function insertTableData($validatedData){
      $status = true;
      $return_data = array();
      $ho_id = 0;
      $table_id = $validatedData['table_id'];

      $fields_array = [
        'ho_name'     => $validatedData['headofficeName'],
        'ho_location'  => $validatedData['headofficeLocation'],
      ];

      if($table_id > 0){
        //update query
        //$this->db->table('head_office')->update($fields_array)->where('id', $table_id);
        $this->db->table('head_office')->update($fields_array, ['id' => $table_id]);
      }else{
        //insert query
        $this->db->table('head_office')->insert($fields_array);
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

    // public function select(){  
    //   return $this->db->table('head_office')->select('*')->where(['row_status' => 1])->get()->getResult();
    // } 

    public function removeTableData($table_id){
      $status = true;
      $return_data = array();

      $this->db->table('head_office')->where('id', $table_id)->delete();

      $return_data['status'] = $status;
      return $return_data;
    }//end function

    public function getTableData($table_id){
      $status = true;
      $return_data = array();

      $row = $this->db->table('head_office')->select('*')->where(['row_status' => 1, 'id' => $table_id])->get()->getResult();

      $return_data['status'] = $status;
      $return_data['row'] = $row;
      return $return_data;
    }//end function
}