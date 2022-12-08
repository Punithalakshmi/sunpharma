<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RegisterationModel;


class EventRegisteration extends BaseController
{

    public function index()
    {
        $session = \Config\Services::session();

        $userdata      = $session->get('userdata');
        $registerationModel = new RegisterationModel();
       
        $data['userdata'] = $userdata;
       
        if(is_array($userdata) && count($userdata)):

            $workshopLists = $registerationModel->getRegisteredUsers();

            $data['lists'] = $workshopLists;
            return view('_partials/header',$data)
                .view('admin/event_registeration/list',$data)
                .view('_partials/footer');
        else:
            return redirect()->route('admin/login');
        endif;        
    }

    public function add($id='')
    {
        helper(array('form', 'url'));

        $session   = \Config\Services::session();
        $userdata  = $session->get('userdata');
    
        $request    = \Config\Services::request();
        $validation = \Config\Services::validation();
        
        $data['userdata'] = $userdata;
    
        $registerationModel = new RegisterationModel();
      
        if(is_array($userdata) && count($userdata)):
           
            if(!empty($id)){
                $edit_data   = $registerationModel->getRegisteredUsers($id);
                $edit_data   = $edit_data->getRowArray();
            }

            //check registered users count
            $countofRegisteredUsers = $registerationModel->getRegisteredUsers();

            $count = $registerationModel->CountAll();
            
            $ct = $count + 1;
             
            $registerationNo = 'SPSFN-REG-'.$ct;
            
            if($request->getPost())
               $id  = $request->getPost('id');
               
            $validation = $this->validate($this->validation_rules($id = ''));

            $data['event_categories']  = $this->workshopModel->getEventTypes()->getResultArray();

            if($validation) {

                if($request->getPost()){
                
                    $firstname     = $request->getPost('firstname');
                    $lastname      = $request->getPost('lastname');
                    $email        = $request->getPost('email');
                    $phone        = $request->getPost('phone');
                    $address      = $request->getPost('address');
                    $registeration_no  = $request->getPost('registeration_no');
                  
                    $ins_data = array();
                    $ins_data['firstname']          = $firstname;
                    $ins_data['lastname']           = $lastname; 
                    $ins_data['email']              = $email;
                    $ins_data['phone']              = $phone;
                    $ins_data['address']            = $address;
                    $ins_data['registeration_no']   = $registeration_no;
                  
                    if(!empty($id)){
                        $session->setFlashdata('msg', 'Registeration Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $userdata['login_id'];
                        $registerationModel->update(array("id" => $id),$ins_data);
                    }
                    else
                    {
                        $session->setFlashdata('msg', 'Registeration Added Successfully!');
                        $ins_data['created_date']  =  date("Y-m-d H:i:s");
                        $ins_data['created_id']    =  $userdata['login_id'];
                        $registerationModel->save($ins_data);
                    } 

                    return redirect()->route('admin/eventregisteration');
                }
            }
            else
            {  
            
                    if(!empty($edit_data) && count($edit_data)){
                        $editdata['firstname']               = $edit_data['firstname'];
                        $editdata['lastname']                = $edit_data['lastname'];
                        $editdata['email']                   = $edit_data['email'];
                        $editdata['phone']                   = $edit_data['phone'];
                        $editdata['address']                 = $edit_data['address'];
                        $editdata['event_type']              = $edit_data['event_type'];
                        $editdata['registeration_no']        = (!empty($edit_data['registeration_no']))?$edit_data['registeration_no']:'SPSFN-REG-'.$id;
                        $editdata['id']                      = $edit_data['id'];
                    }
                    else
                    {
                        $editdata['firstname']                = ($request->getPost('firstname'))?$request->getPost('firstname'):'';
                        $editdata['lastname']              = ($request->getPost('lastname'))?$request->getPost('lastname'):'';
                        $editdata['email']          = ($request->getPost('email'))?$request->getPost('email'):'';
                        $editdata['phone']             = ($request->getPost('phone'))?$request->getPost('phone'):'';
                        $editdata['address']             = ($request->getPost('address'))?$request->getPost('address'):'';
                        $editdata['registeration_no']             = ($request->getPost('registeration_no'))?$request->getPost('registeration_no'):$registerationNo;
                        $editdata['id']                   = ($request->getPost('id'))?$request->getPost('id'):'';
                        $editdata['event_type']                   = ($request->getPost('event_type'))?$request->getPost('event_type'):'';
                    }
                

                  if($request->getPost())
                     $data['validation'] = $this->validator;

                    $data['editdata'] = $editdata;
                    return view('_partials/header',$data)
                           .view('admin/event_registeration/add',$data)
                           .view('_partials/footer');
            }
                   
        else:
            return redirect()->route('admin/login');
        endif; 
    }


    public function validation_rules($id = '')
    {

        $validation_rules = array();
        $validation_rules = array(   "firstname" => array("label" => "Firstname",'rules' => 'required'),
                                    "lastname" => array("label" => "Lastname",'rules' => 'required'),
                                    "phone" => array("label" => "Phone",'rules' => 'required'),
                                     "email" => array("label" => "Email",'rules' => 'required|valid_email|is_unique[event_registerations.email,id,'.$id.']')
                                );
    
        return $validation_rules;
      
    }

    public function delete($id='')
    {
        $registerationModel = new RegisterationModel();
        $session = \Config\Services::session();

        $userdata  = $session->get('userdata'); 
        $data['userdata'] = $userdata;

        if(is_array($userdata) && count($userdata)):
          $registerationModel->delete(array("id" => $id));
          if($this->request->isAJAX()){
                
            return $this->response->setJSON([
                'status'            => 'success',
                'message'           => 'Registration deleted Successfully'
            ]); 
         }
        else
            return redirect()->route('admin/login');
        endif;
    }
}
