<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class User extends BaseController
{

    public function index()
    {
        
        $userdata  = $this->session->get('userdata');

        $data['userdata'] = $userdata;
       
        if(is_array($userdata) && count($userdata)):

            $userLists = $this->userModel->getListsOfUsers();
            
            foreach($userLists as $ukey => $uvalue){
               if(!empty($uvalue['category'])){ 
                $category = $this->categoryModel->getListsOfCategories($uvalue['category']);

                $category = $category->getRowArray();
                $userLists[$ukey]['category'] = (isset($category['name']) && !empty($category['name']))?$category['name']:'';
               }
               else
               {
                $userLists[$ukey]['category'] = '-';
               }
            }
           
            $data['lists'] = $userLists;
            return view('_partials/header',$data)
                .view('admin/user/list',$data)
                .view('_partials/footer');
        else:
            return redirect()->route('admin/login');
        endif;        
    }

    public function add($id='')
    {
      
        $userdata  = $this->session->get('userdata');

        $getCategoryLists   = $this->categoryModel->getListsOfCategories();
        $data['categories'] = $getCategoryLists;

        if(is_array($userdata) && count($userdata)):
           
            if(!empty($id)){
                $getUserData = $this->userModel->getListsOfUsers($id);
                $edit_data   = $getUserData->getRowArray();
            }
            
            if($this->request->getPost())
               $id  = $this->request->getPost('id');
               
            $this->validation = $this->validate($this->validation_rules('user',$id));
           
            $data['userdata'] = $userdata;
            $data['roles']    = $this->roleModel->getListsOfRoles();
            
          
            if($this->validation) {

                if($this->request->getPost()){
                     
                    $category = '';

                    $firstname     = $this->request->getPost('firstname');
                    $lastname      = $this->request->getPost('lastname');
                    $middlename    = $this->request->getPost('middlename');
                    $email         = $this->request->getPost('email');
                    $phonenumber   = $this->request->getPost('phonenumber');
                    $gender        = $this->request->getPost('gender');
                    $date_of_birth = $this->request->getPost('date_of_birth');
                    $user_role     = $this->request->getPost('user_role');

                    if($this->request->getPost('category'))
                       $category      = $this->request->getPost('category');

                    $ins_data = array();
                    $ins_data['firstname']  = $firstname;
                    $ins_data['lastname']   = $lastname;
                    $ins_data['middlename'] = $middlename;
                    $ins_data['email']      = $email;
                    $ins_data['phone']      = $phonenumber;
                    $ins_data['role']       = $user_role;
                    $ins_data['address']    = '';
                    $ins_data['dob']        =  $date_of_birth;
                    $ins_data['active']     =  '1';

                    if($user_role == 1)
                      $ins_data['category'] =  $category;

                    
                    if(!empty($id)){
                        $this->session->setFlashdata('msg', 'User Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $userdata['login_id'];
                        $this->userModel->update(array("id" => $id),$ins_data);
                    }
                    else
                    {
                        $this->session->setFlashdata('msg', 'User Added Successfully!');
                        $ins_data['created_date']  =  date("Y-m-d H:i:s");
                        $ins_data['created_id']    =  $userdata['login_id'];
                        $this->userModel->save($ins_data);
                    } 

                    return redirect()->route('admin/user');
                }
            }
            else
            {  
            
                if(!empty($edit_data) && count($edit_data)){
                    $editdata['firstname']  = $edit_data['firstname'];
                    $editdata['lastname']   = $edit_data['lastname'];
                    $editdata['middlename'] = $edit_data['middlename'];
                    $editdata['email']      = $edit_data['email'];
                    $editdata['phone']      = $edit_data['phone'];
                    $editdata['role']       = $edit_data['role'];
                    $editdata['address']    = '';
                    $editdata['dob']        =  $edit_data['dob'];
                    $editdata['gender']     =  $edit_data['gender'];

                    if($edit_data['role'] == 1)
                      $editdata['category']  =  $edit_data['category'];
                    else
                      $editdata['category']  = '';

                    $editdata['id']         =  $edit_data['id'];
                }
                else
                {
                    $editdata['firstname']  = ($this->request->getPost('firstname'))?$this->request->getPost('firstname'):'';
                    $editdata['lastname']   = ($this->request->getPost('lastname'))?$this->request->getPost('lastname'):'';
                    $editdata['middlename'] = ($this->request->getPost('middlename'))?$this->request->getPost('middlename'):'';
                    $editdata['email']      = ($this->request->getPost('email'))?$this->request->getPost('email'):'';
                    $editdata['phone']      = ($this->request->getPost('phonenumber'))?$this->request->getPost('phonenumber'):'';
                    $editdata['role']       = ($this->request->getPost('user_role'))?$this->request->getPost('user_role'):'';
                    $editdata['address']    = ($this->request->getPost('address'))?$this->request->getPost('address'):'';
                    $editdata['dob']        = ($this->request->getPost('date_of_birth'))?$this->request->getPost('date_of_birth'):'';
                    $editdata['gender']     = ($this->request->getPost('gender'))?$this->request->getPost('gender'):'';
                    $editdata['category']   = ($this->request->getPost('category'))?$this->request->getPost('category'):'';
                    $editdata['id']         = ($this->request->getPost('id'))?$this->request->getPost('id'):'';
                }

                  if($this->request->getPost())
                    $data['validation'] = $this->validator;


                    $data['editdata'] = $editdata;
                    return view('_partials/header',$data)
                        .view('admin/user/add',$data)
                        .view('_partials/footer');
            }       
        else:
            return redirect()->route('admin/login');
        endif; 


    }

    public function profile()
    {

        $userdata  = $this->session->get('userdata');

        if(is_array($userdata) && count($userdata)):

            $id = $userdata['login_id'];
            $getUserData = $this->userModel->getListsOfUsers($id);
            $edit_data   = $getUserData->getRowArray();

            $data['userdata'] = $userdata;

            $this->validation = $this->validate($this->validation_rules('profile',$id));
            
            if($this->validation) {

                if($this->request->getPost()){
                
                    $firstname     = $this->request->getPost('firstname');
                    $lastname      = $this->request->getPost('lastname');
                    $middlename    = $this->request->getPost('middlename');
                    $email         = $this->request->getPost('email');
                    $phonenumber   = $this->request->getPost('phonenumber');
                    $gender        = $this->request->getPost('gender');
                    $date_of_birth = $this->request->getPost('date_of_birth');
                    $id            = $this->request->getPost('id');

                    $ins_data = array();
                    $ins_data['firstname']  = $firstname;
                    $ins_data['lastname']   = $lastname;
                    $ins_data['middlename'] = $middlename;
                    $ins_data['email']      = $email;
                    $ins_data['phone']      = $phonenumber;
                    $ins_data['address']    = '';
                    $ins_data['dob']        =  $date_of_birth;
                    $ins_data['gender']     = $gender;
                    
                    if(!empty($id)){
                        $this->session->setFlashdata('msg', 'User Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $userdata['login_id'];
                        $this->userModel->update(array("id" => $id),$ins_data);
                    }
                    
                    return redirect()->route('admin/profile');
                }
            }
            else
            {  
            
                $editdata['firstname']  = ($this->request->getPost('firstname'))?$this->request->getPost('firstname'):'';
                $editdata['lastname']   = ($this->request->getPost('lastname'))?$this->request->getPost('lastname'):'';
                $editdata['middlename'] = ($this->request->getPost('middlename'))?$this->request->getPost('middlename'):'';
                $editdata['email']      = ($this->request->getPost('email'))?$this->request->getPost('email'):'';
                $editdata['phone']      = ($this->request->getPost('phonenumber'))?$this->request->getPost('phonenumber'):'';
                $editdata['address']    = ($this->request->getPost('address'))?$this->request->getPost('address'):'';
                $editdata['dob']        = ($this->request->getPost('date_of_birth'))?$this->request->getPost('date_of_birth'):'';
                $editdata['gender']     = ($this->request->getPost('gender'))?$this->request->getPost('gender'):'';
                $editdata['id']         = ($this->request->getPost('id'))?$this->request->getPost('id'):$id;   
            } 

            if($this->request->getPost())
              $data['validation'] = $this->validator;

            $data['editdata'] = $edit_data;
            
            return  view('_partials/header',$data)
                   .view('admin/user/profile',$data)
                   .view('_partials/footer');
        else:
            return redirect()->route('admin/login');
        endif;

    }


    public function delete($id='')
    {
    

        $userdata  =  $this->session->get('userdata'); 
        $data['userdata'] = $userdata;

        if(is_array($userdata) && count($userdata)):
            $this->userModel->delete(array("id" => $id));
          return redirect()->route('admin/user');
        else:
            return redirect()->route('admin/login');
        endif;
    }

    public function changepassword($id='')
    {
      

        $userdata  = $this->session->get('userdata'); 
       
        if(is_array($userdata) && count($userdata)):

    
            $data['userdata'] = $userdata;

            $this->validation = $this->validate($this->validation_rules('change_password',$id));
            
            if($this->validation) {

                if($this->request->getPost()){
                
                    $newPassword     = $this->request->getPost('new_password');
                    $id              = $this->request->getPost('id');

                    $ins_data = array();
                    $ins_data['password']  = md5($newPassword);

                    $userData = $this->userModel->getListsOfUsers($id)->getRowArray();
                    
                    if(!empty($id)){
                        $this->session->setFlashdata('msg', 'Password Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $userdata['login_id'];
                        $this->userModel->update(array("id" => $id),$ins_data);
                    }
                    
                   if(isset($userData['email']) && !empty($userData['email'])) 
                      $this->sendMail($userData['email'],$newPassword);

                    return redirect()->route('admin/user');
                }
            }
            else
            {  
            
                $editdata['new_password']       = ($this->request->getPost('new_password'))?$this->request->getPost('new_password'):'';
                $editdata['confirm_password']   = ($this->request->getPost('confirm_password'))?$this->request->getPost('confirm_password'):'';
                $editdata['id']                 = ($this->request->getPost('id'))?$this->request->getPost('id'):$id;   
            } 

            if($this->request->getPost())
              $data['validation'] = $this->validator;

            $data['editdata'] = $editdata;

            return  view('_partials/header',$data)
            .view('admin/user/changepassword',$data)
            .view('_partials/footer');
        else:
            return redirect()->route('admin/login');
        endif;
    }

    public function validation_rules($type = 'profile',$id='')
    {

        $validation_rules = array();

        if($type =='profile' || $type == 'user'){
            $validation_rules = array(
                                            "firstname" => array("label" => "Firstname",'rules' => 'required'),
                                            "lastname" => array("label" => "Lastname",'rules' => 'required'),
                                            "email" => array("label" => "email",'rules' => 'required|valid_email|is_unique[users.email,id,'.$id.']'),
                                            "phonenumber" => array("label" => "Phonenumber",'rules' => 'required|numeric|max_length[10]'),
                                            "date_of_birth" => array("label" => "Date Of Birth",'rules' => 'required')
            );
        
            if($type == 'user')
                $validation_rules["user_role"] = array("label" => "Role",'rules' => 'required');  
        }
        else
        {
            $validation_rules = array(
                "new_password" => array("label" => "Password",'rules' => 'required'),
                "confirm_password" => array("label" => "Confirm Passwod",'rules' => 'required|matches[new_password]')
            );
        }  

        return $validation_rules;
      
    }

    public function sendMail($mail,$password)
    {
        $header  = '';
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        $subject = " SPSFN - Change Password ";
        $message  = "Hi, ";
        $message .= '<br/><br/>';
        $message .= "Your Account Password has been changed successfully.";
        $message .= "<br/>";
        $message .= "Please use this Password:".$password;
        $message .= "<br/>";
     
        $data['content'] = $message;
        $html = view('email/mail',$data,array('debug' => false));

        mail($mail,$subject,$html,$header);
    }

}
