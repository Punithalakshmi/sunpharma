<?php namespace App\Filters;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
 
class checkNomineeLogin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // if user not logged in
        $sessionData = array();
        $session = session();
    
        if(count($sessionData) == 0) {
           $sessionData = $session->get('fuserdata');
        }

        if((is_array($sessionData) && count($sessionData) == 0 && !isset($sessionData['isLoggedIn'])) || empty($sessionData)){
            return true; 
        }
        else
        {
            $this->uri  = current_url(true);
            $segment1    =  $this->uri->getSegment(1);
            $segment2    =  $this->uri->getSegment(2);

            if(isset($sessionData['role']) && ($sessionData['role'] == 2)){
                    return true;
            }
            else
            {
                if(!empty($segment) && ($segment == 'admin')){
                    $session->remove('userdata');
                    return redirect()->to('/admin/access');
                }
            }

        }
    }
 
    //--------------------------------------------------------------------
 
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}