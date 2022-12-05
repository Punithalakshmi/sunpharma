<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;


class Login extends BaseController
{
    //public $title = 'Login';
    
    public function index()
    {
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
           // echo "<br/>";
                        if($data){
                           $pass = $data['password'];
                          
                            $authenticatePassword = password_verify(trim($password), $pass); 

                            if($authenticatePassword){
                             //   echo "ffdfffd";
                                $ses_data = [
                                    'id' => $data['id'],
                                    'name' => $data['name'],
                                    'email' => $data['email'],
                                    'isLoggedIn' => TRUE,
                                    'role' => $data['role'],
                                    'isNominee' => 'yes'
                                ];

                                setSessionData('userdata',$ses_data);
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
        return redirect()->to('admin/login');
    }
}
