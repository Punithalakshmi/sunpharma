<?php

namespace App\Controllers;
 
class Home extends BaseController
{
    public function index()
    {
        
        $nominationLists = $this->nominationTypesModel->getCategoryWiseNominations()->getResultArray();

        $categoryNominationLists = $this->nominationTypesModel->getActiveNomination()->getResultArray();
     
        $eventLists = $this->workshopModel->getActiveEvents()->getResultArray();

      //  print_r($eventLists); die;

        $nominationArr = array();
        
        $current_date = strtotime(date("Y-m-d"));
         foreach($eventLists as $ekey => $evalue) {
         
           //$end_date     = strtotime($evalue['end_date']);
          // if($end_date > $current_date): 
            array_push($nominationArr,$eventLists[$ekey]);
          // endif;  
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
        $this->data['latestWinnersOfResearchAwards'] = getAwardsArr($researchAwards);
        $this->data['latestWinnersOfScholarAwards'] = getAwardsArr($scienceScholarAwards);
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

       
        $editdata = array();

       
        if(strtolower($this->request->getMethod()) == 'post'){
        //  echo $this->request->getMethod(); die;
              $this->validation->setRules($this->validation_rules());
                    
              if(!$this->validation->withRequest($this->request)->run()) {
                  $this->data['validation'] = $this->validation;
                  $editdata['contact_name']     = ($this->request->getVar('contact_name'))?$this->request->getVar('contact_name'):'';
          $editdata['email']    = ($this->request->getVar('email'))?$this->request->getVar('email'):'';
          $editdata['message']  = ($this->request->getVar('message'))?$this->request->getVar('message'):'';
    
                  
              }
              else
              {

                  $name         = $this->request->getVar('contact_name');
                  $email        = $this->request->getVar('email');
                  $message      = $this->request->getVar('message');

                  $recaptchaResponse = trim($this->request->getVar('g-recaptcha-response'));
            
                  $userIp=$this->request->getIPAddress();
                
                  //captcha verification
                  $captchaVerify = captchaVerification($recaptchaResponse,$userIp='');
             
                  if(isset($captchaVerify['success']) && $captchaVerify['success']){ 
                   
                    $ins_data = array();
                    $ins_data['name'] = $name;
                    $ins_data['email'] = $email;
                    $ins_data['message'] = $message;
                    $ins_data['created_date'] = date("Y-m-d");
                    $this->contactModel->save($ins_data);
                    //send mail to contact person
                    $this->sendMailtoContactUser($email,$name);

                    //send mail to admin
                    $this->sendMailtoAdmin($email,$name,$message);
                    $this->session->setFlashdata('msg', 'Your contact request has been submitted successfully');
                   }
                   else
                   {
                    $this->session->setFlashdata('msg', 'Please verify Captcha!');
                   }
				   
				   redirect()->to('/contact');
              }
              
        }
        else
        {
          
          $editdata['contact_name']     = ($this->request->getVar('contact_name'))?$this->request->getVar('contact_name'):'';
          $editdata['email']    = ($this->request->getVar('email'))?$this->request->getVar('email'):'';
          $editdata['message']  = ($this->request->getVar('message'))?$this->request->getVar('message'):'';
    
        }
   
          $this->data['editdata'] = $editdata;
      
        return render('frontend/contact',$this->data);
        
    }

    public function research_awards()
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

    public function science_scholar_awards()
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

    public function validation_rules()
    {

            $validation_rules = array();
            $validation_rules = array(
                                      "contact_name" => array("label" => "Name",'rules' => 'required|max_length[15]'),
                                      "email" => array("label" => "Email",'rules' => 'required|valid_email'),
                                      "message" => array("label" => "Message",'rules' => 'required'),
            ); 
            return $validation_rules;
      
    }

    public function sendMailtoContactUser($email='',$name="")
    {

      $subject = " Contact - Sun Pharma Science Foundation ";
      $message  = "Dear ".$name.",";
      $message .= '<br/><br/>';
      $message .=  "Thank you for reaching out.";
      $message .= "<br/><br/>";
      $message .= "We will get back to you!";
      $message .= "<br/><br/><br/>";
      $message .= "Thanks & Regards,";
      $message .= "<br/>";
      $message .= "Sunpharma Science Foundation Team";
    
      $data['content'] = $message;
      $html = view('email/mail',$data,array('debug' => false));

      sendMail($email,$subject,$message);

    }

    public function sendMailtoAdmin($email='',$name="",$msg = '')
    {

      $adminEmail = 'punitha@izaaptech.in';
      $subject = " New Contact Request - Sun Pharma Science Foundation ";
      $message  = "Dear Admin,";
      $message .= '<br/><br/>';
      $message .=  "New Contact Request Submitted by <b>".ucfirst($name)."</b>";
      $message .=  "<h2>Contact Request Submitted</h2>";
      $message .= "<br/><br/>";
      $message .= "<b>Name: </b>". $name;
      $message .= "<br/>";
      $message .= "<b>Email:</b> ". $email;
      $message .= "<br/>";
      $message .= "<b>Message:</b> ". $msg;
      $message .= "<br/>";
      $message .= "Thanks & Regards,";
      $message .= "<br/>";
      $message .= "Sunpharma Science Foundation Team";
    
      $data['content'] = $message;
      $html = view('email/mail',$data,array('debug' => false));

      sendMail($adminEmail,$subject,$message);

    }

    public function getAwardsArr($awards = array())
    {

        if(is_array($awards)) {

          foreach($awards as $akey => $avalue){
             $categoryArr = $this->categoryModel->getListsOfCategories($avalue['category'])->getRowArray();
             $awards[$akey]['category_name'] = $categoryArr['type'];

             $nomineePhoto = $this->nominationModel->getNominationData($avalue['id'])->getRowArray();
             $awards[$akey]['nominator_photo'] = $nomineePhoto['nominator_photo'];

          }
  
        }

        return $awards;
    }
}
