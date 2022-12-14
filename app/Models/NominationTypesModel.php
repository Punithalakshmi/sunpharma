<?php 
namespace App\Models;  
use CodeIgniter\Model;


class NominationTypesModel extends Model{
    protected $table = 'nominations';
    
    protected $allowedFields = [
        'main_category_id',
        'category_id',
        'year',
        'start_date',
        'end_date',
        'created_date',
        'updated_date',
        'created_id',
        'updated_id',
        'status',
        'banner_image',
        'thumb_image',
        'document',
        'title',
        'subject',
        'description',
    ];


    public function getListsOfNominations($id='')
    {
        if(empty($id)){
            $builder = $this->table('nominations');
            $builder->select('nominations.*');
            $builder->orderBy('status', '1');
            $builder->orderBy('title', 'ASC');  
            return $query = $builder->get();
        }
        else 
          return $this->getWhere(array('id' => $id)); 
    }

    public function getCategoryWiseNominations()
    {
            $builder = $this->table('nominations');
            $builder->select('nominations.*,category.type');
            $builder->join('category','category.id = nominations.category_id');
            return $query = $builder->get();
    }

    public function getCategoryNomination($id='')
    {
          return $this->getWhere(array('category_id' => $id)); 
    }
 
    public function getActiveNomination()
    {
        //  return $this->getWhere(array('status' => 1)); 

          $builder = $this->table('nominations');
          $builder->select('nominations.*,IF(category.type!="","awards","awards") as category_type,category.type,nominations.id as award_id');
          $builder->join('category','category.id = nominations.category_id');
          $builder->join('awards_creation_category','awards_creation_category.id = nominations.main_category_id');
          return $query = $builder->get();

    }
    
}