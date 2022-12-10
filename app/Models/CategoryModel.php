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
        if(empty($id)){
            $builder = $this->table('category');
            $builder->select('category.*');
            $builder->orderBy('id', 'DESC');
            $builder->orderBy('name', 'ASC');  
            return $query = $builder->get();
       }
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

    public function getCategoriesByType($type){
            $builder = $this->table('category');
            $builder->select('category.*');
            $builder->join('nominations','nominations.category_id = category.id');
            $builder->where("category.type",$type);
            $builder->where('category.status','Active');
            return $query = $builder->get();
    }

    public function getCategoriesById($id = ''){
        $builder = $this->table('category');
        $builder->select('category.*');
        $builder->where("category.id",$id);
        return $query = $builder->get();
    }

    public function getCategoriesWithoutNomination(){
        $builder = $this->table('category');
        $builder->select('category.*');
        $builder->join('nominations','nominations.category_id != category.id');
        return $query = $builder->get();
    }
}