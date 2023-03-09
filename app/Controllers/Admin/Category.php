<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Category extends BaseController
{

    public function index()
    {
        
        $filter = array();
        $filter['award']      = '';
        $filter['start']      = '0';
        $filter['limit']      = '10';
        $filter['orderField'] = 'id';
        $filter['orderBy']    = 'desc';
        $totalRecords  = $this->categoryModel->getCategoryLists();
        
        if (strtolower($this->request->getMethod()) == "post") { 

            if(!$this->validation->withRequest($this->request)->run()) {

                $dtpostData = $this->request->getPost('data');

                $response = array();
    
                $draw            = $dtpostData['draw'];
                $start           = $dtpostData['start'];
                $rowperpage      = $dtpostData['length']; // Rows display per page
                $columnIndex     = $dtpostData['order'][0]['column']; // Column index
                $columnName      = $dtpostData['columns'][$columnIndex]['data']; // Column name
                $columnSortOrder = $dtpostData['order'][0]['dir']; // asc or desc
                $searchValue     = $dtpostData['search']['value']; // Search value

                 // Custom filter
                $award                 = $dtpostData['award'];
                $filter['award']       = $award;
                $filter['limit']       = $rowperpage;
                $filter['orderField']  = $columnName;
                $filter['orderBy']     = $columnSortOrder;
                $filter['start']      =  $start;

                $categoryLists = $this->categoryModel->getCategoryByFilter($filter)->getResultArray();
               
                $filter['totalRows'] = 'yes';
               
                $totalRecordsWithFilterCt = $this->categoryModel->getCategoryByFilter($filter);
               
                $totalRecordsWithFilter = (!empty($award))?$totalRecordsWithFilterCt:$totalRecords;
            
          }

        }
        else
        {    
            $categoryLists = $this->categoryModel->getCategoryByFilter($filter)->getResultArray();
            $totalRecordsWithFilter = count($categoryLists);
        }

        $this->data['lists'] = $categoryLists;
         
        $data = array();
        foreach($categoryLists as $ukey => $uvalue){
            
                $data[] = array('name' => $uvalue['name'],
                                'type' => $uvalue['type'],
                                'status' => $uvalue['status'],
                                'created_date' => $uvalue['created_date'],
                                'id' => $uvalue['id'],
                                'action' => ''
                             );
         }
           
        
        if($this->request->isAJAX()) {
            
            $end  = $filter['start'] + $filter['limit'];
                return $this->response->setJSON(array(
                                        'status' => 'success',
                                        'data'  => $data,
                                        'token' => csrf_hash(),
                                        "draw" => intval($draw),
                                        "iTotalRecords" => $totalRecords,
                                        "start" => $filter['start'],
                                        "end" => $end,
                                        "length" => $filter['limit'],
                                        "page" => $draw,
                                        "iTotalDisplayRecords" => $totalRecordsWithFilter
                                    )); 
                exit;
          }
          else
          {
            return render('admin/category/list',$this->data);
          } 
        
    }

    public function add($id='')
    {
        
            if(!empty($id)){
                $getUserData = $this->categoryModel->getListsOfCategories($id);
                $edit_data   = $getUserData->getRowArray();
            }
            
            if($this->request->getPost())
               $id  = $this->request->getPost('id');
               
            $this->validation = $this->validate($this->validation_rules($id));
            
            if($this->validation) {

                if (strtolower($this->request->getMethod()) == "post") {
                
                    $category      = $this->request->getPost('name');
                    $active        = $this->request->getPost('status');
                    $type          = $this->request->getPost('type');

                    
                    $ins_data = array();
                    $ins_data['name']       = $category;
                    $ins_data['type']       = $type;
                    $ins_data['status']     = $active;
                    $ins_data['main_category_id'] = ($type == 'Research Awards')?1:2;
                    
                    if(!empty($id)){
                        $this->session->setFlashdata('msg', 'Award Type Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $this->data['userdata']['login_id'];
                        $this->categoryModel->update(array("id" => $id),$ins_data);
                    }
                    else
                    {
                        $this->session->setFlashdata('msg', 'Award Type Added Successfully!');
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
                                        "name" => array("label" => "Award Type Name",'rules' => 'required|is_unique[category.name,id,'.$id.']')
        );
    
        return $validation_rules;
      
    }

    public function delete($id='')
    {
        if (strtolower($this->request->getMethod()) == "post") {  

          
                    $this->categoryModel->delete(array("id" => $id));
                    if($this->request->isAJAX()){
                            
                        return $this->response->setJSON([
                            'status'            => 'success',
                            'message'              => 'Award Type deleted Successfully'
                        ]); 
                    }
            
        }    
    }
}
