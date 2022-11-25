<?php

namespace App\Controllers;


class LatestWinnersOfScienceScholarsAwards extends BaseController
{
    public function index()
    {
        $uri = current_url(true);
            $data['uri'] = $uri->getSegment(1); 
        $session   = \Config\Services::session();
        $userdata = $session->get('userdata');
        $data['userdata'] = $userdata;
        return   view('frontend/_partials/header',$data)
                .view('frontend/latest_winners_of_science_scholars', $data)
                 .view('frontend/_partials/footer');
    }   

   

}
