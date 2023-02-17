<?php

namespace App\Controllers;


class LatestWinnersOfResearchAwards extends BaseController
{
    public function index()
    {
       
        //get latest winners of research awards
        $researchAwards = $this->winnersModel->getLatestWinnersByCategory(1)->getResultArray();

        $this->data['latestWinnersOfResearchAwards'] = $researchAwards;
        
        return render('frontend/latest_winners_of_research_awards', $this->data);
     
    }   

   

}
