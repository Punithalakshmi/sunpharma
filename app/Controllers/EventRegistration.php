<?php

namespace App\Controllers;
 
class EventRegistration extends BaseController
{
    public function index()
    {
        
        $userdata = $this->session->get('fuserdata');

        $uri = current_url(true);
        $data['uri'] = $uri->getSegment(1); 
        
        $data['userdata'] = $userdata;

         $data['editdata'] = array();
        return  render('frontend/event',$data);
              
    }

    public function event()
    {

        helper(array('form', 'url'));
        $userdata  = $this->session->get('fuserdata');
        $uri       = current_url(true);
    
        $data['uri'] = $uri->getSegment(1);

        $this->validation = $this->validate($this->validation_rules());

        $count = $this->registerationModel->CountAll();
            
        $ct = $count + 1;
            
        $registerationNo = 'SPSFN-REG-'.$ct;

        $data['event_categories']  = $this->workshopModel->getEventTypes()->getResultArray();
        
        if($this->validation) {

            if($this->request->getPost()){
                
                $firstname                   = $this->request->getPost('firstname');
                $lastname                    = $this->request->getPost('lastname');
                $email                       = $this->request->getPost('email');
                $phone                       = $this->request->getPost('phone');
                $address                     = $this->request->getPost('address');
                $registerationNo             = $this->request->getPost('registeration_no');
                $event_type                  = $this->request->getPost('event_type');
               
                $ins_data = array();
                $ins_data['firstname']     = $firstname;
                $ins_data['lastname']      = $lastname;
                $ins_data['email']         = $email;
                $ins_data['address']       = $address;
                $ins_data['phone']         = $phone;
                $ins_data['registeration_no'] = $registerationNo;
                $ins_data['event_type'] = $event_type;
                
            
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
            $editdata['event_type']       = ($this->request->getPost('event_type'))?$this->request->getPost('event_type'):'';
            
            if($this->request->getPost())
              $data['validation'] = $this->validator;

            $data['editdata'] = $editdata;
            $data['userdata'] = $userdata;
            
            return  render('frontend/event_registeration',$data);
                                      
        }



    }


    public function validation_rules()
    {

        $validation_rules = array();
        $validation_rules = array(
                                        "firstname" => array("label" => "Firstname",'rules' => 'required'),
                                        "lastname" => array("label" => "Lastname",'rules' => 'required'),
                                        "email" => array("label" => "Email",'rules' => 'required|valid_email|is_unique[event_registerations.email]'),
                                        "phone" => array("label" => "Phone",'rules' => 'required|min_length[10]'),
                                        "registeration_no" => array("label" => "Registration No",'rules' => 'required'),
                                        "event_type" => array("label" => "Event Type",'rules' => 'required')
        ); 

        return $validation_rules;
      
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
        $message .= 'Event Registration successfully registered.';
        $message .= "<br/><br/>";
        $message .= 'Registration No: '.$registerationNo;
        $message .= "<br/><br/>";
        $message .= "Thanks & Regards,";
        $message .= "<br/>";
        $message .= "Sunpharma Science Foundation Team";
       
        $data['content'] = $message;
        $html = view('email/mail',$data,array('debug' => false));

        mail($email,$subject,$html,$header);


    }

    
}
