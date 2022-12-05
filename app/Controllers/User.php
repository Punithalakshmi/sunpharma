<?php

namespace App\Controllers;

class User extends BaseController
{
    
    public function login()
    {

        try
        {
            if (strtolower($this->request->getMethod()) == "post") {  
                
             $this->validation->setRules($this->validation_rules());
            
                if(!$this->validation->withRequest($this->request)->run()) {
                    $this->data['validation'] = $this->validation;
                }
                else
                {  

                    $username   = $this->request->getVar('username');
                    $password   = $this->request->getVar('password');
            
                    $data       = $this->userModel->where('username', $username)->first();
                    
                    if($data){

                        $pass = $data['password'];
                        $authenticatePassword = password_verify($password, $pass);

                        if($authenticatePassword){
                            $ses_data = [
                                'id' => $data['id'],
                                'name' => $data['name'],
                                'email' => $data['email'],
                                'isLoggedIn' => TRUE,
                                'role' => $data['role'],
                                'isNominee' => 'yes'
                            ];

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
                                $ses_data['nominationEndDays'] =  $getExtendNominationEndDays;
                            else
                                $ses_data['nominationEndDays'] =  $nominationEndDays;  
            
                            $ses_data['nominationEndDate'] = $getNominationDaysCt['end_date'];
                            $ses_data['nomination_type']   = $getNominationData['nomination_type'];

                            setSessionData('fuserdata',$ses_data);
                            $redirect_route = 'view/'.$result['id'];
        
                            return redirect()->to($redirect_route);
                        
                        }
                        else
                        {
                            throw new \Exception('Password is incorrect.');
                            return render('frontend/login',$this->data);
                        }
                    }
                    else
                    {
                        throw new \Exception('Username does not match.');
                        return render('frontend/login',$this->data);
                    }
                }     
            }
            else
            {
                $editdata['username'] = ($this->request->getVar('username'))?$this->request->getVar('username'):"";
                $editdata['password'] = ($this->request->getVar('password'))?$this->request->getVar('password'):"";
                $this->data['editdata'] = $editdata;
            }

            return  render('frontend/login',$this->data);
        }
        catch(\Exception $e){
            $this->session->setFlashdata($e->getMessage());
        }
       

       
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

        //$html = view('email/mail',array(),array('debug' => false));
         
        mail("punitha@izaaptech.in",$subject,'Testing',$header);

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