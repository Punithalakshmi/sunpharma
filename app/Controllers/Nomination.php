<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NominationModel;
use App\Models\CategoryModel;

class Nomination extends BaseController
{
    public function index($id = '')
    {
        helper(array('form', 'url'));
        
        $session   = \Config\Services::session();
        $userdata  = $session->get('userdata');

        if(is_array($userdata) && $userdata['isLoggedIn'])
            $this->view($userdata['id']);

        $request     = \Config\Services::request();
        $validation  = \Config\Services::validation();
        $uri         = current_url(true);

        $data['uri'] = $uri->getSegment(1);

        $userModel       = new UserModel();
        $categoryModel   = new CategoryModel();
        $nominationModel = new NominationModel();
       
            if(!empty($id)){
                $getUserData = $userModel->getUserData($id);
                $edit_data   = $getUserData->getRowArray();
            }

            //get categories lists
            $getCategoryLists   = $categoryModel->getCategoriesByType('Science Scholar Awards');
            $data['categories'] = $getCategoryLists->getResultArray();
            
            if($request->getPost()){
               $id  = $request->getPost('id');
               $detail_id = $request->getPost('detail_id');
            }   
            else
            {
               $id  = $id;   
            }   
            $validation = $this->validate($this->validation_rules($id));
          
            if($validation) {

                if($request->getPost()){
                
                    $category                    = $request->getPost('category');
                    $firstname                   = $request->getPost('nominee_name');
                    $dob                         = $request->getPost('date_of_birth');
                    $citizenship                 = $request->getPost('citizenship');
                    $email                       = $request->getPost('email');
                    $phonenumber                 = $request->getPost('mobile_no');
                    $address                     = $request->getPost('designation_and_office_address');
                    $residence_address           = $request->getPost('residence_address');
                    $nominator_name              = $request->getPost('nominator_name');
                    $nominator_mobile            = $request->getPost('nominator_mobile');
                    $nominator_email             = $request->getPost('nominator_email');
                    $nominator_office_address    = $request->getPost('nominator_office_address');
                    $ongoing_course              = $request->getPost('ongoing_course');
                    $research_project            = $request->getPost('research_project');
                    if($request->getPost('year_of_passing')) {
                        $year_of_passing             = $request->getPost('year_of_passing');
                        $number_of_attempts          = $request->getPost('number_of_attempts');
                    }
                  
                    $ins_data = array();
                    $ins_data['firstname']  = $firstname;
                    $ins_data['email']      = $email;
                    $ins_data['phone']      = $phonenumber;
                    $ins_data['address']    = $address;
                    $ins_data['dob']        = date("Y/m/d",strtotime($dob));
                    $ins_data['status']     = 'Disapproved';
                    $ins_data['role']       = 2;
                    $ins_data['category']   = $category;

                    $nominee_details_data = array();
                    $nominee_details_data['category_id']        = $category;
                    $nominee_details_data['citizenship']        = $citizenship ;
                    $nominee_details_data['nomination_type']    = 'spsfn';
                    $nominee_details_data['residence_address']  = $residence_address;
                    $nominee_details_data['nominator_name']     = $nominator_name;
                    $nominee_details_data['nominator_email']    = $nominator_email;
                    $nominee_details_data['nominator_phone']    = $nominator_mobile;
                    $nominee_details_data['nominator_address']  = $nominator_office_address;
                    $nominee_details_data['ongoing_course']    = $ongoing_course;
                    $nominee_details_data['is_completed_a_research_project']  = $research_project;

                    if($request->getPost('year_of_passing')) 
                        $nominee_details_data['year_of_passing']    = $year_of_passing;

                    if($request->getPost('number_of_attempts'))     
                        $nominee_details_data['number_of_attempts'] = $number_of_attempts;
                    
                    if(!empty($id)){
                        $session->setFlashdata('msg', 'Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $userdata['id'];
                        $userModel->update(array("id" => $id),$ins_data);

                        $fileUploadDir = 'uploads/'.$id;

                        if($this->request->getFile('complete_bio_data')) {

                            $complete_bio_data = $this->request->getFile('complete_bio_data');
                            $complete_bio_data->move($fileUploadDir);
                  
                            $excellence_research_work = $this->request->getFile('excellence_research_work');
                            $excellence_research_work->move($fileUploadDir);

                            $lists_of_publications = $this->request->getFile('lists_of_publications');
                            $lists_of_publications->move($fileUploadDir);

                            $statement_of_applicant = $this->request->getFile('statement_of_applicant');
                            $statement_of_applicant->move($fileUploadDir);

                            $ethical_clearance = $this->request->getFile('ethical_clearance');
                            $ethical_clearance->move($fileUploadDir);

                            $statement_of_duly_signed_by_nominee = $this->request->getFile('statement_of_duly_signed_by_nominee');
                            $statement_of_duly_signed_by_nominee->move($fileUploadDir);

                            $citation = $this->request->getFile('citation');
                            $citation->move($fileUploadDir);

                            $aggregate_marks = $this->request->getFile('aggregate_marks');
                            $aggregate_marks->move($fileUploadDir);

                            $age_proof = $this->request->getFile('age_proof');
                            $age_proof->move($fileUploadDir);

                            $declaration_candidate = $this->request->getFile('declaration_candidate');
                            $declaration_candidate->move($fileUploadDir);

                            if($complete_bio_data->getClientName()) {
                                $nominee_details_data['complete_bio_data']                  = $complete_bio_data->getClientName();
                                $nominee_details_data['excellence_research_work']           = $excellence_research_work->getClientName();
                                $nominee_details_data['lists_of_publications']              = $lists_of_publications->getClientName();
                                $nominee_details_data['statement_of_applicant']             = $statement_of_applicant->getClientName();
                                $nominee_details_data['ethical_clearance']                  = $ethical_clearance->getClientName();
                                $nominee_details_data['statement_of_duly_signed_by_nominee']= $statement_of_duly_signed_by_nominee->getClientName();
                                $nominee_details_data['citation']                           = $citation->getClientName();
                                $nominee_details_data['aggregate_marks']                    = $aggregate_marks->getClientName();
                                $nominee_details_data['age_proof']                          = $age_proof->getClientName();
                                $nominee_details_data['declaration_candidate']              = $declaration_candidate->getClientName();
                            }  

                            $nominationModel->update(array("id" => $detail_id),$nominee_details_data);

                        }
                    }
                    else
                    {
                        $session->setFlashdata('msg', 'Submitted Successfully!');
                        $ins_data['created_date']  =  date("Y-m-d H:i:s");
                        $ins_data['created_id']    =  1;
                        $userModel->save($ins_data);
                        $lastInsertID = $userModel->insertID();

                        $fileUploadDir = 'uploads/'.$lastInsertID;
                        
                         if(!file_exists($fileUploadDir) && !is_dir($fileUploadDir))
                            mkdir($fileUploadDir, 0777, true);
                         
                            //upload documents to respestive nominee folder
                            $justification_letter = $this->request->getFile('justification_letter');
                            $justification_letter->move($fileUploadDir);

                            $supervisor_certifying = $this->request->getFile('supervisor_certifying');
                            $supervisor_certifying->move($fileUploadDir);

                            $nominator_photo = $this->request->getFile('nominator_photo');
                           // print_r($nominator_photo); die;
                            $nominator_photo->move($fileUploadDir);

                            $nominee_details_data['nominee_id']                         = $lastInsertID;
                            $nominee_details_data['supervisor_certifying']              = $supervisor_certifying->getClientName();
                            $nominee_details_data['justification_letter_filename']      = $justification_letter->getClientName();
                            $nominee_details_data['nominator_photo']                    = $nominator_photo->getClientName();
                            
                            $nominationModel->save($nominee_details_data);
                    } 

                    return redirect()->to('spsfn');
                }
            }
            else
            {  
            
                if(!empty($edit_data) && count($edit_data)){
                    $editdata['category']                             = $edit_data['category_id'];
                    $editdata['nominee_name']                         = $edit_data['firstname'];
                    $editdata['email']                                = $edit_data['email'];
                    $editdata['mobile_no']                            = $edit_data['phone'];
                    $editdata['designation_and_office_address']       = $edit_data['address'];
                    $editdata['date_of_birth']                        = $edit_data['dob'];
                    $editdata['citizenship']                          = $edit_data['citizenship'];
                    $editdata['residence_address']                    = $edit_data['residence_address'];
                    $editdata['nominator_name']                       = $edit_data['nominator_name'];
                    $editdata['nominator_mobile']                     = $edit_data['nominator_phone'];
                    $editdata['nominator_email']                      = $edit_data['nominator_email'];
                    $editdata['nominator_office_address']             = $edit_data['nominator_address'];
                    $editdata['justification_letter']                 = $edit_data['justification_letter_filename'];
                    $editdata['supervisor_certifying']                = $edit_data['supervisor_certifying'];
                    $editdata['nominator_photo']                      = $edit_data['nominator_photo'];
                    $editdata['complete_bio_data']                    = $edit_data['complete_bio_data'];
                    $editdata['excellence_research_work']             = $edit_data['excellence_research_work'];
                    $editdata['lists_of_publications']                = $edit_data['lists_of_publications'];
                    $editdata['statement_of_applicant']               = $edit_data['statement_of_applicant'];
                    $editdata['ethical_clearance']                    = $edit_data['ethical_clearance'];
                    $editdata['statement_of_duly_signed_by_nominee']  = $edit_data['statement_of_duly_signed_by_nominee'];
                    $editdata['citation']                             = $edit_data['citation'];
                    $editdata['aggregate_marks']                      = $edit_data['aggregate_marks'];
                    $editdata['age_proof']                            = $edit_data['age_proof'];
                    $editdata['declaration_candidate']                = $edit_data['declaration_candidate'];
                    $editdata['year_of_passing']                      = $edit_data['year_of_passing'];
                    $editdata['number_of_attempts']                   = $edit_data['number_of_attempts'];
                    $editdata['ongoing_course']                      = $edit_data['ongoing_course'];
                    $editdata['research_project']                   = $edit_data['is_completed_a_research_project'];
                    $editdata['id']                                   = $edit_data['user_id'];
                    $editdata['detail_id']                            = $edit_data['id'];
                }
                else
                {
                    $editdata['category']                             = ($request->getPost('category'))?$request->getPost('category'):'';
                    $editdata['nominee_name']                         = ($request->getPost('nominee_name'))?$request->getPost('nominee_name'):'';
                    $editdata['citizenship']                          = ($request->getPost('citizenship'))?$request->getPost('citizenship'):'';
                    $editdata['designation_and_office_address']       = ($request->getPost('designation_and_office_address'))?$request->getPost('designation_and_office_address'):'';
                    $editdata['residence_address']                    = ($request->getPost('residence_address'))?$request->getPost('residence_address'):'';
                    $editdata['email']                                = ($request->getPost('email'))?$request->getPost('email'):'';
                    $editdata['mobile_no']                            = ($request->getPost('mobile_no'))?$request->getPost('mobile_no'):'';
                    $editdata['date_of_birth']                        = ($request->getPost('date_of_birth'))?$request->getPost('date_of_birth'):'';
                    $editdata['nominator_name']                       = ($request->getPost('nominator_name'))?$request->getPost('nominator_name'):'';
                    $editdata['nominator_mobile']                     = ($request->getPost('nominator_mobile'))?$request->getPost('nominator_mobile'):'';
                    $editdata['nominator_email']                      = ($request->getPost('nominator_email'))?$request->getPost('nominator_email'):'';
                    $editdata['nominator_office_address']             = ($request->getPost('nominator_office_address'))?$request->getPost('nominator_office_address'):'';
                    $editdata['justification_letter']                 = ($this->request->getFile('justification_letter'))?$this->request->getFile('justification_letter'):'';
                    $editdata['supervisor_certifying']                = ($this->request->getFile('supervisor_certifying'))?$this->request->getFile('supervisor_certifying'):'';
                    $editdata['nominator_photo']                      = ($this->request->getFile('nominator_photo'))?$this->request->getFile('nominator_photo'):'';
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
                    $editdata['year_of_passing']                      = ($request->getPost('year_of_passing'))?$request->getPost('year_of_passing'):'';
                    $editdata['number_of_attempts']                   = ($request->getPost('number_of_attempts'))?$request->getPost('number_of_attempts'):'';
                    $editdata['ongoing_course']                       = ($request->getPost('ongoing_course'))?$request->getPost('ongoing_course'):'';
                    $editdata['research_project']                     = ($request->getPost('research_project'))?$request->getPost('research_project'):'';
                    $editdata['id']                                   = ($request->getPost('id'))?$request->getPost('id'):'';

                    if(!empty($editdata['category'])) {
                        $getCategoryLists   = $categoryModel->getCategoriesById($editdata['category']);
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
                    if($this->request->getFile('supervisor_certifying')){
                        $passport_ft = file_get_contents($this->request->getFile('supervisor_certifying'));
                        $editdata['supervisor_certifying'] = 'data:application/pdf;base64,'.chunk_split(base64_encode($passport_ft));
                    }
                }

                  if($request->getPost())
                    $data['validation'] = $this->validator;


                    
                    $data['editdata']   = $editdata;
                    $data['userdata']   = $userdata;
                    $data['nomination'] = $id;

                    if($this->request->isAJAX()){
                        $html = view('frontend/spsfn_preview',$data,array('debug' => false));
                        return $this->response->setJSON([
                            'status'            => 'success',
                            'html'              => $html
                        ]); 
                    }
                    else
                    {
                        return  view('frontend/_partials/header',$data)
                            .view('frontend/spsfn_new',$data)
                            .view('frontend/_partials/footer');
                    }        
          }

       
    }

   
    public function ssan($id = '',$detail_id='')
    {

            helper(array('form', 'url'));
            $session   = \Config\Services::session();
            $userdata  = $session->get('userdata');

         //   print_r($userdata);
            if(is_array($userdata) && $userdata['isLoggedIn'])
                $this->view($userdata['id']);

            $request   = \Config\Services::request();
            
            $validation = \Config\Services::validation();
            $uri = current_url(true);

            $data['uri'] = $uri->getSegment(1);

            $userModel       = new UserModel();
            $categoryModel   = new CategoryModel();
            $nominationModel = new NominationModel();
       
            if(!empty($id)){
                $getUserData = $userModel->getUserData($id);
                $edit_data   = $getUserData->getRowArray();
            }

            //get categories lists
            $getCategoryLists   = $categoryModel->getCategoriesByType('Research Awards');
            $categories         = $getCategoryLists->getResultArray();
            
            $data['categories'] = $categories;

            if($request->getPost()){
               $id  = $request->getPost('id');
               $detail_id = $request->getPost('detail_id');
            }   
               
            $validation = $this->validate($this->validation_rules($id,'ssan'));
          
            if($validation) {

                if($request->getPost()){
                 
                    $category                    = $request->getPost('category');
                    $firstname                   = $request->getPost('nominee_name');
                    $dob                         = $request->getPost('date_of_birth');
                    $citizenship                 = $request->getPost('citizenship');
                    $email                       = $request->getPost('email');
                    $phonenumber                 = $request->getPost('mobile_no');
                    $address                     = $request->getPost('designation_and_office_address');
                    $residence_address           = $request->getPost('residence_address');
                    $nominator_name              = $request->getPost('nominator_name');
                    $nominator_mobile            = $request->getPost('nominator_mobile');
                    $nominator_email             = $request->getPost('nominator_email');
                    $nominator_office_address    = $request->getPost('nominator_office_address');

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

                    $nominee_details_data = array();
                    $nominee_details_data['category_id']        = $category;
                    $nominee_details_data['citizenship']        = $citizenship ;
                    $nominee_details_data['nomination_type']    = 'ssan';
                    $nominee_details_data['residence_address']  = $residence_address;
                    $nominee_details_data['nominator_name']     = $nominator_name;
                    $nominee_details_data['nominator_email']    = $nominator_email;
                    $nominee_details_data['nominator_phone']    = $nominator_mobile;
                    $nominee_details_data['nominator_address']  = $nominator_office_address;

                    if(!empty($id)){
                        $session->setFlashdata('msg', 'Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $userdata['id'];
                        $userModel->update(array("id" => $id),$ins_data);

                        $fileUploadDir = 'uploads/'.$id;

                            if($this->request->getFile('complete_bio_data')) {
                                    $complete_bio_data = $this->request->getFile('complete_bio_data');
                                    $complete_bio_data->move($fileUploadDir);

                                    $best_papers = $this->request->getFile('best_papers');
                                    $best_papers->move($fileUploadDir);

                                    $statement_of_research_achievements = $this->request->getFile('statement_of_research_achievements');
                                    $statement_of_research_achievements->move($fileUploadDir);

                                    $signed_details = $this->request->getFile('signed_details');
                                    $signed_details->move($fileUploadDir);

                                    $specific_publications = $this->request->getFile('specific_publications');
                                    $specific_publications->move($fileUploadDir);

                                    $signed_statement = $this->request->getFile('signed_statement');
                                    $signed_statement->move($fileUploadDir);

                                    $citation = $this->request->getFile('citation');
                                    $citation->move($fileUploadDir);

                                    $nominee_details_data['complete_bio_data']                  = $complete_bio_data->getClientName();
                                    $nominee_details_data['statement_of_research_achievements'] = $statement_of_research_achievements->getClientName();
                                    $nominee_details_data['signed_details']                     = $signed_details->getClientName();
                                    $nominee_details_data['best_papers']                        = $best_papers->getClientName();
                                    $nominee_details_data['specific_publications']              = $specific_publications->getClientName();
                                    $nominee_details_data['signed_statement']                   = $signed_statement->getClientName();
                                    $nominee_details_data['citation']                           = $citation->getClientName();
                                    $nominationModel->update(array("id" => $detail_id),$nominee_details_data);
                            }
                    }
                    else
                    {
                        $session->setFlashdata('msg', 'Submitted Successfully!');
                        $ins_data['created_date']  =  date("Y-m-d H:i:s");
                        $ins_data['created_id']    =  1;
                        $userModel->save($ins_data);
                        $lastInsertID = $userModel->insertID();

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
                            $nominationModel->save($nominee_details_data);
                    } 

                    return redirect()->to('ssan');
                }
            }
            else
            {  
            
                if(!empty($edit_data) && count($edit_data)){
                    $editdata['category']                           = $edit_data['category_id'];
                    $editdata['nominee_name']                       = $edit_data['firstname'];
                    $editdata['email']                              = $edit_data['email'];
                    $editdata['mobile_no']                          = $edit_data['phone'];
                    $editdata['designation_and_office_address']     = $edit_data['address'];
                    $editdata['date_of_birth']                      = date("m/d/Y",strtotime($edit_data['dob']));
                    $editdata['citizenship']                        = $edit_data['citizenship'];
                    $editdata['residence_address']                  = $edit_data['residence_address'];
                    $editdata['nominator_name']                     = $edit_data['nominator_name'];
                    $editdata['nominator_mobile']                   = $edit_data['nominator_phone'];
                    $editdata['nominator_email']                    = $edit_data['nominator_email'];
                    $editdata['nominator_office_address']           = $edit_data['nominator_address'];
                    $editdata['justification_letter']               = $edit_data['justification_letter_filename'];
                    $editdata['passport']                           = $edit_data['passport_filename'];
                    $editdata['nominator_photo']                    = $edit_data['nominator_photo'];
                    $editdata['complete_bio_data']                  = $edit_data['complete_bio_data'];
                    $editdata['statement_of_research_achievements'] = $edit_data['statement_of_research_achievements'];
                    $editdata['signed_details']                     = $edit_data['signed_details'];
                    $editdata['best_papers']                        = $edit_data['best_papers'];
                    $editdata['specific_publications']              = $edit_data['specific_publications'];
                    $editdata['signed_statement']                   = $edit_data['signed_statement'];
                    $editdata['citation']                           = $edit_data['citation'];
                    $editdata['id']                                 = $edit_data['user_id'];
                    $editdata['detail_id']                          = $edit_data['id'];
                }
                else
                {
                    $editdata['category']                      = ($request->getPost('category'))?$request->getPost('category'):'';
                    $editdata['nominee_name']                  = ($request->getPost('nominee_name'))?$request->getPost('nominee_name'):'';
                    $editdata['citizenship']                   = ($request->getPost('citizenship'))?$request->getPost('citizenship'):'';
                    $editdata['designation_and_office_address']= ($request->getPost('designation_and_office_address'))?$request->getPost('designation_and_office_address'):'';
                    $editdata['residence_address']             = ($request->getPost('residence_address'))?$request->getPost('residence_address'):'';
                    $editdata['email']                         = ($request->getPost('email'))?$request->getPost('email'):'';
                    $editdata['mobile_no']                     = ($request->getPost('mobile_no'))?$request->getPost('mobile_no'):'';
                    $editdata['date_of_birth']                 = ($request->getPost('date_of_birth'))?$request->getPost('date_of_birth'):'';
                    $editdata['nominator_name']                = ($request->getPost('nominator_name'))?$request->getPost('nominator_name'):'';
                    $editdata['nominator_mobile']              = ($request->getPost('nominator_mobile'))?$request->getPost('nominator_mobile'):'';
                    $editdata['nominator_email']               = ($request->getPost('nominator_email'))?$request->getPost('nominator_email'):'';
                    $editdata['nominator_office_address']      = ($request->getPost('nominator_office_address'))?$request->getPost('nominator_office_address'):'';
                    $editdata['justification_letter']          = ($this->request->getFile('justification_letter'))?$this->request->getFile('justification_letter'):'';
                    $editdata['passport']                      = ($this->request->getFile('passport'))?$this->request->getFile('passport'):'';
                    $editdata['nominator_photo']               = ($this->request->getFile('nominator_photo'))?$this->request->getFile('nominator_photo'):'';
                    $editdata['complete_bio_data']             = ($this->request->getFile('complete_bio_data'))?$this->request->getFile('complete_bio_data'):'';
                    $editdata['statement_of_research_achievements']  = ($this->request->getFile('statement_of_research_achievements'))?$this->request->getFile('statement_of_research_achievements'):'';
                    $editdata['signed_details']                      = ($this->request->getFile('signed_details'))?$this->request->getFile('signed_details'):'';
                    $editdata['best_papers']                         = ($this->request->getFile('best_papers'))?$this->request->getFile('best_papers'):'';
                    $editdata['specific_publications']               = ($this->request->getFile('specific_publications'))?$this->request->getFile('specific_publications'):'';
                    $editdata['signed_statement']                    = ($this->request->getFile('signed_statement'))?$this->request->getFile('signed_statement'):'';
                    $editdata['citation']                            = ($this->request->getFile('citation'))?$this->request->getFile('citation'):'';
                    $editdata['id']                                  = ($request->getPost('id'))?$request->getPost('id'):'';

                    if(!empty($editdata['category'])) {
                        $getCategoryLists   = $categoryModel->getCategoriesById($editdata['category']);
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

                }

                  if($request->getPost())
                    $data['validation'] = $this->validator;


                    $data['editdata'] = $editdata;
                    $data['userdata'] = $userdata;
                    $data['nomination'] = $id;

                    if($this->request->isAJAX()){
                        $html = view('frontend/ssan_preview',$data,array('debug' => false));
                        return $this->response->setJSON([
                            'status'            => 'success',
                            'html'              => $html
                        ]); 
                    }
                    else
                    {
                        return   view('frontend/_partials/header',$data)
                                .view('frontend/ssan_new',$data)
                                .view('frontend/_partials/footer');
                    }            
          }

   }

    public function validation_rules($id='',$type='')
    {

            $validation_rules = array();
            $validation_rules = array(
                                            "category" => array("label" => "Category",'rules' => 'required'),
                                            "nominee_name" => array("label" => "Applicant Name",'rules' => 'required'),
                                            "date_of_birth" => array("label" => "Date Of Birth",'rules' => 'required'),
                                            "citizenship" => array("label" => "Citizenship",'rules' => 'required'),
                                            "designation_and_office_address" => array("label" => "Designation & Office Address",'rules' => 'required'),
                                            "residence_address" => array("label" => "Residence Address",'rules' => 'required'),
                                            "email" => array("label" => "Email",'rules' => 'required|valid_email|is_unique[users.email,id,'.$id.']'),
                                            "mobile_no" => array("label" => "Mobile No.",'rules' => 'required|numeric|max_length[10]'),
                                            "nominator_name" => array("label" => "Naminator Name",'rules' => 'required'),
                                            "nominator_mobile" => array("label" => "Naminator Mobile",'rules' => 'required|numeric|max_length[10]'),
                                            "nominator_email" => array("label" => "Naminator Email",'rules' => 'required|valid_email'),
                                            "nominator_office_address" => array("label" => "Naminator Office Address",'rules' => 'required')
            ); 

            if($type == 'ssan') {
                $validation_rules['justification_letter'] = array("label" => "Attached Justification Letter",'rules' => 'uploaded[justification_letter]|max_size[justification_letter,500]|ext_in[justification_letter,pdf]');
                $validation_rules['passport'] =         array("label" => "Attached Passport",'rules' => 'uploaded[passport]|ext_in[passport,pdf]');
                $validation_rules['nominator_photo'] = array("label" => "Applicant Photo",'rules' => 'uploaded[nominator_photo]');
            }

            return $validation_rules;
      
    }


    public function view($id = '')
    {

        $userModel     = new UserModel();
        $categoryModel = new CategoryModel();

        $request   = \Config\Services::request();
        $session   = \Config\Services::session();
        $userdata = $session->get('userdata');
        $nominationModel = new NominationModel();

        $uri = current_url(true);
        $data['uri'] = $uri->getSegment(1);  
       
        $id = (!empty($id))?$id:$request->getPost('id');

        if(!empty($id)){
            $getUserData = $userModel->getUserData($id);
            $edit_data   = $getUserData->getRowArray();

            $category   = $categoryModel->getCategoriesById($edit_data['category_id']);
            $categoryDt = $category->getRowArray();
            $edit_data['category_name'] = $categoryDt['name'];
        }
        
        if($request->getPost()){
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

                if($request->getPost('year_of_passing'))
                  $nominee_details_data['year_of_passing'] = $request->getPost('year_of_passing');
                
                if($request->getPost('number_of_attempts'))  
                  $nominee_details_data['number_of_attempts'] = $request->getPost('number_of_attempts');
               
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

            $nominationModel->update(array("id" => $edit_data['nominee_detail_id']),$nominee_details_data);  

            return redirect()->to('view/'.$edit_data['user_id'])->withInput();

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
                $editdata['year_of_passing']                      = ($request->getPost('year_of_passing'))?$request->getPost('year_of_passing'):'';
                $editdata['number_of_attempts']                   = ($request->getPost('number_of_attempts'))?$request->getPost('number_of_attempts'):'';
                $editdata['ongoing_course']                       = ($request->getPost('ongoing_course'))?$request->getPost('ongoing_course'):'';
                $editdata['research_project']                     = ($request->getPost('research_project'))?$request->getPost('research_project'):'';

            }    
                $editdata['id']                                  = ($request->getPost('id'))?$request->getPost('id'):$id;

              
        }

        $data['user']     = $edit_data;
        $data['userdata'] = $userdata;
        $data['editdata'] = $editdata;

        return   view('frontend/_partials/header',$data)
                .view('frontend/preview',$data)
                .view('frontend/_partials/footer');
                       
    }

    public function check_if_loggedin($id='')
    {
       
        return redirect()->to('view/'.$id); 
    }

}
