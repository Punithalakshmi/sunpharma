<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AwardsModel;
use App\Models\CategoryModel;
use App\Models\UserModel;

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

            $category      = ($request->getPost('category'))?$request->getPost('category'):2;
            $year          = ($request->getPost('year'))?$request->getPost('year'):date('Y');

            //get categories lists
            $data['categories']   = $categoryModel->getListsOfCategories();
           //$data['categories'] = $getCategoryLists->getResultArray();

            $awardsLists = $awardsModel->getLists($category,$year)->getResultArray();
            
            foreach($awardsLists as $akey => $avalue) {

                //get jury lists 
                $splitJuryIds = explode(',',$avalue['jury']);

                for($i=0;$i<count($splitJuryIds);$i++) {
                    $getJuryRateData = $userModel->getJuryRateData($splitJuryIds[$i])->getRowArray();
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

    

}
