<?php

namespace App\Controllers;


class DirectoryResearchAwardees extends BaseController
{
    public function index()
    {

        $uri = current_url(true);
        $data['uri'] = $uri->getSegment(1); 
      
        $data['userdata'] = $this->session->get('fuserdata');
        
        return render('frontend/directory_research_awardees',$data);
               
    }

   

}
