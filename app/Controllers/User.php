<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    
    public function login()
    {

        $session   = session();
        $userModel = new UserModel();
        $request   = \Config\Services::request();

        if($request->getPost()){
              $username   = $request->getPost('email');
              $password  = $request->getPost('password');
       
              $result   = $userModel->fLogin($username, md5($password));
           
              $session->set('fuserdata',$result);
              return redirect()->route('/');
        }
        else
        {
            $session->setFlashdata('msg', 'Invalid Credentials');
            $data['userdata'] = array(
                                    'login_id'          => '',
                                    'login_name'        => '',
                                    'login_email'       => '',
                                    'isLoggedIn'      => false,
                                    'role'           => ''
                                );
            return  view('frontend/header',$data)
            .view('frontend/login',$data)
            .view('frontend/footer');
        }

       
    }

    public function forget_password()
    {
        return  view('frontend/header')
               .view('frontend/forget_password')
               .view('frontend/footer');
    }

    public function reset_password()
    {
        return  view('frontend/header')
               .view('frontend/reset_password')
               .view('frontend/footer');
    }

}    