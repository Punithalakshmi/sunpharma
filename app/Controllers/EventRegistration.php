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
        return  render('frontend/event_registeration',$data);
              
    }

    public function event()
    {

        helper(array('form', 'url'));
        $userdata  = $this->session->get('fuserdata');
        $uri       = current_url(true);
    
        $data['uri'] = $uri->getSegment(1);

        if(!empty($id)){
            $getUserData = $this->userModel->getUserData($id);
            $edit_data   = $getUserData->getRowArray();
        }

    
        $this->validation = $this->validate($this->validation_rules());
        
        if($this->validation) {

            if($this->request->getPost()){
                
                $category                    = $this->request->getPost('category');
                $firstname                   = $this->request->getPost('nominee_name');
                $dob                         = $this->request->getPost('date_of_birth');
                $citizenship                 = $this->request->getPost('citizenship');
                $email                       = $this->request->getPost('email');
                $phonenumber                 = $this->request->getPost('mobile_no');
                $address                     = $this->request->getPost('designation_and_office_address');
                $residence_address           = $this->request->getPost('residence_address');
               

                $ins_data = array();
                $ins_data['firstname']  = $firstname;
                $ins_data['email']      = $email;
                $ins_data['phone']      = $phonenumber;
                $ins_data['address']    = $address;
                $ins_data['dob']        = date("Y/m/d",strtotime($dob));
                

                
                $this->session->setFlashdata('msg', 'Submitted Successfully!');
                $ins_data['created_date']  =  date("Y-m-d H:i:s");
                $ins_data['created_id']    =  1;
                $this->userModel->save($ins_data);
                $lastInsertID = $this->userModel->insertID();

              
                $this->sendMail($firstname,$lastInsertID);

                return redirect()->to('success');
            }
        }
        else
        {  
        
            $editdata['category']                      = ($this->request->getPost('category'))?$this->request->getPost('category'):'';
            $editdata['nominee_name']                  = ($this->request->getPost('nominee_name'))?$this->request->getPost('nominee_name'):'';
            $editdata['citizenship']                   = ($this->request->getPost('citizenship'))?$this->request->getPost('citizenship'):'';
            $editdata['designation_and_office_address']= ($this->request->getPost('designation_and_office_address'))?$this->request->getPost('designation_and_office_address'):'';
            $editdata['residence_address']             = ($this->request->getPost('residence_address'))?$this->request->getPost('residence_address'):'';
            $editdata['email']                         = ($this->request->getPost('email'))?$this->request->getPost('email'):'';
            $editdata['mobile_no']                     = ($this->request->getPost('mobile_no'))?$this->request->getPost('mobile_no'):'';
            $editdata['date_of_birth']                 = ($this->request->getPost('date_of_birth'))?$this->request->getPost('date_of_birth'):'';
           
        
            if($this->request->getPost())
              $data['validation'] = $this->validator;

            $data['editdata'] = $editdata;
            $data['userdata'] = $userdata;
            $data['nomination'] = $id;

            
            return  render('frontend/ssan_new',$data);
                        
                        
        }



    }

    
}
