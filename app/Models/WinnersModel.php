<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class WinnersModel extends Model{
    protected $table = 'posting_winners';
    
    protected $allowedFields = [
        'name',
        'bio',
        'photo',
        'designation',
        'category_id',
        'main_category_id',
        'created_id',
        'updated_id',
        'created_date',
        'updated_date',
        'address',
        'year',
        'status'
    ];

    
    public function getWinner($id='')
    {
        if(empty($id))
         return $this->findAll();
        else 
          return $this->getWhere(array('id' => $id)); 
    }

    public function getWinnersLists()
    {
        $builder = $this->table('posting_winners');
        $builder->select('posting_winners.*,category.name as category,category.type,awards_creation_category.name as main_category');
        $builder->join('category','category.id = posting_winners.category_id');
        $builder->join('awards_creation_category','awards_creation_category.id = posting_winners.main_category_id');
        return $query = $builder->get();
    }

    public function getLatestWinnersByCategory($main_category_id = '',$isLatestWinner=false)
    {
        $builder = $this->table('posting_winners');
        $builder->select('posting_winners.*,category.name as category,category.type,awards_creation_category.name as main_category');
        $builder->join('category','category.id = posting_winners.category_id');
        $builder->join('awards_creation_category','awards_creation_category.id = posting_winners.main_category_id');
        $builder->where('posting_winners.main_category_id',$main_category_id);

        if($isLatestWinner)
          $builder->where('posting_winners.year',date('Y'));

        return $query = $builder->get();
    }

    public function getTotalWinners()
    {
        return $this->table('posting_winners')->countAll();
    }

    public function getWinnersByFilter($filter = array())
    {
        $builder = $this->table('posting_winners');
        $builder->select('posting_winners.*,category.name as category,awards_creation_category.name as main_category');
        $builder->join('category','category.id = posting_winners.category_id');
        $builder->join('awards_creation_category','awards_creation_category.id = posting_winners.main_category_id');
        
        if(!empty($filter['type']))
          $builder->like('category.name',$filter['type']);

        if(!empty($filter['award']))
          $builder->like('awards_creation_category.name',$filter['award']);
          
        if(!empty($filter['year']))
          $builder->where('posting_winners.year',$filter['year']);

        if((!empty($filter['limit']) || !empty($filter['start'])))
          $builder->limit($filter['limit'],$filter['start']);

          $builder->orderBy('posting_winners.name', 'ASC'); 

        if(isset($filter['totalRows']) && ($filter['totalRows'] == 'yes'))
            return $builder->countAllResults();
        else 
            return $query = $builder->get();
    }
}