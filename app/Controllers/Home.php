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
        $editdata = array();

        if(strtolower($this->request->getMethod()) == 'post'){
          
              $this->validation->setRules($this->validation_rules());
                    
              if(!$this->validation->withRequest($this->request)->run()) {
                  $data['validation'] = $this->validation;
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
              }
              
        }
       
        $editdata['contact_name']     = ($this->request->getVar('contact_name'))?$this->request->getVar('contact_name'):'';
        $editdata['email']    = ($this->request->getVar('email'))?$this->request->getVar('email'):'';
        $editdata['message']  = ($this->request->getVar('message'))?$this->request->getVar('message'):'';
  

        $uri = current_url(true);
        $data['uri'] = $uri->getSegment(1);  
        $data['editdata'] = $editdata;
      
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

      sendMail($email,$subject,$html);

    }

    public function sendMailtoAdmin($email='',$name="",$message = '')
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
      $message .= "<b>Message:</b> ". $message;
      $message .= "<br/>";
      $message .= "Thanks & Regards,";
      $message .= "<br/>";
      $message .= "Sunpharma Science Foundation Team";
    
      $data['content'] = $message;
      $html = view('email/mail',$data,array('debug' => false));

      sendMail($adminEmail,$subject,$html);

    }
}
