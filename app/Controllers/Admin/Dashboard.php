<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
       
        
        return render('admin/home',$data,'admin/layout/layout');
            
    }

}
