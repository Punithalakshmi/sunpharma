<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;


class Workshops extends BaseController
{

    public function index()
    {
       
        $workshopLists = $this->workshopModel->getLists();

        $this->data['lists'] = $workshopLists;
        return render('admin/workshop/list',$this->data);
               
    }

    public function add($id='')
    {
       
        $this->data['eventTypes']  = $this->workshopModel->getEventTypes()->getResultArray();

         
            if(!empty($id)){
                $edit_data   = $this->workshopModel->getLists($id);
                $edit_data   = $edit_data->getRowArray();
            }
            
            if($this->request->getPost())
               $id  = $this->request->getPost('id');
               
            $this->validation = $this->validate($this->validation_rules());

            if($this->validation) {

                if($this->request->getPost()){
                
                    $category     = $this->request->getPost('category');
                    $subject      = $this->request->getPost('subject');
                    $title        = $this->request->getPost('title');
                    $description  = $this->request->getPost('description');
                    $start_date   = $this->request->getPost('start_date');
                    $end_date     = $this->request->getPost('end_date');
                //    $year         = $this->request->getPost('year');
                    $status       = $this->request->getPost('status');

                    $ins_data = array();
                    $ins_data['category']          = $category;
                    $ins_data['subject']           = $subject; 
                    $ins_data['description']       = $description;
                    $ins_data['title']             = $title;
                    $ins_data['start_date']        = date("Y-m-d",strtotime($start_date));
                    $ins_data['end_date']          = date("Y-m-d",strtotime($end_date));
                   // $ins_data['year']              = $year;
                    $ins_data['status']            = $status;
                    

                    if($this->request->getFile('event_document') != ''){
                        $fileUploadDir = 'uploads/events/';
                            
                        if(!file_exists($fileUploadDir) && !is_dir($fileUploadDir))
                        mkdir($fileUploadDir, 0777, true);
                        
                        //upload documents to respestive nominee folder
                        $event_document = $this->request->getFile('event_document');
                        $event_document->move($fileUploadDir);

                        $ins_data['document']  = $event_document->getClientName();
                    }

                    if($this->request->getFile('agenda') != ''){
                        $fileUploadDir = 'uploads/events/';
                            
                        if(!file_exists($fileUploadDir) && !is_dir($fileUploadDir))
                        mkdir($fileUploadDir, 0777, true);
                        
                        //upload documents to respestive nominee folder
                        $agenda = $this->request->getFile('agenda');
                        $agenda->move($fileUploadDir);

                        $ins_data['agenda']  = $agenda->getClientName();
                    }

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
                   
                   
                    if(!empty($id)){
                        $this->session->setFlashdata('msg', 'Event Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $this->data['userdata']['login_id'];
                        $this->workshopModel->update(array("id" => $id),$ins_data);
                    }
                    else
                    {
                        $this->session->setFlashdata('msg', 'Event Added Successfully!');
                        $ins_data['created_date']  =  date("Y-m-d H:i:s");
                        $ins_data['created_id']    =  $this->data['userdata']['login_id'];
                        $this->workshopModel->save($ins_data);
                    } 

                    return redirect()->route('admin/workshops');
                }
            }
            else
            {  
            
                if(!empty($edit_data) && count($edit_data)){
                    $editdata['title']               = $edit_data['title'];
                    $editdata['subject']               = $edit_data['subject'];
                    $editdata['description']           = $edit_data['description'];
                    $editdata['category']              = $edit_data['category'];
                  //  $editdata['year']                  = $edit_data['year'];
                    $editdata['start_date']            = date("m/d/Y",strtotime($edit_data['start_date']));
                    $editdata['end_date']              = date("m/d/Y",strtotime($edit_data['end_date']));
                    $editdata['event_document']        = $edit_data['document'];
                    $editdata['banner_image']          = $edit_data['banner_image'];
                    $editdata['thumb_image']           = $edit_data['thumb_image'];
                    $editdata['agenda']                = $edit_data['agenda'];
                    $editdata['status']                = $edit_data['status'];
                    $editdata['id']                    = $edit_data['id'];
                }
                else
                {
                    $editdata['title']                = ($this->request->getPost('title'))?$this->request->getPost('title'):'';
                    $editdata['subject']              = ($this->request->getPost('subject'))?$this->request->getPost('subject'):'';
                    $editdata['description']          = ($this->request->getPost('description'))?$this->request->getPost('description'):'';
                    $editdata['category']             = ($this->request->getPost('category'))?$this->request->getPost('category'):'';
                  //  $editdata['year']                 = ($this->request->getPost('year'))?$this->request->getPost('year'):date("Y");
                    $editdata['start_date']           = ($this->request->getPost('start_date'))?$this->request->getPost('start_date'):date("m/d/Y");
                    $editdata['end_date']             = ($this->request->getPost('end_date'))?$this->request->getPost('end_date'):date("m/d/Y");
                    $editdata['event_document']       = ($this->request->getFile('event_document'))?$this->request->getFile('event_document'):'';
                    $editdata['banner_image']         = ($this->request->getFile('banner_image'))?$this->request->getFile('banner_image'):'';
                    $editdata['thumb_image']          = ($this->request->getFile('thumb_image'))?$this->request->getFile('thumb_image'):'';
                    $editdata['agenda']               = ($this->request->getFile('agenda'))?$this->request->getFile('agenda'):'';
                    $editdata['status']               = ($this->request->getPost('status'))?$this->request->getPost('status'):'';
                    $editdata['id']                   = ($this->request->getPost('id'))?$this->request->getPost('id'):'';
                }

                  if($this->request->getPost())
                     $this->data['validation'] = $this->validator;

                    $this->data['editdata'] = $editdata;
                    return render('admin/workshop/event',$this->data);
                        
            }       
        
    }


    public function validation_rules()
    {

        $this->validation_rules = array();
        $this->validation_rules = array(   "subject" => array("label" => "Subject",'rules' => 'required'),
                                           "description" => array("label" => "Description",'rules' => 'required')
                                );
    
        return $this->validation_rules;
      
    }

    public function delete($id='')
    {
        if (strtolower($this->request->getMethod()) == "post") {  

           
                $this->workshopModel->delete(array("id" => $id));
                if($this->request->isAJAX()){
                    
                    return $this->response->setJSON([
                        'status'            => 'success',
                        'message'              => 'Event deleted Successfully'
                    ]); 
                }
         
       }
       
    }
}
