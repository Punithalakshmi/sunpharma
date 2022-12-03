<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Rating extends BaseController
{

    public function add($id='',$nominee_id='')
    {
        
           
            if($this->request->getPost())
               $id  = $this->request->getPost('id');

               $edit_data = $this->ratingModel->getLists($id);   
               $edit_data = $edit_data->getRowArray();
             
               $this->validation = $this->validate($this->validation_rules());

            if($this->validation) {

                if($this->request->getPost()){
                
                    $rating        = $this->request->getPost('rating');
                    $comments      = $this->request->getPost('comments');
                   
                    $ins_data = array();
                    $ins_data['rating']     = $rating;
                    $ins_data['comments']   = $comments;
                    
                    if(!empty($id)){
                        $this->session->setFlashdata('msg', 'Rating Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $userdata['login_id'];
                        $this->ratingModel->update(array("id" => $id),$ins_data);
                    }
                   
                    $nominee_id = $this->request->getPost('nominee_id');
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

                    if($this->request->getPost())
                        $this->data['validation'] = $this->validator;


                    $this->data['editdata'] = $editdata;
                    
                    return render('admin/rating/add',$this->data);
                        
            }       
        


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
        
       
          $this->ratingModel->delete(array("id" => $id));
          return redirect()->to('admin/nominee/view/'.$nominee_id);
       
    }
}
