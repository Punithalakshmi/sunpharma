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
               
                $getNominationData   = $this->nominationModel->getNominationData($result['id']);
                $getNominationData   = $getNominationData->getRowArray();
                
                $getCategoryNominationData   = $this->nominationTypesModel->getCategoryNomination($getNominationData['category_id']);
                $getNominationDaysCt         = $getCategoryNominationData->getRowArray();

                //get extend nomination date
                $getExtendNominationDate   = $this->extendModel->getListsOfExtends($result['id']);

                $getExtendNominationEndDays = 0;
               if($getExtendNominationDate->getRowArray() > 0) {
                $getExtendNominationDate = $getExtendNominationDate->getRowArray();
                 $getExtendNominationEndDays = $this->dateDiff(date("Y-m-d"),$getExtendNominationDate['extend_date']);
               }  

                $nominationEndDays =  $this->dateDiff(date("Y-m-d"),$getNominationDaysCt['end_date']);

                if($nominationEndDays <= 0 && $getExtendNominationEndDays > 0)
                  $result['nominationEndDays'] =  $getExtendNominationEndDays;
                else
                  $result['nominationEndDays'] =  $nominationEndDays;  

                $result['nominationEndDate'] = $getNominationDaysCt['end_date'];
                $result['nomination_type']   = $getNominationData['nomination_type'];

                $this->session->set('fuserdata',$result);
                $redirect_route = 'view/'.$result['id'];

                return redirect()->to($redirect_route);
            }    
        }
       
            $uri = current_url(true);
            $data['uri'] = (base_url() == 'http://local.sunpharma.md/')?$uri->getSegment(1):$uri->getSegment(3);
           
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
        $this->session->remove('fuserdata');
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

     
    public function sendMail()
    {

   
        $header  = '';
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        $subject = " New Nomination ";
        $message  = "Hi, ";
        $message .= '<br/><br/>';
        $message .= "New candidate was submitted application, Please login and check the nomination data in admin panel";
        $message .= "<br/>";
        $message .= "<br/>";
        $message .= "<br/>";
        $message .= "Thanks & Regards,";
        $message .= "Sunpharma Team";
        $html = view('email/mail',array(),array('debug' => false));

        mail("punitha@izaaptech.in",$subject,$html,$header);

    }

    public function uniqueValidation()
    {
        if($this->request->getPost()){
            
            $email = $this->request->getPost('email');
            $table = $this->request->getPost('chkTable');
            $type  = $this->request->getPost('chkType');
            
            $existsOrNot = $this->userModel->uniqueValidation();
          
        }
    }

}    