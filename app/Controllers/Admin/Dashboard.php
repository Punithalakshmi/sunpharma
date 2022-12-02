<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
       
        $role = $this->session->get('role');
        
        $data['userdata']['role'] = $role;
        $data['userdata']['login_name'] = $this->session->get('firstname');
       
        return view('_partials/header',$data)
            .view('admin/home')
            .view('_partials/footer');
            
      
    }

}
