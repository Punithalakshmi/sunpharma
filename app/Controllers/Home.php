<?php

namespace App\Controllers;


class Home extends BaseController
{
    public function index()
    {
        return   view('frontend/header')
                 .view('frontend/dashboard')
                 .view('frontend/footer');
    }

    public function mission()
    {
        return  view('frontend/header')
                .view('frontend/mission')
                 .view('frontend/footer');
    }

    public function annualActivities()
    {
        return  view('frontend/header')
               .view('frontend/annual_activities')
                .view('frontend/footer');
    }

    public function contact()
    {
        return view('frontend/header')
                .view('frontend/contact')
                .view('frontend/footer');
    }

}
