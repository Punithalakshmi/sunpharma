<?php 
namespace App\Models;  
use CodeIgniter\Model;


class ExtendModel extends Model{
    protected $table = 'extend_nomination';
    
    protected $allowedFields = [
        'user_id',
        'extend_date',
        'created_date',
        'updated_date',
        'created_id',
        'updated_id'  
    ];


    public function getListsOfExtends($id='')
    {
        if(empty($id))
         return $this->findAll();
        else 
          return $this->getWhere(array('user_id' => $id)); 
    }

    
    
}