<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class TicketopicM extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'topic_master';
    protected $primaryKey       = 'topic_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['topic_id','topic_name'];

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
      $this->db->table('topic_master')->insert($ins_data);
      return true;
    }

    public function insertTableData($validatedData){
      $status = true;
      $return_data = array();
      $topic_id = 0;
      $table_id = $validatedData['table_id'];

      $fields_array = [
        'topic_name'     => $validatedData['topic_name']
      ];

      if($table_id > 0){
        //update query
        //$this->db->table('topic_master')->update($fields_array)->where('id', $table_id);
        $this->db->table('topic_master')->update($fields_array, ['topic_id' => $table_id]);
      }else{
        //insert query
        $this->db->table('topic_master')->insert($fields_array);
        $topic_id = $this->db->insertID();
        if($topic_id > 0){
          $status = true;          
        }else{
          $status = false;
        }
      }

      $return_data['status'] = $status;
      $return_data['topic_id'] = $topic_id;
      return $return_data;
    }

    // public function select(){  
    //   return $this->db->table('topic_master')->select('*')->where(['row_status' => 1])->get()->getResult();
    // } 

    public function removeTableDataTT($table_id){
      $status = true;
      $return_data = array();

      $this->db->table('topic_master')->where('topic_id', $table_id)->delete();

      $return_data['status'] = $status;
      return $return_data;
    }//end function

    public function getTableDataTT($table_id){
      $status = true;
      $return_data = array();

      $row = $this->db->table('topic_master')->select('*')->where(['row_status' => 1, 'topic_id' => $table_id])->get()->getResult();

      $return_data['status'] = $status;
      $return_data['row'] = $row;
      return $return_data;
    }//end function
}