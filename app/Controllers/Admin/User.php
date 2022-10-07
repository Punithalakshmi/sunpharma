<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\CategoryModel;

class User extends BaseController
{

    public function index()
    {
        $session = \Config\Services::session();

        $userdata  = $session->get('userdata');
        $userModel = new UserModel();
        $categoryModel = new CategoryModel();
        
        $data['userdata'] = $userdata;
       
        if(is_array($userdata) && count($userdata)):

            $userLists = $userModel->getListsOfUsers();
            
            foreach($userLists as $ukey => $uvalue){
               if(!empty($uvalue['category'])){ 
                $category = $categoryModel->getListsOfCategories($uvalue['category']);

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
        helper(array('form', 'url'));

        $session = \Config\Services::session();
        $userdata  = $session->get('userdata');
    
        $request    = \Config\Services::request();
        $validation = \Config\Services::validation();

        $userModel = new UserModel();
        $categoryModel = new CategoryModel();

        $getCategoryLists = $categoryModel->getListsOfCategories();
        $data['categories'] = $getCategoryLists;

        if(is_array($userdata) && count($userdata)):
           
            if(!empty($id)){
                $getUserData = $userModel->getListsOfUsers($id);
                $edit_data   = $getUserData->getRowArray();
            }
            
            if($request->getPost())
               $id  = $request->getPost('id');
               
            $validation = $this->validate($this->validation_rules('user',$id));
            
            $roleModel = new RoleModel();
            $data['userdata'] = $userdata;
            $data['roles']    = $roleModel->getListsOfRoles();
            
          
            if($validation) {

                if($request->getPost()){
                     
                    $category = '';

                    $firstname     = $request->getPost('firstname');
                    $lastname      = $request->getPost('lastname');
                    $middlename    = $request->getPost('middlename');
                    $email         = $request->getPost('email');
                    $phonenumber   = $request->getPost('phonenumber');
                    $gender        = $request->getPost('gender');
                    $date_of_birth = $request->getPost('date_of_birth');
                    $user_role     = $request->getPost('user_role');

                    if($request->getPost('category'))
                       $category      = $request->getPost('category');

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
                        $session->setFlashdata('msg', 'User Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $userdata['login_id'];
                        $userModel->update(array("id" => $id),$ins_data);
                    }
                    else
                    {
                        $session->setFlashdata('msg', 'User Added Successfully!');
                        $ins_data['created_date']  =  date("Y-m-d H:i:s");
                        $ins_data['created_id']    =  $userdata['login_id'];
                        $userModel->save($ins_data);
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
                    $editdata['firstname']  = ($request->getPost('firstname'))?$request->getPost('firstname'):'';
                    $editdata['lastname']   = ($request->getPost('lastname'))?$request->getPost('lastname'):'';
                    $editdata['middlename'] = ($request->getPost('middlename'))?$request->getPost('middlename'):'';
                    $editdata['email']      = ($request->getPost('email'))?$request->getPost('email'):'';
                    $editdata['phone']      = ($request->getPost('phonenumber'))?$request->getPost('phonenumber'):'';
                    $editdata['role']       = ($request->getPost('user_role'))?$request->getPost('user_role'):'';
                    $editdata['address']    = ($request->getPost('address'))?$request->getPost('address'):'';
                    $editdata['dob']        = ($request->getPost('date_of_birth'))?$request->getPost('date_of_birth'):'';
                    $editdata['gender']     = ($request->getPost('gender'))?$request->getPost('gender'):'';
                    $editdata['category']   = ($request->getPost('category'))?$request->getPost('category'):'';
                    $editdata['id']         = ($request->getPost('id'))?$request->getPost('id'):'';
                }

                  if($request->getPost())
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

        helper(array('form', 'url'));
        $session   = \Config\Services::session();
        $userdata  = $session->get('userdata');

        $request   = \Config\Services::request();

        if(is_array($userdata) && count($userdata)):

            $userModel = new UserModel();

            $id = $userdata['login_id'];
            $getUserData = $userModel->getListsOfUsers($id);
            $edit_data   = $getUserData->getRowArray();

            $data['userdata'] = $userdata;

            $validation = $this->validate($this->validation_rules('profile',$id));
            
            if($validation) {

                if($request->getPost()){
                
                    $firstname     = $request->getPost('firstname');
                    $lastname      = $request->getPost('lastname');
                    $middlename    = $request->getPost('middlename');
                    $email         = $request->getPost('email');
                    $phonenumber   = $request->getPost('phonenumber');
                    $gender        = $request->getPost('gender');
                    $date_of_birth = $request->getPost('date_of_birth');
                    $id            = $request->getPost('id');

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
                        $session->setFlashdata('msg', 'User Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $userdata['login_id'];
                        $userModel->update(array("id" => $id),$ins_data);
                    }
                    
                    return redirect()->route('admin/profile');
                }
            }
            else
            {  
            
                $editdata['firstname']  = ($request->getPost('firstname'))?$request->getPost('firstname'):'';
                $editdata['lastname']   = ($request->getPost('lastname'))?$request->getPost('lastname'):'';
                $editdata['middlename'] = ($request->getPost('middlename'))?$request->getPost('middlename'):'';
                $editdata['email']      = ($request->getPost('email'))?$request->getPost('email'):'';
                $editdata['phone']      = ($request->getPost('phonenumber'))?$request->getPost('phonenumber'):'';
                $editdata['address']    = ($request->getPost('address'))?$request->getPost('address'):'';
                $editdata['dob']        = ($request->getPost('date_of_birth'))?$request->getPost('date_of_birth'):'';
                $editdata['gender']     = ($request->getPost('gender'))?$request->getPost('gender'):'';
                $editdata['id']         = ($request->getPost('id'))?$request->getPost('id'):$id;   
            } 

            if($request->getPost())
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
        $userModel = new UserModel();
        $session = \Config\Services::session();

        $userdata  = $session->get('userdata'); 
        $data['userdata'] = $userdata;

        if(is_array($userdata) && count($userdata)):
          $userModel->delete(array("id" => $id));
          return redirect()->route('admin/user');
        else:
            return redirect()->route('admin/login');
        endif;
    }

    public function changepassword($id='')
    {
        helper(array('form', 'url'));
        $userModel = new UserModel();
        $session   = \Config\Services::session();

        $request   = \Config\Services::request();
        $validation = \Config\Services::validation();

        $userdata  = $session->get('userdata'); 
        $data['userdata'] = $userdata;

        if(is_array($userdata) && count($userdata)):

            $userModel = new UserModel();

            $data['userdata'] = $userdata;

            $validation = $this->validate($this->validation_rules('change_password',$id));
            
            if($validation) {

                if($request->getPost()){
                
                    $newPassword     = $request->getPost('new_password');
                    $id              = $request->getPost('id');

                    $ins_data = array();
                    $ins_data['password']  = md5($newPassword);
                    
                    if(!empty($id)){
                        $session->setFlashdata('msg', 'Password Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $userdata['login_id'];
                        $userModel->update(array("id" => $id),$ins_data);
                    }
                    
                    return redirect()->route('admin/user');
                }
            }
            else
            {  
            
                $editdata['new_password']       = ($request->getPost('new_password'))?$request->getPost('new_password'):'';
                $editdata['confirm_password']   = ($request->getPost('confirm_password'))?$request->getPost('confirm_password'):'';
                $editdata['id']                 = ($request->getPost('id'))?$request->getPost('id'):$id;   
            } 

            if($request->getPost())
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

}
