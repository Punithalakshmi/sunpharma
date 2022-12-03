<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
       
        $data=[];
        return render('admin/home',$data);
            
    }

}
