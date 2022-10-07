<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WorkshopModel;


class Workshops extends BaseController
{

    public function index()
    {
        $session = \Config\Services::session();

        $userdata      = $session->get('userdata');
        $workshopModel = new WorkshopModel();
       
        $data['userdata'] = $userdata;
       
        if(is_array($userdata) && count($userdata)):

            $workshopLists = $workshopModel->getLists();

            $data['lists'] = $workshopLists;
            return view('_partials/header',$data)
                .view('admin/workshop/list',$data)
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
    
        $workshopModel = new WorkshopModel();

        if(is_array($userdata) && count($userdata)):
           
            if(!empty($id)){
                $edit_data = $workshopModel->getLists($id);
                $edit_data   = $edit_data->getRowArray();
            }
            
            if($request->getPost())
               $id  = $request->getPost('id');
               
            $validation = $this->validate($this->validation_rules());
            if($validation) {

                if($request->getPost()){
                
                    $firstname     = $request->getPost('firstname');
                    $lastname      = $request->getPost('lastname');
                    $email         = $request->getPost('email');
                    $phone         = $request->getPost('phone');
                    $address       = $request->getPost('address');
                    $link          = $request->getPost('registration_link');

                    $ins_data = array();
                    $ins_data['firstname']   = $firstname;
                    $ins_data['lastname']  = $lastname; 
                    $ins_data['email']  = $email;
                    $ins_data['phone']  = $phone;
                    $ins_data['address']  = $address;
                    $ins_data['start_date']   = date("Y-m-d",strtotime($start_date));
                    $ins_data['end_date']     = date("Y-m-d",strtotime($end_date));
                    $ins_data['year']         = $year;
                    $ins_data['registration_link']         = $link;
                   
                    if(!empty($id)){
                        $session->setFlashdata('msg', 'Workshop Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $userdata['login_id'];
                        $workshopModel->update(array("id" => $id),$ins_data);
                    }
                    else
                    {
                        $session->setFlashdata('msg', 'Workshop Added Successfully!');
                        $ins_data['created_date']  =  date("Y-m-d H:i:s");
                        $ins_data['created_id']    =  $userdata['login_id'];
                        $workshopModel->save($ins_data);
                    } 

                    return redirect()->route('admin/workshops');
                }
            }
            else
            {  
            
                if(!empty($edit_data) && count($edit_data)){
                    $editdata['firstname']   = $edit_data['firstname'];
                    $editdata['lastname']  = $edit_data['lastname'];
                    $editdata['email']  = $edit_data['email'];
                    $editdata['phone']  = $edit_data['phone'];
                    $editdata['address']  = $edit_data['address'];
                    $editdata['year']         = $edit_data['year'];
                    $editdata['start_date']   = date("m/d/Y",strtotime($edit_data['start_date']));
                    $editdata['end_date']     = date("m/d/Y",strtotime($edit_data['end_date']));
                    $editdata['registration_link']     = $edit_data['registration_link'];
                    $editdata['id']           = $edit_data['id'];
                }
                else
                {
                    $editdata['firstname']     = ($request->getPost('firstname'))?$request->getPost('firstname'):'';
                    $editdata['lastname']    = ($request->getPost('lastname'))?$request->getPost('lastname'):'';
                    $editdata['email']    = ($request->getPost('email'))?$request->getPost('email'):'';
                    $editdata['phone']    = ($request->getPost('phone'))?$request->getPost('phone'):'';
                    $editdata['address']    = ($request->getPost('address'))?$request->getPost('address'):'';
                    $editdata['year']           = ($request->getPost('year'))?$request->getPost('year'):date("Y");
                    $editdata['start_date']     = ($request->getPost('start_date'))?$request->getPost('start_date'):date("m/d/Y");
                    $editdata['end_date']       = ($request->getPost('end_date'))?$request->getPost('end_date'):date("m/d/Y");
                    $editdata['registration_link']    = ($request->getPost('registration_link'))?$request->getPost('registration_link'):'';
                    $editdata['id']             = ($request->getPost('id'))?$request->getPost('id'):'';
                }

                  if($request->getPost())
                    $data['validation'] = $this->validator;


                    $data['editdata'] = $editdata;
                    return view('_partials/header',$data)
                        .view('admin/workshop/add',$data)
                        .view('_partials/footer');
            }       
        else:
            return redirect()->route('admin/login');
        endif; 
    }


    public function validation_rules()
    {

        $validation_rules = array();
        $validation_rules = array(   "event_name" => array("label" => "Event",'rules' => 'required'),
                                    "start_date" => array("label" => "Start Date",'rules' => 'required'));
    
        return $validation_rules;
      
    }

    public function delete($id='')
    {
        $workshopModel = new WorkshopModel();
        $session = \Config\Services::session();

        $userdata  = $session->get('userdata'); 
        $data['userdata'] = $userdata;

        if(is_array($userdata) && count($userdata)):
          $workshopModel->delete(array("id" => $id));
          return redirect()->route('admin/workshops');
        else:
            return redirect()->route('admin/login');
        endif;
    }
}
