<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'intra_messaging';
    protected $primaryKey       = 'im_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['im_id','message', 'end_date'];

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


    public function data_count($post_array){
      $this->where($post_array);
      return $this->countAllResults();
  }
  public function data_current_row($row_cond_array) {
  return $this->where($row_cond_array)->get()->getRow();
}
  public function data_first_row($row_cond_array){
      return $this->where($row_cond_array)->get()->getFirstRow();
  }
  public function data_last_row($row_cond_array){
      return $this->where($row_cond_array)->get()->getLastRow();
  }
  public function data_all() {
      return $this->where(['row_status' => 1])->get()->getResult();
  }
  public function data_batch($reftable, $row_cond_array) {
      if($reftable == $this->table){
          return $this->where($row_cond_array)->get()->getResult();
      }else{
          return $this->db->table($reftable)->where($row_cond_array)->get()->getResult();
      }

}
  public function data_insert($reftable, $insertArray){
      return $this->db->table($reftable)->insert($insertArray);
  }

  public function data_update($id, $update_array){
      return $this->where(["id" => $id])->set($update_array)->update();
  }

  public function data_remove($table_id, $pid){
      $this->db->table($table_id)->where(['id' => $pid])->delete();
      return true;
  }

    public function getAllMessage($emp_id, $dg_id){
      $rows = $this->db->table('intra_messaging')
        ->select('intra_messaging.im_id, intra_messaging.from_emp_id, intra_messaging.message, intra_messaging.sent_date, intra_messaging.end_date, intra_messaging.read_unread, master_employee.emp_name')
        ->join('master_employee', 'master_employee.id = intra_messaging.from_emp_id')
        ->where(['intra_messaging.row_status' => 1, 'intra_messaging.to_dg_id' => $dg_id])
        ->orWhere(['intra_messaging.from_emp_id' => $emp_id])
        ->get()->getResult();
      return $rows;
    }//end function 

    public function insertTableData($validatedData){
      $status = true;
      $return_data = array();
      
      //$table_id = $validatedData['table_id'];

      $fields_array = [
        'from_emp_id' => $validatedData['emp_id'],
        'to_dg_id' => $validatedData['dg_id'],
        'message' => $validatedData['message'],
        'end_date' => $validatedData['end_date']
      ];

      //insert query
      $this->db->table('intra_messaging')->insert($fields_array);
      $im_id = $this->db->insertID();
      if($im_id > 0){
        $status = true;          
      }else{
        $status = false;
      }        

      $return_data['status'] = $status;
      $return_data['im_id'] = $im_id;
      return $return_data;
    }

    public function ajax_remove_table_data($pid){
        
        if($this->db->table('intra_messaging')->where('im_id', $pid)->delete()){
          return 1;
        }else{
          return 0;
        }
        
    }//end function

    public function getTableDataDG($table_id){
      $status = true;
      $return_data = array();

      $row = $this->db->table('intra_messaging')->select('*')->where(['row_status' => 1, 'im_id' => $table_id])->get()->getResult();

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

      $result = $this->db->table('intra_messaging')->select('*')->where(['ho_id' => $ho_id, 'wh_id' => $wh_id, 'ol_id' => $ol_id, 'row_status' => 1 ])->get()->getResult();

      //echo json_encode($result);

      $counter = 1;
      if(count($result) > 0){
        for($i = 0; $i < sizeof($result); $i++){
          $nestedData['slNo'] = $counter;
          $nestedData['desigName'] = $result[$i]->message;
          $nestedData['desigPriority'] = $result[$i]->end_date;
          $nestedData['action'] = '<td class="d-flex justify-content-evenly"><a href="javascript: void(0);" class="edit_class" data-table_id="'.$result[$i]->im_id.'"><i class="fa fa-edit"></i></a> <a class="remove" href="javascript: void(0);"><i class="fas fa-times" data-table_id="'.$result[$i]->im_id.'"></i></a></td>';

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

    public function getAllDesignation(){
      $designation = $this->db->table('master_designation')->where(['row_status' => 1])->get()->getResult();
      return $designation;
    }//end function 

    public function getUserDesignation($emp_id){

      $designation = $this->db->table('master_employee')->where(['row_status' => 1, 'id' => $emp_id])->get()->getRow();

      if(count((array)$designation) > 0){
        $dgid = $designation->dg_id;
      }else{
        $dgid = 0;
      }
      return $dgid;
      
    }

    public function LogInsert($insertArray){
        return $this->db->table('user_activity_log')->insert($insertArray);
    }

    public function GetRow($row_cond_array) {
      return $this->db->table('group_messaging')->where($row_cond_array)->get()->getRow();
    }

}