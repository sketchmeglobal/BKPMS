<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\PermissionModel;
use App\Models\MasterModel;
use App\Models\UserModel;

use App\Libraries\GroceryCrud;


class UserController extends BaseController
{
    private $permission = '';
    private $master = '' ;
    private $user = '' ;
    private $session_exists = 1;
    private $table_name = '';
    
    public function __construct(){

        $this->permission = new PermissionModel();
        $this->master = new MasterModel();
        $this->user = new UserModel();

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

    public function user_list(){

        // ------INITIALLISATION------
            $session = session();
            $crud = new GroceryCrud();
            $this->table_name = $master_tbl = 'users';
            $this->pk_field_name = 'id';
            $uid = $session->get('id');

            $crud->setTable($this->table_name);
            $crud->where('users.user_level', 2);
            $crud->setSubject(strtoupper($master_tbl));
        // ------INITIALLISATION ENDS------

        // ------PERMISSION------
            $this->check_session();
            $approved_menu = $this->permission->fetch_navbar($session->get('user_level'),$uid);
            
                #stop direct URL access
            if(!in_array($master_tbl, array_column($approved_menu, 'menu_slug')) and $session->get('user_level') != 1 ){
                die('No permission');
            }

        // ------PERMISSION ENDS------

            $crud->unsetColumns(['created_at','created_by','updated_at', 'updated_by', 'row_status']);
            $crud->unsetFields(['created_at','created_by','updated_at', 'updated_by', 'row_status']);

            $crud->setRelation('emp_id', 'master_employee', '{emp_name} - {emp_code}');
            $crud->columns(['emp_id','username','email','login_attempt','blocked']);

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

    public function user_permission(){

        // ------INITIALLISATION------
            $session = session();
            $crud = new GroceryCrud();
            $this->table_name = $master_tbl = 'menu_permission';
            $this->pk_field_name = 'id';
            $uid = $session->get('id');

            $crud->setTable($this->table_name);
            $crud->where('user_level', 2);
            $crud->setSubject(strtoupper($master_tbl));
        // ------INITIALLISATION ENDS------

        // ------PERMISSION------
            $this->check_session();
            $approved_menu = $this->permission->fetch_navbar($session->get('user_level'),$uid);
            
                #stop direct URL access
            if(!in_array($master_tbl, array_column($approved_menu, 'menu_slug')) and $session->get('user_level') != 1 ){
                die('No permission');
            }

        // ------PERMISSION ENDS------

            $crud->unsetColumns(['created_at','created_by','updated_at', 'updated_by', 'row_status']);
            $crud->unsetFields(['created_at','created_by','updated_at', 'updated_by', 'row_status']);

            $crud->setRelation('master_menu_id', 'master_menu', '{menu_name} - {menu_slug}');
            $crud->setRelation('user_id','users','{username} - {email}');
            
            $crud->fieldType('block', 'dropdown', [
                '0' => 'Block',
                '1' => 'Open'
            ]);
            $crud->fieldType('action_button_1', 'dropdown', [
                '0' => 'De-active database actions',
                '1' => 'Active database actions'
            ]);
            $crud->fieldType('action_button_2', 'dropdown', [
                '0' => 'De-active non-database actions',
                '1' => 'Active non-database actions'
            ]);
            

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