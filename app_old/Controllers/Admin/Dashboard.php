<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        return render('admin/home',$this->data);  
    }

    public function access()
    {
       // $this->session->remove('userdata');
        return render('admin/access_denied',$this->data);  
    }
}
