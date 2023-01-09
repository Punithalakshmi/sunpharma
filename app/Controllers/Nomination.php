<?php

namespace App\Controllers;


class Nomination extends BaseController
{
    public function index($award_id = '')
    {
   
            //get categories lists
            $getCategoryLists   = $this->categoryModel->getCategoriesByType('Science Scholar Awards');
            
            $this->data['categories'] = $getCategoryLists->getResultArray();
            
            if (strtolower($this->request->getMethod()) == "post") {

                $this->validation->setRules($this->validation_rules('spsfn',$award_id));

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
                            $ins_data['created_id']    =  1;
                            $this->userModel->save($ins_data);
                            $lastInsertID = $this->userModel->insertID();

                            $fileUploadDir = 'uploads/'.$lastInsertID;
                            
                            if(!file_exists($fileUploadDir) && !is_dir($fileUploadDir))
                            mkdir($fileUploadDir, 0777, true);
                            
                            //upload documents to respestive nominee folder
                            $justification_letter = $this->request->getFile('justification_letter');
                            $justification_letter->move($fileUploadDir);

                            $supervisor_certifying = $this->request->getFile('supervisor_certifying');
                            $supervisor_certifying->move($fileUploadDir);

                            $nominator_photo = $this->request->getFile('nominator_photo');
                            $nominator_photo->move($fileUploadDir);

                            $nominee_details_data['nominee_id']                         = $lastInsertID;
                            $nominee_details_data['supervisor_certifying']              = $supervisor_certifying->getClientName();
                            $nominee_details_data['justification_letter_filename']      = $justification_letter->getClientName();
                            $nominee_details_data['nominator_photo']                    = $nominator_photo->getClientName();
                    
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
        
        $this->data['editdata'] = $this->getRequestedData('spsfn');
        $this->data['award_id'] = $this->uri->getSegment(2);

        if($this->request->isAJAX()){
            $html = view('frontend/spsfn_new',$this->data,array('debug' => false));
            return $this->response->setJSON([
                'status'            => $status,
                'html'              => $html
            ]); 
            die;
        }
        else
        {
            return  render('frontend/spsfn_new',$this->data);        
        }
       
     }

   
    public function ssan($award_id = '')
    {
            //get categories lists
            $getCategoryLists   = $this->categoryModel->getCategoriesByType('Research Awards');
            $categories         = $getCategoryLists->getResultArray();
         
            $this->data['categories'] = $categories;

            if (strtolower($this->request->getMethod()) == "post") {

                $this->validation->setRules($this->validation_rules('ssan',$award_id));

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
                                $justification_letter = $this->request->getFile('justification_letter');
                                $justification_letter->move($fileUploadDir);

                                $passport = $this->request->getFile('passport');
                                $passport->move($fileUploadDir);

                                $nominator_photo = $this->request->getFile('nominator_photo');
                                $nominator_photo->move($fileUploadDir);

                                $nominee_details_data['nominee_id']                         = $lastInsertID;
                                $nominee_details_data['passport_filename']                  = $passport->getClientName();
                                $nominee_details_data['justification_letter_filename']      = $justification_letter->getClientName();
                                $nominee_details_data['nominator_photo']                    = $nominator_photo->getClientName();
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

        $this->data['editdata'] = $this->getRequestedData('ssan');
        $this->data['award_id'] = $this->uri->getSegment(2);


        if($this->request->isAJAX()){
            $html = view('frontend/ssan_new',$this->data,array('debug' => false));
            return $this->response->setJSON([
                'status'            => $status,
                'html'              => $html
            ]); 
            die;
        }
        else
        {
            return  render('frontend/ssan_new',$this->data);         
        }
   }

    public function validation_rules($type='',$id='')
    {

            $validation_rules = array();
            $validation_rules = array(
                                            "category" => array("label" => "Category",'rules' => 'required'),
                                            "nominee_name" => array("label" => "Applicant Name",'rules' => 'required'),
                                            "date_of_birth" => array("label" => "Date Of Birth",'rules' => 'required'),
                                            "citizenship" => array("label" => "Citizenship",'rules' => 'required'),
                                            "designation_and_office_address" => array("label" => "Designation & Office Address",'rules' => 'required'),
                                            "residence_address" => array("label" => "Residence Address",'rules' => 'required'),
                                            "email" => array("label" => "Email",'rules' => 'required|valid_email|is_unique[users.email,award_id,'.$id.']'),
                                            "mobile_no" => array("label" => "Mobile No.",'rules' => 'required|numeric|max_length[10]'),
                                            "nominator_name" => array("label" => "Naminator Name",'rules' => 'required'),
                                            "nominator_mobile" => array("label" => "Naminator Mobile",'rules' => 'required|numeric|max_length[10]'),
                                            "nominator_email" => array("label" => "Naminator Email",'rules' => 'required|valid_email'),
                                            "nominator_office_address" => array("label" => "Naminator Office Address",'rules' => 'required')
            ); 

            if($type == 'ssan') {
                $validation_rules['justification_letter'] = array("label" => "Attached Justification Letter",'rules' => 'uploaded[justification_letter]|max_size[justification_letter,500]|ext_in[justification_letter,pdf]'); 
                $validation_rules['nominator_photo'] = array("label" => "Applicant Photo",'rules' => 'uploaded[nominator_photo]');
            }

            if($type == 'ssan' && $this->request->getPost('citizenship') == 2)
                $validation_rules['passport'] =  array("label" => "Attached Passport",'rules' => 'uploaded[passport]|ext_in[passport,pdf]');

            if($type == 'spsfn') {

                if($this->request->getPost('ongoing_course') == 'other')
                    $validation_rules['course_name'] = array("label" => "Course Name",'rules' => 'required');

                if($this->request->getPost('research_project') == 'No')
                    $validation_rules['research_project'] = array("label" => "Course Name",'rules' => 'required');  

                
            }    
            return $validation_rules;
      
    }


    public function view($id = '')
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

        $this->validation = $this->validate($this->awards_validation_rules($edit_data['nomination_type']));

    
        if($this->validation) {

        if($this->request->getPost()){

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

            //sendmail to jury
            $this->sendMailToJury($edit_data['category_id']);


            return redirect()->to('view/'.$edit_data['user_id'])->withInput();

          }
        }
        else
        {
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
                $editdata['id']                                  = ($this->request->getPost('id'))?$this->request->getPost('id'):$id;
  
        }

        if($this->request->getPost())
            $this->data['validation'] = $this->validator;

        $this->data['user']     = $edit_data;
        $this->data['editdata'] = $editdata;

        return  render('frontend/preview',$this->data);
                                 
    }

    public function check_if_loggedin($id='')
    {
        return redirect()->to('view/'.$id); 
    }

    public function getPostedData()
    {
       
       // if($this->request->getPost()){

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

            if($this->request->getFile('nominator_photo')) {
                //nominator photo
                $nominator_pht = file_get_contents($this->request->getFile('nominator_photo'));
                $editdata['nominator_photo'] = 'data:image/jpeg;base64,'.base64_encode($nominator_pht);
            }   
            
            if($this->request->getFile('justification_letter')){
                $justification_lt = file_get_contents($this->request->getFile('justification_letter'));
                $editdata['justification_letter'] = 'data:application/pdf;base64,'.chunk_split(base64_encode($justification_lt));
            }

            if($this->request->getFile('passport')){
                $passport_ft = file_get_contents($this->request->getFile('passport'));
                $editdata['passport'] = 'data:application/pdf;base64,'.chunk_split(base64_encode($passport_ft));
            }
            
            if($this->request->getFile('supervisor_certifying')){
                $supervisor_certifying = file_get_contents($this->request->getFile('supervisor_certifying'));
                $editdata['supervisor_certifying'] = 'data:application/pdf;base64,'.chunk_split(base64_encode($supervisor_certifying));
            }
        
            $this->data['editdata']  = $editdata;

            $filename          = ($formtype == 'ssan')?'frontend/ssan_preview':'frontend/spsfn_preview';

          // if($this->request->isAJAX()){
           return   $html = view($filename,$this->data,array('debug' => false));
            //      return $this->response->setJSON([
            //          'status'            => 'success',
            //          'html'              => $html
            //      ]); 
            //    }
            // die;
       // }

    }


    public function awards_validation_rules($type = '')
    {
        $validation_rules = array();
      
        if($type == 'ssan') {
                $validation_rules['complete_bio_data']                  = array("label" => "Complete Bio Data",'rules' => 'uploaded[complete_bio_data]|max_size[complete_bio_data,500]|ext_in[complete_bio_data,pdf]');
                $validation_rules['best_papers']                        = array("label" => "Best Papers",'rules' => 'uploaded[best_papers]|max_size[best_papers,500]|ext_in[best_papers,pdf]');
                $validation_rules['statement_of_research_achievements'] = array("label" => "Statement of Research Achievements",'rules' => 'uploaded[statement_of_research_achievements]|max_size[statement_of_research_achievements,1000]|ext_in[statement_of_research_achievements,pdf]');
                $validation_rules['signed_details']                     = array("label" => "Signed Details",'rules' => 'uploaded[signed_details]');
                $validation_rules['specific_publications']              = array("label" => "Specific Publications",'rules' => 'uploaded[specific_publications]');
                $validation_rules['signed_statement']                   = array("label" => "Signed Statement",'rules' => 'uploaded[signed_statement]');
                $validation_rules['citation']                           = array("label" => "Citation",'rules' => 'uploaded[citation]');
        }
        else
        {
                $validation_rules['complete_bio_data']                  = array("label" => "Complete Bio Data",'rules' => 'uploaded[complete_bio_data]|max_size[complete_bio_data,500]|ext_in[complete_bio_data,pdf]');
                $validation_rules['excellence_research_work']           = array("label" => "Excellence Research Work",'rules' => 'uploaded[excellence_research_work]|max_size[excellence_research_work,500]|ext_in[excellence_research_work,pdf]');
                $validation_rules['lists_of_publications']              = array("label" => "Lists of Publications",'rules' => 'uploaded[lists_of_publications]|max_size[lists_of_publications,1000]|ext_in[lists_of_publications,pdf]');
                $validation_rules['statement_of_applicant']             = array("label" => "Statement Of Applicant",'rules' => 'uploaded[statement_of_applicant]');
                $validation_rules['ethical_clearance']                  = array("label" => "Ethical Clearance",'rules' => 'uploaded[ethical_clearance]');
                $validation_rules['statement_of_duly_signed_by_nominee']= array("label" => "Statement of duly signed",'rules' => 'uploaded[statement_of_duly_signed_by_nominee]');
                $validation_rules['citation']                           = array("label" => "Citation",'rules' => 'uploaded[citation]');
                $validation_rules['aggregate_marks']                    = array("label" => "Aggregate Marks",'rules' => 'uploaded[aggregate_marks]');
                $validation_rules['year_of_passing']                    = array("label" => "Year of Passing",'rules' => 'required');
                $validation_rules['number_of_attempts']                 = array("label" => "Number of attempts",'rules' => 'required');
                $validation_rules['age_proof']                          = array("label" => "Age Proof",'rules' => 'uploaded[age_proof]');
                $validation_rules['declaration_candidate']              = array("label" => "Declaration Candidate",'rules' => 'uploaded[declaration_candidate]');
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
        $html = view('email/mail',$this->data,array('debug' => false));
        mail("punitha@izaaptech.in",$subject,$html,$header);


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
        $html = view('email/mail',$this->data,array('debug' => false));
        mail($nominee_email,$subject,$html,$header);

    }

    public function sendMailToJury($category_id = ''){

        $header  = '';
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        $login_url = base_url().'/admin';

        $subject  = "New Nomination - Sun Pharma Science Foundation ";
       

        $juryLists = $this->userModel->getJuryListsByCategory($category_id);

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
                    $html = view('email/mail',$this->data,array('debug' => false));
                     mail($jvalue['email'],$subject,$html,$header);
                }
            }
        }
    }

    public function success()
    {
        return render('frontend/success', $this->data);
    }


    public function getRequestedData($type='')
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
      
        if($type == 'ssan'){
            $editdata['justification_letter']          = ($this->request->getFile('justification_letter'))?$this->request->getFile('justification_letter'):'';
            $editdata['passport']                      = ($this->request->getFile('passport'))?$this->request->getFile('passport'):'';
            $editdata['nominator_photo']               = ($this->request->getFile('nominator_photo'))?$this->request->getFile('nominator_photo'):'';
        }
        else
        {
            $editdata['ongoing_course']                      = ($this->request->getPost('ongoing_course'))?$this->request->getPost('ongoing_course'):'';
            $editdata['research_project']                      = ($this->request->getPost('research_project'))?$this->request->getPost('research_project'):'';
            $editdata['supervisor_certifying']                = ($this->request->getFile('supervisor_certifying'))?$this->request->getFile('supervisor_certifying'):'';
            $editdata['justification_letter']               = ($this->request->getFile('justification_letter'))?$this->request->getFile('justification_letter'):'';
            $editdata['nominator_photo']               = ($this->request->getFile('nominator_photo'))?$this->request->getFile('nominator_photo'):'';
        }

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
    
}
