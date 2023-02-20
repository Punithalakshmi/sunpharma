<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class JuryMapping extends BaseController
{

    public function index()
    {
        
    }

    public function mapping($id='')
    {
           
            $this->data['juryLists']  = $this->juryModel->getJuryLists()->getResultArray();

            $this->data['awardLists'] = $this->nominationTypesModel->getAwardLists()->getResultArray();
        
            $this->validation = $this->validate($this->validation_rules($id));
            
            if($this->validation) {

                if (strtolower($this->request->getMethod()) == "post") {
                
                    $juryID      = $this->request->getPost('jury');
                    $awardIDS      = $this->request->getPost('award');

                    //print_r($juryIDS); die;
                    $ins_data = array();
                    $ins_data['jury_id']      = $juryID;
                    $ins_data['assign_by']     = $this->data['userdata']['login_id'];

                    for($i=0;$i<count($awardIDS);$i++){
                        $mappingData = $this->juryModel->getMappingData(array("jury_id" => $juryID,"award_id" => $awardIDS[$i]))->getRowArray();
                       
                        $ins_data['award_id']  = $awardIDS[$i];
                        if(is_array($mappingData)){
                         
                            $ins_data['updated_date']  =  date("Y-m-d H:i:s");
                            $ins_data['updated_id']    =  $this->data['userdata']['login_id'];
                            $this->juryModel->update(array("id" => $mappingData['id']),$ins_data);
                        }
                        else
                        {
                            $ins_data['created_date']  =  date("Y-m-d H:i:s");
                            $ins_data['created_id']    =  $this->data['userdata']['login_id'];
                            $this->juryModel->save($ins_data);
                        }
                    }

                   
                    return redirect()->route('admin/jury/mapping');

                }

            }
            else
            {  
               
                if($this->request->getPost())
                   $this->data['validation'] = $this->validator;

              
                return render('admin/jury/mapping',$this->data);
                      
            }       
       
    }


    public function validation_rules($id = '')
    {

        $validation_rules = array();
        $validation_rules = array(
                                    "jury" => array("label" => "Select Jury",'rules' => 'required'),
                                    "award" => array("label" => "Select Award",'rules' => 'required') 
                            );
    
        return $validation_rules;
      
    }

  
}
