<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class UserModel extends Model{
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
        'category',
        'original_password',
        'status',
        'active',
        'is_rejected',
        'extend_date'
    ];

    public function Login($username, $password) {
        $result = $this->db
                        ->table($this->table)
                        ->where(array("username" => $username, "password" => $password))
                        ->get()
                        ->getRow();
        if($result) {
            $data = [
                'login_id'          => $result->id,
                'login_name'        => $result->firstname,
                'login_email'       => $result->email,
                'isLoggedIn'        => TRUE,
                'role'              => $result->role,
                'id'                => $result->id
            ];
            return $data;
        } else {
            return 0;
        }
        
    }

    public function fLogin($username, $password) {
        $result = $this->db
                        ->table($this->table)
                        ->where(array("username" => $username, "password" => $password))
                        ->get()
                        ->getRow();
        if($result) {
            $data = [
                'id'          => $result->id,
                'name'        => $result->firstname,
                'email'       => $result->email,
                'isLoggedIn'  => TRUE,
                'role'        => $result->role,
                'isNominee'   => 'yes'
            ];
            return $data;
        } else {
            return 0;
        }
        
    }

    public function getListsOfUsers($id='')
    {
        if(empty($id))
         return $this->findAll();
        else 
          return $this->getWhere(array('id' => $id)); 
    }


    public function getUserLists($id='')
    {
        $builder = $this->table('users');
        $builder->select('users.*,users.id as user_id,roles.name as role_name');
        $builder->join('roles','roles.id = users.role');
        $builder->orderBy('id', 'DESC');
        $builder->orderBy('firstname', 'ASC');
        return $query = $builder->get();
    }


    public function getUserData($id='')
    {
        $builder = $this->table('users');
        $builder->select('users.*,users.id as user_id,nominee_details.*,nominee_details.id as nominee_detail_id,category.name as category_name');
        $builder->join('nominee_details','nominee_details.nominee_id = users.id');
        $builder->join('category','category.id=nominee_details.category_id');
        $builder->where("users.role",'2');
        $builder->where("users.id",$id);
        return $query = $builder->get();
    }

    public function getListsOfNominees()
    { 
          return $this->getWhere(array('role' => 2,'status' => 'Approved','active' => 1)); 
    }

    public function getJuryRateData($jury_id = '',$nominee_id = '')
    {
        $builder = $this->table('users');
        $builder->select('users.*,ratings.rating');
        $builder->join('ratings','ratings.jury_id = users.id AND ratings.nominee_id='.$nominee_id);
        $builder->where("users.role",'1');
        $builder->where("users.id",$jury_id);
        return $query = $builder->get();
    }

    public function getListsNominations()
    {
        $builder = $this->table('users');
        $builder->select('users.*,nominations.end_date,category.name as category_name');
        $builder->join('nominee_details','nominee_details.nominee_id = users.id');
        $builder->join('category','category.id=nominee_details.category_id');
        $builder->join('nominations','nominations.category_id = category.id');
        $builder->where("users.role",'2');
        $builder->where("users.status",'Approved');
        $builder->where("users.active",'1');
        return $query = $builder->get();
    }


    public function getJuryListsByCategory($category_id = '')
    {
        return $this->getWhere(array('category' => $category_id,'role' => 1))->getResultArray(); 
    }
    
}