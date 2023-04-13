<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class JuryModel extends Model{
    protected $table = 'jury_mapping';
    
    protected $allowedFields = [
        'id',
        'jury_id',
        'award_id',
        'assign_by',
        'created_date',
        'updated_date',
        'created_id',
        'updated_id',
    ];

    public function getJuryLists()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.*,users.id as user_id,roles.name as role_name');
        $builder->join('roles','roles.id = users.role');
        $builder->where("users.role",'1');
        return $query = $builder->get(); 
    }

    public function getMappingData($where = array())
    {
        return $this->getWhere($where); 
    }
    
    public function getAwardMappingLists($award_id = '')
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.*');
        $builder->join('jury_mapping','jury_mapping.jury_id = users.id');
        $builder->where("jury_mapping.award_id",$award_id);
        $builder->where("users.role",'1');
        return $query = $builder->get();
    }

    public function getJuriesByAwards()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('jury_mapping m');
        $builder->select('GROUP_CONCAT(m.jury_id) as juries,m.award_id,GROUP_CONCAT(u.firstname) as juryname,n.title');
        $builder->join('users u','u.id=m.jury_id');
        $builder->join('nominations n','n.id=m.award_id');
        return $query = $builder->get();
    }

    public function getAwardsByJuries()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.*');
        $builder->join('jury_mapping','jury_mapping.jury_id=users.id');
        return $query = $builder->get();   
    }

    public function getTotalJuries()
    {
        return $this->table('jury_mapping')->countAll();
    }

    public function getJuriesByFilter($filter=array())
    {
        $db = \Config\Database::connect();
        $builder = $db->table('jury_mapping m');
        $builder->select('GROUP_CONCAT(m.jury_id) as juries,m.award_id,GROUP_CONCAT(u.firstname) as jury,n.title');
        $builder->join('users u','u.id=m.jury_id');
        $builder->join('nominations n','n.id=m.award_id');
        
        if(!empty($filter['jury']))
          $builder->like('m.jury_id',$filter['jury']);

        if(!empty($filter['award']))
          $builder->like('m.award_id',$filter['award']);
          
        if((!empty($filter['limit']) || !empty($filter['start'])))
          $builder->limit($filter['limit'],$filter['start']);

          $builder->orderBy('m.id', 'DESC'); 
          $builder->groupBy('m.award_id'); 

        if(isset($filter['totalRows']) && ($filter['totalRows'] == 'yes'))
            return $builder->countAllResults();
        else 
            return $query = $builder->get();
    }

}