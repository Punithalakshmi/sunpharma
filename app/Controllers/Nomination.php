<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NominationModel;

class Nomination extends BaseController
{
    public function index()
    {
        $session   = \Config\Services::session();
        $userdata = $session->get('fuserdata');
        $data['userdata'] = $userdata;

        return  view('frontend/header',$data)
               .view('frontend/ssan',$data)
               .view('frontend/footer');
    }

   
    
    public function spsfn($id = '')
    {

        helper(array('form', 'url'));

        $session   = \Config\Services::session();
        $userdata  = $session->get('fuserdata');
    
        $request    = \Config\Services::request();
        $validation = \Config\Services::validation();

        $userModel = new UserModel();
       
            if(!empty($id)){
                $getUserData = $userModel->getUserData($id);
                $edit_data   = $getUserData->getRowArray();
              //  print_r($edit_data);
            }
            
            if($request->getPost())
               $id  = $request->getPost('id');
               
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
                   
                    

                    $ins_data = array();
                    $ins_data['firstname']  = $firstname;
                    $ins_data['email']      = $email;
                    $ins_data['phone']      = $phonenumber;
                    $ins_data['address']    = $address;
                    $ins_data['dob']        = date("Y/m/d",strtotime($dob));
                    $ins_data['status']     = 'Disapproved';
                    $ins_data['role']       = 2;

                    $nominee_details_data = array();
                    $nominee_details_data['category_id']        = $category;
                    $nominee_details_data['citizenship']        = $citizenship ;
                    $nominee_details_data['nomination_type']    = 'spsfn';
                    $nominee_details_data['residence_address']  = $residence_address;
                    $nominee_details_data['nominator_name']     = $nominator_name;
                    $nominee_details_data['nominator_email']    = $nominator_email;
                    $nominee_details_data['nominator_phone']    = $nominator_mobile;
                    $nominee_details_data['nominator_address']  = $nominator_office_address;

                    if(!empty($id)){
                        $session->setFlashdata('msg', 'User Updated Successfully!');
                        $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                        $ins_data['updated_id']    =  $userdata['login_id'];
                        $userModel->update(array("id" => $id),$ins_data);
                    }
                    else
                    {
                        $session->setFlashdata('msg', 'Submitted Successfully!');
                        $ins_data['created_date']  =  date("Y-m-d H:i:s");
                        $ins_data['created_id']    =  1;
                        $userModel->save($ins_data);
                        $lastInsertID = $userModel->insertID();


                         $fileUploadDir = WRITEPATH.'uploads/'.$lastInsertID;
                        
                         if(!file_exists($fileUploadDir) && !is_dir($fileUploadDir))
                            mkdir($fileUploadDir, 0777, true);
                         
                            //upload documents to respestive nominee folder
                            $justification_letter = $this->request->getFile('justification_letter');
                            $justification_letter->move($fileUploadDir);

                            $passport = $this->request->getFile('passport');
                            $passport->move($fileUploadDir);

                            $nominator_photo = $this->request->getFile('nominator_photo');
                            $nominator_photo->move($fileUploadDir);
 
                            $nominationModel = new NominationModel();
                            $nominee_details_data['nominee_id']                    = $lastInsertID;
                            $nominee_details_data['passport_filename']             = $passport->getClientName();
                            $nominee_details_data['justification_letter_filename'] = $justification_letter->getClientName();
                            $nominee_details_data['nominator_photo']               = $nominator_photo->getClientName();
                            $nominationModel->save($nominee_details_data);
                    } 

                    return redirect()->route('spsfn');
                }
            }
            else
            {  
            
                if(!empty($edit_data) && count($edit_data)){
                    $editdata['category']                         = $edit_data['category_id'];
                    $editdata['nominee_name']                     = $edit_data['firstname'];
                    $editdata['email']                            = $edit_data['email'];
                    $editdata['mobile_no']                        = $edit_data['phone'];
                    $editdata['designation_and_office_address']   = $edit_data['address'];
                    $editdata['date_of_birth']                    = $edit_data['dob'];
                    $editdata['citizenship']                      = $edit_data['citizenship'];
                    $editdata['residence_address']                = $edit_data['residence_address'];
                    $editdata['nominator_name']                   = $edit_data['nominator_name'];
                    $editdata['nominator_mobile']                 = $edit_data['nominator_phone'];
                    $editdata['nominator_email']                  = $edit_data['nominator_email'];
                    $editdata['nominator_office_address']         = $edit_data['nominator_address'];
                    $editdata['justification_letter']             = $edit_data['justification_letter_filename'];
                    $editdata['passport']                         = $edit_data['passport_filename'];
                    $editdata['nominator_photo']                  = $edit_data['nominator_photo'];
                    $editdata['id']                               =  $edit_data['id'];
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
                    $editdata['justification_letter']          = ($request->getPost('justification_letter'))?$request->getPost('justification_letter'):'';
                    $editdata['passport']                      = ($request->getPost('passport'))?$request->getPost('passport'):'';
                    $editdata['nominator_photo']               = ($request->getPost('nominator_photo'))?$request->getPost('nominator_photo'):'';
                    $editdata['id']                            = ($request->getPost('id'))?$request->getPost('id'):'';
                }

                  if($request->getPost())
                    $data['validation'] = $this->validator;

                    $data['editdata'] = $editdata;
                    $data['userdata'] = $userdata;
                    return   view('frontend/header',$data)
                            .view('frontend/spsfn',$data)
                            .view('frontend/footer');
           

          }

   }

    public function validation_rules($id='')
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
                                    "nominator_office_address" => array("label" => "Naminator Office Address",'rules' => 'required'),
                                    "justification_letter" => array("label" => "Attached Justification Letter",'rules' => 'uploaded[justification_letter]|max_size[justification_letter,500]|ext_in[justification_letter,pdf]'),
                                    "passport" => array("label" => "Attached Passport",'rules' => 'uploaded[passport]|ext_in[passport,pdf]'),
                                    "nominator_photo" => array("label" => "Naminator Office Address",'rules' => 'uploaded[nominator_photo]'),
      ); 

      return $validation_rules;
      
    }

}