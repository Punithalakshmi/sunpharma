<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NomineeModel;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\JuryModel;
use App\Models\RatingModel;
use App\Models\CategoryModel;
use App\Models\ExtendModel;
use App\Models\NominationTypesModel;

class Nominee extends BaseController
{

    public function index()
    {
        $session = \Config\Services::session();

        $userdata  = $session->get('userdata');
        $nomineeModel = new NomineeModel();
        $nomineeTypesModel = new NominationTypesModel();
        
        $data['userdata'] = $userdata;
       
        if(is_array($userdata) && count($userdata)):

            $userLists = $nomineeModel->getListsOfNominees();
            $lists     = $userLists->getResultArray();

            $current_date = date("Y-m-d");

            foreach($lists as $k => $user){
               $userLists  = $nomineeModel->getJuryName($user['jury_id']);
               $juryName   =  $userLists->getRowArray();
            
                $getNominationEndDate = $nomineeTypesModel->getCategoryNomination($user['category']);
               
                $lists[$k]['nomination_end_date'] = '';

                
                $nominationEndDate = '';
                if($getNominationEndDate->getRowArray() > 0) {  
                    $getNominationEndDate = $getNominationEndDate->getRowArray();
                    $nominationEndDate = $getNominationEndDate['end_date'];
                    $lists[$k]['nomination_end_date']  = $nominationEndDate;
                }     

                $lists[$k]['is_expired_nomination'] = 'no';
                if(strtotime($current_date) > strtotime($nominationEndDate))
                   $lists[$k]['is_expired_nomination']  = 'yes';  
                

                if(isset($juryName['firstname']) && isset($juryName['lastname']))
                    $lists[$k]['assigned_jury'] = $juryName['firstname'].' '.$juryName['lastname'];
                else
                    $lists[$k]['assigned_jury']  = ' - ';  
            }

            $data['lists'] = $lists;
            $juryLists = array();
            $juryLists  = $nomineeModel->getJuryLists()->getResultArray();

            if(count($juryLists) > 0)
                 $data['juryLists'] = $juryLists;
                 

            return view('_partials/header',$data)
                .view('admin/nominee/list',$data)
                .view('_partials/footer');
        else:
            return redirect()->route('admin/login');
        endif;        
    }

    public function getApproval($id = '')
    {
        $session = \Config\Services::session();
        $request = \Config\Services::request();

        $userdata  = $session->get('userdata');
        $nomineeModel = new NomineeModel();
        
        $data['userdata'] = $userdata;
       
        if(is_array($userdata) && count($userdata)):

            $id = ($request->getPost('id'))?$request->getPost('id'):$id;
            
            $getUserData  = $nomineeModel->getNomineeInfo($id);
            
            $data['user'] = $getUserData->getRowArray();
           // print_r($getUserData); die;
            $data['editdata'] = $data;
            return view('_partials/header',$data)
                .view('admin/nominee/nominee_view',$data)
                .view('_partials/footer');

        else:
            return redirect()->route('admin/login');
        endif;   
    }

    public function approve()
    {

        $session = \Config\Services::session();
        $request = \Config\Services::request();

        $userdata  = $session->get('userdata');
        $userModel = new userModel();
        
        $data['userdata'] = $userdata;
       
        if(is_array($userdata) && count($userdata)):

            $id     = $request->getPost('id');
            $type   = $request->getPost('type');

            $up_data = array();

            $up_data['updated_date']  =  date("Y-m-d H:i:s");
            $up_data['updated_id']    =  $userdata['login_id'];

            $getUserData  = $userModel->getListsOfUsers($id);
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
                $userModel->update(array("id" => $getUserData['id']),$up_data);
            }
            else
            {
                $up_data['status']  = 'Disapproved';
                $up_data['active']  = 0;
                $up_data['is_rejected'] = 1;
                $msg = 'Rejected Successfully';
                $message .= 'Your Application has been rejected';
            }
            $userModel->update(array("id" => $id),$up_data);
            $message .= 'Thanks & Regards,<br/>';
            $message .= 'Sunpharma Science Foundation Team';
           //$email->setMessage($message);

            $header  = '';
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";

            $data['content'] = $message;
            $html = view('email/mail',$data,array('debug' => false));
           // mail($getUserData['email'],$subject,$html,$header);
            
            $status = '';
            if(mail($getUserData['email'],$subject,$html,$header)){
                $status = 'success';
                $message = $msg;
            }
            else
            {
                $status = 'error';
                $data = $email->printDebugger(['headers']);
                $message = $data;
            }
        
            if($this->request->isAJAX()){
                echo json_encode(array('status' => $status,'message' => $message));
                exit;
            }

        else
            return redirect()->route('admin/login');
        endif;


    }


    public function nominee_lists_of_jury()
    {
        $session = \Config\Services::session();

        $userdata  = $session->get('userdata');
        $nomineeModel = new NomineeModel();
        
        $data['userdata'] = $userdata;
       
        if(is_array($userdata) && count($userdata)):

            $userModel     = new UserModel();
            $nomineeLists  = $userModel->getListsNominations();
            $data['lists'] = $nomineeLists->getResultArray();
           
            return view('_partials/header',$data)
                .view('admin/nominee/nominee_lists_of_jury',$data)
                .view('_partials/footer');
        else:
            return redirect()->route('admin/login');
        endif;

    }
    
    
    public function view($nominee_id = '')
    {
        helper(array('form', 'url'));

        $session    = \Config\Services::session();
        $request    = \Config\Services::request();
        $validation = \Config\Services::validation();

        $userdata  = $session->get('userdata');

        $nominee_id = ($request->getPost('nominee_id'))?$request->getPost('nominee_id'):$nominee_id;

        $id = ($request->getPost('id'))?$request->getPost('id'):'';
        
        $userModel      = new UserModel();
        $ratingModel    = new RatingModel();
        $nomineeModel   = new NomineeModel();
        $categoryModel  = new CategoryModel();

        $getUserData  = $userModel->getUserData($nominee_id);
        $data['user'] = $getUserData->getRowArray();

     // print_r($data['user']); die;
        //get nominee category
        if(isset($data['user']['category_id'])) {
    //    $getNomineeCategory = $categoryModel->getListsOfCategories($data['user']['category_id'])->getRowArray();
        $data['user']['category_name'] =  $data['user']['category_name'];
        }
    
        $edit_data  = $ratingModel->getRatingData($userdata['login_id'],$nominee_id)->getRowArray();
        $validation = $this->validate($this->validation_rules());

        $data['userdata'] = $userdata;
        $average_rating   = $ratingModel->getNomineeAverageRating($nominee_id)->getRowArray();

        $data['average_rating'] = $average_rating['avg_rating'];

        $data['ratings'] = $ratingModel->getRatingByJury($nominee_id)->getResultArray();

        if(is_array($userdata) && count($userdata)):

            if($validation) {

                if($request->getPost()){
                  
                    $category = '';

                    $rating     = $request->getPost('rating');
                    $comment    = $request->getPost('comment');
                 
                    $ins_data = array();
                    $ins_data['rating']       = $rating;
                    $ins_data['comments']     = $comment;
                    $ins_data['jury_id']      = $userdata['login_id'];
                    $ins_data['nominee_id']   = $nominee_id;
                    $ins_data['is_rate_submitted'] = ($request->getPost('submit') && ($request->getPost('submit') == 'Save Draft'))?0:1; 
                    
                   
                    $session->setFlashdata('msg', 'Rated Successfully!');
                    $ins_data['created_date']  =  date("Y-m-d H:i:s");
                    $ins_data['created_id']    =  $userdata['login_id'];
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
                    $editdata['rating']      = ($request->getPost('rating'))?$request->getPost('rating'):'';
                    $editdata['comment']     = ($request->getPost('comment'))?$request->getPost('comment'):'';
                    $editdata['id']          = ($request->getPost('id'))?$request->getPost('id'):'';
                    $editdata['is_rate_submitted'] = '0';
                }
            } 
            
            if($request->getPost())
               $data['validation'] = $this->validator;

            $data['editdata'] = $editdata;
            return   view('_partials/header',$data)
                    .view('admin/nominee/view',$data)
                    .view('_partials/footer');
        else:
            return redirect()->route('admin/login');
        endif;

    }


    public function assignJury()
    {
        $session = \Config\Services::session();
        $request = \Config\Services::request();

        $userdata  = $session->get('userdata');
        
        $data['userdata'] = $userdata;
       
        if(is_array($userdata) && count($userdata)):

            $juryModel = new JuryModel();

            $juryID       = $request->getPost('juryID');
            $nomineeArr   = $request->getPost('nominee');
     
            $ins_data = array();
            $ins_data['jury_id'] = $juryID;
            $ins_data['created_date'] = date("Y-m-d H:i:s");
            $ins_data['created_id']   = $userdata['login_id'];
           foreach($nomineeArr as $nominee){

              $getAssignedJuryLists = $juryModel->checkIfAlreadyNominee($juryID,$nominee);
               
              if(!is_array($getAssignedJuryLists)){
                $ins_data['nominee_id'] = $nominee;
                $getUserData = $juryModel->insert($ins_data);
              }
           }

           echo json_encode(array('status' => 'success','message' => 'Jury Assigned Successfully!'));
           exit;
           
        else:
            return redirect()->route('admin/login');
        endif;
    }


    public function ratings()
    {
        
    }

    public function validation_rules()
    {

        $validation_rules = array();

        $validation_rules = array(
                                        "rating" => array("label" => "Rating",'rules' => 'required'),
                                        "comment" => array("label" => "Comment",'rules' => 'required')
        );
    
        return $validation_rules;
      
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

        $userdata  = $this->session->get('userdata');
        $extendModel = new ExtendModel();
        $userModel = new userModel();

        helper(array('form', 'url'));

        $session = \Config\Services::session();
        $userdata  = $session->get('userdata');
    
        $request    = \Config\Services::request();
        $validation = \Config\Services::validation();
        
        $data['userdata'] = $userdata;
        
        if(is_array($userdata) && count($userdata)):
           
            if($request->getPost())
               $id  = $request->getPost('id');
               
            $validation = $this->validate($this->extend_validation_rules());

            $getExtend  = $extendModel->getListsOfExtends($id);

            if($getExtend->getRowArray() > 0)
             $edit_data = $getExtend->getRowArray();

            if($validation) {

                if($request->getPost()){
                
                    $extend_date    = $request->getPost('extend_date');
                    
                    $ins_data = array();
                    $ins_data['extend_date']   = date("Y-m-d",strtotime($extend_date));
                    $ins_data['user_id']      = $id;
                    

                    //get user data
                    $getExtendUserData  = $userModel->getListsOfUsers($id)->getRowArray();
                   
                    if(!empty($id) && $getExtend->getRowArray() > 0){
                        $session->setFlashdata('msg', 'Nomination Extend Date Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $userdata['login_id'];
                        $extendModel->update(array("id" => $id),$ins_data);
                    }
                    else
                    {
                        $session->setFlashdata('msg', 'Nomination Extend Date Updated Successfully!');
                        $ins_data['created_date']  =  date("Y-m-d H:i:s");
                        $ins_data['created_id']    =  $userdata['login_id'];
                        $extendModel->save($ins_data);
                    } 

                    $this->extendMailNotification($getExtendUserData['email'],$extend_date);

                    return redirect()->route('admin/nominee');
                }
            }
            else
            {  

                if(!empty($edit_data) && count($edit_data)){
                    $editdata['extend_date'] = date("m/d/Y",strtotime($edit_data['extend_date']));
                    $editdata['id']         = $edit_data['id'];
                }
                else
                {
                   
                    $editdata['extend_date']     = ($request->getPost('extend_date'))?$request->getPost('extend_date'):date("m/d/Y");
                    $editdata['id']              = ($request->getPost('id'))?$request->getPost('id'):$id;
                }

                  if($request->getPost())
                    $data['validation'] = $this->validator;


                    $data['editdata'] = $editdata;
                    return view('_partials/header',$data)
                        .view('admin/nomination/extend',$data)
                        .view('_partials/footer');
            }       
        else:
            return redirect()->route('admin/login');
        endif; 

    }


    public function extend_validation_rules()
    {

        $validation_rules = array();

        $validation_rules = array(
                                        "extend_date" => array("label" => "Extend",'rules' => 'required')                           
        );
    
        return $validation_rules;
      
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
     
        $data['content'] = $message;
        $html = view('email/mail',$data,array('debug' => false));

        mail($mail,$subject,$html,$header);
    }

}
