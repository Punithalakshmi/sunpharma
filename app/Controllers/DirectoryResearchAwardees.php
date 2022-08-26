<?php

namespace App\Controllers;


class DirectoryResearchAwardees extends BaseController
{
    public function index()
    {
        $session   = \Config\Services::session();
        $userdata = $session->get('fuserdata');
        $data['userdata'] = $userdata;

        return view('frontend/header',$data)
               .view('frontend/directory_research_awardees',$data)
               .view('frontend/footer');
    }

   

}
