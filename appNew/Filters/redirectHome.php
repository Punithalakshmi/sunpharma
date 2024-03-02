<?php namespace App\Filters;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
 
class redirectHome implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $current_date = strtotime(date("Y-m-d H:i:s"));
        $uri  = current_url(true);
        $award_id = $uri->getSegment(1); 

        if(empty($award_id))
           return redirect()->to('/'); 

        $nominationModel = model('App\Models\NominationTypesModel');
        $eventData       = $nominationModel->getListsOfNominations($award_id)->getRowArray();

        if(is_array($eventData) && count($eventData) == 1) {
            $eventEndDate  = strtotime(date("Y-m-d 23:59:59",strtotime($eventData['end_date'])));
      
            if($eventEndDate < $current_date || $eventData['status'] == 0){
                // then redirct to login page
                return redirect()->to('nomination/close'); 
            }
            else
            {
                return true;
            }
        }
        else
        {
            return redirect()->to('/'); 
        }
    }
 
    //--------------------------------------------------------------------
 
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}