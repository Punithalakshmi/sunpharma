<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;


class Login extends BaseController
{
    public function index()
    {
        return view('admin/login',$this->data);
    }

    public function loginAuth()
    {

        $username  = $this->request->getVar('username');
        $password  = $this->request->getVar('password');
        
        $result   = $this->userModel->Login($username, md5($password));
   
        if($result){
            
            setSessionData('userdata',$result);
            return redirect()->to('admin/dashboard');
        }
        else
        {
            $this->session->setFlashdata('msg', 'Invalid Credentials');
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
        $this->session->remove('userdata');
        return redirect()->to('admin/login');
    }
}
