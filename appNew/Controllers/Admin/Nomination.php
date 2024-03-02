<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Nomination extends BaseController
{

    public function index()
    {
        
            $nominationTypeLists = $this->nominationTypesModel->getListsOfNominations()->getResultArray();
            $this->data['awardsLists']      = $nominationTypeLists;
            $this->data['main_categories']  = getAwardsCategory();
           // echo "<pre>";
           // print_r($this->data['awards']); 
            $this->data['awardTypes'] = getAwardsTypes();
           // print_r($this->data['awardTypes']); die;
            $filter = array();
            $filter['title']      = '';
            $filter['subject']    = '';
            $filter['type']       = '';
            $filter['award']      = '';
            $filter['start']      = '0';
            $filter['limit']      = '10';
            $filter['orderField'] = 'id';
            $filter['orderBy']    = 'desc';
            $totalRecords  = $this->nominationTypesModel->getNominationLists();
            
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
                    $title                 = $dtpostData['title'];
                    $subject               = $dtpostData['subject'];
                    $type                 = $dtpostData['type'];
                    $award                 = $dtpostData['award'];
                    $filter['title']      = $title;
                    $filter['subject']    = $subject;
                    $filter['type']       = $type;
                    $filter['award']      = $award;
                    $filter['limit']       = $rowperpage;
                    $filter['orderField']  = $columnName;
                    $filter['orderBy']     = $columnSortOrder;
                    $filter['start']      =  $start;

                    $nominationLists = $this->nominationTypesModel->getNominationsByFilter($filter)->getResultArray();
                
                    $filter['totalRows'] = 'yes';
                
                    $totalRecordsWithFilterCt = $this->nominationTypesModel->getNominationsByFilter($filter);
                
                    $totalRecordsWithFilter = (!empty($title) || !empty($subject) || !empty($type) || !empty($award))?$totalRecordsWithFilterCt:$totalRecords;
                
               }

            }
            else
            {    
                $nominationLists = $this->nominationTypesModel->getNominationsByFilter($filter)->getResultArray();
                $totalRecordsWithFilter = count($nominationLists);
            }

            $this->data['lists'] = $nominationLists;
            
            $data = array();
            foreach($nominationLists as $ukey => $uvalue){
                
                $data[] = array(
                                'main_category_id' => $uvalue['award'],
                                'category_id' => $uvalue['type'],
                                'title' => $uvalue['title'],
                                'subject' => $uvalue['subject'],
                                'start_date' => $uvalue['start_date'],
                                'end_date' => $uvalue['end_date'],
                                'status' => ($uvalue['status'] == 1)?'Active':'InActive',
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
                return render('admin/nomination/list',$this->data);
            } 

                 
    }

    public function add($id='')
    {
        
        $this->data['categories']  = $this->categoryModel->getListsOfCategories()->getResultArray();
        $this->data['main_categories'] = $this->awardsCategoryModel->getListsOfCategories();
   
           
            if(!empty($id)){
                $getUserData =  $this->nominationTypesModel->getListsOfNominations($id);
                $edit_data   = $getUserData->getRowArray();
            }
            
            if (strtolower($this->request->getMethod()) == "post") {  

               $id  = $this->request->getPost('id');

                $this->validation->setRules($this->validation_rules());
    
                if(!$this->validation->withRequest($this->request)->run()) {

                    $this->data['validation'] = $this->validation;

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
                else
                { 
                  // echo "test"; die;
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

                 //   print_r($ins_data); 

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


                    if($this->request->getFile('procedure_document') != ''){
                        $fileUploadDir = 'uploads/events/';
                            
                        if(!file_exists($fileUploadDir) && !is_dir($fileUploadDir))
                      	  mkdir($fileUploadDir, 0777, true);

                     //  echo $fileUploadDir; die;
                        //upload documents to respestive nominee folder
                        $procedure_document = $this->request->getFile('procedure_document');
                        $procedure_document->move($fileUploadDir);

			//echo "<pre>";

			//print_r($procedure_document); die;

                        $ins_data['procedure_document']  = $procedure_document->getClientName();
                    }
               
                    if(!empty($id)){
                        $this->session->setFlashdata('msg', 'Award Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $this->data['userdata']['login_id'];
                        $this->nominationTypesModel->update(array("id" => $id),$ins_data);
                        //update the nomination to end date to all users
                        updateAwardEndDate($id,$ins_data['end_date']);
                    }
                    else
                    {
                        $this->session->setFlashdata('msg', 'Award Added Successfully!');
                        $ins_data['created_date']  =  date("Y-m-d H:i:s");
                        $ins_data['created_id']    =  $this->data['userdata']['login_id'];
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
		            $editdata['procedure_document']   =  $edit_data['procedure_document'];
                    $editdata['event_document']   =  $edit_data['document'];
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
		            $editdata['procedure_document']          = ($this->request->getFile('procedure_document'))?$this->request->getFile('procedure_document'):'';
                    $editdata['event_document']          = ($this->request->getFile('event_document'))?$this->request->getFile('event_document'):'';

                    $editdata['status']               = ($this->request->getPost('status'))?$this->request->getPost('status'):'0';
                    $editdata['id']             = ($this->request->getPost('id'))?$this->request->getPost('id'):'';
                }
                       
            }       
       
            $this->data['editdata'] = $editdata;
            return render('admin/nomination/add',$this->data);
    }


    public function validation_rules()
    {

        $validation_rules = array();
        $validation_rules = array(
                                        "main_category_id" => array("label" => "Award",'rules' => 'required'),
                                        "category" => array("label" => "Award Type",'rules' => 'required'),
                                        "title" => array("label" => "Title",'rules' => 'required'),
                                        "subject" => array("label" => "Subject",'rules' => 'required'),
                                        "description" => array("label" => "Description",'rules' => 'required'),
                                        "start_date" => array("label" => "Start Date",'rules' => 'required'),
                                        "status" => array("label" => "Status",'rules' => 'required')
          );
    
        return $validation_rules;
      
    }

    public function delete($id='')
    {
        if (strtolower($this->request->getMethod()) == "post") {  
          $this->nominationTypesModel->delete(array("id" => $id));
          if($this->request->isAJAX()){
                return $this->response->setJSON([
                    'status'    => 'success',
                    'message'   => 'Award deleted Successfully'
                ]); 
            }
        }
        
    }

    public function getCategoryById($id='')
    {
        $categories = $this->categoryModel->getCategoryByMainCategoryID($id);
        $this->data['categories'] = $categories->getResultArray();
        $html = view('admin/nomination/award_type_list',$this->data,array('debug' => false));
            
        if($this->request->isAJAX()){
                return $this->response->setJSON([
                    'status' => 'success',
                    'html'   => $html
                ]); 
        }     
    }

    public function assigned_jury_lists($award_id = '')
    {
  
        $this->data['juries'] = $this->nominationTypesModel->getJuriesByAward($award_id)->getResultArray();

        if($this->request->isAJAX()) {
            $html = view('admin/nomination/juryLists',$this->data,array('debug' => false));
             return $this->response->setJSON([
                 'status'            => 'success',
                 'html'              => $html
             ]); 
             exit;
        }

    }

    public function remove_jury_from_award($id='')
    {
        $this->juryModel->delete(array("id" => $id));
        if($this->request->isAJAX()) {
             return $this->response->setJSON([
                 'status'            => 'success',
                 'message'           => "Unassigned Successfully"
             ]); 
             exit;
        }
    }

    public function extendNomination($id = '')
    {

            $id  = ($this->request->getPost('id'))?$this->request->getPost('id'):$id; 
                
            //$validation = $this->validate($this->extend_validation_rules());

            $getExtend  = $this->nominationTypesModel->getListsOfNominations($id);

            $editdata = array();

            if($getExtend->getRowArray() > 0)
              $editdata = $getExtend->getRowArray(); 

            if($this->validation) {

                if($this->request->getPost()){
                
                    $extend_date    = $this->request->getPost('extend_date');
                    
                    $ins_data = array();
                    
                    //get user data
                    $getExtendUserData  = $this->nominationTypesModel->getListsOfNominations($id)->getRowArray();
                    
                    if(!empty($id) && $getExtend->getRowArray() > 0){
                        $this->session->setFlashdata('msg', 'Nomination Extend Date Updated Successfully!');
                        $ins_data['updated_date']   =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']     =  $this->data['userdata']['id'];
                        $ins_data['end_date']       = date("Y-m-d",strtotime($extend_date));
                    
                        $this->nominationTypesModel->update(array("id" => $id),$ins_data);
                    }
                
                    extendNominationMailSend($id,$extend_date);

                    return redirect()->route('admin/nomination');
                }
            }

            if(!empty($editdata) && count($editdata)){
                $editdata['extend_date'] = (isset($editdata['extend_date']) && ($editdata['extend_date']!=''))?date("m/d/Y",strtotime($editdata['extend_date'])):date("m/d/Y");
                $editdata['id']          = $id;   
            }
            else
            {
                $editdata['extend_date'] = ($this->request->getPost('extend_date'))?date("m/d/Y",strtotime($this->request->getPost('extend_date'))):date("m/d/Y");
                $editdata['id']          = '';
            }
        
            $this->data['editdata'] = $editdata; 

            if($this->request->getPost())
            $this->data['validation'] = $this->validator;

            return render('admin/nomination/extend_nomination_date',$this->data);  
      } 
}
