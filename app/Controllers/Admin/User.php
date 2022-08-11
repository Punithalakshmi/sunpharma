<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;

class User extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();

        $userdata  = $session->get('userdata');
        $userModel = new UserModel();
        
        $data['userdata'] = $userdata;
       
        if(is_array($userdata) && count($userdata)):

            $userLists = $userModel->getListsOfUsers();
           
            $data['lists'] = $userLists;
            return view('_partials/header',$data)
                .view('admin/user/list',$data)
                .view('_partials/footer');
        else:
            return redirect()->route('admin/login');
        endif;        
    }

    public function add()
    {
        helper(array('form', 'url'));

        $session = \Config\Services::session();
        $userdata  = $session->get('userdata');

        $request = \Config\Services::request();
        $validation = \Config\Services::validation();

        if(is_array($userdata) && count($userdata)):
           

          //  print_r($this->validation_rules());  
         $validation = $this->validate($this->validation_rules());
            
            $roleModel = new RoleModel();
            $data['userdata'] = $userdata;
            $data['roles']    = $roleModel->getListsOfRoles();
            $data['validation'] = $this->validator;
          
            if($request->getPost()){
                
            }

            return view('_partials/header',$data)
                .view('admin/user/add',$data)
                .view('_partials/footer');
        else:
            return redirect()->route('admin/login');
        endif; 


    }

    public function profile()
    {

        $session = \Config\Services::session();
        $userdata  = $session->get('userdata');

        if(is_array($userdata) && count($userdata)):

            $data['userdata'] = $userdata;
            return view('_partials/header',$data)
                .view('admin/user/profile',$data)
                .view('_partials/footer');
        else:
            return redirect()->route('admin/login');
        endif;

    }

    public function validation_rules()
    {

      $validation_rules = array();

      $validation_rules = array(
                                    "firstname" => array("label" => "Firstname",'rules' => 'required'),
                                    "lastname" => array("label" => "Lastname",'rules' => 'required'),
                                    "email" => array("label" => "email",'rules' => 'required|valid_email'),
                                    "phonenumber" => array("label" => "Phonenumber",'rules' => 'required|numeric|max_length[10]'),
                                    "date_of_birth" => array("label" => "Date Of Birth",'rules' => 'required'),
                                    "user_role" => array("label" => "Role",'rules' => 'required')
      );

      return $validation_rules;

    }
}
