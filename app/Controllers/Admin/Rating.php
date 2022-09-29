<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\RatingModel;

class Rating extends BaseController
{

    public function add($id='',$nominee_id='')
    {
        helper(array('form', 'url'));

        $session = \Config\Services::session();
        $userdata  = $session->get('userdata');
    
        $request    = \Config\Services::request();
        $validation = \Config\Services::validation();
        
        $data['userdata'] = $userdata;
        $ratingModel = new RatingModel();

        if(is_array($userdata) && count($userdata)):
           
            if($request->getPost())
               $id  = $request->getPost('id');

               $edit_data = $ratingModel->getLists($id);   
               $edit_data = $edit_data->getRowArray();
             
               $validation = $this->validate($this->validation_rules());

            if($validation) {

                if($request->getPost()){
                
                    $rating        = $request->getPost('rating');
                    $comments      = $request->getPost('comments');
                   
                    $ins_data = array();
                    $ins_data['rating']     = $rating;
                    $ins_data['comments']   = $comments;
                    
                    if(!empty($id)){
                        $session->setFlashdata('msg', 'Rating Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $userdata['login_id'];
                        $ratingModel->update(array("id" => $id),$ins_data);
                    }
                   
                    $nominee_id = $request->getPost('nominee_id');
                    return redirect()->to('admin/nominee/view/'.$nominee_id);
                }
            }
            else
            {  
            
                if(!empty($edit_data) && count($edit_data)){
                    $editdata['rating']     = $edit_data['rating'];
                    $editdata['comments']   = $edit_data['comments'];
                    $editdata['id']         = $edit_data['id'];
                    $editdata['nominee_id'] = $edit_data['nominee_id'];
                }

                  if($request->getPost())
                    $data['validation'] = $this->validator;


                    $data['editdata'] = $editdata;
                    return view('_partials/header',$data)
                        .view('admin/rating/add',$data)
                        .view('_partials/footer');
            }       
        else:
            return redirect()->route('admin/login');
        endif; 


    }


    public function validation_rules()
    {

        $validation_rules = array();
        $validation_rules = array(
                                        "rating" => array("label" => "Rating",'rules' => 'required')
        );
    
        return $validation_rules;
      
    }

    public function delete($id='',$nominee_id='')
    {
        $ratingModel = new ratingModel();
        $session = \Config\Services::session();

        $userdata  = $session->get('userdata'); 
        $data['userdata'] = $userdata;

        if(is_array($userdata) && count($userdata)):

          $ratingModel->delete(array("id" => $id));
          return redirect()->to('admin/nominee/view/'.$nominee_id);
        else:
            return redirect()->route('admin/login');
        endif;
    }
}
