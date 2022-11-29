<?php

namespace App\Controllers;


class LatestWinnersOfResearchAwards extends BaseController
{
    public function index()
    {
        $uri = current_url(true);
        $data['uri'] = $uri->getSegment(1); 
       
        $data['userdata'] = $this->session->get('userdata');

        //get latest winners of research awards
        $researchAwards = $this->awardsModel->getLatestWinnersofResearchAwards()->getResultArray();

        $data['latestWinnersOfResearchAwards'] = $researchAwards;
        
        return render('frontend/latest_winners_of_research_awards', $data);
     
    }   

   

}
