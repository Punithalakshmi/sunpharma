<?php namespace App\Filters;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
 
class checkEventStatus implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $current_date = strtotime(date("Y-m-d H:i:s"));

        $uri  = current_url(true);

        $eventID = $uri->getSegment(3); 

        $eventModel    = model('App\Models\WorkshopModel');

        $eventData     = $eventModel->getLists($eventID)->getRowArray();

        if(is_array($eventData)) {
            $eventEndDate  = strtotime(date("Y-m-d 23:59:59",strtotime($eventData['end_date'])));
      
        if($eventEndDate < $current_date || $eventData['status'] == 0){
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