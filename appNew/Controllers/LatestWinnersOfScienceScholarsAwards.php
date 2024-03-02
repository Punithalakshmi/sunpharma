<?php

namespace App\Controllers;

class LatestWinnersOfScienceScholarsAwards extends BaseController
{
    public function index()
    {
      

        //get latest winners of science scholars awards
      
        $scienceScholarAwards  = $this->winnersModel->getLatestWinnersByCategory(2,true)->getResultArray();
        
        $this->data['latestWinnersOfScholarAwards'] = $scienceScholarAwards;
        
        return  render('frontend/latest_winners_of_science_scholars', $this->data);
   
    }   

   

}
