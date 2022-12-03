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
        $session->get($name);
    }
}


?>