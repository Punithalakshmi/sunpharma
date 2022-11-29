<?php

namespace App\Controllers;


class DirectoryScienceScholars extends BaseController
{
    public function index()
    {
        $uri = current_url(true);
        $data['uri'] = $uri->getSegment(1); 
    
        $data['userdata'] = $this->session->get('userdata');
    
        return  render('frontend/directory_of_science_scholars',$data);
              
    }

   

}
