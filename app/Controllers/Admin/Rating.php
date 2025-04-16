<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Rating extends BaseController
{

    public function add($id='',$nominee_id='')
    {
        
        if (strtolower($this->request->getMethod()) == "post") {  

            $this->validation->setRules($this->validation_rules());

            if(!$this->validation->withRequest($this->request)->run()) {
                $this->data['validation'] = $this->validation;
            }
            else
            { 
                $rating        = $this->request->getPost('rating');
                $comments      = $this->request->getPost('comments');
               
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
                                    "rating" => array("label" => "Rating",'rules' => 'required|numeric|less_than[100]'),
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
