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


            $category      = ($this->request->getPost('category'))?$this->request->getPost('category'):'';
            $year          = ($this->request->getPost('year'))?$this->request->getPost('year'):date('Y');

            //get categories lists
            $this->data['categories']   = $this->categoryModel->getListsOfCategories();
           //$this->data['categories'] = $getCategoryLists->getResultArray();

            $awardsLists = $this->awardsModel->getLists($category,$year)->getResultArray();
           // echo "<pre>";
           // print_r($awardsLists); die;
            foreach($awardsLists as $akey => $avalue) {

                //get jury lists 
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

   
        $category    = ($this->request->getPost('category'))?$this->request->getPost('category'):'';
        $year        = ($this->request->getPost('year'))?$this->request->getPost('year'):date('Y');
 
        
        $fileName = 'AwardResult_'.date('d-m-Y').'.xlsx';  

        $awardsLists = $this->awardsModel->getLists($category,$year)->getResultArray();
            
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

}
