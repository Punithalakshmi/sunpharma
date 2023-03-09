<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AwardsModel;
use App\Models\CategoryModel;
use App\Models\UserModel;
use App\Models\RatingModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Winners extends BaseController
{

    public function lists()
    {
        
            $filter = array();
         
            $filter['year']    = '';
            $filter['type']       = '';
            $filter['award']      = '';
            $filter['start']      = '0';
            $filter['limit']      = '10';
            $filter['orderField'] = 'id';
            $filter['orderBy']    = 'desc';
            $totalRecords  = $this->winnersModel->getTotalWinners();
            
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
                    $year                 = $dtpostData['year'];
                    $type                 = $dtpostData['type'];
                    $award                 = $dtpostData['award'];
                    $filter['year']      = $year;
                    $filter['award']    = $award;
                    $filter['type']       = $type;
                    $filter['start']      =  $start;
                    $filter['limit']       = $rowperpage;
                    $filter['orderField']  = $columnName;
                    $filter['orderBy']     = $columnSortOrder;

                    $winnerLists = $this->winnersModel->getWinnersByFilter($filter)->getResultArray();
                
                    $filter['totalRows'] = 'yes';
                
                    $totalRecordsWithFilterCt = $this->winnersModel->getWinnersByFilter($filter);
                
                    $totalRecordsWithFilter = (!empty($year) || !empty($type) || !empty($award))?$totalRecordsWithFilterCt:$totalRecords;
                
               }

            }
            else
            {    
                $winnerLists = $this->winnersModel->getWinnersByFilter($filter)->getResultArray();
                $totalRecordsWithFilter = count($winnerLists);
            }

            $this->data['lists'] = $winnerLists;
            
            $data = array();
            foreach($winnerLists as $ukey => $uvalue){
                
                $data[] = array(
                                'name' => $uvalue['name'],
                                'main_category' => $uvalue['main_category'],
                                'category' => $uvalue['category'],
                                'photo' => $uvalue['photo'],
                                'designation' => $uvalue['designation'],
                                'year' => $uvalue['year'],
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
                return render('admin/winners/list',$this->data);
            } 
    }


    public function export()
    {

        if (strtolower($this->request->getMethod()) == "post") {  
   
                    $category    = ($this->request->getPost('category'))?$this->request->getPost('category'):'';
                    $year        = ($this->request->getPost('year'))?$this->request->getPost('year'):date('Y');
            
                    $fileName = 'AwardResult_'.date('d-m-Y').'.xlsx';  

                    $awardsLists = $this->awardsModel->getLists($category,$year)->getResultArray();

                    $awardsLists = getAwardsArr($awardsLists);
                        
                    foreach($awardsLists as $akey => $avalue) {
                        //get jury lists 
                        $splitJuryIds = explode(',',$avalue['jury']);
                        for($i=0;$i<count($splitJuryIds);$i++) {
                            $getJuryRateData = $this->userModel->getJuryRateData($splitJuryIds[$i],$avalue['id'])->getRowArray();
                            $awardsLists[$akey]['juries'][$i]=$getJuryRateData;
                        }
                    }

                    $spreadsheet = new Spreadsheet();
            
                    $sheet = $spreadsheet->getActiveSheet();
                    $sheet->setCellValue('A1', 'Award Category');
                    $sheet->setCellValue('B1', 'Nominee Name');
                    $sheet->setCellValue('C1', 'Nomination No');
                    $sheet->setCellValue('D1', 'Date of Birth');
                    $sheet->setCellValue('E1', 'Rating');

                    $sheet->getStyle('A1:E1')->getFont()->setBold(true);
                    $sheet->getStyle('A1:E1')->getFont()->setSize(16);

                    $rows = 2;
            
                    foreach ($awardsLists as $val){
                        $sheet->setCellValue('A' . $rows, $val['category_name']);
                        $sheet->setCellValue('B' . $rows, $val['firstname']);
                        $sheet->setCellValue('C' . $rows, date("Y")."/".$val['id']);
                        $sheet->setCellValue('D' . $rows, $val['dob']);
                        $sheet->setCellValue('E' . $rows, $val['average_rating']);
                        $rows++;
                        if(is_array($val['juries']) && count($val['juries']) > 0){
                            $start = 'A'.$rows;
                            $end   = 'E'.$rows;
                                $sheet->setCellValue($start,'Jury Info');
                                $sheet->getStyle($start.":".$end)->getFont()->setBold(true);
                                $sheet->getStyle($start.":".$end)->getFont()->setSize(16);
                                $sheet->mergeCells($start.":".$end);
                            $rows++;
                                $sheet->setCellValue('A'.$rows, 'Jury Name');
                                $sheet->mergeCells('A'.$rows.":".'B'.$rows);
                                $sheet->setCellValue('C'.$rows, 'Rating');
                                $sheet->mergeCells('C'.$rows.":".'E'.$rows);
                                $sheet->getStyle('A'.$rows,'B'.$rows)->getFont()->setBold(true);
                                $sheet->getStyle('A'.$rows,'B'.$rows)->getFont()->setSize(14);
                                $sheet->getStyle('C'.$rows,'E'.$rows)->getFont()->setBold(true);
                                $sheet->getStyle('C'.$rows,'E'.$rows)->getFont()->setSize(14);
                            $rows++;
                            foreach($val['juries'] as $ukey => $uvalue){
                                $sheet->setCellValue('A'.$rows, $uvalue['firstname'].' '.$uvalue['lastname']);
                                $sheet->mergeCells('A'.$rows.":".'B'.$rows);
                                $sheet->setCellValue('C'.$rows, $uvalue['rating']);
                                $sheet->mergeCells('C'.$rows.":".'E'.$rows);
                                $rows++;
                            }
                        }
                        
                    } 
                    $writer = new Xlsx($spreadsheet);
                    $writer->save("uploads/".$fileName);
                    $fileDownload = base_url().'/uploads/'.$fileName;
                    header("Content-Type: application/vnd.ms-excel");

                    if($this->request->isAJAX()) {
                        return $this->response->setJSON([
                            'status'            => 'success',
                            'filename'              => $fileDownload
                        ]); 
                        exit;
                    }
            }
        
    }

 

    public function add($id = '')
    {

        $this->data['categories']     = $this->categoryModel->getListsOfCategories()->getResultArray();

        $this->data['main_categories'] = $this->awardsCategoryModel->getListsOfCategories();

        $id    = ($this->request->getPost('id'))?$this->request->getPost('id'):$id;

        if(!empty($id)){
            $getUserData =  $this->winnersModel->getWinner($id);
            $edit_data   = $getUserData->getRowArray();
        }
   
        if (strtolower($this->request->getMethod()) == "post") {  

            $this->validation->setRules($this->validation_rules());
     
            if(!$this->validation->withRequest($this->request)->run()) {
                $this->data['validation'] = $this->validation;
            }
            else
            { 
                $name          = $this->request->getPost('name');
                $bio           = $this->request->getPost('bio');
                $address       = $this->request->getPost('address');
                $designation   = $this->request->getPost('designation');
                $main_category = $this->request->getPost('main_category_id');
                $category      = $this->request->getPost('category');
                $year          = $this->request->getPost('year');
                $status        = $this->request->getPost('status');

                $id            = $this->request->getPost('id');
    
                $ins_data = array();
                $ins_data['name']             = $name;
                $ins_data['bio']              = $bio;
                $ins_data['address']          = $address;
                $ins_data['designation']      = $designation;
               // $ins_data['winner_photo']     = $winner_photo;
                $ins_data['main_category_id'] = $main_category;
                $ins_data['category_id']         = $category;
                $ins_data['year']             = $year;
                $ins_data['status']             = $status;

                $fileUploadDir = 'uploads/winners/';

                if(!file_exists($fileUploadDir) && !is_dir($fileUploadDir))
                   mkdir($fileUploadDir, 0777, true);

                if($this->request->getFile('winner_photo')!='') {
                    $winner_photo = $this->request->getFile('winner_photo');
                    $winner_photo->move($fileUploadDir);
                    $ins_data['photo'] = $winner_photo->getClientName();
                }
                            
            // echo $id; die;
                if(!empty($id)){
                    $this->session->setFlashdata('msg', 'Winners Updated Successfully!');
                    $ins_data['photo'] = (!empty($ins_data['photo']))?$ins_data['photo']:$edit_data['photo'];
                    $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                    $ins_data['updated_id']    =  $this->data['userdata']['login_id'];
                    $this->winnersModel->update(array("id" => $id),$ins_data);
                }
                else
                {
                    $this->session->setFlashdata('msg', 'Winners Added Successfully!');
                    $ins_data['created_date']  =  date("Y-m-d H:i:s");
                    $ins_data['created_id']    =  $this->data['userdata']['login_id'];
                    $this->winnersModel->save($ins_data);
                }
                return redirect()->to('admin/winners');
            }
        }
         
        if(!empty($edit_data) && count($edit_data)){
            $editdata['category']           = $edit_data['category_id'];
            $editdata['main_category_id']   = $edit_data['main_category_id'];
            $editdata['name']               = $edit_data['name'];
            $editdata['designation']        = $edit_data['designation'];
            $editdata['year']               = $edit_data['year'];
            $editdata['bio']                = $edit_data['bio'];
            $editdata['address']            = $edit_data['address'];
            $editdata['winner_photo']       = $edit_data['photo'];
            $editdata['status']             = $edit_data['status'];
            $editdata['id']                 = $edit_data['id'];
        }
        else
        {
            $editdata['category']          = ($this->request->getPost('category'))?$this->request->getPost('category'):'';
            $editdata['main_category_id']     = ($this->request->getPost('main_category_id'))?$this->request->getPost('main_category_id'):'';
            $editdata['name']                 = ($this->request->getPost('name'))?$this->request->getPost('name'):'';
            $editdata['designation']          = ($this->request->getPost('designation'))?$this->request->getPost('designation'):'';
            $editdata['year']                 = ($this->request->getPost('year'))?$this->request->getPost('year'):'';
            //$editdata['year']                 = ($this->request->getPost('year'))?$this->request->getPost('year'):date("Y");
            $editdata['bio']                  = ($this->request->getPost('bio'))?$this->request->getPost('bio'):"";
            $editdata['address']              = ($this->request->getPost('address'))?$this->request->getPost('address'):"";
            $editdata['winner_photo']         = ($this->request->getFile('winner_photo'))?$this->request->getFile('winner_photo'):'';
            //$editdata['thumb_image']          = ($this->request->getFile('thumb_image'))?$this->request->getFile('thumb_image'):'';
            $editdata['status']               = ($this->request->getPost('status'))?$this->request->getPost('status'):'0';
            $editdata['id']                   = ($this->request->getPost('id'))?$this->request->getPost('id'):'';
        }

        $this->data['editdata'] = $editdata;
        return render('admin/winners/add',$this->data);
                    
    }

    public function validation_rules()
    {
        $validation_rules = array();
        $validation_rules = array(
                                    "category" => array("label" => "Award Type",'rules' => 'required'),
                                    "main_category_id" => array("label" => "Award",'rules' => 'required'),
                                    "name" => array("label" => "Winner Name",'rules' => 'required'),
                                    "bio" => array("label" => "Bio",'rules' => 'required'),
                                    "designation" => array("label" => "Designation",'rules' => 'required'),
                                    "address" => array("label" => "Address",'rules' => 'required'),
                                    "status" => array("label" => "Status",'rules' => 'required'),
                                );
        return $validation_rules;
    }

    public function delete($id='',$nominee_id='')
    {
        if (strtolower($this->request->getMethod()) == "post") {  
            if($this->request->isAJAX()){
                $this->winnersModel->delete(array("id" => $id));
                return $this->response->setJSON([
                    'status'            => 'success',
                    'message'           => 'Winners deleted Successfully'
                ]); 
            }
        }
    }

}
