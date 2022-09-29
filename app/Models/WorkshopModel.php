<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class WorkshopModel extends Model{
    protected $table = 'events';
    
    protected $allowedFields = [
        'name',
        'description',
        'start_date',
        'end_date',
        'created_date',
        'updated_date',
        'created_id',
        'updated_id'
    ];

    public function getLists($id='')
    {
        if(empty($id))
        return $this->findAll();
       else 
         return $this->getWhere(array('id' => $id)); 
    }

    

}