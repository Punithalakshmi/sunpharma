<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class EventRegisteration extends BaseController
{

    public function index()
    {
            
             
            $filter = array();
            $filter['title']      = '';
            $filter['email']      = '';
            $filter['phone']      = '';
            $filter['mode']       = '';
            $filter['start']      = '0';
            $filter['limit']      = '10';
            $filter['orderField'] = 'id';
            $filter['orderBy']    = 'desc';
            $totalRecords  = $this->registerationModel->CountAll();
            
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
                    $title      = $dtpostData['title'];
                    $email      = $dtpostData['email'];
                 //   $start_date = $dtpostData['start_date'];
                    $phone      = $dtpostData['phone'];
                    $mode      = $dtpostData['mode'];
                    
                    $filter['title']       = $title;
                    $filter['email']       = $email;
                  //  $filter['start_date']  = $start_date;
                    $filter['phone']       = $phone;
                    $filter['mode']        = $mode;
                    $filter['limit']       = $rowperpage;
                    $filter['orderField']  = $columnName;
                    $filter['orderBy']     = $columnSortOrder;
    
                    $workshopLists = $this->registerationModel->getRegisterationByFilter($filter)->getResultArray();
                   
                    $filter['totalRows'] = 'yes';
                   
                    $totalRecordsWithFilterCt = $this->registerationModel->getRegisterationByFilter($filter);
                   
                    $totalRecordsWithFilter = (!empty($role) || !empty($category))?$totalRecordsWithFilterCt:$totalRecords;
                
              }
    
            }
            else
            {    
    
                $workshopLists = $this->registerationModel->getRegisterationByFilter($filter)->getResultArray();
                
                $totalRecordsWithFilter = count($workshopLists);
            }
    
           
            $this->data['lists'] = $workshopLists;
            
            $data = array();
            foreach($workshopLists as $ukey => $uvalue){
                
                    $data[] = array('title' => $uvalue['title'],
                                    'created_date' => $uvalue['created_date'],
                                    'registeration_no' => $uvalue['registeration_no'],
                                    'firstname' => $uvalue['firstname'],
                                    'lastname' => $uvalue['lastname'],
                                    'email' => $uvalue['email'],
                                    'phone' => $uvalue['phone'],
                                    'address' => $uvalue['address'],
                                    'mode' => $uvalue['mode'],
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
                return render('admin/event_registeration/list',$this->data);
              }
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
               
            $this->validation = $this->validate($this->validation_rules($id));

            $this->data['event_categories']  = $this->workshopModel->getEventTypes()->getResultArray();

            if($this->validation) {

                if($this->request->getPost()){
                
                    $firstname         = $this->request->getPost('firstname');
                    $lastname          = $this->request->getPost('lastname');
                    $email             = $this->request->getPost('email');
                    $phone             = $this->request->getPost('phone');
                    $address           = $this->request->getPost('address');
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
                        $ins_data['updated_id']    =  $this->data['userdata']['login_id'];
                        $this->registerationModel->update(array("id" => $id),$ins_data);
                    }
                    else
                    {
                        $this->session->setFlashdata('msg', 'Registeration Added Successfully!');
                        $ins_data['created_date']  =  date("Y-m-d H:i:s");
                        $ins_data['created_id']    =  $this->data['userdata']['login_id'];
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
                    //    $editdata['event_type']              = $edit_data['event_type'];
                        $editdata['registeration_no']      = (!empty($edit_data['registeration_no']))?$edit_data['registeration_no']:'SPSFN-REG-'.$id;
                        $editdata['id']                      = $edit_data['id'];
                    }
                    else
                    {
                        $editdata['firstname']                = ($this->request->getPost('firstname'))?$this->request->getPost('firstname'):'';
                        $editdata['lastname']                 = ($this->request->getPost('lastname'))?$this->request->getPost('lastname'):'';
                        $editdata['email']                    = ($this->request->getPost('email'))?$this->request->getPost('email'):'';
                        $editdata['phone']             = ($this->request->getPost('phone'))?$this->request->getPost('phone'):'';
                        $editdata['address']             = ($this->request->getPost('address'))?$this->request->getPost('address'):'';
                        $editdata['registeration_no']             = ($this->request->getPost('registeration_no'))?$this->request->getPost('registeration_no'):$registerationNo;
                        $editdata['id']                   = ($this->request->getPost('id'))?$this->request->getPost('id'):'';
                     //   $editdata['event_type']                   = ($this->request->getPost('event_type'))?$this->request->getPost('event_type'):'';
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
        $this->validation_rules = array(       "firstname" => array("label" => "Firstname",'rules' => 'required'),
                                                "lastname" => array("label" => "Lastname",'rules' => 'required'),
                                                "phone" => array("label" => "Phone",'rules' => 'required'),
                                                "email" => array("label" => "Email",'rules' => 'required|valid_email|is_unique[event_registerations.email,id,'.$id.']')
                                );
    
        return $this->validation_rules;
      
    }

    public function delete($id='')
    {
      
        if (strtolower($this->request->getMethod()) == "post") {  
          $this->registerationModel->delete(array("id" => $id));
          if($this->request->isAJAX()){         
            return $this->response->setJSON([
                'status'            => 'success',
                'message'           => 'Registration deleted Successfully'
            ]); 
         }
      }
       
    }

    public function bulkEmails()
    {
        
    }

    public function export()
    {

        if (strtolower($this->request->getMethod()) == "post") {  


               $dtpostData = $this->request->getPost();
    

                // Custom filter
                $title      = $dtpostData['title'];
                $email      = $dtpostData['email'];
            //   $start_date = $dtpostData['start_date'];
                $phone      = $dtpostData['phone'];
                $mode       = $dtpostData['mode'];

                    $filter = array();
                    $filter['title']      = $title;
                    $filter['email']      = $email;
                    $filter['phone']      = $phone;
                    $filter['mode']       = $mode;
                    $fileName = 'Registration_Lists_'.date('d-m-Y').'.xlsx';  

                    $awardsLists = $this->registerationModel->getRegisterationByFilter($filter)->getResultArray();
                    $spreadsheet = new Spreadsheet();
            
                    $sheet = $spreadsheet->getActiveSheet();
                    $sheet->setCellValue('A1', 'Event Title');
                    $sheet->setCellValue('B1', 'Registration Date');
                    $sheet->setCellValue('C1', 'Registration No');
                    $sheet->setCellValue('D1', 'Firstname');
                    $sheet->setCellValue('E1', 'Lastname');
                    $sheet->setCellValue('F1', 'Email');
                    $sheet->setCellValue('G1', 'Phone Number');
                    $sheet->setCellValue('H1', 'Address');
                    $sheet->setCellValue('I1', 'Participation Mode');


                    $sheet->getStyle('A1:I1')->getFont()->setBold(true);
                    $sheet->getStyle('A1:I1')->getFont()->setSize(16);

                    $rows = 2;
            
                    foreach ($awardsLists as $val){
                        $sheet->setCellValue('A' . $rows, $val['title']);
                        $sheet->setCellValue('B' . $rows, $val['created_date']);
                        $sheet->setCellValue('C' . $rows, $val['registeration_no']);
                        $sheet->setCellValue('D' . $rows, $val['firstname']);
                        $sheet->setCellValue('E' . $rows, $val['lastname']);
                        $sheet->setCellValue('F' . $rows, $val['email']);
                        $sheet->setCellValue('G' . $rows, $val['phone']);
                        $sheet->setCellValue('H' . $rows, $val['address']);
                        $sheet->setCellValue('I' . $rows, $val['mode']);
                        $rows++;  
                    } 
                    $writer = new Xlsx($spreadsheet);
                    $writer->save("uploads/".$fileName);
                    $fileDownload = base_url().'/uploads/'.$fileName;
                    header("Content-Type: application/vnd.ms-excel");

                    if($this->request->isAJAX()) {
                        return $this->response->setJSON([
                            'status'            => 'success',
                            'filename'              => $fileDownload,
                            'message' => 'Exported Successfully'
                        ]); 
                        exit;
                    }
                
            }
        
    }
}
