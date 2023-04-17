<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class JuryMapping extends BaseController
{

    public function index()
    {
        $filter = array();
        $filter['jury']       = '';
        $filter['award']      = '';
        $filter['start']      = '0';
        $filter['limit']      = '10';
        $filter['orderField'] = 'id';
        $filter['orderBy']    = 'desc';
        $totalRecords  = $this->juryModel->getTotalJuries();

        $this->data['awards'] =  $this->nominationTypesModel->getListsOfNominations()->getResultArray();

        $this->data['juries'] = $this->userModel->getListsOfUsers();
        
        if (strtolower($this->request->getMethod()) == "post") { 

            if(!$this->validation->withRequest($this->request)->run()) {

                $dtpostData = $this->request->getPost('data');

                $response = array();
    
                $draw            = $dtpostData['draw'];
                $start           = $dtpostData['start'];
                $rowperpage      = $dtpostData['length']; // Rows display per page
                $columnIndex     = $dtpostData['order'][0]['column']; // Column index
                $columnName      = $dtpostData['columns'][$columnIndex]['data']; // Column name
                $columnSortOrder = $dtpostData['order'][0]['dir']; // asc or desc
                $searchValue     = $dtpostData['search']['value']; // Search value

                // Custom filter
                $jury                  = $dtpostData['jury'];
                $award                 = $dtpostData['award'];
                $filter['jury']        = $jury;
                $filter['award']       = $award;
                $filter['start']       = $start;
                $filter['limit']       = $rowperpage;
                $filter['orderField']  = $columnName;
                $filter['orderBy']     = $columnSortOrder;
                $juryLists = $this->juryModel->getJuriesByFilter($filter)->getResultArray();
                $filter['totalRows'] = 'yes';
                $totalRecordsWithFilterCt = $this->juryModel->getJuriesByFilter($filter);
                $totalRecordsWithFilter = (!empty($jury) || !empty($award))?$totalRecordsWithFilterCt:$totalRecords;
           }

        }
        else
        {    
            $juryLists = $this->juryModel->getJuriesByFilter($filter)->getResultArray();
            $totalRecordsWithFilter = count($juryLists);
        }

        $this->data['lists'] = $juryLists;
        
        $data = array();
        foreach($juryLists as $ukey => $uvalue){
            
            $data[] = array(
                            
                            'award' => $uvalue['title'],
                            'jury' => $uvalue['jury'],
                            'action' => ''
                        );
        }
       
        if($this->request->isAJAX()) {
            
                $end  = $filter['start'] + $filter['limit'];
                return $this->response->setJSON(array(
                                        'status' => 'success',
                                        'data'  => $data,
                                        'token' => csrf_hash(),
                                        "draw" => intval($draw),
                                        "iTotalRecords" => $totalRecords,
                                        "start" => $filter['start'],
                                        "end" => $end,
                                        "length" => $filter['limit'],
                                        "page" => $draw,
                                        "iTotalDisplayRecords" => $totalRecordsWithFilter
                                    )); 
                 exit;
        }
        else
        {
            return render('admin/jury/list',$this->data);
        } 
    }

    public function mapping($id='')
    {
            $this->data['juryLists']  = $this->juryModel->getJuryLists()->getResultArray();
            $this->data['awardLists'] = $this->nominationTypesModel->getAwardLists()->getResultArray();
            $this->validation = $this->validate($this->validation_rules($id));
            
            if($this->validation) {

                if (strtolower($this->request->getMethod()) == "post") {
                
                    $juryID      = $this->request->getPost('jury');
                    $awardIDS    = $this->request->getPost('award');

                    $ins_data = array();
                    $ins_data['jury_id']      = $juryID;
                    $ins_data['assign_by']    = $this->data['userdata']['login_id'];

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
                   
                    return redirect()->route('admin/mappedjuries');
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
