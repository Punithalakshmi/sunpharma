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


        $this->validation = $this->validation->setRules($this->validation_rules($event_id),$this->validationMessages());
        
        $registerationNo = $this->getRegisterationNo($event_id);

        $this->data['eventTypes']  = $this->workshopModel->getEventTypes()->getResultArray();
        
        if($this->validation->withRequest($this->request)->run()) {

            if($this->request->getPost()){
                
                $firstname                   = $this->request->getPost('firstname');
                $lastname                    = $this->request->getPost('lastname');
                $email                       = $this->request->getPost('email');
                $phone                       = $this->request->getPost('phone');
                $address                     = $this->request->getPost('address');
                $registerationNo             = $this->request->getPost('registeration_no');
                $event_type                  = $this->request->getPost('event_type');
                $mode                        = $this->request->getPost('participation_mode');
               
                $registerationNo = $this->getRegisterationNo($event_id);

                $ins_data = array();
                $ins_data['firstname']     = $firstname;
                $ins_data['lastname']      = $lastname;
                $ins_data['email']         = $email;
                $ins_data['address']       = $address;
                $ins_data['phone']         = $phone;
                $ins_data['registeration_no'] = $registerationNo; 
                $ins_data['event_type']       = $event_type;
                $ins_data['mode']       = $mode;
                $ins_data['event_id']       = $event_id;
                
                $this->session->setFlashdata('msg', 'Registeration Submitted Successfully!');
                $ins_data['created_date']  =  date("Y-m-d H:i:s");
                $ins_data['created_id']    =  1;
                $this->registerationModel->save($ins_data);
                $lastInsertID = $this->registerationModel->insertID();

                $this->sendMail($email,$registerationNo,$firstname);

                return redirect()->to('/');
            }
        }
        else
        {  
        
            $editdata['firstname']        = ($this->request->getPost('firstname'))?$this->request->getPost('firstname'):'';
            $editdata['lastname']         = ($this->request->getPost('lastname'))?$this->request->getPost('lastname'):'';
            $editdata['email']            = ($this->request->getPost('email'))?$this->request->getPost('email'):'';
            $editdata['phone']            = ($this->request->getPost('phone'))?$this->request->getPost('phone'):'';
            $editdata['address']          = ($this->request->getPost('address'))?$this->request->getPost('address'):'';
            $editdata['registeration_no'] = ($this->request->getPost('registeration_no'))?$this->request->getPost('registeration_no'):$registerationNo;
            $editdata['participation_mode'] = ($this->request->getPost('participation_mode'))?$this->request->getPost('participation_mode'):'';
          //  $editdata['event_type']       = ($this->request->getPost('event_type'))?$this->request->getPost('event_type'):'';
            
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
                                   // "registeration_no" => array("label" => "Registration No",'rules' => 'required'),
                                 //   "event_type" => array("label" => "Event Type",'rules' => 'required')
        ); 

        return $validation_rules;
      
    }

    public function validationMessages()
    {

        $validationMessages = array("firstname" => array("required" => "Please enter firstname"),
                                    "lastname" => array("required" => "Please enter lastname"),
                                    "email" => array("required" => "Please enter Email","checkUniqueEmailForRegisteration"=>"A registration with this email already exists"),
                              );

         return $validationMessages;
    }


    public function sendMail($email,$registerationNo,$name)
    {

        $header  = '';
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        $login_url = base_url().'/admin';

        $subject  = "Event Registration - Sun Pharma Science Foundation ";
        $message  = "Hi ".ucfirst($name).",";
        $message .= '<br/><br/>';
        $message .= 'Your registration to this event is confirmed. ';
        $message .= "<br/><br/>";
        $message .= 'Registration No: '.$registerationNo;
        $message .= "<br/><br/>";
        $message .= "Thanks & Regards,";
        $message .= "<br/>";
        $message .= "Sunpharma Science Foundation Team";
       
		sendMail($email,$subject, $message);


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
       // $count = $this->registerationModel->CountAll(); 
        $getLists = $this->registerationModel->getWhere(array('event_id' => $event_id));
        $count    = $getLists->getResultArray();
        $ct = count($count) + 1;  

        return 'SPSFN-'.$event_id.'-REG-'.$ct;
    }


    function close()
    {
        return  render('frontend/event_close',$this->data);
    }
    
}
