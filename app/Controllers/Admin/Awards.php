<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AwardsModel;
use App\Models\CategoryModel;
use App\Models\UserModel;
use App\Models\RatingModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Awards extends BaseController
{

    public function index()
    {
    
        $view = \Config\Services::renderer();


        $category = '';
        $main_category_id = '';
        if (strtolower($this->request->getMethod()) == "post") {  
            
            $category      = ($this->request->getPost('category'))?$this->request->getPost('category'):'';
            $main_category_id    = ($this->request->getPost('main_category_id'))?$this->request->getPost('main_category_id'):'';
        }

            //get categories lists
            $this->data['categories']   = $this->categoryModel->getListsOfCategories()->getResultArray();
              
            $this->data['main_categories'] = $this->awardsCategoryModel->getListsOfCategories();

            $awardsLists = $this->awardsModel->getLists($category,$main_category_id)->getResultArray();
           
            $awardsLists = getAwardsArr($awardsLists);
            foreach($awardsLists as $akey => $avalue) {

                $splitJuryIds = explode(',',$avalue['jury']);
               
                for($i=0;$i<count($splitJuryIds);$i++) {
                    
                    $getJuryRateData = $this->userModel->getJuryRateData($splitJuryIds[$i],$avalue['id'])->getRowArray();
                    $awardsLists[$akey]['juries'][$i]=$getJuryRateData;
                }
            }

            $this->data['lists'] = $awardsLists;

             if($this->request->isAJAX()) {
                   $html = view('admin/awards/filter',$this->data,array('debug' => false));
                    return $this->response->setJSON([
                        'status'            => 'success',
                        'data'              => $html
                    ]); 
                    exit;
             }
             else
             {
                return render('admin/awards/list',$this->data);
             }    
           
    }


    public function export()
    {

        if (strtolower($this->request->getMethod()) == "post") {  

          //  if($this->validation->withRequest($this->request)->run()) {
   
                    $category          = ($this->request->getPost('category'))?$this->request->getPost('category'):'';
                    $main_category_id  = ($this->request->getPost('main_category_id'))?$this->request->getPost('main_category_id'):1;
            
                    
                    $fileName = 'AwardResult_'.date('d-m-Y').'.xlsx';  

                    $awardsLists = $this->awardsModel->getLists($category,$main_category_id)->getResultArray();

                    $awardsLists = getAwardsArr($awardsLists);

                    
                    foreach($awardsLists as $akey => $avalue) {
                        //get jury lists 
                        $splitJuryIds = explode(',',$avalue.['jury']);
                        
                        for($i=0;$i<count($splitJuryIds);$i++) {
                            $getJuryRateData = $this->userModel->getJuryRateData($splitJuryIds[$i],$avalue['id'])->getRowArray();
                            $awardsLists[$akey]['juries'][$i] =$getJuryRateData;
                        }
                    }

                    $spreadsheet = new Spreadsheet();
            
                    $sheet = $spreadsheet->getActiveSheet();
                    $sheet->setCellValue('A1', 'Award Category');
                    $sheet->setCellValue('B1', 'Nomination No');
                    $sheet->setCellValue('C1', 'Applicant Name');
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
              //  }   
            }
        
    }

    
    public function getJuryListsByNominee($nominee_id = '')
    {
  
        $this->data['juries'] = $this->ratingModel->getRatingByJury($nominee_id)->getResultArray();

        if($this->request->isAJAX()) {
            $html = view('admin/awards/juryLists',$this->data,array('debug' => false));
             return $this->response->setJSON([
                 'status'            => 'success',
                 'html'              => $html
             ]); 
             exit;
        }

    }

    public function posting_winners($id = '')
    {
         
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
                $winner_photo  = $this->request->getPost('winner_photo');
                $main_category = $this->request->getPost('main_category_id');
                $category      = $this->request->getPost('category');
                $yeat          = $this->request->getPost('year');
    
    
                $ins_data = array();
                $ins_data['rating']     = $rating;
                $ins_data['comments']   = $comments;
                $ins_data['is_rate_submitted']   = 1;

                if(!empty($id)){
                    $this->session->setFlashdata('msg', 'Rating Updated Successfully!');
                    $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                    $ins_data['updated_id']    =  $this->data['userdata']['login_id'];
                    $this->ratingModel->update(array("id" => $id),$ins_data);
                }
                
                $nominee_id = $this->request->getPost('nominee_id');
                return redirect()->to('admin/nominee/view/'.$nominee_id);
            }
        }
        else
        {  

            $edit_data = $this->ratingModel->getLists($id);   
            $edit_data = $edit_data->getRowArray(); 
        
            if(!empty($edit_data) && count($edit_data)){
                $editdata['rating']     = $edit_data['rating'];
                $editdata['comments']   = $edit_data['comments'];
                $editdata['id']         = $edit_data['id'];
                $editdata['nominee_id'] = $edit_data['nominee_id'];
            }

            
            $this->data['editdata'] = $editdata;
            
            return render('admin/rating/add',$this->data);
                    
        }       
        
    }

    public function validation_rules()
    {
        $validation_rules = array();
        $validation_rules = array(
                                    "rating" => array("label" => "Rating",'rules' => 'required|numeric|is_natural_no_zero|less_than[100]|greater_than[0]'),
                                    "comments" => array("label" => "Comment",'rules' => 'required')
                                );
        return $validation_rules;
    }

    public function delete($id='',$nominee_id='')
    {
    
          $this->ratingModel->delete(array("id" => $id));
          return redirect()->to('admin/nominee/view/'.$nominee_id);
       
    }

}
