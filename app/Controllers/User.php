<?php

namespace App\Controllers;

class User extends BaseController
{
    
    public function login()
    {

        // try
        // {
            if (strtolower($this->request->getMethod()) == "post") {  

              //  echo "dsdsdsds"; die;
                
                $this->validation->setRules($this->validation_rules());
            
                if(!$this->validation->withRequest($this->request)->run()) {
                    $this->data['validation'] = $this->validation;
                }
                else
                {  

                    $username   = $this->request->getVar('username');
                    $password   = $this->request->getVar('password');
            
                    $data       = $this->userModel->where('username', $username)->first();
                   // print_r($data);
                    if($data){

                        $pass = trim($data['password']);
                     
                      //  $authenticatePassword = password_verify($password, $pass);
                       //    echo $authenticatePassword; die;
                       if($pass == md5($password)){
                         // echo "testing"; 
                         $redirect_route = 'view/'.$data['id'];
        
                       
                            $ses_data = array(
                                'id' => $data['id'],
                                'name' => $data['firstname'],
                                'email' => $data['email'],
                                'isLoggedIn' => TRUE,
                                'role' => $data['role'],
                                'isNominee' => 'yes'
                            );

                        //    print_r($ses_data);

                         //   $nominationEndDays =  $this->dateDiff(date("Y-m-d"),$data['extend_date']);
        //    die;
                           // $ses_data['nominationEndDays'] =  $nominationEndDays;  
            
           //                 $ses_data['nominationEndDate'] = $getNominationDaysCt['end_date'];
                          
                            setSessionData('fuserdata',$ses_data);

                            return redirect()->to('view/'.$data['id']);
                        
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
            }
            else
            {
                $editdata['username'] = ($this->request->getVar('username'))?$this->request->getVar('username'):"";
                $editdata['password'] = ($this->request->getVar('password'))?$this->request->getVar('password'):"";
                $this->data['editdata'] = $editdata;

              
            }

            return  render('frontend/login',$this->data);
        // }
        // catch(\Exception $e){
        //     $this->session->setFlashdata($e->getMessage());
        // }
       

       
    }

    public function forget_password()
    {
        $uri = current_url(true);
        $data['uri'] = $uri->getSegment(1); 

        if(strtolower($this->request->getMethod()) == 'post'){
          
            $this->validation->setRules($this->validation_rules());
                  
            if(!$this->validation->withRequest($this->request)->run()) {
                $data['validation'] = $this->validation;
            }
            else
            {
                $email  = $this->request->getVar('email');  
                
                $userData = $this->userModel->where("email",$email);
            }
            
        }    

        $editdata['email'] = ($this->request->getVar('email'))?$this->request->getVar('email'):"";

        $data['editdata'] = $editdata;
        return  render('frontend/forget_password',$data);
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

    public function forgot_password_validation_rules()
    {

            $validation_rules = array();
            $validation_rules = array(
                                      "email" => array("label" => "Email",'rules' => 'required|valid_email')
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

   

}    