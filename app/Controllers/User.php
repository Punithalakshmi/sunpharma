<?php

namespace App\Controllers;

class User extends BaseController
{
    
    public function login()
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

                    $recaptchaResponse = trim($this->request->getVar('g-recaptcha-response'));
            
                    $userIp=$this->request->getIPAddress();
                  
                    //captcha verification
                    $captchaVerify = captchaVerification($recaptchaResponse,$userIp='');
               
                    if(isset($captchaVerify['success']) && $captchaVerify['success']){ 
            
                    $data  = $this->userModel->where(array('username'=>$username,"role"=>2,"password" => md5(trim($password))))->first();
                    // print_r($data); die;
                       
                    if($data){

                        $pass = trim($data['password']);
                        // echo $pass;
			//echo "<br />";
			//echo md5(trim($password)); die;

                        if($pass == md5(trim($password))){

                       if($data['active'] == 1){
                        
                         $redirect_route = 'view/'.$data['id'];

                         //get nomination data
                         $getNomineeData = $this->nominationModel->getNominationData($data['id'])->getRowArray();
                        
                       //  print_r($getNomineeData); die;
                            $ses_data = array(
                                'id' => $data['id'],
                                'name' => $data['firstname'],
                                'email' => $data['email'],
                                'isLoggedIn' => TRUE,
                                'role' => $data['role'],
                                'isNominee' => 'yes'
                            );
			
			     if($data['extend_date'] == date('Y-m-d'))
				 $ses_data['nominationEndDays'] = 1;
			     else
				 $ses_data['nominationEndDays'] =  getNominationDays($data['extend_date']); 	
	//echo date("H:i:s");
				//
                            

                            setSessionData('fuserdata',$ses_data);

                            if(isset($getNomineeData['nomination_type']) && ($getNomineeData['nomination_type'] != 'fellowship'))
                                 $redirect = 'view/'.$data['id'].'/'.$data['award_id'];
                            else
                                 $redirect = 'fellowship/view/'.$data['id'].'/'.$data['award_id'];       
                            
                            return redirect()->to($redirect);
                        
                        }
                        else
                        {
                            $this->session->setFlashdata('msg', " Your application is already submitted, please send your queries to sunpharma.sciencefoundation@sunpharma.com ");
                            return render('frontend/login',$this->data);
                        }

                      } 
                      else
                      {
                            $this->session->setFlashdata('msg', "Password is incorrect!");
                            return render('frontend/login',$this->data);
                      }
                    }
                    else
                    {
                        $this->session->setFlashdata('msg', "Username is incorrect!");
                        return render('frontend/login',$this->data);
                    }
                }
                else
                {
                    $this->session->setFlashdata('msg', 'Please verify Captcha!');
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

    public function forget_password()
    {
        $this->session->setFlashdata('msg','');
        $editdata['email'] = ($this->request->getVar('email'))?$this->request->getVar('email'):"";
      
        if(strtolower($this->request->getMethod()) == 'post'){
          
            $this->validation->setRules($this->forgot_password_validation_rules(),$this->forgotPasswordValidationMessages());
                  
            if(!$this->validation->withRequest($this->request)->run()) {
                $this->data['validation'] = $this->validation;
            }
            else
            {
                $email  = $this->request->getPost('email');  

                $recaptchaResponse = trim($this->request->getVar('g-recaptcha-response'));
            
                $userIp=$this->request->getIPAddress();
               
                //captcha verification
                $captchaVerify = captchaVerification($recaptchaResponse,$userIp='');
           
                if(isset($captchaVerify['success']) && $captchaVerify['success']){ 
                
                    $userData = $this->userModel->checkEmail(array("email" => $email));

                    if(is_array($userData)){
                            //check update the time while sending email
                           // $updatedTime = $this->userModel->update($userData['id'],array("updated_time" => date("Y-m-d H:i:s")));

                           // if($updatedTime){
                                $to = $email;
                                $subject  = "Reset Password Link - Sunpharma Science Foundation";
                                $token    = $userData['id'];
                                $message  = "Hi  ".ucfirst($userData['firstname']).",<br/></br>";
                                $message .= 'Please use the following link to reset your password: <br/><br/>';
                                $message .= '<a href="'.base_url().'/reset_password/'.$token.'">Click Here to Reset Password</a><br /> <br/>';
                                $message .= 'If you did not request a password change, please feel free to ignore this message.<br /><br /><br />';
                                $message .= "If you have any comments or questions don't hesitate to reach us at <br />";
                                $message .= "sunpharma.sciencefoundation@sunpharma.com";
                                $message .= 'Thanks,<br/>';

                               $isMailSent =  sendMail($email,$subject,$message);

                               if($isMailSent){
                                 $this->session->setFlashdata('msg', 'Link to reset your password has been sent!');
                               }
                               else
                               {
                                $this->session->setFlashdata('msg', 'Unable to send mail');
                               }
                            // }  
                            // else
                            // {
                            //     $this->session->setFlashdata('msg', 'User not found for this mail id!');
                            // }
                    }
                    else
                    {
                        $this->session->setFlashdata('msg',' Email not found!');
                    }
                }
                else
                {
                    $this->session->setFlashdata('msg', 'Please verify Captcha!');
                }    
            }
            
        }    

       
        $this->data['editdata'] = $editdata;
        
        return  render('frontend/forget_password',$this->data);
    }

    public function reset_password($id='')
    {

        $userData = array();
        $this->session->setFlashdata('msg','');
        $editdata['password'] = ($this->request->getPost('password'))?$this->request->getPost('password'):"";
        $editdata['confirm_password'] = ($this->request->getPost('confirm_password'))?$this->request->getPost('confirm_password'):"";
       
      //  $token = urldecode(base64_decode($token));
        $editdata['token']  = $id;

            $id = ($this->request->getPost('id'))?$this->request->getPost('id'):$id;
            $userData = $this->userModel->getListsOfUsers($id)->getRowArray();

            if(is_array($userData)  && count($userData) > 0){
           
                $this->validation->setRules($this->reset_password_validation_rules(),$this->resetPasswordValidationMessages());
                  
                if(strtolower($this->request->getMethod()) == 'post'){

                    if(!$this->validation->withRequest($this->request)->run()) {
                        $this->data['validation'] = $this->validation;
                    }
                    else
                    {
                        $password = $this->request->getPost('password');
                        $update_data = array();
                        $update_data['password'] = md5($password);
                        $upd = $this->userModel->update(array("id" => $userData['id']),$update_data);

                        if($upd){
                            $this->session->setFlashdata('success','Password updated Sccessfully');
                            return redirect()->to('login');
                        }
                        else
                        {
                            $this->session->setFlashdata('error','Unable to reset the password Please try again!');
                            return redirect()->to('login');
                        }

                    }    
                }
            }
            else
            {
                $this->session->setFlashdata('msg','Unable to find the user account');
            } 
        
        $this->data['editdata'] = $editdata;
        return render('frontend/reset_password',$this->data);
             
    }


    public function logout()
    {
        $this->session->remove('fuserdata');
        return redirect()->route('/');
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

    public function forgot_password_validation_rules()
    {

        $validation_rules = array();
        $validation_rules = array(
                                    "email" => array("label" => "Email",'rules' => 'required|valid_email')
        ); 
        return $validation_rules;
      
    }

    public function reset_password_validation_rules()
    {

        $validation_rules = array();
        $validation_rules = array(
                                    "password" => array("label" => "Password",'rules' => 'required'),
                                    "confirm_password" => array("label" => "Confirm Password",'rules' => 'required|matches[password]')
        ); 
        return $validation_rules;
      
    }

    public function validation_rules()
    {

            $validation_rules = array();
            $validation_rules = array(
                                      "username" => array("label" => "Username",'rules' => 'required'),
                                      "password" => array("label" => "Password",'rules' => 'trim|required')
            ); 
            return $validation_rules;
      
    }

    public function user_check()
    {
     //  ini_set('post_max_size', '1000M');  
        echo phpinfo(); die;
	/*$this->userModel->orderBy('id', 'DESC');
        $awardData   = $this->userModel->getWhere(array("award_id" => 12),1,0)->getRowArray();
	if($awardData){ 
		$nomineeData =  $this->nominationModel->getWhere(array("nominee_id" => $awardData['id']))->getRowArray();
		//get registration_no
		$registrationNo = $nomineeData['registration_no'];			
	        if(!empty($registrationNo)){
			//generate new no
                     $explode = explode("-",$nomineeData['registration_no']);
		     $registrationNO = trim($explode[1]) + 1;
		}
	}
	else
	{
		$registrationNO = 1;
	}
              echo $registrationNO; die;*/

    }

    public function bulkEmails()
    {
        $message = '';
        $registeredUsersLists = array();

        if(is_array($registeredUsersLists) && count($registeredUsersLists) > 0):
            foreach($registeredUsersLists as $rkey=>$rvalue):
                $message .= 'Your are attending the session, Whether <a class="btn btn-primary" href="'.base_url().'/event/attendMode/1/'.$rvalue['id'].'">On-site</a> OR <a class="btn btn-primary" href="'.base_url().'/event/attendMode/2/'.$rvalue['id'].'">Online</a>';
                sendMail("punitha@izaaptech.in","Event Confirmation",$message);
            endforeach;
        endif;
    }

    public function attendMode($mode='',$id='')
    {

        if(!empty($mode)){
            $ins_data['mode'] = ($mode == 1)?"Onsite":"Online";
            $ins_data['is_mail_sent'] = 1;
            $this->registerationModel->update(array("id" => $id),$ins_data);
            redirect()->to('/bulkEmailSuccess');
           
        }

    }

    public function bulkEmailSuccess()
    {
        return view('/frontend/bulkEmailSuccess');
    }

    public function forgotPasswordValidationMessages()
    {

        $validationMessages = array("email" => array("required" => "Please enter email","valid_email" => "Email should be valid!"),
                                    
                              );

         return $validationMessages;
    }


    public function resetPasswordValidationMessages()
    {

        $validationMessages = array("password" => array("required" => "Please enter new password"),
                                     "confirm_password" => array("confirm_password" => "Please enter confirm new password","matches" => "Please enter correct password")
                                    
                              );

         return $validationMessages;
    }
   
    public function testForm(){

	
	  
        if($this->request->getPost()){
           $id  = $this->request->getPost('id');
		 print_r($_POST); die;
            }
       
            if (strtolower($this->request->getMethod()) == "post") {  
               
               // $this->validation->setRules($this->validation_rules('user',$id),$this->validationMessages());
               
                if($this->validation->withRequest($this->request)->run()) {   
                 

                $firstname     = $this->request->getPost('firstname');
               
                $ins_data = array();
                $ins_data['firstname']  = $firstname;
             }
           

        }
         
        
            if(!empty($edit_data) && count($edit_data)){
                $editdata['firstname']  = $edit_data['firstname'];
                              $editdata['id']         =  $edit_data['id'];
            }
            else
            {
                $editdata['firstname']  = ($this->request->getPost('firstname'))?$this->request->getPost('firstname'):'';
                $editdata['id']         = ($this->request->getPost('id'))?$this->request->getPost('id'):'';
            }
            if(is_array($this->validation->getErrors()) && count($this->validation->getErrors()) > 0){
                $this->data['validation'] = $this->validation;
               
            }  
            
                
           
         
         $this->data['editdata'] = $editdata;

        return render('frontend/testform',$this->data);
       
    }


	 public function approve($id='')
    {


            $id        = $id;
          //  $type      = $this->request->getPost('type');
          //  $remarks   = $this->request->getPost('remarks');

          
            $getUserData  = $this->userModel->getListsOfUsers($id);
            $getUserData  = $getUserData->getRowArray();

            $getUserNominationNo = $this->nominationModel->getNominationData($id)->getRowArray();

            $subject = 'Nomination Application Status - Sunpharma Science Foundation';
            $login_url = base_url().'/login';
            $message = 'Hi,';
           

                $message .= '<br/><br/>';
                $message .= 'Nomination No:'.$getUserNominationNo['registration_no'].'. Your Application has been approved. Please sign-in with the following credentials to complete the application submission. <br /> <br />';
                $message .= 'Please <a href="'.$login_url.'" target="_blank">Click Here</a> to Sign-In <br />';
                $message .= '<b>Username: </b>'.strtolower($getUserData['username']).'<br />';
                $message .= '<b>Password: </b>'.$getUserData['original_password'].'<br /><br />';

		//$message .= '<b>Remarks:</b> '.$remarks.'<br/><br/>';
	    
           
           
            
            $message .= 'Thanks & Regards,<br/>';
            $message .= 'Sunpharma Science Foundation Team';

           
	    sendMail($getUserData['email'],$subject,$message);
			sendMail("Thangachan.Anthappan@sunpharma.com",$subject,$message);
	    // sendMail('punitha@izaaptech.in',$subject,$message);

           
                    
            
        
    }

	
}    