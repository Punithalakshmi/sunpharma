<?php

namespace App\Controllers;


class DirectoryScienceScholars extends BaseController
{
    public function index()
    {
        return view('frontend/header')
               .view('frontend/directory_of_science_scholars')
               .view('frontend/footer');
    }

   

}
