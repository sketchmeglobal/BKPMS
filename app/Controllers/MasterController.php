<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\PermissionModel;
use App\Models\MasterModel;

use App\Libraries\GroceryCrud;


class MasterController extends BaseController
{
    private $permission = '';
    private $master = '' ;
    private $session_exists = 1;
    private $table_name = '';
    
    public function __construct(){

        $this->permission = new PermissionModel();
        $this->master = new MasterModel();

        $session = session();
        if($session->logged_in == true and !empty($session->get('id'))) {
            $this->session_exists = 1;
        }else{
            $this->session_exists = 0;
        }

        helper(['url', 'form']);
        
    }

    public function check_session(){
        if(!$this->session_exists){
            return redirect()->to(base_url('login'));
        }
    }

    public function index($master_tbl){

        // ------INITIALLISATION------
            $session = session();
            $crud = new GroceryCrud();
            $this->table_name = 'master_' . str_replace("-","_",$master_tbl);
            $this->pk_field_name = 'id';
            $uid = $session->get('id');

            $crud->setTable($this->table_name);
            $crud->setSubject(strtoupper($master_tbl));
        // ------INITIALLISATION ENDS------

        // ------PERMISSION------
            $this->check_session();
            $approved_menu = $this->permission->fetch_navbar($session->get('user_level'),$uid);
            
                #stop direct URL access
            if(!in_array($master_tbl, array_column($approved_menu, 'menu_slug'))){
                return redirect()->to(base_url('login?st=1'));
            }

            $data = [];
            foreach ($approved_menu as $item) {
                if($item->menu_slug == $master_tbl){
                    $data = [
                        'menu_module'=>$item->menu_module,
                        'menu_name'=>$item->menu_name,
                        'menu_slug'=>$item->menu_slug,
                        'action_button_1'=>$item->action_button_1,
                        'action_button_2'=>$item->action_button_2
                    ];
                }
            }

            if(!empty($data)){
                if(!$data['action_button_1']){
                    $crud->unsetAdd();
                    $crud->unsetEdit();
                    $crud->unsetDelete();
                }
                if(!$data['action_button_2']){
                    $crud->unsetPrint();
                    $crud->unsetExport();
                }
            }
        // ------PERMISSION ENDS------

            $this->custom_settings($crud, $master_tbl);

        // ------DB LOG AREA STARTS------
            
            $crud->callbackBeforeUpdate(function ($commonParameters) {
                $this->log_before_update($commonParameters);
            });
            $crud->callbackBeforeDelete(function ($commonParameters) {
                $this->log_before_delete($commonParameters);
            });

        // ------DB LOG AREA ENDS------

        $output = $crud->render();

        $output->breadcrumb = $master_tbl;
        $output->page_title = $master_tbl . " || " . COMPANY_SHORT_NAME;
        $output->meta_tag = '<meta content="Baazar Kolkata, Sketch Me Global" name="keywords"><meta content="Baazar Kolkata, Sketch Me Global" name="description">';
        $output->approved_menu = $approved_menu;

        return view('master/main_common', (array)$output);

    }

    private function custom_settings($crud, $master_tbl){

    // common
        $crud->unsetColumns(['created_at','created_by','updated_at', 'updated_by', 'row_status']);
        $crud->unsetFields(['created_at','created_by','updated_at', 'updated_by', 'row_status']);

        if($master_tbl == 'city'){
            $crud->setRelation('state_id', 'master_state', '{state_name} - {state_code}');
        }

        if($master_tbl == 'employee'){

            $crud->where('user_level', 2);
            $crud->columns(['emp_name','emp_code','primary_phone','email_id','dg_id']);

            $crud->fieldType('user_level', 'dropdown', [
                '1' => 'Admin',
                '2' => 'User'
            ]);

            $crud->setRelation('ho_id', 'master_head_office', '{ho_name} - {ho_location}');
            $crud->setRelation('city_id', 'master_city', '{city_name} - {city_code}');
            $crud->setRelation('dg_id', 'master_designation', 'desig_name');

            $crud->displayAs('dg_id', 'Designation');

        }

    }

    public function log_before_update($array){

        // print_r($array); die;
        $session = session();
        
        $insertArray = array(
            'target_table' => $this->table_name,
            'action_taken'=>'edit', 
            'topic_details' => json_encode($array),
            'user_id' => $session->get('id'),
            'comment' => 'master'
        );
        
        $this->master->db_insert($insertArray);

    }

    public function log_before_delete($array){

        $row_cond = array(
            'id' => $array->primaryKeyValue
        );
        $row_rs = $this->master->get_row($this->table_name, $row_cond);
        
        $session = session();
        
        $insertArray = array(
            'target_table' => $this->table_name,
            'action_taken'=>'delete', 
            'topic_details' => json_encode($row_rs),
            'user_id' => $session->get('id'),
            'comment' => 'master'
        );
        
        $this->master->db_insert($insertArray);

    }

}