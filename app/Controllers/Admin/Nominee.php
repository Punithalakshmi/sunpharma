<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NomineeModel;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\JuryModel;

class Nominee extends BaseController
{

    public function index()
    {
        $session = \Config\Services::session();

        $userdata  = $session->get('userdata');
        $nomineeModel = new NomineeModel();
        
        $data['userdata'] = $userdata;
       
        if(is_array($userdata) && count($userdata)):

            $userLists = $nomineeModel->getListsOfNominees();
            $lists     = $userLists->getResultArray();

            foreach($lists as $k => $user){
               $userLists  = $nomineeModel->getJuryName($user['jury_id']);
               $juryName   =  $userLists->getRowArray();
             //  print_r($juryName); die;
                if(isset($juryName['firstname']) && isset($juryName['lastname']))
                    $lists[$k]['assigned_jury'] = $juryName['firstname'].' '.$juryName['lastname'];
                else
                    $lists[$k]['assigned_jury']  = ' - ';  
            }

            $data['lists'] = $lists;
            $juryLists = array();
            $juryLists  = $nomineeModel->getJuryLists()->getResultArray();

            if(count($juryLists) > 0)
                 $data['juryLists'] = $juryLists;
                 

            return view('_partials/header',$data)
                .view('admin/nominee/list',$data)
                .view('_partials/footer');
        else:
            return redirect()->route('admin/login');
        endif;        
    }

    public function approve()
    {

        $session = \Config\Services::session();
        $request = \Config\Services::request();

        $userdata  = $session->get('userdata');
        $userModel = new userModel();
        
        $data['userdata'] = $userdata;
       
        if(is_array($userdata) && count($userdata)):

            $id     = $request->getPost('id');
            $type   = $request->getPost('type');

            $up_data = array();

            if(!empty($type) && ($type == 'approve')){
              $up_data['status']  = 'Approved';
            }  
            else
            {  
              $up_data['status']  = 'Disapproved';
            } 

            $up_data['updated_date']  =  date("Y-m-d H:i:s");
            $up_data['updated_id']    =  $userdata['login_id'];

            $userModel->update(array("id" => $id),$up_data);

            $getUserData  = $userModel->getListsOfUsers($id);
            $getUserData  = $getUserData->getRowArray();

            $email = \Config\Services::email();

            $email->setFrom('your@example.com', 'Your Name');
            $email->setTo($getUserData['email']);
           // $email->setCC('another@another-example.com');
            //$email->setBCC('them@their-example.com');

            $email->setSubject('Your Application Approval Status');
            $message = '';
            if($type == 'approve') {
                $msg = 'Approved Successfully';
                $message  = 'Your Application has been approved. Please use below credentials to login and submit the other application details. <br /> <br />';
                $message .= 'Username: '.$getUserData['email'].'<br /><br />';
                $message .= 'Password: '.md5(uniqid(rand(), true)).'<br /><br /><br /><br />'; 
            }
            else
            {
                $msg = 'Rejected Successfully';
                $message .= 'Your Application has been rejected';
            }
            $message .= 'Thanks,<br/>';
            $message .= 'Sunpharma';
            $email->setMessage($message);
            
            $status = '';
            if($email->send()){
                $status = 'success';
                $message = $msg;
            }
            else
            {
                $status = 'error';
                $data = $email->printDebugger(['headers']);
                $message = $data;
            }
        
            if($this->request->isAJAX()){
                    echo json_encode(array('status' => $status,'message' => $message));
                    exit;
            }

        else
            return redirect()->route('admin/login');
        endif;


    }


    public function nominee_lists_of_jury()
    {
        $session = \Config\Services::session();

        $userdata  = $session->get('userdata');
        $nomineeModel = new NomineeModel();
        
        $data['userdata'] = $userdata;
       
        if(is_array($userdata) && count($userdata)):

            $juryModel     = new JuryModel();
            $nomineeLists  = $juryModel->getListsOfNominees($userdata['login_id']);
            $data['lists'] = $nomineeLists->getResultArray();
           
            return view('_partials/header',$data)
                .view('admin/nominee/nominee_lists_of_jury',$data)
                .view('_partials/footer');
        else:
            return redirect()->route('admin/login');
        endif;

    }
    
    
    public function view($id = '')
    {
        $session   = \Config\Services::session();
        $userdata  = $session->get('userdata');
        
        $data['userdata'] = $userdata;
       
        if(is_array($userdata) && count($userdata)):

            $userModel    = new UserModel();
            $getUserData  = $userModel->getListsOfUsers($id);
            $data['user'] = $getUserData->getRowArray();
            return view('_partials/header',$data)
                .view('admin/nominee/view',$data)
                .view('_partials/footer');
        else:
            return redirect()->route('admin/login');
        endif;

    }


    public function assignJury()
    {
        $session = \Config\Services::session();
        $request = \Config\Services::request();

        $userdata  = $session->get('userdata');
        
        $data['userdata'] = $userdata;
       
        if(is_array($userdata) && count($userdata)):

            $juryModel = new JuryModel();

            $juryID       = $request->getPost('juryID');
            $nomineeArr   = $request->getPost('nominee');
     
            $ins_data = array();
            $ins_data['jury_id'] = $juryID;
            $ins_data['created_date'] = date("Y-m-d H:i:s");
            $ins_data['created_id']   = $userdata['login_id'];
           foreach($nomineeArr as $nominee){

              $getAssignedJuryLists = $juryModel->checkIfAlreadyNominee($juryID,$nominee);
               
              if(!is_array($getAssignedJuryLists)){
                $ins_data['nominee_id'] = $nominee;
                $getUserData = $juryModel->insert($ins_data);
              }
           }

           echo json_encode(array('status' => 'success','message' => 'Jury Assigned Successfully!'));
           exit;
           
        else:
            return redirect()->route('admin/login');
        endif;
    }

}