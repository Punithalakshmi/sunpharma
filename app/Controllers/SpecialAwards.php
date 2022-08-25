<?php

namespace App\Controllers;


class SpecialAwards extends BaseController
{
    public function index()
    {
        return  view('frontend/header')
                .view('frontend/special_award')
                .view('frontend/footer');
    }

   

}
