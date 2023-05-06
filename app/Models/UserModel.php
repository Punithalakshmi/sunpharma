<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class UserModel extends Model {
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
        'extend_date',
        'review_status',
        'award_id',
        'gender',
        'approved_by',
        'approved_on_time',
        'approved',
        'nomination_upload',
        'nomination_upload_time',
        'nomination_upload_by',
        'old_user_id',
        'remarks',
        'updated_time'
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
        } 
        else 
        {
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
        if(!empty($role))
         $builder->where('users.role',$role);
         
        $builder->orderBy('id', 'DESC');
        $builder->orderBy('firstname', 'ASC');
        $builder->limit($limit,$start);
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
        $builder->where('ratings.is_rate_submitted',1);
        return $query = $builder->get();
    }

    public function getListsNominations()
    {
        $builder = $this->table('users');
        $builder->select('users.*,nominations.end_date,category.name as category_name,nominee_details.registration_no,nominations.title,awards_creation_category.name as main_category_name');
        $builder->join('nominee_details','nominee_details.nominee_id = users.id');
        $builder->join('category','category.id=nominee_details.category_id');
        $builder->join('nominations','nominations.id = users.award_id AND nominations.status=1');
        $builder->join('jury_mapping','jury_mapping.jury_id=users.id');
        $builder->join('awards_creation_category','awards_creation_category.id=nominations.main_category_id');
        $builder->where("users.role",'2');
        $builder->where("users.status",'Approved');
        $builder->where("nominee_details.is_submitted",1);
        return $query = $builder->get();
    }


    public function getJuryListsByCategory($category_id = '')
    {
        return $this->getWhere(array('category' => $category_id,'role' => 1))->getResultArray(); 
    }
    
    public function checkUniqueEmail($where = array())
    {
        return $this->getWhere($where)->getResultArray(); 
    }

    public function getDataByOldID($user_id = '',$type='')
    {
        $builder = $this->table('users');
        $builder->select('nominee_details.id as nominee_detail_id,nominee_details.*');
        $builder->join('nominee_details','nominee_details.nominee_id = users.id');
        $builder->where('nominee_details.nomination_type',$type);
        $builder->where("users.old_user_id",$user_id);
        return $query = $builder->get();   
    }

    public function checkEmail($where = array())
    {
        return $this->getWhere($where)->getRowArray(); 
    }

    public function updateTime($id=''){
        $builder = $this->table('users');
        $builder->update(array("updated_time" => date("Y-m-d H:i:s")));
        $builder->where("id",$id);
        if($this->db->affectedRows()==1)
          return true;
        else 
          return false;
    }

    public function getUsersByFilter($filter = array())
    {
        $builder = $this->table('users');
        $builder->select('users.*,users.id as user_id,roles.name as role_name');
        $builder->join('roles','roles.id = users.role');
        $builder->join('nominee_details', 'nominee_details.nominee_id = users.id','left');

        if(!empty($filter['role']))
         $builder->where('users.role',$filter['role']);

        if(!empty($filter['category']))
         $builder->where('users.category',$filter['category']); 

        if(!empty($filter['email']))
         $builder->where('users.email',$filter['email']);
         
        if(!empty($filter['firstname']))
         $builder->where('users.firstname',$filter['firstname']);

         if(!empty($filter['year']))
          $builder->where('nominee_details.nomination_year',$filter['year']); 
         
        $builder->orderBy('id', 'DESC');
        $builder->orderBy('firstname', 'ASC');

        if((!empty($filter['limit']) || !empty($filter['start'])))
          $builder->limit($filter['limit'],$filter['start']);

        if(isset($filter['totalRows']) && ($filter['totalRows'] == 'yes'))
            return $builder->countAllResults();
        else 
            return $query = $builder->get();
    }

    public function getAwardData($id = ''){
        $builder = $this->table('users');
        $builder->select('nominations.*,users.*');
        $builder->join('nominations','nominations.id = users.award_id');
        $builder->where("users.id",$id);
        return $query = $builder->get();
    }

    public function getAllActiveJuryLists()
    {
        $builder = $this->table('users');
        $builder->select('users.*');
        $builder->where("users.role",'1');
        $builder->where("users.active",'1');
        return $query = $builder->get();
    }

}