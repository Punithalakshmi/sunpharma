<?php

namespace App\Controllers;
 
class Home extends BaseController
{
    public function index()
    {
        
        

        $nominationLists = $this->nominationTypesModel->getCategoryWiseNominations()->getResultArray();

        $categoryNominationLists = $this->nominationTypesModel->getActiveNomination()->getResultArray();
     
        $eventLists = $this->workshopModel->getActiveEvents()->getResultArray();

        $nominationArr = array();
        
        $current_date = strtotime(date("Y-m-d"));
        foreach($eventLists as $ekey => $evalue) {
         
          $end_date     = strtotime($evalue['end_date']);
          if($end_date > $current_date): 
            array_push($nominationArr,$eventLists[$ekey]);
          endif;  
        }

        foreach($categoryNominationLists as $ekey => $evalue) {
          //get category name
          $categoryDt =  $this->awardsCategoryModel->getListsOfCategories($evalue['main_category_id'])->getRowArray();
          $categoryNominationLists[$ekey]['category'] = $categoryDt['name'];
          $categoryNominationLists[$ekey]['category_type'] =  'awards';
          $end_date     = strtotime($evalue['end_date']);
          if($end_date > $current_date): 
            array_push($nominationArr,$categoryNominationLists[$ekey]);
          endif;  
        }
    
     
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

        $this->data['currentNominations'] = $currentNominations;

        //get latest winners of research awards
        $researchAwards = $this->awardsModel->getLatestWinnersofResearchAwards()->getResultArray();

        //get latest winners of science scholars awards
        $scienceScholarAwards = $this->awardsModel->getLatestWinnersofScienceScholarAwards()->getResultArray();

        $this->data['nominations'] = $nominationArr;
        $this->data['latestWinnersOfResearchAwards'] = $researchAwards;
        $this->data['latestWinnersOfScholarAwards'] = $scienceScholarAwards;
        return  render('frontend/dashboard',$this->data);
              
    }

    public function aboutus()
    {

        return  render('frontend/mission',$this->data);
              
    }

    public function annualActivities()
    {

        return render('frontend/annual_activities',$this->data);
   
    }

    public function nominationPreview()
    {
      
        return  render('frontend/nomination_preview',$this->data);

    }

    public function contact()
    {
       
        return render('frontend/contact',$this->data);
        
    }

    public function research_awards()
    {
      
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

        $this->data['currentNominations'] = $currentNominations;

        return render('frontend/research_awards',$this->data);
             
    }

    public function science_scholar_awards()
    {

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

        $this->data['currentNominations'] = $currentNominations;
        
        return render('frontend/science_scholar_awards',$this->data);
    }

    public function symposium()
    {

        return  render('frontend/symposium',$this->data);
    }

    public function annualforeign_scientist()
    {

        return  render('frontend/annualforeignscientist',$this->data);
       
    }

    public function roundtable()
    {

        return  render('frontend/roundtable',$this->data);
                
    }
}
