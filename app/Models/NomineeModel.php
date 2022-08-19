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
        'middlename'
    ];

    public function getListsOfNominees($id='')
    {
        if(empty($id)){
        // return $this->getWhere(array("role" => '2'));
            $builder = $this->table('users');
            $builder->select('users.*,jury_nominee.jury_id');
            $builder->join('jury_nominee', 'jury_nominee.nominee_id = users.id','left');
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
}