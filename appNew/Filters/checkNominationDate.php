<?php namespace App\Filters;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
 
class checkNominationDate implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $current_date = strtotime(date("Y-m-d H:i:s"));

        $uri     = current_url(true);

        $awardID = $uri->getSegment(2);  

        $nominationModel    = model('App\Models\NominationTypesModel');

        $awardData     = $nominationModel->getListsOfNominations($awardID)->getRowArray();
       
        if(is_array($awardData) && count($awardData) == 1) {
            $nominationEndDate  = strtotime(date("Y-m-d 23:59:59",strtotime($awardData['end_date'])));
        
            if($nominationEndDate < $current_date || $awardData['status'] == 0){
                // then redirct to login page
                return redirect()->to('nomination/close'); 
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