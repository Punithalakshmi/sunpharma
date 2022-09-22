<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        $session  = \Config\Services::session();

        $session = session();
        $session->remove('userdata');

        
        $data['userdata'] = '';
     
        if(empty($userdata)):
            return view('_partials/header',$data)
                .view('admin/login')
                .view('_partials/footer');
        else:
            return redirect()->route('admin/dashboard');
        endif;
    }

    public function loginAuth()
    {

        $session   = session();
        $userModel = new UserModel();
        $username  = $this->request->getVar('username');
        $password  = $this->request->getVar('password');
        
        $result   = $userModel->Login($username, md5($password));
        
        if($result){
            $session->set('userdata',$result);
            return redirect()->route('admin/dashboard');
        }
        else
        {
            $session->setFlashdata('msg', 'Invalid Credentials');
            return redirect()->route('admin/login');
        }

    }

    public function validation_rules($type = 'profile',$id='')
    {

      $validation_rules = array();

      $validation_rules = array(
                                    "firstname" => array("label" => "Firstname",'rules' => 'required'),
                                    "lastname" => array("label" => "Lastname",'rules' => 'required'),
                                    "email" => array("label" => "email",'rules' => 'required|valid_email|is_unique[users.email,id,'.$id.']'),
                                    "phonenumber" => array("label" => "Phonenumber",'rules' => 'required|numeric|max_length[10]'),
                                    "date_of_birth" => array("label" => "Date Of Birth",'rules' => 'required')
      );
 
      if($type == 'user')
        $validation_rules["user_role"] = array("label" => "Role",'rules' => 'required');  

      return $validation_rules;
      
    }
    
    public function logout()
    {

        $session = session();
        $session->remove('userdata');
        return redirect()->route('admin/login');
    }
}
