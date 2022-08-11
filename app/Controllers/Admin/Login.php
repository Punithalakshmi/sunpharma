<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        $session  = \Config\Services::session();
        $userdata = $session->get('userdata');
        $data['userdata'] = $userdata;
     
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

    public function logout()
    {

        $session = session();
        $session->remove('userdata');
        return redirect()->route('admin/login');
    }
}
