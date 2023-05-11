<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;



class Login extends BaseController
{
    
    
    public function index()
    {
        sessionDestroy();
        return render('admin/login',$this->data);
    }

    public function loginAuth()
    {

            if (strtolower($this->request->getMethod()) == "post") {  
                
                 $this->validation->setRules($this->validation_rules());
                 
                    if(!$this->validation->withRequest($this->request)->run()) {
                        $this->data['validation'] = $this->validation;
                    }
                    else
                    {   
                        $username  = $this->request->getVar('username');
                        $password  = $this->request->getVar('password');
               
                        $data      = $this->userModel->where('username', $username)->first();

                        if($data)
                        {
                            $pass = $data['password'];
                          
                        //    $authenticatePassword = password_verify(trim($password), $pass); 

                            if(($pass == md5($password)) && ($data['active'] == 1)){
                             
                                $ses_data = [
                                    'id' => $data['id'],
                                    'name' => $data['firstname'],
                                    'login_name' => $data['firstname'],
                                    'email' => $data['email'],
                                    'isLoggedIn' => TRUE,
                                    'role' => $data['role'],
                                    'login_id' => $data['id']
                                ];

                                setSessionData('userdata',$ses_data);

                                if( $data['role'] == 1 )
                                  return redirect()->to('jury/nominations');
                                else
                                  return redirect()->to('admin/dashboard');
                            }
                            else
                            {
                                $this->session->setFlashdata('msg', "Password is incorrect!");
                                //$this->validation->setRule("password","Password", "required",array("errors" => "Incorrect Password"));
                                return render('admin/login',$this->data);
                            }
                        }
                        else
                        {
                            $this->session->setFlashdata('msg', "Username doesn't match!");
                            return render('admin/login',$this->data);
                        }
                    }

                }  
                
                return render('admin/login',$this->data);

    }

    public function validation_rules()
    {
      $validation_rules = array(
                                    "username" => array("label" => "Username",'rules' => 'required'),
                                    "password" => array("label" => "Password",'rules' => 'required')
      );
 
      return $validation_rules;
      
    }
    
    public function logout()
    {
        $this->session->remove('userdata');
        return redirect()->to($this->redirectUrl);
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
                                $message .= '<a href="'.base_url().'/'.$uri.'/update_password/'.$token.'">Click Here to Reset Password</a><br /> <br/>';
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
        
        return  render('admin/forget_password',$this->data);
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
                            return redirect()->to($this->redirectUrl);
                        }
                        else
                        {
                            $this->session->setFlashdata('error','Unable to reset the password Please try again!');
                            return redirect()->to($this->redirectUrl);
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
        return render('admin/reset_password',$this->data);
             
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

    public function forgotPasswordValidationMessages()
    {
        $validationMessages = array("email" => array("required" => "Please enter email","valid_email" => "Email should be valid!"),
                                    
                              );

         return $validationMessages;
    }


    public function resetPasswordValidationMessages()
    {
        $validationMessages = array("password" => array("required" => "Please enter new password"),
                                     "confirm_password" => array("confirm_password" => "Please enter confirm new password","matches" => "Please enter correct password") );

         return $validationMessages;
    }
   

}
