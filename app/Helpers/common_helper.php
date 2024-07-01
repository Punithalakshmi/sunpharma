<?php

if ( ! function_exists('captchaVerification'))
{
    function captchaVerification($recaptchaResponse = '',$userIp='')
    {

            $secret='6Ldh61ojAAAAAFlBHQlMVa6jHJFxL2s1OctSrDIN';            
            $credential = array(
                'secret' => $secret,
                'response' => $recaptchaResponse
            );
            $verify = curl_init();
            curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($verify, CURLOPT_POST, true);
            curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
            curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($verify);
            return $status= json_decode($response, true);

       }
    }       


    if(!function_exists('sendMail')) {
        
        function sendMail($to='',$subject = '',$message = '',$attach = '')
        {
            $email  =  \Config\Services::email();
            $data['content'] = $message;
            $html = view('email/mail',$data,array('debug' => false));
            $email->setTo($to);
            $email->setSubject($subject);

            $email->setMessage($html);
		
	    $email->attach('');
	    if(!empty($attach))
              $email->attach($attach);

            if ($email->send()){
                return true;
            }
            else
            {
                return $email->printDebugger(['headers']);
            }
       }     
}


if ( ! function_exists('finalNominationSubmit'))
   {
        function finalNominationSubmit($name='',$file='')
        {
            $email    =  \Config\Services::email();
            //$login_url = base_url().'/admin';

            $subject  = 'Final Submission of Nomination';
            $message   = 'Dear Admin,';
            $message  .= '<br/><br/>';
            $message  .= 'The user <b>'.ucfirst($name).'</b> has completed the nomination process. ';  
            $message .= "<br/><br/><br/>";
            $message .= "Thanks & Regards,";
            $message .= "<br/>";
            $message .= "Sunpharma Science Foundation Team";
            
            $data['content'] = $message;
	        $data['title'] = '';
	
            $html = view('email/mail',$data,array('debug' => false));
            
            $email->setTo('sunpharma.sciencefoundation@sunpharma.com');
	 	$email->setTo('punitha@izaaptech.in');

            $email->setSubject($subject);
		$email->attach('');

            // file attach here //
            $email->attach($file);

            $email->setMessage($html);
            if ($email->send()){
                return true;
            }
            else
            {
                return $email->printDebugger(['headers']);
            }
       }     
}


    
if ( ! function_exists('isNominationExpired')) {
    
    function isNominationExpired($extendDate)
    {
        $date1_ts = strtotime(date("Y-m-d"));
        $date2_ts = strtotime($extendDate);
        $diff = $date2_ts - $date1_ts;
        $nominationEndDays = round($diff / 86400); 

        if($nominationEndDays <= 0 )
           return true;
        else
           return false;   
    }
}

if ( ! function_exists('getAwardsArr'))
{
 function getAwardsArr($awards = array()){

        $nominationModel      = model('App\Models\NominationModel');
        $categoryModel        = model('App\Models\CategoryModel');

        if(is_array($awards)) {
          foreach($awards as $akey => $avalue){
             $categoryArr = $categoryModel->getListsOfCategories($avalue['category'])->getRowArray();
             $awards[$akey]['category_name'] = $categoryArr['type'];
             $awards[$akey]['category']      = $categoryArr['name'];

             $nomineePhoto = $nominationModel->getNominationData($avalue['id'])->getRowArray();
             $awards[$akey]['nominator_photo'] = $nomineePhoto['nominator_photo'];
          }
        }
        return $awards;
    }
}   

if ( ! function_exists('getAwardData'))
{
 function getAwardData($award_id = ''){
        $nominationModel = model('App\Models\NominationTypesModel');
        $awardData = $nominationModel->getListsOfNominations($award_id)->getRowArray();
        return $awardData;
    }
} 


if(!function_exists('getNominationDays'))
{
    function getNominationDays($extendDate) {


        $date2_ts = date("Y-m-d H:i:s", strtotime($extendDate));
//echo "<br />";
		//echo date("Y-m-d");

        $d1 = new DateTime(date("Y-m-d"));

        $d2 = new DateTime($date2_ts);

        $interval = $d2->diff($d1);

        $mins    = $interval->i;
        $hrs     = $interval->h;
        $days    = $interval->d;
        $months  = $interval->m;
        $seconds = $interval->s;

        $expire = 0;
		
	return $days;
        if($mins >= 1 && $mins < 60){
            $expire = $mins;
        }	  
        else if($mins < 1){	  
            $expire = $seconds;
        }
        else if($mins >= 60 ){
            $expire = $hrs;
        }	
        else if($hrs >= 24) {
            $expire = $days;  
        }

       // $diff = $date2_ts - $date1_ts;
       // $nominationEndDays = round($diff / 86400);
        return $expire;
    }
}

if(!function_exists('getFileInfo'))
{
    function getFileInfo($filename)
    {
        return new \CodeIgniter\Files\File($filename,true);
    }
}

if(!function_exists('checkExpireTime')) {
    function checkExpireTime($time = '')
    {
        $updated_time = strtotime($time);
        $current_time = strtotime(date("Y-m-d H:i:s"));
        $timeDiff  = ($current_time - $updated_time)/60;
        if($timeDiff < 900)
          return true;
        else
          return false;  
    }
}


if ( ! function_exists('getAwardsCategory'))
{
   function getAwardsCategory(){
        $awardsModel = model('App\Models\AwardsCategoryModel');
        $awardData = $awardsModel->getListsOfCategories();
    //    $awardData = $awardData->getResultArray();
        return $awardData;
    }
} 


if ( ! function_exists('getAwardsTypes'))
{
    function getAwardsTypes($id=''){
        $categoryModel = model('App\Models\CategoryModel');
        $awardData = $categoryModel->getCategoryByMainCategoryID()->getResultArray();
       //$awardData = $awardData->getResultArray();
        return $awardData;
    }
} 


if ( ! function_exists('updateAwardEndDate'))
{
    function updateAwardEndDate($award_id='',$extend_date = ''){
        $userModel = model('App\Models\UserModel');
        $awardData = $userModel->getWhere(array("award_id" => $award_id));
        $awardData = $awardData->getResultArray();
        if(is_array($awardData)){
            foreach($awardData as $akey=>$avalue){
                $update_array = array();
                $update_array['extend_date'] = $extend_date;
                $userModel->update(array("id" => $avalue['id']),$update_array);
            }
        }
    }
} 

if ( ! function_exists('getNominationNo'))
{
    function getNominationNo($award_id=''){
        $userModel = model('App\Models\UserModel');
	$nominationModel = model('App\Models\NominationModel');

       // $awardData = $userModel->getWhere(array("award_id" => $award_id));
       // $awardData = $awardData->getResultArray();
       // if(is_array($awardData) && count($awardData)){
         //   $ct       = count($awardData) + 1;  
          //  return  $ct;
       // }
       // else
       // {
          //  return 1;
       // }
	
		 $userModel->orderBy('id', 'DESC');
                $awardData   = $userModel->getWhere(array("award_id" => $award_id),1,0)->getRowArray();
                if($awardData){ 
                    $nomineeData =  $nominationModel->getWhere(array("nominee_id" => $awardData['id']))->getRowArray();
                    //get registration_no
                    $registrationNo = $nomineeData['registration_no'];			
                        if(!empty($registrationNo)){
                        //generate new no
                            $explode = explode("-",$nomineeData['registration_no']);
                            return $registrationNO = trim($explode[1]) + 1;
                        }
                }
                else
                {
                        return $registrationNO = 1;
                }	

    }
} 

if ( ! function_exists('ageCalculation'))
{
    function ageCalculation($date=''){

           // Define the date of birth
            $dateOfBirth = $date;
            
            // Get today's date
            $now = date("d-m-Y");
            
            // Calculate the time difference between the two dates
            $diff = date_diff(date_create($dateOfBirth), date_create($now));
            
            // Get the age in years, months and days
           // echo "your current age is ".$diff->format('%y')." Years ".$diff->format('%m')." months ".$diff->format('%d')." days";
                    
            return $diff->format('%y');
    }
} 

if ( ! function_exists('extendNominationMailSend'))
{
    function extendNominationMailSend($award_id='',$extend_date = ''){
        $userModel = model('App\Models\UserModel');
        $awardData = $userModel->getWhere(array("award_id" => $award_id));
        $awardData = $awardData->getResultArray();

        $email    =  \Config\Services::email();
             
        $extend_date = date("d-m-Y",strtotime($extend_date));

        $header  = "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
        $subject = " Nomination Date extended  - Sunpharma Science Foundation ";
        $message  = "Hi, ";
        $message .= '<br/><br/>';
        $message .= "Nomination date has been changed up to <b>".$extend_date."</b> Please login and upload your documents.";
        $message .= "<br/>";
    
        $message .= "<br/>";
     
        $data['content'] = $message;

        $html = view('email/mail',$data,array('debug' => false));
        $email->setSubject($subject);
        $email->setMessage($html);

        if(is_array($awardData)){
            foreach($awardData as $akey=>$avalue){
                $update_array = array();
                $update_array['extend_date'] = $extend_date;
                $userModel->update(array("id" => $avalue['id']),$update_array);

                $email->setTo(trim($avalue['email']));
                if ($email->send()){
                    return true;
                }
                else
                {
                    return $email->printDebugger(['headers']);
                }

            }
        }
    }
} 


if ( ! function_exists('generateAwardsFolderPath'))
{
    function generateAwardsFolderPath($main_category_id = '',$user_id=''){

        $typeOfAward = '';
        switch ($main_category_id) {
            case '1':
                $typeOfAward .= 'RA';
                break;
            case '2':
                $typeOfAward .= 'SSA';
                break;
            case '3':
                $typeOfAward .= 'CRF';
                break;
         }

         $currentYear = date('Y');

         $fileUploadDir = 'uploads/'.$currentYear.'/'.$typeOfAward.'/'.$user_id;
                            
        if(!file_exists($fileUploadDir) && !is_dir($fileUploadDir))
          mkdir($fileUploadDir, 0777, true);

        return  $fileUploadDir;  

    }
}        

if ( ! function_exists('finalNominationSubmitEmailToCandidate'))
   {
        function finalNominationSubmitEmailToCandidate($name='',$file='',$nominationNo='',$sendemail = '')
        {
            $email    =  \Config\Services::email();
           
            $subject  = 'Application Submission is Successful | Action Required';
            $message   = 'Dear '.$name.',';
            $message  .= '<br/><br/>';
            $message  .= '<b>Nomination No:</b> '.$nominationNo;  
            $message .= "<br/><br/><br/>";
            $message .= "Please find attached the copy of your submitted application. ";
            $message .= "<br /><br/>";
            $message .= "<b>Note: A printed copy of application with all relevant documents to be sent to The Office of the Sun Pharma Science Foundation New Delhi within 10 days of submission.</b><br /><br/>";	
            $message .= "Thanks & Regards,";
            $message .= "<br/>";
            $message .= "Sunpharma Science Foundation Team";
            
            $data['content'] = $message;
	        $data['title'] = '';
            $html = view('email/mail',$data,array('debug' => false));
            
             $email->setTo('punitha@izaaptech.in');
	        $email->setTo($sendemail);

            $email->setSubject($subject);
		
             $email->attach('');

            // file attach here //
            $email->attach($file);

            $email->setMessage($html);
            if ($email->send()){
                return true;
            }
            else
            {
                return $email->printDebugger(['headers']);
            }
       }     
}


if(!function_exists('actionLog')) {
    function actionLog($actionID,$actionName,$actionMessage,$createdID)
    {
        $actionData = array();
        $actionData['action_id']   = $actionID;
        $actionData['action_name'] = $actionName;
        $actionData['message']     = $actionMessage;
        $actionData['created_id']  = $createdID;
        $actionModel = model('App\Models\ActionModel');
        $actionModel->save($actionData);
    }
}
