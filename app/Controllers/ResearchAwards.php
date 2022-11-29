<?php

namespace App\Controllers;

class ResearchAwards extends BaseController
{
    public function index()
    {
        $uri = current_url(true);
        $data['uri'] = $uri->getSegment(1); 
       
        $data['userdata'] = $this->session->get('userdata');
        
        $nominationLists = $this->nominationTypesModel->getCategoryWiseNominations()->getResultArray();
       
        $currentNominations = array("research_awards" => "no", "science_scholars_awards" => "no");
        $currentDate = strtotime(date('Y-m-d'));
        foreach($nominationLists as $nkey => $nvalue){
            $endDate = strtotime($nvalue['end_date']);
          if($endDate >= $currentDate)  {
            if($nvalue['type'] == 'Research Awards'){
              $currentNominations['research_awards'] = 'yes';
            }
            else
            {
              $currentNominations['science_scholars_awards'] = 'yes';
            }
         }
        }

        $data['currentNominations'] = $currentNominations;
        return render('frontend/research_awards',$data);
            
    }

   

}
