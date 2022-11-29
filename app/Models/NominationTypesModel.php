<?php 
namespace App\Models;  
use CodeIgniter\Model;


class NominationTypesModel extends Model{
    protected $table = 'nominations';
    
    protected $allowedFields = [
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
        if(empty($id))
         return $this->findAll();
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
          return $this->getWhere(array('status' => 1)); 
    }
    
}