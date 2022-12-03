<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class EventRegisteration extends BaseController
{

    public function index()
    {
            $workshopLists = $this->registerationModel->getRegisteredUsers();
            $this->data['lists'] = $workshopLists;
            return render('admin/event_registeration/list',$this->data);   
            
    }

    public function add($id='')
    {
        
        $this->data['eventTypes']  = $this->workshopModel->getEventTypes()->getResultArray();
           
            if(!empty($id)){
                $edit_data   = $this->registerationModel->getRegisteredUsers($id);
                $edit_data   = $edit_data->getRowArray();
            }

            //check registered users count
            $countofRegisteredUsers = $this->registerationModel->getRegisteredUsers();

            $count = $this->registerationModel->CountAll();
            
            $ct = $count + 1;
             
            $registerationNo = 'SPSFN-REG-'.$ct;
            
            if($this->request->getPost())
               $id  = $this->request->getPost('id');
               
            $this->validation = $this->validate($this->validation_rules($id = ''));

            $this->data['event_categories']  = $this->workshopModel->getEventTypes()->getResultArray();

            if($this->validation) {

                if($this->request->getPost()){
                
                    $firstname     = $this->request->getPost('firstname');
                    $lastname      = $this->request->getPost('lastname');
                    $email        = $this->request->getPost('email');
                    $phone        = $this->request->getPost('phone');
                    $address      = $this->request->getPost('address');
                    $registeration_no  = $this->request->getPost('registeration_no');
                  
                    $ins_data = array();
                    $ins_data['firstname']          = $firstname;
                    $ins_data['lastname']           = $lastname; 
                    $ins_data['email']              = $email;
                    $ins_data['phone']              = $phone;
                    $ins_data['address']            = $address;
                    $ins_data['registeration_no']   = $registeration_no;
                  
                    if(!empty($id)){
                        $this->session->setFlashdata('msg', 'Registeration Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $userdata['login_id'];
                        $this->registerationModel->update(array("id" => $id),$ins_data);
                    }
                    else
                    {
                        $this->session->setFlashdata('msg', 'Registeration Added Successfully!');
                        $ins_data['created_date']  =  date("Y-m-d H:i:s");
                        $ins_data['created_id']    =  $userdata['login_id'];
                        $this->registerationModel->save($ins_data);
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
                        $editdata['firstname']                = ($this->request->getPost('firstname'))?$this->request->getPost('firstname'):'';
                        $editdata['lastname']              = ($this->request->getPost('lastname'))?$this->request->getPost('lastname'):'';
                        $editdata['email']          = ($this->request->getPost('email'))?$this->request->getPost('email'):'';
                        $editdata['phone']             = ($this->request->getPost('phone'))?$this->request->getPost('phone'):'';
                        $editdata['address']             = ($this->request->getPost('address'))?$this->request->getPost('address'):'';
                        $editdata['registeration_no']             = ($this->request->getPost('registeration_no'))?$this->request->getPost('registeration_no'):$registerationNo;
                        $editdata['id']                   = ($this->request->getPost('id'))?$this->request->getPost('id'):'';
                        $editdata['event_type']                   = ($this->request->getPost('event_type'))?$this->request->getPost('event_type'):'';
                    }
                

                  if($this->request->getPost())
                     $this->data['validation'] = $this->validator;

                    $this->data['editdata'] = $editdata;
                    return render('admin/event_registeration/add',$this->data);
                          
            }
                   
        
    }


    public function validation_rules($id = '')
    {

        $this->validation_rules = array();
        $this->validation_rules = array(   "firstname" => array("label" => "Firstname",'rules' => 'required'),
                                    "lastname" => array("label" => "Lastname",'rules' => 'required'),
                                    "phone" => array("label" => "Phone",'rules' => 'required'),
                                     "email" => array("label" => "Email",'rules' => 'required|valid_email|is_unique[event_registerations.email,id,'.$id.']')
                                );
    
        return $this->validation_rules;
      
    }

    public function delete($id='')
    {
      
        $this->registerationModel->delete(array("id" => $id));
          return redirect()->route('admin/eventregisteration');
       
    }
}
