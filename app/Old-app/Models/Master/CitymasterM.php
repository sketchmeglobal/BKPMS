<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class CitymasterM extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'state_master';
    protected $primaryKey       = 'state_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['state_id','parent_id'];

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

    public function getAllTicketCategory(){
      $all_state_city = array();
      $rows = $this->db->table('state_master')->select('*')->where(['row_status' => 1, 'parent_id !=' => 0])->get()->getResult();
      //$query = "SELECT parent_state.state_id, parent_state.parent_id, parent_state.state_name, parent_state.city_name FROM `state_master` as parent_state LEFT JOIN state_master AS child_state ON child_state.state_id = parent_state.parent_id";
      //$rows = $this->db->query($query)->getResult();
      for($i = 0; $i < sizeof($rows); $i++){
        $state_id = $rows[$i]->state_id;
        $parent_id = $rows[$i]->parent_id;
        $city_name = $rows[$i]->city_name;
        //echo 'parent_id: '. $parent_id;
        //echo "<br>";
        $row_sub = $this->db->table('state_master')->select('state_name')->where(['row_status' => 1, 'state_id' => $parent_id])->get()->getResult();
        $state_name = $row_sub[0]->state_name;
        //echo 'state_name: '. $state_name;
        //print_r($row_sub);

        $city_state = new \stdClass();
        $city_state->state_id = $state_id;
        $city_state->parent_id = $parent_id;
        $city_state->city_name = $city_name;
        $city_state->state_name = $state_name;
        array_push($all_state_city, $city_state);
      }//end for
      //die;
      return $all_state_city;
    }//end function

    //SELECT parent_state.state_name, parent_state.city_name FROM `state_master` as parent_state LEFT JOIN state_master AS child_state ON child_state.state_id = parent_state.parent_id;

    public function insertTableData($validatedData){
      $status = true;
      $return_data = array();
      $state_id = 0;
      $table_id = $validatedData['table_id'];
      $state_id = $validatedData['state_id'];
      $city_name = $validatedData['city_name'];

      $fields_array = [
        'parent_id'     => $state_id,
        'city_name'     => $city_name
      ];

      if($table_id > 0){
        //update query
        $this->db->table('state_master')->update($fields_array, ['state_id' => $table_id]);
      }else{
        //insert query
        $this->db->table('state_master')->insert($fields_array);
        $state_id = $this->db->insertID();
        if($state_id > 0){
          $status = true;          
        }else{
          $status = false;
        }
      }

      $return_data['status'] = $status;
      $return_data['state_id'] = $state_id;
      $return_data['city_name'] = $city_name;
      return $return_data;
    }

    // public function select(){  
    //   return $this->db->table('state_master')->select('*')->where(['row_status' => 1])->get()->getResult();
    // } 

    public function removeTableDataCM($table_id){
      $status = true;
      $return_data = array();

      $this->db->table('state_master')->where('state_id', $table_id)->delete();

      $return_data['status'] = $status;
      return $return_data;
    }//end function

    public function getTableDataCM($table_id){
      $status = true;
      $return_data = array();

      $row = $this->db->table('state_master')->select('*')->where(['row_status' => 1, 'state_id' => $table_id])->get()->getResult();

      $return_data['status'] = $status;
      $return_data['row'] = $row;
      return $return_data;
    }//end function

    public function getAllStates(){
      $tt_rows = $this->db->table('state_master')->select('*')->where(['row_status' => 1, 'parent_id' => 0])->get()->getResult();
      return $tt_rows;
    }//end function
}