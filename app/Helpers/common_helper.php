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

    
if ( ! function_exists('isNominationExpired'))
{
    function isNominationExpired($extendDate)
    {
       
        $date1_ts = strtotime(date("Y-m-d"));
        $date2_ts = strtotime($extendDate);
        $diff = $date2_ts - $date1_ts;
        $nominationEndDays = round($diff / 86400);
    
        if($nominationEndDays <= 0 )
          return true;
       else
          return false ;
        
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