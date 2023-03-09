<?php 
namespace App\Models;  
use CodeIgniter\Model;

class NominationTypesModel extends Model {

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

    public function getCategoryNominationByType($id='',$main_categoy='')
    {
        return $this->getWhere(array('category_id' => $id,'main_category_id' => $main_categoy)); 
    }
 
    public function getActiveNomination()
    {
       
        $builder = $this->table('nominations');
        $builder->select('nominations.*,IF(category.type!="","awards","awards") as category_type,category.type,nominations.id as award_id');
        $builder->join('category','category.id = nominations.category_id');
        $builder->join('awards_creation_category','awards_creation_category.id = nominations.main_category_id');
        $builder->where('nominations.status',1);
        return $query = $builder->get();

    }

    public function getAwardLists()
    {
        $builder = $this->table('nominations');
        $builder->select('nominations.*');
        $builder->where('nominations.status',1);
        return $query = $builder->get();
    }
    
    public function getNominationLists()
    {
        return $this->table('nominations')->countAll();
    }


    public function getNominationsByFilter($filter = array())
    {
        $builder = $this->table('nominations');
        $builder->select('nominations.*,category.name as type,awards_creation_category.name as award');
        $builder->join('category','category.id = nominations.category_id');
        $builder->join('awards_creation_category','awards_creation_category.id = nominations.main_category_id');
        
        if(!empty($filter['type']))
          $builder->like('category.name',$filter['type']);

        if(!empty($filter['award']))
          $builder->like('awards_creation_category.name',$filter['award']);
          
        if(!empty($filter['subject']))
          $builder->where('nominations.subject',$filter['subject']);

        if(!empty($filter['title']))
          $builder->like('nominations.title',$filter['title']);

        if((!empty($filter['limit']) || !empty($filter['start'])))
          $builder->limit($filter['limit'],$filter['start']);

          $builder->orderBy('nominations.title', 'ASC'); 

        if(isset($filter['totalRows']) && ($filter['totalRows'] == 'yes'))
            return $builder->countAllResults();
        else 
            return $query = $builder->get();
    }
    
}