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

        $session = \Config\Services::session();
        $userdata  = $session->get('userdata');
    
        $request    = \Config\Services::request();
        $validation = \Config\Services::validation();
        
        $data['userdata'] = $userdata;
    
        $workshopModel = new WorkshopModel();

        if(is_array($userdata) && count($userdata)):
           
            if(!empty($id)){
                $edit_data = $workshopModel->getLists($id);
               // $edit_data   = $getUserData->getRowArray();
            }
            
            if($request->getPost())
               $id  = $request->getPost('id');
               
            $validation = $this->validate($this->validation_rules());
            if($validation) {

                if($request->getPost()){
                
                    $event_name    = $request->getPost('event_name');
                    $description   = $request->getPost('description');
                    $start_date    = $request->getPost('start_date');
                    $end_date      = $request->getPost('end_date');
                    $year          = $request->getPost('year');

                    
                    $ins_data = array();
                    $ins_data['event_name']   = $event_name;
                    $ins_data['description']  = $description;
                    $ins_data['start_date']   = date("Y-m-d",strtotime($start_date));
                    $ins_data['end_date']     = date("Y-m-d",strtotime($end_date));
                    $ins_data['year']         = $year;
                   
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

                    return redirect()->route('admin/workshop');
                }
            }
            else
            {  
            
                if(!empty($edit_data) && count($edit_data)){
                    $editdata['event_name']   = $edit_data['event_name'];
                    $editdata['description']  = $edit_data['description'];
                    $editdata['year']         = $edit_data['year'];
                    $editdata['start_date']   = date("m/d/Y",strtotime($edit_data['start_date']));
                    $editdata['end_date']     = date("m/d/Y",strtotime($edit_data['end_date']));
                    $editdata['id']           = $edit_data['id'];
                }
                else
                {
                    $editdata['event_name']     = ($request->getPost('event_name'))?$request->getPost('event_name'):'';
                    $editdata['description']    = ($request->getPost('description'))?$request->getPost('description'):'';
                    $editdata['year']           = ($request->getPost('year'))?$request->getPost('year'):date("Y");
                    $editdata['start_date']     = ($request->getPost('start_date'))?$request->getPost('start_date'):date("m/d/Y");
                    $editdata['end_date']       = ($request->getPost('end_date'))?$request->getPost('end_date'):date("m/d/Y");
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
        $validation_rules = array("start_date" => array("label" => "Start Date",'rules' => 'required'));
    
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
          return redirect()->route('admin/workshop');
        else:
            return redirect()->route('admin/login');
        endif;
    }
}