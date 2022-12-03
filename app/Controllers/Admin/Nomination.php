<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Nomination extends BaseController
{

    public function index()
    {
        
            $nominationTypeLists = $this->nominationTypesModel->getListsOfNominations();

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

                

                if(!empty($uvalue['main_category_id'])){ 
                
                    $main_categories = $this->awardsCategoryModel->getListsOfCategories($uvalue['main_category_id']);
                       
                    $main_categories = $main_categories->getRowArray();
                    
                    $nominationTypeLists[$ukey]['main_category_id'] = (isset($main_categories['name']) && !empty($main_categories['name']))?$main_categories['name']:'';
                   }
                   else
                   {
                    $nominationTypeLists[$ukey]['main_category_id'] = '-';
                   }

             }
           
            $this->data['lists'] = $nominationTypeLists;

        
            return render('admin/nomination/list',$this->data);
                
              
    }

    public function add($id='')
    {
        
        $this->data['categories']  = $this->categoryModel->getListsOfCategories();
        $this->data['main_categories'] = $this->awardsCategoryModel->getListsOfCategories();
   
           
            if(!empty($id)){
                $getUserData =  $this->nominationTypesModel->getListsOfNominations($id);
                $edit_data   = $getUserData->getRowArray();
            }
            
            if($this->request->getPost())
               $id  = $this->request->getPost('id');
               
            $this->validator = $this->validate($this->validation_rules());
            if($this->validator) {

                if($this->request->getPost()){
                
                    $category      = $this->request->getPost('category');
                    $main_category_id = $this->request->getPost('main_category_id');
                    $start_date    = $this->request->getPost('start_date');
                    $end_date      = $this->request->getPost('end_date');
                   // $year          = $this->request->getPost('nomination_year');
                    $status        = $this->request->getPost('status');
                    $subject      = $this->request->getPost('subject');
                    $title        = $this->request->getPost('title');
                    $description  = $this->request->getPost('description');

                    
                    $ins_data = array();
                    $ins_data['category_id']  = $category;
                    $ins_data['main_category_id']  = $main_category_id;
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
                        $this->session->setFlashdata('msg', 'Nomination Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $userdata['login_id'];
                        $this->nominationTypesModel->update(array("id" => $id),$ins_data);
                    }
                    else
                    {
                        $this->session->setFlashdata('msg', 'Nomination Added Successfully!');
                        $ins_data['created_date']  =  date("Y-m-d H:i:s");
                        $ins_data['created_id']    =  $userdata['login_id'];
                        $this->nominationTypesModel->save($ins_data);
                    } 

                    return redirect()->route('admin/nomination');
                }
            }
            else
            {  
            
                if(!empty($edit_data) && count($edit_data)){
                    $editdata['category']   = $edit_data['category_id'];
                    $editdata['main_category_id']   = $edit_data['main_category_id'];
                
                    $editdata['start_date'] = date("m/d/Y",strtotime($edit_data['start_date']));
                    $editdata['end_date']   = date("m/d/Y",strtotime($edit_data['end_date']));
                    $editdata['banner_image']          = $edit_data['banner_image'];
                    $editdata['thumb_image']           = $edit_data['thumb_image'];
                    $editdata['status']                = $edit_data['status'];
                    $editdata['title']                 = $edit_data['title'];
                    $editdata['subject']               = $edit_data['subject'];
                    $editdata['description']           = $edit_data['description'];
                    $editdata['id']                    = $edit_data['id'];
                }
                else
                {
                    $editdata['title']                = ($this->request->getPost('title'))?$this->request->getPost('title'):'';
                    $editdata['subject']              = ($this->request->getPost('subject'))?$this->request->getPost('subject'):'';
                    $editdata['description']          = ($this->request->getPost('description'))?$this->request->getPost('description'):'';
                    $editdata['category']            = ($this->request->getPost('category'))?$this->request->getPost('category'):'';
                    $editdata['main_category_id']       = ($this->request->getPost('main_category_id'))?$this->request->getPost('main_category_id'):'';
                  //  $editdata['year']           = ($this->request->getPost('year'))?$this->request->getPost('year'):date("Y");
                    $editdata['start_date']     = ($this->request->getPost('start_date'))?$this->request->getPost('start_date'):date("m/d/Y");
                    $editdata['end_date']       = ($this->request->getPost('end_date'))?$this->request->getPost('end_date'):date("m/d/Y");
                    $editdata['banner_image']         = ($this->request->getFile('banner_image'))?$this->request->getFile('banner_image'):'';
                    $editdata['thumb_image']          = ($this->request->getFile('thumb_image'))?$this->request->getFile('thumb_image'):'';
                    $editdata['status']               = ($this->request->getPost('status'))?$this->request->getPost('status'):'0';
                    $editdata['id']             = ($this->request->getPost('id'))?$this->request->getPost('id'):'';
                }

                  if($this->request->getPost())
                    $this->data['validation'] = $this->validator;


                    $this->data['editdata'] = $editdata;
                    return render('admin/nomination/add',$this->data);
                       
            }       
       

    }


    public function validation_rules()
    {

        $this->validator_rules = array();
        $this->validator_rules = array(
                                        "main_category_id" => array("label" => "Main Category",'rules' => 'required'),
                                        "category" => array("label" => "Category",'rules' => 'required'),
                                        "subject" => array("label" => "Subject",'rules' => 'required'),
                                        "description" => array("label" => "Description",'rules' => 'required'),
                                        "start_date" => array("label" => "Start Date",'rules' => 'required'),
                                        "status" => array("label" => "Status",'rules' => 'required')
        );
    
        return $this->validator_rules;
      
    }

    public function delete($id='')
    {
       
          $nominationTypesModel->delete(array("id" => $id));
          return redirect()->route('admin/nomination');
    }

    
}
