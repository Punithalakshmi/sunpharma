<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NominationModel;

class User extends BaseController
{
    
    public function login()
    {

        $session   = session();
        $userModel = new UserModel();
        $nominationModel = new NominationModel();
        $request   = \Config\Services::request();

        if($request->getPost()){
              $username   = $request->getPost('email');
              $password  = $request->getPost('password');
       
              $result   = $userModel->fLogin($username, md5($password));
              
              $getNominationData   = $nominationModel->getNominationData($result['id']);
              $getNominationData   = $getNominationData->getRowArray();
            

              $result['nomination_type'] = $getNominationData['nomination_type'];

              $session->set('fuserdata',$result);

              $redirect_route = '/'.$result['nomination_type'].'/'.$result['id'];

              return redirect()->to($redirect_route);
        }
        else
        {
            $session->setFlashdata('msg', 'Invalid Credentials');
            $data['userdata'] = array(
                                    'id'          => '',
                                    'name'        => '',
                                    'email'       => '',
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


    public function logout()
    {

        $session = session();
        $session->remove('fuserdata');
        return redirect()->route('/');
    }

}    