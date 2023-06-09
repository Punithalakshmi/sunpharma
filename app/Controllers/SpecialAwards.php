<?php

namespace App\Controllers;

class SpecialAwards extends BaseController
{
    public function index()
    {
        return render('frontend/special_award',$this->data);           
    }

}
