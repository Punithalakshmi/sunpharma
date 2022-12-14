<?php namespace App\Filters;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
 
class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // if user not logged in
        $sessionData = array();

        $session = session();
    
       if(count($sessionData) == 0) {
            $sessionData = ($session->get('fuserdata'))?$session->get('fuserdata'):$session->get('userdata');
        }
      
          //  print_r($sessionData); die;
        if((is_array($sessionData) && count($sessionData) == 0 && !isset($sessionData['isLoggedIn'])) || empty($sessionData)){
            // then redirct to login page
            return redirect()->to('/admin/login'); 
        }
    }
 
    //--------------------------------------------------------------------
 
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}