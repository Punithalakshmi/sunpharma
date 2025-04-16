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
            return $session->get($name);
        }
        else
        {
            $uri  = current_url(true);
            $segment =  $uri->getSegment(1);
            return $sessData = ($segment=='admin' || $segment=='jury')?$session->get('userdata'):$session->get('fuserdata');
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


if(!function_exists('sessionRemove'))
{
    function sessionRemove($remove = array())
    {
        $session = session();
        $session->remove($remove);
    }
}

?>