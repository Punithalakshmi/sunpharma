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
       //print_r($userdata); die;
        if((is_array($userdata) && count($userdata)) || !is_array($userdata)):
            if(isset($userdata['isLoggedIn']) && $userdata['isLoggedIn']):
                return view('_partials/header',$data)
                    .view('admin/home')
                    .view('_partials/footer');
            else:
                return redirect()->route('admin/login');
            endif;
        endif;
    }
}
