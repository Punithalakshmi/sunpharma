<?php

namespace App\Controllers;

class ResearchAwards extends BaseController
{
    public function index()
    {
       
        $nominationLists = $this->nominationTypesModel->getActiveNomination()->getResultArray();
   
        $currentNominations = array("research_awards" => "no", "science_scholars_awards" => "no");
        $currentDate = strtotime(date('Y-m-d'));
        foreach($nominationLists as $nkey => $nvalue){
            $endDate = strtotime($nvalue['end_date']);
          if($endDate >= $currentDate)  {
            if($nvalue['main_category_id'] == 1){
              $currentNominations['research_awards'] = 'yes';
            }
            if($nvalue['main_category_id'] == 2){
              $currentNominations['science_scholars_awards'] = 'yes';
            }
         }
        }

        $this->data['currentNominations'] = $currentNominations;
        return render('frontend/research_awards',$this->data);
            
    }

   

}
