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
        function sendMail($to='',$subject = '',$html = '')
        {

            $header = mailHeader(); 
 
            
            mail($to,$subject,$html,$header);
        }

       
    }       

    if ( ! function_exists('mailHeader'))
    {
        function mailHeader()
        {
            $header  = '';
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";

            return $header;
        }
    }    