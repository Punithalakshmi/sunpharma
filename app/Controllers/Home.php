<?php

namespace App\Controllers;
 
class Home extends BaseController
{
    public function index()
    {
        
        $userdata = $this->session->get('fuserdata');

        $uri = current_url(true);
        $data['uri'] = $uri->getSegment(1); 
        
        $data['userdata'] = $userdata;

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
          $categoryDt =  $this->categoryModel->getListsOfCategories($evalue['category_id'])->getRowArray();
          $categoryNominationLists[$ekey]['category'] = $categoryDt['name'];
          $categoryNominationLists[$ekey]['category_type'] =  $categoryDt['type'];
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

        $data['currentNominations'] = $currentNominations;

        //get latest winners of research awards
        $researchAwards = $this->awardsModel->getLatestWinnersofResearchAwards()->getResultArray();

        //get latest winners of science scholars awards
        $scienceScholarAwards = $this->awardsModel->getLatestWinnersofScienceScholarAwards()->getResultArray();

        $data['nominations'] = $nominationArr;
        $data['latestWinnersOfResearchAwards'] = $researchAwards;
        $data['latestWinnersOfScholarAwards'] = $scienceScholarAwards;
        return  render('frontend/dashboard',$data);
              
    }

    public function aboutus()
    {

        $uri = current_url(true);
        $data['uri'] = $uri->getSegment(1); 

        $userdata = $this->session->get('fuserdata');
        $data['userdata'] = $userdata;

        return  render('frontend/mission',$data);
              
    }

    public function annualActivities()
    {

      $uri = current_url(true);
            $data['uri'] = $uri->getSegment(1); 
       
        $userdata = $this->session->get('fuserdata');
        $data['userdata'] = $userdata;

        return render('frontend/annual_activities',$data);
   
    }

    public function nominationPreview()
    {
      $uri = current_url(true);
      $data['uri'] = $uri->getSegment(1); 
       
        $userdata = $this->session->get('fuserdata');
        $data['userdata'] = $userdata;

        return  render('frontend/nomination_preview',$data);

    }

    public function contact()
    {
        $uri = current_url(true);
        $data['uri'] = $uri->getSegment(1); 
          
        $userdata =$this->session->get('fuserdata');
        $data['userdata'] = $userdata;

        return render('frontend/contact',$data);
        
    }

    public function research_awards()
    {
      $uri = current_url(true);
      $data['uri'] = $uri->getSegment(1); 
   
      $userdata = $this->session->get('fuserdata');
      $data['userdata'] = $userdata;

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

    public function science_scholar_awards()
    {

      $uri = current_url(true);
      $data['uri'] = $uri->getSegment(1); 

      
      $data['userdata'] = $this->session->get('fuserdata');
       
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
        
        return render('frontend/science_scholar_awards',$data);
    }

    public function symposium()
    {

      $uri = current_url(true);
            $data['uri'] = $uri->getSegment(1); 
       
        $userdata =$this->session->get('fuserdata');
        $data['userdata'] = $userdata;

        return  render('frontend/symposium',$data);
               
    }

    public function annualforeign_scientist()
    {

      $uri = current_url(true);
            $data['uri'] = $uri->getSegment(1); 
       
        $userdata = $this->session->get('fuserdata');
        $data['userdata'] = $userdata;

        return  render('frontend/annualforeignscientist',$data);
               
    }

    public function roundtable()
    {

        $uri = current_url(true);
        $data['uri'] = $uri->getSegment(1); 
    
        $userdata = $this->session->get('fuserdata');
        $data['userdata'] = $userdata;

        return  render('frontend/roundtable',$data);
                
    }
}
