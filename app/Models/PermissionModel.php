<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'menu_permission';
    protected $primaryKey       = 'mp_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['master_menu_id', 'user_id', 'block', 'action_button_1', 'action_button_2'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'timestamp';
    protected $createdField  = 'created_date';
    protected $updatedField  = 'modified_date';
    

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


    public function fetch_navbar($user_level, $uid){
        if($user_level == 1){ // admin

            $rs = $this->db
                ->table('master_menu')
                ->select('menu_module, menu_name, menu_slug, show_on_left_nav, 1 as action_button_1, 1 as action_button_2')
                ->where(['master_menu.row_status' => 1])
                ->get()->getResult();    
                
        }else{

            $rs = $this
                ->select('menu_module, menu_name, menu_slug, show_on_left_nav, action_button_1, action_button_2, menu_permission.user_id')
                ->join('master_menu','master_menu.id = menu_permission.master_menu_id','left')
                ->where(['user_id' => $uid, 'block' => 0, 'master_menu.row_status' => 1, 'menu_permission.row_status' => 1])
                ->get()->getResult();
                
        }

        // echo $this->getLastQuery()->getQuery(); die;
        return $rs;

    }

}
