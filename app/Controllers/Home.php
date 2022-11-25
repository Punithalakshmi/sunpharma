<?php

namespace App\Controllers;

use App\Models\NominationTypesModel;
  
class Home extends BaseController
{
    public function index()
    {
        $session   = \Config\Services::session();
        $userdata = $session->get('userdata');

        $uri = current_url(true);
        $data['uri'] = $uri->getSegment(1); 
        
        $data['userdata'] = $userdata;

        $nominationModel = new NominationTypesModel();
        
        $nominationLists = $nominationModel->getCategoryWiseNominations()->getResultArray();
       
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
        
        return   view('frontend/_partials/header',$data)
                 .view('frontend/dashboard',$data)
                 .view('frontend/_partials/footer');
    }

    public function aboutus()
    {

        $uri = current_url(true);
        $data['uri'] = $uri->getSegment(1); 
        $session   = \Config\Services::session();
        $userdata = $session->get('userdata');
        $data['userdata'] = $userdata;

        return  view('frontend/_partials/header',$data)
                .view('frontend/mission',$data)
                 .view('frontend/_partials/footer');
    }

    public function annualActivities()
    {

      $uri = current_url(true);
            $data['uri'] = $uri->getSegment(1); 
        $session   = \Config\Services::session();
        $userdata = $session->get('userdata');
        $data['userdata'] = $userdata;

        return  view('frontend/_partials/header',$data)
               .view('frontend/annual_activities',$data)
                .view('frontend/_partials/footer');
    }

    public function nominationPreview()
    {
      $uri = current_url(true);
      $data['uri'] = $uri->getSegment(1); 
        $session   = \Config\Services::session();
        $userdata = $session->get('userdata');
        $data['userdata'] = $userdata;

        return  view('frontend/_partials/header',$data)
               .view('frontend/nomination_preview',$data)
                .view('frontend/_partials/footer');
    }

    public function contact()
    {
      $uri = current_url(true);
            $data['uri'] = $uri->getSegment(1); 
        $session   = \Config\Services::session();
        $userdata = $session->get('userdata');
        $data['userdata'] = $userdata;
        return view('frontend/_partials/header',$data)
                .view('frontend/contact',$data)
                .view('frontend/_partials/footer');
    }

    public function research_awards()
    {
      $uri = current_url(true);
      $data['uri'] = $uri->getSegment(1); 
      $session   = \Config\Services::session();
      $userdata = $session->get('userdata');
      $data['userdata'] = $userdata;

      $nominationModel = new NominationTypesModel();
        
        $nominationLists = $nominationModel->getCategoryWiseNominations()->getResultArray();
       
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

        return view('frontend/_partials/header',$data)
                .view('frontend/research_awards',$data)
                .view('frontend/_partials/footer');

    }

    public function science_scholar_awards()
    {

      $uri = current_url(true);
      $data['uri'] = $uri->getSegment(1); 

        $session   = \Config\Services::session();
        $userdata = $session->get('userdata');
        $data['userdata'] = $userdata;

        $nominationModel = new NominationTypesModel();
        
        $nominationLists = $nominationModel->getCategoryWiseNominations()->getResultArray();
       
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
        
        return view('frontend/_partials/header',$data)
                .view('frontend/science_scholar_awards',$data)
                .view('frontend/_partials/footer');

    }

    public function symposium()
    {

      $uri = current_url(true);
            $data['uri'] = $uri->getSegment(1); 
        $session   = \Config\Services::session();
        $userdata = $session->get('userdata');
        $data['userdata'] = $userdata;

        return  view('frontend/_partials/header',$data)
               .view('frontend/symposium',$data)
                .view('frontend/_partials/footer');
    }

    public function annualforeign_scientist()
    {

      $uri = current_url(true);
            $data['uri'] = $uri->getSegment(1); 
        $session   = \Config\Services::session();
        $userdata = $session->get('userdata');
        $data['userdata'] = $userdata;

        return  view('frontend/_partials/header',$data)
               .view('frontend/annualforeignscientist',$data)
                .view('frontend/_partials/footer');
    }

    public function roundtable()
    {

      $uri = current_url(true);
            $data['uri'] = $uri->getSegment(1); 
        $session   = \Config\Services::session();
        $userdata = $session->get('userdata');
        $data['userdata'] = $userdata;

        return  view('frontend/_partials/header',$data)
               .view('frontend/roundtable',$data)
                .view('frontend/_partials/footer');
    }
}
