<?php
 
if ( ! function_exists('setSessionData'))
{
    function setSessionData(string $name, array $data = [])
    {
        $session = session();
        $session->set($name,$data);
    }
}


if ( ! function_exists('getSessionData'))
{
    function getSessionData(string $name)
    {
        $session = session();
        if($name != ''){
          $session->get($name);
        }
        else
        {
            return ($session->get('userdaa'))?$session->get('userdata'):$session->get('fuserdata');
        }  
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
        $session = session();
        $session->get($name);
    }
}

?>