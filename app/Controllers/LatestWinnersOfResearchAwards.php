<?php

namespace App\Controllers;


class LatestWinnersOfResearchAwards extends BaseController
{
    public function index()
    {
        $uri = current_url(true);
        $data['uri'] = $uri->getSegment(1); 
       
        $data['userdata'] = $this->session->get('userdata');
        
        return view('frontend/latest_winners_of_research_awards', $data);
     
    }   

   

}
