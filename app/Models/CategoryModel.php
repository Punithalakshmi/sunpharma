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
        'updated_id',
        'main_category_id',
        'id'
    ];

 
    public function getListsOfCategories($id='')
    {
        if(empty($id)){
            $builder = $this->table('category');
            $builder->select('category.*');
         
            $builder->orderBy('name', 'ASC');  
            $builder->orderBy('id', 'DESC');
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
            $builder->where("category.type",$type);
            $builder->where("category.status",'Active');
            return $query = $builder->get();
    }

    public function getCategoriesById($id = '',$name=''){
        $builder = $this->table('category');
        $builder->select('category.*');
        if($name=='yes')
            $builder->where("category.name",$id);
        else
            $builder->where("category.id",$id);
        return $query = $builder->get();
    }

    public function getCategoriesByIdMain($id = '',$main_category_id=''){
        $builder = $this->table('category');
        $builder->select('category.*');
        $builder->where("category.name",$id);
        $builder->where("main_category_id",$main_category_id);
        return $query = $builder->get();
    }

    public function getCategoriesWithoutNomination(){
        $builder = $this->table('category');
        $builder->select('category.*');
        $builder->join('nominations','nominations.category_id != category.id');
        return $query = $builder->get();
    }

    public function getCategoryByMainCategoryID($id)
    {
        $builder = $this->table('category');
        $builder->select('category.*');
        $builder->where("category.main_category_id",$id);
        return $query = $builder->get();
    }

    public function getCategoriesListsByID($id = '')
    {
        $db = \Config\Database::connect();
        $builder = $db->table('category c');
        $builder->select('a.*');
        $builder->join('category a','a.main_category_id=c.main_category_id','left');
        $builder->where("c.id",$id);
        return $query = $builder->get();
    }

    public function getCategoryLists()
    {
        return $this->table('category')->countAll();
    }

    public function getCategoryByFilter($filter = array())
    {

        $builder = $this->table('category');
        $builder->select('category.*');
        
        if(!empty($filter['award']))
          $builder->where('category.main_category_id',$filter['award']);

        if((!empty($filter['limit']) || !empty($filter['start'])))
          $builder->limit($filter['limit'],$filter['start']);

        if(isset($filter['totalRows']) && ($filter['totalRows'] == 'yes'))
            return $builder->countAllResults();
        else 
            return $query = $builder->get();

    }
}