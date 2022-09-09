<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\RatingModel;

class Rating extends BaseController
{

    public function add($id='')
    {
        helper(array('form', 'url'));

        $session = \Config\Services::session();
        $userdata  = $session->get('userdata');
    
        $request    = \Config\Services::request();
        $validation = \Config\Services::validation();
        
        $data['userdata'] = $userdata;
        $categoryModel = new CategoryModel();

        if(is_array($userdata) && count($userdata)):
           
            if(!empty($id)){
                $getUserData = $categoryModel->getListsOfCategories($id);
                $edit_data   = $getUserData->getRowArray();
            }
            
            if($request->getPost())
               $id  = $request->getPost('id');
               
            $validation = $this->validate($this->validation_rules());
            if($validation) {

                if($request->getPost()){
                
                    $category      = $request->getPost('name');
                    $active        = $request->getPost('status');
                    $type          = $request->getPost('type');

                    
                    $ins_data = array();
                    $ins_data['name']       = $category;
                    $ins_data['type']       = $type;
                    $ins_data['status']     = $active;
                    
                    if(!empty($id)){
                       // print_r($ins_data); die;
                        $session->setFlashdata('msg', 'Category Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $userdata['login_id'];
                        $categoryModel->update(array("id" => $id),$ins_data);
                    }
                    else
                    {
                        $session->setFlashdata('msg', 'Category Added Successfully!');
                        $ins_data['created_date']  =  date("Y-m-d H:i:s");
                        $ins_data['created_id']    =  $userdata['login_id'];
                        $categoryModel->save($ins_data);
                    } 

                    return redirect()->route('admin/category');
                }
            }
            else
            {  
            
                if(!empty($edit_data) && count($edit_data)){
                    $editdata['name']       = $edit_data['name'];
                    $editdata['status']     = $edit_data['status'];
                    $editdata['type']       = $edit_data['type'];
                    $editdata['id']       = $edit_data['id'];
                }
                else
                {
                    $editdata['name']       = ($request->getPost('name'))?$request->getPost('name'):'';
                    $editdata['status']     = ($request->getPost('status'))?$request->getPost('status'):'Active';
                    $editdata['type']       = ($request->getPost('type'))?$request->getPost('type'):'Research Awards';
                    $editdata['id']         = ($request->getPost('id'))?$request->getPost('id'):'';
                }

                  if($request->getPost())
                    $data['validation'] = $this->validator;


                    $data['editdata'] = $editdata;
                    return view('_partials/header',$data)
                        .view('admin/category/add',$data)
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
                                        "name" => array("label" => "Category Name",'rules' => 'required')
        );
    
        return $validation_rules;
      
    }

    public function delete($id='')
    {
        $categoryModel = new CategoryModel();
        $session = \Config\Services::session();

        $userdata  = $session->get('userdata'); 
        $data['userdata'] = $userdata;

        if(is_array($userdata) && count($userdata)):
          $categoryModel->delete(array("id" => $id));
          return redirect()->route('admin/category');
        else:
            return redirect()->route('admin/login');
        endif;
    }
}
