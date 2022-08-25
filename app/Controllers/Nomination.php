<?php

namespace App\Controllers;


class Nomination extends BaseController
{
    public function index()
    {
        return  view('frontend/header')
               .view('frontend/ssan')
               .view('frontend/footer');
    }

    public function spsfn()
    {


        helper(array('form', 'url'));

        $session = \Config\Services::session();
        $userdata  = $session->get('userdata');
    
        $request    = \Config\Services::request();
        $validation = \Config\Services::validation();

        $userModel = new UserModel();

        if(is_array($userdata) && count($userdata)):
           
            if(!empty($id)){
                $getUserData = $userModel->getListsOfUsers($id);
                $edit_data   = $getUserData->getRowArray();
            }
            
            if($request->getPost())
               $id  = $request->getPost('id');
               
            $validation = $this->validate($this->validation_rules('user',$id));
          
            if($validation) {

                if($request->getPost()){
                
                    $firstname     = $request->getPost('category');
                    $lastname      = $request->getPost('nominee_name');
                    $middlename    = $request->getPost('date_of_birth');
                    $email         = $request->getPost('citizenship');
                    $phonenumber   = $request->getPost('phonenumber');
                    $gender        = $request->getPost('gender');
                    $date_of_birth = $request->getPost('date_of_birth');
                    $user_role     = $request->getPost('user_role');
                    

                    $ins_data = array();
                    $ins_data['firstname']  = $firstname;
                    $ins_data['lastname']   = $lastname;
                    $ins_data['middlename'] = $middlename;
                    $ins_data['email']      = $email;
                    $ins_data['phone']      = $phonenumber;
                    $ins_data['role']       = $user_role;
                    $ins_data['address']    = '';
                    $ins_data['dob']        =  $date_of_birth;
                    
                    if(!empty($id)){
                        $session->setFlashdata('msg', 'User Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $userdata['login_id'];
                        $userModel->update(array("id" => $id),$ins_data);
                    }
                    else
                    {
                        $session->setFlashdata('msg', 'Submitted Successfully!');
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
                    $editdata['id']         = ($request->getPost('id'))?$request->getPost('id'):'';
                }

                  if($request->getPost())
                    $data['validation'] = $this->validator;


                    $data['editdata'] = $editdata;
                    return   view('frontend/header')
                            .view('frontend/spsfn')
                            .view('frontend/footer');
            }       
        else:
            return redirect()->route('admin/login');
        endif;   


        
    }

}
