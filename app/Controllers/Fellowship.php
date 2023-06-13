<?php

namespace App\Controllers;

class Fellowship extends BaseController
{
    public function index($award_id = '')
    {

            $getCategoryLists   = $this->categoryModel->getCategoriesByType('Clinical Research Fellowship');
            
            $this->data['categories'] = $getCategoryLists->getResultArray();

            $getSessionFiles = getSessionData('uploadedFile');
            
            if (strtolower($this->request->getMethod()) == "post") {

                $this->validation->setRules($this->validation_rules('fellowship',$award_id,$getSessionFiles),$this->validationMessages('fellowship'));

                if($this->validation->withRequest($this->request)->run()) {

                        $formTypeStatus = $this->request->getPost('formTypeStatus');

                        if($formTypeStatus && $formTypeStatus == 'preview') {
                               
                                $html = $this->getPostedData('fellowship');

                                if($this->request->isAJAX()){
                                    return $this->response->setJSON([
                                        'status' => 'success',
                                        'message' => 'preview',
                                        'html' => $html
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
                            $ins_data['extend_date']= $awardData['end_date'];
                            $ins_data['award_id']   = $award_id;
                            $ins_data['active']     = '0';
                            $ins_data['review_status'] = 'Pending';

                            $nominee_details_data = array();
                            $nominee_details_data['category_id']        = $category;
                            $nominee_details_data['citizenship']        = $citizenship;
                            $nominee_details_data['nomination_type']    = 'fellowship';
                            $nominee_details_data['residence_address']  = $residence_address;
                            $nominee_details_data['nominator_name']     = $nominator_name;
                            $nominee_details_data['nominator_email']    = $nominator_email;
                            $nominee_details_data['nominator_phone']    = $nominator_mobile;
                            $nominee_details_data['nominator_address']  = $nominator_office_address;
                          //  $nominee_details_data['ongoing_course']    = $ongoing_course;
                          //  $nominee_details_data['is_completed_a_research_project']  = $research_project;
                            $nominee_details_data['is_submitted'] = 0;
                            $nominee_details_data['nomination_year'] = date('Y');

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
                            
                            $nominee_details_data['nominee_id'] = $lastInsertID;
                           
                            $this->nominationModel->save($nominee_details_data);

                            $registrationID = $this->nominationModel->insertID();

                            $registrationNo = date('Y')."/CRF-".$registrationID;

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
            $this->data['editdata'] = $this->getRequestedData('fellowship','ajax');
            $html = view('frontend/fellowship',$this->data,array('debug' => false));
            return $this->response->setJSON([
                'status'            => $status,
                'html'              => $html
            ]); 
            die;
        }
        else
        {
            $this->data['editdata'] = $this->getRequestedData('fellowship','no');
            return  render('frontend/fellowship',$this->data);        
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

            if(!isset($session['justification_letter']))
                $validation_rules['justification_letter'] = array("label" => "Justification Letter",'rules' => 'uploaded[justification_letter]|max_size[justification_letter,500]|ext_in[justification_letter,pdf]');
                   
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
                                   // "nominator_photo" => array("uploaded" => "Please upload the photo","max_size" => "File size should be below 500KB")
                              );

                                
         return $validationMessages;
    }

    

    public function view($id = '',$award_id = '')
    {

            $id       = (!empty($id))?$id:$this->request->getPost('id');
        
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

                        $name_of_institution_location       = $this->request->getPost('first_employment_name_of_institution_location');
                        $employment_designation             = $this->request->getPost('first_employment_designation');
                        $employment_year_of_joning          = $this->request->getPost('first_employment_year_of_joining');
                        $medical_degree_name_of_degree      = $this->request->getPost('first_medical_degree_name_of_degree');
                        $medical_degree_year_of_award       = $this->request->getPost('first_medical_degree_year_of_award');
                        $medical_degree_institution         = $this->request->getPost('first_medical_degree_institution');
                        $medical_degree_name                = $this->request->getPost('highest_medical_degree_name');
                        $medical_degree_year                = $this->request->getPost('highest_medical_degree_year');
                        $highest_medical_degree_institution = $this->request->getPost('highest_medical_degree_institution');
                        $fellowship_name_of_institution_research_work = $this->request->getPost('fellowship_name_of_institution_research_work');
                        $fellowship_name_of_the_supervisor            = $this->request->getPost('fellowship_name_of_the_supervisor');
                        $fellowship_name_of_institution               = $this->request->getPost('fellowship_name_of_institution');
                        $fellowship_supervisor_department             = $this->request->getPost('fellowship_supervisor_department');
                        
                        $nominee_details_data['first_employment_name_of_institution_location']        = $name_of_institution_location;
                        $nominee_details_data['first_employment_designation']        = $employment_designation;
                        $nominee_details_data['first_employment_year_of_joining']    = $employment_year_of_joning;
                        $nominee_details_data['first_medical_degree_name_of_degree']  = $medical_degree_name_of_degree;
                        $nominee_details_data['first_medical_degree_year_of_award']     = $medical_degree_year_of_award;
                        $nominee_details_data['first_medical_degree_institution']    = $medical_degree_institution;
                        $nominee_details_data['highest_medical_degree_name']    = $medical_degree_name;
                        $nominee_details_data['highest_medical_degree_year']  = $medical_degree_year;
                        $nominee_details_data['highest_medical_degree_institution'] = $highest_medical_degree_institution;
                        $nominee_details_data['fellowship_name_of_institution_research_work'] = $fellowship_name_of_institution_research_work;
                        $nominee_details_data['fellowship_name_of_the_supervisor'] = $fellowship_name_of_the_supervisor;
                        $nominee_details_data['fellowship_name_of_institution'] = $fellowship_name_of_institution;
                        $nominee_details_data['fellowship_supervisor_department'] = $fellowship_supervisor_department;

                        if($this->request->getFile('complete_bio_data')) {
                            $complete_bio_data = $this->request->getFile('complete_bio_data');
                            $complete_bio_data->move($fileUploadDir);
                            $nominee_details_data['complete_bio_data'] = $complete_bio_data->getClientName();
                        }
                        
                        if($this->request->getFile('fellowship_research_experience')) {
                            $fellowship_research_experience = $this->request->getFile('fellowship_research_experience');
                            $fellowship_research_experience->move($fileUploadDir);
                            $nominee_details_data['fellowship_research_experience'] = $fellowship_research_experience->getClientName();
                        }    

                        if($this->request->getFile('fellowship_research_publications')) {
                            $fellowship_research_publications = $this->request->getFile('fellowship_research_publications');
                            $fellowship_research_publications->move($fileUploadDir);
                            $nominee_details_data['fellowship_research_publications'] = $fellowship_research_publications->getClientName();
                        }
                        
                        if($this->request->getFile('fellowship_research_awards_and_recognitions')) {
                            $fellowship_research_awards_and_recognitions = $this->request->getFile('fellowship_research_awards_and_recognitions');
                            $fellowship_research_awards_and_recognitions->move($fileUploadDir);
                            $nominee_details_data['fellowship_research_awards_and_recognitions']  = $fellowship_research_awards_and_recognitions->getClientName();
                        }
                        
                        if($this->request->getFile('fellowship_scientific_research_projects')) {
                            $fellowship_scientific_research_projects = $this->request->getFile('fellowship_scientific_research_projects');
                            $fellowship_scientific_research_projects->move($fileUploadDir);
                            $nominee_details_data['fellowship_scientific_research_projects'] = $fellowship_scientific_research_projects->getClientName();
                        }   
                        
                        if($this->request->getFile('fellowship_description_of_research')) {
                            $fellowship_description_of_research = $this->request->getFile('fellowship_description_of_research');
                            $fellowship_description_of_research->move($fileUploadDir);
                            $nominee_details_data['fellowship_description_of_research']  = $fellowship_description_of_research->getClientName();
                        }
                        
                        if($this->request->getFile('citation')){
                            $citation = $this->request->getFile('citation');
                            $citation->move($fileUploadDir);
                            $nominee_details_data['citation']     = $citation->getClientName();
                        }
                        
                        $nominee_details_data['is_submitted'] = 1;

                        $this->nominationModel->update(array("id" => $edit_data['nominee_detail_id']),$nominee_details_data); 

                        //inactive the user
                        $this->userModel->update(array("id" => $id),array("active" => 0));

                        $award_id = $edit_data['award_id'];

                        //sendmail to jury
                       // $this->sendMailToJury($award_id);

                        $this->print($id);
                        //send mail to admin
                        $filename  = $edit_data['firstname'].'.docx';
                        $attachmentFilePath =  'uploads/'.$id.'/'.$filename;
                        $isMailSent = finalNominationSubmit($edit_data['firstname'],$attachmentFilePath);

                        $redirectUrl = 'view/'.$edit_data['user_id'].'/'.$award_id;

                        if($isMailSent)
                        return redirect()->to($redirectUrl)->withInput();

                    }
                    else
                    {  
                        if(is_array($this->validation->getErrors()) && count($this->validation->getErrors()) > 0){
                            $this->data['validation'] = $this->validation;
                            $status = 'error';
                        }
                    }

            } 
            
            $editdata['id']                                                        = ($this->request->getPost('id'))?$this->request->getPost('id'):$id;
            $editdata['complete_bio_data']                                         = ($this->request->getFile('complete_bio_data'))?$this->request->getFile('complete_bio_data'):'';
            $editdata['first_employment_name_of_institution_location']             = ($this->request->getFile('first_employment_name_of_institution_location'))?$this->request->getFile('first_employment_name_of_institution_location'):'';
            $editdata['first_employment_designation']                = ($this->request->getFile('first_employment_designation'))?$this->request->getFile('first_employment_designation'):'';
            $editdata['first_employment_year_of_joining']               = ($this->request->getFile('first_employment_year_of_joining'))?$this->request->getFile('first_employment_year_of_joining'):'';
            $editdata['first_medical_degree_name_of_degree']                    = ($this->request->getFile('first_medical_degree_name_of_degree'))?$this->request->getFile('first_medical_degree_name_of_degree'):'';
            $editdata['first_medical_degree_year_of_award']  = ($this->request->getFile('first_medical_degree_year_of_award'))?$this->request->getFile('first_medical_degree_year_of_award'):'';
            $editdata['first_medical_degree_institution']                             = ($this->request->getFile('first_medical_degree_institution'))?$this->request->getFile('first_medical_degree_institution'):'';
            $editdata['highest_medical_degree_name']                      = ($this->request->getFile('highest_medical_degree_name'))?$this->request->getFile('highest_medical_degree_name'):'';
            $editdata['highest_medical_degree_year']                            = ($this->request->getFile('highest_medical_degree_year'))?$this->request->getFile('highest_medical_degree_year'):'';
            $editdata['highest_medical_degree_institution']                = ($this->request->getFile('highest_medical_degree_institution'))?$this->request->getFile('highest_medical_degree_institution'):'';
            $editdata['fellowship_research_experience']                      = ($this->request->getPost('fellowship_research_experience'))?$this->request->getPost('fellowship_research_experience'):'';
            $editdata['fellowship_research_publications']                   = ($this->request->getPost('fellowship_research_publications'))?$this->request->getPost('fellowship_research_publications'):'';
            $editdata['fellowship_research_awards_and_recognitions']                       = ($this->request->getPost('fellowship_research_awards_and_recognitions'))?$this->request->getPost('fellowship_research_awards_and_recognitions'):'';
            $editdata['fellowship_scientific_research_projects']                     = ($this->request->getPost('fellowship_scientific_research_projects'))?$this->request->getPost('fellowship_scientific_research_projects'):'';
            $editdata['fellowship_name_of_institution_research_work']                       = ($this->request->getPost('fellowship_name_of_institution_research_work'))?$this->request->getPost('fellowship_name_of_institution_research_work'):'';
            $editdata['fellowship_name_of_the_supervisor']                     = ($this->request->getPost('fellowship_name_of_the_supervisor'))?$this->request->getPost('fellowship_name_of_the_supervisor'):'';
            $editdata['fellowship_name_of_institution']                       = ($this->request->getPost('fellowship_name_of_institution'))?$this->request->getPost('fellowship_name_of_institution'):'';
            $editdata['fellowship_supervisor_department']                     = ($this->request->getPost('fellowship_supervisor_department'))?$this->request->getPost('fellowship_supervisor_department'):'';
            $editdata['fellowship_description_of_research']                     = ($this->request->getPost('fellowship_description_of_research'))?$this->request->getPost('fellowship_description_of_research'):'';
            $this->data['editdata'] = $editdata;
            $this->data['user']     = $edit_data;
            return  render('frontend/fellowship_new_documents',$this->data);  

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
        
            if(!empty($editdata['category'])) {
                $getCategoryLists   = $this->categoryModel->getCategoriesById($editdata['category']);
                $categoryRw         = $getCategoryLists->getRowArray();
                $editdata['category'] =    $categoryRw['name'];
            }
            if(!empty($editdata['citizenship'])) {
                $editdata['citizenship'] = ($editdata['citizenship'] ==1)?'Indian':'Other';
            }

            $getSessionFiles = getSessionData('uploadedFile');
          
            if($this->request->getFile('justification_letter')!=''){
                $justification_lt = file_get_contents($this->request->getFile('justification_letter'));
            }
            else
            {
                $justification_lt = ($getSessionFiles['justification_letter']!='')?file_get_contents(getFileInfo($getSessionFiles['justification_letter'])):'';
            }
          
            $editdata['justification_letter'] = 'data:application/pdf;base64,'.chunk_split(base64_encode($justification_lt));

            $this->data['editdata']  = $editdata;

            $filename      = 'frontend/fellowship_preview';

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

        $admin_url = base_url()."/admin/nominee";
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
       
        sendMail('sunpharma.sciencefoundation@sunpharma.com',$subject,$message);


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
       
       sendMail($nominee_email,$subject,$message);

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

        $files = array('justification_letter_name' =>'');
       
        
        if($type == 'fellowship'){

          

            if($this->request->getFile('justification_letter')!='') {
                $editdata['justification_letter_name'] = $this->request->getFile('justification_letter')->getName();
                $letter_name =  $this->request->getFile('justification_letter');
                $letter_name->move($uploadedFolderPath);
                $files['justification_letter'] = $documentRoot.'/'.$uploadedFolderPath.$letter_name->getClientName();
                $files['justification_letter_name'] = $editdata['justification_letter_name'];
            }   
             
        }
      

            if(count($files) > 0 && (isset($files['justification_letter']) && ($files['justification_letter'] != '')))
              setSessionData('uploadedFile',$files);

            //already uploaded files get
            $getSessionFiles = getSessionData('uploadedFile');

         //   print_r($getSessionFiles); 

            if(is_array($getSessionFiles) && count($getSessionFiles) > 0 && $requestType == 'ajax') {
                $nominatorSessionDt = (isset($getSessionFiles['nominator_photo']) && $getSessionFiles['nominator_photo']!='')?getFileInfo($getSessionFiles['nominator_photo']):'';
                $letterSessionDt = (isset($getSessionFiles['justification_letter']) && $getSessionFiles['justification_letter']!='')?getFileInfo($getSessionFiles['justification_letter']):'';
                $supervisorSessionDt = (isset($getSessionFiles['supervisor_certifying']) && $getSessionFiles['supervisor_certifying']!='')?getFileInfo($getSessionFiles['supervisor_certifying']):'';
                $passportDt = (isset($getSessionFiles['passport']) && $getSessionFiles['passport']!='')?getFileInfo($getSessionFiles['passport']):'';
               
                $editdata['justification_letter_name'] =  $getSessionFiles['justification_letter_name'];
              
            }
            else
            {
               $letterSessionDt= ''; 
        
                $editdata['justification_letter_name']  = '';
              

            }
            
            $justificationLt  = ($this->request->getFile('justification_letter')!='')?$this->request->getFile('justification_letter'):$letterSessionDt;
           
       
            $editdata['justification_letter']        = $justificationLt;
           

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

       // $this->sendMailToJury($award_id);
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
            $source = file_get_contents($uploadDir.$nomineeData['nominator_photo']);
            $table->addCell(2000)->addImage($source,array(
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
            $table->addCell(2000)->addText($nomineeData['justification_letter_filename']);

            $table->addRow();
            $table->addCell(2000, $fancyTableCellStyle)->addText('Bio-Data', $fancyTableFontStyle);
            $table->addCell(2000)->addText($nomineeData['complete_bio_data']);

            if($nomineeData['nomination_type'] == 'spsfn'){
    
                    $table->addRow();
                    $table->addCell(2000, $fancyTableCellStyle)->addText('Supervisor Certifying Research Work', $fancyTableFontStyle);
                    $table->addCell(2000)->addText($nomineeData['supervisor_certifying']);

                    $table->addRow();
                    $table->addCell(2000, $fancyTableCellStyle)->addText('Excellence Research Work', $fancyTableFontStyle);
                    $table->addCell(2000)->addText($nomineeData['excellence_research_work']);

                    $table->addRow();
                    $table->addCell(2000, $fancyTableCellStyle)->addText('Lists of Publications', $fancyTableFontStyle);
                    $table->addCell(2000)->addText($nomineeData['lists_of_publications']);

                    $table->addRow();
                    $table->addCell(2000, $fancyTableCellStyle)->addText('Statement of Applicant', $fancyTableFontStyle);
                    $table->addCell(2000)->addText($nomineeData['statement_of_applicant']);

                    $table->addRow();
                    $table->addCell(2000, $fancyTableCellStyle)->addText('Ethical Clearance', $fancyTableFontStyle);
                    $table->addCell(2000)->addText($nomineeData['ethical_clearance']);

                    $table->addRow();
                    $table->addCell(2000, $fancyTableCellStyle)->addText('Statement of duly signed by Nominee', $fancyTableFontStyle);
                    $table->addCell(2000)->addText($nomineeData['statement_of_duly_signed_by_nominee']);

                    $table->addRow();
                    $table->addCell(2000, $fancyTableCellStyle)->addText('Citation', $fancyTableFontStyle);
                    $table->addCell(2000)->addText($nomineeData['citation']);

                    $table->addRow();
                    $table->addCell(2000, $fancyTableCellStyle)->addText('Aggregate Marks', $fancyTableFontStyle);
                    $table->addCell(2000)->addText($nomineeData['aggregate_marks']);


                    $table->addRow();
                    $table->addCell(2000, $fancyTableCellStyle)->addText('Age Proof', $fancyTableFontStyle);
                    $table->addCell(2000)->addText($nomineeData['age_proof']);

                    $table->addRow();
                    $table->addCell(2000, $fancyTableCellStyle)->addText('Declaration Candidate', $fancyTableFontStyle);
                    $table->addCell(2000)->addText($nomineeData['declaration_candidate']);
                
            }
            else
            {
                
                $table->addRow();
                $table->addCell(2000, $fancyTableCellStyle)->addText('Passport', $fancyTableFontStyle);
                $table->addCell(2000)->addText($nomineeData['passport_filename']);

                $table->addRow();
                $table->addCell(2000, $fancyTableCellStyle)->addText('Research Work', $fancyTableFontStyle);
                $table->addCell(2000)->addText($nomineeData['signed_details']);

                $table->addRow();
                $table->addCell(2000, $fancyTableCellStyle)->addText('Citation', $fancyTableFontStyle);
                $table->addCell(2000)->addText($nomineeData['citation']);

                $table->addRow();
                $table->addCell(2000, $fancyTableCellStyle)->addText('Signed Statement', $fancyTableFontStyle);
                $table->addCell(2000)->addText($nomineeData['signed_statement']);

                $table->addRow();
                $table->addCell(2000, $fancyTableCellStyle)->addText('Publications', $fancyTableFontStyle);
                $table->addCell(2000)->addText($nomineeData['specific_publications']);

                $table->addRow();
                $table->addCell(2000, $fancyTableCellStyle)->addText('Best Papers', $fancyTableFontStyle);
                $table->addCell(2000)->addText($nomineeData['best_papers']);

                $table->addRow();
                $table->addCell(2000, $fancyTableCellStyle)->addText('Award Received', $fancyTableFontStyle);
                $table->addCell(2000)->addText($nomineeData['statement_of_research_achievements']);

            }     
            
            $firstname = $nomineeData['firstname'];

            if ( preg_match('/\s/',$firstname) ){
              $firstname = str_replace(' ', '_', $firstname);
            }

             $filename = $firstname.'.docx';
             $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
             //save to file to nominee folder
             $fileUploadDir = 'uploads/'.$nominee_id.'/'.$filename;
                            
             if(!file_exists($fileUploadDir))
               $xmlWriter->save($fileUploadDir);

             $filepath = $_SERVER['DOCUMENT_ROOT'].'/'.$fileUploadDir;   
             header("Content-Description: File Transfer");
             header('Content-Disposition: attachment; filename='.basename($filepath));
             header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
             header('Content-Transfer-Encoding: binary');
             header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
             header('Expires: 0');
             readfile($filepath);
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
