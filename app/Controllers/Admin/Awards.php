<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AwardsModel;
use App\Models\CategoryModel;
use App\Models\UserModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Awards extends BaseController
{

    public function index()
    {
        helper(array('form', 'url'));

        $view = \Config\Services::renderer();

        $session    = \Config\Services::session();
        $request    = \Config\Services::request();
        $validation = \Config\Services::validation();

        $userdata      = $session->get('userdata');
        $awardsModel   = new AwardsModel();
        $categoryModel = new CategoryModel();
        $userModel     = new UserModel();
       
        $data['userdata'] = $userdata;
       
        if(is_array($userdata) && count($userdata)):

            $category      = ($request->getPost('category'))?$request->getPost('category'):'';
            $year          = ($request->getPost('year'))?$request->getPost('year'):date('Y');

            //get categories lists
            $data['categories']   = $categoryModel->getListsOfCategories();
           //$data['categories'] = $getCategoryLists->getResultArray();

            $awardsLists = $awardsModel->getLists($category,$year)->getResultArray();
            //print_r($awardsLists); die;
            foreach($awardsLists as $akey => $avalue) {

                //get jury lists 
                $splitJuryIds = explode(',',$avalue['jury']);
               
                
                for($i=0;$i<count($splitJuryIds);$i++) {
                    
                    $getJuryRateData = $userModel->getJuryRateData($splitJuryIds[$i],$avalue['id'])->getRowArray();
                    $awardsLists[$akey]['juries'][$i]=$getJuryRateData;
                }
            }

            $data['lists'] = $awardsLists;

             if($request->isAJAX()) {
                   $html = view('admin/awards/filter',$data,array('debug' => false));
                    return $this->response->setJSON([
                        'status'            => 'success',
                        'data'              => $html
                    ]); 
                    exit;
             }
             else
             {
                return view('_partials/header',$data)
                    .view('admin/awards/list',$data)
                    .view('_partials/footer');
            }    
        else:
            return redirect()->route('admin/login');
        endif;        
    }


    public function export()
    {

        $response    = \Config\Services::response();
        $request     = \Config\Services::request();

        $userModel   = new UserModel();
        $awardsModel = new AwardsModel();
         
        $category    = ($request->getPost('category'))?$request->getPost('category'):'';
        $year        = ($request->getPost('year'))?$request->getPost('year'):date('Y');
 
        
        $fileName = 'AwardResult_'.date('d-m-Y').'.xlsx';  

        $awardsLists = $awardsModel->getLists($category,$year)->getResultArray();
            
        foreach($awardsLists as $akey => $avalue) {
            //get jury lists 
            $splitJuryIds = explode(',',$avalue['jury']);
            for($i=0;$i<count($splitJuryIds);$i++) {
                $getJuryRateData = $userModel->getJuryRateData($splitJuryIds[$i],$avalue['id'])->getRowArray();
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
        if($request->isAJAX()) {
             return $this->response->setJSON([
                 'status'            => 'success',
                 'filename'              => $fileDownload
             ]); 
             exit;
        }
        
    }

    

}
