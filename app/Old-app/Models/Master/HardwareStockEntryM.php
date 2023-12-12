<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class HardwareStockEntryM extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'hardware_serial';
    protected $primaryKey       = 'hw_sl_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['hw_sl_id','hw_id', 'serial_no'];

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

    public function getHwWithSerialNo(){
      $rows = $this->db->table('hardware_serial')->select('hardware_serial.hw_sl_id, hardware_serial.serial_no, hardware.hw_name, hardware.hw_code')->join('hardware', 'hardware.hw_id = hardware_serial.hw_id')->where(['hardware_serial.row_status' => 1])->limit(100)->get()->getResult();
      return $rows;
    }//end function

    public function insertTableData($validatedData){
      $status = true;
      $return_data = array();
      $ho_id = 0;
      $table_id = $validatedData['table_id'];

      $fields_array = [
        'hw_id'     => $validatedData['hw_id'],
        'serial_no'  => $validatedData['serial_no'],
        'deviceMetaData'  => json_encode($validatedData['deviceMetaData'])
      ];

      if($table_id > 0){
        //update query
        $this->db->table('hardware_serial')->update($fields_array, ['hw_sl_id' => $table_id]);
      }else{
        //insert query
        $this->db->table('hardware_serial')->insert($fields_array);
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

    public function removeTableDataHWS($table_id){
      $status = true;
      $return_data = array();

      $this->db->table('hardware_serial')->where('hw_sl_id', $table_id)->delete();

      $return_data['status'] = $status;
      return $return_data;
    }//end function

    public function getTableDataHWS($table_id){
      $status = true;
      $return_data = array();

      $row = $this->db->table('hardware_serial')->select('*')->where(['row_status' => 1, 'hw_sl_id' => $table_id])->get()->getResult();

      $return_data['status'] = $status;
      $return_data['row'] = $row;
      return $return_data;
    }//end function

    public function getDeviceNameList(){
      $hw_rows = $this->db->table('hardware')->select('*')->where(['row_status' => 1])->get()->getResult();
      return $hw_rows;
    }//end function

}