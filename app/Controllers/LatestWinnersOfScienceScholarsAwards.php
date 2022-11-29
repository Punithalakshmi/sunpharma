<?php

namespace App\Controllers;

class LatestWinnersOfScienceScholarsAwards extends BaseController
{
    public function index()
    {
        $uri = current_url(true);
        $data['uri'] = $uri->getSegment(1); 
        
        $data['userdata']  = $this->session->get('fuserdata');

        //get latest winners of science scholars awards
        $scienceScholarAwards = $this->awardsModel->getLatestWinnersofScienceScholarAwards()->getResultArray();
        $data['latestWinnersOfScholarAwards'] = $scienceScholarAwards;
        
        return  render('frontend/latest_winners_of_science_scholars', $data);
   
    }   

   

}
