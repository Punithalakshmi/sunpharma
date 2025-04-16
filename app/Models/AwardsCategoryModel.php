<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class AwardsCategoryModel extends Model{
    protected $table = 'awards_creation_category';
    
    protected $allowedFields = [
        'name',
        'created_date',
        'updated_date',
        'created_id',
        'updated_id'
    ];

 
    public function getListsOfCategories($id='')
    {
        if(empty($id))
          return $this->findAll();
        else 
          return $this->getWhere(array('id' => $id)); 
    }

   
}