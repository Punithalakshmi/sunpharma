<?php

namespace App\Controllers;


class DirectoryResearchAwardees extends BaseController
{
    public function index()
    {
        return view('frontend/header')
               .view('frontend/directory_research_awardees')
               .view('frontend/footer');
    }

   

}
