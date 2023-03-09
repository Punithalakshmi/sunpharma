<?php

namespace App\Controllers;


class DirectoryScienceScholars extends BaseController
{
    public function index()
    {
    

        $researchAwards = $this->winnersModel->getLatestWinnersByCategory(2,false)->getResultArray();
        $i = 0;
        $researchAwardees = array();
        $rawards = array();
        if(is_array($researchAwards)){
            foreach($researchAwards as $rkey => $rvalue){
                $researchAwardees[$rvalue['year']][$i]['name']         = $rvalue['name'];
                $researchAwardees[$rvalue['year']][$i]['modalname']    = str_replace(" ","",$rvalue['name']);
              //  $researchAwardees[$rvalue['year']][$i]['bio']          = $rvalue['bio'];
              //  $researchAwardees[$rvalue['year']][$i]['designation']  = $rvalue['designation'];
              //  $researchAwardees[$rvalue['year']][$i]['address']      = $rvalue['address'];
                $researchAwardees[$rvalue['year']][$i]['category']     = $rvalue['category'];
            //    $researchAwardees[$rvalue['year']][$i]['main_category']= $rvalue['main_category'];
                $researchAwardees[$rvalue['year']][$i]['photo']         = $rvalue['photo'];
              //  $researchAwards[$rvalue['year']]['name']         = $rvalue['name'];
          
              $rawards[$i]['modalname']    = str_replace(" ","",$rvalue['name']);
              $rawards[$i]['name']         = $rvalue['name'];
              $rawards[$i]['bio']          = $rvalue['bio'];
              $rawards[$i]['designation']  = $rvalue['designation'];
              $rawards[$i]['address']      = $rvalue['address'];
              $rawards[$i]['photo']        = $rvalue['photo'];

              $i++;
            }
        }

    
        krsort($researchAwardees);
        krsort($rawards);
        $this->data['awardees'] = $researchAwardees;
        $this->data['rawards']  = $rawards;

        return  render('frontend/directory_of_science_scholars',$this->data);
              
    }

   

}
