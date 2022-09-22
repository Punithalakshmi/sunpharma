<?php

namespace App\Controllers;


class SpecialAwards extends BaseController
{
    public function index()
    {

        $session   = \Config\Services::session();
        $userdata = $session->get('fuserdata');
        $data['userdata'] = $userdata;
        
        return  view('frontend/header',$data)
                .view('frontend/special_award',$data)
                .view('frontend/footer');
    }

   

}
