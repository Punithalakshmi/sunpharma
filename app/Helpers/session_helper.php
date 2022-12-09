<?php
 
if ( ! function_exists('setSessionData'))
{
    function setSessionData(string $name = '', array $data = [])
    {
        $session = session();
        $session->set($name,$data);
    }
}


if ( ! function_exists('getSessionData'))
{
    function getSessionData(string $name = '')
    {
       
        $session = session();
        if($name != ''){
          $session->get($name);
        }
        else
        {
            return $sessData = ($session->get('userdata'))?$session->get('userdata'):$session->get('fuserdata');
        }  

       // print_r($session->get('userdaa')); 
    }
}


if ( ! function_exists('getUserRole'))
{
    function getUserRole()
    {
        
       $sessionData =  $this->getSessionData();
       
       return $sessionData['role'];
    }
}

if ( ! function_exists('getLoggedInUsername'))
{
    function getLoggedInUsername()
    {
        $sessionData =  $this->getSessionData();
        return $sessionData['firstname'];
    }
}

if ( ! function_exists('sessionDestroy'))
{
    function sessionDestroy()
    {
        $session = session();
        $session->destroy();
    }
}


?>