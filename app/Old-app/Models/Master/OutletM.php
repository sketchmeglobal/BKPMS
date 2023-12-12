<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class OutletM extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'oultlet';
    protected $primaryKey       = 'ol_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ol_id','ol_name', 'ol_location'];

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
      $this->db->table('oultlet')->insert($ins_data);
      return true;
    }

    public function insertTableData($validatedData){
      $status = true;
      $return_data = array();
      $ho_id = 0;
      $table_id = $validatedData['table_id'];
      $state_name = $validatedData['state_name'];
      $city_name = $validatedData['city_name'];

      $fields_array = [
        'state_id' => $state_name,
        'city_id' => $city_name,
        'ol_name'     => $validatedData['ol_name'],
        'ol_location'  => $validatedData['ol_location'],
      ];

      if($table_id > 0){
        //update query
        //$this->db->table('oultlet')->update($fields_array)->where('ol_id', $table_id);
        $this->db->table('oultlet')->update($fields_array, ['ol_id' => $table_id]);
      }else{
        //insert query
        $this->db->table('oultlet')->insert($fields_array);
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
    //   return $this->db->table('oultlet')->select('*')->where(['row_status' => 1])->get()->getResult();
    // } 

    public function removeTableDataOL($table_id){
      $status = true;
      $return_data = array();

      $this->db->table('oultlet')->where('ol_id', $table_id)->delete();

      $return_data['status'] = $status;
      return $return_data;
    }//end function

    public function getTableDataOL($table_id){
      $status = true;
      $return_data = array();

      $row = $this->db->table('oultlet')->select('*')->where(['row_status' => 1, 'ol_id' => $table_id])->get()->getResult();

      $return_data['status'] = $status;
      $return_data['row'] = $row;
      return $return_data;
    }//end function

    public function getAllStates(){
      $tt_rows = $this->db->table('state_master')->select('*')->where(['row_status' => 1, 'parent_id' => 0])->get()->getResult();
      return $tt_rows;
    }//end function 
}