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

        $path =  $_SERVER['DOCUMENT_ROOT'];
        $category          = ($this->request->getPost('category'))?$this->request->getPost('category'):'';
        $main_category_id  = ($this->request->getPost('main_category_id'))?$this->request->getPost('main_category_id'):'1';
       // die;
        $fileName = 'Evaluation Sheet '.date('d-m-Y').'.xlsx';  

        $awardsLists = $this->awardsModel->getLists($category,$main_category_id)->getResultArray();

        //get Active Jury Lists
        $activeJuries = $this->userModel->getAllActiveJuryLists()->getResultArray();
        
        $juryData = array();
        $awardsDataArr = array();
        $nomineeData = array();
        $i = 0;
        foreach($awardsLists as $akey => $avalue) {
            if($avalue['main_category_id']){
                $awardsDataArr[$avalue['category_name']][$i]['nomination_no'] = $avalue['registration_no'];
                $awardsDataArr[$avalue['category_name']][$i]['firstname']     = $avalue['firstname'];
                $awardsDataArr[$avalue['category_name']][$i]['juries'] = [];

                foreach($activeJuries as $jkey=>$jvalue){
                    $getJuryRateData = $this->userModel->getJuryRateData($jvalue['id'],$avalue['id'])->getRowArray();
                    $juryData['firstname'] = $jvalue['firstname'];
                    $juryData['username']  = $jvalue['username'];
                    $juryData['rating']    = (isset($getJuryRateData['rating']))?$getJuryRateData['rating']:0;
                        $awardsDataArr[$avalue['category_name']][$i]['juries'][] = $juryData;
                }
                $i++;
            }                       
        }

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        
        $typeOfAward = ($main_category_id == 1)?'Research Awards':'Science Scholar Awards';

        $title = $typeOfAward.' Evaluation Sheet '.date('Y');
        
        $sheet->setTitle('Report - '.$typeOfAward.' '.date('Y'));

        $sheet->setCellValue('A1',$title);
        $sheet->getStyle("A1:I1")->getFont()->setBold(true);
        $sheet->getStyle("A1:I1")->getFont()->setSize(12);
        $sheet->mergeCells("A1:I1");
        
        $sheet->setCellValue('A2', 'Award Category');
        $sheet->setCellValue('B2', 'Nomination No');
        $sheet->setCellValue('C2', 'Applicant Name');
        $juriesName = array();
        for($j=0;$j<count($activeJuries);$j++){
            $juriesName[] = $activeJuries[$j]['firstname'].''.$activeJuries[$j]['lastname'].'['.$activeJuries[$j]['username'].']';
        }
        $juriesName[] = 'Total Amount'; 
        $sheet->fromArray($juriesName,null,'D2');
        
        $sheet->getStyle(2)->getFont()->setBold(true);
        $sheet->getStyle(2)->getFont()->setSize(11);
        
        $rows = 3;
        
        ksort($awardsDataArr);
        foreach ($awardsDataArr as $val => $dt){
            //echo $val;
            foreach($dt as $v => $ard){
            
                $sheet->setCellValue('A' . $rows, $val);
                $sheet->setCellValue('B' . $rows, $ard['nomination_no']);
                $sheet->setCellValue('C' . $rows, $ard['firstname']);
                $totalRating = 0;
                $juryRatings = [];
                foreach($ard['juries'] as $ukey => $uvalue){
                    $totalRating += $uvalue['rating'];
                    $juryRatings[] = $uvalue['rating'];
                }
                $juryRatings[] = $totalRating;
                $column = 'D'.$rows;
                $sheet->fromArray($juryRatings,null,$column);
                $rows++;   
            }
        } 

        $writer = new Xlsx($spreadsheet);
        $writer->save('uploads/'.$fileName);
        $fileDownload = base_url().'/uploads/'.$fileName;
        header('Cache-Control: max-age=0');

        if($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'   => 'success',
                'filename' => $fileDownload
            ]); 
            exit;
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
