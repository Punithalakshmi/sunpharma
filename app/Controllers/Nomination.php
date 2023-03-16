<?php

namespace App\Controllers;

class Nomination extends BaseController
{
    public function index($award_id = '')
    {
           // sessionDestroy();

            //get categories lists
            $getCategoryLists   = $this->categoryModel->getCategoriesByType('Science Scholar Awards');
            
            $this->data['categories'] = $getCategoryLists->getResultArray();

            $getSessionFiles = getSessionData('uploadedFile');
            
            if (strtolower($this->request->getMethod()) == "post") {

                $this->validation->setRules($this->validation_rules('spsfn',$award_id,$getSessionFiles),$this->validationMessages('spsfn'));

                if($this->validation->withRequest($this->request)->run()) {

                        $formTypeStatus = $this->request->getPost('formTypeStatus');

                        if($formTypeStatus && $formTypeStatus == 'preview') {
                               
                                $html = $this->getPostedData('spsfn');

                                if($this->request->isAJAX()){
                                    return $this->response->setJSON([
                                        'status'            => 'success',
                                        'message'          => 'preview',
                                        'html'              => $html
                                    ]); 
                                    die;
                                }
                        }  
                        else
                        {
                
                            $category                    = $this->request->getPost('category');
                            $firstname                   = $this->request->getPost('nominee_name');
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

                            //get award data
                            $awardData = getAwardData($award_id);
                            
                            $ins_data = array();
                            $ins_data['firstname']  = $firstname;
                            $ins_data['email']      = $email;
                            $ins_data['phone']      = $phonenumber;
                            $ins_data['address']    = $address;
                            $ins_data['dob']        = date("Y/m/d",strtotime($dob));
                            $ins_data['status']     = 'Disapproved';
                            $ins_data['role']       = 2;
                            $ins_data['category']   = $category;
                            $ins_data['extend_date']= $awardData['end_date'];
                            $ins_data['award_id']   = $award_id;
                            $ins_data['active']     = '0';
                            $ins_data['review_status'] = 'Pending';

                            $nominee_details_data = array();
                            $nominee_details_data['category_id']        = $category;
                            $nominee_details_data['citizenship']        = $citizenship;
                            $nominee_details_data['nomination_type']    = 'spsfn';
                            $nominee_details_data['residence_address']  = $residence_address;
                            $nominee_details_data['nominator_name']     = $nominator_name;
                            $nominee_details_data['nominator_email']    = $nominator_email;
                            $nominee_details_data['nominator_phone']    = $nominator_mobile;
                            $nominee_details_data['nominator_address']  = $nominator_office_address;
                            $nominee_details_data['ongoing_course']    = $ongoing_course;
                            $nominee_details_data['is_completed_a_research_project']  = $research_project;
                            $nominee_details_data['is_submitted'] = 0;

                            if($this->request->getPost('course_name')) {
                                $course_name  = $this->request->getPost('course_name');
                                $nominee_details_data['course_name']   = $course_name;
                            } 

                            $this->session->setFlashdata('msg', 'Submitted Successfully!');
                            $ins_data['created_date']  =  date("Y-m-d H:i:s");
                            $ins_data['created_id']    =  '';
                            $this->userModel->save($ins_data);
                            $lastInsertID = $this->userModel->insertID();

                            $fileUploadDir = 'uploads/'.$lastInsertID;
                            
                            if(!file_exists($fileUploadDir) && !is_dir($fileUploadDir))
                            mkdir($fileUploadDir, 0777, true);
                            
                            $getSessionFiles = getSessionData('uploadedFile');

                            //upload documents to respestive nominee folder
                            if($this->request->getFile('justification_letter')!=''){
                                 $justification_letter = $this->request->getFile('justification_letter');
                                 $justification_letter->move($fileUploadDir);
                                 $nominee_details_data['justification_letter_filename'] = $justification_letter->getClientName();
                            }     
                            else
                            {
                                 $justification_letter = getFileInfo($getSessionFiles['justification_letter']); 
                                 $justification_letter->move($fileUploadDir);  
                                 $nominee_details_data['justification_letter_filename'] = $justification_letter->getBasename();    
                            }
                            

                            if($this->request->getFile('supervisor_certifying')!=''){
                                $supervisor_certifying = $this->request->getFile('supervisor_certifying');
                                $supervisor_certifying->move($fileUploadDir);
                                $nominee_details_data['supervisor_certifying'] = $supervisor_certifying->getClientName();
                            }    
                            else
                            {
                                $supervisor_certifying = getFileInfo($getSessionFiles['supervisor_certifying']);
                                $supervisor_certifying->move($fileUploadDir);
                                $nominee_details_data['supervisor_certifying'] = $supervisor_certifying->getBasename();
                            }

                            
                            if($this->request->getFile('nominator_photo') != ''){
                                $nominator_photo = $this->request->getFile('nominator_photo');
                                $nominator_photo->move($fileUploadDir);
                                $nominee_details_data['nominator_photo']  = $nominator_photo->getClientName();
                            }    
                            else
                            {
                                $nominator_photo = getFileInfo($getSessionFiles['nominator_photo']); 
                                $nominator_photo->move($fileUploadDir);
                                $nominee_details_data['nominator_photo']  = $nominator_photo->getBasename();
                            }    
                           
                            
                            $nominee_details_data['nominee_id'] = $lastInsertID;
                           
                            $this->nominationModel->save($nominee_details_data);

                            $registrationID = $this->nominationModel->insertID();

                            $registrationNo = date('Y')."/".$registrationID;

                            $update_regisno_arr = array();
                            $update_regisno_arr['registration_no'] = $registrationNo;
                            $this->nominationModel->update(array("id" => $registrationID),$update_regisno_arr);

                            $this->sendMail($firstname,$registrationNo,$email);

                            if($this->request->isAJAX()){
                                return $this->response->setJSON([
                                    'status'            => 'success',
                                    'message'           => 'thank you'
                                ]); 
                                die;
                            }
                        }
                    }
                    else
                    {  
                        if(is_array($this->validation->getErrors()) && count($this->validation->getErrors()) > 0){
                            $this->data['validation'] = $this->validation;
                            $status = 'error';
                        }  
                    }
        }
        
        
        $this->data['award_id'] = $this->uri->getSegment(2);

        if($this->request->isAJAX()){
            $this->data['editdata'] = $this->getRequestedData('spsfn','ajax');
            $html = view('frontend/spsfn_new',$this->data,array('debug' => false));
            return $this->response->setJSON([
                'status'            => $status,
                'html'              => $html
            ]); 
            die;
        }
        else
        {
            $this->data['editdata'] = $this->getRequestedData('spsfn','no');
            return  render('frontend/spsfn_new',$this->data);        
        }
       
     }

   
    public function ssan($award_id = '')
    {
            //get categories lists
            $getCategoryLists   = $this->categoryModel->getCategoriesByType('Research Awards');
            $categories         = $getCategoryLists->getResultArray();
          //  sessionDestroy();
            $this->data['categories'] = $categories;

            $getSessionFiles = getSessionData('uploadedFile');

            if (strtolower($this->request->getMethod()) == "post") {

                $this->validation->setRules($this->validation_rules('ssan',$award_id,$getSessionFiles),$this->validationMessages('ssan'));

                if($this->validation->withRequest($this->request)->run()) {

                        $formTypeStatus = $this->request->getPost('formTypeStatus');

                        if($formTypeStatus && $formTypeStatus == 'preview') {
                               
                                $html = $this->getPostedData('ssan');

                                if($this->request->isAJAX()){
                               
                                    return $this->response->setJSON([
                                        'status'            => 'success',
                                        'message'          => 'preview',
                                        'html'              => $html
                                    ]); 
                                    die;
                                }
                        }  
                        else
                        {  

                                $category                    = $this->request->getPost('category');
                                $firstname                   = $this->request->getPost('nominee_name');
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

                                //get award data
                                $awardData = getAwardData($award_id);

                                $ins_data = array();
                                $ins_data['firstname']  = $firstname;
                                $ins_data['email']      = $email;
                                $ins_data['phone']      = $phonenumber;
                                $ins_data['address']    = $address;
                                $ins_data['dob']        = date("Y/m/d",strtotime($dob));
                                $ins_data['status']     = 'Disapproved';
                                $ins_data['role']       = 2;
                                $ins_data['category']   = $category;
                                $ins_data['active']     = '0';
                                $ins_data['award_id']   = $award_id;
                                $ins_data['extend_date']= $awardData['end_date'];
                                $ins_data['review_status'] = 'Pending';
                                

                                $nominee_details_data = array();
                                $nominee_details_data['category_id']        = $category;
                                $nominee_details_data['citizenship']        = $citizenship ;
                                $nominee_details_data['nomination_type']    = 'ssan';
                                $nominee_details_data['residence_address']  = $residence_address;
                                $nominee_details_data['nominator_name']     = $nominator_name;
                                $nominee_details_data['nominator_email']    = $nominator_email;
                                $nominee_details_data['nominator_phone']    = $nominator_mobile;
                                $nominee_details_data['nominator_address']  = $nominator_office_address;
                                $nominee_details_data['is_submitted'] = 0;

                                
                                $this->session->setFlashdata('msg', 'Submitted Successfully!');
                                $ins_data['created_date']  =  date("Y-m-d H:i:s");
                                $ins_data['created_id']    =  1;
                                $this->userModel->save($ins_data);
                                $lastInsertID = $this->userModel->insertID();

                                $fileUploadDir = 'uploads/'.$lastInsertID;
                            
                                if(!file_exists($fileUploadDir) && !is_dir($fileUploadDir))
                                     mkdir($fileUploadDir, 0777, true);

                                //upload documents to respestive nominee folder
                                if($this->request->getFile('justification_letter')!=''){
                                    $justification_letter = $this->request->getFile('justification_letter');
                                    $justification_letter->move($fileUploadDir);
                                    $nominee_details_data['justification_letter_filename'] = $justification_letter->getClientName();
                               
                                }    
                                else
                                {
                                    $justification_letter = getFileInfo($getSessionFiles['justification_letter']);
                                    $justification_letter->move($fileUploadDir); 
                                    $nominee_details_data['justification_letter_filename'] = $justification_letter->getBasename();
                                }        
                                
                                
                                $nominee_details_data['passport_filename'] = '';
                                if($this->request->getFile('passport')!=''){
                                    $passport = $this->request->getFile('passport');
                                    $passport->move($fileUploadDir);
                                    $nominee_details_data['passport_filename']  = $passport->getClientName();
                                }    
                                else
                                {
                                    if(!empty($getSessionFiles['passport'])){
                                        $passport = getFileInfo($getSessionFiles['passport']);
                                        $passport->move($fileUploadDir);
                                        $nominee_details_data['passport_filename']  = $passport->getBasename();
                                    }
                                }    
                            

                                if($this->request->getFile('nominator_photo') != ''){
                                    $nominator_photo = $this->request->getFile('nominator_photo');
                                    $nominator_photo->move($fileUploadDir);
                                    $nominee_details_data['nominator_photo'] = $nominator_photo->getClientName();
                                }    
                                else
                                {
                                    $nominator_photo = getFileInfo($getSessionFiles['nominator_photo']); 
                                    $nominator_photo->move($fileUploadDir);
                                    $nominee_details_data['nominator_photo'] = $nominator_photo->getBasename();
                                }    
                                
                                $nominee_details_data['nominee_id'] = $lastInsertID;
                                 
                                $this->nominationModel->save($nominee_details_data);

                                $registrationID = $this->nominationModel->insertID();

                                $registrationNo = date('Y')."/".$registrationID;

                                $update_regisno_arr = array();
                                $update_regisno_arr['registration_no'] = $registrationNo;
                                $this->nominationModel->update(array("id" => $registrationID),$update_regisno_arr);

                                $this->sendMail($firstname,$registrationNo,$email);

                                if($this->request->isAJAX()){
                                    //   $html = view('frontend/ssan_new',$this->data,array('debug' => false));
                                    return $this->response->setJSON([
                                        'status'            => 'success',
                                        'message'           => 'thank you'
                                    ]); 
                                    die;
                                }
                        }       
                    }
                    else
                    {  
                        if(is_array($this->validation->getErrors()) && count($this->validation->getErrors()) > 0){
                            $this->data['validation'] = $this->validation;
                            $status = 'error';
                        }    
                    }
        }

       
        $this->data['award_id'] = $this->uri->getSegment(2);

        if($this->request->isAJAX()){
            $this->data['editdata'] = $this->getRequestedData('ssan','ajax');
            $html = view('frontend/ssan_new',$this->data,array('debug' => false));
            return $this->response->setJSON([
                'status'            => $status,
                'html'              => $html
            ]); 
            die;
        }
        else
        {
            $this->data['editdata'] = $this->getRequestedData('ssan','no');
            return  render('frontend/ssan_new',$this->data);         
        }
    }

    public function validation_rules($type='',$id='',$session = array())
    {
 
            $validation_rules = array();
            $validation_rules = array(
                                        "category" => array("label" => "Category",'rules' => 'required'),
                                        "nominee_name" => array("label" => "Applicant Name",'rules' => 'required'),
                                        "date_of_birth" => array("label" => "Date Of Birth",'rules' => 'required'),
                                        "citizenship" => array("label" => "Citizenship",'rules' => 'required'),
                                        "designation_and_office_address" => array("label" => "Designation & Office Address",'rules' => 'required'),
                                        "residence_address" => array("label" => "Residence Address",'rules' => 'required'),
                                        "email" => array("label" => "Email",'rules' => 'required|valid_email|checkUniqueEmail['.$id.']'),
                                        "mobile_no" => array("label" => "Mobile No.",'rules' => 'required|numeric|max_length[10]'),
                                        "nominator_name" => array("label" => "Naminator Name",'rules' => 'required'),
                                        "nominator_mobile" => array("label" => "Naminator Mobile",'rules' => 'required|numeric|max_length[10]'),
                                        "nominator_email" => array("label" => "Naminator Email",'rules' => 'required|valid_email'),
                                        "nominator_office_address" => array("label" => "Naminator Office Address",'rules' => 'required')
            ); 

            if($type == 'ssan') {

              if(!isset($session['justification_letter']))
                $validation_rules['justification_letter'] = array("label" => "Justification Letter",'rules' => 'uploaded[justification_letter]|max_size[justification_letter,500]|ext_in[justification_letter,pdf]'); 

              if(!isset($session['nominator_photo']))  
                $validation_rules['nominator_photo'] = array("label" => "Applicant Photo",'rules' => 'uploaded[nominator_photo]|max_size[nominator_photo,500]');

              if($this->request->getPost('citizenship') == 2 && !isset($session['passport'])) 
                $validation_rules['passport'] =  array("label" => "Passport",'rules' => 'uploaded[passport]|max_size[passport,500]|ext_in[passport,pdf]');
            
            }

            if($type == 'spsfn') {

                if($this->request->getPost('ongoing_course') == 'other')
                   $validation_rules['course_name'] = array("label" => "Course Name",'rules' => 'required');

                if($this->request->getPost('research_project') == 'No')
                   $validation_rules['research_project'] = array("label" => "Research Project",'rules' => 'required');   

               if(!isset($session['justification_letter']))
                   $validation_rules['justification_letter'] = array("label" => "Justification Letter",'rules' => 'uploaded[justification_letter]|max_size[justification_letter,500]|ext_in[justification_letter,pdf]');
                   
               if(!isset($session['supervisor_certifying']))  
                   $validation_rules['supervisor_certifying'] = array("label" => "Supervisor Certifying",'rules' => 'uploaded[supervisor_certifying]|max_size[supervisor_certifying,500]|ext_in[supervisor_certifying,pdf]');  
      
            }    
            return $validation_rules;
      
    }

    public function validationMessages($type='')
    {

        $validationMessages = array("category" => array("required" => "Please select category"),
                                    "nominee_name" => array("required" => "Please enter name"),
                                    "date_of_birth" => array("required" => "Please enter date of birth"),
                                    "citizenship" => array("required" => "Please select citizenship"),
                                    "designation_and_office_address" => array("required" => "Please enter designation and address"),
                                    "residence_address" => array("required" => "Please enter residence address"),
                                    "email" => array("required" => "Please enter Email","checkUniqueEmail"=>"A nomination with this email already exists"),
                                    "mobile_no" => array("required" => "Please enter mobile no"),
                                    "nominator_name" => array("required" => "Please enter nominator name"),
                                    "nominator_mobile" => array("required" => "Please enter nominator mobile"),
                                    "nominator_email" => array("required" => "Please enter nominator email"),
                                    "nominator_office_address" => array("required" => "Please enter nominator office address"),
                                    "justification_letter" => array("uploaded" => "Please upload justification letter","max_size" => "File size should be below 500KB", "ext_in" => "File type should be pdf"),
                                    "nominator_photo" => array("uploaded" => "Please upload the photo","max_size" => "File size should be below 500KB")
                              );

                                if($type == 'ssan') {

                                    if($this->request->getPost('citizenship') == 2 ) 
                                        $validationMessages['passport'] =  array("uploaded" => "Please upload the passport","max_size" => "File size should be below 500KB","ext_in" => "File type should be pdf");
                                }  
                                
                                if($type == 'spsfn') {

                                        $validationMessages['supervisor_certifying'] =  array("uploaded" => "Please upload the supervisor certifying the research work","max_size" => "File size should be below 500KB","ext_in" => "File type should be pdf");
                                }

         return $validationMessages;
    }

    

    public function view($id = '',$award_id = '')
    {

        $id = (!empty($id))?$id:$this->request->getPost('id');

        if(!empty($id)){
            $getUserData = $this->userModel->getUserData($id);
            $edit_data   = $getUserData->getRowArray();
 
            $edit_data['category_name'] = '';
            if(isset($edit_data['category_id'])) {
                $category   = $this->categoryModel->getCategoriesById($edit_data['category_id']);
                $categoryDt = $category->getRowArray();
                $edit_data['category_name'] = $categoryDt['name'];
            }
        }
  
        if (strtolower($this->request->getMethod()) == "post") {

            $this->validation->setRules($this->awards_validation_rules($edit_data['nomination_type']),$this->awardValidationMessages($edit_data['nomination_type']));

          if($this->validation->withRequest($this->request)->run()) {
    

            $nominee_details_data = array();
            $fileUploadDir = 'uploads/'.$edit_data['user_id'];

            if(isset($edit_data['nomination_type'])
                && ($edit_data['nomination_type'] == 'ssan')){

                    if($this->request->getFile('complete_bio_data')) {
                        $complete_bio_data = $this->request->getFile('complete_bio_data');
                        $complete_bio_data->move($fileUploadDir);
                        $nominee_details_data['complete_bio_data'] = $complete_bio_data->getClientName();
                    }
                    
                    if($this->request->getFile('best_papers')) {
                        $best_papers = $this->request->getFile('best_papers');
                        $best_papers->move($fileUploadDir);
                        $nominee_details_data['best_papers'] = $best_papers->getClientName();
                    }    

                    if($this->request->getFile('statement_of_research_achievements')) {
                        $statement_of_research_achievements = $this->request->getFile('statement_of_research_achievements');
                        $statement_of_research_achievements->move($fileUploadDir);
                        $nominee_details_data['statement_of_research_achievements'] = $statement_of_research_achievements->getClientName();
                    }
                    
                    if($this->request->getFile('signed_details')) {
                        $signed_details = $this->request->getFile('signed_details');
                        $signed_details->move($fileUploadDir);
                        $nominee_details_data['signed_details']  = $signed_details->getClientName();
                    }
                    
                    if($this->request->getFile('specific_publications')) {
                        $specific_publications = $this->request->getFile('specific_publications');
                        $specific_publications->move($fileUploadDir);
                        $nominee_details_data['specific_publications'] = $specific_publications->getClientName();
                    }   
                    
                    if($this->request->getFile('signed_statement')) {
                        $signed_statement = $this->request->getFile('signed_statement');
                        $signed_statement->move($fileUploadDir);
                        $nominee_details_data['signed_statement']  = $signed_statement->getClientName();
                    }
                     
                    if($this->request->getFile('citation')){
                        $citation = $this->request->getFile('citation');
                        $citation->move($fileUploadDir);
                        $nominee_details_data['citation']     = $citation->getClientName();
                    }
            }
            else
            {

                if($this->request->getPost('year_of_passing'))
                  $nominee_details_data['year_of_passing'] = $this->request->getPost('year_of_passing');
                
                if($this->request->getPost('number_of_attempts'))  
                  $nominee_details_data['number_of_attempts'] = $this->request->getPost('number_of_attempts');
               
                if($this->request->getFile('complete_bio_data')) {
                    $complete_bio_data = $this->request->getFile('complete_bio_data');
                    $complete_bio_data->move($fileUploadDir);
                    $nominee_details_data['complete_bio_data'] = $complete_bio_data->getClientName();
                }

                if($this->request->getFile('excellence_research_work')) {
                    $excellence_research_work = $this->request->getFile('excellence_research_work');
                    $excellence_research_work->move($fileUploadDir);
                    $nominee_details_data['excellence_research_work']  = $excellence_research_work->getClientName();
                }

                if($this->request->getFile('lists_of_publications')) {
                    $lists_of_publications = $this->request->getFile('lists_of_publications');
                    $lists_of_publications->move($fileUploadDir);
                    $nominee_details_data['lists_of_publications']   = $lists_of_publications->getClientName();
                }

                if($this->request->getFile('statement_of_applicant')) {
                    $statement_of_applicant = $this->request->getFile('statement_of_applicant');
                    $statement_of_applicant->move($fileUploadDir);
                    $nominee_details_data['statement_of_applicant'] = $statement_of_applicant->getClientName();
                }

                if($this->request->getFile('ethical_clearance')) {
                    $ethical_clearance = $this->request->getFile('ethical_clearance');
                    $ethical_clearance->move($fileUploadDir);
                    $nominee_details_data['ethical_clearance'] = $ethical_clearance->getClientName();
                }

                if($this->request->getFile('statement_of_duly_signed_by_nominee')) {
                    $statement_of_duly_signed_by_nominee = $this->request->getFile('statement_of_duly_signed_by_nominee');
                    $statement_of_duly_signed_by_nominee->move($fileUploadDir);
                    $nominee_details_data['statement_of_duly_signed_by_nominee']= $statement_of_duly_signed_by_nominee->getClientName();
                }

                if($this->request->getFile('citation')) {
                    $citation = $this->request->getFile('citation');
                    $citation->move($fileUploadDir);
                    $nominee_details_data['citation'] = $citation->getClientName();
                }

                if($this->request->getFile('aggregate_marks')) {
                    $aggregate_marks = $this->request->getFile('aggregate_marks');
                    $aggregate_marks->move($fileUploadDir);
                    $nominee_details_data['aggregate_marks']  = $aggregate_marks->getClientName();
                }

                if($this->request->getFile('age_proof')) {
                    $age_proof = $this->request->getFile('age_proof');
                    $age_proof->move($fileUploadDir);
                    $nominee_details_data['age_proof']  = $age_proof->getClientName();
                }

                if($this->request->getFile('declaration_candidate')) {
                    $declaration_candidate = $this->request->getFile('declaration_candidate');
                    $declaration_candidate->move($fileUploadDir);
                    $nominee_details_data['declaration_candidate']   = $declaration_candidate->getClientName();
                } 

            }

            $nominee_details_data['is_submitted'] = 1;

            $this->nominationModel->update(array("id" => $edit_data['nominee_detail_id']),$nominee_details_data); 

            //inactive the user
            $this->userModel->update(array("id" => $id),array("active" => 0));

            //sendmail to jury
            $this->sendMailToJury($award_id);


            return redirect()->to('view/'.$edit_data['user_id'])->withInput();

          }
          else
          {  
              if(is_array($this->validation->getErrors()) && count($this->validation->getErrors()) > 0){
                  $this->data['validation'] = $this->validation;
                  $status = 'error';
              }

          }

        } 
            $editdata['id']                                  = ($this->request->getPost('id'))?$this->request->getPost('id'):$id;
            if(isset($edit_data['nomination_type']) && ($edit_data['nomination_type'] == 'ssan')){
                $editdata['complete_bio_data']                   = ($this->request->getFile('complete_bio_data'))?$this->request->getFile('complete_bio_data'):'';
                $editdata['statement_of_research_achievements']  = ($this->request->getFile('statement_of_research_achievements'))?$this->request->getFile('statement_of_research_achievements'):'';
                $editdata['signed_details']                      = ($this->request->getFile('signed_details'))?$this->request->getFile('signed_details'):'';
                $editdata['best_papers']                         = ($this->request->getFile('best_papers'))?$this->request->getFile('best_papers'):'';
                $editdata['specific_publications']               = ($this->request->getFile('specific_publications'))?$this->request->getFile('specific_publications'):'';
                $editdata['signed_statement']                    = ($this->request->getFile('signed_statement'))?$this->request->getFile('signed_statement'):'';
                $editdata['citation']                            = ($this->request->getFile('citation'))?$this->request->getFile('citation'):'';
            }    
            else
            {

                $editdata['complete_bio_data']                    = ($this->request->getFile('complete_bio_data'))?$this->request->getFile('complete_bio_data'):'';
                $editdata['excellence_research_work']             = ($this->request->getFile('excellence_research_work'))?$this->request->getFile('excellence_research_work'):'';
                $editdata['lists_of_publications']                = ($this->request->getFile('lists_of_publications'))?$this->request->getFile('lists_of_publications'):'';
                $editdata['statement_of_applicant']               = ($this->request->getFile('statement_of_applicant'))?$this->request->getFile('statement_of_applicant'):'';
                $editdata['ethical_clearance']                    = ($this->request->getFile('ethical_clearance'))?$this->request->getFile('ethical_clearance'):'';
                $editdata['statement_of_duly_signed_by_nominee']  = ($this->request->getFile('statement_of_duly_signed_by_nominee'))?$this->request->getFile('statement_of_duly_signed_by_nominee'):'';
                $editdata['citation']                             = ($this->request->getFile('citation'))?$this->request->getFile('citation'):'';
                $editdata['aggregate_marks']                      = ($this->request->getFile('aggregate_marks'))?$this->request->getFile('aggregate_marks'):'';
                $editdata['age_proof']                            = ($this->request->getFile('age_proof'))?$this->request->getFile('age_proof'):'';
                $editdata['declaration_candidate']                = ($this->request->getFile('declaration_candidate'))?$this->request->getFile('declaration_candidate'):'';
                $editdata['year_of_passing']                      = ($this->request->getPost('year_of_passing'))?$this->request->getPost('year_of_passing'):'';
                $editdata['number_of_attempts']                   = ($this->request->getPost('number_of_attempts'))?$this->request->getPost('number_of_attempts'):'';
                $editdata['ongoing_course']                       = ($this->request->getPost('ongoing_course'))?$this->request->getPost('ongoing_course'):'';
                $editdata['research_project']                     = ($this->request->getPost('research_project'))?$this->request->getPost('research_project'):'';

            } 
        
        $this->data['editdata'] = $editdata;

        $this->data['user']     = $edit_data;
      
        return  render('frontend/preview',$this->data);
                                 
    }

    public function check_if_loggedin($id='')
    {
        return redirect()->to('view/'.$id); 
    }

    public function getPostedData()
    {
       
            $editdata = array();

            $editdata['nominee_name']                   = $this->request->getPost('nominee_name');
            $editdata['citizenship']                    = $this->request->getPost('citizenship');
            $editdata['category']                       = $this->request->getPost('category');
            $editdata['date_of_birth']                  = $this->request->getPost('date_of_birth');
            $editdata['designation_and_office_address'] = $this->request->getPost('designation_and_office_address');
            $editdata['residence_address']              = $this->request->getPost('residence_address');
            $editdata['mobile_no']                      = $this->request->getPost('mobile_no');
            $editdata['email']                          = $this->request->getPost('email');
            $editdata['nominator_name']                 = $this->request->getPost('nominator_name');
            $editdata['nominator_office_address']       = $this->request->getPost('nominator_office_address');
            $editdata['nominator_mobile']               = $this->request->getPost('nominator_mobile');
            $editdata['nominator_email']                = $this->request->getPost('nominator_email');

            $formtype                                   = $this->request->getPost('formType');

            if($formtype == 'spsfn'){
                $editdata['ongoing_course']                 = $this->request->getPost('ongoing_course');
                $editdata['research_project']               = $this->request->getPost('research_project');
            }

            if(!empty($editdata['category'])) {
                $getCategoryLists   = $this->categoryModel->getCategoriesById($editdata['category']);
                $categoryRw         = $getCategoryLists->getRowArray();
                $editdata['category'] =    $categoryRw['name'];
            }
            if(!empty($editdata['citizenship'])) {
                $editdata['citizenship'] = ($editdata['citizenship'] ==1)?'Indian':'Other';
            }

            $getSessionFiles = getSessionData('uploadedFile');
          
            if($this->request->getFile('nominator_photo')!='') {
                //nominator photo
                $nominator_pht = file_get_contents($this->request->getFile('nominator_photo'));
            } 
            else
            { 
                $nominator_pht = ($getSessionFiles['nominator_photo']!='')?file_get_contents(getFileInfo($getSessionFiles['nominator_photo'])):'';
            }  
            
            $editdata['nominator_photo'] = 'data:image/jpeg;base64,'.base64_encode($nominator_pht);

            if($this->request->getFile('justification_letter')!=''){
                $justification_lt = file_get_contents($this->request->getFile('justification_letter'));
            }
            else
            {
                $justification_lt = ($getSessionFiles['justification_letter']!='')?file_get_contents(getFileInfo($getSessionFiles['justification_letter'])):'';
            }
          //  print_r($justification_lt); die;
            $editdata['justification_letter'] = 'data:application/pdf;base64,'.chunk_split(base64_encode($justification_lt));

            if($formtype == 'ssan' && $this->request->getFile('passport')!=''){
               
                if($this->request->getFile('passport')!=''){
                    $passport_ft = file_get_contents($this->request->getFile('passport')); 
                }
                else
                {
                    $passport_ft = ($getSessionFiles['passport']!='')?file_get_contents(getFileInfo($getSessionFiles['passport'])):'';
                }

                if($passport_ft!='')
                    $editdata['passport'] = 'data:application/pdf;base64,'.chunk_split(base64_encode($passport_ft));
           }
        
            if($formtype == 'spsfn'){
                if($this->request->getFile('supervisor_certifying')!=''){
                    $supervisor_certifying = file_get_contents($this->request->getFile('supervisor_certifying'));     
                }
                else
                {
                    $supervisor_certifying = ($getSessionFiles['supervisor_certifying']!='')?file_get_contents(getFileInfo($getSessionFiles['supervisor_certifying'])):'';
                }

                $editdata['supervisor_certifying'] = 'data:application/pdf;base64,'.chunk_split(base64_encode($supervisor_certifying));
           }
            $this->data['editdata']  = $editdata;

            $filename          = ($formtype == 'ssan')?'frontend/ssan_preview':'frontend/spsfn_preview';

            return   $html = view($filename,$this->data,array('debug' => false)); 
    }


    public function awards_validation_rules($type = '')
    {
        $validation_rules = array();
      
        if($type == 'ssan') {
                $validation_rules['complete_bio_data']                  = array("label" => "Complete Bio Data",'rules' => 'uploaded[complete_bio_data]|max_size[complete_bio_data,1500]|ext_in[complete_bio_data,pdf]');
                $validation_rules['best_papers']                        = array("label" => "Best Papers",'rules' => 'uploaded[best_papers]|max_size[best_papers,1000]|ext_in[best_papers,pdf]');
                $validation_rules['statement_of_research_achievements'] = array("label" => "Statement of Research Achievements",'rules' => 'uploaded[statement_of_research_achievements]|max_size[statement_of_research_achievements,1000]|ext_in[statement_of_research_achievements,pdf]');
                $validation_rules['signed_details']                     = array("label" => "Signed Details",'rules' => 'uploaded[signed_details]|max_size[signed_details,2500]|ext_in[signed_details,pdf]');
                $validation_rules['specific_publications']              = array("label" => "Specific Publications",'rules' => 'uploaded[specific_publications]|max_size[specific_publications,2500]|ext_in[specific_publications,pdf]');
                $validation_rules['signed_statement']                   = array("label" => "Signed Statement",'rules' => 'uploaded[signed_statement]|max_size[signed_statement,500]|ext_in[signed_statement,pdf]');
                $validation_rules['citation']                           = array("label" => "Citation",'rules' => 'uploaded[citation]|max_size[citation,300]|ext_in[citation,pdf]');
        }
        else
        {
                $validation_rules['complete_bio_data']                  = array("label" => "Complete Bio Data",'rules' => 'uploaded[complete_bio_data]|max_size[complete_bio_data,1000]|ext_in[complete_bio_data,pdf]');
                $validation_rules['excellence_research_work']           = array("label" => "Excellence Research Work",'rules' => 'uploaded[excellence_research_work]|max_size[excellence_research_work,2000]|ext_in[excellence_research_work,pdf]');
                $validation_rules['lists_of_publications']              = array("label" => "Lists of Publications",'rules' => 'uploaded[lists_of_publications]|max_size[lists_of_publications,2000]|ext_in[lists_of_publications,pdf]');
                $validation_rules['statement_of_applicant']             = array("label" => "Statement Of Applicant",'rules' => 'uploaded[statement_of_applicant]|max_size[statement_of_applicant,1000]|ext_in[statement_of_applicant,pdf]');
                $validation_rules['ethical_clearance']                  = array("label" => "Ethical Clearance",'rules' => 'uploaded[ethical_clearance]|max_size[ethical_clearance,250]|ext_in[ethical_clearance,pdf]');
                $validation_rules['statement_of_duly_signed_by_nominee']= array("label" => "Statement of duly signed",'rules' => 'uploaded[statement_of_duly_signed_by_nominee]|max_size[statement_of_duly_signed_by_nominee,250]|ext_in[statement_of_duly_signed_by_nominee,pdf]');
                $validation_rules['citation']                           = array("label" => "Citation",'rules' => 'uploaded[citation]|max_size[citation,300]|ext_in[citation,pdf]');
                $validation_rules['aggregate_marks']                    = array("label" => "Aggregate Marks",'rules' => 'uploaded[aggregate_marks]|max_size[aggregate_marks,250]|ext_in[aggregate_marks,pdf]');
                $validation_rules['year_of_passing']                    = array("label" => "Year of Passing",'rules' => 'required');
                $validation_rules['number_of_attempts']                 = array("label" => "Number of attempts",'rules' => 'required');
                $validation_rules['age_proof']                          = array("label" => "Age Proof",'rules' => 'uploaded[age_proof]|max_size[age_proof,250]|ext_in[age_proof,pdf]');
                $validation_rules['declaration_candidate']              = array("label" => "Declaration Candidate",'rules' => 'uploaded[declaration_candidate]|max_size[declaration_candidate,250]|ext_in[declaration_candidate,pdf]');
        }
        return $validation_rules;
    }

    public function sendMail($nominee_name,$nomination_no,$nominee_email)
    {

        $admin_url = base_url()."/admin";
        $header  = '';
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        $subject = " Approve Nomination - Sun Pharma Science Foundation ";
        $message  = "Dear Admin,";
        $message .= '<br/><br/>';
        $message .=  ucfirst($nominee_name)." with <b>Nomination No: ".$nomination_no."</b> has submitted his/her nomination and is waiting for your approval";
        $message .= "<br/><br/>";
        $message .=  "Please <a href='". $admin_url."'>click here</a> to approve his/her nomination.";
        $message .= "<br/><br/><br/>";
        $message .= "Thanks & Regards,";
        $message .= "<br/>";
        $message .= "Sunpharma Science Foundation Team";
       
        $this->data['content'] = $message;
       // $html = view('email/mail',$this->data,array('debug' => false));
     //   mail("punitha@izaaptech.in",$subject,$html,$header);
        sendMail('rafi@izaaptech.com',$subject,$message);


        $header  = '';
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        $subject  = "Thank you - Sun Pharma Science Foundation ";
        $message  = "Hi ".ucfirst($nominee_name).",";
        $message .= '<br/><br/>';
        $message .= 'Your application is under review , you should receive an email soon.';
        $message .= "<br/><br/><br/>";
        $message .= "Thanks & Regards,";
        $message .= "<br/>";
        $message .= "Sunpharma Science Foundation Team";
       
        $this->data['content'] = $message;
       // $html = view('email/mail',$this->data,array('debug' => false));
       // mail($nominee_email,$subject,$html,$header);
       sendMail($nominee_email,$subject,$message);

    }

    public function sendMailToJury($award_id = ''){

        $header  = '';
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        $login_url = base_url().'/admin';

        $subject  = "New Nomination - Sun Pharma Science Foundation ";
       

        $juryLists = $this->juryModel->getAwardMappingLists($award_id);

        if(is_array($juryLists) && count($juryLists) > 0){
            foreach($juryLists as $jkey=>$jvalue){
                if(isset($jvalue['email']) && !empty($jvalue['email'])){
                    $message  = "Hi ".ucfirst($jvalue['firstname']).",";
                    $message .= '<br/><br/>';
                    $message .= 'Please <a href="'.$login_url.'">Click Here</a> to login and check the nominations.';
                    $message .= "<br/><br/><br/>";
                    $message .= "Thanks & Regards,";
                    $message .= "<br/>";
                    $message .= "Sunpharma Science Foundation Team";
                   
                    $this->data['content'] = $message;
                  //  $html = view('email/mail',$this->data,array('debug' => false));
                  //   mail($jvalue['email'],$subject,$html,$header);
                  sendMail($jvalue['email'],$subject,$message);
                }
            }
        }
    }

    public function success()
    {
        return render('frontend/success', $this->data);
    }


    public function getRequestedData($type='',$requestType='')
    {

        
        $editdata['category']                      = ($this->request->getPost('category'))?$this->request->getPost('category'):'';
        $editdata['nominee_name']                  = ($this->request->getPost('nominee_name'))?$this->request->getPost('nominee_name'):'';
        $editdata['citizenship']                   = ($this->request->getPost('citizenship'))?$this->request->getPost('citizenship'):'';
        $editdata['designation_and_office_address']= ($this->request->getPost('designation_and_office_address'))?$this->request->getPost('designation_and_office_address'):'';
        $editdata['residence_address']             = ($this->request->getPost('residence_address'))?$this->request->getPost('residence_address'):'';
        $editdata['email']                         = ($this->request->getPost('email'))?$this->request->getPost('email'):'';
        $editdata['mobile_no']                     = ($this->request->getPost('mobile_no'))?$this->request->getPost('mobile_no'):'';
        $editdata['date_of_birth']                 = ($this->request->getPost('date_of_birth'))?$this->request->getPost('date_of_birth'):'';
        $editdata['nominator_name']                = ($this->request->getPost('nominator_name'))?$this->request->getPost('nominator_name'):'';
        $editdata['nominator_mobile']              = ($this->request->getPost('nominator_mobile'))?$this->request->getPost('nominator_mobile'):'';
        $editdata['nominator_email']               = ($this->request->getPost('nominator_email'))?$this->request->getPost('nominator_email'):'';
        $editdata['nominator_office_address']      = ($this->request->getPost('nominator_office_address'))?$this->request->getPost('nominator_office_address'):'';
        $editdata['id']                            = ($this->request->getPost('id'))?$request->getPost('id'):'';
      
        $documentRoot =  $_SERVER['DOCUMENT_ROOT'];

        //folder path
        $uploadedFolderPath = 'uploads/nominations/';

        $files = array('nominator_photo' => '','justification_letter' => '',
                       'supervisor_certifying'=> '','passport' =>'',
                        'nominator_photo_name'=>'','passport_name'=>'',
                        'justification_letter_name' =>'','supervisor_certifying_name' =>'');
       
        
        if($type == 'ssan'){

            if($this->request->getFile('nominator_photo')!=''){
                $editdata['nominator_photo_name'] = $this->request->getFile('nominator_photo')->getName();
                $photo = $this->request->getFile('nominator_photo');
                $photo->move($uploadedFolderPath);
                $files['nominator_photo'] = $documentRoot.'/'.$uploadedFolderPath.$photo->getClientName();
                $files['nominator_photo_name'] = $editdata['nominator_photo_name'];
            } 

            if($this->request->getFile('justification_letter')!='') {
                $editdata['justification_letter_name'] = $this->request->getFile('justification_letter')->getName();
                $letter_name =  $this->request->getFile('justification_letter');
                $letter_name->move($uploadedFolderPath);
                $files['justification_letter'] = $documentRoot.'/'.$uploadedFolderPath.$letter_name->getClientName();
                $files['justification_letter_name'] = $editdata['justification_letter_name'];
            }   
             //passport
           
             if($this->request->getFile('passport')!='') {
                $editdata['passport_name'] = $this->request->getFile('passport')->getName();
                $passport_name =  $this->request->getFile('passport');
                $passport_name->move($uploadedFolderPath);
                $files['passport'] = $documentRoot.'/'.$uploadedFolderPath.$passport_name->getClientName();
                $files['passport_name'] = $editdata['passport_name'];
             }
 
          //  $editdata['justification_letter']          = ($this->request->getFile('justification_letter'))?$this->request->getFile('justification_letter'):'';
          //  $editdata['passport']                      = ($this->request->getFile('passport'))?$this->request->getFile('passport'):'';
          //  $editdata['nominator_photo']               = ($this->request->getFile('nominator_photo'))?$this->request->getFile('nominator_photo'):'';
        }
        else
        {

          
            if($this->request->getFile('nominator_photo')!=''){
                $editdata['nominator_photo_name'] = $this->request->getFile('nominator_photo')->getName();
                $photo = $this->request->getFile('nominator_photo');
                $photo->move($uploadedFolderPath);
                $files['nominator_photo'] = $documentRoot.'/'.$uploadedFolderPath.$photo->getClientName();
                $files['nominator_photo_name'] = $editdata['nominator_photo_name'];
            }    

            //justification letter
           
            if($this->request->getFile('justification_letter')!='') {
                $editdata['justification_letter_name'] = $this->request->getFile('justification_letter')->getName();
                $letter_name =  $this->request->getFile('justification_letter');
                $letter_name->move($uploadedFolderPath);
                $files['justification_letter'] = $documentRoot.'/'.$uploadedFolderPath.$letter_name->getClientName();
                $files['justification_letter_name'] = $editdata['justification_letter_name'];
            }   

            //supervisor
            
            if($this->request->getFile('supervisor_certifying')!='') {
               $editdata['supervisor_certifying_name'] = $this->request->getFile('supervisor_certifying')->getName();
               $supervisor_name =  $this->request->getFile('supervisor_certifying');
               $supervisor_name->move($uploadedFolderPath);
               $files['supervisor_certifying'] = $documentRoot.'/'.$uploadedFolderPath.$supervisor_name->getClientName();
               $files['supervisor_certifying_name'] = $editdata['supervisor_certifying_name'];
            }   

           } 


            if(count($files) > 0 && ($files['nominator_photo']!='' || $files['justification_letter'] != '' || $files['supervisor_certifying']!='' || $files['passport']!=''))
              setSessionData('uploadedFile',$files);

            //already uploaded files get
            $getSessionFiles = getSessionData('uploadedFile');

         //   print_r($getSessionFiles); 

            if(is_array($getSessionFiles) && count($getSessionFiles) > 0 && $requestType == 'ajax') {
                $nominatorSessionDt = (isset($getSessionFiles['nominator_photo']) && $getSessionFiles['nominator_photo']!='')?getFileInfo($getSessionFiles['nominator_photo']):'';
                $letterSessionDt = (isset($getSessionFiles['justification_letter']) && $getSessionFiles['justification_letter']!='')?getFileInfo($getSessionFiles['justification_letter']):'';
                $supervisorSessionDt = (isset($getSessionFiles['supervisor_certifying']) && $getSessionFiles['supervisor_certifying']!='')?getFileInfo($getSessionFiles['supervisor_certifying']):'';
                $passportDt = (isset($getSessionFiles['passport']) && $getSessionFiles['passport']!='')?getFileInfo($getSessionFiles['passport']):'';
                $editdata['passport_name'] =  $getSessionFiles['passport_name'];
                $editdata['supervisor_certifying_name'] =  $getSessionFiles['supervisor_certifying_name'];
                $editdata['justification_letter_name'] =  $getSessionFiles['justification_letter_name'];
                $editdata['nominator_photo_name'] =  $getSessionFiles['nominator_photo_name'];
            }
            else
            {
                $nominatorSessionDt = ''; $letterSessionDt= ''; $supervisorSessionDt='';
                $passportDt = '';
                $editdata['passport_name'] = '';
                $editdata['supervisor_certifying_name'] = '';
                $editdata['justification_letter_name']  = '';
                $editdata['nominator_photo_name'] = '';

            }
            
            $nominatorPt = ($this->request->getFile('nominator_photo')!='')?$this->request->getFile('nominator_photo'):$nominatorSessionDt;
            $justificationLt = ($this->request->getFile('justification_letter')!='')?$this->request->getFile('justification_letter'):$letterSessionDt;
            $supervisorCt = ($this->request->getFile('supervisor_certifying')!='')?$this->request->getFile('supervisor_certifying'):$supervisorSessionDt;
            $passportCt = ($this->request->getFile('passport')!='')?$this->request->getFile('passport'):$passportDt;


            $editdata['ongoing_course']              = ($this->request->getPost('ongoing_course'))?$this->request->getPost('ongoing_course'):'';
            $editdata['research_project']            = ($this->request->getPost('research_project'))?$this->request->getPost('research_project'):'';
            $editdata['supervisor_certifying']       = $supervisorCt;
            $editdata['justification_letter']        = $justificationLt;
            $editdata['nominator_photo']             = $nominatorPt;
            $editdata['passport']                    = $passportCt;

        

        return $editdata;
    }


    public function get_new_csrf_token()
    {
     
        if($this->request->isAJAX()){
        
            return $this->response->setJSON([
                'status'            => 'success',
                'token'             => csrf_hash()
            ]); 
            die;
        }
        
    }

    public function close()
    {
        return  render('frontend/nomination_close',$this->data);
    }

    public function checkUniqueEmailForAward(){

        if (strtolower($this->request->getMethod()) == "post") {
           // echo $this->request->getMethod(); die;
          //  if($this->validation->withRequest($this->request)->run()) {

                $email    = $this->request->getPost('email');
                $award_id = $this->request->getPost('award_id');

                $checkUserData = $this->userModel->checkUniqueEmail(array("email"=> $email,"award_id" => $award_id,"role" => 2));
              //print_r($checkUserData); die;
                if(is_array($checkUserData) && count($checkUserData) > 0){
                    if($this->request->isAJAX()){
                        return $this->response->setJSON([
                            'status'   => 'error',
                            'message'  => 'Already email registered for this Award Category'
                        ]); 
                        die;
                    }
                   
                }
                else
                {
                    if($this->request->isAJAX()){
                        return $this->response->setJSON([
                            'status'   => 'success',
                            'message'  => 'Available'
                        ]); 
                        die;
                    }
                }
         }         

    }

  

    public function print($nominee_id = '')
    {

        //get nominee data
        if(!empty($nominee_id)){

             // Creating the new document...
            $phpWord = new \PhpOffice\PhpWord\PhpWord();

            $header = ['size' => 16, 'bold' => true];
            $section = $phpWord->addSection();
            
            $getUserData = $this->userModel->getUserData($nominee_id);
            $nomineeData = $getUserData->getRowArray();
 
            $nomineeData['category_name'] = '';
            if(isset($nomineeData['category_id'])) {
                $category   = $this->categoryModel->getCategoriesById($nomineeData['category_id']);
                $categoryDt = $category->getRowArray();
                $nomineeData['category_name'] = $categoryDt['name'];
            }

            $nomineeData['award'] = '';
            if(isset($nomineeData['award_id'])) {
                $awardDt   = $this->nominationTypesModel->getListsOfNominations($nomineeData['award_id']);
                $awardDt   = $awardDt->getRowArray();
                $nomineeData['award'] = $awardDt['title'];
            }

            //Nomination type
            $nominationType = ($awardDt['main_category_id']=='1')?'Research Awards':'Science Scholar Awards';
            $nominationType = 'Nomination of '.$nominationType.' - 2022'; 
            $section->addTextBreak(1);
            $section->addText($nominationType, $header);

            $fancyTableStyleName = 'Fancy Table';
            $fancyTableStyle = ['borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 50];
            $fancyTableFirstRowStyle = ['borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF'];
            $fancyTableCellStyle = ['valign' => 'center'];
            $fancyTableCellBtlrStyle = ['valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR];
            $fancyTableFontStyle = ['bold' => true];
            $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
            $table = $section->addTable($fancyTableStyleName);

            $uploadDir = base_url().'/uploads/'.$nominee_id.'/';

            $wrappingStyles = ['inline', 'behind', 'infront', 'square', 'tight'];

            $table->addRow(900);
            $table->addCell(2000, $fancyTableCellStyle)->addText('Applicant Photo', $fancyTableFontStyle);
            $table->addCell(2000)->addImage($uploadDir.$nomineeData['nominator_photo'],array(
                'positioning' => 'relative',
                'marginTop' => -1,
                'marginLeft' => 1,
                'marginBottom' => 1,
                'width' => 80,
                'height' => 45 
            ));

            $table->addRow(900);
            $table->addCell(2000, $fancyTableCellStyle)->addText('Award', $fancyTableFontStyle);
            $table->addCell(2000)->addText($nomineeData['award']);

            $table->addRow();
            $table->addCell(2000, $fancyTableCellStyle)->addText('Award Type', $fancyTableFontStyle);
            $table->addCell(2000)->addText($nomineeData['category_name']);

            $table->addRow();
            $table->addCell(2000, $fancyTableCellStyle)->addText('Nomination No', $fancyTableFontStyle);
            $table->addCell(2000)->addText($nomineeData['registration_no']);
   
            $table->addRow();
            $table->addCell(2000, $fancyTableCellStyle)->addText('Name', $fancyTableFontStyle);
            $table->addCell(2000)->addText($nomineeData['firstname'].' '.$nomineeData['lastname']);

            $table->addRow();
            $table->addCell(2000, $fancyTableCellStyle)->addText('Date of Birth', $fancyTableFontStyle);
            $table->addCell(2000)->addText($nomineeData['dob']);

            $table->addRow();
            $table->addCell(2000, $fancyTableCellStyle)->addText('Email', $fancyTableFontStyle);
            $table->addCell(2000)->addText($nomineeData['email']);

            $table->addRow();
            $table->addCell(2000, $fancyTableCellStyle)->addText('Mobile No', $fancyTableFontStyle);
            $table->addCell(2000)->addText($nomineeData['phone']);

            $table->addRow();
            $table->addCell(2000, $fancyTableCellStyle)->addText('Gender', $fancyTableFontStyle);
            $table->addCell(2000)->addText($nomineeData['gender']);

            $table->addRow();
            $table->addCell(2000, $fancyTableCellStyle)->addText('Address', $fancyTableFontStyle);
            $table->addCell(2000)->addText($nomineeData['address']);

            $table->addRow();
            $table->addCell(2000, $fancyTableCellStyle)->addText('Residence Address', $fancyTableFontStyle);
            $table->addCell(2000)->addText($nomineeData['residence_address']);

            $table->addRow();
            $table->addCell(2000, $fancyTableCellStyle)->addText('Designation', $fancyTableFontStyle);
            $table->addCell(2000)->addText($nomineeData['designation']);

            $table->addRow();
            $table->addCell(2000, $fancyTableCellStyle)->addText('Nominator Name', $fancyTableFontStyle);
            $table->addCell(2000)->addText($nomineeData['nominator_name']);

            $table->addRow();
            $table->addCell(2000, $fancyTableCellStyle)->addText('Nominator Email', $fancyTableFontStyle);
            $table->addCell(2000)->addText($nomineeData['nominator_email']);

            $table->addRow();
            $table->addCell(2000, $fancyTableCellStyle)->addText('Nominator Mobile', $fancyTableFontStyle);
            $table->addCell(2000)->addText($nomineeData['nominator_phone']);


            $table->addRow();
            $table->addCell(2000, $fancyTableCellStyle)->addText('Nominator Designation', $fancyTableFontStyle);
            $table->addCell(2000)->addText($nomineeData['nominator_designation']);

            $table->addRow();
            $table->addCell(2000, $fancyTableCellStyle)->addText('Nominator Address', $fancyTableFontStyle);
            $table->addCell(2000)->addText($nomineeData['nominator_address']);

            

            $table->addRow();
            $table->addCell(2000, $fancyTableCellStyle)->addText('Justification Letter', $fancyTableFontStyle);
            $table->addCell(2000)->addLink($uploadDir.$nomineeData['justification_letter_filename']);

            $table->addRow();
            $table->addCell(2000, $fancyTableCellStyle)->addText('Bio-Data', $fancyTableFontStyle);
            $table->addCell(2000)->addLink($uploadDir.$nomineeData['complete_bio_data']);

            

            if($nomineeData['nomination_type'] == 'spsfn'){
    
                    $table->addRow();
                    $table->addCell(2000, $fancyTableCellStyle)->addText('Supervisor Certifying Research Work', $fancyTableFontStyle);
                    $table->addCell(2000)->addLink($uploadDir.$nomineeData['supervisor_certifying']);

                    $table->addRow();
                    $table->addCell(2000, $fancyTableCellStyle)->addText('Excellence Research Work', $fancyTableFontStyle);
                    $table->addCell(2000)->addLink($uploadDir.$nomineeData['excellence_research_work']);

                    $table->addRow();
                    $table->addCell(2000, $fancyTableCellStyle)->addText('Lists of Publications', $fancyTableFontStyle);
                    $table->addCell(2000)->addLink($uploadDir.$nomineeData['lists_of_publications']);

                    $table->addRow();
                    $table->addCell(2000, $fancyTableCellStyle)->addText('Statement of Applicant', $fancyTableFontStyle);
                    $table->addCell(2000)->addLink($uploadDir.$nomineeData['statement_of_applicant']);

                    $table->addRow();
                    $table->addCell(2000, $fancyTableCellStyle)->addText('Ethical Clearance', $fancyTableFontStyle);
                    $table->addCell(2000)->addLink($uploadDir.$nomineeData['ethical_clearance']);

                    $table->addRow();
                    $table->addCell(2000, $fancyTableCellStyle)->addText('Statement of duly signed by Nominee', $fancyTableFontStyle);
                    $table->addCell(2000)->addLink($uploadDir.$nomineeData['statement_of_duly_signed_by_nominee']);

                    $table->addRow();
                    $table->addCell(2000, $fancyTableCellStyle)->addText('Citation', $fancyTableFontStyle);
                    $table->addCell(2000)->addLink($uploadDir.$nomineeData['citation']);

                    $table->addRow();
                    $table->addCell(2000, $fancyTableCellStyle)->addText('Aggregate Marks', $fancyTableFontStyle);
                    $table->addCell(2000)->addLink($uploadDir.$nomineeData['aggregate_marks']);


                    $table->addRow();
                    $table->addCell(2000, $fancyTableCellStyle)->addText('Age Proof', $fancyTableFontStyle);
                    $table->addCell(2000)->addLink($uploadDir.$nomineeData['age_proof']);

                    $table->addRow();
                    $table->addCell(2000, $fancyTableCellStyle)->addText('Declaration Candidate', $fancyTableFontStyle);
                    $table->addCell(2000)->addLink($uploadDir.$nomineeData['declaration_candidate']);
                
            }
            else
            {
                

                $table->addRow();
                $table->addCell(2000, $fancyTableCellStyle)->addText('Passport', $fancyTableFontStyle);
                $table->addCell(2000)->addLink($uploadDir.$nomineeData['passport_filename']);

                $table->addRow();
                $table->addCell(2000, $fancyTableCellStyle)->addText('Research Work', $fancyTableFontStyle);
                $table->addCell(2000)->addLink($uploadDir.$nomineeData['signed_details']);

                $table->addRow();
                $table->addCell(2000, $fancyTableCellStyle)->addText('Citation', $fancyTableFontStyle);
                $table->addCell(2000)->addLink($uploadDir.$nomineeData['citation']);

                $table->addRow();
                $table->addCell(2000, $fancyTableCellStyle)->addText('Signed Statement', $fancyTableFontStyle);
                $table->addCell(2000)->addLink($uploadDir.$nomineeData['signed_statement']);

                $table->addRow();
                $table->addCell(2000, $fancyTableCellStyle)->addText('Publications', $fancyTableFontStyle);
                $table->addCell(2000)->addLink($uploadDir.$nomineeData['specific_publications']);

                $table->addRow();
                $table->addCell(2000, $fancyTableCellStyle)->addText('Best Papers', $fancyTableFontStyle);
                $table->addCell(2000)->addLink($uploadDir.$nomineeData['best_papers']);

                $table->addRow();
                $table->addCell(2000, $fancyTableCellStyle)->addText('Award Received', $fancyTableFontStyle);
                $table->addCell(2000)->addLink($uploadDir.$nomineeData['statement_of_research_achievements']);

                

            }     
            
            $firstname = $nomineeData['firstname'];

            if ( preg_match('/\s/',$firstname) ){
              $firstname = str_replace(' ', '_', $firstname);
            }

             $filename = $firstname.'.docx';
             $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
             $xmlWriter->save("php://output");
             header("Content-Description: File Transfer");
             header('Content-Disposition: attachment; filename='.$filename);
             header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
             header('Content-Transfer-Encoding: binary');
             header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
             header('Expires: 0');
           


        }
       
        
       
    }


    public function awardValidationMessages($type='')
    {
        $awardValidationMessages = array();
        if($type == 'ssan') {
            
            $awardValidationMessages = array("complete_bio_data" => array("uploaded" => "Please upload the Bio-data","max_size" => "File size should be below 1.5MB","ext_in" => "File type should be pdf"),
                                                "best_papers" => array("uploaded" => "Please upload the Best Papers","max_size" => "File size should be below 1MB","ext_in" => "File type should be pdf"),
                                                "statement_of_research_achievements" => array("uploaded" => "Please upload the Research Achievements","max_size" => "File size should be below 1MB","ext_in" => "File type should be pdf"),
                                                "signed_details" => array("uploaded" => "Please upload the Signed Details","max_size" => "File size should be below 2.5MB","ext_in" => "File type should be pdf"),
                                                "specific_publications" => array("uploaded" => "Please upload the Specific Publications","max_size" => "File size should be below 2.5MB","ext_in" => "File type should be pdf"),
                                                "signed_statement" => array("uploaded" => "Please upload the Signed Statement","max_size" => "File size should be below 500KB","ext_in" => "File type should be pdf"),
                                                "citation" => array("uploaded" => "Please upload the Citation","max_size" => "File size should be below 300KB","ext_in" => "File type should be pdf")
                                            );
            }
            else
            {
                
                    $awardValidationMessages = array(   "complete_bio_data" => array("uploaded" => "Please upload the Bio-data","max_size" => "File size should be below 1MB","ext_in" => "File type should be pdf"),
                                                        "excellence_research_work" => array("uploaded" => "Please upload the Excellence Research Work","max_size" => "File size should be below 1MB","ext_in" => "File type should be pdf"),
                                                        "lists_of_publications" => array("uploaded" => "Please upload the Publications","max_size" => "File size should be below 1MB","ext_in" => "File type should be pdf"),
                                                        "statement_of_applicant" => array("uploaded" => "Please upload the Statement","max_size" => "File size should be below 2.5MB","ext_in" => "File type should be pdf"),
                                                        "ethical_clearance" => array("uploaded" => "Please upload the Ethical Clearance","max_size" => "File size should be below 2.5MB","ext_in" => "File type should be pdf"),
                                                        "statement_of_duly_signed_by_nominee" => array("uploaded" => "Please upload the Statement of duly signed by nominee","max_size" => "File size should be below 500KB","ext_in" => "File type should be pdf"),
                                                        "citation" => array("uploaded" => "Please upload the Citation","max_size" => "File size should be below 300KB","ext_in" => "File type should be pdf"),
                                                        "aggregate_marks" => array("uploaded" => "Please upload the Aggregate Marks","max_size" => "File size should be below 300KB","ext_in" => "File type should be pdf"),
                                                        "year_of_passing" => array("required" => "Please enter year of passing"),
                                                        "number_of_attempts" => array("required" => "Please enter number of attempts"),
                                                        "age_proof" => array("uploaded" => "Please upload the Age Proof","max_size" => "File size should be below 300KB","ext_in" => "File type should be pdf"),
                                                        "declaration_candidate" => array("uploaded" => "Please upload the Declaration Candidate","max_size" => "File size should be below 300KB","ext_in" => "File type should be pdf")
                                                );
            }
        
          return $awardValidationMessages;
    }
    
}
