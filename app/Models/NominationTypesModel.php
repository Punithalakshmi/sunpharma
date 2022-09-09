<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class NominationTypesModel extends Model{
    protected $table = 'nominations';
    
    protected $allowedFields = [
        'name',
        'start_date',
        'end_date',
        'created_date',
        'updated_date',
        'created_id',
        'updated_id'
    ];


    public function getListsOfNominations($id='')
    {
        if(empty($id))
         return $this->findAll();
        else 
          return $this->getWhere(array('id' => $id)); 
    }

}