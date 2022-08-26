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

       echo $username  = $request->getVar('email');
       echo $password  = $request->getVar('password');
        
        $result   = $userModel->Login($username, md5($password));
        //print_r($result); die;

        if($result){
            print_r($result); die;
            $session->set('userdata',$result);
            return redirect()->route('/');
        }
        else
        {
            $session->setFlashdata('msg', 'Invalid Credentials');
            return  view('frontend/header')
            .view('frontend/login')
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