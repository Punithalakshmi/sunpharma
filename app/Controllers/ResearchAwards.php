<?php

namespace App\Controllers;


class ResearchAwards extends BaseController
{
    public function index()
    {
        return  view('frontend/header')
                .view('frontend/latest_winners_of_research_awards')
                .view('frontend/footer');
    }

   

}
