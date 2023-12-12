<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class DesignationM extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'designation';
    protected $primaryKey       = 'dg_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['dg_id','desig_name', 'desig_priority'];

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


    public function getAllDesignation(){
      $rows = $this->db->table('designation')->select('*')->where(['row_status' => 1])->limit(100)->get()->getResult();
      return $rows;
    }//end function 

    public function insertTableData($validatedData){
      $status = true;
      $return_data = array();
      $dg_id = 0;
      $table_id = $validatedData['table_id'];

      $fields_array = [
        'desig_name' => $validatedData['desig_name'],
        'desig_priority' => $validatedData['desig_priority']
      ];

      if($table_id > 0){
        //update query
        $this->db->table('designation')->update($fields_array, ['dg_id' => $table_id]);
      }else{
        //insert query
        $this->db->table('designation')->insert($fields_array);
        $dg_id = $this->db->insertID();
        if($dg_id > 0){
          $status = true;          
        }else{
          $status = false;
        }
      }

      $return_data['status'] = $status;
      $return_data['dg_id'] = $dg_id;
      return $return_data;
    }

    public function removeTableDataDG($table_id){
      $status = true;
      $return_data = array();

      $this->db->table('designation')->where('dg_id', $table_id)->delete();

      $return_data['status'] = $status;
      return $return_data;
    }//end function

    public function getTableDataDG($table_id){
      $status = true;
      $return_data = array();

      $row = $this->db->table('designation')->select('*')->where(['row_status' => 1, 'dg_id' => $table_id])->get()->getResult();

      $return_data['status'] = $status;
      $return_data['row'] = $row;
      return $return_data;
    }//end function

    public function getDesigTableData(){
      $request = \Config\Services::request();
      $ho_id = $request->getPost('ho_id');      
      $wh_id = $request->getPost('wh_id');     
      $ol_id = $request->getPost('ol_id');

      $data = array();
      $particulars = array();
      $invoice_details = array();
      $inv_paymentHistory = array();

      $result = $this->db->table('designation')->select('*')->where(['ho_id' => $ho_id, 'wh_id' => $wh_id, 'ol_id' => $ol_id, 'row_status' => 1 ])->get()->getResult();

      //echo json_encode($result);

      $counter = 1;
      if(count($result) > 0){
        for($i = 0; $i < sizeof($result); $i++){
          $nestedData['slNo'] = $counter;
          $nestedData['desigName'] = $result[$i]->desig_name;
          $nestedData['desigPriority'] = $result[$i]->desig_priority;
          $nestedData['action'] = '<td class="d-flex justify-content-evenly"><a href="javascript: void(0);" class="edit_class" data-table_id="'.$result[$i]->dg_id.'"><i class="fa fa-edit"></i></a> <a class="remove" href="javascript: void(0);"><i class="fas fa-times" data-table_id="'.$result[$i]->dg_id.'"></i></a></td>';

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
    

    public function getAllHeadOffice(){
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


}