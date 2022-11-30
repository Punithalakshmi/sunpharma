<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NominationTypesModel;
use App\Models\CategoryModel;
use App\Models\RoleModel;


class Nomination extends BaseController
{

    public function index()
    {
        $session = \Config\Services::session();

        $userdata      = $session->get('userdata');
        $nominationTypesModel = new NominationTypesModel();
        $categoryModel        = new CategoryModel();
        
        $data['userdata'] = $userdata;
       
        if(is_array($userdata) && count($userdata)):

            $nominationTypeLists = $nominationTypesModel->getListsOfNominations();

            foreach($nominationTypeLists as $ukey => $uvalue){
                
                if(!empty($uvalue['category_id'])){ 
                 $category = $categoryModel->getListsOfCategories($uvalue['category_id']);
                    
                 $category = $category->getRowArray();
                 
                 $nominationTypeLists[$ukey]['category_id'] = (isset($category['name']) && !empty($category['name']))?$category['name']:'';
                }
                else
                {
                 $nominationTypeLists[$ukey]['category_id'] = '-';
                }
             }
           
            $data['lists'] = $nominationTypeLists;
            return view('_partials/header',$data)
                .view('admin/nomination/list',$data)
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
        $nominationTypesModel = new NominationTypesModel();
        $categoryModel        = new CategoryModel();

        $data['categories']  = $categoryModel->getListsOfCategories();
        
        if(is_array($userdata) && count($userdata)):
           
            if(!empty($id)){
                $getUserData = $nominationTypesModel->getListsOfNominations($id);
                $edit_data   = $getUserData->getRowArray();
            }
            
            if($request->getPost())
               $id  = $request->getPost('id');
               
            $validation = $this->validate($this->validation_rules());
            if($validation) {

                if($request->getPost()){
                
                    $category      = $request->getPost('category');
                    $start_date    = $request->getPost('start_date');
                    $end_date      = $request->getPost('end_date');
                   // $year          = $request->getPost('nomination_year');
                    $status        = $request->getPost('status');
                    $subject      = $request->getPost('subject');
                    $title        = $request->getPost('title');
                    $description  = $request->getPost('description');

                    
                    $ins_data = array();
                    $ins_data['category_id']  = $category;
                    $ins_data['start_date']   = date("Y-m-d",strtotime($start_date));
                    $ins_data['end_date']     = date("Y-m-d",strtotime($end_date));
                  //  $ins_data['year']         = $year;
                    $ins_data['status']       = $status;
                    $ins_data['subject']           = $subject; 
                    $ins_data['description']       = $description;
                    $ins_data['title']             = $title;

                    if($this->request->getFile('banner_image') != ''){
                        $fileUploadDir = 'uploads/events/';
                            
                        if(!file_exists($fileUploadDir) && !is_dir($fileUploadDir))
                        mkdir($fileUploadDir, 0777, true);
                        
                        //upload documents to respestive nominee folder
                        $banner_image = $this->request->getFile('banner_image');
                        $banner_image->move($fileUploadDir);

                        $ins_data['banner_image']  = $banner_image->getClientName();
                    }

                    if($this->request->getFile('thumb_image') != ''){
                        $fileUploadDir = 'uploads/events/';
                            
                        if(!file_exists($fileUploadDir) && !is_dir($fileUploadDir))
                        mkdir($fileUploadDir, 0777, true);
                        
                        //upload documents to respestive nominee folder
                        $thumb_image = $this->request->getFile('thumb_image');
                        $thumb_image->move($fileUploadDir);

                        $ins_data['thumb_image']  = $thumb_image->getClientName();
                    }

                    if($this->request->getFile('event_document') != ''){
                        $fileUploadDir = 'uploads/events/';
                            
                        if(!file_exists($fileUploadDir) && !is_dir($fileUploadDir))
                        mkdir($fileUploadDir, 0777, true);
                        
                        //upload documents to respestive nominee folder
                        $event_document = $this->request->getFile('event_document');
                        $event_document->move($fileUploadDir);

                        $ins_data['document']  = $event_document->getClientName();
                    }
               
                    if(!empty($id)){
                        $session->setFlashdata('msg', 'Nomination Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $userdata['login_id'];
                        $nominationTypesModel->update(array("id" => $id),$ins_data);
                    }
                    else
                    {
                        $session->setFlashdata('msg', 'Nomination Added Successfully!');
                        $ins_data['created_date']  =  date("Y-m-d H:i:s");
                        $ins_data['created_id']    =  $userdata['login_id'];
                        $nominationTypesModel->save($ins_data);
                    } 

                    return redirect()->route('admin/nomination');
                }
            }
            else
            {  
            
                if(!empty($edit_data) && count($edit_data)){
                    $editdata['category']   = $edit_data['category_id'];
                   // $editdata['year']       = $edit_data['year'];
                    $editdata['start_date'] = date("m/d/Y",strtotime($edit_data['start_date']));
                    $editdata['end_date']   = date("m/d/Y",strtotime($edit_data['end_date']));
                    $editdata['banner_image']          = $edit_data['banner_image'];
                    $editdata['thumb_image']           = $edit_data['thumb_image'];
                    $editdata['status']                = $edit_data['status'];
                    $editdata['title']                 = $edit_data['title'];
                    $editdata['subject']               = $edit_data['subject'];
                    $editdata['description']           = $edit_data['description'];
                    $editdata['id']         = $edit_data['id'];
                }
                else
                {
                    $editdata['title']                = ($request->getPost('title'))?$request->getPost('title'):'';
                    $editdata['subject']              = ($request->getPost('subject'))?$request->getPost('subject'):'';
                    $editdata['description']          = ($request->getPost('description'))?$request->getPost('description'):'';
                    $editdata['category']       = ($request->getPost('category'))?$request->getPost('category'):'';
                  //  $editdata['year']           = ($request->getPost('year'))?$request->getPost('year'):date("Y");
                    $editdata['start_date']     = ($request->getPost('start_date'))?$request->getPost('start_date'):date("m/d/Y");
                    $editdata['end_date']       = ($request->getPost('end_date'))?$request->getPost('end_date'):date("m/d/Y");
                    $editdata['banner_image']         = ($this->request->getFile('banner_image'))?$this->request->getFile('banner_image'):'';
                    $editdata['thumb_image']          = ($this->request->getFile('thumb_image'))?$this->request->getFile('thumb_image'):'';
                    $editdata['status']               = ($request->getPost('status'))?$request->getPost('status'):'0';
                    $editdata['id']             = ($request->getPost('id'))?$request->getPost('id'):'';
                }

                  if($request->getPost())
                    $data['validation'] = $this->validator;


                    $data['editdata'] = $editdata;
                    return view('_partials/header',$data)
                        .view('admin/nomination/add',$data)
                        .view('_partials/footer');
            }       
        else:
            return redirect()->route('admin/login');
        endif; 


    }


    public function validation_rules()
    {

        $validation_rules = array();
        $validation_rules = array(
            "category" => array("label" => "Category",'rules' => 'required'),
            "subject" => array("label" => "Subject",'rules' => 'required'),
            "description" => array("label" => "Description",'rules' => 'required'),
                                        "start_date" => array("label" => "Start Date",'rules' => 'required'),
                                        "status" => array("label" => "Status",'rules' => 'required')
        );
    
        return $validation_rules;
      
    }

    public function delete($id='')
    {
        $nominationTypesModel = new NominationTypesModel();
        $session = \Config\Services::session();

        $userdata  = $session->get('userdata'); 
        $data['userdata'] = $userdata;

        if(is_array($userdata) && count($userdata)):
          $nominationTypesModel->delete(array("id" => $id));
          return redirect()->route('admin/nomination');
        else:
            return redirect()->route('admin/login');
        endif;
    }

    
}
