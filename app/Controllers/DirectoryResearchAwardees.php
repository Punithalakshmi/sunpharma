<?php

namespace App\Controllers;


class DirectoryResearchAwardees extends BaseController
{
    public function index()
    {
        
        return render('frontend/directory_research_awardees',$this->data);
               
    }

   

}
