<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Category extends BaseController
{

    public function index()
    {
        
        $this->data['lists'] = $this->categoryModel->getListsOfCategories()->getResultArray();
       
        return render('admin/category/list',$this->data);
        
    }

    public function add($id='')
    {
        
            if(!empty($id)){
                $getUserData = $this->categoryModel->getListsOfCategories($id);
                $edit_data   = $getUserData->getRowArray();
            }
            
            if($this->request->getPost())
               $id  = $this->request->getPost('id');
               
            $this->validation = $this->validate($this->validation_rules());
            
            if($this->validation) {

                if($this->request->getPost()){
                
                    $category      = $this->request->getPost('name');
                    $active        = $this->request->getPost('status');
                    $type          = $this->request->getPost('type');

                    
                    $ins_data = array();
                    $ins_data['name']       = $category;
                    $ins_data['type']       = $type;
                    $ins_data['status']     = $active;
                    
                    if(!empty($id)){
                        $this->session->setFlashdata('msg', 'Category Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $this->data['userdata']['login_id'];
                        $this->categoryModel->update(array("id" => $id),$ins_data);
                    }
                    else
                    {
                        $this->session->setFlashdata('msg', 'Category Added Successfully!');
                        $ins_data['created_date']  =  date("Y-m-d H:i:s");
                        $ins_data['created_id']    =  $this->data['userdata']['login_id'];
                        $this->categoryModel->save($ins_data);
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
                    $editdata['name']       = ($this->request->getPost('name'))?$this->request->getPost('name'):'';
                    $editdata['status']     = ($this->request->getPost('status'))?$this->request->getPost('status'):'Active';
                    $editdata['type']       = ($this->request->getPost('type'))?$this->request->getPost('type'):'Research Awards';
                    $editdata['id']         = ($this->request->getPost('id'))?$this->request->getPost('id'):'';
                }

                  if($this->request->getPost())
                    $this->data['validation'] = $this->validator;


                    $this->data['editdata'] = $editdata;
                    return render('admin/category/add',$this->data);
                      
            }       
       
    }


    public function validation_rules($id = '')
    {

        $validation_rules = array();
        $validation_rules = array(
                                        "name" => array("label" => "Category Name",'rules' => 'required|is_unique[category.name,id,'.$id.']')
        );
    
        return $validation_rules;
      
    }

    public function delete($id='')
    {
        if (strtolower($this->request->getMethod()) == "post") {  

            if($this->validation->withRequest($this->request)->run()) {

                    $this->categoryModel->delete(array("id" => $id));
                    if($this->request->isAJAX()){
                            
                        return $this->response->setJSON([
                            'status'            => 'success',
                            'message'              => 'Category deleted Successfully'
                        ]); 
                    }
            }
        }    
    }
}
