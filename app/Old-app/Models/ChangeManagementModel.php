<?php

namespace App\Models;

use CodeIgniter\Model;

class ChangeManagementModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'cm_header';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

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

    // ----------------------------------------

    public function data_activity_list($cm_head_id){
        // print_r($row_cond['cm_header_id']); die;
        $rs = $this->db
            ->table('cm_detail_activity')
            ->select('cm_detail_activity.*,users.username,master_employee.emp_name')
            ->join('users', 'users.id=cm_detail_activity.approval_authority', 'left')
            ->join('master_employee', 'master_employee.id=users.emp_id', 'left')
            ->where(['cm_detail_activity.row_status' => 1, 'cm_header_id' => $cm_head_id])
            ->get()->getResult();
        
        return $rs;

    }

    public function data_stakeholder_list($cm_head_id){

        $rs = $this->db
            ->table('cm_detail_stakeholder')
            ->select('cm_detail_stakeholder.*,users.username,master_employee.emp_name')
            ->join('users', 'users.id=cm_detail_stakeholder.approval_authority', 'left')
            ->join('master_employee', 'master_employee.id=users.emp_id', 'left')
            ->where(['cm_detail_stakeholder.row_status' => 1, 'cm_header_id' => $cm_head_id])
            ->get()->getResult();
        
        return $rs;

    }
    public function data_risk_list($cm_head_id){
        
        $rs = $this->db
            ->table('cm_detail_risk')
            ->select('cm_detail_risk.*,users.username,master_employee.emp_name')
            ->join('users', 'users.id=cm_detail_risk.approval_authority', 'left')
            ->join('master_employee', 'master_employee.id=users.emp_id', 'left')
            ->where(['cm_detail_risk.row_status' => 1, 'cm_header_id' => $cm_head_id])
            ->get()->getResult();
        return $rs;

    }
    public function data_technology_list($cm_head_id){
        // print_r(); die;
        $rs = $this->db
            ->table('cm_detail_technology')
            ->select('cm_detail_technology.*')
            // ->join('users', 'users.id=cm_detail_technology.approval_authority', 'left')
            // ->join('master_employee', 'master_employee.id=users.emp_id', 'left')
            ->where(['cm_detail_technology.row_status' => 1, 'cm_header_id' => $cm_head_id])
            ->get()->getResult();
        
        return $rs;

    }
    public function data_cost_list($cm_head_id){
        // print_r(); die;
        $rs = $this->db
            ->table('cm_detail_cost')
            ->select('cm_detail_cost.*,users.username,master_employee.emp_name')
            ->join('users', 'users.id=cm_detail_cost.approval_authority', 'left')
            ->join('master_employee', 'master_employee.id=users.emp_id', 'left')
            ->where(['cm_detail_cost.row_status' => 1, 'cm_header_id' => $cm_head_id])
            ->get()->getResult();
        
        return $rs;

    }
}
