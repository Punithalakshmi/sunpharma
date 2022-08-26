<?php

namespace App\Controllers;


class Home extends BaseController
{
    public function index()
    {
        $session   = \Config\Services::session();
        $userdata = $session->get('fuserdata');
        $data['userdata'] = $userdata;
     
        
        return   view('frontend/header',$data)
                 .view('frontend/dashboard',$data)
                 .view('frontend/footer');
    }

    public function mission()
    {
        $session   = \Config\Services::session();
        $userdata = $session->get('fuserdata');
        $data['userdata'] = $userdata;

        return  view('frontend/header',$data)
                .view('frontend/mission',$data)
                 .view('frontend/footer');
    }

    public function annualActivities()
    {
        $session   = \Config\Services::session();
        $userdata = $session->get('fuserdata');
        $data['userdata'] = $userdata;

        return  view('frontend/header',$data)
               .view('frontend/annual_activities',$data)
                .view('frontend/footer');
    }

    public function contact()
    {
        $session   = \Config\Services::session();
        $userdata = $session->get('fuserdata');
        $data['userdata'] = $userdata;
        return view('frontend/header',$data)
                .view('frontend/contact',$data)
                .view('frontend/footer');
    }

}
