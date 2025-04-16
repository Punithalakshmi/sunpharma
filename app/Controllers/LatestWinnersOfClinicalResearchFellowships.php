<?php

namespace App\Controllers;


class LatestWinnersOfClinicalResearchFellowships extends BaseController
{
    public function index()
    {
       
        //get latest winners of research awards
        $researchAwards = $this->winnersModel->getLatestWinnersByCategory(3,true)->getResultArray();

        $this->data['latestWinnersOfClinicalResearchFellowship'] = $researchAwards;
        
        return render('frontend/latest_winners_of_clinical_research_fellowship', $this->data);
     
    }   

   

}
