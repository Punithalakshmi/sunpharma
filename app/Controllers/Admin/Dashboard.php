<?php


namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
         //total approved nominee lists
	$this->data['total_approved_nominee_lists_count'] = $this->nomineeModel->getTotalApprovedNomineesCount()->getResultArray();

	$this->data['total_rejected_nominee_lists_count'] = $this->nomineeModel->getTotalRejectedNomineesCount()->getResultArray();

        return render('admin/home',$this->data);  

    }

    public function access()
    {
       // $this->session->remove('userdata');
        return render('admin/access_denied',$this->data);  
    }
}
