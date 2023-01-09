<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class NomineeModel extends Model{
    protected $table = 'users';
    
    protected $allowedFields = [
        'username',
        'firstname',
        'password',
        'lastname',
        'created_date',
        'email',
        'phone',
        'role',
        'created_id',
        'updated_id',
        'updated_date',
        'dob',
        'address',
        'middlename',
        'category'
    ];

    public function getListsOfNominees($id='')
    {
        if(empty($id)){
            $builder = $this->table('users');
            $builder->select('users.*,category.name as category_name,nominee_details.registration_no');
            $builder->join('nominee_details', 'nominee_details.nominee_id = users.id');
            $builder->join('category', 'category.id = users.category');
            $builder->where("users.role",'2');
            return $query = $builder->get();
        }
        else
        { 
          return $this->getWhere(array('id' => $id));
        }   
    }

    public function getJuryName($id='')
    {
        $builder = $this->table('users');
        $builder->select('users.firstname,users.lastname');
        $builder->join('jury_nominee', 'jury_nominee.jury_id = users.id AND users.role="1"');
        $builder->where("jury_nominee.jury_id",$id);
        return $query = $builder->get();
    }

    public function getJuryLists()
    {
        return $this->getWhere(array("role" => '1'));
    }

    public function getNomineeInfo($id='')
    {
        $builder = $this->table('users');
        $builder->select('users.*,nominee_details.*,users.id as user_id');
        $builder->join('nominee_details', 'nominee_details.nominee_id = users.id AND users.role="2"');
        $builder->where("nominee_details.nominee_id",$id);
        return $query = $builder->get();
    }


    
}