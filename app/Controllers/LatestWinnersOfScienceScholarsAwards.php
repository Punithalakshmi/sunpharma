<?php

namespace App\Controllers;


class LatestWinnersOfScienceScholarsAwards extends BaseController
{
    public function index()
    {
        $session   = \Config\Services::session();
        $userdata = $session->get('fuserdata');
        $data['userdata'] = $userdata;
        return   view('frontend/header',$data)
                .view('frontend/latest_winners_of_science_scholars', $data)
                 .view('frontend/footer');
    }   

   

}
