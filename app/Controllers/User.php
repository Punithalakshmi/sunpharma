<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NominationModel;
use App\Models\NominationTypesModel;


class User extends BaseController
{
    
    public function login()
    {

        $session   = session();
        $userModel = new UserModel();
        $nominationModel = new NominationModel();
        $nominationModl  = new NominationTypesModel();

        $request   = \Config\Services::request();

        if($request->getPost()){
              $username   = $request->getPost('username');
              $password  = $request->getPost('password');
       
              $result   = $userModel->Login($username, md5($password));
              
              $getNominationData   = $nominationModel->getNominationData($result['id']);
              $getNominationData   = $getNominationData->getRowArray();
            
              $getCategoryNominationData   = $nominationModl->getCategoryNomination($getNominationData['category_id']);
              $getNominationDaysCt         = $getCategoryNominationData->getRowArray();

              $nominationEndDays =  $this->dateDiff(date("Y-m-d"),$getNominationDaysCt['end_date']);
             
              $result['nominationEndDays'] =  $nominationEndDays;

              $result['nominationEndDate'] = $getNominationDaysCt['end_date'];

              $result['nomination_type'] = $getNominationData['nomination_type'];

             // print_r($result); die;

              $session->set('userdata',$result);

              $redirect_route = 'view/'.$result['id'];

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

            $uri = current_url(true);
            $data['uri'] = $uri->getSegment(1);  

            return  view('frontend/_partials/header',$data)
            .view('frontend/login',$data)
            .view('frontend/_partials/footer');
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
        $session->remove('userdata');
        return redirect()->route('/');
    }

    public function dateDiff($date1, $date2)
    {
        $date1_ts = strtotime($date1);
        $date2_ts = strtotime($date2);
        $diff = $date2_ts - $date1_ts;
        return round($diff / 86400);
    }



}    