<?php

namespace App\Controllers;

use App\Models\NominationTypesModel;
  
class Home extends BaseController
{
    public function index()
    {
        $session   = \Config\Services::session();
        $userdata = $session->get('fuserdata');
        
        $data['userdata'] = $userdata;

        $nominationModel = new NominationTypesModel();
        
        $nominationLists = $nominationModel->getCategoryWiseNominations()->getResultArray();
       // echo "<pre>";
      //  print_r($nominationLists); die;
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
        
        return   view('frontend/header',$data)
                 .view('frontend/dashboard',$data)
                 .view('frontend/footer');
    }

    public function mission()
    {
        $session   = \Config\Services::session();
        $userdata = $session->get('fuserdata');
        $data['userdata'] = $userdata;

        return  view('frontend/header',$data)
                .view('frontend/mission',$data)
                 .view('frontend/footer');
    }

    public function annualActivities()
    {
        $session   = \Config\Services::session();
        $userdata = $session->get('fuserdata');
        $data['userdata'] = $userdata;

        return  view('frontend/header',$data)
               .view('frontend/annual_activities',$data)
                .view('frontend/footer');
    }

    public function nominationPreview()
    {
        $session   = \Config\Services::session();
        $userdata = $session->get('fuserdata');
        $data['userdata'] = $userdata;

        return  view('frontend/header',$data)
               .view('frontend/nomination_preview',$data)
                .view('frontend/footer');
    }

    public function contact()
    {
        $session   = \Config\Services::session();
        $userdata = $session->get('fuserdata');
        $data['userdata'] = $userdata;
        return view('frontend/header',$data)
                .view('frontend/contact',$data)
                .view('frontend/footer');
    }

 

}
