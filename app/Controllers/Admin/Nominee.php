<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Nominee extends BaseController
{

    public function index()
    {
        

            $userLists = $this->nomineeModel->getListsOfNominees();
            $lists     = $userLists->getResultArray();

            $current_date = date("Y-m-d");

            foreach($lists as $k => $user){
             
                $getNominationEndDate = $nomineeTypesModel->getCategoryNomination($user['category']);
               
                $lists[$k]['nomination_end_date'] = '';

                $isExpiredNomination =  isNominationExpired($user['extend_date']);

                $lists[$k]['is_expired_nomination'] = ($isExpiredNomination)?'yes':'no';
                
 
            }

            $this->data['lists'] = $lists;
            $juryLists = array();
            $juryLists  = $this->nomineeModel->getJuryLists()->getResultArray();

            if(count($juryLists) > 0)
                 $this->data['juryLists'] = $juryLists;
                 

            return render('admin/nominee/list',$this->data);
              
       
    }

    public function getApproval($id = '')
    {
       
            $id = ($this->request->getPost('id'))?$this->request->getPost('id'):$id;
            
            $getUserData  = $this->nomineeModel->getNomineeInfo($id);
            
            $this->data['user'] = $getUserData->getRowArray();
           // print_r($getUserData); die;
            $this->data['editdata'] = $this->data;
            return render('admin/nominee/nominee_view',$this->data);
               

         
    }

    public function approve()
    {

            $id     = $this->request->getPost('id');
            $type   = $this->request->getPost('type');

            $up_data = array();
            $up_data['updated_date']  =  date("Y-m-d H:i:s");
            $up_data['updated_id']    =  $this->data['userdata']['login_id'];

            $getUserData  = $this->userModel->getListsOfUsers($id);
            $getUserData  = $getUserData->getRowArray();

           // $email = \Config\Services::email();

          //  $email->setFrom('punitha@izaaptech.in', 'Punithalakshmi');
          //  $email->setTo($getUserData['email']);
          
         //   $email->setSubject('Your Application Approval Status');
            $subject = 'Nomination Application Status - Sunpharma Science Foundation';
            $login_url = base_url().'/login';
            $message = '';
            if($type == 'approve') {
                $msg = 'Approved Successfully';

                $pass = $this->generatePassword(8);

                $message  = 'Your Application has been approved. Please use below credentials to login and submit the other application details. <br /> <br />';
                $message .= 'Please <a href="'.$login_url.'" target="_blank">Click Here</a> to Sign-In';
                $message .= 'Username: '.strtolower($getUserData['firstname']).'<br /><br />';
                $message .= 'Password: '.$pass.'<br /><br /><br /><br />'; 

                $up_data['status']  = 'Approved';
                $up_data['active']  = 1;
                $up_data['password'] = md5($pass);
                $up_data['username'] = strtolower($getUserData['firstname']);
                $up_data['original_password'] = $pass;
                $this->userModel->update(array("id" => $getUserData['id']),$up_data);
            }
            else
            {
                $up_data['status']  = 'Disapproved';
                $up_data['active']  = 0;
                $up_data['is_rejected'] = 1;
                $msg = 'Rejected Successfully';
                $message .= 'Your Application has been rejected';
            }
            $this->userModel->update(array("id" => $id),$up_data);
            $message .= 'Thanks & Regards,<br/>';
            $message .= 'Sunpharma Science Foundation Team';
           //$email->setMessage($message);

            $header  = '';
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";

            $this->data['content'] = $message;
            $html = view('email/mail',$this->data,array('debug' => false));
           // mail($getUserData['email'],$subject,$html,$header);
            
            $status = '';
            if(mail($getUserData['email'],$subject,$html,$header)){
                $status = 'success';
                $message = $msg;
            }
            else
            {
                $status = 'error';
                $this->data = $email->printDebugger(['headers']);
                $message = $this->data;
            }
        
            if($this->request->isAJAX()){
                echo json_encode(array('status' => $status,'message' => $message));
                exit;
            }

        
    }


    public function nominee_lists_of_jury()
    {
        $nomineeLists  = $this->userModel->getListsNominations();
        $this->data['lists'] = $nomineeLists->getResultArray();
        
        return render('admin/nominee/nominee_lists_of_jury',$this->data);         
    }
    
    
    public function view($nominee_id = '')
    {
      

        $nominee_id = ($this->request->getPost('nominee_id'))?$this->request->getPost('nominee_id'):$nominee_id;

        $id = ($this->request->getPost('id'))?$this->request->getPost('id'):'';
        
        $getUserData  = $this->userModel->getUserData($nominee_id);
        $this->data['user'] = $getUserData->getRowArray();

   
        //get nominee category
        if(isset($data['user']['category_id'])) {
    //    $getNomineeCategory = $categoryModel->getListsOfCategories($data['user']['category_id'])->getRowArray();
        $data['user']['category_name'] =  $this->data['user']['category_name'];
        }
    
        $edit_data  = $this->ratingModel->getRatingData($this->data['userdata']['login_id'],$nominee_id)->getRowArray();
        $this->validation = $this->validate($this->validation_rules());

        $average_rating   = $this->ratingModel->getNomineeAverageRating($nominee_id)->getRowArray();

        $this->data['average_rating'] = $average_rating['avg_rating'];

        $this->data['ratings'] = $this->ratingModel->getRatingByJury($nominee_id)->getResultArray();

            if($this->validation) {

                if($this->request->getPost()){
                  
                    $category = '';

                    $rating     = $this->request->getPost('rating');
                    $comment    = $this->request->getPost('comment');
                 
                    $ins_data = array();
                    $ins_data['rating']       = $rating;
                    $ins_data['comments']     = $comment;
                    $ins_data['jury_id']      = $this->data['userdata']['login_id'];
                    $ins_data['nominee_id']   = $nominee_id;
                    $ins_data['is_rate_submitted'] = ($this->request->getPost('submit') && ($this->request->getPost('submit') == 'Save Draft'))?0:1; 
                    
                   
                    $this->session->setFlashdata('msg', 'Rated Successfully!');
                    $ins_data['created_date']  =  date("Y-m-d H:i:s");
                    $ins_data['created_id']    =  $this->data['userdata']['login_id'];
                    $ratingModel->save($ins_data);
                     

                    return redirect()->to('admin/nominee/view/'.$nominee_id)->withInput();
                }
            }
            else
            {  

                if(!empty($edit_data) && count($edit_data)){
                    $editdata['rating']    = $edit_data['rating'];
                    $editdata['comment']   = $edit_data['comments'];
                    $editdata['id']        =  $edit_data['id'];
                    $editdata['is_rate_submitted']  =  $edit_data['is_rate_submitted'];
                }
                else
                {
                    $editdata['rating']      = ($this->request->getPost('rating'))?$this->request->getPost('rating'):'';
                    $editdata['comment']     = ($this->request->getPost('comment'))?$this->request->getPost('comment'):'';
                    $editdata['id']          = ($this->request->getPost('id'))?$this->request->getPost('id'):'';
                    $editdata['is_rate_submitted'] = '0';
                }
            } 
            
            if($this->request->getPost())
               $this->data['validation'] = $this->validator;

            $this->data['editdata'] = $editdata;
            return  render('admin/nominee/view',$this->data);
                    
    }


    public function assignJury()
    {
        

            $juryID       = $this->request->getPost('juryID');
            $nomineeArr   = $this->request->getPost('nominee');
     
            $ins_data = array();
            $ins_data['jury_id'] = $juryID;
            $ins_data['created_date'] = date("Y-m-d H:i:s");
            $ins_data['created_id']   = $this->data['userdata']['login_id'];
           foreach($nomineeArr as $nominee){

              $getAssignedJuryLists = $this->juryModel->checkIfAlreadyNominee($juryID,$nominee);
               
              if(!is_array($getAssignedJuryLists)){
                $ins_data['nominee_id'] = $nominee;
                $getUserData = $this->juryModel->insert($ins_data);
              }
           }

           echo json_encode(array('status' => 'success','message' => 'Jury Assigned Successfully!'));
           exit;
           
    }


    public function validation_rules()
    {

        $this->validation_rules = array();

        $this->validation_rules = array(
                                        "rating" => array("label" => "Rating",'rules' => 'required|numeric|is_natural_no_zero'),
                                        "comment" => array("label" => "Comment",'rules' => 'required')
        );
    
        return $this->validation_rules;
      
    }
 
    public function generatePassword($n) {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
        }

        return $randomString;
    }
 

    public function extend($id = '')
    {

        $id  = ($request->getPost('id'))?$request->getPost('id'):$id;
               
        $validation = $this->validate($this->extend_validation_rules());

        $getExtend  = $this->userModel->getUserData($id);

        if($getExtend->getRowArray() > 0)
          $edit_data = $getExtend->getRowArray(); 

        $this->data['editdata'] = $edit_data; 

        if($getExtend->getRowArray() > 0)
            $edit_data = $getExtend->getRowArray();

        if($this->validation) {

            if($this->request->getPost()){
            
                    $extend_date    = $request->getPost('extend_date');
                    
                    $ins_data = array();
                    $ins_data['extend_date']   = date("Y-m-d",strtotime($extend_date));
                 
                    //get user data
                    $getExtendUserData  = $userModel->getListsOfUsers($id)->getRowArray();
                   
                    if(!empty($id) && $getExtend->getRowArray() > 0){
                        $session->setFlashdata('msg', 'Nomination Extend Date Updated Successfully!');
                        $ins_data['updated_date']   =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']     =  $userdata['login_id'];
                        $userModel->update(array("id" => $id),$ins_data);
                    }
                
                    $this->extendMailNotification($getExtendUserData['email'],$extend_date);

                    return redirect()->route('admin/nominee');
            }
        }
        else
        {  

            if(!empty($edit_data) && count($edit_data)){
                $editdata['extend_date'] = $edit_data['extend_date'];
                $editdata['id']          = $id;
            }
            
            if($this->request->getPost())
            $this->data['validation'] = $this->validator;

           return render('admin/nomination/extend',$this->data);  
                     
        }       
    
    }


    public function extend_validation_rules()
    {

        $this->validation_rules = array();

        $this->validation_rules = array(
                                        "extend_date" => array("label" => "Extend",'rules' => 'required')                           
        );
    
        return $this->validation_rules;
      
    }

    public function extendMailNotification($mail,$extend_date)
    {
        $header  = '';
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        $subject = " Extend Nomination Date - Sunpharma Science Foundation ";
        $message  = "Hi, ";
        $message .= '<br/><br/>';
        $message .= "Nomination date has been changed up to ".$extend_date." Please login and upload your documents.";
        $message .= "<br/>";
    
        $message .= "<br/>";
     
        $this->data['content'] = $message;
        $html = view('email/mail',$this->data,array('debug' => false));

        mail($mail,$subject,$html,$header);
    }

}
