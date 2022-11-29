<?php

namespace App\Controllers;


class LatestWinnersOfScienceScholarsAwards extends BaseController
{
    public function index()
    {
        $uri = current_url(true);
        $data['uri'] = $uri->getSegment(1); 
        
        $data['userdata']  = $this->session->get('userdata');
        
        return  render('frontend/latest_winners_of_science_scholars', $data);
   
    }   

   

}
