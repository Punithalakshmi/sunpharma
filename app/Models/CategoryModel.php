<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class CategoryModel extends Model{
    protected $table = 'category';
    
    protected $allowedFields = [
        'name',
        'status',
        'type',
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

    public function getUserData($id='')
    {
            $builder = $this->table('users');
            $builder->select('users.*,nominee_details.*');
            $builder->join('nominee_details','nominee_details.nominee_id = users.id');
            $builder->where("users.role",'2');
            $builder->where("users.id",$id);
            return $query = $builder->get();
    }
}