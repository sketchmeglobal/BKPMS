<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class EmployeeM extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'employee';
    protected $primaryKey       = 'emp_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['emp_id','emp_name', 'primary_phone'];

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
      $emp_id = 0;
      $arr_size = 0;
      $message = '';
      $emp_code = '';
      $ho_id = 0;
      $table_id = $validatedData['table_id'];
      $ho_id = $validatedData['ho_id'];
      $wh_id = $validatedData['wh_id'];
      $ol_id = $validatedData['ol_id'];
      $user_level = $validatedData['user_level'];
      $emp_gr_id = $validatedData['emp_gr_id'];
      $state_name = $validatedData['state_name'];
      $city_name = $validatedData['city_name'];
      $parent_emp_code = $validatedData['parent_emp_code'];

      $primary_phone = $validatedData['primary_phone'];
      $email_id = $validatedData['email_id'];
      $password =  hash('sha512', $primary_phone);


      $fields_array = [
        'ho_id' => $ho_id,
        'wh_id' => $wh_id,
        'ol_id' => $ol_id,
        'state_id' => $state_name,
        'city_id' => $city_name,
        'parent_emp_code' => $parent_emp_code,
        'emp_name' => $validatedData['emp_name'],
        'primary_phone' => $validatedData['primary_phone'],
        'secondary_phone' => $validatedData['secondary_phone'],
        'email_id' => $validatedData['email_id'],
        'dg_id' => $validatedData['dg_id'],
        'user_level' => $user_level,
        'emp_gr_id' => $emp_gr_id
      ];

      if($table_id > 0){
        //update query
        $this->db->table('employee')->update($fields_array, ['emp_id' => $table_id]);

        //update emp table
        $emp_code = 'emp_'.$table_id;
        $users_array1 = [
          'emp_code' => $emp_code
        ];
        $this->db->table('employee')->update($users_array1, ['emp_id' => $table_id]);
      }else{
        //duplicate checking
        $row = $this->db->table('employee')->select('*')->where(['primary_phone' => $primary_phone, 'email_id' => $email_id])->get()->getResult();

        $arr_size = sizeof($row);
        if($arr_size > 0){
          $status = false;         
          $message = 'User already exist with the same Email and Phone Number';
        }else{
          //insert query
          $this->db->table('employee')->insert($fields_array);
          $emp_id = $this->db->insertID();

          if($emp_id > 0){
            $status = true;  
            //Insert into user table for Login 
            $users_array = [
              'emp_id' => $emp_id, 
              'username' => $primary_phone,
              'email' => $email_id,
              'password' => $password
            ];
            $this->db->table('users')->insert($users_array);

            //update emp table
            $emp_code = 'emp_'.$emp_id;
            $users_array1 = [
              'emp_code' => $emp_code
            ];
            $this->db->table('employee')->update($users_array1, ['emp_id' => $emp_id]);

          }else{
            $status = false;         
            $message = 'employee table data insert problem';
          }//end if
        }//end if
      }//end if

      $return_data['status'] = $status;
      $return_data['emp_id'] = $emp_id;
      $return_data['arr_size'] = $arr_size;
      $return_data['message'] = $message;
      $return_data['emp_code'] = $emp_code;
      return $return_data;
    }

    public function removeTableDataEM($table_id){
      $status = true;
      $return_data = array();

      $this->db->table('employee')->where('emp_id', $table_id)->delete();
      $this->db->table('users')->where('emp_id', $table_id)->delete();

      $return_data['status'] = $status;
      return $return_data;
    }//end function

    public function getTableDataEM($table_id){
      $status = true;
      $return_data = array();

      $row = $this->db->table('employee')->select('*')->where(['row_status' => 1, 'emp_id' => $table_id])->get()->getResult();

      $return_data['status'] = $status;
      $return_data['row'] = $row;
      return $return_data;
    }//end function
    

    public function getDesignationEM($ho_id, $wh_id, $ol_id){
      $status = true;
      $return_data = array();

      $row = $this->db->table('designation')->select('*')->where(['row_status' => 1, 'ho_id' => $ho_id, 'wh_id' => $wh_id, 'ol_id' => $ol_id])->get()->getResult();

      $option_text = '<option value="0">Select</option>';
      for($i = 0; $i < sizeof($row); $i++){
        $option_text .= '<option value="'.$row[$i]->dg_id.'">'.$row[$i]->desig_name.'</option>';
      }//end for

      $return_data['status'] = $status;
      $return_data['option_text'] = $option_text;

      return $return_data;
    }//end function


    public function getDesigTableDataEM(){
      $request = \Config\Services::request();
      $ho_id = $request->getPost('ho_id');      
      $wh_id = $request->getPost('wh_id');     
      $ol_id = $request->getPost('ol_id');

      $data = array();
      $particulars = array();
      $invoice_details = array();
      $inv_paymentHistory = array();

      $result = $this->db->table('employee')->select('employee.emp_id, employee.emp_code, employee.emp_name, employee.primary_phone, employee.secondary_phone, employee.email_id, designation.desig_name')->join('designation', 'designation.dg_id = employee.dg_id')->where(['employee.ho_id' => $ho_id, 'employee.wh_id' => $wh_id, 'employee.ol_id' => $ol_id, 'employee.row_status' => 1 ])->get()->getResult();

      //echo json_encode($result);

      $counter = 1;
      if(count($result) > 0){
        for($i = 0; $i < sizeof($result); $i++){
          $nestedData['slNo'] = $counter;
          $nestedData['emp_code'] = $result[$i]->emp_code;
          $nestedData['emp_name'] = $result[$i]->emp_name;
          $nestedData['primary_phone'] = $result[$i]->primary_phone;
          $nestedData['secondary_phone'] = $result[$i]->secondary_phone;
          $nestedData['email_id'] = $result[$i]->email_id;
          $nestedData['desig_name'] = $result[$i]->desig_name;
          $nestedData['action'] = '<td class="d-flex justify-content-evenly"><a href="javascript: void(0);" class="edit_class" data-table_id="'.$result[$i]->emp_id.'"><i class="fa fa-edit"></i></a> <a class="remove_class" href="javascript: void(0);" data-table_id="'.$result[$i]->emp_id.'"><i class="fas fa-times"></i></a></td>';

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

    public function getDesignation(){
      $ol_rows = $this->db->table('oultlet')->select('*')->where(['row_status' => 1])->get()->getResult();
      return $ol_rows;
    }//end function

    public function getAllUserLevel(){
      $u_level_rows = $this->db->table('user_level')->select('*')->where(['row_status' => 1])->get()->getResult();
      return $u_level_rows;
    }//end function

    public function getAllStates(){
      $tt_rows = $this->db->table('state_master')->select('*')->where(['row_status' => 1, 'parent_id' => 0])->get()->getResult();
      return $tt_rows;
    }//end function 

    public function getCityList($state_name){
      $status = true;
      $return_data = array();      

      $row = $this->db->table('state_master')->select('*')->where(['parent_id' => $state_name ])->get()->getResult();

      $option_text = '<option value="0">Select</option>';
      for($i = 0; $i < sizeof($row); $i++){
        $option_text .= '<option value="'.$row[$i]->state_id.'">'.$row[$i]->city_name.'</option>';
      }//end for

      $return_data['status'] = $status;
      $return_data['option_text'] = $option_text;

      return $return_data;
    }//end function

    public function getAllDesignation(){
      $rows = $this->db->table('designation')->select('*')->where(['row_status' => 1])->limit(100)->get()->getResult();
      return $rows;
    }//end function 

    public function getAllEmpGroup(){
      $rows = $this->db->table('emp_group')->select('*')->where(['row_status' => 1])->limit(100)->get()->getResult();
      return $rows;
    }//end function 


}