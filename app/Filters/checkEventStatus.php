<?php namespace App\Filters;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
 
class checkEventStatus implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $current_date = strtotime(date("Y-m-d"));

        $uri  = current_url(true);

        $eventID = $uri->getSegment(1); 

        $eventModel    = model('App\Models\WorkshopModel');

        $eventData     = $eventModel->getLists($eventID)->getRowArray();

        if(is_array($eventData)) {
                $eventEndDate  = strtotime(date("Y-m-d",strtotime($eventData['end_date'])));
      
        if($eventEndDate < $current_date){
            // then redirct to login page
            return redirect()->to('event/close'); 
        }
      }
    }
 
    //--------------------------------------------------------------------
 
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}