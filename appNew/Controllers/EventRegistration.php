<?php

namespace App\Controllers;
 
class EventRegistration extends BaseController
{
   public function index()
    {
        return  render('frontend/event',$this->data);   
    }

    public function event($event_id = '')
    {


	 $event_id  = ($this->request->getPost('event_id'))?$this->request->getPost('event_id'):$event_id;

         $this->validation = $this->validation->setRules($this->validation_rules($event_id),$this->validationMessages());
		 
        // $registerationNo   = $this->getRegisterationNo($event_id);

         $this->data['eventTypes']  = $this->workshopModel->getEventTypes()->getResultArray();
		 
		 
        
        if($this->validation->withRequest($this->request)->run()) {

            if($this->request->getPost()){
                
                $firstname                   = $this->request->getPost('firstname');
                $lastname                    = $this->request->getPost('lastname');
                $email                       = $this->request->getPost('email');
                $phone                       = $this->request->getPost('phone');
                $address                     = $this->request->getPost('address');
		$event_id                   = $this->request->getPost('event_id');
               // $registerationNo             = $this->request->getPost('registeration_no');
              //  $event_type                  = $this->request->getPost('event_type');
		 $mode                        = $this->request->getPost('participation_mode');
               
              //  $registerationNo = $this->getRegisterationNo($event_id);

                $ins_data = array();
                $ins_data['firstname']     = $firstname;
                $ins_data['lastname']      = $lastname;
                $ins_data['email']         = $email;
                $ins_data['address']       = $address;
                $ins_data['phone']         = $phone;
		$ins_data['mode']       = $mode;
		$ins_data['event_id']      = $event_id;
		 $registerationNo = $this->getRegisterationNo($event_id); 
		$ins_data['registeration_no']   = $registerationNo;
               // $ins_data['registeration_no'] = $registerationNo; 
              //  $ins_data['event_type'] = $event_type;
                
            
                $this->session->setFlashdata('msg', 'Thank you! Your registration is successfully submitted');
                $ins_data['created_date']  =  date("Y-m-d H:i:s");
                $ins_data['created_id']    =  1;
				
				
                $this->registerationModel->save($ins_data);
				
		//$this->registerationModel->update(array("id" => $lastInsertID),$up_data);

                $getEventData = $this->workshopModel->getLists($event_id)->getRowArray();
				
                $this->sendMail($email,$registerationNo,$firstname,$getEventData['title'],$getEventData['subject']);
						
		$this->adminMail($registerationNo,$firstname,$getEventData['title'],$email,$phone,$address);

                return redirect()->to('/event/registration/'.$event_id);
            }
        }
        else
        {  
        
	     $getCountOfRegistrationMode     = $this->registerationModel->getWhere(array("event_id" => 7, "mode"=>"Onsite"))->getResultArray();
		$defaultSelectMode          = (count($getCountOfRegistrationMode)>=200)?'Online':'';
            $editdata['firstname']          = ($this->request->getPost('firstname'))?$this->request->getPost('firstname'):'';
            $editdata['lastname']           = ($this->request->getPost('lastname'))?$this->request->getPost('lastname'):'';
            $editdata['email']              = ($this->request->getPost('email'))?$this->request->getPost('email'):'';
            $editdata['phone']              = ($this->request->getPost('phone'))?$this->request->getPost('phone'):'';
            $editdata['address']            = ($this->request->getPost('address'))?$this->request->getPost('address'):'';
		$editdata['event_id']           = ($this->request->getPost('event_id'))?$this->request->getPost('event_id'):$event_id;
          //  $editdata['registeration_no'] = ($this->request->getPost('registeration_no'))?$this->request->getPost('registeration_no'):$registerationNo;
           // $editdata['event_type']       = ($this->request->getPost('event_type'))?$this->request->getPost('event_type'):'';
             $editdata['participation_mode'] = ($this->request->getPost('participation_mode'))?$this->request->getPost('participation_mode'):$defaultSelectMode;
	    $editdata['event_id'] = ($this->request->getPost('event_id'))?$this->request->getPost('event_id'):$event_id;
            
            if($this->request->getPost())
              $this->data['validation'] = $this->validation;

            $this->data['editdata'] = $editdata;
            
            return  render('frontend/event_registeration',$this->data);
                                      
        }

    }


    public function validation_rules($id='')
    {

        $validation_rules = array();
        $validation_rules = array(
                                    "firstname" => array("label" => "Firstname",'rules' => 'required'),
                                    "lastname" => array("label" => "Lastname",'rules' => 'required'),
                                    "email" => array("label" => "Email",'rules' => 'required|valid_email|checkUniqueEmailForRegisteration['.$id.']'),
                                    "phone" => array("label" => "Phone",'rules' => 'required|min_length[10]'),
                                    "address" => array("label" => "Official Address",'rules' => 'required'),
				     "participation_mode" => array("label" => "Participation Mode", 'rules' => 'required|checkRegistrationModeLimit['.$id.']')
                                   // "registeration_no" => array("label" => "Registration No",'rules' => 'required'),
                                 //   "event_type" => array("label" => "Event Type",'rules' => 'required')
        ); 

        return $validation_rules;
      
    }
	
	public function validationMessages()
    {

        $validationMessages = array("firstname" => array("required" => "Please enter firstname"),
                                    "lastname" => array("required" => "Please enter lastname"),
                                    "email" => array("required" => "Please enter Email","valid_email"=>"Please enter valid Email","checkUniqueEmailForRegisteration"=>"A registration with this email already exists"),
				"participation_mode" => array("required" => "Participation mode is mandatory","checkRegistrationModeLimit" => "Onsite registrations are closed. Please select the Online mode.")
                              );

         return $validationMessages;
    }


    public function sendMail($email,$registerationNo,$name,$title,$sub)
    {

        $header  = '';
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        $login_url = base_url().'/admin';

        $subject  = "Event Registration - Sun Pharma Science Foundation ";
        $message  = "Hi ".ucfirst($name).",";
        $message .= '<br/><br/>';
        $message .= 'Your registration to this event <b>'.$title.'</b> is confirmed. ';
        $message .= "<br/><br/>";
        $message .= 'Registration No: '.$registerationNo;
        $message .= "<br/><br/>";
	$message .= $sub;
	////$message .= "<br/>";
	///$message .= $subject;
 	$message .= "<br/><br/>";
        $message .= "Thanks & Regards,";
        $message .= "<br/>";
        $message .= "Sunpharma Science Foundation Team";
       
        
		
	sendMail($email,$subject, $message);


    }
	
	public function adminMail($registerationNo,$name,$title,$email,$phone,$address)
    {

       
        $subject  = "Event Registration";
        $message  = "Hi ,";
        $message .= '<br/><br/>';
        $message .= 'You have a new registration for the event <b>'.$title.'</b>';
        $message .= 'with the registration ID: '.$registerationNo;
		$message .= "<br/>";
		$message .= "Name: ".$name;
		$message .= "<br/>";
		$message .= "Email: ".$email;
		$message .= "<br/>";
		$message .= "Phone: ".$phone;
		$message .= "<br/>";
		$message .= "Address: ".$address;
        $message .= "<br/><br/>";
        $message .= "Thanks & Regards,";
        $message .= "<br/>";
        $message .= "Sunpharma Science Foundation Team";
       
        

		sendMail('sunpharma.sciencefoundation@sunpharma.com',$subject,$message);
		//sendMail('punitha.izaap@gmail.com',$subject,$message);


    }

    function read_more($id = '')
    {

        if($id){
            $eventData = $this->workshopModel->getLists($id)->getRowArray();

            
        }
        else
        {
            $eventData['banner_image'] = '';
            $eventData['description'] = '';
            $eventData['subject']     = '';
            $eventData['title']      = '';
            $eventData['document']      = '';
            $eventData['agenda']      = '';
         //   $eventData['title']      = '';
        }
        $this->data['eventData'] = $eventData;
        return  render('frontend/read_more',$this->data);
    }

    public function getRegisterationNo($event_id='')
    {
        $getLists = $this->registerationModel->getEventRegisteredUsers($event_id);
        $getList    = $getLists->getResultArray();
	$ct = count($getList) + 1;  
        return 'SPSFN-'.$event_id.'-REG-'.$ct;
    }

    function close()
    {
        return  render('frontend/event_close',$this->data);
    }  
     
    
}
