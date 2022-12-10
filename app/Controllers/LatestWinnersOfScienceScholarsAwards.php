<?php

namespace App\Controllers;

class LatestWinnersOfScienceScholarsAwards extends BaseController
{
    public function index()
    {
      

        //get latest winners of science scholars awards
        $scienceScholarAwards = $this->awardsModel->getLatestWinnersofScienceScholarAwards()->getResultArray();
       
        
        $this->data['latestWinnersOfScholarAwards'] = getAwardsArr($scienceScholarAwards);
        
        return  render('frontend/latest_winners_of_science_scholars', $this->data);
   
    }   

   

}
