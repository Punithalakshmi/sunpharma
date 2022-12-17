<?php namespace App\Filters;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
 
class checkEventStatus implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $current_date = strtotime(date("Y-m-d"));
      
        if( ){
            // then redirct to login page
            return redirect()->to('/admin/login'); 
        }
    }
 
    //--------------------------------------------------------------------
 
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}