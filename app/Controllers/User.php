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
            
                    $data       = $this->userModel->where('username', $username)->first();
                 

                    if($data){

                        $pass = trim($data['password']);
                    
                       if(($pass == md5($password)) && ($data['active'] == 1)){
                        
                         $redirect_route = 'view/'.$data['id'];
        
                            $ses_data = array(
                                'id' => $data['id'],
                                'name' => $data['firstname'],
                                'email' => $data['email'],
                                'isLoggedIn' => TRUE,
                                'role' => $data['role'],
                                'isNominee' => 'yes'
                            );

                            $ses_data['nominationEndDays'] =  getNominationDays($data['extend_date']);  
                          
                            setSessionData('fuserdata',$ses_data);

                            $redirect = 'view/'.$data['id'].'/'.$data['award_id'];
                            
                            return redirect()->to($redirect);
                        
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
                            $updatedTime = $this->userModel->update($userData['id'],array("updated_time" => date("Y-m-d H:i:s")));

                            if($updatedTime){
                                $to = $email;
                                $subject  = "Reset Password Link - Sunpharma Science Foundation";
                                $token    = $userData['id'];
                                $message  = "Hi  ".ucfirst($userData['firstname']).",<br/></br>";
                                $message .= 'Your reset password request has been received. Please click the below link to reset your password. <br/><br/>';
                                $message .= '<a href="'.base_url().'/reset_password/'.$token.'">Click Here to Reset Password</a><br /> <br/>';
                                $message .= 'Thanks,<br/>';

                               $isMailSent =  sendMail($email,$subject,$message);

                               if($isMailSent){
                                 $this->session->setFlashdata('msg', 'Reset Password link sent to your registered email.');
                               }
                               else
                               {
                                $this->session->setFlashdata('msg', 'Unable to send mail');
                               }
                            }  
                            else
                            {
                                $this->session->setFlashdata('msg', 'User not found for this mail id!');
                            }
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

            if(is_array($userData)){
                //check if expired the link
                $checkExpiredTime = $userData['updated_time'];

                if(checkExpireTime($checkExpiredTime)){
            
                 if(strtolower($this->request->getMethod()) == 'post'){

                    $this->validation->setRules($this->reset_password_validation_rules(),$this->resetPasswordValidationMessages());
                    
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
                $this->session->setFlashdata('msg','Reset password link was expired!');   
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
        echo "testing"; die;
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

    public function attendMode($mode='',$id)
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
   

}    