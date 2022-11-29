<?php

namespace App\Controllers;

class User extends BaseController
{
    
    public function login()
    {

        if($this->request->getPost()){

              $username   = $this->request->getPost('username');
              $password   = $this->request->getPost('password');
       
              $result   = $this->userModel->Login($username, md5($password));
              
             if(!$result) {
                 $this->session->setFlashdata('msg', 'Invalid Credentials');
             }
             else
             {
               // print_r($result); die;
                $getNominationData   = $this->nominationModel->getNominationData($result['id']);
                $getNominationData   = $getNominationData->getRowArray();
                
                $getCategoryNominationData   = $this->nominationTypesModel->getCategoryNomination($getNominationData['category_id']);
                $getNominationDaysCt         = $getCategoryNominationData->getRowArray();

              
               $nominationEndDays =  $this->dateDiff(date("Y-m-d"),$getNominationDaysCt['end_date']);
                
                $result['nominationEndDays'] =  $nominationEndDays;

                $result['nominationEndDate'] = $getNominationDaysCt['end_date'];

                $result['nomination_type'] = $getNominationData['nomination_type'];

                //print_r($result);
                //die;

                $this->session->set('userdata',$result);

                $redirect_route = 'view/'.$result['id'];

                return redirect()->to($redirect_route);
            }    
        }
       
            $uri = current_url(true);
            $data['uri'] = $uri->getSegment(1);  
           
            return  render('frontend/login',$data);

       
    }

    public function forget_password()
    {
        return  render('frontend/forget_password');
    }

    public function reset_password()
    {
        return  render('frontend/reset_password');
             
    }


    public function logout()
    {
        $this->session->remove('userdata');
        return redirect()->route('/');
    }

    public function dateDiff($date1, $date2)
    {
        $date1_ts = strtotime($date1);
        $date2_ts = strtotime($date2);
        $diff = $date2_ts - $date1_ts;
        return round($diff / 86400);
    }


    public function validForm()
    {
        $uri = current_url(true);
            $data['uri'] = $uri->getSegment(1); 
        return view('frontend/formvalid',$data);
    }


}    