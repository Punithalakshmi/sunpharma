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
        return view('frontend/mission');
    }

    public function annualActivities()
    {
        return view('frontend/annual_activities');
    }

    public function contact()
    {
        return view('frontend/contact');
    }

}
