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


    if ( ! function_exists('sendMail'))
   {
        function sendMail($to='',$subject = '',$message = '')
        {

            $email  =  \Config\Services::email();

            $data['content'] = $message;
            $html = view('email/mail',$data,array('debug' => false));
            
            $email->setTo($to);

            $email->setSubject($subject);

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


if ( ! function_exists('finalNominationSubmit'))
   {
        function finalNominationSubmit($name='')
        {

            $email    =  \Config\Services::email();

            $subject  = 'Final Submission of Nomination';
            $message   = 'Hi,';
            $message  .= ucfirst($name).' submitted the all documents, Please login and check.';

            $data['content'] = $message;
            $html = view('email/mail',$data,array('debug' => false));
            
            $email->setTo('punitha@izaaptech.in');

            $email->setSubject($subject);

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
 function getAwardsArr($awards = array())
    {

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
 function getAwardData($award_id = '')
    {

        $nominationModel = model('App\Models\NominationTypesModel');

        $awardData = $nominationModel->getListsOfNominations($award_id)->getRowArray();

        return $awardData;
    }
} 


if(!function_exists('getNominationDays'))
{
    function getNominationDays($extendDate) {

        $date1_ts = strtotime(date("Y-m-d"));
        $date2_ts = strtotime($extendDate);
        $diff = $date2_ts - $date1_ts;
        $nominationEndDays = round($diff / 86400);
    
        return $nominationEndDays;

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