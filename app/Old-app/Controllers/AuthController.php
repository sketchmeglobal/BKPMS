<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;

class AuthController extends BaseController
{
    private $login = '' ;
    private $session_exists = 1;
    public function __construct(){

        $session = session();
        if($session->logged_in == true and !empty($session->get('id'))) {
            $this->session_exists = 1;
        }else{
            $this->session_exists = 0;
        }

        helper(['url', 'form']);
        $this->login = new AuthModel();       
    }

    public function index(){
        // if form is submitted
        if($this->request->getVar('submit')){

            $login_rule = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[8]'
            ];

            if ($this->validate($login_rule)) {

                $session = session();
                
                $post_array = array(
                    'email' => $this->request->getVar('email'),
                    'row_status' => 1
                );    
                $email_rows = $this->login->num_rows($post_array);

                if($email_rows == 0){ // no email found

                    $session->setFlashdata('msg', 'Invalid User, please try again.');

                }
                if($email_rows > 1){ // multiple email found

                    $session->setFlashdata('msg', 'Multiple Presence, Contact Admin');

                }
                if($email_rows == 1){

                    $post_array = array(
                        'email' => $this->request->getVar('email'),
                        'password' => hash('sha512', $this->request->getVar('password'))
                    );    
                    $user_rows = $this->login->num_rows($post_array);

                    $row_cond_array = array(
                        'email' => $this->request->getVar('email')
                    );
                    $user_data = $this->login->get_row($table = 'users', $row_cond_array);

                    if($user_rows == 0){  // email - password mismatches

                        if($user_data->blocked == 1){

                            $session->setFlashdata('msg', 'You are blocked, Contact Admin');                            

                        } else{

                            if($user_data->login_attempt >= (MAX_LOGIN_ATTEMPT - 1) ){

                                $update_array = array(
                                    'blocked' => 1 
                                );
                                $this->login->resultset_update($user_data->id, $update_array);
                                $session->setFlashdata('msg', 'You are blocked, Contact Admin');

                            } else{

                                $this->login->value_increment('id', $user_data->id, 'login_attempt', '1');
                                $session->setFlashdata('msg', 'Wrong credentials, please try again. <hr> You have used <b>' . ($user_data->login_attempt +1) . '/' . MAX_LOGIN_ATTEMPT . '</b> chances');

                            }

                        }
                        
                        // echo $this->login->getLastQuery()->getQuery();

                    }else{  // // email - password matches

                        if($user_data->blocked == 1){

                            $session->setFlashdata('msg', 'You are blocked, Contact Admin');

                        } else{

                            $update_array = array(
                                'login_attempt' => 0 
                            );
                            $this->login->resultset_update($user_data->id, $update_array);
                            $session->setFlashdata('msg', '');

                            $row_cond_array = array(
                                'id' => $user_data->emp_id
                            );
                            $emp_gr_id = $this->login->get_row('master_employee',$row_cond_array)->emp_gr_id;
                            $emp_name = $this->login->get_row('master_employee',$row_cond_array)->emp_name;
                            $sess_user_data = [
                                'id'           => $user_data->id,
                                'emp_id'       => $user_data->emp_id,
                                'user_level'   => $user_data->user_level,
                                'username'     => $user_data->username,
                                'email'        => $user_data->email,
                                'emp_gr_id'    => $emp_gr_id,
                                'emp_name'     => $emp_name,
                                'logged_in'    => TRUE
                            ];
                            $session->set($sess_user_data);

                            return redirect()->to(base_url('portal/dashboard'));
                            
                        }

                    }

                }

            }

            
        }
        
        // REDIRECT IF ALRADY LOGED IN
        if($this->session_exists){
            return redirect()->to(base_url('portal/dashboard'));
        }

        $data['page_title'] = "Login || " . COMPANY_SHORT_NAME;
        $data['meta_tag'] = '<meta content="Baazar Kolkata, Sketch Me Global" name="keywords"><meta content="Baazar Kolkata, Sketch Me Global" name="description">';
        return view('authentication/signin', $data);

    }
    public function login_suman()
    {
        
        if ($this->request->getVar('submit')) {
            $datam = array();
            $session = session();
            $authModel = new AuthM();
            // Validation
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[8]'
            ];

            if ($this->validate($rules)) {
                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');
                $data = $authModel->password_verify($email, $password);

                if ($data == 'wrong') {
                    $session->setFlashdata('msg', 'Wrong Input');
                    $datam['email'] = $email;
                    $datam['pass'] = $password;
                    return view('authentication/signin', $datam);
                } else {
                    //echo 'here';
                    $ses_data = [
                        'id'           => $data[0]->id,
                        'emp_id'       => $data[0]->emp_id,
                        'emp_gr_id'    => $data[0]->emp_gr_id,
                        'emp_name'     => $data[0]->emp_name,
                        'password'     => $data[0]->password,
                        'email'        => $data[0]->email,
                        'user_level'   => $data[0]->user_level,
                        'ol_id'        => $data[0]->ol_id,
                        'dg_id'        => $data[0]->dg_id,
                        'emp_code'     => $data[0]->emp_code,
                        'parent_emp_code' => $data[0]->parent_emp_code,
                        'user_level_name' => $data[0]->user_level_name,
                        'logged_in'    => TRUE
                    ];
                    $session->set($ses_data);
                    return redirect()->to(base_url('portal/dashboard'));
                }
            } else {
                $data['validation'] = $this->validator->getErrors();
                $data['email'] = $this->request->getVar('email');
                $data['pass'] = $this->request->getVar('password');
                return view('authentication/signin', $data);
            }
        } else {
            return view('authentication/signin');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('login'));
    }
}