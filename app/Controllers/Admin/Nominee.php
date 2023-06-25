<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Nominee extends BaseController
{

    public function index()
    {
        
            $current_date = date("Y-m-d");

            $filter = array();
            $filter['firstname']  = '';
            $filter['email']      = '';
            $filter['title']      = '';
            $filter['status']     = '';
            $filter['start']      = '0';
            $filter['limit']      = '10';
            $filter['orderField'] = 'id';
            $filter['orderBy']    = 'desc';
            $filter['award']      = '';

            $totalRecords  = $this->nomineeModel->getNomineeLists();

            $nominationTypeLists = $this->nominationTypesModel->getListsOfNominations()->getResultArray();
            $this->data['awardsLists'] = $nominationTypeLists;

            $this->data['main_categories'] = $this->awardsCategoryModel->getListsOfCategories();
        
        if (strtolower($this->request->getMethod()) == "post") { 

            if(!$this->validation->withRequest($this->request)->run()) {

                $dtpostData = $this->request->getPost('data');

                $response = array();
    
                $draw            = $dtpostData['draw'];
                $start           = $dtpostData['start'];
                $rowperpage      = $dtpostData['length']; // Rows display per page
                $columnIndex     = (isset($dtpostData['order'][0]['column']) && !empty($dtpostData['order'][0]['column']))?$dtpostData['order'][0]['column']:0; // Column index
                $columnName      = $dtpostData['columns'][$columnIndex]['data']; // Column name
                $columnSortOrder = (isset($dtpostData['order'][0]['dir']) && !empty($dtpostData['order'][0]['dir']))?$dtpostData['order'][0]['dir']:'asc'; // asc or desc
                $searchValue     = $dtpostData['search']['value']; // Search value

                 //Custom filter
                $award_title= $dtpostData['award_title'];
                $firstname  = $dtpostData['firstname'];
                $email      = $dtpostData['email'];
                $year       = $dtpostData['year'];
                $award      = $dtpostData['main_category_id'];
                
                $filter['title']      = $award_title;
                $filter['award']      = $award;
                $filter['firstname']  = $firstname;
                $filter['email']      = $email;
                $filter['year']       = $year;
                $filter['start']      = $start;
                $filter['limit']      = $rowperpage;
                $filter['orderField'] = $columnName;
                $filter['orderBy']    = $columnSortOrder;

                $lists = $this->nomineeModel->getNomineeListsByCustomFilter($filter)->getResultArray();
            
                $filter['totalRows'] = 'yes';

                $totalRecordsWithFilterCt = $this->nomineeModel->getNomineeListsByCustomFilter($filter);
                $totalRecordsWithFilter = (!empty($award_title) || !empty($status) || !empty($firstname) || !empty($email))?$totalRecordsWithFilterCt:$totalRecords;
            
          }

        }
        else
        {    
            $lists = $this->nomineeModel->getNomineeListsByCustomFilter($filter)->getResultArray();
            $totalRecordsWithFilter = count($lists);
        }

         $data = array();
         foreach($lists as $k => $user){
             
            $getNominationEndDate = $this->nominationTypesModel->getCategoryNomination($user['category']);
           
            $lists[$k]['nomination_end_date'] = '';

            $isExpiredNomination =  isNominationExpired($user['extend_date']);

            $lists[$k]['is_expired_nomination'] = ($isExpiredNomination)?'yes':'no';
            
            if($user['status']=='Approved'){
                $status = "Approved";
              }
              else if($user['is_rejected'] == 1){
                $status = "Rejected";
              }
              else
              {
                $status = "Pending";
              }

             $data[] = array('registration_no' => $user['registration_no'],
                            'main_category_name' => $user['main_category_name'],
                            'category_name' => $user['category_name'],
                            'title' => $user['title'],
                            'firstname' => $user['firstname'],
                            'username' => $user['username'],
                            'email' => $user['email'],
                            'phone' => $user['phone'],
                            'status' => $user['status'],
                            'created_date' => $user['created_date'],
                            'is_expired' => ($isExpiredNomination)?'yes':'no',
                            'active' => $user['active'],
                            'status' => $status,
                            'is_rejected' => $user['is_rejected'],
                            'id' => $user['id'],
                            'status_from_db' => $user['status'],
                            'action' => ''
                        );
         }

        $this->data['lists'] = $lists;
        $juryLists  = array();
        $juryLists  = $this->nomineeModel->getJuryLists()->getResultArray();

        if(count($juryLists) > 0)
            $this->data['juryLists'] = $juryLists;

        if($this->request->isAJAX()) {
            $html = view('admin/nominee/list',$this->data,array('debug' => false));
            $end  = $filter['start'] + $filter['limit'];
                return $this->response->setJSON(array(
                                        'status' => 'success',
                                        'data'  => $data,
                                        'token' => csrf_hash(),
                                        "draw" => intval($draw),
                                        "iTotalRecords" => $totalRecords,
                                        "start" => $filter['start'],
                                        "end" => $end,
                                        "length" => $filter['limit'],
                                        "page" => $draw,
                                        "iTotalDisplayRecords" => $totalRecordsWithFilter
                                    )); 
                exit;
          }
          else
          {
            return render('admin/nominee/list',$this->data);
          }          
            
           
    }

    public function getApproval($id = '')
    {
            $id = ($this->request->getPost('id'))?$this->request->getPost('id'):$id;
            $getUserData  = $this->nomineeModel->getNomineeInfo($id);
            $this->data['user'] = $getUserData->getRowArray();
            $this->data['editdata'] = $this->data;
            return render('admin/nominee/nominee_view',$this->data);          
    }

    public function approve()
    {

            $id        = $this->request->getPost('id');
            $type      = $this->request->getPost('type');
            $remarks   = $this->request->getPost('remarks');

            $up_data = array();
            $up_data['updated_date']  =  date("Y-m-d H:i:s");
            $up_data['updated_id']    =  $this->data['userdata']['id'];

            $getUserData  = $this->userModel->getListsOfUsers($id);
            $getUserData  = $getUserData->getRowArray();

            $getUserNominationNo = $this->nominationModel->getNominationData($id)->getRowArray();

            $subject = 'Nomination Application Status - Sunpharma Science Foundation';
            $login_url = base_url().'/login';
            $message = 'Hi,';
            $pass = $this->generatePassword(8);
            $randUser = str_replace("."," ",$getUserData['firstname']);
            $randUser = str_replace(" ","",$randUser);
            $randUser = substr($randUser,0,6);
            if($type == 'approve') {
                $msg = 'Approved Successfully';
                $message .= '<br/><br/>';
                $message .= 'Nomination No:'.$getUserNominationNo['registration_no'].'. Your Application has been approved. Please sign-in with the following credentials to complete the application submission. <br /> <br />';
                $message .= 'Please <a href="'.$login_url.'" target="_blank">Click Here</a> to Sign-In <br />';
                $message .= '<b>Username: </b>'.strtolower($randUser).'<br />';
                $message .= '<b>Password: </b>'.$pass.'<br /><br />';
               
                $up_data['status']  = 'Approved';
                $up_data['active']  = 1;
                $up_data['password'] = md5($pass);
                $up_data['username'] = $randUser;
                $up_data['original_password'] = $pass;
                
               // $this->userModel->update(array("id" => $getUserData['id']),$up_data);
            }
            else
            {
                $up_data['status']  = 'Disapproved';
                $up_data['active']  = 0;
                $up_data['is_rejected'] = 1;
                $msg = 'Rejected Successfully';
                $message .= 'Nomination No:'.$getUserNominationNo['registration_no'].'. Your Application has been rejected. Please resubmit the application. <br/><br/>';
            }

            $message .= '<b>Remarks:</b> '.$remarks.'<br/><br/>';

            $message .= '<b>A quick guide with instructions to complete the application is attached in this email for your reference.</b>';

          
            $up_data['remarks'] = $remarks;

            $this->userModel->update(array("id" => $id),$up_data);

            $message .= 'Thanks & Regards,<br/>';
            $message .= 'Sunpharma Science Foundation Team';

            $attachmentFile = 'uploads/Steps to fill the personalized application.pdf';
            
            $isMailSent = sendMail($getUserData['email'],$subject,$message,$attachmentFile);
           
            $status = '';
            if($isMailSent){
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

        $jury_id = $this->data['userdata']['id'];
        $nomineeLists  = $this->userModel->getListsNominations($jury_id);
        $lists         = $nomineeLists->getResultArray();

        foreach($lists as $lkey => $lvalue){
            $reviewStatus = $this->ratingModel->getRatingData($jury_id,$lvalue['id'])->getRowArray();
             
            if(is_array($reviewStatus) && count($reviewStatus) > 0){
                $lists[$lkey]['review_status'] = (isset($reviewStatus['is_rate_submitted']) && ($reviewStatus['is_rate_submitted'] == 0))?'Draft Review':'Reviewed';
            }
            else
            {
                $lists[$lkey]['review_status'] = 'Pending';
            }
        }
        
        $this->data['lists'] = $lists;
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
          //$getNomineeCategory = $categoryModel->getListsOfCategories($data['user']['category_id'])->getRowArray();
          $data['user']['category_name'] =  $this->data['user']['category_name'];
        }
    
        $edit_data  = $this->ratingModel->getRatingData($this->data['userdata']['id'],$nominee_id)->getRowArray();

        $userID = $this->data['userdata']['id'];
        $role   = $this->data['userdata']['role'];
        
        $average_rating   = $this->ratingModel->getNomineeAverageRating($nominee_id,$userID,$role)->getRowArray();

        $this->data['average_rating'] = (isset($average_rating['avg_rating']) && !empty($average_rating['avg_rating']))?$average_rating['avg_rating']:0;

        $jury_id = '';
        if($this->data['userdata']['role'] == 1){
            $jury_id = $this->data['userdata']['id'];
        }

        $rateList = ($this->data['userdata']['role'] == 3)?'yes':'no';

        $this->data['ratings'] = $this->ratingModel->getRatingByJury($nominee_id,$jury_id,$rateList)->getResultArray();

        if (strtolower($this->request->getMethod()) == "post") {  
                
            $this->validation->setRules($this->validation_rules());
            
               if(!$this->validation->withRequest($this->request)->run()) {
                   $this->data['validation'] = $this->validation;
                   $status = 'error';
                   $message = 'Please check form fields!';
               }
               else
               { 
                  
                    $category = '';

                    $rating     = $this->request->getPost('rating');
                    $comment    = $this->request->getPost('comment');
                 
                    $ins_data = array();
                    $ins_data['rating']            = $rating;
                    $ins_data['comments']          = $comment;
                    $ins_data['jury_id']           = $this->data['userdata']['id'];
                    $ins_data['nominee_id']        = $nominee_id;
                    $ins_data['is_rate_submitted'] = ($this->request->getPost('submit') && ($this->request->getPost('submit') == 'Save Draft'))?0:1; 
                    
                    $this->session->setFlashdata('msg', 'Rated Successfully!');
                    $ins_data['created_date']  =  date("Y-m-d H:i:s");
                    $ins_data['created_id']    =  $this->data['userdata']['id'];
                    $this->ratingModel->save($ins_data);
                     
                    //update nominee status
                    $up_data = array();
                    $up_data['review_status'] = ($this->request->getPost('submit') && ($this->request->getPost('submit') == 'Save Draft'))?'Draft Review':'Reviewed';
                    $this->userModel->update(array('id' => $nominee_id),$up_data);
                   
                    // return redirect()->to('admin/nominee/view/'.$nominee_id)->withInput();
                    $status = 'success';
                    $message = 'Rated Successfully';

                    if($this->request->isAJAX()){
                        
                        $editdata['rating']    = (isset($edit_data['rating']) && !empty($edit_data['rating']))?$edit_data['rating']:'';
                        $editdata['comment']   = (isset($edit_data['comments']) && !empty($edit_data['comments']))?$edit_data['comments']:'';
                        $editdata['id']        =  (isset($edit_data['id']) && !empty($edit_data['id']))?$edit_data['id']:'';
                        $editdata['is_rate_submitted']  =  (isset($edit_data['is_rate_submitted']) && !empty($edit_data['is_rate_submitted']))?$edit_data['is_rate_submitted']:'0';

                        $this->data['editdata'] = $editdata;
                        
                        $html = view('admin/nominee/view',$this->data,array('debug' => false));
                        return $this->response->setJSON([
                                  'status' => $status,
                                  'html'   => $html,
                                  'message'=> $message
                               ]); 
                        die;
                    }
                    else
                    {
                        
                        return redirect()->to($this->data['uri'].'/nominee/view/'.$nominee_id)->withInput();
                    }
                }
            
            } 

            if(!empty($edit_data) && count($edit_data)){
                $editdata['rating']    = $edit_data['rating'];
                $editdata['comment']   = $edit_data['comments'];
                $editdata['id']                 =  $edit_data['id'];
                $editdata['is_rate_submitted']  =  $edit_data['is_rate_submitted'];
            }
            else
            {
                $editdata['rating']      = ($this->request->getPost('rating'))?$this->request->getPost('rating'):'';
                $editdata['comment']     = ($this->request->getPost('comment'))?$this->request->getPost('comment'):'';
                $editdata['id']          = ($this->request->getPost('id'))?$this->request->getPost('id'):'';
                $editdata['is_rate_submitted'] = '0';
            }

            
            $this->data['editdata'] = $editdata;
            
            if($this->request->isAJAX()){
               
                $html = view('admin/nominee/view',$this->data,array('debug' => false));
                return $this->response->setJSON([
                    'status'            => $status,
                    'html'              => $html,
                    'message' => $message
                ]); 
                die;
            }
            else
            {
                return  render('admin/nominee/view',$this->data);        
            }
                    
    }


    public function assignJury()
    {

            $juryID       = $this->request->getPost('juryID');
            $nomineeArr   = $this->request->getPost('nominee');
     
            $ins_data = array();
            $ins_data['jury_id'] = $juryID;
            $ins_data['created_date'] = date("Y-m-d H:i:s");
            $ins_data['created_id']   = $this->data['userdata']['id'];
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
                                        "rating" => array("label" => "Rating",'rules' => 'required|numeric|is_natural_no_zero|less_than_equal_to[100]|greater_than[0]'),
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

            $id  = ($this->request->getPost('id'))?$this->request->getPost('id'):$id; 
                
            $validation = $this->validate($this->extend_validation_rules());

            $getExtend  = $this->userModel->getUserData($id);

            $editdata = array();

            if($getExtend->getRowArray() > 0)
               $editdata = $getExtend->getRowArray(); 

            if($this->validation) {

                if($this->request->getPost()){
                
                    $extend_date    = $this->request->getPost('extend_date');
                    
                    $ins_data = array();
                    $ins_data['extend_date']   = date("Y-m-d",strtotime($extend_date));
                    
                    //get user data
                    $getExtendUserData  = $this->userModel->getListsOfUsers($id)->getRowArray();
                    
                    if(!empty($id) && $getExtend->getRowArray() > 0){
                        $this->session->setFlashdata('msg', 'Nomination Extend Date Updated Successfully!');
                        $ins_data['updated_date']   =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']     =  $this->data['userdata']['id'];
                        $this->userModel->update(array("id" => $id),$ins_data);
                    }
                
                    $this->extendMailNotification($getExtendUserData['email'],$extend_date);

                    return redirect()->route('admin/nominee');
                }
            }

            if(!empty($editdata) && count($editdata)){
                $editdata['extend_date'] = (isset($editdata['extend_date']) && ($editdata['extend_date']!=''))?date("m/d/Y",strtotime($editdata['extend_date'])):date("m/d/Y");
                $editdata['id']          = $id;
                
            }
            else
            {
                
                $editdata['extend_date'] = ($this->request->getPost('extend_date'))?date("m/d/Y",strtotime($this->request->getPost('extend_date'))):date("m/d/Y");
                $editdata['id']          = '';
                
            }
        
        $this->data['editdata'] = $editdata; 

        if($this->request->getPost())
            $this->data['validation'] = $this->validator;

        return render('admin/nomination/extend',$this->data);  
    
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

        $subject = " Nomination Date extended - Sunpharma Science Foundation ";
        $message  = "Hi, ";
        $message .= '<br/><br/>';
        $message .= "Nomination date has been changed up to ".$extend_date." Please login and upload your documents.";
        $message .= "<br/>";
    
        $message .= "<br/>";
     
        $this->data['content'] = $message;
        $html = view('email/mail',$this->data,array('debug' => false));

        sendMail($mail,$subject,$message);
    }

    public function update($id = '')
    {

               $id = ($this->request->getPost('id'))?$this->request->getPost('id'):$id; 

                //get nominee data
                $nomineeData = $this->userModel->getUserData($id)->getRowArray();
              
                $this->data['editdata'] = $nomineeData;
                $this->data['editdata']['id'] = $id; 

                $getCategoryLists   = $this->categoryModel->getCategoriesListsByID($nomineeData['category']);
                
                $this->data['categories'] = $getCategoryLists->getResultArray();
            
                if (strtolower($this->request->getMethod()) == "post") { 

                        $ltr = $this->request->getFile('justification_letter');
                        
                        $category                    = $this->request->getPost('category');
                        $firstname                   = $this->request->getPost('firstname');
                        $dob                         = $this->request->getPost('date_of_birth');
                        $citizenship                 = $this->request->getPost('citizenship');
                        $email                       = $this->request->getPost('email');
                        $phonenumber                 = $this->request->getPost('mobile_no');
                        $address                     = $this->request->getPost('designation_and_office_address');
                        $residence_address           = $this->request->getPost('residence_address');
                        $nominator_name              = $this->request->getPost('nominator_name');
                        $nominator_mobile            = $this->request->getPost('nominator_mobile');
                        $nominator_email             = $this->request->getPost('nominator_email');
                        $nominator_office_address    = $this->request->getPost('nominator_office_address');
                        $ongoing_course              = $this->request->getPost('ongoing_course');
                        $research_project            = $this->request->getPost('research_project');
                        
                        $nominator_designation             = $this->request->getPost('nominator_designation');

                        $user_data = array();
                        $user_data['firstname']     = (!empty($firstname))?$firstname:$nomineeData['firstname'];
                        $user_data['dob']           = (!empty($dob))?$dob:$nomineeData['dob'];
                        $user_data['email']         = (!empty($email))?$email:$nomineeData['email'];
                        $user_data['phone']         = (!empty($phonenumber))?$phonenumber:$nomineeData['phone'];
                        $user_data['address']       = (!empty($address))?$address:$nomineeData['address'];
                        $user_data['category']      = (!empty($category))?$category:$nomineeData['category'];
                        $user_data['updated_date']  = date("Y-m-d H:i:s");

                        $nominee_details_data   = array();
                        $nominee_details_data['residence_address']               = (!empty($residence_address))?$residence_address:$nomineeData['residence_address'];
                        $nominee_details_data['nominator_name']                  = (!empty($nominator_name))?$nominator_name:$nomineeData['nominator_name'];
                        $nominee_details_data['nominator_email']                 = (!empty($nominator_email))?$nominator_email:$nomineeData['nominator_email'];
                        $nominee_details_data['nominator_phone']                 = (!empty($nominator_mobile))?$nominator_mobile:$nomineeData['nominator_phone'];
                        $nominee_details_data['is_completed_a_research_project'] = (!empty($research_project))?$research_project:$nomineeData['is_completed_a_research_project'];
                        $nominee_details_data['nominator_address']               = (!empty($nominator_office_address))?$nominator_office_address:$nomineeData['nominator_address'];
                        $nominee_details_data['ongoing_course']                  = (!empty($ongoing_course))?$ongoing_course:$nomineeData['ongoing_course'];
                        $nominee_details_data['nominator_designation']           = (!empty($nominator_designation))?$nominator_designation:$nomineeData['nominator_designation'];
                        
                        if($this->request->getPost('course_name')) {
                            $course_name  = $this->request->getPost('course_name');
                            $nominee_details_data['course_name']   = $course_name;
                        } 
                       
                        if($this->request->getFile('nominator_photo') != ''){
                            $nominator_photo = $this->request->getFile('nominator_photo');
                            $nominator_photo->move($fileUploadDir);
                            $nominee_details_data['nominator_photo']  = $nominator_photo->getClientName();
                        }
                        
                        if($this->request->getFileMultiple('justification_letter')){
                          
                            $filenames = multipleFileUpload('justification_letter',$id);
                            
                            if($filenames!=''){
                                $filenames = fileNameUpdate($id,$filenames,'justification_letter_filename');
                                $nominee_details_data['justification_letter_filename'] = $filenames;
                            }    
                            
                        }   
                        else
                        {
                            if($this->request->getFile('justification_letter')!=''){
                               
                                $justification_letter = $this->request->getFile('justification_letter');
                                $justification_letter->move($fileUploadDir);
                                $nominee_details_data['justification_letter_filename'] = $justification_letter->getClientName();
                            }
                        }     
                    
                        if(isset($nomineeData['nomination_type'])
                        && ($nomineeData['nomination_type'] == 'ssan')){
                           
                            if($this->request->getFileMultiple('passport')){
                                  $filenames = multipleFileUpload('passport',$id);
                                  
                                  if($filenames!=''){
                                    $filenames = fileNameUpdate($id,$filenames,'passport_filename');
                                    $nominee_details_data['passport_filename'] = $filenames;
                                  }  
                            }   
                            else
                            {
                                if($this->request->getFile('passport')!=''){
                                    $passport = $this->request->getFile('passport');
                                    $passport->move($fileUploadDir);
                                    $nominee_details_data['passport_filename'] = $passport->getClientName();
                                }
                            }

                        
                            if(is_array($this->request->getFileMultiple('complete_bio_data'))){
                                   $filenames = multipleFileUpload('complete_bio_data',$id);
                                  
                                  if($filenames!="") {
                                    $filenames = fileNameUpdate($id,$filenames,'complete_bio_data');
                                    $nominee_details_data['complete_bio_data'] = $filenames;
                                  }  
                            }   
                            else
                            {
                                if($this->request->getFile('complete_bio_data')!=''){
                                    $complete_bio_data = $this->request->getFile('complete_bio_data');
                                    $complete_bio_data->move($fileUploadDir);
                                    $nominee_details_data['complete_bio_data'] = $complete_bio_data->getClientName();
                                }
                            }

                            if($this->request->getFileMultiple('best_papers')){
                                   $filenames = multipleFileUpload('best_papers',$id);
                                   
                                  if($filenames!='') {
                                    $filenames = fileNameUpdate($id,$filenames,'best_papers');
                                    $nominee_details_data['best_papers'] = $filenames;
                                  }   
                            }   
                            else
                            {
                                if($this->request->getFile('best_papers')) {
                                    $best_papers = $this->request->getFile('best_papers');
                                    $best_papers->move($fileUploadDir);
                                    $nominee_details_data['best_papers'] = $best_papers->getClientName();
                                }   
                            }
                            
                            if($this->request->getFileMultiple('statement_of_research_achievements')){
                                   $filenames = multipleFileUpload('statement_of_research_achievements',$id);
                                   
                                 if($filenames!='')  {
                                    $filenames = fileNameUpdate($id,$filenames,'statement_of_research_achievements');
                                    $nominee_details_data['statement_of_research_achievements'] = $filenames;
                                 } 
                            }   
                            else
                            {
                                if($this->request->getFile('statement_of_research_achievements')) {
                                    $statement_of_research_achievements = $this->request->getFile('statement_of_research_achievements');
                                    $statement_of_research_achievements->move($fileUploadDir);
                                    $nominee_details_data['statement_of_research_achievements'] = $statement_of_research_achievements->getClientName();
                                }  
                            }

                            if($this->request->getFileMultiple('signed_details')){
                                $filenames = multipleFileUpload('signed_details',$id);
                               
                               if($filenames!='') {
                                  $filenames = fileNameUpdate($id,$filenames,'signed_details');
                                  $nominee_details_data['signed_details'] = $filenames;
                               }  
                            }   
                            else
                            {
                                if($this->request->getFile('signed_details')) {
                                    $signed_details = $this->request->getFile('signed_details');
                                    $signed_details->move($fileUploadDir);
                                    $nominee_details_data['signed_details']  = $signed_details->getClientName();
                                }  
                            }
                            
                            if($this->request->getFileMultiple('specific_publications')){
                                $filenames = multipleFileUpload('specific_publications',$id);
                               
                                if($filenames!=''){
                                    $filenames = fileNameUpdate($id,$filenames,'specific_publications');
                                    $nominee_details_data['specific_publications'] = $filenames;
                                }    
                            }   
                            else
                            {
                                if($this->request->getFile('specific_publications')) {
                                    $specific_publications = $this->request->getFile('specific_publications');
                                    $specific_publications->move($fileUploadDir);
                                    $nominee_details_data['specific_publications'] = $specific_publications->getClientName();
                                }    
                            }
                            
                            if($this->request->getFileMultiple('signed_statement')){
                                $filenames = multipleFileUpload('signed_statement',$id);
                                  
                                if($filenames!=''){
                                    $filenames = fileNameUpdate($id,$filenames,'signed_statement');  
                                    $nominee_details_data['signed_statement'] = $filenames;
                                }   
                            }   
                            else
                            {
                                if($this->request->getFile('signed_statement')) {
                                    $signed_statement = $this->request->getFile('signed_statement');
                                    $signed_statement->move($fileUploadDir);
                                    $nominee_details_data['signed_statement']  = $signed_statement->getClientName();
                                }    
                            }
                            
                            if($this->request->getFileMultiple('citation')){
                                $filenames = multipleFileUpload('citation',$id);
                               
                                if($filenames!=''){
                                    $filenames = fileNameUpdate($id,$filenames,'citation');
                                    $nominee_details_data['citation'] = $filenames;
                                }    
                            }   
                            else
                            {
                                if($this->request->getFile('citation')){
                                    $citation = $this->request->getFile('citation');
                                    $citation->move($fileUploadDir);
                                    $nominee_details_data['citation'] = $citation->getClientName();
                                }    
                            }
                           
                    }
                    else if(isset($nomineeData['nomination_type'])
                    && ($nomineeData['nomination_type'] == 'spsfn'))
                    {

                        if($this->request->getFileMultiple('supervisor_certifying')){
                            $filenames = multipleFileUpload('supervisor_certifying',$id);
                           
                           if($filenames!='') {
                             $filenames = fileNameUpdate($id,$filenames,'supervisor_certifying'); 
                             $nominee_details_data['supervisor_certifying'] = $filenames;
                           }  
                        }   
                        else
                        {
                                if($this->request->getFile('supervisor_certifying')!=''){
                                    $supervisor_certifying = $this->request->getFile('supervisor_certifying');
                                    $supervisor_certifying->move($fileUploadDir);
                                    $nominee_details_data['supervisor_certifying'] = $supervisor_certifying->getClientName();
                                } 
                        }  

                        if($this->request->getPost('year_of_passing'))
                          $nominee_details_data['year_of_passing'] = $this->request->getPost('year_of_passing');
                        
                        if($this->request->getPost('number_of_attempts'))  
                           $nominee_details_data['number_of_attempts'] = $this->request->getPost('number_of_attempts');
                    
                           if($this->request->getFileMultiple('complete_bio_data')){
                                 $filenames = multipleFileUpload('complete_bio_data',$id);
                                 
                                if($filenames!='') {
                                    $filenames = fileNameUpdate($id,$filenames,'complete_bio_data'); 
                                  $nominee_details_data['complete_bio_data'] = $filenames;
                                }  
                            }   
                            else
                            {
                                if($this->request->getFile('complete_bio_data')!=''){
                                    $complete_bio_data = $this->request->getFile('complete_bio_data');
                                    $complete_bio_data->move($fileUploadDir);
                                    $nominee_details_data['complete_bio_data'] = $complete_bio_data->getClientName();
                                }
                            }

                            if($this->request->getFileMultiple('excellence_research_work')){
                                 $filenames = multipleFileUpload('excellence_research_work',$id);
                                 if($filenames!='') {
                                    $filenames = fileNameUpdate($id,$filenames,'excellence_research_work');
                                    $nominee_details_data['excellence_research_work'] = $filenames;
                                 }   
                           }   
                           else
                           {
                                if($this->request->getFile('excellence_research_work')) {
                                    $excellence_research_work = $this->request->getFile('excellence_research_work');
                                    $excellence_research_work->move($fileUploadDir);
                                    $nominee_details_data['excellence_research_work']  = $excellence_research_work->getClientName();
                                }
                           }

                           
                           if($this->request->getFileMultiple('lists_of_publications')){
                                $filenames = multipleFileUpload('lists_of_publications',$id);   
                                if($filenames!='') {
                                    $filenames = fileNameUpdate($id,$filenames,'lists_of_publications');
                                    $nominee_details_data['lists_of_publications'] = $filenames;
                                }        
                            }   
                            else
                            {
                                if($this->request->getFile('lists_of_publications')) {
                                    $lists_of_publications = $this->request->getFile('lists_of_publications');
                                    $lists_of_publications->move($fileUploadDir);
                                    $nominee_details_data['lists_of_publications']   = $lists_of_publications->getClientName();
                                }
                            }
                        
                        
                            if($this->request->getFileMultiple('statement_of_applicant')){
                                $filenames = multipleFileUpload('statement_of_applicant',$id);
                                if($filenames!=''){
                                    $filenames = fileNameUpdate($id,$filenames,'statement_of_applicant');
                                  $nominee_details_data['statement_of_applicant'] = $filenames;
                                }  
                              }   
                              else
                              {
                                if($this->request->getFile('statement_of_applicant')) {
                                    $statement_of_applicant = $this->request->getFile('statement_of_applicant');
                                    $statement_of_applicant->move($fileUploadDir);
                                    $nominee_details_data['statement_of_applicant'] = $statement_of_applicant->getClientName();
                                }
                              }
                          
                       
                              if($this->request->getFileMultiple('ethical_clearance')){
                                $filenames = multipleFileUpload('ethical_clearance',$id);
                                
                                if($filenames!=''){
                                    $filenames = fileNameUpdate($id,$filenames,'ethical_clearance');
                                  $nominee_details_data['ethical_clearance'] = $filenames;
                                }  
                              }   
                              else
                              {
                                if($this->request->getFile('ethical_clearance')) {
                                    $statement_of_applicant = $this->request->getFile('ethical_clearance');
                                    $statement_of_applicant->move($fileUploadDir);
                                    $nominee_details_data['ethical_clearance'] = $statement_of_applicant->getClientName();
                                }
                              }
                        
                              if($this->request->getFileMultiple('statement_of_duly_signed_by_nominee')){
                                $filenames = multipleFileUpload('statement_of_duly_signed_by_nominee',$id);
                                
                                if( $filenames!=''){
                                    $filenames = fileNameUpdate($id,$filenames,'statement_of_duly_signed_by_nominee');
                                   $nominee_details_data['statement_of_duly_signed_by_nominee'] =  $filenames;
                                }   
                              }   
                              else
                              {
                                if($this->request->getFile('statement_of_duly_signed_by_nominee')) {
                                    $statement_of_duly_signed_by_nominee = $this->request->getFile('statement_of_duly_signed_by_nominee');
                                    $statement_of_duly_signed_by_nominee->move($fileUploadDir);
                                    $nominee_details_data['statement_of_duly_signed_by_nominee']= $statement_of_duly_signed_by_nominee->getClientName();
                                }
                              }

                              if($this->request->getFileMultiple('citation')){
                                $filenames = multipleFileUpload('citation',$id);
                               
                                if($filenames != ''){
                                    $filenames = fileNameUpdate($id,$filenames,'citation');
                                  $nominee_details_data['citation'] = $filenames;
                                }  
                              }   
                              else
                              {
                                if($this->request->getFile('citation')) {
                                    $citation = $this->request->getFile('citation');
                                    $citation->move($fileUploadDir);
                                    $nominee_details_data['citation'] = $citation->getClientName();
                                }
                              }

                              if($this->request->getFileMultiple('aggregate_marks')){
                                $filenames = multipleFileUpload('aggregate_marks',$id);
                                
                                if($filenames!=""){
                                    $filenames = fileNameUpdate($id,$filenames,'aggregate_marks');
                                    $nominee_details_data['aggregate_marks'] = $filenames; 
                                }    
                              }   
                              else
                              {
                                if($this->request->getFile('aggregate_marks')) {
                                    $aggregate_marks = $this->request->getFile('aggregate_marks');
                                    $aggregate_marks->move($fileUploadDir);
                                    $nominee_details_data['aggregate_marks']  = $aggregate_marks->getClientName();
                                }
        
                              }

                              if($this->request->getFileMultiple('age_proof')){
                                $filenames = multipleFileUpload('age_proof',$id);
                                
                                if($filenames!=""){
                                    $filenames = fileNameUpdate($id,$filenames,'age_proof');
                                  $nominee_details_data['age_proof'] = $filenames; 
                                }  
                              }   
                              else
                              {
                                if($this->request->getFile('age_proof')) {
                                    $age_proof = $this->request->getFile('age_proof');
                                    $age_proof->move($fileUploadDir);
                                    $nominee_details_data['age_proof']  = $age_proof->getClientName();
                                }
        
                              }

                              if($this->request->getFileMultiple('declaration_candidate')){
                                  $filenames = multipleFileUpload('declaration_candidate',$id);
                                 
                                 if($filenames!=""){   
                                    $filenames = fileNameUpdate($id,$filenames,'declaration_candidate');
                                   $nominee_details_data['declaration_candidate'] = $filenames;
                                 }  
                              }   
                              else
                              {
                                if($this->request->getFile('declaration_candidate')) {
                                    $declaration_candidate = $this->request->getFile('declaration_candidate');

                                    $declaration_candidate->move($fileUploadDir);
                                    $nominee_details_data['declaration_candidate']   = $declaration_candidate->getClientName();
                                } 
        
                              }
                    
                      }
                      else
                      {

                            if($this->request->getPost('first_employment_name_of_institution_location'))
                                $nominee_details_data['first_employment_name_of_institution_location'] = $this->request->getPost('first_employment_name_of_institution_location');
                        
                            if($this->request->getPost('first_employment_designation'))  
                                $nominee_details_data['first_employment_designation'] = $this->request->getPost('first_employment_designation');
                    
                            if($this->request->getPost('first_employment_year_of_joining'))
                                $nominee_details_data['first_employment_year_of_joining'] = $this->request->getPost('first_employment_year_of_joining');
                              
                            if($this->request->getPost('first_medical_degree_name_of_degree'))  
                                 $nominee_details_data['first_medical_degree_name_of_degree'] = $this->request->getPost('first_medical_degree_name_of_degree');
                          
                            if($this->request->getPost('first_medical_degree_year_of_award'))
                                 $nominee_details_data['first_medical_degree_year_of_award'] = $this->request->getPost('first_medical_degree_year_of_award');
                               
                            if($this->request->getPost('first_medical_degree_institution'))  
                                $nominee_details_data['first_medical_degree_institution'] = $this->request->getPost('first_medical_degree_institution');
                    
                            if($this->request->getPost('highest_medical_degree_name'))
                                $nominee_details_data['highest_medical_degree_name'] = $this->request->getPost('highest_medical_degree_name');
                                
                            if($this->request->getPost('highest_medical_degree_year'))  
                               $nominee_details_data['highest_medical_degree_year'] = $this->request->getPost('highest_medical_degree_year');
                             
                            if($this->request->getPost('highest_medical_degree_institution'))  
                               $nominee_details_data['highest_medical_degree_institution'] = $this->request->getPost('highest_medical_degree_institution');
                             
                            if($this->request->getPost('fellowship_name_of_institution_research_work'))  
                               $nominee_details_data['fellowship_name_of_institution_research_work'] = $this->request->getPost('fellowship_name_of_institution_research_work');
                             
                            if($this->request->getPost('fellowship_name_of_the_supervisor'))  
                               $nominee_details_data['fellowship_name_of_the_supervisor'] = $this->request->getPost('fellowship_name_of_the_supervisor');
                             
                            if($this->request->getPost('fellowship_name_of_institution'))  
                               $nominee_details_data['fellowship_name_of_institution'] = $this->request->getPost('fellowship_name_of_institution');
                             
                            if($this->request->getPost('fellowship_supervisor_department'))  
                               $nominee_details_data['fellowship_supervisor_department'] = $this->request->getPost('fellowship_supervisor_department');
                             
          
                              if($this->request->getFileMultiple('fellowship_research_experience')){
                                  $filenames = multipleFileUpload('fellowship_research_experience',$id);   
                                  if($filenames!='') {
                                      $filenames = fileNameUpdate($id,$filenames,'fellowship_research_experience');
                                      $nominee_details_data['fellowship_research_experience'] = $filenames;
                                  }        
                              }   
                              else
                              {
                                  if($this->request->getFile('fellowship_research_experience')) {
                                      $research_experience = $this->request->getFile('fellowship_research_experience');
                                      $research_experience->move($fileUploadDir);
                                      $nominee_details_data['fellowship_research_experience']   = $research_experience->getClientName();
                                  }
                              }
          
                              if($this->request->getFileMultiple('fellowship_research_publications')){
                                  $filenames = multipleFileUpload('fellowship_research_publications',$id);   
                                  if($filenames!='') {
                                      $filenames = fileNameUpdate($id,$filenames,'fellowship_research_publications');
                                      $nominee_details_data['fellowship_research_publications'] = $filenames;
                                  }        
                              }   
                              else
                              {
                                  if($this->request->getFile('fellowship_research_publications')) {
                                      $research_publications = $this->request->getFile('fellowship_research_publications');
                                      $research_publications->move($fileUploadDir);
                                      $nominee_details_data['fellowship_research_publications']   = $research_publications->getClientName();
                                  }
                              }
          
                              if($this->request->getFileMultiple('fellowship_research_awards_and_recognitions')){
                                  $filenames = multipleFileUpload('fellowship_research_awards_and_recognitions',$id);   
                                  if($filenames!='') {
                                      $filenames = fileNameUpdate($id,$filenames,'fellowship_research_awards_and_recognitions');
                                      $nominee_details_data['fellowship_research_awards_and_recognitions'] = $filenames;
                                  }        
                              }   
                              else
                              {
                                  if($this->request->getFile('fellowship_research_awards_and_recognitions')) {
                                      $awards_and_recognitions = $this->request->getFile('fellowship_research_awards_and_recognitions');
                                      $awards_and_recognitions->move($fileUploadDir);
                                      $nominee_details_data['fellowship_research_awards_and_recognitions']   = $awards_and_recognitions->getClientName();
                                  }
                              }
          
                              if($this->request->getFileMultiple('fellowship_scientific_research_projects')){
                                  $filenames = multipleFileUpload('fellowship_scientific_research_projects',$id);   
                                  if($filenames!='') {
                                      $filenames = fileNameUpdate($id,$filenames,'fellowship_scientific_research_projects');
                                      $nominee_details_data['fellowship_scientific_research_projects'] = $filenames;
                                  }        
                              }   
                              else
                              {
                                  if($this->request->getFile('fellowship_scientific_research_projects')) {
                                      $research_projects = $this->request->getFile('fellowship_scientific_research_projects');
                                      $research_projects->move($fileUploadDir);
                                      $nominee_details_data['fellowship_scientific_research_projects']   = $research_projects->getClientName();
                                  }
                              }
          
                              if($this->request->getFileMultiple('fellowship_description_of_research')){
                                  $filenames = multipleFileUpload('fellowship_description_of_research',$id);   
                                  if($filenames!='') {
                                      $filenames = fileNameUpdate($id,$filenames,'fellowship_description_of_research');
                                      $nominee_details_data['fellowship_description_of_research'] = $filenames;
                                  }        
                              }   
                              else
                              {
                                  if($this->request->getFile('fellowship_description_of_research')) {
                                      $description_of_research = $this->request->getFile('fellowship_description_of_research');
                                      $description_of_research->move($fileUploadDir);
                                      $nominee_details_data['fellowship_description_of_research']   = $description_of_research->getClientName();
                                  }
                              }
          
                              if($this->request->getFileMultiple('first_degree_marksheet')){
                                $filenames = multipleFileUpload('first_degree_marksheet',$id);   
                                if($filenames!='') {
                                    $filenames = fileNameUpdate($id,$filenames,'first_degree_marksheet');
                                    $nominee_details_data['first_degree_marksheet'] = $filenames;
                                }        
                            }   
                            else
                            {
                                if($this->request->getFile('first_degree_marksheet')) {
                                    $description_of_research = $this->request->getFile('first_degree_marksheet');
                                    $description_of_research->move($fileUploadDir);
                                    $nominee_details_data['first_degree_marksheet']   = $description_of_research->getClientName();
                                }
                            }


                            if($this->request->getFileMultiple('highest_degree_marksheet')){
                                $filenames = multipleFileUpload('highest_degree_marksheet',$id);   
                                if($filenames!='') {
                                    $filenames = fileNameUpdate($id,$filenames,'highest_degree_marksheet');
                                    $nominee_details_data['highest_degree_marksheet'] = $filenames;
                                }        
                            }   
                            else
                            {
                                if($this->request->getFile('highest_degree_marksheet')) {
                                    $description_of_research = $this->request->getFile('highest_degree_marksheet');
                                    $description_of_research->move($fileUploadDir);
                                    $nominee_details_data['highest_degree_marksheet']   = $description_of_research->getClientName();
                                }
                            }
                              
          
                       }

                    $this->nominationModel->update(array("id" => $nomineeData['nominee_detail_id']),$nominee_details_data);
                    $this->session->setFlashdata('msg', 'Nomination Info Updated Successfully!');
                    return redirect()->to('admin/nominee/view/'.$id);
                  
            }
           
        if(isset($nomineeData['nomination_type']) && ($nomineeData['nomination_type'] == 'ssan')){
            return render('admin/nominee/ssan_update',$this->data);
        }

        if(isset($nomineeData['nomination_type']) && ($nomineeData['nomination_type'] == 'spsfn')){
            return render('admin/nominee/spsfn_update',$this->data);
        }  

        if(isset($nomineeData['nomination_type']) && ($nomineeData['nomination_type'] == 'fellowship')){
            return render('admin/nominee/fellowship_update',$this->data);
        }

  }

  public function removeFile()
  {

        if (strtolower($this->request->getMethod()) == "post") { 

            $removeFile = $this->request->getPost('filename');
            $user_id    = $this->request->getPost('user_id');
            $field      = $this->request->getPost('field');
            $id         = $this->request->getPost('id');

            $getNomineeFilename = $this->nominationModel->getNominationFileData($user_id,$field)->getRowArray();
            //print_r($getNomineeFilename); die;
            //convert array and remove file
            if(strpos($getNomineeFilename[$field],',')){
                $files = explode(',',$getNomineeFilename[$field]);
                $key = array_search($removeFile,$files,true);
                if ($key !== false) {
                    unset($files[$key]);
                }
                $remainingFiles = implode(",",$files);
            }
            else
            {
                if($getNomineeFilename[$field] == $removeFile){
                    $remainingFiles = '';
                }
            }
            //remove file from folder
            $filepath = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$user_id."/".$removeFile;
            unlink($filepath);

            //update field
            $up_data = array();
            $up_data[$field] = $remainingFiles;
            $this->nominationModel->update(array("id"=> $id),$up_data);

            if($this->request->isAJAX()){
                 return $this->response->setJSON([
                     'status'  => "success",
                     'message' => "Removed File Successfully"
                 ]); 
                 die;
             }
            
        }     

  }

  public function export()
  {

        $path =  $_SERVER['DOCUMENT_ROOT'];
        $year              = ($this->request->getPost('year'))?$this->request->getPost('year'):date('Y');
        $main_category_id  = ($this->request->getPost('main_category_id'))?$this->request->getPost('main_category_id'):'1';

        $typeOfAward = '';

        $typeOfTitle  = 'List of Applicants : Sun Pharma Science Foundation ';

        switch ($main_category_id) {
            case 1:
                $typeOfTitle .= 'Research Awards ';
                $typeOfAward = 'RA';
                break;
            case 2:
                $typeOfTitle .= 'Science Scholar Awards ';
                $typeOfAward = 'SSA';
                break;
            case 3:
                $typeOfTitle .= 'Clinical Research Fellowship ';
                $typeOfAward = 'CRF';
                break;
          }

        $fileName    = $typeOfAward.' Nomination List (Template) '.date('d-m-Y').'.xlsx';  

        $filter = array();
        $filter['year'] = $year;
        $filter['main_category_id'] = $main_category_id;

        $nomineeLists = $this->nomineeModel->getNominationsLists($filter)->getResultArray();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();
        
       
        
        $title = $typeOfTitle.date('Y');

        $sheet->setCellValue('A1',$title);
        $sheet->getStyle("A1:K1")->getFont()->setBold(true);
        $sheet->getStyle("A1:K1")->getFont()->setSize(11);
        $sheet->mergeCells("A1:K1");
        
        $sheet->setCellValue('A2', '');
        $sheet->setCellValue('B2', 'Nomination No');
        $sheet->setCellValue('C2', 'Category');
        $sheet->setCellValue('D2', 'Name');
        $sheet->setCellValue('E2', 'Mobile No.');
        $sheet->setCellValue('F2', 'Email ID');
        $sheet->setCellValue('G2', 'Date of Birth');
        $sheet->setCellValue('H2', 'Citizenship');
        $sheet->setCellValue('I2', 'Nominator Name');
        $sheet->setCellValue('J2', 'Mobile No.');
        $sheet->setCellValue('K2', 'Email ID');
           
        $sheet->getStyle("A2:K2")->getFont()->setBold(true);
        $sheet->getStyle("A2:K2")->getFont()->setSize(12);
        $sheet->getStyle('A2:K2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('EEEEEE');
       // $sheet->mergeCells("A1:K1");
       
        $nominationsArr = array();
        $i = 0;
        foreach($nomineeLists as $akey => $avalue) {
           
                $nominationsArr[$avalue['category_name']][$i]['registration_no'] = $avalue['registration_no'];
                $nominationsArr[$avalue['category_name']][$i]['firstname']     = $avalue['firstname'];
                $nominationsArr[$avalue['category_name']][$i]['lastname']      = $avalue['lastname'];
                $nominationsArr[$avalue['category_name']][$i]['category']      = $avalue['category_name'];
                $nominationsArr[$avalue['category_name']][$i]['phone']      = $avalue['phone'];
                $nominationsArr[$avalue['category_name']][$i]['email']      = $avalue['email'];
                $nominationsArr[$avalue['category_name']][$i]['dob']      = $avalue['dob'];
                $nominationsArr[$avalue['category_name']][$i]['citizenship']      = $avalue['citizenship'];
                $nominationsArr[$avalue['category_name']][$i]['nominator_name']   = $avalue['nominator_name'];
                $nominationsArr[$avalue['category_name']][$i]['nominator_phone']  = $avalue['nominator_phone'];
                $nominationsArr[$avalue['category_name']][$i]['nominator_email']  = $avalue['nominator_email'];
               
                $i++;
                                 
        }

        $rows = 3;
        ksort($nominationsArr); 
      
         $nominationsCategoryArr = array();
        foreach ($nominationsArr as $vl=>$dt){       
            
            if($main_category_id == 1){     
                if($vl == 'Medical Sciences-Basic Research')
                  $nominationsCategoryArr['Medical Sciences-Basic Research'] = count($dt);
                
                if($vl == 'Medical Sciences-Clinical Research')
                  $nominationsCategoryArr['Medical Sciences-Clinical Research'] = count($dt);  
               
                if($vl == 'Pharmaceutical Sciences')
                  $nominationsCategoryArr['Pharmaceutical Sciences'] = count($dt);  
            }
            else if($main_category_id == 2)
            {
                if($vl == 'Pharmaceutical Sciences')
                  $nominationsCategoryArr['Pharmaceutical Sciences'] = count($dt);  
                
                if($vl == 'Bio-Medical Sciences')
                  $nominationsCategoryArr['Bio-Medical Sciences'] = count($dt);  
            }
            else
            {
                if($vl == 'Clinical Research Fellowship')
                  $nominationsCategoryArr['Clinical Research Fellowship'] = count($dt);  
            }

            $k = 1;
            foreach($dt as $v => $val){

                $name = $val['firstname'].' '.$val['lastname'];
                $citizenship = ($val['citizenship']==1)?'INDIAN':'Other';
                $sheet->setCellValue('A' . $rows, $k);
                $sheet->setCellValue('B' . $rows, $val['registration_no']);
                $sheet->setCellValue('C' . $rows, $vl);
                $sheet->setCellValue('D' . $rows, $name);
                $sheet->setCellValue('E' . $rows, $val['phone']);
                $sheet->setCellValue('F' . $rows, $val['email']);
                $sheet->setCellValue('G' . $rows, $val['dob']);
                $sheet->setCellValue('H' . $rows, $citizenship);
                $sheet->setCellValue('I' . $rows, $val['nominator_name']);
                $sheet->setCellValue('J' . $rows, $val['nominator_phone']);
                $sheet->setCellValue('K' . $rows, $val['nominator_email']);
                $rows++; 
                $k++;
            }
            $stCl = "A".$rows; 
            $edCl = "K".$rows;
            $sheet->mergeCells($stCl.":".$edCl);
            $rows++;
        } 
      
       // Display total awards count
        $header = ' Sun Pharma Science Foundation';
       // $header.=  ($main_category_id == 1)?' Research Awards ':' Science Scholar Awards ';
        switch ($main_category_id) {
            case 1:
                $header .= 'Research Awards ';
                break;
            case 2:
                $header .= 'Science Scholar Awards ';
                break;
            case 3:
                $header .= 'Clinical Research Fellowship ';
                break;
        }
        $header.= $year.' Nominations Received';
        $rw = $rows + 2;
        $startCell = 'C'.$rw;
        $endCell   = 'D'.$rw;
      
       $sheet->setCellValue($startCell,$header);
       $sheet->getStyle($startCell.":".$endCell)->getFont()->setBold(true);
       $sheet->getStyle($startCell.":".$endCell)->getFont()->setSize(12);
       $sheet->getStyle($startCell.":".$endCell)->getFont()->getColor()->setARGB('3A0BAF');

       $sheet->mergeCells($startCell.":".$endCell);

       $updateTotalRw = $rw + 1;
       foreach($nominationsCategoryArr as $k=>$v ){
        
          $sheet->setCellValue('C' . $updateTotalRw, $k);
          $sheet->setCellValue('D' . $updateTotalRw, $v);
          $sheet->getStyle('C'.$updateTotalRw.":D".$updateTotalRw)->getFont()->setBold(true);
          $sheet->getStyle('C'.$updateTotalRw.":D".$updateTotalRw)->getFont()->setSize(12);
          $sheet->getStyle('C'.$updateTotalRw.":D".$updateTotalRw)->getFont()->getColor()->setARGB('3A0BAF');   
          $updateTotalRw++;
         
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


}
