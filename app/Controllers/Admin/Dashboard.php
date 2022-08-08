<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();

        $userdata = $session->get('userdata');

        $data['userdata'] = $userdata;

        return view('_partials/header',$data)
               .view('admin/login')
               .view('_partials/footer');
    }
}
