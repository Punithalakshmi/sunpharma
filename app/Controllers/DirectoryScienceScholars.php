<?php

namespace App\Controllers;


class DirectoryScienceScholars extends BaseController
{
    public function index()
    {
        $uri = current_url(true);
            $data['uri'] = $uri->getSegment(1); 
        $session   = \Config\Services::session();
        $userdata = $session->get('userdata');
        $data['userdata'] = $userdata;
        return  view('frontend/_partials/header',$data)
               .view('frontend/directory_of_science_scholars',$data)
               .view('frontend/_partials/footer');
    }

   

}
