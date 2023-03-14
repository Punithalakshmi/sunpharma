<?php

namespace App\Controllers;
 
class Import extends BaseController
{
    public function index()
    {
        
         foreach($nominationData as $nkey=>$nvalue) {

         }

    }


    public function usersImport()
    {

       // $userLists = 'Science_scholar_award_user_lists.csv';
         $userLists = 'Research_award_users.csv';
        // Reading file
        $file = fopen("import/".$userLists,"r");
        $i = 0;
        $numberOfFields = 10; // Total number of fields

        $ins_data = array();
       
        // Initialize $importData_arr Array
        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
           $num = count($filedata);
           
           // Skip first row & check number of fields
           if($i > 0 && $num == $numberOfFields){ 
          
                $ins_data['firstname'] = $filedata[1];
                $ins_data['lastname']  = $filedata[2];
                $ins_data['email']     = $filedata[3];
                $ins_data['role']      = ($filedata[4]=='Jury')?1:'';
                $ins_data['username']  = trim($filedata[5]);
                $ins_data['password']  = md5(trim($filedata[6]));
                $ins_data['original_password'] = trim($filedata[6]);
                $ins_data['active']    = $filedata[7];
                $ins_data['old_user_id'] = $filedata[0]; 

                $this->userModel->save($ins_data);
           }

           $i++;

        }
        fclose($file);

    }


    public function nominationsImport()
    {

        $userLists = 'Research_award_Nomination.csv';
        // Reading file
        $file = fopen("import/".$userLists,"r");
        $i = 0;
        $numberOfFields = 24; // Total number of fields

        $ins_data = array();
       
      //  echo "<pre>";
        // Initialize $importData_arr Array
        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
         //  print_r($filedata); 
           $num = count($filedata);
           
           // Skip first row & check number of fields
           if($i > 0 && $num == $numberOfFields){ 
             
                //insert user table, create user
                $ins_data = array();
                $ins_data['firstname'] = $filedata[3];
                $ins_data['username']  = $filedata[21];
                $ins_data['password']  = md5(trim($filedata[22]));
                $ins_data['original_password']  = trim($filedata[22]);
                $ins_data['dob']       = date("Y/m/d",strtotime($filedata[4]));
                $ins_data['email']     = trim($filedata[9]);
                $ins_data['phone']     = trim($filedata[8]);
                $ins_data['role']      = 2;
                $ins_data['address']   = $filedata[6];
                $ins_data['status']    = 'Approved';
                $ins_data['active']    = 1;
                $ins_data['is_rejected'] = 0;
                $ins_data['is_submitted'] = 1;
                $ins_data['approved'] = $filedata[15];
                $ins_data['approved_by'] = $filedata[16];
                $ins_data['approved_on_time'] = $filedata[17];
                $ins_data['nomination_upload'] = $filedata[18];
                $ins_data['nomination_upload_time'] = $filedata[20];
                $ins_data['nomination_upload_by'] = $filedata[19];
                $ins_data['old_user_id'] = $filedata[0];

                //get category id
                $getCategoryName = $this->categoryModel->getCategoriesById(trim($filedata[2]),'yes')->getRowArray();
                $ins_data['category'] = $getCategoryName['id'];
                $ins_data['review_status'] = 'Reviewed';
                $ins_data['created_id'] = 1;
                $ins_data['created_date'] = date("Y-m-d H:i:s");

                $this->userModel->save($ins_data);
                $lastInsertID = $this->userModel->insertID();

                //nomination details upload
                $nomination_deatils = array();
                $nomination_deatils['nominee_id'] = $lastInsertID;
                $nomination_deatils['registration_no'] = $filedata[1]."/".$filedata[0];
                $nomination_deatils['nomination_year'] = $filedata[1];
                $nomination_deatils['category_id'] = $getCategoryName['id'];
                $nomination_deatils['citizenship'] = (!empty($filedata[5]) && ($filedata[5] == 'INDIAN'))?1:2;
                $nomination_deatils['nomination_type'] = 'ssan';
                $nomination_deatils['residence_address'] = $filedata[7];
                $nomination_deatils['nominator_name'] = $filedata[10];
                $nomination_deatils['nominator_email'] = $filedata[13];
                $nomination_deatils['nominator_phone'] = $filedata[12];
                $nomination_deatils['nominator_address'] = $filedata[11];
                $nomination_deatils['is_submitted'] = 1;
              //$nomination_deatils['nominator_name'] = $filedata[$i][7];
                $this->nominationModel->save($nomination_deatils);

           }

           $i++;

        }
        fclose($file);


    }


    public function uploadAttachment()
    {

     $userLists = 'upload_attachment.csv';
     // Reading file
     $file = fopen("import/".$userLists,"r");
     $i = 0;
     $numberOfFields = 8; // Total number of fields

     $ins_data = array();
    
     $attachmentArr = array();
     
     // Initialize $importData_arr Array
     while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
      //  print_r($filedata); 
        $num = count($filedata);
        $update_data = array();
        if($filedata[1]!='Nomination_ID') {
           $getUserData = $this->userModel->getDataByOldID($filedata[1])->getRowArray();

           $detail_id = $getUserData['nominee_detail_id'];
           

           //upload folder creation
           $userID = $getUserData['nominee_id'];

           //check if upload folder already exists or not 
           $fileUploadDir = 'uploads/'.$userID;

           //attachments folder
           $attachmentFolder = 'import/research_award_attachments/';
                            
           if(!file_exists($fileUploadDir) && !is_dir($fileUploadDir))
            mkdir($fileUploadDir, 0777, true); 
           
           if($filedata[2] == 'Applicant_Photograph'){
            $update_data = array();

            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);
           
            $update_data['nominator_photo']  =  $fileAp->getBasename();
            $this->nominationModel->update(array("id" => $detail_id),$update_data);

           }  

           if($filedata[2] == 'Justification_Letter') { 
            $update_data = array();
            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);
           
            $update_data['justification_letter_filename']  =  $fileAp->getBasename();
            $this->nominationModel->update(array("id" => $detail_id),$update_data);
            
           
           }  

           if($filedata[2] == 'Indian_Passport'){
            $update_pass_data = array();
            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);
           
            $update_pass_data['passport_filename']  =  $fileAp->getBasename();
            $this->nominationModel->update(array("id" => $detail_id),$update_pass_data);
            
           }  

          if($filedata[2] == 'Biodata') {
            $update_bio_data = array();
            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);
           
            $update_bio_data['complete_bio_data']  =  $fileAp->getBasename();
            $this->nominationModel->update(array("id" => $detail_id),$update_bio_data);
            
          }  

          if(str_contains($filedata[2],'ResearchWork')) {

            $update_research_data = array();

            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);
            $previous_file_name = ''; $new_file_name = '';
            //get previous filename
            $previous_file_name = $getUserData['signed_details'];

            if($previous_file_name!='')
              $new_file_name = trim($previous_file_name).','.$fileAp->getBasename(); 
            else
              $new_file_name = $fileAp->getBasename(); 
           
            $update_research_data['signed_details']  = $new_file_name;

          //  $update_data['signed_details'] = $filedata[3];

            //get already uploaded file
            $this->nominationModel->update(array("id" => $detail_id),$update_research_data);
          }   
            
          if(str_contains($filedata[2],'Citation')){

            $update_citation_data = array();

            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);

            $previous_file_name = ''; $new_file_name = '';

            //get previous filename
            $previous_file_name = $getUserData['citation'];

            if($previous_file_name!='')
              $new_file_name = trim($previous_file_name).','.$fileAp->getBasename(); 
            else
              $new_file_name = $fileAp->getBasename();  
           
            $update_citation_data['citation']  =  $new_file_name;

            $this->nominationModel->update(array("id" => $detail_id),$update_citation_data);
          //  $update_data['citation'] = $filedata[3]; 
          }  

          if($filedata[2] == 'SignedStatement') {

            $update_signed_data = array();

            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);
           
            $update_signed_data['signed_statement']  =  $fileAp->getBasename();
            $this->nominationModel->update(array("id" => $detail_id),$update_signed_data);
            
          }   
          
          if(str_contains($filedata[2],'Publications'))  {
            $update_publication_data = array();
            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);

            $previous_file_name = ''; $new_file_name = '';

            $previous_file_name = $getUserData['specific_publications'];

            if($previous_file_name!='')
               $new_file_name = trim($previous_file_name).','.$fileAp->getBasename(); 
            else
               $new_file_name = $fileAp->getBasename();  
           
            $update_publication_data['specific_publications']  =  $new_file_name;

            $this->nominationModel->update(array("id" => $detail_id),$update_publication_data);
          }  

          if(str_contains($filedata[2],'BestPapers'))  {
            $update_best_data = array();
            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);

            $previous_file_name = ''; $new_file_name = '';

            $previous_file_name = $getUserData['best_papers'];

            if($previous_file_name!='')
              $new_file_name = trim($previous_file_name).','.$fileAp->getBasename(); 
            else
              $new_file_name = $fileAp->getBasename(); 
           
            $update_best_data['best_papers']  =  $new_file_name;
            
            $this->nominationModel->update(array("id" => $detail_id),$update_best_data);
           
          }   
          
          if($filedata[2] == 'AwardReceived')  {
            $update_award_data = array();
            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);

            $update_award_data['statement_of_research_achievements']  =  $fileAp->getBasename();

            $this->nominationModel->update(array("id" => $detail_id),$update_award_data);
           
          }  
          
        }

       // if($i == 12)
      //   die;
        
        $i++;
     }
      fclose($file); 
        
    }

    public function ratingImport()
    {

        // $userLists = 'Science_scholar_award_user_lists.csv';
        $userLists = 'rating_ss.csv';
        // Reading file
        $file = fopen("import/".$userLists,"r");
        $i = 0;
        $numberOfFields = 7; // Total number of fields

        $ins_data = array();
      //echo "<pre>";
        // Initialize $importData_arr Array
        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
           $num = count($filedata);
          //print_r($filedata);
           // Skip first row & check number of fields
           if($i > 0 && $num == $numberOfFields){ 
         // echo "sddddd"; die;
            $getUserData = $this->userModel->getDataByOldID($filedata[1],'spsfn')->getRowArray();

            $nominee_id = $getUserData['nominee_id'];

            //get jury id

                $getJuryID = $this->userModel->checkUniqueEmail(array("username" => $filedata[2], "role" => 1));
               // print_r($getJuryID); die;
                $ins_data = array(); 
                $ins_data['jury_id'] = $getJuryID[0]['id'];
                $ins_data['nominee_id']  = $nominee_id;
                $ins_data['rating']     = $filedata[3];
                $ins_data['comments']  = '';
                $ins_data['is_rate_submitted']  = 1;
                $ins_data['created_id']      = trim($getJuryID[0]['id']);
                $ins_data['created_date']    = date('Y-m-d H:i:s',strtotime($filedata[4]));
               

                $this->ratingModel->save($ins_data);
           }

           $i++;

        }
        fclose($file);

    }


    public function nominationsImportSS()
    {

        $userLists = 'SS_award_nomination.csv';
        // Reading file
        $file = fopen("import/".$userLists,"r");
        $i = 0;
        $numberOfFields = 28; // Total number of fields

        $ins_data = array();
       
      //  echo "<pre>";
        // Initialize $importData_arr Array
        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
         //  print_r($filedata); 
           $num = count($filedata);
           
           // Skip first row & check number of fields
           if($i > 0 && $num == $numberOfFields){ 
               // print_r($filedata[$i]); 
               // echo $filedata[$i][21];
                //insert user table, create user
                $ins_data = array();
                $ins_data['firstname'] = $filedata[3];
                $ins_data['username']  = $filedata[23];
                $ins_data['password']  = md5(trim($filedata[24]));
                $ins_data['original_password']  = trim($filedata[24]);
                $ins_data['dob']       = date("Y/m/d",strtotime($filedata[4]));
                $ins_data['email']     = trim($filedata[11]);
                $ins_data['phone']     = trim($filedata[10]);
                $ins_data['role']      = 2;
                $ins_data['address']   = $filedata[8];
                $ins_data['status']    = 'Approved';
                $ins_data['active']    = $filedata[16];
                $ins_data['is_rejected'] = 0;
                $ins_data['is_submitted'] = 1;
                $ins_data['approved'] = $filedata[17];
                $ins_data['approved_by'] = $filedata[18];
                $ins_data['approved_on_time'] = $filedata[19];
                $ins_data['nomination_upload'] = $filedata[20];
                $ins_data['nomination_upload_time'] = $filedata[22];
                $ins_data['nomination_upload_by'] = $filedata[21];
                $ins_data['old_user_id'] = $filedata[0];

                //get category id
                $getCategoryName = $this->categoryModel->getCategoriesByIdMain(trim($filedata[2]),2)->getRowArray();
                $ins_data['category'] = $getCategoryName['id'];
                $ins_data['review_status'] = 'Reviewed';
                $ins_data['created_id'] = 1;
                $ins_data['created_date'] = date("Y-m-d H:i:s");

                //award id
                //$getCategoryName = $this->awardsModel->getCategoriesById(trim($filedata[2]),'yes')->getRowArray();
                
                $getAwardID = $this->nominationTypesModel->getCategoryNominationByType($getCategoryName['id'])->getRowArray();
                $ins_data['award_id'] = $getAwardID['id'];

                $this->userModel->save($ins_data);
                $lastInsertID = $this->userModel->insertID();

                //nomination details upload
                $nomination_deatils = array();
                $nomination_deatils['nominee_id'] = $lastInsertID;
                $nomination_deatils['registration_no'] = $filedata[1]."/".$filedata[0];
                $nomination_deatils['nomination_year'] = 2021;
                $nomination_deatils['category_id'] = $getCategoryName['id'];
                $nomination_deatils['citizenship'] = (!empty($filedata[5]) && ($filedata[5] == 'INDIAN'))?1:2;
                $nomination_deatils['nomination_type'] = 'spsfn';
                $nomination_deatils['ongoing_course'] = $filedata[6];
                $nomination_deatils['is_completed_a_research_project'] = $filedata[7];
                $nomination_deatils['residence_address'] = $filedata[9];
                $nomination_deatils['nominator_name'] = $filedata[12];
                $nomination_deatils['nominator_email'] = $filedata[15];
                $nomination_deatils['nominator_phone'] = $filedata[14];
                $nomination_deatils['nominator_address'] = $filedata[13];
                $nomination_deatils['year_of_passing'] = $filedata[25];
                $nomination_deatils['number_of_attempts'] = $filedata[26];
                $nomination_deatils['course_name'] = ($filedata[6] == 'Other')?$filedata[27]:'';
                $nomination_deatils['is_submitted'] = 1;
              //$nomination_deatils['nominator_name'] = $filedata[$i][7];
                $this->nominationModel->save($nomination_deatils);

           }

           $i++;

        }
        fclose($file);


    }

    public function uploadAttachmentSS()
    {

     $userLists = 'upload_attachment_ss.csv';
     // Reading file
     $file = fopen("import/".$userLists,"r");
     $i = 0;
     $numberOfFields = 7; // Total number of fields

     $ins_data = array();
    
     $attachmentArr = array();
     
     // Initialize $importData_arr Array
     while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {

        //print_r($filedata);  die;

        $num = count($filedata);
        $update_data = array();
        if($filedata[1]!='Nomination_ID') {

           $getUserData = $this->userModel->getDataByOldID($filedata[1],'spsfn')->getRowArray();

           $detail_id = $getUserData['nominee_detail_id'];
           
           //upload folder creation
           $userID = $getUserData['nominee_id'];

           //check if upload folder already exists or not 
           $fileUploadDir = 'uploads/'.$userID;

           //attachments folder
           $attachmentFolder = 'import/ss_award_attachments/';
                            
           if(!file_exists($fileUploadDir) && !is_dir($fileUploadDir))
            mkdir($fileUploadDir, 0777, true); 
           
           if($filedata[2] == 'Applicant_Photograph'){
            $update_data = array();

            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);
           
            $update_data['nominator_photo']  =  $fileAp->getBasename();
            $this->nominationModel->update(array("id" => $detail_id),$update_data);

           }  

           if($filedata[2] == 'Justification_Letter') { 
            $update_data = array();
            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);
           
            $update_data['justification_letter_filename']  =  $fileAp->getBasename();
            $this->nominationModel->update(array("id" => $detail_id),$update_data);
            
           
           }  

           if($filedata[2] == 'CertifyingResearchWork_Letter'){
            $update_pass_data = array();
            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);
           
            $update_pass_data['supervisor_certifying']  =  $fileAp->getBasename();
            $this->nominationModel->update(array("id" => $detail_id),$update_pass_data);
            
           }  

          if($filedata[2] == 'Upload1') {
            $update_bio_data = array();
            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);
           
            $update_bio_data['complete_bio_data']  =  $fileAp->getBasename();
            $this->nominationModel->update(array("id" => $detail_id),$update_bio_data);
            
          }  

          if($filedata[2] == 'Upload2') {

            $update_signed_data = array();

            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);
           
            $update_signed_data['excellence_research_work']  =  $fileAp->getBasename();
            $this->nominationModel->update(array("id" => $detail_id),$update_signed_data);
            
          }   

          if(str_contains($filedata[2],'Upload3')) {

            $update_research_data = array();

            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);
            $previous_file_name = ''; $new_file_name = '';
            //get previous filename
            $previous_file_name = $getUserData['lists_of_publications'];

            if($previous_file_name!='')
              $new_file_name = trim($previous_file_name).','.$fileAp->getBasename(); 
            else
              $new_file_name = $fileAp->getBasename(); 
           
            $update_research_data['lists_of_publications']  = $new_file_name;

          //  $update_data['signed_details'] = $filedata[3];

            //get already uploaded file
            $this->nominationModel->update(array("id" => $detail_id),$update_research_data);
          }   
          

          if(str_contains($filedata[2],'Upload4')){

            $update_citation_data = array();

            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);

            $previous_file_name = ''; $new_file_name = '';

            //get previous filename
            $previous_file_name = $getUserData['statement_of_applicant'];

            if($previous_file_name!='')
              $new_file_name = trim($previous_file_name).','.$fileAp->getBasename(); 
            else
              $new_file_name = $fileAp->getBasename();  
           
            $update_citation_data['statement_of_applicant']  =  $new_file_name;

            $this->nominationModel->update(array("id" => $detail_id),$update_citation_data);
          //  $update_data['citation'] = $filedata[3]; 
          }  

          
          if(str_contains($filedata[2],'Upload5'))  {
            $update_publication_data = array();
            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);

            $previous_file_name = ''; $new_file_name = '';

            $previous_file_name = $getUserData['ethical_clearance'];

            if($previous_file_name!='')
               $new_file_name = trim($previous_file_name).','.$fileAp->getBasename(); 
            else
               $new_file_name = $fileAp->getBasename();  
           
            $update_publication_data['ethical_clearance']  =  $new_file_name;

            $this->nominationModel->update(array("id" => $detail_id),$update_publication_data);
          }  

          
          
          if($filedata[2] == 'Upload6')  {
            $update_award_data = array();
            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);

            $update_award_data['statement_of_duly_signed_by_nominee']  =  $fileAp->getBasename();

            $this->nominationModel->update(array("id" => $detail_id),$update_award_data);
           
          }  

          if($filedata[2] == 'Upload7')  {
            $update_award_data = array();
            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);

            $update_award_data['citation']  =  $fileAp->getBasename();

            $this->nominationModel->update(array("id" => $detail_id),$update_award_data);
           
          }

          if(str_contains($filedata[2],'Upload8'))  {
            $update_best_data = array();
            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);

            $previous_file_name = ''; $new_file_name = '';

            $previous_file_name = $getUserData['aggregate_marks'];

            if($previous_file_name!='')
              $new_file_name = trim($previous_file_name).','.$fileAp->getBasename(); 
            else
              $new_file_name = $fileAp->getBasename(); 
           
            $update_best_data['aggregate_marks']  =  $new_file_name;
            
            $this->nominationModel->update(array("id" => $detail_id),$update_best_data);
           
          }   

          if(str_contains($filedata[2],'Upload9'))  {
            $update_best_data = array();
            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);

            $previous_file_name = ''; $new_file_name = '';

            $previous_file_name = $getUserData['age_proof'];

            if($previous_file_name!='')
              $new_file_name = trim($previous_file_name).','.$fileAp->getBasename(); 
            else
              $new_file_name = $fileAp->getBasename(); 
           
            $update_best_data['age_proof']  =  $new_file_name;
            
            $this->nominationModel->update(array("id" => $detail_id),$update_best_data);
           
          }   

          if($filedata[2] == 'Upload10')  {
            $update_award_data = array();
            $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$attachmentFolder.$filedata[0].'~'.$filedata[1].'~'.$filedata[3];
           
            $fileAp = new \CodeIgniter\Files\File($filename,true);

            $fileAp->move($fileUploadDir);

            $update_award_data['declaration_candidate']  =  $fileAp->getBasename();

            $this->nominationModel->update(array("id" => $detail_id),$update_award_data);
           
          }

          //documents uploaded time
          
        }

       // if($i == 12)
      //   die;
        
        $i++;
     }
      fclose($file); 
        
    }

}
