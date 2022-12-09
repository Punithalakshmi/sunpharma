<?php

namespace App\Controllers;


class DirectoryScienceScholars extends BaseController
{
    public function index()
    {
    
        return  render('frontend/directory_of_science_scholars',$this->data);
              
    }

   

}
