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
        $builder = $db->table('jury_mapping');
        $builder->select('users.*');
        $builder->join('jury_mapping','jury_mapping.jury_id = users.id');
        $builder->where("jury_mapping.award_id",$award_id);
        $builder->where("users.role",'1');
        return $query = $builder->get();
        
    }
}