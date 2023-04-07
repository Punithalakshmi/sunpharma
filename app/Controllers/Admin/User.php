<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class User extends BaseController
{

    public function index()
    {
        
        $filter = array();
        $filter['role']       = '';
        $filter['category']   = '';
        $filter['firstname']  = '';
        $filter['email']      = '';
        $filter['start']      = '0';
        $filter['limit']      = '10';
        $filter['orderField'] = 'id';
        $filter['orderBy']    = 'desc';
        $totalRecords  = $this->userModel->countAllResults();
        
        if (strtolower($this->request->getMethod()) == "post") { 

            if(!$this->validation->withRequest($this->request)->run()) {

                $dtpostData = $this->request->getPost('data');

                $response = array();
    
                $draw            = $dtpostData['draw'];
                $start           = $dtpostData['start'];
                $rowperpage      = $dtpostData['length']; // Rows display per page
                $columnIndex     = $dtpostData['order'][0]['column']; // Column index
                $columnName      = $dtpostData['columns'][$columnIndex]['data']; // Column name
                $columnSortOrder = $dtpostData['order'][0]['dir']; // asc or desc
                $searchValue     = $dtpostData['search']['value']; // Search value

                 // Custom filter
                $role     = $dtpostData['role_name'];
                $category = $dtpostData['category'];
                $firstname = $dtpostData['firstname'];
                $email = $dtpostData['email'];
                
                $filter['role']       = $role;
                $filter['category']   = $category;
                $filter['firstname']  = $firstname;
                $filter['email']      = $email;
                $filter['start']      = $start;
                $filter['limit']      = $rowperpage;
                $filter['orderField'] = $columnName;
                $filter['orderBy']    = $columnSortOrder;

                $userLists = $this->userModel->getUsersByFilter($filter)->getResultArray();
               
                $filter['totalRows'] = 'yes';
               
                $totalRecordsWithFilterCt = $this->userModel->getUsersByFilter($filter);
               
                $totalRecordsWithFilter = (!empty($role) || !empty($category) || !empty($firstname) || !empty($email))?$totalRecordsWithFilterCt:$totalRecords;
          }

        }
        else
        {    

            $userLists = $this->userModel->getUsersByFilter($filter)->getResultArray();
            
            $totalRecordsWithFilter = count($userLists);
        }

       
        $data = array();
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
                $data[] = array('firstname' => $uvalue['firstname'],
                                'lastname' => $uvalue['lastname'],
                                'username' => $uvalue['username'],
                                'email' => $uvalue['email'],
                                'phone' => $uvalue['phone'],
                               // 'category' => (isset($category['name']) && !empty($category['name']))?$category['name']:'-',
                                'role_name' => $uvalue['role_name'],
                                'created_date' => $uvalue['created_date'],
                                'id' => $uvalue['id'],
                                'action' => ''
                             );
         }
           
        $this->data['roles']   = $this->roleModel->getListsOfRoles();
        $this->data['categories']   = $this->categoryModel->getListsOfCategories()->getResultArray();    
        $this->data['lists'] = $userLists;

        if($this->request->isAJAX()) {
            $html = view('admin/user/list',$this->data,array('debug' => false));
            $end  = $filter['start'] + $filter['limit'];
                return $this->response->setJSON(array(
                                        'status' => 'success',
                                        'data'  => $data,
                                        'token' => csrf_hash(),
                                        "draw" => intval($draw),
                                        "iTotalRecords" => $totalRecords,
                                        "start" => $filter['start'],
                                        "end" => $end,
                                        "length" => $filter['limit'],
                                        "page" => $draw,
                                        "iTotalDisplayRecords" => $totalRecordsWithFilter
                                    )); 
                exit;
          }
          else
          {
            return render('admin/user/list',$this->data);
          } 
           
    }

    public function add($id='')
    {
      
        $getCategoryLists   = $this->categoryModel->getListsOfCategories();
        $this->data['categories'] = $getCategoryLists->getResultArray();

     
        if(!empty($id)){
            $getUserData = $this->userModel->getListsOfUsers($id);
            $edit_data   = $getUserData->getRowArray();
        }
        
        if($this->request->getPost())
           $id  = $this->request->getPost('id');
            
        $this->validation = $this->validate($this->validation_rules('user',$id));
        
        $this->data['roles']    = $this->roleModel->getListsOfRoles();
        
        
        if($this->validation) {

            if (strtolower($this->request->getMethod()) == "post") {  
                    
                $category = '';

                $firstname     = $this->request->getPost('firstname');
                $lastname      = $this->request->getPost('lastname');
                $username      = $this->request->getPost('username');
                $middlename    = $this->request->getPost('middlename');
                $email         = $this->request->getPost('email');
                $phonenumber   = $this->request->getPost('phonenumber');
                $gender        = $this->request->getPost('gender');
                $date_of_birth = $this->request->getPost('date_of_birth');
                $user_role     = $this->request->getPost('user_role');
                $password      = $this->request->getPost('password');
                $status        = $this->request->getPost('status');

                if($this->request->getPost('category'))
                  $category = $this->request->getPost('category');

                $ins_data = array();
                $ins_data['firstname']  = $firstname;
                $ins_data['lastname']   = $lastname;
                $ins_data['middlename'] = $middlename;
                $ins_data['username']   = $username;
                $ins_data['email']      = $email;
                $ins_data['phone']      = $phonenumber;
                $ins_data['role']       = $user_role;
                $ins_data['address']    = '';
                $ins_data['dob']        =  $date_of_birth;
                $ins_data['active']     =  $status;
                $ins_data['gender']     =  $gender;
               

                if($user_role == 1)
                    $ins_data['category'] =  $category;

                if(!empty($id)){
                    $this->session->setFlashdata('msg', 'User Updated Successfully!');
                    $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                    $ins_data['updated_id']    =  $this->data['userdata']['login_id'];
                    $this->userModel->update(array("id" => $id),$ins_data);
                }
                else
                {
                    $this->session->setFlashdata('msg', 'User Added Successfully!');
                    $ins_data['created_date']  =  date("Y-m-d H:i:s");
                    $ins_data['created_id']    =  $this->data['userdata']['login_id'];
                    $ins_data['password']   =  md5($password);
                    $this->userModel->save($ins_data);
                } 

                //Send mail to jury
                $this->sendMailToJury($email,$firstname,$username,$password);

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
                $editdata['dob']        =  (isset($edit_data['dob']) && !empty($edit_data['dob']))?date("m/d/Y",strtotime($edit_data['dob'])):date("m/d/Y");
                $editdata['gender']     =  $edit_data['gender'];
                $editdata['username']     =  $edit_data['username'];
                $editdata['password']     =  '';
                $editdata['confirm_password']     =  '';
                $editdata['status']     =  $edit_data['active'];
                

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
                $editdata['username']   = ($this->request->getPost('username'))?$this->request->getPost('username'):'';
                $editdata['password']   = ($this->request->getPost('password'))?$this->request->getPost('password'):'';
                $editdata['confirm_password']   = ($this->request->getPost('confirm_password'))?$this->request->getPost('confirm_password'):'';
                $editdata['status']   = ($this->request->getPost('status'))?$this->request->getPost('status'):'';
                $editdata['id']         = ($this->request->getPost('id'))?$this->request->getPost('id'):'';
            }

                if($this->request->getPost())
                $this->data['validation'] = $this->validator;


                $this->data['editdata'] = $editdata;

                return render('admin/user/add',$this->data);
         }       
       
    }

    public function profile()
    {

            $id = $this->data['userdata']['login_id'];
            $getUserData = $this->userModel->getListsOfUsers($id);
            $edit_data   = $getUserData->getRowArray();

            $this->validation = $this->validate($this->validation_rules('profile',$id));
            
            if($this->validation) {

                if (strtolower($this->request->getMethod()) == "post") {  
                
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
                        $ins_data['updated_id']    =  $this->data['userdata']['login_id'];
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
              $this->data['validation'] = $this->validator;

            $this->data['editdata'] = $edit_data;
            
            return render('admin/user/profile',$this->data);
         
       
    }


    public function delete($id='')
    {
        
        if (strtolower($this->request->getMethod()) == "post") {  

           if($this->request->isAJAX()){

                    $userData = $this->userModel->getAwardData($id)->getRowArray();

                    if(is_array($userData) && count($userData) > 0) {

                        if(!isNominationExpired($userData['extend_date'])){
                            $status  = 'error';
                            $message = ucfirst($userData['firstname']).' registered this award '.$userData['title'].'. The award is not yet complete. you can delete this user after finish the nomination.';
                         }
                         else
                         {
                            $this->userModel->delete(array("id" => $id));
                            $status  = "success";
                            $message = 'User deleted Successfully'; 
                         } 
                        
                        return $this->response->setJSON([
                            'status'    => $status,
                            'message'   => $message
                        ]); 
                 }
             }
         }

    }

    public function changepassword($id='')
    {
       
        $this->validation = $this->validate($this->validation_rules('change_password',$id));
        
        if($this->validation) {

            if (strtolower($this->request->getMethod()) == "post") {  
            
                $newPassword     = $this->request->getPost('new_password');
                $id              = $this->request->getPost('id');

                $ins_data = array();
                $ins_data['password']  = md5($newPassword);

                $userData = $this->userModel->getListsOfUsers($id)->getRowArray();
                
                if(!empty($id)){
                    $this->session->setFlashdata('msg', 'Password Updated Successfully!');
                    $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                    $ins_data['updated_id']    = $this->data['userdata']['login_id'];
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
            $this->data['validation'] = $this->validator;

        $this->data['editdata'] = $editdata;

        return  render('admin/user/changepassword',$this->data);
            
    }

    public function validation_rules($type = 'profile',$id='')
    {

        $validation_rules = array();

         if($type =='profile' || $type == 'user'){
           
            $validation_rules = array(
                                            "firstname" => array("label" => "Firstname",'rules' => 'required'),
                                            "lastname" => array("label" => "Lastname",'rules' => 'required'),
                                            "email" => array("label" => "Email",'rules' => 'required|valid_email|is_unique[users.email,id,'.$id.']'),
                                            "phonenumber" => array("label" => "Phonenumber",'rules' => 'required|numeric|max_length[10]'),
                                            
            );
        
            if($type == 'user'){
                $validation_rules["user_role"] = array("label" => "Role",'rules' => 'required');
                $validation_rules["username"] = array("label" => "Username",'rules' => 'required');
               
                $validation_rules['status']  = array("label" => "Status",'rules' => 'required');
                if($id==''){
                    $validation_rules['password']  = array("label" => "Password",'rules' => 'required');
                    $validation_rules['confirm_password']  = array("label" => "Confirm Password",'rules' => 'required|matches[password]');
                }
            }      
        }
        else
        {
            $validation_rules = array(
                "new_password" => array("label" => "Password",'rules' => 'required'),
                "confirm_password" => array("label" => "Confirm New Passwod",'rules' => 'required|matches[new_password]')
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
        $message .= "Please use this Password: ".$password;
        $message .= "<br/>";
     
        $this->data['content'] = $message;
        $html = view('email/mail',$this->data,array('debug' => false));

        sendMail($mail,$subject,$message);
    }

    public function resetpassword($id = '')
    {

                if (strtolower($this->request->getMethod()) == "post") {  
                    
                    $this->validation->setRules($this->validation_rules('change_password',$id));

                    if(!$this->validation->withRequest($this->request)->run()) {
                        $this->data['validation'] = $this->validator;
                    }
                    else
                    {     

                        $newPassword     = $this->request->getPost('new_password');
                        $id              = $this->request->getPost('id');

                        $ins_data = array();
                        $ins_data['password']  = md5($newPassword);

                        $userData = $this->userModel->getListsOfUsers($id)->getRowArray();
                        
                        if(!empty($id)){
                            $this->session->setFlashdata('msg', 'Password Updated Successfully!');
                            $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                            $ins_data['updated_id']    = $this->data['userdata']['login_id'];
                            $this->userModel->update(array("id" => $id),$ins_data);
                        }
                        
                  //  if(isset($userData['email']) && !empty($userData['email'])) 
                      //  $this->sendMail($userData['email'],$newPassword);

                        return redirect()->route('admin/user');
                   }
            }
            else
            {  
                $editdata['new_password']       = ($this->request->getPost('new_password'))?$this->request->getPost('new_password'):'';
                $editdata['confirm_password']   = ($this->request->getPost('confirm_password'))?$this->request->getPost('confirm_password'):'';
                $editdata['id']                 = ($this->request->getPost('id'))?$this->request->getPost('id'):$id;   
            } 

     
            $this->data['editdata'] = $editdata;

            return  render('admin/user/resetpassword',$this->data);

    }

  
    public function sendMailToJury($mail,$name,$username,$password){

    
        $login_url = base_url().'/admin';
        $subject   = "Authentication Info - SunPharma Science Foundation ";
        
        $message  = "Hi ".ucfirst($name).",";
        $message .= '<br/><br/>';
      //  $message .= 'Please <a href="'.$login_url.'">Click Here</a> to login and check the nominations.';
        $message .= 'Please <a href="'.$login_url.'" target="_blank">Click Here</a> to Sign-In <br />';
        $message .= '<b>Username: </b>'.strtolower($username).'<br />';
        $message .= '<b>Password: </b>'.$password.'<br /><br />';
        $message .= "<br/><br/><br/>";
        $message .= "Thanks & Regards,";
        $message .= "<br/>";
        $message .= "Sunpharma Science Foundation Team";
        
        
        sendMail($mail,$subject,$message);
                
    }
}
